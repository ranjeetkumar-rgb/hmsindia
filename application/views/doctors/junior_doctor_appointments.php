 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
       <div class="card-action"><h3>Filter data</h3></div>
        <div class="col-sm-12 col-xs-12 patient_ledger_filter" style="z-index:9;">
        	<div class="form-group col-sm-3 col-xs-12 ">
            	<label>Filter by status</label>
                <select class="form-control" id="filter_by_status">
                	<option value=''>--Select--</option>
                    <option value='booked'>Scheduled</option>
                    <option value="rescheduled">Rescheduled</option>
                    <option value="visited">Billing done</option>
					<option value="consultation">Patient in</option>
					<option value="consultation_done">Consultation done</option>
                </select>
            </div>
            <div class="form-group col-sm-3 col-xs-12 ">
            	<label>Filter by date range</label>
                <input type="text" autocomplete="off" class="daterange_filter" id="daterange_filter" name="date_range" value="" />
            </div>
            <div class="form-group col-sm-3 col-xs-12 ">
            	<label>Filter by date</label>
                <input type="text" autocomplete="off" class="particular_date_filter" id="particular_date_filter" name="particular_date_filter" value="" />
            </div>
            <div class="form-group col-sm-3 col-xs-12">
            	<a href="<?php echo base_url().'doctor_appointments'; ?>" class="btn btn-large">Reset filter</a>
            </div>            
        </div>

        <div class="card-action"><h3>My Appointments</h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="doctor_appointments">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Patient Name</th>
                  <th>Doctor Name</th>
                  <th>Date</th>
                  <th>Slot</th>
                  <th>Reason of visit</th>
                  <th>Status</th>
                  <!-- <th>Investigation Reports</th>
                  <th>Procedure Reports</th> -->
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; foreach($appointments as $ky => $vls){
                  foreach($vls as $key => $vl){
                //var_dump($vl);die; ?>
                <?php $patient_id = get_patient_by_number($vl['wife_phone']); ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td>
                  	<?php if($vl['paitent_type'] == 'exist_patient'){?>
	                  	<a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $patient_id; ?>"><?php echo $vl['wife_name']; ?></a>
                    <?php } else {?>
                    	<?php echo $vl['wife_name']; ?>
                    <?php } ?>
                  </td>
                  <td><?php $doctor_details = doctor_details($vl['appoitmented_doctor']); echo "Dr.".$doctor_details['name']; ?></td>
                  <td><?php echo $vl['appoitmented_date']?></td>
                  <td><?php echo $vl['appoitmented_slot']?></td>
                  <td><?php echo $vl['reason_of_visit']?></td>
                  <td class="role appint_td_<?php echo $vl['ID']?>">                    
                    <?php if(($vl['status'] == 'consultation' || $vl['status'] == 'visited') && $vl['billed'] == '1'){ ?>
                            <?php if($vl['follow_up_appointment'] == 1){?>
                              <a class="btn btn-primary" href="<?php echo base_url('follow-up/'.$vl['ID']);?>">Follow up</a>
                            <?php }else { ?>
                              <a class="btn btn-primary" href="<?php echo base_url('consultation_done/'.$vl['ID']);?>">Initiate Consultation</a>
                            <?php } ?>
                        <?php }else if($vl['status'] == 'consultation_done'){ ?>
                            <?php $edit_consult = check_edit_appointment($vl['ID']); //var_dump($edit_consult);die; ?>
                            <?php if($edit_consult['edit_mode'] == 1 && $edit_consult['final_mode'] == 0){?>
                              <a class="btn btn-primary" href="<?php echo base_url('consultation_done/'.$vl['ID'].'?mode=edit');?>">Complete Consultation</a>
                            <?php }else{ ?>
                              Consultation Done
                            <?php } ?>
                        <?php } else if($vl['status'] == 'in_clinic'){ ?> 
                          In clinic
                        <?php } else{?>
                        	In process
                        <?php } ?>
                  </td>
                  <!-- <td>                    
	                  <a target="_blank" class="btn btn-primary" href="<?php echo base_url()?>patient_reports/<?php echo $patient_id;?>">Check Reports</a>
                  </td>
                  <td>
                    <?php $procedure_billing = check_procedure_billing($vl['ID']); //var_dump($procedure_billing);die;
                          if(count($procedure_billing) > 0){
                    ?>
                        <a target="_blank" class="btn btn-primary" href="<?php echo base_url()?>procedure_reports/<?php echo $vl['ID'];?>">Check Reports</a>
                    <?php } ?>
                  </td> -->
                </tr>
              <?php $count++; } } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>

    <script>
      $(document).ready(function() {
          $('#doctor_appointments').DataTable( {
              "order": [[ 2, "desc" ]]
          } );
      } );
    </script>

<script>
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

$(function() {
	  $('input[name="date_range"]').daterangepicker({
		opens: 'left'
	  }, function(start, end, label) {
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			var data = {start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD'), type:'date_wise'};
			appointment_filter(data);
	  });
});

$('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
	$(this).val('');
	$(this).data('daterangepicker').setStartDate(moment());
	$(this).data('daterangepicker').setEndDate(moment());
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
});

function appointment_filter(data){
	$('#appointment_body').empty();
	$.ajax({
		url: '<?php echo base_url('doctors/ajax_appointment_filter')?>',
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