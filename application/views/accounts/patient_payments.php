<?php $all_method =&get_instance(); ?>
<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url();?>/accounts/add_patient_payment" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="add_patient_payment" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Patient payments</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">IIC ID</label>
              <input value="<?php echo $data['patient_id']; ?>" placeholder="IIC ID" readonly="readonly" id="patient_id" name="patient_id" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Wife name</label>
              <input value="<?php echo $data['wife_name']; ?>" readonly="readonly" type="text" class="form-control validate" required>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Wife number</label>
              <input value="<?php echo $data['patient_phone']; ?>" readonly="readonly" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Wife email</label>
              <input value="<?php echo $data['wife_email']; ?>" readonly="readonly" type="text" class="form-control validate" required>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Balance</label>
              <input value="<?php echo $data['current_balance']; ?>" id="current_balance" readonly="readonly" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Payment done</label>
              <input value="" name="payment_done" id="payment_done" type="text" class="form-control validate" required>
            </div>
          </div>
          
          <div class="row">
             <div class="form-group col-sm-6 col-xs-12 role">
                        <label for="statuss">Payment mode (Required)</label>
                        <select name="payment_method" id="payment_method" required>
                            <option value="">Select</option>
                            <option value="neft" mode="NEFT">NEFT</option>
                            <option value="rtgs" mode="RTGS">RTGS</option>
                            <option value="upi" mode="UPI">UPI</option>
                            <option value="cash" mode="Cash">Cash</option>
                            <option value="card" mode="Card">Card</option>
                            <option value="insurance" mode="Insurance">Insurance</option>
                            <option value="international_card" mode="International Card">International Card</option>
                        </select>
              </div>
                    
                    <div class="form-group col-sm-6 col-xs-12" id="transaction" style="display:none;">
                       <label for="item_name">Transaction ID (Required)</label>
                       <input value="" placeholder="Transaction ID" id="transaction_id" name="transaction_id" type="text" class="form-control validate" required>
                       <input type="file" name="transaction_img" id="transaction_img"  />
                    </div>
          </div>
          
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Billing source (Required)</label>
                <select name="billing_from" id="billing_from" required>
                    <option value="">Select</option>
                    <?php if(isset($_SESSION['logged_accountant'])){ $center = $all_method->get_center(); ?>
                    	<option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                    <?php } ?>
                    <option value="IndiaIVF">IndiaIVF</option>       
                </select>
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
    $(document).on('change',"#payment_method",function(e) {
        $('#transaction_id').empty();
		var method = $(this).val();
		if(method == 'cash' || method == ''){
			 $('#transaction_id').prop('required',false);
			 $('#transaction_img').prop('required',false);
			 $('#transaction').hide();		
		}else{
			 $('#transaction_id').prop('required',true);
			 $('#transaction_img').prop('required',true);
			 $('#transaction').show();
		}
    });
	
	$(document).on('keyup',"#payment_done",function(e) {
		var payment_done = $(this).val();
		var current_balance = $('#current_balance').val();
		if(isNaN(payment_done)){
			$(this).val('');
		}
		if(parseFloat(payment_done) > parseFloat(current_balance)){
			$(this).val('');
		}		
	});
</script>