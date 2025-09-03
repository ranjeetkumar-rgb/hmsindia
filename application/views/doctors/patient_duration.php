 <?php $all_method = &get_instance();
$countdownDuration = 120;
 ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
       <div class="card-action"><h3>OPD Consultation Duration</h3></div>
        <div class="col-sm-12 col-xs-12">
        <form action="<?php echo base_url().'doctors/patient_duration'; ?>" method="get">
		        <div class="col-sm-3 col-xs-12 ">
				        <label>Patient ID</label>
                <input type="text" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" class="form-control" />
            </div>
            <div class="col-sm-3 col-xs-12 ">
            	<label>Filter by Doctor</label>
                <select class="form-control" id="doctor" name="doctor">
                	<option value="">--Select--</option>
                    <?php $doctor_list = $all_method->center_doctors(); 
						 foreach($doctor_list as $key => $vals){
					?>
                	<option value="<?php echo $vals['ID']; ?>">Dr. <?php echo $vals['name']; ?></option>
                    <?php } ?>                    
                </select>
            </div>
            <div class="col-sm-3 col-xs-12">
            	<label>Filter by Center</label>
                <select class="form-control" id="center" name="center">
                	 <option value=''>--Select From--</option>
                   <option value="India IVF Fertility Gurgaon">India IVF Fertility Gurgaon</option>
                   <option value="India IVF Fertility Delhi">India IVF Fertility Delhi</option>
                   <option value="India IVF Fertility Noida">India IVF Fertility Noida</option>
                   <option value="Ghaziabad">India IVF Fertility Ghaziabad</option>
                   <option value="Srinagar">Srinagar</option>
                </select>
            </div>
            <div class="col-sm-3" style="margin-top: 22px;">
            	<button name="search" type="submit"  class="btn btn-primary">Search</button>
              <a href="<?php echo base_url().'doctors/patient_duration'; ?>" style="text-decoration: none;">
                <button name="search" type="submit"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
           
            </form>  
            
        </div>
		
         <div class="clearfix"></div>
        <div class="card-content">
	      <div id="msg_area" class="error"></div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="doctor_appointments1">
              <thead>
                <tr>
                  <th>S. No.</th>
				  <th>IIC ID</th>
                  <th>Patient Name</th>
                  <th>Husband Name</th>
				          <th>Doctor Name</th>
                  <th>Date</th>
                  <th>Center</th>
                  <th>Duration</th>
				</tr>
              </thead>
              <tbody id="appointment_body">
              <?php $count = 1; foreach($app_result as $ky => $vl){ 
                $sql = "SELECT * FROM `hms_doctor_consultation` WHERE appointment_id=".$vl['appointment_id']."";
                $select_result = run_select_query($sql);
                $sql2 = "SELECT * FROM `hms_doctors` WHERE ID=".$select_result['doctor_id']."";
                $select_result2 = run_select_query($sql2);
                ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><?php echo $vl['patient_id']; ?></td>
				  <td><?php echo $vl['female_name']; ?></td>
				  <td><?php echo $vl['male_name']; ?></td>
				  <td><?php echo $select_result2['name'];?></td>
          <td><?php echo $select_result['consultation_date'];?></td>
                  <td><?php echo $vl['center']; ?></td>
                  <td><?php if(!empty($vl['time_remaining'])) { echo $countdownDuration - $vl['time_remaining']; echo " Mint"; }  ?></td>
                </tr>
              <?php $count++; } ?>
              <tr>
                <td colspan="7">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
		
		
      </div>
      <!--End Advanced Tables -->
    </div>

<script>
    $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var data = {appointment_date:startDate, type:'particular_date_filter'};
          }
        });
    });
</script>
<script>
function printDiv2() {
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section2');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
</script>
<style >
.custom-pagination{
  padding:8px;
}
.custom-pagination a{
  padding:10px;
  text-decoration: none;
}
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
  </style>
