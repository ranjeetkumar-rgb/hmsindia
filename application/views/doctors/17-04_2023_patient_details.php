<?php
if (isset($_POST['submit'])) {
    extract($_POST);
	$id = $_GET['id'];
   $sql1 = "update freezing set 
   no_of_straws='$no_of_straws',no_of_straws_2='$no_of_straws_2',no_of_straws_3='$no_of_straws_3',no_of_straws_4='$no_of_straws_4',no_of_straws_5='$no_of_straws_5',
   no_of_embryo='$no_of_embryo',no_of_embryo_2='$no_of_embryo_2',no_of_embryo_3='$no_of_embryo_3',no_of_embryo_4='$no_of_embryo_4',no_of_embryo_5='$no_of_embryo_5', 
   unique_id='$unique_id',unique_id_2='$unique_id_2',unique_id_3='$unique_id_3',unique_id_4='$unique_id_4',unique_id_5='$unique_id_5',
   embryo_grade='$embryo_grade',embryo_grade_2='$embryo_grade_2',embryo_grade_3='$embryo_grade_3',embryo_grade_4='$embryo_grade_4',embryo_grade_5='$embryo_grade_5',embryo_grade_6='$embryo_grade_6',embryo_grade_7='$embryo_grade_7',embryo_grade_8='$embryo_grade_8',embryo_grade_9='$embryo_grade_9',embryo_grade_10='$embryo_grade_10',embryo_grade_11='$embryo_grade_11',embryo_grade_12='$embryo_grade_12',embryo_grade_13='$embryo_grade_13',embryo_grade_14='$embryo_grade_14',embryo_grade_15='$embryo_grade_15',embryo_grade_16='$embryo_grade_16',embryo_grade_17='$embryo_grade_17',embryo_grade_18='$embryo_grade_18',embryo_grade_19='$embryo_grade_19',embryo_grade_20='$embryo_grade_20',embryo_grade_21='$embryo_grade_21',embryo_grade_22='$embryo_grade_22',embryo_grade_23='$embryo_grade_23',embryo_grade_24='$embryo_grade_24',embryo_grade_25='$embryo_grade_25',
   straws_colour='$straws_colour',straws_colour_2='$straws_colour_2',straws_colour_3='$straws_colour_3',straws_colour_4='$straws_colour_4',straws_colour_5='$straws_colour_5',
   visotube='$visotube',visotube_2='$visotube_2',visotube_3='$visotube_3',visotube_4='$visotube_4',visotube_5='$visotube_5',
   goblet='$goblet',goblet_2='$goblet_2',goblet_3='$goblet_3',goblet_4='$goblet_4',goblet_5='$goblet_5',
   g_location='$g_location',g_location_2='$g_location_2',g_location_3='$g_location_3',g_location_4='$g_location_4',g_location_5='$g_location_5',
   dewar='$dewar',dewar_2='$dewar_2',dewar_3='$dewar_3',dewar_4='$dewar_4',dewar_5='$dewar_5',
   tank='$tank',tank_2='$tank_2',tank_3='$tank_3',tank_4='$tank_4',tank_5='$tank_5',
   thawed_On='$thawed_On',thawed_On_2='$thawed_On_2',thawed_On_3='$thawed_On_3',thawed_On_4='$thawed_On_4',thawed_On_5='$thawed_On_5',
   thawed_by='$thawed_by',thawed_by_2='$thawed_by_2',thawed_by_3='$thawed_by_3',thawed_by_4='$thawed_by_4',thawed_by_5='$thawed_by_5',
   remarks='$remarks',remarks_2='$remarks_2',remarks_3='$remarks_3',remarks_4='$remarks_4',remarks_5='$remarks_5',
   remain_embryo='$remain_embryo',remain_embryo_2='$remain_embryo_2',remain_embryo_3='$remain_embryo_3',remain_embryo_4='$remain_embryo_4',remain_embryo_5='$remain_embryo_5',
   freezing_done_by='$freezing_done_by',freezing_done_by_2='$freezing_done_by_2',freezing_done_by_3='$freezing_done_by_3',freezing_done_by_4='$freezing_done_by_4',freezing_done_by_5='$freezing_done_by_5',
   discard_status='$discard_status',discard_status_2='$discard_status_2',discard_status_3='$discard_status_3',discard_status_4='$discard_status_4',discard_status_5='$discard_status_5'
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
<strong> Expiry Date :  <?php echo $res_val->expiry_date; ?> </strong>
</td>
</tr>
</tbody>
</table>
            <table class="table table-striped table-bordered table-hover" id="consultation_billing_list">
               <thead>
                  <tr>
                    <th>No Of Straws</th>
                     <th>No Of Embryo</th>
					 <th>Unique Id</th>
					 <th colspan="5">Embryo Grade</th>
					 <th>Straws Colour</th>
                     <th>Visotube</th>
                     <th>Goblet</th>
                     <th>G Location</th>
                     <th>Dewar</th>
                     <th>Tank</th>
                     <th>Thawed On</th>
                     <th>Thawed By</th>
					 <th>Remarks</th>
                     <th>Remain Embryo</th>
					 <th>Freezing Done By</th>
					 <th>Discard Status</th>
					 
				 </tr>
               </thead>
               <tbody id="consultation_result">
                  <?php
                    // foreach ($select_result1 as $res_val){
                     ?>
                  <tr class="odd gradeX">
                     <td>
					 <select class="form-control" id="no_of_straws" name="no_of_straws" value="<?php echo $res_val->no_of_straws; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="no_of_straws_2" name="no_of_straws_2" value="<?php echo $res_val->no_of_straws_2; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="no_of_straws_3" name="no_of_straws_3" value="<?php echo $res_val->no_of_straws_3; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="no_of_straws_4" name="no_of_straws_4" value="<?php echo $res_val->no_of_straws_4; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr><select class="form-control" id="no_of_straws_5" name="no_of_straws_5" value="<?php echo $res_val->no_of_straws_5; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select>
					 <!--<input type="text" class="form-control" id="no_of_straws" name="no_of_straws" value="<?php// echo $res_val->no_of_straws; ?>" />
					 <input type="text" class="form-control" id="no_of_straws_2" name="no_of_straws_2" value="<?php// echo $res_val->no_of_straws_2; ?>" />
					 <input type="text" class="form-control" id="no_of_straws_3" name="no_of_straws_3" value="<?php //echo $res_val->no_of_straws_3; ?>" />
					 <input type="text" class="form-control" id="no_of_straws_4" name="no_of_straws_4" value="<?php //echo $res_val->no_of_straws_4; ?>" />
					 <input type="text" class="form-control" id="no_of_straws_5" name="no_of_straws_5" value="<?php //echo $res_val->no_of_straws_5; ?>" />
					 --></td>
                     <td> 
					 <select class="form-control" id="no_of_embryo" name="no_of_embryo" value="<?php echo $res_val->no_of_embryo; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="no_of_embryo_2" name="no_of_embryo_2" value="<?php echo $res_val->no_of_embryo_2; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="no_of_embryo_3" name="no_of_embryo_3" value="<?php echo $res_val->no_of_embryo_3; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="no_of_embryo_4" name="no_of_embryo_4" value="<?php echo $res_val->no_of_embryo_4; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select><hr>
					 <select class="form-control" id="no_of_embryo_5" name="no_of_embryo_5" value="<?php echo $res_val->no_of_embryo_5; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 </select>
					 <!--<input type="text" class="form-control" id="no_of_embryo" name="no_of_embryo" value="<?php //echo $res_val->no_of_embryo; ?>" />
					 <input type="text" class="form-control" id="no_of_embryo_2" name="no_of_embryo_2" value="<?php //echo $res_val->no_of_embryo_2; ?>" />
					 <input type="text" class="form-control" id="no_of_embryo_3" name="no_of_embryo_3" value="<?php //echo $res_val->no_of_embryo_3; ?>" />
					 <input type="text" class="form-control" id="no_of_embryo_4" name="no_of_embryo_4" value="<?php //echo $res_val->no_of_embryo_4; ?>" />
					 <input type="text" class="form-control" id="no_of_embryo_5" name="no_of_embryo_5" value="<?php //echo $res_val->no_of_embryo_5; ?>" />
					 --></td>
					 <td>
					 <select class="form-control" id="unique_id" name="unique_id" value="<?php echo $res_val->unique_id; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
					 <option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
					 </select><hr>
					  <select class="form-control" id="unique_id_2" name="unique_id_2" value="<?php echo $res_val->unique_id_2; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
					 <option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
					 </select><hr>
					  <select class="form-control" id="unique_id_3" name="unique_id_3" value="<?php echo $res_val->unique_id_3; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
					 <option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
					 </select><hr>
					  <select class="form-control" id="unique_id_4" name="unique_id_4" value="<?php echo $res_val->unique_id_4; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
					 <option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
					 </select><hr>
					  <select class="form-control" id="unique_id_5" name="unique_id_5" value="<?php echo $res_val->unique_id_5; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
					 <option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
					 </select>
					 <!--<input type="text" class="form-control" id="unique_id" name="unique_id" value="<?php //echo $res_val->unique_id; ?>" />
					 <input type="text" class="form-control" id="unique_id_2" name="unique_id_2" value="<?php //echo $res_val->unique_id_2; ?>" />
					 <input type="text" class="form-control" id="unique_id_3" name="unique_id_3" value="<?php //echo $res_val->unique_id_3; ?>" />
					 <input type="text" class="form-control" id="unique_id_4" name="unique_id_4" value="<?php //echo $res_val->unique_id_4; ?>" />
					 <input type="text" class="form-control" id="unique_id_5" name="unique_id_5" value="<?php //echo $res_val->unique_id_5; ?>" />
					 --></td>
					 <td>
					 <input type="text" class="form-control" id="embryo_grade" name="embryo_grade" value="<?php echo $res_val->embryo_grade; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_2" name="embryo_grade_2" value="<?php echo $res_val->embryo_grade_2; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_3" name="embryo_grade_3" value="<?php echo $res_val->embryo_grade_3; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_4" name="embryo_grade_4" value="<?php echo $res_val->embryo_grade_4; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_5" name="embryo_grade_5" value="<?php echo $res_val->embryo_grade_5; ?>" />
					 </td>
                      <td>
					 <input type="text" class="form-control" id="embryo_grade_6" name="embryo_grade_6" value="<?php echo $res_val->embryo_grade_6; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_7" name="embryo_grade_7" value="<?php echo $res_val->embryo_grade_7; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_8" name="embryo_grade_8" value="<?php echo $res_val->embryo_grade_8; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_9" name="embryo_grade_9" value="<?php echo $res_val->embryo_grade_9; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_10" name="embryo_grade_10" value="<?php echo $res_val->embryo_grade_10; ?>" />
					 </td>
                    <td>
					 <input type="text" class="form-control" id="embryo_grade_11" name="embryo_grade_11" value="<?php echo $res_val->embryo_grade_11; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_12" name="embryo_grade_12" value="<?php echo $res_val->embryo_grade_12; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_13" name="embryo_grade_13" value="<?php echo $res_val->embryo_grade_13; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_14" name="embryo_grade_14" value="<?php echo $res_val->embryo_grade_14; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_15" name="embryo_grade_15" value="<?php echo $res_val->embryo_grade_15; ?>" />
					 </td>
					 <td>
					 <input type="text" class="form-control" id="embryo_grade_16" name="embryo_grade_16" value="<?php echo $res_val->embryo_grade_16; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_17" name="embryo_grade_17" value="<?php echo $res_val->embryo_grade_17; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_18" name="embryo_grade_18" value="<?php echo $res_val->embryo_grade_18; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_19" name="embryo_grade_19" value="<?php echo $res_val->embryo_grade_19; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_20" name="embryo_grade_20" value="<?php echo $res_val->embryo_grade_20; ?>" />
					 </td>
                    <td>
					 <input type="text" class="form-control" id="embryo_grade_21" name="embryo_grade_21" value="<?php echo $res_val->embryo_grade_21; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_22" name="embryo_grade_22" value="<?php echo $res_val->embryo_grade_22; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_23" name="embryo_grade_23" value="<?php echo $res_val->embryo_grade_23; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_24" name="embryo_grade_24" value="<?php echo $res_val->embryo_grade_24; ?>" />
					 <input type="text" class="form-control" id="embryo_grade_25" name="embryo_grade_25" value="<?php echo $res_val->embryo_grade_25; ?>" />
					 </td>
                     <td>
					 <select class="form-control" id="straws_colour" name="straws_colour" value="<?php echo $res_val->straws_colour; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_2" name="straws_colour_2" value="<?php echo $res_val->straws_colour_2; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_3" name="straws_colour_3" value="<?php echo $res_val->straws_colour_3; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_4" name="straws_colour_4" value="<?php echo $res_val->straws_colour_4; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					 <select class="form-control" id="straws_colour_5" name="straws_colour_5" value="<?php echo $res_val->straws_colour_5; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select>
					 <!--
					 <input type="text" class="form-control" id="straws_colour" name="straws_colour" value="<?php //echo $res_val->straws_colour; ?>" />
					 <input type="text" class="form-control" id="straws_colour_2" name="straws_colour_2" value="<?php //echo $res_val->straws_colour_2; ?>" />
					 <input type="text" class="form-control" id="straws_colour_3" name="straws_colour_3" value="<?php //echo $res_val->straws_colour_3; ?>" />
					 <input type="text" class="form-control" id="straws_colour_4" name="straws_colour_4" value="<?php //echo $res_val->straws_colour_4; ?>" />
					 <input type="text" class="form-control" id="straws_colour_5" name="straws_colour_5" value="<?php //echo $res_val->straws_colour_5; ?>" />
					--> </td>
                     <td> 
					  <select class="form-control" id="visotube" name="visotube" value="<?php echo $res_val->visotube; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					  <select class="form-control" id="visotube_2" name="visotube_2" value="<?php echo $res_val->visotube_2; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					  <select class="form-control" id="visotube_3" name="visotube_3" value="<?php echo $res_val->visotube_3; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					  <select class="form-control" id="visotube_4" name="visotube_4" value="<?php echo $res_val->visotube_4; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					  <select class="form-control" id="visotube_5" name="visotube_5" value="<?php echo $res_val->visotube_5; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select>
					 <!--<input type="text" class="form-control" id="visotube" name="visotube" value="<?php //echo $res_val->visotube; ?>" />
					 <input type="text" class="form-control" id="visotube_2" name="visotube_2" value="<?php// echo $res_val->visotube_2; ?>" />
					 <input type="text" class="form-control" id="visotube_3" name="visotube_3" value="<?php //echo $res_val->visotube_3; ?>" />
					 <input type="text" class="form-control" id="visotube_4" name="visotube_4" value="<?php //echo $res_val->visotube_4; ?>" />
					 <input type="text" class="form-control" id="visotube_5" name="visotube_5" value="<?php //echo $res_val->visotube_5; ?>" />
					 --></td>
                     <td>
					  <select class="form-control" id="goblet" name="goblet" value="<?php echo $res_val->goblet; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					  <select class="form-control" id="goblet_2" name="goblet_2" value="<?php echo $res_val->goblet_2; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					  <select class="form-control" id="goblet_3" name="goblet_3" value="<?php echo $res_val->goblet_3; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					  <select class="form-control" id="goblet_4" name="goblet_4" value="<?php echo $res_val->goblet_4; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select><hr>
					 <select class="form-control" id="goblet_5" name="goblet_5" value="<?php echo $res_val->goblet_5; ?>">
					 <option selected="" >- - Select - -</option><option value="WHITE">WHITE</option><option value="YELLOW">YELLOW</option><option value="ORANGE">ORANGE</option><option value="PINK">PINK</option><option value="RED">RED</option>
					 <option value="GREY">GREY</option><option value="BLACK">BLACK</option><option value="GREEN">GREEN</option><option value="BRICK">BRICK</option><option value="BLUE">BLUE</option>
					 <option value="VIOLET">VIOLET</option><option value="SKY">SKY</option><option value="SEA">SEA</option>
					 </select>
					 <!--<input type="text" class="form-control" id="goblet" name="goblet" value="<?php //echo $res_val->goblet; ?>" />
					 <input type="text" class="form-control" id="goblet_2" name="goblet_2" value="<?php //echo $res_val->goblet_2; ?>" />
					 <input type="text" class="form-control" id="goblet_3" name="goblet_3" value="<?php //echo $res_val->goblet_3; ?>" />
					 <input type="text" class="form-control" id="goblet_4" name="goblet_4" value="<?php //echo $res_val->goblet_4; ?>" />
					 <input type="text" class="form-control" id="goblet_5" name="goblet_5" value="<?php //echo $res_val->goblet_5; ?>" />
					 --></td>
                     <td> 
					 <select class="form-control" id="g_location" name="g_location" value="<?php echo $res_val->g_location; ?>">
					 <option selected="" >- - Select - -</option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_2" name="g_location_2" value="<?php echo $res_val->g_location_2; ?>">
					 <option selected="" >- - Select - -</option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_3" name="g_location_3" value="<?php echo $res_val->g_location_3; ?>">
					 <option selected="" >- - Select - -</option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_4" name="g_location_4" value="<?php echo $res_val->g_location_4; ?>">
					 <option selected="" >- - Select - -</option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select><hr>
					 <select class="form-control" id="g_location_5" name="g_location_5" value="<?php echo $res_val->g_location_5; ?>">
					 <option selected="" >- - Select - -</option><option value="DOWN">DOWN</option><option value="UP">UP</option>
					 </select>
					 <!--<input type="text" class="form-control" id="g_location" name="g_location" value="<?php// echo $res_val->g_location; ?>" />
					 <input type="text" class="form-control" id="g_location_2" name="g_location_2" value="<?php //echo $res_val->g_location_2; ?>" />
					 <input type="text" class="form-control" id="g_location_3" name="g_location_3" value="<?php //echo $res_val->g_location_3; ?>" />
					 <input type="text" class="form-control" id="g_location_4" name="g_location_4" value="<?php //echo $res_val->g_location_4; ?>" />
					 <input type="text" class="form-control" id="g_location_5" name="g_location_5" value="<?php //echo $res_val->g_location_5; ?>" />
					 --></td>
                     <td>
					 <select class="form-control" id="dewar" name="dewar" value="<?php echo $res_val->dewar; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_2" name="dewar_2" value="<?php echo $res_val->dewar_2; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_3" name="dewar_3" value="<?php echo $res_val->dewar_3; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_4" name="dewar_4" value="<?php echo $res_val->dewar_4; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select><hr>
					 <select class="form-control" id="dewar_5" name="dewar_5" value="<?php echo $res_val->dewar_5; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 <option value="11">11</option><option value="12">12</option></select>
					 <!--<input type="text" class="form-control" id="dewar" name="dewar" value="<?php //echo $res_val->dewar; ?>" />
					 <input type="text" class="form-control" id="dewar_2" name="dewar_2" value="<?php //echo $res_val->dewar_2; ?>" />
					 <input type="text" class="form-control" id="dewar_3" name="dewar_3" value="<?php //echo $res_val->dewar_3; ?>" />
					 <input type="text" class="form-control" id="dewar_4" name="dewar_4" value="<?php //echo $res_val->dewar_4; ?>" />
					 <input type="text" class="form-control" id="dewar_5" name="dewar_5" value="<?php //echo $res_val->dewar_5; ?>" />
					 --></td>
                     <td> 
					<!-- <input type="text" class="form-control" id="tank" name="tank" value="<?php //echo $res_val->tank; ?>" />
					 <input type="text" class="form-control" id="tank_2" name="tank_2" value="<?php //echo $res_val->tank_2; ?>" />
					 <input type="text" class="form-control" id="tank_3" name="tank_3" value="<?php //echo $res_val->tank_3; ?>" />
					 <input type="text" class="form-control" id="tank_4" name="tank_4" value="<?php //echo $res_val->tank_4; ?>" />
					 <input type="text" class="form-control" id="tank_5" name="tank_5" value="<?php //echo $res_val->tank_5; ?>" />-->
					  <select class="form-control" id="tank" name="tank" value="<?php echo $res_val->tank; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_2" name="tank_2" value="<?php echo $res_val->tank_2; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_3" name="tank_3" value="<?php echo $res_val->tank_3; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_4" name="tank_4" value="<?php echo $res_val->tank_4; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select><hr>
					  <select class="form-control" id="tank_5" name="tank_5" value="<?php echo $res_val->tank_5; ?>">
					 <option selected="" >- - Select - -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					 <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
					 </select>
					 </td>
                     <td>
					 <input type="text" class="form-control" id="thawed_On" name="thawed_On" value="<?php echo $res_val->thawed_On; ?>" />
					 <input type="text" class="form-control" id="thawed_On_2" name="thawed_On_2" value="<?php echo $res_val->thawed_On_2; ?>" />
					 <input type="text" class="form-control" id="thawed_On_3" name="thawed_On_3" value="<?php echo $res_val->thawed_On_3; ?>" />
					 <input type="text" class="form-control" id="thawed_On_4" name="thawed_On_4" value="<?php echo $res_val->thawed_On_4; ?>" />
					 <input type="text" class="form-control" id="thawed_On_5" name="thawed_On_5" value="<?php echo $res_val->thawed_On_5; ?>" />
					 </td>
                     <td>
					 <input type="text" class="form-control" id="thawed_by" name="thawed_by" value="<?php echo $res_val->thawed_by; ?>" />
					 <input type="text" class="form-control" id="thawed_by_2" name="thawed_by_2" value="<?php echo $res_val->thawed_by_2; ?>" />
					 <input type="text" class="form-control" id="thawed_by_3" name="thawed_by_3" value="<?php echo $res_val->thawed_by_3; ?>" />
					 <input type="text" class="form-control" id="thawed_by_4" name="thawed_by_4" value="<?php echo $res_val->thawed_by_4; ?>" />
					 <input type="text" class="form-control" id="thawed_by_5" name="thawed_by_5" value="<?php echo $res_val->thawed_by_5; ?>" />
					 </td>
                     <td> 
					 <input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $res_val->remarks; ?>" />
					 <input type="text" class="form-control" id="remarks_2" name="remarks_2" value="<?php echo $res_val->remarks_2; ?>" />
					 <input type="text" class="form-control" id="remarks_3" name="remarks_3" value="<?php echo $res_val->remarks_3; ?>" />
					 <input type="text" class="form-control" id="remarks_4" name="remarks_4" value="<?php echo $res_val->remarks_4; ?>" />
					 <input type="text" class="form-control" id="remarks_5" name="remarks_5" value="<?php echo $res_val->remarks_5; ?>" />
					 </td>
                     <td><input type="text" class="form-control" id="remain_embryo" name="remain_embryo" value="<?php echo $res_val->remain_embryo; ?>" />
					 <input type="text" class="form-control" id="remain_embryo_2" name="remain_embryo_2" value="<?php echo $res_val->remain_embryo_2; ?>" />
					 <input type="text" class="form-control" id="remain_embryo_3" name="remain_embryo_3" value="<?php echo $res_val->remain_embryo_3; ?>" />
					 <input type="text" class="form-control" id="remain_embryo_4" name="remain_embryo_4" value="<?php echo $res_val->remain_embryo_4; ?>" />
					 <input type="text" class="form-control" id="remain_embryo_5" name="remain_embryo_5" value="<?php echo $res_val->remain_embryo_5; ?>" />
					 </td>
					 <td>
					 <input type="text" class="form-control" id="freezing_done_by" name="freezing_done_by" value="<?php echo $res_val->freezing_done_by; ?>" />
					 <input type="text" class="form-control" id="freezing_done_by_2" name="freezing_done_by_2" value="<?php echo $res_val->freezing_done_by_2; ?>" />
					 <input type="text" class="form-control" id="freezing_done_by_3" name="freezing_done_by_3" value="<?php echo $res_val->freezing_done_by_3; ?>" />
					 <input type="text" class="form-control" id="freezing_done_by_4" name="freezing_done_by_4" value="<?php echo $res_val->freezing_done_by_4; ?>" />
					 <input type="text" class="form-control" id="freezing_done_by_5" name="freezing_done_by_5" value="<?php echo $res_val->freezing_done_by_5; ?>" />
					 </td>
                     <td> 
					 <input type="text" class="form-control" id="discard_status" name="discard_status" value="<?php echo $discard_status;?>" />
					 <input type="text" class="form-control" id="discard_status_2" name="discard_status_2" value="<?php echo $discard_status_2;?>" />
					 <input type="text" class="form-control" id="discard_status_3" name="discard_status_3" value="<?php echo $discard_status_3;?>" />
					 <input type="text" class="form-control" id="discard_status_4" name="discard_status_4" value="<?php echo $discard_status_4;?>" />
					 <input type="text" class="form-control" id="discard_status_5" name="discard_status_5" value="<?php echo $discard_status_5;?>" />
					 </td>
                 </tr>
                  <?php// } ?>
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



