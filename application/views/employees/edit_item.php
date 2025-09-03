
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_item" />
    <input type="hidden" name="employee_number" value="<?php echo $data['employee_number']; ?>" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Edit Employee</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Employee Name (Required)</label>
            <input value="<?php echo $data['name']?>" placeholder="Employee name" id="name" name="name" type="text" class="form-control validate" required>
          </div>
          
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Phone (Required)</label>
            <input value="<?php echo $data['phone']?>" placeholder="Phone" id="phone" name="phone" type="text" class="form-control validate" required>
          </div>
          
          
        </div>
        
         <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Email (Required)</label>
            <input value="<?php echo $data['email']?>" placeholder="Email" id="email" name="email" type="email" class="form-control validate" required>
          </div>
          
          <div class="form-group col-sm-6 col-xs-12 role">
            <label for="statuss">Employee Role(Required)</label>
            <select name="role" id="role" required>
            	<option value="">Select Role</option>
            	<option value="accountant" <?php if($data['role'] == 'accountant'){echo "selected='selected'";}?>>Accountant</option>
            	<option value="stock_manager" <?php if($data['role'] == 'stock_manager'){echo "selected='selected'";}?>>Stock manager</option>
            	<option value="billing_manager" <?php if($data['role'] == 'billing_manager'){echo "selected='selected'";}?>>Billing manager</option>
              <option value="central_stock_manager" <?php if($data['role'] == 'central_stock_manager'){echo "selected='selected'";}?>>Central stock manager</option>
              <option value="investigator_manager" <?php if($data['role'] == 'investigator_manager'){echo "selected='selected'";}?>>Investigator manager</option>
              <option value="embryologist" <?php if($data['role'] == 'embryologist'){echo "selected='selected'";}?>>Embryologist</option>
              <option value="telecaller" <?php if($data['role'] == 'telecaller'){echo "selected='selected'";}?>>Telecaller</option>
            </select>
        </div>
        </div>
        <div class="clearfix"></div>
        
         <div class="row">
	           <div class="form-group col-sm-6 col-xs-12 role">
            <label for="statuss">Debartment(Required)</label>
            <select name="department" id="department" required>
              <option value="">Select Debartment</option>
              <option value="billing" <?php if($data['department'] == 'billing'){echo "selected='selected'";}?>>Billing</option>
              <option value="Nonsaleable" <?php if($data['department'] == 'Nonsaleable'){echo "selected='selected'";}?>>Nonsaleable</option>
              <option value="Hormonal" <?php if($data['department'] == 'Hormonal'){echo "selected='selected'";}?>>Hormonal</option>
              <option value="OT Noida" <?php if($data['department'] == 'OT Noida'){echo "selected='selected'";}?>>OT Noida</option>
              <option value="Embryologist Noida" <?php if($data['department'] == 'Embryologist Noida'){echo "selected='selected'";}?>>Embryologist Noida</option>
              <option value="House Keeping" <?php if($data['department'] == 'House Keeping'){echo "selected='selected'";}?>>House Keeping</option>
              <option value="Stationery" <?php if($data['department'] == 'Stationery'){echo "selected='selected'";}?>>Stationery</option>
			</select>
        </div>
           <div class="form-group col-sm-6 col-xs-12 role">
            <label for="statuss">Employee Center (Required)</label>
            <select name="center_id" required>
            	<option value="">Select Center</option>
				<?php foreach($centers as $ky => $vl){
					  $selected="";
					  if($data['center_id'] == $vl['center_number']){$selected="selected='selected'";}
					  ?>
              	  <option value="<?php echo $vl['center_number']?>" <?php echo $selected; ?>><?php echo $vl['center_name']?></option>
                <?php } ?>
            </select>
        </div>
        </div>
        
           <div class="row">
		    <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Password</label>
            <input value="" placeholder="Password" id="password" name="password" type="password" class="form-control validate">
          </div>
        	<!-- <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Allowed discount amount (USD) <span class="error"> (Only for billing manager) </span> (Required)</label>
                <input value="<?php echo $data['allow_discount_us']?>" placeholder="Allowed discount amount (USD)" id="allow_discount_us" name="allow_discount_us" type="text" class="form-control validate" required>
            </div> -->
          
      	    <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Allowed discount amount (Rupees) <span class="error"> (Only for billing manager) </span> (Required)</label>
                <input value="<?php echo $data['allow_discount_rs']?>" placeholder="Allowed discount amount (Rupees)" id="allow_discount_rs" name="allow_discount_rs" type="text" class="form-control validate" required>
            </div>
        </div>
        
        <div class="row">          
      	  <div class="form-group col-sm-6 col-xs-12">
            <label for="statuss">Employee Status (Required)</label>
            <br/>
            <input type="radio" name="status" value="1" <?php if($data['status'] == 1){echo 'checked="checked"';} ?> class="statuss" checked> Active 
            <input type="radio" name="status" value="0" <?php if($data['status'] == 0){echo 'checked="checked"';} ?> class="statuss"> Inactive 
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
	$(document).on('change', '#role', function() {
		var role = $(this).val();
		if(role == 'billing_manager' || role == ''){
			$('#allow_discount_us').prop('required', true);
		}else{
			$('#allow_discount_us').prop('required', false);
		}
	});
</script>