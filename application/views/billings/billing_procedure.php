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
	.heading{margin-bottom:10px;margin-top: 0; padding-top:0px;}
</style>

<form class="col-sm-12 col-xs-12" id="procedure_form" method="post" action="" novalidate>
  <input type="hidden" name="action" value="add_procedure_request" />
  <input type="hidden" name="patient_id" value="<?php echo $session_data['paitent_id']?>" />
  <input type="hidden" name="reason_of_visit" value="<?php echo $session_data['reason_of_visit']?>" />
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details">
      <div class="panel-heading">
        <h3 class="heading">Procedure Details</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
        	<div class="procedure_lists col-sm-4 col-xs-12 col-md-4 role pull-right">
            	<label>Select Procedure</label>
            	<select name="procedure_parent" class="procedure_parent" id="procedure_parent" required>
	                <option value="">Select</option>
                    <?php foreach($procedure as $key => $val){ ?>
                     	<option value="<?php echo $val['ID']; ?>" fees="<?php echo $val['price']; ?>" procedure="<?php echo $val['procedure_name']; ?>"> <?php echo $val['procedure_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div id="main_div" style="display:none;">
                <section class="col-sm-12 col-xs-12 medicine_section">
                  <h4 class="heading">Patient Medicines</h4>
                  <div class="clearfix"></div>
                  <input type="button" class="add-medicine-row btn btn-large" value="Add Medicine">
                  <input type="button" class="delete-medicine-row btn btn-large" value="Delete Medicine">
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Serial Number</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="medicine_table_body">
                        <tr class="medicine_row_1">
                            <td><!--<input type="checkbox" class="statuss" name="record">--></td>
                            <td><input value="" placeholder="Serial Number" readonly="readonly" id="medicine_serial_1" class="medicine_serial_1" name="medicine_serial_1" type="text" class="form-control validate" required></td>
                            <td class="role">
                                <select name="medicine_name_1" class="medicine_select" id="medicine_name_1" count="1" required>
                                    <option value="">Select</option>
                                <?php foreach($medicine as $key => $val){ ?>
                                    <option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" medicine="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                           <td><input value="" placeholder="Quantity" id="medicine_quantity_1" qcount="1" class="medicine_quantity medicine_quantity_1" name="medicine_quantity_1" type="text" class="form-control validate" required></td>
                           <td><input value="" placeholder="Company" readonly="readonly" id="medicine_company_1" class="medicine_company_1" name="medicine_company_1" type="text" class="form-control validate" required></td>
                          <td><input value="" placeholder="Price" readonly="readonly" id="medicine_price_1" class="medicine_price" name="medicine_price_1" type="text" class="form-control validate" required></td>
                        </tr>
                    </tbody>
                </table>
                </section>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 injections_section">
                  <h4 class="heading">Patient Injections</h4>
                  <div class="clearfix"></div>
                  <input type="button" class="add-injections-row btn btn-large" value="Add Injection">
                  <input type="button" class="delete-injections-row btn btn-large" value="Delete Injection">
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Serial Number</th>
                            <th>Injections</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="injections_table_body">
                        <tr class="injections_row_1">
                            <td><!--<input type="checkbox" class="statuss" name="record">--></td>
                            <td><input value="" placeholder="Serial Number" readonly="readonly" id="injections_serial_1" class="injections_serial_1" name="injections_serial_1" type="text" class="form-control validate" required></td>
                            <td class="role">
                                <select name="injections_name_1" class="injections_select" id="injections_name_1" count="1" required>
                                    <option value="">Select</option>
                                <?php foreach($injections as $key => $val){ ?>
                                    <option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" injections="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                           <td><input value="" placeholder="Quantity" id="injections_quantity_1" qcount="1" class="injections_quantity injections_quantity_1" name="injections_quantity_1" type="text" class="form-control validate" required></td>
                           <td><input value="" placeholder="Company" readonly="readonly" id="injections_company_1" class="injections_company_1" name="injections_company_1" type="text" class="form-control validate" required></td>
                          <td><input value="" placeholder="Price" readonly="readonly" id="injections_price_1" class="injections_price" name="injections_price_1" type="text" class="form-control validate" required></td>
                        </tr>
                    </tbody>
                </table>
                
                </section>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 consumables_section">
                  <h4 class="heading">Patient Consumables</h4>
                  <div class="clearfix"></div>
                  <input type="button" class="add-consumables-row btn btn-large" value="Add Consumables">
                  <input type="button" class="delete-consumables-row btn btn-large" value="Delete Consumables">
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Serial Number</th>
                            <th>Consumable</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="consumables_table_body">
                        <tr class="consumables_row_1">
                            <td><!--<input type="checkbox" class="statuss" name="record">--></td>
                            <td><input value="" placeholder="Serial Number" readonly="readonly" id="consumables_serial_1" class="consumables_serial_1" name="consumables_serial_1" type="text" class="form-control validate" required></td>
                            <td class="role">
                                <select name="consumables_name_1" class="consumables_select" id="consumables_name_1" count="1" required>
                                    <option value="">Select</option>
                                <?php foreach($consumables as $key => $val){ ?>
                                    <option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" consumables="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                           <td><input value="" placeholder="Quantity" id="consumables_quantity_1" qcount="1" class="consumables_quantity consumables_quantity_1" name="consumables_quantity_1" type="text" class="form-control validate" required></td>
                           <td><input value="" placeholder="Company" readonly="readonly" id="consumables_company_1" class="consumables_company_1" name="consumables_company_1" type="text" class="form-control validate" required></td>
                          <td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_1" class="consumables_price" name="consumables_price_1" type="text" class="form-control validate" required></td>
                        </tr>
                    </tbody>
                </table>
                </section>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 sub_procedures_section">
                  <h4 class="heading">Patient Procedure</h4>
                  <div class="clearfix"></div>
                  <input type="button" class="add-sub_procedures-row btn btn-large" value="Add Procedure">
                  <input type="button" class="delete-sub_procedures-row btn btn-large" value="Delete Procedure">
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Procedure</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="sub_procedures_table_body">
                        <tr class="sub_procedures_row_1">
                            <td><!--<input type="checkbox" class="statuss" name="record">--></td>
                            <td class="role" id="sub_procd_td_1">
                                <select name="sub_procedure_1" class="sub_procedure_select" id="sub_procedure_1" count="1" required>
                                    <option value="">Select</option>
                                </select>
                            </td>
                           
                          <td><input value="" placeholder="Price" readonly="readonly" id="sub_procedures_price_1" class="sub_procedures_price" name="sub_procedures_price_1" type="text" class="form-control validate" required></td>
                        </tr>
                    </tbody>
                </table>
                </section>
                <div class="clearfix"></div>
                <hr />
                <div class="form-group col-sm-12 col-xs-12">
                	<a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
                    <p id="error" class="error delete"></p>
                </div>
            </div>
      </div>
      </p>
    </div>
    
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details_preview" style="display:none;">
      <div class="panel-heading">
        <h3 class="heading">Billing Summary</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
        	<div class="procedure_lists col-sm-4 col-xs-12 col-md-4 role pull-right">
            	<label>Procedure</label>
            	<p id="procedure_text"></p>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div id="main_div">
                <section class="col-sm-12 col-xs-12 medicine_section">
                  <h4 class="heading">Patient Medicines</h4>
                  <div class="clearfix"></div>
                  <table>
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="medicine_table_body_preview">
                        
                    </tbody>
                </table>
                
                </section>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 injections_section">
                  <h4 class="heading">Patient Injections</h4>
                  <div class="clearfix"></div>
                  <table>
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Injections</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="injections_table_body_preview">
                        
                    </tbody>
                </table>
                
                </section>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 consumables_section">
                  <h4 class="heading">Patient Consumables</h4>
                  <div class="clearfix"></div>
                  <table>
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Consumable</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="consumables_table_body_preview">
                        
                    </tbody>
                </table>
                
                </section>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 sub_procedures_section_preview">
                  <h4 class="heading">Patient Procedure</h4>
                  <div class="clearfix"></div>
                  <table>
                    <thead>
                        <tr>
                            <th>Procedure</th>
                            <th>Price (<i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody id="sub_procedures_table_body_preview">
                        
                    </tbody>
                </table>
                
                </section>
                <div class="clearfix"></div>
                <hr />
                <div class="form-group col-sm-12 col-xs-12">
            		<a class="btn btn-large" id="edit_billing" href="javascript:void(0);">Edit Billing</a>
            		<input type="submit" id="submitbutton" class="btn btn-large" value="Create Billing" />
                </div>
            </div>
      </div>
      </p>
    </div>
  </div>
</form>
<div id="procedure_html" style="display:none;"></div>

<!--****** MEDICINE SCRIPT *******-->
<script>
	 $(document).on('change',".medicine_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		
		$('#medicine_serial_'+count).val('');
		$('#medicine_quantity_'+count).val('');
		$('#medicine_company_'+count).val('');
		$('#medicine_price_'+count).val('');
		$('#medicine_sub_total').val('');
		$('#medicine_discount').val(0);
		$('#medicine_total').val('');
		
		
		if(serial != ''){
			var serial = $(this).val();
			var company = $(this).find(':selected').attr('company');
			var fees = $(this).find(':selected').attr('fees');
			
			$('#medicine_serial_'+count).val(serial);
			$('#medicine_company_'+count).val(company);
			$('#medicine_price_'+count).val(fees);
		}
			var fee_total = 0;
			$('.medicine_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			$('#medicine_sub_total').val(fee_total);
			$('#medicine_total').val(fee_total);
			
    });
	
	 $(document).ready(function(){
        $(".add-medicine-row").click(function(){
			var rows= $('#medicine_table_body tr').length;
			var count = rows + 1;
            var markup = '<tr class="medicine_row_'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td><input value="" placeholder="Serial Number" readonly="readonly" id="medicine_serial_'+count+'" class="medicine_serial_'+count+'" name="medicine_serial_'+count+'" type="text" class="form-control validate" required></td><td class="role"><select name="medicine_name_'+count+'" class="medicine_select" id="medicine_name_'+count+'" count="'+count+'" required><option value="">Select</option><?php foreach($medicine as $key => $val){ ?><option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" medicine="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?></option><?php } ?></select></td><td><input value="" qcount="'+count+'" placeholder="Quantity" id="medicine_quantity_'+count+'" class="medicine_quantity medicine_quantity_'+count+'" name="medicine_quantity_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Company" readonly="readonly" id="medicine_company_'+count+'" class="medicine_company_'+count+'" name="medicine_company_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Price" readonly="readonly" id="medicine_price_'+count+'" class="medicine_price" name="medicine_price_'+count+'" type="text" class="form-control validate" required></td></tr>';
            $("table tbody#medicine_table_body").append(markup);
			
        });
        
        // Find and remove selected table rows
        $(".delete-medicine-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
				var fee_total = 0;
				$('.medicine_price').each(function(){
					var price_total = 0;
					var price_total = $(this).val();
					fee_total += +price_total;
				});
				$('#medicine_sub_total').val(fee_total);
				$('#medicine_discount').val(0);
				$('#medicine_total').val(fee_total);
            });
			
        });
    });
	
	 $(document).on('keyup',"#medicine_discount",function(e) {
		$('#medicine_total').empty();
		var fees = $('#medicine_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#medicine_total').val(fees);
		} else {
			var remaining_amount = fees-discount;
			if(remaining_amount < 0){
				$(discount).val('');
				$('#medicine_total').val(fees);
			}
			else{
				$('#medicine_total').val(remaining_amount);
			}
		}
			
    });
	
	
	
</script>
<!--****** MEDICINE SCRIPT *******-->

<!--****** Injections SCRIPT *******-->
<script>
	 $(document).on('change',".injections_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		
		$('#injections_serial_'+count).val('');
		$('#injections_quantity_'+count).val('');
		$('#injections_company_'+count).val('');
		$('#injections_price_'+count).val('');
		$('#injections_sub_total').val('');
		$('#injections_discount').val(0);
		$('#injections_total').val('');
		
		
		if(serial != ''){
			var serial = $(this).val();
			var company = $(this).find(':selected').attr('company');
			var fees = $(this).find(':selected').attr('fees');
			
			$('#injections_serial_'+count).val(serial);
			$('#injections_company_'+count).val(company);
			$('#injections_price_'+count).val(fees);
		}
			var fee_total = 0;
			$('.injections_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			$('#injections_sub_total').val(fee_total);
			$('#injections_total').val(fee_total);
			
    });
	
	 $(document).ready(function(){
        $(".add-injections-row").click(function(){
			var rows= $('#injections_table_body tr').length;
			var count = rows + 1;
            var markup = '<tr class="injections_row_'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td><input value="" placeholder="Serial Number" readonly="readonly" id="injections_serial_'+count+'" class="injections_serial_'+count+'" name="injections_serial_'+count+'" type="text" class="form-control validate" required></td><td class="role"><select name="injections_name_'+count+'" class="injections_select" id="injections_name_'+count+'" count="'+count+'" required><option value="">Select</option><?php foreach($injections as $key => $val){ ?><option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" injections="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?></option><?php } ?></select></td><td><input value="" qcount="'+count+'" placeholder="Quantity" id="injections_quantity_'+count+'" class="injections_quantity  injections_quantity_'+count+'" name="injections_quantity_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Company" readonly="readonly" id="injections_company_'+count+'" class="injections_company_'+count+'" name="injections_company_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Price" readonly="readonly" id="injections_price_'+count+'" class="injections_price" name="injections_price_'+count+'" type="text" class="form-control validate" required></td></tr>';
            $("table tbody#injections_table_body").append(markup);
			
        });
        
        // Find and remove selected table rows
        $(".delete-injections-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
				var fee_total = 0;
				$('.injections_price').each(function(){
					var price_total = 0;
					var price_total = $(this).val();
					fee_total += +price_total;
				});
				$('#injections_sub_total').val(fee_total);
				$('#injections_discount').val(0);
				$('#injections_total').val(fee_total);
            });
			
        });
    });
	
	 $(document).on('keyup',"#injections_discount",function(e) {
		$('#injections_total').empty();
		var fees = $('#injections_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#injections_total').val(fees);
		} else {
			var remaining_amount = fees-discount;
			if(remaining_amount < 0){
				$(discount).val('');
				$('#injections_total').val(fees);
			}
			else{
				$('#injections_total').val(remaining_amount);
			}
		}
		
    });
