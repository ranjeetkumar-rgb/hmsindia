 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
       <div class="card-action"><h3>Revenue Potential</h3></div>
        <div class="col-sm-12 col-xs-12">
        <form action="<?php echo base_url().'accounts/revenue_potential'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Center</label>
                <select class="form-control" id="center_number" name="center_number">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($billing_at == $val['center_number']){
                            echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
			<div class="col-sm-3 col-xs-12 ">
				<label>Patient ID</label>
                <input type="text" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" class="form-control" />
            </div>
			 <div class="col-sm-2 col-xs-12">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-2 col-xs-12">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-2" style="margin-top: 22px;">
            	<button name="search" type="submit"  class="btn btn-primary">Search</button>
            	<a href="<?php echo base_url().'accounts/revenue_potential'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div> 
           
            </form>  
        </div>
		
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="doctor_appointments1">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Date</th>
				  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th style="width: 200px;">Investigation Advice Price</th>
                  <th style="width: 280px;">Investigation Billing Price</th>
                  <th style="width: 280px;">Procedure Advice Price</th>
                  <th style="width: 280px;">Procedure Billing Price</th>
				  <th style="width: 280px;">Medicine Advice Price</th>
				  <th style="width: 280px;">Discharge Summry Price</th>
				  <th style="width: 280px;">Medicine Billing Price</th>
				</tr>
              </thead>
              <tbody id="appointment_body">
                    <?php $count = 1; foreach($app_result as $ky => $vl){
							$sql4 = "SELECT * FROM `iui_discharge_summary` WHERE iic_id='".$vl['patient_id']."'";
							$select_result4 = run_select_query($sql4);

							$sql6 = "SELECT * FROM `ovum_pickup_discharge_summary` WHERE iic_id='".$vl['patient_id']."'";
							$select_result6 = run_select_query($sql6);

							$sql7 = "SELECT * FROM `pre_embryo_transfer_iui` WHERE iic_id='".$vl['patient_id']."'";
							$select_result7 = run_select_query($sql7);

							$sql8 = "SELECT * FROM `ovarian_prp_discharge_summary` WHERE iic_id='".$vl['patient_id']."'";
							$select_result8 = run_select_query($sql8);

							$sql9 = "SELECT * FROM `day2_day5_fet_prescription` WHERE iic_id='".$vl['patient_id']."'";
							$select_result9 = run_select_query($sql9);

							$sql10 = "SELECT * FROM `embryo_transfer_discharge_summary` WHERE iic_id='".$vl['patient_id']."'";
							$select_result10 = run_select_query($sql10);

							$sql11 = "SELECT * FROM `hysteroscopy_laparoscopy_discharge_summary` WHERE iic_id='".$vl['patient_id']."'";
							$select_result11 = run_select_query($sql11);
						?>
                    <tr class="odd gradeX">
                        <td><?php echo $count; ?></td>
                        <td><?php echo $vl['consultation_date']; ?></td>
                        <td><a href="<?php echo base_url().'accounts/revenue_potential_details'; ?>/<?php echo $vl['patient_id']; ?>"><?php echo $vl['patient_id']; ?></a></td>
				        <td><?php $sql = "SELECT * FROM `hms_patient_medical_info` WHERE patient_id='".$vl['patient_id']."'";
				        $select_result = run_select_query($sql);
				        echo '<br>';
                        echo $select_result['female_name'];
				        ?></td>
				        <td><?php
                            // Initialize total prices for male and female investigations
                            $totalMalePrice = 0;
                            $totalFemalePrice = 0;
                            // Process male investigations
                            $serializedString = $vl['male_investigation_suggestion_list'];
                            $unserializedArray = unserialize($serializedString);
                            if (!empty($unserializedArray)) {
                            foreach ($unserializedArray as $key => $value) {
                            $sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($value)";
                            $select_result2 = run_select_query($sql2);
                            // Accumulate male investigation price
                            $totalMalePrice += (float)$select_result2['price'];
                            }
                             //   echo "Total Male Investigation Price: " . $totalMalePrice . "<br>";
                            }
                            // Process female investigations
                            $serializedStringfemale = $vl['female_investigation_suggestion_list'];
                            $unserializedArrayfemale = unserialize($serializedStringfemale);
                            if (!empty($unserializedArrayfemale)) {
                            foreach ($unserializedArrayfemale as $key => $ids) {
                            $sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($ids)";
                            $female_result = run_select_query($sql2);
                            // Accumulate female investigation price
                            $totalFemalePrice += (float)$female_result['price'];
                            }
                            //   echo "Total Female Investigation Price: " . $totalFemalePrice . "<br>";
                            }
							
							// Initialize total prices for male and female investigations
                            $totalMalePrice = 0;
                            $totalFemalePrice = 0;
                            // Process male investigations
                            $serializedString = $vl['male_minvestigation_suggestion_list'];
                            $unserializedArray = unserialize($serializedString);
                            if (!empty($unserializedArray)) {
                            foreach ($unserializedArray as $key => $value) {
                            $sql3 = "SELECT * FROM `hms_investigation` WHERE master_id IN ($value)";
                            $select_result2 = run_select_query($sql3);
                            // Accumulate male investigation price
                            $totalMalePrice += (float)$select_result2['price'];
                            }
                             //   echo "Total Male Investigation Price: " . $totalMalePrice . "<br>";
                            }
                            // Process female investigations
                            $serializedStringfemale = $vl['female_minvestigation_suggestion_list'];
                            $unserializedArrayfemale = unserialize($serializedStringfemale);
                            if (!empty($unserializedArrayfemale)) {
                            foreach ($unserializedArrayfemale as $key => $ids) {
                            $sql4 = "SELECT * FROM `hms_investigation` WHERE master_id IN ($ids)";
                            $female_result = run_select_query($sql4);
                            // Accumulate female investigation price
                            $totalFemalePrice += (float)$female_result['price'];
                            }
                            //   echo "Total Female Investigation Price: " . $totalFemalePrice . "<br>";
                            }
                            // Calculate and display grand total price
                            $grandTotalPrice = $totalMalePrice + $totalFemalePrice;
                            echo "Total Price: " . $grandTotalPrice . "<br>";
                            ?>
					    </td>
                        <td><?php 
                            $sql = "SELECT investigations, totalpackage, discount_amount, fees FROM hms_patient_investigations WHERE appointment_id='" . $vl['appointment_id'] . "' AND patient_id='".$vl['patient_id']."' AND status IN ('pending', 'approved') ";
                            $result = run_select_query($sql); // Assuming this function fetches the row as an associative array
                           
							echo "Total Package: " . ($result['totalpackage'] ?? '0') . "<br>";
                            echo "Discount Amount: " . ($result['discount_amount'] ?? '0') . "<br>"; 
                            echo "Paid Amount: " . ($result['fees'] ?? '0') . "<br>"; 
                            ?>
					    </td>
					    <td><?php   $serializedStringfemale = $vl['sub_procedure_suggestion_list'];
                                    $unserializedArrayfemale = unserialize($serializedStringfemale);
                                    $totalPrice = 0; // Initialize the total price
                                    foreach ($unserializedArrayfemale as $key => $ids) {
                                    $sql2 = "SELECT * FROM `hms_procedures` WHERE ID IN ($ids)";
                                    $female_result = run_select_query($sql2);
                                    $totalPrice += (float)$female_result['price'];
                                    }
                                    // Display the total price
                                    echo "Total Price: " . $totalPrice . "<br>";
                                    ?>
					    </td>
					    <td><?php 
								$sql = "SELECT SUM(fees) AS total_fees, SUM(totalpackage) AS total_package, SUM(discount_amount) AS total_discount FROM `hms_patient_procedure` WHERE appointment_id='" . $vl['appointment_id'] . "' AND patient_id='".$vl['patient_id']."' AND status IN ('pending', 'approved')  ";
								$amount_result = run_select_query($sql);

								echo "Total Package: ".$amount_result['total_package']."<br>";
								echo "Total Discount: ". $amount_result['total_discount']."<br>";
								echo "Total Fees: ".$amount_result['total_fees']."<br>";
							?>
					    </td>
						<td>
							<table id="medicine_list_table">
                       
                        <tbody>
		<?php 
		$grand_total = 0; // ✅ Initialize total outside the loop
		$female_med_count = 1;
		$maleserialized_data = $vl['male_medicine_suggestion_list'];
		// ✅ Unserialize the data
		$unserialized_data = unserialize($maleserialized_data);
		
		//var_dump($unserialized_data);
		// ✅ Check if unserialization was successful
		if ($unserialized_data !== false && isset($unserialized_data['male_medicine_suggestion_list'])) {
		$medicine_list = $unserialized_data['male_medicine_suggestion_list'];
		foreach ($medicine_list as $key => $val) {//var_dump($val['male_medicine_frequency']);die;
                $frequency = medical_frequency($val['male_medicine_frequency']);
                $medicine_details = $all_method->get_medicine_details($val['male_medicine_name']); //var_dump($medicine_details);die;
                $medicine_details['unit_price'] = product_vendor_cost($medicine_details['product_id'], $medicine_details['brand_name'], $medicine_details['vendor_number']); 
                //$subtotal = 0;
                //$subtotal = ($val['male_medicine_days']*$frequency)*($medicine_details['unit_price']*$val['male_medicine_dosage']);
				
				$sql = "Select * from ".$this->config->item('db_prefix')."stock_products where ID='".$medicine_details['product_id']."'";
				$select_result = run_select_query($sql);

				if ($select_result['type'] == "Cyrup") {
				$subtotal = 0;
				$subtotal = (1 * 1)*($medicine_details['unit_price']* 1);
				}else{
				$subtotal = 0;
				$subtotal = ($val['male_medicine_days']*$frequency)*($medicine_details['unit_price']*$val['male_medicine_dosage']);
				}
                ?>
             <?php  $grand_total +=  $subtotal; $male_med_count++; }} ?>
     
      <?php 
		$grand_total = 0; // ✅ Initialize total outside the loop
		$female_med_count = 1;
	   $serialized_data = $vl['female_medicine_suggestion_list'];
		// ✅ Unserialize the data
		$unserialized_data = unserialize($serialized_data);
		// ✅ Check if unserialization was successful
		if ($unserialized_data !== false && isset($unserialized_data['female_medicine_suggestion_list'])) {
		$medicine_list = $unserialized_data['female_medicine_suggestion_list'];
		foreach ($medicine_list as $key => $val) {
			
			$frequency = medical_frequency($val['female_medicine_frequency']);
			$medicine_details = $all_method->get_medicine_details($val['female_medicine_name']); //var_dump($medicine_details);die;
            $medicine_details['unit_price'] = product_vendor_cost($medicine_details['product_id'], $medicine_details['brand_name'], $medicine_details['vendor_number']);
            
			$sql = "Select * from ".$this->config->item('db_prefix')."stock_products where ID='".$medicine_details['product_id']."'";
			$select_result = run_select_query($sql);

			if ($select_result['type'] == "Cyrup") {
			$subtotal = 0;
            $subtotal = (1 * 1)*($medicine_details['unit_price']* 1);
			}else{
			$subtotal = 0;
            $subtotal = ($val['female_medicine_days']*$frequency)*($medicine_details['unit_price']*$val['female_medicine_dosage']);
			}
		 ?>
		<?php  $grand_total +=  $subtotal; $female_med_count++; }} ?>
		
		<tr>
              <td colspan='6'>
                <strong>SUB TOTAL :-</strong>
              </td>
              <td>
                <strong id="medicine_total"><?php echo round($grand_total, 2); ?></strong>
                <input value="<?php echo round($grand_total, 2); ?>" readonly="readonly" id="medicine_sub_total" class="form-control required_value form-control" type="hidden" required>
              </td>
            </tr>
            </tbody>
					</table>
						</td>
						<td>
						
						<?php  
$medicineData = [
    'TabCrocin' => ['mrp' => 20.16, 'pack' => 20, 'days' => 16],
    'Sypcremaffin' => ['mrp' => 327.58, 'pack' => 1, 'days' => 1],
    'TabEstrabet2mg' => ['mrp' => 663.2, 'pack' => 28, 'days' => 16],
    'TabEcosprin75mg' => ['mrp' => 5.49, 'pack' => 14, 'days' => 16],
    'Injsugest' => ['mrp' => 132.77, 'pack' => 1, 'days' => 16],
    'TabWysolone' => ['mrp' => 70, 'pack' => 12, 'days' => 16],
    'Crinonegel' => ['mrp' => 80, 'pack' => 1, 'days' => 16],
    'TabDuphaston10mg' => ['mrp' => 961.95, 'pack' => 10, 'days' => 16],
    'BiophilL' => ['mrp' => 489, 'pack' => 30, 'days' => 30],
    'BiophilO' => ['mrp' => 479, 'pack' => 30, 'days' => 30],
    'BiophilQ3' => ['mrp' => 4050, 'pack' => 30, 'days' => 30],
    'BIOLARG' => ['mrp' => 47, 'pack' => 1, 'days' => 16],
    'BIOPHILVITA' => ['mrp' => 1092, 'pack' => 30, 'days' => 30],
    'Injclexane' => ['mrp' => 940.54, 'pack' => 1, 'days' => 16],
    'InjPuberjenJO7500IU' => ['mrp' => 969.75, 'pack' => 1, 'days' => 16],
    'TabAllegra' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16]
];

$applicablemedicine = explode(',', $select_result4['applicablemedicine']);

foreach ($applicablemedicine as $med) {
    $med = trim($med);

    if (isset($medicineData[$med])) {
        $mrp = $medicineData[$med]['mrp'];
        $packSize = $medicineData[$med]['pack'];
        $days = $medicineData[$med]['days'];

        $packsNeeded = ceil($days / $packSize);
        $totalPrice = $packsNeeded * $mrp;
        ?>
         <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
        <?php
    }
}
?>
<?php  
$ovummedicineData = [
    'TabCrocin' => ['mrp' => 20.16, 'pack' => 20, 'days' => 16],
    'Sypcremaffin' => ['mrp' => 327.58, 'pack' => 1, 'days' => 1],
    'TabEstrabet2mg' => ['mrp' => 663.2, 'pack' => 28, 'days' => 16],
    'TabEcosprin75mg' => ['mrp' => 5.49, 'pack' => 14, 'days' => 16],
    'Injsugest' => ['mrp' => 132.77, 'pack' => 1, 'days' => 16],
    'TabWysolone' => ['mrp' => 70, 'pack' => 12, 'days' => 16],
    'Crinonegel' => ['mrp' => 80, 'pack' => 1, 'days' => 16],
    'TabDuphaston10mg' => ['mrp' => 961.95, 'pack' => 10, 'days' => 16],
    'BiophilL' => ['mrp' => 489, 'pack' => 30, 'days' => 30],
    'BiophilO' => ['mrp' => 479, 'pack' => 30, 'days' => 30],
    'BiophilQ3' => ['mrp' => 4050, 'pack' => 30, 'days' => 30],
    'BIOLARG' => ['mrp' => 47, 'pack' => 1, 'days' => 16],
    'BIOPHILVITA' => ['mrp' => 1092, 'pack' => 30, 'days' => 30],
    'Injclexane' => ['mrp' => 940.54, 'pack' => 1, 'days' => 16],
    'InjPuberjenJO7500IU' => ['mrp' => 969.75, 'pack' => 1, 'days' => 16],
    'TabAllegra' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16],
	'INFAGEST10MG' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16],
	'CEROXITUM500' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16]
];

