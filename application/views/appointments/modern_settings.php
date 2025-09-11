<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-cog"></i> Appointment Settings
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-cog"></i> Settings</li>
            </ol>
        </div>
    </div>

    <!-- Settings Tabs -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-cog"></i> System Settings
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                                <i class="fa fa-cog"></i> General Settings
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#time_slots" aria-controls="time_slots" role="tab" data-toggle="tab">
                                <i class="fa fa-clock-o"></i> Time Slots
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#notifications" aria-controls="notifications" role="tab" data-toggle="tab">
                                <i class="fa fa-bell"></i> Notifications
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#integrations" aria-controls="integrations" role="tab" data-toggle="tab">
                                <i class="fa fa-plug"></i> Integrations
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#backup" aria-controls="backup" role="tab" data-toggle="tab">
                                <i class="fa fa-database"></i> Backup & Restore
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- General Settings -->
                        <div role="tabpanel" class="tab-pane active" id="general">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Appointment Settings</h4>
                                    <form id="generalSettings">
                                        <div class="form-group">
                                            <label>Default Appointment Duration (minutes)</label>
                                            <input type="number" class="form-control" name="default_duration" value="30" min="15" max="120">
                                        </div>
                                        <div class="form-group">
                                            <label>Buffer Time Between Appointments (minutes)</label>
                                            <input type="number" class="form-control" name="buffer_time" value="5" min="0" max="30">
                                        </div>
                                        <div class="form-group">
                                            <label>Advance Booking Limit (days)</label>
                                            <input type="number" class="form-control" name="advance_booking" value="30" min="1" max="365">
                                        </div>
                                        <div class="form-group">
                                            <label>Same Day Booking Allowed</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="same_day_booking" checked> Allow same day booking
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Auto-confirm Appointments</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="auto_confirm" checked> Automatically confirm new appointments
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Save General Settings
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h4>Display Settings</h4>
                                    <form id="displaySettings">
                                        <div class="form-group">
                                            <label>Appointments Per Page</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10">10</option>
                                                <option value="25" selected>25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Default View</label>
                                            <select class="form-control" name="default_view">
                                                <option value="list" selected>List View</option>
                                                <option value="calendar">Calendar View</option>
                                                <option value="grid">Grid View</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Date Format</label>
                                            <select class="form-control" name="date_format">
                                                <option value="Y-m-d" selected>YYYY-MM-DD</option>
                                                <option value="d-m-Y">DD-MM-YYYY</option>
                                                <option value="m/d/Y">MM/DD/YYYY</option>
                                                <option value="d/m/Y">DD/MM/YYYY</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Time Format</label>
                                            <select class="form-control" name="time_format">
                                                <option value="24" selected>24 Hour (14:30)</option>
                                                <option value="12">12 Hour (2:30 PM)</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Save Display Settings
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Time Slots -->
                        <div role="tabpanel" class="tab-pane" id="time_slots">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Available Time Slots</h4>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <button class="btn btn-success btn-sm" onclick="addTimeSlot()">
                                                <i class="fa fa-plus"></i> Add Time Slot
                                            </button>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="timeSlotsTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Duration (min)</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>09:00</td>
                                                            <td>09:30</td>
                                                            <td>30</td>
                                                            <td><span class="badge badge-success">Active</span></td>
                                                            <td>
                                                                <button class="btn btn-xs btn-warning" onclick="editTimeSlot(1)">Edit</button>
                                                                <button class="btn btn-xs btn-danger" onclick="deleteTimeSlot(1)">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>09:30</td>
                                                            <td>10:00</td>
                                                            <td>30</td>
                                                            <td><span class="badge badge-success">Active</span></td>
                                                            <td>
                                                                <button class="btn btn-xs btn-warning" onclick="editTimeSlot(2)">Edit</button>
                                                                <button class="btn btn-xs btn-danger" onclick="deleteTimeSlot(2)">Delete</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div role="tabpanel" class="tab-pane" id="notifications">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Email Notifications</h4>
                                    <form id="emailSettings">
                                        <div class="form-group">
                                            <label>SMTP Host</label>
                                            <input type="text" class="form-control" name="smtp_host" value="smtp.gmail.com">
                                        </div>
                                        <div class="form-group">
                                            <label>SMTP Port</label>
                                            <input type="number" class="form-control" name="smtp_port" value="587">
                                        </div>
                                        <div class="form-group">
                                            <label>SMTP Username</label>
                                            <input type="email" class="form-control" name="smtp_username">
                                        </div>
                                        <div class="form-group">
                                            <label>SMTP Password</label>
                                            <input type="password" class="form-control" name="smtp_password">
                                        </div>
                                        <div class="form-group">
                                            <label>From Email</label>
                                            <input type="email" class="form-control" name="from_email">
                                        </div>
                                        <div class="form-group">
                                            <label>From Name</label>
                                            <input type="text" class="form-control" name="from_name" value="IndiaIVF Appointments">
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Save Email Settings
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h4>SMS Settings</h4>
                                    <form id="smsSettings">
                                        <div class="form-group">
                                            <label>SMS Provider</label>
                                            <select class="form-control" name="sms_provider">
                                                <option value="twilio">Twilio</option>
                                                <option value="textlocal">TextLocal</option>
                                                <option value="msg91">MSG91</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>API Key</label>
                                            <input type="text" class="form-control" name="sms_api_key">
                                        </div>
                                        <div class="form-group">
                                            <label>API Secret</label>
                                            <input type="password" class="form-control" name="sms_api_secret">
                                        </div>
                                        <div class="form-group">
                                            <label>Sender ID</label>
                                            <input type="text" class="form-control" name="sms_sender_id">
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Save SMS Settings
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Integrations -->
                        <div role="tabpanel" class="tab-pane" id="integrations">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>CRM Integration</h4>
                                    <form id="crmSettings">
                                        <div class="form-group">
                                            <label>CRM Provider</label>
                                            <select class="form-control" name="crm_provider">
                                                <option value="leadsquare">LeadSquare</option>
                                                <option value="salesforce">Salesforce</option>
                                                <option value="hubspot">HubSpot</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>API Endpoint</label>
                                            <input type="url" class="form-control" name="crm_endpoint">
                                        </div>
                                        <div class="form-group">
                                            <label>API Key</label>
                                            <input type="text" class="form-control" name="crm_api_key">
                                        </div>
                                        <div class="form-group">
                                            <label>Sync Enabled</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="crm_sync_enabled"> Enable automatic sync
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Save CRM Settings
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h4>Calendar Integration</h4>
                                    <form id="calendarSettings">
                                        <div class="form-group">
                                            <label>Google Calendar</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="google_calendar_enabled"> Enable Google Calendar sync
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Outlook Calendar</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="outlook_calendar_enabled"> Enable Outlook Calendar sync
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>iCal Export</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="ical_export_enabled" checked> Enable iCal export
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Save Calendar Settings
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Backup & Restore -->
                        <div role="tabpanel" class="tab-pane" id="backup">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Backup Settings</h4>
                                    <form id="backupSettings">
                                        <div class="form-group">
                                            <label>Auto Backup</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="auto_backup_enabled" checked> Enable automatic backup
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Backup Frequency</label>
                                            <select class="form-control" name="backup_frequency">
                                                <option value="daily">Daily</option>
                                                <option value="weekly" selected>Weekly</option>
                                                <option value="monthly">Monthly</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Backup Retention (days)</label>
                                            <input type="number" class="form-control" name="backup_retention" value="30" min="7" max="365">
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Save Backup Settings
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h4>Manual Operations</h4>
                                    <div class="form-group">
                                        <button class="btn btn-success" onclick="createBackup()">
                                            <i class="fa fa-download"></i> Create Backup Now
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <label>Restore from Backup</label>
                                        <input type="file" class="form-control" id="restoreFile" accept=".sql,.zip">
                                        <button class="btn btn-warning" onclick="restoreBackup()">
                                            <i class="fa fa-upload"></i> Restore Backup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Form submissions
    $('#generalSettings').submit(function(e) {
        e.preventDefault();
        saveSettings('general', $(this).serialize());
    });

    $('#displaySettings').submit(function(e) {
        e.preventDefault();
        saveSettings('display', $(this).serialize());
    });

    $('#emailSettings').submit(function(e) {
        e.preventDefault();
        saveSettings('email', $(this).serialize());
    });

    $('#smsSettings').submit(function(e) {
        e.preventDefault();
        saveSettings('sms', $(this).serialize());
    });

    $('#crmSettings').submit(function(e) {
        e.preventDefault();
        saveSettings('crm', $(this).serialize());
    });

    $('#calendarSettings').submit(function(e) {
        e.preventDefault();
        saveSettings('calendar', $(this).serialize());
    });

    $('#backupSettings').submit(function(e) {
        e.preventDefault();
        saveSettings('backup', $(this).serialize());
    });
});

