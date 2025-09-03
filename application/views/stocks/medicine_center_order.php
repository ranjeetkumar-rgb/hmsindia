 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Medicine Center Order </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/medicine_center_order'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                <select class="form-control" id="center_number" name="center_number">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($center_number == $val['center_number']){
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
            	<label>Medicine Name </label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/medicine_center_order'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
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
				  
				  <th>Center</th>

                  <th>Item Name</th>

                  <th>Quantity</th>

                  <th>Order Date</th>

                </tr>

              </thead>

              <tbody id="investigate_result">

              <?php $count=1; foreach($investigate_result as $ky => $vl){   ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>
				  
				  <td><?php echo $all_method->get_employee_name($vl['employee_number']); ?></td>

                  <td><?php echo $vl['item_name']; ?></td>

			      <td><?php echo $vl['quantity']; ?></td>

                  <td><?php echo $vl['on_date']?></td>

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