<?php $all_method =&get_instance();
$center= get_center_name($data['billing_at']);
$patient_data = get_patient_detail($data['patient_id']);
$center_data = center_detail($center);
$status = check_billing_status($data['patient_id'], $data['receipt_number'],'procedure');
?>
<style>
#print_this_section{margin-top:50px;}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $patient_data['wife_phone']; ?>");'>
<div class="panel-body profile-edit">
	<h3 class="test1">Refund Details</h3>
	
	<p id="whatsappmessg" style="display:none;"></p>
    
	
    <hr />
    <?php echo $status; ?>
<table style="width:100%;">
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['receipt_number'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
	<?php 
					$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$data['patient_id']."'"; 
			        $select_result = run_select_query($sql1); 
					$sql = "SELECT * FROM `hms_appointments` WHERE wife_phone='".$select_result['wife_phone']."' and paitent_type='new_patient'";
                    $query = $this->db->query($sql);
	                $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						?>
		
	<?php if($res_val->appoitment_for == '16267558222750'){?>
	003/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16249589462327'){?>
	001/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	002/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '1581156221'){?>
	004/<?php echo $res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	004/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	005/<?php echo $res_val->uhid; ?>
	  <?php }} ?>
	 </td>
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
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Wallet Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['consultation_fee'] + $data['usg_scan_charge'] + $data['consumable_charges'] + $data['file_registation_charge'] + $data['refund_amount'] ;?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Consultation Fee:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $data['consultation_fee'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">USG Scan Charge:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['usg_scan_charge'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Consumable Charges:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['consumable_charges'];?></td>
  </tr>
  <tr>
	 <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">File Registation Charge:</th>
     <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['file_registation_charge'];?></td>
  </tr>
    <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Refund Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['refund_amount'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">On date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['on_date']; ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Status:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['status'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of Cancel:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_cancle'];?></td>
  </tr>
</table>
<div>
</div>

  <div class="panel-body profile-edit" id="print_this_section" style="display:none;">
       <table style="width:100%;">
  <tr>
    <td  style="padding:5px; text-align:left;width:60%;" colspan="1">
	<p><strong>Tax Invoice/Bill of Supply/Cash Memo</strong></p>
	<p>(Original for Recipient)</p>
	</td>
	<td colspan="1"></td>
    <td style="padding:5px; text-align:left;width:40%;" colspan="1">
	<strong>Invoice No: <?php echo $data['receipt_number'];?></strong><br/>
	<strong>Date : <?php echo $data['on_date']; ?></strong>
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
	<p><strong>Patient Name :</strong><?php echo strtoupper($patient_data['wife_name']);?> </p>
	<p><strong>Address :</strong><?php $sql4 = "Select * from ".$this->config->item('db_prefix')."patients where patient_id='".$data['patient_id']."'"; 
			            $query = $this->db->query($sql4);
                            $select_result4 = $query->result(); 
							foreach ($select_result4 as $res_val4){
							echo $res_val4->wife_address;
							} ?></p>
    <p><strong>Patient Id :</strong> <?php echo $data['patient_id'];?></p>
	<p><strong>UHID : </strong> <?php 
					$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$data['patient_id']."'"; 
			        $select_result = run_select_query($sql1); 
					$sql = "SELECT * FROM `hms_appointments` WHERE wife_phone='".$select_result['wife_phone']."' and paitent_type='new_patient'";
                    $query = $this->db->query($sql);
	                $select_result1 = $query->result(); 
						foreach ($select_result1 as $res_val){
						?>
		
	<?php if($res_val->appoitment_for == '16267558222750'){?>
	003/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '16249589462327'){?>
	001/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	002/<?php echo $res_val->uhid; ?>
	 <?php } if($res_val->appoitment_for == '1581156221'){?>
	004/<?php echo $res_val->uhid; ?>
	 <?php }  if($res_val->appoitment_for == '16098223739590'){?>
	004/<?php echo $res_val->uhid; ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	005/<?php echo $res_val->uhid; ?>
	  <?php }} ?></p>
	<p><strong>Gender :</strong> F</p>
	<p><strong>Sac Code :</strong> 999311</p>
	<p><strong>Place of Supply :</strong> Uttar Pradesh</p>
	<p><strong>State Code :</strong> 09</p>
	</td>
  </tr>
</table>

<div>
	
   
        <hr />
        <h3>Refund Details</h3>
        <hr />
		<table style="width:100%;">
        <tr>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Wallet Amount:</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Consultation Fee:</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">USG Scan Charge:</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Consumable Charges:</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">File Registation Charge:</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Refund Amount:</th>
        </tr>
       
        <tr>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['consultation_fee'] + $data['usg_scan_charge'] + $data['consumable_charges'] + $data['file_registation_charge'] + $data['refund_amount'] ;?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['consultation_fee']; ?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['usg_scan_charge']?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['consumable_charges']?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['file_registation_charge']?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['refund_amount']?></td>
        </tr>
    
    </table>
	 			    <table style="width:60%;float:right;margin-top:40px;"> 
				
				
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">Wallet Amount</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $data['consultation_fee'] + $data['usg_scan_charge'] + $data['consumable_charges'] + $data['file_registation_charge'] + $data['refund_amount'] ;?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">Consultation Fee:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $data['consultation_fee'];?></th>
  </tr>
   <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">USG Scan Charge:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $data['usg_scan_charge'];?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">Consumable Charges:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $data['consumable_charges'];?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">File Registation Charge:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $data['file_registation_charge'];?></th>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:left;background:#f1f1f1;width:30%;" colspan="1">Refund Amount:</th>
	<th style="border: 1px solid black; border-collapse: collapse;padding:5px;text-align:right;background:#f1f1f1;width:30%;" colspan="1"><?php echo $data['refund_amount'];?></th>
  </tr>
</table>
  
	<div style="width:100%; margin-top:300px;text-align:center;">
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