<?php
/**
 * Session Configuration Fix for Live Environment
 * This file addresses common session issues in production
 */

// Ensure session directory exists and has proper permissions
$session_path = APPPATH . 'cache/sessions/';
if (!is_dir($session_path)) {
    mkdir($session_path, 0755, true);
    chmod($session_path, 0755);
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
    
    // Additional session fixes for production
    ini_set('session.auto_start', 0);
    ini_set('session.cache_limiter', 'nocache');
    ini_set('session.cache_expire', 180);
    
    // Log session issues for debugging
    if (session_status() === PHP_SESSION_NONE) {
        log_message('error', 'Session not started in production environment');
    }
}

// Debug session information
if (ENVIRONMENT === 'development') {
    log_message('debug', 'Session save path: ' . session_save_path());
    log_message('debug', 'Session status: ' . session_status());
    log_message('debug', 'Session directory exists: ' . (is_dir($session_path) ? 'Yes' : 'No'));
    log_message('debug', 'Session directory writable: ' . (is_writable($session_path) ? 'Yes' : 'No'));
}
