<?php
// Comprehensive live server diagnostic
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Live Server Database Diagnostic</h1>";
echo "<hr>";

// 1. Check current environment detection
echo "<h2>1. Environment Detection</h2>";
$environment = getenv('ENVIRONMENT') ?: 'development';
echo "Current environment detected: <strong>$environment</strong><br>";
echo "getenv('ENVIRONMENT'): " . (getenv('ENVIRONMENT') ?: 'NOT SET') . "<br>";
echo "ENV variable: " . ($_ENV['ENVIRONMENT'] ?? 'NOT SET') . "<br>";
echo "SERVER environment: " . ($_SERVER['ENVIRONMENT'] ?? 'NOT SET') . "<br>";

// 2. Show what database config will be used
echo "<h2>2. Database Configuration</h2>";
if ($environment === 'production') {
    $db_config = array(
        'hostname' => getenv('DB_HOST') ?: 'localhost',
        'username' => getenv('DB_USER') ?: 'hmaadmin',
        'password' => getenv('DB_PASSWORD') ?: 'Admin@2025!',
        'database' => getenv('DB_NAME') ?: 'stagin_hms_db',
    );
    echo "Using <strong>PRODUCTION</strong> configuration:<br>";
} else {
    $db_config = array(
        'hostname' => getenv('DB_HOST') ?: 'localhost',
        'username' => getenv('DB_USER') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
        'database' => getenv('DB_NAME') ?: 'hmsindiaivf',
    );
    echo "Using <strong>DEVELOPMENT</strong> configuration:<br>";
}

echo "Hostname: " . $db_config['hostname'] . "<br>";
echo "Username: " . $db_config['username'] . "<br>";
echo "Password: " . ($db_config['password'] ? '[SET - ' . strlen($db_config['password']) . ' chars]' : '[NOT SET]') . "<br>";
echo "Database: " . $db_config['database'] . "<br>";

// 3. Test MySQL connection with current config
echo "<h2>3. MySQL Connection Test</h2>";
$host = $db_config['hostname'];
$username = $db_config['username'];
$password = $db_config['password'];
$database = $db_config['database'];

// Test MySQLi connection
echo "<h3>MySQLi Connection:</h3>";
try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        echo "❌ <strong>Connection failed:</strong> " . $mysqli->connect_error . "<br>";
        echo "Error code: " . $mysqli->connect_errno . "<br>";
        
        // Try connecting without database to test credentials
        echo "<h4>Testing credentials without database:</h4>";
        $mysqli_test = new mysqli($host, $username, $password);
        if ($mysqli_test->connect_error) {
            echo "❌ <strong>Credential test failed:</strong> " . $mysqli_test->connect_error . "<br>";
        } else {
            echo "✅ <strong>Credentials are correct!</strong><br>";
            echo "❌ <strong>Database '$database' does not exist or user doesn't have access</strong><br>";
            
            // List available databases
            $result = $mysqli_test->query("SHOW DATABASES");
            echo "<h4>Available databases:</h4>";
            while ($row = $result->fetch_array()) {
                echo "- " . $row[0] . "<br>";
            }
        }
        $mysqli_test->close();
    } else {
        echo "✅ <strong>Connection successful!</strong><br>";
        
        // Test a simple query
        $result = $mysqli->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = '$database'");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "✅ Database '$database' has {$row['count']} tables<br>";
        }
        
        // Show user privileges
        $result = $mysqli->query("SHOW GRANTS FOR CURRENT_USER()");
        echo "<h4>Current user privileges:</h4>";
        while ($row = $result->fetch_array()) {
            echo "- " . $row[0] . "<br>";
        }
    }
    $mysqli->close();
} catch (Exception $e) {
    echo "❌ <strong>Exception:</strong> " . $e->getMessage() . "<br>";
}

// 4. Test PDO connection
echo "<h3>PDO Connection:</h3>";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ <strong>PDO connection successful!</strong><br>";
} catch (PDOException $e) {
    echo "❌ <strong>PDO connection failed:</strong> " . $e->getMessage() . "<br>";
}

// 5. Check if we can connect as root (common fallback)
echo "<h2>4. Root User Test</h2>";
try {
    $mysqli_root = new mysqli($host, 'root', '', $database);
    if ($mysqli_root->connect_error) {
        echo "❌ Root user connection failed: " . $mysqli_root->connect_error . "<br>";
    } else {
        echo "✅ Root user connection successful!<br>";
        echo "⚠️ <strong>Warning:</strong> Root user can connect. Consider using the correct user or creating the 'hmaadmin' user.<br>";
    }
    $mysqli_root->close();
} catch (Exception $e) {
    echo "❌ Root user test failed: " . $e->getMessage() . "<br>";
}

// 6. Server information
echo "<h2>5. Server Information</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "<br>";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "<br>";
echo "Script Path: " . __FILE__ . "<br>";

// 7. Environment variables dump
echo "<h2>6. All Environment Variables</h2>";
echo "<pre>";
foreach ($_ENV as $key => $value) {
    if (strpos($key, 'DB_') === 0 || $key === 'ENVIRONMENT') {
        echo "$key = $value\n";
    }
}
echo "</pre>";

echo "<hr>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ul>";
echo "<li>If environment is 'development', you need to set ENVIRONMENT=production on your server</li>";
echo "<li>If credentials are wrong, check your MySQL user and password</li>";
echo "<li>If database doesn't exist, create it or use the correct database name</li>";
echo "<li>If user doesn't have permissions, grant them access to the database</li>";
echo "</ul>";
?>
