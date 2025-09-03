    <div class="col-sm-12 col-xs-12">
  <!-- Flash Messages -->
  <?php if($this->session->flashdata('success')): ?>
      <div class="col-sm-12 col-xs-12" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; padding: 15px; margin-bottom: 20px;">
          <h4 style="margin: 0; color: #155724;"><?php echo $this->session->flashdata('success'); ?></h4>
      </div>
  <?php endif; ?>
  <?php if($this->session->flashdata('error')): ?>
      <div class="col-sm-12 col-xs-12" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; padding: 15px; margin-bottom: 20px;">
          <h4 style="margin: 0; color: #721c24;"><?php echo $this->session->flashdata('error'); ?></h4>
      </div>
  <?php endif; ?>
  <?php if($this->session->flashdata('warning')): ?>
      <div class="col-sm-12 col-xs-12" style="background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; border-radius: 4px; padding: 15px; margin-bottom: 20px;">
          <h4 style="margin: 0; color: #856404;"><?php echo $this->session->flashdata('warning'); ?></h4>
      </div>
  <?php endif; ?>
  
  <!-- Purchase Order Form -->
  <form action="<?php echo base_url('accounts/save_purchase_order'); ?>" method="post" class="col-sm-12 col-xs-12" enctype="multipart/form-data">
      <input type="hidden" name="action" value="add_purchase_orders" />

      <div class="row">
          <div class="col-sm-12 col-xs-12 panel panel-piluku">
              <div class="panel-heading text-center">
                  <h3 class="heading">Purchase Order (PO) / Service Work Order (SO)</h3>
              </div>
  
              <div class="panel-body profile-edit">
                  <div class="row">

                      <!-- Centre -->
                      <div class="form-group col-sm-4">
                          <label><strong>Centre/Cluster/Region</strong></label>
                          <select name="po_centre" id="po_centre"  class="form-control"  required>
                                <?php 
                                    $all_method =&get_instance();
                                    $all_method->load->model('center_model');
                                    $centers = $all_method->center_model->get_centers();
                                    if(!empty($centers)){
                                        foreach($centers as $center){
                                            echo '<option value="'.$center['center_number'].'">'.$center['center_name'].'</option>';
                                        }
                                    }
                                    ?>
                            </select>
                          <!-- <select name="po_centre" class="form-control" required>
                              <option value="">-- Select Centre/Cluster/Region --</option>
                              <option value="Noida-Centre">Noida-Centre</option>
                              <option value="Ghaziabad-Centre">Ghaziabad-Centre</option>
                              <option value="Vasant Vihar-Centre">Vasant Vihar-Centre</option>
                              <option value="Gurgaon-Centre">Gurgaon-Centre</option>
                              <option value="Rohini-Centre">Rohini-Centre</option>
                              <option value="Srinagar-Centre">Srinagar-Centre</option>
                              <option value="Corporate">Corporate</option>
                              <option value="Others">Others</option>
                              <option value="TBD">TBD</option>
                          </select> -->
                      </div>

                      <!-- Department -->
                      <div class="form-group col-sm-4">
                          <label><strong>Department</strong></label>
                          <select name="po_department" class="form-control" required>
                              <option value="">-- Select Department --</option>
                              <option value="Director">Director</option>
                              <option value="Finance & Accounts">Finance & Accounts</option>
                              <option value="Human Resource">Human Resource</option>
                              <option value="IT">IT</option>
                              <option value="Operations">Operations</option>
                              <option value="Telesales">Telesales</option>
                              <option value="B2B">B2B</option>
                              <option value="Sales & Marketing">Sales & Marketing</option>
                              <option value="Business Expansion">Business Expansion</option>
                              <option value="Digital marketing">Digital marketing</option>
                              <option value="Clinical-Operations">Clinical-Operations</option>
                              <option value="Clinical-Pharmacy">Clinical-Pharmacy</option>
                              <option value="Clinical-IVF Coordinator">Clinical-IVF Coordinator</option>
                              <option value="Clinical-OT">Clinical-OT</option>
                              <option value="Clinical-Embryologist">Clinical-Embryologist</option>
                          </select>
                      </div>

                      <!-- Nature of Expenditure -->
                      <div class="form-group col-sm-4">
                          <label><strong>Nature of Expenditure</strong> (Capex/Opex)</label>
                          <select name="po_nature_of_expenditure" class="form-control" required>
                              <option value="">-- Select --</option>
                              <option value="Capex">Capex</option>
                              <option value="Opex">Opex</option>
                          </select>
                      </div>

                      <!-- Budget Head -->
                      <div class="form-group col-sm-4">
                          <label><strong>Budget Head</strong></label>
                          <select name="po_budget_head" class="form-control" required>
                              <option value="">-- Select Choose --</option>
                              <option value="Rent Building">Rent Building</option>
                              <option value="Rental Service for Computer">Rental Service for Computer</option>
                              <option value="Rent Agreement Registration Charges">Rent Agreement Registration Charges</option>
                              <option value="Power & Water Charges">Power & Water Charges</option>
                              <option value="Repair and Maintenance">Repair and Maintenance</option>
                              <option value="Employee Benefit Exps.">Employee Benefit Exps.</option>
                              <option value="Office Cleaning & Security Services">Office Cleaning & Security Services</option>
                              <option value="Doctor & Other Medical Professional Charges">Doctor & Other Medical Professional Charges</option>
                              <option value="Human Resource Hiring Exp.">Human Resource Hiring Exp.</option>
                              <option value="Payroll Software Exps">Payroll Software Exps</option>
                              <option value="Consumable & Disposable Opd">Consumable & Disposable Opd</option>
                              <option value="Diagnostic Expenses">Diagnostic Expenses</option>
                              <option value="Healthcare allied Exp.">Healthcare allied Exp.</option>
                              <option value="Legal & Professional Expenses">Legal & Professional Expenses</option>
                              <option value="Licioning & certification Exps">Licioning & certification Exps</option>
                              <option value="Office Expenses">Office Expenses</option>
                              <option value="Electricity & Maintenance">Electricity & Maintenance</option>
                              <option value="Security & House Keeping Charges">Security & House Keeping Charges</option>
                              <option value="Advertisement & Marketing">Advertisement & Marketing</option>
                              <option value="Printing & Stationery">Printing & Stationery</option>
                              <option value="Travelling Exp.">Travelling Exp.</option>
                              <option value="Insurance">Insurance</option>
                              <option value="Vehicle Fuel & Lubricant">Vehicle Fuel & Lubricant</option>
                              <option value="Website Expenses">Website Expenses</option>
                              <option value="IT & Support">IT & Support</option>
                              <option value="Digital Marketing Exp.">Digital Marketing Exp.</option>
                              <option value="Business Promotion Exps.">Business Promotion Exps.</option>
                              <option value="Assets">Assets</option>
                          </select>
                      </div>
             
                    <!-- Budget Item -->
                      <!-- Vendor -->
                      <div class="form-group col-sm-4">
                          <label><strong>Name of Vendor</strong></label>
                          <input type="text" name="po_name_of_vendor" class="form-control" placeholder="Enter Vendor Name" required>
                      </div>
                       <div class="form-group col-sm-4">
                          <label><strong>Budget Item</strong></label>
                          <input type="text" name="po_budget_item" class="form-control" placeholder="Enter Budget Item" required>
                      </div>

                      <div class="form-group col-sm-12">
                            <label class="col-sm-3 control-label"><strong>Approved By</strong></label>
                            <div class="col-sm-9">
                                <div class="approval-checkboxes" style="display: flex; flex-direction: column; gap: 10px;">
                                    <label class="approval-item" for="appr-somendra" style="display: flex; align-items: center; padding: 10px 15px; background: #ffffff; border: 2px solid #e0e0e0; border-radius: 6px; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                        <input id="appr-somendra" type="checkbox" name="approved_by[]" style="opacity:1 !important;left:0px !important; margin-right: 12px; transform: scale(1.2);" value="ranjeetmaurya2033@gmail.com"> 
                                        <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">SOMENDRA SHUKLA</span>
                                    </label>
                                    <label class="approval-item" for="appr-richika" style="display: flex; align-items: center; padding: 10px 15px; background: #ffffff; border: 2px solid #e0e0e0; border-radius: 6px; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                        <input id="appr-richika" type="checkbox" name="approved_by[]" style="opacity:1 !important;left:0px !important; margin-right: 12px; transform: scale(1.2);" value="ranjeet.kumar@indiaivf.in"> 
                                        <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">RICHIKA SAHAY</span>
                                    </label>
                                    <label class="approval-item" for="appr-alan" style="display: flex; align-items: center; padding: 10px 15px; background: #ffffff; border: 2px solid #e0e0e0; border-radius: 6px; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                        <input id="appr-alan" type="checkbox" name="approved_by[]" style="opacity:1 !important;left:0px !important; margin-right: 12px; transform: scale(1.2);" value="ranjeetmaurya23358@gmail.com"> 
                                        <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">ALAN JAMES</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <br>
                      <!-- Remarks -->
                    <div class="form-group col-sm-12">
                          <label><strong>Remarks / Comment / Narration</strong></label>
                          <textarea name="po_remarks_or_comment_or_narration" class="form-control" rows="2"  placeholder="Enter remarks..." required></textarea>
                      </div>
                    <div class="form-group col-sm-4">
                        <label><strong>Basic Amount (Ex GST)</strong></label>
                        <input type="number" step="0.01" name="po_basic_amount" id="po_basic_amount" class="form-control" placeholder="0.00" required>
                    </div>

                    <div class="form-group col-sm-4">
                        <label><strong>GST Amount</strong></label>
                        <input type="number" step="0.01" name="po_gst_amount" id="po_gst_amount" class="form-control" placeholder="0.00" required>
                    </div>

                    <div class="form-group col-sm-4">
                        <label><strong>Other Charges & Taxes</strong></label>
                        <input type="number" step="0.01" name="po_other_charges_and_taxes" id="po_other_charges_and_taxes" class="form-control" placeholder="0.00" required>
                    </div>

                    <div class="form-group col-sm-4">
                        <label><strong>PO Total (Inc GST & All Charges)</strong></label>
                        <input type="number" step="0.01" name="po_po_total" id="po_po_total" class="form-control" placeholder="0.00" readonly>
                    </div>

                      <!-- Supporting Documents -->
                      <div class="form-group col-sm-4">
                          <label><strong>Supporting Documents</strong></label>
                          <input type="file" name="po_supporting_documents" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.webp,.gif,.bmp" onchange="return validateFileExtension(this)" >
                          <p class="help-block">Supporting Documents Upload. Supported formats: PDF, JPG, PNG, WEBP, GIF, BMP. Max 10 MB.</p>
                      </div>
                      <!-- Others -->
                      <!-- <div class="form-group col-sm-4">
                          <label><strong>If Others (Specify)</strong></label>
                          <input type="text" name="po_others_name" class="form-control" placeholder="Specify if Others">
                      </div> -->


                  </div>
              </div>
          </div>

          <!-- Buttons -->
          <div class="col-sm-12 col-xs-12 text-center mt-3">
              <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-default">Reset</button>
              </div>
          </div>
      </div>
  </form>
