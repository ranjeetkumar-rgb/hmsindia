<?php  $all_method =&get_instance();
   $appoitmented_date = $_GET['appoitmented_date'];
   
   // Load the model
   $all_method->load->model('embryo_record_discharge_summary_model');
   
   // Handle form submission
   if(isset($_POST['submit'])){
       unset($_POST['submit']);
       
       // Validate form data
       $validation_errors = $all_method->embryo_record_discharge_summary_model->validate($_POST);
       
       if (!empty($validation_errors)) {
           $error_message = implode(', ', $validation_errors);
           $message_type = 'error';
       } else {
           // Save data using model
           $result = $all_method->embryo_record_discharge_summary_model->save($_POST);
           
           if($result['status']){
               $message = $result['message'];
               $message_type = 'success';
           } else {
               $message = $result['message'];
               $message_type = 'error';
           }
       }
       
       // Redirect with message
       if (isset($message)) {
           header("location:" . $_SERVER['HTTP_REFERER'] . "?m=" . base64_encode($message) . '&t=' . base64_encode($message_type));
           die();
       }
   }
   
   // Get existing data using model
   $select_result = $all_method->embryo_record_discharge_summary_model->get_by_iic_id($iic_id, $appoitmented_date);
   
   // Get appointment and patient data
   $sql1 = "Select * from ".$all_method->config->item('db_prefix')."appointments where paitent_id='".$iic_id."'";
   $select_result1 = run_select_query($sql1);
   
   $sql2 = "Select * from ".$all_method->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
   $select_result2 = run_select_query($sql2);
   
   $sql3 = "Select * from ".$all_method->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
   $select_result3 = run_select_query($sql3);
   
   // Display success/error messages
   if(isset($_GET['m']) && isset($_GET['t'])){
       $message = base64_decode($_GET['m']);
       $message_type = base64_decode($_GET['t']);
       
       if($message_type == 'success'){
           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                   <i class="fa fa-check-circle"></i> ' . htmlspecialchars($message) . '
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
       } else {
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <i class="fa fa-exclamation-circle"></i> ' . htmlspecialchars($message) . '
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
       }
   }
