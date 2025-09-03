<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model(array('doctors_model', 'patients_model', 'center_model', 'employee_model', 'appointment_model', 'billingmodel_model', 'investigation_model', 'procedures_model'));
		$this->load->helper('myhelper');
		$this->load->library("pagination");
	}	
	
	public function doctors()
	{
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$data['data'] = $this->doctors_model->get_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/doctors', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}


	public function junior_doctors(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/junior_doctors', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function ipd_admission_form(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/ipd_admission_form', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function pcp_ndt(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	public function pcp_ndt_fhvk(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt_fhvk', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	public function pcp_ndt_ggn(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt_ggn', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function pcp_ndt_opu(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt_opu', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function pcp_ndt_tesa(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt_tesa', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function pcp_ndt_iui(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt_iui', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function pcp_ndt_pgt(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt_pgt', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function pcpndt_outcome_noida(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcpndt_outcome_noida', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function pcp_ndt_update(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/pcp_ndt_update', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
		public function ot_consent_form(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/ot_consent_form', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}
		
		public function anaethesia_consent_form(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/anaethesia_consent_form', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function consent_form(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/consent_form', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function intrauterine_insemination(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/intrauterine_insemination', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function form8(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form8', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function form8_single_woman(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form8_single_woman', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}	
		public function form9(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form9', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}
	
	public function form10(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form10', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}
		
	public function form11(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form11', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

    	public function form12(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form12', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

        public function consent_for_embryo_transfer(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/consent_for_embryo_transfer', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

		 public function form13(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form13', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

         public function form15(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form15', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

		 public function cfpros(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/cfpros', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

		 public function form18(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/form18', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	
		
		 public function risk_consent(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/risk_consent', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	
		
		public function couple_donor_egg(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/couple_donor_egg', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

        public function consent_for_semen_collection(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/consent_for_semen_collection', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

        public function micro_tese(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/micro_tese', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

        public function ovarian_platelet_rich_plasma(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/ovarian_platelet_rich_plasma', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

        public function uterine_platelet_rich_plasma(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/uterine_platelet_rich_plasma', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}		
		
		 public function testicular_platelet_rich_plasma(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/testicular_platelet_rich_plasma', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

		 public function patient_testimonial(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/patient_testimonial', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

         public function low_ovarian_reserve_females(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/low_ovarian_reserve_females', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}		
		
		 public function divorce_ewidow(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/divorce_ewidow', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

         public function agreement_for_surrogacy(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/agreement_for_surrogacy', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}

         public function couple_for_availing_surrogacy(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/couple_for_availing_surrogacy', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

         public function fitness_of_surrogate_mother(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/fitness_of_surrogate_mother', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

        public function consent_form_for_withdrawal(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/consent_form_for_withdrawal', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}
        
         public function screening_of_the_surrogate(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/screening_of_the_surrogate', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

         public function acknowledgment(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_junior_doctors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/acknowledgment', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
		}	

	public function freezingmo(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_freezing();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/freezingmo', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function discard(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_freezing();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/discard', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function update_freezingmo(){
		
		$data = json_decode(file_get_contents('php://input'), true);
		$id = $data["id"];
		$first_intimation_date = $data["first_intimation_date"];
		$mode = $data["mode"];
		$second_intimation_date = $data["second_intimation_date"];
		$mode2 = $data["mode2"];
		$cause_for_discard = $data["cause_for_discard"];
		$consent_form_signed = $data["consent_form_signed"];
		$status_of_discarded = $data["status_of_discarded"];
		$no_ofoocytes_retrieved = $data["no_ofoocytes_retrieved"];
		$discard_embryo = $data["discard_embryo"];
		$remain_embryo = $data["remain_embryo"];
		$discard_date = $data["discard_date"];
		$discard_status = $data["discard_status"];

		$sql = "UPDATE freezing SET first_intimation_date = '$first_intimation_date', mode = '$mode', second_intimation_date = '$second_intimation_date', mode2 = '$mode2', cause_for_discard = '$cause_for_discard', consent_form_signed = '$consent_form_signed', status_of_discarded = '$status_of_discarded', no_ofoocytes_retrieved = '$no_ofoocytes_retrieved', discard_embryo = '$discard_embryo', remain_embryo = '$remain_embryo', discard_date = '$discard_date', discard_status = '$discard_status' where id='$id'";
		$this->db->query($sql);
        return $this->db->affected_rows();

		$response = array("success"=> "success", "message" => "Records has been updated");
		echo json_encode($response);
		exit();
	}

	public function add()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_doctor'){
				unset($_POST['action']);
				//var_dump($_POST);die;
				$username = $_POST['username'];
				$check_doctor = $this->doctors_model->check_doctor($username);
				if($check_doctor > 0){
					//var_dump($check_doctor);die;
					header("location:" .base_url(). "doctors/add?m=".base64_encode('Doctor username already exist!').'&t='.base64_encode('error'));
					die();
				}
				
				$post_arr = $monday_slots = $tuesday_slots = $wednesday_slots = $thursday_slots = $friday_slots = $saturday_slots = $sunday_slots = array();
			    
				//Monday Slots
				if(!isset($_POST['monday_off'])){
					// Monday First Half
					if(!isset($_POST['monday_morning_off'])){
						$monday_morning_start_time = $monday_morning_start_slot = strtotime($_POST['monday_morning_start_time']);
						$monday_morning_end_time = strtotime($_POST['monday_morning_end_time']);
						
						while($monday_morning_start_slot <= $monday_morning_end_time) {
							if($monday_morning_start_slot == $monday_morning_end_time){break;}
							$monday_morning_end_slot = $monday_morning_start_slot+(60*5);
							$slot = date('H:i', $monday_morning_start_slot).'-'.date('H:i', $monday_morning_end_slot);
							$monday_slots[] = $slot;
							$monday_morning_start_slot = $monday_morning_end_slot;
						}
					}

					// Monday Second Half
					if(!isset($_POST['monday_evening_off'])){
						$monday_evening_start_time = $monday_evening_start_slot = strtotime($_POST['monday_evening_start_time']);
						$monday_evening_end_time = strtotime($_POST['monday_evening_end_time']);
						while($monday_evening_start_slot <= $monday_evening_end_time) {
							if($monday_evening_start_slot == $monday_evening_end_time){break;}
							$monday_evening_end_slot = $monday_evening_start_slot+(60*5);
							$slot = date('H:i', $monday_evening_start_slot).'-'.date('H:i', $monday_evening_end_slot);
							$monday_slots[] = $slot;
							$monday_evening_start_slot = $monday_evening_end_slot;
						}
					}
				}	

				//Tuesday Slots
				if(!isset($_POST['tuesday_off'])){
					// Tuesday First Half
					if(!isset($_POST['tuesdy_morning_off'])){
						$tuesday_morning_start_time = $tuesday_morning_start_slot = strtotime($_POST['tuesday_morning_start_time']);
						$tuesday_morning_end_time = strtotime($_POST['tuesday_morning_end_time']);
						while($tuesday_morning_start_slot <= $tuesday_morning_end_time) {
							if($tuesday_morning_start_slot == $tuesday_morning_end_time){break;}
							$tuesday_morning_end_slot = $tuesday_morning_start_slot+(60*5);
							$slot = date('H:i', $tuesday_morning_start_slot).'-'.date('H:i', $tuesday_morning_end_slot);
							$tuesday_slots[] = $slot;
							$tuesday_morning_start_slot = $tuesday_morning_end_slot;
						}
					}
					// Tuesday Second Half
					if(!isset($_POST['tuesdy_evening_off'])){
						$tuesday_evening_start_time = $tuesday_evening_start_slot = strtotime($_POST['tuesday_evening_start_time']);
						$tuesday_evening_end_time = strtotime($_POST['tuesday_evening_end_time']);
						while($tuesday_evening_start_slot <= $tuesday_evening_end_time) {
							if($tuesday_evening_start_slot == $tuesday_evening_end_time){break;}
							$tuesday_evening_end_slot = $tuesday_evening_start_slot+(60*5);
							$slot = date('H:i', $tuesday_evening_start_slot).'-'.date('H:i', $tuesday_evening_end_slot);
							$tuesday_slots[] = $slot;
							$tuesday_evening_start_slot = $tuesday_evening_end_slot;
						}
					}
				}				
				//Wednesday Slots
				if(!isset($_POST['wednesday_off'])){
					// Wednesday First Half
					if(!isset($_POST['wednesday_morning_off'])){
						$wednesday_morning_start_time = $wednesday_morning_start_slot = strtotime($_POST['wednesday_morning_start_time']);
						$wednesday_morning_end_time = strtotime($_POST['wednesday_morning_end_time']);
						while($wednesday_morning_start_slot <= $wednesday_morning_end_time) {
							if($wednesday_morning_start_slot == $wednesday_morning_end_time){break;}
							$wednesday_morning_end_slot = $wednesday_morning_start_slot+(60*5);
							$slot = date('H:i', $wednesday_morning_start_slot).'-'.date('H:i', $wednesday_morning_end_slot);
							$wednesday_slots[] = $slot;
							$wednesday_morning_start_slot = $wednesday_morning_end_slot;
						}
					}
					// Wednesday Second Half
					if(!isset($_POST['wednesday_evening_off'])){
						$wednesday_evening_start_time = $wednesday_evening_start_slot = strtotime($_POST['wednesday_evening_start_time']);
						$wednesday_evening_end_time = strtotime($_POST['wednesday_evening_end_time']);
						while($wednesday_evening_start_slot <= $wednesday_evening_end_time) {
							if($wednesday_evening_start_slot == $wednesday_evening_end_time){break;}
							$wednesday_evening_end_slot = $wednesday_evening_start_slot+(60*5);
							$slot = date('H:i', $wednesday_evening_start_slot).'-'.date('H:i', $wednesday_evening_end_slot);
							$wednesday_slots[] = $slot;
							$wednesday_evening_start_slot = $wednesday_evening_end_slot;
						}
					}
				}				
				//thursday Slots
				if(!isset($_POST['thursday_off'])){
					// thursday First Half
					if(!isset($_POST['thursday_morning_off'])){
						$thursday_morning_start_time = $thursday_morning_start_slot = strtotime($_POST['thursday_morning_start_time']);
						$thursday_morning_end_time = strtotime($_POST['thursday_morning_end_time']);
						while($thursday_morning_start_slot <= $thursday_morning_end_time) {
							if($thursday_morning_start_slot == $thursday_morning_end_time){break;}
							$thursday_morning_end_slot = $thursday_morning_start_slot+(60*5);
							$slot = date('H:i', $thursday_morning_start_slot).'-'.date('H:i', $thursday_morning_end_slot);
							$thursday_slots[] = $slot;
							$thursday_morning_start_slot = $thursday_morning_end_slot;
						}
					}
					// thursday Second Half
					if(!isset($_POST['thursday_evening_off'])){
						$thursday_evening_start_time = $thursday_evening_start_slot = strtotime($_POST['thursday_evening_start_time']);
						$thursday_evening_end_time = strtotime($_POST['thursday_evening_end_time']);
						while($thursday_evening_start_slot <= $thursday_evening_end_time) {
							if($thursday_evening_start_slot == $thursday_evening_end_time){break;}
							$thursday_evening_end_slot = $thursday_evening_start_slot+(60*5);
							$slot = date('H:i', $thursday_evening_start_slot).'-'.date('H:i', $thursday_evening_end_slot);
							$thursday_slots[] = $slot;
							$thursday_evening_start_slot = $thursday_evening_end_slot;
						}
					}
				}				
				//Friday Slots
				if(!isset($_POST['friday_off'])){
					// Friday First Half
					if(!isset($_POST['friday_morning_off'])){
						$friday_morning_start_time = $friday_morning_start_slot = strtotime($_POST['friday_morning_start_time']);
						$friday_morning_end_time = strtotime($_POST['friday_morning_end_time']);
						while($friday_morning_start_slot <= $friday_morning_end_time) {
							if($friday_morning_start_slot == $friday_morning_end_time){break;}
							$friday_morning_end_slot = $friday_morning_start_slot+(60*5);
							$slot = date('H:i', $friday_morning_start_slot).'-'.date('H:i', $friday_morning_end_slot);
							$friday_slots[] = $slot;
							$friday_morning_start_slot = $friday_morning_end_slot;
						}
					}
					// Friday Second Half
					if(!isset($_POST['friday_evening_off'])){
						$friday_evening_start_time = $friday_evening_start_slot = strtotime($_POST['friday_evening_start_time']);
						$friday_evening_end_time = strtotime($_POST['friday_evening_end_time']);
						while($friday_evening_start_slot <= $friday_evening_end_time) {
							if($friday_evening_start_slot == $friday_evening_end_time){break;}
							$friday_evening_end_slot = $friday_evening_start_slot+(60*5);
							$slot = date('H:i', $friday_evening_start_slot).'-'.date('H:i', $friday_evening_end_slot);
							$friday_slots[] = $slot;
							$friday_evening_start_slot = $friday_evening_end_slot;
						}
					}
				}				
				//Saturday Slots
				if(!isset($_POST['saturday_off'])){
					// Saturday First Half
					if(!isset($_POST['saturday_morning_off'])){
						$saturday_morning_start_time = $saturday_morning_start_slot = strtotime($_POST['saturday_morning_start_time']);
						$saturday_morning_end_time = strtotime($_POST['saturday_morning_end_time']);
						while($saturday_morning_start_slot <= $saturday_morning_end_time) {
							if($saturday_morning_start_slot == $saturday_morning_end_time){break;}
							$saturday_morning_end_slot = $saturday_morning_start_slot+(60*5);;
							$slot = date('H:i', $saturday_morning_start_slot).'-'.date('H:i', $saturday_morning_end_slot);
							$saturday_slots[] = $slot;
							$saturday_morning_start_slot = $saturday_morning_end_slot;
						}
					}
					// Saturday Second Half
					if(!isset($_POST['saturday_evening_off'])){
						$saturday_evening_start_time = $saturday_evening_start_slot = strtotime($_POST['saturday_evening_start_time']);
						$saturday_evening_end_time = strtotime($_POST['saturday_evening_end_time']);
						while($saturday_evening_start_slot <= $saturday_evening_end_time) {
							if($saturday_evening_start_slot == $saturday_evening_end_time){break;}
							$saturday_evening_end_slot = $saturday_evening_start_slot+(60*5);
							$slot = date('H:i', $saturday_evening_start_slot).'-'.date('H:i', $saturday_evening_end_slot);
							$saturday_slots[] = $slot;
							$saturday_evening_start_slot = $saturday_evening_end_slot;
						}
					}
				}				
				//Sunday Slots
				if(!isset($_POST['sunday_off'])){
					// Sunday First Half
					if(!isset($_POST['sunday_morning_off'])){
						$sunday_morning_start_time = $sunday_morning_start_slot = strtotime($_POST['sunday_morning_start_time']);
						$sunday_morning_end_time = strtotime($_POST['sunday_morning_end_time']);
						while($sunday_morning_start_slot <= $sunday_morning_end_time) {
							if($sunday_morning_start_slot == $sunday_morning_end_time){break;}
							$sunday_morning_end_slot = $sunday_morning_start_slot+(60*5);
							$slot = date('H:i', $sunday_morning_start_slot).'-'.date('H:i', $sunday_morning_end_slot);
							$sunday_slots[] = $slot;
							$sunday_morning_start_slot = $sunday_morning_end_slot;
						}
					}
					// Sunday Second Half
					if(!isset($_POST['sunday_evening_off'])){
						$sunday_evening_start_time = $sunday_evening_start_slot = strtotime($_POST['sunday_evening_start_time']);
						$sunday_evening_end_time = strtotime($_POST['sunday_evening_end_time']);
						while($sunday_evening_start_slot <= $sunday_evening_end_time) {
							if($sunday_evening_start_slot == $sunday_evening_end_time){break;}
							$sunday_evening_end_slot = $sunday_evening_start_slot+(60*5);
							$slot = date('H:i', $sunday_evening_start_slot).'-'.date('H:i', $sunday_evening_end_slot);
							$sunday_slots[] = $slot;
							$sunday_evening_start_slot = $sunday_evening_end_slot;
						}
					}
				}
				$_POST['monday_slots'] = !empty($monday_slots)?serialize($monday_slots):'';
				$_POST['tuesday_slots'] = !empty($tuesday_slots)?serialize($tuesday_slots):'';
				$_POST['wednesday_slots'] = !empty($wednesday_slots)?serialize($wednesday_slots):'';
				$_POST['thursday_slots'] = !empty($thursday_slots)?serialize($thursday_slots):'';
				$_POST['friday_slots'] = !empty($friday_slots)?serialize($friday_slots):'';
				$_POST['saturday_slots'] = !empty($saturday_slots)?serialize($saturday_slots):'';
				$_POST['sunday_slots'] = !empty($sunday_slots)?serialize($sunday_slots):'';
				if(!isset($_POST['on_holiday'])){$_POST['on_holiday_daterange'] == "";}
				if(isset($_POST['password']) && !empty($_POST['password'])){$_POST['password'] = md5($_POST['password']);}
				
				
				/*var_dump($_POST);echo '<br/>';echo '<br/>';echo '<br/>';
				var_dump($monday_slots); echo '<br/><br/>';
				var_dump($tuesday_slots); echo '<br/><br/>';
				var_dump($wednesday_slots); echo '<br/><br/>';
				var_dump($thursday_slots); echo '<br/><br/>';
				var_dump($friday_slots); echo '<br/><br/>';
				var_dump($saturday_slots); echo '<br/><br/>';
				var_dump($sunday_slots); echo '<br/><br/>';
				die;*/
				
				$data = $this->doctors_model->add_doctor($_POST);
				if($data > 0){
					header("location:" .base_url(). "doctors/add?m=".base64_encode('Doctor added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "doctors/add?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$data['centers'] = $this->center_model->get_centers();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/add_doctor', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function add_junior_doctors()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_junior_doctors'){
				unset($_POST['action']);

				$username = $_POST['username'];
				$check_doctor = $this->doctors_model->check_doctor($username);
				//var_dump($check_doctor);die;
				if($check_doctor > 0){
					//var_dump($check_doctor);die;
					header("location:" .base_url(). "junior-doctors/add?m=".base64_encode('Username already exist!').'&t='.base64_encode('error'));
					die();
				}
				$_POST['junior_doctor'] = 1;
				if(isset($_POST['password']) && !empty($_POST['password'])){$_POST['password'] = md5($_POST['password']);}

				// var_dump($_POST);
				// echo '<br/>';echo '<br/>';echo '<br/>';
				// die;
				$doctor_lists = $_POST['doctors']; unset($_POST['doctors']);
				$data = $this->doctors_model->add_junior_doctors($_POST);
				if($data > 0){					
					$doctor_relationship = $this->doctors_model->doctor_relationship($data, $doctor_lists);
					header("location:" .base_url(). "junior-doctors?m=".base64_encode('Junior Doctor added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "junior-doctors/add?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$data['doctors'] = $this->doctors_model->get_doctors_list();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/add_junior_doctors', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function edit()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			
			if(isset($_GET['id'])){
				if(isset($_GET['id'])){ $item_id = $_GET['id']; }
				if(isset($_POST['id'])) { $item_id = $_POST['id']; }
				
				if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_doctor'){
						unset($_POST['action']);
						$post_arr = $monday_slots = $tuesday_slots = $wednesday_slots = $thursday_slots = $friday_slots = $saturday_slots = $sunday_slots = array();
						
					//Monday Slots
					if(!isset($_POST['monday_off'])){
						$_POST['monday_off'] = 0;
						// Monday First Half
						if(!isset($_POST['monday_morning_off'])){
							$_POST['monday_morning_off'] = 0;
							$monday_morning_start_time = $monday_morning_start_slot = strtotime($_POST['monday_morning_start_time']);
							$monday_morning_end_time = strtotime($_POST['monday_morning_end_time']);
							
							while($monday_morning_start_slot <= $monday_morning_end_time) {
								if($monday_morning_start_slot == $monday_morning_end_time){break;}
								$monday_morning_end_slot = $monday_morning_start_slot+(60*5);
								$slot = date('H:i', $monday_morning_start_slot).'-'.date('H:i', $monday_morning_end_slot);
								$monday_slots[] = $slot;
								$monday_morning_start_slot = $monday_morning_end_slot;
							}
						}
	
						// Monday Second Half
						if(!isset($_POST['monday_evening_off'])){
							$_POST['monday_evening_off'] = 0;
							$monday_evening_start_time = $monday_evening_start_slot = strtotime($_POST['monday_evening_start_time']);
							$monday_evening_end_time = strtotime($_POST['monday_evening_end_time']);
							while($monday_evening_start_slot <= $monday_evening_end_time) {
								if($monday_evening_start_slot == $monday_evening_end_time){break;}
								$monday_evening_end_slot = $monday_evening_start_slot+(60*5);
								$slot = date('H:i', $monday_evening_start_slot).'-'.date('H:i', $monday_evening_end_slot);
								$monday_slots[] = $slot;
								$monday_evening_start_slot = $monday_evening_end_slot;
							}
						}
					}	
						
					//Tuesday Slots
					if(!isset($_POST['tuesday_off'])){
							$_POST['tuesday_off'] = 0;
						// Tuesday First Half
						if(!isset($_POST['tuesdy_morning_off'])){
							$_POST['tuesdy_morning_off'] = 0;
							$tuesday_morning_start_time = $tuesday_morning_start_slot = strtotime($_POST['tuesday_morning_start_time']);
							$tuesday_morning_end_time = strtotime($_POST['tuesday_morning_end_time']);
							while($tuesday_morning_start_slot <= $tuesday_morning_end_time) {
								if($tuesday_morning_start_slot == $tuesday_morning_end_time){break;}
								$tuesday_morning_end_slot = $tuesday_morning_start_slot+(60*5);
								$slot = date('H:i', $tuesday_morning_start_slot).'-'.date('H:i', $tuesday_morning_end_slot);
								$tuesday_slots[] = $slot;
								$tuesday_morning_start_slot = $tuesday_morning_end_slot;
							}
						}
						// Tuesday Second Half
						if(!isset($_POST['tuesdy_evening_off'])){
							$_POST['tuesdy_evening_off'] = 0;
							$tuesday_evening_start_time = $tuesday_evening_start_slot = strtotime($_POST['tuesday_evening_start_time']);
							$tuesday_evening_end_time = strtotime($_POST['tuesday_evening_end_time']);
							while($tuesday_evening_start_slot <= $tuesday_evening_end_time) {
								if($tuesday_evening_start_slot == $tuesday_evening_end_time){break;}
								$tuesday_evening_end_slot = $tuesday_evening_start_slot+(60*5);
								$slot = date('H:i', $tuesday_evening_start_slot).'-'.date('H:i', $tuesday_evening_end_slot);
								$tuesday_slots[] = $slot;
								$tuesday_evening_start_slot = $tuesday_evening_end_slot;
							}
						}
					}				
					//Wednesday Slots
					if(!isset($_POST['wednesday_off'])){
							$_POST['wednesday_off'] = 0;
						// Wednesday First Half
						if(!isset($_POST['wednesday_morning_off'])){
							$_POST['wednesday_morning_off'] = 0;
							$wednesday_morning_start_time = $wednesday_morning_start_slot = strtotime($_POST['wednesday_morning_start_time']);
							$wednesday_morning_end_time = strtotime($_POST['wednesday_morning_end_time']);
							while($wednesday_morning_start_slot <= $wednesday_morning_end_time) {
								if($wednesday_morning_start_slot == $wednesday_morning_end_time){break;}
								$wednesday_morning_end_slot = $wednesday_morning_start_slot+(60*5);
								$slot = date('H:i', $wednesday_morning_start_slot).'-'.date('H:i', $wednesday_morning_end_slot);
								$wednesday_slots[] = $slot;
								$wednesday_morning_start_slot = $wednesday_morning_end_slot;
							}
						}
						// Wednesday Second Half
						if(!isset($_POST['wednesday_evening_off'])){
							$_POST['wednesday_evening_off'] = 0;
							$wednesday_evening_start_time = $wednesday_evening_start_slot = strtotime($_POST['wednesday_evening_start_time']);
							$wednesday_evening_end_time = strtotime($_POST['wednesday_evening_end_time']);
							while($wednesday_evening_start_slot <= $wednesday_evening_end_time) {
								if($wednesday_evening_start_slot == $wednesday_evening_end_time){break;}
								$wednesday_evening_end_slot = $wednesday_evening_start_slot+(60*5);
								$slot = date('H:i', $wednesday_evening_start_slot).'-'.date('H:i', $wednesday_evening_end_slot);
								$wednesday_slots[] = $slot;
								$wednesday_evening_start_slot = $wednesday_evening_end_slot;
							}
						}
					}				
					//thursday Slots
					if(!isset($_POST['thursday_off'])){
							$_POST['thursday_off'] = 0;
						// thursday First Half
						if(!isset($_POST['thursday_morning_off'])){
							$_POST['thursday_morning_off'] = 0;
							$thursday_morning_start_time = $thursday_morning_start_slot = strtotime($_POST['thursday_morning_start_time']);
							$thursday_morning_end_time = strtotime($_POST['thursday_morning_end_time']);
							while($thursday_morning_start_slot <= $thursday_morning_end_time) {
								if($thursday_morning_start_slot == $thursday_morning_end_time){break;}
								$thursday_morning_end_slot = $thursday_morning_start_slot+(60*5);
								$slot = date('H:i', $thursday_morning_start_slot).'-'.date('H:i', $thursday_morning_end_slot);
								$thursday_slots[] = $slot;
								$thursday_morning_start_slot = $thursday_morning_end_slot;
							}
						}
						// thursday Second Half
						if(!isset($_POST['thursday_evening_off'])){
							$_POST['thursday_evening_off'] = 0;
							$thursday_evening_start_time = $thursday_evening_start_slot = strtotime($_POST['thursday_evening_start_time']);
							$thursday_evening_end_time = strtotime($_POST['thursday_evening_end_time']);
							while($thursday_evening_start_slot <= $thursday_evening_end_time) {
								if($thursday_evening_start_slot == $thursday_evening_end_time){break;}
								$thursday_evening_end_slot = $thursday_evening_start_slot+(60*5);
								$slot = date('H:i', $thursday_evening_start_slot).'-'.date('H:i', $thursday_evening_end_slot);
								$thursday_slots[] = $slot;
								$thursday_evening_start_slot = $thursday_evening_end_slot;
							}
						}
					}				
					//Friday Slots
					if(!isset($_POST['friday_off'])){
							$_POST['friday_off'] = 0;
						// Friday First Half
						if(!isset($_POST['friday_morning_off'])){
							$_POST['friday_morning_off'] = 0;
							$friday_morning_start_time = $friday_morning_start_slot = strtotime($_POST['friday_morning_start_time']);
							$friday_morning_end_time = strtotime($_POST['friday_morning_end_time']);
							while($friday_morning_start_slot <= $friday_morning_end_time) {
								if($friday_morning_start_slot == $friday_morning_end_time){break;}
								$friday_morning_end_slot = $friday_morning_start_slot+(60*5);
								$slot = date('H:i', $friday_morning_start_slot).'-'.date('H:i', $friday_morning_end_slot);
								$friday_slots[] = $slot;
								$friday_morning_start_slot = $friday_morning_end_slot;
							}
						}
						// Friday Second Half
						if(!isset($_POST['friday_evening_off'])){
							$_POST['friday_evening_off'] = 0;
							$friday_evening_start_time = $friday_evening_start_slot = strtotime($_POST['friday_evening_start_time']);
							$friday_evening_end_time = strtotime($_POST['friday_evening_end_time']);
							while($friday_evening_start_slot <= $friday_evening_end_time) {
								if($friday_evening_start_slot == $friday_evening_end_time){break;}
								$friday_evening_end_slot = $friday_evening_start_slot+(60*5);
								$slot = date('H:i', $friday_evening_start_slot).'-'.date('H:i', $friday_evening_end_slot);
								$friday_slots[] = $slot;
								$friday_evening_start_slot = $friday_evening_end_slot;
							}
						}
					}				
					//Saturday Slots
					if(!isset($_POST['saturday_off'])){
							$_POST['saturday_off'] = 0;
						// Saturday First Half
						if(!isset($_POST['saturday_morning_off'])){
							$_POST['saturday_morning_off'] = 0;
							$saturday_morning_start_time = $saturday_morning_start_slot = strtotime($_POST['saturday_morning_start_time']);
							$saturday_morning_end_time = strtotime($_POST['saturday_morning_end_time']);
							while($saturday_morning_start_slot <= $saturday_morning_end_time) {
								if($saturday_morning_start_slot == $saturday_morning_end_time){break;}
								$saturday_morning_end_slot = $saturday_morning_start_slot+(60*5);;
								$slot = date('H:i', $saturday_morning_start_slot).'-'.date('H:i', $saturday_morning_end_slot);
								$saturday_slots[] = $slot;
								$saturday_morning_start_slot = $saturday_morning_end_slot;
							}
						}
						// Saturday Second Half
						if(!isset($_POST['saturday_evening_off'])){
							$_POST['saturday_evening_off'] = 0;
							$saturday_evening_start_time = $saturday_evening_start_slot = strtotime($_POST['saturday_evening_start_time']);
							$saturday_evening_end_time = strtotime($_POST['saturday_evening_end_time']);
							while($saturday_evening_start_slot <= $saturday_evening_end_time) {
								if($saturday_evening_start_slot == $saturday_evening_end_time){break;}
								$saturday_evening_end_slot = $saturday_evening_start_slot+(60*5);
								$slot = date('H:i', $saturday_evening_start_slot).'-'.date('H:i', $saturday_evening_end_slot);
								$saturday_slots[] = $slot;
								$saturday_evening_start_slot = $saturday_evening_end_slot;
							}
						}
					}				
					//Sunday Slots
					if(!isset($_POST['sunday_off'])){
							$_POST['sunday_off'] = 0;
						// Sunday First Half
						if(!isset($_POST['sunday_morning_off'])){
							$_POST['sunday_morning_off'] = 0;
							$sunday_morning_start_time = $sunday_morning_start_slot = strtotime($_POST['sunday_morning_start_time']);
							$sunday_morning_end_time = strtotime($_POST['sunday_morning_end_time']);
							while($sunday_morning_start_slot <= $sunday_morning_end_time) {
								if($sunday_morning_start_slot == $sunday_morning_end_time){break;}
								$sunday_morning_end_slot = $sunday_morning_start_slot+(60*5);
								$slot = date('H:i', $sunday_morning_start_slot).'-'.date('H:i', $sunday_morning_end_slot);
								$sunday_slots[] = $slot;
								$sunday_morning_start_slot = $sunday_morning_end_slot;
							}
						}
						// Sunday Second Half
						if(!isset($_POST['sunday_evening_off'])){
							$_POST['sunday_evening_off'] = 0;
							$sunday_evening_start_time = $sunday_evening_start_slot = strtotime($_POST['sunday_evening_start_time']);
							$sunday_evening_end_time = strtotime($_POST['sunday_evening_end_time']);
							while($sunday_evening_start_slot <= $sunday_evening_end_time) {
								if($sunday_evening_start_slot == $sunday_evening_end_time){break;}
								$sunday_evening_end_slot = $sunday_evening_start_slot+(60*5);
								$slot = date('H:i', $sunday_evening_start_slot).'-'.date('H:i', $sunday_evening_end_slot);
								$sunday_slots[] = $slot;
								$sunday_evening_start_slot = $sunday_evening_end_slot;
							}
						}
					}
					$_POST['monday_slots'] = !empty($monday_slots)?serialize($monday_slots):'';
					$_POST['tuesday_slots'] = !empty($tuesday_slots)?serialize($tuesday_slots):'';
					$_POST['wednesday_slots'] = !empty($wednesday_slots)?serialize($wednesday_slots):'';
					$_POST['thursday_slots'] = !empty($thursday_slots)?serialize($thursday_slots):'';
					$_POST['friday_slots'] = !empty($friday_slots)?serialize($friday_slots):'';
					$_POST['saturday_slots'] = !empty($saturday_slots)?serialize($saturday_slots):'';
					$_POST['sunday_slots'] = !empty($sunday_slots)?serialize($sunday_slots):'';
					if(!isset($_POST['on_holiday'])){$_POST['on_holiday_daterange'] == "";}
					if(isset($_POST['password']) && !empty($_POST['password'])){$_POST['password'] = md5($_POST['password']);}
					else{unset($_POST['password']);}
					if(!isset($_POST['is_primary'])){$_POST['is_primary'] = 0;}
					
					/*var_dump($_POST);echo '<br/>';echo '<br/>';echo '<br/>';
					var_dump($monday_slots); echo '<br/><br/>';
					var_dump($tuesday_slots); echo '<br/><br/>';
					var_dump($wednesday_slots); echo '<br/><br/>';
					var_dump($thursday_slots); echo '<br/><br/>';
					var_dump($friday_slots); echo '<br/><br/>';
					var_dump($saturday_slots); echo '<br/><br/>';
					var_dump($sunday_slots); echo '<br/><br/>';
					die;*/
					
					$data = $this->doctors_model->update_doctor_data($_POST, $item_id);
					if($data > 0){
						header("location:" .base_url(). "doctors/edit?m=".base64_encode('Doctor updated successfully !').'&t='.base64_encode('success').'&id='.$item_id);
						die();
					}else{
						header("location:" .base_url(). "doctors/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&id='.$item_id);
						die();
					}				
				}
				$data['data'] = $this->doctors_model->get_doctor_data($item_id);
				$data['centers'] = $this->center_model->get_centers();
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('doctors/edit_doctor', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "doctors");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function edit_junior_doctors()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			
			if(isset($_GET['id'])){
				if(isset($_GET['id'])){ $item_id = $_GET['id']; }
				if(isset($_POST['id'])) { $item_id = $_POST['id']; }
				
				if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_junior_doctors'){
					unset($_POST['action']);
					
					if(isset($_POST['password']) && !empty($_POST['password'])){$_POST['password'] = md5($_POST['password']);}
					else{unset($_POST['password']);}
					
					$doctor_lists = $_POST['doctors']; unset($_POST['doctors']);
					$data = $this->doctors_model->update_doctor_data($_POST, $item_id);
					if($data > 0){
						$update_doctor_relationship = $this->doctors_model->update_doctor_relationship($item_id, $doctor_lists);
						header("location:" .base_url(). "junior-doctors/edit?m=".base64_encode('Junior Doctor updated successfully !').'&t='.base64_encode('success').'&id='.$item_id);
						die();
					}else{
						header("location:" .base_url(). "junior-doctors/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&id='.$item_id);
						die();
					}				
				}
				$data['data'] = $this->doctors_model->get_doctor_data($item_id);
				$data['doctors'] = $this->doctors_model->get_doctors_list();
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('doctors/edit_junior_doctors', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "doctors");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function delete()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_GET['id'])){	
				$item = $_GET['id'];
				if( $item > 0 )
				{
					if( $this->doctors_model->delete_doctor_data($item) !== 0)
					{
						header("location:" .base_url(). "doctors?m=".base64_encode('Doctor deleted successfully !').'&t='.base64_encode('success'));
						die();
					}
					else
					{
						header("location:" .base_url(). "doctors?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}
				}
				header("location:" .base_url(). "doctors?m=".base64_encode('Doctor not found !').'&t='.base64_encode('error'));
				die();
			}else{
				header("location:" .base_url(). "doctors");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function delete_junior_doctors()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_GET['id'])){	
				$item = $_GET['id'];
				if( $item > 0 )
				{
					if( $this->doctors_model->delete_junior_doctor_data($item) !== 0)
					{
						header("location:" .base_url(). "junior-doctors?m=".base64_encode('Junior Doctor deleted successfully !').'&t='.base64_encode('success'));
						die();
					}
					else
					{
						header("location:" .base_url(). "junior-doctors?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}
				}
				header("location:" .base_url(). "junior-doctors?m=".base64_encode('Junior Doctor not found !').'&t='.base64_encode('error'));
				die();
			}else{
				header("location:" .base_url(). "junior-doctors");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function doctor_consultations(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->doctors_model->get_doctor_consultations();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/doctor_consultations', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function disapprove_consultation_done($id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
	    	$disapprove_reason = isset($_GET['t'])?$_GET['t']:"";
			$status = $this->doctors_model->disapprove_consultation_done($id, $disapprove_reason);
			if($status > 0){
				header("location:" .base_url()."doctor-consultations?m=".base64_encode('Doctor Consultation disapproved!').'&t='.base64_encode('success'));
				die();
			}else{
				header("location:" .base_url()."doctor-consultations?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	// Dashbaord START

	public function login(){
		$logg = checklogin();
		if($logg['status'] == true){
			header("location:" .base_url(). "dashboard");
			die;
		}else{
			if(isset($_POST['login']) && !empty($_POST['login']) && $_POST['login'] == 'login'){
				unset($_POST['login']);
				$logged = $this->doctors_model->login($_POST);
	
				if($logged['status'] == 1){
					header("location:" .base_url(). "dashboard");
					die();
				}else{
					header("location:" .base_url(). "");
					die();
				}
			}else{
				$this->load->view('templates/header');
				$this->load->view('doctors/login');
				$this->load->view('templates/footer');
			}
		}
	}
	
	public function doctor_appointments(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){
			$data = array(); $doctor_id = "";
			// Get Parameter from front end
			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$status = $this->input->get('status', true);
			$start_date = $this->input->get('start_date', true);
			$end_date = $this->input->get('end_date', true);
			$patient_id = $this->input->get('patient_id', true);
			$patient_name = $this->input->get('patient_name', true);

			$doctor_id = $_SESSION['logged_doctor']['doctor_id'];
			$config = array();
        	$config["base_url"] = base_url() . "doctor_appointments";
        	$config["total_rows"] = $this->doctors_model->get_doctor_count($doctor_id, $status, $start_date, $end_date, $patient_id, $patient_name);
        	$config["per_page"] = 20;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
			
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			
        	$data["links"] = $this->pagination->create_links();
			
			//$data['appointments'] = $this->doctors_model->doctor_appointment_lists($doctor_id);
			$data['appointments'] = $this->doctors_model->doctor_appointment_lists_pagination($doctor_id, $config["per_page"], $per_page, $status, $start_date, $end_date, $patient_id, $patient_name);
			$data["status"] = $status;
			$data["start_date"] = $start_date;
			$data["end_date"] = $end_date;
			$data["patient_name"] = $patient_name;
			$data["patient_id"] = $patient_id;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/appointment', $data);
			$this->load->view($template['footer']);
			
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function junior_doctor_appointments(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$junior_id = 0;
			$junior_id = $_SESSION['logged_doctor']['doctor_id'];
			$data['appointments'] = $this->doctors_model->junior_doctor_appointment_lists($junior_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/junior_doctor_appointments', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function get_consultation($appointments_id){
		$data = $this->billingmodel_model->get_consultation_data($appointments_id);
		return $data;
	}
	
	public function consultation_done($appointment_id){
		$logg = checklogin();
		if($logg['status'] == true){
			
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_consultation_done'){
				unset($_POST['action']);
				
				$redirect_url = "doctor_appointments";
				if($_SESSION['logged_doctor']['junior_doctor'] == 1){
					$redirect_url = "jd_appointments";
				}

				if(isset($_POST['medicine_suggestion'])){
					$male_med_array = $female_med_array = array();
					foreach($_POST as $key => $val){
						if (substr( $key, 0, 19 ) === "male_medicine_name_") {
							$male_med_array[] = $key;
						}
						if (substr( $key, 0, 21 ) === "female_medicine_name_") {
							$female_med_array[] = $key;
						}
					}

					$male_med_number = $female_med_number = array();
					foreach($male_med_array as $key => $val){
							$explode = explode('male_medicine_name_', $val);
							$male_med_number[] = $explode[1];
					}
					foreach($female_med_array as $key => $val){
							$explode = explode('female_medicine_name_', $val);
							$female_med_number[] = $explode[1];
					}
					$male_med_number = array_unique($male_med_number);
					$female_med_number = array_unique($female_med_number);
					
					$male_medicine_suggestion_list = $female_medicine_suggestion_list = array();
					
					foreach($male_med_number as $key => $val){
						$male_medicine_suggestion_list['male_medicine_suggestion_list'][] = array(
							 'male_medicine_name' => $_POST['male_medicine_name_'.$val],
							 'male_medicine_dosage' => $_POST['male_medicine_dosage_'.$val],
							 'male_medicine_when_start' => $_POST['male_medicine_when_start_'.$val],
							 'male_medicine_days' => $_POST['male_medicine_days_'.$val],
							 'male_medicine_route' => $_POST['male_medicine_route_'.$val],
							 'male_medicine_frequency' => $_POST['male_medicine_frequency_'.$val],
							 'male_medicine_timing' => $_POST['male_medicine_timing_'.$val],
							 'male_medicine_take' => $_POST['male_medicine_take_'.$val]
							);
						unset($_POST['male_medicine_name_'.$val]);
						unset($_POST['male_medicine_dosage_'.$val]);
						unset($_POST['male_medicine_when_start_'.$val]);
						unset($_POST['male_medicine_days_'.$val]);
						unset($_POST['male_medicine_route_'.$val]);
						unset($_POST['male_medicine_frequency_'.$val]);
						unset($_POST['male_medicine_timing_'.$val]);
						unset($_POST['male_medicine_take_'.$val]);
					}
					$male_medicine_suggestion_list = serialize($male_medicine_suggestion_list);
					$_POST['male_medicine_suggestion_list'] = $male_medicine_suggestion_list;
					foreach($female_med_number as $key => $val){
						$female_medicine_suggestion_list['female_medicine_suggestion_list'][] = array(
							 'female_medicine_name' => $_POST['female_medicine_name_'.$val],
							 'female_medicine_dosage' => $_POST['female_medicine_dosage_'.$val],
							 'female_medicine_when_start' => $_POST['female_medicine_when_start_'.$val],
							 'female_medicine_days' => $_POST['female_medicine_days_'.$val],
							 'female_medicine_route' => $_POST['female_medicine_route_'.$val],
							 'female_medicine_frequency' => $_POST['female_medicine_frequency_'.$val],
							 'female_medicine_timing' => $_POST['female_medicine_timing_'.$val],
							 'female_medicine_take' => $_POST['female_medicine_take_'.$val]
						);
						unset($_POST['female_medicine_name_'.$val]);
						unset($_POST['female_medicine_dosage_'.$val]);
						unset($_POST['female_medicine_when_start_'.$val]);
						unset($_POST['female_medicine_days_'.$val]);
						unset($_POST['female_medicine_route_'.$val]);
						unset($_POST['female_medicine_frequency_'.$val]);
						unset($_POST['female_medicine_timing_'.$val]);
						unset($_POST['female_medicine_take_'.$val]);
					}
					$female_medicine_suggestion_list = serialize($female_medicine_suggestion_list);
					$_POST['female_medicine_suggestion_list'] = $female_medicine_suggestion_list;
				}
				
				if(isset($_POST['investigation_suggestion'])){
					if(!empty($_POST['male_investigation_suggestion_list'])){
						$male_investigation_suggestion_list = array();
						$male_investigation_suggestion_list = $_POST['male_investigation_suggestion_list'];unset($_POST['male_investigation_suggestion_list']);
						$_POST['male_investigation_suggestion_list'] = serialize($male_investigation_suggestion_list);
					}
					if(!empty($_POST['female_investigation_suggestion_list'])){
						$female_investigation_suggestion_list = array();
						$female_investigation_suggestion_list = $_POST['female_investigation_suggestion_list'];unset($_POST['female_investigation_suggestion_list']);
						$_POST['female_investigation_suggestion_list'] = serialize($female_investigation_suggestion_list);
					}	
					
				}
				if(isset($_POST['procedure_suggestion'])){
				    if(isset($_POST['sub_procedure_suggestion_list']) && !empty($_POST['sub_procedure_suggestion_list'])){
					    $_POST['sub_procedure_suggestion_list'] = serialize($_POST['sub_procedure_suggestion_list']);
				    }
				}

				$prescription = '';
				if(!empty($_FILES['prescription']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$_POST['patient_id']."-".$_FILES['prescription']['name'];
					$prescription = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['prescription']['tmp_name'], $destination.$NewImageName);
				}

				//var_dump($_POST);die;
				$consultation_post = array();

				if($_POST['submit_type'] == "save_exit"){
					$consultation_post['edit_mode'] = 1;
					$consultation_post['final_mode'] = 0;
					$consultation_post['disapproval_reason'] = isset($_POST['disapproval_reason'])?$_POST['disapproval_reason']:''; unset($_POST['disapproval_reason']);
				}
				if($_POST['submit_type'] == "exit"){
					$consultation_post['edit_mode'] = 1;
					$consultation_post['final_mode'] = 1;
					$consultation_post['disapproval_reason'] = ''; unset($_POST['disapproval_reason']);
				}
				unset($_POST['submit_type']);
				
				$consultation_post['appointment_id'] = $_POST['appointment_id'];
				$consultation_post['patient_id'] = $_POST['patient_id'];
				$consultation_post['wife_phone'] = $_POST['wife_phone'];
				$consultation_post['doctor_id'] = $_POST['doctor_id']; unset($_POST['doctor_id']);
				$consultation_post['urosurgeon_findings'] = isset($_POST['urosurgeon_findings'])?$_POST['urosurgeon_findings']:''; unset($_POST['urosurgeon_findings']);
				$consultation_post['follow_up'] = isset($_POST['follow_up'])?$_POST['follow_up']:""; unset($_POST['follow_up']);
				$consultation_post['follow_up_date'] = isset($_POST['follow_up_date'])?$_POST['follow_up_date']:"";unset($_POST['follow_up_date']);
				$consultation_post['follow_slot'] = isset($_POST['appoitmented_slot'])?$_POST['appoitmented_slot']:"";unset($_POST['appoitmented_slot']);
				$consultation_post['follow_up_purpose'] = isset($_POST['follow_up_purpose'])?$_POST['follow_up_purpose']:""; unset($_POST['follow_up_purpose']);
				
				if(isset($_POST['medicine_suggestion'])){
					$consultation_post['medicine_suggestion'] = $_POST['medicine_suggestion']; unset($_POST['medicine_suggestion']);
					if(isset($male_medicine_suggestion_list) && !empty($male_medicine_suggestion_list)){
						$consultation_post['male_medicine_suggestion_list'] = $male_medicine_suggestion_list;
					} unset($_POST['male_medicine_suggestion_list']);
					if(isset($female_medicine_suggestion_list) && !empty($female_medicine_suggestion_list)){
						$consultation_post['female_medicine_suggestion_list'] = $female_medicine_suggestion_list; 
					}unset($_POST['female_medicine_suggestion_list']);
					
				}
				if(isset($_POST['investigation_suggestion'])){
					$consultation_post['investation_suggestion'] = $_POST['investigation_suggestion']; unset($_POST['investigation_suggestion']);
					if(isset($_POST['male_investigation_suggestion_list']) && !empty($_POST['male_investigation_suggestion_list'])){
						$consultation_post['male_investigation_suggestion_list'] = $_POST['male_investigation_suggestion_list'];
					} unset($_POST['male_investigation_suggestion_list']);
					if(isset($_POST['female_investigation_suggestion_list']) && !empty($_POST['female_investigation_suggestion_list'])){
						$consultation_post['female_investigation_suggestion_list'] = $_POST['female_investigation_suggestion_list'];
					} unset($_POST['female_investigation_suggestion_list']);
				}
				if(isset($_POST['procedure_suggestion'])){
					$consultation_post['procedure_suggestion'] = $_POST['procedure_suggestion']; unset($_POST['procedure_suggestion']);
					$consultation_post['procedure_suggestion_list'] = ''; 
					$consultation_post['sub_procedure_suggestion_list'] = $_POST['sub_procedure_suggestion_list']; unset($_POST['sub_procedure_suggestion_list']);
				}
				$_POST['prescription'] = $prescription;
				$consultation_post['prescription'] = $prescription;
				$consultation_post['consultation_date'] = date("Y-m-d H:i:s");
	
			
				if($consultation_post['follow_up'] == 1){
				    if(empty($_POST['appoitment_for']) && empty($consultation_post['follow_up_date']) && empty($_POST['appoitmented_doctor']) && empty($consultation_post['follow_slot'])){
    				    header("location:" .base_url().$redirect_url."?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
    					die();
    				}
				    
					$patient_details  = get_patient_detail($consultation_post['patient_id']);
					$doctor_details = doctor_details($consultation_post['doctor_id']);
					$appointment_arr = array();
					$appointment_arr['paitent_type'] = 'exist_patient';
					$appointment_arr['paitent_id'] = $consultation_post['patient_id'];
					$appointment_arr['wife_name'] = $patient_details['wife_name'];
					$appointment_arr['wife_phone'] = $consultation_post['wife_phone'];
					$appointment_arr['wife_email'] = $patient_details['wife_email'];;
					$appointment_arr['nationality'] = $patient_details['nationality'];;
					$appointment_arr['reason_of_visit'] = $consultation_post['follow_up_purpose'];
					$appointment_arr['appoitment_for'] = $_POST['appoitment_for'];unset($_POST['appoitment_for']);
					$appointment_arr['appoitmented_date'] = $consultation_post['follow_up_date'];
					$appointment_arr['appoitmented_doctor'] = $_POST['appoitmented_doctor'];unset($_POST['appoitmented_doctor']);
					$appointment_arr['appoitmented_slot'] = $consultation_post['follow_slot'];
					$appointment_arr['follow_up_appointment'] = 1;
					$appointment_arr['previous_appointment'] = $consultation_post['appointment_id'];
					$appointment_arr['appointment_added'] = date('Y-m-d H:i:s');
					
					$appointment = $this->billingmodel_model->insert_appointments($appointment_arr);
					if($appointment > 0){
						$doctor_details = doctor_details($appointment_arr['appoitmented_doctor']);
						$patient_to = $patient_subject = $patient_message = $doctor_to = $doctor_subject = $doctor_message = "";
						//Patient emails
						$patient_to = $patient_details['wife_email'];
						$patient_subject = "Followup appointment booked";
						$patient_message = "Hi ".$patient_details['wife_name'].",<br/> Your followup appointment is booked with Dr.".$doctor_details['name']." on ".date("d-m-Y", strtotime($consultation_post['follow_up_date']))." at ".$consultation_post['follow_slot'].".";
						send_mail($patient_to, $patient_subject, $patient_message);
						
						$patient_phone = $patient_details['wife_phone'];
						$sms_message = "Hi ".$patient_details['wife_name'].", Your followup appointment is booked with Dr.".$doctor_details['name']." on ".date("d-m-Y", strtotime($consultation_post['follow_up_date']))." at ".$consultation_post['follow_slot'].".";
						send_sms($patient_phone, $sms_message);
						
						//Doctor emails
						$doctor_to = $doctor_details['email'];
						$doctor_subject = "Followup appointment";
						$doctor_message = "Hi Dr.".$doctor_details['name'].",<br/> Followup Appointment is booked on ".date("d-m-Y", strtotime($consultation_post['follow_up_date']))." at ".$consultation_post['follow_slot'].".";
						send_mail($doctor_to, $doctor_subject, $doctor_message);
					}

				}
				//var_dump($_POST);die;
				$consultation_done = $this->doctors_model->consultation_done($consultation_post);
				
				if($consultation_done > 0){
					if(isset($_POST['management_intervention'])){
						$_POST['management_intervention'] = serialize($_POST['management_intervention']);
					}
					$patient_medical_info = $this->doctors_model->patient_medical_info($_POST);
					$appointment_status = $this->appointment_model->appointment_status('consultation_done', $consultation_post['appointment_id']);
					
					header("location:" .base_url().$redirect_url."?m=".base64_encode('Consultation done!').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url().$redirect_url."?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			
			$data = array();
			$data['appointments'] = $this->appointment_model->doctor_appointment_details($appointment_id);
			$data['consultation_medicine'] = $this->doctors_model->consultation_medicine();
			$data['investigations'] = $this->investigation_model->get_investigations_list();
			$data['procedures'] = $this->procedures_model->get_procedures_list();			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('appointments/consultation_done', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	function follow_up($appointment_id){
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_consultation_done'){
				unset($_POST['action']);
				//var_dump($_POST);die;
				if(isset($_POST['medicine_suggestion'])){
					$male_med_array = $female_med_array = array();
					foreach($_POST as $key => $val){
						if (substr( $key, 0, 19 ) === "male_medicine_name_") {
							$male_med_array[] = $key;
						}
						if (substr( $key, 0, 21 ) === "female_medicine_name_") {
							$female_med_array[] = $key;
						}
					}

					$male_med_number = $female_med_number = array();
					foreach($male_med_array as $key => $val){
							$explode = explode('male_medicine_name_', $val);
							$male_med_number[] = $explode[1];
					}
					foreach($female_med_array as $key => $val){
							$explode = explode('female_medicine_name_', $val);
							$female_med_number[] = $explode[1];
					}
					$male_med_number = array_unique($male_med_number);
					$female_med_number = array_unique($female_med_number);
					
					$male_medicine_suggestion_list = $female_medicine_suggestion_list = array();
					
					foreach($male_med_number as $key => $val){
						$male_medicine_suggestion_list['male_medicine_suggestion_list'][] = array(
							 'male_medicine_name' => $_POST['male_medicine_name_'.$val],
							 'male_medicine_dosage' => $_POST['male_medicine_dosage_'.$val],
							 'male_medicine_when_start' => $_POST['male_medicine_when_start_'.$val],
							 'male_medicine_days' => $_POST['male_medicine_days_'.$val],
							 'male_medicine_route' => $_POST['male_medicine_route_'.$val],
							 'male_medicine_frequency' => $_POST['male_medicine_frequency_'.$val],
							 'male_medicine_timing' => $_POST['male_medicine_timing_'.$val],
							 'male_medicine_take' => $_POST['male_medicine_take_'.$val]
							);
						unset($_POST['male_medicine_name_'.$val]);
						unset($_POST['male_medicine_dosage_'.$val]);
						unset($_POST['male_medicine_when_start_'.$val]);
						unset($_POST['male_medicine_days_'.$val]);
						unset($_POST['male_medicine_route_'.$val]);
						unset($_POST['male_medicine_frequency_'.$val]);
						unset($_POST['male_medicine_timing_'.$val]);
						unset($_POST['male_medicine_take_'.$val]);
					}
					$male_medicine_suggestion_list = serialize($male_medicine_suggestion_list);
					$_POST['male_medicine_suggestion_list'] = $male_medicine_suggestion_list;
					foreach($female_med_number as $key => $val){
						$female_medicine_suggestion_list['female_medicine_suggestion_list'][] = array(
							 'female_medicine_name' => $_POST['female_medicine_name_'.$val],
							 'female_medicine_dosage' => $_POST['female_medicine_dosage_'.$val],
							 'female_medicine_when_start' => $_POST['female_medicine_when_start_'.$val],
							 'female_medicine_days' => $_POST['female_medicine_days_'.$val],
							 'female_medicine_route' => $_POST['female_medicine_route_'.$val],
							 'female_medicine_frequency' => $_POST['female_medicine_frequency_'.$val],
							 'female_medicine_timing' => $_POST['female_medicine_timing_'.$val],
							 'female_medicine_take' => $_POST['female_medicine_take_'.$val]
						);
						unset($_POST['female_medicine_name_'.$val]);
						unset($_POST['female_medicine_dosage_'.$val]);
						unset($_POST['female_medicine_when_start_'.$val]);
						unset($_POST['female_medicine_days_'.$val]);
						unset($_POST['female_medicine_route_'.$val]);
						unset($_POST['female_medicine_frequency_'.$val]);
						unset($_POST['female_medicine_timing_'.$val]);
						unset($_POST['female_medicine_take_'.$val]);
					}
					$female_medicine_suggestion_list = serialize($female_medicine_suggestion_list);
					$_POST['female_medicine_suggestion_list'] = $female_medicine_suggestion_list;
				}
				
				if(isset($_POST['investigation_suggestion'])){
					if(!empty($_POST['male_investigation_suggestion_list'])){
						$male_investigation_suggestion_list = array();
						$male_investigation_suggestion_list = $_POST['male_investigation_suggestion_list'];unset($_POST['male_investigation_suggestion_list']);
						$_POST['male_investigation_suggestion_list'] = serialize($male_investigation_suggestion_list);
					}
					if(!empty($_POST['female_investigation_suggestion_list'])){
						$female_investigation_suggestion_list = array();
						$female_investigation_suggestion_list = $_POST['female_investigation_suggestion_list'];unset($_POST['female_investigation_suggestion_list']);
						$_POST['female_investigation_suggestion_list'] = serialize($female_investigation_suggestion_list);
					}	
					
				}
				if(isset($_POST['procedure_suggestion'])){
					$_POST['sub_procedure_suggestion_list'] = serialize($_POST['sub_procedure_suggestion_list']);
				}

				$prescription = '';
				if(!empty($_FILES['prescription']['tmp_name'])){
					$dest_path = $this->config->item('upload_path');
					$destination = $dest_path.'patient_files/';
					$NewImageName = rand(4,10000)."-".$_POST['patient_id']."-".$_FILES['prescription']['name'];
					$prescription = base_url().'assets/patient_files/'.$NewImageName;
					move_uploaded_file($_FILES['prescription']['tmp_name'], $destination.$NewImageName);
				}
				//var_dump($_POST);die;
				$consultation_post = array();
				$consultation_post['appointment_id'] = $_POST['appointment_id']; unset($_POST['appointment_id']);
				$consultation_post['patient_id'] = $_POST['patient_id'];
				$consultation_post['wife_phone'] = $_POST['wife_phone'];
				$consultation_post['doctor_id'] = $_POST['doctor_id']; unset($_POST['doctor_id']);
				$consultation_post['female_findings'] = isset($_POST['female_findings'])?$_POST['female_findings']:''; unset($_POST['female_findings']);
				$consultation_post['male_findings'] = isset($_POST['male_findings'])?$_POST['male_findings']:''; unset($_POST['male_findings']);
				$consultation_post['follow_up'] = isset($_POST['follow_up'])?$_POST['follow_up']:""; unset($_POST['follow_up']);
				$consultation_post['follow_up_date'] = isset($_POST['follow_up_date'])?$_POST['follow_up_date']:"";unset($_POST['follow_up_date']);
				$consultation_post['follow_slot'] = isset($_POST['appoitmented_slot'])?$_POST['appoitmented_slot']:"";unset($_POST['appoitmented_slot']);
				$consultation_post['follow_up_purpose'] = isset($_POST['follow_up_purpose'])?$_POST['follow_up_purpose']:""; unset($_POST['follow_up_purpose']);
				
				if(isset($_POST['medicine_suggestion'])){
					$consultation_post['medicine_suggestion'] = $_POST['medicine_suggestion']; unset($_POST['medicine_suggestion']);
					if(isset($male_medicine_suggestion_list) && !empty($male_medicine_suggestion_list)){
						$consultation_post['male_medicine_suggestion_list'] = $male_medicine_suggestion_list;
					} unset($_POST['male_medicine_suggestion_list']);
					if(isset($female_medicine_suggestion_list) && !empty($female_medicine_suggestion_list)){
						$consultation_post['female_medicine_suggestion_list'] = $female_medicine_suggestion_list;
					} unset($_POST['female_medicine_suggestion_list']);
					
				}
				if(isset($_POST['investigation_suggestion'])){
					$consultation_post['investation_suggestion'] = $_POST['investigation_suggestion']; unset($_POST['investigation_suggestion']);
					if(isset($_POST['male_investigation_suggestion_list']) && !empty($_POST['male_investigation_suggestion_list'])){
						$consultation_post['male_investigation_suggestion_list'] = $_POST['male_investigation_suggestion_list'];
					}unset($_POST['male_investigation_suggestion_list']);
					if(isset($_POST['female_investigation_suggestion_list']) && !empty($_POST['female_investigation_suggestion_list'])){
						$consultation_post['female_investigation_suggestion_list'] = $_POST['female_investigation_suggestion_list'];
					} unset($_POST['female_investigation_suggestion_list']);
				}
				if(isset($_POST['procedure_suggestion'])){
    				$consultation_post['procedure_suggestion'] = $_POST['procedure_suggestion']; unset($_POST['procedure_suggestion']);
    				$consultation_post['procedure_suggestion_list'] = ''; 
    				$consultation_post['sub_procedure_suggestion_list'] = $_POST['sub_procedure_suggestion_list']; unset($_POST['sub_procedure_suggestion_list']);
				}
				$consultation_post['final_mode'] = 1;

				$_POST['prescription'] = $prescription;
				$consultation_post['prescription'] = $prescription;
				$consultation_post['consultation_date'] = date("Y-m-d H:i:s");
				
				if($consultation_post['follow_up'] == 1){
				    if(empty($_POST['appoitment_for']) && empty($consultation_post['follow_up_date']) && empty($_POST['appoitmented_doctor']) && empty($consultation_post['follow_slot'])){
    				    header("location:" .base_url(). "doctor_appointments?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
    					die();
    				}
					$patient_details  = get_patient_detail($consultation_post['patient_id']);
					$doctor_details = doctor_details($consultation_post['doctor_id']);
					$appointment_arr = array();
					$appointment_arr['paitent_type'] = 'exist_patient';
					$appointment_arr['paitent_id'] = $consultation_post['patient_id'];
					$appointment_arr['wife_name'] = $patient_details['wife_name'];
					$appointment_arr['wife_phone'] = $consultation_post['wife_phone'];
					$appointment_arr['wife_email'] = $patient_details['wife_email'];;
					$appointment_arr['nationality'] = $patient_details['nationality'];;
					$appointment_arr['reason_of_visit'] = $consultation_post['follow_up_purpose'];
					$appointment_arr['appoitment_for'] = $_POST['appoitment_for'];unset($_POST['appoitment_for']);
					$appointment_arr['appoitmented_date'] = $consultation_post['follow_up_date'];
					$appointment_arr['appoitmented_doctor'] = $_POST['appoitmented_doctor'];unset($_POST['appoitmented_doctor']);
					$appointment_arr['appoitmented_slot'] = $consultation_post['follow_slot'];
					$appointment_arr['follow_up_appointment'] = 1;
					$appointment_arr['previous_appointment'] = $consultation_post['appointment_id'];
					$appointment_arr['appointment_added'] = date('Y-m-d H:i:s');
					
					$appointment = $this->billingmodel_model->insert_appointments($appointment_arr);
					
					if($appointment > 0){
						$doctor_details = doctor_details($appointment_arr['appoitmented_doctor']);
						$patient_to = $patient_subject = $patient_message = $doctor_to = $doctor_subject = $doctor_message = "";
						//Patient emails
						$patient_to = $patient_details['wife_email'];
						$patient_subject = "Followup appointment booked";
						$patient_message = "Hi ".$patient_details['wife_name'].",<br/> Your followup appointment is booked with Dr.".$doctor_details['name']." on ".date("d-m-Y", strtotime($consultation_post['follow_up_date']))." at ".$consultation_post['follow_slot'].".";
						send_mail($patient_to, $patient_subject, $patient_message);
						
						$patient_phone = $patient_details['wife_phone'];
						$sms_message = "Hi ".$patient_details['wife_name'].", Your followup appointment is booked with Dr.".$doctor_details['name']." on ".date("d-m-Y", strtotime($consultation_post['follow_up_date']))." at ".$consultation_post['follow_slot'].".";
						send_sms($patient_phone, $sms_message);
						
						//Doctor emails
						$doctor_to = $doctor_details['email'];
						$doctor_subject = "Followup appointment";
						$doctor_message = "Hi Dr.".$doctor_details['name'].",<br/> Followup Appointment is booked on ".date("d-m-Y", strtotime($consultation_post['follow_up_date']))." at ".$consultation_post['follow_slot'].".";
						send_mail($doctor_to, $doctor_subject, $doctor_message);
					}
				}
				
				$consultation_done = $this->doctors_model->consultation_done($consultation_post);//var_dump($consultation_done);die;
				if($consultation_done > 0){
				    if(isset($_POST['advisory_templates']) && !empty($_POST['advisory_templates'])){
						$patient_details  = get_patient_detail($consultation_post['patient_id']);
						$patient_to = $patient_details['wife_email'];
						$patient_name = $patient_details['wife_name'];

						$advisory_subject = "IVF related advisory";
						$advisory_message = "Hi ".$patient_name.", Hope you are doing well!<br/>Here are some suggestion you can follow for successfull IVF. Please find the attached instruction below.<br/> Thanks & Regards<br/> IndiaIVF";
						$advisory_templates = implode(',', $_POST['advisory_templates']);
						send_mail($patient_to, $advisory_subject, $advisory_message, $advisory_templates);
					}
					$appointment_status = $this->appointment_model->appointment_status('consultation_done', $consultation_post['appointment_id']);
					header("location:" .base_url(). "doctor_appointments?m=".base64_encode('Consultation done!').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "doctor_appointments?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}

			$data = array();
			$data['appointments'] = $this->appointment_model->doctor_appointment_details($appointment_id);
			$data['consultation_medicine'] = $this->doctors_model->consultation_medicine();
			$data['investigations'] = $this->investigation_model->get_investigations_list();
			$data['procedures'] = $this->procedures_model->get_procedures_list();			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('appointments/follow_up', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	// Appointment Filter
	function ajax_appointment_filter(){
		
		if($_POST['type'] == 'appointment_status'){
			$status = $_POST['status'];
			$data = $this->appointment_model->ajax_appointment_status_data($status);
		}else if($_POST['type'] == 'date_wise'){
			$start = $_POST['start'];
			$end = $_POST['end'];
			$data = $this->appointment_model->ajax_appointment_date_wise_data($start, $end);
		}else if($_POST['type'] == 'particular_date_filter'){
			$appointment_date = $_POST['appointment_date'];
			$data = $this->appointment_model->ajax_appointment_particular_date_data($appointment_date);
		}else{
			$response = array('appointment_html'=>"", 'result'=> 0);
			echo json_encode($response);
			die;
		}
		
		if(!empty($data)){
			$appointment_html = "";
			$count = 1;			
			foreach($data as $key => $vl){
				$cancelled_select = $rescheduled_select = $no_show_select = $patient_in = $billing_done = "";
				if($vl['status'] == 'cancelled'){ $cancelled_select = "selected='selected'"; }
				if($vl['status'] == 'rescheduled'){ $rescheduled_select = "selected='selected'"; }
				if($vl['status'] == 'no_show'){ $no_show_select = "selected='selected'"; }
				if($vl['status'] == 'visited'){ $billing_done = "selected='selected'"; }
				if($vl['status'] == 'consultation'){ $patient_in = "selected='selected'"; }
				
				$appointment_html .= '<tr class="odd gradeX"><td>'.$count.'</td>';
				if($vl['paitent_type'] == 'exist_patient'){
					 $appointment_html .= '<td><a target="_blank" href="'.base_url().'patient_details/'.$vl['paitent_id'].'">'.$vl['wife_name'].'</a></td>';
				} else {
					$appointment_html .= '<td>'.$vl['wife_name'].'</td>';
				}
					$appointment_html .= '<td>'.$vl['appoitmented_date'].'</td><td>'.$vl['appoitmented_slot'].'</td><td>'.$vl['reason_of_visit'].'</td>';
				if($vl['status'] == 'consultation'){$appointment_html .= '<td><a class="btn btn-primary" href="'.base_url('consultation_done/'.$vl['ID']).'">Initiate Consultation</a></td>';}else{ $appointment_html .= '<td>'.ucwords($vl['status']).'</td>';}
				//$appointment_html .= '<td> <a target="_blank" class="btn btn-primary" href="'.base_url().'patient_reports/'.$vl['paitent_id'].'">Check Reports</a> </td>';
            	$appointment_html .= '</tr>';
				$count++;
			}
			$response = array('appointment_html'=>$appointment_html, 'result'=> 1);
			echo json_encode($response);
			die;
		}else{
			$response = array('appointment_html'=>"", 'result'=> 0);
			echo json_encode($response);
			die;
		}
	}

	public function procedure_reports($appointment_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['appointment_id'] = $appointment_id;
			$data['procedures'] = $this->appointment_model->patient_procedure($appointment_id);

			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/procedure_reports', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}	
	}

	public function check_procedure_form($form_id, $patient_procedure_id, $appointment_id, $procedure_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$procedure_form_data = $this->doctors_model->check_procedure_form($form_id, $patient_procedure_id, $procedure_id);
// 			if($_SERVER['REMOTE_ADDR'] == "182.68.175.175"){
// 			    var_dump($procedure_form_data);die;
// 			}
			if(count($procedure_form_data) > 0){
				$form_data = get_prodecure_form($form_id);
				$data['form_data'] = $form_data;
				$data['form_id'] = $form_id;
				$data['procedure_id'] = $procedure_id;
				$data['patient_procedure_id'] = $patient_procedure_id;
				$data['appointment_id'] = $appointment_id;
				$data['procedure_form_data'] = $procedure_form_data[0];
				
				$data['updated_by'] = "";
    			$data['updated_type'] = "";
    			$data['updated_at'] = date('Y-m-d H:i:s');
    
    			if(isset($_SESSION['logged_doctor'])){
    				$data['updated_by'] = $_SESSION['logged_doctor']['username'];
    				$data['updated_type'] = "doctor";
    			}else if(isset($_SESSION['logged_embryologist'])){
    				$data['updated_by'] = $_SESSION['logged_embryologist']['username'];
    				$data['updated_type'] = "embryologist";
    			}
			
				
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('doctors/check_form', $data);
				$this->load->view($template['footer']);	
			}else{
				header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Form data not uploaded yet!').'&t='.base64_encode('error'));
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function procedure_upload(){
		$procedure_id = $_POST['procedure_id'];
		$appointment_id = $_POST['appointment_id'];
		$patient_procedure_id = $_POST['patient_procedure_id'];
		$patient_id = $_POST['patient_id'];
        $html = "";
        
		$patient_procedure_datas = $this->get_patient_prodedures_data($appointment_id, $patient_id);
		//var_dump($patient_procedure_datas);die;
		if(!empty($patient_procedure_datas)){
		$procedures_forms = get_prodecure_forms($procedure_id);
		
		if(count($procedures_forms) > 0){
		    
		    foreach($patient_procedure_datas as $ky => $patient_procedure_data)
		    $count=1;
			foreach($procedures_forms as $key => $val){
				$form_details = get_prodecure_form($val['form_id']);
				//var_dump($form_details);die;
				if(isset($_SESSION['logged_doctor'])){
					if($form_details['form_for'] != "lab_procedure"){
						$check_form_data = check_form_data($patient_id, $patient_procedure_data['receipt_number'], $form_details['form_area']);
						if(count($check_form_data) == 0){
							$html .= "<a target='_blank' count='".$count."' href='".base_url('procedure_form/'.$val['form_id'].'/'.$procedure_id.'/'.$appointment_id.'/'.$patient_procedure_id)."'>".$form_details['form_name']."</a> | ";
						}else if($form_details['type'] == "multiple"){
							$html .= "<a target='_blank' count='".$count."' href='".base_url('procedure_form/'.$val['form_id'].'/'.$procedure_id.'/'.$appointment_id.'/'.$patient_procedure_id)."'>".$form_details['form_name']."</a> | ";
						}
					}
				}if(isset($_SESSION['logged_embryologist'])){
					if($form_details['form_for'] == "lab_procedure"){
						$check_form_data = check_form_data($patient_id, $patient_procedure_data['receipt_number'], $form_details['form_area']);
						if(count($check_form_data) == 0){
							$html .= "<a target='_blank' count='".$count."' href='".base_url('procedure_form/'.$val['form_id'].'/'.$procedure_id.'/'.$appointment_id.'/'.$patient_procedure_id)."'>".$form_details['form_name']."</a> | ";
						}else if($form_details['type'] == "multiple"){
							$html .= "<a target='_blank' count='".$count."' href='".base_url('procedure_form/'.$val['form_id'].'/'.$procedure_id.'/'.$appointment_id.'/'.$patient_procedure_id)."'>".$form_details['form_name']."</a> | ";
						}
					}
				}
				$count++;
			}
			
			$html = substr($html, 0, -3);
			if(empty($html)){
				$html = "<p class='error'>NA!</p>   ";
			}
		}else{
			if(empty($html)){
				$html = "<p class='error'>Procedure Form not assigned!</p>   ";
			}
		}
		}else{
		   $html = "<p class='error'>Procedure billing disapproved!</p>   ";
		}
		echo json_encode($html);
		die;
	}

	public function procedure_form($form_id, $procedure_id, $appointment_id, $patient_procedure_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$patient_procedure_data = get_procedure($patient_procedure_id);
			$patient_id = $patient_procedure_data['patient_id'];
			$receipt_number = $patient_procedure_data['receipt_number'];

			if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="prodedure_form"){
				unset($_POST['action']);
				if(count($patient_procedure_data) > 0){
					$_POST['patient_id'] = $patient_id;
					$_POST['receipt_number'] = $receipt_number;
					$form_from = $_POST['form_from'];unset($_POST['form_from']);
					$path = base_url(). "ipd-records/".$patient_id."/".$patient_procedure_id;
					if($form_from == "lab"){
						$path = base_url(). "procedure_reports/".$appointment_id;
					}
					$form_area = $_POST['form_area']; unset($_POST['form_area']);
					$insert_form_data = $this->doctors_model->procedure_form_insert($_POST, $form_area);
					if($insert_form_data > 0){
						header("location:" .$path."?m=".base64_encode('Procedure uploaded successfully!').'&t='.base64_encode('success'));
						die();
					}else{
						header("location:" .$path."?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}
				}else{
					header("location:" .$path."?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			
			$data = array();
			$form_data = get_prodecure_form($form_id);
			
			$form_name = $form_data['form_name'];
			$form_name = str_replace(" ", "-", $form_name);
			$data['form_id'] = $form_id;
			$data['form_name'] = $form_name;
			$data['procedure_id'] = $procedure_id;
			$data['appointment_id'] = $appointment_id;
			$data['patient_procedure_id'] = $patient_procedure_id;
			$data['patient_id'] = $patient_id;
			$data['receipt_number'] = $receipt_number;
			$data['form_name'] = $form_name;
			$data['form_from'] = isset($_GET['t'])?$_GET['t']:"";
			
			$data['updated_by'] = "";
			$data['updated_type'] = "";
			$data['updated_at'] = date('Y-m-d H:i:s');

			if(isset($_SESSION['logged_doctor'])){
				$data['updated_by'] = $_SESSION['logged_doctor']['username'];
				$data['updated_type'] = "doctor";
			}else if(isset($_SESSION['logged_embryologist'])){
				$data['updated_by'] = $_SESSION['logged_embryologist']['username'];
				$data['updated_type'] = "embryologist";
			}
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/procedure_upload', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function my_ipd(){
		$logg = checklogin();
		if($logg['status'] == true){

			$data = array();
			$doctor_id = $_SESSION['logged_doctor']['doctor_id'];
			$data['ipd_data'] = $this->doctors_model->doctor_ipd_lists($doctor_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/my_ipd', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}		
	}

	public function my_reports(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$doctor_id = $_SESSION['logged_doctor']['doctor_id'];
			$data['data'] =  $this->doctors_model->doctor_ipd_lists($doctor_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/my_reports', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}		
	}

	public function lab_reports($patient_id, $appointment_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['patient_id'] = $patient_id;	
			$data['appointment_id'] = $appointment_id;	
			$investigations_reports = $this->patients_model->patient_investigations_reports($patient_id);
			$data['investigations_reports'] = $investigations_reports;

			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('doctors/lab_reports', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}		
	}

	public function procedure_report_status($form_id, $patient_procedure_id, $appointment_id, $data_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$form_data = get_prodecure_form($form_id);
			$patient_procedure_data = get_procedure($patient_procedure_id);
			$form_area = $form_data['form_area'];
			$patient_id = $patient_procedure_data['patient_id'];
			$receipt_number = $patient_procedure_data['receipt_number'];
			$reason = "";
			if($_GET['s'] == "disapproved"){
				$reason = $_POST['status_reason'];
			}
			$update_status = $this->doctors_model->update_procedure_report_status($_GET['s'], $reason, $patient_id, $receipt_number, $form_area, $data_id);
			if($update_status > 0){
				header("location:" .base_url().'my-reports/'.$patient_id.'/'.$appointment_id."?m=".base64_encode('Report '.$_GET['s']).'&t='.base64_encode('success'));
			}else{
				header("location:" .base_url().'my-reports/'.$patient_id.'/'.$appointment_id."?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}	
	}
	// Dashbaord END	

	function doctor_name($doctor_id){
		$doctor_name = $this->doctors_model->get_doctor_data($doctor_id);
		if(!empty($doctor_name)){
		    return $doctor_name['name'];
		}else {return "";}
	}

	public function get_center($center){
		$data = $this->employee_model->get_center_data($center);
		return $data;
	}

	function get_patient_prodedures($appointment_id, $patient_id){
		$data = $this->patients_model->get_patient_prodedures($appointment_id, $patient_id);
		return $data;
	}
	
	function get_patient_prodedures_data($appointment_id, $patient_id){
		$data = $this->patients_model->get_patient_prodedures_data($appointment_id, $patient_id);
		return $data;
	}
	
	function doctor_appointment($appointment_id){
		$data = $this->doctors_model->get_doctor_appointment($appointment_id);
		return $data;
	}

	function get_center_list(){
		$center = $this->center_model->get_centers();
		return $center;
	}
} 