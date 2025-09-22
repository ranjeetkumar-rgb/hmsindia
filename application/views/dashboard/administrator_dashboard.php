
  <div class="header">
    <h1 class="page-header"> Dashboard </h1>
   
  </div>
  <div id="page-inner">
    <div class="dashboard-cards">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="card horizontal cardIcon waves-effect waves-dark">
            <div class="card-stacked red">
              <div class="card-content">
                <h3><?php echo ivf_opd(); ?></h3>
              </div>
              <div class="card-action"> <strong>OPD</strong> </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="card horizontal cardIcon waves-effect waves-dark">
           
            <div class="card-stacked orange">
              <div class="card-content">
                <h3><?php echo ivf_procedures(); ?></h3>
              </div>
              <div class="card-action"> <strong>Procedure</strong> </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="card horizontal cardIcon waves-effect waves-dark">
            
            <div class="card-stacked green">
              <div class="card-content">
                <h3><?php echo ivf_labs(); ?></h3>
              </div>
              <div class="card-action"> <strong>IVF LAB</strong> </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="card horizontal cardIcon waves-effect waves-dark">
            
            <div class="card-stacked blue">
              <div class="card-content">
                <h3><?php echo ivf_patients(); ?></h3>
              </div>
              <div class="card-action"> <strong>PATIENT</strong> </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="card horizontal cardIcon waves-effect waves-dark">
            <a href="<?php echo base_url(); ?>my-approvals" style="text-decoration: none; color: inherit;">
              <div class="card-stacked purple">
                <div class="card-content">
                  <h3><i class="fa fa-check-circle" style="font-size: 2em;"></i></h3>
                </div>
                <!-- <div class="card-action"> <strong>MY APPROVALS</strong> </div> -->
              </div>
            </a>
          </div>
        </div>        
      </div>
    </div>
    <!-- /. ROW  -->
    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0; text-align:center;}
      .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
      .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
      .tg .tg-0lax{text-align:center;vertical-align:top}
    </style>

