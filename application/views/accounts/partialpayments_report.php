 <?php $all_method =&get_instance(); ?>
    <div class="card">
      <div class="row card-content" style="margin-bottom:20px;">
      <div class="col-md-12"><h3>Partial Payments </h3></div>
      <div class="clearfix"></div>
	    <form action="<?php echo base_url().'accounts/partialpayments_report'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                <select class="form-control" id="billing_at" name="billing_at">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($billing_at == $val['center_number']){
                            echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
			<div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>Payment Type </label>
                <select class="form-control" id="payment_method" name="payment_method">
				    <option value=''>--Select From--</option>
                    <option value="cash" mode="Cash">Cash</option>
					<option value="neft" mode="NEFT">NEFT</option>
                    <option value="rtgs" mode="RTGS">RTGS</option>
                    <option value="card" mode="Card">Card</option>
                    <option value="upi" mode="UPI">UPI</option>
                    <option value="insurance" mode="Insurance">Insurance</option>
					<option value="wallets" mode="Wallets">Wallets</option>
					<option value="loan" mode="loan">Financing Loan</option>
					<option value="cheque" mode="Cheque">Cheque</option>
                </select>
            </div>
            <div class="col-sm-2 col-xs-12" style="margin-top:10px;">
              <label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/partialpayments_report'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/Partialpaymentsreport'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
                </a>
            </div>	
		  </form>  
        </div>
             <div class="clearfix"></div>
            <div class="card-content">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
                  <thead>
                    <tr>
    				  <th>S.No.</th>
					  <th>Name</th>
                      <th>Receipt Number</th>
                      <th>Patient ID</th>
					  <th>On Date</th>
                      <th>Amount Paid</th>
                      <th>Billing At</th>
                      <th>Billing Source</th>
					  <th>Status</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="partial_payment_result">
                  <?php 
                  $total_payment_done = 0;
				  $count=1; foreach($partialpayments_result as $ky => $vl){
                            $patient_data = get_patient_detail($vl['patient_id']);
    						$currency = '';
                  $current_balance = $all_method->get_current_balance($vl['patient_id']); ?>
                    <tr class="odd gradeX">
                      <td><?php echo $count; ?></td>
					  <td><?php 
                    $patient_name = $all_method->get_patient_name($vl['patient_id']);
                    echo strtoupper($patient_name); ?>
                  </td>
                      <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['billing_id']?>?t=<?php echo $vl['type']?>"><?php echo $vl['billing_id']?></a></td>
                      <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                      <td><?php echo $vl['on_date']?></td>
                      <td><?php echo $currency.$vl['payment_done']?></td>
                      <td><?php echo $all_method->get_center_name($vl['billing_at']); ?></td>
                      <td><?php echo $vl['type']?></td>
					  <td><?php  if($vl['status'] == '1'){ ?> Approved <?php }  if($vl['status'] == '2'){ ?> disapproved  <?php } if($vl['status'] == '0'){ ?> Pending <?php } ?></td>
                         <?php if($_SESSION['logged_administrator']){  ?>
				  <td><?php  if($vl['status'] == '1'){ ?> 

				  			<a href="javascript:void(0);" type="partialpayments" bill="<?php echo $vl['ID']; ?>" class="billing_disaprove_first btn btn-large" >Disapprove Billing</a>

					<?php } ?>

				  </td>
				  <?php } ?>
                    </tr>
					 <?php 
               $total_payment_done += $vl['payment_done'];
				 ?>
                  <?php $count++;} ?>
				   <tr>
                <td colspan="5">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
				<td><?php echo $total_payment_done; ?></td>
              </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      <!--End Partial Tables -->   
      <!--End Advanced Tables -->
    </div>
	
		<div class="row" id="billing_disapprove_pop">

            <div class="col-sm-12 billing_disapprove_pop_inner role">

            	<div class="col-sm-8 no-pad pt-7">

            		<label class="pop_lable">Reason of disapprove?</label>

                </div>

                <div class="col-sm-4">

            		<a href="javascript:void(0);" class="billing_close_disapprove btn btn-large">close</a>

                </div>

                <input type="text" class="hidden_field" readonly="readonly" value="" id="billing_type" />
				
                <input type="text" class="hidden_field" readonly="readonly" value="2" id="billing_action" />

                <input type="text" class="hidden_field" readonly="readonly" value="" id="billing_id" />



                <p class="error hidden_field"></p>

                <label class="pop_lable">Disapproved because:</label>

                <select class="billing_disapprove_suggestion mt-20">

                	<option value="">-- Select reason --</option>

                  <option value="Wrong entry">Wrong entry</option>

                	<option value="Wrong billing">Wrong billing</option>

                	<option value="Received amount not correct">Received amount not correct</option>

                	<option value="Amount not received">Amount not received</option>

                </select>

                <label class="pop_lable">Submit your own reason:</label>

                <textarea style="height: 80px!important;" class="form-control" id="billing_disapprove_reason"></textarea>

                <a href="javascript:void(0);" class="now_billing_disapprove btn btn-large">Disapprove</a>

            </div>

        </div>

    <style>
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
		.hidden_field{display:none;}

		div#billing_disapprove_pop {

			position: fixed;

			top: 0;

			right: 0;

			left: 0;

			background: rgba(255,255,255,0.6);

			z-index: 999999999;

			height: 100%;

			box-shadow: 0px 0px 3px 0px #000;

			display:none;

		}



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

			height: 200px;

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

		.billing_disapprove_pop_inner {

			width: 50%;

			margin: 80px 25%;

			height: 280px;

			box-shadow: 0px 0px 10px 0px #000;

			background: #fff;

		}

		a.billing_close_disapprove {

			float: right;

			margin-top: 10px;

		}

		a.now_billing_disapprove.btn.btn-large {

			margin: 10px 0px;

		}

	</style>
	<script>

      $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var data = {appointment_date:startDate, type:'particular_date_filter'};
          }
        });
    });

