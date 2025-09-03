<style type="text/css">
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
		border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
	.heading{margin-bottom:10px;margin-top: 0; padding-top:0px;}
</style>
<?php
	$all_method =&get_instance();
 	//var_dump($data);die;
	$details = unserialize($data['data']);
	$details = $details['data'];
	//var_dump($details);die;
?>
<form class="col-sm-12 col-xs-12" id="procedure_form" method="post" action="<?php echo base_url();?>accounts/bill_procedure" novalidate>
  <input type="hidden" name="action" value="bill_procedure" />
  <input type="hidden" name="patient_id" value="<?php echo $data['patient_id']?>" />
  <input type="hidden" name="reason_of_visit" value="<?php echo $data['reason_of_visit']?>" />
  <input type="hidden" name="request" value="<?php echo $request; ?>" />
  <?php if(isset($_SESSION['logged_accountant'])){ ?><input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_accountant']['center']?>" /><?php }else{ ?>
  	   <input type="hidden" name="billing_at" value="IndiaIVF" /><?php } ?>
  <textarea name="data" style="display:none;"><?php echo $data['data']; ?></textarea>
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details">
      <div class="panel-heading">
        <h3 class="heading">Procedure Billing</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
        	<div class="procedure_lists col-sm-4 col-xs-12 col-md-4 role pull-right">
            	<label>Procedure</label>
                 <input type="hidden" name="procedure_parent" value="<?php echo $data['procedure_parent']; ?>" />
                 <p><?php $procd = $all_method->get_procedure_name($data['procedure_parent']);  echo $procd; ?></p>
            </div>
            <div class="clearfix"></div>
            <hr />	
            <div id="main_div" >
            	<?php if(count($details['medicine']) > 0) { ?>
               		 <section class="col-sm-12 col-xs-12 medicine_section">
                          <h4 class="heading">Patient Medicines</h4>
                          <div class="clearfix"></div>
                          <table>
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Medicine</th>
                                    <th>Quantity</th>
                                    <th>Company</th>
                                    <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                                </tr>
                            </thead>
                            <tbody id="medicine_table_body">
                                <?php $medicine_sub_total = 0; foreach($details['medicine'] as $ky => $vls){ //var_dump($vls);die;?>
                                		<tr>
                                        	<td><?php echo $vls['medicine_serial']?></td>
                                        	<td><?php $item = $all_method->get_item_name($vls['medicine_name']);  echo $item ; ?></td>
                                        	<td><?php echo $vls['medicine_quantity']?></td>
                                        	<td><?php echo $vls['medicine_company']?></td>
                                        	<td><?php echo $vls['medicine_price']?></td>
                                        </tr>
                                <?php $medicine_sub_total += $vls['medicine_price']; } ?>
                            </tbody>
                        </table>
                        <div class="col-sm-12 col-xs-12 medicine_amount_div">
                            <div class="col-sm-4 col-xs-12"><label>Sub Total</label> <input placeholder="Sub Total" readonly="readonly" type="text" name="medicine_sub_total" value="<?php echo $medicine_sub_total; ?>" id="medicine_sub_total" /> </div>
                            <div class="col-sm-4 col-xs-12"><label>Discount(%)</label> <input placeholder="Discount" type="text" name="medicine_discount" value="" id="medicine_discount" /> </div>
                            <div class="col-sm-4 col-xs-12"><label>Total</label> <input placeholder="Total" readonly="readonly" type="text" name="medicine_total" value="<?php echo $medicine_sub_total; ?>" id="medicine_total" /> </div>
                        </div>
                </section>
            	     <div class="clearfix"></div>
            	     <hr />
                <?php } ?>
                <?php if(count($details['injections']) > 0) { ?>
		               <section class="col-sm-12 col-xs-12 injections_section">
                  <h4 class="heading">Patient Injections</h4>
                  <div class="clearfix"></div>
                  <table>
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Injections</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="injections_table_body">
                        <?php $injections_sub_total = 0; foreach($details['injections'] as $ky => $vls){// var_dump($vls);die;?>
                                		<tr>
                                        	<td><?php echo $vls['injections_serial']?></td>
                                        	<td><?php $item = $all_method->get_item_name($vls['injections_name']);  echo $item ; ?></td>
                                        	<td><?php echo $vls['injections_quantity']?></td>
                                        	<td><?php echo $vls['injections_company']?></td>
                                        	<td><?php echo $vls['injections_price']?></td>
                                        </tr>
                       <?php $injections_sub_total += $vls['injections_price']; } ?>
                    </tbody>
                </table>
                <div class="col-sm-12 col-xs-12 medicine_amount_div">
                    <div class="col-sm-4 col-xs-12"><label>Sub Total</label> <input placeholder="Sub Total" readonly="readonly" type="text" name="injections_sub_total" value="<?php echo $injections_sub_total; ?>" id="injections_sub_total" /> </div>
                    <div class="col-sm-4 col-xs-12"><label>Discount(%)</label> <input placeholder="Discount" type="text" name="injections_discount" value="" id="injections_discount" /> </div>
                    <div class="col-sm-4 col-xs-12"><label>Total</label> <input placeholder="Total" readonly="readonly" type="text" name="injections_total" value="<?php echo $injections_sub_total; ?>" id="injections_total" /> </div>
                </div>
                </section>
        		       <div class="clearfix"></div>
                	   <hr />
                <?php } ?>
                <?php if(count($details['consumables']) > 0) { ?>
              		  <section class="col-sm-12 col-xs-12 consumables_section">
                  <h4 class="heading">Patient Consumables</h4>
                  <div class="clearfix"></div>
                  <table>
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Consumable</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="consumables_table_body">
                        <?php $consumables_sub_total = 0; foreach($details['consumables'] as $ky => $vls){ //var_dump($vls);die;?>
                                		<tr>
                                        	<td><?php echo $vls['consumables_serial']?></td>
                                        	<td><?php $item = $all_method->get_item_name($vls['consumables_name']);  echo $item ; ?></td>
                                        	<td><?php echo $vls['consumables_quantity']?></td>
                                        	<td><?php echo $vls['consumables_company']?></td>
                                        	<td><?php echo $vls['consumables_price']?></td>
                                        </tr>
                       <?php $consumables_sub_total += $vls['consumables_price']; } ?>
                    </tbody>
                </table>
                <div class="col-sm-12 col-xs-12 medicine_amount_div">
                    <div class="col-sm-4 col-xs-12"><label>Sub Total</label> <input placeholder="Sub Total" readonly="readonly" type="text" name="consumables_sub_total" value="<?php echo $consumables_sub_total; ?>" id="consumables_sub_total" /> </div>
                    <div class="col-sm-4 col-xs-12"><label>Discount(%)</label> <input placeholder="Discount" type="text" name="consumables_discount" value="" id="consumables_discount" /> </div>
                    <div class="col-sm-4 col-xs-12"><label>Total</label> <input placeholder="Total" readonly="readonly" type="text" name="consumables_total" value="<?php echo $consumables_sub_total; ?>" id="consumables_total" /> </div>
                </div>
                </section>
             		  <div class="clearfix"></div>
             		  <hr />
                <?php } ?>
                <?php if(count($details['sub_procedure']) > 0) { ?>
                <section class="col-sm-12 col-xs-12 sub_procedures_section">
                  <h4 class="heading">Patient Procedure</h4>
                  <div class="clearfix"></div>
                  <table>
                    <thead>
                        <tr>
                            <th>Procedure</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="sub_procedures_table_body">
                         <?php $sub_procedures_sub_total = 0; foreach($details['sub_procedure'] as $ky => $vls){ //var_dump($vls);die;?>
                        <tr>
                            <td><?php $item = $all_method->get_procedure_name($vls['sub_procedure']);  echo $item ; ?></td>
                            <td><?php echo $vls['sub_procedures_price']?></td>
                        </tr>
                       <?php $sub_procedures_sub_total += $vls['sub_procedures_price']; } ?>
                    </tbody>
                </table>
                <div class="col-sm-12 col-xs-12 medicine_amount_div">
                    <div class="col-sm-4 col-xs-12"><label>Sub Total</label> <input placeholder="Sub Total" readonly="readonly" type="text" name="sub_procedures_sub_total" value="<?php echo $sub_procedures_sub_total; ?>" id="sub_procedures_sub_total" /> </div>
                    <div class="col-sm-4 col-xs-12"><label>Discount(%)</label> <input placeholder="Discount" type="text" name="sub_procedures_discount" value="" id="sub_procedures_discount" /> </div>
                    <div class="col-sm-4 col-xs-12"><label>Total</label> <input placeholder="Total" readonly="readonly" type="text" name="sub_procedures_total" value="<?php echo $sub_procedures_sub_total; ?>" id="sub_procedures_total" /> </div>
                </div>
                </section>
                <div class="clearfix"></div>
                <hr />
                 <?php } ?>
                <div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Receipt number (Required)</label>
                        <input value="<?php echo getGUID(); ?>" placeholder="Receipt number" readonly="readonly" id="receipt_number" name="receipt_number" type="text" class="form-control validate" required>
                   </div>
                   
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Procedure fees (Required)</label>
                        <input value="" placeholder="Investigation fees" readonly="readonly" class="dhee" id="fees" name="fees" type="text" class="form-control validate" required>
                   </div>
                 </div>
         
        		<div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Payment received (Required)</label>
                        <input value="" placeholder="Payment received" id="payment_done" name="payment_done" type="number" class="form-control validate" required>
                   </div>
                   
                   <div class="form-group col-sm-6 col-xs-12">
                       <label for="item_name">Remaining amount (Required)</label>
                       <input value="" placeholder="Remaining amount" readonly="readonly" id="remaining_amount" name="remaining_amount" type="text" class="form-control validate" required>
                   </div>
                 </div>        
        
		        <div class="row">            
                   <div class="form-group col-sm-6 col-xs-12 role">
                        <label for="statuss">Payment mode (Required)</label>
                        <select name="payment_method" id="payment_method" required>
                            <option value="">Select</option>
                            <option value="neft" mode="NEFT">NEFT</option>
                            <option value="rtgs" mode="RTGS">RTGS</option>
                            <option value="cash" mode="Cash">Cash</option>
                            <option value="card" mode="Card">Card</option>
                            <option value="insurance" mode="Insurance">Insurance</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12" id="transaction" style="display:none;">
                       <label for="item_name">Transaction ID (Required)</label>
                       <input value="" placeholder="Transaction ID" id="transaction_id" name="transaction_id" type="text" class="form-control validate" required>
                    </div>
                 </div>
                
                <div class="row">
                    <div class="form-group col-sm-6 col-xs-12">
                       <label for="item_name">Billing ID</label>
                       <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control validate">
                    </div>
                    <div class="form-group col-sm-6 col-xs-12">
                       <label for="item_name">Procedure ID</label>
                       <input value="" placeholder="Procedure ID" id="procedure_id" name="procedure_id" type="text" class="form-control validate">
                    </div>
               </div>
               
               <div class="row">            
                   <div class="form-group col-sm-6 col-xs-12 role">
                        <label for="statuss">Billing From (Required)</label>
                        <select name="billing_from" required>
                            <option value="">Select</option>
                            <?php if(isset($_SESSION['logged_accountant'])){ $center = $all_method->get_center_name($_SESSION['logged_accountant']['center']); ?>
                                <option value="<?php echo $_SESSION['logged_accountant']['center']; ?>"><?php echo $center; ?></option>
                            <?php } ?>
                            <option value="IndiaIVF">IndiaIVF</option>       
                        </select>
                    </div>
              </div>
                 
                <div class="form-group col-sm-12 col-xs-12">
                	 <input value="<?php echo $_SESSION['logged_accountant']['allow_discount'];?>" id="allow_discount" type="hidden" class="form-control validate" required>
               		 <p id="show_disc_app" style="display:none;">Given discount is more than allowed, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_accountant']['username'];?>" id="get_discount_approval">click here</a> for admin approval.</p>
               
                	<a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
                    <p id="error" class="error delete"></p>
                </div>
            </div>
      </div>
      </p>
    </div>
  </div>