</script>
<!--****** Injections SCRIPT *******-->

<!--****** consumables SCRIPT *******-->
<script>
	 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		
		$('#consumables_serial_'+count).val('');
		$('#consumables_quantity_'+count).val('');
		$('#consumables_company_'+count).val('');
		$('#consumables_price_'+count).val('');
		$('#consumables_sub_total').val('');
		$('#consumables_discount').val(0);
		$('#consumables_total').val('');
		
		
		if(serial != ''){
			var serial = $(this).val();
			var company = $(this).find(':selected').attr('company');
			var fees = $(this).find(':selected').attr('fees');
			
			$('#consumables_serial_'+count).val(serial);
			$('#consumables_company_'+count).val(company);
			$('#consumables_price_'+count).val(fees);
		}
			var fee_total = 0;
			$('.consumables_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			$('#consumables_sub_total').val(fee_total);
			$('#consumables_total').val(fee_total);
			
    });
	
	 $(document).ready(function(){
        $(".add-consumables-row").click(function(){
			var rows= $('#consumables_table_body tr').length;
			var count = rows + 1;
            var markup = '<tr class="consumables_row_'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td><input value="" placeholder="Serial Number" readonly="readonly" id="consumables_serial_'+count+'" class="consumables_serial_'+count+'" name="consumables_serial_'+count+'" type="text" class="form-control validate" required></td><td class="role"><select name="consumables_name_'+count+'" class="consumables_select" id="consumables_name_'+count+'" count="'+count+'" required><option value="">Select</option><?php foreach($consumables as $key => $val){ ?><option value="<?php echo $val['item_number']; ?>" company="<?php echo $val['company']; ?>" fees="<?php echo $val['price']; ?>" consumables="<?php echo $val['item_name']; ?>"> <?php echo $val['item_name']; ?></option><?php } ?></select></td><td><input value="" qcount="'+count+'"  placeholder="Quantity" id="consumables_quantity_'+count+'" class="consumables_quantity consumables_quantity_'+count+'" name="consumables_quantity_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Company" readonly="readonly" id="consumables_company_'+count+'" class="consumables_company_'+count+'" name="consumables_company_'+count+'" type="text" class="form-control validate" required></td><td><input value="" placeholder="Price" readonly="readonly" id="consumables_price_'+count+'" class="consumables_price" name="consumables_price_'+count+'" type="text" class="form-control validate" required></td></tr>';
            $("table tbody#consumables_table_body").append(markup);
			
        });
        
        // Find and remove selected table rows
        $(".delete-consumables-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
				var fee_total = 0;
				$('.consumables_price').each(function(){
					var price_total = 0;
					var price_total = $(this).val();
					fee_total += +price_total;
				});
				$('#consumables_sub_total').val(fee_total);
				$('#consumables_discount').val(0);
				$('#consumables_total').val(fee_total);
            });
			
        });
    });
	
	 $(document).on('keyup',"#consumables_discount",function(e) {
		$('#consumables_total').empty();
		var fees = $('#consumables_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#consumables_total').val(fees);
		} else {
			var remaining_amount = fees-discount;
			if(remaining_amount < 0){
				$(discount).val('');
				$('#consumables_total').val(fees);
			}
			else{
				$('#consumables_total').val(remaining_amount);
			}
		}
			
    });
