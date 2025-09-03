<?php $all_method =&get_instance(); ?>
<!-- Select2 CSS and JS -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css">
<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>

<style>
.consumable-select {
    width: 150px !important;
}
</style>
<div class="col-md-12">
   <div class="card" style="margin-bottom:20px;">
      <div class="col-md-12">
         <h3><i class="fa fa-edit"></i> Edit Purchase Order</h3>
      </div>
      <div class="clearfix"></div>
      
      <form method="post" action="<?php echo base_url('new_purchase_orders/update/' . $purchase_order['id']); ?>" id="edit_po_form">
         <div class="card-content">
            <!-- PO Number Section -->
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="po_number">PO Number</label>
                     <input type="text" class="form-control" id="po_number" name="po_number" 
                        value="<?php echo $purchase_order['po_number']; ?>" readonly>
                     <small class="text-muted">PO number cannot be changed</small>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="vendor_number">Vendor <span class="text-danger">*</span></label>
                     <select class="form-control" id="vendor_number" name="vendor_number" required>
                        <option value="">-- Select Vendor --</option>
                        <?php if (!empty($vendors)): ?>
                           <?php foreach ($vendors as $vendor): ?>
                              <option value="<?php echo $vendor['vendor_number']; ?>" 
                                 <?php echo ($vendor['vendor_number'] == $purchase_order['vendor_number']) ? 'selected' : ''; ?>>
                                 <?php echo $vendor['name']; ?> (<?php echo $vendor['vendor_number']; ?>)
                              </option>
                           <?php endforeach; ?>
                        <?php endif; ?>
                     </select>
                  </div>
               </div>
            </div>

            <!-- Ship To and Bill To Section -->
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="ship_to">Ship To <span class="text-danger">*</span></label>
                     <select class="form-control" id="ship_to" name="ship_to" required>
                        <option value="">-- Select Ship To --</option>
                        <?php if (!empty($centers)): ?>
                           <?php foreach ($centers as $center): ?>
                              <option value="<?php echo $center['center_number']; ?>" 
                                 <?php echo ($center['center_number'] == $purchase_order['ship_to']) ? 'selected' : ''; ?>>
                                 <?php echo $center['center_name']; ?> 
                              </option>
                           <?php endforeach; ?>
                        <?php endif; ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="bill_to">Bill To <span class="text-danger">*</span></label>
                     <select class="form-control" id="bill_to" name="bill_to" required>
                        <option value="">-- Select Bill To --</option>
                        <?php if (!empty($centers)): ?>
                           <?php foreach ($centers as $center): ?>
                              <option value="<?php echo $center['center_number']; ?>" 
                                 <?php echo ($center['center_number'] == $purchase_order['bill_to']) ? 'selected' : ''; ?>>
                                 <?php echo $center['center_name']; ?>
                              </option>
                           <?php endforeach; ?>
                        <?php endif; ?>
                     </select>
                  </div>
               </div>
            </div>

            <!-- Center Section -->
            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label for="department">Department <span class="text-danger">*</span></label>
                        <select class="form-control" id="department" name="department" required>
                           <option value="">Select Department</option>
                           <option value="CASH MEDICINE NOIDA" <?php echo ($purchase_order['department'] == 'CASH MEDICINE NOIDA') ? 'selected' : ''; ?>>CASH MEDICINE NOIDA</option>
                           <option value="CASH MEDICINE GGN" <?php echo ($purchase_order['department'] == 'CASH MEDICINE GGN') ? 'selected' : ''; ?>>CASH MEDICINE GGN</option>
                           <option value="CASH MEDICINE GP" <?php echo ($purchase_order['department'] == 'CASH MEDICINE GP') ? 'selected' : ''; ?>>CASH MEDICINE GP</option>
                           <option value="CASH MEDICINE SRINAGAR" <?php echo ($purchase_order['department'] == 'CASH MEDICINE SRINAGAR') ? 'selected' : ''; ?>>CASH MEDICINE SRINAGAR</option>
                           <option value="CASH MEDICINE GHAZIABAD" <?php echo ($purchase_order['department'] == 'CASH MEDICINE GHAZIABAD') ? 'selected' : ''; ?>>CASH MEDICINE GHAZIABAD</option>
                           <option value="Hormonal Ghaziabad" <?php echo ($purchase_order['department'] == 'Hormonal Ghaziabad') ? 'selected' : ''; ?>>Hormonal Ghaziabad</option>
                           <option value="HORMONAL SRINAGAR" <?php echo ($purchase_order['department'] == 'HORMONAL SRINAGAR') ? 'selected' : ''; ?>>HORMONAL SRINAGAR</option>
                           <option value="Hormonal Delhi" <?php echo ($purchase_order['department'] == 'Hormonal Delhi') ? 'selected' : ''; ?>>Hormonal Delhi</option>
                           <option value="Hormonal Gurgaon" <?php echo ($purchase_order['department'] == 'Hormonal Gurgaon') ? 'selected' : ''; ?>>Hormonal Gurgaon</option>
                           <option value="Hormonal Noida" <?php echo ($purchase_order['department'] == 'Hormonal Noida') ? 'selected' : ''; ?>>Hormonal Noida</option>
                           <option value="Embryologist Noida" <?php echo ($purchase_order['department'] == 'Embryologist Noida') ? 'selected' : ''; ?>>Embryologist Noida</option>
                           <option value="OT Noida" <?php echo ($purchase_order['department'] == 'OT Noida') ? 'selected' : ''; ?>>OT Noida</option>
                           <option value="OT Basant Lok" <?php echo ($purchase_order['department'] == 'OT Basant Lok') ? 'selected' : ''; ?>>OT Basant Lok</option>
                           <option value="Embryology Basant Lok" <?php echo ($purchase_order['department'] == 'Embryology Basant Lok') ? 'selected' : ''; ?>>Embryology Basant Lok</option>
                           <option value="Embryology Srinagar" <?php echo ($purchase_order['department'] == 'Embryology Srinagar') ? 'selected' : ''; ?>>Embryology Srinagar</option>
                           <option value="OT Srinagar" <?php echo ($purchase_order['department'] == 'OT Srinagar') ? 'selected' : ''; ?>>OT Srinagar</option>
                        </select>
                     </div>
                  </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Status</label>
                     <input type="text" class="form-control" value="<?php echo ucfirst($purchase_order['status']); ?>" readonly>
                     <small class="text-muted">Status cannot be changed from edit form</small>
                  </div>
               </div>
            </div>

            <hr>

            <!-- Consumables Section -->
            <div class="row">
               <div class="col-md-12">
                  <h4><i class="fa fa-list"></i> Consumables</h4>
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover" id="consumables_table">
                        <thead>
                           <tr>
                              <th width="5%">Sr.</th>
                              <th width="15%">Item Name</th>
                              <th width="10%">Quantity</th>
                              <th width="10%">Batch</th>
                              <th width="10%">Price</th>
                              <th width="10%">Vendor Price</th>
                              <th width="10%">Pack Size</th>
                              <th width="10%">MRP</th>
                              <th width="10%">Tax %</th>
                              <th width="10%">Actions</th>
                           </tr>
                        </thead>
                        <tbody id="consumables_tbody">
                           <?php 
                           // Check if data exists
                           if (empty($purchase_order_items)) {
                               echo '<tr><td colspan="10" class="text-center text-muted">No consumables found for this purchase order</td></tr>';
                           }
                           ?>
                           <?php if (!empty($purchase_order_items)): ?>
                              <?php foreach ($purchase_order_items as $index => $item): ?>
                                 <tr class="consumable-row" id="row_<?php echo $index + 1; ?>">
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                                                               <select class="form-control consumable-select" name="consumables_name_<?php echo $index + 1; ?>" 
                                           id="consumables_name_<?php echo $index + 1; ?>" onchange="populateItemDetails(<?php echo $index + 1; ?>)">
                                           <option value="">-- Select Item --</option>
                                           <?php if (!empty($consumables)): ?>
                                              <?php foreach ($consumables as $consumable): ?>
                                                 <?php 
                                                    $itemName   = htmlspecialchars(str_replace('`', "'", $consumable['item_name']), ENT_QUOTES, 'UTF-8');
                                                    $batchNo    = htmlspecialchars(str_replace('`', "'", $consumable['batch_number']), ENT_QUOTES, 'UTF-8');
                                                    $itemNumber = htmlspecialchars($consumable['item_number'], ENT_QUOTES, 'UTF-8');
                                                    $price      = htmlspecialchars($consumable['price'], ENT_QUOTES, 'UTF-8');
                                                    $vendorPrice= htmlspecialchars($consumable['vendor_price'], ENT_QUOTES, 'UTF-8');
                                                    $packSize   = htmlspecialchars($consumable['pack_size'], ENT_QUOTES, 'UTF-8');
                                                    $mrp        = htmlspecialchars($consumable['mrp'], ENT_QUOTES, 'UTF-8');
                                                    $tax        = htmlspecialchars($consumable['gstrate'], ENT_QUOTES, 'UTF-8');
                                                    $hsn        = htmlspecialchars($consumable['hsn'], ENT_QUOTES, 'UTF-8');
                                                    $gstDiv     = htmlspecialchars($consumable['gstdivision'], ENT_QUOTES, 'UTF-8');
                                                    $company    = htmlspecialchars($consumable['company'], ENT_QUOTES, 'UTF-8');
                                                    $brand      = htmlspecialchars($consumable['brand_name'], ENT_QUOTES, 'UTF-8');
                                                 ?>
                                                 <option value="<?= $itemNumber ?>"
                                                    data-item-name="<?= $itemName ?>"
                                                    data-batch="<?= $batchNo ?>"
                                                    data-price="<?= $price ?>"
                                                    data-vendor-price="<?= $vendorPrice ?>"
                                                    data-pack-size="<?= $packSize ?>"
                                                    data-mrp="<?= $mrp ?>"
                                                    data-tax="<?= $tax ?>"
                                                    data-hsn="<?= $hsn ?>"
                                                    data-gst-division="<?= $gstDiv ?>"
                                                    data-company="<?= $company ?>"
                                                    data-brand="<?= $brand ?>"
                                                    <?php echo ($consumable['item_number'] == $item['item_number']) ? 'selected' : ''; ?>>
                                                    <?= $itemName ?> (<?= $itemNumber ?>)
                                                 </option>
                                              <?php endforeach; ?>
                                           <?php endif; ?>
                                        </select>
                                        <input type="hidden" name="consumables_item_name_<?php echo $index + 1; ?>" 
                                           id="consumables_item_name_<?php echo $index + 1; ?>" value="<?php echo $item['item_name']; ?>">
                                        <input type="hidden" name="consumables_company_<?php echo $index + 1; ?>" 
                                           id="consumables_company_<?php echo $index + 1; ?>" value="<?php echo $item['company']; ?>">
                                        <input type="hidden" name="consumables_hsn_<?php echo $index + 1; ?>" 
                                           id="consumables_hsn_<?php echo $index + 1; ?>" value="<?php echo $item['hsn']; ?>">
                                        <input type="hidden" name="consumables_gstdivision_<?php echo $index + 1; ?>" 
                                           id="consumables_gstdivision_<?php echo $index + 1; ?>" value="<?php echo $item['gst_division']; ?>">
                                        <input type="hidden" name="consumables_brand_name_<?php echo $index + 1; ?>" 
                                           id="consumables_brand_name_<?php echo $index + 1; ?>" value="<?php echo $item['brand_name']; ?>">
                                        <input type="hidden" name="consumables_batch_number_<?php echo $index + 1; ?>" 
                                           id="consumables_batch_number_hidden_<?php echo $index + 1; ?>" value="<?php echo $item['batch_number']; ?>">
                                        <input type="hidden" name="consumables_price_<?php echo $index + 1; ?>" 
                                           id="consumables_price_hidden_<?php echo $index + 1; ?>" value="<?php echo $item['price']; ?>">
                                        <input type="hidden" name="consumables_vendor_price_<?php echo $index + 1; ?>" 
                                           id="consumables_vendor_price_hidden_<?php echo $index + 1; ?>" value="<?php echo $item['vendor_price']; ?>">
                                        <input type="hidden" name="consumables_pack_size_<?php echo $index + 1; ?>" 
                                           id="consumables_pack_size_hidden_<?php echo $index + 1; ?>" value="<?php echo $item['pack_size']; ?>">
                                        <input type="hidden" name="consumables_mrp_<?php echo $index + 1; ?>" 
                                           id="consumables_mrp_hidden_<?php echo $index + 1; ?>" value="<?php echo $item['mrp']; ?>">
                                        <input type="hidden" name="consumables_gstrate_<?php echo $index + 1; ?>" 
                                           id="consumables_gstrate_hidden_<?php echo $index + 1; ?>" value="<?php echo $item['tax_percentage']; ?>">
                                    </td>
                                    <td>
                                       <input type="number" class="form-control" name="consumables_quantity_<?php echo $index + 1; ?>" 
                                          id="consumables_quantity_<?php echo $index + 1; ?>" 
                                          value="<?php echo $item['quantity']; ?>" min="1" onchange="updateTotal(<?php echo $index + 1; ?>)">
                                    </td>
                                    <td>
                                       <input type="text" class="form-control" name="consumables_batch_number_<?php echo $index + 1; ?>" 
                                          id="consumables_batch_number_<?php echo $index + 1; ?>" 
                                          value="<?php echo $item['batch_number']; ?>" readonly>
                                    </td>
                                    <td>
                                       <input type="number" class="form-control" name="consumables_price_<?php echo $index + 1; ?>" 
                                          id="consumables_price_<?php echo $index + 1; ?>" 
                                          value="<?php echo $item['price']; ?>" step="0.01" min="0" onchange="updateTotal(<?php echo $index + 1; ?>)">
                                    </td>
                                    <td>
                                       <input type="number" class="form-control" name="consumables_vendor_price_<?php echo $index + 1; ?>" 
                                          id="consumables_vendor_price_<?php echo $index + 1; ?>" 
                                          value="<?php echo $item['vendor_price']; ?>" step="0.01" min="0" onchange="updateTotal(<?php echo $index + 1; ?>)">
                                    </td>
                                    <td>
                                       <input type="text" class="form-control" name="consumables_pack_size_<?php echo $index + 1; ?>" 
                                          id="consumables_pack_size_<?php echo $index + 1; ?>" 
                                          value="<?php echo $item['pack_size']; ?>" readonly>
                                    </td>
                                    <td>
                                       <input type="number" class="form-control" name="consumables_mrp_<?php echo $index + 1; ?>" 
                                          id="consumables_mrp_<?php echo $index + 1; ?>" 
                                          value="<?php echo $item['mrp']; ?>" step="0.01" min="0">
                                    </td>
                                    <td>
                                       <input type="number" class="form-control" name="consumables_gstrate_<?php echo $index + 1; ?>" 
                                          id="consumables_gstrate_<?php echo $index + 1; ?>" 
                                          value="<?php echo $item['tax_percentage']; ?>" step="0.01" min="0">
                                    </td>
                                    <td>
                                       <button type="button" class="btn btn-danger btn-xs" onclick="removeRow(<?php echo $index + 1; ?>)">
                                          <i class="fa fa-times"></i>
                                       </button>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
                  
                  <div class="text-center">
                     <button type="button" class="btn btn-success" onclick="addNewRow()">
                        <i class="fa fa-plus"></i> Add New Row
                     </button>
                  </div>
               </div>
            </div>

            <hr>

            <!-- Total Section -->
            <div class="row">
               <div class="col-md-6 col-md-offset-6">
                  <div class="form-group">
                     <label for="total_amount">Total Amount</label>
                     <input type="text" class="form-control" id="total_amount" name="total_amount" 
                        value="₹<?php echo number_format($purchase_order['total_amount'], 2); ?>" readonly>
                  </div>
               </div>
            </div>

            <!-- Submit Buttons -->
            <div class="row">
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-lg">
                     <i class="fa fa-save"></i> Update Purchase Order
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
var rowCounter = <?php echo count($purchase_order_items); ?>;

