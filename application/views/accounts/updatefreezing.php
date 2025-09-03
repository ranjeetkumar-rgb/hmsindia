<?php
if (isset($_POST['submit'])) {
    extract($_POST);
	$ID = $_GET['ID'];
    $sql2 = "update freezing set iic_id='$iic_id', wife_name='$wife_name', wife_phone='$wife_phone', freezing='$freezing', remaining='$remaining', frozen_sample='$frozen_sample', freezing_date='$freezing_date', expiry_date='$expiry_date', first_renewal='$first_renewal', second_renewal='$second_renewal', third_renewal='$third_renewal', forth_renewal='$forth_renewal', discard_status='$discard_status',status='$status' where ID = '$ID'  ";
    $query2 = $this->db->query($sql2);
	$num = (int) $query2;
    if ($num > 0) {
        $_SESSION['MSG'] = "Your profile has been successfully updated.!!";
    } else {
        $_SESSION['MSG'] = "Your profile has not been updated.!!";
    }
}
    $ID = $_GET['ID'];
    $sql1 = "SELECT * FROM freezing WHERE ID='$ID'";
	$query = $this->db->query($sql1);
    $select_result1 = $query->result(); 
         foreach ($select_result1 as $res_val){      

      	 
?>
<div class="page-wrapper">
<form class="col-sm-12 col-xs-12" action="" enctype='multipart/form-data' method="post">
<div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Update Freezing</h3>
      </div>
      <div class="panel-body profile-edit">
	  
	  <div class="row">
	      <div class="form-group col-sm-4 col-xs-12">
		    <label>IIC Id</label>
            <input placeholder="Patient Name" id="iic_id" value="<?php echo $res_val->iic_id; ?>" name="iic_id" type="text" class="form-control">
          </div>
          <div class="form-group col-sm-4 col-xs-12">
		    <label>Patient Name</label>
            <input placeholder="Patient Name" id="wife_name" value="<?php echo $res_val->wife_name; ?>" name="wife_name" type="text" class="form-control">
          </div>
         <div class="form-group col-sm-4 col-xs-12">
		    <label>Phone</label>
            <input placeholder="Phone" id="wife_phone" value="<?php echo $res_val->wife_phone; ?>" name="wife_phone" type="text" class="form-control">
          </div>
        </div>
		 <div class="row">
	      <div class="form-group col-sm-6 col-xs-12">
		    <label>Freezing</label>
            <input placeholder="Freezing" id="freezing" value="<?php echo $res_val->freezing; ?>" name="freezing" type="text" class="form-control">
          </div>
          <div class="form-group col-sm-6 col-xs-12">
		    <label>Remaining</label>
            <input placeholder="Remaining" id="remaining" value="<?php echo $res_val->remaining; ?>" name="remaining" type="text" class="form-control">
          </div>
        </div>
	   <div class="row">
	   <div class="form-group col-sm-4 col-xs-12">
		    <label>Freezing Date</label>
            <input placeholder="Freezing Date" name="freezing_date" id="freezing_date" value="<?php echo $res_val->freezing_date; ?>" type="date" class="form-control">
          </div>
         <div class="form-group col-sm-4 col-xs-12">
		    <label>Expiry Date</label>
            <input placeholder="Expiry Date" name="expiry_date" id="expiry_date" value="<?php echo $res_val->expiry_date; ?>" type="date" class="form-control">
          </div>
		  <div class="form-group col-sm-4 col-xs-12">
		    <label>First Renewal Date</label>
            <input placeholder="First Renewal Date" name="first_renewal" id="first_renewal" value="<?php echo $res_val->first_renewal; ?>" type="date" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
		    <label>Second Renewal Date</label>
            <input placeholder="Second Renewal Date" name="second_renewal" id="second_renewal" value="<?php echo $res_val->second_renewal; ?>" type="date" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
		    <label>Third Renewal Date</label>
            <input placeholder="Third Renewal Date" name="third_renewal" id="third_renewal" value="<?php echo $res_val->third_renewal; ?>" type="date" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
		    <label>Forth Renewal Date</label>
            <input placeholder="Forth Renewal Date" name="forth_renewal" id="forth_renewal" value="<?php echo $res_val->forth_renewal; ?>" type="date" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
		     <label>Frozen Sample</label>
		     <input placeholder="Frozen Sample" name="frozen_sample" id="frozen_sample" value="<?php echo $res_val->frozen_sample; ?>" type="text" class="form-control">
          </div>
        </div>
	 
		<div class="row">
		 <div class="form-group col-sm-6 col-xs-12">
		 <label>Discard Status</label>
		 <select id="discard_status" name="discard_status">
		    <option value="<?php echo $res_val->discard_status; ?>"><?php echo $res_val->discard_status; ?></option>
			<option value="Active">Active</option>
			<option value="Discard">Discard</option>
			 <option value="Delete">Delete</option>
		 </select>
          </div>
         <div class="form-group col-sm-6 col-xs-12">
		 <label>Type</label>
		 <select id="status" name="status">
		    <option value="<?php echo $res_val->status; ?>"><?php echo $res_val->status; ?></option>
			<option value="New">New</option>
			<option value="Renew">Renew</option>
			
		 </select>
          </div>
</div>
		
<input type="submit" name="submit" value="submit"> 
</div>  
</div>
</div>  
</div>  
</form>
</div>
 <?php } ?>
<style>
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
select {
    display: block!important;
}
</style>    