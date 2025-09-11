# CRM Integration Flow Diagram

## System Architecture Flow

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           LeadSquare CRM System                                 │
│  ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│  │   Lead Creation │    │ Lead Management │    │ Appointment     │            │
│  │   & Updates     │    │   Dashboard     │    │   Scheduling    │            │
│  └─────────────────┘    └─────────────────┘    └─────────────────┘            │
└─────────────────────────────────────────────────────────────────────────────────┘
                                    │
                                    │ Webhook Call
                                    ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│                            HMS API Layer                                       │
│  ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│  │   Legacy API    │    │   Modern API    │    │   Validation    │            │
│  │ /Api/myappointment_│  │ /api/appointment/│   │   & Security   │            │
│  │ leadsqure       │    │ leadsquare      │    │   Layer         │            │
│  └─────────────────┘    └─────────────────┘    └─────────────────┘            │
└─────────────────────────────────────────────────────────────────────────────────┘
                                    │
                                    │ Processed Data
                                    ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│                         HMS Database Layer                                     │
│  ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│  │ hms_appointments│    │  hms_patients   │    │  hms_centers    │            │
│  │   (Primary)     │    │  (Reference)    │    │  (Reference)    │            │
│  └─────────────────┘    └─────────────────┘    └─────────────────┘            │
└─────────────────────────────────────────────────────────────────────────────────┘
                                    │
                                    │ Notifications
                                    ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│                      Notification Services                                     │
│  ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│  │   WhatsApp      │    │   SMS Service   │    │   Email         │            │
│  │   Notifications │    │   Notifications │    │   Notifications │            │
│  └─────────────────┘    └─────────────────┘    └─────────────────┘            │
└─────────────────────────────────────────────────────────────────────────────────┘
```

## Detailed Data Flow Process

### Step 1: Data Reception
```
LeadSquare CRM
    │
    │ POST /Api/myappointment_leadsqure
    │ Content-Type: application/json
    │
    ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│ JSON Payload Structure:                                                        │
