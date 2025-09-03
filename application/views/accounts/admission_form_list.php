 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <div class="card">
	   <div class="card-action"><h3>Admission Form List</h3></div>
       <div class="clearfix"></div>
	    <form action=""<?php echo base_url().'accounts/admission_form_list'; ?>" method="get">
		     
			<div class="col-sm-3 col-xs-12" style="margin-top:10px;">
              <label>Start Date</label>
              <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $iic_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/admission_form_list'; ?>" style="text-decoration: none;">
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
				  <th>S.No.</th>
                  <th>IIC ID</th>
                  <th>Ipid</th>
                  <th>Doctor Name</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody id="admission_result">
              <?php 
			  $count=1; 
			  foreach($admission_result as $ky => $vl){
               ?>
                <tr class="odd gradeX">
                  <td><?php echo $count; ?></td>
				  <td><a href="<?php echo base_url().'patients/discharge_summary'; ?>?iic_id=<?php echo $vl['iic_id']; ?>&appoitmented_date=<?php echo $vl['appoitmented_date']; ?>&discharge=27"><?php echo $vl['iic_id']; ?></td>
				  <td><?php echo $vl['ipid']?></td>
				  <td><?php echo $vl['doctor_name']?></td>
                  <td><?php echo $vl['updated_at']?></td>
                </tr>
              <?php $count++;} ?>
              </tbody>			  
            </table>
          </div>
        </div>
      </div>
     </div>
	 
	<div class="row" id="print_this_section" style="display:none;">
<div class="ga-pro">
<table width="100%" class="vb45rt">
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
<tr>
<td style="padding:10px!important;"></td>
</tr>
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;margin-left:20px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
<tr>
<td style="padding:10px!important;"></td>
</tr>
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;margin-left:20px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
<tr>
<td style="padding:10px!important;"></td>
</tr>
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;margin-left:20px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
<tr>
<td style="padding:10px!important;"></td>
</tr>
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;margin-left:20px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
<tr>
<td style="padding:10px!important;"></td>
</tr>
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;margin-left:20px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
<tr>
<td style="padding:10px!important;"></td>
</tr>
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;margin-left:20px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
<tr>
<td style="padding:10px!important;"></td>
</tr>
<tr>
<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>

<td style="padding:10px;margin-left:20px;">
<table width="280px" class="vb45rt" style="border:1px solid;padding:5px;" >
<tbody>
<tr>
<td colspan="1" style="width:28%;">
<strong>Pt Name : <?php echo $patient_data['wife_name']; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>Age / Sex : <?php echo $patient_data['wife_age']; ?> / F</strong>
</td>
</tr>
<tr>
<td>
<strong>UHID : <?php 
	        $sql1 = "Select * from ".$this->config->item('db_prefix')."appointments where paitent_id='".$iic_id."' limit 1 "; 
			   $query = $this->db->query($sql1);
                  $select_result1 = $query->result(); 
					foreach ($select_result1 as $res_val2){
						$sql2 = "Select * from ".$this->config->item('db_prefix')."appointments where wife_phone='".$res_val2->wife_phone."' and paitent_type='new_patient'"; 
			            $query = $this->db->query($sql2);
                        $select_result2 = $query->result();
						  foreach ($select_result2 as $res_val){
						?>
	  <?php if($res_val->appoitment_for == '16249589462327'){?>
	  <?php if($res_val->uhid){ ?>001/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16266778858144'){?>
	  <?php if($res_val->uhid){ ?>002/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16267558222750'){?>
	  <?php if($res_val->uhid){ ?>003/<?php echo $res_val->uhid; } ?>
	  <?php }  if($res_val->appoitment_for == '16098223739590') {?>
	  <?php if($res_val->uhid){ ?>004/<?php echo $res_val->uhid; } ?>
	  <?php } if($res_val->appoitment_for == '16133769691598'){?>
	  <?php if($res_val->uhid){ ?>005/<?php echo $res_val->uhid;} ?>
	   <?php } if($res_val->appoitment_for == '1581157290'){?>
	  <?php if($res_val->uhid){ ?>006/<?php echo $res_val->uhid;} ?>
						<?php }}} ?></strong>
</td>
</tr>
<tr>
<td colspan="1" style="width:28%;">
<strong>IIC ID : <?php echo $iic_id; ?></strong>
</td>
</tr>
<tr>
<td>
<strong>IPID : <?php echo isset($select_result['ipid'])?$select_result['ipid']:""; ?></strong>
</td>
</tr>
</tbody>
</table> 
</td>
</tr>
</table>
</div>
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