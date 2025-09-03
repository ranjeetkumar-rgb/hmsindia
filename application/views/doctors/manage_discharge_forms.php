<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="heading"><i class="fa fa-file-text"></i> Manage Discharge Forms</h3>
                    
                    <!-- Quick Access Links -->
                    <!-- <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="btn-group" role="group">
                                <a href="<?php echo base_url(); ?>doctors/list_embryo_record_discharge_summary" class="btn btn-info btn-sm">
                                    <i class="fa fa-embryo"></i> Manage Embryo Record Discharge Summary
                                </a>
                                <a href="<?php echo base_url(); ?>doctors/manage_discharge_forms" class="btn btn-primary btn-sm active">
                                    <i class="fa fa-cogs"></i> Manage Form Templates
                                </a>
                            </div>
                        </div>
                    </div>
                     -->
                    <?php if(isset($_GET['m']) && isset($_GET['t'])): ?>
                        <div class="alert alert-<?php echo base64_decode($_GET['t']); ?> alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo base64_decode($_GET['m']); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="panel-body">
                    <!-- Add New Form Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4><i class="fa fa-plus"></i> Add New Discharge Form</h4>
                                </div>
                                <div class="panel-body">
                                    <form method="post" action="">
                                        <input type="hidden" name="action" value="add_discharge_form" />
                                        <input type="hidden" name="role" value="<?php echo $logg['role']; ?>" />
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Display Name *</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Embryo Record Discharge Summary" required>
                                                    <small class="text-muted">Enter the user-friendly display name</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="form_name">Form Name *</label>
                                                    <input type="text" class="form-control" id="form_name" name="form_name" required>
                                                    <small class="text-muted">Auto-generated from display name</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="db_name">Database Table Name *</label>
                                                    <input type="text" class="form-control" id="db_name" name="db_name" required>
                                                    <small class="text-muted">Auto-generated from display name</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role">Role (Auto-set)</label>
                                                    <input type="text" class="form-control" id="role_display" value="<?php echo ucfirst($logg['role']); ?>" readonly>
                                                    <small class="text-muted">Role is automatically set based on your login</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status *</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="">Select Status</option>
                                                        <option value="active" selected>Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <!-- Table Columns Definition Section -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <h5><i class="fa fa-table"></i> Define Table Columns</h5>
                                                        <small class="text-muted">Add columns for your form data. Standard columns (id, iic_id, created_at, updated_at) will be added automatically.</small>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div id="columns-container">
                                                            <div class="column-row row" data-column-id="1">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Column Name *</label>
                                                                        <input type="text" class="form-control column-name" name="columns[1][name]" placeholder="e.g., patient_name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Data Type *</label>
                                                                        <select class="form-control column-type" name="columns[1][type]" required>
                                                                            <option value="">Select Type</option>
                                                                            <option value="VARCHAR(255)">Text (VARCHAR)</option>
                                                                            <option value="TEXT">Long Text (TEXT)</option>
                                                                            <option value="INT">Number (INT)</option>
                                                                            <option value="DECIMAL(10,2)">Decimal (DECIMAL)</option>
                                                                            <option value="DATE">Date (DATE)</option>
                                                                            <option value="DATETIME">Date & Time (DATETIME)</option>
                                                                            <option value="BOOLEAN">Yes/No (BOOLEAN)</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Required</label>
                                                                        <select class="form-control column-required" name="columns[1][required]">
                                                                            <option value="0">No</option>
                                                                            <option value="1">Yes</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>&nbsp;</label>
                                                                        <button type="button" class="btn btn-danger btn-sm remove-column" style="width: 100%;">
                                                                            <i class="fa fa-trash"></i> Remove
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="button" class="btn btn-success btn-sm" id="add-column">
                                                                    <i class="fa fa-plus"></i> Add Column
                                                                </button>
                                                                <small class="text-muted">Click to add more columns as needed</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Add Form
                                                </button>
                                                <button type="reset" class="btn btn-default">
                                                    <i class="fa fa-refresh"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <script>
                                        // Ensure role is always set correctly
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var roleInput = document.querySelector('input[name="role"]');
                                            var roleDisplay = document.getElementById('role_display');
                                            if (roleInput && roleDisplay) {
                                                roleInput.value = '<?php echo $logg['role']; ?>';
                                                roleDisplay.value = '<?php echo ucfirst($logg['role']); ?>';
                                            }
                                        });
                                        
                                        // Column management functionality
                                        $(document).ready(function() {
                                            var columnCounter = 1;
                                            
                                            // Add new column
                                            $('#add-column').on('click', function() {
                                                columnCounter++;
                                                var newColumn = `
                                                    <div class="column-row row" data-column-id="${columnCounter}">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Column Name *</label>
                                                                <input type="text" class="form-control column-name" name="columns[${columnCounter}][name]" placeholder="e.g., patient_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Data Type *</label>
                                                                <select class="form-control column-type" name="columns[${columnCounter}][type]" required>
                                                                    <option value="">Select Type</option>
                                                                    <option value="VARCHAR(255)">Text (VARCHAR)</option>
                                                                    <option value="TEXT">Long Text (TEXT)</option>
                                                                    <option value="INT">Number (INT)</option>
                                                                    <option value="DECIMAL(10,2)">Decimal (DECIMAL)</option>
                                                                    <option value="DATE">Date (DATE)</option>
                                                                    <option value="DATETIME">Date & Time (DATETIME)</option>
                                                                    <option value="BOOLEAN">Yes/No (BOOLEAN)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Required</label>
                                                                <select class="form-control column-required" name="columns[${columnCounter}][required]">
                                                                    <option value="0">No</option>
                                                                    <option value="1">Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>&nbsp;</label>
                                                                <button type="button" class="btn btn-danger btn-sm remove-column" style="width: 100%;">
                                                                    <i class="fa fa-trash"></i> Remove
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                $('#columns-container').append(newColumn);
                                            });
                                            
                                            // Remove column
                                            $(document).on('click', '.remove-column', function() {
                                                var columnRow = $(this).closest('.column-row');
                                                if ($('.column-row').length > 1) {
                                                    columnRow.remove();
                                                } else {
                                                    alert('At least one column is required!');
                                                }
                                            });
                                            
                                                                                         // Auto-generate form name and database table name from display name
                                             $('#name').on('input', function() {
                                                 var displayName = $(this).val();
                                                 var formName = displayName.toLowerCase().replace(/[^a-z0-9]/g, '_');
                                                 var dbName = formName;
                                                 
                                                 $('#form_name').val(formName);
                                                 $('#db_name').val(dbName);
                                             });
                                             
                                             // Auto-generate database table name from form name (fallback)
                                             $('#form_name').on('input', function() {
                                                 var formName = $(this).val();
                                                 var dbName = formName.toLowerCase().replace(/[^a-z0-9]/g, '_');
                                                 $('#db_name').val(dbName);
                                             });
                                            
                                            // Form validation
                                            $('form').on('submit', function(e) {
                                                var hasErrors = false;
                                                
                                                // Check if at least one column is defined
                                                if ($('.column-name').filter(function() { return $(this).val().trim() === ''; }).length > 0) {
                                                    alert('Please fill in all column names!');
                                                    hasErrors = true;
                                                }
                                                
                                                // Check for duplicate column names
                                                var columnNames = [];
                                                $('.column-name').each(function() {
                                                    var name = $(this).val().trim().toLowerCase();
                                                    if (name !== '') {
                                                        if (columnNames.indexOf(name) !== -1) {
                                                            alert('Duplicate column name: ' + name);
                                                            hasErrors = true;
                                                            return false;
                                                        }
                                                        columnNames.push(name);
                                                    }
                                                });
                                                
                                                if (hasErrors) {
                                                    e.preventDefault();
                                                }
                                            });
                                        });
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Existing Forms Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="display: flex; align-items: center; justify-content: space-between;">
                                    <h4 style="margin: 0;"><i class="fa fa-list"></i> Existing Discharge Forms</h4>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-default status-filter active" data-status="all">
                                            <i class="fa fa-list"></i> All
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success status-filter" data-status="active">
                                            <i class="fa fa-check-circle"></i> Active
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger status-filter" data-status="inactive">
                                            <i class="fa fa-times-circle"></i> Inactive
                                        </button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php if(!empty($discharge_forms)): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr class="active">
                                                        <th width="5%">ID</th>
                                                        <th width="18%">Form Name</th>
                                                        <th width="18%">Display Name</th>
                                                        <th width="15%">Database Table</th>
                                                        <th width="8%">Role</th>
                                                        <th width="10%">Status</th>
                                                        <th width="8%">Created By</th>
                                                        <th width="8%">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($discharge_forms as $form): ?>
                                                        <tr data-status="<?php echo isset($form['status']) ? $form['status'] : 'active'; ?>">
                                                            <td class="text-center"><strong><?php echo $form['id']; ?></strong></td>
                                                            <td><strong><?php echo htmlspecialchars($form['form_name']); ?></strong></td>
                                                            <td><em><?php echo htmlspecialchars(isset($form['name']) ? $form['name'] : $form['form_name']); ?></em></td>
                                                            <td><code><?php echo htmlspecialchars($form['db_name']); ?></code></td>
                                                            <td class="text-center">
                                                                <span class="badge badge-<?php echo $form['role'] == 'doctor' ? 'primary' : ($form['role'] == 'nurse' ? 'success' : ($form['role'] == 'embryologist' ? 'warning' : 'secondary')); ?>">
                                                                    <?php echo ucfirst($form['role']); ?>
                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                <select class="form-control input-sm status-select" data-form-id="<?php echo $form['id']; ?>">
                                                                    <option value="active" <?php echo (isset($form['status']) && $form['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo (isset($form['status']) && $form['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-center"><?php echo htmlspecialchars($form['created_by']); ?></td>
                                                            <td class="text-center">
                                                                <div class="btn-group-vertical" role="group">
                                                                    <a href="<?php echo base_url(); ?>doctors/edit_discharge_form/<?php echo $form['id']; ?>" class="btn btn-xs btn-info" title="Edit Form">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </a>
                                                                    <a href="<?php echo base_url(); ?>doctors/delete_discharge_form/<?php echo $form['id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('WARNING: This will permanently delete both the discharge form \'<?php echo htmlspecialchars($form['form_name']); ?>\' AND its associated database table \'<?php echo htmlspecialchars($form['db_name']); ?>\' along with all stored data. This action cannot be undone. Are you absolutely sure you want to proceed?')" title="Delete Form and Table">
                                                                        <i class="fa fa-trash"></i> Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle"></i> No discharge forms found. Add your first form above.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Column management styling */
    .column-row {
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    
    .column-row:hover {
        background-color: #f0f0f0;
        border-color: #ccc;
    }
    
    .panel-info .panel-heading {
        background-color: #d9edf7;
        border-color: #bce8f1;
        color: #31708f;
    }
    
    .panel-info .panel-heading h5 {
        margin: 0;
        font-weight: bold;
    }
    
    .panel-info .panel-heading small {
        color: #31708f;
        font-size: 12px;
    }
    
    #add-column {
        margin-top: 10px;
    }
    
    .remove-column {
        margin-top: 25px;
    }
    
    /* Column input styling */
    .column-name, .column-type, .column-required {
        font-size: 12px;
    }
    
    .column-row .form-group label {
        font-size: 11px;
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }
    
    /* Panel info styling */
    .panel-info {
        border-color: #bce8f1;
    }
    
    .panel-info .panel-body {
        background-color: #f9f9f9;
    }
    
    /* Table styling */
    .table {
        margin-bottom: 0;
    }
    
    .table th {
        background-color: #f5f5f5;
        border-bottom: 2px solid #ddd;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    /* Status select styling */
    .status-select {
        border-radius: 4px;
        font-size: 12px;
        padding: 4px 8px;
        height: 28px;
        min-width: 90px;
        border: 2px solid #ddd;
        transition: all 0.3s ease;
    }
    
    .status-select:focus {
        border-color: #66afe9;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6);
        outline: 0 none;
    }
    
    .status-select.status-active {
        background-color: #dff0d8;
        border-color: #5cb85c;
        color: #3c763d;
        font-weight: bold;
    }
    
    .status-select.status-inactive {
        background-color: #f2dede;
        border-color: #d9534f;
        color: #a94442;
        font-weight: bold;
    }
    
    .status-select:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    /* Badge styling */
    .badge {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 12px;
    }
    
    .badge-primary {
        background-color: #337ab7;
    }
    
    .badge-success {
        background-color: #5cb85c;
    }
    
    .badge-warning {
        background-color: #f0ad4e;
    }
    
    .badge-secondary {
        background-color: #777;
    }
    
    /* Button group styling */
    .btn-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .btn-group-vertical .btn {
        margin-bottom: 2px;
        border-radius: 3px;
    }
    
    /* Table hover effect */
    .table-hover tbody tr:hover {
        background-color: #f9f9f9;
    }
    
    /* Form name styling */
    .table td:nth-child(2) strong {
        color: #333;
        font-size: 13px;
    }
    
    /* Database table styling */
    .table td:nth-child(3) code {
        background-color: #f8f8f8;
        padding: 2px 4px;
        border-radius: 3px;
        font-size: 11px;
        color: #666;
    }
    
    /* Description column */
    .table td:nth-child(6) {
        max-width: 200px;
        word-wrap: break-word;
    }
    
    /* Status filter buttons */
    .status-filter {
        margin-left: 5px;
        border-radius: 20px;
        padding: 6px 12px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .status-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .status-filter.active {
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        transform: translateY(-1px);
    }
    
    .status-filter i {
        margin-right: 4px;
    }
    
    /* Panel heading improvements */
    .panel-heading h4 {
        margin: 0;
        color: #333;
        font-weight: bold;
    }
    
    .panel-heading .pull-right {
        margin-top: 5px;
    }
</style>

<script>
    $(document).ready(function() {
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
        
        // Form validation and auto-fill database name
        $('#form_name').on('input', function() {
            var formName = $(this).val();
            var dbName = formName.toLowerCase().replace(/[^a-z0-9]/g, '_');
            $('#db_name').val(dbName);
        });
        
        // Add some styling to the table
        $('.table-hover tbody tr').hover(
            function() {
                $(this).addClass('table-active');
            },
            function() {
                $(this).removeClass('table-active');
            }
        );
        
        // Handle status changes
        $('.status-select').on('change', function() {
            var formId = $(this).data('form-id');
            var newStatus = $(this).val();
            var $select = $(this);
            
            // Show loading state
            $select.prop('disabled', true);
            
            // Make AJAX call to update status
            $.ajax({
                url: '<?php echo base_url(); ?>doctors/update_discharge_form_status',
                type: 'POST',
                data: {
                    form_id: formId,
                    status: newStatus
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        showAlert('Status updated successfully!', 'success');
                        
                        // Update the select element styling based on status
                        updateStatusStyling($select, newStatus);
                    } else {
                        // Show error message
                        showAlert('Error updating status: ' + (response.message || 'Unknown error'), 'danger');
                        // Revert to previous value
                        $select.val($select.data('previous-value'));
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error Details:');
                    console.log('Status:', xhr.status);
                    console.log('Status Text:', xhr.statusText);
                    console.log('Response Text:', xhr.responseText);
                    console.log('Response Headers:', xhr.getAllResponseHeaders());
                    console.log('Error:', error);
                    
                    // Try to parse error response
                    var errorMessage = 'Network error occurred';
                    try {
                        if (xhr.responseText) {
                            // Check if response starts with JSON
                            var trimmedResponse = xhr.responseText.trim();
                            if (trimmedResponse.startsWith('{') || trimmedResponse.startsWith('[')) {
                                var errorResponse = JSON.parse(trimmedResponse);
                                if (errorResponse.message) {
                                    errorMessage = errorResponse.message;
                                }
                            } else {
                                errorMessage = 'Invalid response format: ' + trimmedResponse.substring(0, 100);
                            }
                        }
                    } catch (e) {
                        console.log('JSON Parse Error:', e);
                        // If can't parse JSON, use status text
                        if (xhr.status === 404) {
                            errorMessage = 'Controller method not found. Please create update_discharge_form_status method.';
                        } else if (xhr.status === 500) {
                            errorMessage = 'Server error occurred. Check server logs.';
                        } else if (xhr.status === 200) {
                            errorMessage = 'Response received but could not be parsed. Check server output.';
                        } else {
                            errorMessage = 'Error: ' + xhr.status + ' - ' + xhr.statusText;
                        }
                    }
                    
                    showAlert('Error updating status: ' + errorMessage, 'danger');
                    // Revert to previous value
                    $select.val($select.data('previous-value'));
                },
                complete: function() {
                    $select.prop('disabled', false);
                }
            });
        });
        
        // Store previous value when focus
        $('.status-select').on('focus', function() {
            $(this).data('previous-value', $(this).val());
        });
        
        // Function to update status styling
        function updateStatusStyling($select, status) {
            $select.removeClass('status-active status-inactive');
            $select.addClass('status-' + status);
        }
        
        // Function to show alerts
        function showAlert(message, type) {
            var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible">' +
                           '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                           message +
                           '</div>';
            
            $('.panel-heading').append(alertHtml);
            
            // Auto-hide after 3 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 3000);
        }
        
        // Initialize status styling
        $('.status-select').each(function() {
            updateStatusStyling($(this), $(this).val());
        });
        
        // Status filtering functionality
        $('.status-filter').on('click', function() {
            var status = $(this).data('status');
            
            // Update active button state
            $('.status-filter').removeClass('active');
            $(this).addClass('active');
            
            // Filter table rows
            if (status === 'all') {
                $('tbody tr').show();
            } else {
                $('tbody tr').hide();
                $('tbody tr[data-status="' + status + '"]').show();
            }
        });
        
        // Update row data-status attribute when status changes
        $('.status-select').on('change', function() {
            var newStatus = $(this).val();
            var $row = $(this).closest('tr');
            $row.attr('data-status', newStatus);
        });
        
        // Auto-populate name field when form_name is entered
        $('#form_name').on('input', function() {
            var formName = $(this).val();
            $('#name').val(formName);
        });
        
        // Auto-populate name field when form_name is pasted
        $('#form_name').on('paste', function() {
            setTimeout(function() {
                var formName = $('#form_name').val();
                $('#name').val(formName);
            }, 100);
        });
    });
</script>