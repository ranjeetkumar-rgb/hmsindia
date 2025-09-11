<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentApi extends CI_Controller {

    private $auth_token = "your-secure-token-here"; // Change this to your secure token

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['form', 'url', 'myhelper']);
        $this->load->model([
            'ModernAppointmentModel', 
            'Billingmodel_model', 
            'Doctors_model', 
            'Center_model',
            'Camp_model',
            'NotificationModel'
        ]);
        
        // Set JSON response headers
        $this->output->set_content_type('application/json');
    }

    /**
     * Authenticate API request
     */
    private function authenticate()
    {
        $headers = $this->input->request_headers();
        $token = isset($headers['Auth-Token']) ? $headers['Auth-Token'] : 
                (isset($headers['auth-token']) ? $headers['auth-token'] : 
                $this->input->get_request_header('Auth-Token'));
        
        if (!$token || $token !== $this->auth_token) {
            $this->output
                ->set_status_header(401)
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Unauthorized access'
                ]));
            return false;
        }
        
        return true;
    }

    /**
     * Create appointment via API
     */
    public function create()
    {
        if (!$this->authenticate()) {
            return;
        }

        $this->load->library('form_validation');
        
        // Set validation rules
        $this->form_validation->set_rules('patient_name', 'Patient Name', 'required|trim');
        $this->form_validation->set_rules('patient_phone', 'Patient Phone', 'required|trim|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('patient_email', 'Patient Email', 'valid_email');
        $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required');
        $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');
        $this->form_validation->set_rules('doctor_id', 'Doctor', 'required');
        $this->form_validation->set_rules('center_id', 'Center', 'required');
        $this->form_validation->set_rules('reason_of_visit', 'Reason of Visit', 'required');

        if ($this->form_validation->run() === FALSE) {
            $response = [
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $this->form_validation->error_array()
            ];
        } else {
            // Prepare appointment data
            $appointmentData = [
                'patient_name' => $this->input->post('patient_name'),
                'patient_phone' => $this->input->post('patient_phone'),
                'patient_email' => $this->input->post('patient_email'),
                'spouse_name' => $this->input->post('spouse_name'),
                'appointment_date' => $this->input->post('appointment_date'),
                'appointment_time' => $this->input->post('appointment_time'),
                'doctor_id' => $this->input->post('doctor_id'),
                'center_id' => $this->input->post('center_id'),
                'reason_of_visit' => $this->input->post('reason_of_visit'),
                'lead_source' => $this->input->post('lead_source'),
                'sub_lead_source' => $this->input->post('sub_lead_source'),
                'camp_id' => $this->input->post('camp_id'),
                'nationality' => $this->input->post('nationality'),
                'patient_type' => $this->input->post('patient_type'),
                'crm_id' => $this->input->post('crm_id'),
                'notes' => $this->input->post('notes'),
                'status' => 'booked',
                'created_by' => 0, // API user
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Create appointment
            $appointmentId = $this->ModernAppointmentModel->createAppointment($appointmentData);
            
            if ($appointmentId) {
                // Send notifications
                $appointment = $this->ModernAppointmentModel->getAppointmentById($appointmentId);
                $this->NotificationModel->sendAppointmentConfirmation($appointment);
                
                $response = [
                    'status' => true,
                    'message' => 'Appointment created successfully',
                    'data' => [
                        'appointment_id' => $appointmentId,
                        'appointment' => $appointment
                    ]
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to create appointment'
                ];
            }
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Get appointments via API
     */
    public function getAppointments()
    {
        if (!$this->authenticate()) {
            return;
        }

        $filters = [
            'status' => $this->input->get('status'),
            'doctor_id' => $this->input->get('doctor_id'),
            'center_id' => $this->input->get('center_id'),
            'start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date'),
            'patient_name' => $this->input->get('patient_name'),
            'patient_phone' => $this->input->get('patient_phone'),
            'page' => $this->input->get('page') ?: 1,
            'limit' => $this->input->get('limit') ?: 10
        ];

        $appointments = $this->ModernAppointmentModel->getAppointments($filters);
        $total = $this->ModernAppointmentModel->getAppointmentsCount($filters);

        $response = [
            'status' => true,
            'data' => $appointments,
            'total' => $total,
            'page' => $filters['page'],
            'limit' => $filters['limit'],
            'total_pages' => ceil($total / $filters['limit'])
        ];

        $this->output->set_output(json_encode($response));
    }

    /**
     * Get appointment details via API
     */
    public function getDetails($id)
    {
        if (!$this->authenticate()) {
            return;
        }

        $appointment = $this->ModernAppointmentModel->getAppointmentById($id);
        
        if (empty($appointment)) {
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Appointment not found'
                ]));
            return;
        }

        $response = [
            'status' => true,
            'data' => $appointment
        ];

        $this->output->set_output(json_encode($response));
    }

    /**
     * Update appointment status via API
     */
    public function updateStatus()
    {
        if (!$this->authenticate()) {
            return;
        }

        $appointment_id = $this->input->post('appointment_id');
        $status = $this->input->post('status');
        $reason = $this->input->post('reason');

        if (empty($appointment_id) || empty($status)) {
            $response = [
                'status' => false,
                'message' => 'Missing required parameters'
            ];
        } else {
            $updateData = [
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($status === 'cancelled') {
                $updateData['cancellation_reason'] = $reason;
                $updateData['cancelled_at'] = date('Y-m-d H:i:s');
            } elseif ($status === 'rescheduled') {
                $updateData['reschedule_reason'] = $reason;
            }

            $result = $this->ModernAppointmentModel->updateAppointment($appointment_id, $updateData);

            if ($result) {
                // Send status update notifications
                $appointment = $this->ModernAppointmentModel->getAppointmentById($appointment_id);
                $this->NotificationModel->sendStatusUpdate($appointment, $status);
                
                $response = [
                    'status' => true,
                    'message' => 'Appointment status updated successfully'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to update appointment status'
                ];
            }
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Reschedule appointment via API
     */
    public function reschedule()
    {
        if (!$this->authenticate()) {
            return;
        }

        $appointment_id = $this->input->post('appointment_id');
        $new_date = $this->input->post('new_date');
        $new_time = $this->input->post('new_time');
        $reason = $this->input->post('reason');

        if (empty($appointment_id) || empty($new_date) || empty($new_time)) {
            $response = [
                'status' => false,
                'message' => 'Missing required parameters'
            ];
        } else {
            $updateData = [
                'appoitmented_date' => $new_date,
                'appoitmented_slot' => $new_time,
                'reschedule_reason' => $reason,
                'status' => 'rescheduled',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $result = $this->ModernAppointmentModel->updateAppointment($appointment_id, $updateData);

            if ($result) {
                // Send reschedule notifications
                $appointment = $this->ModernAppointmentModel->getAppointmentById($appointment_id);
                $this->NotificationModel->sendRescheduleNotification($appointment);
                
                $response = [
                    'status' => true,
                    'message' => 'Appointment rescheduled successfully'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to reschedule appointment'
                ];
            }
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Cancel appointment via API
     */
    public function cancel()
    {
        if (!$this->authenticate()) {
            return;
        }

        $appointment_id = $this->input->post('appointment_id');
        $reason = $this->input->post('reason');

        if (empty($appointment_id)) {
            $response = [
                'status' => false,
                'message' => 'Missing appointment ID'
            ];
        } else {
            $updateData = [
                'status' => 'cancelled',
                'cancellation_reason' => $reason,
                'cancelled_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $result = $this->ModernAppointmentModel->updateAppointment($appointment_id, $updateData);

            if ($result) {
                // Send cancellation notifications
                $appointment = $this->ModernAppointmentModel->getAppointmentById($appointment_id);
                $this->NotificationModel->sendCancellationNotification($appointment);
                
                $response = [
                    'status' => true,
                    'message' => 'Appointment cancelled successfully'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to cancel appointment'
                ];
            }
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Get available time slots via API
     */
    public function getAvailableSlots()
    {
        if (!$this->authenticate()) {
            return;
        }

        $doctor_id = $this->input->get('doctor_id');
        $date = $this->input->get('date');
        
        if (empty($doctor_id) || empty($date)) {
            $response = [
                'status' => false,
                'message' => 'Doctor ID and date are required'
            ];
        } else {
            $slots = $this->ModernAppointmentModel->getAvailableSlots($doctor_id, $date);
            $response = [
                'status' => true,
                'data' => $slots
            ];
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * LeadSquare integration
     */
    public function leadsquareIntegration()
    {
        if (!$this->authenticate()) {
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data) {
            $response = [
                'status' => false,
                'message' => 'Invalid JSON data'
            ];
        } else {
            // Process LeadSquare data
            $appointmentData = [
                'patient_name' => $data['FirstName'] ?? '',
                'patient_phone' => str_replace("+91-", "", $data['Phone'] ?? ''),
                'patient_email' => $data['EmailAddress'] ?? '',
                'spouse_name' => $data['HusbandName'] ?? '',
                'appointment_date' => $data['Fields']['mx_appoitmented_date'] ?? '',
                'appointment_time' => $data['Fields']['mx_appoitmented_slot'] ?? '',
                'doctor_id' => $data['Fields']['mx_Doctor'] ?? '',
                'center_id' => $data['Fields']['mx_Centre_Location'] ?? '',
                'reason_of_visit' => $data['ActivityNote'] ?? '',
                'lead_source' => 'LeadSquare',
                'crm_id' => $data['LeadID'] ?? '',
                'patient_type' => 'new_patient',
                'status' => 'booked',
                'created_by' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Create appointment
            $appointmentId = $this->ModernAppointmentModel->createAppointment($appointmentData);
            
            if ($appointmentId) {
                // Send notifications
                $appointment = $this->ModernAppointmentModel->getAppointmentById($appointmentId);
                $this->NotificationModel->sendAppointmentConfirmation($appointment);
                
                $response = [
                    'status' => true,
                    'message' => 'Appointment created successfully from LeadSquare',
                    'data' => [
                        'appointment_id' => $appointmentId,
                        'appointment' => $appointment
                    ]
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to create appointment from LeadSquare'
                ];
            }
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Search patient via API
     */
    public function searchPatient()
    {
        if (!$this->authenticate()) {
            return;
        }

        $search_this = $this->input->post('search_this');
        $search_by = $this->input->post('search_by');
        
        if (empty($search_this)) {
            $response = [
                'status' => false,
                'message' => 'Please enter phone number or IIC ID'
            ];
        } else {
            // Check if appointment already exists
            $existingAppointment = $this->ModernAppointmentModel->searchAppointment($search_this, $search_by);
            if (!empty($existingAppointment)) {
                $response = [
                    'status' => 'appointment_booked',
                    'message' => 'Appointment already booked for this patient'
                ];
            } else {
                // Search for existing patient
                $patient = $this->ModernAppointmentModel->searchPatient($search_this, $search_by);
                
                if (!empty($patient)) {
                    $response = [
                        'status' => 'exist_patient',
                        'message' => 'Patient found',
                        'data' => $patient
                    ];
                } else {
                    $response = [
                        'status' => 'new_patient',
                        'message' => 'New patient - please fill details'
                    ];
                }
            }
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Get doctors by center via API
     */
    public function getDoctorsByCenter()
    {
        if (!$this->authenticate()) {
            return;
        }

        $center_id = $this->input->post('center_id');
        
        if (empty($center_id)) {
            $response = [
                'status' => false,
                'message' => 'Center ID is required',
                'data' => []
            ];
        } else {
            $doctors = $this->ModernAppointmentModel->getDoctorsByCenter($center_id);
            $response = [
                'status' => true,
                'data' => $doctors
            ];
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Get camps by center via API
     */
    public function getCampsByCenter()
    {
        if (!$this->authenticate()) {
            return;
        }

        $center_id = $this->input->post('center_id');
        
        if (empty($center_id)) {
            $response = [
                'status' => false,
                'message' => 'Center ID is required',
                'data' => []
            ];
        } else {
            $camps = $this->Camp_model->get_camps_by_center($center_id);
            $response = [
                'status' => true,
                'data' => $camps
            ];
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Create camp via API
     */
    public function createCamp()
    {
        if (!$this->authenticate()) {
            return;
        }

        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('camp_name', 'Camp Name', 'required|trim');
        $this->form_validation->set_rules('center_id', 'Center', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $response = [
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $this->form_validation->error_array()
            ];
        } else {
            $campData = [
                'camp_name' => $this->input->post('camp_name'),
                'camp_description' => $this->input->post('camp_description'),
                'center_id' => $this->input->post('center_id'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $campId = $this->Camp_model->createCamp($campData);
            
            if ($campId) {
                $response = [
                    'status' => true,
                    'message' => 'Camp created successfully',
                    'data' => [
                        'camp_id' => $campId
                    ]
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to create camp'
                ];
            }
        }

        $this->output->set_output(json_encode($response));
    }
}