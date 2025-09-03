<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $ID = $_GET['ID'];

  /*  // Update Appointment Safely
    $update_data = array(
        'wife_name' => $_POST['wife_name'],
        'husband_name' => $_POST['husband_name'],
		 'wife_phone' => $_POST['wife_phone'],
        'appoitment_for' => $_POST['appoitment_for'],
        'appoitmented_doctor' => $_POST['appoitmented_doctor'],
        'appoitmented_date' => $_POST['appoitmented_date'],
        'appoitmented_slot' => $_POST['appoitmented_slot']
    );

    $this->db->where('ID', $ID);
    $query2 = $this->db->update('hms_appointments', $update_data);
    
    // Check if update was successful
    $num = (int) $query2;

    // Log appointment creation
    $log_data = "\n" . date("d-m-Y H:i:s") . "-------------" . json_encode($update_data) . "\n";
    file_put_contents('app_data.txt', $log_data, FILE_APPEND);

    if ($update_data > 0) {
        $check_patient = get_patient_by_number($_POST['mobile']);

        if (!empty($check_patient)) {
            $log_data = "\n" . date('d-m-Y H:i:s') . "======Patient Exists======" . "\n";
            file_put_contents('app_data.txt', $log_data, FILE_APPEND);
            
            $check_patient_register = get_patient_detail($check_patient['patient_id']);
            
            if (!empty($check_patient_register) && $check_patient_register['whats_registers'] == 0) {
                $centre_details = get_centre_details($_POST['appoitment_for']);
                whatsappregister(
                    $update_data['wife_phone'], 
                    json_encode(array(
                        "name" => $update_data['wife_name'], 
                        "center" => $centre_details['center_name']
                    ))
                );

                $this->db->update('hms_patients', array('whats_registers' => 1));
            }
        } else {
            $log_data = "\n" . date('d-m-Y H:i:s') . "======New Patient======" . "\n";
            file_put_contents('app_data.txt', $log_data, FILE_APPEND);
            
            whatsappregister($update_data['wife_phone'], json_encode(array(
                "name" => $update_data['wife_name']
            )));
        }

        // Appointment Confirmation
        $centre_details = get_centre_details($_POST['appoitment_for']);
        
        whatsappappointment(
            $update_data['wife_phone'], 
            $update_data['wife_name'],
            $centre_details['center_name'],
            date("d-m-Y", strtotime($update_data['appoitmented_date'])),
            $update_data['appoitmented_slot'],
            isset($centre_details['center_location']) ? $centre_details['center_location'] : ""
        );

        //echo json_encode(array('status' => 1, 'message' => 'Appointment has been booked!'));
        //exit;
		$_SESSION['message'] = "Appointment has been Reschedule successfully!";
        header("Location: https://indiaivf.website/accounts/patient_update?ID=" . urlencode($ID));
        exit;
		
    } else {
        $_SESSION['message'] = "Appointment Reschedule failed!";
        header("Location: https://indiaivf.website/accounts/patient_update?ID=" . urlencode($ID));
        exit;
    }*/
	
$session_user = $this->session->userdata('logged_billing_manager');

if (!$session_user) {
    echo json_encode(['status' => 'unauthorized', 'message' => 'User session not found.']);
    exit;
}

// Update appointment DB record
$update_data = [
    'wife_name'           => $this->input->post('wife_name', true),
    'husband_name'        => $this->input->post('husband_name', true),
    'wife_phone'          => $this->input->post('wife_phone', true),
    'appoitment_for'      => $this->input->post('appoitment_for', true),
    'appoitmented_doctor' => $this->input->post('appoitmented_doctor', true),
    'appoitmented_date'   => $this->input->post('appoitmented_date', true),
    'appoitmented_slot'   => $this->input->post('appoitmented_slot', true),
	'status'   			  => $this->input->post('status', true)
];

$appointment_id = $this->input->post('appointment_id', true) ?? $_GET['ID'];
//$appointment_status = $this->input->post('appointment_status', true);
$ID = $appointment_id; // Assuming both are same

$this->db->where('ID', $ID);
$query2 = $this->db->update('hms_appointments', $update_data);
$num = (int) $query2;

// Logging
file_put_contents('app_data.txt', "\n" . date("d-m-Y H:i:s") . "-------------" . json_encode($update_data) . "\n", FILE_APPEND);

