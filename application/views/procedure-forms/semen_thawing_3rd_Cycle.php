<?php
    // php code to Insert data into mysql database from input text
    if(isset($_POST['submit'])){
        unset($_POST['submit']);
        
        $select_query = "SELECT * FROM `hms_semen_thawing` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
        $select_result = run_select_query($select_query); 
        if(empty($select_result)){
            // mysql query to insert data
            $query = "INSERT INTO `hms_semen_thawing` SET ";
            $sqlArr = array();
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".addslashes($value)."'";
            }		
            $query .= implode(',' , $sqlArr);
        }else{
            // mysql query to update data
            $query = "UPDATE hms_semen_thawing SET ";
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".$value."'"	;
            }
            $query .= implode(',' , $sqlArr);
            $query .= " WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
        }
        $result = run_form_query($query);        

        if($result){
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Procedure form inserted!').'&t='.base64_encode('success'));
					die();
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
					die();
        }
    }
    $select_query = "SELECT * FROM `hms_semen_thawing` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
    $select_result = run_select_query($select_query);  
	
	$sql3 = "SELECT * FROM `hms_patients` WHERE patient_id='$patient_id'";
    $select_result3 = run_select_query($sql3); 	
	
	$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$patient_id."'";
	$select_result1 = run_select_query($sql1);
	
	$sql4 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
	$select_result4 = run_select_query($sql4);
	
	$sql5 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result4['appoitment_for']."'";
	$select_result5 = run_select_query($sql5);	
	
	$sql_semen_freezing = "Select * from ".$this->config->item('db_prefix')."semen_freezing where patient_id='".$patient_id."' AND type='Third Cycle'";
	$select_semen_freezing = run_select_query($sql_semen_freezing);	
	
?>

<form enctype='multipart/form-data'  class ="searchform" name="form" action="" method="POST">
<input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">
<input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">
<input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">
  <input type="hidden" value="<?php echo $procedure_id; ?>" class="form" name="procedure_id">
  <input type="hidden" value="<?php echo $patient_id; ?>" class="form" name="patient_id">
  <input type="hidden" value="<?php echo $receipt_number; ?>" class="form" name="receipt_number">
  <input type="hidden" value="pending" name="status">
<input type="hidden" value="Third Cycle" name="type">  
    			<div class="container2 red-field form mt-5 mb-5">
    			<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="10"><img src="<?php echo base_url(); ?>/assets/images/India-IVF-Logo-Option-5.png" style="width:220px"></td>
   <td style="width:50%;padding:5px;" colspan="10"><h3 style="margin-top:20px;">SEMEN THAWING THIRD CYCLE</h3></td>
   </tr>
</table>

<table class="table table-bordered table-hover mt-2 table-sm red-field tableMg" style="width:100%; border:1px solid #cdcdcd;" >
     				  <table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">

<td colspan="3" width="34%" style="border:1px solid;padding:5px;">
<strong>UHID :  <?php echo $select_result5['center_code']."/".$select_result4['uhid']; ?></strong>
</td>
<td colspan="3" width="100%" style="border:1px solid;padding:5px;">
<strong>Patient Name : <?php echo $res_val->wife_name; ?> </strong>
</td>
</tr>
<tr>
<td colspan="6" width="33%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $select_result3['wife_name']; ?></strong>
</td>