?>
<div class="ga-pro">
   <table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
      <tr>
         <td style="width:50%;padding:5px;" colspan="2"><img src="<?php echo base_url(); ?>assets/images/india-ivf-logo.webp"></td>
         <td style="width:50%;padding:5px;" colspan="2">
            <h3 style="margin-top:20px;">Department of Embryology</h3>
            <h4>Embryo Record Discharge Summary</h4>
         </td>
      </tr>
   </table>
   <form action="" enctype='multipart/form-data' method="post" id="embryoRecordForm" onsubmit="return validateForm()">
      <input type="hidden" value="<?php echo $iic_id;?>" class="form" name="iic_id">
      <input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">
      <input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">
      <input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">
      <input type="hidden" value="<?php echo $appoitmented_date; ?>" class="form" name="appoitmented_date">
      <div style="float: left; margin-bottom: 10px;margin-right:20px;">
         <label for="Center">Center <span style="color: red;">*</span></label>
         <select class="form-control" id="center" name="center" required>
            <option value=''>--Select From--</option>
            <?php $all_centers = $all_method->get_all_centers();
               foreach($all_centers as $key => $val){ //var_dump($val);die;
                  if($center == $val['center_number']){
                  echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                  }else{
               echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                  }
                  } 
               ?>
         </select>
      </div>
      <div style="float: left; margin-bottom: 10px;">
         <label for="Admission">Date of Admission <span style="color: red;">*</span></label>
         <input type="date" class="Admission" name="date_of_addmission" value="<?php echo isset($select_result['date_of_addmission'])?$select_result['date_of_addmission']:""; ?>" required>
      </div>
      <div style="float: right; margin-bottom: 10px;">
         <label for="Discharge">Date of Discharge <span style="color: red;">*</span></label>
         <input type="date" class="Discharge" name="date_of_discharge" value="<?php echo isset($select_result['date_of_discharge'])?$select_result['date_of_discharge']:""; ?>" required>
      </div>
      <table width="100%" class="vb45rt">
         <tbody>
            <tr style="background: #b3b9b7;">
               <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
                  <strong>Details of Female Partner</strong>
               </td>
               <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
                  <strong>Details of Male Partner</strong>
               </td>
            </tr>
            <tr style="background: #b3b9b7;">
               <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
                  <strong>UHID : <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></strong>
               </td>
               <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
                  <strong>IIC ID: <?php echo $iic_id; ?></strong>
               </td>
            </tr>
            <tr>
               <td colspan="6" width="50%">
                  <strong>Female Partner : <?php echo $patient_data['wife_name']; ?> </strong>
               </td>
               <td width="50%" colspan="6">
                  <strong>Male Partner : <?php echo $patient_data['husband_name']; ?> </strong>
               </td>
            </tr>
            <tr>
               <td colspan="6" width="50%">
                  <strong>Age: <?php echo $patient_data['wife_age']; ?> Year</strong>
               </td>
               <td width="50%" colspan="6">
                  <strong>Age: <?php echo $patient_data['husband_age']; ?> Year</strong>
               </td>
            </tr>
            <!-- <tr>
               <td colspan="6" width="50%">
                  <strong>Blood Group: <input type="text" name="female_blood_group" value="<?php echo isset($select_result['female_blood_group'])?$select_result['female_blood_group']:""; ?>" style="width:80px;"></strong>
               </td>
               <td width="50%" colspan="6">
                  <strong>Blood Group: <input type="text" name="male_blood_group" value="<?php echo isset($select_result['male_blood_group'])?$select_result['male_blood_group']:""; ?>" style="width:80px;"></strong>
               </td>
            </tr> -->
         </tbody>
      </table>
      <div class="sec2">
         <h3 style="text-align: left; margin-left: 10px;">Embryo Record Details:</h3>
         <table width="100%" class="vb45rt">
            <tbody>
               <tr>
                  <!-- <td colspan="2" width="25%">
                     <label for="procedure">Name of Procedure:</label>
                     <input type="text" name="procedure_name" value="<?php echo isset($select_result['procedure_name'])?$select_result['procedure_name']:""; ?>" style="width:100%;">
                  </td> -->
                  <!-- <td colspan="2" width="25%">
                     <label for="oocytes">No. of oocytes retrieved:</label>
                     <input type="number" name="oocytes_retrieved" value="<?php echo isset($select_result['oocytes_retrieved'])?$select_result['oocytes_retrieved']:""; ?>" style="width:100%;">
                  </td> -->
                  <td colspan="4" width="45%">
                     <label for="fertilization">Fertilization status:</label>
                     <input type="text" name="fertilization_status" value="<?php echo isset($select_result['fertilization_status'])?$select_result['fertilization_status']:""; ?>" style="width:100%;">
                  </td> 
                  <td colspan="4" width="45%">
                     <label for="d2">D2:</label>
                     <input type="text" name="d2_status" value="<?php echo isset($select_result['d2_status'])?$select_result['d2_status']:""; ?>" style="width:100%;">
                  </td>
               </tr>
               <tr>
                  <td colspan="2" width="25%">
                     <label for="d3">D3:</label>
                     <input type="text" name="d3_status" value="<?php echo isset($select_result['d3_status'])?$select_result['d3_status']:""; ?>" style="width:100%;">
                  </td>
                  <td colspan="2" width="25%">
                     <label for="d4">D4:</label>
                     <input type="text" name="d4_status" value="<?php echo isset($select_result['d4_status'])?$select_result['d4_status']:""; ?>" style="width:100%;">
                  </td>
                  <td colspan="2" width="25%">
                     <label for="d5">D5:</label>
                     <input type="text" name="d5_status" value="<?php echo isset($select_result['d5_status'])?$select_result['d5_status']:""; ?>" style="width:100%;">
                  </td>
                  <td colspan="2" width="25%">
                     <label for="d6">D6:</label>
                     <input type="text" name="d6_status" value="<?php echo isset($select_result['d6_status'])?$select_result['d6_status']:""; ?>" style="width:100%;">
                  </td>
               </tr>
               <tr>
                  <!-- <td colspan="4" width="50%">
                     <label for="embryo_status">EMBRYO STATUS:</label>
                     <textarea name="embryo_status" style="width:100%; height:60px!important"><?php echo isset($select_result['embryo_status'])?$select_result['embryo_status']:""; ?></textarea>
                  </td> -->
                  <!-- <td colspan="4" width="50%">
                     <label for="embryo_grading">Embryo number and grading on day of freezing:</label>
                     <textarea name="embryo_grading" style="width:100%; height:60px!important"><?php echo isset($select_result['embryo_grading'])?$select_result['embryo_grading']:""; ?></textarea>
                  </td> -->
               </tr>
               <tr>
                  <td colspan="8" width="100%">
                     <label for="pgt_embryo">Embryo number and grading sent for PGT:</label>
                     <textarea name="pgt_embryo" style="width:100%; height:60px!important"><?php echo isset($select_result['pgt_embryo'])?$select_result['pgt_embryo']:""; ?></textarea>
                  </td>
                  <!-- <td colspan="4" width="50%">
                     <label for="renewal_date">Renewal date of embryo freezing:</label>
                     <input type="date" name="renewal_date" value="<?php echo isset($select_result['renewal_date'])?$select_result['renewal_date']:""; ?>" style="width:100%;">
                  </td> -->
               </tr>
               <tr>
                  <td colspan="8" width="100%">
                     <label for="senior_embryologist">Senior Embryologist:</label>
                     <input type="text" name="senior_embryologist" value="<?php echo isset($select_result['senior_embryologist'])?$select_result['senior_embryologist']:""; ?>" style="width:300px;">
                  </td>
               </tr>
            </tbody>
         </table>
         <!-- <div style="margin:20px 0px; padding:15px; background:#f9f9f9; border-left:4px solid #007cba;">
            <p style="margin:10px 0px; font-weight:bold;">Note: embryo/egg freezing may not survive cryopreservation process, which means on thawing nothing, or lesser quantity will be retrieved.</p>
         </div> -->
         <div style="margin:20px 0px; padding:15px; background:#fff3cd; border-left:4px solid #ffc107;">
            <p style="margin:10px 0px; font-weight:bold;">Please take prescribed medicines / injections only. Don't skip/ stop any medicine on your own unless advised by the doctor.</p>
         </div>
      </div>
      <div style="clear:both; text-align:center; margin-top:30px;">
         <input type="submit" name="submit" value="Save Embryo Record" class="btn btn-primary" style="padding:10px 20px; font-size:16px;">
         <button type="button" onclick="printForm()" class="btn btn-secondary" style="padding:10px 20px; font-size:16px; margin-left:10px;">Print Form</button>
         <!-- <button type="button" onclick="testPrintSection()" class="btn btn-info" style="padding:10px 20px; font-size:16px; margin-left:10px;">Test Print View</button> -->
         <input type="button" value="Print" class="btn btn-success" style="padding:10px 20px; font-size:16px; margin-left:10px;" onclick="printtable();">
      </div>
   </form>
