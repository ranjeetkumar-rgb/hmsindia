<?php
/**
 * Hub/Spoke Center Configuration
 * 
 * This file contains the mapping between spoke centers and their associated hub centers.
 * Update the mappings below with your actual center relationships.
 * 
 * Format: 'spoke_center_number' => 'hub_center_name'
 */

$config['hub_spoke_mappings'] = array(
    
    // Example mappings - update these with your actual center relationships
    
    // If Rohini center (spoke) is associated with Delhi center (hub):
    // 'ROHINI_CENTER_NUMBER' => 'Delhi',
    
    // If Noida center (spoke) is associated with Ghaziabad center (hub):
    // 'NOIDA_CENTER_NUMBER' => 'Ghaziabad',
    
    // Add your actual mappings here:
    // 'SPOKE_CENTER_1' => 'HUB_CENTER_NAME_1',
    // 'SPOKE_CENTER_2' => 'HUB_CENTER_NAME_2',
    
    // Example with actual center numbers (replace with your real center numbers):
    // '16249617235059' => 'Delhi',
    // '16445582259073' => 'Ghaziabad',
    
    // TO FIND YOUR ACTUAL CENTER NUMBERS, run this SQL query:
    // SELECT center_number, center_name, center_classification FROM hms_centers WHERE status = '1';
    
    // Then add the mappings like this:
    // 'ACTUAL_ROHINI_CENTER_NUMBER' => 'Delhi',
    // 'ACTUAL_NOIDA_CENTER_NUMBER' => 'Ghaziabad',
);

/**
 * To use this configuration:
 * 1. Find your spoke center numbers in the database
 * 2. Find the corresponding hub center names
 * 3. Add the mappings above
 * 4. The system will automatically use these mappings for billing display
 */
?>
