 <?php $all_method =&get_instance();?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3>Center requisition</h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Item code</th>
                  <th>Item name</th>
				  <th>Batch Number</th>
                  <th>Required quantity (units)</th>
                  <th>Order date</th>
                  <th>Order from</th>
                   <th>Delivery date</th>
                  <th>Delivery status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <?php if($vl['d_status'] == '0'){ ?> <td> <?php echo $vl['item_number']; ?> </td> <?php }else { ?> 
	                  <td><a href="<?php echo base_url(); ?>stocks/details/<?php echo $vl['item_number']?>"><?php echo $vl['item_number']?></a></td>
                  <?php } ?>
                  <td><?php echo $all_method->get_item_name($vl['item_number']); ?></td>
				  <td><?php echo $vl['batch_number']?></td>
                  <td><?php echo $vl['order_quantity']?></td>
                  <td><?php echo $vl['create_date']?></td>
                  <td><?php echo $all_method->get_employee_name($vl['employee_number']); ?></td>
                  <td><?php if($vl['d_status'] == '1'){ echo dateformat($vl['delivery_date']); }?></td>
                  <td><?php 
				  			if($vl['replaced'] == '1' && $vl['cancelled'] == '1'){ echo "Order replaced";}
				  			else if($vl['d_status'] == '0'){
					  		  $csm_stock = $all_method->csm_stock_status($vl['item_number'], $vl['order_quantity']);
							  if($csm_stock == 1){ ?>
                                  <a href="javascript:void(0);" item="<?php echo $vl['item_number']?>" quantity="<?php echo $vl['order_quantity']?>" q_id="<?php echo $vl['ID']?>" class="disaprove_first btn btn-large">Approve order</a>  
                                            <a href="<?php echo base_url(); ?>stocks/add_center_item" class=" btn btn-large">Add Order</a>                                  
						 					 <a href="<?php echo base_url();?>orders/purchase_order/<?php echo $vl['item_number']?>" class="btn btn-large">Purchase order</a>			  
						 <?php }else{ $purchase_status = $all_method->csm_purchase_status($vl['item_number']);  if($purchase_status == 0){ ?>
                                      <a href="<?php echo base_url();?>orders/purchase_order/<?php echo $vl['item_number']?>" class="btn btn-large">Purchase order</a>
                         <?php }else {?>Order placed <?php }} ?>
                     <?php }else{ echo "Dispatched"; } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- End Advanced Tables  -->
      <div class="row" id="disapprove_pop">
            <div class="col-sm-12 disapprove_pop_inner">
            	<a href="javascript:void(0);" class="close_disapprove btn btn-large">close</a>
                <input type="text" class="hidden_field" readonly="readonly" value="" id="item" />
                <input type="text" class="hidden_field" readonly="readonly" value="" id="q_id" />
                <label class="pop_lable">Delivery date</label>
                <p class="error hidden_field"></p>
				<input type="text" class="form-control" value="<?php echo $vl['order_quantity']?>" id="quantity" />
                <input type="text" class="form-control" id="delivery_date" />
                <a href="javascript:void(0);" class="now_disapprove btn btn-large">Submit</a>
            </div>
        </div>
    </div>
      <style>
		.hidden_field{display:none;}
		div#disapprove_pop {
			position: fixed;
			top: 0;
			right: 0;
			left: 0;
			background: rgba(255,255,255,0.6);
			z-index: 999999999;
			height: 100%;
			height: 100%;
			box-shadow: 0px 0px 3px 0px #000;
			display:none;
		}
		.pop_lable {
			width: 100%;
			color: #000!important;
			font-weight: 800;
			font-size: 15px;
			margin-bottom: 10px!important;
		}
		.disapprove_pop_inner {
			width: 50%;
			margin: 80px 25%;
			height: 200px;
			box-shadow: 0px 0px 10px 0px #000;
			background: #fff;
		}
		a.close_disapprove {
			float: right;
			margin-top: 10px;
		}
		a.now_disapprove.btn.btn-large {
			margin: 10px 0px;
		}
	</style>
    <script>
    	$("a.disaprove_first").on("click", function(){
			$('#item').val($(this).attr('item'));
			$('#quantity').val($(this).attr('quantity'));
			$('#q_id').val($(this).attr('q_id'));
			$('div#disapprove_pop').show();
		});
		$("a.close_disapprove").on("click", function(){
			$('#item').val('');
			$('#quantity').val('');
			$('#q_id').val('');
			$('div#disapprove_pop').hide();
		});
		$("a.now_disapprove").on("click", function(){
			var  q_id = $('#q_id').val();
			var  quantity = $('#quantity').val();
			var  item_number = $('#item').val();
			var  delivery_date = $('#delivery_date').val();
			window.location.href = '<?php echo base_url();?>orders/update_order/'+q_id+'?i='+item_number+'&q='+quantity+'&d='+delivery_date+'';
		});
		
		$( function() {
			 $( "#delivery_date" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'yy-mm-dd',
			 });
	   });
    </script>