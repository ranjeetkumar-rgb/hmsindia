<?php $all_method =&get_instance();
$consultation_data = $all_method->get_consultation($appointments['ID']);
$patient_data = get_patient_detail($consultation_data['patient_id']);
//var_dump($consultation_data); echo '<br/><br/><br/>'; 
//var_dump($patient_data);die;
?>

<style>
	.table > thead > tr > th {
		vertical-align: top;
	}
	td {
		width: auto;
	}
	.border-field input.form-control {
		border: 1px solid;
		padding: 0;
	}
	[type="radio"]:checked+label:before, [type="radio"]:checked+label:after, [type="radio"]:not(:checked)+label:before, [type="radio"]:not(:checked)+label:after{display:none!important;}
	[type="radio"]:not(:checked), [type="radio"]:checked { position: relative!important;  left: 0!important; opacity: 1!important; }
	[type="radio"]:not(:checked)+label, [type="radio"]:checked+label{padding-left:0px!important; padding-right:5px!important;}
	.multiselect-container>li>a>label {
		padding: 4px 20px 3px 20px;
	}
	table#SOCIAl_DRUG_INTAKE_HISTORY td, #table_dentures td {
		width: 55%;
	}
	input[type="checkbox"] {
		position: relative!important;
		left: 2px!important;
		opacity: 1!important;
	}
	.open > .dropdown-menu {
		width: 350px;
		max-height: 300px;
		overflow: auto;
	}
	label.checkbox {
		color: #000;
	}
	.btn-group{
		max-width: 100%;
	}
	button.multiselect.dropdown-toggle.btn.btn-default {
		width: 100%;
		overflow:hidden;
	}
</style>