$ovumapplicablemedicine = explode(',', $select_result6['applicablemedicine']);
foreach ($ovumapplicablemedicine as $ovummed) {
    $ovummed = trim($ovummed);
	
	

    if (isset($ovummedicineData[$ovummed])) {
        $mrp = $ovummedicineData[$ovummed]['mrp'];
        $packSize = $ovummedicineData[$ovummed]['pack'];
        $days = $ovummedicineData[$ovummed]['days'];

        $packsNeeded = ceil($days / $packSize);
        $totalPrice = $packsNeeded * $mrp;
        ?>
         <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
        <?php
    }
}
?>
<?php  
$premedicineData = [
    'TabCrocin' => ['mrp' => 20.16, 'pack' => 20, 'days' => 16],
    'Sypcremaffin' => ['mrp' => 327.58, 'pack' => 1, 'days' => 1],
    'TabEstrabet2mg' => ['mrp' => 663.2, 'pack' => 28, 'days' => 16],
    'TabEcosprin75mg' => ['mrp' => 5.49, 'pack' => 14, 'days' => 16],
    'Injsugest' => ['mrp' => 132.77, 'pack' => 1, 'days' => 16],
    'TabWysolone' => ['mrp' => 70, 'pack' => 12, 'days' => 16],
    'Crinonegel' => ['mrp' => 80, 'pack' => 1, 'days' => 16],
    'TabDuphaston10mg' => ['mrp' => 961.95, 'pack' => 10, 'days' => 16],
    'BiophilL' => ['mrp' => 489, 'pack' => 30, 'days' => 30],
    'BiophilO' => ['mrp' => 479, 'pack' => 30, 'days' => 30],
    'BiophilQ3' => ['mrp' => 4050, 'pack' => 30, 'days' => 30],
    'BIOLARG' => ['mrp' => 47, 'pack' => 1, 'days' => 16],
    'BIOPHILVITA' => ['mrp' => 1092, 'pack' => 30, 'days' => 30],
    'Injclexane' => ['mrp' => 940.54, 'pack' => 1, 'days' => 16],
    'InjPuberjenJO7500IU' => ['mrp' => 969.75, 'pack' => 1, 'days' => 16],
    'TabAllegra' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16],
	'INFAGEST10MG' => ['mrp' => 925, 'pack' => 10, 'days' => 16],
	'CEROXITUM500' => ['mrp' => 230.41, 'pack' => 10, 'days' => 16]
];