<!-- RI's, PI's & KPI's -->

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="3">RIs for identifying performance of the ART laboratory.</th>
                </tr>
                <tr>
                  <th class="tg-0lax">RI</th>
                  <th class="tg-0lax">Calculation</th>
                  <th class="tg-0lax">Benchmark Value</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">Proportion of oocytes recovered  (stimulated cycles)</td>
                  <td class="tg-0lax"><?php echo proportion_oocytes_recovered(); ?></td>
                  <td class="tg-0lax">80–95% of follicles measured</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Proportion of MII oocytes at ICSI</td>
                  <td class="tg-0lax"><?php echo proportion_mii_oocytes(); ?></td>
                  <td class="tg-0lax">75%-90%</td>
                </tr>
                <tr>
                  <td class="tg-0lax">MII, metaphase II;</td>
                  <td class="tg-0lax">RI, reference indicators;</td>
                  <td class="tg-0lax">COC, cumulus-oocyte complex</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="4">PIs for the ART laboratory.</th>
                </tr>
                <tr>
                  <th class="tg-0lax">PI</th>
                  <th class="tg-0lax">Calculation</th>
                  <th class="tg-0lax">Competency value (%)</th>                  
                  <th class="tg-0lax">Benchmark value (%)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">Sperm motility post-preparation (for IVF and IUI)</td>
                  <td class="tg-0lax"><?php echo sperm_motility_post(); ?></td>
                  <td class="tg-0lax">90</td>
                  <td class="tg-0lax">≥95</td>
                </tr>
                <tr>
                  <td class="tg-0lax">IVF polyspermy rate</td>
                  <td class="tg-0lax"><?php echo ivf_polyspermy_rate(); ?></td>
                  <td class="tg-0lax">≤6</td>
                  <td class="tg-0lax"></td>
                </tr>
                <tr>
                  <td class="tg-0lax">1 PN rate (IVF)</td>
                  <td class="tg-0lax"><?php echo ivf_pn_rate(); ?></td>
                  <td class="tg-0lax">≤5</td>
                  <td class="tg-0lax"></td>
                </tr>
                <tr>
                  <td class="tg-0lax">1 PN rate (ICSI)</td>
                  <td class="tg-0lax"><?php echo icsi_pn_rate(); ?></td>
                  <td class="tg-0lax">≤3</td>
                  <td class="tg-0lax"></td>
                </tr>
                <tr>
                  <td class="tg-0lax">Good blastocyst development rate</td>
                  <td class="tg-0lax"><?php echo good_blastocyst_rate(); ?></td>
                  <td class="tg-0lax">≥30</td>
                  <td class="tg-0lax">≥40</td>
                </tr>
                <tr>
                  <td class="tg-0lax">PN Pronucleus;</td>
                  <td class="tg-0lax">PI performance indicator;</td>
                  <td class="tg-0lax">PB polar body</td>
                  <td class="tg-0lax"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="4">KPIs for the ART laboratory.</th>
                </tr>
                <tr>
                  <th class="tg-0lax">KPI</th>
                  <th class="tg-0lax">Calculation</th>
                  <th class="tg-0lax">Competency value (%)</th>                  
                  <th class="tg-0lax">Benchmark value (%)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">ICSI damage rate</td>
                  <td class="tg-0lax"><?php echo icsi_damage_rate(); ?></td>
                  <td class="tg-0lax"><10</td>
                  <td class="tg-0lax">≤5</td>
                </tr>
                <tr>
                  <td class="tg-0lax">ICSI normal fertilization rate</td>
                  <td class="tg-0lax"><?php echo icsi_normal_fertilization_rate(); ?></td>
                  <td class="tg-0lax">≥65</td>
                  <td class="tg-0lax">≥80</td>
                </tr>
                <tr>
                  <td class="tg-0lax">IVF normal fertilization rate</td>
                  <td class="tg-0lax"><?php echo ivf_normal_fertilization_rate(); ?></td>
                  <td class="tg-0lax">≥60</td>
                  <td class="tg-0lax">≥75</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Failed fertilization rate (IVF)</td>
                  <td class="tg-0lax"></td>
                  <td class="tg-0lax"><5</td>
                  <td class="tg-0lax"></td>
                </tr>
                <tr>
                  <td class="tg-0lax">Cleavage rate</td>
                  <td class="tg-0lax"><?php echo cleavage_rate(); ?></td>
                  <td class="tg-0lax">≥95</td>
                  <td class="tg-0lax">≥90</td>
                </tr>

                <tr>
                  <td class="tg-0lax">Day 2 Embryo development rate</td>
                  <td class="tg-0lax"><?php echo day_two_embryo_rate(); ?></td>
                  <td class="tg-0lax">≥50</td>
                  <td class="tg-0lax">≥80</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Day 3 Embryo development rate</td>
                  <td class="tg-0lax"><?php echo day_three_embryo_rate(); ?></td>
                  <td class="tg-0lax">≥45</td>
                  <td class="tg-0lax">≥70</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Blastocyst development rate</td>
                  <td class="tg-0lax"><?php echo blastocyst_development_rate(); ?></td>
                  <td class="tg-0lax">≥40</td>
                  <td class="tg-0lax">≥60</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Successful biopsy rate</td>
                  <td class="tg-0lax"><?php echo successful_biopsy_rate(); ?></td>
                  <td class="tg-0lax">≥40</td>
                  <td class="tg-0lax">≥95</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Blastocyst  cryosurvival  rate</td>
                  <td class="tg-0lax"><?php echo blastocyst_cryosurvival_rate(); ?></td>
                  <td class="tg-0lax">≥90</td>
                  <td class="tg-0lax">≥90</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Implantation rate (cleavage-stage)</td>
                  <td class="tg-0lax"><?php echo cleavage_implantation_rate(); ?></td>
                  <td class="tg-0lax">≥25</td>
                  <td class="tg-0lax">≥35</td>
                </tr>
                <tr>
                  <td class="tg-0lax">Implantation rate (blastocyst-stage)</td>
                  <td class="tg-0lax"><?php echo "";//blastocyst_implantation_rate(); ?></td>
                  <td class="tg-0lax">≥35</td>
                  <td class="tg-0lax">≥60</td>
                </tr>

                <tr>
                  <td class="tg-0lax" colspan="4">KPI key performance indicator;</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


<!-- RI's, PI's & KPI's -->

<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="6">OPD.</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">Total Appointments :</td>
                  <td class="tg-0lax">Total Consultation : </td>
                  <td class="tg-0lax">Patient in queue : </td>
                  <td class="tg-0lax">Appointment Cancelled : </td>
                  <td class="tg-0lax">No Show : </td>
                  <td class="tg-0lax">Rescheduled : </td>
                  
                </tr>
                <tr>
                  <td class="tg-0lax total_appointment"><?php echo total_appointment(); ?></td>
                  <td class="tg-0lax total_consultation"><?php echo total_consultation(); ?></td>
                  <td class="tg-0lax patient_in_queue"><?php echo patient_in_queue(); ?></td>
                  <td class="tg-0lax appointment_cancelled"><?php echo appointment_cancelled(); ?></td>
                  <td class="tg-0lax no_show_patient"><?php echo no_show_patient(); ?></td>
                  <td class="tg-0lax rescheduled_patient"><?php echo rescheduled_patient(); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>

