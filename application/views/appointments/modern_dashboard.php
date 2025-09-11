<?php $all_method = &get_instance(); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active ">Modern Appointments</li>
                    </ol>
                </div>
                <h4 class="page-title"><i class="fa fa-calendar-alt text-nowrap"></i> Modern Appointment Management</h4>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button type="button" class="btn btn-primary waves-effect waves-dark" data-bs-toggle="modal" data-bs-target="#createAppointmentModal">
                        <i class="fa fa-plus"></i> New Appointment
                    </button>
                    <button type="button" class="btn btn-success waves-effect waves-dark" id="exportBtn">
                        <i class="fa fa-download"></i> Export
                    </button>
                    <button type="button" class="btn btn-info waves-effect waves-dark" id="refreshBtn">
                        <i class="fa fa-sync-alt"></i> Refresh
                    </button>
                </div>
                <div>
                    <span class="badge badge-info" id="totalAppointments">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="row mb-4">
        <div class="col-sm-12 col-xs-12">
            <div class="card " style="padding-left: 5px!important;padding-right: 5px!important;">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fa fa-filter"></i> Search & Filter Appointments</h5>
                </div>
                <div class="card-body">
                    <form id="filterForm">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="statusFilter" class="form-label">Status</label>
                                <select class="form-control" id="statusFilter" name="status">
                                    <option value="">All Status</option>
                                    <option value="booked">Scheduled</option>
                                    <option value="in_clinic">In Clinic</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="rescheduled">Rescheduled</option>
                                    <option value="no_show">No Show</option>
                                    <option value="visited">Billing Done</option>
                                    <option value="consultation">Patient In</option>
                                    <option value="consultation_done">Consultation Done</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="doctorFilter" class="form-label">Doctor</label>
                                <select class="form-control" id="doctorFilter" name="doctor_id">
                                    <option value="">All Doctors</option>
                                    <?php 
                                    $doctor_list = $all_method->center_doctors(); 
                                    foreach($doctor_list as $key => $vals): ?>
                                        <option value="<?php echo $vals['ID']; ?>">Dr. <?php echo $vals['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="patientTypeFilter" class="form-label">Patient Type</label>
                                <select class="form-control" id="patientTypeFilter" name="patient_type">
                                    <option value="">All Types</option>
                                    <option value="new_patient">New Patient</option>
                                    <option value="exist_patient">Existing Patient</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="startDateFilter" class="form-label">Start Date</label>
                                <input type="text" class="form-control datepicker" id="startDateFilter" name="start_date" placeholder="Start Date">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="endDateFilter" class="form-label">End Date</label>
                                <input type="text" class="form-control datepicker" id="endDateFilter" name="end_date" placeholder="End Date">
                            </div>
                            <div class="col-md-3">
                                <label for="patientNameFilter" class="form-label">Patient Name/Mobile</label>
                                <input type="text" class="form-control" id="patientNameFilter" name="patient_name" placeholder="Enter patient name or mobile">
                            </div>
                            <div class="col-md-3">
                                <label for="crmIdFilter" class="form-label">CRM ID</label>
                                <input type="text" class="form-control" id="crmIdFilter" name="crm_id" placeholder="Enter CRM ID">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary waves-effect waves-dark me-2">
                                    <i class="fa fa-search"></i> Search
                                </button>
                                <button type="button" class="btn btn-secondary waves-effect waves-dark" id="clearFilters">
                                    <i class="fa fa-times"></i> Clear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointments Table -->
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="card" style="padding-left: 5px!important;padding-right: 5px!important;">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="fa fa-list"></i> Appointments List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="appointmentsTable">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>CRM ID</th>
                                    <th>Patient Name</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Slot</th>
                                    <th>Reason of visit</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="appointmentsTableBody">
                                <!-- Data will be loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="dataTables_info" id="appointmentsTable_info">
                                Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span id="showingTotal">0</span> entries
                            </div>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="Appointments pagination" style="background-color: white;text-align: right;box-shadow: none;">
                                <ul class="pagination justify-content-end" id="pagination">
                                    <!-- Pagination will be loaded via AJAX -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Appointment Modal -->
<div class="modal fade" id="createAppointmentModal" tabindex="-1" aria-labelledby="createAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAppointmentModalLabel">Create New Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createAppointmentForm">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="patientName" class="form-label">Patient Name *</label>
                            <input type="text" class="form-control" id="patientName" name="patient_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="patientPhone" class="form-label">Patient Phone *</label>
                            <input type="tel" class="form-control" id="patientPhone" name="patient_phone" required>
                        </div>
                        <div class="col-md-6">
                            <label for="patientEmail" class="form-label">Patient Email</label>
                            <input type="email" class="form-control" id="patientEmail" name="patient_email">
                        </div>
                        <div class="col-md-6">
                            <label for="patientType" class="form-label">Patient Type</label>
                            <select class="form-select" id="patientType" name="patient_type">
                                <option value="new_patient">New Patient</option>
                                <option value="exist_patient">Existing Patient</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="doctorSelect" class="form-label">Doctor *</label>
                            <select class="form-select" id="doctorSelect" name="doctor_id" required>
                                <option value="">Select Doctor</option>
                                <?php foreach($doctor_list as $key => $vals): ?>
                                    <option value="<?php echo $vals['ID']; ?>">Dr. <?php echo $vals['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="centerSelect" class="form-label">Center *</label>
                            <select class="form-select" id="centerSelect" name="center_id" required>
                                <option value="">Select Center</option>
                                <!-- Centers will be loaded via AJAX -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="appointmentDate" class="form-label">Appointment Date *</label>
                            <input type="date" class="form-control" id="appointmentDate" name="appointment_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="appointmentTime" class="form-label">Appointment Time *</label>
                            <select class="form-select" id="appointmentTime" name="appointment_time" required>
                                <option value="">Select Time</option>
                                <!-- Time slots will be loaded via AJAX -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="reason" class="form-label">Reason for Visit</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-labelledby="statusUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusUpdateModalLabel">Update Appointment Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusUpdateForm">
                <div class="modal-body">
                    <input type="hidden" id="statusAppointmentId" name="appointment_id">
                    <div class="mb-3">
                        <label for="newStatus" class="form-label">New Status *</label>
                        <select class="form-select" id="newStatus" name="status" required>
                            <option value="">Select Status</option>
                            <option value="in_clinic">In Clinic</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="rescheduled">Rescheduled</option>
                            <option value="no_show">No Show</option>
                            <option value="visited">Billing Done</option>
                            <option value="consultation">Patient In</option>
                            <option value="consultation_done">Consultation Done</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="statusNotes" class="form-label">Notes</label>
                        <textarea class="form-control" id="statusNotes" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reschedule Modal (Matching existing system) -->
<div class="col-sm-12 col-xs-12" id="load_pop" style="display: none;">
    <span id="load_pop_close" style="position: absolute; right: 20px; top: 8px; font-weight: 700; z-index: 9999; cursor: pointer;">X</span>
    <div class="col-sm-12 col-xs-12">
        <form name="rescheduleForm" action="<?php echo base_url('appointmentcontroller/reschedule_appointment'); ?>" method="POST">
            <input type="hidden" value="" class="reschedule_doctor_id" name="reschedule_doctor_id" />
            <input type="hidden" value="" name="reschedule_appointment_id" class="reschedule_appointment_id" />
            <input type="hidden" value="" name="appoitmented_date" class="reschedule_appointment_date" />
            <input type="hidden" value="reschedule_appointment" name="reschedule_appointment" />
            <div class="row">
                <div class="form-group col-sm-12 col-xs-12">
                    <label for="statuss">Reschedule Appointment date (Required)</label>
                    <div id="rescheduled_datepicker"></div>
                </div>
                <div class="form-group col-sm-12 col-xs-12 role" id="pop_appoitmented_slot" style="display:none;">
                    <label for="statuss">Appointment Slot (Required)</label>
                    <select name="appoitmented_slot" class="empty-field form-control" id="appoitmented_slot" required>
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            <input value="Submit" id="reschedule_appointment_btn" style="display:none;" type="submit" class="btn btn-primary">
        </form>
    </div>
</div>

<!-- Loading Spinner -->
<div class="d-none" id="loadingSpinner">
    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<style>
.status-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 3px;
}

.status-booked { background-color: #007bff; color: white; }
.status-in_clinic { background-color: #fd7e14; color: white; }
.status-cancelled { background-color: #dc3545; color: white; }
.status-rescheduled { background-color: #6f42c1; color: white; }
.status-no_show { background-color: #6c757d; color: white; }
.status-visited { background-color: #28a745; color: white; }
.status-consultation { background-color: #17a2b8; color: white; }
.status-consultation_done { background-color: #20c997; color: white; }

.table th {
    border-top: none;
    font-weight: 600;
    background-color: #f8f9fa;
}

.btn-group-actions .btn {
    margin-right: 2px;
    margin-bottom: 2px;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
}

.page-title-box {
    margin-bottom: 20px;
}

.badge {
    font-size: 0.75em;
}

.dataTables_info {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
}

.pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    color: #007bff;
    border: 1px solid #dee2e6;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    background-color: #fff;
    border-color: #dee2e6;
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group-actions .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .d-flex {
        flex-direction: column;
    }
    
    .d-flex > div {
        margin-bottom: 10px;
    }
}

/* Reschedule Modal Styles (matching existing system) */
#load_pop {
    position: fixed;
    top: 0;
    bottom: 0;
    margin: auto;
    z-index: 99999;
    left: 0;
    right: 0;
    width: 50%;
    background: #fff;
    height: 70%;
    padding: 30px 15px;
    box-shadow: 0px 0px 10px -4px #000;
    border-radius: 10px;
    display: none;
}

#load_pop .ui-datepicker .ui-datepicker-header {
    height: 30px;
}

#load_pop_close {
    position: absolute;
    right: 20px;
    top: 8px;
    font-weight: 700;
    z-index: 9999;
    cursor: pointer;
}

.form-control {
    height: 30px !important;
    border: 1px solid #9e9e9e !important;
}
</style>

<script>
$(document).ready(function() {
    // Initialize datepickers
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate: 0
    });
    
    // Initialize the appointments page
    initializeAppointments();
    
    // Event listeners
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        loadAppointments();
    });
    
    $('#clearFilters').on('click', function() {
        $('#filterForm')[0].reset();
        $('.datepicker').val('');
        loadAppointments();
    });
    
    $('#createAppointmentForm').on('submit', function(e) {
        e.preventDefault();
        createAppointment();
    });
    
    $('#statusUpdateForm').on('submit', function(e) {
        e.preventDefault();
        updateAppointmentStatus();
    });
    
    $('#rescheduleForm').on('submit', function(e) {
        e.preventDefault();
        rescheduleAppointment();
    });
    
    $('#refreshBtn').on('click', function() {
        loadAppointments();
    });
    
    $('#exportBtn').on('click', function() {
        exportAppointments();
    });
    
    // Doctor change event for time slots
    $('#doctorSelect, #newAppointmentDate').on('change', function() {
        loadAvailableTimeSlots();
    });
});

function initializeAppointments() {
    loadAppointments();
    loadCenters();
    loadTimeSlots();
    
    // Initialize status change handlers
    $(document).on('change', '.appointment_status', function() {
        const appointmentStatus = $(this).val();
        const appointmentId = $(this).attr('appointment_id');
        
        if (appointmentStatus !== '') {
            if (appointmentStatus === 'rescheduled') {
                const doctorId = $(this).attr('doctor_id');
                showRescheduleModal(appointmentId, doctorId);
            } else {
                updateStatus(appointmentStatus, appointmentId);
            }
        }
    });
}

// Helper function to get doctor name (you'll need to implement this)
function getDoctorName(doctorId) {
    // This should match the existing system's doctor_name method
    // For now, return a placeholder - you may need to make an AJAX call
    return 'Loading...';
}

// Helper function to get base URL
const baseUrl = '<?php echo base_url(); ?>';
const modernAppointmentUrl = '<?php echo base_url(); ?>modern-appointments/';
// Status update function matching existing system
function updateStatus(appointmentStatus, appointmentId) {
    $.ajax({
        url: modernAppointmentUrl + 'appointment_status',
        data: {
            appointment_status: appointmentStatus,
            appointment_id: appointmentId
        },
        dataType: 'json',
        method: 'post',
        success: function(data) {
            showAlert('success', data.message);
            if (appointmentStatus === 'cancelled' || appointmentStatus === 'no_show') {
                $(`.appint_td_${appointmentId}`).empty().append(appointmentStatus.toUpperCase());
            }
            loadAppointments(); // Reload to show updated status
        },
        error: function() {
            showAlert('error', 'Failed to update status');
        }
    });
}

// Show reschedule modal
function showRescheduleModal(appointmentId, doctorId) {
    $('.reschedule_doctor_id').val(doctorId);
    $('.reschedule_appointment_id').val(appointmentId);
    $('#load_pop').show();
}

// Close reschedule modal
$(document).on('click', '#load_pop_close', function() {
    $('#load_pop').hide();
});

// Initialize reschedule datepicker
$(document).ready(function() {
    $('#rescheduled_datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate: 0,
        onSelect: function(dateStr) {
            $('#appoitmented_slot').empty();
            $('#pop_appoitmented_slot').hide();
            $('#reschedule_appointment_btn').hide();
            
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            $('.reschedule_appointment_date').val(startDate);
            var appoitmented_doctor = $('.reschedule_doctor_id').val();
            
            $.ajax({
                url: modernAppointmentUrl + 'doctor_slots',
                type: 'POST',
                data: {
                    selected: startDate,
                    appoitmented_doctor: appoitmented_doctor
                },
                success: function(data) {
                    $('#appoitmented_slot').empty().append(data);
                    $('#pop_appoitmented_slot').show();
                    $('#reschedule_appointment_btn').show();
                }
            });
        }
    });
});

