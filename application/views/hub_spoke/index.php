<div class="col-md-12">
    <div class="card">
        <div class="card-action clearfix">
            <h3 class="pull-left">Hub-Spoke Center Relationships</h3>
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>centers/add_hub_spoke" class="btn btn-primary">
                    <i class="material-icons">add</i> Add New Relationship
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <div class="card-content">
            <?php if(empty($relationships)): ?>
                <div class="text-center" style="padding: 40px;">
                    <h4>No Hub-Spoke Relationships Found</h4>
                    <p>Start by adding your first hub-spoke relationship.</p>
                    <a href="<?php echo base_url(); ?>centers/add_hub_spoke" class="btn btn-primary">Add First Relationship</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Hub Center</th>
                                <th>Spoke Center</th>
                                <th>Relationship Name</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($relationships as $rel): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo htmlspecialchars($rel['hub_center_name']); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo htmlspecialchars($rel['hub_center_number']); ?></small>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($rel['spoke_center_name']); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo htmlspecialchars($rel['spoke_center_number']); ?></small>
                                    </td>
                                    <td>
                                        <?php if(!empty($rel['relationship_name'])): ?>
                                            <?php echo htmlspecialchars($rel['relationship_name']); ?>
                                        <?php else: ?>
                                            <span class="text-muted">No name specified</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo date('d M Y', strtotime($rel['created_date'])); ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url(); ?>centers/view_hub_spoke/<?php echo $rel['id']; ?>" 
                                               class="btn btn-sm btn-info" title="View">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="<?php echo base_url(); ?>centers/edit_hub_spoke/<?php echo $rel['id']; ?>" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="<?php echo base_url(); ?>centers/delete_hub_spoke/<?php echo $rel['id']; ?>" 
                                               class="btn btn-sm btn-danger" title="Delete"
                                               onclick="return confirm('Are you sure you want to delete this relationship?')">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>System Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Total Relationships:</strong> <?php echo count($relationships); ?></p>
                                <!-- <p><strong>Business Logic:</strong></p>
                                <ul>
                                    <li><strong>Hub Centers:</strong> Display same name for both "From" and "At" in billing</li>
                                    <li><strong>Spoke Centers:</strong> Display spoke name for "From" and hub name for "At" in billing</li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <a href="<?php echo base_url(); ?>centers" class="btn btn-secondary btn-block">
                                    <i class="material-icons">business</i> Manage Centers
                                </a>
                                <!-- <a href="<?php echo base_url(); ?>billings" class="btn btn-secondary btn-block">
                                    <i class="material-icons">receipt</i> View Billings
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
.btn-group .btn {
    margin-right: 2px;
}
.btn-group .btn:last-child {
    margin-right: 0;
}
.alert {
    margin: 15px;
}
</style>