<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="3">INVESTIGATIONS.</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">Total patient:</td>
                  <td class="tg-0lax">No. of investigation advised: </td>
                  <td class="tg-0lax">No. of investigation done: </td>                  
                </tr>
                <tr>
                  <td class="tg-0lax total_patient"><?php echo ivf_patients(); ?></td>
                  <td class="tg-0lax investigation_advised"><?php echo investigation_advised(); ?></td>
                  <td class="tg-0lax investigation_done"><?php echo investigation_done(); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>

<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="3">IVF LAB PROCEDURES.</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">Total Procedures done:</td>
                  <td class="tg-0lax total_procedure"><?php echo total_procedure(); ?></td> 
                </tr>
                <tr>
                  <td class="tg-0lax">Total ANDROLOGY procedures done:</td> 
                  <td class="tg-0lax total_andrology_done"><?php echo total_andrology_done(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">SEMEN PREPARATION (IUI/IVF/ICSI/FREEZING):</td>
                  <td class="tg-0lax semen_preparation_done"><?php echo semen_preparation_done(); ?></td>                
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>

<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="3">Total EMBRYOLOGY procedures .</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">EMBRYO RECORD & GRADING:</td>
                  <td class="tg-0lax embryo_record_done"><?php echo embryo_record_done(); ?></td> 
                </tr>
                <tr>
                  <td class="tg-0lax">PGT with BIOPSY:</td> 
                  <td class="tg-0lax pgt_biopsy_done"><?php echo pgt_biopsy_done(); ?></td>              
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>

<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="3">DAYCARE  PROCEDURES.</th>
                </tr>
                <tr>
                  <th class="tg-0lax" colspan="3">Total Procedures done.</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">HYSTEROSCOPY DIAGNOSTIC:</td>
                  <td class="tg-0lax hysterpscopy_diagnostic"><?php echo hysterpscopy_diagnostic(); ?></td> 
                </tr>
                <tr>
                  <td class="tg-0lax">HYSTEROSCOPY OPERATIVE:</td> 
                  <td class="tg-0lax hysterpscopy_operative"><?php echo hysterpscopy_operative(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">LAPAROSCOPY DIAGNOSTIC:</td> 
                  <td class="tg-0lax laparoscopy_diagnostic"><?php echo laparoscopy_diagnostic(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">LAPAROSCOPY OPERATIVE:</td> 
                  <td class="tg-0lax laparoscopy_operative"><?php echo laparoscopy_operative(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">OVARIAN CYST ASPIRATION:</td> 
                  <td class="tg-0lax ovarian_cyst_aspiration"><?php echo ovarian_cyst_aspiration(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">OVARIAN PRP:</td> 
                  <td class="tg-0lax ovarian_prp"><?php echo ovarian_prp(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">PESA/ TESA/TESE/MICRO TESE:</td> 
                  <td class="tg-0lax tese_done"><?php echo tese_done(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">OPU:</td> 
                  <td class="tg-0lax opu_done"><?php echo opu_done(); ?></td>              
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>

<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="cirStats">
          <div class="row">          
            <table class="tg">
              <thead>
                <tr>
                  <th class="tg-0lax" colspan="3">OPD PROCEDURES.</th>
                </tr>
                <tr>
                  <th class="tg-0lax" colspan="3">Total Procedures done.</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0lax">USG/BASELINE TVS:</td>
                  <td class="tg-0lax baseline_tvs"><?php echo baseline_tvs(); ?></td> 
                </tr>
                <tr>
                  <td class="tg-0lax">PAP SMEAR & HPV:</td> 
                  <td class="tg-0lax pap_smear"><?php echo pap_smear(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">ENDOMETRIAL BIOPSY:</td> 
                  <td class="tg-0lax endometrial_biopsy"><?php echo endometrial_biopsy(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">ENDOMETRIAL SCRATCHING:</td> 
                  <td class="tg-0lax endometrial_scratching"><?php echo endometrial_scratching(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">OVULATION INDUCTION:</td> 
                  <td class="tg-0lax ovulation_induction"><?php echo ovulation_induction(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">NATURAL CYCLE:</td> 
                  <td class="tg-0lax natural_cyle"><?php echo natural_cyle(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">Uterine PRP:</td> 
                  <td class="tg-0lax uterine_prp"><?php echo uterine_prp(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">MOCK ET:</td> 
                  <td class="tg-0lax mock_et"><?php echo mock_et(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">Testicular PRP:</td> 
                  <td class="tg-0lax testicular_prp"><?php echo testicular_prp(); ?></td>              
                </tr>
                <tr>
                  <td class="tg-0lax">FNAC TESTES:</td> 
                  <td class="tg-0lax fnac_testes"><?php echo fnac_testes(); ?></td>              
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
  </div>
  <!-- /. PAGE INNER  -->