</form>
<input type="text" id="givn_disc" style="display:none" value="0" />
<!--****** MEDICINE SCRIPT *******-->
<script>
	
	 $(document).on('keyup',"#medicine_discount",function(e) {
		$('#medicine_total').empty();
		var fees = $('#medicine_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#medicine_total').val(fees);
		} else {
			if(discount > 100){
				$(this).val('');
				$('#medicine_total').val(fees);
			}else{
				var remaining_amount = calculate_discount(discount, fees);
				$('#medicine_total').val(remaining_amount);
			}
		}
		calculate_fees();
    });
	
</script>
<!--****** MEDICINE SCRIPT *******-->

<!--****** Injections SCRIPT *******-->
<script>
	$(document).on('keyup',"#injections_discount",function(e) {
		$('#injections_total').empty();
		var fees = $('#injections_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#injections_total').val(fees);
		} else {
			if(discount > 100){
				$(this).val('');
				$('#injections_total').val(fees);
			}else{
				var remaining_amount = calculate_discount(discount, fees);
				$('#injections_total').val(remaining_amount);
			}
		}
		calculate_fees();
    });
	
</script>
<!--****** Injections SCRIPT *******-->

<!--****** consumables SCRIPT *******-->
<script>
	
	$(document).on('keyup',"#consumables_discount",function(e) {
		$('#consumables_total').empty();
		var fees = $('#consumables_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#consumables_total').val(fees);
		} else {
			if(discount > 100){
				$(this).val('');
				$('#consumables_total').val(fees);
			}else{
				var remaining_amount = calculate_discount(discount, fees);
				$('#consumables_total').val(remaining_amount);
			}
		}
		calculate_fees();
    });
