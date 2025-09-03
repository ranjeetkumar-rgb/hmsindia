<?php
if (isset($_POST['submit'])) {
   extract($_POST);
   $id = $_GET['id'];
   $sql1 = "update freezing set gametes_frozen='$gametes_frozen',gametes_frozen_2='$gametes_frozen_2',gametes_frozen_3='$gametes_frozen_3',gametes_frozen_4='$gametes_frozen_4',gametes_frozen_5='$gametes_frozen_5',   
   intimation_for_freezing='$intimation_for_freezing',intimation_for_freezing_2='$intimation_for_freezing_2',intimation_for_freezing_3='$intimation_for_freezing_3',intimation_for_freezing_4='$intimation_for_freezing_4',intimation_for_freezing_5='$intimation_for_freezing_5',
   mode_of_intimation='$mode_of_intimation',mode_of_intimation_2='$mode_of_intimation_2',mode_of_intimation_3='$mode_of_intimation_3',mode_of_intimation_4='$mode_of_intimation_4',mode_of_intimation_5='$mode_of_intimation_5', 
   cause_for_usage='$cause_for_usage',cause_for_usage_2='$cause_for_usage_2',cause_for_usage_3='$cause_for_usage_3',cause_for_usage_4='$cause_for_usage_4',cause_for_usage_5='$cause_for_usage_5',
   consent_form_signed='$consent_form_signed',consent_form_signed_2='$consent_form_signed_2',consent_form_signed_3='$consent_form_signed_3',consent_form_signed_4='$consent_form_signed_4',consent_form_signed_5='$consent_form_signed_5',
   discarded='$discarded',discarded_2='$discarded_2',discarded_3='$discarded_3',discarded_4='$discarded_4',discarded_5='$discarded_5',
   no_of_straws='$no_of_straws',no_of_straws_2='$no_of_straws_2',no_of_straws_3='$no_of_straws_3',no_of_straws_4='$no_of_straws_4',no_of_straws_5='$no_of_straws_5',
   number_of_embryo='$number_of_embryo',number_of_embryo_2='$number_of_embryo_2',number_of_embryo_3='$number_of_embryo_3',number_of_embryo_4='$number_of_embryo_4',number_of_embryo_5='$number_of_embryo_5',
   day_of_freezing='$day_of_freezing',day_of_freezing_2='$day_of_freezing_2',day_of_freezing_3='$day_of_freezing_3',day_of_freezing_4='$day_of_freezing_4',day_of_freezing_5='$day_of_freezing_5',
   unique_id='$unique_id',unique_id_2='$unique_id_2',unique_id_3='$unique_id_3',unique_id_4='$unique_id_4',unique_id_5='$unique_id_5',
   embryo_grade='$embryo_grade',embryo_grade_2='$embryo_grade_2',embryo_grade_3='$embryo_grade_3',embryo_grade_4='$embryo_grade_4',embryo_grade_5='$embryo_grade_5',
   embryo_cell_number='$embryo_cell_number',embryo_cell_number_2='$embryo_cell_number_2',embryo_cell_number_3='$embryo_cell_number_3',embryo_cell_number_4='$embryo_cell_number_4',embryo_cell_number_5='$embryo_cell_number_5',
   embryo_cell_details='$embryo_cell_details',embryo_cell_details_2='$embryo_cell_details_2',embryo_cell_details_3='$embryo_cell_details_3',embryo_cell_details_4='$embryo_cell_details_4',embryo_cell_details_5='$embryo_cell_details_5',
   blastocyst_embyo_size='$blastocyst_embyo_size',blastocyst_embyo_size_2='$blastocyst_embyo_size_2',blastocyst_embyo_size_3='$blastocyst_embyo_size_3',blastocyst_embyo_size_4='$blastocyst_embyo_size_4',blastocyst_embyo_size_5='$blastocyst_embyo_size_5',
   embryo_grade_detail='$embryo_grade_detail',embryo_grade_detail_2='$embryo_grade_detail_2',embryo_grade_detail_3='$embryo_grade_detail_3',embryo_grade_detail_4='$embryo_grade_detail_4',embryo_grade_detail_5='$embryo_grade_detail_5',
   straws_colour='$straws_colour',straws_colour_2='$straws_colour_2',straws_colour_3='$straws_colour_3',straws_colour_4='$straws_colour_4',straws_colour_5='$straws_colour_5',
   visotube='$visotube',visotube_2='$visotube_2',visotube_3='$visotube_3',visotube_4='$visotube_4',visotube_5='$visotube_5',
   goblet='$goblet',goblet_2='$goblet_2',goblet_3='$goblet_3',goblet_4='$goblet_4',goblet_5='$goblet_5',
   g_location='$g_location',g_location_2='$g_location_2',g_location_3='$g_location_3',g_location_4='$g_location_4',g_location_5='$g_location_5',
   dewar='$dewar',dewar_2='$dewar_2',dewar_3='$dewar_3',dewar_4='$dewar_4',dewar_5='$dewar_5',
   tank='$tank',tank_2='$tank_2',tank_3='$tank_3',tank_4='$tank_4',tank_5='$tank_5',
   freezing_done_by='$freezing_done_by',freezing_done_by_2='$freezing_done_by_2',freezing_done_by_3='$freezing_done_by_3',freezing_done_by_4='$freezing_done_by_4',freezing_done_by_5='$freezing_done_by_5',
   discard_done_by='$discard_done_by',discard_done_by_2='$discard_done_by_2',discard_done_by_3='$discard_done_by_3',discard_done_by_4='$discard_done_by_4',discard_done_by_5='$discard_done_by_5',
   discard_date='$discard_date',discard_date_2='$discard_date_2',discard_date_3='$discard_date_3',discard_date_4='$discard_date_4',discard_date_5='$discard_date_5',
   number_of_discard='$number_of_discard',number_of_discard_2='$number_of_discard_2',number_of_discard_3='$number_of_discard_3',number_of_discard_4='$number_of_discard_4',number_of_discard_5='$number_of_discard_5',
   number_of_frozen='$number_of_frozen',number_of_frozen_2='$number_of_frozen_2',number_of_frozen_3='$number_of_frozen_3',number_of_frozen_4='$number_of_frozen_4',number_of_frozen_5='$number_of_frozen_5',discard_status='$discard_status'
   where id = '$id'  ";
   $query2 = $this->db->query($sql1);
   $num = (int) $query2;
   if ($num > 0) {
   $_SESSION['MSG'] = "Your profile has been successfully updated.!!";
   } else {
   $_SESSION['MSG'] = "Your profile has not been updated.!!";
   }
}
   $id = $_GET['id'];
   $sql1 = "SELECT * FROM freezing WHERE id='$id'";
   $query = $this->db->query($sql1);
   $select_result1 = $query->result(); 
   foreach ($select_result1 as $res_val){ 
?>
<div class="col-md-12">
   <!-- Advanced Tables -->
   <!--Consultation  Tables -->
   <form action="" enctype='multipart/form-data' method="post">
   <div class="card">
      <div class="card-action">
         <h3>Freezing Data</h3>
      </div>
      
	  <div class="col-sm-12 col-xs-12">
</div>
<div class="clearfix"></div>
      <div class="card-content">
         <div class="table-responsive" style="background: #b3b9b7;">
		 
		 <table width="100%" class="vb45rt">
<tbody>
<tr>
<td colspan="2" style="width:50%;height:60px;padding-left: 15px;">
<strong> Patient Name : <?php echo $res_val->wife_name; ?></strong>
</td>
<td width="42%">
<strong> IIC ID: <?php echo $res_val->iic_id; ?></strong>
</td>
</tr>
<tr>
<td colspan="2" style="width:50%;height:60px;padding-left: 15px;">
<strong> Freezing Date : <?php echo $res_val->freezing_date; ?></strong>
</td>
<td width="42%">
<strong> Renewal Date/ Expiry Date :  <?php echo $res_val->expiry_date; ?> </strong>
</td>
</tr>
</tbody>
</table>
            <table class="table table-striped table-bordered table-hover" id="consultation_billing_list">
               <thead>
                  <tr>
                     <th>Gametes Frozen</th>
					 <th>Intimation For Freezing Renewal</th>
					 <th>Mode of Intimation</th>
					 <th>Cause For Usage/Discard</th>
					 <th>Consent Form Signed</th>
					 <th>Discarded</th>
                     <th>Number OF Vials/Straw Frozen</th>
                     <th>Number of Embryo/Egg Per Straw</th>
					 <th>Day of Freezing</th>
					 <th>Unique id of Embryo /Egg / Semen </th>
					 <th>Egg Grade</th>
					 <th>Embryo Cell Number</th>
                     <th>Embryo Cell Detail Day 4 and Above</th>
					 <th>Blastocyst Embryo Size</th>
					 <th>Embryo Grade Details</th>
					 <th>Straws Colour</th>
					 <th>Visotube</th>
                     <th>Goblet</th>
					 <th>G Location</th>
                     <th>Dewar</th>
                     <th>Tank</th>
                     <th>Freezing Done By</th>
					 <th>Thaw/Discard Done By</th>
					 <th>Thawed/Discard Date</th>
					 <th>Number of Frozen/Discard</th>
					 <th>Number of Remaining Gametes</th>
					 
				 </tr>
               </thead>
               <tbody id="consultation_result">
                 <tr class="odd gradeX">
				     <td>
					 <select class="form-control" id="gametes_frozen" name="gametes_frozen" value="<?php echo $res_val->gametes_frozen; ?>">
					 <option selected="" ><?php echo $res_val->gametes_frozen; ?></option><option value="Embryo">Embryo</option><option value="Egg">Egg</option><option value="Sperm">Sperm</option>
					 </select><hr>
					 <select class="form-control" id="gametes_frozen_2" name="gametes_frozen_2" value="<?php echo $res_val->gametes_frozen_2; ?>">
					 <option selected="" ><?php echo $res_val->gametes_frozen_2; ?></option><option value="Embryo">Embryo</option><option value="Egg">Egg</option><option value="Sperm">Sperm</option>
					 </select><hr><select class="form-control" id="gametes_frozen_3" name="gametes_frozen_3" value="<?php echo $res_val->gametes_frozen_3; ?>">
					 <option selected="" ><?php echo $res_val->gametes_frozen_3; ?></option><option value="Embryo">Embryo</option><option value="Egg">Egg</option><option value="Sperm">Sperm</option>
					 </select><hr><select class="form-control" id="gametes_frozen_4" name="gametes_frozen_4" value="<?php echo $res_val->gametes_frozen_4; ?>">
					 <option selected="" ><?php echo $res_val->gametes_frozen_4; ?></option><option value="Embryo">Embryo</option><option value="Egg">Egg</option><option value="Sperm">Sperm</option>
					 </select><hr><select class="form-control" id="gametes_frozen_5" name="gametes_frozen_5" value="<?php echo $res_val->gametes_frozen_5; ?>">
					 <option selected="" ><?php echo $res_val->gametes_frozen_5; ?></option><option value="Embryo">Embryo</option><option value="Egg">Egg</option><option value="Sperm">Sperm</option>
					 </select>
					</td>
					
					 <td>
					 <select class="form-control" id="intimation_for_freezing" name="intimation_for_freezing" value="<?php echo $res_val->intimation_for_freezing; ?>">
					 <option selected="" ><?php echo $res_val->intimation_for_freezing; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="intimation_for_freezing_2" name="intimation_for_freezing_2" value="<?php echo $res_val->intimation_for_freezing_2; ?>">
					 <option selected="" ><?php echo $res_val->intimation_for_freezing_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr><select class="form-control" id="intimation_for_freezing_3" name="intimation_for_freezing_3" value="<?php echo $res_val->intimation_for_freezing_3; ?>">
					 <option selected="" ><?php echo $res_val->intimation_for_freezing_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr><select class="form-control" id="intimation_for_freezing_4" name="intimation_for_freezing_4" value="<?php echo $res_val->intimation_for_freezing_4; ?>">
					 <option selected="" ><?php echo $res_val->intimation_for_freezing_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr><select class="form-control" id="intimation_for_freezing_5" name="intimation_for_freezing_5" value="<?php echo $res_val->intimation_for_freezing_5; ?>">
					 <option selected="" ><?php echo $res_val->intimation_for_freezing_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select>
					</td>
				  
				   <td>
					 <select class="form-control" id="mode_of_intimation" name="mode_of_intimation" value="<?php echo $res_val->mode_of_intimation; ?>">
					 <option selected="" ><?php echo $res_val->mode_of_intimation; ?></option><option value="PHONE CALL">PHONE CALL </option><option value="WHATSAPP">WHATSAPP</option><option value="E MAIL">E MAIL</option><option value="POSTAL">POSTAL</option><option value="ONE TO ONE">ONE TO ONE</option>
					 </select><hr>
					 <select class="form-control" id="mode_of_intimation_2" name="mode_of_intimation_2" value="<?php echo $res_val->mode_of_intimation_2; ?>">
					 <option selected="" ><?php echo $res_val->mode_of_intimation_2; ?></option><option value="PHONE CALL">PHONE CALL </option><option value="WHATSAPP">WHATSAPP</option><option value="E MAIL">E MAIL</option><option value="POSTAL">POSTAL</option><option value="ONE TO ONE">ONE TO ONE</option>
					 </select><hr> <select class="form-control" id="mode_of_intimation_3" name="mode_of_intimation_3" value="<?php echo $res_val->mode_of_intimation_3; ?>">
					 <option selected="" ><?php echo $res_val->mode_of_intimation_3; ?></option><option value="PHONE CALL">PHONE CALL </option><option value="WHATSAPP">WHATSAPP</option><option value="E MAIL">E MAIL</option><option value="POSTAL">POSTAL</option><option value="ONE TO ONE">ONE TO ONE</option>
					 </select><hr> <select class="form-control" id="mode_of_intimation_4" name="mode_of_intimation_4" value="<?php echo $res_val->mode_of_intimation_4; ?>">
					 <option selected="" ><?php echo $res_val->mode_of_intimation_4; ?></option><option value="PHONE CALL">PHONE CALL </option><option value="WHATSAPP">WHATSAPP</option><option value="E MAIL">E MAIL</option><option value="POSTAL">POSTAL</option><option value="ONE TO ONE">ONE TO ONE</option>
					 </select><hr> <select class="form-control" id="mode_of_intimation_5" name="mode_of_intimation_5" value="<?php echo $res_val->mode_of_intimation_5; ?>">
					 <option selected="" ><?php echo $res_val->mode_of_intimation_5; ?></option><option value="PHONE CALL">PHONE CALL </option><option value="WHATSAPP">WHATSAPP</option><option value="E MAIL">E MAIL</option><option value="POSTAL">POSTAL</option><option value="ONE TO ONE">ONE TO ONE</option>
					 </select>
					</td>
				  
				  <td>
					 <select class="form-control" id="cause_for_usage" name="cause_for_usage" value="<?php echo $res_val->cause_for_usage; ?>">
					 <option selected="" ><?php echo $res_val->cause_for_usage; ?></option><option value="Embryo">FROZEN EMBRYO TRANSFER </option><option value="Egg">ICSI</option><option value="Sperm">DON’T WANT TO PRESERVE</option>
					 </select><hr>
					<select class="form-control" id="cause_for_usage_2" name="cause_for_usage_2" value="<?php echo $res_val->cause_for_usage_2; ?>">
					 <option selected="" ><?php echo $res_val->cause_for_usage_2; ?></option><option value="Embryo">FROZEN EMBRYO TRANSFER </option><option value="Egg">ICSI</option><option value="Sperm">DON’T WANT TO PRESERVE</option>
					 </select><hr><select class="form-control" id="cause_for_usage_3" name="cause_for_usage_3" value="<?php echo $res_val->cause_for_usage_3; ?>">
					 <option selected="" ><?php echo $res_val->cause_for_usage_3; ?></option><option value="Embryo">FROZEN EMBRYO TRANSFER </option><option value="Egg">ICSI</option><option value="Sperm">DON’T WANT TO PRESERVE</option>
					 </select><hr><select class="form-control" id="cause_for_usage_4" name="cause_for_usage_4" value="<?php echo $res_val->cause_for_usage_4; ?>">
					 <option selected="" ><?php echo $res_val->cause_for_usage_4; ?></option><option value="Embryo">FROZEN EMBRYO TRANSFER </option><option value="Egg">ICSI</option><option value="Sperm">DON’T WANT TO PRESERVE</option>
					 </select><hr><select class="form-control" id="cause_for_usage_4" name="cause_for_usage_4" value="<?php echo $res_val->cause_for_usage_4; ?>">
					 <option selected="" ><?php echo $res_val->cause_for_usage_5; ?></option><option value="Embryo">FROZEN EMBRYO TRANSFER </option><option value="Egg">ICSI</option><option value="Sperm">DON’T WANT TO PRESERVE</option>
					 </select>
					</td>
				  
				   <td>
					 <select class="form-control" id="consent_form_signed" name="consent_form_signed" value="<?php echo $res_val->consent_form_signed; ?>">
					 <option selected="" ><?php echo $res_val->consent_form_signed; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr>
					<select class="form-control" id="consent_form_signed_2" name="consent_form_signed_2" value="<?php echo $res_val->consent_form_signed_2; ?>">
					 <option selected="" ><?php echo $res_val->consent_form_signed_2; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr><select class="form-control" id="consent_form_signed_3" name="consent_form_signed_3" value="<?php echo $res_val->consent_form_signed_3; ?>">
					 <option selected="" ><?php echo $res_val->consent_form_signed_3; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr><select class="form-control" id="consent_form_signed_4" name="consent_form_signed_4" value="<?php echo $res_val->consent_form_signed_4; ?>">
					 <option selected="" ><?php echo $res_val->consent_form_signed_4; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr><select class="form-control" id="consent_form_signed_5" name="consent_form_signed_5" value="<?php echo $res_val->consent_form_signed_5; ?>">
					 <option selected="" ><?php echo $res_val->consent_form_signed_5; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select>
					</td>
					 <td>
					 <select class="form-control" id="discarded" name="discarded" value="<?php echo $res_val->discarded; ?>">
					 <option selected="" ><?php echo $res_val->discarded; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr>
					<select class="form-control" id="discarded_2" name="discarded_2" value="<?php echo $res_val->discarded_2; ?>">
					 <option selected="" ><?php echo $res_val->discarded_2; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr><select class="form-control" id="discarded_3" name="discarded_3" value="<?php echo $res_val->discarded_3; ?>">
					 <option selected="" ><?php echo $res_val->discarded_3; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr><select class="form-control" id="discarded_4" name="discarded_4" value="<?php echo $res_val->discarded_4; ?>">
					 <option selected="" ><?php echo $res_val->discarded_4; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select><hr><select class="form-control" id="discarded_5" name="discarded_5" value="<?php echo $res_val->discarded_5; ?>">
					 <option selected="" ><?php echo $res_val->discarded_5; ?></option><option value="Embryo">Yes </option><option value="Egg">No</option>
					 </select>
					</td>
				  
				  
				  
                     <td>
					 <select class="form-control" id="no_of_straws" name="no_of_straws" value="<?php echo $res_val->no_of_straws; ?>">
					 <option selected="" ><?php echo $res_val->no_of_straws; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="no_of_straws_2" name="no_of_straws_2" value="<?php echo $res_val->no_of_straws_2; ?>">
					 <option selected="" ><?php echo $res_val->no_of_straws_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="no_of_straws_3" name="no_of_straws_3" value="<?php echo $res_val->no_of_straws_3; ?>">
					 <option selected="" ><?php echo $res_val->no_of_straws_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="no_of_straws_4" name="no_of_straws_4" value="<?php echo $res_val->no_of_straws_4; ?>">
					 <option selected="" ><?php echo $res_val->no_of_straws_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="no_of_straws_5" name="no_of_straws_5" value="<?php echo $res_val->no_of_straws_5; ?>">
					 <option selected="" ><?php echo $res_val->no_of_straws_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select>
					</td>
					
					<td>
					 <select class="form-control" id="number_of_embryo" name="number_of_embryo" value="<?php echo $res_val->number_of_embryo; ?>">
					 <option selected="" ><?php echo $res_val->number_of_embryo; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="number_of_embryo_2" name="number_of_embryo_2" value="<?php echo $res_val->number_of_embryo_2; ?>">
					 <option selected="" ><?php echo $res_val->number_of_embryo_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="number_of_embryo_3" name="number_of_embryo_3" value="<?php echo $res_val->number_of_embryo_3; ?>">
					 <option selected="" ><?php echo $res_val->number_of_embryo_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="number_of_embryo_4" name="number_of_embryo_4" value="<?php echo $res_val->number_of_embryo_4; ?>">
					 <option selected="" ><?php echo $res_val->number_of_embryo_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="number_of_embryo_5" name="number_of_embryo_5" value="<?php echo $res_val->number_of_embryo_5; ?>">
					 <option selected="" ><?php echo $res_val->number_of_embryo_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select>
					</td>
					<td>
					 <select class="form-control" id="day_of_freezing" name="day_of_freezing" value="<?php echo $res_val->day_of_freezing; ?>">
					 <option selected="" ><?php echo $res_val->day_of_freezing; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="day_of_freezing_2" name="day_of_freezing_2" value="<?php echo $res_val->day_of_freezing_2; ?>">
					 <option selected="" ><?php echo $res_val->day_of_freezing_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="day_of_freezing_3" name="day_of_freezing_3" value="<?php echo $res_val->day_of_freezing_3; ?>">
					 <option selected="" ><?php echo $res_val->day_of_freezing_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="day_of_freezing_4" name="day_of_freezing_4" value="<?php echo $res_val->day_of_freezing_4; ?>">
					 <option selected="" ><?php echo $res_val->day_of_freezing_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="day_of_freezing_5" name="day_of_freezing_5" value="<?php echo $res_val->day_of_freezing_5; ?>">
					 <option selected="" ><?php echo $res_val->day_of_freezing_5; ?></option><option value="0">0</option></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select>
					</td>
					 <td>
					 <input type="text" class="form-control" style="width: 150px;" id="unique_id" name="unique_id" value="<?php echo $res_val->unique_id; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="unique_id_2" name="unique_id_2" value="<?php echo $res_val->unique_id_2; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="unique_id_3" name="unique_id_3" value="<?php echo $res_val->unique_id_3; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="unique_id_4" name="unique_id_4" value="<?php echo $res_val->unique_id_4; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="unique_id_5" name="unique_id_5" value="<?php echo $res_val->unique_id_5; ?>" />
					 
					 
					 </td>
					  <td>
					 <select class="form-control" id="embryo_grade" name="embryo_grade" value="<?php echo $res_val->embryo_grade; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade; ?></option><option value="MII">MII</option><option value="MI">MI</option><option value="GV">GV</option>
					 </select><hr>
					 <select class="form-control" id="embryo_grade_2" name="embryo_grade_2" value="<?php echo $res_val->embryo_grade_2; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_2; ?></option><option value="MII">MII</option><option value="MI">MI</option><option value="GV">GV</option>
					 </select><hr>
					  <select class="form-control" id="embryo_grade_3" name="embryo_grade_3" value="<?php echo $res_val->embryo_grade_3; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_3; ?></option><option value="MII">MII</option><option value="MI">MI</option><option value="GV">GV</option>
					 </select><hr>
					  <select class="form-control" id="embryo_grade_4" name="embryo_grade_4" value="<?php echo $res_val->embryo_grade_4; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_4; ?></option><option value="MII">MII</option><option value="MI">MI</option><option value="GV">GV</option>
					 </select><hr>
					  <select class="form-control" id="embryo_grade_5" name="embryo_grade_5" value="<?php echo $res_val->embryo_grade_5; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_5; ?></option><option value="MII">MII</option><option value="MI">MI</option><option value="GV">GV</option>
					 </select>
					</td>
					<td> 
					 <select class="form-control" id="embryo_cell_number" name="embryo_cell_number" value="<?php echo $res_val->embryo_cell_number; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_number; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="embryo_cell_number_2" name="embryo_cell_number_2" value="<?php echo $res_val->embryo_cell_number_2; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_number_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="embryo_cell_number_3" name="embryo_cell_number_3" value="<?php echo $res_val->embryo_cell_number_3; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_number_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="embryo_cell_number_4" name="embryo_cell_number_4" value="<?php echo $res_val->embryo_cell_number_4; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_number_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="embryo_cell_number_5" name="embryo_cell_number_5" value="<?php echo $res_val->embryo_cell_number_5; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_number_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select>
					 </td>
					  <td>
					 <select class="form-control" id="embryo_cell_details" name="embryo_cell_details" value="<?php echo $res_val->embryo_cell_details; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_details; ?></option><option value="COMPACTION">COMPACTION</option><option value="EARLY BLASTOCYST">EARLY BLASTOCYST</option><option value="BLASTOCYST">BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="HATCHING BLASTOCYST">HATCHING BLASTOCYST</option>
					 </select><hr>
					 <select class="form-control" id="embryo_cell_details_2" name="embryo_cell_details_2" value="<?php echo $res_val->embryo_cell_details_2; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_details_2; ?></option><option value="COMPACTION">COMPACTION</option><option value="EARLY BLASTOCYST">EARLY BLASTOCYST</option><option value="BLASTOCYST">BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="HATCHING BLASTOCYST">HATCHING BLASTOCYST</option>
					 </select><hr>
					  <select class="form-control" id="embryo_cell_details_3" name="embryo_cell_details_3" value="<?php echo $res_val->embryo_cell_details_3; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_details_3; ?></option><option value="COMPACTION">COMPACTION</option><option value="EARLY BLASTOCYST">EARLY BLASTOCYST</option><option value="BLASTOCYST">BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="HATCHING BLASTOCYST">HATCHING BLASTOCYST</option>
					 </select><hr>
					  <select class="form-control" id="embryo_cell_details_4" name="embryo_cell_details_4" value="<?php echo $res_val->embryo_cell_details_4; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_details_4; ?></option><option value="COMPACTION">COMPACTION</option><option value="EARLY BLASTOCYST">EARLY BLASTOCYST</option><option value="BLASTOCYST">BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="HATCHING BLASTOCYST">HATCHING BLASTOCYST</option>
					 </select><hr>
					  <select class="form-control" id="embryo_cell_details_5" name="embryo_cell_details_5" value="<?php echo $res_val->embryo_cell_details_5; ?>">
					 <option selected="" ><?php echo $res_val->embryo_cell_details_5; ?></option><option value="COMPACTION">COMPACTION</option><option value="EARLY BLASTOCYST">EARLY BLASTOCYST</option><option value="BLASTOCYST">BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="EXPANDED BLASTOCYST">EXPANDED BLASTOCYST</option><option value="HATCHING BLASTOCYST">HATCHING BLASTOCYST</option>
					 </select>
					</td>
					
					<td> 
					 <select class="form-control" id="blastocyst_embyo_size" name="blastocyst_embyo_size" value="<?php echo $res_val->blastocyst_embyo_size; ?>">
					 <option selected="" ><?php echo $res_val->blastocyst_embyo_size; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
					 </select><hr>
					 <select class="form-control" id="blastocyst_embyo_size_2" name="blastocyst_embyo_size_2" value="<?php echo $res_val->blastocyst_embyo_size_2; ?>">
					 <option selected="" ><?php echo $res_val->blastocyst_embyo_size_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
					 </select><hr>
					 <select class="form-control" id="blastocyst_embyo_size_3" name="blastocyst_embyo_size_3" value="<?php echo $res_val->blastocyst_embyo_size_3; ?>">
					 <option selected="" ><?php echo $res_val->blastocyst_embyo_size_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
					 </select><hr>
					 <select class="form-control" id="blastocyst_embyo_size_4" name="blastocyst_embyo_size_4" value="<?php echo $res_val->blastocyst_embyo_size_4; ?>">
					 <option selected="" ><?php echo $res_val->blastocyst_embyo_size_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
					 </select><hr>
					 <select class="form-control" id="blastocyst_embyo_size_5" name="blastocyst_embyo_size_5" value="<?php echo $res_val->blastocyst_embyo_size_5; ?>">
					 <option selected="" ><?php echo $res_val->blastocyst_embyo_size_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
					 </select>
					 </td>
					
                     <td> 
					 <select class="form-control" id="embryo_grade_detail" name="embryo_grade_detail" value="<?php echo $res_val->embryo_grade_detail; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_detail; ?></option><option value="FRAGMENTATION">FRAGMENTATION</option><option value="AA">AA</option><option value="AB">AB</option><option value="AC">AC</option><option value="BA">BA</option><option value="BB">BB</option><option value="BC">BC</option><option value="CA">CA</option><option value="CB">CB</option><option value="CC">CC</option><option value="D">D</option>
					 </select><hr>
					 <select class="form-control" id="embryo_grade_detail_2" name="embryo_grade_detail_2" value="<?php echo $res_val->embryo_grade_detail_2; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_detail_2; ?></option><option value="FRAGMENTATION">FRAGMENTATION</option><option value="AA">AA</option><option value="AB">AB</option><option value="AC">AC</option><option value="BA">BA</option><option value="BB">BB</option><option value="BC">BC</option><option value="CA">CA</option><option value="CB">CB</option><option value="CC">CC</option><option value="D">D</option>
					 </select><hr>
					 <select class="form-control" id="embryo_grade_detail_3" name="embryo_grade_detail_3" value="<?php echo $res_val->embryo_grade_detail_3; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_detail_3; ?></option><option value="FRAGMENTATION">FRAGMENTATION</option><option value="AA">AA</option><option value="AB">AB</option><option value="AC">AC</option><option value="BA">BA</option><option value="BB">BB</option><option value="BC">BC</option><option value="CA">CA</option><option value="CB">CB</option><option value="CC">CC</option><option value="D">D</option>
					 </select><hr>
					 <select class="form-control" id="embryo_grade_detail_4" name="embryo_grade_detail_4" value="<?php echo $res_val->embryo_grade_detail_4; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_detail_4; ?></option><option value="FRAGMENTATION">FRAGMENTATION</option><option value="AA">AA</option><option value="AB">AB</option><option value="AC">AC</option><option value="BA">BA</option><option value="BB">BB</option><option value="BC">BC</option><option value="CA">CA</option><option value="CB">CB</option><option value="CC">CC</option><option value="D">D</option>
					 </select><hr>
					 <select class="form-control" id="embryo_grade_detail_5" name="embryo_grade_detail_5" value="<?php echo $res_val->embryo_grade_detail_5; ?>">
					 <option selected="" ><?php echo $res_val->embryo_grade_detail_5; ?></option><option value="AA">AA</option><option value="AB">AB</option><option value="AC">AC</option><option value="BA">BA</option><option value="BB">BB</option><option value="BC">BC</option><option value="CA">CA</option><option value="CB">CB</option><option value="CC">CC</option><option value="D">D</option>
					 </select>
					 </td>
					 
					<td>
					 <select class="form-control" id="straws_colour" name="straws_colour" value="<?php echo $res_val->straws_colour; ?>">
					 <option selected="" ><?php echo $res_val->straws_colour; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_2" name="straws_colour_2" value="<?php echo $res_val->straws_colour_2; ?>">
					 <option selected="" ><?php echo $res_val->straws_colour_2; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_3" name="straws_colour_3" value="<?php echo $res_val->straws_colour_3; ?>">
					 <option selected="" ><?php echo $res_val->straws_colour_3; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_4" name="straws_colour_4" value="<?php echo $res_val->straws_colour_4; ?>">
					 <option selected="" ><?php echo $res_val->straws_colour_4; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_5" name="straws_colour_5" value="<?php echo $res_val->straws_colour_5; ?>">
					 <option selected="" ><?php echo $res_val->straws_colour_5; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select>
					</td>
					
					 <td> 
					  <select class="form-control" id="visotube" name="visotube" value="<?php echo $res_val->visotube; ?>">
					 <option selected="" ><?php echo $res_val->visotube; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					  <select class="form-control" id="visotube_2" name="visotube_2" value="<?php echo $res_val->visotube_2; ?>">
					 <option selected="" ><?php echo $res_val->visotube_2; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					  <select class="form-control" id="visotube_3" name="visotube_3" value="<?php echo $res_val->visotube_3; ?>">
					 <option selected="" ><?php echo $res_val->visotube_3; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					  <select class="form-control" id="visotube_4" name="visotube_4" value="<?php echo $res_val->visotube_4; ?>">
					 <option selected="" ><?php echo $res_val->visotube_4; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					  <select class="form-control" id="visotube_5" name="visotube_5" value="<?php echo $res_val->visotube_5; ?>">
					 <option selected="" ><?php echo $res_val->visotube_5; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select>
					</td>
					
					 <td>
					  <select class="form-control" id="goblet" name="goblet" value="<?php echo $res_val->goblet; ?>">
					 <option selected="" ><?php echo $res_val->goblet; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					  <select class="form-control" id="goblet_2" name="goblet_2" value="<?php echo $res_val->goblet_2; ?>">
					 <option selected="" ><?php echo $res_val->goblet_2; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					  <select class="form-control" id="goblet_3" name="goblet_3" value="<?php echo $res_val->goblet_3; ?>">
					 <option selected="" ><?php echo $res_val->goblet_3; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					  <select class="form-control" id="goblet_4" name="goblet_4" value="<?php echo $res_val->goblet_4; ?>">
					 <option selected="" ><?php echo $res_val->goblet_4; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select><hr>
					 <select class="form-control" id="goblet_5" name="goblet_5" value="<?php echo $res_val->goblet_5; ?>">
					 <option selected="" ><?php echo $res_val->goblet_5; ?></option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK RED">BRICK RED</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY BLUE">SKY BLUE</option><option value="SEA GREEN">SEA GREEN</option>
					 </select>
					</td>
					
					 <td> 
					 <select class="form-control" id="g_location" name="g_location" value="<?php echo $res_val->g_location; ?>">
					 <option selected="" ><?php echo $res_val->g_location; ?></option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_2" name="g_location_2" value="<?php echo $res_val->g_location_2; ?>">
					 <option selected="" ><?php echo $res_val->g_location_2; ?></option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_3" name="g_location_3" value="<?php echo $res_val->g_location_3; ?>">
					 <option selected="" ><?php echo $res_val->g_location_3; ?></option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_4" name="g_location_4" value="<?php echo $res_val->g_location_4; ?>">
					 <option selected="" ><?php echo $res_val->g_location_4; ?></option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_5" name="g_location_5" value="<?php echo $res_val->g_location_5; ?>">
					 <option selected="" ><?php echo $res_val->g_location_5; ?></option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select>
					 </td>
					 
					   <td>
					 <select class="form-control" id="dewar" name="dewar" value="<?php echo $res_val->dewar; ?>">
					 <option selected="" ><?php echo $res_val->dewar; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_2" name="dewar_2" value="<?php echo $res_val->dewar_2; ?>">
					 <option selected="" ><?php echo $res_val->dewar_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_3" name="dewar_3" value="<?php echo $res_val->dewar_3; ?>">
					 <option selected="" ><?php echo $res_val->dewar_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_4" name="dewar_4" value="<?php echo $res_val->dewar_4; ?>">
					 <option selected="" ><?php echo $res_val->dewar_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_5" name="dewar_5" value="<?php echo $res_val->dewar_5; ?>">
					 <option selected="" ><?php echo $res_val->dewar_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select>
					 </td>
					 
					  <td> 
					<select class="form-control" id="tank" name="tank" value="<?php echo $res_val->tank; ?>">
					 <option selected="" ><?php echo $res_val->tank; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_2" name="tank_2" value="<?php echo $res_val->tank_2; ?>">
					 <option selected="" ><?php echo $res_val->tank_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_3" name="tank_3" value="<?php echo $res_val->tank_3; ?>">
					 <option selected="" ><?php echo $res_val->tank_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_4" name="tank_4" value="<?php echo $res_val->tank_4; ?>">
					 <option selected="" ><?php echo $res_val->tank_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_5" name="tank_5" value="<?php echo $res_val->tank_5; ?>">
					 <option selected="" ><?php echo $res_val->tank_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select>
					 </td>
					
                     <td>
					 <input type="text" class="form-control" style="width: 150px;" id="freezing_done_by" name="freezing_done_by" value="<?php echo $res_val->freezing_done_by; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="freezing_done_by_2" name="freezing_done_by_2" value="<?php echo $res_val->freezing_done_by_2; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="freezing_done_by_3" name="freezing_done_by_3" value="<?php echo $res_val->freezing_done_by_3; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="freezing_done_by_4" name="freezing_done_by_4" value="<?php echo $res_val->freezing_done_by_4; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="freezing_done_by_5" name="freezing_done_by_5" value="<?php echo $res_val->freezing_done_by_5; ?>" />
					 </td>
                     <td>
					 <input type="text" class="form-control" style="width: 150px;" id="discard_done_by" name="discard_done_by" value="<?php echo $res_val->discard_done_by; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="discard_done_by_2" name="discard_done_by_2" value="<?php echo $res_val->discard_done_by_2; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="discard_done_by_3" name="discard_done_by_3" value="<?php echo $res_val->discard_done_by_3; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="discard_done_by_4" name="discard_done_by_4" value="<?php echo $res_val->discard_done_by_4; ?>" />
					 <input type="text" class="form-control" style="width: 150px;" id="discard_done_by_5" name="discard_done_by_5" value="<?php echo $res_val->discard_done_by_5; ?>" />
					
					 </td>
					 <td> 
					 <input type="date" class="form-control" id="discard_date" name="discard_date" value="<?php echo $res_val->discard_date; ?>" />
					 <input type="date" class="form-control" id="discard_date_2" name="discard_date_2" value="<?php echo $res_val->discard_date_2; ?>" />
					 <input type="date" class="form-control" id="discard_date_3" name="discard_date_3" value="<?php echo $res_val->discard_date_3; ?>" />
					 <input type="date" class="form-control" id="discard_date_4" name="discard_date_4" value="<?php echo $res_val->discard_date_4; ?>" />
					 <input type="date" class="form-control" id="discard_date_5" name="discard_date_5" value="<?php echo $res_val->discard_date_5; ?>" />
					 </td>
                     <td>
					 
					 <select class="form-control" id="number_of_discard" name="number_of_discard" value="<?php echo $res_val->number_of_discard; ?>">
					 <option selected="" ><?php echo $res_val->number_of_discard; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="number_of_discard_2" name="number_of_discard_2" value="<?php echo $res_val->number_of_discard_2; ?>">
					 <option selected="" ><?php echo $res_val->number_of_discard_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
                     <select class="form-control" id="number_of_discard_3" name="number_of_discard_3" value="<?php echo $res_val->number_of_discard_3; ?>">
					 <option selected="" ><?php echo $res_val->number_of_discard_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="number_of_discard_4" name="number_of_discard_4" value="<?php echo $res_val->number_of_discard_4; ?>">
					 <option><?php echo $res_val->number_of_discard_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					 <select class="form-control" id="number_of_discard_5" name="number_of_discard_5" value="<?php echo $res_val->number_of_discard_5; ?>">
					 <option><?php echo $res_val->number_of_discard_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select>
					 </td>
                     <td>
					  <select class="form-control" id="number_of_frozen" name="number_of_frozen" value="<?php echo $res_val->number_of_frozen; ?>">
					 <option><?php echo $res_val->number_of_frozen; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="number_of_frozen_2" name="number_of_frozen_2" value="<?php echo $res_val->number_of_frozen_2; ?>">
					 <option><?php echo $res_val->number_of_frozen_2; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="number_of_frozen_3" name="number_of_frozen_3" value="<?php echo $res_val->number_of_frozen_3; ?>">
					 <option><?php echo $res_val->number_of_frozen_3; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="number_of_frozen_4" name="number_of_frozen_4" value="<?php echo $res_val->number_of_frozen_4; ?>">
					 <option><?php echo $res_val->number_of_frozen_4; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="number_of_frozen_5" name="number_of_frozen_5" value="<?php echo $res_val->number_of_frozen_5; ?>">
					 <option><?php echo $res_val->number_of_frozen_5; ?></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select>
					 </td>
					 <td><select id="discard_status" name="discard_status" class="appointment_status">
                              <option value="">0</option>
                              <option value="discard">Discard</option>
							  <option value="used">Used</option>
							  <option value="delete">Delete</option>
                           </select></td>
				 </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <input type="submit" name="submit" value="submit">
   </form>
   <!--End Consultation  Tables -->
</div>
 <?php } ?>
 <style type="text/css">
 select.form-control {
    width: 90px;
    height: 30px;
    margin: 0px;
}
</style>



