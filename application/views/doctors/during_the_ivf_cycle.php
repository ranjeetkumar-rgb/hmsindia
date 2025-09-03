<?php $all_method =&get_instance();

	$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$data['patient_id']."'";
	$select_result1 = run_select_query($sql1);
	
	$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
	$select_result2 = run_select_query($sql2);
	
	$sql3 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
	$select_result3 = run_select_query($sql3);
?>
<div class="col-md-12">
  <!-- Advanced Tables -->
   <div class="card">
    <div class="card-action"><h3>GENERAL INSTRUCTIONS PRIOR TO EMBRYO TRANSFER</h3></div>
	<div class="clearfix"></div>
	 <div class="card-content">
	 <p id="whatsappmessg"></p>
    	<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv2();'>
		
    	<input type='button' id='btn' value='Send to Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $data['wife_phone']; ?>");'>
  
<div class="">
    <div class="card-content">
	<table width="100%" class="vb45rt" style="margin-top:30px;">
<tbody>
<tr style="background: #b3b9b7;">
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></strong>
</td>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $data['patient_id']; ?></strong>
</td>
</tr>
<tr>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Female Name : <?php echo $data['wife_name']; ?> </strong>
</td>
<td width="50%" style="border:1px solid;padding:5px;">
<strong>Male Name :  <?php echo $data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Age:  <?php echo $data['wife_age']; ?> Year</strong>
</td>
<td width="50%" style="border:1px solid;padding:5px;">
<strong>Age: <?php echo $data['husband_age']; ?> Year</strong>
</td>
</tr>
</tbody>
</table> 
        <div class="row" id="myfrm2">
		    <div class="ga-pro">
			
                <h2 style="text-align: center;">Where every day a mother is born</h2>
                <form action="" enctype="multipart/form-data" method="post">
                    <table width="100%" class="">
                        <h3> During the IVF cycle</h3>
						<ul>
							<li>The quest to being healthy continues with a balanced diet
							<li>Do make sure to get at least eight hours of adequate sleep
							<li>Drink lots of water and fluids
							<li>The no smoking and drinking alcohol rule continues (For both male and female)
							<li>So does the reduced caffeine intake to one or two cups a day
							<li>Do not take any medication even the over-the-counter medication without consulting your doctor
							<li>Avoid foods like fish throughout the treatment as they are high in mercury and can be harmful
							<li>Do not expose yourself and your partner to extreme heat or radiation as it may reduces fertility
							<li>Keep exercising in moderation
							<li>In case of OHSS (Ovarian hyper stimulation syndrome), drink lots of fluids. Drinking about three to four liters of water can help prevent OHSS.
							<li>Consult your doctor about baby aspirin. It is a blood thinner improves implantation by increasing blood flow to the uterus.
							<li>Good control of all medical disorders like hypothyroidism, diabetes, hypertension et</li>
						</ul>

					</table>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row" id="print_this_section2" style="display:none;">
<form action="" enctype='multipart/form-data' method="post">
<div class="ga-pro">
<table style="border:1px solid;width:100%;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="2"><img src="https://indiaivf.website/assets/images/india-ivf-logo.webp"></td>
   <td style="width:50%;padding:5px;" colspan="2"><h3 style="margin-top:20px;">Where every day a mother is born</h3></td>
   </tr>
</table>

<table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></strong>
</td>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $data['patient_id']; ?></strong>
</td>
</tr>
<tr>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Female Name : <?php echo $data['wife_name']; ?> </strong>
</td>
<td width="50%" style="border:1px solid;padding:5px;">
<strong>Male Name :  <?php echo $data['husband_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="2" width="50%" style="border:1px solid;padding:5px;">
<strong>Age:  <?php echo $data['wife_age']; ?> Year</strong>
</td>
<td width="50%" style="border:1px solid;padding:5px;">
<strong>Age: <?php echo $data['husband_age']; ?> Year</strong>
</td>
</tr>
</tbody>
</table> 
<table width="100%" >
<tbody>
<tr>
<td style="border:1px solid;padding:5px;">
                        <h3> During the IVF cycle</h3>
						<ul>
							<li>The quest to being healthy continues with a balanced diet
							<li>Do make sure to get at least eight hours of adequate sleep
							<li>Drink lots of water and fluids
							<li>The no smoking and drinking alcohol rule continues (For both male and female)
							<li>So does the reduced caffeine intake to one or two cups a day
							<li>Do not take any medication even the over-the-counter medication without consulting your doctor
							<li>Avoid foods like fish throughout the treatment as they are high in mercury and can be harmful
							<li>Do not expose yourself and your partner to extreme heat or radiation as it may reduces fertility
							<li>Keep exercising in moderation
							<li>In case of OHSS (Ovarian hyper stimulation syndrome), drink lots of fluids. Drinking about three to four liters of water can help prevent OHSS.
							<li>Consult your doctor about baby aspirin. It is a blood thinner improves implantation by increasing blood flow to the uterus.
							<li>Good control of all medical disorders like hypothyroidism, diabetes, hypertension et</li>
						</ul>
</td>
</tr>
</tbody>
                    </table>       
</div>  
</form>
</div>
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
function sendonwhatsapp() 
{
    var data = {'iic_id':<?php echo $data['patient_id']; ?>, 'html': $("#print_this_section2").html()};
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
<style>
    table,
    th,
    td {
        border: 0px;
    }
    .sec3 {
        border: 1px solid #000;
        padding: 5px;
    }
    .sec2 {
        border: 1px solid #000;
    }
    .sec2 p {
        margin: 0px;
        padding: 2px 10px;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    .ga-pro h3 {
        text-align: center;
        font-size: 25px;
    }
    form {
        padding-left: 10px;
        margin-bottom: 4px;
    }
    .nb56ty {
        border: 1px solid #000;
    }
    .nb56ty input {
        width: 100%;
    }
    .vb45rt td {
        text-align: left;
        padding-left: 10px;
    }
    table th,
    table td {
        padding: 10px 10px;
        text-align: left;
    }
	.col-lg-8 img{text-align:center;}
</style>
