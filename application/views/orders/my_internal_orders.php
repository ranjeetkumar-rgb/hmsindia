 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3>Order status</h3></div>
         <div class="clearfix"></div>
		  <form action="<?php echo base_url().'orders/my_internal_orders'; ?>" method="get">
		 <!-- <div class="form-group col-sm-3 col-xs-12">
              <label for="item_name">Vendors</label>
                <select class="select2 form-control" name="vendor_number" id="vendor_number">
                    <option value="">-- Select --</option>
                    <?php if(!empty($vendors)){
                      foreach($vendors as $key => $val){  
                    ?>
                        <option value="<?php echo $val['vendor_number'] ?>"><?php echo $val['name']?></option>
                      <?php } }  ?>
                </select>
            </div>
		   <div class="col-sm-3 col-xs-12">
            <label>Status</label>
             <select class="form-control mt-20" id="purchase_order" name="purchase_order">
                	<option value="">-- Select Status --</option>
					<option value="0">Pending</option>
                    <option value="1">Approved</option>
                	<option value="2">Disapproved</option>
            </select>
			</div>
      <div class="form-group col-sm-3 col-xs-12">
              <label for="expiry">Ship To</label>
               <select name="ship_to" id="ship_to" class="form-control" readonly="" required>
			   <option value="">- - Select Center - -</option>
				<?php 
				/* $all_centers = $all_method->get_all_centers();
				foreach ($all_centers as $val) { 
				// Check if the current center matches the selected one
				$selected = ($center == $val['ship_to']) ? '' : '';
				// Use `center_number` as the value (if needed) or `ship_to`
				echo '<option value="' . $val['center_number'] . '" ' . $selected . '>' . $val['center_name'] . '</option>';
				} */
				?>
				</select>
			  </div>
            <div class="col-sm-3 col-xs-12">
            	<label>Start Date</label>
                <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>-->
			<div class="col-sm-3 col-xs-12">
            	<label>PO Number</label>
                <input type="text" class="form-control" id="po_number" name="po_number" value="<?php echo $po_number;?>" />
            </div>
			<div class="col-sm-3 col-xs-12">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-3" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            	<a href="<?php echo base_url().'orders/my_internal_orders'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
        <div class="card-content">
		
          <div class="table-responsive">
		  <form action="" method="POST">
            <table class="table table-striped table-bordered table-hover" id="">
              <thead>
                <tr>
					<th>PO number</th>
					<th>Item Number</th>
					<th>Item name</th>
				    <th>Company</th>
				    <th>Vendor</th>
				    <th>Brand</th>
					<th>Quantity (Unit)</th>
					<th>Receive (Unit)</th>
					<th>Quantity (Pack)</th>
				    <th>MRP (Pack)</th>
					<th>Batch Number:</th>
				    <th>Vendor Price Without GST (Pack)</th>
				    <th>GST Amount:</th>
				    <th>Vendor Price With GST:</th>
					<th>Total Vendor Price With GST:</th>
				    <th>GST Rate:</th>
				    <th>Order Date</th>
					<th>Department</th>
				    <th>Approved Date</th>
				    <th>Order Place Date</th>
					<th>Ship To</th>
					<th>Bill To</th>
				    <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=1; foreach($data as $ky => $vl){ 
                $order_number = $vl['order_number'];    
                $sql = "SELECT order_number, SUM(quantity) AS total_quantity FROM hms_vendor_billing WHERE order_number = '$order_number' GROUP BY order_number";
                $result = run_select_query($sql); // Assuming `run_select_query` fetches the results
				
				$sql2 = "SELECT * FROM hms_centers WHERE center_number='" . $vl['ship_to'] . "'";
				$select_result2 = run_select_query($sql2);

				$sql = "SELECT * FROM hms_centers WHERE center_number='" . $vl['bill_to'] . "'";
				$select_result = run_select_query($sql);
				
				$sql3 = "SELECT * FROM hms_stocks WHERE item_number='" . $vl['item_number'] . "'";
				$select_result3 = run_select_query($sql3);
              ?>
                <tr class="odd gradeX">
					<td>
					<?php if($vl['purchase_order']== '1'){ ?>
					<a href="<?php echo base_url();?>stocks/order_items/?po_number=<?php echo $vl['po_number'];?>"><?php echo $vl['po_number']?></a>
					<?php }else{ echo $vl['po_number']; } ?>
					</td>
					<td><?php echo $vl['item_number']; ?></td>
					<td><?php if(!empty($all_method->get_a_item_name($vl['item_number']))){ echo $all_method->get_a_item_name($vl['item_number']);} else{echo '';} ?></td>
					<td><?php echo $vl['company'];?></td>
					<td><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
					<td><?php echo $all_method->get_brand_name($select_result3['brand_name']);?></td>
					<td><?php echo $vl['pack_size'] * $vl['order_qty_pack']; ?></td>
					<td><?php echo $result['total_quantity']; ?></td>
                    <td><?php echo $vl['order_qty_pack']?></td>
					<td><?php echo $vl['mrp']; ?></td>
					<td><?php echo $vl['batch_number']; ?></td>
					<td><?php echo ($vl['gstdivision'] != 0 && !empty($vl['gstdivision'])) ? round($vl['vendor_price'] / $vl['gstdivision'], 2) : 0; ?></td>
					<td><?php
echo (!empty($vl['gstdivision']) && $vl['gstdivision'] != 0)
    ? round($vl['vendor_price'] - ($vl['vendor_price'] / $vl['gstdivision']), 2)
    : 0;
?>
</td>
					<td><?php echo $vl['vendor_price'];  ?></td>
					<td><?php echo $vl['total_vendor_price'];  ?></td>
					<td><?php echo substr($vl['gstdivision'],2); ?></td>
					<td><?php echo $vl['create_date']; ?></td>
					<td><?php echo $vl['center']; ?></td>
					<td><?php echo $vl['update_date']; ?></td>
					<td><?php if (!empty($vl['order_place'])) { echo $vl['order_place']; }else{ if($vl['purchase_order']== '1'){ ?> <a class="btn btn-primary" href="<?php echo base_url('orders/order_internal_place_date/'.$vl['order_number'].'');?>">Order Place</a> <?php }} ?></td>
					<td><?php 	echo $select_result2['center_name']."/".$select_result2['center_address']; ?></td>
					<td><?php echo $select_result['center_name'].",".$select_result['center_address']; ?></td>
					<td><?php if($vl['purchase_order'] == 0){echo 'approval pending from indiaivf';}else{
					if($vl['replaced'] == '1'){ echo "Order replaced";}
					else{ if($vl['received']== '0'){ ?> 
					<a class="btn btn-primary" href="<?php echo base_url();?>orders/update_internal_order_item/<?php echo $vl['item_number']?>?i=<?php echo $vl['ID'];?>">Add to stock</a>
					<?php 
					}else{
						
						echo "Received";
						if ($vl['order_quantity'] != $result['total_quantity']) {
							?>
					<a class="btn btn-primary" href="<?php echo base_url();?>orders/update_internal_order_item/<?php echo $vl['item_number']?>?i=<?php echo $vl['ID'];?>">Add to stock</a>
					<?php }}}} ?>
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
			</form>
          </div>
        </div>
      </div>
      <!-- End Advanced Tables  -->
	</div>
                  
    <script type="text/javascript">
        function change_status(product_id, status, order_quantity) {
            let conf_msg = (status == 1) ? 'Pending' : 'Order';
            let confirmation = confirm('Are you sure, want to ' + conf_msg + ' this item ');
            if (confirmation == true) {
                window.location.href = "<?php echo base_url();?>Orders/check_status/"+product_id+"/"+status+"/"+order_quantity;
            }
            return true
        }
        function update_stock(product_id, status, order_quantity)
        {
          if(status == 1)
          {
            window.location.href = "<?php echo base_url();?>Orders/update_stock/"+product_id+"/"+status+"/"+order_quantity; 
            $(this).attr('disabled', 'disabled');          
          }
        }
    </script>
	
<script>

      $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
		  changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd h:m:s", $(this).datepicker('getDate'));
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
select {
    display: block !important;
}
</style>	