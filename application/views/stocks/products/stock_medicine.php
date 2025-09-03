<?php $all_method =&get_instance(); ?>
<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
     <div class="card">
     <div class="col-md-12"><h3>Medicine List</h3></div>
		<form action="<?php echo base_url().'stocks/stock_medicine'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>" />
            </div>
			<div class="col-sm-3 col-xs-12">
              <label for="item_name">Vendors (Required)</label>
                <select class="select2 form-control" name="vendor_number" id="vendor_number">
                    <option value="">-- Select --</option>
                    <?php if(!empty($vendors)){
                      foreach($vendors as $key => $val){  
                    ?>
                        <option value="<?php echo $val['vendor_number']?>"><?php echo $val['name']?></option>
                      <?php } }?>
                </select>
            </div>
			<div class="col-sm-3 col-xs-12">
			 <label for="item_name">Brands (Required)</label>
					<select class="form-control select2" name="brand_number" id="brand_number">
					 <option value="">-- Select --</option>
                      <?php 
                      if(!empty($brands)){
                        foreach($brands as $key => $val){  
                      ?>
                          <option value="<?php echo $val['brand_number']?>"><?php echo $val['name']?></option>
                        <?php } }?>
                  </select>
          </div>
            <div class="col-sm-5" style="margin-top: 20px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            <a href="<?php echo base_url().'stocks/stock_medicine'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            	<a href="<?php echo base_url('stocks/All-Product-Discard'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing"  onclick="backupDatabase();">Export</button>
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
				    <th>Item name</th>
                    <th>Vendor Name</th>
                    <th>Brand Name</th>
                    <th>MRP</th>
                    <th>Vendor Price</th>
                    <th>Status</th>
			        <th>Add Date</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody id="table_content">
              <?php $count=1; foreach($product_discard as $vl){ ?>
               <tr class="odd gradeX">
                    <td><?php echo $vl['name']; ?></td>
                    <td><?php echo $all_method->get_vendor_name($vl['vendor_number']);?></td>
                    <td><?php echo $all_method->get_brand_name($vl['brand_number']);?></td>
                    <td><?php echo $vl['mrp']; ?></td>
                    <td><?php echo $vl['vendor_price']?></td> 
                    <td><?php echo $vl['status']?></td>
			        <td><?php echo $vl['add_date']?></td>
                    <td><a href="<?php echo base_url();?>edit-medicine?ID=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a></td>
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
 a#export_stock {
		text-align: right;
		width: 100%;
		display: block;
		color: #000;
		margin-bottom:10px;
 	  }
	  .card .card-action{padding:45px 15px!important;}
</style>

