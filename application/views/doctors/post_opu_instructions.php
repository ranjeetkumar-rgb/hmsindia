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
    <div class="card-action"><h3>POST OPU INSTRUCTIONS</h3></div>
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
		<div class="col-lg-12"><img src="https://indiaivf.website/Anaesthesia.jpeg" class="center" style="width:250px;margin:0px 300px;"></div>
            <div class="ga-pro">
			
                <h2 style="text-align: center;">POST OVUM PICK UP (OPU) INSTRUCTIONS </h2>
                <form action="" enctype="multipart/form-data" method="post">
                    <table width="100%" class="">
                        <h3>What to expect post OPU:</h3>
						<ul>
							<li>You may feel some pelvic heaviness or soreness and cramping </li>
							<li>You may have light vaginal bleeding or spotting for 1 to 2 days after your procedure. This is normal.</li>
						</ul>
						<ul>
							<li>Rest at home for the rest of the day </li>
							<li>Have someone with you to help care for you </li>
							<li>You received an anesthetic during your egg retrieval. This medicine helped you relax, but it may affect 
							your judgment and ability to think for a short while. Because of this risk, during the next 24 hours, DO NOT:  </li>
							<li>– Drive </li>
							<li>– Use machinery or tools</li>
							<li>– Drink alcohol </li>
							<li>– Be responsible for the care of another person</li>
							<li>– Make important decisions or sign any legal documents </li>
							<li>You will be allowed liquids after about 2 hours of procedure followed by soft, light food diet for the rest of the day </li>
							<li> You may shower as desired </li>
							<li> <strong>For 2 weeks</strong> after your retrieval, do not have sexual intercourse </li>
							</ul>
						<p>Rush to nearby hospital in case of the following symptoms:</p>
						<ul>	
							<li>– Heavy bleeding (soaking a full-sized sanitary pad with bright red blood in less than 1 hour) </li>
							<li>– Severe pain that is not eased by pain medicine </li>
							<li>– Nausea or vomiting that will not go away</li>
							<li>– Dizziness or lightheadedness </li>
						</ul>
						<ul>
							<li>Balance your intake of protein and carbohydrates </li>
							<li>Add more vegetables to your diet along with salad  </li>
							<li>Have fresh fruits</li>
							<li>Can have eggs </li>
							<li>Have food rich in fiber to help your bowel movement</li>
							<li>Avoid having caffeine  </li>
							<li>Avoid canned food </li>
							<li>Avoid eating sweets</li>
							<li>Avoid foods containing salt such as chips, salty puffed snacks, junk </li>
							<li>Stay hydrated by drinking plenty of water and fresh juice </li>
						</ul>

						<p>IF YOU ARE UNDERGOING EMBRYO TRANSFER, ASK YOUR DOCTOR FOR INSTRUCTIONS RELATED TO ET. Read instructions carefully & ask doubts, if any.</p>

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
   <td style="width:50%;padding:5px;" colspan="2"><h3 style="margin-top:20px;">POST OVUM PICK UP (OPU) INSTRUCTIONS</h3></td>
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
                         <h3>What to expect post OPU:</h3>
						<ul>
							<li>You may feel some pelvic heaviness or soreness and cramping </li>
							<li>You may have light vaginal bleeding or spotting for 1 to 2 days after your procedure. This is normal.</li>
						</ul>
						<ul>
							<li>Rest at home for the rest of the day </li>
							<li>Have someone with you to help care for you </li>
							<li>You received an anesthetic during your egg retrieval. This medicine helped you relax, but it may affect 
							your judgment and ability to think for a short while. Because of this risk, during the next 24 hours, DO NOT:  </li>
							<li>– Drive </li>
							<li>– Use machinery or tools</li>
							<li>– Drink alcohol </li>
							<li>– Be responsible for the care of another person</li>
							<li>– Make important decisions or sign any legal documents </li>
							<li>You will be allowed liquids after about 2 hours of procedure followed by soft, light food diet for the rest of the day </li>
							<li> You may shower as desired </li>
							<li> <strong>For 2 weeks</strong> after your retrieval, do not have sexual intercourse </li>
							</ul>
						<p>Rush to nearby hospital in case of the following symptoms:</p>
						<ul>	
							<li>– Heavy bleeding (soaking a full-sized sanitary pad with bright red blood in less than 1 hour) </li>
							<li>– Severe pain that is not eased by pain medicine </li>
							<li>– Nausea or vomiting that will not go away</li>
							<li>– Dizziness or lightheadedness </li>
						</ul>
						<ul>
							<li>Balance your intake of protein and carbohydrates </li>
							<li>Add more vegetables to your diet along with salad  </li>
							<li>Have fresh fruits</li>
							<li>Can have eggs </li>
							<li>Have food rich in fiber to help your bowel movement</li>
							<li>Avoid having caffeine  </li>
							<li>Avoid canned food </li>
							<li>Avoid eating sweets</li>
							<li>Avoid foods containing salt such as chips, salty puffed snacks, junk </li>
							<li>Stay hydrated by drinking plenty of water and fresh juice </li>
						</ul>

						<p>IF YOU ARE UNDERGOING EMBRYO TRANSFER, ASK YOUR DOCTOR FOR INSTRUCTIONS RELATED TO ET. Read instructions carefully & ask doubts, if any.</p>
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
