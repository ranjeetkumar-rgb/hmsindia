<?php

    // php code to Insert data into mysql database from input text

    if(isset($_POST['submit'])){

        unset($_POST['submit']);

        

        if(!empty($_FILES['image_video_']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_1']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_1']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_1']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_1'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_2']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_2']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_2']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_2'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_3']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_3']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_3']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_3'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_4']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_4']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_4']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_4'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_5']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_5']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_5']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_5'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_6']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_6']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_6']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_6'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_7']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_7']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_7']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_7'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_8']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_8']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_8']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_8'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_9']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_9']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_9']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_9'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_10']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_10']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_10']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_10'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_11']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_11']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_11']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_11'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_12']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_12']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_12']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_12'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_13']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_13']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_13']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_13'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_14']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_14']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_14']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_14'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_15']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_15']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_15']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_15'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_16']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_16']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_16']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_16'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_17']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_17']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_17']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_17'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_18']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_18']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_18']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_18'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_19']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_19']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_19']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_19'] = $transaction_img;

        }

        

        if(!empty($_FILES['image_video_20']['tmp_name'])){

            $dest_path = $this->config->item('upload_path');

            $destination = $dest_path.'procedure-forms-uploads/';

            $NewImageName = rand(4,10000)."-".$_FILES['image_video_20']['name'];

            $transaction_img = base_url().'assets/procedure-forms-uploads/'.$NewImageName;

            move_uploaded_file($_FILES['image_video_20']['tmp_name'], $destination.$NewImageName);

            $_POST['image_video_20'] = $transaction_img;

        }

        

        $select_query = "SELECT * FROM `sperm_preparation` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";

        $select_result = run_select_query($select_query); 

        if(empty($select_result)){

            // mysql query to insert data

            $query = "INSERT INTO `sperm_preparation` SET ";

            $sqlArr = array();

            foreach( $_POST as $key=> $value )

            {

              $sqlArr[] = " $key = '".addslashes($value)."'";

            }       

            $query .= implode(',' , $sqlArr);

        }else{

            // mysql query to update data

            $query = "UPDATE sperm_preparation SET ";

            foreach( $_POST as $key=> $value )

            {

              $sqlArr[] = " $key = '".$value."'"    ;

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

    $select_query = "SELECT * FROM `sperm_preparation` WHERE patient_id='$patient_id' and receipt_number='$receipt_number'";

    $select_result = run_select_query($select_query);  

    

?>




 <form enctype='multipart/form-data'  class ="searchform" name="form" action="" method="POST">

     

<input type="hidden" value="<?php echo $updated_by; ?>" class="form" name="updated_by">

<input type="hidden" value="<?php echo $updated_type; ?>" class="form" name="updated_type">

<input type="hidden" value="<?php echo $updated_at; ?>" class="form" name="updated_at">



     <input type="hidden" value="<?php echo $procedure_id; ?>" class="form" name="procedure_id">

                <input type="hidden" value="<?php echo $patient_id; ?>" class="form" name="patient_id">

                <input type="hidden" value="<?php echo $receipt_number; ?>" class="form" name="receipt_number">

                <input type="hidden" value="pending" name="status"> 

                <div class="container red-field form mt-5 mb-5">

                    <ul class="d-flex mb-1 mt-2 list-unstyled">

                        <div class="table-responsive">

                            <table style="text-align: center;" class="table table-bordered table-hover table-sm red-field">

                                <thead>

                                    <tr>

                                        <th colspan="2"><h2>SEMEN PREPARATION</h2></th>

                                        <th colspan="2">

                            			    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&

                            			            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 

                            			            isset($select_result['updated_type']) && !empty($select_result['updated_type'])

                            			            ){?>

                            			        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>

                            			    <?php } ?>

                            			</th>

                                    </tr>

                                </thead>

                                <thead>

                                    <tr>

                                        <th colspan="2"><h2>SELF CYCLE (S)</h2></th>

                                        <th style="color: black;" colspan="2"><h2>DONOR CYCLE (DI)</h2></th>

                                    </tr>

                                </thead>

                                <thead>

                                    <tr>

                                        <th><strong>PARTNER NAME</strong></th>

                                        <th><input type="text" value="<?php echo isset($select_result['partners_name'])?$select_result['partners_name']:""; ?>" maxlength="20" name="partners_name"></th>

                                        <th style="color: black;"><strong>ART BANK ID</strong></th>

                                        <th><input type="text" value="<?php echo isset($select_result['art_bank_reg_no'])?$select_result['art_bank_reg_no']:""; ?>" maxlength="20" name="art_bank_reg_no"></th>

                                    </tr>

                                </thead>

                                <thead>

                                    <tr>

                                        <th><strong>PATIENT ID</strong></th>

                                        <th><?php echo $patient_id; ?></th>

                                        <th style="color: black;"><strong>DONOR ID</strong></th>

                                        <th><input type="text" value="<?php echo isset($select_result['donor_d'])?$select_result['donor_d']:""; ?>" maxlength="20" name="donor_d"></th>

                                    </tr>

                                </thead>

                            </table>

                        </div>

                    </ul>
                    <table class="table table-bordered table-hover table-sm tableMg">
                            <thead>
                                <tr>

                                    <td rowspan="2" style="background: #FFFFFF;">SNO</td>

                                    <td colspan="3" style="background: #ffd965;">PRODUCED AT</td>

                                    <td rowspan="2" style="background: #b4c6e7;">Abstinence</td>

                                    <td rowspan="2" style="background: #d0cece;">VOLUME</td>

                                    <td colspan="2" style="background: #fbe4d5;">All sperm counted</td>

                                    <td colspan="2" style="background: #e2efd9;">Progressively motile sperm</td>

                                    <td rowspan="2" style="background: #f4b083;">Morphology</td>

                                    <td rowspan="2" style="background: #8eaadb;">Pus cells</td>

                                    <td rowspan="2" style="background: #a8d08d;">Agglutination</td>

                                    <td rowspan="2" style="background: #ffd965;">C&S</td>

                                    <td rowspan="2" style="background: #d8d8d8;">Method of PREPERATION</td>

                                    <td rowspan="2" style="background: #f4b083;">Purpose</td>

                                    <td rowspan="2" style="background: #adb9ca;">Media used</td>

                                    <td rowspan="2" style="background: #a8d08d;">Remarks</td>

                                    <td rowspan="2" style="background: #e7e6e6;">Image/ video</td>

                                    <td colspan="6" style="background: #bf9000;">Freezing</td>

                                    <td colspan="3" style="background: #92d050;">Thawing</td>

                                    <td rowspan="2" style="background: #8eaadb;">Storage renewal date</td>

                                    <td colspan="2" style="background: #ffd965;">Discard /take away</td>

                                    <td rowspan="2" style="background: #efb8b8;">PREPARED BY</td>
									 <td rowspan="2" style="background: #f1d8d8;">MACS</td>
									  <td rowspan="2" style="background: #e68585;">Qualis</td>
									   <td rowspan="2" style="background: #57d7e4">Pentoxyphyline </td>

                                    <td rowspan="2" style="background: #e6e0db;">WITNESS 1</td>

                                    <td rowspan="2" style="background: #efd9c6;">WITNESS 2</td>

                                </tr>

                                <tr>

                                    <td style="background: #ffd965;">Centre</td>

                                    <td style="background: #ffd965;">Home</td>

                                    <td style="background: #ffd965;">Sperm retreival</td>

                                    <td style="background: #fbe4d5;">PRE WASH</td>

                                    <td style="background: #fbe4d5;">POST WASH</td>

                                    <td style="background: #e2efd9;">PRE WASH</td>

                                    <td style="background: #e2efd9;">POST WASH</td>

                                    <td style="background: #bf9000;">Date</td>

                                    <td style="background: #bf9000;">MEDIA</td>

                                    <td style="background: #bf9000;">CONTAINER NUMBER</td>

                                    <td style="background: #bf9000;">HOLDER NO</td>

                                    <td style="background: #bf9000;">COLOUR</td>

                                    <td style="background: #bf9000;">POSITION-</td>

                                    <td style="background: #92d050;">Date</td>

                                    <td style="background: #92d050;">PURPOSE</td>

                                    <td style="background: #92d050;">THAWING PATH</td>

                                    <td style="background: #ffd965;">DATE</td>

                                    <td style="background: #ffd965;">PURPOSE</td>

                                </tr>

                                <tr>

                                    <td><input type="number" min="0" name="s_no_"> </td>

                                    <td style="background: #ffd965;">

                                        <input type="radio"  name="produced_at_center_" value="Yes" <?php if(isset($select_result['produced_at_center_']) && $select_result['produced_at_center_'] == "Yes"){echo 'checked="checked"'; }?> > Yes <br>

                                        <input type="radio"  name="produced_at_center_" value="No" <?php if(isset($select_result['produced_at_center_']) && $select_result['produced_at_center_'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['produced_at_center_']) && $select_result['produced_at_center_'] != "Yes"){echo 'checked="checked"';}?> > No

                                    </td>

                                    <td style="background: #ffd965;">

                                        <input type="radio"  name="produced_at_home_" value="Yes" <?php if(isset($select_result['produced_at_home_']) && $select_result['produced_at_home_'] == "Yes"){echo 'checked="checked"'; }?> > Yes <br>

                                        <input type="radio"  name="produced_at_home_" value="No" <?php if(isset($select_result['produced_at_home_']) && $select_result['produced_at_home_'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['produced_at_home_']) && $select_result['produced_at_home_'] != "Yes"){echo 'checked="checked"';}?> > No

                                    </td>f

                                    <td style="background: #ffd965;">

                                        <input type="radio"  name="produced_at_sperm_retreival_" value="Yes" <?php if(isset($select_result['produced_at_sperm_retreival_']) && $select_result['produced_at_sperm_retreival_'] == "Yes"){echo 'checked="checked"'; }?> > Yes <br>

                                        <input type="radio"  name="produced_at_sperm_retreival_" value="No" <?php if(isset($select_result['produced_at_sperm_retreival_']) && $select_result['produced_at_sperm_retreival_'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['produced_at_sperm_retreival_']) && $select_result['produced_at_sperm_retreival_'] != "Yes"){echo 'checked="checked"';}?> > No

                                    </td>

                                    <td style="background: #b4c6e7;"><input type="number" value="<?php echo isset($select_result['abstinence_'])?$select_result['abstinence_']:""; ?>" min="0" name="abstinence_"></td>

                                    <td style="background: #d0cece;"><input type="text" pattern="[-+]?[0-9]*[.,]?[0-9]+" value="<?php echo isset($select_result['volume_'])?$select_result['volume_']:""; ?>" min="0" name="volume_"></td>

                                    <td style="background: #fbe4d5;"><input type="text" value="<?php echo isset($select_result['sperm_counted_pre_wash_'])?$select_result['sperm_counted_pre_wash_']:""; ?>" maxlength="20" name="sperm_counted_pre_wash_"></td>

                                    <td style="background: #fbe4d5;"><input type="text" value="<?php echo isset($select_result['sperm_counted_post_wash_'])?$select_result['sperm_counted_post_wash_']:""; ?>" maxlength="20" name="sperm_counted_post_wash_"></td>

                                    <td style="background: #e2efd9;"><input type="text" value="<?php echo isset($select_result['progressively_pre_wash_'])?$select_result['progressively_pre_wash_']:""; ?>" maxlength="20" name="progressively_pre_wash_"></td>

                                    <td style="background: #e2efd9;"><input type="text" value="<?php echo isset($select_result['progressively_post_wash_'])?$select_result['progressively_post_wash_']:""; ?>" maxlength="20" name="progressively_post_wash_"></td>

                                    <td style="background: #f4b083;"><input type="text" value="<?php echo isset($select_result['morphology_'])?$select_result['morphology_']:""; ?>" maxlength="20" name="morphology_"></td>

                                    <td style="background: #8eaadb;"><input type="text" value="<?php echo isset($select_result['pus_cells_'])?$select_result['pus_cells_']:""; ?>" maxlength="20" name="pus_cells_"></td>

                                    <td style="background: #a8d08d;">

                                        <input type="radio"  name="agglutination_" value="Yes" <?php if(isset($select_result['agglutination_']) && $select_result['agglutination_'] == "Yes"){echo 'checked="checked"'; }?> > Yes <br>

                                        <input type="radio"  name="agglutination_" value="No" <?php if(isset($select_result['agglutination_']) && $select_result['agglutination_'] == "No"){echo 'checked="checked"'; }

  else if(isset($select_result['agglutination_']) && $select_result['agglutination_'] != "Yes"){echo 'checked="checked"';}?> > No

                                    </td>

                                    <td style="background: #ffd965;">

                                        <input type="radio"  name="cands_" value="Sterile" <?php if(isset($select_result['cands_']) && $select_result['cands_'] == "Sterile"){echo 'checked="checked"'; }?> > Sterile <br>

                                        <input type="radio"  name="cands_" value="Non_Sterile" <?php if(isset($select_result['cands_']) && $select_result['cands_'] == "Non_Sterile"){echo 'checked="checked"'; }?> > Non Sterile

                                    </td>

                                    <td style="background: #d8d8d8;"><input type="text" value="<?php echo isset($select_result['preperation_method_'])?$select_result['preperation_method_']:""; ?>" maxlength="20" name="preperation_method_"></td>

                                    <td style="background: #f4b083;">

                                        <div><input type="radio"  name="purpose_" value="IUI" <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "IUI"){echo 'checked="checked"'; }?> > IUI </div>

                                        <div><input type="radio"  name="purpose_" value="IVF" <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "IVF"){echo 'checked="checked"'; }?> > IVF </div>

                                        <div><input type="radio"  name="purpose_" value="ICSI" <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "ICSI"){echo 'checked="checked"'; }?> > ICSI </div>

                                        <div><input type="radio"  name="purpose_" value="FREEZING" <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "FREEZING"){echo 'checked="checked"'; }?> > FREEZING </div>



                                    </td>

                                    <td style="background: #adb9ca;"><input type="text" value="<?php echo isset($select_result['media_used_'])?$select_result['media_used_']:""; ?>" maxlength="20" name="media_used_"></td>

                                    <td style="background: #a8d08d;"><input type="text" value="<?php echo isset($select_result['remarks_'])?$select_result['remarks_']:""; ?>" maxlength="20" name="remarks_"></td>

                                    <td style="background: #e7e6e6;">

                                        <input type="file" name="image_video_">

                                        <a target="_blank" href="<?php echo !empty($select_result['image_video_'])?$select_result['image_video_']:"javascript:void(0)"; ?>">Download</a>

                                    </td>

                                    <td style="background: #bf9000;"><input type="date" value="<?php echo isset($select_result['freezing_date_'])?$select_result['freezing_date_']:""; ?>" name="freezing_date_"></td>

                                    <td style="background: #bf9000;"><input type="text" value="<?php echo isset($select_result['freezing_media_'])?$select_result['freezing_media_']:""; ?>" maxlength="20" name="freezing_media_"></td>

                                    <td style="background: #bf9000;"><input type="text" value="<?php echo isset($select_result['freezing_container_no_'])?$select_result['freezing_container_no_']:""; ?>" maxlength="20" name="freezing_container_no_"></td>

                                    <td style="background: #bf9000;"><input type="text" value="<?php echo isset($select_result['freezing_holder_no_'])?$select_result['freezing_holder_no_']:""; ?>" maxlength="20" name="freezing_holder_no_"></td>

                                    <td style="background: #bf9000;"><input type="text" value="<?php echo isset($select_result['freezing_colour_'])?$select_result['freezing_colour_']:""; ?>" maxlength="20" name="freezing_colour_"></td>

                                    <td style="background: #bf9000;">

                                        <input type="radio"  name="freezing_position_" value="ABOVE"> ABOVE <br>

                                        <input type="radio"  name="freezing_position_" value="BELOW"> BELOW

                                    </td>

                                    <td style="background: #92d050;"><input type="date" value="<?php echo isset($select_result['thawing_date_'])?$select_result['thawing_date_']:""; ?>" name="thawing_date_"></td>

                                    <td style="background: #92d050;"><input type="text" value="<?php echo isset($select_result['thawing_purpose_'])?$select_result['thawing_purpose_']:""; ?>" maxlength="20" name="thawing_purpose_"></td>

                                    <td style="background: #92d050;"><input type="text" value="<?php echo isset($select_result['thawing_path_'])?$select_result['thawing_path_']:""; ?>" maxlength="20" name="thawing_path_"></td>

                                    <td style="background: #8eaadb;"><input type="date" value="<?php echo isset($select_result['storage_renewal_date_'])?$select_result['storage_renewal_date_']:""; ?>" name="storage_renewal_date_"></td>

                                    <td style="background: #ffd965;"><input type="date" value="<?php echo isset($select_result['take_away_date_'])?$select_result['take_away_date_']:""; ?>" name="take_away_date_"></td>

                                    <td style="background: #ffd965;"><input type="text" value="<?php echo isset($select_result['take_away_purpose_'])?$select_result['take_away_purpose_']:""; ?>" maxlength="20" name="take_away_purpose_"></td>

                                    <td style="background: #efb8b8;"><input type="text" value="<?php echo isset($select_result['prepared_by_'])?$select_result['prepared_by_']:""; ?>" maxlength="20" name="prepared_by_"></td>

                                    <td style="background: #f1d8d8;"><input type="text" value="<?php echo isset($select_result['macs_'])?$select_result['macs_']:""; ?>" maxlength="20" name="macs_"></td>

                                    <td style="background: #e68585;"> <input type="text" value="<?php echo isset($select_result['qualis_'])?$select_result['qualis_']:""; ?>" maxlength="20" name="qualis_"></td>

                                   <td style="background: #57d7e4;"><input type="text" value="<?php echo isset($select_result['pentoxyphyline_'])?$select_result['pentoxyphyline_']:""; ?>" maxlength="20" name="pentoxyphyline_"></td>

                                    <td style="background: #e6e0db;"><input type="text" value="<?php echo isset($select_result['witness_1_'])?$select_result['witness_1_']:""; ?>" maxlength="20" name="witness_1_"></td>

                                    <td style="background: #efd9c6;"><input type="text" value="<?php echo isset($select_result['witness_2_'])?$select_result['witness_2_']:""; ?>" maxlength="20" name="witness_2_"></td>




							 </tr>



        <?php

            for($i=1;$i<=20;$i++){

                echo '<tr>';

                    $value1 = '';

                    if(isset($select_result['s_no_'.$i])) {$value = $select_result['s_no_'.$i]; }

                    echo '<td><input type="number" min="0" value="'.$value1.'" name="s_no_'.$i.'"></td>';



                    $yes_selected_2 = $no_selected_2 = '';

                    if(isset($select_result['produced_at_center_'.$i]) && $select_result['produced_at_center_'.$i] == "Yes") 

                    {$yes_selected_2 = 'checked="checked"'; }

                    if(isset($select_result['produced_at_center_'.$i]) && $select_result['produced_at_center_'.$i] == "No") 

                    {$no_selected_2 = 'checked="checked"'; }

                    echo '<td style="background: #ffd965;">';

                        echo '<input type="radio"  name="produced_at_center_'.$i.'" '.$yes_selected_2.' value="Yes"> Yes <br>';

                        echo '<input type="radio"  name="produced_at_center_'.$i.'" '.$no_selected_2.' value="No"> No';

                    echo '</td>';



                    $yes_selected_3 = $no_selected_3 = '';

                    if(isset($select_result['produced_at_home_'.$i]) && $select_result['produced_at_home_'.$i] == "Yes") 

                    {$yes_selected_3 = 'checked="checked"'; }

                    if(isset($select_result['produced_at_home_'.$i]) && $select_result['produced_at_home_'.$i] == "No") 

                    {$no_selected_3 = 'checked="checked"'; }

                    echo '<td style="background: #ffd965;">';

                        echo '<input type="radio"  name="produced_at_home_'.$i.'" '.$yes_selected_3.' value="Yes"> Yes <br>';

                        echo '<input type="radio"  name="produced_at_home_'.$i.'" '.$no_selected_3.' value="No"> No';

                    echo '</td>';



                    $yes_selected_4 = $no_selected_4 = '';

                    if(isset($select_result['produced_at_sperm_retreival_'.$i]) && $select_result['produced_at_sperm_retreival_'.$i] == "Yes") 

                    {$yes_selected_4 = 'checked="checked"'; }

                    if(isset($select_result['produced_at_sperm_retreival_'.$i]) && $select_result['produced_at_sperm_retreival_'.$i] == "No") 

                    {$no_selected_4 = 'checked="checked"'; }

                    echo '<td style="background: #ffd965;">';

                        echo '<input type="radio"  name="produced_at_sperm_retreival_'.$i.'" '.$yes_selected_4.' value="Yes"> Yes <br>';

                        echo '<input type="radio"  name="produced_at_sperm_retreival_'.$i.'" '.$no_selected_4.' value="No"> No';

                    echo '</td>';



                    $value5 = '';

                    if(isset($select_result['abstinence_'.$i])) {$value5 = $select_result['abstinence_'.$i]; }

                    echo '<td style="background: #b4c6e7;"><input type="number" value="'.$value5.'" min="0" name="abstinence_'.$i.'"></td>';



                    $value6 = '';

                    if(isset($select_result['volume_'.$i])) {$value6 = $select_result['volume_'.$i]; }

                    echo '<td style="background: #d0cece;"><input type="text"  pattern="[-+]?[0-9]*[.,]?[0-9]+" value="'.$value6.'" min="0" name="volume_'.$i.'"></td>';



                    $value7 = '';

                    if(isset($select_result['sperm_counted_pre_wash_'.$i])) {$value7 = $select_result['sperm_counted_pre_wash_'.$i]; }

                    echo '<td style="background: #fbe4d5;"><input type="text" maxlength="20" value="'.$value7.'" name="sperm_counted_pre_wash_'.$i.'"></td>';



                    $value8 = '';

                    if(isset($select_result['sperm_counted_post_wash_'.$i])) {$value8 = $select_result['sperm_counted_post_wash_'.$i]; }

                    echo '<td style="background: #fbe4d5;"><input type="text" maxlength="20" value="'.$value8.'" name="sperm_counted_post_wash_'.$i.'"></td>';



                    $value9 = '';

                    if(isset($select_result['progressively_pre_wash_'.$i])) {$value9 = $select_result['progressively_pre_wash_'.$i]; }

                    echo '<td style="background: #e2efd9;"><input type="text" maxlength="20" value="'.$value9.'" name="progressively_pre_wash_'.$i.'"></td>';



                    $value10 = '';

                    if(isset($select_result['progressively_post_wash_'.$i])) {$value10 = $select_result['progressively_post_wash_'.$i]; }

                    echo '<td style="background: #e2efd9;"><input type="text" maxlength="20" value="'.$value10.'" name="progressively_post_wash_'.$i.'"></td>';



                    $value11 = '';

                    if(isset($select_result['morphology_'.$i])) {$value11 = $select_result['morphology_'.$i]; }

                    echo '<td style="background: #f4b083;"><input type="text" maxlength="20" value="'.$value11.'" name="morphology_'.$i.'"></td>';



                    $value12 = '';

                    if(isset($select_result['pus_cells_'.$i])) {$value12 = $select_result['pus_cells_'.$i]; }

                    echo '<td style="background: #8eaadb;"><input type="text" maxlength="20" value="'.$value12.'" name="pus_cells_'.$i.'"></td>';



                    $yes_selected_13 = $no_selected_13 = '';

                    if(isset($select_result['agglutination_'.$i]) && $select_result['agglutination_'.$i] == "Yes") 

                    {$yes_selected_13 = 'checked="checked"'; }

                    if(isset($select_result['agglutination_'.$i]) && $select_result['agglutination_'.$i] == "No") 

                    {$no_selected_13 = 'checked="checked"'; }

                    echo '<td style="background: #a8d08d;">';

                        echo '<input type="radio"  name="agglutination_'.$i.'" '.$yes_selected_13.' value="Yes"> Yes <br>';

                        echo '<input type="radio"  name="agglutination_'.$i.'" '.$no_selected_13.' value="No"> No';

                    echo '</td>';



                    $yes_selected_14 = $no_selected_14 = '';

                    if(isset($select_result['cands_'.$i]) && $select_result['cands_'.$i] == "Yes") 

                    {$yes_selected_14 = 'checked="checked"'; }

                    if(isset($select_result['cands_'.$i]) && $select_result['cands_'.$i] == "No") 

                    {$no_selected_14 = 'checked="checked"'; }

                    echo '<td style="background: #ffd965;">';

                        echo '<input type="radio"  name="cands_'.$i.'" '.$yes_selected_14.' value="Sterile"> Sterile <br>';

                        echo '<input type="radio"  name="cands_'.$i.'" '.$no_selected_14.' value="Non_Sterile"> Non Sterile';

                    echo '</td>';



                    $value15 = '';

                    if(isset($select_result['preperation_method_'.$i])) {$value15 = $select_result['preperation_method_'.$i]; }

                    echo '<td style="background: #d8d8d8;"><input type="text" maxlength="20" value="'.$value15.'" name="preperation_method_'.$i.'"></td>';



                    $iui_selected_16 = $ivf_selected_16 = $icsi_selected_16 = $freezing_selected_16 = '';

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "IUI") 

                    {$iui_selected_16 = 'checked="checked"'; }

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "IVF") 

                    {$ivf_selected_16 = 'checked="checked"'; }

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "ICSI") 

                    {$icsi_selected_16 = 'checked="checked"'; }

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "FREEZING") 

                    {$freezing_selected_16 = 'checked="checked"'; }

                    echo '<td style="background: #f4b083;">';

                        echo '<div><input type="radio"  name="purpose_'.$i.'" '.$iui_selected_16.' value="IUI"> IUI </div>';

                        echo '<div><input type="radio"  name="purpose_'.$i.'" '.$ivf_selected_16.' value="IVF"> IVF </div>';

                        echo '<div><input type="radio"  name="purpose_'.$i.'" '.$icsi_selected_16.' value="ICSI"> ICSI </div>';

                        echo '<div><input type="radio"  name="purpose_'.$i.'" '.$freezing_selected_16.' value="FREEZING"> FREEZING </div>';

                    echo '</td>';



                    $value17 = '';

                    if(isset($select_result['media_used_'.$i])) {$value17 = $select_result['media_used_'.$i]; }

                    echo '<td style="background: #adb9ca;"><input type="text" maxlength="20" value="'.$value17.'" name="media_used_'.$i.'"></td>';



                    $value18 = '';

                    if(isset($select_result['remarks_'.$i])) {$value17 = $select_result['remarks_'.$i]; }

                    echo '<td style="background: #a8d08d;"><input type="text" maxlength="20" value="'.$value18.'" name="remarks_'.$i.'"></td>';

                    

                    $file_value = "javascript:void(0)";

                    if(!empty($select_result['image_video_'.$i])){

                        $file_value = $select_result['image_video_'.$i];

                    }

                    echo '<td style="background: #e7e6e6;">

                    <input type="file" name="image_video_'.$i.'">

                    <a target="_blank" href="'.$file_value.'">Download</a>

                    </td>';



                    $value20 = '';

                    if(isset($select_result['freezing_date_'.$i])) {$value20 = $select_result['freezing_date_'.$i]; }

                    echo '<td style="background: #bf9000;"><input type="date" value="'.$value20.'" name="freezing_date_'.$i.'"></td>';



                    $value21 = '';

                    if(isset($select_result['freezing_media_'.$i])) {$value21 = $select_result['freezing_media_'.$i]; }

                    echo '<td style="background: #bf9000;"><input type="text" value="'.$value21.'" maxlength="20" name="freezing_media_'.$i.'"></td>';



                    $value22 = '';

                    if(isset($select_result['freezing_container_no_'.$i])) {$value22 = $select_result['freezing_container_no_'.$i]; }

                    echo '<td style="background: #bf9000;"><input type="text" maxlength="20" value="'.$value22.'" name="freezing_container_no_'.$i.'"></td>';



                    $value23 = '';

                    if(isset($select_result['freezing_holder_no_'.$i])) {$value23 = $select_result['freezing_holder_no_'.$i]; }

                    echo '<td style="background: #bf9000;"><input type="text" maxlength="20" value="'.$value23.'" name="freezing_holder_no_'.$i.'"></td>';



                    $value24 = '';

                    if(isset($select_result['freezing_colour_'.$i])) {$value24 = $select_result['freezing_colour_'.$i]; }

                    echo '<td style="background: #bf9000;"><input type="text" maxlength="20" value="'.$value24.'" name="freezing_colour_'.$i.'"></td>';



                    $above_selected_25 = $below_selected_25 = 'c';

                    if(isset($select_result['freezing_position_'.$i]) && $select_result['freezing_position_'.$i] == "ABOVE") 

                    {$above_selected_25 = 'checked="checked"'; }

                    if(isset($select_result['freezing_position_'.$i]) && $select_result['freezing_position_'.$i] == "BELOW") 

                    {$below_selected_25 = 'checked="checked"'; }

                    echo '<td style="background: #bf9000;">';

                        echo '<input type="radio"  name="freezing_position_'.$i.'" '.$above_selected_25.' value="ABOVE"> ABOVE <br>';

                        echo '<input type="radio"  name="freezing_position_'.$i.'" '.$below_selected_25.' value="BELOW"> BELOW';

                    echo '</td>';



                    $value26 = '';

                    if(isset($select_result['thawing_date_'.$i])) {$value26 = $select_result['thawing_date_'.$i]; }

                    echo '<td style="background: #92d050;"><input type="date" value="'.$value26.'" name="thawing_date_'.$i.'"></td>';



                    $value27 = '';

                    if(isset($select_result['thawing_purpose_'.$i])) {$value27 = $select_result['thawing_purpose_'.$i]; }

                    echo '<td style="background: #92d050;"><input type="text" maxlength="20" value="'.$value27.'" name="thawing_purpose_'.$i.'"></td>';



                    $value28 = '';

                    if(isset($select_result['thawing_path_'.$i])) {$value28 = $select_result['thawing_path_'.$i]; }

                    echo '<td style="background: #92d050;"><input type="text" maxlength="20" value="'.$value28.'" name="thawing_path_'.$i.'"></td>';



                    $value29 = '';

                    if(isset($select_result['storage_renewal_date_'.$i])) {$value29 = $select_result['storage_renewal_date_'.$i]; }

                    echo '<td style="background: #8eaadb;"><input type="date" value="'.$value29.'" name="storage_renewal_date_'.$i.'"></td>';



                    $value30 = '';

                    if(isset($select_result['take_away_date_'.$i])) {$value30 = $select_result['take_away_date_'.$i]; }

                    echo '<td style="background: #ffd965;"><input type="date" value="'.$value30.'" name="take_away_date_'.$i.'"></td>';



                    $value31 = '';

                    if(isset($select_result['take_away_purpose_'.$i])) {$value31 = $select_result['take_away_purpose_'.$i]; }

                    echo '<td style="background: #ffd965;"><input type="text" maxlength="20" value="'.$value31.'" name="take_away_purpose_'.$i.'"></td>';



                    $value32 = '';

                    if(isset($select_result['prepared_by_'.$i])) {$value32 = $select_result['prepared_by_'.$i]; }

                    echo '<td style="background: #efb8b8;"><input type="text" maxlength="20" value="'.$value32.'" name="prepared_by_'.$i.'"></td>';



                     $value33 = '';

                    if(isset($select_result['macs_'.$i])) {$value33 = $select_result['macs_'.$i]; }

                    echo '<td style="background: #f1d8d8;"><input type="text" maxlength="20" value="'.$value33.'" name="macs_'.$i.'"></td>';




                    $value34 = '';

                    if(isset($select_result['qualis_'.$i])) {$value34 = $select_result['qualis_'.$i]; }

                    echo '<td style="background: #e68585;"><input type="text" maxlength="20" value="'.$value34.'" name="qualis_'.$i.'"></td>';




                 $value35 = '';

                    if(isset($select_result['pentoxyphyline_'.$i])) {$value35 = $select_result['pentoxyphyline_'.$i]; }

                    echo '<td style="background: #57d7e4;"><input type="text" maxlength="20" value="'.$value35.'" name="pentoxyphyline_'.$i.'"></td>';





                    $value36 = '';

                    if(isset($select_result['witness_1_'.$i])) {$value36 = $select_result['witness_1_'.$i]; }

                    echo '<td style="background: #e6e0db;"><input type="text" maxlength="20" value="'.$value36.'" name="witness_1_'.$i.'"></td>';



                    $value37 = '';

                    if(isset($select_result['witness_2_'.$i])) {$value37 = $select_result['witness_2_'.$i]; }

                    echo '<td style="background: #efd9c6;"><input type="text" maxlength="20" value="'.$value37.'" name="witness_2_'.$i.'"></td>';

                echo '</tr>';

            }

        ?>

                            </thead>

                        </table>

                    </div>

                    <!-- <input typechecked="checked" namechecked="checked" class="btn btn-primary mt-2 mb-2" value="submit"> -->

                    <input type="submit" name="submit" class="btn btn-primary mt-2 mb-2" value="submit">

                </div>

            </form>
			
			










		<!--                             print       TABLE                         -->	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			
			<input type="button" id="btn" value="Print" class="btn btn-primary pull-right ptable">