$preapplicablemedicine = explode(',', $select_result7['applicablemedicine']);
foreach ($preapplicablemedicine as $premed) {
    $premed = trim($premed);
	
	

    if (isset($premedicineData[$premed])) {
        $mrp = $premedicineData[$premed]['mrp'];
        $packSize = $premedicineData[$premed]['pack'];
        $days = $premedicineData[$premed]['days'];

         $packsNeeded = $days / $packSize;
        $totalPrice = $packsNeeded * $mrp;
        ?>
        <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
        <?php
    }
}
?>

	
<?php  
$ovarianmedicineData = [
    'TabCrocin' => ['mrp' => 20.16, 'pack' => 20, 'days' => 16],
    'Sypcremaffin' => ['mrp' => 327.58, 'pack' => 1, 'days' => 1],
    'TabEstrabet2mg' => ['mrp' => 663.2, 'pack' => 28, 'days' => 16],
    'TabEcosprin75mg' => ['mrp' => 5.49, 'pack' => 14, 'days' => 16],
    'Injsugest' => ['mrp' => 132.77, 'pack' => 1, 'days' => 16],
    'TabWysolone' => ['mrp' => 70, 'pack' => 12, 'days' => 16],
    'Crinonegel' => ['mrp' => 80, 'pack' => 1, 'days' => 16],
    'TabDuphaston10mg' => ['mrp' => 961.95, 'pack' => 10, 'days' => 16],
    'BiophilL' => ['mrp' => 489, 'pack' => 30, 'days' => 30],
    'BiophilO' => ['mrp' => 479, 'pack' => 30, 'days' => 30],
    'BiophilQ3' => ['mrp' => 4050, 'pack' => 30, 'days' => 30],
    'BIOLARG' => ['mrp' => 47, 'pack' => 1, 'days' => 16],
    'BIOPHILVITA' => ['mrp' => 1092, 'pack' => 30, 'days' => 30],
    'Injclexane' => ['mrp' => 940.54, 'pack' => 1, 'days' => 16],
    'InjPuberjenJO7500IU' => ['mrp' => 969.75, 'pack' => 1, 'days' => 16],
    'TabAllegra' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16],
	'INFAGEST10MG' => ['mrp' => 925.00, 'pack' => 10, 'days' => 16],
	'CEROXITUM500' => ['mrp' => 230.41, 'pack' => 10, 'days' => 16]
];

