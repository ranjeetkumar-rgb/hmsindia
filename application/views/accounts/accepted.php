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
                  <th>Receipt Number</th>
                  <th>On Date</th>
                  <th>Billing at</th>
                  <th>Billing from</th>
                  <th>Total</th>
                  <th>Balance</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $count=1; foreach($consultation_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php echo $vl['receipt_number']?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php $center = $all_method->get_center_name($vl['billing_at']); echo  $center; ?></td>
                  <?php if($vl['billing_from'] == 'IndiaIVF'){ echo '<td>'.$vl['billing_from'].'</td>'; }
					else{echo '<td>'.$all_method->get_center_name($vl['billing_from']).'</td>';}	?>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['fees']; ?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['remaining_amount']; ?></td>
                  <td><?php if($vl['accepted'] == '0'){?> <a href="<?php echo base_url();?>accounts/accept/<?php echo $vl['receipt_number']?>?t=consultation" class="btn btn-large" >Accept</a><?php }?></td>
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
                  <th>Receipt Number</th>
                  <th>On Date</th>
                  <th>Billing at</th>
                  <th>Billing from</th>
                  <th>Total</th>
                  <th>Discount</th>
                  <th>Balance</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $count=1; foreach($investigate_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php echo $vl['receipt_number']?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php $center = $all_method->get_center_name($vl['billing_at']); echo  $center; ?></td>
                  <?php if($vl['billing_from'] == 'IndiaIVF'){ echo '<td>'.$vl['billing_from'].'</td>'; }
					else{echo '<td>'.$all_method->get_center_name($vl['billing_from']).'</td>';}	?>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['fees']; ?></td>
                  <td><?php echo $vl['discount_amount']; ?>%</td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['remaining_amount']; ?></td>
                   <td><?php if($vl['accepted'] == '0'){?> <a href="<?php echo base_url();?>accounts/accept/<?php echo $vl['receipt_number']?>?t=investigation" class="btn btn-large" >Accept</a><?php }?></td>
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
                  <th>Receipt Number</th>
                  <th>On Date</th>
                  <th>Billing at</th>
                  <th>Billing from</th>
                  <th>Total</th>
                  <th>Discount</th>
                  <th>Balance</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php $count=1; foreach($procedure_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><?php echo $vl['receipt_number']?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php $center = $all_method->get_center_name($vl['billing_at']); echo  $center; ?></td>
                  <?php if($vl['billing_from'] == 'IndiaIVF'){ echo '<td>'.$vl['billing_from'].'</td>'; }
					else{echo '<td>'.$all_method->get_center_name($vl['billing_from']).'</td>';}	?>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['fees']; ?></td>
                  <td><?php echo $vl['discount_amount']; ?>%</td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['remaining_amount']; ?></td>
                   <td><?php if($vl['accepted'] == '0'){?> <a href="<?php echo base_url();?>accounts/accept/<?php echo $vl['receipt_number']?>?t=procedure" class="btn btn-large" >Accept</a><?php }?></td>
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