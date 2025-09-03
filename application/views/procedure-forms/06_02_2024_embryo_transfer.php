<?php

    // php code to Insert data into mysql database from input text

    if(isset($_POST['submit'])){

        unset($_POST['submit']);

        

        $select_query = "SELECT * FROM `embryo_transfer` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";

        $select_result = run_select_query($select_query); 

        if(empty($select_result)){

            // mysql query to insert data

            $query = "INSERT INTO `embryo_transfer` SET ";

            $sqlArr = array();

            foreach( $_POST as $key=> $value )

            {

              $sqlArr[] = " $key = '".addslashes($value)."'";

            }		

            $query .= implode(',' , $sqlArr);

        }else{

            // mysql query to update data

            $query = "UPDATE embryo_transfer SET ";

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

    $select_query = "SELECT * FROM `embryo_transfer` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";

	$select_result = run_select_query($select_query); 

	

	// php code to Insert data into mysql database from input text

	// if(isset($_POST['submit'])){

	// 	$patient_id = $_POST['patient_id'];

    //     $receipt_number = $_POST['receipt_number'];

	// 	$status = $_POST['status'];

		

	// 	// get values form input text and number

	// 	$date = $_POST['date'];

	// 	$time = $_POST['time'];

	// 	$ht = $_POST['ht'];

	// 	$wt = $_POST['wt'];

	// 	$consent = $_POST['consent'];

	// 	$id_ = $_POST['id_'];

	// 	$bp = $_POST['bp'];

	// 	$pulse = $_POST['pulse'];

	// 	$resp = $_POST['resp'];

	// 	$allergies = $_POST['allergies'];

	// 	$contacts = $_POST['contacts'];

	// 	$denture = $_POST['denture'];

	// 	$dental_bridge = $_POST['dental_bridge'];

	// 	$escort = $_POST['escort'];

	// 	$last_meal = $_POST['last_meal'];

	// 	$indication = $_POST['indication'];

	// 	$resp2 = $_POST['resp2'];

	// 	$cvs = $_POST['cvs'];

	// 	$cns = $_POST['cns'];

	// 	$abdominal = $_POST['abdominal'];

	// 	$others = $_POST['others'];

	// 	$depth = $_POST['depth'];

	// 	$transfer_embryos = $_POST['transfer_embryos'];

	// 	$thaw_embryos = $_POST['thaw_embryos'];

	// 	$embryos_deposited = $_POST['embryos_deposited'];

	// 	$nurse = $_POST['nurse'];

	// 	$doctor = $_POST['doctor'];

	// 	$embryologist = $_POST['embryologist'];

	// 	$inj_progesterone_at = $_POST['inj_progesterone_at'];

	// 	$inj_progesterone_on = $_POST['inj_progesterone_on'];

	// 	$inj_clexane_at = $_POST['inj_clexane_at'];

	// 	$inj_clexane_on = $_POST['inj_clexane_on'];

	// 	$inj_hcg_at = $_POST['inj_hcg_at'];

	// 	$inj_hcg_on = $_POST['inj_hcg_on'];

	// 	$embryo_transfer_at = $_POST['embryo_transfer_at'];

	// 	$embryo_transfer_on = $_POST['embryo_transfer_on'];

	// 	$admit_at = $_POST['admit_at'];

	// 	$admit_on = $_POST['admit_on'];

	// 	$admit_at2 = $_POST['admit_at2'];

	// 	$difficulty = $_POST['difficulty'];

	// 	$catheter_tip = $_POST['catheter_tip'];

	// 	$stylette = $_POST['stylette'];

	// 	$tenaculum = $_POST['tenaculum'];

	// 	$reload = $_POST['reload'];

	// 	$speculum_introduced = $_POST['speculum_introduced'];

	// 	$tenaculum1 = $_POST['tenaculum1'];

	// 	$difficulty1 = $_POST['difficulty1'];

	// 	$normal_diet = $_POST['normal_diet'];

	// 	$report = $_POST['report'];

	// 	$voided = $_POST['voided'];

	// 	$glasses = $_POST['glasses'];



	// 	// connect to mysql database using mysqli

		

		

	// 	// mysql query to insert data

	// 	$query = "INSERT INTO `embryo_transfer`(`patient_id`, `receipt_number`, `status`,`date`,`time`,`ht`,`wt`,`consent`,`id_`,`bp`,`pulse`,`resp`,`allergies`,`contacts`,`denture`,`dental_bridge`,`escort`,`last_meal`,`indication`,`resp2`,`cvs`,`cns`,`abdominal`,`others`,`depth`,`transfer_embryos`,`thaw_embryos`,`embryos_deposited`,`nurse`,`doctor`,`embryologist`,`inj_progesterone_at`,`inj_progesterone_on`,`inj_clexane_at`,`inj_clexane_on`,`inj_hcg_at`,`inj_hcg_on`,`embryo_transfer_at`,`embryo_transfer_on`,`admit_at`,`admit_on`,`admit_at2`,`difficulty`,`catheter_tip`,`stylette`,`tenaculum1`,`reload`,`speculum_introduced`,`tenaculum`,`difficulty1`,`normal_diet`,`report`,`voided`,`glasses`) VALUES ('$patient_id','$receipt_number','$status','$date','$time','$ht','$wt','$consent','$id_','$bp','$pulse','$resp','$allergies','$contacts','$denture','$dental_bridge','$escort','$last_meal','$indication','$resp2','$cvs','$cns','$abdominal','$others','$depth','$transfer_embryos','$thaw_embryos','$embryos_deposited','$nurse','$doctor','$embryologist','$inj_progesterone_at','$inj_progesterone_on','$inj_clexane_at','$inj_clexane_on','$inj_hcg_at','$inj_hcg_on','$embryo_transfer_at','$embryo_transfer_on','$admit_at','$admit_on','$admit_at2','$difficulty','$catheter_tip','$stylette','$tenaculum','$reload','$speculum_introduced','$tenaculum1','$difficulty1','$normal_diet','$report','$voided','$glasses')";

	// 	$result = run_form_query($query);



    //     if($result){

    //       header("location:" .base_url(). "procedure_reports/".$appointment_id."?m=".base64_encode('Procedure form inserted!').'&t='.base64_encode('success'));

	// 				die();

    //     }else{

    //       header("location:" .base_url(). "procedure_reports/".$appointment_id."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));

	// 				die();

    //     }

	// }

?>



<form enctype='multipart/form-data'  class ="searchform" name="form" action="" method="POST">

  <input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">

  <input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">

  <input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">

  

  <input type="hidden" value="<?php echo $procedure_id; ?>" class="form" name="procedure_id">

  <input type="hidden" value="<?php echo $patient_id; ?>" class="form" name="patient_id">

  <input type="hidden" value="<?php echo $receipt_number; ?>" class="form" name="receipt_number">

  <input type="hidden" value="pending" name="status"> 

			<table class="table-bordered" width="100%">

				<tr>

					<td colspan="2"><center><h3>EMBRYO TRANSFER/ FROZEN EMBRYO TRANSFER/Surrogate ET</h3></center></td>

					<td colspan="2">

        			    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&

        			            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 

        			            isset($select_result['updated_type']) && !empty($select_result['updated_type'])

        			            ){?>

        			        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>

        			    <?php } ?>

        			</td>

				</tr>

			</table>

			<table class="table-bordered" width="100%">

				<tr>

					<td><center><h4>GENERAL INSTRUCTIONS PRIOR TO EMBRYO TRANSFER</h4></center></td>

				</tr>

				<tr><td>1. Normal diet</td></tr>

				<tr><td>2. Continue thyroid/antihypertensive/all medication with  water in the morning of embryo transfer.</td></tr>

				<tr><td>3. If you are taking oral medications for diabetes please continue same</td></tr>

				<tr><td>4. If you require embryo transfer under GA then please come 6 hrs fasting before procedure</td></tr>

				<tr><td>5. You should arrange for a responsible adult to accompany you home from the day stay unit following egg collection. and to remain with you overnight. You should not be left alone in home for 24 hrs. following the procedures We can not perform egg collection if you fail to arrange an escort. You will need to rest at home all day following the procedures, but you should feel well enough to resume normal activities the day after.</td></tr>

				<tr><td>6. Please leave valuables and jewelry at home. Please remove nail paint and make up prior to the procedure. It is important that you do not wear any strong perfumes before the procedure.</td></tr>

				<tr><td>7. Please remove vaginal hair (by normal waxing/shaving/trimming ) at home before you come for ovum pick up</td></tr>

				<tr><td>8. You will be kept in for approximately 2 hours after your embryo transfer to allow a full recovery. Your escort should be available to take you home.</td></tr>

				<tr><td>9. Please remember to inform us of any medication (other than ivf drugs) that you take regularly-

				i.e. inhalers, blood pressure tablets. You should bring all medication with you to the fertility unit on the day of embryo transfer</td></tr>

				<tr><td>10. Do not take alcohol and  Please refrain from smoking for as long as possible before the procedure.</td></tr>

				<tr><td>11. We look forward to seeing you and will do everything to ensure a safe and comfortable stay.</td></tr>

			</table>

			<table class="table-bordered" width="100%">

				<tr>

					<td><b>EMBRYO TRANSFER</b></td>

					<td>

						Date<br><input type="date" name="transfer_date" class="form-control" value="<?php echo isset($select_result['transfer_date'])?$select_result['transfer_date']:""; ?>"  >

					</td>

					<td>

						Time<br><input type="time" name="transfer_time" class="form-control" value="<?php echo isset($select_result['transfer_time'])?$select_result['transfer_time']:""; ?>"  >

					</td>

					<td>

						Indication<br><input type="text" maxlength="50" name="indication" class="form-control" value="<?php echo isset($select_result['indication'])?$select_result['indication']:""; ?>"  >

					</td>

					<td>

						Allergies<br><input type="text" maxlength="50" name="allergies" class="form-control" value="<?php echo isset($select_result['allergies'])?$select_result['allergies']:""; ?>"  >

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

						BP<br><input type="text" maxlength="20" name="bp" class="form-control" value="<?php echo isset($select_result['bp'])?$select_result['bp']:""; ?>"  >

					</td>

					<td>

						Pulse<br>

						<input type="radio"  name="pulse"   value="Yes"  <?php if(isset($select_result['pulse']) && $select_result['pulse'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="pulse"   value="No"  <?php if(isset($select_result['pulse']) && $select_result['pulse'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['pulse']) && $select_result['pulse'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

					<td>

						Resp<br>

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

						Ht (Cms)<br><input type="number" min="0" name="ht" class="form-control" value="<?php echo isset($select_result['ht'])?$select_result['ht']:""; ?>"  >

					</td>

					<td>

						Wt (Kg)<br><input type="number" min="0" name="wt" class="form-control" value="<?php echo isset($select_result['wt'])?$select_result['wt']:""; ?>"  >

					</td>

				</tr>

				<tr>

					<td style="color: black;">

						Glasses<br>

						<input type="radio"  name="glasses"   value="Yes"  <?php if(isset($select_result['glasses']) && $select_result['glasses'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="glasses"   value="No"  <?php if(isset($select_result['glasses']) && $select_result['glasses'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['glasses']) && $select_result['glasses'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

					<td style="color: black;">

						Contacts<br>

						<input type="radio"  name="contacts"   value="Yes"  <?php if(isset($select_result['contacts']) && $select_result['contacts'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="contacts"   value="No"  <?php if(isset($select_result['contacts']) && $select_result['contacts'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['contacts']) && $select_result['contacts'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

					<td style="color: black;">

						Denture<br>

						<input type="radio"  name="denture"   value="Yes"  <?php if(isset($select_result['denture']) && $select_result['denture'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="denture"   value="No"  <?php if(isset($select_result['denture']) && $select_result['denture'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['denture']) && $select_result['denture'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

					<td style="color: black;" colspan="2">

						Dental bridge<br>

						<input type="radio"  name="dental_bridge"   value="Yes"  <?php if(isset($select_result['dental_bridge']) && $select_result['dental_bridge'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="dental_bridge"   value="No"  <?php if(isset($select_result['dental_bridge']) && $select_result['dental_bridge'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['dental_bridge']) && $select_result['dental_bridge'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

					<td style="color: black;">

						Valuables with escort<br>

						<input type="radio"  name="escort"   value="Yes"  <?php if(isset($select_result['escort']) && $select_result['escort'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="escort"   value="No"  <?php if(isset($select_result['escort']) && $select_result['escort'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['escort']) && $select_result['escort'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

					<td style="color: black;">

						Last meal<br><input type="time" name="last_meal" class="form-control" value="<?php echo isset($select_result['last_meal'])?$select_result['last_meal']:""; ?>"  >

					</td>

				</tr>

			</table>

			<table class="table-bordered" width="100%">

				<tr>

					<td>Nurse</td>

					<td><input type="text" maxlength="20" name="nurse" class="form-control" value="<?php echo isset($select_result['nurse'])?$select_result['nurse']:""; ?>"   ></td>

					<td>Doctor</td>

					<td><input type="text" maxlength="20" name="doctor" class="form-control" value="<?php echo isset($select_result['doctor'])?$select_result['doctor']:""; ?>"   ></td>

					<td>Embryologist</td>

					<td><input type="text" maxlength="20" name="embryologist" class="form-control" value="<?php echo isset($select_result['embryologist'])?$select_result['embryologist']:""; ?>"   ></td>

				</tr>

			</table>

			<table class="table-bordered" width="100%">

				<tr>

					<td style="padding: 0; width:30%;">

						<table>

							<tr><td colspan="2"><b>PRE ASSESSMENT</b></td></tr>

							<tr>

								<td colspan="2">

									No sexual intercourse for 72 hrs<br>

									No active infection<br>

									No aspirin or NSAID a week before

								</td>

							</tr>

							<tr><td colspan="2"><b>Physical Examination</b></td></tr>

							<tr>

								<td>Resp</td>

								<td><input type="text" value="<?php echo isset($select_result['resp2'])?$select_result['resp2']:""; ?>" maxlength="20" name="resp2"></td>

							</tr>

							<tr>

								<td>CVS</td>

								<td><input type="text" value="<?php echo isset($select_result['cvs'])?$select_result['cvs']:""; ?>" maxlength="20" name="cvs"></td>

							</tr>

							<tr>

								<td>CNS</td>

								<td><input type="text"  value="<?php echo isset($select_result['cns'])?$select_result['cns']:""; ?>"maxlength="20" name="cns"></td>

							</tr>

							<tr>

								<td>Abdominal</td>

								<td><input type="text" value="<?php echo isset($select_result['abdominal'])?$select_result['abdominal']:""; ?>" maxlength="20" name="abdominal"></td>

							</tr>

							<tr>

								<td>Others</td>

								<td><input type="text" value="<?php echo isset($select_result['others'])?$select_result['others']:""; ?>" maxlength="100" name="others"></td>

							</tr>

						</table>

					</td>

					<td>

						Written informed consent taken. All vitals  under normal range.<br>

						Patient put in lithotomy position ,under all sterile conditions, the vulva and vagina were cleansed by normal saline  and draped.

						<input type="radio" <?php if(isset($select_result['speculum_introduced']) && $select_result['speculum_introduced'] == "Sims"){echo 'checked="checked"'; }?>   name="speculum_introduced" value="Sims"> Sims

						<input type="radio" <?php if(isset($select_result['speculum_introduced']) && $select_result['speculum_introduced'] == "Cuscos"){echo 'checked="checked"'; }?>    name="speculum_introduced" value="Cuscos"> Cuscos

						speculum introduced inside the vagina. A tenaculum

						<input type="radio" <?php if(isset($select_result['tenaculum1']) && $select_result['tenaculum1'] == "was"){echo 'checked="checked"'; }?>   name="tenaculum1" value="was"> was

						<input type="radio" <?php if(isset($select_result['tenaculum1']) && $select_result['tenaculum1'] == "was not"){echo 'checked="checked"'; }?>   name="tenaculum1" value="was not"> was not

						used.The cervix was visualized and cleansed .The outer catheter was placed into the cervical canal. The Cooks catheter containing the embryo(s), was passed through with

						<input type="radio" name="difficulty"   value="No" <?php if(isset($select_result['difficulty']) && $select_result['difficulty'] == "No"){echo 'checked="checked"'; }?>  > no

						<input type="radio" <?php if(isset($select_result['difficulty']) && $select_result['difficulty'] == "moderate"){echo 'checked="checked"'; }?>   name="difficulty" value="moderate"> moderate

						<input type="radio" <?php if(isset($select_result['difficulty']) && $select_result['difficulty'] == "considerable"){echo 'checked="checked"'; }?>   name="difficulty" value="considerable"> considerable

						difficulty to a depth of <input type="number" min="0" value="<?php echo isset($select_result['depth'])?$select_result['depth']:""; ?>" name="depth" > cm. Visualization with ultrasound was/was not successful.<br>

						The patient requested that an attempt be made to transfer <input type="number" min="0" value="<?php echo isset($select_result['transfer_embryos'])?$select_result['transfer_embryos']:""; ?>" name="transfer_embryos" > embryos . It was necessary to thaw <input type="number" min="0" value="<?php echo isset($select_result['thaw_embryos'])?$select_result['thaw_embryos']:""; ?>" name="thaw_embryos" > Embryos and <input type="number" min="0" value="<?php echo isset($select_result['embryos_deposited'])?$select_result['embryos_deposited']:""; ?>" name="embryos_deposited" > embryos were deposited into the uterine cavity.<br>

						The catheters were removed and re for embryos by the embryologist .The speculum was removed and the patient was transferred to recovery for a period of rest prior to discharge.<br>

						<input type="radio" <?php if(isset($select_result['difficulty1']) && $select_result['difficulty1'] == "Easy"){echo 'checked="checked"'; }?>   name="difficulty1" value="Easy"> Easy

						<input type="radio" <?php if(isset($select_result['difficulty1']) && $select_result['difficulty1'] == "Difficult"){echo 'checked="checked"'; }?>    name="difficulty1" value="Difficult"> Difficult

						<br>

						<b>Blood at inner catheter tip</b>

						<input type="radio"  name="catheter_tip"   value="Yes"  <?php if(isset($select_result['catheter_tip']) && $select_result['catheter_tip'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="catheter_tip"   value="No"  <?php if(isset($select_result['catheter_tip']) && $select_result['catheter_tip'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['catheter_tip']) && $select_result['catheter_tip'] != "Yes"){echo 'checked="checked"';}?>  > No

						<br>

						<b>Stylette</b>

						<input type="radio"  name="stylette"   value="Yes"  <?php if(isset($select_result['stylette']) && $select_result['stylette'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="stylette"   value="No"  <?php if(isset($select_result['stylette']) && $select_result['stylette'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['stylette']) && $select_result['stylette'] != "Yes"){echo 'checked="checked"';}?>  > No

						<br>

						<b>Tenaculum</b>

						<input type="radio"  name="tenaculum"   value="Yes"  <?php if(isset($select_result['tenaculum']) && $select_result['tenaculum'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="tenaculum"   value="No"  <?php if(isset($select_result['tenaculum']) && $select_result['tenaculum'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['tenaculum']) && $select_result['tenaculum'] != "Yes"){echo 'checked="checked"';}?>  > No

						<br>

						<b>Reload</b>

						<input type="radio"  name="reload"   value="Yes"  <?php if(isset($select_result['reload']) && $select_result['reload'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="reload"   value="No"  <?php if(isset($select_result['reload']) && $select_result['reload'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['reload']) && $select_result['reload'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

				</tr>

			</table>

			<table class="table-bordered" width="100%">

				<tr>

					<td><center><h4>INSTRUCTIONS PRIOR TO EMBRYO TRANSFER</h4></center></td>

				</tr>

				<tr>

					<td>LAST INJ.OF PROGESTERONE @ <input type="text" value="<?php echo isset($select_result['inj_progesterone_at'])?$select_result['inj_progesterone_at']:""; ?>" name="inj_progesterone_at" > on <input type="date" name="inj_progesterone_on" value="<?php echo isset($select_result['inj_progesterone_on'])?$select_result['inj_progesterone_on']:""; ?>" ></td>

				</tr>

				<tr>

					<td>TAKE INJ. CLEXANE @ <input type="text" value="<?php echo isset($select_result['inj_clexane_at'])?$select_result['inj_clexane_at']:""; ?>" name="inj_clexane_at" > on <input type="date" name="inj_clexane_on" value="<?php echo isset($select_result['inj_clexane_on'])?$select_result['inj_clexane_on']:""; ?>" ></td>

				</tr>

				<tr>

					<td>Take Inj. HCG @ <input type="text" value="<?php echo isset($select_result['inj_hcg_at'])?$select_result['inj_hcg_at']:""; ?>" name="inj_hcg_at" > on <input type="date" name="inj_hcg_on" value="<?php echo isset($select_result['inj_hcg_on'])?$select_result['inj_hcg_on']:""; ?>" ></td>

				</tr>

				<tr>

					<td>Embryo transfer on <input type="date" value="<?php echo isset($select_result['embryo_transfer_on'])?$select_result['embryo_transfer_on']:""; ?>" name="embryo_transfer_on" > @ <input type="text" value="<?php echo isset($select_result['embryo_transfer_at'])?$select_result['embryo_transfer_at']:""; ?>" name="embryo_transfer_at" ></td>

				</tr>

				<tr>

					<td>Admit @ <input type="text" value="<?php echo isset($select_result['admit_at'])?$select_result['admit_at']:""; ?>" name="admit_at" >in day care on <input type="date" name="admit_on" value="<?php echo isset($select_result['admit_on'])?$select_result['admit_on']:""; ?>" > at <input type="text" value="<?php echo isset($select_result['admit_at2'])?$select_result['admit_at2']:""; ?>" name="admit_at2" ></td>

				</tr>

			</table>

			<table class="table-bordered" width="100%">

				<tr>

					<td colspan="2"><b>Intra Operative orders</b></td>

				</tr>

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

						<input type="radio"  name="report"   value="Yes"  <?php if(isset($select_result['report']) && $select_result['report'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="report"   value="No"  <?php if(isset($select_result['report']) && $select_result['report'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['report']) && $select_result['report'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

					<td>To report if giddiness /nausea/vomiting/bleeding/pain/fever /purulent discharge immediately</td>

				</tr>

			</table>

			<!-- <table class="table-bordered" width="100%">

				<tr>

					<td colspan="8"><b>Post Procedure orders</b></td>

				</tr>

				<tr>

					<td style="width: 5%;"></td>

					<td style="color: green;">MEDICINE NAME</td>

					<td style="color: green;">DOSAGE</td>

					<td style="color: green;">ROUTE</td>

					<td style="color: green;">FREQUENCY</td>

					<td style="color: green;">TIMINGS</td>

					<td style="color: green;">WHEN TO START</td>

				</tr>

				<tr>

					<td></td>

					<td>(inventory list to be mapped )</td>

					<td></td>

					<td>

						<select>

							<option value="PO">PO</option>

							<option value="IM">IM</option>

							<option value="SC">SC</option>

							<option value="VAGINA-LY">VAGINA-LY</option>

							<option value="IV">IV</option>

							<option value="LOCAL">LOCAL</option>

							<option value="NASALY">NASALY</option>

						</select>

					</td>

					<td>

						<select>

							<option value="OD">OD</option>

							<option value="BD">BD</option>

							<option value="TDS">TDS</option>

							<option value="QID">QID</option>

							<option value="SOS">SOS</option>

							<option value="HS">HS</option>

						</select>

					</td>

					<td>

						<select>

							<option value="EMPTY STOMACH">EMPTY STOMACH</option>

							<option value="BEFORE MEAL">BEFORE MEAL</option>

							<option value="AFTER MEAL">AFTER MEAL</option>

						</select>

					</td>

					<td><input type="text" name="" maxlength="20"></td>

				</tr>

			</table> -->

			<table class="table-bordered" width="100%">

				<tr><td>To take normal diet</td></tr>

				<tr>

					<td>

						● Continue thyroid/antihypertensive/diabetes medications as have been taking previously<br>

						● To take normal diet<br>

						● To report in emergency of the hospital immediately if patient has abdominal pain/vaginal bleeding/fever/excessive cough/giddiness/vomiting<br>

						● SERUM BETA HCG ON <input type="date" value="<?php echo isset($select_result['serum_beta'])?$select_result['serum_beta']:""; ?>" name="serum_beta" >

					</td>

				</tr>

				<tr><td><input type="number"  value="<?php echo isset($select_result['gestational_sac_no'])?$select_result['gestational_sac_no']:""; ?>" min="0" name="gestational_sac_no"> No. of gestational sac on ultrasound on <input type="date"  value="<?php echo isset($select_result['gestational_sac'])?$select_result['gestational_sac']:""; ?>" name="gestational_sac">.</td></tr>

				<tr><td><input type="number"  value="<?php echo isset($select_result['cardiac_activity_no'])?$select_result['cardiac_activity_no']:""; ?>" min="0" name="cardiac_activity_no"> No.of sac with cardiac activity on <input  value="<?php echo isset($select_result['cardiac_activity'])?$select_result['cardiac_activity']:""; ?>" type="date" name="cardiac_activity">.</td></tr>

				<tr>

					<td>

						Live birth on <input type="date" value="<?php echo isset($select_result['live_birth_on'])?$select_result['live_birth_on']:""; ?>" name="live_birth_on"> @ <input type="text" maxlength="20"  value="<?php echo isset($select_result['live_birth_at'])?$select_result['live_birth_at']:""; ?>" name="live_birth_at"> by <input type="text"  value="<?php echo isset($select_result['live_birth_by'])?$select_result['live_birth_by']:""; ?>" maxlength="20" name="live_birth_by">.Sex of child/children:

						<input type="radio"  name="sex_of_child"   value="Male"  <?php if(isset($select_result['sex_of_child']) && $select_result['sex_of_child'] == "Male"){echo 'checked="checked"'; }?>   >

						<label for="Male"> Male</label>

						<input type="radio"  name="sex_of_child"   value="Female"  <?php if(isset($select_result['sex_of_child']) && $select_result['sex_of_child'] == "Female"){echo 'checked="checked"'; }

  else if(isset($select_result['sex_of_child']) && $select_result['sex_of_child'] != "Yes"){echo 'checked="checked"';}?>   >

						<label for="Female"> Female</label>

					</td>

				</tr>

			</table>

			<table class="table-bordered" width="100%">

				<tr>

					<td>DATE</td>

					<td><input type="date" name="date" class="form-control" value="<?php echo isset($select_result['date'])?$select_result['date']:""; ?>"   ></td>

					<td>TIME</td>

					<td><input type="time" name="time" class="form-control" value="<?php echo isset($select_result['time'])?$select_result['time']:""; ?>"   ></td>

					<td>Doctor Name</td>

					<td><input type="text" name="doctor_name" maxlength="20" class="form-control" value="<?php echo isset($select_result['doctor_name'])?$select_result['doctor_name']:""; ?>"   ></td>

					<td>Doctor Signature</td>

					<td><input type="text" name="doctor_signature" maxlength="20" class="form-control" value="<?php echo isset($select_result['doctor_signature'])?$select_result['doctor_signature']:""; ?>"   ></td>

				</tr>

			</table>



			<!-- /.card-body -->

			<div class="card-footer">

				<!-- <input type="" name="" class="btn btn-primary mt-2 mb-2" value="submit"> -->

				<input type="submit" name="submit" class="btn btn-primary mt-2 mb-2" value="submit">

			</div>

</form>






		<!--                             Print       TABLE                         -->	
		
		
		
		
		
		
		
			
<input type="button" id="btn" value="Print" class="btn btn-primary pull-right ptable">

	
<!--<div  class="printtable prtable"  id="printtable"  style="display:none;">-->
<div  class="printtable prtable"  id="printtable" style="display:none;">


<table style="width:100%; border:1px solid #cdcdcd;" id="printtable" border="1">



			<table class="table-bordered" width="100%">
                <tr>
<td colspan="2" style="border:1px solid #cdcdcd;">

        			   <img src="https://indiaivf.website/assets/images/india-ivf-logo.webp">

        			</td>
					<td colspan="2" style="border:1px solid #cdcdcd;"><center><h3>EMBRYO TRANSFER/ FROZEN EMBRYO TRANSFER/Surrogate ET</h3></center></td>

					

				</tr>

				<tr>

					<td colspan="4" style="border:1px solid #cdcdcd;">

        			    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&

        			            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 

        			            isset($select_result['updated_type']) && !empty($select_result['updated_type'])

        			            ){?>

        			        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>

        			    <?php } ?>

        			</td>

				</tr>
				<tr>
<td colspan="1" width="25%" style="border:1px solid #cdcdcd;">UHID :</td>
<td colspan="1" width="25%" style="border:1px solid #cdcdcd;"><?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$patient_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></td>
</td>
<td colspan="1" width="25%" style="border:1px solid #cdcdcd;">IIC ID:</td>
<td colspan="1" width="25%" style="border:1px solid #cdcdcd;"> <?php echo $patient_id; ?></td>
</tr>

			</table>


	<table class="table-bordered" width="100%">

				<tr>

					<td style="border:1px solid #cdcdcd;"><center><h4>GENERAL INSTRUCTIONS PRIOR TO EMBRYO TRANSFER</h4></center></td>

				</tr>

				<tr ><td style="border:1px solid #cdcdcd;">1. Normal diet</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">2. Continue thyroid/antihypertensive/all medication with  water in the morning of embryo transfer.</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">3. If you are taking oral medications for diabetes please continue same</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">4. If you require embryo transfer under GA then please come 6 hrs fasting before procedure</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">5. You should arrange for a responsible adult to accompany you home from the day stay unit following egg collection. and to remain with you overnight. You should not be left alone in home for 24 hrs. following the procedures We can not perform egg collection if you fail to arrange an escort. You will need to rest at home all day following the procedures, but you should feel well enough to resume normal activities the day after.</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">6. Please leave valuables and jewelry at home. Please remove nail paint and make up prior to the procedure. It is important that you do not wear any strong perfumes before the procedure.</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">7. Please remove vaginal hair (by normal waxing/shaving/trimming ) at home before you come for ovum pick up</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">8. You will be kept in for approximately 2 hours after your embryo transfer to allow a full recovery. Your escort should be available to take you home.</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">9. Please remember to inform us of any medication (other than ivf drugs) that you take regularly-

				i.e. inhalers, blood pressure tablets. You should bring all medication with you to the fertility unit on the day of embryo transfer</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">10. Do not take alcohol and  Please refrain from smoking for as long as possible before the procedure.</td></tr>

				<tr><td style="border:1px solid #cdcdcd;">11. We look forward to seeing you and will do everything to ensure a safe and comfortable stay.</td></tr>

			</table>


              <table class="table-bordered" width="100%">

				<tr>

					<td style="border:1px solid #cdcdcd;"><b>EMBRYO TRANSFER</b></td>

					<td style="border:1px solid #cdcdcd;">

						Date<br> <?php echo isset($select_result['transfer_date'])?$select_result['transfer_date']:""; ?>

					</td>
					<td style="border:1px solid #cdcdcd;">

						Time<br> <?php echo isset($select_result['transfer_time'])?$select_result['transfer_time']:""; ?>

					</td>

					<td style="border:1px solid #cdcdcd;">

						Indication<br><?php echo isset($select_result['indication'])?$select_result['indication']:""; ?>

					</td>

					<td style="border:1px solid #cdcdcd;">

						Allergies<br><?php echo isset($select_result['allergies'])?$select_result['allergies']:""; ?>

					</td>

					<td style="border:1px solid #cdcdcd;">

						Consent<br>

						

					          <?php if(isset($select_result['consent']) && $select_result['consent'] == "Yes"){echo 'yes'; }?>
					
					</td >

					<td style="border:1px solid #cdcdcd;">

						ID <br>

						

				   <?php if(isset($select_result['id_checked']) && $select_result['id_checked'] == "Yes"){echo 'yes'; }?>
               


				</td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">PRE ASSESSMENT</td>

					<td style="border:1px solid #cdcdcd;">

						BP<br> <?php echo isset($select_result['bp'])?$select_result['bp']:""; ?>

					</td>

					<td style="border:1px solid #cdcdcd;">

						Pulse<br>

						

                  	   <?php if(isset($select_result['pulse']) && $select_result['pulse'] == "Yes"){echo 'yes'; }?>


					</td>

					<td style="border:1px solid #cdcdcd;">

						Resp<br>

						
				   <?php if(isset($select_result['resp']) && $select_result['resp'] == "Yes"){echo 'yes'; }?>


				</td>

					<td style="border:1px solid #cdcdcd;">

						VOIDED<br>

					
  
                      <?php if(isset($select_result['voided']) && $select_result['voided'] == "Yes"){echo 'yes'; }?>

					</td>

					<td style="border:1px solid #cdcdcd;">

						Ht (Cms)<br> <?php echo isset($select_result['ht'])?$select_result['ht']:""; ?>

					</td>

					<td style="border:1px solid #cdcdcd;">

						Wt (Kg)<br> <?php echo isset($select_result['wt'])?$select_result['wt']:""; ?>

					</td>

				</tr>

				<tr>

					<td style="color: black;border:1px solid #cdcdcd;">

						Glasses<br>

						
                 <?php if(isset($select_result['glasses']) && $select_result['glasses'] == "Yes"){echo 'yes'; }?>
					
					
					</td>

					<td style="color: black; border:1px solid #cdcdcd;">

						Contacts<br>

						

					    <?php if(isset($select_result['contacts']) && $select_result['contacts'] == "Yes"){echo 'yes'; }?>
					
					</td>

					<td style="color: black; border:1px solid #cdcdcd;">

						Denture<br>

						
				 <?php if(isset($select_result['denture']) && $select_result['denture'] == "Yes"){echo 'yes'; }?>

				</td>

					<td style="color: black;border:1px solid #cdcdcd;" colspan="2">

						Dental bridge<br>

						
					
					 <?php if(isset($select_result['dental_bridge']) && $select_result['dental_bridge'] == "Yes"){echo 'yes'; }?>
					
					
					</td>

					<td style="color: black; border:1px solid #cdcdcd;">

						Valuables with escort<br>

						
                    <?php if(isset($select_result['escort']) && $select_result['escort'] == "Yes"){echo 'yes'; }?>

				</td>

					<td style="color: black; border:1px solid #cdcdcd;">

						Last meal<br>  <?php echo isset($select_result['last_meal'])?$select_result['last_meal']:""; ?>

					</td>

				</tr>

			</table>





	<table class="table-bordered" width="100%">

				<tr>

					<td style="border:1px solid #cdcdcd; ">Nurse</td>

					<td style="border:1px solid #cdcdcd; width: 20%;"><?php echo isset($select_result['nurse'])?$select_result['nurse']:""; ?></td>

					<td style="border:1px solid #cdcdcd;">Doctor</td>

					<td style="border:1px solid #cdcdcd; width: 20%;"><?php echo isset($select_result['doctor'])?$select_result['doctor']:""; ?></td>

					<td style="border:1px solid #cdcdcd; ">Embryologist</td>

					<td style="border:1px solid #cdcdcd; width: 20%;"><?php echo isset($select_result['embryologist'])?$select_result['embryologist']:""; ?></td>

				</tr>

			</table>





<table class="table-bordered" width="100%">

				<tr>

					<td style="padding: 0; width:30%; border:1px solid #cdcdcd; ">

						<table >

							<tr><td colspan="2"><b>PRE ASSESSMENT</b></td></tr>

							<tr>

								<td colspan="2">

									No sexual intercourse for 72 hrs<br>

									No active infection<br>

									No aspirin or NSAID a week before

								</td>

							</tr>

							<tr><td colspan="2"><b>Physical Examination</b></td></tr>

							<tr>

								<td>Resp</td>

								<td><?php echo isset($select_result['resp2'])?$select_result['resp2']:""; ?></td>

							</tr>

							<tr>

								<td>CVS</td>

								<td><?php echo isset($select_result['cvs'])?$select_result['cvs']:""; ?></td>

							</tr>

							<tr>

								<td>CNS</td>

								<td><?php echo isset($select_result['cns'])?$select_result['cns']:""; ?></td>

							</tr>

							<tr>

								<td>Abdominal</td>

								<td><?php echo isset($select_result['abdominal'])?$select_result['abdominal']:""; ?></td>

							</tr>

							<tr>

								<td>Others</td>

								<td><?php echo isset($select_result['others'])?$select_result['others']:""; ?></td>

							</tr>

						</table>

					</td>

					<td style="border:1px solid #cdcdcd;">

						Written informed consent taken. All vitals  under normal range.<br>

						Patient put in lithotomy position ,under all sterile conditions, the vulva and vagina were cleansed by normal saline  and draped.

						<input type="radio" <?php if(isset($select_result['speculum_introduced']) && $select_result['speculum_introduced'] == "Sims"){echo 'checked="checked"'; }?>   name="speculum_introduced" value="Sims"> Sims

						<input type="radio" <?php if(isset($select_result['speculum_introduced']) && $select_result['speculum_introduced'] == "Cuscos"){echo 'checked="checked"'; }?>    name="speculum_introduced" value="Cuscos"> Cuscos

						speculum introduced inside the vagina. A tenaculum

						<input type="radio" <?php if(isset($select_result['tenaculum1']) && $select_result['tenaculum1'] == "was"){echo 'checked="checked"'; }?>   name="tenaculum1" value="was"> was

						<input type="radio" <?php if(isset($select_result['tenaculum1']) && $select_result['tenaculum1'] == "was not"){echo 'checked="checked"'; }?>   name="tenaculum1" value="was not"> was not

						used.The cervix was visualized and cleansed .The outer catheter was placed into the cervical canal. The Cooks catheter containing the embryo(s), was passed through with

						<input type="radio" name="difficulty"   value="No" <?php if(isset($select_result['difficulty']) && $select_result['difficulty'] == "No"){echo 'checked="checked"'; }?>  > no

						<input type="radio" <?php if(isset($select_result['difficulty']) && $select_result['difficulty'] == "moderate"){echo 'checked="checked"'; }?>   name="difficulty" value="moderate"> moderate

						<input type="radio" <?php if(isset($select_result['difficulty']) && $select_result['difficulty'] == "considerable"){echo 'checked="checked"'; }?>   name="difficulty" value="considerable"> considerable

						difficulty to a depth of <?php echo isset($select_result['depth'])?$select_result['depth']:""; ?> cm. Visualization with ultrasound was/was not successful.<br>

						The patient requested that an attempt be made to transfer <?php echo isset($select_result['transfer_embryos'])?$select_result['transfer_embryos']:""; ?> embryos . It was necessary to thaw <?php echo isset($select_result['thaw_embryos'])?$select_result['thaw_embryos']:""; ?> Embryos and <?php echo isset($select_result['embryos_deposited'])?$select_result['embryos_deposited']:""; ?> embryos were deposited into the uterine cavity.<br>

						The catheters were removed and re for embryos by the embryologist .The speculum was removed and the patient was transferred to recovery for a period of rest prior to discharge.<br>

						<input type="radio" <?php if(isset($select_result['difficulty1']) && $select_result['difficulty1'] == "Easy"){echo 'checked="checked"'; }?>   name="difficulty1" value="Easy"> Easy

						<input type="radio" <?php if(isset($select_result['difficulty1']) && $select_result['difficulty1'] == "Difficult"){echo 'checked="checked"'; }?>    name="difficulty1" value="Difficult"> Difficult

						<br>

						<b>Blood at inner catheter tip</b>

						<input type="radio"  name="catheter_tip"   value="Yes"  <?php if(isset($select_result['catheter_tip']) && $select_result['catheter_tip'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="catheter_tip"   value="No"  <?php if(isset($select_result['catheter_tip']) && $select_result['catheter_tip'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['catheter_tip']) && $select_result['catheter_tip'] != "Yes"){echo 'checked="checked"';}?>  > No

						<br>

						<b>Stylette</b>

						<input type="radio"  name="stylette"   value="Yes"  <?php if(isset($select_result['stylette']) && $select_result['stylette'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="stylette"   value="No"  <?php if(isset($select_result['stylette']) && $select_result['stylette'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['stylette']) && $select_result['stylette'] != "Yes"){echo 'checked="checked"';}?>  > No

						<br>

						<b>Tenaculum</b>

						<input type="radio"  name="tenaculum"   value="Yes"  <?php if(isset($select_result['tenaculum']) && $select_result['tenaculum'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="tenaculum"   value="No"  <?php if(isset($select_result['tenaculum']) && $select_result['tenaculum'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['tenaculum']) && $select_result['tenaculum'] != "Yes"){echo 'checked="checked"';}?>  > No

						<br>

						<b>Reload</b>

						<input type="radio"  name="reload"   value="Yes"  <?php if(isset($select_result['reload']) && $select_result['reload'] == "Yes"){echo 'checked="checked"'; }?>  > Yes

						<input type="radio"  name="reload"   value="No"  <?php if(isset($select_result['reload']) && $select_result['reload'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['reload']) && $select_result['reload'] != "Yes"){echo 'checked="checked"';}?>  > No

					</td>

				</tr>

			</table>



<table class="table-bordered" width="100%">

				<tr>

					<td style="border:1px solid #cdcdcd;"><center><h4>INSTRUCTIONS PRIOR TO EMBRYO TRANSFER</h4></center></td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">LAST INJ.OF PROGESTERONE @ <?php echo isset($select_result['inj_progesterone_at'])?$select_result['inj_progesterone_at']:""; ?> on <?php echo isset($select_result['inj_progesterone_on'])?$select_result['inj_progesterone_on']:""; ?></td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">TAKE INJ. CLEXANE @ <?php echo isset($select_result['inj_clexane_at'])?$select_result['inj_clexane_at']:""; ?> on <?php echo isset($select_result['inj_clexane_on'])?$select_result['inj_clexane_on']:""; ?> </td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">Take Inj. HCG @ <?php echo isset($select_result['inj_hcg_at'])?$select_result['inj_hcg_at']:""; ?> on <?php echo isset($select_result['inj_hcg_on'])?$select_result['inj_hcg_on']:""; ?></td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">Embryo transfer on <?php echo isset($select_result['embryo_transfer_on'])?$select_result['embryo_transfer_on']:""; ?> @ <?php echo isset($select_result['embryo_transfer_at'])?$select_result['embryo_transfer_at']:""; ?></td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">Admit @ <?php echo isset($select_result['admit_at'])?$select_result['admit_at']:""; ?> in day care on <?php echo isset($select_result['admit_on'])?$select_result['admit_on']:""; ?> at <?php echo isset($select_result['admit_at2'])?$select_result['admit_at2']:""; ?></td>

				</tr>

			</table>




<table class="table-bordered" width="100%">

				<tr>

					<td colspan="2" style="border:1px solid #cdcdcd;"><b>Intra Operative orders</b></td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">

						

				 <?php if(isset($select_result['normal_diet']) && $select_result['normal_diet'] == "Yes"){echo 'yes'; }?>
				

				</td>

					<td>Normal diet</td>

				</tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">
                    <?php  

					  if(isset($select_result['report']) && $select_result['report'] == "Yes"){echo 'yes'; }?>
					
					</td>

					<td style="border:1px solid #cdcdcd;">To report if giddiness /nausea/vomiting/bleeding/pain/fever /purulent discharge immediately</td>

				</tr>

			</table>




			<table class="table-bordered" width="100%">

				<tr> <td style="border:1px solid #cdcdcd;">To take normal diet</td></tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">

						● Continue thyroid/antihypertensive/diabetes medications as have been taking previously<br>

						● To take normal diet<br>

						● To report in emergency of the hospital immediately if patient has abdominal pain/vaginal bleeding/fever/excessive cough/giddiness/vomiting<br>

						● SERUM BETA HCG ON <?php echo isset($select_result['serum_beta'])?$select_result['serum_beta']:""; ?>

					</td>

				</tr>

				<tr><td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['gestational_sac_no'])?$select_result['gestational_sac_no']:""; ?> No. of gestational sac on ultrasound on <?php echo isset($select_result['gestational_sac'])?$select_result['gestational_sac']:""; ?>.</td></tr>

				<tr><td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cardiac_activity_no'])?$select_result['cardiac_activity_no']:""; ?> No.of sac with cardiac activity on <?php echo isset($select_result['cardiac_activity'])?$select_result['cardiac_activity']:""; ?>.</td></tr>

				<tr>

					<td style="border:1px solid #cdcdcd;">

						Live birth on <?php echo isset($select_result['live_birth_on'])?$select_result['live_birth_on']:""; ?> @ <?php echo isset($select_result['live_birth_at'])?$select_result['live_birth_at']:""; ?> by <?php echo isset($select_result['live_birth_by'])?$select_result['live_birth_by']:""; ?>.Sex of child/children:

					 

                    <?php if(isset($select_result['sex_of_child']) && $select_result['sex_of_child'] == "Male"){echo 'Male'; }?>
					<?php if(isset($select_result['sex_of_child']) && $select_result['sex_of_child'] == "Female"){echo 'Female'; }?>


					</td>

				</tr>

			</table>








<!-- Main Table END -->
</table>
</div>







<script>
$(document).ready(function(){
	
	//alert();
  $(".ptable").click(function(){
      $('.searchform').hide();
   $('.printbtn').hide();
  $('.printbtn').css('display', 'hide');
 $('.prtable').css('display', 'block');
  var divToPrint=document.getElementById('printtable');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
  });
});
</script>