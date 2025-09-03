<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Embryo_record_discharge_summary_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name = 'embryo_record_discharge_summery';
    }

    /**
     * Get embryo record by IIC ID and appointment date
     */
    public function get_by_iic_id($iic_id, $appoitmented_date = '') {
        if (!empty($appoitmented_date)) {
            $this->db->where('iic_id', $iic_id);
            $this->db->where('appoitmented_date', $appoitmented_date);
        } else {
            $this->db->where('iic_id', $iic_id);
        }
        
        $query = $this->db->get($this->table_name);
        return $query->row_array();
    }

    /**
     * Insert new embryo record
     */
    public function insert($data) {
        // Add created timestamp
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        // Set default form status if not provided
        if (!isset($data['form_status'])) {
            $data['form_status'] = 'draft';
        }
        
        $result = $this->db->insert($this->table_name, $data);
        
        if ($result) {
            $message = ($data['form_status'] == 'completed') 
                ? 'Embryo record discharge form completed and submitted successfully! Form is now locked for editing.'
                : 'Embryo record discharge form saved as draft successfully!';
                
            return array(
                'status' => true,
                'message' => $message,
                'insert_id' => $this->db->insert_id()
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Something went wrong while inserting!'
            );
        }
    }

    /**
     * Update existing embryo record
     */
    public function update($iic_id, $appoitmented_date, $data) {
        // Add updated timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        // Add completed timestamp if form is being completed
        if (isset($data['form_status']) && $data['form_status'] == 'completed') {
            $data['completed_at'] = date('Y-m-d H:i:s');
        }
        
        $this->db->where('iic_id', $iic_id);
        if (!empty($appoitmented_date)) {
            $this->db->where('appoitmented_date', $appoitmented_date);
        }
        
        $result = $this->db->update($this->table_name, $data);
        
        if ($result) {
            $message = (isset($data['form_status']) && $data['form_status'] == 'completed')
                ? 'Embryo record discharge form completed and submitted successfully! Form is now locked for editing.'
                : 'Embryo record discharge form updated successfully!';
                
            return array(
                'status' => true,
                'message' => $message
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Something went wrong while updating!'
            );
        }
    }

    /**
     * Save or update embryo record (insert if not exists, update if exists)
     */
    public function save($data) {
        $iic_id = $data['iic_id'];
        $appoitmented_date = isset($data['appoitmented_date']) ? $data['appoitmented_date'] : '';
        $existing_record = $this->get_by_iic_id($iic_id, $appoitmented_date);
        if (empty($existing_record)) {
            return $this->insert($data);
        } else {
            return $this->update($iic_id, $appoitmented_date, $data);
        }
    }

    /**
     * Get all embryo records with patient information
     */
    public function get_all_with_patient_info() {
        $this->db->select('ers.*, p.wife_name, p.husband_name, p.wife_age, p.husband_age');
        $this->db->from($this->table_name . ' ers');
        $this->db->join($this->db->dbprefix('patients') . ' p', 'ers.iic_id = p.patient_id', 'LEFT');
        $this->db->order_by('ers.created_at', 'DESC');
        $query = $this->db->get();
        var_dump($query->result_array());die;
        return $query->result_array();
    }

    /**
     * Delete embryo record
     */
    public function delete($iic_id, $appoitmented_date = '') {
        $this->db->where('iic_id', $iic_id);
        if (!empty($appoitmented_date)) {
            $this->db->where('appoitmented_date', $appoitmented_date);
        }
        
        $result = $this->db->delete($this->table_name);
        
        if ($result) {
            return array(
                'status' => true,
                'message' => 'Embryo record deleted successfully!'
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Something went wrong while deleting!'
            );
        }
    }

    /**
     * Validate form data
     */
    public function validate($data) {
        $errors = array();
        $required_fields = array('iic_id', 'center', 'date_of_addmission', 'date_of_discharge');
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
            }
        }
        if (!empty($data['date_of_addmission']) && !empty($data['date_of_discharge'])) {
            $admission_date = strtotime($data['date_of_addmission']);
            $discharge_date = strtotime($data['date_of_discharge']);
            if ($discharge_date < $admission_date) {
                $errors[] = 'Date of discharge cannot be earlier than date of admission';
            }
        }
        
        return $errors;
    }
    
    /**
     * Check if form is completed and locked
     */
    public function is_form_completed($iic_id, $appoitmented_date = '') {
        $record = $this->get_by_iic_id($iic_id, $appoitmented_date);
        return (!empty($record) && isset($record['form_status']) && $record['form_status'] == 'completed');
    }
    
    /**
     * Get form status
     */
    public function get_form_status($iic_id, $appoitmented_date = '') {
        $record = $this->get_by_iic_id($iic_id, $appoitmented_date);
        return (!empty($record) && isset($record['form_status'])) ? $record['form_status'] : 'draft';
    }
}