│ {                                                                              │
│   "EmailAddress": "patient@example.com",                                      │
│   "ActivityNote": "Consultation reason",                                      │
│   "LeadID": "LS123456",                                                       │
│   "FirstName": "Priya",                                                       │
│   "HusbandName": "Raj",                                                       │
│   "Phone": "+91-9876543210",                                                  │
│   "ActivityDateTime": "2024-01-15 10:00:00",                                  │
│   "Fields": [                                                                  │
│     {"SchemaName": "mx_Centre_Location", "Value": "101"},                     │
│     {"SchemaName": "mx_Doctor", "Value": "DOC001"},                           │
│     {"SchemaName": "mx_appoitmented_date", "Value": "2024-01-15"},            │
│     {"SchemaName": "mx_appoitmented_slot", "Value": "10:00 AM"}               │
│   ]                                                                            │
│ }                                                                              │
└─────────────────────────────────────────────────────────────────────────────────┘
```

### Step 2: Data Processing Pipeline
```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           Data Processing Pipeline                             │
│                                                                                 │
│ 1. JSON Parsing                                                                │
│    ├─ Extract EmailAddress                                                     │
│    ├─ Extract ActivityNote                                                     │
│    ├─ Extract LeadID                                                           │
│    ├─ Extract FirstName                                                        │
│    ├─ Extract HusbandName                                                      │
│    ├─ Extract Phone (clean +91- prefix)                                        │
│    ├─ Extract ActivityDateTime                                                 │
│    └─ Extract Fields array                                                     │
│                                                                                 │
│ 2. Field Validation                                                            │
│    ├─ Check FirstName (required)                                               │
│    ├─ Check Phone (required)                                                   │
│    └─ Validate email format (optional)                                         │
│                                                                                 │
│ 3. Business Logic Checks                                                       │
│    ├─ search_appointment(phone) → Check duplicates                             │
│    ├─ search_patient(phone) → Determine patient type                           │
│    └─ Map center codes → Internal center IDs                                   │
│                                                                                 │
│ 4. Data Transformation                                                         │
│    ├─ Clean phone number                                                       │
│    ├─ Generate/retrieve patient ID                                             │
│    ├─ Map CRM fields to internal structure                                     │
│    └─ Set default values                                                       │
└─────────────────────────────────────────────────────────────────────────────────┘
```

### Step 3: Database Operations
```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           Database Operations                                  │
│                                                                                 │
│ 1. Duplicate Check Query:                                                      │
│    SELECT * FROM hms_appointments                                              │
│    WHERE wife_phone = '{cleaned_phone}'                                        │
│    AND (status = 'booked' OR status = 'rescheduled')                           │
│                                                                                 │
│ 2. Patient Lookup Query:                                                       │
│    SELECT * FROM hms_patients                                                  │
│    WHERE patient_phone = '{cleaned_phone}'                                     │
│                                                                                 │
│ 3. Appointment Insert Query:                                                   │
│    INSERT INTO hms_appointments SET                                            │
│    paitent_id = '{patient_id}',                                                │
│    paitent_type = '{patient_type}',                                            │
│    wife_name = '{first_name}',                                                 │
│    husband_name = '{husband_name}',                                            │
│    wife_phone = '{cleaned_phone}',                                             │
│    wife_email = '{email}',                                                     │
│    nationality = 'indian',                                                     │
│    crm_id = '{lead_id}',                                                       │
│    reason_of_visit = '{activity_note}',                                        │
│    appoitment_for = '{mapped_center_id}',                                      │
│    appoitmented_doctor = '{doctor_id}',                                        │
│    appoitmented_date = '{appointment_date}',                                   │
│    appoitmented_slot = '{time_slot}',                                          │
│    appointment_added = NOW()                                                   │
└─────────────────────────────────────────────────────────────────────────────────┘
```

### Step 4: Response Flow
```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           Response Generation                                  │
│                                                                                 │
│ Success Path:                                                                   │
│ ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│ │ Database Insert │───▶│ Send Notifications│───▶│ Success Response│            │
│ │ (Returns ID)    │    │ (WhatsApp/SMS)  │    │ (200 OK)        │            │
│ └─────────────────┘    └─────────────────┘    └─────────────────┘            │
│                                                                                 │
│ Error Paths:                                                                    │
│ ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│ │ Missing Fields  │───▶│ Validation Error│───▶│ 400 Bad Request │            │
│ └─────────────────┘    └─────────────────┘    └─────────────────┘            │
│                                                                                 │
│ ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│ │ Duplicate Found │───▶│ Conflict Error  │───▶│ 409 Conflict    │            │
│ └─────────────────┘    └─────────────────┘    └─────────────────┘            │
│                                                                                 │
│ ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐            │
│ │ Database Error  │───▶│ System Error    │───▶│ 500 Server Error│            │
│ └─────────────────┘    └─────────────────┘    └─────────────────┘            │
└─────────────────────────────────────────────────────────────────────────────────┘
```

## Error Handling Flow

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           Error Handling Process                               │
│                                                                                 │
│ Input Validation Errors:                                                        │
│ ┌─────────────────┐                                                             │
│ │ Required Fields │───▶ Return 400 Bad Request                                 │
│ │ Missing         │    {                                                       │
│ └─────────────────┘       "status": 0,                                         │
│                           "message": "FirstName and Phone required"            │
│                         }                                                      │
│                                                                                 │
│ Business Logic Errors:                                                          │
│ ┌─────────────────┐                                                             │
│ │ Duplicate       │───▶ Return 409 Conflict                                    │
│ │ Appointment     │    {                                                       │
│ └─────────────────┘       "status": 0,                                         │
│                           "message": "Appointment already booked"               │
│                         }                                                      │
│                                                                                 │
│ System Errors:                                                                  │
│ ┌─────────────────┐                                                             │
│ │ Database        │───▶ Return 500 Server Error                                │
│ │ Connection      │    {                                                       │
│ │ Issues          │       "status": 0,                                         │
│ └─────────────────┘       "message": "Something went wrong!"                   │
│                         }                                                      │
└─────────────────────────────────────────────────────────────────────────────────┘
```

