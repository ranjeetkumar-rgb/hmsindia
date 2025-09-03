<?php $all_method =&get_instance();
$totalVendorPriceSum = 0; 
?>

<style>
#print_this_section{margin-top:50px;}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
    <input type='button' id='btn' value='Print Order' class="btn btn-primary" onclick='printDiv();'>
  <div class="panel-body profile-edit">
	<h3>Billing Details</h3>
  <hr />
  
  <?php foreach($data as $ky => $vl){ 
   $totalVendorPriceSum += (float)$vl['total_vendor_price'];
 if (!empty($vl['gstdivision']) && (float)$vl['gstdivision'] != 0.0) {
    $totalgstPriceSum += (float)$vl['total_vendor_price'] / (float)$vl['gstdivision'];
} else {
    $totalgstPriceSum += 0; // or handle the zero-division case differently if needed
}

   
   $sql2 = "SELECT * FROM hms_centers WHERE center_number='" . $vl['ship_to'] . "'";
	$select_result2 = run_select_query($sql2);

	$sql = "SELECT * FROM hms_centers WHERE center_number='" . $vl['bill_to'] . "'";
	$select_result5 = run_select_query($sql);
  } ?>
 	<table style="width:100%">
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">PO Number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['po_number'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor Price Without GST:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo round($totalgstPriceSum,2);?></td>
  </tr>
      <tr>
        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total GST Amount:</th>
        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo round($totalVendorPriceSum - $totalgstPriceSum,2);?></td>
      </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Vendor Amount :</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $totalVendorPriceSum; ?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Transaction ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['transaction_id'];?>
    	<?php if(!empty($data['transaction_img'])){?> <a href="<?php echo $vl['transaction_img']; ?>" class="hide_print"  target="_blank">Download transaction Image</a> <?php }?>
    </td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['create_date'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Ship To:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $select_result2['center_name'].",".$select_result2['center_address']; ?></td>
  </tr>
  
    <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Bill To:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $select_result5['center_name'].",".$select_result5['center_address']; ?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Department:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['center'];?></td>
  </tr>
</table>
	
	
 <table style="width:100%; margin-top:50px;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Item Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Quantity(Pack)</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">MRP (Pack)</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor Price Without GST</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Amount</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor Price With GST</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Rate</th>
                    </tr>
					<?php foreach($data as $ky => $vl){ ?>
					<tr>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['item_name']; ?></td>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['company']; ?></td>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['order_qty_pack']; ?></td>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['mrp']; ?></td>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php
echo (!empty($vl['gstdivision']) && (float)$vl['gstdivision'] != 0.0)
    ? round($vl['total_vendor_price'] / $vl['gstdivision'], 3)
    : 0;
?>
</td>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php
echo (!empty($vl['gstdivision']) && (float)$vl['gstdivision'] != 0.0)
    ? round($vl['total_vendor_price'] - ($vl['total_vendor_price'] / $vl['gstdivision']), 3)
    : 0;
?>
</td>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['total_vendor_price']; ?></td>
                      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['gstrate']; ?></td>
					</tr>
			 <?php } ?>
              </table>

	<hr />
</div>


<div class="row" id="print_this_section" style="display:none;">
   <table style="width:100%; margin-top:20px;">
  <tr>
    <td rowspan="2" colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p><strong>Pashupati Lifecare Pvt. Ltd.</strong></p>
	<p><strong>PO No : <?php echo $vl['po_number'];  ?></strong></p>
	<p><strong>DL Number: </strong> UP16200002826, UP16210002824 & UP1620F000057</p>
	<p><strong>FSSAI License No: </strong> 22723923000301</p>
    <p><strong>GSTIN NO:</strong> 09AAHCP5838M1ZP</p>
	<p><strong>CIN :</strong> U74999DL2014PTC264851</p>
	<p><strong>Premise Address:</strong> India IVF clinic(A unit of Pashupati Lifecare Pvt. Ltd.)
    Third Floor, N-26, Captain Vijayant Thapar Marg, Beside Dr Lal
    PathLabs, Sector 18, Noida, Gautambuddha Nagar, Uttar
    Pradesh, 201301</p>
	</td>
	
      <td colspan="2" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;">
	<p>Purchase Order To</p>
	<?php 
	
	
			$sql4 = "Select * from ".$this->config->item('db_prefix')."vendors where vendor_number='".$vl['vendor_number']."'"; 
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
  <tr>
    <td colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:40%;"><p><strong>Bill To</strong></p><p> <?php echo $select_result5['center_name'].",".$select_result5['center_address']; ?></p></td>
    <td colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;"><p><strong>Ship To</strong></p><p> <?php echo $select_result2['center_name'].",".$select_result2['center_address']; ?></p></td>
  </tr>

  
</table>

 <table class="table table-striped table-bordered table-hover" style="margin-top:30px;">
              <thead>
                <tr>
					<th style="border:1px solid;">Item name</th>
					<th style="border:1px solid;">Company</th>
					<th style="border:1px solid;">Quantity (Pack)</th>
					<th style="border:1px solid;">MRP (Pack)</th>
					<th style="border:1px solid;">Vendor Price Without GST</th>
					<th style="border:1px solid;">GST Amount</th>
					<th style="border:1px solid;">Vendor Price With GST</th>
					<th style="border:1px solid;">GST Rate</th>
				</tr>
              </thead>
            <tbody id="investigate_result">
			<?php foreach($data as $ky => $vl){ 
			$total_vendor_price_widout_gst = $vl['total_vendor_price'] / $vl['gstdivision'];
			$total_gst_price = $vl['total_vendor_price'] - $vl['total_vendor_price'] / $vl['gstdivision'];
			?>
                <tr class="odd gradeX" style="border:1px solid;">
                     <td style="border:1px solid;"><?php echo $vl['item_name']; ?></td>
                     <td style="border:1px solid;text-align:center;"><?php echo $vl['company']; ?></td>
                     <td style="border:1px solid;text-align:center;"><?php echo $vl['order_qty_pack']; ?></td>
					 <td style="border:1px solid;text-align:center;"><?php echo $vl['mrp']; ?></td>
					 <td style="border:1px solid;text-align:center;"><?php echo round($total_vendor_price_widout_gst,3); ?></td>
					 <td style="border:1px solid;text-align:center;"><?php echo round($total_gst_price,3);  ?></td>
					 <td style="border:1px solid;text-align:center;"><?php echo $vl['total_vendor_price']; ?></td>
					 <td style="border:1px solid;text-align:center;"><?php echo $vl['gstrate']; ?></td>
				</tr>
              <?php } ?>
			  <tr><td style="margin-top:50px;"><br/></td></tr>
			  <tr><td style="margin-top:50px;"><br/></td></tr>
			  <tr>
			    <td colspan="4"></td>
                <td colspan="2" style="border:1px solid;">Vendor Price Without GST</td>
				<td colspan="2" style="border:1px solid;"><?php echo round($totalgstPriceSum,2);?></td>
			  </tr>
			  <tr>
			    <td colspan="4"></td>
                <td colspan="2" style="border:1px solid;">Total GST Amount</td>
				<td colspan="2" style="border:1px solid;"><?php echo round($totalVendorPriceSum - $totalgstPriceSum,2);?></td>
			  </tr>
			  <tr>
			    <td colspan="4"></td>
                <td colspan="2" style="border:1px solid;">Total Vendor Amount</td>
				<td colspan="2" style="border:1px solid;"><?php echo round($totalVendorPriceSum,2); ?></td>
			  </tr>
			</tbody>
            </table>
<div>
    <div>
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