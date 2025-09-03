<?php $all_method =&get_instance();
$center= get_center_name($data['billing_at']);
$patient_data = get_patient_detail($data['patient_id']);

$center_data = center_detail($center);
$status = check_billing_status($data['patient_id'], $data['receipt_number'], 'medicine');

$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$patient_data['wife_phone']."' and paitent_type='new_patient'";
$select_result2 = run_select_query($sql2);

$sql_doctor = "SELECT * FROM `hms_doctors` WHERE ID=".$data['doctor_id']."";
$select_result_doctor = run_select_query($sql_doctor);
?>

<style>
#print_this_section{margin-top:50px;}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
    <input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
	<input type='button' id='btn' value='Print Receipt' class="btn btn-primary pull-right" onclick='printReceipt();'>
	<input type='button' id='btn' value='Send To Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $patient_data['wife_phone']; ?>");'>
	
  <div class="panel-body profile-edit">
	<h3>Billing Details</h3>
  <hr />
  
  	<table style="width:100%">
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number: </th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['receipt_number'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $center_data['center_code']."/".$select_result2['uhid']; ?></td>
  </tr>
   <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['patient_id'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Series Number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['series_number'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Patient Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['patient_detail_name'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['fees'];?></td>
  </tr>
  <tr>
        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount amount:</th>
        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['discount_amount'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Amount Paid:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['payment_done'];?></td>
  </tr>
  <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['payment_method']);?></td>
  </tr>
  <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Cash Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['cash_payment']);?></td>
  </tr>
  <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Card Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['card_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UPI Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['upi_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">NEFT Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['neft_payment']);?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Transaction ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['transaction_id'];?>
    	<?php if(!empty($data['transaction_img'])){?> <a href="<?php echo $data['transaction_img']; ?>" class="hide_print"  target="_blank">Download transaction Image</a> <?php }?>
    </td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">On date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo date('d/m/Y H:i:s', strtotime($data['on_date']));?></td>
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
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['hospital_id'];?></td>
  </tr>
</table>


  
<?php  
  	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_total = 0;
	$consumables_discount = 0;
	$consumables_quantity = 0;
	$consuma2 = 0;
	if(!empty($data['data'])){
		$data_arr = unserialize($data['data']);
		
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			//$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_price += floatval($row['consumables_price']);
			$consumables_quantity2 = $consumables_quantity2 + $row['consumables_quantity'];
			//$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_total += (float) $row['consumables_total_'];
			$consumables_discount += (float) $row['consumables_discount_'];
			$consumables_gstrate2 += (float) $row['consuma2'];
			//$consumables_discount = $consumables_discount + $row['consumables_discount_'];
			//$consumables_gstrate2 = $consumables_gstrate2 + $row['consuma2'];
		}
	}
	?>
	
 <table style="width:100%; margin-top:50px;">
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
			$consuma2 = ((float) $consumables_gstdivision != 0) ? ((float) $consumables_total_ / (float) $consumables_gstdivision) : 0;

			$cgst = $cgst + $consuma2;
			if ($consumables_gstrate == 5) {
                $total_5 += $consuma2;
            } elseif ($consumables_gstrate == 12) {
                $total_12 += $consuma2;
            } elseif ($consumables_gstrate == 18) {
                $total_18 += $consuma2;
            } 
					?>
                    <tr>
                     
			  <?php 
	
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			
			echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
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
			 echo  round($consuma2,2);
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_hsn;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			if ($igst != 0) { echo $consumables_gstrate / $igst;} else {  echo "N/A"; }
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo ($igst != 0) ? ($consumables_gstrate / $igst) : 0;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo ($igst != 0) ? round(($consumables_total_ - $consuma2) / $igst, 1) : 0;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo ($igst != 0) ? round(($consumables_total_ - $consuma2) / $igst, 1) : 0;
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
</div>
<?php if($center_data['gst'] == "1"){ ?>  


<div class="panel-body profile-edit" id="print_this_section" style="display:none;">
   <?php 
  	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_total = 0;
	$consumables_discount = 0;
	$consumables_quantity = 0;
	$consuma2 = 0;
	if(!empty($data['data'])){
		$data_arr = unserialize($data['data']);
		
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_quantity2 = $consumables_quantity2 + $row['consumables_quantity'];
			//$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_total += (float) $row['consumables_total_'];

			$consumables_discount = $consumables_discount + $row['consumables_discount_'];
			$consumables_gstrate2 = $consumables_gstrate2 + $row['consuma2'];
		}
	}
	?>       
     <table style="width:100%;">
  <tr>
    <td  style="padding:5px; text-align:left;width:70%;" colspan="1">
	<p><strong>Tax Invoice/Bill of Supply/Cash Memo</strong></p>
	<p>(Original for Recipient)</p>
	</td>
	<td colspan="1"></td>
    <td style="padding:5px; text-align:left;width:30%;" colspan="1">
	<strong>No: <?php echo $data['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo date('d/m/Y', strtotime($data['on_date']));?></strong>
	</td>
  </tr>
</table>

<table style="width:100%; margin-top:20px;">
  <tr>
    <td rowspan="2" colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p><strong>Pashupati Lifecare Pvt. Ltd.</strong></p>
	<?php if(!empty($center_data['dl_number'])){ ?>
    <p><strong>DL Number: </strong><?php echo $center_data['dl_number']; ?></p>
	<?php } ?>
	<?php if(!empty($center_data['fssai_license_no'])){ ?>
    <p><strong>FSSAI License No: </strong><?php echo $center_data['fssai_license_no']; ?></p>
	<?php } ?>
	<?php if(!empty($center_data['center_gst'])){ ?>
    <p><strong>GSTIN NO:</strong> <?php echo $center_data['center_gst']; ?></p>
	<?php } ?>
	<?php if(!empty($center_data['cin'])){ ?>
    <p><strong>CIN: </strong> <?php echo $center_data['cin']; ?></p>
	<?php } ?>
	<?php if(!empty($center_data['center_address'])){ ?>
    <p><strong>Premise Address: </strong> <?php echo $center_data['center_address']; ?></p>
	<?php } ?>
	</td>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;">
	<p>Bill To</p>
	<p><strong>Patient Name :</strong><?php echo $data['patient_detail_name'];?></p>
	<p><strong>Address :</strong><?php echo $patient_data['wife_address'] ?></p>
    <p><strong>Patient Id :</strong> <?php echo $data['patient_id'];?></p>
	<p><strong>UHID : </strong>	<?php echo $center_data['center_code']."/".$select_result2['uhid']; ?></p>
    <p><strong>Gender :</strong> F</p>
	</td>
  </tr>
   <tr>
    <td colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p><strong>Pharmacist Name :</strong> <?php echo $center_data['pharmacist_name'];?></p>
	<p><strong>Registration Number : </strong>	<?php echo $center_data['pharmacist_registration']; ?></p>
	
	</td>
  </tr>
</table>
	
 <table style="width:100%; margin-top:30px;">
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
					 $total_5 = 0;
					 $total_12 = 0;
                     $total_18 = 0;
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
			//$consuma2 = $consumables_total_ / $consumables_gstdivision;
			$consuma2 = ((float)$consumables_gstdivision != 0) 
    ? ((float)$consumables_total_ / (float)$consumables_gstdivision) 
    : 0;


			$cgst = $cgst + $consuma2;
			
			if ($consumables_gstrate == 5) {
                $total_5 += $consuma2;
            } elseif ($consumables_gstrate == 12) {
                $total_12 += $consuma2;
            } elseif ($consumables_gstrate == 18) {
                $total_18 += $consuma2;
            } 
			
					?>
                    <tr>
                     
					  
              <?php 
	
			echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
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
			 echo  round($consuma2,2);
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_hsn;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_gstrate / $igst;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_gstrate / $igst;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo round((float)$consumables_total_ - $consuma2, 1) / (float)$igst;

			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo round((float)$consumables_total_ - $consuma2,1) / (float)$igst;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_total_;
			 echo '</td>';
	?>
              </tr>
			  <?php $count++; } } ?>
              </table>
			  
			    <table style="width:100%;margin-top:30px;"> 
				
				
  <tr>
     <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1">TAXABLE VALUE</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1">RATE</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;"colspan="1" rowspan="1">GST(AMOUNT)</th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">TOTAL QUANTITY</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_quantity2; ?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1"><?php echo round($total_5, 2); ?></th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1">5 %</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;"colspan="1" rowspan="1"><?php echo round($gst_5 = ($total_5 * 5) / 100,2);   ?></th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">GROSS AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_price;?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1"><?php echo round($total_12, 2); ?></th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1">12 %</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;"colspan="1" rowspan="1"><?php echo round($gst_12 = ($total_12 * 12) / 100,2);   ?></th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">DISCOUNT AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_price - $consumables_total //echo $consumables_discount;?></th>
  </tr>
  <tr>
      <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1"><?php echo round($total_18, 2); ?></th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1">18 %</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;"colspan="1" rowspan="1"><?php echo round($gst_18 = ($total_18 * 18) / 100,2);   ?></th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">SGST AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total - $cgst,2) / $igst ; ?></th>
  </tr>
  <tr>
      <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1"></th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;" colspan="1" rowspan="1"></th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;"colspan="1" rowspan="1"></th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">CGST AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total - $cgst,2) / $igst ; ?></th>
  </tr>
  
  <tr>
    <th colspan="1" rowspan="1"></th>
	<th colspan="1" rowspan="1"></th>
	<th colspan="1" rowspan="1"></th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">NET AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_total;?></th>
  </tr>
  <tr>
    <th colspan="1" rowspan="1"></th>
	<th colspan="1" rowspan="1"></th>
	<th colspan="1" rowspan="1"></th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">ROUND OFF:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total,.1);?></th>
  </tr>
   <tr>
    <th colspan="1" rowspan="1"></th>
	<th colspan="1" rowspan="1"></th>
	<th colspan="1" rowspan="1"></th>
	<th style="text-align:left;"colspan="1" rowspan="1"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">PAYABLE AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo round($consumables_total,0);?></th>
  </tr>
