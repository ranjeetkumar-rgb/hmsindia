  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="update_setting" />
    <input type="hidden" name="ID" value="<?php echo $data['ID']; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Update Setting</h3>
        </div>
        <div class="panel-body profile-edit">
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">Conversion rate (Required)</label>
              <input value="<?php echo $data['conversion_rate']; ?>" placeholder="Conversion rate" id="conversion_rate" name="conversion_rate" type="number" min="0" class="form-control validate" required>
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
