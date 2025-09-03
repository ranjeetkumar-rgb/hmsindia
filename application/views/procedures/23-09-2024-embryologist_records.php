 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Embryologist records</h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'procedures/embryologist_records'; ?>" method="get">
		    <div class="col-sm-2 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id;?>" />
            </div>
			<div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'procedures/embryologist_records'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>  
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
              <thead>
                <tr>
				  <th>IIC ID</th>
                  <th>Patient name</th>
                  <th>Reports</th>
                  <th>Payment Date</th>
                </tr>
              </thead>
              <tbody id="procedure_result">
              <?php 
			 $count=1;
			   foreach($embryologist_result as $ky => $vl){
                $patient_data = get_patient_detail($vl['patient_id']);
					 ?>
                  <?php  
				  if(!empty($vl['data'])){
					  $procedure_data = unserialize($vl['data']);
						 foreach ($procedure_data['patient_procedures'] as $v2_data){
						   $sql1 = "select * from hms_procedures where code='".$v2_data['sub_procedures_code']."'";
						   $query = $this->db->query($sql1);
                            $select_result1 = $query->result(); 
							foreach ($select_result1 as $res_val){
							
					 if($v2_data['sub_procedures_code'] == "IP01" ){
					     echo '<tr class="odd gradeX">';
                         echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						 echo '<td>'.$patient_data['wife_name'].'</td>';
                         echo '<td>'.$vl['on_date'].'</td>';			                                    
						 echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                         echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP05" ){
						echo '<tr class="odd gradeX">';
						echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
						echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
						echo '</tr>';
					}
					 if($v2_data['sub_procedures_code'] == "IP02" ){
					     echo '<tr class="odd gradeX">';
                         echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						 echo '<td>'.$patient_data['wife_name'].'</td>';
                         echo '<td>'.$vl['on_date'].'</td>';			                                    
						 echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                         echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP04" ){
					     echo '<tr class="odd gradeX">';
                         echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						 echo '<td>'.$patient_data['wife_name'].'</td>';
                         echo '<td>'.$vl['on_date'].'</td>';			                                    
						 echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                         echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP11" ){
					     echo '<tr class="odd gradeX">';
                         echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						 echo '<td>'.$patient_data['wife_name'].'</td>';
                         echo '<td>'.$vl['on_date'].'</td>';			                                    
						 echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                         echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP72" ){
					     echo '<tr class="odd gradeX">';
                         echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						 echo '<td>'.$patient_data['wife_name'].'</td>';
                         echo '<td>'.$vl['on_date'].'</td>';			                                    
						 echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                         echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP163" ){
					     echo '<tr class="odd gradeX">';
                         echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						 echo '<td>'.$patient_data['wife_name'].'</td>';
                         echo '<td>'.$vl['on_date'].'</td>';			                                    
						 echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                         echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP90" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP94" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP97" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP98" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP95" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT38" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP93" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP73" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "INT72" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "INT77" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP161" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP162" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP163" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP164" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP165" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP166" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP112" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP113" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP114" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP115" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP116" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP117" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP118" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP119" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP120" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP183" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP184" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP185" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP186" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP187" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP188" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP189" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP190" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP191" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP192" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP193" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP194" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP195" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP196" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP197" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP198" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP199" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					   if($v2_data['sub_procedures_code'] == "IP200" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT01" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT02" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP01N" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT04" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT05" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP99" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP129" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP130" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP159" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP160" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP64" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "INT63" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT75" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT78" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT79" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT80" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "INT82" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP121" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP122" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP123" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP124" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP143" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP144" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP153" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP154" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP155" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP156" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP157" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP158" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP179" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					 if($v2_data['sub_procedures_code'] == "IP180" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP181" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP182" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP19" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
					  if($v2_data['sub_procedures_code'] == "IP39" ){
					    echo '<tr class="odd gradeX">';
                        echo '<td>','<a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'" target="_blank">'.$vl['patient_id'].'</a>','</td>';
						echo '<td>'.$patient_data['wife_name'].'</td>';
                        echo '<td>'.$vl['on_date'].'</td>';			                                    
						echo '<td>','<a href="'.base_url().'procedure_reports/'.$vl['appointment_id'].'" class="btn btn-primary">Procedure Report</a>','</td>';
                        echo '</tr>';
					 }
						}
					 }
				  }
				  ?>
                 
               
              <?php $count++;} ?>
              <tr>
                <td colspan="5">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
			  </tr>
              </tbody>
			  
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
	
<style >
.custom-pagination{
  padding:8px;
}
.custom-pagination a{
  padding:10px;
  text-decoration: none;
}
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
.form-control#billing_at{
  height: 40px!important;
  border: 1px solid #9e9e9e!important;
}
</style>