
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_investigation" />
    <input type="hidden" name="id" value="<?php echo $data['ID']; ?>" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Edit Investigation</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
		 <div class="form-group col-sm-6 col-xs-12">
		  <label for="item_name">Vendor Name (Required)</label>
			<select name="vendor_id" required class="select2" style="display:block;">
            	<option value="">Vendor Name</option>
				<?php foreach($investigation_vendor as $ky => $vl){
					  $selected="";
					  if($data['vendor_id'] == $vl['ID']){$selected="selected='selected'";}
					  ?>
              	  <option value="<?php echo $vl['ID']?>" <?php echo $selected; ?>><?php echo $vl['name']?></option>
                <?php } ?>
            </select>
			</div>
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Investigation Name (Required)</label>
            <input value="<?php echo $data['investigation']?>" placeholder="investigation name" id="investigation" name="investigation" type="text" class="form-control validate" required>
          </div>
                    
              
          
        </div>
        
         <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Price (Required)</label>
            <input value="<?php echo $data['price']?>" placeholder="Price" id="price" name="price" type="text" class="form-control validate" required>
          </div>  
       	<div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">USD Price (Required)</label>
            <input value="<?php echo $data['usd_price']?>" placeholder="USD Price" id="usd_price" name="usd_price" type="text" class="form-control validate" required>
        </div>
         
          
        </div>
		
		 <div class="row">
		 
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Investigation code (Required)</label>
            <input value="<?php echo $data['code']?>" placeholder="Investigation code" id="code" name="code" type="text" class="form-control validate" required>
          </div>
         
       	<div class="form-group col-sm-6 col-xs-12">
		<label for="item_name">Select Center (Required)</label>
		<select name="center_id" required style="display:block;">
            	<option value="">Select Center</option>
				<?php foreach($centers as $ky => $vl){
					  $selected="";
					  if($data['center_id'] == $vl['center_number']){$selected="selected='selected'";}
					  ?>
              	  <option value="<?php echo $vl['center_number']?>" <?php echo $selected; ?>><?php echo $vl['center_name']?></option>
                <?php } ?>
            </select>
			</div>
        
        <div class="row">     
		<div class="form-group col-sm-6 col-xs-12">
		<label for="item_name">Master Investigation (Required)</label>
			<select name="master_id" required class="select2" style="display:block;">
            	<option value="">Master Investigation</option>
				<?php foreach($master_investigation as $ky => $vl){
					  $selected="";
					  if($data['master_id'] == $vl['ID']){$selected="selected='selected'";}
					  ?>
              	  <option value="<?php echo $vl['ID']?>" <?php echo $selected; ?>><?php echo $vl['investigation_name']?>-<?php echo $vl['code']?></option>
                <?php } ?>
            </select>
			</div>		
          <div class="form-group col-sm-6 col-xs-12">
            <label for="statuss">Status (Required)</label>
            <br/>
            <input type="radio" name="status" value="1" <?php if($data['status'] == 1){echo 'checked="checked"';} ?> class="statuss"> Active 
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
