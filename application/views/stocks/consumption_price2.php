 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12 card">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3>All Consumption Report </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/consumption_price'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/consumption_price'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			</form>
        </div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">
              <thead>
                <tr>
				  <th>On Date</th>
				  <th>IIC ID</th>
                  <th>Center</th>
				  <th>Amount</th>
				</tr>
              </thead>

              <tbody id="investigate_result">	  
    <?php
	foreach($investigate_result as $vl){
		
    $patient_data = get_patient_detail($vl['patient_id']);
    $data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$medicine_arr = array();
	$medicine_price = 0;
	$injections_arr = array();
	$injections_price = 0;
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
		if(!empty($data_arr['data']['medicine'])){
			$medicine_arr = $data_arr['data']['medicine'];
		}
		if(!empty($data_arr['data']['injections'])){
			$injections_arr = $data_arr['data']['injections'];
		}
	}
	
	
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$total_consumables_price = $total_consumables_price + (float) $row['consumables_price'];
			$consumables_price = $row['consumables_price'];
			echo '<tr class="odd gradeX">';
	        echo '<td>'.$vl['add_on'].'</td>';
	        echo '<td>'.$vl['patient_id'].'</td>';
	        echo '<td>'."OT".'</td>';
			echo '<td>'.$consumables_price.'</td>';
			echo '</tr>';
		}
	}
	
	if(!empty($medicine_arr)){
		foreach ($medicine_arr as $row){
			$total_medicine_price = $total_medicine_price + (float) $row['medicine_price'];
			$medicine_price = $row['medicine_price'];
			echo '<tr class="odd gradeX">';
	        echo '<td>'.$vl['add_on'].'</td>';
	        echo '<td>'.$vl['patient_id'].'</td>';
	        echo '<td>'."Embroylogy".'</td>';
			echo '<td>'.$medicine_price.'</td>';
			echo '</tr>';
		}
	}
	
	
	if(!empty($injections_arr)){
		foreach ($injections_arr as $row ){
			$total_injections_price = $total_injections_price + (float) $row['injections_price'];
			$injections_price = $row['injections_price'];
			echo '<tr class="odd gradeX">';
	        echo '<td>'.$vl['add_on'].'</td>';
	        echo '<td>'.$vl['patient_id'].'</td>';
	        echo '<td>'."Injection".'</td>';
			echo '<td>'.$injections_price.'</td>';
			echo '</tr>';
		}
	}
	
	//$total_consumables_price = $total_consumables_price + (float) $row['consumables_price'];
	//$total_consumables_price += $consumables_price;
	//$total_medicine_price += $medicine_price;
	//$total_injections_price += $injections_price;
	$count++;}
?>              
			   <tr>
                <td colspan="1">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
				<td colspan="1">OT = <?php echo $total_consumables_price; ?></td>
				<td colspan="1">Embroylogy = <?php echo $total_medicine_price; ?></td>
				<td colspan="1">Injection = <?php echo $total_injections_price; ?></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
       <!--End Investigation Tables -->    
      <!--End Advanced Tables -->
    </div>
<script>
      $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var data = {appointment_date:startDate, type:'particular_date_filter'};
          }
        });
    });
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