<?php
// Test CodeIgniter database connection
define('BASEPATH', '');
require_once 'application/config/database.php';
require_once 'application/config/config.php';

echo "<h2>CodeIgniter Database Test</h2>";

try {
    // Test direct database connection
    $host = $db['default']['hostname'];
    $username = $db['default']['username'];
    $password = $db['default']['password'];
    $database = $db['default']['database'];
    $dbprefix = $db['default']['dbprefix'];
    
    echo "<p><strong>Database Config:</strong></p>";
    echo "<ul>";
    echo "<li>Host: $host</li>";
    echo "<li>Username: $username</li>";
    echo "<li>Password: " . ($password ? '***' : 'empty') . "</li>";
    echo "<li>Database: $database</li>";
    echo "<li>Prefix: $dbprefix</li>";
    echo "</ul>";
    
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die("<p style='color: red;'>✗ Connection failed: " . $mysqli->connect_error . "</p>");
    }
    
    echo "<p style='color: green;'>✓ Database connection successful</p>";
    
    // Check if centers table exists
    $table_name = $dbprefix . 'centers';
    $result = $mysqli->query("SHOW TABLES LIKE '$table_name'");
    
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✓ Table '$table_name' exists</p>";
        
        // Show table structure
        echo "<h3>Table Structure:</h3>";
        $structure = $mysqli->query("DESCRIBE $table_name");
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        while ($row = $structure->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "<td>" . $row['Default'] . "</td>";
            echo "<td>" . $row['Extra'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Check if table has data
        $count = $mysqli->query("SELECT COUNT(*) as count FROM $table_name");
        $row = $count->fetch_assoc();
        echo "<p>Total records in table: " . $row['count'] . "</p>";
        
        // Show sample data
        $sample = $mysqli->query("SELECT * FROM $table_name LIMIT 3");
        if ($sample->num_rows > 0) {
            echo "<h3>Sample Data:</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            $first = true;
            while ($row = $sample->fetch_assoc()) {
                if ($first) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<th>$key</th>";
                    }
                    echo "</tr>";
                    $first = false;
                }
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Table '$table_name' does not exist</p>";
        
        // Try to create the table
        echo "<h3>Attempting to create table...</h3>";
        $create_sql = "CREATE TABLE `$table_name` (
            `ID` int(11) NOT NULL AUTO_INCREMENT,
            `center_name` varchar(255) NOT NULL,
            `type` varchar(50) NOT NULL,
            `center_gst` varchar(50) DEFAULT NULL,
            `gst` tinyint(1) DEFAULT '1',
            `dl_number` varchar(100) DEFAULT NULL,
            `fssai_license_no` varchar(100) DEFAULT NULL,
            `cin` varchar(100) DEFAULT NULL,
            `pharmacist_registration` varchar(100) DEFAULT NULL,
            `upload_photo_1` text DEFAULT NULL,
            `center_location` text NOT NULL,
            `status` tinyint(1) DEFAULT '1',
            `add_date` datetime DEFAULT NULL,
            `center_number` varchar(100) DEFAULT NULL,
            PRIMARY KEY (`ID`),
            UNIQUE KEY `center_number` (`center_number`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        if ($mysqli->query($create_sql)) {
            echo "<p style='color: green;'>✓ Table created successfully</p>";
        } else {
            echo "<p style='color: red;'>✗ Failed to create table: " . $mysqli->error . "</p>";
        }
    }
    
    // Test upload path
    echo "<h3>Upload Path Test:</h3>";
    $upload_path = FCPATH . 'assets/';
    echo "<p>Upload path: $upload_path</p>";
    
    if (is_dir($upload_path)) {
        echo "<p style='color: green;'>✓ Upload directory exists</p>";
        
        $center_path = $upload_path . 'center/';
        if (is_dir($center_path)) {
            echo "<p style='color: green;'>✓ Center subdirectory exists</p>";
        } else {
            echo "<p style='color: orange;'>⚠ Center subdirectory does not exist</p>";
            if (mkdir($center_path, 0755, true)) {
                echo "<p style='color: green;'>✓ Center subdirectory created</p>";
            } else {
                echo "<p style='color: red;'>✗ Failed to create center subdirectory</p>";
            }
        }
        
        if (is_writable($upload_path)) {
            echo "<p style='color: green;'>✓ Upload directory is writable</p>";
        } else {
            echo "<p style='color: red;'>✗ Upload directory is not writable</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Upload directory does not exist</p>";
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}

echo "<h3>PHP Info:</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>MySQL Extension: " . (extension_loaded('mysqli') ? 'Loaded' : 'Not Loaded') . "</p>";
echo "<p>File Uploads: " . (ini_get('file_uploads') ? 'Enabled' : 'Disabled') . "</p>";
echo "<p>Max File Size: " . ini_get('upload_max_filesize') . "</p>";
echo "<p>Post Max Size: " . ini_get('post_max_size') . "</p>";
?>
