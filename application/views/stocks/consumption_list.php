 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12 card">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3>Consumption Report </h3></div>
		 <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/consumption_list'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Departments </label>
                <select class="form-control" id="type" name="type" value="<?php echo $type;?>" />
				<option value="">-- Select --</option>
				<option value="Ot">Ot</option>
				<option value="Embryologist">Embryologist</option>
				<option value="Hormonal">Hormonal</option>
				</select>
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Patient Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?php echo $patient_name;?>" />
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Procedure Name</label>
                <input type="text" class="form-control" id="procedure_name" name="procedure_name" value="<?php echo $procedure_name;?>" />
            </div>
			<div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/consumption_list'; ?>" style="text-decoration: none;">
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
				  <th>Type</th>
                  <th>Item Name</th>
				  <th>quantity</th>
				  <th>Unit Vendor Price</th>
				  <th>Total Vendor Price</th>
				  <th>Procedure Name</th>
				</tr>
              </thead>
              <tbody id="investigate_result">	  
           <?php	
		   //SELECT patient_id, patient_name,date, SUM(total_vendor_price) AS ot_vendor_price FROM hms_consumptions where type='Ot' GROUP BY patient_id ORDER BY date DESC;
		   $sql = "SELECT patient_id, SUM(total_vendor_price) AS ot_vendor_price FROM `hms_consumptions` WHERE patient_id='$patient_id' and type='Ot'";
           $select_result = run_select_query($sql);
	       $sql = "SELECT patient_id, SUM(total_vendor_price) AS hormonal_vendor_price FROM `hms_consumptions` WHERE patient_id='$patient_id' and type='Hormonal'";
           $select_result2 = run_select_query($sql);
		   $sql = "SELECT patient_id, SUM(total_vendor_price) AS embryologist_vendor_price FROM `hms_consumptions` WHERE patient_id='$patient_id' and type='Embryologist'";
           $select_result3 = run_select_query($sql); 
	       $total = $select_result['ot_vendor_price'] + $select_result2['hormonal_vendor_price'] + $select_result3['embryologist_vendor_price'];
		   
		   echo '<tr class="odd gradeX">';
	        echo '<td>'.'Ot'.'</td>';
	        echo '<td>'.round($select_result['ot_vendor_price'], 2).'</td>';
			echo '<td>'.'Hormonal'.'</td>';
			echo '<td>'.round($select_result2['hormonal_vendor_price'], 2).'</td>';
			echo '<td>'.'Embryologist'.'</td>';
			echo '<td>'.round($select_result3['embryologist_vendor_price'],2).'</td>';
			echo '<td>'.'Total'.'</td>';
			echo '<td>'.round($total, 2).'</td>';
			echo '</tr>';
		   
		    $total_totalpackage = 0;
			
		    foreach ($investigate_result as $key => $value) {
            $total_totalpackage += $value['total_vendor_price'];
			echo '<tr class="odd gradeX">';
	        echo '<td><a href="#">'.$value['patient_id'].'</a></td>';
	        echo '<td>'.$value['patient_name'].'</td>';
			echo '<td>'.$value['date'].'</td>';
			echo '<td>'.$value['type'].'</td>';
			echo '<td>'.$value['medicine_name'].'</td>';
			echo '<td>'.$value['quantity'].'</td>';
			echo '<td>'.$value['vendor_price'].'</td>';
			echo '<td>'.$value['total_vendor_price'].'</td>';
			echo '<td>'.$value['procedure_name'].'</td>';
			
			echo '</tr>';
			 
		        }
				
				
        ?>       <tr><td colspan="7"></td><td><?php  echo $total_totalpackage; ?></td></tr>       
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