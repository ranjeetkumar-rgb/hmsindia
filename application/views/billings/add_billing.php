<?php $all_method =&get_instance(); ?>
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data" >
  <input type="hidden" name="action" value="add_billing" />
  <input type="hidden" id="paitent_type" name="paitent_type" value="new_patient" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Patient Details</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
        <div class="row">
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="Phone number of wife" id="phone_number" by="phone" name="phone_number" type="text" class="form-control validate" >
          </div>
          <div class="form-group col-sm-1 col-xs-12">
          	<p>OR </p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="IIC ID" id="iic_id" by="patient" type="text" class="form-control validate" >
          </div>
          
          	<div class="form-group col-sm-3 col-xs-12">
                <input value="Search" id="search_patient" type="button" class="form-control validate" >
            </div>
        </div>        
        <hr/>        
        <div id="add_section" style="display:none;"> 
        <div class="row">
		   <div class="form-group col-sm-3 col-xs-12" align="center"></div>                               	
           <div class="form-group col-sm-6 col-xs-12" align="center">
                <label for="item_name">IIC ID (Required)</label>
                <input value="" placeholder="IIC ID" readonly="readonly" id="paitent_id" name="paitent_id" type="text" class="form-control validate" required>
           </div>
		   <div class="form-group col-sm-3 col-xs-12" align="center"></div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12" align="center">
                <h3 for="item_name">Wife details </h3>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12" align="center">
                <h3 for="item_name">Husband details </h3>
           </div>
         </div>
        
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Name (Required)</label>
                <input value="" id="wife_name" name="wife_name" type="text" class="form-control validate in_field" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Name (Required)</label>
                <input value="" id="husband_name" name="husband_name" type="text" class="form-control validate in_field" required>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Phone (Required)</label>
                <input value="" id="wife_phone" readonly="readonly" name="wife_phone" type="text" class="form-control validate in_field" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Phone (Required)</label>
                <input value="" id="husband_phone" name="husband_phone" type="text" class="form-control validate in_field" required>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Email (Required)</label>
                <input value="" id="wife_email" name="wife_email" required type="text" class="form-control validate in_field">
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Email (Optional)</label>
                <input value="" id="husband_email" name="husband_email" type="text" class="form-control validate in_field">
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Pan number (Optional)</label>
                <input value="" id="wife_pan_number" name="wife_pan_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
	                <label>Upload pan card (Optional)</label>
    	            <input type="file" name="wife_pan_card" id="wife_pan_card" class="not_required remove_required" />
                </div>
                <img class="img_show" style="display:none;" title="click to enlarge" src="" id="wife_pan_card_img" />
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Pan number (Optional)</label>
                <input value="" id="husband_pan_number" name="husband_pan_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
	                <label>Upload pan card (Optional)</label>
    	            <input type="file" name="husband_pan_card" id="husband_pan_card" class="not_required remove_required" />
                </div>
                <img class="img_show" style="display:none;" title="click to enlarge" src="" id="husband_pan_card_img" />
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife Adhaar number (Optional)</label>
                <input value="" id="wife_adhar_number" name="wife_adhar_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
	                <label>Upload adhar card (Optional)</label>
    	            <input type="file" name="wife_adhar_card" class="remove_required" />
                </div>
                <img class="img_show" style="display:none;" title="click to enlarge" src="" id="wife_adhar_card_img" />
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband Adhaar number (Optional)</label>
                <input value="" id="husband_adhar_number" name="husband_adhar_number" type="text" class="form-control validate in_field">
                <div class="upload_div">
            	    <label>Upload adhar card (Optional)</label>
        	        <input type="file" name="husband_adhar_card" class="remove_required" />
                </div>
                <img class="img_show" style="display:none;" title="click to enlarge" src="" id="husband_adhar_card_img" />
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
				<label for="item_name">Wife Photo (Optional)</label><div class="clearfix"></div>
                <div class="upload_div">
    	            <input type="file" name="wife_photo" class="remove_required" />
                </div>
                <img class="img_show" style="display:none;" title="click to enlarge" src="" id="wife_photo_img" />
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
	           <label for="item_name">Husband Photo (Optional)</label><div class="clearfix"></div>
                <div class="upload_div">
    	            <input type="file" name="husband_photo" class="remove_required" />
                </div>
                <img class="img_show" style="display:none;" title="click to enlarge" src="" id="husband_photo_img" />
           </div>
         </div>
         
          <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife age (Optional)</label>
                <input value="" id="wife_age" name="wife_age" type="text" class="form-control validate in_field">
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Husband age (Optional)</label>
                <input value="" id="husband_age" name="husband_age" type="text" class="form-control validate in_field">
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Wife address (Optional) <span class="error">* Address as per adhaar</span></label>
                <textarea id="wife_address" name="wife_address" class="form-control validate in_field"></textarea>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
           		<div class="row chek_box"><input type="checkbox" id="same_as_wife" /> Same as wife ?</div>
                <label for="item_name">Husband address (Optional) <span class="error">* Address as per adhaar</span></label>
                <textarea id="husband_address" name="husband_address" class="form-control validate in_field"></textarea>
           </div>
         </div>
         
         
         
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Reason of visit (Required)</label>
                <textarea id="reason_of_visit" name="reason_of_visit" class="form-control validate" required></textarea>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Billing Option (Required)</label>
                <select name="billing_for" id="billing_for" required>
                    <option value="">Select</option>
                    <option value="consultation">Consultation</option>
                    <option value="investigation">Investigation</option>
                    <option value="procedure">Procedure</option>
                </select>
            </div>
         </div>
         
         <div class="row">            
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Billing source (Required)</label>
                <select name="billing_from" id="billing_from" required>
                    <option value="">Select</option>
                    <?php if(isset($_SESSION['logged_billing_manager'])){ $center = $all_method->get_center(); ?>
                    	<option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                    <?php } ?>
                    <option value="IndiaIVF">IndiaIVF</option>       
                </select>
            </div>
              <div class="form-group col-sm-6 col-xs-12 hospital_id_section" style="display:none;">
               <label for="item_name">Hospital ID</label>
               <input value="" id="hospital_id" name="hospital_id" type="text" class="form-control validate">
            </div>
         </div>
         
         <div class="row">     
         	<div class="form-group col-sm-6 col-xs-12 role" id="patient_source_section" style="display:none;">
                <label for="statuss">Patient source (Required)</label>
                <select name="patient_source" id="patient_source" class="patient_source">
                    <option value="">Select</option>
                    <option value="google">Google</option>
                    <option value="camps">Camps</option>
                    <option value="reference">Reference</option>
                    <option value="facebook">Facebook</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group col-sm-6 col-xs-12 reference_section" style="display:none;">
               <label for="item_name">Reference from</label>
               <input value="" id="reference_from" name="reference_from" type="text" class="form-control validate">
            </div>
         </div>
         
         <div class="row">     
         	<div class="form-group col-sm-6 col-xs-12 role"  style="display:none;" id="patient_nationality">
                <label for="statuss">Patient nationality</label>
                <select name="nationality" id="nationality" class="patient_source" required>
                    <option value="">Select</option>
                    <option value="indian">Indian</option>
                    <option value="non-indian">Non-indian</option>
                </select>
            </div>
         </div>
         
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
	        <input type="submit" id="submitbutton" class="btn btn-large" value="Create Billing" />
         </div>
         </div>
      </div>
      </p>
    </div>
  </div>
