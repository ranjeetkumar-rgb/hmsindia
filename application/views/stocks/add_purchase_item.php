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
	span.select2.select2-container.select2-container--default {
    width: 110px !important;
}
</style>
<form class="col-sm-12 col-xs-12" id="add_billing_form" method="post" action="">
  <input type="hidden" name="action" value="add_purchase_item" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="procedure_details">
      <div class="panel-heading">
        <h3 class="heading">Medicine Billing</h3>
      </div>
      <div class="panel-body profile-edit">
     	<p id="msg_area" class="delete"></p>
        <p>
            <div id="main_div">
            	<div class="row">            
                   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Purchase Po No</label>
                        <input value="" placeholder="Purchase Po No" id="purchase_po_no" name="purchase_po_no" type="text" class="form-control required_value" required>
                    </div>
                   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Po Date</label>
                        <input placeholder="Po Date" id="po_date" name="po_date" type="date" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Purchase Invoice No</label>
                        <input placeholder="Po Date" id="purchase_invoice_no" name="purchase_invoice_no" type="text" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Date Of Purchase</label>
                        <input placeholder="Date Of Purchase" id="date_of_purchase" name="date_of_purchase" type="date" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Vendor Name</label>
                        <input placeholder="Vendor Name" id="vendor_name" name="vendor_name" type="text" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Vendor Code</label>
                        <input placeholder="Vendor Code" id="vendor_code" name="vendor_code" type="text" class="form-control required_value" required>
                   </div>
                </div>
                <div class="clearfix"></div>
                <hr />
                <section class="col-sm-12 col-xs-12 consumables_section">
                  <div class="clearfix"></div>
                  <input type="button" class="add-consumables-row btn btn-large" value="Add Item">
				  <input type="button" class="delete-consumables-row btn btn-large pull-right" value="Delete Selected Item">
                  <table style="background-color:#ffffff;">
                    <thead>
                        <tr>
                            <th width="4%">Product Name</th>
							<th width="4%">Brand</th>
                            <th width="4%">Batch</th>
							<th width="4%">HSN</th>
							<th width="4%">Expiry Date</th>
							<th width="4%">MRP</th>
                            <th width="4%">Rate Per Unit</th>
							<th width="4%">Quantity</th>
							<th width="4%">Total Purchase Value Excl Gst</th>
                            <th width="4%">Discount Rate (%)</th>
                            <th width="4%">Discount Amt</th>
                            <th width="4%">Total Purchase After Dis Excl Gst</th>
							<th width="3%">GST</th>
                            <th width="3%">Total Purchase Value Incl Gst</th>
							<th width="3%">Monetary Value</th>
							<th width="3%">Category</th>
						</tr>
                    </thead>
			        <tbody id="consumables_table_body">
                        <tr class="consumables_row_1" trcount="1">
                            <td><input value="" placeholder="Product Name" id="product_name_1" class="cons-cls-1 product_name_1 form-control" name="product_name_1" type="text" required></td>
                            <td><input value="" placeholder="Brand" id="brand_name_1" class="cons-cls-1 brand_name_1 form-control" name="brand_name_1" type="text" required></td>
							<td><input value="" placeholder="Batch" id="batch_no_1" class="cons-cls-1 batch_no_1 form-control" name="batch_no_1" type="text" required></td>                   
							<td><input value="" placeholder="HSN" id="hsn_code_1" class="cons-cls-1 hsn_code_1 form-control" name="hsn_code_1" type="text" required></td>                   
							<td><input value="" placeholder="Exp" id="date_of_expiry_1" class="cons-cls-1 date_of_expiry_1 form-control" name="date_of_expiry_1" type="date" required></td>
                            <td><input value="" placeholder="MRP" id="mrp_1" class="cons-cls-1 mrp_1 form-control" name="mrp_1" type="text"></td>
							<td><input value="" placeholder="Rate" id="rate_per_unit_1" class="cons-cls-1 rate_per_unit_1 form-control" name="rate_per_unit_1" type="text"></td>
							<td><input value="" placeholder="Quantity" id="quantity_1" class="cons-cls-1 quantity_1 form-control" name="quantity_1" type="text"></td>
							<td><input value="" placeholder="Total Purchase Value Excl Gst" id="total_purchase_value_excl_gst_1" class="cons-cls-1 total_purchase_value_excl_gst_1 form-control" name="total_purchase_value_excl_gst_1" type="text"></td>
							<td><input value="" placeholder="Discount (%)" id="discount_rate_1" class="cons-cls-1 discount_rate_1 form-control" name="discount_rate_1" type="text"></td>
							<td><input value="" placeholder="Discount Amt" id="discount_amt_1" class="cons-cls-1 discount_amt_1 form-control" name="discount_amt_1" type="text"></td>
							<td><input value="" placeholder="Total Purchase After Dis Excl Gst" id="total_purchase_after_discount_exculding_gst_1" class="cons-cls-1 total_purchase_after_discount_exculding_gst_1 form-control" name="total_purchase_after_discount_exculding_gst_1" type="text"></td>
							<td><input value="" placeholder="GST" id="gst_rate_1" class="cons-cls-1 gst_rate_1 form-control" name="gst_rate_1" type="text" required></td>
							<td><input value="" placeholder="Total Purchase Value Incl Gst" id="total_purchase_value_incl_gst_1" class="cons-cls-1 total_purchase_value_incl_gst_1 form-control" name="total_purchase_value_incl_gst_1" type="text" required></td>
							<td><input value="" placeholder="Monetary Value" id="monetary_value_1" class="cons-cls-1 monetary_value_1 form-control" name="monetary_value_1" type="text" required></td>
							<td><input value="" placeholder="Category" id="category_1" class="cons-cls-1 category_1 form-control" name="category_1" type="text" required></td>
							<td  width="1%"><input type="checkbox" class="statuss" name="record"></td>
                        </tr>
                    </tbody>
                </table> 
                </section>
				
				<div class="row">            
                   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Freight & Forwarding Charges</label>
                        <input value="" placeholder="Freight & Forwarding Charges" id="freight_forwarding_charges" name="freight_forwarding_charges" type="text" class="form-control required_value" required>
                    </div>
                   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Centre Location</label>
                        <input placeholder="Centre Location" id="centre_location" name="centre_location" type="text" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Date Of Receiving</label>
                        <input placeholder="Date Of Receiving" id="date_of_receiving" name="date_of_receiving" type="date" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Received By</label>
                        <input placeholder="Received By" id="received_by" name="received_by" type="date" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Entry Date In Tally</label>
                        <input placeholder="Entry Date In Tally" id="entry_date_in_tally" name="entry_date_in_tally" type="date" class="form-control required_value" required>
                   </div>
				   <div class="form-group col-sm-4 col-xs-12">
                        <label for="item_name">Msme Applicability</label>
                        <input placeholder="Msme Applicability" id="msme_applicability" name="msme_applicability" type="date" class="form-control required_value" required>
                   </div>
                </div>
		    <div class="row" id="grand_total_section">
                <div class="clearfix"></div>
                <div class="form-group col-sm-12 col-xs-12">
                <button type="button" id="create_billing"> Create Billing </button>
                </div>
            </div>
			<div class="clearfix"></div>
            </div>
      </div>
      </p>
    </div>
  </div>
