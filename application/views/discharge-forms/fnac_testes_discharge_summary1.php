<?php $all_method =&get_instance();
$appoitmented_date = $_GET['appoitmented_date'];
    // php code to Insert data into mysql database from input text
    if(isset($_POST['submit'])){
        unset($_POST['submit']);
        
       
		
		
		     	if (!empty($appoitmented_date)) {
			$sql = "SELECT * FROM `fnactestes_discharge_summary` WHERE iic_id='$iic_id' AND appoitmented_date='$appoitmented_date'";
	} else {
			$sql = "SELECT * FROM `fnactestes_discharge_summary` WHERE iic_id='$iic_id'";
	}
	$select_result = run_select_query($sql);
		
	    if(empty($select_result)){
            // mysql query to insert data
            $query = "INSERT INTO `fnactestes_discharge_summary` SET ";
            $sqlArr = array();
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".addslashes($value)."'";
            }		
            $query .= implode(',' , $sqlArr);
        }else{
            // mysql query to update data
            $query = "UPDATE  fnactestes_discharge_summary SET ";
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".$value."'"	;
            }
            $query .= implode(',' , $sqlArr);
             if($_SESSION['logged_doctor']['username']){
              $query .= " WHERE iic_id='$iic_id' and appoitmented_date='$appoitmented_date'";
	        }else{
	          $query .= " WHERE iic_id='$iic_id' and id='$id'";
	        }
        }
       $result = run_form_query($query); 
        
      if($result){
         header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Discharge form inserted!').'&t='.base64_encode('success'));
        	die();
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
		  die();
        }
    }

   	     	if (!empty($appoitmented_date)) {
			$sql = "SELECT * FROM `fnactestes_discharge_summary` WHERE iic_id='$iic_id' AND appoitmented_date='$appoitmented_date'";
	} else {
			$sql = "SELECT * FROM `fnactestes_discharge_summary` WHERE iic_id='$iic_id'";
	}
	$select_result = run_select_query($sql);

	$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."'";
	$select_result1 = run_select_query($sql1);
	
	$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
	$select_result2 = run_select_query($sql2);
	
	$sql3 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
	$select_result3 = run_select_query($sql3);
?>


<form action="" enctype='multipart/form-data' method="post">

<input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">
  <input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">
  <input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">
  <input type="hidden" value="<?php echo $appoitmented_date; ?>" class="form" name="appoitmented_date">
  <input type="hidden" value="<?php echo $iic_id; ?>" class="form" name="iic_id">

<div class="ga-pro">
<h3>Discharge Summary</h3>
<h4>Department of Embryology</h4>
<div class="col-sm-12 col-md-12">	
<div class="col-sm-12 col-md-4" style="margin-bottom: 10px;">
<label for="Center">Center</label>
<select class="form-control" id="center" name="center">
    <option value=''>--Select From--</option>
    <?php $all_centers = $all_method->get_all_centers();
	foreach($all_centers as $key => $val){ //var_dump($val);die;
    if($center == $val['center_number']){
    echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
    }else{
	echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
    }
    } 
	?>
    </select> 
 </div> 
<div class="col-sm-12 col-md-2" style="margin-bottom: 10px;">
  <label for="Admission">Date of Admission:</label>
  <input type="date" class="Admission" name="date_of_addmission" value="<?php echo isset($select_result['date_of_addmission'])?$select_result['date_of_addmission']:""; ?>">
 </div>
<div class="col-sm-12 col-md-2" style="margin-bottom: 10px;">
  <label for="Admission">Admission Time:</label>
  <input type="time" class="Admission" name="time_of_addmission" value="<?php echo isset($select_result['time_of_addmission'])?$select_result['time_of_addmission']:""; ?>">
 </div>   
<div class="col-sm-12 col-md-2" style="margin-bottom: 10px;">
  <label for="Discharge">Date of Discharge:</label>
  <input type="date" class="Discharge" name="date_of_discharge" value="<?php echo isset($select_result['date_of_discharge'])?$select_result['date_of_discharge']:""; ?>">
 </div> 
