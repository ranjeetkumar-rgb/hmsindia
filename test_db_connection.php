<?php
/**
 * Fast Database Connection Test Script
 * Minimal overhead, maximum speed for live server testing
 */

// Set strict time limits
set_time_limit(10); // 10 seconds max
ini_set('max_execution_time', 10);

// Load environment variables quickly
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

echo "=== Fast DB Connection Test ===\n";
echo "Host: $host | DB: $database\n";
echo "===============================\n";

$start_time = microtime(true);

try {
    // Single optimized connection with timeouts
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5, // 5 second connection timeout
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION wait_timeout=5",
        PDO::ATTR_PERSISTENT => false, // No persistent connections
    ]);
    
    // Quick test query
    $stmt = $pdo->query("SELECT 1 as test, NOW() as current_time");
    $result = $stmt->fetch();
    
    $end_time = microtime(true);
    $execution_time = round(($end_time - $start_time) * 1000, 2);
    
    echo "✅ Connection SUCCESS!\n";
    echo "✅ Query test: " . $result['test'] . "\n";
    echo "✅ Server time: " . $result['current_time'] . "\n";
    echo "✅ Execution time: {$execution_time}ms\n";
    
    // Quick table count (limit to 1 for speed)
    $stmt = $pdo->query("SELECT COUNT(*) as table_count FROM information_schema.tables WHERE table_schema = '$database'");
    $table_count = $stmt->fetch()['table_count'];
    echo "✅ Tables found: $table_count\n";
    
} catch (PDOException $e) {
    $end_time = microtime(true);
    $execution_time = round(($end_time - $start_time) * 1000, 2);
    
    echo "❌ Connection FAILED!\n";
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "❌ Code: " . $e->getCode() . "\n";
    echo "❌ Time: {$execution_time}ms\n";
}

echo "\n=== Test Complete ===\n";
?>