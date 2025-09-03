  <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <style>
	  a#export_stock {
		text-align: right;
		width: 100%;
		display: block;
		color: #000;
		margin-bottom:10px;
 	  }
	  .card .card-action{padding:45px 15px!important;}
      </style>
      <div class="card">
     
       <!-- <div class="card-action"><h3>All Center Stocks Lists </h3><a href="<?php echo base_url('stocks/center_stock_export/'.$_SESSION['logged_stock_manager']['center'].'');?>" id="export_stock"><i class="fa fa-download fa-lg" aria-hidden="true"></i> Export stock</a>
      	</div>-->
	   	<form action="<?php echo base_url().'billings/forma_invoice_list'; ?>" method="get">
       <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Center </label>
                <select class="form-control" id="center_number" name="center_number">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($billing_at == $val['center_number']){
                            echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Patient Id</label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
           <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            <a href="<?php echo base_url().'billings/forma_invoice_list'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            	<a href="<?php echo base_url('billings/All-Center-Medicine'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing"  onclick="backupDatabase();">Export Billings</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
       
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover stock_list1" id="centre_stock_list1">
              <thead>
                <tr>
                  <th>ID</th>
				  <th>IIC ID</th>
				  <th>Wife Name</th>
                  <th>Procedure Name</th>
				  <th>Code</th>
				  <th>Price</th>
				  <th>Discount</th>
				  <th>After Discount</th>
				  <th>Date Booking</th>
				  <th>Booking Center</th>
                  <th>Counsellor Name</th>
                  <th>Coordinator Name</th>
				  <th></th>
				  <th>Doctor Name</th>
				</tr>
              </thead>
              <tbody id="table_content">
              <?php $count=1; foreach($investigate_result as $vl){	?>
                <tr class="odd gradeX">
					<td></td>
				    <td><?php echo $vl['patient_id']; ?></td>
				    <td><?php echo $vl['wife_name']; ?></td>
					<td><?php echo $vl['procedure_name_1']; ?>,<br/><?php echo $vl['procedure_name_2']?><br/><?php echo $vl['procedure_name_3']?><br/><?php echo $vl['procedure_name_4']?></td>
				    <td><?php echo $vl['code_1']; ?><br/><?php echo $vl['code_2']?><br/><?php echo $vl['code_3']?><br/><?php echo $vl['code_4']?></td>
				    <td><?php echo $vl['price_1']; ?><br/><?php echo $vl['price_2']?><br/><?php echo $vl['price_3']?><br/><?php echo $vl['price_4']?></td>
				    <td><?php echo $vl['discount_1']; ?><br/><?php echo $vl['discount_2']?><br/><?php echo $vl['discount_3']?><br/><?php echo $vl['discount_4']?></td>
				    <td><?php echo $vl['after_discount_1']; ?><br/><?php echo $vl['after_discount_2']?><br/><?php echo $vl['after_discount_3']?><br/><?php echo $vl['after_discount_4']?></td>
				    <td><?php echo $vl['booking_date']; ?></td>
				    <td><?php echo $all_method->get_center_name($vl['center_number']); ?></td>
				    <td><?php echo $vl['counsellor_signature']; ?></td>
					<td><?php echo $vl['coordinator_signature']; ?></td>
					<td><a class="btn btn-secondary" href="<?php echo base_url('billings/withdrawl_prescription'); ?>/<?php echo $vl['patient_id']; ?>">Withdrawl Prescription</td>
					<td><?php $sql = "Select * from ".$this->config->item('db_prefix')."doctor_consultation where ID='".$vl['appointment_id']."'";
								$select_result = run_select_query($sql);
								echo $all_method->doctor_name($select_result['doctor_id']);
					?></td>
				</tr>
              <?php $count++;} ?>
			   <tr>
                <td colspan="16">
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
