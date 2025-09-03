<?php $all_method =&get_instance();
$consultation_data = $all_method->get_consultation($appointments['ID']);
$patient_data = get_patient_detail($consultation_data['patient_id']);
$patient_doctor_consultation = patient_doctor_consultation_data($appointments['ID'], $consultation_data['patient_id']);
//var_dump($consultation_data); echo '<br/><br/><br/>'; 
//var_dump($patient_data);die;

$sql2 = "Select * from ".$this->config->item('db_prefix')."doctors where ID='".$_SESSION['logged_doctor']['doctor_id']."'"; 
$select_result2 = run_select_query($sql2);
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
<input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $_SESSION['logged_doctor']['doctor_id']; ?>" />
<input type="hidden" name="center_number" id="center_number" value="<?php echo $select_result2['center_id']; ?>" />
<?php if($appointments['partial_billing'] == 1){ ?>
	<input type="hidden" name="doc_consult_id" value="<?php echo $patient_doctor_consultation['ID']; ?>" />
<?php } ?>
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
							<th>FOLLOW UP  OF PATIENT</th>
								<th style="color: red;">Patient</th>
								<th style="color: red;">Spouse</th>
								</tr>
							</thead>
							<thead>
							
					<tr>
						<td style="color: red;">PRESENTING COMPLAINTS</td>
						<td><input type="text" name="female_findings" class="form-control"></td>
						<td><input type="text" name="male_findings" class="form-control"></td>
					</tr>
					<tr>
						<td>INVESTIGATIONS REPORT</td>
						<td colspan="2"><a href="<?php echo base_url('my_reports'); ?>"  target="_blank">My Reports</a> | <a href="<?php echo base_url('my_ipd'); ?>" target="_blank">My IPD</a> | <a href="<?php echo base_url('patient_details/'.$patient_data['patient_id']); ?>" target="_blank">Patient Data</a></td>
					</tr>
					
					<?php if($appointments['partial_billing'] == 0){?>
						<tr style="color: red;">
							<td>INVESTIGATIONS ADVISED   <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="investigation_suggestion" value="1" name="investigation_suggestion" /></td>
							<td>
								<select class="multidselect_dropdown_1" multiple id="female_investigation_suggestion_list" disabled name="female_investigation_suggestion_list[]">
									<?php if(!empty($investigations)) { foreach($investigations as $key => $val) { ?>
											<option value="<?php echo $val['ID']; ?>"><?php echo $val['investigation']; ?></option>
									<?php  } } ?>
									<option value="0">NA</option>
								</select>
							</td>
							<td>
									<select class="multidselect_dropdown_1" multiple id="male_investigation_suggestion_list" disabled name="male_investigation_suggestion_list[]">
										<?php if(!empty($investigations)) { foreach($investigations as $key => $val) { ?>
												<option value="<?php echo $val['ID']; ?>"><?php echo $val['investigation']; ?></option>
										<?php  } } ?>
										<option value="0">NA</option>
									</select>
							</td>
						</tr>
						<tr>
							<td style="color: red;">MEDICATION ADVISED   <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="medicine_suggestion" value="1" name="medicine_suggestion" /></td>
							<td>
								<div class="col-sm-12 col-xs-12">
									<select class="multidselect_dropdown" multiple id="female_medicine_suggestion_list" disabled>
										<?php if(!empty($consultation_medicine)) { foreach($consultation_medicine as $key => $val) { ?>
												<option value="<?php echo $val['item_number']; ?>" medicine="<?php echo $val['item_name']; ?>"><?php echo $val['item_name']; ?></option>
										<?php  } } ?>
										 <option value="0" medicine="NA">NA</option>
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
													<th style="border:1px solid #000; padding:10px;">Take</th>
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
										 <option value="0" medicine="NA">NA</option>
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
													<th style="border:1px solid #000; padding:10px;">Take</th>
												</tr>
												<tbody id="male_medicine_suggestion_table"></tbody>
											</thead>
									</table>
								</div>
							</td>
						</tr>
						<tr>     
						<?php
// Fetching the consultation details from the database
$sql1 = "SELECT * FROM hms_doctor_consultation WHERE patient_id = " . $patient_data['patient_id'] . " and procedure_billed = '1'";
$query = $this->db->query($sql1);
$app_result = $query->result(); // Fetching the results

$booked_procedures = [];

foreach ($app_result as $ky => $vl) {
    // Unserialize the sub_procedure_suggestion_list
    $serializedString = $vl->sub_procedure_suggestion_list;
    $unserializedArray = unserialize($serializedString);

    if (is_array($unserializedArray)) {
        // Collect booked procedures into an array
        foreach ($unserializedArray as $key => $value) {
            // Use a parameterized query to prevent SQL injection
            $sql2 = "SELECT procedure_name, ID, code FROM hms_procedures WHERE ID = ?";
            $query2 = $this->db->query($sql2, array($value));
            $select_result2 = $query2->row(); // Fetching a single row

            if ($select_result2) {
                $booked_procedures[] = $select_result2->ID; // Store booked procedure ID
                $select_result2->procedure_name . "<br /><br />";
				$select_result2->code . "<br />";
            }
        }
    }
}
?>

							
							<td style="color: red;">MANAGEMENT ADVISED <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="checkbox" id="procedure_suggestion" value="1" name="procedure_suggestion" /></td>
							<td colspan="2">
								<select class="form-control multidselect_dropdown_2" multiple="multiple" id="sub_procedure_suggestion_list" name="sub_procedure_suggestion_list[]">
    <?php if (!empty($procedures)) {
        foreach ($procedures as $key => $val) { ?>
            <option value="<?php echo $val['ID']; ?>"
                <?php 
                // Disable specific procedures by name or code
                if (
                    ($val['procedure_name'] === 'IVF Procedure Charge (without Ovulation Induction Injection)' && $val['code'] === 'IP11') ||
                    ($val['procedure_name'] === 'IVF (Single cycle ovulation induction till trigger)' && $val['code'] === 'IP222') ||
					($val['procedure_name'] === 'IVF (Single cycle ovulation induction till trigger): second cycle' && $val['code'] === 'IP223') ||
					($val['procedure_name'] === 'ICSI (Intracytoplasmic Sperm Injection)' && $val['code'] === 'IP02') ||
					($val['procedure_name'] === 'ICSI (Intracytoplasmic Sperm Injection)- 2nd Cycle' && $val['code'] === 'IP123') ||
					($val['procedure_name'] === 'Intrauterine Insemination (IUI) (Procedure) (Self)' && $val['code'] === 'IP04') ||
					($val['procedure_name'] === 'Intrauterine Insemination (IUI) Procedure (Self)- 2nd Cycle' && $val['code'] === 'IP129') ||
					($val['procedure_name'] === 'Frozen Embryo Transfer (FET)' && $val['code'] === 'IP05') ||
					($val['procedure_name'] === 'Frozen Embryo Transfer (FET)- 2nd Cycle' && $val['code'] === 'IP127') ||
					($val['procedure_name'] === 'Embryo Thawing ' && $val['code'] === 'IP63') ||
					($val['procedure_name'] === 'Embryo Thawing-2nd Cycle' && $val['code'] === 'IP125') ||
					($val['procedure_name'] === 'Testicular Sperm Aspiration (TESA) / Percutaneous Epididymis Sperm Aspiration (PESA)' && $val['code'] === 'IP06') ||
					($val['procedure_name'] === 'Testicular Sperm Aspiration (TESA) / Percutaneous Epididymis Sperm Aspiration (PESA)- 2nd Cycle' && $val['code'] === 'IP131') ||
					($val['procedure_name'] === 'Testicular Sperm Extraction (TESE)- 2nd Cycle' && $val['code'] === 'IP133') ||
					($val['procedure_name'] === 'Microsurgical Testicular Sperm Extraction (M TESE)' && $val['code'] === 'IP07') ||
					($val['procedure_name'] === 'Microsurgical Testicular Sperm Extraction (MTESE)- 2nd Cycle' && $val['code'] === 'IP135') ||
					($val['procedure_name'] === 'Ovarian PRP' && $val['code'] === 'IP08') ||
					($val['procedure_name'] === 'Ovarian PRP(Transvaginal)- 2nd Cycle' && $val['code'] === 'IP137') ||
					($val['procedure_name'] === 'Uterine PRP' && $val['code'] === 'IP09') ||
					($val['procedure_name'] === 'Uterine PRP(Transvaginal)- 2nd Cycle' && $val['code'] === 'IP139') ||
					($val['procedure_name'] === 'Testicular PRP' && $val['code'] === 'IP37') ||
					($val['procedure_name'] === 'Testicular PRP-2nd Cycle' && $val['code'] === 'IP141') ||
					($val['procedure_name'] === 'Blastocyst Transfer' && $val['code'] === 'IP16') ||
					($val['procedure_name'] === 'Blastocyst Transfer-2nd Cycle' && $val['code'] === 'IP145') ||
					($val['procedure_name'] === 'Laser assisted Hatching' && $val['code'] === 'IP34') ||
					($val['procedure_name'] === 'Laser assisted Hatching-2nd Cycle' && $val['code'] === 'IP147') ||
					($val['procedure_name'] === 'Embryo Glue' && $val['code'] === 'IP39') ||
					($val['procedure_name'] === 'Embryo Glue-2nd Cycle' && $val['code'] === 'IP149') ||
					($val['procedure_name'] === 'Endometrial Scratching' && $val['code'] === 'IP20') ||
					($val['procedure_name'] === 'Endometrial Scratching-2nd Cycle' && $val['code'] === 'IP151') ||
					($val['procedure_name'] === 'Comprehensive IUI' && $val['code'] === 'IP99') ||
					($val['procedure_name'] === 'Comprehensive IUI-2nd Cycle' && $val['code'] === 'IP159') ||
					($val['procedure_name'] === 'PGT-A ( single Embryo) Inclusive Freezing & Thawing' && $val['code'] === 'IP72') ||
					($val['procedure_name'] === 'PGT-A (Single Embryo)- 2nd Cycle' && $val['code'] === 'IP161') ||
					($val['procedure_name'] === 'PGT-M(single embryo) Inclusive Freezing & Thawing' && $val['code'] === 'IP73') ||
					($val['procedure_name'] === 'PGT-M (Single Embryo)- 2nd Cycle' && $val['code'] === 'IP163') ||
					($val['procedure_name'] === 'PGT-SR ( single embryo) Inclusive Freezing & Thawing' && $val['code'] === 'IP93') ||
					($val['procedure_name'] === 'PGT-SR (single embryo)- 2nd Cycle' && $val['code'] === 'IP165') ||
					($val['procedure_name'] === 'Sperm Mobil' && $val['code'] === 'IP40') ||
					($val['procedure_name'] === 'Sperm Mobil-2nd Cycle' && $val['code'] === 'IP167') ||
					($val['procedure_name'] === 'Microfluidics Sperm' && $val['code'] === 'IP48') ||
					($val['procedure_name'] === 'Microfluidics Sperm-2nd Cycle' && $val['code'] === 'IP169') ||
					($val['procedure_name'] === 'OOACTIV' && $val['code'] === 'IP66') ||
					($val['procedure_name'] === 'OOACTIV-2nd Cycle' && $val['code'] === 'IP171') ||
					($val['procedure_name'] === 'GA Charges' && $val['code'] === 'IP47') ||
					($val['procedure_name'] === 'GA Charges-2nd Cycle' && $val['code'] === 'IP173') ||
					($val['procedure_name'] === 'Pap Smear& LBC' && $val['code'] === 'IP55') ||
					($val['procedure_name'] === 'Pap Smear & LBC Procedure Charges Only-2nd Cycle' && $val['code'] === 'IP175') ||
					($val['procedure_name'] === 'High Vaginal Culture & Sensitivity' && $val['code'] === 'IP56') ||
					($val['procedure_name'] === 'High Vaginal Culture & Sensitivity Procedure charge only-2nd Cycle' && $val['code'] === 'IP177') ||
					($val['procedure_name'] === 'Egg Pooling (1 OPU+ Stimulation Injections) ' && $val['code'] === 'IP94') ||
					($val['procedure_name'] === 'Egg Pooling ( 1 OPU without stimulation Injection)' && $val['code'] === 'IP95') ||
					($val['procedure_name'] === 'Egg Pooling (1 OPU without stimulation Injection)- 2nd Cycle' && $val['code'] === 'IP181') ||
					($val['procedure_name'] === 'PGT-A (2 Embryos)' && $val['code'] === 'IP112') ||
					($val['procedure_name'] === 'PGT-A (2 Embryos)- 2nd Cycle' && $val['code'] === 'IP183') ||
					($val['procedure_name'] === 'PGT-A (3 Embryos)' && $val['code'] === 'IP113') ||
					($val['procedure_name'] === 'PGT-A (3 Embryos)- 2nd Cycle' && $val['code'] === 'IP185') ||
					($val['procedure_name'] === 'PGT-A (4 Embryo)' && $val['code'] === 'IP114') ||
					($val['procedure_name'] === 'PGT-A (4 Embryo)- 2nd Cycle' && $val['code'] === 'IP187') ||
					($val['procedure_name'] === 'PGT-M (2 Embryos)' && $val['code'] === 'IP115') ||
					($val['procedure_name'] === 'PGT-M (2 Embryos)- 2nd Cycle' && $val['code'] === 'IP189') ||
					($val['procedure_name'] === 'PGT-M (3 Embryos)' && $val['code'] === 'IP116') ||
					($val['procedure_name'] === 'PGT-M (3 Embryos)- 2nd Cycle' && $val['code'] === 'IP191') ||
					($val['procedure_name'] === 'PGT-M (4 Embryo)' && $val['code'] === 'IP117') ||
					($val['procedure_name'] === 'PGT-M (4 Embryo)- 2nd Cycle' && $val['code'] === 'IP193') ||
					($val['procedure_name'] === 'PGT-SR (2 embryos)' && $val['code'] === 'IP118') ||
					($val['procedure_name'] === 'PGT-SR (2 embryos)- 2nd Cycle' && $val['code'] === 'IP195') ||
					($val['procedure_name'] === 'PGT-SR (3 embryos)' && $val['code'] === 'IP119') ||
					($val['procedure_name'] === 'PGT-SR (3 embryos)- 2nd Cycle' && $val['code'] === 'IP197') ||
					($val['procedure_name'] === 'PGT-SR (4 embryos)' && $val['code'] === 'IP120') ||
					($val['procedure_name'] === 'PGT-SR (4 embryos)- 2nd Cycle' && $val['code'] === 'IP199') ||
					($val['procedure_name'] === 'Comprehensive IVF Male: Recruitment & OI single cycle' && $val['code'] === 'IP225') ||
					($val['procedure_name'] === 'Comprehensive IVF Male: Procedure Charge single cycle' && $val['code'] === 'IP226') ||
					($val['procedure_name'] === 'Comprehensive IVF Male: Recruitment & OI second cycle' && $val['code'] === 'IP239') ||
					($val['procedure_name'] === 'Comprehensive IVF Male: Procedure Charge second cycle' && $val['code'] === 'IP240') ||
					($val['procedure_name'] === 'Comprehensive IVF Female: Recruitment & OI single cycle' && $val['code'] === 'IP227') ||
					($val['procedure_name'] === 'Comprehensive IVF Female: Procedure Charge single cycle' && $val['code'] === 'IP228') ||
					($val['procedure_name'] === 'Comprehensive IVF Female: Recruitment & OI second cycle' && $val['code'] === 'IP231') ||
					($val['procedure_name'] === 'Comprehensive IVF Female: Procedure Charge second cycle' && $val['code'] === 'IP232') ||
					($val['procedure_name'] === 'Comprehensive IVF Couple single cycle: Recruitment & OI single cycle' && $val['code'] === 'IP229') ||
					($val['procedure_name'] === 'Comprehensive IVF Couple single cycle: Procedure Charge single cycle' && $val['code'] === 'IP230') ||
					($val['procedure_name'] === 'Comprehensive IVF Couple single cycle: Recruitment & OI second cycle' && $val['code'] === 'IP235') ||
					($val['procedure_name'] === 'Comprehensive IVF Couple single cycle: Procedure Charge second cycle' && $val['code'] === 'IP236') ||
					($val['procedure_name'] === 'Embryo Freezing (6 months)' && $val['code'] === 'IP03') ||
					($val['procedure_name'] === 'Embryo Freezing: single straw (6months) 2nd Cycle' && $val['code'] === 'IP252') ||
					($val['procedure_name'] === 'Embryo Freezing: 2 straw (6months)' && $val['code'] === 'IP103') ||
					($val['procedure_name'] === 'Embryo Freezing: 2 straw (6months) 2nd Cycle' && $val['code'] === 'IP254') ||
					($val['procedure_name'] === 'Embryo Freezing: 3 straw (6months)' && $val['code'] === 'IP104') ||
					($val['procedure_name'] === 'Embryo Freezing: 3 straw (6months) 2nd Cycle' && $val['code'] === 'IP256') ||
					($val['procedure_name'] === 'Embryo Freezing: 4 straw (6months)' && $val['code'] === 'IP105') ||
					($val['procedure_name'] === 'Embryo Freezing: 4 straw (6months) 2nd Cycle' && $val['code'] === 'IP258') ||
					($val['procedure_name'] === 'Embryo freezing Renewal: single straw (6 months)' && $val['code'] === 'IP14') ||
					($val['procedure_name'] === 'Egg Donor (Indian Grade B)' && $val['code'] === 'IP26') ||
					($val['procedure_name'] === 'Embryo freezing: single straw (6 months) 3rd Renewal' && $val['code'] === 'IP261') ||
					($val['procedure_name'] === 'Egg Freezing: Single straw (6months)' && $val['code'] === 'IP12') ||
					($val['procedure_name'] === 'Egg Freezing: Single straw (6months) 2nd Cycle' && $val['code'] === 'IP263') ||
					($val['procedure_name'] === 'Egg Freezing: 2 straw (6months)' && $val['code'] === 'IP106') ||
					($val['procedure_name'] === 'Egg Freezing: 2 straw (6months) 2nd Cycle' && $val['code'] === 'IP265') ||
					($val['procedure_name'] === 'Egg Freezing: 3 straw (6months)' && $val['code'] === 'IP107') ||
					($val['procedure_name'] === 'Egg Freezing: 3 straw (6months) 2nd Cycle' && $val['code'] === 'IP267') ||
					($val['procedure_name'] === 'Egg Freezing: 4 straw (6months)' && $val['code'] === 'IP108') ||
					($val['procedure_name'] === 'Egg Freezing: 4 straw (6months) 2nd Cycle' && $val['code'] === 'IP269') ||
					($val['procedure_name'] === 'Egg freezing Renewal: single straw (6 months)' && $val['code'] === 'IP96') ||
					($val['procedure_name'] === 'Egg freezing: single straw (6 months) 2nd Renewal' && $val['code'] === 'IP271') ||
					($val['procedure_name'] === 'Egg freezing: single straw (6 months) 3rd Renewal' && $val['code'] === 'IP272') ||
					($val['procedure_name'] === 'Semen Freezing: single vial (6months)' && $val['code'] === 'IP18') ||
					($val['procedure_name'] === 'Semen Freezing: single vial (6months) 2nd Cycle' && $val['code'] === 'IP274') ||
					($val['procedure_name'] === 'Semen Freezing: 2 vials (6months)' && $val['code'] === 'IP109') ||
					($val['procedure_name'] === 'Semen Freezing: 2 vials (6months) 2nd Cycle' && $val['code'] === 'IP276') ||
					($val['procedure_name'] === 'Semen Freezing: 3 vials (6months)' && $val['code'] === 'IP110') ||
					($val['procedure_name'] === 'Semen Freezing: 3 vials (6months) 2nd Cycle' && $val['code'] === 'IP278') ||
					($val['procedure_name'] === 'Semen Freezing: 4 vials (6months)' && $val['code'] === 'IP111') ||
					($val['procedure_name'] === 'Semen Freezing: 4 vials (6months) 2nd Cycle' && $val['code'] === 'IP280') ||
					($val['procedure_name'] === 'Semen Freezing 6 Monthly renewal charges' && $val['code'] === 'IP17') ||
					($val['procedure_name'] === 'Semen Freezing Charges: single vial (6 monthly) 2nd Renewal' && $val['code'] === 'IP282') ||
					($val['procedure_name'] === 'Semen Freezing Charges: single vial (6 monthly) 3rd Renewal' && $val['code'] === 'IP283')

				) {
                    echo 'disabled';
                }
                ?>>
                <?php echo $val['procedure_name'] . " (" . $val['code'] . ")"; ?>
            </option>
    <?php } } ?>
</select>
							</td>
						</tr>
						
						
					<?php }else { ?>
					
					<?php $female_investigation_suggestion_list = array();
								 if(isset($patient_doctor_consultation['investation_suggestion']) && $patient_doctor_consultation['investation_suggestion'] == "1"){
									$female_investigation_suggestion_list = unserialize($patient_doctor_consultation['female_investigation_suggestion_list']); 
									$disabled = "";
									//var_dump($sub_procedure_suggestion_list);die;
							}?>
					<tr style="color: red;">
						<td>INVESTIGATIONS ADVISED</td>
						<td>							
								<?php if(!empty($female_investigation_suggestion_list)) {
									$cis=1;
									 foreach($female_investigation_suggestion_list as $key => $val) { ?>
											<?php echo $cis.". ".get_investigation_name($val); ?><br/>
								<?php  $cis++;} } ?>							
						</td>

						<td>
								<?php $male_investigation_suggestion_list=array();
									 if(isset($patient_doctor_consultation['investation_suggestion']) && $patient_doctor_consultation['investation_suggestion'] == "1"){
											$male_investigation_suggestion_list = unserialize($patient_doctor_consultation['male_investigation_suggestion_list']); 
											
											//var_dump($sub_procedure_suggestion_list);die;
									}
								?>
								<?php if(!empty($male_investigation_suggestion_list)) {
									$cis=1;
									 foreach($male_investigation_suggestion_list as $key => $val) { ?>
											<?php echo $cis.". ".get_investigation_name($val); ?><br/>
											
								<?php  $cis++; } } ?>
						</td>
					</tr>

					<?php $female_medicine_suggestion_arr = array(); 
									 if(isset($patient_doctor_consultation['medicine_suggestion']) && $patient_doctor_consultation['medicine_suggestion'] == "1"){
										$female_medicine_suggestion_list = unserialize($patient_doctor_consultation['female_medicine_suggestion_list']); 
										
										if(!empty($female_medicine_suggestion_list['female_medicine_suggestion_list']) && isset($female_medicine_suggestion_list['female_medicine_suggestion_list'])){
	   										foreach($female_medicine_suggestion_list['female_medicine_suggestion_list'] as $key => $val){
    											//var_dump($val);die;
    											$female_medicine_suggestion_arr[] = $val['female_medicine_name'];
    										}
										}
									}
								?>

					
					<tr>
						<td style="color: red;">MEDICATION ADVISED</td>
						<td>
							<div class="col-sm-12 col-xs-12">
							
								<hr/>
								<table id="female_medicine_table" style="width:100%; border:1px solid #000;" border='1'>
										<thead>
											<tr>
												<th style="border:1px solid #000; padding:10px;">Medicine</th>
												<th style="border:1px solid #000; padding:10px;">Dosage</th>
												<th style="border:1px solid #000; padding:10px;">Start on</th>
												<th style="border:1px solid #000; padding:10px;">Days</th>
												<th style="border:1px solid #000; padding:10px;">Route</th>
												<th style="border:1px solid #000; padding:10px;">Frequency</th>
												<th style="border:1px solid #000; padding:10px;">Timing</th>
												<th style="border:1px solid #000; padding:10px;">Take</th>
											</tr>
											<tbody id="female_medicine_suggestion_table">
												<?php if(!empty($female_medicine_suggestion_arr )){
													$fmd_count = 1;
													foreach($female_medicine_suggestion_list['female_medicine_suggestion_list'] as $key => $val){
														//var_dump($val);die;?>
													<tr style='border:1px solid #000;' count="<?php echo $fmd_count; ?>">
														<td style='border:1px solid #000;'><?php echo get_medicine_name($val['female_medicine_name']);?></td>
														<td style='border:1px solid #000;'><?php echo $val['female_medicine_dosage']?></td>
														<td style='border:1px solid #000;'><?php echo $val['female_medicine_when_start']?></td>
														<td style='border:1px solid #000;'><?php echo $val['female_medicine_days']?></td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['female_medicine_route']; ?>
														</td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['female_medicine_frequency']; ?>
														</td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['female_medicine_timing']; ?>
														</td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['female_medicine_take']; ?>
														</td>
													</tr>
												<?php $fmd_count++; }} ?>
											</tbody>
										</thead>
								</table>
							</div>
						</td>
						<td>
						<?php $male_medicine_suggestion_arr = array(); 
								 if(isset($patient_doctor_consultation['medicine_suggestion']) && $patient_doctor_consultation['medicine_suggestion'] == "1"){
										$male_medicine_suggestion_list = unserialize($patient_doctor_consultation['male_medicine_suggestion_list']); 
										$disabled = "";
										//var_dump($male_medicine_suggestion_list);die;
										if(!empty($male_medicine_suggestion_list['male_medicine_suggestion_list']) && isset($male_medicine_suggestion_list['male_medicine_suggestion_list'])){
    										foreach($male_medicine_suggestion_list['male_medicine_suggestion_list'] as $key => $val){
    											//var_dump($val);die;
    											$male_medicine_suggestion_arr[] = $val['male_medicine_name'];
    										}
										}
								}?>
							<div class="col-sm-12 col-xs-12">
								<hr/>
								<table style="width:100%; border:1px solid #000;" id="male_medicine_table" border='1'>
										<thead>
											<tr>
												<th style="border:1px solid #000; padding:10px;">Medicine</th>
												<th style="border:1px solid #000; padding:10px;">Dosage</th>
												<th style="border:1px solid #000; padding:10px;">Start on</th>
												<th style="border:1px solid #000; padding:10px;">Days</th>
												<th style="border:1px solid #000; padding:10px;">Route</th>
												<th style="border:1px solid #000; padding:10px;">Frequency</th>
												<th style="border:1px solid #000; padding:10px;">Timing</th>
												<th style="border:1px solid #000; padding:10px;">Take</th>
											</tr>
											<tbody id="male_medicine_suggestion_table">
												<?php if(!empty($male_medicine_suggestion_arr )){
													$mmd_count = 1;
													foreach($male_medicine_suggestion_list['male_medicine_suggestion_list'] as $key => $val){
														//var_dump($val);die;?>
													<tr style='border:1px solid #000;' count="<?php echo $mmd_count; ?>">
														<td style='border:1px solid #000;'><?php echo get_medicine_name($val['male_medicine_name']);?></td>
														<td style='border:1px solid #000;'><?php echo $val['male_medicine_dosage']?></td>
														<td style='border:1px solid #000;'><?php echo $val['male_medicine_when_start']?></td>
														<td style='border:1px solid #000;'><?php echo $val['male_medicine_days']?></td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['male_medicine_route']; ?>
														</td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['male_medicine_frequency']; ?>
														</td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['male_medicine_timing']; ?>
														</td>
														<td style='border:1px solid #000;' class='role'>
															<?php echo $val['male_medicine_take']; ?>
														</td>
													</tr>
												<?php $mmd_count++; }} ?>										
											</tbody>
										</thead>
								</table>
							</div>
						</td>
					</tr>
					<tr><td colspan="4">Inform on day one of menstrual cycle</td></tr>
					<?php $sub_procedure_suggestion_list = array();
						if(isset($patient_doctor_consultation['procedure_suggestion']) && $patient_doctor_consultation['procedure_suggestion'] == "1"){
							$sub_procedure_suggestion_list = unserialize($patient_doctor_consultation['sub_procedure_suggestion_list']); 
							$disabled = "";
							
						}
					?>
					<tr>
						<td style="color: red;">MANAGEMENT ADVISED</th>
						<td colspan="3" style="width:100px;">
					    	<?php 	$cis = 1;
									if(!empty($sub_procedure_suggestion_list)) {
										foreach($procedures as $key => $val) {
											if(in_array($val['ID'], $sub_procedure_suggestion_list)){
												echo $cis.". ".$val['procedure_name']." (".$val['code'].") <br/>";
												$cis++;
											}
										}
					             	}
					         ?>
						</td>
					</tr>
                    <?php } ?>
					
					<tr>
						<td style="color: red;">Advisory</td>
						<td colspan="2">
							<select class="form-control multidselect_dropdown_2"  multiple="multiple" id="advisory_templates" name="advisory_templates[]">
								<option value="pre_embryo_transfer_html">PRE EMBRYO TRANSFER</option>
								<option value="post_operative_instructions_after_ovum_pick_up_html">POST OPERATIVE INSTRUCTIONS AFTER OVUM PICK UP</option>
								<option value="post_operative_instructions_after_ovarian_prp_html">POST OPERATIVE INSTRUCTIONS AFTER OVARIAN PRP</option>
								<option value="post_fnac_testes_tprp_tesa_pesa_micro_tese_html">POST FNAC TESTES/ TPRP/TESA/PESA/MICRO TESE</option>
								<option value="post_embryo_transfer_html">POST EMBRYO TRANSFER</option>
								<option value="patient_information_section_html">PATIENT INFORMATION</option>
								<option value="ivf_vitro_fertilization_ivf_information_package_html">IN VITRO FERTILIZATION (IVF) INFORMATION PACKAGE</option>
								<option value="instructions_for_semen_collection_html">INSTRUCTIONS FOR SEMEN COLLECTION</option>
								<option value="day_2_day_5_fet_prescription_html">DAY 2 - DAY 5 FET PRESCRIPTION</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>NEXT FOLLOW UP <input style="left: 5px;position: relative;opacity: 1; top:3px;" type="hidden" id="follow_up" checked value="1" name="follow_up" /></th>
						
						<td colspan="2">
							<!-- <div class="col-sm-12 col-xs-12">
								<input type="text" placeholder="yy-mm-dd" autocomplete="off" disabled="disabled" id="follow_up_date" name="follow_up_date" />
							</div>
							<div class="row appoitmented_slot" style="display:none;">            
								<div class="form-group col-sm-6 col-xs-12 role">
									<label for="statuss">Follow up slot (Required)</label>
									<select name="appoitmented_slot" class="empty-field" id="appoitmented_slot">
										<option value="">Select</option>
									</select>
								</div>
							</div> -->
							<div class="row">            
								<div class="form-group col-sm-6 col-xs-12 role">
									<label for="statuss">Centre (Required)</label>
									<select name="appoitment_for" required class="empty-field" id="appoitment_for">
										<option value="">Select</option>
										<?php $center = $all_method->get_center_list(); foreach($center as $key => $center){?>
										<option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
         
								<div class="row appoitmented_doctor" style="display:none;">            
									<div class="form-group col-sm-6 col-xs-12 role">
										<label for="statuss">Doctor (Required)</label>
										<select name="appoitmented_doctor" disabled class="empty-field" id="appoitmented_doctor">
											<option value="">Select</option>
										</select>
									</div>
								</div>
								
								<div class="row appoitmented_date" style="display:none;">            
									<div class="form-group col-sm-6 col-xs-12 role">
										<label for="statuss">Appointment date (Required)</label>
										<input value="" id="appoitmented_date" disabled autocomplete="off" name="follow_up_date" type="text" class="form-control empty-field validate" >
									</div>
								</div>
								
								<div class="row appoitmented_slot" style="display:none;">            
									<div class="form-group col-sm-6 col-xs-12 role">
										<label for="statuss">Appoitmented_slot (Required)</label>
										<select name="appoitmented_slot" disabled class="empty-field" id="appoitmented_slot">
											<option value="">Select</option>
										</select>
									</div>
								</div>
								</div>
							</div>
						</td>
						
					</tr><br>
					<tr>
						<th>PURPOSE OF NEXT FOLLOWUP</th>
						<td colspan="2">
							<!-- <input type="radio" name="follow_up_purpose" value="FIRST CONSULTATION">
							<label>FIRST CONSULTATION</label> -->
							<input type="radio" name="follow_up_purpose" value="TVS">
							<label>TVS</label>
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
//Centre Doctor
$('#appoitment_for').on("change", function() {
	$('div.appoitmented_doctor').hide();
	$('div.appoitmented_date').hide();
	$('div.appoitmented_slot').hide();
	
	$('#loader_div').show();
	var centre_id = $(this).val();
	if(centre_id != ''){
		$.ajax({
		url: '<?php echo base_url('billingcontroller/search_doctor')?>',
		data: {centre_id:centre_id},
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			$('#appoitmented_doctor').empty().append(data);

			$("#appoitmented_doctor").prop('required',true);
			$("#appoitmented_doctor").prop('disabled',false);
			
			$('div.appoitmented_doctor').show();
			$('#loader_div').hide();			
		} 
  });
    }
	else{
		$('div.appoitmented_doctor').hide();
		$('#loader_div').hide();
	}
});

