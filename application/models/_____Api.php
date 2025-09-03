<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
	public function __construct()
    {
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model(array('api_model', 'billingmodel_model', 'billings_model', 'doctors_model', 'investigation_model', 'procedures_model', 'accounts_model', 
        'stock_model',  'center_model',  'patients_model',  'employee_model',  'appointment_model'));
		$this->load->helper('myhelper');
	}

    public function get_doctors(){
        $data = $doctors = array();
        $doctors = $this->api_model->get_list_doctors();
        if(!empty($doctors)){
            echo json_encode(array('data' => $doctors, 'status' => 1));
            die;
        }else{
            echo json_encode(array('data' => 'No doctor found', 'status' => 0));
            die;
        }
    }
    
    public function get_centres(){
        $data = $centres = array();
        $centres = $this->api_model->get_list_centres();
        if(!empty($centres)){
            echo json_encode(array('data' => $centres, 'status' => 1));
            die;
        }else{
            echo json_encode(array('data' => 'No center found', 'status' => 0));
            die;
        }
    }
    
    public function appointmentbooking(){
        $response = array();
		$phone_number = '';
		$search_this = isset($_POST['search'])?$_POST['search']:"";
		$search_by = isset($_POST['search_by'])?$_POST['search_by']:"";

		if($search_this != ''){
		    $appointments = $this->billingmodel_model->search_appointment($search_this, $search_by);
			if(count($appointments) > 0){
				$response = array('status' => 0, 'message'=> 'Appointment already booked');
				echo json_encode($response);
				die;
			}else{
			    
			    $appoint_arr = array();
			    $patient_id = $patient_status = "";
			    $patient = $this->billingmodel_model->search_patient($search_this, $search_by);

				if(count($patient) > 0){
					$patient_id = $patient['patient_id'];
					$patient_status = "exist_patient";
				}else{
					$patient_id = getGUID();
					$patient_status = "new_patient";
				}
			    $appoint_arr['paitent_id'] = $patient_id;
			    $appoint_arr['paitent_type'] = $patient_status;
			    $appoint_arr['wife_name'] = isset($_POST['name'])?$_POST['name']:"";
			    $appoint_arr['wife_phone'] = isset($_POST['phone'])?$_POST['phone']:"";
			    $appoint_arr['wife_email'] = !empty($_POST['email'])?$_POST['email']:"indiaivfhms@gmail.com";
			    $appoint_arr['nationality'] = isset($_POST['nationality'])?$_POST['nationality']:"indian";
			    $appoint_arr['reason_of_visit'] = isset($_POST['reason_of_visit'])?$_POST['reason_of_visit']:"";
			    $appoint_arr['appoitment_for'] = isset($_POST['appointment_centre'])?$_POST['appointment_centre']:"";
			    $appoint_arr['appoitmented_doctor'] = isset($_POST['appointment_doctor'])?$_POST['appointment_doctor']:"";
			    $appoint_arr['appoitmented_date'] = isset($_POST['appointment_date'])?date("Y-m-d H:i", strtotime($_POST['appointment_date'])):"";
			    $appoint_arr['appoitmented_slot'] = isset($_POST['appointment_slot'])?$_POST['appointment_slot']:"";
			    $appoint_arr['appointment_added'] = date('Y-m-d H:i:s');

    			if($patient_status == "exist_patient" && !empty($patient_id)){
    				$check_patient_medical_info = check_patient_medical_info($patient_id);
    				if($check_patient_medical_info == 1){
    					$appoint_arr['follow_up_appointment'] = 1;
    				}
     			}
     			
     			if(empty($appoint_arr['wife_name']) ||
     			    empty($appoint_arr['wife_phone']) || 
     			    empty($appoint_arr['appoitment_for']) || 
     			    empty($appoint_arr['appoitmented_doctor']) ||
     			    empty($appoint_arr['appoitmented_date']) || 
     			    empty($appoint_arr['appoitmented_slot'])){
         			    $response = array('status' => 0, 'message'=> 'Enter required fields');
            			echo json_encode($response);
            			die;
     			}else{
     			    $appointment = $this->billingmodel_model->insert_appointments($appoint_arr);
			        if($appointment > 0){
     		    	    $response = array('status' => 1, 'message'=> 'Appointment has been booked!');
            			echo json_encode($response);
            			die;
			        }else{
				        $response = array('status' => 0, 'message'=> 'Appointment booking failed');
            			echo json_encode($response);
            			die;
			        }
     			}
			}
		}else{
		    $response = array('status' => 0, 'message'=> 'Phone number/IIC ID is required');
			echo json_encode($response);
			die;
		}
    }
    
    public function advisories(){
         $response = array();
		$phone_number = '';
		$search_this = isset($_POST['search'])?$_POST['search']:"";
		$search_by = isset($_POST['search_by'])?$_POST['search_by']:"";

		if($search_this != ''){
		        $appoint_arr = array();
			    $patient_id = $patient_status = "";
			    $patient = $this->billingmodel_model->search_patient($search_this, $search_by);

				if(count($patient) > 0){
				    if(empty($_POST['phone'])|| 
     			        !isset($_FILES['advisories']['name'])){
				        $response = array('status' => 0, 'message'=> 'Enter required fields');
            			echo json_encode($response);
            			die;
				    }else{
    				    $response = array('status' => 1, 'phone'=> $_POST['phone'], 'advisories' => $_FILES['advisories']['name']);
            			echo json_encode($response);
            			die;
				    }
				}else{
					$response = array('status' => 0, 'message'=> 'patient not found!');
        			echo json_encode($response);
        			die;
				}
		}else{
		    $response = array('status' => 0, 'message'=> 'Phone number/IIC ID is required');
			echo json_encode($response);
			die;
		}
    }
	
	public function myappointment_leadsqure(){
		$response = array();
		$data = json_decode(file_get_contents('php://input'), true);
		$email = $data['EmailAddress'];
		$note = $data['ActivityNote'];
		$crm_id = $data['LeadID'];
		$first_name = $data['FirstName'];
		$husband_name = $data['HusbandName'];
		$mobile = str_replace("+91-", "", $data['Phone']);
		$appointment_time = $data['ActivityDateTime'];
		$extra_fields = $data['Fields'];
		
		if(!empty($first_name) && !empty($mobile)){
			
			$appointments = $this->billingmodel_model->search_appointment($mobile, "phone_number");
			if(count($appointments) > 0){
				$response = array('status' => 0, 'message'=> 'Appointment already booked');
				echo json_encode($response);
				die;
			}else{
				$appoint_arr = array();
			    $patient_id = $patient_status = "";
			    $patient = $this->billingmodel_model->search_patient($mobile, "phone_number");
				if(count($patient) > 0){
					$patient_id = $patient['patient_id'];
					$patient_status = "exist_patient";
				}else{
					$patient_id = getGUID();
					$patient_status = "new_patient";
				}
				//save code in database
				$appoint_arr = array();
				$appoint_arr['paitent_id'] = $patient_id;
				$appoint_arr['paitent_type'] = $patient_status;
				$appoint_arr['crm_id'] = $crm_id;
				$appoint_arr['wife_name'] = $first_name;
				$appoint_arr['husband_name'] = $husband_name;
				$appoint_arr['wife_phone'] = $mobile;
				$appoint_arr['wife_email'] = !empty($email)? $email: "indiaivfhms@gmail.com";
				$appoint_arr['nationality'] = "indian";
				$appoint_arr['reason_of_visit'] = $note;
				$appointment_for = "";
				$appoitmented_doctor = "";
				$appoitmented_date = "";
				$appoitmented_slot = "";
				foreach ($extra_fields as $row){
					if($row['SchemaName'] == "mx_Centre_Location"){
						$appointment_for = $row['Value']; 
					}
					if($row['SchemaName'] == "mx_Doctor"){
						$appoitmented_doctor = $row['Value']; 
					}
					if($row['SchemaName'] == "mx_appoitmented_date"){
						$appoitmented_date = $row['Value']; 
					}
					if($row['SchemaName'] == "mx_appoitmented_slot"){
						$appoitmented_slot = $row['Value']; 
					}
				}
				$centerArr = array(
					"101"=>"16249589462327",
					"102"=>"16266778858144",
					"103"=>"16267558222750",
					"104"=>"16098223739590",
					"105"=>"16133769531637",
					"106"=>"16133769691598",
					"107"=>"1650433762851",
					"108"=>"16504338296792",
					"109"=>"16376560997772",
					"110"=>"16133769903168",
					"111"=>"16133770059184",
					"112"=>"16133772549576",
					"113"=>"16134712848837",
					"114"=>"16298890995787",
					"115"=>"16474253421459",
					"116"=>"1581156221",
					"117"=>"1581156245",
					"118"=>"1581156261",
					"119"=>"1581157290",
					"120"=>"1593015013",
				);
				if(!empty($appointment_for)){
					foreach ($centerArr as $key => $val){
						if($appointment_for == $key){
							$appointment_for = $val;
							break;
						}
					}
				}
				$appoint_arr['appoitment_for'] = $appointment_for;
				$appoint_arr['appoitmented_doctor'] = $appoitmented_doctor;
				$appoint_arr['appoitmented_date'] = $appoitmented_date;
				$appoint_arr['appoitmented_slot'] = $appoitmented_slot;
				$appoint_arr['appointment_added'] = date('Y-m-d H:i:s');
				
				
				$appointment = $this->billingmodel_model->insert_appointments($appoint_arr); 
				
				/*$data = "\n".date("d-m-y H:i:s")."-------------".json_encode($appointment)."\n";
                        $fp = fopen('app_data.txt', 'a');
                        fwrite($fp, json_encode($data));
                        fclose($fp);*/
				
				if($appointment > 0){
					// welcome template
					/*$checkpaitent= get_patient_by_number($mobile);
					if(!empty($checkpaitent)){
					    $data = "\n".date('d-m-y H:i:s')."======in if======"."\n";;
                        $fp = fopen('app_data.txt', 'a');
                        fwrite($fp, $data);
                        fclose($fp);
                        
					    $checkpatient_register = get_patient_detail($checkpaitent['patient_id']);
					    if(isset($checkpatient_register) && !empty($checkpatient_register) && $checkpatient_register['whats_registers'] == 0){
        			        $centre_details = get_centre_details($appointment_for);
							//$doctor_details = doctor_details($appoitmented_doctor);
							whatsappregister($appoint_arr['wife_phone'], json_encode(array("name" => $appoint_arr['wife_name'], "iic_id" => $checkpaitent['patient_id'], "center" => $centre_details['center_name'])));
        			        
            		        $this->db->where('patient_id', $paitent_id);
            		        $this->db->update('hms_patients', array('whats_registers' => 1));
        			    }
					}else{
					    $data = "\n".date('d-m-y H:i:s')."======in else======"."\n";;
                        $fp = fopen('app_data.txt', 'a');
                        fwrite($fp, $data);
                        fclose($fp);
					    whatsappregister($appoint_arr['wife_phone'], json_encode(array("name" => $appoint_arr['wife_name'])));
					}*/
					
					// appointment confirmations
					$centre_details = get_centre_details($appointment_for);
					//$doctor_details = doctor_details($appoitmented_doctor);
					$appointwhatmsg = array();
					$appointwhatmsg = array($appoint_arr['wife_name'], $centre_details['center_name'], date("d-m-Y", strtotime($appoint_arr['appoitmented_date'])), $appoint_arr['appoitmented_slot'], isset($centre_details['center_location'])?$centre_details['center_location']:"");
					$appointsendmsg = whatsappappointment(
						$appoint_arr['wife_phone'], 
						$appoint_arr['wife_name'],
						//$doctor_details['doctor_name'],
						$centre_details['center_name'],
						date("d-m-Y", strtotime($appoint_arr['appoitmented_date'])),
						$appoint_arr['appoitmented_slot'],
						isset($centre_details['center_location'])?$centre_details['center_location']:"",
					"appointment_confirmation");
					
					$response = array('status' => 1, 'message'=> 'Appointment has been booked!');
					echo json_encode($response);
					die;
				}else{
					$response = array('status' => 0, 'message'=> 'Appointment booking failed');
					echo json_encode($response);
					die;
				}
			}
			
		}else{
			$response = array('status' => 0, 'message'=> 'Please enter valid data.');
		}
		echo json_encode($response);
		die;
    }
	
	private $auth_token = "312e1bf40ab1b75601b6f1a7a57f589c";

	private function authenticate() {
        $headers = $this->input->request_headers();
        if (isset($headers['auth-token']) && $headers['auth-token'] === $this->auth_token) {
            return true;
        }
        return false;
    }
	
	public function appointment_status_update(){

    	if (!$this->authenticate()) {
            echo json_encode([
                'status' => false,
                'message' => 'Unauthorized access.'
            ]);
            http_response_code(401);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['wife_phone'], $input['center'], $input['new_status'])) {
            $wife_phone = $input['wife_phone'];
            $center = $input['center'];
            $new_status = $input['new_status'];
            $appointed_date = isset($input['appointed_date']) ? $input['appointed_date'] : date('Y-m-d H:i:s'); // Use current date if not provided

            // Call the model function to update status and appointed_date
            $result = $this->appointment_model->updateStatusAndDate($wife_phone, $center, $new_status, $appointed_date);

            if ($result) {
                $response = [
                    'status' => true,
                    'message' => 'Status and appointed date updated successfully.',
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'No record found or update failed.',
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Invalid input data.',
            ];
        }

        echo json_encode($response);

    }
	
public function appointment_status_crm_id() {
    // Read raw JSON input
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate input
    if (empty($input['crm_id']) || empty($input['wife_phone'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing crm_id or wife_phone'
        ]);
        exit;
    }

    // Sanitize inputs
    $crm_id = htmlspecialchars(trim($input['crm_id']));
    $wife_phone = htmlspecialchars(trim($input['wife_phone']));

    // Run the update logic
    $status = $this->api_model->appointment_status_crm_id($crm_id, $wife_phone);

    if ($status > 0) {
        $response = [
            'status' => 'crm_id_updated',
            'message'=> 'CRM ID Updated'
        ];
    } else {
        $response = [
            'status' => 'status_same',
            'message'=> 'No update performed'
        ];
    }

    echo json_encode($response);
    exit;
}

}