</div>
<script>
function validateFileExtension(input) {
    const file = input.files[0];
    if (!file) {
        return true;
    }
    
    // Check file size (10MB = 10 * 1024 * 1024 bytes)
    const maxSize = 10 * 1024 * 1024;
    if (file.size > maxSize) {
        alert('File size exceeds 10MB limit. Please select a smaller file.');
        input.value = '';
        return false;
    }
    
    // Check file extension
    const allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp'];
    const fileName = file.name.toLowerCase();
    const fileExtension = fileName.split('.').pop();
    
    if (!allowedExtensions.includes(fileExtension)) {
        alert('Invalid file type. Please select a file with one of these extensions: ' + allowedExtensions.join(', '));
        input.value = '';
        return false;
    }
    
    return true;
}

function calculateTotal() {
    let basic = parseFloat(document.getElementById("po_basic_amount").value) || 0;
    let gst = parseFloat(document.getElementById("po_gst_amount").value) || 0;
    let other = parseFloat(document.getElementById("po_other_charges_and_taxes").value) || 0;

    let total = basic + gst + other;
    document.getElementById("po_po_total").value = total.toFixed(2);
}

// Add event listeners for calculation
document.getElementById("po_basic_amount").addEventListener("input", calculateTotal);
document.getElementById("po_gst_amount").addEventListener("input", calculateTotal);
document.getElementById("po_other_charges_and_taxes").addEventListener("input", calculateTotal);
</script>