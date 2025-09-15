  <?php $all_method =&get_instance(); ?>
  <div class="card">
      <div class="row card-content" style="margin-bottom:20px;">
    <div class="col-md-12">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Medicine Sale Reports </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'accounts/medicine_patients'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                 <select class="form-control" id="employee_number" name="employee_number">
                	<option value=''>--Select From--</option>
                    <?php $all_emplyee = $all_method->get_employee_list();
						            foreach($all_emplyee as $key => $val){ //var_dump($val);die;
                          if($employee_number == $val['name']){
                            echo '<option value="'.$val['employee_number'].'" selected>'.$val['name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['employee_number'].'">'.$val['name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
           <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/medicine_patients'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/Medicine-Patients'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
               </a>
            </div>	    
            </form>
        </div>
         <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">

              <thead>

                <tr>

				  <th>S.No.</th>

                  <th>IIC ID</th>

                  <th>Patient name</th>

                  <th>Receipt number</th>

                  <th>On Date</th>

                  <th>Discount amount</th>
				  
				  <th>Total</th>

                  <th>Biller</th>

                  <th>Status</th>
                <?php if($_SESSION['logged_accountant']){  ?>
                  <th>Action</th>
				<?php } ?>
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

              	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_discount_ = 0;
	$consumables_total = 0;
	$consumables_name = 0;
	$consumables_stock = 0;
	$consumables_quantity = 0;
	
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}

              ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>

			      <td><?php echo $vl['patient_detail_name']; ?></td>

                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=medicine"><?php echo $vl['receipt_number']?></a></td>

                  <td><?php echo $vl['on_date']?></td>
				  <td><?php echo $vl['discount_amount']?></td>
				  <td><?php echo $vl['payment_done']?></td>				  
				  <td><?php echo $all_method->get_employee_name($vl['employee_number']);  ?></td>

                  <td><?php echo ucwords($vl['status']); ?></td>
                  <?php if($_SESSION['logged_accountant']){  ?>
                  <td><?php   if($vl['status'] == 'Pending'){ ?> 
				                   
                                   <!-- <a href="javascript:void(0)" link="<?php echo base_url();?>accounts/approve/<?php echo $vl['ID']?>?t=medicine&u=approved" class="xyx btn btn-large" >Approve</a>-->
							<a href="javascript:void(0);" class="btn btn-large" onclick="approveMedicine('<?php echo $vl['ID']; ?>')">Approve</a>
										
								   | <a href="javascript:void(0);" type="medicine" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					            <?php }else {

						  		echo ucwords($vl['status']);

								if($vl['status'] == 'approved'){

									if($vl['remaining_amount'] < 0){ ?>

										<a href="<?php echo base_url();?>accounts/patient_reconcile/<?php echo $vl['receipt_number']?>?t=medicine" class="btn btn-large" >Reconcile to patient</a>

								<?php }

								}

								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

							}
					    ?>
                    <a href="<?php echo base_url(); ?>stocks/medicine_update?ID=<?php echo $vl['ID']?>" class="xyx btn btn-large" >Edit</a> 
				  </td>
				  
				  <?php } ?>
                </tr>

              <?php $count++; } ?>
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

       <!--End Investigation Tables -->


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
	
		<script type="text/javascript">
    function approveMedicine(ID) {
        if (confirm('Are you sure you want to approve this order?')) {
            $.ajax({
                url: '<?php echo base_url('accounts/approve_medicine/'); ?>' + ID,
                type: 'POST', // Use 'POST' if necessary
                success: function(response) {
                    // Success handling, for example, show an alert and update the UI
                    alert('Medicine approved successfully!');
                    // Optionally, update the UI (like changing button text or removing the row)
                    // $("#row_" + orderNumber).remove(); // If you want to remove the row
                },
                error: function(xhr, status, error) {
                    // Handle the error, display an error message
                    alert('Something went wrong. Please try again.');
                    console.log(xhr.responseText); // For debugging
                }
            });
        }
    }
</script>

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