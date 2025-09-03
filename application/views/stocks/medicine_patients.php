 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Medicine Sale Reports </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/medicine_stock'; ?>" method="get">
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
                <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $patient_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/medicine_stock'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/investigation-patients'); ?>" style="text-decoration: none;">
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

                  <th>Total</th>

                  <th>Discount amount</th>

                  <th>Balance</th>
				  <th>Cash</th>
				  <th>Card</th>
				  <th>Upi</th>
				  <th>Neft</th>

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

			  <td><?php echo $v['patient_detail_name']; ?></td>

                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=investigation"><?php echo $vl['receipt_number']?></a></td>

                  <td><?php echo $vl['on_date']?></td>

                  <td><?php echo $currency.$vl['fees']?></td>

                  <td><?php echo $currency.$vl['discount_amount']?></td>

                  <td><?php echo $currency.$vl['remaining_amount']?></td>
				  
				  <td><?php echo $vl['cash_payment']; ?></td>
				  <td><?php echo $vl['card_payment']; ?></td>
				  <td><?php echo $vl['upi_payment']; ?></td>
				  <td><?php	echo $vl['neft_payment']; ?></td>

                  <td><?php $employee_details = employee_detail_number($vl['biller_id']); echo $employee_details['name']; ?></td>

                  <td><?php echo ucwords($vl['status']); ?></td>
                  
                  <td><?php     if($vl['status'] == 'pending'){ ?> 
                                    <a href="javascript:void(0)" link="<?php echo base_url();?>stocks/approve/<?php echo $vl['ID']?>?t=medicine&u=approved" class="xyx btn btn-large" >Approve</a> | <a href="javascript:void(0);" type="investigation" bill="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large" >Disapprove</a>
					            <?php }else {

						  		echo ucwords($vl['status']);

								if($vl['status'] == 'approved'){

									if($vl['remaining_amount'] < 0){ ?>

										<a href="<?php echo base_url();?>stocks/patient_reconcile/<?php echo $vl['receipt_number']?>?t=investigation" class="btn btn-large" >Reconcile to patient</a>

								<?php }

								}

								if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>';}								

							}
					    ?>

                  </td>

                </tr>

              <?php $count++;} ?>
			   <tr>
                <td colspan="7">
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

				window.location.href = '<?php echo base_url();?>stocks/approve/'+bill_id+'?t='+bill_type+'&u='+bill_action+'&r='+disapprove_reason+'';			

			}else{

				$('#disapprove_pop p.error.hidden_field').empty().append('Select any reason!').show();

			}

		});

    </script>

<script>
      //   $(document).on('change',"#billing_at_filter",function(e) {
      //   $('#billing_from_filter').prop('selectedIndex',0);
      //       $('#loader_div').show();
      //       var billing_at = $(this).val();
      //       if(billing_at != ''){
      //         var data = {billing_at:billing_at, type:'billing_at'};
      //         billing_filter(data);
      //       }else{
      //         $('#loader_div').hide();
      //       }
      //   });
      //   $(document).on('change',"#billing_from_filter",function(e) {
      //   $('#billing_at_filter').prop('selectedIndex',0);
      //       $('#loader_div').show();
      //       var billing_from = $(this).val();
      //       if(billing_from != ''){
      //         var data = {billing_from:billing_from, type:'billing_from'};
      //         billing_filter(data);
      //       }else{
      //         $('#loader_div').hide();
      //       }
      //   });
      // $(function() {
      //     $('input[name="daterange"]').daterangepicker({
      //     opens: 'left'
      //     }, function(start, end, label) {
      //         $('#billing_from_filter').prop('selectedIndex',0);
      //         $('#billing_at_filter').prop('selectedIndex',0);
      //       var end = end.add(1, 'days');
      //       console.log("A new date selection was made: " + start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 00:00:00'));
      //       var data = {start:start.format('YYYY-MM-DD 00:00:00'),end:end.format('YYYY-MM-DD 00:00:00'), type:'date_wise'};
      //       billing_filter(data, start.format('YYYY-MM-DD 00:00:00'), end.format('YYYY-MM-DD 00:00:00'));
      //       $(this).datepicker('setDate', null);
      //     });
      // });

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

      
      /*$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data('daterangepicker').setStartDate(moment());
        $(this).data('daterangepicker').setEndDate(moment());
      });*/

      // function billing_filter(data, start, end){ //console.log('23432');
      //     $('#loader_div').show();
      //     $('tbody#consultation_result').empty();
      //     $('tbody#investigate_result').empty();
      //     $('tbody#procedure_result').empty();
      //     $.ajax({
      //         url: '<?php // echo base_url('billings/ajax_accounts_billing_filter')?>',
      //         data: data,
      //         dataType: 'json',
      //         method:'post',
      //         success: function(datax)
      //         {
      //             $("#consultation_billing_list").append(datax.consultant_html);
      //             $('tbody#investigate_result').empty().append(datax.investigation_html);
      //             $('tbody#procedure_result').empty().append(datax.procedure_html);
      //             $('tbody#partial_payment_result').empty().append(datax.payment_html);

      //             var export_billing = $('#export-billing').attr('href');
      //             if(data.type == "date_wise"){
      //               $('#export-billing').attr('href', export_billing+"?type="+data.type+"&start="+start+"&end="+end);
      //             }
      //             if(data.type == "billing_from"){
      //               $('#export-billing').attr('href', export_billing+"?type="+data.type+"&billing_from="+data.billing_from);  
      //             }
      //             if(data.type == "billing_at"){
      //                 $('#export-billing').attr('href', export_billing+"?type="+data.type+"&billing_at="+data.billing_at);  
      //             }
      //           $("ul.pagination").hide();
      //             $('#loader_div').hide();
      //         } 
      //     });
      // }
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