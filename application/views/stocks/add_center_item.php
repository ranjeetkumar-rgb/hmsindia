 <?php $all_method =&get_instance(); ?>
  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="add_center_item" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Add stock item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Stock Item (Required)</label>
             <!-- <select id="items" name="item_number" class="form-control" placeholder="Select stock item" required data-search="true">
              		   <?php echo $item_lists;?>
              </select> -->
                  <select id="items" name="item_number" class="select2 form-control" style="width:300px" required>
                    <option value=""></option>
                    <?php echo $item_lists;?>
                </select>
                </div>
          </div>
          
          <div class="row">
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Item Name (Required)</label>
              <input value="" placeholder="Item name" readonly="readonly" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>

            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Brand name (Required)</label>
              <p id="brand_name_text"></p>
              <input value="" readonly="readonly" id="brand_name" name="brand_name" type="text" class="form-control validate" required>
			</div>
          </div>
		  
		  <div class="row">
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="generic_name">Generic Name</label>
              <input value="" placeholder="Generic Name" readonly="readonly" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
            </div>

            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Company</label>
              <input value="" placeholder="Company" readonly="readonly" id="company" name="company" type="text" class="form-control validate" required>
            </div>
          </div>
                    
           <div class="row">
                <div class="form-group col-sm-2 col-xs-12">
                  <label for="quantity">Currunt Quantity</label>
                  <div class="clearfix"></div>
                   <input value="" placeholder="units" id="curruntyquantity" min="0" name="curruntyquantity" type="Number" readonly="" class="form-control validate">
                
				</div>
				
				<div class="form-group col-sm-4 col-xs-12">
                  <label for="quantity">Quantity <span class="error">(Enter units only)</span> (Required)</label>
                  <div class="clearfix"></div>
                  <input value="" placeholder="units" id="quantity" min="0" name="quantity" type="Number" class="form-control validate" required>
                </div>
                
                <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Safety stock (Required)</label>
                      <input value="" placeholder="Safety stock" id="safety_stock" readonly="readonly" name="safety_stock" type="number" class="form-control validate" required>
                </div>
            </div>
                
          <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Expiry Date (Required)</label>
                      <input value="" autocomplete="off" placeholder="Expiry date" id="expiry" name="expiry" type="text" class="form-control validate" required>
	            </div>
          		<div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Notify expiry on (Required)</label>
                  <input value="" autocomplete="off" placeholder="Notify expiry on" id="expiry_day" name="expiry_day" type="text" class="form-control validate" required>
                </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Category (Required)</label>
              <p id="category_text"></p>
              <input value="" readonly="readonly" id="category" name="category" type="hidden" class="form-control validate" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
              <!--<label for="expiry">MRP (Required)</label>-->
			  <label for="expiry">MRP</label>
              <input value="" placeholder="MRP" readonly="readonly" id="mrp" name="mrp" type="text" class="form-control validate" required>
              <input value="" placeholder="Product Id" id="product_id" readonly="readonly" name="product_id" type="hidden" class="form-control validate">
            
			</div>
          </div>
          
          <div class="row">    
          	 <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Order Quantity (Required)</label>
              <input value="" placeholder="Order Quantity" id="order_qty" readonly="readonly" name="order_qty" type="number" class="form-control validate" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Batch number (Required)</label>
              <input value="" placeholder="Batch number" id="batch_number" readonly="readonly" name="batch_number" type="text" class="form-control validate" required>
            </div>
          </div>
          
		   <div class="row">    
          	 <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">GST</label>
              <input value="" placeholder="Order Quantity" id="gstrate" readonly="readonly" name="gstrate" type="text" class="form-control validate">
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Pack Size</label>
              <input value="" placeholder="Pack Size" id="pack_size" readonly="readonly" name="pack_size" type="text" class="form-control validate">
            </div>
          </div>
		  
		  <div class="row">    
          	 <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">HSN</label>
              <input value="" placeholder="HSN" id="hsn" readonly="readonly" name="hsn" type="text" class="form-control validate">
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Vendor Price</label>
              <input value="" placeholder="Batch number" id="vendor_price" readonly="readonly" name="vendor_price" type="text" class="form-control validate">
            </div>
			
			<div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">GST Division</label>
              <input value="" placeholder="GST Division" id="gstdivision" readonly="readonly" name="gstdivision" type="text" class="form-control validate">
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
					// Check if the current center matches the selected one
					$selected = ($center == $val['center_number']) ? '' : '';
					// Use `center_number` as the value (if needed) or `ship_to`
					echo '<option value="' . $val['center_number'] . '" ' . $selected . '>' . $val['center_name'] . '</option>';
					} 
					?>
				</select>
            </div>	
            <div class="col-sm-6 col-xs-12">
            	<label>Department</label>
                <select class="form-control" id="department" name="department">
                	<option value="">--Select From--</option>
					<option value="Embryologist Noida">Embryologist</option>
					<option value="billing">Cash Billing</option>
					<option value="Hormonal">Hormonal</option>
					<option value="OT Noida">OT Noida</option>
					<option value="Embryologist Basant Lok">Embryologist Basant Lok</option>
					<option value="OT Basant Lok">OT Basant Lok</option>
					<option value="OT Srinagar">OT Srinagar </option>
					<option value="Embryology Srinagar">Embryology Srinagar </option>
				</select>
            </div>				
            <div class="col-sm-6 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                <select class="form-control" id="employee_number" name="employee_number">
                	<option value=''>--Select From--</option>
                    <?php $all_emplyee = $all_method->get_employee_list();
						            foreach($all_emplyee as $key => $val){ //var_dump($val);die;
                          if($employee_number == $val['name']){
                            echo '<option value="'.$val['employee_number'].'" selected>'.$val['name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['employee_number'].'">'.$val['name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
				<input value="" readonly="readonly" type="hidden" id="product_vendor_price" class="form-control validate" required>
                <input value="" readonly="readonly" type="hidden" id="product_vendor_unit" class="form-control validate" required>
            </div>
			
          </div>
		  
          
        <div class="clearfix"></div>
        <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" style="display:none;" id="submitbutton" class="btn btn-large" value="Submit" />
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
			$.ajax({
				url: '<?php echo base_url('stocks/get_item_details')?>',
				data: {item_number : data},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					if(data.stock_data.item_name != ''){
            
            $('#product_vendor_price').val(data.product_vendor_info.price);
            $('#product_vendor_unit').val(data.product_vendor_info.units);

						$('#item_name').val(data.stock_data.item_name);
						$('#brand_name').val(data.stock_data.brand_name);
						$('#generic_name').val(data.stock_data.generic_name);
						$('#company').val(data.stock_data.company);
						$('#category').val(data.stock_data.category);
						$('#category_text').empty().append(data.cat_name);
						$('#brand_name_text').empty().append(data.brand_name);
						$('#product_id').val(data.stock_data.product_id);
						$('#expiry').val(data.stock_data.expiry);
						$('#expiry_day').val(data.stock_data.expiry_day);
						//$('#quantity').val(data.stock_data.quantity);
						$('#curruntyquantity').val(data.stock_data.quantity);
						$('#safety_stock').val(data.stock_data.safety_stock);
						$('#order_qty').val(data.stock_data.order_qty);
						$('#batch_number').val(data.stock_data.batch_number);
						$('#pack_size').val(data.stock_data.pack_size);
						$('#hsn').val(data.stock_data.hsn);
						$('#vendor_price').val(data.stock_data.vendor_price);
						$('#gstrate').val(data.stock_data.gstrate);
						$('#gstdivision').val(data.stock_data.gstdivision);
						$('#mrp').val(data.stock_data.mrp);
						$('#status').val(data.stock_data.status);
						$('#submitbutton').show();
					}
				}
		   });
			
	  });
	
  });
  
  $('#quantity').on("keyup", function() {
    $('#loader_div').show();
    $('#price').val("");

    var quantity = $(this).val();

    var product_vendor_price = $('#product_vendor_price').val();
    var product_vendor_unit = $('#product_vendor_unit').val();

    var percent = parseFloat(product_vendor_price) / parseFloat(product_vendor_unit);
    var unit_price = (percent * parseFloat(quantity));
    if(parseFloat(unit_price) > 0){
      $('#price').val(unit_price);
    }else{
      $('#price').val("");
    }
    $('#loader_div').hide();
  });
</script>
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