<?php  $all_method =&get_instance();

$consultation_sql = "SELECT * FROM hms_patient_procedure WHERE billing_at='".$_SESSION['logged_billing_manager']['center']."' ORDER BY po_id DESC LIMIT 1 ";
$select_result = run_select_query($consultation_sql); 

$date=date_create("2024-07-25");
if (date_format($date,"m") >= 4) {//On or After April (FY is current year - next year)
    $financial_year = (date_format($date,"y")) . '-' . (date_format($date,"y")+1);
} else {//On or Before March (FY is previous year - current year)
    $financial_year = (date_format($date,"y")-1) . '-' . date_format($date,"y");
}


 $form_action = $billing_type = "";
 //var_dump($billing_details);die;

 if($billing_details['investation_suggestion'] == 1 && $billing_details['investigation_billed'] == 0 && $_GET['t'] == "investigation_billing"){
  $form_action = "add_investigations";
  $billing_type = "investigation";
// }else if($billing_details['procedure_suggestion'] == 1 && $billing_details['procedure_billed'] == 0 && $_GET['t'] == "procedure_billing"){
 }else if($billing_details['procedure_suggestion'] == 1 && $_GET['t'] == "procedure_billing"){
  $form_action = "add_procedure";
  $billing_type = "procedure";
 }else if($billing_details['package_suggestion'] == 1 && $_GET['t'] == "package_billing"){
  $form_action = "add_package";
  $billing_type = "package"; 
 }else{
    header("location:" .base_url(). "after-consultation?m=".base64_encode('oops, something went wrong!').'&t='.base64_encode('error'));
    die();
 }
 $grand_total = 0;
 $patient_data = get_patient_detail($billing_details['patient_id']);
