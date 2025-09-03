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
<?php
// Get current date information
$date = date_create("now");
$year = date_format($date, "y"); // Get last 2 digits of the year (e.g., "24" for 2024)
$month = date_format($date, "F"); // Get full month name (e.g., "February")

// Determine financial year (April - March cycle)
if (date_format($date, "m") >= 4) {
    $financial_year = $year . '-' . ($year + 1);
} else {
    $financial_year = ($year - 1) . '-' . $year;
}

// Generate the PO number prefix
$psno = "PSPL/" . $financial_year . "/" . $month . "/";

// Fetch the last PO number for the same month from the database
$sql3 = "SELECT po_number FROM `hms_internal_orders` 
         WHERE po_number LIKE '$psno%' 
         ORDER BY ID DESC LIMIT 1";
$select_result3 = run_select_query($sql3);

// Extract the last PO number and increment
$lastPONumber = isset($select_result3['po_number']) ? (int) substr($select_result3['po_number'], strrpos($select_result3['po_number'], "/") + 1) : 0;
$poNumber = $lastPONumber + 1;

// Generate the final PO number
$fullPONumber = $psno . $poNumber;
?>
<form class="col-sm-12 col-xs-12" id="add_billing_form" method="post" action="">
  <input type="hidden" name="action" value="internal_orders" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details">
      <div class="panel-heading">
        <h3 class="heading">Add PO</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
            <div id="main_div">
            	<div class="row">            
                   <div class="form-group col-sm-6 col-xs-12">
                        <label for="item_name">PO number</label>
                        <input value="<?php echo $fullPONumber; ?>" placeholder="Receipt number" id="po_number" name="po_number" readonly="readonly" type="text" class="form-control required_value" required>                        
				   </div>
                   <div class="col-sm-6 col-xs-12" style="margin-top:10px;">
						<label>Vendor Name</label>
					<select name="vendor_number" class="form-control" required id="vendor_number">
						<option value="">Select vendor</option>
						<?php foreach($vendors as $key => $value) { $selected = ($value['vendor_number'] ==  $data['vendor_number']) ? 'selected="selected"' : ''; ?>
						<option value="<?php echo $value['vendor_number']; ?>" 
						<?php echo $selected; ?>>
						<?php echo $value['name']; ?>
						</option>
						<?php } ?>
					</select>
            </div>
                </div>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 consumables_section">
                  <div class="clearfix"></div>
                  <input type="button" class="add-consumables-row btn btn-large" value="Add Medicine">
				  <input type="button" class="delete-consumables-row btn btn-large pull-right" value="Delete">
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Serial Number</th>
                            <th>Item Name</th>
                            <th>Qty (Pack)</th>
							<th>Batch Number</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                            <th>Vendor Price (Pack)</th>
                            <th>Pack Size</th>
                            <th>Mrp (Pack)</th>
             				<th>Tax (%)</th>
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
                                    <option value="<?php echo $val['item_number']; ?>" batch_number="<?php echo $val['batch_number']; ?>" quantity="<?php echo $val['quantity']; ?>" fees="<?php echo $val['price']; ?>" mrp="<?php echo $val['mrp']; ?>" item_name="<?php echo $val['item_name']; ?>" vendor_price="<?php echo $val['vendor_price']; ?>" gstrate="<?php echo $val['gstrate']; ?>" hsn="<?php echo $val['hsn']; ?>" pack_size="<?php echo $val['pack_size']; ?>" gstdivision="<?php echo $val['gstdivision']; ?>" company="<?php echo $val['company']; ?>" brand_name="<?php echo $val['brand_name']; ?>"> <?php echo $val['item_name']; ?></option>
                                <?php } ?>
                                </select>
                            </td>
							<td><input disabled value="" item_number="" placeholder="Consumption/patient (unit)" id="consumables_quantity_1" qcount="1"  onkeyup="consumables_quantity_update(this)" class="cons-cls-1 consumables_quantity consumables_quantity_1 form-control" name="consumables_quantity_1" type="text" min="0" required></td>
							<td><input value="" item_number="" placeholder="Batch Number" readonly="readonly" id="consumables_batch_number_1" class="cons-cls-1 consumables_batch_number_1 form-control" name="consumables_batch_number_1" type="text" required></td> 
							<td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_1" class="cons-cls-1 consumables_price form-control" name="consumables_price_1" type="text" required></td>                   
							<td><input value="" item_number="" id="consumables_vendor_price_1" readonly="" class="cons-cls-1 consumables_vendor_price_1 form-control" name="consumables_vendor_price_1" type="text"></td>
							<td><input value="" item_number="" id="consumables_pack_size_1" readonly="" class="cons-cls-1 consumables_pack_size_1 form-control" name="consumables_pack_size_1" type="text"></td>
							<td><input value="" item_number="" id="consumables_mrp_1" readonly="" class="cons-cls-1 consumables_mrp_1 form-control" name="consumables_mrp_1" type="text"></td>
							<td><input value="" placeholder="Tax" readonly="readonly" id="consumables_gstrate_1" class="cons-cls-1 consumables_gstrate_1 form-control" name="consumables_gstrate_1" type="text" required>
							    <input value="" item_number="" id="consumables_company_1" class="cons-cls-1 consumables_company_1 form-control" name="consumables_company_1" type="hidden">
							    <input value="" item_number="" id="consumables_item_name_1" class="cons-cls-1 consumables_item_name_1 form-control" name="consumables_item_name_1" type="hidden">
							    <input value="" item_number="" id="consumables_hsn_1" class="cons-cls-1 consumables_hsn_1 form-control" name="consumables_hsn_1" type="hidden">
								<input value="" item_number="" id="consumables_gstdivision_1" class="cons-cls-1 consumables_gstdivision_1 form-control" name="consumables_gstdivision_1" type="hidden">
									<input value="" item_number="" id="consumables_brand_name_1" class="cons-cls-1 consumables_brand_name_1 form-control" name="consumables_brand_name_1" type="hidden">
							</td>								
							<td><input type="checkbox" class="statuss" name="record"></td>
                        </tr>
                    </tbody>
                </table> 
                <table>
                    <thead>
                        <tr>
                           <td width="60%">Total</td>
						   <td id="total_final_discount" width="40%"></td>
                        </tr>
                    </thead>
                </table>          
            </section>
		<div class="row" id="grand_total_section">
          <div class="row">
              <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Ship To</label>
               <select name="ship_to" id="ship_to" class="form-control" required>
				<option value="">Select Center</option>
              	<?php 
					//var_dump($all_method->get_all_centers);die;
					$all_centers = $all_method->get_all_centers();
					foreach($all_centers as $key => $val){ 
					if($center == $val['center_number']){
					echo '<option value="'.$val['center_number'].'" selected>'.$val['ship_to'].'</option>';
					}else{
					echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
					}
					} 
					?>
              </select>
			  </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Bill To</label>
             <select name="bill_to" id="bill_to" class="form-control" required>
				<option value="">Select Center</option>
              	<?php 
					//var_dump($all_method->get_all_centers);die;
					$all_centers = $all_method->get_all_centers();
					foreach($all_centers as $key => $val){ 
					if($center == $val['center_number']){
					echo '<option value="'.$val['center_number'].'" selected>'.$val['ship_to'].'</option>';
					}else{
					echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
					}
					} 
					?>
              </select>
			</div>
			<div class="form-group col-sm-4 col-xs-12">
				<label for="expiry">Center</label>
				<select name="center" id="center" class="form-control" required>
              		<option value="">Select Center</option>
					<option value="CASH MEDICINE NOIDA">CASH MEDICINE NOIDA</option>
					<option value="CASH MEDICINE GGN">CASH MEDICINE GGN</option>
				    <option value="CASH MEDICINE GP">CASH MEDICINE GP</option>
				    <option value="CASH MEDICINE SRINAGAR">CASH MEDICINE SRINAGAR</option>
				    <option value="CASH MEDICINE GHAZIABAD">CASH MEDICINE GHAZIABAD</option>
					<option value="Hormonal Ghaziabad">Hormonal Ghaziabad</option>
					<option value="HORMONAL SRINAGAR">HORMONAL SRINAGAR</option>
					<option value="Hormonal Delhi">Hormonal Delhi</option>
					<option value="Hormonal Gurgaon">Hormonal Gurgaon</option>
					<option value="Hormonal Noida">Hormonal Noida</option>
					<option value="Embryologist Noida">Embryologist Noida</option>
					<option value="OT Noida">OT Noida</option>
					<option value="OT Basant Lok">OT Basant Lok</option>
					<option value="Embryology Basant Lok">Embryology Basant Lok</option>
					<option value="Embryology Srinagar">Embryology Srinagar</option>
					<option value="OT Srinagar">OT Srinagar</option>
				</select>
			</div>
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
	 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		$('#consumables_serial_'+count).val('');
		$('#consumables_company_'+count).val('');
		$('#consumables_item_name_'+count).val('');
		$('#consumables_quantity_'+count).val('');
		$('#consumables_stock_'+count).val('');
		$('#consumables_price_'+count).val('');
		$('#consumables_quantity_'+count).attr("item_number", "");
		$('#consumables_batch_number_'+count).val('');
		$('#consumables_gstrate_'+count).val('');
		$('#consumables_hsn_'+count).val('');
		$('#consumables_mrp_'+count).val('');
		$('#consumables_pack_size_'+count).val('');
		$('#consumables_gstdivision_'+count).val('');
		$('#consumables_vendor_price_'+count).val('');
		$('#consumables_brand_name_'+count).val('');
		  
		if(serial != ''){
			var serial = $(this).val();
			var company = $(this).find(':selected').attr('company');
			var item_name = $(this).find(':selected').attr('item_name');
			var batch_number = $(this).find(':selected').attr('batch_number');
			var gstrate = $(this).find(':selected').attr('gstrate');
			var hsn = $(this).find(':selected').attr('hsn');
			var mrp = $(this).find(':selected').attr('mrp');
			var pack_size = $(this).find(':selected').attr('pack_size');
			var gstdivision = $(this).find(':selected').attr('gstdivision');
			var quantity = $(this).find(':selected').attr('quantity');
			var fees = $(this).find(':selected').attr('fees');
			var vendor_price = $(this).find(':selected').attr('vendor_price');
			var brand_name = $(this).find(':selected').attr('brand_name');
			
			$('#consumables_serial_'+count).val(serial);
			$('#consumables_company_'+count).val(company);
			$('#consumables_item_name_'+count).val(item_name);
			$('#consumables_batch_number_'+count).val(batch_number);
			$('#consumables_gstrate_'+count).val(gstrate);
			$('#consumables_hsn_'+count).val(hsn);
			$('#consumables_mrp_'+count).val(mrp);
			$('#consumables_pack_size_'+count).val(pack_size);
			$('#consumables_gstdivision_'+count).val(gstdivision);
            $('#consumables_stock_'+count).val(quantity);
			$('#consumables_quantity_'+count).attr({'max': parseInt(quantity), 'min': 0});
            $('#consumables_quantity_'+count).attr("item_number", serial);
			$('#consumables_quantity_'+count).attr("item_quantity", quantity);
			$('#consumables_price_'+count).val(fees);
    		$('#consumables_vendor_price_'+count).val(vendor_price);
			$('#consumables_brand_name_'+count).val(brand_name);
		}
	});
	
	 $(document).ready(function(){
		 
		$(".add-consumables-row").click(function(){
			var rows= $('#consumables_table_body tr:last').attr('trcount');
			var count = parseFloat(rows) + 1;
            var markup = '<tr class="consumables_row_'+count+'" trcount="'+count+'"><td><input type="checkbox" class="active-statuss"  rel="consumables"  index="'+count+'"></td><td><input value="" placeholder="Serial Number" readonly="readonly" id="consumables_serial_'+count+'" class="cons-cls-'+count+' consumables_serial_'+count+' form-control " name="consumables_serial_'+count+'" type="text" required></td><td class="role cons_cls_'+count+'"><select disabled name="consumables_name_'+count+'" class="cons-cls-'+count+' item_select consumables_select form-control " id="consumables_name_'+count+'" count="'+count+'" required><option value="">Select</option><?php foreach($consumables as $key => $val){ ?><option value="<?php echo $val['item_number']; ?>" quantity="<?php echo $val['quantity']; ?>" fees="<?php echo $val['price']; ?>" item_name="<?php echo $val['item_name']; ?>" batch_number="<?php echo $val['batch_number']; ?>" vendor_price="<?php echo $val['vendor_price']; ?>" pack_size="<?php echo $val['pack_size']; ?>" gstrate="<?php echo $val['gstrate']; ?>" mrp="<?php echo $val['mrp']; ?>" hsn="<?php echo $val['hsn']; ?>" gstdivision="<?php echo $val['gstdivision']; ?>" company="<?php echo $val['company']; ?>" brand_name="<?php echo $val['brand_name']; ?>"><?php echo $val['item_name']; ?></option><?php } ?></select></td><td><input value="" qcount="'+count+'" onkeyup="consumables_quantity_update(this)" placeholder="Consumption/patient (unit)"  item_number="" item_quantity="" id="consumables_quantity_'+count+'" disabled class="consumables_quantity consumables_quantity_'+count+' form-control cons-cls-'+count+'" name="consumables_quantity_'+count+'" type="text" min="0" required></td><td><input value="" placeholder="Batch Number" readonly="readonly" id="consumables_batch_number_'+count+'" class="cons-cls-'+count+' consumables_batch_number form-control "  name="consumables_batch_number_'+count+'" type="text" required></td><td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_'+count+'" class="cons-cls-'+count+' consumables_price form-control "  name="consumables_price_'+count+'" type="text" required></td><td><input value="" readonly="" id="consumables_vendor_price_'+count+'" class="cons-cls-'+count+' consumables_vendor_price_'+count+' form-control " name="consumables_vendor_price_'+count+'" type="text"></td><td><input value="" placeholder="pack size" readonly="readonly" id="consumables_pack_size_'+count+'" class="cons-cls-'+count+' consumables_pack_size_'+count+' form-control " name="consumables_pack_size_'+count+'" type="text"></td><td><input value="" placeholder="Tax" readonly="readonly" id="consumables_mrp_'+count+'" class="cons-cls-'+count+' consumables_mrp_'+count+' form-control " name="consumables_mrp_'+count+'" type="text"></td><td><input value="" id="consumables_gstrate_'+count+'" class="cons-cls-'+count+' consumables_gstrate_'+count+' form-control " name="consumables_gstrate_'+count+'" readonly="readonly" type="text"><input value="" placeholder="Tax" readonly="readonly" id="consumables_hsn_'+count+'" class="cons-cls-'+count+' consumables_hsn_'+count+' form-control " name="consumables_hsn_'+count+'" type="hidden"><input value="" placeholder="Tax" readonly="readonly" id="consumables_gstdivision_'+count+'" class="cons-cls-'+count+' consumables_gstdivision_'+count+' form-control " name="consumables_gstdivision_'+count+'" type="hidden"></td><td style="display:none"><input value="" id="consumables_item_name_'+count+'" class="cons-cls-'+count+' consumables_item_name_'+count+' form-control " name="consumables_item_name_'+count+'" type="hidden"><input value="" id="consumables_company_'+count+'" class="cons-cls-'+count+' consumables_company_'+count+' form-control " name="consumables_company_'+count+'" type="hidden"><input value="" id="consumables_brand_name_'+count+'" class="cons-cls-'+count+' consumables_brand_name_'+count+' form-control " name="consumables_brand_name_'+count+'" type="hidden"></td><td><input type="checkbox" class="statuss" name="record"></td></tr>';
             $("table tbody#consumables_table_body").append(markup);
		//	calculate_fees();
        });
        
        // Find and remove selected table rows
        $(".delete-consumables-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
			});
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
</script>


<script>
    function consumables_quantity_update(element) {
        const idSuffix = element.id.split('_')[2];
        const vendorPriceInput = document.getElementById(`consumables_vendor_price_${idSuffix}`);
        const totalPriceInput = document.getElementById(`consumables_price_${idSuffix}`);

        const quantity = parseFloat(element.value) || 0;
        const vendorPrice = parseFloat(vendorPriceInput.value) || 0;

        const totalPrice = quantity * vendorPrice;

        totalPriceInput.value = totalPrice.toFixed(2);
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
