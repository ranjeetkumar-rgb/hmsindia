<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Stock_model extends CI_Model
{
	/**Products */

	function get_product_name($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."stock_products where ID='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return "--";
        }
	}
	function stock_product_add($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "stock_products` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}

	function get_stock_products(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stock_products ORDER by ID DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result)){
            return $result;
        }else{
            return $result;
        }
	}

	function get_product_brand_vendor($product_id, $brand_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."product_vendors where product_id='$product_id' and brand_number='$brand_number' ORDER by ID DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result)){
            return $result;
        }else{
            return $result;
        }
	}

	function get_product_vendor_info($product_id, $brand_number, $vendor_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select price, units from ".$this->config->item('db_prefix')."product_vendors where product_id='$product_id' and brand_number='$brand_number' and vendor_number='$vendor_number' ORDER by ID DESC limit 1";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result)){
            return $result[0];
        }else{
            return $result;
        }
	}
		
	function center_stock_export($center){ 
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where center_number='".$center."' ORDER by ID DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function add_item($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "stocks` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'";
		}
		$date = date("Y-m-d H:i:s");
		$sqlArr[] = " add_date = '".addslashes($date)."'";
		$sqlArr[] = " item_number = '".addslashes(getGUID())."'";	
		
		$sql .= implode(',' , $sqlArr);		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function get_item_lists(){
		$result = array();
		$options = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks ORDER by expiry ASC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
			foreach($result as $key => $val){
				$options .= '<option value="'.$val['item_number'].'">'.$val['item_name'].' ('.$val['expiry'].')-('.$val['batch_number'].')</option>';
			}
            return $options;
        }
        else
        {
            return $options;
        }
	}
	
	function get_item_details($item){
		$result = $response = array();
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks where item_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		if (!empty($result))
        {
			$stock_data = $result[0];
			$cat_name = self::get_category_name($result[0]['category']);
			$brand_name = self::get_brand_name($result[0]['brand_name']);
			$brand_number = $result[0]['brand_name'];
			$product_id = $result[0]['product_id'];
			$vendor_number = $result[0]['vendor_number'];
			$product_vendor_info = $this->get_product_vendor_info($product_id, $brand_number, $vendor_number);
			
			$response = array('stock_data' => $stock_data, 'cat_name' => $cat_name, 'brand_name' => $brand_name, "product_vendor_info" =>$product_vendor_info);
            return $response;
        }
        else
        {
			$response = array('stock_data' => "", 'cat_name' => "", 'brand_name' => "", "product_vendor_info" => "");
            return $response;
        }
	}
	
	function item_details($item, $item_of){
		$result = $response = array();
		$condition = "";
		if($item_of == 'center'){
			$condition = "center_stocks";
		}else if($item_of == 'admin'){
			$condition = "stocks";
		}else{
			$condition = "center_stocks";
		}
		$sql = "Select * from ".$this->config->item('db_prefix').$condition." where item_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $response;
        }
	}
	
	function add_center_item($data){
	echo $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "center_stocks` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}		
		$sql .= implode(',' , $sqlArr);		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function get_item_data($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks where item_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}

	function get_stock_product_data($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stock_products where ID='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}

	function get_center_item_data($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where item_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_item_medicine($ID){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where ID='".$ID."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	} 

	public function update_stock_product_data($data, $item)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "stock_products SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$item."'";
        $this->db->query($sql);
        return 1;
	}

	public function product_vendor_update($data, $item)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "product_vendors SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$item."'";
        $this->db->query($sql);
        return 1;
	}
	
	public function update_item_data($data, $item)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "stocks SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE item_number = '".$item."'";
        $this->db->query($sql);
        return $this->db->affected_rows();
	}
	
	public function update_item($data, $product_id, $brand_name, $vendor_number, $batch_number, $expiry)
    {
		//var_dump($data);die;
		$sql = "UPDATE hms_stocks SET `product_id` = '$product_id', `brand_name` = '$brand_name', `vendor_number` = '$vendor_number', `quantity` = quantity+".$data['quantity'].", `safety_stock` = '".$data['safety_stock']."', `price` = '".$data['price']."', `batch_number` = '".$batch_number."', `expiry` = '$expiry', `expiry_day` = '".$data['expiry_day']."', `order_qty` = '".$data['order_qty']."', `category` = '".$data['category']."', `status` = '1'";
		$sql .= " WHERE `product_id`='$product_id' and `brand_name`='$brand_name' and `vendor_number`='$vendor_number' and `batch_number`='$batch_number'";
		$this->db->query($sql);
        return $this->db->affected_rows();
    }
	
	public function update_center_item_data($data, $ID)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "center_stocks SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$ID."'";
        $this->db->query($sql);
        return 1;
    }
	
	public function delete_item_data($item){
		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "stocks WHERE item_number = '".$item."'";
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return 1;
		}
		else
			return 0;	
	}
	
	public function delete_center_item_data($item){
		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "center_stocks WHERE item_number = '".$item."'";
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return 1;
		}
		else
			return 0;	
	}
	
	function get_categories(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."categories ORDER by ID ASC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function add_category($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "categories` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}
		$sqlArr[] = " category_id = '".addslashes(getGUID())."'"	;
		$sql .= implode(',' , $sqlArr);
		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function get_category_data($cat){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."categories where ID='".$cat."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}
	
	public function update_category_data($data, $item)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "categories SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$item."'";
        $this->db->query($sql);
        return 1;
    }
	
	public function delete_category_data($item){
		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "categories WHERE ID = '".$item."'";
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return 1;
		}
		else
			return 0;	
	}
	
	
	/**** Products ***/
		
	function get_products(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."products ORDER by ID ASC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function add_product($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "products` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}
		$sqlArr[] = " code = '".addslashes(getGUID())."'"	;
		$sql .= implode(',' , $sqlArr);
		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function get_product_data($item_id){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."products where ID='".$item_id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}
	
	public function update_product_data($data, $item)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "products SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$item."'";
        $this->db->query($sql);
        return 1;
    }
	
	public function delete_product_data($item){
		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "products WHERE ID = '".$item."'";
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return 1;
		}
		else
			return 0;	
	}
		
	/**** Products ****/
	
	function get_category_name($category){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."categories where category_id='".$category."' ORDER by ID DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_brand_name($brand){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."brands where brand_number='".$brand."' ORDER by ID DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return "--";
        }
	}
	
	function get_consumbles_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks where category='1565461619'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
		function get_employee_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."employees where role='stock_manager' and status='1'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_consumbles_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where category='1565461624' AND center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND quantity > 0 order by expiry asc";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_consumbles_medicine_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND quantity > 0 order by expiry asc";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_injection_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks where category='1565461619'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_injection_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where category='1565461619' AND center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND quantity > 0 order by expiry asc";
      //  $sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where center_number='".$_SESSION['logged_stock_manager']['center']."' AND quantity > 0 order by expiry asc";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}

	function get_stock_item_price($item_number, $units){
		$get_item_details = $this->get_item_details($item_number);
		if(!empty($get_item_details)){
			$product_vendor_info = $get_item_details['product_vendor_info'];
			//var_dump($product_vendor_info);die;
			if(!empty($product_vendor_info)){
				$vendor_price = $product_vendor_info['price'];
				$vendor_units = $product_vendor_info['units'];

				$percent = $vendor_price / $vendor_units;
				$item_price = $percent * $units;
				return $item_price;
			}else{
				return " ";
			}
		}else{
			return " ";
		}
	}
	function get_stock_item_discount_price($item_number, $units, $discount){
		$get_item_details = $this->get_item_details($item_number);
		if(!empty($get_item_details)){
			$product_vendor_info = $get_item_details['product_vendor_info'];
			//var_dump($product_vendor_info);die;
			if(!empty($product_vendor_info)){
				$vendor_price = $product_vendor_info['price'];
				$vendor_units = $product_vendor_info['units'];

				$percent = $vendor_price / $vendor_units;
				$item_price = ($percent * $units)- $discount;
				return $item_price;
			}else{
				return " ";
			}
		}else{
			return " ";
		}
	}
	
	function get_medicine_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks where category='1579086005'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_medicine_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where category='1579086005' AND center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND quantity > 0 order by expiry asc";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_embrology_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where category='1565461628' AND center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND quantity > 0 order by expiry asc";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_medicine_data($receipt){
		$result = array();
		$sql_condition = '';
	    $sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where receipt_number='$receipt' order by on_date asc";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function update_stock($id, $order_quantity)
	{
 		$sql = "UPDATE " . config_item('db_prefix') . "stocks SET quantity = quantity + '".$order_quantity."'";
		$sql .= " WHERE item_number = '".$id."'";
        $this->db->query($sql);
        return 1;	
    }
	
	function billing_item_insert($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "patient_items` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'";
		}
		$sql .= implode(',' , $sqlArr);
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function billing_medicine_item_insert($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "patient_medicine` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'";
		}
		$sql .= implode(',' , $sqlArr);
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function deduct_stock($serial, $qty){
		$sql = "UPDATE ".$this->config->item('db_prefix')."center_stocks SET `quantity` = `quantity` - ".$qty." WHERE item_number='".$serial."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."'";
        $this->db->query($sql);
        return 1;
	}
	
	function get_patient_name($receipt, $patient_id){
		$consumable_result = $injection_result = $medicine_result = array();
		
		$patient_items_sql = "Select * from ".$this->config->item('db_prefix')."patient_items where patient_id='".$patient_id."' AND receipt_number='".$receipt."'";
        $patient_items_q = $this->db->query($patient_items_sql);
        $patient_items_result = $patient_items_q->result_array();
		if (!empty($patient_items_result))
        {
			$patient_items_result = $patient_items_result[0];
			$data = unserialize($patient_items_result['data']);
			$data = $data['data'];
			if (!empty($data['consumables']))
       		{
				foreach($data['consumables'] as $ky => $vl){
					$consumable_result[] = $vl;
				}
			}
			if (!empty($data['injections']))
       		{
				foreach($data['injections'] as $ky => $vl){
					$injection_result[] = $vl;
				}
			}
			if (!empty($data['medicine']))
       		{
				foreach($data['medicine'] as $ky => $vl){
					$medicine_result[] = $vl;
				}
			}
			
			$response = array();
			$response = array('consumable_result' => $consumable_result, 'injection_result' => $injection_result, 'medicine_result' => $medicine_result);
			return $response;
        }
	}
	
	function get_patient_items_data($patient_id){
		$consumable_result = $injection_result = $medicine_result = $patient_result = array();
		
		$patient_sql = "Select wife_name, wife_email, wife_phone from ".$this->config->item('db_prefix')."patients where patient_id='".$patient_id."'";
		//echo $patient_sql;die;
		$patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		//var_dump($patient_result);die;
		if (!empty($patient_result))
        {
           $patient_result = $patient_result[0];
        }

		$patient_items_sql = "Select * from ".$this->config->item('db_prefix')."patient_items where patient_id='".$patient_id."' order by add_on desc";
        $patient_items_q = $this->db->query($patient_items_sql);
        $patient_items_result = $patient_items_q->result_array();
		
		$response = array();
		
		if (!empty($patient_items_result))
        {
			
			//echo $vls['add_on'];
				//echo '<pre>';
				//print_r($patient_items_result);
				//echo '</pre>';
			
			foreach($patient_items_result as $key => $vals){
				//var_dump($vals);die;
				$patientitemsresult = $vals;
				$data = unserialize($patientitemsresult['data']);
				
				
				$data = $data['data'];
				
				if (!empty($data['consumables']))
				{
					foreach($data['consumables'] as $ky => $vl){
						$consumable_result[] = $vl;
					}
				}
				if (!empty($data['injections']))
				{
					foreach($data['injections'] as $ky => $vl){
						$injection_result[] = $vl;
					}
				}
				if (!empty($data['medicine']))
				{
					foreach($data['medicine'] as $ky => $vl){
						$medicine_result[] = $vl;
					}
				}
			}
			$response[] = array(
			'consumable_result' => $consumable_result,
			'injection_result' => $injection_result,
			'medicine_result' => $medicine_result,
			'receipt_number' => $patientitemsresult['receipt_number'],
			'add_on' => $patientitemsresult['add_on'],
			);
			//var_dump($response);die;
		}
		
		
		$response['patient_result'] = $patient_result;//var_dump($response);die;
		return $response;		
	}
	
	// Brands
	function get_brands(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."brands ORDER by ID ASC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}

	function get_brands_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."brands where status='1' ORDER by ID ASC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}

	function stock_product_brands($data, $product){
		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "product_brands WHERE product_id = '".$product."'";
		$res =  $this->db->query($sql);
		
		foreach($data['brands'] as $key => $vals){
			$sql = "INSERT INTO `".$this->config->item('db_prefix')."product_brands` (`brand_number`, `product_id`) VALUES ('$vals', '$product')";
			$res =  $this->db->query($sql);						
		}
		return 1;
	}

	// Product Vendor


	function product_vendor_add($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "product_vendors` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'";
		}
		$sql .= implode(',' , $sqlArr);
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}

	function get_product_vendor_data($id){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."product_vendors where ID='$id'";
        $q = $this->db->query($sql);
		$result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }else{
            return $result;
        }
	}

	function get_stock_product_vendors(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."product_vendors ORDER by ID ASC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }else{
            return $result;
        }
	}

	
	function get_product_brands($product){
		$result = array();
		$sql_condition = '';
		$sql = "Select brand_number from ".$this->config->item('db_prefix')."product_brands where product_id='".$product."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}

	function check_center_item($item_number, $center=""){
	    
	    $sql_condition = "";
	    if(!empty($center)){
	        $sql_condition = " AND center_number='".$center."' ";    
	    }
	    
		$result = array();
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where item_number='".$item_number."' ".$sql_condition." limit 1";
		
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}

	function check_centeral_item($product_id, $brand_name, $vendor_number, $batch_number, $expiry){
		$result = array();
		$sql_condition = '';
		$sql = "Select count(*) as count from ".$this->config->item('db_prefix')."stocks where product_id='".$product_id."' and brand_name='$brand_name' and vendor_number='$vendor_number' and batch_number='$batch_number' and expiry='$expiry'  limit 1";
		//echo $sql;die;
		$q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['count'];
        }else
        {
            return $result;
        }
	}

	public function update_center_item_qty($item_number, $item_qty)
    {
		$sql = "UPDATE `hms_center_stocks` SET `quantity`= `quantity`-$item_qty, `update_date` = '".date("Y-m-d H:i:s")."' WHERE item_number='$item_number'";
		//echo $sql;die;
		$this->db->query($sql);
        return $this->db->affected_rows();
	}
	
	// Patient Inventory 
	function inventory_dispense_data(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_items ORDER by add_on DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }else
        {
            return $result;
        }
	}

	// Vendor number 
	function get_vendor_number($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select vendor_number from ".$this->config->item('db_prefix')."stocks where item_number='".$item."' ORDER by ID DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['vendor_number'];
        }
        else
        {
            return "--";
        }
	}	

	function get_vendor_name($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."vendors where vendor_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return "--";
        }
	}

	function patient_center_medicine_count($center, $start_date, $end_date, $patient_id){
		//$investigation_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}

		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		
	}

	function center_medicine_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id){
		//$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where billing_at='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	}
	
	function disaprove_medicine_count($center, $start_date, $end_date, $patient_id){
		//$investigation_result = array();
		$conditions = '';
		
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}

		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		
	}
	
	function disaprove_medicine_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id){
		//$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where status='disapproved' AND 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	}
	
	function export_medicine_center_data($start, $end, $patient_id, $type){

		$investigation_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['stock_manager']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		
	   $investigation_sql = "Select DISTINCT patient_id, patient_detail_name, on_date,data, receipt_number, hospital_id, payment_method,status from ".$this->config->item('db_prefix')."patient_medicine where 1 $conditions AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' order by on_date desc";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				$_data = unserialize($val['data']);
				$consumables_name_arr = [];
				$consumables_stock_arr = [];
				$consumables_quantity_arr = [];
				//echo '<pre>';
				//print_r($_data);
                 //die;
				//echo '<br>';
				foreach($_data as $value1){
				//	print_r($value1);
					foreach($value1 as $value2){
						//print_r($value2);
						foreach($value2 as $value3){
							//print_r($value3);
							if($value3['consumables_name']){
								array_push($consumables_name_arr,$value3['consumables_name']);
							}
							array_push($consumables_stock_arr,$value3['consumables_total_']);
							array_push($consumables_quantity_arr,$value3['consumables_quantity']);
						}
					}
				}
				//print_r($consumables_name_arr);
				 $consumables_name = implode(',', $consumables_name_arr );
				 $consumables_total_ = implode(',', $consumables_stock_arr );
				 $consumables_quantity = implode(',', $consumables_quantity_arr );
				if($consumables_name  != ''){
				 $consumables_name_sql = "SELECT item_name FROM hms_stocks WHERE item_number IN (".$consumables_name.")" ;
				}
				//die();
				$_consumables_name_arr = [];
				$consumables_name_sql_q = $this->db->query($consumables_name_sql);
				$consumables_name_sql_q_result = $consumables_name_sql_q->result_array();
				if(!empty($consumables_name_sql_q_result)){
					foreach($consumables_name_sql_q_result as $key => $consumables_name_val){
						array_push($_consumables_name_arr,$consumables_name_val['item_name']);
					}
				}
				
				$final_consumables_arr =[];
				
				foreach($_consumables_name_arr as $_key => $_value){
					
					$final_consumables123 = $_value;
					array_push($final_consumables_arr,$final_consumables123 );
					$response[] = array(
				        'on_date' => $val['on_date'],
                        'patient_id' => $val['patient_id'],
				        'patient_detail_name' => $val['patient_detail_name'],
						'hospital_id' => $val['hospital_id'],
                        'receipt_number' => $val['receipt_number'],
                        'payment_method' => $val['payment_method'],
                        'final__consumables'=> $final_consumables123,
						'consumables_quantity' => $consumables_quantity_arr[$_key],
						'consumables_total_' => $consumables_stock_arr[$_key],
						'status' => $val['status']
                );
					
				}
				
				$_consumables_name = implode(',', $_consumables_name_arr );
				$final__consumables = implode(",\n", $final_consumables_arr );
			//	echo '<pre>';
			//	print_r($final_consumables_arr);
			//	echo '<pre>';
				//die();
			}
        }      
		return $response;
    }

