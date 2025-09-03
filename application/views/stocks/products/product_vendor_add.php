
  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="product_vendor_add" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Product Vendor</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Product (Required)</label>
			   <select id="product_id" name="product_id" class="select2 consumables_select cons-cls-1 form-control" required>
                    <option value="">-- Select --</option>
                    <?php if(!empty($products)){
                      foreach($products as $key => $val){  
                    ?>
                        <option value="<?php echo $val['ID']?>" vendor_number="<?php echo $val['vendor_number']; ?>"><?php echo $val['name']?> - <?php echo $val['ID']?></option>
                      <?php } }?>
                </select>
                <p id="product_info"></p>
            </div>

            <div class="form-group col-sm-6 col-xs-12">
                  <label for="quantity">Brands (Required)</label>
				  <!--<input autocomplete="off" value="" readonly="" placeholder="Brand Name" id="brand_number" name="brand_number" type="text" class="form-control">-->
               
                    <select class="form-control" name="brand_number" id="brand_number" required>
                        <option value="">-- Select --</option>
                    </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Vendors (Required)</label>
			  <!--<input autocomplete="off" value="" readonly="" placeholder="Vendors Name" id="vendor_number" name="vendor_number" type="text" class="form-control">-->
                <select class="select2 form-control" name="vendor_number" id="vendor_number" required>
                    <option value="">-- Select --</option>
                    <?php if(!empty($vendors)){ foreach($vendors as $key => $val){ ?>
                        <option value="<?php echo $val['vendor_number']?>"><?php echo $val['name']?></option>
                    <?php } } ?>
                </select>
            </div>
            
            
          
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Unit mrp Price (Required)</label>
                      <input value="" placeholder="Price" id="price" name="price" type="text" class="form-control validate" required>
                    </div>
            </div>
                <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Units (Required)</label>
                      <input value="" placeholder="Units" id="units" name="units" type="number" class="form-control validate" required>
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

$('#product_id').on("change", function() {
  $('#product_info').hide();
  $('#product_info').empty();	
  $('#loader_div').show();
  
	var product_id = $(this).val();
	if(product_id != ''){
      $.ajax({
        url: '<?php echo base_url('stocks/ajax_product_brands')?>',
        data: {product_id:product_id},
        dataType: 'json',
        method:'post',
        success: function(data)
        {
          $('#brand_number').empty().append(data.brands);
          $('#product_info').empty().append(data.product_info);
          $('#product_info').show();
          $('#loader_div').hide();
        } 
    });
  }
	$('#loader_div').hide();
});

$(function(){
	  // turn the element to select2 select style
	  $('.select2').select2({
		placeholder: "Select stock item."
	  }).on('change', function(e) {
		var data = $(".select2 option:selected").val();
			
	  });
	
});

 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		
		$('#vendor_number').val('');
		$('#brand_number').val('');
		
		if(vendor_number != ''){
			var vendor_number = $(this).find(':selected').attr('vendor_number');
			var brand_number = $(this).find(':selected').attr('brand_number');
			
			$('#vendor_number').val(vendor_number);
			$('#brand_number').val(brand_number);
		}			
    });
</script>