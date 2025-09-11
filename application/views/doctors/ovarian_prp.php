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
    <div class="card-action"><h3>DOs & DON'Ts</h3></div>
	<div class="clearfix"></div>
	 <div class="card-content">
	 <p id="whatsappmessg"></p>
    	<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv2();'>
		
    	<input type='button' id='btn' value='Send to Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $data['wife_phone']; ?>");'>
    	
  <div class="row">
   <div class="">
  
   
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
			
                <h2 style="text-align: center;">DOs & DON'Ts</h2>
                <form action="" enctype="multipart/form-data" method="post">
                    <table width="100%" class="">
                        <h3>Do's</h3>
						<ul>
							<li>Continue staying healthy and eating well</li>
							<li>Try to stay relaxed and keep your stress level low. Exercise, Yoga, Medication might help</li>
							<li>Always eat fresh and home-cooked food and avoid food older than 12 hours</li>
							<li>Do not dift heavy weights or strain yourself physically</li>
							<li>Get adequate sleep</li>
							<li>Drink lots of water (4-6 Litres)</li>
							<li>Good control of all medical disorders like hypothyroidism, diabetes, hypertension etc</li>
							<li>Stay Positive!</li>
							<li>Fill up on fresh fruits and vegetables.</li>
							<li>Choose lean proteins,</li>
							<li>Eat whole grains, like quinoa, farro, and whole-grain pasta.</li>
							<li>Add in legumes, including beans, chickpeas, and lentils.</li>
							<li>Switch to low-fat dairy products.</li>
							<li>Eat healthy fats, such as avocado, extra-virgin olive oil, nuts, and seeds.</li>
							<li>Follow diet chart with dietician if you have other medical disorder</li>
							<li>Light exercise is fine</li>
							<li>You can sleof on both sides or on your back.</li>
							<li>Use Natural Soap and Cosmetics</li>
							<li>Eat Green Leafy vegetables (3 servings)</li>
							<li>Eat Red colour fruits eg. Apple, strawberry, pomegranate, watermelon, beetroot, tomatoes (1-2 serving)</li>
							<li>Eat Citrus fruitseg, Oranges, lemon 1 serving)</li>
							<li>Eggs 2</li>
							<li>Almonds/walnut 2</li>
							<li>Replace normal tea with Fertility Tea as prescribes (no substitutes)</li>
							<li>Ghee 2 Teaspoon daily (uncooked)</li>
							<li>Exercise 1 fir daily brisk walk/ half an hour tertility yoga (search for the same on youtube)</li>
							<li>Supplements as suggested by us.</li>
							<li>Sugar only 2 spocs with restriction</li>
							<li>Rice only 1 spocs with restriction</li>
						</ul>
						<h3>Don'ts</h3>
						<ul>	
							<li>Avoid Stress</li>
							<li>No Smoking including passive smoking</li>
							<li>No Tobacco</li>
							<li>No Alcohol</li>
							<li>Avoid Junk food and packaged food</li>
							<li>Avoid foods like fish throughout the treatment as they are high in mercury and can be harmful</li>
							<li>Avoid food with preservatives</li>
							<li>Avoid high sugar foods like ice cream or candy</li>
							<li>Avoid aerated drinks / soda</li>
							<li>Avoid Refined oil</li>
							<li>Avoid refined flour (maida)</li>
							<li>Avoid chicken, red meat, sugar, refined grains, and other highly processed foods.</li>
							<li>Cut but salt. Flavor food with herbs and spices instead</li>
							<li>Avoid pineapple and papaya</li>
							<li>Avoid caffeine</li>
							<li>Avoid Potato</li>
							<li>Avoid High Carbohydrate Diet</li>
							<li>Avoid heavy exercise, aerobics, running</li>
							<li>In the three to four days before a sperm retrieval, men should avoid ejaculation, manually or vaginally</li>
							<li>Avoid deep vaginal intercourse, as this can irritate the cervix</li>
							<li>Avoid these chemicals Formaldehyde</li>
							<li>nail polish</li>
							<li>Parabens, triclosan, and benzophenone</li>
							<li>cosmetics</li>
							<li>moisturizers</li>
							<li>soap with chemicals</li>
							<li>BPA and ether phenols</li>
							<li>food packaging materials</li>
							<li>Per fluerinated compounds</li>
							<li>stain resistant materials</li>
							<li>non stick cooking tools</li>
							<li>Dioxins</li>
							<li>art clay</li>
							<li>Phthalates</li>
							<li>plastic</li>
							<li>medication coatings</li>
							<li>cosmetics with fragrance</li>
							<li>Do not sleep on the stomach</li>
							<li>Avoid wearing tight undergarments</li>
						</ul>

						<p>You may not be able to influence the outcome, but you can aid the process by following these few do's and don'ts to make your treatment a success.</p>

                    </table>
                </form>
            </div>
        </div>
