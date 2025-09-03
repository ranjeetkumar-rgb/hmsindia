<?php

$center= get_center_name($data['billing_at']);
	$all_method =&get_instance();

	$patient_data = get_patient_detail($data['patient_id']);
 $center_data = center_detail($center);


	$currency = '';

	// if($patient_data['nationality'] == 'indian'){

	// 	$currency = 'Rs.';

	// }else {

	// 	$currency = 'USD';

	// }

?>

<style>
  #print_this_section{margin-top:50px;}
</style>

<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
<button class="btn btn-primary" onclick="window.history.go(-1)">Back</button>
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
<input type='button' id='btn' value='Send to Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $patient_data['wife_phone']; ?>");'>

  <div class="panel-body profile-edit">

	<h3 class="test">Billing Details      </h3>
    <p id="whatsappmessg" style="display:none;"></p>
    <hr />

<table style="width:100%; border: 1px solid black; border-collapse: collapse;">

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['receipt_number'];?></td>

  </tr>
   
   <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
	<?php if($data['origins'] == '16267558222750'){?>
	001/<?php echo $data['ID'];?>
	 <?php } ?>
	  <?php if($data['origins'] == '16249589462327'){?>
	001/<?php echo $data['ID'];?>
	 <?php } ?>
	  <?php if($data['origins'] == '16266778858144'){?>
	002/<?php echo $data['ID'];?>
	 <?php } ?>
	 <?php if($data['origins'] == '1581156221'){?>
	003/<?php echo $data['ID'];?>
	 <?php } ?>
	 <?php if($data['origins'] == '16098223739590'){?>
	004/<?php echo $data['ID'];?>
	 <?php } ?>
	  <?php if($data['origins'] == '16133769691598'){?>
	005/<?php echo $data['ID'];?>
	 <?php } ?>
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

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total package:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['totalpackage'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discounted package:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['fees'];?></td>

  </tr>

  

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['payment_done'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Remaining Amount:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['remaining_amount'];?></td>

  </tr>

  <?php if($data['discount_amount'] > 0){?>

      <tr>

        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount amount:</th>

        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['discount_amount'];?></td>

      </tr>

      <tr>

        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of discount:</th>

        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_discount'];?></td>

      </tr>

  <?php } ?>

  

    <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php if($data['fees'] == 0){echo strtoupper("free"); }else{ echo strtoupper($data['payment_method']);};?></td>

  </tr>

  <?php if($data['payment_method'] == "insurance"){?>
    <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Subvention charges:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['subvention_charges'];?></td>
    </tr>
  <?php } ?>

  <?php if($data['fees'] == 0){?>
    <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Free reason:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['free_reason'];?></td>
    </tr>
  <?php } ?>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Transaction ID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['transaction_id'];?>

    	<?php if(!empty($data['transaction_img'])){?> <a href="<?php echo $data['transaction_img']; ?>" class="hide_print"  target="_blank">Download transaction Image</a> <?php }?>

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

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Doctor:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Dr. <?php echo $all_method->get_doctor_name($data['doctor_id']);?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Consultation ID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['consultation_id'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Hospital ID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['hospital_id'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of visit:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_visit'];?></td>

  </tr>

  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Status:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo ucwords($data['status']);?></td>
  </tr>
  
  <?php if($data['status'] == "disapproved"){?>
    <tr>
      <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Disapproved reason:</th>
      <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_disapprove'];?></td>
    </tr>
  <?php } ?>

</table>

</div>

  

  <div class="panel-body profile-edit" id="print_this_section" style="display:none">

	<h3>Billing Details</h3>

    <hr />

<table style="width:100%; border: 1px solid black; border-collapse: collapse;">
 <tr style="border:1px solid #000; width:100%; display:none;" id="medinfologo_tr">
        <td style="border:1px solid #000; width:100%;text-align:center;" colspan="3">

<img src="<?php echo base_url('assets/images/indiaivf-logo.png'); ?>" class="img-responsive" style="width:200px" />
        <p>(A UNIT OF PASHUPATI LIFECARE PVT LTD)</p>
           
          
        </td>
    </tr>
  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['receipt_number'];?></td>

  </tr>
  
  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">UHID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
	<?php if($data['origins'] == '16267558222750'){?>
	001/<?php echo $data['ID'];?>
	 <?php } ?>
	  <?php if($data['origins'] == '16249589462327'){?>
	001/<?php echo $data['ID'];?>
	 <?php } ?>
	  <?php if($data['origins'] == '16266778858144'){?>
	002/<?php echo $data['ID'];?>
	 <?php } ?>
	 <?php if($data['origins'] == '1581156221'){?>
	003/<?php echo $data['ID'];?>
	 <?php } ?>
	 <?php if($data['origins'] == '16098223739590'){?>
	004/<?php echo $data['ID'];?>
	 <?php } ?>
	  <?php if($data['origins'] == '16133769691598'){?>
	005/<?php echo $data['ID'];?>
	 <?php } ?>
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

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Total package:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['totalpackage'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discounted package:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['fees'];?></td>

  </tr>

  

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Paid Amount:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['payment_done'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Remaining Amount:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['remaining_amount'];?></td>

  </tr>

  <?php if($data['discount_amount'] > 0){?>

      <tr>

        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount amount:</th>

        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$data['discount_amount'];?></td>

      </tr>

      <tr>

        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of discount:</th>

        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_discount'];?></td>

      </tr>

  <?php } ?>

  

    <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Payment Method:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo strtoupper($data['payment_method']);?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Transaction ID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['transaction_id'];?>

    	<?php if(!empty($data['transaction_img'])){?> <a href="<?php echo $data['transaction_img']; ?>" class="hide_print" download>Download transaction Image</a> <?php }?>

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

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Doctor:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Dr. <?php echo $all_method->get_doctor_name($data['doctor_id']);?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Consultation ID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['consultation_id'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Hospital ID:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['hospital_id'];?></td>

  </tr>

  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of visit:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_visit'];?></td>
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