</form>


<!--modal--->
<div class="modal fade" id="myModal" role="dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         	<img src="" id="modal_img" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
  </div>
  

<script type="text/javascript">
$(document).on('click',".img_show",function(e) {
	var src = $(this).attr('src');
	$('#modal_img').attr('src', src);
	$('#myModal').modal('show');
});

$('#same_as_wife'). click(function(){
	if($(this). prop("checked") == true){
		var wife_address = $('#wife_address').val();
		$('#husband_address').val(wife_address);
		$('#husband_address').prop('readonly', true);
	}
	else if($(this). prop("checked") == false){
		$('#husband_address').val('');
		$('#husband_address').prop('readonly', false);
	}
});

$(document).on('click',"#search_patient",function(e) {
	$('#loader_div').show();
	$('.in_field').val('');
	$('#medical_history').val('');
	$('#address').val('');
	$('#msg_area').empty();
	$('#paitent_type').empty();		
	var phone_number = $('#phone_number').val();
	var phone_by = $('#phone_number').attr('by');
	var patient_id = $('#iic_id').val();
	var patient_by = $('#iic_id').attr('by');
	
	if(phone_number != ''){
		var data = {search_this:phone_number, search_by:phone_by};
		 search_patient(data);
	}else if(patient_id != ''){
		var data = {search_this:patient_id, search_by:patient_by};
		 search_patient(data);
	}else{
		 $('#msg_area').append('Enter patient phone number or IIC ID');
		 $('#loader_div').hide();
	}
});

