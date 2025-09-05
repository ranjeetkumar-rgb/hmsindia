<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->helper('myhelper');
    }

    /**
     * Test method to verify controller accessibility
     */
    public function test()
    {
        echo "Logs controller is accessible!";
        log_message('info', 'Test method accessed successfully');
    }

    /**
     * Main log panel view
     */
    public function index()
    {
        $logg = checklogin();
        if($logg['status'] == true && $logg['role'] == 'administrator'){
            
            // Get filter parameters
            $date_filter = $this->input->get('date') ?: date('Y-m-d');
            $level_filter = $this->input->get('level') ?: 'all';
            $search_term = $this->input->get('search') ?: '';
            $page = $this->input->get('page') ?: 1;
            $per_page = 50;
            
            // Get logs data
            $logs_data = $this->get_logs_data($date_filter, $level_filter, $search_term, $page, $per_page);
            
            $data = array(
                'logs' => $logs_data['logs'],
                'total_logs' => $logs_data['total'],
                'current_page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($logs_data['total'] / $per_page),
                'date_filter' => $date_filter,
                'level_filter' => $level_filter,
                'search_term' => $search_term,
                'available_dates' => $this->get_available_log_dates(),
                'log_levels' => array('all' => 'All Levels', 'ERROR' => 'Error', 'DEBUG' => 'Debug', 'INFO' => 'Info')
            );
            
            $template = get_header_template($logg['role']);
            $this->load->view($template['header']);
            $this->load->view('logs/log_panel', $data);
            $this->load->view($template['footer']);
        } else {
            header("location:" . base_url());
            die();
        }
    }

    /**
     * Get logs data with filtering and pagination
     */
    private function get_logs_data($date_filter, $level_filter, $search_term, $page, $per_page)
    {
        $log_path = APPPATH . 'logs/';
        $log_file = $log_path . 'log-' . $date_filter . '.php';
        
        $logs = array();
        $total = 0;
        
        if (file_exists($log_file)) {
            $content = file_get_contents($log_file);
            
            // Remove PHP header if present
            $content = preg_replace('/^<\?php defined\([^)]+\) \?>\s*/', '', $content);
            
            // Split into lines and process
            $lines = explode("\n", $content);
            $all_logs = array();
            
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                
                // Parse log line: LEVEL - YYYY-MM-DD HH:MM:SS --> MESSAGE
                if (preg_match('/^(\w+)\s*-\s*(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2})\s*-->\s*(.+)$/', $line, $matches)) {
                    $log_entry = array(
                        'level' => $matches[1],
                        'timestamp' => $matches[2],
                        'message' => $matches[3],
                        'raw' => $line
                    );
                    
                    // Apply level filter
                    if ($level_filter != 'all' && $log_entry['level'] != $level_filter) {
                        continue;
                    }
                    
                    // Apply search filter
                    if (!empty($search_term) && stripos($log_entry['message'], $search_term) === false) {
                        continue;
                    }
                    
                    $all_logs[] = $log_entry;
                }
            }
            
            // Reverse to show newest first
            $all_logs = array_reverse($all_logs);
            
            $total = count($all_logs);
            
            // Apply pagination
            $offset = ($page - 1) * $per_page;
            $logs = array_slice($all_logs, $offset, $per_page);
        }
        
        return array(
            'logs' => $logs,
            'total' => $total
        );
    }

    /**
     * Get available log dates
     */
    private function get_available_log_dates()
    {
        $log_path = APPPATH . 'logs/';
        $dates = array();
        
        if (is_dir($log_path)) {
            $files = glob($log_path . 'log-*.php');
            foreach ($files as $file) {
                if (preg_match('/log-(\d{4}-\d{2}-\d{2})\.php$/', basename($file), $matches)) {
                    $dates[] = $matches[1];
                }
            }
            rsort($dates); // Newest first
        }
        
        return $dates;
    }

    /**
     * AJAX endpoint to get logs
     */
    public function ajax()
    {
        // Log the AJAX request
        log_message('debug', 'AJAX request to ajax method - GET data: ' . json_encode($this->input->get()));
        
        $logg = checklogin();
        if($logg['status'] == true && $logg['role'] == 'administrator'){
            
            $date_filter = $this->input->get('date') ?: date('Y-m-d');
            $level_filter = $this->input->get('level') ?: 'all';
            $search_term = $this->input->get('search') ?: '';
            $page = $this->input->get('page') ?: 1;
            $per_page = 50;
            
            log_message('debug', 'Processing logs request - Date: ' . $date_filter . ', Level: ' . $level_filter . ', Search: ' . $search_term . ', Page: ' . $page);
            
            $logs_data = $this->get_logs_data($date_filter, $level_filter, $search_term, $page, $per_page);
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'success' => true,
                    'logs' => $logs_data['logs'],
                    'total' => $logs_data['total'],
                    'current_page' => $page,
                    'total_pages' => ceil($logs_data['total'] / $per_page)
                )));
        } else {
            log_message('error', 'Unauthorized access to ajax method - User role: ' . (isset($logg['role']) ? $logg['role'] : 'not logged in'));
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'message' => 'Access denied')));
        }
    }

    /**
     * Download logs as text file
     */
    public function download()
    {
        $logg = checklogin();
        if($logg['status'] == true && $logg['role'] == 'administrator'){
            
            $date_filter = $this->input->get('date') ?: date('Y-m-d');
            $level_filter = $this->input->get('level') ?: 'all';
            $search_term = $this->input->get('search') ?: '';
            
            $log_path = APPPATH . 'logs/';
            $log_file = $log_path . 'log-' . $date_filter . '.php';
            
            if (file_exists($log_file)) {
                $content = file_get_contents($log_file);
                
                // Remove PHP header if present
                $content = preg_replace('/^<\?php defined\([^)]+\) \?>\s*/', '', $content);
                
                // Apply filters
                if ($level_filter != 'all' || !empty($search_term)) {
                    $lines = explode("\n", $content);
                    $filtered_lines = array();
                    
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if (empty($line)) continue;
                        
                        // Parse log line
                        if (preg_match('/^(\w+)\s*-\s*(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2})\s*-->\s*(.+)$/', $line, $matches)) {
                            $level = $matches[1];
                            $message = $matches[3];
                            
                            // Apply level filter
                            if ($level_filter != 'all' && $level != $level_filter) {
                                continue;
                            }
                            
                            // Apply search filter
                            if (!empty($search_term) && stripos($message, $search_term) === false) {
                                continue;
                            }
                        }
                        
                        $filtered_lines[] = $line;
                    }
                    
                    $content = implode("\n", $filtered_lines);
                }
                
                $filename = 'logs_' . $date_filter . '_' . date('H-i-s') . '.txt';
                
                header('Content-Type: text/plain');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                header('Content-Length: ' . strlen($content));
                
                echo $content;
                exit;
            } else {
                show_error('Log file not found for the selected date.');
            }
        } else {
            header("location:" . base_url());
            die();
        }
    }

    /**
     * Clear logs (admin only)
     */
    public function clear()
    {
        // Log the clear logs request
        log_message('debug', 'Clear logs request - POST data: ' . json_encode($this->input->post()) . ' - GET data: ' . json_encode($this->input->get()));
        
        // Test if method is accessible
        if ($this->input->method() === 'post') {
            log_message('debug', 'Clear logs method accessed via POST');
        } else {
            log_message('debug', 'Clear logs method accessed via ' . $this->input->method());
        }
        
        $logg = checklogin();
        if($logg['status'] == true && $logg['role'] == 'administrator'){
            
            $date_filter = $this->input->post('date') ?: $this->input->get('date') ?: date('Y-m-d');
            $log_path = APPPATH . 'logs/';
            $log_file = $log_path . 'log-' . $date_filter . '.php';
            
            // Log the clear action
            log_message('info', 'Admin ' . $_SESSION['logged_administrator']['name'] . ' attempting to clear logs for date: ' . $date_filter);
            
            if (file_exists($log_file)) {
                // Check if file is writable
                if (!is_writable($log_file)) {
                    log_message('error', 'Cannot clear log file - file not writable: ' . $log_file);
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success' => false, 'message' => 'Log file is not writable')));
                    return;
                }
                
                // Try to clear the file content instead of deleting
                if (file_put_contents($log_file, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n") !== false) {
                    log_message('info', 'Logs cleared successfully for date: ' . $date_filter . ' by admin: ' . $_SESSION['logged_administrator']['name']);
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success' => true, 'message' => 'Logs cleared successfully')));
                } else {
                    log_message('error', 'Failed to clear log file: ' . $log_file);
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success' => false, 'message' => 'Failed to clear logs - permission denied')));
                }
            } else {
                log_message('info', 'Log file not found for date: ' . $date_filter);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('success' => false, 'message' => 'Log file not found for the selected date')));
            }
        } else {
            log_message('error', 'Unauthorized attempt to clear logs - Access denied');
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'message' => 'Access denied')));
        }
    }

    /**
     * Get log statistics
     */
    public function stats()
    {
        $logg = checklogin();
        if($logg['status'] == true && $logg['role'] == 'administrator'){
            
            $date_filter = $this->input->get('date') ?: date('Y-m-d');
            $log_path = APPPATH . 'logs/';
            $log_file = $log_path . 'log-' . $date_filter . '.php';
            
            $stats = array(
                'total_logs' => 0,
                'error_count' => 0,
                'debug_count' => 0,
                'info_count' => 0,
                'file_size' => 0
            );
            
            if (file_exists($log_file)) {
                $stats['file_size'] = filesize($log_file);
                $content = file_get_contents($log_file);
                
                // Remove PHP header if present
                $content = preg_replace('/^<\?php defined\([^)]+\) \?>\s*/', '', $content);
                
                $lines = explode("\n", $content);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (empty($line)) continue;
                    
                    if (preg_match('/^(\w+)\s*-\s*(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2})\s*-->\s*(.+)$/', $line, $matches)) {
                        $stats['total_logs']++;
                        $level = $matches[1];
                        
                        switch ($level) {
                            case 'ERROR':
                                $stats['error_count']++;
                                break;
                            case 'DEBUG':
                                $stats['debug_count']++;
                                break;
                            case 'INFO':
                                $stats['info_count']++;
                                break;
                        }
                    }
                }
            }
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($stats));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => false, 'message' => 'Access denied')));
        }
    }
}
