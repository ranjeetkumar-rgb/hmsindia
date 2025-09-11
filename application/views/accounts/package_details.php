<?php  
	$all_method =&get_instance();
	$center= get_center_name($data['billing_at']);
	$patient_data = get_patient_detail($data['patient_id']);
	$center_data = center_detail($center);
	$currency = '';
	$status = check_billing_status($data['patient_id'], $data['receipt_number'], 'package');
	
	$sql = "SELECT * FROM `hms_doctor_consultation` WHERE appointment_id=".$data['appointment_id']."";
	$select_result = run_select_query($sql);
	
	$sql4 = "SELECT * FROM `hms_doctors` WHERE ID=".$select_result['doctor_id']."";
	$select_result4 = run_select_query($sql4);  
	
	$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$data['patient_id']."' and paitent_type='new_patient'"; 
	$query = $this->db->query($sql1);  

	$sql5 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$data['patient_id']."'";
	$select_result5 = run_select_query($sql5);
	
	$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result5['wife_phone']."' and paitent_type='new_patient'";
	$select_result2 = run_select_query($sql2);
	
	$sql3 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
	$select_result3 = run_select_query($sql3);
	
	$sql6 ="Select * from ".$this->config->item('db_prefix')."patients where patient_id='".$data['patient_id']."'"; 
	$select_result6 = run_select_query($sql6);                            
	
	$procedures = unserialize($data['data']); if(isset($procedures) && !empty($procedures)) { 
    foreach($procedures['patient_procedures'] as $key => $val){ 
    
	$sql7 ="Select * from ".$this->config->item('db_prefix')."procedure_package where procedure_id='".$val['sub_procedure']."'"; 
	$select_result7 = run_select_query($sql7); 
	}
	}

// Function to convert number to words
function numberToWords($number) {
    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    $words = ucfirst($f->format($number));
    return $words . " only";
}

// Your amount
$amount = $data['remaining_amount'];	
?>
<style>
#print_this_section{margin-top:50px;}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
<input type='button' id='btn' value='Send to Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $patient_data['wife_phone']; ?>");'>
<div class="panel-body profile-edit">
	<h3 class="test1">Billing Details</h3>
	
	<p id="whatsappmessg" style="display:none;"></p>
    
	
    <hr />
    <?php echo $status; ?>