/*****All Center Stock*****/
	function get_all_center_stocks($employee_number, $start_date, $end_date, $generic_name, $item_name){
		//$investigation_result = array();
		$conditions = '';
		
		if (!empty($employee_number)){
			$conditions .= " and employee_number='$employee_number'";
		}
		
		if (!empty($generic_name)){
			$conditions .= " and generic_name like '%$generic_name%'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and expiry_day between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_day='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_day='$end_date'";
		}
		
	 $investigation_sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		//Select * from ".$this->config->item('db_prefix')."center_stocks ORDER by ID DESC
	}

	function get_all_center_stocks_patination($limit, $page, $employee_number, $start_date, $end_date, $generic_name, $item_name){
		//$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['employee_number']) && !empty($_SESSION['logged_accountant']['employee_number'])){ 
			$conditions = ' and employee_number="'.$_SESSION['logged_accountant']['employee_number'].'"'; 
		}

		if (!empty($employee_number)){
			$conditions .= " and employee_number='$employee_number'";
		}
		if (!empty($generic_name)){
			$conditions .= " and generic_name like '%$generic_name%'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and expiry_day between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_day='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_day='$end_date'";
		}
		
		
	    $investigation_sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where 1".$conditions." order by expiry_day desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	} 
	
		function export_all_center_stocks($employee_number, $start, $end, $generic_name, $item_name){

		$investigation_result = $response = array();
        $conditions = '';
		if(!empty($employee_number)){
			$conditions .= ' and employee_number="'.$employee_number.'"';
        }
        if(!empty($start) && !empty($end)){
            $conditions .= " and expiry_day between '".$start."' AND '".$end."' ";
        }
		 if(!empty($generic_name)){
			$conditions .= ' and generic_name="'.$generic_name.'"';
        }
		 if(!empty($item_name)){
			$conditions .= ' and item_name="'.$item_name.'"';
        }
		
	    $investigation_sql = "Select DISTINCT item_number, company,employee_number, item_name,batch_number,brand_name,vendor_number,generic_name,quantity,safety_stock,order_qty,category from ".$this->config->item('db_prefix')."center_stocks where 1 $conditions order by rand() desc";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				
				$response[] = array(
                        'item_number' => $val['item_number'],
				        'company' => $val['company'],
                        'item_name' => $val['item_name'],
                        'batch_number' => $val['batch_number'],
                        'brand_name' => $val['brand_name'],
                        'vendor_number' => $val['vendor_number'],
                        'generic_name' => $val['generic_name'],
                        'quantity' => $val['quantity'],
						'safety_stock' => $val['safety_stock'],
                        'order_qty' => $val['order_qty'],
                        'category' => $val['category'],
                        'billing_type' => 'Medicine',
                );
            }
        }    
		return $response;
    }
	
	/*****Center Stock*****/
	function get_center_stocks($start_date, $end_date, $generic_name, $item_name){
		//$investigation_result = array();
		$conditions = '';
		
		if (!empty($generic_name)){
			$conditions .= " and generic_name like '%$generic_name%'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and expiry_day between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_day='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_day='$end_date'";
		}
		
	    $investigation_sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		//Select * from ".$this->config->item('db_prefix')."center_stocks ORDER by ID DESC
	}

	function get_center_stocks_patination($limit, $page, $start_date, $end_date, $generic_name, $item_name){
		//$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		
		if (!empty($generic_name)){
			$conditions .= " and generic_name like '%$generic_name%'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and expiry_day between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_day='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_day='$end_date'";
		}
		
		
	    $investigation_sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND 1".$conditions." order by expiry_day desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	} 
	
	function export_center_stocks($start, $end, $generic_name, $item_name){

		$investigation_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' AND billing_at="'.$center.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " AND expiry_day between '".$start."' AND '".$end."' ";
        }
		
	    $investigation_sql = "Select DISTINCT item_number, company, item_name,batch_number,brand_name,vendor_number,generic_name,quantity,safety_stock,order_qty,category from ".$this->config->item('db_prefix')."center_stocks where center_number='".$_SESSION['logged_stock_manager']['center']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' AND 1 $conditions order by rand() desc";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				
				$response[] = array(
                        'item_number' => $val['item_number'],
				        'company' => $val['company'],
                        'item_name' => $val['item_name'],
                        'batch_number' => $val['batch_number'],
                        'brand_name' => $val['brand_name'],
                        'vendor_number' => $val['vendor_number'],
                        'generic_name' => $val['generic_name'],
                        'quantity' => $val['quantity'],
						'safety_stock' => $val['safety_stock'],
                        'order_qty' => $val['order_qty'],
                        'category' => $val['category'],
                        'billing_type' => 'Medicine',
                );
            }
        }    
		return $response;
    }	
	
 /*************Central Stock******************/	
 function get_central_stocks_patination($limit, $page, $start_date, $end_date, $generic_name, $item_name){
		//$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($generic_name)){
			$conditions .= " and generic_name like '%$generic_name%'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and expiry_day between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_day='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_day='$end_date'";
		}
		
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."stocks where 1".$conditions." order by expiry_day desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	} 
	
		function get_central_stocks($start_date, $end_date, $generic_name, $item_name){
		//$investigation_result = array();
		$conditions = '';
		
		if (!empty($generic_name)){
			$conditions .= " and generic_name like '%$generic_name%'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and expiry_day between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_day='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_day='$end_date'";
		}
		
	    $investigation_sql = "Select * from ".$this->config->item('db_prefix')."stocks where 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		//Select * from ".$this->config->item('db_prefix')."center_stocks ORDER by ID DESC
	}
 
 	function export_central_stocks($start, $end, $generic_name, $item_name){

		$investigation_result = $response = array();
        $conditions = '';
		 if(!empty($start) && !empty($end)){
            $conditions .= " and expiry_day between '".$start."' AND '".$end."' ";
        }
		 if(!empty($generic_name)){
			$conditions .= ' and generic_name="'.$generic_name.'"';
        }
		 if(!empty($item_name)){
			$conditions .= ' and item_name="'.$item_name.'"';
        }
		
	    $investigation_sql = "Select DISTINCT item_number, company, item_name,batch_number,brand_name,vendor_number,generic_name,quantity,safety_stock,order_qty,category from ".$this->config->item('db_prefix')."stocks where 1 $conditions order by rand() desc";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				
				$response[] = array(
                        'item_number' => $val['item_number'],
				        'company' => $val['company'],
                        'item_name' => $val['item_name'],
                        'batch_number' => $val['batch_number'],
                        'brand_name' => $val['brand_name'],
                        'vendor_number' => $val['vendor_number'],
                        'generic_name' => $val['generic_name'],
						'quantity' => $val['quantity'],
						'safety_stock' => $val['safety_stock'],
                        'order_qty' => $val['order_qty'],
                        'category' => $val['category'],
                        'billing_type' => 'Medicine',
                );
            }
        }    
		return $response;
    }
	
	
		function export_medicine_data2($start, $end, $employee_number, $type){
		$investigation_result = $response = array();
        $conditions = '';
		if(!empty($employee_number)){
			$conditions .= ' and employee_number="'.$employee_number.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		$investigation_sql = "Select DISTINCT patient_id, patient_detail_name, on_date,data, receipt_number, hospital_id, payment_method,status from ".$this->config->item('db_prefix')."patient_medicine where 1 $conditions";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				$_data = unserialize($val['data']);
				$consumables_name_arr = [];
				$consumables_stock_arr = [];
				$consumables_quantity_arr = [];
				//echo '<pre>';
				//print_r($_data);
                 //die;
				//echo '<br>';
				foreach($_data as $value1){
				//	print_r($value1);
					foreach($value1 as $value2){
						//print_r($value2);
						foreach($value2 as $value3){
							//print_r($value3);
							if($value3['consumables_name']){
								array_push($consumables_name_arr,$value3['consumables_name']);
							}
							array_push($consumables_stock_arr,$value3['consumables_total_']);
							array_push($consumables_quantity_arr,$value3['consumables_quantity']);
						}
					}
				}
				//print_r($consumables_name_arr);
				 $consumables_name = implode(',', $consumables_name_arr );
				 $consumables_total_ = implode(',', $consumables_stock_arr );
				 $consumables_quantity = implode(',', $consumables_quantity_arr );
				if($consumables_name  != ''){
				 $consumables_name_sql = "SELECT item_name FROM hms_stocks WHERE item_number IN (".$consumables_name.") " ;
				}
				//die();
				$_consumables_name_arr = [];
				$consumables_name_sql_q = $this->db->query($consumables_name_sql);
				$consumables_name_sql_q_result = $consumables_name_sql_q->result_array();
				if(!empty($consumables_name_sql_q_result)){
					foreach($consumables_name_sql_q_result as $key => $consumables_name_val){
						array_push($_consumables_name_arr,$consumables_name_val['item_name']);
					}
				}
				
				//$final_consumables_arr =[];
				
				foreach($_consumables_name_arr as $_key => $_value){
					
					$final_consumables123 = $_value;
					array_push($final_consumables123);
					$response[] = array(
				        'on_date' => $val['on_date'],
                        'patient_id' => $val['patient_id'],
				        'patient_detail_name' => $val['patient_detail_name'],
						'hospital_id' => $val['hospital_id'],
                        'receipt_number' => $val['receipt_number'],
                        'payment_method' => $val['payment_method'],
                        'final__consumables'=> $final_consumables123,
						'consumables_quantity' => $consumables_quantity_arr[$_key],
						'consumables_total_' => $consumables_stock_arr[$_key]
                );
					
				}
				
			//	$_consumables_name = implode(',', $_consumables_name_arr );
			//	$final__consumables = implode(",\n", $final_consumables_arr );
			//	echo '<pre>';
			//	print_r($final_consumables_arr);
			//	echo '<pre>';
				//die();
			}
        }      
		return $response;
    }
	
		function patient_medicine_count($employee_number, $start_date, $end_date, $patient_id, $patient_detail_name){
		//$investigation_result = array();
		$conditions = '';
		
		if (!empty($employee_number)){
			$conditions .= " and employee_number='$employee_number'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($patient_detail_name)){
			$conditions .= " and patient_detail_name='$patient_detail_name'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}

	    $medicine_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where 1 ".$conditions."";
		$q = $this->db->query($medicine_sql);
		return $q->num_rows();
		
	}
	
		function patient_medicine_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $consumables_name){
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
        if (!empty($center)){
			$conditions .= " and employee_number='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($consumables_name)){
			$conditions .= " and consumables_name='$consumables_name'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	}
	
	function get_generic(){
		$result = array();
		$sql_condition = '';
	    $sql = "Select * from ".$this->config->item('db_prefix')."stocks";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_generic_data($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks where ID='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}
	
	public function update_generic_data($data, $item)
    {	
        $sql = "UPDATE " . config_item('db_prefix') . "stocks SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$item."'";
        $this->db->query($sql);
        return 1;
    }
	
	/**************	All Consuption **************/
	function patient_consuption_list_patination($limit, $page, $employee_number, $start_date, $end_date, $patient_id,$medicine_serial=null){
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($employee_number)){
			$conditions .= " and employee_number='$employee_number'";
		}
		if (!empty($medicine_serial)){
			$conditions .= " and data like '%$medicine_serial%'";
		}
		
		//print_r($center_number);
		//die;
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and add_on between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and add_on ='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and add_on ='$end_date'";
		}
	    $consuption_sql = "Select * from ".$this->config->item('db_prefix')."patient_items where 1".$conditions." order by add_on desc limit ". $limit." OFFSET ".$offset."";
		//var_dump($consuption_sql);
		//die;
		$consuption_q = $this->db->query($consuption_sql);
		$consuption_result = $consuption_q->result_array();
		return $consuption_result;
	}
	
	function patient_consuption_medicine_count($employee_number, $start_date, $end_date, $patient_id,$medicine_serial=null){
		$conditions = '';
		if (!empty($employee_number)){
			$conditions .= " and employee_number='$employee_number'";
		}
		if (!empty($medicine_serial)){
			$conditions .= " and data like '%$medicine_serial%'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and add_on between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and add_on ='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and add_on ='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_items where 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
	}
	
	function get_centers(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."centers where status='1' ORDER by ID DESC";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	
	function get_center_name($center){
		$result = array();
		$sql = "Select center_name from ".$this->config->item('db_prefix')."centers where center_number='".$center."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['center_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_employee_name($employee_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."employees where employee_number='".$employee_number."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return $result;
        }
	}
	
	
	/***************Medicine Stock Account panel***************/
	
	function export_investigation_data($start, $end, $center, $type){

		$investigation_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		
	    $investigation_sql = "Select DISTINCT patient_id, receipt_number, totalpackage, fees as discounted_package,payment_done,remaining_amount,investigations,payment_method,billing_from,billing_at,on_date as date,status from ".$this->config->item('db_prefix')."patient_medicine where 1 $conditions order by on_date desc";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				
				$hms_procedures_result = unserialize( $val['investigations']);
				$investigation_nameArr = [];
				foreach ($hms_procedures_result as $v2_data123){
						foreach ($v2_data123 as $v2_data5){

						    $sql12 = "select investigation from hms_investigation where code='".$v2_data5['female_investigation_code']."'"; 
                            $query12 = $this->db->query($sql12);
                            $select_result1 = $query12->result(); 
							
							//print_r($select_result1);
							//echo select_result1['investigation'];
							
							foreach ($select_result1 as $res_val){
								// echo $res_val->investigation;
								 array_push($investigation_nameArr,$res_val->investigation);
							}
						}
						
				}
				//die;
					 
				$investigation_name1 = implode(',',$investigation_nameArr); 
				
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'receipt_number' => $val['receipt_number'],
						 'totalpackage' => $val['totalpackage'],
                        'discounted_package' => $val['discounted_package'],
                        'payment_done' => $val['payment_done'],
                        'remaining_amount' => $val['remaining_amount'],
                        'payment_method' => $val['payment_method'],
                        'billing_from' => $val['billing_from'],
                        'billing_at' => $val['billing_at'],
						'investigation' => $investigation_name1,
                        'date' => $val['date'],
                        'status' => $val['status'],
                        'billing_type' => 'Investigation',
                );
            }
        }    
		return $response;
    }

	function patient_investigation_count($center, $start_date, $end_date, $patient_id){
		$investigation_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}

		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		
	}
	
		function patient_investigation_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id){
		$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	}

    function get_patient_name_2($patient_id){
		
		$result = array();
		$sql = "Select wife_name from ".$this->config->item('db_prefix')."patients where patient_id='".$patient_id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['wife_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function return_center_item_data($data){
	echo $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "return_stocks` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}		
		$sql .= implode(',' , $sqlArr);		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function get_return_order(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."return_stocks";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function add_item_data($employee_number, $item){
		$result = array();
		$sql_condition = '';
		echo $sql = "Select * from ".$this->config->item('db_prefix')."return_stocks where item_number='".$item."'";
        //echo $sql = "Select item_number,employee_number, item_name,quantity,batch_number from ".$this->config->item('db_prefix')."return_stocks where item_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}
	
	function update_order_data($item_number, $item, $quantity, $return_date,$item_id){
		echo $sql = "UPDATE ".$this->config->item('db_prefix')."stocks SET `status` = '1', quantity ='$quantity', `update_date`='".date("Y-m-d H:i:s")."', delivery_date='".$delivery_date."' where ID='".$item_id."'";
        $this->db->query($sql);
		
	echo $sql = "UPDATE `".$this->config->item('db_prefix')."center_stocks` SET `quantity` = `quantity`-".$quantity." WHERE `item_number`='".$item."'";
       // var_dump($qty);die;
		$this->db->query($sql);
		return 1;
		
    }	
}
