<?php
$appoitmented_date = $_GET['appoitmented_date'];
$id = $_GET['id'];
    // php code to Insert data into mysql database from input text
    if(isset($_POST['submit'])){
        unset($_POST['submit']);
        
        
        if(!empty($_FILES['upload_photo_1']['tmp_name'])){
			$dest_path = $this->config->item('upload_path');
			$destination = $dest_path.'procedure-forms-uploads/';
			$NewImageName = rand(4,10000)."-".$_FILES['upload_photo_1']['name'];
			$transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;
			move_uploaded_file($_FILES['upload_photo_1']['tmp_name'], $destination.$NewImageName);
			$_POST['upload_photo_1'] = $transaction_img;
		}
       
        if (!empty($appoitmented_date)) {
			$sql = "SELECT * FROM `sperm_dna_fragmentation2` WHERE iic_id='$iic_id' AND appoitmented_date='$appoitmented_date'";
	} else {
			$sql = "SELECT * FROM `sperm_dna_fragmentation2` WHERE iic_id='$iic_id'";
	}
	$select_result = run_select_query($sql);
		
        $select_result = array();
        if(empty($select_result)){
            // mysql query to insert data
            $query = "INSERT INTO `sperm_dna_fragmentation2` SET ";
            $sqlArr = array();
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".addslashes($value)."'";
            }		
            $query .= implode(',' , $sqlArr);
        }else{
            // mysql query to update data
            $query = "UPDATE sperm_dna_fragmentation2 SET ";
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".$value."'"	;
            }
            $query .= implode(',' , $sqlArr);
            if($_SESSION['logged_doctor']['username']){
              $query .= " WHERE iic_id='$iic_id' and appoitmented_date='$appoitmented_date'";
	        }else{
	          $query .= " WHERE iic_id='$iic_id' and id='$id'";
	        }
        }
          $result = run_form_query($query);  
        
        if($result){
         header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Discharge form inserted!').'&t='.base64_encode('success'));
        	die();
        }else{
          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
		  die();
        }
    }
   
	
	 if (!empty($appoitmented_date)) {
			$sql = "SELECT * FROM `sperm_dna_fragmentation2` WHERE iic_id='$iic_id' AND appoitmented_date='$appoitmented_date'";
	} else {
			$sql = "SELECT * FROM `sperm_dna_fragmentation2` WHERE iic_id='$iic_id'";
	}
	$select_result = run_select_query($sql);

	$sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."'";
	$select_result1 = run_select_query($sql1);
	
	$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$select_result1['wife_phone']."' and paitent_type='new_patient'";
	$select_result2 = run_select_query($sql2);
	
	$sql3 = "Select * from ".$this->config->item('db_prefix')."centers where center_number='".$select_result2['appoitment_for']."'";
	$select_result3 = run_select_query($sql3);
?>

<div class="ga-pro">
<br>
<h3 style="text-align: center;  padding-bottom: 20px;">SPERM DNA FRAGMENTATION TEST REPORT</h3>
    <script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

<form action="" enctype='multipart/form-data' method="post">
  
  <input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">
  <input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">
  <input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">
<input type="hidden" value="<?php echo $appoitmented_date; ?>" class="form" name="appoitmented_date">
<div class="fg45rt">
<h5>PATIENT INFORMATION</h5>
</div>



<table width="100%">
 
  <tr>
    <td>HUSBAND NAME</td>
    <td> <?php echo $patient_data['husband_name']; ?>  </td>
    <td>AGE</td>
    <td> <?php echo $patient_data['husband_age']; ?> Years</td>
  </tr>
  <tr>
  <td>UHID</td>
<td><?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></td>
</tr>
  <tr>
    <td>WIFE NAME</td>
    <td><input type="text" class="WIFENAME" name="WIFE_NAME" value="<?php echo $patient_data['wife_name']; ?>"></td>
    <td>ID NO</td>
     <td> <input type="text" name="iic_id" value="<?php echo $iic_id;?>" readonly  > </td>
  
  </tr>
  <tr>
    <td> REF. BY DR: </td>
   <td> <input type="text" class="REF" name="REF"  value="<?php echo isset($select_result['REF'])?$select_result['REF']:""; ?>"> </td>
    <td>DATE</td>
    <td><input type="date" class="DATE" name="DATE"  value="<?php echo isset($select_result['DATE'])?$select_result['DATE']:""; ?>"> </td>
  </tr>
 
