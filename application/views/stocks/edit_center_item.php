<?php $all_method =&get_instance(); ?>
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_center_medicine" />
    <input type="hidden" id="item_number" name="item_number" value="<?php echo $data['item_number']; ?>" />
	<input type="hidden" name="ID" value="<?php echo $data['ID']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Edit Item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Item Company (Required)</label>
              <input value="<?php echo $data['company']; ?>"  placeholder="Company" id="company" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Item Name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" placeholder="Item name" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
          </div>
		  <div class="row">
      <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Vendors (Required)</label>
                <select class="select2 form-control" name="vendor_number" id="vendor_number" required>
                    <option value="">-- Select --</option>
                    <?php if(!empty($vendors)){
                      foreach($vendors as $key => $val){ $selected=""; if($val['vendor_number'] ==  $data['vendor_number']){$selected='selected="selected"';} 
                    ?>
                        <option value="<?php echo $val['vendor_number']?>" <?php echo $selected; ?>><?php echo $val['name']?></option>
                      <?php } }?>
                </select>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
			 <label for="item_name">Brands (Required) <?php //echo $all_method->get_brand_name($data['brand_name']);?></label> 
					<select class="form-control select2" name="brand_name" id="brand_name" required>
					 <option value="">-- Select --</option>
                      <?php 
                      if(!empty($brands)){
                        foreach($brands as $key => $val){ $selected=""; if($val['brand_number'] ==  $data['brand_name']){$selected='selected="selected"';}  
                      ?>
                          <option value="<?php echo $val['brand_number']?>" <?php echo $selected; ?>><?php echo $val['name']?></option>
                        <?php } }?>
                  </select>
          </div>
            <div class="form-group col-sm-6 col-xs-6">
              <label for="company">Generic Name</label>
              <input value="<?php echo $data['generic_name']; ?>" placeholder="Company" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-3 col-xs-12">
                  <label for="product_id">Product Id (Required)</label>
                  <input value="<?php echo $data['product_id']; ?>" placeholder="Product Id" id="product_id" name="product_id" type="number" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-3 col-xs-12">
                  <label for="quantity">Quantity (Required)</label>
                  <input value="<?php echo $data['quantity']; ?>" placeholder="Quantity" id="quantity" name="quantity" type="text" class="form-control validate" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Safety stock (Required)</label>
                      <input value="<?php echo $data['safety_stock']; ?>" placeholder="Safety stock" id="safety_stock" name="safety_stock" type="number" class="form-control validate" required>
                    </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Expiry Date (Required)</label>
              <input value="<?php echo $data['expiry']; ?>" placeholder="Expiry date" id="expiry" name="expiry" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Notify expiry on (Required)</label>
                  <input value="<?php echo $data['expiry_day']; ?>" placeholder="Notify expiry on" id="expiry_day" name="expiry_day" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12" style="margin-bottom: 40px;">
              <label for="quantity">Category (Required)</label>
              <select name="category" class="form-control" required>
              		<option value="<?php echo $data['category']; ?>"><?php echo $data['category']; ?></option>
              		<option value="1565461619">Package injections</option>
					<option value="1565461624">OT DCI</option>
					<option value="1565461628">EMBRYOLOGIST DCI</option>
					<option value="1579086005">Cash Medicines</option>
              </select>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">MRP</label>
              <input value="<?php echo $data['mrp']; ?>" placeholder="MRP" id="mrp" name="mrp" type="text" class="form-control">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Product Vendor Price</label>
              <input value="<?php echo $data['vendor_price']; ?>" placeholder="Product Vendor Price" id="vendor_price" name="vendor_price" type="text" class="form-control validate" required>
            </div>
			 <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Order Qutatity (Required)</label>
              <input value="<?php echo $data['order_qty']; ?>" placeholder="Order Qutatity" id="order_qty" name="order_qty" type="number" class="form-control validate" required>
            </div>
			 <div class="form-group col-sm-6 col-xs-6">
              <label for="company">Batch NUmber</label>
              <input value="<?php echo $data['batch_number']; ?>" placeholder="Batch Number" id="batch_number" name="batch_number" type="text" class="form-control validate" required>
            </div>
			 <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Pack Size</label>
              <input value="<?php echo $data['pack_size']; ?>" placeholder="Pack Size" id="pack_size" name="pack_size" type="text" class="form-control">
            </div>
			 <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">HSN No</label>
              <input value="<?php echo $data['hsn']; ?>" placeholder="HSN NO" id="hsn" name="hsn" type="text" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Tax Price (%)</label>
              <input value="<?php echo $data['gstrate']; ?>" placeholder="Gst Rate" id="gstrate" name="gstrate" type="text" class="form-control">
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">GST Division</label>
              <input value="<?php echo $data['gstdivision']; ?>" placeholder="GST Division" id="gstdivision" name="gstdivision" type="text" class="form-control">
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Date Of Purchase</label>
              <input value="<?php echo $data['date_of_purchase']; ?>" placeholder="GST Division" id="date_of_purchase" name="date_of_purchase" type="date" class="form-control">
            </div>
        </div>
		<div class="row">
		  <div class="col-sm-6 col-xs-12">
            	<label>Center</label>
			<select class="form-control" id="center_number" name="center_number">
    <option value="">--Select From--</option>
    <?php 
    $all_centers = $all_method->get_all_centers();
    foreach ($all_centers as $val) { 
        $selected = (isset($data['center_number']) && $data['center_number'] == $val['center_number']) ? 'selected="selected"' : '';
        echo '<option value="' . htmlspecialchars($val['center_number']) . '" ' . $selected . '>' 
            . htmlspecialchars($val['center_name']) . '</option>';
    } 
    ?>
