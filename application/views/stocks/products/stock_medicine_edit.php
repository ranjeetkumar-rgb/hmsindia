<?php //var_dump($data);die;?>
<?php $all_method =&get_instance(); ?>

  <form class="col-sm-12 col-xs-12" method="post" action="" >

    <input type="hidden" name="action" value="update_medicine_products" />

    <input type="hidden" name="ID" value="<?php echo $data['ID']; ?>" />

    <div class="row">

      <div class="col-sm-12 col-xs-12 panel panel-piluku">

        <div class="panel-heading">

          <h3 class="heading">Edit Product</h3>

        </div>

        <div class="panel-body profile-edit">

          <p>

          <div class="row">
		    <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Product Name (Required)</label>
              <input value="<?php echo $data['name']?>" placeholder="Product name" id="name" name="name" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Company</label>
                <input value="<?php echo $data['company']?>" placeholder="Company Name" id="company" name="company" type="text" class="form-control validate" required>
			 </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Generic Name</label>
                <input value="<?php echo $data['generic_name']?>" placeholder="Generic Name" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Pack Size</label>
                <input value="<?php echo $data['pack_size']?>" placeholder="Pack Size" id="pack_size" name="pack_size" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">HSN</label>
                <input value="<?php echo $data['hsn']?>" placeholder="HSN" id="hsn" name="hsn" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST Rate</label>
                <input value="<?php echo $data['gstrate']?>" placeholder="GST Rate" id="gstrate" name="gstrate" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST Division</label>
                <input value="<?php echo $data['gstdivision']?>" placeholder="GST Division" id="gstdivision" name="gstdivision" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Vendor Price</label>
                <input value="<?php echo $data['vendor_price']?>" placeholder="Vendor Price" id="vendor_price" name="vendor_price" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Pack MRP</label>
                <input value="<?php echo $data['mrp']?>" placeholder="Pack MRP" id="mrp" name="mrp" type="text" class="form-control validate" required>
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
			 <label for="item_name">Brands (Required)</label>  <?php echo $all_method->get_brand_name($data['brand_number']);?>
					<select class="form-control select2" name="brand_number" id="brand_number" required>
					 <option value="">-- Select --</option>
                      <?php 
                      if(!empty($brands)){
                        foreach($brands as $key => $val){ $selected=""; if($value['brand_number'] ==  $data['brand_number']){$selected='selected="selected"';}  
                      ?>
                          <option value="<?php echo $val['brand_number']?>" <?php echo $selected; ?>><?php echo $val['name']?></option>
                        <?php } }?>
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
$(function(){
	  // turn the element to select2 select style
	  $('.select2').select2({
		placeholder: "Select stock item."
	  }).on('change', function(e) {
		var data = $(".select2 option:selected").val();
			
	  });
	
});
</script>