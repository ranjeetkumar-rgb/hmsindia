 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12 card">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3>All Consumption Report </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/all_consumption'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
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
			<!--<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="data" name="data" value="<?php echo $data;?>" />
            </div>-->
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/all_consumption'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			<!--<div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('stocks/Medicine-Stock'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
               </a>
            </div>-->
            </form>
        </div>
		<div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">
              <thead>
                <tr>
				  <th>On Date</th>
				  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Center</th>
				  <th>Medicine Name</th>
				  <th>Quantity</th>
				  <th>Opening Stock</th>
				  <th>Closing Stock</th>
				  <th>Total Aount</th>
				</tr>
              </thead>

              <tbody id="investigate_result">	  
    <?php
	foreach($investigate_result as $vl){
		
    $patient_data = get_patient_detail($vl['patient_id']);
    $currency = '';								
    $data_arr = array();
	$consumables_arr = array();
	$consumables_price = 0;
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
			//var_dump($row); die;
			$consumables_price = $row['consumables_price'];
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_stock = $consumables_stock + $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			$consumables_total_ = $row['consumables_total_'];
			echo '<tr class="odd gradeX">';
			echo '<td>';
			echo $vl['add_on'];
			echo '</td><td>';
			echo $vl['patient_id'];
			echo '</td>';
			echo '<td>';
			$sql2 = "Select DISTINCT wife_name from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."' limit 1"; 
			$query2 = $this->db->query($sql2);
            $select_result2 = $query2->result(); 
			foreach ($select_result2 as $res_val){
			echo '<br/>';
			echo $res_val->wife_name;
			}
			echo '</td><td>';
			echo $all_method->get_center_name($vl['center_number']);
			echo '</td><td>';
			$sql1 = "Select DISTINCT item_name from ".$this->config->item('db_prefix')."center_stocks where item_number='".$row['consumables_name']."'"; 
			$query = $this->db->query($sql1);
            $select_result1 = $query->result(); 
			foreach ($select_result1 as $res_val2){
			echo '<br/>';
			echo $res_val2->item_name;
			}
			echo '</td><td>';
			echo $consumables_quantity;
			echo '</td><td>';
			echo $consumables_stock;
			echo '</td><td>';
			echo $consumables_stock - $consumables_quantity;
			echo '</td><td>';
			echo $consumables_price;
			echo '</td>';
		}
	}else{
		echo '<tr class="odd gradeX">';
		echo '<td>';
		echo $vl['add_on'];
		echo '</td><td>';
		echo $vl['patient_id'];
		echo '<td></td><td>';
		echo $all_method->get_center_name($vl['center_number']);
		echo '</td>';
		echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
	}
	$count++;}
?>              
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