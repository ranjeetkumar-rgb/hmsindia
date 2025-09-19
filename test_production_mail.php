<?php
/**
 * Production Mail Configuration Test
 * 
 * This file tests the production email configuration to ensure it works correctly.
 * Run this file from your production environment to verify email functionality.
 * 
 * This is a completely standalone test that bypasses CodeIgniter completely.
 */

// Set environment to production for testing
define('ENVIRONMENT', 'production');

// Include only PHPMailer - no CodeIgniter files
require_once('application/smtpmailer/class.phpmailer.php');

// Load production email configuration manually (bypassing CodeIgniter security)
$production_config_file = 'application/config/production/email.php';
if (file_exists($production_config_file)) {
    // Read the file content and extract config values
    $config_content = file_get_contents($production_config_file);
    
    // Extract config values using regex
    preg_match('/\$config\[\'mail_host\'\]\s*=\s*[\'"]([^\'"]+)[\'"];/', $config_content, $host_match);
    preg_match('/\$config\[\'mail_username\'\]\s*=\s*[\'"]([^\'"]+)[\'"];/', $config_content, $username_match);
    preg_match('/\$config\[\'mail_password\'\]\s*=\s*[\'"]([^\'"]+)[\'"];/', $config_content, $password_match);
    preg_match('/\$config\[\'mail_from_emailid\'\]\s*=\s*[\'"]([^\'"]+)[\'"];/', $config_content, $from_email_match);
    preg_match('/\$config\[\'mail_from_name\'\]\s*=\s*[\'"]([^\'"]+)[\'"];/', $config_content, $from_name_match);
    preg_match('/\$config\[\'mail_port\'\]\s*=\s*(\d+);/', $config_content, $port_match);
    preg_match('/\$config\[\'mail_encryption\'\]\s*=\s*[\'"]([^\'"]+)[\'"];/', $config_content, $encryption_match);
    preg_match('/\$config\[\'mail_debug\'\]\s*=\s*(true|false);/', $config_content, $debug_match);
    preg_match('/\$config\[\'mail_verify_peer\'\]\s*=\s*(true|false);/', $config_content, $verify_peer_match);
    preg_match('/\$config\[\'mail_verify_peer_name\'\]\s*=\s*(true|false);/', $config_content, $verify_peer_name_match);
    preg_match('/\$config\[\'mail_allow_self_signed\'\]\s*=\s*(true|false);/', $config_content, $allow_self_signed_match);
    
    // Set config values
    $config = array(
        'mail_host' => $host_match[1] ?? 'smtp.gmail.com',
        'mail_username' => $username_match[1] ?? '',
        'mail_password' => $password_match[1] ?? '',
        'mail_from_emailid' => $from_email_match[1] ?? '',
        'mail_from_name' => $from_name_match[1] ?? '',
        'mail_port' => (int)($port_match[1] ?? 587),
        'mail_encryption' => $encryption_match[1] ?? 'tls',
        'mail_debug' => ($debug_match[1] ?? 'false') === 'true',
        'mail_verify_peer' => ($verify_peer_match[1] ?? 'true') === 'true',
        'mail_verify_peer_name' => ($verify_peer_name_match[1] ?? 'true') === 'true',
        'mail_allow_self_signed' => ($allow_self_signed_match[1] ?? 'false') === 'true'
    );
} else {
    echo "<p style='color: red;'>❌ Production email config file not found: $production_config_file</p>";
    exit;
}

// Test email configuration
echo "<h2>Production Mail Configuration Test</h2>";
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
echo "<tr><td>Verify Peer</td><td>" . (($config['mail_verify_peer'] ?? true) ? 'Enabled' : 'Disabled') . "</td></tr>";
echo "<tr><td>Verify Peer Name</td><td>" . (($config['mail_verify_peer_name'] ?? true) ? 'Enabled' : 'Disabled') . "</td></tr>";
echo "<tr><td>Allow Self Signed</td><td>" . (($config['mail_allow_self_signed'] ?? false) ? 'Enabled' : 'Disabled') . "</td></tr>";
echo "</table>";

