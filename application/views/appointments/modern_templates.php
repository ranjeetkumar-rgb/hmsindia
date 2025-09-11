<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-file-text"></i> Message Templates
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-file-text"></i> Templates</li>
            </ol>
        </div>
    </div>

    <!-- Template Actions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-cog"></i> Template Management
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-success waves-effect waves-dark" onclick="createTemplate()">
                                <i class="fa fa-plus"></i> Create New Template
                            </button>
                            <button class="btn btn-info waves-effect waves-dark" onclick="importTemplates()">
                                <i class="fa fa-upload"></i> Import Templates
                            </button>
                            <button class="btn btn-warning waves-effect waves-dark" onclick="exportTemplates()">
                                <i class="fa fa-download"></i> Export Templates
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchTemplates" placeholder="Search templates...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Categories -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Template Categories</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#appointment_templates" aria-controls="appointment_templates" role="tab" data-toggle="tab">
                                <i class="fa fa-calendar"></i> Appointment Templates
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#reminder_templates" aria-controls="reminder_templates" role="tab" data-toggle="tab">
                                <i class="fa fa-bell"></i> Reminder Templates
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#cancellation_templates" aria-controls="cancellation_templates" role="tab" data-toggle="tab">
                                <i class="fa fa-times"></i> Cancellation Templates
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#reschedule_templates" aria-controls="reschedule_templates" role="tab" data-toggle="tab">
                                <i class="fa fa-refresh"></i> Reschedule Templates
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#sms_templates" aria-controls="sms_templates" role="tab" data-toggle="tab">
                                <i class="fa fa-mobile"></i> SMS Templates
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Appointment Templates -->
                        <div role="tabpanel" class="tab-pane active" id="appointment_templates">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Channel</th>
                                            <th>Subject</th>
                                            <th>Last Modified</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Appointment Confirmation</td>
                                            <td><span class="badge badge-primary">Appointment</span></td>
                                            <td><i class="fa fa-envelope"></i> Email</td>
                                            <td>Appointment Confirmed - {{patient_name}}</td>
                                            <td>2024-01-15 10:30</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" onclick="editTemplate(1)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-xs btn-warning" onclick="previewTemplate(1)">
                                                    <i class="fa fa-eye"></i> Preview
                                                </button>
                                                <button class="btn btn-xs btn-danger" onclick="deleteTemplate(1)">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>New Appointment Booking</td>
                                            <td><span class="badge badge-primary">Appointment</span></td>
                                            <td><i class="fa fa-envelope"></i> Email</td>
                                            <td>New Appointment Booked - {{patient_name}}</td>
                                            <td>2024-01-14 15:45</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" onclick="editTemplate(2)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-xs btn-warning" onclick="previewTemplate(2)">
                                                    <i class="fa fa-eye"></i> Preview
                                                </button>
                                                <button class="btn btn-xs btn-danger" onclick="deleteTemplate(2)">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Reminder Templates -->
                        <div role="tabpanel" class="tab-pane" id="reminder_templates">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Channel</th>
                                            <th>Subject</th>
                                            <th>Last Modified</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>24 Hour Reminder</td>
                                            <td><span class="badge badge-warning">Reminder</span></td>
                                            <td><i class="fa fa-mobile"></i> SMS</td>
                                            <td>Appointment Reminder - Tomorrow</td>
                                            <td>2024-01-15 09:15</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" onclick="editTemplate(3)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-xs btn-warning" onclick="previewTemplate(3)">
                                                    <i class="fa fa-eye"></i> Preview
                                                </button>
                                                <button class="btn btn-xs btn-danger" onclick="deleteTemplate(3)">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 Hour Reminder</td>
                                            <td><span class="badge badge-warning">Reminder</span></td>
                                            <td><i class="fa fa-mobile"></i> SMS</td>
                                            <td>Appointment in 2 Hours</td>
                                            <td>2024-01-14 16:20</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" onclick="editTemplate(4)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-xs btn-warning" onclick="previewTemplate(4)">
                                                    <i class="fa fa-eye"></i> Preview
                                                </button>
                                                <button class="btn btn-xs btn-danger" onclick="deleteTemplate(4)">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Cancellation Templates -->
                        <div role="tabpanel" class="tab-pane" id="cancellation_templates">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Channel</th>
                                            <th>Subject</th>
                                            <th>Last Modified</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Appointment Cancelled</td>
                                            <td><span class="badge badge-danger">Cancellation</span></td>
                                            <td><i class="fa fa-envelope"></i> Email</td>
                                            <td>Appointment Cancelled - {{patient_name}}</td>
                                            <td>2024-01-13 11:30</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" onclick="editTemplate(5)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-xs btn-warning" onclick="previewTemplate(5)">
                                                    <i class="fa fa-eye"></i> Preview
                                                </button>
                                                <button class="btn btn-xs btn-danger" onclick="deleteTemplate(5)">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Reschedule Templates -->
                        <div role="tabpanel" class="tab-pane" id="reschedule_templates">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Channel</th>
                                            <th>Subject</th>
                                            <th>Last Modified</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Appointment Rescheduled</td>
                                            <td><span class="badge badge-info">Reschedule</span></td>
                                            <td><i class="fa fa-envelope"></i> Email</td>
                                            <td>Appointment Rescheduled - {{patient_name}}</td>
                                            <td>2024-01-12 14:45</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" onclick="editTemplate(6)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-xs btn-warning" onclick="previewTemplate(6)">
                                                    <i class="fa fa-eye"></i> Preview
                                                </button>
                                                <button class="btn btn-xs btn-danger" onclick="deleteTemplate(6)">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- SMS Templates -->
                        <div role="tabpanel" class="tab-pane" id="sms_templates">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Channel</th>
                                            <th>Message</th>
                                            <th>Last Modified</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Quick SMS Reminder</td>
                                            <td><span class="badge badge-warning">Reminder</span></td>
                                            <td><i class="fa fa-mobile"></i> SMS</td>
                                            <td>Hi {{patient_name}}, your appointment is tomorrow at {{time}} with Dr. {{doctor_name}}</td>
                                            <td>2024-01-15 08:30</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-xs btn-info" onclick="editTemplate(7)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-xs btn-warning" onclick="previewTemplate(7)">
                                                    <i class="fa fa-eye"></i> Preview
                                                </button>
                                                <button class="btn btn-xs btn-danger" onclick="deleteTemplate(7)">
                                                    <i class="fa fa-trash"></i> Delete
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
    </div>
