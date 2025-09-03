<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Advanced Tables -->
<div class="card">
    <div class="card-action clearfix">
        <h3 class="pull-left">Camps List</h3>
        <a href="<?php echo base_url();?>camps/add" class="btn btn-primary pull-right">Add Camp</a>
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
        <!-- Summary Statistics -->
        <!-- <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <strong>Summary:</strong> 
                    Total Camps: <span class="badge"><?php echo count($data); ?></span> | 
                    Active Camps: <span class="badge badge-success"><?php echo count(array_filter($data, function($row) { return $row['status'] == '1'; })); ?></span> | 
                    Inactive Camps: <span class="badge badge-danger"><?php echo count(array_filter($data, function($row) { return $row['status'] == '0'; })); ?></span>
                </div>
            </div>
        </div>
         -->
        <!-- Status Filter -->
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-3">
                <label for="status_filter">Filter by Status:</label>
                <select class="form-control" id="status_filter">
                    <option value="">All Camps</option>
                    <option value="1">Active Only</option>
                    <option value="0">Inactive Only</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="center_filter">Filter by Center:</label>
                <select class="form-control" id="center_filter">
                    <option value="">All Centers</option>
                    <?php 
                    $centers = array();
                    if(!empty($data)) {
                        foreach($data as $row) {
                            if(!in_array($row['center_name'], $centers)) {
                                $centers[] = $row['center_name'];
                            }
                        }
                        sort($centers);
                        foreach($centers as $center) {
                            echo '<option value="'.$center.'">'.$center.'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Camp Number</th>
                        <th>Camp Name</th>
                        <th>Center</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data)): ?>
                        <?php $i = 1; foreach($data as $row): ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['camp_number']; ?></td>
                                <td><?php echo $row['camp_name']; ?></td>
                                <td><?php echo $row['center_name']; ?></td>
                                <td><?php echo $row['description'] ? $row['description'] : '-'; ?></td>
                                <td><?php echo $row['start_date'] ? date('d-m-Y', strtotime($row['start_date'])) : '-'; ?></td>
                                <td><?php echo $row['end_date'] ? date('d-m-Y', strtotime($row['end_date'])) : '-'; ?></td>
                                <td>
                                    <?php if($row['status'] == '1'): ?>
                                        <span class="label label-success">Active</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url();?>camps/edit?camp_number=<?php echo $row['camp_number']; ?>" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <?php if($row['status'] == '1'): ?>
                                        <a href="<?php echo base_url();?>camps/toggle_status?camp_number=<?php echo $row['camp_number']; ?>&status=0" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to deactivate this camp?')">
                                            <i class="fa fa-pause"></i> Deactivate
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url();?>camps/toggle_status?camp_number=<?php echo $row['camp_number']; ?>&status=1" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to activate this camp?')">
                                            <i class="fa fa-play"></i> Activate
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo base_url();?>camps/delete?camp_number=<?php echo $row['camp_number']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this camp?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No camps found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#dataTables-example').DataTable({
        responsive: true
    });
    
    // Status filter
    $('#status_filter').on('change', function() {
        var status = $(this).val();
        if(status === '') {
            table.column(6).search('').draw();
        } else {
            var searchText = status === '1' ? 'Active' : 'Inactive';
            table.column(6).search(searchText).draw();
        }
    });
    
    // Center filter
    $('#center_filter').on('change', function() {
        var center = $(this).val();
        table.column(2).search(center).draw();
    });
    
    // Add row highlighting for inactive camps
    $('#dataTables-example tbody tr').each(function() {
        var statusCell = $(this).find('td:eq(6)');
        if(statusCell.text().trim() === 'Inactive') {
            $(this).addClass('warning');
        }
    });
});
</script>
