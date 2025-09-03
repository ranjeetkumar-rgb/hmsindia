<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Accounts_model extends CI_Model
{

	function get_patient_data_by($search_this, $search_by){

		$response = array();
		if($search_by == 'patient'){
			$sql_condition = " patient_id='".$search_this."'";
		}else if($search_by == 'phone'){
			$sql_condition = " patient_phone='".$search_this."'";	
		}else{
			return $response;
		}	
		$consultation_result = $investigate_result = $procedure_result = $consultation =  $investigate =  $procedure = $patient_result = $payment_result = $payments = array();
		
		$patient_sql = "Select * from ".$this->config->item('db_prefix')."patients where $sql_condition";
        $patient_q = $this->db->query($patient_sql);
		$patient_result = $patient_q->result_array();
		if(!empty($patient_result)){
			$patient_id = $patient_result[0]['patient_id'];		
			$consultation_sql = "Select * from ".$this->config->item('db_prefix')."consultation where patient_id='".$patient_id."'";
			$consultation_q = $this->db->query($consultation_sql);
			$consultation_result = $consultation_q->result_array();
			if (!empty($consultation_result))
			{
				$consultation['data'] =  $consultation_result;
				$consultation['type'] = 'consultation';
			}		
			
			$investigate_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where patient_id='".$patient_id."' limit 5";
			$investigate_q = $this->db->query($investigate_sql);
			$investigate_result = $investigate_q->result_array();
			if (!empty($investigate_result))
			{
				$investigate['data'] =  $investigate_result;
				$investigate['type'] = 'investigate';
			}	
			
			$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$patient_id."'";
			$procedure_q = $this->db->query($procedure_sql);
			$procedure_result = $procedure_q->result_array();
			if (!empty($procedure_result))
			{
				$procedure['data'] =  $procedure_result;
				$procedure['type'] = 'procedure';
			}	
			
			$payment_sql = "Select * from ".$this->config->item('db_prefix')."patient_payments where patient_id='".$patient_id."'";
			$payment_q = $this->db->query($payment_sql);
			$payment_result = $payment_q->result_array();
			if (!empty($payment_result))
			{
				$payments['data'] =  $payment_result;
				$payments['type'] = 'payments';
			}	
			
			if (!empty($patient_result))
			{
				$patient_result = $patient_result[0];
			}
			$response = array();
			$response = array('consultation_result' => $consultation, 'investigate_result' => $investigate, 'procedure_result' => $procedure, 'patient_result'=> $patient_result, 'payments'=> $payments);
			return $response;
		}else{
			$response = array();
			return $response;
		}
	}

	function get_patient_data($patient_id){
		$consultation_result = $investigate_result = $procedure_result = $consultation =  $investigate =  $procedure = $patient_result = $payment_result = $payments = array();
		
		$consultation_sql = "Select * from ".$this->config->item('db_prefix')."consultation where patient_id='".$patient_id."' limit 5";
        $consultation_q = $this->db->query($consultation_sql);
        $consultation_result = $consultation_q->result_array();
		if (!empty($consultation_result))
        {
            $consultation['data'] =  $consultation_result;
			$consultation['type'] = 'consultation';
        }		
		
		$investigate_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where patient_id='".$patient_id."' limit 5";
        $investigate_q = $this->db->query($investigate_sql);
        $investigate_result = $investigate_q->result_array();
		if (!empty($investigate_result))
        {
			$investigate['data'] =  $investigate_result;
			$investigate['type'] = 'investigate';
        }	
		
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$patient_id."' limit 5";
        $procedure_q = $this->db->query($procedure_sql);
        $procedure_result = $procedure_q->result_array();
		if (!empty($procedure_result))
        {
			$procedure['data'] =  $procedure_result;
			$procedure['type'] = 'procedure';
        }	
		
		$payment_sql = "Select * from ".$this->config->item('db_prefix')."patient_payments where patient_id='".$patient_id."'";
        $payment_q = $this->db->query($payment_sql);
        $payment_result = $payment_q->result_array();
		if (!empty($payment_result))
        {
			$payments['data'] =  $payment_result;
			$payments['type'] = 'payments';
        }	
		
		$patient_sql = "Select wife_name, wife_phone, wife_email from ".$this->config->item('db_prefix')."patients where patient_id='".$patient_id."'";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		if (!empty($patient_result))
        {
           $patient_result = $patient_result[0];
        }
		$response = array();
		$response = array('consultation_result' => $consultation, 'investigate_result' => $investigate, 'procedure_result' => $procedure, 'patient_result'=> $patient_result, 'payments'=> $payments);
		return $response;
	}
	
	function get_procedure_name($id){
		$result = array();
		$sql = "Select procedure_name from ".$this->config->item('db_prefix')."procedures where ID='".$id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['procedure_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_item_name($item){
		$result = array();
		$sql = "Select item_name from ".$this->config->item('db_prefix')."stocks where item_number='".$item."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['item_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_name($center){
		$result = array();
		$sql = "Select center_name from ".$this->config->item('db_prefix')."centers where center_number='".$center."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['center_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function update_billing($billing, $type){
		$sql = "";
		if($type == 'consultation'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."consultation` SET `status`='accepted' WHERE receipt_number='".$billing."'";
		}
		if($type == 'investigate'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_investigations` SET `status`='accepted' WHERE receipt_number='".$billing."'";
		}
		if($type == 'procedure'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_procedure` SET `status`='accepted' WHERE receipt_number='".$billing."'";
		}
        $this->db->query($sql);
        return $this->db->affected_rows();
	}
	
	function accept_billing(){
		$consultation_result = $investigate_result = $procedure_result = $consultation =  $investigate =  $procedure = array();
		
		$consultation_sql = "Select on_date, receipt_number, fees, remaining_amount, billing_from, billing_at, accepted from ".$this->config->item('db_prefix')."consultation where status='approved' AND remaining_amount='0'";
        $consultation_q = $this->db->query($consultation_sql);
        $consultation_result = $consultation_q->result_array();
				
		$investigate_sql = "Select on_date, receipt_number, fees, discount_amount, remaining_amount, billing_from, billing_at, accepted from ".$this->config->item('db_prefix')."patient_investigations where  status='approved' AND remaining_amount='0'";
        $investigate_q = $this->db->query($investigate_sql);
        $investigate_result = $investigate_q->result_array();
		
		$procedure_sql = "Select procedure_parent, on_date, receipt_number, fees, discount_amount, remaining_amount, billing_from, billing_at, accepted from ".$this->config->item('db_prefix')."patient_procedure where status='approved' AND remaining_amount='0'";
        $procedure_q = $this->db->query($procedure_sql);
        $procedure_result = $procedure_q->result_array();
				
		$response = array();
		$response = array('consultation_result' => $consultation_result, 'investigate_result' => $investigate_result, 'procedure_result' => $procedure_result);
		return $response;
	}
	
	function center_accept_billing(){
		$consultation_result = $investigate_result = $procedure_result = $consultation =  $investigate =  $procedure = array();
		
		$consultation_sql = "Select on_date, receipt_number, fees, remaining_amount, billing_from, billing_at, accepted from ".$this->config->item('db_prefix')."consultation where status='approved' AND remaining_amount='0' AND billing_at='".$_SESSION['logged_accountant']['center']."'";
        $consultation_q = $this->db->query($consultation_sql);
        $consultation_result = $consultation_q->result_array();
				
		$investigate_sql = "Select on_date, receipt_number, fees, discount_amount, remaining_amount, billing_from, billing_at, accepted from ".$this->config->item('db_prefix')."patient_investigations where  status='approved' AND remaining_amount='0' AND billing_at='".$_SESSION['logged_accountant']['center']."'";
        $investigate_q = $this->db->query($investigate_sql);
        $investigate_result = $investigate_q->result_array();
		
		$procedure_sql = "Select procedure_parent, on_date, receipt_number, fees, discount_amount, remaining_amount, billing_from, billing_at, accepted from ".$this->config->item('db_prefix')."patient_procedure where status='approved' AND remaining_amount='0' AND billing_at='".$_SESSION['logged_accountant']['center']."'";
        $procedure_q = $this->db->query($procedure_sql);
        $procedure_result = $procedure_q->result_array();
				
		$response = array();
		$response = array('consultation_result' => $consultation_result, 'investigate_result' => $investigate_result, 'procedure_result' => $procedure_result);
		return $response;
	}
	
	function patient_ledger(){
		$result = array();
		
		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		if (!empty($patient_result))
        {
		   foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = 0;
								
				$procedure_sql = "Select payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."' and status='approved'";
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result))
				{
					foreach($procedure_result as $ky => $vl){
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
				
				if($total > 0){
					$result[] = array('patient_id' => $val['patient_id'], 'patient_name' => $val['wife_name'], 'total' => $total, 'balance' => $balance, 'payment_ivf_share' => $payment_ivf_share, 'payment_center_share' => $payment_center_share, 'payment_ivf' => $payment_ivf, 'payment_center' => $payment_center);
				}
		   }
        }
		return $result;
	}
	
	function ajax_patient_month_ledger($month){
		$result = array();
		
		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		$html = '';
		if (!empty($patient_result))
        {
		   foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = 0;
				
				$procedure_sql = "Select payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."' AND MONTH(on_date) = '".$month."'";
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result))
				{
					foreach($procedure_result as $ky => $vl){
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
									
				if($total > 0){
					$current_balance = $this->get_current_balance($val['patient_id']);
					$payment_at = $this->get_payment_at($val['patient_id']);
					$html .= '<tr class="odd gradeX">
							  <td>'.$val['patient_id'].'</td>
							  <td>'.$val['wife_name'].'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$total.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.($total-$current_balance).'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$current_balance.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_ivf_share.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_center_share.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_at['payment_ivf'].'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_at['payment_center'].'</td>
							</tr>';
				}
		   }
        }
		return $html;
	}
	
	function ajax_patient_custom_ledger($start, $end){
		$result = array();
		
		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		$html = '';
		if (!empty($patient_result))
        {
		   foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = 0;
				
				$procedure_sql = "Select payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."' AND on_date between '".$start."' AND '".$end."'";
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result))
				{
					foreach($procedure_result as $ky => $vl){
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
				if($total > 0){
					$current_balance = $this->get_current_balance($val['patient_id']);
					$payment_at = $this->get_payment_at($val['patient_id']);
					$html .= '<tr class="odd gradeX">
							  <td>'.$val['patient_id'].'</td>
							  <td>'.$val['wife_name'].'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$total.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.($total-$current_balance).'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$current_balance.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_ivf_share.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_center_share.'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_at['payment_ivf'].'</td>
							  <td><i class="fa fa-inr" aria-hidden="true"></i> '.$payment_at['payment_center'].'</td>
							</tr>';
				}
		   }
        }
		return $html;
	}
	
	function center_patient_ledger(){
		$result = array();
		
		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		if (!empty($patient_result))
        {
			$conditions = '';
			//var_dump($_SESSION['logged_accountant']['center']); die;
			if(isset($_SESSION['logged_accountant']['center']) && $_SESSION['logged_accountant']['center'] != 0)
			{ $conditions = ' AND billing_at="'.$_SESSION['logged_accountant']['center'].'"'; }
			
		    foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = 0;
				
				 $procedure_sql = "Select payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."' $conditions AND status='approved'";
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result))
				{
					foreach($procedure_result as $ky => $vl){
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						
						
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
				
				if($total > 0){
					$result[] = array('patient_id' => $val['patient_id'], 'patient_name' => $val['wife_name'], 'total' => $total, 'balance' => $balance, 'payment_ivf_share' => $payment_ivf_share, 'payment_center_share' => $payment_center_share, 'payment_ivf' => $payment_ivf, 'payment_center' => $payment_center);
				}
		   }
        }
		return $result;
	}

	function ajax_center_patient_ledger_data($start, $end, $center){
		$result = array();
		$response = "";

		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		if (!empty($patient_result))
        {
			$conditions = '';
			//var_dump($_SESSION['logged_accountant']['center']); die;
			if($center != 0){ $conditions = ' AND billing_at="'.$center.'"'; }
		    foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = 0;
				
				$procedure_sql = "Select payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."' AND on_date between '".$start."' AND '".$end."' $conditions AND status='approved'";
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result))
				{
					foreach($procedure_result as $ky => $vl){
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
				
				if($total > 0){
					$result[] = array('patient_id' => $val['patient_id'], 'patient_name' => $val['wife_name'], 'total' => $total, 'balance' => $balance, 'payment_ivf_share' => $payment_ivf_share, 'payment_center_share' => $payment_center_share, 'payment_ivf' => $payment_ivf, 'payment_center' => $payment_center);
				}
		   }
		}

		if(!empty($result)){
			foreach($result as $key => $vl){
				$current_balance = $this->get_current_balance($vl['patient_id']);
                $payment_at = $this->get_payment_at($vl['patient_id']);
				$response .='<tr class="odd gradeX">
				<td><a href="'.base_url().'accounts/patient_details/'.$vl['patient_id'].'">'.$vl['patient_id'].'</a></td>
				<td>'. $vl['patient_name'].'</td>
				<td>'. $vl['total'].'</td>
				<td>'. ($vl['total'] - $current_balance).'</td>
				<td>'. $current_balance.'</td>                  
				<td>'. $vl['payment_ivf_share'].'</td>
				<td>'. $vl['payment_center_share'].'</td>
				<td>'. $payment_at['payment_ivf'].'</td>
				<td>'. $payment_at['payment_center'].'</td>
			  </tr>';
			}
		}
		return $response;
	}

	function download_center_patient_ledger_data($start, $end, $center){
		$result = array();
		
		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		if (!empty($patient_result))
        {
			$conditions = '';
			//var_dump($_SESSION['logged_accountant']['center']); die;
			if($center != 0){ $conditions = ' AND billing_at="'.$center.'"'; }
			if($start !== "" && $end !== ""){
				$conditions .= " AND on_date between '".$start."' AND '".$end."'";
			}
			
		    foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = 0;
				
				$procedure_sql = "Select payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."'  $conditions AND status='approved'";
			//	echo $procedure_sql;die;
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result)){
					foreach($procedure_result as $ky => $vl){
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						
						
						
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				$total_paid_amount = 0;
				 $patient_sql3 ="SELECT sum(payment_done) as payment from hms_patient_payments where type='procedure' AND status='1' AND patient_id='".$val['patient_id']."'";
						$patient_sql2 = $this->db->query($patient_sql3);
				        $patient_result2 = $patient_sql2->result_array();
						  foreach($patient_result2 as $ky1 => $val1){
							$total_paid_amount += $val1['payment'];
						  }
				//($total_paid_amount);//die;
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain - $total_paid_amount;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
				
				if($total > 0){
					$result[] = array('patient_id' => $val['patient_id'], 'patient_name' => $val['wife_name'], 'total' => $total, 'payment_center' => $payment_center, 'balance' => $balance, 'payment_ivf_share' => $payment_ivf_share, 'payment_center_share' => $payment_center_share, 'payment_ivf' => $payment_ivf, 'payment_center' => $payment_center);
				}
		   }
        }
		return $result;
	}
	
	function billings_request_list(){
		$consultation_result = $investigate_result = $procedure_result = array();
		$conditions = '';
		//var_dump($_SESSION['logged_accountant']['center']); die;
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ $conditions = ' where billing_at="'.$_SESSION['logged_accountant']['center'].'"'; }
		
		$consultation_sql = "Select * from ".$this->config->item('db_prefix')."consultation ".$conditions." order by on_date desc";
        $consultation_q = $this->db->query($consultation_sql);
        $consultation_result = $consultation_q->result_array();
		
		$investigate_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations ".$conditions." order by on_date desc";
        $investigate_q = $this->db->query($investigate_sql);
        $investigate_result = $investigate_q->result_array();
		
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure ".$conditions." order by on_date desc";
        $procedure_q = $this->db->query($procedure_sql);
        $procedure_result = $procedure_q->result_array();
        
        $patient_payments_sql = "Select * from ".$this->config->item('db_prefix')."patient_payments ".$conditions." order by on_date desc";
        $patient_payments_q = $this->db->query($patient_payments_sql);
        $patient_payments_result = $patient_payments_q->result_array();
		
		$response = array();
		$response = array('consultation_result' => $consultation_result, 'investigate_result' => $investigate_result, 'procedure_result' => $procedure_result, 'patient_payments_result' => $patient_payments_result);
		return $response;
	}
	
	function approve_billing($request, $type, $status, $reason, $reason_of_cancle){ 
		$result = array();
		if($type == 'consultation'){			
			$sql = "UPDATE `".$this->config->item('db_prefix')."consultation` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE ID='".$request."'";
		}else if($type == 'investigation'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_investigations` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE ID='".$request."'";
		}else if($type == 'procedure'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_procedure` SET `status`='$status',`reason_of_disapprove`='$reason',`reason_of_cancle`='$reason_of_cancle' WHERE ID='".$request."'";
		}else if($type == 'medicine'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_medicine` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE ID='".$request."'";
		}else if($type == 'partialpayments'){
		$sql = "UPDATE `".$this->config->item('db_prefix')."patient_payments` SET `status`='$status',`disapproval_reason`='$reason' WHERE ID='".$request."'";
		}
		
        $q = $this->db->query($sql);
        return 1;
	}
	
	function approve_billing_by_receipt($request, $type, $status, $reason){
		$result = array();
		if($type == 'consultation'){			
		   $sql = "UPDATE `".$this->config->item('db_prefix')."consultation` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE receipt_number='".$request."'";
		}else if($type == 'investigation'){
		   $sql = "UPDATE `".$this->config->item('db_prefix')."patient_investigations` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE receipt_number='".$request."'";
		}else if($type == 'procedure'){
		   $sql = "UPDATE `".$this->config->item('db_prefix')."patient_procedure` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE receipt_number='".$request."'";
		}
        $q = $this->db->query($sql);
        return 1;
	}
	
	function update_accept_billing($receipt, $type){
		$result = array();
		if($type == 'consultation'){			
			$sql = "UPDATE `".$this->config->item('db_prefix')."consultation` SET `accepted`='1' WHERE receipt_number='".$receipt."'";
		}else if($type == 'investigation'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_investigations` SET `accepted`='1' WHERE receipt_number='".$receipt."'";
		}else if($type == 'procedure'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_procedure` SET `accepted`='1' WHERE receipt_number='".$receipt."'";
		}
        $q = $this->db->query($sql);
        return 1;
	}
	
	function reconciliation(){
		
		$result = array();
		
		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		if (!empty($patient_result))
        {
		   foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = $p_totalpackage = 0;
				
				$procedure_sql = "Select patient_id, totalpackage, payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."' AND share='1' AND status='approved'";
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result))
				{
					foreach($procedure_result as $ky => $vl){
						$p_totalpackage += $vl['totalpackage'];
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
				
				if($total > 0){
					$result[] = array('patient_id' => $val['patient_id'], 'patient_name' => $val['wife_name'], 'total' => $total, 'balance' => $balance, 'payment_ivf_share' => $payment_ivf_share, 'payment_center_share' => $payment_center_share, 'payment_ivf' => $payment_ivf, 'payment_center' => $payment_center, 'totalpackage' => $p_totalpackage);
				}
		   }
        }
		return $result;
	}
	
	function center_reconciliation(){
	
		$result = array();
		$patient_sql = "Select patient_id, wife_name from ".$this->config->item('db_prefix')."patients order by ID desc";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		if (!empty($patient_result))
        {
			$conditions = '';
			//var_dump($_SESSION['logged_accountant']['center']); die;
			if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ $conditions = ' AND billing_at="'.$_SESSION['logged_accountant']['center'].'"'; }
			
		   foreach($patient_result as $key => $val){
		   		$c_fee = $c_remain = $c_done = $c_ivf = $c_center =  $c_share = $i_fee = $i_remain = $i_done = $i_ivf = $i_center =  $i_share = $p_fee = $p_remain = $p_done = $p_ivf = $p_center = $p_center_share = $p_ivf_share = $p_totalpackage = 0;
				
				$procedure_sql = "Select patient_id, totalpackage, payment_done, remaining_amount, center_share, fees, billing_from from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$val['patient_id']."' AND share='1' AND status='approved' $conditions";
				$procedure_q = $this->db->query($procedure_sql);
				$procedure_result = $procedure_q->result_array();
				if (!empty($procedure_result))
				{
					foreach($procedure_result as $ky => $vl){ //var_dump($vl);die;
						$p_totalpackage += $vl['totalpackage'];
						$p_fee += $vl['fees'];
						$p_done += $vl['payment_done'];
						$p_remain += $vl['remaining_amount'];
						$p_center_share  += ($vl['fees']-$vl['center_share']);
						$p_ivf_share += $vl['center_share'];
						if($vl['billing_from'] == 'IndiaIVF'){
							$p_ivf += $vl['payment_done'];
						}else{
							$p_center += $vl['payment_done'];
						}
					}
				}
				
				$total = $balance = $payment_ivf = $payment_center = 0;
				
				$total = $c_fee + $i_fee + $p_fee;
				$balance = $c_remain + $i_remain + $p_remain;
				$payment_ivf_share = $p_ivf_share;
				$payment_center_share = $p_center_share;
				$payment_ivf = $p_ivf;
				$payment_center = $p_center;
				
				if($total > 0){
					$result[] = array('patient_id' => $val['patient_id'], 'patient_name' => $val['wife_name'], 'total' => $total, 'balance' => $balance, 'payment_ivf_share' => $payment_ivf_share, 'payment_center_share' => $payment_center_share, 'payment_ivf' => $payment_ivf, 'payment_center' => $payment_center, 'totalpackage' => $p_totalpackage);
				}
		   }
        }
		return $result;
	}
	
	
	function get_details($receipt, $type){
		$result = array();
		if($type == 'consultation'){			
			$sql = "Select * from `".$this->config->item('db_prefix')."consultation` WHERE receipt_number='".$receipt."'";
		}else if($type == 'investigation'){
			$sql = "Select * from `".$this->config->item('db_prefix')."patient_investigations` WHERE receipt_number='".$receipt."'";
		}else if($type == 'procedure'){
			$sql = "Select * from `".$this->config->item('db_prefix')."patient_procedure` WHERE receipt_number='".$receipt."'";
		}
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}
	
	function patient_payments($patient_id){
		
		$sql = "Select sum(payment_done) as payment_done, sum(fees) as fees from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$patient_id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		
		$done_sql = "Select sum(payment_done) as payment_done from ".$this->config->item('db_prefix')."patient_payments where patient_id='".$patient_id."'";
        $done_q = $this->db->query($done_sql);
        $done_result = $done_q->result_array();
		
		$fees = $result[0]['fees'];
		$billing_payment_done = $result[0]['payment_done'];
		$patient_payments_done = $done_result[0]['payment_done'];
		$total_done = round($billing_payment_done+$patient_payments_done, 2);
		$current_balance = round($fees - $total_done, 2);
		
		
		$patient_sql = "Select wife_name, patient_phone, wife_email from ".$this->config->item('db_prefix')."patients where patient_id='".$patient_id."'";
        $patient_q = $this->db->query($patient_sql);
        $patient_result = $patient_q->result_array();
		
		$response = array();
		$response = array('current_balance' => $current_balance, 'patient_id' =>$patient_id, 'wife_name' =>$patient_result[0]['wife_name'], 'patient_phone' =>$patient_result[0]['patient_phone'], 'wife_email' =>$patient_result[0]['wife_email']);
		return $response;
	}
	
	function get_current_balance($patient_id){
		$sql = "Select sum(payment_done) as payment_done, sum(fees) as fees from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$patient_id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		
		$done_sql = "Select sum(payment_done) as payment_done from ".$this->config->item('db_prefix')."patient_payments where patient_id='".$patient_id."' AND type='procedure' and status='1'";
        $done_q = $this->db->query($done_sql);
        $done_result = $done_q->result_array();
		
		$fees = $result[0]['fees'];
		$billing_payment_done = $result[0]['payment_done'];
		$patient_payments_done = $done_result[0]['payment_done'];
		$total_done = round($billing_payment_done+$patient_payments_done, 2);
		$current_balance = round($fees - $total_done, 2);
		
		return $current_balance;
	}
	
	function get_payment_at($patient_id){
		$ivf_sql = "Select sum(payment_done) as payment_done from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$patient_id."' AND billing_from='IndiaIVF' and status='approved'";
        $ivf_q = $this->db->query($ivf_sql);
        $ivf_result = $ivf_q->result_array();
		
		$cnter_sql = "Select sum(payment_done) as payment_done from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$patient_id."' AND billing_from!='IndiaIVF' and status='approved'";
        $cnter_q = $this->db->query($cnter_sql);
        $cnter_result = $cnter_q->result_array();
		
		$ivf_p_sql = "Select sum(payment_done) as payment_done from ".$this->config->item('db_prefix')."patient_payments where patient_id='".$patient_id."' AND type='procedure' AND billing_from='IndiaIVF' AND status='1'";
        $ivf_p_q = $this->db->query($ivf_p_sql);
        $ivf_p_result = $ivf_p_q->result_array();
		
		$cnter_p_sql = "Select sum(payment_done) as payment_done from ".$this->config->item('db_prefix')."patient_payments where patient_id='".$patient_id."' AND type='procedure' AND billing_from!='IndiaIVF' AND status='1'";
        $cnter_p_q = $this->db->query($cnter_p_sql);
        $cnter_p_result = $cnter_p_q->result_array();
		
		$billing_done = $ivf_result[0]['payment_done'];
		$cnter_done = $cnter_result[0]['payment_done'];
		$billing_p_done = $ivf_p_result[0]['payment_done'];
		$cnter_p_done = $cnter_p_result[0]['payment_done'];
		
		$payment_ivf = ($billing_done+$billing_p_done);
		$payment_ivf = round($payment_ivf, 2);
		$payment_center = ($cnter_done+$cnter_p_done);
		$payment_center = round($payment_center, 2);
		
		$response = array('payment_ivf' => $payment_ivf, 'payment_center' => $payment_center);
		return $response;		
	}
		
	
	function partial_payments(){
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_payments where status='0' order by on_date desc";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		return $result;
	}
	
	function approve_payment($id){
		$sql = "";
		$sql = "UPDATE `".$this->config->item('db_prefix')."patient_payments` SET `status`='1' WHERE ID='".$id."'";
        $this->db->query($sql);
        return $this->db->affected_rows();
	}
	
	function disapprove_payment($id, $reason){
		$sql = "";
		$sql = "UPDATE `".$this->config->item('db_prefix')."patient_payments` SET `status`='2', `disapproval_reason`='$reason' WHERE ID='".$id."'";
        $this->db->query($sql);
        return $this->db->affected_rows();
	}
		
	function patient_details($patient_id){
		$result = array();
		$sql = "Select * from ".$this->config->item('db_prefix')."patients where patient_id='".$patient_id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0];
        }
        else
        {
            return $result;
        }
	}	
		
	function get_patient_name($patient_id){
		
		$result = array();
		$sql = "Select wife_name from ".$this->config->item('db_prefix')."patients where patient_id='".$patient_id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['wife_name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_center_list($patient_id){
		$result = array();
		$sql = "Select billing_at from ".$this->config->item('db_prefix')."patient_procedure where patient_id='".$patient_id."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return array_unique($result);
        }
        else
        {
            return $result;
        }
	}
	
	
	function get_doctor_name($doctor){
		
		$result = array();
		$sql = "Select name from ".$this->config->item('db_prefix')."doctors where ID='".$doctor."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_investigation_name($investig){
		
		$result = array();
		$sql = "Select investigation from ".$this->config->item('db_prefix')."investigation where ID='".$investig."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['investigation'];
        }
        else
        {
            return $result;
        }
	}
	
	function get_admin_email(){
		$result = array();
		$sql = "Select email from ".$this->config->item('db_prefix')."employees where role='administrator'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['email'];
        }
        else
        {
            return $result;
        }
	}
	
	// SAGAR
	
	function check_patient($patient_id)
	{
		$result = array();
		$sql = "Select ID from ". $this->config->item('db_prefix')."patients WHERE patient_id = '".$patient_id."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return $result[0];
		}
		else
		{
			return $result;
		}
	}
	
	function insert_settle($data){
		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "settlements` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}		
		$sql .= implode(',' , $sqlArr);
		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function insert_add_mou($data){
	 $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "mou` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}		
		$sql .= implode(',' , $sqlArr);
		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function mou_count($status, $party_name, $start_date, $end_date){
		$procedure_result = array();
		$conditions = '';
		if (!empty($status)){
			$conditions .= " and status='$status'";
		}
		if(!empty($party_name)){
			$conditions .= " and party_name like '%$party_name%'";
        }
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."mou where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		
	}
	
	function mou_patination($limit, $page, $status, $party_name, $start_date, $end_date){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($status)){
			$conditions .= " and status='$status'";
		}
		if(!empty($party_name)){
			$conditions .= " and party_name like '%$party_name%'";
        }
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."mou where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}
	
	public function update_mou($data, $ID, $transaction_img)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "mou SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$ID."'";
        $this->db->query($sql);
        return 1;
    }
	
	function check_settle($patient_id)
	{
		$result = array();
		$ivf_sql = "Select sum(payment_done) as payment_done from ". $this->config->item('db_prefix')."settlements WHERE patient_id = '".$patient_id."' AND payment_to='IndiaIVF'";
		$ivf_q = $this->db->query($ivf_sql);
		$ivf_result = $ivf_q->result_array();
		
		$center_sql = "Select sum(payment_done) as payment_done from ". $this->config->item('db_prefix')."settlements WHERE patient_id = '".$patient_id."' AND payment_to!='IndiaIVF'";
		$center_q = $this->db->query($center_sql);
		$center_result = $center_q->result_array();
		
		$ivf_payment = $ivf_result[0]['payment_done'];
		$center_payment = $center_result[0]['payment_done'];
		
		$response = array();
		$response = array('ivf_settle' => round($ivf_payment), 'center_settle' => round($center_payment));
		return $response;
	}
	
	function update_patient_reconcile($receipt_number, $type, $payment_done){
		$result = array();
		$condition = '';
		if($type == 'consultation'){
			$condition = 'consultation';
		}else if($type == 'investigation'){
			$condition = 'patient_investigations';
		}else if($type == 'procedure'){
			$condition = 'patient_procedure';
		}else{
			return $result;
		}
		$sql = "UPDATE ".config_item('db_prefix').$condition." SET remaining_amount='0', payment_done=(payment_done - ".$payment_done.")  WHERE receipt_number='".$receipt_number."'";
        $this->db->query($sql);
        return 1;
	}	
	
	function billing_discount($data, $patient_id, $receipt_number, $billing_type){
		$result = array();
		$sql = "Select * from ". $this->config->item('db_prefix')."discount_approval WHERE patient_id = '".$patient_id."' and receipt_number='".$receipt_number."' and type='".$billing_type."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if(!empty($result))
		{
			return 2;
		}else{
			$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "discount_approval` SET ";
			$sqlArr = array();
			foreach( $data as $key=> $value )
			{
				$sqlArr[] = " $key = '".addslashes($value)."'"	;
			}		
			$sql .= implode(',' , $sqlArr);
			$res =  $this->db->query($sql);
			if ($res)
			{
				return 1;
			}
			else
				return 0;
		}
	}	
	
	function discount_request($billing_type, $patient, $status, $receipt, $reason, $disapprove_amount){
		$table = "";
		if($billing_type == "consultation"){
			$table = "consultation";
		}else if($billing_type == "investigation"){
			$table = "patient_investigations";
		}else if($billing_type == "procedure"){
			$table = "patient_procedure";
		}else{
			return 3;	
		}

		$table_sql = "Select * from ". $this->config->item('db_prefix').$table." WHERE patient_id = '".$patient."' AND receipt_number='".$receipt."'";
		$table_q = $this->db->query($table_sql);
		$table_result = $table_q->result_array();
		if(!empty($table_result)){
			$sql = "Select * from ". $this->config->item('db_prefix')."discount_approval WHERE patient_id = '".$patient."' AND receipt_number='".$receipt."' AND status='0'";
			$q = $this->db->query($sql);
			$result = $q->result_array();
			if (!empty($result))
			{
			    $disapprove_amount_condition = "";
				if(!empty($disapprove_amount)){
					$disapprove_amount_condition = ", amount='$disapprove_amount'";
					$status = 2;
				}
				$sql = "UPDATE ". $this->config->item('db_prefix')."discount_approval SET status='".$status."', disapproval_reason='".$reason."' ".$disapprove_amount_condition." WHERE receipt_number='".$receipt."' AND patient_id='".$patient."'";
				$this->db->query($sql);
				return 1;
			}
			else
			{
				return 0;
			}
		}else
		{
			return 2;
		}
	}
	
	function get_billing_discount(){
		$result = array();
		$sql = "Select * from ". $this->config->item('db_prefix')."discount_approval order by ID desc";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		
		if (!empty($result))
        {
			return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_discount_biller($patient, $receipt){
		$sql = "Select * from ". $this->config->item('db_prefix')."discount_approval WHERE patient_id = '".$patient."' AND receipt_number='".$receipt."'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if (!empty($result))
        {
			return $result[0];
        }
        else
        {
            return "";
        }
	}
	
	function check_billing_discount($patient, $receipt_number){
		$result = array();
		$sql = "Select * from ". $this->config->item('db_prefix')."discount_approval WHERE patient_id = '".$patient."' AND receipt_number='".$receipt_number."' AND status='0'";
		$q = $this->db->query($sql);
		$result = $q->result_array();
		if (!empty($result))
        {
			return 1;
        }
        else
        {
            return 0;
        }
	}
	
	function check_discound_applied($receipt){
		$sql = "Select count(*) as discount from ".$this->config->item('db_prefix')."discount_approval where receipt_number='".$receipt."' AND used='0'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['discount'];
        }
        else
        {
            return $result;
        }
	}
	
	function discount_applied_status($receipt){
		$sql = "Select status from ".$this->config->item('db_prefix')."discount_approval where receipt_number='".$receipt."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['status'];
        }
        else
        {
            return $result;
        }
	}
	
	

	function investigation_reports($patient_id){
		$result = array();
		
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_investigation_reports where patient_id='$patient_id' and doctor_accepted='approved'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		if(!empty($result)){
			return $result;
		}else{
			return $result;
		}
	}

	function get_partial_payment_receipt($payment_id){
		$result = array();		
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_payments where refrence_number='$payment_id'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		if(!empty($result)){
			return $result[0];
		}else{
			return $result;
		}
	}

	function procedure_reports($patient_id){
		$result = array();
		
		$sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where patient_id='$patient_id' order by ID desc limit 1";
        $q = $this->db->query($sql);
        $result = $q->result_array();
		if(!empty($result)){
			return $result[0];
		}else{
			return $result;
		}
	}
	
	function get_discharge_form_data() {
        $this->db->from('hms_discharge_forms');
         $this->db->where('status', 'active');
        $sel = $this->db->get();
        $q = $sel->result_array();
        if ($q) {
            return $q;
        }    	
	}
	
	function get_discharge_form_data_embrology() {
        $this->db->from('hms_discharge_forms');
        $this->db->where('status', 'active');
		$this->db->where('role', 'embryologist');
        $sel = $this->db->get();
        $q = $sel->result_array();
        if ($q) {
            return $q;
        }    	
	}
	
	function patient_discharge($patient_id){
	    $this->db->from('hms_discharge_forms');
        $this->db->where('status', 'active');
        $sel = $this->db->get();
        $res = $sel->result_array();
        
        $res_arr = array();
	    foreach($res as $rs){
	        $sql = "SELECT id, iic_id, updated_by, updated_at, appoitmented_date, updated_type FROM `".$rs['db_name']."` WHERE iic_id='".$patient_id."'";
            $q = $this->db->query($sql);
            $result = $q->result_array();
            if(!empty($result)){
                foreach($result as $vl){
                    $vl['form_name'] = $rs['form_name'];
                    $vl['form_id'] = $rs['id'];
                    $res_arr[] = $vl;
                }
            }
	    }
	    
	    return $res_arr;
	}

	function patient_procedure_count($center, $start_date, $end_date, $patient_id, $payment_method){
		$procedure_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if(!empty($sub_procedures_code)){
			$conditions .= ' and sub_procedures_code="'.$sub_procedures_code.'"';
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}

		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		
	}

	function patient_procedure_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $payment_method){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}

	function export_procedure_data($start, $end, $center, $type, $payment_method){

		$procedure_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		
	     $procedure_sql = "Select DISTINCT patient_id, receipt_number, totalpackage, fees as discounted_package,payment_done,remaining_amount,
		payment_method,billing_from,billing_at,data,on_date,status,hospital_id from ".$this->config->item('db_prefix')."patient_procedure where 1
		$conditions order by on_date desc";
        $procedure_q = $this->db->query($procedure_sql);
        $procedure_result = $procedure_q->result_array();
        if(!empty($procedure_result)){
            foreach($procedure_result as $key => $val){
				$hms_procedures_result = unserialize( $val['data']);
				$procedure_nameArr = [];
				foreach ($hms_procedures_result as $v2_data123){
						foreach ($v2_data123 as $v2_data5){

						    $sql12 = "select procedure_name from hms_procedures where code='".$v2_data5['sub_procedures_code']."'"; 
                            $query12 = $this->db->query($sql12);
                            $select_result1 = $query12->result(); 
							
							foreach ($select_result1 as $res_val){
								// echo $res_val->procedure_name;
								 array_push($procedure_nameArr,$res_val->procedure_name);
							}
						}
						
				}
					 
				$procedure_name1 = implode(',',$procedure_nameArr); 
				
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'receipt_number' => $val['receipt_number'],
				        'totalpackage' => $val['totalpackage'],
                        'discounted_package' => $val['discounted_package'],
                        'payment_done' => $val['payment_done'],
                        'remaining_amount' => $val['remaining_amount'],
                        'payment_method' => $val['payment_method'],
                        'billing_from' => $val['billing_from'],
                        'billing_at' => $val['billing_at'],
						'procedure_name' => $procedure_name1,
						'billing_type' => 'Procedure',
						'on_date' => $val['on_date'],
                        'status' => $val['status'],
						'hospital_id' => $val['hospital_id'],
                );
            }
        }    
		return $response;
    }
	
	function export_consumption_medicine($start_date, $end_date, $center, $patient_id, $payment_method){
		$consuption_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select DISTINCT patient_id, on_date, data, receipt_number from ".$this->config->item('db_prefix')."patient_procedure where status='approved' and 1 $conditions";
        $investigation_q = $this->db->query($investigation_sql);
        $consuption_result = $investigation_q->result_array();
        if(!empty($consuption_result)){
            foreach($consuption_result as $key => $val){
				$_data = unserialize($val['data']);
				$medicine_name_arr = [];
				$medicine_quantity_arr = [];
				$medicine_stock_arr = [];
				$sub_procedures_discount_arr = [];
				$sub_procedures_paid_price_arr = [];
				//echo'<pre>';
				//print_r($_data);
                //die;
			    //echo'<br>';
				foreach($_data as $value1){
					//print_r($value1);
					//echo'<pre>';
				//print_r($value1);
                //die;
			    //echo'<br>';
					foreach($value1 as $value3){
						
						if($value3['sub_procedure']){
							
								array_push($medicine_name_arr,$value3['sub_procedure']);
								array_push($medicine_quantity_arr,$value3['sub_procedures_code']);
							    array_push($medicine_stock_arr,$value3['sub_procedures_price']);
							    array_push($sub_procedures_discount_arr,$value3['sub_procedures_discount']);
						    }
					}
				}
				//print_r($sub_procedure);
				//die();
				 $sub_procedure = implode(',', $medicine_name_arr );
				 $sub_procedures_code = implode(',', $medicine_quantity_arr );
				 $sub_procedures_price = implode(',', $medicine_stock_arr );
				 $sub_procedures_discount = implode(',', $sub_procedures_discount_arr );
				if($sub_procedure  != ''){
				 $medicine_name_sql = "SELECT procedure_name FROM hms_procedures WHERE ID IN (".$sub_procedure.") " ;
				}
				
				       /* echo'<pre>';
					    print_r($final_medicine123);
						print_r($medicine_quantity_arr[$_key]);
						echo'<br>';*/
				
				$_medicine_name_arr = [];
				$medicine_name_sql_q = $this->db->query($medicine_name_sql);
				$medicine_name_sql_q_result = $medicine_name_sql_q->result_array();
				if(!empty($medicine_name_sql_q_result)){
					foreach($medicine_name_sql_q_result as $key => $medicine_name_val){
						array_push($_medicine_name_arr,$medicine_name_val['procedure_name']);
					}
				}
				
				foreach($_medicine_name_arr as $_key => $_value){
					$final_medicine123 = $_value;
					
				//die();
					$response[] = array(
				        'on_date' => $val['on_date'],
                        'patient_id' => $val['patient_id'],
				        'sub_procedure'=> $medicine_name_arr[$_key],
						'sub_procedures_code' => $medicine_quantity_arr[$_key],
						'sub_procedures_price' => $medicine_stock_arr[$_key],
						'sub_procedures_discount' => $sub_procedures_discount_arr[$_key],
						'sub_procedures_discount' => $sub_procedures_discount_arr[$_key]
			    );
				}
			}
		}      
		return $response;
    }
	
	/*******Psychological*******/
	
		function patient_psychological_count($center, $start_date, $end_date, $patient_id, $payment_method){
		$procedure_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($payment_method)){
			$conditions .= " and payment_method='$payment_method'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}

		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		
	}

	function patient_psychological_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $payment_method){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($payment_method)){
			$conditions .= " and payment_method='$payment_method'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}

	function export_psychological_data($start, $end, $center, $type, $payment_method){

		$procedure_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if (!empty($payment_method)){
			$conditions .= " and payment_method='$payment_method'";
		}
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		
	     $procedure_sql = "Select DISTINCT patient_id, receipt_number, totalpackage, fees as discounted_package,payment_done,remaining_amount,
		payment_method,billing_from,billing_at,data,on_date as date,status from ".$this->config->item('db_prefix')."patient_procedure where 1
		$conditions order by on_date desc";
        $procedure_q = $this->db->query($procedure_sql);
        $procedure_result = $procedure_q->result_array();
        if(!empty($procedure_result)){
            foreach($procedure_result as $key => $val){
				$hms_procedures_result = unserialize( $val['data']);
				$procedure_nameArr = [];
				foreach ($hms_procedures_result as $v2_data123){
						foreach ($v2_data123 as $v2_data5){

						    $sql12 = "select procedure_name from hms_procedures where code='".$v2_data5['sub_procedures_code']."'"; 
                            $query12 = $this->db->query($sql12);
                            $select_result1 = $query12->result(); 
							
							foreach ($select_result1 as $res_val){
								// echo $res_val->procedure_name;
								 array_push($procedure_nameArr,$res_val->procedure_name);
							}
						}
						
				}
					 
				$procedure_name1 = implode(',',$procedure_nameArr); 
				
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'receipt_number' => $val['receipt_number'],
				        'totalpackage' => $val['totalpackage'],
                        'discounted_package' => $val['discounted_package'],
                        'payment_done' => $val['payment_done'],
                        'remaining_amount' => $val['remaining_amount'],
                        'payment_method' => $val['payment_method'],
                        'billing_from' => $val['billing_from'],
                        'billing_at' => $val['billing_at'],
						'billing_at' => $val['billing_at'],
                        'procedure_name' => $procedure_name1,
                        'status' => $val['status'],
                        'billing_type' => 'Procedure',
                );
            }
        }    
		return $response;
    }

	
	/************Investigation***********/
	
	function patient_investigation_count($center, $start_date, $end_date, $patient_id, $payment_method){
		$investigation_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}

		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		
	}

	function patient_investigation_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $payment_method){
		$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	}
	
