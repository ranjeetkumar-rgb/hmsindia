<?php
/**
 * CodeIgniter Database Connection Test
 * This script tests the database connection using your application's configuration
 */

// Set the environment
define('ENVIRONMENT', 'production');

// Include CodeIgniter bootstrap
require_once('index.php');

// Get CodeIgniter instance
$CI =& get_instance();

echo "=== CodeIgniter Database Connection Test ===\n";
echo "Environment: " . ENVIRONMENT . "\n";
echo "==========================================\n\n";

try {
    // Test database connection
    echo "1. Testing CodeIgniter database connection...\n";
    
    // Load database
    $CI->load->database();
    
    // Test connection
    if ($CI->db->conn_id) {
        echo "✅ CodeIgniter database connection successful!\n";
        
        // Get database info
        $db_info = $CI->db->platform();
        echo "Database Platform: $db_info\n";
        
        // Test query
        echo "\n2. Testing database query...\n";
        $query = $CI->db->query("SELECT 1 as test");
        if ($query && $query->num_rows() > 0) {
            $result = $query->row();
            echo "✅ Query test successful! Result: " . $result->test . "\n";
        }
        
        // Check tables
        echo "\n3. Checking database tables...\n";
        $tables = $CI->db->list_tables();
        if (count($tables) > 0) {
            echo "✅ Found " . count($tables) . " tables:\n";
            foreach ($tables as $table) {
                echo "   - $table\n";
            }
        } else {
            echo "⚠️  No tables found in database.\n";
        }
        
        // Test specific HMS tables
        echo "\n4. Checking for HMS specific tables...\n";
        $hms_tables = ['hms_patients', 'hms_users', 'hms_centers', 'hms_appointments'];
        foreach ($hms_tables as $table) {
            if ($CI->db->table_exists($table)) {
                $count = $CI->db->count_all($table);
                echo "✅ Table '$table' exists with $count records\n";
            } else {
                echo "❌ Table '$table' does not exist\n";
            }
        }
        
    } else {
        echo "❌ CodeIgniter database connection failed!\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== Test Complete ===\n";
?>
