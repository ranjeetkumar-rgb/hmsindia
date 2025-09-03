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

<form class="col-sm-12 col-xs-12" id="add_billing_form" method="post" action="">
  <input type="hidden" name="action" value="add_billing_medicine" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details">
      <div class="panel-heading">
        <h3 class="heading">Patient Items</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
            <div id="main_div">
            	<div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">IIC ID (Required)</label>
                        <input value="" placeholder="IIC ID" id="patient_id" name="patient_id" type="text" class="form-control required_value" required>
                        <p style="font-weight:700; color:red;" id="patient_detail_name"></p>
                   </div>
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Receipt number (Required)</label>
                        <input value="" placeholder="Receipt number" id="receipt_number" name="receipt_number" type="text" class="form-control required_value" required>
                   </div>
                 </div>
              
                <div class="clearfix"></div>
                <hr />
               
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 consumables_section">
                  <h4 class="heading">Patient Consumables</h4>
                  <div class="clearfix"></div>
                  <input type="button" class="add-consumables-row btn btn-large" value="Add Consumables">
                  <input type="button" class="delete-consumables-row btn btn-large pull-right" value="Delete Selected Consumables">
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Serial Number</th>
                            <th>Consumable</th>
                            <th>Unit</th>
                            <!-- <th>Company</th> -->
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                            <th>Discount</th>
                            <th>Total Price</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="consumables_table_body">
                        <tr class="consumables_row_1" trcount="1">
                            <td><input type="checkbox" class="active-statuss" rel="consumables" index="1"></td>
                            <td><input value="" placeholder="Serial Number" readonly="readonly" id="consumables_serial_1" class="cons-cls-1 consumables_serial_1 form-control" name="consumables_serial_1" type="text" required></td>
                            <td class="role cons_cls_1">
                                <select disabled name="consumables_name_1" class="item_select consumables_select cons-cls-1" id="consumables_name_1" count="1" required>
                                    <option value="">Select</option>
                                <?php foreach($consumables as $key => $val){ ?>
                                    <option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" consumables="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?> (<?php echo $val['expiry']; ?>)</option>
                                <?php } ?>
                                </select>
                            </td>
                            <td><input disabled value="" item_number="" placeholder="Consumption/patient (unit)" id="consumables_quantity_1" qcount="1"  onkeyup="consumables_quantity_update(this)" class="cons-cls-1 consumables_quantity consumables_quantity_1 form-control" name="consumables_quantity_1" type="number" min="0" required></td>
                          <td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_1" class="cons-cls-1 consumables_price form-control" name="consumables_price_1" type="text" required></td>                   
                          <td><input value="" placeholder="Discout" qcount="1" onblur="consumables_total_discount_price_update(this)" item_number=""  id="consumables_discount_1" class="cons-cls-1 consumables_discount form-control" name="consumables_discount_1" type="text" required></td>                   
                          <td><input value="" placeholder="Total" readonly="readonly" id="consumables_total_1" class="cons-cls-1 consumables_total form-control" name="consumables_total_1" type="text" required></td>                   
                          <td><input type="checkbox" class="statuss" name="record"></td>
                        </tr>
                    </tbody>
                </table>                
                </section>
				
				
		
          

        <div class="row" id="grand_total_section">
          <div class="row">
              <div class="form-group col-sm-6 col-xs-12 role">
                    <label for="statuss">Payment mode (Required)</label>
                    <select name="payment_method" id="payment_method" required>
                        <option value="">Select</option>
                        <option value="neft" mode="NEFT">NEFT</option>
                        <option value="rtgs" mode="RTGS">RTGS</option>
                        <option value="card" mode="Card">Card</option>
                        <option value="upi" mode="UPI">UPI</option>
                        <option value="insurance" mode="Insurance">Insurance</option>
                        <option value="cash" mode="Cash">Cash</option>
                        <option value="cheque" mode="Cheque">Cheque</option>                    
                    </select>
                </div>
              <div class="form-group col-sm-6 col-xs-12" id="subvention_box" style="display:none;">
                <label for="item_name">Subvention charges (Required)</label>
                <input value="" placeholder="Subvention charges" id="subvention_charges" name="subvention_charges" type="text" class="form-control validate">
              </div>
          </div>     

            
          <div class="row">      
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Discount (USD) (Required)</label>
                  <input value="0" readonly="readonly" name="us_discount" id="us_discount" type="text" class="form-control required_value" required>
            </div>
          </div>
        
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Grand Total (Rupee) (Required)</label>
                  <input value="<?php echo $grand_total; ?>" name="rs_totalpackage" placeholder="grand total" readonly="readonly" class="rs_dhee required_value" id="rs_fees" type="hidden" class="form-control " required>
                  <input value="<?php echo $grand_total; ?>" placeholder="grand total" readonly="readonly" name="rs_fees" id="rs_after_discount" type="text" class="form-control required_value" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Discount (Rupee) (Required)</label>
                  <input value="0" readonly="readonly" name="rs_discount" id="rs_discount" type="text" class="form-control required_value" required>
            </div>
          </div>

            <div class="row">            
              <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Discount amount</label>
                  <input value="0" placeholder="Discount amount" id="discount_amount" readonly="readonly" name="discount_amount" type="text" class="form-control required_value" required>
                  <input value="<?php echo $_SESSION['logged_billing_manager']['allow_discount_rs'] ;?>" id="allow_discount" type="hidden" class="form-control " required>
                  <p id="show_disc_app" style="display:none;">Given discount is more than allowed, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_billing_manager']['username'];?>" id="get_discount_approval">click here</a> for admin approval.</p>
                </div>
              
              <div class="form-group col-sm-6 col-xs-12">
                    <label for="item_name">Payment received (Required)</label>
                    <input value="" placeholder="Payment received" id="payment_done" step="any" name="payment_done" type="number" class="form-control required_value" required>
              </div>
            </div>   
          
            <div class="row">
              <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Remaining amount (Required)</label>
                  <input value="" placeholder="Remaining amount" readonly="readonly" id="remaining_amount" name="remaining_amount" type="text" class="form-control required_value" required>
              </div>
            </div>        
          
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12" id="transaction" style="display:none;">
                  <label for="item_name">Reference no. (Optional)</label>
                  <input value="" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control  required_value" required>
                  <label>Upload screenshot/document here</label>
                  <input type="file" class="required_value" name="transaction_img" id="transaction_img"  />
                </div>
            </div>

            <div class="row">            
                <div class="form-group col-sm-6 col-xs-12 role">
                    <label for="statuss">Billing source (Required)</label>
                    <select name="billing_from" class="required_value" id="billing_from" required>
                        <option value="">Select</option>
                        <?php if(isset($_SESSION['logged_billing_manager'])){ $center = $all_method->get_center();
                          if($_SESSION['logged_billing_manager']['center_type'] == "associated"){ ?>
                          <option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                        <?php } } ?>
                        <option value="IndiaIVF">IndiaIVF</option>       
                    </select>
                </div>
                  <div class="form-group col-sm-6 col-xs-12 hospital_id_section">
                  <label for="item_name">Hospital ID</label>
                  <input value="" id="hospital_id" name="hospital_id" type="text" class="form-control validate">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Billing ID (Optional)</label>
                  <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control ">
                </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="form-group col-sm-12 col-xs-12">
                <a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
            </div>
          </div>
				
                <div class="clearfix"></div>
                
            </div>
      </div>
      </p>
    </div>
  </div>
