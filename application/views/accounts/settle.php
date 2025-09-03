<?php $all_method =&get_instance(); ?>
<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url();?>/accounts/add_settle" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="add_settle" />
    <input type="hidden" id="max_amount" value="<?php echo $_GET['a'];?>" />    
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Settle</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">IIC ID</label>
              <input value="<?php echo $patient_id?>" placeholder="IIC ID" readonly="readonly" id="patient_id" name="patient_id" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Transaction ID(Required)</label>
              <input value="" placeholder="Transaction ID" id="transaction_id" name="transaction_id" type="text" class="form-control validate" required>
              <input type="file" name="transaction_img" id="transaction_img" class="form-control validate" required  />
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12 role">
              <label for="company">Settle to</label>
              <select name="payment_to" id="payment_to" required>
                   		<option value="">Select</option>
                    <?php $center_list = $all_method->get_center_list($patient_id); if(isset($_GET['p']) && $_GET['p'] == 'iic'){ ?>
                    	<option value="IndiaIVF">IndiaIVF</option>
                    <?php }else{ ?>
                    <?php if(!empty($center_list)){
							foreach($center_list as $key=>$val){
								$center_name = $all_method->get_center_name($val['billing_at']);//var_dump($center_name);die; ?>
								<option value="<?php echo $val['billing_at']; ?>"><?php echo $center_name; ?></option>	
					<?php }  } }?>
             </select>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Payment done <span class="error">(Maximum amount Rs.<?php echo $_GET['a'];?>)</span></label>
              <input value="" id="payment_done" name="payment_done" type="text" class="form-control validate" required>
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
	var max_amount = $('#max_amount').val();
	var payment_done = $(this).val();
	if(parseFloat(payment_done) > parseFloat(max_amount)){
		$(this).val('');
	}
});
</script>