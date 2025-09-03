 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="card" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Investigation Patients </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'accounts/investigation_sales'; ?>" method="get">
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
			<div class="col-sm-2 col-xs-12" style="margin-top:10px;">
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
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $patient_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/investigation_sales'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/investigation-sales'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
               </a>
            </div>	    
            </form>
         <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">

              <thead>
                <tr>
				  <th>S.No.</th>
				  <th>On Date</th>
                  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Receipt number</th>
				  <th>Investigation Name</th>
                  <th>Total</th>
                  <th>Discount amount</th>
				  <th>Discount Package</th>
				  <th>Payment Received</th>
                  <th>Mode</th>
                  <th>Center</th>
                  <th>Origins</th>
                </tr>
              </thead>

              <tbody id="investigate_result">
              <?php 
			   $total_totalpackage = 0;
              $total_discount_amount = 0;
			  $total_payment_done = 0;
			  $count=1; foreach($investigate_result as $ky => $vl){
                            $patient_data = get_patient_detail($vl['patient_id']);
    						 $currency = '';
              ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo $vl['patient_id']; ?></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo strtoupper($patient_name); ?></td>
                  <td><?php echo $vl['receipt_number']?></td>
				   <td><?php 
				  if(!empty($vl['investigations'])){
					  $investigation_data = unserialize($vl['investigations']);
					  foreach ($investigation_data['female_investigation'] as $v2_data){
						    $sql1 = "select * from hms_investigation where code='".$v2_data['female_investigation_code']."'"; 
                            $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->investigation;
								 echo " = ". $v2_data['female_investigation_price'];
							}
					  }
					  foreach ($investigation_data['male_investigation'] as $v2_data){
						    $sql1 = "select * from hms_investigation where code='".$v2_data['male_investigation_code']."'"; 
                            $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->investigation;
								 echo " = ". $v2_data['male_investigation_price'];
							}
					  }
				  }
				  $total_totalpackage += $vl['totalpackage'];
				$total_discount_amount += $vl['discount_amount'];
				$total_payment_done += $vl['payment_done'];
				  ?></td>
				  <td><?php echo $currency.$vl['totalpackage']?></td>
                  <td><?php echo $currency.$vl['discount_amount']?></td>
				  <td><?php echo $vl['fees']?></td>
                  <td><?php echo $currency.$vl['payment_done']?></td>
				  
				  
                  <td><?php echo $vl['payment_method']; ?></td>
                  <td><?php echo $all_method->get_center_name($vl['billing_at']); ?></td>
				   <td><?php 
				      $sql2 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$vl['origins']."'"; 
			            $query = $this->db->query($sql2);
                            $select_result2 = $query->result(); 
							foreach ($select_result2 as $res_val2){
								echo '<br/>';
								echo $res_val2->center_name;
							}
						?></td>
				 
                </tr>
              <?php $count++;} ?>
			   <tr>
                <td colspan="6">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td><td><?php echo $total_totalpackage; ?></td>
				<td><?php echo $total_discount_amount; ?></td>
				<td><?php echo $total_payment_done; ?></td>
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