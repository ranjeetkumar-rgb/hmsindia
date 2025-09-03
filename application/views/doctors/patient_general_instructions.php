 <?php $all_method =&get_instance(); ?>
   <style type="text/css">
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
		border-collapse: collapse;
		background:#fff;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>

<div class="col-sm-12 col-xs-12" >
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
                <a id="search_patient" href="javascript:void(0)" class="btn btn-large" required>Search</a>
          </div>
        </div>        
        <hr/>         
         <div class="row">            
           <div class="form-group col-sm-4 col-xs-12">
                <label for="item_name">Paitent Name </label>
                <input value="" placeholder="Paitent name" readonly="readonly" id="paitent_name" name="paitent_name" type="text" class="form-control validate" required>
           </div>
           
           <div class="form-group col-sm-4 col-xs-12">
                <label for="item_name">Phone Number </label>
                 <input value="" placeholder="Phone Number" readonly="readonly" id="wife_phone_number" name="wife_phone_number" type="text" class="form-control validate" required>
           </div>
           
           <div class="form-group col-sm-4 col-xs-12">
                <label for="item_name">Husband Name</label>
                 <input value="" placeholder="Husband Name" readonly="readonly" id="husband_name" name="husband_name" type="text" class="form-control validate" required>
           </div>
         </div>
        <hr/>    
        
        <div class="row patient_data_table">
        	<a href="#" class="btn btn-primary" id="procedure_link" target="_blank">DOs & DON'Ts</a>
			<a href="#" class="btn btn-primary" id="procedure_link_2" target="_blank">AFTER EMBRYO TRANSFER</a>
			<a href="#" class="btn btn-primary" id="procedure_link_3" target="_blank">BEFORE STARTING IVF CYCLE</a>
			<a href="#" class="btn btn-primary" id="procedure_link_4" target="_blank">POST OPU INSTRUCCTIONS</a>
			<a href="#" class="btn btn-primary" id="procedure_link_5" target="_blank">GENERAL INSTRUCTIONS PRIOR</a>
			<a href="#" class="btn btn-primary" id="procedure_link_6" target="_blank">GENERAL INSTRUCTIONS PRIOR TO EMBRYO TRANSFER</a>
			<a href="#" class="btn btn-primary" id="procedure_link_7" target="_blank">DURING THE IVF CYCLE</a>
         </div> 
      </div>
      </p>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#search_patient').hide();

// Phone number validation
$('#phone_number').on("change, blur, keyup", function() { 
	$('#add_section').hide();
	$('#iic_id').val('');
  $('#search_patient').show();
});
$('#iic_id').on("change, blur, keyup", function() {
	$('#add_section').hide();
	$('#phone_number').val('');
	$('#search_patient').show();
});

$(document).on('click',"#search_patient",function(e) {
	$('#loader_div').show();
	$('#msg_area').empty();
	
	var phone_number = $('#phone_number').val();
	var phone_by = $('#phone_number').attr('by');
	var patient_id = $('#iic_id').val();
	var patient_by = $('#iic_id').attr('by');
	
	if(phone_number != ''){
    $('#iic_id').val('');
		var data = {search_this:phone_number, search_by:phone_by};
		 search_patient(data);
	}else if(patient_id != ''){
    $('#phone_number').val('');
		var data = {search_this:patient_id, search_by:patient_by};
		 search_patient(data);
	}else{
		 $('#msg_area').append('Enter patient phone number or IIC ID');
		 $('#loader_div').hide();
	}
});

function search_patient(data){
    $.ajax({
			url: '<?php echo base_url('accounts/get_patient_data')?>',
			data: {'data' : data},
			dataType: 'json',
			method:'post',
			success: function(data)
			{
				$('#patient_data_table_body').empty();
				$('#paitent_name').val(data.patient_name);
				$('#wife_phone_number').val(data.patient_phone);
				$('#husband_name').val(data.husband_name);
			} 
	   });
}

// Function to update the link's href attribute
function updateLink() {
    var dynamicId = document.getElementById("iic_id").value;
    var procedureLink = document.getElementById("procedure_link");
	var procedureLink_2 = document.getElementById("procedure_link_2");
	var procedureLink_3 = document.getElementById("procedure_link_3");
	var procedureLink_4 = document.getElementById("procedure_link_4");
	var procedureLink_5 = document.getElementById("procedure_link_5");
	var procedureLink_6 = document.getElementById("procedure_link_6");
	var procedureLink_7 = document.getElementById("procedure_link_7");

    // Update the href attribute with the new ID
	var trimmedId = dynamicId.trim();
    procedureLink.href = "<?php echo base_url('doctors/ovarian_prp/'); ?>" + encodeURIComponent(trimmedId);
	//procedureLink_2.href = "<?php echo base_url('doctors/after_embryo_transfer/'); ?>" + encodeURIComponent(dynamicId);
	procedureLink_2.href = "<?php echo base_url('doctors/after_embryo_transfer/'); ?>" + encodeURIComponent(trimmedId);	
	procedureLink_3.href = "<?php echo base_url('doctors/before_starting_ivf_cycle/'); ?>" + encodeURIComponent(trimmedId);
	procedureLink_4.href = "<?php echo base_url('doctors/post_opu_instructions/'); ?>" + encodeURIComponent(trimmedId);
	procedureLink_5.href = "<?php echo base_url('doctors/general_instructions_prior/'); ?>" + encodeURIComponent(trimmedId);
	procedureLink_6.href = "<?php echo base_url('doctors/general_instructions_prior_to_embryo_transfer/'); ?>" + encodeURIComponent(trimmedId);
	procedureLink_7.href = "<?php echo base_url('doctors/during_the_ivf_cycle/'); ?>" + encodeURIComponent(trimmedId);
}

// Add an event listener to the input field
document.getElementById("iic_id").addEventListener("input", updateLink);

</script>