	  <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
     <div class="card">
     <div class="col-md-12"><h3>Vendors Product Return List</h3></div>
		<form action="<?php echo base_url().'stocks/vendor_return_list'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
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
           <div class="col-sm-3 col-xs-12">
            	<label>Expiry Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>Expiry End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
			<div class="col-sm-3 col-xs-12">
            	<label>Batch No</label>
                <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $batch_number;?>" />
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>Item Number</label>
                <input type="text" class="form-control" id="item_number" name="item_number" value="<?php echo $item_number;?>" />
            </div>
            <div class="col-sm-5" style="margin-top: 20px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            <a href="<?php echo base_url().'stocks/vendor_return_list'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            	<a href="<?php echo base_url('stocks/All-Vendor-Return-Medicine'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing"  onclick="backupDatabase();">Export</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
       
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover stock_list1" id="centre_stock_list1">
              <thead>
                 <tr>
				  <th>Center Name</th>
                  <th>Item name</th>
                  <th>Quantity (units)</th>
                  <th>Expiry Date</th>
                  <th>Return Date</th>
                  <th>Delivery status</th>
				</tr>
              </thead>
              <tbody id="table_content">
              <?php $count=1; foreach($vendor_return as $vl){ ?>
                <tr class="odd gradeX">
                   <td> <?php echo $all_method->get_employee_name($vl['employee_number']); ?></td> 
                  <td><?php echo $vl['item_name']; ?></td>
                  <td><?php echo $vl['quantity']?></td>
                  <td><?php echo $vl['expiry']?></td>
                  <td><?php echo $vl['return_date']; ?></td>
                  <td><?php echo $vl['reason']; ?></td>
				</tr>
              <?php $count++;} ?>
			   <tr>
                <td colspan="16">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
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
 a#export_stock {
		text-align: right;
		width: 100%;
		display: block;
		color: #000;
		margin-bottom:10px;
 	  }
	  .card .card-action{padding:45px 15px!important;}
</style>