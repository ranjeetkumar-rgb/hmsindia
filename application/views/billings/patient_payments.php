<?php $all_method =&get_instance(); ?>
<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url();?>/billings/add_patient_payment" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="add_patient_payment" />
    <input type="hidden" id="nationality" value="" />
    <input type="hidden" id="patient_id" name="patient_id" value="" />
    
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Patient payments</h3>
        </div>
        <div class="panel-body profile-edit">
	      <p id="msg_area" class="delete"></p>
          <p>          
          <div class="row">
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="Phone number of wife" id="phone_number" by="phone" type="text" class="form-control validate" >
          </div>
          <div class="form-group col-sm-1 col-xs-12">
          	<p>OR </p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <input value="" placeholder="IIC ID" id="iic_id" by="patient" type="text" class="form-control validate" >
          </div>
          
          	<div class="form-group col-sm-3 col-xs-12">
                <a href="javascript:void(0);" id="search_patient" class="btn btn-large">Search</a>
            </div>
        </div>
          
          <div id="data_feilds" style="display:none;">  
          <div class="row">
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Wife name</label>
              <input value="" id="wife_name" readonly="readonly" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Wife number</label>
              <input value="" id="wife_number" readonly="readonly" type="text" class="form-control validate" required>
            </div>
             <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Wife email</label>
              <input value="" id="wife_email" readonly="readonly" type="text" class="form-control validate" required>
            </div>
          </div>
          
          <div class="row">
          	<h3>Patient Billings</h3>
            <br/>
            <table class="table table-striped table-bordered table-hover" id="">
                <thead>
                    <tr>
                        <th>Billing ID</th>
                        <th>Billing at</th>
                        <th>Billing from</th>
                        <th>Package</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Type</th>
                        <th>Payment done</th>
                    </tr>
                </thead>
                <tbody id="patient_payment_table_body">
                    <tr><td colspan="6" align="center">No record!</td></tr>
                </tbody>
            </table>
          </div>
          
          <div class="row">
          
            <div class="form-group col-sm-6 col-xs-12 role">
                        <label for="statuss">Payment mode (Required)</label>
                        <select name="payment_method" id="payment_method" required>
                            <option value="">Select</option>
                            <option value="neft" class="indian" mode="NEFT">NEFT</option>
                            <option value="rtgs" class="indian" mode="RTGS">RTGS</option>
                            <option value="cash" mode="Cash">Cash</option>
                            <option value="cheque" mode="Cheque">Cheque</option>
                            <option value="card" class="indian" mode="Card">Card</option>
                            <option value="upi" class="indian" mode="UPI">UPI</option>
                            <option value="insurance" class="indian" mode="Insurance">Insurance</option>
                            <option value="international_card" class="foreign" mode="International Card">International Card</option>
                        </select>
              </div>
              
            <div class="form-group col-sm-6 col-xs-12" id="transaction" style="display:none;">
                       <label for="item_name">Transaction ID (Optional)</label>
                       <input value="" placeholder="Transaction ID" id="transaction_id" name="transaction_id" type="text" class="form-control validate">
                       <input type="file" name="transaction_img" id="transaction_img"  />
                    </div>
          </div>
          
          <div class="row">           
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Billing source (Required)</label>
                <select name="billing_from" id="billing_from" required>
                    <option value="">Select</option>
                    <?php if(isset($_SESSION['logged_billing_manager'])){ 
                            $center = $all_method->get_center(); 
                            if($_SESSION['logged_billing_manager']['center_type'] == "associated"){ ?>
                    	      <option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                    <?php } } ?>
                    <option value="IndiaIVF">IndiaIVF</option>       
                </select>
            </div>
          </div>
          
       	  <div class="clearfix"></div>
          <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />
        </div>
          </div>
        </p>
      </div>
    </div>
</form>

<style >
input.Procedureform-control {
    display: none;
}
</style>

<script>
    $(document).on('change',"#payment_method",function(e) {
      $('#transaction_id').empty();
      var method = $(this).val();
      if(method == ''){
        $('#transaction_id').prop('required',false);
        $('#transaction_img').prop('required',false);
        $('#transaction').hide();		
      }else{
        $('#transaction_id').prop('required',false);
        $('#transaction_img').prop('required',false);
        $('#transaction').show();
      }
    });
			
	$(document).on('click',"#search_patient",function(e) {
		$('#loader_div').hide(); 
		$('.ajax_msg').hide(); $('#msg_area').hide(); $('.ajax_msg').empty();		
		$('#wife_name').val(''); $('#wife_number').val(''); $('#wife_email').val('');
		
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
			 $('#data_feilds').hide();
			 $('#msg_area').empty().append('Enter patient phone number or IIC ID');
			 $('#msg_area').show();
			 $('#loader_div').hide();
		}
	});
		
	function search_patient(data){
		$.ajax({
			url: '<?php echo base_url('billings/search_patient_payment')?>',
			data: data,
			dataType: 'json',
			method:'post',
			success: function(data)
			{
				if(data.status == 1){
					if(data.current_balance < 1){
						$('#data_feilds').hide();
						$('#msg_area').empty().append('Balance amount is Rs.0');
						$('#msg_area').show();
					}
					else{
						$('#wife_name').val(data.wife_name);
						$('#patient_id').val(data.patient_id);
						$('#wife_number').val(data.patient_phone);
						$('#wife_email').val(data.wife_email);
						$('#patient_payment_table_body').empty().append(data.remaining_billing);
						$('#nationality').val(data.nationality);
						if(data.nationality == 'indian'){ $('.foreign').hide(); $('.indian').show(); }
						else{ $('.indian').hide(); $('.foreign').show(); }
						$('#data_feilds').show();
					}
				}else{
					$('#data_feilds').hide();
					$('#msg_area').empty().append('IIC ID not found!');
					$('#msg_area').show();
				}
				$('#loader_div').hide();
			} 
	  });
	}
</script>