<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data" >
<input type="hidden" name="action" value="add_consultation_done" />
<input type="hidden" name="appointment_id" value="<?php echo $appointments['ID']; ?>" />
<input type="hidden" name="patient_id" value="<?php echo $patient_data['patient_id']; ?>" />
<input type="hidden" name="wife_phone" value="<?php echo $patient_data['wife_phone']; ?>" />
<input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $_SESSION['logged_doctor']['doctor_id']?>" />

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
					<!-- general form elements -->
					<div class="card card-primary">
						<!--   <div class="card-header">
							<h3 class="card-title">Quick Example</h3>
						</div> -->
						<!-- /.card-header -->
						<!-- form start -->
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<th></th>
								<th style="color: red;">Female</th>
								<th style="color: red;">Male</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<th style="color: red;">NAME</th>
									<td>
									<input type="text" class="form-control" name="female_name" readonly value="<?php echo $patient_data['wife_name']?>"  id="exampleInputEmail1" placeholder="Enter name">
									</td>
									<td>
									<input type="text" class="form-control" name="male_name" value="<?php echo $patient_data['husband_name']?>" id="exampleInputEmail1" placeholder="Enter name">
									</td>
								</tr>
								<tr>
									<th style="color: red;">AGE</th>
									<td>
                       <input type="number" class="form-control" name="female_age" id="exampleInputEmail1" placeholder="Enter your age">
                    </td>
                    <td>
                      <input type="number" class="form-control" name="male_age" id="exampleInputEmail1" placeholder="Enter your age">
                    </td>
                    </tr>
                    <tr>
                    <th style="color: red;">OCCUPATION</th>
                    <td><input type="text" class="form-control" name="female_occupation" id="exampleInputEmail1" placeholder="Enter your Occupation"></td>
                    <td><input type="text" class="form-control" name="male_occupation"  id="exampleInputEmail1" placeholder="Enter your Occupation"></td>
                  </tr>
                  <tr>
                    <th style="color: red;">NATIONALITY</th>
                    <td><input type="text" class="form-control" name="female_nationality" id="exampleInputEmail1" placeholder="Enter your Nationality"></td>
                    <td><input type="text" class="form-control" name="male_nationality" id="exampleInputEmail1" placeholder="Enter your Nationality"></td>
                  </tr>
                  <tr>
                    <th style="color: red;">ETHNICITY</th>
                    <td><input type="text" class="form-control" name="female_ethnicity" id="exampleInputEmail1" placeholder="Enter your Ethnicity"></td>
                    <td><input type="text" class="form-control" name="male_ethnicity" id="exampleInputEmail1" placeholder="Enter your Ethnicity"></td>
                  </tr>
                  <tr>
                    <th style="color: red;">WT/HT/BMI</th>
                   <td><input type="text" class="form-control" name="female_wt_ht_bmi" id="exampleInputEmail1" ></td>
                    <td><input type="text" class="form-control" name="male_wt_ht_bmi" id="exampleInputEmail1"></td>
                  </tr>
                  <tr>
                    <th style="color: red;">
						H/O PREVIOUS PREGNANCIES<br>
						(IN PREVIOUS RELATIONSHIPS ,MARRIAGES ALSO )
					</th>
					<td>
						<!-- <h1 style="margin-top:50px;">Tick the right option</h1> -->
						<table width="100%">
							<tr>
								<td><p style="color: red;">Total pregnancies</p></td>
								<td><input type="number" name="female_total_pregnancies" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of live births</p></td>
								<td><input type="number" name="female_live_birth" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of spontaneous abortions in first trimester</p></td>
								<td><input type="number" name="female_spontaneous_abortions" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of termination of pregnancy</p></td>
								<td><input type="number" name="female_termination_pregnancy" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of still births</p></td>
								<td><input type="number" name="female_still_births" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No. of ectopic pregnancy</p></td>
								<td><input type="number" name="female_ectopic_pregnancy" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">History of any abnormality in child</p></td>
								<td><input type="number" name="female_abnormality_child" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">Others</p></td>
								<td><input type="text" name="female_pregnancy_other" class="form-control"></td>
							</tr>
						</table>
					</td>
					<td>
						<!-- <h1 style="margin-top:50px;">Tick the right option</h1> -->
						<table width="100%">
							<tr>
								<td><p style="color: red;">Total pregnancies</p></td>
								<td><input type="number" name="male_total_pregnancies" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of live births</p></td>
								<td><input type="number" name="male_live_birth" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of spontaneous abortions in first trimester</p></td>
								<td><input type="number" name="male_spontaneous_abortions" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of termination of pregnancy</p></td>
								<td><input type="number" name="male_termination_pregnancy" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No.of still births</p></td>
								<td><input type="number" name="male_still_births" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">No. of ectopic pregnancy</p></td>
								<td><input type="number" name="male_ectopic_pregnancy" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">History of any abnormality in child</p></td>
								<td><input type="number" name="male_abnormality_child" class="form-control"></td>
							</tr>
							<tr>
								<td><p style="color: red;">Others</p></td>
								<td><input type="text" name="male_pregnancy_other" class="form-control"></td>
							</tr>
						</table>
					</tr>
					<tr>
                    <th style="color: red;">SEXUAL HISTORY</th>
                    <td>
						<center><p style="color: red;">Marital life</p></center>
						<table>
							<tr>
								<td>Active marital life</td>
								<td><input type="text" name="female_active_marital" class="form-control"></td>
							</tr>
							<tr>
								<td>No.of sexual partners</td>
								<td><input type="text" name="female_sexual_partners" class="form-control"></td>
							</tr>
							<tr>
								<td>Duration of sexual partners</td>
								<td><input type="text" name="female_duration_sexual" class="form-control"></td>
							</tr>
							<tr>
								<td>Frequency of sexual intercourse</td>
								<td><input type="text" name="female_frequency_sexual" class="form-control"></td>
							</tr>
							<tr>
								<td>Contraception used</td>
								<td><input type="text" name="female_contraception" class="form-control"></td>
							</tr>
							<tr>
								<td>Others</td>
								<td><input type="text" name="female_sexual_other" class="form-control"></td>
							</tr>
						</table>
					</td>
					<td>
						<center><p style="color: red;">Marital life</p></center>
						<table>
							<tr>
								<td>Active marital life</td>
								<td><input type="text" name="male_active_marital" class="form-control"></td>
							</tr>
							<tr>
								<td>No.of sexual partners</td>
								<td><input type="text" name="male_sexual_partners" class="form-control"></td>
							</tr>
							<tr>
								<td>Duration of sexual partners</td>
								<td><input type="text" name="male_duration_sexual" class="form-control"></td>
							</tr>
							<tr>
								<td>Frequency of sexual intercourse</td>
								<td><input type="text" name="male_frequency_sexual" class="form-control"></td>
							</tr>
							<tr>
								<td>Contraception used</td>
								<td><input type="text" name="male_contraception" class="form-control"></td>
							</tr>
							<tr>
								<td>Erection disorder</td>
								<td><input type="text" name="male_erection_disorder" class="form-control"></td>
							</tr>
							<tr>
								<td>Ejaculation disorder</td>
								<td><input type="text" name="male_ejaculation_disorder" class="form-control"></td>
							</tr>
							<tr>
								<td>Others</td>
								<td><input type="text" name="male_sexual_other" class="form-control"></td>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
						<th style="color: red;">TYPE OF INFERTILITY</th>
						<td>
							<input type="radio" name="female_intertiliy_type" value="Primary">
							<label for="age1">Primary</label>
							<input type="radio" name="female_intertiliy_type" value="Secondary">
							<label for="age2">Secondary</label>
						</td>
						<td>
							<input type="radio" name="male_intertiliy_type" value="30">
							<label for="age1">Primary</label>
							<input type="radio" name="male_intertiliy_type" value="60">
							<label for="age2">Secondary</label>
						</td>
					</tr>
					<tr>
						<th style="color: red;">PAST GYNECOLOGICAL/UROLOGICAL HISTORY</th>
						<td>
							<table>
								<tr>
									<td>Dysmenorrhea</td>
									<td><input type="text" name="female_dysmenorrhea" class="form-control"></td>
								</tr>
								<tr>
									<td>Menorrhagia</td>
									<td><input type="text" name="female_menorrhagia" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">H/o D and c</td>
									<td><input type="text" name="female_h_o_dandc" class="form-control"></td>
								</tr>
								<tr>
									<td>Dyspareunia</td>
									<td><input type="text" name="female_dyspareunia" class="form-control"></td>
								</tr>
								<tr>
									<td>Others</td>
									<td><input type="text" name="female_history_other" class="form-control"></td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td>Orchidopexies</td>
									<td><input type="text" name="male_orchidopexies" class="form-control"></td>
								</tr>
								<tr>
									<td>Mumps/orchitis</td>
									<td><input type="text" name="male_mumps_orchitis" class="form-control"></td>
								</tr>
								<tr>
									<td>Hernia</td>
									<td><input type="text" name="male_hernia" class="form-control"></td>
								</tr>
								<tr>
									<td>Varicocele</td>
									<td><input type="text" name="male_varicocele" class="form-control"></td>
								</tr>
								<tr>
									<td>Others</td>
									<td><input type="text" name="male_history_other" class="form-control"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">MENSTRUATION HISTORY</th>
						<td>
							<table>
								<tr>
									<td>Age at menarche</td>
									<td><input type="text" name="female_menarche_age" class="form-control"></td>
								</tr>
								<tr>
									<td>Flow- heavy/average/less</td>
									<td><input type="text" name="female_flow" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Frequency- regular /irregular</td>
									<td><input type="text" name="female_frequency" class="form-control"></td>
								</tr>
								<tr>
									<td>Days</td>
									<td><input type="text" name="female_days" class="form-control"></td>
								</tr>
								<tr>
									<td>Hirsutism</td>
									<td><input type="text" name="female_hirsutism" class="form-control"></td>
								</tr>
								<tr>
									<td>Galactorrhea</td>
									<td><input type="text" name="female_galactorrhea" class="form-control"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">PAST /PRESENT MEDICAL HISTORY</th>
						<td>
							<table width="100%">
								<tr>
									<td>Heart attack</td>
												<td>
													<input type="radio" id="text1" name="heart_attack" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="heart_attack" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="heart_attack_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Pacemaker</td>
												<td>
													<input type="radio" id="text1" name="pacemaker" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="pacemaker" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="pacemaker_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Other heart disease</td>
												<td>
													<input type="radio" id="text1" name="other_heart_disease" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="other_heart_disease" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="other_heart_disease_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>High blood pressure</td>
												<td>
													<input type="radio" id="text1" name="high_blood_pressure" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="high_blood_pressure" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="high_blood_pressure_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Blood clots</td>
												<td>
													<input type="radio" id="text1" name="blood_clots" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="blood_clots" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="blood_clots_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Chest pain</td>
												<td>
													<input type="radio" id="text1" name="chest_pain" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="chest_pain" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="chest_pain_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Stroke</td>
												<td>
													<input type="radio" id="text1" name="stroke" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="stroke" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="stroke_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Asthma</td>
												<td>
													<input type="radio" id="text1" name="asthma" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="asthma" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="asthma_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Other lung disease</td>
												<td>
													<input type="radio" id="text1" name="lung_disease" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="lung_disease" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="lung_disease_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Difficulty breathing</td>
												<td>
													<input type="radio" id="text1" name="difficulty_breathing" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="difficulty_breathing" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="difficulty_breathing_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Sleep apnea or snoring</td>
												<td>
													<input type="radio" id="text1" name="snoring" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="snoring" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="snoring_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Epilepsy or seizures</td>
												<td>
													<input type="radio" id="text1" name="epilepsy" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="epilepsy" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="epilepsy_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Fainting spells</td>
												<td>
													<input type="radio" id="text1" name="fainting_spells" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="fainting_spells" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="fainting_spells_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Diabetes</td>
												<td>
													<input type="radio" id="text1" name="diabetes" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="diabetes" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="diabetes_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Muscle disorders</td>
												<td>
													<input type="radio" id="text1" name="muscle_disorders" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="muscle_disorders" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="muscle_disorders_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Kidney disease</td>
												<td>
													<input type="radio" id="text1" name="kidney_disease" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="kidney_disease" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="kidney_disease_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Hepatitis</td>
												<td>
													<input type="radio" id="text1" name="hepatitis" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="hepatitis" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="hepatitis_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Tuberculosis</td>
												<td>
													<input type="radio" id="text1" name="tuberculosis" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="tuberculosis" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="tuberculosis_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>HIV</td>
												<td>
													<input type="radio" id="text1" name="hiv" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="hiv" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="hiv_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Heart burn/reflux</td>
												<td>
													<input type="radio" id="text1" name="heart_burn" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="heart_burn" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="heart_burn_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Cancer </td>
												<td>
													<input type="radio" id="text1" name="cancer" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="cancer" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="cancer_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Blood disorders</td>
												<td>
													<input type="radio" id="text1" name="blood_disorders" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="blood_disorders" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="blood_disorders_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Rheumatic disease</td>
												<td>
													<input type="radio" id="text1" name="rheumatic_disease" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="rheumatic_disease" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="rheumatic_disease_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Psychiatric disorder</td>
												<td>
													<input type="radio" id="text1" name="psychiatric_disorder" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="psychiatric_disorder" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="psychiatric_disorder_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Thyroid disorder</td>
												<td>
													<input type="radio" id="text1" name="thyroid_disorder" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="thyroid_disorder" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="thyroid_disorder_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Urinary infection</td>
												<td>
													<input type="radio" id="text1" name="urinary_infection" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="urinary_infection" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="urinary_infection_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Sexually transmitted disease</td>
												<td>
													<input type="radio" id="text1" name="sexually_transmitted" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="sexually_transmitted" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="sexually_transmitted_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Other medical condition or impairments</td>
									<td>
										<input type="text" maxlength="50" class="form-control">
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="100%">
								<tr>
									<td>Heart attack</td>
												<td>
													<input type="radio" id="text1" name="male_heart_attack" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_heart_attack" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_heart_attack_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Pacemaker</td>
												<td>
													<input type="radio" id="text1" name="male_pacemaker" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_pacemaker" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_pacemaker_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Other heart disease</td>
												<td>
													<input type="radio" id="text1" name="male_other_heart_disease" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_other_heart_disease" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_other_heart_disease_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>High blood pressure</td>
												<td>
													<input type="radio" id="text1" name="male_high_blood_pressure" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_high_blood_pressure" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_high_blood_pressure_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Blood clots</td>
												<td>
													<input type="radio" id="text1" name="male_blood_clots" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_blood_clots" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_blood_clots_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Chest pain</td>
												<td>
													<input type="radio" id="text1" name="male_chest_pain" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_chest_pain" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_chest_pain_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Stroke</td>
												<td>
													<input type="radio" id="text1" name="male_stroke" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_stroke" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_stroke_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Asthma</td>
												<td>
													<input type="radio" id="text1" name="male_asthma" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_asthma" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_asthma_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Other lung disease</td>
												<td>
													<input type="radio" id="text1" name="male_lung_disease" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_lung_disease" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_lung_disease_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Difficulty breathing</td>
												<td>
													<input type="radio" id="text1" name="male_difficulty_breathing" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_difficulty_breathing" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_difficulty_breathing_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Sleep apnea or snoring</td>
												<td>
													<input type="radio" id="text1" name="male_snoring" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_snoring" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_snoring_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Epilepsy or seizures</td>
												<td>
													<input type="radio" id="text1" name="male_epilepsy" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_epilepsy" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_epilepsy_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Fainting spells</td>
												<td>
													<input type="radio" id="text1" name="male_fainting_spells" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_fainting_spells" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_fainting_spells_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Diabetes</td>
												<td>
													<input type="radio" id="text1" name="male_diabetes" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_diabetes" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_diabetes_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Muscle disorders</td>
												<td>
													<input type="radio" id="text1" name="male_muscle_disorders" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_muscle_disorders" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_muscle_disorders_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Kidney disease</td>
												<td>
													<input type="radio" id="text1" name="male_kidney_disease" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_kidney_disease" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_kidney_disease_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Hepatitis</td>
												<td>
													<input type="radio" id="text1" name="male_hepatitis" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_hepatitis" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_hepatitis_text" style="display:none;">
												</td>
								</tr>
								<tr>
									<td>Tuberculosis</td>
									<td>
										<input type="radio" id="text1" name="male_tuberculosis" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="male_tuberculosis" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="male_tuberculosis_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>HIV</td>
									<td>
										<input type="radio" id="text1" name="male_hiv" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="male_hiv" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="male_hiv_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Heart burn/reflux</td>
									<td>
										<input type="radio" name="male_heart_burn" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_heart_burn" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_heart_burn_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Cancer </td>
									<td>
										<input type="radio" name="male_cancer" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_cancer" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_cancer_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Blood disorders</td>
									<td>
										<input type="radio" name="male_blood_disorders" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_blood_disorders" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_blood_disorders_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Rheumatic disease</td>
									<td>
										<input type="radio" name="male_rheumatic_disease" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_rheumatic_disease" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_rheumatic_disease_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Psychiatric disorder</td>
									<td>
										<input type="radio" name="male_psychiatric_disorder" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_psychiatric_disorder" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_psychiatric_disorder_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Thyroid disorder</td>
									<td>
										<input type="radio" name="male_thyroid_disorder" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_thyroid_disorder" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_thyroid_disorder_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Urinary infection</td>
									<td>
										<input type="radio" name="male_urinary_infection" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_urinary_infection" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_urinary_infection_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Sexually transmitted disease</td>
									<td>
										<input type="radio" name="male_sexually_transmitted" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="male_sexually_transmitted" value="No" checked>
										<label for="type2">No</label>
										<input type="text" maxlength="25" name="male_sexually_transmitted_text" style="display:none;">
									</td>
								</tr>
								<tr>
									<td>Other medical condition or impairments</td>
									<td>
										<input type="text" maxlength="50" class="form-control">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">PAST ANESTHESIA AND SURGICAL PROCEDURES</th>
						<td>
							<table>
								<tr>
									<td>Laparoscopy/pelvic/abdominal operations</td>
									<td>
										<p>
										<input type="radio" id="text1" name="abdominal_operations" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="abdominal_operations" value="No" checked>
										<label>No</label></p>
										<p>
										<input type="text" maxlength="25" name="abdominal_operations_text">
										</p>
									</td>
								</tr>
								<tr>
									<td>Other operations</td>
									<td>
										<input type="radio" id="text1" name="other_operations" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="other_operations" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="other_operations_text">
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td>Laparoscopy/pelvic/abdominal operations</td>
									<td>
										<input type="radio" id="text1" name="male_abdominal_operations" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="male_abdominal_operations" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="male_abdominal_operations_text">
									</td>
								</tr>
								<tr>
									<td>Other operations</td>
									<td>
										<input type="radio" id="text1" name="male_other_operations" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="male_other_operations" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="male_other_operations_text">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">ALLERGY HISTORY</th>
						<td>
							<table width="100%">
								<tr>
									<td>Medications</td>
									<td>
										<input type="radio" id="text1" name="medications" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="medications" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="medications_text">
									</td>
								</tr>
								<tr>
									<td>environmental factors</td>
									<td>
										<input type="radio" id="text1" name="environmental_factors" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="environmental_factors" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="environmental_factors_text">
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="100%">
								<tr>
									<td>Medications</td>
									<td>
										<input type="radio" id="text1" name="male_medications" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="male_medications" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="male_medications_text">
									</td>
								</tr>
								<tr>
									<td>environmental factors</td>
									<td>
										<input type="radio" id="text1" name="male_environmental_factors" value="Yes">
										<label>Yes</label>
										<input type="radio" id="text1" name="male_environmental_factors" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="male_environmental_factors_text">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">SOCIAL & DRUG INTAKE HISTORY</th>
						<td>
							<table>
								<tr>
									<td>Dentures</td>
												<td width="30%">
													<input type="radio" id="text1" name="dentures" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="dentures" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="dentures_text">
												</td>
								</tr>
								<tr>
									<td>Loose teeth</td>
												<td>
													<input type="radio" id="text1" name="loose_teeth" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="loose_teeth" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="loose_teeth_text">
												</td>
								</tr>
								<tr>
									<td>Hearing aid</td>
												<td>
													<input type="radio" id="text1" name="hearing_aid" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="hearing_aid" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="hearing_aid_text">
												</td>
								</tr>
								<tr>
									<td>Caps on front teeth</td>
												<td>
													<input type="radio" id="text1" name="caps_on_front_teeth" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="caps_on_front_teeth" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="caps_on_front_teeth_text">
												</td>
								</tr>
								<tr>
									<td>Contact lenses</td>
												<td>
													<input type="radio" id="text1" name="contact_lenses" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="contact_lenses" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="contact_lenses_text">
												</td>
								</tr>
								<tr>
									<td>Body piercing</td>
												<td>
													<input type="radio" id="text1" name="body_piercing" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="body_piercing" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="body_piercing_text">
												</td>
								</tr>
								<tr>
									<td>H/o blood transfusion</td>
												<td>
													<input type="radio" id="text1" name="blood_transfusion" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="blood_transfusion" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="blood_transfusion_text">
												</td>
								</tr>
								<tr>
									<td>H/o road traffic accident/any injury</td>
												<td>
													<input type="radio" id="text1" name="traffic_accident" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="traffic_accident" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="traffic_accident_text">
												</td>
								</tr>
								<tr>
									<td>Smoke(past)daily</td>
												<td>
													<input type="radio" id="text1" name="smoke_past" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="smoke_past" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="smoke_past_text">
												</td>
								</tr>
								<tr>
									<td>Smoke(present)daily</td>
												<td>
													<input type="radio" id="text1" name="smoke_present" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="smoke_present" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="smoke_present_text">
												</td>
								</tr>
								<tr>
									<td>Drink(past)units per week</td>
												<td>
													<input type="radio" id="text1" name="drink_past" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="drink_past" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="drink_past_text">
												</td>
								</tr>
								<tr>
									<td>Drink(present)units per week</td>
												<td>
													<input type="radio" id="text1" name="drink_present" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="drink_present" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="drink_present_text">
												</td>
								</tr>
								<tr>
									<td>Hashish/cocaine /abusive drugs</td>
												<td>
													<input type="radio" id="text1" name="abusive_drugs" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="abusive_drugs" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="abusive_drugs_text">
												</td>
								</tr>
								<tr>
									<td>Have you ever used cortisone/steroid</td>
												<td>
													<input type="radio" id="text1" name="steroid" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="steroid" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="steroid_text">
												</td>
								</tr>
								<tr>
									<td>Medication</td>
												<td>
													<input type="radio" id="text1" name="medication" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="medication" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="medication_text">
												</td>
								</tr>
								<tr>
									<td>Herbal products</td>
												<td>
													<input type="radio" id="text1" name="herbal_products" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="herbal_products" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="herbal_products_text">
												</td>
								</tr>
								<tr>
									<td>Eye drops</td>
												<td>
													<input type="radio" id="text1" name="eye_drops" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="eye_drops" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="eye_drops_text">
												</td>
								</tr>
								<tr>
									<td>Non prescription drugs used currently other than medications used for this IVF cycle</td>
												<td>
													<input type="radio" id="text1" name="non_prescription_drugs" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="non_prescription_drugs" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="non_prescription_drugs_text">
												</td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td>Dentures</td>
												<td width="30%">
													<input type="radio" id="text1" name="male_dentures" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_dentures" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_dentures_text">
												</td>
								</tr>
								<tr>
									<td>Loose teeth</td>
												<td>
													<input type="radio" id="text1" name="male_loose_teeth" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_loose_teeth" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_loose_teeth_text">
												</td>
								</tr>
								<tr>
									<td>Hearing aid</td>
												<td>
													<input type="radio" id="text1" name="male_hearing_aid" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_hearing_aid" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_hearing_aid_text">
												</td>
								</tr>
								<tr>
									<td>Caps on front teeth</td>
												<td>
													<input type="radio" id="text1" name="male_caps_on_front_teeth" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_caps_on_front_teeth" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_caps_on_front_teeth_text">
												</td>
								</tr>
								<tr>
									<td>Contact lenses</td>
												<td>
													<input type="radio" id="text1" name="male_contact_lenses" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_contact_lenses" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_contact_lenses_text">
												</td>
								</tr>
								<tr>
									<td>Body piercing</td>
												<td>
													<input type="radio" id="text1" name="male_body_piercing" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_body_piercing" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_body_piercing_text">
												</td>
								</tr>
								<tr>
									<td>H/o blood transfusion</td>
												<td>
													<input type="radio" id="text1" name="male_blood_transfusion" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_blood_transfusion" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_blood_transfusion_text">
												</td>
								</tr>
								<tr>
									<td>H/o road traffic accident/any injury</td>
												<td>
													<input type="radio" id="text1" name="male_traffic_accident" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_traffic_accident" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_traffic_accident_text">
												</td>
								</tr>
								<tr>
									<td>Smoke(past)daily</td>
												<td>
													<input type="radio" id="text1" name="male_smoke_past" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_smoke_past" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_smoke_past_text">
												</td>
								</tr>
								<tr>
									<td>Smoke(present)daily</td>
												<td>
													<input type="radio" id="text1" name="male_smoke_present" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_smoke_present" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_smoke_present_text">
												</td>
								</tr>
								<tr>
									<td>Drink(past)units per week</td>
												<td>
													<input type="radio" id="text1" name="male_drink_past" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_drink_past" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_drink_past_text">
												</td>
								</tr>
								<tr>
									<td>Drink(present)units per week</td>
												<td>
													<input type="radio" id="text1" name="male_drink_present" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_drink_present" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_drink_present_text">
												</td>
								</tr>
								<tr>
									<td>Hashish/cocaine /abusive drugs</td>
												<td>
													<input type="radio" id="text1" name="male_abusive_drugs" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_abusive_drugs" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_abusive_drugs_text">
												</td>
								</tr>
								<tr>
									<td>Have you ever used cortisone/steroid</td>
												<td>
													<input type="radio" id="text1" name="male_steroid" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_steroid" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_steroid_text">
												</td>
								</tr>
								<tr>
									<td>Medication</td>
												<td>
													<input type="radio" id="text1" name="male_medication" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_medication" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_medication_text">
												</td>
								</tr>
								<tr>
									<td>Herbal products</td>
												<td>
													<input type="radio" id="text1" name="male_herbal_products" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_herbal_products" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_herbal_products_text">
												</td>
								</tr>
								<tr>
									<td>Eye drops</td>
												<td>
													<input type="radio" id="text1" name="male_eye_drops" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_eye_drops" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_eye_drops_text">
												</td>
								</tr>
								<tr>
									<td>Non prescription drugs used currently other than medications used for this IVF cycle</td>
												<td>
													<input type="radio" id="text1" name="male_non_prescription_drugs" value="Yes">
													<label>Yes</label>
													<input type="radio" id="text1" name="male_non_prescription_drugs" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_non_prescription_drugs_text">
												</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">FAMILY HISTORY</th>
						<td>
							<table width="100%">
								<tr>
									<td>Any family member any problem <br> with anesthesia</td>
									<td>
										<input type="radio" name="member_with_anesthesia" value="Yes">
										<label>Yes</label>
										<input type="radio" name="member_with_anesthesia" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="member_with_anesthesia_text">
									</td>
								</tr>
							</table>
							<table>
											<tr>
												<td></td>
												<td>Maternal</td>
												<td>Paternal</td>
											</tr>
											<tr>
												<td>Diabetes</td>
												<td>
													<input type="radio" name="maternal_diabetes" value="Yes">
													<label>Yes</label>
													<input type="radio" name="maternal_diabetes" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="maternal_diabetes_text">
												</td>
												<td>
													<input type="radio" name="paternal_diabetes" value="Yes">
													<label>Yes</label>
													<input type="radio" name="paternal_diabetes" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="paternal_diabetes_text">
												</td>
											</tr>
											<tr>
												<td>Heart/thrombo embolism</td>
												<td>
													<input type="radio" name="maternal_thrombo_embolism" value="Yes">
													<label>Yes</label>
													<input type="radio" name="maternal_thrombo_embolism" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="maternal_thrombo_embolism_text">
												</td>
												<td>
													<input type="radio" name="paternal_thrombo_embolism" value="Yes">
													<label>Yes</label>
													<input type="radio" name="paternal_thrombo_embolism" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="paternal_thrombo_embolism_text">
												</td>
											</tr>
											<tr>
												<td>Endocrine/metabolic</td>
												<td>
													<input type="radio" name="maternal_metabolic" value="Yes">
													<label>Yes</label>
													<input type="radio" name="maternal_metabolic" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="maternal_metabolic_text">
												</td>
												<td>
													<input type="radio" name="paternal_metabolic" value="Yes">
													<label>Yes</label>
													<input type="radio" name="paternal_metabolic" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="paternal_metabolic_text">
												</td>
											</tr>
											<tr>
												<td>Urinary tract/renal</td>
												<td>
													<input type="radio" name="maternal_urinary_tract" value="Yes">
													<label>Yes</label>
													<input type="radio" name="maternal_urinary_tract" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="maternal_urinary_tract_text">
												</td>
												<td>
													<input type="radio" name="paternal_urinary_tract" value="Yes">
													<label>Yes</label>
													<input type="radio" name="paternal_urinary_tract" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="paternal_urinary_tract_text">
												</td>
											</tr>
											<tr>
												<td>Psychiatric/neurological</td>
												<td>
													<input type="radio" name="maternal_neurological" value="Yes">
													<label>Yes</label>
													<input type="radio" name="maternal_neurological" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="maternal_neurological_text">
												</td>
												<td>
													<input type="radio" name="paternal_neurological" value="Yes">
													<label>Yes</label>
													<input type="radio" name="paternal_neurological" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="paternal_neurological_text">
												</td>
											</tr>
											<tr>
												<td>Other/malignancy</td>
												<td>
													<input type="radio" name="maternal_malignancy" value="Yes">
													<label>Yes</label>
													<input type="radio" name="maternal_malignancy" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="maternal_malignancy_text">
												</td>
												<td>
													<input type="radio" name="paternal_malignancy" value="Yes">
													<label>Yes</label>
													<input type="radio" name="paternal_malignancy" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="paternal_malignancy_text">
												</td>
											</tr>
										</table>
						</td>
						<td>
							<table width="100%">
								<tr>
									<td>Any family member any problem <br> with anesthesia</td>
									<td>
										<input type="radio" name="male_member_with_anesthesia" value="Yes">
										<label>Yes</label>
										<input type="radio" name="male_member_with_anesthesia" value="No" checked>
										<label>No</label>
										<input type="text" maxlength="25" name="male_member_with_anesthesia_text">
									</td>
								</tr>
							</table>
							<table>
											<tr>
												<td></td>
												<td>Maternal</td>
												<td>Paternal</td>
											</tr>
											<tr>
												<td>Diabetes</td>
												<td>
													<input type="radio" name="male_maternal_diabetes" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_maternal_diabetes" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_maternal_diabetes_text">
												</td>
												<td>
													<input type="radio" name="male_paternal_diabetes" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_paternal_diabetes" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_paternal_diabetes_text">
												</td>
											</tr>
											<tr>
												<td>Heart/thrombo embolism</td>
												<td>
													<input type="radio" name="male_maternal_thrombo_embolism" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_maternal_thrombo_embolism" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_maternal_thrombo_embolism_text">
												</td>
												<td>
													<input type="radio" name="male_paternal_thrombo_embolism" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_paternal_thrombo_embolism" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_paternal_thrombo_embolism_text">
												</td>
											</tr>
											<tr>
												<td>Endocrine/metabolic</td>
												<td>
													<input type="radio" name="male_maternal_metabolic" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_maternal_metabolic" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_maternal_metabolic_text">
												</td>
												<td>
													<input type="radio" name="male_paternal_metabolic" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_paternal_metabolic" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_paternal_metabolic_text">
												</td>
											</tr>
											<tr>
												<td>Urinary tract/renal</td>
												<td>
													<input type="radio" name="male_maternal_urinary_tract" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_maternal_urinary_tract" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_maternal_urinary_tract_text">
												</td>
												<td>
													<input type="radio" name="male_paternal_urinary_tract" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_paternal_urinary_tract" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_paternal_urinary_tract_text">
												</td>
											</tr>
											<tr>
												<td>Psychiatric/neurological</td>
												<td>
													<input type="radio" name="male_maternal_neurological" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_maternal_neurological" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_maternal_neurological_text">
												</td>
												<td>
													<input type="radio" name="male_paternal_neurological" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_paternal_neurological" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_paternal_neurological_text">
												</td>
											</tr>
											<tr>
												<td>Other/malignancy</td>
												<td>
													<input type="radio" name="male_maternal_malignancy" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_maternal_malignancy" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_maternal_malignancy_text">
												</td>
												<td>
													<input type="radio" name="male_paternal_malignancy" value="Yes">
													<label>Yes</label>
													<input type="radio" name="male_paternal_malignancy" value="No" checked>
													<label>No</label>
													<input type="text" maxlength="25" name="male_paternal_malignancy_text">
												</td>
											</tr>
										</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">PAST INVESTIGATIONS</th>
						<td>
							<p><b style="color: red;">SERUM AMH</b></p>
							<table width="100%">
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_amh_dt_1" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_amh_dt_result_1" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_amh_dt_2" class="form-control datepicker"></td>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_amh_dt_result_2" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_amh_dt_3" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_amh_dt_result_3" min="0" class="form-control"></td>
								</tr>
							</table>
							<br>
							<p><b style="color: red;">SERUM FSH</b></p>
							<table width="100%">
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_fsh_dt_1" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_fsh_dt_result_1" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_fsh_dt_2" class="form-control datepicker"></td>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_fsh_dt_result_2" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_fsh_dt_3" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_fsh_dt_result_3" min="0" class="form-control"></td>
								</tr>
							</table>
							<br>
							<p><b style="color: red;">HSG</b></p>
							<table width="100%">
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_hsg_dt_1" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_fsh_dt_result_1" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_hsg_dt_2" class="form-control datepicker"></td>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_fsh_dt_result_2" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_hsg_dt_3" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_fsh_dt_result_3" min="0" class="form-control"></td>
								</tr>
							</table>
							<br>
							<p><b style="color: red;">USG OF PELVIS</b></p>
							<table width="100%">
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_pelvis_dt_1" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_pelvis_dt_result_1" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_pelvis_dt_2" class="form-control datepicker"></td>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_pelvis_dt_result_2" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" placeholder="yy-mm-dd" name="female_pelvis_dt_3" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="female_pelvis_dt_result_3" min="0" class="form-control"></td>
								</tr>
							</table>
							<br>
							<table width="100%">
								<tr>
									<td style="color: red;">Others</td>
									<td><input type="text" name="female_past_investigation_others" class="form-control"></td>
								</tr>
							</table>
						</td>
						<td>
							<p><b style="color: red;">SEMEN ANALYSIS</b></p>
							<table width="100%">
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_semen_dt_1" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_semen_dt_result_1" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_semen_dt_2" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_semen_dt_result_2" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_semen_dt_3" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_semen_dt_result_3" min="0" class="form-control"></td>
								</tr>
							</table>
							<br>
							<p><b style="color: red;">SERUM FSH</b></p>
							<table width="100%">
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text"  name="male_fsh_dt_1" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number"  name="male_fsh_dt_result_1" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_fsh_dt_2" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_fsh_dt_result_2" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_fsh_dt_3" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_fsh_dt_result_3" min="0" class="form-control"></td>
								</tr>
							</table>
							<br>
							<p><b style="color: red;">SERUM TESTOSTERONE</b></p>
							<table width="100%">
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_testost_dt_1" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_testost_dt_result_1" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_testost_dt_2" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_testost_dt_result_2" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">DT</td>
									<td><input type="text" name="male_testost_dt_3" placeholder="yy-mm-dd" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: green;">RESULT(Ng/ml)</td>
									<td><input type="number" name="male_testost_dt_result_3" min="0" class="form-control"></td>
								</tr>
							</table>
							<br>
							<table width="100%">
								<tr>
									<td style="color: red;">Others</td>
									<td><input type="text" name="male_past_investigation_others" class="form-control"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">PREVIOUS INFERTILITY TREATMENT DETAILS </th>
						<td>
							<table>
								<tr>
									<td style="color: red;">YEARS OF TAKING INFERTILITY TREATMENT</td>
									<td><input type="number" name="female_infertility_treatment_years" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">OVULATION INDUCTION DRUGS HOW MANY CYCLES</td>
									<td><input type="number" name="female_induction_drugs_cycles" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>OVULATION INDUCTION INJECTION TAKEN HOW MANY CYCLES</td>
									<td><input type="number" name="female_induction_injection_cycles" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">TOTAL NO. OF IUI CYCLES</td>
									<td><input type="number" name="female_iui_cycles" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">TOTAL NO. OF IVF/ICSI CYCLES</td>
									<td><input type="number" name="female_ivf_icsi_cycles" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: green;">Total No. OF STIMULATED IVF CYCLES</td>
									<td><input type="number" name="female_stimulated_ivf_cycles" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: green;">Total No. cycles with no evidence of fertilization</td>
									<td><input type="number" name="female_no_evidence_fertilization" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>NO. OF EGGS RETREIVED EACH CYCLE</td>
									<td><input type="text" name="female_egg_retreived" maxlength="100" class="form-control"></td>
								</tr>
								<tr>
									<td>NO. OF FRESH CYCLE</td>
									<td><input type="number" name="female_fresh_cycle" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>NO. OF FROZEN CYCLE</td>
									<td><input type="number" name="female_frozen_cycle" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>NO. OF CYCLE OF DONOR EGG</td>
									<td><input type="number" name="female_donor_egg" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>NO.OF CYCLE OF DONOR SPERM</td>
									<td><input type="number" name="female_donor_sperm" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>NO.OF CYCLE OF SURROGACY</td>
									<td><input type="number" name="female_surrogacy" min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>OTHERS</td>
									<td><input type="text" name="female_infertility_treatment_others" maxlength="50" class="form-control"></td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td>MEDICATIONS FOR SPERM</td>
									<td><input type="text" name="medication_for_sperm" maxlength="50" class="form-control"></td>
								</tr>
								<tr>
									<td colspan="2" style="color: red;">FNAC TESTES DONE WITH REPORT</td>
								</tr>
								<tr>
									<td>NO. OF TIMES TESA DONE</td>
									<td><input type="number" name="no_of_tesa"  min="0" class="form-control"></td>
								</tr>
								<tr>
									<td>TESA REPORT</td>
									<td><input type="text" name="tesa_report"  maxlength="100" class="form-control"></td>
								</tr>
								<tr>
									<td>TESE REPORT</td>
									<td><input type="text" name="tese_report"  maxlength="100" class="form-control"></td>
								</tr>
								<tr>
									<td>MICRO TESE</td>
									<td><input type="text" name="micro_tese"  maxlength="100" class="form-control"></td>
								</tr>
								<tr>
									<td>OTHERS</td>
									<td><input type="text" name="other_s" maxlength="100" class="form-control"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th>OTHERS</th>
						<td><input type="text" name="female_others_msg" maxlength="100" class="form-control"></td>
						<td><input type="text" name="male_others_msg" maxlength="100" class="form-control"></td>
					</tr>
					<tr>
						<th style="color: red;">GENERAL EXAMINATION</th>
						<td>
							<table>
								<tr>
									<td style="color: red;">Nutritional assessment:</td>
									<td>
										<input type="text" name="female_nutritional_assessment" class="form-control">
									</td>
								</tr>
								<tr>
									<td style="color: red;">Psychological assessment :-</td>
									<td><input type="text" name="female_psychological_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Anxious/combative/depressed/normal</td>
									<td>
										<input type="text" name="female_mood_assessment" class="form-control">
									</td>
								</tr>
								<tr>
									<td style="color: red;">Pulse-</td>
									<td><input type="text" name="female_pulse" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Blood pressure-</td>
									<td><input type="text" name="female_blood_pressure" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Temperature</td>
									<td><input type="text" name="female_temperature" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">CVS-</td>
									<td><input type="text" name="female_cvs" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Chest -</td>
									<td><input type="text" name="female_chest" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Abdomen –</td>
									<td><input type="text" name="female_abdomen" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Others</td>
									<td><input type="text" name="female_general_exam_others" class="form-control"></td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td style="color: red;">Nutritional assessment :-Obese/average built/thin/cachexic</td>
									<td><input type="text" name="nutritional_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Psychological assessment :-</td>
									<td><input type="text" name="psychological_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Anxious/combative/depressed/normal</td>
									<td><input type="text" name="anxious_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Pulse-</td>
									<td><input type="text" name="pulse_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Blood pressure-</td>
									<td><input type="text" name="bp_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Temperature</td>
									<td><input type="text" name="temp_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">CVS-</td>
									<td><input type="text" name="cvs_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Chest -</td>
									<td><input type="text" name="chest_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Abdomen –</td>
									<td><input type="text" name="abdomen_assessment" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">Others</td>
									<td><input type="text" name="assessment_others" class="form-control"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">LOCAL EXAMINATION</th>
						<td>
							<table width="100%">
								<tr>
									<td style="color: red;">P/S</td>
									<td><input type="text" name="female_local_exam_ps" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">P/V</td>
									<td><input type="text" name="female_local_exam_pv" class="form-control"></td>
								</tr>
								<tr>
									<td style="color: red;">PAP SMEAR TAKEN</td>
									<td>
										<input type="radio" name="female_local_exam_pap" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="female_local_exam_pap" checked value="No" checked>
										<label for="type2">No</label>
									</td>
								</tr>
								<tr>
									<td style="color: red;">HVS C&S TAKEN</td>
									<td>
										<input type="radio" name="female_hvs_taken" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="female_hvs_taken" checked value="No" checked>
										<label for="type2">No</label>
									</td>
								</tr>
								<tr>
									<td style="color: red;">ENDOMETRIAL BIOPSY HPE/TB QUANTIFERON</td>
									<td>
										<input type="radio" name="female_endometrial_biopsy" value="Yes">
										<label for="type2">Yes</label>
										<input type="radio" name="female_endometrial_biopsy" checked value="No" checked>
										<label for="type2">No</label>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<span style="color: red;">UROSURGEON FINDINGS (ATTACH PRESCRIPTION)</span>
							<input type="text" name="urosurgeon_findings" maxlength="100" class="form-control">
							<input type="file" name="prescription" class="form-control">
						</td>
					</tr>
					<tr>
						<th style="color: red;">Intervention</th>
						<td colspan="2">
							<input type="checkbox" name="management_intervention[]" value="Natural"> NATURAL <br>
							<input type="checkbox" name="management_intervention[]" value="Medical"> Medical <br>
							<input type="checkbox" name="management_intervention[]" value="Surgical"> Surgical <br>
							<input type="checkbox" name="management_intervention[]" value="IUI"> IUI <br>
							<input type="checkbox" name="management_intervention[]" value="ART"> ART<br>
							<input type="checkbox" name="management_intervention[]" value="Rejuvenation_techniques"> Rejuvenation techniques
						</td>
						<td></td>
					</tr>
					<tr>
						<th style="color: red;">MANAGEMENT ADVISED <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="procedure_suggestion" value="1" name="procedure_suggestion" /></th>
						<td colspan="2">
							<select class="form-control multidselect_dropdown_2"  multiple="multiple" id="sub_procedure_suggestion_list" name="sub_procedure_suggestion_list[]" disabled>
								<?php if(!empty($procedures)) { foreach($procedures as $key => $val) { ?>
										<option value="<?php echo $val['ID']; ?>"><?php echo $val['procedure_name']." (".$val['code'].")"; ?></option>
								<?php  } } ?>
							</select>
						</td>
						<td></td>
					</tr>
					<tr>
						<th style="color: red;">DETAILS OF MANAGEMENT ADVISED</th>
						<td style="padding: 0;" colspan="2"><textarea maxlength="100" class="form-control" name="details_management_advised" placeholder="DETAILS OF MANAGEMENT ADVISED"></textarea></td>
					</tr>
					<tr>
						<th style="color: red;">REASON FOR ADVISED MANAGEMENT</th>
						<td colspan="2">
							<table width="100%">
								<tr>
									<td style="color: red;">LOW OVARIAN RESERVE</td>
									<td style="color: red;">Evidence: <input type="text" name="low_ovarian_reserve_evidence" maxlength="20" class="form-control"></td>
									<td style="color: red;"><input type="text" placeholder="yy-mm-dd" name="low_ovarian_reserve_evidence_date" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: red;">TUBAL FACTOR</td>
									<td style="color: red;">Evidence: <input type="text" name="tubal_factor_evidence" maxlength="20" class="form-control"></td>
									<td style="color: red;"><input type="text" placeholder="yy-mm-dd" name="tubal_factor_evidence_date" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: red;">MALE FACTOR</td>
									<td style="color: red;">Evidence: <input type="text" name="male_factor_evidence" maxlength="20" class="form-control"></td>
									<td style="color: red;"><input type="text" placeholder="yy-mm-dd" name="male_factor_evidence_date" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: red;">ENDOMETRIOSIS</td>
									<td style="color: red;">Evidence: <input type="text" name="endometriosis_evidence" maxlength="20" class="form-control"></td>
									<td style="color: red;"><input type="text" placeholder="yy-mm-dd" name="endometriosis_evidence_date" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: red;">PCOS</td>
									<td style="color: red;">Evidence: <input type="text" name="pcos_evidence" maxlength="20" class="form-control"></td>
									<td style="color: red;"><input type="text" placeholder="yy-mm-dd" name="pcos_evidence_date" class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: red;">UNEXPLAINED INFERTILITY</td>
									<td style="color: red;">Evidence: <input type="text" name="unexplained_infertility_evidence" maxlength="20" class="form-control"></td>
									<td style="color: red;"><input type="text" placeholder="yy-mm-dd" name="unexplained_infertility_evidence_date"  class="form-control datepicker"></td>
								</tr>
								<tr>
									<td style="color: red;">Others</td>
									<td style="color: red;">Evidence: <input type="text" name="advised_reason_other_evidence" maxlength="20" class="form-control"></td>
									<td style="color: red;"><input type="text" placeholder="yy-mm-dd" name="advised_reason_other_evidence_date" class="form-control datepicker"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th style="color: red;">INVESTIGATIONS ADVISED  <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="investigation_suggestion" value="1" name="investigation_suggestion" /></th>
						<td>
						<div class="col-sm-12 col-xs-12 role">
							<select class="multidselect_dropdown_1" multiple id="female_investigation_suggestion_list" disabled name="female_investigation_suggestion_list[]">
								<?php if(!empty($investigations)) { foreach($investigations as $key => $val) { ?>
										<option value="<?php echo $val['ID']; ?>"><?php echo $val['investigation']; ?></option>
								<?php  } } ?>
							</select>
						</div>
						</td>
						<td>
							<div class="col-sm-12 col-xs-12 role">
								<select class="multidselect_dropdown_1" multiple id="male_investigation_suggestion_list" disabled name="male_investigation_suggestion_list[]">
									<?php if(!empty($investigations)) { foreach($investigations as $key => $val) { ?>
											<option value="<?php echo $val['ID']; ?>"><?php echo $val['investigation']; ?></option>
									<?php  } } ?>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<th>MEDICINES ADVISED  <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="medicine_suggestion" value="1" name="medicine_suggestion" /></th>
						<td style="padding: 0;">
							<div class="col-sm-12 col-xs-12">
								<select class="multidselect_dropdown" multiple id="female_medicine_suggestion_list" disabled>
									<?php if(!empty($consultation_medicine)) { foreach($consultation_medicine as $key => $val) { ?>
											<option value="<?php echo $val['item_number']; ?>" medicine="<?php echo $val['item_name']; ?>"><?php echo $val['item_name']; ?></option>
									<?php  } } ?>
								</select>
								<hr/>
								<table id="female_medicine_table" style="width:100%; border:1px solid #000; display:none;" border='1'>
										<thead>
											<tr>
												<th style="border:1px solid #000; padding:10px;">Medicine</th>
												<th style="border:1px solid #000; padding:10px;">Dosage</th>
												<th style="border:1px solid #000; padding:10px;">Start on</th>
												<th style="border:1px solid #000; padding:10px;">Days</th>
												<th style="border:1px solid #000; padding:10px;">Route</th>
												<th style="border:1px solid #000; padding:10px;">Frequency</th>
												<th style="border:1px solid #000; padding:10px;">Timing</th>
											</tr>
											<tbody id="female_medicine_suggestion_table"></tbody>
										</thead>
								</table>
							</div>
						</td>
						<td style="padding: 0;">
							<div class="col-sm-12 col-xs-12">
								<select class="multidselect_dropdown" multiple id="male_medicine_suggestion_list" disabled>
									<?php if(!empty($consultation_medicine)) { foreach($consultation_medicine as $key => $val) { ?>
											<option value="<?php echo $val['item_number']; ?>" medicine="<?php echo $val['item_name']; ?>"><?php echo $val['item_name']; ?></option>
									<?php  } } ?>
								</select>
								<hr/>
								<table style="width:100%; border:1px solid #000; display:none;" id="male_medicine_table" border='1'>
										<thead>
											<tr>
												<th style="border:1px solid #000; padding:10px;">Medicine</th>
												<th style="border:1px solid #000; padding:10px;">Dosage</th>
												<th style="border:1px solid #000; padding:10px;">Start on</th>
												<th style="border:1px solid #000; padding:10px;">Days</th>
												<th style="border:1px solid #000; padding:10px;">Route</th>
												<th style="border:1px solid #000; padding:10px;">Frequency</th>
												<th style="border:1px solid #000; padding:10px;">Timing</th>
											</tr>
											<tbody id="male_medicine_suggestion_table"></tbody>
										</thead>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<th>NEXT FOLLOW UP <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="follow_up" value="1" name="follow_up" /></th>
						
						<td colspan="2">
							<div class="col-sm-12 col-xs-12">
								<input type="text" placeholder="yy-mm-dd" autocomplete="off" disabled="disabled" id="follow_up_date" name="follow_up_date" />
							</div>
							<div class="row appoitmented_slot" style="display:none;">            
								<div class="form-group col-sm-6 col-xs-12 role">
									<label for="statuss">Follow up slot (Required)</label>
									<select name="appoitmented_slot" class="empty-field" id="appoitmented_slot">
										<option value="">Select</option>
									</select>
								</div>
							</div>
						</td>
						
					</tr><br>
					<tr>
						<th>PURPOSE OF NEXT FOLLOWUP</th>
						<td colspan="2">
							<!-- <input type="radio" name="follow_up_purpose" value="FIRST CONSULTATION">
							<label>FIRST CONSULTATION</label> -->
							<input type="radio" name="follow_up_purpose" checked value="FOLLOW UP VISIT">
							<label>FOLLOW UP VISIT</label>
							<input type="radio" name="follow_up_purpose" value="PROCEDURE">
							<label>PROCEDURE</label><br>
						</td>
					</tr>
            </thead>

              </table>
			<!-- /.card-body -->
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
		<!-- /.card -->
		</div>
	</div>
	</div>