$(document).on('change',"#billing_for",function(e) {
	var billing_for = $(this).val();
	if(billing_for == 'consultation'){
		$('#center_share').prop('required',false);
		$('#center_share_div').hide();
	}else{
		$('#center_share').prop('required',true);
		$('#center_share_div').show();
	}
});

$(document).on('change',"#billing_from",function(e) {
	var billing_from = $(this).val();
	if(billing_from == 'IndiaIVF'){
		$('#hospital_id').prop('required',false);
		$('.hospital_id_section').hide();
	}else{
		$('#hospital_id').prop('required',true);
		$('.hospital_id_section').show();
	}
});

$(document).on('change',"#patient_source",function(e) {
	var patient_source = $(this).val();
	if(patient_source == 'reference'){
		$('#reference_from').prop('required',true);
		$('.reference_section').show();
	}else{
		$('#reference_from').prop('required',false);
		$('.reference_section').hide();
	}
});


function search_patient(data){
	$.ajax({
		url: '<?php echo base_url('billings/search_patient')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			if(data.status == 0){  $('#msg_area').append(data.message); }
			if(data.status == 'new_patient'){
				$('.img_show').hide();
				$('.img_show').attr('src', '');
				$('.chek_box').show();
				$('.chek_box input[type="checkbox"]'). prop("checked", false);
				$('.upload_div').show();
				$('.in_field').attr("readonly", false); $('#paitent_type').val(data.status); $('#msg_area').append(data.message); $('#paitent_id').val(data.uhid);
				$('#patient_source').attr("required", true); $('#patient_source_section').show(); 
				$('#wife_phone').attr("readonly", true);
				$('#wife_phone').val($('#phone_number').val());
				$('#patient_nationality').show();
				$('#nationality').attr("required", true);
				$(".not_required").attr("required", false);
			}			
			if(data.status == 'exist_patient'){
				$('.chek_box').hide();
				$('.upload_div input[type="file"]').prop('required',false);
				 $('.upload_div').hide();
				 
				 $('.in_field').attr("readonly", true);
				 $('#paitent_type').val(data.status);
				 $('#msg_area').append(data.message);
				 $('#paitent_id').val(data.uhid);
				 $('#patient_source_section').hide();
				 $('.reference_section').hide();
				 $('#patient_source').attr("required", false);
				 $('#patient_nationality').hide();
				 $('#nationality').attr("required", false);
				 
				 
				 //patient details
				 //WIFE
				 $('#wife_name').val(data.patient.wife_name);
				 $('#wife_phone').val(data.patient.wife_phone);
				 $('#wife_email').val(data.patient.wife_email);
				 $('#wife_pan_number').val(data.patient.wife_pan_number);
				 $('#wife_pan_card_img').attr('src', data.patient.wife_pan_card);
				 $('#wife_adhar_number').val(data.patient.wife_adhar_number);
				 $('#wife_adhar_card_img').attr('src', data.patient.wife_adhar_card);
				 $('#wife_photo_img').attr('src', data.patient.wife_photo);
				 $('#wife_age').val(data.patient.wife_age);
				 $('#wife_address').val(data.patient.wife_address);
				 
				 //HUSBAND
				 $('#husband_name').val(data.patient.husband_name);
				 $('#husband_phone').val(data.patient.husband_phone);
				 $('#husband_email').val(data.patient.husband_email);
				 $('#husband_pan_number').val(data.patient.husband_pan_number);
				 $('#husband_pan_card_img').attr('src', data.patient.husband_pan_card);
				 $('#husband_adhar_number').val(data.patient.husband_adhar_number);
				 $('#husband_adhar_card_img').attr('src', data.patient.husband_adhar_card);
				 $('#husband_photo_img').attr('src', data.patient.husband_photo);
				 $('#husband_age').val(data.patient.husband_age);
				 $('#husband_address').val(data.patient.husband_address);
				 
				 $('.img_show').show();
				 $('#submitbutton').show();
			
			 }
			$('#add_section').show();
			$('#loader_div').hide();
		} 
  });
}

