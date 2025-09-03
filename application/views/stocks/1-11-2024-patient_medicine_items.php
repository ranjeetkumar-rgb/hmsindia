<?php $all_method =&get_instance();
$center= get_center_name($data['billing_at']);
$patient_data = get_patient_detail($data['patient_id']);
$center_data = center_detail($center);
$status = check_billing_status($data['patient_id'], $data['receipt_number'], 'medicine');
$patient_data = get_patient_detail($billing_details['patient_id']);


?>

<style>
#print_this_section{margin-top:50px;}
</style>
 <?php if($_SESSION['logged_billing_manager']['center'] == "16249589462327"  ){ ?>  
 <?php //if($_SESSION['logged_billing_manager']['employee_number'] == "16249617235059"){ ?>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
    <!--<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>-->
  <div class="panel-body profile-edit">
	<h3>Billing Details</h3>
  <hr />
  

  <?php foreach($data as $ky => $vl){ ?>
 
  <?php 
  
  $sql2 = "SELECT * FROM `hms_doctors` WHERE ID=".$vl['doctor_id']."";
  $select_result2 = run_select_query($sql2);
  	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_total = 0;
	$consumables_discount = 0;
	$consumables_quantity = 0;
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
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
	$sql = "SELECT * FROM ".$this->config->item('db_prefix')."appointments WHERE paitent_id='".$vl['patient_id']."'";
    $select_result = run_select_query($sql);
	?>
	<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $select_result['wife_phone']; ?>");'>
	<table style="width:100%">
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['receipt_number'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
	<?php 
			$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."' and paitent_type='new_patient'"; 
			        $query = $this->db->query($sql1);
                        $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						//echo $res_val->appoitment_for;
						//}
						?>
		
	<?php if($res_val->appoitment_for == '16249589462327'){?>
	001/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	002/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16267558222750'){?>
	003/<?php echo $res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	004/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	005/<?php echo $res_val->uhid; ?>
	  <?php }} ?>
	</td>
  </tr>
   <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['patient_id'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Series Number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['series_number'];?></td>
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
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Cash Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['cash_payment']);?></td>
  </tr>
  <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Card Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['card_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UPI Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['upi_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">NEFT Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['neft_payment']);?></td>
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
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Generic Name</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Unit</th>
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
	
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			
			
			 echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
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
								 echo $res_val3->generic_name;
							}
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_price;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_quantity;
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
	$consuma2 = 0;
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_quantity2 = $consumables_quantity2 + $row['consumables_quantity'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
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
	<strong>No: <?php echo $vl['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo date('d/m/Y', strtotime($vl['on_date']));?></strong>
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
	<p><strong>Patient Name :</strong><?php echo $vl['patient_detail_name'];?></p>
	<p><strong>Address :</strong><?php $sql4 = "Select * from ".$this->config->item('db_prefix')."patients where patient_id='".$vl['patient_id']."'"; 
			            $query = $this->db->query($sql4);
                            $select_result4 = $query->result(); 
							foreach ($select_result4 as $res_val4){
							echo $res_val4->wife_address;
							} ?></p>
    <p><strong>Patient Id :</strong> <?php echo $vl['patient_id'];?></p>
	<p><strong>UHID : </strong> <?php 
			$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."' and paitent_type='new_patient'"; 
			        $query = $this->db->query($sql1);
                        $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						//echo $res_val->appoitment_for;
						//}
						?>
		
	
	<?php if($res_val->appoitment_for == '16249589462327'){?>
	<?php echo '001/'.$res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	<?php echo '002/'.$res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16267558222750'){?>
	<?php echo '003/'.$res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	<?php echo '004/'.$res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	<?php echo '005/'.$res_val->uhid; ?>
	  <?php }} ?></p>
    <p><strong>Gender :</strong> F</p>
	</td>
  </tr>
   <tr>
    <td colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;"><?php echo $select_result2['doctor_details']; ?></td>
  </tr>
</table>

        
    
	<?php //if($_SESSION['logged_accountant']){  ?>
	
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
			  <?php $count++; } } ?>
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
   
 <table style="width:100%;margin-top:20px;margin-bottom:20px;">
 <tr>
    <th style="text-align:center;background:#f1f1f1;width:100%;height:200px">
	<p>This is computer generated invoice/receipt, does not need signature</p>
	
  </tr>
</table>
	<?php }  ?>
<div>
   </div>
