    <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Partial pending payments </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="partial_paymnt">
              <thead>
                    <tr>
                          <th>IIC ID</th>
                          <th>PT name</th>
                          <th>Payment id</th>
                          <th>Receipt Number</th>
                          <th>Transaction id</th>
                          <th>Payment received</th>
                          <th>Payment method</th>
                          <th>Billing from</th>
                          <th>Billing at</th>
                          <th>On date</th>
                          <th>Action</th>
                    </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ 
					$patient_data = get_patient_detail($vl['patient_id']);
					$currency = $nation = '';
					if($patient_data['nationality'] == 'indian'){ $currency = '<i class="fa fa-inr" aria-hidden="true"></i> '; }
					else { $currency = '<i class="fa fa-usd" aria-hidden="true"></i> '; }
			  ?>
                    <tr class="odd gradeX">
                          <td><a target="_blank" href="<?php echo base_url()?>accounts/patient_details/<?php echo $vl['patient_id'];?>"><?php echo $vl['patient_id']; ?></a></td>
                          <td><?php echo strtoupper($patient_data['wife_name']); ?></td>
                          <td><a target="_blank" href="<?php echo base_url().'partial-payment-receipt/'.$vl['refrence_number']; ?>"><?php echo $vl['refrence_number']; ?></a></td>
                          <td><a target="_blank" href="<?php echo base_url(); ?>accounts/details/<?php echo $vl['billing_id']?>?t=<?php echo $vl['type']; ?>"><?php echo $vl['billing_id']?></a></td>
                          <td><?php if(!empty($vl['transaction_img'])){ ?> <?php echo $vl['transaction_id']; ?> (<a href="<?php echo $vl['transaction_img']; ?>" target="_blank">Download transaction Image</a>) <?php } ?></td>
                          <td><?php echo $currency.$vl['payment_done']; ?></td>
                          <td><?php echo ucfirst($vl['payment_method']); ?></td>
                          <td><?php if($vl['billing_from'] == 'IndiaIVF') echo $vl['billing_from']; else echo get_center_name($vl['billing_from']); ?></td>
                          <td><?php echo get_center_name($vl['billing_at']);?></td>
                          <td><?php echo $vl['on_date']; ?></td>
                          <td><a onclick="return confirm('Are you sure you want to approve this payment?');" href="<?php echo base_url();?>accounts/approve_payment/<?php echo $vl['ID']; ?>" class="btn btn-large" >Approve</a> |
                              <a  href="javascript:void(0);" partial_payment="<?php echo $vl['ID']; ?>"  class="disaprove_first btn btn-large" >Disapprove</a>
                          </td>
                    </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
    <script>
      $(document).ready(function() {
          $('#partial_paymnt').DataTable( {
              "order": [[ 9, "desc" ]]
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

<!-- href="<?php echo base_url();?>accounts/disapprove_payment/<?php echo $vl['ID']; ?>" -->
<div class="row" id="disapprove_pop">
    <div class="col-sm-12 disapprove_pop_inner role">
      <div class="col-sm-8 no-pad pt-7">
        <label class="pop_lable">Reason of disapprove?</label>
      </div>
      <div class="col-sm-4">
        <a href="javascript:void(0);" class="close_disapprove btn btn-large">close</a>
      </div>
        <input type="text" class="hidden_field" readonly="readonly" value="disapproved" id="bill_action" />
        <input type="text" class="hidden_field" readonly="readonly" value="" id="payment_id" />

        <p class="error hidden_field"></p>
        <label class="pop_lable">Submit your own reason:</label>
        <textarea class="form-control" id="disapprove_reason"></textarea>
        <a href="javascript:void(0);" class="now_disapprove btn btn-large">Disapprove</a>
    </div>
</div>

<script>
  $(document).on('click','a.disaprove_first',function(){
      $('#disapprove_pop p.error.hidden_field').empty().hide();
      $('#payment_id').val($(this).attr('partial_payment'));
      $('div#disapprove_pop').show();
  });

 
  
  function close_discount(){
    $('#disapprove_pop p.error.hidden_field').empty().hide();
    $('#payment_id').val('');
    $('#disapprove_reason').val('');
    $('div#disapprove_pop').hide();
  }
  
  $(document).on('click','a.close_disapprove',function(){
    close_discount();
  });
  
  
  $(document).on('click','a.now_disapprove',function(){
    $('p.error.hidden_field').empty().hide();
    var  payment_id = $('#payment_id').val();
    var  disapprove_reason = $('#disapprove_reason').val();
    if(disapprove_reason != ''){
      //window.location.href = '<?php echo base_url();?>accounts/disapprove_payment/'+payment_id+'?t='+disapprove_reason;			
      window.open('<?php echo base_url();?>accounts/disapprove_payment/'+payment_id+'?t='+disapprove_reason, '_blank');
      close_discount();
    }else{
      $('#disapprove_pop p.error.hidden_field').empty().append('Enter valid disapproval reason!').show();
    }
});
</script>