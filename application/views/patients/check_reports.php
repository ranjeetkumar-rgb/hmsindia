<?php $all_method =&get_instance(); ?>
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
	<div class="card-action"><h3>Check Reports</h3></div>
      <div class="clearfix"></div>
    	<div class="card-content">
		<?php if(isset($_GET['p'])  && !empty($_GET['p']) && isset($_GET['b'])  && !empty($_GET['b'])){ ?>
			<a style="position: absolute;right: 30px;top: 30px;" class="btn btn-large" href="<?php echo base_url('check_reports');?>">Go back</a>
			<div class="table-responsive">
				<div class="col-sm-12 col-xs-12" style="padding:0px;"><h3>Investigation Reports</h3><br/></div>
				<table class="table table-striped table-bordered table-hover dataList" id="">
				<thead>
					<tr>
					<th>Investigation</th>
					<th>Gender</th>
					<th>Reports</th>
					<th>Status</th>
					<th>Doctor approval</th>
					</tr>
				</thead>
				<tbody id="investigation_reports">
				<?php if(!empty($investigation_reports)){ ?>
					<?php foreach($investigation_reports as $ky => $vl){ ?>
						<tr class="odd gradeX">
							<td><?php echo get_investigation_name($vl['investigation_id']); ?></td>
							<td><?php echo ucwords($vl['gender']); ?></td>
							<td><?php if($vl['doctor_accepted'] == 'approved'){?> <a href="<?php echo $vl['report']; ?>" download>Download Report</a> <?php } ?> </td>
							<td><?php echo ucwords($vl['status']); ?></td>
							<td>
								<?php echo ucwords($vl['doctor_accepted']); ?>
								<?php if($vl['doctor_accepted'] == 'disapproved'){?> 
									<i class="fa fa-info-circle fa-lg" title="<?php echo $vl['status_reason']; ?>" aria-hidden="true"></i>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
				</table>
			</div>
			<hr/>
			<div class="table-responsive">
					<div class="col-sm-12 col-xs-12" style="padding: 0; margin-top: 20px;"><h3>Procedure Reports</h3><br/></div>
					<table class="table table-striped table-bordered table-hover dataList" id="">
					<thead>
						<tr>
						<th>Procedure</th>
						<th>Reports</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($procedure_reports)){ $procedure_data = unserialize($procedure_reports['data']);?>
						<?php foreach($procedure_data['patient_procedures'] as $ky => $val){ //var_dump($procedure_reports);die; ?>
							<tr class="odd gradeX">
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo get_procedure_data($val['sub_procedure']); ?></td>
							<td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role">
							<a href="javascript:void(0);" procedure_id="<?php echo $val['sub_procedure']; ?>" class="check_record btn btn-large">Check record</a>
							<div style="display:none;" class="check_form_div" id="check_form_<?php echo $val['sub_procedure']; ?>">
								<?php $form_list = get_prodecure_forms($val['sub_procedure']); //var_dump($form_list);die; 
									$html = "";

									foreach($form_list as $key => $val){//var_dump($val);die;
									$html .= "<a target='_blank' href='".base_url('check_procedure_form/'.$val['ID'].'/'.$procedure_reports['ID'].'/'.$procedure_reports['appointment_id'])."'>".$val['form_name']."</a> | ";
									}
									$html = substr($html, 0, -3);
									echo $html;
								?>
							</div>  
							</td>
							</tr>
						<?php } ?>
						<?php } ?>
					</tbody>
					</table>
				</div>
			</div>


		<?php }else{ ?>
			<div class="row">
				<div class="form-group col-sm-4 col-xs-12">
					<input value="" placeholder="Phone number of wife" id="phone_number" by="phone" name="phone_number" type="text" class="form-control validate" >
				</div>
				<div class="form-group col-sm-1 col-xs-12">
					<p>OR </p>
				</div>
				<div class="form-group col-sm-4 col-xs-12">
					<input value="" placeholder="IIC ID" id="iic_id" by="patient" type="text" class="form-control validate" >
				</div>
				
					<div class="form-group col-sm-3 col-xs-12">
						<input value="Search" id="search_patient" type="button" class="form-control validate" >
					</div>
			</div>
		<?php }?>
		</div>
  </div>
  <!--End Advanced Tables -->
</div>

<script>
$(document).on('click',"#search_patient",function(e) {
	$('#loader_div').show();
	$('.in_field').val('');
	$('#medical_history').val('');
	$('#address').val('');
	$('#msg_area').empty();
	$('#paitent_type').empty();		
	var phone_number = $('#phone_number').val();
	var phone_by = $('#phone_number').attr('by');
	var patient_id = $('#iic_id').val();
	var patient_by = $('#iic_id').attr('by');
	
	if(phone_number != ''){
		search_patient(phone_number, phone_by);
	}else if(patient_id != ''){
		search_patient(patient_id, patient_by);
	}else{
		$('#msg_area').append('Enter patient phone number or IIC ID');
		$('#loader_div').hide();
	}
});

function search_patient(phone_number, patient_by){
	window.location.href="<?php echo base_url('check_reports/'); ?>"+"?p="+phone_number+"&b="+patient_by;
}
$(document).on('click',".check_record",function(e) {
	$('.check_form_div').hide();
	var procedure_id = $(this).attr('procedure_id');
	$('#check_form_'+procedure_id).show();
});
</script>