</div>		
 </div>
     </div>
<div class="row" id="print_this_section2" style="display:none;">
<form action="" enctype='multipart/form-data' method="post">
<div class="ga-pro">
<table style="border:1px solid;width:100%;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="2"><img src="https://infra.indiaivf.website/assets/images/india-ivf-logo.webp"></td>
   <td style="width:50%;padding:5px;" colspan="2"><h3 style="margin-top:20px;">DOs & DON'Ts - OVARIAN PRP</h3></td>
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
                        <h3>Do's</h3>
						<ul>
							<li>Continue staying healthy and eating well</li>
							<li>Try to stay relaxed and keep your stress level low. Exercise, Yoga, Medication might help</li>
							<li>Always eat fresh and home-cooked food and avoid food older than 12 hours</li>
							<li>Do not dift heavy weights or strain yourself physically</li>
							<li>Get adequate sleep</li>
							<li>Drink lots of water (4-6 Litres)</li>
							<li>Good control of all medical disorders like hypothyroidism, diabetes, hypertension etc</li>
							<li>Stay Positive!</li>
							<li>Fill up on fresh fruits and vegetables.</li>
							<li>Choose lean proteins,</li>
							<li>Eat whole grains, like quinoa, farro, and whole-grain pasta.</li>
							<li>Add in legumes, including beans, chickpeas, and lentils.</li>
							<li>Switch to low-fat dairy products.</li>
							<li>Eat healthy fats, such as avocado, extra-virgin olive oil, nuts, and seeds.</li>
							<li>Follow diet chart with dietician if you have other medical disorder</li>
							<li>Light exercise is fine</li>
							<li>You can sleof on both sides or on your back.</li>
							<li>Use Natural Soap and Cosmetics</li>
							<li>Eat Green Leafy vegetables (3 servings)</li>
							<li>Eat Red colour fruits eg. Apple, strawberry, pomegranate, watermelon, beetroot, tomatoes (1-2 serving)</li>
							<li>Eat Citrus fruitseg, Oranges, lemon 1 serving)</li>
							<li>Eggs 2</li>
							<li>Almonds/walnut 2</li>
							<li>Replace normal tea with Fertility Tea as prescribes (no substitutes)</li>
							<li>Ghee 2 Teaspoon daily (uncooked)</li>
							<li>Exercise 1 fir daily brisk walk/ half an hour tertility yoga (search for the same on youtube)</li>
							<li>Supplements as suggested by us.</li>
							<li>Sugar only 2 spocs with restriction</li>
							<li>Rice only 1 spocs with restriction</li>
						</ul>
						<h3>Don'ts</h3>
						<ul>	
							<li>Avoid Stress</li>
							<li>No Smoking including passive smoking</li>
							<li>No Tobacco</li>
							<li>No Alcohol</li>
							<li>Avoid Junk food and packaged food</li>
							<li>Avoid foods like fish throughout the treatment as they are high in mercury and can be harmful</li>
							<li>Avoid food with preservatives</li>
							<li>Avoid high sugar foods like ice cream or candy</li>
							<li>Avoid aerated drinks / soda</li>
							<li>Avoid Refined oil</li>
							<li>Avoid refined flour (maida)</li>
							<li>Avoid chicken, red meat, sugar, refined grains, and other highly processed foods.</li>
							<li>Cut but salt. Flavor food with herbs and spices instead</li>
							<li>Avoid pineapple and papaya</li>
							<li>Avoid caffeine</li>
							<li>Avoid Potato</li>
							<li>Avoid High Carbohydrate Diet</li>
							<li>Avoid heavy exercise, aerobics, running</li>
							<li>In the three to four days before a sperm retrieval, men should avoid ejaculation, manually or vaginally</li>
							<li>Avoid deep vaginal intercourse, as this can irritate the cervix</li>
							<li>Avoid these chemicals Formaldehyde</li>
							<li>nail polish</li>
							<li>Parabens, triclosan, and benzophenone</li>
							<li>cosmetics</li>
							<li>moisturizers</li>
							<li>soap with chemicals</li>
							<li>BPA and ether phenols</li>
							<li>food packaging materials</li>
							<li>Per fluerinated compounds</li>
							<li>stain resistant materials</li>
							<li>non stick cooking tools</li>
							<li>Dioxins</li>
							<li>art clay</li>
							<li>Phthalates</li>
							<li>plastic</li>
							<li>medication coatings</li>
							<li>cosmetics with fragrance</li>
							<li>Do not sleep on the stomach</li>
							<li>Avoid wearing tight undergarments</li>
						</ul>

						<p>You may not be able to influence the outcome, but you can aid the process by following these few do's and don'ts to make your treatment a success.</p>
</td>
</tr>
</tbody>
                    </table>       
</div>  
</form>
</div>

 </div>
  </div>

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