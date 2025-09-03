  <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <style>
	  a#export_stock {
		text-align: right;
		width: 100%;
		display: block;
		color: #000;
		margin-bottom:10px;
 	  }
	  .card .card-action{padding:45px 15px!important;}
      </style>
      <div class="card">
     
       <!-- <div class="card-action"><h3>All Center Stocks Lists </h3><a href="<?php echo base_url('stocks/center_stock_export/'.$_SESSION['logged_stock_manager']['center'].'');?>" id="export_stock"><i class="fa fa-download fa-lg" aria-hidden="true"></i> Export stock</a>
      	</div>-->
		<form action="<?php echo base_url().'stocks/all_center_stocks'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12">
            	<label>Expiry Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>Expiry End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
			 <div class="col-sm-3 col-xs-12">
            	<label>Generic Name</label>
                <input type="text" class="form-control" id="generic_name" name="generic_name" value="<?php echo $generic_name;?>" />
            </div>
			 <div class="col-sm-3 col-xs-12">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
			<div class="col-sm-3 col-xs-12">
            	<label>Batch No</label>
                <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $batch_number;?>" />
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>Item Number</label>
                <input type="text" class="form-control" id="item_number" name="item_number" value="<?php echo $item_number;?>" />
            </div>
		   <div class="col-sm-3 col-xs-12">
            	<label>Filter by billing at</label>
                <select class="form-control" id="employee_number" name="employee_number">
                	<option value=''>--Select From--</option>
                    <?php $all_emplyee = $all_method->get_employee_list();
						            foreach($all_emplyee as $key => $val){ //var_dump($val);die;
                          if($employee_number == $val['name']){
                            echo '<option value="'.$val['employee_number'].'" selected>'.$val['name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['employee_number'].'">'.$val['name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
            <div class="col-sm-3" style="margin-top: 20px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
				<a href="<?php echo base_url().'stocks/all_center_stocks'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
			   <a href="<?php echo base_url('stocks/All-Center-Medicine'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export</button>
               </a>
            </div>
            </form>
         <div class="clearfix"></div>
       
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover stock_list1" id="centre_stock_list1">
              <thead>
                <tr>
						  <th>Bill No</th>
				          <th>Generic Name</th>
				          <th>Company</th>
						  <th>Item ID</th>
				          <th>Product Id</th>
                          <th>Item Name</th>
						  <th>Vendor</th>
				          <th>Brand</th>
				          <th>Batch No</th>
						  <th>Category</th>
						  <th>Quantity</th>
						  <th>Expiry</th>
						   
				          <th>HSN</th>
				          <th>GST</th>
				          <th>Pack Size</th>
				          <th>GST Division</th>
				          <th>Vendor Price</th>
				          <th>MRP</th>
                          <th>Center</th>
						  <th>Department</th>
				          <th>Status</th>
                          <th>Date Of Purchase</th>
                          <th>Ageing</th>
                          <th>Action</th>
						  <th>Add Date</th>
                </tr>
              </thead>
              <tbody id="table_content">
              <?php $count=1; foreach($investigate_result as $vl){ ?>
                <tr class="odd gradeX">
				  <td><?php echo $vl['invoice_no']?></td>
				  <td><?php echo $vl['generic_name']?></td>
				  <td><?php echo $vl['company']?></td>
				  <td><?php echo $vl['item_number']?></td>
				  <td><?php echo $vl['product_id']?></td>
				  <td><?php echo $vl['item_name']?></td>
                  <td><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
				  <td><?php echo $all_method->get_brand_name($vl['brand_name']);?></td>
				  <td><?php echo $vl['batch_number']?></td>
				  <td><?php $category_name = $all_method->get_category_name($vl['category']); echo $category_name; ?></td>
				  <td><?php echo $vl['quantity']?></td>
				  <?php
				  // Assuming $vl['expiry'] is the expiry date in 'Y-m-d' format
				  $expiryDate = new DateTime($vl['expiry']);
				  $today = new DateTime();
				  $twoMonthsFromNow = (clone $today)->modify('+2 months');
				  $color = '';
				  if ($expiryDate <= $twoMonthsFromNow) {
				  $color = 'style="color: red;font-weight:800"'; // Set the color to red if within 2 months
				  }
				  ?>
                  <td <?php echo $color; ?>><?php echo $vl['expiry']; ?></td>
				  
				  <td><?php echo $vl['hsn']?></td>
				  <td><?php echo $vl['gstrate']?></td>
				  <td><?php echo $vl['pack_size']?></td>
				  <td><?php echo $vl['gstdivision']?></td>
				  <td><?php echo $vl['vendor_price']; ?></td>
				  <td><?php echo $vl['mrp']?></td>
                  <td><?php if(!empty($vl['center_number'])){
				            $sql1 = "select * from hms_centers where center_number='".$vl['center_number']."'"; 
						    $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->center_name;
							}
							}	
				  ?></td>
				  <td><?php $employee_name = $all_method->get_employee_name($vl['employee_number']); echo $employee_name;
							
				  
				  ?></td>
				  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
          <td><?php echo $vl['date_of_purchase']; ?></td> 
          <td><?php
$date1 = new DateTime($vl['date_of_purchase']);
$date2 = new DateTime(date('Y-m-d'));
$diff = $date1->diff($date2);
echo $diff->days;
?></td>
		<?php if (!empty($_SESSION['logged_central_stock_manager'])) { ?>
				  <td>
				  <a href="<?php echo base_url();?>stocks/edit_center_item?ID=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a>
				  <a href="<?php echo base_url();?>stocks/delete_center_item?ID=<?php echo $vl['ID']?>" class="delete"><i class="material-icons">delete</i></a>
				  <br/><a href="<?php echo base_url();?>stocks/audit_stocks?ID=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">Audit Stocks</i></a>
				  <?php if($vl['status'] == '1'){ ?>
				  <a href="<?php echo base_url();?>stocks/transfer_stocks/<?php echo $vl['ID']?>" class="btn btn-secondary">Transfer</a>
				  <?php } ?>
				  </td>
                  <?php } ?>
				  <td><?php echo $vl['add_date']?></td>
                </tr>
              <?php $count++;} ?>
			   <tr>
                <td colspan="16">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
  <script>
      $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var data = {appointment_date:startDate, type:'particular_date_filter'};
          }
        });
    });
</script>
<style >
.custom-pagination{
  padding:8px;
}
.custom-pagination a{
  padding:10px;
  text-decoration: none;
}
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
.form-control#billing_at{
  height: 40px!important;
  border: 1px solid #9e9e9e!important;
}
</style>