</div>

<!-- Print Section -->
<div class="row" id="print_this_section" style="display:none;">
<div class="ga-pro">
<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
   <tr>
      <td style="width:50%;padding:5px;" colspan="2"><img src="<?php echo base_url(); ?>assets/images/india-ivf-logo.webp"></td>
      <td style="width:50%;padding:5px;" colspan="2">
         <h3 style="margin-top:20px;">Department of Embryology</h3>
         <h4>Embryo Record Discharge Summary</h4>
      </td>
   </tr>
</table>

<!-- Center and Date Information -->
<div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
   <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
      <div style="flex: 1; margin-right: 20px;">
         <strong>Center:</strong> <span class="center-value"><?php echo isset($select_result['center'])?$select_result['center']:""; ?></span>
      </div>
      <div style="flex: 1;">
         <strong>Date of Admission:</strong> <span class="date_of_addmission-value"><?php echo isset($select_result['date_of_addmission'])?$select_result['date_of_addmission']:""; ?></span>
      </div>
   </div>
   <div style="display: flex; justify-content: space-between;">
      <div style="flex: 1; margin-right: 20px;">
         <strong>Date of Discharge:</strong> <span class="date_of_discharge-value"><?php echo isset($select_result['date_of_discharge'])?$select_result['date_of_discharge']:""; ?></span>
      </div>
   </div>
</div>

