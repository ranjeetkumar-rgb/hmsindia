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
  <input type="hidden" name="action" value="update_procedure_form" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Edit Procedure Form</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>

      <div class="row">
          <div class="form-group col-sm-6 col-xs-12 role">
              <label for="item_name">Procedure Form (Required)</label> <br/>
              <select class="form-control" required name="form_name">
              <option value=''>--Select--</option>
              <?php  $dic = dirname(__DIR__); //var_dump($dic.'/procedure-forms');die;
                  if ($handle = opendir($dic.'/procedure-forms')) {
                    while (false !== ($entry = readdir($handle))) {                
                        if ($entry != "." && $entry != "..") {                
                            //echo "$entry\n";
                            $string = substr($entry, 0, -4);
                            $database_string = str_replace('-', "_", $string);
                            $string = str_replace('-', " ", $string);
                            $selected="";
                            if($string == $data['form_name']){
                              $selected="selected='selected'";
                            }
                            echo '<option value="'.$string.'" '.$selected.'>'.ucfirst(strtolower(str_replace("_", " ", $database_string))).'</option>';
                        }
                    }        
                    closedir($handle);
                  }
              ?>
              </select>
          </div>
          <div class="form-group col-sm-6 col-xs-12 role">
              <label for="item_name">Form For (Required)</label> <br/>
              <select name='form_for' required class='form-control'>
                <option value=''>--Select--</option>
                <option value='daycare_procedure' <?php if("daycare_procedure" == $data['form_for']){ echo "selected='selected'";}?>>Daycare Procedure</option>
                <!-- <option value='opd_procedure'>OPD Procedure</option> -->
                <option value='lab_procedure' <?php if("lab_procedure" == $data['form_for']){ echo "selected='selected'";}?>>Lab Procedure</option>
				<option value='opd_procedure' <?php if("opd_procedure" == $data['form_for']){ echo "selected='selected'";}?>>Psychological</option>
              </select>
          </div>

          <div class="form-group col-sm-6 col-xs-12 role">
            <label for="item_name">Is Refillable?</label> <br/>
            <input type="radio" value="single" <?php if($data['type'] == "single"){echo "checked"; }?> class="statuss" name="type" /> Single
            <input type="radio" value="multiple" <?php if($data['type'] == "multiple"){echo "checked"; }?> class="statuss" name="type" /> Multiple
          </div>
		   <div class="form-group col-sm-6 col-xs-12 role">
            <label for="item_name">Status</label> <br/>
            <input type="radio" value="active" <?php if($data['status'] == "active"){echo "checked"; }?> class="" name="status" /> Active
            <input type="radio" value="inactive" <?php if($data['status'] == "inactive"){echo "checked"; }?> class="" name="status" /> Inactive
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