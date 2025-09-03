<?php $all_method =&get_instance(); ?>
<div class="col-md-12">
  <!-- Advanced Tables -->
  <div class="card">
	<div class="card-action"><h3> Billing discounts </h3></div>
	 <div class="clearfix"></div>
	<div class="card-content">
	  <div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataList" id="">
		  <thead>
				<tr>
					  <th>IIC ID</th>
                      <th>PT name</th>
					  <th>Receipt number</th>
					  <th>Discount amount</th>
					  <th>Coupon code</th>
                      <th>Type</th>
					  <th>Used</th>
                      <th>Date</th>
					  <th>Status</th>
				</tr>
		  </thead>
		  <tbody>
		  <?php foreach($data as $ky => $vl){
		  			$patient_data = get_patient_detail($vl['patient_id']);
					$currency = "";
					if($patient_data['nationality'] == "indian"){$currency = "Rs.";}else{$currency = "USD";}
		  ?>
				<tr class="odd gradeX">
	                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
	                  <td><?php echo strtoupper($patient_data['wife_name']); ?></td>
                      <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=<?php echo $vl['type']; ?>"><?php echo $vl['receipt_number']?></a></td>
					  <td><?php echo $currency.$vl['amount']; ?></td>
					  <td><?php echo $vl['code']; ?></td>
                      <td><?php echo ucfirst($vl['type']); ?></td>
					  <td><?php if($vl['status']== 2){ echo 'Declined';}else if($vl['status']== 1){if($vl['used']== 1){echo 'Applied';}else{echo 'Unapplied'; }}else{echo 'Pending';} ?></td>
                      <td><?php echo dateformat($vl['date']); ?></td>
					  <td>  <?php if($vl['status']== 2){ echo 'Declined';}else if($vl['status']== 1){echo 'Approved';}else{echo 'Pending';} ?>
					        <?php if(!empty($vl['disapproval_reason'])){ echo "(".$vl['disapproval_reason'].")";} ?>
					  </td>
				</tr>
		  <?php } ?>
		  </tbody>
		</table>
	  </div>
	</div>
  </div>
  <!--End Advanced Tables -->
</div>