<!-- <div  class="printtable prtable"  id="printtable" >	-->

 <div  class="printtable prtable"  id="printtable"  style="display:none;"> 
<table style="width:100%; border:1px solid #cdcdcd;" id="printtable" border="1">

<thead>
<tbody id="male_medicine_suggestion_table">

								<thead>

                                    <tr>

                                        <th colspan="2"><h2>SEMEN PREPARATION</h2></th>

                                        <th colspan="2">

                            			    <?php if(isset($select_result['updated_by']) && !empty($select_result['updated_by']) &&

                            			            isset($select_result['updated_at']) && !empty($select_result['updated_at']) && 

                            			            isset($select_result['updated_type']) && !empty($select_result['updated_type'])

                            			            ){?>

                            			        <p id="last_updated">Last updated on <?php echo $select_result['updated_at']; ?> by <?php echo last_updated_user($select_result['updated_type'],$select_result['updated_by']); ?></p>

                            			    <?php } ?>

                            			</th>

                                    </tr>

                                </thead>
								
								   <thead>

                                    <tr>

                                        <th colspan="2"><h2>SELF CYCLE (S)</h2></th>

                                        <th style="color: black;" colspan="2"><h2>DONOR CYCLE (DI)</h2></th>

                                    </tr>

                                </thead>
								
								 <thead>

                                    <tr>

                                        <th><strong>PARTNER NAME</strong></th>

                                        <th><?php echo isset($select_result['partners_name'])?$select_result['partners_name']:""; ?></th>

                                        <th style="color: black;"><strong>ART BANK ID</strong></th>

                                        <th><?php echo isset($select_result['art_bank_reg_no'])?$select_result['art_bank_reg_no']:""; ?></th>

                                    </tr>

                                </thead>
								
								 <thead>

                                    <tr>

                                        <th><strong>PATIENT ID</strong></th>

                                        <th><?php echo $patient_id; ?></th>

                                        <th style="color: black;"><strong>DONOR ID</strong></th>

                                        <th><?php echo isset($select_result['donor_d'])?$select_result['donor_d']:""; ?></th>

                                    </tr>

                                </thead>