</table>

<div class="fg45rt">
<h5>CHARACTERSTICS</h5>
</div>
<table width="100%">
 
  <tr>
    <td>COLLECTION TIME</td>
    <td><input type="time" id=">COLLECTIONTIME" name="COLLECTION_TIME"  value="<?php echo isset($select_result['COLLECTION_TIME'])?$select_result['COLLECTION_TIME']:""; ?>"></td>
    <td>EXAMINATION TIME</td>
    <td><input type="time" id=">EXAMINATIONTIME" name="EXAMINATION_TIME"  value="<?php echo isset($select_result['EXAMINATION_TIME'])?$select_result['EXAMINATION_TIME']:""; ?>"></td>
  </tr>
  <tr>
    <td>COLLECTION TYPE</td>
    <td><input type="text" class="COLLECTIONTYPE" name="COLLECTION_TYPE"  value="<?php echo isset($select_result['COLLECTION_TYPE'])?$select_result['COLLECTION_TYPE']:""; ?>"> </td>
    <td>PLACE OF COLLECTION</td>
     <td><input type="text" class="PLACEOFCOLLECTION" name="PLACE_OF_COLLECTION" value="<?php echo isset($select_result['PLACE_OF_COLLECTION'])?$select_result['PLACE_OF_COLLECTION']:""; ?>"> </td>
  </tr>
  <tr>
    <td>SAMPLE</td>
    <td><input type="text" class="SAMPLE" name="SAMPLE" value="<?php echo isset($select_result['SAMPLE'])?$select_result['SAMPLE']:""; ?>">  </td>
    <td>ABSTINENCE</td>
    <td><input type="text" class="ABSTINENCE" name="ABSTINENCE"  value="<?php echo isset($select_result['ABSTINENCE'])?$select_result['ABSTINENCE']:""; ?>"> </td>
  </tr>
   <tr>
    <td>SPERM COUNT</td>
    <td><input type="text" class="SPERMCOUNT" name="SPERM_COUNT" value="<?php echo isset($select_result['SPERM_COUNT'])?$select_result['SPERM_COUNT']:""; ?>"> </td>
    <td>SEMEN VOLUME</td>
    <td><input type="text" class="SEMENVOLUME" name="SEMEN_VOLUME" value="<?php echo isset($select_result['SEMEN_VOLUME'])?$select_result['SEMEN_VOLUME']:""; ?>"> </td>
  </tr>
  <tr>
    <td>SPERM MOTILITY</td>
    <td><input type="text" class="SPERMMOTILITY" name="SPERM_MOTILITY" value="<?php echo isset($select_result['SPERM_MOTILITY'])?$select_result['SPERM_MOTILITY']:""; ?>"></td>
    <td>APPEARANCE</td>
    <td><input type="text" class="APPEARANCE" name="APPEARANCE" value="<?php echo isset($select_result['APPEARANCE'])?$select_result['APPEARANCE']:""; ?>"></td>
  </tr>
   <tr>
    <td>ROUND CELLS</td>
    <td><input type="text" class="ROUNDCELLS" name="ROUND_CELLS" value="<?php echo isset($select_result['ROUND_CELLS'])?$select_result['ROUND_CELLS']:""; ?>"> </td>
    <td>LIQUEFACTION</td>
    <td><input type="text" class="LIQUEFACTION" name="LIQUEFACTION" value="<?php echo isset($select_result['LIQUEFACTION'])?$select_result['LIQUEFACTION']:""; ?>"> </td>
  </tr>
  <tr>
    <td>NORMAL FORMS</td>
    <td><input type="text" class="NORMALFORMS" name="NORMAL_FORMS" value="<?php echo isset($select_result['NORMAL_FORMS'])?$select_result['NORMAL_FORMS']:""; ?>"></td>
    <td>VISCOCITY</td>
    <td><input type="text" class="VISCOCITY" name="VISCOCITY" value="<?php echo isset($select_result['VISCOCITY'])?$select_result['VISCOCITY']:""; ?>"></td>
  </tr>
 
