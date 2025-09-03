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
<input type="hidden" name="doctor_id" value="<?php echo $_SESSION['logged_doctor']['doctor_id']?>" />

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
						</thead>
						<tbody>
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
								<th style="color: red;">OCCUPATION</th>
								<td><input type="text" class="form-control" name="female_occupation"  id="exampleInputEmail1" placeholder="Enter your Occupation"></td>
								<td><input type="text" class="form-control" name="male_occupation" id="exampleInputEmail1" placeholder="Enter your Occupation"></td>
							</tr>
							<tr>
								<th style="color: red;">ETHNICITY</th>
								<td><input type="text" class="form-control" name="female_ethnicity" id="exampleInputEmail1" placeholder="Enter your Ethnicity"></td>
								<td><input type="text" class="form-control" name="male_ethnicity"id="exampleInputEmail1" placeholder="Enter your Ethnicity"></td>
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
							<td><input type="number" name="female_live_births" class="form-control"></td>
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
							<td><input type="number" name="female_no_of_still_births" class="form-control"></td>
						</tr>
						<tr>
							<td><p style="color: red;">No. of ectopic pregnancy</p></td>
							<td><input type="number" name="female_ectopic_pregnancy" class="form-control"></td>
						</tr>
						<tr>
							<td><p style="color: red;">History of any abnormality in child</p></td>
							<td><input type="number" name="female_any_abnormality" class="form-control"></td>
						</tr>
						<tr>
							<td><p style="color: red;">Others</p></td>
							<td><input type="text" name="female_others" class="form-control"></td>
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
							<td><input type="number" name="male_live_births" class="form-control"></td>
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
							<td><input type="number" name="male_no_of_still_births" class="form-control"></td>
						</tr>
						<tr>
							<td><p style="color: red;">No. of ectopic pregnancy</p></td>
							<td><input type="number" name="male_ectopic_pregnancy" class="form-control"></td>
						</tr>
						<tr>
							<td><p style="color: red;">History of any abnorfemality in child</p></td>
							<td><input type="number" name="male_any_abnorfemality" class="form-control"></td>
						</tr>
						<tr>
							<td><p style="color: red;">Others</p></td>
							<td><input type="text" name="male_others" class="form-control"></td>
						</tr>
					</table>
				</tr>
				<tr>
				<th style="color: red;">SEXUAL HISTORY</th>
				<td>
					<table>
						<tr>
							<td>Active marital life</td>
							<td><input type="text" name="female_active_martial_life" class="form-control"></td>
						</tr>
						<tr>
							<td>No.of sexual partners</td>
							<td><input type="text" name="female_no_of_sexual_partners" class="form-control"></td>
						</tr>
						<tr>
							<td>Duration of sexual partners</td>
							<td><input type="text" name="female_duration_of_sexual_partner"class="form-control"></td>
						</tr>
						<tr>
							<td>Frequency of sexual intercourse</td>
							<td><input type="text" name="female_frequency_of_Sexual_intercourse"class="form-control"></td>
						</tr>
						<tr>
							<td>Contraception used</td>
							<td><input type="text" name="female_contraception_used" class="form-control"></td>
						</tr>
						<tr>
							<td>Others</td>
							<td><input type="text" name="female_others"class="form-control"></td>
						</tr>
					</table>
				</td>
				<td>
					<table>
						<tr>
							<td>Active marital life</td>
							<td><input type="text" name="male_active_martial_life" class="form-control"></td>
						</tr>
						<tr>
							<td>No.of sexual partners</td>
							<td><input type="text" name="male_no_of_sexual_partners"  class="form-control"></td>
						</tr>
						<tr>
							<td>Duration of sexual partners</td>
							<td><input type="text" name="male_duration_of_sexual_partner" class="form-control"></td>
						</tr>
						<tr>
							<td>Frequency of sexual intercourse</td>
							<td><input type="text" name="male_frequency_of_Sexual_intercourse" class="form-control"></td>
						</tr>
						<tr>
							<td>Contraception used</td>
							<td><input type="text" name="male_contraception_used"  class="form-control"></td>
						</tr>
						<tr>
							<td>Erection disorder</td>
							<td><input type="text" name="male_erection_disorder" class="form-control"></td>
						</tr>
						<tr>
							<td>Ejaculation disorder</td>
							<td><input type="text" name="male_ejacuation_disorder" class="form-control"></td>
						</tr>
						<tr>
							<td>Others</td>
							<td><input type="text" name="male_others" class="form-control"></td>
						</tr>
					</table>
				</td>
				</tr>
				<tr>
					<th style="color: red;">TYPE OF INFERTILITY</th>
					<td>
						<input type="radio"name="female_infertility" value="primary">
						<label for="age1">Primary</label>
						<input type="radio" name="female_infertility" checked value="secondary">
						<label for="age2">Secondary</label>
					</td>
					<td>
						<input type="radio" name="male_infertility" value="primary">
						<label for="age1">Primary</label>
						<input type="radio" name="male_infertility"checked value="secondary">
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
								<td><input type="text" name="female_Menorrhagia" class="form-control"></td>
							</tr>
							<tr>
								<td>H/o D and c</td>
								<td><input type="text" name="female_hod" class="form-control"></td>
							</tr>
							<tr>
								<td>Dyspareunia</td>
								<td><input type="text" name="female_dyspareunia" class="form-control"></td>
							</tr>
							<tr>
								<td>Others</td>
								<td><input type="text" name="female_others"  class="form-control"></td>
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
								<td><input type="text" name="male_mumps" class="form-control"></td>
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
								<td><input type="text" name="male_others" class="form-control"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th style="color: red;">MENSTRUATION HISTORY</th>
					<td colspan="2">
						<table>
							<tr>
								<td>Age at Menarche</td>
								<td><input type="text" name="female_age_at_menarche" class="form-control"></td>
							</tr>
							<tr>
								<td>Flow- heavy/average/less</td>
								<td><input type="text" name="female_heavy_average_less" class="form-control"></td>
							</tr>
							<tr>
								<td>Frequency- regular /irregular</td>
								<td><input type="text" name="female_frequencye" class="form-control"></td>
							</tr>
							<tr>
								<td>Days</td>
								<td><input type="text" name="female_days" class="form-control"></td>
							</tr>
							<tr>
								<td>Hirsutism</td>
								<td><input type="text" name="female_a_hirutism" class="form-control"></td>
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
									<input type="radio" name="female_heart_attack" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_heart_attack" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Pacemaker</td>
								<td>
									<input type="radio" name="female_pacemaker" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_pacemaker" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other heart disease</td>
								<td>
									<input type="radio" name="female_other_heart_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_other_heart_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>High blood pressure</td>
								<td>
									<input type="radio" name="female_blood_pressure" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_blood_pressure" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Blood clots</td>
								<td>
									<input type="radio" name="female_blood_clots" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_blood_clots" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Chest pain</td>
								<td>
									<input type="radio" name="female_chestpain" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_chestpain" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Stroke</td>
								<td>
									<input type="radio" name="female_stroke" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_stroke" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Asthma</td>
								<td>
									<input type="radio" name="female_asthma" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_asthma" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other lung disease</td>
								<td>
									<input type="radio" name="female_other_lung_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_other_lung_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Difficulty breathing</td>
								<td>
									<input type="radio" name="female_diffculty_breathing" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_diffculty_breathing" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Sleep apnea or snoring</td>
								<td>
									<input type="radio" name="female_sleep_apnea" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_sleep_apnea" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Epilepsy or seizures</td>
								<td>
									<input type="radio" name="female_epilepsy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_epilepsy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Fainting spells</td>
								<td>
									<input type="radio" name="female_fainting_spells" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_fainting_spells" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Diabetes</td>
								<td>
									<input type="radio" name="female_diabetes" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_diabetes" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Muscle disorders</td>
								<td>
									<input type="radio" name="female_muscle_disorder" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_muscle_disorder" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Kidney disease</td>
								<td>
									<input type="radio" name="female_kidney_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_kidney_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Hepatitis</td>
								<td>
									<input type="radio" name="female_hepatities" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_hepatities" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Tuberculosis</td>
								<td>
									<input type="radio" name="female_tuberculosis" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_tuberculosis" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>HIV</td>
								<td>
									<input type="radio" name="female_hiv" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_hiv" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Heart burn/reflux</td>
								<td>
									<input type="radio" name="female_heart_burn" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_heart_burn" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Cancer </td>
								<td>
									<input type="radio" name="female_cancer" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_cancer" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Blood disorders</td>
								<td>
									<input type="radio" name="female_blood_disorder" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_blood_disorder" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Rheumatic disease</td>
								<td>
									<input type="radio" name="female_rheumatic_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_rheumatic_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Psychiatric disorder</td>
								<td>
									<input type="radio" name="female_psychiatric_disorder" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_psychiatric_disorder" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Thyroid disorder</td>
								<td>
									<input type="radio" name="female_thyroid" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_thyroid" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Urinary infection</td>
								<td>
									<input type="radio" name="female_urinary_infection" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_urinary_infection" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Sexually transmitted disease</td>
								<td>
									<input type="radio" name="female_std" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_std" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other medical condition or impairments</td>
								<td>
									<input type="text" name="female_other_medical_condition" class="form-control">
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table width="100%">
							<tr>
								<td>Heart attack</td>
								<td>
									<input type="radio" name="male_heart_attack" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_heart_attack" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Pacemaker</td>
								<td>
									<input type="radio" name="male_pacemaker" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_pacemaker" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other heart disease</td>
								<td>
									<input type="radio" name="male_other_heart_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_other_heart_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>High blood pressure</td>
								<td>
									<input type="radio" name="male_blood_pressure" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_blood_pressure" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Blood clots</td>
								<td>
									<input type="radio" name="male_blood_clots" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_blood_clots" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Chest pain</td>
								<td>
									<input type="radio" name="male_chestpain" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_chestpain" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Stroke</td>
								<td>
									<input type="radio" name="male_stroke" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_stroke" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Asthma</td>
								<td>
									<input type="radio" name="male_asthma" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_asthma" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other lung disease</td>
								<td>
									<input type="radio" name="male_other_lung_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_other_lung_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Difficulty breathing</td>
								<td>
									<input type="radio" name="male_diffculty_breathing" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_diffculty_breathing" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Sleep apnea or snoring</td>
								<td>
									<input type="radio" name="male_sleep_apnea" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_sleep_apnea" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Epilepsy or seizures</td>
								<td>
									<input type="radio" name="male_epilepsy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_epilepsy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Fainting spells</td>
								<td>
									<input type="radio" name="male_fainting_spells" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_fainting_spells" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Diabetes</td>
								<td>
									<input type="radio" name="male_diabetes" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_diabetes" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Muscle disorders</td>
								<td>
									<input type="radio" name="male_muscle_disorder" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_muscle_disorder" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Kidney disease</td>
								<td>
									<input type="radio" name="male_kidney_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_kidney_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Hepatitis</td>
								<td>
									<input type="radio" name="male_hepatities" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_hepatities" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Tuberculosis</td>
								<td>
									<input type="radio" name="male_tuberculosis" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_tuberculosis" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>HIV</td>
								<td>
									<input type="radio" name="male_hiv" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_hiv" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Heart burn/reflux</td>
								<td>
									<input type="radio" name="male_heart_burn" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_heart_burn" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Cancer </td>
								<td>
									<input type="radio" name="male_cancer" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_cancer" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Blood disorders</td>
								<td>
									<input type="radio" name="male_blood_disorder" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_blood_disorder" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Rheumatic disease</td>
								<td>
									<input type="radio" name="male_rheumatic_disease" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_rheumatic_disease" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Psychiatric disorder</td>
								<td>
									<input type="radio" name="male_psychiatric_disorder" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_psychiatric_disorder" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Thyroid disorder</td>
								<td>
									<input type="radio" name="male_thyroid" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_thyroid" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Urinary infection</td>
								<td>
									<input type="radio" name="male_urinary_infection" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_urinary_infection" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Sexually transmitted disease</td>
								<td>
									<input type="radio" name="male_std" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_std" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other medical condition or impairments</td>
								<td>
									<input type="text" name="male_other_medical_condition" class="form-control">
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
									<input type="radio"  name="female_laparoscopy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio"  name="female_laparoscopy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other operations</td>
								<td><input type="text" name = "female_other_operation"class="form-control"></td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td>Laparoscopy/pelvic/abdominal operations</td>
								<td>
									<input type="radio" name="male_laparoscopy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_laparoscopy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other operations</td>
								<td><input type="text" name = "male_other_operation" class="form-control"></td>
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
									<input type="radio" name="allergy_female_medication" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="allergy_female_medication" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>environmental factors</td>
								<td>
									<input type="radio" name="female_environmental_factors" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_environmental_factors" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table width="100%">
							<tr>
								<td>Medications</td>
								<td>
									<input type="radio" name="allergy_male_medication" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="allergy_male_medication" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>environmental factors</td>
								<td>
									<input type="radio" name="male_environmental_factors" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_environmental_factors" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th style="color: red;">SOCIAL & DRUG INTAKE HISTORY</th>
					<td>
						<table id="SOCIAl_DRUG_INTAKE_HISTORY">
							<tr>
								<td>Dentures</td>
								<td>
									<input type="radio" name="female_denture" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_denture" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Loose teeth</td>
								<td>
									<input type="radio" name="female_loose_teeth" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_loose_teeth" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Hearing aid</td>
								<td>
									<input type="radio" name="female_hearing_aid" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_hearing_aid" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Caps on front teeth</td>
								<td>
									<input type="radio" name="female_caps" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_caps" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Contact lenses</td>
								<td>
									<input type="radio" name="female_contact_lenses" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_contact_lenses" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Body piercing</td>
								<td>
									<input type="radio" name="female_body_piercing" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_body_piercing" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>H/o blood transfusion</td>
								<td>
									<input type="radio" name="female_blood_transfusion" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_blood_transfusion" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>H/o road traffic accident/any injury</td>
								<td>
									<input type="radio" name="female_accident" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_accident" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Smoke(past)daily</td>
								<td>
									<input type="radio" name="female_smoke_past" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_smoke_past" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Smoke(present)daily</td>
								<td>
									<input type="radio" name="female_smoke_present" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_smoke_present" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Drink(past)units per week</td>
								<td>
									<input type="radio" name="female_drink_past" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_drink_past" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Drink(present)units per week</td>
								<td>
									<input type="radio" name="female_drink_present" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_drink_present" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Hashish/cocaine /abusive drugs</td>
								<td>
									<input type="radio" name="female_hashish" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_hashish" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Have you ever used cortisone/steroid</td>
								<td>
									<input type="radio" name="female_steroid" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_steroid" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Medication</td>
								<td>
									<input type="radio" name="female_medication" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_medication" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Herbal products</td>
								<td>
									<input type="radio" name="female_herbal_products" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_herbal_products" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Eye drops</td>
								<td>
									<input type="radio" name="female_eye_drops" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_eye_drops" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Non prescription drugs used currently other than medications used for this IVF  cycle</td>
								<td>
									<input type="radio" name="female_non_perception_drug" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_non_perception_drug" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
					</td>
					<td>
							<table id="table_dentures">
							<tr>
								<td>Dentures</td>
								<td>
									<input type="radio" name="male_denture" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_denture" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Loose teeth</td>
								<td>
									<input type="radio" name="male_loose_teeth" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_loose_teeth" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Hearing aid</td>
								<td>
									<input type="radio" name="male_hearing_aid" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_hearing_aid" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Caps on front teeth</td>
								<td>
									<input type="radio" name="male_caps" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_caps" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Contact lenses</td>
								<td>
									<input type="radio" name="male_contact_lenses" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_contact_lenses" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Body piercing</td>
								<td>
									<input type="radio" name="male_body_piercing" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_body_piercing" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>H/o blood transfusion</td>
								<td>
									<input type="radio" name="male_blood_transfusion" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_blood_transfusion" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>H/o road traffic accident/any injury</td>
								<td>
									<input type="radio" name="male_accident" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_accident" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Smoke(past)daily</td>
								<td>
									<input type="radio" name="male_smoke_past" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_smoke_past" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Smoke(present)daily</td>
								<td>
									<input type="radio" name="male_smoke_present" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_smoke_present" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Drink(past)units per week</td>
								<td>
									<input type="radio" name="male_drink_past" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_drink_past" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Drink(present)units per week</td>
								<td>
									<input type="radio" name="male_drink_present" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_drink_present" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Hashish/cocaine /abusive drugs</td>
								<td>
									<input type="radio" name="male_hashish" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_hashish" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Have you ever used cortisone/steroid</td>
								<td>
									<input type="radio" name="male_steroid" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_steroid" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Medication</td>
								<td>
									<input type="radio" name="male_medication" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_medication" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Herbal products</td>
								<td>
									<input type="radio" name="male_herbal_products" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_herbal_products" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Eye drops</td>
								<td>
									<input type="radio" name="male_eye_drops" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_eye_drops" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Non prescription drugs used currently other than medications used for this IVF  cycle</td>
								<td>
									<input type="radio" name="male_non_perception_drug" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_non_perception_drug" checked="checked" value="no">
									<label for="type2">No</label>
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
									<input type="radio" name="female_anesthesia" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_anesthesia" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
						<br>
						<p><b>Maternal</b></p>
						<table width="100%">
							<tr>
								<td>Diabetes</td>
								<td>
									<input type="radio" name="female_maternal_diabities" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_maternal_diabities" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Heart/thrombo embolism</td>
								<td>
									<input type="radio" name="female_maternal_heart_thrombo" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_maternal_heart_thrombo" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Endocrine/metabolic</td>
								<td>
									<input type="radio" name="female_maternal_endrocine" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_maternal_endrocine" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Urinary tract/renal</td>
								<td>
									<input type="radio" name="female_maternal_urinary_tract" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_maternal_urinary_tract" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Psychiatric/neurological</td>
								<td>
									<input type="radio" name="female_maternal_psychiatric" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_maternal_psychiatric" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other/malignancy</td>
								<td>
									<input type="radio" name="female_maternal_other_maligancy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_maternal_other_maligancy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
						<br>
						<p><b>Paternal</b></p>
						<table width="100%">
							<tr>
								<td>Diabetes</td>
								<td>
									<input type="radio" name="female_paternal_diabities" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_paternal_diabities" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Heart/thrombo embolism</td>
								<td>
									<input type="radio" name="female_paternal_heart_thrombo" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_paternal_heart_thrombo" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Endocrine/metabolic</td>
								<td>
									<input type="radio" name="female_paternal_endrocine" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_paternal_endrocine" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Urinary tract/renal</td>
								<td>
									<input type="radio" name="female_paternal_urinary_tract" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_paternal_urinary_tract" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Psychiatric/neurological</td>
								<td>
									<input type="radio" name="female_paternal_psychiatric" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_paternal_psychiatric" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other/malignancy</td>
								<td>
									<input type="radio" name="female_paternal_other_maligancy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_paternal_other_maligancy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
						<br>
					</td>
					<td>
						<table width="100%">
							<tr>
								<td>Any family member any problem <br> with anesthesia</td>
								<td>
									<input type="radio" name="male_anaesthesia" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_anaesthesia" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
						<br>
						<p><b>Maternal</b></p>
						<table width="100%">
							<tr>
								<td>Diabetes</td>
								<td>
									<input type="radio" name="male_maternal_diabities" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_maternal_diabities" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Heart/thrombo embolism</td>
								<td>
									<input type="radio" name="male_maternal_heart_thrombo" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_maternal_heart_thrombo" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Endocrine/metabolic</td>
								<td>
									<input type="radio" name="male_maternal_endrocine" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_maternal_endrocine" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Urinary tract/renal</td>
								<td>
									<input type="radio" name="male_maternal_urinary_tract" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_maternal_urinary_tract" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Psychiatric/neurological</td>
								<td>
									<input type="radio" name="male_maternal_psychiatric" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_maternal_psychiatric" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other/malignancy</td>
								<td>
									<input type="radio" name="male_maternal_other_maligancy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_maternal_other_maligancy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
						<br>
						<p><b>Paternal</b></p>
						<table width="100%">
							<tr>
								<td>Diabetes</td>
								<td>
									<input type="radio" name="male_paternal_diabities" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_paternal_diabities" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Heart/thrombo embolism</td>
								<td>
									<input type="radio" name="male_paternal_heart_thrombo" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_paternal_heart_thrombo" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Endocrine/metabolic</td>
								<td>
									<input type="radio" name="male_paternal_endrocine" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_paternal_endrocine" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Urinary tract/renal</td>
								<td>
									<input type="radio" name="male_paternal_urinary_tract" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_paternal_urinary_tract" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Psychiatric/neurological</td>
								<td>
									<input type="radio" name="male_paternal_psychiatric" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_paternal_psychiatric" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td>Other/malignancy</td>
								<td>
									<input type="radio" name="male_paternal_other_maligancy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="male_paternal_other_maligancy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
						<br>
				</tr>
				<tr>
					<th style="color: red;">PAST INVESTIGATIONS</th>
					<td>
						<p><b style="color: red;">SERUM AMH</b></p>
						<table width="100%" class="border-field">
							<tr>
								<td style="color: red;">DT</td>
								<td style="color: red;">RESULT</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
							</tr>
							<tr>
								<td><input type="text" name ="serum_amh_male_dt_1" class="form-control"></td>
								<td><input type="text" name ="serum_amh_male_result" class="form-control"></td>
								<td><input type="text" name ="serum_amh_male_dt_2" class="form-control"></td>
								<td><input type="text" name ="serum_amh_male_re_1" class="form-control"></td>
								<td><input type="text" name ="serum_amh_male_dt_3" class="form-control"></td>
								<td><input type="text" name ="serum_amh_male_re_2" class="form-control"></td>
							</tr>
						</table>
						<br>
						<p><b style="color: red;">SERUM FSH</b></p>
						<table width="100%" class="border-field">
							<tr>
								<td style="color: red;">DT</td>
								<td style="color: red;">RESULT</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
							</tr>
							<tr>
								<td><input type="text" name ="serum_fsh_male_dt_1" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_male_result" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_male_dt_2" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_male_re_1" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_male_dt_3" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_male_re_2" class="form-control"></td>
							</tr>
						</table>
						<br>
						<p><b style="color: red;">HSG</b></p>
						<table width="100%" class="border-field">
							<tr>
								<td style="color: red;">DT</td>
								<td style="color: red;">RESULT</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
							</tr>
							<tr>
								<td><input type="text" name ="hsg_male_dt_1" class="form-control"></td>
								<td><input type="text" name ="hsg_male_result" class="form-control"></td>
								<td><input type="text" name ="hsg_male_dt_2" class="form-control"></td>
								<td><input type="text" name ="hsg_male_re_1" class="form-control"></td>
								<td><input type="text" name ="hsg_male_dt_3" class="form-control"></td>
								<td><input type="text" name ="hsg_male_re_2" class="form-control"></td>
							</tr>
						</table>
						<br>
						<p><b style="color: red;">USG OF PELVIS</b></p>
						<table width="100%" class="border-field">
							<tr>
								<td style="color: red;">DT</td>
								<td style="color: red;">RESULT</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
							</tr>
							<tr>
								<td><input type="text" name ="usg_male_dt_1" class="form-control"></td>
								<td><input type="text" name ="usg_male_result" class="form-control"></td>
								<td><input type="text" name ="usg_male_dt_2" class="form-control"></td>
								<td><input type="text" name ="usg_male_re_1" class="form-control"></td>
								<td><input type="text" name ="usg_male_dt_2" class="form-control"></td>
								<td><input type="text" name ="usg_male_re_2" class="form-control"></td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td style="color: red;">Others</td>
								<td><input type="text" name="female_investigation_others" class="form-control"></td>
							</tr>
						</table>
					</td>
					<td>
						<p><b style="color: red;">SEMEN ANALYSIS</b></p>
						<table width="100%" class="border-field">
							<tr>
								<td style="color: red;">DT</td>
								<td style="color: red;">TC</td>
								<td style="color: red;">M</td>
								<td style="color: red;">MP</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">TC</td>
								<td style="color: red;">M</td>
								<td style="color: red;">MP</td>
							</tr>
							<tr>
								<td><input type="text" name ="semen_analysis_female_dt_1" class="form-control"></td>
								<td><input type="text" name ="semen_analysis_female_tc_1" class="form-control"></td>
								<td><input type="text" name ="semen_analysis_female_m_1" class="form-control"></td>
								<td><input type="text" name ="semen_analysis_female_mp_1" class="form-control"></td>
								<td><input type="text" name ="semen_analysis_female_dt_2" class="form-control"></td>
								<td><input type="text" name ="semen_analysis_female_tc_2" class="form-control"></td>
								<td><input type="text" name ="semen_analysis_female_m_2" class="form-control"></td>
								<td><input type="text" name ="semen_analysis_female_mp_2" class="form-control"></td>
							</tr>
						</table>
						<br>
						<p><b style="color: red;">SERUM FSH</b></p>
						<table width="100%" class="border-field">
							<tr>
								<td style="color: red;">DT</td>
								<td style="color: red;">RESULT</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
							</tr>
							<tr>
								<td><input type="text" name ="serum_fsh_female_dt_1" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_female_result" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_female_dt_2" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_female_re_1" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_female_dt_3" class="form-control"></td>
								<td><input type="text" name ="serum_fsh_female_re_2" class="form-control"></td>
							</tr>
						</table>
						<br>
						<p><b style="color: red;">SERUM TESTOSTERONE</b></p>
						<table width="100%" class="border-field">
							<tr>
								<td style="color: red;">DT</td>
								<td style="color: red;">RESULT</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
								<td style="color: red;">DT</td>
								<td style="color: red;">RE</td>
							</tr>
							<tr>
								<td><input type="text" name ="serum_testo_female_dt_1" class="form-control"></td>
								<td><input type="text" name ="serum_testo_female_result" class="form-control"></td>
								<td><input type="text" name ="serum_testo_female_dt_2" class="form-control"></td>
								<td><input type="text" name ="serum_testo_female_re_1" class="form-control"></td>
								<td><input type="text" name ="serum_testo_female_dt_3" class="form-control"></td>
								<td><input type="text" name ="serum_testo_female_re_1" class="form-control"></td>
							</tr>
						</table>
						<br>
						<table width="100%">
							<tr>
								<td style="color: red;">Others</td>
								<td><input type="text" name = "male_invsetigation_others" class="form-control"></td>
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
								<td><input type="text" name="female_years_of_taking_infertility_treatment" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">OVULATION INDUCTION DRUGS HOW MANY CYCLES</td>
								<td><input type="text" name="female_ovulation_induction_drug" class="form-control"></td>
							</tr>
							<tr>
								<td>OVULATION INDUCTION INJECTION TAKEN HOW MANY CYCLES</td>
								<td><input type="text" name="female_ovulation_induction_drug"class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">TOTAL NO. OF IUI CYCLES</td>
								<td><input type="text" name ="female_total_no_of_iui_cycles" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">TOTAL NO . OF IVF/ICSI CYCLES</td>
								<td><input type="text"  name ="female_total_no_of_ivf_cycles" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: green;">Total No.OF STIMULATED IVF CYCLES</td>
								<td><input type="text" name ="female_total_no_of_stimulated_ivf_cycles"  class="form-control"></td>
							</tr>
							<tr>
								<td style="color: green;">Total No.cycles with no evidence of fertilization</td>
								<td><input type="text"  name ="female_total_no_of_cycles_fertilization" class="form-control"></td>
							</tr>
							<tr>
								<td>NO. OF EGGS RETREIVED EACH CYCLE</td>
								<td><input type="text" name ="female_no_of_eggs"  class="form-control"></td>
							</tr>
							<tr>
								<td>NO. OF FRESH CYCLE</td>
								<td><input type="text" name ="female_no_of_fresh_cycle" class="form-control"></td>
							</tr>
							<tr>
								<td>NO. OF FROZEN CYCLE</td>
								<td><input type="text" name ="female_no_of_frozen_cycle" class="form-control"></td>
							</tr>
							<tr>
								<td>NO. OF CYCLE OF DONOR EGG</td>
								<td><input type="text" name ="female_no_of_donor_egg" class="form-control"></td>
							</tr>
							<tr>
								<td>NO.OF CYCLE OF DONOR SPERM</td>
								<td><input type="text" name ="female_no_of_donor_sperm" class="form-control"></td>
							</tr>
							<tr>
								<td>NO.OF CYCLE OF SURROGACY</td>
								<td><input type="text" name ="female_no_of_cycle_of_surrogacy" class="form-control"></td>
							</tr>
							<tr>
								<td>OTHERS</td>
								<td><input type="text" name ="previous_info_others" class="form-control"></td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td>MEDICATIONS FOR SPERM</td>
								<td><input type="text" name ="male_medication_of_sperm" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">FNAC TESTES DONE WITH REPORT</td>
								<td><input type="text" name ="male_fnac_testes" class="form-control"></td>
							</tr> 
							<tr>
								<td>NO. OF TIMES TESA DONE</td>
								<td><input type="text" name ="male_fnac_testes" class="form-control"></td>
							</tr>
							<tr>
								<td>TESA REPORT</td>
								<td><input type="text" name ="male_tesa_report" class="form-control"></td>
							</tr>
							<tr>
								<td>TESE REPORT</td>
								<td><input type="text"  name ="male_tese_report" class="form-control"></td>
							</tr>
							<tr>
								<td>MICRO TESE</td>
								<td><input type="text" name ="male_micro_tese" class="form-control"></td>
							</tr>
							<tr>
								<td>OTHERS</td>
								<td><input type="text" name ="previous_info_others" class="form-control"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th>OTHERS</th>
					<td><input type="text" name="female_others" class="form-control"></td>
					<td><input type="text" name="male_others" class="form-control"></td>
				</tr>
				<tr>
					<th style="color: red;">GENERAL EXAMINATION</th>
					<td>
						<table>
							<tr>
								<td style="color: red;">Nutritional assessment :-Obese/average built/thin/cachexic</td>
								<td><input type="text" name="female_obese" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Psychological assessment :-</td>
								<td><input type="text" name="female_psychological_assessment" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Anxious/combative/depressed/normal</td>
								<td><input type="text" name="female_anxious" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Pulse-</td>
								<td><input type="text"  name="female_pulse" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Blood pressure-</td>
								<td><input type="text" name="female_blood_pressure_value" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Temperature</td>
								<td><input type="text" name="female_temp" class="form-control"></td>
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
								<td><input type="text" name="female_general_info_others"  class="form-control"></td>
							</tr>
						</table>
					</td>
						<td>
						<table>
							<tr>
								<td style="color: red;">Nutritional assessment :-Obese/average built/thin/cachexic</td>
								<td><input type="text" name="male_obese" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Psychological assessment :-</td>
								<td><input type="text" name="male_psychological_assessment" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Anxious/combative/depressed/normal</td>
								<td><input type="text" name="male_anxious" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Pulse-</td>
								<td><input type="text"  name="male_pulse" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Blood pressure-</td>
								<td><input type="text" name="male_blood_pressure_value" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Temperature</td>
								<td><input type="text" name="male_temp" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">CVS-</td>
								<td><input type="text" name="male_cvs" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Chest -</td>
								<td><input type="text" name="male_chest" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Abdomen –</td>
								<td><input type="text" name="male_abdomen" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Others</td>
								<td><input type="text" name="male_general_info_others"  class="form-control"></td>
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
								<td><input type="text" name="female_local_p_s"class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">P/V</td>
								<td><input type="text" name="female_local_p_v" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">PAP SMEAR TAKEN</td>
								<td>
									<input type="radio" name="pap_smear_taken" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="pap_smear_taken" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td style="color: red;">HVS C&S TAKEN</td>
								<td>
									<input type="radio" name="female_hvs_c_s_taken" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_hvs_c_s_taken" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
							<tr>
								<td style="color: red;">ENDOMETRIAL BIOPSY HPE/TB QUANTIFERON</td>
								<td>
									<input type="radio" name="female_endometrial_biopsy" value="yes">
									<label for="type2">Yes</label>
									<input type="radio" name="female_endometrial_biopsy" checked="checked" value="no">
									<label for="type2">No</label>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table>
							<tr>
								<td style="color: red;">UROSURGEON FINDINGS (ATTACH PRESCRIPTION)</td>
								<td><input type="file" name="male_urosurgeon_findings" class="form-control"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th style="color: red;">MANAGEMENT ADVISED  <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="procedure_suggestion" value="1" name="procedure_suggestion" /></th>
					<td colspan="2">						
						<select class="form-control multidselect_dropdown_2"  multiple="multiple" id="sub_procedure_suggestion_list" name="sub_procedure_suggestion_list[]" disabled>
							<?php if(!empty($procedures)) { foreach($procedures as $key => $val) { ?>
									<option value="<?php echo $val['ID']; ?>"><?php echo $val['procedure_name']; ?></option>
							<?php  } } ?>
						</select>
						<!-- <div class="col-sm-12 col-xs-12 role" style="margin-top:20px;">
							<label for="item_name">Sub Procedures</label><br/>
							<select class="form-control multidselect_dropdown_2" multiple="multiple" id="sub_procedure_suggestion_list" name="sub_procedure_suggestion_list[]" disabled="disabled">
							</select>
						</div> -->

					</td>
				</tr>
				<tr>
					<th style="color: red;">DETAILS OF MANAGEMENT ADVISED</th>
					<td colspan="2">
						<input type="text" name="detail_management_advised" class="form-control" />
					</td>
				</tr>
				<tr>
					<th style="color: red;">REASON FOR ADVISED MANAGEMENT</th>
					<td colspan="2">
						<table width="100%">
							<tr>
								<td style="color: red;">LOW OVARIAN RESERVE</td>
								<td style="color: red;"><input type="text" name="female_low_ovarian" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">TUBAL FACTOR</td>
								<td style="color: red;"><input type="text"  name="female_tubal_factor" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">MALE FACTOR</td>
								<td style="color: red;"><input type="text"  name="female_factor" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">ENDOMETRIOSIS</td>
								<td style="color: red;"><input type="text" name="female_endometriosis" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">PCOS</td>
								<td style="color: red;"><input type="text" name="female_pcos" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">UNEXPLAINED INFERTILITY</td>
								<td style="color: red;"><input type="text" name="female_unexplained_infertility" class="form-control"></td>
							</tr>
							<tr>
								<td style="color: red;">Others</td>
								<td style="color: red;"><input type="text" name="female_reason_for_am_others" class="form-control"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th style="color: red;">INVESTIGATIONS ADVISED <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="investigation_suggestion" value="1" name="investigation_suggestion" /></th>
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
					<th style="color: red;">MEDICINES ADVISED <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="medicine_suggestion" value="1" name="medicine_suggestion" /></th>
					<td>
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
											<th style="border:1px solid #000; padding:10px;">Dose/Day</th>
											<th style="border:1px solid #000; padding:10px;">No. of days</th>
										</tr>
										<tbody id="female_medicine_suggestion_table"></tbody>
									</thead>
							</table>
						</div>
					</td>
					<td>
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
											<th style="border:1px solid #000; padding:10px;">Dose/Day</th>
											<th style="border:1px solid #000; padding:10px;">No. of days</th>
										</tr>
										<tbody id="male_medicine_suggestion_table"></tbody>
									</thead>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<th style="color: red;">NEXT FOLLOW UP</th>
					<td colspan="2">
						<div class="form-group col-sm-12 col-xs-12 role">
								<label for="item_name">Next appointment? <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="follow_up" value="1" name="follow_up" /></label>
								<div class="col-sm-12 col-xs-12">
									<input type="text" autocomplete="off" disabled="disabled" id="follow_up_date" name="follow_up_date" />
								</div>
						</div>
					</td>
				</tr>
				<tr>
					<th style="color: red;">PURPOSE OF NEXT FOLLOW UP </th>
					<td colspan="2" >
					<input type="text" autocomplete="off" id="follow_up_reason" name="follow_up_reason" />
					</td>
				</tr>
				<tr><td style="border: 0;"></td></tr>
				<!--<tr>
					<th>FOLLOW UP  OF PATIENT</th>
				</tr>
				<tr>
					<td></td>
					<td>Female</td>
					<td>Male</td>
				</tr>
				<tr>
					<td>PRESENTING COMPLAINTS</td>
					<td><input type="text" name = "male_presenting_complaints" class="form-control"></td>
					<td><input type="text"  name = "female_presenting_complaints" class="form-control"></td>
				</tr>
				<tr>
					<td>INVESTIGATIONS REPORT</td>
					<td><input type="text"  name = "male_investigation_report" class="form-control"></td>
					<td><input type="text" name = "" class="form-control"></td>
				</tr>
				<tr>
					<td>INVESTIGATIONS ADVISED</td>
					<td><input type="text" name = "male_investigation_advised"class="form-control"></td>
					<td><input type="text" name = "female_investigation_advised" class="form-control"></td>
				</tr>
				<tr>
					<td>MEDICATION ADVISED(TO BE MAPPED BY INVENTORY LIST)</td>
					<td><input type="text" name = "male_medication_advised" class="form-control"></td>
					<td><input type="text" name = "female_medication_advised" class="form-control"></td>
				</tr>
				<tr>
					<td>MANAGEMENT ADVISED</td>
					<td><input type="text" name = "male_management_advised"class="form-control"></td>
					<td><input type="text" name = "female_management_advised" class="form-control"></td>
				</tr>
				<tr>
					<td>NEXT FOLLOW UP</td>
					<td><input type="text" name = "male_follow_up" class="form-control"></td>
					<td><input type="text" name = "female_follow_up" class="form-control"></td>
				</tr>-->
		</tbody>

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
		$("tbody#male_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='male_medicine_name_"+countr+"' id='male_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_dose_days_"+countr+"' required id='male_medicine_dose_days_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_for_days_"+countr+"' id='male_medicine_for_days_"+countr+"' required></td></tr>");
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
		$("tbody#female_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='female_medicine_name_"+countr+"' id='female_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_dose_days_"+countr+"' required id='female_medicine_dose_days_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_for_days_"+countr+"' id='female_medicine_for_days_"+countr+"' required></td></tr>");
		countr++;
		//selected.push([$(this).val()+"--------"+$(this).attr('medicine')]);
	});
	//console.log(selected);
	$("table#female_medicine_table").show();
}); 
});

$("#follow_up").change(function() {
	$("#follow_up_date").val('');
	$("#follow_up_date").prop('disabled',true);
if(this.checked) {
	$("#follow_up_date").prop('disabled',false);				
}
});

$( function() {
$( "#follow_up_date" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		onSelect: function(dateStr) {}
	});
});

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
