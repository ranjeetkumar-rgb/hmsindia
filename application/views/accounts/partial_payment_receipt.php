<?php
$center= get_center_name($data['billing_at']);
	$all_method =&get_instance();
	$patient_data = get_patient_detail($data['patient_id']);
	 $center_data = center_detail($center);
	$currency = '';
	
	$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$patient_data['wife_phone']."' and paitent_type='new_patient'";
	$select_result2 = run_select_query($sql2);
	$sql3 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
	$select_result3 = run_select_query($sql3);
?>

<style>
  #print_this_section{margin-top:50px;}
</style>

<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
    <button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
<input type='button' id='btn' value='Send to Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $patient_data['wife_phone']; ?>");'>

  <div class="panel-body profile-edit">
	<h3 class="test11 <?php echo $center; ?>">Payment Receipt</h3>
		<p id="whatsappmessg" style="display:none;"></p>
  <hr />

<table style="width:100%; border: 1px solid black; border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['refrence_number'];?></td>
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
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Patient Name:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($patient_data['wife_name']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['payment_done'];?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Remaining Amount:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.patient_balance($data['patient_id']);?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['payment_method']); ?></td>
  </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">On date:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo date('d/m/Y H:i', strtotime($data['on_date']));?></td>
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
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Status:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php
      if($data['status'] == 0){echo 'Pending'; }
      else if($data['status'] == 1){ echo 'Approved'; }
      else if($data['status'] == 2){ echo 'Disapproved'; } ?>
    </td>
  </tr>
  <?php if($data['status'] == 2){?>
    <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Disapproved reason:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['disapproval_reason'];?></td>
    </tr>
  <?php } ?>
</table>

 <!-- procedure -->    
	<?php  $procedures = unserialize($data['data']); if(isset($procedures) && !empty($procedures)) {  ?>
        <hr />
        <h3>Procedures details</h3>
        <hr />
          <table style="width:100%;">
              <tr>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Procedure</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount</th>
				  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount</th>
              </tr>
              <?php foreach($procedures['patient_procedures'] as $key => $val){ ?>
              <tr>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_procedure_name($val['sub_procedure']); ?></td>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['sub_procedures_code']?></td>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_price']?></td>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_discount']?></td>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_paid_price']?></td>
               
			  </tr>
              <?php } ?>
          </table>
    <?php } ?>
</div>
  

<div class="panel-body profile-edit" id="print_this_section" style="display:none;">

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
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['refrence_number'];?></td>
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

