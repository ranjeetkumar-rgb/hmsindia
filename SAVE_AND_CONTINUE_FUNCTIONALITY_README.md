# Save and Continue Functionality - Embryo Record Discharge Summary Form

## Overview
This document describes the implementation of "Save and Continue" functionality for the Embryo Record Discharge Summary form, which allows users to save forms as drafts and later complete them, with edit restrictions once completed.

## Features Implemented

### 1. Two Save Options
- **Save & Continue (Draft)**: Saves the form as a draft, allowing continued editing
- **Submit & Complete Form**: Finalizes the form and locks it for editing

### 2. Form Status Tracking
- **Draft Status**: Forms saved as drafts can be edited
- **Completed Status**: Forms marked as completed are locked and cannot be edited

### 3. Edit Restrictions
- Once a form is completed, all form fields become disabled
- Clear visual indicators show the form is locked
- Status messages inform users about form completion

## Database Changes

### New Fields Added
- `form_status`: ENUM('draft', 'completed') - Tracks form completion status
- `completed_at`: DATETIME - Records when the form was completed

### Database Migration
Run the SQL script: `add_status_fields_to_embryo_record_discharge_summery.sql`

## User Experience

### For Draft Forms
1. User fills out form fields
2. Clicks "Save & Continue (Draft)" to save progress
3. Form remains editable for future modifications
4. User can return and continue editing

### For Final Submission
1. User completes all required fields
2. Clicks "Submit & Complete Form"
3. Confirmation dialog warns about form locking
4. Form is marked as completed and locked
5. User receives success message about form completion

### For Completed Forms
1. Form displays "COMPLETED" status indicator
2. All form fields are disabled
3. Warning message explains form is locked
4. Only print functionality remains available

## Technical Implementation

### Form Processing
- **Draft Save**: Sets `form_status = 'draft'`
- **Final Submit**: Sets `form_status = 'completed'` and `completed_at = current_timestamp`

### Field Disabling
- All form inputs, selects, and textareas are disabled when `form_status = 'completed'`
- JavaScript validation prevents form submission for completed forms
- Visual indicators show form completion status

### Validation
- Client-side validation for both save types
- Server-side validation ensures data integrity
- Confirmation dialogs for user actions

## File Modifications

### 1. View File
- `application/views/discharge-forms/embryo_record_discharge_summery.php`
- Added status checking logic
- Implemented field disabling
- Updated button section with save options
- Added status indicators and messages

### 2. JavaScript Functions
- `validateForm()`: Handles draft save validation
- `confirmFinalSubmission()`: Handles final submission validation
- Date field synchronization
- Form status checking

### 3. CSS Styling
- New button styles for different save types
- Status indicator styling
- Disabled form field styling

## Usage Instructions

### For Users
1. **Start Form**: Fill in required fields (Center, Admission Date, Discharge Date)
2. **Save Draft**: Use "Save & Continue (Draft)" to save progress
3. **Continue Editing**: Return to form to make changes
4. **Final Submit**: Use "Submit & Complete Form" when ready to finalize
5. **Form Locked**: Once completed, form cannot be edited

### For Administrators
1. **Database Setup**: Run the migration script
2. **Monitor Forms**: Check form status in database
3. **Unlock Forms**: Modify `form_status` field if needed (manual process)

## Benefits

### 1. User Experience
- No data loss during form filling
- Clear understanding of form status
- Ability to work on forms incrementally

### 2. Data Integrity
- Prevents accidental changes to completed forms
- Clear audit trail of form completion
- Status tracking for reporting

### 3. Workflow Management
- Supports multi-session form completion
- Clear distinction between draft and final forms
- Professional form submission process

## Future Enhancements

### 1. Advanced Status Management
- Multiple draft versions
- Approval workflow
- Status change notifications

### 2. User Permissions
- Role-based form editing permissions
- Admin override capabilities
- Audit logging for status changes

### 3. Integration Features
- Email notifications on form completion
- Integration with approval systems
- Automated form status updates

## Testing

### Test Scenarios
1. **Draft Save**: Save form as draft and verify editability
2. **Final Submit**: Complete form and verify locking
3. **Field Disabling**: Ensure all fields are disabled when locked
4. **Status Display**: Verify status indicators work correctly
5. **Validation**: Test both save types with validation

### Test Data
- Create test records with different statuses
- Verify database field updates
- Test form behavior for each status

## Support

For technical support or questions about this implementation:
1. Check the database migration script
2. Verify form status field values
3. Review JavaScript console for errors
4. Check form validation logic

## Security Considerations

- Form status changes are logged in database
- No client-side bypass of form locking
- Server-side validation prevents unauthorized status changes
- Clear user warnings about form completion

