<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_center_item" />
    <input type="hidden" name="item_number" value="<?php echo $item_number; ?>" />
	<input type="hidden" value="<?php echo $ID; ?>" />
	
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Return Item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="company">Item Company (Required)</label>
              <input value="<?php echo $data['company']; ?>" readonly="readonly" placeholder="Company" id="company" name="company" type="text" class="form-control validate">
              
			</div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Item Name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" readonly="readonly" placeholder="Item name" id="item_name" name="item_name" type="text" class="form-control validate" required>
              <input type="text" name="employee_number" id="employee_number" value="<?php echo $data['employee_number']?>" />
			</div>
          </div>
		  <div class="row">
            <div class="form-group col-sm-6 col-xs-6">
              <label for="company">Generic Name</label>
              <input value="<?php echo $data['generic_name']; ?>" placeholder="Company" readonly="readonly" id="generic_name" name="generic_name" type="text" class="form-control validate">
            </div>
            <div class="form-group col-sm-6 col-xs-6">
              <label for="company">Batch Number</label>
              <input value="<?php echo $data['batch_number']; ?>" placeholder="Batch Number" readonly="readonly" id="batch_number" name="batch_number" type="text" class="form-control validate">
            </div>
          </div>
          
          <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                  <label for="quantity">Quantity (Required)</label>
                  <input value="<?php echo $data['quantity']; ?>" placeholder="Quantity" id="quantity" name="quantity" type="Number" class="form-control validate" required>
                </div>
                
                <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Expiry Date (Required)</label>
              <input value="<?php echo $data['expiry']; ?>" placeholder="Expiry date" id="expiry" name="expiry" type="text" class="form-control validate" required>
            </div>
                </div>
          
          <div class="row">            
           
            
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="Return">Return Date</label>
                  <input value="" placeholder="Return Date" id="return_date" name="return_date" type="date" class="form-control validate" required>
           </div>
		    <div class="form-group col-sm-6 col-xs-12">
              <label for="Landline">Reason</label><br/>
               <input type="text" name="reason" id="reason" class="statuss">
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
  $( function() {
    $( "#expiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
	 $( "#expiry_day" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat: 'yy-mm-dd',
		  maxDate: '0'
     });
  } );
</script>