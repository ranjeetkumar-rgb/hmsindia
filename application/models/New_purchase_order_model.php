<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_purchase_order_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert new purchase order
    public function insert_purchase_order($data) {
        $this->db->insert('hms_new_purchase_orders', $data);
        return $this->db->insert_id();
    }

    // Insert purchase order items
    public function insert_purchase_order_items($data) {
        return $this->db->insert('hms_new_purchase_order_items', $data);
    }

    // Insert PO number tracking
    public function insert_po_number($data) {
        return $this->db->insert('hms_new_ponumber', $data);
    }

    // Get last PO number for the same month
    public function get_last_po_number($prefix) {
        $this->db->select('po_number');
        $this->db->from('hms_new_ponumber');
        $this->db->like('po_number', $prefix, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return null;
    }

    // Get all purchase orders with pagination
    public function get_purchase_orders($limit = 10, $start = 0, $filters = []) {
        $this->apply_filters($filters);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('hms_new_purchase_orders', $limit, $start);
        return $query->result_array();
    }

    // Count purchase orders with filters
    public function count_purchase_orders($filters = []) {
        $this->apply_filters($filters);
        return $this->db->count_all_results('hms_new_purchase_orders');
    }

    // Get purchase order by ID
    public function get_purchase_order_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('hms_new_purchase_orders');
        return $query->row_array();
    }

    // Get purchase order items by PO ID
    public function get_purchase_order_items($po_id) {
        $this->db->where('po_id', $po_id);
        $query = $this->db->get('hms_new_purchase_order_items');
        return $query->result_array();
    }

    // Update purchase order status
    public function update_purchase_order_status($id, $status, $approved_by = null) {
        $data = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($approved_by && $status == 'approved') {
            $data['approved_by'] = $approved_by;
            $data['approved_at'] = date('Y-m-d H:i:s');
        }
        
        $this->db->where('id', $id);
        return $this->db->update('hms_new_purchase_orders', $data);
    }

    // Update status (alias for update_purchase_order_status for compatibility)
    public function update_status($id, $status, $remarks = null) {
        $data = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Map numeric status to string status
        if ($status == '1') {
            $data['status'] = 'approved';
            $data['approved_by'] = isset($_SESSION['logged_administrator']['name']) ? $_SESSION['logged_administrator']['name'] : 'Administrator';
            $data['approved_at'] = date('Y-m-d H:i:s');
        } elseif ($status == '0') {
            $data['status'] = 'rejected';
            // Note: rejected_by and rejected_at fields don't exist in the table
            // We could add them later if needed
        }
        
        $this->db->where('id', $id);
        return $this->db->update('hms_new_purchase_orders', $data);
    }

    // Update purchase order
    public function update_purchase_order($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('hms_new_purchase_orders', $data);
    }

    // Delete purchase order items
    public function delete_purchase_order_items($po_id) {
        $this->db->where('po_id', $po_id);
        return $this->db->delete('hms_new_purchase_order_items');
    }

    // Delete purchase order
    public function delete_purchase_order($id) {
        // First delete items, then delete order
        $this->delete_purchase_order_items($id);
        $this->db->where('id', $id);
        return $this->db->delete('hms_new_purchase_orders');
    }

    // Get purchase order by PO number
    public function get_purchase_order_by_po_number($po_number) {
        $this->db->where('po_number', $po_number);
        $query = $this->db->get('hms_new_purchase_orders');
        return $query->row_array();
    }

    // Get purchase orders by vendor
    public function get_purchase_orders_by_vendor($vendor_number) {
        $this->db->where('vendor_number', $vendor_number);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('hms_new_purchase_orders');
        return $query->result_array();
    }

    // Get purchase orders by center

    // Get purchase orders by status
    public function get_purchase_orders_by_status($status) {
        $this->db->where('status', $status);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('hms_new_purchase_orders');
        return $query->result_array();
    }

    // Get purchase orders by date range
    public function get_purchase_orders_by_date_range($start_date, $end_date) {
        $this->db->where('DATE(created_at) >=', $start_date);
        $this->db->where('DATE(created_at) <=', $end_date);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('hms_new_purchase_orders');
        return $query->result_array();
    }

    // Calculate total amount for purchase order
    public function calculate_total_amount($po_id) {
        $this->db->select('quantity, vendor_price, tax_percentage');
        $this->db->where('po_id', $po_id);
        $query = $this->db->get('hms_new_purchase_order_items');
        $items = $query->result_array();
        
        $total = 0;
        foreach ($items as $item) {
            $quantity = floatval($item['quantity']) ?: 0;
            $vendor_price = floatval($item['vendor_price']) ?: 0;
            $tax = floatval($item['tax_percentage']) ?: 0;
            
            $item_total = ($quantity * $vendor_price) * (1 + $tax / 100);
            $total += $item_total;
            
            // Debug logging - remove this after testing
            error_log("PO Item Debug - PO ID: $po_id, Quantity: $quantity, Vendor Price: $vendor_price, Tax: $tax, Item Total: $item_total, Running Total: $total");
        }
        
        error_log("PO Total Calculation - PO ID: $po_id, Final Total: $total");
        return $total;
    }

    // Update total amount in purchase order
    public function update_total_amount($po_id) {
        $total = $this->calculate_total_amount($po_id);
        $this->db->where('id', $po_id);
        return $this->db->update('hms_new_purchase_orders', ['total_amount' => $total]);
    }

    // Apply filters for search
    private function apply_filters($filters = []) {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        
        if (!empty($filters['vendor_number'])) {
            $this->db->where('vendor_number', $filters['vendor_number']);
        }
        
        if (!empty($filters['center'])) {
            $this->db->where('center', $filters['center']);
        }
        
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $this->db->where('DATE(created_at) >=', $filters['start_date']);
            $this->db->where('DATE(created_at) <=', $filters['end_date']);
        }
        
        if (!empty($filters['po_number'])) {
            $this->db->like('po_number', $filters['po_number']);
        }
    }

    // Get financial year
    public function get_financial_year() {
        $date = date_create("now");
        $year = date_format($date, "y");
        $month = date_format($date, "m");
        
        if ($month >= 4) {
            return $year . '-' . ($year + 1);
        } else {
            return ($year - 1) . '-' . $year;
        }
    }

    // Get month name
    public function get_month_name() {
        $date = date_create("now");
        return date_format($date, "F");
    }

    // Generate PO number
    public function generate_po_number() {
        $financial_year = $this->get_financial_year();
        $month = $this->get_month_name();
        $psno = "PSPL/" . $financial_year . "/" . $month . "/";
        
        $last_po = $this->get_last_po_number($psno);
        $last_number = 0;
        
        if ($last_po) {
            $last_number = (int) substr($last_po['po_number'], strrpos($last_po['po_number'], "/") + 1);
        }
        
        $new_number = $last_number + 1;
        return $psno . $new_number;
    }
}
