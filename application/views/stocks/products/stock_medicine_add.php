

  <form class="col-sm-12 col-xs-12" method="post" action="" >

    <input type="hidden" name="action" value="add_medicines" />

    <div class="row">

      <div class="col-sm-12 col-xs-12 panel panel-piluku">

        <div class="panel-heading">

          <h3 class="heading">Add Medicines Name</h3>

        </div>

        <div class="panel-body profile-edit">

          <p>

        <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Medicine Name (Required)</label>
                <input value="" placeholder="Product name" id="name" name="name" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Company</label>
                <input value="" placeholder="Company Name" id="company" name="company" type="text" class="form-control validate" required>
			 </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Generic Name</label>
                <input value="" placeholder="Generic Name" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Pack Size</label>
                <input value="" placeholder="Pack Size" id="pack_size" name="pack_size" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">HSN</label>
                <input value="" placeholder="HSN" id="hsn" name="hsn" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST Rate</label>
                <input value="" placeholder="GST Rate" id="gstrate" name="gstrate" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST Division</label>
                <input value="" placeholder="GST Division" id="gstdivision" name="gstdivision" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Vendor Price</label>
                <input value="" placeholder="Vendor Price" id="vendor_price" name="vendor_price" type="text" class="form-control validate" required>
			</div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Pack MRP</label>
                <input value="" placeholder="Pack MRP" id="mrp" name="mrp" type="text" class="form-control validate" required>
				<input value="0" id="status" name="status" type="hidden" class="form-control validate">
				<input value="<?php echo date('Y-m-d') ?>" id="add_date" name="add_date" type="hidden" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Vendors (Required)</label>
                <select class="select2 form-control" name="vendor_number" id="vendor_number" required>
                    <option value="">-- Select --</option>
                    <?php if(!empty($vendors)){
                      foreach($vendors as $key => $val){  
                    ?>
                        <option value="<?php echo $val['vendor_number']?>"><?php echo $val['name']?></option>
                      <?php } }?>
                </select>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
			 <label for="item_name">Brands (Required)</label>
					<select class="form-control select2" name="brand_number" id="brand_number" required>
					 <option value="">-- Select --</option>
                      <?php 
                      if(!empty($brands)){
                        foreach($brands as $key => $val){  
                      ?>
                          <option value="<?php echo $val['brand_number']?>"><?php echo $val['name']?></option>
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

  $( "#type" ).change(function() {

    $("span#type-msg").hide();

    $("span#type-msg").empty();

    var type_mode = $( "#type :selected" ).attr("mode");

    if(type_mode == "solid"){

        $("span#type-msg").empty().append("(1 Unit)");

        $("span#type-msg").show();

    }else if(type_mode == "liquid"){

      $("span#type-msg").empty().append("(1 Unit/ml)");

      $("span#type-msg").show();

    }

});

</script>