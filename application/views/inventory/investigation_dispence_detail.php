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
<?php $all_method =&get_instance(); ?>
<?php foreach($data as $key => $value) { $investigations = unserialize($value['investigations']); $patient = get_patient_detail($value['patient_id']);
	$currency = '';
	if($patient['nationality'] == 'indian'){
		$currency = 'Rs.';
	}else {
		$currency = 'USD';
	}
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
      	<table style="width:100%">
                <tr>
                    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Investigation</th>
                    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
                    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Price</th>
                    <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Discount</th>
                </tr>
                <?php $total_fees = 0;
						foreach($investigations as $key => $val){//var_dump($val);die;
                ?>
                <tr>
                    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_investigation_name($val['investigation_name']); ?></td>
                    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['investigation_code']?></td>
                    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$val['investigation_price']?></td>
                    <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $currency.$val['investigation_discount']?></td>
                </tr>
                <?php $total_fees += $val['investigation_price']; } ?>
            </table>
      </div>
   <?php } ?>
    