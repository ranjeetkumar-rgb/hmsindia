<?php 	 
if(isset($_POST['submit'])){
	
	  $registration_service_details = array();
	  $priority  = $_POST['priority'];
	  $barcode  = $_POST['barcode'];
	  $patient_id  = $_POST['patient_id'];
	  $wife_name  = $_POST['wife_name'];
	  $last_name  = $_POST['last_name'];
	  $wife_age  = $_POST['wife_age'];
	  $gender  = $_POST['gender'];
	  $receipt_number  = $_POST['receipt_number'];
	  $client  = $_POST['client'];
	  $institution  = $_POST['institution'];
	  $doctor_name  = $_POST['doctor_name'];
	  //$specimen  = "";
	  //$quantity  = $_POST['quantity'];
	  $BranchId = $_POST['BranchId'];
	  $TitleId = $_POST['TitleId'];
	  $CityId = $_POST['CityId'];
	  $investigations  = "";
	  /*if(!empty($_POST['specimen'])){
		  foreach ($_POST['specimen'] as $speciment_data){
			  $specimen = $specimen.", ".$speciment_data;
		  }
	  }*/
	  if(!empty($_POST['investigations'])){
		  foreach ($_POST['investigations'] as $investigations_data){
			 $investigations = $investigations.",".$investigations_data;
			 $data_array = array("ServiceId"=> null,"IntegrationServiceCode"=> $investigations_data);
			$registration_service_details[] = $data_array;			
		  }
	  }
	  
	  	//Insert into hms_investigation_lab table
        echo $query1 = "INSERT INTO `hms_investigation_lab` (priority, barcode, patient_id, wife_name, wife_age, gender, receipt_number, client, institution, doctor_name, investigations, BranchId, date) values ('normal', '$barcode', '$patient_id', '$wife_name $last_name', '$wife_age', '$gender','$receipt_number','$client', 'IN08259', 'Dr Richika Sahay','$investigations','$BranchId','" . date('Y-m-d h:i:s') . "')";	 
             $result1 = run_form_query($query1); 
        if($result1){
	$data_ar_post = '{
		"TitleId": "'.$TitleId.'",
		"Gender": "'.$gender.'",
		"FirstName": "'.$wife_name.'",
		"LastName": "'.$last_name.'",
		"MiddleName": "",
		"EmailId": "webdesign@indiaivf.in",
		"IntegrationOrderId": "'.$receipt_number.'",
		"AgeYYY": "'.$wife_age.'",
		"BirthDate": "",
		"RegistrationServiceDetails": '.json_encode($registration_service_details).',
		"ReceiptRemarks": "INDIAIVF",
		"BranchId": "'.$BranchId.'",
		"CityId": "224",   
		"IsB2B": true,
		"B2BId": "'.$client.'",
		"ManualReferredBy": "Dr. Richika Sahay Shukla",
		"CRMNo": "'.$barcode.'"
		
	}';
	echo '<br/>';
	print_r($data_ar_post);
	echo '<br/>';
	//exit();
	
	$curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://slims.lifecell.in/SLIMS.api/api/public/public/SaveThirdPartyRegistration',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data_ar_post,
	CURLOPT_HTTPHEADER => array(
    'UserId: 11',
    'Password: Mfine@123',
    'Content-Type: application/json'
  ),
));
//die();
$response = curl_exec($curl);
//var_dump($response);
//die;
curl_close($curl);
$result = json_decode($response);
//var_dump($result);
//die;

	if(!empty($result) && $result->IsSuccess == 1){
		$data_list = $result->Success;
		$data = $data_list->Data;
		$all_data = serialize($data);
		$lab_id = $data->LabId;
		$PatientName = $data->PatientName;
		$regitration_date = $data->RegistrationDate;
		$expected_report_date = $data->ExpectedReportDateTime;
		$ReceiptURL = $data->ReceiptURL;
		$ReportFileURL = $data->ReportFileURL;
		
		$query2 = "INSERT INTO `hms_lab_reports` (patient_id,LabId,PatientName, RegistrationDate, ExpectedReportDateTime, ReceiptURL, ReportFileURL, all_data) values ('$patient_id','$lab_id','$PatientName','$regitration_date','$expected_report_date','$ReceiptURL','$ReportFileURL','$all_data')";	 
             $result2 = run_form_query($query2);
		header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Data Sent!').'&t='.base64_encode('success'));
		echo '<pre>';
		print_r($all_data);
		echo '<pre>';
		die();
	}else{
		header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Data Not Sent!').'&t='.base64_encode('error'));
	}
	 // var_dump($response); echo '<br/><br/><br/>';
	  var_dump($response);
	  die;
			
        /* header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Data Sent!').'&t='.base64_encode('success'));
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Data Not Sent!').'&t='.base64_encode('error'));*/
		}
	} 
	//   var_dump($patient_details); echo '<br/><br/><br/>';
	//   var_dump($male_invest_array); echo '<br/><br/><br/>';hms_patient_medical_info
	   //var_dump($result);
	  //die;