<div class="col-sm-12 col-md-2" style="margin-bottom: 10px;">
  <label for="Discharge">Discharge Time:</label>
  <input type="time" class="Discharge" name="time_of_discharge" value="<?php echo isset($select_result['time_of_discharge'])?$select_result['time_of_discharge']:""; ?>">
 </div>  
</div>      

<table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">
    <td colspan="4" width="100%" style="border:1px solid;padding:5px;">
	<strong>Details of Female Partner</strong>
	</td>
  </tr>
<tr style="background: #b3b9b7;">
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></strong>
</td>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td colspan="2" width="57%">
<strong>Name : <?php echo $patient_data['wife_name']; ?> </strong>
</td>
<td width="42%">
<strong>Husband&rsquo;s name : <?php echo $patient_data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="2" width="57%">
<strong>Age: <?php echo $patient_data['wife_age']; ?></strong>
</td>
<td width="42%">
<strong>Age: <?php echo $patient_data['husband_age']; ?></strong>
</td>
</tr>


<tr>
<td colspan="2" width="57%">
<strong>Provisional Diagnosis:

 <textarea name="female_issues" style="width:100%; height:150px;" > <?php echo isset($select_result['female_issues'])?$select_result['female_issues']:""; ?> </textarea>
</strong>
</td>
<td width="42%">
<strong>Final Diagnosis:

 <textarea name="male_issues" style="width:100%; height:150px;" > <?php echo isset($select_result['male_issues'])?$select_result['male_issues']:""; ?> </textarea>
</strong>

</td>
</tr>

<tr>
<td width="50%">
<strong>Name of Procedure : FNAC TESTES</strong>
</td>
<td colspan="2" width="50%">
<strong>Date of procedure:  <input type="date" class="date_of_procedure" name="date_of_procedure" value="<?php echo isset($select_result['date_of_procedure'])?$select_result['date_of_procedure']:""; ?>">   </strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%">
<label for="Rt">sperms seen /not seen Rt Testes</label>
<textarea name="Rt" style="width:100%; height:100px!important;"  > <?php echo isset($select_result['Rt'])?$select_result['Rt']:""; ?> </textarea>
</td>
<td colspan="2" width="50%"> 
<label for="Lt">sperms seen /not seen Lt Testes </label>
<textarea name="Rt" style="width:100%; height:100px!important;"  > <?php echo isset($select_result['Lt'])?$select_result['Lt']:""; ?> </textarea>
</td>
</tr> 
</tbody>
</table> 

</div>  
  


<div class="sec21">
<p><b></b></p>   
 <label for="Senior Embryologist">Senior Embryologist</label>
  <input type="text" class="SeniorEmbryologist" name="Senior_Embryologist" readonly="" value="<?php echo $_SESSION['logged_embryologist']['name']?><?php echo isset($select_result['Senior_Embryologist'])?$select_result['Senior_Embryologist']:""; ?>">
</div>
<div class="sec2">
  
<label for="other">Please take prescribed medicines / injections only. Dont skip/ stop any medicine on your own unless advised by the doctor.</label>
    
</div> 
</div>
<input type="submit" name="submit" value="submit">
</form>

<div class="row" id="print_this_section" style="display:none;">
<form action="" enctype='multipart/form-data' method="post">
<div class="ga-pro">
<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
<tr>
   <td style="width:50%;padding:5px;" colspan="2"><img src="https://indiaivf.website/assets/images/india-ivf-logo.webp"></td>
   <td style="width:50%;padding:5px;" colspan="2"><h3 style="margin-top:20px;">Discharge Summary</h3><strong>Department of Embryology FNAC TESTES</strong></td>
</tr>
</table>
<table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">
<td colspan="2" style="border:1px solid;padding:5px;width:50%;">
<strong>Date of Admission: <?php echo isset($select_result['date_of_addmission'])?$select_result['date_of_addmission']:""; ?></strong>
</td>
<td style="border:1px solid;padding:5px;width:50%;">
<strong>Date of Discharge: <?php echo isset($select_result['date_of_discharge'])?$select_result['date_of_discharge']:""; ?></strong>
</td>
</tr>