</tbody>

   </thead>
</table>

<table class="table table-bordered table-hover table-sm tableMg">

 <thead>
 
							<tr>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">SNO</td>

                                    <td colspan="3" style="border:1px solid #cdcdcd;">PRODUCED AT</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Abstinence</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">VOLUME</td>

                                    <td colspan="2" style="border:1px solid #cdcdcd;">All sperm counted</td>

                                    <td colspan="2" style="border:1px solid #cdcdcd;">Progressively motile sperm</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Morphology</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Pus cells</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Agglutination</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">C&S</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Method of PREPERATION</td>

                                   

                                  
                                </tr>
								
								  <tr>

                                    <td style="border:1px solid #cdcdcd;">Centre</td>

                                    <td style="border:1px solid #cdcdcd;">Home</td>

                                    <td style="border:1px solid #cdcdcd;">Sperm retreival</td>

                                    <td style="border:1px solid #cdcdcd;">PRE WASH</td>

                                    <td style="border:1px solid #cdcdcd;">POST WASH</td>

                                    <td style="border:1px solid #cdcdcd;">PRE WASH</td>

                                    <td style="border:1px solid #cdcdcd;">POST WASH</td>


                                </tr>
								
								
								 <tr>

                                    <td style="border:1px solid #cdcdcd;">  </td>

                                    <td style="border:1px solid #cdcdcd;">

                                         <?php if(isset($select_result['produced_at_center_']) && $select_result['produced_at_center_'] == "Yes"){echo 'yes'; }?>
                                          
                                    </td>

                                    <td style="border:1px solid #cdcdcd;">

                                      
                                      
									  <?php if(isset($select_result['produced_at_home_']) && $select_result['produced_at_home_'] == "Yes"){echo 'yes'; }?>
                                      

								 </td>

                                  



								  <td style="border:1px solid #cdcdcd;">

                                      