</script>
<!--****** consumables SCRIPT *******-->

<!--****** Procedures SCRIPT *******-->
<script>
	$(document).on('change',"#procedure_parent",function(e) {
        $('#procedure_html').empty();
		$('#sub_procedure_1').empty();
		var parent_parents = $(this).val();
		if(parent_parents != ''){
			$.ajax({
				url: '<?php echo base_url('billings/get_sub_procedures')?>',
				data: {parent_parents : parent_parents},
				dataType: 'json',
				method:'post',
				success: function(data)
				{
					$('#procedure_html').html(data);
					$('#sub_procedure_1').html(data);
				} 
		   });
		   $('#main_div').show();
	  }else{
		   $('#main_div').hide();
	  }
			
    });
	$(document).ready(function(){
        $(".add-sub_procedures-row").click(function(){
			var rows= $('#sub_procedures_table_body tr').length;
			var count = rows + 1;
			var sub_procedure_html = $('#procedure_html').html();
            var markup = '<tr class="sub_procedures_row_'+count+'"><td><input type="checkbox" class="statuss" name="record"></td><td class="role" id="sub_procd_td_'+count+'"><select name="sub_procedure_'+count+'" class="sub_procedure_select" id="sub_procedure_'+count+'" count="'+count+'" required>'+sub_procedure_html+'</select></td><td><input value="" placeholder="Price" readonly="readonly" id="sub_procedures_price_'+count+'" class="sub_procedures_price" name="sub_procedures_price_'+count+'" type="text" class="form-control validate" required></td></tr>';
            $("table tbody#sub_procedures_table_body").append(markup);
			
        });
        
        // Find and remove selected table rows
        $(".delete-sub_procedures-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
				var fee_total = 0;
				$('.sub_procedures_price').each(function(){
					var price_total = 0;
					var price_total = $(this).val();
					fee_total += +price_total;
				});
				$('#sub_procedures_sub_total').val(fee_total);
				$('#sub_procedures_discount').val(0);
				$('#sub_procedures_total').val(fee_total);
            });
			
        });
    });
	
	$(document).on('change',".sub_procedure_select",function(e) {
        $('#msg_area').empty();
		var sub_procedure = $(this).val();
		var count = $(this).attr('count');
		
		$('#sub_procedures_price_'+count).val('');
		$('#sub_procedures_sub_total').val('');
		$('#sub_procedures_discount').val(0);
		$('#sub_procedures_total').val('');
		
		
		if(sub_procedure != ''){
			var fees = $(this).find(':selected').attr('fees');
			$('#sub_procedures_price_'+count).val(fees);
		}
			var fee_total = 0;
			$('.sub_procedures_price').each(function(){
				var price_total = 0;
				var price_total = $(this).val();
				fee_total += +price_total;
			});
			$('#sub_procedures_sub_total').val(fee_total);
			$('#sub_procedures_total').val(fee_total);
			
    });
	$(document).on('keyup',"#sub_procedures_discount",function(e) {
		$('#sub_procedures_total').empty();
		var fees = $('#sub_procedures_sub_total').val();
		var discount = $(this).val();
		if (isNaN(discount)) {
			$(this).val('');
			$('#sub_procedures_total').val(fees);
		} else {
			var remaining_amount = fees-discount;
			if(remaining_amount < 0){
				$(discount).val('');
				$('#sub_procedures_total').val(fees);
			}
			else{
				$('#sub_procedures_total').val(remaining_amount);
			}
		}
			
    });
	
