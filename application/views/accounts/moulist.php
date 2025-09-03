 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Mou List  </h3></div>
       <div class="clearfix"></div>
	    <form action="<?php echo base_url().'accounts/moulist'; ?>" method="get" >
		     <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by status</label>
                <select class="form-control" id="status" name="status">
                	<option value=''>--Select From--</option>
					<option value='Active'>Active</option>
					<option value='Terminated'>Terminated</option>
					<option value='Due for Renewal'>Due for Renewal</option>
					<option value='Expired'>Expired</option>
                   
                </select>
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Party Name</label>
              <input type="text" class="form-control" id="party_name" name="party_name" value="<?php echo $party_name;?>" />
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
            	<a href="<?php echo base_url().'accounts/moulist'; ?>" style="text-decoration: none;">
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
				  <th>File ID</th>
                  <th>Status</th>
                  <th>Start Date</th>
                  <th>Validity</th>
                  <th>End / Renewal Date</th>
                  <th>Party Name</th>
                  <th>Authorized Person</th>
				  <th>Purpose</th>
                  <th>Document</th>
                  <th>Remarks</th>
				</tr>
              </thead>
              <tbody id="procedure_result">
              <?php 
			  $count=1; 
			  foreach($procedure_result as $ky => $vl){
               ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><?php echo $vl['file_id']?></td>
                  <td><?php echo $vl['status']?></td>
                  <td><?php echo $vl['start_date']?></td>
                  <td><?php echo $vl['valdity']?></td>
                  <td><?php echo $vl['renwal_date']?></td>
                  <td><?php echo $vl['party_name']?></td>
				  <td><?php echo $vl['authorized_person']?></td>
				  <td><?php echo $vl['purpose']?></td>
                  <td><object data="<?php echo $vl['transaction_img']; ?>" type="application/pdf" width="80" height="80"></td>
				  
				  <td><a href="<?php echo base_url().'accounts/update_mou'; ?>?ID=<?php echo $vl['ID']; ?>">EDIT</a><br/><a href="<?php echo $vl['transaction_img']; ?>" target="_blank" >Download</a></td>
                  
                 
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