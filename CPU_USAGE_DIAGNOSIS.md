# HMS India - High CPU Usage Diagnosis & Solutions

## 🚨 **Problem Summary**
Your HMS India server is showing 98% CPU usage even when no users are actively using the system. This indicates background processes or inefficient code that's consuming resources continuously.

## 🔍 **Root Cause Analysis**

### **1. Infinite Loop in JavaScript (CRITICAL)**
**Location**: `application/views/billings/procedure_package.php` (Line 487)

```javascript
while (true) {
    let field = document.getElementById('after_discount_' + i);
    if (!field) break;
    // ... processing
    i++;
}
```

**Issue**: This infinite loop runs continuously in the browser, consuming CPU resources.

### **2. Background Scripts Running**
**Location**: `application/views/accounts/run-one-constantly`

```bash
while true; do
    # Run the specified command
    flock -xn "$FLAG" "$@"
    # ... processing
    sleep $backoff
done
```

**Issue**: Background processes that run continuously with minimal sleep intervals.

### **3. Excessive Logging**
**Found**: 166+ `error_log` and `log_message` calls across 20+ files

**Issue**: Heavy logging operations can consume significant CPU, especially if:
- Log files are large
- Logging is set to debug level
- Multiple processes are writing to logs simultaneously

### **4. Database Query Performance Issues**
**Issues Found**:
- Complex JOIN queries without proper indexing
- Unserialize operations in loops
- Multiple database calls in revenue calculation views
- Missing query optimization

### **5. Session Management Overhead**
**Location**: `system/libraries/Session/Session.php`

**Issue**: Session regeneration and cookie management running frequently.

## 🛠️ **Immediate Solutions**

### **1. Fix JavaScript Infinite Loop (URGENT)**

**File**: `application/views/billings/procedure_package.php`

**Replace**:
```javascript
while (true) {
    let field = document.getElementById('after_discount_' + i);
    if (!field) break;
    // ... processing
    i++;
}
```

**With**:
```javascript
let maxIterations = 1000; // Safety limit
let iterations = 0;

while (iterations < maxIterations) {
    let field = document.getElementById('after_discount_' + i);
    if (!field) break;
    // ... processing
    i++;
    iterations++;
}
```

### **2. Optimize Background Scripts**

**File**: `application/views/accounts/run-one-constantly`

**Increase sleep intervals**:
```bash
# Change from minimal sleep to reasonable intervals
sleep 10  # Instead of 0.5 or 1 second
```

### **3. Reduce Logging Overhead**

**File**: `application/config/config.php`

**Change logging level**:
```php
// Production environment
$config['log_threshold'] = 1; // Only errors, not all messages

// Development environment  
$config['log_threshold'] = 2; // Only errors and debug messages
```

### **4. Optimize Database Queries**

**Add database indexes**:
```sql
-- Add indexes for frequently queried columns
ALTER TABLE hms_appointments ADD INDEX idx_appointment_date (appointment_date);
ALTER TABLE hms_appointments ADD INDEX idx_status (status);
ALTER TABLE hms_patients ADD INDEX idx_phone (wife_phone);
ALTER TABLE hms_centers ADD INDEX idx_center_number (center_number);
```

### **5. Optimize Revenue Calculation Views**

**File**: `application/views/accounts/revenue_potential_details.php`

**Replace inefficient loops**:
```php
// Instead of multiple database calls in loops
// Use single query with JOINs
$sql = "SELECT p.*, pp.data, pp.totalpackage, pp.discount_amount 
        FROM hms_patients p 
        LEFT JOIN hms_patient_procedure pp ON p.appointment_id = pp.appointment_id 
        WHERE pp.status = 'approved'";
```

## 🔧 **Advanced Solutions**

### **1. Implement Query Caching**

**File**: `application/config/database.php`

```php
$db['default']['cache_on'] = TRUE;
$db['default']['cachedir'] = APPPATH . 'cache/db/';
$db['default']['cache_autodel'] = TRUE;
```

### **2. Optimize Session Configuration**

**File**: `application/config/config.php`

```php
// Reduce session regeneration frequency
$config['sess_time_to_update'] = 300; // 5 minutes instead of default

// Use database sessions for better performance
$config['sess_driver'] = 'database';
$config['sess_use_database'] = TRUE;
$config['sess_table_name'] = 'ci_sessions';
```

