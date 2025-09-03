<!-- View for both inventory dispense Procedure and Investigation -->
 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
      <div class="card-action"><h3>Patient Inventory Dispense (Procedure)</h3></div>
      <!-- <div class="col-sm-12 col-xs-12 patient_ledger_filter">
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
        </div> -->
      <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="dispense_list">
              <thead>
                <tr>
                  <th>SR. No.</th>
                  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Reciept Number</th>
                  <th>Centre Number</th>
                  <th>Added On</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="procedure_html_body">
              <?php $no = 1; foreach($alldata as $key => $vl){ 
                $procedure =unserialize($vl['data']); 
                $patient = get_patient_detail($vl['patient_id']);
               // $centre = get_patient_detail($vl['patient_id']);
					    	//var_dump($patient);die;
			  ?>
                <tr class="odd gradeX">
                  <td><?php echo $no++;?></td>
                  <td><?php echo $vl['patient_id'] ?></td>
                  <td><?php echo strtoupper($patient['wife_name']);?></td>
                  <td><?php echo (isset($vl['receipt_number']))  ? $vl['receipt_number']  : '-';?></td>
                  <td><?php echo strtoupper(get_center_name($vl['center_number']));?></td>
                  <td><?php echo $vl['add_on'];?></td>
                  <?php echo "<td><a href='".base_url('stocks/dispense_details/'.$vl['ID'])."' class='btn btn-primary'>Detail</a></td>";?>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
<!-- Code End -->
<!-- Advanced Tables -->

<!-- <script>
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
			url: '<?php echo base_url('orders/ajax_inventory_dispense')?>',
			data: data,
			dataType: 'json',
			method:'post',
			success: function(data)
			{
				$('#procedure_html_body').html(data.procedure_html);
				$('#investigation_html_body').html(data.investigations_html);
				$('#loader_div').hide();
			} 
	});
}
</script> -->