<table width="100%" class="vb45rt">
   <tbody>
      <tr style="background: #b3b9b7;">
         <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
            <strong>Details of Female Partner</strong>
         </td>
         <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
            <strong>Details of Male Partner</strong>
         </td>
      </tr>
      <tr style="background: #b3b9b7;">
         <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
            <strong>UHID : <span class="center-value"><?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></span></strong>
         </td>
         <td colspan="6" width="50%" style="border:1px solid;padding:5px;">
            <strong>IIC ID: <span class="iic_id-value"><?php echo $iic_id; ?></span></strong>
         </td>
      </tr>
      <tr>
         <td colspan="6" width="50%">
            <strong>Female Partner : <span class="wife_name-value"><?php echo $patient_data['wife_name']; ?> </strong>
         </td>
         <td width="50%" colspan="6">
            <strong>Male Partner : <span class="husband_name-value"><?php echo $patient_data['husband_name']; ?> </strong>
         </td>
      </tr>
      <tr>
         <td colspan="6" width="50%">
            <strong>Age: <span class="wife_age-value"><?php echo $patient_data['wife_age']; ?> Year</strong>
         </td>
         <td width="50%" colspan="6">
            <strong>Age: <span class="husband_age-value"><?php echo $patient_data['husband_age']; ?> Year</strong>
         </td>
      </tr>
      <tr>
         <!-- <td colspan="6" width="50%">
            <strong>Blood Group: <span class="female_blood_group-value"><?php echo isset($select_result['female_blood_group'])?$select_result['female_blood_group']:""; ?></strong>
         </td>
         <td width="50%" colspan="6">
            <strong>Blood Group: <span class="male_blood_group-value"><?php echo isset($select_result['male_blood_group'])?$select_result['male_blood_group']:""; ?></strong>
         </td> -->
      </tr>
   </tbody>
</table>
<div class="sec2">
   <h3 style="text-align: left; margin-left: 10px;">Embryo Record Details:</h3>
   <table width="100%" class="vb45rt">
      <tbody>
         <tr>
            <!-- <td colspan="2" width="25%">
               <strong>Name of Procedure:</strong><br>
               <span class="procedure_name-value"><?php echo isset($select_result['procedure_name'])?$select_result['procedure_name']:""; ?></span>
            </td> -->
            <!-- <td colspan="2" width="25%">
               <strong>No. of oocytes retrieved:</strong><br>
               <span class="oocytes_retrieved-value"><?php echo isset($select_result['oocytes_retrieved'])?$select_result['oocytes_retrieved']:""; ?></span>
            </td> -->
            <td colspan="4" width="45%">
               <strong>Fertilization status:</strong><br>
               <span class="fertilization_status-value"><?php echo isset($select_result['fertilization_status'])?$select_result['fertilization_status']:""; ?></span>
            </td>
            <td colspan="4" width="45%">
               <strong>D2:</strong><br>
               <span class="d2_status-value"><?php echo isset($select_result['d2_status'])?$select_result['d2_status']:""; ?></span>
            </td>
         </tr>
         <tr>
            <td colspan="2" width="25%">
               <strong>D3:</strong><br>
               <span class="d3_status-value"><?php echo isset($select_result['d3_status'])?$select_result['d3_status']:""; ?></span>
            </td>
            <td colspan="2" width="25%">
               <strong>D4:</strong><br>
               <span class="d4_status-value"><?php echo isset($select_result['d4_status'])?$select_result['d4_status']:""; ?></span>
            </td>
            <td colspan="2" width="25%">
               <strong>D5:</strong><br>
               <span class="d5_status-value"><?php echo isset($select_result['d5_status'])?$select_result['d5_status']:""; ?></span>
            </td>
            <td colspan="2" width="25%">
               <strong>D6:</strong><br>
               <span class="d6_status-value"><?php echo isset($select_result['d6_status'])?$select_result['d6_status']:""; ?></span>
            </td>
         </tr>
         <!-- <tr>
            <td colspan="4" width="50%">
               <strong>EMBRYO STATUS:</strong><br>
               <span class="embryo_status-value"><?php echo isset($select_result['embryo_status'])?$select_result['embryo_status']:""; ?></span>
            </td>
            <td colspan="4" width="50%">
               <strong>Embryo number and grading on day of freezing:</strong><br>
               <span class="embryo_grading-value"><?php echo isset($select_result['embryo_grading'])?$select_result['embryo_grading']:""; ?></span>
            </td>
         </tr> -->
         <tr>
            <td colspan="8" width="100%">
               <strong>Embryo number and grading sent for PGT:</strong><br>
               <span class="pgt_embryo-value"><?php echo isset($select_result['pgt_embryo'])?$select_result['pgt_embryo']:""; ?></span>
            </td>
            <!-- <td colspan="4" width="50%">
               <strong>Renewal date of embryo freezing:</strong><br>
               <span class="renewal_date-value"><?php echo isset($select_result['renewal_date'])?$select_result['renewal_date']:""; ?></span>
            </td> -->
         </tr>
         <tr>
            <td colspan="8" width="100%">
               <strong>Senior Embryologist:</strong><br>
               <span class="senior_embryologist-value"><?php echo isset($select_result['senior_embryologist'])?$select_result['senior_embryologist']:""; ?></span>
            </td>
         </tr>
      </tbody>
   </table>
   <!-- <div style="margin:20px 0px; padding:15px; background:#f9f9f9; border-left:4px solid #007cba;">
      <p style="margin:10px 0px; font-weight:bold;">Note: embryo/egg freezing may not survive cryopreservation process, which means on thawing nothing, or lesser quantity will be retrieved.</p>
   </div> -->
   <div style="margin:20px 0px; padding:15px; background:#fff3cd; border-left:4px solid #ffc107;">
      <p style="margin:10px 0px; font-weight:bold;">Please take prescribed medicines / injections only. Don't skip/ stop any medicine on your own unless advised by the doctor.</p>
   </div>