if ($num > 0) {
	
	//var_dump($appointment_status, $appointment_id); die();
	//$status = $this->appointment_model->appointment_status($appointment_status, $appointment_id);

	
    //if ($status > 0) {
        // Get full appointment info
       $query = $this->db->query("SELECT * FROM hms_appointments WHERE ID='".$appointment_id."' LIMIT 1");
        $appointment = $query->row();
		


        if ($appointment) {
            $url = "https://flertility.in/appointment/hms-appointment-status/?accessKey=AKIA3OFKVR3DZWGD7HSGKTER001";

	

            $data = [
                'patient_id'        => $appointment->paitent_id,
                'appointment_id'    => $appointment_id,
                'appointment_status'=> 'rescheduled',
                'patient_mobile'    => $appointment->wife_phone,
                'appoitment_for'    => $appointment->appoitment_for,
				'hms_username'      => $session_user['username'],
                'hms_employee_id'   => $session_user['employee_number'],
                'hms_employee_name' => $session_user['name'],
            ];
			
//				echo "<pre>";
//print_r($data); // or var_dump($appointment);
//echo "</pre>";
//exit; // 

           // cURL API call
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Optional: timeout and SSL
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute and store response
$response = curl_exec($ch);

// Get HTTP status code
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close cURL
curl_close($ch);

// Display response and status
//echo "<pre>";
//echo "Response Code: " . $http_code . "\n";
//print_r($response);die();
//echo "</pre>";

 
        }
	

        // Check if patient exists
        $check_patient = get_patient_by_number($update_data['wife_phone']);
        if (!empty($check_patient)) {
            file_put_contents('app_data.txt', "\n" . date('d-m-Y H:i:s') . "======Patient Exists======\n", FILE_APPEND);
           $check_patient_register = get_patient_detail($check_patient); // if it's just the ID


            if (!empty($check_patient_register) && $check_patient_register['whats_registers'] == 0) {
                $centre_details = get_centre_details($update_data['appoitment_for']);
                whatsappregister($update_data['wife_phone'], json_encode([
                    "name"   => $update_data['wife_name'],
                    "center"=> $centre_details['center_name']
                ]));

                $this->db->update('hms_patients', ['whats_registers' => 1]);
            }
        } else {
            file_put_contents('app_data.txt', "\n" . date('d-m-Y H:i:s') . "======New Patient======\n", FILE_APPEND);
            whatsappregister($update_data['wife_phone'], json_encode([
                "name" => $update_data['wife_name']
            ]));
        }

        // WhatsApp appointment confirmation
        $centre_details = get_centre_details($update_data['appoitment_for']);
        whatsappappointment(
            $update_data['wife_phone'],
            $update_data['wife_name'],
            $centre_details['center_name'],
            date("d-m-Y", strtotime($update_data['appoitmented_date'])),
            $update_data['appoitmented_slot'],
            $centre_details['center_location'] ?? ""
        );

        $_SESSION['message'] = "Appointment has been Reschedule successfully!";
    } else {
        $_SESSION['message'] = "Appointment Status Update failed!";
    // }
} 

