# Camps CRUD System

This is a complete CRUD (Create, Read, Update, Delete) system for managing medical camps in the HMS India application.

## Features

- **Camp Management**: Add, edit, delete, and view camps
- **Center Integration**: Each camp is associated with a specific center
- **Comprehensive Fields**: Camp name, description, dates, location, capacity, contact details
- **Bootstrap 3 Styling**: Responsive design with Bootstrap 3 classes
- **Form Validation**: Client-side and server-side validation
- **Status Management**: Active/Inactive camp status

## Files Created

### Models
- `application/models/Camp_model.php` - Handles all database operations for camps

### Controllers
- `application/controllers/Camps.php` - Manages camp-related requests and actions

### Views
- `application/views/camps/camps.php` - Main camps listing page
- `application/views/camps/add_camp.php` - Add new camp form
- `application/views/camps/edit_camp.php` - Edit existing camp form

### Database
- `camps_table.sql` - SQL file to create the camps table

## Database Structure

The `camps` table includes the following fields:

- `ID` - Auto-increment primary key
- `camp_number` - Unique identifier for each camp
- `camp_name` - Name of the camp
- `center_id` - Foreign key reference to centers table
- `description` - Detailed description of the camp
- `start_date` - Camp start date
- `end_date` - Camp end date
- `location` - Physical location of the camp
- `capacity` - Maximum number of participants
- `contact_person` - Person to contact for camp details
- `contact_phone` - Contact phone number
- `status` - Active (1) or Inactive (0)
- `add_date` - When the camp was added
- `update_date` - Last update timestamp

## Installation Steps

1. **Import Database Table**:
   ```sql
   -- Run the SQL commands from camps_table.sql
   -- This will create the camps table with sample data
   ```

2. **Access the System**:
   - Navigate to: `your-domain/camps`
   - Or click "Manage Camps" button from the Centers page

3. **Add New Camp**:
   - Click "Add Camp" button
   - Fill in required fields (Camp Name and Center)
   - Submit the form

4. **Edit Camp**:
   - Click "Edit" button on any camp row
   - Modify the details
   - Click "Update Camp"

5. **Delete Camp**:
   - Click "Delete" button on any camp row
   - Confirm deletion

## URL Structure

- **List Camps**: `/camps` or `/camps/index`
- **Add Camp**: `/camps/add`
- **Edit Camp**: `/camps/edit?camp_number=CAMP-001`
- **Delete Camp**: `/camps/delete?camp_number=CAMP-001`

## Integration with Centers

- Each camp must be associated with a center
- Centers are loaded dynamically from the centers table
- The system maintains referential integrity between camps and centers

## Bootstrap 3 Classes Used

- `clearfix` - For floating elements
- `pull-left` / `pull-right` - For element positioning
- `btn btn-primary` / `btn btn-info` / `btn btn-danger` - For buttons
- `form-control` - For form inputs
- `table table-striped table-bordered table-hover` - For tables
- `alert alert-success` / `alert alert-danger` - For messages

## Validation

### Client-side Validation
- Required field checking
- Date validation (end date cannot be earlier than start date)
- Form submission prevention if validation fails

### Server-side Validation
- Required field validation
- Database field validation
- Error logging and user feedback

## Security Features

- SQL injection prevention through CodeIgniter's query builder
- Input sanitization and validation
- Session-based authentication checks
- CSRF protection through form tokens

## Customization

You can easily customize the system by:

1. **Adding New Fields**: Modify the database table and update forms
2. **Changing Validation Rules**: Update both client and server-side validation
3. **Modifying Styling**: Update CSS classes and Bootstrap components
4. **Adding New Features**: Extend the controller and model methods

## Troubleshooting

### Common Issues

1. **Table Not Found**: Ensure the camps table is created in the database
2. **Center Dropdown Empty**: Check if centers exist in the centers table
3. **Permission Denied**: Verify user authentication and role permissions
4. **Form Not Submitting**: Check browser console for JavaScript errors

### Debug Mode

Enable CodeIgniter debug mode to see detailed error messages:
```php
// In application/config/config.php
$config['log_threshold'] = 4;
```

## Support

For any issues or questions regarding the Camps CRUD system, please check:
1. CodeIgniter error logs
2. Database connection settings
3. File permissions
4. Browser console for JavaScript errors