</form>
<!--****** consumables SCRIPT *******-->
<script>    
	 $(document).on('change',".consumables_select",function(e) {
        $('#msg_area').empty();
		var serial = $(this).val();
		var count = $(this).attr('count');
		$('#product_name_'+count).val('');
		$('#brand_name_'+count).val('');
		$('#batch_no_'+count).val('');
		$('#hsn_code_'+count).val('');
		$('#date_of_expiry_'+count).val('');
		$('#mrp_'+count).val('');
		$('#rate_per_unit_'+count).val('');
		$('#quantity_'+count).attr("item_number", "");
		$('#total_purchase_value_excl_gst_'+count).val('');
		$('#discount_rate_'+count).val('');
		$('#discount_amt_'+count).val('');
		$('#total_purchase_after_discount_exculding_gst_'+count).val('');
		$('#gst_rate_'+count).val('');
		$('#total_purchase_value_incl_gst_'+count).val('');
		$('#monetary_value_'+count).val('');  
        $('#category_'+count).attr("item_number", "");
		
	});
	
	 $(document).ready(function(){
		 
		$(".add-consumables-row").click(function(){
			var rows= $('#consumables_table_body tr:last').attr('trcount');
			var count = parseFloat(rows) + 1;
           var markup = '<tr class="consumables_row_'+count+'" trcount="'+count+'"><td><input value="" placeholder="Product Name" id="product_name_'+count+'" class="cons-cls-'+count+' product_name_'+count+' form-control " name="product_name_'+count+'" type="text" required></td><td><input value="" placeholder="Brand" id="brand_name_'+count+'" class="cons-cls-'+count+' brand_name_ form-control"  name="brand_name_'+count+'" type="text" required></td><td><input value="" placeholder="Batch" id="batch_no_'+count+'" class="consumables_quantity batch_no_'+count+' form-control cons-cls-'+count+'" name="batch_no_'+count+'" type="text" required></td><td><input value="" placeholder="HSN" id="hsn_code_'+count+'" class="cons-cls-'+count+' hsn_code_'+count+' form-control " name="hsn_code_'+count+'" type="text" required></td><td><input value="" placeholder="Expiry Date" id="date_of_expiry_'+count+'" class="cons-cls-'+count+' date_of_expiry_ form-control "  name="date_of_expiry_'+count+'" type="date" required></td><td><input value="" placeholder="MRP" id="mrp_'+count+'" class="cons-cls-'+count+' mrp_ form-control "  name="mrp_'+count+'" type="text" required></td><td><input value="" placeholder="Rate" id="rate_per_unit_'+count+'" qcount="'+count+'" item_number="" class="cons-cls-'+count+' rate_per_unit_'+count+' form-control " name="rate_per_unit_'+count+'" type="text" required></td><td><input value="" placeholder="Quantity" id="quantity_'+count+'" class="cons-cls-'+count+' quantity_'+count+' form-control " name="quantity_'+count+'" type="text" required></td><td><input value="" id="total_purchase_value_excl_gst_'+count+'" class="cons-cls-'+count+' total_purchase_value_excl_gst_'+count+' form-control " name="total_purchase_value_excl_gst_'+count+'" type="text"></td><td><input value="" placeholder="" id="discount_rate_'+count+'" class="cons-cls-'+count+' discount_rate_'+count+' form-control " name="discount_rate_'+count+'" type="text"></td><td><input value="" placeholder="" id="discount_amt_'+count+'" class="cons-cls-'+count+' discount_amt_'+count+' form-control " name="discount_amt_'+count+'" type="text"></td><td><input value="" placeholder="" id="total_purchase_after_discount_exculding_gst_'+count+'" class="cons-cls-'+count+' total_purchase_after_discount_exculding_gst_'+count+' form-control " name="total_purchase_after_discount_exculding_gst_'+count+'" type="text"></td><td><input value="" placeholder="GST" id="gst_rate_'+count+'" class="cons-cls-'+count+' gst_rate_'+count+' form-control " name="gst_rate_'+count+'" type="text"></td><td><input value="" id="total_purchase_value_incl_gst_'+count+'" class="cons-cls-'+count+' total_purchase_value_incl_gst_'+count+' form-control " name="total_purchase_value_incl_gst_'+count+'" type="text"></td><td><input value="" id="monetary_value_'+count+'" class="cons-cls-'+count+' monetary_value_'+count+' form-control " name="monetary_value_'+count+'" type="text"></td><td><input value="" id="category_'+count+'" class="cons-cls-'+count+' category_'+count+' form-control " name="category_'+count+'" type="text"></td><td><input type="checkbox" class="statuss" name="record"></td></tr>';
             $("table tbody#consumables_table_body").append(markup);
		});
        
        // Find and remove selected table rows
        $(".delete-consumables-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
			});
			//calculate_fees();
        });
    });
	
$(function(){
	  // turn the element to select2 select style
	  $('.select2').select2({
		placeholder: "Select stock item."
	  }).on('change', function(e) {
		var data = $(".select2 option:selected").val();
			
	  });
	
});
</script>
<!--****** consumables SCRIPT *******-->

<script>
   $('#create_billing').click(function(e){
 e.preventDefault();
 if(this.form.reportValidity()){
  $(this).prop('disabled',true);
  this.form.submit();
 }
});
</script>
<!--****** Billing SCRIPT *******-->