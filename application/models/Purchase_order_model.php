<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order_model extends CI_Model {

    public function insert_purchase_order($data) {
        return $this->db->insert('hms_purchase_orders', $data);
    }

    // Count purchase orders with filters
    public function purchase_order_count($filters = [])
    {
        $this->apply_filters($filters);
        return $this->db->count_all_results('hms_purchase_orders');
    }
    public function get_by_token($token)
    {
        try {
            return $this->db->where('approval_token', $token)->get('hms_purchase_orders')->row_array();
        } catch (Exception $e) {
            log_message('error', 'Fetch by Token Failed: ' . $e->getMessage());
            return null;
        }
    }
    public function update_status_by_token($token, $status)
    {
        try {
            return $this->db->where('approval_token', $token)
                            ->update('hms_purchase_orders', ['status' => $status]);
        } catch (Exception $e) {
            log_message('error', 'Update Status Failed: ' . $e->getMessage());
            return false;
        }
    }

    // Get paginated purchase orders with filters
    public function purchase_order_pagination($limit, $start, $filters = [])
    {
        $this->apply_filters($filters);

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('hms_purchase_orders', $limit, $start);
        return $query->result_array();
    }

    private function apply_filters($filters = [])
    {
        if ($filters['status'] !== '' && $filters['status'] !== null) {
            $this->db->where('status', $filters['status']);
        }


        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $this->db->where('DATE(created_at) >=', $filters['start_date']);
            $this->db->where('DATE(created_at) <=', $filters['end_date']);
        }

        if (!empty($filters['po_centre'])) {
            $this->db->like('po_centre', $filters['po_centre']);
        }

        if (!empty($filters['po_department'])) {
            $this->db->like('po_department', $filters['po_department']);
        }

        if (!empty($filters['po_nature_of_expenditure'])) {
            $this->db->like('po_nature_of_expenditure', $filters['po_nature_of_expenditure']);
        }

        if (!empty($filters['po_budget_head'])) {
            $this->db->like('po_budget_head', $filters['po_budget_head']);
        }

        if (!empty($filters['po_budget_item'])) {
            $this->db->like('po_budget_item', $filters['po_budget_item']);
        }

        if (!empty($filters['approval_status'])) {
            // Handle approval status filtering based on approver_tokens JSON field
            switch ($filters['approval_status']) {
                case 'all_approved':
                    // Find POs where all approvers have approved (no pending, no rejected)
                    $this->db->where("JSON_LENGTH(JSON_EXTRACT(approver_tokens, '$[*].status')) > 0");
                    $this->db->where("JSON_SEARCH(approver_tokens, 'one', 'pending') IS NULL");
                    $this->db->where("JSON_SEARCH(approver_tokens, 'one', 'rejected') IS NULL");
                    break;
                    
                case 'pending':
                    // Find POs that have at least one pending approver
                    $this->db->where("JSON_SEARCH(approver_tokens, 'one', 'pending') IS NOT NULL");
                    break;
                    
                case 'rejected':
                    // Find POs that have at least one rejected approver
                    $this->db->where("JSON_SEARCH(approver_tokens, 'one', 'rejected') IS NOT NULL");
                    break;
                    
                case 'partial':
                    // Find POs that have some approved but not all (mixed status)
                    $this->db->where("JSON_LENGTH(JSON_EXTRACT(approver_tokens, '$[*].status')) > 0");
                    $this->db->where("JSON_SEARCH(approver_tokens, 'one', 'pending') IS NOT NULL");
                    $this->db->where("JSON_SEARCH(approver_tokens, 'one', 'rejected') IS NULL");
                    break;
            }
        }

        if (!empty($filters['po_name_of_vendor'])) {
            $this->db->like('po_name_of_vendor', $filters['po_name_of_vendor']);
        }
    }
    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('hms_purchase_orders', ['status' => $status]);
    }
    public function generate_po_number()
    {
        $this->db->select('po_number');
        $this->db->from('hms_purchase_orders');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $last_po = $query->row()->po_number;
            $number = (int) str_replace("PO-", "", $last_po);
            $new_number = $number + 1;
        } else {
            $new_number = 1;
        }
        return "PO-" . str_pad($new_number, 6, "0", STR_PAD_LEFT);
    }

    public function get_purchase_order_by_id($po_number)
    {
        return $this->db->where('po_number', $po_number)
                        ->get('hms_purchase_orders') 
                        ->row_array();
    }
    public function save_purchase_order_payment($data)
    {
        return $this->db->insert('hms_purchase_order_payments', $data);
    }

    public function update_purchase_order($po_number, $amount_paid)
    {
        $purchase_order = $this->db->where('po_number', $po_number)
                                ->get('hms_purchase_orders')
                                ->row_array();
        if (!$purchase_order) {
            return false;
        }
        $new_paid   = $purchase_order['amount_paid'] + $amount_paid; 
        $new_balance = $purchase_order['po_po_total'] - $amount_paid;
        $this->db->where('po_number', $po_number)
                ->update('hms_purchase_orders', [
                    'amount_paid' => $new_paid,
                    'balance'     => $new_balance,
                    'po_po_total' => $new_balance
                ]);
        return true;
    }

    /**
     * Store approver tokens as JSON in the purchase order record
     * @param string $po_number Purchase order number
     * @param array $approver_tokens Array of approver tokens with email and token
     * @return bool Success status
     */
    public function store_approver_tokens($po_number, $approver_tokens)
    {
        try {
            $tokens_json = json_encode($approver_tokens);
            return $this->db->where('po_number', $po_number)
                            ->update('hms_purchase_orders', [
                                'approver_tokens' => $tokens_json
                            ]);
        } catch (Exception $e) {
            log_message('error', 'Failed to store approver tokens: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get approver token details by token from JSON field
     * @param string $token Approver token
     * @return array|null Token details or null if not found
     */
    public function get_approver_token_details($token)
    {
        try {
            $this->db->select('po_number, approver_tokens');
            $this->db->from('hms_purchase_orders');
            $this->db->like('approver_tokens', $token);
            $result = $this->db->get()->row_array();
            
            if (!$result || empty($result['approver_tokens'])) {
                return null;
            }
            
            $tokens = json_decode($result['approver_tokens'], true);
            if (!$tokens) {
                return null;
            }
            
            foreach ($tokens as $token_data) {
                if ($token_data['token'] === $token) {
                    return [
                        'po_number' => $result['po_number'],
                        'approver_email' => $token_data['email'],
                        'token' => $token_data['token'],
                        'status' => isset($token_data['status']) ? $token_data['status'] : 'pending'
                    ];
                }
            }
            
            return null;
        } catch (Exception $e) {
            log_message('error', 'Failed to get approver token details: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Update approver token status in JSON field
     * @param string $token Approver token
     * @param string $status New status
     * @param string $remarks Optional remarks
     * @return bool Success status
     */
    public function update_approver_token_status($token, $status, $remarks = '')
    {
        try {
            $token_details = $this->get_approver_token_details($token);
            if (!$token_details) {
                return false;
            }
            
            $po = $this->get_purchase_order_by_id($token_details['po_number']);
            if (!$po || empty($po['approver_tokens'])) {
                return false;
            }
            
            $tokens = json_decode($po['approver_tokens'], true);
            if (!$tokens) {
                return false;
            }
            
            // Update the specific token status
            foreach ($tokens as &$token_data) {
                if ($token_data['token'] === $token) {
                    $token_data['status'] = $status;
                    $token_data['approved_at'] = date('Y-m-d H:i:s');
                    if ($remarks) {
                        $token_data['remarks'] = $remarks;
                    }
                    break;
                }
            }
            
            // Update the database
            $tokens_json = json_encode($tokens);
            return $this->db->where('po_number', $token_details['po_number'])
                            ->update('hms_purchase_orders', [
                                'approver_tokens' => $tokens_json
                            ]);
        } catch (Exception $e) {
            log_message('error', 'Failed to update approver token status: ' . $e->getMessage());
            return false;
        }
    }

}
