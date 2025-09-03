<form class="col-sm-12 col-xs-12" method="post" action="" >
  <input type="hidden" name="action" value="add_brand" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add brand</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Brand name (Required)</label>
            <input value="" placeholder="Brand name" id="name" name="name" type="text" class="form-control validate" required>
          </div>
          
          	<div class="form-group col-sm-6 col-xs-12">
            <label for="statuss">Status (Required)</label>
            <br/>
            <input type="radio" name="status" value="1" class="statuss" checked> Active 
            <input type="radio" name="status" value="0" class="statuss"> Inactive 
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