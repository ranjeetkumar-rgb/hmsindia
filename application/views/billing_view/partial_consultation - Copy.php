 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3>Partial Consultations</h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" data-sort-name="date" data-sort-order="desc" id="appointment_body_xx">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Patient Name</th>
                  <th>Doctor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; foreach($appointments as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td>
                  		<?php $patient_data = get_patient_detail($vl->patient_id);?>
	                  	<a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $vl->patient_id;?>"><?php echo  strtoupper($patient_data['wife_name']); ?> (<?php echo $vl->patient_id;?>)</a>
                  </td>
                  <td>Dr. <?php echo $all_method->doctor_name($vl->doctor_id); ?></td>
                  <td class="appint_td_<?php echo $vl->ID;?>">
                  	<a href="<?php echo base_url('cancel-partial-consultation/'.$vl->appointment_id); ?>" class="btn btn-primary" id="billing_link_<?php echo $vl->ID?>">Cancel Partial Consultation</a>
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
        	<form name="" action="<?php echo base_url('appointmentcontroller/reschedule_appointment'); ?>" method="POST">
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