</div>
</div>
<!-- End Print Section -->

<script>
// Auto-hide alert messages after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (alert && alert.parentNode) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(function() {
                    if (alert && alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 500);
            }
        }, 5000);
    });
});

// Form validation function
function validateForm() {
    const center = document.getElementById('center').value;
    const admissionDate = document.querySelector('input[name="date_of_addmission"]').value;
    const dischargeDate = document.querySelector('input[name="date_of_discharge"]').value;
    
    // Check required fields
    if (!center) {
        alert('Please select a center');
        document.getElementById('center').focus();
        return false;
    }
    
    if (!admissionDate) {
        alert('Please select admission date');
        document.querySelector('input[name="date_of_addmission"]').focus();
        return false;
    }
    
    if (!dischargeDate) {
        alert('Please select discharge date');
        document.querySelector('input[name="date_of_discharge"]').focus();
        return false;
    }
    
    // Check if discharge date is after admission date
    if (admissionDate && dischargeDate) {
        const admission = new Date(admissionDate);
        const discharge = new Date(dischargeDate);
        
        if (discharge < admission) {
            alert('Date of discharge cannot be earlier than date of admission');
            document.querySelector('input[name="date_of_discharge"]').focus();
            return false;
        }
    }
    
    // Show confirmation dialog
    return confirm('Are you sure you want to save this embryo record discharge form?');
}

function printForm() {
    try {
        // Get the form data with error handling
        var formData = {};
        var fields = [
            'center', 'date_of_addmission', 'date_of_discharge', 'female_blood_group', 
            'male_blood_group', 'procedure_name', 'oocytes_retrieved', 'fertilization_status',
            'd2_status', 'd3_status', 'd4_status', 'd5_status', 'd6_status',
            'embryo_status', 'embryo_grading', 'pgt_embryo', 'renewal_date', 'senior_embryologist'
        ];
        
        fields.forEach(function(field) {
            var element = document.querySelector('[name="' + field + '"]');
            if (element) {
                formData[field] = element.value || '';
            } else {
                formData[field] = '';
            }
        });
        
        // Update the print section with current form data
        fields.forEach(function(field) {
            var printElement = document.querySelector('#print_this_section .' + field + '-value');
            if (printElement) {
                printElement.textContent = formData[field];
            }
        });
        
        // Hide the form section
        var formSection = document.querySelector('.ga-pro');
        if (formSection) {
            formSection.style.display = 'none';
        }
        
        // Show the print section
        var printSection = document.getElementById('print_this_section');
        if (printSection) {
            printSection.style.display = 'block';
        }
        
        // Use the working print approach from other forms
        var divToPrint = document.getElementById('print_this_section');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.document.close();
        setTimeout(function(){newWin.close();}, 10);
        
        // After printing, hide print section and show form again
        setTimeout(function() {
            if (printSection) {
                printSection.style.display = 'none';
            }
            if (formSection) {
                formSection.style.display = 'block';
            }
        }, 1000);
        
    } catch (error) {
        console.error('Error in printForm:', error);
        alert('Error occurred while printing. Please try again.');
    }
}

function testPrintSection() {
    try {
        // Get the form data with error handling
        var formData = {};
        var fields = [
            'center', 'date_of_addmission', 'date_of_discharge', 'female_blood_group', 
            'male_blood_group', 'procedure_name', 'oocytes_retrieved', 'fertilization_status',
            'd2_status', 'd3_status', 'd4_status', 'd5_status', 'd6_status',
            'embryo_status', 'embryo_grading', 'pgt_embryo', 'renewal_date', 'senior_embryologist'
        ];
        
        fields.forEach(function(field) {
            var element = document.querySelector('[name="' + field + '"]');
            if (element) {
                formData[field] = element.value || '';
            } else {
                formData[field] = '';
            }
        });
        
        // Update the print section with current form data
        fields.forEach(function(field) {
            var printElement = document.querySelector('#print_this_section .' + field + '-value');
            if (printElement) {
                printElement.textContent = formData[field];
            }
        });
        
        // Hide the form section
        var formSection = document.querySelector('.ga-pro');
        if (formSection) {
            formSection.style.display = 'none';
        }
        
        // Show the print section
        var printSection = document.getElementById('print_this_section');
        if (printSection) {
            printSection.style.display = 'block';
        }
        
        // Don't print, just show the print view for testing
        console.log('Print section is now visible. Check if the data is displayed correctly.');
        
    } catch (error) {
        console.error('Error in testPrintSection:', error);
        alert('Error occurred while testing print view. Please try again.');
    }
}

