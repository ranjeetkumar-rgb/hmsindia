<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-plug"></i> System Integrations
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-plug"></i> Integrations</li>
            </ol>
        </div>
    </div>

    <!-- Integration Status Overview -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-plug fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="totalIntegrations">8</div>
                            <div>Total Integrations</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="activeIntegrations">5</div>
                            <div>Active</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-exclamation-triangle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="warningIntegrations">2</div>
                            <div>Warnings</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-times fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="failedIntegrations">1</div>
                            <div>Failed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Integration Categories -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Available Integrations</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#crm_integrations" aria-controls="crm_integrations" role="tab" data-toggle="tab">
                                <i class="fa fa-users"></i> CRM Systems
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#calendar_integrations" aria-controls="calendar_integrations" role="tab" data-toggle="tab">
                                <i class="fa fa-calendar"></i> Calendar Systems
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#communication_integrations" aria-controls="communication_integrations" role="tab" data-toggle="tab">
                                <i class="fa fa-comments"></i> Communication
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#payment_integrations" aria-controls="payment_integrations" role="tab" data-toggle="tab">
                                <i class="fa fa-credit-card"></i> Payment Systems
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#analytics_integrations" aria-controls="analytics_integrations" role="tab" data-toggle="tab">
                                <i class="fa fa-chart-bar"></i> Analytics
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- CRM Integrations -->
                        <div role="tabpanel" class="tab-pane active" id="crm_integrations">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-users"></i> LeadSquare CRM
                                                <span class="badge badge-success pull-right">Active</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Sync appointment data with LeadSquare CRM for lead management and follow-up.</p>
                                            <p><strong>Features:</strong></p>
                                            <ul>
                                                <li>Automatic lead creation</li>
                                                <li>Appointment status sync</li>
                                                <li>Patient data synchronization</li>
                                                <li>Follow-up automation</li>
                                            </ul>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('leadsquare')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('leadsquare')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                                <button class="btn btn-warning btn-sm" onclick="viewLogs('leadsquare')">
                                                    <i class="fa fa-list"></i> Logs
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-cloud"></i> Salesforce
                                                <span class="badge badge-warning pull-right">Warning</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Integrate with Salesforce for advanced CRM capabilities and reporting.</p>
                                            <p><strong>Features:</strong></p>
                                            <ul>
                                                <li>Contact management</li>
                                                <li>Opportunity tracking</li>
                                                <li>Custom field mapping</li>
                                                <li>Advanced reporting</li>
                                            </ul>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('salesforce')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('salesforce')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                                <button class="btn btn-warning btn-sm" onclick="viewLogs('salesforce')">
                                                    <i class="fa fa-list"></i> Logs
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calendar Integrations -->
                        <div role="tabpanel" class="tab-pane" id="calendar_integrations">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-google"></i> Google Calendar
                                                <span class="badge badge-success pull-right">Active</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Sync appointments with Google Calendar for better scheduling management.</p>
                                            <p><strong>Features:</strong></p>
                                            <ul>
                                                <li>Two-way sync</li>
                                                <li>Event creation</li>
                                                <li>Reminder notifications</li>
                                                <li>Conflict detection</li>
                                            </ul>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('google_calendar')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('google_calendar')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                                <button class="btn btn-warning btn-sm" onclick="viewLogs('google_calendar')">
                                                    <i class="fa fa-list"></i> Logs
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-windows"></i> Outlook Calendar
                                                <span class="badge badge-success pull-right">Active</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Integrate with Microsoft Outlook for enterprise calendar management.</p>
                                            <p><strong>Features:</strong></p>
                                            <ul>
                                                <li>Exchange integration</li>
                                                <li>Meeting invitations</li>
                                                <li>Resource booking</li>
                                                <li>Outlook add-in</li>
                                            </ul>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('outlook')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('outlook')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                                <button class="btn btn-warning btn-sm" onclick="viewLogs('outlook')">
                                                    <i class="fa fa-list"></i> Logs
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Communication Integrations -->
                        <div role="tabpanel" class="tab-pane" id="communication_integrations">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-envelope"></i> Email Service
                                                <span class="badge badge-success pull-right">Active</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>SMTP email service for appointment notifications.</p>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('email')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('email')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-mobile"></i> SMS Gateway
                                                <span class="badge badge-success pull-right">Active</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Text messaging service for appointment reminders.</p>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('sms')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('sms')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-whatsapp"></i> WhatsApp Business
                                                <span class="badge badge-warning pull-right">Warning</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>WhatsApp Business API for appointment notifications.</p>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('whatsapp')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('whatsapp')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Integrations -->
                        <div role="tabpanel" class="tab-pane" id="payment_integrations">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-credit-card"></i> Razorpay
                                                <span class="badge badge-danger pull-right">Failed</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Payment gateway integration for appointment booking fees.</p>
                                            <p><strong>Features:</strong></p>
                                            <ul>
                                                <li>Online payments</li>
                                                <li>Refund processing</li>
                                                <li>Payment tracking</li>
                                                <li>Invoice generation</li>
                                            </ul>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('razorpay')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('razorpay')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                                <button class="btn btn-warning btn-sm" onclick="viewLogs('razorpay')">
                                                    <i class="fa fa-list"></i> Logs
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-paypal"></i> PayPal
                                                <span class="badge badge-secondary pull-right">Inactive</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>PayPal integration for international payment processing.</p>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('paypal')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('paypal')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Analytics Integrations -->
                        <div role="tabpanel" class="tab-pane" id="analytics_integrations">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-google"></i> Google Analytics
                                                <span class="badge badge-success pull-right">Active</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Track appointment booking analytics and user behavior.</p>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('google_analytics')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('google_analytics')">
                                                    <i class="fa fa-play"></i> Test
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-chart-line"></i> Mixpanel
                                                <span class="badge badge-secondary pull-right">Inactive</span>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>Advanced analytics and user tracking for appointment system.</p>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="configureIntegration('mixpanel')">
                                                    <i class="fa fa-cog"></i> Configure
                                                </button>
                                                <button class="btn btn-info btn-sm" onclick="testIntegration('mixpanel')">
                                                    <i class="fa fa-play"></i> Test
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
    </div>

    <!-- Integration Logs -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-list"></i> Recent Integration Activity
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Integration</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Message</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-01-15 10:30:15</td>
                                    <td>LeadSquare CRM</td>
                                    <td>Sync Appointment</td>
                                    <td><span class="badge badge-success">Success</span></td>
                                    <td>Appointment synced successfully</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewLogDetails(1)">
                                            <i class="fa fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-01-15 10:25:42</td>
                                    <td>Google Calendar</td>
                                    <td>Create Event</td>
                                    <td><span class="badge badge-success">Success</span></td>
                                    <td>Event created in Google Calendar</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewLogDetails(2)">
                                            <i class="fa fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-01-15 10:20:18</td>
                                    <td>Razorpay</td>
                                    <td>Process Payment</td>
                                    <td><span class="badge badge-danger">Failed</span></td>
                                    <td>Payment processing failed - Invalid API key</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewLogDetails(3)">
                                            <i class="fa fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-01-15 10:15:33</td>
                                    <td>SMS Gateway</td>
                                    <td>Send SMS</td>
                                    <td><span class="badge badge-success">Success</span></td>
                                    <td>SMS sent to patient successfully</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewLogDetails(4)">
                                            <i class="fa fa-eye"></i> View
                                        </button>
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

