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
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>

<form class="col-sm-12 col-xs-12" method="post" action="" >
  <input type="hidden" name="action" value="add_investigation_request" />
  <input type="hidden" name="patient_id" value="<?php echo $session_data['paitent_id']?>" />
  <input type="hidden" name="reason_of_visit" value="<?php echo $session_data['reason_of_visit']?>" />
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      <div class="panel-heading">
        <h3 class="heading">Investigation Details</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date(Required)</label>
                <input value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Date" readonly="readonly" id="on_date" name="on_date" type="text" class="form-control validate" required>
           </div>
         </div>
         
         <div class="row invastigatiton_table">  
         	  <input type="button" class="add-row btn btn-large" value="Add Investigations"> <button type="button" class="delete-row btn btn-large">Delete Investigation</button>
              <table>
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Investigations</th>
                        <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                    </tr>
                </thead>
                <tbody id="investigation_table_body">
                    <tr class="investigation_row_1">
                        <td><!--<input type="checkbox" class="statuss" name="record">--></td>
                        <td class="role">
	                        <select name="investigation_name_1" class="investigation_select" id="investigation_name_1" count="1" required>
	                            <option value="">Select</option>
                        	<?php foreach($investigations as $key => $val){ ?>
                            	<option value="<?php echo $val['ID']; ?>" fees="<?php echo $val['price']; ?>" invest="<?php echo $val['investigation']; ?>"> <?php echo $val['investigation']; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                        <td><input value="" placeholder="Price" readonly="readonly" id="investigation_price_1" class="investigation_price" name="investigation_price_1" type="text" class="form-control validate" required></td>
                    </tr>
                </tbody>
            </table>
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
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date (Required)</label>
                <p id="on_date_text"><?php echo date("Y-m-d H:i:s"); ?></p>
           </div>
         </div>
         
         <div class="row investigation_preview_table">
              <table>
                <thead>
                    <tr>
                        <th>Investigations</th>
                        <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                    </tr>
                </thead>
                <tbody id="investigation_preview_table_body">
                    
                </tbody>
            </table>
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
    $(document).ready(function(){
        $(".add-row").click(function(){
			var rows= $('#investigation_table_body tr').length;
			var count = rows + 1;
            var markup = '<tr class="investigation_row_'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td class="role"><select count="'+count+'" name="investigation_name_'+count+'" class="investigation_select" id="investigation_name_'+count+'" required><option value="">Select</option><?php foreach($investigations as $key => $val){ ?><option value="<?php echo $val['ID']; ?>" fees="<?php echo $val['price']; ?>" invest="<?php echo $val['investigation']; ?>"> <?php echo $val['investigation']; ?></option><?php } ?></select></td><td><input value="" placeholder="Price" readonly="readonly" class="investigation_price" id="investigation_price_'+count+'" name="investigation_price_'+count+'" type="text" class="form-control validate" required></td></tr>';
            $("table tbody").append(markup);
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
					var fee_total = 0;
					$('.investigation_price').each(function(){
						var price_total = 0;
						var price_total = $(this).val();
						fee_total = parseInt(fee_total) + parseInt(price_total);
					});
					console.log(fee_total);
					$('.dhee').val(fee_total);
					$('#payment_done').val('');
					$('#remaining_amount').val('');			
            });
        });
    });    
</script>

<script type="text/javascript">
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
	
    $(document).on('change',".investigation_select",function(e) {
        $('#msg_area').empty();
		var investigation_id = $(this).val();
		var investigation_count = $(this).attr('count');
		$('#payment_done').val('');
		$('#remaining_amount').val('');
		$('.dhee').val('');
	    $('#investigation_price_'+investigation_count).val('');		
		if(investigation_id != ''){
			$.ajax({
				url: '<?php echo base_url('billings/investigation_price')?>',
				data: {investigation_id : investigation_id},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('#investigation_price_'+investigation_count).val(data.price);
					$('#investigation_price_'+investigation_count).attr('value', data.price);
					var fee_total = 0;
					$('.investigation_price').each(function(){
						var price_total = 0;
						var price_total = $(this).val();
						fee_total += +price_total;
					});
					console.log(fee_total);
					$('.dhee').val(parseInt(fee_total));
				} 
		   });
					
	  }
    });

    $(document).on('keyup',"#payment_done",function(e) {
		$('#remaining_amount').empty();
		var fees = $('.dhee').val();
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
		$('#investigation_preview_table_body').empty();
		$('#billing_id_text').empty();
		$('#investigation_id_text').empty();
		
		var countr = 1;
		var rows= $('#investigation_table_body tr').length;
		$('.investigation_select').each(function(){
			if(countr <= rows){
				var investigationname, investigationprice = '';
				investigationname = $('#investigation_name_'+countr).find(':selected').attr('invest');
				investigationprice = $('#investigation_name_'+countr).find(':selected').attr('fees');
				console.log(investigationname +' --- '+investigationprice);
				
				$('#investigation_preview_table_body').append('<tr class="investigation_row_'+countr+'"><td class="role">'+investigationname+'</td><td>'+investigationprice+'</td></tr>');
				countr++;
			 }
		});
		
		var doctor = $('#doctor_id').val();
		var payment_done = $('#payment_done').val();
		var payment_method = $('#payment_method').val();
		var paramedic_name =  $('#paramedic_name').val()

		if(payment_method != 'cash'){
				var transaction_id = $('#transaction_id').val();
				if(transaction_id == ''){
					$('#msg_area').append('One or more fields are empty !')
				}else{
					if(doctor == '' || payment_done == '' || payment_method == '' || paramedic_name==''){$('#msg_area').append('One or more fields are empty !')}else{
						$('#paramedic_text').append($('#paramedic_name').val());
						$('#fees_text').append($('.dhee').val());
						$('#payment_done_text').append($('#payment_done').val());
						$('#remaining_amount_text').append($('#remaining_amount').val());
						$('#transaction_id_text').append($('#transaction_id').val());
						$('#payment_method_text').append($('#payment_method').find(':selected').attr('mode'));			
						$('#billing_id_text').append($('#billing_id').val());
						$('#investigation_id_text').append($('#investigation_id').val());
						$('#consultation_details').hide();
						$('#consultation_preview').show();
					}
				}
		}else{
			if(doctor == '' || payment_done == '' || payment_method == '' || paramedic_name==''){$('#msg_area').append('One or more fields are empty !')}else{
				$('#paramedic_text').append($('#paramedic_name').val());
				$('#fees_text').append($('.dhee').val());
				$('#payment_done_text').append($('#payment_done').val());
				$('#remaining_amount_text').append($('#remaining_amount').val());
				$('#transaction_id_text').append($('#transaction_id').val());
				$('#payment_method_text').append($('#payment_method').find(':selected').attr('mode'));
				$('#billing_id_text').append($('#billing_id').val());
				$('#investigation_id_text').append($('#investigation_id').val());
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