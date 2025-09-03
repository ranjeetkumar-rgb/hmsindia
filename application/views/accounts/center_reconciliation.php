    <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Center Reconciliation </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                    <tr>
                          <th>IIC ID</th>
                          <th>PT name</th>
                          <th>Total package</th>
                          <th>Discounted package</th>
                          <th>Patient pending/surplus</th>
                          <th>IIC share</th>
                          <th>Center share</th>
                          <th>Payment to IIC</th>
                          <th>Payment to Centre</th>                         
                          <th>Payable to IIC</th>
                          <th>Payable to center</th>
                          <th>Action</th>
                          <th>Status</th>
                    </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ 
			  		$current_balance = $all_method->get_current_balance($vl['patient_id']);
					$payment_at = $all_method->get_payment_at($vl['patient_id']);
					$settle = $all_method->check_settle($vl['patient_id']);
					$center_payment_done = $payment_at['payment_center']+$settle['center_settle']; 
		  			$ivf_payment_done = $payment_at['payment_ivf']+$settle['ivf_settle'];

					$iic_surplus = $vl['payment_ivf_share']-$ivf_payment_done;
					$center_surplus = $vl['payment_center_share']-$center_payment_done;
					
					$iic_payable = 0; $pay_to = "?a=".$center_surplus;
					if($iic_surplus > 0){ $iic_payable = $iic_surplus; $pay_to = "?a=".$iic_payable."&p=iic";}

					$patient_data = get_patient_detail($vl['patient_id']);
					$currency = $nation = '';
					if($patient_data['nationality'] == 'indian'){
						$currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';
						$nation = 'Indian';
					}else {
						$currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';
						$nation = 'Non-indian';
					}
			  ?>
                    <tr class="odd gradeX">
                          <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a><p>(<?php echo $nation; ?>)</p></td>
                          <td><?php echo $vl['patient_name']; ?></td>
                          <td><?php echo $currency.$vl['totalpackage']; ?></td>
                          <td><?php echo $currency.$vl['total']; ?></td>
                          <td><?php echo $currency.$current_balance; ?></td>
                          <td><?php echo $currency.$vl['payment_ivf_share']; ?></td>
                          <td><?php echo $currency.$vl['payment_center_share']; ?></td>                          
                          <td><?php echo $currency.$ivf_payment_done; ?></td>
                          <td><?php echo $currency.$center_payment_done; ?></td>
                          <td><?php if($ivf_payment_done < $vl['payment_ivf_share']){ echo $currency.$iic_payable; }else {echo $currency.'0';}?></td>
                          <td><?php if($center_payment_done < $vl['payment_center_share']){ echo $currency.$center_surplus; }else {echo $currency.'0';}?></td>
                          <td><?php if($current_balance == 0){
						  			if($center_surplus > 0 || $iic_surplus > 0){ ?>
                                   <a href="<?php echo base_url();?>accounts/settle/<?php echo $vl['patient_id']; echo $pay_to; ?>" class="btn btn-large" >Settle</a>
                              <?php  }else{echo 'settled';} }else { ?><?php } ?>
                          </td>
                          <td><?php if($center_surplus > 0 || $iic_surplus > 0){ ?> FC pending <?php }else { ?>FC given<?php } ?></td>
                    </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>