</div>

<!-- Template Editor Modal -->
<div class="modal fade" id="templateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="templateModalTitle">Create Template</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="templateForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Template Name</label>
                                <input type="text" class="form-control" name="template_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Template Type</label>
                                <select class="form-control" name="template_type" required>
                                    <option value="">Select Type</option>
                                    <option value="appointment">Appointment</option>
                                    <option value="reminder">Reminder</option>
                                    <option value="cancellation">Cancellation</option>
                                    <option value="reschedule">Reschedule</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Channel</label>
                                <select class="form-control" name="channel" required>
                                    <option value="">Select Channel</option>
                                    <option value="email">Email</option>
                                    <option value="sms">SMS</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="call">Phone Call</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Enter subject line">
                    </div>
                    <div class="form-group">
                        <label>Message Content</label>
                        <textarea class="form-control" name="content" rows="10" required placeholder="Enter your message content. Use variables like {{patient_name}}, {{doctor_name}}, {{appointment_date}}, {{appointment_time}}"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Available Variables</label>
                        <div class="well">
                            <code>{{patient_name}}</code> - Patient's name<br>
                            <code>{{doctor_name}}</code> - Doctor's name<br>
                            <code>{{appointment_date}}</code> - Appointment date<br>
                            <code>{{appointment_time}}</code> - Appointment time<br>
                            <code>{{center_name}}</code> - Center name<br>
                            <code>{{center_address}}</code> - Center address<br>
                            <code>{{patient_phone}}</code> - Patient's phone number<br>
                            <code>{{patient_email}}</code> - Patient's email
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveTemplate()">Save Template</button>
            </div>
        </div>
    </div>
</div>

<!-- Template Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Template Preview</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="previewContent">
                <!-- Preview content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Search functionality
    $('#searchTemplates').keyup(function() {
        var searchTerm = $(this).val().toLowerCase();
        $('table tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            if (rowText.indexOf(searchTerm) === -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });
});

function createTemplate() {
    $('#templateModalTitle').text('Create New Template');
    $('#templateForm')[0].reset();
    $('#templateModal').modal('show');
}

function editTemplate(id) {
    $('#templateModalTitle').text('Edit Template');
    // Load template data
    $('#templateModal').modal('show');
}

function previewTemplate(id) {
    var previewContent = '<div class="template-preview">';
    previewContent += '<h5>Template Preview</h5>';
    previewContent += '<div class="well">';
    previewContent += '<strong>Subject:</strong> Appointment Confirmed - John Doe<br><br>';
    previewContent += '<strong>Content:</strong><br>';
    previewContent += 'Dear John Doe,<br><br>';
    previewContent += 'Your appointment with Dr. Smith has been confirmed for tomorrow (January 16, 2024) at 10:00 AM.<br><br>';
    previewContent += 'Please arrive 15 minutes early for your appointment.<br><br>';
    previewContent += 'If you need to reschedule or cancel, please contact us at least 24 hours in advance.<br><br>';
    previewContent += 'Best regards,<br>';
    previewContent += 'IndiaIVF Team';
    previewContent += '</div>';
    previewContent += '</div>';
    
    $('#previewContent').html(previewContent);
    $('#previewModal').modal('show');
}

function deleteTemplate(id) {
    if (confirm('Are you sure you want to delete this template?')) {
        // Implementation for deleting template
        alert('Template deleted successfully!');
    }
}

function saveTemplate() {
    var formData = $('#templateForm').serialize();
    
    // Validation
    if (!$('input[name="template_name"]').val()) {
        alert('Please enter a template name.');
        return;
    }
    
    if (!$('select[name="template_type"]').val()) {
        alert('Please select a template type.');
        return;
    }
    
    if (!$('select[name="channel"]').val()) {
        alert('Please select a channel.');
        return;
    }
    
    if (!$('textarea[name="content"]').val()) {
        alert('Please enter template content.');
        return;
    }
    
    // Save template (implementation would go here)
    alert('Template saved successfully!');
    $('#templateModal').modal('hide');
}

function importTemplates() {
    alert('Import templates functionality would be implemented here.');
}

function exportTemplates() {
    alert('Export templates functionality would be implemented here.');
}
</script>

<style>
.template-preview {
    font-family: Arial, sans-serif;
}

.template-preview .well {
    background-color: #f9f9f9;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    padding: 15px;
    margin: 10px 0;
}

code {
    background-color: #f5f5f5;
    padding: 2px 4px;
    border-radius: 3px;
    font-size: 0.9em;
}

.well code {
    background-color: #e8e8e8;
    margin: 2px;
    display: inline-block;
}
</style>