</form>

<!--****** consumables SCRIPT *******-->
<script>
$(document).on('blur',"#patient_id",function(e) {
        $('p#patient_detail_name').empty();
        var patient_id = $(this).val();
        if(patient_id != ""){
            $.ajax({
                url: '<?php echo base_url('patients/patient_detail_name')?>',
                data: {patient_id : patient_id},
                dataType: 'json',
                method:'post',
                success: function(data)
                {
                    $('p#patient_detail_name').append(data); 
                }
            });
        }
    });

	 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		
		$('#consumables_serial_'+count).val('');
		$('#consumables_quantity_'+count).val('');
		$('#consumables_company_'+count).val('');
		$('#consumables_price_'+count).val('');
        $('#consumables_quantity_'+count).attr("item_number", "");
		$('#consumables_sub_total').val('');
		$('#consumables_discount_'+count).val(0);  
        $('#consumables_discount_'+count).attr("item_number", "");
		$('#consumables_total_'+count).val('');
		
		
		if(serial != ''){
			var serial = $(this).val();
			var company = $(this).find(':selected').attr('company');
			var fees = $(this).find(':selected').attr('fees');
			
			$('#consumables_serial_'+count).val(serial);
            $('#consumables_company_'+count).val(company);
            $('#consumables_quantity_'+count).attr("item_number", serial);
			$('#consumables_price_'+count).val(fees);
            $('#consumables_discount_'+count).attr("item_number", serial);
            // $('#consumables_total'+count).val('');
		}
			var fee_total = 0;
			$('.consumables_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			$('#consumables_sub_total').val(fee_total);
			$('#consumables_total').val(fee_total);
		//	calculate_fees();
    });
	