$ovarianapplicablemedicine = explode(',', $select_result8['applicablemedicine']);
foreach ($ovarianapplicablemedicine as $ovarianmed) {
    $ovarianmed = trim($ovarianmed);
		
    if (isset($ovarianmedicineData[$ovarianmed])) {
        $mrp = $ovarianmedicineData[$ovarianmed]['mrp'];
        $packSize = $ovarianmedicineData[$ovarianmed]['pack'];
        $days = $ovarianmedicineData[$ovarianmed]['days'];

        $packsNeeded = $days / $packSize;
        $totalPrice = $packsNeeded * $mrp;
        ?>
         <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
        <?php
    }
}
?>

						<?php  
$day2medicineData = [
    'TabCrocin' => ['mrp' => 20.16, 'pack' => 20, 'days' => 16],
    'Sypcremaffin' => ['mrp' => 327.58, 'pack' => 1, 'days' => 1],
    'TabEstrabet2mg' => ['mrp' => 663.2, 'pack' => 28, 'days' => 16],
    'TabEcosprin75mg' => ['mrp' => 5.49, 'pack' => 14, 'days' => 16],
    'Injsugest' => ['mrp' => 132.77, 'pack' => 1, 'days' => 16],
    'TabWysolone' => ['mrp' => 70, 'pack' => 12, 'days' => 16],
    'Crinonegel' => ['mrp' => 80, 'pack' => 1, 'days' => 16],
    'TabDuphaston10mg' => ['mrp' => 961.95, 'pack' => 10, 'days' => 16],
    'BiophilL' => ['mrp' => 489, 'pack' => 30, 'days' => 30],
    'BiophilO' => ['mrp' => 479, 'pack' => 30, 'days' => 30],
    'BiophilQ3' => ['mrp' => 4050, 'pack' => 30, 'days' => 30],
    'BIOLARG' => ['mrp' => 47, 'pack' => 1, 'days' => 16],
    'BIOPHILVITA' => ['mrp' => 1092, 'pack' => 30, 'days' => 30],
    'Injclexane' => ['mrp' => 940.54, 'pack' => 1, 'days' => 16],
    'InjPuberjenJO7500IU' => ['mrp' => 969.75, 'pack' => 1, 'days' => 16],
    'TabAllegra' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16],
	'INFAGEST10MG' => ['mrp' => 925, 'pack' => 10, 'days' => 16],
	'CEROXITUM500' => ['mrp' => 230.41, 'pack' => 10, 'days' => 16]
];

