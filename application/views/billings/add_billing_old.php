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
            <input value="" placeholder="Phone Number" id="phone_number" by="phone" name="phone_number" type="text" class="form-control validate" >
          </div>
          <div class="form-group col-sm-1 col-xs-12">
          	<p>OR </p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="IIC ID" id="iic_id" by="patient" name="iic_id" type="text" class="form-control validate" >
          </div>
          
          	<div class="form-group col-sm-3 col-xs-12">
                <input value="Search" id="search_patient" type="button" class="form-control validate" >
            </div>
        </div>        
        <hr/>        
        <div id="add_section" style="display:none;"> 
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Paitent Name (Required)</label>
                <input value="" placeholder="Paitent name" readonly="readonly" id="paitent_name" name="paitent_name" type="text" class="form-control validate in_field" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">IIC ID (Required)</label>
                <input value="" placeholder="IIC ID" readonly="readonly" id="paitent_id" name="paitent_id" type="text" class="form-control validate" required>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Reason of visit (Required)</label>
                <textarea placeholder="Reason of visit" id="reason_of_visit" name="reason_of_visit" class="form-control validate" required></textarea>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Paitent Email (Required)</label>
                <input value="" placeholder="Paitent Email" readonly="readonly" id="paitent_email" name="paitent_email" type="text" class="form-control validate in_field" required>
           </div>
         </div>
         
        <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Spouse name(Required)</label>
                <input value="" placeholder="Spouse name" id="spouse_name" name="spouse_name" type="text" class="form-control validate in_field" required>
          </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Pan Number (Required)</label>
                <input value="" placeholder="Pan Number" id="pan_number" name="pan_number" type="text" class="form-control validate in_field" required>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Adhar number(Required)</label>
                 <input value="" placeholder="Adhar Number" id="adhar_number" name="adhar_number" type="text" class="form-control validate in_field" required>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Medical History (Required)</label>
                <textarea placeholder="Medical History" id="medical_history" name="medical_history" class="form-control validate" required></textarea>
           </div>
         </div>
         
           <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Address(Required)</label>
                <textarea placeholder="Address" id="address" name="address" class="form-control validate" required></textarea>
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
                <label for="statuss">Billing From (Required)</label>
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
               <input value="" placeholder="Hospital ID" id="hospital_id" name="hospital_id" type="text" class="form-control validate">
            </div>
         </div>
         
          <div class="row">     
         	<div class="form-group col-sm-6 col-xs-12 role" id="patient_source_section" style="display:none;">
                <label for="statuss">Patient source(Required)</label>
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
               <input value="" placeholder="Reference from" id="reference_from" name="reference_from" type="text" class="form-control validate">
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

<script type="text/javascript">
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
			if(data.status == 'new_patient'){ $('.in_field').attr("readonly", false); $('#paitent_type').val(data.status); $('#msg_area').append(data.message); $('#paitent_id').val(data.uhid); $('#patient_source_section').show(); $('#patient_source').attr("required", true);}
			if(data.status == 'exist_patient'){ $('.in_field').attr("readonly", true); $('#paitent_type').val(data.status); $('#msg_area').append(data.message); $('#paitent_id').val(data.uhid); $('#paitent_name').val(data.patient.patient_name); $('#paitent_email').val(data.patient.patient_email);$('#spouse_name').val(data.patient.spouse_name); $('#medical_history').val(data.patient.medical_history);$('#adhar_number').val(data.patient.adhar_number); $('#pan_number').val(data.patient.pan_number);$('#address').val(data.patient.address);$('#patient_source_section').hide(); $('.reference_section').hide(); $('#patient_source').attr("required", false);
			
			 }
			$('#add_section').show();
			$('#loader_div').hide();
		} 
  });
}
</script>