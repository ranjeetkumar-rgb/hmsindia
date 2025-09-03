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
  <input type="hidden" name="action" value="add_procedure_form" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add Procedure Form</h3>
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
                            echo '<option value="'.$string.'">'.ucfirst(strtolower(str_replace("_", " ", $database_string))).'</option>';
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
                <option value='daycare_procedure'>Daycare Procedure</option>
                <!-- <option value='opd_procedure'>OPD Procedure</option> -->
                <option value='lab_procedure'>Lab Procedure</option>
				<option value='opd_procedure'>Psychological</option>
              </select>
          </div>

          <div class="form-group col-sm-6 col-xs-12 role">
            <label for="item_name">Is Refillable?</label> <br/>
            <input type="radio" value="single" class="statuss" checked name="type" /> Single
            <input type="radio" value="multiple" class="statuss" name="type" /> Multiple
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