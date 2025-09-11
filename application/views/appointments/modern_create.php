<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-plus-circle"></i> Book New Appointment
                <small>Modern Appointment System</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>appointments"><i class="fa fa-calendar-alt"></i> Modern Appointments</a></li>
                <li class="active"><i class="fa fa-plus-circle"></i> Book Appointment</li>
            </ol>
        </div>
    </div>

    <!-- Appointment Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-calendar-plus-o"></i> Appointment Details
                    </h3>
                </div>
                <div class="panel-body">
                    <form id="appointmentForm" class="form-horizontal" method="post" action="<?php echo base_url('modern-appointments/createAppointment'); ?>" enctype="multipart/form-data" onsubmit="return false;">
                        <input type="hidden" name="action" value="add_appointment" />
                        <input type="hidden" id="paitent_type" name="paitent_type" value="new_patient" />
                        
                        <!-- Message Area -->
                        <div id="msg_area" class="alert" style="display: none;"></div>
                        
                        <!-- Patient Search Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Patient Search</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-inline text-center" style="padding: 20px 0;">
                                                    <!-- ISD Code and Phone Number Group -->
                                                    <div class="input-group" style="display: inline-flex; width: 300px;">
                                                        <input value="" placeholder="ISD Code" id="isd_code" by="isd_code" name="isd_code" type="text" class="form-control" style="width: 80px; text-align: center; border-right: none;">
                                                        <input value="" placeholder="Phone number of wife" id="phone_number" by="phone" name="phone_number" type="text" class="form-control validate" style="border-left: none;">
                                                    </div>
                                                    
                                                    <!-- OR Button -->
                                                    <div class="btn-group" style="margin: 0 15px;">
                                                        <button type="button" class="btn btn-default" disabled style="width: 40px; height: 34px; border-radius: 50%; padding: 0; font-weight: bold; color: #666;">
                                                            OR
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- IIC ID Field -->
                                                    <div class="form-group" style="display: inline-block; margin: 0 15px 0 0;">
                                                        <input value="" placeholder="IIC ID" id="iic_id" by="patient" type="text" class="form-control validate" style="width: 200px;">
                                                    </div>
                                                    
                                                    <!-- Search Button -->
                                                    <div class="form-group" style="display: inline-block; margin: 0;">
                                                        <button type="button" id="search_patient" class="btn btn-primary">
                                                            <i class="fa fa-search"></i> Q SEARCH
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Patient Details Section -->
                        <div id="add_section" style="display:none;">
                            <!-- Patient ID Display -->
                            <div class="row" id="patient_id_display" style="display:none;">
                                <div class="col-md-12">
                                    <div class="alert alert-info text-center">
                                        <strong>IIC ID: </strong><span id="paitent_id_display"></span>
                                        <input type="hidden" id="paitent_id" name="paitent_id">
                                    </div>
                                </div>
                            </div>
                            
                        <div class="row">
                            <!-- Patient Information -->
                            <div class="col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Patient Information</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Patient Name</label>
                                            <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="wife_name" id="wife_name" required placeholder="Enter Patient Name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Spouse Name</label>
                                            <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="husband_name" id="husband_name" required placeholder="Enter Spouse Name">
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phone Number</label>
                                            <div class="col-sm-9">
                                                    <input type="tel" class="form-control" name="wife_phone" id="wife_phone" required placeholder="Enter Phone Number" readonly>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                    <input type="email" class="form-control" name="wife_email" id="wife_email" required placeholder="Enter Email Address">
                                                </div>
                                            </div>

                                            <div class="form-group" id="patient_nationality" style="display:none;">
                                                <label class="col-sm-3 control-label">Nationality</label>
                                                <div class="col-sm-9">
                                                    <select name="nationality" id="nationality" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="indian">Indian</option>
                                                        <option value="non-indian">Non-indian</option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Details -->
                            <div class="col-md-6">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Appointment Details</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Reason of Visit</label>
                                            <div class="col-sm-9">
                                                    <select name="reason_of_visit" id="reason_of_visit" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="First Visit">First Visit</option>
                                                        <option value="Consulted Not Booked">Consulted Not Booked</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Center</label>
                                            <div class="col-sm-9">
                                                    <select name="appoitment_for" class="form-control" id="appoitment_for" required>
                                                        <option value="">Select</option>
                                                        <?php if(isset($centers) && !empty($centers)): 
                                                        foreach($centers as $center){  ?>
                                                            <option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                                                        <?php } endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                            <!-- <div class="form-group" id="camp_selection_div" style="display: none;">
                                                <label class="col-sm-3 control-label">Camp</label>
                                                <div class="col-sm-9">
                                                    <select name="camp_selection" class="form-control" id="camp_selection">
                                                        <option value="">Select Camp</option>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="form-group appoitmented_doctor" style="display:none;">
                                                <label class="col-sm-3 control-label">Doctor</label>
                                                <div class="col-sm-9">
                                                    <select name="appoitmented_doctor" class="form-control" id="appoitmented_doctor" required>
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group appoitmented_date" style="display:none;">
                                            <label class="col-sm-3 control-label">Date</label>
                                            <div class="col-sm-9">
                                                    <input type="text" id="appoitmented_date" autocomplete="off" name="appoitmented_date" class="form-control" placeholder="Select Date">
                                                </div>
                                        </div>

                                            <div class="form-group appoitmented_slot" style="display:none;">
                                            <label class="col-sm-3 control-label">Time Slot</label>
                                            <div class="col-sm-9">
                                                    <select name="appoitmented_slot" class="form-control" id="appoitmented_slot" required>
                                                        <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">Lead Source</label>
                                                <div class="col-sm-9">
                                                    <select name="lead_source" class="form-control" id="lead_source" required>
                                                        <option value="">Select Source</option>
                                                        <option value="Telecalling">Telecalling</option>
                                                        <option value="Walk In">Walk-in</option>
                                                        <option value="Doctor-Referral">Doctor Referral</option>
                                                        <option value="International">International</option>
                                                        <option value="Corporate">Corporate</option>
                                                        <option value="Camp">Camp</option>
                                                        <option value="D/S">D/S</option>
                                                        <option value="Ayushpay">Ayushpay</option>
                                                        <option value="Patient Referral">Patient Referral</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" id="sub_lead_source_div" style="display: none;">
                                                <label class="col-sm-3 control-label">Doctor Name</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sub_lead_source" name="sub_lead_source">
                                                        <option value="">--Select--</option>
                                                        <?php if(isset($doctor_referrals) && !empty($doctor_referrals)):
                                                        foreach($doctor_referrals as $doctor_referral){  ?>
                                                            <option value="<?php echo $doctor_referral['ID']; ?>"><?php echo $doctor_referral['doctor_name']; ?></option>
                                                        <?php } endif; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" id="camp_center_div" style="display: none;">
                                                <label class="col-sm-3 control-label">Camp Centre</label>
                                                <div class="col-sm-9">
                                                   <select name="camp_center" class="form-control" id="camp_selection">
                                                        <option value="">Select Camp</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" id="submitbutton" class="btn btn-primary" style="display:none;">
                                            <i class="fa fa-save"></i> Book Appointment
                                        </button>
                                            <button type="reset" class="btn btn-default">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                            <a href="<?php echo base_url(); ?>appointments" class="btn btn-info">
                                            <i class="fa fa-arrow-left"></i> Back to Appointments
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loader -->
    <div id="loader_div" class="text-center" style="display: none;">
        <i class="fa fa-spinner fa-spin fa-2x"></i>
        <p>Loading...</p>
    </div>