header("Location: https://indiaivf.website/accounts/patient_update?ID=" . urlencode($ID));
exit;
	
}

    $ID = $_GET['ID'];
	$sql1 = "SELECT * FROM hms_appointments WHERE ID='$ID'";
	$query = $this->db->query($sql1);
    $select_result1 = $query->result(); 
         foreach ($select_result1 as $res_val){      

?>
<div class="page-wrapper">
<form class="col-sm-12 col-xs-12" action="" enctype='multipart/form-data' method="post">
<div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Reschedule Appointments</h3>
      </div>
	  <?php if(isset($_SESSION['message'])): ?>
        <p style="color: green; font-weight: bold;"><?php echo $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); // Clear message after displaying ?>
    <?php endif; ?>
      <div class="panel-body profile-edit">
	  
	  <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Wife Name" id="wife_name" value="<?php echo $res_val->wife_name; ?>" name="wife_name" type="text" class="form-control">
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Husband Name" name="husband_name" id="husband_name" value="<?php echo $res_val->husband_name; ?>" type="text" class="form-control">
          </div>
		  <?php $sql3 = "SELECT * FROM `hms_centers` WHERE center_number='$res_val->appoitment_for'";
				$select_result3 = run_select_query($sql3); 
				?>		 
		<div class="form-group col-sm-6 col-xs-12">
          <select name="appoitment_for" name="appoitment_for" style="display: block;">
			<option value="<?php echo $select_result3['center_number']; ?>"> <?php  echo $select_result3['center_name'];  ?></option>
			<?php 
            $sql2 = "SELECT * FROM hms_centers WHERE status='1'";
            $query = $this->db->query($sql2);
            $select_result2 = $query->result(); 

            foreach ($select_result2 as $res_val2) { 
        ?>  
            <option value="<?php echo $res_val2->center_number; ?>"> <?php echo $res_val2->center_name; ?></option>
        <?php } ?>  
		</select>
			</div>

		   <?php 
			$sql2 = "SELECT * FROM hms_doctors WHERE ID='$res_val->appoitmented_doctor'";
			$select_result5 = run_select_query($sql2);
			?>		 
		  <div class="form-group col-sm-6 col-xs-12">
            <select name="appoitmented_doctor" id="appoitmented_doctor" style="display:block!important;">
				<option value="<?php echo $select_result5['ID']; ?>"> <?php  echo $select_result5['name'];  ?></option>
				<?php 
            $sql6 = "SELECT * FROM hms_doctors WHERE status='1'";
            $query = $this->db->query($sql6);
            $select_result6 = $query->result(); 

            foreach ($select_result6 as $res_val6) { 
        ?>  
            <option value="<?php echo $res_val6->ID; ?>"> <?php echo $res_val6->name; ?></option>
        <?php } ?> 
			</select>
	     </div>
		 
		  </div>
		  <div class="row">
		   <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Appoitmented Date" id="appoitmented_date" value="<?php echo $res_val->appoitmented_date; ?>" name="appoitmented_date" type="text" class="particular_date_filter form-control">
          
		  </div>
         <div class="form-group col-sm-6 col-xs-12">
		 <select name="appoitmented_slot" class="empty-field" id="appoitmented_slot" required="" style="display:block!important;" >
		 <option value=""><?php echo $res_val->appoitmented_slot; ?></option>
		 </select>
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
		 <input type="hidden" name="wife_phone" value="<?php echo $res_val->wife_phone; ?>" class="empty-field" id="wife_phone" required="">
		
          </div>
		   <div class="form-group col-sm-6 col-xs-12">
		   <select name="status" id="status" style="display:block!important;">
				<option value=""> ----Select---</option>
				<option value="in_clinic"> in_clinic</option>
				<option value="cancelled"> Cancelled</option>
                <option value="rescheduled"> Rescheduled</option>
        	</select>
			 </div>
          </div>
		 
<input type="submit" name="submit" value="submit"> 
</div>  
</div>
</div>  
</div>  
</form>
</div>
 <?php } ?>
 <script type="text/javascript">
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
						$('div.appoitmented_slot').show();
						$('#loader_div').hide();
					}
				});
			}
		});
} );

function search_patient(data){
	$('#patient_nationality').hide();
	$.ajax({
		url: '<?php echo base_url('billingcontroller/search_appointment')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			if(data.status == 0){  $('#msg_area').append(data.message); }
			if(data.status == 'appointment_booked'){
				$('#msg_area').empty().append(data.message);
			}
			if(data.status == 'new_patient'){
				$('div.paitent_id_div').hide();
				$('#paitent_type').val(data.status);
				$('#msg_area').append(data.message);
				$('#wife_phone').attr("readonly", true);
				$('#wife_phone').val($('#phone_number').val());
				$('#wife_email').empty().val("");				
				$('#patient_nationality').show();
				$('#nationality').attr("required", true);
				$('#add_section').show();
			}			
			if(data.status == 'exist_patient'){
				 //patient details
				 //WIFE
				 $('#paitent_type').val(data.status);
				 $('#msg_area').append(data.message);
				 $('#paitent_id').val(data.uhid);
				 $('div.paitent_id_div').show();
				 $('#wife_name').val(data.patient.wife_name);
				 $('#wife_phone').val(data.patient.wife_phone);
				 $('#wife_email').val(data.patient.wife_email);
				 $('#nationality [value='+data.patient.nationality+']').attr('selected', 'true');
				 $('.img_show').show();
				 $('#submitbutton').show();
				 $('#add_section').show();
			 }
			$('#loader_div').hide();
		} 
  });
}
</script>
<style>
select#center {
    display: block!important;
}
input[type=checkbox], input[type=radio] {
    opacity: 1 !important;
    left: 0 !important;
    position: unset !important;
    margin: 9px !important;
}
.sec3 td {
    text-align: left;
}
.sec2 {
    border: 1px solid #000;
}
.sec2 p {
    margin: 0px;
    padding: 2px 10px;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td {
  border: 1px solid #000;
  text-align: center;
  padding: 5px; 
}
.ga-pro h3 {
      text-align: center;
    font-size: 25px;
}
form {
    padding-left: 10px;
    margin-bottom: 4px;
}
.nb56ty input {
    width: 100%;
}
.vb45rt td {
	text-align: left; 
	padding-left: 10px;
}
</style>    