</script>
<!--****** Procedures SCRIPT *******-->

<!--****** Billing SCRIPT *******-->
<script>
	$(document).on('click',"#edit_billing",function(e) {
			$('#procedure_details_preview').hide();
			$('#procedure_details').show();
	});

	$(document).on('click',"#create_billing",function(e) {
       $('#error').empty();
	   var has_empty = false;
	   var payment_done = $('#payment_done').val();
	   var payment_method = $('#payment_method').val();
	    var fees = $('#fees').val();
	  	
	   if ( payment_done == '' || payment_method == '' || fees < 1) 
	   {
		   $('#error').append('One or more fields are empty!');
	   }else{
			var countr = 1;
			var rows= $('#medicine_table_body tr').length;
			$('.medicine_select').each(function(){
				if(countr <= rows){
					if($(this).val() != ''){
						quantity = $('#medicine_quantity_'+countr).val();
						if(quantity == ''){
							has_empty = false;
						}else{
							has_empty = true;
						}
					}
					countr++;
				 }
			});
			
			var inj_count = 1;
			var inj_rows= $('#injections_table_body tr').length;
			$('.injections_select').each(function(){
				if(inj_count <= inj_rows){
					var name, price, serial, quantity, company = '';
					if($(this).val() != ''){
						quantity = $('#injections_quantity_'+inj_count).val();
						if(quantity == ''){
							has_empty = false;
						}else{
							has_empty = true;
						}
					}
					inj_count++;
				 }
			});
			
			var com_count = 1;
			var com_rows= $('#consumables_table_body tr').length;
			$('.consumables_select').each(function(){
				if(com_count <= com_rows){
					var name, price, serial, quantity, company = '';
					if($(this).val() != ''){
						quantity = $('#consumables_quantity_'+com_count).val();
						if(quantity == ''){
							has_empty = false;
						}else{
							has_empty = true;
						}
					}
					com_count++;
				 }
			});
			
			if(has_empty == true){
				make_billing();
			}else{
			   $('#error').append('One or more fields are empty!');
		   }
	   }
    });
	
	