$day2applicablemedicine = explode(',', $select_result9['applicablemedicine']);
foreach ($day2applicablemedicine as $day2med) {
    $day2med = trim($day2med);
		
    if (isset($day2medicineData[$day2med])) {
        $mrp = $day2medicineData[$day2med]['mrp'];
        $packSize = $day2medicineData[$day2med]['pack'];
        $days = $day2medicineData[$day2med]['days'];

         $packsNeeded = $days / $packSize;
        $totalPrice = $packsNeeded * $mrp;
        ?>
        <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
        <?php
    }
}
?>
<?php  
$embryomedicineData = [
    'TabCrocin' => ['mrp' => 20.16, 'pack' => 20, 'days' => 16],
    'Sypcremaffin' => ['mrp' => 327.58, 'pack' => 1, 'days' => 1],
    'TabEstrabet2mg' => ['mrp' => 663.2, 'pack' => 28, 'days' => 16],
    'TabEcosprin75mg' => ['mrp' => 5.49, 'pack' => 14, 'days' => 16],
    'Injsugest' => ['mrp' => 132.77, 'pack' => 1, 'days' => 16],
    'TabWysolone' => ['mrp' => 70, 'pack' => 12, 'days' => 16],
    'Crinonegel' => ['mrp' => 80, 'pack' => 1, 'days' => 16],
    'TabDuphaston10mg' => ['mrp' => 961.95, 'pack' => 10, 'days' => 16],
    'BiophilL' => ['mrp' => 489, 'pack' => 30, 'days' => 30],
    'BiophilO' => ['mrp' => 479, 'pack' => 30, 'days' => 30],
    'BiophilQ3' => ['mrp' => 4050, 'pack' => 30, 'days' => 30],
    'BIOLARG' => ['mrp' => 47, 'pack' => 1, 'days' => 16],
    'BIOPHILVITA' => ['mrp' => 1092, 'pack' => 30, 'days' => 30],
    'Injclexane' => ['mrp' => 940.54, 'pack' => 1, 'days' => 16],
    'InjPuberjenJO7500IU' => ['mrp' => 969.75, 'pack' => 1, 'days' => 16],
    'TabAllegra' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16],
	'INFAGEST10MG' => ['mrp' => 925, 'pack' => 10, 'days' => 16],
	'CEROXITUM500' => ['mrp' => 230.41, 'pack' => 10, 'days' => 16]
];

