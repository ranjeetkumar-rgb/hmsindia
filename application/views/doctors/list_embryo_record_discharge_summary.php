<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embryo Record Discharge Summary List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }
        .action-buttons {
            white-space: nowrap;
        }
        .search-box {
            margin-bottom: 20px;
        }
        .stats-cards {
            margin-bottom: 30px;
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .stat-card h3 {
            margin: 0;
            font-size: 2rem;
        }
        .stat-card p {
            margin: 5px 0 0 0;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-embryo"></i> Embryo Record Discharge Summary Management</h2>
                    <a href="<?php echo base_url(); ?>doctors/manage_discharge_forms" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Discharge Forms
                    </a>
                </div>

                <!-- Statistics Cards -->
                <div class="row stats-cards">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <h3><?php echo $embryo_records ? count($embryo_records) : 0; ?></h3>
                            <p>Total Records</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <h3><?php echo date('M Y'); ?></h3>
                            <p>Current Month</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <h3><?php echo isset($embryo_records[0]['center']) ? $embryo_records[0]['center'] : 'N/A'; ?></h3>
                            <p>Latest Center</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <h3><?php echo date('d'); ?></h3>
                            <p>Today's Date</p>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="row search-box">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search by patient name, IIC ID, or center...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="searchRecords()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-success" onclick="exportToExcel()">
                            <i class="fas fa-file-excel"></i> Export to Excel
                        </button>
                        <button class="btn btn-info" onclick="printList()">
                            <i class="fas fa-print"></i> Print List
                        </button>
                    </div>
                </div>

                <!-- Records Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="embryoRecordsTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>IIC ID</th>
                                <th>Patient Name</th>
                                <th>Center</th>
                                <th>Admission Date</th>
                                <th>Discharge Date</th>
                                <th>Fertilization Status</th>
                                <th>Senior Embryologist</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($embryo_records)): ?>
                                <?php foreach($embryo_records as $record): ?>
                                    <tr>
                                        <td><?php echo $record['id'] ?? 'N/A'; ?></td>
                                        <td>
                                            <strong><?php echo $record['iic_id'] ?? 'N/A'; ?></strong>
                                        </td>
                                        <td>
                                            <?php if(!empty($record['wife_name'])): ?>
                                                <strong>Female:</strong> <?php echo $record['wife_name']; ?><br>
                                                <strong>Male:</strong> <?php echo $record['husband_name'] ?? 'N/A'; ?>
                                            <?php else: ?>
                                                <span class="text-muted">Patient data not available</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                <?php echo $record['center'] ?? 'N/A'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php echo !empty($record['date_of_addmission']) ? date('d-m-Y', strtotime($record['date_of_addmission'])) : 'N/A'; ?>
                                        </td>
                                        <td>
                                            <?php echo !empty($record['date_of_discharge']) ? date('d-m-Y', strtotime($record['date_of_discharge'])) : 'N/A'; ?>
                                        </td>
                                        <td>
                                            <?php echo !empty($record['fertilization_status']) ? $record['fertilization_status'] : 'N/A'; ?>
                                        </td>
                                        <td>
                                            <?php echo !empty($record['senior_embryologist']) ? $record['senior_embryologist'] : 'N/A'; ?>
                                        </td>
                                        <td>
                                            <?php echo !empty($record['created_at']) ? date('d-m-Y H:i', strtotime($record['created_at'])) : 'N/A'; ?>
                                        </td>
                                        <td class="action-buttons">
                                            <a href="<?php echo base_url(); ?>doctors/get_embryo_record_discharge_summary/<?php echo $record['iic_id']; ?>/<?php echo $record['appoitmented_date'] ?? ''; ?>" 
                                               class="btn btn-sm btn-primary" title="View/Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo base_url(); ?>doctors/get_embryo_record_discharge_summary/<?php echo $record['iic_id']; ?>/<?php echo $record['appoitmented_date'] ?? ''; ?>" 
                                               class="btn btn-sm btn-info" title="Print">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" title="Delete" 
                                                    onclick="deleteRecord('<?php echo $record['iic_id']; ?>', '<?php echo $record['appoitmented_date'] ?? ''; ?>')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p>No embryo record discharge summaries found.</p>
                                        <p>Start by creating your first record.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Search functionality
        function searchRecords() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const table = document.getElementById('embryoRecordsTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const text = row.textContent.toLowerCase();
                
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
        
        // Export to Excel
        function exportToExcel() {
            const table = document.getElementById('embryoRecordsTable');
            const html = table.outerHTML;
            const url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
            const downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            downloadLink.href = url;
            downloadLink.download = 'embryo_record_discharge_summary.xls';
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
        
        // Print list
        function printList() {
            window.print();
        }
        
        // Delete record
        function deleteRecord(iicId, appointmentDate) {
            if (confirm('Are you sure you want to delete this embryo record discharge summary? This action cannot be undone.')) {
                // You can implement AJAX delete here or redirect to a delete method
                window.location.href = '<?php echo base_url(); ?>doctors/delete_embryo_record_discharge_summary/' + iicId + '/' + appointmentDate;
            }
        }
        
        // Auto-search on input
        document.getElementById('searchInput').addEventListener('keyup', function() {
            searchRecords();
        });
        
        // Initialize tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
