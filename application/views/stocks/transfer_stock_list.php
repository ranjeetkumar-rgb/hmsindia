<?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3>Transfer Stock List </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/transfer_stock_list'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Item Name </label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item_name;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            <label>Batch Number </label>
                <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $invoice_no;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Transfer Center</label>
                <select class="form-control" id="center_number" name="center_number">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($billing_at == $val['center_number']){
                            echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
                <button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            	<a href="<?php echo base_url().'stocks/transfer_stock_list'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>
        </div>
         <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">

              <thead>

                <tr>

				  <th>S.No.</th>

                  <th>Item Name</th>

                  <th>Batch Number</th>

                  <th>Quantity</th>

                  <th>Transfer Center</th>

                  <th>Transfer Department</th>

                  <th>Receive Center</th>

                  <th>Receive Department</th>

                  <th>Date</th>
                  <th>Remarks</th>
                  <th>Add Stock</th>
                  
				  
				</tr>

              </thead>

              <tbody id="invoice_result">

              <?php foreach($invoice_result as $ky => $vl){ ?>

                <tr class="odd gradeX">

                  <td><?php echo $vl['ID']; ?></td>
                  <td><?php echo $vl['item_name'];?></td>
                  <td><?php echo $vl['batch_number']; ?></td>
				          <td><?php echo $vl['quantity']; ?></td>
				          <td><?php echo $all_method->get_center_name($vl['center_number']); ?></td>	
                  <td><?php echo $vl['department']; ?></td>	
                  <td><?php echo $all_method->get_center_name($vl['r_center_number']); ?></td>
                  <td><?php echo $vl['r_department']; ?></td>					  
				          <td><?php echo $vl['add_date']; ?></td>
                  <td><?php echo $vl['remarks']; ?></td>
                  <?php if($vl['status'] == "0"){ ?>
                  <td><a href="<?php echo base_url(); ?>stocks/update_transfer_item/<?php echo $vl['ID'];?>">Add Stock</a> 
						<a href="javascript:void(0);" class="btn btn-large" onclick="approveOrder('<?php echo $vl['ID'];?>')">Approve</a>
						<a href="<?php echo base_url('stocks/disapprove_transfer_stocks/'.$vl['ID'].'');?>" class="btn btn-large">Disapprove</a>
                  </td>
				  <?php }elseif($vl['status'] == "1"){ ?>
				  <td>Appove</td>
				  <?php }else{ ?>
                  <td>Disappove</td>
                  <?php } ?>
                </tr>
              <?php $count++; } ?>
			   <tr>
                <td colspan="11">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

       <!--End Investigation Tables -->


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
<script type="text/javascript">
    function approveOrder(ID) {
        if (confirm('Are you sure you want to approve this order?')) {
            $.ajax({
                url: '<?php echo base_url('stocks/approve_transfer_stocks/'); ?>' + ID,
                type: 'POST', // Use 'POST' if necessary
                success: function(response) {
                    // Success handling, for example, show an alert and update the UI
                    alert('Order approved successfully!');
                    // Optionally, update the UI (like changing button text or removing the row)
                    // $("#row_" + orderNumber).remove(); // If you want to remove the row
                },
                error: function(xhr, status, error) {
                    // Handle the error, display an error message
                    alert('Something went wrong. Please try again.');
                    console.log(xhr.responseText); // For debugging
                }
            });
        }
    }
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