</table>

<div class="fg45rt">
<h5 style="text-align: left;">DNA FRAGMENTATION INDEX (DFI): <input type="text" class="dna_frag_val" name="dna_frag_val" value="<?php echo isset($select_result['dna_frag_val'])?$select_result['dna_frag_val']:""; ?>"></h5>
</div>

<?php 

$Fragmented= $Not_Fragmented= 0;
@ $id=$select_result['iic_id'];
//echo $id; ?>
<?php if(!$id==null)  { ?>


<table class="bv45rt">
  <tr>
    <td style="width:70%;">
    
	
<?php

$BIG_HALO= $select_result['BIG_HALO'];
$MEDIUM_HALO= $select_result['MEDIUM_HALO'];
$SMALL_HALO= $select_result['SMALL_HALO'];
$WITHOUT_HALO= $select_result['WITHOUT_HALO'];
$Not_Fragmented = $Fragmented = 0;

$Not_Fragmented= ((!empty($BIG_HALO)?$BIG_HALO:0)+(!empty($MEDIUM_HALO)?$MEDIUM_HALO:0));
$Fragmented= ((!empty($SMALL_HALO)?$SMALL_HALO:0)+(!empty($WITHOUT_HALO)?$WITHOUT_HALO:0));
// $Fragmented= ($SMALL_HALO+$WITHOUT_HALO);

 


 $rating_data = array(
 array('Employee', 'Rating'),
 array('NOT FRAGMENTED ',$Not_Fragmented),
 array('FRAGMENTED ',$Fragmented),

);

 $encoded_data = json_encode($rating_data);
?>
<!--

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() 
{
 var data = google.visualization.arrayToDataTable(
 <?php  echo $encoded_data; ?>
 );
 var options = {
  title: "DNA FRAGMENTATION INDEX (DFI):"
 };
 var chart = new google.visualization.PieChart(document.getElementById("employee_piechart"));
 chart.draw(data, options);
}
</script>
<style>


#wrapper h1 p
{
 font-size:18px;
}
#employee_piechart
{
 padding:0px;
 width:500px;
 height:400px;
 
}
</style>

 <div id="employee_piechart" style=""></div>

	</td>
  
  <td>  
  
  <input type="file" value="<?php echo isset($select_result['upload_photo_1'])?$select_result['upload_photo_1']:""; ?>"  name="upload_photo_1">
  
  <img src="<?php echo $select_result['upload_photo_1'];?>"  style="max-width:400px; height:auto;">
  
  
					        		
  
  
  </td>
 
 
  </tr>
</table>

<?php } ?>



<p style="font-weight: 600;">NO. of Sperm Evaluated: <input type="text" class="Evaluated" name="Evaluated" value="<?php echo isset($select_result['Evaluated'])?$select_result['Evaluated']:""; ?>"> </p>

<div class="fg45rt4r">
<table>
<tbody>
<tr>
<td width="131">
<p><strong>BASIC CLASSIFICATION</strong></p>
</td>
<td width="129">
<p><strong>PERCENTAGE</strong></p>
</td>
</tr>
<tr>
<td width="131">
<p>BIG HALO</p>
</td>
<td width="131">
<input type="text" class="BIGHALO"  onkeypress="javascript:return isNumber(event)" minlength="1" maxlength="3" name="BIG_HALO" value="<?php echo isset($select_result['BIG_HALO'])?$select_result['BIG_HALO']:""; ?>">
</td>
</tr>
<tr>
<td width="131">
<p>MEDIUM HALO</p>
</td>
<td width="131">
<input type="text" class="MEDIUMHALO"  onkeypress="javascript:return isNumber(event)" minlength="1" maxlength="3" name="MEDIUM_HALO" value="<?php echo isset($select_result['MEDIUM_HALO'])?$select_result['MEDIUM_HALO']:""; ?>">
</td>
</tr>
<tr>
<td width="131">
<p>SMALL HALO</p>
</td>
<td width="131">
<input type="text" class="SMALLHALO" name="SMALL_HALO"   onkeypress="javascript:return isNumber(event)" minlength="1" maxlength="3" value="<?php echo isset($select_result['SMALL_HALO'])?$select_result['SMALL_HALO']:""; ?>">
</td>
</tr>
<tr>
<td width="131">
<p>WITHOUT HALO</p>
</td>
<td width="131">
<input type="text" class="WITHOUTHALO" name="WITHOUT_HALO"  onkeypress="javascript:return isNumber(event)" minlength="1" maxlength="3" value="<?php echo isset($select_result['WITHOUT_HALO'])?$select_result['WITHOUT_HALO']:""; ?>">
</td>
</tr>
</tbody>
</table>

