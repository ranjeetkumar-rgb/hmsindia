  <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="row card" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Registation Patients </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'billings/registation_billings'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'billings/registation_billings'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('billings/Registion-Patients'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
               </a>
            </div>	    
            </form>
         <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">

             <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Receipt number</th>
                  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Discounted package</th>
                  <th data-field="date">On Date</th>
                  <th>Status</th>
                </tr>
              </thead>

              <tbody id="investigate_result">

              <?php $count=1; foreach($registation_result as $ky => $vl){

                            $patient_data = get_patient_detail($vl['patient_id']);
              ?>

                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=registation"><?php echo $vl['receipt_number']?></a></td>
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php echo $patient_name = $all_method->get_patient_name($vl['patient_id']); ?></td>
                  <td><?php echo $vl['fees']?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo ucwords($vl['status']); if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>'; ?> <a href="<?php echo base_url();?>billings/disapproved/<?php echo $vl['receipt_number']; ?>?t=consultation" class="btn btn-large">edit billing</a><?php }?></td>
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

       <!--End Investigation Tables -->
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