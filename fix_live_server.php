<?php
// Quick fix script for live server database issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Live Server Database Fix</h1>";
echo "<hr>";

// Force production environment for this script
putenv('ENVIRONMENT=production');

// Database credentials
$host = 'localhost';
$username = 'hmaadmin';
$password = 'Admin@2025!';
$database = 'stagin_hms_db';

echo "<h2>Attempting to fix database connection...</h2>";

// Test 1: Try to connect with hmaadmin user
echo "<h3>1. Testing hmaadmin user connection</h3>";
try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        echo "❌ hmaadmin user failed: " . $mysqli->connect_error . "<br>";
        
        // Test 2: Try connecting as root to create the user
        echo "<h3>2. Attempting to create hmaadmin user</h3>";
        try {
            $root_mysqli = new mysqli($host, 'root', '');
            if ($root_mysqli->connect_error) {
                echo "❌ Cannot connect as root: " . $root_mysqli->connect_error . "<br>";
                echo "<strong>Solution:</strong> You need to provide the correct root password or create the user manually.<br>";
            } else {
                echo "✅ Connected as root successfully<br>";
                
                // Create database if it doesn't exist
                $root_mysqli->query("CREATE DATABASE IF NOT EXISTS `$database`");
                echo "✅ Database '$database' created/verified<br>";
                
                // Create user if it doesn't exist
                $root_mysqli->query("CREATE USER IF NOT EXISTS '$username'@'$host' IDENTIFIED BY '$password'");
                echo "✅ User '$username' created/verified<br>";
                
                // Grant privileges
                $root_mysqli->query("GRANT ALL PRIVILEGES ON `$database`.* TO '$username'@'$host'");
                $root_mysqli->query("FLUSH PRIVILEGES");
                echo "✅ Privileges granted and flushed<br>";
                
                // Test the new user
                $root_mysqli->close();
                $test_mysqli = new mysqli($host, $username, $password, $database);
                if ($test_mysqli->connect_error) {
                    echo "❌ New user still cannot connect: " . $test_mysqli->connect_error . "<br>";
                } else {
                    echo "✅ <strong>SUCCESS!</strong> hmaadmin user can now connect!<br>";
                }
                $test_mysqli->close();
            }
        } catch (Exception $e) {
            echo "❌ Error creating user: " . $e->getMessage() . "<br>";
        }
    } else {
        echo "✅ <strong>SUCCESS!</strong> hmaadmin user connection works!<br>";
        
        // Show database info
        $result = $mysqli->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = '$database'");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "✅ Database '$database' has {$row['count']} tables<br>";
        }
    }
    $mysqli->close();
} catch (Exception $e) {
    echo "❌ Exception: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>Alternative Solutions:</h2>";
echo "<ol>";
echo "<li><strong>If hmaadmin user doesn't exist:</strong> Run the MySQL commands above</li>";
echo "<li><strong>If database doesn't exist:</strong> Create it with: <code>CREATE DATABASE stagin_hms_db;</code></li>";
echo "<li><strong>If you want to use root user temporarily:</strong> Change the database config to use root</li>";
echo "<li><strong>If password is wrong:</strong> Update the password in the database config</li>";
echo "</ol>";

echo "<h2>Quick Root User Fix (Temporary):</h2>";
echo "<p>If you want to use root user temporarily, update your database.php file:</p>";
echo "<pre>";
echo "// In application/config/database.php, change the production section to:\n";
echo "'username' => 'root',\n";
echo "'password' => '', // or your root password\n";
echo "'database' => 'hmsindiaivf', // or your actual database name\n";
echo "</pre>";
?>
