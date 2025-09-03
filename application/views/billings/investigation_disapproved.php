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
<?php $all_method =&get_instance();
	  $patient_id = $data['patient_id'];
	  $investigation_data = unserialize($data['investigations']);
	  $patient_data = $all_method->get_patient_details($patient_id);
	  $employee_data = get_employee_detail($_SESSION['logged_billing_manager']['username']);
	  $allowed_amount = 0;
	  $allowed_amount = $employee_data['allow_discount_rs'];
	//   if($patient_data['nationality'] == 'indian'){
	//   	$allowed_amount = $employee_data['allow_discount_rs'];
	//   }else{
	//   	$allowed_amount = $employee_data['allow_discount_us'];
	//   }
	 /*
		  var_dump($data);
		  echo '<br/><br/>-------------------------<br/><br/>';
		  var_dump($investigations);
		  echo '<br/><br/>-------------------------<br/><br/>';
		  var_dump($patient_data);
		  die;
	  */
?>
<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url();?>billings/disapproved/<?php echo $data['receipt_number']?>?t=<?php echo $_GET['t'];?>" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="update_disapproved_billing" />
    <input type="hidden" name="type" value="investigation" />
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>" id="patient_id" />
    <input type="hidden" name="receipt_number" value="<?php echo $data['receipt_number']; ?>" id="receipt_number" />
    
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
         <!--Patient details -->
         <div class="row">
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
			   <a href="<?php echo $patient_data['husband_photo']; ?>" target="_blank"><img class="img_show" title="click to enlarge" src="<?php echo $patient_data['husband_photo']; ?>" id="husband_photo_img" /></a>\
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
                <textarea id="reason_of_visit" name="reason_of_visit" class="form-control validate"><?php echo $data['reason_of_visit']; ?></textarea>
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
         
         </div>
         <!--Patient details -->
         <!--Billing details -->
         <hr />         
         <h4>Update billing details</h4>
         <hr />
         
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
                <input value="<?php echo $data['paramedic_name']; ?>" placeholder="Paramedic Name" id="paramedic_name" name="paramedic_name" type="text" class="form-control validate" required>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Billing date(Required)</label>
                <p><?php echo $data['on_date'];?></p>
           </div>
         </div>
         
         
         <div class="row invastigatiton_table">
              <table>
                <thead>
                    <tr>
                        <th>Investigations</th>
                        <th>Code</th>
                        <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        <th>Discount amount</th>
                    </tr>
                </thead>
                <tbody id="investigation_table_body">
                    <?php $i=1;
						$readonly = '';
						if($discound_applied > 0){
							$readonly = ' readonly="readonly"';
						}
						foreach($investigation_data['male_investigation'] as $key => $val){ //var_dump($val);die; ?>
							<tr class="investigation_row_<?php echo $i; ?>"  trcount="<?php echo $i; ?>">
								<td class="role">
									<?php echo $all_method->get_investigation_name($val['male_investigation_name']); ?>
								</td>
								<td><?php echo $val['male_investigation_code']; ?></td>
								<td><?php echo $val['male_investigation_price']; ?></td>
								<!-- <td><?php echo $val['male_investigation_discount']; ?></td> -->
								<td><input value="<?php echo $val['male_investigation_discount']?>" placeholder="Discount" id="male_investigation_discount" class="investigation_discount required_value" type="text" class="form-control" required></td>
							</tr>
					<?php $i++;} ?>
					<?php $i=1;
						$readonly = '';
						if($discound_applied > 0){
							$readonly = ' readonly="readonly"';
						}
						foreach($investigation_data['female_investigation'] as $key => $val){ //var_dump($val);die; ?>
							<tr class="investigation_row_<?php echo $i; ?>"  trcount="<?php echo $i; ?>">
								<td class="role">
									<?php echo $all_method->get_investigation_name($val['female_investigation_name']); ?>
								</td>
								<td><?php echo $val['female_investigation_code']; ?></td>
								<td><?php echo $val['female_investigation_price']; ?></td>
								<td><input value="<?php echo $val['female_investigation_discount']?>" placeholder="Discount" id="female_investigation_discount" class="investigation_discount required_value" type="text" class="form-control" required></td>

								
							</tr>
					<?php $i++;} ?>
                </tbody>
            </table>
         </div>
         
         
         <div class="row">  
		 	<div class="form-group col-sm-12 col-xs-12">
				<label>Paid In</label>
				<h4>
					<?php if($data['payment_in'] == 'rs_payment'){
						echo 'In Rupee';
					}else {
						echo 'In USD';
					} ?>
				</h4>
			</div>          
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <p><?php echo $data['receipt_number'];?></p>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Investigation fees (Required)</label>
                <input value="<?php echo $data['totalpackage']; ?>" name="totalpackage" placeholder="Investigation fees" readonly="readonly" class="dhee" id="fees" type="hidden" class="form-control validate" required>
                <input value="<?php echo $data['fees']; ?>" placeholder="Investigation fees" readonly="readonly" name="fees" id="after_discount" type="text" class="form-control validate" required>
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
					<option value="upi" <?php if($data['payment_method'] == 'upi'){ echo 'selected="selected;"'; } ?> mode="UPI">UPI</option>
               		<option value="cash" <?php if($data['payment_method'] == 'cash'){ echo 'selected="selected;"'; } ?> mode="Cash">Cash</option>
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
               <label for="item_name">Reference no. (Required)</label>
               <input value="<?php echo $data['transaction_id']; ?>" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control validate" required>
               <label>Upload screenshot/document here</label>
               <input type="file" name="transaction_img" id="transaction_img"  />
               <a href="<?php echo $data['transaction_img']; ?>" target="_blank"><img src="<?php echo $data['transaction_img']; ?>" class="img_show" id="transaction_img_src" /></a>
            </div>
         </div>
         
         <div class="row">            
         	<div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Discount amount</label>
               <input value="<?php echo $data['discount_amount']; ?>" placeholder="Discount amount" id="discount_amount" readonly="readonly" name="discount_amount" type="text" class="form-control validate" required>
               <input value="<?php echo $_SESSION['logged_billing_manager']['allow_discount_rs'];?>" id="allow_discount" type="hidden" class="form-control validate" required>
               <p id="show_disc_app" class="error" style="display:none;">Given discount is more than allowed<!--, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_billing_manager']['username'];?>" id="get_discount_approval">click here</a> for admin approval-->.</p>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment received (Required)</label>
                <input value="<?php echo $data['payment_done']; ?>" placeholder="Payment received" id="payment_done" name="payment_done" type="number" class="form-control validate" required>
           </div>
         </div>   
         
         <div class="row">
           <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Remaining amount (Required)</label>
               <input value="<?php echo $data['remaining_amount']; ?>" placeholder="Remaining amount" readonly="readonly" id="remaining_amount" name="remaining_amount" type="text" class="form-control validate" required>
           </div>
           
         </div>
         
         <div class="row">
         <?php if($data['billing_from'] != 'IndiaIVF'){?>
            <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Billing ID</label>
               <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control validate">
            </div>
           <?php } ?>
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
      </p>
    </div>
  </div>
         <!--Billing details -->
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
	        <input type="submit" id="submitbutton" class="btn btn-large" value="Create Billing" />
         </div>
         </div>
         
        </p>
      </div>
    </div>