### **3. Implement Background Job Queue**

**Replace continuous loops with scheduled jobs**:
```php
// Use cron jobs instead of while(true) loops
// Add to crontab: */5 * * * * php /path/to/background_job.php
```

### **4. Add Resource Monitoring**

**Create monitoring script**:
```php
// application/helpers/monitor_helper.php
function check_cpu_usage() {
    $load = sys_getloadavg();
    if ($load[0] > 2.0) { // If load average > 2
        log_message('warning', 'High CPU usage detected: ' . $load[0]);
        // Send alert or take action
    }
}
```

## 🚀 **Quick Fix Commands**

### **1. Immediate CPU Relief**
```bash
# Kill any runaway processes
ps aux | grep php | awk '{print $2}' | xargs kill -9

# Clear log files
> application/logs/log-*.php

# Restart web server
sudo systemctl restart apache2
# or
sudo service apache2 restart
```

### **2. Database Optimization**
```sql
-- Check for long-running queries
SHOW PROCESSLIST;

-- Kill problematic queries
KILL [process_id];

-- Optimize tables
OPTIMIZE TABLE hms_appointments;
OPTIMIZE TABLE hms_patients;
OPTIMIZE TABLE hms_centers;
```

### **3. File System Cleanup**
```bash
# Clear cache
rm -rf application/cache/*

# Clear session files
rm -rf application/cache/sessions/*

# Check disk space
df -h
```

## 📊 **Monitoring & Prevention**

### **1. Add Performance Monitoring**
```php
// application/hooks/performance_hook.php
function log_performance() {
    $start_time = microtime(true);
    $memory_usage = memory_get_usage(true);
    
    // Log if execution time > 5 seconds
    if ((microtime(true) - $start_time) > 5) {
        log_message('warning', 'Slow page load detected');
    }
}
```

### **2. Set Up Alerts**
```bash
# Monitor CPU usage
watch -n 5 'top -bn1 | grep "Cpu(s)"'

# Monitor memory usage
watch -n 5 'free -h'

# Monitor disk I/O
iostat -x 5
```

### **3. Regular Maintenance**
```bash
# Daily cleanup script
#!/bin/bash
# Clear old logs
find application/logs -name "*.php" -mtime +7 -delete

# Clear old sessions
find application/cache/sessions -name "sess_*" -mtime +1 -delete

# Optimize database
mysql -u root -p -e "OPTIMIZE TABLE hms_appointments, hms_patients, hms_centers;"
```

## 🎯 **Priority Actions**

### **Immediate (Do Now)**
1. ✅ Fix JavaScript infinite loop
2. ✅ Increase sleep intervals in background scripts
3. ✅ Reduce logging level to errors only
4. ✅ Kill any runaway processes

### **Short Term (This Week)**
1. ✅ Add database indexes
2. ✅ Optimize revenue calculation queries
3. ✅ Implement query caching
4. ✅ Set up monitoring

### **Long Term (This Month)**
1. ✅ Replace while(true) loops with cron jobs
2. ✅ Implement proper background job queue
3. ✅ Add comprehensive performance monitoring
4. ✅ Regular maintenance automation

## 🔍 **Verification Steps**

### **1. Check CPU Usage**
```bash
# Before fixes
top -bn1 | grep "Cpu(s)"

# After fixes
top -bn1 | grep "Cpu(s)"
```

### **2. Check Process List**
```bash
# Look for runaway processes
ps aux | grep php | grep -v grep
```

### **3. Check Log Files**
```bash
# Monitor log growth
ls -la application/logs/
tail -f application/logs/log-*.php
```

## 📞 **Emergency Response**

If CPU usage remains high after fixes:

1. **Immediate**: Restart the server
2. **Check**: Database connection issues
3. **Verify**: No infinite loops in code
4. **Monitor**: Resource usage patterns
5. **Contact**: System administrator

---

## 🎉 **Expected Results**

After implementing these fixes:
- ✅ CPU usage should drop to normal levels (5-20%)
- ✅ System should be responsive
- ✅ Background processes should be efficient
- ✅ Database queries should be optimized
- ✅ Logging should be minimal

**Note**: Monitor the system for 24-48 hours after implementing fixes to ensure stability.