</table>
   
 <table style="width:100%;margin-top:20px;margin-bottom:20px;">
 <tr>
    <th style="text-align:center;background:#f1f1f1;width:100%;height:200px">
	<p>This is computer generated invoice/receipt, does not need signature</p>
	
  </tr>
</table>
<div>
   </div>
</div>
<?php }else{ ?>
<div class="panel-body profile-edit" id="print_this_section" style="display:none;">
   <?php 
  	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_total = 0;
	$consumables_discount = 0;
	if(!empty($data['data'])){
		$data_arr = unserialize($data['data']);
		
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			//$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_price += floatval($row['consumables_price']);

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
	<strong><?php echo $select_result_doctor['doctor_details']; ?><br/></strong>
	</td>
  </tr>
</table>
  <table style="width:100%;">
   <tr>
    <th  style="padding:5px; text-align:left;"colspan="2"></th>
    <td style="padding:5px; text-align:right;" colspan="1">
	<strong>Receipt number: <?php echo $data['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo date('d/m/Y H:i:s', strtotime($data['on_date']));?></strong>
	</td>
  </tr>
   <tr>
    <th style="padding:5px; text-align:left;"colspan="1">
	<p><strong>Name :</strong><?php echo $data['patient_detail_name'];?></p>
    <p>Patient Id <?php echo $data['patient_id'];?></p>
    <p>Gender : F</p>
    
	</th>
    <td style="padding:5px; text-align:left;" colspan="1"></td>
	<td style="padding:5px; text-align:right;" colspan="1">
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
	<th  style="padding:5px; text-align:right;"colspan="1"><?php echo $data['fees'];?></th>
  </tr>
  <tr>
    <th  style="padding:5px; text-align:left;width:10%;height:50px;"colspan="1"></th>
    <th  style="padding:5px; text-align:left;width:60%;"colspan="1">Discount Amount</th>
	<th  style="padding:5px; text-align:right;"colspan="1">-<?php echo $data['discount_amount'];?></th>
  </tr>
   <tr>
    <th colspan="1"></th><th colspan="1"></th><th colspan="1"></th>
  </tr>
   <tr>
    <th  style="padding:5px; text-align:left;height:200px;"colspan="2">Total Amount</th>
   <th  style="padding:5px; text-align:right;"colspan="1"><?php echo $data['payment_done'];?>/-(<?php echo strtoupper($data['payment_method']);?>)</th>
  </tr>
</table>
   
 <table style="width:100%;margin-top:100px;margin-bottom:250px;">
  <tr>
    <th  style="text-align:center;" colspan="3">
	<p></p>
	<p><span style="margin-right:80px;">Mob: 7353873538</span>  <span>Email: info@indiaivf.in</span></p>
	 </th>
  </tr>
</table>   
	
 <table style="width:100%">
                    <tr>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Medicine</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Batch Number</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Unit</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Amount</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount (%)</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Amount</th>
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
			$discount = 0; 
	        $consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			$consumables_batch_number = $row['consumables_batch_number'];
			$consumables_discount_ = $row['consumables_discount_'];
			$consumables_total_ = $row['consumables_total_'];
			//$discount = ($consumables_price * $consumables_discount_) / 100;
			$discount = (float)$consumables_price * (float)$consumables_discount_ / 100;

			echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 $sql3 = "select * from hms_center_stocks where item_number='".$row['consumables_name']."' limit 1"; 
				  $query = $this->db->query($sql3);
                            $select_result3 = $query->result(); 
							foreach ($select_result3 as $res_val3){
								 echo '<br/>';
								 echo $res_val3->item_name;
							}
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo  $consumables_batch_number;				
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo  $consumables_quantity;
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo $consumables_price;
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			//echo ($consumables_price * $consumables_discount_) / 100;
			echo (float)$consumables_price * (float)$consumables_discount_ / 100;

			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			//echo $consumables_price - $discount;
			echo floatval($consumables_price) - floatval($discount);

			echo '</td>';
	?>
              </tr>
			  <?php
			  		}
	}
			  ?>
              </table>
    <hr />
</div>
</div>
<?php } ?>
<div class="panel-body profile-edit" id="print_receipt" style="display:none;">

	<h3>Payment Receipt</h3>

    <hr />

  <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
    <tr style="border:1px solid #000; width:100%; display:none;" id="medinfologo_tr">
        <td style="border:1px solid #000; width:100%;text-align:center;" colspan="3">
             <?php 
  if(!empty($center_data['upload_photo_1'])){
?>
<img src="<?php echo $center_data['upload_photo_1'];?>" class="img-responsive" style="width:200px" />
  <?php } else {?>

 <img src="<?php echo base_url('assets/images/indiaivf-logo.png'); ?>" class="img-responsive" style="width:200px" />
   
<?php  } ?>
        </td>
    </tr>

  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['receipt_number'];?></td>
  </tr>
   <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $center_data['center_code']."/".$select_result2['uhid']; ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['patient_id'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Patient Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($patient_data['wife_name']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['payment_done'];?></td>
  </tr>
  
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['payment_method']); ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">On date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo date('d/m/Y H:i', strtotime($data['on_date']));?></td>
  </tr>
</table>
</div>
<script>
function printReceipt() 
{
  $('.hide_print').hide();
  $('#print_receipt').css('display', 'block');
  $('tr#medinfologo_tr').css('display', 'table-row');
  var divToPrint=document.getElementById('print_receipt');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
function sendonwhatsapp() 
{
    var data = {'iic_id':<?php echo $data['patient_id']; ?>, 'html': $("#print_this_section").html()};
    $('#whatsappmessg').hide();
	$.ajax({
		url: '<?php echo base_url('accounts/billhtmltopdf')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
		    if(data.status == 1){
                $('#whatsappmessg').empty().append('Bill has been sent to patient!');
		    }else{
		        $('#whatsappmessg').empty().append('Oops, something went wrong!');
		    }
		    $('#whatsappmessg').show();
		} 
	});
}
</script>
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