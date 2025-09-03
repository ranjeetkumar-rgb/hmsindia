 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
       <!--<div class="card-action"><h3>Filter data</h3></div>-->
     <!--   <div class="col-sm-12 col-xs-12 patient_ledger_filter" style="z-index:9;">-->
     <!--   	<div class="form-group col-sm-2 col-xs-12 ">-->
     <!--       	<label>Filter by status</label>-->
     <!--           <select class="form-control" id="filter_by_status">-->
     <!--           	<option value=''>--Select--</option>-->
     <!--               <option value='booked'>Scheduled</option>-->
     <!--               <option value="cancelled">Cancelled</option>-->
					<!--<option value="rescheduled">Rescheduled</option>-->
					<!--<option value="in_clinic">In clinic</option>-->
     <!--               <option value="no_show">No show</option>-->
     <!--               <option value="visited">Billing done</option>-->
					<!--<option value="consultation">Patient in</option>-->
					<!--<option value="consultation_done">Consultation done</option>-->
     <!--           </select>-->
     <!--       </div>-->
     <!--       <div class="form-group col-sm-2 col-xs-12 ">-->
     <!--       	<label>Filter by doctor</label>-->
     <!--           <select class="form-control" id="filter_by_doctor">-->
     <!--           	<option value="">--Select--</option>-->
                    <?php $doctor_list = array(); //$doctor_list = $all_method->center_doctors();
					    foreach($doctor_list as $key => $vals){
					?>
     <!--           	<option value="<?php echo $vals['ID']; ?>">Dr. <?php echo $vals['name']; ?></option>-->
                   <?php } ?>
                    
     <!--           </select>-->
     <!--       </div>-->
     <!--       <div class="form-group col-sm-2 col-xs-12 ">-->
     <!--       	<label>Filter by date range</label>-->
     <!--           <input type="text" autocomplete="off" class="daterange_filter" id="daterange_filter" name="daterange" value="" />-->
     <!--       </div>-->
     <!--       <div class="form-group col-sm-2 col-xs-12 ">-->
     <!--       	<label>Filter by date</label>-->
     <!--           <input type="text" autocomplete="off" class="particular_date_filter" id="particular_date_filter" name="particular_date_filter" value="" />-->
     <!--       </div>-->
     <!--       <div class="form-group col-sm-3 col-xs-12">-->
     <!--       	<a href="<?php echo base_url().'my_appointments'; ?>" class="btn btn-large">Reset filter</a>-->
     <!--       </div>            -->
     <!--   </div>-->

        <div class="card-action"><h3>My Appointments</h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered dataList" id="">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Patient Name</th>
                  <th>Doctor</th>
                  <th>Date</th>
                  <th>Slot</th>
                  <th>Reason of visit</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; foreach($appointments as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td>
                  	<?php if($vl['paitent_type'] == 'exist_patient'){ $patient_data = get_patient_detail($vl['paitent_id']);?>
	                  	<a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $vl['paitent_id'];?>"><?php echo  strtoupper($patient_data['wife_name']); ?></a>
                    <?php } else {?>
                    	<?php echo strtoupper($vl['wife_name']); ?>
                    <?php } ?>
                  </td>
                  <td>Dr. <?php echo $all_method->doctor_name($vl['appoitmented_doctor']); ?></td>
                  <td><?php echo $vl['appoitmented_date']?></td>
                  <td><?php echo $vl['appoitmented_slot']?></td>
                  <td><?php echo $vl['reason_of_visit']?></td>
                  <td class="role appint_td_<?php echo $vl['ID']?>">
                  		<?php if($vl['status'] == 'consultation_done'){echo 'Consultation Done';}
							  else{ 
							  		if($vl['status'] == 'booked' || $vl['status'] == 'rescheduled' || $vl['status'] == 'in_clinic'){ ?>
							  		
							  		<div class="appoint_<?php echo $vl['ID']?>">
                                        <select appointment_id="<?php echo $vl['ID']?>" doctor_id="<?php echo $vl['appoitmented_doctor']; ?>" class="appointment_status">
                                            <option value="">--Select status--</option>
        									<option value="in_clinic" <?php if($vl['status'] == 'in_clinic')echo 'selected="selected"';?>>In clinic</option>
        									<option value="cancelled" <?php if($vl['status'] == 'cancelled')echo 'selected="selected"';?>>Cancelled</option>
                                            <option value="rescheduled" <?php if($vl['status'] == 'rescheduled')echo 'selected="selected"';?>>Rescheduled</option>
                                            <option value="no_show" <?php if($vl['status'] == 'no_show')echo 'selected="selected"';?>>No show</option>
                                        </select>
                                    </div>
                        
                        <?php }else if($vl['billed'] == '1'){ ?>
                        
                                <select appointment_id="<?php echo $vl['ID']?>" doctor_id="<?php echo $vl['appoitmented_doctor']; ?>" class="appointment_status">
                                    <option value="visited" <?php if($vl['status'] == 'visited')echo 'selected="selected"';?>>Biling done</option>
                                    <option value="consultation" <?php if($vl['status'] == 'consultation')echo 'selected="selected"';?>>Patient in</option>
                                </select>    
                                  
                       <?php }else{ echo strtoupper($vl['status']);}
							}
						?>
                  </td>
                </tr>
              <?php $count++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
  
    
    <style>
div#load_pop {
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
	display:none;
}
div#load_pop .ui-datepicker .ui-datepicker-header {
    height: 30px;
}
#load_pop_close {
    position: absolute;
    right: 20px;
    top: 8px;
    font-weight: 700;
    z-index: 9999;
}
img.pop_img {
    max-width: 100%;
}
</style>
    <div class="col-sm-12 col-xs-12" id="load_pop">
        <span id="load_pop_close">X</span>
    	<div class="col-sm-12 col-xs-12">
        	<form name="" action="<?php echo base_url('appointmentcontroller/telecaller_reschedule_appointment'); ?>" method="POST">
            	<input type="hidden" value="" class="reschedule_doctor_id" />
            	<input type="hidden" value="" name="reschedule_appointment_id" class="reschedule_appointment_id" />
				<input type="hidden" value="" name="appoitmented_date" class="reschedule_appointment_date" />
            	<input type="hidden" value="reschedule_appointment" name="reschedule_appointment" />
                
                <div class="row">
                  <div class="form-group col-sm-12 col-xs-12">
	                <label for="statuss">Reschedule Appointment date (Required)</label>
                    <!-- <input type="text" class="rescheduled_datepicker" autocomplete="off" id="rescheduled_datepicker" name="appoitmented_date" placeholder="" required /> -->
					<div id="rescheduled_datepicker"></div>
                  </div>
                  
                    <div class="form-group col-sm-12 col-xs-12 role" id="pop_appoitmented_slot" style="display:none;">
			            <label for="statuss">Appoitmented_slot (Required)</label>
                        <select name="appoitmented_slot" class="empty-field" id="appoitmented_slot" required>
                            <option value="">Select</option>
                        </select>
                    </div>
                    
                </div>     
                    <input value="Submit" id="reschedule_appointment_btn" style="display:none;" type="submit" class="btn btn-large">
    		</form>
        </div>
    </div>
        
