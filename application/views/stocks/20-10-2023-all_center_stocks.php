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
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
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
           <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Expiry Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Expiry End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Generic Name</label>
                <input type="text" class="form-control" id="generic_name" name="generic_name" value="<?php echo $generic_name;?>" />
            </div>
			 <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/all_center_stocks'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			<div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('stocks/All-Center-Medicine'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
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
				  <th>Generic Name</th>
				  <th>Item name</th>
				  <th>Batch No</th>
				  <th>Expiry</th>
				  <th>Safty Stock</th>
				  <th>Currunt Stock</th>
                  <th>Category</th>
                  
                  
                  <th>Center</th>
				  
				   
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="table_content">
              <?php $count=1; foreach($investigate_result as $vl){
                            $patient_data = get_patient_detail($vl['patient_id']);
    			            $currency = '';
							
						
							
								
                 ?>
                <tr class="odd gradeX">
				  <td><?php echo $vl['generic_name']?></td>
				  <td><?php echo $vl['item_name']?></td>
				  <td><?php echo $vl['batch_number']?></td>
				  <td><?php echo $vl['expiry_day']; ?></td>
                  <td><?php echo $vl['safety_stock']; ?></td>
				  <td><?php echo $vl['quantity']?></td>
                  <td><?php $category_name = $all_method->get_category_name($vl['category']); echo $category_name; ?></td>
                  
				  
                  <!--<td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['price']; ?></td>-->
                  <td><?php if(!empty($vl['center_number'])){
				        
					        $sql1 = "select * from hms_centers where center_number='".$vl['center_number']."'"; 
						    $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->center_name;
							} }	
				 // echo $vl['center_number']; 			
				?><?php //echo $vl['center_number']; ?><?php //echo $vl['expiry']; ?></td>
				  
				 
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
				  
                  <td><a href="<?php echo base_url();?>stocks/edit_center_item?ID=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a> <a href="<?php echo base_url();?>stocks/delete_center_item?ID=<?php echo $vl['ID']?>" class="delete"><i class="material-icons">delete</i></a></td>
                </tr>
              <?php $count++;} ?>
			   <tr>
                <td colspan="9">
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
    <script>
		$( "#upload_stock" ).click(function() {
		  $( ".show_upload" ).toggle( "slow", function() {
			// Animation complete.
		  });
    });
    $(document).ready(function() {
        $('.stock_list').DataTable( {
            "order": [[ 7, "asc" ]]
        } );
    } );
    </script>