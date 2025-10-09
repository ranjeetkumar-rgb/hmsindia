<?php $all_method =&get_instance();
   $consultation_data = $all_method->get_consultation($appointments['ID']);   
   $patient_data = get_patient_detail($consultation_data['patient_id']);
   $patient_doctor_consultation = patient_doctor_consultation_data($appointments['ID'], $consultation_data['patient_id']);
   $sql2 = "Select * from ".$this->config->item('db_prefix')."doctors where ID='".$_SESSION['logged_doctor']['doctor_id']."'"; 
   $select_result2 = run_select_query($sql2);
   ?>
<style>
   /* Enhanced Follow-up Page Styles */
   .follow-up-container {
   background: #f8f9fa;
   min-height: 100vh;
   padding: 20px 0;
   }
   .main-card {
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   border: none;
   border-radius: 8px;
   margin-bottom: 20px;
   }
   .card-header-custom {
   background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
   color: white;
   border-radius: 8px 8px 0 0;
   padding: 20px;
   margin: 0;
   }
   .card-header-custom h3 {
   margin: 0;
   font-weight: 600;
   font-size: 1.5rem;
   }
   .section-card {
   background: white;
   border-radius: 8px;
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   margin-bottom: 20px;
   overflow: hidden;
   }
   .section-header {
   background: #f8f9fa;
   padding: 15px 20px;
   border-bottom: 2px solid #e9ecef;
   font-weight: 600;
   color: #495057;
   font-size: 1.1rem;
   }
   .section-content {
   padding: 20px;
   }
   .form-group-enhanced {
   margin-bottom: 20px;
   }
   .form-group-enhanced label {
   font-weight: 600;
   color: #495057;
   margin-bottom: 8px;
   display: block;
   }
   .form-control-enhanced {
   border: 2px solid #e9ecef;
   border-radius: 6px;
   padding: 12px 15px;
   font-size: 14px;
   transition: all 0.3s ease;
   }
   .form-control-enhanced:focus {
   border-color: #667eea;
   box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
   }
   .table-enhanced {
   background: white;
   border-radius: 8px;
   overflow: hidden;
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   }
   .table-enhanced thead th {
   background: #667eea;
   color: white;
   font-weight: 600;
   padding: 15px 12px;
   border: none;
   text-align: center;
   }
   .table-enhanced tbody td {
   padding: 12px;
   border: 1px solid #e9ecef;
   vertical-align: middle;
   }
   .table-enhanced tbody tr:nth-child(even) {
   background: #f8f9fa;
   }
   .table-enhanced tbody tr:hover {
   background: #e3f2fd;
   }
   .checkbox-enhanced {
   position: relative;
   margin-right: 10px;
   }
   .checkbox-enhanced input[type="checkbox"] {
   position: relative;
   left: 0;
   opacity: 1;
   margin-right: 8px;
   transform: scale(1.2);
   }
   .radio-enhanced {
   margin-right: 20px;
   }
   .radio-enhanced input[type="radio"] {
   position: relative;
   left: 0;
   opacity: 1;
   margin-right: 8px;
   transform: scale(1.2);
   }
   .btn-enhanced {
   padding: 12px 30px;
   font-weight: 600;
   border-radius: 6px;
   transition: all 0.3s ease;
   }
   .btn-primary-enhanced {
   background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
   border: none;
   }
   .btn-primary-enhanced:hover {
   transform: translateY(-2px);
   box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
   }
   .patient-info-card {
   background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
   color: white;
   border-radius: 8px;
   padding: 20px;
   margin-bottom: 20px;
   }
   .patient-info-card h4 {
   margin: 0 0 10px 0;
   font-weight: 600;
   }
   .patient-info-card p {
   margin: 5px 0;
   font-size: 14px;
   }
   .medicine-table {
   font-size: 12px;
   }
   .medicine-table th {
   background: #495057;
   color: white;
   padding: 8px 6px;
   font-size: 11px;
   text-align: center;
   }
   .medicine-table td {
   padding: 6px;
   font-size: 11px;
   }
   .medicine-table input, .medicine-table select {
   font-size: 11px;
   padding: 4px 6px;
   border: 1px solid #ddd;
   border-radius: 3px;
   }
   .multiselect-container>li>a>label {
   padding: 8px 20px;
   font-size: 14px;
   }
   .open > .dropdown-menu {
   width: 350px;
   max-height: 300px;
   overflow: auto;
   border-radius: 6px;
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   }
   .btn-group {
   max-width: 100%;
   }
   button.multiselect.dropdown-toggle.btn.btn-default {
   width: 100%;
   overflow: hidden;
   border: 2px solid #e9ecef;
   border-radius: 6px;
   padding: 12px 15px;
   }
   .alert-info-custom {
   background: #e3f2fd;
   border: 1px solid #bbdefb;
   color: #1565c0;
   border-radius: 6px;
   padding: 15px;
   margin-bottom: 20px;
   }
   .follow-up-section {
   background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
   border-radius: 8px;
   padding: 20px;
   margin-top: 20px;
   }
   .follow-up-section h4 {
   color: #495057;
   margin-bottom: 20px;
   font-weight: 600;
   }
   .purpose-radio-group {
   display: flex;
   flex-wrap: wrap;
   gap: 20px;
   margin-top: 15px;
   }
   .purpose-radio-group .radio-enhanced {
   background: white;
   padding: 10px 15px;
   border-radius: 6px;
   border: 2px solid #e9ecef;
   cursor: pointer;
   transition: all 0.3s ease;
   }
   .purpose-radio-group .radio-enhanced:hover {
   border-color: #667eea;
   background: #f8f9fa;
   }
   .purpose-radio-group .radio-enhanced input[type="radio"]:checked + label {
   color: #667eea;
   font-weight: 600;
   }
   .purpose-radio-group .radio-enhanced input[type="radio"]:checked {
   border-color: #667eea;
   }
   /* Performance optimizations */
   .table-enhanced, .medicine-table {
   will-change: transform;
   }
   .form-control-enhanced {
   will-change: border-color, box-shadow;
   }
   .btn-enhanced {
   will-change: transform, box-shadow;
   }
   /* Lazy loading for images */
   img {
   loading: lazy;
   }
   /* Optimize animations */
   * {
   transition-duration: 0.2s;
   }
   @media (max-width: 768px) {
   .follow-up-container {
   padding: 10px 0;
   }
   .section-content {
   padding: 15px;
   }
   .purpose-radio-group {
   flex-direction: column;
   gap: 10px;
   }
   .medicine-table {
   font-size: 10px;
   }
   .medicine-table th, .medicine-table td {
   padding: 4px 2px;
   }
   }
   button.multiselect.dropdown-toggle {
   overflow: visible !important;   /* allow dropdown to expand */
   }
   .multiselect-container {
   z-index: 10000 !important;       /* make sure it's on top */
   position: absolute !important;  /* float above other elements */
   }
   .multiselect-container .multiselect-dropdown {
   z-index: 10001 !important;
   position: absolute !important;
   max-height: 200px !important;
   overflow-y: auto !important;
   }
   .multiselect-container .multiselect-dropdown ul {
   z-index: 10001 !important;
   position: relative !important;
   }
   .select2-container {
   z-index: 10000 !important;
   }
   .bootstrap-select .dropdown-menu {
   z-index: 2000 !important;
   }
   .dropdown-menu {
   position: absolute !important;
   z-index: 9999 !important;
   }
   .parent-container {
   overflow: visible !important;
   }
   /* Ensure dropdowns are not clipped by parent containers */
   .section-card, .table-responsive, .table-enhanced {
   overflow: visible !important;
   }
   /* Fix for table cells containing multiselect */
   .table td {
   overflow: visible !important;
   position: relative;
   }
   /* Ensure multiselect button and dropdown are properly positioned */
   .multiselect {
   position: relative !important;
   }
   .multiselect .multiselect-container {
   position: absolute !important;
   top: 100% !important;
   left: 0 !important;
   right: 0 !important;
   z-index: 10000 !important;
   }
   /* Additional fix for Bootstrap multiselect */
   .bootstrap-multiselect .dropdown-menu {
   z-index: 10000 !important;
   position: absolute !important;
   }
   .bootstrap-multiselect .dropdown-menu ul {
   z-index: 10001 !important;
   }