function loadAppointments(page = 1) {
    showLoading();
    
    const filters = {
        status: $('#statusFilter').val(),
        doctor_id: $('#doctorFilter').val(),
        patient_type: $('#patientTypeFilter').val(),
        patient_name: $('#patientNameFilter').val(),
        crm_id: $('#crmIdFilter').val(),
        start_date: $('#startDateFilter').val(),
        end_date: $('#endDateFilter').val(),
        page: page,
        limit: 10
    };
    
    $.ajax({
        url: '<?php echo base_url("modern-appointments/getAppointments"); ?>',
        method: 'GET',
        data: filters,
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if (response.status) {
                console.log('=== PAGINATION DEBUG ===');
                console.log('Page requested:', page);
                console.log('Pagination data received:', response.data.pagination);
                console.log('Appointments count:', response.data.appointments.length);
                console.log('Current page:', response.data.pagination.current_page);
                console.log('Per page:', response.data.pagination.per_page);
                console.log('Total:', response.data.pagination.total);
                console.log('========================');
                
                renderAppointmentsTable(response.data.appointments, response.data.pagination);
                renderPagination(response.data.pagination);
            } else {
                showAlert('error', response.message);
            }
        },
        error: function() {
            hideLoading();
            showAlert('error', 'Failed to load appointments');
        }
    });
}

