 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
       <div class="card-action"><h3>OPD Register</h3></div>
        <div class="col-sm-12 col-xs-12">
        <form action="<?php echo base_url().'doctors/doctor_patient'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12 ">
            	<label>Filter by doctor</label>
                <select class="form-control" id="doctor" name="doctor">
                	<option value="">--Select--</option>
                    <?php $doctor_list = $all_method->center_doctors(); 
						 foreach($doctor_list as $key => $vals){
					?>
                	<option value="<?php echo $vals['ID']; ?>"><?php echo $vals['name']; ?></option>
                    <?php } ?>                    
                </select>
            </div>
		    <div class="col-sm-3 col-xs-12 ">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12 ">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12 ">
				<label>Patient ID</label>
                <input type="text" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" class="form-control" />
            </div>
            <div class="col-sm-1" style="margin-top: 22px;">
            	<button name="search" type="submit"  class="btn btn-primary">Search</button>
            </div>
           
            </form>  
            <div class="col-sm-1" style="margin-top: 22px;">
            	<a href="<?php echo base_url().'doctors/doctor_patient'; ?>" style="text-decoration: none;">
                <button name="search" type="submit"  class="btn btn-secondary">RESET</button>
               </a>
            </div>  
             <div class="col-sm-2" style="margin-top: 10px;">
            	<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv2();'>
            </div>
        </div>
		
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="doctor_appointments1">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>ID</th>
				  <th>Date</th>
				  <th>CRM ID</th>
				  <th></th>
				  <th>Appointment ID</th>
				  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Age</th>
                  <th>Doctor</th>
                  <th>Purpose</th>
                  <th>Male Investigation</th>
				  <th>Female Investigation</th>
                  <th>Procedure</th>
				  <th>Male Medicine</th>
				  <th>Female Medicine</th>
				  <th>Next Follow Up</th>
				  <th>Package Name</th>
				  <th>Status</th>
				  <th>Counselor Name</th>
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; foreach($app_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td>
				   <?php  if($_SESSION['logged_counselor']){ ?>
                   <?php  if ($vl['procedure_suggestion'] == 1) { ?>
                    <a href="<?php echo base_url().'billings/forma_invoice/'; ?><?php echo $vl['ID']; ?>" class="btn btn-primary pull-right" target="_blank">Procedure</a>
                  <?php } ?>
				  <?php if($vl['package_suggestion'] == 1) { ?>
                    <a href="<?php echo base_url().'billings/procedure_package/'; ?><?php echo $vl['ID']; ?>" class="btn btn-primary pull-right" target="_blank">Package</a>
                  <?php } ?>
				 <?php } elseif ($_SESSION['logged_billing_manager']) { ?>
				   <?php  if ($vl['procedure_suggestion'] == 1) { ?>
                    <a href="<?php echo base_url().'after-consultation-step-2?t=procedure_billing&i='; ?><?php echo $vl['ID']; ?>" class="btn btn-primary pull-right" target="_blank">Procedure</a>
                  <?php } if ($vl['investation_suggestion'] == 1) { ?>
                    <a href="<?php echo base_url().'after-consultation-step-2?t=investigation_billing&i='; ?><?php echo $vl['ID']; ?>" class="btn btn-primary pull-right" target="_blank">Investation</a>
                  <?php } if ($vl['medicine_suggestion'] == 1) { ?>
                    <a href="<?php echo base_url().'stocks/add_billing_medicine?appointment_id='; ?><?php echo $vl['appointment_id']; ?>" class="btn btn-primary pull-right" target="_blank">Medicine</a>
					<?php } if ($vl['package_suggestion'] == 1) { ?>
                    <a href="<?php echo base_url().'after-consultation-step-2?t=package_billing&i='; ?><?php echo $vl['ID']; ?>" class="btn btn-primary pull-right" target="_blank">Package</a>
                 <?php } ?>
				  <?php } ?>
                  </td>
				  <td><?php echo $vl['consultation_date']; ?></td>
				  <td><?php $sql_app = "SELECT * FROM `hms_appointments` WHERE paitent_id=".$vl['patient_id']."";
				  $select_result_appo = run_select_query($sql_app);
				  echo '<br>';
                  echo $select_result_appo['crm_id'];
				  ?></td>
				  <td><?php echo $select_result_appo['wife_phone']; ?></td>
				  <td><?php echo $vl['appointment_id']; ?></td>
				  <td><?php echo $vl['patient_id']; ?></td>
				  <td><?php $sql = "SELECT * FROM `hms_patient_medical_info` WHERE patient_id=".$vl['patient_id']."";
				  $select_result = run_select_query($sql);
				  echo '<br>';
                  echo $select_result['female_name'];
				  ?></td>
                  <td><?php echo $select_result['female_age']; ?></td>
                  <td><?php echo $all_method->doctor_name($vl['doctor_id']); ?></td>
                  <td><?php echo $vl['follow_up_purpose']?></td>
                  <td><?php $serializedString = $vl['male_investigation_suggestion_list'];
                             $unserializedArray = unserialize($serializedString);
							foreach ($unserializedArray as $key => $value) {
								$sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($value)";
				                 $select_result2 = run_select_query($sql2);
								 echo $select_result2['investigation'] . ",";
							//	 echo $select_result2['price'] . "\n";
							//	 echo '<br>';
							} ?>
							<?php
							$serializedString = $vl['male_minvestigation_suggestion_list'];
							$unserializedArray = unserialize($serializedString);

							if (is_array($unserializedArray)) {
								foreach ($unserializedArray as $key => $value) {
									$id = (int)$value; // safely cast to integer
									$sql_male = "SELECT * FROM `hms_master_investigations` WHERE ID = $id";
									$select_male = run_select_query($sql_male);

									if (!empty($select_male) && isset($select_male['investigation_name'])) {
										echo $select_male['investigation_name'] . ", ";
									}
								}
							}
							?>

					</td>
					<td><?php $serializedStringfemale = $vl['female_investigation_suggestion_list'];
                             $unserializedArrayfemale = unserialize($serializedStringfemale);
							foreach ($unserializedArrayfemale as $key => $ids) {
								$sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($ids)";
				                 $female_result = run_select_query($sql2);
								 echo $female_result['investigation'] . ",";
								// echo $female_result['price'] . "\n";
								// echo '<br>';
							} ?>
							<?php
							$serializedStringfemale = $vl['female_minvestigation_suggestion_list'];
							$unserializedArrayfemale = unserialize($serializedStringfemale);

							if (is_array($unserializedArrayfemale)) {
								foreach ($unserializedArrayfemale as $key => $id) {
									$id = (int)$id; // sanitize
									$sql2 = "SELECT * FROM `hms_master_investigations` WHERE ID = $id";
									$female_result = run_select_query($sql2);

									if (!empty($female_result) && isset($female_result['investigation_name'])) {
										echo $female_result['investigation_name'] . ", ";
									}
								}
							}
							?>

					</td>
					<td><?php $serializedStringfemale = $vl['sub_procedure_suggestion_list'];
                             $unserializedArrayfemale = unserialize($serializedStringfemale);
							foreach ($unserializedArrayfemale as $key => $ids) {
								$sql2 = "SELECT * FROM `hms_procedures` WHERE ID IN ($ids)";
				                 $female_result = run_select_query($sql2);
								 echo $female_result['procedure_name'] . ",";
								// echo $female_result['price'] . "\n";
								// echo '<br>';
							} ?>
					</td>
					<td><?php $serializedMaleMedicine = $vl['male_medicine_suggestion_list'];
                             $unserializedArrayMaleMedicine = unserialize($serializedMaleMedicine);
							 $male_medicine_suggestion_list = $unserializedArrayMaleMedicine['male_medicine_suggestion_list'];
							 foreach ($male_medicine_suggestion_list as $suggestion) {
							 $item_number = $suggestion['male_medicine_name'];
							$sql_que = "SELECT * FROM `hms_stocks` WHERE item_number = '$item_number'";
							$malemed_result = run_select_query($sql_que);
							if ($malemed_result) {
							echo $malemed_result['item_name'] . ",";
							}
							}
							 ?>
					</td>
					
					<td><?php $serializedfeMaleMedicine = $vl['female_medicine_suggestion_list'];
                             $unserializedArrayfeMaleMedicine = unserialize($serializedfeMaleMedicine);
							 $female_medicine_suggestion_list = $unserializedArrayfeMaleMedicine['female_medicine_suggestion_list'];
							 foreach ($female_medicine_suggestion_list as $suggestion) {
							 $item_number = $suggestion['female_medicine_name'];
							$sql_quefe = "SELECT * FROM `hms_stocks` WHERE item_number = '$item_number'";
							$femalemed_result = run_select_query($sql_quefe);
							if ($femalemed_result) {
							echo $femalemed_result['item_name'] . ",";
							}
							}
							 ?>
					</td>
					<td><?php echo $vl['follow_up_date']; ?> - <?php echo $vl['follow_slot']; ?></td>
					<td><?php

$package_suggestion_list = unserialize($vl['package_suggestion_list']);

if ($package_suggestion_list !== false && is_array($package_suggestion_list)) {
    foreach ($package_suggestion_list as $package_name => $group) {
        if (is_numeric($package_name)) {
            $package_name = "Package " . ($package_name + 1);
        }

        $procedure_ids = explode(',', $group);
        $rowspan = count($procedure_ids);
        $package_total_price = 0;

        $first_procedure_id = trim($procedure_ids[0]);
        $sql4 = "SELECT * FROM hms_procedure_package WHERE procedure_id='$first_procedure_id'";
        $select_result4 = run_select_query($sql4);

        // Calculate total price for the entire package
        foreach ($procedure_ids as $procedure_id) {
            $procedure_id = trim($procedure_id);

            if (!empty($procedure_id)) {
                $sql_quefe = "SELECT * FROM hms_procedures WHERE ID = '$procedure_id'";
                $femalemed_result = run_select_query($sql_quefe);
            }
        }
		?>
         <?= htmlspecialchars($select_result4['package_name']); ?>
           
        <?php
    }
}
?>
					</td>
					
					<td><?php if ($vl['status'] == '1') { echo 'Approve'; } else { echo 'Pending'; } ?></td>
					<td><?php echo $vl['counsellor_signature']; ?></td>
                </tr>
              <?php $count++; } ?>
              <tr>
                <td colspan="7">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
		
		<div class="row" id="print_this_section2" style="display:none;">
	  <table class="table table-striped table-bordered table-hover" id="doctor_appointments1">
              <thead>
                <tr>
                  <th style="border:1px solid #ccc;">S. No.</th>
				  <th style="border:1px solid #ccc;">Date</th>
				  <th style="border:1px solid #ccc;">IIC ID</th>
                  <th style="border:1px solid #ccc;">Patient Name</th>
                  <th style="border:1px solid #ccc;">Age</th>
                  <th style="border:1px solid #ccc;">Husband Name</th>
                  <th style="border:1px solid #ccc;">Purpose</th>
                  <th style="border:1px solid #ccc;">Male Investigation</th>
				  <th style="border:1px solid #ccc;">Female Investigation</th>
                  <th style="border:1px solid #ccc;">Male Medicine</th>
				  <th style="border:1px solid #ccc;">Female Medicine</th>
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; foreach($app_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td style="border:1px solid #ccc;"><?php echo $count; ?></td>
				           <td style="border:1px solid #ccc;"><?php echo $vl['consultation_date']; ?></td>
                  <td style="border:1px solid #ccc;"><?php echo $vl['patient_id']; ?></td>
				  <td style="border:1px solid #ccc;"><?php $sql = "SELECT * FROM `hms_patient_medical_info` WHERE patient_id=".$vl['patient_id']."";
				  $select_result = run_select_query($sql);
				  echo '<br>';
                  echo $select_result['female_name'];
				  ?></td>
                  <td style="border:1px solid #ccc;"><?php echo $select_result['female_age']; ?></td>
                  <td style="border:1px solid #ccc;"><?php echo $select_result['male_name']; ?></td>
                  <td style="border:1px solid #ccc;"><?php echo $vl['follow_up_purpose']?></td>
                  <td style="border:1px solid #ccc;"><?php $serializedString = $vl['male_investigation_suggestion_list'];
                             $unserializedArray = unserialize($serializedString);
							foreach ($unserializedArray as $key => $value) {
								$sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($value)";
				                 $select_result2 = run_select_query($sql2);
								 echo $select_result2['investigation'] . "\n";
								 echo '<br>';
							} ?>
					</td>
					<td style="border:1px solid #ccc;"><?php $serializedStringfemale = $vl['female_investigation_suggestion_list'];
                             $unserializedArrayfemale = unserialize($serializedStringfemale);
							foreach ($unserializedArrayfemale as $key => $ids) {
								$sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($ids)";
				                 $female_result = run_select_query($sql2);
								 echo $female_result['investigation'] . "\n";
								 echo '<br>';
							} ?>
					</td>
					<td style="border:1px solid #ccc;"><?php $serializedMaleMedicine = $vl['male_medicine_suggestion_list'];
                             $unserializedArrayMaleMedicine = unserialize($serializedMaleMedicine);
							 $male_medicine_suggestion_list = $unserializedArrayMaleMedicine['male_medicine_suggestion_list'];
							 foreach ($male_medicine_suggestion_list as $suggestion) {
							 $item_number = $suggestion['male_medicine_name'];
							$sql_que = "SELECT * FROM `hms_stocks` WHERE item_number = '$item_number'";
							$malemed_result = run_select_query($sql_que);
							if ($malemed_result) {
							echo $malemed_result['item_name'] . "<br>";
							}
							}
							 ?>
					</td>
					<td style="border:1px solid #ccc;"><?php $serializedfeMaleMedicine = $vl['female_medicine_suggestion_list'];
                             $unserializedArrayfeMaleMedicine = unserialize($serializedfeMaleMedicine);
							 $female_medicine_suggestion_list = $unserializedArrayfeMaleMedicine['female_medicine_suggestion_list'];
							 foreach ($female_medicine_suggestion_list as $suggestion) {
							 $item_number = $suggestion['female_medicine_name'];
							$sql_quefe = "SELECT * FROM `hms_stocks` WHERE item_number = '$item_number'";
							$femalemed_result = run_select_query($sql_quefe);
							if ($femalemed_result) {
							echo $femalemed_result['item_name'] . "<br>";
							}
							}
							 ?>
					</td>
                </tr>
              <?php $count++; } ?>
              <tr>
                <td colspan="7">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
	</div>
      </div>
      <!--End Advanced Tables -->
    </div>

<script>
    $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var data = {appointment_date:startDate, type:'particular_date_filter'};
          }
        });
    });
</script>
<script>
function printDiv2() {
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section2');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
</script>
<style >
.custom-pagination{
  padding:8px;
}
.custom-pagination a{
  padding:10px;
  text-decoration: none;
}
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
  </style>
