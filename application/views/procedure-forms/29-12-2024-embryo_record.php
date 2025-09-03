<?php
    // php code to Insert data into mysql database from input text
    if(isset($_POST['submit'])){
        unset($_POST['submit']);
        
       if(!empty($_FILES['upload_photo_0']['tmp_name'])){
			$dest_path = $this->config->item('upload_path');
			$destination = $dest_path.'procedure-forms-uploads/';
			$NewImageName = rand(4,10000)."-".$_FILES['upload_photo_0']['name'];
			$transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;
			move_uploaded_file($_FILES['upload_photo_0']['tmp_name'], $destination.$NewImageName);
			$_POST['upload_photo_0'] = $transaction_img;
		}
        
       
		if(!empty($_FILES['upload_photo_1']['tmp_name'])){
			$dest_path = $this->config->item('upload_path');
			$destination = $dest_path.'procedure-forms-uploads/';
			$NewImageName = rand(4,10000)."-".$_FILES['upload_photo_1']['name'];
			$transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;
			move_uploaded_file($_FILES['upload_photo_1']['tmp_name'], $destination.$NewImageName);
			$_POST['upload_photo_1'] = $transaction_img;
		}
        
        
		if(!empty($_FILES['upload_photo_2']['tmp_name'])){
			$dest_path = $this->config->item('upload_path');
			$destination = $dest_path.'procedure-forms-uploads/';
			$NewImageName = rand(4,10000)."-".$_FILES['upload_photo_2']['name'];
			$transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;
			move_uploaded_file($_FILES['upload_photo_2']['tmp_name'], $destination.$NewImageName);
			$_POST['upload_photo_2'] = $transaction_img;
		}
        
		if(!empty($_FILES['upload_photo_3']['tmp_name'])){
			$dest_path = $this->config->item('upload_path');
			$destination = $dest_path.'procedure-forms-uploads/';
			$NewImageName = rand(4,10000)."-".$_FILES['upload_photo_3']['name'];
			$transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;
			move_uploaded_file($_FILES['upload_photo_3']['tmp_name'], $destination.$NewImageName);
			$_POST['upload_photo_3'] = $transaction_img;
		}
        
		if(!empty($_FILES['upload_photo_4']['tmp_name'])){
			$dest_path = $this->config->item('upload_path');
			$destination = $dest_path.'procedure-forms-uploads/';
			$NewImageName = rand(4,10000)."-".$_FILES['upload_photo_4']['name'];
			$transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;
			move_uploaded_file($_FILES['upload_photo_4']['tmp_name'], $destination.$NewImageName);
			$_POST['upload_photo_4'] = $transaction_img;
		}
        
		if(!empty($_FILES['upload_photo_5']['tmp_name'])){
			$dest_path = $this->config->item('upload_path');
			$destination = $dest_path.'procedure-forms-uploads/';
			$NewImageName = rand(4,10000)."-".$_FILES['upload_photo_5']['name'];
			$transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;
			move_uploaded_file($_FILES['upload_photo_5']['tmp_name'], $destination.$NewImageName);
			$_POST['upload_photo_5'] = $transaction_img;
		}

        $select_query = "SELECT * FROM `embryo_record` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
        $select_result = run_select_query($select_query); 
        if(empty($select_result)){
            // mysql query to insert data
            $query = "INSERT INTO `embryo_record` SET ";
            $sqlArr = array();
            foreach( $_POST as $key=> $value )
            {
              $sqlArr[] = " $key = '".addslashes($value)."'";
            }		
            $query .= implode(',' , $sqlArr);
        }else{
            // mysql query to update data
            $query = "UPDATE embryo_record SET ";
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
    $select_query = "SELECT * FROM `embryo_record` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";
    $select_result = run_select_query($select_query);  
	
?>

<!-- <?php
  	// php code to Insert data into mysql database from input text
//   	if(isset($_POST['submit'])){
//     	$patient_id = $_POST['patient_id'];
//         $receipt_number = $_POST['receipt_number'];
// 		$status = $_POST['status'];

//     	// get values form input text and number
// 		$date0 = $_POST['date0'];
// 		$date1 = $_POST['date1'];
// 		$date2 = $_POST['date2'];
// 		$date3 = $_POST['date3'];
// 		$date4 = $_POST['date4'];
// 		$date5 = $_POST['date5'];
// 		$date6 = $_POST['date6'];
// 		$date7 = $_POST['date7'];
// 		$date8 = $_POST['date8'];
// 		$date9 = $_POST['date9'];
// 		$date10 = $_POST['date10'];
// 		$time0 = $_POST['time0'];
// 		$time1 = $_POST['time1'];
// 		$time2 = $_POST['time2'];
// 		$time3 = $_POST['time3'];
// 		$time4 = $_POST['time4'];
// 		$time5 = $_POST['time5'];
// 		$time6 = $_POST['time6'];
// 		$time7 = $_POST['time7'];
// 		$time8 = $_POST['time8'];
// 		$time9 = $_POST['time9'];
// 		$time10 = $_POST['time10'];
// 		$emb = $_POST['emb'];
// 		$score_time = $_POST['score_time'];
// 		$hrs0 = $_POST['hrs0'];
// 		$hrs1 = $_POST['hrs1'];
// 		$hrs2 = $_POST['hrs2'];
// 		$hrs3 = $_POST['hrs3'];
// 		$hrs4 = $_POST['hrs4'];
// 		$hrs5 = $_POST['hrs5'];
// 		$hrs6 = $_POST['hrs6'];
// 		$hrs7 = $_POST['hrs7'];
// 		$hrs8 = $_POST['hrs8'];
// 		$dr = $_POST['dr'];
// 		$emb0 = $_POST['emb0'];
// 		$emb1 = $_POST['emb1'];
// 		$emb2 = $_POST['emb2'];
// 		$emb3 = $_POST['emb3'];
// 		$emb4 = $_POST['emb4'];
// 		$emb5 = $_POST['emb5'];
// 		$emb6 = $_POST['emb6'];
// 		$emb7 = $_POST['emb7'];
// 		$emb8 = $_POST['emb8'];
// 		$emb9 = $_POST['emb9'];
// 		$witness0 = $_POST['witness0'];
// 		$witness1 = $_POST['witness1'];
// 		$witness2 = $_POST['witness2'];
// 		$wit0 = $_POST['wit0'];
// 		$wit1 = $_POST['wit1'];
// 		$wit2 = $_POST['wit2'];
// 		$wit3 = $_POST['wit3'];
// 		$wit4 = $_POST['wit4'];
// 		$wit5 = $_POST['wit5'];
// 		$wit6 = $_POST['wit6'];
// 		$wit7 = $_POST['wit7'];
// 		$ivf_inseminated = $_POST['ivf_inseminated'];
// 		$icsi_inseminated = $_POST['icsi_inseminated'];
// 		$ivf_injected = $_POST['ivf_injected'];
// 		$icsi_injected = $_POST['icsi_injected'];
// 		$ivf_degenerated = $_POST['ivf_degenerated'];
// 		$icsi_degenerated = $_POST['icsi_degenerated'];
// 		$ivf_oocytes = $_POST['ivf_oocytes'];
// 		$icsi_oocytes = $_POST['icsi_oocytes'];
// 		$ivf_oocytes_injected = $_POST['ivf_oocytes_injected'];
// 		$icsi_oocytes_injected = $_POST['icsi_oocytes_injected'];
// 		$no_fertilization = $_POST['no_fertilization'];
// 		$no_1_pn_oocyte = $_POST['no_1_pn_oocyte'];
// 		$oocyte_2pn_pb = $_POST['oocyte_2pn_pb'];
// 		$oocyte_2pn = $_POST['oocyte_2pn'];
// 		$cleaved_embryos = $_POST['cleaved_embryos'];
// 		$cell_embryos_day2 = $_POST['cell_embryos_day2'];
// 		$cell_embryos_day3 = $_POST['cell_embryos_day3'];
// 		$blastocysts_day5 = $_POST['blastocysts_day5'];
// 		$embryos_transferred = $_POST['embryos_transferred'];
// 		$embryos_frozen = $_POST['embryos_frozen'];
// 		$thawed_embryo_transferred = $_POST['thawed_embryo_transferred'];
// 		$embryos_intact = $_POST['embryos_intact'];
// 		$warmed_embryos = $_POST['warmed_embryos'];
// 		$intact_blasts = $_POST['intact_blasts'];
// 		$warmed_blasts = $_POST['warmed_blasts'];
// 		$embryos_hatched = $_POST['embryos_hatched'];
// 		$hyal_time = $_POST['hyal_time'];
// 		$hyal_time_emb = $_POST['hyal_time_emb'];
// 		$inj_time = $_POST['inj_time'];
// 		$inj_time_emb = $_POST['inj_time_emb'];
// 		$upload_photo_0 = $_POST['upload_photo_0'];
// 		$upload_photo_1 = $_POST['upload_photo_1'];
// 		$upload_photo_2 = $_POST['upload_photo_2'];
// 		$upload_photo_3 = $_POST['upload_photo_3'];
// 		$method = $_POST['method'];
// 		$upload_photo_4 = $_POST['upload_photo_4'];
// 		$upload_photo_5 = $_POST['upload_photo_5'];
// 		$no_0 = $_POST['no_0'];
// 		$egg_quality_0 = $_POST['egg_quality_0'];
// 		$comment_0 = $_POST['comment_0'];
// 		$pn1_0 = $_POST['pn1_0'];
// 		$pn2_0 = $_POST['pn2_0'];
// 		$pn3_0 = $_POST['pn3_0'];
// 		$degenerate = $_POST['degenerate'];
// 		$pb2 = $_POST['pb2'];
// 		$comments = $_POST['comments'];
// 		$cell_0 = $_POST['cell_0'];
// 		$grade_0 = $_POST['grade_0'];
// 		$clevage_time = $_POST['clevage_time'];
// 		$frag_0 = $_POST['frag_0'];
// 		$cell_1 = $_POST['cell_1'];
// 		$grade_1 = $_POST['grade_1'];
// 		$frag_1 = $_POST['frag_1'];
// 		$stage = $_POST['stage'];
// 		$grade_2 = $_POST['grade_2'];
// 		$frag_2 = $_POST['frag_2'];
// 		$date_0 = $_POST['date_0'];
// 		$media_0 = $_POST['media_0'];
// 		$container_no_0 = $_POST['container_no_0'];
// 		$straw_no = $_POST['straw_no'];
// 		$color = $_POST['color'];
// 		$embryos_frozen_0 = $_POST['embryos_frozen_0'];
// 		$storage_renewal_dt = $_POST['storage_renewal_dt'];
// 		$date_1 = $_POST['date_1'];
// 		$purpose_0 = $_POST['purpose_0'];
// 		$media_1 = $_POST['media_1'];
// 		$no_embryo_thawed = $_POST['no_embryo_thawed'];
// 		$thawing_path = $_POST['thawing_path'];
// 		$no_embryo_recovered = $_POST['no_embryo_recovered'];
// 		$date_2 = $_POST['date_2'];
// 		$reason = $_POST['reason'];
// 		$empty_0 = $_POST['empty_0'];
// 		$empty_1 = $_POST['empty_1'];
// 		$egg_quality_0_1 = $_POST['egg_quality_0_1'];
// 		$comment_0_1 = $_POST['comment_0_1'];
// 		$pn1_0_1 = $_POST['pn1_0_1'];
// 		$pn2_0_1 = $_POST['pn2_0_1'];
// 		$pn3_0_1 = $_POST['pn3_0_1'];
// 		$degenerate_1 = $_POST['degenerate_1'];
// 		$pb2_1 = $_POST['pb2_1'];
// 		$comments_1 = $_POST['comments_1'];
// 		$cell_0_1 = $_POST['cell_0_1'];
// 		$grade_0_1 = $_POST['grade_0_1'];
// 		$clevage_time_1 = $_POST['clevage_time_1'];
// 		$frag_0_1 = $_POST['frag_0_1'];
// 		$cell_1_1 = $_POST['cell_1_1'];
// 		$grade_1_1 = $_POST['grade_1_1'];
// 		$frag_1_1 = $_POST['frag_1_1'];
// 		$stage_1 = $_POST['stage_1'];
// 		$grade_2_1 = $_POST['grade_2_1'];
// 		$frag_2_1 = $_POST['frag_2_1'];
// 		$date_0_1 = $_POST['date_0_1'];
// 		$media_0_1 = $_POST['media_0_1'];
// 		$container_no_0_1 = $_POST['container_no_0_1'];
// 		$straw_no_1 = $_POST['straw_no_1'];
// 		$color_1 = $_POST['color_1'];
// 		$embryos_frozen_0_1 = $_POST['embryos_frozen_0_1'];
// 		$storage_renewal_dt_1 = $_POST['storage_renewal_dt_1'];
// 		$date_1_1 = $_POST['date_1_1'];
// 		$purpose_0_1 = $_POST['purpose_0_1'];
// 		$media_1_1 = $_POST['media_1_1'];
// 		$no_embryo_thawed_1 = $_POST['no_embryo_thawed_1'];
// 		$thawing_path_1 = $_POST['thawing_path_1'];
// 		$no_embryo_recovered_1 = $_POST['no_embryo_recovered_1'];
// 		$date_2_1 = $_POST['date_2_1'];
// 		$reason_1 = $_POST['reason_1'];
// 		$empty_0_1 = $_POST['empty_0_1'];
// 		$empty_1_1 = $_POST['empty_1_1'];
// 		$egg_quality_0_2 = $_POST['egg_quality_0_2'];
// 		$comment_0_2 = $_POST['comment_0_2'];
// 		$pn1_0_2 = $_POST['pn1_0_2'];
// 		$pn2_0_2 = $_POST['pn2_0_2'];
// 		$pn3_0_2 = $_POST['pn3_0_2'];
// 		$degenerate_2 = $_POST['degenerate_2'];
// 		$pb2_2 = $_POST['pb2_2'];
// 		$comments_2 = $_POST['comments_2'];
// 		$cell_0_2 = $_POST['cell_0_2'];
// 		$grade_0_2 = $_POST['grade_0_2'];
// 		$clevage_time_2 = $_POST['clevage_time_2'];
// 		$frag_0_2 = $_POST['frag_0_2'];
// 		$cell_1_2 = $_POST['cell_1_2'];
// 		$grade_1_2 = $_POST['grade_1_2'];
// 		$frag_1_2 = $_POST['frag_1_2'];
// 		$stage_2 = $_POST['stage_2'];
// 		$grade_2_2 = $_POST['grade_2_2'];
// 		$frag_2_2 = $_POST['frag_2_2'];
// 		$date_0_2 = $_POST['date_0_2'];
// 		$media_0_2 = $_POST['media_0_2'];
// 		$container_no_0_2 = $_POST['container_no_0_2'];
// 		$straw_no_2 = $_POST['straw_no_2'];
// 		$color_2 = $_POST['color_2'];
// 		$embryos_frozen_0_2 = $_POST['embryos_frozen_0_2'];
// 		$storage_renewal_dt_2 = $_POST['storage_renewal_dt_2'];
// 		$date_1_2 = $_POST['date_1_2'];
// 		$purpose_0_2 = $_POST['purpose_0_2'];
// 		$media_1_2 = $_POST['media_1_2'];
// 		$no_embryo_thawed_2 = $_POST['no_embryo_thawed_2'];
// 		$thawing_path_2 = $_POST['thawing_path_2'];
// 		$no_embryo_recovered_2 = $_POST['no_embryo_recovered_2'];
// 		$date_2_2 = $_POST['date_2_2'];
// 		$reason_2 = $_POST['reason_2'];
// 		$empty_0_2 = $_POST['empty_0_2'];
// 		$empty_1_2 = $_POST['empty_1_2'];
// 		$egg_quality_0_3 = $_POST['egg_quality_0_3'];
// 		$comment_0_3 = $_POST['comment_0_3'];
// 		$pn1_0_3 = $_POST['pn1_0_3'];
// 		$pn2_0_3 = $_POST['pn2_0_3'];
// 		$pn3_0_3 = $_POST['pn3_0_3'];
// 		$degenerate_3 = $_POST['degenerate_3'];
// 		$pb2_3 = $_POST['pb2_3'];
// 		$comments_3 = $_POST['comments_3'];
// 		$cell_0_3 = $_POST['cell_0_3'];
// 		$grade_0_3 = $_POST['grade_0_3'];
// 		$clevage_time_3 = $_POST['clevage_time_3'];
// 		$frag_0_3 = $_POST['frag_0_3'];
// 		$cell_1_3 = $_POST['cell_1_3'];
// 		$grade_1_3 = $_POST['grade_1_3'];
// 		$frag_1_3 = $_POST['frag_1_3'];
// 		$stage_3 = $_POST['stage_3'];
// 		$grade_2_3 = $_POST['grade_2_3'];
// 		$frag_2_3 = $_POST['frag_2_3'];
// 		$date_0_3 = $_POST['date_0_3'];
// 		$media_0_3 = $_POST['media_0_3'];
// 		$container_no_0_3 = $_POST['container_no_0_3'];
// 		$straw_no_3 = $_POST['straw_no_3'];
// 		$color_3 = $_POST['color_3'];
// 		$embryos_frozen_0_3 = $_POST['embryos_frozen_0_3'];
// 		$storage_renewal_dt_3 = $_POST['storage_renewal_dt_3'];
// 		$date_1_3 = $_POST['date_1_3'];
// 		$purpose_0_3 = $_POST['purpose_0_3'];
// 		$media_1_3 = $_POST['media_1_3'];
// 		$no_embryo_thawed_3 = $_POST['no_embryo_thawed_3'];
// 		$thawing_path_3 = $_POST['thawing_path_3'];
// 		$no_embryo_recovered_3 = $_POST['no_embryo_recovered_3'];
// 		$date_2_3 = $_POST['date_2_3'];
// 		$reason_3 = $_POST['reason_3'];
// 		$empty_0_3 = $_POST['empty_0_3'];
// 		$empty_1_3 = $_POST['empty_1_3'];
// 		$egg_quality_0_4 = $_POST['egg_quality_0_4'];
// 		$comment_0_4 = $_POST['comment_0_4'];
// 		$pn1_0_4 = $_POST['pn1_0_4'];
// 		$pn2_0_4 = $_POST['pn2_0_4'];
// 		$pn3_0_4 = $_POST['pn3_0_4'];
// 		$degenerate_4 = $_POST['degenerate_4'];
// 		$pb2_4 = $_POST['pb2_4'];
// 		$comments_4 = $_POST['comments_4'];
// 		$cell_0_4 = $_POST['cell_0_4'];
// 		$grade_0_4 = $_POST['grade_0_4'];
// 		$clevage_time_4 = $_POST['clevage_time_4'];
// 		$frag_0_4 = $_POST['frag_0_4'];
// 		$cell_1_4 = $_POST['cell_1_4'];
// 		$grade_1_4 = $_POST['grade_1_4'];
// 		$frag_1_4 = $_POST['frag_1_4'];
// 		$stage_4 = $_POST['stage_4'];
// 		$grade_2_4 = $_POST['grade_2_4'];
// 		$frag_2_4 = $_POST['frag_2_4'];
// 		$date_0_4 = $_POST['date_0_4'];
// 		$media_0_4 = $_POST['media_0_4'];
// 		$container_no_0_4 = $_POST['container_no_0_4'];
// 		$straw_no_4 = $_POST['straw_no_4'];
// 		$color_4 = $_POST['color_4'];
// 		$embryos_frozen_0_4 = $_POST['embryos_frozen_0_4'];
// 		$storage_renewal_dt_4 = $_POST['storage_renewal_dt_4'];
// 		$date_1_4 = $_POST['date_1_4'];
// 		$purpose_0_4 = $_POST['purpose_0_4'];
// 		$media_1_4 = $_POST['media_1_4'];
// 		$no_embryo_thawed_4 = $_POST['no_embryo_thawed_4'];
// 		$thawing_path_4 = $_POST['thawing_path_4'];
// 		$no_embryo_recovered_4 = $_POST['no_embryo_recovered_4'];
// 		$date_2_4 = $_POST['date_2_4'];
// 		$reason_4 = $_POST['reason_4'];
// 		$empty_0_4 = $_POST['empty_0_4'];
// 		$empty_1_4 = $_POST['empty_1_4'];
// 		$egg_quality_0_5 = $_POST['egg_quality_0_5'];
// 		$comment_0_5 = $_POST['comment_0_5'];
// 		$pn1_0_5 = $_POST['pn1_0_5'];
// 		$pn2_0_5 = $_POST['pn2_0_5'];
// 		$pn3_0_5 = $_POST['pn3_0_5'];
// 		$degenerate_5 = $_POST['degenerate_5'];
// 		$pb2_5 = $_POST['pb2_5'];
// 		$comments_5 = $_POST['comments_5'];
// 		$cell_0_5 = $_POST['cell_0_5'];
// 		$grade_0_5 = $_POST['grade_0_5'];
// 		$clevage_time_5 = $_POST['clevage_time_5'];
// 		$frag_0_5 = $_POST['frag_0_5'];
// 		$cell_1_5 = $_POST['cell_1_5'];
// 		$grade_1_5 = $_POST['grade_1_5'];
// 		$frag_1_5 = $_POST['frag_1_5'];
// 		$stage_5 = $_POST['stage_5'];
// 		$grade_2_5 = $_POST['grade_2_5'];
// 		$frag_2_5 = $_POST['frag_2_5'];
// 		$date_0_5 = $_POST['date_0_5'];
// 		$media_0_5 = $_POST['media_0_5'];
// 		$container_no_0_5 = $_POST['container_no_0_5'];
// 		$straw_no_5 = $_POST['straw_no_5'];
// 		$color_5 = $_POST['color_5'];
// 		$embryos_frozen_0_5 = $_POST['embryos_frozen_0_5'];
// 		$storage_renewal_dt_5 = $_POST['storage_renewal_dt_5'];
// 		$date_1_5 = $_POST['date_1_5'];
// 		$purpose_0_5 = $_POST['purpose_0_5'];
// 		$media_1_5 = $_POST['media_1_5'];
// 		$no_embryo_thawed_5 = $_POST['no_embryo_thawed_5'];
// 		$thawing_path_5 = $_POST['thawing_path_5'];
// 		$no_embryo_recovered_5 = $_POST['no_embryo_recovered_5'];
// 		$date_2_5 = $_POST['date_2_5'];
// 		$reason_5 = $_POST['reason_5'];
// 		$empty_0_5 = $_POST['empty_0_5'];
// 		$empty_1_5 = $_POST['empty_1_5'];
// 		$egg_quality_0_6 = $_POST['egg_quality_0_6'];
// 		$comment_0_6 = $_POST['comment_0_6'];
// 		$pn1_0_6 = $_POST['pn1_0_6'];
// 		$pn2_0_6 = $_POST['pn2_0_6'];
// 		$pn3_0_6 = $_POST['pn3_0_6'];
// 		$degenerate_6 = $_POST['degenerate_6'];
// 		$pb2_6 = $_POST['pb2_6'];
// 		$comments_6 = $_POST['comments_6'];
// 		$cell_0_6 = $_POST['cell_0_6'];
// 		$grade_0_6 = $_POST['grade_0_6'];
// 		$clevage_time_6 = $_POST['clevage_time_6'];
// 		$frag_0_6 = $_POST['frag_0_6'];
// 		$cell_1_6 = $_POST['cell_1_6'];
// 		$grade_1_6 = $_POST['grade_1_6'];
// 		$frag_1_6 = $_POST['frag_1_6'];
// 		$stage_6 = $_POST['stage_6'];
// 		$grade_2_6 = $_POST['grade_2_6'];
// 		$frag_2_6 = $_POST['frag_2_6'];
// 		$date_0_6 = $_POST['date_0_6'];
// 		$media_0_6 = $_POST['media_0_6'];
// 		$container_no_0_6 = $_POST['container_no_0_6'];
// 		$straw_no_6 = $_POST['straw_no_6'];
// 		$color_6 = $_POST['color_6'];
// 		$embryos_frozen_0_6 = $_POST['embryos_frozen_0_6'];
// 		$storage_renewal_dt_6 = $_POST['storage_renewal_dt_6'];
// 		$date_1_6 = $_POST['date_1_6'];
// 		$purpose_0_6 = $_POST['purpose_0_6'];
// 		$media_1_6 = $_POST['media_1_6'];
// 		$no_embryo_thawed_6 = $_POST['no_embryo_thawed_6'];
// 		$thawing_path_6 = $_POST['thawing_path_6'];
// 		$no_embryo_recovered_6 = $_POST['no_embryo_recovered_6'];
// 		$date_2_6 = $_POST['date_2_6'];
// 		$reason_6 = $_POST['reason_6'];
// 		$empty_0_6 = $_POST['empty_0_6'];
// 		$empty_1_6 = $_POST['empty_1_6'];
// 		$egg_quality_0_7 = $_POST['egg_quality_0_7'];
// 		$comment_0_7 = $_POST['comment_0_7'];
// 		$pn1_0_7 = $_POST['pn1_0_7'];
// 		$pn2_0_7 = $_POST['pn2_0_7'];
// 		$pn3_0_7 = $_POST['pn3_0_7'];
// 		$degenerate_7 = $_POST['degenerate_7'];
// 		$pb2_7 = $_POST['pb2_7'];
// 		$comments_7 = $_POST['comments_7'];
// 		$cell_0_7 = $_POST['cell_0_7'];
// 		$grade_0_7 = $_POST['grade_0_7'];
// 		$clevage_time_7 = $_POST['clevage_time_7'];
// 		$frag_0_7 = $_POST['frag_0_7'];
// 		$cell_1_7 = $_POST['cell_1_7'];
// 		$grade_1_7 = $_POST['grade_1_7'];
// 		$frag_1_7 = $_POST['frag_1_7'];
// 		$stage_7 = $_POST['stage_7'];
// 		$grade_2_7 = $_POST['grade_2_7'];
// 		$frag_2_7 = $_POST['frag_2_7'];
// 		$date_0_7 = $_POST['date_0_7'];
// 		$media_0_7 = $_POST['media_0_7'];
// 		$container_no_0_7 = $_POST['container_no_0_7'];
// 		$straw_no_7 = $_POST['straw_no_7'];
// 		$color_7 = $_POST['color_7'];
// 		$embryos_frozen_0_7 = $_POST['embryos_frozen_0_7'];
// 		$storage_renewal_dt_7 = $_POST['storage_renewal_dt_7'];
// 		$date_1_7 = $_POST['date_1_7'];
// 		$purpose_0_7 = $_POST['purpose_0_7'];
// 		$media_1_7 = $_POST['media_1_7'];
// 		$no_embryo_thawed_7 = $_POST['no_embryo_thawed_7'];
// 		$thawing_path_7 = $_POST['thawing_path_7'];
// 		$no_embryo_recovered_7 = $_POST['no_embryo_recovered_7'];
// 		$date_2_7 = $_POST['date_2_7'];
// 		$reason_7 = $_POST['reason_7'];
// 		$empty_0_7 = $_POST['empty_0_7'];
// 		$empty_1_7 = $_POST['empty_1_7'];
// 		$egg_quality_0_8 = $_POST['egg_quality_0_8'];
// 		$comment_0_8 = $_POST['comment_0_8'];
// 		$pn1_0_8 = $_POST['pn1_0_8'];
// 		$pn2_0_8 = $_POST['pn2_0_8'];
// 		$pn3_0_8 = $_POST['pn3_0_8'];
// 		$degenerate_8 = $_POST['degenerate_8'];
// 		$pb2_8 = $_POST['pb2_8'];
// 		$comments_8 = $_POST['comments_8'];
// 		$cell_0_8 = $_POST['cell_0_8'];
// 		$grade_0_8 = $_POST['grade_0_8'];
// 		$clevage_time_8 = $_POST['clevage_time_8'];
// 		$frag_0_8 = $_POST['frag_0_8'];
// 		$cell_1_8 = $_POST['cell_1_8'];
// 		$grade_1_8 = $_POST['grade_1_8'];
// 		$frag_1_8 = $_POST['frag_1_8'];
// 		$stage_8 = $_POST['stage_8'];
// 		$grade_2_8 = $_POST['grade_2_8'];
// 		$frag_2_8 = $_POST['frag_2_8'];
// 		$date_0_8 = $_POST['date_0_8'];
// 		$media_0_8 = $_POST['media_0_8'];
// 		$container_no_0_8 = $_POST['container_no_0_8'];
// 		$straw_no_8 = $_POST['straw_no_8'];
// 		$color_8 = $_POST['color_8'];
// 		$embryos_frozen_0_8 = $_POST['embryos_frozen_0_8'];
// 		$storage_renewal_dt_8 = $_POST['storage_renewal_dt_8'];
// 		$date_1_8 = $_POST['date_1_8'];
// 		$purpose_0_8 = $_POST['purpose_0_8'];
// 		$media_1_8 = $_POST['media_1_8'];
// 		$no_embryo_thawed_8 = $_POST['no_embryo_thawed_8'];
// 		$thawing_path_8 = $_POST['thawing_path_8'];
// 		$no_embryo_recovered_8 = $_POST['no_embryo_recovered_8'];
// 		$date_2_8 = $_POST['date_2_8'];
// 		$reason_8 = $_POST['reason_8'];
// 		$empty_0_8 = $_POST['empty_0_8'];
// 		$empty_1_8 = $_POST['empty_1_8'];
// 		$egg_quality_0_9 = $_POST['egg_quality_0_9'];
// 		$comment_0_9 = $_POST['comment_0_9'];
// 		$pn1_0_9 = $_POST['pn1_0_9'];
// 		$pn2_0_9 = $_POST['pn2_0_9'];
// 		$pn3_0_9 = $_POST['pn3_0_9'];
// 		$degenerate_9 = $_POST['degenerate_9'];
// 		$pb2_9 = $_POST['pb2_9'];
// 		$comments_9 = $_POST['comments_9'];
// 		$cell_0_9 = $_POST['cell_0_9'];
// 		$grade_0_9 = $_POST['grade_0_9'];
// 		$clevage_time_9 = $_POST['clevage_time_9'];
// 		$frag_0_9 = $_POST['frag_0_9'];
// 		$cell_1_9 = $_POST['cell_1_9'];
// 		$grade_1_9 = $_POST['grade_1_9'];
// 		$frag_1_9 = $_POST['frag_1_9'];
// 		$stage_9 = $_POST['stage_9'];
// 		$grade_2_9 = $_POST['grade_2_9'];
// 		$frag_2_9 = $_POST['frag_2_9'];
// 		$date_0_9 = $_POST['date_0_9'];
// 		$media_0_9 = $_POST['media_0_9'];
// 		$container_no_0_9 = $_POST['container_no_0_9'];
// 		$straw_no_9 = $_POST['straw_no_9'];
// 		$color_9 = $_POST['color_9'];
// 		$embryos_frozen_0_9 = $_POST['embryos_frozen_0_9'];
// 		$storage_renewal_dt_9 = $_POST['storage_renewal_dt_9'];
// 		$date_1_9 = $_POST['date_1_9'];
// 		$purpose_0_9 = $_POST['purpose_0_9'];
// 		$media_1_9 = $_POST['media_1_9'];
// 		$no_embryo_thawed_9 = $_POST['no_embryo_thawed_9'];
// 		$thawing_path_9 = $_POST['thawing_path_9'];
// 		$no_embryo_recovered_9 = $_POST['no_embryo_recovered_9'];
// 		$date_2_9 = $_POST['date_2_9'];
// 		$reason_9 = $_POST['reason_9'];
// 		$empty_0_9 = $_POST['empty_0_9'];
// 		$empty_1_9 = $_POST['empty_1_9'];
// 		$egg_quality_0_10 = $_POST['egg_quality_0_10'];
// 		$comment_0_10 = $_POST['comment_0_10'];
// 		$pn1_0_10 = $_POST['pn1_0_10'];
// 		$pn2_0_10 = $_POST['pn2_0_10'];
// 		$pn3_0_10 = $_POST['pn3_0_10'];
// 		$degenerate_10 = $_POST['degenerate_10'];
// 		$pb2_10 = $_POST['pb2_10'];
// 		$comments_10 = $_POST['comments_10'];
// 		$cell_0_10 = $_POST['cell_0_10'];
// 		$grade_0_10 = $_POST['grade_0_10'];
// 		$clevage_time_10 = $_POST['clevage_time_10'];
// 		$frag_0_10 = $_POST['frag_0_10'];
// 		$cell_1_10 = $_POST['cell_1_10'];
// 		$grade_1_10 = $_POST['grade_1_10'];
// 		$frag_1_10 = $_POST['frag_1_10'];
// 		$stage_10 = $_POST['stage_10'];
// 		$grade_2_10 = $_POST['grade_2_10'];
// 		$frag_2_10 = $_POST['frag_2_10'];
// 		$date_0_10 = $_POST['date_0_10'];
// 		$media_0_10 = $_POST['media_0_10'];
// 		$container_no_0_10 = $_POST['container_no_0_10'];
// 		$straw_no_10 = $_POST['straw_no_10'];
// 		$color_10 = $_POST['color_10'];
// 		$embryos_frozen_0_10 = $_POST['embryos_frozen_0_10'];
// 		$storage_renewal_dt_10 = $_POST['storage_renewal_dt_10'];
// 		$date_1_10 = $_POST['date_1_10'];
// 		$purpose_0_10 = $_POST['purpose_0_10'];
// 		$media_1_10 = $_POST['media_1_10'];
// 		$no_embryo_thawed_10 = $_POST['no_embryo_thawed_10'];
// 		$thawing_path_10 = $_POST['thawing_path_10'];
// 		$no_embryo_recovered_10 = $_POST['no_embryo_recovered_10'];
// 		$date_2_10 = $_POST['date_2_10'];
// 		$reason_10 = $_POST['reason_10'];
// 		$empty_0_10 = $_POST['empty_0_10'];
// 		$empty_1_10 = $_POST['empty_1_10'];
// 		$egg_quality_0_11 = $_POST['egg_quality_0_11'];
// 		$comment_0_11 = $_POST['comment_0_11'];
// 		$pn1_0_11 = $_POST['pn1_0_11'];
// 		$pn2_0_11 = $_POST['pn2_0_11'];
// 		$pn3_0_11 = $_POST['pn3_0_11'];
// 		$degenerate_11 = $_POST['degenerate_11'];
// 		$pb2_11 = $_POST['pb2_11'];
// 		$comments_11 = $_POST['comments_11'];
// 		$cell_0_11 = $_POST['cell_0_11'];
// 		$grade_0_11 = $_POST['grade_0_11'];
// 		$clevage_time_11 = $_POST['clevage_time_11'];
// 		$frag_0_11 = $_POST['frag_0_11'];
// 		$cell_1_11 = $_POST['cell_1_11'];
// 		$grade_1_11 = $_POST['grade_1_11'];
// 		$frag_1_11 = $_POST['frag_1_11'];
// 		$stage_11 = $_POST['stage_11'];
// 		$grade_2_11 = $_POST['grade_2_11'];
// 		$frag_2_11 = $_POST['frag_2_11'];
// 		$date_0_11 = $_POST['date_0_11'];
// 		$media_0_11 = $_POST['media_0_11'];
// 		$container_no_0_11 = $_POST['container_no_0_11'];
// 		$straw_no_11 = $_POST['straw_no_11'];
// 		$color_11 = $_POST['color_11'];
// 		$embryos_frozen_0_11 = $_POST['embryos_frozen_0_11'];
// 		$storage_renewal_dt_11 = $_POST['storage_renewal_dt_11'];
// 		$date_1_11 = $_POST['date_1_11'];
// 		$purpose_0_11 = $_POST['purpose_0_11'];
// 		$media_1_11 = $_POST['media_1_11'];
// 		$no_embryo_thawed_11 = $_POST['no_embryo_thawed_11'];
// 		$thawing_path_11 = $_POST['thawing_path_11'];
// 		$no_embryo_recovered_11 = $_POST['no_embryo_recovered_11'];
// 		$date_2_11 = $_POST['date_2_11'];
// 		$reason_11 = $_POST['reason_11'];
// 		$empty_0_11 = $_POST['empty_0_11'];
// 		$empty_1_11 = $_POST['empty_1_11'];
// 		$egg_quality_0_12 = $_POST['egg_quality_0_12'];
// 		$comment_0_12 = $_POST['comment_0_12'];
// 		$pn1_0_12 = $_POST['pn1_0_12'];
// 		$pn2_0_12 = $_POST['pn2_0_12'];
// 		$pn3_0_12 = $_POST['pn3_0_12'];
// 		$degenerate_12 = $_POST['degenerate_12'];
// 		$pb2_12 = $_POST['pb2_12'];
// 		$comments_12 = $_POST['comments_12'];
// 		$cell_0_12 = $_POST['cell_0_12'];
// 		$grade_0_12 = $_POST['grade_0_12'];
// 		$clevage_time_12 = $_POST['clevage_time_12'];
// 		$frag_0_12 = $_POST['frag_0_12'];
// 		$cell_1_12 = $_POST['cell_1_12'];
// 		$grade_1_12 = $_POST['grade_1_12'];
// 		$frag_1_12 = $_POST['frag_1_12'];
// 		$stage_12 = $_POST['stage_12'];
// 		$grade_2_12 = $_POST['grade_2_12'];
// 		$frag_2_12 = $_POST['frag_2_12'];
// 		$date_0_12 = $_POST['date_0_12'];
// 		$media_0_12 = $_POST['media_0_12'];
// 		$container_no_0_12 = $_POST['container_no_0_12'];
// 		$straw_no_12 = $_POST['straw_no_12'];
// 		$color_12 = $_POST['color_12'];
// 		$embryos_frozen_0_12 = $_POST['embryos_frozen_0_12'];
// 		$storage_renewal_dt_12 = $_POST['storage_renewal_dt_12'];
// 		$date_1_12 = $_POST['date_1_12'];
// 		$purpose_0_12 = $_POST['purpose_0_12'];
// 		$media_1_12 = $_POST['media_1_12'];
// 		$no_embryo_thawed_12 = $_POST['no_embryo_thawed_12'];
// 		$thawing_path_12 = $_POST['thawing_path_12'];
// 		$no_embryo_recovered_12 = $_POST['no_embryo_recovered_12'];
// 		$date_2_12 = $_POST['date_2_12'];
// 		$reason_12 = $_POST['reason_12'];
// 		$empty_0_12 = $_POST['empty_0_12'];
// 		$empty_1_12 = $_POST['empty_1_12'];
// 		$egg_quality_0_13 = $_POST['egg_quality_0_13'];
// 		$comment_0_13 = $_POST['comment_0_13'];
// 		$pn1_0_13 = $_POST['pn1_0_13'];
// 		$pn2_0_13 = $_POST['pn2_0_13'];
// 		$pn3_0_13 = $_POST['pn3_0_13'];
// 		$degenerate_13 = $_POST['degenerate_13'];
// 		$pb2_13 = $_POST['pb2_13'];
// 		$comments_13 = $_POST['comments_13'];
// 		$cell_0_13 = $_POST['cell_0_13'];
// 		$grade_0_13 = $_POST['grade_0_13'];
// 		$clevage_time_13 = $_POST['clevage_time_13'];
// 		$frag_0_13 = $_POST['frag_0_13'];
// 		$cell_1_13 = $_POST['cell_1_13'];
// 		$grade_1_13 = $_POST['grade_1_13'];
// 		$frag_1_13 = $_POST['frag_1_13'];
// 		$stage_13 = $_POST['stage_13'];
// 		$grade_2_13 = $_POST['grade_2_13'];
// 		$frag_2_13 = $_POST['frag_2_13'];
// 		$date_0_13 = $_POST['date_0_13'];
// 		$media_0_13 = $_POST['media_0_13'];
// 		$container_no_0_13 = $_POST['container_no_0_13'];
// 		$straw_no_13 = $_POST['straw_no_13'];
// 		$color_13 = $_POST['color_13'];
// 		$embryos_frozen_0_13 = $_POST['embryos_frozen_0_13'];
// 		$storage_renewal_dt_13 = $_POST['storage_renewal_dt_13'];
// 		$date_1_13 = $_POST['date_1_13'];
// 		$purpose_0_13 = $_POST['purpose_0_13'];
// 		$media_1_13 = $_POST['media_1_13'];
// 		$no_embryo_thawed_13 = $_POST['no_embryo_thawed_13'];
// 		$thawing_path_13 = $_POST['thawing_path_13'];
// 		$no_embryo_recovered_13 = $_POST['no_embryo_recovered_13'];
// 		$date_2_13 = $_POST['date_2_13'];
// 		$reason_13 = $_POST['reason_13'];
// 		$empty_0_13 = $_POST['empty_0_13'];
// 		$empty_1_13 = $_POST['empty_1_13'];
// 		$egg_quality_0_14 = $_POST['egg_quality_0_14'];
// 		$comment_0_14 = $_POST['comment_0_14'];
// 		$pn1_0_14 = $_POST['pn1_0_14'];
// 		$pn2_0_14 = $_POST['pn2_0_14'];
// 		$pn3_0_14 = $_POST['pn3_0_14'];
// 		$degenerate_14 = $_POST['degenerate_14'];
// 		$pb2_14 = $_POST['pb2_14'];
// 		$comments_14 = $_POST['comments_14'];
// 		$cell_0_14 = $_POST['cell_0_14'];
// 		$grade_0_14 = $_POST['grade_0_14'];
// 		$clevage_time_14 = $_POST['clevage_time_14'];
// 		$frag_0_14 = $_POST['frag_0_14'];
// 		$cell_1_14 = $_POST['cell_1_14'];
// 		$grade_1_14 = $_POST['grade_1_14'];
// 		$frag_1_14 = $_POST['frag_1_14'];
// 		$stage_14 = $_POST['stage_14'];
// 		$grade_2_14 = $_POST['grade_2_14'];
// 		$frag_2_14 = $_POST['frag_2_14'];
// 		$date_0_14 = $_POST['date_0_14'];
// 		$media_0_14 = $_POST['media_0_14'];
// 		$container_no_0_14 = $_POST['container_no_0_14'];
// 		$straw_no_14 = $_POST['straw_no_14'];
// 		$color_14 = $_POST['color_14'];
// 		$embryos_frozen_0_14 = $_POST['embryos_frozen_0_14'];
// 		$storage_renewal_dt_14 = $_POST['storage_renewal_dt_14'];
// 		$date_1_14 = $_POST['date_1_14'];
// 		$purpose_0_14 = $_POST['purpose_0_14'];
// 		$media_1_14 = $_POST['media_1_14'];
// 		$no_embryo_thawed_14 = $_POST['no_embryo_thawed_14'];
// 		$thawing_path_14 = $_POST['thawing_path_14'];
// 		$no_embryo_recovered_14 = $_POST['no_embryo_recovered_14'];
// 		$date_2_14 = $_POST['date_2_14'];
// 		$reason_14 = $_POST['reason_14'];
// 		$empty_0_14 = $_POST['empty_0_14'];
// 		$empty_1_14 = $_POST['empty_1_14'];
// 		$egg_quality_0_15 = $_POST['egg_quality_0_15'];
// 		$comment_0_15 = $_POST['comment_0_15'];
// 		$pn1_0_15 = $_POST['pn1_0_15'];
// 		$pn2_0_15 = $_POST['pn2_0_15'];
// 		$pn3_0_15 = $_POST['pn3_0_15'];
// 		$degenerate_15 = $_POST['degenerate_15'];
// 		$pb2_15 = $_POST['pb2_15'];
// 		$comments_15 = $_POST['comments_15'];
// 		$cell_0_15 = $_POST['cell_0_15'];
// 		$grade_0_15 = $_POST['grade_0_15'];
// 		$clevage_time_15 = $_POST['clevage_time_15'];
// 		$frag_0_15 = $_POST['frag_0_15'];
// 		$cell_1_15 = $_POST['cell_1_15'];
// 		$grade_1_15 = $_POST['grade_1_15'];
// 		$frag_1_15 = $_POST['frag_1_15'];
// 		$stage_15 = $_POST['stage_15'];
// 		$grade_2_15 = $_POST['grade_2_15'];
// 		$frag_2_15 = $_POST['frag_2_15'];
// 		$date_0_15 = $_POST['date_0_15'];
// 		$media_0_15 = $_POST['media_0_15'];
// 		$container_no_0_15 = $_POST['container_no_0_15'];
// 		$straw_no_15 = $_POST['straw_no_15'];
// 		$color_15 = $_POST['color_15'];
// 		$embryos_frozen_0_15 = $_POST['embryos_frozen_0_15'];
// 		$storage_renewal_dt_15 = $_POST['storage_renewal_dt_15'];
// 		$date_1_15 = $_POST['date_1_15'];
// 		$purpose_0_15 = $_POST['purpose_0_15'];
// 		$media_1_15 = $_POST['media_1_15'];
// 		$no_embryo_thawed_15 = $_POST['no_embryo_thawed_15'];
// 		$thawing_path_15 = $_POST['thawing_path_15'];
// 		$no_embryo_recovered_15 = $_POST['no_embryo_recovered_15'];
// 		$date_2_15 = $_POST['date_2_15'];
// 		$reason_15 = $_POST['reason_15'];
// 		$empty_0_15 = $_POST['empty_0_15'];
// 		$empty_1_15 = $_POST['empty_1_15'];
// 		$egg_quality_0_16 = $_POST['egg_quality_0_16'];
// 		$comment_0_16 = $_POST['comment_0_16'];
// 		$pn1_0_16 = $_POST['pn1_0_16'];
// 		$pn2_0_16 = $_POST['pn2_0_16'];
// 		$pn3_0_16 = $_POST['pn3_0_16'];
// 		$degenerate_16 = $_POST['degenerate_16'];
// 		$pb2_16 = $_POST['pb2_16'];
// 		$comments_16 = $_POST['comments_16'];
// 		$cell_0_16 = $_POST['cell_0_16'];
// 		$grade_0_16 = $_POST['grade_0_16'];
// 		$clevage_time_16 = $_POST['clevage_time_16'];
// 		$frag_0_16 = $_POST['frag_0_16'];
// 		$cell_1_16 = $_POST['cell_1_16'];
// 		$grade_1_16 = $_POST['grade_1_16'];
// 		$frag_1_16 = $_POST['frag_1_16'];
// 		$stage_16 = $_POST['stage_16'];
// 		$grade_2_16 = $_POST['grade_2_16'];
// 		$frag_2_16 = $_POST['frag_2_16'];
// 		$date_0_16 = $_POST['date_0_16'];
// 		$media_0_16 = $_POST['media_0_16'];
// 		$container_no_0_16 = $_POST['container_no_0_16'];
// 		$straw_no_16 = $_POST['straw_no_16'];
// 		$color_16 = $_POST['color_16'];
// 		$embryos_frozen_0_16 = $_POST['embryos_frozen_0_16'];
// 		$storage_renewal_dt_16 = $_POST['storage_renewal_dt_16'];
// 		$date_1_16 = $_POST['date_1_16'];
// 		$purpose_0_16 = $_POST['purpose_0_16'];
// 		$media_1_16 = $_POST['media_1_16'];
// 		$no_embryo_thawed_16 = $_POST['no_embryo_thawed_16'];
// 		$thawing_path_16 = $_POST['thawing_path_16'];
// 		$no_embryo_recovered_16 = $_POST['no_embryo_recovered_16'];
// 		$date_2_16 = $_POST['date_2_16'];
// 		$reason_16 = $_POST['reason_16'];
// 		$empty_0_16 = $_POST['empty_0_16'];
// 		$empty_1_16 = $_POST['empty_1_16'];
// 		$egg_quality_0_17 = $_POST['egg_quality_0_17'];
// 		$comment_0_17 = $_POST['comment_0_17'];
// 		$pn1_0_17 = $_POST['pn1_0_17'];
// 		$pn2_0_17 = $_POST['pn2_0_17'];
// 		$pn3_0_17 = $_POST['pn3_0_17'];
// 		$degenerate_17 = $_POST['degenerate_17'];
// 		$pb2_17 = $_POST['pb2_17'];
// 		$comments_17 = $_POST['comments_17'];
// 		$cell_0_17 = $_POST['cell_0_17'];
// 		$grade_0_17 = $_POST['grade_0_17'];
// 		$clevage_time_17 = $_POST['clevage_time_17'];
// 		$frag_0_17 = $_POST['frag_0_17'];
// 		$cell_1_17 = $_POST['cell_1_17'];
// 		$grade_1_17 = $_POST['grade_1_17'];
// 		$frag_1_17 = $_POST['frag_1_17'];
// 		$stage_17 = $_POST['stage_17'];
// 		$grade_2_17 = $_POST['grade_2_17'];
// 		$frag_2_17 = $_POST['frag_2_17'];
// 		$date_0_17 = $_POST['date_0_17'];
// 		$media_0_17 = $_POST['media_0_17'];
// 		$container_no_0_17 = $_POST['container_no_0_17'];
// 		$straw_no_17 = $_POST['straw_no_17'];
// 		$color_17 = $_POST['color_17'];
// 		$embryos_frozen_0_17 = $_POST['embryos_frozen_0_17'];
// 		$storage_renewal_dt_17 = $_POST['storage_renewal_dt_17'];
// 		$date_1_17 = $_POST['date_1_17'];
// 		$purpose_0_17 = $_POST['purpose_0_17'];
// 		$media_1_17 = $_POST['media_1_17'];
// 		$no_embryo_thawed_17 = $_POST['no_embryo_thawed_17'];
// 		$thawing_path_17 = $_POST['thawing_path_17'];
// 		$no_embryo_recovered_17 = $_POST['no_embryo_recovered_17'];
// 		$date_2_17 = $_POST['date_2_17'];
// 		$reason_17 = $_POST['reason_17'];
// 		$empty_0_17 = $_POST['empty_0_17'];
// 		$empty_1_17 = $_POST['empty_1_17'];
// 		$egg_quality_0_18 = $_POST['egg_quality_0_18'];
// 		$comment_0_18 = $_POST['comment_0_18'];
// 		$pn1_0_18 = $_POST['pn1_0_18'];
// 		$pn2_0_18 = $_POST['pn2_0_18'];
// 		$pn3_0_18 = $_POST['pn3_0_18'];
// 		$degenerate_18 = $_POST['degenerate_18'];
// 		$pb2_18 = $_POST['pb2_18'];
// 		$comments_18 = $_POST['comments_18'];
// 		$cell_0_18 = $_POST['cell_0_18'];
// 		$grade_0_18 = $_POST['grade_0_18'];
// 		$clevage_time_18 = $_POST['clevage_time_18'];
// 		$frag_0_18 = $_POST['frag_0_18'];
// 		$cell_1_18 = $_POST['cell_1_18'];
// 		$grade_1_18 = $_POST['grade_1_18'];
// 		$frag_1_18 = $_POST['frag_1_18'];
// 		$stage_18 = $_POST['stage_18'];
// 		$grade_2_18 = $_POST['grade_2_18'];
// 		$frag_2_18 = $_POST['frag_2_18'];
// 		$date_0_18 = $_POST['date_0_18'];
// 		$media_0_18 = $_POST['media_0_18'];
// 		$container_no_0_18 = $_POST['container_no_0_18'];
// 		$straw_no_18 = $_POST['straw_no_18'];
// 		$color_18 = $_POST['color_18'];
// 		$embryos_frozen_0_18 = $_POST['embryos_frozen_0_18'];
// 		$storage_renewal_dt_18 = $_POST['storage_renewal_dt_18'];
// 		$date_1_18 = $_POST['date_1_18'];
// 		$purpose_0_18 = $_POST['purpose_0_18'];
// 		$media_1_18 = $_POST['media_1_18'];
// 		$no_embryo_thawed_18 = $_POST['no_embryo_thawed_18'];
// 		$thawing_path_18 = $_POST['thawing_path_18'];
// 		$no_embryo_recovered_18 = $_POST['no_embryo_recovered_18'];
// 		$date_2_18 = $_POST['date_2_18'];
// 		$reason_18 = $_POST['reason_18'];
// 		$empty_0_18 = $_POST['empty_0_18'];
// 		$empty_1_18 = $_POST['empty_1_18'];
// 		$egg_quality_0_19 = $_POST['egg_quality_0_19'];
// 		$comment_0_19 = $_POST['comment_0_19'];
// 		$pn1_0_19 = $_POST['pn1_0_19'];
// 		$pn2_0_19 = $_POST['pn2_0_19'];
// 		$pn3_0_19 = $_POST['pn3_0_19'];
// 		$degenerate_19 = $_POST['degenerate_19'];
// 		$pb2_19 = $_POST['pb2_19'];
// 		$comments_19 = $_POST['comments_19'];
// 		$cell_0_19 = $_POST['cell_0_19'];
// 		$grade_0_19 = $_POST['grade_0_19'];
// 		$clevage_time_19 = $_POST['clevage_time_19'];
// 		$frag_0_19 = $_POST['frag_0_19'];
// 		$cell_1_19 = $_POST['cell_1_19'];
// 		$grade_1_19 = $_POST['grade_1_19'];
// 		$frag_1_19 = $_POST['frag_1_19'];
// 		$stage_19 = $_POST['stage_19'];
// 		$grade_2_19 = $_POST['grade_2_19'];
// 		$frag_2_19 = $_POST['frag_2_19'];
// 		$date_0_19 = $_POST['date_0_19'];
// 		$media_0_19 = $_POST['media_0_19'];
// 		$container_no_0_19 = $_POST['container_no_0_19'];
// 		$straw_no_19 = $_POST['straw_no_19'];
// 		$color_19 = $_POST['color_19'];
// 		$embryos_frozen_0_19 = $_POST['embryos_frozen_0_19'];
// 		$storage_renewal_dt_19 = $_POST['storage_renewal_dt_19'];
// 		$date_1_19 = $_POST['date_1_19'];
// 		$purpose_0_19 = $_POST['purpose_0_19'];
// 		$media_1_19 = $_POST['media_1_19'];
// 		$no_embryo_thawed_19 = $_POST['no_embryo_thawed_19'];
// 		$thawing_path_19 = $_POST['thawing_path_19'];
// 		$no_embryo_recovered_19 = $_POST['no_embryo_recovered_19'];
// 		$date_2_19 = $_POST['date_2_19'];
// 		$reason_19 = $_POST['reason_19'];
// 		$empty_0_19 = $_POST['empty_0_19'];
// 		$empty_1_19 = $_POST['empty_1_19'];
// 		$egg_quality_0_20 = $_POST['egg_quality_0_20'];
// 		$comment_0_20 = $_POST['comment_0_20'];
// 		$pn1_0_20 = $_POST['pn1_0_20'];
// 		$pn2_0_20 = $_POST['pn2_0_20'];
// 		$pn3_0_20 = $_POST['pn3_0_20'];
// 		$degenerate_20 = $_POST['degenerate_20'];
// 		$pb2_20 = $_POST['pb2_20'];
// 		$comments_20 = $_POST['comments_20'];
// 		$cell_0_20 = $_POST['cell_0_20'];
// 		$grade_0_20 = $_POST['grade_0_20'];
// 		$clevage_time_20 = $_POST['clevage_time_20'];
// 		$frag_0_20 = $_POST['frag_0_20'];
// 		$cell_1_20 = $_POST['cell_1_20'];
// 		$grade_1_20 = $_POST['grade_1_20'];
// 		$frag_1_20 = $_POST['frag_1_20'];
// 		$stage_20 = $_POST['stage_20'];
// 		$grade_2_20 = $_POST['grade_2_20'];
// 		$frag_2_20 = $_POST['frag_2_20'];
// 		$date_0_20 = $_POST['date_0_20'];
// 		$media_0_20 = $_POST['media_0_20'];
// 		$container_no_0_20 = $_POST['container_no_0_20'];
// 		$straw_no_20 = $_POST['straw_no_20'];
// 		$color_20 = $_POST['color_20'];
// 		$embryos_frozen_0_20 = $_POST['embryos_frozen_0_20'];
// 		$storage_renewal_dt_20 = $_POST['storage_renewal_dt_20'];
// 		$date_1_20 = $_POST['date_1_20'];
// 		$purpose_0_20 = $_POST['purpose_0_20'];
// 		$media_1_20 = $_POST['media_1_20'];
// 		$no_embryo_thawed_20 = $_POST['no_embryo_thawed_20'];
// 		$thawing_path_20 = $_POST['thawing_path_20'];
// 		$no_embryo_recovered_20 = $_POST['no_embryo_recovered_20'];
// 		$date_2_20 = $_POST['date_2_20'];
// 		$reason_20 = $_POST['reason_20'];
// 		$empty_0_20 = $_POST['empty_0_20'];
// 		$empty_1_20 = $_POST['empty_1_20'];

// 	    // connect to mysql database using mysqli
	    

// 	    // mysql query to insert data
// 		$query = "INSERT INTO `embryo_record`(`patient_id`, `receipt_number`, `status`,`date0`,`date1`,`date2`,`date3`,`date4`,`date5`,`date6`,`date7`,`date8`,`date9`,`date10`,`time0`,`time1`,`time2`,`time3`,`time4`,`time5`,`time6`,`time7`,`time8`,`time9`,`time10`,`emb`,`score_time`,`hrs0`,`hrs1`,`hrs2`,`hrs3`,`hrs4`,`hrs5`,`hrs6`,`hrs7`,`hrs8`,`dr`,`emb0`,`emb1`,`emb2`,`emb3`,`emb4`,`emb5`,`emb6`,`emb7`,`emb8`,`emb9`,`witness0`,`witness1`,`witness2`,`wit0`,`wit1`,`wit2`,`wit3`,`wit4`,`wit5`,`wit6`,`wit7`,`ivf_inseminated`,`icsi_inseminated`,`ivf_injected`,`icsi_injected`,`ivf_degenerated`,`icsi_degenerated`,`ivf_oocytes`,`icsi_oocytes`,`ivf_oocytes_injected`,`icsi_oocytes_injected`,`no_fertilization`,`no_1_pn_oocyte`,`oocyte_2pn_pb`,`oocyte_2pn`,`cleaved_embryos`,`cell_embryos_day2`,`cell_embryos_day3`,`blastocysts_day5`,`embryos_transferred`,`embryos_frozen`,`thawed_embryo_transferred`,`embryos_intact`,`warmed_embryos`,`intact_blasts`,`warmed_blasts`,`embryos_hatched`,`hyal_time`,`hyal_time_emb`,`inj_time`,`inj_time_emb`,`upload_photo_0`,`upload_photo_1`,`upload_photo_2`,`upload_photo_3`,`method`,`upload_photo_4`,`upload_photo_5`,`no_0`,`egg_quality_0`,`comment_0`,`pn1_0`,`pn2_0`,`pn3_0`,`degenerate`,`pb2`,`comments`,`cell_0`,`grade_0`,`clevage_time`,`frag_0`,`cell_1`,`grade_1`,`frag_1`,`stage`,`grade_2`,`frag_2`,`date_0`,`media_0`,`container_no_0`,`straw_no`,`color`,`embryos_frozen_0`,`storage_renewal_dt`,`date_1`,`purpose_0`,`media_1`,`no_embryo_thawed`,`thawing_path`,`no_embryo_recovered`,`date_2`,`reason`,`empty_0`,`empty_1`,`egg_quality_0_1`,`comment_0_1`,`pn1_0_1`,`pn2_0_1`,`pn3_0_1`,`degenerate_1`,`pb2_1`,`comments_1`,`cell_0_1`,`grade_0_1`,`clevage_time_1`,`frag_0_1`,`cell_1_1`,`grade_1_1`,`frag_1_1`,`stage_1`,`grade_2_1`,`frag_2_1`,`date_0_1`,`media_0_1`,`container_no_0_1`,`straw_no_1`,`color_1`,`embryos_frozen_0_1`,`storage_renewal_dt_1`,`date_1_1`,`purpose_0_1`,`media_1_1`,`no_embryo_thawed_1`,`thawing_path_1`,`no_embryo_recovered_1`,`date_2_1`,`reason_1`,`empty_0_1`,`empty_1_1`,`egg_quality_0_2`,`comment_0_2`,`pn1_0_2`,`pn2_0_2`,`pn3_0_2`,`degenerate_2`,`pb2_2`,`comments_2`,`cell_0_2`,`grade_0_2`,`clevage_time_2`,`frag_0_2`,`cell_1_2`,`grade_1_2`,`frag_1_2`,`stage_2`,`grade_2_2`,`frag_2_2`,`date_0_2`,`media_0_2`,`container_no_0_2`,`straw_no_2`,`color_2`,`embryos_frozen_0_2`,`storage_renewal_dt_2`,`date_1_2`,`purpose_0_2`,`media_1_2`,`no_embryo_thawed_2`,`thawing_path_2`,`no_embryo_recovered_2`,`date_2_2`,`reason_2`,`empty_0_2`,`empty_1_2`,`egg_quality_0_3`,`comment_0_3`,`pn1_0_3`,`pn2_0_3`,`pn3_0_3`,`degenerate_3`,`pb2_3`,`comments_3`,`cell_0_3`,`grade_0_3`,`clevage_time_3`,`frag_0_3`,`cell_1_3`,`grade_1_3`,`frag_1_3`,`stage_3`,`grade_2_3`,`frag_2_3`,`date_0_3`,`media_0_3`,`container_no_0_3`,`straw_no_3`,`color_3`,`embryos_frozen_0_3`,`storage_renewal_dt_3`,`date_1_3`,`purpose_0_3`,`media_1_3`,`no_embryo_thawed_3`,`thawing_path_3`,`no_embryo_recovered_3`,`date_2_3`,`reason_3`,`empty_0_3`,`empty_1_3`,`egg_quality_0_4`,`comment_0_4`,`pn1_0_4`,`pn2_0_4`,`pn3_0_4`,`degenerate_4`,`pb2_4`,`comments_4`,`cell_0_4`,`grade_0_4`,`clevage_time_4`,`frag_0_4`,`cell_1_4`,`grade_1_4`,`frag_1_4`,`stage_4`,`grade_2_4`,`frag_2_4`,`date_0_4`,`media_0_4`,`container_no_0_4`,`straw_no_4`,`color_4`,`embryos_frozen_0_4`,`storage_renewal_dt_4`,`date_1_4`,`purpose_0_4`,`media_1_4`,`no_embryo_thawed_4`,`thawing_path_4`,`no_embryo_recovered_4`,`date_2_4`,`reason_4`,`empty_0_4`,`empty_1_4`,`egg_quality_0_5`,`comment_0_5`,`pn1_0_5`,`pn2_0_5`,`pn3_0_5`,`degenerate_5`,`pb2_5`,`comments_5`,`cell_0_5`,`grade_0_5`,`clevage_time_5`,`frag_0_5`,`cell_1_5`,`grade_1_5`,`frag_1_5`,`stage_5`,`grade_2_5`,`frag_2_5`,`date_0_5`,`media_0_5`,`container_no_0_5`,`straw_no_5`,`color_5`,`embryos_frozen_0_5`,`storage_renewal_dt_5`,`date_1_5`,`purpose_0_5`,`media_1_5`,`no_embryo_thawed_5`,`thawing_path_5`,`no_embryo_recovered_5`,`date_2_5`,`reason_5`,`empty_0_5`,`empty_1_5`,`egg_quality_0_6`,`comment_0_6`,`pn1_0_6`,`pn2_0_6`,`pn3_0_6`,`degenerate_6`,`pb2_6`,`comments_6`,`cell_0_6`,`grade_0_6`,`clevage_time_6`,`frag_0_6`,`cell_1_6`,`grade_1_6`,`frag_1_6`,`stage_6`,`grade_2_6`,`frag_2_6`,`date_0_6`,`media_0_6`,`container_no_0_6`,`straw_no_6`,`color_6`,`embryos_frozen_0_6`,`storage_renewal_dt_6`,`date_1_6`,`purpose_0_6`,`media_1_6`,`no_embryo_thawed_6`,`thawing_path_6`,`no_embryo_recovered_6`,`date_2_6`,`reason_6`,`empty_0_6`,`empty_1_6`,`egg_quality_0_7`,`comment_0_7`,`pn1_0_7`,`pn2_0_7`,`pn3_0_7`,`degenerate_7`,`pb2_7`,`comments_7`,`cell_0_7`,`grade_0_7`,`clevage_time_7`,`frag_0_7`,`cell_1_7`,`grade_1_7`,`frag_1_7`,`stage_7`,`grade_2_7`,`frag_2_7`,`date_0_7`,`media_0_7`,`container_no_0_7`,`straw_no_7`,`color_7`,`embryos_frozen_0_7`,`storage_renewal_dt_7`,`date_1_7`,`purpose_0_7`,`media_1_7`,`no_embryo_thawed_7`,`thawing_path_7`,`no_embryo_recovered_7`,`date_2_7`,`reason_7`,`empty_0_7`,`empty_1_7`,`egg_quality_0_8`,`comment_0_8`,`pn1_0_8`,`pn2_0_8`,`pn3_0_8`,`degenerate_8`,`pb2_8`,`comments_8`,`cell_0_8`,`grade_0_8`,`clevage_time_8`,`frag_0_8`,`cell_1_8`,`grade_1_8`,`frag_1_8`,`stage_8`,`grade_2_8`,`frag_2_8`,`date_0_8`,`media_0_8`,`container_no_0_8`,`straw_no_8`,`color_8`,`embryos_frozen_0_8`,`storage_renewal_dt_8`,`date_1_8`,`purpose_0_8`,`media_1_8`,`no_embryo_thawed_8`,`thawing_path_8`,`no_embryo_recovered_8`,`date_2_8`,`reason_8`,`empty_0_8`,`empty_1_8`,`egg_quality_0_9`,`comment_0_9`,`pn1_0_9`,`pn2_0_9`,`pn3_0_9`,`degenerate_9`,`pb2_9`,`comments_9`,`cell_0_9`,`grade_0_9`,`clevage_time_9`,`frag_0_9`,`cell_1_9`,`grade_1_9`,`frag_1_9`,`stage_9`,`grade_2_9`,`frag_2_9`,`date_0_9`,`media_0_9`,`container_no_0_9`,`straw_no_9`,`color_9`,`embryos_frozen_0_9`,`storage_renewal_dt_9`,`date_1_9`,`purpose_0_9`,`media_1_9`,`no_embryo_thawed_9`,`thawing_path_9`,`no_embryo_recovered_9`,`date_2_9`,`reason_9`,`empty_0_9`,`empty_1_9`,`egg_quality_0_10`,`comment_0_10`,`pn1_0_10`,`pn2_0_10`,`pn3_0_10`,`degenerate_10`,`pb2_10`,`comments_10`,`cell_0_10`,`grade_0_10`,`clevage_time_10`,`frag_0_10`,`cell_1_10`,`grade_1_10`,`frag_1_10`,`stage_10`,`grade_2_10`,`frag_2_10`,`date_0_10`,`media_0_10`,`container_no_0_10`,`straw_no_10`,`color_10`,`embryos_frozen_0_10`,`storage_renewal_dt_10`,`date_1_10`,`purpose_0_10`,`media_1_10`,`no_embryo_thawed_10`,`thawing_path_10`,`no_embryo_recovered_10`,`date_2_10`,`reason_10`,`empty_0_10`,`empty_1_10`,`egg_quality_0_11`,`comment_0_11`,`pn1_0_11`,`pn2_0_11`,`pn3_0_11`,`degenerate_11`,`pb2_11`,`comments_11`,`cell_0_11`,`grade_0_11`,`clevage_time_11`,`frag_0_11`,`cell_1_11`,`grade_1_11`,`frag_1_11`,`stage_11`,`grade_2_11`,`frag_2_11`,`date_0_11`,`media_0_11`,`container_no_0_11`,`straw_no_11`,`color_11`,`embryos_frozen_0_11`,`storage_renewal_dt_11`,`date_1_11`,`purpose_0_11`,`media_1_11`,`no_embryo_thawed_11`,`thawing_path_11`,`no_embryo_recovered_11`,`date_2_11`,`reason_11`,`empty_0_11`,`empty_1_11`,`egg_quality_0_12`,`comment_0_12`,`pn1_0_12`,`pn2_0_12`,`pn3_0_12`,`degenerate_12`,`pb2_12`,`comments_12`,`cell_0_12`,`grade_0_12`,`clevage_time_12`,`frag_0_12`,`cell_1_12`,`grade_1_12`,`frag_1_12`,`stage_12`,`grade_2_12`,`frag_2_12`,`date_0_12`,`media_0_12`,`container_no_0_12`,`straw_no_12`,`color_12`,`embryos_frozen_0_12`,`storage_renewal_dt_12`,`date_1_12`,`purpose_0_12`,`media_1_12`,`no_embryo_thawed_12`,`thawing_path_12`,`no_embryo_recovered_12`,`date_2_12`,`reason_12`,`empty_0_12`,`empty_1_12`,`egg_quality_0_13`,`comment_0_13`,`pn1_0_13`,`pn2_0_13`,`pn3_0_13`,`degenerate_13`,`pb2_13`,`comments_13`,`cell_0_13`,`grade_0_13`,`clevage_time_13`,`frag_0_13`,`cell_1_13`,`grade_1_13`,`frag_1_13`,`stage_13`,`grade_2_13`,`frag_2_13`,`date_0_13`,`media_0_13`,`container_no_0_13`,`straw_no_13`,`color_13`,`embryos_frozen_0_13`,`storage_renewal_dt_13`,`date_1_13`,`purpose_0_13`,`media_1_13`,`no_embryo_thawed_13`,`thawing_path_13`,`no_embryo_recovered_13`,`date_2_13`,`reason_13`,`empty_0_13`,`empty_1_13`,`egg_quality_0_14`,`comment_0_14`,`pn1_0_14`,`pn2_0_14`,`pn3_0_14`,`degenerate_14`,`pb2_14`,`comments_14`,`cell_0_14`,`grade_0_14`,`clevage_time_14`,`frag_0_14`,`cell_1_14`,`grade_1_14`,`frag_1_14`,`stage_14`,`grade_2_14`,`frag_2_14`,`date_0_14`,`media_0_14`,`container_no_0_14`,`straw_no_14`,`color_14`,`embryos_frozen_0_14`,`storage_renewal_dt_14`,`date_1_14`,`purpose_0_14`,`media_1_14`,`no_embryo_thawed_14`,`thawing_path_14`,`no_embryo_recovered_14`,`date_2_14`,`reason_14`,`empty_0_14`,`empty_1_14`,`egg_quality_0_15`,`comment_0_15`,`pn1_0_15`,`pn2_0_15`,`pn3_0_15`,`degenerate_15`,`pb2_15`,`comments_15`,`cell_0_15`,`grade_0_15`,`clevage_time_15`,`frag_0_15`,`cell_1_15`,`grade_1_15`,`frag_1_15`,`stage_15`,`grade_2_15`,`frag_2_15`,`date_0_15`,`media_0_15`,`container_no_0_15`,`straw_no_15`,`color_15`,`embryos_frozen_0_15`,`storage_renewal_dt_15`,`date_1_15`,`purpose_0_15`,`media_1_15`,`no_embryo_thawed_15`,`thawing_path_15`,`no_embryo_recovered_15`,`date_2_15`,`reason_15`,`empty_0_15`,`empty_1_15`,`egg_quality_0_16`,`comment_0_16`,`pn1_0_16`,`pn2_0_16`,`pn3_0_16`,`degenerate_16`,`pb2_16`,`comments_16`,`cell_0_16`,`grade_0_16`,`clevage_time_16`,`frag_0_16`,`cell_1_16`,`grade_1_16`,`frag_1_16`,`stage_16`,`grade_2_16`,`frag_2_16`,`date_0_16`,`media_0_16`,`container_no_0_16`,`straw_no_16`,`color_16`,`embryos_frozen_0_16`,`storage_renewal_dt_16`,`date_1_16`,`purpose_0_16`,`media_1_16`,`no_embryo_thawed_16`,`thawing_path_16`,`no_embryo_recovered_16`,`date_2_16`,`reason_16`,`empty_0_16`,`empty_1_16`,`egg_quality_0_17`,`comment_0_17`,`pn1_0_17`,`pn2_0_17`,`pn3_0_17`,`degenerate_17`,`pb2_17`,`comments_17`,`cell_0_17`,`grade_0_17`,`clevage_time_17`,`frag_0_17`,`cell_1_17`,`grade_1_17`,`frag_1_17`,`stage_17`,`grade_2_17`,`frag_2_17`,`date_0_17`,`media_0_17`,`container_no_0_17`,`straw_no_17`,`color_17`,`embryos_frozen_0_17`,`storage_renewal_dt_17`,`date_1_17`,`purpose_0_17`,`media_1_17`,`no_embryo_thawed_17`,`thawing_path_17`,`no_embryo_recovered_17`,`date_2_17`,`reason_17`,`empty_0_17`,`empty_1_17`,`egg_quality_0_18`,`comment_0_18`,`pn1_0_18`,`pn2_0_18`,`pn3_0_18`,`degenerate_18`,`pb2_18`,`comments_18`,`cell_0_18`,`grade_0_18`,`clevage_time_18`,`frag_0_18`,`cell_1_18`,
// 		`grade_1_18`,`frag_1_18`,`stage_18`,`grade_2_18`,`frag_2_18`,`date_0_18`,`media_0_18`,`container_no_0_18`,`straw_no_18`,`color_18`,`embryos_frozen_0_18`,`storage_renewal_dt_18`,`date_1_18`,`purpose_0_18`,`media_1_18`,`no_embryo_thawed_18`,`thawing_path_18`,`no_embryo_recovered_18`,`date_2_18`,`reason_18`,`empty_0_18`,`empty_1_18`,`egg_quality_0_19`,`comment_0_19`,`pn1_0_19`,`pn2_0_19`,`pn3_0_19`,`degenerate_19`,`pb2_19`,`comments_19`,`cell_0_19`,`grade_0_19`,`clevage_time_19`,`frag_0_19`,`cell_1_19`,`grade_1_19`,`frag_1_19`,`stage_19`,`grade_2_19`,`frag_2_19`,`date_0_19`,`media_0_19`,`container_no_0_19`,`straw_no_19`,`color_19`,`embryos_frozen_0_19`,`storage_renewal_dt_19`,`date_1_19`,`purpose_0_19`,`media_1_19`,`no_embryo_thawed_19`,`thawing_path_19`,`no_embryo_recovered_19`,`date_2_19`,`reason_19`,`empty_0_19`,`empty_1_19`,`egg_quality_0_20`,`comment_0_20`,`pn1_0_20`,`pn2_0_20`,`pn3_0_20`,`degenerate_20`,`pb2_20`,`comments_20`,`cell_0_20`,`grade_0_20`,`clevage_time_20`,`frag_0_20`,`cell_1_20`,`grade_1_20`,`frag_1_20`,`stage_20`,`grade_2_20`,`frag_2_20`,`date_0_20`,`media_0_20`,`container_no_0_20`,`straw_no_20`,`color_20`,`embryos_frozen_0_20`,`storage_renewal_dt_20`,`date_1_20`,`purpose_0_20`,`media_1_20`,`no_embryo_thawed_20`,`thawing_path_20`,`no_embryo_recovered_20`,`date_2_20`,`reason_20`,`empty_0_20`,`empty_1_20`) VALUES ('$patient_id','$receipt_number','$status','$date0','$date1','$date2','$date3','$date4','$date5','$date6','$date7','$date8','$date9','$date10','$time0','$time1','$time2','$time3','$time4','$time5','$time6','$time7','$time8','$time9','$time10','$emb','$score_time','$hrs0','$hrs1','$hrs2','$hrs3','$hrs4','$hrs5','$hrs6','$hrs7','$hrs8','$dr','$emb0','$emb1','$emb2','$emb3','$emb4','$emb5','$emb6','$emb7','$emb8','$emb9','$witness0','$witness1','$witness2','$wit0','$wit1','$wit2','$wit3','$wit4','$wit5','$wit6','$wit7','$ivf_inseminated','$icsi_inseminated','$ivf_injected','$icsi_injected','$ivf_degenerated','$icsi_degenerated','$ivf_oocytes','$icsi_oocytes','$ivf_oocytes_injected','$icsi_oocytes_injected','$no_fertilization','$no_1_pn_oocyte','$oocyte_2pn_pb','$oocyte_2pn','$cleaved_embryos','$cell_embryos_day2','$cell_embryos_day3','$blastocysts_day5','$embryos_transferred','$embryos_frozen','$thawed_embryo_transferred','$embryos_intact','$warmed_embryos','$intact_blasts','$warmed_blasts','$embryos_hatched','$hyal_time','$hyal_time_emb','$inj_time','$inj_time_emb','$upload_photo_0','$upload_photo_1','$upload_photo_2','$upload_photo_3','$method','$upload_photo_4','$upload_photo_5','$no_0','$egg_quality_0','$comment_0','$pn1_0','$pn2_0','$pn3_0','$degenerate','$pb2','$comments','$cell_0','$grade_0','$clevage_time','$frag_0','$cell_1','$grade_1','$frag_1','$stage','$grade_2','$frag_2','$date_0','$media_0','$container_no_0','$straw_no','$color','$embryos_frozen_0','$storage_renewal_dt','$date_1','$purpose_0','$media_1','$no_embryo_thawed','$thawing_path','$no_embryo_recovered','$date_2','$reason','$empty_0','$empty_1','$egg_quality_0_1','$comment_0_1','$pn1_0_1','$pn2_0_1','$pn3_0_1','$degenerate_1','$pb2_1','$comments_1','$cell_0_1','$grade_0_1','$clevage_time_1','$frag_0_1','$cell_1_1','$grade_1_1','$frag_1_1','$stage_1','$grade_2_1','$frag_2_1','$date_0_1','$media_0_1','$container_no_0_1','$straw_no_1','$color_1','$embryos_frozen_0_1','$storage_renewal_dt_1','$date_1_1','$purpose_0_1','$media_1_1','$no_embryo_thawed_1','$thawing_path_1','$no_embryo_recovered_1','$date_2_1','$reason_1','$empty_0_1','$empty_1_1','$egg_quality_0_2','$comment_0_2','$pn1_0_2','$pn2_0_2','$pn3_0_2','$degenerate_2','$pb2_2','$comments_2','$cell_0_2','$grade_0_2','$clevage_time_2','$frag_0_2','$cell_1_2','$grade_1_2','$frag_1_2','$stage_2','$grade_2_2','$frag_2_2','$date_0_2','$media_0_2','$container_no_0_2','$straw_no_2','$color_2','$embryos_frozen_0_2','$storage_renewal_dt_2','$date_1_2','$purpose_0_2','$media_1_2','$no_embryo_thawed_2','$thawing_path_2','$no_embryo_recovered_2','$date_2_2','$reason_2','$empty_0_2','$empty_1_2','$egg_quality_0_3','$comment_0_3','$pn1_0_3','$pn2_0_3','$pn3_0_3','$degenerate_3','$pb2_3','$comments_3','$cell_0_3','$grade_0_3','$clevage_time_3','$frag_0_3','$cell_1_3','$grade_1_3','$frag_1_3','$stage_3','$grade_2_3','$frag_2_3','$date_0_3','$media_0_3','$container_no_0_3','$straw_no_3','$color_3','$embryos_frozen_0_3','$storage_renewal_dt_3','$date_1_3','$purpose_0_3','$media_1_3','$no_embryo_thawed_3','$thawing_path_3','$no_embryo_recovered_3','$date_2_3','$reason_3','$empty_0_3','$empty_1_3','$egg_quality_0_4','$comment_0_4','$pn1_0_4','$pn2_0_4','$pn3_0_4','$degenerate_4','$pb2_4','$comments_4','$cell_0_4','$grade_0_4','$clevage_time_4','$frag_0_4','$cell_1_4','$grade_1_4','$frag_1_4','$stage_4','$grade_2_4','$frag_2_4','$date_0_4','$media_0_4','$container_no_0_4','$straw_no_4','$color_4','$embryos_frozen_0_4','$storage_renewal_dt_4','$date_1_4','$purpose_0_4','$media_1_4','$no_embryo_thawed_4','$thawing_path_4','$no_embryo_recovered_4','$date_2_4','$reason_4','$empty_0_4','$empty_1_4','$egg_quality_0_5','$comment_0_5','$pn1_0_5','$pn2_0_5','$pn3_0_5','$degenerate_5','$pb2_5','$comments_5','$cell_0_5','$grade_0_5','$clevage_time_5','$frag_0_5','$cell_1_5','$grade_1_5','$frag_1_5','$stage_5','$grade_2_5','$frag_2_5','$date_0_5','$media_0_5','$container_no_0_5','$straw_no_5','$color_5','$embryos_frozen_0_5','$storage_renewal_dt_5','$date_1_5','$purpose_0_5','$media_1_5','$no_embryo_thawed_5','$thawing_path_5','$no_embryo_recovered_5','$date_2_5','$reason_5','$empty_0_5','$empty_1_5','$egg_quality_0_6','$comment_0_6','$pn1_0_6','$pn2_0_6','$pn3_0_6','$degenerate_6','$pb2_6','$comments_6','$cell_0_6','$grade_0_6','$clevage_time_6','$frag_0_6','$cell_1_6','$grade_1_6','$frag_1_6','$stage_6','$grade_2_6','$frag_2_6','$date_0_6','$media_0_6','$container_no_0_6','$straw_no_6','$color_6','$embryos_frozen_0_6','$storage_renewal_dt_6','$date_1_6','$purpose_0_6','$media_1_6','$no_embryo_thawed_6','$thawing_path_6','$no_embryo_recovered_6','$date_2_6','$reason_6','$empty_0_6','$empty_1_6','$egg_quality_0_7','$comment_0_7','$pn1_0_7','$pn2_0_7','$pn3_0_7','$degenerate_7','$pb2_7','$comments_7','$cell_0_7','$grade_0_7','$clevage_time_7','$frag_0_7','$cell_1_7','$grade_1_7','$frag_1_7','$stage_7','$grade_2_7','$frag_2_7','$date_0_7','$media_0_7','$container_no_0_7','$straw_no_7','$color_7','$embryos_frozen_0_7','$storage_renewal_dt_7','$date_1_7','$purpose_0_7','$media_1_7','$no_embryo_thawed_7','$thawing_path_7','$no_embryo_recovered_7','$date_2_7','$reason_7','$empty_0_7','$empty_1_7','$egg_quality_0_8','$comment_0_8','$pn1_0_8','$pn2_0_8','$pn3_0_8','$degenerate_8','$pb2_8','$comments_8','$cell_0_8','$grade_0_8','$clevage_time_8','$frag_0_8','$cell_1_8','$grade_1_8','$frag_1_8','$stage_8','$grade_2_8','$frag_2_8','$date_0_8','$media_0_8','$container_no_0_8','$straw_no_8','$color_8','$embryos_frozen_0_8','$storage_renewal_dt_8','$date_1_8','$purpose_0_8','$media_1_8','$no_embryo_thawed_8','$thawing_path_8','$no_embryo_recovered_8','$date_2_8','$reason_8','$empty_0_8','$empty_1_8','$egg_quality_0_9','$comment_0_9','$pn1_0_9','$pn2_0_9','$pn3_0_9','$degenerate_9','$pb2_9','$comments_9','$cell_0_9','$grade_0_9','$clevage_time_9','$frag_0_9','$cell_1_9','$grade_1_9','$frag_1_9','$stage_9','$grade_2_9','$frag_2_9','$date_0_9','$media_0_9','$container_no_0_9','$straw_no_9','$color_9','$embryos_frozen_0_9','$storage_renewal_dt_9','$date_1_9','$purpose_0_9','$media_1_9','$no_embryo_thawed_9','$thawing_path_9','$no_embryo_recovered_9','$date_2_9','$reason_9','$empty_0_9','$empty_1_9','$egg_quality_0_10','$comment_0_10','$pn1_0_10','$pn2_0_10','$pn3_0_10','$degenerate_10','$pb2_10','$comments_10','$cell_0_10','$grade_0_10','$clevage_time_10','$frag_0_10','$cell_1_10','$grade_1_10','$frag_1_10','$stage_10','$grade_2_10','$frag_2_10','$date_0_10','$media_0_10','$container_no_0_10','$straw_no_10','$color_10','$embryos_frozen_0_10','$storage_renewal_dt_10','$date_1_10','$purpose_0_10','$media_1_10','$no_embryo_thawed_10','$thawing_path_10','$no_embryo_recovered_10','$date_2_10','$reason_10','$empty_0_10','$empty_1_10','$egg_quality_0_11','$comment_0_11','$pn1_0_11','$pn2_0_11','$pn3_0_11','$degenerate_11','$pb2_11','$comments_11','$cell_0_11','$grade_0_11','$clevage_time_11','$frag_0_11','$cell_1_11','$grade_1_11','$frag_1_11','$stage_11','$grade_2_11','$frag_2_11','$date_0_11','$media_0_11','$container_no_0_11','$straw_no_11','$color_11','$embryos_frozen_0_11','$storage_renewal_dt_11','$date_1_11','$purpose_0_11','$media_1_11','$no_embryo_thawed_11','$thawing_path_11','$no_embryo_recovered_11','$date_2_11','$reason_11','$empty_0_11','$empty_1_11','$egg_quality_0_12','$comment_0_12','$pn1_0_12','$pn2_0_12','$pn3_0_12','$degenerate_12','$pb2_12','$comments_12','$cell_0_12','$grade_0_12','$clevage_time_12','$frag_0_12','$cell_1_12','$grade_1_12','$frag_1_12','$stage_12','$grade_2_12','$frag_2_12','$date_0_12','$media_0_12','$container_no_0_12','$straw_no_12','$color_12','$embryos_frozen_0_12','$storage_renewal_dt_12','$date_1_12','$purpose_0_12','$media_1_12','$no_embryo_thawed_12','$thawing_path_12','$no_embryo_recovered_12','$date_2_12','$reason_12','$empty_0_12','$empty_1_12','$egg_quality_0_13','$comment_0_13','$pn1_0_13','$pn2_0_13','$pn3_0_13','$degenerate_13','$pb2_13','$comments_13','$cell_0_13','$grade_0_13','$clevage_time_13','$frag_0_13','$cell_1_13','$grade_1_13','$frag_1_13','$stage_13','$grade_2_13','$frag_2_13','$date_0_13','$media_0_13','$container_no_0_13','$straw_no_13','$color_13','$embryos_frozen_0_13','$storage_renewal_dt_13','$date_1_13','$purpose_0_13','$media_1_13','$no_embryo_thawed_13','$thawing_path_13','$no_embryo_recovered_13','$date_2_13','$reason_13','$empty_0_13','$empty_1_13','$egg_quality_0_14','$comment_0_14','$pn1_0_14','$pn2_0_14','$pn3_0_14','$degenerate_14','$pb2_14','$comments_14','$cell_0_14','$grade_0_14','$clevage_time_14','$frag_0_14','$cell_1_14','$grade_1_14','$frag_1_14','$stage_14','$grade_2_14','$frag_2_14','$date_0_14','$media_0_14','$container_no_0_14','$straw_no_14','$color_14','$embryos_frozen_0_14','$storage_renewal_dt_14','$date_1_14','$purpose_0_14','$media_1_14','$no_embryo_thawed_14','$thawing_path_14','$no_embryo_recovered_14','$date_2_14','$reason_14','$empty_0_14','$empty_1_14','$egg_quality_0_15','$comment_0_15','$pn1_0_15','$pn2_0_15','$pn3_0_15','$degenerate_15','$pb2_15','$comments_15','$cell_0_15','$grade_0_15','$clevage_time_15','$frag_0_15','$cell_1_15','$grade_1_15','$frag_1_15','$stage_15','$grade_2_15','$frag_2_15','$date_0_15','$media_0_15','$container_no_0_15','$straw_no_15','$color_15','$embryos_frozen_0_15','$storage_renewal_dt_15','$date_1_15','$purpose_0_15','$media_1_15','$no_embryo_thawed_15','$thawing_path_15','$no_embryo_recovered_15','$date_2_15','$reason_15','$empty_0_15','$empty_1_15','$egg_quality_0_16','$comment_0_16','$pn1_0_16','$pn2_0_16','$pn3_0_16','$degenerate_16','$pb2_16','$comments_16','$cell_0_16','$grade_0_16','$clevage_time_16','$frag_0_16','$cell_1_16','$grade_1_16','$frag_1_16','$stage_16','$grade_2_16','$frag_2_16','$date_0_16','$media_0_16','$container_no_0_16','$straw_no_16','$color_16','$embryos_frozen_0_16','$storage_renewal_dt_16','$date_1_16','$purpose_0_16','$media_1_16','$no_embryo_thawed_16','$thawing_path_16','$no_embryo_recovered_16','$date_2_16','$reason_16','$empty_0_16','$empty_1_16','$egg_quality_0_17','$comment_0_17','$pn1_0_17','$pn2_0_17','$pn3_0_17','$degenerate_17','$pb2_17','$comments_17','$cell_0_17','$grade_0_17','$clevage_time_17','$frag_0_17','$cell_1_17','$grade_1_17','$frag_1_17','$stage_17','$grade_2_17','$frag_2_17','$date_0_17','$media_0_17','$container_no_0_17','$straw_no_17','$color_17','$embryos_frozen_0_17','$storage_renewal_dt_17','$date_1_17','$purpose_0_17','$media_1_17','$no_embryo_thawed_17','$thawing_path_17','$no_embryo_recovered_17','$date_2_17','$reason_17','$empty_0_17','$empty_1_17','$egg_quality_0_18','$comment_0_18','$pn1_0_18','$pn2_0_18','$pn3_0_18','$degenerate_18','$pb2_18','$comments_18','$cell_0_18','$grade_0_18','$clevage_time_18','$frag_0_18','$cell_1_18','$grade_1_18','$frag_1_18','$stage_18','$grade_2_18','$frag_2_18','$date_0_18','$media_0_18','$container_no_0_18','$straw_no_18','$color_18','$embryos_frozen_0_18','$storage_renewal_dt_18','$date_1_18','$purpose_0_18','$media_1_18','$no_embryo_thawed_18','$thawing_path_18','$no_embryo_recovered_18','$date_2_18','$reason_18','$empty_0_18','$empty_1_18','$egg_quality_0_19','$comment_0_19','$pn1_0_19','$pn2_0_19','$pn3_0_19','$degenerate_19','$pb2_19','$comments_19','$cell_0_19','$grade_0_19','$clevage_time_19','$frag_0_19','$cell_1_19','$grade_1_19','$frag_1_19','$stage_19','$grade_2_19','$frag_2_19','$date_0_19','$media_0_19','$container_no_0_19','$straw_no_19','$color_19','$embryos_frozen_0_19','$storage_renewal_dt_19','$date_1_19','$purpose_0_19','$media_1_19','$no_embryo_thawed_19','$thawing_path_19','$no_embryo_recovered_19','$date_2_19','$reason_19','$empty_0_19','$empty_1_19','$egg_quality_0_20','$comment_0_20','$pn1_0_20','$pn2_0_20','$pn3_0_20','$degenerate_20','$pb2_20','$comments_20','$cell_0_20','$grade_0_20','$clevage_time_20','$frag_0_20','$cell_1_20','$grade_1_20','$frag_1_20','$stage_20','$grade_2_20','$frag_2_20','$date_0_20','$media_0_20','$container_no_0_20','$straw_no_20','$color_20','$embryos_frozen_0_20','$storage_renewal_dt_20','$date_1_20','$purpose_0_20','$media_1_20','$no_embryo_thawed_20','$thawing_path_20','$no_embryo_recovered_20','$date_2_20','$reason_20','$empty_0_20','$empty_1_20')";
// 		$result = run_form_query($query);

// 		if($result){
// 		header("location:" .base_url(). "procedure_reports/".$appointment_id."?m=".base64_encode('Procedure form inserted!').'&t='.base64_encode('success'));
// 					die();
// 		}else{
// 		header("location:" .base_url(). "procedure_reports/".$appointment_id."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
// 					die();
// 		}
// }
?> -->
<form enctype='multipart/form-data'  class ="searchform" name="form" action="" method="POST">
<input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">
<input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">
<input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">
  <input type="hidden" value="<?php echo $procedure_id; ?>" class="form" name="procedure_id">
  <input type="hidden" value="<?php echo $patient_id; ?>" class="form" name="patient_id">
  <input type="hidden" value="<?php echo $receipt_number; ?>" class="form" name="receipt_number">
  <input type="hidden" value="pending" name="status"> 
    			<div class="container red-field form mt-5 mb-5">
    				<table class="table table-bordered table-hover mt-2 table-sm red-field tableMg">
     					<thead>
                			<tr>
                				<td colspan="2"><h2>EMBRYO RECORD SHEET</h2></td>
                				<td colspan="2">
                    			    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&
                    			            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 
                    			            isset($select_result['updated_type']) && !empty($select_result['updated_type'])
                    			            ){?>
                    			        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>
                    			    <?php } ?>
                    			</td>
                			</tr>
     					</thead>
  					</table>
 					<div class='table-responsive'>
    					<table class="table table-bordered table-hover mt-2 table-sm red-field">
					        <thead>
					        	<tr>
					        		<th colspan="3" style="background: #FFC000">Day O (OPU)</th>
					        		<th colspan="6" style="background: #F4B083">Day 1</th>
					        		<th colspan="4" style="background: #C5E0B3">Day 2</th>
					        		<th colspan="3" style="background: #8EAADB">Day 3</th>
					        		<th style="background: #548135">Day 4</th>
					        		<th colspan="2" style="background: #AEABAB">Day 5</th>
					        		<th colspan="7" style="background: #F2F2F2">Freezing</th>
					        		<th colspan="6" style="background: #C5E0B3">Thawing</th>
					        		<th colspan="2" style="background: #FEF2CB">LAH</th>
					        		<th colspan="2" style="background: #F7CAAC">DISCARD</th>
					        		<th colspan="2" style="background: #8EAADB">REMARKS</th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="background: #FFC000">Date: <input type="date" value="<?php echo isset($select_result['date0'])?$select_result['date0']:""; ?>"  name="date0"></th>
					        		<th colspan="6" style="background: #F4B083">Date: <input type="date" value="<?php echo isset($select_result['date1'])?$select_result['date1']:""; ?>"  name="date1"></th>
					        		<th colspan="4" style="background: #C5E0B3">Date: <input type="date" value="<?php echo isset($select_result['date2'])?$select_result['date2']:""; ?>"  name="date2"></th>
					        		<th colspan="3" style="background: #8EAADB">Date: <input type="date" value="<?php echo isset($select_result['date3'])?$select_result['date3']:""; ?>"  name="date3"></th>
					        		<th colspan="1" style="background: #548135">Date: <input type="date" value="<?php echo isset($select_result['date4'])?$select_result['date4']:""; ?>"  name="date4"></th>
					        		<th colspan="2" style="background: #AEABAB">Date: <input type="date" value="<?php echo isset($select_result['date5'])?$select_result['date5']:""; ?>"  name="date5"></th>
					        		<th colspan="7" style="background: #F2F2F2">Date: <input type="date" value="<?php echo isset($select_result['date6'])?$select_result['date6']:""; ?>"  name="date6"></th>
					        		<th colspan="6" style="background: #C5E0B3">Date: <input type="date" value="<?php echo isset($select_result['date7'])?$select_result['date7']:""; ?>"  name="date7"></th>
					        		<th colspan="2" style="background: #FEF2CB">Date: <input type="date" value="<?php echo isset($select_result['date8'])?$select_result['date8']:""; ?>"  name="date8"></th>
					        		<th colspan="2" style="background: #F7CAAC">Date: <input type="date" value="<?php echo isset($select_result['date9'])?$select_result['date9']:""; ?>"  name="date9"></th>
					        		<th colspan="2" style="background: #8EAADB">Date: <input type="date" value="<?php echo isset($select_result['date10'])?$select_result['date10']:""; ?>"  name="date10"></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="background: #FFC000">Time: <input type="time" value="<?php echo isset($select_result['time0'])?$select_result['time0']:""; ?>"  name="time0"></th>
					        		<th colspan="6" style="background: #F4B083">Diss.Time: <input type="time" value="<?php echo isset($select_result['time1'])?$select_result['time1']:""; ?>"  name="time1"></th>
					        		<th colspan="4" style="background: #C5E0B3">Time: <input type="time" value="<?php echo isset($select_result['time2'])?$select_result['time2']:""; ?>"  name="time2"></th>
					        		<th colspan="3" style="background: #8EAADB">Time: <input type="time" value="<?php echo isset($select_result['time3'])?$select_result['time3']:""; ?>"  name="time3"></th>
					        		<th style="background: #548135">Time: <input type="time" value="<?php echo isset($select_result['time4'])?$select_result['time4']:""; ?>"  name="time4"></th>
					        		<th colspan="2" style="background: #AEABAB">Time: <input type="time" value="<?php echo isset($select_result['time5'])?$select_result['time5']:""; ?>"  name="time5"></th>
					        		<th colspan="7" style="background: #F2F2F2">Time: <input type="time" value="<?php echo isset($select_result['time6'])?$select_result['time6']:""; ?>"  name="time6"></th>
					        		<th colspan="6" style="background: #C5E0B3">Time: <input type="time" value="<?php echo isset($select_result['time7'])?$select_result['time7']:""; ?>"  name="time7"></th>
					        		<th colspan="2" style="background: #FEF2CB">Time: <input type="time" value="<?php echo isset($select_result['time8'])?$select_result['time8']:""; ?>"  name="time8"></th>
					        		<th colspan="2" style="background: #F7CAAC">Time: <input type="time" value="<?php echo isset($select_result['time9'])?$select_result['time9']:""; ?>"  name="time9"></th>
					        		<th colspan="2" style="background: #8EAADB">Time: <input type="time" value="<?php echo isset($select_result['time10'])?$select_result['time10']:""; ?>"  name="time10"></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="background: #FFC000">Emb: <input type="text" value="<?php echo isset($select_result['emb'])?$select_result['emb']:""; ?>"  maxlength="20" name="emb"  ></th>
					        		<th colspan="6" style="background: #F4B083">Score Time: <input type="time" value="<?php echo isset($select_result['score_time'])?$select_result['score_time']:""; ?>"  name="score_time" ></th>
					        		<th colspan="4" style="background: #C5E0B3">Hrs: <input type="time" value="<?php echo isset($select_result['hrs0'])?$select_result['hrs0']:""; ?>"  name="hrs0"></th>
					        		<th colspan="3" style="background: #8EAADB">Hrs: <input type="time" value="<?php echo isset($select_result['hrs1'])?$select_result['hrs1']:""; ?>"  name="hrs1"></th>
					        		<th style="background: #548135">Hrs: <input type="time" value="<?php echo isset($select_result['hrs2'])?$select_result['hrs2']:""; ?>"  name="hrs2"></th>
					        		<th colspan="2" style="background: #AEABAB">Hrs: <input type="time" value="<?php echo isset($select_result['hrs3'])?$select_result['hrs3']:""; ?>"  name="hrs3"></th>
					        		<th colspan="7" style="background: #F2F2F2">Hrs: <input type="time" value="<?php echo isset($select_result['hrs4'])?$select_result['hrs4']:""; ?>"  name="hrs4"></th>
					        		<th colspan="6" style="background: #C5E0B3">Hrs: <input type="time" value="<?php echo isset($select_result['hrs5'])?$select_result['hrs5']:""; ?>"  name="hrs5"></th>
					        		<th colspan="2" style="background: #FEF2CB">Hrs: <input type="time" value="<?php echo isset($select_result['hrs6'])?$select_result['hrs6']:""; ?>"  name="hrs6"></th>
					        		<th colspan="2" style="background: #F7CAAC">Hrs: <input type="time" value="<?php echo isset($select_result['hrs7'])?$select_result['hrs7']:""; ?>"  name="hrs7"></th>
					        		<th colspan="2" style="background: #8EAADB">Hrs: <input type="time" value="<?php echo isset($select_result['hrs8'])?$select_result['hrs8']:""; ?>"  name="hrs8"></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="background: #FFC000">Dr: <input type="text" value="<?php echo isset($select_result['dr'])?$select_result['dr']:""; ?>"  maxlength="20" name="dr"  ></th>
					        		<th colspan="6" style="background: #F4B083">Emb: <input type="text" value="<?php echo isset($select_result['emb0'])?$select_result['emb0']:""; ?>"  maxlength="20" name="emb0"  ></th>
					        		<th colspan="4" style="background: #C5E0B3">Emb: <input type="text" value="<?php echo isset($select_result['emb1'])?$select_result['emb1']:""; ?>"  maxlength="20" name="emb1"  ></th>
					        		<th colspan="3" style="background: #8EAADB">Emb: <input type="text" value="<?php echo isset($select_result['emb2'])?$select_result['emb2']:""; ?>"  maxlength="20" name="emb2"  ></th>
					        		<th style="background: #548135">Emb: <input type="text" value="<?php echo isset($select_result['emb3'])?$select_result['emb3']:""; ?>"  maxlength="20" name="emb3"  ></th>
					        		<th colspan="2" style="background: #AEABAB">Emb: <input type="text" value="<?php echo isset($select_result['emb4'])?$select_result['emb4']:""; ?>"  maxlength="20" name="emb4"  ></th>
					        		<th colspan="7" style="background: #F2F2F2">Emb: <input type="text" value="<?php echo isset($select_result['emb5'])?$select_result['emb5']:""; ?>"  maxlength="20" name="emb5"  ></th>
					        		<th colspan="6" style="background: #C5E0B3">Emb: <input type="text" value="<?php echo isset($select_result['emb6'])?$select_result['emb6']:""; ?>"  maxlength="20" name="emb6"  ></th>
					        		<th colspan="2" style="background: #FEF2CB">Emb: <input type="text" value="<?php echo isset($select_result['emb7'])?$select_result['emb7']:""; ?>"  maxlength="20" name="emb7"  ></th>
					        		<th colspan="2" style="background: #F7CAAC">Emb: <input type="text" value="<?php echo isset($select_result['emb8'])?$select_result['emb8']:""; ?>"  maxlength="20" name="emb8"  ></th>
					        		<th colspan="2" style="background: #8EAADB">Emb: <input type="text" value="<?php echo isset($select_result['emb9'])?$select_result['emb9']:""; ?>"  maxlength="20" name="emb9"  ></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="background: #FFC000">Witness: <input type="text" value="<?php echo isset($select_result['witness0'])?$select_result['witness0']:""; ?>"  maxlength="20" name="witness0"  ></th>
					        		<th colspan="6" style="background: #F4B083">Witness: <input type="text" value="<?php echo isset($select_result['witness1'])?$select_result['witness1']:""; ?>"  maxlength="20" name="witness1"  ></th>
					        		<th colspan="4" style="background: #C5E0B3">Witness: <input type="text" value="<?php echo isset($select_result['witness2'])?$select_result['witness2']:""; ?>"  maxlength="20" name="witness2"  ></th>
					        		<th colspan="3" style="background: #8EAADB">Wit: <input type="text" value="<?php echo isset($select_result['wit0'])?$select_result['wit0']:""; ?>"  maxlength="20" name="wit0"  ></th>
					        		<th style="background: #548135">Wit: <input type="text" value="<?php echo isset($select_result['wit1'])?$select_result['wit1']:""; ?>"  maxlength="20" name="wit1"  ></th>
					        		<th colspan="2" style="background: #AEABAB">Wit: <input type="text" value="<?php echo isset($select_result['wit2'])?$select_result['wit2']:""; ?>"  maxlength="20" name="wit2"  ></th>
					        		<th colspan="7" style="background: #F2F2F2">Wit: <input type="text" value="<?php echo isset($select_result['wit3'])?$select_result['wit3']:""; ?>"  maxlength="20" name="wit3"  ></th>
					        		<th colspan="6" style="background: #C5E0B3">Wit: <input type="text" value="<?php echo isset($select_result['wit4'])?$select_result['wit4']:""; ?>"  maxlength="20" name="wit4"  ></th>
					        		<th colspan="2" style="background: #FEF2CB">Wit: <input type="text" value="<?php echo isset($select_result['wit5'])?$select_result['wit5']:""; ?>"  maxlength="20" name="wit5"  ></th>
					        		<th colspan="2" style="background: #F7CAAC">Wit: <input type="text" value="<?php echo isset($select_result['wit6'])?$select_result['wit6']:""; ?>"  maxlength="20" name="wit6"  ></th>
					        		<th colspan="2" style="background: #8EAADB">Wit: <input type="text" value="<?php echo isset($select_result['wit7'])?$select_result['wit7']:""; ?>"  maxlength="20" name="wit7"  ></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="padding: 0; background: #FFC000">
					        			<table style="width: 100%;">
					        				<tr>
					        					<td></td>
					        					<td>IVF</td>
					        					<td>ICSI</td>
					        				</tr>
					        				<tr>
					        					<td>No. COC inseminated</td>
					        					<td><input type="number" value="<?php echo isset($select_result['ivf_inseminated'])?$select_result['ivf_inseminated']:""; ?>"  min="0" name="ivf_inseminated"></td>
					        					<td><input type="number" value="<?php echo isset($select_result['icsi_inseminated'])?$select_result['icsi_inseminated']:""; ?>"  min="0" name="icsi_inseminated"></td>
					        				</tr>
					        				<tr>
					        					<td>All oocyte injected</td>
					        					<td><input type="number" value="<?php echo isset($select_result['ivf_injected'])?$select_result['ivf_injected']:""; ?>"  min="0" name="ivf_injected"></td>
					        					<td><input type="number" value="<?php echo isset($select_result['icsi_injected'])?$select_result['icsi_injected']:""; ?>"  min="0" name="icsi_injected"></td>
					        				</tr>
					        				<tr>
					        					<td>No. damaged or degenerated oocyte during ICSI</td>
					        					<td><input type="number" value="<?php echo isset($select_result['ivf_degenerated'])?$select_result['ivf_degenerated']:""; ?>"  min="0" name="ivf_degenerated"></td>
					        					<td><input type="number" value="<?php echo isset($select_result['icsi_degenerated'])?$select_result['icsi_degenerated']:""; ?>"  min="0" name="icsi_degenerated"></td>
					        				</tr>
					        				<tr>
					        					<td>No.M2 oocytes at ICSI</td>
					        					<td><input type="number" value="<?php echo isset($select_result['ivf_oocytes'])?$select_result['ivf_oocytes']:""; ?>"  min="0" name="ivf_oocytes"></td>
					        					<td><input type="number" value="<?php echo isset($select_result['icsi_oocytes'])?$select_result['icsi_oocytes']:""; ?>"  min="0" name="icsi_oocytes"></td>
					        				</tr>
					        				<tr>
					        					<td>No.M2 oocytes injected</td>
					        					<td><input type="number" value="<?php echo isset($select_result['ivf_oocytes_injected'])?$select_result['ivf_oocytes_injected']:""; ?>"  min="0" name="ivf_oocytes_injected"></td>
					        					<td><input type="number" value="<?php echo isset($select_result['icsi_oocytes_injected'])?$select_result['icsi_oocytes_injected']:""; ?>"  min="0" name="icsi_oocytes_injected"></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="6" style="padding: 0; background: #F4B083">
					        			<table style="width: 100%;">
					        				<tr>
												<td>Total No.of oocytes with no fertilization</td>
												<td><input type="number" value="<?php echo isset($select_result['no_fertilization'])?$select_result['no_fertilization']:""; ?>"  min="0" name="no_fertilization"></td>
											</tr>
											<tr>
												<td>No.1 PN oocyte</td>
												<td><input type="number" value="<?php echo isset($select_result['no_1_pn_oocyte'])?$select_result['no_1_pn_oocyte']:""; ?>"  min="0" name="no_1_pn_oocyte"></td>
											</tr>
											<tr>
												<td>No.oocytes with 2 PN and PB</td>
												<td><input type="number" value="<?php echo isset($select_result['oocyte_2pn_pb'])?$select_result['oocyte_2pn_pb']:""; ?>"  min="0" name="oocyte_2pn_pb"></td>
											</tr>
											<tr>
												<td>No.fertilized oocytes with >2PN</td>
												<td><input type="number" value="<?php echo isset($select_result['oocyte_2pn'])?$select_result['oocyte_2pn']:""; ?>"  min="0" name="oocyte_2pn"></td>
											</tr>
					        			</table>
					        		</th>
					        		<th colspan="4" style="padding: 0; background: #C5E0B3">
					        			<table style="width: 100%;">
					        				<tr>
					        					<td>Total no of cleaved embryos Day2</td>
					        					<td><input type="number" value="<?php echo isset($select_result['cleaved_embryos'])?$select_result['cleaved_embryos']:""; ?>"  min="0" name="cleaved_embryos"></td>
					        				</tr>
					        				<tr>
					        					<td>Total no.of 4 cell embryos Day2</td>
					        					<td><input type="number" value="<?php echo isset($select_result['cell_embryos_day2'])?$select_result['cell_embryos_day2']:""; ?>"  min="0" name="cell_embryos_day2"></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="3" style="padding: 0; background: #8EAADB">
					        			<table style="width: 100%;">
						        			<tr>
						        				<td>Total no. of 8 cell embryos day 3</td>
						        				<td><input type="number" value="<?php echo isset($select_result['cell_embryos_day3'])?$select_result['cell_embryos_day3']:""; ?>"  min="0" name="cell_embryos_day3"></td>
						        			</tr>
					        			</table>
					        		</th>
					        		<th style="background: #548135"></th>
					        		<th colspan="2" style="padding: 0; background: #AEABAB">
					        			<table style="width: 100%;">
						        			<tr>
						        				<td>Total No of blastocysts Day5</td>
						        				<td><input type="number" value="<?php echo isset($select_result['blastocysts_day5'])?$select_result['blastocysts_day5']:""; ?>"  min="0" name="blastocysts_day5"></td>
						        			</tr>
					        			</table>
					        		</th>
					        		<th colspan="7" style="padding: 0; background: #F2F2F2">
					        			<table style="width: 100%;">
					        				<tr>
					        					<td>Total no. of embryos transferred fresh</td>
					        					<td><input type="number" value="<?php echo isset($select_result['embryos_transferred'])?$select_result['embryos_transferred']:""; ?>"  min="0" name="embryos_transferred"></td>
					        				</tr>
					        				<tr>
					        					<td>Total no. of embryos frozen</td>
					        					<td><input type="number" value="<?php echo isset($select_result['embryos_frozen'])?$select_result['embryos_frozen']:""; ?>"  min="0" name="embryos_frozen"></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="6" style="padding: 0; background: #C5E0B3">
					        			<table style="width: 100%;">
					        				<tr>
					        					<td>Total Thawed embryo transferred</td>
					        					<td><input type="number" value="<?php echo isset($select_result['thawed_embryo_transferred'])?$select_result['thawed_embryo_transferred']:""; ?>"  min="0" name="thawed_embryo_transferred"></td>
					        				</tr>
					        				<tr>
					        					<td>Total embryos intact</td>
					        					<td><input type="number" value="<?php echo isset($select_result['embryos_intact'])?$select_result['embryos_intact']:""; ?>"  min="0" name="embryos_intact"></td>
					        				</tr>
					        				<tr>
					        					<td>Total warmed embryos</td>
					        					<td><input type="number" value="<?php echo isset($select_result['warmed_embryos'])?$select_result['warmed_embryos']:""; ?>"  min="0" name="warmed_embryos"></td>
					        				</tr>
					        				<tr>
					        					<td>Total intact blasts</td>
					        					<td><input type="number" value="<?php echo isset($select_result['intact_blasts'])?$select_result['intact_blasts']:""; ?>"  min="0" name="intact_blasts"></td>
					        				</tr>
					        				<tr>
					        					<td>Total warmed blasts</td>
					        					<td><input type="number" value="<?php echo isset($select_result['warmed_blasts'])?$select_result['warmed_blasts']:""; ?>"  min="0" name="warmed_blasts"></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="2" style="padding: 0; background: #FEF2CB">
					        			<table style="width: 100%;">
					        				<tr>
					        					<td>no.of embryos hatched</td>
					        					<td><input type="number" value="<?php echo isset($select_result['embryos_hatched'])?$select_result['embryos_hatched']:""; ?>"  min="0" name="embryos_hatched"></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="2" style="background: #F7CAAC"></th>
					        		<th colspan="2" style="background: #8EAADB"></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="padding: 0; background: #FFC000">
					        			<table style="width: 100%;">
					        				<tr><td>Hyal Time: <input type="time" value="<?php echo isset($select_result['hyal_time'])?$select_result['hyal_time']:""; ?>"  name="hyal_time"></td></tr>
					        				<tr><td>Emb. : <input type="text" value="<?php echo isset($select_result['hyal_time_emb'])?$select_result['hyal_time_emb']:""; ?>"  maxlength="20" name="hyal_time_emb"  ></td></tr>
					        				<tr><td>Inj Time :<input type="time" value="<?php echo isset($select_result['inj_time'])?$select_result['inj_time']:""; ?>"  name="inj_time"></td></tr>
					        				<tr><td>Emb. :<input type="text" value="<?php echo isset($select_result['inj_time_emb'])?$select_result['inj_time_emb']:""; ?>"  maxlength="20" name="inj_time_emb"  ></td></tr>
					        			</table>
					        		</th>
					        		<th colspan="6" style="background: #F4B083">
					        			<input type="file" value="<?php echo isset($select_result['upload_photo_0'])?$select_result['upload_photo_0']:""; ?>"  name="upload_photo_0">
                      					<a target="_blank" href="<?php echo !empty($select_result['upload_photo_0'])?$select_result['upload_photo_0']:"javascript:void(0)"; ?>">Download</a>
					        		</th>
					        		<th colspan="4" style="background: #C5E0B3">
					        			<input type="file" value="<?php echo isset($select_result['upload_photo_1'])?$select_result['upload_photo_1']:""; ?>"  name="upload_photo_1">
                      					<a target="_blank" href="<?php echo !empty($select_result['upload_photo_1'])?$select_result['upload_photo_1']:"javascript:void(0)"; ?>">Download</a>
					        		</th>
					        		<th colspan="3" style="background: #8EAADB">
					        			<input type="file" value="<?php echo isset($select_result['upload_photo_2'])?$select_result['upload_photo_2']:""; ?>"  name="upload_photo_2">
                      					<a target="_blank" href="<?php echo !empty($select_result['upload_photo_2'])?$select_result['upload_photo_2']:"javascript:void(0)"; ?>">Download</a>
					        		</th>
					        		<th style="background: #548135"></th>
					        		<th colspan="2" style="background: #AEABAB">
					        			<input type="file" value="<?php echo isset($select_result['upload_photo_3'])?$select_result['upload_photo_3']:""; ?>"  name="upload_photo_3">
                      					<a target="_blank" href="<?php echo !empty($select_result['upload_photo_3'])?$select_result['upload_photo_3']:"javascript:void(0)"; ?>">Download</a>
					        		</th>
					        		<th colspan="7" style="background: #F2F2F2">
					        			Method:
					        			<input type="radio"  name="method" value="Slow" <?php if(isset($select_result['method']) && $select_result['method'] == "Slow"){echo 'checked="checked"'; }?> > Slow
					        			<input type="radio"  name="method" value="Virti" <?php if(isset($select_result['method']) && $select_result['method'] == "Virti"){echo 'checked="checked"'; }
										  else if(isset($select_result['method']) && $select_result['method'] != "Yes"){echo 'checked="checked"';}?> > Virti
					        		</th>
					        		<th colspan="6" style="background: #C5E0B3">
					        			<input type="file" value="<?php echo isset($select_result['upload_photo_4'])?$select_result['upload_photo_4']:""; ?>"  name="upload_photo_4">
                      					<a target="_blank" href="<?php echo !empty($select_result['upload_photo_4'])?$select_result['upload_photo_4']:"javascript:void(0)"; ?>">Download</a>
					        		</th>
					        		<th colspan="2" style="background: #FEF2CB">
					        			<input type="file" value="<?php echo isset($select_result['upload_photo_5'])?$select_result['upload_photo_5']:""; ?>"  name="upload_photo_5">
                      					<a target="_blank" href="<?php echo !empty($select_result['upload_photo_5'])?$select_result['upload_photo_5']:"javascript:void(0)"; ?>">Download</a>
					        		</th>
					        		<th colspan="2" style="background: #F7CAAC"></th>
					        		<th colspan="2" style="background: #8EAADB"></th>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<td style="background: #FFC000">No</td>
									<td style="background: #FFC000">Egg Quality</td>
									<td style="background: #FFC000">comment</td>
									<td style="background: #F4B083">1PN</td>
									<td style="background: #F4B083">2PN</td>
									<td style="background: #F4B083">3PN</td>
									<td style="background: #F4B083">Degenerate</td>
									<td style="background: #F4B083">2PB</td>
									<td style="background: #F4B083">comments</td>
									<td style="background: #C5E0B3">Cell</td>
									<td style="background: #C5E0B3">Grade</td>
									<td style="background: #C5E0B3">Clevage Time</td>
									<td style="background: #C5E0B3">Frag%</td>
									<td style="background: #8EAADB">Cell</td>
									<td style="background: #8EAADB">Grade</td>
									<td style="background: #8EAADB">Frag%</td>
									<td style="background: #548135">Stage</td>
									<td style="background: #AEABAB">Grade</td>
									<td style="background: #AEABAB">Frag%</td>
									<td style="background: #F2F2F2">Date</td>
									<td style="background: #F2F2F2">Media</td>
									<td style="background: #F2F2F2">Container No.</td>
									<td style="background: #F2F2F2">Straw No</td>
									<td style="background: #F2F2F2">Color</td>
									<td style="background: #F2F2F2">NO OF EMBRYOS FROZEN</td>
									<td style="background: #F2F2F2">Storage renewal Dt</td>
									<td style="background: #C5E0B3">Date</td>
									<td style="background: #C5E0B3">Purpose</td>
									<td style="background: #C5E0B3">Media</td>
									<td style="background: #C5E0B3">No Embryo Thawed</td>
									<td style="background: #C5E0B3">Thawing Path</td>
									<td style="background: #C5E0B3">No Embryo recovered</td>
									<td style="background: #FEF2CB"></td>
									<td style="background: #FEF2CB"></td>
									<td style="background: #F7CAAC">Date</td>
									<td style="background: #F7CAAC">Reason</td>
									<td style="background: #8EAADB"></td>
									<td style="background: #8EAADB"></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_0'])?$select_result['no_0']:""; ?>"  min="0" name="no_0">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	<input type="radio" name="egg_quality_0" value="M2" <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0" value="M1" <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0" value="GV" <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0'])?$select_result['comment_0']:""; ?>"  name="comment_0"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0'])?$select_result['pn1_0']:""; ?>"  min="0" name="pn1_0"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0'])?$select_result['pn2_0']:""; ?>"  min="0" name="pn2_0"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0'])?$select_result['pn3_0']:""; ?>"  min="0" name="pn3_0"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate'])?$select_result['degenerate']:""; ?>"  min="0" name="degenerate"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2'])?$select_result['pb2']:""; ?>"  min="0" name="pb2"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments'])?$select_result['comments']:""; ?>"  maxlength="20" name="comments"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0'])?$select_result['cell_0']:""; ?>"  maxlength="20" name="cell_0"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0'])?$select_result['grade_0']:""; ?>"  maxlength="20" name="grade_0"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time'])?$select_result['clevage_time']:""; ?>"  maxlength="20" name="clevage_time"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0'])?$select_result['frag_0']:""; ?>"  maxlength="20" name="frag_0"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1'])?$select_result['cell_1']:""; ?>"  maxlength="20" name="cell_1"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1'])?$select_result['grade_1']:""; ?>"  maxlength="20" name="grade_1"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1'])?$select_result['frag_1']:""; ?>"  maxlength="20" name="frag_1"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage'])?$select_result['stage']:""; ?>"  maxlength="20" name="stage"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2'])?$select_result['grade_2']:""; ?>"  maxlength="20" name="grade_2"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2'])?$select_result['frag_2']:""; ?>"  maxlength="20" name="frag_2"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0'])?$select_result['date_0']:""; ?>"  name="date_0"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0'])?$select_result['media_0']:""; ?>"  maxlength="20" name="media_0"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0'])?$select_result['container_no_0']:""; ?>"  maxlength="20" name="container_no_0"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no'])?$select_result['straw_no']:""; ?>"  min="0" name="straw_no"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color'])?$select_result['color']:""; ?>"  maxlength="20" name="color"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0'])?$select_result['embryos_frozen_0']:""; ?>"  min="0" name="embryos_frozen_0"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt'])?$select_result['storage_renewal_dt']:""; ?>"  name="storage_renewal_dt"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1'])?$select_result['date_1']:""; ?>"  name="date_1"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0'])?$select_result['purpose_0']:""; ?>"  maxlength="20" name="purpose_0"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1'])?$select_result['media_1']:""; ?>"  maxlength="20" name="media_1"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed'])?$select_result['no_embryo_thawed']:""; ?>"  min="0" name="no_embryo_thawed"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path'])?$select_result['thawing_path']:""; ?>"  maxlength="20" name="thawing_path"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered'])?$select_result['no_embryo_recovered']:""; ?>"  min="0" name="no_embryo_recovered"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2'])?$select_result['date_2']:""; ?>"  name="date_2"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason'])?$select_result['reason']:""; ?>"  maxlength="20" name="reason"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0'])?$select_result['empty_0']:""; ?>"  maxlength="20" name="empty_0"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1'])?$select_result['empty_1']:""; ?>"  maxlength="20" name="empty_1"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_1'])?$select_result['no_1']:""; ?>"  min="0" name="no_1">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	<input type="radio" name="egg_quality_0_1" value="M2" <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
							        	<input type="radio" name="egg_quality_0_1" value="M1" <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
							        	<input type="radio" name="egg_quality_0_1" value="GV" <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
							        	<input type="radio" name="egg_quality_0_1" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
							       
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_1'])?$select_result['comment_0_1']:""; ?>"  name="comment_0_1"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_1'])?$select_result['pn1_0_1']:""; ?>"  min="0" name="pn1_0_1"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_1'])?$select_result['pn2_0_1']:""; ?>"  min="0" name="pn2_0_1"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_1'])?$select_result['pn3_0_1']:""; ?>"  min="0" name="pn3_0_1"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_1'])?$select_result['degenerate_1']:""; ?>"  min="0" name="degenerate_1"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_1'])?$select_result['pb2_1']:""; ?>"  min="0" name="pb2_1"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_1'])?$select_result['comments_1']:""; ?>"  maxlength="20" name="comments_1"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_1'])?$select_result['cell_0_1']:""; ?>"  maxlength="20" name="cell_0_1"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_1'])?$select_result['grade_0_1']:""; ?>"  maxlength="20" name="grade_0_1"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_1'])?$select_result['clevage_time_1']:""; ?>"  maxlength="20" name="clevage_time_1"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_1'])?$select_result['frag_0_1']:""; ?>"  maxlength="20" name="frag_0_1"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_1'])?$select_result['cell_1_1']:""; ?>"  maxlength="20" name="cell_1_1"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_1'])?$select_result['grade_1_1']:""; ?>"  maxlength="20" name="grade_1_1"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_1'])?$select_result['frag_1_1']:""; ?>"  maxlength="20" name="frag_1_1"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_1'])?$select_result['stage_1']:""; ?>"  maxlength="20" name="stage_1"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_1'])?$select_result['grade_2_1']:""; ?>"  maxlength="20" name="grade_2_1"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_1'])?$select_result['frag_2_1']:""; ?>"  maxlength="20" name="frag_2_1"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_1'])?$select_result['date_0_1']:""; ?>"  name="date_0_1"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_1'])?$select_result['media_0_1']:""; ?>"  maxlength="20" name="media_0_1"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_1'])?$select_result['container_no_0_1']:""; ?>"  maxlength="20" name="container_no_0_1"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_1'])?$select_result['straw_no_1']:""; ?>"  min="0" name="straw_no_1"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_1'])?$select_result['color_1']:""; ?>"  maxlength="20" name="color_1"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_1'])?$select_result['embryos_frozen_0_1']:""; ?>"  min="0" name="embryos_frozen_0_1"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_1'])?$select_result['storage_renewal_dt_1']:""; ?>"  name="storage_renewal_dt_1"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_1'])?$select_result['date_1_1']:""; ?>"  name="date_1_1"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_1'])?$select_result['purpose_0_1']:""; ?>"  maxlength="20" name="purpose_0_1"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_1'])?$select_result['media_1_1']:""; ?>"  maxlength="20" name="media_1_1"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_1'])?$select_result['no_embryo_thawed_1']:""; ?>"  min="0" name="no_embryo_thawed_1"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_1'])?$select_result['thawing_path_1']:""; ?>"  maxlength="20" name="thawing_path_1"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_1'])?$select_result['no_embryo_recovered_1']:""; ?>"  min="0" name="no_embryo_recovered_1"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_1'])?$select_result['date_2_1']:""; ?>"  name="date_2_1"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_1'])?$select_result['reason_1']:""; ?>"  maxlength="20" name="reason_1"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_1'])?$select_result['empty_0_1']:""; ?>"  maxlength="20" name="empty_0_1"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_1'])?$select_result['empty_1_1']:""; ?>"  maxlength="20" name="empty_1_1"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_2'])?$select_result['no_2']:""; ?>"  min="0" name="no_2">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	<input type="radio" name="egg_quality_0_2" value="M2" <?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
							        	<input type="radio" name="egg_quality_0_2" value="M1" <?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
							        	<input type="radio" name="egg_quality_0_2" value="GV" <?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
							        	<input type="radio" name="egg_quality_0_2" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
							       

								   </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_2'])?$select_result['comment_0_2']:""; ?>"  name="comment_0_2"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_2'])?$select_result['pn1_0_2']:""; ?>"  min="0" name="pn1_0_2"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_2'])?$select_result['pn2_0_2']:""; ?>"  min="0" name="pn2_0_2"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_2'])?$select_result['pn3_0_2']:""; ?>"  min="0" name="pn3_0_2"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_2'])?$select_result['degenerate_2']:""; ?>"  min="0" name="degenerate_2"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_2'])?$select_result['pb2_2']:""; ?>"  min="0" name="pb2_2"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_2'])?$select_result['comments_2']:""; ?>"  maxlength="20" name="comments_2"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_2'])?$select_result['cell_0_2']:""; ?>"  maxlength="20" name="cell_0_2"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_2'])?$select_result['grade_0_2']:""; ?>"  maxlength="20" name="grade_0_2"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_2'])?$select_result['clevage_time_2']:""; ?>"  maxlength="20" name="clevage_time_2"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_2'])?$select_result['frag_0_2']:""; ?>"  maxlength="20" name="frag_0_2"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_2'])?$select_result['cell_1_2']:""; ?>"  maxlength="20" name="cell_1_2"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_2'])?$select_result['grade_1_2']:""; ?>"  maxlength="20" name="grade_1_2"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_2'])?$select_result['frag_1_2']:""; ?>"  maxlength="20" name="frag_1_2"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_2'])?$select_result['stage_2']:""; ?>"  maxlength="20" name="stage_2"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_2'])?$select_result['grade_2_2']:""; ?>"  maxlength="20" name="grade_2_2"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_2'])?$select_result['frag_2_2']:""; ?>"  maxlength="20" name="frag_2_2"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_2'])?$select_result['date_0_2']:""; ?>"  name="date_0_2"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_2'])?$select_result['media_0_2']:""; ?>"  maxlength="20" name="media_0_2"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_2'])?$select_result['container_no_0_2']:""; ?>"  maxlength="20" name="container_no_0_2"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_2'])?$select_result['straw_no_2']:""; ?>"  min="0" name="straw_no_2"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_2'])?$select_result['color_2']:""; ?>"  maxlength="20" name="color_2"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_2'])?$select_result['embryos_frozen_0_2']:""; ?>"  min="0" name="embryos_frozen_0_2"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_2'])?$select_result['storage_renewal_dt_2']:""; ?>"  name="storage_renewal_dt_2"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_2'])?$select_result['date_1_2']:""; ?>"  name="date_1_2"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_2'])?$select_result['purpose_0_2']:""; ?>"  maxlength="20" name="purpose_0_2"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_2'])?$select_result['media_1_2']:""; ?>"  maxlength="20" name="media_1_2"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_2'])?$select_result['no_embryo_thawed_2']:""; ?>"  min="0" name="no_embryo_thawed_2"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_2'])?$select_result['thawing_path_2']:""; ?>"  maxlength="20" name="thawing_path_2"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_2'])?$select_result['no_embryo_recovered_2']:""; ?>"  min="0" name="no_embryo_recovered_2"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_2'])?$select_result['date_2_2']:""; ?>"  name="date_2_2"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_2'])?$select_result['reason_2']:""; ?>"  maxlength="20" name="reason_2"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_2'])?$select_result['empty_0_2']:""; ?>"  maxlength="20" name="empty_0_2"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_2'])?$select_result['empty_1_2']:""; ?>"  maxlength="20" name="empty_1_2"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_3'])?$select_result['no_3']:""; ?>"  min="0" name="no_3" >NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	
							        
									<input type="radio" name="egg_quality_0_3" value="M2" <?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_3" value="M1" <?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_3" value="GV" <?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_3" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	
									
									
									
									
									</td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_3'])?$select_result['comment_0_3']:""; ?>"  name="comment_0_3"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_3'])?$select_result['pn1_0_3']:""; ?>"  min="0" name="pn1_0_3"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_3'])?$select_result['pn2_0_3']:""; ?>"  min="0" name="pn2_0_3"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_3'])?$select_result['pn3_0_3']:""; ?>"  min="0" name="pn3_0_3"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_3'])?$select_result['degenerate_3']:""; ?>"  min="0" name="degenerate_3"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_3'])?$select_result['pb2_3']:""; ?>"  min="0" name="pb2_3"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_3'])?$select_result['comments_3']:""; ?>"  maxlength="20" name="comments_3"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_3'])?$select_result['cell_0_3']:""; ?>"  maxlength="20" name="cell_0_3"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_3'])?$select_result['grade_0_3']:""; ?>"  maxlength="20" name="grade_0_3"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_3'])?$select_result['clevage_time_3']:""; ?>"  maxlength="20" name="clevage_time_3"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_3'])?$select_result['frag_0_3']:""; ?>"  maxlength="20" name="frag_0_3"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_3'])?$select_result['cell_1_3']:""; ?>"  maxlength="20" name="cell_1_3"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_3'])?$select_result['grade_1_3']:""; ?>"  maxlength="20" name="grade_1_3"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_3'])?$select_result['frag_1_3']:""; ?>"  maxlength="20" name="frag_1_3"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_3'])?$select_result['stage_3']:""; ?>"  maxlength="20" name="stage_3"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_3'])?$select_result['grade_2_3']:""; ?>"  maxlength="20" name="grade_2_3"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_3'])?$select_result['frag_2_3']:""; ?>"  maxlength="20" name="frag_2_3"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_3'])?$select_result['date_0_3']:""; ?>"  name="date_0_3"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_3'])?$select_result['media_0_3']:""; ?>"  maxlength="20" name="media_0_3"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_3'])?$select_result['container_no_0_3']:""; ?>"  maxlength="20" name="container_no_0_3"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_3'])?$select_result['straw_no_3']:""; ?>"  min="0" name="straw_no_3"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_3'])?$select_result['color_3']:""; ?>"  maxlength="20" name="color_3"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_3'])?$select_result['embryos_frozen_0_3']:""; ?>"  min="0" name="embryos_frozen_0_3"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_3'])?$select_result['storage_renewal_dt_3']:""; ?>"  name="storage_renewal_dt_3"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_3'])?$select_result['date_1_3']:""; ?>"  name="date_1_3"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_3'])?$select_result['purpose_0_3']:""; ?>"  maxlength="20" name="purpose_0_3"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_3'])?$select_result['media_1_3']:""; ?>"  maxlength="20" name="media_1_3"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_3'])?$select_result['no_embryo_thawed_3']:""; ?>"  min="0" name="no_embryo_thawed_3"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_3'])?$select_result['thawing_path_3']:""; ?>"  maxlength="20" name="thawing_path_3"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_3'])?$select_result['no_embryo_recovered_3']:""; ?>"  min="0" name="no_embryo_recovered_3"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_3'])?$select_result['date_2_3']:""; ?>"  name="date_2_3"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_3'])?$select_result['reason_3']:""; ?>"  maxlength="20" name="reason_3"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_3'])?$select_result['empty_0_3']:""; ?>"  maxlength="20" name="empty_0_3"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_3'])?$select_result['empty_1_3']:""; ?>"  maxlength="20" name="empty_1_3"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_4'])?$select_result['no_4']:""; ?>"  min="0" name="no_4">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	<input type="radio"  name="egg_quality_0_4" value="M2" <?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
							        	<input type="radio"  name="egg_quality_0_4" value="M1" <?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
							        	<input type="radio"  name="egg_quality_0_4" value="GV" <?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
							        	<input type="radio"  name="egg_quality_0_4" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_4'])?$select_result['comment_0_4']:""; ?>"  name="comment_0_4"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_4'])?$select_result['pn1_0_4']:""; ?>"  min="0" name="pn1_0_4" ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_4'])?$select_result['pn2_0_4']:""; ?>"  min="0" name="pn2_0_4"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_4'])?$select_result['pn3_0_4']:""; ?>"  min="0" name="pn3_0_4"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_4'])?$select_result['degenerate_4']:""; ?>"  min="0" name="degenerate_4"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_4'])?$select_result['pb2_4']:""; ?>"  min="0" name="pb2_4"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_4'])?$select_result['comments_4']:""; ?>"  maxlength="20" name="comments_4"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_4'])?$select_result['cell_0_4']:""; ?>"  maxlength="20" name="cell_0_4"   ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_4'])?$select_result['grade_0_4']:""; ?>"  maxlength="20" name="grade_0_4"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_4'])?$select_result['clevage_time_4']:""; ?>"  maxlength="20" name="clevage_time_4"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_4'])?$select_result['frag_0_4']:""; ?>"  maxlength="20" name="frag_0_4"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_4'])?$select_result['cell_1_4']:""; ?>"  maxlength="20" name="cell_1_4"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_4'])?$select_result['grade_1_4']:""; ?>"  maxlength="20" name="grade_1_4"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_4'])?$select_result['frag_1_4']:""; ?>"  maxlength="20" name="frag_1_4"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_4'])?$select_result['stage_4']:""; ?>"  maxlength="20" name="stage_4"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_4'])?$select_result['grade_2_4']:""; ?>"  maxlength="20" name="grade_2_4"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_4'])?$select_result['frag_2_4']:""; ?>"  maxlength="20" name="frag_2_4"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_4'])?$select_result['date_0_4']:""; ?>"  name="date_0_4"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_4'])?$select_result['media_0_4']:""; ?>"  maxlength="20" name="media_0_4"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_4'])?$select_result['container_no_0_4']:""; ?>"  maxlength="20" name="container_no_0_4"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_4'])?$select_result['straw_no_4']:""; ?>"  min="0" name="straw_no_4"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_4'])?$select_result['color_4']:""; ?>"  maxlength="20" name="color_4"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_4'])?$select_result['embryos_frozen_0_4']:""; ?>"  min="0" name="embryos_frozen_0_4"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_4'])?$select_result['storage_renewal_dt_4']:""; ?>"  name="storage_renewal_dt_4"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_4'])?$select_result['date_1_4']:""; ?>"  name="date_1_4"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_4'])?$select_result['purpose_0_4']:""; ?>"  maxlength="20" name="purpose_0_4"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_4'])?$select_result['media_1_4']:""; ?>"  maxlength="20" name="media_1_4"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_4'])?$select_result['no_embryo_thawed_4']:""; ?>"  min="0" name="no_embryo_thawed_4"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_4'])?$select_result['thawing_path_4']:""; ?>"  maxlength="20" name="thawing_path_4"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_4'])?$select_result['no_embryo_recovered_4']:""; ?>"  min="0" name="no_embryo_recovered_4"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_4'])?$select_result['date_2_4']:""; ?>"  name="date_2_4"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_4'])?$select_result['reason_4']:""; ?>"  maxlength="20" name="reason_4"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_4'])?$select_result['empty_0_4']:""; ?>"  maxlength="20" name="empty_0_4"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_4'])?$select_result['empty_1_4']:""; ?>"  maxlength="20" name="empty_1_4"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_5'])?$select_result['no_5']:""; ?>"  min="0" name="no_5">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        

