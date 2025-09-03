<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Email Configuration Helper
 * Provides functions to validate and test email configuration
 */

/**
 * Validate email configuration
 * @return array Array with validation results
 */
function validate_email_config() {
    $CI = &get_instance();
    
    $config = array(
        'mail_host' => $CI->config->config['mail_host'] ?? '',
        'mail_username' => $CI->config->config['mail_username'] ?? '',
        'mail_password' => $CI->config->config['mail_password'] ?? '',
        'mail_from_emailid' => $CI->config->config['mail_from_emailid'] ?? '',
        'mail_from_name' => $CI->config->config['mail_from_name'] ?? '',
        'mail_port' => $CI->config->config['mail_port'] ?? 587,
        'mail_encryption' => $CI->config->config['mail_encryption'] ?? 'tls'
    );
    
    $errors = array();
    $warnings = array();
    
    // Check required fields
    if (empty($config['mail_host'])) {
        $errors[] = 'SMTP Host is required';
    }
    
    if (empty($config['mail_username'])) {
        $errors[] = 'SMTP Username is required';
    }
    
    if (empty($config['mail_password'])) {
        $errors[] = 'SMTP Password is required';
    }
    
    if (empty($config['mail_from_emailid'])) {
        $errors[] = 'From Email is required';
    }
    
    if (empty($config['mail_from_name'])) {
        $errors[] = 'From Name is required';
    }
    
    // Validate email format
    if (!empty($config['mail_from_emailid']) && !filter_var($config['mail_from_emailid'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'From Email format is invalid';
    }
    
    // Check port range
    if ($config['mail_port'] < 1 || $config['mail_port'] > 65535) {
        $errors[] = 'Port must be between 1 and 65535';
    }
    
    // Check encryption
    $valid_encryptions = array('', 'ssl', 'tls');
    if (!in_array($config['mail_encryption'], $valid_encryptions)) {
        $errors[] = 'Encryption must be empty, ssl, or tls';
    }
    
    // Check current environment
    $environment = ENVIRONMENT;
    $warnings[] = "Current environment: {$environment}";
    
    return array(
        'valid' => empty($errors),
        'errors' => $errors,
        'warnings' => $warnings,
        'config' => $config,
        'environment' => $environment
    );
}

/**
 * Test SMTP connection
 * @param string $test_email Test recipient email
 * @return array Array with test results
 */
function test_smtp_connection($test_email = '') {
    $CI = &get_instance();
    
    // Validate configuration first
    $validation = validate_email_config();
    if (!$validation['valid']) {
        return array(
            'success' => false,
            'message' => 'Configuration validation failed',
            'errors' => $validation['errors']
        );
    }
    
    // Use test email if provided, otherwise use from email
    if (empty($test_email)) {
        $test_email = $CI->config->config['mail_from_emailid'];
    }
    
    // Test email sending
    $subject = 'SMTP Test - ' . date('Y-m-d H:i:s');
    $message = "
        <h3>SMTP Connection Test</h3>
        <p>This is a test email to verify SMTP configuration.</p>
        <p><strong>Test Time:</strong> " . date('Y-m-d H:i:s') . "</p>
        <p><strong>Environment:</strong> " . ENVIRONMENT . "</p>
        <p><strong>SMTP Host:</strong> " . $CI->config->config['mail_host'] . "</p>
        <p><strong>SMTP Port:</strong> " . ($CI->config->config['mail_port'] ?? 587) . "</p>
        <p><strong>Encryption:</strong> " . ($CI->config->config['mail_encryption'] ?? 'tls') . "</p>
        <p><small>This is an automated test message.</small></p>
    ";
    
    try {
        $result = send_mail($test_email, $subject, $message);
        
        if ($result) {
            return array(
                'success' => true,
                'message' => 'SMTP connection test successful',
                'test_email' => $test_email,
                'timestamp' => date('Y-m-d H:i:s')
            );
        } else {
            return array(
                'success' => false,
                'message' => 'SMTP connection test failed',
                'test_email' => $test_email,
                'timestamp' => date('Y-m-d H:i:s')
            );
        }
    } catch (Exception $e) {
        return array(
            'success' => false,
            'message' => 'SMTP connection test exception: ' . $e->getMessage(),
            'test_email' => $test_email,
            'timestamp' => date('Y-m-d H:i:s')
        );
    }
}

/**
 * Get email configuration summary
 * @return array Array with configuration summary
 */
function get_email_config_summary() {
    $CI = &get_instance();
    
    $config = array(
        'host' => $CI->config->config['mail_host'] ?? 'Not set',
        'username' => $CI->config->config['mail_username'] ?? 'Not set',
        'password' => !empty($CI->config->config['mail_password']) ? '***SET***' : 'Not set',
        'from_email' => $CI->config->config['mail_from_emailid'] ?? 'Not set',
        'from_name' => $CI->config->config['mail_from_name'] ?? 'Not set',
        'port' => $CI->config->config['mail_port'] ?? 587,
        'encryption' => $CI->config->config['mail_encryption'] ?? 'tls',
        'debug' => $CI->config->config['mail_debug'] ?? false,
        'environment' => ENVIRONMENT
    );
    
    return $config;
}

/**
 * Check if email configuration is complete
 * @return bool True if configuration is complete
 */
function is_email_config_complete() {
    $validation = validate_email_config();
    return $validation['valid'];
}
