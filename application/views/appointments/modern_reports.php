<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-chart-bar"></i> Appointment Reports
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-chart-bar"></i> Reports</li>
            </ol>
        </div>
    </div>

    <!-- Report Filters -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-filter"></i> Report Filters
                    </h3>
                </div>
                <div class="panel-body">
                    <form id="reportFilters" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Doctor</label>
                                    <select class="form-control" id="doctor_filter" name="doctor_id">
                                        <option value="">All Doctors</option>
                                        <?php foreach($doctors as $doctor): ?>
                                            <option value="<?php echo $doctor['ID']; ?>">Dr. <?php echo $doctor['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Center</label>
                                    <select class="form-control" id="center_filter" name="center_id">
                                        <option value="">All Centers</option>
                                        <?php foreach($centers as $center): ?>
                                            <option value="<?php echo $center['ID']; ?>"><?php echo $center['center_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status_filter" name="status">
                                        <option value="">All Status</option>
                                        <option value="booked">Booked</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="in_clinic">In Clinic</option>
                                        <option value="consultation">Consultation</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="rescheduled">Rescheduled</option>
                                        <option value="no_show">No Show</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Report Type</label>
                                    <select class="form-control" id="report_type" name="report_type">
                                        <option value="summary">Summary Report</option>
                                        <option value="detailed">Detailed Report</option>
                                        <option value="doctor_wise">Doctor Wise</option>
                                        <option value="center_wise">Center Wise</option>
                                        <option value="status_wise">Status Wise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-primary waves-effect waves-dark" onclick="generateReport()">
                                            <i class="fa fa-chart-bar"></i> Generate Report
                                        </button>
                                        <button type="button" class="btn btn-success waves-effect waves-dark" onclick="exportReport()">
                                            <i class="fa fa-download"></i> Export Excel
                                        </button>
                                        <button type="button" class="btn btn-info waves-effect waves-dark" onclick="exportPDF()">
                                            <i class="fa fa-file-pdf-o"></i> Export PDF
                                        </button>
                                        <a href="<?php echo base_url(); ?>appointments" class="btn btn-default waves-effect waves-dark">
                                            <i class="fa fa-arrow-left"></i> Back to Appointments
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row" id="summaryCards" style="display: none;">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-calendar fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="totalAppointments">0</div>
                            <div>Total Appointments</div>
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
                            <div class="huge" id="completedAppointments">0</div>
                            <div>Completed</div>
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
                            <i class="fa fa-clock-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="pendingAppointments">0</div>
                            <div>Pending</div>
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
                            <div class="huge" id="cancelledAppointments">0</div>
                            <div>Cancelled</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row" id="chartsSection" style="display: none;">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Appointments by Status</h3>
                </div>
                <div class="panel-body">
                    <canvas id="statusChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Appointments by Doctor</h3>
                </div>
                <div class="panel-body">
                    <canvas id="doctorChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Report Table -->
    <div class="row" id="detailedReport" style="display: none;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detailed Report</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="reportTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Phone</th>
                                    <th>Doctor</th>
                                    <th>Center</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody id="reportTableBody">
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script>
$(document).ready(function() {
    // Set default dates
    var today = new Date();
    var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    var lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    
    $('#date_from').val(firstDay.toISOString().split('T')[0]);
    $('#date_to').val(lastDay.toISOString().split('T')[0]);

    // Generate initial report
    generateReport();
});

function generateReport() {
    var formData = $('#reportFilters').serialize();
    var reportType = $('#report_type').val();
    
    $.ajax({
        url: '<?php echo base_url(); ?>appointment/getAppointments',
        type: 'GET',
        data: formData + '&limit=1000',
        dataType: 'json',
        success: function(response) {
            if (response.status && response.data.appointments) {
                displayReport(response.data.appointments, reportType);
            } else {
                alert('No data found for the selected criteria.');
            }
        },
        error: function() {
            alert('Error loading report data.');
        }
    });
}

function displayReport(appointments, reportType) {
    // Show summary cards
    $('#summaryCards').show();
    
    // Calculate summary statistics
    var total = appointments.length;
    var completed = appointments.filter(a => a.status === 'completed' || a.status === 'consultation_done').length;
    var pending = appointments.filter(a => ['booked', 'confirmed', 'in_clinic'].includes(a.status)).length;
    var cancelled = appointments.filter(a => ['cancelled', 'no_show'].includes(a.status)).length;
    
    $('#totalAppointments').text(total);
    $('#completedAppointments').text(completed);
    $('#pendingAppointments').text(pending);
    $('#cancelledAppointments').text(cancelled);
    
    // Show charts
    $('#chartsSection').show();
    createCharts(appointments);
    
    // Show detailed table if needed
    if (reportType === 'detailed') {
        $('#detailedReport').show();
        populateDetailedTable(appointments);
    } else {
        $('#detailedReport').hide();
    }
}

function createCharts(appointments) {
    // Status Chart
    var statusData = {};
    appointments.forEach(function(apt) {
        statusData[apt.status] = (statusData[apt.status] || 0) + 1;
    });
    
    var statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(statusData),
            datasets: [{
                data: Object.values(statusData),
                backgroundColor: [
                    '#5cb85c', '#5bc0de', '#f0ad4e', '#337ab7', 
                    '#d9534f', '#777', '#9c27b0', '#ff9800'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    
    // Doctor Chart
    var doctorData = {};
    appointments.forEach(function(apt) {
        var doctor = apt.doctor_name || 'Unknown';
        doctorData[doctor] = (doctorData[doctor] || 0) + 1;
    });
    
    var doctorCtx = document.getElementById('doctorChart').getContext('2d');
    new Chart(doctorCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(doctorData),
            datasets: [{
                label: 'Appointments',
                data: Object.values(doctorData),
                backgroundColor: '#5bc0de'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    beginAtZero: true
                }]
            }
        }
    });
}

function populateDetailedTable(appointments) {
    var tbody = $('#reportTableBody');
    tbody.empty();
    
    appointments.forEach(function(appointment) {
        var row = '<tr>';
        row += '<td>' + appointment.ID + '</td>';
        row += '<td>' + appointment.wife_name + '</td>';
        row += '<td>' + appointment.wife_phone + '</td>';
        row += '<td>Dr. ' + (appointment.doctor_name || 'Unknown') + '</td>';
        row += '<td>' + (appointment.center_name || 'Unknown') + '</td>';
        row += '<td>' + appointment.appoitmented_date + '</td>';
        row += '<td>' + appointment.appoitmented_slot + '</td>';
        row += '<td><span class="badge badge-' + getStatusClass(appointment.status) + '">' + appointment.status + '</span></td>';
        row += '<td>' + (appointment.reason_of_visit || 'N/A') + '</td>';
        row += '</tr>';
        tbody.append(row);
    });
}

function getStatusClass(status) {
    var classes = {
        'booked': 'primary',
        'confirmed': 'info',
        'in_clinic': 'warning',
        'consultation': 'primary',
        'completed': 'success',
        'cancelled': 'danger',
        'rescheduled': 'warning',
        'no_show': 'secondary'
    };
    return classes[status] || 'secondary';
}

function exportReport() {
    var formData = $('#reportFilters').serialize();
    window.open('<?php echo base_url(); ?>appointment/export?' + formData, '_blank');
}

function exportPDF() {
    // This would require a PDF generation library
    alert('PDF export functionality would be implemented here.');
}
</script>
