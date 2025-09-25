 <?php $all_method =&get_instance(); ?>
        <div class="card">
      <div class="row card-content" style="margin-bottom:20px;">
      <div class="col-md-12"><h3>Consultation Revenue Reports </h3></div>
      <div class="clearfix"></div>
	    <form action="<?php echo base_url().'accounts/consultation_origin'; ?>" method="get">
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
            	<a href="<?php echo base_url().'accounts/consultation_origin'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/consultation-reports'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Reports</button>
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
                  <th>CRM ID</th>
                  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Consultation Date and Time</th>
                  <th>Total</th>
                  <th>Discount amount</th>
				          <th>Received amount</th>
                  <th>Center</th>
                   <th>Reason For Visit</th>
				          <th>Doctor Name</th>
				          <th>Lead Source</th>
				          <th>Counselor Name</th>
				</tr>
              </thead>
              <tbody id="consultation_result">
              <?php 
			  $count=1; foreach($consultation_result as $ky => $vl){
			  			$patient_data = get_patient_detail($vl['patient_id']);
            $currency = '';
			   ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php 
                  $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where ID='".$vl['appointment_id']."'";
	                $select_appoint = run_select_query($sql1);
                  
                  echo $select_appoint['crm_id']; ?></td>
                  <td><?php echo $vl['patient_id']; ?></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo strtoupper($patient_name); ?></td>
                  <td><?php echo $vl['on_date']?></td>
				  <td><?php echo $vl['totalpackage']?></td>
                  <td><?php echo $vl['discount_amount']?></td>
				  <td><?php echo $vl['payment_done']?></td>
                  <td><?php echo $all_method->get_center_name($vl['billing_at']); ?></td>
                  <td><?php echo $vl['reason_of_visit']?></td>
				  <td><?php echo $all_method->get_doctor_name($vl['doctor_id']); ?></td>
				  <td><?php echo $all_method->get_lead_source($vl['patient_id']); ?></td>
				  <td><?php echo $all_method->get_counselor_name($vl['appointment_id']); ?></td>
				</tr>
                 <?php $count++;} ?>
			   <tr>
                <td colspan="5">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
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