// Simple print function that works like other forms
function printtable() {
    // Hide the form section
    var formSection = document.querySelector('.ga-pro');
    if (formSection) {
        formSection.style.display = 'none';
    }
    
    // Show the print section
    var printSection = document.getElementById('print_this_section');
    if (printSection) {
        printSection.style.display = 'block';
    }
    
    // Use the working print approach from other forms
    var divToPrint = document.getElementById('print_this_section');
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();}, 10);
    
    // After printing, hide print section and show form again
    setTimeout(function() {
        if (printSection) {
            printSection.style.display = 'none';
        }
        if (formSection) {
            formSection.style.display = 'block';
        }
    }, 1000);
}
</script>

<style>
   .ga-pro {
   background: #fff;
   padding: 20px;
   border-radius: 8px;
   box-shadow: 0 2px 10px rgba(0,0,0,0.1);
   margin: 20px 0;
   }
   
   /* Alert Message Styling */
   .alert {
       margin-bottom: 20px;
       padding: 15px 20px;
       border: 1px solid transparent;
       border-radius: 6px;
       font-size: 14px;
       position: relative;
   }
   
   .alert-success {
       color: #155724;
       background-color: #d4edda;
       border-color: #c3e6cb;
   }
   
   .alert-danger {
       color: #721c24;
       background-color: #f8d7da;
       border-color: #f5c6cb;
   }
   
   .alert i {
       margin-right: 8px;
       font-size: 16px;
   }
   
   .btn-close {
       position: absolute;
       top: 10px;
       right: 15px;
       background: none;
       border: none;
       font-size: 18px;
       cursor: pointer;
       color: inherit;
       opacity: 0.7;
   }
   
   .btn-close:hover {
       opacity: 1;
   }
   
   .fg45yu {
   width: 100%;
   border-collapse: collapse;
   margin-bottom: 20px;
   }
   .fg45yu td {
   padding: 10px;
   text-align: center;
   }
   .vb45rt {
   width: 100%;
   border-collapse: collapse;
   margin: 20px 0;
   }
   .vb45rt td {
   border: 1px solid #ddd;
   padding: 8px;
   vertical-align: top;
   }
   .vb45rt tr:nth-child(even) {
   background-color: #f9f9f9;
   }
   .sec2 {
   margin-top: 30px;
   }
   .sec2 h3 {
   color: #333;
   border-bottom: 2px solid #007cba;
   padding-bottom: 10px;
   }
   input[type="text"], input[type="number"], input[type="date"], select, textarea {
   border: 1px solid #ddd;
   border-radius: 4px;
   padding: 8px;
   font-size: 14px;
   }
   input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus, select:focus, textarea:focus {
   border-color: #007cba;
   outline: none;
   box-shadow: 0 0 5px rgba(0,123,186,0.3);
   }
   label {
   font-weight: bold;
   color: #333;
   display: block;
   margin-bottom: 5px;
   }
   .btn-primary {
   background-color: #007cba;
   border-color: #007cba;
   }
   .btn-primary:hover {
   background-color: #005a8b;
   border-color: #005a8b;
   }
   .btn-secondary {
   background-color: #6c757d;
   border-color: #6c757d;
   color: white;
   }
   .btn-secondary:hover {
   background-color: #545b62;
   border-color: #545b62;
   }
   .btn-info {
   background-color: #17a2b8;
   border-color: #17a2b8;
   color: white;
   }
   .btn-info:hover {
   background-color: #138496;
   border-color: #138496;
   }
   .btn-success {
   background-color: #28a745;
   border-color: #28a745;
   color: white;
   }
   .btn-success:hover {
   background-color: #218838;
   border-color: #218838;
   }
   @media print {
   body * {
      visibility: visible;
   }
   #print_this_section {
      display: block !important;
      visibility: visible !important;
   }
   }
</style>