function renderAppointmentsTable(appointments, pagination) {
    const tbody = $('#appointmentsTableBody');
    tbody.empty();
    
    if (appointments.length === 0) {
        tbody.html('<tr><td colspan="10" class="text-center">No appointments found</td></tr>');
        return;
    }
    
    // Calculate starting serial number based on current page
    const currentPage = pagination.current_page || 1;
    const perPage = pagination.limit || 10;
    const startSerial = ((currentPage - 1) * perPage) + 1;
    
    console.log('=== SERIAL NUMBER DEBUG ===');
    console.log('Current page:', currentPage);
    console.log('Per page:', perPage);
    console.log('Start serial calculation: ((currentPage - 1) * perPage) + 1');
    console.log('Calculation: ((' + currentPage + ' - 1) * ' + perPage + ') + 1 = ' + startSerial);
    console.log('Appointments count:', appointments.length);
    console.log('Expected serial numbers:', startSerial + ' to ' + (startSerial + appointments.length - 1));
    console.log('============================');
    
    appointments.forEach(function(appointment, index) {
        // Get doctor name from the data (already populated by controller)
        const doctorName = appointment.doctor_name || 'Unknown';
        
        // Build patient name with link for existing patients
        let patientName = appointment.wife_name || '-';
        if (appointment.paitent_type === 'exist_patient') {
            patientName = `<a target="_blank" href="${baseUrl}patient_details/${appointment.paitent_id}">${appointment.wife_name.toUpperCase()}</a>`;
        } else {
            patientName = appointment.wife_name.toUpperCase();
        }
        
        // Build status dropdown like existing system
        let statusHtml = '';
        if (appointment.status === 'consultation_done') {
            statusHtml = 'Consultation Done';
        } else if (appointment.status === 'booked' || appointment.status === 'rescheduled' || appointment.status === 'in_clinic') {
            statusHtml = `
                <div class="appoint_${appointment.ID}">
                    <select appointment_id="${appointment.ID}" doctor_id="${appointment.appoitmented_doctor}" class="appointment_status form-control">
                        <option value="">--Select status--</option>
                        <option value="in_clinic" ${appointment.status === 'in_clinic' ? 'selected' : ''}>In clinic</option>
                        <option value="cancelled" ${appointment.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                        <option value="rescheduled" ${appointment.status === 'rescheduled' ? 'selected' : ''}>Rescheduled</option>
                        <option value="no_show" ${appointment.status === 'no_show' ? 'selected' : ''}>No show</option>
                    </select>
                </div>
            `;
        } else if (appointment.billed == '1') {
            statusHtml = `
                <select appointment_id="${appointment.ID}" doctor_id="${appointment.appoitmented_doctor}" class="appointment_status form-control">
                    <option value="visited" ${appointment.status === 'visited' ? 'selected' : ''}>Billing done</option>
                    <option value="consultation" ${appointment.status === 'consultation' ? 'selected' : ''}>Patient in</option>
                </select>
            `;
        } else {
            statusHtml = appointment.status.toUpperCase();
        }
        
        // Build action buttons like existing system
        let actionHtml = '';
        if (appointment.status === 'consultation_done') {
            actionHtml = 'Consultation Done';
        } else if (appointment.status === 'cancelled' || appointment.status === 'no_show') {
            actionHtml = appointment.status.toUpperCase();
        } else {
            if (appointment.billed == '0') {
                if (appointment.status === 'in_clinic') {
                    actionHtml = `
                        <div class="appoint_${appointment.ID}">
                            <a href="${baseUrl}consultation/${appointment.ID}" class="btn btn-primary" id="billing_link_${appointment.ID}">Consultation billing</a>
                        </div>
                    `;
                }
            } else {
                actionHtml = 'BILLED';
                if (appointment.partial_billing == '0') {
                    actionHtml += `<a href="${baseUrl}partial-billing/${appointment.ID}" class="btn btn-primary">Partial Consultation</a>`;
                }
            }
        }
        
        // Additional action buttons
        let additionalActions = `
            <a target="_blank" href="${baseUrl}accounts/patient_update?ID=${appointment.ID}">Edit</a>
        `;
        if (appointment.paitent_type === 'new_patient') {
            additionalActions += `<a target="_blank" href="${baseUrl}registation/${appointment.ID}" class="btn btn-primary">Registration</a>`;
        }
        
        const serialNumber = startSerial + index;
        console.log('Row ' + (index + 1) + ': Serial number = ' + serialNumber + ' (startSerial: ' + startSerial + ' + index: ' + index + ')');
        
        const row = `
            <tr class="odd gradeX">
                <td>${serialNumber}</td>
                <td>${appointment.crm_id || '-'}</td>
                <td>${patientName}</td>
                <td>Dr. ${doctorName}</td>
                <td>${appointment.appoitmented_date || '-'}</td>
                <td>${appointment.appoitmented_slot || '-'}</td>
                <td>${appointment.reason_of_visit || '-'}</td>
                <td class="role appint_td_${appointment.ID}">${statusHtml}</td>
                <td class="appint_td_${appointment.ID}">${actionHtml}</td>
                <td>${additionalActions}</td>
            </tr>
        `;
        tbody.append(row);
    });
}

