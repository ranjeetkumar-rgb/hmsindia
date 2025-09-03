<?php 
$sql = "SELECT * From hms_doctor_consultation where ID='".$data['ID']."'";
$select_result = run_select_query($sql);

$sql3 = "SELECT * From hms_patients where  patient_id='".$data['patient_id']."'";
$select_result3 = run_select_query($sql3);
?>
<div class="card">
<div class="card-content">
<div class="row">
<div class="ga-pro">
<h2 style="text-align:center;"></h2>
<form action="" method="post" >
<input type="hidden"  name="action" value="addprocedure">
<input type="hidden" value="<?php echo $data['patient_id']; ?>" id="patient_id" name="patient_id" class="form-control">
<input type="hidden" value="<?php echo $data['appointment_id']; ?>" id="appointment_id" name="appointment_id" class="form-control">
<input type="hidden" value="<?php echo date("Y-m-d h:i:s"); ?>" id="date" name="date" class="form-control">
<input type="hidden" value="<?php echo date("Y-m-d"); ?>" id="add_on" name="add_on" class="form-control">
<input type="hidden" value="<?php echo $data['ID']; ?>" id="ID" name="ID" class="form-control">
<input type="hidden" value="1" id="status" name="status" class="form-control">
<input type="hidden" value="<?php echo $data['center_number']; ?>" name="center_number" id="center_number" class="form-control">
<input type="hidden" value="<?php echo $_SESSION['logged_counselor']['employee_number']; ?>" name="employee_number" id="employee_number" class="form-control">
<input type="hidden" value="<?php echo date("F"); ?>" name="month" id="month" class="form-control">
<table style="width:100%;margin-bottom:20px;">
<tbody>
<tr>
<td colspan="2" rowspan="2"><img src="<?php echo base_url(); ?>/assets/images/India-IVF-Logo-Option-5.png" style="width:220px"></td>	
<td colspan="1" style="font-size:14px;">Name of Wife : </td>
<td colspan="1"><input type="text" id="" name="" class="form-control" value="<?php echo $select_result3['wife_name']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
<td colspan="1" style="font-size:14px;">Age :</td>
<td colspan="1"><input type="text" id="" name="" class="form-control" value="<?php echo $select_result3['wife_age']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
</tr>
<tr>
<td colspan="1" style="font-size:14px;">Name of Husband:</td>
<td colspan="1"><input type="text" name="" id="" class="form-control" value="<?php echo $select_result3['husband_name']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
<td colspan="1" style="font-size:14px;">Age :</td>
<td colspan="1"><input type="text" id="" name="" class="form-control" value="<?php echo $select_result3['husband_age']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
</tr>
</tbody>
</table>



