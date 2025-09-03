 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	  <div class="card-action"><h3>Procedure Form Relationship</h3></div>
	   
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'procedures/form_relationship'; ?>" method="get">
		    <div class="col-sm-3" style="margin-top: 20px;">
            	<a href="<?php echo base_url('procedures/Form-Relation'); ?>" style="text-decoration: none;">
                <button name="export-form" type="submit"  class="btn btn-secondary" id="export-form">Export Procedue</button>
               </a>
            	<a href="<?php echo base_url().'procedures/form_relationship'; ?>" style="text-decoration: none;">
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
				  <th>Procedure Name</th>
				  <th>Status</th>
                  <th>Form Name</th>
				  <th>Status</th>
				  <th>Action</th>
				</tr>
              </thead>
              <tbody id="procedure_result">
              <?php 
			 $count=1;
			   foreach($form_relationship_result as $ky => $vl){
                
				$sql = "SELECT * FROM hms_procedures WHERE ID=".$vl['procedure_id']."";
				$select_result = run_select_query($sql);

				$sql2 = "SELECT * FROM hms_procedure_forms WHERE ID=".$vl['form_id']."";
				$select_result2 = run_select_query($sql2);				
				?> 
               
			   <tr>
					<td><?php echo $select_result['procedure_name']; ?></td>
					<td><?php echo $select_result['status']; ?></td>
					<td><?php echo $select_result2['form_name']; ?></td>
					<td><?php echo $select_result2['status']; ?></td>
					<td><a href="<?php echo base_url();?>procedures/edit?id=<?php echo $vl['procedure_id']; ?>" class="edit"><i class="material-icons">edit</i></a></td>
				
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
      <!--End Advanced Tables -->
    </div>
	
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