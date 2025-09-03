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
	.heading{margin-bottom:10px;margin-top: 0; padding-top:0px;}
</style>

<form class="col-sm-12 col-xs-12" id="procedure_form" method="post" action="" norequired_value enctype="multipart/form-data">
  <input type="hidden" name="action" value="add_procedure" />
  <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $session_data['paitent_id']?>" />
  <input type="hidden" name="hospital_id" id="hospital_id" value="<?php echo $session_data['hospital_id']?>" />
  <input type="hidden" name="reason_of_visit" value="<?php echo $session_data['reason_of_visit']?>" />
  <input type="hidden" name="billing_from" value="<?php echo $session_data['billing_from']?>" />
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  <input type="hidden" id="billing_type" value="procedure" />
  <input type="hidden" name="biller_id" value="<?php echo $_SESSION['logged_billing_manager']['employee_number']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details">
      <div class="panel-heading">
        <h3 class="heading">Procedure Details</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
        	<div class="procedure_lists col-sm-4 col-xs-12 col-md-4 role pull-right">
            	<label>Select Procedure</label>
            	<select name="procedure_parent" class="procedure_parent" id="procedure_parent" required>
	                <option value="">Select</option>
                    <?php foreach($procedure as $key => $val){ ?>
                     	<option value="<?php echo $val['ID']; ?>" code="<?php echo $val['code']; ?>" fees="<?php $fees = ''; if($session_data['nationality'] == 'indian'){$fees = $val['price'];}else{$fees = $val['usd_price'];} echo $fees; ?>" procedure="<?php echo $val['procedure_name']; ?>"> <?php echo $val['procedure_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div id="main_div" style="display:none;">
              <section class="col-sm-12 col-xs-12 sub_procedures_section">
                  <h4 class="heading">Patient Procedure</h4>
                  <div class="clearfix"></div>
                  <input type="button" class="add-sub_procedures-row btn btn-large" value="Add Procedure">
                  <input type="button" class="delete-sub_procedures-row btn btn-large" value="Delete Procedure">
                  <div class="form-group col-sm-12 col-xs-12 pull-right">
                        <label for="item_name">Package form(Required)</label>
                        <input id="package_form" name="package_form" type="file" class="form-control required_value">
                   </div>
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Procedure</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Discount amount</th>
                        </tr>
                    </thead>
                    <tbody id="sub_procedures_table_body">
                    <tr class="sub_procedures_row_1" trcount="1">
                            <td><!--<input type="checkbox" class="statuss" name="record">--></td>
                            <td class="role" id="sub_procd_td_1">
                                <input value="" placeholder="" readonly="readonly" name="sub_procedure_1" id="sub_procedure_1" class="sub_procedure_1" type="hidden" class="form-control required_value" required>
                               	 <input value="" placeholder="Procedure" readonly="readonly" id="parent_pocedure_name" class="parent_pocedure_name" type="text" class="form-control required_value" required>
                            </td>
                            <td><input value="" placeholder="Code" readonly="readonly" id="sub_procedures_code_1" class="sub_procedures_code" name="sub_procedures_code_1" type="text" class="form-control required_value" required></td>
                          <td><input value="" placeholder="Price" readonly="readonly" id="sub_procedures_price_1" class="sub_procedures_price" name="sub_procedures_price_1" type="text" class="form-control required_value" required></td>
                           <td><input value="0" placeholder="Discount amount" id="sub_procedures_discount_1" class="sub_procedures_discount" name="sub_procedures_discount_1" type="text" class="form-control required_value" required></td>
                        </tr>
                        
                        <tr class="sub_procedures_row_2" trcount="2">
                            <td><input type="checkbox" class="statuss" name="record"></td>
                            <td class="role" id="sub_procd_td_2">
                                <select name="sub_procedure_2" class="sub_procedure_select required_value" id="sub_procedure_2" count="2" required>
                                    <option value="">Select</option>
                                </select>
                            </td>
                            <td><input value="" placeholder="Code" readonly="readonly" id="sub_procedures_code_2" class="sub_procedures_code nt_prnt" name="sub_procedures_code_2" type="text" class="form-control required_value" required></td>
                          <td><input value="" placeholder="Price" readonly="readonly" id="sub_procedures_price_2" class="sub_procedures_price nt_prnt" name="sub_procedures_price_2" type="text" class="form-control required_value" required></td>
                           <td><input value="0" placeholder="Discount" id="sub_procedures_discount_2" class="sub_procedures_discount" name="sub_procedures_discount_2" type="text" class="form-control required_value" required></td>
                        </tr>
                    </tbody>
                </table>
                </section>
                <div class="clearfix"></div>
                <hr />
                
                <div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Receipt number (Required)</label>
                        <input value="<?php echo getGUID(); ?>" placeholder="Receipt number" readonly="readonly" id="receipt_number" name="receipt_number" type="text" class="form-control required_value" required>
                   </div>
                   
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Procedure fees (Required)</label>
                        <input value="" name="totalpackage" placeholder="Procedure fees" readonly="readonly" class="dhee" id="fees" type="hidden" class="form-control required_value" required>
                        <input value="" placeholder="Procedure fees" readonly="readonly" id="after_discount" name="fees" type="text" class="form-control required_value" required>
                   </div>
                 </div>
                 
                 <div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                     <label for="item_name">Discount amount(Required)</label>
                     <input placeholder="Discount amount" class="required_value" type="text" name="discount_amount" readonly="readonly" value="0" id="discount_amount" />
              		 <input value="<?php echo $_SESSION['logged_billing_manager']['allow_discount'];?>" id="allow_discount" type="hidden" class="form-control required_value" required>
               <p id="show_disc_app" style="display:none;">Given discount is more than allowed, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_billing_manager']['username'];?>" id="get_discount_approval">click here</a> for admin approval.</p> </div>
               
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
                        <select name="payment_method" class="required_value" id="payment_method" required>
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
                       <input value="" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control required_value" required>
                       <label>Upload screenshot/document here</label>
                       <input type="file" class="required_value" name="transaction_img" id="transaction_img"  />
                    </div>
                 </div>
                
                <div class="row">
                <?php if($session_data['billing_from'] != 'IndiaIVF'){?>
                    <div class="form-group col-sm-6 col-xs-12">
                       <label for="item_name">Billing ID (Optional)</label>
                       <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control">
                    </div>
               <?php } ?>
                    <!--<div class="form-group col-sm-6 col-xs-12">
                            <div id="center_share_div">
	                            <label for="item_name">IIC Share(Required) <span class="success">*Share amount should be in number e.g. 1000</span></label>
    	                        <input value="" placeholder="Share amount" id="center_share" name="center_share" type="text" class="form-control required_value" required>
                           </div>
         	 		   </div>-->
               </div>
                        
                <div class="form-group col-sm-12 col-xs-12">
                	<a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
                    <p id="error" class="error delete"></p>
                </div>
            </div>
      </div>
      </p>
    </div>
    
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details_preview" style="display:none;">
      <div class="panel-heading">
        <h3 class="heading">Billing Summary</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
        	<div class="procedure_lists col-sm-4 col-xs-12 col-md-4 role pull-right">
            	<label>Procedure</label>
            	<p id="procedure_text"></p>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div id="main_div">
                <section class="col-sm-12 col-xs-12 sub_procedures_section" id="DivIdToPrint">
                 <table style="border: 1px solid black; border-collapse: collapse;width:100%;position:absolute;z-index:-9999;">
                      <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;">IIC ID:</th>
                        <td style="border: 1px solid black; border-collapse: collapse;" id="iic_id"><?php echo $session_data['paitent_id']?></td>
                      </tr>
                      <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;">Patient name:</th>
                        <td style="border: 1px solid black; border-collapse: collapse;" id="patient_name"><?php echo $session_data['patient_name']?></td>
                      </tr>
                      <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;">Telephone:</th>
                        <td style="border: 1px solid black; border-collapse: collapse;"><?php echo $session_data['patient_phone']?></td>
                      </tr>
                </table>
                  <h4 class="heading" style="visibility:hidden;">Patient Procedure</h4>
                  <div class="clearfix"></div>
                  <table style="border: 1px solid black; border-collapse: collapse;width:100%;margin-top:15%;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; border-collapse: collapse;">Procedure</th>
                            <th style="border: 1px solid black; border-collapse: collapse;">Code</th>
                            <th style="border: 1px solid black; border-collapse: collapse;">Price</th>
                            <th style="border: 1px solid black; border-collapse: collapse;">Discount amount</th>
                        </tr>
                    </thead>
                    <tbody id="sub_procedures_table_body_preview"></tbody>
                </table>
                 <table style="border: 1px solid black; border-collapse: collapse;width:100%;position:absolute;z-index:-9999;margin-top:5%;">
                      <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;">Total:</th>
                        <td style="border: 1px solid black; border-collapse: collapse;" id="total_ammont"></td>
                      </tr>
                </table>
                
                </section>
                
                <div class="clearfix"></div>
                <hr />
                
                <div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Receipt number (Required)</label>
                       <p id="receipt_number_text"><?php echo getGUID(); ?></p>
                   </div>
                   
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Procedure fees (Required)</label>
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
                
                <div class="form-group col-sm-12 col-xs-12">
            		<a class="btn btn-large" id="edit_billing" href="javascript:void(0);">Edit Billing</a>
            		<input type="submit" id="submitbutton" class="btn btn-large" value="Create Billing" />
                </div>
            </div>
      </div>
      </p>
    </div>
  </div>
</form>
<div id="procedure_html" style="display:none;"></div>
<input type="hidden" id="givn_disc" value="" />
<!--****** Procedures SCRIPT *******-->
<script>
	$(document).on('keyup',".sub_procedures_discount",function(e) {
			
			var given_discount = 0;
			var count = 1;
			$('.sub_procedures_discount').each(function(){
				//var price = $('#sub_procedures_price_'+count).val();
				var discount = $(this).val();
				<!--var dicount_amount = (price/100)*discount;-->
				//var dicount_amount = price - discount;
				given_discount+= +parseFloat((discount || 0));
				count++;
			});
			
			//var main_total = $('#fees').val();
			<!--var grand_discount = (given_discount/main_total)*100;-->
			//var grand_discount = main_total - given_discount;
			console.log('grand_discount----------------------' + given_discount);
			$('#discount_amount').val(given_discount);
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
		
		if(parseFloat(discount_amount) > allowd){
				$('#after_discount').val(parseFloat(fees.toFixed(2)));
				$('#show_disc_app').show();
				$('#create_billing').hide();
		}else{
			var listPrice = parseFloat(fees.toFixed(2));
			var discount  = parseFloat(discount_amount.toFixed(2));
			<!--var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));-->
			var remaining_amount =  listPrice - discount;
			if(remaining_amount < 1){
				$('#payment_done').val('');
				$('#after_discount').val('');
				$("#discount_amount").val('');
				$('.sub_procedures_discount').val('');
			}else{
				$('#after_discount').val(remaining_amount.toFixed(2));
			}
			$('#show_disc_app').hide();
			$('#create_billing').show();
		}
    };
	
	$(document).on('change',"#procedure_parent",function(e) {
		$('#show_disc_app').hide();
		$('#loader_div').show();
        $('#procedure_html').empty();
		$('#sub_procedure_2').empty();
		$('#sub_procedure_1').val('');
		$('#parent_pocedure_name').val('');
		$('#sub_procedures_code_1').val('');
		$('#sub_procedures_price_1').val('');
		$('.nt_prnt').val('');

		$('.sub_procedures_discount').val(0);
        $('#msg_area').empty();
        $('#discount_amount').val(0);
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		
		var parent_parents = $(this).val();
		if(parent_parents != ''){
			var procedure = $(this).find(':selected').attr('procedure');
			var code = $(this).find(':selected').attr('code');
			var fees = $(this).find(':selected').attr('fees');
			$('#sub_procedure_1').val(parent_parents);
			$('#sub_procedure_1').attr('value', parent_parents);
			$('#parent_pocedure_name').val(procedure);
			$('#sub_procedures_code_1').val(code);
			$('#sub_procedures_price_1').val(fees);
			
			$('.dhee').val(fees);
			$('#after_discount').val(fees);
			$.ajax({
				url: '<?php echo base_url('billings/get_sub_procedures')?>',
				data: {parent_parents : parent_parents, biller_id:<?php echo $_SESSION['logged_billing_manager']['employee_number']?>,patient_id:<?php echo $session_data['paitent_id']?>},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('#procedure_html').html(data.html);
					$('#sub_procedure_2').html(data.html);
					$('#allow_discount').empty().val(data.allowed_discount);
					$('#loader_div').hide();
				} 
		   });
		   $('#main_div').show();
	  }else{
		   $('#main_div').hide();
	  }
			
    });
	$(document).ready(function(){
		$(document).on('click',"#print_section",function(e) {
		 var divToPrint=document.getElementById('DivIdToPrint');
		  var newWin=window.open('','Print-Window');		
		  newWin.document.open();		
		  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');		
		  newWin.document.close();		
		  setTimeout(function(){newWin.close();},10);
		});
	
	
        $(".add-sub_procedures-row").click(function(){
			$('#fees').val($('#sub_procedures_price_1').val());
			$('#after_discount').val($('#sub_procedures_price_1').val());
			$('#payment_done').val('');
			$('#remaining_amount').val('');
			$('#discount_amount').val(0);
			$('.sub_procedures_discount').val(0);
			
		
			var rows= $('#sub_procedures_table_body tr:last').attr('trcount');
			var count = parseFloat(rows) + 1;
			var sub_procedure_html = $('#procedure_html').html();
            var markup = '<tr class="sub_procedures_row_'+count+'" trcount="'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td class="role" id="sub_procd_td_'+count+'"><select name="sub_procedure_'+count+'" class="sub_procedure_select" id="sub_procedure_'+count+'" count="'+count+'" required>'+sub_procedure_html+'</select></td> <td><input value="" placeholder="Code" readonly="readonly" id="sub_procedures_code_'+count+'" class="sub_procedures_code nt_prnt" name="sub_procedures_code_'+count+'" type="text" class="form-control required_value" required></td><td><input value="" placeholder="Price" readonly="readonly" id="sub_procedures_price_'+count+'" class="sub_procedures_price nt_prnt" name="sub_procedures_price_'+count+'" type="text" class="form-control required_value" required></td><td><input value="0" placeholder="Discount" id="sub_procedures_discount_'+count+'" class="sub_procedures_discount" name="sub_procedures_discount_'+count+'" type="text" class="form-control required_value" required></td></tr>';
            $("table tbody#sub_procedures_table_body").append(markup);
			
			var fee_total = 0;
			$('.sub_procedures_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			$('#fees').val(parseFloat(fee_total));
			$('#after_discount').val(parseFloat(fee_total));
			$('#discount_amount').val(parseFloat(0));
			$('#payment_done').val('');
			$('#remaining_amount').val('');
			$('.sub_procedures_discount').val(parseFloat(0));
			
        });
        
        // Find and remove selected table rows
        $(".delete-sub_procedures-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });		
			
			var fee_total = 0;
			$('.sub_procedures_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			$('#fees').val(parseFloat(fee_total));
			$('#after_discount').val(parseFloat(fee_total));
			$('#discount_amount').val(parseFloat(0));
			$('#payment_done').val('');
			$('#remaining_amount').val('');
			$('.sub_procedures_discount').val(parseFloat(0));
			
        });		
    });
	
	$(document).on('change',".sub_procedure_select",function(e) {
		$('#loader_div').show();
		$('#show_disc_app').hide();
		$('.sub_procedures_discount').val(0);
        $('#msg_area').empty();
        $('#discount_amount').val(0);
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		
		var sub_procedure = $(this).val();
		var count = $(this).attr('count');
		$('#sub_procedures_code_'+count).val('');
		$('#sub_procedures_price_'+count).val('');
		$('#sub_procedures_discount_'+count).val('');		
		$('#sub_procedures_sub_total').val('');
		$('#sub_procedures_total').val('');
		$('#fees').val('');
		
		if(sub_procedure != ''){
			var fees = $(this).find(':selected').attr('fees');
			$('#sub_procedures_price_'+count).val(fees);
			var code = $(this).find(':selected').attr('code');
			$('#sub_procedures_code_'+count).val(code);
			
			var fee_total = 0;
			$('.sub_procedures_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
		
			var total_fees = 0;
			total_fees = parseFloat(fee_total);
			console.log(total_fees);
			$('.dhee').val(total_fees);
			$('#after_discount').val(total_fees);
			
		}else{
			$('#fees').val('');
			$('#after_discount').val('');
			$('#discount_amount').val(0);
			$('#payment_done').val('');
			$('#remaining_amount').val('');		
			$('#show_disc_app').hide();
		}
		$('#loader_div').hide();
    });
	
	$(document).on('keyup',"#discount_amount",function(e) {
		var fees = parseFloat($('#fees').val());
		var allowd = parseFloat($('#allow_discount').val());
		var discount_amount = parseFloat($(this).val());
		discount_amount = (discount_amount)?discount_amount:0;
		if(discount_amount == ''){ $(this).val(0); }
//		console.log(fees+' ----- '+allowd+' ----- '+discount_amount);
		if(parseFloat(discount_amount) > allowd){	
				$('#fees').val(parseFloat(fees));
				$('#after_discount').val(parseFloat(fees));
				$('#show_disc_app').show();
				$('#create_billing').hide();
		}else{
			$('#show_disc_app').hide();
			$('#create_billing').show();
			var listPrice = parseFloat(fees);
			var discount  = parseFloat(discount_amount);
			console.log(listPrice+' ----- '+discount);
			<!--var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));-->
			var remaining_amount =  listPrice - discount;
			if(remaining_amount < 1){
				$('#payment_done').val('');
				$('#fees').val('');
				$(this).val('');
				$('#fees').val(parseFloat(fees));
				$('#after_discount').val(parseFloat(fees));
			}else{console.log(remaining_amount);
				$('#after_discount').val(parseFloat(remaining_amount));
			}
		}
    });
	