</script>
    <script>

    	$("a.disaprove_first").on("click", function(){

			$('#bill_type').val($(this).attr('type'));

			$('#bill_id').val($(this).attr('bill'));

			$('div#disapprove_pop').show();

		});

		$("a.close_disapprove").on("click", function(){

			$('#bill_type').val('');

			$('#bill_id').val('');

			$('div#disapprove_pop').hide();

		});

		
		$(document).on("click","a.billing_disaprove_first",function() {

		    $('#billing_disapprove_pop p.error.hidden_field').empty().hide();

			$('#billing_type').val($(this).attr('type'));

			$('#billing_id').val($(this).attr('bill'));

			$('div#billing_disapprove_pop').show();

		});

		$(document).on("click","a.billing_close_disapprove",function() {

			$('#billing_disapprove_pop p.error.hidden_field').empty().hide();

			$('#billing_type').val('');

			$('#billing_id').val('');

			$('div#billing_disapprove_pop').hide();

		});

		$(document).on("click","a.now_billing_disapprove",function() {

			$('p.error.hidden_field').empty().hide();

			var  bill_type = $('#billing_type').val();

			var  bill_action = $('#billing_action').val();

			var  bill_id = $('#billing_id').val();

			var  disapprove_suggestion = $('.billing_disapprove_suggestion').val();

			var  disapprove_reason = $('#billing_disapprove_reason').val();

			if(disapprove_suggestion != '' || disapprove_reason != ''){

				if(disapprove_suggestion !== ''){ disapprove_reason = disapprove_suggestion; }
					window.open(
						'<?php echo base_url();?>accounts/approve/'+bill_id+'?t='+bill_type+'&u='+bill_action+'&r='+disapprove_reason+'',
					'_blank' // <- This is what makes it open in a new window.
					);
			}else{

				$('#billing_disapprove_pop p.error.hidden_field').empty().append('Select any reason!').show();

			}

		});

    </script>
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