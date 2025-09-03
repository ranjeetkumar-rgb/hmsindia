<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Order_Model extends CI_Model{
	
	function get_order_data()
	{
		$result = array();
		 $sql = "Select * from ".$this->config->item('db_prefix')."center_orders where center_number!='0' ORDER by ID DESC";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return $result;
		}  
		else {
			return $result;
		}
	}
	
	function get_my_purchase_orders_data($purchase_order, $start_date, $end_date, $item_name){
		$orders_result = array();
		$conditions = '';
		if (!empty($purchase_order)){
			$conditions .= " and purchase_order='$purchase_order'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and create_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date='$end_date'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'"; 
		}
        $consultation_sql = "Select * from ".$this->config->item('db_prefix')."orders where 1 ".$conditions."";
		$q = $this->db->query($consultation_sql);
		return $q->num_rows();
		
	}
	
function get_my_orders_count($limit, $page, $purchase_order, $start_date, $end_date, $item_name){
		$orders_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($purchase_order)){
			$conditions .= " and purchase_order='$purchase_order'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and create_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date='$end_date'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'"; 
		}
	    $consultation_sql = "Select * from ".$this->config->item('db_prefix')."orders where 1".$conditions." order by ID desc limit ". $limit." OFFSET ".$offset."";
		$consultation_q = $this->db->query($consultation_sql);
		$orders_result = $consultation_q->result_array();
		return $orders_result;
}


function get_purchase_orders_data($purchase_order, $start_date, $end_date){
		$orders_result = array();
		$conditions = '';
		if (!empty($purchase_order)){
			$conditions .= " and purchase_order='$purchase_order'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and create_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date='$end_date'";
		}
        $consultation_sql = "Select * from ".$this->config->item('db_prefix')."vendor_billing where 1 ".$conditions."";
		$q = $this->db->query($consultation_sql);
		return $q->num_rows();
		
	}
	
function get_purchase_orders_count($limit, $page, $purchase_order, $start_date, $end_date){
		$orders_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($purchase_order)){
			$conditions .= " and purchase_order='$purchase_order'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and create_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and create_date='$end_date'";
		}
	    $consultation_sql = "Select * from ".$this->config->item('db_prefix')."vendor_billing where 1".$conditions." order by ID desc limit ". $limit." OFFSET ".$offset."";
		$consultation_q = $this->db->query($consultation_sql);
		$orders_result = $consultation_q->result_array();
		return $orders_result;
}	
	/*function get_my_orders_data()
	{
		$result = array();
		 $sql = "Select * from ".$this->config->item('db_prefix')."orders ORDER by ID DESC";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return $result;
		}  
		else {
			return $result;
		}
	}*/
	
		function get_my_orders_data($purchase_order, $po_number, $vendor_number, $start_date, $end_date, $item_name, $ship_to){
		$data = array();
		$conditions = '';
		if (!empty($purchase_order)){
			$conditions .= " and purchase_order='$purchase_order'";
		}
		if (!empty($po_number)){
			$conditions .= " and po_number='$po_number'";
		}
		if (!empty($vendor_number)){
			$conditions .= " and vendor_number='$vendor_number'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and order_place between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and order_place='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and order_place='$end_date'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'"; 
		}
		if (!empty($ship_to)){
			$conditions .= " and ship_to like '%$ship_to%'"; 
		}
        $consultation_sql = "Select * from ".$this->config->item('db_prefix')."orders where 1 ".$conditions."";
		$q = $this->db->query($consultation_sql);
		return $q->num_rows();
		
	}
	
