
<?php $all_method =&get_instance();
	$billing_type = '';
	if($consultation_details['investation_suggestion'] == 1){
		$billing_type = 'investigation';
	}else if($consultation_details['procedure_suggestion'] == 1){
		$billing_type = 'procedure';
	}else{
		header("location:" .base_url(). "after-consultation?m=".base64_encode('something went wrong!').'&t='.base64_encode('error'));
		die();
	}
	$patient_data = get_patient_detail($consultation_details['patient_id']);
	$grand_total = 0;
	//var_dump($consultation_details);die;
?>
<style>
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}
</style>
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data" >
  <input type="hidden" name="action" value="add_consultation" />
  <input type="hidden" name="appointment_id" value="<?php echo $consultation_details['appointment_id']; ?>" />
  <input type="hidden" name="consultation_done" value="<?php echo $consultation_details['ID']; ?>" />
  <input type="hidden" name="patient_id" value="<?php echo $consultation_details['patient_id']; ?>" />  
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  <input type="hidden" id="billing_type" name="billing_type" value="<?php echo $billing_type; ?>" />
  <input type="hidden" name="biller_id" value="<?php echo $_SESSION['logged_billing_manager']['employee_number']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      <div class="panel-heading">
        <h3 class="heading">Billing</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Doctor (Required)</label>
                <p>Dr. <?php echo $all_method->doctor_name($consultation_details['doctor_id']); ?></p>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date(Required)</label>
                <input value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Date" readonly="readonly" id="on_date" name="on_date" type="text" class="form-control validate" required>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <input value="<?php echo getGUID(); ?>" placeholder="Receipt number" readonly="readonly" id="receipt_number" name="receipt_number" type="text" class="form-control validate" required>
           </div>
         </div>
     
         
         <div class="row">
         	 <?php //var_dump($consultation_details);die;
					if($consultation_details['medicine_suggestion'] == 1){ ?>
                    <h4>Medicine</h4>
                    <table>
                          <tr>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Brand</th>
                            <th>Price</th>
                          </tr>
			<?php 	$male_medine = unserialize($consultation_details['male_medicine_suggestion_list']);
					//var_dump($male_medine);die;
				  foreach($male_medine as $key => $val){ $medicine_details = $all_method->get_medicine_details($val); //var_dump($medicine_details);die;?>
					<tr>
                        <td><?php echo $medicine_details['item_name']; ?></td>
                        <td><?php echo $medicine_details['company']; ?></td>
                        <td><?php $brand_details = $all_method->get_brand_details($medicine_details['brand_name']); echo $brand_details['name']; ?></td>
                        <td><?php echo 'Rs.'.$medicine_details['price']; ?></td>
                    </tr>
			<?php $grand_total += $medicine_details['price']; }?>

			<?php $female_medine = unserialize($consultation_details['female_medicine_suggestion_list']);
					
				  foreach($female_medine as $key => $val){ $medicine_details = $all_method->get_medicine_details($val); //var_dump($medicine_details);die;?>
					<tr>
                        <td><?php echo $medicine_details['item_name']; ?></td>
                        <td><?php echo $medicine_details['company']; ?></td>
                        <td><?php $brand_details = $all_method->get_brand_details($medicine_details['brand_name']); echo $brand_details['name']; ?></td>
                        <td><?php echo 'Rs.'.$medicine_details['price']; ?></td>
                    </tr>
			<?php $grand_total += $medicine_details['price']; }?>

					</table>
			<?php } ?>
         </div>
         
         <div class="row">
         	 <?php 
					if($consultation_details['investation_suggestion'] == 1){ ?>
                    <h4>Investation</h4>
                     <table>
                          <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Price</th>
                          </tr>
			<?php $male_investigation_suggestion_list = unserialize($consultation_details['male_investigation_suggestion_list']);
					foreach($male_investigation_suggestion_list as $key => $val){
						
						$investigation_details = $all_method->get_investigation_details($val);

				?>
						<tr>
                            <td><?php echo $investigation_details['investigation']; ?></td>
                            <td><?php echo $investigation_details['code']; ?></td>
                             <td><?php $invest_price = 0; if($patient_data['nationality'] == 'indian'){$invest_price = $investigation_details['price']; echo 'Rs.'.$invest_price;}else{$invest_price = $investigation_details['usd_price']; echo $invest_price.'USD';}?></td>
                        </tr>
					<?php $grand_total += $invest_price;} ?>
			<?php $female_investigation_suggestion_list = unserialize($consultation_details['female_investigation_suggestion_list']);
					foreach($female_investigation_suggestion_list as $key => $val){ $investigation_details = $all_method->get_investigation_details($val); ?>
						<tr>
                            <td><?php echo $investigation_details['investigation']; ?></td>
                            <td><?php echo $investigation_details['code']; ?></td>
                             <td><?php $invest_price = 0; if($patient_data['nationality'] == 'indian'){$invest_price = $investigation_details['price']; echo 'Rs.'.$invest_price;}else{$invest_price = $investigation_details['usd_price']; echo $invest_price.'USD';}?></td>
                        </tr>
					<?php $grand_total += $invest_price;} ?>
                    </table>
		<?php } ?>
         </div>
        
       	 <div class="row">
         	 <?php //var_dump($consultation_details);die;
					if($consultation_details['procedure_suggestion'] == 1){ $parent_procedure_details = $all_method->get_procedure_details($consultation_details['procedure_suggestion_list']); ?>
                    <h4>Procedure</h4>
                     <table>
                          <tr>
                            <th>Procedure</th>
                            <th>Code</th>
                            <th>Price</th>
                          </tr>
                          <tr>
                            <td><?php echo $parent_procedure_details['procedure_name']; ?></td>
                            <td><?php echo $parent_procedure_details['code']; ?></td>
                            <td><?php $parent_price = 0; if($patient_data['nationality'] == 'indian'){$parent_price = $parent_procedure_details['price']; echo 'Rs.'.$parent_price;}else{$parent_price = $parent_procedure_details['usd_price']; echo $parent_price.'USD';} $grand_total += $parent_price;?></td>
                        </tr>
			<?php 	
					//var_dump($parent_procedure_details); die;	
					$sub_procedure_suggestion_list = unserialize($consultation_details['sub_procedure_suggestion_list']);
					foreach($sub_procedure_suggestion_list as $key => $val){ $sub_procedure_details = $all_method->get_procedure_details($val); //var_dump($val);die;	?>
                        <tr>
                            <td><?php echo $sub_procedure_details['procedure_name']; ?></td>
                            <td><?php echo $sub_procedure_details['code']; ?></td>
                            <td><?php $sub_price = 0; if($patient_data['nationality'] == 'indian'){$sub_price = $sub_procedure_details['price']; echo 'Rs.'.$sub_price;}else{$sub_price = $sub_procedure_details['usd_price']; echo $sub_price.'USD';}?></td>
                        </tr>

				  <?php $grand_total += $sub_price;}?>
                   </table>
			<?php } ?>
         </div>
         
         
        <div class="row">           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Grand Total (Required)</label>
                <input value="<?php echo $grand_total; ?>" name="totalpackage" placeholder="Procedure fees" readonly="readonly" class="dhee" id="fees" type="hidden" class="form-control required_value" required>
                <input value="<?php echo $grand_total; ?>" placeholder="Procedure fees" readonly="readonly" id="after_discount" name="fees" type="text" class="form-control required_value" required>
           </div>
       </div>
       
       <div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                     <label for="item_name">Discount amount(Required)</label>
                     <input placeholder="Discount amount" class="required_value" type="text" name="discount_amount" readonly="readonly" value="0" id="discount_amount" />
              		 <input value="<?php if($patient_data['nationality'] == 'indian'){echo $_SESSION['logged_billing_manager']['allow_discount_rs'];}else{echo $_SESSION['logged_billing_manager']['allow_discount_us']; } ;?>" id="allow_discount" type="hidden" class="form-control required_value" required>
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
								<option value="card" mode="Card">Card</option>
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
            <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Billing ID (Optional)</label>
               <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control validate">
            </div>
            
            <div class="form-group col-sm-6 col-xs-12 hospital_id_section" style="display:none;">
               <label for="item_name">Hospital ID</label>
               <input value="" id="hospital_id" name="hospital_id" type="text" class="form-control validate">
            </div>
         </div>
         
         <div class="row">            
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Billing source (Required)</label>
                <select name="billing_from" id="billing_from" required>
                    <option value="">Select</option>
                    <?php if(isset($_SESSION['logged_billing_manager'])){ $center = $all_method->get_center(); ?>
                    	<option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                    <?php } ?>
                    <option value="IndiaIVF">IndiaIVF</option>       
                </select>
            </div>
			
			
              
         </div>
         
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
            <!--<a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>-->
            <input type="submit" class="btn btn-primary" value="Create billing" />
         </div>
      </div>
      </p>
    </div>
  </div>