<?php if(isset($select_result['produced_at_sperm_retreival_']) && $select_result['produced_at_sperm_retreival_'] == "Yes"){echo 'yes'; }?>
                                     


								  </td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['abstinence_'])?$select_result['abstinence_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['volume_'])?$select_result['volume_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['sperm_counted_pre_wash_'])?$select_result['sperm_counted_pre_wash_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['sperm_counted_post_wash_'])?$select_result['sperm_counted_post_wash_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['progressively_pre_wash_'])?$select_result['progressively_pre_wash_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['progressively_post_wash_'])?$select_result['progressively_post_wash_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['morphology_'])?$select_result['morphology_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['pus_cells_'])?$select_result['pus_cells_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;">

                                      

<?php if(isset($select_result['agglutination_']) && $select_result['agglutination_'] == "Yes"){echo 'yes'; }?>
 
  
	


                                    </td>

                                    <td style="border:1px solid #cdcdcd;">

                                       
                                  <?php if(isset($select_result['cands_']) && $select_result['cands_'] == "Sterile"){echo 'Sterile'; }?>
 
  
	



								  </td>

                                    
 <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['preperation_method_'])?$select_result['preperation_method_']:""; ?></td>

                                  
                                   
								   
								   
                                    
                                </tr>
								
								
								  
								
								<?php

            for($i=1;$i<=20;$i++){

                echo '<tr>';

                    $value1 = '';

                    if(isset($select_result['s_no_'.$i])) {$value = $select_result['s_no_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;" >'.$value1.'</td>';


                    $yes_selected_2 = $no_selected_2 = '';
					
                    if(isset($select_result['produced_at_center_'.$i]) && $select_result['produced_at_center_'.$i] == "Yes")
                    {$yes_selected_2 = 'Yes'; }       

                    echo '<td style="border:1px solid #cdcdcd;">';
                        echo '  '.$yes_selected_2.' <br>';
					echo '</td>';
				  
                    $yes_selected_3 = $no_selected_3 = '';

                    if(isset($select_result['produced_at_home_'.$i]) && $select_result['produced_at_home_'.$i] == "Yes") 

                    {$yes_selected_3 = 'Yes"'; }

                   

                    echo '<td style="border:1px solid #cdcdcd;">';

                          echo '  '.$yes_selected_3.' <br>';

                    echo '</td>';



                    $yes_selected_4 = $no_selected_4 = '';

                    if(isset($select_result['produced_at_sperm_retreival_'.$i]) && $select_result['produced_at_sperm_retreival_'.$i] == "Yes") 

                    {$yes_selected_4 = 'Yes"'; }

                    

                    echo '<td style="border:1px solid #cdcdcd;">';

                         echo '  '.$yes_selected_4.' <br>';
                    echo '</td>';



                    $value5 = '';

                    if(isset($select_result['abstinence_'.$i])) {$value5 = $select_result['abstinence_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value5.'</td>';



                    $value6 = '';

                    if(isset($select_result['volume_'.$i])) {$value6 = $select_result['volume_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value6.'</td>';



                    $value7 = '';

                    if(isset($select_result['sperm_counted_pre_wash_'.$i])) {$value7 = $select_result['sperm_counted_pre_wash_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value7.'</td>';



                    $value8 = '';

                    if(isset($select_result['sperm_counted_post_wash_'.$i])) {$value8 = $select_result['sperm_counted_post_wash_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value8.'</td>';



                    $value9 = '';

                    if(isset($select_result['progressively_pre_wash_'.$i])) {$value9 = $select_result['progressively_pre_wash_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value9.'</td>';



                    $value10 = '';

                    if(isset($select_result['progressively_post_wash_'.$i])) {$value10 = $select_result['progressively_post_wash_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value10.'</td>';



                    $value11 = '';

                    if(isset($select_result['morphology_'.$i])) {$value11 = $select_result['morphology_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value11.'</td>';



                    $value12 = '';

                    if(isset($select_result['pus_cells_'.$i])) {$value12 = $select_result['pus_cells_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value12.'</td>';



                    $yes_selected_13 = $no_selected_13 = '';

                    if(isset($select_result['agglutination_'.$i]) && $select_result['agglutination_'.$i] == "Yes") 

                    {$yes_selected_13 = 'Yes'; }

                   

                    echo '<td style="border:1px solid #cdcdcd;">';

                        
                      echo '  '.$yes_selected_13.' <br>';
                        

                    echo '</td>';



                    $yes_selected_14 = $no_selected_14 = '';

                    if(isset($select_result['cands_'.$i]) && $select_result['cands_'.$i] == "Yes") 

                    {$yes_selected_14 = 'Sterile"'; }


                    echo '<td style="border:1px solid #cdcdcd;">';

                        echo '  '.$yes_selected_14.' <br>';	

                    echo '</td>';



                    $value15 = '';

                    if(isset($select_result['preperation_method_'.$i])) {$value15 = $select_result['preperation_method_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value15.'</td>';

 echo '</tr>';

            }

        ?>
								
								


					     
 </thead>
 </table>
 
 
 <!--     End Frist Table       Second Table                            -->
 
 
 

<table class="table table-bordered table-hover table-sm tableMg" style="font-size: 12px;">

 <thead>
 
							<tr>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Purpose</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Media used</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Remarks</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Image/ video</td>

                                    <td colspan="6" style="border:1px solid #cdcdcd;">Freezing</td>

                                    <td colspan="3" style="border:1px solid #cdcdcd;">Thawing</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">Storage renewal date</td>

                                    <td colspan="2" style="border:1px solid #cdcdcd;">Discard /take away</td>

                                 

                                  
                                </tr>
								
								  <tr>

                                      <td style="border:1px solid #cdcdcd;">Date</td>

                                    <td style="border:1px solid #cdcdcd;">MEDIA</td>

                                    <td style="border:1px solid #cdcdcd;">CONTAINER NUMBER</td>

                                    <td style="border:1px solid #cdcdcd;">HOLDER NO</td>

                                    <td style="border:1px solid #cdcdcd;">COLOUR</td>

                                    <td style="border:1px solid #cdcdcd;">POSITION-</td>

                                    <td style="border:1px solid #cdcdcd;">Date</td>

                                    <td style="border:1px solid #cdcdcd;">PURPOSE</td>

                                    <td style="border:1px solid #cdcdcd;">THAWING PATH</td>

                                    <td style="border:1px solid #cdcdcd;">DATE</td>

                                    <td style="border:1px solid #cdcdcd;">PURPOSE</td>


                                </tr>
								
								
						
						
						
						
						
						 <tr>

                                   
                                    <td style="border:1px solid #cdcdcd;">

                                       
 <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "IUI"){echo 'IUI'; }?>
  <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "IVF"){echo 'IVF'; }?>
   <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "ICSI"){echo 'ICSI'; }?>
    <?php if(isset($select_result['purpose_']) && $select_result['purpose_'] == "FREEZING"){echo 'FREEZING'; }?>

                                    </td>

             <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['media_used_'])?$select_result['media_used_']:""; ?></td>

               <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['remarks_'])?$select_result['remarks_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;">

                                        

                                      <?php echo !empty($select_result['image_video_'])?$select_result['image_video_']:" "; ?>

                                    </td>

                                    <td style="border:1px solid #cdcdcd;;"><?php echo isset($select_result['freezing_date_'])?$select_result['freezing_date_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['freezing_media_'])?$select_result['freezing_media_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['freezing_container_no_'])?$select_result['freezing_container_no_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['freezing_holder_no_'])?$select_result['freezing_holder_no_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['freezing_colour_'])?$select_result['freezing_colour_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;">

                                       
                                    <?php if(isset($select_result['freezing_position_']) && $select_result['freezing_position_'] == "ABOVE"){echo 'ABOVE'; }?>
                                   <?php if(isset($select_result['freezing_position_']) && $select_result['freezing_position_'] == "BELOW"){echo 'BELOW'; }?>

								   </td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_date_'])?$select_result['thawing_date_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_purpose_'])?$select_result['thawing_purpose_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['thawing_path_'])?$select_result['thawing_path_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['storage_renewal_date_'])?$select_result['storage_renewal_date_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['take_away_date_'])?$select_result['take_away_date_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd;"><?php echo isset($select_result['take_away_purpose_'])?$select_result['take_away_purpose_']:""; ?></td>

                                   

                                </tr>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
				<?php


                    for($i=1;$i<=20;$i++){

                echo '<tr>';


                  
				  
				   $iui_selected_16 = $ivf_selected_16 = $icsi_selected_16 = $freezing_selected_16 = '';

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "IUI") 

                    {$iui_selected_16 = "IUI"; }

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "IVF") 

                    {$ivf_selected_16 = "IVF"; }

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "ICSI") 

                    {$icsi_selected_16 = "ICSI"; }

                    if(isset($select_result['purpose_'.$i]) && $select_result['purpose_'.$i] == "FREEZING") 

                    {$freezing_selected_16 = "FREEZING"; }

                    echo '<td style="border:1px solid #cdcdcd;">';

                              echo '  '.$iui_selected_16.' <br>';
							  echo '  '.$ivf_selected_16.' <br>';
 echo '  '.$icsi_selected_16.' <br>';
 
 echo '  '.$freezing_selected_16.' <br>'; 


                    echo '</td>';
				  
				  
				  
				  
				  
				  
				  
				  


                    $value17 = '';

                    if(isset($select_result['media_used_'.$i])) {$value17 = $select_result['media_used_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value17.'';



                    $value18 = '';

                    if(isset($select_result['remarks_'.$i])) {$value17 = $select_result['remarks_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value18.'</td>';

                    


                    echo '<td style="border:1px solid #cdcdcd;">

                 

                    </td>';



                    $value20 = '';

                    if(isset($select_result['freezing_date_'.$i])) {$value20 = $select_result['freezing_date_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value20.'</td>';



                    $value21 = '';

                    if(isset($select_result['freezing_media_'.$i])) {$value21 = $select_result['freezing_media_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value21.'</td>';



                    $value22 = '';

                    if(isset($select_result['freezing_container_no_'.$i])) {$value22 = $select_result['freezing_container_no_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value22.'</td>';



                    $value23 = '';

                    if(isset($select_result['freezing_holder_no_'.$i])) {$value23 = $select_result['freezing_holder_no_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value23.'</td>';



                    $value24 = '';

                    if(isset($select_result['freezing_colour_'.$i])) {$value24 = $select_result['freezing_colour_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value24.'</td>';



                    $above_selected_25 = $below_selected_25 = '';

                    if(isset($select_result['freezing_position_'.$i]) && $select_result['freezing_position_'.$i] == "ABOVE") 

                    {$above_selected_25 = 'ABOVE'; }

                    if(isset($select_result['freezing_position_'.$i]) && $select_result['freezing_position_'.$i] == "BELOW") 

                    {$below_selected_25 = 'BELOW"'; }

                    echo '<td style="border:1px solid #cdcdcd;">';

                        
						 echo '  '.$above_selected_25.' <br>';
						 	 echo '  '.$below_selected_25.' <br>';

                    echo '</td>';



                    $value26 = '';

                    if(isset($select_result['thawing_date_'.$i])) {$value26 = $select_result['thawing_date_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value26.'</td>';



                    $value27 = '';

                    if(isset($select_result['thawing_purpose_'.$i])) {$value27 = $select_result['thawing_purpose_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value27.'</td>';



                    $value28 = '';

                    if(isset($select_result['thawing_path_'.$i])) {$value28 = $select_result['thawing_path_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value28.'</td>';



                    $value29 = '';

                    if(isset($select_result['storage_renewal_date_'.$i])) {$value29 = $select_result['storage_renewal_date_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value29.'</td>';



                    $value30 = '';

                    if(isset($select_result['take_away_date_'.$i])) {$value30 = $select_result['take_away_date_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value30.'</td>';



                    $value31 = '';

                    if(isset($select_result['take_away_purpose_'.$i])) {$value31 = $select_result['take_away_purpose_'.$i]; }

                    echo '<td style="border:1px solid #cdcdcd;">'.$value31.'</td>';



                 echo '</tr>';

            }

        ?>
								


					     
 </thead>
 </table>
 
 
 
 
 
 
 
 <!---     END 2nd Table, begin 3rd Table                -->
 
 
 
 <table class="table table-bordered table-hover table-sm tableMg" style="width:100%; font-size: 12px;">

 <thead>
 
							<tr>

                                  

                                   
									
									
									   <td rowspan="2" style="border:1px solid #cdcdcd;">PREPARED BY</td>
									 <td rowspan="2" style="border:1px solid #cdcdcd;">MACS</td>
									  <td rowspan="2" style="border:1px solid #cdcdcd;">Qualis</td>
									   <td rowspan="2" style="border:1px solid #cdcdcd;">Pentoxyphyline </td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">WITNESS 1</td>

                                    <td rowspan="2" style="border:1px solid #cdcdcd;">WITNESS 2</td>
									
									
									

                                  
                                </tr>
 
 
 
 
 
 </thead>
 
 <thead>

                                <tr>
 
                                        <td style="border:1px solid #cdcdcd; height:20px"> <?php echo isset($select_result['prepared_by_'])?$select_result['prepared_by_']:""; ?> </td>

                                  
                                   <td style="border:1px solid #cdcdcd; height:20px">  <?php echo isset($select_result['macs_'])?$select_result['macs_']:""; ?> </td>

                                   <td style="border:1px solid #cdcdcd; height:20px">  <?php echo isset($select_result['qualis_'])?$select_result['qualis_']:""; ?> </td>

                                <td style="border:1px solid #cdcdcd; height:20px ">  <?php echo isset($select_result['pentoxyphyline_'])?$select_result['pentoxyphyline_']:""; ?> </td>

                                                                         
                                    <td style="border:1px solid #cdcdcd; height:20px "><?php echo isset($select_result['witness_1_'])?$select_result['witness_1_']:""; ?></td>

                                    <td style="border:1px solid #cdcdcd; height:20px"><?php echo isset($select_result['witness_2_'])?$select_result['witness_2_']:""; ?></td>
 
 
 
  </tr> 
 
  </thead>
 
 
 
 
 
 
 
 
 
 
 
  <?php

            for($i=1;$i<=20;$i++){

                echo '<tr>';

                    $value1 = '';



                    $value32 = '';

                    if(isset($select_result['prepared_by_'.$i])) {$value32 = $select_result['prepared_by_'.$i]; }

                   

                     echo '<td style="border:1px solid #cdcdcd; height:20px">'.$value32.'</td>';

                     $value33 = '';

                    if(isset($select_result['macs_'.$i])) {$value33 = $select_result['macs_'.$i]; }

                   

                    echo '<td style="border:1px solid #cdcdcd; height:20px">'.$value33.'</td>';


                    $value34 = '';

                    if(isset($select_result['qualis_'.$i])) {$value34 = $select_result['qualis_'.$i]; }

               

               echo '<td style="border:1px solid #cdcdcd; height:20px">'.$value34.'</td>';


                 $value35 = '';

                    if(isset($select_result['pentoxyphyline_'.$i])) {$value35 = $select_result['pentoxyphyline_'.$i]; }

                 

                     echo '<td style="border:1px solid #cdcdcd; height:20px">'.$value35.'</td>';



                    $value36 = '';

                    if(isset($select_result['witness_1_'.$i])) {$value36 = $select_result['witness_1_'.$i]; }

                   
                    echo '<td style="border:1px solid #cdcdcd; height:20px">'.$value36.'</td>';


                    $value37 = '';

                    if(isset($select_result['witness_2_'.$i])) {$value37 = $select_result['witness_2_'.$i]; }

                  
					
					 echo '<td style="border:1px solid #cdcdcd; height:20px">'.$value37.'</td>';

                echo '</tr>';

            }

        ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  </table>
 
 
 
 

</div>









<script>
$(document).ready(function(){
  $(".ptable").click(function(){
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
  });
});
</script>