</div>
</div>
 <?php }elseif($_SESSION['logged_billing_manager']['center'] == "1581157290"  ){ ?>  
 
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
    <!--<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>-->
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
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
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
	$sql = "SELECT * FROM ".$this->config->item('db_prefix')."appointments WHERE paitent_id='".$vl['patient_id']."'";
    $select_result = run_select_query($sql);
	?>
	<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $select_result['wife_phone']; ?>");'>
	
	<table style="width:100%">
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['receipt_number'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
	<?php 
			$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."' and paitent_type='new_patient'"; 
			        $query = $this->db->query($sql1);
                        $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						//echo $res_val->appoitment_for;
						//}
						?>
		
	<?php if($res_val->appoitment_for == '16249589462327'){?>
	001/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	002/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16267558222750'){?>
	003/<?php echo $res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	004/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	005/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '1581157290'){?>
	006/<?php echo $res_val->uhid; ?>
	  <?php }} ?>
	</td>
  </tr>
   <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['patient_id'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Series Number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['series_number'];?></td>
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
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Cash Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['cash_payment']);?></td>
  </tr>
  <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Card Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['card_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UPI Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['upi_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">NEFT Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['neft_payment']);?></td>
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
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Generic Name</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Unit</th>
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
	
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			
			
			 echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
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
								 echo $res_val3->generic_name;
							}
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_price;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_quantity;
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
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_quantity2 = $consumables_quantity2 + $row['consumables_quantity'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_discount = $consumables_discount + $row['consumables_discount_'];
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
	<strong>Invoice no: <?php echo $vl['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo date('d/m/Y H:i:s', strtotime($vl['on_date']));?></strong>
	</td>
  </tr>
</table>

<table style="width:100%; margin-top:20px;">
  <tr>
    <td rowspan="2" colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p>Sold By</p>
    <p><strong>Pashupati Lifecare Pvt. Ltd.</strong></p>
	<p><strong>DL Number: </strong> UP14200004085, UP1420F000067 & UP14210004080</p>
	<p><strong>FSSAI License No: </strong> 22724700000009</p>
    <p><strong>GSTIN NO:</strong> 09AAHCP5838M1ZP</p>
	<p><strong>CIN :</strong> U74999DL2014PTC264851</p>
	<p><strong>Registered Address:</strong> 167 P, Lower Ground Floor, Sector 51, Gurugram, 122001</p>
    <p><strong>Premise Address:</strong> C-53 B, 2nd Floor, RDC, Raj Nagar, Ghaziabad
    Nagar Nigam Zone-14, Ghaziabad, Uttar Pradesh - 201002</p>
	</td>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;">
	<p>Sold To</p>
	<p><strong>Patient Name :</strong><?php echo $vl['patient_detail_name'];?></p>
	<p><strong>Address :</strong><?php $sql4 = "Select * from ".$this->config->item('db_prefix')."patients where patient_id='".$vl['patient_id']."'"; 
			            $query = $this->db->query($sql4);
                            $select_result4 = $query->result(); 
							foreach ($select_result4 as $res_val4){
							echo $res_val4->wife_address;
							} ?></p>
    <p><strong>Patient Id :</strong> <?php echo $vl['patient_id'];?></p>
	<p><strong>UHID : </strong> <?php 
			$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."' and paitent_type='new_patient'"; 
			        $query = $this->db->query($sql1);
                        $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						//echo $res_val->appoitment_for;
						//}
						?>
		
	
	<?php if($res_val->appoitment_for == '16249589462327'){?>
	<?php echo '001/'.$res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	<?php echo '002/'.$res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16267558222750'){?>
	<?php echo '003/'.$res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	<?php echo '004/'.$res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	<?php echo '005/'.$res_val->uhid; ?>
	  <?php }} ?></p>
    <p><strong>Gender :</strong> F</p>
	</td>
  </tr>
   <tr>
    <td colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;"><?php echo $select_result2['doctor_details']; ?></td>
  </tr>
</table>

        
    
	<?php //if($_SESSION['logged_accountant']){  ?>
	
 <table style="width:100%; margin-top:30px;">
                    <tr>
					    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">S.NO</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Product Name</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Batch No.</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Exp Date</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Qty</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">MRP</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Disc Amt</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Taxable Amt</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">HSN</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Rate</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Amt</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Amt</th>
                    </tr>
					
					<?php
					 $count=1; 
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
			 echo $consumables_gstrate;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo round($consumables_total_ - $consuma2,1);
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_total_;
			 echo '</td>';
			
	?>
              </tr>
			  <?php $count++; } } ?>
              </table>
			  
			    <table style="width:100%;margin-top:30px;"> 
				
				
  <tr>
    <th style="width:40%;text-align:left;"colspan="1" rowspan="4"></th>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">TOTAL QUANTITY</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_quantity2; ?></th>
  </tr>
  <tr>
   
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">GROSS AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_price;?></th>
  </tr>
  <tr>
   
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">DISCOUNT AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $consumables_discount;?></th>
  </tr>
  <tr>
    
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">BILL AMOUNT:</th>
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
   
 <table style="width:100%;margin-top:20px;margin-bottom:20px;">
 <tr>
    <th style="border: 1px solid black; text-align:left;background:#f1f1f1;width:30%;height:200px" colspan="2"><p>All disputes related to this order are subject to the jurisdiction of courts at 
