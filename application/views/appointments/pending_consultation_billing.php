  <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
	<div class="card">
	 <div class="card-action"><h3> Pending Appointment Billings </h3></div>
    <div class="card-action">
        
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'pending-consultation-billing'; ?>" method="get">
		   
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Wife Name </label>
                <input type="text" class="form-control" id="wife_name" name="wife_name" value="<?php echo $wife_name;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'pending-consultation-billing'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>
        </div>
         <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">

              <thead>

                <tr>

				  <th>S. No.</th>
                  <th>Patient Name</th>
                  <th>Doctor</th>
                  <th>Date</th>
                  <th>Slot</th>
                  <th>Reason of visit</th>
                  <th>Action</th>
                </tr>

              </thead>

              <tbody id="investigate_result">

              <?php $count=1; foreach($investigate_result as $ky => $vl){

                            $patient_data = get_patient_detail($vl['patient_id']);

              ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td>
                  	<?php if($vl['paitent_type'] == 'exist_patient'){?>
	                  	<a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $vl['paitent_id'];?>"><?php echo strtoupper($vl['wife_name']); ?></a>
                    <?php } else {?>
                    	<?php echo strtoupper($vl['wife_name']); ?>
                    <?php } ?>
                  </td>

                  <td>Dr. <?php echo $all_method->doctor_name($vl['appoitmented_doctor']); ?></td>
				  
				  <td><?php echo $vl['appoitmented_date']?></td>			  
				  <td><?php echo $vl['appoitmented_slot']?></td>
                  <td><?php echo $vl['reason_of_visit']?></td>
                 <td class="appint_td_<?php echo $vl['ID']?>">
				  		<div class="appoint_<?php echo $vl['ID']?>">
							<a href="<?php echo base_url('consultation/'.$vl['ID']); ?>" class="btn btn-primary" id="billing_link_<?php echo $vl['ID']?>">Consultation billing</a>
						</div>
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