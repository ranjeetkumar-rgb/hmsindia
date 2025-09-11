<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-calendar"></i> Calendar View
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-calendar"></i> Calendar View</li>
            </ol>
        </div>
    </div>

    <!-- Calendar Controls -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-filter"></i> Calendar Filters
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
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
                                <label>Status</label>
                                <select class="form-control" id="status_filter">
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
                                <label>&nbsp;</label>
                                <div>
                                    <button class="btn btn-primary waves-effect waves-dark" onclick="loadCalendar()">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </button>
                                    <a href="<?php echo base_url(); ?>appointments" class="btn btn-info waves-effect waves-dark">
                                        <i class="fa fa-arrow-left"></i> Back to List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-calendar"></i> Appointment Calendar
                    </h3>
                </div>
                <div class="panel-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Status Legend</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <span class="badge" style="background-color: #5cb85c;">Booked</span>
                            <span class="badge" style="background-color: #5bc0de;">Confirmed</span>
                            <span class="badge" style="background-color: #f0ad4e;">In Clinic</span>
                        </div>
                        <div class="col-md-3">
                            <span class="badge" style="background-color: #337ab7;">Consultation</span>
                            <span class="badge" style="background-color: #5cb85c;">Completed</span>
                            <span class="badge" style="background-color: #d9534f;">Cancelled</span>
                        </div>
                        <div class="col-md-3">
                            <span class="badge" style="background-color: #f0ad4e;">Rescheduled</span>
                            <span class="badge" style="background-color: #777;">No Show</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" rel="stylesheet" media="print">

<!-- FullCalendar JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize calendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'month',
        editable: false,
        eventLimit: true,
        events: function(start, end, timezone, callback) {
            loadCalendarEvents(start, end, callback);
        },
        eventClick: function(calEvent, jsEvent, view) {
            showAppointmentDetails(calEvent);
        },
        dayClick: function(date, jsEvent, view) {
            // Option to add new appointment on day click
            if (confirm('Do you want to book an appointment for ' + date.format('YYYY-MM-DD') + '?')) {
                window.location.href = '<?php echo base_url(); ?>modern-appointments/create?date=' + date.format('YYYY-MM-DD');
            }
        }
    });

    // Load calendar events
    function loadCalendarEvents(start, end, callback) {
        var doctor = $('#doctor_filter').val();
        var center = $('#center_filter').val();
        var status = $('#status_filter').val();

        $.ajax({
            url: '<?php echo base_url(); ?>appointment/getAppointments',
            type: 'GET',
            data: {
                start_date: start.format('YYYY-MM-DD'),
                end_date: end.format('YYYY-MM-DD'),
                doctor_id: doctor,
                center_id: center,
                status: status,
                limit: 1000
            },
            dataType: 'json',
            success: function(response) {
                var events = [];
                if (response.status && response.data.appointments) {
                    $.each(response.data.appointments, function(index, appointment) {
                        var event = {
                            id: appointment.ID,
                            title: appointment.wife_name + ' - ' + appointment.appoitmented_slot,
                            start: appointment.appoitmented_date + 'T' + appointment.appoitmented_slot,
                            backgroundColor: getStatusColor(appointment.status),
                            borderColor: getStatusColor(appointment.status),
                            textColor: '#ffffff',
                            extendedProps: {
                                doctor: appointment.doctor_name,
                                phone: appointment.wife_phone,
                                reason: appointment.reason_of_visit,
                                status: appointment.status,
                                patient_id: appointment.paitent_id
                            }
                        };
                        events.push(event);
                    });
                }
                callback(events);
            },
            error: function() {
                callback([]);
            }
        });
    }

    // Get status color
    function getStatusColor(status) {
        var colors = {
            'booked': '#5cb85c',
            'confirmed': '#5bc0de',
            'in_clinic': '#f0ad4e',
            'consultation': '#337ab7',
            'completed': '#5cb85c',
            'cancelled': '#d9534f',
            'rescheduled': '#f0ad4e',
            'no_show': '#777'
        };
        return colors[status] || '#777';
    }

    // Show appointment details
    function showAppointmentDetails(calEvent) {
        var content = '<div class="appointment-details">';
        content += '<h4>Appointment Details</h4>';
        content += '<p><strong>Patient:</strong> ' + calEvent.title.split(' - ')[0] + '</p>';
        content += '<p><strong>Time:</strong> ' + calEvent.title.split(' - ')[1] + '</p>';
        content += '<p><strong>Doctor:</strong> ' + calEvent.extendedProps.doctor + '</p>';
        content += '<p><strong>Phone:</strong> ' + calEvent.extendedProps.phone + '</p>';
        content += '<p><strong>Reason:</strong> ' + (calEvent.extendedProps.reason || 'N/A') + '</p>';
        content += '<p><strong>Status:</strong> ' + calEvent.extendedProps.status + '</p>';
        content += '</div>';

        // Create modal or alert
        if (typeof $.fn.modal !== 'undefined') {
            // Bootstrap modal
            var modal = '<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog">';
            modal += '<div class="modal-dialog" role="document">';
            modal += '<div class="modal-content">';
            modal += '<div class="modal-header">';
            modal += '<h4 class="modal-title">Appointment Details</h4>';
            modal += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
            modal += '</div>';
            modal += '<div class="modal-body">' + content + '</div>';
            modal += '<div class="modal-footer">';
            modal += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            modal += '</div>';
            modal += '</div></div></div>';
            
            $('body').append(modal);
            $('#appointmentModal').modal('show');
            $('#appointmentModal').on('hidden.bs.modal', function() {
                $(this).remove();
            });
        } else {
            alert(content.replace(/<[^>]*>/g, ''));
        }
    }

    // Load calendar function
    window.loadCalendar = function() {
        $('#calendar').fullCalendar('refetchEvents');
    };

    // Filter change handlers
    $('#doctor_filter, #center_filter, #status_filter').change(function() {
        loadCalendar();
    });
});
</script>
