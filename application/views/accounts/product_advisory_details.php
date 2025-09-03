<?php $all_method =&get_instance();
 ?>
<style>
#print_this_section{margin-top:50px;}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
<button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
<div class="panel-body profile-edit">
<h3 class="test1">Billing Details</h3>
<hr />
<table style="width:100%;">
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Invoice No:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['invoice_no'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Student Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['training_name'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Father Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['training_fname'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Course:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['duration'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Package:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['fee_amount'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['paid_amount'];?></td>
  </tr>
    <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['payment_method']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Address:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['address'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">On date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['date'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Status:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php  if($data['status']== '0'){ echo "Pending";} ?>
    <?php  if($data['status']== '1'){ echo "Approved";} ?> 
    <?php  if($data['status']== '2'){ echo "Disapproved";} ?>  
           </td>
  </tr>
</table>
<div>

</div>
</div>

  <div class="panel-body profile-edit" id="print_this_section" style="display:none;">
       <table style="width:100%;">
  <tr>
    <td  style="padding:5px; text-align:left;width:70%;" colspan="1">
	<p><strong>Tax Invoice/Bill of Supply/Cash Memo</strong></p>
	<p>(Original for Recipient)</p>
	</td>
	<td colspan="1"></td>
    <td style="padding:5px; text-align:left;width:30%;" colspan="1">
	<strong>Invoice no: <?php echo $data['invoice_no'];?></strong><br/>
	<strong>Date : <?php echo $data['date'];?></strong>
	</td>
  </tr>
</table>

<table style="width:100%; margin-top:20px;">
  <tr>
    <td rowspan="2" colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p><strong>Pashupati Lifecare Pvt. Ltd.</strong></p>
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
	<p>Bill To</p>
	<p><strong>Student Name :</strong><?php echo $data['name'];?> </p>
	<p><strong>Address :</strong><?php echo $data['address'];?></p>
    </td>
  </tr>
</table>

<div>
	
        <hr />
        <h3>Product Advisory Details</h3>
        <hr />
		<table style="width:100%;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Amount</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Amount</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount</th>
                    </tr>
                   
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $data['duration']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $data['fee_amount']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role">0</td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['paid_amount']?></td>
                    </tr>
                  
                </table>
   
   
	 			    <table style="width:60%;float:right;margin-top:40px;"> 
				
				
  <tr>
   
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">GROSS AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $currency; ?><?php echo $data['fee_amount']; ?></th>
  </tr>
   <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">GST AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1">0</th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">PAID AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $data['paid_amount']; ?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">PENDING AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $currency; ?><?php echo $data['fee_amount'] - $data['paid_amount'];?></th>
  </tr>
</table>
	<div style="width:100%; margin-top:450px;text-align:center;">
<p>This is computer generated invoice/receipt, does not need signature</p>
</div> 
</div>
</div>
</div>
<script>
function printDiv() 
{
  $('.hide_print').hide();
  $('#print_this_section').css('display', 'block');
  $('tr#medinfologo_tr').css('display', 'table-row');
  var divToPrint=document.getElementById('print_this_section');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
</script>