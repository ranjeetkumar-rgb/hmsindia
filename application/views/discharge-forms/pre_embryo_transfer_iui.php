<?php

$appoitmented_date = $_GET['appoitmented_date'];
    // php code to Insert data into mysql database from input text
    if(isset($_POST['submit'])){
        unset($_POST['submit']);
        
      	
			if (!empty($appoitmented_date)) {
			$sql = "SELECT * FROM `pre_embryo_transfer_iui` WHERE iic_id='$iic_id' AND appoitmented_date='$appoitmented_date'";
	} else {
			$sql = "SELECT * FROM `pre_embryo_transfer_iui` WHERE iic_id='$iic_id'";
	}
	$select_result = run_select_query($sql);
		
		
	 if(!empty($_POST['procedures']) && isset($_POST['procedures'])){
            //$_POST['physical_examination'] = serialize($_POST['physical_examination']);
			$_POST['procedures']=implode(',', $_POST['procedures']);
        }
        if(!empty($_POST['applicablemedicine']) && isset($_POST['applicablemedicine'])){
            // $_POST['applicablemedicine'] = serialize($_POST['applicablemedicine']);
			 $_POST['applicablemedicine']=implode(',', $_POST['applicablemedicine']);
			 
        }
		
        if(empty($select_result)){
            // mysql query to insert data
            $query = "INSERT INTO `pre_embryo_transfer_iui` SET ";
            $sqlArr = array();
         
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".addslashes($value)."'";
            }		
            $query .= implode(',' , $sqlArr);
        }else{
            // mysql query to update data
            $query = "UPDATE  pre_embryo_transfer_iui SET ";
          
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".$value."'"	;
            }
            $query .= implode(',' , $sqlArr);
            $query .= " WHERE iic_id='$iic_id' and appoitmented_date='$appoitmented_date'";
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
			$sql = "SELECT * FROM `pre_embryo_transfer_iui` WHERE iic_id='$iic_id' AND appoitmented_date='$appoitmented_date'";
	} else {
			$sql = "SELECT * FROM `pre_embryo_transfer_iui` WHERE iic_id='$iic_id'";
	}
	$select_result = run_select_query($sql);
	
	$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."'";
	$select_result1 = run_select_query($sql1);
	
	$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
	$select_result2 = run_select_query($sql2);
	
	$sql3 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
	$select_result3 = run_select_query($sql3);
?>

 <?php $procedures = $applicablemedicine = array();
    if(!empty($select_result['procedures'])){
        $procedures = explode(',',$select_result['procedures']);
    }
    if(!empty($select_result['applicablemedicine'])){
        $applicablemedicine = explode(',', $select_result['applicablemedicine']);
    }
  ?>

<div class="ga-pro">
<h3>Please strike out whichever is not applicable</h3>
<form action="" enctype='multipart/form-data' method="post">
<input type="hidden" value="<?php echo $iic_id; ?>" class="form" name="iic_id">
<input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">
<input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">
<input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">
<input type="hidden" name="appointment_id" value="<?php echo $select_result1['ID']; ?>" />
<input type="hidden" value="<?php echo $appoitmented_date; ?>" class="form" name="appoitmented_date">

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
<strong>Husband Name : <?php echo $patient_data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="2" width="57%">
<strong>Age: <?php echo $patient_data['wife_age']; ?> </strong>
</td>
<td width="42%">
<strong>Age: <?php echo $patient_data['husband_age']; ?> </strong>
</td>
</tr>

<tr>
<td width="50%">
<strong>Name of Procedure : <input type="checkbox" class="PRE-EMBRYO-TRANSFER" name="procedures[]" value="PRE-EMBRYO TRANSFER" <?php if(!empty($select_result['procedures']) && in_array('PRE-EMBRYO TRANSFER',$procedures)){echo "checked";}?>>PRE-EMBRYO TRANSFER </strong>

 

</td>
<td colspan="2" width="50%">
 <strong>Date of procedure:  <input type="date" class="Admission" name="date_of_procedure" value="<?php echo isset($select_result['date_of_procedure'])?$select_result['date_of_procedure']:""; ?>">  </strong>
 
