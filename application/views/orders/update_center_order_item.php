 <?php $all_method =&get_instance();?>
<form class="col-sm-12 col-xs-12" method="post" id="center_order_form" action="" >
    <input type="hidden" name="action" value="update_order_item" required />
	<input type="hidden" name="item_number" value="<?php echo $data['item_number']; ?>" required />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Update order item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Item name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" readonly="readonly" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Item number</label>
	              <p><?php echo $data['item_number']; ?></p>
           </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Company (Required)</label>
              <input value="<?php echo $data['company']; ?>" readonly="readonly" id="company" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Vendor (Required)</label>
              <input value="<?php echo $data['vendor_number']; ?>" readonly="readonly" id="vendor_number" name="vendor_number" type="hidden" class="form-control validate" required>
              <p><?php echo $all_method->get_vendor_name($data['vendor_number']); ?></p>
            </div>
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
             <label for="expiry">Brand (Required)</label>
              <input value="<?php echo $data['brand_name']; ?>" readonly="readonly" id="brand_name" name="brand_name" type="hidden" class="form-control validate" required>
              <p><?php echo $all_method->get_brand_name($data['brand_name']); ?></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Order quantity (Required)</label>
              <input value="<?php echo $data['order_qty'];?>" readonly="readonly" id="quantity" name="quantity" type="text" class="form-control validate" required>
            </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Expiry Date (Required)</label>
              <input value="<?php echo $data['expiry']; ?>" placeholder="Expiry date" id="expiry" name="expiry" type="text" class="form-control validate" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Notify expiry on (Required)</label>
                  <input value="<?php echo $data['expiry_day']; ?>" readonly="readonly" placeholder="Notify expiry on" id="expiry_day" name="expiry_day" type="text" class="form-control validate" required>
           </div>
                
          </div>
          
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Price (Required)</label>
              <input value="<?php echo $data['price']?>" placeholder="Price" readonly="readonly" id="price" name="price" type="text" class="form-control validate" required>
            </div>
          </div>
           
        </div>        
        <div class="clearfix"></div>
        <div class="form-group col-sm-12 col-xs-12">
          <input type="button" onclick="ConfirmDelete()" id="submitbutton" class="btn btn-large" value="Submit" />
          <a class="btn btn-large" href="<?php echo base_url()."orders/center_order";?>">Cancel</a>
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
  
  $( function() {
    $( "#expiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    }).on('change', function(ev){
		var lastmonth = gimmeYesterday($(this).val())
		$( "#expiry_day" ).val(lastmonth);
    });
  });
	function ConfirmDelete()
	{
		var isValid= true;
		$("input").each(function() {
		   var element = $(this);
		   if (element.val() == "") {
			   isValid = false;
		   }
		});
		
		if(isValid == true){
			var x = confirm("Are you sure you want to update the stock?");
			if (x){
				  $('form#center_order_form').submit();
				  //return true;
			}else{
				return false;
			}
		}else{
			   alert("Fill all mandatory fields!");
		}
	}
</script>