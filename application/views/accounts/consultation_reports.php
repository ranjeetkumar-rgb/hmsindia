 <?php $all_method =&get_instance(); ?>
        <div class="card">
      <div class="row card-content" style="margin-bottom:20px;">
      <div class="col-md-12"><h3> Consultation  Patients </h3></div>
      <div class="clearfix"></div>
	    <form action="<?php echo base_url().'accounts/consultation_reports'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                <select class="form-control" id="billing_at" name="billing_at">
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
            	<label>Payment Type </label>
                <select class="form-control" id="payment_method" name="payment_method">
				    <option value=''>--Select From--</option>
                    <option value="cash" mode="Cash">Cash</option>
					<option value="neft" mode="NEFT">NEFT</option>
                    <option value="rtgs" mode="RTGS">RTGS</option>
                    <option value="card" mode="Card">Card</option>
                    <option value="upi" mode="UPI">UPI</option>
                    <option value="insurance" mode="Insurance">Insurance</option>
					<option value="wallets" mode="Wallets">Wallets</option>
					<option value="loan" mode="loan">Financing Loan</option>
					<option value="cheque" mode="Cheque">Cheque</option>
                </select>
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Reason For Visit </label>
                <select class="form-control" id="reason_of_visit" name="reason_of_visit">
				    <option value=''>--Select From--</option>
					<option value="First Visit" mode="First Visit">First Visit</option>
                    <option value="Consulted Not Booked" mode="Consulted Not Booked">Consulted Not Booked</option>
                    <option value="FOLLOW UP VISIT" mode="FOLLOW UP VISIT">Follow up Visit</option>
					<option value="PROCEDURE" mode="PROCEDURE">Procedure</option>
                    <option value="TVS" mode="TVS">TVS</option>
                    
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
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $patient_id;?>" />
            </div>
            <div class="col-sm-3" style="margin-top: 30px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            	<a href="<?php echo base_url().'accounts/consultation_reports'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            	<a href="<?php echo base_url('accounts/consultation-reports'); ?>" style="text-decoration: none;">
                <button name="export-consultation-reports" type="submit"  class="btn btn-secondary" id="export-consultation-reports">Export Reports</button>
               </a>
            </div>	
		  </form>  
        </div>
        <div class="clearfix"></div>
       <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-sriped table-bordered table-hover" id="consultation_billing_list">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Receipt number</th>
                  <th>On Date</th>
                  <th>Total</th>
                  <th>Received amount</th>
                  <th>Center</th>
				  <th>Reason For Visit</th>
				  <th>Doctor Name</th>
				  <th>Lead Source</th>
				  <th>Counsor Name</th>
               </tr>
              </thead>
              <tbody id="consultation_result">
              <?php 
			  $total_totalpackage = 0;
              $total_discount_amount = 0;
			  $total_payment_done = 0;
			  $count=1; foreach($consultation_result as $ky => $vl){
			  			$patient_data = get_patient_detail($vl['patient_id']);
            $currency = '';
			   ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php echo $vl['patient_id']; ?></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo strtoupper($patient_name); ?></td>
                  <td><?php echo $vl['receipt_number']?></td>
                  <td><?php echo $vl['on_date']?></td>
				  <td><?php echo $vl['totalpackage']?></td>
                  <td><?php echo $vl['payment_done']?></td>
                  <td><?php echo $all_method->get_center_name($vl['billing_at']); ?></td>
				  <td><?php echo $vl['reason_of_visit']?></td>
				  <td><?php echo $all_method->get_doctor_name($vl['doctor_id']); ?></td>
				  <td><?php echo $all_method->get_lead_source($vl['patient_id']); ?></td>
				  <td><?php echo $all_method->get_counselor_name($vl['appointment_id']); ?></td>
                 
                </tr>
                 <?php 
                $total_totalpackage += $vl['totalpackage'];
				$total_discount_amount += $vl['discount_amount'];
				$total_payment_done += $vl['payment_done'];
				 ?>
              <?php $count++;} ?>
			  <!-- Your table content here -->

<!-- Pagination display -->

			   <tr>
                <td colspan="5">
        <!-- Item count display -->
        <div class="pagination-info">
            <?php if ($total_items > 0): ?>
                Showing <?php echo $start_item; ?> to <?php echo $end_item; ?> of <?php echo $total_items; ?> items
            <?php else: ?>
                No items found
            <?php endif; ?>
        </div>
        
        <!-- Pagination links -->
        <div class="custom-pagination">
            <?php echo $pagination_links; ?>
        </div>
    </td>
                </td><td><?php echo $total_totalpackage; ?></td>
				<td><?php echo $total_payment_done; ?></td>
				<td colspan="5"></td>
              </tr>

              </tbody>

            </table>

          </div>

        </div>

      </div>

       <!--End Consultation  Tables -->
     
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