/*	 $(document).on('keyup',".consumables_discount",function(e) {
      $(".payment_in").prop('checked', false);
      $('#grand_total_section').hide();
      var given_discount = given_price = total = consumables_total = 0;
      $('.consumables_discount').each(function(){
          var consumables_discount = $(this).val();
          var consumables_price = $(this).attr('consumables_price');
          var total = (consumables_price-consumables_discount);
          consumables_total += parseFloat(total) || 0;
          given_discount += parseFloat(consumables_discount) || 0;
      });
	  
      console.log('medicine_total-----'+consumables_total);
	  var grandTotal = $('#medicine_sub_total').val();
	  var finalPrice = grandTotal  - given_discount;
      $('strong#medicine_total').empty().append(finalPrice.toFixed(2));
      //$('#medicine_sub_total').val(consumables_total.toFixed(2));
  }); */
	
	 $(document).ready(function(){
        $(".add-consumables-row").click(function(){
			var rows= $('#consumables_table_body tr:last').attr('trcount');
			var count = parseFloat(rows) + 1;
           var markup = '<tr class="consumables_row_'+count+'" trcount="'+count+'"><td><input type="checkbox" class="active-statuss"  rel="consumables"  index="'+count+'"></td><td><input value="" placeholder="Serial Number" readonly="readonly" id="consumables_serial_'+count+'" class="cons-cls-'+count+' consumables_serial_'+count+' form-control " name="consumables_serial_'+count+'" type="text" required></td><td class="role cons_cls_'+count+'"><select disabled name="consumables_name_'+count+'" class="cons-cls-'+count+' item_select consumables_select form-control " id="consumables_name_'+count+'" count="'+count+'" required><option value="">Select</option><?php foreach($consumables as $key => $val){ ?><option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" consumables="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?> (<?php echo $val['expiry']; ?>)</option><?php } ?></select></td><td><input value="" qcount="'+count+'" onkeyup="consumables_quantity_update(this)" placeholder="Consumption/patient (unit)"  item_number="" id="consumables_quantity_'+count+'" disabled class="consumables_quantity consumables_quantity_'+count+' form-control cons-cls-'+count+'" name="consumables_quantity_'+count+'" type="number" min="0" required></td><td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_'+count+'" class="cons-cls-'+count+' consumables_price form-control "  name="consumables_price_'+count+'" type="text" required></td><td><input value="" placeholder="Discount" id="consumables_discount_'+count+'" qcount="'+count+'" onblur="consumables_total_discount_price_update(this)" item_number="" class="cons-cls-'+count+' consumables_discount_'+count+' form-control " name="consumables_discount_'+count+'" type="text" required></td><td><input value="" placeholder="Total" readonly="readonly" id="consumables_total_'+count+'" class="cons-cls-'+count+' consumables_total_'+count+' form-control " name="consumables_total_'+count+'" type="text" required></td><td><input type="checkbox" class="statuss" name="record"></td></tr>';
             $("table tbody#consumables_table_body").append(markup);
		//	calculate_fees();
        });
        
        // Find and remove selected table rows
        $(".delete-consumables-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
				var fee_total = 0;
				$('.consumables_price').each(function(){
					var price_total = 0;
					var price_total = $(this).val();
					fee_total += +price_total;
				});
				$('#consumables_sub_total').val(fee_total);
				$('#consumables_discount').val(0);
				$('#consumables_total').val(fee_total);
            });
			//calculate_fees();
        });
    });