<input type="radio" name="egg_quality_0_5" value="M2" <?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_5" value="M1" <?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_5" value="GV" <?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_5" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	
		


								 </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_5'])?$select_result['comment_0_5']:""; ?>"  name="comment_0_5"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_5'])?$select_result['pn1_0_5']:""; ?>"  min="0" name="pn1_0_5"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_5'])?$select_result['pn2_0_5']:""; ?>"  min="0" name="pn2_0_5"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_5'])?$select_result['pn3_0_5']:""; ?>"  min="0" name="pn3_0_5"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_5'])?$select_result['degenerate_5']:""; ?>"  min="0" name="degenerate_5"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_5'])?$select_result['pb2_5']:""; ?>"  min="0" name="pb2_5"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_5'])?$select_result['comments_5']:""; ?>"  maxlength="20" name="comments_5"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_5'])?$select_result['cell_0_5']:""; ?>"  maxlength="20" name="cell_0_5"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_5'])?$select_result['grade_0_5']:""; ?>"  maxlength="20" name="grade_0_5"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_5'])?$select_result['clevage_time_5']:""; ?>"  maxlength="20" name="clevage_time_5"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_5'])?$select_result['frag_0_5']:""; ?>"  maxlength="20" name="frag_0_5"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_5'])?$select_result['cell_1_5']:""; ?>"  maxlength="20" name="cell_1_5"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_5'])?$select_result['grade_1_5']:""; ?>"  maxlength="20" name="grade_1_5"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_5'])?$select_result['frag_1_5']:""; ?>"  maxlength="20" name="frag_1_5"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_5'])?$select_result['stage_5']:""; ?>"  maxlength="20" name="stage_5"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_5'])?$select_result['grade_2_5']:""; ?>"  maxlength="20" name="grade_2_5"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_5'])?$select_result['frag_2_5']:""; ?>"  maxlength="20" name="frag_2_5"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_5'])?$select_result['date_0_5']:""; ?>"  name="date_0_5"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_5'])?$select_result['media_0_5']:""; ?>"  maxlength="20" name="media_0_5"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_5'])?$select_result['container_no_0_5']:""; ?>"  maxlength="20" name="container_no_0_5"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_5'])?$select_result['straw_no_5']:""; ?>"  min="0" name="straw_no_5"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_5'])?$select_result['color_5']:""; ?>"  maxlength="20" name="color_5"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_5'])?$select_result['embryos_frozen_0_5']:""; ?>"  min="0" name="embryos_frozen_0_5"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_5'])?$select_result['storage_renewal_dt_5']:""; ?>"  name="storage_renewal_dt_5"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_5'])?$select_result['date_1_5']:""; ?>"  name="date_1_5"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_5'])?$select_result['purpose_0_5']:""; ?>"  maxlength="20" name="purpose_0_5"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_5'])?$select_result['media_1_5']:""; ?>"  maxlength="20" name="media_1_5"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_5'])?$select_result['no_embryo_thawed_5']:""; ?>"  min="0" name="no_embryo_thawed_5"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_5'])?$select_result['thawing_path_5']:""; ?>"  maxlength="20" name="thawing_path_5"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_5'])?$select_result['no_embryo_recovered_5']:""; ?>"  min="0" name="no_embryo_recovered_5"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_5'])?$select_result['date_2_5']:""; ?>"  name="date_2_5"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_5'])?$select_result['reason_5']:""; ?>"  maxlength="20" name="reason_5"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_5'])?$select_result['empty_0_5']:""; ?>"  maxlength="20" name="empty_0_5"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_5'])?$select_result['empty_1_5']:""; ?>"  maxlength="20" name="empty_1_5"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_6'])?$select_result['no_6']:""; ?>"  min="0" name="no_6">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	<input type="radio"  name="egg_quality_0_6" value="M2" <?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
							        	<input type="radio"  name="egg_quality_0_6" value="M1" <?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
							        	<input type="radio"  name="egg_quality_0_6" value="GV" <?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
							        	<input type="radio"  name="egg_quality_0_6" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_6'])?$select_result['comment_0_6']:""; ?>"  name="comment_0_6"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_6'])?$select_result['pn1_0_6']:""; ?>"  min="0" name="pn1_0_6"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_6'])?$select_result['pn2_0_6']:""; ?>"  min="0" name="pn2_0_6"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_6'])?$select_result['pn3_0_6']:""; ?>"  min="0" name="pn3_0_6"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_6'])?$select_result['degenerate_6']:""; ?>"  min="0" name="degenerate_6"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_6'])?$select_result['pb2_6']:""; ?>"  min="0" name="pb2_6"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_6'])?$select_result['comments_6']:""; ?>"  maxlength="20" name="comments_6"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_6'])?$select_result['cell_0_6']:""; ?>"  maxlength="20" name="cell_0_6"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_6'])?$select_result['grade_0_6']:""; ?>"  maxlength="20" name="grade_0_6"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_6'])?$select_result['clevage_time_6']:""; ?>"  maxlength="20" name="clevage_time_6"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_6'])?$select_result['frag_0_6']:""; ?>"  maxlength="20" name="frag_0_6"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_6'])?$select_result['cell_1_6']:""; ?>"  maxlength="20" name="cell_1_6"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_6'])?$select_result['grade_1_6']:""; ?>"  maxlength="20" name="grade_1_6"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_6'])?$select_result['frag_1_6']:""; ?>"  maxlength="20" name="frag_1_6"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_6'])?$select_result['stage_6']:""; ?>"  maxlength="20" name="stage_6"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_6'])?$select_result['grade_2_6']:""; ?>"  maxlength="20" name="grade_2_6"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_6'])?$select_result['frag_2_6']:""; ?>"  maxlength="20" name="frag_2_6"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_6'])?$select_result['date_0_6']:""; ?>"  name="date_0_6"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_6'])?$select_result['media_0_6']:""; ?>"  maxlength="20" name="media_0_6"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_6'])?$select_result['container_no_0_6']:""; ?>"  maxlength="20" name="container_no_0_6"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_6'])?$select_result['straw_no_6']:""; ?>"  min="0" name="straw_no_6"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_6'])?$select_result['color_6']:""; ?>"  maxlength="20" name="color_6"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_6'])?$select_result['embryos_frozen_0_6']:""; ?>"  min="0" name="embryos_frozen_0_6"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_6'])?$select_result['storage_renewal_dt_6']:""; ?>"  name="storage_renewal_dt_6"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_6'])?$select_result['date_1_6']:""; ?>"  name="date_1_6"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_6'])?$select_result['purpose_0_6']:""; ?>"  maxlength="20" name="purpose_0_6"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_6'])?$select_result['media_1_6']:""; ?>"  maxlength="20" name="media_1_6"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_6'])?$select_result['no_embryo_thawed_6']:""; ?>"  min="0" name="no_embryo_thawed_6"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_6'])?$select_result['thawing_path_6']:""; ?>"  maxlength="20" name="thawing_path_6"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_6'])?$select_result['no_embryo_recovered_6']:""; ?>"  min="0" name="no_embryo_recovered_6"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_6'])?$select_result['date_2_6']:""; ?>"  name="date_2_6"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_6'])?$select_result['reason_6']:""; ?>"  maxlength="20" name="reason_6"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_6'])?$select_result['empty_0_6']:""; ?>"  maxlength="20" name="empty_0_6"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_6'])?$select_result['empty_1_6']:""; ?>"  maxlength="20" name="empty_1_6"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_7'])?$select_result['no_7']:""; ?>"  min="0" name="no_7">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	<input type="radio"  name="egg_quality_0_7" value="M2" <?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
							        	<input type="radio"  name="egg_quality_0_7" value="M1" <?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
							        	<input type="radio"  name="egg_quality_0_7" value="GV" <?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
							        	<input type="radio"  name="egg_quality_0_7" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_7'])?$select_result['comment_0_7']:""; ?>"  name="comment_0_7"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_7'])?$select_result['pn1_0_7']:""; ?>"  min="0" name="pn1_0_7"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_7'])?$select_result['pn2_0_7']:""; ?>"  min="0" name="pn2_0_7"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_7'])?$select_result['pn3_0_7']:""; ?>"  min="0" name="pn3_0_7"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_7'])?$select_result['degenerate_7']:""; ?>"  min="0" name="degenerate_7"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_7'])?$select_result['pb2_7']:""; ?>"  min="0" name="pb2_7"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_7'])?$select_result['comments_7']:""; ?>"  maxlength="20" name="comments_7"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_7'])?$select_result['cell_0_7']:""; ?>"  maxlength="20" name="cell_0_7"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_7'])?$select_result['grade_0_7']:""; ?>"  maxlength="20" name="grade_0_7"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_7'])?$select_result['clevage_time_7']:""; ?>"  maxlength="20" name="clevage_time_7"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_7'])?$select_result['frag_0_7']:""; ?>"  maxlength="20" name="frag_0_7"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_7'])?$select_result['cell_1_7']:""; ?>"  maxlength="20" name="cell_1_7"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_7'])?$select_result['grade_1_7']:""; ?>"  maxlength="20" name="grade_1_7"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_7'])?$select_result['frag_1_7']:""; ?>"  maxlength="20" name="frag_1_7"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_7'])?$select_result['stage_7']:""; ?>"  maxlength="20" name="stage_7"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_7'])?$select_result['grade_2_7']:""; ?>"  maxlength="20" name="grade_2_7"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_7'])?$select_result['frag_2_7']:""; ?>"  maxlength="20" name="frag_2_7"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_7'])?$select_result['date_0_7']:""; ?>"  name="date_0_7"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_7'])?$select_result['media_0_7']:""; ?>"  maxlength="20" name="media_0_7"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_7'])?$select_result['container_no_0_7']:""; ?>"  maxlength="20" name="container_no_0_7"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_7'])?$select_result['straw_no_7']:""; ?>"  min="0" name="straw_no_7"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_7'])?$select_result['color_7']:""; ?>"  maxlength="20" name="color_7"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_7'])?$select_result['embryos_frozen_0_7']:""; ?>"  min="0" name="embryos_frozen_0_7"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_7'])?$select_result['storage_renewal_dt_7']:""; ?>"  name="storage_renewal_dt_7"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_7'])?$select_result['date_1_7']:""; ?>"  name="date_1_7"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_7'])?$select_result['purpose_0_7']:""; ?>"  maxlength="20" name="purpose_0_7"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_7'])?$select_result['media_1_7']:""; ?>"  maxlength="20" name="media_1_7"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_7'])?$select_result['no_embryo_thawed_7']:""; ?>"  min="0" name="no_embryo_thawed_7"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_7'])?$select_result['thawing_path_7']:""; ?>"  maxlength="20" name="thawing_path_7"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_7'])?$select_result['no_embryo_recovered_7']:""; ?>"  min="0" name="no_embryo_recovered_7"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_7'])?$select_result['date_2_7']:""; ?>"  name="date_2_7"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_7'])?$select_result['reason_7']:""; ?>"  maxlength="20" name="reason_7"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_7'])?$select_result['empty_0_7']:""; ?>"  maxlength="20" name="empty_0_7"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_7'])?$select_result['empty_1_7']:""; ?>"  maxlength="20" name="empty_1_7"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_8'])?$select_result['no_8']:""; ?>"  min="0" name="no_8">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	
										
							<input type="radio" name="egg_quality_0_8" value="M2" <?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_8" value="M1" <?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_8" value="GV" <?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_8" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	


								   </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_8'])?$select_result['comment_0_8']:""; ?>"  name="comment_0_8"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_8'])?$select_result['pn1_0_8']:""; ?>"  min="0" name="pn1_0_8"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_8'])?$select_result['pn2_0_8']:""; ?>"  min="0" name="pn2_0_8"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_8'])?$select_result['pn3_0_8']:""; ?>"  min="0" name="pn3_0_8"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_8'])?$select_result['degenerate_8']:""; ?>"  min="0" name="degenerate_8"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_8'])?$select_result['pb2_8']:""; ?>"  min="0" name="pb2_8"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_8'])?$select_result['comments_8']:""; ?>"  maxlength="20" name="comments_8"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_8'])?$select_result['cell_0_8']:""; ?>"  maxlength="20" name="cell_0_8"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_8'])?$select_result['grade_0_8']:""; ?>"  maxlength="20" name="grade_0_8"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_8'])?$select_result['clevage_time_8']:""; ?>"  maxlength="20" name="clevage_time_8"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_8'])?$select_result['frag_0_8']:""; ?>"  maxlength="20" name="frag_0_8"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_8'])?$select_result['cell_1_8']:""; ?>"  maxlength="20" name="cell_1_8"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_8'])?$select_result['grade_1_8']:""; ?>"  maxlength="20" name="grade_1_8"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_8'])?$select_result['frag_1_8']:""; ?>"  maxlength="20" name="frag_1_8"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_8'])?$select_result['stage_8']:""; ?>"  maxlength="20" name="stage_8"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_8'])?$select_result['grade_2_8']:""; ?>"  maxlength="20" name="grade_2_8"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_8'])?$select_result['frag_2_8']:""; ?>"  maxlength="20" name="frag_2_8"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_8'])?$select_result['date_0_8']:""; ?>"  name="date_0_8"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_8'])?$select_result['media_0_8']:""; ?>"  maxlength="20" name="media_0_8"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_8'])?$select_result['container_no_0_8']:""; ?>"  maxlength="20" name="container_no_0_8"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_8'])?$select_result['straw_no_8']:""; ?>"  min="0" name="straw_no_8"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_8'])?$select_result['color_8']:""; ?>"  maxlength="20" name="color_8"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_8'])?$select_result['embryos_frozen_0_8']:""; ?>"  min="0" name="embryos_frozen_0_8"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_8'])?$select_result['storage_renewal_dt_8']:""; ?>"  name="storage_renewal_dt_8"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_8'])?$select_result['date_1_8']:""; ?>"  name="date_1_8"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_8'])?$select_result['purpose_0_8']:""; ?>"  maxlength="20" name="purpose_0_8"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_8'])?$select_result['media_1_8']:""; ?>"  maxlength="20" name="media_1_8"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_8'])?$select_result['no_embryo_thawed_8']:""; ?>"  min="0" name="no_embryo_thawed_8"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_8'])?$select_result['thawing_path_8']:""; ?>"  maxlength="20" name="thawing_path_8"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_8'])?$select_result['no_embryo_recovered_8']:""; ?>"  min="0" name="no_embryo_recovered_8"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_8'])?$select_result['date_2_8']:""; ?>"  name="date_2_8"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_8'])?$select_result['reason_8']:""; ?>"  maxlength="20" name="reason_8"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_8'])?$select_result['empty_0_8']:""; ?>"  maxlength="20" name="empty_0_8"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_8'])?$select_result['empty_1_8']:""; ?>"  maxlength="20" name="empty_1_8"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_9'])?$select_result['no_9']:""; ?>"  min="0" name="no_9">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	
									<input type="radio" name="egg_quality_0_9" value="M2" <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_9" value="M1" <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_9" value="GV" <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_9" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	
										
										
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_9'])?$select_result['comment_0_9']:""; ?>"  name="comment_0_9"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_9'])?$select_result['pn1_0_9']:""; ?>"  min="0" name="pn1_0_9"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_9'])?$select_result['pn2_0_9']:""; ?>"  min="0" name="pn2_0_9"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_9'])?$select_result['pn3_0_9']:""; ?>"  min="0" name="pn3_0_9"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_9'])?$select_result['degenerate_9']:""; ?>"  min="0" name="degenerate_9"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_9'])?$select_result['pb2_9']:""; ?>"  min="0" name="pb2_9"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_9'])?$select_result['comments_9']:""; ?>"  maxlength="20" name="comments_9"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_9'])?$select_result['cell_0_9']:""; ?>"  maxlength="20" name="cell_0_9"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_9'])?$select_result['grade_0_9']:""; ?>"  maxlength="20" name="grade_0_9"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_9'])?$select_result['clevage_time_9']:""; ?>"  maxlength="20" name="clevage_time_9"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_9'])?$select_result['frag_0_9']:""; ?>"  maxlength="20" name="frag_0_9"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_9'])?$select_result['cell_1_9']:""; ?>"  maxlength="20" name="cell_1_9"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_9'])?$select_result['grade_1_9']:""; ?>"  maxlength="20" name="grade_1_9"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_9'])?$select_result['frag_1_9']:""; ?>"  maxlength="20" name="frag_1_9"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_9'])?$select_result['stage_9']:""; ?>"  maxlength="20" name="stage_9"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_9'])?$select_result['grade_2_9']:""; ?>"  maxlength="20" name="grade_2_9"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_9'])?$select_result['frag_2_9']:""; ?>"  maxlength="20" name="frag_2_9"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_9'])?$select_result['date_0_9']:""; ?>"  name="date_0_9"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_9'])?$select_result['media_0_9']:""; ?>"  maxlength="20" name="media_0_9"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_9'])?$select_result['container_no_0_9']:""; ?>"  maxlength="20" name="container_no_0_9"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_9'])?$select_result['straw_no_9']:""; ?>"  min="0" name="straw_no_9"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_9'])?$select_result['color_9']:""; ?>"  maxlength="20" name="color_9"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_9'])?$select_result['embryos_frozen_0_9']:""; ?>"  min="0" name="embryos_frozen_0_9"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_9'])?$select_result['storage_renewal_dt_9']:""; ?>"  name="storage_renewal_dt_9"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_9'])?$select_result['date_1_9']:""; ?>"  name="date_1_9"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_9'])?$select_result['purpose_0_9']:""; ?>"  maxlength="20" name="purpose_0_9"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_9'])?$select_result['media_1_9']:""; ?>"  maxlength="20" name="media_1_9"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_9'])?$select_result['no_embryo_thawed_9']:""; ?>"  min="0" name="no_embryo_thawed_9"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_9'])?$select_result['thawing_path_9']:""; ?>"  maxlength="20" name="thawing_path_9"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_9'])?$select_result['no_embryo_recovered_9']:""; ?>"  min="0" name="no_embryo_recovered_9"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_9'])?$select_result['date_2_9']:""; ?>"  name="date_2_9" ></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_9'])?$select_result['reason_9']:""; ?>"  maxlength="20" name="reason_9"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_9'])?$select_result['empty_0_9']:""; ?>"  maxlength="20" name="empty_0_9"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_9'])?$select_result['empty_1_9']:""; ?>"  maxlength="20" name="empty_1_9"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_10'])?$select_result['no_10']:""; ?>"  min="0" name="no_10">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							    

