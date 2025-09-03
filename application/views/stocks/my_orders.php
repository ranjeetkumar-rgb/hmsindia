 <?php $all_method =&get_instance();
       echo $sql3 = "SELECT po_number FROM `hms_ponumber` ORDER BY ID DESC LIMIT 1";
       $select_result3 = run_select_query($sql3);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderNumbers = $_POST['order_numbers'];
	
$currentYearMonth = date('Ym') + 1; // e.g., '202407' for July 2024
$poNumber = substr(str_pad($select_result3['po_number'], 2, '0', STR_PAD_LEFT), -2) +1;
// Concatenate the year-month with the PO number
$fullPONumber = $currentYearMonth . $poNumber;

    // Generate and update PO number for each order number
    foreach ($orderNumbers as $orderNumber) {
		
        // Update the database with the generated PO number
        $sql = "UPDATE hms_orders SET po_number = '$poNumber' WHERE order_number = '$orderNumber'";
        $result = run_form_query($sql); 
        echo $sql2 = "INSERT INTO hms_ponumber (order_number, po_number, created) VALUES ('$orderNumber', '$fullPONumber', '".date("Y-m-d")."')";
        $result = run_form_query($sql2);
        if ($result) {
            echo "Order number $orderNumber assigned PO number $poNumber.<br>";
        } else {
            echo "Error inserting record for order number $orderNumber: " . $conn->error . "<br>";
        }		        
    }
}
    $date=date_create("2024-07-25");
    if (date_format($date,"m") >= 4) {//On or After April (FY is current year - next year)
        $financial_year = (date_format($date,"y")) . '-' . (date_format($date,"y")+1);
    } else {//On or Before March (FY is previous year - current year)
        $financial_year = (date_format($date,"y")-1) . '-' . date_format($date,"y");
    }
    $psno = "PSPL/".$financial_year."/".date("F")."/";
	
?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3>Order status</h3></div>
         <div class="clearfix"></div>
		  <form action="<?php echo base_url().'orders/my_orders'; ?>" method="get">
		  <div class="form-group col-sm-3 col-xs-12">
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
            <div class="col-sm-3 col-xs-12">
            	<label>Start Date</label>
                <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
			<div class="col-sm-3 col-xs-12">
            	<label>PO Number</label>
                <input type="text" class="form-control" id="po_number" name="po_number" value="<?php echo $po_number;?>" />
            </div>
			<div class="col-sm-3 col-xs-12">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'orders/my_orders'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			<div class="col-sm-2" style="margin-top: 10px;">
            	<input type='button' id='btn' value='Print Order' class="btn btn-primary pull-right" onclick='printDiv();'>
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
                  <th>Item name</th>
				  <th>Company</th>
				  <th>Vendor</th>
				  <th>Brand</th>
                  <th>Quantity</th>
				  <th>MRP:</th>
				  <th>Vendor Price Without GST:</th>
				  <th>GST Amount:</th>
				  <th>Vendor Price With GST:</th>
				  <th>GST Rate:</th>
				  <th>Order Date</th>
				  <th>Approved Date</th>
				  <th>Order Place Date</th>
				   <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><input type="hidden" name="order_numbers[]" value="<?php echo $vl['order_number']?>"><?php echo $psno; ?><?php echo $vl['po_number']?></td>
                  <!--<td><a href="<?php echo base_url(); ?>stocks/details/<?php echo $vl['item_number']?>"><?php echo $vl['item_number']?></a> 
                  		<?php if($vl['replaced'] == '1'){?> (Replaced)<?php } ?>
                  </td>-->
				  
                  <td><?php if(!empty($all_method->get_a_item_name($vl['item_number']))){ echo $all_method->get_a_item_name($vl['item_number']);} else{echo '';} ?></td>
                  <td><?php echo $vl['company'];?></td>
				  <td><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
				  <td><?php echo $all_method->get_brand_name($vl['brand_name']);?></td>
				  <td><?php echo $vl['order_quantity']?> (units)</td>
				  <td><?php echo $vl['mrp']; ?></td>
				  <td><?php echo round($vl['vendor_price'] * $vl['order_quantity'] / $vl['gstdivision'],2);  ?></td>
				  <td><?php echo round($vl['vendor_price'] * $vl['order_quantity'] - $vl['vendor_price'] * $vl['order_quantity'] / $vl['gstdivision'],2)  ?></td>
				  <td><?php echo $vl['vendor_price'] * $vl['order_quantity'];  ?></td>
				  <td><?php echo substr($vl['gstdivision'],2); ?></td>
                  <td><?php echo $vl['create_date']; ?></td>
				  <td><?php echo $vl['update_date']; ?></td>
				  <td><?php if (!empty($vl['order_place'])) { echo $vl['order_place']; }else{ if($vl['purchase_order']== '1'){ ?> <a class="btn btn-primary" href="<?php echo base_url('orders/order_place_date/'.$vl['order_number'].'');?>">Order Place</a> <?php }} ?></td>
                  <td><?php if($vl['purchase_order'] == 0){echo 'approval pending from indiaivf';}else{
				   if($vl['replaced'] == '1'){ echo "Order replaced";}
							else{ if($vl['received']== '0'){?> <a class="btn btn-primary" href="<?php echo base_url();?>orders/update_admin_order_item/<?php echo $vl['item_number']?>?i=<?php echo $vl['ID'];?>">Add to stock</a> <?php }else{echo "Received"; } } }

							?>
							
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
			<button type="submit">Submit</button>
			</form>
          </div>
        </div>
      </div>
      <!-- End Advanced Tables  -->
	  <div class="row" id="print_this_section" style="display:none;">
	  <table style="width:100%; margin-top:20px;">
  <tr>
    <td rowspan="2" colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p><strong>Pashupati Lifecare Pvt. Ltd.</strong></p>
	<p><strong>PO No : <?php echo $psno; foreach($data as $ky => $vl){
		if ($counter >= 1) {
        break; // Exit the loop
    }
    } echo $vl['po_number'];  ?></strong></p>
	<p><strong>DL Number: </strong> UP16200002826, UP16210002824 & UP1620F000057</p>
	<p><strong>FSSAI License No: </strong> 22723923000301</p>
    <p><strong>GSTIN NO:</strong> 09AAHCP5838M1ZP</p>
	<p><strong>CIN :</strong> U74999DL2014PTC264851</p>
	<p><strong>Premise Address:</strong> India IVF clinic(A unit of Pashupati Lifecare Pvt. Ltd.)
    Third Floor, N-26, Captain Vijayant Thapar Marg, Beside Dr Lal
    PathLabs, Sector 18, Noida, Gautambuddha Nagar, Uttar
    Pradesh, 201301</p>
	</td>
	
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;">
	<p>Purchase Order To</p>
	<?php 
	
	
		$sql4 = "Select * from ".$this->config->item('db_prefix')."vendors where vendor_number='".$vl['vendor_number']."' limit 1"; 
			$select_result = run_select_query($sql4);
			echo "<p><strong>Vendor Name : </strong>". $select_result['company_name'];
			echo "</p><p>";
            echo "<strong>Vendor Address : </strong>". $select_result['company_address'];
			echo "</p><p>";
            echo "<strong>Vendor GST Number : </strong>". $select_result['gst_no'];
			echo "</p>";
			 ?>
   
   </td>
	
  </tr>
  