</script>
<!--****** consumables SCRIPT *******-->

<!--****** Procedures SCRIPT *******-->
<script>
	
	$(document).on('keyup',"#sub_procedures_discount",function(e) {
		$('#sub_procedures_total').empty();
		var fees = $('#sub_procedures_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#sub_procedures_total').val(fees);
		} else {
			if(discount > 100){
				$(this).val('');
				$('#sub_procedures_total').val(fees);
			}else{
				var remaining_amount = calculate_discount(discount, fees);
				$('#sub_procedures_total').val(remaining_amount);
			}
		}
		calculate_fees();
    });

</script>
<!--****** Procedures SCRIPT *******-->

<!--****** Billing SCRIPT *******-->
<script>
	$(document).on('click',"#create_billing",function(e) {
       $('#error').empty();
	   var has_empty = false;
	   var payment_done = $('#payment_done').val();
	   var payment_method = $('#payment_method').val();
	    var fees = $('#fees').val();
	  	
	   if ( payment_done == '' || payment_method == '' || fees < 1) 
	   {
		   $('#error').append('One or more fields are empty!');
	   }else{
	   		 make_billing();
	   }
    });
	
	
function make_billing() {
	$('#msg_area').empty();
	
	var method = $('#payment_method').find(':selected').attr('mode');
		
	 if(method != 'Cash'){
		var transaction_id = $('#transaction_id').val();
		if(transaction_id == ''){
			$('#msg_area').append('One or more fields are empty !')
		}else{
			$('#procedure_form').submit();	
		}
	}else{
		$('#procedure_form').submit();
	 }
}
</script>
<!--****** Billing SCRIPT *******-->