<input type="radio" name="egg_quality_0_10" value="M2" <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_10" value="M1" <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_10" value="GV" <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_10" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	


							   </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_10'])?$select_result['comment_0_10']:""; ?>"  name="comment_0_10"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_10'])?$select_result['pn1_0_10']:""; ?>"  min="0" name="pn1_0_10"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_10'])?$select_result['pn2_0_10']:""; ?>"  min="0" name="pn2_0_10"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_10'])?$select_result['pn3_0_10']:""; ?>"  min="0" name="pn3_0_10"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_10'])?$select_result['degenerate_10']:""; ?>"  min="0" name="degenerate_10"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_10'])?$select_result['pb2_10']:""; ?>"  min="0" name="pb2_10"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_10'])?$select_result['comments_10']:""; ?>"  maxlength="20" name="comments_10"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_10'])?$select_result['cell_0_10']:""; ?>"  maxlength="20" name="cell_0_10"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_10'])?$select_result['grade_0_10']:""; ?>"  maxlength="20" name="grade_0_10"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_10'])?$select_result['clevage_time_10']:""; ?>"  maxlength="20" name="clevage_time_10"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_10'])?$select_result['frag_0_10']:""; ?>"  maxlength="20" name="frag_0_10"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_10'])?$select_result['cell_1_10']:""; ?>"  maxlength="20" name="cell_1_10"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_10'])?$select_result['grade_1_10']:""; ?>"  maxlength="20" name="grade_1_10"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_10'])?$select_result['frag_1_10']:""; ?>"  maxlength="20" name="frag_1_10"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_10'])?$select_result['stage_10']:""; ?>"  maxlength="20" name="stage_10"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_10'])?$select_result['grade_2_10']:""; ?>"  maxlength="20" name="grade_2_10"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_10'])?$select_result['frag_2_10']:""; ?>"  maxlength="20" name="frag_2_10"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_10'])?$select_result['date_0_10']:""; ?>"  name="date_0_10"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_10'])?$select_result['media_0_10']:""; ?>"  maxlength="20" name="media_0_10"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_10'])?$select_result['container_no_0_10']:""; ?>"  maxlength="20" name="container_no_0_10"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_10'])?$select_result['straw_no_10']:""; ?>"  min="0" name="straw_no_10"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_10'])?$select_result['color_10']:""; ?>"  maxlength="20" name="color_10"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_10'])?$select_result['embryos_frozen_0_10']:""; ?>"  min="0" name="embryos_frozen_0_10"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_10'])?$select_result['storage_renewal_dt_10']:""; ?>"  name="storage_renewal_dt_10"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_10'])?$select_result['date_1_10']:""; ?>"  name="date_1_10"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_10'])?$select_result['purpose_0_10']:""; ?>"  maxlength="20" name="purpose_0_10"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_10'])?$select_result['media_1_10']:""; ?>"  maxlength="20" name="media_1_10"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_10'])?$select_result['no_embryo_thawed_10']:""; ?>"  min="0" name="no_embryo_thawed_10"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_10'])?$select_result['thawing_path_10']:""; ?>"  maxlength="20" name="thawing_path_10"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_10'])?$select_result['no_embryo_recovered_10']:""; ?>"  min="0" name="no_embryo_recovered_10"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_10'])?$select_result['date_2_10']:""; ?>"  name="date_2_10"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_10'])?$select_result['reason_10']:""; ?>"  maxlength="20" name="reason_10"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_10'])?$select_result['empty_0_10']:""; ?>"  maxlength="20" name="empty_0_10"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_10'])?$select_result['empty_1_10']:""; ?>"  maxlength="20" name="empty_1_10"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_11'])?$select_result['no_11']:""; ?>"  min="0" name="no_11">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        
