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
	  $procedure_data = unserialize($data['data']);
	  $procedure_hist = unserialize($procedure_history);
	  $patient_data = $all_method->get_patient_details($patient_id);
	  $employee_data = get_employee_detail($_SESSION['logged_billing_manager']['username']);
	  $allowed_amount = 0;
	  if($patient_data['nationality'] == 'indian'){ $allowed_amount = $employee_data['allow_discount_rs']; }else{ $allowed_amount = $employee_data['allow_discount_us']; }	 
	/*  var_dump($data);

	  echo '<br/><br/>-------------------------<br/><br/>';

	  var_dump($procedure_data);

	  echo '<br/><br/>-------------------------<br/><br/>';

	  var_dump($patient_data);

	  die;*/
?>

<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url();?>billings/disapproved/<?php echo $data['receipt_number']?>?t=<?php echo $_GET['t'];?>" enctype="multipart/form-data" >

    <input type="hidden" name="action" value="update_disapproved_billing" />

    <input type="hidden" name="type" value="procedure" />

    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>" id="patient_id" />

    <input type="hidden" name="receipt_number" value="<?php echo $data['receipt_number']; ?>" id="receipt_number" />

    <div class="row">

      <div class="col-sm-12 col-xs-12 panel panel-piluku">

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

         <!--Billing details -->

         <hr />         

         <h3 class="heading">Edit disapproved billing</h3>

         <hr />

         

         <div class="row">

    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details">

      <div class="panel-heading">

        <h3 class="heading">History</h3>

      </div>
	  
	  
		<section class="col-sm-12 col-xs-12">
                <div class="clearfix"></div>
                <table>
                    <thead>
                        <tr>
                            <th>Procedure</th>
                            <th>Code</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                            <th>Discount amount</th>
							<th>Paid Price</th>
                        </tr>
                    </thead>
                    <tbody id="">
					<?php $cont = 1; 
						foreach($procedure_hist['patient_procedures'] as $key => $val){ //var_dump($val);die;
								$prod_name = $all_method->get_procedure_name($val['sub_procedure']);
						?>
						<tr>
                            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $procedure_hist['patient_procedures'][$key]['sub_procedure']; ?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $procedure_hist['patient_procedures'][$key]['sub_procedures_code']; ?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $procedure_hist['patient_procedures'][$key]['sub_procedures_price']; ?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $procedure_hist['patient_procedures'][$key]['sub_procedures_discount']; ?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $procedure_hist['patient_procedures'][$key]['sub_procedures_paid_price']; ?></td>
						
						</tr>
						<?php } ?>
				    </tbody>
                </table>
				
				<table>
                    <thead>
                        <tr>
                            <th>Old Package Form</th>
                            <th>Reason</th>
                            <th>Update Date</th>
                        </tr>
                    </thead>
                    <tbody id="">
						<tr>
                            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><input id="package_form_old" name="package_form_old" value="<?php echo $data['package_form']; ?>" type="hidden" class="form-control"><a href="<?php echo $data['package_form']; ?>" target="_blank"><img src="<?php echo $data['package_form']; ?>" class="img_show" /></a></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_disapprove']; ?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $data['modified_on']; ?></td>
						</tr>
					</tbody>
                </table>
		</section>

      <div class="panel-body profile-edit">

     	<p id="msg_area" class="delete"></p>

        <p>

        	<!-- <div class="procedure_lists col-sm-4 col-xs-12 col-md-4 role pull-right">

            	<label>Select Procedure</label>

            	<select name="procedure_parent" class="procedure_parent" id="procedure_parent" required>

	                <option value="">Select</option>

                    <?php foreach($procedure as $key => $val){ ?>

                     	<option value="<?php echo $val['ID']; ?>" <?php if($val['ID'] == $data['procedure_parent']){echo 'selected="selected"';}?> code="<?php echo $val['code']; ?>" fees="<?php echo $val['price']; ?>" procedure="<?php echo $val['procedure_name']; ?>"> <?php echo $val['procedure_name']; ?></option>

                    <?php } ?>

                </select>

            </div> -->

            <div class="clearfix"></div>

            <hr />

            <div id="main_div">

              <section class="col-sm-12 col-xs-12 sub_procedures_section">

                  <h4 class="heading">Patient Procedure</h4>

                  <div class="clearfix"></div>

					<input type="button" class="add-sub_procedures-row btn btn-large" value="Add Procedure">

					<input type="button" class="delete-sub_procedures-row btn btn-large" value="Delete Procedure">
				  
					<textarea id="procedure_history" name="procedure_history" style="height:100px!important;"><?php echo $data['data']; ?></textarea>

                 	<div class="form-group col-sm-12 col-xs-12 pull-right">

                        <label for="item_name">Package form(Required)</label>

                        <input id="package_form" name="package_form" type="file" class="form-control">

                        <a href="<?php echo $data['package_form']; ?>" target="_blank"><img src="<?php echo $data['package_form']; ?>" class="img_show" /></a>

                    </div> 

                  <table>

                    <thead>

                        <tr>
                            <th></th>
                            <th>Procedure</th>

                            <th>Code</th>

                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>

                            <th>Discount amount</th>
							
							<th>Paid Price</th>

                        </tr>

                    </thead>

                    <tbody id="sub_procedures_table_body">

						<?php $cont = 1; 

							  $readonly = '';
							  if($discound_applied > 0){
								  $readonly = ' readonly="readonly"';
							  }
							  $currency = "";
						foreach($procedure_data['patient_procedures'] as $key => $val){//var_dump($val);die;
								$prod_name = $all_method->get_procedure_name($val['sub_procedure']);
								//var_dump($val);die;
						?>
						<tr>
                            <td><input type="checkbox" class="statuss" id="record"></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_procedure_name($val['sub_procedure']); ?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['sub_procedures_code']?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_price']?></td>
							<!-- <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_discount']?></td> -->
							<!--<td><input value="<?php echo $val['sub_procedures_discount']?>" placeholder="Discount" id="sub_procedures_discount" class="sub_procedures_discount required_value" type="text" class="form-control" required></td>-->
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['sub_procedures_discount']?></td>
						</tr>
						<?php } ?>

                    </tbody>

                </table>

                </section>

                <div class="clearfix"></div>

                <hr />

                

                <div class="row">

                   <div class="form-group col-sm-6 col-xs-12">

                        <label for="item_name">Procedure fees (Required)</label>

                        <input value="<?php echo $data['totalpackage']; ?>" name="totalpackage" placeholder="Procedure fees" readonly="readonly" class="dhee" id="fees" type="hidden" class="form-control validate" required>

                        <input value="<?php echo $data['fees']; ?>" placeholder="Procedure fees" readonly="readonly" id="after_discount" name="fees" type="text" class="form-control validate" required>

                   </div>

                   <div class="form-group col-sm-6 col-xs-12">

                     <label for="item_name">Discount amount(Required)</label>

                     <input placeholder="Discount amount" type="text" name="discount_amount" readonly="readonly" value="<?php echo $data['discount_amount']; ?>" id="discount_amount" />

              		 <input value="<?php echo $_SESSION['logged_billing_manager']['allow_discount_rs'];?>" id="allow_discount" type="hidden" class="form-control validate" required>

               <p id="show_disc_app" class="error" style="display:none;">Given discount is more than allowed<!--, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_billing_manager']['username'];?>" id="get_discount_approval">click here</a> for admin approval-->.</p> </div>

				 </div>

				 

				 <div class="row">

                   <div class="form-group col-sm-6 col-xs-12 role">
                        <label for="statuss">Payment mode (Required)</label>
                        <select name="payment_method" id="payment_method" required>
                            <option value="">Select</option>
                            <?php if($patient_data['nationality'] == 'indian'){?>
                            <option value="neft" <?php if($data['payment_method'] == 'neft'){ echo 'selected="selected;"'; } ?> mode="NEFT">NEFT</option>
							<option value="upi" <?php if($data['payment_method'] == 'upi'){ echo 'selected="selected;"'; } ?> mode="UPI">UPI</option>
                            <option value="rtgs" <?php if($data['payment_method'] == 'rtgs'){ echo 'selected="selected;"'; } ?> mode="RTGS">RTGS</option>
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

                       <label for="item_name">Reference no. (Optional)</label>

                       <input value="<?php echo $data['transaction_id']; ?>" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control validate" required>

                       <label>Upload screenshot/document here</label>

                       <input type="file" name="transaction_img" id="transaction_img"  />

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

                       <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control validate">

                    </div>

               <?php } ?>

                    <!--<div class="form-group col-sm-6 col-xs-12">

                            <div id="center_share_div">

	                            <label for="item_name">IIC Share(Required) <span class="success">*Share amount should be in number e.g. 1000</span></label>

    	                        <input value="" placeholder="Share amount" id="center_share" name="center_share" type="text" class="form-control validate" required>

                           </div>

         	 		   </div>-->

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

