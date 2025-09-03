<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="card" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Purchase Orders </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'orders/purchase_orders_list'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            <label>Status</label>
             <select class="form-control mt-20" id="purchase_order" name="purchase_order">
                	<option value="">-- Select Status --</option>
                    <option value="1">Approved</option>
                	<option value="2">Disapproved</option>
            </select>
			</div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
                <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $end_date;?>" />
            </div>
           <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
           
            <div class="col-sm-2" style="margin-top: 10px;">
            <button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            	<a href="<?php echo base_url().'orders/purchase_orders_list'; ?>" style="text-decoration: none;">
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
                  <th>Order number</th>
                  <th>Item code</th>
                  <th>Item name</th>
				  <th>Brand Name</th>
				  <th>Vendor Name</th>
                  <th>Quantity Ordered (Unit)</th>
                  <th>Quantity Ordered (Pack)</th>
				  <th>Vendor Price (Unit)</th>
				  <th>Vendor Price (Pack)</th>
				  <th>MRP (Pack)</th>
				  <th>Pack Size</th>
                  <th>Total Vendor Price Inc. GST (Pack)</th>
                  <th>Order date</th>
                  <th>Ship To</th>
                  <th>Bill To</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="investigate_result">
              <?php $count=1; foreach($orders_result as $ky => $vl){ 
				$sql3 = "SELECT * FROM hms_stocks WHERE item_number='" . $vl['item_number'] . "'";
				$select_result3 = run_select_query($sql3);
				
				$sql2 = "SELECT * FROM hms_centers WHERE center_number='" . $vl['ship_to'] . "'";
				$select_result2 = run_select_query($sql2);

				$sql = "SELECT * FROM hms_centers WHERE center_number='" . $vl['bill_to'] . "'";
				$select_result = run_select_query($sql);
			  ?>
               <tr class="odd gradeX">
                  <td><?php if($vl['replaced'] == '0'){?>
					        <a href="<?php echo base_url();?>orders/my_order_details/<?php echo $vl['order_number']?>"><?php echo $vl['order_number']?></a>
                  <?php }else { ?>
	                <?php echo $vl['order_number']?>
                  <?php } ?> </td>
                  <td><a href="<?php echo base_url(); ?>stocks/details/<?php echo $vl['item_number']?>"><?php echo $vl['item_number']?></a> 
                  <?php if($vl['replaced'] == '1'){?> (Replaced)<?php } ?>
                  </td>
                  <td><?php if(!empty($all_method->get_a_item_name($vl['item_number']))){ echo $all_method->get_a_item_name($vl['item_number']);} else{echo '';} ?></td>
                  <td><?php echo $all_method->get_brand_name($select_result3['brand_name']);?></td>
				  <td><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
				  <td><?php echo $vl['pack_size'] * $vl['order_qty_pack']; ?> (units)</td>
                  <td><?php echo $vl['order_qty_pack']; ?> (Pack)</td>
				  <td><?php echo round($vl['vendor_price'] / $vl['pack_size'],2); ?></td>
				  <td><?php echo $vl['vendor_price']; ?></td>
				  <td><?php echo $vl['mrp']; ?></td>
				  <td><?php echo $vl['pack_size']; ?></td>
                  <td><?php echo $vl['total_vendor_price']; ?></td>
                  <td><?php echo $vl['create_date']?></td>
                  <td><?php echo $select_result2['center_name']."/".$select_result2['center_address'];; ?></td>
                  <td><?php echo $select_result['center_name']."/".$select_result2['center_address'];; ?></td>
                  <td>  <?php if($_SESSION['logged_administrator']['username'] == "ceo@indiaivf.in"){ ?>
					<a href="<?php echo base_url('orders/update_purchase_order/'.$vl['order_number'].'');?>" class="btn btn-large">Edit</a>
					<?php if($vl['purchase_order'] == 1){ echo "Approved";}elseif($vl['purchase_order'] == '2'){echo "Disapproved"; }elseif($vl['purchase_order'] == '0'){echo "Pending"; }else{echo "Pending"; } ?>
				    <?php	if($vl['purchase_order'] == 0){ ?>
					<a href="javascript:void(0);" class="btn btn-large" onclick="approveOrder('<?php echo $vl['order_number']; ?>')">Approve</a>
					<!--<a href="<?php echo base_url('orders/approve_internal_purchase_order/'.$vl['order_number'].'');?>" class="btn btn-large">Approve</a>-->
					| <a href="<?php echo base_url('orders/disapprove_internal_purchase_order/'.$vl['order_number'].'');?>" class="btn btn-large">Disapprove</a>
					<?php }}else{ ?>
				    <?php if ($vl['purchase_order'] == 1) { ?> <?php } ?>
				    <?php if($vl['purchase_order'] == 1){ echo "Approved";}elseif($vl['purchase_order'] == '2'){echo "Disapproved"; }elseif($vl['purchase_order'] == '0'){echo "Pending"; } ?>
				    <?php if($vl['purchase_order'] == 2 || $vl['purchase_order'] == 0) { ?>
					<a href="<?php echo base_url('orders/update_purchase_order/'.$vl['order_number'].'');?>" class="btn btn-large">Edit</a>
					<?php }} ?>
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

       <!--End Investigation Tables -->
</div>

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

<script type="text/javascript">
    function approveOrder(orderNumber) {
        if (confirm('Are you sure you want to approve this order?')) {
            $.ajax({
                url: '<?php echo base_url('orders/approve_internal_purchase_order/'); ?>' + orderNumber,
                type: 'POST', // Use 'POST' if necessary
                success: function(response) {
                    // Success handling, for example, show an alert and update the UI
                    alert('Order approved successfully!');
                    // Optionally, update the UI (like changing button text or removing the row)
                    // $("#row_" + orderNumber).remove(); // If you want to remove the row
                },
                error: function(xhr, status, error) {
                    // Handle the error, display an error message
                    alert('Something went wrong. Please try again.');
                    console.log(xhr.responseText); // For debugging
                }
            });
        }
    }
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
	