<?php
    $ID = $_GET['ID'];
    $sql1 = "SELECT * FROM hms_mou WHERE ID='$ID'";
	$query = $this->db->query($sql1);
    $select_result1 = $query->result(); 
         foreach ($select_result1 as $res_val){       					
?>

  
   <form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data" >
      <input type="hidden" name="action" value="update_mou_item" />
     <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">MOU</h3>
      </div>
      <div class="panel-body profile-edit">
	  
	  <div class="row">
	      <div class="col-sm-6 col-xs-12" style="margin-top:10px;">
            	<label>Filter by status</label>
                <select class="form-control" id="status" name="status">
                	<option value=''><?php echo $res_val->status; ?></option>
					<option value='Active'>Active</option>
					<option value='Terminated'>Terminated</option>
					<option value='Due for Renewal'>Due for Renewal</option>
					<option value='Expired'>Expired</option>
                   
                </select>
            </div>
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Start Date" id="start_date" value="<?php echo $res_val->start_date; ?>" name="start_date" type="date" class="form-control">
          </div>
         <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Valdity" name="valdity" id="valdity" value="<?php echo $res_val->valdity; ?>" type="text" class="form-control">
          </div>
       
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Renwal Date" name="renwal_date" value="<?php echo $res_val->renwal_date; ?>" id="renwal_date" type="text" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Party Name" name="party_name" value="<?php echo $res_val->party_name; ?>" id="party_name" type="text" class="form-control">
          </div>
       
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Authorized Person" name="authorized_person" value="<?php echo $res_val->authorized_person; ?>" id="authorized_person" type="text" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Purpose" name="purpose" id="purpose" type="text" value="<?php echo $res_val->purpose; ?>" class="form-control">
          </div>
        
          
		  <div class="form-group col-sm-6 col-xs-12">
             <input placeholder="Remarks" name="remarks" value="<?php echo $res_val->remarks; ?>" id="remarks" type="text" class="form-control">
          </div>
        </div>
         <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submit" class="btn btn-large" value="Submit" />
        </div>
</div>  
</div>
</div>  
</div>  
</form>

 <?php } ?>
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