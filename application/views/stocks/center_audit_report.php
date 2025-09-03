<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Audit Report </h3></div>
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
          <form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
          <input type="hidden" name="action" value="center_audit_report" />
          <table class="table table-striped table-bordered table-hover stock_list" id="centre_stock_list">
    <thead>
        <tr>
            <th>Item name</th>
            <th>Batch</th>
            <th>Quantity (units)</th>
            <th>Physical Quantity</th>
            <th>Register Quantity</th>
            <th>Short</th>
            <th>Excess</th>
            <th>Damage</th>
            <th>Expiry Warning</th>
            <th>Expiry</th>
            <th>Employee No</th>
            <th>Employee Name</th>
        </tr>
    </thead>
    <tbody id="table_content">
        <?php foreach($investigate_result as $vl){ ?>
        <tr class="odd gradeX">
            <td><input type="text" value="<?php echo $vl['item_name']?>" id="item_name" name="item_name[]" readonly=""></td>
            <td><input type="text" value="<?php echo $vl['batch_number']?>" id="batch_number" name="batch_number[]" readonly=""></td>
            <td>    <input type="text" value="<?php echo $vl['quantity']; ?>" class="quantity" name="quantity[]" readonly=""></td>
            <td><input type="text" value="<?php echo $vl['physical_quantity[]']?>" id="physical_quantity" required="" name="physical_quantity[]" class="physical_quantity"></td>
            <td><input type="text" value="<?php echo $vl['register_quantity']?>" id="register_quantity" required="" name="register_quantity[]" class="register_quantity"></td>
            <td><input type="number" value="<?php echo $vl['short']?>" id="short" name="short[]" class="short" readonly=""></td>
            <td><input type="number" value="<?php echo $vl['excess']?>" id="excess" name="excess[]" class="excess" readonly=""></td>
            <td><input type="number" value="<?php echo $vl['damage']; ?>" id="damage" name="damage[]" ></td>
            <td><input type="text" value="<?php echo $vl['expiry_day']; ?>" id="expiry_day" name="expiry_day[]" readonly=""></td>
            <td><input type="text" value="<?php echo $vl['expiry']; ?>" id="expiry" name="expiry[]" readonly=""></td>
            <td><input type="text" value="<?php echo $vl['employee_number']?>" id="employee_number" name="employee_number[]" readonly=""></td>
            <td><input type="text" value="<?php echo $_SESSION['logged_billing_manager']['name']?><?php echo $_SESSION['logged_stock_manager']['name']?>" id="requisition" name="requisition[]" readonly=""></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
            
            <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit">
          <input type='button' id='btn' value='Print Order' class="btn btn-primary" onclick='printDiv();'>
        </div>
        </form>
        <div class="row" id="print_this_section" style="display:none;">
  
        <table class="table table-striped table-bordered table-hover stock_list" id="centre_stock_list">
              <thead>
                <tr>
                  <th>Item name</th>
                  <th>Batch</th>
                  <th>Quantity (units)</th>  
                  <th>Physical Quantity</th>
				          <th>Register Quantity</th>
        </tr>
              </thead>
              <tbody id="table_content">
              <?php foreach($investigate_result as $vl){ ?>
                <tr class="odd gradeX">
				          <td><input type="text" value="<?php echo $vl['item_name']?>" id="item_name" name="item_name[]" readonly="" ></td>
                  <td><input type="text" value="<?php echo $vl['batch_number']?>" id="batch_number" name="batch_number[]" readonly=""></td>
                  <td><input type="text" value="<?php echo $vl['quantity']?>" id="quantity" name="quantity[]" readonly="" ></td>
                  <td><input type="text" value="<?php echo $vl['physical_quantity']?>" id="physical_quantity" required="" name="physical_quantity[]"></td>
				          <td><input type="text" value="<?php echo $vl['register_quantity']?>" id="register_quantity" required="" name="register_quantity[]" ></td>
                </tr>
              <?php } ?>
			   
              </tbody>
            </table>

              </div>
             
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
<style >
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
.form-control#billing_at{
  height: 40px!important;
  border: 1px solid #9e9e9e!important;
}
</style>
<script>
function printDiv() 
{
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
</script>

<script>
    // Function to calculate Short and Excess values
    function calculateQuantities(row) {
        const quantity = parseInt(row.querySelector('.quantity').value) || 0;
        const physicalQuantity = parseInt(row.querySelector('.physical_quantity').value) || 0;

        let short = 0;
        let excess = 0;

        // Calculate Short or Excess based on comparison
        if (physicalQuantity > quantity) {
            excess = physicalQuantity - quantity; // Physical quantity is greater
            short = 0;
        } else if (physicalQuantity < quantity) {
            short = quantity - physicalQuantity; // Registered quantity is greater
            excess = 0;
        } else {
            short = 0; // Quantities are equal
            excess = 0;
        }

        // Set the values in Short and Excess input fields
        row.querySelector('.short').value = short;
        row.querySelector('.excess').value = excess;
    }

    // Attach event listeners to all physical quantity input fields
    document.querySelectorAll('.physical_quantity').forEach(function (input) {
        input.addEventListener('input', function () {
            const row = this.closest('tr'); // Get the current row
            calculateQuantities(row); // Calculate short and excess values
        });
    });
</script>


