<?php $all_method =&get_instance();
	  $investigations = unserialize($investigation_details['investigations']);
	  $patient_details = get_patient_detail($investigation_details['patient_id']);
    
      
	  $male_invest_array = $female_invest_array = array();
	  if(!empty($investigations)){
	      if(isset($investigations['male_investigation']) && !empty($investigations['male_investigation'])){
        	  foreach($investigations['male_investigation'] as $key => $val){
        		$male_invest_array[] = $val['male_investigation_name'];
        	  }
	      }
	      if(isset($investigations['female_investigation']) && !empty($investigations['female_investigation'])){
        	  foreach($investigations['female_investigation'] as $key => $val){
        		$female_invest_array[] = $val['female_investigation_name'];
        	  }
	      }
	  }
	//   var_dump($patient_details); echo '<br/><br/><br/>';
	//   var_dump($male_invest_array); echo '<br/><br/><br/>';
	//   var_dump($female_invest_array);die;
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
</style>
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="action" value="add_investigation_result" />
  <input type="hidden" name="patient_id" value="<?php echo $patient_details['patient_id']; ?>" />
  <input type="hidden" name="receipt_number" value="<?php echo $receipt_number; ?>" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Upload investigations results</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Patient Name (Required)</label>
            <h4><?php echo $patient_details['wife_name']; ?></h4>
		  </div>

		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Patient Phone (Required)</label>
            <h4>  <?php echo sting_masking($patient_details['wife_phone']);?></h4>
          </div>
		</div> 
		
		<div class="row">
		<?php if(!empty($medicines)){?>
          <h3>Medicine details</h3>
          <hr />
          <?php 
             $medicines = unserialize($medicines['medicines']);
             if(!empty($medicines['male_medicine'])){ 
          ?>  
            <h4>Male Medicine</h4>
              <table style="width:100%">
                    <tr>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Medicine</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">MRP</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Dose/Day</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Day</th>
                    </tr>
                    <?php $total_fees = 0;
                    foreach($medicines['male_medicine'] as $key => $val){
                      $medicine_details = $all_method->get_medicine_name($val['male_med_name']);//var_dump($medicine_details);die; 
                    ?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['item_name']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['company']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_brand_name($medicine_details['brand_name']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_unit_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_dose']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_for']?></td>
                    </tr>
                    <?php $total_fees += $val['male_med_price']; } ?>
              </table>
            <?php }
             if(!empty($medicines['female_medicine'])){ ?>
              <h4>Female Medicine</h4>
              <table style="width:100%">
                    <tr>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Medicine</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">MRP</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Dose/Day</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Day</th>
                    </tr>
                    <?php $total_fees = 0;
                    foreach($medicines['female_medicine'] as $key => $val){//var_dump($val);die; 
                      $medicine_details = $all_method->get_medicine_name($val['female_med_name']);//var_dump($medicine_details);die; 
                    ?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['item_name']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['company']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_brand_name($medicine_details['brand_name']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_unit_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_dose']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_for']?></td>
                    </tr>
                    <?php $total_fees += $val['female_med_price']; } ?>
              </table>
            <?php } ?>
	<?php } ?>
	<hr/>
          <div class="form-group col-sm-12 col-xs-12">
            <table>
				<thead>
					<th>Male Investigation</th>
					<th>Upload Result</th>
					<th>Doctor approval</th>
				</thead>
	  			<tbody>
					<?php foreach($male_invest_array as $key => $val){
							 $investigation_details = $all_method->get_investigation_details($val);
							 $check_report = $all_method->check_investigation_report($val, $patient_details['patient_id'], $receipt_number, 'male');
							// var_dump($check_report);die; ?>
							<tr class="male_invest">
								<td>
									<?php echo $investigation_details['investigation']; ?> (<?php echo $investigation_details['code']; ?>)
								</td>
								<td>
									<?php if(!empty($check_report)){?>
									<?php if($check_report['doctor_accepted'] == 'approved'){
										echo 'Report approved';
									}else{ 
										if($check_report['status'] == 'pending'){?>
											<input type="file" accept="image/png, image/jpeg, .pdf"  class="form-control" name="investigation_result[][<?php echo 'male_'.$val; ?>]" />
										<?php }else{ ?>
											<a href="<?php echo $check_report['report']; ?>" target="_blank">Download Report</a>
											<p>Uploaded (<?php echo $check_report['uploaded_date']?>)</p>
									<?php } } ?>
									<?php }else{ ?>
										<input type="file" accept="image/png, image/jpeg, .pdf"  class="form-control" name="investigation_result[][<?php echo 'male_'.$val; ?>]" />
									<?php } ?>
								</td>
								<td>
									<?php if(!empty($check_report)){?>
										<?php echo ucwords($check_report['doctor_accepted']); ?>
										<?php if($check_report['doctor_accepted'] == 'disapproved'){?> 
											<i class="fa fa-info-circle fa-lg" title="<?php echo $check_report['status_reason']; ?>" aria-hidden="true"></i>
										<?php } ?>
									<?php }else{echo "Pending";} ?>
								</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>

			<table>
				<thead>
					<th>Female Investigation</th>
					<th>Upload Result</th>
					<th>Doctor approval</th>
				</thead>
	  			<tbody>
					<?php foreach($female_invest_array as $key => $val){
							 $investigation_details = $all_method->get_investigation_details($val);
							 $check_report = $all_method->check_investigation_report($val, $patient_details['patient_id'], $receipt_number, 'female');
							 //var_dump($check_report);die; ?>
							<tr class="male_invest">
								<td>
									<?php echo $investigation_details['investigation']; ?> (<?php echo $investigation_details['code']; ?>)
								</td>
								<td>
									<?php if(!empty($check_report)){?>
									<?php if($check_report['doctor_accepted'] == 'approved'){
										echo 'Report approved';
									}else{ 
										if($check_report['status'] == 'pending'){ ?>
											<input type="file" accept="image/png, image/jpeg, .pdf"  class="form-control" name="investigation_result[][<?php echo 'female_'.$val; ?>]" />
										<?php }else{ ?>
											<a href="<?php echo $check_report['report']; ?>" target="_blank">Download Report</a>
											<p>Uploaded (<?php echo $check_report['uploaded_date']?>)</p>
									<?php } } ?>
									<?php }else{ ?>
										<input type="file" accept="image/png, image/jpeg, .pdf"  class="form-control" name="investigation_result[][<?php echo 'female_'.$val; ?>]" />
									<?php } ?>
								</td>
								<td>
									<?php if(!empty($check_report)){?>
										<?php echo ucwords($check_report['doctor_accepted']); ?>
										<?php if($check_report['doctor_accepted'] == 'disapproved'){?> 
											<i class="fa fa-info-circle fa-lg" title="<?php echo $check_report['status_reason']; ?>" aria-hidden="true"></i>
										<?php } ?>
									<?php }else{echo "Pending";} ?>
								</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		  </div>
		</div> 
		
      </div>
      <div class="clearfix"></div>
        <?php if(!empty($investigations) || !empty($medicines)){ ?>
          <div class="form-group col-sm-12 col-xs-12">
            <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />
          </div>
        <?php } ?>
        
      </p>
    </div>
  </div>
</form>