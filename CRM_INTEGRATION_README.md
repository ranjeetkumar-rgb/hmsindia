# CRM to Appointment Integration - Complete Documentation

## 📋 Overview

This repository contains comprehensive documentation for the CRM (LeadSquare) to Appointment integration in the HMS (Hospital Management System). The integration allows automatic appointment creation when leads are generated or updated in the CRM system.

## 📚 Documentation Files

### 1. **Main Documentation**
- **[CRM_APPOINTMENT_INTEGRATION_DOCUMENTATION.md](./CRM_APPOINTMENT_INTEGRATION_DOCUMENTATION.md)**
  - Complete technical documentation
  - System architecture details
  - Database schema
  - API reference
  - Troubleshooting guide

### 2. **Flow Diagrams**
- **[CRM_INTEGRATION_FLOW_DIAGRAM.md](./CRM_INTEGRATION_FLOW_DIAGRAM.md)**
  - Visual system architecture
  - Detailed data flow process
  - Error handling flows
  - Performance metrics

### 3. **Quick Reference**
- **[CRM_API_QUICK_REFERENCE.md](./CRM_API_QUICK_REFERENCE.md)**
  - API endpoint details
  - Request/response examples
  - Error codes
  - Testing scenarios

## 🚀 Quick Start

### API Endpoint
```
POST /Api/myappointment_leadsqure
```

### Basic Request
```json
{
    "FirstName": "Priya",
    "Phone": "+91-9876543210",
    "EmailAddress": "patient@example.com",
    "LeadID": "LS123456",
    "Fields": [
        {
            "SchemaName": "mx_Centre_Location",
            "Value": "101"
        }
    ]
}
```

### Success Response
```json
{
    "status": 1,
    "message": "Appointment has been booked!"
}
```

## 🔧 Key Components

### Files Involved
- **API Controller**: `application/controllers/Api.php`
- **Appointment Model**: `application/models/Appointment_model.php`
- **Billing Model**: `application/models/Billingmodel_model.php`
- **Database Table**: `hms_appointments`

### Data Flow
1. **LeadSquare CRM** → Webhook call
2. **HMS API** → Data validation & processing
3. **HMS Database** → Appointment storage
4. **Notification Services** → WhatsApp/SMS/Email

## 📊 Database Schema

### Primary Table: `hms_appointments`
| Field | Type | Description |
|-------|------|-------------|
| `ID` | INT | Primary key |
| `paitent_id` | VARCHAR | Patient identifier |
| `wife_name` | VARCHAR | Patient name |
| `wife_phone` | VARCHAR | Phone number |
| `crm_id` | VARCHAR | CRM Lead ID |
| `appoitment_for` | VARCHAR | Center ID |
| `appoitmented_doctor` | VARCHAR | Doctor ID |
| `appoitmented_date` | DATE | Appointment date |
| `status` | ENUM | Appointment status |

## ✅ Validation Rules

### Required Fields
- `FirstName` - Patient name
- `Phone` - Phone number

### Business Rules
- No duplicate appointments per phone number
- Only one active appointment per phone
- Phone numbers cleaned (removes "+91-" prefix)
- Center codes mapped to internal IDs

## 🔍 Error Handling

| Code | Description | Solution |
|------|-------------|----------|
| 200 | Success | Appointment created |
| 400 | Bad Request | Check required fields |
| 409 | Conflict | Duplicate appointment |
| 500 | Server Error | Check logs & database |

## 🧪 Testing

### Test Endpoint
```bash
curl -X POST "your-domain.com/Api/myappointment_leadsqure" \
  -H "Content-Type: application/json" \
  -d '{"FirstName":"Test","Phone":"9999999999"}'
```

### Test Scenarios
1. Valid request → Success
2. Missing fields → 400 Error
3. Duplicate phone → 409 Error
4. Invalid data → 500 Error

## 📈 Performance

### Targets
- **Response Time**: < 2 seconds
- **Success Rate**: > 99%
- **Throughput**: 100 requests/minute

### Monitoring
- Check application logs
- Monitor database performance
- Track notification delivery

## 🛠️ Troubleshooting

### Common Issues
1. **"Appointment already booked"**
   - Check for existing appointments
   - Verify phone number format

2. **"Something went wrong"**
   - Check database connection
   - Verify required fields
   - Review server logs

3. **Wrong center assigned**
   - Verify center code mapping
   - Check Fields array structure

### Debug Steps
1. Enable logging in controller
2. Check database queries
3. Validate input data
4. Review error logs

## 📞 Support

### Resources
- **Main Documentation**: Complete technical details
- **Flow Diagrams**: Visual system overview
- **Quick Reference**: API usage guide
- **Logs**: `application/logs/` directory

### Contact
- Development Team
- System Administrator
- Database Administrator

## 🔄 Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | Jan 2025 | Initial documentation |

## 📝 Notes

- This integration is currently active and processing live data
- All sensitive data is properly sanitized and validated
- The system supports both legacy and modern API endpoints
- Regular monitoring and maintenance is recommended

---

**For detailed information, please refer to the individual documentation files listed above.**
