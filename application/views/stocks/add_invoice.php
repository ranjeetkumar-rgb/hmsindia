 <?php $all_method =&get_instance(); ?>
<script type="text/javascript">
    var _formConfirm_submitted = false;
</script>
 <form class="col-sm-12 col-xs-12" method="post" action="" >
    <input type="hidden" name="action" value="invoice_add" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Vendor Invoice</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                <label for="expiry">Invoice No(Required)</label>
                <input value="" placeholder="Invoice No" id="invoice_no" name="invoice_no" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">No OF Item</label>
                      <input value="" placeholder="No OF Item" id="no_of_item" name="no_of_item" type="text" class="form-control validate" required>
            </div>
			
        </div>

        <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Total Amont</label>
                      <input value="" placeholder="Total Amont" id="Total_amount" name="Total_amount" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                      <label for="expiry">Invoice Date (Required)</label>
                      <input value="" placeholder="Invoice Date" id="invoice_date" name="invoice_date" type="date" class="form-control validate" required>
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