</form>

<script>

$(function() {
$('#male_medicine_suggestion_list').change(function(e) {
	$("table#male_medicine_table").hide();
	var brands = $('#male_medicine_suggestion_list option:selected');
	var selected = "";
	var countr=1;
	$("tbody#male_medicine_suggestion_table").empty();
	$(brands).each(function(index, brand){
		$("tbody#male_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='male_medicine_name_"+countr+"' id='male_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_dosage_"+countr+"' required id='male_medicine_dosage_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_when_start_"+countr+"' id='male_medicine_when_start_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_days_"+countr+"' required id='male_medicine_days_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_route_"+countr+"' id='male_medicine_route_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_frequency_"+countr+"' id='male_medicine_frequency_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_timing_"+countr+"' id='male_medicine_timing_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td></tr>");
		countr++;
		//selected.push([$(this).val()+"--------"+$(this).attr('medicine')]);
	});
	$("table#male_medicine_table").show();
	//console.log(selected);
}); 

$('#female_medicine_suggestion_list').change(function(e) {
	$("table#female_medicine_table").hide();
	var brands = $('#female_medicine_suggestion_list option:selected');
	var selected = "";
	var countr=1;
	$("tbody#female_medicine_suggestion_table").empty();
	$(brands).each(function(index, brand){
		$("tbody#female_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='female_medicine_name_"+countr+"' id='female_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_dosage_"+countr+"' required id='female_medicine_dosage_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_when_start_"+countr+"' id='female_medicine_when_start_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_days_"+countr+"' required id='female_medicine_days_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_route_"+countr+"' id='female_medicine_route_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_frequency_"+countr+"' id='female_medicine_frequency_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_timing_"+countr+"' id='female_medicine_timing_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td></tr>");
		countr++;
		//selected.push([$(this).val()+"--------"+$(this).attr('medicine')]);
	});
	//console.log(selected);
	$("table#female_medicine_table").show();
}); 
});

