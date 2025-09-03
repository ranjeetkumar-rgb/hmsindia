<?php $all_method =&get_instance();
	  $patient_id = $data['patient_id'];
	  $patient_data = $all_method->get_patient_details($patient_id);
	 /* var_dump($data);
	  echo '<br/><br/>-------------------------<br/><br/>';
	  var_dump($patient_data);
	  die;*/
	  $readonly = '';
	  if($discound_applied > 0){
		  $readonly = ' readonly="readonly"';
	  }
?>
<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url();?>billings/disapproved/<?php echo $data['receipt_number']?>?t=<?php echo $_GET['t'];?>" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="update_disapproved_billing" />
    <input type="hidden" name="type" id="billing_type" value="consultation" />
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>" id="patient_id" />
    <input type="hidden" name="receipt_number" value="<?php echo $data['receipt_number']; ?>" id="receipt_number" />
    <input type="hidden" name="biller_id" value="<?php echo $_SESSION['logged_billing_manager']['employee_number']?>" />
    
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
           <?php if($discound_applied > 0){ ?>
          		<h3 class="heading">Discounted billing</h3>
			<?php }else { ?>
	            <h3 class="heading">Edit disapproved billing</h3>
            <?php } ?>
        </div>
        <div class="panel-body profile-edit">
          <p>
       <div id="add_section"> 
        <div class="row">
		   <div class="form-group col-sm-3 col-xs-12" align="center"></div>                               	
           <div class="form-group col-sm-6 col-xs-12" align="center">
                <label for="item_name">IIC ID </label>
                <h3><?php echo $patient_id; ?></h3>
           </div>
		   <div class="form-group col-sm-3 col-xs-12" align="center"></div>
         </div>
  		 <h4>Update patient details</h4>
         <hr />
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12" align="center">
                <h4 for="item_name">Wife details </h4>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12" align="center">
                <h4 for="item_name">Husband details </h4>
           </div>
         </div>
        
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Name (Required)</label>
                <input value="<?php echo $patient_data['wife_name']; ?>" id="wife_name" name="wife_name" type="text" class="form-control validate in_field" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Name (Required)</label>
                <input value="<?php echo $patient_data['husband_name']; ?>" id="husband_name" name="husband_name" type="text" class="form-control validate in_field">
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Phone</label>
				<p><?php echo sting_masking($patient_data['wife_phone']); ?></p>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Phone (Required)</label>
                <input value="<?php echo $patient_data['husband_phone']; ?>" id="husband_phone" name="husband_phone" type="text" class="form-control validate in_field">
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Email (Required)</label>
                <input value="<?php echo $patient_data['wife_email']; ?>" id="wife_email" name="wife_email" type="text" class="form-control validate in_field" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Email (Optional)</label>
                <input value="<?php echo $patient_data['husband_email']; ?>" id="husband_email" name="husband_email" type="text" class="form-control validate in_field">
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Pan number (Optional)</label>
                <input value="<?php echo $patient_data['wife_pan_number']; ?>" id="wife_pan_number" name="wife_pan_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
	                <label>Upload pan card</label>
    	            <input type="file" name="wife_pan_card" class="remove_required" />
                </div>
                <?php if(!empty($patient_data['wife_pan_card'])){?>
                <a href="<?php echo $patient_data['wife_pan_card']; ?>" target="_blank"><img class="img_show" title="click to enlarge" src="<?php echo $patient_data['wife_pan_card']; ?>" id="wife_pan_card_img" /></a>
                <?php } ?>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Pan number (Optional)</label>
                <input value="<?php echo $patient_data['husband_pan_number']; ?>" id="husband_pan_number" name="husband_pan_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
	                <label>Upload pan card</label>
    	            <input type="file" name="husband_pan_card" class="remove_required" />
                </div>
                <?php if(!empty($patient_data['husband_pan_card'])){?>
                    <a href="<?php echo $patient_data['husband_pan_card']; ?>" target="_blank"> <img class="img_show" title="click to enlarge" src="<?php echo $patient_data['husband_pan_card']; ?>" id="husband_pan_card_img" /></a>
                    <?php } ?>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Adhaar number (Optional)</label>
                <input value="<?php echo $patient_data['wife_adhar_number']; ?>" id="wife_adhar_number" name="wife_adhar_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
	                <label>Upload adhar card</label>
    	            <input type="file" name="wife_adhar_card" class="remove_required" />
                </div>
                <?php if(!empty($patient_data['wife_adhar_card'])){?>
                <a href="<?php echo $patient_data['wife_adhar_card']; ?>" target="_blank"><img class="img_show" title="click to enlarge" src="<?php echo $patient_data['wife_adhar_card']; ?>" id="wife_adhar_card_img" /></a>
                <?php } ?>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Adhaar number (Optional)</label>
                <input value="<?php echo $patient_data['husband_adhar_number']; ?>" id="husband_adhar_number" name="husband_adhar_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
            	    <label>Upload adhar card</label>
        	        <input type="file" name="husband_adhar_card" class="remove_required" />
                </div>
                <?php if(!empty($patient_data['husband_adhar_card'])){?>
                    <a href="<?php echo $patient_data['husband_adhar_card']; ?>" target="_blank"><img class="img_show" title="click to enlarge" src="<?php echo $patient_data['husband_adhar_card']; ?>" id="husband_adhar_card_img" /></a>
                    <?php } ?>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
				<label for="item_name">Wife Photo (Optional)</label><div class="clearfix"></div>
                <div class="upload_div">
    	            <input type="file" name="wife_photo" class="remove_required" />
                </div>
                <?php if(!empty($patient_data['wife_photo'])){?>
                <a href="<?php echo $patient_data['wife_photo']; ?>" target="_blank"><img class="img_show" title="click to enlarge" src="<?php echo $patient_data['wife_photo']; ?>" id="wife_photo_img" /></a>
                <?php } ?>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
	           <label for="item_name">Husband Photo (Optional)</label><div class="clearfix"></div>
                <div class="upload_div">
    	            <input type="file" name="husband_photo" class="remove_required" />
                </div>
                <?php if(!empty($patient_data['husband_photo'])){?>
               <a href="<?php echo $patient_data['husband_photo']; ?>" target="_blank"><img class="img_show" title="click to enlarge" src="<?php echo $patient_data['husband_photo']; ?>" id="husband_photo_img" /></a>
               <?php } ?>
           </div>
         </div>
         
          <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife age (Optional)</label>
                <input value="<?php echo $patient_data['wife_age']; ?>" id="wife_age" name="wife_age" type="text" class="form-control validate in_field">
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband age (Optional)</label>
                <input value="<?php echo $patient_data['husband_age']; ?>" id="husband_age" name="husband_age" type="text" class="form-control validate in_field">
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife address (Optional) <span class="error">* Address as per adhaar</span></label>
                <textarea id="wife_address" name="wife_address" class="form-control validate in_field"><?php echo $patient_data['wife_address']; ?></textarea>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband address (Optional) <span class="error">* Address as per adhaar</span></label>
                <textarea id="husband_address" name="husband_address" class="form-control validate in_field"><?php echo $patient_data['husband_address']; ?></textarea>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Reason of visit (Required)</label>
                <textarea id="reason_of_visit" name="reason_of_visit" class="form-control validate" required><?php echo $data['reason_of_visit']; ?></textarea>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Billing source (Required)</label>
                <select name="billing_from" id="billing_from" required>
                    <option value="">Select</option>
                    <?php if(isset($_SESSION['logged_billing_manager'])){ $center = $all_method->get_center(); ?>
                    	<option value="<?php echo $center['center_number']; ?>" <?php if($data['billing_from'] == $center['center_number']){echo 'selected="selected"';}?>><?php echo $center['center_name']; ?></option>
                    <?php } ?>
                    <option value="IndiaIVF" <?php if($data['billing_from'] == 'IndiaIVF'){echo 'selected="selected"';}?>>IndiaIVF</option>       
                </select>
            </div>
         </div>
         
         <div class="row">            
            
              <div class="form-group col-sm-6 col-xs-12 hospital_id_section" style="display:none;">
               <label for="item_name">Hospital ID</label>
               <input value="" id="hospital_id" name="hospital_id" type="text" class="form-control validate">
            </div>
         </div>
         
         <hr />         
         <h4>Update billing details</h4>
         <hr />
         
         <div class="row">
		    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      		<div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Doctor (Required)</label>
                <select name="doctor_id" id="doctor_id" disabled required>
                    <option value="">Select</option>
                    <?php foreach($doctors as $key => $val){ ?>
                  		<option value="<?php echo $val['ID']; ?>" doc="Dr. <?php echo $val['name']; ?>" <?php if($val['ID'] == $data['doctor_id']){echo 'selected="selected"';}?>>Dr. <?php echo $val['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Billing date </label>
                <p><?php echo $data['on_date']; ?></p>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number</label>
                <p><?php echo $data['receipt_number']; ?></p>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Consultation fees (Required)</label>
                 <input value="<?php echo $data['totalpackage']; ?>" name="totalpackage" placeholder="Consultation fees" readonly="readonly" class="dhee" id="fees" type="hidden" class="form-control validate" required>
                 <input value="<?php echo $data['fees']; ?>" placeholder="Consultation fees" readonly="readonly" id="after_discount" name="fees" type="text" class="form-control validate" required>
           </div>
         </div>
     
         
         <div class="row">
         	 <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Payment discount (Required)</label>
                <select id="payment_discount" required>
               		<option value="">Select</option>
                    <option value="free" <?php if($data['fees'] == 0){ echo 'selected="selected;"'; } ?>>Free</option>
               		<option value="discount" <?php if($data['discount_amount'] > 0){ echo 'selected="selected;"'; } ?>>Discount</option>
                    <option value="no discount" <?php if($data['discount_amount'] == 0){ echo 'selected="selected;"'; } ?>>No discount</option>
                </select>
            </div>
         </div>
        
        <?php
			 
		 $show_div='style="display:none;"'; if($data['discount_amount'] > 0){$show_div = 'style="display:block;"';} ?>
        <div class="row" id="discount_avail" <?php echo $show_div; ?>>
            <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Discount amount (Required)</label>
               
               <input <?php echo $readonly; ?> value="<?php echo $data['discount_amount']; ?>" placeholder="Discount amount" id="discount_amount" name="discount_amount" type="text" class="form-control validate">
               <input value="<?php echo $_SESSION['logged_billing_manager']['allow_discount_rs'];?>" id="allow_discount" type="hidden" class="form-control validate" required>
               <p id="show_disc_app" class="error" style="display:none;">Given discount is more than allowed<!--, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_billing_manager']['username'];?>" id="get_discount_approval">click here</a> for admin approval-->.</p> 
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
           		<div id="center_share_div">
                <label for="item_name">Reason of discount(Required)</label>
                <input value="<?php echo $data['reason_of_discount']; ?>" placeholder="Reason of discount" id="reason_of_discount" name="reason_of_discount" type="text" class="form-control validate">
                </div>
           </div>
         </div>

         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Payment mode (Required)</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="">Select</option>
                   	<?php if($patient_data['nationality'] == 'indian'){?>
               		<option value="neft" <?php if($data['payment_method'] == 'neft'){ echo 'selected="selected;"'; } ?> mode="NEFT">NEFT</option>
               		<option value="rtgs" <?php if($data['payment_method'] == 'rtgs'){ echo 'selected="selected;"'; } ?> mode="RTGS">RTGS</option>
               		<option value="cash" <?php if($data['payment_method'] == 'cash'){ echo 'selected="selected;"'; } ?> mode="Cash">Cash</option>
                    <option value="upi" <?php if($data['payment_method'] == 'upi'){ echo 'selected="selected;"'; } ?> mode="UPI">UPI</option>
                    <option value="cheque" <?php if($data['payment_method'] == 'cheque'){ echo 'selected="selected;"'; } ?> mode="Cheque">Cheque</option>
               		<option value="card" <?php if($data['payment_method'] == 'card'){ echo 'selected="selected;"'; } ?> mode="Card">Card</option>
               		<option value="insurance" <?php if($data['payment_method'] == 'insurance'){ echo 'selected="selected;"'; } ?> mode="Insurance">Insurance</option>
                    <?php }else{ ?>
                    <option value="cheque" <?php if($data['payment_method'] == 'cheque'){ echo 'selected="selected;"'; } ?> mode="Cheque">Cheque</option>
               		<option value="cash" <?php if($data['payment_method'] == 'cash'){ echo 'selected="selected;"'; } ?> mode="Cash">Cash</option>
                    <option value="international_card" <?php if($data['payment_method'] == 'international_card'){ echo 'selected="selected;"'; } ?> mode="International Card">International Card</option>
                    <?php } ?>
                </select>
            </div>
            
               <div class="form-group col-sm-6 col-xs-12" id="subvention_box" style="<?php if($data['payment_method'] == 'insurance'){ echo 'display:block;"'; }else{echo "display:none;";} ?>">
                    <label for="item_name">Subvention charges (Required)</label>
                    <input value="<?php echo $data['subvention_charges']; ?>" placeholder="Subvention charges" id="subvention_charges" name="subvention_charges" type="text" class="form-control validate" required>
               </div>
            
         </div>

          <div class="row">
            <div class="form-group col-sm-6 col-xs-12" id="transaction">
               <label for="item_name">Reference no. (Optional)</label>
               <input value="<?php echo $data['transaction_id']; ?>" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control validate">
               <label>Upload screenshot/document here</label>
               <input type="file" name="transaction_img" id="transaction_img" />
               <a href="<?php echo $data['transaction_img']; ?>" target="_blank"><img src="<?php echo $data['transaction_img']; ?>" class="img_show" id="transaction_img_src" /></a>
            </div>
          </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment received (Required)</label>
                <input value="<?php echo $data['payment_done']; ?>" placeholder="Payment received" id="payment_done" name="payment_done" type="number" class="form-control validate" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Remaining amount (Required)</label>
               <input value="<?php echo $data['remaining_amount']; ?>" placeholder="Remaining amount" readonly="readonly" id="remaining_amount" name="remaining_amount" type="text" class="form-control validate" required>
           </div>
         </div>
        
         
         
          <div class="row">
	        <?php if($data['billing_from'] != 'IndiaIVF'){?>
                <div class="form-group col-sm-6 col-xs-12">
                   <label for="item_name">Billing ID</label>
                   <input value="<?php echo '';?>" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control validate">
                </div>
            <?php } ?>
            <div class="form-group col-sm-6 col-xs-12 role">
               <label for="item_name">Consultation ID</label>
               <select id="consultation_id" name="consultation_id" required>
               		<option value="">Consultation ID</option>
                    <?php echo $all_method->get_code('consultation');?>
               </select>
            </div>
         </div>
         <?php if($discound_applied > 0){ ?>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12 role">
               <div class="form-group col-sm-8 col-xs-12 role no-pad">
                <input value="" placeholder="Discount code" id="discount_code" name="discount_code" type="text" class="form-control validate">
                <img class="remove_code" style="display:none;" src="<?php echo base_url('assets/images/close-icon.png');?>" />
                <p id="code_msg" style="display:none;"></p>
               </div>
               <div class="form-group col-sm-4 col-xs-12 role">
                <a href="javascript:void(0)" id="apply_discount" class="btn btn-warning">Apply</a>
               </div>
            </div>
         </div>
        <?php } ?> 
      </div>
		    </div>
	     </div>
         
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
	        <input type="submit" id="create_billing" class="btn btn-large" value="Create Billing" />
         </div>
         </div>
         
        </p>
      </div>
    </div>
</form>

<script>
     $(document).on('keyup',"#subvention_charges",function(e) {
		$('#payment_done').val('');
		$('#remaining_amount').val('');	
		var subvention_charges = $(this).val();
		var fees = parseFloat($('.dhee').val());
		var discount = parseFloat($('#discount_amount').val());
		fees = (parseFloat(fees) - parseFloat(discount));
		console.log(fees+"-----------"+subvention_charges);
		if(subvention_charges != ""){
			var subvention = (parseFloat(subvention_charges) + parseFloat(fees));
			$('#after_discount').val(parseFloat(subvention));
		}else{
			$('#after_discount').val(parseFloat(fees));
		}
     });
     
   $(document).on('keyup',"#discount_code",function(e) {
		$('#code_msg').hide();
		$('#apply_discount').show();
   		var code = $(this).val();
		if(code != ''){ $('.remove_code').show(); }else{ $('.remove_code').hide(); }
		if(code.length == 8){ $("#apply_discount").click();}else{$('#submitbutton').hide();}
   });
   $(document).on('click',".remove_code",function(e) {
		$('#discount_code').attr('readonly', false);
		$('#code_msg').hide();
		var fees = $('#fees').val();
		$('#after_discount').empty().val(fees);
   		$('#discount_code').val('');
		
		$('#discount_amount').val('');
		$('#discount_amount').prop('readonly', false);
		if($("#payment_discount").val() == 'discount'){ $('#submitbutton').hide();}
		$('#apply_discount').show();
		$('#show_disc_app').hide();
		$(this).hide();
   });
   $(document).on('click',"#apply_discount",function(e) {
		$('#discount_code').attr('readonly', true);
		$('#code_msg').hide();
   		$('#loader_div').show();
        var discount_code = $('#discount_code').val();
		if(discount_code != ''){
			$.ajax({
				url: '<?php echo base_url('billings/check_discount_code')?>',
				data: {discount_code : discount_code,patient_id:<?php echo $patient_id; ?>,receipt_number:<?php echo $data['receipt_number']; ?>,type:'consultation'},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					if(data.status == 1){
						var amount = data.amount;
						var fees = $('#fees').val();
						var actual = parseFloat(fees)-parseFloat(amount);
						$('#discount_amount').empty().val(amount);
						$('#discount_amount').prop('readonly', true);
						$('#after_discount').empty().val(actual);
						$("input#payment_done").val('');
						$("input#remaining_amount").val('');
						$('#code_msg').empty().append(data.message);
						$("#payment_method").prop("selectedIndex", 0);
						$('#transaction_img_src').hide();
						$('#transaction_id').val('');
						//show_disc_app
						$('#show_disc_app').hide();
						$('#apply_discount').hide();
						$('#submitbutton').show();
					}else{
						$('#code_msg').empty().append(data.message);
					}
					$('#code_msg').show();
					$('#loader_div').hide();
				} 
		   });
	  }$('#loader_div').hide();
    });

   // Doctor fees
   $(document).on('change',"#doctor_id",function(e) {
   		$('#loader_div').show();
		$('#code_msg').hide();
		$('#apply_discount').show();
		$('#discount_code').val('');
		$('.remove_code').hide();
		
        $('#msg_area').empty();
	    $('#fees').empty();
		$("#payment_discount").prop("selectedIndex", 0);
		$("#payment_method").prop("selectedIndex", 0);
		$('#transaction_img_src').hide();
		$('#transaction_id').val('');
		$('#payment_done').val('');
		$('#discount_amount').val('');
		$('#remaining_amount').val('');
		$('#after_discount').empty();	
		$('#show_disc_app').hide();
        var doctor_id = $(this).val();
		if(doctor_id != ''){
			$.ajax({
				url: '<?php echo base_url('billings/doctor_fees')?>',
				data: {doctor_id : doctor_id, biller_id:<?php echo $_SESSION['logged_billing_manager']['employee_number']?>,patient_id:<?php echo $patient_id; ?>},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('#fees').val(parseFloat(data.fees));
					$('#after_discount').val(parseFloat(data.fees));
					get_allowed_discount();
					$('#loader_div').hide();
				} 
		   });
	  }
    });
	<?php if($discound_applied > 0){ ?>
		get_allowed_discount();
	<?php } ?>
	//get allowed discount on load
	function get_allowed_discount(){
			var doctor_id = $('#doctor_id').val();
			$.ajax({
				url: '<?php echo base_url('billings/doctor_fees')?>',
				data: {doctor_id : doctor_id, biller_id:<?php echo $_SESSION['logged_billing_manager']['employee_number']?>,patient_id:<?php echo $patient_id; ?>},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('#allow_discount').empty().val(parseFloat(data.allowed_discount));
				} 
		   });
		   
		   var discount_amount = $('#discount_amount').val();
		   var allow_discount = $('#allow_discount').val();
		   if(discount_amount > allow_discount){
				$('#submitbutton').hide();
		   		$('#show_disc_app').show();
		   }
	}
	
   // discount calculation
   $(document).on('change',"#payment_discount",function(e) {
          
		$('#subvention_charges').val("");
		$('#subvention_charges').prop('required', false);
          $('#subvention_box').hide();

		$('#code_msg').hide();
		$('#apply_discount').show();
		$('#discount_code').val('');
		$('.remove_code').hide();
		
   		$('#show_disc_app').hide();
		$("input#after_discount").val($("input#fees").val());
		$("input#payment_done").val('');
		$("input#remaining_amount").val('');
		$("input#discount_amount").val('');
		$("input#reason_of_discount").val('');
		$("#payment_method").prop("selectedIndex", 0);
		$('#transaction_img_src').hide();
		$('#transaction_id').val('');
		$("input#discount_amount").prop('required',false);
		$("input#reason_of_discount").prop('required',false);
		$('#discount_avail').hide();
		if($(this).val() == 'discount'){
			$("input#discount_amount").prop('required',true);
			$("input#reason_of_discount").prop('required',true);
			$('#discount_avail').show();
		}else if($(this).val() == 'free'){
               $("#free_reason").prop('required', true);
               $("#free_reason_box").show();
               $("#payment_method").prop('required',false);
               $("#transaction_id").prop('required',false);
			$("#after_discount").val(0);
			$('#payment_done').val(0);
			$('#remaining_amount').val(0);
               $('#submitbutton').show();
		}else{
			$('#submitbutton').show();
		}
	});
	
     $(document).on('keyup',"#discount_amount",function(e) {
          var subvention_charges = 0;
          if($("#payment_method").val() == "insurance"){
               subvention_charges = parseFloat($("#subvention_charges").val());
               if(subvention_charges == ""){  subvention_charges = 0; }
          }

		$('#payment_done').val('');
		$('#remaining_amount').val('');
		var fees = parseFloat($('#fees').val());
          var new_fees = (fees + subvention_charges);
		var allowd = parseFloat($('#allow_discount').val());
		var discount_amount = parseFloat($(this).val());
          var after_cal_price = ( new_fees * allowd / 100 ).toFixed(2);
		discount_amount = (discount_amount)?discount_amount:0;
		if(discount_amount == ''){ $(this).val(""); discount_amount = 0;}
   
          //console.log(discount_amount+' ----- '+after_cal_price);
 		//console.log(fees+' ----- '+allowd+' ----- '+discount_amount+' -------- '+after_cal_price+' -------- '+subvention_charges);
		if(discount_amount > after_cal_price){
				$('#fees').val('');
				$('#fees').val(parseFloat(fees));
				$('#after_discount').val(parseFloat(new_fees));
				$('#create_billing').hide();
				$('#show_disc_app').show();				
		}else{
		     if(parseFloat(discount_amount) <= parseFloat(after_cal_price)){
                    var listPrice = parseFloat(new_fees);
                    var discount  = parseFloat(discount_amount);
                    
                    console.log(listPrice+' ----- '+discount);
                    //var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));
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
   // payment process
   $(document).on('change',"#payment_method",function(e) {
          $('#payment_done').val('');
		$('#remaining_amount').val('');	
		
		$('#subvention_charges').val("");
		$('#subvention_charges').prop('required', false);
          $('#subvention_box').hide();
          
		$('#transaction_img_src').hide();
		$('#transaction_id').val('');
		var method = $(this).val();
		if(method == ''){
			 $('#transaction_id').prop('required',false);
			 $('#transaction_img').prop('required',false);
			 $('#transaction').hide();		
		}else{
			 $('#transaction_id').prop('required',false);
			 $('#transaction_img').prop('required',false);
			 $('#transaction').show();
          }		
          if(method == "insurance"){
			$('#subvention_charges').prop('required', true);
			$('#subvention_box').show();
		}
		cal_billing_cost();
    });	

    function cal_billing_cost(){
		var fees = $(".dhee").val();
		var discunt = $("#discount_amount").val();

		var total = parseFloat(fees) - parseFloat(discunt);
		$("#after_discount").val(total.toFixed(2));
	}

   $(document).on('keyup',"#payment_done",function(e) {
		$('#remaining_amount').empty();
		
		var fees = $('#after_discount').val();
		var payment_done = $(this).val();
		var remaining_amount = fees-payment_done;
		$('#remaining_amount').val(remaining_amount+' ');
    });
</script>