<table style="width:100%; border:1px solid #000;margin-top:20px;" id="">
<tbody>
<tr>
<th colspan="2" style="width:30%; border:1px solid #000;">Name</th>
<th colspan="1" style="width:20%; border:1px solid #000;">Code</th>
<th colspan="1" style="width:20%; border:1px solid #000;">Amount</th>
<th colspan="1" style="width:15%; border:1px solid #000;">Discount</th>
<th colspan="1" style="width:15%; border:1px solid #000;">After Discount</th>
<th colspan="1" style="width:15%; border:1px solid #000;"></th>
</tr>
<?php
if ($select_result['status'] == '0') { 
$sub_procedure_counter = 0;
$price = $femalemed_result['price'];

// Unserialize the data
$sub_procedure_suggestion_list = unserialize($data['sub_procedure_suggestion_list']);

// Check if unserialization was successful
if ($sub_procedure_suggestion_list !== false && is_array($sub_procedure_suggestion_list)) {
    // Display each item in the array
	
    foreach ($sub_procedure_suggestion_list as $item) {
       $sql_quefe = "SELECT * FROM `hms_procedures` WHERE ID = '$item'";
		$femalemed_result = run_select_query($sql_quefe);
		
		if ($femalemed_result) {
			$sub_procedure_counter++;
			
			$procedureData = unserialize($select_result['procedure']);
			?>
		<tr>
<td colspan="2" style="font-size:14px; border:1px solid #000;"> <input type="hidden" id="procedure_ID_<?= $sub_procedure_counter ?>" name="procedure_ID_<?= $sub_procedure_counter ?>" value="<?= htmlspecialchars($femalemed_result['ID']) ?>" readonly>
                            <input type="text" id="procedure_name_<?php echo $sub_procedure_counter; ?>" name="procedure_name_<?php echo $sub_procedure_counter; ?>" value="<?php echo $femalemed_result['procedure_name']; ?>" readonly=""></td>
<td colspan="1" style="font-size:14px; border:1px solid #000;"><input type="text" id="code_<?php echo $sub_procedure_counter; ?>" name="code_<?php echo $sub_procedure_counter; ?>" value="<?php echo $femalemed_result['code']; ?>" readonly=""></td>
<td colspan="1" style="font-size:14px; border:1px solid #000;"><input type="text" id="price_<?php echo $sub_procedure_counter; ?>" name="price_<?php echo $sub_procedure_counter; ?>" value="<?php echo $femalemed_result['price']; ?>" readonly=""></td>
<td colspan="1" style="font-size:14px; border:1px solid #000;"><input type="text" id="discount_<?php echo $sub_procedure_counter; ?>" name="discount_<?php echo $sub_procedure_counter; ?>" value="<?php if (isset($procedureData['consumables'][0]['discount'])) {
    echo $procedureData['consumables'][0]['discount'];
} ?>" required=""></td>
<td colspan="1" style="font-size:14px; border:1px solid #000;"><input type="text" readonly="" id="after_discount_<?php echo $sub_procedure_counter; ?>" name="after_discount_<?php echo $sub_procedure_counter; ?>" value="<?php if (isset($procedureData['consumables'][0]['after_discount'])) {
    echo $procedureData['consumables'][0]['after_discount'];
} ?>"></td>
</tr>
	<?php	 } 
	
    } 
} else {
    echo "No valid data found.";
} //$sub_procedure_counter++;
}
?>

<?php
if ($select_result['status'] == '1') { 
$procedureData = unserialize($select_result['procedure']);

if (!empty($procedureData['consumables'])) {
    foreach ($procedureData['consumables'] as $consumable) {
        ?>
        <tr>
          <td colspan="2" width="40%" style="border:1px solid;padding:5px;"><?php echo $consumable['procedure_name']; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;"><?php echo $consumable['code']; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;"><?php echo $consumable['price']; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;"><?php echo $consumable['discount'] ?? 0; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;">
            <?php echo (float)($consumable['price']) - (float)($consumable['discount']); ?>
          </td>
        </tr>
        <?php
    }
} else {
    echo "No procedures found.";
}
}
?>

</tbody>
</table>

