 <?php $all_method =&get_instance(); ?>

    <div class="col-md-12">
      <!-- Advanced Tables -->
       <!--Consultation  Tables -->
    	  <div class="card">
        <div class="card-action"><h3>Filter data</h3></div>
	        <div class="col-sm-12 col-xs-12 patient_ledger_filter">
            <div class="form-group col-sm-4 col-xs-12 ">
            	<label>Filter by custom date</label>
                <input type="text" class="daterange_filter" name="daterange" value="" />
                <a href="<?php echo base_url('export-billing'); ?>" class="btn btn-large" id="export-billing">Export Billings</a>
            </div>
            <div class="form-group col-sm-4 col-xs-12 ">
            	<label>Filter by billing source</label>
                <select class="form-control" id="billing_from_filter">
                	<option value=''>--Select From--</option>
                    <option value='IndiaIVF'>IndiaIVF</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
		                     echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                    	  } 
					?>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12 ">
            	<label>Filter by billing at</label>
                <select class="form-control" id="billing_at_filter">
                	<option value=''>--Select From--</option>
                    <option value='IndiaIVF'>IndiaIVF</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
		                     echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                    	  } 
					?>
                </select>
            </div>
            <div class="form-group col-sm-2 col-xs-12">
            	<a href="<?php echo base_url().'accounts/requests'; ?>" class="btn btn-large">Reset filter</a>
            </div>
            <!--<div class="form-group col-sm-4 col-xs-12">-->
            <!--  <a href="<?php echo base_url('export-billing'); ?>" class="btn btn-large" id="export-billing">Export Billings</a>-->
            <!--</div>-->
        </div>
        <div class="clearfix"></div>
        <div class="card-action"><h3> Consultation Patients </h3></div>

         <div class="clearfix"></div>

        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover dataList" id="consultation_billing_list">

              <thead>

                <tr>

                  <th>S.No.</th>

                  <th>IIC ID</th>

                  <th>Patient name</th>

                  <th>Receipt number</th>

                  <th>On Date</th>

                  <th>Total</th>

                  <th>Discount amount</th>

                  <th>Balance</th>

                  <th>Biller</th>

                  <th>Status</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody id="consultation_result">

              <?php $count=1; foreach($consultation_result as $ky => $vl){

			  			$patient_data = get_patient_detail($vl['patient_id']);

						// $currency = '';

						// if($patient_data['nationality'] == 'indian'){

						// 	$currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';

						// }else {

						// 	$currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';

            // }
            $currency = '';
            //$currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';

			   ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>

                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo strtoupper($patient_name); ?></td>

                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=consultation"><?php echo $vl['receipt_number']?></a></td>

                  <td><?php echo $vl['on_date']?></td>

                  <td><?php echo $currency.$vl['fees']?></td>

                  <td><?php echo $currency.$vl['discount_amount']?></td>

                  <td><?php echo $currency.$vl['remaining_amount']?></td>

                  <td><?php $employee_details = employee_detail_number($vl['biller_id']); echo $employee_details['name']; ?></td>

                  <td><?php echo ucwords($vl['status']); ?></td>
                  
                  <td><?php if($all_method->discount_applied($vl['receipt_number']) > 0 && $vl['status'] !="disapproved"){
                                $discont_stats = $all_method->discount_applied_status($vl['receipt_number']);
                                
				  				if($discont_stats == 1){
				  				    echo '<p><i title="Discount Approved" class="fa fa-exclamation-circle" aria-hidden="true"></i></p>';
				  				    if($vl['status'] == 'pending'){ ?> 
                                        <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=consultation&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="consultation" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					                <?php }else {

            						  		echo ucwords($vl['status']);
            
            								if($vl['status'] == 'approved'){
            
            									if($vl['remaining_amount'] < 0){ ?>
            
            										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=consultation" class="btn btn-large" >Reconcile to patient</a>
            
            								<?php }
            
            								}
            
            								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

						        	}
				  				}else if($discont_stats == 2){
				  				    echo '<p><i title="Discount disapproved" class="fa fa-exclamation-circle" aria-hidden="true"></i></p>';
				  				    if($vl['status'] == 'pending'){ ?> 
                                        <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=consultation&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="consultation" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					                <?php }else {

            						  		echo ucwords($vl['status']);
            
            								if($vl['status'] == 'approved'){
            
            									if($vl['remaining_amount'] < 0){ ?>
            
            										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=consultation" class="btn btn-large" >Reconcile to patient</a>
            
            								<?php }
            
            								}
            
            								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

						        	}
				  				}else{
				  				    echo "Discount Requested!";
				  				}
				  			}else {
					  		    if($vl['status'] == 'pending'){ ?> 
                                    <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=consultation&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="consultation" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					            <?php }else {

						  		echo ucwords($vl['status']);

								if($vl['status'] == 'approved'){

									if($vl['remaining_amount'] < 0){ ?>

										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=consultation" class="btn btn-large" >Reconcile to patient</a>

								<?php }

								}

								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

							}
					    	}
					    ?>

                  </td>

                 
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

            <table class="table table-striped table-bordered table-hover dataList" id="investigation_billing_list">

              <thead>

                <tr>

				  <th>S.No.</th>

                  <th>IIC ID</th>

                  <th>Patient name</th>

                  <th>Receipt number</th>

                  <th>On Date</th>

                  <th>Total</th>

                  <th>Discount amount</th>

                  <th>Balance</th>

                  <th>Biller</th>

                  <th>Status</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody id="investigate_result">

              <?php $count=1; foreach($investigate_result as $ky => $vl){

                            $patient_data = get_patient_detail($vl['patient_id']);

    						// $currency = '';

    						// if($patient_data['nationality'] == 'indian'){

    						// 	$currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';

    						// }else {

    						// 	$currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';

                // }
                $currency = '';
                //$currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';

              

              ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>

                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo strtoupper($patient_name); ?></td>

                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=investigation"><?php echo $vl['receipt_number']?></a></td>

                  <td><?php echo $vl['on_date']?></td>

                  <td><?php echo $currency.$vl['fees']?></td>

                  <td><?php echo $currency.$vl['discount_amount']?></td>

                  <td><?php echo $currency.$vl['remaining_amount']?></td>

                  <td><?php $employee_details = employee_detail_number($vl['biller_id']); echo $employee_details['name']; ?></td>

                  <td><?php echo ucwords($vl['status']); ?></td>
                  
                  <td><?php if($all_method->discount_applied($vl['receipt_number']) > 0 && $vl['status'] !="disapproved"){
                                $discont_stats = $all_method->discount_applied_status($vl['receipt_number']);
                                
				  				if($discont_stats == 1){
				  				    echo '<p><i title="Discount Approved" class="fa fa-exclamation-circle" aria-hidden="true"></i></p>';
				  				    if($vl['status'] == 'pending'){ ?> 
                                        <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=investigation&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="investigation" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					                <?php }else {

            						  		echo ucwords($vl['status']);
            
            								if($vl['status'] == 'approved'){
            
            									if($vl['remaining_amount'] < 0){ ?>
            
            										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=investigation" class="btn btn-large" >Reconcile to patient</a>
            
            								<?php }
            
            								}
            
            								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

						        	}
				  				}else if($discont_stats == 2){
				  				    echo '<p><i title="Discount disapproved" class="fa fa-exclamation-circle" aria-hidden="true"></i></p>';
				  				    if($vl['status'] == 'pending'){ ?> 
                                        <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=investigation&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="investigation" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					                <?php }else {

            						  		echo ucwords($vl['status']);
            
            								if($vl['status'] == 'approved'){
            
            									if($vl['remaining_amount'] < 0){ ?>
            
            										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=investigation" class="btn btn-large" >Reconcile to patient</a>
            
            								<?php }
            
            								}
            
            								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

						        	}
				  				}else{
				  				    echo "Discount Requested!";
				  				}
				  			}else {
					  		    if($vl['status'] == 'pending'){ ?> 
                                    <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=investigation&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="investigation" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					            <?php }else {

						  		echo ucwords($vl['status']);

								if($vl['status'] == 'approved'){

									if($vl['remaining_amount'] < 0){ ?>

										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=investigation" class="btn btn-large" >Reconcile to patient</a>

								<?php }

								}

								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

							}
					    	}
					    ?>

                  </td>

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

            <table class="table table-striped table-bordered table-hover dataList" id="procedure_billing_list">

              <thead>

                <tr>

				  <th>S.No.</th>

                  <th>IIC ID</th>

                  <th>Patient name</th>

                  <th>Receipt number</th>

                  <th>On Date</th>

                  <th>Total</th>

                  <th>Discount amount</th>

                  <th>Balance</th>

                  <th>Biller</th>

                  <th>Status</th>

                  <th>Action</th>               

                </tr>

              </thead>

              <tbody id="procedure_result">

              <?php $count=1; foreach($procedure_result as $ky => $vl){

                        $patient_data = get_patient_detail($vl['patient_id']);

						$currency = '';
           // $currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';
						// if($patient_data['nationality'] == 'indian'){

						// 	$currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';

						// }else {

						// 	$currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';

						// }

              $current_balance = $all_method->get_current_balance($vl['patient_id']); ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>

                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo strtoupper($patient_name); ?></td>

                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=procedure"><?php echo $vl['receipt_number']?></a></td>

                  <td><?php echo $vl['on_date']?></td>

                  <td><?php echo $currency.$vl['fees']?></td>

                  <td><?php echo $currency.$vl['discount_amount']?></td>

                  <td><?php echo $currency.$current_balance; ?></td>

                  <td><?php $employee_details = employee_detail_number($vl['biller_id']); echo $employee_details['name']; ?></td>

                  <td><?php echo ucwords($vl['status']); ?></td>

                  <td><?php if($all_method->discount_applied($vl['receipt_number']) > 0 && $vl['status'] !="disapproved"){
                                $discont_stats = $all_method->discount_applied_status($vl['receipt_number']);
                                
				  				if($discont_stats == 1){
				  				    echo '<p><i title="Discount Approved" class="fa fa-exclamation-circle" aria-hidden="true"></i></p>';
				  				    if($vl['status'] == 'pending'){ ?> 
                                        <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=procedure&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="procedure" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					                <?php }else {

            						  		echo ucwords($vl['status']);
            
            								if($vl['status'] == 'approved'){
            
            									if($vl['remaining_amount'] < 0){ ?>
            
            										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=procedure" class="btn btn-large" >Reconcile to patient</a>
            
            								<?php }
            
            								}
            
            								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

						        	}
				  				}else if($discont_stats == 2){
				  				    echo '<p><i title="Discount disapproved" class="fa fa-exclamation-circle" aria-hidden="true"></i></p>';
				  				    if($vl['status'] == 'pending'){ ?> 
                                        <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=procedure&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="procedure" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					                <?php }else {

            						  		echo ucwords($vl['status']);
            
            								if($vl['status'] == 'approved'){
            
            									if($vl['remaining_amount'] < 0){ ?>
            
            										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=procedure" class="btn btn-large" >Reconcile to patient</a>
            
            								<?php }
            
            								}
            
            								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

						        	}
				  				}else{
				  				    echo "Discount Requested!";
				  				}
				  			}else {
					  		    if($vl['status'] == 'pending'){ ?> 
                                    <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=procedure&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="procedure" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					            <?php }else {

						  		echo ucwords($vl['status']);

								if($vl['status'] == 'approved'){

									if($vl['remaining_amount'] < 0){ ?>

										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=procedure" class="btn btn-large" >Reconcile to patient</a>

								<?php }

								}

								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

							}
					    	}
					    ?>

                  </td>

                </tr>

              <?php $count++;} ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

      <!--End Procedure Tables -->   
      
      
      <!--Partial Tables -->
   		<div class="card">
            <div class="card-action"><h3> Partial Payments </h3></div>
             <div class="clearfix"></div>
            <div class="card-content">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataList" id="procedure_billing_list">
                  <thead>
                    <tr>
    				  <th>S.No.</th>
                      <th>Receipt Number</th>
                      <th>Payment ID</th>
                      <th>Patient ID</th>
                      <th>On Date</th>
                      <th>Amount Paid</th>
                      <th>Billing At</th>
                      <th>Billing Source</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody id="partial_payment_result">
                  <?php $count=1; foreach($patient_payments_result as $ky => $vl){
                            $patient_data = get_patient_detail($vl['patient_id']);
    						$currency = '';
               // $currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';
    						// if($patient_data['nationality'] == 'indian'){
    						// 	$currency = '<i class="fa fa-inr" aria-hidden="true"></i> ';
    						// }else {
    						// 	$currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';
    						// }
                  $current_balance = $all_method->get_current_balance($vl['patient_id']); ?>
                    <tr class="odd gradeX">
                      <td><?php echo $count; ?></td>
                      <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['billing_id']?>?t=<?php echo $vl['type']?>"><?php echo $vl['billing_id']?></a></td>
                      <td><a href="<?php echo base_url()?>partial-payment-receipt/<?php echo $vl['refrence_number'];?>"><?php echo $vl['refrence_number']; ?></a></td>
                      <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                      <td><?php echo $vl['on_date']?></td>
                      <td><?php echo $currency.$vl['payment_done']?></td>
                      <td><?php echo $all_method->get_center_name($vl['billing_at']); ?></td>
                      <?php
                        if($vl['billing_from'] == 'IndiaIVF'){ echo '<td>'.$vl['billing_from'].'</td>'; }
					    else{echo '<td>'.$all_method->get_center_name($vl['billing_from']).'</td>';}
                      ?>
                      <?php if($vl['status'] == 1){ echo '<td>Approved</td>'; }
        					else if($vl['status'] == 2){ echo '<td>Disapproved</td>'; }
        					else{echo '<td>Pending</td>';}
    				  ?>
                    </tr>
                  <?php $count++;} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      <!--End Partial Tables -->   

      <!--End Advanced Tables -->

	    <div class="row" id="disapprove_pop">

            <div class="col-sm-12 disapprove_pop_inner role">

            	<div class="col-sm-8 no-pad pt-7">

            		<label class="pop_lable">Reason of disapprove?</label>

                </div>

                <div class="col-sm-4">

            		<a href="javascript:void(0);" class="close_disapprove btn btn-large">close</a>

                </div>

                <input type="text" class="hidden_field" readonly="readonly" value="" id="bill_type" />

                <input type="text" class="hidden_field" readonly="readonly" value="disapproved" id="bill_action" />

                <input type="text" class="hidden_field" readonly="readonly" value="" id="bill_id" />

                

                <p class="error hidden_field"></p>

                <label class="pop_lable">Disapproved because:</label>

                <select class="disapprove_suggestion mt-20">

                	<option value="">-- Select reason --</option>

                    <option value="Wrong entry">Wrong entry</option>

                	<option value="Wrong billing">Wrong billing</option>

                	<option value="Received amount not correct">Received amount not correct</option>

                	<option value="Amount not received">Amount not received</option>

                </select>

                <label class="pop_lable">Submit your own reason:</label>

                <textarea class="form-control" id="disapprove_reason"></textarea>

                <a href="javascript:void(0);" class="now_disapprove btn btn-large">Disapprove</a>

            </div>

        </div>

    </div>

    <style>

		.hidden_field{display:none;}

		div#disapprove_pop {

			position: fixed;

			top: 0;

			right: 0;

			left: 0;

			background: rgba(255,255,255,0.6);

			z-index: 999999999;

			height: 100%;

			height: 100%;

			box-shadow: 0px 0px 3px 0px #000;

			display:none;

		}

		.pop_lable {

			width: 100%;

			color: #000!important;

			font-weight: 800;

			font-size: 15px;

			margin-bottom: 10px!important;

		}

		.disapprove_pop_inner {

			width: 50%;

			margin: 80px 25%;

			float:left;

			box-shadow: 0px 0px 10px 0px #000;

			background: #fff;

		}

		a.close_disapprove {

			float: right;

			margin-top: 10px;

		}

		a.now_disapprove.btn.btn-large {

			margin: 10px 0px;

		}

	</style>

    <script>
    $(document).on('click','a.xyx',function(){

			$('#disapprove_pop p.error.hidden_field').empty().show();

			var xyx = confirm("Are you sure to approve this billing?");

			if(xyx){

				window.location.href = $(this).attr('link');

			}

		});

    $(document).on('click','a.disaprove_first',function(){
			$('#disapprove_pop p.error.hidden_field').empty().hide();

			$('#bill_type').val($(this).attr('type'));

			$('#bill_id').val($(this).attr('bill'));

			$('div#disapprove_pop').show();

		});

    $(document).on('click','a.close_disapprove',function(){
			$('#disapprove_pop p.error.hidden_field').empty().hide();

			$('#bill_type').val('');

			$('#bill_id').val('');

			$('div#disapprove_pop').hide();

		});

    $(document).on('click','a.now_disapprove',function(){

			$('p.error.hidden_field').empty().hide();

			var  bill_type = $('#bill_type').val();

			var  bill_action = $('#bill_action').val();

			var  bill_id = $('#bill_id').val();

			var  disapprove_suggestion = $('.disapprove_suggestion').val();

			var  disapprove_reason = $('#disapprove_reason').val();

			if(disapprove_suggestion != '' || disapprove_reason != ''){

				if(disapprove_suggestion !== ''){ disapprove_reason = disapprove_suggestion; }

				window.location.href = '<?php echo base_url();?>accounts/approve/'+bill_id+'?t='+bill_type+'&u='+bill_action+'&r='+disapprove_reason+'';			

			}else{

				$('#disapprove_pop p.error.hidden_field').empty().append('Select any reason!').show();

			}

		});

    </script>

<script>
        $(document).on('change',"#billing_at_filter",function(e) {
        $('#billing_from_filter').prop('selectedIndex',0);
            $('#loader_div').show();
            var billing_at = $(this).val();
            if(billing_at != ''){
              var data = {billing_at:billing_at, type:'billing_at'};
              billing_filter(data);
            }else{
              $('#loader_div').hide();
            }
        });
        $(document).on('change',"#billing_from_filter",function(e) {
        $('#billing_at_filter').prop('selectedIndex',0);
            $('#loader_div').show();
            var billing_from = $(this).val();
            if(billing_from != ''){
              var data = {billing_from:billing_from, type:'billing_from'};
              billing_filter(data);
            }else{
              $('#loader_div').hide();
            }
        });
      $(function() {
          $('input[name="daterange"]').daterangepicker({
          opens: 'left'
          }, function(start, end, label) {
              $('#billing_from_filter').prop('selectedIndex',0);
              $('#billing_at_filter').prop('selectedIndex',0);
            var end = end.add(1, 'days');
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 00:00:00'));
            var data = {start:start.format('YYYY-MM-DD 00:00:00'),end:end.format('YYYY-MM-DD 00:00:00'), type:'date_wise'};
            billing_filter(data, start.format('YYYY-MM-DD 00:00:00'), end.format('YYYY-MM-DD 00:00:00'));
            $(this).datepicker('setDate', null);
          });
      });

      $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data('daterangepicker').setStartDate(moment());
        $(this).data('daterangepicker').setEndDate(moment());
      });
      
      /*$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data('daterangepicker').setStartDate(moment());
        $(this).data('daterangepicker').setEndDate(moment());
      });*/

      function billing_filter(data, start, end){ //console.log('23432');
          $('#loader_div').show();
          $('tbody#consultation_result').empty();
          $('tbody#investigate_result').empty();
          $('tbody#procedure_result').empty();
          $.ajax({
              url: '<?php echo base_url('billings/ajax_accounts_billing_filter')?>',
              data: data,
              dataType: 'json',
              method:'post',
              success: function(datax)
              {
                  $("#consultation_billing_list").append(datax.consultant_html);
                  $('tbody#investigate_result').empty().append(datax.investigation_html);
                  $('tbody#procedure_result').empty().append(datax.procedure_html);
                  $('tbody#partial_payment_result').empty().append(datax.payment_html);

                  var export_billing = $('#export-billing').attr('href');
                  if(data.type == "date_wise"){
                    $('#export-billing').attr('href', export_billing+"?type="+data.type+"&start="+start+"&end="+end);
                  }
                  if(data.type == "billing_from"){
                    $('#export-billing').attr('href', export_billing+"?type="+data.type+"&billing_from="+data.billing_from);  
                  }
                  if(data.type == "billing_at"){
                      $('#export-billing').attr('href', export_billing+"?type="+data.type+"&billing_at="+data.billing_at);  
                  }
                $("ul.pagination").hide();
                  $('#loader_div').hide();
              } 
          });
      }
</script>