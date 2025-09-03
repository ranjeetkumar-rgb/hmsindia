
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add_fellowship" />

    <?php
// SQL Query to fetch the last 4 digits from the most recent record
$sql = "SELECT RIGHT(studentid, 4) AS last_4_digits FROM hms_fellowship_training ORDER BY id DESC LIMIT 1";
// Execute the query using the custom function
//$result = run_select_query($sql); // Assuming this function executes the query and returns an array
$select_result = run_select_query($sql);	
//$select_result['applicablemedicine'];
//if ($result) {
    // Extract the last 4 digits
    $last_4_digits = $select_result['last_4_digits'];
    // Increment the value and retain leading zeros
    $incremented_value = str_pad((int)$last_4_digits + 1, 4, "0", STR_PAD_LEFT);
    // Display the incremented value
   
//} else {
//    echo "No records found.";
//}
?>
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Fellowship And Training</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
          <div class="form-group col-sm-4 col-xs-12">
                <label for="expiry">Student ID</label>
                <input value="DR/<?php echo date("Y-m"); ?>/01/<?php echo $incremented_value; ?>" id="studentid" name="studentid" readonly="" type="text" class="form-control validate" required>
            </div>
		    <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Student Name</label>
			  <input value=""  placeholder="Student Name" id="name" name="name" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Student Father Name</label>
			  <input value=""  placeholder="Student Father Name" id="fname" name="fname" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12" style="margin-bottom: 40px;">
              <label for="company">Course</label>
			    <select id="course" class="consumables_select form-control" name="course" required>
                    <option value="">-- Select --</option>
              	    <?php foreach($courses as $key => $value){ ?>
                	<option value="<?php echo $value['name']; ?>" code="<?php echo $value['code']; ?>" price="<?php echo $value['price']; ?>"><?php echo $value['name']; ?></option>
					<?php } ?>
                </select>
            </div>
            
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Code</label>
			  <input value=""  placeholder="Code" id="code" name="code" type="text" class="form-control validate" readonly="" required>
        <input value="999294"  placeholder="HSN" id="hsn" name="hsn" type="hidden" class="form-control validate" readonly="" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Total Package</label>
			  <input value=""  placeholder="Fee Amount" id="price" name="price" type="text" class="form-control validate" readonly="" oninput="calculateRemaining()" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="company">Discount</label>
			  <input value=""  placeholder="Amount" id="discount_amount" name="discount_amount" type="text" class="form-control validate" oninput="calculateRemaining()" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Paid Amount</label>
			  <input value=""  placeholder="Paid Amount" id="payment_done" name="payment_done" type="text" class="form-control validate" oninput="calculateRemaining()" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">GST Amount</label>
			  <input value=""  placeholder="GST Amount" id="gst_amount" name="gst_amount" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Remaining Amount</label>
			  <input value=""  placeholder="Remaining Amount" id="remaining_amount" name="remaining_amount" readonly="" type="text" class="form-control validate" required>
              <input value="18" placeholder="GST" id="gst" name="gst" type="hidden" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="expiry">Address</label>
                <input value="" placeholder="Address" id="address" name="address" type="text" class="form-control validate" required>
                <input value="<?php echo date("y-m-d") ?>" placeholder="on_date" id="on_date" name="on_date" type="hidden" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12" style="margin-bottom: 47px;">
              <label for="company">Payment Method</label>
              <select name="payment_method" id="payment_method">
                <option value="">Select</option>
                <option value="card" mode="Card">Card</option>
                <option value="upi" mode="UPI">UPI</option>
                <option value="cash" mode="Cash">Cash</option>
                <option value="neft" mode="Neft">Neft</option>
              </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Upload Receipt</label>
			  <input value=""  placeholder="Discount" id="receipt_url" name="receipt_url" type="file" class="form-control validate" required>
            </div>
            
			<div class="form-group col-sm-4 col-xs-12" style="margin-bottom: 47px;">
              <label for="company">Place Of Supply</label>
              <select name="place_of_supply" id="place_of_supply">
                <option value="">Select</option>
                <option value="Uttar Pradesh" mode="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Haryana" mode="Haryana">Haryana</option>
                <option value="Delhi" mode="Delhi">Delhi</option>
              </select>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">GST NO</label>
			        <input value=""  placeholder="GST No" id="gst_number" name="gst_number" type="text" class="form-control validate" required>
              <input value="<?php echo date("Ymdhms"); ?>" id="receipt" name="receipt" readonly="" type="hidden" class="form-control validate" required>
              <input value="001/T/2425/0001" id="invoice_no" name="invoice_no" readonly="" type="hidden" class="form-control validate" required>
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

<style type="text/css">
select{
    display: block;
}
</style>


<script>
 $(document).on('change',".consumables_select",function(e) {
        $('#name').val('');
		$('#code').val('');
		$('#price').val('');
		
		if(name != ''){
			//var product_id = $(this).val();
			var name = $(this).find(':selected').attr('name');
			var code = $(this).find(':selected').attr('code');
			var price = $(this).find(':selected').attr('price');
			
			$('#name').val(name);
			$('#code').val(code);
			$('#price').val(price);
		}			
    });

    function calculateRemaining() {
            // Get the input values
            var price = parseFloat(document.getElementById("price").value) || 0;
            var discount_amount = parseFloat(document.getElementById("discount_amount").value) || 0;
            var payment_done = parseFloat(document.getElementById("payment_done").value) || 0;

            // Calculate the final price after subtracting the fixed discount amount
            var finalPrice = price - discount_amount;
            
            // Calculate the GST amount (18% of the final price)
            var gst_amount = finalPrice * 0.18;
            
            // Add the GST amount to the final price
            var finalPriceWithGst = finalPrice + gst_amount;
            
            // Calculate the remaining amount after subtracting the payment done
            var remaining_amount = finalPriceWithGst - payment_done;
            
            // Set the remaining amount to the input field
            document.getElementById("remaining_amount").value = remaining_amount.toFixed(2);

            // Optionally set the GST amount to a visible field if needed
            document.getElementById("gst_amount").value = gst_amount.toFixed(2);
        }
</script>