<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="card" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Purchase Record </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'orders/purchase_item'; ?>" method="get">
		   
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
                <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $end_date;?>" />
            </div>
           <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Batch Number</label>
                <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $batch_number;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Invoice No</label>
                <input type="text" class="form-control" id="invoice_no" name="invoice_no" value="<?php echo $invoice_no;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>PO No</label>
                <input type="text" class="form-control" id="purchase_po_no" name="purchase_po_no" value="<?php echo $purchase_po_no;?>" />
            </div>
            <div class="col-sm-3 col-sm-6 col-xs-12">
              <label for="item_name">Vendors (Required)</label>
                <select class="select2 form-control" name="vendor_name" id="vendor_name">
                    <option value="">-- Select --</option>
                    <?php if(!empty($vendors)){
                      foreach($vendors as $key => $val){ $selected=""; if($val['vendor_number'] ==  $data['vendor_number']){$selected='selected="selected"';} 
                    ?>
                        <option value="<?php echo $val['name']?>" <?php echo $selected; ?>><?php echo $val['name']?></option>
                      <?php } }?>
                </select>
            </div>
			<div class="col-sm-3 col-sm-6 col-xs-12">
			 <label for="item_name">Brands (Required) <?php //echo $all_method->get_brand_name($data['brand_name']);?></label> 
					<select class="form-control select2" name="brand_name" id="brand_name">
					 <option value="">-- Select --</option>
                      <?php 
                      if(!empty($brands)){
                        foreach($brands as $key => $val){ $selected=""; if($val['brand_number'] ==  $data['brand_name']){$selected='selected="selected"';}  
                      ?>
                          <option value="<?php echo $val['brand_number']?>" <?php echo $selected; ?>><?php echo $val['name']?></option>
                        <?php } }?>
                  </select>
          </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'orders/purchase_item'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			      <div class="col-sm-1" style="margin-top: 10px;">
            <a href="<?php echo base_url('orders/Medicine-Stock-Reports'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Medicine</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">

             <thead>
                <tr>
				
				  <th>Item Name</th>
				  <th>HSN Code</th>
				  <th>Purchase Po No</th>
				  <th>Date Of Purchase</th>
				  <th>Purchase Invoice No</th>
				  <th>Vendor Name</th>
				  <th>Company</th>
				  <th>Batch</th>
				  <th>Expiry</th>
				  <th>MRP</th>
				  <th>Rate Per Unit</th>
				  <th>Quantity</th>
				  <th>Total Purchase Value</th>
				  <th>Freight & Forwarding Charge</th>
				  <th>Discount Rate (%)</th>
				  <th>Discount Amount</th>
				  <th>Free Quantity</th>
				  <th>Total After Discount (Exc GST)</th>
				  <th>GST Rate %</th>
				  <th>Total Purchase Value (Incl Gst)</th>
				  <th>Category</th>
				  <th>Center</th>
				  <th>Receive Date</th>
				  <th>Receive By</th>
				  <th>File</th>
                </tr>
              </thead>

              <tbody id="investigate_result">

              <?php $count=1; foreach($orders_result as $ky => $vl){  ?>

					<tr class="odd gradeX">
						<td><?php echo $vl['item_name']?></td>
				        <td><?php echo $vl['hsn']?></td>
						<td><?php echo $vl['purchase_po_no'];?></td>
						<td><?php echo $vl['date_of_purchase'];?></td>
				        <td><?php echo $vl['invoice_no'];?></td>
						<td><?php echo $vl['vendor_name'];?></td>
				        <td><?php echo $vl['company']?></td>
				        <td><?php echo $vl['batch_number'];?></td>
				        <td><?php echo $vl['expiry']; ?></td>
						<td><?php echo $vl['mrp'];?></td>
						<td><?php echo $vl['rate_per_unit']; ?></td>
						<td><?php echo $vl['quantity']; ?></td> 
						<td><?php echo $vl['total_purchase_value_excl_gst']; ?></td>  
						<td><?php echo $vl['freight_forwarding_charges']; ?></td>  
						<td><?php echo $vl['discount_rate']?></td>
						<td><?php echo $vl['discount_amt'];?></td>
						<td><?php echo $vl['free_quantity'];?></td>
						<td><?php echo $vl['total_purchase_after_discount_exculding_gst'];?></td> 
						<td><?php echo $vl['gstrate'];?></td>
						<td><?php echo $vl['total_purchase_value_incl_gst'];?></td> 
						<td><?php echo $vl['category'];?></td> 				
						<td><?php echo $all_method->get_center_name($vl['centre_location']); ?></td>
				        <td><?php echo $vl['date_of_receiving'];?></td>
				        <td><?php echo $vl['received_by'];?></td>
						<td><a href="<?php echo $vl['vendor_billing'];?>" target="_blank" ><?php echo $vl['vendor_billing'];?></a></td>				   
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
	