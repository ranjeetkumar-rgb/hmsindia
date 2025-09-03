<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centers extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model('center_model');
		$this->load->helper('myhelper');
	}	
	
	public function centers()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->center_model->get_centers();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('centers/centers', $data);
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
			if(isset($_POST['action']) && $_POST['action'] == 'add_item'){
			    
			    // Debug: Log the POST data
			    log_message('debug', 'POST data received: ' . print_r($_POST, true));
			    
			    // Validate required fields
			    $required_fields = ['center_name', 'type', 'center_address'];
			    $missing_fields = [];
			    
			    foreach($required_fields as $field) {
			        if(empty($_POST[$field])) {
			            $missing_fields[] = $field;
			        }
			    }
			    
			    if(!empty($missing_fields)) {
			        $error_msg = 'Missing required fields: ' . implode(', ', $missing_fields);
			        header("location:" . base_url() . "centers/add?m=" . base64_encode($error_msg) . '&t=' . base64_encode('error'));
			        die();
			    }
			    
			    // Handle file upload
			    if(!empty($_FILES['upload_photo_1']['tmp_name'])){
			        $dest_path = $this->config->item('upload_path');
			        $destination = $dest_path.'center/';
			        
			        // Create directory if it doesn't exist
			        if (!is_dir($destination)) {
			            mkdir($destination, 0755, true);
			        }
			        
			        $NewImageName = rand(4,10000)."-".$_FILES['upload_photo_1']['name'];
			        $transaction_img = base_url().'assets/center/'.$NewImageName;
			        
			        if(move_uploaded_file($_FILES['upload_photo_1']['tmp_name'], $destination.$NewImageName)) {
			            $_POST['upload_photo_1'] = $transaction_img;
			        } else {
			            log_message('error', 'Failed to upload file: ' . $_FILES['upload_photo_1']['name']);
			            $_POST['upload_photo_1'] = '';
			        }
			    }
			    
			    // Remove action from POST data
			    unset($_POST['action']);
			    
			    // Debug: Log the data being sent to model
			    log_message('debug', 'Data being sent to model: ' . print_r($_POST, true));
			    
			    // Call model to add item
			    $data = $this->center_model->add_item($_POST);
				
				if($data > 0){
					header("location:" . base_url() . "centers/add?m=" . base64_encode('Center added successfully!') . '&t=' . base64_encode('success'));
					die();
				}else{
					log_message('error', 'Failed to add center. Model returned: ' . $data);
					header("location:" . base_url() . "centers/add?m=" . base64_encode('Failed to add center. Please check the logs.') . '&t=' . base64_encode('error'));
					die();
				}				
			}
			
			// Get any messages from URL parameters
			$data = array();
			if(isset($_GET['m']) && isset($_GET['t'])) {
			    $data['message'] = base64_decode($_GET['m']);
			    $data['message_type'] = base64_decode($_GET['t']);
			}
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('centers/add_item', $data);
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
			if(isset($_GET['center_number'])){ $item_id = $_GET['center_number']; }
			if(isset($_POST['center_number'])) { $item_id = $_POST['center_number']; }

			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_item'){
			    
			    // Validate required fields
			    $required_fields = ['center_name', 'type', 'center_address', 'center_classification'];
			    $missing_fields = [];
			    
			    foreach($required_fields as $field) {
			        if(empty($_POST[$field])) {
			            $missing_fields[] = $field;
			        }
			    }
			    
			    if(!empty($missing_fields)) {
			        $error_msg = 'Missing required fields: ' . implode(', ', $missing_fields);
			        header("location:" . base_url() . "centers/edit?m=" . base64_encode($error_msg) . '&t=' . base64_encode('error') . '&center_number=' . $item_id);
			        die();
			    }
			    
			    // Validate center classification
			    if (!in_array($_POST['center_classification'], ['hub', 'spoke'])) {
			        $error_msg = 'Invalid center classification. Must be either "hub" or "spoke".';
			        header("location:" . base_url() . "centers/edit?m=" . base64_encode($error_msg) . '&t=' . base64_encode('error') . '&center_number=' . $item_id);
			        die();
			    }
			    
			    // Handle file upload
			    if(!empty($_FILES['upload_photo_1']['tmp_name'])){
			        $dest_path = $this->config->item('upload_path');
			        $destination = $dest_path.'center/';
			        $NewImageName = rand(4,10000)."-".$_FILES['upload_photo_1']['name'];
			        $transaction_img = base_url().'assets/center/'.$NewImageName;
			        move_uploaded_file($_FILES['upload_photo_1']['tmp_name'], $destination.$NewImageName);
			        $_POST['upload_photo_1'] = $transaction_img;
			    }
			    unset($_POST['action']);
			    $data = $this->center_model->update_item_data($_POST, $item_id);
			    if($data > 0){
			        header("location:" .base_url(). "centers/centers?m=".base64_encode('Center updated successfully !').'&t='.base64_encode('success'));
			        die();
			    }else{
			        header("location:" .base_url(). "centers/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&center_number='.$item_id);
			        die();
			    }				
			}
			$data['data'] = $this->center_model->get_item_data($item_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('centers/edit_item', $data);
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
			$item = $_GET['center_number'];
			if( $item > 0 )
			{
				if( $this->center_model->delete_item_data($item) !== 0)
				{
					header("location:" .base_url(). "centers?m=".base64_encode('Item deleted successfully !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "centers?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			header("location:" .base_url(). "centers?m=".base64_encode('Item not found !').'&t='.base64_encode('error'));
			die();
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	public function hub_spoke()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			
			// Load the hub-spoke model
			$this->load->model('hub_spoke_model');
			$data['relationships'] = $this->hub_spoke_model->get_all_relationships();
			$template = get_header_templafte($logg['role']);
			$this->load->view($template['header']);

			$this->load->view('hub_spoke/index', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	/**
	 * Add new hub-spoke relationship
	 */
	public function add_hub_spoke()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_POST['action']) && $_POST['action'] == 'add_relationship') {
				// Load the hub-spoke model
				$this->load->model('hub_spoke_model');
				
				$post_data = array(
					'hub_center_id' => $_POST['hub_center_id'],
					'spoke_center_id' => $_POST['spoke_center_id'],
					'relationship_name' => $_POST['relationship_name']
				);
				$result = $this->hub_spoke_model->add_relationship($post_data);
				if ($result['status'] == 'success') {
					header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode($result['message']).'&t='.base64_encode('success'));
					die();
				} else {
					header("location:" .base_url(). "centers/add_hub_spoke?m=".base64_encode($result['message']).'&t='.base64_encode('error'));
					die();
				}
			}

			// Load the hub-spoke model
			$this->load->model('hub_spoke_model');
			$data['available_hubs'] = $this->hub_spoke_model->get_available_hub_centers();
			$data['available_spokes'] = $this->hub_spoke_model->get_available_spoke_centers();
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('hub_spoke/add', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	/**
	 * Edit existing hub-spoke relationship
	 */
	public function edit_hub_spoke()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$relationship_id = $this->uri->segment(3);
			if(isset($_POST['action']) && $_POST['action'] == 'update_relationship') {
				$this->load->model('hub_spoke_model');
				$post_data = array(
					'hub_center_id' => $_POST['hub_center_id'],
					'spoke_center_id' => $_POST['spoke_center_id'],
					'relationship_name' => $_POST['relationship_name']
				);
				$result = $this->hub_spoke_model->update_relationship($relationship_id, $post_data);
				
				if ($result['status'] == 'success') {
					header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode($result['message']).'&t='.base64_encode('success'));
					die();
				} else {
					header("location:" .base_url(). "centers/edit_hub_spoke?m=".base64_encode($result['message']).'&t='.base64_encode('error').'&id='.$relationship_id);
					die();
				}
			}

			// Load the hub-spoke model
			$this->load->model('hub_spoke_model');
			$data['relationship'] = $this->hub_spoke_model->get_relationship_by_id($relationship_id);
			$data['available_hubs'] = $this->hub_spoke_model->get_available_hub_centers();
			$data['available_spokes'] = $this->hub_spoke_model->get_available_spoke_centers();
			
			if (!$data['relationship']) {
				header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode('Relationship not found').'&t='.base64_encode('error'));
				die();
			}
			
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
				$this->load->view('hub_spoke/edit', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	/**
	 * Delete hub-spoke relationship
	 */
	public function delete_hub_spoke()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$relationship_id = $this->uri->segment(3);
			
			if($relationship_id > 0) {
				// Load the hub-spoke model
				$this->load->model('hub_spoke_model');
				$result = $this->hub_spoke_model->delete_relationship($relationship_id);
				if ($result['status'] == 'success') {
					header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode($result['message']).'&t='.base64_encode('success'));
					die();
				} else {
					header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode($result['message']).'&t='.base64_encode('error'));
					die();
				}
			} else {
				header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode('Invalid relationship ID').'&t='.base64_encode('error'));
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	/**
	 * View hub-spoke relationship details
	 */
	public function view_hub_spoke()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$relationship_id =  $this->uri->segment(3);
			if($relationship_id > 0) {
				// Load the hub-spoke model
				$this->load->model('hub_spoke_model');
				$data['relationship'] = $this->hub_spoke_model->get_relationship_by_id($relationship_id);
				
				if (!$data['relationship']) {
					header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode('Relationship not found').'&t='.base64_encode('error'));
					die();
				}
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('hub_spoke/view', $data);
				$this->load->view($template['footer']);
			} else {
				header("location:" .base_url(). "centers/hub_spoke?m=".base64_encode('Invalid relationship ID').'&t='.base64_encode('error'));
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}


} 