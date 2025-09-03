<?php $all_method =&get_instance(); ?>

  <form class="col-sm-12 col-xs-12" action="<?php echo base_url();?>accounts/add_mou" enctype="multipart/form-data" method="post">
   <input type="hidden" name="action" value="add_mou" />
     <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add Mou</h3>
      </div>
      <div class="panel-body profile-edit">
	   <div class="row">
	    <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="File ID" id="file_id" value="" name="file_id" type="text" class="form-control">
          </div>
	   <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Start Date" id="start_date" value="" name="start_date" type="date" class="form-control">
          </div>
         <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Valdity" name="valdity" id="valdity" value="" type="text" class="form-control">
          </div>
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Renwal Date" name="renwal_date" id="renwal_date" type="text" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Party Name" name="party_name" id="party_name" type="text" class="form-control">
          </div>
            <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Authorized Person" name="authorized_person" id="authorized_person" type="text" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Purpose" name="purpose" id="purpose" type="text" class="form-control">
          </div>
        
		
          <div class="form-group col-sm-6 col-xs-12">
            <input name="transaction_img" id="transaction_img" type="file" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Purpose" name="remarks" id="remarks" type="text" class="form-control">
          </div>
        </div>
         <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />
        </div>
</div>  
</div>
</div>  
</div>  
</form>

<style>
select#center {
    display: block!important;
}
input[type=checkbox], input[type=radio] {
    opacity: 1 !important;
    left: 0 !important;
    position: unset !important;
    margin: 9px !important;
}
.sec3 td {
    text-align: left;
}
.sec2 {
    border: 1px solid #000;
}
.sec2 p {
    margin: 0px;
    padding: 2px 10px;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td {
  border: 1px solid #000;
  text-align: center;
  padding: 5px; 
}
.ga-pro h3 {
      text-align: center;
    font-size: 25px;
}
form {
    padding-left: 10px;
    margin-bottom: 4px;
}
.nb56ty input {
    width: 100%;
}
.vb45rt td {
	text-align: left; 
	padding-left: 10px;
}
</style>    