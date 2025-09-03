 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Liason List  </h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'accounts/liasonlist'; ?>" method="get">
		     <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by Center</label>
                <select class="form-control" id="center" name="center">
                	<option value=''>--Select From--</option>
					<option value='India IVF Fertility Noida'>India IVF Fertility Noida</option>
					<option value='India IVF Fertility Gurgaon'>India IVF Fertility Gurgaon</option>
					<option value='India IVF Fertility Delhi'>India IVF Fertility Delhi</option>
					<option value='India IVF Fertility Ghaziabad'>India IVF Fertility Ghaziabad</option>
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
            	<a href="<?php echo base_url().'accounts/liasonlist'; ?>" style="text-decoration: none;">
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
                  <th>Center Name</th>
                  <th>Certificate Name</th>
                  <th>Certificate / Licence No</th>
                  <th>Dept Name</th>
                  <th>Renewad Date</th>
                  <th>Expiry Date</th>
				  <th>Concern Person</th>
                  <th>Contact Number</th>
                  <th>Website Url</th>
				  <th>User ID</th>
				  <th>Password</th>
				  <th>Attachment</th>
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
				  <td><?php echo $vl['center']?></td>
				  <td><?php echo $vl['certificate']?></td>
				  <td><?php echo $vl['licence']?></td>
                  <td><?php echo $vl['dept_name']?></td>
                  <td><?php echo $vl['start_date']?></td>
                  <td><?php echo $vl['renwal_date']?></td>
                  <td><?php echo $vl['party_name']?></td>
				  <td><?php echo $vl['contact_no']?></td>
				  <td><?php echo $vl['web_url']?></td>
				  <td><?php echo $vl['user_id']?></td>
                  <td><?php echo $vl['password']?></td>
				  <td><a href="<?php echo $vl['transaction_img']; ?>" download><img src="<?php echo $vl['transaction_img']; ?>" height="80" width="80"></a></td>
				  <td><a href="<?php echo base_url().'accounts/update_liason'; ?>?ID=<?php echo $vl['ID']; ?>">EDIT</td>
                  
                 
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