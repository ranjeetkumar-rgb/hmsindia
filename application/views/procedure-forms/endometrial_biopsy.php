<?php
	
	if(isset($_POST['submit'])){
        unset($_POST['submit']);
               
        $select_query = "SELECT * FROM `endometrial_biopsy` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
        $select_result = run_select_query($select_query); 
        if(empty($select_result)){
            // mysql query to insert data
            $query = "INSERT INTO `endometrial_biopsy` SET ";
            $sqlArr = array();
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".addslashes($value)."'";
            }		
            $query .= implode(',' , $sqlArr);
        }else{
            // mysql query to update data
            $query = "UPDATE endometrial_biopsy SET ";
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".$value."'"	;
            }
            $query .= implode(',' , $sqlArr);
            $query .= " WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
        }
        $result = run_form_query($query);        

       if($result){
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Procedure form inserted!').'&t='.base64_encode('success'));
					die();
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
					die();
        }
    }
    $select_query = "SELECT * FROM `endometrial_biopsy` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
    $select_result = run_select_query($select_query); 

	$sql3 = "SELECT * FROM `hms_patients` WHERE patient_id='$patient_id'";
    $select_result3 = run_select_query($sql3); 	
	
	$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$patient_id."'";
	$select_result1 = run_select_query($sql1);
	
	$sql4 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
	$select_result4 = run_select_query($sql4);
	
	$sql5 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result4['appoitment_for']."'";
	$select_result5 = run_select_query($sql5);
?>
<form enctype='multipart/form-data'  class ="searchform" name="form" action="" method="POST">
<input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">
<input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">
<input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">

    <input type="hidden" value="<?php echo $procedure_id; ?>" class="form" name="procedure_id">
  <input type="hidden" value="<?php echo $patient_id; ?>" class="form" name="patient_id">
  <input type="hidden" value="<?php echo $receipt_number; ?>" class="form" name="receipt_number">
  <input type="hidden" value="pending" name="status">
<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="10"><img src="<?php echo base_url(); ?>/assets/images/India-IVF-Logo-Option-5.png" style="width:220px"></td>
   <td style="width:50%;padding:5px;" colspan="10"><h3 style="margin-top:20px;">ENDOMETRIAL BIOPSY</h3></td>
   </tr>
</table>
     				  <table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">

<td colspan="2" width="33%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result5['center_code']."/".$select_result4['uhid']; ?></strong>
</td>
<td colspan="2" width="33%" style="border:1px solid;padding:5px;">
<strong>Patient Name : <?php echo $select_result3['wife_name']; ?> </strong>
</td>
<td colspan="2" width="33%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $patient_id; ?></strong>
</td>
</tr>
	   </table>	
