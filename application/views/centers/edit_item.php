  <form class="col-sm-12 col-xs-12" method="post" action=""  enctype='multipart/form-data'>
    <input type="hidden" name="action" value="update_item" />
    <input type="hidden" name="center_number" value="<?php echo $data['center_number']; ?>" />
    
    <!-- Error Messages Display -->
    <?php if(isset($_GET['m']) && isset($_GET['t'])): ?>
      <?php if($_GET['t'] == 'error'): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i class="fa fa-exclamation-triangle"></i> <strong>Error!</strong> <?php echo htmlspecialchars(base64_decode($_GET['m'])); ?>
        </div>
      <?php elseif($_GET['t'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i class="fa fa-check-circle"></i> <strong>Success!</strong> <?php echo htmlspecialchars(base64_decode($_GET['m'])); ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-edit"></i> Edit Center</h3>
      </div>

      <div class="panel-body">
        <!-- Basic Information Section -->
        <div class="row">
          <div class="col-sm-12">
            <h4 class="section-header"><i class="fa fa-info-circle"></i> Basic Information</h4>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="center_name" class="control-label">
              <i class="fa fa-building"></i> Center Name <span class="text-danger">*</span>
            </label>
            <input value="<?php echo htmlspecialchars($data['center_name']); ?>" placeholder="Center name" id="center_name" name="center_name" type="text" class="form-control input-lg" required>
          </div>
          
          <div class="form-group col-sm-6 col-xs-12">
            <label for="center_code" class="control-label">
              <i class="fa fa-code"></i> Center Code
            </label>
            <input value="<?php echo isset($data['center_code']) ? htmlspecialchars($data['center_code']) : ''; ?>" placeholder="Center code" id="center_code" name="center_code" type="text" class="form-control input-lg">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="type" class="control-label">
              <i class="fa fa-tag"></i> Center Type <span class="text-danger">*</span>
            </label>
            <select name="type" id="type" class="form-control input-lg" required>
              <option value="">Select Type</option>
              <option value="stand-alone" <?php if($data['type'] == "stand-alone"){echo "selected='selected'"; } ?>>Stand Alone</option>
              <option value="associated" <?php if($data['type'] == "associated"){echo "selected='selected'"; } ?>>Associated</option>
            </select>
          </div>
          
          <div class="form-group col-sm-6 col-xs-12">
            <label class="control-label">
              <i class="fa fa-sitemap"></i> Center Classification <span class="text-danger">*</span>
            </label><br>
            <div class="checkbox-group">
              <label class="checkbox-inline">
                <input type="radio" name="center_classification" value="hub" required <?php echo (isset($data['center_classification']) && $data['center_classification'] == 'hub') ? 'checked' : ''; ?>>
                <i class="fa fa-hub"></i> Hub 
              </label>
              <label class="checkbox-inline">
                <input type="radio" name="center_classification" value="spoke" required <?php echo (isset($data['center_classification']) && $data['center_classification'] == 'spoke') ? 'checked' : ''; ?>>
                <i class="fa fa-share-alt"></i> Spoke 
              </label>
            </div>
            <small class="help-block text-muted">
              <i class="fa fa-info-circle"></i> 
              Hub centers are main centers that coordinate with multiple spoke centers. 
              Spoke centers are satellite centers connected to hub centers.
            </small>
          </div>
        </div>

        <!-- Legal & Registration Section -->
        <div class="row">
          <div class="col-sm-12">
            <h4 class="section-header"><i class="fa fa-certificate"></i> Legal & Registration Details</h4>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="center_gst" class="control-label">
              <i class="fa fa-file-text"></i> Center GST Number
            </label>
            <input value="<?php echo htmlspecialchars($data['center_gst']); ?>" placeholder="GST No" id="center_gst" name="center_gst" type="text" class="form-control">
          </div>
          
          <div class="form-group col-sm-6 col-xs-12">
            <label class="control-label">
              <i class="fa fa-toggle-on"></i> GST Status
            </label><br>
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-success btn-sm <?php echo ($data['gst'] == '1') ? 'active' : ''; ?>">
                <input type="radio" name="gst" value="1" <?php if($data['gst'] == '1'){echo "checked='checked'";} ?>> Active
              </label>
              <label class="btn btn-danger btn-sm <?php echo ($data['gst'] == '0') ? 'active' : ''; ?>">
                <input type="radio" name="gst" value="0" <?php if($data['gst'] == '0'){echo "checked='checked'";} ?>> Inactive
              </label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="dl_number" class="control-label">
              <i class="fa fa-id-card"></i> Drug License Number
            </label>
            <input value="<?php echo htmlspecialchars($data['dl_number']); ?>" placeholder="DL Number" id="dl_number" name="dl_number" type="text" class="form-control">
          </div>
          
          <div class="form-group col-sm-6 col-xs-12">
            <label for="fssai_license_no" class="control-label">
              <i class="fa fa-id-badge"></i> FSSAI License Number
            </label>
            <input value="<?php echo htmlspecialchars($data['fssai_license_no']); ?>" placeholder="FSSAI License No" id="fssai_license_no" name="fssai_license_no" type="text" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="cin" class="control-label">
              <i class="fa fa-building-o"></i> Corporate Identity Number (CIN)
            </label>
            <input value="<?php echo htmlspecialchars($data['cin']); ?>" placeholder="CIN" id="cin" name="cin" type="text" class="form-control">
          </div>
          
          <div class="form-group col-sm-6 col-xs-12">
            <label for="pharmacist_name" class="control-label">
              <i class="fa fa-user-md"></i> Pharmacist Name
            </label>
            <input value="<?php echo htmlspecialchars($data['pharmacist_name']); ?>" placeholder="Pharmacist Name" id="pharmacist_name" name="pharmacist_name" type="text" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="pharmacist_registration" class="control-label">
              <i class="fa fa-user-md"></i> Pharmacist Registration Number
            </label>
            <input value="<?php echo htmlspecialchars($data['pharmacist_registration']); ?>" placeholder="Pharmacist Registration" id="pharmacist_registration" name="pharmacist_registration" type="text" class="form-control">
          </div>
        </div>

        <!-- Additional Details Section -->
        <div class="row">
          <div class="col-sm-12">
            <h4 class="section-header"><i class="fa fa-plus-circle"></i> Additional Details</h4>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label for="logo" class="control-label">
              <i class="fa fa-image"></i> Center Logo
            </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-upload"></i></span>
              <input type="file" name="upload_photo_1" id="logo" accept="image/*">
            </div>
            <?php if(!empty($data['upload_photo_1'])){ ?>
              <div class="current-logo">
                <label>Current Logo:</label><br>
                <img src="<?php echo $data['upload_photo_1'];?>" style="max-width:200px; height:auto; border:1px solid #ddd; padding:5px; margin-top:10px;">
              </div>
            <?php } ?>
            <small class="help-block text-muted">Allowed formats: JPG, PNG, GIF. Max size: 2MB</small>
          </div>

          <div class="form-group col-sm-6 col-xs-12">
            <label for="center_address" class="control-label">
              <i class="fa fa-map-marker"></i> Center Address <span class="text-danger">*</span>
            </label>
            <textarea placeholder="Center address" id="center_address" name="center_address" class="form-control" rows="3" required><?php echo isset($data['center_address']) ? htmlspecialchars($data['center_address']) : htmlspecialchars($data['center_location']); ?></textarea>
          </div>
        </div>

        <!-- Status Section -->
        <div class="row">
          <div class="col-sm-12">
            <h4 class="section-header"><i class="fa fa-toggle-on"></i> Center Status</h4>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <label class="control-label">
              <i class="fa fa-power-off"></i> Center Status <span class="text-danger">*</span>
            </label><br>
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-success btn-sm <?php echo ($data['status'] == '1') ? 'active' : ''; ?>">
                <input type="radio" name="status" value="1" <?php if($data['status'] == '1'){echo "checked='checked'";} ?>> Active
              </label>
              <label class="btn btn-danger btn-sm <?php echo ($data['status'] == '0') ? 'active' : ''; ?>">
                <input type="radio" name="status" value="0" <?php if($data['status'] == '0'){echo "checked='checked'";} ?>> Inactive
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="panel-footer text-center">
        <button type="submit" id="submitbutton" class="btn btn-primary btn-lg">
          <i class="fa fa-save"></i> Update Center
        </button>
        <a href="<?php echo base_url('centers/centers'); ?>" class="btn btn-default btn-lg">
          <i class="fa fa-arrow-left"></i> Back to Centers
        </a>
      </div>
    </div>
  </form>

<style>
.panel-primary {
  border: none;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  border-radius: 8px;
  margin-top: 20px;
}

.panel-primary > .panel-heading {
  background: linear-gradient(135deg, #337ab7 0%, #286090 100%);
  border: none;
  border-radius: 8px 8px 0 0;
  padding: 20px;
}

.panel-primary > .panel-heading .panel-title {
  font-size: 24px;
  font-weight: 300;
  color: white;
}

.panel-primary > .panel-heading .panel-title i {
  margin-right: 10px;
  color: #fff;
}

.panel-body {
  padding: 30px;
  background: #fafafa;
}

.section-header {
  color: #337ab7;
  border-bottom: 2px solid #337ab7;
  padding-bottom: 10px;
  margin-bottom: 20px;
  font-weight: 600;
}

.section-header i {
  margin-right: 8px;
  color: #337ab7;
}

.form-group {
  margin-bottom: 25px;
}

.control-label {
  font-weight: 600;
  color: #555;
  margin-bottom: 8px;
  font-size: 14px;
}

.control-label i {
  margin-right: 8px;
  color: #337ab7;
}

.form-control {
  border: 2px solid #ddd;
  border-radius: 6px;
  padding: 12px 15px;
  font-size: 14px;
  transition: all 0.3s ease;
  box-shadow: none;
}

.form-control:focus {
  border-color: #337ab7;
  box-shadow: 0 0 0 3px rgba(51, 122, 183, 0.1);
  outline: none;
}

.input-lg {
  height: 50px;
}

.checkbox-group {
  margin-top: 10px;
}

.checkbox-inline {
  margin-right: 20px;
  font-weight: 500;
}

.checkbox-inline input[type="radio"] {
  margin-right: 8px;
}

.btn-group .btn {
  border-radius: 4px;
  margin-right: 5px;
}

.btn-group .btn.active {
  box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
}

.panel-footer {
  background: #f8f9fa;
  border-top: 1px solid #dee2e6;
  padding: 20px;
}

.btn {
  border-radius: 6px;
  font-weight: 500;
  padding: 12px 24px;
  transition: all 0.3s ease;
}

.btn-primary {
  background: linear-gradient(135deg, #337ab7 0%, #286090 100%);
  border: none;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #286090 0%, #1f4b7a 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(51, 122, 183, 0.4);
}

.btn-default {
  background: #f8f9fa;
  border: 2px solid #dee2e6;
  color: #6c757d;
}

.btn-default:hover {
  background: #e9ecef;
  border-color: #adb5bd;
  color: #495057;
}

.current-logo {
  margin-top: 15px;
  padding: 10px;
  background: #f8f9fa;
  border-radius: 4px;
  border: 1px solid #dee2e6;
}

.current-logo label {
  font-weight: 600;
  color: #495057;
  margin-bottom: 5px;
}

.help-block {
  margin-top: 5px;
  font-size: 12px;
}

.text-danger {
  color: #dc3545;
}

.text-muted {
  color: #6c757d;
}

.alert {
  border-radius: 6px;
  border: none;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  margin-bottom: 20px;
}

.alert-success {
  background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
  color: #155724;
}

.alert-danger {
  background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
  color: #721c24;
}

.alert .close {
  opacity: 0.7;
}

.alert .close:hover {
  opacity: 1;
}

.error-field {
  border-color: #dc3545 !important;
  box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
}

.error-field:focus {
  border-color: #dc3545 !important;
  box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
}
</style>

<script>
$(document).ready(function() {
    // Form validation
    $('form').on('submit', function(e) {
        var isValid = true;
        
        // Check required fields
        $('input[required], select[required], textarea[required]').each(function() {
            if (!$(this).val().trim()) {
                isValid = false;
                $(this).addClass('error-field');
            } else {
                $(this).removeClass('error-field');
            }
        });
        
        // Check radio button groups
        $('input[type="radio"][required]').each(function() {
            var name = $(this).attr('name');
            var checked = $('input[name="' + name + '"]:checked').length;
            if (checked === 0) {
                isValid = false;
                $('input[name="' + name + '"]').closest('.form-group').addClass('error-field');
            } else {
                $('input[name="' + name + '"]').closest('.form-group').removeClass('error-field');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        // Show loading state
        $('#submitbutton').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
    
    // Real-time validation
    $('input, select, textarea').on('blur', function() {
        if ($(this).prop('required') && !$(this).val().trim()) {
            $(this).addClass('error-field');
        } else {
            $(this).removeClass('error-field');
        }
    });
    
    $('input, select, textarea').on('input', function() {
        if ($(this).hasClass('error-field') && $(this).val().trim()) {
            $(this).removeClass('error-field');
        }
    });
});
</script>
