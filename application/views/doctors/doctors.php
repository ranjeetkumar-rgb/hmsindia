 <?php $all_method =&get_instance(); ?>
 <style>
div.load_pop {
    position: fixed;
    top: 0;
    bottom: 0;
    margin: auto;
    z-index: 99999;
    left: 0;
    right: 0;
    width: 60%;
    background: #fff;
    height: 55%;
    padding: 20px 15px 15px 15px;
    box-shadow: 0px 0px 10px -4px #000;
    border-radius: 10px;
	display:none;
}
#load_pop_close {
    position: absolute;
    right: 20px;
    top: 8px;
    font-weight: 700;
    z-index: 9999;
}
img.pop_img {
    max-width: 100%;
}
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Doctors Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Fees (Rupee)</th>
                  <th>Fees (USD)</th>
                  <th>Centre</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){
			  			//var_dump($vl);die;
						$monday_morning_start_time = $monday_morning_end_time = $monday_morning_off = $monday_evening_start_time = $monday_evening_end_time = $monday_evening_off = $monday_off = $tuesday_morning_start_time = $tuesday_morning_end_time = $tuesdy_morning_off = $tuesday_evening_start_time = $tuesday_evening_end_time = $tuesdy_evening_off = $tuesday_off = $wednesday_morning_start_time = $wednesday_morning_end_time = $wednesday_morning_off = $wednesday_evening_start_time = $wednesday_evening_end_time = $wednesday_evening_off = $wednesday_off = $thursday_morning_start_time = $thursday_morning_end_time = $thursday_morning_off = $thursday_evening_start_time = $thursday_evening_end_time = $thursday_evening_off = $thursday_off = $friday_morning_start_time = $friday_morning_end_time = $friday_morning_off = $friday_evening_start_time = $friday_evening_end_time = $friday_evening_off = $friday_off = $saturday_morning_start_time = $saturday_morning_end_time = $saturday_morning_off = $saturday_evening_start_time = $saturday_evening_end_time = $saturday_evening_off = $saturday_off = $sunday_morning_start_time = $sunday_morning_end_time = $sunday_morning_off = $sunday_evening_start_time = $sunday_evening_end_time = $sunday_evening_off = $sunday_off = "OFF";
			   ?>
                <tr class="odd gradeX">
                  <td>
				  	<?php echo 'Dr. '.$vl['name']?>
                    <a href="javascript:void(0);" class="appoint_info" appoint_id="appointment_info_<?php echo $vl['ID']; ?>"> <i class="fa fa-info-circle" aria-hidden="true"></i> </a>
                    <div id="appointment_info_<?php echo $vl['ID']; ?>" class="load_pop">
                       <span class="load_pop_close">X</span>
                       <div class="col-sm-12 col-xs-12">
                            <table class="tg">
                                <thead>
                                  <tr>
                                    <th class="tg-0pky">Day/Time</th>
                                    <th class="tg-0lax">First half In</th>
                                    <th class="tg-0lax">First half Out</th>
                                    <th class="tg-0lax">Second half In</th>
                                    <th class="tg-0lax">Second half Out</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td class="tg-0lax">Monday</td>
                                    <td class="tg-0lax">
										<?php if($vl['monday_off'] == '0'){
													if($vl['monday_morning_off'] == '0'){echo $vl['monday_morning_start_time']; }else{echo $monday_morning_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['monday_off'] == '0'){
													if($vl['monday_morning_off'] == '0'){echo $vl['monday_morning_end_time']; }else{echo $monday_morning_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['monday_off'] == '0'){
													if($vl['monday_evening_off'] == '0'){echo $vl['monday_evening_start_time']; }else{echo $monday_evening_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['monday_off'] == '0'){
													if($vl['monday_evening_off'] == '0'){echo $vl['monday_evening_end_time']; }else{echo $monday_evening_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="tg-0lax">Tuesday</td>
                                    <td class="tg-0lax">
										<?php if($vl['tuesday_off'] == '0'){
													if($vl['tuesdy_morning_off'] == '0'){echo $vl['tuesday_morning_start_time']; }else{echo $tuesday_morning_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['tuesday_off'] == '0'){
													if($vl['tuesdy_morning_off'] == '0'){echo $vl['tuesday_morning_end_time']; }else{echo $tuesday_morning_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['tuesday_off'] == '0'){
													if($vl['tuesdy_evening_off'] == '0'){echo $vl['tuesday_evening_start_time']; }else{echo $tuesday_evening_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['tuesday_off'] == '0'){
													if($vl['tuesdy_evening_off'] == '0'){echo $vl['tuesday_evening_end_time']; }else{echo $tuesday_evening_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="tg-0lax">Wednesday</td>
                                   <td class="tg-0lax">
										<?php if($vl['wednesday_off'] == '0'){
													if($vl['wednesday_morning_off'] == '0'){echo $vl['wednesday_morning_start_time']; }else{echo $wednesday_morning_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['wednesday_off'] == '0'){
													if($vl['wednesday_morning_off'] == '0'){echo $vl['wednesday_morning_end_time']; }else{echo $wednesday_morning_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['wednesday_off'] == '0'){
													if($vl['wednesday_evening_off'] == '0'){echo $vl['wednesday_evening_start_time']; }else{echo $wednesday_evening_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['wednesday_off'] == '0'){
													if($vl['wednesday_evening_off'] == '0'){echo $vl['wednesday_evening_end_time']; }else{echo $wednesday_evening_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="tg-0lax">Thursday</td>
                                    <td class="tg-0lax">
										<?php if($vl['thursday_off'] == '0'){
													if($vl['thursday_morning_off'] == '0'){echo $vl['thursday_morning_start_time']; }else{echo $thursday_morning_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['thursday_off'] == '0'){
													if($vl['thursday_morning_off'] == '0'){echo $vl['thursday_morning_end_time']; }else{echo $thursday_morning_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['thursday_off'] == '0'){
													if($vl['thursday_evening_off'] == '0'){echo $vl['thursday_evening_start_time']; }else{echo $thursday_evening_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['thursday_off'] == '0'){
													if($vl['thursday_evening_off'] == '0'){echo $vl['thursday_evening_end_time']; }else{echo $thursday_evening_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="tg-0lax">Friday</td>
                                    <td class="tg-0lax">
										<?php if($vl['friday_off'] == '0'){
													if($vl['friday_morning_off'] == '0'){echo $vl['friday_morning_start_time']; }else{echo $friday_morning_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['friday_off'] == '0'){
													if($vl['friday_morning_off'] == '0'){echo $vl['friday_morning_end_time']; }else{echo $friday_morning_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['friday_off'] == '0'){
													if($vl['friday_evening_off'] == '0'){echo $vl['friday_evening_start_time']; }else{echo $friday_evening_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['friday_off'] == '0'){
													if($vl['friday_evening_off'] == '0'){echo $vl['friday_evening_end_time']; }else{echo $friday_evening_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="tg-0lax">Saturday</td>
                                   <td class="tg-0lax">
										<?php if($vl['saturday_off'] == '0'){
													if($vl['saturday_morning_off'] == '0'){echo $vl['saturday_morning_start_time']; }else{echo $saturday_morning_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['saturday_off'] == '0'){
													if($vl['saturday_morning_off'] == '0'){echo $vl['saturday_morning_end_time']; }else{echo $saturday_morning_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['saturday_off'] == '0'){
													if($vl['saturday_evening_off'] == '0'){echo $vl['saturday_evening_start_time']; }else{echo $saturday_evening_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['saturday_off'] == '0'){
													if($vl['saturday_evening_off'] == '0'){echo $vl['saturday_evening_end_time']; }else{echo $saturday_evening_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="tg-0lax">Sunday</td>
                                    <td class="tg-0lax">
										<?php if($vl['sunday_off'] == '0'){
													if($vl['sunday_morning_off'] == '0'){echo $vl['sunday_morning_start_time']; }else{echo $sunday_morning_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['sunday_off'] == '0'){
													if($vl['sunday_morning_off'] == '0'){echo $vl['sunday_morning_end_time']; }else{echo $sunday_morning_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['sunday_off'] == '0'){
													if($vl['sunday_evening_off'] == '0'){echo $vl['sunday_evening_start_time']; }else{echo $sunday_evening_start_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                    <td class="tg-0lax">
										<?php if($vl['sunday_off'] == '0'){
													if($vl['sunday_evening_off'] == '0'){echo $vl['sunday_evening_end_time']; }else{echo $sunday_evening_end_time;}
											  }else {echo $monday_off; }
										?>
                                    </td>
                                  </tr>
                            </tbody>
                         </table>
                       </div>
                    </div>
                  </td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['fees']?></td>
                  <td><?php echo '<i class="fa fa-usd" aria-hidden="true"></i> '.$vl['usd_fees']?></td>
                   <td><?php if($vl['center_id'] == 0){echo 'IndiaIVF';}else{ $center = $all_method->get_center($vl['center_id']); if(isset($center['center_name'])){echo $center['center_name'];}else{echo 'No center assigned';}} ?></td>
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><a href="<?php echo base_url();?>doctors/edit?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a> <a href="<?php echo base_url();?>doctors/delete?id=<?php echo $vl['ID']?>" class="delete"><i class="material-icons">delete</i></a></td>
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
$( "a.appoint_info" ).click(function() {
	var appoint_id = $(this).attr('appoint_id');
	$('#'+appoint_id).show();
});
$( ".load_pop_close" ).click(function() {
	$('.load_pop').hide();
});
</script>