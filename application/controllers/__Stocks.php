<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends CI_Controller {

	public function __construct()
	{
		// Load parent's constructor.
       	parent::__construct();
		$this->load->database();
		$this->load->helper('form');
        $this->load->helper('url_helper');
	    $this->load->library('session');
		$this->load->model('order_model');
		$this->load->model('stock_model');
		$this->load->model('vendors_model');
		$this->load->helper('myhelper');
	}

	/**ADD PRODUCTS**/

	public function stock_products()
	{
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$data['data'] = $this->stock_model->get_stock_products();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products/stock_products', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function stock_product_add()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_product'){
				unset($_POST['action']);
				$type = $_POST['type'];
				$solid = array('Capsule', 'Tablet');
				$liquid = array('Injection', 'Cyrup');

				if(in_array($type, $solid)){
					$_POST['product_type'] = "solid";
				}else if(in_array($type, $liquid)){
					$_POST['product_type'] = "liquid";
				}
				$data = $this->stock_model->stock_product_add($_POST);
				if($data > 0){
					header("location:" .base_url(). "products?m=".base64_encode('Product added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "add-product?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products/stock_product_add', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function stock_product_edit()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_GET['id'])){ $item_id = $_GET['id']; }
			if(isset($_POST['id'])) { $item_id = $_POST['id']; }
			
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_products'){
				unset($_POST['action']);
				$type = $_POST['type'];
				$solid = array('Capsule', 'Tablet');
				$liquid = array('Injection', 'Cyrup');

				if(in_array($type, $solid)){
					$_POST['product_type'] = "solid";
				}else if(in_array($type, $liquid)){
					$_POST['product_type'] = "liquid";
				}

				$data = $this->stock_model->update_stock_product_data($_POST, $item_id);
				if($data > 0){
					header("location:" .base_url(). "edit-product?m=".base64_encode('Product updated successfully !').'&t='.base64_encode('success').'&id='.$item_id);
					die();
				}else{
					header("location:" .base_url(). "edit-product?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&id='.$item_id);
					die();
				}				
			}
			$data['data'] = $this->stock_model->get_stock_product_data($item_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products/stock_product_edit', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	function stock_product_brands($product){
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'assign_brands'){
				unset($_POST['action']);

				$data = $this->stock_model->stock_product_brands($_POST, $product);
				if($data > 0){
					header("location:" .base_url(). "product-brands/$product?m=".base64_encode('Product assigned successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "product-brands/$product?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$data['product'] = $this->stock_model->get_stock_product_data($product);
			$data['brands'] = $this->stock_model->get_brands_list();
			$data['prodcut_brands'] = $this->stock_model->get_product_brands($product);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products/stock_product_brands', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	function stock_product_vendors(){
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$data['data'] = $this->stock_model->get_stock_product_vendors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products/stock_product_vendors', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function product_vendor_add(){
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'product_vendor_add'){
				unset($_POST['action']);
				//var_dump($_POST);die;
				$data = $this->stock_model->product_vendor_add($_POST);
				if($data > 0){
					header("location:" .base_url(). "product-vendors?m=".base64_encode('Vendor assigned successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "product-vendors?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$data['products'] = $this->stock_model->get_stock_products();
			$data['vendors'] = $this->vendors_model->get_vendors_list();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products/product_vendor_add', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	function product_vendor_edit($id){
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'product_vendor_update'){
				unset($_POST['action']);
				//var_dump($_POST);die;
				$data = $this->stock_model->product_vendor_update($_POST, $id);
				if($data > 0){
					header("location:" .base_url(). "product-vendors?m=".base64_encode('Product Vendor updated successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "product-vendors?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$data['data'] = $this->stock_model->get_product_vendor_data($id);
			$data['products'] = $this->stock_model->get_stock_products();
			$data['vendors'] = $this->vendors_model->get_vendors_list();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products/product_vendor_edit', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	function ajax_product_brands(){
		$response = array(); $brand_html = '';
		$brand_html = '<option value="">-- Select --</option>';

		$product_id = $_POST['product_id'];
		$brands = $this->stock_model->get_product_brands($product_id);
		if(!empty($brands)){
			$selected_brands = "";
			if(isset($_POST['mode']) && !empty($_POST['mode']) && $_POST['mode'] == "edit"){
				$selected_brands = $_POST['brand_number'];
			}

			$product_info = $this->stock_model->get_stock_product_data($product_id);
			foreach($brands as $key => $val){
				$brand_name = $selected = "";
				$brand_name = $this->stock_model->get_brand_name($val['brand_number']);
				if($val['brand_number'] == $selected_brands){
					$selected = "selected='selected'";
				}
				$brand_html .= '<option value="'.$val['brand_number'].'" '.$selected.'>'.$brand_name.'</option>';
			}

			$response = array('brands' => $brand_html, 'product_info' => 'Type: '.$product_info['type'].', Consumption Unit: '.$product_info['consumption_unit'].'');		
		}else{
			$response = array('brands' => $brand_html, 'product_info' => 'Product Brands not assigned!');		
		}
		echo json_encode($response);
		die;
	}

	function ajax_product_brand_vendor(){
		$product_id = $_POST['product_id'];
		$brand_number = $_POST['brand_number'];
		$response = array(); $vendor_html = '';
		$vendor_html = '<option value="">-- Select --</option>';

		$vendors = $this->stock_model->get_product_brand_vendor($product_id, $brand_number);
		if(!empty($vendors)){
			foreach($vendors as $key => $val){
				$vendor_name = "";
				$vendor_name = $this->stock_model->get_vendor_name($val['vendor_number']);
				$vendor_html .= '<option value="'.$val['vendor_number'].'">'.$vendor_name.'</option>';
			}
			$response = array('vendors' => $vendor_html);
		}else{
			$response = array('vendors' => $vendor_html);
		}
		echo json_encode($response);
		die;
	}

	function ajax_product_vendor_data(){
		$product_id = $_POST['product_id'];
		$brand_number = $_POST['brand_number'];
		$vendor_number = $_POST['vendor_number'];

		$product_vendor_data = $this->stock_model->get_product_vendor_info($product_id, $brand_number, $vendor_number);
		if(!empty($product_vendor_data)){
			echo json_encode(array('product_vendor_data' => $product_vendor_data, 'status' => 1));
			die;
		}else{
			echo json_encode(array('product_vendor_data' => array(), 'status' => 0));
			die;
		}
	}

	/**ADD PRODUCTS**/
	
	/****** ADMIN STOCKS *****/
	public function stocks()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			
			if(isset($_POST['upload_stocks']) && isset($_POST['upload_stocks']) && $_POST['upload_stocks'] == 'upload_stocks'){
			 
				// get details of the uploaded file
				$fileTmpPath = $_FILES['stock_lists']['tmp_name'];
				$fileName = $_FILES['stock_lists']['name'];
				$fileSize = $_FILES['stock_lists']['size'];
				$fileType = $_FILES['stock_lists']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$allowedfileExtensions = array('csv');
				if (in_array($fileExtension, $allowedfileExtensions)) {
					$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
					
					$destination = $this->config->item('upload_path');
					//var_dump($destination);die;
						
						if ($_FILES["stock_lists"]["size"] > 0) {
        
							$file = fopen($fileTmpPath, "r");
							$count = 0;
							while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
								if($count > 0){
									//var_dump($column);echo '<br/><br/><br/><br/>';
									$quantity = 0;
									$item_num = getGUID();
									$item_name = $column[1].'-'.$column[2];
									$date = date("Y-m-d H:i:s");
									$ex_date = strtotime($column[8]); 
									$expiry = date('Y-m-d', $ex_date);
									
									$n_expiry = date("Y-m-d", strtotime("-1 month", $ex_date));
									$price= $vendor_price = 0;
									if(isset($column[5]) && !empty($column[5])){
										$price=$column[5];
									}
									if(isset($column[7]) && !empty($column[7])){
										$vendor_price=$column[7];
									}
									$quantity = $column[11];
									
									
									$sqlinsert = "INSERT INTO `".$this->config->item('db_prefix')."stocks`(`item_number`, `company`, `item_name`, category, `safety_stock`, `price`, vendor_number, vendor_price, `expiry`, `expiry_day`, `add_date`, `status`, brand_name,batch_number,order_qty,quantity) VALUES('".$item_num."','".$column[0]. "','".$item_name. "','".$column[3]. "','".$column[4]."','".$price."','".$column[6]."','".$vendor_price."','".$expiry. "','".$n_expiry. "','".$date. "','1','".$column[9]."','".$column[10]."','".$column[12]."','".$quantity."')";
									$res =  $this->db->query($sqlinsert);
								}
							 $count++;
							 sleep(1);
							}
							if ($res)
							{
								header("location:" .base_url(). "stocks/stocks?m=".base64_encode('Stock uploaded successfully !').'&t='.base64_encode('success'));
								die();
							}
							else{
								header("location:" .base_url(). "stocks/stocks?m=".base64_encode('something went wrong !').'&t='.base64_encode('success'));
								die();
							}
						}
				}else{
					header("location:" .base_url(). "stocks/stocks?m=".base64_encode('File format not supported !').'&t='.base64_encode('success'));
					die();
				}
			}
		
			$data = array();
			$data['data'] = $this->stock_model->get_items();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/stocks', $data);
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
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_item'){
				unset($_POST['action']);
				//var_dump($_POST);die;
				$product_id = $_POST['product_id'];
				$brand_name = $_POST['brand_name'];
				$vendor_number = $_POST['vendor_number'];
				$batch_number = $_POST['batch_number'];
				$expiry = $_POST['expiry'];

				$check_center_item = $this->stock_model->check_centeral_item($product_id, $brand_name, $vendor_number, $batch_number, $expiry);
				if($check_center_item > 0){
					$data = $this->stock_model->update_item($_POST, $product_id, $brand_name, $vendor_number, $batch_number, $expiry);
				}else{
					$_POST['item_name'] = $this->get_product_name($product_id);
					$data = $this->stock_model->add_item($_POST);
				}
				
				if($data > 0){
					header("location:" .base_url(). "stocks/add?m=".base64_encode('Item added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "stocks/add?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$data = array();
			$data['categories'] = $this->stock_model->get_categories();
			$data['brands'] = $this->stock_model->get_brands();
			$data['vendors'] = $this->vendors_model->get_vendors();

			$data['products'] = $this->stock_model->get_stock_products();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/add_item', $data);
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
			if(isset($_GET['item_number'])){ $item_id = $_GET['item_number']; }
			if(isset($_POST['item_number'])) { $item_id = $_POST['item_number']; }
			
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_item'){
				unset($_POST['action']);
				$data = $this->stock_model->update_item_data($_POST, $item_id);
				if($data > 0){
					header("location:" .base_url(). "stocks/edit?m=".base64_encode('Item updated successfully !').'&t='.base64_encode('success').'&item_number='.$item_id);
					die();
				}else{
					header("location:" .base_url(). "stocks/edit?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&item_number='.$item_id);
					die();
				}				
			}
			$data['data'] = $this->stock_model->get_item_data($item_id);
			$data['categories'] = $this->stock_model->get_categories();
			$data['brands'] = $this->stock_model->get_brands();
			$data['vendors'] = $this->vendors_model->get_vendors();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/edit_item', $data);
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
			$item = $_GET['item_number'];
			if( $item > 0 )
			{
				if( $this->stock_model->delete_item_data($item) !== 0)
				{
					header("location:" .base_url(). "stocks?m=".base64_encode('Item deleted successfully !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "stocks?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			header("location:" .base_url(). "stocks?m=".base64_encode('Item not found !').'&t='.base64_encode('error'));
			die();
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function details($item){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = $this->stock_model->item_details($item, 'admin');
//			var_dump($data);die;
			$post_arr = array();
			$post_arr['data'] = $data;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/details', $post_arr);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
		
	/****** ADMIN STOCKS *****/
	
	
	/****** CENTER STOCKS *****/
	public function center_stocks()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['upload_stocks']) && isset($_POST['upload_stocks']) && $_POST['upload_stocks'] == 'upload_center_stocks'){
			 
				// get details of the uploaded file
				$fileTmpPath = $_FILES['stock_lists']['tmp_name'];
				$fileName = $_FILES['stock_lists']['name'];
				$fileSize = $_FILES['stock_lists']['size'];
				$fileType = $_FILES['stock_lists']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$allowedfileExtensions = array('csv');
				if (in_array($fileExtension, $allowedfileExtensions)) {
					$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
					
					$destination = $this->config->item('upload_path');
					//var_dump($destination);die;
						
						if ($_FILES["stock_lists"]["size"] > 0) {
        
							$file = fopen($fileTmpPath, "r");
							$count = 0;
							while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
								if($count > 0){
									$item_data = $this->stock_model->get_item_details($column[0]);
									if(isset($item_data['stock_data']) && !empty($item_data['stock_data'])){
										$item_data = $item_data['stock_data'];
										/*var_dump($item_data);
										echo '<br/><br/><br/><br/>';var_dump($column);die;*/
										$date = date("Y-m-d H:i:s");
										$expiry_date = strtotime($column[2]); 
										$expiry = date('Y-m-d', $expiry_date);									
										$n_expiry = date("Y-m-d", strtotime("-1 month", $expiry_date));
										$center = $_POST['center_number'] = $_SESSION['logged_stock_manager']['center'];
										
																				
										$sqlinsert = "INSERT INTO `".$this->config->item('db_prefix')."center_stocks`(`item_number`, `company`, `item_name`, `batch_number`, `brand_name`, `safety_stock`, `category`, `price`, `vendor_number`, `expiry`, `center_number`, `expiry_day`, `add_date`, `status`,quantity,order_qty) VALUES('".$column[0]."','".$item_data['company']. "','".$item_data['item_name']. "','".$item_data['batch_number']. "','".$item_data['brand_name']."','".$item_data['safety_stock']."','".$item_data['category']."','".$item_data['price']."','".$item_data['vendor_number']. "','".$expiry."','".$center. "','".$n_expiry. "','".$date."','1','".$column[1]. "','".$item_data['order_qty']. "')";
										$res =  $this->db->query($sqlinsert);
									}
								}
							 $count++;
							}
							if ($res)
							{
								header("location:" .base_url(). "stocks/center_stocks?m=".base64_encode('Stock uploaded successfully !').'&t='.base64_encode('success'));
								die();
							}
							else{
								header("location:" .base_url(). "stocks/center_stocks?m=".base64_encode('something went wrong !').'&t='.base64_encode('success'));
								die();
							}
						}
				}else{
					header("location:" .base_url(). "stocks/center_stocks?m=".base64_encode('File format not supported !').'&t='.base64_encode('success'));
					die();
				}
			}
			$data = array();
			$data['data'] = $this->stock_model->get_center_stocks();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/center_stocks', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	/******ALL CENTER STOCKS *****/
public function all_center_stocks()
{
	$logg = checklogin();
	if($logg['status'] == true){
		if(isset($_POST['upload_stocks']) && isset($_POST['upload_stocks']) && $_POST['upload_stocks'] == 'upload_center_stocks'){
		 
			// get details of the uploaded file
			$fileTmpPath = $_FILES['stock_lists']['tmp_name'];
			$fileName = $_FILES['stock_lists']['name'];
			$fileSize = $_FILES['stock_lists']['size'];
			$fileType = $_FILES['stock_lists']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$allowedfileExtensions = array('csv');
			if (in_array($fileExtension, $allowedfileExtensions)) {
				$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
				
				$destination = $this->config->item('upload_path');
				//var_dump($destination);die;
					
					if ($_FILES["stock_lists"]["size"] > 0) {
	
						$file = fopen($fileTmpPath, "r");
						$count = 0;
						while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
							if($count > 0){
								$item_data = $this->stock_model->get_item_details($column[0]);
								if(isset($item_data['stock_data']) && !empty($item_data['stock_data'])){
									$item_data = $item_data['stock_data'];
									/*var_dump($item_data);
									echo '<br/><br/><br/><br/>';var_dump($column);die;*/
									$date = date("Y-m-d H:i:s");
									$expiry_date = strtotime($column[2]); 
									$expiry = date('Y-m-d', $expiry_date);									
									$n_expiry = date("Y-m-d", strtotime("-1 month", $expiry_date));
									$center = $_POST['center_number'] = $_SESSION['logged_stock_manager']['center'];
									
																			
									$sqlinsert = "INSERT INTO `".$this->config->item('db_prefix')."center_stocks`(`item_number`, `company`, `item_name`, `batch_number`, `brand_name`, `safety_stock`, `category`, `price`, `vendor_number`, `expiry`, `center_number`, `expiry_day`, `add_date`, `status`,quantity,order_qty) VALUES('".$column[0]."','".$item_data['company']. "','".$item_data['item_name']. "','".$item_data['batch_number']. "','".$item_data['brand_name']."','".$item_data['safety_stock']."','".$item_data['category']."','".$item_data['price']."','".$item_data['vendor_number']. "','".$expiry."','".$center. "','".$n_expiry. "','".$date."','1','".$column[1]. "','".$item_data['order_qty']. "')";
									$res =  $this->db->query($sqlinsert);
								}
							}
						 $count++;
						}
						if ($res)
						{
							header("location:" .base_url(). "stocks/all_center_stocks?m=".base64_encode('Stock uploaded successfully !').'&t='.base64_encode('success'));
							die();
						}
						else{
							header("location:" .base_url(). "stocks/all_center_stocks?m=".base64_encode('something went wrong !').'&t='.base64_encode('success'));
							die();
						}
					}
			}else{
				header("location:" .base_url(). "stocks/all_center_stocks?m=".base64_encode('File format not supported !').'&t='.base64_encode('success'));
				die();
			}
		}
		$data = array();
		$data['data'] = $this->stock_model->get_all_center_stocks();
		$template = get_header_template($logg['role']);
		$this->load->view($template['header']);
		$this->load->view('stocks/all_center_stocks', $data);
		$this->load->view($template['footer']);
	}else{
		header("location:" .base_url(). "");
		die();
	}
}
	
	public function get_item_details(){
		$item_number = $_POST['item_number'];
		$data = $this->stock_model->get_item_details($item_number);
		echo json_encode($data);
		die;
	}

	public function add_center_item()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_center_item'){
				unset($_POST['action']);
				$_POST['center_number'] = $_SESSION['logged_stock_manager']['center'];
				//var_dump($_POST);die;
				$item_number = $_POST['item_number'];
				$item_qty = $_POST['quantity'];
				$_POST['item_number'] = $_POST['item_number'];
				$_POST['add_date'] = date("Y-m-d H:i:s");
				$_POST['update_date'] = date("Y-m-d H:i:s");
				$vendor_number = self::get_vendor_number($_POST['item_number']);
				$_POST['vendor_number'] = $vendor_number;

              
				$check_center_item = $this->stock_model->check_center_item($item_number, $_SESSION['logged_stock_manager']['center']);
				if(!empty($check_center_item)){
				    
					$data = $this->stock_model->update_center_item_qty($item_number, $item_qty);
					if($data > 0){
						header("location:" .base_url(). "stocks/add_center_item?m=".base64_encode('Item updated successfully !').'&t='.base64_encode('success'));
						die();
					}else{
						header("location:" .base_url(). "stocks/add_center_item?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}	
				}else{
					$data = $this->stock_model->add_center_item($_POST);
					if($data > 0){
						header("location:" .base_url(). "stocks/add_center_item?m=".base64_encode('Item added successfully !').'&t='.base64_encode('success'));
						die();
					}else{
						header("location:" .base_url(). "stocks/add_center_item?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
						die();
					}	
				}			
			}
			$data = array();
			$data['categories'] = $this->stock_model->get_categories();
		    $data['item_lists'] = $this->stock_model->get_item_lists();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/add_center_item', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function edit_center_item()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_GET['item_number'])){ $item_id = $_GET['item_number']; }
			if(isset($_POST['item_number'])) { $item_id = $_POST['item_number']; }
			
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_center_item'){
				unset($_POST['action']);
				$data = $this->stock_model->update_center_item_data($_POST, $item_id);
				if($data > 0){
					header("location:" .base_url(). "stocks/edit_center_item?m=".base64_encode('Item updated successfully !').'&t='.base64_encode('success').'&item_number='.$item_id);
					die();
				}else{
					header("location:" .base_url(). "stocks/edit_center_item?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&item_number='.$item_id);
					die();
				}				
			}
			$data['item_number'] = $item_id;
			$data['data'] = $this->stock_model->get_center_item_data($item_id);
			$data['categories'] = $this->stock_model->get_categories();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/edit_center_item', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function delete_center_item()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$item = $_GET['item_number'];
			if( $item > 0 )
			{
				if( $this->stock_model->delete_center_item_data($item) !== 0)
				{
					header("location:" .base_url(). "stocks/center_stocks?m=".base64_encode('Item deleted successfully !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "stocks/center_stocks?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			header("location:" .base_url(). "stocks/center_stocks?m=".base64_encode('Item not found !').'&t='.base64_encode('error'));
			die();
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function cdetail($item){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = $this->stock_model->item_details($item, 'center');
//			var_dump($data);die;
			$post_arr = array();
			$post_arr['data'] = $data;
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/details', $post_arr);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	/****** CENTER STOCKS *****/
	
	public function add_billing_item(){
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_billing_item'){
				unset($_POST['action']);
				
				$post_arr['patient_id'] = $_POST['patient_id'];unset($_POST['patient_id']);
				$post_arr['receipt_number'] = $_POST['receipt_number'];unset($_POST['receipt_number']);
				$post_arr['center_number'] = $_SESSION['logged_stock_manager']['center'];
				//echo '<pre>';
				
				$icounte = $mcounte = $ccounte = $spcounte = 1;
				$i_counte = $m_counte = $c_counte = $s_pcounte = array();
				$i_counter = $m_counter = $c_counter = $s_pcounter = array();
				foreach($_POST as $key => $val){
					$pos = strpos($key, 'injections_name_');
					if ($pos === false) {} else {
						$iid = $int = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
						$i_counter[] = $iid;
					}	
					$pos_m = strpos($key, 'medicine_name_');
					if ($pos_m === false) {} else {
						$mid = $int = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
						$m_counter[] = $mid;
					}	
					
					$pos_c = strpos($key, 'consumables_name_');
					if ($pos_c === false) {} else {
						$cid = $int = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
						$c_counter[] = $cid;
					}	
				}

				// var_dump($_POST); 
				// echo '<br/><br/><br/><br/>';
				// die;

				// var_dump($i_counter); echo '<br/><br/><br/><br/>'; 
				// var_dump($m_counter); echo '<br/><br/><br/><br/>'; 
				// var_dump($c_counter); echo '<br/><br/><br/><br/>'; die;
				if(!empty($i_counter)){
					foreach($i_counter as $key => $icounte){
						if($_POST['injections_name_'.$icounte] == ''){
							unset($_POST['injections_serial_'.$icounte]);
							unset($_POST['injections_name_'.$icounte]);
							unset($_POST['injections_quantity_'.$icounte]);
							// unset($_POST['injections_company_'.$icounte]);
							unset($_POST['injections_price_'.$icounte]);
						}else{
							$i_counte[] = array('injections_serial'=> $_POST['injections_serial_'.$icounte],'injections_name'=> $_POST['injections_name_'.$icounte],'injections_quantity'=> $_POST['injections_quantity_'.$icounte],'injections_price'=> $_POST['injections_price_'.$icounte]);
						}
					}
				}
				if(!empty($m_counter)){
					foreach($m_counter as $key => $mcounte){
						if($_POST['medicine_name_'.$mcounte] == ''){
							unset($_POST['medicine_serial_'.$mcounte]);
							unset($_POST['medicine_name_'.$mcounte]);
							unset($_POST['medicine_quantity_'.$mcounte]);
							// unset($_POST['medicine_company_'.$mcounte]);
							unset($_POST['medicine_price_'.$mcounte]);
						}else{
							$m_counte[] = array('medicine_serial'=> $_POST['medicine_serial_'.$mcounte],'medicine_name'=> $_POST['medicine_name_'.$mcounte],'medicine_quantity'=> $_POST['medicine_quantity_'.$mcounte],'medicine_price'=> $_POST['medicine_price_'.$mcounte]);
						}
					}
				}
				if(!empty($c_counter)){
					foreach($c_counter as $key => $ccounte){
						if($_POST['consumables_name_'.$ccounte] == ''){
							unset($_POST['consumables_serial_'.$ccounte]);
							unset($_POST['consumables_name_'.$ccounte]);
							unset($_POST['consumables_quantity_'.$ccounte]);
							// unset($_POST['consumables_company_'.$ccounte]);
							unset($_POST['consumables_price_'.$ccounte]);
						}else{
							$c_counte[] = array('consumables_serial'=> $_POST['consumables_serial_'.$ccounte],'consumables_name'=> $_POST['consumables_name_'.$ccounte],'consumables_quantity'=> $_POST['consumables_quantity_'.$ccounte],'consumables_price'=> $_POST['consumables_price_'.$ccounte]);
						}
					}
				}
								
				$details = array();
				$details['data']['consumables'] = $c_counte;
				$details['data']['injections'] = $i_counte;
				$details['data']['medicine'] = $m_counte;
				$post_arr['data'] = serialize($details);
				$post_arr['add_on'] = date("Y-m-d H:i:s");
				
				// var_dump($_POST); echo '<br/><br/><br/><br/>';//die;
				// var_dump($post_arr);
				// die;
				
				$result = $this->stock_model->billing_item_insert($post_arr);
				if($result > 0){
					if(!empty($i_counter)){
						foreach($i_counter as $key => $icounte){
							$serial = $_POST['injections_serial_'.$icounte];
							$qty = $_POST['injections_quantity_'.$icounte];
							$update_stock = $this->stock_model->deduct_stock($serial, $qty);
						}
					}
					if(!empty($m_counter)){
						foreach($m_counter as $key => $mcounte){
							$serial = $_POST['medicine_serial_'.$mcounte];
							$qty = $_POST['medicine_quantity_'.$mcounte];
							$update_stock = $this->stock_model->deduct_stock($serial, $qty);
						}
					}
					if(!empty($c_counter)){
						foreach($c_counter as $key => $ccounte){
							$serial = $_POST['consumables_serial_'.$ccounte];
							$qty = $_POST['consumables_quantity_'.$ccounte];
							$update_stock = $this->stock_model->deduct_stock($serial, $qty);
						}
					}
					header("location:" .base_url(). "stocks/add_billing_item?m=".base64_encode('Patient Items added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "stocks/add_billing_item?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			//var_dump($this->stock_model->get_center_medicine_list());die;
			$template = get_header_template($logg['role']);
			$data['consumables'] = $this->stock_model->get_center_consumbles_list();
			$data['injections'] = $this->stock_model->get_center_injection_list();
			$data['medicine'] = $this->stock_model->get_center_medicine_list();
			$this->load->view($template['header']);
			$this->load->view('stocks/add_billing_item', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	function get_stock_item_price(){
		$item_number = $_POST['item_number'];
		$units = $_POST['units'];
		$data = $this->stock_model->get_stock_item_price($item_number, $units);
		//var_dump($data);die;
		echo json_encode($data);die;
	}
	
	function patient_items(){
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/patient_items', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function get_patient_items_data(){
		$patient_id = $_POST['patient_id'];
		$consumable_result = $injection_result = $medicine_result = $patient_result = array();
		$data = $this->stock_model->get_patient_items_data($patient_id);
		//var_dump($data);die;
		
		$patient_result = $data['patient_result'];
		//var_dump($data);die;
		$response = array();
		$total_consum_price = 0;
		if (!empty($patient_result))
        {       
			$html = '';
			foreach($data as $ky => $vls){ //var_dump($vls);die;
				$consumable_result = isset($vls['consumable_result'])?$vls['consumable_result']:array();
				$injection_result = isset($vls['injection_result'])?$vls['injection_result']:array();
				$medicine_result = isset($vls['medicine_result'])?$vls['medicine_result']:array();
				if(count($consumable_result) > 0){
					$type = 'Consumable';
					foreach($consumable_result as $key => $val){//var_dump($vls['receipt_number']);die;
						$item_data = $this->stock_model->get_center_item_data($val['consumables_serial']);
						//var_dump($item_data);die;
						$html .= '<tr>';
							$html .= '<td><a href="'.base_url().'stocks/cdetail/'.$val['consumables_serial'].'">'.$val['consumables_serial'].'</a></td>';
							$html .= '<td><a href="'.base_url().'accounts/details/'.$vls['receipt_number'].'?t=procedure">'.$vls['receipt_number'].'</a></td>';
							$html .= '<td>'.$item_data['item_name'].'</td>';
							$html .= '<td>'.$item_data['batch_number'].'</td>';
							$html .= '<td>'.$type.'</td>';
							$html .= '<td>'.$val['consumables_quantity'].'</td>';
							$html .= '<td><i class="fa fa-inr" aria-hidden="true"></i> '.$val['consumables_price'].'</td>';
							$total_consum_price += $val['consumables_price'];
							// $html .= '<td>'.date('d-m-Y H:i', strtotime($vls['add_on'])).'</td>';
						$html .= '</tr>';
					}
				}//var_dump($html);die;
				if(count($injection_result) > 0){
					$type = 'Injection';
					foreach($injection_result as $key => $val){
						$item_data = $this->stock_model->get_center_item_data($val['injections_serial']);
						$html .= '<tr>';
							$html .= '<td><a href="'.base_url().'stocks/cdetail/'.$val['injections_serial'].'">'.$val['injections_serial'].'</a></td>';
							$html .= '<td><a href="'.base_url().'accounts/details/'.$vls['receipt_number'].'?t=procedure">'.$vls['receipt_number'].'</a></td>';
							$html .= '<td>'.$item_data['item_name'].'</td>';
							$html .= '<td>'.$item_data['batch_number'].'</td>';
							$html .= '<td>'.$type.'</td>';
							$html .= '<td>'.$val['injections_quantity'].'</td>';
							$html .= '<td><i class="fa fa-inr" aria-hidden="true"></i> '.$val['injections_price'].'</td>';
							$total_consum_price += $val['injections_price'];
							// $html .= '<td>'.date('d-m-Y H:i', strtotime($vls['add_on'])).'</td>';
						$html .= '</tr>';
					}
				}
				
				if(count($medicine_result) > 0){
					$type = 'Medicine';
					foreach($medicine_result as $key => $val){
						$item_data = $this->stock_model->get_center_item_data($val['medicine_serial']);
						$html .= '<tr>';
							$html .= '<td><a href="'.base_url().'stocks/cdetail/'.$val['medicine_serial'].'">'.$val['medicine_serial'].'</a></td>';
							$html .= '<td><a href="'.base_url().'accounts/details/'.$vls['receipt_number'].'?t=procedure">'.$vls['receipt_number'].'</a></td>';
							$html .= '<td>'.$item_data['item_name'].'</td>';
							$html .= '<td>'.$item_data['batch_number'].'</td>';
							$html .= '<td>'.$type.'</td>';
							$html .= '<td>'.$val['medicine_quantity'].'</td>';
							$html .= '<td><i class="fa fa-inr" aria-hidden="true"></i> '.$val['medicine_price'].'</td>';
							$total_consum_price += $val['medicine_price'];
							// $html .= '<td>'.date('d-m-Y H:i', strtotime($vls['add_on'])).'</td>';
						$html .= '</tr>';
					}
				}

			}
			// if(count($consumable_result) > 0){
			// 	$type = 'Consumable';
			// 	foreach($consumable_result as $key => $val){var_dump($consumable_result);die;
			// 		$item_data = $this->stock_model->get_center_item_data($val['consumables_serial']);
			// 		$html .= '<tr>';
			// 			$html .= '<td><a href="'.base_url().'stocks/cdetail/'.$val['consumables_serial'].'">'.$val['consumables_serial'].'</a></td>';
			// 			$html .= '<td><a href="'.base_url().'accounts/details/'.$data['receipt_number'].'?t=procedure">'.$data['receipt_number'].'</a></td>';
			// 			$html .= '<td>'.$item_data['item_name'].'</td>';
			// 			$html .= '<td>'.$val['consumables_company'].'</td>';
			// 			$html .= '<td>'.$type.'</td>';
			// 			$html .= '<td>'.$val['consumables_quantity'].'</td>';
			// 			$html .= '<td><i class="fa fa-inr" aria-hidden="true"></i> '.$val['consumables_price'].'</td>';
			// 		$html .= '</tr>';
			// 	}
			// }
			// if(count($injection_result) > 0){
			// 	$type = 'Injection';
			// 	foreach($injection_result as $key => $val){
			// 		$item_data = $this->stock_model->get_center_item_data($val['injections_serial']);
			// 		$html .= '<tr>';
			// 			$html .= '<td><a href="'.base_url().'stocks/cdetail/'.$val['injections_serial'].'">'.$val['injections_serial'].'</a></td>';
			// 			$html .= '<td><a href="'.base_url().'accounts/details/'.$data['receipt_number'].'?t=procedure">'.$data['receipt_number'].'</a></td>';
			// 			$html .= '<td>'.$item_data['item_name'].'</td>';
			// 			$html .= '<td>'.$val['injections_company'].'</td>';
			// 			$html .= '<td>'.$type.'</td>';
			// 			$html .= '<td>'.$val['injections_quantity'].'</td>';
			// 			$html .= '<td><i class="fa fa-inr" aria-hidden="true"></i> '.$val['injections_price'].'</td>';
			// 		$html .= '</tr>';
			// 	}
			// }
			
			// if(count($medicine_result) > 0){
			// 	$type = 'Medicine';
			// 	foreach($medicine_result as $key => $val){
			// 		$item_data = $this->stock_model->get_center_item_data($val['medicine_serial']);
			// 		$html .= '<tr>';
			// 			$html .= '<td><a href="'.base_url().'stocks/cdetail/'.$val['medicine_serial'].'">'.$val['medicine_serial'].'</a></td>';
			// 			$html .= '<td><a href="'.base_url().'accounts/details/'.$data['receipt_number'].'?t=procedure">'.$data['receipt_number'].'</a></td>';
			// 			$html .= '<td>'.$item_data['item_name'].'</td>';
			// 			$html .= '<td>'.$val['medicine_company'].'</td>';
			// 			$html .= '<td>'.$type.'</td>';
			// 			$html .= '<td>'.$val['medicine_quantity'].'</td>';
			// 			$html .= '<td><i class="fa fa-inr" aria-hidden="true"></i> '.$val['medicine_price'].'</td>';
			// 		$html .= '</tr>';
			// 	}
			// }
			
			$response = array('data' => $html, 'patient_name'=> $patient_result['wife_name'], 'patient_email'=> $patient_result['wife_email'], 'patient_phone'=> $patient_result['wife_phone'], "total_consum_price" =>$total_consum_price);
			echo json_encode($response);
			die;
        }else{
			$response = array('data' => 'No record found!', 'patient_name'=> '', 'patient_email'=> '', 'patient_phone'=> '', 'total_consum_price' =>0);
		}
	}
	
	/****** CENTER STOCKS *****/
	
	public function categories(){
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$data['data'] = $this->stock_model->get_categories();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/categories', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function add_category(){
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_category'){
				unset($_POST['action']);
				$data = $this->stock_model->add_category($_POST);
				if($data > 0){
					header("location:" .base_url(). "stocks/add_category?m=".base64_encode('Category added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "stocks/add_category?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/add_category');
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function edit_category()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_GET['i'])){ $item_id = $_GET['i']; }
			if(isset($_POST['i'])) { $item_id = $_POST['i']; }
			
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_category'){
				unset($_POST['action']);unset($_POST['i']);
				$data = $this->stock_model->update_category_data($_POST, $item_id);
				if($data > 0){
					header("location:" .base_url(). "stocks/edit_category?m=".base64_encode('Category updated successfully !').'&t='.base64_encode('success').'&i='.$item_id);
					die();
				}else{
					header("location:" .base_url(). "stocks/edit_category?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&i='.$item_id);
					die();
				}				
			}
			$data['data'] = $this->stock_model->get_category_data($item_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/edit_category', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function delete_category()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$item = $_GET['i'];
			if( $item > 0 )
			{
				if( $this->stock_model->delete_category_data($item) !== 0)
				{
					header("location:" .base_url(). "stocks/categories?m=".base64_encode('Category deleted successfully !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "stocks/categories?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			header("location:" .base_url(). "stocks/categories?m=".base64_encode('Category not found !').'&t='.base64_encode('error'));
			die();
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	/**** Products ****/
	
	public function products(){
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$data['data'] = $this->stock_model->get_products();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/products', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function add_product(){
		$logg = checklogin();
		if($logg['status'] == true){
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_product'){
				unset($_POST['action']);
				$data = $this->stock_model->add_product($_POST);
				if($data > 0){
					header("location:" .base_url(). "stocks/add_product?m=".base64_encode('Product added successfully !').'&t='.base64_encode('success'));
					die();
				}else{
					header("location:" .base_url(). "stocks/add_product?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}				
			}
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/add_product');
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function edit_product()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			if(isset($_GET['i'])){ $item_id = $_GET['i']; }
			if(isset($_POST['i'])) { $item_id = $_POST['i']; }
			
			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_product'){
				unset($_POST['action']);unset($_POST['i']);
				$data = $this->stock_model->update_product_data($_POST, $item_id);
				if($data > 0){
					header("location:" .base_url(). "stocks/edit_product?m=".base64_encode('Product updated successfully !').'&t='.base64_encode('success').'&i='.$item_id);
					die();
				}else{
					header("location:" .base_url(). "stocks/edit_product?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error').'&i='.$item_id);
					die();
				}				
			}
			$data['data'] = $this->stock_model->get_product_data($item_id);
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('stocks/edit_product', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	public function delete_product()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$item = $_GET['i'];
			if( $item > 0 )
			{
				if( $this->stock_model->delete_category_data($item) !== 0)
				{
					header("location:" .base_url(). "stocks/categories?m=".base64_encode('Category deleted successfully !').'&t='.base64_encode('success'));
					die();
				}
				else
				{
					header("location:" .base_url(). "stocks/categories?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
					die();
				}
			}
			header("location:" .base_url(). "stocks/categories?m=".base64_encode('Category not found !').'&t='.base64_encode('error'));
			die();
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}
	
	/**** Products ****/
	
	public function central_stock_export(){
		$list = $this->stock_model->get_items();
		 // disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
	
		// disposition / encoding on response body
		header('Content-Type: application/csv');
		header("Content-Disposition: attachment;filename=central_stock_".date('Y-m-d').".csv");
		header("Content-Transfer-Encoding: binary");
		
		if (count($list) == 0) {
		 return null;
	   }
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($list)));
	   foreach ($list as $row) {		
			  fputcsv($df, $row);		
	   }
	   fclose($df);
	   exit();
	   header("location:" .base_url(). "stocks/stocks?m=".base64_encode('Stocks exported !').'&t='.base64_encode('success'));
	   die();
	}
	
	public function center_stock_export($center){
		$list = $this->stock_model->center_stock_export($center);
		 // disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
	
		// disposition / encoding on response body
		header('Content-Type: application/csv');
		header("Content-Disposition: attachment;filename=".$center."_stock_".date('Y-m-d').".csv");
		header("Content-Transfer-Encoding: binary");
		
		if (count($list) == 0) {
		 return null;
	   }
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($list)));
	   foreach ($list as $row) {		
			  fputcsv($df, $row);		
	   }
	   fclose($df);
	   exit();
	   header("location:" .base_url(). "stocks/center_stocks?m=".base64_encode('Stocks exported !').'&t='.base64_encode('success'));
	   die();
	}
	
	function get_category_name($category){
		$name = $this->stock_model->get_category_name($category);
		return $name;		
	}
	
	function get_consumbles_list(){
		$consumbles = $this->stock_model->get_consumbles_list();
		return $consumbles;	
	}
	
	function get_injection_list(){
		$injection = $this->stock_model->get_injection_list();
		return $injection;	
	}
	
	function get_medicine_list(){
		$medicine = $this->stock_model->get_medicine_list();
		return $medicine;	
	}
	function get_brand_name($brand){
		$brand_name = $this->order_model->get_brand_name($brand);
		return $brand_name;
	}
	
	function get_vendor_number($item){
		$vendor_number = $this->stock_model->get_vendor_number($item);
		return $vendor_number;
	}

	function get_vendor_name($item){
		$vendor_name = $this->stock_model->get_vendor_name($item);
		return $vendor_name;
	}
	
	function get_product_name($item){
		$product_name = $this->stock_model->get_product_name($item);
		return $product_name;
	}
	
} 