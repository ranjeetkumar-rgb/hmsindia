 <?php $all_method =&get_instance();?>
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_discard_item" />
	<input type="hidden" name="item_number" value="<?php echo $data['item_number']; ?>" />
	<input type="hidden" name="employee_number" value="<?php echo $data['employee_number']; ?>" />
	<input type="hidden" name="quantity" id="quantity" value="<?php echo $data['quantity']; ?>" />
	
	 <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Return Item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Item name (Required)</label>
              <input value="<?php echo $data['item_name']; ?>" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Item number</label>
				  <p> <input value="<?php echo $data['item_number']; ?>" id="item_number" name="item_number" type="text" class="form-control validate" required></p>
           </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Quantity</label>
              <input value="<?php echo $data['quantity']; ?>" id="quantity" name="quantity" type="text" class="form-control validate" readonly required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Batch Number</label>
               <input value="<?php echo $data['batch_number']; ?>" id="batch_number" name="batch_number" type="text" class="form-control validate" required>
             
            </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">employee_number</label>
              <input value="<?php echo $data['employee_number']?>" id="employee_number" name="employee_number" type="text" class="form-control" required>
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