Noida, Uttar Pradesh Computer Generated Invoice.</p><p><strong>For Support Contact:</strong></p><p><strong>Mobile:</strong> 7353873538, &nbsp;&nbsp;&nbsp;<strong>Email: </strog>info@indiaivf.in</p></th>
	<th style="border: 1px solid black; text-align:center;background:#f1f1f1;width:30%;" colspan="1"><p>For INDIA IVF CLINIC (A UNIT OF PASHUPATI LIFECARE PVT LTD)</p>
	<p>____ ____ ____ ____</p>
<p>Pharmacist Signature</p></th>
  </tr>
</table>
	<?php }  ?>
<div>
   </div>
</div>
</div>
	<?php }elseif($_SESSION['logged_accountant']){ ?>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
   <!-- <input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>-->
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
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
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
	$sql = "SELECT * FROM ".$this->config->item('db_prefix')."appointments WHERE paitent_id='".$vl['patient_id']."'";
    $select_result = run_select_query($sql);
	?>
	<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $select_result['wife_phone']; ?>");'>
	
	<table style="width:100%">
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['receipt_number'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
	<?php 
			$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."' and paitent_type='new_patient'"; 
			        $query = $this->db->query($sql1);
                        $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						//echo $res_val->appoitment_for;
						//}
						?>
		
	<?php if($res_val->appoitment_for == '16249589462327'){?>
	001/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	002/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16267558222750'){?>
	003/<?php echo $res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	004/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	005/<?php echo $res_val->uhid; ?>
	  <?php }} ?>
	</td>
  </tr>
   <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['patient_id'];?></td>
  </tr>
  <tr>
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Series Number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['series_number'];?></td>
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
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Cash Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['cash_payment']);?></td>
  </tr>
  <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Card Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['card_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UPI Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['upi_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">NEFT Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['neft_payment']);?></td>
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
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Generic Name</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Unit</th>
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
	
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			
			
			 echo '<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
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
								 echo $res_val3->generic_name;
							}
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_price;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_quantity;
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
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_quantity2 = $consumables_quantity2 + $row['consumables_quantity'];
			$consumables_total = $consumables_total + $row['consumables_total_'];
			$consumables_discount = $consumables_discount + $row['consumables_discount_'];
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
	<strong>Invoice no: <?php echo $vl['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo date('d/m/Y H:i:s', strtotime($vl['on_date']));?></strong>
	</td>
  </tr>
</table>

<table style="width:100%; margin-top:20px;">
  <tr>
    <td rowspan="2" colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p>Sold By</p>
    <p><strong>Pashupati Lifecare Pvt. Ltd.</strong></p>
	<p><strong>DL Number: </strong> UP16200002826, UP16210002824 & UP1620F000057</p>
	<p><strong>FSSAI License No: </strong> 22723923000301</p>
    <p><strong>GSTIN NO:</strong> 09AAHCP5838M1ZP</p>
	<p><strong>CIN :</strong> U74999DL2014PTC264851</p>
	<p><strong>Registered Address:</strong> 167 P, Lower Ground Floor, Sector 51, Gurugram, 122001</p>
    <p><strong>Premise Address:</strong> India IVF clinic(A unit of Pashupati Lifecare Pvt. Ltd.)
    Third Floor, N-26, Captain Vijayant Thapar Marg, Beside Dr Lal
    PathLabs, Sector 18, Noida, Gautambuddha Nagar, Uttar
    Pradesh, 201301</p>
	</td>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;">
	<p>Sold To</p>
	<p><strong>Patient Name :</strong><?php echo $vl['patient_detail_name'];?></p>
	<p><strong>Address :</strong><?php $sql4 = "Select * from ".$this->config->item('db_prefix')."patients where patient_id='".$vl['patient_id']."'"; 
			            $query = $this->db->query($sql4);
                            $select_result4 = $query->result(); 
							foreach ($select_result4 as $res_val4){
							echo $res_val4->wife_address;
							} ?></p>
    <p><strong>Patient Id :</strong> <?php echo $vl['patient_id'];?></p>
	<p><strong>UHID : </strong> <?php 
			$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."' and paitent_type='new_patient'"; 
			        $query = $this->db->query($sql1);
                        $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						//echo $res_val->appoitment_for;
						//}
						?>
		
	
	<?php if($res_val->appoitment_for == '16249589462327'){?>
	<?php echo '001/'.$res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	<?php echo '002/'.$res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16267558222750'){?>
	<?php echo '003/'.$res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	<?php echo '004/'.$res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	<?php echo '005/'.$res_val->uhid; ?>
	  <?php }} ?></p>
    <p><strong>Gender :</strong> F</p>
	</td>
  </tr>
   <tr>
    <td colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;"><?php echo $select_result2['doctor_details']; ?></td>
  </tr>
