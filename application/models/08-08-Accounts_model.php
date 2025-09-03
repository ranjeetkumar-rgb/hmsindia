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
			
			$investigate_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where patient_id='".$patient_id."'";
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
		
		$consultation_sql = "Select * from ".$this->config->item('db_prefix')."consultation where patient_id='".$patient_id."'";
        $consultation_q = $this->db->query($consultation_sql);
        $consultation_result = $consultation_q->result_array();
		if (!empty($consultation_result))
        {
            $consultation['data'] =  $consultation_result;
			$consultation['type'] = 'consultation';
        }		
		
		$investigate_sql = "Select * from ".$this->config->item('db_prefix')."patient_investigations where patient_id='".$patient_id."'";
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
	
	function approve_billing($request, $type, $status, $reason){
		$result = array();
		if($type == 'consultation'){			
			$sql = "UPDATE `".$this->config->item('db_prefix')."consultation` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE ID='".$request."'";
		}else if($type == 'investigation'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_investigations` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE ID='".$request."'";
		}else if($type == 'procedure'){
			$sql = "UPDATE `".$this->config->item('db_prefix')."patient_procedure` SET `status`='$status',`reason_of_disapprove`='$reason' WHERE ID='".$request."'";
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
					$status = 1;
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
	
	function patient_discharge($patient_id){
	    $this->db->from('hms_discharge_forms');
        $this->db->where('status', 'active');
        $sel = $this->db->get();
        $res = $sel->result_array();
        
        $res_arr = array();
	    foreach($res as $rs){
	        $sql = "SELECT id, iic_id, updated_by, updated_at, updated_type FROM `".$rs['db_name']."` WHERE iic_id='".$patient_id."'";
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
	
}