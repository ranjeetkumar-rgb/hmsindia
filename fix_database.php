<?php
/**
 * Database Connection Fix for HMS India
 * This script helps fix common database connection issues
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>HMS India - Database Connection Fix</h2>";
echo "<hr>";

// Test current connection
echo "<h3>1. Testing Current Database Connection</h3>";

$environment = 'development';
if (isset($_SERVER['HTTP_HOST'])) {
    $host = $_SERVER['HTTP_HOST'];
    if (strpos($host, '139.84.175.208') !== false || 
        strpos($host, 'indiaivf.website') !== false ||
        strpos($host, 'hmsindia') !== false) {
        $environment = 'production';
    }
}

switch ($environment) {
    case 'production':
        $db_host = 'localhost';
        $db_user = 'hmaadmin';
        $db_pass = 'Admin@2025!';
        $db_name = 'stagin_hms_db';
        break;
    default:
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'hmsindiaivf';
        break;
}

echo "Environment: " . $environment . "<br>";
echo "Host: " . $db_host . "<br>";
echo "User: " . $db_user . "<br>";
echo "Database: " . $db_name . "<br>";

// Test connection
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    echo "❌ Connection failed: " . $mysqli->connect_error . "<br>";
    
    // Try alternative connections
    echo "<h3>2. Trying Alternative Connections</h3>";
    
    // Try with different host
    $alt_hosts = ['127.0.0.1', 'localhost', '139.84.175.208'];
    foreach ($alt_hosts as $alt_host) {
        echo "Trying host: " . $alt_host . "<br>";
        $test_mysqli = new mysqli($alt_host, $db_user, $db_pass, $db_name);
        if (!$test_mysqli->connect_error) {
            echo "✅ Connection successful with host: " . $alt_host . "<br>";
            $mysqli = $test_mysqli;
            break;
        } else {
            echo "❌ Failed: " . $test_mysqli->connect_error . "<br>";
        }
    }
} else {
    echo "✅ Database connection successful!<br>";
}

if (!$mysqli->connect_error) {
    echo "<h3>3. Database Status</h3>";
    echo "MySQL Version: " . $mysqli->server_info . "<br>";
    echo "Connection ID: " . $mysqli->thread_id . "<br>";
    
    // Check if we can create a test user
    echo "<h3>4. Testing User Creation</h3>";
    
    // Create a test user for login
    $test_email = 'test@indiaivf.in';
    $test_password = md5('test123');
    $test_name = 'Test User';
    $test_role = 'administrator';
    
    // Check if test user exists
    $result = $mysqli->query("SELECT * FROM hms_employees WHERE username = '$test_email'");
    if ($result && $result->num_rows > 0) {
        echo "✅ Test user already exists<br>";
    } else {
        // Create test user
        $sql = "INSERT INTO hms_employees (employee_number, name, username, email, password, role, status, center_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $employee_number = time() . rand(1000, 9999);
        $status = '1';
        $center_id = '0';
        
        $stmt->bind_param("ssssssss", $employee_number, $test_name, $test_email, $test_email, $test_password, $test_role, $status, $center_id);
        
        if ($stmt->execute()) {
            echo "✅ Test user created successfully<br>";
            echo "Email: " . $test_email . "<br>";
            echo "Password: test123<br>";
        } else {
            echo "❌ Failed to create test user: " . $stmt->error . "<br>";
        }
    }
    
    // Check existing users
    echo "<h3>5. Existing Users</h3>";
    $result = $mysqli->query("SELECT username, name, role, status FROM hms_employees WHERE status = '1' LIMIT 10");
    if ($result) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>Username</th><th>Name</th><th>Role</th><th>Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    $mysqli->close();
} else {
    echo "<h3>2. Database Connection Troubleshooting</h3>";
    echo "<p>Common solutions:</p>";
    echo "<ul>";
    echo "<li>Check if MySQL service is running</li>";
    echo "<li>Verify database credentials</li>";
    echo "<li>Check if database exists</li>";
    echo "<li>Verify user permissions</li>";
    echo "<li>Check firewall settings</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><strong>Database fix completed!</strong></p>";
echo "<p><a href='test_database.php'>Run full database test</a> | <a href='index.php'>Go to main application</a></p>";
?>
