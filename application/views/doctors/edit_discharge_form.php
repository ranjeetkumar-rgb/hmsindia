<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="heading"><i class="fa fa-file-text"></i> Manage Discharge Forms</h3>
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
                                    <h4><i class="fa fa-edit"></i> Edit Discharge Form</h4>
                                </div>
                                <div class="panel-body">
                                    <form method="post" action="<?php echo base_url(); ?>doctors/edit_discharge_form/<?php echo $form_data['id']; ?>">
                                        <input type="hidden" name="action" value="update_discharge_form" />
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Display Name *</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars(isset($form_data['name']) ? $form_data['name'] : $form_data['form_name']); ?>" placeholder="e.g., Embryo Record Discharge Summary" required>
                                                    <small class="text-muted">Enter the user-friendly display name</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="form_name">Form Name *</label>
                                                    <input type="text" class="form-control" id="form_name" name="form_name" value="<?php echo htmlspecialchars($form_data['form_name']); ?>" required>
                                                    <small class="text-muted">Auto-generated from display name</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="db_name">Database Table Name *</label>
                                                    <input type="text" class="form-control" id="db_name" name="db_name" value="<?php echo htmlspecialchars($form_data['db_name']); ?>" required>
                                                    <small class="text-muted">Auto-generated from display name</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role">Role (Read-only)</label>
                                                    <input type="text" class="form-control" id="role_display" value="<?php echo ucfirst($form_data['role']); ?>" readonly>
                                                    <small class="text-muted">Role cannot be changed after creation</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status *</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="">Select Status</option>
                                                        <option value="active" <?php echo $form_data['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                                        <option value="inactive" <?php echo $form_data['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Update Form
                                                </button>
                                                <button type="reset" class="btn btn-default">
                                                    <i class="fa fa-refresh"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
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
    
    // Auto-populate name field when form_name is pasted
    $('#name').on('paste', function() {
        setTimeout(function() {
            var displayName = $('#name').val();
            var formName = displayName.toLowerCase().replace(/[^a-z0-9]/g, '_');
            var dbName = formName;
            
            $('#form_name').val(formName);
            $('#db_name').val(dbName);
        }, 100);
    });
});
</script>
