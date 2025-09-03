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
    <div class="card-action"><h3>Patient Reports</h3></div>
      <div class="clearfix"></div>
    <div class="card-content">
	
      <div class="table-responsive">
	<?php if(!empty($medicines)){?>
          <h3>Medicine details</h3>
          <hr />
          <?php 
             $medicines = unserialize($medicines['medicines']);
             if(!empty($medicines['male_medicine'])){ 
          ?>  
            <h4>Male Medicine</h4>
              <table style="width:100%">
                    <tr>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Medicine</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">MRP</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Dose/Day</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Day</th>
                    </tr>
                    <?php $total_fees = 0;
                    foreach($medicines['male_medicine'] as $key => $val){
                      $medicine_details = $all_method->get_medicine_name($val['male_med_name']);//var_dump($medicine_details);die; 
                    ?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['item_name']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['company']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_brand_name($medicine_details['brand_name']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_unit_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_dose']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['male_med_for']?></td>
                    </tr>
                    <?php $total_fees += $val['male_med_price']; } ?>
              </table>
            <?php }
             if(!empty($medicines['female_medicine'])){ ?>
              <h4>Female Medicine</h4>
              <table style="width:100%">
                    <tr>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Medicine</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Company</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Brand</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Unit Price</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">MRP</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">Dose/Day</th>
                        <th  style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;">No. of Day</th>
                    </tr>
                    <?php $total_fees = 0;
                    foreach($medicines['female_medicine'] as $key => $val){//var_dump($val);die; 
                      $medicine_details = $all_method->get_medicine_name($val['female_med_name']);//var_dump($medicine_details);die; 
                    ?>
                    <tr>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['item_name']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $medicine_details['company']; ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;" class="role"><?php echo $all_method->get_brand_name($medicine_details['brand_name']); ?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_unit_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_price']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_dose']?></td>
                        <td style="border: 1px solid black; border-collapse: collapse;padding:5px; text-align:left;"><?php echo $val['female_med_for']?></td>
                    </tr>
                    <?php $total_fees += $val['female_med_price']; } ?>
              </table>
            <?php } ?>
	<?php } ?>
	<hr/>
		<div class="col-sm-12 col-xs-12"><h3>Investigation Reports</h3><br/></div>
        <table class="table table-striped table-bordered table-hover dataList" id="">
          <thead>
            <tr>
			  <th>Investigation</th>
			  <th>Gender</th>
			  <th>Reports</th>
              <!-- <th>Action</th> -->
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
					<!-- <td>
						<?php if($vl['doctor_accepted'] == "pending"){ ?>
							<a href="<?php echo base_url('report_status/'.$vl['patient_id'].'/'.$vl['ID'].'?s=approved'); ?>"  class="btn btn-large">Approve</a> |
							<a href="javascript:void(0);" status="disapproved" patient_id="<?php echo $vl['patient_id']; ?>" report_id="<?php echo $vl['ID']; ?>" class="disaprove_first btn btn-large">Disapprove</a>
						<?php }else{?>
							<?php echo ucwords($vl['doctor_accepted']); ?>
							<?php if($vl['doctor_accepted'] == 'disapproved'){?> 
								<i class="fa fa-info-circle fa-lg" title="<?php echo $vl['status_reason']; ?>" aria-hidden="true"></i>
							<?php } ?>
						<?php } ?>
					</td> -->
				</tr>
			<?php } ?>
		  <?php } ?>
          </tbody>
        </table>
	  </div>
    </div>
  </div>
  <!--End Advanced Tables -->
</div>

<div class="row" id="disapprove_pop">
            <div class="col-sm-12 disapprove_pop_inner">
				<a href="javascript:void(0);" class="close_disapprove btn btn-large">close</a>
				<form id="disapproved_form" method="post" action="<?php echo base_url('report_status');?>">
					<input type="text" class="hidden_field" readonly="readonly" value="" name="status" id="status" />
					<input type="text" class="hidden_field" readonly="readonly" value="" name="patient_id" id="patient_id" />
					<input type="text" class="hidden_field" readonly="readonly" value="" name="report_id" id="report_id" />
					
					<label class="pop_lable">Disapprove Reason</label>
					<p class="error hidden_field"></p>
					<textarea class="form-control" name="status_reason" required></textarea>
					<input type="submit" class="btn btn-large submit" value="submit">
				</form>
            </div>
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
			var action_src = '<?php echo base_url('report_status/');?>'+$(this).attr('patient_id')+'/'+$(this).attr('report_id')+'?s='+$(this).attr('status');
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