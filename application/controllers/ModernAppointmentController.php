<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModernAppointmentController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['form', 'url', 'myhelper']);
        $this->load->library(['session', 'pagination']);
        $this->load->model([
            'ModernAppointmentModel', 
            'Billingmodel_model', 
            'Doctors_model', 
            'Center_model',
            'Camp_model',
            'NotificationModel',
            'doctors_model',
            'center_model',
            'appointment_model'
        ]);
        // Check authentication
        $this->checkAuth();
    }

    private function checkAuth()
    {
        $logg = checklogin();
        if (!$logg['status']) {
            redirect('login');
        }
    }

    /**
     * Modern Appointments Dashboard
     */
    public function dashboard()
    {
        $logg = checklogin();
        if($logg['status'] == true){
            $data = array();
            $data['doctors'] = $this->center_doctors();
            $data['centers'] = $this->get_center_list();
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('appointments/modern_dashboard', $data);
            $this->load->view($template['footer']);
        }else{
            header("location:" .base_url(). "");
            die();
        }
    }

    /**
     * Modern Appointments Calendar View
     */
    public function calendar()
    {
        $logg = checklogin();
        if($logg['status'] == true){
            $data = array();
            $data['doctors'] = $this->center_doctors();
            $data['centers'] = $this->get_center_list();
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('appointments/modern_calendar', $data);
            $this->load->view($template['footer']);
        }else{
            header("location:" .base_url(). "");
            die();
        }
    }

    /**
     * Modern Appointments Reports
     */
    public function reports()
    {
        $logg = checklogin();
        if($logg['status'] == true){
            $data = array();
            $data['doctors'] = $this->center_doctors();
            $data['centers'] = $this->get_center_list();
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('appointments/modern_reports', $data);
            $this->load->view($template['footer']);
        }else{
            header("location:" .base_url(). "");
            die();
        }
    }

    /**
     * Modern Appointments Settings
     */
    public function settings()
    {
        $logg = checklogin();
        if($logg['status'] == true){
            $data = array();
            $data['doctors'] = $this->center_doctors();
            $data['centers'] = $this->get_center_list();
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('appointments/modern_settings', $data);
            $this->load->view($template['footer']);
        }else{
            header("location:" .base_url(). "");
            die();
        }
    }

    /**
     * Main modern appointments create page
     */
    public function create()
    {
        $logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['doctors'] = $this->center_doctors();
			$data['centers'] = $this->get_center_list();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('appointments/modern_create', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
    }
    function center_doctors(){
		$center = $_SESSION['logged_billing_manager']['center'];
		$doctor_list = $this->doctors_model->get_center_doctors($center);
		return $doctor_list;
	}
	function doctor_name($doctor_id){
		$doctor_name = $this->doctors_model->get_doctor_data($doctor_id);
		if(!empty($doctor_name)){
		    return $doctor_name['name'];
		}else { return "";};
	}
	
	function get_center_list(){
		$center = $this->center_model->get_centers();
		return $center;
	}
	
	function all_appointments()
	{
	    try{
               $data = $this->input->get();
                if (!empty($data['first_name'])) 
                {
                   if (!empty($data['last_name'])) 
                   {
                        if (!empty($data['mobile_number'])) 
                        {
                            if (!empty($data['email'])) 
                            {
                            $Json['status']=200;
                            $Json['message']='Data Fetched successfully';
                            return $this->output
                                    ->set_content_type('application/json')
                                    ->set_status_header(200)
                                    ->set_output(json_encode($Json));
                    
                            }else
                            {
                                $Json['status']=400;
                                $Json['message']='Email id is Required';
                                return $this->output
                                        ->set_content_type('application/json')
                                        ->set_status_header(200)
                                        ->set_output(json_encode($Json));
                            } 

                        }else
                        {
                            $Json['status']=400;
                            $Json['message']='Mobile no is Required';
                            return $this->output
                                    ->set_content_type('application/json')
                                    ->set_status_header(200)
                                    ->set_output(json_encode($Json));
                        } 
                    
                    }else
                    {
                        $Json['status']=400;
                        $Json['message']='Last name is Required';
                        return $this->output
                                ->set_content_type('application/json')
                                ->set_status_header(200)
                                ->set_output(json_encode($Json));
                    } 

                }else
                {
                    $Json['status']=400;
                    $Json['message']='First name is Required';
                    return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(200)
                            ->set_output(json_encode($Json));
                } 
            
            } catch(Throwable $e)
            {
                $msg = 'Server Down Something went wrong';
                $description = $e->getMessage(); 
                $Json['status'] = 400;
                $Json['msg'] = $msg; 
                return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(200)
                            ->set_output(json_encode($Json));
            }
	}

    /**
     * Create new appointment
     */
    public function createAppointment()
    {
        $this->load->library('form_validation');
        // Set validation rules
        $this->form_validation->set_rules('wife_name', 'Patient Name', 'required|trim');
        $this->form_validation->set_rules('wife_phone', 'Patient Phone', 'required|trim|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('wife_email', 'Patient Email', 'valid_email');
        $this->form_validation->set_rules('appoitment_for', 'Center', 'required');
        $this->form_validation->set_rules('reason_of_visit', 'Reason of Visit', 'required');
        $this->form_validation->set_rules('lead_source', 'Lead Source', 'required');
        // Optional fields based on lead source
        if ($this->input->post('lead_source') == 'Camp') {
            $this->form_validation->set_rules('camp_center', 'Camp Center', 'required');
        }
        if ($this->input->post('lead_source') == 'Doctor-Referral') {
            $this->form_validation->set_rules('sub_lead_source', 'Doctor Name', 'required');
        }
        
        // Appointment details (only required if not a camp appointment)
        if ($this->input->post('lead_source') != 'Camp') {
            $this->form_validation->set_rules('appoitmented_doctor', 'Doctor', 'required');
            $this->form_validation->set_rules('appoitmented_date', 'Appointment Date', 'required');
            $this->form_validation->set_rules('appoitmented_slot', 'Appointment Time', 'required');
        }
        
        if ($this->form_validation->run() === FALSE) {
            $response = [
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $this->form_validation->error_array()
            ];
        } else {
            // Prepare appointment data (following billing controller pattern)
            $appointmentData = [
                'wife_name' => $this->input->post('wife_name'),
                'wife_phone' => $this->input->post('wife_phone'),
                'wife_email' => $this->input->post('wife_email'),
                'husband_name' => $this->input->post('husband_name'),
                'appoitmented_date' => $this->input->post('appoitmented_date'),
                'appoitmented_slot' => $this->input->post('appoitmented_slot'),
                'appoitmented_doctor' => $this->input->post('appoitmented_doctor'),
                'appoitment_for' => $this->input->post('appoitment_for'),
                'reason_of_visit' => $this->input->post('reason_of_visit'),
                'lead_source' => $this->input->post('lead_source'),
                'camp_center' => $this->input->post('camp_center'),
                'sub_lead_source' => $this->input->post('sub_lead_source'),
                'nationality' => $this->input->post('nationality'),
                'patient_type' => $this->input->post('paitent_type'),
                'crm_id' => $this->input->post('crm_id'),
                'iic_id' => $this->input->post('iic_id'),
                'uhid'=>getGUID(),
                'isd_code' => $this->input->post('isd_code'),
                'appointment_for' => $this->input->post('appoitment_for'),
                'patient_id' => $this->input->post('paitent_id'),
                'notes' => $this->input->post('notes'),
                'status' => 'booked',
                'created_at' => date('Y-m-d H:i:s'),
                'appointment_added' => date('Y-m-d H:i:s')
            ];
            // Create appointment
            $appointmentId = $this->ModernAppointmentModel->createAppointment($appointmentData);
            if ($appointmentId) {
                // CRM Integration (following billing controller pattern)
                $this->integrateWithCRM($appointmentData);
                $appointment = $this->ModernAppointmentModel->getAppointmentById($appointmentId);
                $this->NotificationModel->sendAppointmentConfirmation($appointment);
                $response = [
                    'status' => true,
                    'message' => 'Appointment created successfully',
                    'appointment_id' => $appointmentId
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to create appointment'
                ];
            }
        }
        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            if ($response['status']) {
                $this->session->set_flashdata('success', $response['message']);
            } else {
                $this->session->set_flashdata('error', $response['message']);
            }
            redirect('modern-appointments/create');
        }
    }

    /**
     * Search patient by phone or IIC ID
     */
    public function searchPatient()
    {
        $search_this = $this->input->post('search_this');
        $search_by = $this->input->post('search_by');
        if (empty($search_this)) {
            echo json_encode([
                'status' => 0,
                'message' => 'Please enter phone number or IIC ID'
            ]);
            return;
        }
        // Check if appointment already exists
        $existingAppointment = $this->ModernAppointmentModel->searchAppointment($search_this, $search_by);
        if (!empty($existingAppointment)) {
            echo json_encode([
                'status' => 'appointment_booked',
                'message' => 'Appointment already booked for this patient'
            ]);
            return;
        }
        // Search for existing patient
        $patient = $this->ModernAppointmentModel->searchPatient($search_this, $search_by);
        if (!empty($patient)) {
            // Existing patient
            echo json_encode([
                'status' => 'exist_patient',
                'message' => 'Patient found',
                'patient' => $patient,
                'uhid' => $patient['patient_id']
            ]);
        } else {
            // New patient
            echo json_encode([
                'status' => 'new_patient',
                'message' => 'New patient - please fill details'
            ]);
        }
    }

    /**
     * Get doctors by center
     */
    public function getDoctorsByCenter()
    {
        $center_id = $this->input->post('center_id');
        if (empty($center_id)) {
            echo json_encode([]);
            return;
        }
        $doctors = $this->ModernAppointmentModel->getDoctorsByCenter($center_id);
        echo json_encode($doctors);
    }

    /**
     * Get available time slots for doctor and date
     */
    public function getAvailableSlots()
    {
        $doctor_id = $this->input->post('doctor_id');
        $date = $this->input->post('date');
        if (empty($doctor_id) || empty($date)) {
            echo json_encode([]);
            return;
        }
        $slots = $this->ModernAppointmentModel->getAvailableSlots($doctor_id, $date);
        echo json_encode($slots);
    }

    /**
     * Get camps by center
     */
    public function getCampsByCenter()
    {
        $center_id = $this->input->post('center_id');
        if (empty($center_id)) {
            echo '<option value="">No camps available</option>';
            return;
        }
        $camps = $this->Camp_model->get_camps_by_center($center_id);
        if (empty($camps)) {
            echo '<option value="">No camps available</option>';
        } else {
            echo '<option value="">Select Camp</option>';
            foreach ($camps as $camp) {
                echo '<option value="' . $camp['id'] . '">' . $camp['camp_name'] . '</option>';
            }
        }
    }

    /**
     * Create new camp
     */
    public function createCamp()
    {
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
                // Check for templates
                $templatesExist = $this->checkCampTemplates($campId);
                $response = [
                    'status' => true,
                    'message' => 'Camp created successfully',
                    'camp_id' => $campId,
                    'templates_exist' => $templatesExist
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Failed to create camp'
                ];
            }
        }

        echo json_encode($response);
    }

    /**
     * Check camp templates
     */
    public function checkCampTemplates($campId = null)
    {
        if ($campId === null) {
            $campId = $this->input->post('camp_id');
        }
        $templates = [
            'email_templates' => $this->checkEmailTemplates($campId),
            'sms_templates' => $this->checkSmsTemplates($campId),
            'consent_forms' => $this->checkConsentForms($campId)
        ];

        $templatesExist = !empty(array_filter($templates));
        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'status' => 'success',
                'templates_exist' => $templatesExist,
                'templates' => $templates
            ]);
        }

        return $templatesExist;
    }

    /**
     * Get appointment details
     */
    public function getDetails($id)
    {
        $appointment = $this->ModernAppointmentModel->getAppointmentById($id);
        if (empty($appointment)) {
            show_404();
        }
        $data = [
            'title' => 'Appointment Details',
            'appointment' => $appointment
        ];
        $template = get_header_template($this->session->userdata('role'));
        $this->load->view($template['header'], $data);
        $this->load->view('appointments/details', $data);
        $this->load->view($template['footer']);
    }

    /**
     * Update appointment status
     */
    public function updateStatus()
    {
        $appointment_id = $this->input->post('appointment_id');
        $status = $this->input->post('status');
        $reason = $this->input->post('reason');
        if (empty($appointment_id) || empty($status)) {
            echo json_encode([
                'status' => false,
                'message' => 'Missing required parameters'
            ]);
            return;
        }
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
            echo json_encode([
                'status' => true,
                'message' => 'Appointment status updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Failed to update appointment status'
            ]);
        }
    }

    /**
     * Reschedule appointment
     */
    public function reschedule()
    {
        $appointment_id = $this->input->post('appointment_id');
        $new_date = $this->input->post('new_date');
        $new_time = $this->input->post('new_time');
        $reason = $this->input->post('reason');
        if (empty($appointment_id) || empty($new_date) || empty($new_time)) {
            echo json_encode([
                'status' => false,
                'message' => 'Missing required parameters'
            ]);
            return;
        }
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
            echo json_encode([
                'status' => true,
                'message' => 'Appointment rescheduled successfully'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Failed to reschedule appointment'
            ]);
        }
    }

    /**
     * Cancel appointment
     */
    public function cancel()
    {
        $appointment_id = $this->input->post('appointment_id');
        $reason = $this->input->post('reason');
        if (empty($appointment_id)) {
            echo json_encode([
                'status' => false,
                'message' => 'Missing appointment ID'
            ]);
            return;
        }
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
            echo json_encode([
                'status' => true,
                'message' => 'Appointment cancelled successfully'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Failed to cancel appointment'
            ]);
        }
    }

    /**
     * Get appointments with filters
     */
    private function getFilters()
	{
		return [
			'status' => $this->input->get('status', TRUE),
			'doctor_id' => $this->input->get('doctor_id', TRUE),
			'center_id' => $this->input->get('center_id', TRUE),
			'patient_name' => $this->input->get('patient_name', TRUE),
			'patient_phone' => $this->input->get('patient_phone', TRUE),
			'start_date' => $this->input->get('start_date', TRUE),
			'end_date' => $this->input->get('end_date', TRUE),
			'patient_type' => $this->input->get('patient_type', TRUE),
			'crm_id' => $this->input->get('crm_id', TRUE),
			'patient_id' => $this->input->get('patient_id', TRUE) ?: null
		];
	}
    private function getCenter()
	{
		if (!empty($_SESSION['logged_billing_manager']['center'])) {
			return $_SESSION['logged_billing_manager']['center'];
		} elseif (!empty($_SESSION['logged_counselor']['center'])) {
			return $_SESSION['logged_counselor']['center'];
		}
		return null;
	}

    private function getPaginationData($total, $limit, $page)
    {
        $totalPages = ceil($total / $limit);
        return [
            'current_page' => $page,
            'total_pages' => $totalPages,
            'total_records' => $total,
            'limit' => $limit,
            'has_prev' => $page > 1,
            'has_next' => $page < $totalPages,
            'prev_page' => $page > 1 ? $page - 1 : null,
            'next_page' => $page < $totalPages ? $page + 1 : null
        ];
    }

    public function getAppointments()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			try {
				$filters = $this->getFilters();
				$page = $this->input->get('page', TRUE) ?: 1;
				$limit = $this->input->get('limit', TRUE) ?: 10;
				$center = $this->getCenter();
				// Convert page to offset for the existing model (which expects 0-based offset)
				$offset = ($page - 1) * $limit;
				$appointments = $this->appointment_model->my_appointments_pagination(
					$limit, 
					$offset, 
					$center, 
					$filters['start_date'], 
					$filters['end_date'], 
					$filters['patient_id'], 
					$filters['patient_name'], 
					$filters['status'], 
					$filters['doctor_id'], 
					$filters['patient_type'], 
					$filters['crm_id']
				);
				// Add doctor names to appointments
				foreach($appointments as $key => $appointment) {
					$appointments[$key]['doctor_name'] = $this->doctor_name($appointment['appoitmented_doctor']);
				}
				$total = $this->appointment_model->my_appointments_count(
					$center, 
					$filters['start_date'], 
					$filters['end_date'], 
					$filters['patient_id'], 
					$filters['patient_name'], 
					$filters['status'], 
					$filters['doctor_id'], 
					$filters['patient_type'], 
					$filters['crm_id']
				);
				$paginationData = $this->getPaginationData($total, $limit, $page);
				// Debug logging
				error_log("Pagination Debug - Page: $page, Limit: $limit, Total: $total, Offset: $offset");
				error_log("Pagination Data: " . json_encode($paginationData));
				error_log("Appointments Count: " . count($appointments));
				$response = [
					'status' => true, 
					'message' => 'Appointments retrieved successfully',
					'data' => [
						'appointments' => $appointments,
						'pagination' => $paginationData,
						'filters' => $filters
					]
				];
			} catch (Exception $e) {
				$response = ['status' => false, 'message' => 'Failed to retrieve appointments: ' . $e->getMessage()];
			}
		} else {
			$response = ['status' => false, 'message' => 'Authentication required'];
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
    // public function getAppointments()
    // {
    //     $filters = [
    //         'status' => $this->input->get('status'),
    //         'doctor_id' => $this->input->get('doctor_id'),
    //         'center_id' => $this->input->get('center_id'),
    //         'start_date' => $this->input->get('start_date'),
    //         'end_date' => $this->input->get('end_date'),
    //         'wife_name' => $this->input->get('wife_name'),
    //         'wife_phone' => $this->input->get('wife_phone'),
    //         'page' => $this->input->get('page') ?: 1,
    //         'limit' => $this->input->get('limit') ?: 10
    //     ];
    //     $appointments = $this->ModernAppointmentModel->getAppointments($filters);
    //     $total = $this->ModernAppointmentModel->getAppointmentsCount($filters);
    //     $response = [
    //         'status' => true,
    //         'data' => $appointments,
    //         'total' => $total,
    //         'page' => $filters['page'],
    //         'limit' => $filters['limit'],
    //         'total_pages' => ceil($total / $filters['limit'])
    //     ];
    //     echo json_encode($response);
    // }

    /**
     * Export appointments to CSV
     */
    public function export()
    {
        $filters = [
            'status' => $this->input->get('status'),
            'doctor_id' => $this->input->get('doctor_id'),
            'center_id' => $this->input->get('center_id'),
            'start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date'),
            'wife_name' => $this->input->get('wife_name'),
            'wife_phone' => $this->input->get('wife_phone')
        ];

        $appointments = $this->ModernAppointmentModel->getAppointments($filters, false); // Get all without pagination
        $filename = 'appointments_' . date('Y-m-d_H-i-s') . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
        // CSV headers
        fputcsv($output, [
            'ID', 'Patient Name', 'Phone', 'Email', 'Appointment Date', 
            'Appointment Time', 'Doctor', 'Center', 'Status', 'Reason', 
            'Lead Source', 'Created At'
        ]);
        // CSV data
        foreach ($appointments as $appointment) {
            fputcsv($output, [
                $appointment['ID'],
                $appointment['wife_name'],
                $appointment['wife_phone'],
                $appointment['wife_email'],
                $appointment['appoitmented_date'],
                $appointment['appoitmented_slot'],
                $appointment['doctor_name'],
                $appointment['center_name'],
                $appointment['status'],
                $appointment['reason_of_visit'],
                $appointment['lead_source'],
                $appointment['appointment_added']
            ]);
        }
        fclose($output);
    }

    // Private helper methods

    private function getLeadSources()
    {
        return [
            'Telecalling' => 'Telecalling',
            'Walk In' => 'Walk-in',
            'Doctor-Referral' => 'Doctor Referral',
            'International' => 'International',
            'Corporate' => 'Corporate',
            'Camp' => 'Camp',
            'D/S' => 'D/S',
            'Ayushpay' => 'Ayushpay',
            'Patient Referral' => 'Patient Referral'
        ];
    }

    private function getDoctorReferrals()
    {
        return $this->ModernAppointmentModel->getDoctorReferrals();
    }

    private function checkEmailTemplates($campId)
    {
        // Check if email templates exist for this camp
        $templatePath = FCPATH . 'application/email-templates/';
        return is_dir($templatePath) && count(glob($templatePath . '*')) > 0;
    }

    private function checkSmsTemplates($campId)
    {
        // Check if SMS templates exist for this camp
        // This is a placeholder - implement based on your SMS template system
        return false;
    }

    private function checkConsentForms($campId)
    {
        // Check if consent forms exist for this camp
        $consentPath = FCPATH . 'assets/consent_book/';
        return is_dir($consentPath) && count(glob($consentPath . '*')) > 0;
    }

    /**
     * Integrate with CRM (following billing controller pattern)
     */
    private function integrateWithCRM($appointmentData)
    {
        // Only send to CRM if lead source doesn't contain "D/S"
        if (strpos($appointmentData['lead_source'], "D/S") === false) {
            $data = [
                "api_key" => "83661358790533838050723166537248941TTR",
                "name" => $appointmentData['wife_name'],
                "mobile" => $appointmentData['wife_phone'],
                "country_code" => "+91",
                "lead_source" => $appointmentData['lead_source'],
                "lead_source_url" => "HMS",
                "city" => "",
                "email" => $appointmentData['wife_email'],
                "center_id" => $appointmentData['appoitment_for']
            ];
            
            $curl = curl_init();
            $jsonData = json_encode($data);
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://flertility.in/lead/create-lead-api/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
        }
        
        // Get CRM ID and update local database
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://flertility.in/lead/lead-mobile-no/?mobile_no=" . urlencode($appointmentData['wife_phone']),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if (!$err && !empty($response)) {
            $leadData = json_decode($response, true);
            if (!empty($leadData) && isset($leadData[0])) {
                $lead = $leadData[0];
                // Update local DB with CRM ID
                $this->db->where('wife_phone', $appointmentData['wife_phone']);
                $this->db->update($this->config->item('db_prefix') . 'appointments' , ['crm_id' => $lead['id']]);
            }
        }
    }
}
