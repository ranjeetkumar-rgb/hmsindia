 <?php $all_method = &get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3>Doctor consultations</h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="doctor_appointments">
              <thead>
                <tr>
                  <th>S. No.</th>
                  <th>IIC ID</th>
                  <th>Pt. Name</th>
                  <th>Doctor</th>
                  <th>Appointment On</th>
                  <th>Consultation Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; foreach($data as $ky => $vl){ ?>
                <?php $patient_id = get_patient_by_number($vl['wife_phone']);
               
                if(!empty($patient_id)){  $patient_data = get_patient_detail($patient_id);
                ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
                  <td><a target="_blank" href="<?php echo base_url()?>patient_details/<?php echo $patient_id; ?>"><?php echo $patient_id; ?></a></td>
                  <td><?php echo $patient_data['wife_name']; ?></td>
                  <td>Dr. <?php echo $all_method->doctor_name($vl['doctor_id']); ?></td>
                  <td><?php echo $all_method->doctor_appointment($vl['appointment_id']); ?></td>
                  <td><?php echo $vl['consultation_date']?></td>
                  <td>
                  
                  <a  href="javascript:void(0);" consult_id="<?php echo $vl['ID']; ?>"  class="disaprove_first btn btn-large" >Disapprove Consultation</a>
                  </td>
                </tr>
              <?php $count++; } } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>

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
        <input type="text" class="hidden_field" readonly="readonly" value="" id="consult_id" />

        <p class="error hidden_field"></p>
        <label class="pop_lable">Submit your own reason:</label>
        <textarea class="form-control" id="disapprove_reason"></textarea>
        <a href="javascript:void(0);" class="now_disapprove btn btn-large">Disapprove</a>
    </div>
</div>

<script>
  $(document).on('click','a.disaprove_first',function(){
      $('#disapprove_pop p.error.hidden_field').empty().hide();
      $('#consult_id').val($(this).attr('consult_id'));
      $('div#disapprove_pop').show();
  });

  $(document).on('click','a.close_disapprove',function(){
      $('#disapprove_pop p.error.hidden_field').empty().hide();
      $('#consult_id').val('');
      $('#disapprove_reason').val('');
      $('div#disapprove_pop').hide();
  });

  $(document).on('click','a.now_disapprove',function(){
      $('p.error.hidden_field').empty().hide();
      var  consult_id = $('#consult_id').val();
      var  disapprove_reason = $('#disapprove_reason').val();
      if(disapprove_reason != ''){
        window.location.href = '<?php echo base_url();?>doctors/disapprove_consultation_done/'+consult_id+'?t='+disapprove_reason;			
      }else{
        $('#disapprove_pop p.error.hidden_field').empty().append('Enter valid disapproval reason!').show();
      }
  });
</script>

<script>
  $(document).ready(function() {
      $('#doctor_appointments').DataTable( {
          "order": [[ 2, "desc" ]]
      } );
  } );
</script>

<script>
$(document).on('change',"#filter_by_status",function(e) {
  $('#loader_div').show();
   var status = $(this).val();
   if(status != ''){
		var data = {status:status, type:'appointment_status'};
		appointment_filter(data);
	}else{
		$('#loader_div').hide();
	}
});

$(function() {
	  $('input[name="date_range"]').daterangepicker({
		opens: 'left'
	  }, function(start, end, label) {
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			var data = {start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD'), type:'date_wise'};
			appointment_filter(data);
	  });
});

$('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
	$(this).val('');
	$(this).data('daterangepicker').setStartDate(moment());
	$(this).data('daterangepicker').setEndDate(moment());
});

$( function() {
    $( "#particular_date_filter" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			onSelect: function(dateStr) {
				$('#loader_div').show();				
				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
				var data = {appointment_date:startDate, type:'particular_date_filter'};
				appointment_filter(data);
			}
		});
});

function appointment_filter(data){
	$('#appointment_body').empty();
	$.ajax({
		url: '<?php echo base_url('doctors/ajax_appointment_filter')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
			$('#appointment_body').append(data.appointment_html);
			$('#loader_div').hide();
		} 
	});
}
</script>