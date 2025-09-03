<?php $all_method =&get_instance();
  $patient_data = get_patient_detail($patient_id);
 // var_dump($patient_data);die;
?>
<div class="col-md-12">
<div class="card">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
  <div class="card-action"><h3>Upload Billing Receipt</h3></div>
  <div class="clearfix"></div>
  <div class="card-content">
    <div class="table-responsive">
      <form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data" >
        <input type="hidden" name="action" value="upload_receipt" />
        <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
        <input type="hidden" id="receipt_number" name="receipt_number" value="<?php echo $receipt_number;?>" />
        <input type="hidden" id="billing_type" name="billing_type" value="<?php echo $billing_type;?>" />
        <input type="hidden" id="payment_method" name="payment_method" value="<?php echo $payment_method;?>" />
        <input type="hidden" id="record_id" name="record_id" value="<?php echo $record_id;?>" />

        <?php $receipt_link = "consultation";
          if($billing_type == "patient_investigations"){
            $receipt_link = "investigation";
          }if($billing_type == "patient_procedure"){
            $receipt_link = "procedure";
          }
        ?>

            <div class="row">
              <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Patient ID</label>
                <p><?php echo $patient_id;?></p>
              </div>
              
              <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt Number</label>
                <p><a target="_blank" href="<?php echo base_url(); ?>accounts/details/<?php echo $receipt_number; ?>?t=<?php echo $receipt_link; ?>"><?php echo $receipt_number; ?></a></p>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Billing Type</label>
                <p><?php echo strtoupper(str_replace('_', " ", $billing_type));?></p>
              </div>
              
              <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment Method</label>
                <p><?php echo strtoupper($payment_method);?></p>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-sm-6 col-xs-12" id="transaction">
                <label for="item_name">Reference no. (Required)</label>
                <input value="" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control validate" required>
                <label>Upload screenshot/document here (Required)</label>
                <input type="file" name="transaction_img" id="transaction_img" required />
              </div>
            </div>
                
            <div class="clearfix"></div>
            <div class="form-group col-sm-12 col-xs-12">
                <input type="submit" id="submitbutton" class="btn btn-large" value="Upload Receipt" />
            </div>
      </form>
    </div>
  </div>
</div>
</div>
