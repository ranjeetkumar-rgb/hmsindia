<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model('vendors_model');
		$this->load->helper('myhelper');
	}	
	
	public function vendors()
	{
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$data['data'] = $this->vendors_model->get_vendors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('vendors/vendors', $data);
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
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_vendor'){
				unset($_POST['action']);
				$gst_number = '';
					if(!empty($_FILES['gst_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['gst_number']['name']);
						$gst_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['gst_number']['tmp_name'], $destination.$NewImageName);
						$_POST['gst_number'] = $gst_number;
					}
					$drug_license_number = '';
					if(!empty($_FILES['drug_license_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['drug_license_number']['name']);
						$drug_license_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['drug_license_number']['tmp_name'], $destination.$NewImageName);
						$_POST['drug_license_number'] = $drug_license_number;
					}
					$fssai_number = '';
					if(!empty($_FILES['fssai_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['fssai_number']['name']);
						$fssai_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['fssai_number']['tmp_name'], $destination.$NewImageName);
						$_POST['fssai_number'] = $fssai_number;
					}
					$pan_number = '';
					if(!empty($_FILES['pan_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['pan_number']['name']);
						$pan_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['pan_number']['tmp_name'], $destination.$NewImageName);
						$_POST['pan_number'] = $pan_number;
					}
					$msme_number = '';
					if(!empty($_FILES['msme_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['msme_number']['name']);
						$msme_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['msme_number']['tmp_name'], $destination.$NewImageName);
						$_POST['msme_number'] = $msme_number;
					}
					$mou = '';
					if(!empty($_FILES['mou']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['mou']['name']);
						$mou = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['mou']['tmp_name'], $destination.$NewImageName);
						$_POST['mou'] = $mou;
					}
				//$_POST['deactive_date'] = date("Y-m-d H:i:s");	
				$_POST['date'] = date("Y-m-d H:i:s");
				$_POST['vendor_number'] = getGUID();	
                //print_r($_POST);die();			
				$data = $this->vendors_model->add_vendor($_POST);
				if($data > 0){
					header("location:" .base_url(). "vendors/add?m=".base64_encode('Vendor added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "vendors/add?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('vendors/add_vendor', $data);
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
				
				if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_vendor'){
					unset($_POST['action']);
					
					$gst_number = '';
					if(!empty($_FILES['gst_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['gst_number']['name']);
						$gst_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['gst_number']['tmp_name'], $destination.$NewImageName);
						$_POST['gst_number'] = $gst_number;
					}
					$drug_license_number = '';
					if(!empty($_FILES['drug_license_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['drug_license_number']['name']);
						$drug_license_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['drug_license_number']['tmp_name'], $destination.$NewImageName);
						$_POST['drug_license_number'] = $drug_license_number;
					}
					$fssai_number = '';
					if(!empty($_FILES['fssai_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['fssai_number']['name']);
						$fssai_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['fssai_number']['tmp_name'], $destination.$NewImageName);
						$_POST['fssai_number'] = $fssai_number;
					}
					$pan_number = '';
					if(!empty($_FILES['pan_number']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['pan_number']['name']);
						$pan_number = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['pan_number']['tmp_name'], $destination.$NewImageName);
						$_POST['pan_number'] = $pan_number;
					}
					$msme_number = '';
					if(!empty($_FILES['msme']['tmp_name'])){
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'stock_files/';
						$NewImageName = rand(4,10000)."-".str_replace(" ","_",$_FILES['msme']['name']);
						$msme = base_url().'assets/stock_files/'.$NewImageName;
						move_uploaded_file($_FILES['msme']['tmp_name'], $destination.$NewImageName);
						$_POST['msme'] = $msme;
					}
					
					$data = $this->vendors_model->update_vendor_data($_POST, $item_id);
					if($data > 0){
						header("location:" .base_url(). "vendors/edit?m=".base64_encode('Vendor updated successfully !').'&t='.base64_encode('success').'&id='.$item_id);
						die();
					}else{
						header("location:" .base_url(). "vendors/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&id='.$item_id);
						die();
					}				
				}
				$data['data'] = $this->vendors_model->get_vendor_data($item_id);
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('vendors/edit_vendor', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "vendors");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function details($item_id)
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$data['data'] = $this->vendors_model->get_vendor_data($item_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('vendors/details', $data);
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
			if(isset($_GET['id'])){	
				$item = $_GET['id'];
				if( $item > 0 )
				{
					if( $this->vendors_model->delete_vendor_data($item) !== 0)
					{
						header("location:" .base_url(). "vendors?m=".base64_encode('Vendor deleted successfully !').'&t='.base64_encode('success'));
						die();
					}
					else
					{
						header("location:" .base_url(). "vendors?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}
				}
				header("location:" .base_url(). "vendors?m=".base64_encode('Vendor not found !').'&t='.base64_encode('error'));
				die();
			}else{
				header("location:" .base_url(). "vendors");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
} 