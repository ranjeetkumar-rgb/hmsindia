<?php $all_method =&get_instance();  ?>
 	<div class="card">
      <!-- Advanced Tables -->
 <div class="row card-content" style="margin-bottom:20px;">
      <div class="col-md-12"><h3>Cancel Procedure Billings </h3></div>
      <div class="clearfix"></div>
        <form action=""<?php echo base_url().'accounts/cancel_procedure_list'; ?>" method="get">
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
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/cancel_procedure_list'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			<div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/cancel-procedure'); ?>" style="text-decoration: none;">
                <button name="export-cancel-billing" type="submit"  class="btn btn-secondary" id="export-cancel-billing">Export Billings</button>
               </a>
            </div>	
            </form>  
        </div>

       <!--Procedure Tables -->

   		  <div class="card">

         <div class="clearfix"></div>

        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="">

              <thead>

                <tr>

                  <th>S.No.</th>

                  <th>Receipt number</th>

                  <th>IIC ID</th>

                  <th>Patient Name</th>

                   <th>Total package</th>

                  <th>Discounted package</th>

                  <th>Paid amount</th>
				  
				  <th>Used amount</th>
				  
				  <th>On Date</th>

                  <th>Cancel Date</th>

                  <th>Status</th>
				  
				  <th>CN Invoice</th>

				</tr>

              </thead>

              <tbody id="procedure_result">
			  
			  <?php $count=1; foreach($procedure_result as $ky => $vl){
                $patient_data = get_patient_detail($vl['patient_id']);
						    $currency = '';
                $current_balance = $all_method->get_current_balance($vl['patient_id']); ?>


                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td><a href="<?php echo base_url(); ?>accounts/wallet/<?php echo $vl['receipt_number']?>?t=procedure"><?php echo $vl['receipt_number']?></a></td>

                  <td><a href="<?php echo base_url()?>patients/edit/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>

                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  $patient_name; ?></td>

                     <td><?php echo $currency.$vl['totalpackage']?></td>

                  <td><?php echo $currency.$vl['fees']?></td>

                  <td><?php echo $currency.$vl['payment_done']?></td>
				  
				  <td><?php echo $currency.$vl['used_amount']?></td>

                  <td><?php echo $vl['on_date']?></td>
				  
				   <td><?php echo $vl['modified_on']?></td>

                  <td><?php echo ucfirst($vl['status']); ?></td>
				  
				  <td><?php echo $vl['cn_invoice']?>

				</tr>

              <?php $count++;} ?>
			   <tr>
                <td colspan="12">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Procedure Tables -->
    </div>
<style>
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
</script>