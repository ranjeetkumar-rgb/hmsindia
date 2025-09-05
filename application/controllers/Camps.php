<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camps extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model('camp_model');
		$this->load->helper('myhelper');
	}	
	
	public function index()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->camp_model->get_camps();
			
			// Debug: Log the data being passed to the view
			log_message('debug', 'Camps controller - Data count: ' . count($data['data']));
			if(!empty($data['data'])) {
				log_message('debug', 'First camp data: ' . print_r($data['data'][0], true));
			}
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('camps/camps', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function add()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && $_POST['action'] == 'add_camp'){
			    
			    // Debug: Log the POST data
			    log_message('debug', 'POST data received: ' . print_r($_POST, true));
			    
			    // Validate required fields
			    $required_fields = ['camp_name', 'center_id'];
			    $missing_fields = [];
			    
			    foreach($required_fields as $field) {
			        if(empty($_POST[$field])) {
			            $missing_fields[] = $field;
			        }
			    }
			    
			    if(!empty($missing_fields)) {
			        $error_msg = 'Missing required fields: ' . implode(', ', $missing_fields);
			        header("location:" . base_url() . "camps/add?m=" . base64_encode($error_msg) . '&t=' . base64_encode('error'));
			        die();
			    }
			    
			    // Remove action from POST data
			    unset($_POST['action']);
			    
			    // Debug: Log the data being sent to model
			    log_message('debug', 'Data being sent to model: ' . print_r($_POST, true));
			    
			    // Call model to add camp
			    $data = $this->camp_model->add_camp($_POST);
				
				if($data > 0){
					header("location:" . base_url() . "camps/add?m=" . base64_encode('Camp added successfully!') . '&t=' . base64_encode('success'));
					die();
				}else{
					log_message('error', 'Failed to add camp. Model returned: ' . $data);
					header("location:" . base_url() . "camps/add?m=" . base64_encode('Failed to add camp. Please check the logs.') . '&t=' . base64_encode('error'));
					die();
				}				
			}
			
			// Get any messages from URL parameters
			$data = array();
			if(isset($_GET['m']) && isset($_GET['t'])) {
			    $data['message'] = base64_decode($_GET['m']);
			    $data['message_type'] = base64_decode($_GET['t']);
			}
			
			// Get centers for dropdown
			$data['centers'] = $this->camp_model->get_centers_for_dropdown();
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('camps/add_camp', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" . base_url() . "");
			die();
		}
	}
	
	public function edit()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_GET['camp_number'])){ $camp_number = $_GET['camp_number']; }
			if(isset($_POST['camp_number'])) { $camp_number = $_POST['camp_number']; }

			if(isset($_POST['action']) && $_POST['action'] == 'update_camp'){
				unset($_POST['action']);
				$data = $this->camp_model->update_camp_data($_POST, $camp_number);
				if($data > 0){
					header("location:" .base_url(). "camps?m=".base64_encode('Camp updated successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "camps/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&camp_number='.$camp_number);
					die();
				}				
			}
			$data['data'] = $this->camp_model->get_camp_data($camp_number);
			$data['centers'] = $this->camp_model->get_centers_for_dropdown();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('camps/edit_camp', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function delete()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$camp_number = $_GET['camp_number'];
			if( $camp_number != '' )
			{
				if( $this->camp_model->delete_camp_data($camp_number) !== 0)
				{
					header("location:" .base_url(). "camps?m=".base64_encode('Camp deleted successfully !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "camps?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			header("location:" .base_url(). "camps?m=".base64_encode('Camp not found !').'&t='.base64_encode('error'));
			die();
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function toggle_status()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$camp_number = $_GET['camp_number'];
			$status = $_GET['status'];
			
			if( $camp_number != '' && ($status == '0' || $status == '1') )
			{
				$data = array('status' => $status);
				if( $this->camp_model->update_camp_data($data, $camp_number) > 0)
				{
					$status_text = ($status == '1') ? 'activated' : 'deactivated';
					header("location:" .base_url(). "camps?m=".base64_encode('Camp '.$status_text.' successfully !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "camps?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			header("location:" .base_url(). "camps?m=".base64_encode('Invalid parameters !').'&t='.base64_encode('error'));
			die();
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

}
