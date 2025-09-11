<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-line-chart"></i> Appointment Analytics
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-line-chart"></i> Analytics</li>
            </ol>
        </div>
    </div>

    <!-- Analytics Filters -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-filter"></i> Analytics Filters
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date Range</label>
                                <select class="form-control" id="date_range">
                                    <option value="7">Last 7 days</option>
                                    <option value="30" selected>Last 30 days</option>
                                    <option value="90">Last 90 days</option>
                                    <option value="365">Last year</option>
                                    <option value="custom">Custom Range</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="custom_date_from" style="display: none;">
                            <div class="form-group">
                                <label>From Date</label>
                                <input type="date" class="form-control" id="date_from">
                            </div>
                        </div>
                        <div class="col-md-3" id="custom_date_to" style="display: none;">
                            <div class="form-group">
                                <label>To Date</label>
                                <input type="date" class="form-control" id="date_to">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Doctor</label>
                                <select class="form-control" id="doctor_filter">
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
                                <select class="form-control" id="center_filter">
                                    <option value="">All Centers</option>
                                    <?php foreach($centers as $center): ?>
                                        <option value="<?php echo $center['ID']; ?>"><?php echo $center['center_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div>
                                    <button class="btn btn-primary waves-effect waves-dark" onclick="loadAnalytics()">
                                        <i class="fa fa-refresh"></i> Update Analytics
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="row">
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
                            <div class="huge" id="completedRate">0%</div>
                            <div>Completion Rate</div>
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
                            <div class="huge" id="avgWaitTime">0 min</div>
                            <div>Avg Wait Time</div>
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
                            <div class="huge" id="cancellationRate">0%</div>
                            <div>Cancellation Rate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Appointment Trends</h3>
                </div>
                <div class="panel-body">
                    <canvas id="trendsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Status Distribution</h3>
                </div>
                <div class="panel-body">
                    <canvas id="statusChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Doctor Performance</h3>
                </div>
                <div class="panel-body">
                    <canvas id="doctorChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Peak Hours Analysis</h3>
                </div>
                <div class="panel-body">
                    <canvas id="peakHoursChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Analytics Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detailed Analytics</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="analyticsTable">
                            <thead>
                                <tr>
                                    <th>Metric</th>
                                    <th>Today</th>
                                    <th>This Week</th>
                                    <th>This Month</th>
                                    <th>Last Month</th>
                                    <th>Change</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Appointments</td>
                                    <td id="today_total">0</td>
                                    <td id="week_total">0</td>
                                    <td id="month_total">0</td>
                                    <td id="last_month_total">0</td>
                                    <td id="total_change">0%</td>
                                </tr>
                                <tr>
                                    <td>Completed Appointments</td>
                                    <td id="today_completed">0</td>
                                    <td id="week_completed">0</td>
                                    <td id="month_completed">0</td>
                                    <td id="last_month_completed">0</td>
                                    <td id="completed_change">0%</td>
                                </tr>
                                <tr>
                                    <td>Cancelled Appointments</td>
                                    <td id="today_cancelled">0</td>
                                    <td id="week_cancelled">0</td>
                                    <td id="month_cancelled">0</td>
                                    <td id="last_month_cancelled">0</td>
                                    <td id="cancelled_change">0%</td>
                                </tr>
                                <tr>
                                    <td>No Show Appointments</td>
                                    <td id="today_no_show">0</td>
                                    <td id="week_no_show">0</td>
                                    <td id="month_no_show">0</td>
                                    <td id="last_month_no_show">0</td>
                                    <td id="no_show_change">0%</td>
                                </tr>
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
    // Date range change handler
    $('#date_range').change(function() {
        if ($(this).val() === 'custom') {
            $('#custom_date_from, #custom_date_to').show();
        } else {
            $('#custom_date_from, #custom_date_to').hide();
        }
    });

    // Load initial analytics
    loadAnalytics();
});

function loadAnalytics() {
    var dateRange = $('#date_range').val();
    var dateFrom = $('#date_from').val();
    var dateTo = $('#date_to').val();
    var doctor = $('#doctor_filter').val();
    var center = $('#center_filter').val();

    // Calculate date range
    var endDate = new Date();
    var startDate = new Date();
    
    if (dateRange === 'custom') {
        startDate = new Date(dateFrom);
        endDate = new Date(dateTo);
    } else {
        startDate.setDate(endDate.getDate() - parseInt(dateRange));
    }

    // Load analytics data
    $.ajax({
        url: '<?php echo base_url(); ?>appointment/getAppointments',
        type: 'GET',
        data: {
            start_date: startDate.toISOString().split('T')[0],
            end_date: endDate.toISOString().split('T')[0],
            doctor_id: doctor,
            center_id: center,
            limit: 1000
        },
        dataType: 'json',
        success: function(response) {
            if (response.status && response.data.appointments) {
                processAnalyticsData(response.data.appointments);
            }
        },
        error: function() {
            alert('Error loading analytics data.');
        }
    });
}