## Notification Flow

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           Notification Process                                 │
│                                                                                 │
│ After Successful Appointment Creation:                                          │
│                                                                                 │
│ 1. WhatsApp Notification:                                                       │
│    ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐          │
│    │ Get Center      │───▶│ Format Message  │───▶│ Send WhatsApp   │          │
│    │ Details         │    │ with Appointment│    │ Message         │          │
│    └─────────────────┘    └─────────────────┘    └─────────────────┘          │
│                                                                                 │
│ 2. Email Notification:                                                          │
│    ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐          │
│    │ Get Doctor      │───▶│ Format Email    │───▶│ Send Email      │          │
│    │ Details         │    │ Template        │    │ Notification    │          │
│    └─────────────────┘    └─────────────────┘    └─────────────────┘          │
│                                                                                 │
│ 3. SMS Notification:                                                            │
│    ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐          │
│    │ Format SMS      │───▶│ Send SMS        │───▶│ Log Result      │          │
│    │ Message         │    │ Message         │    │                 │          │
│    └─────────────────┘    └─────────────────┘    └─────────────────┘          │
└─────────────────────────────────────────────────────────────────────────────────┘
```

## Data Mapping Reference

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           CRM to HMS Field Mapping                            │
│                                                                                 │
│ LeadSquare CRM Fields    │    HMS Database Fields    │    Transformation      │
│ ──────────────────────── │ ───────────────────────── │ ──────────────────────  │
│ EmailAddress             │ wife_email                │ Direct mapping          │
│ ActivityNote             │ reason_of_visit           │ Direct mapping          │
│ LeadID                   │ crm_id                    │ Direct mapping          │
│ FirstName                │ wife_name                 │ Direct mapping          │
│ HusbandName              │ husband_name              │ Direct mapping          │
│ Phone                    │ wife_phone                │ Remove +91- prefix      │
│ ActivityDateTime         │ (not stored)              │ Used for processing     │
│ Fields[].Value where     │                          │                        │
│ SchemaName =             │                          │                        │
│   mx_Centre_Location     │ appoitment_for            │ Map to center ID        │
│   mx_Doctor              │ appoitmented_doctor       │ Direct mapping          │
│   mx_appoitmented_date   │ appoitmented_date         │ Direct mapping          │
│   mx_appoitmented_slot   │ appoitmented_slot         │ Direct mapping          │
│ (Generated)              │ paitent_id                │ GUID or existing ID     │
│ (Determined)             │ paitent_type              │ new_patient/exist_patient│
│ (Default)                │ nationality               │ 'indian'                │
│ (System)                 │ appointment_added         │ Current timestamp       │
│ (Default)                │ status                    │ 'booked'                │
└─────────────────────────────────────────────────────────────────────────────────┘
```

## Performance Metrics

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           Performance Considerations                           │
│                                                                                 │
│ Response Time Targets:                                                          │
│ ├─ API Response Time: < 2 seconds                                              │
│ ├─ Database Query Time: < 500ms                                                │
│ └─ Notification Send Time: < 5 seconds                                         │
│                                                                                 │
│ Throughput Capacity:                                                            │
│ ├─ Concurrent Requests: 100 requests/minute                                    │
│ ├─ Peak Load Handling: 500 requests/minute                                     │
│ └─ Database Connections: 50 concurrent connections                             │
│                                                                                 │
│ Error Rate Targets:                                                             │
│ ├─ API Success Rate: > 99%                                                     │
│ ├─ Database Success Rate: > 99.9%                                              │
│ └─ Notification Success Rate: > 95%                                            │
└─────────────────────────────────────────────────────────────────────────────────┘
```

---

**Note**: This diagram represents the current implementation. For any modifications or enhancements, please refer to the main documentation file.
