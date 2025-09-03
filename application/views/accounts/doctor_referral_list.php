 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Doctor Referral List  </h3></div>
       <div class="clearfix"></div>
	   
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="doctor_referral_list">
              <thead>
                <tr>
				  <th>S.No.</th>
				  <th>Doctor Name</th>
                  <th>Status</th>
				  <th>Action</th>
				</tr>
              </thead>
              <tbody id="procedure_result">
              <?php 
			  $count=1; 
			  foreach($procedure_result as $ky => $vl){
               ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><?php echo $vl['doctor_name']?></td>
                  <td><?php echo $vl['status']?></td>
				  <td><a href="<?php echo base_url();?>accounts/doctor_referral_edit?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a></td>
				</tr>
              <?php $count++;} ?>
			   <tr>
                <td colspan="11">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
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