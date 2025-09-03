 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Dashboard  </h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'accounts/reports'; ?>" method="get">
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
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/reports'; ?>" style="text-decoration: none;">
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
				          <th>Name</th>
                  <th>Total</th>
                  <th>Discount amount</th>
				          <th>Receive amount</th>
                </tr>
              </thead>
			  <tbody id="procedure_result">
			  	 <tr>
					    <td>Procedure</td>
              <?php 
						   foreach($procedure_result as $ky => $vl){
						   	?>
									<td><?php echo round($vl['total_package'],2); ?></td>
									<td><?php echo round($vl['discount_amount'],2); ?></td>
									<td><?php echo round($vl['payment_done'],2); ?></td>
						 	 <?php	
								} 
							?>
			  			</tr>
             </tbody>
            
            <tbody id="investigation_result">
			  	 <tr>
					    <td>Investigation</td>
              <?php 
               foreach($investigation_result as $ky => $vl){
						   	?>
									<td><?php echo round($vl['total_package'],2); ?></td>
									<td><?php echo round($vl['discount_amount'],2); ?></td>
									<td><?php echo round($vl['payment_done'],2); ?></td>
						 	 <?php	
								} 
							?>
			  			</tr>
             </tbody>
            
            <tbody id="consultation_result">
			  	 <tr>
					    <td>Consultation</td>
              <?php 
               foreach($consultation_result as $ky => $vl){
						   	?>
									<td><?php echo round($vl['total_package'],2); ?></td>
									<td><?php echo round($vl['discount_amount'],2); ?></td>
									<td><?php echo round($vl['payment_done'],2); ?></td>
						 	 <?php	
								} 
							?>
			  			</tr>
             </tbody>
              
			    <tbody id="partial_payment">
			  	 <tr>
					    <td>Partial</td>
              <?php 
               foreach($partial_payment as $ky => $vl){
						   	?>
									<td><?php echo round($vl['payment_done'],2); ?></td>
									<td></td>
									<td></td>
						 	 <?php	
								} 
							?>
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