<table>
<tbody>
<tr>
<td width="134">
</td>
<td width="130">
<p><strong>PERCENTAGE</strong></p>
</td>
</tr>
<tr>
<td width="134">
<p><strong>NOT FRAGMENTED</strong></p>
</td>
<td width="130">

<?php  echo $Not_Fragmented; ?> %
</td>
</tr>
<tr>
<td width="134">
<p><strong>FRAGMENTED</strong></p>
</td>
<td width="130">
    <?php echo $Fragmented; ?> %
</td>
</tr>
</tbody>
</table>

</div>-->

<p style="font-weight:600; font-size: 20px; text-decoration: underline;">Interpretation of Result:</p>
<div class="bvfg45tr">
<p>0-15% Fragmentation : Higher fertility potential</p>
<p>> 15-25% Fragmentation :Good to fair fertility potential</p>
<p>> 25% Fragmentation : Poor fertility potential</p>
 </div>

<div class="fg45rt" style="margin-top: 20px;">
<h5 style="text-align: left;">Comment:</h5>
</div>

<table class="bv45rt">
  <tr>
    <td>
      Prepared By: <input type="text" class="Prepared" name="prepared_by" value="<?php echo isset($select_result['prepared_by'])?$select_result['prepared_by']:""; ?>">
    </td>
    <td>
     Checked By:  <input type="text" class="checked_by" name="checked_by" value="<?php echo isset($select_result['checked_by'])?$select_result['checked_by']:""; ?>">
    </td>
  </tr>
</table>
<div class="sec2">
  
<label for="other">Please take prescribed medicines / injections only. Dont skip/ stop any medicine on your own unless advised by the doctor.</label>
    
</div> 
<input type="submit" name="submit" value="submit">
</form>


</div>

<div class="row" id="print_this_section" style="display:none;">
<div class="ga-pro">
<table style="border:1px solid;width:100%;padding:5px;" class="fg45yu">
<tr>
   <td style="width:50%;padding:5px;" colspan="2"><img src="https://indiaivf.website/assets/images/india-ivf-logo.webp"></td>
   <td style="width:50%;padding:5px;" colspan="2"><h3 style="margin-top:20px;">SPERM DNA FRAGMENTATION TEST REPORT</h3></td>
</tr>
</table>


<table width="100%">
 <tr>
    <td colspan="4" width="100%"><h5>PATIENT INFORMATION</h5></td>    
  </tr>
  <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">HUSBAND NAME</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo $patient_data['husband_name']; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">AGE</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo $patient_data['husband_age']; ?> Years</td>
  </tr>
    <tr>
<td colspan="1" width="25%" style="border:1px solid;padding:5px;">WIFE NAME</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo $patient_data['wife_name']; ?></td>
</tr>
  <tr>
    
	  <td colspan="1" width="25%" style="border:1px solid;padding:5px;">UHID</td>
<td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo $select_result3['center_code']."/".$select_result2['uhid']; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">ID NO</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"> <?php echo $iic_id;?></td>
  
  </tr>
  <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"> REF. BY DR: </td>
   <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['REF'])?$select_result['REF']:""; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">DATE</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['DATE'])?$select_result['DATE']:""; ?></td>
  </tr>
