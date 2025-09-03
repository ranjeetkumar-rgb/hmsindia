<?php $all_method =&get_instance();
$center= get_center_name($data['billing_at']);
	$patient_data = get_patient_detail($data['patient_id']);
	$center_data = center_detail($center);
	// var_dump($data); 
 // echo "<pre>";
 // die();
  $status = check_billing_status($data['patient_id'], $data['receipt_number'], 'medicine');
 $patient_data = get_patient_detail($billing_details['patient_id']);
?>
<style>
#print_this_section{margin-top:50px;}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
  <div class="panel-body profile-edit">
	<h3>Billing Details</h3>
  <hr />
  <?php foreach($data as $ky => $vl){ ?>
  <?php 
  	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_total = 0;
	$consumables_discount = 0;
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_discount = $consumables_discount + $row['consumables_discount_'];
		}
	}
	?>
	<table style="width:100%">
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['receipt_number'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['patient_id'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Patient Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['patient_detail_name'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $consumables_price;?></td>
  </tr>
  <?php if($consumables_discount > 0){?>
      <tr>
        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount amount:</th>
        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $consumables_discount;?></td>
      </tr>
  <?php } ?>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Amount Paid:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $consumables_total;?></td>
  </tr>
  
 
    <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['payment_method']);?></td>
    </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Transaction ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['transaction_id'];?>
    	<?php if(!empty($data['transaction_img'])){?> <a href="<?php echo $vl['transaction_img']; ?>" class="hide_print"  target="_blank">Download transaction Image</a> <?php }?>
    </td>
    
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">On date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo date('d/m/Y H:i:s', strtotime($vl['on_date']));?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Billing Source:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php if($data['billing_from'] == 'IndiaIVF') echo $data['billing_from']; else echo get_center_name($data['billing_from']);?></td>
  </tr>
  
    <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Billing At:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['wife_name'];?><?php echo get_center_name($data['billing_at']);?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Hospital ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['hospital_id'];?></td>
  </tr>


</table>
 <?php } ?>
    <hr />
</div>

<div class="panel-body profile-edit" id="print_this_section" style="display:none;">
<?php foreach($data as $ky => $vl){ ?>
   <?php 
  	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_total = 0;
	$consumables_discount = 0;
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_discount = $consumables_discount + $row['consumables_discount_'];
		}
	}
	?>       
     <table style="width:100%;">
  <tr>
    <td  style="padding:5px; text-align:left;width:30%;" colspan="1">
	INDIA IVF CLINIC
	(A UNIT OF PASHUPATI LIFECARE PVT LTD)</td>
	<td colspan="1"></td>
    <td style="padding:5px; text-align:left;width:60%;" colspan="1">
	<strong>Dr Richika Sahay Shukla, MBBS, DNB - Obstetrics & Gynaecology
Medical registration no:  Delhi Medical Council: 22981 ;  Haryana 
State Medical Council: 8077; UP Medical council : 62229<br/></strong>
	</td>
  </tr>
</table>
  <table style="width:100%;">
   <tr>
    <th  style="padding:5px; text-align:left;"colspan="2"></th>
    <td style="padding:5px; text-align:right;" colspan="1">
	<strong>Receipt number: <?php echo $vl['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo date('d/m/Y H:i:s', strtotime($vl['on_date']));?></strong>
	</td>
  </tr>
   <tr>
    <th style="padding:5px; text-align:left;"colspan="1">
	<p><strong>Name :</strong><?php echo $vl['patient_detail_name'];?></p>
    <p>Patient Id <?php echo $vl['patient_id'];?></p>
    <p>Gender : F</p>
    <p>Age : <?php echo strtoupper($patient_data['wife_age']);?></p>	
	
	</th>
    <td style="padding:5px; text-align:left;" colspan="1"></td>
	<td style="padding:5px; text-align:right;" colspan="1">
	<!--<p>Contact number: <?php //echo strtoupper($patient_data['wife_phone']);?></p>-->
	</td>
  </tr>
</table>



       <table style="width:100%;margin-top:80px;">
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:10%;" bgcolor="red" colspan="1">S. No</th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:60%;" colspan="1">Details</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;" colspan="1">Amount</th>
  </tr>
  <tr>
    <th  style="padding:5px; text-align:left;width:10%;height:50px;"colspan="1">1</th>
    <th  style="padding:5px; text-align:left;width:60%;"colspan="1">Consultation / Other Medical Services</th>
	<th  style="padding:5px; text-align:right;"colspan="1"><?php echo $consumables_price;?></th>
  </tr>
  <tr>
    <th  style="padding:5px; text-align:left;width:10%;height:50px;"colspan="1"></th>
    <th  style="padding:5px; text-align:left;width:60%;"colspan="1">Discount Amount</th>
	<th  style="padding:5px; text-align:right;"colspan="1">-<?php echo $consumables_discount;?></th>
  </tr>
   <tr>
    <th colspan="1"></th><th colspan="1"></th><th colspan="1"></th>
  </tr>
   <tr>
    <th  style="padding:5px; text-align:left;height:200px;"colspan="2">Total Amount</th>
   <th  style="padding:5px; text-align:right;"colspan="1"><?php echo $consumables_total;?>/-(<?php echo strtoupper($vl['payment_method']);?>)</th>
  </tr>
</table>
   
 <table style="width:100%;margin-top:100px;margin-bottom:50px;">

  <tr>
    <th  style="text-align:center;" colspan="3">
	<p></p>
	<p><span style="margin-right:80px;">Mob: 7353873538</span>  <span>Email: info@indiaivf.in</span></p>
	 </th>
   
  </tr>
 
</table>   
 <?php } ?>
<div>
    <hr />
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