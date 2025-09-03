 <?php $all_method =&get_instance();?>
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_audit_item" />
	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
	
	 <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Update Audit Item</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Batch Number</label>
              <input value="<?php echo $data['item_name']; ?>" id="item_name" name="item_name" type="text" class="form-control validate" required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="expiry">Item number</label>
				  <p> <input value="<?php echo $data['batch_number']; ?>" id="batch_number" name="batch_number" type="text" class="form-control validate" required></p>
           </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Quantity</label>
              <input value="<?php echo $data['quantity']; ?>" id="quantity" name="quantity" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Physical Quantity</label>
               <input value="<?php echo $data['physical_quantity']; ?>" id="physical_quantity" name="physical_quantity" type="text" class="form-control validate" required>
             
            </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Register Quantity</label>
              <input value="<?php echo $data['register_quantity']?>" id="register_quantity" name="register_quantity" type="text" class="form-control" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Short Quantity</label>
              <input value="<?php echo $data['short']?>" id="short" name="short" type="text" class="form-control" required>
            </div>
          </div>
		  
		   <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Excess Quantity</label>
              <input value="<?php echo $data['excess']?>" id="excess" name="excess" type="text" class="form-control" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Damage</label>
              <input value="<?php echo $data['damage']?>" id="damage" name="damage" type="text" class="form-control" required>
            </div>
          </div>
		  
		   <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Discard</label>
              <input value="<?php echo $data['discard']?>" id="discard" name="discard" type="text" class="form-control" required>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Reason</label>
              <input value="<?php echo $data['reason']?>" id="reason" name="reason" type="text" class="form-control">
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