</table>

<div class="fg45rt">
<h5>CHARACTERSTICS</h5>
</div>
<table width="100%">
 
  <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">COLLECTION TIME</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['COLLECTION_TIME'])?$select_result['COLLECTION_TIME']:""; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">EXAMINATION TIME</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['EXAMINATION_TIME'])?$select_result['EXAMINATION_TIME']:""; ?></td>
  </tr>
  <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">COLLECTION TYPE</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['COLLECTION_TYPE'])?$select_result['COLLECTION_TYPE']:""; ?> </td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">PLACE OF COLLECTION</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['PLACE_OF_COLLECTION'])?$select_result['PLACE_OF_COLLECTION']:""; ?></td>
  </tr>
  <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">SAMPLE</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['SAMPLE'])?$select_result['SAMPLE']:""; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">ABSTINENCE</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['ABSTINENCE'])?$select_result['ABSTINENCE']:""; ?></td>
  </tr>
   <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">SPERM COUNT</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['SPERM_COUNT'])?$select_result['SPERM_COUNT']:""; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">SEMEN VOLUME</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['SEMEN_VOLUME'])?$select_result['SEMEN_VOLUME']:""; ?></td>
  </tr>
  <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">SPERM MOTILITY</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['SPERM_MOTILITY'])?$select_result['SPERM_MOTILITY']:""; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">APPEARANCE</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['APPEARANCE'])?$select_result['APPEARANCE']:""; ?></td>
  </tr>
   <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">ROUND CELLS</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['ROUND_CELLS'])?$select_result['ROUND_CELLS']:""; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">LIQUEFACTION</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['LIQUEFACTION'])?$select_result['LIQUEFACTION']:""; ?></td>
  </tr>
  <tr>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">NORMAL FORMS</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['NORMAL_FORMS'])?$select_result['NORMAL_FORMS']:""; ?></td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;">VISCOCITY</td>
    <td colspan="1" width="25%" style="border:1px solid;padding:5px;"><?php echo isset($select_result['VISCOCITY'])?$select_result['VISCOCITY']:""; ?></td>
  </tr>
 
</table>

<div class="fg45rt">
<h5 colspan="4" width="100%" style="border:1px solid;padding:5px;text-align:left;">DNA FRAGMENTATION INDEX (DFI): <?php echo isset($select_result['dna_frag_val'])?$select_result['dna_frag_val']:""; ?></h5>
</div>

<?php 

$Fragmented= $Not_Fragmented= 0;
@ $id=$select_result['iic_id'];
//echo $id; ?>
<?php if(!$id==null)  { ?>


<table class="bv45rt" width="100%" style="border:1px solid;padding:5px;">
  <tr>
    <td style="width:70%;">
    
	
<?php

$BIG_HALO= $select_result['BIG_HALO'];
$MEDIUM_HALO= $select_result['MEDIUM_HALO'];
$SMALL_HALO= $select_result['SMALL_HALO'];
$WITHOUT_HALO= $select_result['WITHOUT_HALO'];
$Not_Fragmented = $Fragmented = 0;

$Not_Fragmented= ((!empty($BIG_HALO)?$BIG_HALO:0)+(!empty($MEDIUM_HALO)?$MEDIUM_HALO:0));
$Fragmented= ((!empty($SMALL_HALO)?$SMALL_HALO:0)+(!empty($WITHOUT_HALO)?$WITHOUT_HALO:0));
// $Fragmented= ($SMALL_HALO+$WITHOUT_HALO);

 


 $rating_data = array(
 array('Employee', 'Rating'),
 array('NOT FRAGMENTED ',$Not_Fragmented),
 array('FRAGMENTED ',$Fragmented),

);

 $encoded_data = json_encode($rating_data);
?>
<!--

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() 
{
 var data = google.visualization.arrayToDataTable(
 <?php  echo $encoded_data; ?>
 );
 var options = {
  title: "DNA FRAGMENTATION INDEX (DFI):"
 };
 var chart = new google.visualization.PieChart(document.getElementById("employee_piechart"));
 chart.draw(data, options);
}
</script>
<style>
#wrapper h1 p
{
 font-size:18px;
}
#employee_piechart
{
 padding:0px;
 width:500px;
 height:400px;
}
</style>
 <div id="employee_piechart" style=""></div>
	</td>
  <td>  
  <?php echo isset($select_result['upload_photo_1'])?$select_result['upload_photo_1']:""; ?>  
  <img src="<?php echo $select_result['upload_photo_1'];?>"  style="max-width:400px; height:auto;">
  </td>
  </tr>
</table>
<?php } ?>



