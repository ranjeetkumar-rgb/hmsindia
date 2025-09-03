 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12 card">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> Medicine Sale Report </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/center_medicine_report'; ?>" method="get">
		  <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="consumables_name" name="consumables_name" value="<?php echo $consumables_name;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/center_medicine_report'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			<div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('stocks/Medicine-Report'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
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
				 <!-- <th>S.No.</th>-->
				  <th>On Date</th>
				  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Receipt number</th>
                  <th>Mode</th>
                  <th>Medicine Name</th>
				  <th>Quantity</th>
				  <th>Open Stock</th>
				  <th>Close Stock</th>
				  <!--<th>Payment Received</th>-->
                </tr>

              </thead>

              <tbody id="investigate_result">
                     
					  
              <?php $count=1; foreach($investigate_result as $vl){
                            $patient_data = get_patient_detail($vl['patient_id']);
    			            $currency = '';
							
						
							
								
                 ?><?php 
  	$data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
	$consumables_total = 0;
	$consumables_discount = 0;
	$consumables_name = 0;
	$consumables_stock = 0;
	$consumables_quantity = 0;
	
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			// echo "<pre>";
			// print_r($row);
			// echo "</pre>";
			//	    exit();
			//$consumables_price = $consumables_price + $row['consumables_price'];
			//$consumables_discount = $consumables_discount + $row['consumables_discount_'];
			//$consumables_total = $consumables_total + $row['consumables_total'];
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $consumables_quantity + $row['consumables_quantity'];
			
			echo '<tr class="odd gradeX"><td>';
			echo $vl['on_date'];
			echo '</td><td>';
			echo $vl['patient_id'];
			echo '</td><td>';
			echo $vl['patient_detail_name'];
			echo '</td><td>';
			 echo $vl['receipt_number'];
			 echo '</td><td>';
			 echo $vl['payment_method'];
			 echo '</td><td>';
			// echo $consumables_name;
			// echo "<pre>abbkk";
			// print_r($medicine_data['consumables_name']);
			// echo "</pre>";
			//	    exit();
			//foreach ($medicine_data['consumables_name'] as $v2_data){
				 $sql1 = "select * from hms_center_stocks where item_number='".$row['consumables_name']."' AND employee_number='".$_SESSION['logged_stock_manager']['employee_number']."'"; 
					// echo $v2_data->medicine_data;
				//	print_r($v2_data);
				//    exit();
                            $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->item_name;
							}
				//		}
			
			  echo '</td><td>';
			echo $consumables_quantity;
			echo '</td><td>';
			 echo $consumables_stock;
			 echo '</td><td>';
			 echo $consumables_stock - $consumables_quantity;
			 echo '</td>';
			
		}
	}
	
	?>
               
              <!--  <tr class="odd gradeX">

                  <td><?php //echo $count; ?></td>
				  <td><?php //echo $vl['on_date']?></td>
                  <td><?php //echo $vl['patient_id']; ?></td>
                  <td><?php //$patient_name = $all_method->get_patient_name($vl['patient_id']); echo strtoupper($patient_name); ?></td>
                  <td><?php //echo $vl['receipt_number']?></td>
                  <td><?php //echo $vl['payment_method']; ?></td>
                  <td><?php //echo $all_method->get_center_name($vl['billing_at']); ?></td>
				  <td> <?php //echo $consumables_name; ?></td>
				  <td><?php //echo $consumables_price; ?></td>
                  <td><?php //echo $consumables_discount; ?></td>
                  <td><?php //echo $consumables_total; ?></td>
                </tr>-->
                 
					 <?php $count++;} ?>
			   <tr>
                <td colspan="10">
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