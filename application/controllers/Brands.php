<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model('brands_model');
		$this->load->helper('myhelper');
	}	
	
	public function brands()
	{
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$data['data'] = $this->brands_model->get_brands();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('brands/brands', $data);
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
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_brand'){
				unset($_POST['action']);
				$_POST['date'] = date("Y-m-d H:i:s");
				$_POST['brand_number'] = getGUID();				
				$data = $this->brands_model->add_brand($_POST);
				if($data > 0){
					header("location:" .base_url(). "brands/add?m=".base64_encode('Brand added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "brands/add?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('brands/add_brand', $data);
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
				
				if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_brand'){
					unset($_POST['action']);
					$data = $this->brands_model->update_brand_data($_POST, $item_id);
					if($data > 0){
						header("location:" .base_url(). "brands/edit?m=".base64_encode('Brand updated successfully !').'&t='.base64_encode('success').'&id='.$item_id);
						die();
					}else{
						header("location:" .base_url(). "brands/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&id='.$item_id);
						die();
					}				
				}
				$data['data'] = $this->brands_model->get_brand_data($item_id);
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('brands/edit_brand', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "brands");
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
					if( $this->brands_model->delete_brand_data($item) !== 0)
					{
						header("location:" .base_url(). "brands?m=".base64_encode('Brand deleted successfully !').'&t='.base64_encode('success'));
						die();
					}
					else
					{
						header("location:" .base_url(). "brands?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}
				}
				header("location:" .base_url(). "brands?m=".base64_encode('Brand not found !').'&t='.base64_encode('error'));
				die();
			}else{
				header("location:" .base_url(). "brands");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
} 