# CRM Integration API Quick Reference

## Quick Start

### Endpoint
```
POST /Api/myappointment_leadsqure
```

### Headers
```
Content-Type: application/json
```

### Sample Request
```bash
curl -X POST "https://your-domain.com/Api/myappointment_leadsqure" \
  -H "Content-Type: application/json" \
  -d '{
    "EmailAddress": "patient@example.com",
    "ActivityNote": "Fertility consultation",
    "LeadID": "LS123456",
    "FirstName": "Priya",
    "HusbandName": "Raj",
    "Phone": "+91-9876543210",
    "ActivityDateTime": "2024-01-15 10:00:00",
    "Fields": [
      {
        "SchemaName": "mx_Centre_Location",
        "Value": "101"
      },
      {
        "SchemaName": "mx_Doctor",
        "Value": "DOC001"
      },
      {
        "SchemaName": "mx_appoitmented_date",
        "Value": "2024-01-15"
      },
      {
        "SchemaName": "mx_appoitmented_slot",
        "Value": "10:00 AM"
      }
    ]
  }'
```

## Request Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `EmailAddress` | String | No | Patient email address |
| `ActivityNote` | String | No | Reason for visit/consultation |
| `LeadID` | String | No | CRM Lead ID for tracking |
| `FirstName` | String | **Yes** | Patient's first name |
| `HusbandName` | String | No | Husband's name |
| `Phone` | String | **Yes** | Phone number (will be cleaned) |
| `ActivityDateTime` | String | No | Activity timestamp |
| `Fields` | Array | No | Additional appointment fields |

### Fields Array Structure

| SchemaName | Value | Description |
|------------|-------|-------------|
| `mx_Centre_Location` | String | Center code (mapped to internal ID) |
| `mx_Doctor` | String | Doctor ID |
| `mx_appoitmented_date` | String | Appointment date (YYYY-MM-DD) |
| `mx_appoitmented_slot` | String | Time slot |

## Response Format

### Success Response (200)
```json
{
    "status": 1,
    "message": "Appointment has been booked!"
}
```

### Error Responses

#### Missing Required Fields (400)
```json
{
    "status": 0,
    "message": "FirstName and Phone are required"
}
```

#### Duplicate Appointment (409)
```json
{
    "status": 0,
    "message": "Appointment already booked"
}
```

#### System Error (500)
```json
{
    "status": 0,
    "message": "Something went wrong!"
}
```

## Center Code Mapping

| CRM Code | Internal Center ID | Center Name |
|----------|-------------------|-------------|
| 101 | 16249589462327 | Center 1 |
| 102 | 16266778858144 | Center 2 |
| 103 | 16267558222750 | Center 3 |
| 104 | 16098223739590 | Center 4 |
| 105 | 16133769531637 | Center 5 |
| ... | ... | ... |

## Validation Rules

### Required Fields
- `FirstName` - Must not be empty
- `Phone` - Must not be empty

### Phone Number Processing
- Automatically removes "+91-" prefix
- Example: "+91-9876543210" becomes "9876543210"

### Duplicate Check
- Checks for existing appointments with same phone number
- Only considers 'booked' and 'rescheduled' statuses
- Prevents multiple active appointments per phone number

## Error Codes

| HTTP Code | Description | Action |
|-----------|-------------|---------|
| 200 | Success | Appointment created |
| 400 | Bad Request | Check required fields |
| 409 | Conflict | Duplicate appointment exists |
| 500 | Internal Server Error | Contact support |

## Testing

### Test Data
```json
{
    "EmailAddress": "test@example.com",
    "ActivityNote": "Test appointment",
    "LeadID": "TEST123",
    "FirstName": "Test",
    "HusbandName": "Patient",
    "Phone": "+91-9999999999",
    "ActivityDateTime": "2024-01-15 10:00:00",
    "Fields": [
        {
            "SchemaName": "mx_Centre_Location",
            "Value": "101"
        },
        {
            "SchemaName": "mx_Doctor",
            "Value": "DOC001"
        },
        {
            "SchemaName": "mx_appoitmented_date",
            "Value": "2024-01-15"
        },
        {
            "SchemaName": "mx_appoitmented_slot",
            "Value": "10:00 AM"
        }
    ]
}
```

### Test Scenarios

1. **Valid Request**
   - Send complete valid data
   - Expect 200 success response

2. **Missing Required Fields**
   - Send without FirstName or Phone
   - Expect 400 error

3. **Duplicate Appointment**
   - Send same phone number twice
   - First: 200 success, Second: 409 conflict

4. **Invalid Center Code**
   - Send invalid center code
   - May result in empty center assignment

## Troubleshooting

### Common Issues

1. **"Appointment already booked"**
   - Check if phone number already has active appointment
   - Verify phone number format

2. **"Something went wrong"**
   - Check database connection
   - Verify required fields are present
   - Check server logs

3. **Wrong center assigned**
   - Verify center code in mapping table
   - Check Fields array structure

### Debug Steps

1. **Check Logs**
   ```bash
   tail -f application/logs/log-$(date +%Y-%m-%d).php
   ```

2. **Verify Database**
   ```sql
   SELECT * FROM hms_appointments 
   WHERE wife_phone = 'phone_number' 
   ORDER BY appointment_added DESC;
   ```

3. **Test API Manually**
   ```bash
   curl -X POST "your-api-url" \
     -H "Content-Type: application/json" \
     -d '{"FirstName":"Test","Phone":"9999999999"}'
   ```

## Support

- **Documentation**: See main documentation files
- **Logs**: Check application/logs/ directory
- **Database**: Verify hms_appointments table
- **Contact**: Development team for technical issues

---

**Last Updated**: January 2025
**Version**: 1.0