function make_billing() {
	$('#msg_area').empty();
	$('#procedure_text').empty();
	$('#medicine_table_body_preview').empty();
	$('#injections_table_body_preview').empty();
	$('#consumables_table_body_preview').empty();
	$('#sub_procedures_table_body_preview').empty();
	
	$('#procedure_text').append($('#procedure_parent').find(':selected').attr('procedure'));
	/********** MEDICINE TEXT ************/
	var countr = 1;
	var rows= $('#medicine_table_body tr').length;
	$('.medicine_select').each(function(){
			if(countr <= rows){
				var name, price, serial, quantity, company = '';
				if($(this).val() != ''){
					name = $('#medicine_name_'+countr).find(':selected').attr('medicine');
					if(name == null){
						$('#procedure_details_preview .medicine_section').hide();
					}else{
						name = $('#medicine_name_'+countr).find(':selected').attr('medicine');
						price = $('#medicine_name_'+countr).find(':selected').attr('fees');
						company = $('#medicine_name_'+countr).find(':selected').attr('company');
						serial = $('#medicine_name_'+countr).find(':selected').attr('value');
						quantity = $('#medicine_quantity_'+countr).val();
						$('#medicine_table_body_preview').append('<tr><td>'+serial+'</td><td>'+name+'</td><td>'+quantity+'</th><td>'+company+'</td><td>'+price+'</td></tr>');
						$('#procedure_details_preview .medicine_section').show();
					}
				}else{
					$('#procedure_details_preview .medicine_section').hide();
				}
				countr++;
		 }
	});
	/********** MEDICINE TEXT ************/
	
	/********** injections TEXT ************/
	var inj_count = 1;
	var inj_rows= $('#injections_table_body tr').length;
	$('.injections_select').each(function(){
		if(inj_count <= inj_rows){
			var name, price, serial, quantity, company = '';
			if($(this).val() != ''){
				name = $('#injections_name_'+inj_count).find(':selected').attr('injections');
				if(name == null){
					$('#procedure_details_preview .injections_section').hide();
				}else{
					price = $('#injections_name_'+inj_count).find(':selected').attr('fees');
					company = $('#injections_name_'+inj_count).find(':selected').attr('company');
					serial = $('#injections_name_'+inj_count).find(':selected').attr('value');
					quantity = $('#injections_quantity_'+inj_count).val();
					
					$('#injections_table_body_preview').append('<tr><td>'+serial+'</td><td>'+name+'</td><td>'+quantity+'</th><td>'+company+'</td><td>'+price+'</td></tr>');
					$('#procedure_details_preview .injections_section').show();
				}
			}else{
					$('#procedure_details_preview .injections_section').hide();
				}
			inj_count++;
		 }
	});
	/********** injections TEXT ************/
	
	
	/********** consumables TEXT ************/
	var com_count = 1;
	var com_rows= $('#consumables_table_body tr').length;
	$('.consumables_select').each(function(){
		if(com_count <= com_rows){
			var name, price, serial, quantity, company = '';
			if($(this).val() != ''){
					name = $('#consumables_name_'+com_count).find(':selected').attr('consumables');
				if(name == null){
					$('#procedure_details_preview .consumables_section').hide();
				}else{
					price = $('#consumables_name_'+com_count).find(':selected').attr('fees');
					company = $('#consumables_name_'+com_count).find(':selected').attr('company');
					serial = $('#consumables_name_'+com_count).find(':selected').attr('value');
					quantity = $('#consumables_quantity_'+com_count).val();
					
					$('#consumables_table_body_preview').append('<tr><td>'+serial+'</td><td>'+name+'</td><td>'+quantity+'</th><td>'+company+'</td><td>'+price+'</td></tr>');
					$('#procedure_details_preview .consumables_section').show();
				}
			}else{
					$('#procedure_details_preview .consumables_section').hide();
				}
			com_count++;
		 }
	});
	/********** consumables TEXT ************/
	
	
	/********** sub_procedures TEXT ************/
	var s_pro_count = 1;
	var s_pro_rows= $('#sub_procedures_table_body tr').length;
	$('.sub_procedure_select').each(function(){
		if(s_pro_count <= s_pro_rows){
			var name, price = '';
			if($(this).val() != ''){
				name = $('#sub_procedure_'+s_pro_count).find(':selected').text();
				if(name == 'Select'){
					$('section.sub_procedures_section_preview').hide();
				}else{
					price = $('#sub_procedure_'+s_pro_count).find(':selected').attr('fees');							
					$('#sub_procedures_table_body_preview').append('<tr><td>'+name+'</td><td>'+price+'</td></tr>');
					$('section.sub_procedures_section_preview').show();
				}
			}else{
					$('section.sub_procedures_section_preview').hide();
			}
			s_pro_count++;
		 }
	});
	/********** sub_procedures TEXT ************/
	
	$('#procedure_details').hide();
	$('#procedure_details_preview').show();
}
</script>
<!--****** Billing SCRIPT *******-->

