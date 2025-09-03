<?php $all_method =&get_instance(); ?>
<style>
	input[type="checkbox"] {
		position: relative!important;
		left: 2px!important;
		opacity: 1!important;
	}
	.open > .dropdown-menu {
		width: 350px;
		max-height: 300px;
		overflow: auto;
	}
	label.checkbox {
		color: #000;
	}
	.btn-group{
		max-width: 100%;
	}
	button.multiselect.dropdown-toggle.btn.btn-default {
		width: 100%;
		overflow:hidden;
	}
</style>
<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_package" />
    <input type="hidden" name="package_id" value="<?php echo $data['package_id']; ?>" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Edit Package</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Package Name (Required)</label>
            <input value="<?php echo $data['package_name']?>" placeholder="Package name" id="package_name" name="package_name" type="text" class="form-control validate" required>
		  </div>
		</div>
        
        <div class="row">
             
            <div class="form-group col-sm-6 col-xs-12">
              <label for="statuss">Package Status (Required)</label>
              <br/>
              <input type="radio" name="status" value="1" <?php if($data['status'] == 1){echo 'checked="checked"';} ?> class="statuss"> Active 
              <input type="radio" name="status" value="0" <?php if($data['status'] == 0){echo 'checked="checked"';} ?> class="statuss"> Inactive 
            </div>
          </div>
      </div>

      <div class="row">
          <div class="form-group col-sm-6 col-xs-12 role">
              <label for="item_name">Procedure Form (Required)</label> <br/>
             <select class="form-control multidselect_dropdown_2" multiple="multiple" name="procedure_id[]">
    <?php 
    // Fetch all procedures related to package_id
    $get_forms = get_procedure_package_id($data['package_id']); 

    // Extract procedure IDs
    $forms = array_column($get_forms, 'procedure_id'); 

    // Debugging: Check if all expected IDs are fetched
    var_dump($forms); 

    // Loop through available procedures and mark selected ones
    foreach ($procedures as $key => $val) {
        $selected = in_array($val['ID'], $forms) ? "selected='selected'" : "";
        echo '<option value="'.$val['ID'].'" '.$selected.'>'.ucfirst(strtolower(str_replace("_", " ", $val['procedure_name']))).'</option>'; 
    }                   
    ?>
</select>


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
$(function() {
	$('.multidselect_dropdown_2').multiselect({ includeSelectAllOption: true });
});
</script>