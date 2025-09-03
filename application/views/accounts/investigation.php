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
</style>
<?php
	$all_method =&get_instance();
 //var_dump($data);die;
	$details = unserialize($data['data']);
//var_dump($details);die;
?>
<form class="col-sm-12 col-xs-12" method="post" id="billing_form" action="<?php echo base_url();?>accounts/bill_investigation" >
  <input type="hidden" name="action" value="bill_investigation" />
  <input type="hidden" name="patient_id" value="<?php echo $data['patient_id']?>" />
  <input type="hidden" name="reason_of_visit" value="<?php echo $data['reason_of_visit']?>" />
  <input type="hidden" name="request" value="<?php echo $request; ?>" />
  <?php if(isset($_SESSION['logged_accountant'])){ ?><input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_accountant']['center']?>" /><?php }else{ ?>
  	   <input type="hidden" name="billing_at" value="IndiaIVF" /><?php } ?>
  <textarea name="investigations" style="display:none;"><?php echo $data['data']; ?></textarea>
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      <div class="panel-heading">
        <h3 class="heading">Investigation Billing</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
               <label for="item_name">Paramedic Name (Required)</label>
                <input value="" placeholder="Paramedic Name" id="paramedic_name" name="paramedic_name" type="text" class="form-control validate" required>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date(Required)</label>
                <input value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Date" readonly="readonly" id="on_date" name="on_date" type="text" class="form-control validate" required>
           </div>
         </div>
         
         
         <div class="row invastigatiton_table">
              <table>
                <thead>
                    <tr>
                        <th>Investigations</th>
                        <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                    </tr>
                </thead>
                <tbody id="investigation_table_body">
                	<?php $counts = count($details)/2;
						$total_fees = 0;
						for($i=1; $i <= $counts; $i++){
						?>
                        <tr>
                            <td class="role"><?php $investig = $all_method->get_investigation_name($details['investigation_name_'.$i]); echo $investig; ?></td>
                            <td><?php echo $details['investigation_price_'.$i]?></td>
                        </tr>
                   <?php $total_fees += $details['investigation_price_'.$i]; } ?>
                </tbody>
            </table>
         </div>
         
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <input value="<?php echo getGUID(); ?>" placeholder="Receipt number" readonly="readonly" id="receipt_number" name="receipt_number" type="text" class="form-control validate" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Invastigation fees (Required)</label>
                <input value="<?php echo $total_fees; ?>" placeholder="Investigation fees" readonly="readonly" class="dhee" id="fees" name="fees" type="hidden" class="form-control validate" required>
                <input value="<?php echo $total_fees; ?>" placeholder="Investigation fees" readonly="readonly" id="after_discount" type="text" class="form-control validate" required>
           </div>
         </div>
         
         <div class="row">            
         	<div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Discount(%) </label>
               <input value="" placeholder="Discount (%)" id="discount_amount" name="discount_amount" type="text" class="form-control validate" required>
               <input value="<?php echo $_SESSION['logged_accountant']['allow_discount'];?>" id="allow_discount" type="hidden" class="form-control validate" required>
               <p id="show_disc_app" style="display:none;">Given discount is more than allowed, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_accountant']['username'];?>" id="get_discount_approval">click here</a> for admin approval.</p>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment received (Required)</label>
                <input value="" placeholder="Payment received" id="payment_done" name="payment_done" type="number" class="form-control validate" required>
           </div>
         </div>   
         
         <div class="row">
           <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Remaining amount (Required)</label>
               <input value="" placeholder="Remaining amount" readonly="readonly" id="remaining_amount" name="remaining_amount" type="text" class="form-control validate" required>
           </div>
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
         </div>        
        
        <div class="row">
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
               <label for="item_name">Investigation ID</label>
               <input value="" placeholder="Investigation ID" id="investigation_id" name="investigation_id" type="text" class="form-control validate">
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
         
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
            <a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
         </div>
      </div>
      </p>
    </div>
    
  </div>
</form>
<input type="text" id="givn_disc" style="display:none" value="0" />
<script type="text/javascript">
    $(document).on('change',"#payment_method",function(e) {
        $('#transaction_id').empty();
		var method = $(this).val();
		if(method == 'cash' || method == ''){
			 $('#transaction_id').prop('required',false);
			 $('#transaction').hide();		
		}else{
			 $('#transaction_id').prop('required',true);
			 $('#transaction').show();
		}
		
    });
	
    $(document).on('keyup',"#payment_done",function(e) {
		$('#remaining_amount').empty();
		var fees = $('#after_discount').val();
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
	
	$(document).on('keyup',"#discount_amount",function(e) {
		$('#payment_done').val('');
		
		var fees = parseFloat($('.dhee').val());
		var allowd = parseFloat($('#allow_discount').val());
		var discount_amount = parseFloat($(this).val());
		discount_amount = (discount_amount)?discount_amount:0;
		
		$('#givn_disc').empty();
   		$('#givn_disc').val(parseFloat(discount_amount));
		
		if(discount_amount > 100){
				$('#after_discount').val('');
				$(this).val('');
				$('#after_discount').val(parseFloat(fees));
				$('#show_disc_app').hide();
				$('#create_billing').show();
		}else{
			if(discount_amount <= allowd){
				$('#show_disc_app').hide();
				$('#create_billing').show();
				var listPrice = parseFloat(fees);
				var discount  = parseFloat(discount_amount);
				var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));
				if(remaining_amount < 1){
					$('#payment_done').val('');
					$('#after_discount').val('');
					$(this).val('');
				}else{
					$('#after_discount').val(remaining_amount);
				}
			}else{
				$('#after_discount').val(parseFloat(fees));
				$('#create_billing').hide();
				$('#show_disc_app').show();
			}
		}
    });
	
	$(document).on('click',"#create_billing",function(e) {
		$('#msg_area').empty();
		
		var payment_done = $('#payment_done').val();
		var payment_method = $('#payment_method').val();
		var paramedic_name =  $('#paramedic_name').val()

		if(payment_method != 'cash'){
				var transaction_id = $('#transaction_id').val();
				if(transaction_id == ''){
					$('#msg_area').append('One or more fields are empty !')
				}else{
					if(payment_done == '' || payment_method == '' || paramedic_name==''){$('#msg_area').append('One or more fields are empty !')}else{
						$('#billing_form').submit();
					}
				}
		}else{
			if(payment_done == '' || payment_method == '' || paramedic_name==''){$('#msg_area').append('One or more fields are empty !')}else{
					$('#billing_form').submit();
			}
		}
    });

</script>