<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Investigation_model extends CI_Model
{
	function get_investigation(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."investigation ORDER by ID DESC";
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
	
	function get_investigations_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."investigation where status='1' ORDER by ID DESC";
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
	
	function get_master_investigations_list(){
		$result = array();
		$sql_condition = '';
		//$sql = "Select * from ".$this->config->item('db_prefix')."master_investigations where status='1' ORDER by ID DESC";
		$sql = "SELECT inv.investigation,inv.code AS code,master.code AS master_code,inv.price,inv.center_id,inv.master_id,master.investigation_name FROM hms_investigation AS inv JOIN hms_master_investigations AS master ON inv.master_id = master.id WHERE master.id";
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
	
	function get_master_investigation(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."master_investigations where status='1' ORDER by ID DESC";
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
	
	function add_master_investigation($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "master_investigations` SET ";
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
	
	public function update_master_investigation_data($data, $item)
    {	
        $sql = "UPDATE " . config_item('db_prefix') . "master_investigations SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$item."'";
        $this->db->query($sql);
        return 1;
    }
	
	function get_master_investigation_data($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."master_investigations where ID='".$item."'";
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
	
	function add_investigation($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "investigation` SET ";
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
	
	function get_investigation_data($item){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."investigation where ID='".$item."'";
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
	
	public function update_investigation_data($data, $item)
    {	
        $sql = "UPDATE " . config_item('db_prefix') . "investigation SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$item."'";
        $this->db->query($sql);
        return 1;
    }
	
	public function delete_investigation_data($item){
		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "investigation WHERE ID = '".$item."'";
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return 1;
		}
		else
			return 0;	
	}
	
	function investigation_price($id, $nationality){
		$condition = '';
		if($nationality == 'indian'){
			$condition = 'price as price';
		}else{
			$condition = 'usd_price as price';
		}
		$sql = "Select code, ".$condition." from ".$this->config->item('db_prefix')."investigation where ID='".$id."'";
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

	//Investigation Dashboard
	/*function investigation_lists(){
		$result = array();
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations order by ID desc";
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
	}*/

	function patient_investigation($patient_id, $receipt_number){
		$result = array();
		$sql = "Select patient_id, investigations from ".$this->config->item('db_prefix')."patient_investigations where patient_id='".$patient_id."' and receipt_number='".$receipt_number."'";
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
	
	function report_insert($data){
		foreach( $data as $key=> $value )
		{
			$sql = "";
			$report = check_investigation_report($value['investigation_id'], $value['gender'], $value['receipt_number'], $value['patient_id']);
			if($report == 0){
				$sqlArr = array();
				$sql = "INSERT INTO `".$this->config->item('db_prefix')."patient_investigation_reports` SET ";
				foreach($value as $ky => $vls){
					$sqlArr[] = " $ky = '".addslashes($vls)."'";
				}
				$sql .= implode(',' , $sqlArr);
				$res =  $this->db->query($sql);
			}else{
				$sql = "UPDATE `".$this->config->item('db_prefix')."patient_investigation_reports` SET `report`='".$value['report']."',`status`='uploaded',`uploaded_date`='".date("Y-m-d H:i:s")."',`doctor_accepted`='pending',`status_reason`='' WHERE ID='".$report['ID']."'";
				$this->db->query($sql);
				$res = $this->db->affected_rows();
			}
		}
		if ($res)
		{
			return 1;
		}
		else
			return 0;
	}

	function check_investigation_report($investigation, $patient_id, $receipt_number, $gender){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_investigation_reports where patient_id='".$patient_id."' and receipt_number='".$receipt_number."' and investigation_id='".$investigation."' and gender='".$gender."'";
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
	
	/************Investigation List*********/
	
	function investigation_count($patient_id, $patientName){
		$admission_result = array();
		$conditions = '';
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($patientName)){
			$conditions .= " and patientName like'%$patientName%' ";
		}
		$investigation_r_sql = "Select * from ".$this->config->item('db_prefix')."lab_reports where 1 ".$conditions."";
		$q = $this->db->query($investigation_r_sql);
		return $q->num_rows();
	}
	
	function investigation_patination($limit, $page, $patient_id, $patientName){
		$admission_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($patientName)){
			$conditions .= " and patientName like'%$patientName%' ";
		}
		$investigation_r_sql = "Select * from ".$this->config->item('db_prefix')."lab_reports where 1".$conditions." order by ID desc limit ". $limit." OFFSET ".$offset."";
		$investigation_r_q = $this->db->query($investigation_r_sql);
		$admission_result = $investigation_r_q->result_array();
		return $admission_result;
	}
	
	function get_investigation_vendor(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."investigation_vendor where status='1' ORDER by ID DESC";
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
	/********End Investigation List********/
	
}
// END investigation_model class