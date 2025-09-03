<?php //var_dump($data);die;?>
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="add_purchase_orders" />
    <input type="hidden" name="item_number" value="<?php echo $data['item_number']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Purchase order</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Item name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" id="item_name" name="item_name" readonly="" type="text" class="form-control validate" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Item number</label>
				<input value="<?php echo $data['item_number']; ?>" id="item_number" readonly="" name="item_number" type="text" class="form-control validate" required>
            
	       </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Company (Required)</label>
              <input value="<?php echo $data['company']; ?>" id="company" name="company" readonly="" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Vendor (Required)</label>
             <select name="" class="form-control" required id="vendorSelect" <?php echo (!empty($data['vendor_number']) ? 'disabled' : ''); ?> onchange="updateVendorInput()">
				<option value="">Select vendor</option>
				<?php foreach($vendors as $key => $value) { $selected = ($value['vendor_number'] ==  $data['vendor_number']) ? 'selected="selected"' : ''; ?>
				<option value="<?php echo $value['vendor_number']; ?>" 
                <?php echo $selected; ?>>
				<?php echo $value['name']; ?>
				</option>
				<?php } ?>
				</select>
				<input type="hidden" id="vendor_number" name="vendor_number" class="form-control" value="<?php echo $data['vendor_number'] ?? ''; ?>" readonly>
            </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
             <label for="expiry">Brand (Required)</label>
				<select name="" class="form-control" id="brandSelect" required <?php echo (!empty($data['brand_name']) ? 'disabled' : ''); ?>>
				<option value="">Select Brands</option>
				<?php foreach($brands as $key => $value) { $selected = ($value['brand_number'] ==  $data['brand_name']) ? 'selected="selected"' : ''; ?>
				<option value="<?php echo $value['brand_number']; ?>" 
                <?php echo $selected; ?>>
				<?php echo $value['name']; ?>
				</option>
				<?php } ?>
				</select>
				<input type="hidden" id="brand_name" name="brand_name" class="form-control" value="<?php echo $data['brand_name'] ?? ''; ?>"readonly>
			</div>
            <div class="form-group col-sm-3 col-xs-12">
              <label for="expiry">Order quantity (units) (Required)</label>
            <input value="<?php echo $data['order_qty']?>" id="order_quantity" name="order_quantity" type="number" class="form-control validate" required readonly>
            </div>
			 <div class="form-group col-sm-3 col-xs-12">
              <label for="expiry">Order quantity (Pack)</label>
            <input value="<?php echo $data['order_qty_pack']?>"  id="order_qty_pack" name="order_qty_pack"  type="number" class="form-control validate" required oninput="calculateValues()">
			</div>
          </div>
          
          <div class="row">            
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">MRP</label>
              <input value="<?php echo $data['mrp']?>" readonly="" id="mrp" name="mrp" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-3 col-xs-12">
              <label for="expiry">Vendor Price (excl GST) (Pack)</label>
              <input value="<?php echo round($data['vendor_price'] / $data['gstdivision'],2) ?>" readonly="" id="" name="" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-3 col-xs-12">
              <label for="expiry">Total Vendor Price (excl GST)</label>
              <input value="<?php echo $data['total_vendor_price']; ?>" readonly="" id="total_vendor_price" name="total_vendor_price" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">HSN Code</label>
              <input value="<?php echo $data['hsn']; ?>" readonly="" id="hsn" name="hsn" type="text" class="form-control validate" required>
			</div>
      <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Pack Size</label>
              <input value="<?php echo $data['pack_size']; ?>" id="pack_size" name="pack_size" type="text" class="form-control validate" readonly required>
			</div>
      <div class="form-group col-sm-4 col-xs-12" style="display:none;">
              <label for="expiry">Batch Number</label>
              <input value="<?php echo $data['batch_number']; ?>" id="batch_number" name="batch_number" readonly="" type="text" class="form-control validate" required>
			</div>
 <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">GST</label>
              <input value="<?php echo $data['gstrate']?>" readonly="" id="gstrate" name="gstrate" type="text" class="form-control validate" required>
			  <input value="<?php echo $data['gstdivision']?>" readonly="" id="gstdivision" name="gstdivision" type="hidden" class="form-control validate" required>
            </div>
			
          </div>
		  <div class="row"> 
            		  
           
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Vendor Price (Incl GST) (Pack)</label>
              <input value="<?php echo $data['vendor_price']?>" readonly id="vendor_price" name="vendor_price" type="text" class="form-control">
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">GST Amount</label>
              <input value="<?php echo $data['vendor_price'] - round($data['vendor_price'] / $data['gstdivision'],2) ?>" readonly="" id="" name="" type="text" class="form-control">
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">GST No</label>
              <input value="<?php echo $data['gst_number']?>" id="gst_number" name="gst_number" type="text" class="form-control">
              
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Ship To</label>
               <select name="ship_to" id="ship_to" class="form-control" readonly="" required>
              		<option value="">Select Center</option>
              	<option value="India IVF clinic Noida, Third Floor, N-26, Sector 18, Noida, Gautambuddha Nagar, Uttar Pradesh, 201301">Noida</option>
                <option value="India IVF clinic Gurgaon 167 P, Lower Ground Floor, Sector 51, Gurugram, 122001">Gurgaon</option>
				<option value="F-11, Lower Ground Floor, Block F, Green Park Extension, Green Park, New Delhi, Delhi 110016">Green Park</option>
				<option value="2nd Floor, District Centre, C-53B, opposite Petrol Pump, RDC, Raj Nagar, Ghaziabad, Uttar Pradesh 201002">Ghaziabad</option>
				<option value="Kanitar chowk, above Metropolis Lab, Lal Bazar, Srinagar, Jammu and Kashmir 190006">Srinagar</option>
              </select>
			  </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Bill To</label>
             <select name="bill_to" id="bill_to" class="form-control" readonly="" required>
              		<option value="">Select Center</option>
              	<option value="India IVF clinic Noida, Third Floor, N-26, Sector 18, Noida, Gautambuddha Nagar, Uttar Pradesh, 201301">Noida</option>
                <option value="India IVF clinic Gurgaon 167 P, Lower Ground Floor, Sector 51, Gurugram, 122001">Gurgaon</option>
				<option value="F-11, Lower Ground Floor, Block F, Green Park Extension, Green Park, New Delhi, Delhi 110016">Green Park</option>
				<option value="2nd Floor, District Centre, C-53B, opposite Petrol Pump, RDC, Raj Nagar, Ghaziabad, Uttar Pradesh 201002">Ghaziabad</option>
				<option value="Kanitar chowk, above Metropolis Lab, Lal Bazar, Srinagar, Jammu and Kashmir 190006">Srinagar</option>
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
              </select>
			</div>
		  </div>
           
        </div>        
        <div class="clearfix"></div>
        <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />
        </div>
        </p>
      </div>
    </div>
  </form>
  
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
    if (document.getElementById('order_quantity')) {
        document.getElementById('order_quantity').value = orderQuantity;
    }

    // Calculate the total vendor price
    let totalVendorPrice = orderQtyPack * vendorPrice;

    // Update the total vendor price field
    if (document.getElementById('total_vendor_price')) {
        document.getElementById('total_vendor_price').value = totalVendorPrice.toFixed(2);
    }
}
</script>
