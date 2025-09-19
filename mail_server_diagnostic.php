<?php
/**
 * Mail Server Diagnostic Tool
 * Checks mail.indiaivf.website server status and configuration
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Mail Server Diagnostic Tool</h2>";
echo "<hr>";

$mail_server = 'mail.indiaivf.website';

echo "<h3>1. Server Status Check</h3>";

// Check if server responds to ping
echo "Pinging {$mail_server}...<br>";
if (function_exists('exec')) {
    $ping_cmd = "ping -n 1 {$mail_server}";
    exec($ping_cmd, $ping_output, $ping_return);
    if ($ping_return === 0) {
        echo "✅ Server is reachable via ping<br>";
        echo "Ping output: " . implode('<br>', $ping_output) . "<br>";
    } else {
        echo "❌ Server is not reachable via ping<br>";
    }
} else {
    echo "⚠️ exec() function not available for ping test<br>";
}

// Check DNS resolution
echo "<br>Checking DNS resolution...<br>";
$ip = gethostbyname($mail_server);
if ($ip !== $mail_server) {
    echo "✅ DNS resolution successful: {$mail_server} → {$ip}<br>";
} else {
    echo "❌ DNS resolution failed<br>";
}

// Check reverse DNS
echo "<br>Checking reverse DNS...<br>";
$hostname = gethostbyaddr($ip);
if ($hostname !== $ip) {
    echo "✅ Reverse DNS: {$ip} → {$hostname}<br>";
} else {
    echo "⚠️ Reverse DNS not configured<br>";
}

echo "<hr>";

echo "<h3>2. Port Connectivity Test</h3>";

$ports_to_test = [
    25 => 'SMTP (Standard)',
    587 => 'SMTP (Submission)',
    465 => 'SMTPS (SSL)',
    2525 => 'SMTP (Alternative)',
    26 => 'SMTP (Alternative)',
    8025 => 'SMTP (Alternative)'
];

foreach ($ports_to_test as $port => $description) {
    echo "Testing port {$port} ({$description})...<br>";
    $socket = @fsockopen($mail_server, $port, $errno, $errstr, 10);
    if ($socket) {
        echo "✅ Port {$port} is open<br>";
        
        // Try to read server response
        $response = fgets($socket, 1024);
        echo "Server response: " . trim($response) . "<br>";
        
        // Check if it's an SMTP server
        if (strpos($response, '220') === 0) {
            echo "✅ This appears to be an SMTP server<br>";
            
            // Try EHLO command
            fputs($socket, "EHLO test.local\r\n");
            $ehlo_response = fgets($socket, 1024);
            echo "EHLO response: " . trim($ehlo_response) . "<br>";
        }
        
        fclose($socket);
        echo "<br>";
    } else {
        echo "❌ Port {$port} is closed or filtered: {$errstr}<br><br>";
    }
}

echo "<hr>";

echo "<h3>3. Network Troubleshooting</h3>";

// Check if we can reach the server at all
echo "Testing basic connectivity...<br>";
$test_socket = @fsockopen($mail_server, 80, $errno, $errstr, 5);
if ($test_socket) {
    echo "✅ Server responds on port 80 (HTTP)<br>";
    fclose($test_socket);
} else {
    echo "❌ Server does not respond on port 80<br>";
}

// Check if it's a firewall issue
echo "<br>Testing common web ports...<br>";
$web_ports = [80, 443, 8080, 8443];
foreach ($web_ports as $port) {
    $socket = @fsockopen($mail_server, $port, $errno, $errstr, 3);
    if ($socket) {
        echo "✅ Port {$port} is open<br>";
        fclose($socket);
    } else {
        echo "❌ Port {$port} is closed<br>";
    }
}

echo "<hr>";

echo "<h3>4. Alternative Mail Server Suggestions</h3>";

echo "<p>If mail.indiaivf.website is not working, consider these alternatives:</p>";
echo "<ul>";
echo "<li><strong>Gmail SMTP:</strong> smtp.gmail.com:587 (TLS) - Currently working in your config</li>";
echo "<li><strong>Outlook SMTP:</strong> smtp-mail.outlook.com:587 (TLS)</li>";
echo "<li><strong>Yahoo SMTP:</strong> smtp.mail.yahoo.com:587 (TLS)</li>";
echo "<li><strong>Custom SMTP:</strong> Contact your hosting provider for SMTP settings</li>";
echo "</ul>";

echo "<hr>";

echo "<h3>5. Current Configuration Analysis</h3>";

echo "<h4>Staging Configuration (Not Working):</h4>";
echo "<ul>";
echo "<li>Host: mail.indiaivf.website</li>";
echo "<li>Port: 587</li>";
echo "<li>Status: ❌ Connection timeout</li>";
echo "<li>Issue: Server not responding or firewall blocking</li>";
echo "</ul>";

echo "<h4>Production Configuration (Gmail - Should Work):</h4>";
echo "<ul>";
echo "<li>Host: smtp.gmail.com</li>";
echo "<li>Port: 587</li>";
echo "<li>Status: ✅ Socket connects, PHPMailer needs fix</li>";
echo "<li>Issue: Missing SMTP class in PHPMailer</li>";
echo "</ul>";

echo "<hr>";

echo "<h3>6. Recommended Actions</h3>";
echo "<ol>";
echo "<li><strong>Immediate:</strong> Use Gmail SMTP for production (fix PHPMailer SMTP class issue)</li>";
echo "<li><strong>Short-term:</strong> Contact hosting provider about mail.indiaivf.website server status</li>";
echo "<li><strong>Long-term:</strong> Set up proper mail server or use reliable SMTP service</li>";
echo "</ol>";

echo "<p><strong>Diagnostic completed at:</strong> " . date('Y-m-d H:i:s') . "</p>";
?>
