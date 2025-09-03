<form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="change_password" />
    <input type="hidden" name="username" value="<?php echo $username; ?>" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Change Password</h3>
        </div>
        <div class="panel-body profile-edit">
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label for="item_name">New Password (Required)</label>
              <input value="" placeholder="Enter New Password" id="password" name="password" type="text" class="form-control validate" required>
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
