<?php $all_method =&get_instance(); //var_dump($data);die;?>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
  <div class="panel-body profile-edit" id="print_this_section">
	<h3>Purchase order</h3>
    <hr />
<table style="width:100%; border: 1px solid black; border-collapse: collapse;">
 <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:center;" colspan="2">Pashupati Lifecare Pvt. Ltd.</th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Order number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['order_number'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Item number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['item_number'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Item Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['item_name'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['company'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $all_method->get_vendor_name($data['vendor_number']);?></td>
  </tr>
  
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $all_method->get_brand_name($data['brand_name']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Without GST Price:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Rs.<?php echo round($data['vendor_price'] * $data['order_quantity'] / $data['gstdivision'],2)  ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Price:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Rs.<?php echo round($data['vendor_price'] * $data['order_quantity'] - $data['vendor_price'] * $data['order_quantity'] / $data['gstdivision'],2)  ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">With GST Price:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Rs.<?php echo $data['vendor_price'] * $data['order_quantity'];  ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Rate:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo substr($data['gstdivision'],2); ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Order quantity:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['order_quantity'];?> (units)</td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Order date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['create_date'];?></td>
  </tr> 
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Ship To:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['ship_to'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Bill To:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['bill_to'];?></td>
  </tr>
 <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['gst_number'];?></td>
  </tr>   
  <?php $vendor_billing = $all_method->get_vendor_billing($data['order_number']); 
  		if(!empty($vendor_billing)){
  ?>
  <tr id="vendor_billing_tr">
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor billing receipt:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><a href="<?php echo $vendor_billing['vendor_billing'];?>" target="_blank" download>Download</a> (uploaded on <?php echo $vendor_billing['upload_date'];?>)</td>
  </tr> 
  <?php } ?>
   
</table>
</div>
</div>
<script>
function printDiv() 
{
  $('.hide_print').hide();
  $('#vendor_billing_tr').hide();
  var divToPrint=document.getElementById('print_this_section');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
</script>