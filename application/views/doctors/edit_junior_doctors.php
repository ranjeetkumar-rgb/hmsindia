<form class="col-sm-12 col-xs-12" method="post" action="" >
  <input type="hidden" name="action" value="update_junior_doctors" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add Junior Doctor</h3>
      </div>

	  <div class="panel-body profile-edit">
        <p>
			<div class="row">
				<div class="form-group col-sm-6 col-xs-12">
					<label for="item_name">Doctor Name (Dr.) (Required)</label>
					<input value="<?php echo $data['name']; ?>" placeholder="Doctor name" id="name" name="name" type="text" class="form-control validate" required>
				</div>

				<div class="form-group col-sm-6 col-xs-12">
					<label for="item_name">Doctor email (Required)</label>
					<input value="<?php echo $data['email']; ?>" placeholder="Doctor email" id="email" name="email" type="text" class="form-control validate" required>
				</div>
			</div>        

			<div class="row">            
				<div class="form-group col-sm-6 col-xs-12 role">
					<label for="statuss">Assigned To Doctors (Required) <span style="color:#f44336; font-weight:700;">** Press CTRL + Click for select/de-select **</span></label>
					<select name="doctors[]" required multiple>
						<option value="">Select doctors</option>
						<?php $doctor_related = get_doctors_relationship($data['ID']);
						foreach($doctors as $ky => $vl){ $selected=''; if(in_array($vl['ID'], $doctor_related)){$selected = 'selected="selected"';}?>
							<option value="<?php echo $vl['ID']?>" <?php echo $selected; ?>><?php echo $vl['name']?> (<?php echo get_center_name($vl['center_id']); ?>)</option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-sm-6 col-xs-12">
					<label for="item_name">Username (Required)</label>
					<h4><?php echo $data['username']?></h4>
				</div>
				
				<div class="form-group col-sm-6 col-xs-12">
					<label for="item_name">Password (Required)</label>
					<input value="" placeholder="" id="password" name="password" type="text" class="form-control validate">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-sm-6 col-xs-12">
					<label for="statuss">Status (Required)</label><br/>
					<input type="radio" name="status" value="1" <?php if($data['status'] == 1){echo 'checked="checked"';} ?> class="statuss"> Active 
				    <input type="radio" name="status" value="0" <?php if($data['status'] == 0){echo 'checked="checked"';} ?> class="statuss"> Inactive
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