$('#appoitmented_doctor').on("change", function() {
	$('#loader_div').show();
	var doctor_id = $(this).val();
	$('input#appoitmented_date').val('');
	if(doctor_id != ''){
		$("#appoitmented_date").prop('required',true);
		$("#appoitmented_date").prop('disabled',false);
		$('div.appoitmented_date').show();
	}else{
		$('div.appoitmented_date').hide();
	}
	$('#loader_div').hide();
});

$( function() {
    $( "#appoitmented_date" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		 	minDate: 0,
			onSelect: function(dateStr) {
				$('#loader_div').show();				
				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
				var appoitmented_doctor = $('#appoitmented_doctor').val();
				$.ajax({
					url: '<?php echo base_url('billingcontroller/doctor_slots')?>',
					type: 'POST',
					data: {selected:startDate, appoitmented_doctor:appoitmented_doctor},
					success: function(data) {
						$('#appoitmented_slot').empty().append(data);
						$("#appoitmented_slot").prop('required',true);
						$("#appoitmented_slot").prop('disabled',false);
						$('div.appoitmented_slot').show();
						$('#loader_div').hide();
					}
				});
			}
		});
} );

$("#follow_up").change(function() {
	$('div.appoitmented_doctor').hide();
	$('div.appoitmented_date').hide();
	$('div.appoitmented_slot').hide();
	
	$('#appoitment_for').prop('selectedIndex',0);
	$("#appoitment_for").prop('required',false);
	$("#appoitment_for").prop('disabled',true);
	$('#appoitmented_doctor').prop('selectedIndex',0);
	$("#appoitmented_doctor").prop('required',false);
	$("#appoitmented_doctor").prop('disabled',true);

	$("#appoitmented_date").val('');
	$("#appoitmented_date").prop('required',false);
	$("#appoitmented_date").prop('disabled',true);
	
	$('#appoitmented_slot').prop('selectedIndex',0);
	$("#appoitmented_slot").prop('required',false);
	$("#appoitmented_slot").prop('disabled',true);
	

	if(this.checked) {
		$("#appoitment_for").prop('required',true);
		$("#appoitment_for").prop('disabled',false);
	}
});

