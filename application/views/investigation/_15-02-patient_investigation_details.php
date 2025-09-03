<?php 	 
if(isset($_POST['submit'])){
	// echo '<pre>';
	// print_r($_POST);
	//  echo '</pre>';
	//  die();
	  //$investigations = serialize($investigation_details['investigations']);
	
	  $priority  = $_POST['priority'];
	  $barcode  = $_POST['barcode'];
	  $patient_id  = $_POST['patient_id'];
	  $wife_name  = $_POST['wife_name'];
	  $wife_age  = $_POST['wife_age'];
	  $gender  = $_POST['gender'];
	  $receipt_number  = $_POST['receipt_number'];
	  $client  = $_POST['client'];
	  $institution  = $_POST['institution'];
	  $doctor_name  = $_POST['doctor_name'];
	  $specimen  = "";
	  $quantity  = $_POST['quantity'];
	  $investigations  = "";
	  if(!empty($_POST['specimen'])){
		  foreach ($_POST['specimen'] as $speciment_data){
			  $specimen = $specimen.", ".$speciment_data;
		  }
	  }
	  if(!empty($_POST['investigations'])){
		  foreach ($_POST['investigations'] as $investigations_data){
			  $investigations = $investigations.", ".$investigations_data;
		  }
	  }
	  
	  	//Insert into hms_investigation_lab table
         echo $query1 = "INSERT INTO `hms_investigation_lab` (priority, barcode, patient_id, wife_name, wife_age, gender, receipt_number, client, institution, doctor_name, specimen, investigations, quantity, date) values ('normal', '$barcode', '$patient_id', '$wife_name', '$wife_age', '$gender','$receipt_number','CL02142', 'IN08259', 'Dr Richika Sahay','$specimen','$investigations','$quantity','" . date('Y-m-d h:i:s') . "')";	 
            $result1 = run_form_query($query1); 
        if($result1){
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://lims-test.corediagnostics.in/api/collection/create-collection',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array(
			   "priority" => "normal",
	           "barcode" => $barcode,
	           "pod_number" => $patient_id,
	           "first_name" => $wife_name,
	           "last_name" => "NA",
	           "age" => $wife_age,
	           "gender" => $gender,
			   "uid_number" => $receipt_number,
	           "client" => "CL02142",
	           "institution" => "IN08259",
	           "physician_name" => "Dr Richika Sahay",
	           "specimen[0][specimen_name]" => $specimen,
	           "specimen[0][quantity]" => $quantity,
	           "test[]" => $investigations,
			   "api_key" => "GJ9jOG1w7T6QnbF9SDIqM43C5dTvnVs1jBoF6J2Z2gEh4peyDgz2sCcnLKXI7mCC",
			),
			));

			$response = curl_exec($curl);
		

			curl_close($curl);
			echo $response;
			
			 echo '<pre>';
	 print_r($response);
	  echo '</pre>';
	  die();
		
	 // var_dump($response); echo '<br/><br/><br/>';
	 // var_dump($response);die;
			
         header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Data Sent!').'&t='.base64_encode('success'));
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Data Sent!').'&t='.base64_encode('error'));
		}
	} 
	//   var_dump($patient_details); echo '<br/><br/><br/>';
	//   var_dump($male_invest_array); echo '<br/><br/><br/>';hms_patient_medical_info
	 //  var_dump($result1);die;
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
		<div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Patient IIC ID </label>
            <p><input type="text" name="patient_id" value=""  />  </p>
          </div>
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Patient Name </label>
            <p> <input type="text" name="wife_name" /></p>
		  </div>
           <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Bar Code</label>
            <p> <input type="text" name="barcode" /></p>
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Age</label>
            <p> <input type="text" name="wife_age" value="<?php echo $patient_details['wife_age']; ?>" /></p>
          </div>
		  
		  
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name"  >Gender</label>
            <p> <select name="gender">
			<option >--- Select --- </option>
			<option value="m">Male</option>
			<option value="f">Female</option>
			</select>
			</p>
          </div>
		  
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Receipt Number</label>
            <p> <input type="text" name="receipt_number" value="" /></p>
          </div>
		  
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Specimen Type</label>
            <p> <select name="specimen[]" multiple>
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
          </div>
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name"  >Test Name</label>
            <p> <select name="investigations[]" multiple>
			<?php  echo $sql1 = "select * from hms_investigation"; 
                    $query = $this->db->query($sql1);
                    $select_result1 = $query->result();  ?>
					 <?php
                     foreach ($select_result1 as $res_val){
                     ?>
					<option value="<?php echo $res_val->investigation ?>"><?php echo $res_val->code ?><?php echo $res_val->investigation ?></option>
					 <?php } ?>			
			</select>
			</p>
          </div>
		  
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Specimen quantity</label>
            <p> <input type="text" name="quantity" value="" /></p>
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
