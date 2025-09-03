
  <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="add_donor" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Add Donor</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
		    <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Patient UHID</label>
			  <select id="uhid" name="uhid" class="select2 form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($uhid as $key => $value){ ?>
                	<option value="<?php echo $value['uhid']; ?>"><?php echo $value['uhid']; ?></option>
				<?php } ?>
                </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Patient ID</label>
			  <select id="patient_id" name="patient_id" class="select2 consumables_select form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($medicines as $key => $value){ ?>
                	<option value="<?php echo $value['paitent_id']; ?>" wife_name="<?php echo $value['wife_name']; ?>"><?php echo $value['paitent_id']; ?></option>
				<?php } ?>
                </select>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
                <label for="expiry">Patient Name</label>
                <input value=""  readonly="" placeholder="Patient Name" id="wife_name" name="PatientName" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Donor UHID</label>
			   <select id="donor_uhid" name="donor_uhid" class="select2 form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($uhid as $key => $value){ ?>
                	<option value="<?php echo $value['uhid']; ?>"><?php echo $value['uhid']; ?></option>
                <?php } ?>
                </select>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="company">Donor Patient ID</label>
			   <select id="" name="donor_patient_id" class="select2 consumables_select2 form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($medicines as $key => $value){ ?>
                		<option value="<?php echo $value['paitent_id']; ?>" donor_PatientName="<?php echo $value['wife_name']; ?>"><?php echo $value['paitent_id']; ?></option>
				<?php } ?>
                </select>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
                <label for="expiry">Donor Patient Name</label>
                <input value="" readonly="" placeholder="Donor Patient Name" id="donor_PatientName" name="donor_PatientName" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="company">Type</label>
			    <select id="type" name="type" class="form-control" required>
                    <option value="">-- Select --</option>
              		<option value="Donor">Donor</option>
					<option value="Surrogate">Surrogate</option>
                </select>
            </div>
			</div>
		</div>
          
        <div class="clearfix"></div>
        <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />
        </div>
        </p>
      </div>
    </div>
  </form>


<script>
$(function(){
	  // turn the element to select2 select style
	  $('.select2').select2({
		placeholder: "Select stock item."
	  }).on('change', function(e) {
		var data = $(".select2 option:selected").val();
			
	  });
	
});


 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var paitent_id = $(this).val();
		var count = $(this).attr('count');
		
		$('#paitent_id').val('');
		$('#wife_name').val('');
		
		if(paitent_id != ''){
			var paitent_id = $(this).find(':selected').attr('paitent_id');
			var wife_name = $(this).find(':selected').attr('wife_name');
			
			$('#paitent_id').val(paitent_id);
			$('#wife_name').val(wife_name);
		}			
    });
	
	 $(document).on('change',".consumables_select2",function(e) {
        $('#msg_area').empty();
		var doner_patient_id = $(this).val();
		var count = $(this).attr('count');
		
		$('#doner_patient_id').val('');
		$('#donor_PatientName').val('');
		
		if(doner_patient_id != ''){
			var doner_patient_id = $(this).find(':selected').attr('doner_patient_id');
			var donor_PatientName = $(this).find(':selected').attr('donor_PatientName');
			
			$('#doner_patient_id').val(doner_patient_id);
			$('#donor_PatientName').val(donor_PatientName);
		}			
    });
</script>