<input type="radio" name="egg_quality_0_11" value="M2" <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_11" value="M1" <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_11" value="GV" <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_11" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	


								   </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_11'])?$select_result['comment_0_11']:""; ?>"  name="comment_0_11"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_11'])?$select_result['pn1_0_11']:""; ?>"  min="0" name="pn1_0_11"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_11'])?$select_result['pn2_0_11']:""; ?>"  min="0" name="pn2_0_11"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_11'])?$select_result['pn3_0_11']:""; ?>"  min="0" name="pn3_0_11"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_11'])?$select_result['degenerate_11']:""; ?>"  min="0" name="degenerate_11"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_11'])?$select_result['pb2_11']:""; ?>"  min="0" name="pb2_11"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_11'])?$select_result['comments_11']:""; ?>"  maxlength="20" name="comments_11"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_11'])?$select_result['cell_0_11']:""; ?>"  maxlength="20" name="cell_0_11"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_11'])?$select_result['grade_0_11']:""; ?>"  maxlength="20" name="grade_0_11"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_11'])?$select_result['clevage_time_11']:""; ?>"  maxlength="20" name="clevage_time_11"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_11'])?$select_result['frag_0_11']:""; ?>"  maxlength="20" name="frag_0_11"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_11'])?$select_result['cell_1_11']:""; ?>"  maxlength="20" name="cell_1_11"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_11'])?$select_result['grade_1_11']:""; ?>"  maxlength="20" name="grade_1_11"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_11'])?$select_result['frag_1_11']:""; ?>"  maxlength="20" name="frag_1_11"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_11'])?$select_result['stage_11']:""; ?>"  maxlength="20" name="stage_11"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_11'])?$select_result['grade_2_11']:""; ?>"  maxlength="20" name="grade_2_11"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_11'])?$select_result['frag_2_11']:""; ?>"  maxlength="20" name="frag_2_11"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_11'])?$select_result['date_0_11']:""; ?>"  name="date_0_11"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_11'])?$select_result['media_0_11']:""; ?>"  maxlength="20" name="media_0_11"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_11'])?$select_result['container_no_0_11']:""; ?>"  maxlength="20" name="container_no_0_11"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_11'])?$select_result['straw_no_11']:""; ?>"  min="0" name="straw_no_11"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_11'])?$select_result['color_11']:""; ?>"  maxlength="20" name="color_11"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_11'])?$select_result['embryos_frozen_0_11']:""; ?>"  min="0" name="embryos_frozen_0_11"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_11'])?$select_result['storage_renewal_dt_11']:""; ?>"  name="storage_renewal_dt_11"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_11'])?$select_result['date_1_11']:""; ?>"  name="date_1_11"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_11'])?$select_result['purpose_0_11']:""; ?>"  maxlength="20" name="purpose_0_11"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_11'])?$select_result['media_1_11']:""; ?>"  maxlength="20" name="media_1_11"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_11'])?$select_result['no_embryo_thawed_11']:""; ?>"  min="0" name="no_embryo_thawed_11"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_11'])?$select_result['thawing_path_11']:""; ?>"  maxlength="20" name="thawing_path_11"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_11'])?$select_result['no_embryo_recovered_11']:""; ?>"  min="0" name="no_embryo_recovered_11"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_11'])?$select_result['date_2_11']:""; ?>"  name="date_2_11"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_11'])?$select_result['reason_11']:""; ?>"  maxlength="20" name="reason_11"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_11'])?$select_result['empty_0_11']:""; ?>"  maxlength="20" name="empty_0_11"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_11'])?$select_result['empty_1_11']:""; ?>"  maxlength="20" name="empty_1_11"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_12'])?$select_result['no_12']:""; ?>"  min="0" name="no_12">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
	<input type="radio" name="egg_quality_0_12" value="M2" <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_12" value="M1" <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_12" value="GV" <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_12" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	

								</td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_12'])?$select_result['comment_0_12']:""; ?>"  name="comment_0_12"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_12'])?$select_result['pn1_0_12']:""; ?>"  min="0" name="pn1_0_12"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_12'])?$select_result['pn2_0_12']:""; ?>"  min="0" name="pn2_0_12"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_12'])?$select_result['pn3_0_12']:""; ?>"  min="0" name="pn3_0_12"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_12'])?$select_result['degenerate_12']:""; ?>"  min="0" name="degenerate_12"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_12'])?$select_result['pb2_12']:""; ?>"  min="0" name="pb2_12"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_12'])?$select_result['comments_12']:""; ?>"  maxlength="20" name="comments_12"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_12'])?$select_result['cell_0_12']:""; ?>"  maxlength="20" name="cell_0_12"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_12'])?$select_result['grade_0_12']:""; ?>"  maxlength="20" name="grade_0_12"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_12'])?$select_result['clevage_time_12']:""; ?>"  maxlength="20" name="clevage_time_12"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_12'])?$select_result['frag_0_12']:""; ?>"  maxlength="20" name="frag_0_12"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_12'])?$select_result['cell_1_12']:""; ?>"  maxlength="20" name="cell_1_12"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_12'])?$select_result['grade_1_12']:""; ?>"  maxlength="20" name="grade_1_12"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_12'])?$select_result['frag_1_12']:""; ?>"  maxlength="20" name="frag_1_12"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_12'])?$select_result['stage_12']:""; ?>"  maxlength="20" name="stage_12"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_12'])?$select_result['grade_2_12']:""; ?>"  maxlength="20" name="grade_2_12"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_12'])?$select_result['frag_2_12']:""; ?>"  maxlength="20" name="frag_2_12"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_12'])?$select_result['date_0_12']:""; ?>"  name="date_0_12"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_12'])?$select_result['media_0_12']:""; ?>"  maxlength="20" name="media_0_12"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_12'])?$select_result['container_no_0_12']:""; ?>"  maxlength="20" name="container_no_0_12"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_12'])?$select_result['straw_no_12']:""; ?>"  min="0" name="straw_no_12"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_12'])?$select_result['color_12']:""; ?>"  maxlength="20" name="color_12"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_12'])?$select_result['embryos_frozen_0_12']:""; ?>"  min="0" name="embryos_frozen_0_12"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_12'])?$select_result['storage_renewal_dt_12']:""; ?>"  name="storage_renewal_dt_12"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_12'])?$select_result['date_1_12']:""; ?>"  name="date_1_12"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_12'])?$select_result['purpose_0_12']:""; ?>"  maxlength="20" name="purpose_0_12"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_12'])?$select_result['media_1_12']:""; ?>"  maxlength="20" name="media_1_12"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_12'])?$select_result['no_embryo_thawed_12']:""; ?>"  min="0" name="no_embryo_thawed_12"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_12'])?$select_result['thawing_path_12']:""; ?>"  maxlength="20" name="thawing_path_12"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_12'])?$select_result['no_embryo_recovered_12']:""; ?>"  min="0" name="no_embryo_recovered_12"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_12'])?$select_result['date_2_12']:""; ?>"  name="date_2_12"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_12'])?$select_result['reason_12']:""; ?>"  maxlength="20" name="reason_12"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_12'])?$select_result['empty_0_12']:""; ?>"  maxlength="20" name="empty_0_12"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_12'])?$select_result['empty_1_12']:""; ?>"  maxlength="20" name="empty_1_12"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_13'])?$select_result['no_13']:""; ?>"  min="0" name="no_13">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	
