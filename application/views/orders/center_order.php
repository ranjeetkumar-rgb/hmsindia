 <?php $all_method =&get_instance();?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Center requisition </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
				  <th>Item code</th>
                  <th>Item name</th>
                  <th>Required quantity (units)</th>
                  <th>Order date</th>
				  <th>Batch Number</th>
                  <th>Delivery date</th>
                  <th>Delivery status</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <?php if($vl['status'] == '0'){ ?> <td> <?php echo $vl['item_number']; ?> </td> <?php }else { ?> 
	                  <td><a href="<?php echo base_url(); ?>stocks/cdetail/<?php echo $vl['item_number']?>"><?php echo $vl['item_number']?></a></td>
                  <?php } ?>
                  <td><?php $items_data = $all_method->get_item_name($vl['item_number']); echo  $items_data; ?></td>
                  <td><?php echo $vl['order_quantity']?></td>
                  <td><?php echo $vl['create_date']?></td>
				  <td><?php echo $vl['batch_number']?></td>
                  <td><?php if($vl['d_status'] == '1'){ echo dateformat($vl['delivery_date']); }?></td>
                  <td><?php if($vl['replaced'] == '1' && $vl['cancelled'] == '1'){ echo "Cancelled";}
				  			else if($vl['d_status'] == '0'){echo "Pending";}else{echo "Dispatched"; } ?></td>
                  <td><?php if($vl['replaced'] == '1' && $vl['cancelled'] == '1'){ echo "Order replaced";}
				  			else if($vl['d_status'] == '0'){ ?>Pending<?php }
							else{ 
								$current_date = date("Y-m-d H:i:s");
								$delivery_date = $vl['delivery_date'];
								if($current_date > $delivery_date){
									if($vl['status'] == '0'){?> <a class="btn btn-primary" href="<?php echo base_url();?>orders/update_order_item/<?php echo $vl['item_number']?>">Add to stock</a> <?php }else{echo "Received"; } }else {echo "en route";} }?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>