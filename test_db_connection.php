<?php
/**
 * Database Connection Test Script
 * Run this on your live server to test database connectivity
 */

// Simple logging function
function log_message($level, $message) {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[$timestamp] [$level] $message" . PHP_EOL;
    
    // Write to log file
    $log_file = 'db_test.log';
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
    
    // Also output to console with timestamp
    echo "[$timestamp] [$level] $message" . PHP_EOL;
}

// Load environment variables
$env_file = 'env.production';
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Database configuration
$host = $_ENV['DB_HOST'] ?? '139.84.175.208';
$port = $_ENV['DB_PORT'] ?? '3306';
$username = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? 'root';
$database = $_ENV['DB_NAME'] ?? 'stagin_hms_db';

echo "=== Database Connection Test ===\n";
echo "Host: $host\n";
echo "Port: $port\n";
echo "Username: $username\n";
echo "Database: $database\n";
echo "Password: " . str_repeat('*', strlen($password)) . "\n";
echo "===============================\n\n";

log_message('info', 'Database connection test started');
log_message('info', 'Host: ' . $host);
log_message('info', 'Port: ' . $port);
log_message('info', 'Username: ' . $username);
log_message('info', 'Database: ' . $database);
log_message('info', 'Password: ' . str_repeat('*', strlen($password)));

// Test 1: Basic connection
echo "1. Testing basic MySQL connection...\n";
try {
    $dsn = "mysql:host=$host;port=$port;charset=utf8";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "✅ Basic connection successful!\n";
    log_message('info', 'Basic connection successful!');
    
    // Test 2: Check if database exists
    echo "\n2. Checking if database '$database' exists...\n";
    $stmt = $pdo->query("SHOW DATABASES LIKE '$database'");
    $db_exists = $stmt->fetch();
    log_message('info', 'Database exists: ' . ($db_exists ? 'true' : 'false'));
    
    if ($db_exists) {
        echo "✅ Database '$database' exists!\n";
        log_message('info', 'Database exists: ' . ($db_exists ? 'true' : 'false'));
        
        // Test 3: Connect to specific database
        echo "\n3. Testing connection to database '$database'...\n";
        $dsn_db = "mysql:host=$host;port=$port;dbname=$database;charset=utf8";
        $pdo_db = new PDO($dsn_db, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        echo "✅ Database connection successful!\n";
        log_message('info', 'Database connection successful!');
        
        // Test 4: Check tables
        echo "\n4. Checking tables in database...\n";
        $stmt = $pdo_db->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        log_message('info', 'Tables found: ' . count($tables));
        
        if (count($tables) > 0) {
            echo "✅ Found " . count($tables) . " tables:\n";
            foreach ($tables as $table) {
                echo "   - $table\n";
            }
        } else {
            echo "⚠️  No tables found in database. Database is empty.\n";
            log_message('info', 'No tables found in database. Database is empty.');
        }
        
        // Test 5: Test a simple query
        echo "\n5. Testing simple query...\n";
        $stmt = $pdo_db->query("SELECT 1 as test");
        $result = $stmt->fetch();
        if ($result && $result['test'] == 1) {
            echo "✅ Query test successful!\n";
        }

        
    } else {
        echo "❌ Database '$database' does not exist!\n";
        echo "\nAvailable databases:\n";
        $stmt = $pdo->query("SHOW DATABASES");
        $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($databases as $db) {
            echo "   - $db\n";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
    echo "Error Code: " . $e->getCode() . "\n";
}

echo "\n=== Test Complete ===\n";
?>
