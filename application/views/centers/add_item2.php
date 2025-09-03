
<form class="col-sm-12 col-xs-12" method="post" action="" >
  <input type="hidden" name="action" value="add_item" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add Center</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Center Name (Required)</label>
            <input value="" placeholder="Center name" id="center_name" name="center_name" type="text" class="form-control validate" required>
          </div>
          <div class="form-group col-sm-6 col-xs-12 role">
            <label for="item_name">Center Type (Required)</label>
            <select name="type" required>
                <option value="">Select Type</option>
                <option value="stand-alone">Stand Alone</option>
                <option value="associated">Associated</option>
            </select>
          </div>
      </div>
      
      <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Center Location (Required)</label>
            <textarea value="" placeholder="Center location" id="center_location" name="center_location" class="form-control validate" required></textarea>
          </div>

      <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="statuss">Center Status(Required)</label>
            <br/>
            <input type="radio" name="status" value="1" class="statuss" checked>
            Active
            <input type="radio" name="status" value="0" class="statuss">
            Inactive </div>
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