<!-- Integration Configuration Modal -->
<div class="modal fade" id="integrationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="integrationModalTitle">Configure Integration</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="integrationConfigForm">
                <!-- Configuration form will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveIntegrationConfig()">Save Configuration</button>
            </div>
        </div>
    </div>
</div>

<!-- Log Details Modal -->
<div class="modal fade" id="logModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Integration Log Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="logDetails">
                <!-- Log details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function configureIntegration(integrationName) {
    $('#integrationModalTitle').text('Configure ' + integrationName);
    
    var configForm = '<form id="integrationConfig">';
    configForm += '<input type="hidden" name="integration" value="' + integrationName + '">';
    
    switch(integrationName) {
        case 'leadsquare':
            configForm += '<div class="form-group"><label>API Endpoint</label><input type="url" class="form-control" name="endpoint" value="https://api.leadsquare.com/v1/"></div>';
            configForm += '<div class="form-group"><label>API Key</label><input type="text" class="form-control" name="api_key" placeholder="Enter API key"></div>';
            configForm += '<div class="form-group"><label>API Secret</label><input type="password" class="form-control" name="api_secret" placeholder="Enter API secret"></div>';
            break;
        case 'google_calendar':
            configForm += '<div class="form-group"><label>Client ID</label><input type="text" class="form-control" name="client_id" placeholder="Enter Google Client ID"></div>';
            configForm += '<div class="form-group"><label>Client Secret</label><input type="password" class="form-control" name="client_secret" placeholder="Enter Google Client Secret"></div>';
            configForm += '<div class="form-group"><label>Calendar ID</label><input type="text" class="form-control" name="calendar_id" placeholder="Enter Calendar ID"></div>';
            break;
        case 'email':
            configForm += '<div class="form-group"><label>SMTP Host</label><input type="text" class="form-control" name="smtp_host" value="smtp.gmail.com"></div>';
            configForm += '<div class="form-group"><label>SMTP Port</label><input type="number" class="form-control" name="smtp_port" value="587"></div>';
            configForm += '<div class="form-group"><label>Username</label><input type="email" class="form-control" name="username" placeholder="Enter email username"></div>';
            configForm += '<div class="form-group"><label>Password</label><input type="password" class="form-control" name="password" placeholder="Enter email password"></div>';
            break;
        case 'sms':
            configForm += '<div class="form-group"><label>SMS Provider</label><select class="form-control" name="provider"><option value="twilio">Twilio</option><option value="textlocal">TextLocal</option><option value="msg91">MSG91</option></select></div>';
            configForm += '<div class="form-group"><label>API Key</label><input type="text" class="form-control" name="api_key" placeholder="Enter API key"></div>';
            configForm += '<div class="form-group"><label>API Secret</label><input type="password" class="form-control" name="api_secret" placeholder="Enter API secret"></div>';
            break;
        default:
            configForm += '<div class="form-group"><label>Configuration</label><textarea class="form-control" name="config" rows="5" placeholder="Enter configuration details"></textarea></div>';
    }
    
    configForm += '<div class="form-group"><div class="checkbox"><label><input type="checkbox" name="enabled" checked> Enable this integration</label></div></div>';
    configForm += '</form>';
    
    $('#integrationConfigForm').html(configForm);
    $('#integrationModal').modal('show');
}

