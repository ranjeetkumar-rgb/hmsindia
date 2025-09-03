<?php $all_method =&get_instance();?>
<form class="col-sm-12 col-xs-12" method="post" action="" >
  <input type="hidden" name="action" value="update_transfer_item" />
  <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>" />
  <input type="hidden" name="item_number" value="<?php echo $data['item_number']; ?>" />
	<input type="hidden" name="employee_number" id="employee_number" value="<?php echo $data['r_employee_number']; ?>" />
  <input type="hidden" name="center_number" id="center_number" value="<?php echo $data['r_center_number']; ?>" />
  <input type="hidden" name="department" id="department" value="<?php echo $data['r_department']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Purchase order</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>          
          <div class="row"> 
          <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Company (Required)</label>
              <input value="<?php echo $data['company']; ?>" id="company" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Item name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Batch Number (Required)</label>
              <input value="<?php echo $data['batch_number']; ?>" id="batch_number" name="batch_number" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Order quantity (Required)</label>
              <input value="<?php echo $data['quantity']?>" id="quantity" name="quantity" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Expiry (Required)</label>
              <input value="<?php echo $data['expiry']; ?>" id="expiry" name="expiry" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Expiry (Required)</label>
              <input value="<?php echo $data['expiry_day']; ?>" id="expiry_day" name="expiry_day" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Vendor Price (Required)</label>
              <input value="<?php echo $data['vendor_price']; ?>" id="vendor_price" name="vendor_price" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">MRP (Required)</label>
              <input value="<?php echo $data['mrp']; ?>" id="mrp" name="mrp" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">HSN (Required)</label>
              <input value="<?php echo $data['hsn']; ?>" id="hsn" name="hsn" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Gst Rate (Required)</label>
              <input value="<?php echo $data['gstrate']?>" placeholder="GST" id="gstrate" name="gstrate" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">GST Division (Required)</label>
              <input value="<?php echo $data['gstdivision']?>" placeholder="GST" id="gstdivision" name="gstdivision" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Pack Size (Required)</label>
              <input value="<?php echo $data['pack_size']?>" readonly="" id="pack_size" name="pack_size" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Generic Name (Required)</label>
				<input value="<?php echo $data['brand_name']?>" readonly="" id="brand_name" name="brand_name" type="hidden" class="form-control validate" required>
				<input value="<?php echo $data['vendor_number']?>" readonly="" id="vendor_number" name="vendor_number" type="hidden" class="form-control validate" required>
				<input value="<?php echo $data['generic_name']?>" readonly="" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
				<input value="<?php echo $data['category']?>" readonly="" id="category" name="category" type="hidden" class="form-control validate" required>
				<input value="<?php echo $data['date_of_purchase']?>" readonly="" id="date_of_purchase" name="date_of_purchase" type="hidden" class="form-control validate">
				<input value="<?php echo $data['invoice_no']?>" readonly="" id="invoice_no" name="invoice_no" type="hidden" class="form-control validate"></div>
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