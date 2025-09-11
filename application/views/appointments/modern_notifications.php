<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-bell"></i> Notification Center
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-bell"></i> Notifications</li>
            </ol>
        </div>
    </div>

    <!-- Notification Filters -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-filter"></i> Notification Filters
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" id="type_filter">
                                    <option value="">All Types</option>
                                    <option value="appointment">Appointment</option>
                                    <option value="reminder">Reminder</option>
                                    <option value="cancellation">Cancellation</option>
                                    <option value="reschedule">Reschedule</option>
                                    <option value="system">System</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="status_filter">
                                    <option value="">All Status</option>
                                    <option value="unread">Unread</option>
                                    <option value="read">Read</option>
                                    <option value="sent">Sent</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date Range</label>
                                <select class="form-control" id="date_filter">
                                    <option value="today">Today</option>
                                    <option value="week">This Week</option>
                                    <option value="month" selected>This Month</option>
                                    <option value="all">All Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div>
                                    <button class="btn btn-primary waves-effect waves-dark" onclick="loadNotifications()">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </button>
                                    <button class="btn btn-success waves-effect waves-dark" onclick="markAllRead()">
                                        <i class="fa fa-check"></i> Mark All Read
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Stats -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bell fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="totalNotifications">0</div>
                            <div>Total Notifications</div>
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
                            <i class="fa fa-envelope fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="unreadNotifications">0</div>
                            <div>Unread</div>
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
                            <div class="huge" id="sentNotifications">0</div>
                            <div>Sent Today</div>
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
                            <i class="fa fa-exclamation-triangle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="failedNotifications">0</div>
                            <div>Failed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-list"></i> Notifications
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="notificationsTable">
                            <thead>
                                <tr>
                                    <th width="5%">
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th width="10%">Type</th>
                                    <th width="15%">Recipient</th>
                                    <th width="30%">Message</th>
                                    <th width="10%">Channel</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Date</th>
                                    <th width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="notificationsTableBody">
                                <!-- Sample notifications -->
                                <tr class="unread">
                                    <td><input type="checkbox" class="notification-checkbox" value="1"></td>
                                    <td><span class="badge badge-primary">Appointment</span></td>
                                    <td>John Doe</td>
                                    <td>Your appointment with Dr. Smith is scheduled for tomorrow at 10:00 AM</td>
                                    <td><i class="fa fa-envelope"></i> Email</td>
                                    <td><span class="badge badge-success">Sent</span></td>
                                    <td>2024-01-15 09:30</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewNotification(1)">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="unread">
                                    <td><input type="checkbox" class="notification-checkbox" value="2"></td>
                                    <td><span class="badge badge-warning">Reminder</span></td>
                                    <td>Jane Smith</td>
                                    <td>Reminder: Your appointment is in 2 hours</td>
                                    <td><i class="fa fa-mobile"></i> SMS</td>
                                    <td><span class="badge badge-success">Sent</span></td>
                                    <td>2024-01-15 08:00</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewNotification(2)">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="notification-checkbox" value="3"></td>
                                    <td><span class="badge badge-danger">Cancellation</span></td>
                                    <td>Mike Johnson</td>
                                    <td>Your appointment has been cancelled due to doctor unavailability</td>
                                    <td><i class="fa fa-phone"></i> Call</td>
                                    <td><span class="badge badge-success">Sent</span></td>
                                    <td>2024-01-14 16:45</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewNotification(3)">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="notification-checkbox" value="4"></td>
                                    <td><span class="badge badge-info">Reschedule</span></td>
                                    <td>Sarah Wilson</td>
                                    <td>Your appointment has been rescheduled to next week</td>
                                    <td><i class="fa fa-whatsapp"></i> WhatsApp</td>
                                    <td><span class="badge badge-warning">Failed</span></td>
                                    <td>2024-01-14 14:20</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="viewNotification(4)">
                                            <i class="fa fa-eye"></i>
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

    <!-- Bulk Actions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Bulk Actions</h3>
                </div>
                <div class="panel-body">
                    <div class="btn-group">
                        <button class="btn btn-primary" onclick="bulkMarkRead()">
                            <i class="fa fa-check"></i> Mark Selected as Read
                        </button>
                        <button class="btn btn-warning" onclick="bulkResend()">
                            <i class="fa fa-refresh"></i> Resend Selected
                        </button>
                        <button class="btn btn-danger" onclick="bulkDelete()">
                            <i class="fa fa-trash"></i> Delete Selected
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Detail Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Notification Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="notificationDetails">
                <!-- Details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="resendNotification()">Resend</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Select all checkbox
    $('#selectAll').change(function() {
        $('.notification-checkbox').prop('checked', $(this).prop('checked'));
    });

    // Individual checkbox change
    $(document).on('change', '.notification-checkbox', function() {
        var totalCheckboxes = $('.notification-checkbox').length;
        var checkedCheckboxes = $('.notification-checkbox:checked').length;
        $('#selectAll').prop('checked', totalCheckboxes === checkedCheckboxes);
    });

    // Load initial notifications
    loadNotifications();
});

