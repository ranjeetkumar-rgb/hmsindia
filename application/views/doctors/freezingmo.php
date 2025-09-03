<?php

// $json = file_get_contents('php://input');
// // Converts it into a PHP object 
// $data = json_decode($json, true);


// if(!empty($data)){
//    print_r($data);
//    $response = array("success"=> "success", "message" => "Records has been updated");
//    echo json_encode($response);
//    die;
// }

?>
<?php
   /* $sql1 = "SELECT DISTINCT ap.wife_name, ap.wife_phone, f.id, f.iic_id, f.frozen_sample, f.freezing_date, f.expiry_date, f.status FROM hms_appointments ap JOIN freezing f 
   WHERE ap.paitent_id = f.iic_id";*/
    $sql1 = "select * from freezing"; 
    $query = $this->db->query($sql1);
    $select_result1 = $query->result(); 
   ?>
<div class="col-md-12">
   <!-- Advanced Tables -->
   <!--Consultation  Tables -->
   <div class="card">
      <div class="card-action">
         <h3>CRYOPRESERVATION</h3>
      </div>
      <div class="clearfix"></div>
      <div class="card-content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="consultation_billing_list">
               <thead>
                  <tr>
                     <th>Start Date</th>
					 <th>Expiry Date</th>
                     <th>IIC ID</th>
                     <th>Patient name</th>
                     <th>Mobile No</th>
                     <th>First Intimation </th>
                     <th>Mode</th>
                     <th>Second Intimation </th>
                     <th>Mode</th>
                     <th>Cause For Discard</th>
                     <th>Consent Form Signed</th>
                     <th>Status of Discarded/Used Embryos</th>
					 <?php if(isset($_SESSION['logged_embryologist'])){ ?>
					 <th>No. of Straws</th>
					 <th>No of Embryo </th>
					 <th>Embryo Grade</th>
					 <th>Straws Colour</th>
					 <th>Visotube</th>
					 <th>Goblet</th>
					 <th>G- Location</th>
					 
					 <th>Dewar</th>
					 <th>Tank</th>
					 <th>Freezing Done by</th>
					 <th>Thawed On</th>
					 <th>Thawed by</th>
					 <th>Remarks</th>
					 
                     <th>No Of Frozen</th>
                     <th>No Of Discard</th>
                     <th>Remain Frozen</th>
					 <?php } ?>
                     <th>Discard/Used Date</th>
                     <th>Frozen Sample</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="consultation_result">
                  <?php
                     foreach ($select_result1 as $res_val){
                     ?>
                  <tr class="odd gradeX">
				     <td style="width:10%"><?php echo $res_val->freezing_date ?></td>
                     <td style="width:10%"><?php echo $res_val->expiry_date ?></td>
					 
                     <td>
                       <a href="<?php echo base_url()?>doctors/patient_details?id=<?php echo $res_val->id; ?>"><?php echo $res_val->iic_id; ?></a>
                     </td>
                     <td><?php echo $res_val->wife_name; ?></td>
                     <td><?php echo sting_masking($res_val->wife_phone);  ?></td>
                     <td style="width:15%">
					  <?php if (isset($_SESSION['logged_billing_manager']) || isset($_SESSION['logged_counselor'])) { ?>
					  <?php echo $res_val->first_intimation_date ?>
					  <?php } ?>
					 </td>
                     <td style="width:15%">
					  <?php if (isset($_SESSION['logged_billing_manager']) || isset($_SESSION['logged_counselor'])) { ?>
                        <div class="appoint_17701">
                           <select  id="mode_<?php echo $res_val->id ?>" name="mode" class="appointment_status">
                              <option value=""><?php echo $res_val->mode2 ?></option>
                              <option value="whats_app">Whats App</option>
                              <option value="email">Email</option>
                              <option value="sms">SMS</option>
                              <option value="post">Post</option>
                           </select>
                        </div>
						<?php }else{ ?>
						<?php echo $res_val->mode2 ?>
						<?php } ?>
                     </td>
                     <td style="width:15%">
					 <?php if (isset($_SESSION['logged_billing_manager']) || isset($_SESSION['logged_counselor'])) { ?>
					 <input type="date" id="second_intimation_date_<?php echo $res_val->id?>" name="second_intimation_date" value="<?php echo $res_val->second_intimation_date ?>" >
					 <?php }else{ ?>
					 <?php echo $res_val->second_intimation_date ?>
					 <?php } ?>
					 </td>
                     <td style="width:15%">
					  <?php if (isset($_SESSION['logged_billing_manager']) || isset($_SESSION['logged_counselor'])) { ?>
                        <div class="appoint_17701">
                           <select  id="mode2_<?php echo $res_val->id?>" name="mode2" class="appointment_status">
                              <option value=""><?php echo $res_val->mode2 ?></option>
                              <option value="whats_app">Whats App</option>
                              <option value="email">Email</option>
                              <option value="sms">SMS</option>
                              <option value="post">Post</option>
                           </select>
                        </div>
					 <?php }else{ ?>
					 <?php echo $res_val->mode2 ?>
					 <?php } ?>
                     </td>
                     <td style="width:15%">
					  <?php if (isset($_SESSION['logged_billing_manager']) || isset($_SESSION['logged_counselor'])) { ?>
                        <div class="appoint_17701">
                           <select  id="cause_for_discard_<?php echo $res_val->id?>" name="cause_for_discard" class="appointment_status">
                              <option value=""><?php echo $res_val->cause_for_discard ?></option>
                              <option value="does_not_want_to_freeze">Does not want to freeze</option>
                              <option value="financial_issues">Financial Issues</option>
                           </select>
                        </div>
					  <?php }else{ ?>
					  <?php echo $res_val->cause_for_discard ?>
					  <?php } ?>
                     </td>
                     <td style="width:15%">
					   <?php if (isset($_SESSION['logged_billing_manager']) || isset($_SESSION['logged_counselor'])) { ?>
                        <div class="appoint_17701">
                           <select  id="consent_form_signed_<?php echo $res_val->id?>" name="consent_form_signed" class="appointment_status">
                              <option value=""><?php echo $res_val->consent_form_signed ?></option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                           </select>
                        </div>
					  <?php }else{ ?>
					  <?php echo $res_val->consent_form_signed ?>
					  <?php } ?>
                     </td>
                     <td style="width:15%">
                        <?php if(isset($_SESSION['logged_embryologist'])){ ?>
                        <div class="appoint_17701">
                           <select  id="status_of_discarded_<?php echo $res_val->id?>" name="status_of_discarded" class="appointment_status">
                              <option value=""><?php echo $res_val->status_of_discarded ?></option>
                              <option value="use_for_research_purpose">Use for Research Purpose</option>
                              <option value="destroyed">Destroyed</option>
                           </select>
                        </div>
                        <?php }else{ ?>
                        <?php echo $res_val->status_of_discarded ?>
                        <?php } ?>
                     </td>
					 <?php if(isset($_SESSION['logged_embryologist'])){ ?>
					  <td style="width:15%">
                        <input type="text" id="no_of_straws_<?php echo $res_val->id?>" name="no_of_straws" value="<?php echo $res_val->no_of_straws ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="no_of_embryo_<?php echo $res_val->id?>" name="no_of_embryo" value="<?php echo $res_val->no_of_embryo ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="embryo_grade_<?php echo $res_val->id?>" name="embryo_grade" value="<?php echo $res_val->embryo_grade ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="straws_colour_<?php echo $res_val->id?>" name="straws_colour" value="<?php echo $res_val->straws_colour ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="visotube_<?php echo $res_val->id?>" name="visotube" value="<?php echo $res_val->visotube ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="goblet_<?php echo $res_val->id?>" name="goblet" value="<?php echo $res_val->goblet ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="g_location_<?php echo $res_val->id?>" name="g_location" value="<?php echo $res_val->g_location ?>" >
                     </td>
					 
					  <td style="width:15%">
                        <input type="text" id="dewar_<?php echo $res_val->id?>" name="dewar" value="<?php echo $res_val->dewar ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="tank_<?php echo $res_val->id?>" name="tank" value="<?php echo $res_val->tank ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="freezing_done_by_<?php echo $res_val->id?>" name="freezing_done_by" value="<?php echo $res_val->freezing_done_by ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="thawed_On_<?php echo $res_val->id?>" name="thawed_On" value="<?php echo $res_val->thawed_On ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="thawed_by_<?php echo $res_val->id?>" name="thawed_by" value="<?php echo $res_val->thawed_by ?>" >
                     </td>
					  <td style="width:15%">
                        <input type="text" id="remarks_<?php echo $res_val->id?>" name="remarks" value="<?php echo $res_val->remarks ?>" >
                     </td>
					 
                     <td style="width:15%">
                        <input type="text" id="no_ofoocytes_retrieved_<?php echo $res_val->id?>" name="no_ofoocytes_retrieved" value="<?php echo $res_val->no_ofoocytes_retrieved ?>" >
                     </td>
                     <td style="width:15%">
                        <input type="text" id="discard_embryo_<?php echo $res_val->id?>" name="discard_embryo" value="<?php echo $res_val->discard_embryo ?>" >
                     </td>
                     <td style="width:15%">
                        <input type="text" id="remain_embryo_<?php echo $res_val->id?>" name="remain_embryo" value="<?php echo $res_val->remain_embryo ?>" >
                     </td>
                     <?php }?>
                     <td style="width:15%">
                        <?php if(isset($_SESSION['logged_embryologist'])){ ?>
                        <input type="date" id="discard_date_<?php echo $res_val->id?>" name="discard_date" value="<?php echo $res_val->discard_date ?>" >
                        <?php }else{ ?>
                        <?php echo $res_val->discard_date ?>
                        <?php }?>
                     </td>
                     <td style="width:15%"><?php echo $res_val->frozen_sample ?></td>
                     <td style="width:15%">
                        <?php if(isset($_SESSION['logged_embryologist'])){ ?>
                        <div class="appoint_17701">
                           <select  id="discard_status_<?php echo $res_val->id?>" name="discard_status" class="appointment_status">
                              <option value=""><?php echo $res_val->discard_status ?></option>
                              <option value="discard">Discard</option>
							  <option value="used">Used</option>
                           </select>
                        </div>
                        <?php }else{ ?>
                        <?php echo $res_val->status ?>
						<?php echo $res_val->discard_status ?>
                        <?php } ?>
                     </td>
                     <td style="width:15%">
                        <div class="appoint_16793">
                           <input type="button" class="btn btn-primary" id="btnUpdate_<?php echo $res_val->id?>" value="Update" onclick="updateForm('<?php echo $res_val->id?>')">
                        </div>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <!--End Consultation  Tables -->
</div>
<style>
   select.appointment_status {
   display: block!important;
   width: auto!important;
   }
</style>
<script>
   function updateForm(id){
      var first_intimation_date = $('#first_intimation_date_'+id).val()
      var mode = $('#mode_'+id).val()
      var second_intimation_date = $('#second_intimation_date_'+id).val()
      var mode2 = $('#mode2_'+id).val()
      var cause_for_discard = $('#cause_for_discard_'+id).val()
      var consent_form_signed = $('#consent_form_signed_'+id).val()
      var status_of_discarded = $('#status_of_discarded_'+id).val()
	  var no_of_straws = $('#no_of_straws_'+id).val()
	  var no_of_embryo = $('#no_of_embryo_'+id).val()
	  var embryo_grade = $('#embryo_grade_'+id).val()
	  var straws_colour = $('#straws_colour_'+id).val()
	  var visotube = $('#visotube_'+id).val()
	  var goblet = $('#goblet_'+id).val()
	  var g_location = $('#g_location_'+id).val()
	  var dewar = $('#dewar_'+id).val()
	  var tank = $('#tank_'+id).val()
	  var freezing_done_by = $('#freezing_done_by_'+id).val()
	  var thawed_On = $('#thawed_On_'+id).val()
	  var thawed_by = $('#thawed_by_'+id).val()
	  var remarks = $('#remarks_'+id).val()
	  var no_ofoocytes_retrieved = $('#no_ofoocytes_retrieved_'+id).val()
      var discard_embryo = $('#discard_embryo_'+id).val()
      var remain_embryo = $('#remain_embryo_'+id).val()
      var discard_date = $('#discard_date_'+id).val()
      var discard_status = $('#discard_status_'+id).val()

      var data = {
         "id": id,
         "first_intimation_date": first_intimation_date,
         "mode": mode,
         "second_intimation_date": second_intimation_date,
         "mode2": mode2,
         "cause_for_discard": cause_for_discard,
         "consent_form_signed": consent_form_signed,
         "status_of_discarded": status_of_discarded,
		 "no_of_straws": no_of_straws,
		 "no_of_embryo": no_of_embryo,
		 "embryo_grade": embryo_grade,
		 "straws_colour": straws_colour,
		 "visotube": visotube,
		 "goblet": goblet,
		 "g_location": g_location,
		 "dewar": dewar,
		 "tank": tank,
		 "freezing_done_by": freezing_done_by,
		 "thawed_On": thawed_On,
		 "thawed_by": thawed_by,
		 "remarks": remarks,
		 "no_ofoocytes_retrieved": no_ofoocytes_retrieved,
         "discard_embryo": discard_embryo,
         "remain_embryo": remain_embryo,
         "discard_date": discard_date,
         "discard_status": discard_status,
      }

      if (id != ""){
         $.ajax({
            url: '<?php echo base_url('doctors/update_freezingmo')?>',
            //data: data,
            //dataType: 'json',
            method:'post',
            contentType: 'application/json;charset=UTF-8',
            data: JSON.stringify(data),
            success: function(datax){
              
               alert(datax.message)
               id = "";
               first_intimation_date = "";
               mode = "";
               second_intimation_date = "";
               mode2 = "";
               cause_for_discard = "";
               consent_form_signed = "";
               status_of_discarded = "";
			   no_of_straws = "";
			   no_of_embryo = "";
			   embryo_grade = "";
			   straws_colour = "";
			   visotube = "";
			   goblet = "";
			   g_location = "";
			   dewar = "";
			   tank = "";
			   freezing_done_by = "";
			   thawed_On = "";
			   thawed_by = "";
			   remarks = "";
			   no_ofoocytes_retrieved = "";
               discard_embryo = "";
               remain_embryo = "";
               discard_date = "";
               discard_status = "";
            } 
         });  
      }    
   }
</script>