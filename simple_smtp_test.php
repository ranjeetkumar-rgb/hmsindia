<?php
/**
 * Simple SMTP Connection Test
 * Focused on testing connectivity issues
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Simple SMTP Connection Test</h2>";
echo "<hr>";

// Test configurations
$configs = [
    'staging' => [
        'host' => 'mail.indiaivf.website',
        'port' => 587,
        'username' => 'billings@indiaivf.website',
        'password' => 'qYlSbaXXsn&9'
    ],
    'gmail' => [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'username' => 'ranjeet.kumar@indiaivf.in',
        'password' => 'mslzfkpcdefvytld'
    ]
];

function testConnection($host, $port, $timeout = 10) {
    echo "Testing connection to {$host}:{$port}...<br>";
    
    $socket = @fsockopen($host, $port, $errno, $errstr, $timeout);
    if ($socket) {
        echo "✅ Connection successful<br>";
        
        // Read server greeting
        $response = fgets($socket, 1024);
        echo "Server greeting: " . trim($response) . "<br>";
        
        fclose($socket);
        return true;
    } else {
        echo "❌ Connection failed: {$errstr} (Error: {$errno})<br>";
        return false;
    }
}

function testMultiplePorts($host) {
    echo "<h3>Testing multiple ports for {$host}</h3>";
    $ports = [25, 587, 465, 2525];
    
    foreach ($ports as $port) {
        echo "Port {$port}: ";
        $socket = @fsockopen($host, $port, $errno, $errstr, 5);
        if ($socket) {
            echo "✅ Open<br>";
            fclose($socket);
        } else {
            echo "❌ Closed ({$errstr})<br>";
        }
    }
}

// Test 1: Basic connectivity
echo "<h3>1. Basic Connectivity Test</h3>";
foreach ($configs as $name => $config) {
    echo "<h4>{$name} Configuration</h4>";
    testConnection($config['host'], $config['port']);
    testMultiplePorts($config['host']);
    echo "<hr>";
}

// Test 2: DNS Resolution
echo "<h3>2. DNS Resolution Test</h3>";
$hosts = ['mail.indiaivf.website', 'smtp.gmail.com'];
foreach ($hosts as $host) {
    echo "Resolving {$host}...<br>";
    $ip = gethostbyname($host);
    if ($ip !== $host) {
        echo "✅ {$host} → {$ip}<br>";
    } else {
        echo "❌ {$host} DNS resolution failed<br>";
    }
}

// Test 3: Alternative ports for mail.indiaivf.website
echo "<h3>3. Alternative Ports for mail.indiaivf.website</h3>";
$alternative_ports = [25, 465, 2525, 26, 8025];
foreach ($alternative_ports as $port) {
    echo "Testing mail.indiaivf.website:{$port}...<br>";
    $socket = @fsockopen('mail.indiaivf.website', $port, $errno, $errstr, 5);
    if ($socket) {
        echo "✅ Port {$port} is open<br>";
        $response = fgets($socket, 1024);
        echo "Response: " . trim($response) . "<br>";
        fclose($socket);
    } else {
        echo "❌ Port {$port} failed: {$errstr}<br>";
    }
}

// Test 4: Gmail SMTP with proper PHPMailer
echo "<h3>4. Gmail SMTP Test with PHPMailer</h3>";
if (file_exists('application/smtpmailer/class.phpmailer.php')) {
    require_once 'application/smtpmailer/class.phpmailer.php';
    require_once 'application/smtpmailer/class.smtp.php';
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ranjeet.kumar@indiaivf.in';
    $mail->Password = 'mslzfkpcdefvytld';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPDebug = 2; // Enable debug output
    $mail->Timeout = 30;
    
    echo "Attempting Gmail SMTP connection...<br>";
    try {
        if ($mail->smtpConnect()) {
            echo "✅ Gmail SMTP connection successful!<br>";
            $mail->smtpClose();
        } else {
            echo "❌ Gmail SMTP connection failed!<br>";
        }
    } catch (Exception $e) {
        echo "❌ Gmail SMTP Error: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ PHPMailer not found<br>";
}

// Test 5: Check if mail.indiaivf.website is accessible via different methods
echo "<h3>5. mail.indiaivf.website Accessibility Check</h3>";

// Try ping (if available)
if (function_exists('exec')) {
    echo "Pinging mail.indiaivf.website...<br>";
    $ping_result = exec("ping -n 1 mail.indiaivf.website", $output, $return_var);
    if ($return_var === 0) {
        echo "✅ Ping successful<br>";
    } else {
        echo "❌ Ping failed<br>";
    }
}

// Try telnet simulation
echo "<br>Testing telnet to mail.indiaivf.website:25...<br>";
$socket = @fsockopen('mail.indiaivf.website', 25, $errno, $errstr, 10);
if ($socket) {
    echo "✅ Port 25 is accessible<br>";
    $response = fgets($socket, 1024);
    echo "SMTP Response: " . trim($response) . "<br>";
    fclose($socket);
} else {
    echo "❌ Port 25 not accessible: {$errstr}<br>";
}

echo "<hr>";
echo "<h3>Summary</h3>";
echo "<p><strong>Issues Found:</strong></p>";
echo "<ul>";
echo "<li>mail.indiaivf.website:587 - Connection timeout (server may be down or firewall blocking)</li>";
echo "<li>Gmail SMTP - Socket connects but PHPMailer needs proper SMTP class inclusion</li>";
echo "</ul>";

echo "<p><strong>Recommendations:</strong></p>";
echo "<ul>";
echo "<li>Check if mail.indiaivf.website server is running</li>";
echo "<li>Verify firewall settings allow outbound connections on port 587</li>";
echo "<li>Consider using port 25 for mail.indiaivf.website if available</li>";
echo "<li>Gmail SMTP should work with proper PHPMailer setup</li>";
echo "</ul>";

echo "<p><strong>Test completed at:</strong> " . date('Y-m-d H:i:s') . "</p>";
?>
