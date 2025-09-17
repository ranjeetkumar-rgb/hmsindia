<?php $all_method =&get_instance();
      $patient_data = get_patient_detail($data['patient_id']);
	  
	 // php code to Insert data into mysql database from input text
    if(isset($_POST['submit'])){
        unset($_POST['submit']);
             
        if(!empty($_POST['Conscious']) && isset($_POST['Conscious'])){
            $_POST['Conscious'] = implode(',', $_POST['Conscious']);
        }
        if(!empty($_POST['applicablemedicine']) && isset($_POST['applicablemedicine'])){
             $_POST['applicablemedicine'] = implode(',', $_POST['applicablemedicine']);
        }
		if(!empty($_POST['physical_examination']) && isset($_POST['physical_examination'])){
            $_POST['physical_examination'] = implode(',', $_POST['physical_examination']);
        }
		
		$sql = "SELECT * FROM `hms_withdrawl_prescription` WHERE iic_id='".$data['patient_id']."'";
        $select_result = run_select_query($sql); 
        if(empty($select_result)){
            // mysql query to insert data
            $query = "INSERT INTO `hms_withdrawl_prescription` SET ";
            $sqlArr = array();
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".addslashes($value)."'";
            }		
            $query .= implode(',' , $sqlArr);
		}else{
            // mysql query to update data
            $query = "UPDATE  hms_withdrawl_prescription SET ";
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".$value."'"	;
            }
            $query .= implode(',' , $sqlArr);
            $query .= " WHERE iic_id='".$data['patient_id']."'";
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

	$sql1 = "Select * from ".$this->config->item('db_prefix')."patients where patient_id='".$data['patient_id']."'";
	$select_result1 = run_select_query($sql1);
	
	$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
	$select_result2 = run_select_query($sql2);
	
	$sql3 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
	$select_result3 = run_select_query($sql3);
	
	$sql4 = "Select * from ".$this->config->item('db_prefix')."patient_medical_info where patient_id='".$data['patient_id']."'";
	$select_result4 = run_select_query($sql4);
?>
<div class="col-md-12">
<div class="card">
 <div class="card-content">
	<p id="whatsappmessg"></p>
    <input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>	
    <input type='button' id='btn' value='Send to Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $whtname; ?>");'>

<div class="ga-pro">
<h3>Withdrawl Prescription</h3>
    	
  <form action="" enctype='multipart/form-data' method="post">
  <input type="hidden" value="<?php echo $data['patient_id'];?>" class="form" name="iic_id">
  <?php $physical = array();
    if(!empty($select_result['physical_examination'])){
        $physical = explode(',',$select_result['physical_examination']);
    }
	
    if(!empty($select_result['applicablemedicine'])){
        $applicablemedicine = explode(',',$select_result['applicablemedicine']);
    }
  ?>
  
<input type="hidden" value="<?php echo $_SESSION['logged_doctor']['doctor_id'] ?>" class="form" name="doctor_id">
<table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></strong>
</td>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $data['patient_id']; ?></strong>
</td>
</tr>
<tr style="background: #b3b9b7;">
    <td colspan="3" width="50%" style="border:1px solid;padding:5px;">
	<strong>Details of Female Partner</strong>
	</td>
	<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
	<strong>Details of Male Partner</strong>
	</td>
  </tr>
<tr>
<td colspan="3" width="50%">
<strong>Name : <?php echo $patient_data['wife_name']; ?> </strong>
</td>
<td width="50%" colspan="3">
<strong>Name : <?php echo $patient_data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="3" width="50%">
<strong>Age: <?php echo $patient_data['wife_age']; ?></strong>
</td>
<td width="50%" colspan="3">
<strong>Age: <?php echo $patient_data['husband_age']; ?> </strong>
</td>
</tr>

<tr>
<td colspan="6" width="100%">
<strong>Provisional Diagnosis:

 <textarea name="female_issues" style="width:100%; height:150px;" > <?php echo isset($select_result4['details_management_advised'])?$select_result4['details_management_advised']:""; ?> </textarea>
</strong>
</td>
</tr>

<tr>
<td width="50%" colspan="3">
<strong>Name of Procedure : IVF cycle initiation prescription</strong>
</td>
<td colspan="3" width="50%">
<strong>Date of procedure:  <input type="date" class="Admission" name="date_of_procedure" value="<?php echo isset($select_result['date_of_procedure'])?$select_result['date_of_procedure']:""; ?>">  </strong>
</td>
</tr>
</tbody>
</table> 

