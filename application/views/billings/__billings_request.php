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
            </div>
            <div class="form-group col-sm-2 col-xs-12">
            	<a href="<?php echo base_url().'billings/billings'; ?>" class="btn btn-large">Reset filter</a>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <a href="<?php echo base_url('export-billing'); ?>" class="btn btn-large" id="export-billing">Export Billings</a>
            </div>      
          </div>
        <div class="clearfix"></div>
        <div class="card-action"><h3> Consultation Patients </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" data-sort-name="date" data-sort-order="desc" id="consultation_billing_list">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Receipt number</th>
                  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Discounted package</th>
                  <th data-field="date">On Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="consultation_result">
              <?php $count=1; foreach($consultation_result as $ky => $vl){
			  			$patient_data = get_patient_detail($vl['patient_id']);
              $currency = '';
              // if($patient_data['nationality'] == 'indian'){
              //   //$currency = '<i class="fa fa-inr" aria-hidden="true"></i>';
              // }else {
              //   $currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';
              // }
              //$currency = '<i class="fa fa-inr" aria-hidden="true"></i>';
			   ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=consultation"><?php echo $vl['receipt_number']?></a></td>
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  strtoupper($patient_name); ?></td>
                  <td><?php echo $vl['fees']?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo ucwords($vl['status']); if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>'; ?> <a href="<?php echo base_url();?>billings/disapproved/<?php echo $vl['receipt_number']; ?>?t=consultation" class="btn btn-large">edit billing</a><?php }?></td>
                </tr>
              <?php $count++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
       <!--End Consultation  Tables -->

       <script>
          $(document).ready(function() {
              $('#consultation_billing_list').DataTable( {
                  "order": [[ 6, "desc" ]]
              } );
          } );
       </script>
       
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
                  <th>Receipt number</th>
                  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Discounted package</th>
                  <th>On Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="investigate_result">
              <?php $count=1; foreach($investigate_result as $ky => $vl){
			  			$patient_data = get_patient_detail($vl['patient_id']);
						$currency = '';
						// if($patient_data['nationality'] == 'indian'){
						// 	//$currency = '<i class="fa fa-inr" aria-hidden="true"></i>';
						// }else {
						// 	$currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';
            // }
            //$currency = '<i class="fa fa-inr" aria-hidden="true"></i>';
			  
			   ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=investigation"><?php echo $vl['receipt_number']?></a></td>
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  strtoupper($patient_name); ?></td>
                  <td><?php echo $vl['fees']?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo ucwords($vl['status']); if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>'; ?> <a href="<?php echo base_url();?>billings/disapproved/<?php echo $vl['receipt_number']; ?>?t=investigation" class="btn btn-large">edit billing</a><?php }?></td>
                </tr>
              <?php $count++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
       <!--End Investigation Tables -->
       
       <script>
          $(document).ready(function() {
              $('#investigation_billing_list').DataTable( {
                  "order": [[ 6, "desc" ]]
              } );
          } );
       </script>
       
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
                  <th>Receipt number</th>
                  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Discounted package</th>
                  <th>On Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="procedure_result">
              <?php $count=1; foreach($procedure_result as $ky => $vl){
			  			$patient_data = get_patient_detail($vl['patient_id']);
              $currency = '';
              // if($patient_data['nationality'] == 'indian'){
              //   //$currency = '<i class="fa fa-inr" aria-hidden="true"></i>';
              // }else {
              //   $currency = '<i class="fa fa-usd" aria-hidden="true"></i> ';
              // }
              //$currency = '<i class="fa fa-inr" aria-hidden="true"></i>';
			  
			  ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=procedure"><?php echo $vl['receipt_number']?></a></td>
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php $patient_name = $all_method->get_patient_name($vl['patient_id']); echo  strtoupper($patient_name); ?></td>
                  <td><?php echo $vl['fees']?></td>
                  <td><?php echo $vl['on_date']?></td>
                  <td><?php echo ucwords($vl['status']); if($vl['status'] == 'disapproved'){echo ' <i class="fa fa-exclamation-circle" aria-hidden="true" title="'.$vl['reason_of_disapprove'].'"></i>'; ?> <a href="<?php echo base_url();?>billings/disapproved/<?php echo $vl['receipt_number']; ?>?t=procedure" class="btn btn-large">edit billing</a><?php }?></td>
                </tr>
              <?php $count++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Procedure Tables -->
      <script>
          $(document).ready(function() {
              $('#procedure_billing_list').DataTable( {
                  "order": [[ 6, "desc" ]]
              } );
          } );
       </script>
      <!--End Advanced Tables -->
    </div>
    
<script>
      $(function() {
          $('input[name="daterange"]').daterangepicker({
          opens: 'left'
          }, function(start, end, label) {
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
              url: '<?php echo base_url('billings/ajax_center_billing_filter')?>',
              data: data,
              dataType: 'json',
              method:'post',
              success: function(data)
              {
                  $("#consultation_billing_list").append(data.consultant_html);
                  $('#consultation_billing_list_length').hide();
                  $('#consultation_billing_list_filter').hide();
                  $('#consultation_billing_list_paginate').hide();
                  
                  $('tbody#investigate_result').empty().append(data.investigation_html);
                  $('#investigation_billing_list_length').hide();
                  $('#investigation_billing_list_filter').hide();
                  $('#investigation_billing_list_paginate').hide();
                  
                  $('tbody#procedure_result').empty().append(data.procedure_html);
                  $('#procedure_billing_list_length').hide();
                  $('#procedure_billing_list_filter').hide();
                  $('#procedure_billing_list_paginate').hide();
                  
                  var export_billing = $('#export-billing').attr('href');
                  $('#export-billing').attr('href', export_billing+"?start="+start+"&end="+end);

                  $('#loader_div').hide();
              } 
          });
      }
</script>