</form>

<script type="text/javascript">

	$(document).on('change',"#payment_discount",function(e) {
		$("input#after_discount").val($("input#fees").val());
		$("input#payment_done").val('');
		$("input#remaining_amount").val('');
		$("input#discount_amount").val('');
		$("input#reason_of_discount").val('');
		$("input#discount").prop('required',false);
		$("input#reason_of_discount").prop('required',false);
		$('#discount_avail').hide();
		if($(this).val() == 'discount'){
			$("input#discount").prop('required',true);
			$("input#reason_of_discount").prop('required',true);
			$('#discount_avail').show();
		}else if($(this).val() == 'free'){
			$("#after_discount").val(0);
			$('#payment_done').val(0);
			$('#remaining_amount').val(0);
		}
	});

	$(document).on('keyup',"#discount_amount",function(e) {
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		var fees = parseFloat($('#fees').val());
		var allowd = parseFloat($('#allow_discount').val());
		var discount_amount = parseFloat($(this).val());
		discount_amount = (discount_amount)?discount_amount:0;
		if(discount_amount == ''){ $(this).val(0); }
 		//console.log(fees+' ----- '+allowd+' ----- '+discount_amount);
		if(parseFloat(discount_amount) > allowd){
				$('#fees').val('');
				$('#fees').val(parseFloat(fees));
				$('#after_discount').val(parseFloat(fees));
				$('#create_billing').hide();
				$('#show_disc_app').show();				
		}else{
			if(parseFloat(discount_amount) <= parseFloat(allowd)){
				var listPrice = parseFloat(fees);
				var discount  = parseFloat(discount_amount);
				console.log(listPrice+' ----- '+discount);
				<!--var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));-->
				var remaining_amount = listPrice - discount;
				if(remaining_amount < 1){
					$('#payment_done').val('');
					$('#fees').val('');
					$(this).val('');
					$('#fees').val(parseFloat(fees));
					$('#after_discount').val(parseFloat(fees));
				}else{//console.log(remaining_amount);
					$('#after_discount').val(parseFloat(remaining_amount));
				}
				$('#show_disc_app').hide();
				$('#create_billing').show();
			}
			else{
				$('#fees').val(parseFloat(fees));
				$('#after_discount').val(parseFloat(fees));
				$('#create_billing').hide();
				$('#show_disc_app').show();				
			}
		}
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
	
    $(document).on('keyup',"#payment_done",function(e) {
		$('#remaining_amount').empty();
		var fees = $('#after_discount').val();
		var payment_done = $(this).val();
		var remaining_amount = fees-payment_done;
		$('#remaining_amount').val(remaining_amount);
    });
	
	$(document).on('click',"#create_billing",function(e) {
		$('#msg_area').empty();
		$('#doctor_id_text').empty();
		$('#fees_text').empty();
		$('#payment_done_text').empty();
		$('#remaining_amount_text').empty();
		$('#payment_method_text').empty();	
		$('#transaction_id_text').empty();	
		$('#billing_id_text').empty();	
		$('#consultation_id_text').empty();
		$('#hospital_id_text').empty();
		$('#payment_discount_text').empty();
		$('#discount_amount_text').empty();
		$('#reason_of_discount_text').empty();
						
		var doctor = $('#doctor_id').val();
		var payment_done = $('#payment_done').val();
		var payment_method = $('#payment_method').val();
		var payment_discount = $('#payment_discount').val();
		
		var transaction_id = $('#transaction_id').val();
		var transaction_img = $('#transaction_img').val();
		if(doctor == '' || payment_done == '' || payment_method == '' || payment_discount == '' || transaction_id == '' || transaction_img == ''){
			$('#msg_area').append('One or more fields are empty !');
		}else{
					if(payment_discount == 'discount'){
						var reason_of_discount =  $("input#reason_of_discount").val();
						var discount_amount =  $("input#discount_amount").val();
							
						if(discount_amount == '' || reason_of_discount == ''){
							$('#msg_area').append('One or more fields are empty !');
						}else{
							value_into_text();	
						}
					}else{
						value_into_text();
					}
			}
    });
	
	function value_into_text(){
		$('#doctor_id_text').append($('#doctor_id').find(':selected').attr('doc'));
		$('#fees_text').append($('#after_discount').val());
		$('#payment_done_text').append($('#payment_done').val());
		$('#remaining_amount_text').append($('#remaining_amount').val());
		$('#transaction_id_text').append($('#transaction_id').val());
		$('#payment_method_text').append($('#payment_method').find(':selected').attr('mode'));			
		$('#billing_id_text').append($('#billing_id').val());
		$('#consultation_id_text').append($('#consultation_id').val());
		$('#hospital_id_text').append($('#hospital_id').val());
		$('#payment_discount_text').append($('#payment_discount').find(':selected').val());
		$('#discount_amount_text').append($('#discount_amount').val());
		$('#reason_of_discount_text').append($('#reason_of_discount').val());
		hideshow_discount();
		$('#consultation_details').hide();
		$('#consultation_preview').show();
	}
	
	function hideshow_discount(){
		var discount_amount = $('#discount_amount').val()
		if(discount_amount < 1){
			$('.discount_div').hide();
		}else{
			$('.discount_div').show();	
		}
	}
	
	$(document).on('click',"#edit_billing",function(e) {
			$('#consultation_preview').hide();
			$('#consultation_details').show();
	});
	
</script>