  <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
     <!-- <div class="card-action stock_upload_box">
      	<a href="javascript:void(0)" id="upload_stock" title="Upload stock"><i class="fa fa-upload  fa-lg" aria-hidden="true"></i> Upload Stock</a>
        <div class="show_upload" style="display:none;">
        	<form method="post" action="" enctype="multipart/form-data">
   				<input type="hidden" name="upload_stocks" value="upload_center_stocks" />
        		<input type="file" name="stock_lists" class="up_file" required />
        		<input type="submit" value="Upload CSV file only" class="btn btn-primary up_btn" />
            </form>
            <a href="<?php echo base_url();?>assets/stock_files/center_sample_stocks.csv" download>Download sample</a>
        </div>
      </div> -->
        <div class="card-action"><h3> Stocks Lists </h3></div>
         <div class="clearfix"></div>
       <!-- <div class="card-content">
        	<div class="col-sm-6 first_filter_div no-pl">
            	<div class="dataTables_week" id="dataTables_week_filter">
          	  		<div class="card-action"><h5> Filter Record </h5></div>
                    <label>
                    <select name="dataTables_week_filter" filter="stocks" field="week_month_filter" aria-controls="dataTables_week" class="form-control week_month_filter input-sm">
                        <option value="all">All</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                    </label>
              	</div>
            </div>
            
            <div class="col-sm-6 second_filter_div no-pl">
            	<div class="dataTables_week" id="dataTables_week_filter">
          	  		<div class="card-action"><h5> Filter record by date </h5></div>
                    <label>
                    <input type="text" field="daterange_filter" filter="stocks" class="daterange_filter" name="daterange" value="01/01/2018 - 01/15/2018" />
                    </label>
              	</div>
            </div>
        </div>-->
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Item ID</th>
                  <th>Item name</th>
                  <th>Category</th>
                  <th>Quantity</th>
                  <th>MRP</th>
                  <th>Expiry</th>
                  <th>Status</th>
                  <!--<th>Action</th>-->
                </tr>
              </thead>
              <tbody id="table_content">
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['company']?></td>
                  <td><a href="<?php echo base_url(); ?>stocks/cdetail/<?php echo $vl['item_number']?>"><?php echo $vl['item_number']?></a></td>
                  <td><?php echo $vl['item_name']?></td>
                  <td><?php $category_name = $all_method->get_category_name($vl['category']); echo $category_name; ?></td>
                  <td><?php echo $vl['quantity']?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['price']; ?></td>
                  <td><?php echo $vl['expiry']; ?></td>
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <!--<td><a href="<?php echo base_url();?>stocks/edit_center_item?item_number=<?php echo $vl['item_number']?>" class="edit"><i class="material-icons">edit</i></a> <a href="<?php echo base_url();?>stocks/delete_center_item?item_number=<?php echo $vl['item_number']?>" class="delete"><i class="material-icons">delete</i></a></td>-->
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
    
    <script>
		$( "#upload_stock" ).click(function() {
		  $( ".show_upload" ).toggle( "slow", function() {
			// Animation complete.
		  });
		});
    </script>