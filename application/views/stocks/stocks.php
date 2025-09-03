<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
	  <div class="card-action"><h3>Master Central Item Sheet</h3></div>
         <div class="clearfix"></div>
      <form action="<?php echo base_url().'stocks/stocks'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Expiry Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Expiry End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Generic Name</label>
                <input type="text" class="form-control" id="generic_name" name="generic_name" value="<?php echo $generic_name;?>" />
            </div>
			      <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Batch Number</label>
                <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $batch_number;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Item Number</label>
                <input type="text" class="form-control" id="item_number" name="item_number" value="<?php echo $item_number;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/stocks'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			<div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('stocks/Central-Medicine'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Medicine</button>
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
				  <th>Generic Name</th>
				  <th>Company</th>
				  <th>Item Id</th>
                  <th>Product Id</th>
				  <th>Item name</th>
				  <th>Vendor</th>
				  <th>Brand</th>
				  <th>Batch No</th>
				  <th>Category</th>
				  <th>Vendor Price Without GST</th>
				  <th>MRP</th>
				  <th>GST Rate</th>
				  <th>GST (Amount)</th>
				  <th>Vendor price with GST</th>
				  <th>Pack Size</th>
                  <th>Unit quantity</th>
                  <th>Expiry</th>
				  <th>Safety stock (Unit qty)</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="table_content">
              <?php $count=1; foreach($investigate_result as $vl){
                       // var_dump($vl);die; 		
					if (!empty($vl['gstdivision']) && $vl['gstdivision'] != 0) {
    $gstamount = $vl['vendor_price'] / $vl['gstdivision'];
} else {
    $gstamount = 0; // Or set a fallback value or error message
}

                 ?>			 
					<tr class="odd gradeX">
				        <td><?php echo $vl['generic_name']?></td>
				        <td><?php echo $vl['company'];?></td>
				        <td><a href="<?php echo base_url(); ?>stocks/details/<?php echo $vl['item_number']?>"><?php echo $vl['item_number']?></a></td>
						<td><?php echo $vl['product_id']?></td>
						<td><?php echo $vl['item_name']?></td>
				        <td><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
				        <td><?php echo $all_method->get_brand_name($vl['brand_name']);?></td>
				        <td><?php echo $vl['batch_number']?></td>
				        <td><?php $category_name = $all_method->get_category_name($vl['category']); echo $category_name; ?></td>
						<td><?php echo round($gstamount,2) ?></td>
                        <td><?php echo $vl['mrp']; ?></td>
                        <td><?php echo $vl['gstrate']; ?></td>
						<td><?php echo round($vl['vendor_price']- $gstamount,2) ?></td>
						<td><?php echo $vl['vendor_price']; ?></td>
						<td><?php echo $vl['pack_size']; ?></td> 
						<td><?php echo $vl['quantity']?></td>
						<?php
				  // Assuming $vl['expiry'] is the expiry date in 'Y-m-d' format
				  $expiryDate = new DateTime($vl['expiry']);
				  $today = new DateTime();
				  $twoMonthsFromNow = (clone $today)->modify('+2 months');
				  $color = '';
				  if ($expiryDate <= $twoMonthsFromNow) {
				  $color = 'style="color: red;font-weight:800"'; // Set the color to red if within 2 months
				  }
				  ?>
                  <td <?php echo $color; ?>><?php echo $vl['expiry']; ?></td>
						<td><?php echo $vl['safety_stock']; ?></td>
				        <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?><?php echo $_SESSION['logged_stock_manager']['name']; ?> </td>
						<td><?php if (isset($_SESSION['logged_central_stock_manager']['username']) && $_SESSION['logged_central_stock_manager']['username'] === "sahil.kumar@indiaivf.in") { ?>
    					<a href="<?php echo base_url();?>stocks/edit?item_number=<?php echo $vl['item_number']?>" class="edit"><i class="material-icons">edit</i></a>
						<!--<a href="<?php echo base_url();?>stocks/delete?item_number=<?php echo $vl['item_number']?>" class="delete"><i class="material-icons">delete</i></a>--> 
						<?php } ?>
						</td>
					</tr>
              <?php $count++;} ?>
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