$(function() {
$('#male_medicine_suggestion_list').change(function(e) {
	$("table#male_medicine_table").hide();
	var brands = $('#male_medicine_suggestion_list option:selected');
	var selected = "";
	var countr=1;
	$("tbody#male_medicine_suggestion_table").empty();
	$(brands).each(function(index, brand){
		$("tbody#male_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='male_medicine_name_"+countr+"' id='male_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' style='margin:0;padding:0;' name='male_medicine_dosage_"+countr+"' required id='male_medicine_dosage_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' placeholder='DD-MM-YYYY' style='margin:0;padding:0;' name='male_medicine_when_start_"+countr+"' id='male_medicine_when_start_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_days_"+countr+"' required id='male_medicine_days_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_route_"+countr+"' id='male_medicine_route_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_frequency_"+countr+"' id='male_medicine_frequency_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_timing_"+countr+"' id='male_medicine_timing_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_take_"+countr+"' id='male_medicine_take_"+countr+"' required> <option value='Daily'>Daily</option> <option value='Biweekly'>Biweekly</option> <option value='Weekly'>Weekly</option> <option value='Blank'>Blank</option> <option value='Alternate Day'>Alternate Day</option></select></td></tr>");
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
		$("tbody#female_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='female_medicine_name_"+countr+"' id='female_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' style='margin:0;padding:0;' name='female_medicine_dosage_"+countr+"' required id='female_medicine_dosage_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' placeholder='DD-MM-YYYY' style='margin:0;padding:0;' name='female_medicine_when_start_"+countr+"' id='female_medicine_when_start_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_days_"+countr+"' required id='female_medicine_days_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_route_"+countr+"' id='female_medicine_route_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_frequency_"+countr+"' id='female_medicine_frequency_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_timing_"+countr+"' id='female_medicine_timing_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_take_"+countr+"' id='female_medicine_take_"+countr+"' required> <option value='Daily'>Daily</option> <option value='Biweekly'>Biweekly</option> <option value='Weekly'>Weekly</option> <option value='Blank'>Blank</option> <option value='Alternate Day'>Alternate Day</option></select></td></tr>");
		countr++;
		//selected.push([$(this).val()+"--------"+$(this).attr('medicine')]);
	});
	//console.log(selected);
	$("table#female_medicine_table").show();
}); 
});