$("#follow_up").change(function() {
	$("#follow_up_date").val('');
	$('div.appoitmented_slot').hide();
	$("#appoitmented_slot").prop('required',false);
	$("#follow_up_date").prop('disabled',true);
if(this.checked) {
	$("#appoitmented_slot").prop('required',true);
	$("#follow_up_date").prop('disabled',false);				
}
});

$( function() {
$( ".datepicker" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		onSelect: function(dateStr) {}
	});
});

$( function() {
    $( "#follow_up_date" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		 	minDate: 0,
			onSelect: function(dateStr) {
				$('#loader_div').show();				
				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
				var appoitmented_doctor = $('#doctor_id').val();
				$.ajax({
					url: '<?php echo base_url('billingcontroller/doctor_slots')?>',
					type: 'POST',
					data: {'selected':startDate, 'appoitmented_doctor':appoitmented_doctor},
					success: function(data) {
						$('#appoitmented_slot').empty().append(data);
						$('div.appoitmented_slot').show();
						$('#loader_div').hide();
					}
				});
			}
		});
} );

$("#medicine_suggestion").change(function() {
//Male Investigation
$("select#male_medicine_suggestion_list").prop('disabled',true);
$("select#male_medicine_suggestion_list").parent().find('button').prop('disabled',true);
$("select#male_medicine_suggestion_list").parent().find('button').addClass('disabled');
$('option', $('#male_medicine_suggestion_list')).each(function(element) {
	$(this).removeAttr('selected').prop('selected', false);
});
$("#male_medicine_suggestion_list").multiselect('refresh');	
$("select#male_medicine_suggestion_list").prop('required',false);
//Female Investigation
$("select#female_medicine_suggestion_list").prop('disabled',true);
$("select#female_medicine_suggestion_list").parent().find('button').prop('disabled',true);
$("select#female_medicine_suggestion_list").parent().find('button').addClass('disabled');
$('option', $('#female_medicine_suggestion_list')).each(function(element) {
	$(this).removeAttr('selected').prop('selected', false);
});
$("#female_medicine_suggestion_list").multiselect('refresh');	
$("select#female_medicine_suggestion_list").prop('required',false);

if(this.checked) {
	//Male Investigation
	$("select#male_medicine_suggestion_list").prop('required',true);
	$("select#male_medicine_suggestion_list").prop('disabled',false);
	$("select#male_medicine_suggestion_list").parent().find('button').prop('disabled',false);
	$("select#male_medicine_suggestion_list").parent().find('button').removeClass('disabled');
	//Female Investigation
	$("select#female_medicine_suggestion_list").prop('required',true);
	$("select#female_medicine_suggestion_list").prop('disabled',false);
	$("select#female_medicine_suggestion_list").parent().find('button').prop('disabled',false);
	$("select#female_medicine_suggestion_list").parent().find('button').removeClass('disabled');
}
});
$("#investigation_suggestion").change(function() {
// Male Investigation
$("select#male_investigation_suggestion_list").prop('disabled',true);
$("select#male_investigation_suggestion_list").parent().find('button').prop('disabled',true);
$("select#male_investigation_suggestion_list").parent().find('button').addClass('disabled');
$('option', $('#male_investigation_suggestion_list')).each(function(element) {
	$(this).removeAttr('selected').prop('selected', false);
});
$("#male_investigation_suggestion_list").multiselect('refresh');
$("select#male_investigation_suggestion_list").prop('required',false);
//Female Investigation
$("select#female_investigation_suggestion_list").prop('disabled',true);
$("select#female_investigation_suggestion_list").parent().find('button').prop('disabled',true);
$("select#female_investigation_suggestion_list").parent().find('button').addClass('disabled');
$('option', $('#female_investigation_suggestion_list')).each(function(element) {
	$(this).removeAttr('selected').prop('selected', false);
});
$("#female_investigation_suggestion_list").multiselect('refresh');
$("select#female_investigation_suggestion_list").prop('required',false);

if(this.checked) {
	// Male Investigation
	$("select#male_investigation_suggestion_list").prop('required',true);
	$("select#male_investigation_suggestion_list").prop('disabled',false);
	$("select#male_investigation_suggestion_list").parent().find('button').prop('disabled',false);
	$("select#male_investigation_suggestion_list").parent().find('button').removeClass('disabled');
	//Female Investigation
	$("select#female_investigation_suggestion_list").prop('required',true);
	$("select#female_investigation_suggestion_list").prop('disabled',false);
	$("select#female_investigation_suggestion_list").parent().find('button').prop('disabled',false);
	$("select#female_investigation_suggestion_list").parent().find('button').removeClass('disabled');
}
});
$("#procedure_suggestion").change(function() {
$("select#sub_procedure_suggestion_list").prop('disabled',true);
$("select#sub_procedure_suggestion_list").parent().find('button').prop('disabled',true);
$("select#sub_procedure_suggestion_list").parent().find('button').addClass('disabled');
$('option', $('#sub_procedure_suggestion_list')).each(function(element) {
	$(this).removeAttr('selected').prop('selected', false);
});
$("#sub_procedure_suggestion_list").multiselect('refresh');

$("select#procedure_suggestion_list").prop('required',false);	
$("select#sub_procedure_suggestion_list").prop('required',false);
$("select#procedure_suggestion_list").prop('disabled',true);
if(this.checked) {
	$("select#sub_procedure_suggestion_list").prop('disabled',false);
	$("select#sub_procedure_suggestion_list").parent().find('button').prop('disabled',false);
	$("select#sub_procedure_suggestion_list").parent().find('button').removeClass('disabled');
}
});

