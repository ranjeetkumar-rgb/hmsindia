<?php
 error_reporting(0);
   $all_method =&get_instance();
   $patient_data = get_patient_detail($data['patient_id']);
   $currency = '';
   
   $sql4 = "SELECT * FROM `iui_discharge_summary` WHERE iic_id='".$data['patient_id']."'";
   $select_result4 = run_select_query($sql4);
   
   $sql6 = "SELECT * FROM `ovum_pickup_discharge_summary` WHERE iic_id='".$data['patient_id']."'";
   $select_result6 = run_select_query($sql6);
   
   $sql7 = "SELECT * FROM `pre_embryo_transfer_iui` WHERE iic_id='".$data['patient_id']."'";
   $select_result7 = run_select_query($sql7);
   
   $sql8 = "SELECT * FROM `ovarian_prp_discharge_summary` WHERE iic_id='".$data['patient_id']."'";
   $select_result8 = run_select_query($sql8);
   
   $sql9 = "SELECT * FROM `day2_day5_fet_prescription` WHERE iic_id='".$data['patient_id']."'";
   $select_result9 = run_select_query($sql9);
   
   $sql10 = "SELECT * FROM `embryo_transfer_discharge_summary` WHERE iic_id='".$data['patient_id']."'";
   $select_result10 = run_select_query($sql10);
   
   $sql11 = "SELECT * FROM `hysteroscopy_laparoscopy_discharge_summary` WHERE iic_id='".$data['patient_id']."'";
   $select_result11 = run_select_query($sql11);
   
   ?>
