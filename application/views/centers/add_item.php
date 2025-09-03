<form class="col-sm-12 col-xs-12" method="post" action="<?php echo base_url('centers/add'); ?>" enctype='multipart/form-data' >
  <input type="hidden" name="action" value="add_item" />
  
  <!-- Error Messages Display -->
  <?php if(isset($message) && isset($message_type)): ?>
    <?php if($message_type == 'error'): ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-exclamation-triangle"></i> <strong>Error!</strong> <?php echo htmlspecialchars($message); ?>
      </div>
    <?php elseif($message_type == 'success'): ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-check-circle"></i> <strong>Success!</strong> <?php echo htmlspecialchars($message); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
  
  <!-- Legacy Error Messages Display (for backward compatibility) -->
  <?php if(isset($error_message) && !empty($error_message)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-exclamation-triangle"></i> <strong>Error!</strong> <?php echo $error_message; ?>
    </div>
  <?php endif; ?>
  
  <!-- Legacy Success Messages Display (for backward compatibility) -->
  <?php if(isset($success_message) && !empty($success_message)): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-check-circle"></i> <strong>Success!</strong> <?php echo $success_message; ?>
    </div>
  <?php endif; ?>
  
  <!-- Validation Errors Display -->
  <?php if(isset($validation_errors) && is_array($validation_errors) && count($validation_errors) > 0): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-exclamation-circle"></i> <strong>Please fix the following errors:</strong>
      <ul class="error-list">
        <?php foreach($validation_errors as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-hospital"></i> Add New Center</h3>
    </div>

    <div class="panel-body">
      <!-- Basic Information Section -->
      <div class="row">
        <div class="col-sm-12">
          <h4 class="section-header"><i class="fa fa-info-circle"></i> Basic Information</h4>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['center_name'])) ? 'has-error' : ''; ?>">
          <label for="center_name" class="control-label">
            <i class="fa fa-building"></i> Center Name <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control input-lg" id="center_name" name="center_name" 
                 placeholder="Enter center name" required 
                 value="<?php echo isset($form_data['center_name']) ? htmlspecialchars($form_data['center_name']) : ''; ?>">
          <?php if(isset($field_errors['center_name'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['center_name']; ?>
            </span>
          <?php endif; ?>
        </div>

        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['center_code'])) ? 'has-error' : ''; ?>">
          <label for="center_code" class="control-label">
            <i class="fa fa-code"></i> Center Code
          </label>
          <input type="text" class="form-control input-lg" id="center_code" name="center_code" 
                 placeholder="Enter center code"
                 value="<?php echo isset($form_data['center_code']) ? htmlspecialchars($form_data['center_code']) : ''; ?>">
          <?php if(isset($field_errors['center_code'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['center_code']; ?>
            </span>
          <?php endif; ?>
        </div>

        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['type'])) ? 'has-error' : ''; ?>">
          <label for="type" class="control-label">
            <i class="fa fa-tag"></i> Center Type <span class="text-danger">*</span>
          </label>
          <select class="form-control input-lg" name="type" id="type" required>
            <option value="">Select Type</option>
            <option value="stand-alone" <?php echo (isset($form_data['type']) && $form_data['type'] == 'stand-alone') ? 'selected' : ''; ?>>Stand Alone</option>
            <option value="associated" <?php echo (isset($form_data['type']) && $form_data['type'] == 'associated') ? 'selected' : ''; ?>>Associated</option>
          </select>
          <?php if(isset($field_errors['type'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['type']; ?>
            </span>
          <?php endif; ?>
        </div>
        
        <div class="form-group col-sm-6 col-xs-12">
          <label class="control-label">
            <i class="fa fa-sitemap"></i> Center Classification
          </label><br>
          <div class="checkbox-group">
            <label class="checkbox-inline">
              <input type="radio" name="is_hub" value="1"  <?php echo (isset($form_data['is_hub']) && $form_data['is_hub'] == '1') ? 'checked' : ''; ?>>
              <i class="fa fa-hub"></i> Hub 
            </label>
            <label class="checkbox-inline">
            <input type="radio" name="is_hub" value="0"  <?php echo (isset($form_data['is_spoke']) && $form_data['is_spoke'] == '1') ? 'checked' : ''; ?>>
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
        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['center_gst'])) ? 'has-error' : ''; ?>">
          <label for="center_gst" class="control-label">
            <i class="fa fa-file-text"></i> Center GST Number
          </label>
          <input type="text" class="form-control" id="center_gst" name="center_gst" 
                 placeholder="Enter GST number"
                 value="<?php echo isset($form_data['center_gst']) ? htmlspecialchars($form_data['center_gst']) : ''; ?>">
          <?php if(isset($field_errors['center_gst'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['center_gst']; ?>
            </span>
          <?php endif; ?>
        </div>

        <div class="form-group col-sm-6 col-xs-12">
          <label class="control-label">
            <i class="fa fa-toggle-on"></i> GST Status
          </label><br>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-success btn-sm <?php echo (!isset($form_data['gst']) || $form_data['gst'] == '1') ? 'active' : ''; ?>">
              <input type="radio" name="gst" value="1" <?php echo (!isset($form_data['gst']) || $form_data['gst'] == '1') ? 'checked' : ''; ?>> Active
            </label>
            <label class="btn btn-danger btn-sm <?php echo (isset($form_data['gst']) && $form_data['gst'] == '0') ? 'active' : ''; ?>">
              <input type="radio" name="gst" value="0" <?php echo (isset($form_data['gst']) && $form_data['gst'] == '0') ? 'checked' : ''; ?>> Inactive
            </label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['dl_number'])) ? 'has-error' : ''; ?>">
          <label for="dl_number" class="control-label">
            <i class="fa fa-id-card"></i> Drug License Number
          </label>
          <input type="text" class="form-control" id="dl_number" name="dl_number" 
                 placeholder="Enter DL number"
                 value="<?php echo isset($form_data['dl_number']) ? htmlspecialchars($form_data['dl_number']) : ''; ?>">
          <?php if(isset($field_errors['dl_number'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['dl_number']; ?>
            </span>
          <?php endif; ?>
        </div>

        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['fssai_license_no'])) ? 'has-error' : ''; ?>">
          <label for="fssai_license_no" class="control-label">
            <i class="fa fa-id-badge"></i> FSSAI License Number
          </label>
          <input type="text" class="form-control" id="fssai_license_no" name="fssai_license_no" 
                 placeholder="Enter FSSAI license number"
                 value="<?php echo isset($form_data['fssai_license_no']) ? htmlspecialchars($form_data['fssai_license_no']) : ''; ?>">
          <?php if(isset($field_errors['fssai_license_no'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['fssai_license_no']; ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['cin'])) ? 'has-error' : ''; ?>">
          <label for="cin" class="control-label">
            <i class="fa fa-building-o"></i> Corporate Identity Number (CIN)
          </label>
          <input type="text" class="form-control" id="cin" name="cin" 
                 placeholder="Enter CIN"
                 value="<?php echo isset($form_data['cin']) ? htmlspecialchars($form_data['cin']) : ''; ?>">
          <?php if(isset($field_errors['cin'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['cin']; ?>
            </span>
          <?php endif; ?>
        </div>

        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['pharmacist_name'])) ? 'has-error' : ''; ?>">
          <label for="pharmacist_name" class="control-label">
            <i class="fa fa-user-md"></i> Pharmacist Name
          </label>
          <input type="text" class="form-control" id="pharmacist_name" name="pharmacist_name" 
                 placeholder="Enter pharmacist name"
                 value="<?php echo isset($form_data['pharmacist_name']) ? htmlspecialchars($form_data['pharmacist_name']) : ''; ?>">
          <?php if(isset($field_errors['pharmacist_name'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['pharmacist_name']; ?>
            </span>
          <?php endif; ?>
        </div>

        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['pharmacist_registration'])) ? 'has-error' : ''; ?>">
          <label for="pharmacist_registration" class="control-label">
            <i class="fa fa-user-md"></i> Pharmacist Registration Number
          </label>
          <input type="text" class="form-control" id="pharmacist_registration" name="pharmacist_registration" 
                 placeholder="Enter pharmacist registration number" 
                 value="<?php echo isset($form_data['pharmacist_registration']) ? htmlspecialchars($form_data['pharmacist_registration']) : (isset($data['pharmacist_registration']) ? htmlspecialchars($data['pharmacist_registration']) : ''); ?>">
          <?php if(isset($field_errors['pharmacist_registration'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['pharmacist_registration']; ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <!-- Additional Details Section -->
      <div class="row">
        <div class="col-sm-12">
          <h4 class="section-header"><i class="fa fa-plus-circle"></i> Additional Details</h4>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['upload_photo_1'])) ? 'has-error' : ''; ?>">
          <label for="logo" class="control-label">
            <i class="fa fa-image"></i> Center Logo
          </label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-upload"></i></span>
            <input type="file" class="form-control" name="upload_photo_1" id="logo" accept="image/*">
          </div>
          <?php if(isset($field_errors['upload_photo_1'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['upload_photo_1']; ?>
            </span>
          <?php endif; ?>
          <small class="help-block text-muted">Allowed formats: JPG, PNG, GIF. Max size: 2MB</small>
        </div>

        <div class="form-group col-sm-6 col-xs-12 <?php echo (isset($field_errors['center_address'])) ? 'has-error' : ''; ?>">
          <label for="center_address" class="control-label">
            <i class="fa fa-map-marker"></i> Center Address <span class="text-danger">*</span>
          </label>
          <textarea class="form-control" id="center_address" name="center_address" 
                    placeholder="Enter complete center address" rows="3" required><?php echo isset($form_data['center_address']) ? htmlspecialchars($form_data['center_address']) : ''; ?></textarea>
          <?php if(isset($field_errors['center_address'])): ?>
            <span class="help-block text-danger">
              <i class="fa fa-times-circle"></i> <?php echo $field_errors['center_address']; ?>
            </span>
          <?php endif; ?>
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
            <label class="btn btn-success btn-sm <?php echo (!isset($form_data['status']) || $form_data['status'] == '1') ? 'active' : ''; ?>">
              <input type="radio" name="status" value="1" <?php echo (!isset($form_data['status']) || $form_data['status'] == '1') ? 'checked' : ''; ?>> Active
            </label>
            <label class="btn btn-danger btn-sm <?php echo (isset($form_data['status']) && $form_data['status'] == '0') ? 'active' : ''; ?>">
              <input type="radio" name="status" value="0" <?php echo (isset($form_data['status']) && $form_data['status'] == '0') ? 'checked' : ''; ?>> Inactive
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="panel-footer text-center">
      <button type="submit" id="submitbutton" class="btn btn-primary btn-lg">
        <i class="fa fa-save"></i> Save Center
      </button>
      <button type="reset" class="btn btn-default btn-lg">
        <i class="fa fa-refresh"></i> Reset
      </button>
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
  font-size: 16px;
}

textarea.form-control {
  resize: vertical;
  min-height: 100px;
}

/* Error Styling */
.has-error .form-control {
  border-color: #d9534f;
  box-shadow: 0 0 0 3px rgba(217, 83, 79, 0.1);
}

.has-error .control-label {
  color: #d9534f;
}

.help-block {
  margin-top: 5px;
  font-size: 12px;
}

.help-block.text-danger {
  color: #d9534f;
  font-weight: 500;
}

.help-block.text-muted {
  color: #777;
  font-style: italic;
}

/* Alert Styling */
.alert {
  border: none;
  border-radius: 8px;
  margin-bottom: 20px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.alert-danger {
  background: linear-gradient(135deg, #f2dede 0%, #ebccd1 100%);
  color: #a94442;
  border-left: 4px solid #d9534f;
}

.alert-success {
  background: linear-gradient(135deg, #dff0d8 0%, #d6e9c6 100%);
  color: #3c763d;
  border-left: 4px solid #5cb85c;
}

.alert-warning {
  background: linear-gradient(135deg, #fcf8e3 0%, #faf2cc 100%);
  color: #8a6d3b;
  border-left: 4px solid #f0ad4e;
}

.alert .close {
  color: inherit;
  opacity: 0.7;
}

.alert .close:hover {
  opacity: 1;
}

.error-list {
  margin: 10px 0 0 20px;
  padding: 0;
}

.error-list li {
  margin-bottom: 5px;
}

.btn-group .btn {
  border-radius: 4px;
  margin-right: 5px;
  padding: 8px 16px;
  font-weight: 500;
}

.btn-group .btn.active {
  background-color: #5cb85c;
  border-color: #4cae4c;
}

.btn-group .btn:not(.active) {
  background-color: #fff;
  color: #333;
  border-color: #ccc;
}

.btn-group .btn:not(.active):hover {
  background-color: #f5f5f5;
}

.panel-footer {
  background: #f8f9fa;
  border-top: 1px solid #ddd;
  padding: 20px;
  border-radius: 0 0 8px 8px;
}

.btn-lg {
  padding: 12px 30px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 6px;
  margin: 0 10px;
}

.btn-primary {
  background: linear-gradient(135deg, #337ab7 0%, #286090 100%);
  border: none;
  box-shadow: 0 4px 15px rgba(51, 122, 183, 0.3);
}

.btn-primary:hover {
  background: linear-gradient(135deg, #286090 0%, #1f4e79 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(51, 122, 183, 0.4);
}

.btn-default {
  background: #fff;
  border: 2px solid #ddd;
  color: #555;
}

.btn-default:hover {
  background: #f5f5f5;
  border-color: #337ab7;
  color: #337ab7;
}

.input-group-addon {
  background: #f8f9fa;
  border: 2px solid #ddd;
  border-right: none;
  color: #337ab7;
}

.input-group .form-control {
  border-left: none;
}

.input-group .form-control:focus + .input-group-addon {
  border-color: #337ab7;
}

.text-danger {
  color: #d9534f !important;
  font-weight: bold;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .panel-body {
    padding: 20px;
  }
  
  .btn-group .btn {
    display: block;
    width: 100%;
    margin-bottom: 5px;
    margin-right: 0;
  }
  
  .btn-lg {
    margin: 5px 0;
    width: 100%;
  }
}

/* Animation for form elements */
.form-control, .btn {
  transition: all 0.3s ease;
}

/* Hover effects */
.form-group:hover .control-label {
  color: #337ab7;
}

.section-header:hover {
  color: #286090;
}

/* Loading state for submit button */
.btn-loading {
  position: relative;
  color: transparent !important;
}

.btn-loading:after {
  content: '';
  position: absolute;
  width: 16px;
  height: 16px;
  top: 50%;
  left: 50%;
  margin-left: -8px;
  margin-top: -8px;
  border: 2px solid #ffffff;
  border-radius: 50%;
  border-top-color: transparent;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}
</style>

<script>
$(document).ready(function() {
    // Debug: Log when form is ready
    console.log('Center form ready');
    
    // Form validation and error handling
    $('form').on('submit', function(e) {
        console.log('Form submission started');
        
        var isValid = true;
        var firstErrorField = null;
        
        // Clear previous error states
        $('.form-group').removeClass('has-error');
        $('.help-block').remove();
        
        // Check required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val().trim()) {
                var fieldName = $(this).attr('name');
                var fieldLabel = $('label[for="' + $(this).attr('id') + '"]').text().replace('*', '').trim();
                
                console.log('Required field missing:', fieldName, fieldLabel);
                
                $(this).closest('.form-group').addClass('has-error');
                $(this).after('<span class="help-block text-danger"><i class="fa fa-times-circle"></i> ' + fieldLabel + ' is required</span>');
                
                if (!firstErrorField) {
                    firstErrorField = $(this);
                }
                isValid = false;
            }
        });
        
        // File validation
        var fileInput = $('input[type="file"]');
        if (fileInput.length && fileInput[0].files.length > 0) {
            var file = fileInput[0].files[0];
            var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            var maxSize = 2 * 1024 * 1024; // 2MB
            
            console.log('File validation:', file.name, file.type, file.size);
            
            if (!allowedTypes.includes(file.type)) {
                fileInput.closest('.form-group').addClass('has-error');
                fileInput.after('<span class="help-block text-danger"><i class="fa fa-times-circle"></i> Only JPG, PNG, and GIF files are allowed</span>');
                isValid = false;
            }
            
            if (file.size > maxSize) {
                fileInput.closest('.form-group').addClass('has-error');
                fileInput.after('<span class="help-block text-danger"><i class="fa fa-times-circle"></i> File size must be less than 2MB</span>');
                isValid = false;
            }
        }
        
        if (!isValid) {
            e.preventDefault();
            console.log('Form validation failed');
            
            // Scroll to first error
            if (firstErrorField) {
                $('html, body').animate({
                    scrollTop: firstErrorField.offset().top - 100
                }, 500);
            }
            
            // Show error alert
            showAlert('Please fix the errors below before submitting.', 'danger');
            return false;
        }
        
        console.log('Form validation passed, submitting...');
        
        // Show loading state
        $('#submitbutton').addClass('btn-loading').prop('disabled', true);
        
        // Log form data being submitted
        var formData = new FormData(this);
        console.log('Form data to be submitted:');
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
    });
    
    // Real-time validation
    $('input, select, textarea').on('blur', function() {
        validateField($(this));
    });
    
    $('input, select, textarea').on('input', function() {
        if ($(this).closest('.form-group').hasClass('has-error')) {
            validateField($(this));
        }
    });
    
    function validateField(field) {
        var fieldGroup = field.closest('.form-group');
        var fieldName = field.attr('name');
        var fieldValue = field.val().trim();
        var isRequired = field.prop('required');
        
        // Remove existing error
        fieldGroup.removeClass('has-error');
        fieldGroup.find('.help-block').remove();
        
        // Check if required field is empty
        if (isRequired && !fieldValue) {
            var fieldLabel = $('label[for="' + field.attr('id') + '"]').text().replace('*', '').trim();
            fieldGroup.addClass('has-error');
            field.after('<span class="help-block text-danger"><i class="fa fa-times-circle"></i> ' + fieldLabel + ' is required</span>');
            return false;
        }
        
        // Additional validation rules
        if (fieldName === 'center_gst' && fieldValue) {
            if (fieldValue.length < 15) {
                fieldGroup.addClass('has-error');
                field.after('<span class="help-block text-danger"><i class="fa fa-times-circle"></i> GST number must be at least 15 characters</span>');
                return false;
            }
        }
        
        if (fieldName === 'dl_number' && fieldValue) {
            if (fieldValue.length < 10) {
                fieldGroup.addClass('has-error');
                field.after('<span class="help-block text-danger"><i class="fa fa-times-circle"></i> DL number must be at least 10 characters</span>');
                return false;
            }
        }
        
        return true;
    }
    
    // Show alert function
    function showAlert(message, type) {
        var alertClass = 'alert-' + type;
        var iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
        
        var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button>' +
            '<i class="fa ' + iconClass + '"></i> ' + message + '</div>';
        
        $('form').before(alertHtml);
        
        // Auto-dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
    
    // Reset form validation on reset
    $('button[type="reset"]').on('click', function() {
        setTimeout(function() {
            $('.form-group').removeClass('has-error');
            $('.help-block').remove();
        }, 100);
    });
    
    // Debug: Log form elements
    console.log('Form elements found:', $('form').length);
    console.log('Required fields:', $('form [required]').length);
    console.log('File input:', $('input[type="file"]').length);
});
</script>
