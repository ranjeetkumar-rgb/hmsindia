<?php $all_method =&get_instance();
$center= get_center_name($data['billing_at']);
	$patient_data = get_patient_detail($data['patient_id']);
	$center_data = center_detail($center);
	$currency = '';
	// if($patient_data['nationality'] == 'indian'){
	// 	$currency = 'Rs.';
	// }else {
	// 	$currency = 'USD';
  // }
  //$currency = 'Rs.';
  $status = check_billing_status($data['patient_id'], $data['receipt_number'], 'procedure');
  
  
  
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
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['receipt_number'];?></td>
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
	  	  $consumable_result = $item_lists['consumable_result'];
	  	  $injection_result = $item_lists['injection_result'];
	  	  $medicine_result = $item_lists['medicine_result'];
	?>
    
    <!-- consumables -->
    <?php if(isset($consumable_result) && !empty($consumable_result)) { ?>
        <hr />
        <h3>Consumable lists</h3>
        <hr />
		<table style="width:100%;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Serial</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Quantity</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                    </tr>
                    <?php foreach($consumable_result as $key => $val){	?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['consumables_serial']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_item_name($val['consumables_serial']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['consumables_quantity']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['consumables_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['consumables_company']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
    <?php } ?>
    <!-- medicine -->
    <?php if(isset($injection_result) && !empty($injection_result)) { ?>
        <hr />
        <h3>Injection lists</h3>
        <hr />
		<table style="width:100%;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Serial</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Quantity</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                    </tr>
                    <?php foreach($injection_result as $key => $val){	?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['injections_serial']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_item_name($val['injections_serial']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['injections_quantity']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['injections_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['injections_company']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
    <?php } ?>
    <!-- injection -->
    <?php if(isset($medicine_result) && !empty($medicine_result)) { ?>
        <hr />
        <h3>Medicine lists</h3>
        <hr />
		<table style="width:100%;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Serial</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Quantity</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                    </tr>
                    <?php foreach($medicine_result as $key => $val){	?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['medicine_serial']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_item_name($val['medicine_serial']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['medicine_quantity']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['medicine_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['medicine_company']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
    <?php } ?>    
    <!-- procedure -->    
	<?php  $procedures = unserialize($data['data']); if(isset($procedures) && !empty($procedures)) { ?>
        <hr />
        <h3>Procedures details</h3>
        <hr />
          <table style="width:100%;">
              <tr>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Procedure</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount</th>
              </tr>
              <?php foreach($procedures['patient_procedures'] as $key => $val){ ?>
              <tr>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_procedure_name($val['sub_procedure']); ?></td>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['sub_procedures_code']?></td>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_price']?></td>
                  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_discount']?></td>
              </tr>
              <?php } ?>
          </table>
    <?php } ?>
</div>
</div>

  <div class="panel-body profile-edit" id="print_this_section" style="display:none;">
	<h3>Billing Details</h3>
    <hr />
<table style="width:100%;">
     <tr style="border:1px solid #000; width:100%; display:none;" id="medinfologo_tr">
        <td style="border:1px solid #000; width:100%;text-align:center;" colspan="3">
           <?php 
    if(!empty($center_data['upload_photo_1'])){
?>
        <img src="<?php echo $center_data['upload_photo_1'];?>" class="img-responsive" style="width:200px" />
<?php } else {?>
        <img src="<?php echo base_url('assets/images/indiaivf-logo.png'); ?>" class="img-responsive" style="width:200px" />
        <p>(A UNIT OF PASHUPATI LIFECARE PVT LTD)</p>
<?php  } ?>
        </td>
    </tr>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Receipt number:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['receipt_number'];?></td>
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
  <?php if($data['transaction_id'] > 0){?>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Transaction ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['transaction_id'];?>
  	    <?php if(!empty($data['transaction_img'])){?> <a href="<?php echo $data['transaction_img']; ?>" class="hide_print" download>Download transaction Image</a> <?php }?>
    </td>
  </tr>
  <?php } ?>
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
  <?php if($data['hospital_id'] != ""){?>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Hospital ID:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['hospital_id'];?></td>
  </tr>
  <?php } ?>
  <?php if($data['reason_of_visit'] != ""){?>
  <tr>
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Reason of visit:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['reason_of_visit'];?></td>
  </tr>
  <?php } ?>
  <tr class="hide_print">
    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Package form:</th>
    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php if(!empty($data['package_form'])){?><a href="<?php echo $data['package_form'];?>" download>Download package form</a><?php }else{ echo 'No File'; }?></td>
  </tr>
</table>
<div>
	<?php $item_lists = $all_method->get_patient_items($data['receipt_number'], $data['patient_id']);
		  $consumable_result = $injection_result = $medicine_result = array();
	  	  $consumable_result = $item_lists['consumable_result'];
	  	  $injection_result = $item_lists['injection_result'];
	  	  $medicine_result = $item_lists['medicine_result'];
	?>
    
    <!-- consumables -->
    <?php if(isset($consumable_result) && !empty($consumable_result)) { ?>
        <hr />
        <h3>Consumable lists</h3>
        <hr />
		<table style="width:100%;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Serial</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Quantity</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                    </tr>
                    <?php foreach($consumable_result as $key => $val){	?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['consumables_serial']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_item_name($val['consumables_serial']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['consumables_quantity']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['consumables_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['consumables_company']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
    <?php } ?>
    <!-- medicine -->
    <?php if(isset($injection_result) && !empty($injection_result)) { ?>
        <hr />
        <h3>Injection lists</h3>
        <hr />
		<table style="width:100%;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Serial</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Quantity</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                    </tr>
                    <?php foreach($injection_result as $key => $val){	?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['injections_serial']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_item_name($val['injections_serial']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['injections_quantity']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['injections_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['injections_company']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
    <?php } ?>
    <!-- injection -->
    <?php if(isset($medicine_result) && !empty($medicine_result)) { ?>
        <hr />
        <h3>Medicine lists</h3>
        <hr />
		<table style="width:100%;">
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Serial</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Quantity</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                        <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                    </tr>
                    <?php foreach($medicine_result as $key => $val){	?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['medicine_serial']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_item_name($val['medicine_serial']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['medicine_quantity']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['medicine_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $val['medicine_company']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
    <?php } ?>    
    <!-- procedure -->    
    <?php  $procedures = unserialize($data['data']); if(isset($procedures) && !empty($procedures)) { ?>
        <hr />
        <h3>Procedures details</h3>
        <hr />
		<table style="width:100%;">
        <tr>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Sub Procedure</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
            <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount</th>
        </tr>
        <?php foreach($procedures['patient_procedures'] as $key => $val){//var_dump($val);die;	?>
        <tr>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_procedure_name($val['sub_procedure']); ?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['sub_procedures_code']?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_price']?></td>
            <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency; ?><?php echo $val['sub_procedures_discount']?></td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
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