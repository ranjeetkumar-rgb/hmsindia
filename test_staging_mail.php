<?php
/**
 * Staging Mail Configuration Test
 * 
 * This file tests the staging email configuration to ensure it works correctly.
 * Run this file from your staging environment to verify email functionality.
 * 
 * This is a standalone test that bypasses CodeIgniter authentication.
 */

// Set environment to staging for testing
define('ENVIRONMENT', 'staging');

// Include only the necessary files without CodeIgniter bootstrap
require_once('application/config/config.php');
require_once('application/helpers/myhelper_helper.php');
require_once('smtpmailer/class.phpmailer.php');

// Load staging email configuration
$staging_config_file = 'application/config/staging/email.php';
if (file_exists($staging_config_file)) {
    include($staging_config_file);
} else {
    echo "<p style='color: red;'>❌ Staging email config file not found: $staging_config_file</p>";
    exit;
}

// Test email configuration
echo "<h2>Staging Mail Configuration Test</h2>";
echo "<hr>";

// Display current configuration
echo "<h3>Current Mail Configuration:</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Setting</th><th>Value</th></tr>";
echo "<tr><td>Environment</td><td>" . ENVIRONMENT . "</td></tr>";
echo "<tr><td>Mail Host</td><td>" . ($config['mail_host'] ?? 'Not set') . "</td></tr>";
echo "<tr><td>Mail Username</td><td>" . ($config['mail_username'] ?? 'Not set') . "</td></tr>";
echo "<tr><td>Mail Port</td><td>" . ($config['mail_port'] ?? 'Not set') . "</td></tr>";
echo "<tr><td>Mail Encryption</td><td>" . ($config['mail_encryption'] ?? 'Not set') . "</td></tr>";
echo "<tr><td>From Email</td><td>" . ($config['mail_from_emailid'] ?? 'Not set') . "</td></tr>";
echo "<tr><td>From Name</td><td>" . ($config['mail_from_name'] ?? 'Not set') . "</td></tr>";
echo "<tr><td>Debug Mode</td><td>" . (($config['mail_debug'] ?? false) ? 'Enabled' : 'Disabled') . "</td></tr>";
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
        <li>Server: ' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '</li>
        <li>SMTP Host: ' . ($config['mail_host'] ?? 'Not set') . '</li>
    </ul>
    <p>If you receive this email, your staging mail configuration is working correctly!</p>
</body>
</html>
';

// Attempt to send test email using PHPMailer directly
echo "<p>Attempting to send test email to: <strong>$test_email</strong></p>";

try {
    $mail = new PHPMailer(true);
    
    // Enable SMTP debugging if configured
    if ($config['mail_debug'] ?? false) {
        $mail->SMTPDebug = 2; // Enable verbose debug output
    }
    
    $mail->isSMTP();
    $mail->Host = $config['mail_host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['mail_username'];
    $mail->Password = $config['mail_password'];
    $mail->SMTPSecure = $config['mail_encryption'];
    $mail->Port = $config['mail_port'];
    
    $mail->setFrom($config['mail_from_emailid'], $config['mail_from_name']);
    $mail->addAddress($test_email);
    
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    
    $result = $mail->send();
    
    if ($result) {
        echo "<p style='color: green; font-weight: bold;'>✅ SUCCESS: Test email sent successfully!</p>";
        echo "<p>Check your inbox for the test email.</p>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>❌ FAILED: Test email could not be sent.</p>";
        echo "<p>Please check the error logs and configuration settings.</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red; font-weight: bold;'>❌ ERROR: " . $e->getMessage() . "</p>";
    echo "<p>Please check the configuration and try again.</p>";
}

echo "<hr>";

// Additional diagnostics
echo "<h3>Diagnostic Information:</h3>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "</p>";
echo "<p><strong>Current Time:</strong> " . date('Y-m-d H:i:s T') . "</p>";

// Check if PHPMailer class exists
if (class_exists('PHPMailer')) {
    echo "<p style='color: green;'>✅ PHPMailer class is available</p>";
} else {
    echo "<p style='color: red;'>❌ PHPMailer class not found</p>";
}

// Check SMTP configuration file
$staging_config_file = 'application/config/staging/email.php';
if (file_exists($staging_config_file)) {
    echo "<p style='color: green;'>✅ Staging email config file exists: $staging_config_file</p>";
} else {
    echo "<p style='color: red;'>❌ Staging email config file missing: $staging_config_file</p>";
}

// Check if OpenSSL is available for TLS
if (extension_loaded('openssl')) {
    echo "<p style='color: green;'>✅ OpenSSL extension is available (required for TLS)</p>";
} else {
    echo "<p style='color: red;'>❌ OpenSSL extension not found (required for TLS)</p>";
}

echo "<hr>";
echo "<p><em>Test completed at " . date('Y-m-d H:i:s') . "</em></p>";
?>