</select>

            </div>
              <div class="col-sm-6 col-xs-12">
            	<label>Department</label>
               <select class="form-control" id="department" name="department">
    <option value="">--Select From--</option>
    <option value="Embryologist Noida" <?php echo ($data['department'] == 'Embryologist Noida') ? 'selected' : ''; ?>>Embryologist Noida</option>
    <option value="billing" <?php echo ($data['department'] == 'billing') ? 'selected' : ''; ?>>Cash Billing</option>
    <option value="Hormonal" <?php echo ($data['department'] == 'Hormonal') ? 'selected' : ''; ?>>Hormonal</option>
    <option value="OT Noida" <?php echo ($data['department'] == 'OT Noida') ? 'selected' : ''; ?>>OT Noida</option>
    <option value="Embryologist Basant Lok" <?php echo ($data['department'] == 'Embryologist Basant Lok') ? 'selected' : ''; ?>>Embryologist Basant Lok</option>
    <option value="OT Basant Lok" <?php echo ($data['department'] == 'OT Basant Lok') ? 'selected' : ''; ?>>OT Basant Lok</option>
    <option value="Nonsaleable" <?php echo ($data['department'] == 'Nonsaleable') ? 'selected' : ''; ?>>Nonsaleable</option>
    <option value="OT Srinagar" <?php echo ($data['department'] == 'OT Srinagar ') ? 'selected' : ''; ?>>OT Srinagar</option>
    <option value="Embryology Srinagar" <?php echo ($data['department'] == 'Embryology Srinagar') ? 'selected' : ''; ?>>Embryology Srinagar</option>
    <option value="warehouse" <?php echo ($data['department'] == 'warehouse') ? 'selected' : ''; ?>>Warehouse</option>
</select>

				
				
            </div>	
            <div class="col-sm-6 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                <select class="form-control" id="employee_number" name="employee_number">
                	<option value=''>--Select From--</option>
                    <?php $all_emplyee = $all_method->get_employee_list();
						            foreach($all_emplyee as $key => $val){ //var_dump($val);die;
									 $selected = (isset($data['employee_number']) && $data['employee_number'] == $val['employee_number']) ? 'selected="selected"' : '';
        echo '<option value="' . htmlspecialchars($val['employee_number']) . '" ' . $selected . '>' 
            . htmlspecialchars($val['name']) . '</option>';
			
                    	  } 
					    ?>
                </select>
			</div>
		</div>
       <div class="row">  
            <div class="form-group col-sm-6 col-xs-12">
              <label for="Landline">Status(Required)</label><br/>
               <input type="radio" name="status" <?php if($data['status'] == '1'){echo "checked='checked'";} ?> value="1" class="statuss" > Active 
               <input type="radio" name="status" <?php if($data['status'] == '0'){echo "checked='checked'";} ?> value="0" class="statuss"> Inactive
               <input type="hidden" id="employee_number" name="employee_number" value="<?php echo $data['employee_number']; ?>" />
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
  $( function() {
    $( "#expiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
	 $( "#expiry_day" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat: 'yy-mm-dd',
		  maxDate: '0'
     });
  } );
</script>