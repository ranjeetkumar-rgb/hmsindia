<?php
   /* $sql1 = "SELECT DISTINCT ap.wife_name, ap.wife_phone, f.id, f.iic_id, f.frozen_sample, f.freezing_date, f.expiry_date, f.status FROM hms_appointments ap JOIN freezing f 
   WHERE ap.paitent_id = f.iic_id";*/
   
   //$sql1 = "SELECT * FROM hms_patients LEFT JOIN hms_patient_medical_info ON hms_patient_medical_info.patient_id=hms_patients.patient_id LEFT JOIN embryology_discharge_summary ON hms_patients.patient_id = embryology_discharge_summary.iic_id";
  // $sql1 = "SELECT * FROM hms_patients LEFT JOIN embryology_discharge_summary ON hms_patient_medical_info.patient_id=hms_patients.patient_id LEFT JOIN hms_patient_medical_info ON hms_patients.patient_id = embryology_discharge_summary.iic_id";
    
  $sql1 = "SELECT * FROM pcp_ndt where id";
	$query = $this->db->query($sql1);
    $select_result1 = $query->result(); 
   ?>
<div class="col-md-12">
   <!-- Advanced Tables -->
   <!--Consultation  Tables -->
   <div class="card">
      <div class="card-action">
         <h3>Pcp Ndt</h3>
      </div>
      <div class="clearfix"></div>
      <div class="card-content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="consultation_billing_list">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name of Woman Undergoing IVF/ART</th>
                     <th>Age</th>
					 <th>Name Of Husband With Age/Father (in case of Unmarried Divorce Femalf)</th>
                     <th>Complete Address </th>
					 <th>Tel No.</th>
                     <th>Parity Of Woman With Sex of Previous Child</th>
                     <th>Reason for Ivf/Art</th>
                     <th>Detalis Of Referring Doctor</th>
                     <th>Detail Of The Doctor Patient is Further Referredfor Dellvery/Management of Pregnancy</th>
                     <th>Outcome Of the Pregnancy</th>
                     <th>Any Malformation in Newborn Details</th>
					 <th>Center</th>
					 <th>Test Type</th>
					 <th>Date</th>
				 </tr>
               </thead>
               <tbody id="consultation_result">
                  <?php
                     foreach ($select_result1 as $res_val){
                     ?>
                  <tr class="odd gradeX">
                     <td><a href="<?php echo base_url()?>doctors/pcp_ndt_update?ID=<?php echo $res_val->ID; ?>"><?php echo $res_val->iic_id; ?></a></td>
                     <td><?php echo $res_val->wife_name; ?></td>
					 <td style="width:15%"><?php echo $res_val->wife_age; ?></td>
                     <td style="width:15%"><?php echo $res_val->husband_name; ?></td>
                     <td style="width:15%"><?php echo $res_val->wife_address; ?></td>
					 <td style="width:15%"><?php echo $res_val->wife_phone; ?></td>
                     <td style="width:15%">P:<?php echo $res_val->female_pregnancy_other_p; ?>,&nbspL<?php echo $res_val->female_pregnancy_other_l; ?>,&nbspA<?php echo $res_val->female_pregnancy_other_a; ?></td>
					 <td style="width:15%"><?php echo $res_val->details_management_advised; ?></td>
					 <td style="width:15%"><?php echo $res_val->IVF_Consultant; ?></td>
					 <td style="width:15%"><?php echo $res_val->further_referredfor_dellvery; ?></td>
					 <td style="width:15%"><?php echo $res_val->outcome_of_pregnancy; ?></td>
					 <td style="width:15%"><?php echo $res_val->malformation_in_newborn; ?></td>
					 <td style="width:15%"><?php echo $res_val->center; ?></td>
					 <td style="width:15%"><?php echo $res_val->test_type; ?></td>
					 <td style="width:15%"><?php echo $res_val->created; ?></td>
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





