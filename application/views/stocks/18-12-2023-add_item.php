
  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="add_item" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Add Item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
		  <div class="form-group col-sm-4 col-xs-12">
              <label for="quantity">Company</label>
              <div class="clearfix"></div>
              <input value="" placeholder="Company" id="company" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Product name (Required)</label>
			   <select id="product_id" name="product_id" class="select2 form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($products as $key => $value){ ?>
                	<option value="<?php echo $value['ID']; ?>"><?php echo $value['name']; ?> - <?php echo $value['batch_number']; ?></option>
                <?php } ?>
                </select>
             
              <p id="product_info"></p>
            </div>

            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Batch number (Required)</label>
			   <select id="batch_number" name="batch_number" class="select2 form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($products as $key => $value){ ?>
                	<option value="<?php echo $value['batch_number']; ?>"><?php echo $value['batch_number']; ?></option>
                <?php } ?>
                </select>
             <p id="product_info"></p>
            </div>
            
           
          </div>

          <div class="row"> 
		   <div class="form-group col-sm-6 col-xs-12">
                  <label for="quantity">Brands (Required)</label>
                    <select class="form-control" name="brand_name" id="brand_number" required>
                        <option value="">-- Select --</option>
                    </select>
            </div>
          		
             <div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Vendors (Required)</label>
              <select name="vendor_number" id="vendor_number" class="form-control" required>
              		<option value="">-- Select --</option>
              </select>
              <p id="vendor_info"></p>
              <input value="" id="product_vendor_price" type="hidden" class="form-control validate" required>
              <input value="" id="product_vendor_unit" type="hidden" class="form-control validate" required>
            </div>
          	           
          </div>
          
          <div class="row">
		   <div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Generic Name </label>
              <div class="clearfix"></div>
              <input value="" placeholder="Generic Name" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Quantity <span class="error">(Enter units only)</span> (Required)</label>
              <div class="clearfix"></div>
              <input value="" placeholder="Units" id="quantity" name="quantity" type="Number" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Safety stock (units) (Required)</label>
                  <input value="10" placeholder="Safety stock" id="safety_stock" name="safety_stock" type="text" class="form-control validate">
            </div>

            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Total Unit MRP (Required)</label>
              <input value="" placeholder="MRP" readonly id="price" name="price" type="text" class="form-control validate" required>
            </div>
          </div>
          
          <div class="row">
           

            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Expiry Date (Required)</label>
              <input value=""  autocomplete="off" placeholder="Expiry date" id="expiry" name="expiry" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Notify expiry on (Required)</label>
                <input value=""  autocomplete="off" placeholder="Notify expiry on" id="expiry_day" name="expiry_day" type="text" class="form-control validate" required>
              </div>
          </div>

          <div class="row">             
          		
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Pack Size</label>
              <input value="" placeholder="Pack Size" id="pack_size" name="pack_size" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">HSN (Required)</label>
                <input value=""  autocomplete="off" placeholder="HSN" id="hsn" name="hsn" type="text" class="form-control validate" required>
            </div> 
          </div>
		  <div class="row">             
          	<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Vendor Price (Unit)</label>
                <input value=""  autocomplete="off" placeholder="Vendor Price" id="vendor_price" name="vendor_price" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST RATE</label>
                <input value=""  autocomplete="off" placeholder="GST" id="gstrate" name="gstrate" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST Division</label>
                <input value=""  autocomplete="off" placeholder="GST Division" id="gstdivision" name="gstdivision" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">MRP</label>
                <input value=""  autocomplete="off" placeholder="MRP" id="product_info" name="mrp" type="text" class="form-control validate" required>
            </div>
			  <div class="form-group col-sm-6 col-xs-12" style="display:none">
                <label for="expiry">Order Qutatity (units) (Required)</label>
                <input value="0" placeholder="Order Qutatity" id="order_qty" name="order_qty" type="hidden" class="form-control validate" required>
              </div>  
          </div>

          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Category (Required)</label>
              <select name="category" class="form-control" required>
              		<option value="">Select Categories</option>
              	<?php foreach($categories as $key => $value){ ?>
                	<option value="<?php echo $value['category_id']; ?>"><?php echo $value['name']; ?></option>
                <?php } ?>
              </select>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="statuss">Status(Required)</label><br/>
               <input type="radio" name="status" value="1" class="statuss" checked> Active 
               <input type="radio" name="status" value="0" class="statuss"> Inactive
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

$('#product_id').on("change", function() {
  $('#vendor_info').empty();
  $('#product_vendor_price').val("");
  $('#product_vendor_unit').val("");
  $('#vendor_number').prop('selectedIndex',0);
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

$('#brand_number').on("change", function() {
  $('#vendor_info').empty();
  $('#product_vendor_price').val("");
  $('#product_vendor_unit').val("");
  $('#loader_div').show();
  
	var brand_number = $(this).val();
	if(brand_number != ''){
      var product_id = $("#product_id").val();
      
      $.ajax({
        url: '<?php echo base_url('stocks/ajax_product_brand_vendor')?>',
        data: {brand_number:brand_number, product_id:product_id},
        dataType: 'json',
        method:'post',
        success: function(data)
        {
          $('#vendor_number').empty().append(data.vendors);
          $('#loader_div').hide();
        } 
    });
  }
	$('#loader_div').hide();
});

$('#vendor_number').on("change", function() {
  $('#vendor_info').empty();
  $('#product_vendor_price').val("");
  $('#product_vendor_unit').val("");
  $('#loader_div').show();
  
	var vendor_number = $(this).val();
	if(vendor_number != ''){
      var product_id = $("#product_id").val();
      var brand_number = $("#brand_number").val();
      
      $.ajax({
        url: '<?php echo base_url('stocks/ajax_product_vendor_data'); ?>',
        data: {vendor_number:vendor_number, brand_number:brand_number, product_id:product_id},
        dataType: 'json',
        method:'post',
        success: function(data)
        {
          if(data.status == 1){
            $('#product_vendor_price').val(data.product_vendor_data.price);
            $('#product_vendor_unit').val(data.product_vendor_data.units);
            $("#vendor_info").empty().append("Price: "+data.product_vendor_data.price+", Units: "+data.product_vendor_data.units);
          }else{
            $("#vendor_info").empty().append("Data not found!");
          }
          $('#loader_div').hide();

        } 
    });
  }
	$('#loader_div').hide();
});

$('#quantity').on("keyup", function() {
  $('#loader_div').show();
  $('#price').val("");

  var quantity = $(this).val();

  var product_vendor_price = $('#product_vendor_price').val();
  var product_vendor_unit = $('#product_vendor_unit').val();

  var percent = parseFloat(product_vendor_price) / parseFloat(product_vendor_unit);
  var unit_price = (percent * parseFloat(quantity));
  
  $('#price').val(unit_price);
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
</script>