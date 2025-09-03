 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
       <!--Consultation  Tables -->
    	  <div class="card">
        <div class="card-action"><h3> Consultation Patients </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>On Date</th>
                  <th>Receipt Number</th>
                  <th>Fees</th>
                  <th>Payment Method</th>
                  <th>Billing From</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $count=1; foreach($consultation_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  $patient_name; ?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo $vl['receipt_number']?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['fees']?></td>
                  <td><?php echo strtoupper($vl['payment_method']); ?></td>
                  <td><?php echo $vl['billing_from']?></td>
                  <td><a href="#" class="edit">Details</a></td>
                </tr>
              <?php $count++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
       <!--End Consultation  Tables -->
       
       <!--Investigation Tables -->
    	  <div class="card">
        <div class="card-action"><h3> Investigation Patients </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>On Date</th>
                  <th>Receipt Number</th>
                  <th>Fees</th>
                  <th>Payment Method</th>
                  <th>Billing From</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $count=1; foreach($investigate_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php echo $vl['patient_id']?></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  $patient_name; ?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo $vl['receipt_number']?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['fees']?></td>
                  <td><?php echo strtoupper($vl['payment_method']); ?></td>
                  <td><?php echo $vl['billing_from']?></td>
                  <td><a href="#" class="edit">Details</a></td>
                </tr>
              <?php $count++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
       <!--End Investigation Tables -->
       
       <!--Procedure Tables -->
   		  <div class="card">
        <div class="card-action"><h3> Procedure Patients </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>On Date</th>
                  <th>Receipt Number</th>
                  <th>Fees</th>
                  <th>Discount</th>
                  <th>Payment Method</th>
                  <th>Billing From</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $count=1; foreach($procedure_result as $ky => $vl){
			  		$prod_data = unserialize($vl['data']);
					$discount = $prod_data['medicine_discount'] + $prod_data['injections_discount'] + $prod_data['consumables_discount'] + $prod_data['sub_procedures_discount'];	
			   ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php echo $vl['patient_id']?></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  $patient_name; ?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo $vl['receipt_number']?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['fees']?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$discount?></td>
                  <td><?php echo strtoupper($vl['payment_method']); ?></td>
                  <td><?php echo $vl['billing_from']?></td>
                  <td><a href="#" class="edit">Details</a></td>
                </tr>
              <?php $count++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Procedure Tables -->
      
      <!--End Advanced Tables -->
    </div>