<table width="100%" class="">
<tbody>
<tr><td colspan="6"><strong style="margin-left:20px;">Terms &amp; Conditions (The above-mentioned package)</strong></td></tr>
<tr><td colspan="6"><strong>Includes:</strong></td></tr>
<tr><td colspan="6"><p style="margin-left:20px;font-size:14px;">* Doctor consultation charges (During IVF Cycle only) (up to 5 consultations only). Single Self Egg &amp;Sperm IVF Cycle up to
EmbryoTransfer. Monitoring Ultrasound {From Stimulation to embryo transfer (Single Cycle)}, Ovulation Induction Injections only for
making egg pre ovum pick up. Admission charges (Short stay room rent for OPU andET). Anesthetist charges for ovum pick uponly.
IVF consumables charges for ovum pick up and ET without complication. Embryologist and surgeon charges till single embryo transfer.</p></td></tr>
<tr><td colspan="6"><strong>Excludes:</strong></td></tr>
<tr><td colspan="6"><p style="margin-left:20px;font-size:14px;">Any other medicine except ovulation inductioninjection. Discharge medicines for ovum pick up and embryotransfer. General anesthesia
for embryo transfer, anesthesia fees, consumables, OTChargesetc. Pre and Post IVFConsultations. Investigations notincluded. Any Complication in OT during Ovum pick up & Embryo transfer (Pre & Post). Meals & Lodging forpatients. SurrogacyCharges. Egg donor charges according to eggdonor. Sperm donor charges perdonor.</p></td></tr>
<tr><td colspan="6"><strong>Note:</strong> Booking amount not refundable and 25% of package cost should be deposited within 10 days of Registration, failing to
which the package will automatically stand cancelled without prior notification.</td></tr>
<tr><td><strong>►We do not do preconception sex selection and we don’t allow sex determination</strong></td></tr>
</tbody>
</table>
<table width="100%" class="">
<tbody>
<tr><td colspan="6"><strong>Payment Details: </strong></td></tr>	
<tr>
<td colspan="2" style="font-size:12px;">Total Package</td>	
<?php if ($select_result['status'] == '1') { ?>
<td colspan="2">Rs: <input type="text" id="" name="" value="<?php echo $select_result['total_after_discount']; ?>" style="border-top:0px;border-left:0px;border-right:0px;"></td>
<?php } if ($select_result['status'] == '0') { ?>
<td colspan="2">Rs: <input type="text" id="total_after_discount" name="total_after_discount" value="<?php echo $select_result['total_after_discount']; ?>" style="border-top:0px;border-left:0px;border-right:0px;"></td>
<?php } ?>

<td colspan="2">Date: <input type="date" id="package_date" name="package_date" value="<?php echo $select_result['package_date']; ?>" style="border-top:0px;border-left:0px;border-right:0px;" required=""></td>
</tr>
<tr>
<td colspan="2" style="font-size:12px;">Booking Amount (10 %)</td>	
<td colspan="2">Rs: <input type="text" id="booking_amount" value="<?php echo $select_result['booking_amount']; ?>" name="booking_amount" style="border-top:0px;border-left:0px;border-right:0px;" required=""></td>
<td colspan="2">Date: <input type="date"  value="<?php echo $select_result['booking_date']; ?>" id="booking_date" name="booking_date" required="" style="border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>
<tr>
<td colspan="2" style="font-size:12px;">Deposit on the start of tretment Self / Third Party (40%)</td>	
<td colspan="2">Rs: <input type="text" id="name29" value="" style="border-top:0px;border-left:0px;border-right:0px;"></td>
<td colspan="2">Date: <input type="date" id="name30" value="" style="border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>
<tr>
<td colspan="2" style="font-size:12px;">Deposit on the Day of trigger / Progesterone Change (50%)</td>	
<td colspan="2">Rs: <input type="text" id="name29" value="" style="border-top:0px;border-left:0px;border-right:0px;"></td>
<td colspan="2">Date: <input type="date" id="name30" value="" style="border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>
</thead>
</table>

<table style="width:100%;" id="male_medicine_table" border="1">
<tbody id="male_medicine_suggestion_table" style="border:1px solid #000; padding:10px; width:100%;">
<tr>
<td colspan="2" style="font-size:14px;width:40%">Husband Name: <input type="text" readonly="" id="" value="<?php echo $select_result3['husband_name']; ?>" style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>	
<td colspan="2" style="font-size:14px;">Wife Name: <input type="text"  id="" readonly="" value="<?php echo $select_result3['wife_name']; ?>"style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>
<td colspan="2" style="font-size:14px;">Counsellor Name: <input type="text" readonly="" name="counsellor_signature" id="counsellor_signature" value="<?php echo $_SESSION['logged_counselor']['name']?>" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>