<input type="radio" name="egg_quality_0_13" value="M2" <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_13" value="M1" <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_13" value="GV" <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_13" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	




								 </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_13'])?$select_result['comment_0_13']:""; ?>"  name="comment_0_13"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_13'])?$select_result['pn1_0_13']:""; ?>"  min="0" name="pn1_0_13"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_13'])?$select_result['pn2_0_13']:""; ?>"  min="0" name="pn2_0_13"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_13'])?$select_result['pn3_0_13']:""; ?>"  min="0" name="pn3_0_13"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_13'])?$select_result['degenerate_13']:""; ?>"  min="0" name="degenerate_13"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_13'])?$select_result['pb2_13']:""; ?>"  min="0" name="pb2_13"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_13'])?$select_result['comments_13']:""; ?>"  maxlength="20" name="comments_13"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_13'])?$select_result['cell_0_13']:""; ?>"  maxlength="20" name="cell_0_13"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_13'])?$select_result['grade_0_13']:""; ?>"  maxlength="20" name="grade_0_13"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_13'])?$select_result['clevage_time_13']:""; ?>"  maxlength="20" name="clevage_time_13"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_13'])?$select_result['frag_0_13']:""; ?>"  maxlength="20" name="frag_0_13"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_13'])?$select_result['cell_1_13']:""; ?>"  maxlength="20" name="cell_1_13"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_13'])?$select_result['grade_1_13']:""; ?>"  maxlength="20" name="grade_1_13"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_13'])?$select_result['frag_1_13']:""; ?>"  maxlength="20" name="frag_1_13"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_13'])?$select_result['stage_13']:""; ?>"  maxlength="20" name="stage_13"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_13'])?$select_result['grade_2_13']:""; ?>"  maxlength="20" name="grade_2_13"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_13'])?$select_result['frag_2_13']:""; ?>"  maxlength="20" name="frag_2_13"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_13'])?$select_result['date_0_13']:""; ?>"  name="date_0_13"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_13'])?$select_result['media_0_13']:""; ?>"  maxlength="20" name="media_0_13"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_13'])?$select_result['container_no_0_13']:""; ?>"  maxlength="20" name="container_no_0_13"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_13'])?$select_result['straw_no_13']:""; ?>"  min="0" name="straw_no_13"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_13'])?$select_result['color_13']:""; ?>"  maxlength="20" name="color_13"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_13'])?$select_result['embryos_frozen_0_13']:""; ?>"  min="0" name="embryos_frozen_0_13"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_13'])?$select_result['storage_renewal_dt_13']:""; ?>"  name="storage_renewal_dt_13"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_13'])?$select_result['date_1_13']:""; ?>"  name="date_1_13"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_13'])?$select_result['purpose_0_13']:""; ?>"  maxlength="20" name="purpose_0_13"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_13'])?$select_result['media_1_13']:""; ?>"  maxlength="20" name="media_1_13"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_13'])?$select_result['no_embryo_thawed_13']:""; ?>"  min="0" name="no_embryo_thawed_13"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_13'])?$select_result['thawing_path_13']:""; ?>"  maxlength="20" name="thawing_path_13"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_13'])?$select_result['no_embryo_recovered_13']:""; ?>"  min="0" name="no_embryo_recovered_13"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_13'])?$select_result['date_2_13']:""; ?>"  name="date_2_13"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_13'])?$select_result['reason_13']:""; ?>"  maxlength="20" name="reason_13"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_13'])?$select_result['empty_0_13']:""; ?>"  maxlength="20" name="empty_0_13"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_13'])?$select_result['empty_1_13']:""; ?>"  maxlength="20" name="empty_1_13"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_14'])?$select_result['no_14']:""; ?>"  min="0" name="no_14">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        	<input type="radio"  name="egg_quality_0_14" value="M2" <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
							        	<input type="radio"  name="egg_quality_0_14" value="M1" <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
							        	<input type="radio"  name="egg_quality_0_14" value="GV" <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
							        	<input type="radio"  name="egg_quality_0_14" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_14'])?$select_result['comment_0_14']:""; ?>"  name="comment_0_14"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_14'])?$select_result['pn1_0_14']:""; ?>"  min="0" name="pn1_0_14"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_14'])?$select_result['pn2_0_14']:""; ?>"  min="0" name="pn2_0_14"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_14'])?$select_result['pn3_0_14']:""; ?>"  min="0" name="pn3_0_14"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_14'])?$select_result['degenerate_14']:""; ?>"  min="0" name="degenerate_14"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_14'])?$select_result['pb2_14']:""; ?>"  min="0" name="pb2_14"  ></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_14'])?$select_result['comments_14']:""; ?>"  maxlength="20" name="comments_14"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_14'])?$select_result['cell_0_14']:""; ?>"  maxlength="20" name="cell_0_14"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_14'])?$select_result['grade_0_14']:""; ?>"  maxlength="20" name="grade_0_14"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_14'])?$select_result['clevage_time_14']:""; ?>"  maxlength="20" name="clevage_time_14"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_14'])?$select_result['frag_0_14']:""; ?>"  maxlength="20" name="frag_0_14"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_14'])?$select_result['cell_1_14']:""; ?>"  maxlength="20" name="cell_1_14"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_14'])?$select_result['grade_1_14']:""; ?>"  maxlength="20" name="grade_1_14"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_14'])?$select_result['frag_1_14']:""; ?>"  maxlength="20" name="frag_1_14"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_14'])?$select_result['stage_14']:""; ?>"  maxlength="20" name="stage_14"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_14'])?$select_result['grade_2_14']:""; ?>"  maxlength="20" name="grade_2_14"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_14'])?$select_result['frag_2_14']:""; ?>"  maxlength="20" name="frag_2_14"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_14'])?$select_result['date_0_14']:""; ?>"  name="date_0_14"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_14'])?$select_result['media_0_14']:""; ?>"  maxlength="20" name="media_0_14"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_14'])?$select_result['container_no_0_14']:""; ?>"  maxlength="20" name="container_no_0_14"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_14'])?$select_result['straw_no_14']:""; ?>"  min="0" name="straw_no_14"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_14'])?$select_result['color_14']:""; ?>"  maxlength="20" name="color_14"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_14'])?$select_result['embryos_frozen_0_14']:""; ?>"  min="0" name="embryos_frozen_0_14"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_14'])?$select_result['storage_renewal_dt_14']:""; ?>"  name="storage_renewal_dt_14"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_14'])?$select_result['date_1_14']:""; ?>"  name="date_1_14"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_14'])?$select_result['purpose_0_14']:""; ?>"  maxlength="20" name="purpose_0_14"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_14'])?$select_result['media_1_14']:""; ?>"  maxlength="20" name="media_1_14"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_14'])?$select_result['no_embryo_thawed_14']:""; ?>"  min="0" name="no_embryo_thawed_14"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_14'])?$select_result['thawing_path_14']:""; ?>"  maxlength="20" name="thawing_path_14"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_14'])?$select_result['no_embryo_recovered_14']:""; ?>"  min="0" name="no_embryo_recovered_14"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_14'])?$select_result['date_2_14']:""; ?>"  name="date_2_14"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_14'])?$select_result['reason_14']:""; ?>"  maxlength="20" name="reason_14"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_14'])?$select_result['empty_0_14']:""; ?>"  maxlength="20" name="empty_0_14"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_14'])?$select_result['empty_1_14']:""; ?>"  maxlength="20" name="empty_1_14"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_15'])?$select_result['no_15']:""; ?>"  min="0" name="no_15">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        
									
