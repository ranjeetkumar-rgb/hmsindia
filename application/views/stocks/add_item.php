
  <form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
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
              <label for="company">Product name (Required)</label>
		      	  <select id="consumables_product_id" class="select2 consumables_select cons-cls-1 form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($medicines as $key => $value){ ?>
                	<option value="<?php echo $value['ID']; ?>" company="<?php echo $value['company']; ?>" generic_name="<?php echo $value['generic_name']; ?>" pack_size="<?php echo $value['pack_size']; ?>" hsn="<?php echo $value['hsn']; ?>" vendor_price="<?php echo $value['vendor_price']; ?>" gstrate="<?php echo $value['gstrate']; ?>" mrp="<?php echo $value['mrp']; ?>" gstdivision="<?php echo $value['gstdivision']; ?>"><?php echo $value['name']; ?> - <?php echo $value['mrp']; ?></option>
					
                <?php } ?>
              </select>
            </div>

            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Product name (Required)</label>
              <select id="product_id" name="product_id" class="select2 form-control" required>
                  <option value="">-- Select --</option>
                  <?php foreach($products as $key => $value){ ?>
                      <option value="<?php echo $value['ID']; ?>">
                          <?php echo $value['name']; ?> - <?php echo isset($value['price']) ? $value['price'] : 'N/A'; ?>
                      </option>
                  <?php } ?>
              </select>
              <p id="product_info"></p>
          </div>


            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Invoice Number (Required)</label>
			          <input value="" placeholder="Invoice Number" id="invoice_no" name="invoice_no" type="text" class="form-control validate" required>
            </div>

            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Batch number (Required)</label>
			          <input value="" placeholder="Batch Number" id="batch_number" name="batch_number" type="text" class="form-control validate" required>
            </div>
			
			 <div class="form-group col-sm-4 col-xs-12">
              <label for="quantity">Company</label>
              <div class="clearfix"></div>
              <input value="" placeholder="Company" id="company" readonly="" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="quantity">Date Of Purchase</label>
              <div class="clearfix"></div>
              <input value="" placeholder="Date Of Purchase" id="date_of_purchase" name="date_of_purchase" type="date" class="form-control validate" required>
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
          </div>
          
          <div class="row">
		   <div class="form-group col-sm-4 col-xs-12">
              <label for="quantity">Generic Name </label>
              <div class="clearfix"></div>
              <input value="" placeholder="Generic Name" readonly="" id="generic_name" name="generic_name" type="text" class="cons-cls-1 form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="quantity">Quantity <span class="error">(Enter units only)</span> (Required)</label>
              <div class="clearfix"></div>
              <input value="" placeholder="Units" id="quantity" readonly="" name="quantity" type="Number" class="form-control validate" required>
            </div>
             <div class="form-group col-sm-4 col-xs-12">
              <label for="expiry">Order quantity (Pack)</label>
            <input value=""  id="pack" name="pack"  type="number" class="form-control validate" required oninput="calculateValues()">
			</div>
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Safety stock (units) (Required)</label>
                  <input value="10" placeholder="Safety stock" readonly="" id="safety_stock" name="safety_stock" type="text" class="form-control validate">
            </div>
          <div class="form-group col-sm-6 col-xs-12">
              <label for="price">Total Vendor Price (excl GST)</label>
              <input 
                  type="text" 
                  id="price" 
                  name="price" 
                  value="<?php echo isset($data['price']) ? htmlspecialchars($data['price']) : ''; ?>" 
                  class="form-control validate" 
                  readonly 
                  required
              >
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
              <input value="" placeholder="Pack Size" readonly="" id="pack_size" name="pack_size" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">HSN (Required)</label>
                <input value=""  autocomplete="off" readonly="" placeholder="HSN" id="hsn" name="hsn" type="text" class="form-control validate" required>
            </div> 
          </div>
		  <div class="row">             
          	<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Vendor Price (Unit)</label>
                <input value=""  autocomplete="off" readonly="" placeholder="Vendor Price" id="vendor_price" name="vendor_price" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST RATE</label>
                <input value=""  autocomplete="off" readonly="" placeholder="GST" id="gstrate" name="gstrate" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">GST Division</label>
                <input value=""  autocomplete="off" readonly="" placeholder="GST Division" id="gstdivision" name="gstdivision" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Pack MRP</label>
                <input value=""  autocomplete="off" readonly="" placeholder="MRP" id="mrp" name="mrp" type="text" class="form-control validate" required>
            </div>
			  <div class="form-group col-sm-6 col-xs-12" style="display:none">
                <label for="expiry">Order Qutatity (units) (Required)</label>
                <input value="0" placeholder="Order Qutatity" id="order_qty" readonly="" name="order_qty" type="hidden" class="form-control validate" required>
                <input value="0" id="no_of_item" readonly="" name="no_of_item" type="hidden" required>
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
              <label for="medicine_type">Select Medicine Type</label>
              <select name="medicine_type" class="form-control" required>
              		<option value="">Select Medicine Type</option>
              		<option value="ipd">IPD</option>
              		<option value="opd">OPD </option>
              </select>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Vendor billing receipt</label>
              <input value="" placeholder="Vendor billing receipt" id="vendor_billing" name="vendor_billing" type="file" class="form-control">
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="status">Status(Required)</label><br/>
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


 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		
		$('#product_id').val('');
		$('#generic_name').val('');
		$('#company').val('');
		$('#pack_size').val('');
		$('#hsn').val('');
		$('#vendor_price').val('');
		$('#gstrate').val('');
		$('#mrp').attr("item_number", "");
		$('#gstdivision').val('');
		
		if(product_id != ''){
			//var product_id = $(this).val();
			var generic_name = $(this).find(':selected').attr('generic_name');
			var product_id = $(this).find(':selected').attr('product_id');
			var company = $(this).find(':selected').attr('company');
			var pack_size = $(this).find(':selected').attr('pack_size');
			var gstrate = $(this).find(':selected').attr('gstrate');
			var hsn = $(this).find(':selected').attr('hsn');
			var vendor_price = $(this).find(':selected').attr('vendor_price');
			var mrp = $(this).find(':selected').attr('mrp');
			var gstdivision = $(this).find(':selected').attr('gstdivision');
			
			$('#product_id').val(product_id);
			$('#generic_name').val(generic_name);
			$('#company').val(company);
			$('#pack_size').val(pack_size);
			$('#gstrate').val(gstrate);
			$('#hsn').val(hsn);
			$('#vendor_price').val(vendor_price);
			$('#mrp').val(mrp);
			$('#gstdivision').val(gstdivision);
		}			
    });
</script>

  <script>
function calculateValues() {
    let orderQtyPack = document.getElementById('pack').value;
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
    if (document.getElementById('price')) {
        document.getElementById('price').value = totalVendorPrice.toFixed(2);
    }
}
</script>