$( function() {
$( ".datepicker" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		onSelect: function(dateStr) {}
	});
});

// $( function() {
//     $( "#follow_up_date" ).datepicker({
// 			dateFormat: 'yy-mm-dd',
// 			changeMonth: true,
// 			changeYear: true,
// 		 	minDate: 0,
// 			onSelect: function(dateStr) {
// 				$('#loader_div').show();				
// 				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
// 				var appoitmented_doctor = $('#doctor_id').val();
// 				$.ajax({
// 					url: '<?php echo base_url('billingcontroller/doctor_slots')?>',
// 					type: 'POST',
// 					data: {'selected':startDate, 'appoitmented_doctor':appoitmented_doctor},
// 					success: function(data) {
// 						$('#appoitmented_slot').empty().append(data);
// 						$('div.appoitmented_slot').show();
// 						$('#loader_div').hide();
// 					}
// 				});
// 			}
// 		});
// } );

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
	$("select#male_medicine_suggestion_list").prop('required',false);
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
	$("select#male_investigation_suggestion_list").prop('required',false);
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
    // $('.multidselect_dropdown').multiselect({ includeSelectAllOption: true });
    // $('.multidselect_dropdown_1').multiselect({ includeSelectAllOption: true });
    // $('.multidselect_dropdown_2').multiselect({ includeSelectAllOption: true });
    $('.multidselect_dropdown').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		filterPlaceholder: 'Search for something...'
	}); 

	$('.multidselect_dropdown_1').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		filterPlaceholder: 'Search for something...'
	}); 

	$('.multidselect_dropdown_2').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		filterPlaceholder: 'Search for something...'
	});
});


</script>
