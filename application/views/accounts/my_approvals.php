<style>
.approval-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.approval-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.approval-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    text-align: center;
}

.approval-card-header h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 300;
}

.approval-card-body {
    padding: 25px;
}

.po-details-table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
}

.po-details-table td {
    padding: 12px;
    border: 1px solid #e9ecef;
    vertical-align: top;
}

.po-details-table tr:nth-child(even) {
    background-color: #f8f9fa;
}

.po-details-table tr:first-child {
    background-color: #e9ecef;
    font-weight: bold;
}

.po-details-table .label {
    font-weight: 600;
    color: #495057;
    width: 40%;
}

.po-details-table .value {
    color: #333;
}

.total-amount {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    margin: 20px 0;
}

.total-amount .amount {
    font-size: 32px;
    font-weight: bold;
    margin: 10px 0;
}

.approval-actions {
    text-align: center;
    padding: 20px;
    background-color: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.approval-actions .btn {
    margin: 0 10px;
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.approval-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.btn-approve {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    color: white;
}

.btn-approve:hover {
    background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
    color: white;
}

.btn-reject {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    color: white;
}

.btn-reject:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    color: white;
}

.no-approvals {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.no-approvals i {
    font-size: 64px;
    color: #dee2e6;
    margin-bottom: 20px;
}

.no-approvals h3 {
    color: #495057;
    margin-bottom: 10px;
}

.approval-status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-urgent {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px 0;
    margin-bottom: 30px;
    text-align: center;
}

.page-header h1 {
    margin: 0;
    font-size: 32px;
    font-weight: 300;
}

.page-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 16px;
}

.back-link {
    margin-bottom: 20px;
}

.back-link a {
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
}

.back-link a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .approval-actions .btn {
        display: block;
        width: 100%;
        margin: 10px 0;
    }
    
    .po-details-table .label {
        width: 100%;
        display: block;
        margin-bottom: 5px;
    }
    
    .po-details-table .value {
        width: 100%;
        display: block;
        margin-bottom: 15px;
    }
}
</style>

<div class="col-md-12">
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-check"></i> My Approvals</h1>
        <p>Purchase Orders requiring your approval</p>
    </div>

    <!-- Back Link -->
    <div class="back-link">
        <a href="<?php echo base_url('dashboard'); ?>">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="col-sm-12 col-xs-12" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; padding: 15px; margin-bottom: 20px;">
            <h4 style="margin: 0; color: #155724;"><?php echo $this->session->flashdata('success'); ?></h4>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="col-sm-12 col-xs-12" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; padding: 15px; margin-bottom: 20px;">
            <h4 style="margin: 0; color: #721c24;"><?php echo $this->session->flashdata('error'); ?></h4>
        </div>
    <?php endif; ?>

    <?php if(!empty($pending_approvals)): ?>
        <?php foreach($pending_approvals as $po): ?>
            <div class="approval-card">
                <div class="approval-card-header">
                    <h3>Purchase Order #<?php echo $po['po_number']; ?></h3>
                    <span class="approval-status-badge status-pending">Pending Your Approval</span>
                </div>
                
                <div class="approval-card-body">
                    <table class="po-details-table">
                        <tr>
                            <td class="label">Centre/Cluster/Region:</td>
                            <td class="value"><?php echo $po['po_centre']; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Department:</td>
                            <td class="value"><?php echo $po['po_department']; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Nature of Expenditure:</td>
                            <td class="value"><?php echo $po['po_nature_of_expenditure']; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Budget Head:</td>
                            <td class="value"><?php echo $po['po_budget_head']; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Budget Item:</td>
                            <td class="value"><?php echo $po['po_budget_item']; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Vendor:</td>
                            <td class="value"><?php echo $po['po_name_of_vendor']; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Remarks/Comment:</td>
                            <td class="value"><?php echo $po['po_remarks_or_comment_or_narration']; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Basic Amount (Ex GST):</td>
                            <td class="value">&#8377;<?php echo number_format($po['po_basic_amount'], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="label">GST Amount:</td>
                            <td class="value">&#8377;<?php echo number_format($po['po_gst_amount'], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Other Charges & Taxes:</td>
                            <td class="value">&#8377;<?php echo number_format($po['po_other_charges_and_taxes'], 2); ?></td>
                        </tr>
                        <?php if (!empty($po['po_supporting_documents'])): ?>
                        <tr>
                            <td class="label">Supporting Documents:</td>
                            <td class="value">
                                <a href="<?php echo base_url('assets/purchase_orders/' . $po['po_supporting_documents']); ?>" target="_blank" class="btn btn-info btn-sm">
                                    <i class="glyphicon glyphicon-download"></i> View Document
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    
                    <div class="total-amount">
                        <div style="font-size: 14px; opacity: 0.9;">Total Amount</div>
                        <div class="amount">&#8377;<?php echo number_format($po['po_po_total'], 2); ?></div>
                        <div style="font-size: 14px; opacity: 0.9;">Including GST & All Charges</div>
                    </div>
                </div>
                
                <div class="approval-actions">
                    <a href="<?php echo base_url('accounts/dashboard_approve_po/' . $po['po_number'] . '/approve'); ?>" 
                       class="btn btn-approve" 
                       onclick="return confirm('Are you sure you want to APPROVE this Purchase Order?')">
                        <i class="glyphicon glyphicon-ok"></i> Approve Purchase Order
                    </a>
                    <a href="<?php echo base_url('accounts/dashboard_approve_po/' . $po['po_number'] . '/reject'); ?>" 
                       class="btn btn-reject" 
                       onclick="return confirm('Are you sure you want to REJECT this Purchase Order?')">
                        <i class="glyphicon glyphicon-remove"></i> Reject Purchase Order
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-approvals">
            <i class="glyphicon glyphicon-ok-circle"></i>
            <h3>No Pending Approvals</h3>
            <p>You have no purchase orders pending your approval at this time.</p>
            <a href="<?php echo base_url('accounts/purchase_order_list'); ?>" class="btn btn-primary">
                <i class="glyphicon glyphicon-list"></i> View All Purchase Orders
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
// Add confirmation dialogs for approval actions
document.addEventListener('DOMContentLoaded', function() {
    const approveButtons = document.querySelectorAll('.btn-approve');
    const rejectButtons = document.querySelectorAll('.btn-reject');
    
    approveButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to APPROVE this Purchase Order?\n\nThis action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
    
    rejectButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to REJECT this Purchase Order?\n\nThis action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
});
</script>