<tr>
<td colspan="2" style="font-size:14px;width:40%">Husband Signature: <input type="text"  id="name29" value="" style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>	
<td colspan="2" style="font-size:14px;">Wife Signature: <input type="text"  id="name29" value=""style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>
<td colspan="2" style="font-size:14px;">Counsellor Signature: <input type="text"  name="" id="" value="<?php echo $select_result['counsellor_signature']; ?>" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>

<tr>
<td colspan="2" style="font-size:14px;width:40%">Coordinator Signature : <input type="text"  id="coordinator_signature" name="coordinator_signature" value="<?php echo $select_result['coordinator_signature']; ?>" style="width:100px;border-top:0px;border-left:0px;border-right:0px;"></td>	
<td colspan="2">Date: <input type="date"  id="name29" value="" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
<td colspan="2">Time: <input type="time"   id="name30" value="" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>
</tbody>
</table>

<table id="male_medicine_table">
<tbody id="male_medicine_suggestion_table" style="padding:10px; width:100%;">
<tr>
<td colspan="6" style="font-size:14px;text-align:center;"><strong>Medical Management | Fertility enhancing surgeries | Follicular monitoring | IUI | IVF-ICSI | Egg Donation |
Surrogacy | Embryo Freezing | Male Infertility | TESA/PESA | Laparo-hystero Surgeries |</strong></td>	
</tr>
</tbody>
</table>
<input type='submit' id='btnsubmit' value='Submit' class="btn btn-primary pull-right">
</form>
<?php if ($select_result['status'] == '1') { ?>
<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv2();'>
<?php } ?>
</div> 
</div>
</div>
</div>


<div class="row" id="print_this_section2" style="display:none;">
<form action="" enctype='multipart/form-data' method="post">
<div class="ga-pro">
<table style="width:100%;" class="fg45yu">
  <tr>
   <td style="width:20%;padding:5px;" colspan="2" rowspan="2"><img src="<?php echo base_url(); ?>/assets/images/India-IVF-Logo-Option-5.png" style="width:220px"></td>
   <td colspan="1" style="font-size:14px;">Name of Wife : </td>
   <td colspan="1"><input type="text" id="wife_name" name="wife_name" class="form-control" value="<?php echo $select_result3['wife_name']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
   <td colspan="1" style="font-size:14px;">Age :</td>
   <td colspan="1"><input type="text" id="wife_age" name="wife_age" class="form-control" value="<?php echo $select_result3['wife_age']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
  </tr>
  <tr>
<td colspan="1" style="font-size:14px;">Name of Husband:</td>
<td colspan="1"><input type="text" name="husband_name" id="husband_name" class="form-control" value="<?php echo $select_result3['husband_name']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
<td colspan="1" style="font-size:14px;">Age :</td>
<td colspan="1"><input type="text" id="husband_age" name="husband_age" class="form-control" value="<?php echo $select_result3['husband_age']; ?>" style="width:150px;border-top:0px;border-left:0px;border-right:0px;" readonly=""></td>
</tr>
</table>

<table width="100%" style="margin-top:5px;" class="vb45rt">
<tbody>
<tr>
<td colspan="6" width="100%" style="border:1px solid;padding:5px;"><strong>Procedure:</strong></td>
</tr>
<tr>
<th colspan="2" width="40%" style="border:1px solid;padding:5px;">Name</th>
<th colspan="1" width="15%" style="border:1px solid;padding:5px;">Code</th>
<th colspan="1" width="15%" style="border:1px solid;padding:5px;">Amount</th>
<th colspan="1" width="15%" style="border:1px solid;padding:5px;">Discount</th>
<th colspan="1" width="15%" style="border:1px solid;padding:5px;">After Discount</th>
</tr>


<?php
$procedureData = unserialize($select_result['procedure']);

