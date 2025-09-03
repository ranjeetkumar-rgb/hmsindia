<?php $all_method =&get_instance(); ?>

  <form class="col-sm-12 col-xs-12" action="<?php echo base_url();?>doctors/consent_book" enctype="multipart/form-data" method="post">
   <input type="hidden" name="action" value="add_consent_book" />
     <div class="row">
      <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Add Sign Consent Book</h3>
      </div>
      <div class="panel-body profile-edit">
	   <div class="row">
	 	 <div class="form-group col-sm-6 col-xs-12">
            <input placeholder="Patient Id" id="patient_id" value="" name="patient_id" type="text" class="form-control">
          </div>
	  </div>
	   <div class="row">
          <div class="form-group col-sm-6 col-xs-12">
            <select id="consent_book_name" name="consent_book_name" class="select2" >
			    <option value="">- - - Select - - -</option>
				<option value="consent_surrogacy">Consent Surrogacy</option>
				<option value="divorced_widow">Divorced/Widow</option>
				<option value="agreement_surrogacy">Agreement for Surrogacy</option>
				<option value="couple_availing_surrogacy">Couple for Availing Surrogacy</option>
				<option value="fitness_surrogate_mother">Fitness of Surrogate Mother</option>
				<option value="consent_withdrawal">Consent Form for Withdrawal</option>
				<option value="screening_surrogate">Screening of the Surrogate</option>
				<option value="acknowledgment">Acknowledgment</option>
				<option value="admission_form">Admission Form</option>
				<option value="ipd_admission_form">IPD Admission Form</option>
				<option value="anesthesia_consent">Anesthesia Consent Form</option>
				<option value="ot_consent">OT Consent Form</option>
				<option value="ovarian_stem_cell">Ovarian Stem Cell</option>
				<option value="consent_blastocyst">Consent for Blastocyst</option>
				<option value="consent_embryo_glue">Consent for Embryo Glue</option>
				<option value="consent_icsi">Consent for ICSI</option>
				<option value="consent_lah">Consent for LAH</option>
				<option value="consent_microfluidics_sperm">Consent for Microfluidics Sperm Selection</option>
				<option value="consent_pgt">Consent for PGT</option>
				<option value="consent_sperm_mobil">Consent for Sperm Mobilization</option>
				<option value="consent_thawing_gametes">Consent for Thawing of Gametes</option>
				<option value="couple_woman_consent">Couple/Woman Consent</option>
				<option value="iui_husbands_semen">IUI - Husband's Semen</option>
				<option value="iui_donors_semen">IUI - Donor's Semen</option>
				<option value="iui_donors_semen_single">IUI - Donor's Semen (Single Woman)</option>
				<option value="embryo_freezing">Embryo Freezing</option>
				<option value="sperm_oocyte_freezing">Sperm/Oocyte Freezing</option>
				<option value="parental_freezing_consent">Parental Freezing Consent (Minor)</option>
				<option value="oocyte_retrieval">Oocyte Retrieval</option>
				<option value="embryo_transfer">Embryo Transfer</option>
				<option value="consent_donor_eggs">Consent for Egg Donation</option>
				<option value="consent_donor_sperm">Consent for Sperm Donation</option>
				<option value="posthumous_retrieval_sperm">Posthumous Retrieval of Sperm</option>
				<option value="consent_withdrawal_form">Consent Form for Withdrawal</option>
				<option value="process_risk_consent_art">Process, Risk, and Consent for ART</option>
				<option value="recipient_couple_donor_egg">Recipient Couple - Donor Egg</option>
				<option value="instructions_consent_semen">Instructions & Consent for Semen Collection</option>
				<option value="pesa_tesa_tese_micro_tese">PESA/TESA/TESE/Micro TESE</option>
				<option value="ovarian_prp">Ovarian PRP</option>
				<option value="uterine_prp">Uterine PRP</option>
				<option value="testicular_prp">Testicular PRP</option>
				<option value="testimonial">Testimonial</option>
				<option value="stimulation_low_ovarian_reserve">Stimulation of Low Ovarian Reserve Females</option>
			</select>
          </div>
        </div>
	  	 <div class="row">
		  <div class="form-group col-sm-6 col-xs-12">
            <input name="transaction_img" id="transaction_img" type="file" class="form-control">
			  <input name="employee_number" id="employee_number" value="<?php echo $_SESSION['logged_mrd']['employee_number']?>" type="hidden" class="form-control">
          
          </div>
		  
        </div>
         <div class="form-group col-sm-12 col-xs-12">
          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />
        </div>
</div>  
</div>
</div>  
</div>  
</form>
<script>
$(function(){
	  // turn the element to select2 select style
	  $('.select2').select2({
		placeholder: "Select Consent Book Name."
	  }).on('change', function(e) {
		var data = $(".select2 option:selected").val();
			
	  });
	
});
</script>
<style>
select#consent_book_name {
    display: block !important;
}
input[type=checkbox], input[type=radio] {
    opacity: 1 !important;
    left: 0 !important;
    position: unset !important;
    margin: 9px !important;
}
.sec3 td {
    text-align: left;
}
.sec2 {
    border: 1px solid #000;
}
.sec2 p {
    margin: 0px;
    padding: 2px 10px;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
td {
  border: 1px solid #000;
  text-align: center;
  padding: 5px; 
}
.ga-pro h3 {
      text-align: center;
    font-size: 25px;
}
form {
    padding-left: 10px;
    margin-bottom: 4px;
}
.nb56ty input {
    width: 100%;
}
.vb45rt td {
	text-align: left; 
	padding-left: 10px;
}
</style>    