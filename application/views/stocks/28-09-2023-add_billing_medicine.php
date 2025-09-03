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
        <h3 class="heading">Medicine Billing</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
            <div id="main_div">
            	<div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">IIC ID (Required)</label>
                        <input value="" placeholder="IIC ID" id="patient_id" name="patient_id" type="text" class="form-control required_value" required>
                        <!--<p style="font-weight:700; color:red;" id="patient_detail_name"></p>-->
						<input value="" placeholder="Patient Name" id="patient_detail_name" name="patient_detail_name" type="text" class="form-control required_value" required>
						
                   </div>
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">Receipt number (Required)</label>
                        <input value="<?php date_default_timezone_set("America/New_York"); echo date("Ymdhis"); ?>" placeholder="Receipt number" id="receipt_number" name="receipt_number" readonly="readonly" type="text" class="form-control required_value" required>
                   </div>
                 </div>
              
                <div class="clearfix"></div>
                <hr />
               
                <section class="col-sm-12 col-xs-12 consumables_section">
                  <div class="clearfix"></div>
                  <input type="button" class="add-consumables-row btn btn-large" value="Add Medicine">
				  <input type="button" class="delete-consumables-row btn btn-large pull-right" value="Delete Selected Consumables">
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Serial Number</th>
                            <th>Consumable</th>
                            <th>Unit</th>
							<th>Open Stock</th>
							<th>Batch Number</th>
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
                                    <option value="<?php echo $val['item_number']; ?>" ID="<?php echo $val['ID']; ?>" batch_number="<?php echo $val['batch_number']; ?>" quantity="<?php echo $val['quantity']; ?>" fees="<?php echo $val['price']; ?>" consumables="<?php echo $val['item_name']; ?>" product_vendor_price="<?php echo $val['product_vendor_price']; ?>" expiry="<?php echo $val['expiry']; ?>"> <?php echo $val['item_name']; ?> (<?php echo $val['batch_number']; ?>) (<?php echo $val['expiry']; ?>)</option>
                                <?php } ?>
                                </select>
                            </td>
							  
							<td><input value="" item_number="" placeholder="ID" readonly="readonly" id="consumables_ID_1" class="cons-cls-1 consumables_ID_1 form-control" name="consumables_ID_1" type="hidden" required><input disabled value="" item_number="" placeholder="Consumption/patient (unit)" id="consumables_quantity_1" qcount="1"  onkeyup="consumables_quantity_update(this)" class="cons-cls-1 consumables_quantity consumables_quantity_1 form-control" name="consumables_quantity_1" type="text" min="0" required></td>
							<td><input value="" placeholder="Open Stock" readonly="readonly" id="consumables_stock_1" class="cons-cls-1 consumables_stock_1 form-control" name="consumables_stock_1" type="text" required></td> 
							<td><input value="" item_number="" placeholder="Batch Number" readonly="readonly" id="consumables_batch_number_1" class="cons-cls-1 consumables_batch_number_1 form-control" name="consumables_batch_number_1" type="text" required></td> 
							<td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_1" class="cons-cls-1 consumables_price form-control" name="consumables_price_1" type="text" required></td>                   
							<td><input value="" placeholder="Discout" qcount="1" onblur="consumables_total_discount_price_update(this)" item_number=""  id="consumables_discount_1" class="cons-cls-1 consumables_discount form-control" name="consumables_discount_1" type="text" required></td>                   
							<td><input value="" placeholder="Total" readonly="readonly" id="consumables_total_1" class="cons-cls-1 consumables_total form-control" name="consumables_total_1" type="text" required><input value="" item_number="" id="consumables_product_vendor_price_1" class="cons-cls-1 consumables_product_vendor_price_1 form-control" name="consumables_product_vendor_price_1" type="hidden"><input value="" item_number="" id="consumables_expiry_1" class="cons-cls-1 consumables_expiry_1 form-control" name="consumables_expiry_1" type="hidden"></td>                    
							<td><input type="checkbox" class="statuss" name="record"></td>
                        </tr>
                    </tbody>
                </table> 
                <table>
                    <thead>
                        <tr>
                           <td width="70%">Total</td>
						   <td width="12%" id="discount"></td>
						   <td colspan="1"><input type="hidden" value="" id="discount_amount" name="discount_amount" ></td>
                           
                           <td id="total_final_discount" width="11%"></td>
                           <td colspan="1">
						   <input type="hidden" id="payment_done" name ="payment_done" value=""/>
						   </td>
                        </tr>
                    </thead>
                                </table>          
                </section>
				
				
		
          

        <div class="row" id="grand_total_section">
          <div class="row">
              <div class="form-group col-sm-6 col-xs-12 role">
                    <label for="statuss">Payment mode</label>
                    <select name="payment_method" id="payment_method">
                        <option value="">Select</option>
                        <option value="card" mode="Card">Card</option>
                        <option value="upi" mode="UPI">UPI</option>
                        <option value="cash" mode="Cash">Cash</option>
                    </select>
                </div>
				<div class="form-group col-sm-6 col-xs-12" id="transaction">
                  <label for="item_name">Reference no. (Optional)</label>
                  <input value="" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control  required_value" required>
                </div>
          </div>     
		   <div class="row">
           <div class="form-group col-sm-6 col-xs-12 hospital_id_section">
                  <label for="item_name">Hospital ID</label>
                  <input value="" id="hospital_id" name="hospital_id" type="text" class="form-control validate">
                </div>
                <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Billing ID (Optional)</label>
                  <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control ">
                </div>
				 <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Cash Payment</label>
                  <input value="" placeholder="Cash Payment" id="cash_payment" name="cash_payment" type="text" class="form-control ">
                </div>
				 <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Card Payment</label>
                  <input value="" placeholder="Card Payment" id="card_payment" name="card_payment" type="text" class="form-control ">
                </div>
				 <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">UPI Payment</label>
                  <input value="" placeholder="UPI Payment" id="upi_payment" name="upi_payment" type="text" class="form-control ">
                </div>
				 <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">NEFT Payment</label>
                  <input value="" placeholder="NEFT Payment" id="neft_payment" name="neft_payment" type="text" class="form-control ">
                </div>

				<div class="form-group col-sm-6 col-xs-12" style="display:none;">
                  <label for="item_name">Employee Number</label>
				  <input value="Pending" placeholder="status" id="status" name="status" type="text" class="form-control ">
				  <?php if($_SESSION['logged_stock_manager']['employee_number']){ ?>
                  <input type="text" class="form-control" value="<?php echo $_SESSION['logged_stock_manager']['employee_number']?>" id="employee_number" name="employee_number">
                  <?php }else{ ?>
				  <input type="text" class="form-control" value="<?php echo $_SESSION['logged_billing_manager']['employee_number']?>" id="employee_number" name="employee_number">
                  <?php } ?>
				  <input value="001/O/2324" placeholder="NEFT Payment" id="series_number" name="series_number" type="hidden" class="form-control ">
                
				</div>
				
				
				  
            </div>
            
            <div class="clearfix"></div>
            <div class="form-group col-sm-12 col-xs-12">
                <button type="button" id="create_billing"> Create Billing </button>
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
        $('#patient_detail_name').empty();
		
        var patient_id = $(this).val();
        if(patient_id != ""){
            $.ajax({
                url: '<?php echo base_url('patients/patient_detail_name2')?>',
                data: {patient_id : patient_id},
                dataType: 'json',
                method:'post',
                success: function(data)
                {
					$('#patient_detail_name').val(data);
                   // $('#patient_detail_name').append(data); 
                }
            });
        }
    });

    

	 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		
		$('#consumables_serial_'+count).val('');
		$('#consumables_ID_'+count).val('');
		$('#consumables_quantity_'+count).val('');
		$('#consumables_stock_'+count).val('');
		$('#consumables_price_'+count).val('');
		$('#consumables_quantity_'+count).attr("item_number", "");
		$('#consumables_batch_number_'+count).val('');
		$('#consumables_sub_total').val('');
		$('#consumables_discount_'+count).val('');  
        $('#consumables_discount_'+count).attr("item_number", "");
		$('#consumables_total_'+count).val('');
		$('#consumables_product_vendor_price_'+count).val('');
		$('#consumables_expiry_'+count).val('');
		
		
		
		if(serial != ''){
			var serial = $(this).val();
			var ID = $(this).find(':selected').attr('ID');
			var batch_number = $(this).find(':selected').attr('batch_number');
			var quantity = $(this).find(':selected').attr('quantity');
			var fees = $(this).find(':selected').attr('fees');
			var product_vendor_price = $(this).find(':selected').attr('product_vendor_price');
			var expiry = $(this).find(':selected').attr('expiry');
			
			$('#consumables_serial_'+count).val(serial);
			$('#consumables_ID_'+count).val(ID);
			$('#consumables_batch_number_'+count).val(batch_number);
            $('#consumables_stock_'+count).val(quantity);
			$('#consumables_quantity_'+count).attr({'max': parseInt(quantity), 'min': 0});
            $('#consumables_quantity_'+count).attr("item_number", serial);
			//$('#consumables_batch_number_'+count).val(batch_number);
			$('#consumables_price_'+count).val(fees);
            $('#consumables_discount_'+count).attr("item_number", serial);
			$('#consumables_product_vendor_price_'+count).val(product_vendor_price);
			$('#consumables_expiry_'+count).val(expiry);
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
	
	 $(document).ready(function(){
		 
		$(".add-consumables-row").click(function(){
			var rows= $('#consumables_table_body tr:last').attr('trcount');
			var count = parseFloat(rows) + 1;
           var markup = '<tr class="consumables_row_'+count+'" trcount="'+count+'"><td><input type="checkbox" class="active-statuss"  rel="consumables"  index="'+count+'"></td><td><input value="" placeholder="Serial Number" readonly="readonly" id="consumables_serial_'+count+'" class="cons-cls-'+count+' consumables_serial_'+count+' form-control " name="consumables_serial_'+count+'" type="text" required></td><td class="role cons_cls_'+count+'"><select disabled name="consumables_name_'+count+'" class="cons-cls-'+count+' item_select consumables_select form-control " id="consumables_name_'+count+'" count="'+count+'" required><option value="">Select</option><?php foreach($consumables as $key => $val){ ?><option value="<?php echo $val['item_number']; ?>" ID="<?php echo $val['ID']; ?>" quantity="<?php echo $val['quantity']; ?>" fees="<?php echo $val['price']; ?>" consumables="<?php echo $val['item_name']; ?>" batch_number="<?php echo $val['batch_number']; ?>" product_vendor_price="<?php echo $val['product_vendor_price']; ?>" expiry="<?php echo $val['expiry']; ?>"> <?php echo $val['item_name']; ?> (<?php echo $val['batch_number']; ?>) (<?php echo $val['expiry']; ?>)</option><?php } ?></select></td><td><input value="" placeholder="ID" readonly="readonly" id="consumables_ID_'+count+'" class="cons-cls-'+count+' consumables_ID form-control"  name="consumables_ID_'+count+'" type="hidden" required><input value="" qcount="'+count+'" onkeyup="consumables_quantity_update(this)" placeholder="Consumption/patient (unit)"  item_number="" id="consumables_quantity_'+count+'" disabled class="consumables_quantity consumables_quantity_'+count+' form-control cons-cls-'+count+'" name="consumables_quantity_'+count+'" type="text" min="0" required></td><td><input value="" placeholder="Currunt Stock" readonly="readonly" id="consumables_stock_'+count+'" class="cons-cls-'+count+' consumables_stock_'+count+' form-control " name="consumables_stock_'+count+'" type="text" required></td><td><input value="" placeholder="Batch Number" readonly="readonly" id="consumables_batch_number_'+count+'" class="cons-cls-'+count+' consumables_batch_number form-control "  name="consumables_batch_number_'+count+'" type="text" required></td><td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_'+count+'" class="cons-cls-'+count+' consumables_price form-control "  name="consumables_price_'+count+'" type="text" required></td><td><input value="" placeholder="Discount" id="consumables_discount_'+count+'" qcount="'+count+'" onblur="consumables_total_discount_price_update(this)" item_number="" class="cons-cls-'+count+' consumables_discount_'+count+' form-control " name="consumables_discount_'+count+'" type="text" required></td><td><input value="" placeholder="Total" readonly="readonly" id="consumables_total_'+count+'" class="cons-cls-'+count+' consumables_total_'+count+' form-control " name="consumables_total_'+count+'" type="text" required></td><td style="display:none"><input value="" id="consumables_product_vendor_price_'+count+'" class="cons-cls-'+count+' consumables_product_vendor_price_'+count+' form-control " name="consumables_product_vendor_price_'+count+'" type="hidden"><input value="" id="consumables_expiry_'+count+'" class="cons-cls-'+count+' consumables_expiry_'+count+' form-control " name="consumables_expiry_'+count+'" type="hidden"></td><td><input type="checkbox" class="statuss" name="record"></td></tr>';
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
					var name, price, serial, quantity, batch_number,product_vendor_price,expiry, stock = '';
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
</script>
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
       //alert(count);
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
                    setTimeout(function () {
                        var discount_total = 0;
                        var final_total = 0
                        var ctr = 0;
                        for (ctr =  1; ctr <= count; ctr++){
                            var temp_discount = $('#consumables_discount_'+ctr).val();
                            discount_total = discount_total + parseFloat(temp_discount);
                           
                            var temp_final = $('#consumables_total_'+ctr).val();
                            final_total = final_total + parseFloat(temp_final);
                        }
                        $("#discount").html(discount_total.toFixed(2));
						$("#discount_amount").val(discount_total.toFixed(2));
                        $("#total_final_discount").html(final_total.toFixed(2));
						$("#payment_done").val(final_total.toFixed(2));
                    }, 500);
                }
            });
        }        
	}
</script>

<script>
   $('#create_billing').click(function(e){
 e.preventDefault();
 if(this.form.reportValidity()){
  $(this).prop('disabled',true);
  this.form.submit();
 }
});
</script>
<!--****** Billing SCRIPT *******-->