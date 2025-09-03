<?php $all_method =&get_instance(); ?>
<div class="page-wrapper">
<div class="row">
    <div class="col-sm-12 col-xs-12 panel panel-piluku">
      <div class="panel-heading">
        <h3 class="heading">Clinical Reports</h3>
      </div>
       <div class="clearfix"></div>	  
	    <form action=""<?php echo base_url().'accounts/updatereports_admin'; ?>" method="get">
		     <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by Center
                <select class="form-control" id="center" name="center">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($billing_at == $val['center_number']){
                            echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Year</label>
                <select class="form-control" id="year" name="year">
				    <option value=''>--Select From--</option>
                    <option value="2023" mode="2023">2023</option>
					<option value="2022" mode="2022">2022</option>
                    <option value="2021" mode="2021">2021</option>
                    <option value="2020" mode="2020">2020</option>
                    <option value="2019" mode="2019">2019</option>
                    <option value="2018" mode="2018">2018</option>
					<option value="2017" mode="2017">2017</option>
					<option value="2016" mode="2016">2016</option>
				</select>
            </div>
            <div class="col-sm-1" style="margin-top: 30px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 30px;">
            	<a href="<?php echo base_url().'accounts/updatereports_admin'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>  
	  
<div class="clearfix"></div>

      <div class="panel-body profile-edit">
	<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
              <thead>
                <tr>
				
				<?php for ($x = 0; $x <= 11; $x++) { ?>           
				  <th>CENTER</th>
				  <th>MONTH</th>
				  <th>CONSULTATIONS</th>
                  <th>Tele Consult</th>
                  <th>OPU</th>
                  <th>FRESH CYCLE ET</th>
                  <th>THAWED CYCLE / FET</th>
				  <th>IUI</th>
                  <th>IVF</th>
                  <th>ICSI</th>
				  <th>TESA/MTESE</th>
				  <th>DONOR CYCLE</th>
                  <th>SURROGACY</th>
                  <th>Uterine PRP</th>
                  <th>Ovarian PRP</th>
                  <th>Testicular PRP</th>
                  <th>MACS/QUALIS/ Candor</th>
				  <th>LAH</th>
                  <th>PGD</th>
                  <th>EMBRYO GLUE</th>
				  <th>Sperm Mobil</th>
				  <th>Blastocyst</th>
                  <th>HYSTEROSCOPY DIAGNOSTIC</th>
				  <th>LAPAROSCOPY PLUS HYSTEROSCOPY</th>
				  <th>BETA HCG POSITIVE</th>
                  <th>CARDIAC ACTIVITY</th>
                  <th>LIVE BIRTH </th>
				  <th>MALE</th>
				  <th>FEMALE</th>
				  <th>ONGOING</th>
				  <th>IVM</th>
				  <th>EGG FREEZING</th>
				  <th>SEMEN FREEZING</th>
				  <th>EMBRYO FREEZING</th>
				  <?php  } ?>
	
				</tr>
              </thead>
			  
			  <?php
     foreach($procedure_result as $ky => $vl){
	?>
			  <tbody id="procedure_result">
                            <tr class="odd gradeX">
							 <td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>JANUARY</td>
								<td><?php echo $vl['consultations']; ?></td>
								<td><?php echo $vl['tele_consult']; ?></td>
								<td><?php echo $vl['opu'];; ?></td>
								<td><?php echo $vl['fresh_cycle_et']; ?></td>
								<td><?php echo $vl['thawed_cycle_fet']; ?></td>
								<td><?php echo $vl['iui']; ?></td>
								<td><?php echo $vl['ivf']; ?></td>
								<td><?php echo $vl['icsi']; ?></td>
								<td><?php echo $vl['tesa_mtese']; ?></td>
								<td><?php echo $vl['donor_cycle']; ?></td>
								<td><?php echo $vl['surrogacy']; ?></td>
								<td><?php echo $vl['uterine_prp']; ?></td>
								<td><?php echo $vl['ovarian_prp']; ?></td>
								<td><?php echo $vl['testicular_prp']; ?></td>
								<td><?php echo $vl['macs_qualis_candor']; ?></td>
								<td><?php echo $vl['lah']; ?></td>
								<td><?php echo $vl['pgd']; ?></td>
								<td><?php echo $vl['embryo_glue']; ?></td>
								<td><?php echo $vl['sperm_mobil']; ?></td>
								<td><?php echo $vl['blastocyst_transfer']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnostic']; ?></td>
								<td><?php echo $vl['laparoscopy_hysteroscopy']; ?></td>
								<td><?php echo $vl['beta_hcg_positive']; ?></td>
								<td><?php echo $vl['cardic_activity']; ?></td>
								<td><?php echo $vl['live_birth']; ?></td>
								<td><?php echo $vl['male']; ?></td>
								<td><?php echo $vl['female']; ?></td>
								<td><?php echo $vl['ongoing']; ?></td>
								<td><?php echo $vl['ivm']; ?></td>
								<td><?php echo $vl['egg_freezing']; ?></td>
								<td><?php echo $vl['semen_freezing']; ?></td>
								<td><?php echo $vl['embryo_freezing']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>FEBRUARY</td>
								<td><?php echo $vl['consultationsfeb']; ?></td>
								<td><?php echo $vl['tele_consultfeb']; ?></td>
								<td><?php echo $vl['opufeb']; ?></td>
								<td><?php echo $vl['fresh_cycle_etfeb']; ?></td>
								<td><?php echo $vl['thawed_cycle_fetfeb']; ?></td>
								<td><?php echo $vl['iuifeb']; ?></td>
								<td><?php echo $vl['ivffeb']; ?></td>
								<td><?php echo $vl['icsifeb']; ?></td>
								<td><?php echo $vl['tesa_mtese']; ?></td>
								<td><?php echo $vl['donor_cyclefeb']; ?></td>
								<td><?php echo $vl['surrogacyfeb']; ?></td>
								<td><?php echo $vl['uterine_prpfeb']; ?></td>
								<td><?php echo $vl['ovarian_prpfeb']; ?></td>
								<td><?php echo $vl['testicular_prpfeb']; ?></td>
								<td><?php echo $vl['macs_qualis_candorfeb']; ?></td>
								<td><?php echo $vl['lahfeb']; ?></td>
								<td><?php echo $vl['pgdfeb']; ?></td>
								<td><?php echo $vl['embryo_gluefeb']; ?></td>
								<td><?php echo $vl['sperm_mobilfeb']; ?></td>
								<td><?php echo $vl['blastocyst_transferfeb']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticfeb']; ?></td>
								<td><?php echo $vl['laparoscopy_hysteroscopyfeb']; ?></td>
								<td><?php echo $vl['beta_hcg_positivefeb']; ?></td>
								<td><?php echo $vl['cardic_activityfeb']; ?></td>
								<td><?php echo $vl['live_birthfeb']; ?></td>
								<td><?php echo $vl['malefeb']; ?></td>
								<td><?php echo $vl['femalefeb']; ?></td>
								<td><?php echo $vl['ongoingfeb']; ?></td>
								<td><?php echo $vl['ivmfeb']; ?></td>
								<td><?php echo $vl['egg_freezingfeb']; ?></td>
								<td><?php echo $vl['semen_freezingfeb']; ?></td>
								<td><?php echo $vl['embryo_freezingfeb']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>MARCH</td>
								<td><?php echo $vl['consultationsmar']; ?></td>
								<td><?php echo $vl['tele_consultmar']; ?></td>
								<td><?php echo $vl['opumar']; ?></td>
								<td><?php echo $vl['fresh_cycle_etmar']; ?></td>
								<td><?php echo $vl['thawed_cycle_fetmar']; ?></td>
								<td><?php echo $vl['iuimar']; ?></td>
								<td><?php echo $vl['ivfmar']; ?></td>
								<td><?php echo $vl['icsimar']; ?></td>
								<td><?php echo $vl['tesa_mtesemar']; ?></td>
								<td><?php echo $vl['donor_cyclemar']; ?></td>
								<td><?php echo $vl['surrogacymar']; ?></td>
								<td><?php echo $vl['uterine_prpmar']; ?></td>
								<td><?php echo $vl['ovarian_prpmar']; ?></td>
								<td><?php echo $vl['testicular_prpmar']; ?></td>
								<td><?php echo $vl['macs_qualis_candormar']; ?></td>
								<td><?php echo $vl['lahmar']; ?></td>
								<td><?php echo $vl['pgdmar']; ?></td>
								<td><?php echo $vl['embryo_gluemar']; ?></td>
								<td><?php echo $vl['sperm_mobilmar']; ?></td>
								<td><?php echo $vl['blastocyst_transfermar']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticmar']; ?></td>
								<td><?php echo $vl['laparoscopy_hysteroscopymar']; ?></td>
								<td><?php echo $vl['beta_hcg_positivemar']; ?></td>
								<td><?php echo $vl['cardic_activitymar']; ?></td>
								<td><?php echo $vl['live_birthmar']; ?></td>
								<td><?php echo $vl['malemar']; ?></td>
								<td><?php echo $vl['femalemar']; ?></td>
								<td><?php echo $vl['ongoingmar']; ?></td>
								<td><?php echo $vl['ivmmar']; ?></td>
								<td><?php echo $vl['egg_freezingmar']; ?></td>
								<td><?php echo $vl['semen_freezingmar']; ?></td>
								<td><?php echo $vl['embryo_freezingmar']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>APRIL</td>
								<td><?php echo $vl['consultationsapr']; ?></td>
								<td><?php echo $vl['tele_consultapr']; ?></td>
								<td><?php echo $vl['opuapr']; ?></td>
								<td><?php echo $vl['fresh_cycle_etapr']; ?></td>
								<td><?php echo $vl['thawed_cycle_fetapr']; ?></td>
								<td><?php echo $vl['iuiapr']; ?></td>
								<td><?php echo $vl['ivfapr']; ?></td>
								<td><?php echo $vl['icsiapr']; ?></td>
								<td><?php echo $vl['tesa_mteseapr']; ?></td>
								<td><?php echo $vl['donor_cycleapr']; ?></td>
								<td><?php echo $vl['surrogacyapr']; ?></td>
								<td><?php echo $vl['uterine_prpapr']; ?></td>
								<td><?php echo $vl['ovarian_prpapr']; ?></td>
								<td><?php echo $vl['testicular_prpapr']; ?></td>
								<td><?php echo $vl['macs_qualis_candorapr']; ?></td>
								<td><?php echo $vl['lahapr']; ?></td>
								<td><?php echo $vl['pgdapr']; ?></td>
								<td><?php echo $vl['embryo_glueapr']; ?></td>
								<td><?php echo $vl['sperm_mobilapr']; ?></td>
								<td><?php echo $vl['blastocyst_transferapr']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticapr']; ?></td>
								<td><?php echo $vl['laparoscopy_hysteroscopyapr']; ?></td>
								<td><?php echo $vl['beta_hcg_positiveapr']; ?></td>
								<td><?php echo $vl['cardic_activityapr']; ?></td>
								<td><?php echo $vl['live_birthapr']; ?> </td>
								<td><?php echo $vl['maleapr']; ?> </td>
								<td><?php echo $vl['femaleapr']; ?> </td>
								<td><?php echo $vl['ongoingapr']; ?> </td>
								<td><?php echo $vl['ivmapr']; ?> </td>
								<td><?php echo $vl['egg_freezingapr']; ?></td>
								<td><?php echo $vl['semen_freezingapr']; ?></td>
								<td><?php echo $vl['embryo_freezingapr']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>MAY</td>
								<td><?php echo $vl['consultationsmay']; ?> </td>
								<td><?php echo $vl['tele_consultmay']; ?> </td>
								<td><?php echo $vl['opumay']; ?> </td>
								<td><?php echo $vl['fresh_cycle_etmay']; ?> </td>
								<td><?php echo $vl['thawed_cycle_fetmay']; ?> </td>
								<td><?php echo $vl['iuimay']; ?> </td>
								<td><?php echo $vl['ivfmay']; ?> </td>
								<td><?php echo $vl['icsimay']; ?></td>
								<td><?php echo $vl['tesa_mtesemay']; ?></td>
								<td><?php echo $vl['donor_cyclemay']; ?> </td>
								<td><?php echo $vl['surrogacymay']; ?> </td>
								<td><?php echo $vl['uterine_prpmay']; ?> </td>
								<td><?php echo $vl['ovarian_prpmay']; ?> </td>
								<td><?php echo $vl['testicular_prpmay']; ?> </td>
								<td><?php echo $vl['macs_qualis_candormay']; ?></td>
								<td><?php echo $vl['lahmay']; ?></td>
								<td><?php echo $vl['pgdmay']; ?></td>
								<td><?php echo $vl['embryo_gluemay']; ?></td>
								<td><?php echo $vl['sperm_mobilmay']; ?></td>
								<td><?php echo $vl['blastocyst_transfermay']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticmay']; ?> </td>
								<td><?php echo $vl['laparoscopy_hysteroscopymay']; ?> </td>
								<td><?php echo $vl['beta_hcg_positivemay']; ?> </td>
								<td><?php echo $vl['cardic_activitymay']; ?> </td>
								<td><?php echo $vl['live_birthmay']; ?> </td>
								<td><?php echo $vl['malemay']; ?> </td>
								<td><?php echo $vl['femalemay']; ?> </td>
								<td><?php echo $vl['ongoingmay']; ?> </td>
								<td><?php echo $vl['ivmmay']; ?> </td>
								<td><?php echo $vl['egg_freezingmay']; ?></td>
								<td><?php echo $vl['semen_freezingmay']; ?></td>
								<td><?php echo $vl['embryo_freezingmay']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>JUNE</td>
								<td><?php echo $vl['consultationsjun']; ?> </td>
								<td><?php echo $vl['tele_consultjun']; ?> </td>
								<td><?php echo $vl['opujun']; ?> </td>
								<td><?php echo $vl['fresh_cycle_etjun']; ?> </td>
								<td><?php echo $vl['thawed_cycle_fetjun']; ?> </td>
								<td><?php echo $vl['iuijun']; ?> </td>
								<td><?php echo $vl['ivfjun']; ?> </td>
								<td><?php echo $vl['icsijun']; ?></td>
								<td><?php echo $vl['tesa_mtesejun']; ?></td>
								<td><?php echo $vl['donor_cyclejun']; ?> </td>
								<td><?php echo $vl['surrogacyjun']; ?> </td>
								<td><?php echo $vl['uterine_prpjun']; ?> </td>
								<td><?php echo $vl['ovarian_prpjun']; ?> </td>
								<td><?php echo $vl['testicular_prpjun']; ?> </td>
								<td><?php echo $vl['macs_qualis_candorjun']; ?></td>
								<td><?php echo $vl['lahjun']; ?></td>
								<td><?php echo $vl['pgdjun']; ?></td>
								<td><?php echo $vl['embryo_gluejun']; ?></td>
								<td><?php echo $vl['sperm_mobiljun']; ?></td>
								<td><?php echo $vl['blastocyst_transferjun']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticjun']; ?> </td>
								<td><?php echo $vl['laparoscopy_hysteroscopyjun']; ?> </td>
								<td><?php echo $vl['beta_hcg_positivejun']; ?> </td>
								<td><?php echo $vl['cardic_activityjun']; ?> </td>
								<td><?php echo $vl['live_birthjun']; ?> </td>
								<td><?php echo $vl['malejun']; ?> </td>
								<td><?php echo $vl['femalejun']; ?> </td>
								<td><?php echo $vl['ongoingjun']; ?> </td>
								<td><?php echo $vl['ivmjun']; ?> </td>
								<td><?php echo $vl['egg_freezingjun']; ?></td>
								<td><?php echo $vl['semen_freezingjun']; ?></td>
								<td><?php echo $vl['embryo_freezingjun']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>JULY</td>
								<td><?php echo $vl['consultationsjul']; ?> </td>
								<td><?php echo $vl['tele_consultjul']; ?> </td>
								<td><?php echo $vl['opujul']; ?> </td>
								<td><?php echo $vl['fresh_cycle_etjul']; ?> </td>
								<td> <?php echo $vl['thawed_cycle_fetjul']; ?> </td>
								<td><?php echo $vl['iuijul']; ?> </td>
								<td><?php echo $vl['ivfjul']; ?> </td>
								<td><?php echo $vl['icsijul']; ?></td>
								<td><?php echo $vl['tesa_mtesejul']; ?></td>
								<td><?php echo $vl['donor_cyclejul']; ?> </td>
								<td><?php echo $vl['surrogacyjul']; ?> </td>
								<td><?php echo $vl['uterine_prpjul']; ?> </td>
								<td><?php echo $vl['ovarian_prpjul']; ?> </td>
								<td><?php echo $vl['testicular_prpjul']; ?> </td>
								<td><?php echo $vl['macs_qualis_candorjul']; ?></td>
								<td><?php echo $vl['lahjul']; ?></td>
								<td><?php echo $vl['pgdjul']; ?></td>
								<td><?php echo $vl['embryo_gluejul']; ?></td>
								<td><?php echo $vl['sperm_mobiljul']; ?></td>
								<td><?php echo $vl['blastocyst_transferjul']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticjul']; ?> </td>
								<td><?php echo $vl['laparoscopy_hysteroscopyjul']; ?> </td>
								<td><?php echo $vl['beta_hcg_positivejul']; ?> </td>
								<td><?php echo $vl['cardic_activityjul']; ?> </td>
								<td><?php echo $vl['live_birthjul']; ?> </td>
								<td><?php echo $vl['malejul']; ?> </td>
								<td><?php echo $vl['femalejul']; ?> </td>
								<td><?php echo $vl['ongoingjul']; ?> </td>
								<td><?php echo $vl['ivmjul']; ?> </td>
								<td><?php echo $vl['egg_freezingjul']; ?></td>
								<td><?php echo $vl['semen_freezingjul']; ?></td>
								<td><?php echo $vl['embryo_freezingjul']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>AUGUST</td>
								<td><?php echo $vl['consultationsaug']; ?> </td>
								<td><?php echo $vl['tele_consultaug']; ?> </td>
								<td><?php echo $vl['opuaug']; ?> </td>
								<td><?php echo $vl['fresh_cycle_etaug']; ?> </td>
								<td><?php echo $vl['thawed_cycle_fetaug']; ?> </td>
								<td><?php echo $vl['iuiaug']; ?> </td>
								<td><?php echo $vl['ivfaug']; ?> </td>
								<td><?php echo $vl['icsiaug']; ?></td>
								<td><?php echo $vl['tesa_mteseaug']; ?></td>
								<td><?php echo $vl['donor_cycleaug']; ?> </td>
								<td><?php echo $vl['surrogacyaug']; ?> </td>
								<td><?php echo $vl['uterine_prpaug']; ?> </td>
								<td><?php echo $vl['ovarian_prpaug']; ?> </td>
								<td><?php echo $vl['testicular_prpaug']; ?> </td>
								<td><?php echo $vl['macs_qualis_candoraug']; ?></td>
								<td><?php echo $vl['lahaug']; ?></td>
								<td><?php echo $vl['pgdaug']; ?></td>
								<td><?php echo $vl['embryo_glueaug']; ?></td>
								<td><?php echo $vl['sperm_mobilaug']; ?></td>
								<td><?php echo $vl['blastocyst_transferaug']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticaug']; ?> </td>
								<td><?php echo $vl['laparoscopy_hysteroscopyaug']; ?> </td>
								<td><?php echo $vl['beta_hcg_positiveaug']; ?> </td>
								<td><?php echo $vl['cardic_activityaug']; ?> </td>
								<td><?php echo $vl['live_birthaug']; ?> </td>
								<td><?php echo $vl['maleaug']; ?> </td>
								<td><?php echo $vl['femaleaug']; ?> </td>
								<td><?php echo $vl['ongoingaug']; ?> </td>
								<td><?php echo $vl['ivmaug']; ?> </td>
								<td><?php echo $vl['egg_freezingaug']; ?></td>
								<td><?php echo $vl['semen_freezingaug']; ?></td>
								<td><?php echo $vl['embryo_freezingaug']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>SEPTEMBER</td>
								<td><?php echo $vl['consultationssep']; ?> </td>
								<td><?php echo $vl['tele_consultsep']; ?> </td>
								<td><?php echo $vl['opusep']; ?> </td>
								<td><?php echo $vl['fresh_cycle_etsep']; ?> </td>
								<td><?php echo $vl['thawed_cycle_fetsep']; ?> </td>
								<td><?php echo $vl['iuisep']; ?> </td>
								<td><?php echo $vl['ivfsep']; ?> </td>
								<td><?php echo $vl['icsiep']; ?></td>
								<td><?php echo $vl['tesa_mtesesep']; ?></td>
								<td><?php echo $vl['donor_cyclesep']; ?> </td>
								<td><?php echo $vl['surrogacysep']; ?> </td>
								<td><?php echo $vl['uterine_prpsep']; ?> </td>
								<td><?php echo $vl['ovarian_prpsep']; ?> </td>
								<td><?php echo $vl['testicular_prpsep']; ?> </td>
								<td><?php echo $vl['macs_qualis_candorsep']; ?></td>
								<td><?php echo $vl['lahsep']; ?></td>
								<td><?php echo $vl['pgdsep']; ?></td>
								<td><?php echo $vl['embryo_gluesep']; ?></td>
								<td><?php echo $vl['sperm_mobilsep']; ?></td>
								<td><?php echo $vl['blastocyst_transfersep']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticsep']; ?> </td>
								<td><?php echo $vl['laparoscopy_hysteroscopysep']; ?> </td>
								<td><?php echo $vl['beta_hcg_positivesep']; ?> </td>
								<td><?php echo $vl['cardic_activitysep']; ?> </td>
								<td><?php echo $vl['live_birthsep']; ?> </td>
								<td><?php echo $vl['malesep']; ?> </td>
								<td><?php echo $vl['femalesep']; ?> </td>
								<td><?php echo $vl['ongoingsep']; ?> </td>
								<td><?php echo $vl['ivmsep']; ?> </td>
								<td><?php echo $vl['egg_freezingsep']; ?></td>
								<td><?php echo $vl['semen_freezingsep']; ?></td>
								<td><?php echo $vl['embryo_freezingsep']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>OCTOBER</td>
								<td><?php echo $vl['consultationsoct']; ?></td>
								<td><?php echo $vl['tele_consultoct']; ?></td>
								<td><?php echo $vl['opuoct']; ?></td>
								<td><?php echo $vl['fresh_cycle_etoct']; ?></td>
								<td><?php echo $vl['thawed_cycle_fetoct']; ?></td>
								<td><?php echo $vl['iuioct']; ?></td>
								<td><?php echo $vl['ivfoct']; ?></td>
								<td><?php echo $vl['icsioct']; ?></td>
								<td><?php echo $vl['tesa_mteseoct']; ?></td>
								<td><?php echo $vl['donor_cycleoct']; ?></td>
								<td><?php echo $vl['surrogacyoct']; ?></td>
								<td><?php echo $vl['uterine_prpoct']; ?></td>
								<td><?php echo $vl['ovarian_prpoct']; ?></td>
								<td><?php echo $vl['testicular_prpoct']; ?></td>
								<td><?php echo $vl['macs_qualis_candoroct']; ?></td>
								<td><?php echo $vl['lahoct']; ?></td>
								<td><?php echo $vl['pgdoct']; ?></td>
								<td><?php echo $vl['embryo_glueoct']; ?></td>
								<td><?php echo $vl['sperm_mobiloct']; ?></td>
								<td><?php echo $vl['blastocyst_transferoct']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticoct']; ?></td>
								<td><?php echo $vl['laparoscopy_hysteroscopyoct']; ?></td>
								<td><?php echo $vl['beta_hcg_positiveoct']; ?></td>
								<td><?php echo $vl['cardic_activityoct']; ?></td>
								<td><?php echo $vl['live_birthoct']; ?></td>
								<td><?php echo $vl['maleoct']; ?></td>
								<td><?php echo $vl['femaleoct']; ?></td>
								<td><?php echo $vl['ongoingoct']; ?></td>
								<td><?php echo $vl['ivmoct']; ?></td>
								<td><?php echo $vl['egg_freezingoct']; ?></td>
								<td><?php echo $vl['semen_freezingoct']; ?></td>
								<td><?php echo $vl['embryo_freezingoct']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>NOVEMBER</td>
								<td><?php echo $vl['consultationsnov']; ?></td>
								<td><?php echo $vl['tele_consultnov']; ?></td>
								<td><?php echo $vl['opunov']; ?></td>
								<td><?php echo $vl['fresh_cycle_etnov']; ?></td>
								<td><?php echo $vl['thawed_cycle_fetnov']; ?></td>
								<td><?php echo $vl['iuinov']; ?></td>
								<td><?php echo $vl['ivfnov']; ?></td>
								<td><?php echo $vl['icsinov']; ?></td>
								<td><?php echo $vl['tesa_mtesenov']; ?></td>
								<td><?php echo $vl['donor_cyclenov']; ?></td>
								<td><?php echo $vl['surrogacynov']; ?></td>
								<td><?php echo $vl['uterine_prpnov']; ?></td>
								<td><?php echo $vl['ovarian_prpnov']; ?></td>
								<td><?php echo $vl['testicular_prpnov']; ?></td>
								<td><?php echo $vl['macs_qualis_candornov']; ?></td>
								<td><?php echo $vl['lahnov']; ?></td>
								<td><?php echo $vl['pgdnov']; ?></td>
								<td><?php echo $vl['embryo_gluenov']; ?></td>
								<td><?php echo $vl['sperm_mobilnov']; ?></td>
								<td><?php echo $vl['blastocyst_transfernov']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticnov']; ?></td>
								<td><?php echo $vl['laparoscopy_hysteroscopynov']; ?></td>
								<td><?php echo $vl['beta_hcg_positivenov']; ?></td>
								<td><?php echo $vl['cardic_activitynov']; ?></td>
								<td><?php echo $vl['live_birthnov']; ?></td>
								<td><?php echo $vl['malenov']; ?></td>
								<td><?php echo $vl['femalenov']; ?></td>
								<td><?php echo $vl['ongoing']; ?></td>
								<td><?php echo $vl['ivmnov']; ?></td>
								<td><?php echo $vl['egg_freezingfnov']; ?></td>
								<td><?php echo $vl['semen_freezingnov']; ?></td>
								<td><?php echo $vl['embryo_freezingnov']; ?></td>
								<td><?php $sql1 = "SELECT * FROM hms_centers WHERE center_number=".$vl['center']."";
	                         $query = $this->db->query($sql1);
                             $select_result1 = $query->result(); 
                             foreach ($select_result1 as $res_val){ 
                             echo $res_val->center_name;
					        }
                            ?></td>
								<td>DECEMBER</td>
								<td><?php echo $vl['consultationsdec']; ?></td>
								<td><?php echo $vl['tele_consultdec']; ?></td>
								<td><?php echo $vl['opudec']; ?></td>
								<td><?php echo $vl['fresh_cycle_etdec']; ?></td>
								<td><?php echo $vl['thawed_cycle_fetdec']; ?></td>
								<td><?php echo $vl['iuidec']; ?></td>
								<td><?php echo $vl['ivfdec']; ?></td>
								<td><?php echo $vl['icsidec']; ?></td>
								<td><?php echo $vl['tesa_mtesedec']; ?></td>
								<td><?php echo $vl['donor_cycledec']; ?></td>
								<td><?php echo $vl['surrogacydec']; ?></td>
								<td><?php echo $vl['uterine_prpdec']; ?></td>
								<td><?php echo $vl['ovarian_prpdec']; ?></td>
								<td><?php echo $vl['testicular_prpdec']; ?></td>
								<td><?php echo $vl['macs_qualis_candordec']; ?></td>
								<td><?php echo $vl['lahdec']; ?></td>
								<td><?php echo $vl['pgddec']; ?></td>
								<td><?php echo $vl['embryo_gluedec']; ?></td>
								<td><?php echo $vl['sperm_mobildec']; ?></td>
								<td><?php echo $vl['blastocyst_transferdec']; ?></td>
								<td><?php echo $vl['hysteroscopy_diagnosticdec']; ?></td>
								<td><?php echo $vl['laparoscopy_hysteroscopydec']; ?></td>
								<td><?php echo $vl['beta_hcg_positivedec']; ?></td>
								<td><?php echo $vl['cardic_activitydec']; ?></td>
								<td><?php echo $vl['live_birthdec']; ?></td>
								<td><?php echo $vl['maledec']; ?></td>
								<td><?php echo $vl['femaledec']; ?></td>
								<td><?php echo $vl['ongoingdec']; ?></td>
								<td><?php echo $vl['ivmdec']; ?></td>
								<td><?php echo $vl['egg_freezingdec']; ?></td>
								<td><?php echo $vl['semen_freezingdec']; ?></td>
								<td><?php echo $vl['embryo_freezingdec']; ?></td>
							</tr>							
                </tbody>		
		      		 <?php } ?> 	  
            </table>
          </div>	
</div> 
</div>
</div>  
</div>  

<style>
.table-bordered > tbody > tr > td {
    padding: 0px!important'];
}
input[type=text] {
    margin: 0px'];
    border-bottom: 0px'];
	height: 20px'];
	text-align: center'];
}
table {
  font-family: arial, sans-serif'];
  border-collapse: collapse'];
  width: 100%'];
}
td {
  border: 1px solid #000'];
  text-align: center'];
}
form {
    padding-left: 10px'];
    margin-bottom: 4px'];
}
select {
    display: block!important'];
}
textarea.form-control {
    height: 30px!important'];
    width: 300px!important'];
}
</style>    