?>
<?php 
	    $ci = &get_instance();
		$ci->load->database();
		$db_prefix = $ci->config->config['db_prefix'];
		$patient_sql = "Select * from ".$db_prefix."patients where  patient_id='".$billing_details['patient_id']."'";
        $patient_q = $ci->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		$patient_id = $patient_result[0]['patient_id'];

		$consultation_result = $procedure_result = $investigation_result = $medicine_result = $remaining_billing = $bill_arr = $bill_total = array();
		$procedure_sql = "Select receipt_number, payment_done, wallet_payment, fees, remaining_amount, billing_from, billing_at from ".$db_prefix."patient_procedure where status='cancel' and patient_id='".$billing_details['patient_id']."'";
        $procedure_q = $ci->db->query($procedure_sql);
        $procedure_result = $procedure_q->result_array();

		$consultation_sql = "Select receipt_number, payment_done, wallet_payment, fees, remaining_amount, billing_from, billing_at from ".$db_prefix."consultation where status='adjust' and patient_id='".$billing_details['patient_id']."'";
        $consultation_q = $ci->db->query($consultation_sql);
        $consultation_result = $consultation_q->result_array();

		$investigation_sql = "Select receipt_number, payment_done, wallet_payment, fees, remaining_amount, billing_from, billing_at from ".$db_prefix."patient_investigations where status='cancel' and patient_id='".$billing_details['patient_id']."'";
        $investigation_q = $ci->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
		
		$medicine_sql = "Select receipt_number, payment_done, fees, remaining_amount, billing_at from ".$db_prefix."patient_medicine where status='cancel' and patient_id='".$billing_details['patient_id']."'";
        $medicine_q = $ci->db->query($medicine_sql);
        $medicine_result = $medicine_q->result_array();

		$total = 0;

        $done_sql = "Select sum(payment_done) as payment_done from ".$db_prefix."patient_payments where patient_id='".$billing_details['patient_id']."' AND status='3'";
		$done_q = $ci->db->query($done_sql);
		$done_result = $done_q->result_array();

    	foreach($consultation_result as $key => $val){
		    $bill_arr[] = $val['payment_done'];
		}

		$total = 0;
		foreach($investigation_result as $key => $val){
		    $bill_arr[] = $val['payment_done'];
		}

		$total = 0;
		foreach($procedure_result as $key => $val){
			$bill_arr[] = $val['payment_done'];
		}
		
		$total = 0;
		foreach($medicine_result as $key => $val){
			$bill_arr[] = $val['payment_done'];
		}
		
		foreach($done_result as $key => $val){
			$bill_arr[] = $val['payment_done'];
		}

        //wallete
		$consultation_wallet_result = $procedure_wallet_result = $investigation_wallet_result = $partialpayments_wallet_result = $medicine_wallet_result = $wallet_remaining_billing = $wallet_arr = $wallet_bill_total = array();
		$procedure_wallet_sql = "Select receipt_number, payment_done, wallet_payment, fees, remaining_amount, billing_from, billing_at from ".$db_prefix."patient_procedure where wallet_payment > 0 and patient_id='".$billing_details['patient_id']."'";
        $procedure_wallet_q = $ci->db->query($procedure_wallet_sql);
        $procedure_wallet_result = $procedure_wallet_q->result_array();

		$consultation_wallet_sql = "Select receipt_number, payment_done, wallet_payment, fees, remaining_amount, billing_from, billing_at from ".$db_prefix."consultation where wallet_payment > 0 and patient_id='".$billing_details['patient_id']."'";
        $consultation_wallet_q = $ci->db->query($consultation_wallet_sql);
        $consultation_wallet_result = $consultation_wallet_q->result_array();

		$investigation_wallet_sql = "Select receipt_number, payment_done, wallet_payment, fees, remaining_amount, billing_from, billing_at from ".$db_prefix."patient_investigations where wallet_payment > 0 and patient_id='".$billing_details['patient_id']."'";
        $investigation_wallet_q = $ci->db->query($investigation_wallet_sql);
        $investigation_wallet_result = $investigation_wallet_q->result_array();

        $partialpayments_wallet_sql = "Select refrence_number, payment_done, wallet_payment, billing_from, billing_at from ".$db_prefix."patient_payments where wallet_payment > 0 and patient_id='".$billing_details['patient_id']."'";
        $partialpayments_wallet_q = $ci->db->query($partialpayments_wallet_sql);
        $partialpayments_wallet_result = $partialpayments_wallet_q->result_array();
		
		//$medicine_wallet_sql = "Select receipt_number, payment_done, fees, remaining_amount, billing_at from ".$db_prefix."patient_medicine where wallet_payment > 0 and patient_id='".$billing_details['patient_id']."'";
        //$medicine_wallet_q = $ci->db->query($medicine_wallet_sql);
        //$medicine_wallet_result = $medicine_wallet_q->result_array();
		
		foreach($consultation_wallet_result as $key => $value){
			$wallet_arr[] = $value['wallet_payment'];
		}

		$total = 0;
		foreach($investigation_wallet_result as $key => $value){
			$wallet_arr[] = $value['wallet_payment'];
		}

		$total = 0;
		foreach($procedure_wallet_result as $key => $value){
			$wallet_arr[] = $value['wallet_payment'];
		}
		
		$total = 0;
		foreach($medicine_wallet_result as $key => $value){
			$wallet_arr[] = $value['wallet_payment'];
		}

    $total = 0;
		foreach($partialpayments_wallet_result as $key => $value){
			$wallet_arr[] = $value['wallet_payment'];
		}
		
		foreach($done_wallet_result as $key => $value){
			$wallet_arr[] = $value['wallet_payment'];
		}
		
		$paid_total = 0;
		$paid_total = array_sum($bill_arr);

        $wallet_bill_total = 0;
		$wallet_bill_total = array_sum($wallet_arr);
		
		$balance = $paid_total - $wallet_bill_total;
		?>
		
<style type="text/css">
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
		border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>

