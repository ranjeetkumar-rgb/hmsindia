<form class="col-sm-12 col-xs-12" method="post" action="" >
  <input type="hidden" name="action" value="add_consultation_request" />
  <input type="hidden" name="patient_id" value="<?php echo $session_data['paitent_id']?>" />
  <input type="hidden" name="reason_of_visit" value="<?php echo $session_data['reason_of_visit']?>" />
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      <div class="panel-heading">
        <h3 class="heading">Consultation Details</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Doctor (Required)</label>
                <select name="doctor_id" id="doctor_id" required>
                    <option value="">Select</option>
                    <?php foreach($doctors as $key => $val){?>
                  		<option value="<?php echo $val['ID']; ?>" doc="Dr. <?php echo $val['name']; ?>">Dr. <?php echo $val['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date(Required)</label>
                <input value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Date" readonly="readonly" id="on_date" name="on_date" type="text" class="form-control validate" required>
           </div>
         </div>
         
         <div class="row">            
          
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Consultation fees (Required)</label>
                <input value="" placeholder="Consultation fees" readonly="readonly" id="fees" name="fees" type="text" class="form-control validate" required>
           </div>
         </div>
         
       
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
            <a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
         </div>
      </div>
      </p>
    </div>
    
    <div class="col-sm-12 col-xs-12 panel panel-piluku" style="display:none;" id="consultation_preview">
      <div class="panel-heading">
        <h3 class="heading">Billing Summary</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Doctor (Required)</label>
                <p id="doctor_id_text"></p>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date (Required)</label>
                <p id="on_date_text"><?php echo date("Y-m-d H:i:s"); ?></p>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Consultation fees (Required)</label>
                <p id="fees_text"></p>
           </div>
         </div>
         
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
            <a class="btn btn-large" id="edit_billing" href="javascript:void(0);">Edit Billing</a>
            <input type="submit" id="submitbutton" class="btn btn-large" value="Create Billing" />
         </div>
      </div>
      </p>
    </div>
  </div>
</form>

<script type="text/javascript">
    $(document).on('change',"#doctor_id",function(e) {
        $('#msg_area').empty();
	    $('#fees').empty();		
        var doctor_id = $(this).val();
		if(doctor_id != ''){
			$.ajax({
				url: '<?php echo base_url('billings/doctor_fees')?>',
				data: {doctor_id : doctor_id},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('#fees').val(data.fees);
				} 
		   });
	  }
    });
	
    $(document).on('change',"#payment_method",function(e) {
        $('#transaction_id').empty();
		var method = $(this).val();
		if(method == 'cash'){
			 $('#transaction_id').prop('required',false);
			 $('#transaction').hide();		
		}else{
			 $('#transaction_id').prop('required',true);
			 $('#transaction').show();
		}
		
    });
	
    $(document).on('keyup',"#payment_done",function(e) {
		$('#remaining_amount').empty();
		var fees = $('#fees').val();
		var payment_done = $(this).val();
		var remaining_amount = fees-payment_done;
		if(remaining_amount < 0){
			$('#payment_done').val('');
			$('#remaining_amount').val('');
		}
		else{
			$('#remaining_amount').val(remaining_amount);
		}
    });
	
	$(document).on('click',"#create_billing",function(e) {
		$('#msg_area').empty();
		$('#doctor_id_text').empty();
		$('#fees_text').empty();
		$('#payment_done_text').empty();
		$('#remaining_amount_text').empty();
		$('#payment_method_text').empty();	
		$('#transaction_id_text').empty();	
		$('#billing_id_text').empty();	
		$('#consultation_id_text').empty();
		
		var doctor = $('#doctor_id').val();
		var payment_done = $('#payment_done').val();
		var payment_method = $('#payment_method').val();
		
		if(payment_method != 'cash'){
				var transaction_id = $('#transaction_id').val();
				if(transaction_id == ''){
					$('#msg_area').append('One or more fields are empty !')
				}else{
					if(doctor == '' || payment_done == '' || payment_method == ''){$('#msg_area').append('One or more fields are empty !')}else{
						$('#doctor_id_text').append($('#doctor_id').find(':selected').attr('doc'));
						$('#fees_text').append($('#fees').val());
						$('#payment_done_text').append($('#payment_done').val());
						$('#remaining_amount_text').append($('#remaining_amount').val());
						$('#transaction_id_text').append($('#transaction_id').val());
						$('#payment_method_text').append($('#payment_method').find(':selected').attr('mode'));			
						$('#billing_id_text').append($('#billing_id').val());
						$('#consultation_id_text').append($('#consultation_id').val());
						$('#consultation_details').hide();
						$('#consultation_preview').show();
					}
				}
		}else{
			if(doctor == '' || payment_done == '' || payment_method == ''){$('#msg_area').append('One or more fields are empty !')}else{
				$('#doctor_id_text').append($('#doctor_id').find(':selected').attr('doc'));
				$('#fees_text').append($('#fees').val());
				$('#payment_done_text').append($('#payment_done').val());
				$('#remaining_amount_text').append($('#remaining_amount').val());
				$('#transaction_id_text').append($('#transaction_id').val());
				$('#payment_method_text').append($('#payment_method').find(':selected').attr('mode'));
				$('#billing_id_text').append($('#billing_id').val());
				$('#consultation_id_text').append($('#consultation_id').val());
				$('#consultation_details').hide();
				$('#consultation_preview').show();
			}
		}
    });
	
	$(document).on('click',"#edit_billing",function(e) {
			$('#consultation_preview').hide();
			$('#consultation_details').show();
	});
	
</script>