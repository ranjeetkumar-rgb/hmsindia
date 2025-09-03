 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Semen Analysis</h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'patients/embryo_semen_analysis'; ?>" method="get">
		     <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by IIC ID </label>
                <input type="text" class="form-control" id="iic_id" name="iic_id">
            </div>
			<div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'patients/embryo_semen_analysis'; ?>" style="text-decoration: none;">
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
                  <th>Updated AT</th>
				  <th>Action</th>
				</tr>
              </thead>
              <tbody id="semen_analysis_result">
              <?php 
			  $count=1; 
			  foreach($semen_analysis_result as $ky => $vl){
               ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><a href="<?php echo $vl['iic_id']?>"><?php echo $vl['iic_id']?></a></td>
				  <td><?php echo $vl['updated_at']; ?></td>
				  <td><a href="discharge_summary?iic_id=<?php echo $vl['iic_id']?>&discharge=26&id=<?php echo $vl['id']?>">Edit</a></td>
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