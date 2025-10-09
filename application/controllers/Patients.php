<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model(array('patients_model', 'billings_model', 'accounts_model' ,'stock_model','center_model'));
		$this->load->helper('myhelper');
		$this->load->library("pagination");
	}
	
	public function patient_detail_name(){
		$patient_id = $_POST['patient_id'];
		$patient_data = get_patient_detail($patient_id);
		$name = "";
		if(!empty($patient_data)){
			$name = "Patient Name : ".$patient_data['wife_name'];
		}else{
			$name = "No Patient Data";
		}
		echo json_encode($name);
		die;
	}

	public function patient_detail_name2(){
		$patient_id = $_POST['patient_id'];
		$patient_data = get_patient_detail($patient_id);
		$name = "";
		if(!empty($patient_data)){
			$name = $patient_data['wife_name'];
		}else{
			$name = "No Patient Data";
		}
		echo json_encode($name);
		die;
	}
	
	public function edit($paitent_id)
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_patient'){
				unset($_POST['action']);
				
				/******************* WIFE DETAILS *********************/
				//wife pan
				$wife_pan_card = '';
				if(!empty($_FILES['wife_pan_card']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'patient_files/';
						$NewImageName = rand(4,10000)."-".$paitent_id."-wife-". $_FILES['wife_pan_card']['name'];
						$wife_pan_card = base_url().'assets/patient_files/'.$NewImageName;
						move_uploaded_file($_FILES['wife_pan_card']['tmp_name'], $destination.$NewImageName);
						$_POST['wife_pan_card'] = $wife_pan_card;
				}
				//wife front adhar
				$wife_adhar_card = '';
				if(!empty($_FILES['wife_adhar_card']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'patient_files/';
						$NewImageName = rand(4,10000)."-".$paitent_id."-wife-". $_FILES['wife_adhar_card']['name'];
						$wife_adhar_card = base_url().'assets/patient_files/'.$NewImageName;
						move_uploaded_file($_FILES['wife_adhar_card']['tmp_name'], $destination.$NewImageName);
						$_POST['wife_adhar_card'] = $wife_adhar_card;
				}
				//wife back adhar
				$wife_back_adhar_card = '';
				if(!empty($_FILES['wife_back_adhar_card']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'patient_files/';
						$NewImageName = rand(4,10000)."-".$paitent_id."-wife-". $_FILES['wife_back_adhar_card']['name'];
						$wife_back_adhar_card = base_url().'assets/patient_files/'.$NewImageName;
						move_uploaded_file($_FILES['wife_back_adhar_card']['tmp_name'], $destination.$NewImageName);
						$_POST['wife_back_adhar_card'] = $wife_back_adhar_card;
				}
				//wife photo
				$wife_photo = '';
				if(!empty($_FILES['wife_photo']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$paitent_id."-wife-". $_FILES['wife_photo']['name'];
					$wife_photo = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['wife_photo']['tmp_name'], $destination.$NewImageName);
					$_POST['wife_photo'] = $wife_photo;
				}
				//wife passport
				$wife_passport = '';
				if(!empty($_FILES['wife_passport']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$paitent_id."-wife-". $_FILES['wife_passport']['name'];
					$wife_passport = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['wife_passport']['tmp_name'], $destination.$NewImageName);
					$_POST['wife_passport'] = $wife_passport;
				}
				/******************* WIFE DETAILS *********************/
							
				/******************* HUSBAND DETAILS *********************/
				//husband pan
				$husband_pan_card = '';
				if(!empty($_FILES['husband_pan_card']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$paitent_id."-husband-". $_FILES['husband_pan_card']['name'];
					$husband_pan_card = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['husband_pan_card']['tmp_name'], $destination.$NewImageName);
					$_POST['husband_pan_card'] = $husband_pan_card;
				}
				//husband front adhar
				$husband_adhar_card = '';
				if(!empty($_FILES['husband_adhar_card']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$paitent_id."-husband-". $_FILES['husband_adhar_card']['name'];
					$husband_adhar_card = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['husband_adhar_card']['tmp_name'], $destination.$NewImageName);
					$_POST['husband_adhar_card'] = $husband_adhar_card;
				}
				//husband back adhar
				$husband_back_adhar_card = '';
				if(!empty($_FILES['husband_back_adhar_card']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$paitent_id."-husband-". $_FILES['husband_back_adhar_card']['name'];
					$husband_back_adhar_card = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['husband_back_adhar_card']['tmp_name'], $destination.$NewImageName);
					$_POST['husband_back_adhar_card'] = $husband_back_adhar_card;
				}
				//husband photo
				$husband_photo = '';
				if(!empty($_FILES['husband_photo']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$paitent_id."-husband-". $_FILES['husband_photo']['name'];
					$husband_photo = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['husband_photo']['tmp_name'], $destination.$NewImageName);
					$_POST['husband_photo'] = $husband_photo;
				}
				//husband passport
				$husband_passport = '';
				if(!empty($_FILES['husband_passport']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$paitent_id."-husband-". $_FILES['husband_passport']['name'];
					$husband_passport = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['husband_passport']['tmp_name'], $destination.$NewImageName);
					$_POST['husband_passport'] = $husband_passport;
				}
				/******************* HUSBAND DETAILS *********************/
				
				$fosql = "SELECT * FROM hms_appointments WHERE paitent_id = '$paitent_id' AND paitent_type = 'new_patient'";
				$fo_result = run_select_query($fosql);
				$lead_id = is_array($fo_result) ? $fo_result['crm_id'] : '';
				
				$data = [
					"primary_name_age" => $_POST['female_age'],
					"secondary_name_age" => $_POST['male_age'],
					"primary_name_gender" => "female",
					"secondary_name_gender" => "male",
					"primary_occupation" => $_POST['female_occupation'],
					"secondary_occupation" => $_POST['male_occupation'],
					"primary_education" => "",
					"secondary_education" => ""
				];

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => 'https://flertility.in/lead/lead-update/'.$lead_id.'/',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'PATCH',
				  CURLOPT_POSTFIELDS => json_encode($data),
				  CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				
				
				$data = $this->patients_model->update_patient_data($_POST, $paitent_id);
				
				$post_data = [
					"id" => $lead_id,
					"patient_id" => $paitent_id,
					"patient_phone" => $_POST['wife_phone'],
					"wife_name" => $_POST['wife_name'],
					"wife_phone" => $_POST['wife_phone'],
					"wife_email" => $_POST['wife_email'],
					"wife_pan_number" => $_POST['wife_pan_number'],
					"wife_pan_card" => $_POST['wife_pan_card'],
					"wife_adhar_number" => $_POST['wife_adhar_number'],
					"wife_adhar_card" => $_POST['wife_adhar_card'],
					"wife_back_adhar_card" => $_POST['wife_back_adhar_card'],
					"wife_photo" => $_POST['wife_photo'],
					"wife_age" => $_POST['female_age'],
					"wife_address" => $_POST['wife_address'],
					"husband_name" => $_POST['husband_name'],
					"husband_phone" => $_POST['husband_phone'],
					"husband_email" => $_POST['husband_email'],
					"husband_pan_number" => $_POST['husband_pan_number'],
					"husband_pan_card" => $_POST['husband_pan_card'],
					"husband_adhar_number" => $_POST['husband_adhar_number'],
					"husband_adhar_card" => $_POST['husband_adhar_card'],
					"husband_back_adhar_card" => $_POST['husband_back_adhar_card'],
					"husband_photo" => $_POST['husband_photo'],
					"wife_passport" => $_POST['wife_passport'],
					"wife_passport_number" => $_POST['wife_passport_number'],
					"husband_passport" => $_POST['husband_passport'],
					"husband_passport_number" => $_POST['husband_passport_number'],
					"husband_age" => $_POST['male_age'],
					"husband_address" => $_POST['husband_address'],
					"patient_source" => "",
					"reference_from" => "",
					"nationality" => "",
					"center" => ""
				];

				// Initialize cURL
				$curl = curl_init();

				curl_setopt_array($curl, [
					CURLOPT_URL => 'https://hms.indiaivf.website/old_reports/patient/',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => json_encode($post_data),
					CURLOPT_HTTPHEADER => [
						'Content-Type: application/json'
					],
				]);

				$response = curl_exec($curl);
				curl_close($curl);

				//echo $response;
                //die();
				
				if($data > 0){
					header("location:" .base_url(). "patients/edit/$paitent_id?m=".base64_encode('Patient updated successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "patients/edit/$paitent_id?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data['patient_data'] = get_patient_detail($paitent_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/edit', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function patient_records($patient_id, $appointment_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();			
			$data['patient_id'] = $patient_id;	
			$data['appointment_id'] = $appointment_id;			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/patient_records', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function patient_psychological($patient_id, $appointment_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();			
			$data['patient_id'] = $patient_id;	
			$data['appointment_id'] = $appointment_id;			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/patient_psychological', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function patient_reports($paitent_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$investigations_reports = $this->patients_model->patient_investigations_reports($paitent_id);
			$medicines = $this->patients_model->patient_medicines_reports($paitent_id);
			$data['medicines'] = $medicines;
			$data['investigations_reports'] = $investigations_reports;
			$data['patient_data'] = get_patient_detail($paitent_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/patient_reports', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function report_status($paitent_id, $report_id, $appointment_id)
	{ 
		$status = $_GET['s'];
		$report_status = $this->patients_model->patient_report_status($report_id, $status);
		if($report_status > 0){
			if($status == "disapproved"){
				$status_reason = $_POST['status_reason'];
				$report_status = $this->patients_model->disapprove_report_status($report_id, $status_reason);
			}
			header("location:" .base_url(). "my-reports/".$paitent_id."/".$appointment_id."?m=".base64_encode('Report '.$status.'!').'&t='.base64_encode('success'));
			die();
		}else{
			header("location:" .base_url(). "my-reports/".$paitent_id."/".$appointment_id."?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
			die();
		}
	}

	public function check_reports(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$template = get_header_template($logg['role']);
			if(isset($_GET['p'])  && !empty($_GET['p']) && isset($_GET['b'])  && !empty($_GET['b'])){
				$phone_number = '';
				$search_this = $_GET['p'];
				$search_by = $_GET['b'];
			
				if($search_this != ''){
					$patient = $this->billings_model->check_patient($search_this, $search_by);
					if(count($patient) > 0){
						$data['investigation_reports'] = $this->patients_model->investigation_reports($patient['patient_id']);
						$data['procedure_reports'] = $this->accounts_model->procedure_reports($patient['patient_id']);
						$this->load->view($template['header']);
						$this->load->view('patients/check_reports', $data);
						$this->load->view($template['footer']);
					}else{
						header("location:" .base_url(). "check_reports?m=".base64_encode('Record not found!').'&t='.base64_encode('error'));
						die();
					}			
				}else{
					header("location:" .base_url(). "check_reports?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
					die();
				}
			}else{
				$this->load->view($template['header']);
				$this->load->view('patients/check_reports', $data);
				$this->load->view($template['footer']);
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
		//Discharge Summary
	public function discharge_summary(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();

			$data['updated_by'] = "";
			$data['updated_type'] = "";
			$data['updated_at'] = date('Y-m-d H:i:s');

			$iic_id = $_GET['iic_id'];
   			$form_id = $_GET['discharge'];
   			$data['iic_id'] = $iic_id;
   			$data['form_id'] = $form_id;

			$formname = $this->patients_model->get_discharge_form($form_id);

			$data['formname'] = $formname['form_name'];
			$data['patient_data'] = get_patient_detail($iic_id);

			if(isset($_SESSION['logged_doctor'])){
				$data['updated_by'] = $_SESSION['logged_doctor']['username'];
				$data['updated_type'] = "doctor";
			}else if(isset($_SESSION['logged_billing_manager'])){
				$data['updated_by'] = $_SESSION['logged_billing_manager']['employee_number'];
				$data['updated_type'] = "biller";
			}
			else if(isset($_SESSION['logged_embryologist'])){
				$data['updated_by'] = $_SESSION['logged_embryologist']['employee_number'];
				$data['updated_type'] = "embryologist";
			}
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/discharge_summary', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

    public function patient_discharge_summary($form_id, $iic_id, $db_name){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();

			$data['updated_by'] = "";
			$data['updated_type'] = "";
			$data['updated_at'] = date('Y-m-d H:i:s');
			
			$formname = $this->patients_model->get_discharge_form_data($db_name);
            
			$data['formname'] = $formname['form_name'];
			$data['patient_data'] = get_patient_detail($iic_id);
            $data['iic_id'] = $iic_id;
			if(isset($_SESSION['logged_doctor'])){
				$data['updated_by'] = $_SESSION['logged_doctor']['username'];
				$data['updated_type'] = "doctor";
			}else if(isset($_SESSION['logged_billing_manager'])){
				$data['updated_by'] = $_SESSION['logged_billing_manager']['employee_number'];
				$data['updated_type'] = "biller";
			}
			else if(isset($_SESSION['logged_embryologist'])){
				$data['updated_by'] = $_SESSION['logged_embryologist']['employee_number'];
				$data['updated_type'] = "embryologist";
			}
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/discharge_summary_print', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	   public function patients(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$center = $this->input->get('center', true);
			$wife_name = $this->input->get('wife_name', true);
            $patient_id = $this->input->get('iic_id', true);
			$export_patient = $this->input->get('export-patient', true);
			if (isset($export_patient)){
				$data = $this->patients_model->export_patient($center, $wife_name, $patient_id);
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=Patients-'.$start_date.'-'.$end_date.'.csv');
				$fp = fopen('php://output','w');
				$headers = 'UHID,Patient ID, Patient Phone, Wife Name, Wife_phone, Center';
				//Add the headers
				fwrite($fp, $headers. "\r\n");
				foreach ($data as $key => $val) {//var_dump($val);die;
				
					$select_query = "SELECT * FROM `hms_appointments` WHERE wife_phone='" . $val['wife_phone'] . "'";
					$select_result = run_select_query($select_query); 
					
					$center_query = "SELECT * FROM `hms_centers` WHERE center_number='" . $select_result['appoitment_for'] . "'";
					$center_result = run_select_query($center_query); 
					
					$uhid = $center_result['center_code']."/".$select_result['uhid'];
					
					$center = $select_result['appoitment_for'];
				
					$lead_arr = array($uhid, $val['patient_id'], $val['patient_phone'],$val['wife_name'],  $val['wife_phone'],$center);
					fputcsv($fp, $lead_arr);
				}
				
				fclose($fp);
				exit();
			}
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/patients";
        	$config["total_rows"] = $this->patients_model->patient_count($center, $wife_name, $patient_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['investigate_result'] = $this->patients_model->patient_list_patination($config["per_page"], $per_page, $center, $wife_name, $patient_id);
			$data["center"] = $center;
			$data["wife_name"] = $wife_name;
			$data["patient_id"] = $patient_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/patients', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function embryo_freezing(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/embryo_freezing";
        	$config["total_rows"] = $this->patients_model->embryo_freezing_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['embryo_freezing_result'] = $this->patients_model->embryo_freezing_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/embryo_freezing', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function embryo_pesa(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/embryo_pesa";
        	$config["total_rows"] = $this->patients_model->embryo_pesa_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['embryo_pesa_result'] = $this->patients_model->embryo_pesa_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/embryo_pesa', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function opu(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/opu";
        	$config["total_rows"] = $this->patients_model->embryo_opu_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['opu_result'] = $this->patients_model->embryo_opu_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/opu', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function embryo_fnactestes(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/embryo_fnactestes";
        	$config["total_rows"] = $this->patients_model->embryo_fnactestes_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['fnactestes_result'] = $this->patients_model->embryo_fnactestes_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/embryo_fnactestes', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function embryo_discharge_summary(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/embryo_discharge_summary";
        	$config["total_rows"] = $this->patients_model->embryo_discharge_summary_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['discharge_summary_result'] = $this->patients_model->embryo_discharge_summary_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/embryo_discharge_summary', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function embryo_intra_uterine(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/embryo_intra_uterine";
        	$config["total_rows"] = $this->patients_model->embryo_intra_uterine_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['intra_uterine_result'] = $this->patients_model->embryo_intra_uterine_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/embryo_intra_uterine', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function embryo_sperm_dna(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/embryo_sperm_dna";
        	$config["total_rows"] = $this->patients_model->embryo_sperm_dna_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['sperm_dna_result'] = $this->patients_model->embryo_sperm_dna_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/embryo_sperm_dna', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function embryo_semen_analysis(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$iic_id = $this->input->get('iic_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/embryo_semen_analysis";
        	$config["total_rows"] = $this->patients_model->embryo_semen_analysis_count($iic_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['semen_analysis_result'] = $this->patients_model->embryo_semen_analysis_list_patination($config["per_page"], $per_page, $iic_id);
			$data["iic_id"] = $iic_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/embryo_semen_analysis', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

    function get_all_centers(){
		$all_centers = $this->stock_model->get_centers();
		return $all_centers;
	}	

	function get_patient_prodedures($appointment_id, $patient_id){
		$data = $this->patients_model->get_patient_prodedures($appointment_id, $patient_id);
		return $data;
	}

	function get_patient_prodedures_data($appointment_id, $patient_id){
		$data = $this->patients_model->get_patient_prodedures_data($appointment_id, $patient_id);
		return $data;
	}

	function get_medicine_name($medicine){
		$name = $this->billings_model->get_medicine_name($medicine);
		return $name;
	}

	function get_brand_name($brand){
		$name = $this->billings_model->get_brand_name($brand);
		return $name;
	}

	

	public function timeline_view(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){

			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$patient_id = $this->input->get('patient_id', true);
			
			$config = array();
        	$config["base_url"] = base_url() . "patients/timeline_view";
        	$config["total_rows"] = $this->patients_model->get_patient_timeline_count($patient_id);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			$data['timeline_data'] = $this->patients_model->get_patient_timeline($config["per_page"], $per_page, $patient_id);
			$data["patient_id"] = $patient_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('patients/timeline_view', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

    public function insert_timeline()
{
    header('Content-Type: application/json');

    $logg = checklogin();
    if ($logg['status'] != true) {
        echo json_encode(['status' => false, 'message' => 'Unauthorized access']);
        return;
    }

    // Get POST data safely
    $patient_id     = $this->input->post('patient_id', true);
    $event_type     = $this->input->post('event_type', true);
    $agent          = $this->input->post('agent', true);
    $event_details  = $this->input->post('event_details', true);
    $created_by     = $logg['user_id'] ?? 'system';
    $event_date     = date('Y-m-d H:i:s');

    // Validate required fields
    if (empty($patient_id) || empty($event_type)) {
        echo json_encode(['status' => false, 'message' => 'Missing required fields']);
        return;
    }

    // Prepare data
    $data = [
        'patient_id'    => $patient_id,
        'event_type'    => $event_type,
        'agent'         => $agent,
        'event_details' => $event_details,
        'created_by'    => $created_by,
        'event_date'    => $event_date
    ];

    // Insert via model
    $insert_id = $this->patients_model->insert_patient_timeline($data);

    if ($insert_id) {
        echo json_encode([
            'status' => true,
            'message' => 'Timeline record added successfully',
            'insert_id' => $insert_id
        ]);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to insert record']);
    }
}

}