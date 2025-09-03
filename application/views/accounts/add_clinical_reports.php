<?php
if(isset($_POST['submit'])){
      unset($_POST['submit']);
	
      $center  = $_POST['center'];
	  $year  = $_POST['year'];
      
	  unset($_POST['center']);
      unset($_POST['year']);
	 
	  $query = "INSERT INTO `hms_clinical_reports` (center, year) values ('$center','$year')";
      $result = run_form_query($query); 
       if($result){
         header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Clinical Reports form inserted!').'&t='.base64_encode('success'));
        	die();
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
		  die();
        }
}  	 
?>
<div class="page-wrapper">
<form class="col-sm-12 col-xs-12" action="" enctype='multipart/form-data' method="post">
<div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add Clinical Reports</h3>
      </div>
    <div class="panel-body profile-edit">
	
	<div class="row">
	    <div class="form-group col-sm-6 col-xs-12">
		 <label>Center</label>
		 <select id="center" name="center">
		    <option value="" selected>-- Select Center --</option>
			<option value="16267558222750">India IVF Fertility Delhi</option>
			<option value="16249589462327">India IVF Fertility Noida</option>
			 <option value="16266778858144">India IVF Fertility Gurgaon</option>
			 <option value="1581157290">Ghaziabad</option>
			 <option value="16098223739590">Kailash Gwalior</option>
			 <option value="16133769691598">Srinagar</option>
			 <option value="16376560997882">Itanagar</option>
			 <option value="16474253421459">Mandi</option>
		 </select>
        </div>
		<div class="form-group col-sm-6 col-xs-12">
		    <label>Expiry Date</label>
            <input placeholder="Year" name="year" id="year" value="" type="year" class="form-control">
        </div>
		        
    </div>	
<input type="submit" name="submit" id="submit" value="submit"> 
</div>  
</div>
</div>  
</div>  
</form>
</div>
<style>
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
select {
    display: block!important;
}
</style>    