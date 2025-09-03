<?php $all_method =&get_instance(); ?>
<div class="col-md-12">
  <!-- Advanced Tables -->
  <div class="card">
	<div class="card-action"><h3> Billing discount request </h3></div>
	 <div class="clearfix"></div>
	<div class="card-content">
	  <div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataList" id="billing_discount">
		  <thead>
				<tr>
					  <th>IIC ID</th>
                      <th>PT name</th>
					  <th>Receipt number</th>
					  <th>Discount amount</th>
					  <th>Coupon code</th>
                      <th>Biller</th>
                      <th>Type</th>
					  <th>Used</th>
                      <th>Date</th>
					  <th>Status</th>
					  <th>Action</th>
				</tr>
		  </thead>
		  <tbody>
		    <?php foreach($data as $ky => $vl){ 
			  	$check_discount_billing = check_discount_billing($vl['patient_id'], $vl['receipt_number'], $vl['type']);
				if(!empty($check_discount_billing)){
				$patient_data = get_patient_detail($vl['patient_id']);
				$currency = "";
				if(!empty($patient_data)){
		    ?>
				<tr class="odd gradeX">
	                <td><a href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
	                <td><?php echo strtoupper($patient_data['wife_name']); ?></td>
                    <td><a href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['receipt_number']?>?t=<?php echo $vl['type']; ?>"><?php echo $vl['receipt_number']?></a></td>
					<td><?php echo $currency.$vl['amount']; ?></td>
					<td><?php echo $vl['code']; ?></td>
                    <td><?php $employee_data = get_employee_detail($vl['biller']); echo $employee_data['name']; ?> (<?php echo $vl['biller']; ?>)</td>
                    <td><?php echo ucfirst($vl['type']); ?></td>
					<td><?php if($vl['status']== 2){ echo 'Declined';}else if($vl['status']== 1){if($vl['used']== 1){echo 'Applied';}else{echo 'Unapplied'; }}else{echo 'Pending';} ?></td>
                    <td><?php echo dateformat($vl['date']); ?></td>
					<td>
                        <?php if($vl['status']== 2){ echo 'Declined';}else if($vl['status']== 1){echo 'Approved';}else{echo 'Pending';} ?>
                        <?php if(!empty($vl['disapproval_reason'])){ echo "(".$vl['disapproval_reason'].")";} ?>
                    </td>
                    <td>
					    <?php if($vl['status'] == 0){?>
                            <a target="_blank" class="btn btn-large" href="<?php echo base_url().'discount-request?p='.base64_encode($vl['patient_id']).'&r='.base64_encode($vl['receipt_number']).'&s='.base64_encode('1').'&t='.base64_encode($vl['type']).'&f='.base64_encode('dashboard'); ?>">Approve</a> | 
                            <a class="btn btn-large disaprove_first" disapprove_amount="<?php echo $vl['amount']; ?>" href="javascript:void(0);" patient_id="<?php echo base64_encode($vl['patient_id']); ?>" receipt_number="<?php echo base64_encode($vl['receipt_number']); ?>" status="<?php echo base64_encode('2')?>" type="<?php echo base64_encode($vl['type']); ?>" from="<?php echo base64_encode('dashboard')?>">Decline</a>
                        <?php } ?>
                    </td>
				</tr>
		  <?php } } } ?>
		  </tbody>
		</table>
	  </div>
	</div>
  </div>
  <!--End Advanced Tables -->
</div>
<script>
  $(document).ready(function() {
      $('#billing_discount').DataTable( {
          "order": [[ 8, "desc" ]]
      } );
  } );
</script>

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

        float:left;

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

<div class="row" id="disapprove_pop">
    <div class="col-sm-12 disapprove_pop_inner role">
      <div class="col-sm-8 no-pad pt-7">
        <label class="pop_lable">Reason of disapprove?</label>
      </div>
      <div class="col-sm-4">
        <a href="javascript:void(0);" class="close_disapprove btn btn-large">close</a>
      </div>
        <input type="text" class="hidden_field" readonly="readonly" value="disapproved" id="bill_action" />
        <input type="text" class="hidden_field" readonly="readonly" value="" id="patient_id" />
		<input type="text" class="hidden_field" readonly="readonly" value="" id="receipt_number" />
		<input type="text" class="hidden_field" readonly="readonly" name="disapproved" value="disapproved" id="status" />
		<input type="text" class="hidden_field" readonly="readonly" value="" id="type" />
		<input type="text" class="hidden_field" readonly="readonly" value="" id="from" />
        <p class="error hidden_field"></p>
        <label class="pop_lable">Give Discount Amount:</label>
        <input class="form-control" id="disapprove_amount" placeholder="Leave empty if current given discount amount is correct." value=""></input>
        <label class="pop_lable">Submit your own reason:</label>
        <textarea class="form-control" id="disapprove_reason"></textarea>
        <a href="javascript:void(0);" class="now_disapprove btn btn-large">Disapprove</a>
    </div>
</div>

<script>
  $(document).on('click','a.disaprove_first',function(){
      $('#disapprove_pop p.error.hidden_field').empty().hide();
      $('#patient_id').val($(this).attr('patient_id'));
	  $('#receipt_number').val($(this).attr('receipt_number'));
	  $('#status').val($(this).attr('status'));
	  $('#type').val($(this).attr('type'));
	  $('#from').val($(this).attr('from'));
      $('div#disapprove_pop').show();
  });

    function close_discount(){
        $('#disapprove_pop p.error.hidden_field').empty().hide();
        $('#disapprove_amount').val('');
        $('#patient_id').val('');
    	$('#receipt_number').val('');
    	$('#status').val('');
    	$('#type').val('');
    	$('#from').val('');
    	$('#disapprove_reason').val('');
        $('div#disapprove_pop').hide();
    }
	
  $(document).on('click','a.close_disapprove',function(){
    close_discount();
  });

  $(document).on('click','a.now_disapprove',function(){
    $('p.error.hidden_field').empty().hide();
    var  disapprove_amount = $('#disapprove_amount').val();
    var  patient_id = $('#patient_id').val();
	var  receipt_number = $('#receipt_number').val();
	var  status = $('#status').val();
	var  type = $('#type').val();
	var  from = $('#from').val();
    var  disapprove_reason = $('#disapprove_reason').val();
    if(disapprove_reason != ''){
      //window.location.href = ;			
        window.open('<?php echo base_url();?>discount_disapprove_request?p='+patient_id+'&r='+receipt_number+'&s='+status+'&t='+type+'&f='+from+"&rs="+disapprove_reason+"&da="+disapprove_amount, '_blank');
        close_discount();
    }else{
      $('#disapprove_pop p.error.hidden_field').empty().append('Enter valid disapproval reason!').show();
    }
});
</script>