<div id="procedure_html" style="display:none;"></div>

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

		$('#submitbutton').hide();

		$('#code_msg').hide();

		$('.sub_procedures_discount').prop('required', true);

		var fees = $('#fees').val();

		$('#after_discount').empty().val(fees);

   		$('#discount_code').val('');

		$('#discount_amount').val('0 ');

		$("input#payment_done").val('');

		$("input#remaining_amount").val('');

		$("#payment_method").prop("selectedIndex", 0);

		$('img#transaction_img_src').hide();

		$('#transaction_id').val('');

		if($("#payment_discount").val() == 'discount'){ $('#submitbutton').hide();}

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

				data: {discount_code : discount_code,patient_id:<?php echo $patient_id; ?>,receipt_number:<?php echo $data['receipt_number']; ?>,type:'procedure'},

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

						$("#payment_method").prop("selectedIndex", 0);

						$('img#transaction_img_src').hide();

						$('#transaction_id').val('');

						$('#code_msg').empty().append(data.message);

						

						$('.sub_procedures_discount').val('0 ');

						$('.sub_procedures_discount').prop('required', false);

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



	$(document).on('keyup',".sub_procedures_discount",function(e) {	

			$('#discount_code').val('');

			$('.remove_code').hide();

			$('#apply_discount').show();

			$('#code_msg').empty().hide();

			

			var given_discount = 0;

			var count = 1;

			$('.sub_procedures_discount').each(function(){

				//var price = $('#sub_procedures_price_'+count).val();

				var discount = $(this).val();

				//var dicount_amount = (price/100)*discount;

				//var dicount_amount = price - discount;

				given_discount+= +parseFloat((discount || 0));

				count++;

			});

			

			//var main_total = $('#fees').val();

			<!--var grand_discount = (given_discount/main_total)*100;-->

			//var grand_discount = main_total - given_discount;

			console.log('grand_discount----------------------' + given_discount);

			$('#discount_amount').val(parseFloat(given_discount));

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

		var fees = parseFloat($('.dhee').val());

		var allowd = parseFloat($('#allow_discount').val());

		var after_cal_price = 0;



		var discount_amount = parseFloat($("#discount_amount").val());

		discount_amount = (discount_amount)?discount_amount:0;

		

		after_cal_price = ( fees * allowd / 100 ).toFixed(2);



		$("#payment_method").prop("selectedIndex", 0);

		$('#transaction_img_src').hide();

		$('#transaction_id').val('');

		$('#givn_disc').empty();

   		$('#givn_disc').val(parseFloat(discount_amount));

		

		if(parseFloat(discount_amount) > after_cal_price){

				$('#after_discount').val(parseFloat(fees));

				$('#show_disc_app').show();

				$('#submitbutton').hide();

		}else{

				var listPrice = parseFloat(fees);

				var discount  = parseFloat(discount_amount);

				<!--var remaining_amount =  (listPrice - ( listPrice * discount / 100 ));-->

				var remaining_amount =  listPrice - discount;

				if(remaining_amount < 1){

					$('#payment_done').val('');

					$('#after_discount').val('');

					$("#discount_amount").val('');

					$('.sub_procedures_discount').val('');

					$('#show_disc_app').hide();

					$('#submitbutton').hide();

				}else{

					$('#after_discount').val(remaining_amount);

					$('#show_disc_app').hide();

					$('#submitbutton').show();

				}

		}

    };

	

	$(document).on('change',"#procedure_parent",function(e) {

		$('#transaction_id').val('');

		$('a #transaction_img_src').attr('src', '');

		$('#transaction').hide();

		$('#payment_method').prop('selectedIndex',0);

	

        $('#procedure_html').empty();

		//$('#sub_procedure_1').val('');

		$('#parent_pocedure_name').val('');

		//$('#sub_procedures_code_1').val('');

		//$('#sub_procedures_price_1').val('');

		$('.nt_prnt').val('');



		$('.sub_procedures_discount').val('0 ');

        $('#msg_area').empty();

        $('#discount_amount').val('0 ');

		$('#payment_done').val('');

		$('#remaining_amount').val('');

		

		var parent_parents = $(this).val();

		if(parent_parents != ''){

			var procedure = $(this).find(':selected').attr('procedure');

			var code = $(this).find(':selected').attr('code');

			var fees = $(this).find(':selected').attr('fees');

			//$('#sub_procedure_1').val(parent_parents);

			//$('#sub_procedure_1').attr('value', parent_parents);

			$('#parent_pocedure_name').val(procedure);

			//$('#sub_procedures_code_1').val(code);

			//$('#sub_procedures_price_1').val(fees);

			

			$('.dhee').val(fees);

			$('#after_discount').val(fees);

			$.ajax({

				url: '<?php echo base_url('billings/get_sub_procedures')?>',

				data: {parent_parents : parent_parents, patient_id:<?php echo $patient_id; ?>, biller_id:<?php echo $_SESSION['logged_billing_manager']['employee_number']?>},

				dataType: 'json',

				method:'post',

				success: function(data)

				{

					$('#procedure_html').html(data.html);

					$('#allow_discount').empty().val(data.allowed_discount);

				} 

		   });
		   $('#main_div').show();
	  }else{
		   $('#main_div').hide();
	  }			
    });	
	

	$(document).ready(function(){

        $('#procedure_html').empty();		

		var parent_parents = $('#procedure_parent').find(':selected').attr('value');

		if(parent_parents != ''){

			$.ajax({

				url: '<?php echo base_url('billings/get_sub_procedures')?>',

				data: {parent_parents : parent_parents, patient_id:<?php echo $patient_id; ?>, biller_id:<?php echo $_SESSION['logged_billing_manager']['employee_number']?>},

				dataType: 'json',

				method:'post',

				success: function(data)

				{

					$('#procedure_html').html(data.html);

					$('#allow_discount').empty().val(data.allowed_discount);

				} 

		   });

	  }

	  
        var count = 1;
        $(".add-sub_procedures-row").click(function(){

			$('#code_msg').hide();

			$('#apply_discount').show();

			$('#discount_code').val('');

			$('.remove_code').hide();

			

			$('#fees').val($('#sub_procedures_price_1').val());

			$('#after_discount').val($('#sub_procedures_price_1').val());

			$('#payment_done').val('');

			$('#remaining_amount').val('');

			$('#discount_amount').val('0 ');

			$('.sub_procedures_discount').val('0 ');

			

			var rows= $('#sub_procedures_table_body tr:last').attr('trcount');

			//var count = 1;
			
			

			var sub_procedure_html = $('#procedure_html').html();
			
			

           var markup = '<tr class="sub_procedures_row_'+count+'" trcount="'+count+'"><td><input type="checkbox" class="statuss" rel="consumables" index="'+count+'" id="record"></td><td class="role cons_cls_'+count+'" id="sub_procd_td_'+count+'"><select name="sub_procedure_'+count+'" class="sub_procedure_select item_select select2 consumables_select" id="sub_procedure_'+count+'" count="'+count+'" required>'+sub_procedure_html+'</select></td> <td><input value="" placeholder="Code" readonly="readonly" id="sub_procedures_code_'+count+'" class="sub_procedures_code nt_prnt" name="sub_procedures_code_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Price" readonly="readonly" id="sub_procedures_price_'+count+'" class="sub_procedures_price nt_prnt" name="sub_procedures_price_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Discount" id="sub_procedures_discount_'+count+'" class="sub_procedures_discount" name="sub_procedures_discount_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Discount" id="sub_procedures_paid_price_'+count+'" class="sub_procedures_paid_price" name="sub_procedures_paid_price_'+count+'" type="text" class="form-control validate" required></td></tr>';

            $("table tbody#sub_procedures_table_body").append(markup);

			add_delete_method();

			count++;        // Increment count by 1
            console.log(count);

        });

        

        // Find and remove selected table rows

        $(".delete-sub_procedures-row").click(function(){

            $('#code_msg').hide();

			$('#apply_discount').show();

			$('#discount_code').val('');

			$('.remove_code').hide();

			

			$("table tbody").find('input[id="record"]').each(function(){

            	if($(this).is(":checked")){

                    $(this).parents("tr").remove();

                }

            });

			add_delete_method();			

        });		

    });

	

	function add_delete_method(){

			var fee_total = 0;

			$('.sub_procedures_price').each(function(){

				var price_total = 0;

				var price_total = $(this).val();

				fee_total += +price_total;

			});

			$('#fees').val(fee_total);

			$('#after_discount').val(fee_total);

			$('#discount_amount').val('0 ');

			$('#payment_done').val('');

			$('#remaining_amount').val('');

			$('.sub_procedures_discount').val('0 ');

			$('#transaction_id').val('');

			$('a #transaction_img_src').attr('src', '');

			$('#transaction').hide();

			$('#payment_method').prop('selectedIndex',0);

	}

	

	$(document).on('change',".sub_procedure_select",function(e) {

		$('#code_msg').hide();

		$('#apply_discount').show();

		$('#discount_code').val('');

		$('.remove_code').hide();

			

		$('.sub_procedures_discount').val('0 ');

        $('#msg_area').empty();

        $('#discount_amount').val('0 ');

		$('#payment_done').val('');

		$('#remaining_amount').val('');

		

		var sub_procedure = $(this).val();

		var count = $(this).attr('count');

		$('#sub_procedures_price_'+count).val('');

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

    });

	$(document).on('keyup',"#payment_done",function(e) {

		$('#package_form').prop('required', true);

		$('#remaining_amount').empty();

		var fees = $('#after_discount').val();

		var payment_done = $(this).val();

		var remaining_amount = fees-payment_done;

		$('#remaining_amount').val(remaining_amount.toFixed(2));

	});

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
	

	function cal_billing_cost(){

		var fees = $(".dhee").val();

		var discunt = $("#discount_amount").val();

		var total = parseFloat(fees) - parseFloat(discunt);

		$("#after_discount").val(total.toFixed(2));

	}
</script>

<script>
    $(document).on('click',".statuss",function(e) {
        var count = $(this).attr('index');
        var type = $(this).attr('rel');
        if($(this).is(':checked'))
        {
               $('td.role.cons_cls_'+count+' select').select2({tags: true});
        }     
    });	
</script>