<?php 
	/*var_dump($billing_data);
	var_dump($patient_data);die;*/
	$all_method =&get_instance();
?>
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="update_patient_reconcile" />
    <input type="hidden" name="receipt_number" value="<?php echo $billing_data['receipt_number']; ?>" />
    <input type="hidden" name="type" value="<?php echo $_GET['t']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Patient reconcile</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">IIC ID</label>
              <p><?php echo $patient_data['patient_id']; ?></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Wife name</label>
              <p><?php echo $patient_data['wife_name']; ?></p>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Wife number</label>
			  <p><?php echo $patient_data['patient_phone']; ?></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Wife email</label>
   			  <p><?php echo $patient_data['wife_email']; ?></p>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Balance</label>
			  <p><?php echo $billing_data['remaining_amount']; ?></p>
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