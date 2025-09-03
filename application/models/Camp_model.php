<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Camp_model extends CI_Model
{
	function get_camps(){
		$result = array();
		$sql = "SELECT c.*, cen.center_name FROM ".$this->config->item('db_prefix')."camps c 
				LEFT JOIN ".$this->config->item('db_prefix')."centers cen ON c.center_id = cen.ID 
				ORDER BY c.ID DESC";
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
	
	function get_camps_by_status($status = '1'){
		$result = array();
		$sql = "SELECT c.*, cen.center_name FROM ".$this->config->item('db_prefix')."camps c 
				LEFT JOIN ".$this->config->item('db_prefix')."centers cen ON c.center_id = cen.ID 
				WHERE c.status=? ORDER BY c.ID DESC";
        $q = $this->db->query($sql, array($status));
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
	
	function add_camp($data){
		try {
			// Log the incoming data
			log_message('debug', 'Camp_model::add_camp called with data: ' . print_r($data, true));
			
			// Prepare the SQL with proper escaping
			$table_name = $this->config->item('db_prefix') . 'camps';
			
			// Check if table exists
			$table_exists = $this->db->table_exists($table_name);
			if (!$table_exists) {
				log_message('error', 'Table ' . $table_name . ' does not exist');
				return 0;
			}
			
			// Get table structure to validate fields
			$fields = $this->db->list_fields($table_name);
			log_message('debug', 'Available fields in ' . $table_name . ': ' . print_r($fields, true));
			
			// Filter data to only include valid table fields
			$filtered_data = array();
			foreach ($data as $key => $value) {
				// Skip ID field completely to avoid primary key conflicts
				if ($key === 'ID' || $key === 'id') {
					log_message('debug', 'Skipping ID field: ' . $key);
					continue;
				}
				
				if (in_array($key, $fields)) {
					$filtered_data[$key] = $value;
				} else {
					log_message('warning', 'Field ' . $key . ' not found in table ' . $table_name);
				}
			}
			
			// Add required fields
			$filtered_data['add_date'] = date("Y-m-d H:i:s");
			$filtered_data['camp_number'] = getGUID();
			
			// Ensure status is set
			if (!isset($filtered_data['status'])) {
				$filtered_data['status'] = '1';
			}
			
			// Ensure all required fields have values
			$required_fields = ['camp_name', 'center_id'];
			foreach ($required_fields as $field) {
				if (!isset($filtered_data[$field]) || empty($filtered_data[$field])) {
					log_message('error', 'Required field missing or empty: ' . $field);
					return 0;
				}
			}
			
			// Log the filtered data
			log_message('debug', 'Filtered data for insert: ' . print_r($filtered_data, true));
			
			// Use CodeIgniter's insert method for better security
			$result = $this->db->insert($table_name, $filtered_data);
			
			if ($result) {
				$insert_id = $this->db->insert_id();
				log_message('info', 'Camp added successfully with ID: ' . $insert_id);
				return $insert_id;
			} else {
				$error = $this->db->error();
				log_message('error', 'Database insert failed: ' . print_r($error, true));
				return 0;
			}
			
		} catch (Exception $e) {
			log_message('error', 'Exception in add_camp: ' . $e->getMessage());
			log_message('error', 'Exception trace: ' . $e->getTraceAsString());
			return 0;
		}
	}
	
	function get_camp_data($camp_number){
		$result = array();
		$sql = "SELECT c.*, cen.center_name FROM ".$this->config->item('db_prefix')."camps c 
				LEFT JOIN ".$this->config->item('db_prefix')."centers cen ON c.center_id = cen.ID 
				WHERE c.camp_number='".$camp_number."'";
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
	
	public function update_camp_data($data, $camp_number)
    {
        $sql = "UPDATE " . config_item('db_prefix') . "camps SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE camp_number = '".$camp_number."'";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
	
	public function delete_camp_data($camp_number){
		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "camps WHERE camp_number = '".$camp_number."'";
       	$res = $this->db->query($sql);
		if ($res)
		{
			return 1;
		}
		else
			return 0;	
	}
	
	function get_centers_for_dropdown(){
		$result = array();
		$sql = "SELECT ID, center_name FROM ".$this->config->item('db_prefix')."centers WHERE status='1' ORDER BY center_name ASC";
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
	
	function get_camps_by_center($center_number){
		$result = array();
		$sql = "SELECT c.camp_number, c.camp_name FROM ".$this->config->item('db_prefix')."camps c 
				LEFT JOIN ".$this->config->item('db_prefix')."centers cen ON c.center_id = cen.ID 
				WHERE cen.center_number=? AND c.status='1' ORDER BY c.camp_name ASC";
        $q = $this->db->query($sql, array($center_number));
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
}
// END Camp_model class

/* End of file Camp_model.php */
/* Location: ./application/models/Camp_model.php */
