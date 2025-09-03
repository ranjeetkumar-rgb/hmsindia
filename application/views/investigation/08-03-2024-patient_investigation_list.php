 <?php
//$curl = curl_init();
//curl_setopt_array($curl, array(
//  CURLOPT_URL => 'https://lims-test.corediagnostics.in/api/collection/get-collectionslist',
//  CURLOPT_RETURNTRANSFER => true,
//  CURLOPT_ENCODING => '',
//  CURLOPT_MAXREDIRS => 10,
//  CURLOPT_TIMEOUT => 0,
//  CURLOPT_FOLLOWLOCATION => true,
//  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => 'POST',
//  CURLOPT_POSTFIELDS =>'{"api_key" : "GJ9jOG1w7T6QnbF9SDIqM43C5dTvnVs1jBoF6J2Z2gEh4peyDgz2sCcnLKXI7mCC"}',
//  CURLOPT_HTTPHEADER => array(
//    'Content-Type: application/json'
//  ),
//));

//$response = curl_exec($curl);

//curl_close($curl);
//echo $response;
//$result = json_decode($response);
// $data_list = $result->data->data;
//echo '<pre>';
//print_r($data_list);

                     	
//die();
 ?>
 		<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://lims-test.corediagnostics.in/api/collection/get-collection/38708',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"api_key" : "GJ9jOG1w7T6QnbF9SDIqM43C5dTvnVs1jBoF6J2Z2gEh4peyDgz2sCcnLKXI7mCC"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
//echo '<pre>';
//print_r($response);

$result = json_decode($response);
$data_list = $result->data;
//echo '<pre>';
//print_r($result);
//die();
?>
 <?php //$all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
       <!-- <div class="card-action"><h3>Filter data</h3></div>
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
        </div> -->

        <div class="card-action"><h3>Investigation List</h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>IIC ID</th>
				  <th>Patient Name</th>
                  <th>Reports</th>
				  <th>Receipt Number</th>
				  <th>Status</th>
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; 
                foreach ($result as $res_val){
					
					//print_r($pod_number);
                 // $patient_data = get_patient_detail($vl['patient_id']);
                 // $appointment_details = doctor_appointment($vl['appointment_id']);
                  //var_dump($vl);die; 
				  if(!empty($res_val) && !empty($res_val->id)){
                ?>
                <tr class="odd gradeX">
                 <td><?php echo $count; ?></td>
				 <td><?php  echo $res_val->pod_number; ?></td>
				 <td><?php  echo $res_val->patient_first_name; ?></td>
				 <td><?php  echo $res_val->status; ?></td>
				 <td><?php  echo $res_val->uid_number; ?></td>
				 <td><?php  echo $res_val->status; ?></td>
                </tr>
				  <?php $count++; }} ?>
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
