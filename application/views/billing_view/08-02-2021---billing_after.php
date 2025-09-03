<?php
 $all_method =&get_instance();
 $form_action = $billing_type = "";
 //var_dump($billing_details);die;
 if($billing_details['medicine_suggestion'] == 1 && $billing_details['medicine_billed'] == 0 && $_GET['t'] == "medicine_investigation_billing"){
  $form_action = "add_investigation";
  $billing_type = "investigation";
 }else if($billing_details['investation_suggestion'] == 1 && $billing_details['investigation_billed'] == 0 && $_GET['t'] == "investigation_billing"){
  $form_action = "add_investigation";
  $billing_type = "investigation";
 }else if($billing_details['procedure_suggestion'] == 1 && $billing_details['procedure_billed'] == 0 && $_GET['t'] == "procedure_billing"){
  $form_action = "add_procedure";
  $billing_type = "procedure";
 }else{
    header("location:" .base_url(). "after-consultation?m=".base64_encode('oops, something went wrong!').'&t='.base64_encode('error'));
    die();
 }
 $grand_total = 0;
 $patient_data = get_patient_detail($billing_details['patient_id']);
 
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
  <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $billing_details['patient_id']?>" />
  <input type="hidden" name="billing_at" value="<?php echo $_SESSION['logged_billing_manager']['center']?>" />
  <input type="hidden" id="billing_type" value="<?php echo $billing_type; ?>" />
  <input type="hidden" name="biller_id" value="<?php echo $_SESSION['logged_billing_manager']['employee_number']?>" />
  
  <div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku" id="consultation_details">
      <div class="panel-heading">
        <h3 class="heading">Billing Details</h3>
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
                <label for="item_name">Date(Required)</label>
                <input value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Date" readonly="readonly" id="on_date" name="on_date" type="text" class="form-control " required>
           </div>
         </div>

         <div class="row">            
           <div class="form-group col-sm-6 col-xs-12">
                <label for="item_name">Receipt number (Required)</label>
                <input value="<?php echo getReceiptGUID(); ?>" placeholder="Receipt number" readonly="readonly" id="receipt_number" name="receipt_number" type="text" class="form-control " required>
           </div>
         </div>
         
      <?php if($form_action == "add_investigation"){?>   
         <div class="row">
         	 <?php //var_dump($billing_details);die;
					if($billing_details['medicine_suggestion'] == 1 && $billing_details['medicine_billed'] == 0){ ?>
          <input type="hidden" name="medicine_suggestion" value="<?php echo $billing_details['medicine_suggestion']; ?>" />
                    <h4>Medicines</h4>
                    <table id="medicine_list_table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <!-- <th>Company</th> -->
                            <th>Brand</th>
                            <th>Unit price</th>
                            <th>MRP</th>
                            <th>Dose/Day</th>
                            <th>Frequency</th>
                            <th>No. of Day</th>
                          </tr>
                        </thead>
                        <tbody>
      <?php  $male_medine = unserialize($billing_details['male_medicine_suggestion_list']);
          if(!empty($male_medine)){
              $male_med_count = 1;
              foreach($male_medine['male_medicine_suggestion_list'] as $key => $val){//var_dump($val['male_medicine_frequency']);die;
                $frequency = medical_frequency($val['male_medicine_frequency']);
                $medicine_details = $all_method->get_medicine_details($val['male_medicine_name']); //var_dump($medicine_details);die;
                $medicine_details['unit_price'] = product_vendor_cost($medicine_details['product_id'], $medicine_details['brand_name'], $medicine_details['vendor_number']); 
                $subtotal = 0;
                $subtotal = ($val['male_medicine_days']*$frequency)*($medicine_details['unit_price']*$val['male_medicine_dosage']);
                ?>
              <tr class="male_medicine">
                  <input value="<?php echo $val['male_medicine_when_start']; ?>" name="male_med_when_start_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                  <input value="<?php echo $val['male_medicine_route']; ?>" name="male_med_route_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                  <input value="<?php echo $val['male_medicine_frequency']; ?>" name="male_med_frequency_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                  <input value="<?php echo $val['male_medicine_timing']; ?>" name="male_med_timing_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">

                  <td><?php echo $medicine_details['item_name']; ?>
                    <input value="<?php echo $val['male_medicine_name']; ?>" medicine="<?php echo $medicine_details['item_name']; ?>" readonly="readonly" id="male_med_name_<?php echo $male_med_count; ?>" class="required_value form-control" name="male_med_name_<?php echo $male_med_count; ?>" type="hidden" required>
                    <input value="<?php echo $medicine_details['company']; ?>" id="male_med_company_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                  </td>
                  <!-- <td><?php echo $medicine_details['company']; ?>
                    <input value="<?php echo $medicine_details['company']; ?>" id="male_med_company_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                  </td> -->
                  <td><?php $brand_details = $all_method->get_brand_details($medicine_details['brand_name']); echo $brand_details['name']; ?>
                    <input value="<?php echo $brand_details['name']; ?>" id="male_med_brand_<?php echo $male_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
                  </td>
                  <td>
                    <?php echo 'Rs.'.$medicine_details['unit_price']; ?>
                    <input value="<?php echo $medicine_details['unit_price']; ?>" readonly="readonly" id="male_med_unit_price_<?php echo $male_med_count; ?>" class="unit_price_field required_value" name="male_med_unit_price_<?php echo $male_med_count; ?>" type="hidden" class="form-control " required>
                  </td>
                  <td>
                    <?php echo 'Rs.'.$subtotal; ?>
                    <input value="<?php echo $subtotal; ?>" readonly="readonly" id="male_med_price_<?php echo $male_med_count; ?>" class="price_field required_value form-control" name="male_med_price_<?php echo $male_med_count; ?>" type="hidden" required>
                  </td>
                  <td>
                    <?php echo $val['male_medicine_dosage']; ?>
                    <input value="<?php echo $val['male_medicine_dosage']; ?>" readonly="readonly" id="male_med_dose_<?php echo $male_med_count; ?>" class="form-control required_value form-control" name="male_med_dose_<?php echo $male_med_count; ?>" type="hidden" required>
                  </td>
                  <td><?php echo $val['male_medicine_frequency']; ?></td>
                  <td><input value="<?php echo $val['male_medicine_days']; ?>" frequency="<?php echo $val['male_medicine_frequency']; ?>" unit_price="<?php echo $medicine_details['unit_price']; ?>" doses="<?php echo $val['male_medicine_dosage']; ?>"  gender="male" count="<?php echo $male_med_count; ?>" id="male_med_for_<?php echo $male_med_count; ?>" class="required_value form-control day_for_field" name="male_med_for_<?php echo $male_med_count; ?>" type="text" required></td>
              </tr>
      <?php 
           // $subtotal = ($val['male_medicine_dosage']*$val['male_medicine_days'])*$medicine_details['unit_price'];
            $grand_total +=  $subtotal; $male_med_count++; } } ?>

      <?php $female_medine = unserialize($billing_details['female_medicine_suggestion_list']);
          if(!empty($male_medine)){
					 $female_med_count = 1;
				  foreach($female_medine['female_medicine_suggestion_list'] as $key => $val){ 
            $frequency = medical_frequency($val['female_medicine_frequency']);
            $medicine_details = $all_method->get_medicine_details($val['female_medicine_name']); //var_dump($medicine_details);die;
            $medicine_details['unit_price'] = product_vendor_cost($medicine_details['product_id'], $medicine_details['brand_name'], $medicine_details['vendor_number']);
            $subtotal = 0;
            $subtotal = ($val['female_medicine_days']*$frequency)*($medicine_details['unit_price']*$val['female_medicine_dosage']);
         ?>
					<tr class="female_medicine">
              <input value="<?php echo $val['female_medicine_when_start']; ?>" name="female_med_when_start_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
              <input value="<?php echo $val['female_medicine_route']; ?>" name="female_med_route_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
              <input value="<?php echo $val['female_medicine_frequency']; ?>" name="female_med_frequency_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
              <input value="<?php echo $val['female_medicine_timing']; ?>" name="female_med_timing_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
              
              <td><?php echo $medicine_details['item_name']; ?>
              <input value="<?php echo $val['female_medicine_name']; ?>" medicine="<?php echo $medicine_details['item_name']; ?>" readonly="readonly" id="female_med_name_<?php echo $female_med_count; ?>" class="required_value" name="female_med_name_<?php echo $female_med_count; ?>" type="hidden" class="form-control " required>
              <input value="<?php echo $medicine_details['company']; ?>" id="female_med_company_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
              </td>
              <!-- <td><?php echo $medicine_details['company']; ?>
              <input value="<?php echo $medicine_details['company']; ?>" id="female_med_company_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
              </td> -->
              <td><?php $brand_details = $all_method->get_brand_details($medicine_details['brand_name']); echo $brand_details['name']; ?>
              <input value="<?php echo $brand_details['name']; ?>" id="female_med_brand_<?php echo $female_med_count; ?>" readonly="readonly" type="hidden" class="form-control">
              </td>
              <td>
                <?php echo 'Rs.'.$medicine_details['unit_price']; ?>
                <input value="<?php echo $medicine_details['unit_price']; ?>" readonly="readonly" id="female_med_unit_price_<?php echo $female_med_count; ?>" class="unit_price_field required_value" name="female_med_unit_price_<?php echo $female_med_count; ?>" type="hidden" class="form-control " required>
              </td>
              <td><?php echo 'Rs.'.$subtotal; ?>
                <input value="<?php echo $subtotal; ?>" readonly="readonly" id="female_med_price_<?php echo $female_med_count; ?>" class="price_field required_value" name="female_med_price_<?php echo $female_med_count; ?>" type="hidden" class="form-control " required>
              </td><td>
                    <?php echo $val['female_medicine_dosage']; ?>
                    <input value="<?php echo $val['female_medicine_dosage']; ?>" readonly="readonly" id="female_med_dose_<?php echo $female_med_count; ?>" class="form-control required_value form-control" name="female_med_dose_<?php echo $female_med_count; ?>" type="hidden" required>
                  </td>
                  <td><?php echo $val['female_medicine_frequency']; ?></td>
                  <td><input value="<?php echo $val['female_medicine_days']; ?>" frequency="<?php echo $val['female_medicine_frequency']; ?>" unit_price="<?php echo $medicine_details['unit_price']; ?>" doses="<?php echo $val['female_medicine_dosage']; ?>" count="<?php echo $female_med_count; ?>" id="female_med_for_<?php echo $female_med_count; ?>" class="required_value form-control day_for_field" name="female_med_for_<?php echo $female_med_count; ?>" type="text" required></td>
          </tr>
      <?php
        //$subtotal = ($val['female_medicine_dosage']*$val['female_medicine_days'])*$medicine_details['unit_price'];
        $grand_total +=  $subtotal; $female_med_count++; } } ?>
            <tr>
              <td colspan='6'>
                <strong>SUB TOTAL :-</strong>
              </td>
              <td>
                <strong id="medicine_total"><?php echo $grand_total; ?></strong>
                <input value="<?php echo $grand_total; ?>" readonly="readonly" id="medicine_sub_total" class="form-control required_value form-control" type="hidden" required>
              </td>
            </tr>
            </tbody>
					</table>
      <?php } ?>
         </div>
      <?php } ?>

      <?php if($form_action == "add_investigation"){?>
         <div class="row">
         	 <?php 
					if($billing_details['investation_suggestion'] == 1 && $billing_details['investigation_billed'] == 0){ ?>
          <input type="hidden" name="investation_suggestion" value="<?php echo $billing_details['investation_suggestion']; ?>" />
                    <h4>Investigations</h4>
                     <table id="investigation_main_table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Discount</th>
                          </tr>
                        </thead>
                        <tbody>
			<?php $male_investigation_suggestion_list = unserialize($billing_details['male_investigation_suggestion_list']);
          $male_ivt_count = 1; $invest_total = 0;
          foreach($male_investigation_suggestion_list as $key => $val){
						$investigation_details = $all_method->get_investigation_details($val);

				?>
						<tr class="male_ivt_tr">
                <td>
                  <?php echo $investigation_details['investigation']; ?>
                  <input value="<?php echo $val; ?>" invest="<?php echo $investigation_details['investigation']; ?>" readonly="readonly" id="male_investigation_name_<?php echo $male_ivt_count; ?>" class="price_field required_value" name="male_investigation_name_<?php echo $male_ivt_count; ?>" type="hidden" class="form-control " required>
                </td>
                <td>
                  <?php echo $investigation_details['code']; ?>
                  <input value="<?php echo $investigation_details['code']; ?>" readonly="readonly" id="male_investigation_code_<?php echo $male_ivt_count; ?>" class="price_field required_value" name="male_investigation_code_<?php echo $male_ivt_count; ?>" type="hidden" class="form-control " required>
                </td>
                  <td>
                    <?php $invest_price = 0; $invest_price = ($investigation_details['usd_price']*$converstion_rate); echo 'Rs.'.$invest_price; ?>
                    <input value="<?php echo $invest_price; ?>" placeholder="Price" readonly="readonly" id="male_price_field_<?php echo $male_ivt_count; ?>" class="price_field required_value" name="male_investigation_price_<?php echo $male_ivt_count; ?>" type="hidden" class="form-control " required>
                  </td>
                  <td><input value="0" placeholder="Discount" investigation_price="<?php echo $invest_price; ?>" id="male_investigation_discount_<?php echo $male_ivt_count; ?>" class="investigation_discount required_value" name="male_investigation_discount_<?php echo $male_ivt_count; ?>" type="text" class="form-control " required></td>
            </tr>
					<?php $grand_total += $invest_price; $invest_total += $invest_price; $male_ivt_count++;} ?>
      <?php $female_investigation_suggestion_list = unserialize($billing_details['female_investigation_suggestion_list']);
          $female_ivt_count = 1;
					foreach($female_investigation_suggestion_list as $key => $val){ $investigation_details = $all_method->get_investigation_details($val); ?>
						<tr class="female_ivt_tr">
                <td><?php echo $investigation_details['investigation']; ?>
                <input value="<?php echo $val; ?>" invest="<?php echo $investigation_details['investigation']; ?>" readonly="readonly" id="female_investigation_name_<?php echo $female_ivt_count; ?>" class="price_field required_value" name="female_investigation_name_<?php echo $female_ivt_count; ?>" type="hidden" class="form-control " required>
                </td>
                <td><?php echo $investigation_details['code']; ?>
                <input value="<?php echo $investigation_details['code']; ?>" readonly="readonly" id="female_investigation_code_<?php echo $female_ivt_count; ?>" class="price_field required_value" name="female_investigation_code_<?php echo $female_ivt_count; ?>" type="hidden" class="form-control " required>
                </td>
                <td>
                    <?php $invest_price = 0; $invest_price = ($investigation_details['usd_price']*$converstion_rate); echo 'Rs.'.$invest_price; ?>
                    <input value="<?php echo $invest_price; ?>" placeholder="Price" readonly="readonly" id="female_price_field_<?php echo $female_ivt_count; ?>" class="price_field required_value" name="female_investigation_price_<?php echo $female_ivt_count; ?>" type="hidden" class="form-control " required>
                </td>
                  <td><input value="0" placeholder="Discount" investigation_price="<?php echo $invest_price; ?>" id="female_investigation_discount_<?php echo $female_ivt_count; ?>" class="investigation_discount required_value" name="female_investigation_discount_<?php echo $female_ivt_count; ?>" type="text" class="form-control " required></td>
            </tr>
          <?php $grand_total += $invest_price; $invest_total += $invest_price; $female_ivt_count++; } ?>
            <tr>
              <td colspan='3'>
                <strong>SUB TOTAL :-</strong>
              </td>
              <td>
                <strong id="investigation_total"><?php echo $invest_total; ?></strong>
                <input value="<?php echo $invest_total; ?>" readonly="readonly" id="investigation_sub_total" class="form-control required_value" type="hidden" required>
                <input value="<?php echo $invest_total; ?>" readonly="readonly" id="actual_investigation_sub_total" class="form-control required_value" type="hidden" required>
              </td>
            </tr>
                </tbody>
            </table>
		<?php } ?>
         </div>
      <?php } ?>

        <?php if($form_action == "add_procedure"){ ?>
       	 <div class="row">
         	 <?php //var_dump($billing_details);die;
					if($billing_details['procedure_suggestion'] == 1 && $billing_details['procedure_billed'] == 0){ $parent_procedure_details = $all_method->get_procedure_details($billing_details['procedure_suggestion_list']); ?>
          <input type="hidden" name="procedure_suggestion" value="<?php echo $billing_details['procedure_suggestion']; ?>" />
                    <h4>Procedure</h4>
                     <table id="procedure_table">
                        <thead>
                          <tr>
                            <th>Procedure</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Discount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- <tr>
                            <td><?php echo $parent_procedure_details['procedure_name']; ?>
                            <input value="<?php echo $billing_details['procedure_suggestion_list']; ?>" procedure="<?php echo $parent_procedure_details['procedure_name']; ?>" readonly="readonly" id="sub_procedure_1" class="required_value" name="sub_procedure_1" type="hidden" class="form-control " required>
                            </td>
                            <td><?php echo $parent_procedure_details['code']; ?>
                            <input value="<?php echo $parent_procedure_details['code']; ?>" readonly="readonly" id="sub_procedures_code_1" class="required_value" name="sub_procedures_code_1" type="hidden" class="form-control " required>
                            </td>
                            <td><?php $parent_price = 0; if($patient_data['nationality'] == 'indian'){$parent_price = $parent_procedure_details['price']; echo 'Rs.'.$parent_price;}else{$parent_price = $parent_procedure_details['usd_price']; echo $parent_price.'USD';} $grand_total += $parent_price; ?>
                            <input value="<?php echo $parent_price; ?>" readonly="readonly" id="sub_procedures_price_1" class="required_value" name="sub_procedures_price_1" type="hidden" class="form-control " required>
                            </td>
                            <td>
                            <input value="0" placeholder="Discount" id="sub_procedures_discount_1" class="investigation_discount required_value" name="sub_procedures_discount_1" type="text" class="form-control " required>
                            </td>
                        </tr> -->
			<?php 	
          //var_dump($parent_procedure_details); die;	
          $sub_procedure_counter = 1;
					$sub_procedure_suggestion_list = unserialize($billing_details['sub_procedure_suggestion_list']);
					foreach($sub_procedure_suggestion_list as $key => $val){
            $sub_procedure_details = $all_method->get_procedure_details($val); //var_dump($val);die;	?>
            <tr>
                <td><?php echo $sub_procedure_details['procedure_name']; ?>
                <input value="<?php echo $val; ?>" procedure="<?php echo $sub_procedure_details['procedure_name']; ?>" readonly="readonly" id="sub_procedure_<?php echo $sub_procedure_counter;?>" class="required_value" name="sub_procedure_<?php echo $sub_procedure_counter;?>" type="hidden" class="form-control " required>
                </td>
                <td><?php echo $sub_procedure_details['code']; ?>
                <input value="<?php echo $sub_procedure_details['code']; ?>" readonly="readonly" id="sub_procedures_code_<?php echo $sub_procedure_counter;?>" class="required_value" name="sub_procedures_code_<?php echo $sub_procedure_counter;?>" type="hidden" class="form-control " required>
                </td>
                <td><?php $sub_price = 0; $sub_price = ($sub_procedure_details['usd_price']*$converstion_rate); echo 'Rs.'.$sub_price; ?>
                <input value="<?php echo $sub_price; ?>" readonly="readonly" id="sub_procedures_price_<?php echo $sub_procedure_counter;?>" class="required_value" name="sub_procedures_price_<?php echo $sub_procedure_counter;?>" type="hidden" class="form-control " required>
                </td>
                <td><input value="0" placeholder="Discount" id="sub_procedures_discount_<?php echo $sub_procedure_counter;?>" class="investigation_discount required_value" name="sub_procedures_discount_<?php echo $sub_procedure_counter;?>" type="text" class="form-control " required></td>
            </tr>

          <?php  $grand_total += $sub_price; $sub_procedure_counter++;}?>
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
                        <?php } ?>
                        <option value="cash" mode="Cash">Cash</option>
                        <option value="cheque" mode="Cheque">Cheque</option>                    
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
                  <label for="item_name">Discount (USD) (Required)</label>
                  <input value="0" readonly="readonly" name="us_discount" id="us_discount" type="text" class="form-control required_value" required>
            </div>
          </div>
          <?php } ?>
          <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Grand Total (Rupee) (Required)</label>
                  <input value="<?php echo $grand_total; ?>" name="rs_totalpackage" placeholder="grand total" readonly="readonly" class="rs_dhee required_value" id="rs_fees" type="hidden" class="form-control " required>
                  <input value="<?php echo $grand_total; ?>" placeholder="grand total" readonly="readonly" name="rs_fees" id="rs_after_discount" type="text" class="form-control required_value" required>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Discount (Rupee) (Required)</label>
                  <input value="0" readonly="readonly" name="rs_discount" id="rs_discount" type="text" class="form-control required_value" required>
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
              <!-- <div class="form-group col-sm-6 col-xs-12 role">
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
                        <?php } ?>
                        <option value="cash" mode="Cash">Cash</option>
                        <option value="cheque" mode="Cheque">Cheque</option>                    
                    </select>
                </div> -->
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
                <div class="form-group col-sm-6 col-xs-12 role">
                    <label for="statuss">Billing source (Required)</label>
                    <select name="billing_from" class="required_value" id="billing_from" required>
                        <option value="">Select</option>
                        <?php if(isset($_SESSION['logged_billing_manager'])){ $center = $all_method->get_center();
                          if($_SESSION['logged_billing_manager']['center_type'] == "associated"){ ?>
                          <option value="<?php echo $center['center_number']; ?>"><?php echo $center['center_name']; ?></option>
                        <?php } } ?>
                        <option value="IndiaIVF">IndiaIVF</option>       
                    </select>
                </div>
                  <div class="form-group col-sm-6 col-xs-12 hospital_id_section" style="display:none;">
                  <label for="item_name">Hospital ID</label>
                  <input value="" id="hospital_id" name="hospital_id" type="text" class="form-control validate">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
                  <label for="item_name">Billing ID (Optional)</label>
                  <input value="" placeholder="Billing ID" id="billing_id" name="billing_id" type="text" class="form-control ">
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

         <div class="row medicine_preview_table" style="display:none;">
              <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <!-- <th>Company</th> -->
                        <th>Brand</th>
                        <th>Unit Price</th>
                        <th>MRP</th>
                        <th>Dose/Day</th>
                        <th>No. of Day</th>
                    </tr>
                </thead>
                <tbody id="medicine_preview_table_body"></tbody>
            </table>
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
  $(document).on('keyup',"#subvention_charges",function(e) {
    var subvention_charges = $(this).val();
    var fees = parseFloat($('#rs_fees').val());
    var discount = parseFloat($('#rs_discount').val());
    fees = (parseFloat(fees) - parseFloat(discount));
    console.log(fees+"-----------"+subvention_charges);
    if(subvention_charges != ""){
      var subvention = (parseFloat(subvention_charges) + parseFloat(fees));
      $('#rs_after_discount').val(parseFloat(subvention));
    }else{
      $('#rs_after_discount').val(parseFloat(fees));
    }
  });

  $(document).on('keyup',".day_for_field",function(e) {
      $(".payment_in").prop('checked', false);
      $('#grand_total_section').hide();
      var unit_price = doses = day_for = total = grand_total = 0;
          // days*frequency*(unit price per dosage unit*dosage)

      $('.day_for_field').each(function(){
          var unit_price = $(this).attr('unit_price');
          var frequency = $(this).attr('frequency');
          var medicinefrequency = medicine_frequency(frequency);
          var doses = $(this).attr('doses');
          var day_for = $(this).val();
          var total = day_for*medicinefrequency*(unit_price*doses);
          // var total = (doses*day_for)*unit_price;
          grand_total += parseFloat(total) || 0;
      });
      console.log('medicine_total-----'+grand_total);
      $('strong#medicine_total').empty().append(grand_total);
      $('#medicine_sub_total').val(grand_total);
  });

  function medicine_frequency(frequency){
    var timing = 1;
    switch( frequency ) {
      case 'OD':
            timing = 1;
            return timing;
            break;
        case 'BD':
            timing = 2;
            return timing;
            break;  
        case 'TDS':
            timing = 3;
            return timing;
            break;
        case 'QID':
            timing = 4;
            return timing;
            break;
        case 'HS':
            timing = 1;
            return timing;
            break;
        case 'SOS':
            timing = 1;
            return timing;
            break;
        default:
            timing = 1;
            return timing;
            break;
      }
  }

  $(document).on('keyup',".investigation_discount",function(e) {
     $(".payment_in").prop('checked', false);
     $('#grand_total_section').hide();

		  var given_discount = given_price = total = grand_total = 0;
      $('.investigation_discount').each(function(){
          var discount = $(this).val();
          var investigation_price = $(this).attr('investigation_price');
          var total = (investigation_price-discount);
          grand_total += parseFloat(total) || 0;
          given_discount += parseFloat(discount) || 0;
      });
      $('strong#investigation_total').empty().append(grand_total.toFixed(2));
      $('#investigation_sub_total').val(grand_total.toFixed(2));

      $('#discount_amount').val(0);
      $('#discount_amount').val(given_discount);
      var us_converstion_discount = (given_discount / <?php echo $converstion_rate; ?>);
      $('#us_discount').val(us_converstion_discount.toFixed(2));
      $('#rs_discount').val(given_discount);

      console.log("given_discount="+given_discount);
	});

  $(document).on('change',".payment_in",function(e) {
      $('#remaining_amount').val('');
      var payment_in = $(this).val();
      
      var billing_type = $('#billing_type').val();
      if(billing_type == 'investigation'){
        var medicine_sub_total = parseFloat($('#medicine_sub_total').val()) || 0;
        var actual_investigation_sub_total = parseFloat($('#actual_investigation_sub_total').val()) || 0;
        console.log(medicine_sub_total+'-------------------------'+actual_investigation_sub_total);
        var medicine_plus_investigation = parseFloat(medicine_sub_total) + parseFloat(actual_investigation_sub_total);
        var medicine_plus_investigation_usd = (medicine_plus_investigation/<?php echo $converstion_rate; ?>).toFixed(2);
        $('.usd_dhee').val(parseFloat(medicine_plus_investigation_usd));
        $('.rs_dhee').val(parseFloat(medicine_plus_investigation));
      }
      var usd_dhee = parseFloat($('.usd_dhee').val());
      var rs_dhee = parseFloat($('.rs_dhee').val());
      $('#usd_after_discount').val(parseFloat(usd_dhee));
      $('#rs_after_discount').val(parseFloat(rs_dhee));
      cal_discount(payment_in);
      $('#grand_total_section').show();
  });

  function cal_discount(payment_in){
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
      fees_amount = parseFloat($('.rs_dhee').val());
      after_cal_price = ( fees_amount * allowd / 100 ).toFixed(2);
    }
    var discount_amount = parseFloat($("#discount_amount").val());
		
    console.log('fees_amount='+fees_amount+'-----------allowd='+allowd+'--------discount_amount='+discount_amount+'-----after='+after_cal_price);
    var medicin_price = $("#medicine_sub_total").val();

		if(discount_amount > after_cal_price){
      if(payment_in == 'us_payment'){
        $('#usd_after_discount').val(parseFloat(fees_amount));
      }else{
        $('#rs_after_discount').val(parseFloat(fees_amount));
      }				
			$('#show_disc_app').show();
			$('#create_billing').hide();
		}else{
			var remaining_amount =  fees_amount - discount_amount;
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
      
      var fees = parseFloat($('#rs_fees').val());
      var discount = parseFloat($('#rs_discount').val());
      $('#rs_after_discount').val((parseFloat(fees) - parseFloat(discount)));

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
  <?php } else { ?>
      $(document).on('click',"#create_billing",function(e) {
      var value = $('.required_value').filter(function () {
        return this.value === '';
      });
      if (value.length == 0) {
        $('#msg_area').empty(); $('#doctor_id_text').empty(); $('#fees_text').empty(); $('#payment_done_text').empty(); 
        $('#remaining_amount_text').empty(); $('#payment_method_text').empty(); $('#investigation_preview_table_body').empty();
        $('#medicine_preview_table_body').empty();
        $('#billing_id_text').empty(); $('#investigation_id_text').empty(); $('#hospital_id_text').empty(); $('#discount_text').empty();

        //Medicine
        var male_med_countr = 1;
        var female_med_countr = 1;
        var male_med_tr= $('#medicine_list_table tr.male_medicine').length;
        var female_med_tr= $('#medicine_list_table tr.female_medicine').length;
        if(male_med_tr > 0){
          $('#medicine_list_table tr.male_medicine').each(function(){
            if(male_med_countr <= male_med_tr){
                var medicine_name, medicine_company, medicine_brand, medicine_price, medicine_dose = medicine_for = unit_price = '';
                medicine_name = $('#male_med_name_'+male_med_countr).attr('medicine');
                medicine_company = $('#male_med_company_'+male_med_countr).val();
                medicine_brand = $('#male_med_brand_'+male_med_countr).val();
                unit_price = $('#male_med_unit_price_'+male_med_countr).val();
                medicine_price = $('#male_med_price_'+male_med_countr).val();
                medicine_dose = $('#male_med_dose_'+male_med_countr).val();
                medicine_for = $('#male_med_for_'+male_med_countr).val();

                $('#medicine_preview_table_body').append('<tr><td class="role">'+medicine_name+'</td><!--<td>'+medicine_company+'</td>--><td>'+medicine_brand+'</td><td>'+unit_price+'</td><td>'+medicine_price+'</td><td>'+medicine_dose+'</td><td>'+medicine_for+'</td></tr>');
                male_med_countr++;
            }
          });
          $('.medicine_preview_table').show();
        }

        if(female_med_tr > 0){
          $('#medicine_list_table tr.female_medicine').each(function(){
            if(female_med_countr <= female_med_tr){
                var medicine_name, medicine_company, medicine_brand, medicine_price, medicine_dose = medicine_for = unit_price = '';
                medicine_name = $('#female_med_name_'+female_med_countr).attr('medicine');
                medicine_company = $('#female_med_company_'+female_med_countr).val();
                medicine_brand = $('#female_med_brand_'+female_med_countr).val();
                unit_price = $('#female_med_unit_price_'+female_med_countr).val();
                medicine_price = $('#female_med_price_'+female_med_countr).val();
                medicine_dose = $('#female_med_dose_'+female_med_countr).val();
                medicine_for = $('#female_med_for_'+female_med_countr).val();

                $('#medicine_preview_table_body').append('<tr><td class="role">'+medicine_name+'</td><!--<td>'+medicine_company+'</td>--><td>'+medicine_brand+'</td><td>'+unit_price+'</td><td>'+medicine_price+'</td><td>'+medicine_dose+'</td><td>'+medicine_for+'</td></tr>');
                female_med_countr++;
            }
          });
          $('.medicine_preview_table').show();
        }


        //Investigation
        var male_countr = 1;
        var female_countr = 1;
        var male_ivt_tr= $('#investigation_main_table tr.male_ivt_tr').length;
        var female_ivt_tr= $('#investigation_main_table tr.female_ivt_tr').length;
        

        console.log("male_ivt_tr="+male_ivt_tr+"---------female_ivt_tr="+female_ivt_tr);
        
        if(male_ivt_tr > 0){
          $('#investigation_main_table tr.male_ivt_tr').each(function(){
            if(male_countr <= male_ivt_tr){
                var investigationname, investigation_code, investigationprice, investigation_discount = '';
                investigationname = $('#male_investigation_name_'+male_countr).attr('invest');
                investigation_code = $('#male_investigation_code_'+male_countr).val();
                investigationprice = $('#male_price_field_'+male_countr).val();
                investigation_discount = $('#male_investigation_discount_'+male_countr).val();

                $('#investigation_preview_table_body').append('<tr><td class="role">'+investigationname+'</td><td>'+investigation_code+'</td><td>'+investigationprice+'</td><td>'+investigation_discount+'</td></tr>');
                male_countr++;
            }
          });
        }

        if(female_ivt_tr > 0){
          $('#investigation_main_table tr.female_ivt_tr').each(function(){
            if(female_countr <= female_ivt_tr){
                var investigationname, investigation_code, investigationprice, investigation_discount = '';
                investigationname = $('#female_investigation_name_'+female_countr).attr('invest');
                investigation_code = $('#female_investigation_code_'+female_countr).val();
                investigationprice = $('#female_price_field_'+female_countr).val();
                investigation_discount = $('#female_investigation_discount_'+female_countr).val();

                $('#investigation_preview_table_body').append('<tr><td class="role">'+investigationname+'</td><td>'+investigation_code+'</td><td>'+investigationprice+'</td><td>'+investigation_discount+'</td></tr>');
                female_countr++;
            }
          });
        }
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
          console.log('paytm--------'+payment_in);
          if(payment_in == "us_payment"){
            after_discount = parseFloat($("#usd_after_discount").val());
          }else{
            after_discount = parseFloat($("#rs_after_discount").val());
          }
          $('#paramedic_text').empty().append($('#paramedic_name').val());
          $('#fees_text').empty().append(after_discount.toFixed(2));
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