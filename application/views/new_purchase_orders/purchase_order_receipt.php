<?php $all_method =&get_instance(); ?>
<!-- Select2 CSS and JS -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css">
<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>

<style>
    .purchase-receipt-header {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
        padding: 20px;
        margin: -20px -20px 20px -20px;
        border-radius: 8px 8px 0 0;
    }

    .purchase-receipt-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }

    .currency-info {
        background: rgba(255,255,255,0.1);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 14px;
        margin-top: 10px;
    }

    .attached-files-btn {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        transition: all 0.3s ease;
    }

    .attached-files-btn:hover {
        background: rgba(255,255,255,0.3);
        color: white;
        text-decoration: none;
    }

    .form-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }

    .form-section h4 {
        color: #495057;
        margin-bottom: 20px;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 10px;
    }

    .receipt-table {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .receipt-table thead {
        background: linear-gradient(135deg, #E3F2FD, #BBDEFB);
        color: #1976D2;
    }

    .receipt-table th {
        font-weight: 600;
        text-align: center;
        padding: 15px 8px;
        border: none;
        font-size: 13px;
    }

    .receipt-table td {
        padding: 12px 8px;
        border: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .receipt-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .receipt-table tbody tr:hover {
        background-color: #e3f2fd;
    }

    .checkbox-cell {
        text-align: center;
        width: 50px;
    }

    .product-details-btn {
        background: #4CAF50;
        color: white;
        border: none;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 11px;
        margin-top: 5px;
        cursor: pointer;
    }

    .tax-details-btn {
        background: #9E9E9E;
        color: white;
        border: none;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 11px;
        margin-top: 5px;
        cursor: pointer;
    }

    .purchase-tax-label {
        color: #4CAF50;
        font-weight: 600;
        font-size: 16px;
    }

    .instruction-text {
        font-weight: bold;
        color: #495057;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .date-input-group {
        position: relative;
    }

    .date-input-group .fa-calendar {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }

    .form-control:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        border: none;
        padding: 10px 25px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1976D2, #1565C0);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
</style>

<div class="col-md-12">
   <div class="card" style="margin-bottom:20px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      
      <!-- Header Section -->
      <div class="purchase-receipt-header">
         <div class="row">
            <div class="col-md-8">
               <h3><i class="fa fa-file-text-o"></i> Purchase Order Receipt - Inventory</h3>
            </div>
            <div class="col-md-4 text-right">
               <div class="currency-info">
                  <i class="fa fa-rupee"></i> Base Currency : INR
               </div>
               <a href="#" class="attached-files-btn">
                  <i class="fa fa-paperclip"></i> Attached Files (0)
               </a>
            </div>
         </div>
      </div>
      
      <form method="post" action="<?php echo base_url('new_purchase_orders/save_receipt'); ?>" id="purchase_receipt_form">
         <div class="card-content" style="padding: 20px;">
            
            <!-- General Purchase Order Details Section -->
            <div class="form-section">
               <h4><i class="fa fa-info-circle"></i> General Purchase Order Details</h4>
               
               <div class="row">
                  <!-- Left Column -->
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="por_number">POR Number <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="por_number" name="por_number" 
                                 value="<?php echo $por_number; ?>" readonly>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="credit_term">Credit Term</label>
                              <input type="text" class="form-control" id="credit_term" name="credit_term">
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label for="reference">Reference</label>
                        <input type="text" class="form-control" id="reference" name="reference" value="INB234">
                     </div>
                     
                     <div class="form-group">
                        <label for="ship_to">Ship To <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="ship_to" name="ship_to" rows="3" 
                           placeholder="AcTouch Technologies, Peenya Industrial Area, rtyu, Bangalore,">AcTouch Technologies, Peenya Industrial Area, rtyu, Bangalore,</textarea>
                     </div>
                  </div>
                  
                  <!-- Right Column -->
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="supplier_name">Supplier Name <span class="text-danger">*</span></label>
                        <select class="form-control" id="supplier_name" name="supplier_name" required>
                           <option value="">-- Select Supplier --</option>
                           <option value="Cash Purchase" selected>Cash Purchase</option>
                           <?php if (!empty($vendors)): ?>
                              <?php foreach ($vendors as $vendor): ?>
                                 <option value="<?php echo $vendor['vendor_number']; ?>">
                                    <?php echo $vendor['name']; ?> (<?php echo $vendor['vendor_number']; ?>)
                                 </option>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </select>
                     </div>
                     
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="po_number">PO Number <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="po_number" name="po_number" value="PO760">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="reference_amount">Reference Amount</label>
                              <input type="number" class="form-control" id="reference_amount" name="reference_amount" value="0" step="0.01">
                           </div>
                        </div>
                     </div>
                     
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="por_date">POR Date <span class="text-danger">*</span></label>
                              <div class="date-input-group">
                                 <input type="text" class="form-control" id="por_date" name="por_date" value="2016-08-04">
                                 <i class="fa fa-calendar"></i>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="po_date">PO Date <span class="text-danger">*</span></label>
                              <div class="date-input-group">
                                 <input type="text" class="form-control" id="po_date" name="po_date" value="2016-07-25">
                                 <i class="fa fa-calendar"></i>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="reference_date">Reference Date</label>
                              <div class="date-input-group">
                                 <input type="text" class="form-control" id="reference_date" name="reference_date" value="2016-07-25">
                                 <i class="fa fa-calendar"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label>Purchase Tax</label>
                        <div>
                           <span class="purchase-tax-label">Yes</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Items/Products/Services Section -->
            <div class="form-section">
               <h4><i class="fa fa-list"></i> Items/Products/Services</h4>
               
               <div class="instruction-text">
                  <i class="fa fa-info-circle"></i> * Click the Check Box to Receive the Items/Products/Services
               </div>
               
               <div class="receipt-table">
                  <table class="table table-bordered" id="receipt_items_table">
                     <thead>
                        <tr>
                           <th class="checkbox-cell">#</th>
                           <th>Product</th>
                           <th>Description</th>
                           <th>UOM</th>
                           <th>Qty Remain</th>
                           <th>Rec.All?</th>
                           <th>Qty Receiving</th>
                           <th>Qty Rej</th>
                           <th>Discount (%)</th>
                           <th>Incl.Tax?</th>
                           <th>Tax Amt</th>
                           <th>Amount</th>
                        </tr>
                     </thead>
                     <tbody id="receipt_items_tbody">
                        <tr class="receipt-item-row" id="receipt_row_1">
                           <td class="checkbox-cell">
                              <input type="checkbox" name="receive_item_1" id="receive_item_1" checked>
                           </td>
                           <td>1</td>
                           <td>
                              <select class="form-control" name="product_1" id="product_1" onchange="populateProductDetails(1)">
                                 <option value="">-- Select Product --</option>
                                 <option value="001" selected>001</option>
                                 <?php if (!empty($consumables)): ?>
                                    <?php foreach ($consumables as $consumable): ?>
                                       <option value="<?php echo $consumable['item_number']; ?>">
                                          <?php echo $consumable['item_number']; ?>
                                       </option>
                                    <?php endforeach; ?>
                                 <?php endif; ?>
                              </select>
                           </td>
                           <td>
                              <input type="text" class="form-control" name="description_1" id="description_1" 
                                 value="Storage room area Epoxy Yellow coating with one coat of primer and 2 coat of paint etc Trasportation chrges." readonly>
                           </td>
                           <td>
                              <input type="text" class="form-control" name="uom_1" id="uom_1" value="GM" readonly>
                           </td>
                           <td>
                              <input type="number" class="form-control" name="qty_remain_1" id="qty_remain_1" value="2" readonly>
                           </td>
                           <td class="checkbox-cell">
                              <input type="checkbox" name="receive_all_1" id="receive_all_1">
                           </td>
                           <td>
                              <input type="number" class="form-control" name="qty_receiving_1" id="qty_receiving_1" 
                                 value="1.000" step="0.001" onchange="updateAmount(1)">
                              <button type="button" class="product-details-btn" onclick="showProductDetails(1)">
                                 Product Details
                              </button>
                           </td>
                           <td>
                              <input type="number" class="form-control" name="qty_rejected_1" id="qty_rejected_1" 
                                 value="0" step="0.001" onchange="updateAmount(1)">
                           </td>
                           <td>
                              <input type="number" class="form-control" name="discount_1" id="discount_1" 
                                 value="0" step="0.01" onchange="updateAmount(1)">
                           </td>
                           <td class="checkbox-cell">
                              <input type="checkbox" name="include_tax_1" id="include_tax_1" onchange="updateAmount(1)">
                           </td>
                           <td>
                              <input type="number" class="form-control" name="tax_amount_1" id="tax_amount_1" 
                                 value="0" step="0.01" readonly>
                              <button type="button" class="tax-details-btn" onclick="showTaxDetails(1)">
                                 Tax Details
                              </button>
                           </td>
                           <td>
                              <input type="number" class="form-control" name="amount_1" id="amount_1" 
                                 value="100.00" step="0.01" readonly>
                           </td>
                        </tr>
                        
                        <tr class="receipt-item-row" id="receipt_row_2">
                           <td class="checkbox-cell">
                              <input type="checkbox" name="receive_item_2" id="receive_item_2" checked>
                           </td>
                           <td>2</td>
                           <td>
                              <select class="form-control" name="product_2" id="product_2" onchange="populateProductDetails(2)">
                                 <option value="">-- Select Product --</option>
                                 <option value="1002 Gas" selected>1002 Gas</option>
                                 <?php if (!empty($consumables)): ?>
                                    <?php foreach ($consumables as $consumable): ?>
                                       <option value="<?php echo $consumable['item_number']; ?>">
                                          <?php echo $consumable['item_number']; ?>
                                       </option>
                                    <?php endforeach; ?>
                                 <?php endif; ?>
                              </select>
                           </td>
                           <td>
                              <input type="text" class="form-control" name="description_2" id="description_2" 
                                 value="HP Gas 25ltr" readonly>
                           </td>
                           <td>
                              <input type="text" class="form-control" name="uom_2" id="uom_2" value="LT" readonly>
                           </td>
                           <td>
                              <input type="number" class="form-control" name="qty_remain_2" id="qty_remain_2" value="50" readonly>
                           </td>
                           <td class="checkbox-cell">
                              <input type="checkbox" name="receive_all_2" id="receive_all_2">
                           </td>
                           <td>
                              <input type="number" class="form-control" name="qty_receiving_2" id="qty_receiving_2" 
                                 value="1.000" step="0.001" onchange="updateAmount(2)">
                              <button type="button" class="product-details-btn" onclick="showProductDetails(2)">
                                 Product Details
                              </button>
                           </td>
                           <td>
                              <input type="number" class="form-control" name="qty_rejected_2" id="qty_rejected_2" 
                                 value="0" step="0.001" onchange="updateAmount(2)">
                           </td>
                           <td>
                              <input type="number" class="form-control" name="discount_2" id="discount_2" 
                                 value="0" step="0.01" onchange="updateAmount(2)">
                           </td>
                           <td class="checkbox-cell">
                              <input type="checkbox" name="include_tax_2" id="include_tax_2" onchange="updateAmount(2)">
                           </td>
                           <td>
                              <input type="number" class="form-control" name="tax_amount_2" id="tax_amount_2" 
                                 value="0" step="0.01" readonly>
                              <button type="button" class="tax-details-btn" onclick="showTaxDetails(2)">
                                 Tax Details
                              </button>
                           </td>
                           <td>
                              <input type="number" class="form-control" name="amount_2" id="amount_2" 
                                 value="100.00" step="0.01" readonly>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               
               <div class="text-center" style="margin-top: 15px;">
                  <button type="button" class="btn btn-success" onclick="addNewReceiptRow()">
                     <i class="fa fa-plus"></i> Add New Row
                  </button>
               </div>
            </div>

            <!-- Submit Buttons -->
            <div class="row">
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-lg">
                     <i class="fa fa-save"></i> Save Purchase Order Receipt
                  </button>
                  <a href="<?php echo base_url('new_purchase_orders'); ?>" class="btn btn-default btn-lg">
                     <i class="fa fa-times"></i> Cancel
                  </a>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>

<script>
var receiptRowCounter = 2;

function addNewReceiptRow() {
    receiptRowCounter++;
    var newRow = `
        <tr class="receipt-item-row" id="receipt_row_${receiptRowCounter}">
            <td class="checkbox-cell">
                <input type="checkbox" name="receive_item_${receiptRowCounter}" id="receive_item_${receiptRowCounter}" checked>
            </td>
            <td>${receiptRowCounter}</td>
            <td>
                <select class="form-control" name="product_${receiptRowCounter}" id="product_${receiptRowCounter}" onchange="populateProductDetails(${receiptRowCounter})">
                    <option value="">-- Select Product --</option>
                    <?php if (!empty($consumables)): ?>
                        <?php foreach ($consumables as $consumable): ?>
                            <option value="<?php echo $consumable['item_number']; ?>">
                                <?php echo $consumable['item_number']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </td>
            <td>
                <input type="text" class="form-control" name="description_${receiptRowCounter}" id="description_${receiptRowCounter}" readonly>
            </td>
            <td>
                <input type="text" class="form-control" name="uom_${receiptRowCounter}" id="uom_${receiptRowCounter}" readonly>
            </td>
            <td>
                <input type="number" class="form-control" name="qty_remain_${receiptRowCounter}" id="qty_remain_${receiptRowCounter}" readonly>
            </td>
            <td class="checkbox-cell">
                <input type="checkbox" name="receive_all_${receiptRowCounter}" id="receive_all_${receiptRowCounter}">
            </td>
            <td>
                <input type="number" class="form-control" name="qty_receiving_${receiptRowCounter}" id="qty_receiving_${receiptRowCounter}" 
                    value="1.000" step="0.001" onchange="updateAmount(${receiptRowCounter})">
                <button type="button" class="product-details-btn" onclick="showProductDetails(${receiptRowCounter})">
                    Product Details
                </button>
            </td>
            <td>
                <input type="number" class="form-control" name="qty_rejected_${receiptRowCounter}" id="qty_rejected_${receiptRowCounter}" 
                    value="0" step="0.001" onchange="updateAmount(${receiptRowCounter})">
            </td>
            <td>
                <input type="number" class="form-control" name="discount_${receiptRowCounter}" id="discount_${receiptRowCounter}" 
                    value="0" step="0.01" onchange="updateAmount(${receiptRowCounter})">
            </td>
            <td class="checkbox-cell">
                <input type="checkbox" name="include_tax_${receiptRowCounter}" id="include_tax_${receiptRowCounter}" onchange="updateAmount(${receiptRowCounter})">
            </td>
            <td>
                <input type="number" class="form-control" name="tax_amount_${receiptRowCounter}" id="tax_amount_${receiptRowCounter}" 
                    value="0" step="0.01" readonly>
                <button type="button" class="tax-details-btn" onclick="showTaxDetails(${receiptRowCounter})">
                    Tax Details
                </button>
            </td>
            <td>
                <input type="number" class="form-control" name="amount_${receiptRowCounter}" id="amount_${receiptRowCounter}" 
                    value="0.00" step="0.01" readonly>
            </td>
        </tr>
    `;
    
    $('#receipt_items_tbody').append(newRow);
    updateRowNumbers();
}

function updateRowNumbers() {
    $('.receipt-item-row').each(function(index) {
        $(this).find('td:nth-child(2)').text(index + 1);
    });
}

function populateProductDetails(rowId) {
    var productId = $('#product_' + rowId).val();
    if (productId) {
        // Here you would typically make an AJAX call to get product details
        // For now, we'll set some default values
        $('#description_' + rowId).val('Product Description for ' + productId);
        $('#uom_' + rowId).val('PCS');
        $('#qty_remain_' + rowId).val('10');
        updateAmount(rowId);
    }
}

function updateAmount(rowId) {
    var qtyReceiving = parseFloat($('#qty_receiving_' + rowId).val()) || 0;
    var qtyRejected = parseFloat($('#qty_rejected_' + rowId).val()) || 0;
    var discount = parseFloat($('#discount_' + rowId).val()) || 0;
    var includeTax = $('#include_tax_' + rowId).is(':checked');
    
    // Basic calculation - you can enhance this based on your business logic
    var baseAmount = qtyReceiving * 100; // Assuming 100 as base price
    var discountAmount = baseAmount * (discount / 100);
    var amountAfterDiscount = baseAmount - discountAmount;
    
    var taxAmount = 0;
    if (includeTax) {
        taxAmount = amountAfterDiscount * 0.18; // 18% GST
    }
    
    var finalAmount = amountAfterDiscount + taxAmount;
    
    $('#tax_amount_' + rowId).val(taxAmount.toFixed(2));
    $('#amount_' + rowId).val(finalAmount.toFixed(2));
}

function showProductDetails(rowId) {
    alert('Product Details for Row ' + rowId + ' - This would open a detailed product information modal');
}

function showTaxDetails(rowId) {
    alert('Tax Details for Row ' + rowId + ' - This would open a detailed tax calculation modal');
}

$(document).ready(function() {
    // Initialize date pickers
    $('#por_date, #po_date, #reference_date').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });
    
    // Initialize form validation
    $('#purchase_receipt_form').on('submit', function(e) {
        var isValid = true;
        
        // Check if at least one item is selected for receiving
        var hasReceivingItems = false;
        $('input[name^="receive_item_"]').each(function() {
            if ($(this).is(':checked')) {
                hasReceivingItems = true;
                return false;
            }
        });
        
        if (!hasReceivingItems) {
            alert('Please select at least one item to receive.');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
    
    // Initialize amounts for existing rows
    updateAmount(1);
    updateAmount(2);
});
</script>
