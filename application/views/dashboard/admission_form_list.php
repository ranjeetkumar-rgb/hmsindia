 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Admission Form List</h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'accounts/admission_form_list'; ?>" method="get">
		     
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="iic_id" name="iic_id" value="<?php echo $iic_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/admission_form_list'; ?>" style="text-decoration: none;">
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
                  <th>Ipid</th>
                  <th>Doctor Name</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody id="procedure_result">
              <?php 
			  $count=1; 
			  foreach($procedure_result as $ky => $vl){
               ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><a href="<?php echo base_url().'patient_details/iic_id'; ?>?appoitmented_date=<?php echo $vl['appoitmented_date']; ?>"><?php echo $vl['iic_id']; ?></td>
				  <td><?php echo $vl['ipid']?></td>
				  <td><?php echo $vl['doctor_name']?></td>
                  <td><?php echo $vl['updated_at']?></td>
                </tr>
              <?php $count++;} ?>
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