// $("#procedure_suggestion_list").change(function() {
// 	$('option', $('#sub_procedure_suggestion_list')).each(function(element) {
// 		$(this).removeAttr('selected').prop('selected', false);
// 	});
// 	$("#sub_procedure_suggestion_list").multiselect('refresh');
// 	$("select#sub_procedure_suggestion_list").prop('disabled',true);

// 	$('#loader_div').show();
// 	var parent_parents = $(this).val();
// 	$.ajax({
// 		url: '<?php echo base_url('billingcontroller/get_sub_procedures')?>',
// 		data: {parent_parents : parent_parents,patient_id:'<?php echo $patient_data['patient_id']?>'},
// 		dataType: 'json',
// 		method:'post',
// 		success: function(data)
// 		{
// 			$('#sub_procedure_suggestion_list').empty().append(data.html);
// 			$("select#sub_procedure_suggestion_list").multiselect('rebuild');
// 			$("select#sub_procedure_suggestion_list").prop('disabled',false);
// 			$("select#sub_procedure_suggestion_list").parent().find('button').prop('disabled',false);
// 			$("select#sub_procedure_suggestion_list").parent().find('button').removeClass('disabled');
// 			$('#loader_div').hide();
// 		} 
// 	});
// });

$(function() {
$('.multidselect_dropdown').multiselect({ includeSelectAllOption: true });
$('.multidselect_dropdown_1').multiselect({ includeSelectAllOption: true });
$('.multidselect_dropdown_2').multiselect({ includeSelectAllOption: true });
});


</script>
