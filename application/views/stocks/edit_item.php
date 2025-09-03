<?php //var_dump($data);die;?>
  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_cent_item" />
    <input type="hidden" name="item_number" value="<?php echo $data['item_number']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Edit Item1</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Item Company (Required)</label>
              <input value="<?php echo $data['company']; ?>" placeholder="Company" id="company" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Item Name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" placeholder="Item name" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
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
          <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Generic name (Required)</label>
              <input value="<?php echo $data['generic_name']; ?>" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-2 col-xs-12">
                  <label for="quantity">Product Id</label>
                  <div class="clearfix"></div>
                  <input value="<?php echo $data['product_id']; ?>" placeholder="Units" id="product_id" name="product_id" type="Number" class="form-control validate" required>
                </div>
			 <div class="form-group col-sm-2 col-xs-12">
                  <label for="quantity">Quantity <span class="error">(Enter units only)</span></label>
                  <div class="clearfix"></div>
                  <input value="<?php echo $data['quantity']; ?>" placeholder="Units" id="quantity" name="quantity" type="Number" class="form-control validate" readonly="" required>
                </div>
			 <div class="form-group col-sm-2 col-xs-12">
                  <label for="quantity">Quantity <span class="error">(Enter units only)</span></label>
                  <div class="clearfix"></div>
                  <input value="0" placeholder="Units" id="quantity_in" name="quantity_in" type="Number" class="form-control validate">
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
                </div>
                
          <div class="row">
                
          		<div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Notify expiry on (Required)</label>
                  <input value="<?php echo $data['expiry_day']; ?>" placeholder="Notify expiry on" id="expiry_day" name="expiry_day" type="text" class="form-control validate" required>
                </div>
				<div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Category (Required)</label>
              <select name="category" class="form-control" required>
              		<option value="">Select Categories</option>
              	<?php foreach($categories as $key => $value){ $selected=""; if($value['category_id'] ==  $data['category']){$selected='selected="selected"';}  ?>
                	<option value="<?php echo $value['category_id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">MRP</label>
              <input value="<?php echo $data['mrp']; ?>" placeholder="MRP" id="mrp" name="mrp" type="text" class="form-control validate" required>
            </div>
			 <div class="form-group col-sm-6 col-xs-12">
             	 <label for="expiry">Vendor price (Required)</label>
	             <input value="<?php echo $data['vendor_price']; ?>" id="vendor_price" name="vendor_price" type="text" class="form-control validate" required>
             </div>
          </div>
          
          
          
          <div class="row">    
			<div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Order Qutatity (Required)</label>
              <input value="<?php echo $data['order_qty']; ?>" placeholder="Order Qutatity" id="order_qty" name="order_qty" type="number" class="form-control validate" required>
            </div> 
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Batch number (Required)</label>
              <input value="<?php echo $data['batch_number']; ?>" placeholder="Batch number" id="batch_number" name="batch_number" type="text" class="form-control validate" required>
            </div>        
            
          </div>
		  <div class="row">             
          		
               <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Pack Size</label>
              <input value="<?php echo $data['pack_size']; ?>" placeholder="Pack Size" id="pack_size" name="pack_size" type="text" class="form-control validate">
            </div>
              <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">HSN (Required)</label>
                <input value="<?php echo $data['hsn']; ?>"  placeholder="HSN" id="hsn" name="hsn" type="text" class="form-control validate">
              </div> 
          </div>
		  <div class="row">             
          	  <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST RATE</label>
                <input value="<?php echo $data['gstrate']; ?>"  placeholder="GST" id="gstrate" name="gstrate" type="text" class="form-control validate" required>
              </div>
			   <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST Division</label>
                <input value="<?php echo $data['gstdivision']; ?>" placeholder="GST Division" id="gstdivision" name="gstdivision" type="text" class="form-control validate" required>
              </div>
		  </div>
          
          <div class="row">    
			          
            <div class="form-group col-sm-6 col-xs-12">
              <label for="statuss">Status(Required)</label><br/>
               <input type="radio" name="status" value="1" class="statuss" <?php if($data['status'] == '1'){echo 'checked="checked"';}?>> Active 
               <input type="radio" name="status" value="0" class="statuss" <?php if($data['status'] == '0'){echo 'checked="checked"';}?>> Inactive
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
	//alert(gimmeYesterday(3));
	
  $( function() {
    $( "#expiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    }).on('change', function(ev){
		var lastmonth = gimmeYesterday($(this).val())
		$( "#expiry_day" ).val(lastmonth);
    });
	
	//alert(max_date);
	 $( "#expiry_day" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat: 'yy-mm-dd',
     });
  } );
</script>