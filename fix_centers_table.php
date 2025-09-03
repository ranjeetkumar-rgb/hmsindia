<?php
// Script to fix the centers table structure
// This will fix the auto-increment issue with the ID field

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'hmsindiaivf';
$prefix = 'hms_';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    echo "Database: $database\n";
    echo "Table prefix: $prefix\n";
    
    $table_name = $prefix . 'centers';
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE '$table_name'");
    if ($stmt->rowCount() == 0) {
        echo "Table '$table_name' does not exist!\n";
        exit;
    }
    
    echo "Table '$table_name' exists!\n";
    
    // Show current structure
    echo "\nCurrent table structure:\n";
    $stmt = $pdo->query("DESCRIBE $table_name");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "Field: {$column['Field']}, Type: {$column['Type']}, Null: {$column['Null']}, Key: {$column['Key']}, Default: {$column['Default']}, Extra: {$column['Extra']}\n";
    }
    
    // Check if ID field is already auto-increment
    $id_column = null;
    foreach ($columns as $column) {
        if ($column['Field'] === 'ID') {
            $id_column = $column;
            break;
        }
    }
    
    if (!$id_column) {
        echo "ID column not found!\n";
        exit;
    }
    
    if (strpos($id_column['Extra'], 'auto_increment') !== false) {
        echo "\nID field is already auto-increment. No fix needed.\n";
        exit;
    }
    
    echo "\nID field is NOT auto-increment. Fixing...\n";
    
    // Create backup table
    echo "Creating backup table...\n";
    $pdo->exec("CREATE TABLE {$table_name}_backup AS SELECT * FROM $table_name");
    echo "Backup table created: {$table_name}_backup\n";
    
    // Get current data count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM $table_name");
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Current records: " . $count['count'] . "\n";
    
    // Drop and recreate the table with proper structure
    echo "Recreating table with proper structure...\n";
    
    // Drop the current table
    $pdo->exec("DROP TABLE $table_name");
    
    // Create the new table with proper structure
    $create_sql = "CREATE TABLE $table_name (
        ID int NOT NULL AUTO_INCREMENT,
        center_number bigint NOT NULL,
        center_code varchar(255) NOT NULL,
        center_name tinytext NOT NULL,
        center_address text NOT NULL,
        center_gst varchar(255) NOT NULL,
        dl_number varchar(255) NOT NULL,
        fssai_license_no varchar(255) NOT NULL,
        cin varchar(255) NOT NULL,
        gst int NOT NULL,
        pharmacist_name varchar(255) NOT NULL,
        pharmacist_registration varchar(255) NOT NULL,
        type enum('stand-alone','associated') NOT NULL,
        center_location text NOT NULL,
        add_date datetime NOT NULL,
        status tinyint(1) NOT NULL DEFAULT 1,
        upload_photo_1 varchar(255) NOT NULL,
        PRIMARY KEY (ID),
        UNIQUE KEY unique_center_number (center_number)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    
    $pdo->exec($create_sql);
    echo "New table created successfully!\n";
    
    // Restore data from backup
    echo "Restoring data from backup...\n";
    $insert_sql = "INSERT INTO $table_name (
        center_number, center_code, center_name, center_address, center_gst,
        dl_number, fssai_license_no, cin, gst, pharmacist_name,
        pharmacist_registration, type, center_location, add_date, status, upload_photo_1
    ) SELECT 
        center_number, center_code, center_name, center_address, center_gst,
        dl_number, fssai_license_no, cin, gst, pharmacist_name,
        pharmacist_registration, type, center_location, add_date, status, upload_photo_1
    FROM {$table_name}_backup";
    
    $pdo->exec($insert_sql);
    echo "Data restored successfully!\n";
    
    // Verify the new structure
    echo "\nNew table structure:\n";
    $stmt = $pdo->query("DESCRIBE $table_name");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "Field: {$column['Field']}, Type: {$column['Type']}, Null: {$column['Null']}, Key: {$column['Key']}, Default: {$column['Default']}, Extra: {$column['Extra']}\n";
    }
    
    // Check data count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM $table_name");
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "\nRecords in new table: " . $count['count'] . "\n";
    
    // Test insert
    echo "\nTesting insert functionality...\n";
    $test_sql = "INSERT INTO $table_name (
        center_number, center_code, center_name, center_address, center_gst,
        dl_number, fssai_license_no, cin, gst, pharmacist_name,
        pharmacist_registration, type, center_location, add_date, status, upload_photo_1
    ) VALUES (
        99999999999999, 'TEST001', 'Test Center', 'Test Address', 'TESTGST123',
        'DL123', 'FSSAI123', 'CIN123', 1, 'Test Pharmacist',
        'REG123', 'stand-alone', 'Test Location', NOW(), 1, ''
    )";
    
    $pdo->exec($test_sql);
    $test_id = $pdo->lastInsertId();
    echo "Test insert successful! New ID: $test_id\n";
    
    // Clean up test data
    $pdo->exec("DELETE FROM $table_name WHERE center_number = 99999999999999");
    echo "Test data cleaned up.\n";
    
    echo "\nTable fix completed successfully!\n";
    echo "You can now try adding centers again.\n";
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