$embryoapplicablemedicine = explode(',', $select_result10['applicablemedicine']);
foreach ($embryoapplicablemedicine as $embryomed) {
    $embryomed = trim($embryomed);
		
    if (isset($embryomedicineData[$embryomed])) {
        $mrp = $embryomedicineData[$embryomed]['mrp'];
        $packSize = $embryomedicineData[$embryomed]['pack'];
        $days = $embryomedicineData[$embryomed]['days'];

        $packsNeeded = $days / $packSize;
        $totalPrice = $packsNeeded * $mrp;
        ?>
        <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
        <?php
    }
}
?>
<?php  
$hysteroscopymedicineData = [
    'TabCrocin' => ['mrp' => 20.16, 'pack' => 20, 'days' => 16],
    'Sypcremaffin' => ['mrp' => 327.58, 'pack' => 1, 'days' => 1],
    'TabEstrabet2mg' => ['mrp' => 663.2, 'pack' => 28, 'days' => 16],
    'TabEcosprin75mg' => ['mrp' => 5.49, 'pack' => 14, 'days' => 16],
    'Injsugest' => ['mrp' => 132.77, 'pack' => 1, 'days' => 16],
    'TabWysolone' => ['mrp' => 70, 'pack' => 12, 'days' => 16],
    'Crinonegel' => ['mrp' => 80, 'pack' => 1, 'days' => 16],
    'TabDuphaston10mg' => ['mrp' => 961.95, 'pack' => 10, 'days' => 16],
    'BiophilL' => ['mrp' => 489, 'pack' => 30, 'days' => 30],
    'BiophilO' => ['mrp' => 479, 'pack' => 30, 'days' => 30],
    'BiophilQ3' => ['mrp' => 4050, 'pack' => 30, 'days' => 30],
    'BIOLARG' => ['mrp' => 47, 'pack' => 1, 'days' => 16],
    'BIOPHILVITA' => ['mrp' => 1092, 'pack' => 30, 'days' => 30],
    'Injclexane' => ['mrp' => 940.54, 'pack' => 1, 'days' => 16],
    'InjPuberjenJO7500IU' => ['mrp' => 969.75, 'pack' => 1, 'days' => 16],
    'TabAllegra' => ['mrp' => 264.72, 'pack' => 10, 'days' => 16],
	'INFAGEST10MG' => ['mrp' => 925, 'pack' => 10, 'days' => 16],
	'CEROXITUM500' => ['mrp' => 230.41, 'pack' => 10, 'days' => 16]
];

