<?php $all_method =&get_instance(); ?>
<script type="text/javascript">
    var _formConfirm_submitted = false;
</script>

<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url('booking'); ?>" enctype="multipart/form-data" >
  <input type="hidden" name="action" value="add_appointment" />
  <input type="hidden" id="paitent_type" name="paitent_type" value="new_patient" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Appointment Booking</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
        <div class="row">
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="Phone number of wife" id="phone_number" by="phone" name="phone_number" type="text" class="form-control validate" >
          </div>
          <div class="form-group col-sm-1 col-xs-12">
          	<p>OR </p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="IIC ID" id="iic_id" by="patient" type="text" class="form-control validate" >
          </div>
          
          	<div class="form-group col-sm-3 col-xs-12">
                <input value="Search" id="search_patient" type="button" class="form-control validate" >
            </div>
        </div>        
        <hr/>        
        <div id="add_section" style="display:none;"> 
        
          <div class="row paitent_id_div" style="display:none;">
               <div class="form-group col-sm-3 col-xs-12" align="center"></div>                               	
               <div class="form-group col-sm-6 col-xs-12" align="center">
                    <label for="item_name">IIC ID (Required)</label>
                    <input value="" placeholder="IIC ID" readonly="readonly" id="paitent_id" name="paitent_id" type="text" class="form-control validate empty-field" required>
               </div>
               <div class="form-group col-sm-3 col-xs-12" align="center"></div>
	      </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Name (Required)</label>
                <input value="" id="wife_name" name="wife_name" type="text" class="form-control validate in_field empty-field" required>
           </div>
         </div>
		 
		 <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Name (Required)</label>
                <input value="" id="husband_name" name="husband_name" type="text" class="form-control validate in_field empty-field" required>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Phone Number (Required)</label>
                <input value="" id="wife_phone" readonly="readonly" name="wife_phone" type="text" class="form-control validate in_field empty-field" required>
           </div>
         </div>
         
         <div class="row">   
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Email (Required)</label>
                <input value="" id="wife_email" name="wife_email" required type="text" class="form-control validate in_field empty-field">
           </div>
         </div>
         
         <div class="row">     
         	<div class="form-group col-sm-6 col-xs-12 role" style="display:none;" id="patient_nationality">
                <label for="statuss">Nationality</label>
                <select name="nationality" id="nationality" class="patient_source empty-field" required>
                    <option value="">Select</option>
                    <option value="indian">Indian</option>
                    <option value="non-indian">Non-indian</option>
                </select>
            </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Reason of visit (Required)</label>
                <textarea id="reason_of_visit" name="reason_of_visit" class="form-control validate empty-field" required></textarea>
           </div>
         </div>
         
         <div class="row">            
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Centre (Required)</label>
                <select name="appoitment_for" class="empty-field" id="appoitment_for" required>
                    <option value="">Select</option>
                    <?php $center = $all_method->get_center_list(); foreach($center as $key => $center){?>
                  	<option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
         </div>
         
        <div class="row appoitmented_doctor" style="display:none;">            
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Doctor (Required)</label>
                <select name="appoitmented_doctor" class="empty-field" id="appoitmented_doctor" required>
                    <option value="">Select</option>
                </select>
            </div>
         </div>
         
         <div class="row appoitmented_date" style="display:none;">            
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Appointment date (Required)</label>
                <input value="" id="appoitmented_date" autocomplete="off" name="appoitmented_date" type="text" class="form-control empty-field validate" >
            </div>
         </div>
         
         <div class="row appoitmented_slot" style="display:none;">            
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Appoitmented_slot (Required)</label>
                <select name="appoitmented_slot" class="empty-field" id="appoitmented_slot" required>
                    <option value="">Select</option>
                </select>
            </div>
         </div>
    
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
	        <input type="submit" id="submitbutton" class="btn btn-large" value="Book Appointment" />
         </div>
         
         
         </div>
      </div>
      </p>
    </div>
  </div>
</form>
  

<script type="text/javascript">
function appointsubmit(){
    $('#submitbutton').hide();
}

//Centre Doctor
$('#appoitment_for').on("change", function() {
	$('div.appoitmented_doctor').hide();
	$('div.appoitmented_date').hide();
	$('div.appoitmented_slot').hide();
	
	$('#loader_div').show();
	var centre_id = $(this).val();
	if(centre_id != ''){
		$.ajax({
		url: '<?php echo base_url('billingcontroller/search_doctor')?>',
		data: {centre_id:centre_id},
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			$('#appoitmented_doctor').empty().append(data);
			$('div.appoitmented_doctor').show();
			$('#loader_div').hide();
			
		} 
  });
    }
	else{
		$('div.appoitmented_doctor').hide();
		$('#loader_div').hide();
	}
});

