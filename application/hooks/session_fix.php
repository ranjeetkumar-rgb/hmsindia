<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Session Fix Hook
 * This hook addresses common session issues in production
 */

class Session_fix_hook {
    
    public function __construct() {
        // Ensure session directory exists and has proper permissions
        $session_path = APPPATH . 'cache/sessions/';
        if (!is_dir($session_path)) {
            if (!mkdir($session_path, 0755, true)) {
                log_message('error', 'Failed to create session directory: ' . $session_path);
                return;
            }
            chmod($session_path, 0755);
            log_message('info', 'Created session directory: ' . $session_path);
        }

        // Ensure directory is writable
        if (!is_writable($session_path)) {
            chmod($session_path, 0755);
            log_message('info', 'Set session directory permissions: ' . $session_path);
        }

        // Session configuration is now handled in index.php to prevent headers already sent errors
        // This hook now only handles directory creation and validation
        
        // Log session directory status for debugging
        if (ENVIRONMENT === 'production') {
            if (function_exists('log_message')) {
                log_message('info', 'Session directory verified: ' . $session_path);
                log_message('info', 'Session directory writable: ' . (is_writable($session_path) ? 'Yes' : 'No'));
            }
        }

        // Debug session information
        if (ENVIRONMENT === 'development') {
            log_message('debug', 'Session save path: ' . session_save_path());
            log_message('debug', 'Session status: ' . session_status());
            log_message('debug', 'Session directory exists: ' . (is_dir($session_path) ? 'Yes' : 'No'));
            log_message('debug', 'Session directory writable: ' . (is_writable($session_path) ? 'Yes' : 'No'));
        }
    }
}
