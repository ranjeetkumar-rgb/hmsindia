 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
       <style>
    	a#upload_procedures {
			text-align: right;
			width: 100%;
			display: block;
		}
		
		#upload_procedures {
			color: #000;
			text-decoration: none;
		}
    </style>
      <div class="card">
        <div class="card-action"><h3> Investigations Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>IIC ID</th>
                  <th>Receipt Number</th>
                  <th>Status (pendings)</th>
                  <th>On Date</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($investigations as $ky => $vl){ 
                  if(!empty($vl['investigations'])){
                  $check_count = check_patient_investigation($vl['patient_id'], $vl['receipt_number']);
                  $patient_data = get_patient_detail($vl['patient_id']);
              ?>
                <tr class="odd gradeX">
                  <td>
                    <?php if(isset($check_count['male_count']) && $check_count['male_count'] == 0 && isset($check_count['female_count']) && $check_count['female_count'] == 0){ ?> 
                      <a href="<?php echo base_url('/patient_reports/'.$vl['patient_id']);?>"><?php echo $patient_data['wife_name']; ?> (<?php echo $vl['patient_id']; ?>)</a>
                    <?php }else{ ?>
                      <a href="<?php echo base_url('/patient_investigation/'.$vl['patient_id']);?>?r=<?php echo $vl['receipt_number']; ?>"><?php echo $patient_data['wife_name']; ?> (<?php echo $vl['patient_id']; ?>)</a>
                    <?php } ?>
                  </td>
                  <td><?php echo $vl['receipt_number']; ?></td>
                  <td>
                        <?php if(isset($check_count['male_count']) && $check_count['male_count'] > 0){ echo "Male <span class='error'>(".$check_count['male_count'].")</span>, "; } ?>
                        <?php if(isset($check_count['female_count']) && $check_count['female_count'] > 0){ echo "Female <span class='error'>(".$check_count['female_count'].")</span>"; } ?>
                        <?php if(isset($check_count['male_count']) && $check_count['male_count'] == 0 && isset($check_count['female_count']) &&  $check_count['female_count'] == 0){ echo "<span class='success'>Uploaded</span>"; } ?>
                  </td>
                  <td><?php echo $vl['on_date']; ?></td>
                </tr>
              <?php }
              } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
<script>
  $( "#upload_procedures" ).click(function() {
    $( ".show_upload" ).toggle( "slow", function() {
    // Animation complete.
    });
  });
</script>