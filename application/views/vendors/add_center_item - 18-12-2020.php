
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
              <label for="company">Item Company (Required)</label>
              <input value="" placeholder="Company" readonly="readonly" id="company" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Item Name (Required)</label>
              <input value="" placeholder="Item name" readonly="readonly" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
          </div>
          
           <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Brand name (Required)</label>
              <p id="brand_name_text"></p>
              <input value="" readonly="readonly" id="brand_name" name="brand_name" type="hidden" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Generic name (Required)</label>
              <input value="" readonly="readonly" id="generic_name" name="generic_name" type="text" class="form-control validate" required>
            </div>
          </div>
          
           <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
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
              <label for="expiry">MRP (Required)</label>
              <input value="" placeholder="MRP" readonly="readonly" id="price" name="price" type="text" class="form-control validate" required>
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
            <div class="form-group col-sm-6 col-xs-12" style="display:none;">
              <label for="statuss">Status(Required)</label><br/>
			  <input value="" placeholder="status" readonly="readonly" id="status" name="status" type="hidden" class="form-control validate" required>
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
						$('#item_name').val(data.stock_data.item_name);					
						$('#company').val(data.stock_data.company);
						$('#price').val(data.stock_data.price);
						$('#brand_name').val(data.stock_data.brand_name);
						$('#category').val(data.stock_data.category);
						$('#category_text').empty().append(data.cat_name);
						$('#brand_name_text').empty().append(data.brand_name);
						$('#generic_name').val(data.stock_data.generic_name);
						$('#expiry').val(data.stock_data.expiry);
						$('#expiry_day').val(data.stock_data.expiry_day);
						$('#safety_stock').val(data.stock_data.safety_stock);
						$('#order_qty').val(data.stock_data.order_qty);
						$('#batch_number').val(data.stock_data.batch_number);
						$('#status').val(data.stock_data.status);
						$('#submitbutton').show();
					}
				}
		   });
			
	  });
	
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