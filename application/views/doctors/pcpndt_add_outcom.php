<?php
    // php code to Insert data into mysql database from input text
    if(isset($_POST['submit'])){
        unset($_POST['submit']);
      $wife_name  = $_POST['wife_name'];
	  $husband_name  = $_POST['husband_name'];
      $wife_phone  = $_POST['wife_phone'];
	  $wife_age  = $_POST['wife_age'];
	  $wife_address  = $_POST['wife_address'];
	  $female_pregnancy_other_p  = $_POST['female_pregnancy_other_p'];
	  $female_pregnancy_other_l  = $_POST['female_pregnancy_other_l'];
	  $female_pregnancy_other_a  = $_POST['female_pregnancy_other_a'];
	  $details_management_advised  = $_POST['details_management_advised'];
	  $IVF_Consultant  = $_POST['IVF_Consultant'];
	  $center  = $_POST['center'];
	  
	  unset($_POST['wife_name']);
      unset($_POST['wife_phone']);
	  unset($_POST['husband_name']);
      unset($_POST['wife_age']);
	  unset($_POST['wife_address']);
	  unset($_POST['female_pregnancy_other_p']);
	  unset($_POST['female_pregnancy_other_l']);
	  unset($_POST['female_pregnancy_other_a']);
	  unset($_POST['details_management_advised']);
	  unset($_POST['IVF_Consultant']);
	  unset($_POST['center']);   
	//Insert into freezing table
            $query1 = "INSERT INTO `pcp_ndt` (iic_id, wife_name, husband_name, wife_phone, wife_age, wife_address, female_pregnancy_other_p, female_pregnancy_other_l, female_pregnancy_other_a, details_management_advised, IVF_Consultant, further_referredfor_dellvery, outcome_of_pregnancy, malformation_in_newborn, center, test_type, type, date) values 
		   ('$iic_id','$wife_name', '$husband_name', '$wife_phone', '$wife_age', '$wife_address', 'P:$female_pregnancy_other_p', 'L:$female_pregnancy_other_l', 'A:$female_pregnancy_other_a', '$details_management_advised','$IVF_Consultant', '$further_referredfor_dellvery', '$outcome_of_pregnancy', '$malformation_in_newborn', '$center', 'OUTCOME','OUTCOME','" . date('Y-m-d h:i:s') . "')";
            $result = run_form_query($query1); 
        if($result){
         header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Discharge form inserted!').'&t='.base64_encode('success'));
        	die();
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
		  die();
        }
    }
	
	
?>

<div class="ga-pro">
<h3>ADD OUTCOME</h3>
<form action="" enctype='multipart/form-data' method="post">
<table width="100%" class="vb45rt">
<tbody>
<tr>
<td colspan="2" width="50%">
<strong>IIC ID: <input type="text" name="iic_id" value="<?php echo $res_val->iic_id; ?>"></strong>
</td>
<td colspan="2" width="50%">
<strong>Wife Name: <input type="text" name="wife_name" value="<?php echo $res_val->wife_name; ?>"> </strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>Age: <input type="text" name="wife_age" value="<?php echo $res_val->wife_age; ?>"></strong>
</td>
<td colspan="2" width="50%">
<strong>Husband Name : <input type="text" name="husband_name" value="<?php echo $res_val->husband_name; ?>"> </strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>Address
<textarea name="wife_address" style="width:100%; height:100px!important;" > <?php echo $res_val->wife_address; ?> </textarea>
</strong>
</td>
<td width="50%">
<strong>Wife Phone:
<textarea name="wife_phone" style="width:100%; height:100px!important;" ><?php echo $res_val->wife_phone; ?></textarea>
</strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>PARITY OF WOMAN WITH SEX OF PREVIOUS CHILD<br/> 
<input type="text" name="female_pregnancy_other_p" value="<?php echo $res_val->female_pregnancy_other_p; ?>" style="width:30%; margin-right:10px!important;">
<input type="text" name="female_pregnancy_other_l" value="<?php echo $res_val->female_pregnancy_other_l; ?>" style="width:30%; margin-right:10px!important;">
<input type="text" name="female_pregnancy_other_a" value="<?php echo $res_val->female_pregnancy_other_a; ?>" style="width:30%;">
</strong>
</td>
<td colspan="2" width="50%">
<strong>Reason For IVF / ART: <input type="text" name="details_management_advised" value="<?php echo $res_val->details_management_advised; ?>"> </strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>Detail of Referring Dr.
<select name="IVF_Consultant" style="width:100%;display: block;">
<option value="<?php echo $res_val->IVF_Consultant; ?>"> <?php echo $res_val->IVF_Consultant; ?></option>
<option value="Dr.Richika Sahay">Dr.Richika Sahay</option>
<option value="Dr.Sonum Gautam">Dr.Sonum Gautam</option>
</select>
</strong>
</td>
<td width="50%">
<strong>Procedure Done
<textarea name="procedure_done" style="width:100%; height:100px!important;" > <?php echo $res_val->procedure_done; ?> </textarea>
</strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>Outcome of The Tretment
<textarea name="outcome_of_tretment" style="width:100%; height:100px!important;" > <?php echo $res_val->outcome_of_tretment; ?> </textarea>
</strong>
</td>
<td width="50%">
<strong>Detail of the Dr. further referred for delivery/Management of oregnancy
<textarea name="further_referredfor_dellvery" style="width:100%; height:100px!important;" > <?php echo $res_val->further_referredfor_dellvery; ?> </textarea>
</strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>Outcome Of the Pregnancy
<textarea name="outcome_of_pregnancy" style="width:100%; height:100px!important;"  > <?php echo $res_val->outcome_of_pregnancy; ?> </textarea>
</strong>
</td>
<td width="50%">
<strong>Any Malformation in Newborn Details 
<textarea name="malformation_in_newborn" style="width:100%; height:100px!important;"  > <?php echo $res_val->malformation_in_newborn; ?> </textarea>
</strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>Male
<textarea name="male" style="width:100%; height:100px!important;"  > <?php echo $res_val->male; ?> </textarea>
</strong>
</td>
<td width="50%">
<strong>Female 
<textarea name="female" style="width:100%; height:100px!important;"  > <?php echo $res_val->female; ?> </textarea>
</strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<strong>Any Mailformation In new born details
<textarea name="malformation_in_newborn" style="width:100%; height:100px!important;" > <?php echo $res_val->malformation_in_newborn; ?> </textarea>
</strong>
</td>
<td colspan="2" width="50%">
<strong>Center
<select name="center" style="width:100%;display: block;" required>
<option value="<?php echo $res_val->center; ?>"> <?php echo $res_val->center; ?></option>
<option value="India IVF Fertility Noida">India IVF Fertility Noida</option>
<option value="India IVF Fertility Fortis">India IVF Fertility Fortis</option>
</select>
</strong>
</td>
</tr>
</tbody>
</table> 
</div>  
<input type="submit" name="submit" value="submit">
</form>
</div>

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