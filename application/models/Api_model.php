<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');
class Api_model extends CI_Model
{
    function get_list_doctors(){
		$result = array();
		$sql_condition = '';
		$sql = "Select username as doctor_id, center_id as centre, name, email from ".$this->config->item('db_prefix')."doctors where status='1' ORDER by ID DESC";
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
	
	function get_list_centres(){
		$result = array();
		$sql_condition = '';
		$sql = "Select center_number as center_id, center_name as name from ".$this->config->item('db_prefix')."centers where status='1' ORDER by ID DESC";
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
	
	function appointment_status_crm_id($crm_id, $wife_phone){
		$sql = "UPDATE `".config_item('db_prefix')."appointments` SET `crm_id`='$crm_id' WHERE wife_phone='$wife_phone'";
        $this->db->query($sql);
        return $this->db->affected_rows();
	}
	
	
	function crm_lead($lead_data) {
		if (!isset($lead_data['lead_id'])) return false;
		
		$table = config_item('db_prefix') . 'leads';
		
		// Check if lead exists
		$this->db->where('lead_id', $lead_data['lead_id']);
		$query = $this->db->get($table, 1);
		
		if ($query->num_rows() > 0) {
			// Update existing
			$this->db->where('lead_id', $lead_data['lead_id']);
			$this->db->update($table, $lead_data);
		} else {
			// Insert new
			$this->db->insert($table, $lead_data);
		}
		
		return $this->db->affected_rows();
	}

}



// END Stock_model class

/* End of file Stock_model.php */

/* Location: ./application/models/Stock_model.php */