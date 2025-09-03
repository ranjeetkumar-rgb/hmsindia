<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_purchase_orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('New_purchase_order_model');
        $this->load->model('Stock_model');
        $this->load->model('Accounts_model');
        $this->load->model('Vendors_model');
        $this->load->model('Center_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('myhelper');
    }

    // Index page - List all purchase orders
    public function index() {
        $logg = checklogin();
        if($logg['status'] == true) {
            $data['title'] = 'New Purchase Orders';
            $data['user_role'] = $logg['role']; // Pass user role to view
            
            // Get filters from request
            $filters = [
                'status' => $this->input->get('status'),
                'vendor_number' => $this->input->get('vendor_number'),
                'center' => $this->input->get('center'),
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'po_number' => $this->input->get('po_number')
            ];
            
            // Pagination
            $page = $this->input->get('page') ? $this->input->get('page') : 1;
            $limit = 20;
            $start = ($page - 1) * $limit;
            
            $data['purchase_orders'] = $this->New_purchase_order_model->get_purchase_orders($limit, $start, $filters);
            $data['total_count'] = $this->New_purchase_order_model->count_purchase_orders($filters);
            $data['filters'] = $filters;
            $data['current_page'] = $page;
            $data['total_pages'] = ceil($data['total_count'] / $limit);
            
            // Get pending count for administrators
            if ($logg['role'] == 'administrator') {
                $data['pending_count'] = $this->New_purchase_order_model->count_purchase_orders(['status' => 'pending']);
                $data['approved_count'] = $this->New_purchase_order_model->count_purchase_orders(['status' => 'approved']);
                $data['rejected_count'] = $this->New_purchase_order_model->count_purchase_orders(['status' => 'rejected']);
                $data['completed_count'] = $this->New_purchase_order_model->count_purchase_orders(['status' => 'completed']);
            }
            
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('new_purchase_orders/index', $data);
            $this->load->view($template['footer']);
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Add new purchase order form
    public function add() {
        $logg = checklogin();
        if($logg['status'] == true) {
            $data['title'] = 'Add New Purchase Order';
            
            // Get vendors
            $data['vendors'] = $this->get_vendors();
            
            // Get consumables/items
            $data['consumables'] = $this->get_consumables();
            // Get centers
            $data['centers'] = $this->get_centers();
            
            // Generate PO number
            $data['po_number'] = $this->New_purchase_order_model->generate_po_number();
            
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('new_purchase_orders/add', $data);
            $this->load->view($template['footer']);
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Save new purchase order
    public function save() {
        $logg = checklogin();
        if($logg['status'] == true) {
            if ($this->input->post()) {
                $po_data = [
                    'po_number' => $this->input->post('po_number'),
                    'vendor_number' => $this->input->post('vendor_number'),
                    'ship_to' => $this->input->post('ship_to'),
                    'bill_to' => $this->input->post('bill_to'),
                    'department' => $this->input->post('department'),
                    'created_by' => $this->session->userdata('user_id'),
                    'status' => 'pending'
                ];
                $po_id = $this->New_purchase_order_model->insert_purchase_order($po_data);
                if ($po_id) {
                    $po_number_data = [
                        'po_number' => $po_data['po_number'],
                        'financial_year' => $this->New_purchase_order_model->get_financial_year(),
                        'month' => $this->New_purchase_order_model->get_month_name(),
                        'sequence_number' => (int) substr($po_data['po_number'], strrpos($po_data['po_number'], "/") + 1)
                    ];
                    $this->New_purchase_order_model->insert_po_number($po_number_data);
                    $this->save_purchase_order_items($po_id, $po_data['po_number']);
                    $this->New_purchase_order_model->update_total_amount($po_id);
                    $this->session->set_flashdata('success', 'Purchase order created successfully!');
                    redirect('new_purchase_orders');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create purchase order!');
                    redirect('new_purchase_orders/add');
                }
            }
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Save purchase order items
    private function save_purchase_order_items($po_id, $po_number) {
        $items = [];
        $i = 1;
        while ($this->input->post('consumables_name_' . $i) && !empty($this->input->post('consumables_name_' . $i))) {
            $item_number = $this->input->post('consumables_name_' . $i);
            if (!empty($item_number)) {
                $item_data = [
                    'po_id' => $po_id,
                    'po_number' => $po_number,
                    'serial_number' => $i,
                    'item_name' => $this->input->post('consumables_item_name_' . $i),
                    'item_number' => $item_number,
                    'quantity' => $this->input->post('consumables_quantity_' . $i),
                    'batch_number' => $this->input->post('consumables_batch_number_' . $i),
                    'price' => $this->input->post('consumables_price_' . $i),
                    'vendor_price' => $this->input->post('consumables_vendor_price_' . $i),
                    'pack_size' => $this->input->post('consumables_pack_size_' . $i),
                    'mrp' => $this->input->post('consumables_mrp_' . $i),
                    'tax_percentage' => $this->input->post('consumables_gstrate_' . $i),
                    'company' => $this->input->post('consumables_company_' . $i),
                    'hsn' => $this->input->post('consumables_hsn_' . $i),
                    'gst_division' => $this->input->post('consumables_gstdivision_' . $i),
                    'brand_name' => $this->input->post('consumables_brand_name_' . $i)
                ];
                
                // Debug logging - remove this after testing
                error_log("PO Item Data - PO ID: $po_id, Item $i: " . json_encode($item_data));
                
                $this->New_purchase_order_model->insert_purchase_order_items($item_data);
            }
            $i++;
        }
    }
    public function edit($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            $data['title'] = 'Edit Purchase Order';
            
            $data['purchase_order'] = $this->New_purchase_order_model->get_purchase_order_by_id($id);
            $data['purchase_order_items'] = $this->New_purchase_order_model->get_purchase_order_items($id);
            
            if (!$data['purchase_order']) {
                $this->session->set_flashdata('error', 'Purchase order not found!');
                redirect('new_purchase_orders');
            }
            
            // Check if purchase order can be edited (only pending or rejected orders)
            if ($data['purchase_order']['status'] == 'approved' || $data['purchase_order']['status'] == 'completed') {
                $this->session->set_flashdata('error', 'Cannot edit purchase order that is ' . $data['purchase_order']['status'] . '!');
                redirect('new_purchase_orders');
            }
            
            // Get vendors
            $data['vendors'] = $this->get_vendors();
            
            // Get consumables/items
            $data['consumables'] = $this->get_consumables();
            
            // Get centers
            $data['centers'] = $this->get_centers();
            
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('new_purchase_orders/edit', $data);
            $this->load->view($template['footer']);
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Update purchase order
    public function update($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            if ($this->input->post()) {
                // Check if purchase order can be updated (only pending or rejected orders)
                $po = $this->New_purchase_order_model->get_purchase_order_by_id($id);
                if ($po && ($po['status'] == 'approved' || $po['status'] == 'completed')) {
                    $this->session->set_flashdata('error', 'Cannot update purchase order that is ' . $po['status'] . '!');
                    redirect('new_purchase_orders');
                    return;
                }
                
                $po_data = [
                    'vendor_number' => $this->input->post('vendor_number'),
                    'ship_to' => $this->input->post('ship_to'),
                    'bill_to' => $this->input->post('bill_to'),
                    'department' => $this->input->post('department')
                ];
                
                // Update purchase order
                if ($this->New_purchase_order_model->update_purchase_order($id, $po_data)) {
                    // Delete existing items
                    $this->New_purchase_order_model->delete_purchase_order_items($id);
                    
                    // Get PO number
                    $po = $this->New_purchase_order_model->get_purchase_order_by_id($id);
                    
                    // Insert new items
                    $this->save_purchase_order_items($id, $po['po_number']);
                    
                    // Update total amount
                    $this->New_purchase_order_model->update_total_amount($id);
                    
                    $this->session->set_flashdata('success', 'Purchase order updated successfully!');
                    redirect('new_purchase_orders');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update purchase order!');
                    redirect('new_purchase_orders/edit/' . $id);
                }
            }
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // View purchase order
    public function view($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            $data['title'] = 'View Purchase Order';
            
            $data['purchase_order'] = $this->New_purchase_order_model->get_purchase_order_by_id($id);
            $data['purchase_order_items'] = $this->New_purchase_order_model->get_purchase_order_items($id);
            
            if (!$data['purchase_order']) {
                $this->session->set_flashdata('error', 'Purchase order not found!');
                redirect('new_purchase_orders');
            }
            
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('new_purchase_orders/view', $data);
            $this->load->view($template['footer']);
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Delete purchase order
    public function delete($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            if ($this->New_purchase_order_model->delete_purchase_order($id)) {
                $this->session->set_flashdata('success', 'Purchase order deleted successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete purchase order!');
            }
            redirect('new_purchase_orders');
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Approve purchase order
    public function approve($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            // Check if user is administrator
            if ($logg['role'] != 'administrator') {
                $this->session->set_flashdata('error', 'Only administrators can approve purchase orders!');
                redirect('new_purchase_orders');
                return;
            }
            
            $approved_by = $this->session->userdata('user_id');
            
            if ($this->New_purchase_order_model->update_purchase_order_status($id, 'approved', $approved_by)) {
                $this->session->set_flashdata('success', 'Purchase order approved successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to approve purchase order!');
            }
            redirect('new_purchase_orders');
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Reject purchase order
    public function reject($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            // Check if user is administrator
            if ($logg['role'] != 'administrator') {
                $this->session->set_flashdata('error', 'Only administrators can reject purchase orders!');
                redirect('new_purchase_orders');
                return;
            }
            
            if ($this->New_purchase_order_model->update_purchase_order_status($id, 'rejected')) {
                $this->session->set_flashdata('success', 'Purchase order rejected successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to reject purchase order!');
            }
            redirect('new_purchase_orders');
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Complete purchase order
    public function complete($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            if ($this->New_purchase_order_model->update_purchase_order_status($id, 'completed')) {
                $this->session->set_flashdata('success', 'Purchase order marked as completed!');
            } else {
                $this->session->set_flashdata('error', 'Failed to complete purchase order!');
            }
            redirect('new_purchase_orders');
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Get vendors (you may need to adjust this based on your existing vendor structure)
    private function get_vendors() {
        // This is a placeholder - adjust based on your vendor table structure
        $this->db->select('vendor_number, name');
        $this->db->from('hms_vendors');
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get consumables/items (you may need to adjust this based on your existing structure)
    private function get_consumables() {
        // This is a placeholder - adjust based on your items table structure
        $this->db->select('item_number, item_name, batch_number, quantity, price, vendor_price, mrp, pack_size, gstrate, hsn, gstdivision, company, brand_name');
        $this->db->from('hms_stocks');
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get centers (you may need to adjust this based on your existing center structure)
    private function get_centers() {
        // This is a placeholder - adjust based on your center table structure
        $this->db->select('center_number, center_name, center_address');
        $this->db->from('hms_centers');
        $this->db->where('status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function status() {
        $logg = checklogin();
        if($logg['status'] == true) {
            // Check if user is administrator
            if ($logg['role'] != 'administrator') {
                $this->session->set_flashdata('error', 'Only administrators can access this page!');
                redirect('new_purchase_orders');
                return;
            }
            
            $data['title'] = 'Pending Purchase Orders - Administrator';
            $data['user_role'] = $logg['role'];
            
            // Get only pending purchase orders
            $filters = ['status' => 'pending'];
            
            // Pagination
            $page = $this->input->get('page') ? $this->input->get('page') : 1;
            $limit = 20;
            $start = ($page - 1) * $limit;
            
            $data['purchase_orders'] = $this->New_purchase_order_model->get_purchase_orders($limit, $start, $filters);
            $data['total_count'] = $this->New_purchase_order_model->count_purchase_orders($filters);
            $data['current_page'] = $page;
            $data['total_pages'] = ceil($data['total_count'] / $limit);
            
            // Get counts for dashboard
            $data['pending_count'] = $this->New_purchase_order_model->count_purchase_orders(['status' => 'pending']);
            $data['approved_count'] = $this->New_purchase_order_model->count_purchase_orders(['status' => 'approved']);
            $data['rejected_count'] = $this->New_purchase_order_model->count_purchase_orders(['status' => 'rejected']);
            
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('new_purchase_orders/status', $data);
            $this->load->view($template['footer']);
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }

    // Get center name by center number
    function get_center_name($center){
        $name = $this->Accounts_model->get_center_name($center);
        return $name;
    }

    public function update_status()
    {
        $this->load->model('New_purchase_order_model');
        $id     = $this->input->post('id');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks');
        
        if (empty($id) || !in_array($status, ['0', '1'])) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid request!']));
        }
        
        $updated = $this->New_purchase_order_model->update_status($id, $status, $remarks);
        if ($updated) {
            $message = 'Purchase Order status updated successfully!';
        } else {
            $message = 'Failed to update status. Please try again.';
        }
        return $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['status' => $updated ? 'success' : 'error', 'message' => $message]));
    }

    public function bulk_update_status()
    {
        $this->load->model('New_purchase_order_model');
        $ids    = $this->input->post('ids');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks');
        
        if (empty($ids) || !is_array($ids) || !in_array($status, ['0', '1'])) {
            return $this->output->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid request!']));
        }
        
        $success_count = 0;
        $total_count = count($ids);
        
        foreach ($ids as $id) {
            if ($this->New_purchase_order_model->update_status($id, $status, $remarks)) {
                $success_count++;
            }
        }
        
        if ($success_count == $total_count) {
            $message = "All {$total_count} purchase order(s) updated successfully!";
            $response_status = 'success';
        } elseif ($success_count > 0) {
            $message = "{$success_count} out of {$total_count} purchase order(s) updated successfully!";
            $response_status = 'warning';
        } else {
            $message = "Failed to update any purchase orders. Please try again.";
            $response_status = 'error';
        }
        
        return $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['status' => $response_status, 'message' => $message]));
    }

    // Print purchase order
    public function print_po($id) {
        $logg = checklogin();
        if($logg['status'] == true) {
            $data['purchase_order'] = $this->New_purchase_order_model->get_purchase_order_by_id($id);
            $data['purchase_order_items'] = $this->New_purchase_order_model->get_purchase_order_items($id);
            
            if (!$data['purchase_order']) {
                $this->session->set_flashdata('error', 'Purchase order not found!');
                redirect('new_purchase_orders');
            }
            
            // Check if purchase order is approved or completed
            if ($data['purchase_order']['status'] != 'approved' && $data['purchase_order']['status'] != 'completed') {
                $this->session->set_flashdata('error', 'Only approved or completed purchase orders can be printed!');
                redirect('new_purchase_orders');
            }
            
            // Get vendor data
            $this->load->model('Vendors_model');
            $vendor_data = $this->Vendors_model->get_vendor_data_by_vendor_number($data['purchase_order']['vendor_number']);
            $data['vendor_data'] = $vendor_data[0];
            
            // Get center addresses
            $this->load->model('Center_model');
            $bill_to_center = $this->Center_model->get_item_data($data['purchase_order']['bill_to']);
            $ship_to_center = $this->Center_model->get_item_data($data['purchase_order']['ship_to']);
            
            $data['bill_to_address'] = $bill_to_center ? $bill_to_center['center_name'] . ', ' . $bill_to_center['center_location'] : 'N/A';
            $data['ship_to_address'] = $ship_to_center ? $ship_to_center['center_name'] . ', ' . $ship_to_center['center_location'] : 'N/A';
            
            $this->load->view('new_purchase_orders/print', $data);
        } else {
            header("location:" .base_url(). "");
            die;
        }
    }
}