</form>

<script type="text/javascript">
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
		$('#code_msg').hide();
		var fees = $('#fees').val();
		$('#after_discount').empty().val(fees);
   		$('#discount_code').val('');
		$('#discount_amount').val('0 ');
		if($("#payment_discount").val() == 'discount'){ $('#submitbutton').hide();}
		$("#payment_method").prop("selectedIndex", 0);
		$('#transaction_img_src').hide();
		$('#transaction_id').val('');
		$('#discount_code').attr('readonly', false);
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
				data: {discount_code : discount_code,patient_id:<?php echo $patient_id; ?>,receipt_number:<?php echo $data['receipt_number']; ?>,type:'investigation'},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					if(data.status == 1){
						var amount = data.amount;
						var fees = $('#fees').val();
						var actual = parseFloat(fees)-parseFloat(amount);
						$('#discount_amount').empty().val(amount);
						$('#after_discount').empty().val(actual);
						$("input#payment_done").val('');
						$("input#remaining_amount").val('');
						$('#code_msg').empty().append(data.message);
						$("#payment_method").prop("selectedIndex", 0);
						$('#transaction_img_src').hide();
						$('#transaction_id').val('');
						$('.investigation_discount').val('0 ');
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
	<?php if($discound_applied > 0){ ?>
		get_allowed_discount();
	<?php } ?>
	//get allowed discount on load
	function get_allowed_discount(){
		   var discount_amount = $('#discount_amount').val();
		   var allow_discount = <?php echo $allowed_amount?>;
		   $('#allow_discount').empty().val(parseFloat(allow_discount));
		   if(discount_amount > allow_discount){
				$('#submitbutton').hide();
		   		$('#show_disc_app').show();
		   }
	}
	
    $(document).ready(function(){
        $(".add-row").click(function(){
			$('#code_msg').hide();
			$('#apply_discount').show();
			$('#discount_code').val('');
			$('.remove_code').hide();
		
			var rows= $('#investigation_table_body tr:last').attr('trcount');
			var count = parseFloat(rows) + 1;
			console.log('count-------'+rows);
            var markup = '<tr class="investigation_row_'+count+'" trcount="'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td class="role"><select count="'+count+'" name="investigation_name_'+count+'" class="investigation_select" id="investigation_name_'+count+'" required><option value="">Select</option><?php foreach($investigations as $key => $val){ ?><option value="<?php echo $val['ID']; ?>" fees="<?php echo $val['price']; ?>" invest="<?php echo $val['investigation']; ?>"> <?php echo $val['investigation']; ?></option><?php } ?></select></td><td><input value="" placeholder="Code" readonly="readonly" class="investigation_code" id="investigation_code_'+count+'" name="investigation_code_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Price" readonly="readonly" class="investigation_price" id="investigation_price_'+count+'" name="investigation_price_'+count+'" type="text" class="form-control validate" required></td><td><input value="0" placeholder="Discount" id="investigation_discount_'+count+'" class="investigation_discount" name="investigation_discount_'+count+'" type="text" class="form-control validate" required></td></tr>';
            $("table tbody").append(markup);
			add_delete_method();
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
			$('#code_msg').hide();
			$('#apply_discount').show();
			$('#discount_code').val('');
			$('.remove_code').hide();
			
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
			add_delete_method();
        });
    });    
	
	function add_delete_method(){
		$('#after_discount').val(fee_total);
		$('.investigation_discount').val(0);
		$('#discount_amount').val(0);
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		$('#transaction_id').val('');
		$('#transaction').hide();
		$('#transaction_img_src').attr('src', '');
		$('#payment_method').prop('selectedIndex',0);	
		var fee_total = 0;
		$('.investigation_price').each(function(){
			var price_total = 0;
			var price_total = $(this).val();
			fee_total += +price_total;
		});
		console.log(fee_total);
		$('.dhee').val(fee_total);
	}
</script>

<script>
   // discount calculation
   $(document).on('change',"#payment_discount",function(e) {
		$("input#after_discount").val($("input#fees").val());
		$("input#payment_done").val('');
		$("input#remaining_amount").val('');
		$("input#discount_amount").val(0);
		$("input#reason_of_discount").val('');
		$("input#discount_amount").prop('required',false);
		$("input#reason_of_discount").prop('required',false);
		$('#discount_avail').hide();
		if($(this).val() == 'discount'){
			$("input#discount_amount").prop('required',true);
			$("input#reason_of_discount").prop('required',true);
			$('#discount_avail').show();
		}else if($(this).val() == 'free'){
			$("#after_discount").val(0);
			$('#payment_done').val(0);
			$('#remaining_amount').val(0);
		}
	});
	
  /* $(document).on('keyup',"#discount_amount",function(e) {
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		var fees = parseFloat($('#fees').val());
		var allowd = parseFloat($('#allow_discount').val());
		var discount_amount = parseFloat($(this).val());
		discount_amount = (discount_amount)?discount_amount:0;
		if(discount_amount == ''){ $(this).val(0); }
 		console.log(fees+' ----- '+allowd+' ----- '+discount_amount);
		if(parseFloat(discount_amount) > allowd){
				$('#fees').val('');
				$(this).val('');				
				$('#fees').val(parseFloat(fees));
				$('#after_discount').val(parseFloat(fees));
				$('#show_disc_app').hide();
		}else{
			if(parseFloat(discount_amount) <= parseFloat(allowd)){
				$('#show_disc_app').hide();
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
				}else{console.log(remaining_amount);
					$('#after_discount').val(parseFloat(remaining_amount));
				}
			}
			else{
				$('#fees').val(parseFloat(fees));
				$('#after_discount').val(parseFloat(fees));
				$('#show_disc_app').show();
			}
		}
    });	*/
   // payment process
   $(document).on('change',"#payment_method",function(e) {
		$('#payment_done').val('');
		$('#remaining_amount').val('');	

		$('#subvention_charges').val("");
		$('#subvention_charges').prop('required', false);
		$('#subvention_box').hide();
        $('#transaction_id').empty();
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
   $(document).on('keyup',"#payment_done",function(e) {
		$('#remaining_amount').empty();
		var fees = $('#after_discount').val();
		var payment_done = $(this).val();
		var remaining_amount = fees-payment_done;
		$('#remaining_amount').val(remaining_amount);
    });
	
	$(document).on('keyup',".investigation_discount",function(e) {
			var given_discount = 0;
			var count = 1;
			$('.investigation_discount').each(function(){
				//var price = $('#investigation_price_'+count).val();
				var dicount_amount = $(this).val();
				//var dicount_amount = (price/100)*discount;
				//var dicount_amount = price - discount;
				given_discount+= +parseFloat((dicount_amount || 0));
				count++;
			});
			//var main_total = $('#fees').val();
			//var grand_discount = (given_discount/main_total)*100;
			///var grand_discount = main_total - given_discount;
			$('#discount_amount').val(given_discount.toFixed(2));
			<?php if($discound_applied == 0){ ?>
			cal_discount();
			<?php } ?>
	});
	

	
    $(document).on('change',".investigation_select",function(e) {
		$('#code_msg').hide();
		$('#apply_discount').show();
		$('#discount_code').val('');
		$('.remove_code').hide();
		$('.investigation_discount').val('0 ');
		$('#discount_amount').val('0 ');
        $('#msg_area').empty();
		var investigation_id = $(this).val();
		var investigation_count = $(this).attr('count');
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		$('.dhee').val('');
	    $('#investigation_price_'+investigation_count).val('');		
		if(investigation_id != ''){
			$.ajax({
				url: '<?php echo base_url('billings/investigation_price')?>',
				data: {investigation_id : investigation_id, patient_id:<?php echo $patient_id; ?>, biller_id:<?php echo $_SESSION['logged_billing_manager']['employee_number']?>},
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
				} 
		   });	
	  }
	  <?php if($discound_applied == 0){ ?>
		  cal_discount();
	  <?php } ?>
    });
	
	function cal_discount(){
		$('#subvention_charges').val("");
		$('#subvention_charges').prop('required', false);
		$('#subvention_box').hide();

		$('#payment_done').val('');
		$('#remaining_amount').val('');
		$('#subvention_charges').val('');
		$("#subvention_box").hide();
		$('#subvention_charges').prop("required", false);
		
		var fees = $('.dhee').val();
		var allowd = $('#allow_discount').val();
		var discount_amount = $("#discount_amount").val();
		

		$('#givn_disc').empty();
   		$('#givn_disc').val(discount_amount);
		
		var after_cal_price = 0;
		after_cal_price = ( fees * allowd / 100 ).toFixed(2);

		if(discount_amount > after_cal_price){
			console.log(discount_amount+'--------------'+after_cal_price);
			$('#after_discount').val(parseFloat(fees));
			$('#show_disc_app').show();
			$('#submitbutton').hide();
		}else{
			$("#payment_method").prop("selectedIndex", 0);
			$('#transaction_img_src').hide();
			$('#transaction_id').val('');
			var listPrice = parseFloat(fees);
			var discount  = parseFloat(discount_amount);
			<!--var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));-->
			var remaining_amount =  listPrice - discount;
			if(remaining_amount < 1){console.log('2323re');
				$('#payment_done').val('');
				$('#after_discount').val('');
				$("#discount_amount").val('');
				$('.investigation_discount').val('');
				$('#show_disc_app').hide();
				$('#submitbutton').hide();
			}else{console.log('2323r23323e');
				$('#after_discount').val(remaining_amount.toFixed(2));
				$('#submitbutton').show();
				$('#show_disc_app').hide();
			}
		}
	};
	
	function cal_billing_cost(){
		var fees = $(".dhee").val();
		var discunt = $("#discount_amount").val();

		var total = parseFloat(fees) - parseFloat(discunt);
		$("#after_discount").val(total.toFixed(2));
	}
</script>

