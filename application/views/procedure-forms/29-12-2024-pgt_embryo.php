<?php

    // php code to Insert data into mysql database from input text

    if(isset($_POST['submit'])){

        unset($_POST['submit']);

      $wife_name  = $_POST['wife_name'];
	  $husband_name  = $_POST['husband_name'];
      $wife_phone  = $_POST['wife_phone'];
	  $wife_age  = $_POST['wife_age'];
	  $wife_address  = $_POST['wife_address'];
	  $female_pregnancy_other_p  = $_POST['female_pregnancy_other_p'];
	  $female_pregnancy_other_l  = $_POST['female_pregnancy_other_l'];
	  $female_pregnancy_other_a  = $_POST['female_pregnancy_other_a'];
	  $details_management_advised  = $_POST['details_management_advised'];
	  $IVF_Consultant  = $_POST['IVF_Consultant'];
	  $center  = $_POST['center'];
	  
	  unset($_POST['wife_name']);
      unset($_POST['wife_phone']);
	  unset($_POST['husband_name']);
      unset($_POST['wife_age']);
	  unset($_POST['wife_address']);
	  unset($_POST['female_pregnancy_other_p']);
	  unset($_POST['female_pregnancy_other_l']);
	  unset($_POST['female_pregnancy_other_a']);
	  unset($_POST['details_management_advised']);
	  unset($_POST['IVF_Consultant']);
	  unset($_POST['center']);
        

        $select_query = "SELECT * FROM `pgt_embryo` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";

        $select_result = run_select_query($select_query); 

        if(empty($select_result)){

            // mysql query to insert data

            $query = "INSERT INTO `pgt_embryo` SET ";

            $sqlArr = array();

            foreach( $_POST as $key=> $value )

            {

              $sqlArr[] = " $key = '".addslashes($value)."'";

            }		

            $query .= implode(',' , $sqlArr);
            //Insert into pcp_ndt table
			 $query2 = "INSERT INTO `pcp_ndt` (iic_id, wife_name, husband_name, wife_phone, wife_age, wife_address, female_pregnancy_other_p, female_pregnancy_other_l, female_pregnancy_other_a, details_management_advised, IVF_Consultant, further_referredfor_dellvery, outcome_of_pregnancy, malformation_in_newborn, center, test_type, date) values 
		   ('$iic_id','$wife_name', '$husband_name', '$wife_phone', '$wife_age', '$wife_address', 'P:$female_pregnancy_other_p', 'L:$female_pregnancy_other_l', 'A:$female_pregnancy_other_a', '$details_management_advised','$IVF_Consultant', '$further_referredfor_dellvery', '$outcome_of_pregnancy', '$malformation_in_newborn', '$center', 'PGT','" . date('Y-m-d h:i:s') . "')";
            $result2 = run_form_query($query2);
        }else{

            // mysql query to update data

            $query = "UPDATE pgt_embryo SET ";

            foreach( $_POST as $key=> $value )

            {

              $sqlArr[] = " $key = '".$value."'"	;

            }

            $query .= implode(',' , $sqlArr);

            $query .= " WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";

        }

        // echo $query;die;

        $result = run_form_query($query);        

        // echo $result;die;

       if($result){

          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Procedure form inserted!').'&t='.base64_encode('success'));

					die();

        }else{

          header("location:" .$_SERVER['HTTP_REFERER']."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));

					die();

        }

    }

    $select_query = "SELECT * FROM `pgt_embryo` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";

    $select_result = run_select_query($select_query);  

    // var_dump($select_result);die;

	

?>



<!--<?php

// php code to Insert data into mysql database from input text

// if(isset($_POST['submit'])){

// $patient_id = $_POST['patient_id'];

// $receipt_number = $_POST['receipt_number'];

// $status = $_POST['status'];



// // get values form input text and number

// $partners_name = $_POST['partners_name'];

// $art_bank_reg_no = $_POST['art_bank_reg_no'];

// $form_id = $_POST['form_id'];

// $donor_d = $_POST['donor_d'];

// $pgt_a_date = $_POST['pgt_a_date'];

// $pgt_m_date = $_POST['pgt_m_date'];

// $pgt_sr_date = $_POST['pgt_sr_date'];

// $pgt_a_time = $_POST['pgt_a_time'];

// $pgt_m_time = $_POST['pgt_m_time'];

// $pgt_sr_time = $_POST['pgt_sr_time'];

// $pgt_a_embryologist = $_POST['pgt_a_embryologist'];

// $pgt_m_embryologist = $_POST['pgt_m_embryologist'];

// $pgt_sr_embryologist = $_POST['pgt_sr_embryologist'];

// $pgt_a_witness = $_POST['pgt_a_witness'];

// $pgt_m_witness = $_POST['pgt_m_witness'];

// $pgt_sr_witness = $_POST['pgt_sr_witness'];

// $pgt_a_doctor = $_POST['pgt_a_doctor'];

// $pgt_m_doctor = $_POST['pgt_m_doctor'];

// $pgt_sr_doctor = $_POST['pgt_sr_doctor'];

// $pgt_a_tnofembryo = $_POST['pgt_a_tnofembryo'];

// $pgt_m_tnofembryo = $_POST['pgt_m_tnofembryo'];

// $pgt_sr_tnofembryo = $_POST['pgt_sr_tnofembryo'];

// $pgt_a_embryo_sent = $_POST['pgt_a_embryo_sent'];

// $pgt_m_embryo_sent = $_POST['pgt_m_embryo_sent'];

// $pgt_sr_embryo_sent = $_POST['pgt_sr_embryo_sent'];

// $pgt_a_biopsy_perform = $_POST['pgt_a_biopsy_perform'];

// $pgt_m_biopsy_perform = $_POST['pgt_m_biopsy_perform'];

// $pgt_sr_biopsy_perform = $_POST['pgt_sr_biopsy_perform'];

// $pgt_a_biopsy_total = $_POST['pgt_a_biopsy_total'];

// $pgt_m_biopsy_total = $_POST['pgt_m_biopsy_total'];

// $pgt_sr_biopsy_total = $_POST['pgt_sr_biopsy_total'];

// $pgt_a_0 = $_POST['pgt_a_0'];

// $pgt_a_1 = $_POST['pgt_a_1'];

// $pgt_a_2 = $_POST['pgt_a_2'];

// $pgt_a_3 = $_POST['pgt_a_3'];

// $pgt_a_4 = $_POST['pgt_a_4'];

// $pgt_a_5 = $_POST['pgt_a_5'];

// $pgt_a_6 = $_POST['pgt_a_6'];

// $pgt_m_0 = $_POST['pgt_m_0'];

// $pgt_m_1 = $_POST['pgt_m_1'];

// $pgt_m_2 = $_POST['pgt_m_2'];

// $pgt_m_3 = $_POST['pgt_m_3'];

// $pgt_m_4 = $_POST['pgt_m_4'];

// $pgt_m_5 = $_POST['pgt_m_5'];

// $pgt_m_6 = $_POST['pgt_m_6'];

// $pgt_sr_0 = $_POST['pgt_sr_0'];

// $pgt_sr_1 = $_POST['pgt_sr_1'];

// $pgt_sr_2 = $_POST['pgt_sr_2'];

// $pgt_sr_3 = $_POST['pgt_sr_3'];

// $pgt_sr_4 = $_POST['pgt_sr_4'];

// $pgt_sr_5 = $_POST['pgt_sr_5'];

// $pgt_sr_6 = $_POST['pgt_sr_6'];

// $pgt_a1_0 = $_POST['pgt_a1_0'];

// $pgt_a1_1 = $_POST['pgt_a1_1'];

// $pgt_a1_2 = $_POST['pgt_a1_2'];

// $pgt_a1_3 = $_POST['pgt_a1_3'];

// $pgt_a1_4 = $_POST['pgt_a1_4'];

// $pgt_a1_5 = $_POST['pgt_a1_5'];

// $pgt_a1_6 = $_POST['pgt_a1_6'];

// $pgt_a2_0 = $_POST['pgt_a2_0'];

// $pgt_a2_1 = $_POST['pgt_a2_1'];

// $pgt_a2_2 = $_POST['pgt_a2_2'];

// $pgt_a2_3 = $_POST['pgt_a2_3'];

// $pgt_a2_4 = $_POST['pgt_a2_4'];

// $pgt_a2_5 = $_POST['pgt_a2_5'];

// $pgt_a2_6 = $_POST['pgt_a2_6'];

// $pgt_a3_0 = $_POST['pgt_a3_0'];

// $pgt_a3_1 = $_POST['pgt_a3_1'];

// $pgt_a3_2 = $_POST['pgt_a3_2'];

// $pgt_a3_3 = $_POST['pgt_a3_3'];

// $pgt_a3_4 = $_POST['pgt_a3_4'];

// $pgt_a3_5 = $_POST['pgt_a3_5'];

// $pgt_a3_6 = $_POST['pgt_a3_6'];

// $pgt_a4_0 = $_POST['pgt_a4_0'];

// $pgt_a4_1 = $_POST['pgt_a4_1'];

// $pgt_a4_2 = $_POST['pgt_a4_2'];

// $pgt_a4_3 = $_POST['pgt_a4_3'];

// $pgt_a4_4 = $_POST['pgt_a4_4'];

// $pgt_a4_5 = $_POST['pgt_a4_5'];

// $pgt_a4_6 = $_POST['pgt_a4_6'];

// $pgt_a5_0 = $_POST['pgt_a5_0'];

// $pgt_a5_1 = $_POST['pgt_a5_1'];

// $pgt_a5_2 = $_POST['pgt_a5_2'];

// $pgt_a5_3 = $_POST['pgt_a5_3'];

// $pgt_a5_4 = $_POST['pgt_a5_4'];

// $pgt_a5_5 = $_POST['pgt_a5_5'];

// $pgt_a5_6 = $_POST['pgt_a5_6'];

// $pgt_m1_0 = $_POST['pgt_m1_0'];

// $pgt_m1_1 = $_POST['pgt_m1_1'];

// $pgt_m1_2 = $_POST['pgt_m1_2'];

// $pgt_m1_3 = $_POST['pgt_m1_3'];

// $pgt_m1_4 = $_POST['pgt_m1_4'];

// $pgt_m1_5 = $_POST['pgt_m1_5'];

// $pgt_m1_6 = $_POST['pgt_m1_6'];

// $pgt_m2_0 = $_POST['pgt_m2_0'];

// $pgt_m2_1 = $_POST['pgt_m2_1'];

// $pgt_m2_2 = $_POST['pgt_m2_2'];

// $pgt_m2_3 = $_POST['pgt_m2_3'];

// $pgt_m2_4 = $_POST['pgt_m2_4'];

// $pgt_m2_5 = $_POST['pgt_m2_5'];

// $pgt_m2_6 = $_POST['pgt_m2_6'];

// $pgt_m3_0 = $_POST['pgt_m3_0'];

// $pgt_m3_1 = $_POST['pgt_m3_1'];

// $pgt_m3_2 = $_POST['pgt_m3_2'];

// $pgt_m3_3 = $_POST['pgt_m3_3'];

// $pgt_m3_4 = $_POST['pgt_m3_4'];

// $pgt_m3_5 = $_POST['pgt_m3_5'];

// $pgt_m3_6 = $_POST['pgt_m3_6'];

// $pgt_m4_0 = $_POST['pgt_m4_0'];

// $pgt_m4_1 = $_POST['pgt_m4_1'];

// $pgt_m4_2 = $_POST['pgt_m4_2'];

// $pgt_m4_3 = $_POST['pgt_m4_3'];

// $pgt_m4_4 = $_POST['pgt_m4_4'];

// $pgt_m4_5 = $_POST['pgt_m4_5'];

// $pgt_m4_6 = $_POST['pgt_m4_6'];

// $pgt_m5_0 = $_POST['pgt_m5_0'];

// $pgt_m5_1 = $_POST['pgt_m5_1'];

// $pgt_m5_2 = $_POST['pgt_m5_2'];

// $pgt_m5_3 = $_POST['pgt_m5_3'];

// $pgt_m5_4 = $_POST['pgt_m5_4'];

// $pgt_m5_5 = $_POST['pgt_m5_5'];

// $pgt_m5_6 = $_POST['pgt_m5_6'];

// $pgt_sr1_0 = $_POST['pgt_sr1_0'];

// $pgt_sr1_1 = $_POST['pgt_sr1_1'];

// $pgt_sr1_2 = $_POST['pgt_sr1_2'];

// $pgt_sr1_3 = $_POST['pgt_sr1_3'];

// $pgt_sr1_4 = $_POST['pgt_sr1_4'];

// $pgt_sr1_5 = $_POST['pgt_sr1_5'];

// $pgt_sr1_6 = $_POST['pgt_sr1_6'];

// $pgt_sr2_0 = $_POST['pgt_sr2_0'];

// $pgt_sr2_1 = $_POST['pgt_sr2_1'];

// $pgt_sr2_2 = $_POST['pgt_sr2_2'];

// $pgt_sr2_3 = $_POST['pgt_sr2_3'];

// $pgt_sr2_4 = $_POST['pgt_sr2_4'];

// $pgt_sr2_5 = $_POST['pgt_sr2_5'];

// $pgt_sr2_6 = $_POST['pgt_sr2_6'];

// $pgt_sr3_0 = $_POST['pgt_sr3_0'];

// $pgt_sr3_1 = $_POST['pgt_sr3_1'];

// $pgt_sr3_2 = $_POST['pgt_sr3_2'];

// $pgt_sr3_3 = $_POST['pgt_sr3_3'];

// $pgt_sr3_4 = $_POST['pgt_sr3_4'];

// $pgt_sr3_5 = $_POST['pgt_sr3_5'];

// $pgt_sr3_6 = $_POST['pgt_sr3_6'];

// $pgt_sr4_0 = $_POST['pgt_sr4_0'];

// $pgt_sr4_1 = $_POST['pgt_sr4_1'];

// $pgt_sr4_2 = $_POST['pgt_sr4_2'];

// $pgt_sr4_3 = $_POST['pgt_sr4_3'];

// $pgt_sr4_4 = $_POST['pgt_sr4_4'];

// $pgt_sr4_5 = $_POST['pgt_sr4_5'];

// $pgt_sr4_6 = $_POST['pgt_sr4_6'];

// $pgt_sr5_0 = $_POST['pgt_sr5_0'];

// $pgt_sr5_1 = $_POST['pgt_sr5_1'];

// $pgt_sr5_2 = $_POST['pgt_sr5_2'];

// $pgt_sr5_3 = $_POST['pgt_sr5_3'];

// $pgt_sr5_4 = $_POST['pgt_sr5_4'];

// $pgt_sr5_5 = $_POST['pgt_sr5_5'];

// $pgt_sr5_6 = $_POST['pgt_sr5_6'];

// $pgt_a60 = $_POST['pgt_a60'];

// $pgt_m60 = $_POST['pgt_m60'];

// $pgt_sr60 = $_POST['pgt_sr60'];

// $pgt_a61 = $_POST['pgt_a61'];

// $pgt_m61 = $_POST['pgt_m61'];

// $pgt_sr61 = $_POST['pgt_sr61'];

// $pgt_a62 = $_POST['pgt_a62'];

// $pgt_m62 = $_POST['pgt_m62'];

// $pgt_sr62 = $_POST['pgt_sr62'];

// $pgt_a63 = $_POST['pgt_a63'];

// $pgt_m63 = $_POST['pgt_m63'];

// $pgt_sr63 = $_POST['pgt_sr63'];

// $pgt_a64 = $_POST['pgt_a64'];

// $pgt_m64 = $_POST['pgt_m64'];

// $pgt_sr64 = $_POST['pgt_sr64'];

// $pgt_a65 = $_POST['pgt_a65'];

// $pgt_m65 = $_POST['pgt_m65'];

// $pgt_sr65 = $_POST['pgt_sr65'];

// $pgt_a66 = $_POST['pgt_a66'];

// $pgt_m66 = $_POST['pgt_m66'];

// $pgt_sr66 = $_POST['pgt_sr66'];

// $pgt_a70 = $_POST['pgt_a70'];

// $pgt_m70 = $_POST['pgt_m70'];

// $pgt_sr70 = $_POST['pgt_sr70'];

// $pgt_a71 = $_POST['pgt_a71'];

// $pgt_m71 = $_POST['pgt_m71'];

// $pgt_sr71 = $_POST['pgt_sr71'];

// $pgt_a72 = $_POST['pgt_a72'];

// $pgt_m72 = $_POST['pgt_m72'];

// $pgt_sr72 = $_POST['pgt_sr72'];

// $pgt_a73 = $_POST['pgt_a73'];

// $pgt_m73 = $_POST['pgt_m73'];

// $pgt_sr73 = $_POST['pgt_sr73'];

// $pgt_a74 = $_POST['pgt_a74'];

// $pgt_m74 = $_POST['pgt_m74'];

// $pgt_sr74 = $_POST['pgt_sr74'];

// $pgt_a75 = $_POST['pgt_a75'];

// $pgt_m75 = $_POST['pgt_m75'];

// $pgt_sr75 = $_POST['pgt_sr75'];

// $pgt_a76 = $_POST['pgt_a76'];

// $pgt_m76 = $_POST['pgt_m76'];

// $pgt_sr76 = $_POST['pgt_sr76'];

// $pgt_a80 = $_POST['pgt_a80'];

// $pgt_m80 = $_POST['pgt_m80'];

// $pgt_sr80 = $_POST['pgt_sr80'];

// $pgt_a81 = $_POST['pgt_a81'];

// $pgt_m81 = $_POST['pgt_m81'];

// $pgt_sr81 = $_POST['pgt_sr81'];

// $pgt_a82 = $_POST['pgt_a82'];

// $pgt_m82 = $_POST['pgt_m82'];

// $pgt_sr82 = $_POST['pgt_sr82'];

// $pgt_a83 = $_POST['pgt_a83'];

// $pgt_m83 = $_POST['pgt_m83'];

// $pgt_sr83 = $_POST['pgt_sr83'];

// $pgt_a84 = $_POST['pgt_a84'];

// $pgt_m84 = $_POST['pgt_m84'];

// $pgt_sr84 = $_POST['pgt_sr84'];

// $pgt_a85 = $_POST['pgt_a85'];

// $pgt_m85 = $_POST['pgt_m85'];

// $pgt_sr85 = $_POST['pgt_sr85'];

// $pgt_a86 = $_POST['pgt_a86'];

// $pgt_m86 = $_POST['pgt_m86'];

// $pgt_sr86 = $_POST['pgt_sr86'];

// $pgt_a90 = $_POST['pgt_a90'];

// $pgt_m90 = $_POST['pgt_m90'];

// $pgt_sr90 = $_POST['pgt_sr90'];

// $pgt_a91 = $_POST['pgt_a91'];

// $pgt_m91 = $_POST['pgt_m91'];

// $pgt_sr91 = $_POST['pgt_sr91'];

// $pgt_a92 = $_POST['pgt_a92'];

// $pgt_m92 = $_POST['pgt_m92'];

// $pgt_sr92 = $_POST['pgt_sr92'];

// $pgt_a93 = $_POST['pgt_a93'];

// $pgt_m93 = $_POST['pgt_m93'];

// $pgt_sr93 = $_POST['pgt_sr93'];

// $pgt_a94 = $_POST['pgt_a94'];

// $pgt_m94 = $_POST['pgt_m94'];

// $pgt_sr94 = $_POST['pgt_sr94'];

// $pgt_a95 = $_POST['pgt_a95'];

// $pgt_m95 = $_POST['pgt_m95'];

// $pgt_sr95 = $_POST['pgt_sr95'];

// $pgt_a96 = $_POST['pgt_a96'];

// $pgt_m96 = $_POST['pgt_m96'];

// $pgt_sr96 = $_POST['pgt_sr96'];

// $pgt_a100 = $_POST['pgt_a100'];

// $pgt_m100 = $_POST['pgt_m100'];

// $pgt_sr100 = $_POST['pgt_sr100'];

// $pgt_a101 = $_POST['pgt_a101'];

// $pgt_m101 = $_POST['pgt_m101'];

// $pgt_sr101 = $_POST['pgt_sr101'];

// $pgt_a102 = $_POST['pgt_a102'];

// $pgt_m102 = $_POST['pgt_m102'];

// $pgt_sr102 = $_POST['pgt_sr102'];

// $pgt_a103 = $_POST['pgt_a103'];

// $pgt_m103 = $_POST['pgt_m103'];

// $pgt_sr103 = $_POST['pgt_sr103'];

// $pgt_a104 = $_POST['pgt_a104'];

// $pgt_m104 = $_POST['pgt_m104'];

// $pgt_sr104 = $_POST['pgt_sr104'];

// $pgt_a105 = $_POST['pgt_a105'];

// $pgt_m105 = $_POST['pgt_m105'];

// $pgt_sr105 = $_POST['pgt_sr105'];

// $pgt_a106 = $_POST['pgt_a106'];

// $pgt_m106 = $_POST['pgt_m106'];

// $pgt_sr106 = $_POST['pgt_sr106'];

// $pgt_a110 = $_POST['pgt_a110'];

// $pgt_m110 = $_POST['pgt_m110'];

// $pgt_sr110 = $_POST['pgt_sr110'];

// $pgt_a111 = $_POST['pgt_a111'];

// $pgt_m111 = $_POST['pgt_m111'];

// $pgt_sr111 = $_POST['pgt_sr111'];

// $pgt_a112 = $_POST['pgt_a112'];

// $pgt_m112 = $_POST['pgt_m112'];

// $pgt_sr112 = $_POST['pgt_sr112'];

// $pgt_a113 = $_POST['pgt_a113'];

// $pgt_m113 = $_POST['pgt_m113'];

// $pgt_sr113 = $_POST['pgt_sr113'];

// $pgt_a114 = $_POST['pgt_a114'];

// $pgt_m114 = $_POST['pgt_m114'];

// $pgt_sr114 = $_POST['pgt_sr114'];

// $pgt_a115 = $_POST['pgt_a115'];

// $pgt_m115 = $_POST['pgt_m115'];

// $pgt_sr115 = $_POST['pgt_sr115'];

// $pgt_a116 = $_POST['pgt_a116'];

// $pgt_m116 = $_POST['pgt_m116'];

// $pgt_sr116 = $_POST['pgt_sr116'];

// $pgt_a120 = $_POST['pgt_a120'];

// $pgt_m120 = $_POST['pgt_m120'];

// $pgt_sr120 = $_POST['pgt_sr120'];

// $pgt_a121 = $_POST['pgt_a121'];

// $pgt_m121 = $_POST['pgt_m121'];

// $pgt_sr121 = $_POST['pgt_sr121'];

// $pgt_a122 = $_POST['pgt_a122'];

// $pgt_m122 = $_POST['pgt_m122'];

// $pgt_sr122 = $_POST['pgt_sr122'];

// $pgt_a123 = $_POST['pgt_a123'];

// $pgt_m123 = $_POST['pgt_m123'];

// $pgt_sr123 = $_POST['pgt_sr123'];

// $pgt_a124 = $_POST['pgt_a124'];

// $pgt_m124 = $_POST['pgt_m124'];

// $pgt_sr124 = $_POST['pgt_sr124'];

// $pgt_a125 = $_POST['pgt_a125'];

// $pgt_m125 = $_POST['pgt_m125'];

// $pgt_sr125 = $_POST['pgt_sr125'];

// $pgt_a126 = $_POST['pgt_a126'];

// $pgt_m126 = $_POST['pgt_m126'];

// $pgt_sr126 = $_POST['pgt_sr126'];

// $pgt_a130 = $_POST['pgt_a130'];

// $pgt_m130 = $_POST['pgt_m130'];

// $pgt_sr130 = $_POST['pgt_sr130'];

// $pgt_a131 = $_POST['pgt_a131'];

// $pgt_m131 = $_POST['pgt_m131'];

// $pgt_sr131 = $_POST['pgt_sr131'];

// $pgt_a132 = $_POST['pgt_a132'];

// $pgt_m132 = $_POST['pgt_m132'];

// $pgt_sr132 = $_POST['pgt_sr132'];

// $pgt_a133 = $_POST['pgt_a133'];

// $pgt_m133 = $_POST['pgt_m133'];

// $pgt_sr133 = $_POST['pgt_sr133'];

// $pgt_a134 = $_POST['pgt_a134'];

// $pgt_m134 = $_POST['pgt_m134'];

// $pgt_sr134 = $_POST['pgt_sr134'];

// $pgt_a135 = $_POST['pgt_a135'];

// $pgt_m135 = $_POST['pgt_m135'];

// $pgt_sr135 = $_POST['pgt_sr135'];

// $pgt_a136 = $_POST['pgt_a136'];

// $pgt_m136 = $_POST['pgt_m136'];

// $pgt_sr136 = $_POST['pgt_sr136'];

// $pgt_a140 = $_POST['pgt_a140'];

// $pgt_m140 = $_POST['pgt_m140'];

// $pgt_sr140 = $_POST['pgt_sr140'];

// $pgt_a141 = $_POST['pgt_a141'];

// $pgt_m141 = $_POST['pgt_m141'];

// $pgt_sr141 = $_POST['pgt_sr141'];

// $pgt_a142 = $_POST['pgt_a142'];

// $pgt_m142 = $_POST['pgt_m142'];

// $pgt_sr142 = $_POST['pgt_sr142'];

// $pgt_a143 = $_POST['pgt_a143'];

// $pgt_m143 = $_POST['pgt_m143'];

// $pgt_sr143 = $_POST['pgt_sr143'];

// $pgt_a144 = $_POST['pgt_a144'];

// $pgt_m144 = $_POST['pgt_m144'];

// $pgt_sr144 = $_POST['pgt_sr144'];

// $pgt_a145 = $_POST['pgt_a145'];

// $pgt_m145 = $_POST['pgt_m145'];

// $pgt_sr145 = $_POST['pgt_sr145'];

// $pgt_a146 = $_POST['pgt_a146'];

// $pgt_m146 = $_POST['pgt_m146'];

// $pgt_sr146 = $_POST['pgt_sr146'];

// $pgt_a150 = $_POST['pgt_a150'];

// $pgt_m150 = $_POST['pgt_m150'];

// $pgt_sr150 = $_POST['pgt_sr150'];

// $pgt_a151 = $_POST['pgt_a151'];

// $pgt_m151 = $_POST['pgt_m151'];

// $pgt_sr151 = $_POST['pgt_sr151'];

// $pgt_a152 = $_POST['pgt_a152'];

// $pgt_m152 = $_POST['pgt_m152'];

// $pgt_sr152 = $_POST['pgt_sr152'];

// $pgt_a153 = $_POST['pgt_a153'];

// $pgt_m153 = $_POST['pgt_m153'];

// $pgt_sr153 = $_POST['pgt_sr153'];

// $pgt_a154 = $_POST['pgt_a154'];

// $pgt_m154 = $_POST['pgt_m154'];

// $pgt_sr154 = $_POST['pgt_sr154'];

// $pgt_a155 = $_POST['pgt_a155'];

// $pgt_m155 = $_POST['pgt_m155'];

// $pgt_sr155 = $_POST['pgt_sr155'];

// $pgt_a156 = $_POST['pgt_a156'];

// $pgt_m156 = $_POST['pgt_m156'];

// $pgt_sr156 = $_POST['pgt_sr156'];

// $pgt_a160 = $_POST['pgt_a160'];

// $pgt_m160 = $_POST['pgt_m160'];

// $pgt_sr160 = $_POST['pgt_sr160'];

// $pgt_a161 = $_POST['pgt_a161'];

// $pgt_m161 = $_POST['pgt_m161'];

// $pgt_sr161 = $_POST['pgt_sr161'];

// $pgt_a162 = $_POST['pgt_a162'];

// $pgt_m162 = $_POST['pgt_m162'];

// $pgt_sr162 = $_POST['pgt_sr162'];

// $pgt_a163 = $_POST['pgt_a163'];

// $pgt_m163 = $_POST['pgt_m163'];

// $pgt_sr163 = $_POST['pgt_sr163'];

// $pgt_a164 = $_POST['pgt_a164'];

// $pgt_m164 = $_POST['pgt_m164'];

// $pgt_sr164 = $_POST['pgt_sr164'];

// $pgt_a165 = $_POST['pgt_a165'];

// $pgt_m165 = $_POST['pgt_m165'];

// $pgt_sr165 = $_POST['pgt_sr165'];

// $pgt_a166 = $_POST['pgt_a166'];

// $pgt_m166 = $_POST['pgt_m166'];

// $pgt_sr166 = $_POST['pgt_sr166'];

// $pgt_a170 = $_POST['pgt_a170'];

// $pgt_m170 = $_POST['pgt_m170'];

// $pgt_sr170 = $_POST['pgt_sr170'];

// $pgt_a171 = $_POST['pgt_a171'];

// $pgt_m171 = $_POST['pgt_m171'];

// $pgt_sr171 = $_POST['pgt_sr171'];

// $pgt_a172 = $_POST['pgt_a172'];

// $pgt_m172 = $_POST['pgt_m172'];

// $pgt_sr172 = $_POST['pgt_sr172'];

// $pgt_a173 = $_POST['pgt_a173'];

// $pgt_m173 = $_POST['pgt_m173'];

// $pgt_sr173 = $_POST['pgt_sr173'];

// $pgt_a174 = $_POST['pgt_a174'];

// $pgt_m174 = $_POST['pgt_m174'];

// $pgt_sr174 = $_POST['pgt_sr174'];

// $pgt_a175 = $_POST['pgt_a175'];

// $pgt_m175 = $_POST['pgt_m175'];

// $pgt_sr175 = $_POST['pgt_sr175'];

// $pgt_a176 = $_POST['pgt_a176'];

// $pgt_m176 = $_POST['pgt_m176'];

// $pgt_sr176 = $_POST['pgt_sr176'];

// $pgt_a180 = $_POST['pgt_a180'];

// $pgt_m180 = $_POST['pgt_m180'];

// $pgt_sr180 = $_POST['pgt_sr180'];

// $pgt_a181 = $_POST['pgt_a181'];

// $pgt_m181 = $_POST['pgt_m181'];

// $pgt_sr181 = $_POST['pgt_sr181'];

// $pgt_a182 = $_POST['pgt_a182'];

// $pgt_m182 = $_POST['pgt_m182'];

// $pgt_sr182 = $_POST['pgt_sr182'];

// $pgt_a183 = $_POST['pgt_a183'];

// $pgt_m183 = $_POST['pgt_m183'];

// $pgt_sr183 = $_POST['pgt_sr183'];

// $pgt_a184 = $_POST['pgt_a184'];

// $pgt_m184 = $_POST['pgt_m184'];

// $pgt_sr184 = $_POST['pgt_sr184'];

// $pgt_a185 = $_POST['pgt_a185'];

// $pgt_m185 = $_POST['pgt_m185'];

// $pgt_sr185 = $_POST['pgt_sr185'];

// $pgt_a186 = $_POST['pgt_a186'];

// $pgt_m186 = $_POST['pgt_m186'];

// $pgt_sr186 = $_POST['pgt_sr186'];

// $pgt_a190 = $_POST['pgt_a190'];

// $pgt_m190 = $_POST['pgt_m190'];

// $pgt_sr190 = $_POST['pgt_sr190'];

// $pgt_a191 = $_POST['pgt_a191'];

// $pgt_m191 = $_POST['pgt_m191'];

// $pgt_sr191 = $_POST['pgt_sr191'];

// $pgt_a192 = $_POST['pgt_a192'];

// $pgt_m192 = $_POST['pgt_m192'];

// $pgt_sr192 = $_POST['pgt_sr192'];

// $pgt_a193 = $_POST['pgt_a193'];

// $pgt_m193 = $_POST['pgt_m193'];

// $pgt_sr193 = $_POST['pgt_sr193'];

// $pgt_a194 = $_POST['pgt_a194'];

// $pgt_m194 = $_POST['pgt_m194'];

// $pgt_sr194 = $_POST['pgt_sr194'];

// $pgt_a195 = $_POST['pgt_a195'];

// $pgt_m195 = $_POST['pgt_m195'];

// $pgt_sr195 = $_POST['pgt_sr195'];

// $pgt_a196 = $_POST['pgt_a196'];

// $pgt_m196 = $_POST['pgt_m196'];

// $pgt_sr196 = $_POST['pgt_sr196'];

// $pgt_a200 = $_POST['pgt_a200'];

// $pgt_m200 = $_POST['pgt_m200'];

// $pgt_sr200 = $_POST['pgt_sr200'];

// $pgt_a201 = $_POST['pgt_a201'];

// $pgt_m201 = $_POST['pgt_m201'];

// $pgt_sr201 = $_POST['pgt_sr201'];

// $pgt_a202 = $_POST['pgt_a202'];

// $pgt_m202 = $_POST['pgt_m202'];

// $pgt_sr202 = $_POST['pgt_sr202'];

// $pgt_a203 = $_POST['pgt_a203'];

// $pgt_m203 = $_POST['pgt_m203'];

// $pgt_sr203 = $_POST['pgt_sr203'];

// $pgt_a204 = $_POST['pgt_a204'];

// $pgt_m204 = $_POST['pgt_m204'];

// $pgt_sr204 = $_POST['pgt_sr204'];

// $pgt_a205 = $_POST['pgt_a205'];

// $pgt_m205 = $_POST['pgt_m205'];

// $pgt_sr205 = $_POST['pgt_sr205'];

// $pgt_a206 = $_POST['pgt_a206'];

// $pgt_m206 = $_POST['pgt_m206'];

// $pgt_sr206 = $_POST['pgt_sr206'];

// $pgt_a210 = $_POST['pgt_a210'];

// $pgt_m210 = $_POST['pgt_m210'];

// $pgt_sr210 = $_POST['pgt_sr210'];

// $pgt_a211 = $_POST['pgt_a211'];

// $pgt_m211 = $_POST['pgt_m211'];

// $pgt_sr211 = $_POST['pgt_sr211'];

// $pgt_a212 = $_POST['pgt_a212'];

// $pgt_m212 = $_POST['pgt_m212'];

// $pgt_sr212 = $_POST['pgt_sr212'];

// $pgt_a213 = $_POST['pgt_a213'];

// $pgt_m213 = $_POST['pgt_m213'];

// $pgt_sr213 = $_POST['pgt_sr213'];

// $pgt_a214 = $_POST['pgt_a214'];

// $pgt_m214 = $_POST['pgt_m214'];

// $pgt_sr214 = $_POST['pgt_sr214'];

// $pgt_a215 = $_POST['pgt_a215'];

// $pgt_m215 = $_POST['pgt_m215'];

// $pgt_sr215 = $_POST['pgt_sr215'];

// $pgt_a216 = $_POST['pgt_a216'];

// $pgt_m216 = $_POST['pgt_m216'];

// $pgt_sr216 = $_POST['pgt_sr216'];

// $pgt_a220 = $_POST['pgt_a220'];

// $pgt_m220 = $_POST['pgt_m220'];

// $pgt_sr220 = $_POST['pgt_sr220'];

// $pgt_a221 = $_POST['pgt_a221'];

// $pgt_m221 = $_POST['pgt_m221'];

// $pgt_sr221 = $_POST['pgt_sr221'];

// $pgt_a222 = $_POST['pgt_a222'];

// $pgt_m222 = $_POST['pgt_m222'];

// $pgt_sr222 = $_POST['pgt_sr222'];

// $pgt_a223 = $_POST['pgt_a223'];

// $pgt_m223 = $_POST['pgt_m223'];

// $pgt_sr223 = $_POST['pgt_sr223'];

// $pgt_a224 = $_POST['pgt_a224'];

// $pgt_m224 = $_POST['pgt_m224'];

// $pgt_sr224 = $_POST['pgt_sr224'];

// $pgt_a225 = $_POST['pgt_a225'];

// $pgt_m225 = $_POST['pgt_m225'];

// $pgt_sr225 = $_POST['pgt_sr225'];

// $pgt_a226 = $_POST['pgt_a226'];

// $pgt_m226 = $_POST['pgt_m226'];

// $pgt_sr226 = $_POST['pgt_sr226'];

// $pgt_a230 = $_POST['pgt_a230'];

// $pgt_m230 = $_POST['pgt_m230'];

// $pgt_sr230 = $_POST['pgt_sr230'];

// $pgt_a231 = $_POST['pgt_a231'];

// $pgt_m231 = $_POST['pgt_m231'];

// $pgt_sr231 = $_POST['pgt_sr231'];

// $pgt_a232 = $_POST['pgt_a232'];

// $pgt_m232 = $_POST['pgt_m232'];

// $pgt_sr232 = $_POST['pgt_sr232'];

// $pgt_a233 = $_POST['pgt_a233'];

// $pgt_m233 = $_POST['pgt_m233'];

// $pgt_sr233 = $_POST['pgt_sr233'];

// $pgt_a234 = $_POST['pgt_a234'];

// $pgt_m234 = $_POST['pgt_m234'];

// $pgt_sr234 = $_POST['pgt_sr234'];

// $pgt_a235 = $_POST['pgt_a235'];

// $pgt_m235 = $_POST['pgt_m235'];

// $pgt_sr235 = $_POST['pgt_sr235'];

// $pgt_a236 = $_POST['pgt_a236'];

// $pgt_m236 = $_POST['pgt_m236'];

// $pgt_sr236 = $_POST['pgt_sr236'];

// $pgt_a240 = $_POST['pgt_a240'];

// $pgt_m240 = $_POST['pgt_m240'];

// $pgt_sr240 = $_POST['pgt_sr240'];

// $pgt_a241 = $_POST['pgt_a241'];

// $pgt_m241 = $_POST['pgt_m241'];

// $pgt_sr241 = $_POST['pgt_sr241'];

// $pgt_a242 = $_POST['pgt_a242'];

// $pgt_m242 = $_POST['pgt_m242'];

// $pgt_sr242 = $_POST['pgt_sr242'];

// $pgt_a243 = $_POST['pgt_a243'];

// $pgt_m243 = $_POST['pgt_m243'];

// $pgt_sr243 = $_POST['pgt_sr243'];

// $pgt_a244 = $_POST['pgt_a244'];

// $pgt_m244 = $_POST['pgt_m244'];

// $pgt_sr244 = $_POST['pgt_sr244'];

// $pgt_a245 = $_POST['pgt_a245'];

// $pgt_m245 = $_POST['pgt_m245'];

// $pgt_sr245 = $_POST['pgt_sr245'];

// $pgt_a246 = $_POST['pgt_a246'];

// $pgt_m246 = $_POST['pgt_m246'];

// $pgt_sr246 = $_POST['pgt_sr246'];

// $pgt_a250 = $_POST['pgt_a250'];

// $pgt_m250 = $_POST['pgt_m250'];

// $pgt_sr250 = $_POST['pgt_sr250'];

// $pgt_a251 = $_POST['pgt_a251'];

// $pgt_m251 = $_POST['pgt_m251'];

// $pgt_sr251 = $_POST['pgt_sr251'];

// $pgt_a252 = $_POST['pgt_a252'];

// $pgt_m252 = $_POST['pgt_m252'];

// $pgt_sr252 = $_POST['pgt_sr252'];

// $pgt_a253 = $_POST['pgt_a253'];

// $pgt_m253 = $_POST['pgt_m253'];

// $pgt_sr253 = $_POST['pgt_sr253'];

// $pgt_a254 = $_POST['pgt_a254'];

// $pgt_m254 = $_POST['pgt_m254'];

// $pgt_sr254 = $_POST['pgt_sr254'];

// $pgt_a255 = $_POST['pgt_a255'];

// $pgt_m255 = $_POST['pgt_m255'];

// $pgt_sr255 = $_POST['pgt_sr255'];

// $pgt_a256 = $_POST['pgt_a256'];

// $pgt_m256 = $_POST['pgt_m256'];

// $pgt_sr256 = $_POST['pgt_sr256'];



// // connect to mysql database using mysqli





// // mysql query to insert data

// $query = "INSERT INTO `pgt_embryo`(`patient_id`, `receipt_number`, `status`,`partners_name`,`art_bank_reg_no`,`form_id`,`donor_d`,`pgt_a_date`,`pgt_m_date`,`pgt_sr_date`,`pgt_a_time`,`pgt_m_time`,`pgt_sr_time`,`pgt_a_embryologist`,`pgt_m_embryologist`,`pgt_sr_embryologist`,`pgt_a_witness`,`pgt_m_witness`,`pgt_sr_witness`,`pgt_a_doctor`,`pgt_m_doctor`,`pgt_sr_doctor`,`pgt_a_tnofembryo`,`pgt_m_tnofembryo`,`pgt_sr_tnofembryo`,`pgt_a_embryo_sent`,`pgt_m_embryo_sent`,`pgt_sr_embryo_sent`,`pgt_a_biopsy_perform`,`pgt_m_biopsy_perform`,`pgt_sr_biopsy_perform`,`pgt_a_biopsy_total`,`pgt_m_biopsy_total`,`pgt_sr_biopsy_total`,`pgt_a_0`,`pgt_a_1`,`pgt_a_2`,`pgt_a_3`,`pgt_a_4`,`pgt_a_5`,`pgt_a_6`,`pgt_m_0`,`pgt_m_1`,`pgt_m_2`,`pgt_m_3`,`pgt_m_4`,`pgt_m_5`,`pgt_m_6`,`pgt_sr_0`,`pgt_sr_1`,`pgt_sr_2`,`pgt_sr_3`,`pgt_sr_4`,`pgt_sr_5`,`pgt_sr_6`,`pgt_a1_0`,`pgt_a1_1`,`pgt_a1_2`,`pgt_a1_3`,`pgt_a1_4`,`pgt_a1_5`,`pgt_a1_6`,`pgt_a2_0`,`pgt_a2_1`,`pgt_a2_2`,`pgt_a2_3`,`pgt_a2_4`,`pgt_a2_5`,`pgt_a2_6`,`pgt_a3_0`,`pgt_a3_1`,`pgt_a3_2`,`pgt_a3_3`,`pgt_a3_4`,`pgt_a3_5`,`pgt_a3_6`,`pgt_a4_0`,`pgt_a4_1`,`pgt_a4_2`,`pgt_a4_3`,`pgt_a4_4`,`pgt_a4_5`,`pgt_a4_6`,`pgt_a5_0`,`pgt_a5_1`,`pgt_a5_2`,`pgt_a5_3`,`pgt_a5_4`,`pgt_a5_5`,`pgt_a5_6`,`pgt_m1_0`,`pgt_m1_1`,`pgt_m1_2`,`pgt_m1_3`,`pgt_m1_4`,`pgt_m1_5`,`pgt_m1_6`,`pgt_m2_0`,`pgt_m2_1`,`pgt_m2_2`,`pgt_m2_3`,`pgt_m2_4`,`pgt_m2_5`,`pgt_m2_6`,`pgt_m3_0`,`pgt_m3_1`,`pgt_m3_2`,`pgt_m3_3`,`pgt_m3_4`,`pgt_m3_5`,`pgt_m3_6`,`pgt_m4_0`,`pgt_m4_1`,`pgt_m4_2`,`pgt_m4_3`,`pgt_m4_4`,`pgt_m4_5`,`pgt_m4_6`,`pgt_m5_0`,`pgt_m5_1`,`pgt_m5_2`,`pgt_m5_3`,`pgt_m5_4`,`pgt_m5_5`,`pgt_m5_6`,`pgt_sr1_0`,`pgt_sr1_1`,`pgt_sr1_2`,`pgt_sr1_3`,`pgt_sr1_4`,`pgt_sr1_5`,`pgt_sr1_6`,`pgt_sr2_0`,`pgt_sr2_1`,`pgt_sr2_2`,`pgt_sr2_3`,`pgt_sr2_4`,`pgt_sr2_5`,`pgt_sr2_6`,`pgt_sr3_0`,`pgt_sr3_1`,`pgt_sr3_2`,`pgt_sr3_3`,`pgt_sr3_4`,`pgt_sr3_5`,`pgt_sr3_6`,`pgt_sr4_0`,`pgt_sr4_1`,`pgt_sr4_2`,`pgt_sr4_3`,`pgt_sr4_4`,`pgt_sr4_5`,`pgt_sr4_6`,`pgt_sr5_0`,`pgt_sr5_1`,`pgt_sr5_2`,`pgt_sr5_3`,`pgt_sr5_4`,`pgt_sr5_5`,`pgt_sr5_6`,`pgt_a60`,`pgt_m60`,`pgt_sr60`,`pgt_a61`,`pgt_m61`,`pgt_sr61`,`pgt_a62`,`pgt_m62`,`pgt_sr62`,`pgt_a63`,`pgt_m63`,`pgt_sr63`,`pgt_a64`,`pgt_m64`,`pgt_sr64`,`pgt_a65`,`pgt_m65`,`pgt_sr65`,`pgt_a66`,`pgt_m66`,`pgt_sr66`,`pgt_a70`,`pgt_m70`,`pgt_sr70`,`pgt_a71`,`pgt_m71`,`pgt_sr71`,`pgt_a72`,`pgt_m72`,`pgt_sr72`,`pgt_a73`,`pgt_m73`,`pgt_sr73`,`pgt_a74`,`pgt_m74`,`pgt_sr74`,`pgt_a75`,`pgt_m75`,`pgt_sr75`,`pgt_a76`,`pgt_m76`,`pgt_sr76`,`pgt_a80`,`pgt_m80`,`pgt_sr80`,`pgt_a81`,`pgt_m81`,`pgt_sr81`,`pgt_a82`,`pgt_m82`,`pgt_sr82`,`pgt_a83`,`pgt_m83`,`pgt_sr83`,`pgt_a84`,`pgt_m84`,`pgt_sr84`,`pgt_a85`,`pgt_m85`,`pgt_sr85`,`pgt_a86`,`pgt_m86`,`pgt_sr86`,`pgt_a90`,`pgt_m90`,`pgt_sr90`,`pgt_a91`,`pgt_m91`,`pgt_sr91`,`pgt_a92`,`pgt_m92`,`pgt_sr92`,`pgt_a93`,`pgt_m93`,`pgt_sr93`,`pgt_a94`,`pgt_m94`,`pgt_sr94`,`pgt_a95`,`pgt_m95`,`pgt_sr95`,`pgt_a96`,`pgt_m96`,`pgt_sr96`,`pgt_a100`,`pgt_m100`,`pgt_sr100`,`pgt_a101`,`pgt_m101`,`pgt_sr101`,`pgt_a102`,`pgt_m102`,`pgt_sr102`,`pgt_a103`,`pgt_m103`,`pgt_sr103`,`pgt_a104`,`pgt_m104`,`pgt_sr104`,`pgt_a105`,`pgt_m105`,`pgt_sr105`,`pgt_a106`,`pgt_m106`,`pgt_sr106`,`pgt_a110`,`pgt_m110`,`pgt_sr110`,`pgt_a111`,`pgt_m111`,`pgt_sr111`,`pgt_a112`,`pgt_m112`,`pgt_sr112`,`pgt_a113`,`pgt_m113`,`pgt_sr113`,`pgt_a114`,`pgt_m114`,`pgt_sr114`,`pgt_a115`,`pgt_m115`,`pgt_sr115`,`pgt_a116`,`pgt_m116`,`pgt_sr116`,`pgt_a120`,`pgt_m120`,`pgt_sr120`,`pgt_a121`,`pgt_m121`,`pgt_sr121`,`pgt_a122`,`pgt_m122`,`pgt_sr122`,`pgt_a123`,`pgt_m123`,`pgt_sr123`,`pgt_a124`,`pgt_m124`,`pgt_sr124`,`pgt_a125`,`pgt_m125`,`pgt_sr125`,`pgt_a126`,`pgt_m126`,`pgt_sr126`,`pgt_a130`,`pgt_m130`,`pgt_sr130`,`pgt_a131`,`pgt_m131`,`pgt_sr131`,`pgt_a132`,`pgt_m132`,`pgt_sr132`,`pgt_a133`,`pgt_m133`,`pgt_sr133`,`pgt_a134`,`pgt_m134`,`pgt_sr134`,`pgt_a135`,`pgt_m135`,`pgt_sr135`,`pgt_a136`,`pgt_m136`,`pgt_sr136`,`pgt_a140`,`pgt_m140`,`pgt_sr140`,`pgt_a141`,`pgt_m141`,`pgt_sr141`,`pgt_a142`,`pgt_m142`,`pgt_sr142`,`pgt_a143`,`pgt_m143`,`pgt_sr143`,`pgt_a144`,`pgt_m144`,`pgt_sr144`,`pgt_a145`,`pgt_m145`,`pgt_sr145`,`pgt_a146`,`pgt_m146`,`pgt_sr146`,`pgt_a150`,`pgt_m150`,`pgt_sr150`,`pgt_a151`,`pgt_m151`,`pgt_sr151`,`pgt_a152`,`pgt_m152`,`pgt_sr152`,`pgt_a153`,`pgt_m153`,`pgt_sr153`,`pgt_a154`,`pgt_m154`,`pgt_sr154`,`pgt_a155`,`pgt_m155`,`pgt_sr155`,`pgt_a156`,`pgt_m156`,`pgt_sr156`,`pgt_a160`,`pgt_m160`,`pgt_sr160`,`pgt_a161`,`pgt_m161`,`pgt_sr161`,`pgt_a162`,`pgt_m162`,`pgt_sr162`,`pgt_a163`,`pgt_m163`,`pgt_sr163`,`pgt_a164`,`pgt_m164`,`pgt_sr164`,`pgt_a165`,`pgt_m165`,`pgt_sr165`,`pgt_a166`,`pgt_m166`,`pgt_sr166`,`pgt_a170`,`pgt_m170`,`pgt_sr170`,`pgt_a171`,`pgt_m171`,`pgt_sr171`,`pgt_a172`,`pgt_m172`,`pgt_sr172`,`pgt_a173`,`pgt_m173`,`pgt_sr173`,`pgt_a174`,`pgt_m174`,`pgt_sr174`,`pgt_a175`,`pgt_m175`,`pgt_sr175`,`pgt_a176`,`pgt_m176`,`pgt_sr176`,`pgt_a180`,`pgt_m180`,`pgt_sr180`,`pgt_a181`,`pgt_m181`,`pgt_sr181`,`pgt_a182`,`pgt_m182`,`pgt_sr182`,`pgt_a183`,`pgt_m183`,`pgt_sr183`,`pgt_a184`,`pgt_m184`,`pgt_sr184`,`pgt_a185`,`pgt_m185`,`pgt_sr185`,`pgt_a186`,`pgt_m186`,`pgt_sr186`,`pgt_a190`,`pgt_m190`,`pgt_sr190`,`pgt_a191`,`pgt_m191`,`pgt_sr191`,`pgt_a192`,`pgt_m192`,`pgt_sr192`,`pgt_a193`,`pgt_m193`,`pgt_sr193`,`pgt_a194`,`pgt_m194`,`pgt_sr194`,`pgt_a195`,`pgt_m195`,`pgt_sr195`,`pgt_a196`,`pgt_m196`,`pgt_sr196`,`pgt_a200`,`pgt_m200`,`pgt_sr200`,`pgt_a201`,`pgt_m201`,`pgt_sr201`,`pgt_a202`,`pgt_m202`,`pgt_sr202`,`pgt_a203`,`pgt_m203`,`pgt_sr203`,`pgt_a204`,`pgt_m204`,`pgt_sr204`,`pgt_a205`,`pgt_m205`,`pgt_sr205`,`pgt_a206`,`pgt_m206`,`pgt_sr206`,`pgt_a210`,`pgt_m210`,`pgt_sr210`,`pgt_a211`,`pgt_m211`,`pgt_sr211`,`pgt_a212`,`pgt_m212`,`pgt_sr212`,`pgt_a213`,`pgt_m213`,`pgt_sr213`,`pgt_a214`,`pgt_m214`,`pgt_sr214`,`pgt_a215`,`pgt_m215`,`pgt_sr215`,`pgt_a216`,`pgt_m216`,`pgt_sr216`,`pgt_a220`,`pgt_m220`,`pgt_sr220`,`pgt_a221`,`pgt_m221`,`pgt_sr221`,`pgt_a222`,`pgt_m222`,`pgt_sr222`,`pgt_a223`,`pgt_m223`,`pgt_sr223`,`pgt_a224`,`pgt_m224`,`pgt_sr224`,`pgt_a225`,`pgt_m225`,`pgt_sr225`,`pgt_a226`,`pgt_m226`,`pgt_sr226`,`pgt_a230`,`pgt_m230`,`pgt_sr230`,`pgt_a231`,`pgt_m231`,`pgt_sr231`,`pgt_a232`,`pgt_m232`,`pgt_sr232`,`pgt_a233`,`pgt_m233`,`pgt_sr233`,`pgt_a234`,`pgt_m234`,`pgt_sr234`,`pgt_a235`,`pgt_m235`,`pgt_sr235`,`pgt_a236`,`pgt_m236`,`pgt_sr236`,`pgt_a240`,`pgt_m240`,`pgt_sr240`,`pgt_a241`,`pgt_m241`,`pgt_sr241`,`pgt_a242`,`pgt_m242`,`pgt_sr242`,`pgt_a243`,`pgt_m243`,`pgt_sr243`,`pgt_a244`,`pgt_m244`,`pgt_sr244`,`pgt_a245`,`pgt_m245`,`pgt_sr245`,`pgt_a246`,`pgt_m246`,`pgt_sr246`,`pgt_a250`,`pgt_m250`,`pgt_sr250`,`pgt_a251`,`pgt_m251`,`pgt_sr251`,`pgt_a252`,`pgt_m252`,`pgt_sr252`,`pgt_a253`,`pgt_m253`,`pgt_sr253`,`pgt_a254`,`pgt_m254`,`pgt_sr254`,`pgt_a255`,`pgt_m255`,`pgt_sr255`,`pgt_a256`,`pgt_m256`,`pgt_sr256`) VALUES ('$patient_id','$receipt_number','$status','$partners_name','$art_bank_reg_no','$form_id','$donor_d','$pgt_a_date','$pgt_m_date','$pgt_sr_date','$pgt_a_time','$pgt_m_time','$pgt_sr_time','$pgt_a_embryologist','$pgt_m_embryologist','$pgt_sr_embryologist','$pgt_a_witness','$pgt_m_witness','$pgt_sr_witness','$pgt_a_doctor','$pgt_m_doctor','$pgt_sr_doctor','$pgt_a_tnofembryo','$pgt_m_tnofembryo','$pgt_sr_tnofembryo','$pgt_a_embryo_sent','$pgt_m_embryo_sent','$pgt_sr_embryo_sent','$pgt_a_biopsy_perform','$pgt_m_biopsy_perform','$pgt_sr_biopsy_perform','$pgt_a_biopsy_total','$pgt_m_biopsy_total','$pgt_sr_biopsy_total','$pgt_a_0','$pgt_a_1','$pgt_a_2','$pgt_a_3','$pgt_a_4','$pgt_a_5','$pgt_a_6','$pgt_m_0','$pgt_m_1','$pgt_m_2','$pgt_m_3','$pgt_m_4','$pgt_m_5','$pgt_m_6','$pgt_sr_0','$pgt_sr_1','$pgt_sr_2','$pgt_sr_3','$pgt_sr_4','$pgt_sr_5','$pgt_sr_6','$pgt_a1_0','$pgt_a1_1','$pgt_a1_2','$pgt_a1_3','$pgt_a1_4','$pgt_a1_5','$pgt_a1_6','$pgt_a2_0','$pgt_a2_1','$pgt_a2_2','$pgt_a2_3','$pgt_a2_4','$pgt_a2_5','$pgt_a2_6','$pgt_a3_0','$pgt_a3_1','$pgt_a3_2','$pgt_a3_3','$pgt_a3_4','$pgt_a3_5','$pgt_a3_6','$pgt_a4_0','$pgt_a4_1','$pgt_a4_2','$pgt_a4_3','$pgt_a4_4','$pgt_a4_5','$pgt_a4_6','$pgt_a5_0','$pgt_a5_1','$pgt_a5_2','$pgt_a5_3','$pgt_a5_4','$pgt_a5_5','$pgt_a5_6','$pgt_m1_0','$pgt_m1_1','$pgt_m1_2','$pgt_m1_3','$pgt_m1_4','$pgt_m1_5','$pgt_m1_6','$pgt_m2_0','$pgt_m2_1','$pgt_m2_2','$pgt_m2_3','$pgt_m2_4','$pgt_m2_5','$pgt_m2_6','$pgt_m3_0','$pgt_m3_1','$pgt_m3_2','$pgt_m3_3','$pgt_m3_4','$pgt_m3_5','$pgt_m3_6','$pgt_m4_0','$pgt_m4_1','$pgt_m4_2','$pgt_m4_3','$pgt_m4_4','$pgt_m4_5','$pgt_m4_6','$pgt_m5_0','$pgt_m5_1','$pgt_m5_2','$pgt_m5_3','$pgt_m5_4','$pgt_m5_5','$pgt_m5_6','$pgt_sr1_0','$pgt_sr1_1','$pgt_sr1_2','$pgt_sr1_3','$pgt_sr1_4','$pgt_sr1_5','$pgt_sr1_6','$pgt_sr2_0','$pgt_sr2_1','$pgt_sr2_2','$pgt_sr2_3','$pgt_sr2_4','$pgt_sr2_5','$pgt_sr2_6','$pgt_sr3_0','$pgt_sr3_1','$pgt_sr3_2','$pgt_sr3_3','$pgt_sr3_4','$pgt_sr3_5','$pgt_sr3_6','$pgt_sr4_0','$pgt_sr4_1','$pgt_sr4_2','$pgt_sr4_3','$pgt_sr4_4','$pgt_sr4_5','$pgt_sr4_6','$pgt_sr5_0','$pgt_sr5_1','$pgt_sr5_2','$pgt_sr5_3','$pgt_sr5_4','$pgt_sr5_5','$pgt_sr5_6','$pgt_a60','$pgt_m60','$pgt_sr60','$pgt_a61','$pgt_m61','$pgt_sr61','$pgt_a62','$pgt_m62','$pgt_sr62','$pgt_a63','$pgt_m63','$pgt_sr63','$pgt_a64','$pgt_m64','$pgt_sr64','$pgt_a65','$pgt_m65','$pgt_sr65','$pgt_a66','$pgt_m66','$pgt_sr66','$pgt_a70','$pgt_m70','$pgt_sr70','$pgt_a71','$pgt_m71','$pgt_sr71','$pgt_a72','$pgt_m72','$pgt_sr72','$pgt_a73','$pgt_m73','$pgt_sr73','$pgt_a74','$pgt_m74','$pgt_sr74','$pgt_a75','$pgt_m75','$pgt_sr75','$pgt_a76','$pgt_m76','$pgt_sr76','$pgt_a80','$pgt_m80','$pgt_sr80','$pgt_a81','$pgt_m81','$pgt_sr81','$pgt_a82','$pgt_m82','$pgt_sr82','$pgt_a83','$pgt_m83','$pgt_sr83','$pgt_a84','$pgt_m84','$pgt_sr84','$pgt_a85','$pgt_m85','$pgt_sr85','$pgt_a86','$pgt_m86','$pgt_sr86','$pgt_a90','$pgt_m90','$pgt_sr90','$pgt_a91','$pgt_m91','$pgt_sr91','$pgt_a92','$pgt_m92','$pgt_sr92','$pgt_a93','$pgt_m93','$pgt_sr93','$pgt_a94','$pgt_m94','$pgt_sr94','$pgt_a95','$pgt_m95','$pgt_sr95','$pgt_a96','$pgt_m96','$pgt_sr96','$pgt_a100','$pgt_m100','$pgt_sr100','$pgt_a101','$pgt_m101','$pgt_sr101','$pgt_a102','$pgt_m102','$pgt_sr102','$pgt_a103','$pgt_m103','$pgt_sr103','$pgt_a104','$pgt_m104','$pgt_sr104','$pgt_a105','$pgt_m105','$pgt_sr105','$pgt_a106','$pgt_m106','$pgt_sr106','$pgt_a110','$pgt_m110','$pgt_sr110','$pgt_a111','$pgt_m111','$pgt_sr111','$pgt_a112','$pgt_m112','$pgt_sr112','$pgt_a113','$pgt_m113','$pgt_sr113','$pgt_a114','$pgt_m114','$pgt_sr114','$pgt_a115','$pgt_m115','$pgt_sr115','$pgt_a116','$pgt_m116','$pgt_sr116','$pgt_a120','$pgt_m120','$pgt_sr120','$pgt_a121','$pgt_m121','$pgt_sr121','$pgt_a122','$pgt_m122','$pgt_sr122','$pgt_a123','$pgt_m123','$pgt_sr123','$pgt_a124','$pgt_m124','$pgt_sr124','$pgt_a125','$pgt_m125','$pgt_sr125','$pgt_a126','$pgt_m126','$pgt_sr126','$pgt_a130','$pgt_m130','$pgt_sr130','$pgt_a131','$pgt_m131','$pgt_sr131','$pgt_a132','$pgt_m132','$pgt_sr132','$pgt_a133','$pgt_m133','$pgt_sr133','$pgt_a134','$pgt_m134','$pgt_sr134','$pgt_a135','$pgt_m135','$pgt_sr135','$pgt_a136','$pgt_m136','$pgt_sr136','$pgt_a140','$pgt_m140','$pgt_sr140','$pgt_a141','$pgt_m141','$pgt_sr141','$pgt_a142','$pgt_m142','$pgt_sr142','$pgt_a143','$pgt_m143','$pgt_sr143','$pgt_a144','$pgt_m144','$pgt_sr144','$pgt_a145','$pgt_m145','$pgt_sr145','$pgt_a146','$pgt_m146','$pgt_sr146','$pgt_a150','$pgt_m150','$pgt_sr150','$pgt_a151','$pgt_m151','$pgt_sr151','$pgt_a152','$pgt_m152','$pgt_sr152','$pgt_a153','$pgt_m153','$pgt_sr153','$pgt_a154','$pgt_m154','$pgt_sr154','$pgt_a155','$pgt_m155','$pgt_sr155','$pgt_a156','$pgt_m156','$pgt_sr156','$pgt_a160','$pgt_m160','$pgt_sr160','$pgt_a161','$pgt_m161','$pgt_sr161','$pgt_a162','$pgt_m162','$pgt_sr162','$pgt_a163','$pgt_m163','$pgt_sr163','$pgt_a164','$pgt_m164','$pgt_sr164','$pgt_a165','$pgt_m165','$pgt_sr165','$pgt_a166','$pgt_m166','$pgt_sr166','$pgt_a170','$pgt_m170','$pgt_sr170','$pgt_a171','$pgt_m171','$pgt_sr171','$pgt_a172','$pgt_m172','$pgt_sr172','$pgt_a173','$pgt_m173','$pgt_sr173','$pgt_a174','$pgt_m174','$pgt_sr174','$pgt_a175','$pgt_m175','$pgt_sr175','$pgt_a176','$pgt_m176','$pgt_sr176','$pgt_a180','$pgt_m180','$pgt_sr180','$pgt_a181','$pgt_m181','$pgt_sr181','$pgt_a182','$pgt_m182','$pgt_sr182','$pgt_a183','$pgt_m183','$pgt_sr183','$pgt_a184','$pgt_m184','$pgt_sr184','$pgt_a185','$pgt_m185','$pgt_sr185','$pgt_a186','$pgt_m186','$pgt_sr186','$pgt_a190','$pgt_m190','$pgt_sr190','$pgt_a191','$pgt_m191','$pgt_sr191','$pgt_a192','$pgt_m192','$pgt_sr192','$pgt_a193','$pgt_m193','$pgt_sr193','$pgt_a194','$pgt_m194','$pgt_sr194','$pgt_a195','$pgt_m195','$pgt_sr195','$pgt_a196','$pgt_m196','$pgt_sr196','$pgt_a200','$pgt_m200','$pgt_sr200','$pgt_a201','$pgt_m201','$pgt_sr201','$pgt_a202','$pgt_m202','$pgt_sr202','$pgt_a203','$pgt_m203','$pgt_sr203','$pgt_a204','$pgt_m204','$pgt_sr204','$pgt_a205','$pgt_m205','$pgt_sr205','$pgt_a206','$pgt_m206','$pgt_sr206','$pgt_a210','$pgt_m210','$pgt_sr210','$pgt_a211','$pgt_m211','$pgt_sr211','$pgt_a212','$pgt_m212','$pgt_sr212','$pgt_a213','$pgt_m213','$pgt_sr213','$pgt_a214','$pgt_m214','$pgt_sr214','$pgt_a215','$pgt_m215','$pgt_sr215','$pgt_a216','$pgt_m216','$pgt_sr216','$pgt_a220','$pgt_m220','$pgt_sr220','$pgt_a221','$pgt_m221','$pgt_sr221','$pgt_a222','$pgt_m222','$pgt_sr222','$pgt_a223','$pgt_m223','$pgt_sr223','$pgt_a224','$pgt_m224','$pgt_sr224','$pgt_a225','$pgt_m225','$pgt_sr225','$pgt_a226','$pgt_m226','$pgt_sr226','$pgt_a230','$pgt_m230','$pgt_sr230','$pgt_a231','$pgt_m231','$pgt_sr231','$pgt_a232','$pgt_m232','$pgt_sr232','$pgt_a233','$pgt_m233','$pgt_sr233','$pgt_a234','$pgt_m234','$pgt_sr234','$pgt_a235','$pgt_m235','$pgt_sr235','$pgt_a236','$pgt_m236','$pgt_sr236','$pgt_a240','$pgt_m240','$pgt_sr240','$pgt_a241','$pgt_m241','$pgt_sr241','$pgt_a242','$pgt_m242','$pgt_sr242','$pgt_a243','$pgt_m243','$pgt_sr243','$pgt_a244','$pgt_m244','$pgt_sr244','$pgt_a245','$pgt_m245','$pgt_sr245','$pgt_a246','$pgt_m246','$pgt_sr246','$pgt_a250','$pgt_m250','$pgt_sr250','$pgt_a251','$pgt_m251','$pgt_sr251','$pgt_a252','$pgt_m252','$pgt_sr252','$pgt_a253','$pgt_m253','$pgt_sr253','$pgt_a254','$pgt_m254','$pgt_sr254','$pgt_a255','$pgt_m255','$pgt_sr255','$pgt_a256','$pgt_m256','$pgt_sr256')";



// $result = run_form_query($query);



// if($result){

// header("location:" .base_url(). "procedure_reports/".$appointment_id."?m=".base64_encode('Procedure form inserted!').'&t='.base64_encode('success'));

// die();

// }else{

// header("location:" .base_url(). "procedure_reports/".$appointment_id."?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));

// die();

// }

// }

?>-->





<form enctype='multipart/form-data'  class ="searchform" name="form" action="" method="POST">

    

<input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">

<input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">

<input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">



<input type="hidden" value="<?php echo $procedure_id; ?>" class="form" name="procedure_id">

<input type="hidden" value="<?php echo $patient_id; ?>" class="form" name="patient_id">

<input type="hidden" value="<?php echo $receipt_number; ?>" class="form" name="receipt_number">

<input type="hidden" value="pending" name="status">

  <input type="hidden" value="<?php echo $patient_data['wife_name']; ?>" class="form" name="wife_name">
  <input type="hidden" value="<?php echo $patient_data['wife_phone']; ?>" class="form" name="wife_phone">
  <input type="hidden" value="<?php echo $patient_data['husband_name']; ?>" class="form" name="husband_name">
  <input type="hidden" value="<?php echo $patient_data['wife_address']; ?>" class="form" name="wife_address">
  <input type="hidden" value="<?php echo $patient_data['wife_age']; ?>" class="form" name="wife_age">
  <?php foreach ($select_result2 as $res_val){  ?>
  <input type="hidden" value="<?php echo $res_val->female_pregnancy_other_p; ?>" class="form" name="female_pregnancy_other_p">
  <input type="hidden" value="<?php echo $res_val->female_pregnancy_other_l; ?>" class="form" name="female_pregnancy_other_l">
  <input type="hidden" value="<?php echo $res_val->female_pregnancy_other_a; ?>" class="form" name="female_pregnancy_other_a">
  <input type="hidden" value="<?php echo $res_val->details_management_advised; ?>" class="form" name="details_management_advised">
					 <?php } ?>  

<div class="container red-field form mt-5 mb-5">

<table class="table table-bordered table-hover mt-2 table-sm red-field tableMg">

    <table style="text-align: center;" class="table table-bordered table-hover mt-2 table-sm tableMg">

        <thead>

            <tr>

                <td colspan="2" class="red-field"><h2>PGT EMBRYO DETAILS</h2></td>

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

        <thead>

            <tr>

                <th colspan="2" class="red-field"><h4>SELF CYCLE  (S)</h4></th>

                <th colspan="2"><h4>DONOR CYCLE (D)</h4></th>

            </tr>

        </thead>

        <thead>

            <tr>

                <th class="red-field"><strong>Partners name</strong></th>

                <th><input type="text" value="<?php echo isset($select_result['partners_name'])?$select_result['partners_name']:""; ?>" class="form-control" maxlength="20" name="partners_name"></th>

                <th><strong>ART bank reg no</strong></th>

                <th><input type="text" value="<?php echo isset($select_result['art_bank_reg_no'])?$select_result['art_bank_reg_no']:""; ?>" class="form-control" maxlength="20" name="art_bank_reg_no"></th>

            </tr>

        </thead>

        <thead>

            <tr>

                <th class="red-field"><strong>ID</strong></th>

                <th><input type="text" value="<?php echo isset($select_result['form_id'])?$select_result['form_id']:""; ?>" class="form-control" maxlength="20" name="form_id"></th>

                <th><strong>Donor ID</strong></th>

                <th><input type="text" value="<?php echo isset($select_result['donor_d'])?$select_result['donor_d']:""; ?>" class="form-control" maxlength="20" name="donor_d"></th>

            </tr>

        </thead>

    </table>

    <div class='table-responsive'>

        <table class="table table-bordered table-hover mt-2 table-sm">

            <colgroup>

                <col span="7" style="background:peachpuff;">

                <col span="7" style="background:lightgreen;">

                <col span="7" style="background:gold;">

            </colgroup>

            <thead>

                <tr>

                    <th colspan="7"><center>PGT-A</center></th>

                    <th colspan="7">PGT-M</th>

                    <th colspan="7">PGT-SR</th>

                </tr>

                <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4">DATE</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_date'])) {$value = $select_result['pgt_'.$a[$i].'_date']; }

                        echo '<th colspan="3"><input type="date" class="form-control" value="'.$value.'" name="pgt_'.$a[$i].'_date"></td></th>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4">TIME</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_time'])) {$value = $select_result['pgt_'.$a[$i].'_time']; 

                            

                            

                        }

                        echo '<th colspan="3"><input type="time" class="form-control" value="'.$value.'" name="pgt_'.$a[$i].'_time"></td></th>';

                    }

                    ?>

                    

                    

                </tr>

                <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4">EMBRYOLOGIST</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_embryologist'])) {$value = $select_result['pgt_'.$a[$i].'_embryologist']; }

                        echo '<th colspan="3"><input type="text" class="form-control" value="'.$value.'" maxlength="20" name="pgt_'.$a[$i].'_embryologist"></td></th>';

                    }

                    ?>

                </tr>

                <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4">WITNESS</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_witness'])) {$value = $select_result['pgt_'.$a[$i].'_witness']; }

                        echo '<th colspan="3"><input type="text" class="form-control" value="'.$value.'" maxlength="20" name="pgt_'.$a[$i].'_witness"></td></th>';

                    }

                    ?>

                </tr>

                    <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4">DOCTOR</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_doctor'])) {$value = $select_result['pgt_'.$a[$i].'_doctor']; }

                        echo '<th colspan="3"><input type="text" class="form-control" value="'.$value.'" maxlength="20" name="pgt_'.$a[$i].'_doctor"></td></th>';

                    }

                    ?>

                </tr>

                    <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4">TOAL NO EMBRYOS FORMED</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_tnofembryo'])) {$value = $select_result['pgt_'.$a[$i].'_tnofembryo']; }

                        echo '<th colspan="3"><input type="number" min="0" max="20" value="'.$value.'" class="form-control" name="pgt_'.$a[$i].'_tnofembryo"></td></th>';

                    }

                    ?>

                    

                    

                </tr>

                    <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="color:red;">EMBRYOS SENT FOR PGT-A</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_embryo_sent'])) {$value = $select_result['pgt_'.$a[$i].'_embryo_sent']; }

                        echo '<th colspan="3"><input type="number" min="0" max="20" value="'.$value.'" class="form-control" name="pgt_'.$a[$i].'_embryo_sent"></td></th>';

                    }

                    ?>

                    

                    

                </tr>

                    <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="color: green;">Total no biopsy performed</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_biopsy_perform'])) {$value = $select_result['pgt_'.$a[$i].'_biopsy_perform']; }

                        echo '<th colspan="3"><input type="number" min="0" max="20" value="'.$value.'" class="form-control" name="pgt_'.$a[$i].'_biopsy_perform"></td></th>';

                    }

                    ?>

                    

                    

                </tr>

                <tr>

                    <?php 

                    $a = array("a","m","sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="color: green;">Total biopsy with DNA detected</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_biopsy_total'])) {$value = $select_result['pgt_'.$a[$i].'_biopsy_total']; }

                        echo '<th colspan="3"><input type="number" min="0" max="20" value="'.$value.'" class="form-control" name="pgt_'.$a[$i].'_biopsy_total"></td></th>';

                    }

                    ?>      

                </tr>

            </thead>

            <thead>

                <tr>

                    <th>Embryo cell & grade on which biopsy performed</th>

                    <th>Embryo on which DNA detected</th>

                    <th>Successful biopsy/tubing</th>

                    <th>Technique used</th>

                    <th class="red-field">Result of biopsy</th>

                    <th class="red-field">No of embryo transferred</th>

                    <th class="red-field">Fate</th>

                    <th>Embryo cell & grade on which biopsy performed</th>

                    <th>Embryo on which DNA detected</th>

                    <th>Successful biopsy/tubing</th>

                    <th>Technique used</th>

                    <th class="red-field">Result of biopsy</th>

                    <th class="red-field">No of embryo transferred</th>

                    <th class="red-field">Fate</th>

                    <th>Embryo cell & grade on which biopsy performed</th>

                    <th>Embryo on which DNA detected</th>

                    <th>Successful biopsy/tubing</th>

                    <th>Technique used</th>

                    <th class="red-field">Result of biopsy</th>

                    <th class="red-field">No of embryo transferred</th>

                    <th class="red-field">Fate</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a_'.$i])) {$value = $select_result['pgt_a_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m_'.$i])) {$value = $select_result['pgt_m_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr_'.$i])) {$value = $select_result['pgt_sr_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr_'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a1_'.$i])) {$value = $select_result['pgt_a1_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a1_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m1_'.$i])) {$value = $select_result['pgt_m1_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m1_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr1_'.$i])) {$value = $select_result['pgt_sr1_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr1_'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a2_'.$i])) {$value = $select_result['pgt_a2_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a2_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m2_'.$i])) {$value = $select_result['pgt_m2_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m2_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr2_'.$i])) {$value = $select_result['pgt_sr2_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr2_'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a3_'.$i])) {$value = $select_result['pgt_a3_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a3_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m3_'.$i])) {$value = $select_result['pgt_m3_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m3_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr3_'.$i])) {$value = $select_result['pgt_sr3_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr3_'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a4_'.$i])) {$value = $select_result['pgt_a4_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a4_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m4_'.$i])) {$value = $select_result['pgt_m4_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m4_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr4_'.$i])) {$value = $select_result['pgt_sr4_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr4_'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a5_'.$i])) {$value = $select_result['pgt_a5_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a5_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m5_'.$i])) {$value = $select_result['pgt_m5_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m5_'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr5_'.$i])) {$value = $select_result['pgt_sr5_'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr5_'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a6'.$i])) {$value = $select_result['pgt_a6'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a6'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m6'.$i])) {$value = $select_result['pgt_m6'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m6'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr6'.$i])) {$value = $select_result['pgt_sr6'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr6'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a7'.$i])) {$value = $select_result['pgt_a7'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a7'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m7'.$i])) {$value = $select_result['pgt_m7'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m7'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr7'.$i])) {$value = $select_result['pgt_sr7'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr7'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a8'.$i])) {$value = $select_result['pgt_a8'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a8'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m8'.$i])) {$value = $select_result['pgt_m8'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m8'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr8'.$i])) {$value = $select_result['pgt_sr8'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr8'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a9'.$i])) {$value = $select_result['pgt_a9'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a9'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m9'.$i])) {$value = $select_result['pgt_m9'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m9'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr9'.$i])) {$value = $select_result['pgt_sr9'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr9'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a10'.$i])) {$value = $select_result['pgt_a10'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a10'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m10'.$i])) {$value = $select_result['pgt_m10'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m10'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr10'.$i])) {$value = $select_result['pgt_sr10'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr10'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a11'.$i])) {$value = $select_result['pgt_a11'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a11'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m11'.$i])) {$value = $select_result['pgt_m11'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m11'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr11'.$i])) {$value = $select_result['pgt_sr11'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr11'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a12'.$i])) {$value = $select_result['pgt_a12'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a12'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m12'.$i])) {$value = $select_result['pgt_m12'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m12'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr12'.$i])) {$value = $select_result['pgt_sr12'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr12'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a13'.$i])) {$value = $select_result['pgt_a13'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a13'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m13'.$i])) {$value = $select_result['pgt_m13'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m13'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr13'.$i])) {$value = $select_result['pgt_sr13'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr13'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a14'.$i])) {$value = $select_result['pgt_a14'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a14'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m14'.$i])) {$value = $select_result['pgt_m14'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m14'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr14'.$i])) {$value = $select_result['pgt_sr14'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr14'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a15'.$i])) {$value = $select_result['pgt_a15'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a15'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m15'.$i])) {$value = $select_result['pgt_m15'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m15'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr15'.$i])) {$value = $select_result['pgt_sr15'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr15'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a16'.$i])) {$value = $select_result['pgt_a16'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a16'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m16'.$i])) {$value = $select_result['pgt_m16'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m16'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr16'.$i])) {$value = $select_result['pgt_sr16'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr16'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a17'.$i])) {$value = $select_result['pgt_a17'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a17'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m17'.$i])) {$value = $select_result['pgt_m17'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m17'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr17'.$i])) {$value = $select_result['pgt_sr17'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr17'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a18'.$i])) {$value = $select_result['pgt_a18'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a18'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m18'.$i])) {$value = $select_result['pgt_m18'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m18'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr18'.$i])) {$value = $select_result['pgt_sr18'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr18'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a19'.$i])) {$value = $select_result['pgt_a19'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a19'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m19'.$i])) {$value = $select_result['pgt_m19'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m19'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr19'.$i])) {$value = $select_result['pgt_sr19'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr19'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a20'.$i])) {$value = $select_result['pgt_a20'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a20'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m20'.$i])) {$value = $select_result['pgt_m20'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m20'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr20'.$i])) {$value = $select_result['pgt_sr20'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr20'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a21'.$i])) {$value = $select_result['pgt_a21'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a21'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m21'.$i])) {$value = $select_result['pgt_m21'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m21'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr21'.$i])) {$value = $select_result['pgt_sr21'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr21'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a22'.$i])) {$value = $select_result['pgt_a22'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a22'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m22'.$i])) {$value = $select_result['pgt_m22'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m22'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr22'.$i])) {$value = $select_result['pgt_sr22'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr22'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a23'.$i])) {$value = $select_result['pgt_a23'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a23'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m23'.$i])) {$value = $select_result['pgt_m23'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m23'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr23'.$i])) {$value = $select_result['pgt_sr23'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr23'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a24'.$i])) {$value = $select_result['pgt_a24'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a24'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m24'.$i])) {$value = $select_result['pgt_m24'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m24'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr24'.$i])) {$value = $select_result['pgt_sr24'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr24'.$i.'"></td>';

                        }

                    ?>

                </tr>

                <tr>

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a25'.$i])) {$value = $select_result['pgt_a25'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_a25'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m25'.$i])) {$value = $select_result['pgt_m25'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_m25'.$i.'"></td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr25'.$i])) {$value = $select_result['pgt_sr25'.$i]; }

                            echo '<td><input type="text" maxlength="20" class="form" value="'.$value.'" name="pgt_sr25'.$i.'"></td>';

                        }

                    ?>

                </tr>

            </tbody>

        </table>

    </div>

    <!-- <p class="mt-2"><span>UPLOAD PHOTO</span> <input type="file" id="file" multiple change="onFileChange"/></th></p> -->

