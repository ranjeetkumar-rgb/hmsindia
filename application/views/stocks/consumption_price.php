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
				  <th>IIC ID</th>
				  <th>Patient Name</th>
				  <th>Date</th>
				  <th>Ot</th>
				  <th>Hormonal</th>
				  <th>Embryologist</th>
				  <th>Total</th>
				</tr>
              </thead>
              <tbody id="investigate_result">	
        <?php	 foreach ($investigate_result as $key => $value) {
            $total = $value['medical_data']['consumables'] + $value['medical_data']['injections'] + $value['medical_data']['medicine'];
	    $sql = "SELECT patient_id, SUM(total_vendor_price) AS ot_vendor_price FROM `hms_consumptions` WHERE patient_id=".$value['patient_id']." and type='Ot'";
        $select_result = run_select_query($sql);
	    $sql = "SELECT patient_id, SUM(total_vendor_price) AS hormonal_vendor_price FROM `hms_consumptions` WHERE patient_id=".$value['patient_id']." and type='Hormonal'";
        $select_result2 = run_select_query($sql);
		$sql = "SELECT patient_id, SUM(total_vendor_price) AS embryologist_vendor_price FROM `hms_consumptions` WHERE patient_id=".$value['patient_id']." and type='Embryologist'";
        $select_result3 = run_select_query($sql); 
	
	?>
				
            <tr>
			<td><a href="<?php site_url() ?>./consumption_list?start_date=&end_date=&patient_id=<?php echo $value['patient_id']; ?>&btnsearch=" target="_blank"><?php echo $value['patient_id'] ?></a></td>
				<td><?php echo $value['patient_name']; ?></td>
				<td><?php echo $value['date']; ?></td>
				<td><?php echo round($select_result['ot_vendor_price'], 2); ?></td>
				<td><?php echo round($select_result2['hormonal_vendor_price'], 2); ?></td>
				<td><?php echo round($select_result3['embryologist_vendor_price'],2); ?></td>
				<td><?php echo round($value['total_vendor_price'], 2); ?> </td>
				</tr>
			<?php
		}
	$count++;
?>              			  
           <?php	
		   
		    //foreach ($investigate_result as $key => $value) {
				

			//echo '<pre>';print_r($value['patient_id']);
			//echo '<pre>';print_r($value['medical_data']['consumables']);
			//echo '<pre>';print_r($value['medical_data']['injections']);
			//echo '<pre>';print_r($value['medical_data']['medicine']);
		    //$total = $value['medical_data']['consumables'] + $value['medical_data']['injections'] + $value['medical_data']['medicine'];
			//echo '<td><a href="./consumption_list?start_date=&end_date=&patient_id='.$value['patient_id'].'&btnsearch=" target="_blank">'.$value['patient_id'].'</a></td>';
	       // echo '<td>'.$value['patient_name'].'</td>';
			//echo '<td>'.$value['date'].'</td>';
			//echo '<td>'.round($value['total_vendor_price'], 2).'</td>';
			//echo '</tr>';
			
		//}
	//$count++;
?>   
           		   <tr>
                <td colspan="2">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
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