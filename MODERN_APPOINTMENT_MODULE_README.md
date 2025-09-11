# Modern Appointment Module Documentation

## Overview

This is a completely redesigned, modern appointment management module for the HMS (Hospital Management System) project. It provides a clean, maintainable, and scalable solution for managing patient appointments with proper API integration and responsive UI.

## Features

### Core Functionality
- ✅ **Appointment Management**: Create, read, update, delete appointments
- ✅ **Status Management**: Track appointment lifecycle with proper status updates
- ✅ **Rescheduling**: Easy appointment rescheduling with conflict detection
- ✅ **Cancellation**: Appointment cancellation with reason tracking
- ✅ **Filtering & Search**: Advanced filtering by status, doctor, date, patient, etc.
- ✅ **Pagination**: Efficient data loading with pagination
- ✅ **Export**: CSV export functionality
- ✅ **Real-time Updates**: AJAX-based real-time updates

### API Integration
- ✅ **RESTful API**: Clean API endpoints for external integrations
- ✅ **LeadSquare Integration**: Seamless CRM integration
- ✅ **Authentication**: Secure API authentication
- ✅ **Validation**: Comprehensive input validation
- ✅ **Error Handling**: Proper error responses and logging

### Notifications
- ✅ **Email Notifications**: Automated email notifications
- ✅ **SMS Notifications**: SMS alerts for patients
- ✅ **WhatsApp Integration**: WhatsApp notifications
- ✅ **Multi-channel**: Support for multiple notification channels

### UI/UX
- ✅ **Responsive Design**: Mobile-friendly interface
- ✅ **Modern UI**: Clean, professional design
- ✅ **Bootstrap 5**: Latest Bootstrap framework
- ✅ **Interactive**: Smooth user interactions
- ✅ **Accessibility**: WCAG compliant design

## File Structure

```
application/
├── controllers/
│   ├── AppointmentController.php          # Main appointment controller
│   └── Api/
│       └── AppointmentApi.php             # API controller
├── models/
│   ├── AppointmentModel.php               # Appointment data model
│   └── NotificationModel.php             # Notification handling
├── views/
│   └── appointments/
│       └── index.php                      # Main appointments view
├── migrations/
│   └── 001_create_modern_appointments_table.php
└── config/
    └── routes.php                         # Updated routes
```

## Database Schema

### Appointments Table
```sql
CREATE TABLE `appointments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(255) NOT NULL,
  `patient_phone` varchar(20) NOT NULL,
  `patient_email` varchar(255) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `reason` text,
  `status` enum('booked','in_clinic','cancelled','rescheduled','no_show','visited','consultation','consultation_done') DEFAULT 'booked',
  `patient_type` enum('new_patient','exist_patient') DEFAULT 'new_patient',
  `crm_id` varchar(100) DEFAULT NULL,
  `notes` text,
  `reschedule_reason` text,
  `cancellation_reason` text,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_phone` (`patient_phone`),
  KEY `appointment_date` (`appointment_date`),
  KEY `doctor_id` (`doctor_id`),
  KEY `center_id` (`center_id`),
  KEY `status` (`status`),
  KEY `crm_id` (`crm_id`)
);
```

## API Endpoints

### Web Controller Endpoints
- `GET /appointments` - Main appointments page
- `GET /appointment/getAppointments` - Get appointments with filters
- `POST /appointment/create` - Create new appointment
- `POST /appointment/updateStatus` - Update appointment status
- `POST /appointment/reschedule` - Reschedule appointment
- `POST /appointment/cancel` - Cancel appointment
- `GET /appointment/getDetails/{id}` - Get appointment details
- `GET /appointment/export` - Export appointments to CSV
- `GET /appointment/getAvailableSlots` - Get available time slots

### API Endpoints
- `POST /api/appointment/create` - Create appointment via API
- `POST /api/appointment/updateStatus` - Update status via API
- `GET /api/appointment/getAppointments` - Get appointments via API
- `GET /api/appointment/getDetails/{id}` - Get details via API
- `GET /api/appointment/getAvailableSlots` - Get slots via API
- `POST /api/appointment/reschedule` - Reschedule via API
- `POST /api/appointment/cancel` - Cancel via API
- `POST /api/appointment/leadsquare` - LeadSquare integration

## Usage Examples

### Creating an Appointment
```javascript
// Via AJAX
$.ajax({
    url: '/appointment/create',
    method: 'POST',
    data: {
        patient_name: 'John Doe',
        patient_phone: '9876543210',
        patient_email: 'john@example.com',
        appointment_date: '2024-01-15',
        appointment_time: '10:00',
        doctor_id: 1,
        center_id: 1,
        reason: 'General consultation'
    },
    success: function(response) {
        if (response.status) {
            console.log('Appointment created:', response.data);
        }
    }
});
```

### API Integration
```php
// Via API
$data = [
    'patient_name' => 'John Doe',
    'patient_phone' => '9876543210',
    'appointment_date' => '2024-01-15',
    'appointment_time' => '10:00',
    'doctor_id' => 1,
    'center_id' => 1
];

$response = $this->AppointmentApi->create($data);
```

