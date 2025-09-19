<?php
/**
 * Staging Mail Configuration Test
 * 
 * This file tests the staging email configuration to ensure it works correctly.
 * Run this file from your staging environment to verify email functionality.
 */

// Set environment to staging for testing
define('ENVIRONMENT', 'staging');

// Include CodeIgniter bootstrap
require_once('index.php');

// Get CodeIgniter instance
$CI =& get_instance();

// Test email configuration
echo "<h2>Staging Mail Configuration Test</h2>";
echo "<hr>";

// Display current configuration
echo "<h3>Current Mail Configuration:</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Setting</th><th>Value</th></tr>";
echo "<tr><td>Environment</td><td>" . ENVIRONMENT . "</td></tr>";
echo "<tr><td>Mail Host</td><td>" . $CI->config->item('mail_host') . "</td></tr>";
echo "<tr><td>Mail Username</td><td>" . $CI->config->item('mail_username') . "</td></tr>";
echo "<tr><td>Mail Port</td><td>" . $CI->config->item('mail_port') . "</td></tr>";
echo "<tr><td>Mail Encryption</td><td>" . $CI->config->item('mail_encryption') . "</td></tr>";
echo "<tr><td>From Email</td><td>" . $CI->config->item('mail_from_emailid') . "</td></tr>";
echo "<tr><td>From Name</td><td>" . $CI->config->item('mail_from_name') . "</td></tr>";
echo "<tr><td>Debug Mode</td><td>" . ($CI->config->item('mail_debug') ? 'Enabled' : 'Disabled') . "</td></tr>";
echo "</table>";

echo "<hr>";

// Test email sending
echo "<h3>Email Send Test:</h3>";

// Test recipient (change this to your email for testing)
$test_email = 'ranjeet.kumar@indiaivf.in'; // Change this to your test email
$subject = 'Staging Mail Configuration Test - ' . date('Y-m-d H:i:s');
$message = '
<html>
<head>
    <title>Staging Mail Test</title>
</head>
<body>
    <h2>Staging Mail Configuration Test</h2>
    <p>This is a test email from your staging environment.</p>
    <p><strong>Test Details:</strong></p>
    <ul>
        <li>Environment: ' . ENVIRONMENT . '</li>
        <li>Timestamp: ' . date('Y-m-d H:i:s') . '</li>
        <li>Server: ' . $_SERVER['HTTP_HOST'] . '</li>
        <li>SMTP Host: ' . $CI->config->item('mail_host') . '</li>
    </ul>
    <p>If you receive this email, your staging mail configuration is working correctly!</p>
</body>
</html>
';

// Load the email helper
$CI->load->helper('myhelper');

// Attempt to send test email
echo "<p>Attempting to send test email to: <strong>$test_email</strong></p>";

$result = send_mail($test_email, $subject, $message);

if ($result) {
    echo "<p style='color: green; font-weight: bold;'>✅ SUCCESS: Test email sent successfully!</p>";
    echo "<p>Check your inbox for the test email.</p>";
} else {
    echo "<p style='color: red; font-weight: bold;'>❌ FAILED: Test email could not be sent.</p>";
    echo "<p>Please check the error logs and configuration settings.</p>";
}

echo "<hr>";

// Additional diagnostics
echo "<h3>Diagnostic Information:</h3>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p><strong>Current Time:</strong> " . date('Y-m-d H:i:s T') . "</p>";

// Check if PHPMailer class exists
if (class_exists('PHPMailer')) {
    echo "<p style='color: green;'>✅ PHPMailer class is available</p>";
} else {
    echo "<p style='color: red;'>❌ PHPMailer class not found</p>";
}

// Check SMTP configuration file
$staging_config_file = APPPATH . 'config/staging/email.php';
if (file_exists($staging_config_file)) {
    echo "<p style='color: green;'>✅ Staging email config file exists: $staging_config_file</p>";
} else {
    echo "<p style='color: red;'>❌ Staging email config file missing: $staging_config_file</p>";
}

echo "<hr>";
echo "<p><em>Test completed at " . date('Y-m-d H:i:s') . "</em></p>";
?>
