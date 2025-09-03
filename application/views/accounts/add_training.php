
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add_training" />
    <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
        <div class="panel-heading">
          <h3 class="heading">Product Advisory Fee</h3>
        </div>
        <div class="panel-body profile-edit">
          <p>
          <div class="row">
		    <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Student Name</label>
			  <input value=""  placeholder="Student Name" id="training_name" name="training_name" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Student Father Name</label>
			  <input value=""  placeholder="Student Father Name" id="training_fname" name="training_fname" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Course Duration</label>
			  <input value=""  placeholder="Course Duration" id="duration" name="duration" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label for="company">Fee Amount</label>
			  <input value=""  placeholder="Fee Amount" id="fee_amount" name="fee_amount" type="text" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="company">Paid Amount</label>
			  <input value=""  placeholder="Amount" id="paid_amount" name="paid_amount" type="text" class="form-control validate" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
                <label for="expiry">Address</label>
                <input value="" placeholder="Address" id="address" name="address" type="text" class="form-control validate" required>
                <input value=""  placeholder="HSN" id="hsn" name="hsn" type="hidden" class="form-control validate" required>
                <input value="0" placeholder="status" id="gst" name="status" type="hidden" class="form-control validate" required>
                <input value="<?php echo date("y-m-d") ?>" placeholder="date" id="date" name="date" type="hidden" class="form-control validate" required>
            </div>
			<div class="form-group col-sm-4 col-xs-12">
              <label for="company">Payment Method</label>
              <select name="payment_method" id="payment_method">
                <option value="">Select</option>
                <option value="card" mode="Card">Card</option>
                <option value="upi" mode="UPI">UPI</option>
                <option value="cash" mode="Cash">Cash</option>
                <option value="neft" mode="Neft">Neft</option>
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

<style type="text/css">
select{
    display: block;
}
</style>