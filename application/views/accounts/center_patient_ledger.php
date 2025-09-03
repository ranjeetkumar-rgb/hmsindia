<?php $all_method =&get_instance(); //var_dump($_SESSION['logged_accountant']);die; ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
          <div class="card-action"><h3>Filter data</h3></div>
	        <div class="col-sm-12 col-xs-12 patient_ledger_filter">
            <div class="form-group col-sm-4 col-xs-12 ">
            	<label>Filter by custom date</label>
              <input type="text" class="daterangefilter" id="qwdsa" name="daterange" value="" />
            </div>
            <div class="form-group col-sm-4 col-xs-12">
            	<a href="<?php echo base_url().'accounts/center_patient_ledger'; ?>" class="btn btn-large">Reset filter</a>
            </div>            
          </div>
        <div class="clearfix"></div>
        <div class="card-action"><h3> Patient Ledger </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
        <a href="<?php echo base_url('download-ledger'); ?>" id="download_ledger" class="btn btn-success pull-right" target="_blank">Download Ledger</a>
        <div class="clearfix"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>IIC ID</th>
                  <th>Name of patient</th>
                  <th>Discounted package</th>
                  <th>Received amount</th>
                  <th>Remaining amount</th>
                  <th>IIC share</th>
                  <th>Centre share</th>
                  <th>Amount recieved at IIC</th>
                  <th>Amount recieved at centre</th>
                </tr>
              </thead>
              <tbody id="table_patient_ledger">
              <?php foreach($data as $ky => $vl){ 
                $current_balance = $all_method->get_current_balance($vl['patient_id']);
                $payment_at = $all_method->get_payment_at($vl['patient_id']);
			        ?>              
                <tr class="odd gradeX">
                  <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                  <td><?php echo strtoupper($vl['patient_name']); ?></td>
                  <td><?php echo $vl['total']; ?></td>
                  <td><?php echo ($vl['total'] - $current_balance); ?></td>
                  <td><?php echo $current_balance; ?></td>                  
                  <td><?php echo $vl['payment_ivf_share']; ?></td>
                  <td><?php echo $vl['payment_center_share']; ?></td>
                  <td><?php echo $payment_at['payment_ivf']; ?></td>
                  <td><?php echo $payment_at['payment_center']; ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>

 
<script>
		$(function() {
			  $('input[name="daterange"]').daterangepicker({
				opens: 'left',
			  }, function(start, end, label) {
          var end = end.add(1, 'days');
					console.log("A new date selection was made: " + start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 00:00:00'));
					var data = {start:start.format('YYYY-MM-DD 00:00:00'),end:end.format('YYYY-MM-DD 00:00:00'), type:'date_wise'};
					patient_ledger_filter(data, start.format('YYYY-MM-DD 00:00:00'), end.format('YYYY-MM-DD 00:00:00'));
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

		function patient_ledger_filter(data, start, end){ //console.log('23432');
        $('#loader_div').show();
        $('#table_patient_ledger').empty();
        $.ajax({
            url: '<?php echo base_url('accounts/ajax_center_patient_ledger')?>',
            data: data,
            dataType: 'json',
            method:'post',
            success: function(data)
            {
                $('#table_patient_ledger').append(data);
                var download_url = $('#download_ledger').attr('href');
                download_url = download_url+"?start="+start+"&end="+end;
                $('#download_ledger').attr('href', download_url);
                $('#loader_div').hide();
            } 
        });
		}
</script>