echo "<hr>";

// Test email sending
echo "<h3>Email Send Test:</h3>";

// Test recipient (change this to your email for testing)
$test_email = 'ranjeet.kumar@indiaivf.in'; // Change this to your test email
$subject = 'Production Mail Configuration Test - ' . date('Y-m-d H:i:s');
$message = '
<html>
<head>
    <title>Production Mail Test</title>
</head>
<body>
    <h2>Production Mail Configuration Test</h2>
    <p>This is a test email from your production environment.</p>
    <p><strong>Test Details:</strong></p>
    <ul>
        <li>Environment: ' . ENVIRONMENT . '</li>
        <li>Timestamp: ' . date('Y-m-d H:i:s') . '</li>
        <li>Server: ' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '</li>
        <li>SMTP Host: ' . ($config['mail_host'] ?? 'Not set') . '</li>
        <li>From: ' . ($config['mail_from_name'] ?? 'Not set') . ' &lt;' . ($config['mail_from_emailid'] ?? 'Not set') . '&gt;</li>
    </ul>
    <p>If you receive this email, your production mail configuration is working correctly!</p>
    <p><strong>Security Features:</strong></p>
    <ul>
        <li>Peer Verification: ' . (($config['mail_verify_peer'] ?? true) ? 'Enabled' : 'Disabled') . '</li>
        <li>Peer Name Verification: ' . (($config['mail_verify_peer_name'] ?? true) ? 'Enabled' : 'Disabled') . '</li>
        <li>Self-Signed Certificates: ' . (($config['mail_allow_self_signed'] ?? false) ? 'Allowed' : 'Not Allowed') . '</li>
    </ul>
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
    
    // Apply security settings
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => $config['mail_verify_peer'] ?? true,
            'verify_peer_name' => $config['mail_verify_peer_name'] ?? true,
            'allow_self_signed' => $config['mail_allow_self_signed'] ?? false,
        )
    );
    
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

// Check production configuration file
$production_config_file = 'application/config/production/email.php';
if (file_exists($production_config_file)) {
    echo "<p style='color: green;'>✅ Production email config file exists: $production_config_file</p>";
} else {
    echo "<p style='color: red;'>❌ Production email config file missing: $production_config_file</p>";
}

// Check if OpenSSL is available for TLS
if (extension_loaded('openssl')) {
    echo "<p style='color: green;'>✅ OpenSSL extension is available (required for TLS)</p>";
} else {
    echo "<p style='color: red;'>❌ OpenSSL extension not found (required for TLS)</p>";
}

// Check if cURL is available
if (extension_loaded('curl')) {
    echo "<p style='color: green;'>✅ cURL extension is available</p>";
} else {
    echo "<p style='color: red;'>❌ cURL extension not found</p>";
}

// Check if sockets are available
if (extension_loaded('sockets')) {
    echo "<p style='color: green;'>✅ Sockets extension is available</p>";
} else {
    echo "<p style='color: red;'>❌ Sockets extension not found</p>";
}

// Test SMTP connection
echo "<h3>SMTP Connection Test:</h3>";
try {
    $smtp = new PHPMailer(true);
    $smtp->isSMTP();
    $smtp->Host = $config['mail_host'];
    $smtp->SMTPAuth = true;
    $smtp->Username = $config['mail_username'];
    $smtp->Password = $config['mail_password'];
    $smtp->SMTPSecure = $config['mail_encryption'];
    $smtp->Port = $config['mail_port'];
    $smtp->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => $config['mail_verify_peer'] ?? true,
            'verify_peer_name' => $config['mail_verify_peer_name'] ?? true,
            'allow_self_signed' => $config['mail_allow_self_signed'] ?? false,
        )
    );
    
    // Test connection without sending
    $smtp->smtpConnect();
    echo "<p style='color: green;'>✅ SMTP connection successful</p>";
    $smtp->smtpClose();
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ SMTP connection failed: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><em>Test completed at " . date('Y-m-d H:i:s') . "</em></p>";
?>