<div class="col-md-12">
   <!-- Advanced Tables -->
   <div class="card">
      <div class="card-action">
         <h3>Revenue Potential</h3>
         <div class="pull-right">
           <a href="<?php echo base_url(); ?>accounts/export_consultation_data/<?php echo $data['patient_id']; ?>" class="btn btn-success btn-sm">
             <i class="fa fa-download"></i> Export Consultation Data
           </a>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="card-content">
         <div id="msg_area" class="error"></div>
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
               <tr>
                  <th colspan="2"><?php echo "Patient ID: " . $data['patient_id']; ?></th>
                  <th colspan="2"><?php echo "Patient Name: "; ?>
                     <?php 	$sql = "SELECT * FROM `hms_patient_medical_info` WHERE patient_id='".$data['patient_id']."'";
                        $select_result = run_select_query($sql);
                        echo $select_result['female_name'];
                         ?>
                  </th>
               </tr>
               <tr>
                  <th>Date</th>
                  <th>Appointment ID</th>
                  <th>Doctor Name</th>
                  <th>Investigation Advice</th>
                  <th>Investigation Billing Price</th>
                  <th>Procedure Advice</th>
                  <th>Procedure Billing</th>
                  <th>Medicine Advice</th>
                  <th>Medicine Billing</th>
               </tr>
               <?php
                  $sql = "SELECT * FROM `hms_doctor_consultation` WHERE `patient_id`='".$data['patient_id']."' ORDER BY `ID` DESC";
                  $query = $this->db->query($sql);
                  $results = $query->result(); // ✅ Fetch all records
                  if (!empty($results)) {
                  	foreach ($results as $row) { ?>
               <tr class="odd gradeX">
                  <td><?php echo $row->consultation_date; ?></td>
                  <td><?php echo $row->appointment_id; ?></td>
                  <td><?php $doc_sql = "SELECT * FROM `hms_doctors` WHERE ID='".$row->doctor_id."'";
                     $doctor_result = run_select_query($doc_sql);
                     echo $doctor_result['name']; ?></td>
                  <td>
                     <?php
                        $unserialized_data = @unserialize($row->female_investigation_suggestion_list); // Replace `serialized_column` with actual column name
                        if ($unserialized_data !== false && is_array($unserialized_data)) {
                            foreach ($unserialized_data as $key => $value) {
                                //echo "<b>$key:</b> " . htmlspecialchars($value) . "<br>";
                        $sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($value)";
                        $select_result2 = run_select_query($sql2);
                        if (!empty($select_result2)) {
                        echo "Investigation (Female): " . $select_result2['investigation'] . "<br>";
                        echo "Price: " . $select_result2['price'] . "<br>";
                        echo "---------------------<br>";
                        // Add to total investigations and price
                        $totalInvestigations[] = $select_result2['investigation'];
                        $totalPrice += (float)$select_result2['price'];
                        }
                            }
                        } 
                        $maleunserialized_data = @unserialize($row->male_investigation_suggestion_list); // Replace `serialized_column` with actual column name
                        
                        if ($maleunserialized_data !== false && is_array($maleunserialized_data)) {
                           
                            // ✅ Loop through unserialized data if needed
                            foreach ($maleunserialized_data as $key => $value) {
                                //echo "<b>$key:</b> " . htmlspecialchars($value) . "<br>";
                        $sql2 = "SELECT * FROM `hms_investigation` WHERE ID IN ($value)";
                        $select_result2 = run_select_query($sql2);
                        if (!empty($select_result2)) {
                        echo "Investigation (Male): " . $select_result2['investigation'] . "<br>";
                        echo "Price: " . $select_result2['price'] . "<br>";
                        echo "---------------------<br>";
                        
                        // Add to total investigations and price
                        $totalInvestigations[] = $select_result2['investigation'];
                        $totalPrice += (float)$select_result2['price'];
                        }
                            }
                        } 		
                        ?>
                  </td>
                  <td><?php 
                     $sql = "SELECT investigations, totalpackage, discount_amount FROM hms_patient_investigations WHERE appointment_id='" . $row->appointment_id . "' AND patient_id='" . $row->patient_id . "' AND status='approved'";
                     $result = run_select_query($sql); // Assuming this fetches the row as an associative array
                     // Check if the query returned valid data
                     if ($result && isset($result['investigations'])) {
                     // Unserialize the `investigations` column
                     $unserializedInvestigations = unserialize($result['investigations']);
                     
                     // Initialize variables for totals
                     $totalPriceMale = 0;
                     $totalPriceFemale = 0;
                     
                     // Process Female Investigations
                     if (isset($unserializedInvestigations['female_investigation']) && is_array($unserializedInvestigations['female_investigation'])) {
                       foreach ($unserializedInvestigations['female_investigation'] as $investigation) {
                           $investigationName = $investigation['female_investigation_name'] ?? 'N/A';
                           $investigationCode = $investigation['female_investigation_code'] ?? 'N/A';
                           $investigationPrice = (float)($investigation['female_investigation_price'] ?? '0');
                           $investigationDiscount = (float)($investigation['female_investigation_discount'] ?? '0');
                     
                           echo "Investigation (Female): $investigationName<br>";
                           echo "Investigation Code: $investigationCode<br>";
                           echo "Price: $investigationPrice<br>";
                           echo "Discount: $investigationDiscount%<br>";
                           echo "---------------<br>";
                     
                           $totalPriceFemale += $investigationPrice;
                       }
                     }
                     
                     // Process Male Investigations
                     if (isset($unserializedInvestigations['male_investigation']) && is_array($unserializedInvestigations['male_investigation'])) {
                       foreach ($unserializedInvestigations['male_investigation'] as $investigation) {
                           $investigationName = $investigation['male_investigation_name'] ?? 'N/A';
                           $investigationCode = $investigation['male_investigation_code'] ?? 'N/A';
                           $investigationPrice = (float)($investigation['male_investigation_price'] ?? '0');
                           $investigationDiscount = (float)($investigation['male_investigation_discount'] ?? '0');
                     
                           echo "Investigation (Male): $investigationName<br>";
                           echo "Investigation Code: $investigationCode<br>";
                           echo "Price: $investigationPrice<br>";
                           echo "Discount: $investigationDiscount%<br>";
                           echo "---------------<br>";
                     
                           $totalPriceMale += $investigationPrice;
                       }
                     }
                     
                     // Display additional details and totals
                     echo "Total Package: " . ($result['totalpackage'] ?? '0') . "<br>";
                     echo "Discount Amount: " . ($result['discount_amount'] ?? '0') . "<br>";
                     echo "Paid Amount: " . ($result['totalpackage'] - $result['discount_amount']) . "<br>";
                     }
                     ?></td>
                  <td><?php // ✅ Unserialize data safely
                     $procedureunserialized_data = @unserialize($row->sub_procedure_suggestion_list); // Replace `serialized_column` with actual column name
                     
                     if ($procedureunserialized_data !== false && is_array($procedureunserialized_data)) {
                        
                     	// ✅ Loop through unserialized data if needed
                     	foreach ($procedureunserialized_data as $key => $value) {
                     		//echo "<b>$key:</b> " . htmlspecialchars($value) . "<br>";
                     		$sql2 = "SELECT * FROM `hms_procedures` WHERE ID IN ($value)";
                     		$select_pro_result = run_select_query($sql2);
                     		if (!empty($select_pro_result)) {
                     			echo "Procedure: " . $select_pro_result['procedure_name'] . "<br>";
                     			echo "Code: " . $select_pro_result['code'] . "<br>";
                     			echo "Price: " . $select_pro_result['price'] . "<br>";
                     			echo "---------------------<br>";
                     
                     			// Add to total investigations and price
                     			$totalPrice += (float)$select_pro_result['price'];
                     		}
                     	}
                     }   
                     ?>
                  </td>
                  <td><?php  // SQL query to fetch patient procedure data
                     // Optimized query with prepared statement
                     $sql = "SELECT data, totalpackage, discount_amount FROM `hms_patient_procedure` WHERE appointment_id = ? AND patient_id = ? AND status = 'approved'";
                     $pro_result = $this->db->query($sql, array($row->appointment_id, $row->patient_id))->row_array();
                     
                     // Check if the query returned a result
                     if ($pro_result && isset($pro_result['data'])) {
                         // Unserialize the fetched data
                         $unserializedData = unserialize($pro_result['data']);
                     
                         // Check if 'patient_procedures' key exists and is an array
                         if (isset($unserializedData['patient_procedures']) && is_array($unserializedData['patient_procedures'])) {
                             $patientProcedures = $unserializedData['patient_procedures'];
                             
                             // Collect all procedure IDs for batch query
                             $procedure_ids = array();
                             foreach ($patientProcedures as $procedure) {
                                 if ($procedure && isset($procedure['sub_procedure'])) {
                                     $procedure_ids[] = $procedure['sub_procedure'];
                                 }
                             }
                             
                             // Single optimized query for all procedures
                             if (!empty($procedure_ids)) {
                                 $procedure_ids_str = implode(',', array_map('intval', $procedure_ids));
                                 $procedures_sql = "SELECT * FROM `hms_procedures` WHERE ID IN ($procedure_ids_str)";
                                 $procedures_result = $this->db->query($procedures_sql)->result_array();
                                 
                                 // Create lookup array for procedures
                                 $procedures_lookup = array();
                                 foreach ($procedures_result as $proc) {
                                     $procedures_lookup[$proc['ID']] = $proc;
                                 }
                             }
                     
                             // Iterate through each procedure and display details
                             foreach ($patientProcedures as $procedure) {
                                 if ($procedure) {
                                     $procedure_id = $procedure['sub_procedure'];
                                     $pro_select_result = isset($procedures_lookup[$procedure_id]) ? $procedures_lookup[$procedure_id] : null;
                                     
                                     if ($pro_select_result) {
                                         echo "Name: " . $pro_select_result['procedure_name'] . "<br>";
                                         echo "Code: " . ($procedure['sub_procedures_code'] ?? 'N/A') . "<br>";
                                         echo "Price: " . ($procedure['sub_procedures_price'] ?? '0') . "<br>";
                                         echo "Discount: " . ($procedure['sub_procedures_discount'] ?? '0') . "<br>";
                                         echo "Paid Price: " . ($procedure['sub_procedures_paid_price'] ?? '0') . "<br>";
                                         echo "-------<br>";
                     
                                         // Add to totals
                                         $totalPrice += (float) ($procedure['sub_procedures_price'] ?? 0);
                                         $totalDiscount += (float) ($procedure['sub_procedures_discount'] ?? 0);
                                     }
                                 }
                             }
                         }
                     } ?> </td>
                  <td>
                     <table id="medicine_list_table">
                        <tbody>
                           <?php 
                              $grand_total = 0;
                              $female_med_count = 1;
                              $maleserialized_data = $row->male_medicine_suggestion_list;
                              // ✅ Unserialize the data
                              $unserialized_data = unserialize($maleserialized_data);
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
                           <tr class="male_medicine" id="male_medicine_<?php echo $male_med_count; ?>">
                              <input value="<?php echo $val['male_medicine_when_start']; ?>" name="male_med_when_start_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <input value="<?php echo $val['male_medicine_route']; ?>" name="male_med_route_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <input value="<?php echo $val['male_medicine_frequency']; ?>" name="male_med_frequency_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <input value="<?php echo $val['male_medicine_timing']; ?>" name="male_med_timing_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <!--<td><a href="javascript:void(0);" class="remove_medicine_tr" data-medicine="male_medicine_<?php echo $male_med_count; ?>"><i class="fa fa-minus-circle error" aria-hidden="true"></i></a></td>-->
                              <td><?php echo $medicine_details['item_name']; ?>
                                 <input value="<?php echo $val['male_medicine_name']; ?>" medicine="<?php echo $medicine_details['item_name']; ?>" readonly="readonly" id="male_med_name_<?php echo $male_med_count; ?>" class="required_value form-control" name="male_med_name_<?php echo $male_med_count; ?>" type="hidden" required>
                                 <input value="<?php echo $medicine_details['company']; ?>" id="male_med_company_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              </td>
                              <!-- <td><?php echo $medicine_details['company']; ?>
                                 <input value="<?php echo $medicine_details['company']; ?>" id="male_med_company_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                                 </td> -->
                              <td><?php //$brand_details = $all_method->get_brand_details($medicine_details['brand_name']); echo $brand_details['name']; ?>
                                 <input value="<?php echo $brand_details['name']; ?>" id="male_med_brand_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              </td>
                              <td>
                                 <?php echo 'Rs.'.round($medicine_details['unit_price'], 2); ?>
                                 <input value="<?php echo round($medicine_details['unit_price'], 2); ?>" readonly="readonly" id="male_med_unit_price_<?php echo $male_med_count; ?>" class="unit_price_field required_value" name="male_med_unit_price_<?php echo $male_med_count; ?>" type="hidden" class="form-control " required>
                              </td>
                              <!--<td>
                                 <?php echo 'Rs.'.round($subtotal, 2); ?>
                                 <input value="<?php echo round($subtotal, 2); ?>" readonly="readonly" id="male_med_price_<?php echo $male_med_count; ?>" class="price_field required_value form-control" name="male_med_price_<?php echo $male_med_count; ?>" type="hidden" required>
                                 </td>-->
                              <td>
                                 <?php echo $val['male_medicine_dosage']; ?>
                                 <input value="<?php echo $val['male_medicine_dosage']; ?>" readonly="readonly" id="male_med_dose_<?php echo $male_med_count; ?>" class="form-control required_value form-control" name="male_med_dose_<?php echo $male_med_count; ?>" type="hidden" required>
                              </td>
                              <td><?php echo $val['male_medicine_frequency']; ?></td>
                              <td><input value="<?php echo $val['male_medicine_days']; ?>" frequency="<?php echo $val['male_medicine_frequency']; ?>" unit_price="<?php echo $medicine_details['unit_price']; ?>" doses="<?php echo $val['male_medicine_dosage']; ?>"  gender="male" count="<?php echo $male_med_count; ?>" id="male_med_for_<?php echo $male_med_count; ?>" class="required_value form-control day_for_field" name="male_med_for_<?php echo $male_med_count; ?>" type="text" required></td>
                           </tr>
                           <?php  $grand_total +=  $subtotal; $male_med_count++; }} ?>
                           <?php 
                              $grand_total = 0; // ✅ Initialize total outside the loop
                              $female_med_count = 1;
                                $serialized_data = $row->female_medicine_suggestion_list;
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
                           <tr class="female_medicine"  id="female_medicine_<?php echo $female_med_count; ?>">
                              <input value="<?php echo $val['female_medicine_when_start']; ?>" name="female_med_when_start_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <input value="<?php echo $val['female_medicine_route']; ?>" name="female_med_route_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <input value="<?php echo $val['female_medicine_frequency']; ?>" name="female_med_frequency_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <input value="<?php echo $val['female_medicine_timing']; ?>" name="female_med_timing_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              <!--<td><a href="javascript:void(0);" class="remove_medicine_tr" data-medicine="female_medicine_<?php echo $female_med_count; ?>" ><i class="fa fa-minus-circle error" aria-hidden="true"></i></a></td>-->
                              <td><?php echo $medicine_details['item_name']; ?>
                                 <input value="<?php echo $val['female_medicine_name']; ?>" medicine="<?php echo $medicine_details['item_name']; ?>" readonly="readonly" id="female_med_name_<?php echo $female_med_count; ?>" class="required_value" name="female_med_name_<?php echo $female_med_count; ?>" type="hidden" class="form-control " required>
                                 <input value="<?php echo $medicine_details['company']; ?>" id="female_med_company_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              </td>
                              <!-- <td><?php echo $medicine_details['company']; ?>
                                 <input value="<?php echo $medicine_details['company']; ?>" id="female_med_company_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                                 </td> -->
                              <td><?php //$brand_details = $all_method->get_brand_details($medicine_details['brand_name']); echo $brand_details['name']; ?>
                                 <input value="<?php echo $brand_details['name']; ?>" id="female_med_brand_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                              </td>
                              <td>
                                 <?php echo 'Rs.'.round($medicine_details['unit_price'], 2); ?>
                                 <input value="<?php echo round($medicine_details['unit_price'], 2); ?>" readonly="readonly" id="female_med_unit_price_<?php echo $female_med_count; ?>" class="unit_price_field required_value" name="female_med_unit_price_<?php echo $female_med_count; ?>" type="hidden" class="form-control " required>
                              </td>
                              <td><?php echo 'Rs.'.round($subtotal, 2); ?>
                                 <input value="<?php echo round($subtotal, 2); ?>" readonly="readonly" id="female_med_price_<?php echo $female_med_count; ?>" class="price_field required_value" name="female_med_price_<?php echo $female_med_count; ?>" type="hidden" class="form-control " required>
                              </td>
                              <td>
                                 <?php echo $val['female_medicine_dosage']; ?>
                                 <input value="<?php echo $val['female_medicine_dosage']; ?>" readonly="readonly" id="female_med_dose_<?php echo $female_med_count; ?>" class="form-control required_value form-control" name="female_med_dose_<?php echo $female_med_count; ?>" type="hidden" required>
                              </td>
                              <td><?php echo $val['female_medicine_frequency']; ?></td>
                              <td><input value="<?php echo $val['female_medicine_days']; ?>" frequency="<?php echo $val['female_medicine_frequency']; ?>" unit_price="<?php echo $medicine_details['unit_price']; ?>" doses="<?php echo $val['female_medicine_dosage']; ?>" count="<?php echo $female_med_count; ?>" id="female_med_for_<?php echo $female_med_count; ?>" class="required_value form-control day_for_field" name="female_med_for_<?php echo $female_med_count; ?>" type="text" required></td>
                              <?php  $grand_total +=  $subtotal; $female_med_count++; }} ?>
                           </tr>
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
                  <td><?php 
                     $sql5 = "SELECT * FROM ".$this->config->item('db_prefix')."patient_medicine WHERE appointment_id='" . $row->appointment_id . "' AND patient_id='".$row->patient_id."' AND status='approved'"; 
                     $query = $this->db->query($sql5);
                     $select_result5 = $query->result(); 
                     foreach ($select_result5 as $vl) {
                     	$data_arr = [];
                     	$consumables_arr = [];
                     
                     	echo "<p style='color:#ff0000;'>---------------------</p>";
                     	echo "<strong>Date: </strong>" . htmlspecialchars($vl->on_date) . "<br>";
                     	echo "<strong>Total: </strong>" . htmlspecialchars($vl->fees) . "<br>";
                     	echo "<strong>Discount: </strong>" . htmlspecialchars($vl->discount_amount) . "<br>";
                     	echo "<strong>Receive: </strong>" . htmlspecialchars($vl->payment_done) . "<br>";
                     	
                     $serialized_data = $vl->data;
                     
                     // ✅ Unserialize the data safely
                     $unserialized_data = @unserialize($serialized_data);
                     
                     // ✅ Check if unserialization was successful
                     if ($unserialized_data !== false && isset($unserialized_data['data']['consumables'])) {
                       $consumables_list = $unserialized_data['data']['consumables'];
                     
                       // ✅ Loop through all consumables
                       foreach ($consumables_list as $index => $consumable) {
                           echo "<b>Item Name:</b> " . htmlspecialchars($consumable['consumables_item_name']) . "<br>";
                           echo "<b>Quantity:</b> " . htmlspecialchars($consumable['consumables_quantity']) . "<br>";
                           echo "<b>Price:</b> ₹" . htmlspecialchars($consumable['consumables_price']) . "<br>";
                           echo "<b>Discount:</b> " . htmlspecialchars($consumable['consumables_discount_']) . "%<br>";
                           echo "<b>Total:</b> ₹" . htmlspecialchars($consumable['consumables_total_']) . "<br>";
                           echo "----------------------<br>";
                       }
                     }
                     }
                     	?></td>
               </tr>
               <?php }}  ?>
            </table>
            <table>
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
               <tr>
                  <td><input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $med ?>" checked></td>
                  <td>
                     <p><?= $med ?></p>
                  </td>
                  <td>
                     <p>Pack Size: <?= $packSize ?></p>
                  </td>
                  <td>
                     <p>MRP: ₹<?= number_format($mrp, 2) ?></p>
                  </td>
                  <td>
                     <p><?= $days ?> days</p>
                  </td>
                  <td>
                     <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
                  </td>
               </tr>
               <?php
                  }
                  }
                  ?>
            </table>
            <table>
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
               <tr>
                  <td><input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $ovummed ?>" checked></td>
                  <td>
                     <p><?= $ovummed ?></p>
                  </td>
                  <td>
                     <p>Pack Size: <?= $packSize ?></p>
                  </td>
                  <td>
                     <p>MRP: ₹<?= number_format($mrp, 2) ?></p>
                  </td>
                  <td>
                     <p><?= $days ?> days</p>
                  </td>
                  <td>
                     <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
                  </td>
               </tr>
               <?php
                  }
                  }
                  ?>
            </table>
            <table>
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
               <tr>
                  <td><input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $premed ?>" checked></td>
                  <td>
                     <p><?= $premed ?></p>
                  </td>
                  <td>
                     <p>Pack Size: <?= $packSize ?></p>
                  </td>
                  <td>
                     <p>MRP: ₹<?= number_format($mrp, 2) ?></p>
                  </td>
                  <td>
                     <p><?= $days ?> days</p>
                  </td>
                  <td>
                     <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
                  </td>
               </tr>
               <?php
                  }
                  }
                  ?>
            </table>
            <table>
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
               <tr>
                  <td><input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $ovarianmed ?>" checked></td>
                  <td>
                     <p><?= $ovarianmed ?></p>
                  </td>
                  <td>
                     <p>Pack Size: <?= $packSize ?></p>
                  </td>
                  <td>
                     <p>MRP: ₹<?= number_format($mrp, 2) ?></p>
                  </td>
                  <td>
                     <p><?= $days ?> days</p>
                  </td>
                  <td>
                     <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
                  </td>
               </tr>
               <?php
                  }
                  }
                  ?>
            </table>
            <table>
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
               <tr>
                  <td><input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $day2med ?>" checked></td>
                  <td>
                     <p><?= $day2med ?></p>
                  </td>
                  <td>
                     <p>Pack Size: <?= $packSize ?></p>
                  </td>
                  <td>
                     <p>MRP: ₹<?= number_format($mrp, 2) ?></p>
                  </td>
                  <td>
                     <p><?= $days ?> days</p>
                  </td>
                  <td>
                     <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
                  </td>
               </tr>
               <?php
                  }
                  }
                  ?>
            </table>
            <table>
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
               <tr>
                  <td><input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $embryomed ?>" checked></td>
                  <td>
                     <p><?= $embryomed ?></p>
                  </td>
                  <td>
                     <p>Pack Size: <?= $packSize ?></p>
                  </td>
                  <td>
                     <p>MRP: ₹<?= number_format($mrp, 2) ?></p>
                  </td>
                  <td>
                     <p><?= $days ?> days</p>
                  </td>
                  <td>
                     <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
                  </td>
               </tr>
               <?php
                  }
                  }
                  ?>
            </table>
            <table>
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
               <tr>
                  <td><input type="checkbox" class="checkmedicine" name="applicablemedicine[]" value="<?= $hysteroscopymed ?>" checked></td>
                  <td>
                     <p><?= $hysteroscopymed ?></p>
                  </td>
                  <td>
                     <p>Pack Size: <?= $packSize ?></p>
                  </td>
                  <td>
                     <p>MRP: ₹<?= number_format($mrp, 2) ?></p>
                  </td>
                  <td>
                     <p><?= $days ?> days</p>
                  </td>
                  <td>
                     <p><strong>Total: ₹<?= number_format($totalPrice, 2) ?></strong></p>
                  </td>
               </tr>
               <?php
                  }
                  }
                  ?>
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
   * {
   box-sizing: border-box;
   }
   .row {
   margin-left:-5px;
   margin-right:-5px;
   }
   .column {
   float: left;
   width: 100%;
   padding: 5px;
   }
   .column2 {
   float: left;
   width: 25%;
   padding: 5px;
   }
   /* Clearfix (clear floats) */
   .row::after {
   content: "";
   clear: both;
   display: table;
   }
   table {
   border-collapse: collapse;
   border-spacing: 0;
   width: 100%;
   border: 1px solid #ddd;
   }
   th, td {
   text-align: left;
   padding: 16px;
   }
   tr:nth-child(even) {
   background-color: #f2f2f2;
   }
</style>