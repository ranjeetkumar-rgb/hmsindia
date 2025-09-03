<?php
	$all_method =&get_instance();
	$patient_data = get_patient_detail($patient_id);
?>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
}
.img_sec{max-width:100px;}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
  <div class="row">
      <a href="<?php echo base_url('my_reports');?>" class="btn btn-large pull-right">Go Back</a>
  </div>  
  <hr/>
  <div class="table-responsive">
      <div class="col-sm-12 col-xs-12"><h3>Investigation Reports</h3><br/></div>
          <table class="table table-striped table-bordered table-hover dataList" id="">
            <thead>
              <tr>
                <th>Investigation</th>
                <th>Gender</th>
                <th>Reports</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
        <?php if(!empty($investigations_reports)){ ?>
                <?php foreach($investigations_reports as $ky => $vl){ ?>
                  <tr class="odd gradeX">
                    <td><?php echo get_investigation_name($vl['investigation_id']); ?></td>
                    <td><?php echo ucwords($vl['gender']); ?></td>
                    <td><?php if($vl['doctor_accepted'] != "disapproved"){ ?>
                        <a href="<?php echo $vl['report']; ?>" target="_blank">Download Report</a></td>
                      <?php } ?>
                    <td>
                      <?php if($vl['doctor_accepted'] == "pending"){ ?>
                        <a href="<?php echo base_url('report_status/'.$vl['patient_id'].'/'.$vl['ID'].'/'.$appointment_id.'?s=approved'); ?>"  class="btn btn-large">Approve</a> |
                        <a href="javascript:void(0);" status="disapproved" patient_id="<?php echo $vl['patient_id']; ?>" appointment_id="<?php echo $appointment_id; ?>" report_id="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large">Disapprove</a>
                      <?php }else{?>
                        <?php echo ucwords($vl['doctor_accepted']); ?>
                        <?php if($vl['doctor_accepted'] == 'disapproved'){?> 
                          <i class="fa fa-info-circle fa-lg" title="<?php echo $vl['status_reason']; ?>" aria-hidden="true"></i>
                        <?php } ?>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
        <?php } ?>
            </tbody>
          </table>
      </div>
  <hr/>
  <?php $procedure_billing = check_procedure_billing($appointment_id); 
          if(count($procedure_billing) > 0){
            $patient_prodedures = $all_method->get_patient_prodedures($appointment_id, $patient_id);
            $receipt_number = $patient_prodedures['receipt_number'];
            $procedure_datas = unserialize($patient_prodedures['data']);
           // var_dump($procedure_datas);die;
        ?>
  <div class="col-sm-12">
    <h4>Procedure Reports</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataList" id="">
          <thead>
            <tr>
				<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Procedure</th>
				<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
				<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Check record</th>
            </tr>
          </thead>
          <tbody>
			<?php 
          foreach($procedure_datas['patient_procedures'] as $ky => $val){ $procedure_assign = have_procedure_assign($val['sub_procedure'], 'lab_procedure');
            if($procedure_assign){  ?>
				<tr>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo get_procedure_data($val['sub_procedure']); ?></td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['sub_procedures_code']?></td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
						<a href="javascript:void(0);" procedure_id="<?php echo $val['sub_procedure']; ?>" class="check_record btn btn-large">Check record</a>
						<div style="display:none;" class="check_form_div" id="check_form_<?php echo $val['sub_procedure']; ?>">
						<?php $form_list = get_prodecure_forms($val['sub_procedure']); //var_dump($form_list);die; 
							  $html = "";
							  foreach($form_list as $ks => $vls){$form_details = get_prodecure_form($vls['form_id']);//var_dump($val);die;
									if($form_details['form_for'] == "lab_procedure"){
                      $check_form_data = check_form_data($patient_id, $receipt_number, $form_details['form_area']);
                      if(count($check_form_data) > 0){
                          $html .= "<a target='_blank' href='".base_url('check_procedure_form/'.$vls['form_id'].'/'.$patient_prodedures['ID'].'/'.$appointment_id.'/'.$val['sub_procedure'])."'>".$form_details['form_name']."</a> | ";
                      }
                    }
							  }
                $html = substr($html, 0, -3);
                if(empty($html)){
                  $html = "<p class='error'>No data found!</p>   ";
                }
							  echo $html;
						?>
						</div>
					</td>
				</tr>
			<?php  } } ?>
          </tbody>
        </table>
	  </div>
  </div>
  <?php } ?>
</div>

<div class="row" id="disapprove_pop">
    <div class="col-sm-12 disapprove_pop_inner">
    <a href="javascript:void(0);" class="close_disapprove btn btn-large">close</a>
    <form id="disapproved_form" method="post" action="<?php echo base_url('report_status');?>">
      <input type="text" class="hidden_field" readonly="readonly" value="" name="status" id="status" />
      <input type="text" class="hidden_field" readonly="readonly" value="" name="patient_id" id="patient_id" />
      <input type="text" class="hidden_field" readonly="readonly" value="" name="appointment_id" id="appointment_id" />
      <input type="text" class="hidden_field" readonly="readonly" value="" name="report_id" id="report_id" />
      
      <label class="pop_lable">Disapprove Reason</label>
      <p class="error hidden_field"></p>
      <textarea class="form-control" name="status_reason" required></textarea>
      <input type="submit" class="btn btn-large submit" value="submit">
    </form>
    </div>
</div>

<style>
  input.btn.btn-large.submit {
    background: #2bbbad;
    max-width: 100%;
    margin-top: 20px;
    width: 50%;
    margin: 20px auto;
  }
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
    $('#status').val($(this).attr('status'));
    $('#patient_id').val($(this).attr('patient_id'));
    $('#report_id').val($(this).attr('report_id'));
    $('#appointment_id').val($(this).attr('appointment_id'));
    var action_src = '<?php echo base_url('report_status/');?>'+$(this).attr('patient_id')+'/'+$(this).attr('report_id')+'/'+$(this).attr('appointment_id')+'?s='+$(this).attr('status');
    $('#disapproved_form').attr('action', action_src);
    $('div#disapprove_pop').show();
  });
  $("a.close_disapprove").on("click", function(){
    $('#status').val('');
    $('#patient_id').val('');
    $('#report_id').val('');
    var action_src = '<?php echo base_url('report_status/');?>';
    $('#disapproved_form').attr('action', action_src);
    $('div#disapprove_pop').hide();
  });
  </script>
<script>
$(document).on('click',".check_record",function(e) {
    $('.check_form_div').hide();
    $('.procedure_form_div').hide();
    $('.procedure_form_div').empty();
    var procedure_id = $(this).attr('procedure_id');
    $('#check_form_'+procedure_id).show();
});

$(document).on('click',".upload_record",function(e) {
	$('.check_form_div').hide();
	var procedure_id = $(this).attr('procedure_id');
	var appointment_id = $(this).attr('appointment_id');
	var patient_procedure_id = $(this).attr('patient_procedure_id');
	$('.procedure_form_div').hide();
	$('.procedure_form_div').empty();
	
	$.ajax({
		url: '<?php echo base_url('doctors/procedure_upload')?>',
		data: {'procedure_id':procedure_id, 'appointment_id':appointment_id, 'patient_procedure_id':patient_procedure_id, 'patient_id':'<?php echo $patient_id; ?>'},
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			$('#procedure_form_'+procedure_id).empty().append(data);
			$('#procedure_form_'+procedure_id).show();
		}
	});
});
</script>