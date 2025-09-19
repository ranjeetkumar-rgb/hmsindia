<?php
/**
 * CORRECTED SMTP Connection and Sending Test Script
 * This script will provide clear PASS/FAIL results for different connection types.
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Corrected SMTP Connection & Sending Test</h2>";
echo "<p>This script will test both connectivity and authentication for different configurations.</p>";
echo "<hr>";

// Ensure PHPMailer classes are available
// You must have PHPMailer installed and these paths correct for the script to work.
if (file_exists('application/smtpmailer/class.phpmailer.php')) {
    require_once 'application/smtpmailer/class.phpmailer.php';
    require_once 'application/smtpmailer/class.smtp.php';
} else {
    echo "<h3 style='color: red;'>❌ ERROR: PHPMailer files not found. Please check the paths.</h3>";
    exit;
}

// Test configurations
$test_configs = [
    'Gmail / Google Workspace (TLS)' => [
        'host' => 'smtp-relay.gmail.com', // or 'smtp-relay.gmail.com' for Google Workspace
        'username' => 'ranjeet.kumar@indiaivf.in',
        'password' => 'mslzfkpcdefvytld', // Use App Password
        'port' => 587,
        'secure' => 'tls',
        'from_email' => 'ranjeet.kumar@indiaivf.in',
        'from_name' => 'IndiaIVF Test'
    ],
    'Gmail / Google Workspace (SSL)' => [
        'host' => 'smtp-relay.gmail.com',
        'username' => 'ranjeet.kumar@indiaivf.in',
        'password' => 'mslzfkpcdefvytld',
        'port' => 465,
        'secure' => 'ssl',
        'from_email' => 'ranjeet.kumar@indiaivf.in',
        'from_name' => 'IndiaIVF Test'
    ],
    'Mail.IndiaIVF.website' => [
        'host' => 'mail.indiaivf.website',
        'username' => 'ranjeet.kumar@indiaivf.in',
        'password' => 'mslzfkpcdefvytld', // Use your mail server password
        'port' => 587,
        'secure' => 'tls',
        'from_email' => 'info@indiaivf.website',
        'from_name' => 'IndiaIVF'
    ]
];

// Function to run a full PHPMailer test
function testPHPMailer($config, $name) {
    echo "<h3>Testing: {$name}</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Setting</th><th>Value</th></tr>";
    echo "<tr><td>Host</td><td>{$config['host']}</td></tr>";
    echo "<tr><td>Port</td><td>{$config['port']}</td></tr>";
    echo "<tr><td>Security</td><td>{$config['secure']}</td></tr>";
    echo "<tr><td>Username</td><td>{$config['username']}</td></tr>";
    echo "<tr><td>From Email</td><td>{$config['from_email']}</td></tr>";
    echo "</table><br>";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['username'];
        $mail->Password   = $config['password'];
        $mail->SMTPSecure = $config['secure'];
        $mail->Port       = $config['port'];
        $mail->SMTPDebug  = 2; // Enable verbose debug output
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress('ranjeet.kumar@indiaivf.in', 'Ranjeet'); // Test recipient
        $mail->isHTML(true);
        $mail->Subject = 'SMTP Test from ' . $name;
        $mail->Body    = 'This is a **test email** sent from the Vultr server via ' . $name . '.';

        if ($mail->send()) {
            echo "<p style='color: green; font-weight: bold;'>✅ SUCCESS: Email sent successfully!</p>";
        } else {
            echo "<p style='color: red; font-weight: bold;'>❌ FAIL: Email could not be sent.</p>";
            echo "<p>Mailer Error: " . $mail->ErrorInfo . "</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red; font-weight: bold;'>❌ EXCEPTION: An error occurred.</p>";
        echo "<p>Mailer Error: " . $e->getMessage() . "</p>";
    }
}

// Run tests
foreach ($test_configs as $name => $config) {
    echo "<hr>";
    testPHPMailer($config, $name);
}

echo "<hr>";
echo "<p><strong>Test completed at:</strong> " . date('Y-m-d H:i:s') . "</p>";
echo "<p><em>Note: This test file should be removed after testing for security reasons.</em></p>";
?>