</div>

<script type="text/javascript">
var _formConfirm_submitted = false;

function appointsubmit(){
    $('#submitbutton').hide();
}

//Centre Doctor
$('#appoitment_for').on("change", function() {
    $('.appoitmented_doctor').hide();
    $('.appoitmented_date').hide();
    $('.appoitmented_slot').hide();
    $('#camp_selection_div').hide();
    $('#camp_selection').empty().append('<option value="">Select Camp</option>');
    
    $('#loader_div').show();
    var centre_id = $(this).val();
    if(centre_id != ''){
        // Load camps for selected center
        $.ajax({
            url: '<?php echo base_url('billingcontroller/get_camps_by_center')?>',
            data: {center_id: centre_id},
            dataType: 'html',
            type: 'POST',
            success: function(data) {
                $('#camp_selection').empty().append(data);
                $('#camp_selection_div').show();
                $('#loader_div').hide();
            },
            error: function(xhr, status, error) {
                console.log('Camp loading error:', status, error);
                $('#camp_selection').empty().append('<option value="">Error loading camps</option>');
                $('#camp_selection_div').show();
                $('#loader_div').hide();
            }
        });
        
        // Load doctors for selected center
        $.ajax({
            url: '<?php echo base_url('billingcontroller/search_doctor')?>',
            data: {centre_id:centre_id},
            dataType: 'json',
            type: 'POST',
            success: function(data)
            {
                $('#appoitmented_doctor').empty().append(data);
                $('.appoitmented_doctor').show();
                $('#loader_div').hide();
            } 
        });
    }
    else{
        $('.appoitmented_doctor').hide();
        $('#camp_selection_div').hide();
        $('#loader_div').hide();
    }
});