</td>
</tr>

</tbody>
</table>
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
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabCrocin" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabCrocin',$applicablemedicine)){echo "checked";}?>>

</td>
<td width="117">
<p>Tab Crocin</p>
</td>
<td width="76">
<p>500 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong>Maximum three times at interval of 6 hrs (if Require )</strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS (if pain)</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Sypcremaffin"  <?php if(!empty($select_result['applicablemedicine']) && in_array('Sypcremaffin',$applicablemedicine)){echo "checked";}?>>

</td>
<td width="117">
<p>Sypcremaffin</p>
</td>
<td width="76">
<p>ONE TSF</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS</p>
</td>
<td width="68">
<p>After dinner</p>
</td>
<td width="71">
<p>SOS (if constipation)</p>
</td>
<td width="57"></td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="EndofertTab2MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('EndofertTab2MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Endofert Tab 2MG</p>
</td>
<td width="76">
<p>1TAB</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>	<input type="checkbox" name="applicablemedicine[]" value="gufitwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('gufitwice',$applicablemedicine)){echo "checked";}?>>
	Twice 
	<input type="checkbox" name="applicablemedicine[]" value="gufithrice" <?php if(!empty($select_result['applicablemedicine']) && in_array('gufithrice',$applicablemedicine)){echo "checked";}?>>
	thrice 
	<input type="checkbox" name="applicablemedicine[]" value="gufifour" <?php if(!empty($select_result['applicablemedicine']) && in_array('gufifour',$applicablemedicine)){echo "checked";}?>>
	four times daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabEcosprin75mg"  <?php if(!empty($select_result['applicablemedicine']) && in_array('TabEcosprin75mg',$applicablemedicine)){echo "checked";}?>>