</table>

        
    
	<?php //if($_SESSION['logged_accountant']){  ?>
	
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
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Rate</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Amt</th>
						<th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total Amt</th>
                    </tr>
					
					<?php
					 $count=1; 
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
			 echo $consumables_gstrate;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo round($consumables_total_ - $consuma2,1);
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_total_;
			 echo '</td>';
			
	?>
              </tr>
			  <?php $count++; } } ?>
              </table>
			  
			    <table style="width:100%;margin-top:30px;"> 
				
				
  <tr>
    <th style="width:40%;text-align:left;"colspan="1" rowspan="4"></th>
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
   
 <table style="width:100%;margin-top:20px;margin-bottom:20px;">
 <tr>
    <th style="border: 1px solid black; text-align:left;background:#f1f1f1;width:30%;height:200px" colspan="2"><p>All disputes related to this order are subject to the jurisdiction of courts at 
Noida, Uttar Pradesh Computer Generated Invoice.</p><p><strong>For Support Contact:</strong></p><p><strong>Mobile:</strong> 7353873538, &nbsp;&nbsp;&nbsp;<strong>Email: </strog>info@indiaivf.in</p></th>
	<th style="border: 1px solid black; text-align:center;background:#f1f1f1;width:30%;" colspan="1"><p>For INDIA IVF CLINIC (A UNIT OF PASHUPATI LIFECARE PVT LTD)</p>
	<p>____ ____ ____ ____</p>
<p>Pharmacist Signature</p></th>
  </tr>
</table>
	<?php }  ?>
<div>
   </div>
</div>
</div>
 <?php }else{ ?>
	
	<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>	
   <!-- <input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>-->
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
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
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
	$sql = "SELECT * FROM ".$this->config->item('db_prefix')."appointments WHERE paitent_id='".$vl['patient_id']."'";
    $select_result = run_select_query($sql);
	?>
	<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $select_result['wife_phone']; ?>");'>
	
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
    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Series Number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $vl['series_number'];?></td>
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
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Cash Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['cash_payment']);?></td>
  </tr>
  <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Card Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['card_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UPI Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['upi_payment']);?></td>
  </tr>
   <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">NEFT Payment:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($vl['neft_payment']);?></td>
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
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Generic Name</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Unit</th>
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
								 echo $res_val3->generic_name;
							}
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo $consumables_price;
			 echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			 echo  $consumables_quantity;
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
	<th  style="padding:5px; text-align:right;"colspan="1">-<?php echo $consumables_price - $vl['payment_done'] //echo $consumables_discount;?></th>
  </tr>
   <tr>
    <th colspan="1"></th><th colspan="1"></th><th colspan="1"></th>
  </tr>
   <tr>
    <th  style="padding:5px; text-align:left;height:200px;"colspan="2">Total Amount</th>
   <th  style="padding:5px; text-align:right;"colspan="1"><?php echo $vl['payment_done'];?>/-(<?php echo strtoupper($vl['payment_method']);?>)</th>
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
    
	<?php //if($_SESSION['logged_accountant']){  ?>
	
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
			$discount = ($consumables_price * $consumables_discount_) / 100;
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
			echo ($consumables_price * $consumables_discount_) / 100;
			echo '</td><td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">';
			echo $consumables_price - $discount;
			echo '</td>';
	?>
              </tr>
			  <?php
			  		}
	}
			  ?>
              </table>
	<?php } //} ?>
<div>
    <hr />
   </div>
</div>
</div>
	<?php } ?>
<script>

function sendonwhatsapp() 
{
    var data = {'iic_id':<?php echo $vl['patient_id']; ?>, 'html': $("#print_this_section").html()};
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


