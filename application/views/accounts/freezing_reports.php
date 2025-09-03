 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Freezing Reports  </h3></div>
       <div class="clearfix"></div>
	    <form action="<?php echo base_url().'accounts/freezing_reports'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                <select class="form-control" id="origins" name="origins">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($center == $val['center_number']){
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
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Patient Name </label>
                <input type="text" class="form-control" id="wife_name" name="wife_name" value="<?php echo $wife_name;?>" />
            </div>
			<div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/freezing_reports'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
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
                  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Receipt number</th>
                  <th>Payment Date</th>
                  <th>Total</th>
                  <th>Discount Amount</th>
				  <th>Discount Package</th>
				  <th>Receive Amount</th>
                  <th>Mode</th>
				  <th>Center</th>
				  <th>Expiry Date</th>
				  <th>Procedure</th>
                </tr>
              </thead>
              <tbody id="procedure_result">
              <?php 
$total_totalpackage = 0;
$total_discount_amount = 0;
$total_payment_done = 0;
$count = 1;

foreach($procedure_result as $ky => $vl){
    $patient_data = get_patient_detail($vl['patient_id']);
    $currency = '';
    $current_balance = $all_method->get_current_balance($vl['patient_id']); 

    if (!empty($vl['data'])) {
        $procedure_data = @unserialize($vl['data']);

        if ($procedure_data && isset($procedure_data['patient_procedures']) && is_array($procedure_data['patient_procedures'])) {
            foreach ($procedure_data['patient_procedures'] as $v2_data) {

                $sql1 = "SELECT * FROM hms_procedures WHERE code='".$v2_data['sub_procedures_code']."'";
                $query = $this->db->query($sql1);
                $select_result1 = $query->result(); 
                
                foreach ($select_result1 as $res_val) {
                    if (in_array($v2_data['sub_procedures_code'], ["INT13", "INT81", "IP96", "IP106", "IP265", "IP266", "IP107", "IP267", "IP268", "IP108", "IP93", "IP73", "IP72", "IP65", "IP437", "IP436", "IP435", "IP434",
																	"IP433", "IP432", "IP431", "IP419", "IP418", "IP417", "IP416", "IP397", "IP396","IP03", "IP103", "IP104", "IP105", "IP106", "IP107", "INT03", "IP109", "IP110",
																	"INT15", "INT18", "INT19", "INT38", "INT66", "INT72", "INT77", "IP111", "IP12", "IP14", "IP17", "IP18", "IP252", "IP253", "IP254", "IP255", "IP256", "IP257"])) {
                        echo '<tr class="odd gradeX">';
                        echo '<td>'.$count.'</td>';
                        echo '<td>'.$vl['patient_id'].'</td>';
                        $patient_name = $all_method->get_patient_name($vl['patient_id']);
                        echo '<td>'.strtoupper($patient_name).'</td>';
                        echo '<td><a href="'.base_url().'accounts/details/'.$vl['receipt_number'].'?t=procedure">'.$vl['receipt_number'].'</a></td>';
                        echo '<td>'.$vl['on_date'].'</td>';
                        echo '<td>'.$vl['totalpackage'].'</td>';
                        echo '<td>'.$vl['discount_amount'].'</td>';
                        echo '<td>'.$vl['fees'].'</td>';
                        echo '<td>'.$vl['payment_done'].'</td>';
                        echo '<td>'.$vl['payment_method'].'</td>';
                        echo '<td>'.$all_method->get_center_name($vl['billing_at']).'</td>';
						echo '<td>'.$vl['expiry_date'].'</td>';
                        echo '<td>';
                        echo '<br/>';
                        echo $res_val->procedure_name;
                        echo " = ". $v2_data['sub_procedures_price'];
                        echo " = ". $v2_data['sub_procedures_code'];
                        echo '</td></tr>';

                        $total_totalpackage += $vl['totalpackage'];
                        $total_discount_amount += $vl['discount_amount'];
                        $total_payment_done += $vl['payment_done'];
                        $count++;
                    }
                }
            }
        }
    }
}
?>

<?php if ($row_printed): ?>
    <!-- ✅ Show pagination only if at least one row is printed -->
    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div>
<?php endif; ?>

              <tr>
                <td colspan="5">
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