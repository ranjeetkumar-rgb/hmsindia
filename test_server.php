<?php
// Simple test file to check server configuration
echo "<h1>Server Test</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Script Path: " . __FILE__ . "</p>";

// Test database connection
    $host = 'localhost';
    $port = '3306';
    $username = 'hmaadmin';
    $password =  'Admin@2025!';
    $database = 'stagin_hms_db';

// Test file permissions
echo "<h2>File Permissions Test</h2>";
$test_dirs = [
    'application/cache',
    'application/cache/sessions',
    'application/logs'
];

foreach ($test_dirs as $dir) {
    if (is_dir($dir)) {
        if (is_writable($dir)) {
            echo "<p style='color: green;'>$dir - Writable</p>";
        } else {
            echo "<p style='color: red;'>$dir - Not writable</p>";
        }
    } else {
        echo "<p style='color: orange;'>$dir - Directory does not exist</p>";
    }
}

// Test environment detection
echo "<h2>Environment Test</h2>";
echo "<p>HTTP_HOST: " . ($_SERVER['HTTP_HOST'] ?? 'Not set') . "</p>";
echo "<p>CI_ENV: " . ($_SERVER['CI_ENV'] ?? 'Not set') . "</p>";
echo "<p>ENVIRONMENT: " . (getenv('ENVIRONMENT') ?: 'Not set') . "</p>";

// Test CodeIgniter constants
echo "<h2>CodeIgniter Test</h2>";
if (defined('BASEPATH')) {
    echo "<p style='color: green;'>BASEPATH: " . BASEPATH . "</p>";
} else {
    echo "<p style='color: red;'>BASEPATH not defined</p>";
}

if (defined('APPPATH')) {
    echo "<p style='color: green;'>APPPATH: " . APPPATH . "</p>";
} else {
    echo "<p style='color: red;'>APPPATH not defined</p>";
}
?>
