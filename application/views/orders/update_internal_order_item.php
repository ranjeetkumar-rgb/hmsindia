<?php $all_method =&get_instance();?>
<form class="col-sm-12 col-xs-12" method="post" id="admin_order_form" action="" enctype="multipart/form-data">
    <input type="hidden" class="required_value" name="action" value="update_internal_item" required />
    <input type="hidden" class="required_value" id="action_type" name="action_type" value="update" required />
    <input type="hidden" class="required_value" id="item-number-field" name="item_number" value="<?php echo $purchase_data['item_number']; ?>" required />
    <input type="hidden" class="required_value" id="order-number-field" name="order_number" value="<?php echo $purchase_data['order_number']; ?>" required />
    <input type="hidden" class="required_value" id="product_id" name="product_id" value="<?php echo $all_method->get_product_id($purchase_data['item_number']);?>" required />
    <input type="hidden" class="required_value" id="generic_name" name="generic_name" value="<?php echo $all_method->get_generic_name($purchase_data['item_number']);?>" required />
    <input type="hidden" class="required_value" id="gstdivision" name="gstdivision" value="<?php echo $all_method->get_gstdivision($purchase_data['item_number']);?>" required />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Update order item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>          
          <div class="row"> 
             <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Purchase Po No (Required)</label>
              <input value="<?php echo $purchase_data['po_number']; ?>" readonly="readonly" id="purchase_po_no" name="purchase_po_no" type="text" class="editable form-control required_value" required>
            </div>	
             <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Po Date (Required)</label>
              <input value="<?php echo $purchase_data['order_place']; ?>" readonly="readonly" id="po_date" name="po_date" type="text" class="editable form-control required_value" required>
            </div>				
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Item name (Required)</label>
              <input value="<?php echo $purchase_data['item_name']; ?>" readonly="readonly" id="item_name" name="item_name" type="text" class="editable form-control required_value" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Item number</label>
	              <p id="item_number_text"><?php echo $purchase_data['item_number']; ?></p>
           </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Company (Required)</label>
              <input value="<?php echo $purchase_data['company']; ?>" readonly="readonly" id="company" name="company" type="text" class="editable form-control required_value" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Vendor (Required)</label> 
			      <input type="text" value="<?php echo $all_method->get_vendor_name($purchase_data['vendor_number']); ?>" id="vendor_name" readonly="readonly" name="vendor_name" class="editable form-control required_value">	
                <input type="hidden" value="<?php echo $purchase_data['vendor_number']; ?>" id="vendor_number" readonly="readonly" name="vendor_number" class="editable form-control required_value">			  
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-4 col-xs-12">
             <label for="expiry">Brand (Required)</label> 
			    <input type="text" value="<?php echo $all_method->get_brand_name($purchase_data['brand_name']);?>" id="brand" readonly="readonly" name="brand" class="editable form-control required_value">
                <input type="hidden" value="<?php echo $purchase_data['brand_name'];?>" id="brand_name" readonly="readonly" name="brand_name" class="editable form-control required_value">			 
              <!--<select name="brand_name" id="brand_name" class="form-control required_value" required>
              		<option value="">Select Brands</option>
              	<?php foreach($brands as $key => $value){ ?>
                	<option value="<?php echo $value['brand_number']; ?>" <?php if($value['brand_number'] == $purchase_data['brand_name']){echo "selected='selected'"; }?>><?php echo $value['name']; ?></option>
                <?php } ?>
              </select>-->
              
            </div><?php $quantity = $purchase_data['order_quantity']; ?>
           <!-- <div class="form-group col-sm-2 col-xs-12 order_quantity">
              <label for="expiry">Ordered quantity (units) (Required)</label>
              <input value="<?php echo $purchase_data['order_quantity']?>" order_qty="<?php echo $quantity; ?>" id="order_qty" name="order_qty" onchange="consumables_quantity_update(this)" type="number" class="form-control">
            </div>-->
            <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Order quantity (units) (Required)</label>
            <input value="<?php echo $purchase_data['order_quantity']?>" quantity="<?php echo $quantity; ?>" id="quantity" name="quantity" type="number"  class="form-control validate" required readonly>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Order quantity (Pack)</label>
              <?php $order_qty_pack =  $purchase_data['order_quantity'] / $purchase_data['pack_size']; ?>
            <input value="<?php echo $order_qty_pack ?>"  id="order_qty_pack" order_qty_pack="<?php echo $order_qty_pack ?>" name="order_qty_pack"  type="number" class="form-control validate" onchange="consumables_quantity_update(this)" required oninput="calculateValues()">
			</div>
            <div class="form-group col-sm-4 col-xs-12" >
                  <label for="quantity">Free Quantity</label>
				  <input value="" placeholder="Free Quantity" id="free_quantity" name="free_quantity" type="number" class="form-control">
                  <!--<input value="" placeholder="Quantity" id="quantity" name="quantity" type="Number" class="form-control validate" required>-->
                </div>
               
                  <div class="col-sm-4 col-xs-12" style="display:none;">
                      <input value="" placeholder="Units" id="units" name="units" type="number" class="form-control">
                  </div>
            
          <!--<div class="row">
            <div class="form-group col-sm-6 col-xs-12">
             <label for="expiry">Generic name (Required)</label>
              <input value="<?php //echo $data['generic_name']; ?>" readonly="readonly" id="generic_name" name="generic_name" type="text" class="editable form-control" >
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Safety stock (units) (Required)</label>
              <input value="<?php //echo $data['safety_stock'];?>" readonly="readonly" id="safety_stock" name="safety_stock" type="text" class="form-control">
            </div>
          </div>-->
          
            <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Expiry Date (Required)</label>
              <input value="" placeholder="Expiry date" id="expiry" name="expiry" type="text" class="form-control required_value" required>
            </div>
            
            <div class="form-group col-sm-4 col-xs-12">
                  <label for="expiry">Notify expiry on (Required)</label>
                  <input value="" readonly="readonly" placeholder="Notify expiry on" id="expiry_day" name="expiry_day" type="text" class="form-control required_value" required>
           </div>
                
            <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Vendor Price (Required)</label>
              <input value="<?php echo $purchase_data['vendor_price']?>" placeholder="Vendor Price" id="vendor_price" name="vendor_price" type="text" class="editable form-control required_value" required>
            </div>
            
          
            <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Total Vendor Price (excl GST)</label>
              <input value="<?php echo $data['total_purchase_value_excl_gst']; ?>" readonly="" id="total_purchase_value_excl_gst" name="total_purchase_value_excl_gst" type="text" class="form-control validate" required>
			</div>
			 <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Discount Amount</label>
              <input value="" placeholder="Discount Amount" id="discount_amt" name="discount_amt" type="text" class="editable form-control">
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">MRP (Required)</label>
              <input value="<?php echo $purchase_data['mrp']?>" placeholder="MRP" id="mrp" name="mrp" type="text" class="editable form-control required_value" readonly="readonly" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">GST (Required)</label>
              <input value="<?php echo $purchase_data['gstrate']?>" placeholder="GST" id="gstrate" name="gstrate" type="text" class="editable form-control" readonly="readonly" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">HSN Code (Required)</label>
              <input value="<?php echo $purchase_data['hsn']?>" placeholder="HSN" id="hsn" name="hsn" type="text" class="editable form-control" readonly="readonly" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="quantity">Category (Required)</label>
              <select name="category" class="form-control required_value" required>
              		<option value="">Select Categories</option>
              	<?php foreach($categories as $key => $value){ ?>
                	<option value="<?php echo $value['category_id']; ?>" <?php if($value['category_id'] == $data['category']){echo "selected='selected'"; }?>><?php echo $value['name']; ?></option>
                <?php } ?>
              </select>
            </div>
		    <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Vendor billing receipt</label>
              <input value="" placeholder="Vendor billing receipt" id="vendor_billing" name="vendor_billing" type="file" class="form-control" required>
            </div>
			 <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Invoice No</label>
              <input value="" placeholder="Bill No" id="invoice_no" name="invoice_no" type="text" class="form-control" required>
            </div>
          </div>
          
          <div class="row batch_number"> 
           		  
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Batch number(Required)</label>
              <input value="<?php echo $data['batch_number']?>" placeholder="Batch number" id="batch_number" name="batch_number" type="text" class="form-control" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12 batch_number">
              <label for="expiry">Date Of Purchase</label>
              <input value="" placeholder="Delivery date" id="date_of_purchase" name="date_of_purchase" type="date" class="form-control" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12 batch_number">
              <label for="expiry">Freight Forwarding Charges</label>
              <input value="" placeholder="Freight Forwarding Charges" id="freight_forwarding_charges" name="freight_forwarding_charges" type="text" class="form-control">
            </div>
            <div class="form-group col-sm-4 col-xs-12 batch_number"> 
              <label for="expiry">Center Location</label>
				<select name="centre_location" id="centre_location" class="form-control required_value" required>
              		<option value="">Select Center</option>
              	<?php 
				$all_centers = $all_method->get_all_centers();
				foreach ($all_centers as $val) { 
				// Check if the current center matches the selected one
				$selected = ($center == $val['ship_to']) ? '' : '';
				// Use `center_number` as the value (if needed) or `ship_to`
				echo '<option value="' . $val['center_number'] . '" ' . $selected . '>' . $val['center_name'] . '</option>';
				} 
				?>
				</select>
            </div>
			 <div class="form-group col-sm-4 col-xs-12 batch_number">
              <label for="expiry">Receive By</label>
              <input value="" placeholder="Receive By" id="received_by" name="received_by" type="text" class="form-control" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12 batch_number">
              <label for="expiry">Date Of Receiving</label>
              <input value="" placeholder="Delivery date" id="date_of_receiving" name="date_of_receiving" type="date" class="form-control" required>
            </div>
			 <div class="form-group col-sm-4 col-xs-12 batch_number">
              <label for="expiry">Comment</label>
              <input value="" placeholder="Comment" id="comment" name="comment" type="text" class="form-control">
            </div>
             <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Pack Size</label>
              <input value="<?php echo $purchase_data['pack_size']; ?>" id="pack_size" name="pack_size" type="text" class="form-control validate" readonly required>
			</div>
          </div>
        </div>  
              
        <div class="clearfix"></div>
        <div class="form-group col-sm-12 col-xs-12">
          <a class="btn btn-large"  onclick="ConfirmDelete()" id="submitbutton" href="javascript:void(0);">Submit</a>
          <a class="btn btn-large" href="<?php echo base_url()."orders/my_orders";?>">Cancel</a>
        </div>
        </p>
      </div>
    </div>
  </form>
  
  <script>
  	$(function(){
	  $('#brand_name').on('change', function(e) {
			$.ajax({
				url: '<?php echo base_url('orders/generate_itemnumber')?>',
				data: {},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('div.order_quantity').hide();
					$('#order_qty').removeClass('required_value');
					$('#lots').addClass('required_value');
					$('#units').addClass('required_value'); 
					$('#batch_number').addClass('required_value');
					$('#delivery_date').addClass('required_value');
					$('div.batch_number').show();
					$('div.insert_order_quantity').show();
					$('#item_name').val('');
					$('#company').val('');
					$('#price').val('');
					$('#bill_no').val('');
					$('#generic_name').addClass('required_value');
					$(".editable").attr("readonly", false);
					$('#action_type').val('insert');
					$("#item-number-field").val(data);
					$("#item_number_text").empty().append(data);
				}
		   });
			
	  });
	
	});
	