<table class="table-bordered" style="color: red;">
	<tr>
		<td colspan="2">
		    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&
		            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 
		            isset($select_result['updated_type']) && !empty($select_result['updated_type'])
		            ){?>
		        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>
		    <?php } ?>
		</td>
		<td>
			Date<br>
			<input  type="date" value="<?php echo isset($select_result['date'])?$select_result['date']:""; ?>"   name="date" class="form-control" >
		</td>
		<td>
			Time<br>
			<input  type="time" value="<?php echo isset($select_result['time'])?$select_result['time']:""; ?>"   name="time" class="form-control" >
		</td>
		<td>
			Indication<br>
			<input  type="text" value="<?php echo isset($select_result['indication'])?$select_result['indication']:""; ?>"   maxlength="50" name="indication" class="form-control" >
		</td>
		<td>
			ALLERGIES<br>
			<input  type="text" value="<?php echo isset($select_result['allergies'])?$select_result['allergies']:""; ?>"   maxlength="50" name="allergies" class="form-control" >
		</td>
		<td>
			Consent<br>
			<input type="radio"  name="consent"   value="Yes"  <?php if(isset($select_result['consent']) && $select_result['consent'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
			<input type="radio"  name="consent"   value="No"  <?php if(isset($select_result['consent']) && $select_result['consent'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['consent']) && $select_result['consent'] != "Yes"){echo 'checked="checked"';}?>  > No
		</td>
		<td>
			ID <br>
			<input type="radio"  name="id_checked"   value="Yes"  <?php if(isset($select_result['id_checked']) && $select_result['id_checked'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
			<input type="radio"  name="id_checked"   value="No"  <?php if(isset($select_result['id_checked']) && $select_result['id_checked'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['id_checked']) && $select_result['id_checked'] != "Yes"){echo 'checked="checked"';}?>  > No
		</td>
	</tr>
	<tr>
		<td>PRE ASSESSMENT</td>
		<td>
			BP<br>
			<input  type="text" value="<?php echo isset($select_result['bp'])?$select_result['bp']:""; ?>"   maxlength="20" name="bp" class="form-control" >
		</td>
		<td>
			PULSE<br>
			<input type="radio"  name="pulse"   value="Yes"  <?php if(isset($select_result['pulse']) && $select_result['pulse'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
			<input type="radio"  name="pulse"   value="No"  <?php if(isset($select_result['pulse']) && $select_result['pulse'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['pulse']) && $select_result['pulse'] != "Yes"){echo 'checked="checked"';}?>  > No
		</td>
		<td>
			RESP<br>
			<input type="radio"  name="resp"   value="Yes"  <?php if(isset($select_result['resp']) && $select_result['resp'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
			<input type="radio"  name="resp"   value="No"  <?php if(isset($select_result['resp']) && $select_result['resp'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['resp']) && $select_result['resp'] != "Yes"){echo 'checked="checked"';}?>  > No
		</td>
		<td>
			VOIDED<br>
			<input type="radio"  name="voided"   value="Yes"  <?php if(isset($select_result['voided']) && $select_result['voided'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
			<input type="radio"  name="voided"   value="No"  <?php if(isset($select_result['voided']) && $select_result['voided'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['voided']) && $select_result['voided'] != "Yes"){echo 'checked="checked"';}?>  > No
		</td>
		<td>
			HT (Cms)<br>
			<input  type="number" value="<?php echo isset($select_result['ht'])?$select_result['ht']:""; ?>"   min="0" name="ht" class="form-control" >
		</td>
		<td>
			WT (Kg)<br>
			<input  type="number" value="<?php echo isset($select_result['wt'])?$select_result['wt']:""; ?>"   min="0" name="wt" class="form-control" >
		</td>
	</tr>
</table>
<table class="table-bordered" style="width: 100%; color: red;">
	<tr>
		<td colspan="2">HPE</td>
		<td colspan="2">
			<input type="radio"  name="hpe"   value="Yes"  <?php if(isset($select_result['hpe']) && $select_result['hpe'] == "Yes"){echo 'checked="checked"'; }?>   >
			<label for="hpe">Yes</label>
			<input type="radio"  name="hpe"   value="No"  <?php if(isset($select_result['hpe']) && $select_result['hpe'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['hpe']) && $select_result['hpe'] != "Yes"){echo 'checked="checked"';}?>   >
			<label for="hpe">No</label>
		</td>
	</tr>
	<tr>
		<td colspan="2">TB PCR</td>
		<td colspan="2">
			<input type="radio"  name="tb_pcr"   value="Yes"  <?php if(isset($select_result['tb_pcr']) && $select_result['tb_pcr'] == "Yes"){echo 'checked="checked"'; }?>   >
			<label for="tb_pcr"> Yes</label>
			<input type="radio"  name="tb_pcr"   value="No"  <?php if(isset($select_result['tb_pcr']) && $select_result['tb_pcr'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['tb_pcr']) && $select_result['tb_pcr'] != "Yes"){echo 'checked="checked"';}?>   >
			<label for="tb_pcr"> No</label>
		</td>
	</tr>
	<tr>
		<td>NURSE</td>
		<td><input  type="text" value="<?php echo isset($select_result['nurse'])?$select_result['nurse']:""; ?>"   maxlength="20" class="form-control" name="nurse" ></td>
		<td>DOCTOR</td>
		<td><input  type="text" value="<?php echo isset($select_result['doctor_name'])?$select_result['doctor_name']:""; ?>"   maxlength="20" class="form-control" name="doctor_name" ></td>
	</tr>
</table>
<table class="table-bordered" style="width: 100%; color: red;">
	<tr>
		<td><b>Prescriptions Given</b></td>
	</tr>
	<tr>
		<td style="padding: 0;">
			<table width="100%">
				<tr>
					<td>
						<input type="radio"  name="inj_drotin"   value="Yes"  <?php if(isset($select_result['inj_drotin']) && $select_result['inj_drotin'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
						<input type="radio"  name="inj_drotin"   value="No"  <?php if(isset($select_result['inj_drotin']) && $select_result['inj_drotin'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['inj_drotin']) && $select_result['inj_drotin'] != "Yes"){echo 'checked="checked"';}?>  > No
					</td>
					<td>Injection Drotin 1 amp i.m. stat</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="inj_pantoprazole"   value="Yes"  <?php if(isset($select_result['inj_pantoprazole']) && $select_result['inj_pantoprazole'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
						<input type="radio"  name="inj_pantoprazole"   value="No"  <?php if(isset($select_result['inj_pantoprazole']) && $select_result['inj_pantoprazole'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['inj_pantoprazole']) && $select_result['inj_pantoprazole'] != "Yes"){echo 'checked="checked"';}?>  > No
					</td>
					<td>Injection Pantoprazole 40 mg i.m. stat</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="table-bordered" style="color: red;">
	<tr>
		<td width="30%">
			<p>PRE ASSESSMENT</p>
			<table width="100%">
				<tr>
					<td>
						<input type="radio"  name="no_sexual_intercourse"   value="Yes"  <?php if(isset($select_result['no_sexual_intercourse']) && $select_result['no_sexual_intercourse'] == "Yes"){echo 'checked="checked"'; }?>   >
						<label for="no_sexual_intercourse"> Yes</label><br>
						<input type="radio"  name="no_sexual_intercourse"   value="No"  <?php if(isset($select_result['no_sexual_intercourse']) && $select_result['no_sexual_intercourse'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['no_sexual_intercourse']) && $select_result['no_sexual_intercourse'] != "Yes"){echo 'checked="checked"';}?>   >
						<label for="no_sexual_intercourse"> No</label>
					</td>
					<td>No sexual intercourse for 72 hours</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="no_vaginal_douching"   value="Yes"  <?php if(isset($select_result['no_vaginal_douching']) && $select_result['no_vaginal_douching'] == "Yes"){echo 'checked="checked"'; }?>   >
						<label for="no_vaginal_douching"> Yes</label><br>
						<input type="radio"  name="no_vaginal_douching"   value="No"  <?php if(isset($select_result['no_vaginal_douching']) && $select_result['no_vaginal_douching'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['no_vaginal_douching']) && $select_result['no_vaginal_douching'] != "Yes"){echo 'checked="checked"';}?>   >
						<label for="no_vaginal_douching"> No</label>
					</td>
					<td>No vaginal douching for 72 hours</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="no_active_vaginal_infection"   value="Yes"  <?php if(isset($select_result['no_active_vaginal_infection']) && $select_result['no_active_vaginal_infection'] == "Yes"){echo 'checked="checked"'; }?>   >
						<label for="no_active_vaginal_infection"> Yes</label><br>
						<input type="radio"  name="no_active_vaginal_infection"   value="No"  <?php if(isset($select_result['no_active_vaginal_infection']) && $select_result['no_active_vaginal_infection'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['no_active_vaginal_infection']) && $select_result['no_active_vaginal_infection'] != "Yes"){echo 'checked="checked"';}?>   >
						<label for="no_active_vaginal_infection"> No</label>
					</td>
					<td>No active vaginal infection</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="no_history_of_antibiotics"   value="Yes"  <?php if(isset($select_result['no_history_of_antibiotics']) && $select_result['no_history_of_antibiotics'] == "Yes"){echo 'checked="checked"'; }?>   >
						<label for="no_history_of_antibiotics"> Yes</label><br>
						<input type="radio"  name="no_history_of_antibiotics"   value="No"  <?php if(isset($select_result['no_history_of_antibiotics']) && $select_result['no_history_of_antibiotics'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['no_history_of_antibiotics']) && $select_result['no_history_of_antibiotics'] != "Yes"){echo 'checked="checked"';}?>   >
						<label for="no_history_of_antibiotics"> No</label>
					</td>
					<td>No history of antibiotics for past seven days</td>
				</tr>
			</table>
		</td>
		<td>
			<p>Written informed consent taken. All vitals  under normal range. Patient put in lithotomy position ,under all sterile conditions, the vulva and vagina were cleansed by betadine and draped. A sterile Cuscos speculum /Sims speculum with tenaculum introduced.</p>
			<p>
				Per speculum – Cervix <input  type="text" value="<?php echo isset($select_result['cervix'])?$select_result['cervix']:""; ?>"   maxlength="50" name="cervix">,
				Vagina <input  type="text" value="<?php echo isset($select_result['vagina'])?$select_result['vagina']:""; ?>"   maxlength="50" name="vagina">,
				Discharge <input  type="text" value="<?php echo isset($select_result['discharge'])?$select_result['discharge']:""; ?>"   maxlength="50" name="discharge">
			</p>
			<p>Endometrial pipelle introduced inside the endometrial cavity and gently curetted to obtain endometrium and put in one container with normal saline and second with formalin and sent to pathology lab for further assessment.</p>
			<p>Patient stood the procedure well .No complications.</p>
			<p>Others <input  type="text" value="<?php echo isset($select_result['others'])?$select_result['others']:""; ?>"   maxlength="50" name="others"></p>
		</td>
	</tr>
</table>
<table class="table-bordered" style="width: 100%; color: red;">
	<tr>
		<td colspan="2"><b>Post procedure orders</b></td>
	</tr>
	<tr>
		<td srtle="padding: 0;" colspan="2">
			<table width="100%">
				<tr>
					<td>
						<input type="radio"  name="normal_diet"   value="Yes"  <?php if(isset($select_result['normal_diet']) && $select_result['normal_diet'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
						<input type="radio"  name="normal_diet"   value="No"  <?php if(isset($select_result['normal_diet']) && $select_result['normal_diet'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['normal_diet']) && $select_result['normal_diet'] != "Yes"){echo 'checked="checked"';}?>  > No
					</td>
					<td>Normal diet</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="tab_doxycycline"   value="Yes"  <?php if(isset($select_result['tab_doxycycline']) && $select_result['tab_doxycycline'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
						<input type="radio"  name="tab_doxycycline"   value="No"  <?php if(isset($select_result['tab_doxycycline']) && $select_result['tab_doxycycline'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['tab_doxycycline']) && $select_result['tab_doxycycline'] != "Yes"){echo 'checked="checked"';}?>  > No
					</td>
					<td>Tab. Doxycycline 100 mg twice daily one morning one evening after meals for 5 days</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="cap_pantoprazole"   value="Yes"  <?php if(isset($select_result['cap_pantoprazole']) && $select_result['cap_pantoprazole'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
						<input type="radio"  name="cap_pantoprazole"   value="No"  <?php if(isset($select_result['cap_pantoprazole']) && $select_result['cap_pantoprazole'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['cap_pantoprazole']) && $select_result['cap_pantoprazole'] != "Yes"){echo 'checked="checked"';}?>  > No
					</td>
					<td>Cap Pantoprazole 40 mg once daily in empty stomach for 5 days</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="tab_crocin"   value="Yes"  <?php if(isset($select_result['tab_crocin']) && $select_result['tab_crocin'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
						<input type="radio"  name="tab_crocin"   value="No"  <?php if(isset($select_result['tab_crocin']) && $select_result['tab_crocin'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['tab_crocin']) && $select_result['tab_crocin'] != "Yes"){echo 'checked="checked"';}?>  > No
					</td>
					<td>Tab Crocin 500 mg thrice daily eight hourly after meals for 2 days</td>
				</tr>
				<tr>
					<td>
						<input type="radio"  name="report"   value="Yes"  <?php if(isset($select_result['report']) && $select_result['report'] == "Yes"){echo 'checked="checked"'; }?>  > Yes
						<input type="radio"  name="report"   value="No"  <?php if(isset($select_result['report']) && $select_result['report'] == "No"){echo 'checked="checked"'; }
  else if(isset($select_result['report']) && $select_result['report'] != "Yes"){echo 'checked="checked"';}?>  > No
					</td>
					<td>To report if giddiness /nausea/vomiting/bleeding/pain/fever /purulent discharge immediately</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>Doctors signature</td>
		<td><input  type="text" value="<?php echo isset($select_result['doctor_signature'])?$select_result['doctor_signature']:""; ?>"   name="doctor_signature" class="form-control" ></td>
	</tr>
</table>
<!-- /.card-body -->
<div class="card-footer">
	<!-- <input type="" name="" class="btn btn-primary mt-2 mb-2" value="submit"> -->
	<input type="submit" name="submit" class="btn btn-primary mt-2 mb-2" value="submit">
</div>
</form>
<!--            Print Table                         -->
<input type="button" id="btn" value="Print" class="btn btn-primary pull-right printbtn" onclick="printtable();">
<div  class="printtable prtable "  id="printtable"  style="display:none">
    	<!--  <div  class="printtable prtable "  id="printtable"  >	 -->
    	<table style="width:100%; border:1px solid #cdcdcd;" id="printtable" border="1">
    	<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="10"><img src="<?php echo base_url(); ?>/assets/images/India-IVF-Logo-Option-5.png" style="width:220px"></td>
   <td style="width:50%;padding:5px;" colspan="10"><h3 style="margin-top:20px;">ENDOMETRIAL BIOPSY</h3></td>
   </tr>
</table>
     				  <table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">

<td colspan="2" width="33%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result5['center_code']."/".$select_result4['uhid']; ?></strong>
</td>
<td colspan="2" width="33%" style="border:1px solid;padding:5px;">
<strong>Patient Name : <?php echo $select_result3['wife_name']; ?> </strong>
</td>
<td colspan="2" width="33%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $patient_id; ?></strong>
</td>
</tr>
	   </table>

    	<table class="table-bordered" style="color: red; border:1px solid #cdcdcd;">
    	    	<tr>
    	    	<td colspan="2" style="border:1px solid #cdcdcd;" >		    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&		            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 		            isset($select_result['updated_type']) && !empty($select_result['updated_type'])		            ){?>		        <p id="last_updated"> Last updated on <?php echo $select_result['updated_at']; ?> 30/09/2021 by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?>  InDiaIVF</p>		      		   <?php } ?>		</td>		<td style="border:1px solid #cdcdcd;">			Date<br>			<?php echo isset($select_result['date'])?$select_result['date']:""; ?>       03/09/2021		</td>		<td style="border:1px solid #cdcdcd;" >			Time<br>			<?php echo isset($select_result['time'])?$select_result['time']:""; ?>          		  10.00Am		  		</td>		<td style="border:1px solid #cdcdcd;" >			Indication<br>			<?php echo isset($select_result['indication'])?$select_result['indication']:""; ?>            Dummy		</td>		<td style="border:1px solid #cdcdcd;" >			ALLERGIES<br>			<?php echo isset($select_result['allergies'])?$select_result['allergies']:""; ?>          Duumy 		</td>		<td style="border:1px solid #cdcdcd;" >			Consent <br>					 <?php if(isset($select_result['consent']) && $select_result['consent'] == "Yes"){echo 'yes'; }?>				Yes		</td>		<td style="border:1px solid #cdcdcd;" >			ID <br>							 <?php if(isset($select_result['id_checked']) && $select_result['id_checked'] == "Yes"){echo 'yes'; }?>		Yes		</td>	</tr>	<tr>		<td style="border:1px solid #cdcdcd;" >PRE ASSESSMENT</td>		<td style="border:1px solid #cdcdcd;" >			BP<br>			<?php echo isset($select_result['bp'])?$select_result['bp']:""; ?>            		197				</td>		<td style="border:1px solid #cdcdcd;" >			PULSE <br>		 <?php if(isset($select_result['pulse']) && $select_result['pulse'] == "Yes"){echo 'yes'; }?>		Yes		</td>		<td style="border:1px solid #cdcdcd;" >			RESP<br>							 <?php if(isset($select_result['resp']) && $select_result['resp'] == "Yes"){echo 'yes'; }?>Yes				</td>		<td style="border:1px solid #cdcdcd;" >			VOIDED <br>					 <?php if(isset($select_result['voided']) && $select_result['voided'] == "Yes"){echo 'yes'; }?>Yes				</td>		<td style="border:1px solid #cdcdcd;" >			HT (Cms)<br>			<?php echo isset($select_result['ht'])?$select_result['ht']:""; ?>      180		</td>		<td style="border:1px solid #cdcdcd;" >			WT (Kg)<br>			<?php echo isset($select_result['wt'])?$select_result['wt']:""; ?>            50		</td>	</tr></table><table class="table-bordered" style="width: 100%; color: red; border:1px solid #cdcdcd; ">	<tr>		<td colspan="2" style="border:1px solid #cdcdcd;" >HPE</td>		<td colspan="2" style="border:1px solid #cdcdcd;" >									 <?php if(isset($select_result['hpe']) && $select_result['hpe'] == "Yes"){echo 'yes'; }?>Yes		</td>	</tr>	<tr>		<td colspan="2" style="border:1px solid #cdcdcd;" >TB PCR</td>		<td colspan="2" style="border:1px solid #cdcdcd;" >         <?php if(isset($select_result['tb_pcr']) && $select_result['tb_pcr'] == "Yes"){echo 'yes'; }?>Yes		</td>	</tr>	<tr>		<td style="border:1px solid #cdcdcd;" >NURSE</td>		<td style="border:1px solid #cdcdcd;" >  <?php echo isset($select_result['nurse'])?$select_result['nurse']:""; ?> Duumy Nurse </td>		<td style="border:1px solid #cdcdcd;" > DOCTOR </td>		<td style="border:1px solid #cdcdcd;" > <?php echo isset($select_result['doctor_name'])?$select_result['doctor_name']:""; ?>  Duumy name</td>	</tr></table><table class="table-bordered" style="width:100%; border:1px solid #cdcdcd; color:red;" >	<tr>		<td style="border:1px solid #cdcdcd;" ><b>Prescriptions Given</b></td>	</tr>	<tr>		<td style="padding: 0; border:1px solid #cdcdcd; ">			<table style="width:100%; border:1px solid #cdcdcd;" >				<tr>					<td style="border:1px solid #cdcdcd; width:30px;" >										<?php if(isset($select_result['inj_drotin']) && $select_result['inj_drotin'] == "Yes"){echo 'yes'; }?>Yes				</td>					<td style="border:1px solid #cdcdcd;" >Injection Drotin 1 amp i.m. stat</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd;" >					              <?php if(isset($select_result['inj_pantoprazole']) && $select_result['inj_pantoprazole'] == "Yes"){echo 'yes'; }?>Yes										</td>					<td style="border:1px solid #cdcdcd;" >Injection Pantoprazole 40 mg i.m. stat</td>				</tr>			</table>		</td>	</tr></table><table class="table-bordered" style="color: red; border:1px solid #cdcdcd;">	<tr>		<td style="width:30%; border:1px solid #cdcdcd;" >			<p>PRE ASSESSMENT</p>			<table style="width:100%; border:1px solid #cdcdcd;" >				<tr>					<td style="border:1px solid #cdcdcd; width:30px;">										<?php if(isset($select_result['no_sexual_intercourse']) && $select_result['no_sexual_intercourse'] == "Yes"){echo 'yes'; }?>					Yes					</td>					<td style="border:1px solid #cdcdcd;"  >No sexual intercourse for 72 hours</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd;"  >						<?php if(isset($select_result['no_vaginal_douching']) && $select_result['no_vaginal_douching'] == "Yes"){echo 'yes'; }?>Yes					</td>					<td style="border:1px solid #cdcdcd;">No vaginal douching for 72 hours</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd;"  >											<?php if(isset($select_result['no_active_vaginal_infection']) && $select_result['no_active_vaginal_infection'] == "Yes"){echo 'yes'; }?>Yes										</td>					<td style="border:1px solid #cdcdcd;">No active vaginal infection</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd;">						              <?php if(isset($select_result['no_history_of_antibiotics']) && $select_result['no_history_of_antibiotics'] == "Yes"){echo 'yes'; }?>Yes					</td>					<td style="border:1px solid #cdcdcd;"  >No history of antibiotics for past seven days</td>				</tr>			</table>		</td>		<td style="border:1px solid #cdcdcd;">			<p>Written informed consent taken. All vitals  under normal range. Patient put in lithotomy position ,under all sterile conditions, the vulva and vagina were cleansed by betadine and draped. A sterile Cuscos speculum /Sims speculum with tenaculum introduced.</p>			<p>				Per speculum – Cervix <?php echo isset($select_result['cervix'])?$select_result['cervix']:""; ?> <br>  				Vagina <?php echo isset($select_result['vagina'])?$select_result['vagina']:""; ?> <br> 				Discharge <?php echo isset($select_result['discharge'])?$select_result['discharge']:""; ?> <br> 			</p>			<p>Endometrial pipelle introduced inside the endometrial cavity and gently curetted to obtain endometrium and put in one container with normal saline and second with formalin and sent to pathology lab for further assessment.</p>			<p>Patient stood the procedure well .No complications.</p>			<p>Others <?php echo isset($select_result['others'])?$select_result['others']:""; ?> Duumy  </p>		</td>	</tr></table><table class="table-bordered" style="width: 100%; color: red;">	<tr>		<td colspan="2" style="border:1px solid #cdcdcd;"  ><b>Post procedure orders</b></td>	</tr>	<tr>		<td style="border:1px solid #cdcdcd;padding: 0;" colspan="2">			<table style="width:100%; border:1px solid #cdcdcd;" >				<tr>					<td style="border:1px solid #cdcdcd; width:30px;"  >						<?php if(isset($select_result['normal_diet']) && $select_result['normal_diet'] == "Yes"){echo 'yes'; }?>					Yes										</td>					<td>Normal diet</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd; width:30px;"  >											 <?php if(isset($select_result['tab_doxycycline']) && $select_result['tab_doxycycline'] == "Yes"){echo 'yes'; }?>  Yes										</td>					<td>Tab. Doxycycline 100 mg twice daily one morning one evening after meals for 5 days</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd;"  >					 <?php if(isset($select_result['cap_pantoprazole']) && $select_result['cap_pantoprazole'] == "Yes"){echo 'yes'; }?>					Yes										</td>					<td style="border:1px solid #cdcdcd;"  >Cap Pantoprazole 40 mg once daily in empty stomach for 5 days</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd;"  >											  <?php if(isset($select_result['tab_crocin']) && $select_result['tab_crocin'] == "Yes"){echo 'yes'; }?>	   Yes															</td>					<td style="border:1px solid #cdcdcd;" >Tab Crocin 500 mg thrice daily eight hourly after meals for 2 days</td>				</tr>				<tr>					<td style="border:1px solid #cdcdcd;"  >					  <?php if(isset($select_result['report']) && $select_result['report'] == "Yes"){echo 'yes'; }?>					Yes										</td>					<td style="border:1px solid #cdcdcd;">To report if giddiness /nausea/vomiting/bleeding/pain/fever /purulent discharge immediately</td>				</tr>			</table>		</td>	</tr>	<tr>		<td style="border:1px solid #cdcdcd;"> Doctors signature </td>		<td style="border:1px solid #cdcdcd;">  <?php echo isset($select_result['doctor_signature'])?$select_result['doctor_signature']:""; ?>  Duumy sign </td>	</tr></table></table></div>


<script>function printtable() {	  $('.searchform').hide();   $('.printbtn').hide();  $('.printbtn').css('display', 'hide'); $('.prtable').css('display', 'block');  var divToPrint=document.getElementById('printtable');  var newWin=window.open('','Print-Window');  newWin.document.open();  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');  newWin.document.close();  setTimeout(function(){newWin.close();},10);  window.location.reload();}</script>