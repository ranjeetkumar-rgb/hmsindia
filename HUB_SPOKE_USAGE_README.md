# Hub-Spoke Center System for Billing Display

## Overview

This system implements business logic for displaying center information in billing listings based on whether a logged-in Billing Manager's center is classified as a "hub" or "spoke".

## Business Rules

### If logged-in Billing Manager's center is a "hub":
- **From** = center name (logged-in user's center)
- **At** = center name (same as From)

### If logged-in Billing Manager's center is a "spoke":
- **From** = this center name (logged-in user's center)
- **At** = its associated hub center name

## Examples

- **Delhi (hub)** → From = Delhi, At = Delhi
- **Rohini (spoke, associated with Delhi hub)** → From = Rohini, At = Delhi
- **Noida (spoke, associated with Ghaziabad hub)** → From = Noida, At = Ghaziabad

## Implementation Details

### 1. Database Structure

The system uses the existing `hms_centers` table with a `center_classification` column:
- `center_classification` = 'hub' or 'spoke'

### 2. Configuration File

Create/edit `application/config/hub_spoke_config.php`:

```php
$config['hub_spoke_mappings'] = array(
    // Format: 'spoke_center_number' => 'hub_center_name'
    'ROHINI_CENTER_NUMBER' => 'Delhi',
    'NOIDA_CENTER_NUMBER' => 'Ghaziabad',
    // Add your actual mappings here
);
```

### 3. Helper Function

The system includes a helper function `get_billing_at_center_display()` that:
- Checks the logged-in user's center classification
- If hub → returns the same center name for both From and At
- If spoke → fetches the associated hub center and returns it as At

### 4. Modified Files

#### `application/helpers/myhelper_helper.php`
- Added `get_billing_at_center_display()` function

#### `application/controllers/Billings.php`
- Modified `search_patient_payment()` method to use the new logic
- Updated both "From" and "At" center display logic

#### `application/config/hub_spoke_config.php`
- Configuration file for hub-spoke mappings

## Setup Instructions

### Step 1: Update Center Classifications

Ensure your centers table has the correct `center_classification` values:

```sql
UPDATE hms_centers SET center_classification = 'hub' WHERE center_name IN ('Delhi', 'Ghaziabad');
UPDATE hms_centers SET center_classification = 'spoke' WHERE center_name IN ('Rohini', 'Noida');
```

### Step 2: Configure Hub-Spoke Mappings

Edit `application/config/hub_spoke_config.php` and add your actual center mappings:

```php
$config['hub_spoke_mappings'] = array(
    '16249617235059' => 'Delhi',      // Replace with actual Rohini center number
    '16445582259073' => 'Ghaziabad',  // Replace with actual Noida center number
);
```

### Step 3: Test the System

1. Login as a Billing Manager from a hub center
2. Check that both "From" and "At" show the same center name
3. Login as a Billing Manager from a spoke center
4. Verify that "From" shows the spoke center name and "At" shows the hub center name

## How It Works

1. **User Authentication**: System checks the logged-in Billing Manager's center ID from session
2. **Center Classification Check**: Queries the centers table to determine if the user's center is hub or spoke
3. **Display Logic**:
   - **Hub centers**: Use the same center name for both From and At
   - **Spoke centers**: Use the spoke center name for From and the associated hub center name for At
4. **Fallback Mechanisms**: If configuration is missing, the system falls back to original behavior

## Troubleshooting

### Issue: Centers not displaying correctly
- Check that `center_classification` is set correctly in the database
- Verify hub-spoke mappings in the config file
- Ensure center numbers match exactly

### Issue: Helper function not found
- Make sure `myhelper_helper.php` is loaded in your autoload configuration
- Check that the helper file was saved correctly

### Issue: Configuration not loading
- Verify the config file path is correct
- Check that the config array structure matches the expected format

## Maintenance

### Adding New Centers
1. Add the center to the `hms_centers` table
2. Set the appropriate `center_classification`
3. If it's a spoke center, add the mapping to `hub_spoke_config.php`

### Updating Relationships
1. Modify the mappings in `hub_spoke_config.php`
2. Clear any cached data if applicable
3. Test the changes with both hub and spoke center logins

## Security Considerations

- The system only affects display logic, not data integrity
- Center classifications are stored in the database, not in session data
- All database queries use parameterized statements to prevent SQL injection
- The system gracefully falls back to original behavior if configuration is missing

## Performance Notes

- The system makes one additional database query per billing record to determine center classification
- Consider caching center information if you have a large number of centers
- The fallback mechanisms may add additional queries in edge cases