function get_my_orders_data_count($limit, $page, $purchase_order, $po_number, $vendor_number, $start_date, $end_date, $item_name,$ship_to){
		$data = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($purchase_order)){
			$conditions .= " and purchase_order='$purchase_order'";
		}
		if (!empty($po_number)){
			$conditions .= " and po_number='$po_number'";
		}
		if (!empty($vendor_number)){
			$conditions .= " and vendor_number='$vendor_number'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and order_place between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and order_place='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and order_place='$end_date'";
		}
		if (!empty($item_name)){
			$conditions .= " and item_name like '%$item_name%'"; 
		}
		if (!empty($ship_to)){
			$conditions .= " and ship_to like '%$ship_to%'"; 
		}
	    $consultation_sql = "Select * from ".$this->config->item('db_prefix')."orders where 1".$conditions." order by ID desc limit ". $limit." OFFSET ".$offset."";
		$consultation_q = $this->db->query($consultation_sql);
		$data = $consultation_q->result_array();
		return $data;
}
	
	// SAGAR
	function change_order_status($data, $id)
	{
		 $sql = "UPDATE " . config_item('db_prefix') . "orders SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE product_id = '".$id."'";
        if($this->db->query($sql)){
        	return true;
        }
        else{
        	return false;
        }
	}	
	
	/*** Center Orders *****/
	
	function all_procedure_dispencing()
	{
		$result = array();
		$sql_connection = '';
		 $sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if($result)
		{
			return $result;
		} 
		else
		{
			return $result;
		}
	}
	
	function ajax_inventory_month_dispense($month)
	{
		$response = array();
		$procedure_html = $investigations_html = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where  MONTH(on_date) = '".$month."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if($result)
		{	$no = 1;
			foreach($result as $key => $vl){
				//var_dump(get_patient_detail($vl['patient_id']));die;
				$patient_data = get_patient_detail($vl['patient_id']);
				$procedure_html .= '<tr class="odd gradeX">
							  <td>'.$no++.'</td>
							  <td>'.$vl['patient_id'].'</td>
							  <td>'.$patient_data['wife_name'].'</td>
							  <td>'.$vl['receipt_number'].'</td>
							  <td>'.$vl['on_date'].'</td>
							  <td>'.$vl['transaction_id'].'</td>
							  <td>'.$vl['fees'].'</td>
							  <td>'.$vl['payment_done'].'</td>
							  <td>'.$vl['remaining_amount'].'</td>
							  <td>'.$vl['payment_method'].'</td><td>';
				if($vl['billing_from'] == 'IndiaIVF'){ $procedure_html .= $vl["billing_from"]; }
				else {$procedure_html .=  $this->get_center_name($vl['billing_from']);}
				$procedure_html .='</td>';
				$procedure_html .= '<td>'.$this->get_center_name($vl['billing_at']).'</td><td><a href="'.base_url("orders/get_all_procedure_detail/".$vl['receipt_number']).'" class="btn btn-primary">Detail</a></td></tr>';
			}
		}
		$x_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where  MONTH(on_date) = '".$month."'";
		$x_q = $this->db->query($x_sql);
		$x_result = $x_q->result_array();
		if($x_result)
		{	$no = 1;
			foreach($x_result as $key => $vl){
				$patient_data = get_patient_detail($vl['patient_id']);
				$investigations_html .= '<tr class="odd gradeX">
							  <td>'.$no++.'</td>
							  <td>'.$vl['patient_id'].'</td>
							  <td>'.$patient_data['wife_name'].'</td>
							  <td>'.$vl['receipt_number'].'</td>
							  <td>'.$vl['on_date'].'</td>
							  <td>'.$vl['transaction_id'].'</td>
							  <td>'.$vl['fees'].'</td>
							  <td>'.$vl['payment_done'].'</td>
							  <td>'.$vl['remaining_amount'].'</td>
							  <td>'.$vl['payment_method'].'</td><td>';
				if($vl['billing_from'] == 'IndiaIVF'){ $investigations_html .= $vl["billing_from"]; }
				else {$investigations_html .=  $this->get_center_name($vl['billing_from']);}
				$investigations_html .='</td>';
				$investigations_html .= '<td>'.$this->get_center_name($vl['billing_at']).'</td><td><a href="'.base_url("orders/get_all_investigation_detail/".$vl['receipt_number']).'" class="btn btn-primary">Detail</a></td></tr>';
			}	
		}
		$response = array('procedure_html'=>$procedure_html, 'investigations_html'=>$investigations_html);
		return $response;
	}
	
	function ajax_inventory_custom_dispense($start, $end)
	{
		$response = array();
		$procedure_html = $investigations_html = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where on_date between '".$start."' AND '".$end."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if($result)
		{	$no = 1;
			foreach($result as $key => $vl){
				//var_dump($val);die;
				$patient_data = get_patient_detail($vl['patient_id']);
				$procedure_html .= '<tr class="odd gradeX">
							  <td>'.$no++.'</td>
							  <td>'.$vl['patient_id'].'</td>
							  <td>'.$patient_data['wife_name'].'</td>
							  <td>'.$vl['receipt_number'].'</td>
							  <td>'.$vl['on_date'].'</td>
							  <td>'.$vl['transaction_id'].'</td>
							  <td>'.$vl['fees'].'</td>
							  <td>'.$vl['payment_done'].'</td>
							  <td>'.$vl['remaining_amount'].'</td>
							  <td>'.$vl['payment_method'].'</td><td>';
				if($vl['billing_from'] == 'IndiaIVF'){ $procedure_html .= $vl["billing_from"]; }
				else {$procedure_html .=  $this->get_center_name($vl['billing_from']);}
				$procedure_html .='</td>';
				$procedure_html .= '<td>'.$this->get_center_name($vl['billing_at']).'</td><td><a href="'.base_url("orders/get_all_procedure_detail/".$vl['receipt_number']).'" class="btn btn-primary">Detail</a></td></tr>';
			}
		}
		$x_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where on_date between '".$start."' AND '".$end."'";
		$x_q = $this->db->query($x_sql);
		$x_result = $x_q->result_array();
		if($x_result)
		{	$no = 1;
			foreach($x_result as $key => $vl){
				$patient_data = get_patient_detail($vl['patient_id']);
				$investigations_html .= '<tr class="odd gradeX">
							  <td>'.$no++.'</td>
							  <td>'.$vl['patient_id'].'</td>
							  <td>'.$patient_data['wife_name'].'</td>
							  <td>'.$vl['receipt_number'].'</td>
							  <td>'.$vl['on_date'].'</td>
							  <td>'.$vl['transaction_id'].'</td>
							  <td>'.$vl['fees'].'</td>
							  <td>'.$vl['payment_done'].'</td>
							  <td>'.$vl['remaining_amount'].'</td>
							  <td>'.$vl['payment_method'].'</td><td>';
				if($vl['billing_from'] == 'IndiaIVF'){ $investigations_html .= $vl["billing_from"]; }
				else {$investigations_html .=  $this->get_center_name($vl['billing_from']);}
				$investigations_html .='</td>';
				$investigations_html .= '<td>'.$this->get_center_name($vl['billing_at']).'</td><td><a href="'.base_url("orders/get_all_investigation_detail/".$vl['receipt_number']).'" class="btn btn-primary">Detail</a></td></tr>';
			}	
		}
		$response = array('procedure_html'=>$procedure_html, 'investigations_html'=>$investigations_html);
		return $response;
	}

	function all_investigation_dispencings()
	{
		$result = array();
		$sql_connection = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if($result)
		{
			return $result;
		}
		else
		{
			return $result;
		}
	}
	
	function get_product_detail($product_id){
		$result = array();
		$sql_connection = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."stocks WHERE item_number = '".$product_id."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return $result;
		}
		else{
			return $result;
		}	
	}
	function get_investigation_detail($investigation_id)
	{
		$result = array();
		$sql_connection = '';
		$sql = "Select * from " .$this->config->item('db_prefix')."investigation WHERE ID = '".$investigation_id."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return $result;
		}
		else{
			return $result;
		}
	}

	function get_procedure_by_receipt($receipt_number)
	{
		$result = array();
		$sql_connection = '';
		$sql = "Select * from " . $this->config->item('db_prefix')."patient_procedure WHERE receipt_number = '".$receipt_number."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return $result;
		}
	}

	function get_investigation_by_reciept($receipt_number)
	{
		$result = array();
		$sql = "Select * from ". $this->config->item('db_prefix')."patient_investigations WHERE receipt_number = '".$receipt_number."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return $result;
		}
	}
	
	function get_investigation_name($investig){
		
		$result = array();
		$sql = "Select investigation from ".$this->config->item('db_prefix')."investigation where ID='".$investig."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['investigation'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_procedure_name($id){
		$result = array();
		$sql = "Select procedure_name from ".$this->config->item('db_prefix')."procedures where ID='".$id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['procedure_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_order($center_id){
		$result = array();
		$sql_condition = '';
		if($_SESSION['logged_stock_manager']['employee_number']){
		 $sql = "Select * from ".$this->config->item('db_prefix')."center_orders where center_number='".$center_id."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."'";
	    }else{
		 $sql = "Select * from ".$this->config->item('db_prefix')."center_orders where center_number='".$center_id."' AND employee_number='".$_SESSION['logged_billing_manager']['employee_number']."'";
	    }
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
	
	function get_center_item_order($center, $employee_number, $ID, $item_id){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."center_orders where employee_number='".$employee_number."' AND and item_number='".$item_id."'";
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
	
	function check_center_item($center_id, $item){
		$result = array();
		$sql_condition = '';
		if($_SESSION['logged_stock_manager']['employee_number']){
	    $sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where center_number='".$center_id."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."' and item_number='".$item."'";
        }else{
		$sql = "Select * from ".$this->config->item('db_prefix')."center_stocks where center_number='".$center_id."' AND employee_number='".$_SESSION['logged_billing_manager']['employee_number']."' and item_number='".$item."'";
        }	
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
	
	function get_billing_data($patient){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_items where patient_id='".$patient."'";// echo $sql;die;
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
	
	public function update_order_item_data($data, $ID ,$employee_number)
    {
		$order_qty = $data['order_qty'];unset($data['order_qty']);
	    $sql = "UPDATE `".$this->config->item('db_prefix')."center_stocks` SET `quantity` = `quantity`+".$order_qty.",`company`='".$data['company']."',`item_name`='".$data['item_name']."',`brand_name`='".$data['brand_name']."',`vendor_number`='".$data['vendor_number']."',`price`='".$data['price']."',`expiry`='".$data['expiry']."',`expiry_day`='".$data['expiry_day']."' WHERE `ID`='".$ID."' AND employee_number ='".$employee_number."' ";
        $this->db->query($sql);
		//var_dump($data);die;
        return 1;
    }
	
	public function update_order_status($order_id)
    {
	 $sql = "UPDATE `".$this->config->item('db_prefix')."center_orders` SET `status`='1' WHERE `ID`='".$order_id."'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0)
		{
		  return true;
		}else
		{
		  return false;
		}
    }
	
	function approve_purchase_order($order_number){
		$sql = "UPDATE `".$this->config->item('db_prefix')."orders` SET `purchase_order`='1' WHERE `order_number`='".$order_number."'";
        $this->db->query($sql);
        return 1;
	}
	
	function disapprove_purchase_order($order_number){
		$sql = "UPDATE `".$this->config->item('db_prefix')."orders` SET `purchase_order`='2' WHERE `order_number`='".$order_number."'";
        $this->db->query($sql);
        return 1;
	}
	
	function order_place_date($order_number){
		$sql = "UPDATE `".$this->config->item('db_prefix')."orders` SET `order_place`='".date("Y-m-d")."' WHERE `order_number`='".$order_number."'";
        $this->db->query($sql);
        return 1;
	}
	
	function insert_center_order_item($data){
		 $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "center_stocks` SET ";
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
	
	/*** Center Orders *****/
	
	function get_admin_item_data($item){
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
	
	public function update_admin_order_item_data($data)
    {	
		$item = $data['item_number'];
		$order_qty = $data['order_qty'];unset($data['order_qty']);
	 $sql = "UPDATE `".$this->config->item('db_prefix')."stocks` SET `quantity` = `quantity`+".$order_qty.",`item_name`='".$data['item_name']."',`company`='".$data['company']."',`vendor_number`='".$data['vendor_number']."',`brand_name`='".$data['brand_name']."',`price`='".$data['price']."',`vendor_price`='".$data['vendor_price']."',`expiry`='".$data['expiry']."',`expiry_day`='".$data['expiry_day']."',`batch_number`='".$data['batch_number']."' WHERE `item_number`='".$item."'";
        $this->db->query($sql);
        return 1;
    }
	
	function insert_admin_order_item_data($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "stocks` SET ";
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
	
	function insert_vendor_billing($data){
		echo $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "vendor_billing` SET ";
		//die();
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
	
	function insert_replaced_order_item($centeral_order, $data, $item_id, $center_order){
	 $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "center_orders` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}
		$sql .= implode(',' , $sqlArr);
       	$res =  $this->db->query($sql);

		if ($res)
		{
			$sql = "";
		 $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "orders` SET ";
			$sqlArr = array();
			foreach( $centeral_order as $key=> $value )
			{
				$sqlArr[] = " $key = '".addslashes($value)."'"	;
			}
			$sql .= implode(',' , $sqlArr);
			$res =  $this->db->query($sql);
			
			$insert_id = $this->db->insert_id();
		 $sql = "UPDATE `".$this->config->item('db_prefix')."center_orders` SET `cancelled`='1',replaced='1' WHERE `item_number`='".$item_id."' AND status='0'";
	        $this->db->query($sql);
			return $insert_id;
		}
		else
			return 0;
	}
	
	public function update_admin_order_status($order_id, $action_type)
    {
		$replaced = "";
	if($action_type == "insert"){ $replaced = "`status`='1', received='1', replaced='1'"; }else {$replaced = "`status`='1', received='1'";}
	 $sql = "UPDATE `".$this->config->item('db_prefix')."orders` SET ".$replaced." WHERE `ID`='".$order_id."'";
        $this->db->query($sql);
        return 1;
    }
	
	function get_item_name($item_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select item_name from ".$this->config->item('db_prefix')."stocks where item_number='".$item_number."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['item_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_a_item_name($item_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select item_name from ".$this->config->item('db_prefix')."stocks where item_number='".$item_number."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['item_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_name($center_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select center_name from ".$this->config->item('db_prefix')."centers where center_number='".$center_number."'";
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
	
	function my_order_details($po_number){
		$result = array();
		$sql = "Select * from ".$this->config->item('db_prefix')."orders where order_number='".$order_number."' AND replaced='0'";
		//$sql = "Select * from ".$this->config->item('db_prefix')."orders where po_number='".$po_number."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
//		var_dump($result);die;
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}
			
	function update_order_data($order_id, $item, $qty, $delivery_date){
	  $sql = "UPDATE ".$this->config->item('db_prefix')."center_orders SET `d_status` = '1', order_quantity ='$qty', `update_date`='".date("Y-m-d H:i:s")."', delivery_date='".$delivery_date."' where ID='".$order_id."'";
        $this->db->query($sql);
		
	  $sql = "UPDATE `".$this->config->item('db_prefix')."stocks` SET `quantity` = `quantity`-".$qty.", order_qty ='$qty' WHERE `item_number`='".$item."'";
       // var_dump($qty);die;
		$this->db->query($sql);
		return 1;
		
	}
		
	function csm_stock_status($item,$order_units){
		$result = array();
		$sql_condition = '';
		$sql = "Select quantity, safety_stock from ".$this->config->item('db_prefix')."stocks where item_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		if($result[0]['quantity'] < $order_units){
			return 0;
		}else{
			if($result[0]['quantity'] < $result[0]['safety_stock']){
				return 0;
			}else{
				return 1;
			}
		}
	}
	function csm_purchase_status($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select count(*) as count from ".$this->config->item('db_prefix')."orders where item_number='".$item."' and status='0'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		if(!empty($result)){
			return $result[0]['count'];
		}else{
			return 1;
		}
	}
	
	// Purchase order
	function add_purchase_order($data){ 
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "orders` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}		
		$sql .= implode(',' , $sqlArr);
		//echo $sql;die;	
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return 1;
			die;
		}
		else{
			return 0;
			die;
		}
	}
	
	function get_purchase_item_data($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."orders where ID='".$item."'";
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
	
	function get_vendor_name($vendor){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."vendors where vendor_number='".$vendor."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return $vendor;
        }
	}

	function get_brand_name($brand){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."brands where brand_number='".$brand."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return $brand;
        }
	}
	
	function get_center_order_number($item){
		$result = array();
		$sql_condition = '';
		 $sql = "Select * from ".$this->config->item('db_prefix')."center_orders where item_number='".$item."' AND status='0'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $brand;
        }
	}
	
	function get_order_number($order_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."orders where order_number='".$order_number."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $brand;
        }
	}
	
	function add_item_data($item){
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
	
	function get_item_delivery_date($item){
		$result = array();
		$sql_condition = '';
		 $sql = "Select item_number from ".$this->config->item('db_prefix')."center_orders where item_number='".$item."' AND d_status='1' AND status='0' AND replaced='0'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
			$item_number = $result[0]['item_number'];
			$x_sql = "Select delivery_date from ".$this->config->item('db_prefix')."orders where item_number='".$item_number."' AND status='1' AND received='1' AND replaced='0'";
			$x_q = $this->db->query($x_sql);
			$x_result = $x_q->result_array();
            return $x_result[0]['delivery_date'];
        }
        else
        {
            return '';
        }
	}
	
	function vendor_orders($vendor_number){
		$result = array();
		$sql_condition = "";
		if($vendor_number != ""){
			$sql_condition = " where vendor_number ='".$vendor_number."'";
		}
		$sql = "Select * from ".$this->config->item('db_prefix')."orders ".$sql_condition;
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
	
	function get_vendor_billing($order_number){
		$sql = "Select vendor_billing, upload_date from ".$this->config->item('db_prefix')."vendor_billing where order_number='$order_number'";
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
	
	function update_purchase_item($order_number, $order_quantity, $company, $vendor_number, $brand_name, $mrp, $hsn_code, $pack, $gstrate ,$vendor_price, $ship_to, $bill_to){
	    $sql = "UPDATE ".$this->config->item('db_prefix')."orders SET `order_quantity` = '$order_quantity', `company` = '$company', `vendor_number` = '$vendor_number', `brand_name` = '$brand_name', `mrp` = '$mrp', `hsn_code` = '$hsn_code', `pack` = '$pack',`gstrate` = '$gstrate',`vendor_price` = '$vendor_price',`ship_to` = '$ship_to',`bill_to` = '$bill_to', status ='0', `update_date`='".date("Y-m-d H:i:s")."', purchase_order='0' where order_number='".$order_number."'";
        $this->db->query($sql);
		return 1;
		
	}
}
?>