<form class="col-sm-12 col-xs-12" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="action" value="<?php echo $form_action; ?>" />
  <input type="hidden" name="appointment_id" value="<?php echo $billing_details['appointment_id']; ?>" />
  <input type="hidden" name="consultation_done" value="<?php echo $billing_details['ID']; ?>" />
  <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $billing_details['patient_id']; ?>" />
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  <input type="hidden" id="billing_type" value="<?php echo $billing_type; ?>" />
  <input type="hidden" name="biller_id" value="<?php echo $_SESSION['logged_billing_manager']['employee_number']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      <div class="panel-heading">
        <h3 class="heading">Billing Details</h3>  <p style="margin-top:20px;color:red;">Wallets Amount : <a href="<?php echo base_url(); ?>patients/edit/<?php echo $billing_details['patient_id']; ?>"><?php echo $balance; ?></a></p>
      </div>
	  
	  <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">     
          <?php if($billing_type == "investigation") { ?>
           <div class="form-group col-sm-6 col-xs-12 role">
               <label for="item_name">Paramedic Name (Required)</label>
                <input value="" placeholder="Paramedic Name" id="paramedic_name" name="paramedic_name" type="text" class="form-control " required>
            </div>
			
          <?php } ?>
		  <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <input value="<?php echo getReceiptGUID(); ?>" placeholder="Receipt number" readonly="readonly" id="receipt_number" name="receipt_number" type="text" class="form-control " required>
				
           </div>
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date(Required)</label>
                <input value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Date" readonly="readonly" id="on_date" name="on_date" type="text" class="form-control " required>
           </div>
         </div>
        
		   <?php if($form_action == "add_package"){ ?>
       	 <div class="row">
         	 <?php //var_dump($billing_details);die;
           if($billing_details['package_suggestion'] == 1 ){ $parent_procedure_details = $all_method->get_procedure_details($billing_details['package_suggestion_list']); 
		   ?>
                <input type="hidden" name="package_suggestion" value="<?php echo $billing_details['package_suggestion']; ?>" />
		        <input type="button" class="delete-investigations-row btn btn-large pull-right" value="Delete Selected Package">
                    <h4>Package</h4>
                     <table id="package_table">
                        <thead>
                          <tr>
						    <th>Procedure</th>
                            <th>Code</th>
                            <th>Price</th>
                			<th>Paid Price</th>
							<th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
            <?php 	
$sub_procedure_counter = 1;

// Unserialize package suggestion list once
if (!empty($billing_details['package_suggestion_list'])) {
    $package_suggestion_list = unserialize($billing_details['package_suggestion_list']);

    foreach ($package_suggestion_list as $key => $val) {
        // Convert comma-separated values into an array
        $procedure_ids = explode(',', $val);

        foreach ($procedure_ids as $procedure_id) {
            // Fetch procedure details
            $sub_procedure_details = $all_method->get_procedure_details($procedure_id);

            if (!$sub_procedure_details) {
                continue; // Skip if no details found
            }
            ?>
            <tr>
                <td><?php echo $sub_procedure_details['procedure_name']; ?>
                    <input value="<?php echo $procedure_id; ?>" procedure="<?php echo $sub_procedure_details['procedure_name']; ?>" readonly="readonly" id="sub_procedure_<?php echo $sub_procedure_counter;?>" class="required_value" name="sub_procedure_<?php echo $sub_procedure_counter;?>" type="hidden" class="form-control " required>
                </td>
                <td><?php echo $sub_procedure_details['code']; ?>
                    <input value="<?php echo $sub_procedure_details['code']; ?>" readonly="readonly" id="sub_procedures_code_<?php echo $sub_procedure_counter;?>" class="required_value" name="sub_procedures_code_<?php echo $sub_procedure_counter;?>" type="hidden" class="form-control " required>
                </td>
                <td>
                    <?php 
                    $sub_price = $sub_procedure_details['price']; 
                    echo 'Rs. ' . $sub_price; 
                    ?>
                    <input value="<?php echo $sub_price; ?>" readonly="readonly" id="sub_procedures_price_<?php echo $sub_procedure_counter;?>" class="required_value" name="sub_procedures_price_<?php echo $sub_procedure_counter;?>" type="hidden" class="form-control " required>
                </td>
				<td><input value="0" placeholder="Discount" id="sub_procedures_discount_<?php echo $sub_procedure_counter;?>" class="sub_procedures_discount required_value" name="sub_procedures_discount_<?php echo $sub_procedure_counter;?>" type="text" class="form-control " required sub_procedures_price="<?php echo $sub_price; ?>" ></td>
                <td><input value="0" placeholder="Paid Price" id="sub_procedures_paid_price_<?php echo $sub_procedure_counter;?>" class="sub_procedures_paid_price required_value" name="sub_procedures_paid_price_<?php echo $sub_procedure_counter;?>" type="text" class="form-control " required sub_procedures_price="<?php echo $sub_price; ?>" ></td>
                <td><input type="checkbox" class="statuss" name="record"></td>
            </tr>
            <?php  
            $grand_total += $sub_price;
            $sub_procedure_counter++;
        }
    }
} 
?>

			  
			      </tbody>
              </table>
			<?php } ?>
         </div>
          <?php } ?>

        <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment in(Required)</label><br/>
                <input value="rs_payment" name="payment_in" style="position: relative;left: 0;opacity: 1;" class="payment_in" type="radio"> Rupees
                <?php if($patient_data['nationality'] == 'non-indian'){ ?>      
                <input value="us_payment" style="position: relative;left: 0;opacity: 1;" class="payment_in" name="payment_in" type="radio"> USD
                <?php } ?>
          </div>
        </div>  
          

        <div class="row" id="grand_total_section" style="display:none;">
          <div class="row">
              <div class="form-group col-sm-6 col-xs-12 role">
                    <label for="statuss">Payment mode (Required)</label>
                    <select name="payment_method" id="payment_method" required>
					 <option value="">Select</option>
					  
                        <?php if($patient_data['nationality'] == 'indian'){?>
                        <option value="neft" mode="NEFT">NEFT</option>
                        <option value="rtgs" mode="RTGS">RTGS</option>
                        <option value="card" mode="Card">Card</option>
                        <option value="insurance" mode="Insurance">Insurance</option>
                        <?php }else{ ?>
                          <option value="international_card" mode="International Card">International Card</option>
						  <option value="card" mode="Card">Card</option>
                        <?php } ?>
                        <option value="cash" mode="Cash">Cash</option>
                        <option value="cheque" mode="Cheque">Cheque</option> 
                        <option value="upi" mode="UPI">UPI</option>
                        <option value="wallet" mode="Wallet">Wallet</option>
                        <option value="Finance" mode="Finance">Finance</option>						
                    </select>
                </div>
              <div class="form-group col-sm-6 col-xs-12" id="subvention_box" style="display:none;">
                <label for="item_name">Subvention charges (Required)</label>
                <input value="" placeholder="Subvention charges" id="subvention_charges" name="subvention_charges" type="text" class="form-control validate">
              </div>
          </div>     

        <?php if($patient_data['nationality'] == 'non-indian'){ ?>      
          <div class="row">      
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Grand Total (USD) (Required)</label>
                  <input value="<?php echo round($grand_total/$converstion_rate, 2); ?>" name="usd_totalpackage" placeholder="grand total" readonly="readonly" class="usd_dhee required_value" id="usd_fees" type="hidden" class="form-control " required>
                  <input value="<?php echo round($grand_total/$converstion_rate, 2); ?>" placeholder="grand total" readonly="readonly" name="usd_fees" id="usd_after_discount" type="text" class="form-control required_value" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Discount (USD) (Required)3</label>
                <input value="0" readonly="readonly" name="us_discount" id="us_discount" type="text" class="form-control required_value" required>
               
			</div>
          </div>
          <?php } ?>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Grand Total (Rupee) (Required)</label>
                  <input value="<?php echo $grand_total; ?>" name="rs_fees" placeholder="grand total" readonly="readonly" class="required_value" id="rs_after_discount" type="hidden" class="rs_dhee form-control required_value" required>
                  <input value="<?php echo $grand_total; ?>" placeholder="grand total" readonly="readonly" name="rs_totalpackage" id="rs_totalpackage" type="text" class="form-control" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Discount (Rupee) (Required)</label>
                  <input value="0" readonly="readonly" name="rs_discount" id="rs_discount" type="text" class="form-control required_value" required>
                  <?php 
				      $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$billing_details['wife_phone']."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
						?>
						<input value="<?php echo $res_val->appoitment_for;?>" placeholder="origins" readonly="readonly" name="origins" id="origins" type="hidden" class="form-control">
           		<?php } ?>
		   </div>
          </div>

            <div class="row">            
              <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Discount amount</label>
                  <input value="0" placeholder="Discount amount" id="discount_amount" readonly="readonly" name="discount_amount" type="text" class="form-control required_value" required>
                  <input value="<?php echo $_SESSION['logged_billing_manager']['allow_discount_rs'] ;?>" id="allow_discount" type="hidden" class="form-control " required>
                  <p id="show_disc_app" style="display:none;">Given discount is more than allowed, <a href="javascript:void(0);" accountant="<?php echo $_SESSION['logged_billing_manager']['username'];?>" id="get_discount_approval">click here</a> for admin approval.</p>
                </div>
              
              <div class="form-group col-sm-6 col-xs-12">
                    <label for="item_name">Payment received (Required)</label>
                    <input value="" placeholder="Payment received" id="payment_done" step="any" name="payment_done" type="number" class="form-control required_value" required>
              </div>
            </div>   
          
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Remaining amount (Required)</label>
                  <input value="" placeholder="Remaining amount" readonly="readonly" id="remaining_amount" name="remaining_amount" type="text" class="form-control required_value" required>
                </div>
			    <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Cash Payment</label>
                  <input value="" placeholder="Cash Payment" id="cash_payment" name="cash_payment" type="text" class="form-control ">
                </div>
				<div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Card Payment</label>
                  <input value="" placeholder="Card Payment" id="card_payment" name="card_payment" type="text" class="form-control ">
                </div>
				<div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">UPI Payment</label>
                  <input value="" placeholder="UPI Payment" id="upi_payment" name="upi_payment" type="text" class="form-control ">
                </div>

                <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">NEFT Payment</label>
                  <input value="" placeholder="NEFT Payment" id="neft_payment" name="neft_payment" type="text" class="form-control ">
                </div>
				<div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Wallet Payment</label>
				  <input type="number" wallet_payment="<?php echo $balance; ?>" name="wallet_payment" id="wallet_payment" onchange="consumables_quantity_update(this)">
                </div>
            </div>  

            <div class="row">
                <div class="form-group col-sm-6 col-xs-12" id="transaction" style="display:none;">
                  <label for="item_name">Reference no. (Optional)</label>
                  <input value="" placeholder="Reference no." id="transaction_id" name="transaction_id" type="text" class="form-control  required_value" required>
                  <label>Upload screenshot/document here</label>
                  <input type="file" class="required_value" name="transaction_img" id="transaction_img"  />
                </div>
            </div>

            <div class="row">            
                <div class="form-group col-sm-6 col-xs-12 role" style="display:none;">
                    <label for="statuss">Billing source (Required)</label>
					<input type="hidden" value="16249589462327" class="required_value" name="billing_from" id="billing_from"  />
                    
				</div>
                  <div class="form-group col-sm-6 col-xs-12 hospital_id_section role">
                  <label for="item_name">Center Source</label>
                  <select name="hospital_id" class="required_value" id="hospital_id" required>
                        <option value="">Select</option>
                        <option value="Noida">Noida</option> 
                        <option value="Gurgaon">Gurgaon</option> 
                        <option value="Green Park">Green Park</option> 
                        <option value="Srinagar">SRINAGAR</option> 
                        <option value="Ghaziabad">Ghaziabad</option> 
                    </select>
				  
                </div>
            </div>
			
			
            
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Billing ID (Optional)</label>
                  <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control ">
                </div>
			
				<div class="form-group col-sm-6 col-xs-12 role" style="display:none;">
                <label for="statuss">Billing source (Required)</label>
				
				<?php if($billing_type == "procedure") { ?>
					<?php if($_SESSION['logged_billing_manager']['center'] == "16249589462327" ) {  ?>
						<input value="001/P/<?php echo $financial_year; ?>/" id="series_number" name="series_number" type="hidden" class="form-control validate">
					<?php  } ?>	
                	<?php if($_SESSION['logged_billing_manager']['center'] == "16266778858144" ) {  ?>
						<input value="002/P/<?php echo $financial_year; ?>/" id="series_number" name="series_number" type="hidden" class="form-control validate">
					<?php  } ?>	
					<?php if($_SESSION['logged_billing_manager']['center'] == "16267558222750" ) {  ?>
						<input value="003/P/<?php echo $financial_year; ?>/" id="series_number" name="series_number" type="hidden" class="form-control validate">
					<?php  } ?>	
					<?php if($_SESSION['logged_billing_manager']['center'] == "16098223739590" ) {  ?>
						<input value="004/P/<?php echo $financial_year; ?>/" id="series_number" name="series_number" type="hidden" class="form-control validate">
					<?php  } ?>
                    <?php if($_SESSION['logged_billing_manager']['center'] == "16133769691598" ) {  ?>
						<input value="005/P/<?php echo $financial_year; ?>/" id="series_number" name="series_number" type="hidden" class="form-control validate">
					<?php  } ?>	
                    <?php if($_SESSION['logged_billing_manager']['center'] == "1581157290" ) {  ?>
						<input value="006/P/<?php echo $financial_year; ?>/" id="series_number" name="series_number" type="hidden" class="form-control validate">
					<?php  } ?>	
          <input type="hidden" value="<?php echo $select_result['po_id'] + 1; ?>" id="po_id" name="po_id"  >									
				<?php } ?>
            </div>
			
            </div>
            
            <div class="clearfix"></div>
            <div class="form-group col-sm-12 col-xs-12">
                <a class="btn btn-large" id="create_billing" href="javascript:void(0);">Create Billing</a>
            </div>
          </div>
        </div>
      </p>
    </div>
    
    <div class="col-sm-12 col-xs-12 panel panel-piluku" style="display:none;" id="consultation_preview">
      <div class="panel-heading">
        <h3 class="heading">Billing Summary</h3>
      </div>
      <div class="panel-body profile-edit">
      <p id="msg_area" class="delete"></p>
        <p>
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Paramedic (Required)</label>
                <p id="paramedic_text"></p>
            </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Date (Required)</label>
                <p id="on_date_text"><?php echo date("Y-m-d H:i:s"); ?></p>
           </div>
         </div>
         
         <div class="row investigation_preview_table">
              <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Price</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody id="investigation_preview_table_body"></tbody>
            </table>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <p id="receipt_number_text"><?php echo getReceiptGUID(); ?></p>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Fees (Required)</label>
                <p id="fees_text"></p>
                <p> Discount : <span id="discount_text"></span></p>
           </div>
         </div>
         
         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Payment received (Required)</label>
                <p id="payment_done_text"></p>
           </div>
           
           <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Remaining amount (Required)</label>
                <p id="remaining_amount_text"></p>
           </div>
         </div>        
        
        <div class="row">            
           <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Payment mode (Required)</label>
                <p id="payment_method_text"></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12 role">
                <label for="statuss">Transaction ID(Required)</label>
                <p id="transaction_id_text"></p>
				
				 
				
            </div>
         </div>
        	
         <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
               <label for="item_name">Billing ID</label>
                <p id="billing_id_text"></p>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                   <label for="item_name">Hospital ID</label>
                    <p id="hospital_id_text"></p>
            </div>
          </div>
          
         <div class="clearfix"></div>
	     <div class="form-group col-sm-12 col-xs-12">
            <a class="btn btn-large" id="edit_billing" href="javascript:void(0);">Edit Billing</a>
            <input type="submit" id="submitbutton" class="btn btn-large" value="Create Billing" />
         </div>
      </div>
      </p>
    </div>
  </div>