<p style="font-weight: 600;">NO. of Sperm Evaluated: <?php echo isset($select_result['Evaluated'])?$select_result['Evaluated']:""; ?></p>

<div class="fg45rt4r">
<table class="bv45rt" width="100%">
<tbody>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p><strong>BASIC CLASSIFICATION</strong></p>
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p><strong>PERCENTAGE</strong></p>
</td>
</tr>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p>BIG HALO</p>
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<?php echo isset($select_result['BIG_HALO'])?$select_result['BIG_HALO']:""; ?>
</td>
</tr>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p>MEDIUM HALO</p>
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<?php echo isset($select_result['MEDIUM_HALO'])?$select_result['MEDIUM_HALO']:""; ?>
</td>
</tr>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p>SMALL HALO</p>
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<?php echo isset($select_result['SMALL_HALO'])?$select_result['SMALL_HALO']:""; ?>
</td>
</tr>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p>WITHOUT HALO</p>
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<?php echo isset($select_result['WITHOUT_HALO'])?$select_result['WITHOUT_HALO']:""; ?>
</td>
</tr>
</tbody>
</table>

<table class="bv45rt" width="100%">
<tbody>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p><strong>PERCENTAGE</strong></p>
</td>
</tr>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p><strong>NOT FRAGMENTED</strong></p>
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">

<?php  echo $Not_Fragmented; ?> %
</td>
</tr>
<tr>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
<p><strong>FRAGMENTED</strong></p>
</td>
<td colspan="1" width="50%" style="border:1px solid;padding:5px;">
    <?php echo $Fragmented; ?> %
</td>
</tr>
</tbody>
</table>

</div>
-->

<table class="bv45rt" width="100%">
<tr>
    <td colspan="4" width="100%" style="text-align:left;border:1px solid;padding:5px;">
   <p style="font-weight:600; font-size: 20px; text-decoration: underline;">Interpretation of Result:</p>
<p>0-15% Fragmentation : Higher fertility potential</p>
<p>> 15-25% Fragmentation :Good to fair fertility potential</p>
<p>> 25% Fragmentation : Poor fertility potential</p>

<h5 style="text-align: left;">Comment:</h5>
</td>
  </tr>

  <tr>
    <td colspan="2" width="50%" style="border:1px solid;padding:5px;">
      Prepared By: <?php echo isset($select_result['prepared_by'])?$select_result['prepared_by']:""; ?>
    </td>
    <td colspan="2" width="50%" style="border:1px solid;padding:5px;">
     Checked By:  <?php echo isset($select_result['checked_by'])?$select_result['checked_by']:""; ?>
    </td>
  </tr>
  
<tr>
 <td colspan="4" width="100%" style="text-align:left;border:1px solid;padding:5px;">
 <label for="other">Please take prescribed medicines / injections only. Dont skip/ stop any medicine on your own unless advised by the doctor.</label>
 </td>
</tr>
</table>
</div>

 <style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    margin-bottom:20px ;
}
td {border: 1px  solid #000; text-align: center; font-weight: 600;}
.fg45rt { border: 1px solid #000; background: #e1d6d6; }
.fg45rt h5 { padding: 0px; margin: 0px; text-align: center; font-weight: 600; font-size: 18px; }
.fg45rt4r { display: flex; } 
.fg45rt4r table { margin-right: 50px; }
.bvfg45tr p {margin: 0px; padding: 0px;}
.bv45rt {margin-top: 20px;}
.bv45rt td {border: none;} 

 </style>
