 <?php $all_method =&get_instance();?>
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="add_purchase_order" />
    <input type="hidden" name="item_number" value="<?php echo $data['item_number']; ?>" />
	<input type="hidden" name="employee_number" id="employee_number" value="<?php echo $data['employee_number ']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Purchase order</h3>
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
	              <p><?php echo $data['item_number']; ?></p>
           </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Company (Required)</label>
              <input value="<?php echo $data['company']; ?>" id="company" name="company" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Vendor (Required)</label>
               <input value="<?php echo $data['vendor_number']; ?>" id="vendor_number" name="vendor_number" type="hidden" class="form-control validate" required>
              <p><?php echo $all_method->get_vendor_name($data['vendor_number']); ?></p>
            </div>
          </div>
          
          <div class="row">            
            <div class="form-group col-sm-6 col-xs-12">
             <label for="expiry">Brand (Required)</label>
              <input value="<?php echo $data['brand_name']; ?>" id="brand_name" name="brand_name" type="hidden" class="form-control validate" required>
              <p><?php echo $all_method->get_brand_name($data['brand_name']); ?></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Order quantity (Required)</label>
              <input value="<?php echo $data['order_qty']?>" id="order_quantity" name="order_quantity" type="text" class="form-control validate" required>
            </div>
          </div>
          
          <div class="row">            
            
            <div class="form-group col-sm-6 col-xs-12">
              <label for="expiry">Price (Required)</label>
              <input value="<?php echo $data['price']?>" placeholder="Price" id="price" name="price" type="text" class="form-control validate" required>
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