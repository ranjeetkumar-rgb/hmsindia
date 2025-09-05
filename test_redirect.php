<?php
/**
 * Test Redirect Issues
 * This script tests if redirects are working properly
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>HMS India - Test Redirect Issues</h2>";
echo "<hr>";

// Test 1: Check current state
echo "<h3>1. Current State Check</h3>";
echo "Current URL: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "HTTP Host: " . $_SERVER['HTTP_HOST'] . "<br>";
echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";

// Test 2: Check headers
echo "<h3>2. Headers Check</h3>";
if (headers_sent($file, $line)) {
    echo "❌ Headers already sent from $file line $line<br>";
} else {
    echo "✅ Headers not sent yet<br>";
}

// Test 3: Check output buffer
echo "<h3>3. Output Buffer Check</h3>";
$buffer_level = ob_get_level();
echo "Output buffer level: " . $buffer_level . "<br>";

if ($buffer_level > 0) {
    echo "⚠️ Output buffer is active<br>";
    echo "Buffer contents: " . ob_get_contents() . "<br>";
} else {
    echo "✅ No output buffer issues<br>";
}

// Test 4: Test simple redirect
echo "<h3>4. Testing Simple Redirect</h3>";

if (isset($_GET['test_redirect'])) {
    echo "Testing redirect in 3 seconds...<br>";
    echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
    echo "You should be redirected to index.php in 3 seconds...<br>";
} else {
    echo "<a href='?test_redirect=1'>Click here to test redirect</a><br>";
}

// Test 5: Test session
echo "<h3>5. Session Test</h3>";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    echo "✅ Session started<br>";
} else {
    echo "✅ Session already active<br>";
}

echo "Session ID: " . session_id() . "<br>";

// Set a test session
$_SESSION['test_redirect'] = 'working';
echo "Test session set<br>";

// Test 6: Check if we can access the main application
echo "<h3>6. Main Application Access Test</h3>";

// Test if index.php exists and is accessible
if (file_exists(__DIR__ . '/index.php')) {
    echo "✅ index.php exists<br>";
    
    // Test if we can include it
    try {
        // Capture any output
        ob_start();
        
        // Set environment
        $_SERVER['CI_ENV'] = 'production';
        
        // Include index.php
        include __DIR__ . '/index.php';
        
        $output = ob_get_clean();
        echo "✅ index.php included successfully<br>";
        echo "Output length: " . strlen($output) . " characters<br>";
        
        if (strlen($output) > 0) {
            echo "⚠️ index.php produced output (this might interfere with redirects):<br>";
            echo "<pre>" . htmlspecialchars(substr($output, 0, 500)) . "</pre>";
        }
        
    } catch (Exception $e) {
        echo "❌ Error including index.php: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ index.php not found<br>";
}

// Test 7: Check for any fatal errors
echo "<h3>7. Error Check</h3>";

$error_log = ini_get('error_log');
if ($error_log && file_exists($error_log)) {
    $errors = file_get_contents($error_log);
    $recent_errors = array_slice(explode("\n", $errors), -5);
    echo "Recent errors:<br>";
    foreach ($recent_errors as $error) {
        if (!empty(trim($error))) {
            echo "• " . htmlspecialchars($error) . "<br>";
        }
    }
} else {
    echo "No error log found<br>";
}

echo "<hr>";
echo "<p><strong>Redirect test completed!</strong></p>";
echo "<p><a href='index.php'>Try main application</a> | <a href='test_actual_login.php'>Test actual login</a></p>";
?>
