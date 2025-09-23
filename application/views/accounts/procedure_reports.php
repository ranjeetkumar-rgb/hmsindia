 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Procedure Reports  </h3></div>
       <div class="clearfix"></div>
	    <form action="<?php echo base_url().'accounts/procedure_reports'; ?>" method="get">
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
            	<label>Filter by billing at</label>
                <select class="form-control" id="biller_id" name="biller_id">
                	<option value=''>--Select From--</option>
                    <?php $all_emplyee = $all_method->get_stock_user();
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
            	<a href="<?php echo base_url().'accounts/procedure_reports'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/procedure-reports'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Report</button>
               </a>
            </div>
            </form>  
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
              <thead>
                <tr>
				          <th>S.No.</th>
                  <th>CRM ID</th>
                  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Receipt number</th>
                  <th>On Date</th>
                  <th>Total</th>
                  <th>Discount Amount</th>
				          <th>Discount Package</th>
				          <th>Receive Amount</th>
                  <th>Mode</th>
                  <th>Center</th>
				          <th>Origins</th>
				          <th>Employee Name</th>
				          <th>Procedure</th>
				          <th>Type</th>
                   <th>Doctor Name</th>
				          <th>Lead Source</th>
				          <th>Counselor Name</th>
                </tr>
              </thead>
              <tbody id="procedure_result">
              <?php 
			  $total_totalpackage = 0;
              $total_discount_amount = 0;
			  $total_payment_done = 0;
			  $count=1; foreach($procedure_result as $ky => $vl){
                $patient_data = get_patient_detail($vl['patient_id']);
						    $currency = '';
                $current_balance = $all_method->get_current_balance($vl['patient_id']); ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php echo $count; ?></td>
                  <td><a href="<?php echo base_url().'accounts/procedure_advice'; ?>/<?php echo $vl['patient_id']; ?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php 
                    $patient_name = $all_method->get_patient_name($vl['patient_id']);
                    echo strtoupper($patient_name); ?>
                  </td>
                  <td><a href="<?php echo base_url().'accounts/details';?>/<?php echo $vl['receipt_number']?>?t=procedure"><?php echo $vl['receipt_number']; ?></a></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo $vl['totalpackage']?></td>
                  <td><?php echo $vl['discount_amount']?></td>
				  <td><?php echo $vl['fees']?></td>
				  <td><?php echo $vl['payment_done']?></td>
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
				  <td><?php 
				      $sql2 = "Select * from ".$this->config->item('db_prefix')."employees where employee_number='".$vl['biller_id']."'"; 
			            $query = $this->db->query($sql2);
                            $select_result3 = $query->result(); 
							foreach ($select_result3 as $res_val3){
								echo '<br/>';
								echo $res_val3->name;
							}
						?></td>
				 
				  <?php 
				  if(!empty($vl['data'])){
					  $procedure_data = unserialize($vl['data']);
					  foreach ($procedure_data['patient_procedures'] as $v2_data){
						    $sql1 = "select * from hms_procedures where code='".$v2_data['sub_procedures_code']."'";
                        //  $sql1 = "select * from hms_procedures where code='INT70,IP70,INT39,IP36'";						  
                            $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo ' <td>';
								 echo $res_val->procedure_name;
								 echo " = ". $v2_data['sub_procedures_price'];
								 echo " Paid Amount = ". $v2_data['sub_procedures_paid_price'];
								 echo '</td>';
								 echo ' <td>';
								 echo $res_val->category;
								 echo '</td>';
							}
					 }
				}
				  ?>
                  <td><?php echo $all_method->get_doctor_name($vl['doctor_id']); ?></td>
				  <td><?php echo $all_method->get_lead_source($vl['patient_id']); ?></td>
				  <td><?php echo $all_method->get_counselor_name($vl['appointment_id']); ?></td>
                </tr>
              <?php $count++;} ?>
              </tbody>			  
            </table>
          </div>
        </div>
      </div>
     </div>
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