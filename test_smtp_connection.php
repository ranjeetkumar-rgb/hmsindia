<?php
/**
 * SMTP Connection Test Script
 * Tests SMTP connectivity for different environments
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>SMTP Connection Test</h2>";
echo "<hr>";

// Test configurations for different environments
$test_configs = [
    'staging' => [
        'host' => 'smtp.gmail.com',
        'username' => 'ranjeet.kumar@indiaivf.in',
        'password' => 'mslzfkpcdefvytld',
        'port' => 587,
        'encryption' => 'tls',
        'from_email' => 'ranjeet.kumar@indiaivf.in',
        'from_name' => 'IndiaIVF (DEV)'
    ],
    'production_gmail' => [
        'host' => 'smtp.gmail.com',
        'username' => 'ranjeet.kumar@indiaivf.in',
        'password' => 'mslzfkpcdefvytld',
        'port' => 587,
        'encryption' => 'tls',
        'from_email' => 'ranjeet.kumar@indiaivf.in',
        'from_name' => 'IndiaIVF (DEV)'
    ],
    'production_live' => [
        'host' => 'mail.indiaivf.website',
        'username' => 'billings@indiaivf.website',
        'password' => 'qYlSbaXXsn&9',
        'port' => 587,
        'encryption' => 'tls',
        'from_email' => 'info@indiaivf.website',
        'from_name' => 'IndiaIVF'
    ]
];

// Function to test SMTP connection
function testSMTPConnection($config, $name) {
    echo "<h3>Testing: {$name}</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Setting</th><th>Value</th></tr>";
    echo "<tr><td>Host</td><td>{$config['host']}</td></tr>";
    echo "<tr><td>Port</td><td>{$config['port']}</td></tr>";
    echo "<tr><td>Encryption</td><td>{$config['encryption']}</td></tr>";
    echo "<tr><td>Username</td><td>{$config['username']}</td></tr>";
    echo "<tr><td>Password</td><td>***" . substr($config['password'], -3) . "</td></tr>";
    echo "<tr><td>From Email</td><td>{$config['from_email']}</td></tr>";
    echo "<tr><td>From Name</td><td>{$config['from_name']}</td></tr>";
    echo "</table>";
    
    // Test 1: Basic socket connection
    echo "<br><strong>Test 1: Basic Socket Connection</strong><br>";
    $socket = @fsockopen($config['host'], $config['port'], $errno, $errstr, 10);
    if ($socket) {
        echo "✅ Socket connection successful<br>";
        fclose($socket);
    } else {
        echo "❌ Socket connection failed: {$errstr} ({$errno})<br>";
        return false;
    }
    
    // Test 2: PHPMailer SMTP connection
    echo "<br><strong>Test 2: PHPMailer SMTP Connection</strong><br>";
    
    if (file_exists('application/smtpmailer/class.phpmailer.php')) {
        require_once 'application/smtpmailer/class.phpmailer.php';
        require_once 'application/smtpmailer/class.smtp.php';
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = $config['encryption'];
        $mail->Port = $config['port'];
        $mail->SMTPDebug = 0; // Set to 2 for verbose debugging
        $mail->Timeout = 10;
        
        try {
            if ($mail->smtpConnect()) {
                echo "✅ PHPMailer SMTP connection successful!<br>";
                $mail->smtpClose();
                return true;
            } else {
                echo "❌ PHPMailer SMTP connection failed!<br>";
                return false;
            }
        } catch (Exception $e) {
            echo "❌ PHPMailer Error: " . $e->getMessage() . "<br>";
            return false;
        }
    } else {
        echo "❌ PHPMailer not found<br>";
        return false;
    }
}

// Test 3: Simple SMTP test without PHPMailer
function testSimpleSMTP($config, $name) {
    echo "<br><strong>Test 3: Simple SMTP Test</strong><br>";
    
    $host = $config['host'];
    $port = $config['port'];
    $username = $config['username'];
    $password = $config['password'];
    
    $socket = @fsockopen($host, $port, $errno, $errstr, 10);
    if (!$socket) {
        echo "❌ Cannot connect to {$host}:{$port}<br>";
        return false;
    }
    
    // Read initial response
    $response = fgets($socket, 1024);
    echo "Server response: " . trim($response) . "<br>";
    
    // Send EHLO command
    fputs($socket, "EHLO localhost\r\n");
    $response = fgets($socket, 1024);
    echo "EHLO response: " . trim($response) . "<br>";
    
    // Start TLS if needed
    if ($config['encryption'] === 'tls') {
        fputs($socket, "STARTTLS\r\n");
        $response = fgets($socket, 1024);
        echo "STARTTLS response: " . trim($response) . "<br>";
        
        if (strpos($response, '220') === 0) {
            echo "✅ STARTTLS successful<br>";
        } else {
            echo "❌ STARTTLS failed<br>";
            fclose($socket);
            return false;
        }
    }
    
    // Send AUTH LOGIN
    fputs($socket, "AUTH LOGIN\r\n");
    $response = fgets($socket, 1024);
    echo "AUTH LOGIN response: " . trim($response) . "<br>";
    
    if (strpos($response, '334') === 0) {
        // Send username
        fputs($socket, base64_encode($username) . "\r\n");
        $response = fgets($socket, 1024);
        echo "Username response: " . trim($response) . "<br>";
        
        if (strpos($response, '334') === 0) {
            // Send password
            fputs($socket, base64_encode($password) . "\r\n");
            $response = fgets($socket, 1024);
            echo "Password response: " . trim($response) . "<br>";
            
            if (strpos($response, '235') === 0) {
                echo "✅ SMTP Authentication successful!<br>";
                fclose($socket);
                return true;
            } else {
                echo "❌ SMTP Authentication failed<br>";
                fclose($socket);
                return false;
            }
        } else {
            echo "❌ Username not accepted<br>";
            fclose($socket);
            return false;
        }
    } else {
        echo "❌ AUTH LOGIN not supported<br>";
        fclose($socket);
        return false;
    }
}

// Run tests for each configuration
foreach ($test_configs as $name => $config) {
    echo "<hr>";
    $result1 = testSMTPConnection($config, $name);
    $result2 = testSimpleSMTP($config, $name);
    
    echo "<br><strong>Overall Result for {$name}:</strong> ";
    if ($result1 && $result2) {
        echo "<span style='color: green;'>✅ ALL TESTS PASSED</span><br>";
    } else {
        echo "<span style='color: red;'>❌ SOME TESTS FAILED</span><br>";
    }
}

echo "<hr>";
echo "<h3>Network Diagnostics</h3>";

// Test DNS resolution
echo "<strong>DNS Resolution Test:</strong><br>";
$hosts_to_test = ['mail.indiaivf.website', 'smtp.gmail.com'];
foreach ($hosts_to_test as $host) {
    $ip = gethostbyname($host);
    if ($ip !== $host) {
        echo "✅ {$host} resolves to {$ip}<br>";
    } else {
        echo "❌ {$host} DNS resolution failed<br>";
    }
}

// Test port connectivity
echo "<br><strong>Port Connectivity Test:</strong><br>";
$ports_to_test = [
    ['mail.indiaivf.website', 587],
    ['mail.indiaivf.website', 25],
    ['smtp.gmail.com', 587],
    ['smtp.gmail.com', 465]
];

foreach ($ports_to_test as $test) {
    $host = $test[0];
    $port = $test[1];
    $socket = @fsockopen($host, $port, $errno, $errstr, 5);
    if ($socket) {
        echo "✅ {$host}:{$port} is open<br>";
        fclose($socket);
    } else {
        echo "❌ {$host}:{$port} is closed or filtered ({$errstr})<br>";
    }
}

echo "<hr>";
echo "<p><strong>Test completed at:</strong> " . date('Y-m-d H:i:s') . "</p>";
echo "<p><em>Note: This test file should be removed after testing for security reasons.</em></p>";
?>