<!-- <input type="" name="" class="btn btn-primary mt-2 mb-2" value="submit"> -->

<input type="submit" name="submit" class="btn btn-primary mt-2 mb-2" value="submit">

</table>

</form>


    <!-- print-->   


    <input type="button" id="btn" value="Print" class="btn btn-primary pull-right printbtn" style="margin-right: 120px;" onclick="printtable();">

<div  class="printtable prtable"  id="printtable" style="display:none;" >
<table style="width:100%; border:1px solid #cdcdcd;" id="printtable" border="1">


<tbody id="male_medicine_suggestion_table">

    <table style="text-align: center; width: 90%;" class="table table-bordered table-hover mt-2 table-sm tableMg">

<thead>

            <tr>

                <td colspan="2" class="red-field" style="border:1px solid #cdcdcd;"><h2>PGT EMBRYO DETAILS</h2></td>

                <td colspan="2" style="border:1px solid #cdcdcd;">

                    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&

                            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 

                            isset($select_result['updated_type']) && !empty($select_result['updated_type'])

                            ){?>

                        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>

                    <?php } ?>

                </td>

            </tr>

        </thead>

        <thead>

            <tr>

                <th colspan="2" class="red-field" style="border:1px solid #cdcdcd;"><h4>SELF CYCLE  (S)</h4></th>

                <th colspan="2" style="border:1px solid #cdcdcd;"><h4>DONOR CYCLE (D)</h4></th>

            </tr>

        </thead>

        <thead>

            <tr>

                <th class="red-field" style="border:1px solid #cdcdcd;"><strong>Partners name</strong></th>

                <th style="border:1px solid #cdcdcd;"><?php echo isset($select_result['partners_name'])?$select_result['partners_name']:""; ?></th>

                <th style="border:1px solid #cdcdcd;"><strong>ART bank reg no</strong></th>

                <th style="border:1px solid #cdcdcd;"><?php echo isset($select_result['art_bank_reg_no'])?$select_result['art_bank_reg_no']:""; ?></th>

            </tr>

        </thead>

         <thead>

            <tr >

                <th class="red-field" style="border:1px solid #cdcdcd;"><strong>ID</strong></th>

                <th style="border:1px solid #cdcdcd;"><?php echo isset($select_result['form_id'])?$select_result['form_id']:""; ?></th>

                <th style="border:1px solid #cdcdcd;"><strong>Donor ID</strong></th>

                <th style="border:1px solid #cdcdcd;"><?php echo isset($select_result['donor_d'])?$select_result['donor_d']:""; ?></th>

            </tr>

        </thead>



