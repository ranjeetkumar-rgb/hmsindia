<?php
/**
 * Database Connection Test for HMS India
 * This script tests database connectivity and helps diagnose login issues
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>HMS India - Database Connection Test</h2>";
echo "<hr>";

// Test 1: Environment Detection
echo "<h3>1. Environment Detection</h3>";
$environment = 'development';
if (isset($_SERVER['CI_ENV'])) {
    $environment = $_SERVER['CI_ENV'];
} elseif (getenv('CI_ENV')) {
    $environment = getenv('CI_ENV');
} elseif (isset($_SERVER['HTTP_HOST'])) {
    $host = $_SERVER['HTTP_HOST'];
    if (strpos($host, '139.84.175.208') !== false || 
        strpos($host, 'indiaivf.website') !== false ||
        strpos($host, 'hmsindia') !== false) {
        $environment = 'production';
    }
}
echo "Detected Environment: <strong>" . $environment . "</strong><br>";
echo "HTTP_HOST: " . ($_SERVER['HTTP_HOST'] ?? 'Not set') . "<br>";

// Test 2: Database Configuration
echo "<h3>2. Database Configuration</h3>";
switch ($environment) {
    case 'production':
        $db_host = getenv('DB_HOST') ?: 'localhost';
        $db_user = getenv('DB_USER') ?: 'hmaadmin';
        $db_pass = getenv('DB_PASSWORD') ?: 'Admin@2025!';
        $db_name = getenv('DB_NAME') ?: 'stagin_hms_db';
        break;
    default:
        $db_host = getenv('DB_HOST') ?: 'localhost';
        $db_user = getenv('DB_USER') ?: 'root';
        $db_pass = getenv('DB_PASSWORD') ?: '';
        $db_name = getenv('DB_NAME') ?: 'hmsindiaivf';
        break;
}

echo "Database Host: " . $db_host . "<br>";
echo "Database User: " . $db_user . "<br>";
echo "Database Name: " . $db_name . "<br>";
echo "Database Password: " . (empty($db_pass) ? 'Empty' : 'Set (' . strlen($db_pass) . ' characters)') . "<br>";

// Test 3: Direct MySQL Connection
echo "<h3>3. Direct MySQL Connection Test</h3>";
try {
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if ($mysqli->connect_error) {
        echo "❌ Connection failed: " . $mysqli->connect_error . "<br>";
    } else {
        echo "✅ Database connection successful!<br>";
        echo "MySQL Version: " . $mysqli->server_info . "<br>";
        echo "Connection ID: " . $mysqli->thread_id . "<br>";
        
        // Test 4: Check if employees table exists
        echo "<h3>4. Database Tables Check</h3>";
        $result = $mysqli->query("SHOW TABLES LIKE 'hms_employees'");
        if ($result && $result->num_rows > 0) {
            echo "✅ hms_employees table exists<br>";
            
            // Test 5: Check employees data
            echo "<h3>5. Employees Data Check</h3>";
            $result = $mysqli->query("SELECT COUNT(*) as count FROM hms_employees");
            if ($result) {
                $row = $result->fetch_assoc();
                echo "Total employees: " . $row['count'] . "<br>";
                
                // Show sample data
                $result = $mysqli->query("SELECT ID, employee_number, name, email, role, status FROM hms_employees LIMIT 5");
                if ($result) {
                    echo "<h4>Sample Employee Data:</h4>";
                    echo "<table border='1' style='border-collapse: collapse;'>";
                    echo "<tr><th>ID</th><th>Employee Number</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['employee_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
        } else {
            echo "❌ hms_employees table not found<br>";
        }
        
        // Test 6: Check centers table
        $result = $mysqli->query("SHOW TABLES LIKE 'hms_centers'");
        if ($result && $result->num_rows > 0) {
            echo "✅ hms_centers table exists<br>";
        } else {
            echo "❌ hms_centers table not found<br>";
        }
        
        $mysqli->close();
    }
} catch (Exception $e) {
    echo "❌ Exception: " . $e->getMessage() . "<br>";
}

// Test 7: CodeIgniter Database Test
echo "<h3>6. CodeIgniter Database Test</h3>";
if (file_exists(__DIR__ . '/index.php')) {
    // Include CodeIgniter bootstrap
    define('BASEPATH', __DIR__ . '/system/');
    define('APPPATH', __DIR__ . '/application/');
    define('ENVIRONMENT', $environment);
    
    // Load database config
    include_once __DIR__ . '/application/config/database.php';
    
    if (isset($db['default'])) {
        echo "✅ CodeIgniter database config loaded<br>";
        echo "Config Host: " . $db['default']['hostname'] . "<br>";
        echo "Config User: " . $db['default']['username'] . "<br>";
        echo "Config Database: " . $db['default']['database'] . "<br>";
    } else {
        echo "❌ CodeIgniter database config not found<br>";
    }
} else {
    echo "❌ CodeIgniter index.php not found<br>";
}

// Test 8: Login Simulation
echo "<h3>7. Login Simulation Test</h3>";
if (isset($_GET['test_login'])) {
    $test_email = $_GET['email'] ?? 'admin@test.com';
    $test_password = $_GET['password'] ?? 'password';
    
    echo "Testing login for: " . htmlspecialchars($test_email) . "<br>";
    
    try {
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($mysqli->connect_error) {
            echo "❌ Database connection failed<br>";
        } else {
            // Test login query
            $sql = "SELECT * FROM hms_employees WHERE username = ? AND status = '1'";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s", $test_email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo "✅ User found: " . htmlspecialchars($user['name']) . "<br>";
                echo "Role: " . htmlspecialchars($user['role']) . "<br>";
                echo "Status: " . htmlspecialchars($user['status']) . "<br>";
                
                // Test password
                $hashed_password = md5($test_password);
                if ($user['password'] === $hashed_password) {
                    echo "✅ Password matches!<br>";
                } else {
                    echo "❌ Password does not match<br>";
                    echo "Expected: " . $hashed_password . "<br>";
                    echo "Stored: " . $user['password'] . "<br>";
                }
            } else {
                echo "❌ User not found or inactive<br>";
            }
            $mysqli->close();
        }
    } catch (Exception $e) {
        echo "❌ Exception: " . $e->getMessage() . "<br>";
    }
} else {
    echo "<form method='get'>";
    echo "Email: <input type='text' name='email' value='admin@test.com'><br>";
    echo "Password: <input type='password' name='password' value='password'><br>";
    echo "<input type='hidden' name='test_login' value='1'>";
    echo "<input type='submit' value='Test Login'>";
    echo "</form>";
}

echo "<hr>";
echo "<p><strong>Database test completed!</strong></p>";
echo "<p><a href='index.php'>Go to main application</a> | <a href='session_test.php'>Run session test</a></p>";
?>