if (!empty($procedureData['consumables'])) {
    foreach ($procedureData['consumables'] as $consumable) {
        ?>
        <tr>
          <td colspan="2" width="40%" style="border:1px solid;padding:5px;"><?php echo $consumable['procedure_name']; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;"><?php echo $consumable['code']; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;"><?php echo $consumable['price']; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;"><?php echo $consumable['discount'] ?? 0; ?></td>

          <td colspan="1" width="15%" style="border:1px solid;padding:5px;">
            <?php echo (float)($consumable['price']) - (float)($consumable['discount']); ?>
          </td>
        </tr>
        <?php
    }
} else {
    echo "No procedures found.";
}
?>


<tr>
<td colspan="6">
<strong>Terms & Conditions (The above-mentioned package)</td>
</tr>
<tr>
<td colspan="6">Includes:</td>
</tr>
<tr>
<td colspan="6">
* Doctor consultation charges (During IVF Cycle only) (up to 5 consultations only). Single Self Egg &Sperm IVF Cycle up to EmbryoTransfer. Monitoring Ultrasound {From Stimulation to embryo transfer (Single Cycle)}, Ovulation Induction Injections only for making egg pre ovum pick up. Admission charges (Short stay room rent for OPU andET). Anesthetist charges for ovum pick uponly. IVF consumables charges for ovum pick up and ET without complication. Embryologist and surgeon charges till single embryo transfer.
</td>
</tr>
<tr>
<td colspan="6">
<strong>Excludes:</strong>
</td>
</tr>
<tr>
<td colspan="6">
Any other medicine except ovulation inductioninjection. Discharge medicines for ovum pick up and embryotransfer. General anesthesia for embryo transfer, anesthesia fees, consumables, OTChargesetc. Pre and Post IVFConsultations. Investigations notincluded. Any Complication in OT during Ovum pick up & Embryo transfer (Pre & Post). Meals & Lodging forpatients. SurrogacyCharges. Egg donor charges according to eggdonor. Sperm donor charges perdonor.
</td>
</tr>
<tr>
<td colspan="6">
Note: Booking amount not refundable and 25% of package cost should be deposited within 10 days of Registration, failing to which the package will automatically stand cancelled without prior notification.
</td>
</tr>
<tr>
<td colspan="6">
►We do not do preconception sex selection and we don’t allow sex determination</td>
</tr>
</tbody>
</table> 

<table width="100%" class="">
<tbody>
<tr><td colspan="6"><strong>Payment Details:</strong></td></tr>	
<tr>
<td width="50%" colspan="2" style="font-size:12px;">Total Package</td>	
<td width="25%" colspan="2">Rs: <input type="text" readonly="" id="name29" value="<?php echo $select_result['total_after_discount']; ?>" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
<td width="25%" colspan="2">Date: <input type="text" value="<?php echo $select_result['package_date']; ?>" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
</tr>
<tr>
<td width="50%" colspan="2" style="font-size:12px;">Booking Amount (10 %)</td>	
<td width="25%" colspan="2">Rs: <input type="text" id="name29" value="<?php echo $select_result['booking_amount']; ?>" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
<td width="25%" colspan="2">Date: <input type="text"   id="name30" value="<?php echo $select_result['booking_date']; ?>" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
</tr>
<tr>
<td width="50%" colspan="2" style="font-size:12px;">Deposit on the start of treatment Self /Third Party (40%)</td>	
<td width="25%" colspan="2">Rs: <input type="text" id="name29" value="" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
<td width="25%" colspan="2">Date: <input type="text" id="name30" value="" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
</tr>
<tr>
<td width="50%" colspan="2" style="font-size:12px;">Deposit on the Day of trigger / progesterone charge (50%)</td>	
<td width="25%" colspan="2">Rs: <input type="text" id="name29" value="" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
<td width="25%" colspan="2">Date: <input type="text" id="name30" value="" style="border-top:0px;border-left:0px;border-right:0px;width:200px;"></td>
</tr>
</thead>
</table>

