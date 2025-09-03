<?php $all_method =&get_instance(); ?>
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

<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="action" value="add_investigation" />
  <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $session_data['paitent_id']?>" />
  <input type="hidden" name="hospital_id" id="hospital_id" value="<?php echo $session_data['hospital_id']?>" />
  <input type="hidden" name="reason_of_visit" value="<?php echo $session_data['reason_of_visit']?>" />
  <input type="hidden" name="billing_from" value="<?php echo $session_data['billing_from']?>" />
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  <input type="hidden" id="billing_type" value="investigation" />
  <input type="hidden" name="biller_id" value="<?php echo $_SESSION['logged_billing_manager']['employee_number']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      <div class="panel-heading">
        <h3 class="heading">Investigation Details</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
               <label for="item_name">Paramedic Name (Required)</label>
                <input value="" placeholder="Paramedic Name" id="paramedic_name" name="paramedic_name" type="text" class="form-control " required>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date(Required)</label>
                <input value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Date" readonly="readonly" id="on_date" name="on_date" type="text" class="form-control " required>
           </div>
         </div>
         
         
         <div class="row invastigatiton_table">  
         	  <input type="button" class="add-row btn btn-large" value="Add Investigations"> <button type="button" class="delete-row btn btn-large">Delete Investigation</button>
              <table>
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Investigations</th>
                        <th>Code</th>
                        <th>Price</th>
                        <th>Discount amount</th>
                    </tr>
                </thead>
                <tbody id="investigation_table_body">
                    <tr class="investigation_row_1" trcount="1">
                        <td><input type="checkbox" class="statuss" name="record"></td>
                        <td class="role">
	                        <select name="investigation_name_1" class="investigation_select required_value" id="investigation_name_1" count="1" required>
	                            <option value="">Select</option>
                        	<?php foreach($investigations as $key => $val){ $fees = ''; if($session_data['nationality'] == 'indian'){$fees = $val['price'];}else{$fees = $val['usd_price'];} ?>
                            	<option value="<?php echo $val['ID']; ?>" fees="<?php echo $fees; ?>" invest="<?php echo $val['investigation']; ?>"> <?php echo $val['investigation']; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                        <td><input value="" placeholder="Code" readonly="readonly" id="investigation_code_1" class="investigation_code required_value" name="investigation_code_1" type="text" class="form-control " required></td>
                        <td><input value="" placeholder="Price" readonly="readonly" id="investigation_price_1" class="investigation_price required_value" name="investigation_price_1" type="text" class="form-control " required></td>
                        <td><input value="0" placeholder="Discount" id="investigation_discount_1" class="investigation_discount required_value" name="investigation_discount_1" type="text" class="form-control " required></td>
                    </tr>
                </tbody>
            </table>
         </div>
         
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <input value="<?php echo getGUID(); ?>" placeholder="Receipt number" readonly="readonly" id="receipt_number" name="receipt_number" type="text" class="form-control " required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Investigation fees (Required)</label>
                <input value="" name="totalpackage" placeholder="Investigation fees" readonly="readonly" class="dhee" id="fees" type="hidden" class="form-control " required>
                <input value="" placeholder="Investigation fees" readonly="readonly" name="fees" id="after_discount" type="text" class="form-control " required>
           </div>
         </div>
         
         <div class="row">            
         	<div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Discount amount</label>
               <input value="0" placeholder="Discount amount" id="discount_amount" readonly="readonly" name="discount_amount" type="text" class="form-control required_value" required>
               <input value="<?php echo $_SESSION['logged_billing_manager']['allow_discount'];?>" id="allow_discount" type="hidden" class="form-control " required>
               <p id="show_disc_app" style="display:none;">Given discount is more than allowed, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_billing_manager']['username'];?>" id="get_discount_approval">click here</a> for admin approval.</p>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment received (Required)</label>
                <input value="" placeholder="Payment received" id="payment_done" name="payment_done" type="number" class="form-control required_value" required>
           </div>
         </div>   
         
         <div class="row">
           <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Remaining amount (Required)</label>
               <input value="" placeholder="Remaining amount" readonly="readonly" id="remaining_amount" name="remaining_amount" type="text" class="form-control required_value" required>
           </div>
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Payment mode (Required)</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="">Select</option>
                   	<?php if($session_data['nationality'] == 'indian'){?>
               			<option value="neft" mode="NEFT">NEFT</option>
               			<option value="rtgs" mode="RTGS">RTGS</option>
        	       		<option value="card" mode="Card">Card</option>
    	           		<option value="insurance" mode="Insurance">Insurance</option>
                    <?php }else{ ?>
	                    <option value="international_card" mode="International Card">International Card</option>
                    <?php } ?>
                    <option value="cash" mode="Cash">Cash</option>
                    <option value="cheque" mode="Cheque">Cheque</option>                    
                </select>
            </div>
         </div>        
        
        <div class="row">
            <div class="form-group col-sm-6 col-xs-12" id="transaction" style="display:none;">
               <label for="item_name">Reference no. (Required)</label>
               <input value="" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control  required_value" required>
               <label>Upload screenshot/document here</label>
               <input type="file" class="required_value" name="transaction_img" id="transaction_img"  />
            </div>
         </div>
         
         <div class="row">
         <?php if($session_data['billing_from'] != 'IndiaIVF'){?>
            <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Billing ID (Optional)</label>
               <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control ">
            </div>
           <?php } ?>
         </div>
         
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
            <a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
         </div>
      </div>
      </p>
    </div>
    
    <div class="col-sm-12 col-xs-12 panel panel-piluku" style="display:none;" id="consultation_preview">
      <div class="panel-heading">
        <h3 class="heading">Billing Summary</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Paramedic (Required)</label>
                <p id="paramedic_text"></p>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date (Required)</label>
                <p id="on_date_text"><?php echo date("Y-m-d H:i:s"); ?></p>
           </div>
         </div>
         
         <div class="row investigation_preview_table">
              <table>
                <thead>
                    <tr>
                        <th>Investigations</th>
                        <th>Code</th>
                        <th>Price</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody id="investigation_preview_table_body"></tbody>
            </table>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <p id="receipt_number_text"><?php echo getGUID(); ?></p>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Investigation fees (Required)</label>
                <p id="fees_text"></p>
                <p> Discount : <span id="discount_text"></span></p>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment received (Required)</label>
                <p id="payment_done_text"></p>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Remaining amount (Required)</label>
                <p id="remaining_amount_text"></p>
           </div>
         </div>        
        
        <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Payment mode (Required)</label>
                <p id="payment_method_text"></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Transaction ID(Required)</label>
                <p id="transaction_id_text"></p>
            </div>
         </div>
        	
         <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Billing ID</label>
                <p id="billing_id_text"></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                   <label for="item_name">Hospital ID</label>
                    <p id="hospital_id_text"></p>
            </div>
          </div>
          
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
            <a class="btn btn-large" id="edit_billing" href="javascript:void(0);">Edit Billing</a>
            <input type="submit" id="submitbutton" class="btn btn-large" value="Create Billing" />
         </div>
      </div>
      </p>
    </div>
  </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
			var rows = $('#investigation_table_body tr:last').attr('trcount');
			var count = parseFloat(rows) + 1;
			
            var markup = '<tr class="investigation_row_'+count+'" trcount="'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td class="role"><select count="'+count+'" name="investigation_name_'+count+'" class="investigation_select required_value" id="investigation_name_'+count+'" required><option value="">Select</option><?php foreach($investigations as $key => $val){ ?><option value="<?php echo $val['ID']; ?>" fees="<?php $fees = ''; if($session_data['nationality'] == 'indian'){$fees = $val['price'];}else{$fees = $val['usd_price'];} echo $fees; ?>" invest="<?php echo $val['investigation']; ?>"> <?php echo $val['investigation']; ?></option><?php } ?></select></td><td><input value="" placeholder="Code" readonly="readonly" class="investigation_code required_value" id="investigation_code_'+count+'" name="investigation_code_'+count+'" type="text" class="form-control " required></td><td><input value="" placeholder="Price" readonly="readonly" class="investigation_price required_value" id="investigation_price_'+count+'" name="investigation_price_'+count+'" type="text" class="form-control " required></td><td><input value="0" placeholder="Discount" id="investigation_discount_'+count+'" class="investigation_discount required_value" name="investigation_discount_'+count+'" type="text" class="form-control" required></td></tr>';
            $("table tbody#investigation_table_body").append(markup);
			add_delete_method();
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
			add_delete_method();
        });
    });    
	
	function add_delete_method(){
			var fee_total = 0;
			$('.investigation_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			console.log(fee_total);
			$('.dhee').val(parseFloat(fee_total));
			$('#after_discount').val(parseFloat(fee_total));
			$('.investigation_discount').val(parseFloat(0));
			$('#discount_amount').val(parseFloat(0));
			$('#payment_done').val('');
			$('#remaining_amount').val('');			
	}
</script>

<script type="text/javascript">
	$(document).on('keyup',".investigation_discount",function(e) {
			
			var given_discount = 0;
			var count = 1;
			$('.investigation_discount').each(function(){
				var price = $('#investigation_price_'+count).val();
				var discount = $('#investigation_discount_'+count).val();
				<!--var dicount_amount = (price/100)*discount;-->
				var dicount_amount = price - discount;
				given_discount += (dicount_amount || 0);
				count++;
			});
			var main_total = $('#fees').val();
			<!--var grand_discount = (given_discount/main_total)*100;-->
			var grand_discount = main_total - given_discount;
			$('#discount_amount').val(grand_discount.toFixed(2));
			cal_discount();
	});

	function cal_discount(){
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		var fees = parseFloat($('.dhee').val());
		var allowd = parseFloat($('#allow_discount').val());
		var discount_amount = parseFloat($("#discount_amount").val());
		discount_amount = (discount_amount)?discount_amount:0;
		
		$('#givn_disc').empty();
   		$('#givn_disc').val(parseFloat(discount_amount));
		
		if(parseFloat(discount_amount) > allowd){console.log(allowd);
				$('#after_discount').val(parseFloat(fees));
				$('#show_disc_app').show();
				$('#create_billing').hide();
		}else{
			var listPrice = parseFloat(fees);
			var discount  = parseFloat(discount_amount);
			<!--var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));-->
			var remaining_amount =  listPrice - discount;
			if(remaining_amount < 1){
				$('#payment_done').val('');
				$('#after_discount').val('');
				$("#discount_amount").val('');
				$('.investigation_discount').val('');
			}else{
				$('#after_discount').val(remaining_amount.toFixed(2));
			}
			$('#show_disc_app').hide();
			$('#create_billing').show();
		}
    };
	
    $(document).on('change',"#payment_method",function(e) {
        $('#transaction_id').empty();
		var method = $(this).val();
		if(method == ''){
			 $('#transaction_id').prop('required',false);
			 $('#transaction_img').prop('required',false);
			 $('#transaction').hide();		
		}else{
			 $('#transaction_id').prop('required',true);
			 $('#transaction_img').prop('required',true);
			 $('#transaction').show();
		}
    });
	
    $(document).on('change',".investigation_select",function(e) {
		$('.investigation_discount').val(0);
		$('#discount_amount').val(0);
        $('#msg_area').empty();
		var investigation_id = $(this).val();
		var investigation_count = $(this).attr('count');
		$('#payment_done').val('');		
		$('#remaining_amount').val('');
		$('.dhee').val(0);
	    $('#investigation_price_'+investigation_count).val('');		
		if(investigation_id != ''){
			$.ajax({
				url: '<?php echo base_url('billings/investigation_price')?>',
				data: {investigation_id : investigation_id, patient_id:<?php echo $session_data['paitent_id']?>, biller_id:<?php echo $_SESSION['logged_billing_manager']['employee_number']?>},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('#investigation_price_'+investigation_count).val(data.price);
					$('#investigation_price_'+investigation_count).attr('value', data.price);
					$('#investigation_code_'+investigation_count).val(data.code);
					$('#investigation_code_'+investigation_count).attr('value', data.code);
					
					var fee_total = 0;
					$('.investigation_price').each(function(){
						var price_total = 0;
						var price_total = $(this).val();
						fee_total += +price_total;
					});
					console.log(fee_total);
					$('.dhee').val(parseFloat(fee_total));
					$('#after_discount').val(parseFloat(fee_total));
					$('#allow_discount').empty().val(data.allowed_discount);
				} 
		   });
					
	  }
	  cal_discount();
    });

    $(document).on('keyup',"#payment_done",function(e) {
		$('#remaining_amount').empty();
		var fees = $('#after_discount').val();
		var payment_done = $(this).val();
		var remaining_amount = fees-payment_done;
		$('#remaining_amount').val(remaining_amount.toFixed(2));
    });
	
	$(document).on('click',"#create_billing",function(e) {
		   var value = $('.required_value').filter(function () {
			return this.value === '';
		  });
		  if (value.length == 0) {
		  
		  	$('#msg_area').empty();
			$('#doctor_id_text').empty();
			$('#fees_text').empty();
			$('#payment_done_text').empty();
			$('#remaining_amount_text').empty();
			$('#payment_method_text').empty();
			$('#investigation_preview_table_body').empty();
			$('#billing_id_text').empty();
			$('#investigation_id_text').empty();
			$('#hospital_id_text').empty();
			$('#discount_text').empty();
			
			var countr = 1;
			var rows= $('#investigation_table_body tr').length;
			
			if(rows < 1){$('#msg_area').append('One or more fields are empty !');}else{
			
			$('.investigation_select').each(function(){
				if(countr <= rows){
					var investigationname, investigationprice = '';
					investigationname = $('#investigation_name_'+countr).find(':selected').attr('invest');
					investigation_code = $('#investigation_code_'+countr).val();
					investigationprice = $('#investigation_name_'+countr).find(':selected').attr('fees');
					investigation_discount = $('#investigation_discount_'+countr).val();
					
					$('#investigation_preview_table_body').append('<tr class="investigation_row_'+countr+'"><td class="role">'+investigationname+'</td><td>'+investigation_code+'</td><td>'+investigationprice+'</td><td>'+investigation_discount+'</td></tr>');
					countr++;
				 }
			});
			
				var doctor = $('#doctor_id').val();
				var payment_done = $('#payment_done').val();
				var payment_method = $('#payment_method').val();
				var paramedic_name =  $('#paramedic_name').val();
			
				var transaction_id = $('#transaction_id').val();
				var transaction_img = $('#transaction_img').val();
				if(doctor == '' || payment_done == '' || payment_method == '' || paramedic_name=='' || transaction_id == '' || transaction_img == ''){
					$('#msg_area').append('One or more fields are empty !')
				}else{
					$('#paramedic_text').empty().append($('#paramedic_name').val());
					$('#fees_text').empty().append($('#after_discount').val());
					$('#payment_done_text').empty().append($('#payment_done').val());
					$('#remaining_amount_text').empty().append($('#remaining_amount').val());
					$('#transaction_id_text').empty().append($('#transaction_id').val());
					$('#payment_method_text').empty().append($('#payment_method').find(':selected').attr('mode'));
					$('#billing_id_text').empty().append($('#billing_id').val());
					$('#discount_text').empty().append($('#discount_amount').val());
					$('#hospital_id_text').empty().append($('#hospital_id').val());
					$('#consultation_details').hide();
					$('#consultation_preview').show();
				}
			}
		  } else if (value.length > 0) { alert('Please fill out all fields.'); }
	});
	
	$(document).on('click',"#edit_billing",function(e) {
			$('#consultation_preview').hide();
			$('#consultation_details').show();
	});
	
</script>