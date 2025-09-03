
  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="product_vendor_update" />
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
                <select class="form-control" name="product_id" id="product_id" required>
                    <option value="">-- Select --</option>
                    <?php if(!empty($products)){
                      foreach($products as $key => $val){  
                    ?>
                        <option value="<?php echo $val['ID']?>" <?php if($val['ID'] == $data['product_id']){echo 'selected="selected"'; }?>><?php echo $val['name']?> - (<?php echo $val['batch_number']?>)</option>
                      <?php } }?>
                </select>
                <p id="product_info"></p>
            </div>

            <div class="form-group col-sm-6 col-xs-12">
                  <label for="quantity">Brands (Required)</label>
                    <select class="form-control" name="brand_number" id="brand_number" required>
                        <option value="">-- Select --</option>
                    </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Vendors (Required)</label>
                <select class="form-control" name="vendor_number" id="vendor_number" required>
                    <option value="">-- Select --</option>
                    <?php if(!empty($vendors)){
                      foreach($vendors as $key => $val){  
                    ?>
                        <option value="<?php echo $val['vendor_number']?>" <?php if($val['vendor_number'] == $data['vendor_number']){echo 'selected="selected"'; }?>><?php echo $val['name']?></option>
                      <?php } }?>
                </select>
            </div>
            
            
                <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Price (Required)</label>
                      <input value="<?php echo $data['price']; ?>" placeholder="Price" id="price" name="price" type="text" class="form-control validate" required>
                    </div>
                </div>
				<div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Units (Required)</label>
                      <input value="<?php echo $data['units']; ?>" placeholder="Units" id="units" name="units" type="number" class="form-control validate" required>
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

product_brand($('#product_id').val(), <?php echo $data['brand_number']; ?>,"edit");

$('#product_id').on("change", function() {
  $('#product_info').hide();
  $('#product_info').empty();	
  $('#loader_div').show();
  
  var product_id = $(this).val();
  product_brand(product_id);
});

function product_brand(product_id, brand_number, mode){  
  if(product_id != ''){
      $.ajax({
        url: '<?php echo base_url('stocks/ajax_product_brands')?>',
        data: {product_id:product_id, brand_number:brand_number, mode:mode},
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
}
</script>