<script>
$( "#load_pop_close" ).click(function() {
	$('#load_pop').hide();
});
$(document).on('change',".appointment_status",function(e) {
        $('#appoitmented_slot').empty();
		$('div#pop_appoitmented_slot').hide();
		$('#reschedule_appointment_btn').hide();
		
		$('#loader_div').show();
        $('#msg_area').empty();
        var appointment_status = $(this).val();
        var appointment_id = $(this).attr('appointment_id');
		if(appointment_status != ""){
			if(appointment_status == "rescheduled"){
				var doctor_id = $(this).attr('doctor_id');	
				$('.reschedule_doctor_id').val(doctor_id);
				$('.reschedule_appointment_id').val(appointment_id);
				$('div#load_pop').show();
			}else{
				update_status(appointment_status, appointment_id);	
			}
		}
		$('#loader_div').hide();
    });	
	
function update_status(appointment_status, appointment_id){
	$.ajax({
		url: '<?php echo base_url('appointmentcontroller/appointment_status')?>',
		data: {appointment_status:appointment_status, appointment_id:appointment_id},
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			$('#msg_area').empty().append(data.message);
			if(appointment_status == 'cancelled' || appointment_status == 'no_show'){$('td.appint_td_'+appointment_id).empty().append(appointment_status.toUpperCase())}
			window.location.reload();

		} 
	});
}

$( function() {
    $( "#rescheduled_datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		 	minDate: 0,
			onSelect: function(dateStr) {
			    $('#appoitmented_slot').empty();
				$('div#pop_appoitmented_slot').hide();
				$('#reschedule_appointment_btn').hide();
				
				$(".reschedule_appointment_date").val();
				$('#loader_div').show();				
				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
				$(".reschedule_appointment_date").val(startDate);
				var appoitmented_doctor = $('.reschedule_doctor_id').val();
				$.ajax({
					url: '<?php echo base_url('billingcontroller/doctor_slots')?>',
					type: 'POST',
					data: {selected:startDate, appoitmented_doctor:appoitmented_doctor},
					success: function(data) {
						$('#appoitmented_slot').empty().append(data);
						$('div#pop_appoitmented_slot').show();
						$('#reschedule_appointment_btn').show();
						$('#loader_div').hide();
					}
				});
			}
		});
} );
	
$(document).on('change',"#filter_by_status",function(e) {
  $('#loader_div').show();
   var status = $(this).val();
   if(status != ''){
		var data = {status:status, type:'appointment_status'};
		appointment_filter(data);
	}else{
		$('#loader_div').hide();
	}
});
$(document).on('change',"#filter_by_doctor",function(e) {
  $('#loader_div').show();
   var doctor = $(this).val();
   if(doctor != ''){
		var data = {doctor:doctor, type:'by_doctor'};
		appointment_filter(data);
	}else{
		$('#loader_div').hide();
	}
});
$(function() {
	  $('input[name="daterange"]').daterangepicker({
		opens: 'left'
	  }, function(start, end, label) {
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			var data = {start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD'), type:'date_wise'};
			appointment_filter(data);
			//$(this).datepicker('setDate', null);
	  });
});

$( function() {
    $( "#particular_date_filter" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			onSelect: function(dateStr) {
				$('#loader_div').show();				
				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
				var data = {appointment_date:startDate, type:'particular_date_filter'};
				appointment_filter(data);
			}
		});
} );
	

$('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
	$(this).val('');
	$(this).data('daterangepicker').setStartDate(moment());
	$(this).data('daterangepicker').setEndDate(moment());
});

function appointment_filter(data){
    $('#appoitmented_slot').empty();
	$('div#pop_appoitmented_slot').hide();
	$('#reschedule_appointment_btn').hide();
	
	$('#appointment_body').empty();
	$.ajax({
		url: '<?php echo base_url('appointmentcontroller/ajax_appointment_filter')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			$('#appointment_body').append(data.appointment_html);
			$('#loader_div').hide();
		} 
	});
}
</script>