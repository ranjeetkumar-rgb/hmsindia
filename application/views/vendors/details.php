<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
  <div class="panel-body profile-edit">
  <h3>Vendor Details</h3>
  <div class="clearfix"></div>

<table style="width:100%; border: 1px solid black; border-collapse: collapse;">

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor Name:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['name'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Vendor Number:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['vendor_number'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company Name:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['company_name'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company Address:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['company_address'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Phone Number:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['phone_number'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Contact Person Name:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['contact_person_name'];?></td>

  </tr>

  <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Contact Person Designation:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['contact_person_designation'];?></td>

  </tr>

  <tr>

  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">GST Number:</th>

  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['gst_no'];?></td>

  </tr>

  <tr>

  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Drug License Number:</th>

  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['drug_license_no'];?></td>

  </tr>
  
   <tr>

  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">FSSI Number:</th>

  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['fssai_no'];?></td>

  </tr>
  
  <tr>

  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Type Of Company:</th>

  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['companies_type'];?></td>

  </tr>
  
  <tr>

  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Account Details:</th>

  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Bank Name: <?php echo $data['bank_name'];?> | Branch Name: <?php echo $data['branch_name'];?> | Bciary Name: <?php echo $data['Beneficiary_name'];?> | Account No: <?php echo $data['account_no'];?> | IFSC Code: <?php echo $data['ifsc_code'];?> | IFSC Code: <?php echo $data['account_type'];?></td>

  </tr>
  
  <tr>

  <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">List Of Certificate:</th>

  <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><a href="<?php echo $data['drug_license_number'];?>" target="_blank">Drug License</a> | <a href="<?php echo $data['gst_number'];?>" target="_blank">GST</a> | <a href="<?php echo $data['fssai_number'];?>" target="_blank">FSSAI</a> | <a href="<?php echo $data['pan_number'];?>" target="_blank">PANCARD</a> | <a href="<?php echo $data['msme_number'];?>" target="_blank">MSME</a> | <a href="<?php echo $data['msme_number'];?>" target="_blank">MOU</a> | <a href="<?php echo $data['cancel_check'];?>" target="_blank">Cancel Check</a></td>

  </tr>

    <tr>

    <th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Added On:</th>

    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $data['date'];?></td>

  </tr>
  
</table>



 <div class="table-responsive mt-5">
            <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
              <thead>
                  <tr>
				            <th>Item Name</th>
				            <th>Hsn</th>
                    <th>Company Name</th>
                    <th>MRP</th>
				            <th>GST</th>
				            <th>Approved Vendor Price Excluding GST</th>
                    <th>GST Amount</th>
                    <th>Approved Vendor Price including GST</th>
				            <th>Adding Date</th>
				            <th>Date Of Apporoval</th>
				            <th>Status</th> 
				            <th>Action</th> 
				          </tr>
              </thead>
              <tbody id="investigation_result">
			  <?php 
			  $$encgst = 0;
      $sql = "SELECT * FROM `hms_medicines` WHERE vendor_number='$data[vendor_number]' limit 100";
	  $query = $this->db->query($sql);
        $select_result1 = $query->result(); 
		foreach ($select_result1 as $res_val){
			$encgst = $res_val->vendor_price / $res_val->gstdivision;
	  ?>
              <tr class="odd gradeX">
			          <td><?php echo $res_val->name; ?></td>
				        <td><?php echo $res_val->hsn; ?></td>
			          <td><?php echo $res_val->company; ?></td>
			          <td><?php echo $res_val->mrp; ?></td>
				        <td><?php echo $res_val->gstrate; ?></td>
				        <td><?php echo round($encgst,2); ?></td>
				        <td><?php echo round($res_val->vendor_price - $encgst,2); ?></td>
				        <td><?php echo $res_val->vendor_price; ?></td>
			          <td><?php echo $res_val->add_date; ?></td>
				        <td><?php echo $res_val->modified_on; ?></td>
			          <td><?php if($res_val->status == '1'){echo "Approved";}elseif($res_val->status == '2'){echo "Disapproved"; }elseif($res_val->status == '3'){echo "Inactive"; }else{echo "Pending"; } ?></td>
				        <td><?php if($res_val->status == '1'){}else{?> <a href="<?php echo base_url();?>edit-medicine?ID=<?php echo $res_val->ID ?>" class="edit"><i class="material-icons">edit</i></a> <?php } ?>
				        <?php if($_SESSION['logged_administrator']['username'] == "ceo@indiaivf.in"){?>
		            <?php	if($res_val->status == '0'){ ?>
                  <button class="btn btn-large" onclick="approveMedicine(<?php echo $res_val->ID ?>)">Approve</button> |
                  <button class="btn btn-large" onclick="disapproveMedicine(<?php echo $res_val->ID ?>)">Disapprove</button> |
				<?php } ?>
				<a href="<?php echo base_url();?>edit-medicine?ID=<?php echo $res_val->ID ?>" class="edit"><i class="material-icons">edit</i></a>
				<?php } ?><a href="<?php echo base_url('stocks/inactive_medicine/'.$res_val->ID.'');?>" class="btn btn-large">Inactive</a>
				</td>              
			  
			  </tr>
		<?php } ?>
              </tbody>
			  
			  
			</table>
          </div>

<script>
function approveMedicine(id) {
  $.ajax({
    url: "<?php echo base_url('stocks/approve_new_medicine/'); ?>" + id,
    type: "GET",
    success: function(response) {
      // Optionally, update the status in the UI without reloading the page
      alert("Medicine approved!");
      location.reload();  // Optional, refreshes only after the approval if needed
    },
    error: function(xhr, status, error) {
      alert("Failed to approve. Try again.");
    }
  });
}

function disapproveMedicine(id) {
  $.ajax({
    url: "<?php echo base_url('stocks/disapprove_new_medicine/'); ?>" + id,
    type: "GET",
    success: function(response) {
      // Optionally, update the status in the UI without reloading the page
      alert("Medicine disapproved!");
      location.reload();  // Optional, refreshes only after the disapproval if needed
    },
    error: function(xhr, status, error) {
      alert("Failed to disapprove. Try again.");
    }
  });
}
</script>