function processAnalyticsData(appointments) {
    // Calculate metrics
    var total = appointments.length;
    var completed = appointments.filter(a => a.status === 'completed' || a.status === 'consultation_done').length;
    var cancelled = appointments.filter(a => a.status === 'cancelled').length;
    var noShow = appointments.filter(a => a.status === 'no_show').length;
    
    var completionRate = total > 0 ? Math.round((completed / total) * 100) : 0;
    var cancellationRate = total > 0 ? Math.round((cancelled / total) * 100) : 0;
    
    // Update key metrics
    $('#totalAppointments').text(total);
    $('#completedRate').text(completionRate + '%');
    $('#cancellationRate').text(cancellationRate + '%');
    $('#avgWaitTime').text('15 min'); // This would be calculated from actual data
    
    // Create charts
    createTrendsChart(appointments);
    createStatusChart(appointments);
    createDoctorChart(appointments);
    createPeakHoursChart(appointments);
    
    // Update detailed table
    updateDetailedTable(appointments);
}

function createTrendsChart(appointments) {
    // Group appointments by date
    var dateGroups = {};
    appointments.forEach(function(apt) {
        var date = apt.appoitmented_date;
        if (!dateGroups[date]) {
            dateGroups[date] = { total: 0, completed: 0, cancelled: 0 };
        }
        dateGroups[date].total++;
        if (apt.status === 'completed' || apt.status === 'consultation_done') {
            dateGroups[date].completed++;
        } else if (apt.status === 'cancelled') {
            dateGroups[date].cancelled++;
        }
    });
    
    var dates = Object.keys(dateGroups).sort();
    var totalData = dates.map(date => dateGroups[date].total);
    var completedData = dates.map(date => dateGroups[date].completed);
    var cancelledData = dates.map(date => dateGroups[date].cancelled);
    
    var ctx = document.getElementById('trendsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Total',
                data: totalData,
                borderColor: '#337ab7',
                backgroundColor: 'rgba(51, 122, 183, 0.1)'
            }, {
                label: 'Completed',
                data: completedData,
                borderColor: '#5cb85c',
                backgroundColor: 'rgba(92, 184, 92, 0.1)'
            }, {
                label: 'Cancelled',
                data: cancelledData,
                borderColor: '#d9534f',
                backgroundColor: 'rgba(217, 83, 79, 0.1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

function createStatusChart(appointments) {
    var statusData = {};
    appointments.forEach(function(apt) {
        statusData[apt.status] = (statusData[apt.status] || 0) + 1;
    });
    
    var ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
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
}

function createDoctorChart(appointments) {
    var doctorData = {};
    appointments.forEach(function(apt) {
        var doctor = apt.doctor_name || 'Unknown';
        doctorData[doctor] = (doctorData[doctor] || 0) + 1;
    });
    
    var ctx = document.getElementById('doctorChart').getContext('2d');
    new Chart(ctx, {
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

function createPeakHoursChart(appointments) {
    var hourData = {};
    appointments.forEach(function(apt) {
        var hour = apt.appoitmented_slot ? apt.appoitmented_slot.split(':')[0] : '0';
        hourData[hour] = (hourData[hour] || 0) + 1;
    });
    
    // Fill in missing hours
    for (var i = 9; i <= 17; i++) {
        if (!hourData[i]) hourData[i] = 0;
    }
    
    var hours = Object.keys(hourData).sort((a, b) => parseInt(a) - parseInt(b));
    var counts = hours.map(hour => hourData[hour]);
    
    var ctx = document.getElementById('peakHoursChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: hours.map(h => h + ':00'),
            datasets: [{
                label: 'Appointments',
                data: counts,
                backgroundColor: '#f0ad4e'
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

function updateDetailedTable(appointments) {
    // This would calculate daily, weekly, monthly stats
    // For now, just show sample data
    $('#today_total').text('5');
    $('#week_total').text('25');
    $('#month_total').text('100');
    $('#last_month_total').text('95');
    $('#total_change').text('+5%');
    
    $('#today_completed').text('4');
    $('#week_completed').text('20');
    $('#month_completed').text('80');
    $('#last_month_completed').text('75');
    $('#completed_change').text('+7%');
    
    $('#today_cancelled').text('1');
    $('#week_cancelled').text('3');
    $('#month_cancelled').text('15');
    $('#last_month_cancelled').text('18');
    $('#cancelled_change').text('-17%');
    
    $('#today_no_show').text('0');
    $('#week_no_show').text('2');
    $('#month_no_show').text('5');
    $('#last_month_no_show').text('2');
    $('#no_show_change').text('+150%');
}
</script>
