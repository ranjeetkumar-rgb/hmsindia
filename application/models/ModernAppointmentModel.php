<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModernAppointmentModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Create new appointment
     */
    public function createAppointment($data)
    {
        // Remove fields that don't exist in the appointments table
        $fields_to_remove = ['camp_selection', 'camp_name', 'camp_description', 'start_date', 'end_date'];
        foreach($fields_to_remove as $field) {
            if(isset($data[$field])) {
                unset($data[$field]);
            }
        }
        $appointmentData = $this->prepareAppointmentData($data);
        if ($this->hasAppointmentConflict($appointmentData)) {
            return false;
        }
        $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "appointments` SET ";
        $sqlArr = array();
        foreach ($appointmentData as $key => $value) {
            $sqlArr[] = " $key = '" . addslashes($value) . "'";
        }
        $sql .= implode(',', $sqlArr);
        
        $res = $this->db->query($sql);
        if ($res) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * Get appointment by ID
     */
    public function getAppointmentById($id)
    {
        $sql = "SELECT a.*, d.name as doctor_name, c.center_name 
                FROM " . $this->config->item('db_prefix') . "appointments a
                LEFT JOIN " . $this->config->item('db_prefix') . "doctors d ON a.appoitmented_doctor = d.ID
                LEFT JOIN " . $this->config->item('db_prefix') . "centers c ON a.appoitment_for = c.center_number
                WHERE a.ID = ?";
        $query = $this->db->query($sql, [$id]);
        return $query->row_array();
    }

    /**
     * Get appointments with filters and pagination
     */
    public function getAppointments($filters = [], $usePagination = true)
    {
        $conditions = $this->buildWhereConditions($filters);
        $sql = "SELECT a.*, d.name as doctor_name, c.center_name 
                FROM " . $this->config->item('db_prefix') . "appointments a
                LEFT JOIN " . $this->config->item('db_prefix') . "doctors d ON a.appoitmented_doctor = d.ID
                LEFT JOIN " . $this->config->item('db_prefix') . "centers c ON a.appoitment_for = c.center_number
                WHERE 1=1 " . $conditions . "
                ORDER BY a.appoitmented_date DESC";
        if ($usePagination && isset($filters['limit']) && isset($filters['offset'])) {
            $sql .= " LIMIT " . $filters['offset'] . ", " . $filters['limit'];
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get appointments count for pagination
     */
    public function getAppointmentsCount($filters = [])
    {
        $conditions = $this->buildWhereConditions($filters);
        $sql = "SELECT COUNT(*) as total 
                FROM " . $this->config->item('db_prefix') . "appointments a
                WHERE 1=1 " . $conditions;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['total'];
    }

    /**
     * Update appointment
     */
    public function updateAppointment($id, $data)
    {
        $sql = "UPDATE " . $this->config->item('db_prefix') . "appointments SET ";
        $sqlArr = array();
        foreach ($data as $key => $value) {
            $sqlArr[] = " $key = '" . addslashes($value) . "'";
        }
        $sql .= implode(',', $sqlArr);
        $sql .= " WHERE ID = '" . $id . "'";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    /**
     * Search patient by phone or IIC ID
     */
    public function searchPatient($search_this, $search_by)
    {
        if ($search_by === 'phone') {
            $sql = "SELECT * FROM " . $this->config->item('db_prefix') . "patients 
                    WHERE wife_phone = ? LIMIT 1";
        } else {
            $sql = "SELECT * FROM " . $this->config->item('db_prefix') . "patients 
                    WHERE patient_id = ? LIMIT 1";
        }
        
        $query = $this->db->query($sql, [$search_this]);
        return $query->row_array();
    }

    /**
     * Search existing appointment
     */
    public function searchAppointment($search_this, $search_by)
    {
        if ($search_by === 'phone') {
            $sql = "SELECT * FROM " . $this->config->item('db_prefix') . "appointments 
                    WHERE wife_phone = ? AND status != 'cancelled' LIMIT 1";
        } else {
            $sql = "SELECT * FROM " . $this->config->item('db_prefix') . "appointments 
                    WHERE paitent_id = ? AND status != 'cancelled' LIMIT 1";
        }
        $query = $this->db->query($sql, [$search_this]);
        return $query->row_array();
    }

    /**
     * Get doctors by center
     */
    public function getDoctorsByCenter($center_id)
    {
        $sql = "SELECT * FROM " . $this->config->item('db_prefix') . "doctors 
                WHERE center_id = ? AND status = 'active' 
                ORDER BY name ASC";
        $query = $this->db->query($sql, [$center_id]);
        return $query->result_array();
    }

    /**
     * Get available time slots for doctor and date
     */
    public function getAvailableSlots($doctor_id, $date)
    {
        // Get all time slots
        $allSlots = $this->getTimeSlots();
        // Get booked slots for the doctor on the given date
        $sql = "SELECT appoitmented_slot FROM " . $this->config->item('db_prefix') . "appointments 
                WHERE appoitmented_doctor = ? 
                AND DATE(appoitmented_date) = ? 
                AND status NOT IN ('cancelled', 'no_show')";
        $query = $this->db->query($sql, [$doctor_id, $date]);
        $bookedSlots = $query->result_array();
        $bookedTimes = array_column($bookedSlots, 'appoitmented_slot');
        // Filter out booked slots
        $availableSlots = array_filter($allSlots, function($slot) use ($bookedTimes) {
            return !in_array($slot['value'], $bookedTimes);
        });
        
        return array_values($availableSlots);
    }

    /**
     * Get doctor referrals
     */
    public function getDoctorReferrals()
    {
        $sql = "SELECT * FROM " . $this->config->item('db_prefix') . "doctor_referral 
                WHERE status = 'active' 
                ORDER BY doctor_name ASC";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Check if appointment has conflict
     */
    private function hasAppointmentConflict($data)
    {
        if (!isset($data['appoitmented_doctor']) || !isset($data['appoitmented_date']) || !isset($data['appoitmented_slot'])) {
            return false;
        }
        
        $sql = "SELECT COUNT(*) as count FROM " . $this->config->item('db_prefix') . "appointments 
                WHERE appoitmented_doctor = ? 
                AND DATE(appoitmented_date) = ? 
                AND appoitmented_slot = ? 
                AND status NOT IN ('cancelled', 'no_show')";
        
        $query = $this->db->query($sql, [
            $data['appoitmented_doctor'],
            $data['appoitmented_date'],
            $data['appoitmented_slot']
        ]);
        
        $result = $query->row_array();
        return $result['count'] > 0;
    }

    /**
     * Prepare appointment data for database
     */
    private function prepareAppointmentData($data)
    {
        $appointmentData = [
            'paitent_id' => $data['patient_id'] ?? $this->generatePatientId(),
            'paitent_type' => $data['patient_type'] ?? 'new_patient',
            'wife_name' => $data['wife_name'] ?? '',
            'husband_name' => $data['husband_name'] ?? '',
            'wife_phone' => $data['wife_phone'] ?? '',
            'wife_email' => $data['wife_email'] ?? '',
            'nationality' => $data['nationality'] ?? 'indian',
            'reason_of_visit' => $data['reason_of_visit'] ?? '',
            'appoitment_for' => $data['appoitment_for'] ?? '',
            'appoitmented_doctor' => $data['appoitmented_doctor'] ?? '',
            'appoitmented_date' => $data['appoitmented_date'] ?? '',
            'appoitmented_slot' => $data['appoitmented_slot'] ?? '',
            'camp_center' => $data['camp_center'] ?? '',
            'lead_source' => $data['lead_source'] ?? '',
            'uhid' => $data['uhid'] ?? '',
            'sub_lead_source' => $data['sub_lead_source'] ?? '',
            'crm_id' => $data['crm_id'] ?? '',
            'iic_id' => $data['iic_id'] ?? '',
            'isd_code' => $data['isd_code'] ?? '',
            'patient_id' => $data['patient_id'] ?? '',
            'notes' => $data['notes'] ?? '',
            'status' => $data['status'] ?? 'booked',
            'appointment_added' => $data['created_at'] ?? date('Y-m-d H:i:s')
        ];

        // Remove empty values
        return array_filter($appointmentData, function($value) {
            return $value !== '' && $value !== null;
        });
    }

    /**
     * Build WHERE conditions for queries
     */
    private function buildWhereConditions($filters)
    {
        $conditions = '';
        
        if (!empty($filters['status'])) {
            $conditions .= " AND a.status = '" . addslashes($filters['status']) . "'";
        }
        if (!empty($filters['doctor_id'])) {
            $conditions .= " AND a.appoitmented_doctor = '" . addslashes($filters['doctor_id']) . "'";
        }
        if (!empty($filters['center_id'])) {
            $conditions .= " AND a.appoitment_for = '" . addslashes($filters['center_id']) . "'";
        }
        if (!empty($filters['patient_name'])) {
            $conditions .= " AND (a.wife_name LIKE '%" . addslashes($filters['patient_name']) . "%' OR a.wife_phone LIKE '%" . addslashes($filters['patient_name']) . "%')";
        }
        if (!empty($filters['patient_phone'])) {
            $conditions .= " AND a.wife_phone LIKE '%" . addslashes($filters['patient_phone']) . "%'";
        }
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $conditions .= " AND DATE(a.appoitmented_date) BETWEEN '" . addslashes($filters['start_date']) . "' AND '" . addslashes($filters['end_date']) . "'";
        } elseif (!empty($filters['start_date'])) {
            $conditions .= " AND DATE(a.appoitmented_date) = '" . addslashes($filters['start_date']) . "'";
        } elseif (!empty($filters['end_date'])) {
            $conditions .= " AND DATE(a.appoitmented_date) = '" . addslashes($filters['end_date']) . "'";
        }
        if (!empty($filters['patient_type'])) {
            $conditions .= " AND a.paitent_type = '" . addslashes($filters['patient_type']) . "'";
        }
        if (!empty($filters['crm_id'])) {
            $conditions .= " AND a.crm_id = '" . addslashes($filters['crm_id']) . "'";
        }
        if (!empty($filters['patient_id'])) {
            $conditions .= " AND a.paitent_id = '" . addslashes($filters['patient_id']) . "'";
        }
        return $conditions;
    }

    /**
     * Get all available time slots
     */
    private function getTimeSlots()
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

    /**
     * Generate unique patient ID
     */
    private function generatePatientId()
    {
        return 'PAT' . date('Ymd') . rand(1000, 9999);
    }

    /**
     * Get appointment statistics
     */
    public function getAppointmentStats($filters = [])
    {
        $conditions = $this->buildWhereConditions($filters);
        $sql = "SELECT 
                    COUNT(*) as total_appointments,
                    SUM(CASE WHEN status = 'booked' THEN 1 ELSE 0 END) as booked,
                    SUM(CASE WHEN status = 'visited' THEN 1 ELSE 0 END) as visited,
                    SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled,
                    SUM(CASE WHEN status = 'no_show' THEN 1 ELSE 0 END) as no_show,
                    SUM(CASE WHEN status = 'rescheduled' THEN 1 ELSE 0 END) as rescheduled
                FROM " . $this->config->item('db_prefix') . "appointments a
                WHERE 1=1 " . $conditions;
        
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    /**
     * Get appointments by date range
     */
    public function getAppointmentsByDateRange($start_date, $end_date, $center_id = null)
    {
        $conditions = " AND DATE(a.appoitmented_date) BETWEEN ? AND ?";
        $params = [$start_date, $end_date];
        if ($center_id) {
            $conditions .= " AND a.appoitment_for = ?";
            $params[] = $center_id;
        }
        $sql = "SELECT a.*, d.name as doctor_name, c.center_name 
                FROM " . $this->config->item('db_prefix') . "appointments a
                LEFT JOIN " . $this->config->item('db_prefix') . "doctors d ON a.appoitmented_doctor = d.ID
                LEFT JOIN " . $this->config->item('db_prefix') . "centers c ON a.appoitment_for = c.center_number
                WHERE 1=1 " . $conditions . "
                ORDER BY a.appoitmented_date ASC, a.appoitmented_slot ASC";
        
        $query = $this->db->query($sql, $params);
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
        $sql = "SELECT a.*, d.name as doctor_name, c.center_name 
                FROM " . $this->config->item('db_prefix') . "appointments a
                LEFT JOIN " . $this->config->item('db_prefix') . "doctors d ON a.appoitmented_doctor = d.ID
                LEFT JOIN " . $this->config->item('db_prefix') . "centers c ON a.appoitment_for = c.center_number
                WHERE DATE(a.appoitmented_date) = ?
                ORDER BY a.appoitmented_slot ASC";
        $query = $this->db->query($sql, [$date]);
        return $query->result_array();
    }
}