</script>
<!--****** consumables SCRIPT *******-->

<!--****** Billing SCRIPT *******-->
<script>
	$(document).on('click',"#create_billing",function(e) {
       $('#error').empty();
	   var has_empty = false;
	   var patient_id = $('#patient_id').val();
	    var receipt_number = $('#receipt_number').val();
	   if ( patient_id == '' || receipt_number == '') 
	   {
		   $('#error').append('One or more fields are empty!');
	   }else{
	   		var com_count = 1;
			var com_rows= $('#consumables_table_body tr').length;
			$('.consumables_select').each(function(){
				if(com_count <= com_rows){
					var name, price, serial, quantity, company = '';
					if($(this).val() != ''){
						quantity = $('#consumables_quantity_'+com_count).val();
						if(quantity == ''){
							has_empty = false;
						}else{
							has_empty = true;
						}
					}
					com_count++;
				 }
			});
			
			if(has_empty == true){
				$('#add_billing_form').submit();
			}else{
			   $('#error').append('One or more fields are empty!');
		   }	   		
	   }
    });
</script>-->
<script>
    $(document).on('click',".active-statuss",function(e) {
        var count = $(this).attr('index');
        var type = $(this).attr('rel');
        if($(this).is(':checked'))
        {
           // console.log(count+"---------"+type);
            if(type =="consumables"){
                $('td.role.cons_cls_'+count+' select.item_select').select2({tags: true});
                $('.cons-cls-'+count).prop("disabled", false);
                $('.cons-cls-'+count).addClass("required_value");
            }
        }else
        {
           if(type =="consumables"){
                $('.cons-cls-'+count).prop("disabled", true);
                $('.cons-cls-'+count).removeClass("required_value");
            }
        }       
    });
	$(document).on('click',"#create_billing",function(e) {
	 	  var value = $('.required_value').filter(function () {
			return this.value === '';
		  });
		  if (value.length == 0) {$('#add_billing_form').submit();} else if (value.length > 0) { alert('Please fill out all fields.'); }
    });


   // $('.consumables_quantity').on("keyup", function() {
	function consumables_quantity_update(el) {
      var count =  $(el).attr('qcount');
       var item_number =  $(el).attr('item_number');
       $('#consumables_price_'+count).val(" ");
       var units = $(el).val();

       if(units > 0){
            $.ajax({
                url: '<?php echo base_url('stocks/get_stock_item_price')?>',
                data: {item_number : item_number, units:units},
                dataType: 'json',
                method:'post',
                success: function(data)
                {
                    $('#consumables_price_'+count).val(data.toFixed(2)); 
                }
            });
        } 
	}
   // });

   
	function consumables_total_discount_price_update(el) {
       var count =  $(el).attr('qcount');
       // alert(count);
       var item_number =  $(el).attr('item_number');
       // alert(item_number);
       
       var discount = $(el).val();
       // alert(discount);

       $('#consumables_total_'+count).val('');
        var units = $('#consumables_quantity_'+count).val();

       if(units > 0){
            $.ajax({
                url: '<?php echo base_url('stocks/get_stock_item_discount_price')?>',
                data: {item_number : item_number, units:units, discount:discount},
                dataType: 'json',
                method:'post',
                success: function(data)
                {
                    $('#consumables_total_'+count).val(data.toFixed(2)); 
                }
            });
        } 
	}
  


</script>
<!--****** Billing SCRIPT *******-->