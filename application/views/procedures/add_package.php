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
  <input type="hidden" name="action" value="add_package" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add Package</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Package Name (Required)</label>
            <input value="" placeholder="Package name" id="package_name" name="package_name" type="text" class="form-control validate" required>
          </div>
		</div>        
        
         <div class="row">          
            <div class="form-group col-sm-6 col-xs-12">
            <label for="statuss">Package Status (Required)</label>
            <br/>
            <input type="radio" name="status" value="1" class="statuss" checked> Active 
            <input type="radio" name="status" value="0" class="statuss"> Inactive 
          </div>
         </div>
        
      </div>

      <div class="row">
          <div class="form-group col-sm-6 col-xs-12 role">
              <label for="item_name">Procedure Name (Required)</label> <br/>
              <select class="form-control multidselect_dropdown_2"  multiple="multiple" name="procedure_id[]">
              <?php
                foreach($procedures as $key => $val){
                    echo '<option value="'.$val['ID'].'">'.ucfirst(strtolower(str_replace("_", " ", $val['procedure_name']))).' ('.$val['code'].')</option>'; 
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