<table style="width:100%;" id="male_medicine_table" border="1">
<tbody id="male_medicine_suggestion_table" style="border:1px solid #000; padding:10px; width:100%;">
<tr>
<td colspan="2" style="font-size:14px;width:40%">Husband Name: <input type="text" readonly="" id="" value="<?php echo $select_result3['husband_name']; ?>" style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>	
<td colspan="2" style="font-size:14px;">Wife Name: <input type="text"  id="" readonly="" value="<?php echo $select_result3['wife_name']; ?>"style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>
<td colspan="2" style="font-size:14px;">Counsellor Name: <input type="text" readonly="" name="counsellor_signature" id="counsellor_signature" value="<?php echo $_SESSION['logged_counselor']['name']?>" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>

<tr>
<td colspan="2" style="font-size:14px;width:40%">Husband Signature: <input type="text"  id="name29" value="" style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>	
<td colspan="2" style="font-size:14px;">Wife Signature: <input type="text"  id="name29" value=""style="width:200px;border-top:0px;border-left:0px;border-right:0px;" ></td>
<td colspan="2" style="font-size:14px;">Counsellor Signature: <input type="text"  name="" id="" value="<?php echo $select_result['counsellor_signature']; ?>" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>

<tr>
<td colspan="2" style="font-size:14px;width:40%">Coordinator Signature : <input type="text"  id="coordinator_signature" name="coordinator_signature" value="<?php echo $select_result['coordinator_signature']; ?>" style="width:100px;border-top:0px;border-left:0px;border-right:0px;"></td>	
<td colspan="2">Date: <input type="date"  id="name29" value="" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
<td colspan="2">Time: <input type="time"   id="name30" value="" style="width:200px;border-top:0px;border-left:0px;border-right:0px;"></td>
</tr>
</tbody>
</table>

<table id="male_medicine_table">
<tbody id="male_medicine_suggestion_table" style="padding:10px; width:100%;">
<tr>
<td colspan="6" style="font-size:14px;text-align:center;"><strong>Medical Management | Fertility enhancing surgeries | Follicular monitoring | IUI | IVF-ICSI | Egg Donation |
Surrogacy | Embryo Freezing | Male Infertility | TESA/PESA | Laparo-hystero Surgeries |</strong></td>	
</tr>
</tbody>
</table>

</form>
</div>

<style>
td strong {
    font-size: 13px!important;
	line-height:30px;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
table tr td{
	line-height:30px;
	font-size:14px;	
}
[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: static!important;
    left: -9999px;
    opacity: 1!important;
}
</style>
<script>
function printDiv2() {
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section2');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
</script>  



<script>
document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll("tbody tr");
    const totalAfterDiscountField = document.getElementById("total_after_discount");

    function updateTotalAfterDiscount() {
        let total = 0;
        
        document.querySelectorAll("input[id^='after_discount_']").forEach(input => {
            total += parseFloat(input.value) || 0;
        });

        totalAfterDiscountField.value = total.toFixed(2); // Show with two decimal places
    }

    rows.forEach((row) => {
        if (!row.querySelector("input[id^='price_']")) return;

        const priceField = row.querySelector(`input[id^='price_']`);
        const discountField = row.querySelector(`input[id^='discount_']`);
        const afterDiscountField = row.querySelector(`input[id^='after_discount_']`);

        function calculateAfterDiscount() {
            const price = parseFloat(priceField.value) || 0;
            const discount = parseFloat(discountField.value) || 0;
            const afterDiscount = price - discount;
            afterDiscountField.value = afterDiscount.toFixed(2);

            updateTotalAfterDiscount(); // Update total after discount
        }

        // Listen for changes in the discount field
        discountField.addEventListener("input", calculateAfterDiscount);

        // Trigger calculation on page load
        calculateAfterDiscount();
    });

    // Initial sum calculation
    updateTotalAfterDiscount();
});
</script>




