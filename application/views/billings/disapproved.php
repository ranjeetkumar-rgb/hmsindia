<?php $all_method =&get_instance(); ?>
<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url();?>billings/disapproved/<?php echo $data['receipt_number']?>?t=<?php echo $_GET['t'];?>" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="update_disapproved_billing" />
    <input type="hidden" name="fees" value="<?php echo $data['fees']; ?>" id="fees" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Disapproved billing</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">IIC ID</label>
              <p><?php echo $data['patient_id']; ?></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Wife name</label>
              <p><?php echo $all_method->get_patient_name($data['patient_id']); ?></p>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Total package</label>
              <p><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $data['totalpackage']; ?></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Discounted package</label>
              <p><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $data['fees']; ?></p>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Balance</label>
              <input value="" id="remaining_amount" name="remaining_amount" readonly="readonly" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Payment done</label>
              <input value="" name="payment_done" id="payment_done" type="text" class="form-control validate" required>
            </div>
          </div>
          
        <div class="clearfix"></div>
        <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />
        </div>
        </p>
      </div>
    </div>
</form>

<script>
	$(document).on('keyup',"#payment_done",function(e) {
		var payment_done = $(this).val();
		var fees = $('#fees').val();
		if(isNaN(payment_done)){
			$(this).val('');
		}
		if(parseFloat(payment_done) > parseFloat(fees)){
			$(this).val('');
		}else{
			$remains = parseFloat(fees) - parseFloat(payment_done);
			$('#remaining_amount').val($remains);
		}
	});
</script>