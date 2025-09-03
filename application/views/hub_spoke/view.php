<div class="col-md-12">
    <div class="card">
        <div class="card-action clearfix">
            <h3 class="pull-left">View Hub-Spoke Relationship</h3>
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>hub_spoke/edit/<?php echo $relationship['id']; ?>" class="btn btn-warning">
                    <i class="material-icons">edit</i> Edit Relationship
                </a>
                <a href="<?php echo base_url(); ?>hub_spoke" class="btn btn-secondary">
                    <i class="material-icons">arrow_back</i> Back to List
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="card-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="material-icons">business</i> Hub Center</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Center Name:</strong> <?php echo htmlspecialchars($relationship['hub_center_name']); ?></p>
                            <p><strong>Center ID:</strong> <?php echo htmlspecialchars($relationship['hub_center_number']); ?></p>
                            <p><strong>Classification:</strong> <span class="badge badge-success">Hub</span></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="material-icons">location_on</i> Spoke Center</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Center Name:</strong> <?php echo htmlspecialchars($relationship['spoke_center_name']); ?></p>
                            <p><strong>Center ID:</strong> <?php echo htmlspecialchars($relationship['spoke_center_number']); ?></p>
                            <p><strong>Classification:</strong> <span class="badge badge-info">Spoke</span></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="material-icons">info</i> Relationship Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Relationship Name:</strong></p>
                                    <?php if(!empty($relationship['relationship_name'])): ?>
                                        <p class="text-primary"><?php echo htmlspecialchars($relationship['relationship_name']); ?></p>
                                    <?php else: ?>
                                        <p class="text-muted">No name specified</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Status:</strong></p>
                                    <span class="badge badge-success">Active</span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Created Date:</strong></p>
                                    <p><?php echo date('d M Y, h:i A', strtotime($relationship['created_date'])); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Last Updated:</strong></p>
                                    <p><?php echo date('d M Y, h:i A', strtotime($relationship['updated_date'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="material-icons">receipt</i> Billing Impact</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h6><i class="material-icons">info</i> How This Relationship Affects Billing</h6>
                                <p><strong>When billing from <?php echo htmlspecialchars($relationship['spoke_center_name']); ?>:</strong></p>
                                <ul>
                                    <li><strong>From:</strong> <?php echo htmlspecialchars($relationship['spoke_center_name']); ?></li>
                                    <li><strong>At:</strong> <?php echo htmlspecialchars($relationship['hub_center_name']); ?></li>
                                </ul>
                                <p><strong>When billing from <?php echo htmlspecialchars($relationship['hub_center_name']); ?>:</strong></p>
                                <ul>
                                    <li><strong>From:</strong> <?php echo htmlspecialchars($relationship['hub_center_name']); ?></li>
                                    <li><strong>At:</strong> <?php echo htmlspecialchars($relationship['hub_center_name']); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="material-icons">settings</i> Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="btn-group">
                                <a href="<?php echo base_url(); ?>centers/edit_hub_spoke/<?php echo $relationship['id']; ?>" class="btn btn-warning">
                                    <i class="material-icons">edit</i> Edit Relationship
                                </a>    
                                <a href="<?php echo base_url(); ?>centers/delete_hub_spoke/<?php echo $relationship['id']; ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Are you sure you want to delete this relationship? This action cannot be undone.')">
                                    <i class="material-icons">delete</i> Delete Relationship
                                </a>
                                    <a href="<?php echo base_url(); ?>centers/hub_spoke" class="btn btn-secondary">
                                    <i class="material-icons">list</i> View All Relationships
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge {
    padding: 5px 10px;
    font-size: 12px;
}
.badge-success {
    background-color: #28a745;
    color: white;
}
.badge-info {
    background-color: #17a2b8;
    color: white;
}
.card {
    margin-bottom: 20px;
}
.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 15px;
}
.card-header h5 {
    margin: 0;
    color: #495057;
}
.card-body {
    padding: 20px;
}
.alert-info {
    border-left: 4px solid #17a2b8;
}
.btn-group .btn {
    margin-right: 10px;
}
.btn-group .btn:last-child {
    margin-right: 0;
}
</style>
