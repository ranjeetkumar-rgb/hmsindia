 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12 card">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3>Cash Medicine Revenue Reports</h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/medicine_origin'; ?>" method="get">
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
			<div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>Medicine Name</label>
                <input type="text" class="form-control" id="json_data" name="json_data" value="<?php echo $data;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/medicine_origin'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
			<div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('stocks/Medicine-Stock'); ?>" style="text-decoration: none;">
                <button name="export-medicine" type="submit"  class="btn btn-secondary" id="export-medicine">Export Billings</button>
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
                  <th>Center Of Billing</th>
				  <th>Center Of Origin</th>
				  <th>Medicine Name</th>
				  <th>Batch Number</th>
				  <th>Quantity</th>
				  <th>Opening Stock</th>
				  <th>Closing Stock</th>
				  <th>Total Aount</th>
				  <th>Discount Amount</th>
				  <th>Rceive Amount</th>
				  <th>Expiry Date</th>
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
	$consumables_discount_ = 0;
	$consumables_total = 0;
	$consumables_name = 0;
	$consumables_stock = 0;
	$consumables_quantity = 0;
    $consumables_expiry = 0;	
	
	if(!empty($vl['data'])){
		$data_arr = unserialize($vl['data']);
		if(!empty($data_arr['data']['consumables'])){
			$consumables_arr = $data_arr['data']['consumables'];
		}
	}
	if(!empty($consumables_arr)){
		foreach ($consumables_arr as $row){
			$consumables_price = $consumables_price + $row['consumables_price'];
			$consumables_discount_ = $consumables_discount_ + $row['consumables_discount_'];
			$consumables_name = $consumables_name + $row['consumables_name'];
			$consumables_expiry = $row['consumables_expiry'];
			$consumables_stock = $row['consumables_stock'];
			$consumables_quantity = $row['consumables_quantity'];
			$consumables_total_ = $row['consumables_total_'];
			
			echo '<tr class="odd gradeX"><td>';
			echo $vl['on_date'];
			echo '</td><td>';
			echo $vl['patient_id'];
			echo '</td><td>';
			echo $vl['patient_detail_name'];
			echo '</td><td>';
			echo $all_method->get_employee_name($vl['employee_number']); 
			 echo '</td><td>';
					    $sql2 = "Select DISTINCT wife_phone from ".$this->config->item('db_prefix')."appointments where paitent_id='".$vl['patient_id']."'"; 
			            $select_result2 = run_select_query($sql2); 
							$sql3 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result2['wife_phone']."' and paitent_type='new_patient'"; 
			                $select_result3 = run_select_query($sql3); 
						        $sql4 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result3['appoitment_for']."'"; 
			                    $select_result = run_select_query($sql4); 
                                echo $select_result['center_name']; 
							
			echo '</td><td>';
			  $sql1 = "Select DISTINCT item_name from ".$this->config->item('db_prefix')."center_stocks where item_number='".$row['consumables_name']."'"; 
					    $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->item_name;
							}
			
			  echo '</td><td>';
			 $sql1 = "Select DISTINCT item_name, batch_number from ".$this->config->item('db_prefix')."center_stocks where item_number='".$row['consumables_name']."' limit 1"; 
					 $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
								 echo '<br/>';
								 echo $res_val->batch_number;
							}
			  echo '</td><td>';
			  echo $consumables_quantity;
			  echo '</td><td>';
			  echo $consumables_stock;
			  echo '</td><td>';
			  echo $consumables_stock - $consumables_quantity;
			  echo '</td><td>';
			  echo $consumables_price;
			  echo '</td><td>';
			  echo $consumables_discount_;
			  echo '</td><td>';
			  echo $consumables_total_;
			  echo '</td><td>';
			  echo $consumables_expiry;
			  echo '</td></tr>';
			
		}
	}
	
	?>
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