function gimmeYesterday(selectedDate) {
		
		var d = new Date(selectedDate);
		var day = d.getDate();
	  	var month = d.getMonth(); 
		if(month == 0){month = 12; }
		if(day == 30 || day == 31 || day == 29){ day = 28; }
		var year = d.getFullYear();
		if (day < 10) { day = "0" + day; }
		if (month < 10) {month = "0" + month;}
		var newDate = year + "-" + month + "-" + day;
		return newDate;
}

  $( function() {
    $( "#expiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    }).on('change', function(ev){
		var lastmonth = gimmeYesterday($(this).val())
		$( "#expiry_day" ).val(lastmonth);
    });
	
	 $( "#delivery_date" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat: 'yy-mm-dd',
     });
  } );
  
  function ConfirmDelete()
	{
		  var value = $('.required_value').filter(function () {
			return this.value === '';
		  });
		  if (value.length == 0) {
		  	var x = confirm("Are you sure you want to update the stock?");
			if (x){
				  $('form#admin_order_form').submit();
				  return true;
			}else{
				window.location.reload();
				return false;
			}
		  } else if (value.length > 0) { alert('Please fill out mandatory fields.'); }
	}
</script>


  
  <script>
function calculateValues() {
    let orderQtyPack = document.getElementById('order_qty_pack').value;
    let packSize = document.getElementById('pack_size') ? document.getElementById('pack_size').value : 1;
    let vendorPrice = document.getElementById('vendor_price') ? document.getElementById('vendor_price').value : 0;

    // Ensure values are numbers
    orderQtyPack = parseFloat(orderQtyPack) || 0;
    packSize = parseFloat(packSize) || 0;
    vendorPrice = parseFloat(vendorPrice) || 0;

    // Calculate the order quantity
    let orderQuantity = orderQtyPack * packSize;

    // Update the order quantity field
    if (document.getElementById('quantity')) {
        document.getElementById('quantity').value = orderQuantity;
    }

    // Calculate the total vendor price
    let totalVendorPrice = orderQtyPack * vendorPrice;

    // Update the total vendor price field
    if (document.getElementById('total_purchase_value_excl_gst')) {
        document.getElementById('total_purchase_value_excl_gst').value = totalVendorPrice.toFixed(2);
    }
}
</script>

<script>
    function consumables_quantity_update(el) {
      // Get the quantity and vendor price values
      var orderQty = document.getElementById('order_qty_pack').value;
      
     	var order_qty_pack = $(el).attr('order_qty_pack');
		var quantity = $(el).val();

		if (quantity > 0) {
			if (parseInt(order_qty_pack) < parseInt(quantity)) {
            alert('Order Quantity must be less than or equal to order');
				$(el).val("0");
				return false;
			}
		}
    }
  </script>