function saveSettings(type, data) {
    $.ajax({
        url: '<?php echo base_url(); ?>appointment/saveSettings',
        type: 'POST',
        data: data + '&type=' + type,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert('Settings saved successfully!');
            } else {
                alert('Error saving settings: ' + response.message);
            }
        },
        error: function() {
            alert('An error occurred while saving settings.');
        }
    });
}

function addTimeSlot() {
    var row = '<tr>';
    row += '<td><input type="time" class="form-control" value="09:00"></td>';
    row += '<td><input type="time" class="form-control" value="09:30"></td>';
    row += '<td><input type="number" class="form-control" value="30" min="15" max="120"></td>';
    row += '<td><span class="badge badge-success">Active</span></td>';
    row += '<td>';
    row += '<button class="btn btn-xs btn-success" onclick="saveTimeSlot(this)">Save</button> ';
    row += '<button class="btn btn-xs btn-danger" onclick="cancelTimeSlot(this)">Cancel</button>';
    row += '</td>';
    row += '</tr>';
    
    $('#timeSlotsTable tbody').append(row);
}

function editTimeSlot(id) {
    // Implementation for editing time slot
    alert('Edit time slot functionality would be implemented here.');
}

function deleteTimeSlot(id) {
    if (confirm('Are you sure you want to delete this time slot?')) {
        // Implementation for deleting time slot
        alert('Delete time slot functionality would be implemented here.');
    }
}

function saveTimeSlot(button) {
    // Implementation for saving time slot
    alert('Save time slot functionality would be implemented here.');
}

function cancelTimeSlot(button) {
    $(button).closest('tr').remove();
}

function createBackup() {
    if (confirm('Are you sure you want to create a backup now?')) {
        // Implementation for creating backup
        alert('Create backup functionality would be implemented here.');
    }
}

function restoreBackup() {
    var file = $('#restoreFile')[0].files[0];
    if (!file) {
        alert('Please select a backup file.');
        return;
    }
    
    if (confirm('Are you sure you want to restore from this backup? This will overwrite current data.')) {
        // Implementation for restoring backup
        alert('Restore backup functionality would be implemented here.');
    }
}
</script>
