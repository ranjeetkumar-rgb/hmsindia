<?php
/**
 * Session Configuration Fix for Live Environment
 * This file addresses common session issues in production
 */

// Ensure session directory exists and has proper permissions
$session_path = APPPATH . 'cache/sessions/';
if (!is_dir($session_path)) {
    mkdir($session_path, 0755, true);
}

// Set proper session configuration for live environment
if (ENVIRONMENT === 'production') {
    // Use custom session save path
    ini_set('session.save_path', $session_path);
    
    // Set session cookie parameters for better security
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0);
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_samesite', 'Lax');
    
    // Set session garbage collection
    ini_set('session.gc_maxlifetime', 7200); // 2 hours
    ini_set('session.gc_probability', 1);
    ini_set('session.gc_divisor', 100);
    
    // Ensure session files are cleaned up
    ini_set('session.use_strict_mode', 1);
    ini_set('session.use_cookies', 1);
    ini_set('session.use_only_cookies', 1);
}

// Debug session information (remove in production)
if (ENVIRONMENT === 'development') {
    log_message('debug', 'Session save path: ' . session_save_path());
    log_message('debug', 'Session status: ' . session_status());
}
