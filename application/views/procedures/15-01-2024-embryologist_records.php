 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Embryologist records</h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'procedures/embryologist_records'; ?>" method="get">
		    <div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'procedures/embryologist_records'; ?>" style="text-decoration: none;">
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
                  <th>S. No.</th>
                  <th>IIC ID</th>
				  <th>Patient Name</th>
				  <th>Date</th>
                  <th>Reports</th>
                </tr>
              </thead>

       	   <tbody id="embryologist_result">
                <?php 
			      $count=1; foreach($embryologist_result as $ky => $vl){
				  $patient_data = get_patient_detail($vl['patient_id']);
                  $appointment_details = doctor_appointment($vl['appointment_id']);
                ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>" target="_blank"><?php echo $vl['patient_id'];?></a></td>
                  <td><?php echo $patient_data['wife_name']; ?></td>
				  <td><?php echo $appointment_details['appoitmented_date']?></td>
				  <td><a target="_blank" class="btn btn-primary" href="<?php echo base_url()?>procedure_reports/<?php echo $vl['appointment_id'];?>">Procedure Report</a></td>
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