function export_investigation_data($start, $end, $center, $type, $payment_method){

		$investigation_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		
	    $investigation_sql = "Select DISTINCT patient_id, receipt_number, totalpackage, fees as discounted_package,payment_done,remaining_amount,investigations,payment_method,billing_from,billing_at,on_date as date,status from ".$this->config->item('db_prefix')."patient_investigations where 1 $conditions order by on_date desc";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				
				$hms_procedures_result = unserialize( $val['investigations']);
				$investigation_nameArr = [];
				foreach ($hms_procedures_result as $v2_data123){
						foreach ($v2_data123 as $v2_data5){

						    $sql12 = "select investigation from hms_investigation where code='".$v2_data5['female_investigation_code']."'"; 
                            $query12 = $this->db->query($sql12);
                            $select_result1 = $query12->result(); 
							
							//print_r($select_result1);
							//echo select_result1['investigation'];
							
							foreach ($select_result1 as $res_val){
								// echo $res_val->investigation;
								 array_push($investigation_nameArr,$res_val->investigation);
							}
						}
						
				}
				//die;
					 
				$investigation_name1 = implode(',',$investigation_nameArr); 
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'receipt_number' => $val['receipt_number'],
						 'totalpackage' => $val['totalpackage'],
                        'discounted_package' => $val['discounted_package'],
                        'payment_done' => $val['payment_done'],
                        'remaining_amount' => $val['remaining_amount'],
                        'payment_method' => $val['payment_method'],
                        'billing_from' => $val['billing_from'],
                        'billing_at' => $val['billing_at'],
						'investigation' => $investigation_name1,
                        'date' => $val['date'],
                        'status' => $val['status'],
                        'billing_type' => 'Investigation',
                );
            }
        }    
		return $response;
    }
	
	function export_investigation_medicine($start_date, $end_date, $center, $patient_id, $origins){
		$female_investigation_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($origins)){
			$conditions .= ' and origins="'.$origins.'"';
        }
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select DISTINCT patient_id, on_date, investigations, receipt_number from ".$this->config->item('db_prefix')."patient_investigations where status='approved' and 1 $conditions";
        $investigation_q = $this->db->query($investigation_sql);
        $female_investigation_result = $investigation_q->result_array();
        if(!empty($female_investigation_result)){
            foreach($female_investigation_result as $key => $val){
				$data = unserialize($val['investigations']);
				$investigation_name_arr = [];
				$investigation_code_arr = [];
				$investigation_price_arr = [];
				$investigation_discount_arr = [];
				foreach($data as $value2){
				    foreach($value2 as $value4){			
						if($value4['female_investigation_name']){
								array_push($investigation_name_arr,$value4['female_investigation_name']);
								array_push($investigation_code_arr,$value4['female_investigation_code']);
							    array_push($investigation_price_arr,$value4['female_investigation_price']);
							    array_push($investigation_discount_arr,$value4['female_investigation_discount']);
						}
					}
				}
				
				$female_investigation_name = implode(',', $investigation_name_arr );
				$female_investigation_code = implode(',', $investigation_code_arr );
				$female_investigation_price = implode(',', $investigation_price_arr );
				$female_investigation_discount = implode(',', $investigation_discount_arr );
				foreach($investigation_name_arr as $_key => $_value){
					$response[] = array(
				        'on_date' => $val['on_date'],
                        'patient_id' => $val['patient_id'],
				        'female_investigation_name'=> $investigation_name_arr[$_key],
						'female_investigation_code' => $investigation_code_arr[$_key],
						'female_investigation_price' => $investigation_price_arr[$_key],
						'female_investigation_discount' => $investigation_discount_arr[$_key],
						'total' => $final_investigation_price_arr[$_key]
			    );
				}
			}
		}      
		return $response;
    } 
	
	function export_male_investigation($start_date, $end_date, $center, $patient_id, $origins){
		$male_investigation_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($origins)){
			$conditions .= ' and origins="'.$origins.'"';
        }
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$male_investigation_sql = "Select DISTINCT patient_id, on_date, investigations, receipt_number from ".$this->config->item('db_prefix')."patient_investigations where status='approved' and 1 $conditions";
        $male_investigation_q = $this->db->query($male_investigation_sql);
        $male_investigation_result = $male_investigation_q->result_array();
        if(!empty($male_investigation_result)){
            foreach($male_investigation_result as $key => $val){
				$_data = unserialize($val['investigations']);
				$investigation_name_arr = [];
				$investigation_code_arr = [];
				$investigation_price_arr = [];
				$investigation_discount_arr = [];
				foreach($_data as $value2){
				    foreach($value2 as $value4){			
						if($value4['male_investigation_name']){
								array_push($investigation_name_arr,$value4['male_investigation_name']);
								array_push($investigation_code_arr,$value4['male_investigation_code']);
							    array_push($investigation_price_arr,$value4['male_investigation_price']);
							    array_push($investigation_discount_arr,$value4['male_investigation_discount']);
						}
					}
				}
				
				$male_investigation_name = implode(',', $investigation_name_arr );
				$male_investigation_code = implode(',', $investigation_code_arr );
				$male_investigation_price = implode(',', $investigation_price_arr );
				$male_investigation_discount = implode(',', $investigation_discount_arr );
				foreach($investigation_name_arr as $_key => $_value){
					$response[] = array(
				        'on_date' => $val['on_date'],
                        'patient_id' => $val['patient_id'],
				        'male_investigation_name'=> $investigation_name_arr[$_key],
						'male_investigation_code' => $investigation_code_arr[$_key],
						'male_investigation_price' => $investigation_price_arr[$_key],
						'male_investigation_discount' => $investigation_discount_arr[$_key],
						'total' => $final_investigation_price_arr[$_key]
			    );
				}
			}
		}      
		return $response;
    } 
	
	function patient_consultation_count($center, $start_date, $end_date, $patient_id){
		$consultation_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
        if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$consultation_sql = "Select * from ".$this->config->item('db_prefix')."consultation where 1 ".$conditions."";
		$q = $this->db->query($consultation_sql);
		return $q->num_rows();
	}
	
		function patient_consultation_report_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $status){
		$consultation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($status)){
			$conditions .= " and status='$status'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$consultation_sql = "Select * from ".$this->config->item('db_prefix')."consultation where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$consultation_q = $this->db->query($consultation_sql);
		$consultation_result = $consultation_q->result_array();
		return $consultation_result;
	}
	

	function patient_consultation_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $status){
		$consultation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($status)){
			$conditions .= " and status='$status'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$consultation_sql = "Select * from ".$this->config->item('db_prefix')."consultation where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$consultation_q = $this->db->query($consultation_sql);
		$consultation_result = $consultation_q->result_array();
		return $consultation_result;
	}
	
	function export_consultation_data($start, $end, $center, $status){
		$consultation_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		
	    $consultation_sql = "Select DISTINCT patient_id, receipt_number, totalpackage, fees as discounted_package,payment_done,remaining_amount,payment_method,billing_from,billing_at,on_date as date,status from ".$this->config->item('db_prefix')."consultation where 1 $conditions order by on_date desc";
        $consultation_q = $this->db->query($consultation_sql);
        $consultation_result = $consultation_q->result_array();
        if(!empty($consultation_result)){
            foreach($consultation_result as $key => $val){
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'receipt_number' => $val['receipt_number'],
				        'totalpackage' => $val['totalpackage'],
                        'discounted_package' => $val['discounted_package'],
                        'payment_done' => $val['payment_done'],
                        'remaining_amount' => $val['remaining_amount'],
                        'payment_method' => $val['payment_method'],
                        'billing_from' => $val['billing_from'],
                        'billing_at' => $val['billing_at'],
                        'date' => $val['date'],
                        'status' => $val['status'],
                        'billing_type' => 'Consultation',
                );
            }
        }    
		return $response;
    }
	
		function patient_partialpayments_count($center, $start_date, $end_date, $patient_id, $status, $payment_method){
		$partialpayments_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if (!empty($status)){
			$conditions .= " and status='$status'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$partialpayments_sql = "Select * from ".$this->config->item('db_prefix')."patient_payments where 1 ".$conditions."";
		$q = $this->db->query($partialpayments_sql);
		return $q->num_rows();
		
	}

	function patient_partialpayments_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $status, $payment_method){
		$partialpayments_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($status)){
			$conditions .= " and status='$status'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$partialpayments_sql = "Select * from ".$this->config->item('db_prefix')."patient_payments where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$partialpayments_q = $this->db->query($partialpayments_sql);
		$partialpayments_result = $partialpayments_q->result_array();
		return $partialpayments_result;
	}
	
	function export_partialpayments_data($start, $end, $center, $type, $status){
		$partialpayments_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' and billing_at="'.$center.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
	    $partialpayments_sql = "Select DISTINCT billing_id,patient_id,payment_done,payment_method,billing_from,billing_at,on_date as date,status from ".$this->config->item('db_prefix')."patient_payments $conditions order by on_date desc";
        $partialpayments_q = $this->db->query($partialpayments_sql);
        $partialpayments_result = $partialpayments_q->result_array();
        if(!empty($partialpayments_result)){
            foreach($partialpayments_result as $key => $val){
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'billing_id' => $val['billing_id'],
				         'totalpackage' => '',
                        'discounted_package' => '',
                        'payment_done' => $val['payment_done'],
                        'remaining_amount' => '',
                        'payment_method' => $val['payment_method'],
                        'billing_from' => $val['billing_from'],
                        'billing_at' => $val['billing_at'],
                        'date' => $val['date'],
                        'status' => $val['status'],
                        'billing_type' => 'Partial Payment',
                );
            }
        }    
		return $response;
    }
	
	function export_partialpayments_report_data($start, $end, $center, $type, $status){
		$partialpayments_result = $response = array();
        $conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$center = $_SESSION['logged_accountant']['center'];
		}
        if(!empty($center)){
			$conditions .= ' where billing_at="'.$center.'"';
        }
		if(!empty($start) && !empty($end)){
				
			if(empty($conditions)){
				$conditions .= " where on_date between '".$start."' AND '".$end."' ";
			}else{
				$conditions .= " and on_date between '".$start."' AND '".$end."' ";
			}
		}
		
	    $partialpayments_sql = "Select DISTINCT billing_id,refrence_number,patient_id,payment_done,payment_method,billing_from,billing_at,type,on_date as date,status from ".$this->config->item('db_prefix')."patient_payments $conditions order by on_date desc";
        $partialpayments_r = $this->db->query($partialpayments_sql);
        $partialpayments_result = $partialpayments_r->result_array();
        if(!empty($partialpayments_result)){
            foreach($partialpayments_result as $key => $val){
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'billing_id' => $val['billing_id'],
						'refrence_number' => $val['refrence_number'],
				        'payment_done' => $val['payment_done'],
                        'payment_method' => $val['payment_method'],
                        'billing_from' => $val['billing_from'],
                        'billing_at' => $val['billing_at'],
						'type' => $val['type'],
                        'date' => $val['date'],
                        'billing_type' => 'Partial Payment',
                );
            }
        }    
		return $response;
    }
	
	function procedure_billing_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}
	
		function investigation_billing_list_patination($limit, $page, $center, $start_date, $end_date, $patient_id){
		$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			//$conditions .= " and on_date >='$start_date' and  on_date <= '$end_date'";
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	}
	
			/***************Medicine Stock Account panel***************/
	
	function export_allmedicie_data($employee_number, $start_date, $end_date, $patient_id){

		$investigation_result = $response = array();
        $conditions = '';
		if(!empty($employee_number)){
			$conditions .= ' and employee_number="'.$employee_number.'"';
        }
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		
	    $investigation_sql = "Select DISTINCT patient_id, receipt_number, discount_amount, payment_done, data, payment_method, cash_payment,card_payment,upi_payment,neft_payment, billing_at, employee_number, on_date as date, status from ".$this->config->item('db_prefix')."patient_medicine where 1 $conditions order by on_date desc";
        $investigation_q = $this->db->query($investigation_sql);
        $investigation_result = $investigation_q->result_array();
        if(!empty($investigation_result)){
            foreach($investigation_result as $key => $val){
				$patient_name = $this->get_patient_name($val['patient_id']);
				$patient_name1 = strtoupper($patient_name);
                $response[] = array(
                        'patient_id' => $val['patient_id'],
                        'wife_name' => $patient_name1,
						'receipt_number' => $val['receipt_number'],
						'discount_amount' => $val['discount_amount'],
                        'payment_done' => $val['payment_done'],
                        'payment_method' => $val['payment_method'],
                        'cash_payment' => $val['cash_payment'],
						'card_payment' => $val['card_payment'],
						'upi_payment' => $val['upi_payment'],
						'neft_payment' => $val['neft_payment'],
                        'billing_at' => $val['billing_at'],
						'date' => $val['date'],
                        'status' => $val['status'],
                        'billing_type' => 'Medicine',
                );
            }
        }    
		return $response;
    }

	function patient_investigation_count2($employee_number, $start_date, $end_date, $patient_id){
		$investigation_result = array();
		$conditions = '';
		if (!empty($employee_number)){
			$conditions .= " and employee_number='$employee_number'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
        if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
	   $investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where stutus_type='0' AND 1 ".$conditions."";
		$q = $this->db->query($investigation_sql);
		return $q->num_rows();
		
	}
	
		function patient_investigation_list_patination2($limit, $page, $employee_number, $start_date, $end_date, $patient_id){
		$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($employee_number)){
			$conditions .= " and employee_number='$employee_number'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "Select * from ".$this->config->item('db_prefix')."patient_medicine where stutus_type='0' AND 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;
	}
	
		/*******Reports*******/
	
	
	function dashboard_procedure_list_patination($center, $start_date, $end_date){
		$procedure_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
	   $procedure_sql = "SELECT sum(`totalpackage`) as total_package, sum(`fees`) as fees, sum(`discount_amount`) as discount_amount, sum(`payment_done`) as payment_done from ".$this->config->item('db_prefix')."patient_procedure where status='approved' AND 1".$conditions ;

		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}
	
	
	function dashboard_investigation_list_patination($center, $start_date, $end_date){
		$investigation_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$investigation_sql = "SELECT sum(`totalpackage`) as total_package, sum(`fees`) as fees, sum(`discount_amount`) as discount_amount, sum(`payment_done`) as payment_done from ".$this->config->item('db_prefix')."patient_investigations where status='approved' AND 1".$conditions;
		$investigation_q = $this->db->query($investigation_sql);
		$investigation_result = $investigation_q->result_array();
		return $investigation_result;		
	}
	

	function dashboard_consultation_report_patination($center, $start_date, $end_date){
		$consultation_result = array();
		$conditions = '';
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$consultation_sql = "SELECT sum(`totalpackage`) as total_package, sum(`discount_amount`) as discount_amount, sum(`payment_done`) as payment_done from ".$this->config->item('db_prefix')."consultation where status='approved' AND 1".$conditions;
		$consultation_q = $this->db->query($consultation_sql);
		$consultation_result = $consultation_q->result_array();
		return $consultation_result;
	}

	function dashboard_partial_payment($center, $start_date, $end_date){
		$partial_payment = array();
		$conditions = '';
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$partial_sql = "SELECT sum(`payment_done`) as paymentreceive from ".$this->config->item('db_prefix')."patient_payments where type='procedure' AND status='1' AND 1".$conditions;
		$partial_q = $this->db->query($partial_sql);
		$partial_payment = $partial_q->result_array();
		return $partial_payment;
	}
	
	function dashboard_partial_payment_investigation($center, $start_date, $end_date){
		$partial_payment_investigation = array();
		$conditions = '';
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$partial_investi_sql = "SELECT sum(`payment_done`) as paymentinvestigation from ".$this->config->item('db_prefix')."patient_payments where type='investigation' AND status='1' AND 1".$conditions;
		$partial_investi_q = $this->db->query($partial_investi_sql);
		$partial_payment_investigation = $partial_investi_q->result_array();
		return $partial_payment_investigation;
	}
	
	function dashboard_medicine_payment($center, $start_date, $end_date){
		$medicine_payment = array();
		$conditions = '';
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$medicine_sql = "SELECT sum(`payment_done`) as payment_done, sum(`discount_amount`) as discount_amount from ".$this->config->item('db_prefix')."patient_medicine where status='approved' AND stutus_type='0' AND 1".$conditions;
		$medicine_q = $this->db->query($medicine_sql);
		$medicine_payment = $medicine_q->result_array();
		return $medicine_payment;
	}
	
	
 /*********End Reports*********/
	
	function get_employee_list(){
		$result = array();
		$sql_condition = '';
		$sql = "Select * from ".$this->config->item('db_prefix')."employees where other_role='stock_manager' and status='1'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result;
        }
        else
        {
            return $result;
        }
	}
	
	function get_employee_name($employee_number){
		$result = array();
		$sql_condition = '';
		$sql = "Select name from ".$this->config->item('db_prefix')."employees where employee_number='".$employee_number."'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result))
        {
            return $result[0]['name'];
        }
        else
        {
            return $result;
        }
	}
	
	public function update_investigation($data, $ID)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "patient_investigations SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$ID."'";
        $this->db->query($sql);
        return 1;
    }

    function dashboard_appointment_list($center, $start_date, $end_date){
		$appointments_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and appoitmented_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and appoitmented_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and appoitmented_date='$end_date'";
		}
	   $appointments_sql = "SELECT COUNT(ID) as appointmentID  FROM ".$this->config->item('db_prefix')."appointments WHERE paitent_type='new_patient' AND 1".$conditions;

		$appointments_q = $this->db->query($appointments_sql);
		$appointments_result = $appointments_q->result_array();
		return $appointments_result;
	}
	
	/*********Liason**********/
	
	function insert_add_liason($data){
	 $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "liason` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}		
		$sql .= implode(',' , $sqlArr);
		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function liason_count($center, $start_date, $end_date){
		$procedure_result = array();
		$conditions = '';
		if (!empty($center)){
			$conditions .= " and center='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."liason where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		
	}
	
		function liason_patination($limit, $page, $center, $start_date, $end_date){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($center)){
			$conditions .= " and center='$center'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."liason where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}
	
	public function update_liason($data, $ID)
    {			
        $sql = "UPDATE " . config_item('db_prefix') . "liason SET ";
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".$value."'"	;
		}
		$sql .= implode(',' , $sqlArr);
		$sql .= " WHERE ID = '".$ID."'";
        $this->db->query($sql);
        return 1;
    }
	
	/***********End Liason***********/
	
	/*********Document**********/
	
	function insert_add_indiaivf_document($data){
	 $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "document` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'"	;
		}		
		$sql .= implode(',' , $sqlArr);
		
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function indiaivf_document_count($document_name){
		$procedure_result = array();
		$conditions = '';
		if (!empty($document_name)){
			$conditions .= " and document_name='$document_name'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."document where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		
	}
	
		function indiaivf_document_patination($limit, $page, $document_name){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($document_name)){
			$conditions .= " and document_name='$document_name'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."document where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}
	
	/***********End Document***********/
	
	/**************Start Freezing**************/
		function freezing_renewal_count($start_date, $end_date, $iic_id){
		$partialpayments_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
        if (!empty($iic_id)){
			$conditions .= " and iic_id='$iic_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_date='$end_date'";
		}
		$partialpayments_sql = "Select * from freezing where 1 ".$conditions."";
		$q = $this->db->query($partialpayments_sql);
		return $q->num_rows();
		
	}

	function freezing_renewal_list_patination($limit, $page, $start_date, $end_date, $iic_id){
		$partialpayments_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($iic_id)){
			$conditions .= " and iic_id='$iic_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and expiry_date='$start_date'";
			
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and expiry_date='$end_date'";
		}
		$partialpayments_sql = "Select * from freezing where 1".$conditions." order by expiry_date desc limit ". $limit." OFFSET ".$offset."";
		$partialpayments_q = $this->db->query($partialpayments_sql);
		$partialpayments_result = $partialpayments_q->result_array();
		return $partialpayments_result;
	}
	/********End Freezing********/
	
	/******** Clinical Reports *******/
    function clinical_reports_count($center, $year, $end_date, $patient_id, $payment_method){
		$procedure_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_doctor']['center']) && !empty($_SESSION['logged_doctor']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_doctor']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and center='$center'";
		}
		if(!empty($year)){
			$conditions .= ' and year="'.$year.'"';
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		$sql2 ="SELECT * FROM `hms_doctors` WHERE name='".$_SESSION['logged_doctor']['name']."'";
        $query = $this->db->query($sql2);
        $select_result2 = $query->result();
		foreach($select_result2 as $ky => $vl){ 
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."clinical_reports where center='$vl->center_id' AND 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		}
		$sql4 ="SELECT * FROM `hms_employees` WHERE name='".$_SESSION['logged_embryologist']['name']."'";
        $query = $this->db->query($sql4);
        $select_result4 = $query->result();
		foreach($select_result4 as $ky => $vl2){ 
		$procedure_sql4 = "Select * from ".$this->config->item('db_prefix')."clinical_reports where center='$vl->center_id' AND 1 ".$conditions."";
		$q = $this->db->query($procedure_sql4);
		return $q->num_rows();
		 }
		if($_SESSION['logged_administrator']){
		 $procedure_sql = "Select * from ".$this->config->item('db_prefix')."clinical_reports where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		 }
	}
	
	function clinical_reports_patination($limit, $page, $center, $year, $end_date, $patient_id, $payment_method){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_doctor']['center']) && !empty($_SESSION['logged_doctor']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_doctor']['center'].'"'; 
		}

		if (!empty($center)){
			$conditions .= " and center='$center'";
		}
		if(!empty($year)){
			$conditions .= ' and year="'.$year.'"';
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		$sql2 ="SELECT * FROM `hms_doctors` WHERE name='".$_SESSION['logged_doctor']['name']."'";
        $query = $this->db->query($sql2);
        $select_result2 = $query->result();
		foreach($select_result2 as $ky => $vl){ 
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."clinical_reports where center='$vl->center_id' AND 1".$conditions." order by year desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
		}
		
		$sql3 ="SELECT * FROM `hms_employees` WHERE name='".$_SESSION['logged_embryologist']['name']."'";
        $query = $this->db->query($sql3);
        $select_result3 = $query->result();
		foreach($select_result3 as $ky => $vl2){ 
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."clinical_reports where center='$vl2->center_id' AND 1".$conditions." order by year desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
		}
		if($_SESSION['logged_administrator']){
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."clinical_reports where 1".$conditions." order by year desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
		}
	}
	
	function patient_procedure_origin_count($center, $start_date, $end_date, $patient_id, $patient_procedures, $json_data){
		$procedure_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if(!empty($patient_procedures)){
			$conditions .= " and data like '%$patient_procedures%'";
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		else if(!empty($json_data)){
			$conditions .= " and data like '%$json_data%'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
	}
	
	function patient_procedure_origin_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $patient_procedures, $json_data){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($patient_procedures)){
			$conditions .= " and data like '%$patient_procedures%'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		else if(!empty($json_data)){
			$conditions .= " and data like '%$json_data%'";
		}
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}
	
	/************Investigation*********/
	
	function patient_investigation_origin_count($center, $start_date, $end_date, $patient_id, $patient_procedures, $json_data){
		$investigation_result = array();
		$conditions = '';
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($payment_method)){
			$conditions .= ' and payment_method="'.$payment_method.'"';
        }
		if(!empty($patient_procedures)){
			$conditions .= " and investigations like '%$patient_procedures%'";
        }
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		else if(!empty($json_data)){
			$conditions .= " and investigations like '%$json_data%'";
		}
		$investigation_r_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where 1 ".$conditions."";
		$q = $this->db->query($investigation_r_sql);
		return $q->num_rows();
	}
	
	function patient_investigation_origin_patination($limit, $page, $center, $start_date, $end_date, $patient_id, $patient_procedures, $json_data){
		$investigation_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if(isset($_SESSION['logged_accountant']['center']) && !empty($_SESSION['logged_accountant']['center'])){ 
			$conditions = ' and billing_at="'.$_SESSION['logged_accountant']['center'].'"'; 
		}
		if (!empty($center)){
			$conditions .= " and billing_at='$center'";
		}
		if(!empty($patient_procedures)){
			$conditions .= " and investigations like '%$patient_procedures%'";
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if (!empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date between '".$start_date."' AND '".$end_date."' ";
		}
		else if (!empty($start_date) && empty($end_date)){
			$conditions .= " and on_date='$start_date'";
		}
		else if (empty($start_date) && !empty($end_date)){
			$conditions .= " and on_date='$end_date'";
		}
		else if(!empty($json_data)){
			$conditions .= " and investigations like '%$json_data%'";
		}
		$investigation_r_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where 1".$conditions." order by on_date desc limit ". $limit." OFFSET ".$offset."";
		$investigation_r_q = $this->db->query($investigation_r_sql);
		$investigation_result = $investigation_r_q->result_array();
		return $investigation_result;
	}
	
	/********End Clinical Reports********/
	
	/************Admission Form*********/
	
	function admission_form_count($iic_id){
		$admission_result = array();
		$conditions = '';
		if (!empty($iic_id)){
			$conditions .= " and iic_id='$iic_id'";
		}
		$investigation_r_sql = "Select * from admission_form where 1 ".$conditions."";
		$q = $this->db->query($investigation_r_sql);
		return $q->num_rows();
	}
	
	function admission_form_patination($limit, $page, $iic_id){
		$admission_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($iic_id)){
			$conditions .= " and iic_id='$iic_id'";
		}
		$investigation_r_sql = "Select * from admission_form where 1".$conditions." order by id desc limit ". $limit." OFFSET ".$offset."";
		$investigation_r_q = $this->db->query($investigation_r_sql);
		$admission_result = $investigation_r_q->result_array();
		return $admission_result;
	}
	
	function export_return_medicine($start_date, $end_date, $employee_number, $patient_id){
		$investigation_result = $response = array();
        $conditions = '';
		if(!empty($employee_number)){
			$conditions .= ' and employee_number="'.$employee_number.'"';
        }
		if(!empty($start) && !empty($end)){
            $conditions .= " and on_date between '".$start."' AND '".$end."' ";
        }
		echo $cash_medicine_sql = "Select DISTINCT patient_id, patient_detail_name, on_date, return_medicine, receipt_number, hospital_id, payment_method, employee_number, status from ".$this->config->item('db_prefix')."patient_medicine where 1 $conditions";
        $cash_medicine_q = $this->db->query($cash_medicine_sql);
        $cash_medicine_result = $cash_medicine_q->result_array();
        if(!empty($cash_medicine_result)){
            foreach($cash_medicine_result as $key => $val){
				$_data = unserialize($val['return_medicine']);
				$consumables_name_arr_r = [];
				$consumables_item_name_arr_r = [];
				$consumables_stock_arr_r = [];
				$consumables_quantity_arr_r = [];
				$consumables_price_arr_r = [];
				$consumables_vendor_price_arr_r = [];
				$consumables_discount_arr_r = [];
				$consumables_total_arr_r = [];
				$consumables_batch_number_arr_r = [];
				$consumables_hsn_arr_r = [];
				$consumables_gstrate_arr_r = [];
				$consumables_mrp_arr_r = [];
				foreach($_data as $value1){
					foreach($value1 as $value2){
						foreach($value2 as $value3){
							if($value3['consumables_name']){}
							array_push($consumables_name_arr_r,$value3['consumables_name']);
							array_push($consumables_item_name_arr_r,$value3['consumables_item_name']);
							array_push($consumables_stock_arr_r,$value3['consumables_stock']);
							array_push($consumables_quantity_arr_r,$value3['consumables_quantity']);
							array_push($consumables_price_arr_r,$value3['consumables_price']);
							array_push($consumables_vendor_price_arr_r,$value3['consumables_vendor_price']);
							array_push($consumables_discount_arr_r,$value3['consumables_discount_']);
							array_push($consumables_total_arr_r,$value3['consumables_total_']);
							array_push($consumables_batch_number_arr_r,$value3['consumables_batch_number']);
							array_push($consumables_hsn_arr_r,$value3['consumables_hsn']);
							array_push($consumables_gstrate_arr_r,$value3['consumables_gstrate']);
							array_push($consumables_mrp_arr_r,$value3['consumables_mrp']);
						}
					}
				}
				
				$consumables_name = implode(',', $consumables_name_arr_r );
				$consumables_item_name = implode(',', $consumables_item_name_arr_r );
				$consumables_stock = implode(',', $consumables_stock_arr_r );
				$consumables_quantity = implode(',', $consumables_quantity_arr_r );
				$consumables_price = implode(',', $consumables_price_arr_r );
				$consumables_vendor_price = implode(',', $consumables_vendor_price_arr_r );
				$consumables_discount_ = implode(',', $consumables_discount_arr_r );
				$consumables_total_ = implode(',', $consumables_total_arr_r );
				$consumables_batch_number = implode(',', $consumables_batch_number_arr_r );
				$consumables_hsn = implode(',', $consumables_hsn_arr_r );
				$consumables_gstrate = implode(',', $consumables_gstrate_arr_r );
				$consumables_mrp = implode(',', $consumables_mrp_arr_r );
				if($consumables_name  != ''){
				 $consumables_name_sql2 = "SELECT item_name FROM hms_stocks WHERE item_number IN (".$consumables_name.") " ;
				}
				$_consumables_name_arr_r = [];
				
				$consumables_name_sql_qr = $this->db->query($consumables_name_sql2);
				$consumables_name_sql_qr_result = $consumables_name_sql_qr->result_array();
				if(!empty($consumables_name_sql_qr_result)){
					foreach($consumables_name_sql_qr_result as $key => $consumables_name_val2){
						array_push($_consumables_name_arr_r,$consumables_name_val2['item_name']);
					}
				}
				
				$final_consumables_arr_r =[];
				
				foreach($_consumables_name_arr_r as $_key => $_value){
					$final_consumables123 = $_value;
					array_push($final_consumables123);
					$response[] = array(
				        'on_date' => $val['on_date'],
                        'patient_id' => $val['patient_id'],
				        'patient_detail_name' => $val['patient_detail_name'],
						'hospital_id' => $val['hospital_id'],
						'receipt_number' => $val['receipt_number'],
                        'payment_method' => $val['payment_method'],
                        'consumables_name'=> $consumables_name_arr_r[$_key],
						'consumables_item_name'=> $consumables_item_name_arr_r[$_key],
						'consumables_stock'=> $consumables_stock_arr_r[$_key],
						'consumables_quantity' => $consumables_quantity_arr_r[$_key],
						'consumables_price' => $consumables_price_arr_r[$_key],
						'consumables_vendor_price' => $consumables_vendor_price_arr_r[$_key],
						'consumables_discount_' => $consumables_discount_arr_r[$_key],
						'consumables_total_' => $consumables_total_arr_r[$_key],
						'employee_number' => $val['employee_number'],
						'status' => $val['status'],
						'consumables_batch_number' => $consumables_batch_number_arr_r[$_key],
						'consumables_hsn' => $consumables_hsn_arr_r[$_key],
						'consumables_gstrate' => $consumables_gstrate_arr_r[$_key], 
						'consumables_mrp' => $consumables_mrp_arr_r[$_key]
                );
				}
			}
        }      
		return $response;
    }
	
	/********End Admission Form********/
	
	function partial_procedure_insert($data){
		echo $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "patient_payments` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'";
		}
		$sql .= implode(',' , $sqlArr);
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	function donor_insert($data){
		echo $sql = "INSERT INTO `" . $this->config->item('db_prefix') . "donor` SET ";
		$sqlArr = array();
		foreach( $data as $key=> $value )
		{
			$sqlArr[] = " $key = '".addslashes($value)."'";
		}
		$sql .= implode(',' , $sqlArr);
       	$res =  $this->db->query($sql);
		if ($res)
		{
			return $this->db->insert_id();
		}
		else
			return 0;
	}
	
	
	function get_paitent_id(){
		$result = array();
		$sql_condition = '';
	    $sql = "Select DISTINCT paitent_id, wife_name from ".$this->config->item('db_prefix')."appointments where paitent_type='exist_patient'";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result)){
            return $result;
        }else{
            return $result;
        }
	}
	
	function get_uhid(){
		$result = array();
		$sql_condition = '';
	    $sql = "Select DISTINCT uhid from ".$this->config->item('db_prefix')."appointments";
        $q = $this->db->query($sql);
        $result = $q->result_array();
        if (!empty($result)){
            return $result;
        }else{
            return $result;
        }
	}
	
	function donor_count($patient_id, $donor_patient_id){
		$procedure_result = array();
		$conditions = '';
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if(!empty($donor_patient_id)){
			$conditions .= " and donor_patient_id='$donor_patient_id'";
        }
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."donor where 1 ".$conditions."";
		$q = $this->db->query($procedure_sql);
		return $q->num_rows();
		
	}
	
	function donor_patination($limit, $page, $patient_id, $donor_patient_id){
		$procedure_result = array();
		$conditions = '';
		if(empty($page)){
			$offset = 0;
		}else{
			$offset = ($page - 1) * $limit;
		}
		if (!empty($patient_id)){
			$conditions .= " and patient_id='$patient_id'";
		}
		if(!empty($donor_patient_id)){
			$conditions .= " and donor_patient_id='$donor_patient_id'";
        }
		$procedure_sql = "Select * from ".$this->config->item('db_prefix')."donor where 1".$conditions." order by date desc limit ". $limit." OFFSET ".$offset."";
		$procedure_q = $this->db->query($procedure_sql);
		$procedure_result = $procedure_q->result_array();
		return $procedure_result;
	}
}