<script>
function calculate_fees(){
	
	$('#payment_done').val('');
	var medicine_total = ($('#medicine_total').val())?$('#medicine_total').val():0;
	var injections_total = ($('#injections_total').val())?$('#injections_total').val():0;
	var consumables_total = ($('#consumables_total').val())?$('#consumables_total').val():0;
	var sub_procedures_total = ($('#sub_procedures_total').val())?$('#sub_procedures_total').val():0;
	
	
	var total_fees = 0;
	total_fees += +medicine_total;
	total_fees += +injections_total;
	total_fees += +consumables_total;
	total_fees += +sub_procedures_total;
	console.log(parseFloat(total_fees));
	if (isNaN(total_fees)) {
		$('#fees').val(parseInt(0));
		$('#remaining_amount').val(parseInt(0));
	} else {
		$('#fees').val(parseInt(total_fees));
		$('#remaining_amount').val(parseInt(total_fees));
	}
		
   var allowd = parseFloat($('#allow_discount').val());
   var given_discount = parseFloat(($('#medicine_discount').val())?$('#medicine_discount').val():0)+parseFloat(($('#injections_discount').val())?$('#injections_discount').val():0)+parseFloat(($('#consumables_discount').val())?$('#consumables_discount').val():0)+parseFloat(($('#sub_procedures_discount').val())?$('#sub_procedures_discount').val():0);
   console.log(allowd +'----'+parseFloat(given_discount));
   $('#givn_disc').empty();
   $('#givn_disc').val(parseFloat(given_discount));
   if(given_discount > allowd){
   		$('#create_billing').hide();
		$('#show_disc_app').show();
   }else{
		$('#show_disc_app').hide();
   		$('#create_billing').show();	
   }
}
calculate_fees();
$(document).on('keyup',"#payment_done",function(e) {
	$('#remaining_amount').empty();
	var fees = $('.dhee').val();
	var payment_done = $(this).val();
	var remaining_amount = fees-payment_done;
	if(remaining_amount < 0){
		$('#payment_done').val('');
		$('#remaining_amount').val('');
	}
	else{
		$('#remaining_amount').val(remaining_amount);
	}
});
    $(document).on('change',"#payment_method",function(e) {
        $('#transaction_id').empty();
		var method = $(this).val();
		if(method == 'cash'){
			 $('#transaction_id').prop('required',false);
			 $('#transaction').hide();		
		}else{
			 $('#transaction_id').prop('required',true);
			 $('#transaction').show();
		}
		
    });
	
function calculate_discount(discount, total){
	var fees = parseFloat(total);
	var discount_amount = parseFloat(discount);
	discount_amount = (discount_amount)?discount_amount:0;
	
	var listPrice = parseFloat(fees);
	var discount  = parseFloat(discount_amount);
	return (listPrice - ( listPrice * discount / 100 ));
}
</script>