</form>


<script type="text/javascript">
  $(document).on('change',".payment_in",function(e) {
      $('#remaining_amount').val('');
      var payment_in = $(this).val();
      
      var billing_type = $('#billing_type').val();
      if(billing_type == 'investigation'){
          var medicine_sub_total = parseFloat($('#medicine_sub_total').val()) || 0;
          var actual_investigation_sub_total = parseFloat($('#investigation_sub_total').val()) || 0;
          var medicine_plus_investigation = parseFloat(medicine_sub_total) + parseFloat(actual_investigation_sub_total);
          var medicine_plus_investigation_usd = (medicine_plus_investigation/<?php echo $converstion_rate; ?>).toFixed(2);
          $('.usd_dhee').val(parseFloat(medicine_plus_investigation_usd));
          $('.rs_dhee').val(parseFloat(medicine_plus_investigation));
          $('#usd_after_discount').val(parseFloat(medicine_plus_investigation_usd));
          $('#rs_after_discount').val(parseFloat(medicine_plus_investigation));
           $('#rs_totalpackage').val(parseFloat(medicine_plus_investigation));
       
      }
      
      cal_discount(payment_in);
      $('#grand_total_section').show();
  });

  function cal_discount(payment_in){
   // alert('function cal dis');
    $('#payment_done').val('');
		$('#remaining_amount').val('');
    var fees_amount = 0; var after_cal_price = 0;
    var allowd = $('#allow_discount').val();
  
    if(payment_in == 'us_payment'){
      $("#discount_amount").val($('#us_discount').val());
      fees_amount = parseFloat($('.usd_dhee').val());
      after_cal_price = ( fees_amount * allowd / 100 ).toFixed(2);
    }else{
      $("#discount_amount").val($('#rs_discount').val());
      fees_amount = parseFloat($('#rs_after_discount').val());

      console.log('fees_amount======================'+fees_amount);
      after_cal_price = ( fees_amount * allowd / 100 ).toFixed(2);
    }
    var discount_amount = parseFloat($("#discount_amount").val());
		
    //alert('fees_amount='+fees_amount+'-----------allowd='+allowd+'--------discount_amount='+discount_amount+'-----after='+after_cal_price);
    var medicin_price = $("#medicine_sub_total").val();

		if(discount_amount > allowd){
          if(payment_in == 'us_payment'){
            $('#usd_after_discount').val(parseFloat(fees_amount));
          }else{
            $('#rs_after_discount').val(parseFloat(fees_amount));
            $('#rs_totalpackage').val(parseFloat(fees_amount) + parseFloat(discount_amount));
          }				
			$('#show_disc_app').show();
			$('#create_billing').hide();
		}else{
    		//var remaining_amount =  fees_amount - discount_amount;
        var remaining_amount =  fees_amount;
    // 		alert(remaining_amount);
			if(remaining_amount < 1){
				$('#payment_done').val(' ');
				$('#rs_after_discount').val(' ');
        $('#usd_after_discount').val(' ');
				$("#discount_amount").val(' ');
				$('.investigation_discount').val(' ');
			}else{
          if(payment_in == 'us_payment'){
            $('#usd_after_discount').val(remaining_amount.toFixed(2));
          }else{
            $('#rs_after_discount').val(remaining_amount.toFixed(2));
            $('#rs_totalpackage').val(parseFloat(remaining_amount.toFixed(2)) + parseFloat(discount_amount));
          }
			}
			$('#show_disc_app').hide();
			$('#create_billing').show();
		}
  }

  $(document).on('keyup',"#payment_done",function(e) {
      var payment_in = $('.payment_in:checked').val();
      var fees = 0;
      if(payment_in == 'us_payment'){
        fees = parseFloat($('#usd_after_discount').val());
      }else{
        fees = parseFloat($('#rs_after_discount').val());
      }
      $('#remaining_amount').val(0);
      var payment_done = $(this).val();
      var remaining_amount = fees-payment_done;
      $('#remaining_amount').val(remaining_amount.toFixed(2));
  });

  $(document).on('change',"#payment_method",function(e) {
    <?php if($patient_data['nationality'] == 'indian'){ ?> 
      $('#subvention_charges').val("");
      $('#subvention_charges').removeClass('required_value');
      $('#subvention_box').hide();
      
    <?php } ?>

    $('#remaining_amount').val("");
    $('#payment_done').val("");

    $('#transaction_id').prop('required',false);
	$('#transaction_img').prop('required',false);
    $('#transaction_id').empty();
    var method = $(this).val();
    $('#transaction_id').removeClass('required_value');
	$('#transaction_img').removeClass('required_value');
    if(method == 'cash'){
        $('#transaction_id').removeClass('required_value');
		$('#transaction_img').removeClass('required_value');
    }
		if(method == ''){
			 $('#transaction_id').prop('required',false);
			 $('#transaction_img').prop('required',false);
			 $('#transaction').hide();		
		}else{
			 $('#transaction_id').prop('required',false);
			 $('#transaction_img').prop('required',false);
			 $('#transaction').show();
		}
    if(method == "insurance"){
      $('#subvention_charges').addClass('required_value');
      $('#subvention_box').show();
    }
  });

   <?php if($_GET['t'] == "procedure_billing"){ ?>
    
    $(document).on('click',"#create_billing",function(e) {
      var value = $('.required_value').filter(function () {
        return this.value === '';
      });
      if (value.length == 0) {
        $('#msg_area').empty(); $('#doctor_id_text').empty(); $('#fees_text').empty(); $('#payment_done_text').empty(); 
        $('#remaining_amount_text').empty(); $('#payment_method_text').empty(); $('#investigation_preview_table_body').empty();
        $('#billing_id_text').empty(); $('#investigation_id_text').empty(); $('#hospital_id_text').empty(); $('#discount_text').empty();

        var male_countr = 1;
        var procedure_table_tr= $('#procedure_table tbody tr').length;
        console.log("procedure_table_tr="+procedure_table_tr);
        
        $('#procedure_table tbody tr').each(function(){
          if(male_countr <= procedure_table_tr){
              var investigationname, investigation_code, investigationprice, investigation_discount = '';
              investigationname = $('#sub_procedure_'+male_countr).attr('procedure');
              investigation_code = $('#sub_procedures_code_'+male_countr).val();
              investigationprice = $('#sub_procedures_price_'+male_countr).val();
              investigation_discount = $('#sub_procedures_discount_'+male_countr).val();

              $('#investigation_preview_table_body').append('<tr><td class="role">'+investigationname+'</td><td>'+investigation_code+'</td><td>'+investigationprice+'</td><td>'+investigation_discount+'</td></tr>');
              male_countr++;
          }
        });

        var doctor = $('#doctor_id').val();
        var payment_done = $('#payment_done').val();
        var payment_method = $('#payment_method').val();
        var paramedic_name =  $('#paramedic_name').val();
      
        var transaction_id = $('#transaction_id').val();
        var transaction_img = $('#transaction_img').val();
        if(doctor == '' || payment_done == '' || payment_method == '' || paramedic_name==''){
          $('#msg_area').append('One or more fields are empty !')
        }else{
          var after_discount = 0;
          var payment_in = $('.payment_in:checked').val();
          if(payment_in == "us_payment"){
            after_discount = parseFloat($("#usd_after_discount").val());
          }else{
            after_discount = parseFloat($("#rs_after_discount").val());
          }
          $('#fees_text').empty().append(after_discount);
          $('#payment_done_text').empty().append($('#payment_done').val());
          $('#remaining_amount_text').empty().append($('#remaining_amount').val());
          $('#transaction_id_text').empty().append($('#transaction_id').val());
          $('#payment_method_text').empty().append($('#payment_method').find(':selected').attr('mode'));
          $('#billing_id_text').empty().append($('#billing_id').val());
          $('#discount_text').empty().append($('#discount_amount').val());
          $('#hospital_id_text').empty().append($('#hospital_id').val());
          $('#consultation_details').hide();
          $('#consultation_preview').show();
        }

      }else if (value.length > 0) { alert('Please fill out all fields.'); }
    });
  <?php } ?>

    $(document).on('click',"#edit_billing",function(e) {
		$('#consultation_preview').hide();
		$('#consultation_details').show();
	});
  
  $(document).on('change',"#billing_from",function(e) {
    var billing_from = $(this).val();
    if(billing_from == 'IndiaIVF'){
      $('#hospital_id').prop('required',false);
      $('.hospital_id_section').hide();
    }else{
      $('#hospital_id').prop('required',true);
      $('.hospital_id_section').show();
    }
  });
  