</tr>
	   </table>		
					<div class='table-responsive2'>
    					<table class="table table-bordered table-hover mt-2 table-sm red-field">
					        <thead>
					        	<tr>
					        		<th colspan="6" style="background: #FFC000">SEMEN THAWING</th>
					        		<th colspan="1" style="background: #C5E0B3">TOTAL NO OF SEMEN VIAL REMAINING</th>
					        		<th colspan="1" style="background: #F4B083">REMARKS</th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="background: #FFC000">Date: <input type="date" value="<?php echo isset($select_result['date'])?$select_result['date']:""; ?>"  name="date"></th>
					        		<th colspan="1" style="background: #C5E0B3">Date: <input type="date" value="<?php echo isset($select_result['date1'])?$select_result['date1']:""; ?>"  name="date1"></th>
					        		<th colspan="1" style="background: #F4B083">Date: <input type="date" value="<?php echo isset($select_result['date1'])?$select_result['date1']:""; ?>"  name="date1"></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="background: #FFC000">Time: <input type="time" value="<?php echo isset($select_result['time'])?$select_result['time']:""; ?>"  name="time"></th>
					        		<th colspan="1" style="background: #C5E0B3">Diss.Time: <input type="time" value="<?php echo isset($select_result['time1'])?$select_result['time1']:""; ?>"  name="time1"></th>
					        		<th colspan="1" style="background: #F4B083">Diss.Time: <input type="time" value="<?php echo isset($select_result['time1'])?$select_result['time1']:""; ?>"  name="time1"></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="background: #FFC000">Emb: <input type="text" value="<?php echo isset($select_result['emb'])?$select_result['emb']:""; ?>"  maxlength="20" name="emb"  ></th>
					        		<th colspan="1" style="background: #C5E0B3">Score Time: <input type="time" value="<?php echo isset($select_result['score_time'])?$select_result['score_time']:""; ?>"  name="score_time" ></th>
					        		<th colspan="1" style="background: #F4B083">Score Time: <input type="time" value="<?php echo isset($select_result['score_time'])?$select_result['score_time']:""; ?>"  name="score_time" ></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="background: #FFC000">Dr: <input type="text" value="<?php echo isset($select_result['dr'])?$select_result['dr']:""; ?>"  name="dr"  ></th>
					        		<th colspan="1" style="background: #C5E0B3">Emb: <input type="text" value="<?php echo isset($select_result['emb'])?$select_result['emb']:""; ?>" name="emb"  ></th>
					        		<th colspan="1" style="background: #F4B083">Emb: <input type="text" value="<?php echo isset($select_result['emb'])?$select_result['emb']:""; ?>" name="emb"  ></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="background: #FFC000">Witness: <input type="text" value="<?php echo isset($select_result['witness1'])?$select_result['witness1']:""; ?>" name="witness1"  ></th>
					        		<th colspan="1" style="background: #C5E0B3">Witness: <input type="text" value="<?php echo isset($select_result['witness2'])?$select_result['witness2']:""; ?>" name="witness2"  ></th>
					        		<th colspan="1" style="background: #F4B083">Witness: <input type="text" value="<?php echo isset($select_result['witness2'])?$select_result['witness2']:""; ?>" name="witness2"  ></th>
					        	</tr>
					        </thead>
							 <thead>
					        	<tr>
					        		<th colspan="8" style="background: #FFC000">TOTAL NO OF VIALS FROZEN: <input type="text" value="<?php echo isset($select_semen_freezing['total_vials_frozen'])?$select_semen_freezing['total_vials_frozen']:""; ?>" readonly=""  ></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<td style="background: #FFC000">NO OF VIALS USED</td>
									<td style="background: #FFC000">HOLDER NO</td>
									<td style="background: #FFC000">POSITION</td>
									<td style="background: #FFC000">DEWAR</td>
									<td style="background: #FFC000">PURPOSE OF THAWING</td>
									<td style="background: #FFC000">ICSI /DISCARD</td>
									<td style="background: #C5E0B3"></td>
									<td style="background: #F4B083">REMARKS</td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_0'])?$select_result['no_0']:""; ?>" name="no_0"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_0'])?$select_result['hn_0']:""; ?>"  name="hn_0"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_0'])?$select_result['pn_0']:""; ?>" name="pn_0"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_0'])?$select_result['dewar_0']:""; ?>" name="dewar_0"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_0'])?$select_result['pot_0']:""; ?>"  name="pot_0"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_0'])?$select_result['icis_0']:""; ?>" name="icis_0"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_0'])?$select_result['remarks_0']:""; ?>" name="remarks_0" ></td>
							    	<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_0'])?$select_result['remarks_0']:""; ?>" name="remarks_0" ></td>
							    </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_1'])?$select_result['no_1']:""; ?>"  name="no_1"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_1'])?$select_result['hn_1']:""; ?>"  name="hn_1"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_1'])?$select_result['pn_1']:""; ?>"  name="pn_1"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_1'])?$select_result['dewar_1']:""; ?>"  name="dewar_1"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_1'])?$select_result['pot_1']:""; ?>" name="pot_1"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_1'])?$select_result['icis_1']:""; ?>" name="icis_1"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_1'])?$select_result['remarks_1']:""; ?>" name="remarks_1" ></td>
					        		<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_1'])?$select_result['remarks_1']:""; ?>" name="remarks_1" ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_2'])?$select_result['no_2']:""; ?>" name="no_2"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_2'])?$select_result['hn_2']:""; ?>"  name="hn_2"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_2'])?$select_result['pn_2']:""; ?>"  name="pn_2"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_2'])?$select_result['dewar_2']:""; ?>"  name="dewar_2"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_2'])?$select_result['pot_2']:""; ?>" name="pot_2"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_2'])?$select_result['icis_2']:""; ?>"  name="icis_2"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_2'])?$select_result['remarks_2']:""; ?>"  name="remarks_2" ></td>
					        		<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_2'])?$select_result['remarks_2']:""; ?>"  name="remarks_2" ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_3'])?$select_result['no_3']:""; ?>"  name="no_3" ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_3'])?$select_result['hn_3']:""; ?>"  name="hn_3"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_3'])?$select_result['pn_3']:""; ?>"  name="pn_3"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_3'])?$select_result['dewar_3']:""; ?>"  name="dewar_3"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_3'])?$select_result['pot_3']:""; ?>" name="pot_3"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_3'])?$select_result['icis_3']:""; ?>"  name="icis_3"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_3'])?$select_result['remarks_3']:""; ?>"  name="remarks_3" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_3'])?$select_result['remarks_3']:""; ?>"  name="remarks_3" ></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_4'])?$select_result['no_4']:""; ?>"  name="no_4"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_4'])?$select_result['hn_4']:""; ?>"  name="hn_4"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_4'])?$select_result['pn_4']:""; ?>"  name="pn_4" ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_4'])?$select_result['dewar_4']:""; ?>"  name="dewar_4"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_4'])?$select_result['pot_4']:""; ?>" name="pot_4"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_4'])?$select_result['icis_4']:""; ?>" name="icis_4"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_4'])?$select_result['remarks_4']:""; ?>" name="remarks_4" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_4'])?$select_result['remarks_4']:""; ?>" name="remarks_4" ></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_5'])?$select_result['no_5']:""; ?>"  name="no_5"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_5'])?$select_result['hn_5']:""; ?>"  name="hn_5"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_5'])?$select_result['pn_5']:""; ?>"  name="pn_5"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_5'])?$select_result['dewar_5']:""; ?>"  name="dewar_5"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_5'])?$select_result['pot_5']:""; ?>" name="pot_5"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_5'])?$select_result['icis_5']:""; ?>" name="icis_5"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_5'])?$select_result['remarks_5']:""; ?>" name="remarks_5" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_5'])?$select_result['remarks_5']:""; ?>" name="remarks_5" ></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_6'])?$select_result['no_6']:""; ?>" name="no_6"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_6'])?$select_result['hn_6']:""; ?>"  name="hn_6"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_6'])?$select_result['pn_6']:""; ?>" name="pn_6"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_6'])?$select_result['dewar_6']:""; ?>"  name="dewar_6"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_6'])?$select_result['pot_6']:""; ?>" name="pot_6"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_6'])?$select_result['icis_6']:""; ?>" name="icis_6"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_5'])?$select_result['remarks_5']:""; ?>" name="remarks_5" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_6'])?$select_result['remarks_6']:""; ?>" name="remarks_6" ></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_7'])?$select_result['no_7']:""; ?>"  name="no_7"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_7'])?$select_result['hn_7']:""; ?>"  name="hn_7"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_7'])?$select_result['pn_7']:""; ?>"  name="pn_7"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_7'])?$select_result['dewar_7']:""; ?>"  name="dewar_7"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_7'])?$select_result['pot_7']:""; ?>" name="pot_7"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_7'])?$select_result['icis_7']:""; ?>"  name="icis_7"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_5'])?$select_result['remarks_5']:""; ?>" name="remarks_5" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_7'])?$select_result['remarks_7']:""; ?>" name="remarks_7" ></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_8'])?$select_result['no_8']:""; ?>" name="no_8"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_8'])?$select_result['hn_8']:""; ?>"  name="hn_8"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_8'])?$select_result['pn_8']:""; ?>" name="pn_8"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_8'])?$select_result['dewar_8']:""; ?>"  name="dewar_8"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_8'])?$select_result['pot_8']:""; ?>"  name="pot_8"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_8'])?$select_result['icis_8']:""; ?>" name="icis_8"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_8'])?$select_result['remarks_8']:""; ?>"  name="remarks_8" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_8'])?$select_result['remarks_8']:""; ?>"  name="remarks_8" ></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_9'])?$select_result['no_9']:""; ?>" name="no_9"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_9'])?$select_result['hn_9']:""; ?>"  name="hn_9"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_9'])?$select_result['pn_9']:""; ?>"  name="pn_9"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_9'])?$select_result['dewar_9']:""; ?>" name="dewar_9"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_9'])?$select_result['pot_9']:""; ?>"  name="pot_9"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_9'])?$select_result['icis_9']:""; ?>"  name="icis_9"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_9'])?$select_result['remarks_9']:""; ?>"  name="remarks_9" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_9'])?$select_result['remarks_9']:""; ?>"  name="remarks_9" ></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['no_10'])?$select_result['no_10']:""; ?>"  name="no_10"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['hn_10'])?$select_result['hn_10']:""; ?>"  name="hn_10"  ></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pn_10'])?$select_result['pn_10']:""; ?>"  name="pn_10"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['dewar_10'])?$select_result['dewar_10']:""; ?>"  name="dewar_10"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['pot_10'])?$select_result['pot_10']:""; ?>"  name="pot_10"></td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['icis_10'])?$select_result['icis_10']:""; ?>" name="icis_10"></td>
									<td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['remarks_10'])?$select_result['remarks_10']:""; ?>" name="remarks_10" ></td>
									<td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['remarks_10'])?$select_result['remarks_10']:""; ?>" name="remarks_10" ></td>
								</tr>
					        </thead>
					    </table>
					</div>
					<input type="submit" name="submit" class="btn btn-primary mt-2 mb-2" value="submit">
				</div>
			</form>
			
			
	<!-- pRINT bUTTON -->		
			
			
