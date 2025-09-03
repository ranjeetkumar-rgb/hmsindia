 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
       <!--Consultation  Tables -->
    	  <div class="card">
        <div class="card-action"><h3>Investigation Pending Billing Receipt</h3></div>
        <div class="clearfix"></div>
        <form action="<?php echo base_url().'billing_noreceipt_investigation'; ?>" method="get">
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
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Receipt Number </label>
                <input type="text" class="form-control" id="receipt_number" name="receipt_number" value="<?php echo $receipt_number;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'billing_noreceipt_investigation'; ?>" style="text-decoration: none;">
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
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>On Date</th>
                  <th>Receipt Number</th>
                  <th>Fees</th>
                  <th>Payment Method</th>
                  <th>Billing Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php foreach($investigation_billing_noreceipt as $ky => $vl){ //var_dump($patient_name);die;  ?>
                <tr class="odd gradeX">
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  strtoupper($patient_name); ?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=procedure"><?php echo $vl['receipt_number']?></a></td>
                  <td><?php echo $vl['fees']?></td>
                  <td><?php echo strtoupper($vl['payment_method']); ?></td>
                  <td>Procedure</td>
                  <td><a href="<?php echo base_url('upload-receipt/'.$vl['patient_id'].'/'.$vl['receipt_number'].'/patient_procedure/'.$vl['payment_method'].'/'.$vl['ID']); ?>" class="btn btn-primary">Upload Receipt</a></td>
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
	