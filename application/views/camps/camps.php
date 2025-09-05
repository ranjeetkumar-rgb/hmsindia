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
                                <td><?php echo isset($row['camp_number']) ? htmlspecialchars($row['camp_number']) : '-'; ?></td>
                                <td><?php echo isset($row['camp_name']) ? htmlspecialchars($row['camp_name']) : '-'; ?></td>
                                <td><?php echo isset($row['center_name']) ? htmlspecialchars($row['center_name']) : '-'; ?></td>
                                <td><?php echo isset($row['description']) && !empty($row['description']) ? htmlspecialchars($row['description']) : '-'; ?></td>
                                <td><?php echo isset($row['start_date']) && !empty($row['start_date']) ? date('d-m-Y', strtotime($row['start_date'])) : '-'; ?></td>
                                <td><?php echo isset($row['end_date']) && !empty($row['end_date']) ? date('d-m-Y', strtotime($row['end_date'])) : '-'; ?></td>
                                <td>
                                    <?php if(isset($row['status']) && $row['status'] == '1'): ?>
                                        <span class="label label-success">Active</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($row['camp_number'])): ?>
                                        <a href="<?php echo base_url();?>camps/edit?camp_number=<?php echo urlencode($row['camp_number']); ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <?php if(isset($row['status']) && $row['status'] == '1'): ?>
                                            <a href="<?php echo base_url();?>camps/toggle_status?camp_number=<?php echo urlencode($row['camp_number']); ?>&status=0" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to deactivate this camp?')">
                                                <i class="fa fa-pause"></i> Deactivate
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo base_url();?>camps/toggle_status?camp_number=<?php echo urlencode($row['camp_number']); ?>&status=1" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to activate this camp?')">
                                                <i class="fa fa-play"></i> Activate
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo base_url();?>camps/delete?camp_number=<?php echo urlencode($row['camp_number']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this camp?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">No actions available</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No camps found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Check if DataTable is available
    if (typeof $.fn.DataTable !== 'undefined') {
        var table = $('#dataTables-example').DataTable({
            responsive: true,
            "pageLength": 25,
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                { "orderable": false, "targets": [8] } // Disable sorting on Action column
            ],
            "language": {
                "emptyTable": "No camps data available",
                "zeroRecords": "No matching camps found"
            }
        });
        
        // Status filter
        $('#status_filter').on('change', function() {
            var status = $(this).val();
            if(status === '') {
                table.column(7).search('').draw(); // Status is column 7 (0-indexed)
            } else {
                var searchText = status === '1' ? 'Active' : 'Inactive';
                table.column(7).search(searchText).draw();
            }
        });
        
        // Center filter
        $('#center_filter').on('change', function() {
            var center = $(this).val();
            table.column(3).search(center).draw(); // Center is column 3 (0-indexed)
        });
        
        // Add row highlighting for inactive camps after table is drawn
        table.on('draw', function() {
            $('#dataTables-example tbody tr').each(function() {
                var statusCell = $(this).find('td:eq(7)'); // Status is column 7 (0-indexed)
                if(statusCell.text().trim() === 'Inactive') {
                    $(this).addClass('warning');
                } else {
                    $(this).removeClass('warning');
                }
            });
        });
        
        // Initial highlighting
        $('#dataTables-example tbody tr').each(function() {
            var statusCell = $(this).find('td:eq(7)');
            if(statusCell.text().trim() === 'Inactive') {
                $(this).addClass('warning');
            }
        });
    } else {
        console.error('DataTables library not loaded properly');
        // Fallback: basic table styling
        $('#dataTables-example').addClass('table table-striped table-bordered');
    }
});
</script>
