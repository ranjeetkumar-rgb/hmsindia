<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
	 <div class="card">
         <div class="col-md-12"><h3>Return Stock List </h3></div>
        <form action="<?php echo base_url().'stocks/return_list'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by Employee Name</label>
                <select class="form-control" id="employee_number" name="employee_number">
                	<option value=''>--Select From--</option>
                    <?php $all_emplyee = $all_method->get_employee_list();
						            foreach($all_emplyee as $key => $val){ //var_dump($val);die;
                          if($employee_number == $val['employee_number']){
                            echo '<option value="'.$val['employee_number'].'" selected>'.$val['name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['employee_number'].'">'.$val['name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Item Name </label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            <label>Batch Number </label>
                <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $invoice_no;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3" style="margin-top: 10px;">
                <button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            	<a href="<?php echo base_url().'stocks/return_list'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">
              <thead>
                 <tr>
				  <th>Center Name</th>
                  <th>Item name</th>
                  <th>Quantity (units)</th>
                  <th>Expiry Date</th>
                  <th>Return Date</th>
                  <th>Delivery status</th>
				  <th>Status</th>
                  <th>Ation</th>
                </tr>
              </thead>
              <tbody id="invoice_result">
              <?php foreach($invoice_result as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $all_method->get_employee_name($vl['employee_number']); ?></td> 
                  <td><?php echo $vl['item_name']; ?></td>
                  <td><?php echo $vl['quantity']?></td>
                  <td><?php echo $vl['expiry']?></td>
                  <td><?php echo $vl['return_date']; ?></td>
                  <td><?php echo $vl['reason']; ?></td>
				  <td><?php echo $vl['status']; ?></td>
                  <td>
				  <a class="btn" href="<?php echo base_url();?>stocks/add_stock/<?php echo $vl['item_number']?>?i=<?php echo $vl['ID']; ?>">Add to stock</a>
				  <a class="btn" href="<?php echo base_url();?>stocks/update_return_item/<?php echo $vl['item_number']?>?i=<?php echo $vl['ID']; ?>">Discard</a>
				  <a class="btn" href="<?php echo base_url();?>stocks/return_vendor/<?php echo $vl['item_number']?>?i=<?php echo $vl['ID']; ?>">Return Vendor</a>
                  </td>
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
	   </div>
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