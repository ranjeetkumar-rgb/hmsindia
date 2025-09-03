<?php
/**
 * Production Database Connection Test
 * This script tests the database connection using the same configuration
 * that your CodeIgniter application will use.
 */

echo "=== Production Database Connection Test ===\n";

// Load environment variables
if (file_exists('.env')) {
    $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

// Load production environment variables
if (file_exists('env.production')) {
    $lines = file('env.production', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

// Set environment to production
putenv('ENVIRONMENT=production');

// Get database configuration
$hostname = getenv('DB_HOST') ?: '139.84.175.208';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: 'root';
$database = getenv('DB_NAME') ?: 'stagin_hms_db';
$environment = getenv('ENVIRONMENT') ?: 'production';

echo "Environment: " . $environment . "\n";
echo "Host: " . $hostname . "\n";
echo "Username: " . $username . "\n";
echo "Database: " . $database . "\n";
echo "Password: " . (empty($password) ? '(empty)' : '****') . "\n";
echo "===============================\n";

// Test database connection
try {
    echo "1. Testing MySQL connection...\n";
    
    $mysqli = new mysqli($hostname, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        throw new Exception("Connection failed: " . $mysqli->connect_error);
    }
    
    echo "✓ Database connection successful!\n";
    
    // Test a simple query
    echo "2. Testing database query...\n";
    $result = $mysqli->query("SELECT 1 as test");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "✓ Query test successful! Result: " . $row['test'] . "\n";
    } else {
        throw new Exception("Query failed: " . $mysqli->error);
    }
    
    // Check if database.php exists
    echo "3. Checking database.php file...\n";
    $db_config_path = 'application/config/database.php';
    if (file_exists($db_config_path)) {
        echo "✓ database.php file exists at: " . $db_config_path . "\n";
        
        // Check if the file is readable
        if (is_readable($db_config_path)) {
            echo "✓ database.php file is readable\n";
        } else {
            echo "✗ database.php file is not readable (permission issue)\n";
        }
    } else {
        echo "✗ database.php file does NOT exist at: " . $db_config_path . "\n";
        echo "  Current working directory: " . getcwd() . "\n";
        echo "  Files in application/config/: " . implode(', ', scandir('application/config/')) . "\n";
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n=== Test completed successfully! ===\n";
?>