?>
<style type="text/css">
table{
    width: 100%;
    margin-bottom: 20px;
	border-collapse: collapse;
}
table, th, td{
    border: 1px solid #cdcdcd;
}
table th, table td{
    padding: 10px;
    text-align: left;
}
select {
        display: block!important;
}
[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
position: absolute;
left: 35px!important;
opacity: 1!important;
}
</style>

  
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Upload investigations results</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
         <div class="row">
		  <div class="form-group col-sm-4 col-xs-6">
            <label for="item_name">IIC ID / UHID </label>
            <p><input type="text" name="patient_id" value=""  />  </p>
          </div>
		   <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">TitleId</label>
            <p> <select class="" id="TitleId" name="TitleId">
					<option value=""> - - - Select Center - - - </option>
					<option value="3">Mr</option>
					<option value="4">Mrs</option>
							
			</select>
			
			</p>
          </div>
          <div class="form-group col-sm-4 col-xs-6">
            <label for="item_name">First Name </label>
            <p> <input type="text" name="wife_name" /></p>
		  </div>
		  <div class="form-group col-sm-4 col-xs-6">
            <label for="item_name">Last Name </label>
            <p> <input type="text" name="last_name" /></p>
		  </div>
		  <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Age</label>
            <p> <input type="text" name="wife_age" value="<?php echo $patient_details['wife_age']; ?>" /></p>
          </div>
		  <div class="form-group col-sm-4 col-xs-12" style="margin-bottom: 50px;">
            <label for="item_name"  >Gender</label>
            <p> <select name="gender" required>
			<option value="M">Male</option>
			<option value="F">Female</option>
			</select>
			</p>
          </div>
           <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Bar Code</label>
            <p> <input type="text" name="barcode" /></p>
          </div>
		  
		   
		  
		  <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Receipt Number</label>
            <p> <input type="text" name="receipt_number" value="" /></p>
          </div>
		  
		   <!--<div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Specimen Type</label>
			 <p> <select class="multidselect_dropdown_1" multiple id="specimen" name="specimen[]">
										<option value="(S1)FFPE Block">(S1)FFPE Block</option>
			<option value="(S2) Whole Blood EDTA / ACD / Fluoride / Heparin / Sodium Citrate">(S2) Whole Blood EDTA / ACD / Fluoride / Heparin / Sodium Citrate</option>
			<option value="(S3)Urin  1st orning / Random Urin / 24 hrs Urine">(S3)Urin  1st orning / Random Urin / 24 hrs Urine</option>
			<option value="(S4)Biopsy Small / Medium / Larg / Radical">(S4)Biopsy Small / Medium / Larg / Radical</option>
			<option value="(S5)Cervical Scraping">(S5)Cervical Scraping</option>
			<option value="(S6)3-4 ml Bone Marrow / Peripheral Blood in EDTA">(S6)3-4 ml Bone Marrow / Peripheral Blood in EDTA</option>
			<option value="(S7)3-4 ml Bone Marrow / Peripheral Blood in Sodium Heparin Tube">(S7)3-4 ml Bone Marrow / Peripheral Blood in Sodium Heparin Tube</option>
			<option value="S8)10% Neutralised Buffered Formali">(S8)10% Neutralised Buffered Formali</option>
			<option value="(S9)7-10 ml Maternal Blood">(S9)7-10 ml Maternal Blood</option>
			<option value="(S10)Buccal Swab">(S10)Buccal Swab</option>
			<option value="(S11)Stained Histopathology Slides">(S11)Stained Histopathology Slides</option>
			<option value="(S12)Body Fluids">(S12)Body Fluids</option>
			<option value="(S13)Aspirate Material">(S13)Aspirate Material</option>
			<option value="(S14)Plasma EDTA / Fluorude / Citrate">(S14)Plasma EDTA / Fluorude / Citrate</option>
			<option value="(S15)10% Buffered Formalin / Salie / Michel's media / Glutaraldehyde">(S15)10% Buffered Formalin / Salie / Michel's media / Glutaraldehyde</option>
			<option value="(S16)Bone Marrow Aspirate and Smear">(S16)Bone Marrow Aspirate and Smear</option>
			<option value="(S17)Bone Marrow Biopsy">(S17)Bone Marrow Biopsy</option>
			<option value="(S18)Bone Marrow Aspirate / Biopsy">(S18)Bone Marrow Aspirate / Biopsy</option>
			<option value="(S19)2 ml Serum from SST Tube">(S19)2 ml Serum from SST Tube </option>
			<option value="(S20)Fine Needle Aspirae">(S20)Fine Needle Aspirae</option>
			<option value="(S21)Sputum">(S21)Sputum</option>
			<option value="(S22)Stool">(S22)Stool</option>
			<option value="(S23)Bronchoalveolar Lavage (BAL)">(S23)Bronchoalveolar Lavage (BAL)</option>
			<option value="(S24)Other">(S24)Other</option>	
			</select>
			
			</p>
           
          </div>-->
		   <div class="form-group col-sm-4 col-xs-12" >
            <label for="item_name"  >Investigations Name</label>
            <p> <select class="multidselect_dropdown_1" multiple id="investigations" name="investigations[]">
										<?php $sql1 = "select * from hms_investigation where status='1'"; 
                    $query = $this->db->query($sql1);
                    $select_result1 = $query->result();  ?>
					 <?php
                     foreach ($select_result1 as $res_val){
                     ?>
					<option value="<?php echo $res_val->code ?>"><?php echo $res_val->investigation ?></option>
					 <?php } ?>			
			</select>
			
			</p>
          </div>
		  
		   <!--<div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Specimen quantity</label>
            <p> <input type="text" name="quantity" value="" /></p>
          </div>-->
		   <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">B2bName</label>
            <p> <select class="client" id="client" name="client">
					<option value=""> - - - Select Center - - - </option>
					<option value="11454">Green Park</option>
					<option value="3283">Noida</option>
					<option value="11455">Gurgaon</option>
							
			</select>
			
			</p>
          </div>
		  <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">BranchName</label>
            <p> <select class="BranchId" id="BranchId" name="BranchId">
					<option value=""> - - - Select Center - - - </option>
					<option value="174">Zenith Molecular Lab</option>
					<option value="296">Micron laboratory South Delhi</option>
					<option value="2">Gurgaon</option>
			</select>
			</p>
          </div>
		  <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Center City</label>
            <p> <select class="CityId" id="CityId" name="CityId">
					<option value=""> - - - Select City - - - </option>
					<option value="224">NOIDA</option>
					<option value="365">DELHI</option>
					<option value="614">Gurugram</option>
			</select>
			</p>
          </div>
		</div> 
		
      </div>
      <div class="clearfix"></div>
          <div class="form-group col-sm-12 col-xs-12">
            <input type="submit" id="submit" name="submit" class="btn btn-large" value="Submit" />
          </div>
      </p>
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

$(function() {
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