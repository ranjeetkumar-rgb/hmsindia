<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
	  <div class="card-content"><h3>Stocks Report </h3></div>
         <div class="clearfix"></div>
    <form action="<?php echo base_url().'stocks/stocks_reports'; ?>" method="get">
	  <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by Stock at</label>
                <select class="form-control" multiple="multiple"  style="height: 58px!important;" id="employee_number" name="employee_number[]">
                	<?php $all_emplyee = $all_method->get_employee_list();
						            foreach($all_emplyee as $key => $val){ //var_dump($val);die;
                          if($employee_number == $val['name']){
                            echo '<option value="'.$val['employee_number'].'" selected>'.$val['name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['employee_number'].'">'.$val['name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by Stock at</label>
                <select class="form-control" id="center_number" name="center_number">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($center_number == $val['center_number']){
                            echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Patient ID</label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			 <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Batch Number</label>
                <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $batch_number;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Invoice No</label>
                <input type="text" class="form-control" id="invoice_no" name="invoice_no" value="<?php echo $invoice_no;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Type</label>
              <select class="form-control" id="type" name="type">
                	<option value=''>--Select From--</option>
                    <option value="Center In">Center In</option>
                    <option value="Cash">Cash</option>
                    <option value="Hormonal">Hormonal</option>
                    <option value="Transfer Stocks">Transfer Stocks</option>
                    <option value="Embryologist">Embryologist</option>
                    <option value="Ot">OT</option>
                  </select>
            </div>
            <div class="col-sm-3" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit" onclick="searchFilter()"  class="btn btn-primary">Search</button>
              <a href="<?php echo base_url().'stocks/stocks_reports'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
               <a href="<?php echo base_url('stocks/Medicine-Stock-Reports'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Medicine</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
       
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
		  <!--<table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
              <thead>
                <tr>
				  <th>Total Vendor Price (GST Excluded)</th>
                  <th>Total Vendor Price (GST Included)</th>
				  <th>Total GST</th>
				  <th>Total Mrp Price</th>
				</tr>
              </thead>
			  <tbody id="procedure_result">
			  	 <tr>
			<?php 
						 //  foreach($total_stock_result as $ky => $vl){
							?>
								<td><?php //echo round($vl['total_vendor_price_gst_excluded'],2); ?></td>
								<td><?php //echo round($vl['total_vendor_price_gst_included'],2); ?></td>
								<td><?php //echo round($vl['total_vendor_price_gst_included']- $vl['total_vendor_price_gst_excluded'],2); ?></td>
								<td><?php //echo round($vl['total_mrp_price'],2); ?></td>
						 	 <?php	
						//		} 
							?>
			  			</tr>
             </tbody>
            </table>-->
            <table class="table table-striped table-bordered table-hover stock_list1" id="centre_stock_list1">
                            <thead>
                <tr>
				  <th>Item name</th>
				  <th>Batch No</th>
				  <th>Expiry</th>
				  <th>Opening Stock</th>
				  <th>Stock IN</th>
				  <th>Stock Out</th>
				  <th>Closing Stock</th>
				  <th>Vendor Price (Unit - GST included)</th>
				  <th>GST Rate (Unit)</th>
				  <th>Vendor Price (Unit - GST Excluded)</th>
				  <th>Total Vendor Price (GST Excluded)</th>
				  <th>Total Vendor Price (GST included)</th>
				  <th>Total GST Amount</th>
				  <th>MRP</th>
				  <th>Center Name</th>
          <th>Date</th>
				  <th>Type</th>
          <th>Invoice No</th>
          <th>Date Of Purchase</th>
          <th>Ageing</th>
          <th>Patient Name</th>
                </tr>
              </thead>
              <tbody id="table_content">
              <?php $count=1; foreach($investigate_result as $vl){
               if (!empty($vl['gstdivision']) && $vl['gstdivision'] != 0) {
					$vendor_price_gst_Excluded = $vl['vendor_price'] / $vl['gstdivision'];
				} else {
					// Handle the case where gstdivision is zero or empty
					$vendor_price_gst_Excluded = $vl['vendor_price']; // or set to 0 or whatever makes sense
				}
				        $total_vendor_price_gst_excluded = (float) $vl['closingstock'] * $vendor_price_gst_Excluded;
				        $total_vendor_price_gst_included = $vl['closingstock'] * $vl['vendor_price'];
				        $total_gst_amount = $total_vendor_price_gst_included - $total_vendor_price_gst_excluded;
				  ?>
        <tr class="odd gradeX">
				  <td><?php echo $vl['item_name']; ?></td>
				  <td><?php echo $vl['batch_number']; ?></td>
				  <td><?php echo $vl['expiry']; ?></td>
				  <td><?php echo $vl['openstock']; ?></td>
          <td><?php echo $vl['quantity_in']; ?></td>
				  <td><?php echo $vl['quantity_out']; ?></td>
          <td><?php echo $vl['closingstock']; ?></td>
          <td><?php echo $vl['vendor_price']; ?></td>
				  <td><?php echo $vl['gstrate']; ?></td>
				  <td><?php echo round($vendor_price_gst_Excluded,2); ?></td>
				  <td><?php echo round($total_vendor_price_gst_excluded,2); ?></td>
				  <td><?php echo round($total_vendor_price_gst_included,2); ?></td>
				  <td><?php echo round($total_gst_amount,2); ?></td>
				  <td><?php echo $vl['mrp']?></td>
				  <td><?php $sql1 = "select * from hms_employees where employee_number='".$vl['employee_number']."'"; 
						        $query = $this->db->query($sql1);
                    $select_result1 = $query->result(); 
							      foreach ($select_result1 as $res_val){
								    echo $res_val->name;
							      }
							?></td>
				  <td><?php echo $vl['add_date']?></td>
				  <td><?php echo $vl['type']?></td>
          <td><?php echo $vl['invoice_no']?></td>
          <td><?php echo $vl['date_of_purchase']?></td>
          <td><?php
if (empty($vl['date_of_purchase']) || $vl['date_of_purchase'] === "0000-00-00") {
  // Handle the case where date_of_purchase is empty or equals "0000-00-00"
  echo "0";
} else {
  // Convert the 'date_of_purchase' string to a DateTime object
  $date1 = new DateTime($vl['date_of_purchase']);

  // Get today's date as a DateTime object
  $date2 = new DateTime();  // This gives the current date

  // Calculate the difference between the two dates
  $diff = $date1->diff($date2);

  // Output the difference in days
  echo $diff->days;
}
?></td>
          <td><?php if($vl['type'] == "Cash") { ?><a target="_blank" href="<?php echo base_url()?>/stocks/medicine_stock?employee_number=&start_date=&end_date=&patient_id=<?php echo $vl['patient_id']; ?>&consumables_name=&btnsearch="><?php $patient_data = get_patient_detail($vl['patient_id']); echo  strtoupper($patient_data['wife_name']); ?></a> <?php }else{ ?> <a target="_blank" href="<?php echo base_url()?>/stocks/consumption_price?start_date=&end_date=&patient_id=<?php echo $vl['patient_id']; ?>&btnsearch="><?php $patient_data = get_patient_detail($vl['patient_id']); echo  strtoupper($patient_data['wife_name']); ?></a> <?php  }  ?></td>
				</tr>
			 <?php $count++;} ?>
			   <tr>
                <td colspan="11">
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


      function searchFilter(){
          var employee_name = $("#employee_number").val();
          //top.location.href = '/stocks/stocks_reports?employee_number='+employee_name;
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
a#export_stock {
		text-align: right;
		width: 100%;
		display: block;
		color: #000;
		margin-bottom:10px;
}
.card .card-action{padding:45px 15px!important;}
</style>