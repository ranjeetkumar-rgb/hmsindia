 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12 card">
      <div class="row" style="margin-bottom:20px;">
      <div class="col-md-12"><h3> Patient Detail Center Wise Report </h3></div>
      <div class="clearfix"></div>
        <form action=""<?php echo base_url().'accounts/patient_center_wise_report'; ?>" method="get">
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
            	<label>Start Booking Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Booking Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $patient_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/patient_center_wise_report'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/procedure-patients'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
               </a>
            </div>		
            </form>  
        </div>
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
              <thead>
                <tr>
				  <th>S.No.</th>
				  <th>CRM ID</th>
                  <th>Visit Month</th>
                  <th>First Visit Date</th>
                  <th>Booking Month</th>
                  <th>Booking Date</th>
                  <th>CH/FC Name</th>
                  <th>Doctor consulted</th>
                  <th>IIC ID</th>
                  <th>Patients Name</th>
                  <th>Centre Booking</th>
                  <th>Centre Procedure</th>
				  <th>Patient's Source</th>
				  <th>Patient Type(New/Follow Up/ Recycle)</th>
				  <th>Procedure Type(Add-on/IVF-procedure)</th>
				  <th>Code</th>
				  <th>Status of Booking</th>
				  <th>Procedure name (Same Day all procedure in same Column) IVF with Bed</th>
				  <th>Package Amount</th>
				  <th>Discount Amount</th>
				  <th>Package After Discount</th>
				  <th>Payment received</th>
				  <th>Balance Amount</th>
				  <th>Status(on Track/Delayed/Likely Cancellation)</th>
				  <th>Comment/Current Status of Treatment( Latest Remarks and Date of Doctos)</th>
				  <th>Next Steps - Follow UP</th>
				  <th>Std Withdrawal Date (T)</th>
				  <th>Actual Withdrawal Date</th>
				  <th>Withdrawl Status (Done/Pending)</th>
				  <th>Std Stimulation Date (40% of amount) (T+10)</th>
				  <th>Actual Stimulation Start Date</th>
				  <th>Stimulation Start Status (Done/Pending)</th>
				  <th>Amount (stimulation date)</th>
				  <th>Std Trigger Date (50% of Package)(T+18)</th>
				  <th>Actual  Trigger Date</th>
				  <th>Amount (Billing Date)</th>
				  <th>Trigger Status (Done/Pending)</th>
				  <th>Std OPU Date(T +20)</th>
				  <th>Actual  OPU Date</th>
				  <th>Amount (Billing Date)</th>
				  <th>OPU Status (Done/Pending)</th>
				  <th>Embryo Transfer Date</th>
				  <th>First Value</th>
				  <th>Serum Bete Hcg On Date</th>
				  <th>No. of gestational sac </th>
				  <th>Total Amount (Add on/ Non IVF with Bed/ Non IVF without Bed)</th>
				  <th>Recieved Amount (Add on/ Non IVF with Bed/ Non IVF without Bed)</th>
				  <th>Pending Amount(Add on/ Non IVF with Bed/ Non IVF without Bed)</th>
				  <th>Expected Date </th>
				  <th>Total Amount (Pharmacy)</th>
				  <th>Recieved Amount (Pharmacy)</th>
				  <th>Pending Amount(Pharmacy)</th>
				  <th>Expected Date </th>
				  <th>Total Amount (Diagnostics)</th>
				  <th>Recieved Amount (Daignostics)</th>
				  <th>Pending Amount(Daignostic)</th>
				  <th>Expected Date </th>
				  <th>Total Amount (Consultation)</th>
				  <th>Recieved Amount (Consultation)</th>
				  <th>Pending Amount(Consultation)</th>
				  <th>Expected Date </th>
				  <th>Total Payment Received </th>
				  <th>Total Pending Pending </th>
                </tr>
              </thead>
              <tbody id="procedure_result">
              <?php $count=1; foreach($procedure_result as $ky => $vl){
                $patient_data = get_patient_detail($vl['patient_id']);
				
				$sql = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."'";
				$select_result = run_select_query($sql);
	
				$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result['wife_phone']."' and paitent_type='new_patient' and status='consultation_done'";
				$select_result2 = run_select_query($sql2);
				
				$sql3 = "SELECT SUM(payment_done) AS total_payment_done, MAX(on_date) AS last_on_date  FROM hms_patient_payments WHERE billing_id = '" . $vl['receipt_number'] . "' AND status = '1'";
                $select_result3 = run_select_query($sql3);
				
				$sql4 = "SELECT * from ".$this->config->item('db_prefix')."doctor_consultation WHERE appointment_id='" . $vl['appointment_id'] . "'";
                $select_result4 = run_select_query($sql4);
				
				$sql5 = "SELECT * from ovulation_induction_protocol WHERE receipt_number='" . $vl['receipt_number'] . "'";
                $select_result5 = run_select_query($sql5);
				
				$sql6 = "SELECT * from trigger_module WHERE receipt_number='" . $vl['receipt_number'] . "'";
                $select_result6 = run_select_query($sql6);
				
				$sql7 = "Select * from ".$this->config->item('db_prefix')."appointments where ID='" . $vl['appointment_id'] . "'";
				$select_result7 = run_select_query($sql7);
				
				// Unserialize the fetched data
				$unserializedData = unserialize($vl['data']);

				// Check if 'patient_procedures' key exists and is an array
				if (isset($unserializedData['patient_procedures']) && is_array($unserializedData['patient_procedures'])) {
				$patientProcedures = $unserializedData['patient_procedures'];

				// Iterate through each procedure and display details
				foreach ($patientProcedures as $procedure) {
									
				}
				$sql8 = "Select * from ".$this->config->item('db_prefix')."procedures where ID='" .$procedure['sub_procedure']. "'";
				$select_result8 = run_select_query($sql8);
				}
				
				$date_value = $select_result5['date1'] ?? ''; // Get date from array
				// Check if $date_value is empty
				if (!empty($date_value)) {
				$sql9 = "SELECT SUM(payment_done) AS total_stdate_payment_done FROM hms_patient_payments WHERE billing_id = '" . $vl['receipt_number'] . "' AND status = '1' AND DATE(on_date) <= '".$select_result5['date1']."'";
                $select_result9 = run_select_query($sql9);
				}
				
				$date_value_last_inj_fsh = $select_result6['last_inj_fsh'] ?? ''; // Get date from array
				// Check if $date_value is empty
				if (!empty($date_value_last_inj_fsh)) {
				$sql10 = "SELECT SUM(payment_done) AS total_stdate_payment_done FROM hms_patient_payments WHERE billing_id = '" . $vl['receipt_number'] . "' AND status = '1' AND DATE(on_date) <= '".$select_result6['last_inj_fsh']."'";
                $select_result10 = run_select_query($sql10);
				}
				
				$date_value_ovum_pickup = $select_result6['ovum_pick_up_on'] ?? ''; // Get date from array
				// Check if $date_value is empty
				if (!empty($date_value_ovum_pickup)) {
				$sql11 = "SELECT SUM(payment_done) AS total_stdate_payment_done FROM hms_patient_payments WHERE billing_id = '" . $vl['receipt_number'] . "' AND status = '1' AND DATE(on_date) <= '".$select_result6['ovum_pick_up_on']."'";
                $select_result11 = run_select_query($sql11);
				}
				
				$sql12 = "SELECT * from embryo_transfer WHERE receipt_number='" . $vl['receipt_number'] . "'";
                $select_result12 = run_select_query($sql12);
				
				$sql13 = "SELECT * from hms_serum_bete_hcg_on WHERE receipt_number='" . $vl['receipt_number'] . "'";
                $select_result13 = run_select_query($sql13);
				
				$total_payment_done = isset($select_result3['total_payment_done']) ? (float)$select_result3['total_payment_done'] : 0;
                $total = (int)$val['sub_procedures_price'] - (int)$val['sub_procedures_discount'];
                $total_receive = $vl['payment_done'] + $total_payment_done ;
				$pending_amount = $vl['fees'] - $total_receive;
				?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><?php echo $select_result['crm_id']; ?></td>
				  <td><?php $date = $select_result2['appoitmented_date']; // Original date (YYYY-MM-DD)
						$formatted_date = date("F y", strtotime($date)); // Output: "June 24"
						echo $formatted_date;
						 ?></td>
				  <td><?php echo $select_result2['appoitmented_date']; ?></td>
				  <td><?php $date = $vl['on_date']; // Original date (YYYY-MM-DD)
						$formatted_date = date("F y", strtotime($date)); // Output: "June 24"
						echo $formatted_date;
						 ?></td>
				  <td><?php echo $vl['on_date']; ?></td>
				  <td></td>
				  <td><?php echo $all_method->get_doctor_name($select_result4['doctor_id']); ?></td>
				  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php 
                    $patient_name = $all_method->get_patient_name($vl['patient_id']);
                    echo strtoupper($patient_name); ?>
                  </td>
                  <td><?php echo $all_method->get_center_name($vl['billing_at']); ?></td>
                  <td><?php echo $select_result6['admit_at']; ?></td>
                  <td><?php if (!empty($select_result['lead_source'])) {  echo $select_result['lead_source']; } else {  echo "Telecalling";  } ?></td>
                  <td><?php echo $select_result7['paitent_type']; ?></td>
                  <td><?php echo $select_result8['procedure_name']; ?></td>
				  <td><?php echo $select_result8['code']; ?></td>
                  <td><?php echo $vl['status']; ?></td>
                  <td><?php echo $select_result8['category']; ?></td>
                  <td><?php echo $vl['totalpackage']; ?></td>
				  <td><?php echo $vl['discount_amount']; ?></td>
				  <td><?php echo $vl['totalpackage'] - $vl['discount_amount']; ?></td>
				  <td><?php echo $total_receive; ?></td>
				  <td><?php echo $pending_amount; ?></td>
				  <td></td>
				  <td></td>
				  <td><?php echo $select_result4['follow_up_date']; ?></td>
				  <td><?php echo $vl['on_date']; ?></td>
				  <td></td>
				  <td><?php if (!empty($select_result5['date1'])){ echo "Done";} else { echo "Pending";} ?></td>
				  <td><?php $on_date = $vl['on_date']; // Get the original date
							$new_date = date('Y-m-d', strtotime($on_date . ' +10 days')); // Add 10 days
							echo $new_date;	?></td>
				  <td><?php echo $select_result5['date1']; ?></td>
				  <td><?php if (!empty($select_result5['date1'])){ echo "Done";} else { echo "Pending";} ?></td>
				  <td><?php echo $vl['payment_done'] + $select_result9['total_stdate_payment_done']; ?></td>
				  <td><?php 
					$on_date = $vl['on_date']; // Get the original date
					$new_date = date('Y-m-d', strtotime($on_date . ' +18 days')); // Add 10 days
					echo $new_date;
					?></td>
				  <td><?php echo $select_result6['last_inj_fsh']; ?></td>
				  <td><?php echo $vl['payment_done'] + $select_result10['total_stdate_payment_done']; ?></td>
				  <td><?php if (!empty($select_result6['last_inj_fsh'])){ echo "Done";} else { echo "Pending";} ?></td>
				  <td><?php 
					$on_date = $vl['on_date']; // Get the original date
					$new_date = date('Y-m-d', strtotime($on_date . ' +20 days')); // Add 10 days
					echo $new_date;
					?></td>
				  <td><?php echo $select_result6['ovum_pick_up_on']; ?></td>
				  <td><?php echo $vl['payment_done'] + $select_result11['total_stdate_payment_done']; ?></td>
				  <td><?php if (!empty($select_result3['last_on_date'])) { echo "Done";} else { echo "Pending";} ?></td>
				  <td><?php echo $select_result12['transfer_date']; ?></td>
				  <td><?php echo $select_result13['cardiac_activity_no']; ?></td>
				  <td><?php echo $select_result13['date']; ?></td>
				  <td><?php echo $select_result13['no_of_gestational']; ?></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
              <?php $count++;} ?>
              <tr>
                <td colspan="7">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
       <!--End Procedure Tables -->  
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