### LeadSquare Integration
```php
// LeadSquare webhook
$leadsquareData = [
    'EmailAddress' => 'patient@example.com',
    'FirstName' => 'John',
    'Phone' => '+91-9876543210',
    'Fields' => [
        'mx_Centre_Location' => '101',
        'mx_Doctor' => '1',
        'mx_appoitmented_date' => '2024-01-15',
        'mx_appoitmented_slot' => '10:00'
    ]
];

$response = $this->AppointmentApi->leadsquareIntegration($leadsquareData);
```

## Configuration

### Authentication
The API uses token-based authentication. Set your auth token in the `AppointmentApi` controller:

```php
private $auth_token = "your-secure-token-here";
```

### Time Slots
Configure available time slots in the `AppointmentModel`:

```php
public function getTimeSlots()
{
    return [
        ['value' => '09:00', 'label' => '9:00 AM'],
        ['value' => '09:30', 'label' => '9:30 AM'],
        // ... more slots
    ];
}
```

### Notifications
Configure notification settings in the `NotificationModel`:

```php
// Email settings
private function sendEmailNotification($appointment, $type)
{
    // Configure SMTP settings
}

// SMS settings  
private function sendSMSNotification($appointment, $type)
{
    // Configure SMS gateway
}
```

## Installation

1. **Copy Files**: Copy all new files to their respective directories
2. **Update Routes**: The routes are already updated in `routes.php`
3. **Run Migration**: Execute the database migration
4. **Configure**: Update configuration settings as needed
5. **Test**: Test all functionality

### Database Migration
```bash
# Run the migration
php index.php migrate
```

## Migration from Old Module

### Data Migration
If you have existing appointment data, create a migration script:

```php
// Example data migration
$oldAppointments = $this->db->get('hms_appointments')->result_array();

foreach ($oldAppointments as $old) {
    $newData = [
        'patient_name' => $old['wife_name'],
        'patient_phone' => $old['wife_phone'],
        'patient_email' => $old['wife_email'],
        'appointment_date' => $old['appoitmented_date'],
        'appointment_time' => $old['appoitmented_slot'],
        'doctor_id' => $old['appoitmented_doctor'],
        'center_id' => $old['appoitment_for'],
        'status' => $old['status'],
        'crm_id' => $old['crm_id'],
        'created_at' => $old['appointment_added']
    ];
    
    $this->db->insert('appointments', $newData);
}
```

## Security Features

- **Input Validation**: Comprehensive validation for all inputs
- **SQL Injection Protection**: Parameterized queries
- **XSS Protection**: Output escaping
- **CSRF Protection**: Form token validation
- **Authentication**: Secure API authentication
- **Authorization**: Role-based access control

## Performance Optimizations

- **Database Indexing**: Proper indexes on frequently queried columns
- **Pagination**: Efficient data loading
- **Caching**: Query result caching
- **Lazy Loading**: Load data as needed
- **Compression**: Gzip compression for responses

## Error Handling

- **Validation Errors**: Detailed validation error messages
- **Database Errors**: Graceful database error handling
- **API Errors**: Proper HTTP status codes
- **Logging**: Comprehensive error logging
- **User Feedback**: User-friendly error messages

## Testing

### Unit Tests
```php
// Example unit test
public function testCreateAppointment()
{
    $data = [
        'patient_name' => 'Test Patient',
        'patient_phone' => '9876543210',
        'appointment_date' => '2024-01-15',
        'appointment_time' => '10:00',
        'doctor_id' => 1,
        'center_id' => 1
    ];
    
    $result = $this->AppointmentModel->createAppointment($data);
    $this->assertTrue($result > 0);
}
```

### API Tests
```bash
# Test API endpoints
curl -X POST http://localhost/api/appointment/create \
  -H "Content-Type: application/json" \
  -H "auth-token: your-token" \
  -d '{"patient_name":"Test","patient_phone":"9876543210","appointment_date":"2024-01-15","appointment_time":"10:00","doctor_id":1,"center_id":1}'
```

## Troubleshooting

### Common Issues

1. **Database Connection**: Ensure database credentials are correct
2. **File Permissions**: Check file permissions for uploads
3. **Memory Limit**: Increase PHP memory limit if needed
4. **Timeout**: Adjust timeout settings for long operations

### Debug Mode
Enable debug mode in `config.php`:

```php
$config['log_threshold'] = 4; // Enable all logging
```

## Support

For issues and support:
1. Check the error logs
2. Verify configuration settings
3. Test with sample data
4. Check database connectivity

## Future Enhancements

- [ ] **Calendar View**: Visual calendar interface
- [ ] **Recurring Appointments**: Support for recurring appointments
- [ ] **Waitlist**: Appointment waitlist functionality
- [ ] **Analytics**: Appointment analytics and reporting
- [ ] **Mobile App**: Native mobile application
- [ ] **Integration**: More CRM integrations
- [ ] **AI Features**: Smart scheduling suggestions

## License

This module is part of the HMS project and follows the same licensing terms.

---

**Note**: This is a modern, production-ready appointment module that replaces the old system while maintaining backward compatibility. It follows best practices for security, performance, and maintainability.