$('#appoitmented_doctor').on("change", function() {
	$('#loader_div').show();
	var doctor_id = $(this).val();
	$('input#appoitmented_date').val('');
	if(doctor_id != ''){
		$('div.appoitmented_date').show();
	}else{
		$('div.appoitmented_date').hide();
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
						$('div.appoitmented_slot').show();
						$('#loader_div').hide();
					}
				});
			}
		});
} );


$(document).on('click',"#search_patient",function(e) {
	$('#loader_div').show();
	$('#msg_area').empty();
	$('.empty-field').val('');
	$('#paitent_type').val('');
    $('#nationality').attr("required", false);
	$('div.appoitmented_doctor').hide();
	$('div.appoitmented_date').hide();
	$('div.appoitmented_slot').hide();
	
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
		 $('#msg_area').append('Enter patient phone number or IIC ID');
		 $('#loader_div').hide();
	}
});

function search_patient(data){
	$('#patient_nationality').hide();
	$.ajax({
		url: '<?php echo base_url('billingcontroller/search_appointment')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			if(data.status == 0){  $('#msg_area').append(data.message); }
			if(data.status == 'appointment_booked'){
				$('#msg_area').empty().append(data.message);
			}
			if(data.status == 'new_patient'){
				$('div.paitent_id_div').hide();
				$('#paitent_type').val(data.status);
				$('#msg_area').append(data.message);
				$('#wife_phone').attr("readonly", true);
				$('#wife_phone').val($('#phone_number').val());
				$('#wife_email').empty().val("");				
				$('#patient_nationality').show();
				$('#nationality').attr("required", true);
				$('#add_section').show();
			}			
			if(data.status == 'exist_patient'){
				 //patient details
				 //WIFE
				 $('#paitent_type').val(data.status);
				 $('#msg_area').append(data.message);
				 $('#paitent_id').val(data.uhid);
				 $('div.paitent_id_div').show();
				 $('#wife_name').val(data.patient.wife_name);
				 $('#wife_phone').val(data.patient.wife_phone);
				 $('#wife_email').val(data.patient.wife_email);
				 $('#nationality [value='+data.patient.nationality+']').attr('selected', 'true');
				 $('.img_show').show();
				 $('#submitbutton').show();
				 $('#add_section').show();
			 }
			$('#loader_div').hide();
		} 
  });
}
$('#submitbutton').hide();
$('#search_patient').hide();
// Phone number validation
$('#phone_number').on("change, blur, keyup", function() { 
	$('#add_section').hide();
	$('#search_patient').hide();
	$('#iic_id').val('');
	var txtpan = $(this).val(); 
	phone_validate(txtpan);
});
$('#iic_id').on("change, blur, keyup", function() {
	$('#add_section').hide();
	$('#search_patient').hide();
	$('#phone_number').val('');
	$('#search_patient').show();
});

function phone_validate(mobile) {
   $('#loader_div').show();
	$('#msg_area').empty();
	var pattern = /^\d{10}$/;
	if (pattern.test(mobile)) {$('#submitbutton').show(); $('#search_patient').show(); $('#loader_div').hide(); return true; }
	$('#msg_area').append('It is not valid mobile number.input 10 digits number!');
	$('#submitbutton').hide();
	$('#search_patient').hide();
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
	$('#msg_area').empty();
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(email)) {
	   $('#msg_area').append('It is not valid email address!');
	   $('#submitbutton').hide();
	   $("html, body").animate({ scrollTop: 0 }, "slow");
       $('#loader_div').hide();
	}else{
       $('#submitbutton').show();
       $('#loader_div').hide();
	   return true;
	}
}
</script>