</script>

<script type="text/javascript">
    // Delete selected rows and recalculate totals
    $(document).on('click', '.delete-investigations-row', function () {
        // Remove checked rows
        $("table tbody").find('input[name="record"]:checked').each(function () {
            $(this).closest("tr").remove();
        });

        // Recalculate totals after deletion
        recalculateTotals();
    });

    // Unified total calculation logic
    function recalculateTotals() {
        var grand_total = 0;
        var given_discount = 0;

        // Recalculate based on remaining sub_procedures_discount inputs
        $('.sub_procedures_discount').each(function () {
            var discount = parseFloat($(this).val()) || 0;
            var price = parseFloat($(this).attr('sub_procedures_price')) || 0;
            var subtotal = price - discount;

            grand_total += subtotal;
            given_discount += discount;
        });

        $('#rs_fees').val(grand_total.toFixed(2));
        $('#rs_discount').val(given_discount.toFixed(2));
        $('#discount_amount').val(given_discount.toFixed(2));
        $('#us_discount').val((given_discount / <?php echo $converstion_rate; ?>).toFixed(2));

        var payment_done = parseFloat($('#payment_done').val()) || 0;
        var subvention_charges = parseFloat($('#subvention_charges').val()) || 0;

        var total_package = grand_total - payment_done + subvention_charges;
        $('#rs_after_discount').val(total_package.toFixed(2));
        $('#rs_totalpackage').val(total_package.toFixed(2));

        var pending_amount = total_package;
        $('#pending_amount').val(pending_amount.toFixed(2));
    }

    // Trigger recalculations on relevant changes
    $(document).on('keyup change', '.sub_procedures_discount, #subvention_charges, #payment_done', function () {
        recalculateTotals();
    });
</script>



<script>
    function consumables_quantity_update(el) {
    var wallet_payment = $(el).attr('wallet_payment');
    var balance = $(el).val();
    if (balance > 0) {
        if (parseInt(wallet_payment) < parseInt(balance)) {
            alert('Wallet Amount must be less than or equal to wallet payment');
            $(el).val("0");
            return false;
        }
    }
	}
</script>