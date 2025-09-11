<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modern Appointment Model
 * Handles all appointment data operations with proper structure
 */
class AppointmentModel extends CI_Model
{
    private $table = 'appointments';
    private $db_prefix;

    public function __construct()
    {
        parent::__construct();
        $this->db_prefix = $this->config->item('db_prefix');
        $this->table = $this->db_prefix . $this->table;
    }

    /**
     * Get appointments with filters and pagination
     */
    public function getAppointments($filters = [], $page = 1, $limit = 10)
    {
        $this->buildQuery($filters);
        
        // Add pagination
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        
        // Add ordering
        $this->db->order_by('appointment_date', 'DESC');
        $this->db->order_by('appointment_time', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get total count of appointments with filters
     */
    public function getAppointmentsCount($filters = [])
    {
        $this->buildQuery($filters);
        return $this->db->count_all_results();
    }

    /**
     * Get single appointment by ID
     */
    public function getAppointmentById($id)
    {
        $this->db->select('a.*, d.name as doctor_name, c.center_name');
        $this->db->from($this->table . ' a');
        $this->db->join($this->db_prefix . 'doctors d', 'd.id = a.doctor_id', 'left');
        $this->db->join($this->db_prefix . 'centers c', 'c.id = a.center_id', 'left');
        $this->db->where('a.id', $id);
        
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Create new appointment
     */
    public function createAppointment($data)
    {
        $required_fields = ['patient_name', 'patient_phone', 'appointment_date', 'appointment_time', 'doctor_id', 'center_id'];
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                throw new Exception("Required field {$field} is missing");
            }
        }
        if ($this->isDuplicateAppointment($data)) {
            throw new Exception("Duplicate appointment found for the same patient, doctor, and time slot");
        }
        $appointmentData = [
            'patient_name' => $data['patient_name'],
            'patient_phone' => $data['patient_phone'],
            'patient_email' => $data['patient_email'] ?? '',
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'doctor_id' => $data['doctor_id'],
            'center_id' => $data['center_id'],
            'reason' => $data['reason'] ?? '',
            'status' => 'booked',
            'patient_type' => $data['patient_type'] ?? 'new_patient',
            'created_by' => $data['created_by'] ?? 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert($this->table, $appointmentData);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * Update appointment status
     */
    public function updateAppointmentStatus($appointmentId, $status, $notes = '')
    {
        $validStatuses = ['booked', 'in_clinic', 'cancelled', 'rescheduled', 'no_show', 'visited', 'consultation', 'consultation_done'];
        
        if (!in_array($status, $validStatuses)) {
            throw new Exception("Invalid status: {$status}");
        }

        $updateData = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!empty($notes)) {
            $updateData['notes'] = $notes;
        }

        $this->db->where('id', $appointmentId);
        $this->db->update($this->table, $updateData);

        return $this->db->affected_rows() > 0;
    }

    /**
     * Reschedule appointment
     */
    public function rescheduleAppointment($appointmentId, $newDate, $newTime, $reason = '')
    {
        // Check if new slot is available
        if (!$this->isTimeSlotAvailable($newDate, $newTime, $appointmentId)) {
            throw new Exception("Time slot is not available");
        }

        $updateData = [
            'appointment_date' => $newDate,
            'appointment_time' => $newTime,
            'status' => 'rescheduled',
            'reschedule_reason' => $reason,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $appointmentId);
        $this->db->update($this->table, $updateData);

        return $this->db->affected_rows() > 0;
    }

    /**
     * Cancel appointment
     */
    public function cancelAppointment($appointmentId, $reason)
    {
        $updateData = [
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
            'cancelled_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $appointmentId);
        $this->db->update($this->table, $updateData);

        return $this->db->affected_rows() > 0;
    }

    /**
     * Get available time slots for a doctor on a specific date
     */
    public function getAvailableTimeSlots($doctorId, $date)
    {
        $allSlots = $this->getTimeSlots();
        $bookedSlots = $this->getBookedSlots($doctorId, $date);
        
        $availableSlots = [];
        foreach ($allSlots as $slot) {
            if (!in_array($slot['value'], $bookedSlots)) {
                $availableSlots[] = $slot;
            }
        }
        
        return $availableSlots;
    }

    /**
     * Get appointments for export
     */
    public function getAppointmentsForExport($filters = [])
    {
        $this->buildQuery($filters);
        
        $this->db->select('a.*, d.name as doctor_name, c.center_name');
        $this->db->from($this->table . ' a');
        $this->db->join($this->db_prefix . 'doctors d', 'd.id = a.doctor_id', 'left');
        $this->db->join($this->db_prefix . 'centers c', 'c.id = a.center_id', 'left');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get daily appointments
     */
    public function getDailyAppointments($date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        $this->db->select('a.*, d.name as doctor_name, c.center_name');
        $this->db->from($this->table . ' a');
        $this->db->join($this->db_prefix . 'doctors d', 'd.id = a.doctor_id', 'left');
        $this->db->join($this->db_prefix . 'centers c', 'c.id = a.center_id', 'left');
        $this->db->where('DATE(a.appointment_date)', $date);
        $this->db->order_by('a.appointment_time', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get time slots configuration
     */
    public function getTimeSlots()
    {
        return [
            ['value' => '09:00', 'label' => '9:00 AM'],
            ['value' => '09:30', 'label' => '9:30 AM'],
            ['value' => '10:00', 'label' => '10:00 AM'],
            ['value' => '10:30', 'label' => '10:30 AM'],
            ['value' => '11:00', 'label' => '11:00 AM'],
            ['value' => '11:30', 'label' => '11:30 AM'],
            ['value' => '12:00', 'label' => '12:00 PM'],
            ['value' => '12:30', 'label' => '12:30 PM'],
            ['value' => '14:00', 'label' => '2:00 PM'],
            ['value' => '14:30', 'label' => '2:30 PM'],
            ['value' => '15:00', 'label' => '3:00 PM'],
            ['value' => '15:30', 'label' => '3:30 PM'],
            ['value' => '16:00', 'label' => '4:00 PM'],
            ['value' => '16:30', 'label' => '4:30 PM'],
            ['value' => '17:00', 'label' => '5:00 PM'],
            ['value' => '17:30', 'label' => '5:30 PM']
        ];
    }

    // Private helper methods

    private function buildQuery($filters)
    {
        $this->db->select('a.*, d.name as doctor_name, c.center_name');
        $this->db->from($this->table . ' a');
        $this->db->join($this->db_prefix . 'doctors d', 'd.id = a.doctor_id', 'left');
        $this->db->join($this->db_prefix . 'centers c', 'c.id = a.center_id', 'left');

        // Apply filters
        if (!empty($filters['status'])) {
            $this->db->where('a.status', $filters['status']);
        }

        if (!empty($filters['doctor_id'])) {
            $this->db->where('a.doctor_id', $filters['doctor_id']);
        }

        if (!empty($filters['center_id'])) {
            $this->db->where('a.center_id', $filters['center_id']);
        }

        if (!empty($filters['patient_name'])) {
            $this->db->like('a.patient_name', $filters['patient_name']);
        }

        if (!empty($filters['patient_phone'])) {
            $this->db->like('a.patient_phone', $filters['patient_phone']);
        }

        if (!empty($filters['start_date'])) {
            $this->db->where('DATE(a.appointment_date) >=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $this->db->where('DATE(a.appointment_date) <=', $filters['end_date']);
        }

        if (!empty($filters['patient_type'])) {
            $this->db->where('a.patient_type', $filters['patient_type']);
        }
    }

    private function isDuplicateAppointment($data)
    {
        $this->db->where('patient_phone', $data['patient_phone']);
        $this->db->where('doctor_id', $data['doctor_id']);
        $this->db->where('appointment_date', $data['appointment_date']);
        $this->db->where('appointment_time', $data['appointment_time']);
        $this->db->where('status !=', 'cancelled');

        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    private function isTimeSlotAvailable($date, $time, $excludeAppointmentId = null)
    {
        $this->db->where('appointment_date', $date);
        $this->db->where('appointment_time', $time);
        $this->db->where('status !=', 'cancelled');

        if ($excludeAppointmentId) {
            $this->db->where('id !=', $excludeAppointmentId);
        }

        $query = $this->db->get($this->table);
        return $query->num_rows() == 0;
    }

    private function getBookedSlots($doctorId, $date)
    {
        $this->db->select('appointment_time');
        $this->db->where('doctor_id', $doctorId);
        $this->db->where('appointment_date', $date);
        $this->db->where('status !=', 'cancelled');

        $query = $this->db->get($this->table);
        $result = $query->result_array();
        
        return array_column($result, 'appointment_time');
    }
}
