<?php //var_dump($data);die;?>
  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_audit_item" />
    <input type="hidden" value="<?php echo $data['ID']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Edit Item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
		    <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Item Name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" placeholder="Item name" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
			  <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Batch number (Required)</label>
              <input value="<?php echo $data['batch_number']; ?>" placeholder="Batch number" id="batch_number" name="batch_number" type="text" class="form-control validate" required>
            </div>
            <?php if($_SESSION['logged_central_stock_manager']['username'] == "amit.kumar@indiaivf.in"){?>
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="quantity">Quantity</label>
                  <input value="<?php echo $data['quantity']; ?>" placeholder="Units" id="quantity" name="quantity" type="Number" class="form-control validate" required>
            </div>
            <?php }else{ ?>
              <div class="form-group col-sm-6 col-xs-12">
                  <label for="quantity">Quantity</label>
                  <input value="<?php echo $data['quantity']; ?>" placeholder="Units" id="quantity" name="quantity" type="Number" readonly="" class="form-control validate" required>
            </div>
              <?php } ?>  
			<div class="form-group col-sm-6 col-xs-12">
                  <label for="quantity">Physical Quantity</label>
                  <input value="<?php echo $data['physical_quantity']; ?>" placeholder="Physical Quantity" id="physical_quantity" name="physical_quantity"  required type="number" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Register Quantity</label>
                 <input value="<?php echo $data['register_quantity']; ?>" placeholder="Register Quantity" id="register_quantity" name="register_quantity" required type="number" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Short Quantity</label>
                 <input value="<?php echo $data['short']; ?>" placeholder="Short Quantity" id="short" name="short" type="number" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Excess Quantity</label>
                 <input value="<?php echo $data['excess']; ?>" placeholder="Excess Quantity" id="excess" name="excess" type="number" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Damage Quantity</label>
                 <input value="<?php echo $data['damage']; ?>" placeholder="Damage Quantity" id="damage" name="damage" type="number" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Expiry Date (Required)</label>
                <input value="<?php echo $data['expiry']; ?>" placeholder="Expiry date" id="expiry" name="expiry" type="text" class="form-control validate" required>
	        </div>
			<div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Notify expiry on (Required)</label>
                <input value="<?php echo $data['expiry_day']; ?>" placeholder="Notify expiry on" id="expiry_day" name="expiry_day" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Discard Quantity</label>
                 <input value="<?php echo $data['discard']; ?>" placeholder="Discard Quantity" id="discard" name="discard" type="Number" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Reson</label>
                 <input value="<?php echo $data['reason']; ?>" placeholder="Reson" id="reason" name="reason" type="text" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Date</label>
                 <input value="<?php echo $data['add_date']; ?>" placeholder="Reson" id="add_date" name="add_date" type="date" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Item Below Min</label>
                 <input value="<?php echo $data['item_below_min']; ?>" placeholder="Item Below Min" id="item_below_min" name="item_below_min" type="text" class="form-control validate">
            </div>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Near Expiry</label>
                 <input value="<?php echo $data['near_expiry']; ?>" placeholder="Near Expiry" id="near_expiry" name="near_expiry" type="text" class="form-control validate">
            </div>
            <?php if($_SESSION['logged_central_stock_manager']['username'] == "amit.kumar@indiaivf.in"){?>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Audit Name</label>
                 <input value="<?php echo $_SESSION['logged_central_stock_manager']['name']?>" placeholder="Audit Name" id="requisition" name="requisition" type="text" class="form-control validate" required>
            </div>
            <?php }else{ ?>
              <div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Audit Name</label>
                 <input value="<?php echo $_SESSION['logged_billing_manager']['name']?>" placeholder="Audit Name" id="requisition" name="requisition" type="text" class="form-control validate" required>
            </div>
              <?php } ?>
			<div class="form-group col-sm-6 col-xs-12">
                 <label for="quantity">Employee Number</label>
                 <input value="<?php echo $data['employee_number']; ?>" placeholder="Employee Number" id="employee_number" name="employee_number" type="Number" readonly class="form-control validate">
            </div>
          </div>
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
	
  $( function() {
    $( "#expiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    }).on('change', function(ev){
		var lastmonth = gimmeYesterday($(this).val())
		$( "#expiry_day" ).val(lastmonth);
    });
	
	 $( "#expiry_day" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat: 'yy-mm-dd',
     });
  } );
</script>