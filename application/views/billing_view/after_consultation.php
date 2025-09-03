<?php $all_method =&get_instance(); ?>
  <div class="col-sm-12 col-xs-12">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">  </h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
        <div class="col-sm-12 col-xs-12">
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="Phone number of wife" id="phone_number" by="phone" name="phone_number" type="text" class="form-control validate" >
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
        <div class="col-sm-12 col-xs-12" id="add_section" style="display:none;">
            <h4>Create billing for :- </h4>
            <div class="col-sm-12 col-xs-12">
                <!--<a style="display:none;" href="<?php echo base_url('after-consultation-step-2?t=medicine_investigation_billing');?>" class="btn btn-primary" id="medicine_investigation_link">Medicine billing</a>
            --> <a style="display:none;" href="<?php echo base_url().'stocks/add_billing_medicine?ID='; ?>" class="btn btn-primary" id="medicine_investigation_link">Medicine billing</a>
                <a style="display:none;" href="<?php echo base_url('after-consultation-step-2?t=investigation_billing');?>" class="btn btn-primary" id="investigation_link">Investigation billing</a>
                <a style="display:none;" href="<?php echo base_url('after-consultation-step-2?t=procedure_billing');?>" class="btn btn-primary" id="procedure_link">Procedure billing</a>
				<a style="display:none;" href="<?php echo base_url('after-consultation-step-2?t=package_billing');?>" class="btn btn-primary" id="package_link">Package billing</a>
            </div>
        </div>

      </div>
      </p>
    </div>
  </div>  

<script type="text/javascript">
$('#submitbutton').hide();
$('#search_patient').hide();

// Phone number validation
$('#phone_number').on("change, blur, keyup", function() { 
	$('#add_section').hide();
	$('#search_patient').hide();
	$('#iic_id').val('');
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

$(document).on('click',"#search_patient",function(e) {
	$('#loader_div').show();
  $('#add_section').hide();
  $('#medicine_investigation_link').hide();
  $('#investigation_link').hide();
  $('#procedure_link').hide();
	$('#msg_area').empty();
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

function search_patient(data){
  $('#add_section').hide();
  $.ajax({
		url: '<?php echo base_url('billingcontroller/search_consultation_done')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
      $('#msg_area').empty();
      if(data.status == 0){
          $('#msg_area').append('Consultation not done yet.');
          $('#loader_div').hide();
      }else{
		   var xyz = false;
		   if(data.medicine_suggestion == 1 && data.medicine_billed == 0){
            $('#msg_area').empty();
            var url = "";
            url = $('#medicine_investigation_link').attr('href');
            url = url + ""+data.ID;
            $('#medicine_investigation_link').attr('href', url);
            $('#medicine_investigation_link').show();
            $('#add_section').show();
            xyz = true;
            $('#loader_div').hide();  
          }
           if(data.investation_suggestion == 1 && data.investigation_billed == 0){
            $('#msg_area').empty();
            var url = "";
            url = $('#investigation_link').attr('href');
            url = url + "&i="+data.ID;
            $('#investigation_link').attr('href', url);
            $('#investigation_link').show();
            $('#add_section').show(); 
            $('#loader_div').hide();
            xyz = true;
          }
          //if(data.procedure_suggestion == 1 && data.procedure_billed == 1 && data.procedure_billed == 0 ){
		  if(data.procedure_suggestion == 1 && (data.procedure_billed == 1 || data.procedure_billed == 0)) {	  
            $('#msg_area').empty();
            var url = "";
            url = $('#procedure_link').attr('href');
            url = url + "&i="+data.ID;
            $('#procedure_link').attr('href', url);
            $('#procedure_link').show();
            $('#add_section').show();
            $('#loader_div').hide();   
            xyz = true;
          }
		  
		  if(data.package_suggestion == 1 && (data.package_billed == 1 || data.package_billed == 0)) {	  
            $('#msg_area').empty();
            var url = "";
            url = $('#package_link').attr('href');
            url = url + "&i="+data.ID;
            $('#package_link').attr('href', url);
            $('#package_link').show();
            $('#add_section').show();
            $('#loader_div').hide();   
            xyz = true;
          }
		  
         /* var xyz = false;
          if(data.medicine_suggestion == 1 && data.medicine_billed == 0){
            $('#msg_area').empty();
            var url = "";
            url = $('#medicine_investigation_link').attr('href');
            url = url + "&i="+data.ID;
            $('#medicine_investigation_link').attr('href', url);
            $('#medicine_investigation_link').show();
            $('#add_section').show();
            xyz = true;
            $('#loader_div').hide();  
          }else if(data.investation_suggestion == 1 && data.investigation_billed == 0){
            $('#msg_area').empty();
            var url = "";
            url = $('#investigation_link').attr('href');
            url = url + "&i="+data.ID;
            $('#investigation_link').attr('href', url);
            $('#investigation_link').show();
            $('#add_section').show(); 
            $('#loader_div').hide();
            xyz = true;
          }
          if(data.procedure_suggestion == 1 && data.procedure_billed == 0){
            $('#msg_area').empty();
            var url = "";
            url = $('#procedure_link').attr('href');
            url = url + "&i="+data.ID;
            $('#procedure_link').attr('href', url);
            $('#procedure_link').show();
            $('#add_section').show();
            $('#loader_div').hide();   
            xyz = true;
          }*/
          if(xyz == false){
            $('#msg_area').empty().append('No Pending billing found!');
            $('#add_section').hide();
            $('#loader_div').hide(); 
          }
      }
		}
  });
};
</script>