<div class="sec3">
<h4>Advice Female partner </h4>   
<table width="585">
<tbody>
<tr>
<td width="38">
<p>Check</p>
</td>
<td width="117">
<p>Medication</p>
</td>
<td width="76">
<p>Dosage</p>
</td>
<td width="76">
<p>Route</p>
</td>
<td width="83">
<p>Times</p>
</td>
<td width="68">
<p>Timings</p>
</td>
<td width="71">
<p>When to start</p>
</td>
<td width="57">
<p>How many days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="EndofertTab2MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('EndofertTab2MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Endofert Tab 2MG</p>
</td>
<td width="76">
<p>One tablet</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83"><p>Twice daily</p></td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>7 days </p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Tabmeprate10mg " <?php if(!empty($select_result['applicablemedicine']) && in_array('Tabmeprate10mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Tab meprate 10 mg</p>
</td>
<td width="76">
<p>One tablet</p>
</td>
<td width="76">
<p>oral</p>
</td>
<td width="83">
<p>Twice daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>7 days </p>
</td>
</tr>
<tr>
<td width="12.5%">
<p>There are No Substitutes</p>
</td>
</tr>
</tbody>
</table>
</div>
<div class="sec2">
<ul>
<li>You must stop this medicine after 7 days of intake </li>
<li>Within 10 days of stopping these medications if you don’t get periods inform us</li>
<li>Please visit the clinic between day 2 to day 4 of periods </li>
</ul>
</div>

<div class="sec2">
<ul>
<li>आपको यह दवाई 7 दिनों तक लेनी है, इसके बाद इसे बंद कर देना है।</li>
<li>अगर दवाई बंद करने के 10 दिनों के अंदर पीरियड नहीं आता है, तो हमें तुरंत बताएं।</li>
<li>पीरियड के दूसरे दिन से चौथे दिन के बीच क्लिनिक जरूर आएं।</li>
</ul>
</div>
<input type="submit" name="submit" value="submit">
</form>
</div>


<div class="row" id="print_this_section" style="display:none;">
<div class="ga-pro">
<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="2"><img src="https://infra.indiaivf.website/assets/images/india-ivf-logo.webp"></td>
   <td style="width:50%;padding:5px;" colspan="2"><h3 style="margin-top:20px;">Withdrawl Prescription</h3></td>
   </tr>
</table>
<table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></strong>
</td>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $data['patient_id']; ?></strong>
</td>
</tr>
<tr style="background: #b3b9b7;">
    <td colspan="3" width="50%" style="border:1px solid;padding:5px;">
	<strong>Details of Female Partner</strong>
	</td>
	<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
	<strong>Details of Male Partner</strong>
	</td>
  </tr>

<tr>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>Name : <?php echo $patient_data['wife_name']; ?> </strong>
</td>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>Name : <?php echo $patient_data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>Age: <?php echo $patient_data['wife_age']; ?></strong>
</td>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>Age: <?php echo $patient_data['husband_age']; ?> </strong>
</td>
</tr>

<tr>
<td colspan="3" colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Provisional Diagnosis:</strong>

<p><?php echo isset($select_result['female_issues'])?$select_result['female_issues']:""; ?></p>

</td>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>Final Diagnosis: </strong>

 <p><?php echo isset($select_result['male_issues'])?$select_result['male_issues']:""; ?></p>


</td>
</tr>

<tr>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>Name of Procedure :  IVF cycle initiation prescription</strong>
</td>
<td colspan="3" width="50%" style="border:1px solid;padding:5px;">
<strong>Date of procedure:  <?php echo isset($select_result['date_of_procedure'])?$select_result['date_of_procedure']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
  
<table width="100%">
<tbody>
<tr>
<td colspan="8" style="border:1px solid;padding:5px;" ><h4>ADVICE ON DISCHARGE</h4> </td>
</tr>
<tr>
<td width="100" colspan="1" style="border:1px solid;padding:5px;">
<p>Check</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Medication</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Dosage</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Route</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Times</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Timings</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>When to start</p>
</td>
<td width="100" colspan="1" style="border:1px solid;padding:5px;">
<p>How many days</p>
</td>
</tr>
<?php //if(!empty($select_result['applicablemedicine']) && in_array('EndofertTab2MG',$applicablemedicine)){ ?>
<tr>
<td  width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="EndofertTab2MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('EndofertTab2MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Endofert Tab 2MG</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>One tablet</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Twice daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>7 days</p>
</td>
</tr>
<?php //} ?>
<?php //if(!empty($select_result['applicablemedicine']) && in_array('Tabmeprate10mg',$applicablemedicine)){ ?>
<tr>
<td  width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Tabmeprate10mg" <?php if(!empty($select_result['applicablemedicine']) && in_array('Tabmeprate10mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab meprate 10 mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>One tablet</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Twice daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>7 days</p>
</td>
</tr>
<?php //} ?>

<tr>
<td width="100%" colspan="8" style="border:1px solid;padding:5px;">
<div class="sec2">
<ul>
<li>You must stop this medicine after 7 days of intake </li>
<li>Within 10 days of stopping these medications if you don’t get periods inform us</li>
<li>Please visit the clinic between day 2 to day 4 of periods </li>
</ul>
</div>

<div class="sec2">
<ul>
<li>आपको यह दवाई 7 दिनों तक लेनी है, इसके बाद इसे बंद कर देना है।</li>
<li>अगर दवाई बंद करने के 10 दिनों के अंदर पीरियड नहीं आता है, तो हमें तुरंत बताएं।</li>
<li>पीरियड के दूसरे दिन से चौथे दिन के बीच क्लिनिक जरूर आएं।</li>
</ul>
</div>
</td>
</tr>




</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<style type="text/css">
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
		border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
	.heading{margin-bottom:10px;margin-top: 0; padding-top:0px;}
	select {
    display: block !important;
}
[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: static!important;
    left: -9999pximportant;
    opacity: 1!important;
}
</style>
<script>
function printDiv() 
{
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
//   setTimeout(function(){newWin.close();},10);
//   window.location.reload();
}
</script>