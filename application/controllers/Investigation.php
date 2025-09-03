<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Investigation extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model(array('billingmodel_model', 'investigation_model' , 'billings_model', 'patients_model','center_model'));
		$this->load->helper('myhelper');
		$this->load->library("pagination");
	}	
	
	public function investigation()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['upload_investigation']) && isset($_POST['upload_investigation']) && $_POST['upload_investigation'] == 'upload_investigation'){
			 
				// get details of the uploaded file
				$fileTmpPath = $_FILES['investigation_list']['tmp_name'];
				$fileName = $_FILES['investigation_list']['name'];
				$fileSize = $_FILES['investigation_list']['size'];
				$fileType = $_FILES['investigation_list']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$allowedfileExtensions = array('csv');
				if (in_array($fileExtension, $allowedfileExtensions)) {
					$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
					$destination = $this->config->item('upload_path');
					//var_dump($destination);die;
						
						if ($_FILES["investigation_list"]["size"] > 0) {
        
							$file = fopen($fileTmpPath, "r");
							$count = 0;
							while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
								if($count > 0){
									/*var_dump($column);
									echo '<br/><br/><br/><br/>';die;*/
									$sqlinsert = "INSERT INTO `".$this->config->item('db_prefix')."investigation`(`investigation`, `code`, price, `usd_price`,`status`) VALUES('".$column[0]."','".$column[1]. "','".$column[2]."','".$column[3]."','1')";									
									//echo $sqlinsert;die;
									$res =  $this->db->query($sqlinsert);
								}
							 $count++;
							}
							if ($res)
							{
								header("location:" .base_url(). "investigation/investigation?m=".base64_encode('Investigation uploaded successfully !').'&t='.base64_encode('success'));
								die();
							}
							else{
								header("location:" .base_url(). "investigation/investigation?m=".base64_encode('something went wrong !').'&t='.base64_encode('success'));
								die();
							}
						}
				}else{
					header("location:" .base_url(). "investigation/investigation?m=".base64_encode('File format not supported !').'&t='.base64_encode('success'));
					die();
				}
			}	
			$data = array();
			$data['data'] = $this->investigation_model->get_investigation();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/investigation', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	/******** Master ********/
	
	public function add_master()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_master_investigation'){
				unset($_POST['action']);
				$_POST['on_date'] = date("Y-m-d H:i:s");
				$data = $this->investigation_model->add_master_investigation($_POST);
				if($data > 0){
					header("location:" .base_url(). "investigation/add_master?m=".base64_encode('Master Investigation added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "investigation/add_master?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/add_master_investigation', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function edit_master()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			
			if(isset($_GET['id'])){
				if(isset($_GET['id'])){ $item_id = $_GET['id']; }
				if(isset($_POST['id'])) { $item_id = $_POST['id']; }
				
				if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_master_investigation'){
					unset($_POST['action']);
					$data = $this->investigation_model->update_master_investigation_data($_POST, $item_id);
					if($data > 0){
						header("location:" .base_url(). "investigation/edit_master?m=".base64_encode('Investigation updated successfully !').'&t='.base64_encode('success').'&id='.$item_id);
						die();
					}else{
						header("location:" .base_url(). "investigation/edit_master?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&id='.$item_id);
						die();
					}				
				}
				$data['data'] = $this->investigation_model->get_master_investigation_data($item_id);
				$data['investigation'] = $this->investigation_model->get_master_investigation();
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('investigation/edit_master_investigation', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "master_investigation");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function master_investigation()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['upload_master_investigation']) && isset($_POST['upload_master_investigation']) && $_POST['upload_master_investigation'] == 'upload_master_investigation'){
			 
				// get details of the uploaded file
				$fileTmpPath = $_FILES['master_investigation_list']['tmp_name'];
				$fileName = $_FILES['master_investigation_list']['name'];
				$fileSize = $_FILES['master_investigation_list']['size'];
				$fileType = $_FILES['master_investigation_list']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$allowedfileExtensions = array('csv');
				if (in_array($fileExtension, $allowedfileExtensions)) {
					$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
					$destination = $this->config->item('upload_path');
					//var_dump($destination);die;
						
						if ($_FILES["master_investigation_list"]["size"] > 0) {
        
							$file = fopen($fileTmpPath, "r");
							$count = 0;
							while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
								if($count > 0){
									/*var_dump($column);
									echo '<br/><br/><br/><br/>';die;*/
									$sqlinsert = "INSERT INTO `".$this->config->item('db_prefix')."master_investigations`(`investigation`, `code`, status, `employee_number`,`on_date`) VALUES('".$column[0]."','".$column[1]. "','1','".$column[2]."','".$column[3]."')";									
									//echo $sqlinsert;die;
									$res =  $this->db->query($sqlinsert);
								}
							 $count++;
							}
							if ($res)
							{
								header("location:" .base_url(). "investigation/master_investigation?m=".base64_encode('Investigation uploaded successfully !').'&t='.base64_encode('success'));
								die();
							}
							else{
								header("location:" .base_url(). "investigation/master_investigation?m=".base64_encode('something went wrong !').'&t='.base64_encode('success'));
								die();
							}
						}
				}else{
					header("location:" .base_url(). "investigation/master_investigation?m=".base64_encode('File format not supported !').'&t='.base64_encode('success'));
					die();
				}
			}	
			$data = array();
			$data['data'] = $this->investigation_model->get_master_investigation();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/master_investigation', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	/***** End Master ******/

	public function add()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_investigation'){
				unset($_POST['action']);
				$data = $this->investigation_model->add_investigation($_POST);
				if($data > 0){
					header("location:" .base_url(). "investigation/add?m=".base64_encode('Investigation added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "investigation/add?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$data['investigation'] = $this->investigation_model->get_investigation();
			$data['centers'] = $this->center_model->get_centers();
			$data['master_investigation'] = $this->investigation_model->get_master_investigation();
			$data['investigation_vendor'] = $this->investigation_model->get_investigation_vendor();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/add_investigation', $data);
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
				
				if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_investigation'){
					unset($_POST['action']);
					$data = $this->investigation_model->update_investigation_data($_POST, $item_id);
					if($data > 0){
						header("location:" .base_url(). "investigation/edit?m=".base64_encode('Investigation updated successfully !').'&t='.base64_encode('success').'&id='.$item_id);
						die();
					}else{
						header("location:" .base_url(). "investigation/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&id='.$item_id);
						die();
					}				
				}
				$data['data'] = $this->investigation_model->get_investigation_data($item_id);
				$data['investigation'] = $this->investigation_model->get_investigation();
				$data['centers'] = $this->center_model->get_centers();
				$data['master_investigation'] = $this->investigation_model->get_master_investigation();
				$data['investigation_vendor'] = $this->investigation_model->get_investigation_vendor();
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('investigation/edit_investigation', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "investigation");
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
					if( $this->investigation_model->delete_investigation_data($item) !== 0)
					{
						header("location:" .base_url(). "investigation/investigation?m=".base64_encode('Item deleted successfully !').'&t='.base64_encode('success'));
						die();
					}
					else
					{
						header("location:" .base_url(). "investigation/investigation?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}
				}
				header("location:" .base_url(). "investigation/investigation?m=".base64_encode('Item not found !').'&t='.base64_encode('error'));
				die();
			}else{
				header("location:" .base_url(). "investigation/investigation");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	//Investigation Dashboard
	public function my_investigation(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$investigations = $this->investigation_model->investigation_lists();
			$data['investigations'] = $investigations;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/my_investigation', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	
	//Add Investigation List
	public function patient_investigation_details(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			//$investigations = $this->investigation_model->investigation_lists();
			$data['investigations'] = $investigations;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/patient_investigation_details', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	//Investigation List
	/*public function patient_investigation_list(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$investigations = $this->investigation_model->investigation_lists();
			//$data['investigations'] = $investigations;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/patient_investigation_list', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}*/

    public function patient_investigation_list(){
		$logg = checklogin();
		error_reporting(0);
		if($logg['status'] == true){
			$per_page = $this->input->get('per_page', true);
			if(empty($per_page)){
				$per_page = 0;
			}
			$patient_id = $this->input->get('patient_id', true);
			$patientName = $this->input->get('patientName', true);

			$config = array();
        	$config["base_url"] = base_url() . "investigation/patient_investigation_list";
        	$config["total_rows"] = $this->investigation_model->investigation_count($patient_id, $patientName);
        	$config["per_page"] = 10;
        	$config["uri_segment"] = 2;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['page_query_string'] = true;
			$config['reuse_query_string'] = true;
        	$this->pagination->initialize($config);
        	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;	

        	$data["links"] = $this->pagination->create_links();
			$data['investigation_result'] = $this->investigation_model->investigation_patination($config["per_page"], $per_page, $patient_id, $patientName);
			$data["patient_id"] = $patient_id;
			$data["patientName"] = $patientName;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('investigation/patient_investigation_list', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}	

	public function patient_investigation($patient_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="add_investigation_result"){
				unset($_POST['action']);
				$patient_id = $_POST['patient_id']; unset($_POST['patient_id']);
				$receipt_number = $_POST['receipt_number']; unset($_POST['receipt_number']);
				$report_arr = $post_arr = array();
				foreach($_FILES["investigation_result"]["tmp_name"] as $key=>$tmp_name) {				
					$file_name = array_values($_FILES["investigation_result"]["name"][$key]);
					if(!empty($file_name[0])){
						$file_id = array_keys($tmp_name);
						$explode = explode("_", $file_id[0]);
						
						$file_tmp = array_values($_FILES["investigation_result"]["tmp_name"][$key]);						
						$dest_path = $this->config->item('upload_path');
						$destination = $dest_path.'investigation_reports/';
						$NewImageName = rand(4,10000)."-".$patient_id."-".$file_name[0];
						$transaction_img = base_url().'assets/investigation_reports/'.$NewImageName;
						move_uploaded_file($file_tmp[0], $destination.$NewImageName);
						$report_arr[] = array('gender'=> $explode[0], 'investigation' => $explode[1], 'report' => $transaction_img);
					}
				}

				foreach($report_arr as $key => $val){
					$post_arr[] = array('patient_id'=>$patient_id, 'receipt_number'=>$receipt_number, 'gender'=> $val['gender'], 'investigation_id' => $val['investigation'], 'report' => $val['report'], 'status'=>'uploaded', 'uploaded_date'=> date("Y-m-d H:i:s"));
				}
				
				$report_insert = $this->investigation_model->report_insert($post_arr);
				if( $report_insert > 0)
				{
					header("location:" .base_url(). "my_investigation?m=".base64_encode('Report uploaded !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "my_investigation?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
					die();
				}
			}
			
			$receipt_number = $_GET['r'];
			$investigation_details = $this->investigation_model->patient_investigation($patient_id, $receipt_number);
			if(!empty($investigation_details)){
				$medicines = $this->patients_model->patient_medicines_reports($patient_id);
				$data['medicines'] = $medicines;

				$data['receipt_number'] = $receipt_number;
				$data['investigation_details'] = $investigation_details;
				$template = get_header_template($logg['role']);
				$this->load->view($template['header']);
				$this->load->view('investigation/patient_investigation', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "my_investigation");
				die();
			}
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	function get_investigation_details($investigation){
		$details = $this->billingmodel_model->get_investigation_details($investigation);
		return $details;
	}

	function check_investigation_report($investigation, $patient_id, $receipt_number, $gender){
		$details = $this->investigation_model->check_investigation_report($investigation, $patient_id, $receipt_number, $gender);
		return $details;
	}

	function get_medicine_name($medicine){
		$name = $this->billings_model->get_medicine_name($medicine);
		return $name;
	}

	function get_brand_name($brand){
		$name = $this->billings_model->get_brand_name($brand);
		return $name;
	}
	
	function get_center_list(){
		$center = $this->center_model->get_centers();
		return $center;
	}
	
	function get_master_investigation_list(){
		$master_investigation = $this->investigation_model->get_master_investigation();
		return $master_investigation;
	}
	
	function get_investigation_vendor_list(){
		$investigation_vendor = $this->investigation_model->get_investigation_vendor();
		return $investigation_vendor;
	}
	
} 