function addNewRow() {
    rowCounter++;
    var newRow = `
        <tr class="consumable-row" id="row_${rowCounter}">
            <td>${rowCounter}</td>
            <td>
                <select class="form-control consumable-select" name="consumables_name_${rowCounter}" id="consumables_name_${rowCounter}" onchange="populateItemDetails(${rowCounter})">
                    <option value="">-- Select Item --</option>
                    <?php if (!empty($consumables)): ?>
                        <?php foreach ($consumables as $consumable): ?>
                            <?php 
                               $itemName   = htmlspecialchars(str_replace('`', "'", $consumable['item_name']), ENT_QUOTES, 'UTF-8');
                               $batchNo    = htmlspecialchars(str_replace('`', "'", $consumable['batch_number']), ENT_QUOTES, 'UTF-8');
                               $itemNumber = htmlspecialchars($consumable['item_number'], ENT_QUOTES, 'UTF-8');
                               $price      = htmlspecialchars($consumable['price'], ENT_QUOTES, 'UTF-8');
                               $vendorPrice= htmlspecialchars($consumable['vendor_price'], ENT_QUOTES, 'UTF-8');
                               $packSize   = htmlspecialchars($consumable['pack_size'], ENT_QUOTES, 'UTF-8');
                               $mrp        = htmlspecialchars($consumable['mrp'], ENT_QUOTES, 'UTF-8');
                               $tax        = htmlspecialchars($consumable['gstrate'], ENT_QUOTES, 'UTF-8');
                               $hsn        = htmlspecialchars($consumable['hsn'], ENT_QUOTES, 'UTF-8');
                               $gstDiv     = htmlspecialchars($consumable['gstdivision'], ENT_QUOTES, 'UTF-8');
                               $company    = htmlspecialchars($consumable['company'], ENT_QUOTES, 'UTF-8');
                               $brand      = htmlspecialchars($consumable['brand_name'], ENT_QUOTES, 'UTF-8');
                            ?>
                            <option value="<?= $itemNumber ?>"
                                data-item-name="<?= $itemName ?>"
                                data-batch="<?= $batchNo ?>"
                                data-price="<?= $price ?>"
                                data-vendor-price="<?= $vendorPrice ?>"
                                data-pack-size="<?= $packSize ?>"
                                data-mrp="<?= $mrp ?>"
                                data-tax="<?= $tax ?>"
                                data-hsn="<?= $hsn ?>"
                                data-gst-division="<?= $gstDiv ?>"
                                data-company="<?= $company ?>"
                                data-brand="<?= $brand ?>">
                                <?= $itemName ?> (<?= $itemNumber ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <input type="hidden" name="consumables_item_name_${rowCounter}" id="consumables_item_name_${rowCounter}">
                <input type="hidden" name="consumables_company_${rowCounter}" id="consumables_company_${rowCounter}">
                <input type="hidden" name="consumables_hsn_${rowCounter}" id="consumables_hsn_${rowCounter}">
                <input type="hidden" name="consumables_gstdivision_${rowCounter}" id="consumables_gstdivision_${rowCounter}">
                <input type="hidden" name="consumables_brand_name_${rowCounter}" id="consumables_brand_name_${rowCounter}">
                <input type="hidden" name="consumables_batch_number_${rowCounter}" id="consumables_batch_number_hidden_${rowCounter}">
                <input type="hidden" name="consumables_price_${rowCounter}" id="consumables_price_hidden_${rowCounter}">
                <input type="hidden" name="consumables_vendor_price_${rowCounter}" id="consumables_vendor_price_hidden_${rowCounter}">
                <input type="hidden" name="consumables_pack_size_${rowCounter}" id="consumables_pack_size_hidden_${rowCounter}">
                <input type="hidden" name="consumables_mrp_${rowCounter}" id="consumables_mrp_hidden_${rowCounter}">
                <input type="hidden" name="consumables_gstrate_${rowCounter}" id="consumables_gstrate_hidden_${rowCounter}">
            </td>
            <td>
                <input type="number" class="form-control" name="consumables_quantity_${rowCounter}" id="consumables_quantity_${rowCounter}" 
                    value="1" min="1" onchange="updateTotal(${rowCounter})">
            </td>
            <td>
                <input type="text" class="form-control" name="consumables_batch_number_${rowCounter}" id="consumables_batch_number_${rowCounter}" readonly>
            </td>
            <td>
                <input type="number" class="form-control" name="consumables_price_${rowCounter}" id="consumables_price_${rowCounter}" 
                    step="0.01" min="0" onchange="updateTotal(${rowCounter})">
            </td>
            <td>
                <input type="number" class="form-control" name="consumables_vendor_price_${rowCounter}" id="consumables_vendor_price_${rowCounter}" 
                    step="0.01" min="0" onchange="updateTotal(${rowCounter})">
            </td>
            <td>
                <input type="text" class="form-control" name="consumables_pack_size_${rowCounter}" id="consumables_pack_size_${rowCounter}" readonly>
            </td>
            <td>
                <input type="number" class="form-control" name="consumables_mrp_${rowCounter}" id="consumables_mrp_${rowCounter}" 
                    step="0.01" min="0">
            </td>
            <td>
                <input type="number" class="form-control" name="consumables_gstrate_${rowCounter}" id="consumables_gstrate_${rowCounter}" 
                    step="0.01" min="0" value="0">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-xs" onclick="removeRow(${rowCounter})">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        </tr>
    `;
    
    $('#consumables_tbody').append(newRow);
    
    // Initialize Select2 for the new row
    $('#consumables_name_' + rowCounter).select2({
        placeholder: 'Search and select item...',
        allowClear: true,
        width: '100%'
    });
    
    updateRowNumbers();
}

function removeRow(rowId) {
    if ($('.consumable-row').length > 1) {
        // Destroy Select2 before removing the row
        $('#consumables_name_' + rowId).select2('destroy');
        $('#row_' + rowId).remove();
        updateRowNumbers();
        calculateTotal();
    } else {
        alert('At least one row is required!');
    }
}

function updateRowNumbers() {
    $('.consumable-row').each(function(index) {
        $(this).find('td:first').text(index + 1);
    });
}

function populateItemDetails(rowId) {
    var select = $('#consumables_name_' + rowId);
    var selectedOption = select.find('option:selected');
    
    if (selectedOption.val()) {
        // Populate hidden fields for form submission
        $('#consumables_item_name_' + rowId).val(selectedOption.data('item-name'));
        $('#consumables_batch_number_hidden_' + rowId).val(selectedOption.data('batch'));
        $('#consumables_price_hidden_' + rowId).val(selectedOption.data('price'));
        $('#consumables_vendor_price_hidden_' + rowId).val(selectedOption.data('vendor-price'));
        $('#consumables_pack_size_hidden_' + rowId).val(selectedOption.data('pack-size'));
        $('#consumables_mrp_hidden_' + rowId).val(selectedOption.data('mrp'));
        $('#consumables_gstrate_hidden_' + rowId).val(selectedOption.data('tax'));
        $('#consumables_hsn_' + rowId).val(selectedOption.data('hsn'));
        $('#consumables_gstdivision_' + rowId).val(selectedOption.data('gst-division'));
        $('#consumables_company_' + rowId).val(selectedOption.data('company'));
        $('#consumables_brand_name_' + rowId).val(selectedOption.data('brand'));
        
        // Also populate visible fields for user reference
        $('#consumables_batch_number_' + rowId).val(selectedOption.data('batch'));
        $('#consumables_price_' + rowId).val(selectedOption.data('price'));
        $('#consumables_vendor_price_' + rowId).val(selectedOption.data('vendor-price'));
        $('#consumables_pack_size_' + rowId).val(selectedOption.data('pack-size'));
        $('#consumables_mrp_' + rowId).val(selectedOption.data('mrp'));
        $('#consumables_gstrate_' + rowId).val(selectedOption.data('tax'));
        
        updateTotal(rowId);
    }
}

function updateTotal(rowId) {
    var quantity = parseFloat($('#consumables_quantity_' + rowId).val()) || 0;
    var vendorPrice = parseFloat($('#consumables_vendor_price_' + rowId).val()) || 0;
    var tax = parseFloat($('#consumables_gstrate_' + rowId).val()) || 0;
    
    var total = (quantity * vendorPrice) * (1 + tax / 100);
    calculateTotal();
}

function calculateTotal() {
    var total = 0;
    $('.consumable-row').each(function() {
        var quantity = parseFloat($(this).find('input[id*="consumables_quantity_"]').val()) || 0;
        var vendorPrice = parseFloat($(this).find('input[id*="consumables_vendor_price_"]').val()) || 0;
        var tax = parseFloat($(this).find('input[id*="consumables_gstrate_"]').val()) || 0;
        
        total += (quantity * vendorPrice) * (1 + tax / 100);
    });
    
    $('#total_amount').val('₹' + total.toFixed(2));
}

$(document).ready(function() {
    // Initialize Select2 for consumable dropdowns
    $('.consumable-select').select2({
        placeholder: 'Search and select item...',
        allowClear: true,
        width: '100%'
    });
    
    // Calculate total after Select2 initialization
    setTimeout(function() {
        calculateTotal();
    }, 200);
    
    // Initialize form validation
    $('#edit_po_form').on('submit', function(e) {
        var isValid = true;
        
        // Check if at least one item is selected
        var hasItems = false;
        $('.consumable-select').each(function() {
            if ($(this).val()) {
                hasItems = true;
                return false;
            }
        });
        
        if (!hasItems) {
            alert('Please add at least one item to the purchase order.');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
    
    // Populate visible fields with existing data for editing
    $('.consumable-select').each(function() {
        var rowId = $(this).attr('id').replace('consumables_name_', '');
        if ($(this).val()) {
            // Get the selected option data
            var selectedOption = $(this).find('option:selected');
            if (selectedOption.length > 0) {
                // Populate visible fields
                $('#consumables_batch_number_' + rowId).val(selectedOption.data('batch'));
                $('#consumables_price_' + rowId).val(selectedOption.data('price'));
                $('#consumables_vendor_price_' + rowId).val(selectedOption.data('vendor-price'));
                $('#consumables_pack_size_' + rowId).val(selectedOption.data('pack-size'));
                $('#consumables_mrp_' + rowId).val(selectedOption.data('mrp'));
                $('#consumables_gstrate_' + rowId).val(selectedOption.data('tax'));
            }
        }
    });
    
    // Initialize total calculation after a short delay to ensure all fields are populated
    setTimeout(function() {
        calculateTotal();
    }, 500);
});
</script>