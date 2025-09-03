<div class="col-md-12">
    <div class="card">
        <div class="card-action clearfix">
            <h3 class="pull-left">Add New Hub-Spoke Relationship</h3>
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>centers/hub_spoke" class="btn btn-secondary">
                    <i class="material-icons">arrow_back</i> Back to List
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="card-content">
            <form method="post" action="" id="addRelationshipForm">
                <input type="hidden" name="action" value="add_relationship">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hub_center_id">Hub Center <span class="text-danger">*</span></label>
                            <select name="hub_center_id" id="hub_center_id" class="form-control" required>
                                <option value="">Select Hub Center</option>
                                <?php foreach($available_hubs as $hub): ?>
                                    <option value="<?php echo htmlspecialchars($hub['center_number']); ?>">
                                        <?php echo htmlspecialchars($hub['center_name']); ?> 
                                        (<?php echo htmlspecialchars($hub['center_number']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted">Select the main center that will serve as the hub</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="spoke_center_id">Spoke Center <span class="text-danger">*</span></label>
                            <select name="spoke_center_id" id="spoke_center_id" class="form-control" required>
                                <option value="">Select Spoke Center</option>
                                <?php foreach($available_spokes as $spoke): ?>
                                    <option value="<?php echo htmlspecialchars($spoke['center_number']); ?>">
                                        <?php echo htmlspecialchars($spoke['center_name']); ?> 
                                        (<?php echo htmlspecialchars($spoke['center_number']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted">Select the center that will be associated with the hub</small>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="relationship_name">Relationship Name (Optional)</label>
                            <input type="text" name="relationship_name" id="relationship_name" class="form-control" 
                                   placeholder="e.g., Delhi Hub - Rohini Spoke">
                            <small class="form-text text-muted">A descriptive name for this relationship</small>
                        </div>
                    </div>
                </div>
<!--                 
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <h5><i class="material-icons">info</i> How This Works</h5>
                            <p><strong>Business Logic:</strong></p>
                            <ul>
                                <li><strong>Hub Centers:</strong> In billing, both "From" and "At" will show the same center name</li>
                                <li><strong>Spoke Centers:</strong> In billing, "From" will show the spoke center name and "At" will show the hub center name</li>
                            </ul>
                            <p><strong>Example:</strong> If Delhi is hub and Rohini is spoke, billing will show: From = Rohini, At = Delhi</p>
                        </div>
                    </div>
                </div>
                 -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons">save</i> Create Relationship
                            </button>
                            <a href="<?php echo base_url(); ?>centers/hub_spoke" class="btn btn-secondary">
                                <i class="material-icons">cancel</i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Form validation
    $('#addRelationshipForm').on('submit', function(e) {
        var hubCenter = $('#hub_center_id').val();
        var spokeCenter = $('#spoke_center_id').val();
        
        if (!hubCenter || !spokeCenter) {
            e.preventDefault();
            alert('Please select both hub and spoke centers');
            return false;
        }
        
        if (hubCenter === spokeCenter) {
            e.preventDefault();
            alert('Hub and spoke centers cannot be the same');
            return false;
        }
        
        return true;
    });
    
    // Auto-generate relationship name
    $('#hub_center_id, #spoke_center_id').on('change', function() {
        var hubCenter = $('#hub_center_id option:selected').text();
        var spokeCenter = $('#spoke_center_id option:selected').text();
        
        if (hubCenter && spokeCenter && hubCenter !== 'Select Hub Center' && spokeCenter !== 'Select Spoke Center') {
            var hubName = hubCenter.split('(')[0].trim();
            var spokeName = spokeCenter.split('(')[0].trim();
            $('#relationship_name').val(hubName + ' Hub - ' + spokeName + ' Spoke');
        }
    });
});
</script>

<style>
.alert-info {
    border-left: 4px solid #17a2b8;
}
.form-group {
    margin-bottom: 20px;
}
.text-danger {
    color: #dc3545;
}
</style>