<input type="radio" name="egg_quality_0_15" value="M2" <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_15" value="M1" <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_15" value="GV" <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_15" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	

									
									
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_15'])?$select_result['comment_0_15']:""; ?>"  name="comment_0_15"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_15'])?$select_result['pn1_0_15']:""; ?>"  min="0" name="pn1_0_15"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_15'])?$select_result['pn2_0_15']:""; ?>"  min="0" name="pn2_0_15"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_15'])?$select_result['pn3_0_15']:""; ?>"  min="0" name="pn3_0_15"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_15'])?$select_result['degenerate_15']:""; ?>"  min="0" name="degenerate_15"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_15'])?$select_result['pb2_15']:""; ?>"  min="0" name="pb2_15"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_15'])?$select_result['comments_15']:""; ?>"  maxlength="20" name="comments_15"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_15'])?$select_result['cell_0_15']:""; ?>"  maxlength="20" name="cell_0_15"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_15'])?$select_result['grade_0_15']:""; ?>"  maxlength="20" name="grade_0_15"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_15'])?$select_result['clevage_time_15']:""; ?>"  maxlength="20" name="clevage_time_15"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_15'])?$select_result['frag_0_15']:""; ?>"  maxlength="20" name="frag_0_15"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_15'])?$select_result['cell_1_15']:""; ?>"  maxlength="20" name="cell_1_15"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_15'])?$select_result['grade_1_15']:""; ?>"  maxlength="20" name="grade_1_15"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_15'])?$select_result['frag_1_15']:""; ?>"  maxlength="20" name="frag_1_15"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_15'])?$select_result['stage_15']:""; ?>"  maxlength="20" name="stage_15"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_15'])?$select_result['grade_2_15']:""; ?>"  maxlength="20" name="grade_2_15"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_15'])?$select_result['frag_2_15']:""; ?>"  maxlength="20" name="frag_2_15"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_15'])?$select_result['date_0_15']:""; ?>"  name="date_0_15"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_15'])?$select_result['media_0_15']:""; ?>"  maxlength="20" name="media_0_15"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_15'])?$select_result['container_no_0_15']:""; ?>"  maxlength="20" name="container_no_0_15"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_15'])?$select_result['straw_no_15']:""; ?>"  min="0" name="straw_no_15"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_15'])?$select_result['color_15']:""; ?>"  maxlength="20" name="color_15"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_15'])?$select_result['embryos_frozen_0_15']:""; ?>"  min="0" name="embryos_frozen_0_15"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_15'])?$select_result['storage_renewal_dt_15']:""; ?>"  name="storage_renewal_dt_15"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_15'])?$select_result['date_1_15']:""; ?>"  name="date_1_15"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_15'])?$select_result['purpose_0_15']:""; ?>"  maxlength="20" name="purpose_0_15"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_15'])?$select_result['media_1_15']:""; ?>"  maxlength="20" name="media_1_15"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_15'])?$select_result['no_embryo_thawed_15']:""; ?>"  min="0" name="no_embryo_thawed_15"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_15'])?$select_result['thawing_path_15']:""; ?>"  maxlength="20" name="thawing_path_15"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_15'])?$select_result['no_embryo_recovered_15']:""; ?>"  min="0" name="no_embryo_recovered_15"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_15'])?$select_result['date_2_15']:""; ?>"  name="date_2_15"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_15'])?$select_result['reason_15']:""; ?>"  maxlength="20" name="reason_15"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_15'])?$select_result['empty_0_15']:""; ?>"  maxlength="20" name="empty_0_15"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_15'])?$select_result['empty_1_15']:""; ?>"  maxlength="20" name="empty_1_15"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_16'])?$select_result['no_16']:""; ?>"  min="0" name="no_16">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							    
								
<input type="radio" name="egg_quality_0_16" value="M2" <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_16" value="M1" <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_16" value="GV" <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_16" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	

								
								
							        </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_16'])?$select_result['comment_0_16']:""; ?>"  name="comment_0_16"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_16'])?$select_result['pn1_0_16']:""; ?>"  min="0" name="pn1_0_16"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_16'])?$select_result['pn2_0_16']:""; ?>"  min="0" name="pn2_0_16"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_16'])?$select_result['pn3_0_16']:""; ?>"  min="0" name="pn3_0_16"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_16'])?$select_result['degenerate_16']:""; ?>"  min="0" name="degenerate_16"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_16'])?$select_result['pb2_16']:""; ?>"  min="0" name="pb2_16"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_16'])?$select_result['comments_16']:""; ?>"  maxlength="20" name="comments_16"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_16'])?$select_result['cell_0_16']:""; ?>"  maxlength="20" name="cell_0_16"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_16'])?$select_result['grade_0_16']:""; ?>"  maxlength="20" name="grade_0_16"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_16'])?$select_result['clevage_time_16']:""; ?>"  maxlength="20" name="clevage_time_16"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_16'])?$select_result['frag_0_16']:""; ?>"  maxlength="20" name="frag_0_16"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_16'])?$select_result['cell_1_16']:""; ?>"  maxlength="20" name="cell_1_16"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_16'])?$select_result['grade_1_16']:""; ?>"  maxlength="20" name="grade_1_16"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_16'])?$select_result['frag_1_16']:""; ?>"  maxlength="20" name="frag_1_16"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_16'])?$select_result['stage_16']:""; ?>"  maxlength="20" name="stage_16"   ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_16'])?$select_result['grade_2_16']:""; ?>"  maxlength="20" name="grade_2_16"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_16'])?$select_result['frag_2_16']:""; ?>"  maxlength="20" name="frag_2_16"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_16'])?$select_result['date_0_16']:""; ?>"  name="date_0_16"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_16'])?$select_result['media_0_16']:""; ?>"  maxlength="20" name="media_0_16"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_16'])?$select_result['container_no_0_16']:""; ?>"  maxlength="20" name="container_no_0_16"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_16'])?$select_result['straw_no_16']:""; ?>"  min="0" name="straw_no_16"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_16'])?$select_result['color_16']:""; ?>"  maxlength="20" name="color_16"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_16'])?$select_result['embryos_frozen_0_16']:""; ?>"  min="0" name="embryos_frozen_0_16"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_16'])?$select_result['storage_renewal_dt_16']:""; ?>"  name="storage_renewal_dt_16"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_16'])?$select_result['date_1_16']:""; ?>"  name="date_1_16"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_16'])?$select_result['purpose_0_16']:""; ?>"  maxlength="20" name="purpose_0_16"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_16'])?$select_result['media_1_16']:""; ?>"  maxlength="20" name="media_1_16"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_16'])?$select_result['no_embryo_thawed_16']:""; ?>"  min="0" name="no_embryo_thawed_16"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_16'])?$select_result['thawing_path_16']:""; ?>"  maxlength="20" name="thawing_path_16"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_16'])?$select_result['no_embryo_recovered_16']:""; ?>"  min="0" name="no_embryo_recovered_16"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_16'])?$select_result['date_2_16']:""; ?>"  name="date_2_16"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_16'])?$select_result['reason_16']:""; ?>"  maxlength="20" name="reason_16"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_16'])?$select_result['empty_0_16']:""; ?>"  maxlength="20" name="empty_0_16"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_16'])?$select_result['empty_1_16']:""; ?>"  maxlength="20" name="empty_1_16"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_17'])?$select_result['no_17']:""; ?>"  min="0" name="no_17">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
						
						
<input type="radio" name="egg_quality_0_17" value="M2" <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_17" value="M1" <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_17" value="GV" <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_17" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	





								 </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_17'])?$select_result['comment_0_17']:""; ?>"  name="comment_0_17"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_17'])?$select_result['pn1_0_17']:""; ?>"  min="0" name="pn1_0_17"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_17'])?$select_result['pn2_0_17']:""; ?>"  min="0" name="pn2_0_17"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_17'])?$select_result['pn3_0_17']:""; ?>"  min="0" name="pn3_0_17"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_17'])?$select_result['degenerate_17']:""; ?>"  min="0" name="degenerate_17"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_17'])?$select_result['pb2_17']:""; ?>"  min="0" name="pb2_17"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_17'])?$select_result['comments_17']:""; ?>"  maxlength="20" name="comments_17"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_17'])?$select_result['cell_0_17']:""; ?>"  maxlength="20" name="cell_0_17"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_17'])?$select_result['grade_0_17']:""; ?>"  maxlength="20" name="grade_0_17"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_17'])?$select_result['clevage_time_17']:""; ?>"  maxlength="20" name="clevage_time_17"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_17'])?$select_result['frag_0_17']:""; ?>"  maxlength="20" name="frag_0_17"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_17'])?$select_result['cell_1_17']:""; ?>"  maxlength="20" name="cell_1_17"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_17'])?$select_result['grade_1_17']:""; ?>"  maxlength="20" name="grade_1_17"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_17'])?$select_result['frag_1_17']:""; ?>"  maxlength="20" name="frag_1_17"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_17'])?$select_result['stage_17']:""; ?>"  maxlength="20" name="stage_17"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_17'])?$select_result['grade_2_17']:""; ?>"  maxlength="20" name="grade_2_17"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_17'])?$select_result['frag_2_17']:""; ?>"  maxlength="20" name="frag_2_17"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_17'])?$select_result['date_0_17']:""; ?>"  name="date_0_17"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_17'])?$select_result['media_0_17']:""; ?>"  maxlength="20" name="media_0_17"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_17'])?$select_result['container_no_0_17']:""; ?>"  maxlength="20" name="container_no_0_17"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_17'])?$select_result['straw_no_17']:""; ?>"  min="0" name="straw_no_17"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_17'])?$select_result['color_17']:""; ?>"  maxlength="20" name="color_17"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_17'])?$select_result['embryos_frozen_0_17']:""; ?>"  min="0" name="embryos_frozen_0_17"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_17'])?$select_result['storage_renewal_dt_17']:""; ?>"  name="storage_renewal_dt_17"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_17'])?$select_result['date_1_17']:""; ?>"  name="date_1_17"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_17'])?$select_result['purpose_0_17']:""; ?>"  maxlength="20" name="purpose_0_17"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_17'])?$select_result['media_1_17']:""; ?>"  maxlength="20" name="media_1_17"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_17'])?$select_result['no_embryo_thawed_17']:""; ?>"  min="0" name="no_embryo_thawed_17"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_17'])?$select_result['thawing_path_17']:""; ?>"  maxlength="20" name="thawing_path_17"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_17'])?$select_result['no_embryo_recovered_17']:""; ?>"  min="0" name="no_embryo_recovered_17"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_17'])?$select_result['date_2_17']:""; ?>"  name="date_2_17"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_17'])?$select_result['reason_17']:""; ?>"  maxlength="20" name="reason_17"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_17'])?$select_result['empty_0_17']:""; ?>"  maxlength="20" name="empty_0_17"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_17'])?$select_result['empty_1_17']:""; ?>"  maxlength="20" name="empty_1_17"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_18'])?$select_result['no_18']:""; ?>"  min="0" name="no_18">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
	
<input type="radio" name="egg_quality_0_18" value="M2" <?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_18" value="M1" <?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_18" value="GV" <?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_18" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	




								   </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_18'])?$select_result['comment_0_18']:""; ?>"  name="comment_0_18"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_18'])?$select_result['pn1_0_18']:""; ?>"  min="0" name="pn1_0_18"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_18'])?$select_result['pn2_0_18']:""; ?>"  min="0" name="pn2_0_18"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_18'])?$select_result['pn3_0_18']:""; ?>"  min="0" name="pn3_0_18"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_18'])?$select_result['degenerate_18']:""; ?>"  min="0" name="degenerate_18"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_18'])?$select_result['pb2_18']:""; ?>"  min="0" name="pb2_18"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_18'])?$select_result['comments_18']:""; ?>"  maxlength="20" name="comments_18"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_18'])?$select_result['cell_0_18']:""; ?>"  maxlength="20" name="cell_0_18"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_18'])?$select_result['grade_0_18']:""; ?>"  maxlength="20" name="grade_0_18"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_18'])?$select_result['clevage_time_18']:""; ?>"  maxlength="20" name="clevage_time_18"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_18'])?$select_result['frag_0_18']:""; ?>"  maxlength="20" name="frag_0_18"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_18'])?$select_result['cell_1_18']:""; ?>"  maxlength="20" name="cell_1_18"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_18'])?$select_result['grade_1_18']:""; ?>"  maxlength="20" name="grade_1_18"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_18'])?$select_result['frag_1_18']:""; ?>"  maxlength="20" name="frag_1_18"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_18'])?$select_result['stage_18']:""; ?>"  maxlength="20" name="stage_18"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_18'])?$select_result['grade_2_18']:""; ?>"  maxlength="20" name="grade_2_18"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_18'])?$select_result['frag_2_18']:""; ?>"  maxlength="20" name="frag_2_18"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_18'])?$select_result['date_0_18']:""; ?>"  name="date_0_18"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_18'])?$select_result['media_0_18']:""; ?>"  maxlength="20" name="media_0_18"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_18'])?$select_result['container_no_0_18']:""; ?>"  maxlength="20" name="container_no_0_18"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_18'])?$select_result['straw_no_18']:""; ?>"  min="0" name="straw_no_18"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_18'])?$select_result['color_18']:""; ?>"  maxlength="20" name="color_18"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_18'])?$select_result['embryos_frozen_0_18']:""; ?>"  min="0" name="embryos_frozen_0_18"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_18'])?$select_result['storage_renewal_dt_18']:""; ?>"  name="storage_renewal_dt_18"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_18'])?$select_result['date_1_18']:""; ?>"  name="date_1_18"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_18'])?$select_result['purpose_0_18']:""; ?>"  maxlength="20" name="purpose_0_18"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_18'])?$select_result['media_1_18']:""; ?>"  maxlength="20" name="media_1_18"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_18'])?$select_result['no_embryo_thawed_18']:""; ?>"  min="0" name="no_embryo_thawed_18"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_18'])?$select_result['thawing_path_18']:""; ?>"  maxlength="20" name="thawing_path_18"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_18'])?$select_result['no_embryo_recovered_18']:""; ?>"  min="0" name="no_embryo_recovered_18"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_18'])?$select_result['date_2_18']:""; ?>"  name="date_2_18"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_18'])?$select_result['reason_18']:""; ?>"  maxlength="20" name="reason_18"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_18'])?$select_result['empty_0_18']:""; ?>"  maxlength="20" name="empty_0_18"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_18'])?$select_result['empty_1_18']:""; ?>"  maxlength="20" name="empty_1_18"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_19'])?$select_result['no_19']:""; ?>"  min="0" name="no_19">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
<input type="radio" name="egg_quality_0_19" value="M2" <?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_19" value="M1" <?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_19" value="GV" <?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_19" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	



								  </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_19'])?$select_result['comment_0_19']:""; ?>"  name="comment_0_19"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_19'])?$select_result['pn1_0_19']:""; ?>"  min="0" name="pn1_0_19"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_19'])?$select_result['pn2_0_19']:""; ?>"  min="0" name="pn2_0_19"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_19'])?$select_result['pn3_0_19']:""; ?>"  min="0" name="pn3_0_19"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_19'])?$select_result['degenerate_19']:""; ?>"  min="0" name="degenerate_19"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_19'])?$select_result['pb2_19']:""; ?>"  min="0" name="pb2_19"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_19'])?$select_result['comments_19']:""; ?>"  maxlength="20" name="comments_19"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_19'])?$select_result['cell_0_19']:""; ?>"  maxlength="20" name="cell_0_19"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_19'])?$select_result['grade_0_19']:""; ?>"  maxlength="20" name="grade_0_19"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_19'])?$select_result['clevage_time_19']:""; ?>"  maxlength="20" name="clevage_time_19"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_19'])?$select_result['frag_0_19']:""; ?>"  maxlength="20" name="frag_0_19"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_19'])?$select_result['cell_1_19']:""; ?>"  maxlength="20" name="cell_1_19"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_19'])?$select_result['grade_1_19']:""; ?>"  maxlength="20" name="grade_1_19"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_19'])?$select_result['frag_1_19']:""; ?>"  maxlength="20" name="frag_1_19"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_19'])?$select_result['stage_19']:""; ?>"  maxlength="20" name="stage_19"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_19'])?$select_result['grade_2_19']:""; ?>"  maxlength="20" name="grade_2_19"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_19'])?$select_result['frag_2_19']:""; ?>"  maxlength="20" name="frag_2_19"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_19'])?$select_result['date_0_19']:""; ?>"  name="date_0_19"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_19'])?$select_result['media_0_19']:""; ?>"  maxlength="20" name="media_0_19"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_19'])?$select_result['container_no_0_19']:""; ?>"  maxlength="20" name="container_no_0_19"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_19'])?$select_result['straw_no_19']:""; ?>"  min="0" name="straw_no_19"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_19'])?$select_result['color_19']:""; ?>"  maxlength="20" name="color_19"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_19'])?$select_result['embryos_frozen_0_19']:""; ?>"  min="0" name="embryos_frozen_0_19"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_19'])?$select_result['storage_renewal_dt_19']:""; ?>"  name="storage_renewal_dt_19"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_19'])?$select_result['date_1_19']:""; ?>"  name="date_1_19"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_19'])?$select_result['purpose_0_19']:""; ?>"  maxlength="20" name="purpose_0_19"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_19'])?$select_result['media_1_19']:""; ?>"  maxlength="20" name="media_1_19"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_19'])?$select_result['no_embryo_thawed_19']:""; ?>"  min="0" name="no_embryo_thawed_19"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_19'])?$select_result['thawing_path_19']:""; ?>"  maxlength="20" name="thawing_path_19"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_19'])?$select_result['no_embryo_recovered_19']:""; ?>"  min="0" name="no_embryo_recovered_19"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_19'])?$select_result['date_2_19']:""; ?>"  name="date_2_19"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_19'])?$select_result['reason_19']:""; ?>"  maxlength="20" name="reason_19"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_19'])?$select_result['empty_0_19']:""; ?>"  maxlength="20" name="empty_0_19"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_19'])?$select_result['empty_1_19']:""; ?>"  maxlength="20" name="empty_1_19"  ></td>
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td style="background: #FFC000"><input type="number" value="<?php echo isset($select_result['no_20'])?$select_result['no_20']:""; ?>"  min="0" name="no_20">NUMERAL DROP DOWN</td>
							        <td style="background: #FFC000">
							        
<input type="radio" name="egg_quality_0_20" value="M2" <?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "M2"){echo 'checked="checked"'; }?>> M2<br>
<input type="radio" name="egg_quality_0_20" value="M1" <?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "M1"){echo 'checked="checked"'; }?>> M1<br>
<input type="radio" name="egg_quality_0_20" value="GV" <?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "GV"){echo 'checked="checked"'; }?>> GV<br>
<input type="radio" name="egg_quality_0_20" value="DEGENERATE" <?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "DEGENERATE"){echo 'checked="checked"'; }?>>DEGENERATE
	

						

								 </td>
							        <td style="background: #FFC000"><input type="text" value="<?php echo isset($select_result['comment_0_20'])?$select_result['comment_0_20']:""; ?>"  name="comment_0_20"  ></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn1_0_20'])?$select_result['pn1_0_20']:""; ?>"  min="0" name="pn1_0_20"> </td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn2_0_20'])?$select_result['pn2_0_20']:""; ?>"  min="0" name="pn2_0_20"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pn3_0_20'])?$select_result['pn3_0_20']:""; ?>"  min="0" name="pn3_0_20"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['degenerate_20'])?$select_result['degenerate_20']:""; ?>"  min="0" name="degenerate_20"></td>
							        <td style="background: #F4B083"><input type="number" value="<?php echo isset($select_result['pb2_20'])?$select_result['pb2_20']:""; ?>"  min="0" name="pb2_20"></td>
							        <td style="background: #F4B083"><input type="text" value="<?php echo isset($select_result['comments_20'])?$select_result['comments_20']:""; ?>"  maxlength="20" name="comments_20"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['cell_0_20'])?$select_result['cell_0_20']:""; ?>"  maxlength="20" name="cell_0_20"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['grade_0_20'])?$select_result['grade_0_20']:""; ?>"  maxlength="20" name="grade_0_20"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['clevage_time_20'])?$select_result['clevage_time_20']:""; ?>"  maxlength="20" name="clevage_time_20"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['frag_0_20'])?$select_result['frag_0_20']:""; ?>"  maxlength="20" name="frag_0_20"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['cell_1_20'])?$select_result['cell_1_20']:""; ?>"  maxlength="20" name="cell_1_20"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['grade_1_20'])?$select_result['grade_1_20']:""; ?>"  maxlength="20" name="grade_1_20"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['frag_1_20'])?$select_result['frag_1_20']:""; ?>"  maxlength="20" name="frag_1_20"  ></td>
							        <td style="background: #548135"><input type="text" value="<?php echo isset($select_result['stage_20'])?$select_result['stage_20']:""; ?>"  maxlength="20" name="stage_20"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['grade_2_20'])?$select_result['grade_2_20']:""; ?>"  maxlength="20" name="grade_2_20"  ></td>
							        <td style="background: #AEABAB"><input type="text" value="<?php echo isset($select_result['frag_2_20'])?$select_result['frag_2_20']:""; ?>"  maxlength="20" name="frag_2_20"  ></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['date_0_20'])?$select_result['date_0_20']:""; ?>"  name="date_0_20"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['media_0_20'])?$select_result['media_0_20']:""; ?>"  maxlength="20" name="media_0_20"  ></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['container_no_0_20'])?$select_result['container_no_0_20']:""; ?>"  maxlength="20" name="container_no_0_20"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['straw_no_20'])?$select_result['straw_no_20']:""; ?>"  min="0" name="straw_no_20"></td>
							        <td style="background: #F2F2F2"><input type="text" value="<?php echo isset($select_result['color_20'])?$select_result['color_20']:""; ?>"  maxlength="20" name="color_20"  ></td>
							        <td style="background: #F2F2F2"><input type="number" value="<?php echo isset($select_result['embryos_frozen_0_20'])?$select_result['embryos_frozen_0_20']:""; ?>"  min="0" name="embryos_frozen_0_20"></td>
							        <td style="background: #F2F2F2"><input type="date" value="<?php echo isset($select_result['storage_renewal_dt_20'])?$select_result['storage_renewal_dt_20']:""; ?>"  name="storage_renewal_dt_20"></td>
							        <td style="background: #C5E0B3"><input type="date" value="<?php echo isset($select_result['date_1_20'])?$select_result['date_1_20']:""; ?>"  name="date_1_20"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['purpose_0_20'])?$select_result['purpose_0_20']:""; ?>"  maxlength="20" name="purpose_0_20"  ></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['media_1_20'])?$select_result['media_1_20']:""; ?>"  maxlength="20" name="media_1_20"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_thawed_20'])?$select_result['no_embryo_thawed_20']:""; ?>"  min="0" name="no_embryo_thawed_20"></td>
							        <td style="background: #C5E0B3"><input type="text" value="<?php echo isset($select_result['thawing_path_20'])?$select_result['thawing_path_20']:""; ?>"  maxlength="20" name="thawing_path_20"  ></td>
							        <td style="background: #C5E0B3"><input type="number" value="<?php echo isset($select_result['no_embryo_recovered_20'])?$select_result['no_embryo_recovered_20']:""; ?>"  min="0" name="no_embryo_recovered_20"></td>
							    	<td style="background: #FEF2CB"></td>
							    	<td style="background: #FEF2CB"></td>
							        <td style="background: #F7CAAC"><input type="date" value="<?php echo isset($select_result['date_2_20'])?$select_result['date_2_20']:""; ?>"  name="date_2_20"></td>
							        <td style="background: #F7CAAC"><input type="text" value="<?php echo isset($select_result['reason_20'])?$select_result['reason_20']:""; ?>"  maxlength="20" name="reason_20"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_0_20'])?$select_result['empty_0_20']:""; ?>"  maxlength="20" name="empty_0_20"  ></td>
							        <td style="background: #8EAADB"><input type="text" value="<?php echo isset($select_result['empty_1_20'])?$select_result['empty_1_20']:""; ?>"  maxlength="20" name="empty_1_20"  ></td>
					        	</tr>
					        </thead>
					    </table>
					</div>
					<div class='table-responsive'>
						<table class="table table-bordered table-hover mt-2 table-sm red-field">
							<ul><li>Emb/Gr = Embryo/Grade</li></ul>
					    	<thead>
						        <th> Embryo Grading (Fragmentation): 1- Best </th>
					    	</thead>
					    	<thead>
					        	<th> Day 3 </th>
					         	<th> 1</th>
					          	<th>2 </th>
					           	<th>3 </th>
					           	<th>4</th>
					    	</thead>
					    	<thead>
					        	<th> Fragmentation</th>
					         	<th> No Fragmentation</th>
					          	<th>0-20%</th>
					           	<th>20-30% </th>
					           	<th>50-100%</th>
					    	</thead>
					    	<thead>
						        <th>Blastocyst Grade (Expansion): 4&A- Best,1 &D -Poor </th>
						    </thead>
					    	<thead>
					        	<th> Grade </th>
					         	<th> 1</th>
					          	<th>2 </th>
					           	<th>3 </th>
					           	<th>4</th>
					    	</thead>
					    	<thead>
					         	<th>ICM</th>
					          	<th>A</th>
					           	<th>B</th>
					           	<th>C</th>
					           	<th>D</th>
					    	</thead>
					    	<thead>
					         	<th>Trophoblast</th>
					          	<th>A</th>
					           	<th>B</th>
					           	<th>C</th>
					           	<th>D</th>
					    	</thead>
					    </table>
					</div>
				 
					<!-- <p class="mt-2">
						<span>UPLOAD PHOTO</span>
						<input type="file" value="<?php echo isset($select_result['upload'])?$select_result['upload']:""; ?>"  id="file" name="upload" multiple change = "onFileChange"/>
					</p> -->
					<!-- <input type="" name="" class="btn btn-primary mt-2 mb-2" value="submit"> -->
					<input type="submit" name="submit" class="btn btn-primary mt-2 mb-2" value="submit">
				</div>
			</form>
			
			
	<!-- pRINT bUTTON -->		
			
			
