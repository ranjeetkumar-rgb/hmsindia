
<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data" >
    <input type="hidden" name="action" value="update_vendor" />
    <input type="hidden" name="id" value="<?php echo $data['ID']; ?>" />
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Edit vendor</h3>
      </div>
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
             <label for="item_name">Vendor name (Required)</label>
            <input value="<?php echo $data['name']?>" placeholder="Vendor name" id="name" name="name" type="text" class="form-control validate" required>
          </div>

           <!----->

           <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Company name(Required)</label>
            <input value="<?php echo $data['company_name']?>" placeholder="Company name" id="company_name" name="company_name" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Company address(Required)</label>
            <input value="<?php echo $data['company_address']?>" placeholder="Company address" id="company_address" name="company_address" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Phone Number(Required)</label>
            <input value="<?php echo $data['phone_number']?>" placeholder="Phone Number" id="phone_number" name="phone_number" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Contact Person Name(Required)</label>
            <input value="<?php echo $data['contact_person_name']?>" placeholder="Contact Person Name" id="contact_person_name" name="contact_person_name" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Contact person designation(Required)</label>
            <input value="<?php echo $data['contact_person_designation']?>" placeholder="Contact person designation" id="contact_person_designation" name="contact_person_designation" type="text" class="form-control validate" required>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">GST Number(Required)</label>
            <input value="<?php echo $data['gst_no']?>" placeholder="GST Number" id="gst_no" name="gst_no" type="text" class="form-control validate" required>
            <input value="" placeholder="GST Number" id="gst_number" name="gst_number" type="file" class="form-control">
		  </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Drug License Number(Required)</label>
            <input value="<?php echo $data['drug_license_no']?>" placeholder="Drug License Number" id="drug_license_no" name="drug_license_no" type="text" class="form-control validate" required>
             <input value="" placeholder="Drug License Number" id="drug_license_number" name="drug_license_number" type="file" class="form-control">
		  
		  </div>
		  
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">FSSAI Number(Required)</label>
            <input value="<?php echo $data['fssai_no']?>" placeholder="FSSAI Number" id="fssai_no" name="fssai_no" type="text" class="form-control validate">
			<input value="" placeholder="FSSAI Number" id="fssai_number" name="fssai_number" type="file" class="form-control">
		  
          </div>
		  
		   <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Pan Number(Required)</label>
            <input value="<?php echo $data['pan_no']?>" placeholder="Pan Number" id="pan_no" name="pan_no" type="text" class="form-control validate" required>
			<input value="" placeholder="Pan Number" id="pan_number" name="pan_number" type="file" class="form-control">
          </div>
		  
		  <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">MSME (Required)</label>
            <input value="<?php echo $data['msme_no']?>" placeholder="MSME Number" id="msme_no" name="msme_no" type="text" class="form-control validate" >
			<input value="" placeholder="MSME Number" id="msme_number" name="msme_number" type="file" class="form-control">
          </div>
          <!----->
          
          <div class="form-group col-sm-6 col-xs-12">
            <label for="statuss">Status (Required)</label>
            <br/>
            <input type="radio" name="status" value="1" <?php if($data['status'] == 1){echo 'checked="checked"';} ?> class="statuss"> Active 
            <input type="radio" name="status" value="0" <?php if($data['status'] == 0){echo 'checked="checked"';} ?> class="statuss"> Inactive 
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