</script>
<!--****** Procedures SCRIPT *******-->

<!--****** Billing SCRIPT *******-->
<script>
	$(document).on('click',"#edit_billing",function(e) {
			$('#procedure_details_preview').hide();
			$('#procedure_details').show();
	});

	$(document).on('click',"#create_billing",function(e) {
	 	  var value = $('.required_value').filter(function () {
			return this.value === '';
		  });
		  if (value.length == 0) {make_billing();} else if (value.length > 0) { alert('Please fill out all fields.'); }
    });
	
	
function make_billing() {
	$('#msg_area').empty();
	$('#procedure_text').empty();
	
	$('#sub_procedures_table_body_preview').empty();
	$('#sub_procedures_sub_total_text').empty();
	$('#sub_procedures_discount_text').empty();
	$('#sub_procedures_total_text').empty();
	
	$('#fees_text').empty();
	$('#payment_done_text').empty();
	$('#remaining_amount_text').empty();
	$('#payment_method_text').empty();
	$('#billing_id_text').empty();
	$('#procedure_id_text').empty();
	$('#hospital_id_text').empty();
	$('#discount_text').empty();
	$('#center_share_text').empty();
	$('#procedure_text').empty().append($('#procedure_parent').find(':selected').attr('procedure'));
		
	/********** sub_procedures TEXT ************/
	
	$('#sub_procedures_table_body_preview').append('<tr><td style="border: 1px solid black; border-collapse: collapse;">'+$('#parent_pocedure_name').val()+'</td><td style="border: 1px solid black; border-collapse: collapse;">'+$('#sub_procedures_code_1').val()+'</td><td style="border: 1px solid black; border-collapse: collapse;">'+$('#sub_procedures_price_1').val()+'</td><td style="border: 1px solid black; border-collapse: collapse;">'+$('#sub_procedures_discount_1').val()+'</td></tr>');
	
	var s_pro_count = 2;
	var s_pro_rows= $('#sub_procedures_table_body tr').length;
	$('.sub_procedure_select').each(function(){
		if(s_pro_count <= s_pro_rows){
			var name, price, code = '';
			if($(this).val() != ''){
				name = $('#sub_procedure_'+s_pro_count).find(':selected').text();
				if(name == 'Select'){
					$('section.sub_procedures_section').hide();
				}else{
					price = $('#sub_procedure_'+s_pro_count).find(':selected').attr('fees');
					code = $('#sub_procedure_'+s_pro_count).find(':selected').attr('code');
					discount = $('#sub_procedures_discount_'+s_pro_count).val();
					$('#sub_procedures_table_body_preview').append('<tr><td style="border: 1px solid black; border-collapse: collapse;">'+name+'</td><td style="border: 1px solid black; border-collapse: collapse;">'+code+'</td><td style="border: 1px solid black; border-collapse: collapse;">'+price+'</td><td style="border: 1px solid black; border-collapse: collapse;">'+discount+'</td></tr>');
				}
			}else{
					$('section.sub_procedures_section').hide();
			}
			s_pro_count++;
		 }
	});
	/********** sub_procedures TEXT ************/
	
		var method = $('#payment_method').find(':selected').attr('mode');
		$('#total_ammont').empty();
		$('#total_ammont').empty().append($('#after_discount').val());

		var transaction_id = $('#transaction_id').val();
		var transaction_img = $('#transaction_img').val();
		if(transaction_id == '' || transaction_img == ''){
			$('#msg_area').empty().append('One or more fields are empty !')
		}else{
			$('#fees_text').empty().append($('#after_discount').val());
			$('#payment_done_text').empty().append($('#payment_done').val());
			$('#remaining_amount_text').empty().append($('#remaining_amount').val());
			$('#payment_method_text').empty().append($('#payment_method').find(':selected').attr('mode'));
			$('#transaction_id_text').empty().append($('#transaction_id').val());
			$('#billing_id_text').empty().append($('#billing_id').val());
			$('#procedure_id_text').empty().append($('#procedure_id').val());
			$('#hospital_id_text').empty().append($('#hospital_id').val());
			$('#discount_text').empty().append($('#discount_amount').val());
			$('#center_share_text').empty().append($('#center_share').val());
			$('#procedure_details').hide();
			$('#procedure_details_preview').show();
		}
}
</script>
<!--****** Billing SCRIPT *******-->

<script>
$(document).on('keyup',"#payment_done",function(e) {
	$('#remaining_amount').empty();
	var fees = $('#after_discount').val();
	var payment_done = $(this).val();
	var remaining_amount = fees-payment_done;
	$('#remaining_amount').val(remaining_amount);
});
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
</script>