function renderPagination(pagination) {
    const paginationContainer = $('#pagination');
    paginationContainer.empty();
    
    if (pagination.total_pages <= 1) {
        $('#showingStart').text(0);
        $('#showingEnd').text(0);
        $('#showingTotal').text(pagination.total_records || 0);
        return;
    }
    
    // Update showing info - use the same calculation as serial numbers
    const start = ((pagination.current_page - 1) * pagination.limit) + 1;
    const end = Math.min(pagination.current_page * pagination.limit, pagination.total_records);
    
    console.log('=== PAGINATION DISPLAY DEBUG ===');
    console.log('Current page:', pagination.current_page);
    console.log('Per page:', pagination.limit);
    console.log('Total:', pagination.total_records);
    console.log('Start calculation: ((' + pagination.current_page + ' - 1) * ' + pagination.limit + ') + 1 = ' + start);
    console.log('End calculation: Math.min(' + pagination.current_page + ' * ' + pagination.limit + ', ' + pagination.total_records + ') = ' + end);
    console.log('Displaying: Showing ' + start + ' to ' + end + ' of ' + pagination.total_records + ' entries');
    console.log('================================');
    
    $('#showingStart').text(start);
    $('#showingEnd').text(end);
    $('#showingTotal').text(pagination.total_records);
    $('#totalAppointments').text(`${pagination.total_records} Appointments`);
    
    // Create pagination HTML like CodeIgniter's pagination library
    let paginationHtml = '';
    
    // Previous button
    if (pagination.current_page > 1) {
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="loadAppointments(${pagination.current_page - 1}); return false;">&lt;</a></li>`;
    } else {
        paginationHtml += `<li class="page-item disabled"><span class="page-link">&lt;</span></li>`;
    }
    
    // Page numbers
    const maxPages = 5;
    let startPage = Math.max(1, pagination.current_page - Math.floor(maxPages / 2));
    let endPage = Math.min(pagination.total_pages, startPage + maxPages - 1);
    
    if (endPage - startPage + 1 < maxPages) {
        startPage = Math.max(1, endPage - maxPages + 1);
    }
    
    // First page
    if (startPage > 1) {
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="loadAppointments(1); return false;">1</a></li>`;
        if (startPage > 2) {
            paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    // Page numbers
    for (let i = startPage; i <= endPage; i++) {
        if (i === pagination.current_page) {
            paginationHtml += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
        } else {
            paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="loadAppointments(${i}); return false;">${i}</a></li>`;
        }
    }
    
    // Last page
    if (endPage < pagination.total_pages) {
        if (endPage < pagination.total_pages - 1) {
            paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="loadAppointments(${pagination.total_pages}); return false;">${pagination.total_pages}</a></li>`;
    }
    
    // Next button
    if (pagination.current_page < pagination.total_pages) {
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="loadAppointments(${pagination.current_page + 1}); return false;">&gt;</a></li>`;
    } else {
        paginationHtml += `<li class="page-item disabled"><span class="page-link">&gt;</span></li>`;
    }
    
    paginationContainer.html(paginationHtml);
}

function createAppointment() {
    const formData = $('#createAppointmentForm').serialize();
    
    $.ajax({
        url: '<?php echo base_url("appointment/create"); ?>',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                showAlert('success', response.message);
                $('#createAppointmentModal').modal('hide');
                $('#createAppointmentForm')[0].reset();
                loadAppointments();
            } else {
                showAlert('error', response.message);
            }
        },
        error: function() {
            showAlert('error', 'Failed to create appointment');
        }
    });
}

function updateStatus(appointmentId) {
    $('#statusAppointmentId').val(appointmentId);
    $('#statusUpdateModal').modal('show');
}

function updateAppointmentStatus() {
    const formData = $('#statusUpdateForm').serialize();
    
    $.ajax({
        url: '<?php echo base_url("appointment/updateStatus"); ?>',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                showAlert('success', response.message);
                $('#statusUpdateModal').modal('hide');
                loadAppointments();
            } else {
                showAlert('error', response.message);
            }
        },
        error: function() {
            showAlert('error', 'Failed to update status');
        }
    });
}

function reschedule(appointmentId) {
    $('#rescheduleAppointmentId').val(appointmentId);
    $('#rescheduleModal').modal('show');
}

function rescheduleAppointment() {
    const formData = $('#rescheduleForm').serialize();
    
    $.ajax({
        url: '<?php echo base_url("appointment/reschedule"); ?>',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                showAlert('success', response.message);
                $('#rescheduleModal').modal('hide');
                loadAppointments();
            } else {
                showAlert('error', response.message);
            }
        },
        error: function() {
            showAlert('error', 'Failed to reschedule appointment');
        }
    });
}

function cancelAppointment(appointmentId) {
    if (confirm('Are you sure you want to cancel this appointment?')) {
        const reason = prompt('Please enter cancellation reason:');
        if (reason) {
            $.ajax({
                url: '<?php echo base_url("appointment/cancel"); ?>',
                method: 'POST',
                data: {
                    appointment_id: appointmentId,
                    reason: reason
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        showAlert('success', response.message);
                        loadAppointments();
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function() {
                    showAlert('error', 'Failed to cancel appointment');
                }
            });
        }
    }
}

function loadCenters() {
    $.ajax({
        url: '<?php echo base_url("api/get_centres"); ?>',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                const centerSelect = $('#centerSelect');
                centerSelect.empty().append('<option value="">Select Center</option>');
                response.data.forEach(function(center) {
                    centerSelect.append(`<option value="${center.id}">${center.center_name}</option>`);
                });
            }
        }
    });
}

function loadTimeSlots() {
    const timeSlots = [
        {value: '09:00', label: '9:00 AM'},
        {value: '09:30', label: '9:30 AM'},
        {value: '10:00', label: '10:00 AM'},
        {value: '10:30', label: '10:30 AM'},
        {value: '11:00', label: '11:00 AM'},
        {value: '11:30', label: '11:30 AM'},
        {value: '12:00', label: '12:00 PM'},
        {value: '12:30', label: '12:30 PM'},
        {value: '14:00', label: '2:00 PM'},
        {value: '14:30', label: '2:30 PM'},
        {value: '15:00', label: '3:00 PM'},
        {value: '15:30', label: '3:30 PM'},
        {value: '16:00', label: '4:00 PM'},
        {value: '16:30', label: '4:30 PM'},
        {value: '17:00', label: '5:00 PM'},
        {value: '17:30', label: '5:30 PM'}
    ];
    
    const timeSelect = $('#appointmentTime, #newAppointmentTime');
    timeSelect.empty().append('<option value="">Select Time</option>');
    timeSlots.forEach(function(slot) {
        timeSelect.append(`<option value="${slot.value}">${slot.label}</option>`);
    });
}

function loadAvailableTimeSlots() {
    const doctorId = $('#doctorSelect').val();
    const date = $('#appointmentDate').val();
    
    if (doctorId && date) {
        $.ajax({
            url: '<?php echo base_url("appointment/getAvailableSlots"); ?>',
            method: 'GET',
            data: {
                doctor_id: doctorId,
                date: date
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    const timeSelect = $('#appointmentTime');
                    timeSelect.empty().append('<option value="">Select Time</option>');
                    response.data.forEach(function(slot) {
                        timeSelect.append(`<option value="${slot.value}">${slot.label}</option>`);
                    });
                }
            }
        });
    }
}

function exportAppointments() {
    const filters = {
        status: $('#statusFilter').val(),
        doctor_id: $('#doctorFilter').val(),
        patient_type: $('#patientTypeFilter').val(),
        patient_name: $('#patientNameFilter').val(),
        crm_id: $('#crmIdFilter').val(),
        date_range: $('#dateRangeFilter').val()
    };
    
    const queryString = new URLSearchParams(filters).toString();
    window.open('<?php echo base_url("appointment/export"); ?>?' + queryString, '_blank');
}

function viewAppointment(appointmentId) {
    // Implementation for viewing appointment details
    window.open('<?php echo base_url("appointment/getDetails"); ?>/' + appointmentId, '_blank');
}

function editAppointment(appointmentId) {
    // Implementation for editing appointment
    console.log('Edit appointment:', appointmentId);
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-GB');
}

function formatStatus(status) {
    const statusMap = {
        'booked': 'Scheduled',
        'in_clinic': 'In Clinic',
        'cancelled': 'Cancelled',
        'rescheduled': 'Rescheduled',
        'no_show': 'No Show',
        'visited': 'Billing Done',
        'consultation': 'Patient In',
        'consultation_done': 'Consultation Done'
    };
    return statusMap[status] || status;
}

function showLoading() {
    $('#appointmentsTableBody').html('<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>');
}

function hideLoading() {
    // Loading will be replaced by actual data
}

function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    // Remove existing alerts
    $('.alert').remove();
    
    // Add new alert
    $('.container').prepend(alertHtml);
    
    // Auto-hide after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
}
</script>
