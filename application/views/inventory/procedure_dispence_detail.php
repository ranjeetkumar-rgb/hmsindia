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
	.heading{margin-bottom:10px;margin-top: 0; padding-top:0px;}
</style>
<?php $all_method =&get_instance();?>
<?php foreach($data as $key => $value) { $procedute_data = unserialize($value['data']);
	  $get_billing_data = $all_method->get_billing_data($value['patient_id']);

	  if(!empty($billing_data)){ $billing_data = unserialize($get_billing_data['data']); }
	  $patient = get_patient_detail($value['patient_id']); //var_dump($patient);die; 
	  $currency = '';
	  // if($patient['nationality'] == 'indian'){ $currency = 'Rs.'; }else { $currency = 'USD'; }
?>
 <div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
      <div class="panel-body profile-edit">
        <p>
        <div class="row">
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Patient ID</label>
            <p><?php echo $value['patient_id'];?></p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Patient Name</label>
            <p><?php echo $patient['wife_name'];?></p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Reciept Number</label>
            <p><?php echo $value['receipt_number'];?></p>
          </div>
        </div>        
        <div class="row">
          
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Transaction ID</label>
            <p><?php echo $value['transaction_id'];?></p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Total Amount</label>
            <p><?php echo $currency.$value['fees'];?></p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Paid Amount</label>
            <p><?php echo $currency.$value['payment_done'];?></p>
          </div>
          
          
        </div>
        <div class="row">
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Remaining Amount</label>
            <p><?php echo $currency.$value['remaining_amount'];?></p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Payment Method</label>
            <p><?php echo $value['payment_method'];?></p>
          </div>
          <div class="form-group col-sm-4 col-xs-12">
          	<lable for="item_name">Date</lable>
          	<p><?php echo date('d/m/Y H:i:s', strtotime($value['on_date']));?></p>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm-4 col-xs-12">
            <label for="item_name">Billing From</label>
            <p><?php if($value['billing_from'] == 'IndiaIVF') echo $value['billing_from']; else echo get_center_name($value['billing_from']);?></p>
          </div>
          <div class="form-group col-sm-6 col-xs-12">
            <label for="item_name">Billing At</label>
            <p><?php echo get_center_name($value['billing_at']);?></p>
          </div>
        </div>
      </div>
    <div class="col-xs-12">
    <?php if(isset($billing_data['data']['medicine']) && !empty($billing_data['data']['medicine'])) { ?>
      <div class="row">
      	<h3>Patient Medicine</h3>
		 <table>
         	<thead>
      		<tr>
      			  <th>Item</th>
              <th>Company</th>
              <th>Quantity</th>
              <th>Price</th>
      		<tr>
            </thead>
            <tbody>
            	<?php  foreach($billing_data['data']['medicine'] as $key => $val){ //var_dump($procedute_data['medicine']);die;?>
                    <tr>
                        <td><?php $item = $all_method->get_item_name($val['medicine_name']);  echo $item ; ?></td>
                        <td><?php echo $val['medicine_company']; ?></td>
                        <td><?php echo $val['medicine_quantity']; ?></td>
                        <td><?php echo $currency.$val['medicine_price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
      	 </table>
	 </div>
	 <?php } ?>
    <?php if(isset($billing_data['data']['consumables']) && !empty($billing_data['data']['consumables'])) { ?>
      <div class="row">
      	<h3>Patient Consumables</h3>
		 <table>
         	<thead>
      		<tr>
      			  <th>Item</th>
              <th>Company</th>
              <th>Quantity</th>
              <th>Price</th>
      		<tr>
            </thead>
            <tbody>
            	<?php foreach($billing_data['data']['consumables'] as $key => $val){ //var_dump($procedute_data['medicine']);die;?>
                    <tr>
                        <td><?php $item = $all_method->get_item_name($val['consumables_name']);  echo $item ; ?></td>
                        <td><?php echo $val['consumables_company']; ?></td>
                        <td><?php echo $val['consumables_quantity']; ?></td>
                        <td><?php echo $currency.$val['consumables_price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
      	 </table>
	 </div>	 
      <?php } ?>
    </div>

    <div class="col-xs-12">
    <?php if(isset($billing_data['data']['injections']) && !empty($billing_data['data']['injections'])) { ?>
    	<div class="row">
      	<h3>Patient Injections</h3>
		 <table>
         	<thead>
      		<tr>
      			  <th>Item</th>
              <th>Company</th>
              <th>Quantity</th>
              <th>Price</th>
      		<tr>
            </thead>
            <tbody>
            	<?php foreach($billing_data['data']['injections'] as $key => $val){ //var_dump($procedute_data['medicine']);die;?>
                    <tr>
                        <td><?php $item = $all_method->get_item_name($val['injections_name']); echo $item ; ?></td>
                        <td><?php echo $val['injections_company']; ?></td>
                        <td><?php echo $val['injections_quantity']; ?></td>
                        <td><?php echo $currency.$val['injections_price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
      	 </table>
	 </div>
     <?php } ?>
 	<?php if(isset($procedute_data) && !empty($procedute_data)) { //var_dump($procedute_data);die; ?>
    	 <div class="row">
		 <table>
         	<thead>
      		<tr>
      			  <th>Item</th>
              <th>Price</th>
      		<tr>
            </thead>
            <tbody>
            	<?php  foreach($procedute_data['patient_procedures'] as $key => $val){ //var_dump($procedute_data['medicine']);die;?>
                    <tr>
                        <td><?php $item = $all_method->get_procedure_name($val['sub_procedure']);  echo $item ; ?></td>
                        <td><?php echo $currency.$val['sub_procedures_price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
      	 </table>
	 </div>
     <?php } ?>
    </div>
    	
 </div>
 <div class="clearfix"></div>
 </p>
<?php } ?>