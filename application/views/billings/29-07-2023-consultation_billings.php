<?php $all_method =&get_instance(); //var_dump($_SERVER['REDIRECT_QUERY_STRING']);die; ?>

    <div class="col-md-12">

      <!-- Advanced Tables -->

       <!--Consultation  Tables -->

    	  <div class="card">

        <div class="card-action"><h3>Filter data</h3></div>

        <div class="col-sm-12 col-xs-12 patient_ledger_filter">

        	<div class="form-group col-sm-4 col-xs-12 ">

            	<label>Filter by billing at</label>

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

            	<label>Filter by custom date</label>

                <input type="text" class="daterange_filter" name="daterange" value="" />

            </div>

            <div class="form-group col-sm-4 col-xs-12">

            	<a href="<?php echo base_url().'billings/consultation_billings'; ?>" class="btn btn-large">Reset filter</a>

            </div>            

        </div>

        <div class="clearfix"></div>

        <div class="card-action"><h3> Consultation Patients </h3></div>

        

         <div class="clearfix"></div>

        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover dataList" id="">

              <thead>

                <tr>

                  <th>S.No.</th>

                  <th>Receipt number</th>

                  <th>IIC ID</th>

                  <th>Patient Name</th>

                  <th>Total package</th>

                  <th>Discounted package</th>

                  <th>Remaining amount</th>

                  <th>Paid amount</th>

                  <th>On Date</th>

				  <th>Status</th>

				  <th>Action</th>

                </tr>

              </thead>

              <tbody id="consultation_result">

              <?php $count=1; foreach($consultation_result as $ky => $vl){

			  			$patient_data = get_patient_detail($vl['patient_id']);

						$currency = '';

						// if($patient_data['nationality'] == 'indian'){

						// 	$currency = $currency;

						// }else {

						// 	$currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';

						// }

			   ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=consultation"><?php echo $vl['receipt_number']?></a></td>

                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>

                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  $patient_name; ?></td>

                  <td><?php echo $currency.$vl['totalpackage']?></td>

                  <td><?php echo $currency.$vl['fees']?></td>

                  <td><?php echo $currency.$vl['remaining_amount']?></td>

                  <td><?php echo $currency.$vl['payment_done']?></td>

                  <td><?php echo $vl['on_date']?></td>

				  <td><?php echo ucfirst($vl['status']); ?></td>

				  <td><?php  if($vl['status'] == 'approved'){ ?> 

				  			<a href="javascript:void(0);" type="consultation" bill="<?php echo $vl['ID']; ?>" class="billing_disaprove_first btn btn-large" >Disapprove Billing</a>

					<?php } ?>

				  </td>

                </tr>

              <?php $count++;} ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

       <!--End Consultation  Tables -->

    </div>

    

       <div class="row" id="disapprove_pop">

            <div class="col-sm-12 disapprove_pop_inner">

            	<a href="javascript:void(0);" class="close_disapprove btn btn-large">close</a>

                <input type="text" class="hidden_field" readonly="readonly" value="" id="bill_type" />

                <input type="text" class="hidden_field" readonly="readonly" value="" id="bill_id" />

                <label class="pop_lable">IIC share</label>

                <p class="error hidden_field"></p>

                <textarea class="form-control" id="iic_share"></textarea>

                <a href="javascript:void(0);" class="now_disapprove btn btn-large">Submit</a>

            </div>

        </div>

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

                <input type="text" class="hidden_field" readonly="readonly" value="disapproved" id="billing_action" />

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

                <textarea class="form-control" id="billing_disapprove_reason"></textarea>

                <a href="javascript:void(0);" class="now_billing_disapprove btn btn-large">Disapprove</a>

            </div>

        </div>

    </div>


    <style>

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

		$("a.now_disapprove").on("click", function(){

			var  bill_type = $('#bill_type').val();

			var  bill_id = $('#bill_id').val();

			var  iic_share = $('#iic_share').val();
			window.open(
						'<?php echo base_url();?>billings/iic_share_update/'+bill_id+'?t='+bill_type+'&s='+iic_share+'',
					'_blank' // <- This is what makes it open in a new window.
					);

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

    

    <script>

		$(document).on('change',"#billing_from_filter",function(e) {

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

					//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

					var data = {start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD'), type:'date_wise'};

					billing_filter(data);

					$(this).datepicker('setDate', null);

			  });

		});



		$('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {

			$(this).val('');

			$(this).data('daterangepicker').setStartDate(moment());

			$(this).data('daterangepicker').setEndDate(moment());

		});


		function billing_filter(data){

			$('#consultation_result').empty();

			$('#investigate_result').empty();

			$('#procedure_result').empty();

			$.ajax({

					url: '<?php echo base_url('billings/ajax_billing_filter')?>',

					data: data,

					dataType: 'json',

					method:'post',

					success: function(data)

					{

						$('#consultation_result').append(data.consultant_html);

						$('#investigate_result').append(data.investigation_html);

						$('#procedure_result').append(data.procedure_html);

						$("ul.pagination").hide();

						$('#loader_div').hide();

					} 

			});

		}

</script>