</table>

</tbody>


</table>


<table class="table table-bordered table-hover mt-2 table-sm    ">

            <colgroup>

                <col span="7" >

                <col span="7" >

                

            </colgroup>

            <thead>

                <tr>

                    <th colspan="7" style="border:1px solid #cdcdcd;"><center>PGT-A</center></th>

                    <th colspan="7" style="border:1px solid #cdcdcd;">PGT-M</th>

                </tr>

                  <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">DATE</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_date'])) {$value = $select_result['pgt_'.$a[$i].'_date']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                        }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">TIME</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_time'])) {$value = $select_result['pgt_'.$a[$i].'_time']; 
 

                        }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">EMBRYOLOGIST</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_embryologist'])) {$value = $select_result['pgt_'.$a[$i].'_embryologist']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">WITNESS</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_witness'])) {$value = $select_result['pgt_'.$a[$i].'_witness']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">DOCTOR</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_doctor'])) {$value = $select_result['pgt_'.$a[$i].'_doctor']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">TOAL NO EMBRYOS FORMED</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_tnofembryo'])) {$value = $select_result['pgt_'.$a[$i].'_tnofembryo']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;" >EMBRYOS SENT FOR PGT-A</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_embryo_sent'])) {$value = $select_result['pgt_'.$a[$i].'_embryo_sent']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>


                </tr>

                  <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;" >Total no biopsy performed</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_biopsy_perform'])) {$value = $select_result['pgt_'.$a[$i].'_biopsy_perform']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                <tr>

                    <?php 

                    $a = array("a","m");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;" >Total biopsy with DNA detected</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_biopsy_total'])) {$value = $select_result['pgt_'.$a[$i].'_biopsy_total']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>      

                </tr>


</thead>

 <thead>

                <tr>

                    <th style="border:1px solid #cdcdcd;">Embryo cell & grade on which biopsy performed</th>

                    <th style="border:1px solid #cdcdcd;">Embryo on which DNA detected</th>

                    <th style="border:1px solid #cdcdcd;">Successful biopsy/tubing</th>

                    <th style="border:1px solid #cdcdcd;">Technique used</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">Result of biopsy</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">No of embryo transferred</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">Fate</th>

                    <th style="border:1px solid #cdcdcd;">Embryo cell & grade on which biopsy performed</th>

                    <th style="border:1px solid #cdcdcd;">Embryo on which DNA detected</th>

                    <th style="border:1px solid #cdcdcd;">Successful biopsy/tubing</th>

                    <th style="border:1px solid #cdcdcd;">Technique used</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">Result of biopsy</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">No of embryo transferred</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">Fate</th>

                   

                </tr>

            </thead>


             <tbody>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a_'.$i])) {$value = $select_result['pgt_a_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m_'.$i])) {$value = $select_result['pgt_m_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>
                  <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a1_'.$i])) {$value = $select_result['pgt_a1_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m1_'.$i])) {$value = $select_result['pgt_m1_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a2_'.$i])) {$value = $select_result['pgt_a2_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m2_'.$i])) {$value = $select_result['pgt_m2_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                 <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a3_'.$i])) {$value = $select_result['pgt_a3_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m3_'.$i])) {$value = $select_result['pgt_m3_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

<tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a4_'.$i])) {$value = $select_result['pgt_a4_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m4_'.$i])) {$value = $select_result['pgt_m4_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a5_'.$i])) {$value = $select_result['pgt_a5_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m5_'.$i])) {$value = $select_result['pgt_m5_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a6'.$i])) {$value = $select_result['pgt_a6'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m6'.$i])) {$value = $select_result['pgt_m6'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a7'.$i])) {$value = $select_result['pgt_a7'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m7'.$i])) {$value = $select_result['pgt_m7'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a8'.$i])) {$value = $select_result['pgt_a8'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m8'.$i])) {$value = $select_result['pgt_m8'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a9'.$i])) {$value = $select_result['pgt_a9'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m9'.$i])) {$value = $select_result['pgt_m9'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a10'.$i])) {$value = $select_result['pgt_a10'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m10'.$i])) {$value = $select_result['pgt_m10'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        
                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a11'.$i])) {$value = $select_result['pgt_a11'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m11'.$i])) {$value = $select_result['pgt_m11'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                      

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a12'.$i])) {$value = $select_result['pgt_a12'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m12'.$i])) {$value = $select_result['pgt_m12'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a13'.$i])) {$value = $select_result['pgt_a13'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m13'.$i])) {$value = $select_result['pgt_m13'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a14'.$i])) {$value = $select_result['pgt_a14'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m14'.$i])) {$value = $select_result['pgt_m14'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                      

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a15'.$i])) {$value = $select_result['pgt_a15'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m15'.$i])) {$value = $select_result['pgt_m15'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a16'.$i])) {$value = $select_result['pgt_a16'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m16'.$i])) {$value = $select_result['pgt_m16'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>

                 <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a17'.$i])) {$value = $select_result['pgt_a17'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m17'.$i])) {$value = $select_result['pgt_m17'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a18'.$i])) {$value = $select_result['pgt_a18'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m18'.$i])) {$value = $select_result['pgt_m18'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       
                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a19'.$i])) {$value = $select_result['pgt_a19'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m19'.$i])) {$value = $select_result['pgt_m19'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a20'.$i])) {$value = $select_result['pgt_a20'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m20'.$i])) {$value = $select_result['pgt_m20'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a21'.$i])) {$value = $select_result['pgt_a21'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m21'.$i])) {$value = $select_result['pgt_m21'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        
                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a22'.$i])) {$value = $select_result['pgt_a22'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m22'.$i])) {$value = $select_result['pgt_m22'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        
                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a23'.$i])) {$value = $select_result['pgt_a23'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m23'.$i])) {$value = $select_result['pgt_m23'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                       

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a24'.$i])) {$value = $select_result['pgt_a24'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m24'.$i])) {$value = $select_result['pgt_m24'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        
                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_a25'.$i])) {$value = $select_result['pgt_a25'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_m25'.$i])) {$value = $select_result['pgt_m25'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                      

                    ?>

                </tr>


                 </tbody>

</table>

<br> <br> <br> <br> <br> <br> <br> <br> <br> <br>  <br> <br> 







  <table class="table table-bordered table-hover mt-2 table-sm">

     <colgroup>

                <col span="7" >

            </colgroup>
<thead>
  <tr>
 <th colspan="7" style="border:1px solid #cdcdcd;">PGT-SR</th>
</tr>


<tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">DATE</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_date'])) {$value = $select_result['pgt_'.$a[$i].'_date']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                        }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">TIME</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_time'])) {$value = $select_result['pgt_'.$a[$i].'_time']; 
 

                        }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

<tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">EMBRYOLOGIST</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_embryologist'])) {$value = $select_result['pgt_'.$a[$i].'_embryologist']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                <tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">WITNESS</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_witness'])) {$value = $select_result['pgt_'.$a[$i].'_witness']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">DOCTOR</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_doctor'])) {$value = $select_result['pgt_'.$a[$i].'_doctor']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;">TOAL NO EMBRYOS FORMED</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_tnofembryo'])) {$value = $select_result['pgt_'.$a[$i].'_tnofembryo']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                 <tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;" >EMBRYOS SENT FOR PGT-A</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_embryo_sent'])) {$value = $select_result['pgt_'.$a[$i].'_embryo_sent']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>


                </tr>

                  <tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;" >Total no biopsy performed</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_biopsy_perform'])) {$value = $select_result['pgt_'.$a[$i].'_biopsy_perform']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>

                </tr>

                <tr>

                    <?php 

                    $a = array("sr");

                    for($i=0;$i<count($a);$i++){

                        echo '<th colspan="4" style="border:1px solid #cdcdcd;" >Total biopsy with DNA detected</th>';

                        $value=""; if(isset($select_result['pgt_'.$a[$i].'_biopsy_total'])) {$value = $select_result['pgt_'.$a[$i].'_biopsy_total']; }

                        echo '<th colspan="3" style="border:1px solid #cdcdcd;">'.$value.'</td></th>';

                    }

                    ?>      

                </tr>

</thead>

 <thead>
 <tr>
 <th style="border:1px solid #cdcdcd;">Embryo cell & grade on which biopsy performed</th>

                    <th style="border:1px solid #cdcdcd;">Embryo on which DNA detected</th>

                    <th style="border:1px solid #cdcdcd;">Successful biopsy/tubing</th>

                    <th style="border:1px solid #cdcdcd;">Technique used</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">Result of biopsy</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">No of embryo transferred</th>

                    <th class="red-field" style="border:1px solid #cdcdcd;">Fate</th>

                     </tr>

                      </thead>

                       <tbody>

                <tr style="height: 20px;">

                    <?php

                        
                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr_'.$i])) {$value = $select_result['pgt_sr_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>
                  <tr style="height: 20px;">

                    <?php

                          for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr1_'.$i])) {$value = $select_result['pgt_sr1_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr2_'.$i])) {$value = $select_result['pgt_sr2_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                 <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr3_'.$i])) {$value = $select_result['pgt_sr3_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

<tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr4_'.$i])) {$value = $select_result['pgt_sr4_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        
                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr5_'.$i])) {$value = $select_result['pgt_sr5_'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr6'.$i])) {$value = $select_result['pgt_sr6'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                      

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr7'.$i])) {$value = $select_result['pgt_sr7'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr8'.$i])) {$value = $select_result['pgt_sr8'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr9'.$i])) {$value = $select_result['pgt_sr9'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php


                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr10'.$i])) {$value = $select_result['pgt_sr10'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr11'.$i])) {$value = $select_result['pgt_sr11'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr12'.$i])) {$value = $select_result['pgt_sr12'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        
                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr13'.$i])) {$value = $select_result['pgt_sr13'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr14'.$i])) {$value = $select_result['pgt_sr14'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr15'.$i])) {$value = $select_result['pgt_sr15'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr16'.$i])) {$value = $select_result['pgt_sr16'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                 <tr style="height: 20px;">

                    <?php

                       
                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr17'.$i])) {$value = $select_result['pgt_sr17'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr18'.$i])) {$value = $select_result['pgt_sr18'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr19'.$i])) {$value = $select_result['pgt_sr19'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        
                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr20'.$i])) {$value = $select_result['pgt_sr20'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr21'.$i])) {$value = $select_result['pgt_sr21'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr22'.$i])) {$value = $select_result['pgt_sr22'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr23'.$i])) {$value = $select_result['pgt_sr23'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                       

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr24'.$i])) {$value = $select_result['pgt_sr24'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>

                <tr style="height: 20px;">

                    <?php

                        

                        for($i=0;$i<=6;$i++){

                        $value=""; if(isset($select_result['pgt_sr25'.$i])) {$value = $select_result['pgt_sr25'.$i]; }

                            echo '<td style="border:1px solid #cdcdcd;">'.$value.'</td>';

                        }

                    ?>

                </tr>


                 </tbody>



</table>


</div>
<script>
function printtable() 
{
    
    
    
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