</style>
<div class="follow-up-container">
   <div class="container-fluid">
      <form method="post" action="" enctype="multipart/form-data">
         <input type="hidden" name="action" value="add_consultation_done" />
         <input type="hidden" name="appointment_id" value="<?php echo $appointments['ID']; ?>" />
         <input type="hidden" name="patient_id" value="<?php echo $patient_data['patient_id']; ?>" />
         <input type="hidden" name="wife_phone" value="<?php echo $patient_data['wife_phone']; ?>" />
         <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $_SESSION['logged_doctor']['doctor_id']; ?>" />
         <input type="hidden" name="center_number" id="center_number" value="<?php echo $select_result2['center_id']; ?>" />
         <?php if($appointments['partial_billing'] == 1){ ?>
         <input type="hidden" name="doc_consult_id" value="<?php echo $patient_doctor_consultation['ID']; ?>" />
         <?php } ?>
         <!-- Patient Information Card -->
         <div class="patient-info-card">
            <h4><i class="fa fa-user"></i> Patient Follow-up Consultation</h4>
            <p><strong>Patient ID:</strong> <?php echo isset($patient_data['patient_id']) ? $patient_data['patient_id'] : 'N/A'; ?></p>
            <p><strong>Patient Name:</strong> <?php echo isset($patient_data['patient_name']) ? $patient_data['patient_name'] : 'N/A'; ?></p>
            <p><strong>Phone:</strong> <?php echo isset($patient_data['phone']) ? $patient_data['phone'] : 'N/A'; ?></p>
         </div>
         <!-- Main Follow-up Form Card -->
         <div class="main-card">
            <div class="card-header-custom">
               <h3><i class="fa fa-stethoscope"></i> Follow-up Consultation Details</h3>
            </div>
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-clipboard"></i> Presenting Complaints
               </div>
               <div class="section-content">
                  <table class="table table-enhanced">
                     <thead>
                        <tr>
                           <th style="width: 30%;">Complaint Type</th>
                           <th style="width: 35%;">Patient</th>
                           <th style="width: 35%;">Spouse</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td><strong>Presenting Complaints</strong></td>
                           <td>
                              <input type="text" name="female_findings" class="form-control form-control-enhanced" placeholder="Enter patient complaints">
                           </td>
                           <td>
                              <input type="text" name="male_findings" class="form-control form-control-enhanced" placeholder="Enter spouse complaints">
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- Investigation Reports Section -->
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-file-text"></i> Investigation Reports
               </div>
               <div class="section-content">
                  <div class="alert-info-custom">
                     <i class="fa fa-info-circle"></i> <strong>Quick Access:</strong>
                     <a href="<?php echo base_url('my_reports'); ?>" target="_blank" class="btn btn-sm btn-info">My Reports</a>
                     <a href="<?php echo base_url('my_ipd'); ?>" target="_blank" class="btn btn-sm btn-info">My IPD</a>
                     <a href="<?php echo base_url('patient_details/'.$patient_data['patient_id']); ?>" target="_blank" class="btn btn-sm btn-info">Patient Data</a>
                  </div>
               </div>
            </div>
            <?php if($appointments['partial_billing'] == 0){?>
            <!-- IIC Investigations Section -->
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-flask"></i> IIC Investigations Advised
                  <label class="checkbox-enhanced pull-right">
                  <input type="checkbox" id="investigation_suggestion" value="1" name="investigation_suggestion" />
                  Enable Investigations
                  </label>
               </div>
               <div class="section-content" style="margin-bottom: 80px;">
                  <table class="table table-enhanced">
                     <thead>
                        <tr >
                           <!-- <th style="width: 30%;">Investigation Type</th> -->
                           <th style="width: 35%;">Patient</th>
                           <th style="width: 35%;">Spouse</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <!-- <td><strong>IIC Investigations</strong></td> -->
                           <td>
                              <select class="form-control multidselect_dropdown_1" multiple id="female_minvestigation_suggestion_list" disabled name="female_minvestigation_suggestion_list[]">
                                 <?php if(!empty($master_investigations)) { 
                                    echo "<!-- Debug: Found " . count($master_investigations) . " investigations -->";
                                    foreach($master_investigations as $key => $val) { ?>
                                 <option value="<?php echo $val['master_id']; ?>" ><?php echo $val['investigation_name']; ?></option>
                                 <?php  } } else { 
                                    echo "<!-- Debug: No master_investigations data found -->";
                                    } ?>
                                 <option value="0">NA</option>
                              </select>
                           </td>
                           <td>
                              <select class="form-control multidselect_dropdown_1" multiple id="male_minvestigation_suggestion_list" disabled name="male_minvestigation_suggestion_list[]">
                                 <?php if(!empty($master_investigations)) { foreach($master_investigations as $key => $val) { ?>
                                 <option value="<?php echo $val['master_id']; ?>"><?php echo $val['investigation_name']; ?></option>
                                 <?php  } } ?>
                                 <option value="0">NA</option>
                              </select>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- Medication Section opd -->
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-medkit"></i> Medication Advised Opd
                  <label class="checkbox-enhanced pull-right">
                  <input type="checkbox" id="medicine_suggestion" value="1" name="medicine_suggestion" />
                  Enable Medication
                  </label>
               </div>
               <div class="section-content">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group-enhanced">
                           <label><i class="fa fa-female"></i> Patient Medication</label>
                           <select class="form-control multidselect_dropdown" multiple id="female_medicine_suggestion_list" name="female_medicine_suggestion_list[]" disabled>
                              <?php if(!empty($consultation_medicine)) { foreach($consultation_medicine as $key => $val) { ?>
                              <option value="<?php echo $val['item_number']; ?>" medicine="<?php echo $val['item_name']; ?>"><?php echo $val['item_name']; ?></option>
                              <?php  } } ?>
                              <option value="0" medicine="NA">NA</option>
                           </select>
                        </div>
                        <div class="table-responsive">
                           <table id="female_medicine_table" class="table table-bordered medicine-table" style="display:none;">
                              <thead>
                                 <tr>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>Remarks</th>
                                    <th>Start on</th>
                                    <th>Days</th>
                                    <th>Route</th>
                                    <th>Frequency</th>
                                    <th>Timing</th>
                                    <th>Take</th>
                                 </tr>
                              </thead>
                              <tbody id="female_medicine_suggestion_table"></tbody>
                           </table>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group-enhanced">
                           <label><i class="fa fa-male"></i> Spouse Medication</label>
                           <select class="form-control multidselect_dropdown" multiple id="male_medicine_suggestion_list" name="male_medicine_suggestion_list[]" disabled>
                              <?php if(!empty($consultation_medicine)) { foreach($consultation_medicine as $key => $val) { ?>
                              <option value="<?php echo $val['item_number']; ?>" medicine="<?php echo $val['item_name']; ?>"><?php echo $val['item_name']; ?></option>
                              <?php  } } ?>
                              <option value="0" medicine="NA">NA</option>
                           </select>
                        </div>
                        <div class="table-responsive">
                           <table id="male_medicine_table" class="table table-bordered medicine-table" style="display:none;">
                              <thead>
                                 <tr>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>Remarks</th>
                                    <th>Start on</th>
                                    <th>Days</th>
                                    <th>Route</th>
                                    <th>Frequency</th>
                                    <th>Timing</th>
                                    <th>Take</th>
                                 </tr>
                              </thead>
                              <tbody id="male_medicine_suggestion_table"></tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Medication Section ipd -->
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-medkit"></i> Medication Advised Ipd
                  <label class="checkbox-enhanced pull-right">
                  <input type="checkbox" id="medicine_suggestion_ipd" value="1" name="medicine_suggestion_ipd" />
                  Enable Medication
                  </label>
               </div>
               <div class="section-content">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group-enhanced">
                           <label><i class="fa fa-female"></i> Patient Medication</label>
                           <select class="form-control multidselect_dropdown" multiple id="female_medicine_suggestion_list_ipd" name="female_medicine_suggestion_list_ipd[]" disabled>
                              <?php if(!empty($consultation_medicine)) { foreach($consultation_medicine as $key => $val) { ?>
                              <option value="<?php echo $val['item_number']; ?>" medicine="<?php echo $val['item_name']; ?>"><?php echo $val['item_name']; ?></option>
                              <?php  } } ?>
                              <option value="0" medicine="NA">NA</option>
                           </select>
                        </div>
                        <div class="table-responsive">
                           <table id="female_medicine_table_ipd" class="table table-bordered medicine-table" style="display:none;">
                              <thead>
                                 <tr>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>Remarks</th>
                                    <th>Start on</th>
                                    <th>Days</th>
                                    <th>Route</th>
                                    <th>Frequency</th>
                                    <th>Timing</th>
                                    <th>Take</th>
                                 </tr>
                              </thead>
                              <tbody id="female_medicine_suggestion_table_ipd"></tbody>
                           </table>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group-enhanced">
                           <label><i class="fa fa-male"></i> Spouse Medication</label>
                           <select class="form-control multidselect_dropdown" multiple id="male_medicine_suggestion_list_ipd" name="male_medicine_suggestion_list_ipd[]" disabled>
                              <?php if(!empty($consultation_medicine)) { foreach($consultation_medicine as $key => $val) { ?>
                              <option value="<?php echo $val['item_number']; ?>" medicine="<?php echo $val['item_name']; ?>"><?php echo $val['item_name']; ?></option>
                              <?php  } } ?>
                              <option value="0" medicine="NA">NA</option>
                           </select>
                        </div>
                        <div class="table-responsive">
                           <table id="male_medicine_table_ipd" class="table table-bordered medicine-table" style="display:none;">
                              <thead>
                                 <tr>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>Remarks</th>
                                    <th>Start on</th>
                                    <th>Days</th>
                                    <th>Route</th>
                                    <th>Frequency</th>
                                    <th>Timing</th>
                                    <th>Take</th>
                                 </tr>
                              </thead>
                              <tbody id="male_medicine_suggestion_table_ipd"></tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Management Section -->
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-cogs"></i> Management Advised
                  <label class="checkbox-enhanced pull-right">
                  <input type="checkbox" id="procedure_suggestion" value="1" name="procedure_suggestion" />
                  Enable Management
                  </label>
               </div>
               <div class="section-content">
                  <div class="form-group-enhanced">
                     <label>Select Procedures</label>
                     <select class="form-control multidselect_dropdown_2" multiple="multiple" id="sub_procedure_suggestion_list" name="sub_procedure_suggestion_list[]" disabled>
                        <?php if(!empty($procedures)) { foreach($procedures as $key => $val) { ?>
                        <option value="<?php echo $val['ID']; ?>"><?php echo $val['procedure_name']." (".$val['code'].")"; ?></option>
                        <?php  } } ?>
                     </select>
                  </div>
               </div>
            </div>
            <!-- Package Section -->
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-gift"></i> Package Advised
                  <label class="checkbox-enhanced pull-right">
                  <input type="checkbox" id="package_suggestion" value="1" name="package_suggestion" />
                  Enable Package
                  </label>
               </div>
               <div class="section-content">
                  <div class="form-group-enhanced">
                     <label>Select Packages</label>
                     <select class="form-control multidselect_dropdown_2" multiple="multiple" id="package_suggestion_list" name="package_suggestion_list[]" disabled>
                        <?php if(!empty($package)) { foreach($package as $key => $val) { ?>
                        <option value="<?php echo $val['package_name']; ?>"><?php echo $val['package_name']; ?></option>
                        <?php  } } ?>
                     </select>
                  </div>
               </div>
            </div>
            <?php }else { ?>
            <?php  $female_investigation_suggestion_list = array();
               if(isset($patient_doctor_consultation['investation_suggestion']) && $patient_doctor_consultation['investation_suggestion'] == "1"){
               $female_investigation_suggestion_list = unserialize($patient_doctor_consultation['female_investigation_suggestion_list']); 
               $disabled = "";
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
                     }
                     ?>
                  <?php if(!empty($male_investigation_suggestion_list)) {
                     $cis=1;
                      foreach($male_investigation_suggestion_list as $key => $val) { ?>
                  <?php echo $cis.". ".get_investigation_name($val); ?><br/>
                  <?php  $cis++; } }  ?>
               </td>
            </tr>
            <tr style="color: red;">
               <td>IIC INVESTIGATIONS ADVISED</td>
               <td>							
                  <?php if(!empty($female_minvestigation_suggestion_list)) {
                     $cis=1;
                      foreach($female_minvestigation_suggestion_list as $key => $val) { ?>
                  <?php echo $cis.". ".get_master_investigation_name($val); ?><br/>
                  <?php  $cis++;} } ?>							
               </td>
               <td>
                  <?php $male_minvestigation_suggestion_list=array();
                     if(isset($patient_doctor_consultation['investation_suggestion']) && $patient_doctor_consultation['investation_suggestion'] == "1"){
                     	$male_minvestigation_suggestion_list = unserialize($patient_doctor_consultation['male_minvestigation_suggestion_list']); 
                     }
                     ?>
                  <?php if(!empty($male_minvestigation_suggestion_list)) {
                     $cis=1;
                      foreach($male_minvestigation_suggestion_list as $key => $val) { ?>
                  <?php echo $cis.". ".get_master_investigation_name($val); ?><br/>
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
                              <th style="border:1px solid #000; padding:10px;">Remarks</th>
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
                              <td style='border:1px solid #000;'>
                                 <?php echo get_medicine_name($val['female_medicine_name']);?>
                                 <input type="hidden" value="<?php echo $val['female_medicine_name']; ?>" name="female_medicine_name_<?php echo $fmd_count; ?>" id="female_medicine_name_<?php echo $fmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="number" step="0.1" style="margin:0;padding:0;width:100%;" name="female_medicine_dosage_<?php echo $fmd_count; ?>" value="<?php echo $val['female_medicine_dosage']; ?>" id="female_medicine_dosage_<?php echo $fmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="text" style="margin:0;padding:0;width:100%;" name="female_medicine_remarks_<?php echo $fmd_count; ?>" value="<?php echo $val['female_medicine_remarks']; ?>" id="female_medicine_remarks_<?php echo $fmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="date" style="margin:0;padding:0;width:100%;" name="female_medicine_when_start_<?php echo $fmd_count; ?>" value="<?php echo $val['female_medicine_when_start']; ?>" id="female_medicine_when_start_<?php echo $fmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="number" style="margin:0;padding:0;width:100%;" name="female_medicine_days_<?php echo $fmd_count; ?>" value="<?php echo $val['female_medicine_days']; ?>" id="female_medicine_days_<?php echo $fmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="female_medicine_route_<?php echo $fmd_count; ?>" id="female_medicine_route_<?php echo $fmd_count; ?>">
                                    <option value="PO" <?php echo ($val['female_medicine_route'] == 'PO') ? 'selected' : ''; ?>>PO</option>
                                    <option value="IM" <?php echo ($val['female_medicine_route'] == 'IM') ? 'selected' : ''; ?>>IM</option>
                                    <option value="SC" <?php echo ($val['female_medicine_route'] == 'SC') ? 'selected' : ''; ?>>SC</option>
                                    <option value="IV" <?php echo ($val['female_medicine_route'] == 'IV') ? 'selected' : ''; ?>>IV</option>
                                    <option value="TOPICAL" <?php echo ($val['female_medicine_route'] == 'TOPICAL') ? 'selected' : ''; ?>>TOPICAL</option>
                                 </select>
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="female_medicine_frequency_<?php echo $fmd_count; ?>" id="female_medicine_frequency_<?php echo $fmd_count; ?>">
                                    <option value="OD" <?php echo ($val['female_medicine_frequency'] == 'OD') ? 'selected' : ''; ?>>OD</option>
                                    <option value="BD" <?php echo ($val['female_medicine_frequency'] == 'BD') ? 'selected' : ''; ?>>BD</option>
                                    <option value="TDS" <?php echo ($val['female_medicine_frequency'] == 'TDS') ? 'selected' : ''; ?>>TDS</option>
                                    <option value="QID" <?php echo ($val['female_medicine_frequency'] == 'QID') ? 'selected' : ''; ?>>QID</option>
                                 </select>
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="female_medicine_timing_<?php echo $fmd_count; ?>" id="female_medicine_timing_<?php echo $fmd_count; ?>">
                                    <option value="EMPTY STOMACH" <?php echo ($val['female_medicine_timing'] == 'EMPTY STOMACH') ? 'selected' : ''; ?>>EMPTY STOMACH</option>
                                    <option value="BEFORE MEAL" <?php echo ($val['female_medicine_timing'] == 'BEFORE MEAL') ? 'selected' : ''; ?>>BEFORE MEAL</option>
                                    <option value="AFTER MEAL" <?php echo ($val['female_medicine_timing'] == 'AFTER MEAL') ? 'selected' : ''; ?>>AFTER MEAL</option>
                                 </select>
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="female_medicine_take_<?php echo $fmd_count; ?>" id="female_medicine_take_<?php echo $fmd_count; ?>">
                                    <option value="Daily" <?php echo ($val['female_medicine_take'] == 'Daily') ? 'selected' : ''; ?>>Daily</option>
                                    <option value="Biweekly" <?php echo ($val['female_medicine_take'] == 'Biweekly') ? 'selected' : ''; ?>>Biweekly</option>
                                    <option value="Weekly" <?php echo ($val['female_medicine_take'] == 'Weekly') ? 'selected' : ''; ?>>Weekly</option>
                                 </select>
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
                              <th style="border:1px solid #000; padding:10px;">Remarks</th>
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
                              <td style='border:1px solid #000;'>
                                 <?php echo get_medicine_name($val['male_medicine_name']);?>
                                 <input type="hidden" value="<?php echo $val['male_medicine_name']; ?>" name="male_medicine_name_<?php echo $mmd_count; ?>" id="male_medicine_name_<?php echo $mmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="number" step="0.1" style="margin:0;padding:0;width:100%;" name="male_medicine_dosage_<?php echo $mmd_count; ?>" value="<?php echo $val['male_medicine_dosage']; ?>" id="male_medicine_dosage_<?php echo $mmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="text" style="margin:0;padding:0;width:100%;" name="male_medicine_remarks_<?php echo $mmd_count; ?>" value="<?php echo $val['male_medicine_remarks']; ?>" id="male_medicine_remarks_<?php echo $mmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="date" style="margin:0;padding:0;width:100%;" name="male_medicine_when_start_<?php echo $mmd_count; ?>" value="<?php echo $val['male_medicine_when_start']; ?>" id="male_medicine_when_start_<?php echo $mmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;'>
                                 <input type="number" style="margin:0;padding:0;width:100%;" name="male_medicine_days_<?php echo $mmd_count; ?>" value="<?php echo $val['male_medicine_days']; ?>" id="male_medicine_days_<?php echo $mmd_count; ?>">
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="male_medicine_route_<?php echo $mmd_count; ?>" id="male_medicine_route_<?php echo $mmd_count; ?>">
                                    <option value="PO" <?php echo ($val['male_medicine_route'] == 'PO') ? 'selected' : ''; ?>>PO</option>
                                    <option value="IM" <?php echo ($val['male_medicine_route'] == 'IM') ? 'selected' : ''; ?>>IM</option>
                                    <option value="SC" <?php echo ($val['male_medicine_route'] == 'SC') ? 'selected' : ''; ?>>SC</option>
                                    <option value="IV" <?php echo ($val['male_medicine_route'] == 'IV') ? 'selected' : ''; ?>>IV</option>
                                    <option value="TOPICAL" <?php echo ($val['male_medicine_route'] == 'TOPICAL') ? 'selected' : ''; ?>>TOPICAL</option>
                                 </select>
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="male_medicine_frequency_<?php echo $mmd_count; ?>" id="male_medicine_frequency_<?php echo $mmd_count; ?>">
                                    <option value="OD" <?php echo ($val['male_medicine_frequency'] == 'OD') ? 'selected' : ''; ?>>OD</option>
                                    <option value="BD" <?php echo ($val['male_medicine_frequency'] == 'BD') ? 'selected' : ''; ?>>BD</option>
                                    <option value="TDS" <?php echo ($val['male_medicine_frequency'] == 'TDS') ? 'selected' : ''; ?>>TDS</option>
                                    <option value="QID" <?php echo ($val['male_medicine_frequency'] == 'QID') ? 'selected' : ''; ?>>QID</option>
                                 </select>
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="male_medicine_timing_<?php echo $mmd_count; ?>" id="male_medicine_timing_<?php echo $mmd_count; ?>">
                                    <option value="EMPTY STOMACH" <?php echo ($val['male_medicine_timing'] == 'EMPTY STOMACH') ? 'selected' : ''; ?>>EMPTY STOMACH</option>
                                    <option value="BEFORE MEAL" <?php echo ($val['male_medicine_timing'] == 'BEFORE MEAL') ? 'selected' : ''; ?>>BEFORE MEAL</option>
                                    <option value="AFTER MEAL" <?php echo ($val['male_medicine_timing'] == 'AFTER MEAL') ? 'selected' : ''; ?>>AFTER MEAL</option>
                                 </select>
                              </td>
                              <td style='border:1px solid #000;' class='role'>
                                 <select style="margin:0;padding:0;width:100%;" name="male_medicine_take_<?php echo $mmd_count; ?>" id="male_medicine_take_<?php echo $mmd_count; ?>">
                                    <option value="Daily" <?php echo ($val['male_medicine_take'] == 'Daily') ? 'selected' : ''; ?>>Daily</option>
                                    <option value="Biweekly" <?php echo ($val['male_medicine_take'] == 'Biweekly') ? 'selected' : ''; ?>>Biweekly</option>
                                    <option value="Weekly" <?php echo ($val['male_medicine_take'] == 'Weekly') ? 'selected' : ''; ?>>Weekly</option>
                                 </select>
                              </td>
                           </tr>
                           <?php $mmd_count++; }} ?>										
                        </tbody>
                        </thead>
                     </table>
                  </div>
               </td>
            </tr>
            <tr>
               <td colspan="4">Inform on day one of menstrual cycle</td>
            </tr>
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
            <tr>
               <td style="color: red;">PACKAGE ADVISED  </td>
               <td colspan="3" style="width:100px;">
                  <?php $cis = 1;
                     if(!empty($package_suggestion_list)) {
                     	foreach($package as $key => $val) {
                     		if(in_array($val['ID'], $package_suggestion_list)){
                     			echo $cis.". ".$val['procedure_name']." (".$val['code'].") <br/>";
                     			$cis++;
                     		}
                     	}
                              	} ?>
               </td>
            </tr>
            <?php } ?>
            <!-- Advisory Section -->
            <div class="section-card">
               <div class="section-header">
                  <i class="fa fa-file-text-o"></i> Advisory Templates
               </div>
               <div class="section-content">
                  <div class="form-group-enhanced">
                     <label>Select Advisory Templates</label>
                     <select class="form-control multidselect_dropdown_2" multiple="multiple" id="advisory_templates" name="advisory_templates[]">
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
                  </div>
               </div>
            </div>
            <!-- Follow-up Appointment Section -->
            <div class="follow-up-section">
               <h4><i class="fa fa-calendar"></i> Next Follow-up Appointment</h4>
               <input type="hidden" id="follow_up" checked value="1" name="follow_up" />
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group-enhanced">
                        <label for="appoitment_for">Centre <span class="text-danger">*</span></label>
                        <select name="appoitment_for" style="height: 50px !important;" required class="form-control form-control-enhanced empty-field" id="appoitment_for">
                           <option value="">Select Centre</option>
                           <?php $center = $all_method->get_center_list(); foreach($center as $key => $center){?>
                           <option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6 appoitmented_doctor" style="display:none;">
                     <div class="form-group-enhanced">
                        <label for="appoitmented_doctor">Doctor <span class="text-danger">*</span></label>
                        <select name="appoitmented_doctor" style="height: 50px !important;" disabled class="form-control form-control-enhanced empty-field" id="appoitmented_doctor">
                           <option value="">Select Doctor</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 appoitmented_date" style="display:none;">
                     <div class="form-group-enhanced">
                        <label for="appoitmented_date">Appointment Date <span class="text-danger">*</span></label>
                        <input value="" id="appoitmented_date" disabled autocomplete="off" name="follow_up_date" type="text" class="form-control form-control-enhanced empty-field validate" placeholder="Select Date">
                     </div>
                  </div>
                  <div class="col-md-6 appoitmented_slot" style="display:none;">
                     <div class="form-group-enhanced">
                        <label for="appoitmented_slot">Time Slot <span class="text-danger">*</span></label>
                        <select name="appoitmented_slot" disabled style="height: 50px !important;" class="form-control form-control-enhanced empty-field" id="appoitmented_slot">
                           <option value="">Select Time Slot</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group-enhanced">
                  <label>Purpose of Next Follow-up</label>
                  <div class="purpose-radio-group">
                     <div class="radio-enhanced">
                        <input type="radio" name="follow_up_purpose" value="TVS" id="purpose_tvs">
                        <label for="purpose_tvs">TVS</label>
                     </div>
                     <div class="radio-enhanced">
                        <input type="radio" name="follow_up_purpose" checked value="FOLLOW UP VISIT" id="purpose_followup">
                        <label for="purpose_followup">Follow Up Visit</label>
                     </div>
                     <div class="radio-enhanced">
                        <input type="radio" name="follow_up_purpose" value="PROCEDURE" id="purpose_procedure">
                        <label for="purpose_procedure">Procedure</label>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Loading Indicator -->
            <div id="loader_div" style="display: none; text-align: center; margin: 20px 0;">
               <i class="fa fa-spinner fa-spin fa-2x"></i>
               <p>Loading...</p>
            </div>
            
            <!-- Submit Button -->
            <div class="text-center" style="margin-top: 30px;">
               <button type="submit" class="btn btn-primary btn-enhanced btn-primary-enhanced">
               <i class="fa fa-save"></i> Submit Follow-up Consultation
               </button>
            </div>
      </form>
      </div>
   </div>
</div>
<script>
   // Performance optimizations - cache DOM elements
   var $appointmentFor = $('#appoitment_for');
   var $appointmentDoctor = $('#appoitmented_doctor');
   var $appointmentDate = $('#appoitmented_date');
   var $appointmentSlot = $('#appoitmented_slot');
   var $doctorDiv = $('div.appoitmented_doctor');
   var $dateDiv = $('div.appoitmented_date');
   var $slotDiv = $('div.appoitmented_slot');
   var $loaderDiv = $('#loader_div');
   
   //Centre Doctor - Optimized
   $appointmentFor.on("change", function() {
   	$doctorDiv.hide();
   	$dateDiv.hide();
   	$slotDiv.hide();
   	
   	$loaderDiv.show();
   	var centre_id = $(this).val();
   	if(centre_id != ''){
   		$.ajax({
   		url: '<?php echo base_url('billingcontroller/search_doctor')?>',
   		data: {centre_id:centre_id},
   		dataType: 'json',
   		method:'post',
   		success: function(data)
   		{
   			$appointmentDoctor.empty().append(data);
   			$appointmentDoctor.prop({'required': true, 'disabled': false});
   			$doctorDiv.show();
   			$loaderDiv.hide();			
   		} 
     });
       }
   	else{
   		$doctorDiv.hide();
   		$loaderDiv.hide();
   	}
   });
   
   $appointmentDoctor.on("change", function() {
   	$loaderDiv.show();
   	var doctor_id = $(this).val();
   	$appointmentDate.val('');
   	if(doctor_id != ''){
   		$appointmentDate.prop({'required': true, 'disabled': false});
   		$dateDiv.show();
   	}else{
   		$dateDiv.hide();
   	}
   	$loaderDiv.hide();
   });
   
   $( function() {
       $appointmentDate.datepicker({
   			dateFormat: 'yy-mm-dd',
   			changeMonth: true,
   			changeYear: true,
   		 	minDate: 0,
   			onSelect: function(dateStr) {
   				$loaderDiv.show();				
   				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
   				var appoitmented_doctor = $appointmentDoctor.val();
   				$.ajax({
   					url: '<?php echo base_url('billingcontroller/doctor_slots')?>',
   					type: 'POST',
   					data: {selected:startDate, appoitmented_doctor:appoitmented_doctor},
   					success: function(data) {
   						$appointmentSlot.empty().append(data);
   						$appointmentSlot.prop({'required': true, 'disabled': false});
   						$slotDiv.show();
   						$loaderDiv.hide();
   					}
   				});
   			}
   		});
   } );
   
   $("#follow_up").change(function() {
   	$doctorDiv.hide();
   	$dateDiv.hide();
   	$slotDiv.hide();
   	
   	$appointmentFor.prop({'selectedIndex': 0, 'required': false, 'disabled': true});
   	$appointmentDoctor.prop({'selectedIndex': 0, 'required': false, 'disabled': true});
   	$appointmentDate.val('').prop({'required': false, 'disabled': true});
   	$appointmentSlot.prop({'selectedIndex': 0, 'required': false, 'disabled': true});
   	
   	if(this.checked) {
   		$appointmentFor.prop({'required': true, 'disabled': false});
   	}
   });
   
   $(function() {
   $('#male_medicine_suggestion_list').change(function(e) {
   	$("table#male_medicine_table").hide();
   	var brands = $('#male_medicine_suggestion_list option:selected');
   	var selected = "";
   	var countr=1;
   	// Don't empty existing data - preserve it
   	// $("tbody#male_medicine_suggestion_table").empty();
   	$(brands).each(function(index, brand){
   		$("tbody#male_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='male_medicine_name_"+countr+"' id='male_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' step='0.1' style='margin:0;padding:0;' name='male_medicine_dosage_"+countr+"' required id='male_medicine_dosage_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' style='margin:0;padding:0;' name='male_medicine_remarks_"+countr+"' required id='male_medicine_remarks_"+countr+"'></td><td style='border:1px solid #000;'><input type='date' placeholder='DD-MM-YYYY' style='margin:0;padding:0;' name='male_medicine_when_start_"+countr+"' id='male_medicine_when_start_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_days_"+countr+"' required id='male_medicine_days_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_route_"+countr+"' id='male_medicine_route_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_frequency_"+countr+"' id='male_medicine_frequency_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_timing_"+countr+"' id='male_medicine_timing_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_take_"+countr+"' id='male_medicine_take_"+countr+"' required> <option value='Daily'>Daily</option> <option value='Biweekly'>Biweekly</option> <option value='Weekly'>Weekly</option> <option value='Blank'>Blank</option> <option value='Alternate Day'>Alternate Day</option></select></td></tr>");
   		countr++;
   	});
   	$("table#male_medicine_table").show();
   }); 
   
   $('#female_medicine_suggestion_list').change(function(e) {
   	$("table#female_medicine_table").hide();
   	var brands = $('#female_medicine_suggestion_list option:selected');
   	var selected = "";
   	var countr=1;
   	// Don't empty existing data - preserve it
   	// $("tbody#female_medicine_suggestion_table").empty();
   	$(brands).each(function(index, brand){
   		$("tbody#female_medicine_suggestion_table").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='female_medicine_name_"+countr+"' id='female_medicine_name_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' step='0.1' style='margin:0;padding:0;' name='female_medicine_dosage_"+countr+"' required id='female_medicine_dosage_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' style='margin:0;padding:0;' name='female_medicine_remarks_"+countr+"' required id='female_medicine_remarks_"+countr+"'></td><td style='border:1px solid #000;'><input type='date' placeholder='DD-MM-YYYY' style='margin:0;padding:0;' name='female_medicine_when_start_"+countr+"' id='female_medicine_when_start_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_days_"+countr+"' required id='female_medicine_days_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_route_"+countr+"' id='female_medicine_route_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_frequency_"+countr+"' id='female_medicine_frequency_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_timing_"+countr+"' id='female_medicine_timing_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_take_"+countr+"' id='female_medicine_take_"+countr+"' required> <option value='Daily'>Daily</option> <option value='Biweekly'>Biweekly</option> <option value='Weekly'>Weekly</option> <option value='Blank'>Blank</option> <option value='Alternate Day'>Alternate Day</option></select></td></tr>");
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
   
   // IPD Medication JavaScript
   $(function() {
   $('#male_medicine_suggestion_list_ipd').change(function(e) {
   	$("table#male_medicine_table_ipd").hide();
   	var brands = $('#male_medicine_suggestion_list_ipd option:selected');
   	var selected = "";
   	var countr=1;
   	// Don't empty existing data - preserve it
   	// $("tbody#male_medicine_suggestion_table_ipd").empty();
   	$(brands).each(function(index, brand){
   		$("tbody#male_medicine_suggestion_table_ipd").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='male_medicine_name_ipd_"+countr+"' id='male_medicine_name_ipd_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' step='0.1' style='margin:0;padding:0;' name='male_medicine_dosage_ipd_"+countr+"' required id='male_medicine_dosage_ipd_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' style='margin:0;padding:0;' name='male_medicine_remarks_ipd_"+countr+"' required id='male_medicine_remarks_ipd_"+countr+"'></td><td style='border:1px solid #000;'><input type='date' placeholder='DD-MM-YYYY' style='margin:0;padding:0;' name='male_medicine_when_start_ipd_"+countr+"' id='male_medicine_when_start_ipd_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='male_medicine_days_ipd_"+countr+"' required id='male_medicine_days_ipd_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_route_ipd_"+countr+"' id='male_medicine_route_ipd_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_frequency_ipd_"+countr+"' id='male_medicine_frequency_ipd_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_timing_ipd_"+countr+"' id='male_medicine_timing_ipd_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='male_medicine_take_ipd_"+countr+"' id='male_medicine_take_ipd_"+countr+"' required> <option value='Daily'>Daily</option> <option value='Biweekly'>Biweekly</option> <option value='Weekly'>Weekly</option> <option value='Blank'>Blank</option> <option value='Alternate Day'>Alternate Day</option></select></td></tr>");
   		countr++;
   	});
   	$("table#male_medicine_table_ipd").show();
   }); 
   
   $('#female_medicine_suggestion_list_ipd').change(function(e) {
   	$("table#female_medicine_table_ipd").hide();
   	var brands = $('#female_medicine_suggestion_list_ipd option:selected');
   	var selected = "";
   	var countr=1;
   	// Don't empty existing data - preserve it
   	// $("tbody#female_medicine_suggestion_table_ipd").empty();
   	$(brands).each(function(index, brand){
   		$("tbody#female_medicine_suggestion_table_ipd").append("<tr style='border:1px solid #000;'><td style='border:1px solid #000;'>"+$(this).attr('medicine')+"<input type='hidden' required readonly value='"+$(this).val()+"' style='margin:0;padding:0;' name='female_medicine_name_ipd_"+countr+"' id='female_medicine_name_ipd_"+countr+"'></td><td style='border:1px solid #000;'><input type='number' step='0.1' style='margin:0;padding:0;' name='female_medicine_dosage_ipd_"+countr+"' required id='female_medicine_dosage_ipd_"+countr+"'></td><td style='border:1px solid #000;'><input type='text' style='margin:0;padding:0;' name='female_medicine_remarks_ipd_"+countr+"' required id='female_medicine_remarks_ipd_"+countr+"'></td><td style='border:1px solid #000;'><input type='date' placeholder='DD-MM-YYYY' style='margin:0;padding:0;' name='female_medicine_when_start_ipd_"+countr+"' id='female_medicine_when_start_ipd_"+countr+"' required></td><td style='border:1px solid #000;'><input type='number' style='margin:0;padding:0;' name='female_medicine_days_ipd_"+countr+"' required id='female_medicine_days_ipd_"+countr+"'></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_route_ipd_"+countr+"' id='female_medicine_route_ipd_"+countr+"' required> <option value='PO'>PO</option> <option value='IM'>IM</option> <option value='SC'>SC</option> <option value='VAGINA-LY'>VAGINA-LY</option> <option value='IV'>IV</option> <option value='LOCAL'>LOCAL</option> <option value='NASALY'>NASALY</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_frequency_ipd_"+countr+"' id='female_medicine_frequency_ipd_"+countr+"' required> <option value='OD'>OD</option> <option value='BD'>BD</option> <option value='TDS'>TDS</option> <option value='QID'>QID</option> <option value='SOS'>SOS</option> <option value='HS'>HS</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_timing_ipd_"+countr+"' id='female_medicine_timing_ipd_"+countr+"' required> <option value='EMPTY STOMACH'>EMPTY STOMACH</option> <option value='BEFORE MEAL'>BEFORE MEAL</option> <option value='AFTER MEAL'>AFTER MEAL</option></select></td><td style='border:1px solid #000;' class='role'><select style='margin:0;padding:0;' name='female_medicine_take_ipd_"+countr+"' id='female_medicine_take_ipd_"+countr+"' required> <option value='Daily'>Daily</option> <option value='Biweekly'>Biweekly</option> <option value='Weekly'>Weekly</option> <option value='Blank'>Blank</option> <option value='Alternate Day'>Alternate Day</option></select></td></tr>");
   		countr++;
   		//selected.push([$(this).val()+"--------"+$(this).attr('medicine')]);
   	});
   	//console.log(selected);
   	$("table#female_medicine_table_ipd").show();
   }); 
   });
   
   $("#medicine_suggestion_ipd").change(function() {
   //Male Investigation IPD
   $("select#male_medicine_suggestion_list_ipd").prop('disabled',true);
   $("select#male_medicine_suggestion_list_ipd").parent().find('button').prop('disabled',true);
   $("select#male_medicine_suggestion_list_ipd").parent().find('button').addClass('disabled');
   $('option', $('#male_medicine_suggestion_list_ipd')).each(function(element) {
   	$(this).removeAttr('selected').prop('selected', false);
   });
   $("#male_medicine_suggestion_list_ipd").multiselect('refresh');	
   $("select#male_medicine_suggestion_list_ipd").prop('required',false);
   //Female Investigation IPD
   $("select#female_medicine_suggestion_list_ipd").prop('disabled',true);
   $("select#female_medicine_suggestion_list_ipd").parent().find('button').prop('disabled',true);
   $("select#female_medicine_suggestion_list_ipd").parent().find('button').addClass('disabled');
   $('option', $('#female_medicine_suggestion_list_ipd')).each(function(element) {
   	$(this).removeAttr('selected').prop('selected', false);
   });
   $("#female_medicine_suggestion_list_ipd").multiselect('refresh');	
   $("select#female_medicine_suggestion_list_ipd").prop('required',false);
   
   if(this.checked) {
   	//Male Investigation IPD
   	$("select#male_medicine_suggestion_list_ipd").prop('required',false);
   	$("select#male_medicine_suggestion_list_ipd").prop('disabled',false);
   	$("select#male_medicine_suggestion_list_ipd").parent().find('button').prop('disabled',false);
   	$("select#male_medicine_suggestion_list_ipd").parent().find('button').removeClass('disabled');
   	//Female Investigation IPD
   	$("select#female_medicine_suggestion_list_ipd").prop('required',true);
   	$("select#female_medicine_suggestion_list_ipd").prop('disabled',false);
   	$("select#female_medicine_suggestion_list_ipd").parent().find('button').prop('disabled',false);
   	$("select#female_medicine_suggestion_list_ipd").parent().find('button').removeClass('disabled');
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
   
   // Male Investigation
   $("select#male_minvestigation_suggestion_list").prop('disabled',true);
   $("select#male_minvestigation_suggestion_list").parent().find('button').prop('disabled',true);
   $("select#male_minvestigation_suggestion_list").parent().find('button').addClass('disabled');
   $('option', $('#male_minvestigation_suggestion_list')).each(function(element) {
   	$(this).removeAttr('selected').prop('selected', false);
   });
   $("#male_minvestigation_suggestion_list").multiselect('refresh');
   $("select#male_minvestigation_suggestion_list").prop('required',false);
   //Female Investigation
   $("select#female_minvestigation_suggestion_list").prop('disabled',true);
   $("select#female_minvestigation_suggestion_list").parent().find('button').prop('disabled',true);
   $("select#female_minvestigation_suggestion_list").parent().find('button').addClass('disabled');
   $('option', $('#female_minvestigation_suggestion_list')).each(function(element) {
   	$(this).removeAttr('selected').prop('selected', false);
   });
   $("#female_minvestigation_suggestion_list").multiselect('refresh');
   $("select#female_minvestigation_suggestion_list").prop('required',false);
   
   if(this.checked) {
   	// Male Investigation
   	$("select#male_minvestigation_suggestion_list").prop('required',false);
   	$("select#male_minvestigation_suggestion_list").prop('disabled',false);
   	$("select#male_minvestigation_suggestion_list").parent().find('button').prop('disabled',false);
   	$("select#male_minvestigation_suggestion_list").parent().find('button').removeClass('disabled');
   	//Female Investigation
   	$("select#female_minvestigation_suggestion_list").prop('required',true);
   	$("select#female_minvestigation_suggestion_list").prop('disabled',false);
   	$("select#female_minvestigation_suggestion_list").parent().find('button').prop('disabled',false);
   	$("select#female_minvestigation_suggestion_list").parent().find('button').removeClass('disabled');
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
   
   
   $("#package_suggestion").change(function() {
   //Female Investigation
   $("select#package_suggestion_list").prop('disabled',true);
   $("select#package_suggestion_list").parent().find('button').prop('disabled',true);
   $("select#package_suggestion_list").parent().find('button').addClass('disabled');
   $('option', $('#package_suggestion_list')).each(function(element) {
   	$(this).removeAttr('selected').prop('selected', false);
   });
   $("#package_suggestion_list").multiselect('refresh');
   $("select#package_suggestion_list").prop('required',false);
   
   if(this.checked) {
   	$("select#package_suggestion_list").prop('required',true);
   	$("select#package_suggestion_list").prop('disabled',false);
   	$("select#package_suggestion_list").parent().find('button').prop('disabled',false);
   	$("select#package_suggestion_list").parent().find('button').removeClass('disabled');
   }
   });
   
   // Global variable to track multiselect selections
   var multiselectSelections = {};
   
   // Function to force enable and capture multiselect values
   function forceCaptureMultiselectValues() {
       // Clear previous selections
       multiselectSelections = {};
       
       // First, enable all multiselect elements
       console.log('Processing multiselect elements...');
       
       // Target the original select elements (not the multiselect generated ones)
       var selectors = [
           'select[id="female_medicine_suggestion_list"]',
           'select[id="male_medicine_suggestion_list"]',
           'select[id="female_medicine_suggestion_list_ipd"]',
           'select[id="male_medicine_suggestion_list_ipd"]',
           'select[id="female_minvestigation_suggestion_list"]',
           'select[id="male_minvestigation_suggestion_list"]',
           'select[id="sub_procedure_suggestion_list"]',
           'select[id="package_suggestion_list"]',
           'select[name="advisory_templates[]"]'
       ];
       
       selectors.forEach(function(selector) {
           var $select = $(selector);
           if ($select.length) {
               var name = $select.attr('name');
               console.log('Processing element:', selector, 'with name:', name);
               
               if (name) {
                   // Enable the element
                   $select.prop('disabled', false);
                   
                   // Get selected options directly
                   var selectedValues = [];
                   $select.find('option:selected').each(function() {
                       selectedValues.push($(this).val());
                   });
                   
                   // Store the values
                   if (selectedValues.length > 0) {
                       multiselectSelections[name] = selectedValues;
                       console.log('Captured values for', name, ':', selectedValues);
                   }
               }
           }
       });
       
       return multiselectSelections;
   }
   
   $(function() {
       // Optimized multiselect initialization for better performance
       var multiselectConfig = {
           includeSelectAllOption: true,
           enableFiltering: true,
           enableCaseInsensitiveFiltering: true,
           filterPlaceholder: 'Search...',
           maxHeight: 200,
           buttonWidth: '100%',
           // Use body as dropdown parent to prevent clipping
           dropdownParent: $('body'),
           // Additional options to prevent clipping
           position: {
               my: 'left top',
               at: 'left bottom',
               collision: 'flip'
           },
           // Remove onChange event as it's causing issues with undefined select parameter
           // We'll capture values during form submission instead
       };
       
       // Debug: Check if elements exist
       console.log('Found multiselect elements:', $('.multidselect_dropdown, .multidselect_dropdown_1, .multidselect_dropdown_2').length);
       
       // Initialize all multiselects at once with error handling
       try {
           $('.multidselect_dropdown, .multidselect_dropdown_1, .multidselect_dropdown_2').multiselect(multiselectConfig);
           console.log('Multiselect initialized successfully');
       } catch(e) {
           console.error('Multiselect initialization failed:', e);
       }
       
       // Debug: Check if multiselect was initialized
       console.log('Multiselect initialized on:', $('#female_minvestigation_suggestion_list').length, 'elements');
       
       // Additional fix: Ensure dropdowns are repositioned on scroll/resize
       $(window).on('scroll resize', function() {
           $('.multiselect-container').each(function() {
               $(this).css('position', 'absolute');
           });
       });
   });
   
   // Function to manually capture multiselect values
   function captureMultiselectValues() {
       var multiselectValues = {};
       
       // Capture values from all multiselect elements
       $('.multidselect_dropdown, .multidselect_dropdown_1, .multidselect_dropdown_2').each(function() {
           var $select = $(this);
           var name = $select.attr('name');
           
           // Try to get values from the multiselect button text or selected options
           var values = [];
           
           // Method 1: Try to get from the select element itself
           if ($select.val()) {
               values = $select.val();
           }
           
           // Method 2: If select is disabled, try to get from multiselect button
           if (values.length === 0) {
               var $button = $select.parent().find('.multiselect');
               var buttonText = $button.text();
               if (buttonText && buttonText !== 'Select options' && buttonText !== 'None selected') {
                   // This is a fallback - we'll need to track selections differently
                   console.log('Button text for ' + name + ':', buttonText);
               }
           }
           
           // Method 3: Try to get from selected options in the dropdown
           if (values.length === 0) {
               $select.find('option:selected').each(function() {
                   values.push($(this).val());
               });
           }
           
           if (name && values.length > 0) {
               multiselectValues[name] = values;
               
               // Add hidden inputs to ensure values are submitted
               $select.siblings('input[name="' + name + '"]').remove(); // Remove existing hidden inputs
               values.forEach(function(value) {
                   $select.after('<input type="hidden" name="' + name + '" value="' + value + '">');
               });
           }
       });
       
       return multiselectValues;
   }
   
   // Function to generate medicine tables directly
   function generateMedicineTable(gender, suffix = '') {
       var selectId = '#' + gender + '_medicine_suggestion_list' + suffix;
       var tableId = '#' + gender + '_medicine_table' + suffix;
       var tbodyId = '#' + gender + '_medicine_suggestion_table' + suffix;
       
       console.log('generateMedicineTable called with:', gender, suffix);
       console.log('selectId:', selectId);
       console.log('tableId:', tableId);
       console.log('tbodyId:', tbodyId);
       console.log('Selected options count:', $(selectId + ' option:selected').length);
       
       $(tableId).hide();
       var brands = $(selectId + ' option:selected');
       var countr = 1;
       $(tbodyId).empty();
       
       $(brands).each(function(index, brand) {
           var medicineName = $(this).attr('medicine');
           var medicineValue = $(this).val();
           
           console.log('Generating row for medicine:', medicineName, 'with value:', medicineValue);
           
           var row = '<tr style="border:1px solid #000;">' +
               '<td style="border:1px solid #000;">' + medicineName + 
               '<input type="hidden" required readonly value="' + medicineValue + '" style="margin:0;padding:0;" name="' + gender + '_medicine_name_' + countr + '" id="' + gender + '_medicine_name_' + countr + '">' +
               '</td>' +
               '<td style="border:1px solid #000;"><input type="number" step="0.1" style="margin:0;padding:0;" name="' + gender + '_medicine_dosage_' + countr + '" required id="' + gender + '_medicine_dosage_' + countr + '"></td>' +
               '<td style="border:1px solid #000;"><input type="text" style="margin:0;padding:0;" name="' + gender + '_medicine_remarks_' + countr + '" required id="' + gender + '_medicine_remarks_' + countr + '"></td>' +
               '<td style="border:1px solid #000;"><input type="date" placeholder="DD-MM-YYYY" style="margin:0;padding:0;" name="' + gender + '_medicine_when_start_' + countr + '" id="' + gender + '_medicine_when_start_' + countr + '" required></td>' +
               '<td style="border:1px solid #000;"><input type="number" style="margin:0;padding:0;" name="' + gender + '_medicine_days_' + countr + '" required id="' + gender + '_medicine_days_' + countr + '"></td>' +
               '<td style="border:1px solid #000;" class="role"><select style="margin:0;padding:0;" name="' + gender + '_medicine_route_' + countr + '" id="' + gender + '_medicine_route_' + countr + '" required>' +
               '<option value="PO">PO</option>' +
               '<option value="IM">IM</option>' +
               '<option value="SC">SC</option>' +
               '<option value="VAGINA-LY">VAGINA-LY</option>' +
               '<option value="IV">IV</option>' +
               '<option value="LOCAL">LOCAL</option>' +
               '<option value="NASALY">NASALY</option>' +
               '</select></td>' +
               '<td style="border:1px solid #000;" class="role"><select style="margin:0;padding:0;" name="' + gender + '_medicine_frequency_' + countr + '" id="' + gender + '_medicine_frequency_' + countr + '" required>' +
               '<option value="OD">OD</option>' +
               '<option value="BD">BD</option>' +
               '<option value="TDS">TDS</option>' +
               '<option value="QID">QID</option>' +
               '<option value="SOS">SOS</option>' +
               '<option value="HS">HS</option>' +
               '</select></td>' +
               '<td style="border:1px solid #000;" class="role"><select style="margin:0;padding:0;" name="' + gender + '_medicine_timing_' + countr + '" id="' + gender + '_medicine_timing_' + countr + '" required>' +
               '<option value="EMPTY STOMACH">EMPTY STOMACH</option>' +
               '<option value="BEFORE MEAL">BEFORE MEAL</option>' +
               '<option value="AFTER MEAL">AFTER MEAL</option>' +
               '</select></td>' +
               '<td style="border:1px solid #000;" class="role"><select style="margin:0;padding:0;" name="' + gender + '_medicine_take_' + countr + '" id="' + gender + '_medicine_take_' + countr + '" required>' +
               '<option value="Daily">Daily</option>' +
               '<option value="Biweekly">Biweekly</option>' +
               '<option value="Weekly">Weekly</option>' +
               '<option value="Blank">Blank</option>' +
               '<option value="Alternate Day">Alternate Day</option>' +
               '</select></td>' +
               '</tr>';
           
           $(tbodyId).append(row);
           console.log('Appended row to tbody:', tbodyId);
           countr++;
       });
       
       $(tableId).show();
   }
   
   
   // Fix for multiselect data not going in POST - Enable all elements before submission
   $('form').on('submit', function(e) {
       // Prevent default form submission temporarily
       e.preventDefault();
       
       // Enable all multiselect elements first
       $('.multidselect_dropdown, .multidselect_dropdown_1, .multidselect_dropdown_2').prop('disabled', false);
       
       // Generate medicine tables directly for OPD medicines
       if ($('#medicine_suggestion').is(':checked')) {
           console.log('OPD medicine suggestion is checked, generating OPD tables');
           generateMedicineTable('male');
           generateMedicineTable('female');
       } else {
           console.log('OPD medicine suggestion is NOT checked');
       }
       
       // Generate medicine tables directly for IPD medicines
       if ($('#medicine_suggestion_ipd').is(':checked')) {
           console.log('IPD medicine suggestion is checked, generating IPD tables');
           generateMedicineTable('male', '_ipd');
           generateMedicineTable('female', '_ipd');
       } else {
           console.log('IPD medicine suggestion is NOT checked');
       }
       
       // Force capture multiselect values
       var capturedValues = forceCaptureMultiselectValues();
       console.log('Captured multiselect values:', capturedValues);
       
       // Add hidden inputs for all captured values
       for (var fieldName in capturedValues) {
           var values = capturedValues[fieldName];
           console.log('Processing field:', fieldName, 'with values:', values);
           
           // Remove existing hidden inputs for this field
           $('input[name="' + fieldName + '"]').remove();
           
           // Add hidden inputs for each value
           if (values && values.length > 0) {
               values.forEach(function(value) {
                   $('form').append('<input type="hidden" name="' + fieldName + '" value="' + value + '">');
               });
           }
       }
       
       // Submit the form
       $('form')[0].submit();
   });
   
   
</script>