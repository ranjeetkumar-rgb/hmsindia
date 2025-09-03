<?php $all_method =&get_instance();
?>
<style type="text/css">
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

<div class="col-md-12">
  <!-- Advanced Tables -->
  <div class="card">
    <div class="card-action"><h3>Procedure Report</h3></div>
      <div class="clearfix"></div>
    <div class="card-content">
	
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataList" id="">
          <thead>
            <tr>
				<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Procedure</th>
				<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Code</th>
				<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Record</th>
				<th style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Check record</th>
            </tr>
          </thead>
		  
          <tbody>
		  <?php  
						$procedure_billing = check_procedure_billing($appointment_id); 
						$patient_id = $procedure_billing['patient_id'];			
								$sql1 = "SELECT * FROM hms_patient_procedure WHERE appointment_id=".$procedures['appointment_id']."";
                                $query = $this->db->query($sql1); 
								$select_result3 = $query->result(); 
								foreach ($select_result3 as $res_val) {
								$procedure_data = unserialize($res_val->data);
                                if ($procedure_data !== false || $res_val->data === 'b:0;'){ 
								if (is_array($procedure_data) && isset($procedure_data['patient_procedures'])) { 
								foreach ($procedure_data['patient_procedures'] as $procedure) { 
								$sql1 = "select * from hms_procedures where code='".htmlspecialchars($procedure['sub_procedures_code'])."'";
								$select_result3 = run_select_query($sql1);    

								//foreach($res_val->data as $ky => $val2){ 
									//var_dump($res_val->data);die();
									$procedure_assign = have_procedure_assign($procedure['sub_procedure'], 'lab_procedure');  //var_dump($procedure_assign);die;
								//	if($procedure_assign){
                                      ?>
                                    <tr>
                                        <td width="240"><?php echo $select_result3['procedure_name']; ?></td>
                                        <td width="150"><?php echo $select_result3['code']; ?></td>
                                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
						<?php if(have_form($procedure['sub_procedure'], 'lab')){ ?>
							<a procedure_id="<?php echo $procedure['sub_procedure']; ?>" patient_procedure_id="<?php echo $procedures['patient_procedure_id']; ?>" href="javascript:void(0);" appointment_id="<?php echo $procedures['appointment_id']; ?>" class="upload_record btn btn-large">Upload record</a>
							<div class="procedure_form_div" id="procedure_form_<?php echo $procedure['sub_procedure']; ?>"></div>
						<?php } ?>
					</td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
						<?php if(have_form($procedure['sub_procedure'], 'lab')){ ?>
							<a href="javascript:void(0);" procedure_id="<?php echo $procedure['sub_procedure']; ?>" class="check_record btn btn-large">Check record</a>
							<div style="display:none;" class="check_form_div" id="check_form_<?php echo $procedure['sub_procedure']; ?>">
							<?php $form_list = get_prodecure_forms($procedure['sub_procedure']); //var_dump($val['sub_procedure']);die; 
								$html = "";
								foreach($form_list as $key => $vls){
									$form_details = get_prodecure_form($vls['form_id']); //var_dump($form_details);die;
									if(isset($_SESSION['logged_embryologist'])){
										if($form_details['form_for'] == "lab_procedure"){
											$check_form_data = check_form_data($procedures['patient_id'], $procedures['receipt_number'], $form_details['form_area']);
											if(count($check_form_data) > 0){
												$html .= "<a target='_blank' href='".base_url('check_procedure_form/'.$vls['form_id'].'/'.$procedures['patient_procedure_id'].'/'.$procedures['appointment_id'].'/'.$procedure['sub_procedure'])."'>".$form_details['form_name']."</a> | ";
											}
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
						<?php } ?>
					</td>
                                    </tr>
                                    <?php }}}} ?>


		  <?php /*$procedure_billing = check_procedure_billing($appointment_id); 
				$patient_id = $procedure_billing['patient_id'];
				  if(!empty($procedures)){ //var_dump($procedures);die; ?>
			<?php $data = unserialize($procedures['data']); 
				  foreach($data['patient_procedures'] as $ky => $val){ $procedure_assign = have_procedure_assign($val['sub_procedure'], 'lab_procedure');  //var_dump($procedure_assign);die;
				  if($procedure_assign){ ?>
				<tr>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo get_procedure_data($val['sub_procedure']); ?></td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['sub_procedures_code']?></td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
						<?php if(have_form($val['sub_procedure'], 'lab')){ ?>
							<a procedure_id="<?php echo $val['sub_procedure']; ?>" patient_procedure_id="<?php echo $procedures['patient_procedure_id']; ?>" href="javascript:void(0);" appointment_id="<?php echo $procedures['appointment_id']; ?>" class="upload_record btn btn-large">Upload record</a>
							<div class="procedure_form_div" id="procedure_form_<?php echo $val['sub_procedure']; ?>"></div>
						<?php } ?>
					</td>
					<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">
						<?php if(have_form($val['sub_procedure'], 'lab')){ ?>
							<a href="javascript:void(0);" procedure_id="<?php echo $val['sub_procedure']; ?>" class="check_record btn btn-large">Check record</a>
							<div style="display:none;" class="check_form_div" id="check_form_<?php echo $val['sub_procedure']; ?>">
							<?php $form_list = get_prodecure_forms($val['sub_procedure']); //var_dump($val['sub_procedure']);die; 
								$html = "";
								foreach($form_list as $key => $vls){
									$form_details = get_prodecure_form($vls['form_id']); //var_dump($form_details);die;
									if(isset($_SESSION['logged_embryologist'])){
										if($form_details['form_for'] == "lab_procedure"){
											$check_form_data = check_form_data($procedures['patient_id'], $procedures['receipt_number'], $form_details['form_area']);
											if(count($check_form_data) > 0){
												$html .= "<a target='_blank' href='".base_url('check_procedure_form/'.$vls['form_id'].'/'.$procedures['patient_procedure_id'].'/'.$procedures['appointment_id'].'/'.$val['sub_procedure'])."'>".$form_details['form_name']."</a> | ";
											}
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
						<?php } ?>
					</td>
				</tr>
			<?php } } ?>
		  <?php }*/ ?>
          </tbody>
        </table>
	  </div>
    </div>
  </div>
  <!--End Advanced Tables -->
</div>

<script>
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

$(document).on('click',".check_record",function(e) {
	$('.check_form_div').hide();
	$('.procedure_form_div').hide();
	$('.procedure_form_div').empty();
	var procedure_id = $(this).attr('procedure_id');
	$('#check_form_'+procedure_id).show();
});
</script>