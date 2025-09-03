 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3>Appointments on <?php echo date('d-m-Y'); ?></h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="doctor_appointments">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Patient Name</th>
                  <th>Doctor</th>
                  <th>Date</th>
                  <th>Slot</th>
                  <th>Reason of visit</th>
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php if(!empty($appointments)){ $count = 1; foreach($appointments as $ky => $vl){ ?>
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
                  <td>Dr. <?php echo $all_method->doctor_name($vl['appoitmented_doctor']); ?></td>
                  <td><?php echo $vl['appoitmented_date']?></td>
                  <td><?php echo $vl['appoitmented_slot']?></td>
                  <td><?php echo $vl['reason_of_visit']?></td>
                </tr>
              <?php $count++; } }else {?>
                <tr class="odd gradeX">
                  <td colspan="6">No appointment found!</td>
                </tr> 
              <?php  }?>
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