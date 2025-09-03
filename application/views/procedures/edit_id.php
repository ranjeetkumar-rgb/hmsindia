<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_id" />
    <input type="hidden" name="id" value="<?php echo $data['ID']; ?>" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Edit Consultation ID</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Code (Required)</label>
            <input value="<?php echo $data['code']?>" placeholder="Code" id="code" name="code" type="text" class="form-control validate" required>
          </div>
                    
          <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Type (Required)</label>
                <select name="type" required>
                    <option value="">Select Type</option>
                    <option value="consultation" <?php if($data['type'] == "consultation"){echo 'selected="selected"';}?>>Consultation</option>
                    <!-- <option value="investigation" <?php if($data['type'] == "investigation"){echo 'selected="selected"';}?>>Investigation</option>
                    <option value="procedure" <?php if($data['type'] == "procedure"){echo 'selected="selected"';}?>>Procedure</option>                     -->
                </select>
            </div>
        </div>
        
         <div class="row">          
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