<input type="button" id="btn" value="Print" class="btn btn-primary pull-right printbtn" onclick="printtable();">
            
<div  class="printtable prtable"  id="printtable"  style="display:none"> 
<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
   <tr>
   <td style="width:50%;padding:5px;" colspan="10"><img src="<?php echo base_url(); ?>/assets/images/India-IVF-Logo-Option-5.png" style="width:220px"></td>
   <td style="width:50%;padding:5px;" colspan="10"><h3 style="margin-top:20px;">SEMEN THAWING THIRD CYCLE</h3></td>
   </tr>
</table>

<table class="table table-bordered table-hover mt-2 table-sm red-field tableMg" style="width:100%; border:1px solid #cdcdcd;" >
     				  <table width="100%" class="vb45rt">
<tbody>
<tr style="background: #b3b9b7;">

<td colspan="3" width="34%" style="border:1px solid;padding:5px;">
<strong>UHID : <?php echo $select_result5['center_code']."/".$select_result4['uhid']; ?></strong>
</td>
<td colspan="3" width="100%" style="border:1px solid;padding:5px;">
<strong>Patient Name : <?php echo $select_result3['wife_name']; ?> </strong>
</td>
</tr>
<tr>
<td colspan="6" width="33%" style="border:1px solid;padding:5px;">
<strong>IIC ID: <?php echo $patient_id; ?></strong>
</td>


