<?php
/**
 * Test CodeIgniter Application
 * This script tests the actual CodeIgniter application flow
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>HMS India - CodeIgniter Application Test</h2>";
echo "<hr>";

// Test 1: Check if we can access the main application
echo "<h3>1. Testing Main Application Access</h3>";

// Capture any output
ob_start();

// Include the main index.php
if (file_exists(__DIR__ . '/index.php')) {
    echo "✅ index.php exists<br>";
    
    // Test if we can include it without errors
    try {
        // Set up environment
        $_SERVER['CI_ENV'] = 'production';
        
        // Include the main application
        include __DIR__ . '/index.php';
        
        echo "✅ index.php included successfully<br>";
        
    } catch (Exception $e) {
        echo "❌ Error including index.php: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ index.php not found<br>";
}

$output = ob_get_clean();
echo "Output from index.php: " . htmlspecialchars($output) . "<br>";

// Test 2: Check base_url function
echo "<h3>2. Testing base_url() Function</h3>";

// Simulate CodeIgniter environment
define('BASEPATH', __DIR__ . '/system/');
define('APPPATH', __DIR__ . '/application/');
define('ENVIRONMENT', 'production');

// Load config
include_once __DIR__ . '/application/config/config.php';

// Check if base_url is defined
if (isset($config['base_url'])) {
    echo "✅ base_url config: " . $config['base_url'] . "<br>";
} else {
    echo "❌ base_url not defined in config<br>";
}

// Test 3: Check session status
echo "<h3>3. Testing Session Status</h3>";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    echo "✅ Session started<br>";
} else {
    echo "✅ Session already active<br>";
}

echo "Session ID: " . session_id() . "<br>";
echo "Session data: " . json_encode($_SESSION) . "<br>";

// Test 4: Test login simulation
echo "<h3>4. Testing Login Simulation</h3>";

// Simulate a successful login
$_SESSION['logged_administrator'] = array(
    'name' => 'IndiaIVF',
    'username' => 'ceo@indiaivf.in',
    'email' => 'ceo@indiaivf.in',
    'role' => 'administrator',
    'employee_number' => '1'
);

echo "✅ Test session set<br>";

// Test checklogin function
if (file_exists(__DIR__ . '/application/helpers/myhelper_helper.php')) {
    include_once __DIR__ . '/application/helpers/myhelper_helper.php';
    $logg = checklogin();
    echo "checklogin() result: " . json_encode($logg) . "<br>";
    
    if ($logg['status'] === true) {
        echo "✅ Login check passes<br>";
        
        // Test what would happen in dashboard
        echo "<h3>5. Testing Dashboard Logic</h3>";
        
        $logg2 = checklogin();
        if ($logg2['status'] === true) {
            echo "✅ Dashboard access should be granted<br>";
            echo "User role: " . $logg2['role'] . "<br>";
        } else {
            echo "❌ Dashboard access would be denied<br>";
        }
    } else {
        echo "❌ Login check fails<br>";
    }
} else {
    echo "❌ Helper file not found<br>";
}

// Test 5: Check for any redirect issues
echo "<h3>6. Checking for Redirect Issues</h3>";

// Check if headers have been sent
if (headers_sent($file, $line)) {
    echo "❌ Headers already sent from $file line $line<br>";
    echo "This would prevent redirects from working<br>";
} else {
    echo "✅ Headers not sent yet - redirects should work<br>";
}

// Check output buffer
if (ob_get_level() > 0) {
    echo "⚠️ Output buffer is active (level: " . ob_get_level() . ")<br>";
    echo "Buffer contents: " . ob_get_contents() . "<br>";
} else {
    echo "✅ No output buffer issues<br>";
}

// Test 6: Check if there are any fatal errors
echo "<h3>7. Checking for Fatal Errors</h3>";

$error_log = ini_get('error_log');
if ($error_log && file_exists($error_log)) {
    $errors = file_get_contents($error_log);
    $recent_errors = array_slice(explode("\n", $errors), -10);
    echo "Recent errors from log:<br>";
    foreach ($recent_errors as $error) {
        if (!empty(trim($error))) {
            echo "• " . htmlspecialchars($error) . "<br>";
        }
    }
} else {
    echo "No error log found or accessible<br>";
}

echo "<hr>";
echo "<p><strong>CodeIgniter application test completed!</strong></p>";
echo "<p><a href='index.php'>Try main application</a> | <a href='debug_login_flow.php'>Run debug login flow</a></p>";
?>