<script>
$(document).on('keyup',".medicine_quantity",function(e) {
	var qcount = $(this).attr('qcount');
	quantity_fees(qcount, 'medicine')
});

$(document).on('keyup',".injections_quantity",function(e) {
	var qcount = $(this).attr('qcount');
	quantity_fees(qcount, 'injections')
});

$(document).on('keyup',".consumables_quantity",function(e) {
	var qcount = $(this).attr('qcount');
	quantity_fees(qcount, 'consumables')
});

function quantity_fees(qcount, type) {
	if(type == 'medicine'){
		var fee_total = 0;
		var price_count, price_val, qty_val = '';
		price_count = 'medicine_price_'+qcount;
		price_val = $('#medicine_name_'+qcount).find(':selected').attr('fees');
		qty_val = $('#medicine_quantity_'+qcount).val();
		
		if(qty_val > 0 || qty_val != ''){
			$('.medicine_price').each(function(){
				var price_total = 0;
				if(price_count == this.id){
					var price_total = qty_val*price_val;
					$('#medicine_price_'+qcount).val('');
					$('#medicine_price_'+qcount).val(price_total);
				}
			});
		}else{
				$('#medicine_price_'+qcount).val('');
				$('#medicine_price_'+qcount).val(price_val);
		}
		
		var fee_total = 0;
		$('.medicine_price').each(function(){
			var price_total = 0;
			var price_total = $(this).val();
			fee_total += +price_total;
		});
		$('#medicine_sub_total').val(fee_total);
		$('#medicine_discount').val(0);
		$('#medicine_total').val(fee_total);
	}
	
	if(type == 'injections'){
		var fee_total = 0;
		var price_count, price_val, qty_val = '';
		price_count = 'injections_price_'+qcount;
		price_val = $('#injections_name_'+qcount).find(':selected').attr('fees');
		qty_val = $('#injections_quantity_'+qcount).val();
		
		if(qty_val > 0 || qty_val != ''){
			$('.injections_price').each(function(){
				var price_total = 0;
				if(price_count == this.id){
					var price_total = qty_val*price_val;
					$('#injections_price_'+qcount).val('');
					$('#injections_price_'+qcount).val(price_total);
				}
			});
		}else{
				$('#injections_price_'+qcount).val('');
				$('#injections_price_'+qcount).val(price_val);
		}
		
		var fee_total = 0;
		$('.injections_price').each(function(){
			var price_total = 0;
			var price_total = $(this).val();
			fee_total += +price_total;
		});
		$('#injections_sub_total').val(fee_total);
		$('#injections_discount').val(0);
		$('#injections_total').val(fee_total);
	}
	
	if(type == 'consumables'){
		var fee_total = 0;
		var price_count, price_val, qty_val = '';
		price_count = 'consumables_price_'+qcount;
		price_val = $('#consumables_name_'+qcount).find(':selected').attr('fees');
		qty_val = $('#consumables_quantity_'+qcount).val();
		
		if(qty_val > 0 || qty_val != ''){
			$('.consumables_price').each(function(){
				var price_total = 0;
				if(price_count == this.id){
					var price_total = qty_val*price_val;
					$('#consumables_price_'+qcount).val('');
					$('#consumables_price_'+qcount).val(price_total);
				}
			});
		}else{
				$('#consumables_price_'+qcount).val('');
				$('#consumables_price_'+qcount).val(price_val);
		}
		
		var fee_total = 0;
		$('.consumables_price').each(function(){
			var price_total = 0;
			var price_total = $(this).val();
			fee_total += +price_total;
		});
		$('#consumables_sub_total').val(fee_total);
		$('#consumables_discount').val(0);
		$('#consumables_total').val(fee_total);
	}
	
}

</script>