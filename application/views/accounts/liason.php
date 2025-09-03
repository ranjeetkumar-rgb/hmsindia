<?php $all_method =&get_instance(); ?>

  <form class="col-sm-12 col-xs-12" action="<?php echo base_url();?>accounts/liason" enctype="multipart/form-data" method="post">
   <input type="hidden" name="action" value="add_liason" />
     <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Liason</h3>
      </div>
      <div class="panel-body profile-edit">
	   <div class="row">
	  <div class="form-group col-sm-6 col-xs-12" style="margin-top:10px;">
            	<label>Center Name</label>
                <select class="form-control" id="center" name="center">
                	<option value=''>--Select From--</option>
					<option value='India IVF Fertility Noida'>India IVF Fertility Noida</option>
					<option value='India IVF Fertility Gurgaon'>India IVF Fertility Gurgaon</option>
					<option value='India IVF Fertility Delhi'>India IVF Fertility Delhi</option>
					<option value='India IVF Fertility Ghaziabad'>India IVF Fertility Ghaziabad</option>
					<option value='India IVF Fertility Srinagar'>India IVF Fertility Srinagar</option>
					
                </select>
        </div>
		 <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Certificate Name" id="certificate" value="" name="certificate" type="text" class="form-control">
          </div>
	  </div>
	   <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Certificate / Licence No" id="licence" value="" name="licence" type="text" class="form-control">
          </div>
         <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Dept Name" name="dept_name" id="dept_name" value="" type="text" class="form-control">
          </div>
        </div>
	  <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Start Date" id="start_date" value="" name="start_date" type="date" class="form-control">
          </div>
         <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Renwal Date" name="renwal_date" id="renwal_date" type="date" class="form-control">
          </div>
        </div>
	   <div class="row">
         
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Concern Person" name="party_name" id="party_name" type="text" class="form-control">
          </div>
		   <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Contact Number" name="contact_no" id="contact_no" type="text" class="form-control">
          </div>
        </div>
		 <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Website Url	" name="web_url" id="web_url" type="text" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="User ID" name="user_id" id="user_id" type="text" class="form-control">
          </div>
        </div>
		 <div class="row">
		 <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Password" name="password" id="password" type="text" class="form-control">
          </div>
          <div class="form-group col-sm-6 col-xs-12">
            <input name="transaction_img" id="transaction_img" type="file" class="form-control">
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