<?php
/**
 * Test Hook Functionality
 * This script tests if the session fix hook is working
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>HMS India - Hook Test</h2>";
echo "<hr>";

// Test 1: Check if hooks are enabled
echo "<h3>1. Checking Hook Configuration</h3>";
if (file_exists(__DIR__ . '/application/config/hooks.php')) {
    include_once __DIR__ . '/application/config/hooks.php';
    echo "✅ Hooks file exists<br>";
    if (isset($hook['enable_hooks']) && $hook['enable_hooks'] === TRUE) {
        echo "✅ Hooks are enabled<br>";
    } else {
        echo "❌ Hooks are disabled<br>";
    }
} else {
    echo "❌ Hooks file not found<br>";
}

// Test 2: Check if session fix hook exists
echo "<h3>2. Checking Session Fix Hook</h3>";
if (file_exists(__DIR__ . '/application/hooks/session_fix.php')) {
    echo "✅ Session fix hook file exists<br>";
} else {
    echo "❌ Session fix hook file not found<br>";
}

// Test 3: Test session functionality
echo "<h3>3. Testing Session Functionality</h3>";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    echo "✅ Session started successfully<br>";
} else {
    echo "✅ Session already active<br>";
}

// Test 4: Check session configuration
echo "<h3>4. Session Configuration</h3>";
echo "Session Status: " . session_status() . "<br>";
echo "Session Save Path: " . session_save_path() . "<br>";
echo "Session Name: " . session_name() . "<br>";

// Test 5: Check session directory
echo "<h3>5. Session Directory Check</h3>";
$session_path = __DIR__ . '/application/cache/sessions/';
echo "Session Path: " . $session_path . "<br>";
echo "Directory Exists: " . (is_dir($session_path) ? 'Yes' : 'No') . "<br>";
if (is_dir($session_path)) {
    echo "Directory Writable: " . (is_writable($session_path) ? 'Yes' : 'No') . "<br>";
    echo "Directory Permissions: " . substr(sprintf('%o', fileperms($session_path)), -4) . "<br>";
}

echo "<hr>";
echo "<p><strong>Hook test completed!</strong></p>";
echo "<p><a href='index.php'>Go to main application</a> | <a href='session_test.php'>Run full session test</a></p>";
?>