$('#appoitmented_doctor').on("change", function() {
    $('#loader_div').show();
    var doctor_id = $(this).val();
    $('#appoitmented_date').val('');
    if(doctor_id != ''){
        $('.appoitmented_date').show();
    }else{
        $('.appoitmented_date').hide();
    }
    $('#loader_div').hide();
});

$( function() {
    $( "#appoitmented_date" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate: 0,
        onSelect: function(dateStr) {
            $('#loader_div').show();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var appoitmented_doctor = $('#appoitmented_doctor').val();
            $.ajax({
                url: '<?php echo base_url('billingcontroller/doctor_slots')?>',
                type: 'POST',
                data: {selected:startDate, appoitmented_doctor:appoitmented_doctor},
                success: function(data) {
                    $('#appoitmented_slot').empty().append(data);
                    $('.appoitmented_slot').show();
                    $('#loader_div').hide();
                }
            });
        }
    });
});

$(document).on('click',"#search_patient",function(e) {
    $('#loader_div').show();
    $('#msg_area').empty().hide();
    $('.empty-field').val('');
    $('#paitent_type').val('');
    $('#nationality').attr("required", false);
    $('.appoitmented_doctor').hide();
    $('.appoitmented_date').hide();
    $('.appoitmented_slot').hide();
    
    var phone_number = $('#phone_number').val();
    var phone_by = $('#phone_number').attr('by');
    var patient_id = $('#iic_id').val();
    var patient_by = $('#iic_id').attr('by');
    
    if(phone_number != ''){
        var data = {search_this:phone_number, search_by:phone_by};
         search_patient(data);
    }else if(patient_id != ''){
        var data = {search_this:patient_id, search_by:patient_by};
         search_patient(data);
    }else{
         $('#msg_area').removeClass().addClass('alert alert-danger').html('Please enter patient phone number or IIC ID').show();
         $('#loader_div').hide();
    }
});

function search_patient(data){
    $('#patient_nationality').hide();
    $.ajax({
        url: '<?php echo base_url('billingcontroller/search_appointment')?>',
        data: data,
        dataType: 'json',
        type: 'POST',
        success: function(data)
        {
            if(data.status == 0){  
                $('#msg_area').removeClass().addClass('alert alert-danger').html(data.message).show(); 
            }
            if(data.status == 'appointment_booked'){
                $('#msg_area').removeClass().addClass('alert alert-info').html(data.message).show();
            }
            if(data.status == 'new_patient'){
                $('#patient_id_display').hide();
                $('#paitent_type').val(data.status);
                $('#msg_area').removeClass().addClass('alert alert-success').html(data.message).show();
                $('#wife_phone').attr("readonly", true);
                $('#wife_phone').val($('#phone_number').val());
                $('#wife_email').empty().val("");				
                $('#patient_nationality').show();
                $('#nationality').attr("required", true);
                $('#add_section').show();
                $('#submitbutton').show();
            }			
            if(data.status == 'exist_patient'){
                 $('#paitent_type').val(data.status);
                 $('#msg_area').removeClass().addClass('alert alert-success').html(data.message).show();
                 $('#paitent_id').val(data.uhid);
                 $('#paitent_id_display').text(data.uhid);
                 $('#patient_id_display').show();
                 $('#wife_name').val(data.patient.wife_name);
                 $('#wife_phone').val(data.patient.wife_phone);
                 $('#wife_email').val(data.patient.wife_email);
                 $('#nationality [value='+data.patient.nationality+']').attr('selected', 'true');
                 $('#add_section').show();
                 $('#submitbutton').show();
             }
            $('#loader_div').hide();
        } 
    });
}