function loadNotifications() {
    var type = $('#type_filter').val();
    var status = $('#status_filter').val();
    var dateRange = $('#date_filter').val();

    // Simulate loading notifications
    // In real implementation, this would make an AJAX call
    updateNotificationStats();
}

function updateNotificationStats() {
    // Update stats (in real implementation, these would come from server)
    $('#totalNotifications').text('156');
    $('#unreadNotifications').text('12');
    $('#sentNotifications').text('45');
    $('#failedNotifications').text('3');
}

function viewNotification(id) {
    // Load notification details
    var details = '<div class="notification-detail">';
    details += '<h5>Notification #' + id + '</h5>';
    details += '<p><strong>Type:</strong> Appointment Reminder</p>';
    details += '<p><strong>Recipient:</strong> John Doe (john@example.com)</p>';
    details += '<p><strong>Channel:</strong> Email</p>';
    details += '<p><strong>Status:</strong> Sent</p>';
    details += '<p><strong>Date:</strong> 2024-01-15 09:30:00</p>';
    details += '<p><strong>Message:</strong></p>';
    details += '<div class="well">Your appointment with Dr. Smith is scheduled for tomorrow at 10:00 AM. Please arrive 15 minutes early.</div>';
    details += '<p><strong>Response:</strong> Delivered successfully</p>';
    details += '</div>';
    
    $('#notificationDetails').html(details);
    $('#notificationModal').modal('show');
}

function resendNotification() {
    if (confirm('Are you sure you want to resend this notification?')) {
        // Implementation for resending notification
        alert('Notification resent successfully!');
        $('#notificationModal').modal('hide');
    }
}

function markAllRead() {
    if (confirm('Are you sure you want to mark all notifications as read?')) {
        $('.unread').removeClass('unread');
        updateNotificationStats();
        alert('All notifications marked as read!');
    }
}

function bulkMarkRead() {
    var selectedIds = getSelectedNotificationIds();
    if (selectedIds.length === 0) {
        alert('Please select notifications to mark as read.');
        return;
    }
    
    if (confirm('Are you sure you want to mark selected notifications as read?')) {
        // Implementation for bulk mark as read
        selectedIds.forEach(function(id) {
            $('tr').has('input[value="' + id + '"]').removeClass('unread');
        });
        updateNotificationStats();
        alert('Selected notifications marked as read!');
    }
}

function bulkResend() {
    var selectedIds = getSelectedNotificationIds();
    if (selectedIds.length === 0) {
        alert('Please select notifications to resend.');
        return;
    }
    
    if (confirm('Are you sure you want to resend selected notifications?')) {
        // Implementation for bulk resend
        alert('Selected notifications resent successfully!');
    }
}

function bulkDelete() {
    var selectedIds = getSelectedNotificationIds();
    if (selectedIds.length === 0) {
        alert('Please select notifications to delete.');
        return;
    }
    
    if (confirm('Are you sure you want to delete selected notifications?')) {
        // Implementation for bulk delete
        selectedIds.forEach(function(id) {
            $('tr').has('input[value="' + id + '"]').remove();
        });
        updateNotificationStats();
        alert('Selected notifications deleted successfully!');
    }
}

function getSelectedNotificationIds() {
    var selectedIds = [];
    $('.notification-checkbox:checked').each(function() {
        selectedIds.push($(this).val());
    });
    return selectedIds;
}
</script>

<style>
.unread {
    background-color: #f9f9f9;
    font-weight: bold;
}

.notification-checkbox {
    margin: 0;
}

.badge {
    font-size: 0.8em;
}

.well {
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    padding: 10px;
    margin: 10px 0;
}
</style>
