<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hub_spoke_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all hub-spoke relationships
     */
    public function get_all_relationships() {
        $sql = "SELECT 
                    hsr.*,
                    hub.center_name as hub_center_name,
                    hub.center_number as hub_center_number,
                    spoke.center_name as spoke_center_name,
                    spoke.center_number as spoke_center_number
                FROM " . $this->config->item('db_prefix') . "hub_spoke_relationships hsr
                LEFT JOIN " . $this->config->item('db_prefix') . "centers hub ON hsr.hub_center_id = hub.center_number
                LEFT JOIN " . $this->config->item('db_prefix') . "centers spoke ON hsr.spoke_center_id = spoke.center_number
                WHERE hsr.status = 'active'
                ORDER BY hub.center_name, spoke.center_name";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get hub center for a specific spoke center
     */
    public function get_hub_for_spoke($spoke_center_id) {
        $sql = "SELECT 
                    hsr.*,
                    hub.center_name as hub_center_name,
                    hub.center_number as hub_center_number,
                    spoke.center_name as spoke_center_name
                FROM " . $this->config->item('db_prefix') . "hub_spoke_relationships hsr
                LEFT JOIN " . $this->config->item('db_prefix') . "centers hub ON hsr.hub_center_id = hub.center_number
                LEFT JOIN " . $this->config->item('db_prefix') . "centers spoke ON hsr.spoke_center_id = spoke.center_number
                WHERE hsr.spoke_center_id = ? AND hsr.status = 'active'
                LIMIT 1";
        
        $query = $this->db->query($sql, array($spoke_center_id));
        $result = $query->result_array();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get all spoke centers for a specific hub center
     */
    public function get_spokes_for_hub($hub_center_id) {
        $sql = "SELECT 
                    hsr.*,
                    spoke.center_name as spoke_center_name,
                    spoke.center_number as spoke_center_number
                FROM " . $this->config->item('db_prefix') . "hub_spoke_relationships hsr
                LEFT JOIN " . $this->config->item('db_prefix') . "centers spoke ON hsr.spoke_center_id = spoke.center_number
                WHERE hsr.hub_center_id = ? AND hsr.status = 'active'
                ORDER BY spoke.center_name";
        
        $query = $this->db->query($sql, array($hub_center_id));
        return $query->result_array();
    }

    /**
     * Add new hub-spoke relationship
     */
    public function add_relationship($data) {
        // Check if relationship already exists
        $existing = $this->db->get_where($this->config->item('db_prefix') . 'hub_spoke_relationships', array(
            'hub_center_id' => $data['hub_center_id'],
            'spoke_center_id' => $data['spoke_center_id']
        ))->num_rows();

        if ($existing > 0) {
            return array('status' => 'error', 'message' => 'Relationship already exists');
        }

        // Update center classifications
        $this->db->where('center_number', $data['hub_center_id']);
        $this->db->update($this->config->item('db_prefix') . 'centers', array('center_classification' => 'hub'));

        $this->db->where('center_number', $data['spoke_center_id']);
        $this->db->update($this->config->item('db_prefix') . 'centers', array('center_classification' => 'spoke'));

        // Insert relationship
        $insert_data = array(
            'hub_center_id' => $data['hub_center_id'],
            'spoke_center_id' => $data['spoke_center_id'],
            'relationship_name' => isset($data['relationship_name']) ? $data['relationship_name'] : null,
            'status' => 'active'
        );

        $result = $this->db->insert($this->config->item('db_prefix') . 'hub_spoke_relationships', $insert_data);
        
        if ($result) {
            return array('status' => 'success', 'message' => 'Relationship added successfully');
        } else {
            return array('status' => 'error', 'message' => 'Failed to add relationship');
        }
    }

    /**
     * Update hub-spoke relationship
     */
    public function update_relationship($id, $data) {
        $update_data = array(
            'hub_center_id' => $data['hub_center_id'],
            'spoke_center_id' => $data['spoke_center_id'],
            'relationship_name' => isset($data['relationship_name']) ? $data['relationship_name'] : null,
            'updated_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        $result = $this->db->update($this->config->item('db_prefix') . 'hub_spoke_relationships', $update_data);
        
        if ($result) {
            // Update center classifications
            $this->db->where('center_number', $data['hub_center_id']);
            $this->db->update($this->config->item('db_prefix') . 'centers', array('center_classification' => 'hub'));

            $this->db->where('center_number', $data['spoke_center_id']);
            $this->db->update($this->config->item('db_prefix') . 'centers', array('center_classification' => 'spoke'));

            return array('status' => 'success', 'message' => 'Relationship updated successfully');
        } else {
            return array('status' => 'error', 'message' => 'Failed to update relationship');
        }
    }

    /**
     * Delete hub-spoke relationship
     */
    public function delete_relationship($id) {
        // Get relationship details before deletion
        $relationship = $this->db->get_where($this->config->item('db_prefix') . 'hub_spoke_relationships', array('id' => $id))->row_array();
        
        if (!$relationship) {
            return array('status' => 'error', 'message' => 'Relationship not found');
        }

        // Soft delete
        $this->db->where('id', $id);
        $result = $this->db->update($this->config->item('db_prefix') . 'hub_spoke_relationships', array('status' => 'inactive'));
        
        if ($result) {
            // Reset center classifications to hub (default)
            $this->db->where('center_number', $relationship['spoke_center_id']);
            $this->db->update($this->config->item('db_prefix') . 'centers', array('center_classification' => 'hub'));

            return array('status' => 'success', 'message' => 'Relationship deleted successfully');
        } else {
            return array('status' => 'error', 'message' => 'Failed to delete relationship');
        }
    }

    /**
     * Get relationship by ID
     */
    public function get_relationship_by_id($id) {
        $sql = "SELECT 
                    hsr.*,
                    hub.center_name as hub_center_name,
                    hub.center_number as hub_center_number,
                    spoke.center_name as spoke_center_name,
                    spoke.center_number as spoke_center_number
                FROM " . $this->config->item('db_prefix') . "hub_spoke_relationships hsr
                LEFT JOIN " . $this->config->item('db_prefix') . "centers hub ON hsr.hub_center_id = hub.center_number
                LEFT JOIN " . $this->config->item('db_prefix') . "centers spoke ON hsr.spoke_center_id = spoke.center_number
                WHERE hsr.id = ? AND hsr.status = 'active'";
        
        $query = $this->db->query($sql, array($id));
        $result = $query->result_array();
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Get all centers that can be hubs (not currently spokes)
     */
    public function get_available_hub_centers() {
        $sql = "SELECT center_number, center_name 
                FROM " . $this->config->item('db_prefix') . "centers 
                WHERE status = '1' 
                AND center_number NOT IN (
                    SELECT DISTINCT spoke_center_id 
                    FROM " . $this->config->item('db_prefix') . "hub_spoke_relationships 
                    WHERE status = 'active'
                )
                ORDER BY center_name";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get all centers that can be spokes (not currently hubs)
     */
    public function get_available_spoke_centers() {
        $sql = "SELECT center_number, center_name 
                FROM " . $this->config->item('db_prefix') . "centers 
                WHERE status = '1' 
                AND center_number NOT IN (
                    SELECT DISTINCT hub_center_id 
                    FROM " . $this->config->item('db_prefix') . "hub_spoke_relationships 
                    WHERE status = 'active'
                )
                ORDER BY center_name";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get center classification for billing display
     */
    public function get_center_classification_for_billing($center_id) {
        // First check if it's a spoke center
        $hub_info = $this->get_hub_for_spoke($center_id);
        if ($hub_info) {
            return array(
                'classification' => 'spoke',
                'relationship_name' => $hub_info['relationship_name'],
                'hub_center_name' => $hub_info['hub_center_name'],
                'hub_center_id' => $hub_info['hub_center_number'],
                'spoke_center_name' => $hub_info['spoke_center_name'],
                'spoke_center_id' => $hub_info['spoke_center_id']
            );
        }

        // Check if it's a hub center
        $spokes = $this->get_spokes_for_hub($center_id);
        if (!empty($spokes)) {
            return array(
                'classification' => 'hub',
                'hub_center_name' => null,
                'hub_center_id' => $center_id,
                'spoke_center_name' => null,
                'spoke_center_id' => null
            );
        }

        // Default to hub
        return array(
            'classification' => 'hub',
            'hub_center_name' => null,
            'hub_center_id' => $center_id,
            'spoke_center_name' => null,
            'spoke_center_id' => null
        );
    }
}
?>
