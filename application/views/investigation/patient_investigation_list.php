 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Investigation List</h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'investigation/patient_investigation_list'; ?>" method="get">
		     
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
              <label>IIC ID</label>
              <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
              <label>Patient Name</label>
              <input type="text" class="form-control" id="patientName" name="patientName" value="<?php echo $patientName;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'investigation/patient_investigation_list'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>  
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
              <thead>
                <tr>
				  <th>S.No.</th>
				  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Lab Id</th>
                  <th>Registration Date</th>
                  <th>Expected Report Date</th>
				  <th>Status</th>
				  <th>Receipt URL</th>
				  <th>Report File URL</th>
                </tr>
              </thead>
              <tbody id="investigation_result">
              <?php 
			  $count=1; 
			  foreach($investigation_result as $ky => $vl){
               ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><?php echo $vl['patient_id']; ?></td>
				  <td><?php echo $vl['PatientName']; ?></td>
				  <td><?php echo $vl['LabId']?></td>
				  <td><?php echo $vl['RegistrationDate']?></td>
                  <td><?php echo $vl['ExpectedReportDateTime']?></td>
				  <td> <?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $vl['ReportFileURL'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));
$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);
// Check if the decoding was successful and the "Message" field exists
if (isset($data['Error']['Message'])) {
    // Extract the "Message" field
    $message = $data['Error']['Message'];
    // Output the message
    echo $message;
} else {
    // Handle the case where the "Message" field doesn't exist or decoding fails
    echo "Report is ready.";
}
?></td>
				  <td><a href="<?php echo $vl['ReceiptURL']?>" target="_blank" class="btn btn-secondary">Download Receipt</a></td>
				  <td><a href="<?php echo $vl['ReportFileURL']?>" target="_blank" class="btn btn-secondary">Download Reports</a></td>
                </tr>
              <?php $count++;} ?>
              <tr>
                <td colspan="11">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>			  
            </table>
          </div>
        </div>
      </div>
     </div>
	    
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
.form-control#billing_at{
  height: 40px!important;
  border: 1px solid #9e9e9e!important;
}
</style>