<tr style="background: #b3b9b7;">
    <td colspan="4" width="100%" style="border:1px solid;padding:5px;">
	<strong>Details of Female Partner</strong>
	</td>
  </tr>
<tr style="background: #b3b9b7;">
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></strong>
</td>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td colspan="2" style="border:1px solid;padding:5px;width:50%;">
<strong>Name : <?php echo $patient_data['wife_name']; ?> </strong>
</td>
<td style="border:1px solid;padding:5px;width:50%;">
<strong>Husband&rsquo;s name : <?php echo $patient_data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="2" style="border:1px solid;padding:5px;width:50%;">
<strong>Age: <?php echo $patient_data['wife_age']; ?></strong>
</td>
<td style="border:1px solid;padding:5px;width:50%;">
<strong>Age: <?php echo $patient_data['husband_age']; ?></strong>
</td>
</tr>

<tr>
<td colspan="2" style="border:1px solid;padding:5px;width:50%;">
<strong>Provisional Diagnosis:
 <textarea style="width:100%; height:100px;" > <?php echo isset($select_result['female_issues'])?$select_result['female_issues']:""; ?> </textarea>
</strong>
</td>
<td style="border:1px solid;padding:5px;width:50%;">
<strong>Final Diagnosis:

 <textarea style="width:100%; height:100px;" > <?php echo isset($select_result['male_issues'])?$select_result['male_issues']:""; ?> </textarea>
</strong>

</td>
</tr>

<tr>
<td colspan="2" style="border:1px solid;padding:5px;width:50%;">
<strong>Name of Procedure : FNAC TESTES</strong>
</td>
<td colspan="2" style="border:1px solid;padding:5px;width:50%;">
<strong>Date of procedure:  <?php echo isset($select_result['date_of_procedure'])?$select_result['date_of_procedure']:""; ?>   </strong>
</td>
</tr>

<tr>
<td colspan="2" style="border:1px solid;padding:5px;width:50%;">
<label for="Rt">sperms seen /not seen Rt Testes</label>
<textarea  style="width:100%; height:100px!important;"  > <?php echo isset($select_result['Rt'])?$select_result['Rt']:""; ?> </textarea>
</td>
<td colspan="2" style="border:1px solid;padding:5px;width:50%;"> 
<label for="Lt">sperms seen /not seen Lt Testes </label>
<textarea  style="width:100%; height:100px!important;"  > <?php echo isset($select_result['Lt'])?$select_result['Lt']:""; ?> </textarea>
</td>
</tr> 

<tr>
<td colspan="4" style="border:1px solid;padding:5px;width:100%;">
<label for="Rt">Senior Embryologist</label>
<?php echo isset($select_result['Senior_Embryologist'])?$select_result['Senior_Embryologist']:""; ?>
</td>
</tr> 

<tr>
<td colspan="4" style="border:1px solid;padding:5px;width:100%;">
<label for="other">Please take prescribed medicines / injections only. Dont skip/ stop any medicine on your own unless advised by the doctor.</label>
</td>
</tr> 
</tbody>
</table> 
</div>  
</div>
</form>
</div>
<style>
input[type=checkbox], input[type=radio] {
    opacity: 1 !important;
    left: 0 !important;
    position: unset !important;
    margin: 9px !important;
}
.sec3 {  
    border: 1px solid #000;
    padding: 5px;
}
.sec21 {
    border: 1px solid #000;
}
.sec21 p {
    margin: 20px;
    padding: 2px 10px;
}
.sec2 {
    border: 1px solid #000;
    padding-top: 5px;
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
.ga-pro h4 {
      text-align: center;
    font-size: 20px;
}
form {
    padding-left: 10px;
    margin-bottom: 4px;
}
.nb56ty {
    border: 1px solid #000;
}
.nb56ty input {
    width: 100%;
}
.vb45rt td {text-align: left; padding-left: 10px;}
</style>    