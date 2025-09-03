
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="action" value="add_vendor" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add vendor</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Vendor name (Required)</label>
            <input value="" placeholder="Vendor name" id="name" name="name" type="text" class="form-control validate" required>
          </div>

          <!----->
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Company name(Required)</label>
            <input value="" placeholder="Company name" id="company_name" name="company_name" type="text" class="form-control validate" required>
          </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Types of companies (Required)</label>
        	 <select name="companies_type" id="companies_type" class="form-control" style="margin-bottom:24px;" required>
              	<option value="">Account Type</option>
				<option value="Private limited company">Private limited company</option>
				<option value="Partnership">Partnership</option>
				<option value="Limited Liability Company">Limited Liability Company</option>
				<option value="Holding company">Holding company</option>
			  </select>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Company address(Required)</label>
            <input value="" placeholder="Company address" id="company_address" name="company_address" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Phone Number(Required)</label>
            <input value="" placeholder="Phone Number" id="phone_number" name="phone_number" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Contact Person Name(Required)</label>
            <input value="" placeholder="Contact Person Name" id="contact_person_name" name="contact_person_name" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Contact person designation(Required)</label>
            <input value="" placeholder="Contact person designation" id="contact_person_designation" name="contact_person_designation" type="text" class="form-control validate" required>
          </div>

           <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Bank Name (Required)</label>
            <input value="" placeholder="Bank Name" id="bank_name" name="bank_name" type="text" class="form-control validate" >
		  </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Branch Name (Required)</label>
            <input value="" placeholder="Branch Name" id="branch_name" name="branch_name" type="text" class="form-control validate" >
		  </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Beneficiary Name (Required)</label>
            <input value="" placeholder="Beneficiary Name" id="beneficiary_name" name="beneficiary_name" type="text" class="form-control validate" >
		  </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Account Number (Required)</label>
            <input value="" placeholder="Account Number" id="account_no" name="account_no" type="text" class="form-control validate" >
		  </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">IFSC Code (Required)</label>
            <input value="" placeholder="IFSC Code" id="ifsc_code" name="ifsc_code" type="text" class="form-control validate" >
		   </div>
		   <div class="form-group col-sm-6 col-xs-12">
              <label for="quantity">Account Type (Required)</label>
              <select name="account_type" id="account_type" class="form-control" required>
              	<option value="">Account Type</option>
				<option value="Savings Account">Savings Account</option>
				<option value="Current Account">Current Account</option>
				<option value="Salary Account">Salary Account</option>
			  </select>
            </div>
			<div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Cancel Check(Required)</label>
            <input value="" placeholder="Cancel Check" id="cancel_check" name="cancel_check" type="file" class="form-control">
          </div>
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">GST Number(Required)</label>
            <input value="" placeholder="GST Number" id="gst_no" name="gst_no" type="text" class="form-control validate"  required>
		 </div>
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">GST (Required)</label>
            <input value="" placeholder="GST Number" id="gst_number" name="gst_number"  type="file" class="form-control">
          </div>
		   </div>
		   <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Drug License Number(Required)</label>
            <input value="" placeholder="Drug License Number" id="drug_license_no" name="drug_license_no" type="text" class="form-control validate" required>
          </div>
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Drug License(Required)</label>
            <input value="" placeholder="Drug License Number" id="drug_license_number" name="drug_license_number" type="file" class="form-control">
		  </div>
		  </div>
		  <div class="row">
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">FSSAI Number(Required)</label>
            <input value="" placeholder="FSSAI Number" id="fssai_no" name="fssai_no" type="text" class="form-control validate">
		  </div>
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">FSSAI Number(Required)</label>
            <input value="" placeholder="FSSAI Number" id="fssai_number" name="fssai_number" type="file" class="form-control">
		  </div>
		  </div>
		  <div class="row">
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Pan Number(Required)</label>
            <input value="" placeholder="Pan Number" id="pan_no" name="pan_no" type="text" class="form-control validate" required>
		  </div>
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Pan (Required)</label>
        	<input value="" placeholder="Pan Number" id="pan_number" name="pan_number" type="file" class="form-control">
          </div>
		  </div>
		   <div class="row">
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">MSME (Required)</label>
            <input value="" placeholder="MSME Number" id="msme_no" name="msme_no" type="text" class="form-control validate" >
		  </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">MSME (Required)</label>
        	<input value="" placeholder="MSME Number" id="msme_number" name="msme_number" type="file" class="form-control">
          </div>
		  </div>
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">MOU (Required)</label>
        	<input value="" placeholder="MOU" id="mou" name="mou" type="file" class="form-control">
          </div>
		   <!----->
          
          	<div class="form-group col-sm-6 col-xs-12">
            <label for="statuss">Status (Required)</label>
            <br/>
            <input type="radio" name="status" value="1" class="statuss" checked> Active 
            <input type="radio" name="status" value="0" class="statuss"> Inactive 
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