$('#submitbutton').hide();

// Phone number validation
$('#phone_number').on("change, blur, keyup", function() { 
    $('#add_section').hide();
    $('#iic_id').val('');
    var txtpan = $(this).val(); 
    phone_validate(txtpan);
});

$('#iic_id').on("change, blur, keyup", function() {
    $('#add_section').hide();
    $('#phone_number').val('');
});

function phone_validate(mobile) {
   $('#loader_div').show();
    $('#msg_area').empty().hide();
    var pattern = /^\d{10}$/;
    if (pattern.test(mobile)) {
        $('#loader_div').hide(); 
        return true; 
    }
    $('#msg_area').removeClass().addClass('alert alert-danger').html('Please enter a valid 10-digit mobile number').show();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    $('#loader_div').hide();
    return false;
}

// Email validation
$('#wife_email').on("change, blur", function() {   
    var txtpan = $(this).val(); 
    email_validate(txtpan);
});

function email_validate(email) {
   $('#loader_div').show();
    $('#msg_area').empty().hide();
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
       $('#msg_area').removeClass().addClass('alert alert-danger').html('Please enter a valid email address').show();
       $("html, body").animate({ scrollTop: 0 }, "slow");
       $('#loader_div').hide();
    }else{
       $('#loader_div').hide();
       return true;
    }
}

$(document).ready(function(){
    // Form submission handler
    $('#appointmentForm').on('submit', function(e) {
        e.preventDefault();
        
        // Clear previous messages
        $('#msg_area').empty().hide();
        
        // Show loader
        $('#loader_div').show();
        
        // Submit form via AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('#loader_div').hide();
                
                if (response.status) {
                    $('#msg_area').removeClass().addClass('alert alert-success').html(response.message).show();
                    // Reset form after successful submission
                    $('#appointmentForm')[0].reset();
                } else {
                    // Show validation errors
                    var errorHtml = '<strong>Please fix the following errors:</strong><ul>';
                    if (response.errors) {
                        $.each(response.errors, function(field, error) {
                            errorHtml += '<li>' + error + '</li>';
                        });
                    }
                    errorHtml += '</ul>';
                    
                    $('#msg_area').removeClass().addClass('alert alert-danger').html(errorHtml).show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
            },
            error: function(xhr, status, error) {
                $('#loader_div').hide();
                $('#msg_area').removeClass().addClass('alert alert-danger').html('An error occurred while processing your request. Please try again.').show();
            }
        });
    });
    
    // When lead source changes
    $("#lead_source").change(function(){
        if ($(this).val() == "Doctor-Referral") {
            $("#sub_lead_source_div").show();
        } else {
            $("#sub_lead_source_div").hide();
            $("#sub_lead_source").val("");
        }
        
        if ($(this).val() == "Camp") {
            $("#camp_center_div").show();
        } else {
            $("#camp_center_div").hide();
            $("#camp_center").val("");
        }
    });
    
    // When camp selection changes, check templates
    $("#camp_selection").change(function(){
        var camp_number = $(this).val();
        var center_id = $('#appoitment_for').val();
        
        if(camp_number != '' && center_id != ''){
            $('#loader_div').show();
        $.ajax({
                url: '<?php echo base_url('billingcontroller/check_camp_templates')?>',
                data: {camp_number: camp_number, center_id: center_id},
                dataType: 'json',
            type: 'POST',
            success: function(response) {
                    if(response.status == 'success'){
                        if(response.templates_exist){
                            $('#msg_area').removeClass().addClass('alert alert-success').html('Camp selected successfully! Templates are available.').show();
                } else {
                            $('#msg_area').removeClass().addClass('alert alert-info').html('Camp selected. No templates found for this camp.').show();
                        }
                }
                    $('#loader_div').hide();
            },
            error: function() {
                    $('#msg_area').removeClass().addClass('alert alert-danger').html('Error checking camp templates.').show();
                    $('#loader_div').hide();
            }
        });
        }
    });
});
</script>