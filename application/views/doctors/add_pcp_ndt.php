<form class="col-sm-12 col-xs-12" method="post" action="" >
<input type="hidden" name="action" value="add_pcp_ndt" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">PCP NDT</h3>
      </div>
	  <div class="panel-body profile-edit">
<div class="row">
<div class="form-group col-sm-6 col-xs-12">
<strong>IIC ID: <input type="text" name="iic_id"></strong>
 </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Wife Name: <input type="text" name="wife_name"> </strong>
 </div>

<div class="form-group col-sm-6 col-xs-12">
<strong>Age: <input type="text" name="wife_age"></strong>
 </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Husband Name : <input type="text" name="husband_name"> </strong>
 </div>
 <div class="form-group col-sm-6 col-xs-12">
<strong>Wife Phone: <input type="text" name="wife_phone"> </strong>
 </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Address
<input type="text" name="wife_address" >
</strong>
 </div>

<div class="form-group col-sm-6 col-xs-12">
<strong>PARITY OF WOMAN WITH SEX OF PREVIOUS CHILD<br/> 
<input type="text" name="female_pregnancy_other_p" Placeholder="P"  style="width:30%;">
<input type="text" name="female_pregnancy_other_l" Placeholder="L" style="width:30%;">
<input type="text" name="female_pregnancy_other_a" Placeholder="A" style="width:30%;">
</strong>
 </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Reason For IVF / ART: <input type="text" name="details_management_advised"> </strong>
 </div>

<div class="form-group col-sm-6 col-xs-12">
<strong>Detail of Referring Dr.
<select name="IVF_Consultant" style="width:100%;display: block;">
<option value=""> <?php echo $res_val->IVF_Consultant; ?></option>
<option value="Dr.Richika Sahay">Dr.Richika Sahay</option>
<option value="Dr.Sonum Gautam">Dr.Sonum Gautam</option>
</select>
</strong>
  </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Procedure Done
<input type="text" name="procedure_done">
</strong>
  </div>

<div class="form-group col-sm-6 col-xs-12">
<strong>Outcome of The Tretment<input type="text" name="outcome_of_tretment"></strong>
  </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Detail of the Dr. further referred for delivery/Management of oregnancy
<input type="text" name="further_referredfor_dellvery">
</strong>
</div>

<div class="form-group col-sm-6 col-xs-12">
<strong>Outcome Of the Pregnancy
<input type="text" name="outcome_of_pregnancy">
</strong>
  </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Any Malformation in Newborn Details 
<input type="text" name="malformation_in_newborn">
</strong>
  </div>

<div class="form-group col-sm-6 col-xs-12">
<strong>Male
<input type="text" name="male">
</strong>
  </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Female <input type="text" name="female">
</strong>
  </div>
<div class="form-group col-sm-6 col-xs-12">
<strong>Female Issues 
<input type="text" name="female_issues">
<?php  $sql = "Select * from ".$this->config->item('db_prefix')."doctors where name='".$_SESSION['logged_doctor']['name']."'"; 
			                    $select_result = run_select_query($sql); 
                       $sql2 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result['center_id']."'"; 
			                    $select_result2 = run_select_query($sql2); 
                               ?>
<input type="hidden" name="center" value="<?php echo $select_result2['center_name']; ?>" >
</strong>
  </div>
  <div class="form-group col-sm-6 col-xs-12">
<strong>Test Type
<select name="test_type" style="width:100%;display: block;">
<option value=""> <?php echo $res_val->IVF_Consultant; ?></option>
<option value="ET/FET">ET/FET</option>
<option value="OPU">OPU</option>
<option value="IUI">IUI</option>
<option value="OVARIAN PRP">OVARIAN PRP</option>
</select>
</strong>
  </div>  
<div class="form-group col-sm-6 col-xs-12">
<strong>Date Of Discharge

<input type="hidden" class="Discharge" name="date" value="<?php echo date("Y-m-d"); ?>">								
<input type="date" class="Discharge" name="date_of_discharge"></strong>
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