$(document).on('blur',"#husband_phone",function(e) {$('#msg_area').empty();
	var wife_phone = $('#wife_phone').val();
	var husband_phone = $(this).val();
	if(husband_phone == wife_phone){ $(this).val(''); $('#msg_area').append('Husband wife phone number cannot be same.'); }	
});
$(document).on('blur',"#husband_email",function(e) {$('#msg_area').empty();
	var wife_email = $('#wife_email').val();
	var husband_email = $(this).val();
	if(husband_email == wife_email){ $(this).val('');  $('#msg_area').append('Husband wife email cannot be same.'); }
});

$('#submitbutton').hide();
$('#search_patient').hide();

// Pancard validation
$('#wife_pan_number').on("change, blur", function() {   
	var txtpan = $(this).val(); 
	validate_pan(txtpan);
});

$('#husband_pan_number').on("change, blur", function() {   
	 var txtpan = $(this).val(); 
	 validate_pan(txtpan);
});

function validate_pan(txtpan){
   $('#loader_div').show();
	$('#msg_area').empty();
	 var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/;	
	 if (txtpan.length == 10 ) { 
		  if( txtpan.match(regExp) ){$('#submitbutton').show(); $('#loader_div').hide();}
		  else {
			 $('#msg_area').append('Not a valid PAN number.');
			 $('#submitbutton').hide();
  			 $("html, body").animate({ scrollTop: 0 }, "slow");
 			 $('#loader_div').hide();
		     event.preventDefault(); 
		  } 
	 } 
	 else { 
 		   $('#msg_area').append('Please enter 10 digits for a valid PAN number');
		   $('#submitbutton').hide();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#loader_div').hide();
		   event.preventDefault(); 
	 } 
}

// Adhaar validation
$('#wife_adhar_number').keyup(function() {
  var value = $(this).val();
  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
  $(this).val(value);
});

$('#husband_adhar_number').keyup(function() {
  var value = $(this).val();
  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
  $(this).val(value);
});

$('#wife_adhar_number').on("change, blur", function() {   
	var txtpan = $(this).val(); 
	validate_adhaar(txtpan);
});
$('#husband_adhar_number').on("change, blur", function() {   
	 var txtpan = $(this).val(); 
	 validate_adhaar(txtpan);
});

function validate_adhaar(value){
   $('#loader_div').show();
	$('#msg_area').empty();
	var maxLength = 14;
	if (value.length != maxLength) {
		 $('#msg_area').append('Adhaar number length should be 12.');
		 $('#submitbutton').hide();
		 $("html, body").animate({ scrollTop: 0 }, "slow");
		 $('#loader_div').hide();
	} else {$('#submitbutton').show(); $('#loader_div').hide();}
}

// Phone number validation

$('#phone_number').on("change, blur, keyup", function() { 
	$('#add_section').hide();
	$('#search_patient').hide();
	$('#iic_id').val('');
	var txtpan = $(this).val(); 
	phone_validate(txtpan);
});
$('#husband_phone').on("change, blur, keyup", function() {   
	 var txtpan = $(this).val(); 
	 phone_validate(txtpan);
});

$('#iic_id').on("change, blur, keyup", function() {
	$('#add_section').hide();
	$('#search_patient').hide();
	$('#phone_number').val('');
	$('#search_patient').show();
});

function phone_validate(mobile) {
   $('#loader_div').show();
	$('#msg_area').empty();
	var pattern = /^\d{10}$/;
	if (pattern.test(mobile)) {$('#submitbutton').show(); $('#search_patient').show(); $('#loader_div').hide(); return true; }
	$('#msg_area').append('It is not valid mobile number.input 10 digits number!');
	$('#submitbutton').hide();
	$('#search_patient').hide();
	$("html, body").animate({ scrollTop: 0 }, "slow");
    $('#loader_div').hide();
	return false;
}

// Email validation
$('#wife_email').on("change, blur", function() {   
	var txtpan = $(this).val(); 
	email_validate(txtpan);
});
$('#husband_email').on("change, blur", function() {   
	 var txtpan = $(this).val(); 
	 email_validate(txtpan);
});

function email_validate(email) {
   $('#loader_div').show();
	$('#msg_area').empty();
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(email)) {
	   $('#msg_area').append('It is not valid email address!');
	   $('#submitbutton').hide();
	   $("html, body").animate({ scrollTop: 0 }, "slow");
       $('#loader_div').hide();
	}else{
       $('#submitbutton').show();
       $('#loader_div').hide();
	   return true;
	}
}
</script>