<table style="width:100%;">
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $select_result3['center_code']; ?>-<?php echo $data['receipt_number'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['patient_id'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Invoice No:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['series_number'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Patient Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($patient_data['wife_name']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total package:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $data['totalpackage'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discounted package:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $data['fees'];?></td>
  </tr>
  
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $data['payment_done'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Balance:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $data['remaining_amount'];?></td>
  </tr>
  <?php if($data['discount_amount'] > 0){?>
    <tr>
	    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount amount:</th>
    	<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $data['discount_amount'];?></td>
    </tr>
  <?php } ?>
    <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['payment_method']);?></td>
  </tr>
  <?php if($data['payment_method'] == "insurance"){?>
    <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Subvention charges:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['subvention_charges'];?></td>
    </tr>
  <?php } ?>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Transaction ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['transaction_id'];?>
  	    <?php if(!empty($data['transaction_img'])){?> <a href="<?php echo $data['transaction_img']; ?>" class="hide_print" target="_blank">Download transaction Image</a> <?php }?>
    </td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">On date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo date('d/m/Y H:i:s', strtotime($data['on_date']));?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Billing Source:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php if($data['billing_from'] == 'IndiaIVF') echo $data['billing_from']; else echo get_center_name($data['billing_from']);?></td>
  </tr>
  
    <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Billing At:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo get_center_name($data['billing_at']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Hospital ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['hospital_id'];?></td>
  </tr>
  
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">IIC share:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $data['center_share'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of visit:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_visit'];?></td>
  </tr>
  <tr class="hide_print">
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Package form:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
      <?php if(!empty($data['package_form'])){?><a href="<?php echo $data['package_form'];?>"  target="_blank">Open package form</a><?php }
      else{?>
        <form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url('upload-package-form/'.$data['receipt_number']); ?>" enctype="multipart/form-data" >
          <input type="file" name="package_form" class="form-control" required><br/>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      <?php } ?>
    </td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Status:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo ucwords($data['status']);?></td>
  </tr>
  <?php if($data['status'] == 'disapproved'){?>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of disapprove:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo ucwords($data['reason_of_disapprove']);?></td>
  </tr>
 <?php } ?>
</table>
<div>
	<?php $item_lists = $all_method->get_patient_items($data['receipt_number'], $data['patient_id']);
		  $consumable_result = $injection_result = $medicine_result = array();
      if(!empty($consumable_result)){
          $consumable_result = $item_lists['consumable_result'];
          $injection_result = $item_lists['injection_result'];
          $medicine_result = $item_lists['medicine_result'];
      }
	?>
    
   <!-- procedure -->    
	<?php  $procedures = unserialize($data['data']); if(isset($procedures) && !empty($procedures)) {  ?>
        <hr />
        <h3>Package details</h3>
        <hr />
          <table style="width:100%;">
              <tr>
				  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">SAC</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Procedure</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount</th>
              </tr>
              <?php foreach($procedures['patient_procedures'] as $key => $val){ ?>
              <tr> 
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role">999311</td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $select_result7['package_name']; ?></td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $select_result7['Name']; ?></td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_price']?></td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_paid_price']?></td>
              </tr>
              <?php } ?>
          </table>
    <?php } ?>
</div>
</div>

  <div class="panel-body profile-edit" id="print_this_section" style="display:none;">
       <table style="width:100%;">
  <tr>
    <td  style="padding:5px; text-align:left;width:65%;" colspan="1">
	<p><strong>Bill of Supply</strong></p>
	<p>(Original for Recipient)</p>
	</td>
	<td colspan="1"></td>
    <td style="padding:5px; text-align:left;width:35%;" colspan="1">
	<strong>P.Invoice no: <?php echo $select_result3['center_code']; ?>-<?php echo $data['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo date('d/m/Y', strtotime($data['on_date']));?></strong>
	</td>
  </tr>
</table>

<table style="width:100%; margin-top:20px;">
  <tr>
    <td rowspan="2" colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;">
	<p><strong>Billed From</strong></p>
	<p><strong>Pashupati Lifecare Pvt. Ltd.</strong></p>
	<p><strong>DL Number: </strong> UP16200002826, UP16210002824 & UP1620F000057</p>
	<p><strong>FSSAI License No: </strong> 22723923000301</p>
    <p><strong>GSTIN NO:</strong> 09AAHCP5838M1ZP</p>
	<p><strong>CIN :</strong> U74999DL2014PTC264851</p>
	<p><strong>Premise Address:</strong> India IVF clinic(A unit of Pashupati Lifecare Pvt. Ltd.)
    Third Floor, N-26, Captain Vijayant Thapar Marg, Beside Dr Lal
    PathLabs, Sector 18, Noida, Gautam Buddha Nagar, Uttar
    Pradesh, 201301</p>
	</td>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;">
	<p><strong>Bill To</strong></p>
	<p><strong>Patient Name :</strong><?php echo strtoupper($patient_data['wife_name']);?> </p>
	<p><strong>Address :</strong><?php echo $select_result6['wife_address']; ?></p>
    <p><strong>Patient Id :</strong> <?php echo $data['patient_id'];?></p>
	<p><strong>UHID : </strong> <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></p>
	<p><strong>Gender :</strong> F</p>
	<p><strong>Place of Supply :</strong> Uttar Pradesh</p>
	<p><strong>State Code :</strong> 09</p>
	</td>
  </tr>
   <tr>
    <td colspan="1" style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;width:50%;"><?php echo $select_result4['doctor_details']; ?></td>
  </tr>
</table>

<div>
	<?php $item_lists = $all_method->get_patient_items($data['receipt_number'], $data['patient_id']);
		  $consumable_result = $injection_result = $medicine_result = array();
      if(!empty($consumable_result)){
	  	  $consumable_result = $item_lists['consumable_result'];
	  	  $injection_result = $item_lists['injection_result'];
	  	  $medicine_result = $item_lists['medicine_result'];
      }
	?>
    
	
	
    <!-- procedure -->    
    <?php  $procedures = unserialize($data['data']); if(isset($procedures) && !empty($procedures)) { ?>
        <hr />
        <h3>Package details</h3>
        <hr />
		<table style="width:100%;">
        <tr>
			<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">SAC</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Package Name</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Gross</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Amount</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Net</th>
		</tr>
        <?php foreach($procedures['patient_procedures'] as $key => $val){//var_dump($val);die;	?>
        <tr>
			<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">999311</td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $select_result7['package_name']; ?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $select_result7['Name']; ?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_price']; ?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">0</td>
			<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_price'] - $val['sub_procedures_paid_price']; ?></td>
        </tr>
        <?php } ?>
    </table>
	 			    <table style="width:60%;float:right;margin-top:40px;"> 
				
				
  <tr>  
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">GROSS AMOUNT</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $currency; ?><?php echo $data['totalpackage'];?></th>
  </tr>
 
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">GST AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1">0</th>
  </tr>
  
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">PAID AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $currency; ?><?php echo $data['payment_done'];?></th>
  </tr>
 
  <tr>
    
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">BALANCE AMOUNT:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $currency; ?><?php echo $data['remaining_amount'];?></th>
  </tr>
</table>
    <?php } ?>
	<div style="width:100%; margin-top:200px;text-align:center;">
	<p><strong>Received Amount <?php echo numberToWords($amount); ?></strong> on <?php echo date('d/m/Y', strtotime($data['on_date']));?></p>
<p>This is computer generated invoice/receipt, does not need signature</p>
<p>This Healthcare Services is exempted from GST vide Notification No. 12/2017-Central Tax (Rate) dated 28-06-2017 and Notification No.9/2017 – Integrated Tax (Rate) dated 28-06-2017.</p>
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