<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="card">
    <div class="card-action clearfix">
        <h3 class="pull-left">Add New Camp</h3>
        <a href="<?php echo base_url();?>camps" class="btn btn-default pull-right">Back to Camps</a>
    </div>
    <div class="clearfix"></div>
    
    <?php if(isset($message)): ?>
        <div class="alert alert-<?php echo $message_type; ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <div class="card-content">
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_camp">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="camp_name">Camp Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="camp_name" name="camp_name" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="center_id">Center <span class="text-danger">*</span></label>
                        <select class="form-control" id="center_id" name="center_id" required>
                            <option value="">Select Center</option>
                            <?php if(!empty($centers)): ?>
                                <?php foreach($centers as $center): ?>
                                    <option value="<?php echo $center['ID']; ?>"><?php echo $center['center_name']; ?></option>
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
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter camp description..."></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Camp location">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Maximum participants">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact person name">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Contact phone number">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Camp</button>
                        <button type="reset" class="btn btn-default">Reset</button>
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
