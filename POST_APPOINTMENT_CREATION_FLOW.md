# Post-Appointment Creation Flow Documentation

## Overview

This document details what happens after an appointment is successfully created through the CRM integration (`myappointment_leadsqure` endpoint) or any other appointment creation method in the HMS system.

## Table of Contents

1. [Immediate Post-Creation Actions](#immediate-post-creation-actions)
2. [Notification System](#notification-system)
3. [Patient Registration Process](#patient-registration-process)
4. [WhatsApp Integration](#whatsapp-integration)
5. [Email Notifications](#email-notifications)
6. [SMS Notifications](#sms-notifications)
7. [Database Updates](#database-updates)
8. [Follow-up Processes](#follow-up-processes)
9. [Error Handling](#error-handling)
10. [Patient Journey Continuation](#patient-journey-continuation)

## Immediate Post-Creation Actions

### 1. **Appointment Validation**
- Appointment is inserted into `hms_appointments` table
- System checks if appointment was successfully created (`$appointment > 0`)
- If successful, proceeds with notification workflow

### 2. **Patient Data Retrieval**
```php
$doctor_details = doctor_details($_POST['appoitmented_doctor']);
$centre_details = get_centre_details($_POST['appoitment_for']);
$checkpatient_register = get_patient_detail_by_phone($_POST['wife_phone']);
```

## Notification System

### **Multi-Channel Notifications Sent:**

#### 1. **WhatsApp Notifications**

**Patient Registration (if new patient):**
```php
whatsappregister($patient_phone, json_encode(array(
    "name" => $_POST['wife_name'], 
    "iic_id" => $paitent_id, 
    "center" => $centre_details['center_name']
)));
```

**Appointment Confirmation:**
```php
whatsappappointment(
    $patient_phone, 
    $_POST['wife_name'],
    $centre_details['center_name'],
    date("d-m-Y", strtotime($_POST['appoitmented_date'])),
    $_POST['appoitmented_slot'],
    $centre_details['center_location']
);
```

#### 2. **Email Notifications**

**Patient Email:**
- **To:** Patient's email address
- **Subject:** "Appointment booked"
- **Message:** Confirmation with doctor name, date, and time

**Doctor Email:**
- **To:** Doctor's email address  
- **Subject:** "New appointment"
- **Message:** Notification about new appointment scheduled

#### 3. **SMS Notifications**

**Patient SMS:**
- **Message:** Appointment confirmation with doctor name, date, and time
- **Function:** `send_sms($patient_phone, $sms_message)`

## Patient Registration Process

### **New Patient Registration:**
1. **WhatsApp Registration:** If patient doesn't exist in system
2. **Database Flag Update:** `whats_registers = 1` in `hms_patients` table
3. **Center Association:** Patient linked to specific center

### **Existing Patient:**
1. **WhatsApp Registration Check:** Only if `whats_registers = 0`
2. **Update Registration Status:** Mark as registered in WhatsApp system

## WhatsApp Integration

### **Functions Used:**

#### `whatsappregister($phone, $patient_info)`
- **Purpose:** Register new patient in WhatsApp system
- **Parameters:** Phone number and patient information JSON
- **Trigger:** Only for new patients or unregistered existing patients

#### `whatsappappointment($phone, $name, $center, $date, $slot, $location)`
- **Purpose:** Send appointment confirmation via WhatsApp
- **Parameters:** All appointment details
- **Trigger:** Every appointment creation

### **WhatsApp Message Content:**
```
Patient Name: [Name]
Center: [Center Name]  
Date: [DD-MM-YYYY]
Time: [Time Slot]
Location: [Center Location]
```

## Database Updates

### **Tables Updated After Appointment Creation:**

1. **`hms_appointments`** - Main appointment record
2. **`hms_patients`** - Patient registration status (`whats_registers = 1`)
3. **`hms_centers`** - Center information retrieval
4. **`hms_doctors`** - Doctor information retrieval

### **Key Fields Updated:**
- `appointment_added` - Timestamp of creation
- `whats_registers` - WhatsApp registration status
- `appointment_status` - Current appointment status

## Follow-up Processes

### **1. Appointment Management**
- **Viewing:** Appointments visible in doctor and admin dashboards
- **Modification:** Rescheduling and cancellation capabilities
- **Status Updates:** Real-time status tracking

### **2. Patient Journey Continuation**
- **Consultation:** Doctor consultation process
- **Billing:** Investigation and procedure billing
- **Follow-up:** Subsequent appointment scheduling

### **3. Billing Integration**
- **Investigation Billing:** Lab tests and diagnostics
- **Procedure Billing:** Medical procedures
- **Package Billing:** Treatment packages

## Error Handling

### **Common Error Scenarios:**

1. **Appointment Creation Failure:**
   - Database insertion fails
   - Missing required fields
   - Duplicate appointment detection

2. **Notification Failures:**
   - WhatsApp API errors
   - Email delivery failures
   - SMS service issues

3. **Patient Registration Issues:**
   - Invalid phone numbers
   - Missing patient data
   - Center association problems

### **Error Response Handling:**
```php
if($appointment > 0){
    // Success - proceed with notifications
} else {
    // Error - redirect with error message
    header("location:" .base_url(). "appointment?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
}
```

## Patient Journey Continuation

### **Next Steps After Appointment Creation:**

1. **Pre-Appointment:**
   - Patient receives confirmation notifications
   - Doctor is notified of new appointment
   - System tracks appointment status

2. **Appointment Day:**
   - Patient arrives at center
   - Doctor conducts consultation
   - Medical records are updated

3. **Post-Consultation:**
   - Investigation recommendations
   - Procedure suggestions
   - Follow-up appointment scheduling
   - Billing and payment processing

### **Integration Points:**

- **Billing System:** Automatic billing for investigations/procedures
- **Medical Records:** Patient history and consultation notes
- **Follow-up System:** Subsequent appointment management
- **Reporting:** Analytics and reporting dashboards

## Performance Considerations

### **Optimization Features:**
- **Batch Processing:** Multiple notifications sent efficiently
- **Error Logging:** Comprehensive error tracking
- **Retry Mechanisms:** Failed notification retry logic
- **Caching:** Center and doctor data caching

### **Monitoring:**
- **Success Rates:** Notification delivery tracking
- **Error Rates:** Failed operation monitoring
- **Performance Metrics:** Response time tracking

## Security Considerations

### **Data Protection:**
- **Patient Privacy:** Secure handling of personal information
- **API Security:** Secure WhatsApp and SMS API integration
- **Data Validation:** Input sanitization and validation
- **Access Control:** Role-based access to appointment data

## Future Enhancements

### **Potential Improvements:**
1. **Real-time Notifications:** WebSocket-based live updates
2. **Mobile App Integration:** Push notifications
3. **Advanced Analytics:** Appointment pattern analysis
4. **Automated Reminders:** Pre-appointment reminder system
5. **Multi-language Support:** Localized notifications

---

## Quick Reference

### **Key Functions:**
- `insert_appointments()` - Creates appointment record
- `whatsappregister()` - Registers patient in WhatsApp
- `whatsappappointment()` - Sends appointment confirmation
- `send_mail()` - Sends email notifications
- `send_sms()` - Sends SMS notifications

### **Key Tables:**
- `hms_appointments` - Main appointment data
- `hms_patients` - Patient information
- `hms_centers` - Center details
- `hms_doctors` - Doctor information

### **Notification Channels:**
1. WhatsApp (Primary)
2. Email (Secondary)
3. SMS (Tertiary)

This comprehensive flow ensures that every appointment creation triggers a complete notification and registration workflow, providing seamless patient experience and efficient healthcare management.
