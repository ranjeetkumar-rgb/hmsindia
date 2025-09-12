<?php
// For backward compatibility, we'll create a connection using CodeIgniter's config
if (!defined('BASEPATH')) {
    // If not in CodeIgniter context, include the framework
    require_once(__DIR__ . '/../../../../index.php');
}

$CI =& get_instance();
$CI->load->database();

// Create mysqli connection using CodeIgniter's database config for backward compatibility
$db_config = $CI->db->get_connection();
$conn = $db_config;

// Check connection
if (!$conn) {
    die("Connection failed: Unable to connect to database");
}

?>