<input type="button" id="btn" value="Print" class="btn btn-primary pull-right printbtn" onclick="printtable();">
            
<div  class="printtable prtable"  id="printtable"  style="display:none"> 

<table class="table table-bordered table-hover mt-2 table-sm red-field tableMg" style="width:100%; border:1px solid #cdcdcd;" >
     					<thead>
                			<tr>
                				<td colspan="2"  style="border:1px solid #cdcdcd;"><h2>EMBRYO RECORD SHEET</h2></td>
                				<td colspan="2"  style="border:1px solid #cdcdcd;">
                    			    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&
                    			            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 
                    			            isset($select_result['updated_type']) && !empty($select_result['updated_type'])
                    			            ){?>
                    			        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>
                    			    <?php } ?>
                    			</td>
                			</tr>
     					</thead>
  					</table>
 				
    					


	<table class="table table-bordered table-hover mt-2 table-sm red-field" style="width:100%; border:1px solid #cdcdcd;"  >
					        <thead>
					        	<tr>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Day O (OPU)</th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Day 1</th>
					        		<th colspan="4" style="border:1px solid #cdcdcd;">Day 2</th>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Day 3</th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Day 4</th>
					        		
									
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date0'])?$select_result['date0']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date1'])?$select_result['date1']:""; ?></th>
					        		<th colspan="4" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date2'])?$select_result['date2']:""; ?></th>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date3'])?$select_result['date3']:""; ?></th>
					        		<th colspan="1" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date4'])?$select_result['date4']:""; ?></th>
					        		
								
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time0'])?$select_result['time0']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Diss.Time: <?php echo isset($select_result['time1'])?$select_result['time1']:""; ?></th>
					        		<th colspan="4" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time2'])?$select_result['time2']:""; ?></th>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time3'])?$select_result['time3']:""; ?></th>
					        		<th style="background: #548135">Time: <?php echo isset($select_result['time4'])?$select_result['time4']:""; ?></th>
					        		
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb'])?$select_result['emb']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Score Time: <?php echo isset($select_result['score_time'])?$select_result['score_time']:""; ?></th>
					        		<th colspan="4" style="border:1px solid #cdcdcd;">Hrs: <?php echo isset($select_result['hrs0'])?$select_result['hrs0']:""; ?></th>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Hrs: <?php echo isset($select_result['hrs1'])?$select_result['hrs1']:""; ?></th>
					        		<th style="background: #548135">Hrs: <?php echo isset($select_result['hrs2'])?$select_result['hrs2']:""; ?></th>
					        		
									
									
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Dr: <?php echo isset($select_result['dr'])?$select_result['dr']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb0'])?$select_result['emb0']:""; ?></th>
					        		<th colspan="4" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb1'])?$select_result['emb1']:""; ?></th>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb2'])?$select_result['emb2']:""; ?></th>
					        		<th style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb3'])?$select_result['emb3']:""; ?></th>
					        		
									
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Witness: <?php echo isset($select_result['witness0'])?$select_result['witness0']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Witness: <?php echo isset($select_result['witness1'])?$select_result['witness1']:""; ?></th>
					        		<th colspan="4" style="border:1px solid #cdcdcd;">Witness: <?php echo isset($select_result['witness2'])?$select_result['witness2']:""; ?></th>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">Wit: <?php echo isset($select_result['wit0'])?$select_result['wit0']:""; ?></th>
					        		<th style="background: #548135">Wit: <?php echo isset($select_result['wit1'])?$select_result['wit1']:""; ?></th>
					        		
									
								
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<th colspan="3" style="padding: 0; background: #FFC000">
					        			<table style="width: 100%;">
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;"></td>
					        					<td  style="border:1px solid #cdcdcd;">IVF</td>
					        					<td  style="border:1px solid #cdcdcd;">ICSI</td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">No. COC inseminated</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['ivf_inseminated'])?$select_result['ivf_inseminated']:""; ?></td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icsi_inseminated'])?$select_result['icsi_inseminated']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">All oocyte injected</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['ivf_injected'])?$select_result['ivf_injected']:""; ?></td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icsi_injected'])?$select_result['icsi_injected']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">No. damaged or degenerated oocyte during ICSI</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['ivf_degenerated'])?$select_result['ivf_degenerated']:""; ?></td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icsi_degenerated'])?$select_result['icsi_degenerated']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">No.M2 oocytes at ICSI</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['ivf_oocytes'])?$select_result['ivf_oocytes']:""; ?></td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icsi_oocytes'])?$select_result['icsi_oocytes']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">No.M2 oocytes injected</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['ivf_oocytes_injected'])?$select_result['ivf_oocytes_injected']:""; ?></td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['icsi_oocytes_injected'])?$select_result['icsi_oocytes_injected']:""; ?></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="6" style="padding: 0; border:1px solid #cdcdcd;">
					        			<table style="width: 100%; border:1px solid #cdcdcd;">
					        				<tr>
												<td  style="border:1px solid #cdcdcd;">Total No.of oocytes with no fertilization</td>
												<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_fertilization'])?$select_result['no_fertilization']:""; ?></td>
											</tr>
											<tr>
												<td  style="border:1px solid #cdcdcd;">No.1 PN oocyte</td>
												<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_1_pn_oocyte'])?$select_result['no_1_pn_oocyte']:""; ?></td>
											</tr>
											<tr>
												<td  style="border:1px solid #cdcdcd;">No.oocytes with 2 PN and PB</td>
												<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['oocyte_2pn_pb'])?$select_result['oocyte_2pn_pb']:""; ?></td>
											</tr>
											<tr>
												<td  style="border:1px solid #cdcdcd;">No.fertilized oocytes with >2PN</td>
												<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['oocyte_2pn'])?$select_result['oocyte_2pn']:""; ?></td>
											</tr>
					        			</table>
					        		</th>
					        		<th colspan="4" style="padding: 0; background: #C5E0B3">
					        			<table style="width: 100%;">
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total no of cleaved embryos Day2</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cleaved_embryos'])?$select_result['cleaved_embryos']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total no.of 4 cell embryos Day2</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_embryos_day2'])?$select_result['cell_embryos_day2']:""; ?></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="3" style="padding: 0;  border:1px solid #cdcdcd;">
					        			<table style="width: 100%;">
						        			<tr>
						        				<td  style="border:1px solid #cdcdcd;">Total no. of 8 cell embryos day 3</td>
						        				<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_embryos_day3'])?$select_result['cell_embryos_day3']:""; ?></td>
						        			</tr>
					        			</table>
					        		</th>
					        		<th style="border:1px solid #cdcdcd;"></th>
					        		
								</tr>
					        </thead>
							
							
							
					        <thead>
					        	<tr>
					        		<th colspan="3" style="padding: 0;border:1px solid #cdcdcd;">
					        			<table style="width:100%; border:1px solid #cdcdcd;" >
					        				<tr><td  style="border:1px solid #cdcdcd;">Hyal Time: <?php echo isset($select_result['hyal_time'])?$select_result['hyal_time']:""; ?></td></tr>
					        				<tr><td  style="border:1px solid #cdcdcd;">Emb. : <?php echo isset($select_result['hyal_time_emb'])?$select_result['hyal_time_emb']:""; ?></td></tr>
					        				<tr><td  style="border:1px solid #cdcdcd;">Inj Time :<?php echo isset($select_result['inj_time'])?$select_result['inj_time']:""; ?></td></tr>
					        				<tr><td  style="border:1px solid #cdcdcd;">Emb. :<?php echo isset($select_result['inj_time_emb'])?$select_result['inj_time_emb']:""; ?></td></tr>
					        			</table>
					        		</th>
					        			<th colspan="6" style="border:1px solid #cdcdcd;">
										
										
									<?php if(!empty($upload_photo_0)) {?>
				 <img src="<?php echo $upload_photo_0;?>" style="width:100px; height:100px;">
					<?php } else {echo " ";}?>	
										
										
					        		</th>
					        		<th colspan="4" style="border:1px solid #cdcdcd;">
					        			
										<?php if(!empty($upload_photo_1)) {?>
				 <img src="<?php echo $upload_photo_1;?>" style="width:100px; height:100px;">
					<?php } else {echo " ";}?>	
										
										
					        		</th>
					        		<th colspan="3" style="border:1px solid #cdcdcd;">
					        				<?php if(!empty($upload_photo_2)) {?>
				 <img src="<?php echo $upload_photo_2;?>" style="width:100px; height:100px;">
					<?php } else {echo " ";}?>
					        		</th>
					        		<th style="background: #548135"></th>
					        		
									
									
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
					        		<td  style="border:1px solid #cdcdcd;">No</td>
									<td  style="border:1px solid #cdcdcd;">Egg Quality</td>
									<td  style="border:1px solid #cdcdcd;">comment</td>
									<td  style="border:1px solid #cdcdcd;">1PN</td>
									<td  style="border:1px solid #cdcdcd;">2PN</td>
									<td  style="border:1px solid #cdcdcd;">3PN</td>
									<td  style="border:1px solid #cdcdcd;">Degenerate</td>
									<td  style="border:1px solid #cdcdcd;">2PB</td>
									<td  style="border:1px solid #cdcdcd;">comments</td>
									<td  style="border:1px solid #cdcdcd;">Cell</td>
									<td  style="border:1px solid #cdcdcd;">Grade</td>
									<td  style="border:1px solid #cdcdcd;">Clevage Time</td>
									<td  style="border:1px solid #cdcdcd;">Frag%</td>
									<td  style="border:1px solid #cdcdcd;">Cell</td>
									<td  style="border:1px solid #cdcdcd;">Grade</td>
									<td  style="border:1px solid #cdcdcd;">Frag%</td>
									<td  style="border:1px solid #cdcdcd;">Stage</td>
									
									
									
									
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_0'])?$select_result['no_0']:""; ?> NUMERAL DROP DOWN </td>
							        <td  style="border:1px solid #cdcdcd;">
							        		
							    
 <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0']) && $select_result['egg_quality_0'] == "DEGENERATE"){echo 'DEGENERATE'; }?>

								</td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0'])?$select_result['comment_0']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0'])?$select_result['pn1_0']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0'])?$select_result['pn2_0']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0'])?$select_result['pn3_0']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate'])?$select_result['degenerate']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2'])?$select_result['pb2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments'])?$select_result['comments']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0'])?$select_result['cell_0']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0'])?$select_result['grade_0']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time'])?$select_result['clevage_time']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0'])?$select_result['frag_0']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1'])?$select_result['cell_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1'])?$select_result['grade_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1'])?$select_result['frag_1']:""; ?></td>
								    <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage'])?$select_result['stage']:""; ?></td>
							       




					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_1'])?$select_result['no_1']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        								     



 <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_1']) && $select_result['egg_quality_0_1'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
   </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_1'])?$select_result['comment_0_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_1'])?$select_result['pn1_0_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_1'])?$select_result['pn2_0_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_1'])?$select_result['pn3_0_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_1'])?$select_result['degenerate_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_1'])?$select_result['pb2_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_1'])?$select_result['comments_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_1'])?$select_result['cell_0_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_1'])?$select_result['grade_0_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_1'])?$select_result['clevage_time_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_1'])?$select_result['frag_0_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_1'])?$select_result['cell_1_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_1'])?$select_result['grade_1_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_1'])?$select_result['frag_1_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_1'])?$select_result['stage_1']:""; ?></td>
                          


					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_2'])?$select_result['no_2']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        	
<?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_2']) && $select_result['egg_quality_0_2'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
							       

								   </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_2'])?$select_result['comment_0_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_2'])?$select_result['pn1_0_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_2'])?$select_result['pn2_0_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_2'])?$select_result['pn3_0_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_2'])?$select_result['degenerate_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_2'])?$select_result['pb2_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_2'])?$select_result['comments_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_2'])?$select_result['cell_0_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_2'])?$select_result['grade_0_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_2'])?$select_result['clevage_time_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_2'])?$select_result['frag_0_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_2'])?$select_result['cell_1_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_2'])?$select_result['grade_1_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_2'])?$select_result['frag_1_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_2'])?$select_result['stage_2']:""; ?></td>



								 
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_3'])?$select_result['no_3']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        	
							        
							
<?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_3']) && $select_result['egg_quality_0_3'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
									
									
									
									</td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_3'])?$select_result['comment_0_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_3'])?$select_result['pn1_0_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_3'])?$select_result['pn2_0_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_3'])?$select_result['pn3_0_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_3'])?$select_result['degenerate_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_3'])?$select_result['pb2_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_3'])?$select_result['comments_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_3'])?$select_result['cell_0_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_3'])?$select_result['grade_0_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_3'])?$select_result['clevage_time_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_3'])?$select_result['frag_0_3']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_3'])?$select_result['cell_1_3']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_3'])?$select_result['grade_1_3']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_3'])?$select_result['frag_1_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_3'])?$select_result['stage_3']:""; ?></td>
									
									
									
								
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_4'])?$select_result['no_4']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        										
										
<?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_4']) && $select_result['egg_quality_0_4'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
										
											
							        </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_4'])?$select_result['comment_0_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_4'])?$select_result['pn1_0_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_4'])?$select_result['pn2_0_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_4'])?$select_result['pn3_0_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_4'])?$select_result['degenerate_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_4'])?$select_result['pb2_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_4'])?$select_result['comments_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_4'])?$select_result['cell_0_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_4'])?$select_result['grade_0_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_4'])?$select_result['clevage_time_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_4'])?$select_result['frag_0_4']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_4'])?$select_result['cell_1_4']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_4'])?$select_result['grade_1_4']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_4'])?$select_result['frag_1_4']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_4'])?$select_result['stage_4']:""; ?></td>



								 
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_5'])?$select_result['no_5']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							
<?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_5']) && $select_result['egg_quality_0_5'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
								 </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_5'])?$select_result['comment_0_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_5'])?$select_result['pn1_0_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_5'])?$select_result['pn2_0_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_5'])?$select_result['pn3_0_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_5'])?$select_result['degenerate_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_5'])?$select_result['pb2_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_5'])?$select_result['comments_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_5'])?$select_result['cell_0_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_5'])?$select_result['grade_0_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_5'])?$select_result['clevage_time_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_5'])?$select_result['frag_0_5']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_5'])?$select_result['cell_1_5']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_5'])?$select_result['grade_1_5']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_5'])?$select_result['frag_1_5']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_5'])?$select_result['stage_5']:""; ?></td>



								  
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_6'])?$select_result['no_6']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        
<?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_6']) && $select_result['egg_quality_0_6'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
							        </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_6'])?$select_result['comment_0_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_6'])?$select_result['pn1_0_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_6'])?$select_result['pn2_0_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_6'])?$select_result['pn3_0_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_6'])?$select_result['degenerate_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_6'])?$select_result['pb2_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_6'])?$select_result['comments_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_6'])?$select_result['cell_0_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_6'])?$select_result['grade_0_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_6'])?$select_result['clevage_time_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_6'])?$select_result['frag_0_6']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_6'])?$select_result['cell_1_6']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_6'])?$select_result['grade_1_6']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_6'])?$select_result['frag_1_6']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_6'])?$select_result['stage_6']:""; ?></td>


								   
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_7'])?$select_result['no_7']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        
<?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_7']) && $select_result['egg_quality_0_7'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
							        </td>
							        <td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['comment_0_7'])?$select_result['comment_0_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_7'])?$select_result['pn1_0_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_7'])?$select_result['pn2_0_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_7'])?$select_result['pn3_0_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_7'])?$select_result['degenerate_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_7'])?$select_result['pb2_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_7'])?$select_result['comments_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_7'])?$select_result['cell_0_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_7'])?$select_result['grade_0_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_7'])?$select_result['clevage_time_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_7'])?$select_result['frag_0_7']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_7'])?$select_result['cell_1_7']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_7'])?$select_result['grade_1_7']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_7'])?$select_result['frag_1_7']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_7'])?$select_result['stage_7']:""; ?></td> 


					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_8'])?$select_result['no_8']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        	
							

<?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_8']) && $select_result['egg_quality_0_8'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
	


								   </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_8'])?$select_result['comment_0_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_8'])?$select_result['pn1_0_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_8'])?$select_result['pn2_0_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_8'])?$select_result['pn3_0_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_8'])?$select_result['degenerate_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_8'])?$select_result['pb2_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_8'])?$select_result['comments_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_8'])?$select_result['cell_0_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_8'])?$select_result['grade_0_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_8'])?$select_result['clevage_time_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_8'])?$select_result['frag_0_8']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_8'])?$select_result['cell_1_8']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_8'])?$select_result['grade_1_8']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_8'])?$select_result['frag_1_8']:""; ?></td>
							          <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_8'])?$select_result['stage_8']:""; ?></td>


					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_9'])?$select_result['no_9']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        	
								
	
								
 <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_9']) && $select_result['egg_quality_0_9'] == "DEGENERATE"){echo 'DEGENERATE'; }?>

								
										
							        </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_9'])?$select_result['comment_0_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_9'])?$select_result['pn1_0_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_9'])?$select_result['pn2_0_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_9'])?$select_result['pn3_0_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_9'])?$select_result['degenerate_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_9'])?$select_result['pb2_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_9'])?$select_result['comments_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_9'])?$select_result['cell_0_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_9'])?$select_result['grade_0_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_9'])?$select_result['clevage_time_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_9'])?$select_result['frag_0_9']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_9'])?$select_result['cell_1_9']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_9'])?$select_result['grade_1_9']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_9'])?$select_result['frag_1_9']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_9'])?$select_result['stage_9']:""; ?></td>

								  </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_10'])?$select_result['no_10']:""; ?>NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							    
 <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_10']) && $select_result['egg_quality_0_10'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
	
							   </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_10'])?$select_result['comment_0_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_10'])?$select_result['pn1_0_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_10'])?$select_result['pn2_0_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_10'])?$select_result['pn3_0_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_10'])?$select_result['degenerate_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_10'])?$select_result['pb2_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_10'])?$select_result['comments_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_10'])?$select_result['cell_0_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_10'])?$select_result['grade_0_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_10'])?$select_result['clevage_time_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_10'])?$select_result['frag_0_10']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_10'])?$select_result['cell_1_10']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_10'])?$select_result['grade_1_10']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_10'])?$select_result['frag_1_10']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_10'])?$select_result['stage_10']:""; ?></td>
							      


								 
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_11'])?$select_result['no_11']:""; ?> NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        
 <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_11']) && $select_result['egg_quality_0_11'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
	


								   </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_11'])?$select_result['comment_0_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_11'])?$select_result['pn1_0_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_11'])?$select_result['pn2_0_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_11'])?$select_result['pn3_0_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_11'])?$select_result['degenerate_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_11'])?$select_result['pb2_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_11'])?$select_result['comments_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_11'])?$select_result['cell_0_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_11'])?$select_result['grade_0_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_11'])?$select_result['clevage_time_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_11'])?$select_result['frag_0_11']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_11'])?$select_result['cell_1_11']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_11'])?$select_result['grade_1_11']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_11'])?$select_result['frag_1_11']:""; ?></td>
							       
                                  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_11'])?$select_result['stage_11']:""; ?></td>



								  </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_12'])?$select_result['no_12']:""; ?>NUMERAL DROP DOWN</td>
									
									
							        <td  style="border:1px solid #cdcdcd;">
									
									
	 <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_12']) && $select_result['egg_quality_0_12'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
	

								</td>
							 	  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_12'])?$select_result['comment_0_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_12'])?$select_result['pn1_0_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_12'])?$select_result['pn2_0_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['pn3_0_12'])?$select_result['pn3_0_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_12'])?$select_result['degenerate_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_12'])?$select_result['pb2_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_12'])?$select_result['comments_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_12'])?$select_result['cell_0_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_12'])?$select_result['grade_0_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_12'])?$select_result['clevage_time_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_12'])?$select_result['frag_0_12']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_12'])?$select_result['cell_1_12']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_12'])?$select_result['grade_1_12']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_12'])?$select_result['frag_1_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_12'])?$select_result['stage_12']:""; ?></td>


								 </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_13'])?$select_result['no_13']:""; ?> NUMERAL DROP DOWN</td>
							        <td  style="border:1px solid #cdcdcd;">
							        	
 <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_13']) && $select_result['egg_quality_0_13'] == "DEGENERATE"){echo 'DEGENERATE'; }?>


								 </td>
							        <td  style="border:1px solid #cdcdcd; height:30px; height:30px;"><?php echo isset($select_result['comment_0_13'])?$select_result['comment_0_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_13'])?$select_result['pn1_0_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_13'])?$select_result['pn2_0_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_13'])?$select_result['pn3_0_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_13'])?$select_result['degenerate_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_13'])?$select_result['pb2_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_13'])?$select_result['comments_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_13'])?$select_result['cell_0_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_13'])?$select_result['grade_0_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_13'])?$select_result['clevage_time_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_13'])?$select_result['frag_0_13']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_13'])?$select_result['cell_1_13']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_13'])?$select_result['grade_1_13']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_13'])?$select_result['frag_1_13']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_13'])?$select_result['stage_13']:""; ?></td>


								  </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_14'])?$select_result['no_14']:""; ?> NUMERAL DROP DOWN</td>
							       



								   <td  style="border:1px solid #cdcdcd;">
							         <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "GV"){echo 'GV'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_14']) && $select_result['egg_quality_0_14'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
							        </td>
									
									
									
									
							        <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['comment_0_14'])?$select_result['comment_0_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_14'])?$select_result['pn1_0_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_14'])?$select_result['pn2_0_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_14'])?$select_result['pn3_0_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_14'])?$select_result['degenerate_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_14'])?$select_result['pb2_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_14'])?$select_result['comments_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_14'])?$select_result['cell_0_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_14'])?$select_result['grade_0_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_14'])?$select_result['clevage_time_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_14'])?$select_result['frag_0_14']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_14'])?$select_result['cell_1_14']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_14'])?$select_result['grade_1_14']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_14'])?$select_result['frag_1_14']:""; ?></td>
							         <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_14'])?$select_result['stage_14']:""; ?></td>

</tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_15'])?$select_result['no_15']:""; ?> NUMERAL DROP DOWN </td>
							        <td  style="border:1px solid #cdcdcd;">
							        
									
 <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_15']) && $select_result['egg_quality_0_15'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
									
									
							        </td>
							        <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['comment_0_15'])?$select_result['comment_0_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_15'])?$select_result['pn1_0_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_15'])?$select_result['pn2_0_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_15'])?$select_result['pn3_0_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_15'])?$select_result['degenerate_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_15'])?$select_result['pb2_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_15'])?$select_result['comments_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_15'])?$select_result['cell_0_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_15'])?$select_result['grade_0_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_15'])?$select_result['clevage_time_15']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_15'])?$select_result['frag_0_15']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_15'])?$select_result['cell_1_15']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_15'])?$select_result['grade_1_15']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_15'])?$select_result['frag_1_15']:""; ?></td>
							       	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_15'])?$select_result['stage_15']:""; ?></td>


								  </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_16'])?$select_result['no_16']:""; ?> NUMERAL DROP DOWN </td>
							        <td  style="border:1px solid #cdcdcd;">
							    
								
 <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "M2"){echo 'M2'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_16']) && $select_result['egg_quality_0_16'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
							        </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_16'])?$select_result['comment_0_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_16'])?$select_result['pn1_0_16']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_16'])?$select_result['pn2_0_16']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_16'])?$select_result['pn3_0_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_16'])?$select_result['degenerate_16']:""; ?> </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_16'])?$select_result['pb2_16']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_16'])?$select_result['comments_16']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_16'])?$select_result['cell_0_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_16'])?$select_result['grade_0_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_16'])?$select_result['clevage_time_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_16'])?$select_result['frag_0_16']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_16'])?$select_result['cell_1_16']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_16'])?$select_result['grade_1_16']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_16'])?$select_result['frag_1_16']:""; ?></td>

</tr>
					        </thead>
					        <thead>
					        	<tr>
	<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_17'])?$select_result['no_17']:""; ?></td>
	<td  style="border:1px solid #cdcdcd;">
						
						
 <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "M2"){echo 'M2'; }?><br>
 <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "M1"){echo 'M1'; }?> <br>
 <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_17']) && $select_result['egg_quality_0_17'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
	
 </td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_17'])?$select_result['comment_0_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_17'])?$select_result['pn1_0_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_17'])?$select_result['pn2_0_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_17'])?$select_result['pn3_0_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_17'])?$select_result['degenerate_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_17'])?$select_result['pb2_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_17'])?$select_result['comments_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_17'])?$select_result['cell_0_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_17'])?$select_result['grade_0_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_17'])?$select_result['clevage_time_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_17'])?$select_result['frag_0_17']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_17'])?$select_result['cell_1_17']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_17'])?$select_result['grade_1_17']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_17'])?$select_result['frag_1_17']:""; ?></td>
							       
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_17'])?$select_result['stage_17']:""; ?></td>


								   </tr>
					        </thead>
					        <thead>
					        	<tr>
									<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_18'])?$select_result['no_18']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;">
	
<?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "M2"){echo 'M2'; }?><br>
 <?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "M1"){echo 'M1'; }?><br>
<?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_18']) && $select_result['egg_quality_0_18'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
	

								   </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_18'])?$select_result['comment_0_18']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_18'])?$select_result['pn1_0_18']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_18'])?$select_result['pn2_0_18']:""; ?></td>
	<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_18'])?$select_result['pn3_0_18']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_18'])?$select_result['degenerate_18']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_18'])?$select_result['pb2_18']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_18'])?$select_result['comments_18']:""; ?></td>
	  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_18'])?$select_result['cell_0_18']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_18'])?$select_result['grade_0_18']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_18'])?$select_result['clevage_time_18']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_18'])?$select_result['frag_0_18']:""; ?></td>
	<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_18'])?$select_result['cell_1_18']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_18'])?$select_result['grade_1_18']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_18'])?$select_result['frag_1_18']:""; ?></td>
  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_18'])?$select_result['stage_18']:""; ?>  </td>
 
 
 </tr>
					        </thead>
					        <thead>
					        	<tr>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_19'])?$select_result['no_19']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;">
 <?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "M2"){echo 'M2'; }?><br>
<?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "M1"){echo 'M1'; }?><br>
<?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "GV"){echo 'GV'; }?><br>
 <?php if(isset($select_result['egg_quality_0_19']) && $select_result['egg_quality_0_19'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
 </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_19'])?$select_result['comment_0_19']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_19'])?$select_result['pn1_0_19']:""; ?></td>
  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_19'])?$select_result['pn2_0_19']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_19'])?$select_result['pn3_0_19']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_19'])?$select_result['degenerate_19']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_19'])?$select_result['pb2_19']:""; ?></td>
  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_19'])?$select_result['comments_19']:""; ?></td>
  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_19'])?$select_result['cell_0_19']:""; ?></td>
  <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_19'])?$select_result['grade_0_19']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_19'])?$select_result['clevage_time_19']:""; ?>"</td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_19'])?$select_result['frag_0_19']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_19'])?$select_result['cell_1_19']:""; ?>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_19'])?$select_result['grade_1_19']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_19'])?$select_result['frag_1_19']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_19'])?$select_result['stage_19']:""; ?>  </td>

	</tr>
					        </thead>
					        <thead>
					        	<tr>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_20'])?$select_result['no_20']:""; ?>NUMERAL DROP DOWN</td>
 
 
 <td  style="border:1px solid #cdcdcd;">
							        
 <?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "M2"){echo 'M2'; }?><br>
 <?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "M1"){echo 'M1'; }?><br>
<?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "GV"){echo 'GV'; }?><br>
<?php if(isset($select_result['egg_quality_0_20']) && $select_result['egg_quality_0_20'] == "DEGENERATE"){echo 'DEGENERATE'; }?>
</td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comment_0_20'])?$select_result['comment_0_20']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn1_0_20'])?$select_result['pn1_0_20']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn2_0_20'])?$select_result['pn2_0_20']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pn3_0_20'])?$select_result['pn3_0_20']:""; ?>  </td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['degenerate_20'])?$select_result['degenerate_20']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pb2_20'])?$select_result['pb2_20']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['comments_20'])?$select_result['comments_20']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_0_20'])?$select_result['cell_0_20']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_0_20'])?$select_result['grade_0_20']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['clevage_time_20'])?$select_result['clevage_time_20']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_0_20'])?$select_result['frag_0_20']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['cell_1_20'])?$select_result['cell_1_20']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_1_20'])?$select_result['grade_1_20']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_1_20'])?$select_result['frag_1_20']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['stage_20'])?$select_result['stage_20']:""; ?>  </td>
 
 
 	</tr>
					        </thead>
					    </table>
						
						
	<table class="table table-bordered table-hover mt-2 table-sm red-field" style="width:100%; border:1px solid #cdcdcd;"  >

 <thead>
					        	<tr>
					        		
									<th colspan="2" style="border:1px solid #cdcdcd;">Day 5</th>
									<th colspan="7" style="border:1px solid #cdcdcd;">Freezing</th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Thawing</th>
									
									
					        </tr>
					        </thead>
					     

						 <thead>
					  <tr>
					  
					  <th colspan="2" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date5'])?$select_result['date5']:""; ?></th>
					        		<th colspan="7" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date6'])?$select_result['date6']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date7'])?$select_result['date7']:""; ?></th>
					           
					        	</tr>
					        </thead>
							
							
							
							<thead>
					        	<tr>
								
					<th colspan="2" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time5'])?$select_result['time5']:""; ?></th>
					        		<th colspan="7" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time6'])?$select_result['time6']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time7'])?$select_result['time7']:""; ?></th>
					        		
					        	</tr>
					        </thead>	


<thead>
<tr>	

<th colspan="2" style="border:1px solid #cdcdcd;">Hrs: <?php echo isset($select_result['hrs3'])?$select_result['hrs3']:""; ?></th>
					        		<th colspan="7" style="border:1px solid #cdcdcd;">Hrs: <?php echo isset($select_result['hrs4'])?$select_result['hrs4']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Hrs: <?php echo isset($select_result['hrs5'])?$select_result['hrs5']:""; ?></th>
					        	

</tr>
 </thead>	

<thead>
<tr> 

<th colspan="2" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb4'])?$select_result['emb4']:""; ?></th>
					        		<th colspan="7" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb5'])?$select_result['emb5']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb6'])?$select_result['emb6']:""; ?></th>
					        		
									
</tr>
 </thead>
 
<thead>
<tr>

	  <th colspan="2" style="border:1px solid #cdcdcd;">Wit: <?php echo isset($select_result['wit2'])?$select_result['wit2']:""; ?></th>
					        		<th colspan="7" style="border:1px solid #cdcdcd;">Wit: <?php echo isset($select_result['wit3'])?$select_result['wit3']:""; ?></th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">Wit: <?php echo isset($select_result['wit4'])?$select_result['wit4']:""; ?></th>
					        	
									
	</tr>
 </thead>

 <thead>
<tr> 

                              <th colspan="2" style="padding: 0; border:1px solid #cdcdcd;">
					        			<table style="width: 100%; border:1px solid #cdcdcd;">
						        			<tr>
						        				<td  style="border:1px solid #cdcdcd;">Total No of blastocysts Day5</td>
						        				<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['blastocysts_day5'])?$select_result['blastocysts_day5']:""; ?></td>
						        			</tr>
					        			</table>
					        		</th>
					        		<th colspan="7" style="padding: 0; border:1px solid #cdcdcd;">
					        			<table style="width: 100%; border:1px solid #cdcdcd;">
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total no. of embryos transferred fresh</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_transferred'])?$select_result['embryos_transferred']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total no. of embryos frozen</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen'])?$select_result['embryos_frozen']:""; ?></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="6" style="padding: 0; border:1px solid #cdcdcd;">
					        			<table style="width: 100%; border:1px solid #cdcdcd;">
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total Thawed embryo transferred</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawed_embryo_transferred'])?$select_result['thawed_embryo_transferred']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total embryos intact</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_intact'])?$select_result['embryos_intact']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total warmed embryos</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['warmed_embryos'])?$select_result['warmed_embryos']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total intact blasts</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['intact_blasts'])?$select_result['intact_blasts']:""; ?></td>
					        				</tr>
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">Total warmed blasts</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['warmed_blasts'])?$select_result['warmed_blasts']:""; ?></td>
					        				</tr>
					        			</table>
					        		</th>
					        		
									