$hysteroscopyapplicablemedicine = explode(',', $select_result11['applicablemedicine']);
foreach ($hysteroscopyapplicablemedicine as $hysteroscopymed) {
    $hysteroscopymed = trim($hysteroscopymed);
		
    if (isset($hysteroscopymedicineData[$hysteroscopymed])) {
        $mrp = $hysteroscopymedicineData[$hysteroscopymed]['mrp'];
        $packSize = $hysteroscopymedicineData[$hysteroscopymed]['pack'];
        $days = $hysteroscopymedicineData[$hysteroscopymed]['days'];

        $packsNeeded = $days / $packSize;
        $totalPrice = $packsNeeded * $mrp;
        ?>
       <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
        <?php
    }
}
?></td>
					    <td><?php 
			$sql5 = "SELECT SUM(fees) AS total_fees, SUM(payment_done) AS total_payment_done, SUM(discount_amount) AS total_discount FROM `hms_patient_medicine` WHERE appointment_id='" . $vl['appointment_id'] . "' AND patient_id='".$vl['patient_id']."' AND status IN ('pending', 'approved')  "; 			
            $select_result5 = run_select_query($sql5);
			echo "Total Amount: ".round($select_result5['total_fees'],2)."<br>";
			echo "Total Discount: ". round($select_result5['total_discount'],2)."<br>";
            echo "Total Receive: ".round($select_result5['total_payment_done'],2)."<br>";
			?></td>
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