</table>
	  
	  <table class="table table-striped table-bordered table-hover" style="margin-top:30px;">

              <thead>
                <tr>
				  <th style="border:1px solid;">Item name</th>
				  <th style="border:1px solid;">Company</th>
				  <th style="border:1px solid;">Vendor</th>
				  <th style="border:1px solid;">Brand</th>
                  <th style="border:1px solid;">Quantity</th>
				  <th style="border:1px solid;">MRP</th>
				  <th style="border:1px solid;">Vendor Price Without GST</th>
				  <th style="border:1px solid;">GST Amount</th>
				  <th style="border:1px solid;">Vendor Price With GST</th>
				  <th style="border:1px solid;">GST Rate</th>
				</tr>
              </thead>

            <tbody id="investigate_result">
			
              <?php 
			  $total_vendor_price = 0;
			  $total_gst_amount = 0;
			  $single_vendor_price = 0;
			  $single_vendor_price_without_gst = 0;
			  $total_vendor_price_without_gst = 0;
			  $single_vendor_price_gst = 0;
			  $total_single_vendor_price_gst = 0;
              $a = 1;  foreach($data as $ky => $vl){
                 $single_vendor_price =  $vl['vendor_price'] * $vl['order_quantity'];
				 $single_vendor_price_without_gst = round($vl['vendor_price'] * $vl['order_quantity'] / $vl['gstdivision'],2);
				 $single_vendor_price_gst = round($vl['vendor_price'] * $vl['order_quantity'] - $vl['vendor_price'] * $vl['order_quantity'] / $vl['gstdivision'],2)
			  ?>
                <tr class="odd gradeX" style="border:1px solid;">
                     <td style="border:1px solid;"><?php if(!empty($all_method->get_a_item_name($vl['item_number']))){ echo $all_method->get_a_item_name($vl['item_number']);} else{echo '';} ?></td>
                     <td style="border:1px solid;"><?php echo $vl['company']; ?></td>
                     <td style="border:1px solid;"><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
					 <td style="border:1px solid;"><?php echo $all_method->get_brand_name($vl['brand_name']);?></td>
                     <td style="border:1px solid;"><?php echo $vl['order_quantity']; ?></td>
					 <td style="border:1px solid;"><?php echo $vl['mrp']; ?></td>
					 <td style="border:1px solid;"><?php echo $single_vendor_price_without_gst;  ?></td>
					 <td style="border:1px solid;"><?php echo $single_vendor_price_gst;   ?></td>
					 <td style="border:1px solid;"><?php echo $single_vendor_price;  ?></td>
					 <td style="border:1px solid;"><?php echo substr($vl['gstdivision'],2); ?></td>
					 <?php 
					 $total_single_vendor_price_gst += $single_vendor_price_gst;
					 $total_vendor_price += $single_vendor_price;
					 $total_vendor_price_without_gst += $single_vendor_price_without_gst;
					 ?>
				</tr>
              <?php $count++;} ?>
			  <tr><td style="margin-top:50px;"><br/></td></tr>
			  <tr><td style="margin-top:50px;"><br/></td></tr>
			  <tr>
			    <td colspan="6"></td>
                <td colspan="2" style="border:1px solid;">Vendor Price Without GST</td>
				<td colspan="2" style="border:1px solid;"><?php echo $total_vendor_price_without_gst; ?></td>
			  </tr>
			  <tr>
			    <td colspan="6"></td>
                <td colspan="2" style="border:1px solid;">Total GST Amount</td>
				<td colspan="2" style="border:1px solid;"><?php echo $total_single_vendor_price_gst; ?></td>
			  </tr>
			  <tr>
			    <td colspan="6"></td>
                <td colspan="2" style="border:1px solid;">Total Vendor Amount</td>
				<td colspan="2" style="border:1px solid;"><?php echo $total_vendor_price; ?></td>
			  </tr>
			</tbody>
            </table>
	</div>
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
<script>
function printDiv() 
{
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
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