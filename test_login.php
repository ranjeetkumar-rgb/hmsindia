<?php
/**
 * Simple Login Test Script
 * This script tests the login functionality without the full CodeIgniter framework
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>HMS India - Login Test</h2>";
echo "<hr>";

// Test 1: Check if we can include the helper
echo "<h3>1. Testing Helper Inclusion</h3>";
if (file_exists(__DIR__ . '/application/helpers/myhelper_helper.php')) {
    include_once __DIR__ . '/application/helpers/myhelper_helper.php';
    echo "✅ Helper file loaded successfully<br>";
} else {
    echo "❌ Helper file not found!<br>";
}

// Test 2: Test session functionality
echo "<h3>2. Testing Session Functionality</h3>";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    echo "✅ Session started successfully<br>";
} else {
    echo "✅ Session already active<br>";
}

// Test 3: Test checklogin function
echo "<h3>3. Testing checklogin() Function</h3>";
if (function_exists('checklogin')) {
    $logg = checklogin();
    echo "checklogin() result: " . json_encode($logg) . "<br>";
} else {
    echo "❌ checklogin() function not found!<br>";
}

// Test 4: Simulate login
echo "<h3>4. Simulating Login</h3>";
if (isset($_GET['simulate_login'])) {
    // Simulate setting session variables like the login process
    $_SESSION['logged_administrator'] = array(
        'name' => 'Test Administrator',
        'username' => 'admin@test.com',
        'email' => 'admin@test.com',
        'role' => 'administrator',
        'employee_number' => 'ADMIN001'
    );
    echo "✅ Test login session set<br>";
    echo "Session data: " . json_encode($_SESSION) . "<br>";
    
    // Test checklogin again
    $logg = checklogin();
    echo "checklogin() after simulation: " . json_encode($logg) . "<br>";
} else {
    echo "<a href='?simulate_login=1'>Click here to simulate login</a><br>";
}

// Test 5: Test session persistence
echo "<h3>5. Testing Session Persistence</h3>";
if (isset($_SESSION['logged_administrator'])) {
    echo "✅ Session data persists across requests<br>";
    echo "Current session ID: " . session_id() . "<br>";
} else {
    echo "ℹ️ No session data found (this is normal if you haven't simulated login)<br>";
}

echo "<hr>";
echo "<p><strong>Test completed!</strong></p>";
echo "<p><a href='index.php'>Go to main application</a> | <a href='session_test.php'>Run full session test</a></p>";
?>
