<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Patient Ledger </h3></div>
        <div class="col-sm-12 col-xs-12 patient_ledger_filter">
        	<div class="form-group col-sm-4 col-xs-12 ">
            	<label>Filter by month</label>
                <select class="form-control" id="month_filter">
                	<option value=''>--Select Month--</option>
                    <option value='01'>Janaury</option>
                    <option value='02'>February</option>
                    <option value='03'>March</option>
                    <option value='04'>April</option>
                    <option value='05'>May</option>
                    <option value='06'>June</option>
                    <option value='07'>July</option>
                    <option value='08'>August</option>
                    <option value='09'>September</option>
                    <option value='10'>October</option>
                    <option value='11'>November</option>
                    <option value='12'>December</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12 ">
            	<label>Filter by custom date</label>
                <input type="text" class="daterange_filter" name="daterange" value="" />
            </div>            
        </div>
        <div class="clearfix"></div>
        <div class="card-content">
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
              <tbody id="patient_ledger_body">
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
$(document).on('change',"#month_filter",function(e) {
  $('#loader_div').show();
   var month = $(this).val();
   if(month != ''){
	    $('#patient_ledger_body').empty();
		var data = {month:month, type:'month_wise'};
		ledger_filter(data);
	}else{
		$('#loader_div').hide();
	}
});
$(function() {
	  $('input[name="daterange"]').daterangepicker({
		opens: 'left'
	  }, function(start, end, label) {
	  		//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			var data = {start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD'), type:'custom_wise'};
			ledger_filter(data);
			$(this).datepicker('setDate', null);
	  });
});

$('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
	$(this).val('');
	$(this).data('daterangepicker').setStartDate(moment());
	$(this).data('daterangepicker').setEndDate(moment());
});

$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
	$(this).val('');
	$(this).data('daterangepicker').setStartDate(moment());
	$(this).data('daterangepicker').setEndDate(moment());
});

function ledger_filter(data){
	$.ajax({
			url: '<?php echo base_url('accounts/ajax_patient_ledger')?>',
			data: data,
			dataType: 'json',
			method:'post',
			success: function(data)
			{
				$('#patient_ledger_body').html(data);
				$('#loader_div').hide();
			} 
	});
}
</script>