function testIntegration(integrationName) {
    if (confirm('Test ' + integrationName + ' integration?')) {
        // Simulate testing
        alert('Testing ' + integrationName + ' integration...\n\nResult: Connection successful!');
    }
}

function viewLogs(integrationName) {
    alert('Viewing logs for ' + integrationName + ' integration.\n\nThis would show detailed logs in a separate window.');
}

function viewLogDetails(logId) {
    var logDetails = '<div class="log-details">';
    logDetails += '<h5>Log Entry #' + logId + '</h5>';
    logDetails += '<table class="table table-striped">';
    logDetails += '<tr><td><strong>Timestamp:</strong></td><td>2024-01-15 10:30:15</td></tr>';
    logDetails += '<tr><td><strong>Integration:</strong></td><td>LeadSquare CRM</td></tr>';
    logDetails += '<tr><td><strong>Action:</strong></td><td>Sync Appointment</td></tr>';
    logDetails += '<tr><td><strong>Status:</strong></td><td><span class="badge badge-success">Success</span></td></tr>';
    logDetails += '<tr><td><strong>Request:</strong></td><td><pre>{"appointment_id": 123, "action": "sync"}</pre></td></tr>';
    logDetails += '<tr><td><strong>Response:</strong></td><td><pre>{"status": "success", "message": "Synced successfully"}</pre></td></tr>';
    logDetails += '<tr><td><strong>Duration:</strong></td><td>1.2 seconds</td></tr>';
    logDetails += '</table>';
    logDetails += '</div>';
    
    $('#logDetails').html(logDetails);
    $('#logModal').modal('show');
}

function saveIntegrationConfig() {
    var formData = $('#integrationConfig').serialize();
    
    // Validate form
    var requiredFields = $('#integrationConfig [required]');
    var isValid = true;
    
    requiredFields.each(function() {
        if (!$(this).val()) {
            $(this).addClass('error');
            isValid = false;
        } else {
            $(this).removeClass('error');
        }
    });
    
    if (!isValid) {
        alert('Please fill in all required fields.');
        return;
    }
    
    // Save configuration
    alert('Integration configuration saved successfully!');
    $('#integrationModal').modal('hide');
}
</script>

<style>
.panel-heading .badge {
    margin-top: 5px;
}

.error {
    border-color: #d9534f !important;
}

.log-details pre {
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    padding: 10px;
    font-size: 12px;
}

.btn-group .btn {
    margin-right: 5px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}
</style>
