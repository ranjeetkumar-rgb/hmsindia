 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
		 <div class="row card-content" style="margin-bottom:20px;">
      <div class="col-md-12"><h3>My IPD</h3></div>
      <div class="clearfix"></div>
	    <form action="<?php echo base_url().'doctors/my_ipd'; ?>" method="get">
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Patient Name </label>
                <input type="text" class="form-control" id="wife_name" name="wife_name" value="<?php echo $wife_name;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="paitent_id" name="paitent_id" value="<?php echo $paitent_id;?>" />
            </div>
            <div class="col-sm-3" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            	<a href="<?php echo base_url().'doctors/my_ipd'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
          </form>  
        </div>
        <div class="clearfix"></div>
	    <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Patient Name</th>
				  <th>IIC ID</th>
                  <th>Reason of visit</th>
                  <th>Reports</th>
                  <!-- <th>Investigation Reports</th>
                  <th>Procedure Reports</th> -->
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php 
			  $count = 1; 
			  foreach($ipd_data as $ky => $vl){ 
			  $patient_id = get_patient_by_number($vl['wife_phone']); 
			  if(!empty($patient_id)) {
				  $patient_data = get_patient_detail($patient_id); ?>
                <tr class="odd gradeX">
					<td><?php echo $count; ?></td>
					<td><a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $patient_id; ?>"><?php echo $patient_data['wife_name']; ?></a></td>
					<td><a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $patient_id; ?>"><?php echo $patient_id; ?></a></td>
					<td><?php echo $vl['reason_of_visit']?></td>
					 <?php  if($_SESSION['logged_doctor']['psychological'] == 1){ ?>
					 <td><a href="<?php echo base_url('ipd-psychological/'.$patient_id.'/'.$vl['ID']);?>" class="btn btn-large">Upload & Check Reports</a></td>
					 <?php }else{ ?>
					 <td><a href="<?php echo base_url('ipd-records/'.$patient_id.'/'.$vl['ID']);?>" class="btn btn-large">Upload & Check Reports</a></td>
					 <?php } ?>
                </tr>
              <?php $count++; } } ?>
			   <tr>
                <td colspan="10">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>

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
<style >
.custom-pagination{
  padding:8px;
}
.custom-pagination a{
  padding:10px;
  text-decoration: none;
}
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
.form-control#billing_at{
  height: 40px!important;
  border: 1px solid #9e9e9e!important;
}
</style>