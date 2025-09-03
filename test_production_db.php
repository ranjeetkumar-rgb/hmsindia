<?php
// Test database connection for production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set environment to production
putenv('ENVIRONMENT=production');
putenv('DB_HOST=localhost');
putenv('DB_USER=hmaadmin');
putenv('DB_PASSWORD=Admin@2025!');
putenv('DB_NAME=stagin_hms_db');

echo "<h2>Database Connection Test</h2>";

// Test 1: Direct MySQL connection
echo "<h3>Test 1: Direct MySQL Connection</h3>";
$host = 'localhost';
$username = 'hmaadmin';
$password = 'Admin@2025!';
$database = 'stagin_hms_db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Direct PDO connection successful!<br>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = '$database'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✅ Database '$database' has {$result['count']} tables<br>";
    
} catch (PDOException $e) {
    echo "❌ Direct PDO connection failed: " . $e->getMessage() . "<br>";
}

// Test 2: MySQLi connection
echo "<h3>Test 2: MySQLi Connection</h3>";
try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        echo "❌ MySQLi connection failed: " . $mysqli->connect_error . "<br>";
    } else {
        echo "✅ MySQLi connection successful!<br>";
        
        // Test a simple query
        $result = $mysqli->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = '$database'");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "✅ Database '$database' has {$row['count']} tables<br>";
        }
        $mysqli->close();
    }
} catch (Exception $e) {
    echo "❌ MySQLi connection failed: " . $e->getMessage() . "<br>";
}

// Test 3: Environment variables
echo "<h3>Test 3: Environment Variables</h3>";
echo "ENVIRONMENT: " . getenv('ENVIRONMENT') . "<br>";
echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
echo "DB_USER: " . getenv('DB_USER') . "<br>";
echo "DB_PASSWORD: " . (getenv('DB_PASSWORD') ? '[SET]' : '[NOT SET]') . "<br>";
echo "DB_NAME: " . getenv('DB_NAME') . "<br>";

// Test 4: CodeIgniter Database Config
echo "<h3>Test 4: CodeIgniter Database Configuration</h3>";
$environment = getenv('ENVIRONMENT') ?: 'development';
echo "Current environment: $environment<br>";

if ($environment === 'production') {
    $db_config = array(
        'hostname' => getenv('DB_HOST') ?: 'localhost',
        'username' => getenv('DB_USER') ?: 'hmaadmin',
        'password' => getenv('DB_PASSWORD') ?: 'Admin@2025!',
        'database' => getenv('DB_NAME') ?: 'stagin_hms_db',
    );
} else {
    $db_config = array(
        'hostname' => getenv('DB_HOST') ?: 'localhost',
        'username' => getenv('DB_USER') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
        'database' => getenv('DB_NAME') ?: 'hmsindiaivf',
    );
}

echo "Database config being used:<br>";
echo "Hostname: " . $db_config['hostname'] . "<br>";
echo "Username: " . $db_config['username'] . "<br>";
echo "Password: " . ($db_config['password'] ? '[SET]' : '[NOT SET]') . "<br>";
echo "Database: " . $db_config['database'] . "<br>";
?>