</td>
<td width="117">
<p>Tab Ecosprin 75 mg</p>
</td>
<td width="76">
<p>1TAB</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p><input type="checkbox" name="applicablemedicine[]" value="eco75once" <?php if(!empty($select_result['applicablemedicine']) && in_array('eco75once',$applicablemedicine)){echo "checked";}?>>
	once
	<input type="checkbox" name="applicablemedicine[]" value="eco75twice" <?php if(!empty($select_result['applicablemedicine']) && in_array('eco75twice',$applicablemedicine)){echo "checked";}?>>
	twice</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>Tomorrow</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Aquagest25MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('Aquagest25MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Aquagest 25 MG</p>
</td>
<td width="76">
<p>25 mg</p>
</td>
<td width="76">
<p>intramuscular</p>
</td>
<td width="83">
<p><input type="checkbox" name="applicablemedicine[]" value="natOncedaily" <?php if(!empty($select_result['applicablemedicine']) && in_array('natOncedaily',$applicablemedicine)){echo "checked";}?>>
	Once daily
	<input type="checkbox" name="applicablemedicine[]" value="natalternate" <?php if(!empty($select_result['applicablemedicine']) && in_array('natalternate',$applicablemedicine)){echo "checked";}?>>
	alternate 
	<input type="checkbox" name="applicablemedicine[]" value="natbiweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('natbiweekly',$applicablemedicine)){echo "checked";}?>>
	biweekly 
	</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabWysolone5mg" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone5mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Tab Wysolone 5mg</p>
</td>
<td width="76">
<p>5mg for --- days followed by</p>
</td>
<td width="76">
<p>oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>Tomorrow</p>
</td>
<td width="57">
<p>----------</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabWysolone" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Tab Wysolone 10mg</p>
</td>
<td width="76">
<p>10mg for---days followed by</p>
</td>
<td width="76">
<p>oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>Tomorrow</p>
</td>
<td width="57">
<p>----------</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabWysolone15mg" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone15mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Tab Wysolone 15mg</p>
</td>
<td width="76">
<p>15mg for---days</p>
</td>
<td width="76">
<p>oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>Tomorrow</p>
</td>
<td width="57">
<p>----------</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Genprogel" <?php if(!empty($select_result['applicablemedicine']) && in_array('Genprogel',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Genpro gel</p>
</td>
<td width="76">
<p>8%</p>
</td>
<td width="76">
<p>Vaginal</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>Before going to sleep</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="INFAGEST10MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('INFAGEST10MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>INFAGEST 10MG</p>
</td>
<td width="76">
<p>1TAB</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Thrice daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BiophilL" <?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilL',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Biophil L</p>
</td>
<td width="76">
<p>1 CAP</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BiophilO" <?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilO',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Biophil O</p>
</td>
<td width="76">
<p>1 CAP</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BiophilQ3" <?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilQ3',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Biophil Q3</p>
</td>
<td width="76">
<p>1 CAP</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BIOLARG" <?php if(!empty($select_result['applicablemedicine']) && in_array('BIOLARG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>BIOLARG</p>
</td>
<td width="76">
<p>1 SACHET</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BIOPHILVITA" <?php if(!empty($select_result['applicablemedicine']) && in_array('BIOPHILVITA',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>BIOPHIL VITA</p>
</td>
<td width="76">
<p>1 cap</p>
</td>
<td width="76">
<p>oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="IPARIN40MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('IPARIN40MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>INJ IPARIN 40 MG</p>
</td>
<td width="76">
<p>40 mg</p>
</td>
<td width="76">
<p>subcutaneous</p>
</td>
<td width="83">
<p><input type="checkbox" name="applicablemedicine[]" value="oxyOncedaily" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxyOncedaily',$applicablemedicine)){echo "checked";}?>>
	Once daily
	<input type="checkbox" name="applicablemedicine[]" value="oxyalternate" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxyalternate',$applicablemedicine)){echo "checked";}?>>
	alternate
	<input type="checkbox" name="applicablemedicine[]" value="oxybiweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxybiweekly',$applicablemedicine)){echo "checked";}?>>
	biweekly
	<input type="checkbox" name="applicablemedicine[]" value="oxyweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxyweekly',$applicablemedicine)){echo "checked";}?>>
	weekly
	</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>16 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Injcoriosurge10000" <?php if(!empty($select_result['applicablemedicine']) && in_array('Injcoriosurge10000',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Inj coriosurge 10000</p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>subcutaneous</p>
</td>
<td width="83">
<p><input type="checkbox" name="applicablemedicine[]" value="corOncedaily" <?php if(!empty($select_result['applicablemedicine']) && in_array('corOncedaily',$applicablemedicine)){echo "checked";}?>>
	Once daily
	<input type="checkbox" name="applicablemedicine[]" value="coralternate" <?php if(!empty($select_result['applicablemedicine']) && in_array('coralternate',$applicablemedicine)){echo "checked";}?>>
	alternate
	<input type="checkbox" name="applicablemedicine[]" value="corbiweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('corbiweekly',$applicablemedicine)){echo "checked";}?>>
	biweekly
	<input type="checkbox" name="applicablemedicine[]" value="corweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('corweekly',$applicablemedicine)){echo "checked";}?>>
	weekly
	</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabAllegra" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabAllegra',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Tab Allegra</p>
</td>
<td width="76">
<p>1 TAB</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>16 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabMontairLC" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabMontairLC',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Tab Montair LC</p>
</td>
<td width="76">
<p>1TAB</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>16 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabShelcal500mg" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabShelcal500mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Tab Shelcal 500 mg</p>
</td>
<td width="76">
<p>1TAB</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>Once daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>16 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="INFAGESTRONSR200" <?php if(!empty($select_result['applicablemedicine']) && in_array('INFAGESTRONSR200',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>INFAGESTRON SR 200</p>
</td>
<td width="76">
<p>400mg</p>  
</td>
<td width="76">
<p>Oral/vaginally</p>
</td>
<td width="83">
<p>	<input type="checkbox" name="applicablemedicine[]" value="genonce" <?php if(!empty($select_result['applicablemedicine']) && in_array('genonce',$applicablemedicine)){echo "checked";}?>>
	Once
	<input type="checkbox" name="applicablemedicine[]" value="gentwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('gentwice',$applicablemedicine)){echo "checked";}?>>
	twice
	<input type="checkbox" name="applicablemedicine[]" value="genthrice" <?php if(!empty($select_result['applicablemedicine']) && in_array('genthrice',$applicablemedicine)){echo "checked";}?>>
	four times daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Estogel" <?php if(!empty($select_result['applicablemedicine']) && in_array('Estogel',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Estogel</p>
</td>
<td width="76">
<p>2.5 gm</p>  
</td>
<td width="76">
<p>Locally</p>
</td>
<td width="83">
<p>
	<input type="checkbox" name="applicablemedicine[]" value="estoonce" <?php if(!empty($select_result['applicablemedicine']) && in_array('estoonce',$applicablemedicine)){echo "checked";}?>>
	Once
	<input type="checkbox" name="applicablemedicine[]" value="estotwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('estotwice',$applicablemedicine)){echo "checked";}?>>
	twice 
	<input type="checkbox" name="applicablemedicine[]" value="estothrice" <?php if(!empty($select_result['applicablemedicine']) && in_array('estothrice',$applicablemedicine)){echo "checked";}?>>
	thrice 
	<input type="checkbox" name="applicablemedicine[]" value="estofour" <?php if(!empty($select_result['applicablemedicine']) && in_array('estofour',$applicablemedicine)){echo "checked";}?>>
	four  times to be applied locally daily</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Lenzettospray" <?php if(!empty($select_result['applicablemedicine']) && in_array('Lenzettospray',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Lenzetto Spray</p>
</td>
<td width="76">
<p>1 spray</p>    
</td>
<td width="76">
<p>Locally</p>
</td>
<td width="83">
<p>
	<input type="checkbox" name="applicablemedicine[]" value="lenonce" <?php if(!empty($select_result['applicablemedicine']) && in_array('lenonce',$applicablemedicine)){echo "checked";}?>>
	Once
	<input type="checkbox" name="applicablemedicine[]" value="lentwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('lentwice',$applicablemedicine)){echo "checked";}?>>
	twice 
	times to be applied</p>
</td>
<td width="68">
<p></p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>6 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="CapCalcitasD3" <?php if(!empty($select_result['applicablemedicine']) && in_array('CapCalcitasD3',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>Cap Calcitas D3</p>
</td>
<td width="76">
<p>60000IU</p>
</td>
<td width="76">
<p>oral</p>
</td>
<td width="83">
<p>weekly</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>immediately</p>
</td>
<td width="57">
<p>16 Days</p>
</td>
</tr>
<tr>
<td>
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="CEROXITUM500" <?php if(!empty($select_result['applicablemedicine']) && in_array('CEROXITUM500',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="117">
<p>CEROXITUM 500</p>
</td>
<td width="76">
<p>500MG</p>
</td>
<td width="76">
<p>Tab</p>
</td>
<td width="83">
<p>weekly</p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p></p>
</td>
<td width="57">
<p>1 Days</p>
</td>
</tr>
<?php
$medicine = 'Tab Ceftum (500 mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>500 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS </p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Estrabet (2mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>2 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Cap.Pantoprazole (40 mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>10 MG</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS </p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Estrade (2mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS )</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Syp cremaffin';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>40 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'ET gel 8%';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Luprorin4MGInj';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>7500 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Syp cremaffin';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>10 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj sugest';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>10 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Crinone gel8%';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>10 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Gest10';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>400 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj Puberjen JO 7500';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>400 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Cap Fericip XT';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p>400 mg</p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj clexane';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Injclexane';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Cap Vit D3 (60000 IU)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'EurolideInj';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'GenproSR';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj coriosurge 10000';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'GenproD';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Medrol (8mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Duphaston (10 mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="" value="<?= $medicine ?>" checked> 
</td>
<td width="117">
<p><?= $medicine ?></p>
</td>
<td width="76">
<p></p>
</td>
<td width="76">
<p>Oral</p>
</td>
<td width="83">
<p>SOS
<strong></strong></p>
</td>
<td width="68">
<p>After meals</p>
</td>
<td width="71">
<p>SOS</p>
</td>
<td width="57">
<p></p>
</td>
</tr>
<?php } ?>
<tr>
<td width="12.5%">
<p>There are No Substitutes</p>
</td>
</tr>
</tbody>
</table>
<div class="nb56ty">
  <label for="other">Other Medication1:</label>
  <input type="text" class="other1" name="Other_Medication1" value="<?php echo isset($select_result['Other_Medication1'])?$select_result['Other_Medication1']:""; ?>"><br> 
    <label for="other">Other Medication2:</label>
  <input type="text" class="other2" name="Other_Medication2" value="<?php echo isset($select_result['Other_Medication2'])?$select_result['Other_Medication2']:""; ?>"><br> 
    <label for="other">Other Medication3:</label>
  <input type="text" class="other3" name="Other_Medication3" value="<?php echo isset($select_result['Other_Medication3'])?$select_result['Other_Medication3']:""; ?>"><br>
</div>
<div class="sec2">
  
<label for="other">Please take prescribed medicines / injections only. Dont skip/ stop any medicine on your own unless advised by the doctor.</label>
    
</div> 
   
<input type="submit" name="submit" value="submit">
</form>
</div>

<div class="row" id="print_this_section" style="display:none;">
<div class="ga-pro">
<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="2"><img src="https://indiaivf.website/assets/images/india-ivf-logo.webp"></td>
   <td style="width:50%;padding:5px;" colspan="2"><h3 style="margin-top:20px;">Please strike out whichever is not applicable</h3></td>
   </tr>
</table>
<form action="" enctype='multipart/form-data' method="post">
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
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Name : <?php echo $patient_data['wife_name']; ?> </strong>
</td>
<td width="50%" style="border:1px solid;padding:5px;">
<strong>Husband Name : <?php echo $patient_data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Age: <?php echo $patient_data['wife_age']; ?> </strong>
</td>
<td width="50%" style="border:1px solid;padding:5px;">
<strong>Age: <?php echo $patient_data['husband_age']; ?> </strong>
</td>
</tr>

<tr>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Name of Procedure : <input type="checkbox" class="PRE-EMBRYO-TRANSFER" name="procedures[]" value="PRE-EMBRYO TRANSFER" <?php if(!empty($select_result['procedures']) && in_array('PRE-EMBRYO TRANSFER',$procedures)){echo "checked";}?>>PRE-EMBRYO TRANSFER </strong>
</td>
<td  width="50%" style="border:1px solid;padding:5px;">
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
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabCrocin',$applicablemedicine)){ ?>
<tr>
<td width="100" colspan="1" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabCrocin" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabCrocin',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Crocin</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>500 mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>SOS
<strong>Maximum three times at interval of 6 hrs (if Require )</strong></p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>SOS (if pain)</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('Sypcremaffin',$applicablemedicine)){ ?>
<tr>
<td width="100" colspan="1" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Sypcremaffin"  <?php if(!empty($select_result['applicablemedicine']) && in_array('Sypcremaffin',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Sypcremaffin</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>ONE TSF</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After dinner</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>SOS (if constipation)</p>
</td>
<td width="100" style="border:1px solid;padding:5px;"></td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('EndofertTab2MG',$applicablemedicine)){ ?>
<tr>
<td  width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="EndofertTab2MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('EndofertTab2MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Endofert Tab 2MG</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1TAB</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>	<input type="checkbox" name="applicablemedicine[]" value="gufitwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('gufitwice',$applicablemedicine)){echo "checked";}?>>
	Twice 
	<input type="checkbox" name="applicablemedicine[]" value="gufithrice" <?php if(!empty($select_result['applicablemedicine']) && in_array('gufithrice',$applicablemedicine)){echo "checked";}?>>
	thrice 
	<input type="checkbox" name="applicablemedicine[]" value="gufifour" <?php if(!empty($select_result['applicablemedicine']) && in_array('gufifour',$applicablemedicine)){echo "checked";}?>>
	four times daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabEcosprin75mg',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabEcosprin75mg"  <?php if(!empty($select_result['applicablemedicine']) && in_array('TabEcosprin75mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Ecosprin 75 mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1TAB</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p><input type="checkbox" name="applicablemedicine[]" value="eco75once" <?php if(!empty($select_result['applicablemedicine']) && in_array('eco75once',$applicablemedicine)){echo "checked";}?>>
	once
	<input type="checkbox" name="applicablemedicine[]" value="eco75twice" <?php if(!empty($select_result['applicablemedicine']) && in_array('eco75twice',$applicablemedicine)){echo "checked";}?>>
	twice</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tomorrow</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('Aquagest25MG',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Aquagest25MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('Aquagest25MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Aquagest 25 MG</p>
</td>
<td width="76">
<p>100 mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>intramuscular</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p><input type="checkbox" name="applicablemedicine[]" value="natOncedaily" <?php if(!empty($select_result['applicablemedicine']) && in_array('natOncedaily',$applicablemedicine)){echo "checked";}?>>
	Once daily
	<input type="checkbox" name="applicablemedicine[]" value="natalternate" <?php if(!empty($select_result['applicablemedicine']) && in_array('natalternate',$applicablemedicine)){echo "checked";}?>>
	alternate 
	<input type="checkbox" name="applicablemedicine[]" value="natbiweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('natbiweekly',$applicablemedicine)){echo "checked";}?>>
	biweekly 
	</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone5mg',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabWysolone5mg" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone5mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Wysolone 5mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>5mg for --- days followed by</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tomorrow</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>----------</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabWysolone" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Wysolone 10mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>10mg for---days followed by</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tomorrow</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>----------</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone15mg',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabWysolone15mg" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabWysolone15mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Wysolone 15mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>15mg for---days</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tomorrow</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>----------</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('Genprogel',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Genprogel" <?php if(!empty($select_result['applicablemedicine']) && in_array('Genprogel',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Genpro gel</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>8%</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Vaginal</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Before going to sleep</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('INFAGEST10MG',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="INFAGEST10MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('INFAGEST10MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>INFAGEST 10MG</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1TAB</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Thrice daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilL',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BiophilL" <?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilL',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Biophil L</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 CAP</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilO',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BiophilO" <?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilO',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Biophil O</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 CAP</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilQ3',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BiophilQ3" <?php if(!empty($select_result['applicablemedicine']) && in_array('BiophilQ3',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Biophil Q3</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 CAP</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('BIOLARG',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BIOLARG" <?php if(!empty($select_result['applicablemedicine']) && in_array('BIOLARG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>BIOLARG</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 SACHET</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('BIOPHILVITA',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="BIOPHILVITA" <?php if(!empty($select_result['applicablemedicine']) && in_array('BIOPHILVITA',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>BIOPHIL VITA</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 cap</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('IPARIN40MG',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="IPARIN40MG" <?php if(!empty($select_result['applicablemedicine']) && in_array('IPARIN40MG',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>INJ IPARIN 40 MG</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>40 mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>subcutaneous</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p><input type="checkbox" name="applicablemedicine[]" value="oxyOncedaily" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxyOncedaily',$applicablemedicine)){echo "checked";}?>>
	Once daily
	<input type="checkbox" name="applicablemedicine[]" value="oxyalternate" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxyalternate',$applicablemedicine)){echo "checked";}?>>
	alternate
	<input type="checkbox" name="applicablemedicine[]" value="oxybiweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxybiweekly',$applicablemedicine)){echo "checked";}?>>
	biweekly
    <input type="checkbox" name="applicablemedicine[]" value="oxyweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('oxyweekly',$applicablemedicine)){echo "checked";}?>>
	weekly
	</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('Injcoriosurge10000',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Injcoriosurge10000" <?php if(!empty($select_result['applicablemedicine']) && in_array('Injcoriosurge10000',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Inj coriosurge 10000</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>subcutaneous</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p><input type="checkbox" name="applicablemedicine[]" value="corOncedaily" <?php if(!empty($select_result['applicablemedicine']) && in_array('corOncedaily',$applicablemedicine)){echo "checked";}?>>
	Once daily
	<input type="checkbox" name="applicablemedicine[]" value="coralternate" <?php if(!empty($select_result['applicablemedicine']) && in_array('coralternate',$applicablemedicine)){echo "checked";}?>>
	alternate
	<input type="checkbox" name="applicablemedicine[]" value="corbiweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('corbiweekly',$applicablemedicine)){echo "checked";}?>>
	biweekly
	<input type="checkbox" name="applicablemedicine[]" value="corweekly" <?php if(!empty($select_result['applicablemedicine']) && in_array('corweekly',$applicablemedicine)){echo "checked";}?>>
	weekly
	</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabAllegra',$applicablemedicine)){  ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabAllegra" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabAllegra',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Allegra</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 TAB</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>16 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabMontairLC',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabMontairLC" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabMontairLC',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Montair LC</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1TAB</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>16 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('TabShelcal500mg',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="TabShelcal500mg" <?php if(!empty($select_result['applicablemedicine']) && in_array('TabShelcal500mg',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab Shelcal 500 mg</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1TAB</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Once daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>16 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('INFAGESTRONSR200',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="INFAGESTRONSR200" <?php if(!empty($select_result['applicablemedicine']) && in_array('INFAGESTRONSR200',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>INFAGESTRON SR 200</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>200mg</p>  
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Oral/vaginally</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>	<input type="checkbox" name="applicablemedicine[]" value="genonce" <?php if(!empty($select_result['applicablemedicine']) && in_array('genonce',$applicablemedicine)){echo "checked";}?>>
	Once
	<input type="checkbox" name="applicablemedicine[]" value="gentwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('gentwice',$applicablemedicine)){echo "checked";}?>>
	twice
	<input type="checkbox" name="applicablemedicine[]" value="genthrice" <?php if(!empty($select_result['applicablemedicine']) && in_array('genthrice',$applicablemedicine)){echo "checked";}?>>
	four times daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr><?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('Estogel',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Estogel" <?php if(!empty($select_result['applicablemedicine']) && in_array('Estogel',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Estogel</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>2.5 gm</p>  
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Locally</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>
	<input type="checkbox" name="applicablemedicine[]" value="estoonce" <?php if(!empty($select_result['applicablemedicine']) && in_array('estoonce',$applicablemedicine)){echo "checked";}?>>
	Once
	<input type="checkbox" name="applicablemedicine[]" value="estotwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('estotwice',$applicablemedicine)){echo "checked";}?>>
	twice 
	<input type="checkbox" name="applicablemedicine[]" value="estothrice" <?php if(!empty($select_result['applicablemedicine']) && in_array('estothrice',$applicablemedicine)){echo "checked";}?>>
	thrice 
	<input type="checkbox" name="applicablemedicine[]" value="estofour" <?php if(!empty($select_result['applicablemedicine']) && in_array('estofour',$applicablemedicine)){echo "checked";}?>>
	four  times to be applied locally daily</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('Lenzettospray',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="Lenzettospray" <?php if(!empty($select_result['applicablemedicine']) && in_array('Lenzettospray',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Lenzetto Spray</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 spray</p>    
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Locally</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>
	<input type="checkbox" name="applicablemedicine[]" value="lenonce" <?php if(!empty($select_result['applicablemedicine']) && in_array('lenonce',$applicablemedicine)){echo "checked";}?>>
	Once
	<input type="checkbox" name="applicablemedicine[]" value="lentwice" <?php if(!empty($select_result['applicablemedicine']) && in_array('lentwice',$applicablemedicine)){echo "checked";}?>>
	twice 
	times to be applied</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>6 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('CapCalcitasD3',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="CapCalcitasD3" <?php if(!empty($select_result['applicablemedicine']) && in_array('CapCalcitasD3',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Cap Calcitas D3</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>60000IU</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>oral</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>weekly</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>immediately</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>16 Days</p>
</td>
</tr>
<?php } ?>
<?php if(!empty($select_result['applicablemedicine']) && in_array('CEROXITUM500',$applicablemedicine)){ ?>
<tr>
<td width="100" style="border:1px solid;padding:5px;">
 <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="CEROXITUM500" <?php if(!empty($select_result['applicablemedicine']) && in_array('CEROXITUM500',$applicablemedicine)){echo "checked";}?>>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>CEROXITUM 500</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>500MG</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>Tab</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>weekly</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="100" style="border:1px solid;padding:5px;">
<p>1 Days</p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Ceftum (500 mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td>
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>500 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS </p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Estrabet (2mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>2 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Cap.Pantoprazole (40 mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>10 MG</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS </p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Estrade (2mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76"style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76"style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS )</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Syp cremaffin';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<tdstyle="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>40 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68"style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'ET gel 8%';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68 " style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Luprorin4MGInj';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>7500 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Syp cremaffin';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>10 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj sugest';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>10 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Crinone gel8%';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>10 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Gest10';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>400 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj Puberjen JO 7500';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>400 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Cap Fericip XT';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>400 mg</p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj clexane';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Injclexane';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Cap Vit D3 (60000 IU)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'EurolideInj';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'GenproSR';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Inj coriosurge 10000';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'GenproD';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td> 
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Medrol (8mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td> 
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68"style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57"style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<?php
$medicine = 'Tab Duphaston (10 mg)';
if (!empty($select_result['applicablemedicine']) && in_array($medicine, $applicablemedicine)) {
?>
<tr>
<td style="border:1px solid;padding:5px;">
    <input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $medicine ?>" checked> 
</td>
<td width="117" style="border:1px solid;padding:5px;">
<p><?= $medicine ?></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p></p>
</td>
<td width="76" style="border:1px solid;padding:5px;">
<p>Oral</p>
</td>
<td width="83" style="border:1px solid;padding:5px;">
<p>SOS
<strong></strong></p>
</td>
<td width="68" style="border:1px solid;padding:5px;">
<p>After meals</p>
</td>
<td width="71" style="border:1px solid;padding:5px;">
<p>SOS</p>
</td>
<td width="57" style="border:1px solid;padding:5px;">
<p></p>
</td>
</tr>
<?php } ?>
<tr><td width="100%"></td></tr>
<tr>
<td width="100%" colspan="8" style="border:1px solid;padding:5px;">
<p>There are No Substitutes</p>
</td>
</tr>

<tr>
<td width="100%" colspan="8" style="border:1px solid;padding:5px;">
<p>Other Medication1: <?php echo isset($select_result['Other_Medication1'])?$select_result['Other_Medication1']:""; ?></p>
</td>
</tr>

<tr>
<td width="100%" colspan="8" style="border:1px solid;padding:5px;">
<p>Other Medication2: <?php echo isset($select_result['Other_Medication2'])?$select_result['Other_Medication2']:""; ?></p>
</td>
</tr>

<tr>
<td width="100%" colspan="8" style="border:1px solid;padding:5px;">
<p>Other Medication3: <?php echo isset($select_result['Other_Medication3'])?$select_result['Other_Medication3']:""; ?></p>
</td>
</tr>

<tr>
<td width="100%" colspan="8" style="border:1px solid;padding:5px;">
<label for="other">Please take prescribed medicines / injections only. Dont skip/ stop any medicine on your own unless advised by the doctor.</label>
  </td>
</tr>
</tbody>
</table>
</form>
</div>
</div>
<style>
input[type=checkbox], input[type=radio] {
    opacity: 1 !important;
    left: 0 !important;
    position: unset !important;
    margin: 9px !important;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
.vb45rt td {text-align: left; padding-left: 10px;}
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
    margin-bottom: 0px;
}
.nb56ty {
    border: 1px solid #000;
}
.nb56ty input {
    width: 100%;
}
</style>    