</tr>
 </thead>


  <thead>
<tr> 

<th colspan="2" style="border:1px solid #cdcdcd;">
					        				<?php if(!empty($upload_photo_3)) {?>
				 <img src="<?php echo $upload_photo_3;?>" style="width:100px; height:100px;">
					<?php } else {echo " ";}?>
					        		</th>
					        		<th colspan="7" style="border:1px solid #cdcdcd;">
					        			Method:
					        			
										
									<?php if(isset($select_result['method']) && $select_result['method'] == "Slow"){echo 'Slow'; }?> 
					        		<?php if(isset($select_result['method']) && $select_result['method'] == "Virti"){echo 'Virti'; }?>
										
										  
										  
										  
					        		</th>
					        		<th colspan="6" style="border:1px solid #cdcdcd;">
					        													
							<?php if(!empty($upload_photo_4)) {?>
				 <img src="<?php echo $upload_photo_4;?>" style="width:100px; height:100px;">
					<?php } else {echo " ";}?>	
										
										
										
					        		</th>
					        	
									
		</tr>
 </thead>							
 
 
 
 
 <thead>
<tr>
 
 
                                   
									
									<td style="border:1px solid #cdcdcd;">Grade</td>
									<td style="border:1px solid #cdcdcd;">Frag%</td>
									<td style="border:1px solid #cdcdcd;">Date</td>
									<td style="border:1px solid #cdcdcd;">Media</td>
									<td style="border:1px solid #cdcdcd;">Container No.</td>
									<td style="border:1px solid #cdcdcd;">Straw No</td>
									<td style="border:1px solid #cdcdcd;">Color</td>
									<td style="border:1px solid #cdcdcd;">NO OF EMBRYOS FROZEN</td>
									<td style="border:1px solid #cdcdcd;">Storage renewal Dt</td>
									<td  style="border:1px solid #cdcdcd;">Date</td>
									<td  style="border:1px solid #cdcdcd;">Purpose</td>
									<td  style="border:1px solid #cdcdcd;">Media</td>
									<td  style="border:1px solid #cdcdcd;">No Embryo Thawed</td>
									<td  style="border:1px solid #cdcdcd;">Thawing Path</td>
									<td  style="border:1px solid #cdcdcd;">No Embryo recovered</td>
									
					        	</tr>
					        </thead>
							
							
							
	<thead>
	<tr>						
	
	
								  
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2'])?$select_result['grade_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2'])?$select_result['frag_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0'])?$select_result['date_0']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0'])?$select_result['media_0']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0'])?$select_result['container_no_0']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no'])?$select_result['straw_no']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color'])?$select_result['color']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0'])?$select_result['embryos_frozen_0']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt'])?$select_result['storage_renewal_dt']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1'])?$select_result['date_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0'])?$select_result['purpose_0']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1'])?$select_result['media_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed'])?$select_result['no_embryo_thawed']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path'])?$select_result['thawing_path']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered'])?$select_result['no_embryo_recovered']:""; ?></td>
							    	
								   
								   
								   </tr>
					        </thead>
							<thead>
					        	<tr>
								
								
								

								   
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_1'])?$select_result['grade_2_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_1'])?$select_result['frag_2_1']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_1'])?$select_result['date_0_1']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_1'])?$select_result['media_0_1']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_1'])?$select_result['container_no_0_1']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_1'])?$select_result['straw_no_1']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_1'])?$select_result['color_1']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_1'])?$select_result['embryos_frozen_0_1']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_1'])?$select_result['storage_renewal_dt_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_1'])?$select_result['date_1_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_1'])?$select_result['purpose_0_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_1'])?$select_result['media_1_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_1'])?$select_result['no_embryo_thawed_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_1'])?$select_result['thawing_path_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_1'])?$select_result['no_embryo_recovered_1']:""; ?></td>
							    	
									
									
				</tr>				   
			</thead>
					        <thead>
					        	<tr>

                         
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_2'])?$select_result['grade_2_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_2'])?$select_result['frag_2_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_2'])?$select_result['date_0_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_2'])?$select_result['media_0_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_2'])?$select_result['container_no_0_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_2'])?$select_result['straw_no_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_2'])?$select_result['color_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_2'])?$select_result['embryos_frozen_0_2']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_2'])?$select_result['storage_renewal_dt_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_2'])?$select_result['date_1_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_2'])?$select_result['purpose_0_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_2'])?$select_result['media_1_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_2'])?$select_result['no_embryo_thawed_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_2'])?$select_result['thawing_path_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_2'])?$select_result['no_embryo_recovered_2']:""; ?></td>
							    								
				 </tr>				   
			</thead>
			
			  <thead>
			<tr>
			
			
				
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_2_3'])?$select_result['grade_2_3']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_3'])?$select_result['frag_2_3']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_3'])?$select_result['date_0_3']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_3'])?$select_result['media_0_3']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_3'])?$select_result['container_no_0_3']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_3'])?$select_result['straw_no_3']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_3'])?$select_result['color_3']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_3'])?$select_result['embryos_frozen_0_3']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_3'])?$select_result['storage_renewal_dt_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_3'])?$select_result['date_1_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_3'])?$select_result['purpose_0_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_3'])?$select_result['media_1_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_3'])?$select_result['no_embryo_thawed_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_3'])?$select_result['thawing_path_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_3'])?$select_result['no_embryo_recovered_3']:""; ?></td>
							    	
								   
			 </tr>				   
			</thead>
			
			  <thead>
			<tr>					   
				

							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_4'])?$select_result['grade_2_4']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_4'])?$select_result['frag_2_4']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_4'])?$select_result['date_0_4']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_4'])?$select_result['media_0_4']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_4'])?$select_result['container_no_0_4']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_4'])?$select_result['straw_no_4']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_4'])?$select_result['color_4']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_4'])?$select_result['embryos_frozen_0_4']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_4'])?$select_result['storage_renewal_dt_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_4'])?$select_result['date_1_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_4'])?$select_result['purpose_0_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_4'])?$select_result['media_1_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_4'])?$select_result['no_embryo_thawed_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_4'])?$select_result['thawing_path_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_4'])?$select_result['no_embryo_recovered_4']:""; ?></td>
							    	
 </tr>				   
			</thead>	

<thead>
<tr>
  
							       <td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['grade_2_5'])?$select_result['grade_2_5']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_5'])?$select_result['frag_2_5']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_5'])?$select_result['date_0_5']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_5'])?$select_result['media_0_5']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_5'])?$select_result['container_no_0_5']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_5'])?$select_result['straw_no_5']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_5'])?$select_result['color_5']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_5'])?$select_result['embryos_frozen_0_5']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_5'])?$select_result['storage_renewal_dt_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_5'])?$select_result['date_1_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_5'])?$select_result['purpose_0_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_5'])?$select_result['media_1_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_5'])?$select_result['no_embryo_thawed_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_5'])?$select_result['thawing_path_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_5'])?$select_result['no_embryo_recovered_5']:""; ?></td>
							    
					        	</tr>
					        </thead>
	<thead>
	<tr>	


							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_6'])?$select_result['grade_2_6']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_6'])?$select_result['frag_2_6']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_6'])?$select_result['date_0_6']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_6'])?$select_result['media_0_6']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_6'])?$select_result['container_no_0_6']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_6'])?$select_result['straw_no_6']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_6'])?$select_result['color_6']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_6'])?$select_result['embryos_frozen_0_6']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_6'])?$select_result['storage_renewal_dt_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_6'])?$select_result['date_1_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_6'])?$select_result['purpose_0_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_6'])?$select_result['media_1_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_6'])?$select_result['no_embryo_thawed_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_6'])?$select_result['thawing_path_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_6'])?$select_result['no_embryo_recovered_6']:""; ?></td>
							    	
					        	</tr>
					        </thead>	
							
							
	<thead>
	<tr>

								  
							       <td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['grade_2_7'])?$select_result['grade_2_7']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_7'])?$select_result['frag_2_7']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_7'])?$select_result['date_0_7']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_7'])?$select_result['media_0_7']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_7'])?$select_result['container_no_0_7']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_7'])?$select_result['straw_no_7']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_7'])?$select_result['color_7']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_7'])?$select_result['embryos_frozen_0_7']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_7'])?$select_result['storage_renewal_dt_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_7'])?$select_result['date_1_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_7'])?$select_result['purpose_0_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_7'])?$select_result['media_1_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_7'])?$select_result['no_embryo_thawed_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_7'])?$select_result['thawing_path_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_7'])?$select_result['no_embryo_recovered_7']:""; ?></td>
							    	
					        	</tr>
					        </thead>	
							
							
	<thead>
	<tr>
	
	
	
								
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_8'])?$select_result['grade_2_8']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_8'])?$select_result['frag_2_8']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_8'])?$select_result['date_0_8']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_8'])?$select_result['media_0_8']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_8'])?$select_result['container_no_0_8']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_8'])?$select_result['straw_no_8']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_8'])?$select_result['color_8']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_8'])?$select_result['embryos_frozen_0_8']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_8'])?$select_result['storage_renewal_dt_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_8'])?$select_result['date_1_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_8'])?$select_result['purpose_0_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_8'])?$select_result['media_1_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_8'])?$select_result['no_embryo_thawed_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_8'])?$select_result['thawing_path_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_8'])?$select_result['no_embryo_recovered_8']:""; ?></td>
							    	
					        	</tr>
					        </thead>
	<thead>
	<tr>
	
	 
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_9'])?$select_result['grade_2_9']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_9'])?$select_result['frag_2_9']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_9'])?$select_result['date_0_9']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_9'])?$select_result['media_0_9']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_9'])?$select_result['container_no_0_9']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_9'])?$select_result['straw_no_9']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_9'])?$select_result['color_9']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_9'])?$select_result['embryos_frozen_0_9']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_9'])?$select_result['storage_renewal_dt_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_9'])?$select_result['date_1_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_9'])?$select_result['purpose_0_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_9'])?$select_result['media_1_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_9'])?$select_result['no_embryo_thawed_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_9'])?$select_result['thawing_path_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_9'])?$select_result['no_embryo_recovered_9']:""; ?></td>
							    	
					        	</tr>
					        </thead>
	<thead>
	<tr>
	
                            <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['frag_2_10'])?$select_result['frag_2_10']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_10'])?$select_result['date_0_10']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_10'])?$select_result['media_0_10']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_10'])?$select_result['container_no_0_10']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_10'])?$select_result['straw_no_10']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_10'])?$select_result['color_10']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_10'])?$select_result['embryos_frozen_0_10']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_10'])?$select_result['storage_renewal_dt_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_10'])?$select_result['date_1_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_10'])?$select_result['purpose_0_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_10'])?$select_result['media_1_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_10'])?$select_result['no_embryo_thawed_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_10'])?$select_result['thawing_path_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_10'])?$select_result['no_embryo_recovered_10']:""; ?></td>
							    	
					        	</tr>
					        </thead>
<thead>
<tr>	


							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_11'])?$select_result['grade_2_11']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_11'])?$select_result['frag_2_11']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_11'])?$select_result['date_0_11']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_11'])?$select_result['media_0_11']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_11'])?$select_result['container_no_0_11']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_11'])?$select_result['straw_no_11']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_11'])?$select_result['color_11']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_11'])?$select_result['embryos_frozen_0_11']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_11'])?$select_result['storage_renewal_dt_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_11'])?$select_result['date_1_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_11'])?$select_result['purpose_0_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_11'])?$select_result['media_1_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_11'])?$select_result['no_embryo_thawed_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_11'])?$select_result['thawing_path_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_11'])?$select_result['no_embryo_recovered_11']:""; ?></td>
							    
					        	</tr>
					        </thead>
	 <thead>
	<tr>
	
	 
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_12'])?$select_result['grade_2_12']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_12'])?$select_result['frag_2_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_12'])?$select_result['date_0_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_12'])?$select_result['media_0_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_12'])?$select_result['container_no_0_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_12'])?$select_result['straw_no_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_12'])?$select_result['color_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_12'])?$select_result['embryos_frozen_0_12']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_12'])?$select_result['storage_renewal_dt_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_12'])?$select_result['date_1_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_12'])?$select_result['purpose_0_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_12'])?$select_result['media_1_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_12'])?$select_result['no_embryo_thawed_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_12'])?$select_result['thawing_path_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_12'])?$select_result['no_embryo_recovered_12']:""; ?></td>
							    	
					        	</tr>
					        </thead>
	  <thead>
		<tr>
		
	 
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_13'])?$select_result['grade_2_13']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_13'])?$select_result['frag_2_13']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_13'])?$select_result['date_0_13']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_13'])?$select_result['media_0_13']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_13'])?$select_result['container_no_0_13']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_13'])?$select_result['straw_no_13']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_13'])?$select_result['color_13']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_13'])?$select_result['embryos_frozen_0_13']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_13'])?$select_result['storage_renewal_dt_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_13'])?$select_result['date_1_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_13'])?$select_result['purpose_0_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_13'])?$select_result['media_1_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_13'])?$select_result['no_embryo_thawed_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_13'])?$select_result['thawing_path_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_13'])?$select_result['no_embryo_recovered_13']:""; ?></td>
							    
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>	
		

								 
							       <td  style="border:1px solid #cdcdcd; height:30px;"><?php echo isset($select_result['grade_2_14'])?$select_result['grade_2_14']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_14'])?$select_result['frag_2_14']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_14'])?$select_result['date_0_14']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_14'])?$select_result['media_0_14']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_14'])?$select_result['container_no_0_14']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_14'])?$select_result['straw_no_14']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_14'])?$select_result['color_14']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_14'])?$select_result['embryos_frozen_0_14']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_14'])?$select_result['storage_renewal_dt_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_14'])?$select_result['date_1_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_14'])?$select_result['purpose_0_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_14'])?$select_result['media_1_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_14'])?$select_result['no_embryo_thawed_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_14'])?$select_result['thawing_path_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_14'])?$select_result['no_embryo_recovered_14']:""; ?></td>
							    	
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>
								

<td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['grade_2_15'])?$select_result['grade_2_15']:""; ?>  </td>
	<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_15'])?$select_result['frag_2_15']:""; ?></td>
 <td style="border:1px solid #cdcdcd; "><?php echo isset($select_result['date_0_15'])?$select_result['date_0_15']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_15'])?$select_result['media_0_15']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_15'])?$select_result['container_no_0_15']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_15'])?$select_result['straw_no_15']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_15'])?$select_result['color_15']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_15'])?$select_result['embryos_frozen_0_15']:""; ?></td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_15'])?$select_result['storage_renewal_dt_15']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_15'])?$select_result['date_1_15']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_15'])?$select_result['purpose_0_15']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_15'])?$select_result['media_1_15']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_15'])?$select_result['no_embryo_thawed_15']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_15'])?$select_result['thawing_path_15']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_15'])?$select_result['no_embryo_recovered_15']:""; ?> </td>
	</tr>
					        </thead>
					        <thead>
					        	<tr>


			

 <td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['stage_16'])?$select_result['stage_16']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['grade_2_16'])?$select_result['grade_2_16']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_16'])?$select_result['frag_2_16']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_16'])?$select_result['date_0_16']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_16'])?$select_result['media_0_16']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_16'])?$select_result['container_no_0_16']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_16'])?$select_result['straw_no_16']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_16'])?$select_result['color_16']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_16'])?$select_result['embryos_frozen_0_16']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_16'])?$select_result['storage_renewal_dt_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_16'])?$select_result['date_1_16']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_16'])?$select_result['purpose_0_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_16'])?$select_result['media_1_16']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_16'])?$select_result['no_embryo_thawed_16']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_16'])?$select_result['thawing_path_16']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_16'])?$select_result['no_embryo_recovered_16']:""; ?></td>
			
								</tr>
					        </thead>
					        <thead>
					        	<tr>



							       <td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['grade_2_17'])?$select_result['grade_2_17']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_17'])?$select_result['frag_2_17']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_17'])?$select_result['date_0_17']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_17'])?$select_result['media_0_17']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_17'])?$select_result['container_no_0_17']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_17'])?$select_result['straw_no_17']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_17'])?$select_result['color_17']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_17'])?$select_result['embryos_frozen_0_17']:""; ?></td>
							      <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_17'])?$select_result['storage_renewal_dt_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_17'])?$select_result['date_1_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_17'])?$select_result['purpose_0_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_17'])?$select_result['media_1_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_17'])?$select_result['no_embryo_thawed_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_17'])?$select_result['thawing_path_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_17'])?$select_result['no_embryo_recovered_17']:""; ?></td>
							    	
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>	




<td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['grade_2_18'])?$select_result['grade_2_18']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_18'])?$select_result['frag_2_18']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_18'])?$select_result['date_0_18']:""; ?></td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_18'])?$select_result['media_0_18']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_18'])?$select_result['container_no_0_18']:""; ?></td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_18'])?$select_result['straw_no_18']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_18'])?$select_result['color_18']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_18'])?$select_result['embryos_frozen_0_18']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_18'])?$select_result['storage_renewal_dt_18']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_18'])?$select_result['date_1_18']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_18'])?$select_result['purpose_0_18']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_18'])?$select_result['media_1_18']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_18'])?$select_result['no_embryo_thawed_18']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_18'])?$select_result['thawing_path_18']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_18'])?$select_result['no_embryo_recovered_18']:""; ?></td>
							    	
					        	</tr>
					        </thead>
					        <thead>
					        	<tr>




<td style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['grade_2_19'])?$select_result['grade_2_19']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_19'])?$select_result['frag_2_19']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_19'])?$select_result['date_0_19']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_19'])?$select_result['media_0_19']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_19'])?$select_result['container_no_0_19']:""; ?></td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_19'])?$select_result['straw_no_19']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_19'])?$select_result['color_19']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_19'])?$select_result['embryos_frozen_0_19']:""; ?></td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_dt_19'])?$select_result['storage_renewal_dt_19']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_19'])?$select_result['date_1_19']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_19'])?$select_result['purpose_0_19']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_19'])?$select_result['media_1_19']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_19'])?$select_result['no_embryo_thawed_19']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_19'])?$select_result['thawing_path_19']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_19'])?$select_result['no_embryo_recovered_19']:""; ?></td>

					        	</tr>
					        </thead>
<thead>
<tr>


<td  style="border:1px solid #cdcdcd;height:30px;"><?php echo isset($select_result['grade_2_20'])?$select_result['grade_2_20']:""; ?>  </td>
	<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['frag_2_20'])?$select_result['frag_2_20']:""; ?>  </td>
<td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_0_20'])?$select_result['date_0_20']:""; ?></td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_0_20'])?$select_result['media_0_20']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['container_no_0_20'])?$select_result['container_no_0_20']:""; ?></td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['straw_no_20'])?$select_result['straw_no_20']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['color_20'])?$select_result['color_20']:""; ?>  </td>
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_frozen_0_20'])?$select_result['embryos_frozen_0_20']:""; ?></td>
<td style="background: #F2F2F2"><?php echo isset($select_result['storage_renewal_dt_20'])?$select_result['storage_renewal_dt_20']:""; ?></td>
	<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_1_20'])?$select_result['date_1_20']:""; ?></td>
	 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['purpose_0_20'])?$select_result['purpose_0_20']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_1_20'])?$select_result['media_1_20']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_thawed_20'])?$select_result['no_embryo_thawed_20']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"> <?php echo isset($select_result['thawing_path_20'])?$select_result['thawing_path_20']:""; ?> </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['no_embryo_recovered_20'])?$select_result['no_embryo_recovered_20']:""; ?></td>

					        	</tr>
					        </thead>
					    </table>	



<table class="table table-bordered table-hover mt-2 table-sm red-field" style="width:100%; border:1px solid #cdcdcd;"  >

 <thead>
					        	<tr>
					        		
									<th colspan="2" style="border:1px solid #cdcdcd;">LAH</th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">DISCARD</th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">REMARKS</th>
									
									 </tr>
					        </thead>
							
							
							
					     
<thead>
<tr>
<th colspan="2" style="border:1px solid #cdcdcd;height:30px;">Date: <?php echo isset($select_result['date8'])?$select_result['date8']:""; ?></th>
<th colspan="2" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date9'])?$select_result['date9']:""; ?></th>
<th colspan="2" style="border:1px solid #cdcdcd;">Date: <?php echo isset($select_result['date10'])?$select_result['date10']:""; ?></th>
</tr>
</thead>

<thead>
<tr>
	
<th colspan="2" style="border:1px solid #cdcdcd;height:30px;">Time: <?php echo isset($select_result['time8'])?$select_result['time8']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time9'])?$select_result['time9']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Time: <?php echo isset($select_result['time10'])?$select_result['time10']:""; ?></th>
					        	</tr>
					        </thead>	
							
<thead>
<tr>

	<th colspan="2" style="border:1px solid #cdcdcd;height:30px;">Hrs: <?php echo isset($select_result['hrs6'])?$select_result['hrs6']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Hrs: <?php echo isset($select_result['hrs7'])?$select_result['hrs7']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Hrs: <?php echo isset($select_result['hrs8'])?$select_result['hrs8']:""; ?></th>
</tr>
</thead>
 
 
<thead>
<tr>

<th colspan="2" style="border:1px solid #cdcdcd;height:30px;">Emb: <?php echo isset($select_result['emb7'])?$select_result['emb7']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb8'])?$select_result['emb8']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Emb: <?php echo isset($select_result['emb9'])?$select_result['emb9']:""; ?></th>
									
</tr>
</thead>
 
 
<thead>
<tr>

	<th colspan="2" style="border:1px solid #cdcdcd;height:30px;">Wit: <?php echo isset($select_result['wit5'])?$select_result['wit5']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Wit: <?php echo isset($select_result['wit6'])?$select_result['wit6']:""; ?></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;">Wit: <?php echo isset($select_result['wit7'])?$select_result['wit7']:""; ?></th>

</tr>
</thead>
 
 
<thead>
<tr>

<th colspan="2" style="padding: 0; border:1px solid #cdcdcd;height:30px;">
					        			<table style="width:100%; border:1px solid #cdcdcd;" >
					        				<tr>
					        					<td  style="border:1px solid #cdcdcd;">no.of embryos hatched</td>
					        					<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['embryos_hatched'])?$select_result['embryos_hatched']:""; ?></td>
					        				</tr>
					        			</table>
					        		</th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;"></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;"></th>	

</tr>
</thead>
 
 
<thead>
<tr>

	<th colspan="2" style="border:1px solid #cdcdcd;height:30px;">
					        			
											<?php if(!empty($upload_photo_5)) {?>
				 <img src="<?php echo $upload_photo_5;?>" style="width:100px; height:100px;">
					<?php } else {echo " ";}?>	
										
										
					        		</th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;"></th>
					        		<th colspan="2" style="border:1px solid #cdcdcd;"></th>	

</tr>
</thead>
 
 
<thead>
<tr>

                 <td  style="border:1px solid #cdcdcd;"></td>
									<td  style="border:1px solid #cdcdcd;"></td>
									<td  style="border:1px solid #cdcdcd;">Date</td>
									<td  style="border:1px solid #cdcdcd;">Reason</td>
									<td  style="border:1px solid #cdcdcd;"></td>
									<td  style="border:1px solid #cdcdcd;"></td>	

</tr>
</thead>
 
 
<thead>
<tr>

                         <td  style="border:1px solid #cdcdcd;height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2'])?$select_result['date_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason'])?$select_result['reason']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0'])?$select_result['empty_0']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1'])?$select_result['empty_1']:""; ?></td>	

</tr>
</thead>
 
 
<thead>
<tr>
<td  style="border:1px solid #cdcdcd;height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_1'])?$select_result['date_2_1']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_1'])?$select_result['reason_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_1'])?$select_result['empty_0_1']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_1'])?$select_result['empty_1_1']:""; ?></td>	


</tr>
</thead>
 
 
<thead>
<tr>

<td  style="border:1px solid #cdcdcd;height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_2'])?$select_result['date_2_2']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_2'])?$select_result['reason_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_2'])?$select_result['empty_0_2']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_2'])?$select_result['empty_1_2']:""; ?></td>	
</tr>
</thead>
 
 
<thead>
<tr>

<td  style="border:1px solid #cdcdcd;height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_3'])?$select_result['date_2_3']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_3'])?$select_result['reason_3']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_3'])?$select_result['empty_0_3']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_3'])?$select_result['empty_1_3']:""; ?></td>	
</tr>
</thead>
 
 
<thead>
<tr>								   
<td  style="border:1px solid #cdcdcd;height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_4'])?$select_result['date_2_4']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_4'])?$select_result['reason_4']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_4'])?$select_result['empty_0_4']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_4'])?$select_result['empty_1_4']:""; ?></td>
</tr>
</thead>
  
<thead>
<tr>

	<td  style="border:1px solid #cdcdcd;height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_5'])?$select_result['date_2_5']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_5'])?$select_result['reason_5']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_5'])?$select_result['empty_0_5']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_5'])?$select_result['empty_1_5']:""; ?></td>
								   
</tr>
</thead>
  
<thead>
<tr>

<td  style="border:1px solid #cdcdcd;height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_6'])?$select_result['date_2_6']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_6'])?$select_result['reason_6']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_6'])?$select_result['empty_0_6']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_6'])?$select_result['empty_1_6']:""; ?></td>	

</tr>
</thead>
  
<thead>
<tr>

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_7'])?$select_result['date_2_7']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_7'])?$select_result['reason_7']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_7'])?$select_result['empty_0_7']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_7'])?$select_result['empty_1_7']:""; ?></td>		

</tr>
</thead>
  
<thead>
<tr>	

          <td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_8'])?$select_result['date_2_8']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_8'])?$select_result['reason_8']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_8'])?$select_result['empty_0_8']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_8'])?$select_result['empty_1_8']:""; ?></td>	
</tr>
</thead>
  
<thead>
<tr>	


<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_9'])?$select_result['date_2_9']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_9'])?$select_result['reason_9']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_9'])?$select_result['empty_0_9']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_9'])?$select_result['empty_1_9']:""; ?></td>	
</tr>
</thead>
  
<thead>
<tr>	

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_10'])?$select_result['date_2_10']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_10'])?$select_result['reason_10']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_10'])?$select_result['empty_0_10']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_10'])?$select_result['empty_1_10']:""; ?></td>	

</tr>
</thead>
  
<thead>
<tr>	

	<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_11'])?$select_result['date_2_11']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_11'])?$select_result['reason_11']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_11'])?$select_result['empty_0_11']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_11'])?$select_result['empty_1_11']:""; ?></td>
</tr>
</thead>
  
<thead>
<tr>	

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_12'])?$select_result['date_2_12']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_12'])?$select_result['reason_12']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_12'])?$select_result['empty_0_12']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_12'])?$select_result['empty_1_12']:""; ?></td>
</tr>
</thead>
  
<thead>
<tr>	

	<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_13'])?$select_result['date_2_13']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_13'])?$select_result['reason_13']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_13'])?$select_result['empty_0_13']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_13'])?$select_result['empty_1_13']:""; ?></td>
</tr>
</thead>
  
<thead>
<tr>

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_14'])?$select_result['date_2_14']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_14'])?$select_result['reason_14']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_14'])?$select_result['empty_0_14']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_14'])?$select_result['empty_1_14']:""; ?></td>	


</tr>
</thead>
  
<thead>
<tr>


<td  style="border:1px solid #cdcdcd; height:30px;"></td>
<td  style="border:1px solid #cdcdcd;"></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_15'])?$select_result['date_2_15']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_15'])?$select_result['reason_15']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_15'])?$select_result['empty_0_15']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_15'])?$select_result['empty_1_15']:""; ?></td>
</tr>
</thead>
  
<thead>
<tr>

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
<td  style="border:1px solid #cdcdcd;"></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_16'])?$select_result['date_2_16']:""; ?></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_16'])?$select_result['reason_16']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_16'])?$select_result['empty_0_16']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_16'])?$select_result['empty_1_16']:""; ?></td>

</tr>
</thead>
  
<thead>
<tr>
	

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_17'])?$select_result['date_2_17']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_17'])?$select_result['reason_17']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_17'])?$select_result['empty_0_17']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_17'])?$select_result['empty_1_17']:""; ?></td>	
								   
</tr>
</thead>
  
<thead>
<tr>

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
							    	<td  style="border:1px solid #cdcdcd;"></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_18'])?$select_result['date_2_18']:""; ?></td>
							        <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_18'])?$select_result['reason_18']:""; ?></td>
							       <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_18'])?$select_result['empty_0_18']:""; ?></td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_18'])?$select_result['empty_1_18']:""; ?></td>
</tr>
</thead>
  
<thead>
<tr>

<td  style="border:1px solid #cdcdcd; height:30px;"></td>
<td  style="border:1px solid #cdcdcd;"></td>
 <td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['date_2_19'])?$select_result['date_2_19']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['reason_19'])?$select_result['reason_19']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_0_19'])?$select_result['empty_0_19']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd;"><?php echo isset($select_result['empty_1_19'])?$select_result['empty_1_19']:""; ?> </td> </tr>
</thead>
  
<thead>
<tr> 

	<td  style="border:1px solid #cdcdcd; height:30px;"></td>
	<td  style="border:1px solid #cdcdcd; min-height:20px;"></td>
	 <td  style="border:1px solid #cdcdcd; min-height:20px;"><?php echo isset($select_result['date_2_20'])?$select_result['date_2_20']:""; ?>  </td>
 <td  style="border:1px solid #cdcdcd; min-height:20px;"> <?php echo isset($select_result['reason_20'])?$select_result['reason_20']:""; ?></td>
	<td  style="border:1px solid #cdcdcd; min-height:20px;"> <?php echo isset($select_result['empty_0_20'])?$select_result['empty_0_20']:""; ?>  </td>
<td  style="border:1px solid #cdcdcd; min-height:20px;"> <?php echo isset($select_result['empty_1_20'])?$select_result['empty_1_20']:""; ?>  </td>

 </tr>
</thead>
  


</table>								   
								   
					



		
				
	<table class="table table-bordered table-hover mt-2 table-sm red-field"  style="width:100%; border:1px solid #cdcdcd;">
							<ul><li>Emb/Gr = Embryo/Grade</li></ul>
					    	<thead>
						        <th  style="border:1px solid #cdcdcd;"> Embryo Grading (Fragmentation): 1- Best </th>
					    	</thead>
					    	<thead>
					        	<th  style="border:1px solid #cdcdcd;"> Day 3 </th>
					         	<th  style="border:1px solid #cdcdcd;"> 1</th>
					          	<th  style="border:1px solid #cdcdcd;">2 </th>
					           	<th  style="border:1px solid #cdcdcd;">3 </th>
					           	<th  style="border:1px solid #cdcdcd;">4</th>
					    	</thead>
					    	<thead>
					        	<th  style="border:1px solid #cdcdcd;"> Fragmentation</th>
					         	<th  style="border:1px solid #cdcdcd;"> No Fragmentation</th>
					          	<th  style="border:1px solid #cdcdcd;">0-20%</th>
					           	<th  style="border:1px solid #cdcdcd;">20-30% </th>
					           	<th  style="border:1px solid #cdcdcd;">50-100%</th>
					    	</thead>
					    	<thead>
						        <th  style="border:1px solid #cdcdcd;">Blastocyst Grade (Expansion): 4&A- Best,1 &D -Poor </th>
						    </thead>
					    	<thead>
					        	<th  style="border:1px solid #cdcdcd;"> Grade </th>
					         	<th  style="border:1px solid #cdcdcd;"> 1</th>
					          	<th  style="border:1px solid #cdcdcd;">2 </th>
					           	<th  style="border:1px solid #cdcdcd;">3 </th>
					           	<th  style="border:1px solid #cdcdcd;">4</th>
					    	</thead>
					    	<thead>
					         	<th  style="border:1px solid #cdcdcd;">ICM</th>
					          	<th  style="border:1px solid #cdcdcd;">A</th>
					           	<th  style="border:1px solid #cdcdcd;">B</th>
					           	<th  style="border:1px solid #cdcdcd;">C</th>
					           	<th  style="border:1px solid #cdcdcd;">D</th>
					    	</thead>
					    	<thead>
					         	<th  style="border:1px solid #cdcdcd;"> Trophoblast</th>
					          	<th  style="border:1px solid #cdcdcd;">A</th>
					           	<th  style="border:1px solid #cdcdcd;">B</th>
					           	<th  style="border:1px solid #cdcdcd;">C</th>
					           	<th  style="border:1px solid #cdcdcd;">D</th>
					    	</thead>
					    </table>
				
				 
	
</div>
 			
						
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
			