</tr>
	   </table>		
<table class="table table-bordered table-hover mt-2 table-sm red-field">
					        <thead>
					        	<tr>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">SEMEN THAWING</th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">TOTAL NO OF SEMEN VIAL REMAINING</th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">REMARKS</th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date'])?$select_result['date']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date1'])?$select_result['date1']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date1'])?$select_result['date1']:""; ?></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time'])?$select_result['time']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Diss.Time: <?php echo isset($select_result['time1'])?$select_result['time1']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Diss.Time: <?php echo isset($select_result['time1'])?$select_result['time1']:""; ?></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb'])?$select_result['emb']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Score Time: <?php echo isset($select_result['score_time'])?$select_result['score_time']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Score Time: <?php echo isset($select_result['score_time'])?$select_result['score_time']:""; ?></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Dr: <?php echo isset($select_result['dr'])?$select_result['dr']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb'])?$select_result['emb']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb'])?$select_result['emb']:""; ?></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Witness: <?php echo isset($select_result['witness1'])?$select_result['witness1']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Witness: <?php echo isset($select_result['witness2'])?$select_result['witness2']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Witness: <?php echo isset($select_result['witness2'])?$select_result['witness2']:""; ?></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<td style="border:1px solid #cdcdcd;">NO OF VIALS USED</td>
									<td style="border:1px solid #cdcdcd;">HOLDER NO</td>
									<td style="border:1px solid #cdcdcd;">POSITION</td>
									<td style="border:1px solid #cdcdcd;">DEWAR</td>
									<td style="border:1px solid #cdcdcd;">PURPOSE OF THAWING</td>
									<td style="border:1px solid #cdcdcd;">ICSI /DISCARD</td>
									<td style="border:1px solid #cdcdcd;"></td>
									<td style="border:1px solid #cdcdcd;">REMARKS</td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_0'])?$select_result['no_0']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_0'])?$select_result['hn_0']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_0'])?$select_result['pn_0']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_0'])?$select_result['dewar_0']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_0'])?$select_result['pot_0']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_0'])?$select_result['icis_0']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_0'])?$select_result['remarks_0']:""; ?></td>
							    	<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_0'])?$select_result['remarks_0']:""; ?></td>
							    </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_1'])?$select_result['no_1']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_1'])?$select_result['hn_1']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_1'])?$select_result['pn_1']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_1'])?$select_result['dewar_1']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_1'])?$select_result['pot_1']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_1'])?$select_result['icis_1']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_1'])?$select_result['remarks_1']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_1'])?$select_result['remarks_1']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_2'])?$select_result['no_2']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_2'])?$select_result['hn_2']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_2'])?$select_result['pn_2']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_2'])?$select_result['dewar_2']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_2'])?$select_result['pot_2']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_2'])?$select_result['icis_2']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_2'])?$select_result['remarks_2']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_2'])?$select_result['remarks_2']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_3'])?$select_result['no_3']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_3'])?$select_result['hn_3']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_3'])?$select_result['pn_3']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_3'])?$select_result['dewar_3']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_3'])?$select_result['pot_3']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_3'])?$select_result['icis_3']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_3'])?$select_result['remarks_3']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_3'])?$select_result['remarks_3']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_4'])?$select_result['no_4']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_4'])?$select_result['hn_4']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_4'])?$select_result['pn_4']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_4'])?$select_result['dewar_4']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_4'])?$select_result['pot_4']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_4'])?$select_result['icis_4']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_4'])?$select_result['remarks_4']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_4'])?$select_result['remarks_4']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_5'])?$select_result['no_5']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_5'])?$select_result['hn_5']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_5'])?$select_result['pn_5']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_5'])?$select_result['dewar_5']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_5'])?$select_result['pot_5']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_5'])?$select_result['icis_5']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_5'])?$select_result['remarks_5']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_5'])?$select_result['remarks_5']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_6'])?$select_result['no_6']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_6'])?$select_result['hn_6']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_6'])?$select_result['pn_6']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_6'])?$select_result['dewar_6']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_6'])?$select_result['pot_6']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_6'])?$select_result['icis_6']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_6'])?$select_result['remarks_6']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_6'])?$select_result['remarks_6']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_7'])?$select_result['no_7']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_7'])?$select_result['hn_7']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_7'])?$select_result['pn_7']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_7'])?$select_result['dewar_7']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_7'])?$select_result['pot_7']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_7'])?$select_result['icis_7']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_7'])?$select_result['remarks_7']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_7'])?$select_result['remarks_7']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_8'])?$select_result['no_8']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_8'])?$select_result['hn_8']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_8'])?$select_result['pn_8']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_8'])?$select_result['dewar_8']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_8'])?$select_result['pot_8']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_8'])?$select_result['icis_8']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_8'])?$select_result['remarks_8']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_8'])?$select_result['remarks_8']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_9'])?$select_result['no_9']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_9'])?$select_result['hn_9']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_9'])?$select_result['pn_9']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_9'])?$select_result['dewar_9']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_9'])?$select_result['pot_9']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_9'])?$select_result['icis_9']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_9'])?$select_result['remarks_9']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_9'])?$select_result['remarks_9']:""; ?></td>
								</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="border:1px solid #cdcdcd;height:25px;"><?php echo isset($select_result['no_10'])?$select_result['no_10']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['hn_10'])?$select_result['hn_10']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn_10'])?$select_result['pn_10']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['dewar_10'])?$select_result['dewar_10']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pot_10'])?$select_result['pot_10']:""; ?></td>
							        <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icis_10'])?$select_result['icis_10']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_10'])?$select_result['remarks_10']:""; ?></td>
									<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_10'])?$select_result['remarks_10']:""; ?></td>
								</tr>
					        </thead>
					    </table>

</div>
 <style type="text/css">
[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: static!important;
    left: -9999px;
    opacity: 1!important;
}
 </style>
						
<script> 
 function printtable() 
{    //alert();
  $('.searchform').hide();
   $('.printbtn').hide();
  $('.printbtn').css('display', 'hide');
  $('.prtable').css('display', 'block');
  var divToPrint=document.getElementById('printtable');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}
</script>						
			