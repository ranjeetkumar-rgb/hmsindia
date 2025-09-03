 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
       <!--Consultation  Tables -->
    	  <div class="card">
        <div class="card-action"><h3>Partial Consultations</h3></div>
		<div class="clearfix"></div>
        <form action="<?php echo base_url().'partial-consultation'; ?>" method="get">
		  <!-- <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php // echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php // echo $end_date;?>" />
            </div>-->
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Name </label>
                <input type="text" class="form-control" id="wife_name" name="wife_name" value="<?php echo $wife_name;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'partial-consultation'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="">
              <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Patient Name</th>
                  <th>Doctor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($partial_consultation_billing as $ky => $vl){ // echo $vl->patient_id;  ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td>
                  		<?php $patient_data = get_patient_detail($vl['patient_id']);?>
	                  	<a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $vl['patient_id'];?>"><?php echo  strtoupper($patient_data['wife_name']); ?> (<?php echo $vl['patient_id'];?>)</a>
                  </td>
                  <td>Dr. <?php echo $all_method->doctor_name($vl['doctor_id']); ?></td>
                  <td class="appint_td_<?php echo $vl['ID'];?>">
                  	<a href="<?php echo base_url('cancel-partial-consultation/'.$vl['ID']); ?>" class="btn btn-primary" id="billing_link_<?php echo $vl['ID']; ?>">Cancel Partial Consultation</a>
                  </td>
                </tr>
              <?php $count++; } ?>
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
       <!--End Consultation  Tables -->
      
      <!--End Advanced Tables -->
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

