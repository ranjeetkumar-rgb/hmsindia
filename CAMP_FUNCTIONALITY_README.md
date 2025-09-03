# Camp Functionality Implementation

## Overview
This implementation adds comprehensive camp management functionality to the appointment booking system, allowing users to:
1. Select a center and view available camps
2. Create new camps on-the-fly
3. Check for available templates after camp creation
4. Integrate camp selection with appointment booking

## Features Implemented

### 1. Center-Based Camp Selection
- When a center is selected in the appointment form, the system automatically loads available camps for that center
- Camps are displayed in a dropdown below the center selection
- If no camps exist for a center, a "No camps available" message is shown

### 2. Camp Creation Modal
- "Create New Camp" button appears next to the camp selection dropdown
- Modal form includes:
  - Camp Name (required)
  - Camp Description
  - Start Date
  - End Date
- Form validation ensures required fields are filled
- Center ID is automatically populated based on selected center

### 3. Template Checking
- After camp creation, the system automatically checks for available templates
- Templates checked include:
  - Email templates (from email-templates directory)
  - SMS templates (placeholder for future implementation)
  - Consent forms (placeholder for future implementation)
- User receives feedback about template availability

### 4. Real-time Updates
- Camp list refreshes automatically after creating a new camp
- Success/error messages provide clear feedback
- Loading indicators show system activity

## Technical Implementation

### Database Changes
- Uses existing `camps` table structure
- Links camps to centers via `center_id` field
- Maintains camp status and metadata

### New Methods Added

#### Camp Model (`application/models/Camp_model.php`)
- `get_camps_by_center($center_number)` - Retrieves camps for a specific center

#### Billing Controller (`application/controllers/Billingcontroller.php`)
- `get_camps_by_center()` - AJAX endpoint to get camps by center
- `check_camp_templates()` - Checks templates for a specific camp
- `create_camp_and_check_templates()` - Creates new camp and checks templates
- `check_camp_templates_exist()` - Private method to verify template availability
- `check_email_templates()` - Checks email template availability
- `check_sms_templates()` - Checks SMS template availability (placeholder)
- `check_consent_forms()` - Checks consent form availability (placeholder)

### Frontend Changes

#### Appointment View (`application/views/billing_view/appointment.php`)
- Added camp selection dropdown
- Added "Create New Camp" button
- Added camp creation modal with form
- Enhanced JavaScript for camp management
- Added modal styling and responsive design

#### JavaScript Functionality
- Center selection triggers camp loading
- Camp creation with form validation
- Template checking after camp creation
- Real-time camp list updates
- Error handling and user feedback

## Usage Instructions

### For Users
1. **Select Center**: Choose a center from the dropdown
2. **View Camps**: Available camps automatically load below
3. **Select Camp**: Choose an existing camp or create a new one
4. **Create New Camp**: Click "Create New Camp" button
5. **Fill Form**: Enter camp details in the modal
6. **Submit**: Click "Create Camp" to save
7. **Check Templates**: System automatically checks for available templates

### For Developers
1. **Extend Template Checking**: Modify `check_*_templates()` methods in Billingcontroller
2. **Add Camp Fields**: Extend the camp form and database as needed
3. **Customize Validation**: Modify form validation rules
4. **Add Notifications**: Integrate with email/SMS systems

## File Structure
```
application/
├── controllers/
│   └── Billingcontroller.php (camp methods added)
├── models/
│   └── Camp_model.php (get_camps_by_center method added)
└── views/
    └── billing_view/
        └── appointment.php (camp UI and functionality added)
```

## Dependencies
- Bootstrap Modal (for camp creation form)
- jQuery AJAX (for dynamic content loading)
- Font Awesome (for icons)
- Existing camp and center models

## Future Enhancements
1. **Advanced Template Management**: Database-driven template system
2. **Camp Scheduling**: Calendar integration for camp dates
3. **Camp Analytics**: Reporting and statistics
4. **Multi-language Support**: Internationalization for camp names
5. **Camp Categories**: Organize camps by type or purpose
6. **Camp History**: Track camp performance and outcomes

## Testing
- Test center selection with existing camps
- Test center selection with no camps
- Test camp creation form validation
- Test template checking functionality
- Test error handling and edge cases
- Test responsive design on mobile devices

## Notes
- The system automatically maps center_number to center_id for database operations
- Template checking is currently a placeholder - implement based on your specific template system
- All camp operations include proper error handling and user feedback
- The UI is designed to be responsive and user-friendly
