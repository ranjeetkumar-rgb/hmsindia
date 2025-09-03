<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="card">
    <div class="card-action clearfix">
        <h3 class="pull-left">Edit Camp</h3>
        <a href="<?php echo base_url();?>camps" class="btn btn-default pull-right">Back to Camps</a>
    </div>
    <div class="clearfix"></div>
    
    <?php if(isset($_GET['m']) && isset($_GET['t'])): ?>
        <div class="alert alert-<?php echo base64_decode($_GET['t']); ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo base64_decode($_GET['m']); ?>
        </div>
    <?php endif; ?>
    
    <div class="card-content">
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update_camp">
            <input type="hidden" name="camp_number" value="<?php echo $data['camp_number']; ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="camp_name">Camp Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="camp_name" name="camp_name" value="<?php echo $data['camp_name']; ?>" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="center_id">Center <span class="text-danger">*</span></label>
                        <select class="form-control" id="center_id" name="center_id" required>
                            <option value="">Select Center</option>
                            <?php if(!empty($centers)): ?>
                                <?php foreach($centers as $center): ?>
                                    <option value="<?php echo $center['ID']; ?>" <?php echo ($center['ID'] == $data['center_id']) ? 'selected' : ''; ?>>
                                        <?php echo $center['center_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $data['start_date'] ? date('Y-m-d', strtotime($data['start_date'])) : ''; ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $data['end_date'] ? date('Y-m-d', strtotime($data['end_date'])) : ''; ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter camp description..."><?php echo $data['description']; ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Camp location" value="<?php echo $data['location']; ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Maximum participants" value="<?php echo $data['capacity']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact person name" value="<?php echo $data['contact_person']; ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Contact phone number" value="<?php echo $data['contact_phone']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" <?php echo ($data['status'] == '1') ? 'selected' : ''; ?>>Active</option>
                            <option value="0" <?php echo ($data['status'] == '0') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Camp</button>
                        <a href="<?php echo base_url();?>camps" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Date validation
    $('#end_date').on('change', function() {
        var startDate = $('#start_date').val();
        var endDate = $(this).val();
        
        if(startDate && endDate && startDate > endDate) {
            alert('End date cannot be earlier than start date');
            $(this).val('');
        }
    });
    
    // Form validation
    $('form').on('submit', function() {
        var campName = $('#camp_name').val().trim();
        var centerId = $('#center_id').val();
        
        if(!campName) {
            alert('Please enter camp name');
            $('#camp_name').focus();
            return false;
        }
        
        if(!centerId) {
            alert('Please select a center');
            $('#center_id').focus();
            return false;
        }
        
        return true;
    });
});
</script>
