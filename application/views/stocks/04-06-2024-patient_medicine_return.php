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
	$consumables_quantity = 0;
	
	if(!empty($vl['return_medicine'])){
		$data_arr = unserialize($vl['return_medicine']);
		if(!empty($data_arr['return_medicine']['consumables'])){
			$consumables_arr = $data_arr['return_medicine']['consumables'];
			$consumables_name = $consumables_name + $row['consumables_name'];
	}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_quantity = $row['consumables_quantity'];
			
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
	
	
 <table style="width:100%; margin-top:50px;">
                    <tr>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Medicine</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Unit</th>
						 <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Batch</th>
						  <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount</th>
						   <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total</th>
                    </tr>
					
					<?php
						if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $row['consumables_price'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_quantity = $row['consumables_quantity'];
			

					?>
                    <tr>
                     
					  
              <?php 
	
			// echo "<pre>";
			// print_r($row);
			// echo "</pre>";
			//	    exit();
			//$consumables_discount = $consumables_discount + $row['consumables_discount_'];
			//$consumables_total = $consumables_total + $row['consumables_total'];
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			$consumables_batch_number = $row['consumables_batch_number'];
			$consumables_expiry = $row['consumables_expiry'];
			$consumables_discount_ = $row['consumables_discount_'];
			$consumables_total_ = $row['consumables_total_'];
			
			 echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			// echo $consumables_name;
			// echo "<pre>abbkk";
			// print_r($medicine_data['consumables_name']);
			// echo "</pre>";
			//	    exit();
			//foreach ($medicine_data['consumables_name'] as $v2_data){
				 $sql1 = "select * from hms_center_stocks where item_number='".$row['consumables_name']."' limit 1"; 
				  $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->item_name;
							}
				
			  echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 $sql3 = "select * from hms_center_stocks where item_number='".$row['consumables_name']."' limit 1"; 
				  $query = $this->db->query($sql3);
                            $select_result3 = $query->result(); 
							foreach ($select_result3 as $res_val3){
								 echo '<br/>';
								 echo $res_val3->company;
							}
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_price;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_quantity;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_batch_number;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_discount_;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_total_;
			 echo '</td>';
			
	?>
              </tr>
			  <?php
			  	
	}
			  ?>
              </table>
	<?php }} ?>
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
	$consumables_quantity = 0;
	if(!empty($vl['return_medicine'])){
		$data_arr = unserialize($vl['return_medicine']);
		
		if(!empty($data_arr['return_medicine']['consumables'])){
			$consumables_arr = $data_arr['return_medicine']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_quantity = $row['consumables_quantity'];
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
	<strong>Dr Richika Sahay, MBBS, DNB - Obstetrics & Gynaecology
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
    
	</th>
    <td style="padding:5px; text-align:left;" colspan="1"></td>
	<td style="padding:5px; text-align:right;" colspan="1">
	<!--<p>Contact number: <?php //echo strtoupper($patient_data['wife_phone']);?></p>-->
	</td>
  </tr>
</table>

	
	
 <table style="width:100%">
                    <tr>
					    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">S.NO</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Product Name</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Batch No.</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Exp Date</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Qty</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">MRP</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Disc Amt(%)</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Taxable Amt</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">HSN</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">CGST Rate</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">SGST Rate</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">CGST Amt</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">SGST Amt</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Amt</th>
                    </tr>
					
					
					<?php
					 $count=1; 
					 $igst = 2;
					 $cgst = 0;
						if(!empty($consumables_arr)){
		    foreach ($consumables_arr as $row){
			$consumables_gstdivision = $row['consumables_gstdivision'];
			$consumables_quantity = $row['consumables_quantity'];
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_expiry = $row['consumables_expiry'];
			$consumables_mrp = $row['consumables_mrp'];
			$consumables_batch_number = $row['consumables_batch_number'];
			$consumables_hsn = $row['consumables_hsn'];                           
			$consumables_gstrate = $row['consumables_gstrate'];
			$consumables_discount_ = $row['consumables_discount_'];
			$consumables_total_ = $row['consumables_total_'];
			$consuma2 = $consumables_total_ / $consumables_gstdivision;
			$cgst = $cgst + $consuma2;
					?>
                    <tr>
            <?php 	
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo $count;
			echo '</td>';
			echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
				 $sql1 = "select * from hms_center_stocks where item_number='".$row['consumables_name']."' limit 1"; 
				  $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->item_name;
							}
			echo '</td>';
			echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			$sql3 = "select * from hms_center_stocks where item_number='".$row['consumables_name']."' limit 1"; 
				  $query = $this->db->query($sql3);
                            $select_result3 = $query->result(); 
							foreach ($select_result3 as $res_val3){
								 echo '<br/>';
								 echo $res_val3->company;
								 echo $res_val3->consumables_name;
							}
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_batch_number;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_expiry;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_quantity;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_mrp;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_discount_;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  round($consuma2,1);
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_hsn;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_gstrate / $igst;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_gstrate / $igst;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo round($consumables_total_ - $consuma2,1) / $igst;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo round($consumables_total_ - $consuma2,1) / $igst;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_total_;
			 echo '</td>';
			
	?>
              </tr>
			  <?php
			}
	}
			  ?>
              </table>
			   <table style="width:100%;margin-top:30px;"> 
				
				
  <tr>
    <th style="width:40%;text-align:left;"colspan="1" rowspan="6"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">TOTAL QUANTITY</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_quantity2; ?></th>
  </tr>
  <tr>
   
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">GROSS AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_price;?></th>
  </tr>
  <tr>
   
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">DISCOUNT AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_price - $consumables_total //echo $consumables_discount;?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">SGST AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total - $cgst,2) / $igst ; ?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">CGST AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total - $cgst,2) / $igst ; ?></th>
  </tr>
  
  <tr>
    
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">NET AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_total;?></th>
  </tr>
  <tr>
    <th style="width:40%;"colspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">ROUND OFF:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total,.1);?></th>
  </tr>
   <tr>
    <th style="width:40%;"colspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">PAYABLE AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total,0);?></th>
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


