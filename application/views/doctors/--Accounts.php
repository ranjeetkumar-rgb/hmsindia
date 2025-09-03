<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
	public function __construct()
	{

		// Load parent's constructor.

       	parent::__construct();

		$this->load->database();

		$this->load->helper('form');

        $this->load->helper('url_helper');

	    $this->load->library('session');

		$this->load->model('accounts_model');

		$this->load->model(array('billings_model', 'center_model'));

		$this->load->model('stock_model');

		$this->load->helper('myhelper');

	}	
	
		function htmltopdf(){
        	$formname = $_POST['formname'];
            $paitent_id = $_POST['iic_id'];
            $paitent_html = $_POST['html'];
            
            $dest_path = $this->config->item('upload_path');
            $destination = $dest_path.'whatsapp-pdf/';
            $NewImageName = $formname."-".$paitent_id;
            
            require_once $dest_path. '/mpdf/vendor/autoload.php';
            $filename= $dest_path."whatsapp-pdf/".$NewImageName.".pdf";
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($paitent_html);
            $mpdf->Output($filename,'F');
    		
    		$patient_data = get_patient_detail($paitent_id);
    		if($patient_data['whats_registers'] == 0){
    		    $register_patient = whatsappregister($patient_data['wife_phone']);
    		    if($register_patient > 0){
    		        $this->db->where('patient_id', $paitent_id);
    		        $this->db->update('hms_patients', array('whats_registers' => 1));
    		    }
    		}
    		$sendprep = whatsappfileprep($patient_data['wife_phone'], $filename);
    	    if($sendprep > 0){
    	        echo json_encode(array('status' => 1));
    	        die;
    	    }else{
    	        echo json_encode(array('status' => 0));
    	        die;
    	    }	
        }
        
    function billhtmltopdf(){
            $paitent_id = $_POST['iic_id'];
            $paitent_html = $_POST['html'];
            
            $dest_path = $this->config->item('upload_path');
            $destination = $dest_path.'whatsapp-pdf/';
            $NewImageName = "Billing-".$paitent_id;
            
            require_once $dest_path. '/mpdf/vendor/autoload.php';
            $filename= $dest_path."whatsapp-pdf/".$NewImageName.".pdf";
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($paitent_html);
            $mpdf->Output($filename,'F');
    		
    		$patient_data = get_patient_detail($paitent_id);
    		if($patient_data['whats_registers'] == 0){
    		    $register_patient = whatsappregister($patient_data['wife_phone']);
    		    if($register_patient > 0){
    		        $this->db->where('patient_id', $paitent_id);
    		        $this->db->update('hms_patients', array('whats_registers' => 1));
    		    }
    		}
    		$sendprep = whatsappfileprep($patient_data['wife_phone'], "https://www.indiaivf.in/wp-content/uploads/2018/10/Franchise-Application-Form.pdf", 'Billing Receipt', 'india_ivf_bill_sent');
    	    if($sendprep > 0){
    	        echo json_encode(array('status' => 1));
    	        die;
    	    }else{
    	        echo json_encode(array('status' => 0));
    	        die;
    	    }	
        }
        
    function prephtmltopdf(){
        $paitent_id = $_POST['iic_id'];
        $paitent_html = $_POST['html'];
        
        $dest_path = $this->config->item('upload_path');
        $destination = $dest_path.'whatsapp-pdf/';
        $NewImageName = "Billing-".$paitent_id;
        
        require_once $dest_path. '/mpdf/vendor/autoload.php';
        $filename= $dest_path."whatsapp-pdf/".$NewImageName.".pdf";
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($paitent_html);
        $mpdf->Output($filename,'F');
		
		$patient_data = get_patient_detail($paitent_id);
    
		if($patient_data['whats_registers'] == 0){
		    $register_patient = whatsappregister($patient_data['wife_phone']);
		    if($register_patient > 0){
		        $this->db->where('patient_id', $paitent_id);
		        $this->db->update('hms_patients', array('whats_registers' => 1));
		    }else{
		        echo json_encode(array('status' => 0, 'message' => $register_patient['message']));
	            die;
		    }
		}
		$sendprep = whatsappfileprep($patient_data['wife_phone'], $filename, 'Prescription');
	    if($sendprep > 0){
	        echo json_encode(array('status' => 1, 'message' => "Prescription has been sent!"));
	        die;
	    }else{
	        echo json_encode(array('status' => 0, 'message' => $sendprep['message']));
	        die;
	    }	
    }

	

	public function accounts()
	{
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$template = get_header_template($logg['role']);
			$this->load->view($template['header']);
			$this->load->view('accounts/accounts');
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function get_patient_data(){
		$search_this = $_POST['data']['search_this'];
		$search_by = $_POST['data']['search_by'];
		if($search_this == ''){
			$response = array();
			$response = array('status' => 0, 'data'=> 'Phone number/IIC ID is required');
			echo json_encode($response);
			die;	
		}
		$consultation_result = $investigate_result = $procedure_result = $patient_result = array();		
		
	$data = $this->accounts_model->get_patient_data_by($search_this, $search_by);
	if(!empty($data)){
		$patient_id = $data['patient_result']['patient_id'];
		$patient_data = get_patient_detail($patient_id);
		$currency = '';
	
		$consultation_result = $data['consultation_result'];
		$investigate_result = $data['investigate_result'];
		$procedure_result = $data['procedure_result'];
		$patient_result = $data['patient_result'];
		$payments = $data['payments'];	

		$response = array();
		if (!empty($patient_result))
        {
			$html = $payment_html = '';		
			if(count($consultation_result) > 0){
				$type = $consultation_result['type'];
				foreach($consultation_result['data'] as $key => $val){
					$html .= '<tr>';
					$html .= '<td><a class="btn btn-large" href="'.base_url().'accounts/details/'.$val['receipt_number'].'?t=consultation">'.$val['receipt_number'].'</a></td>';
					//$html .= '<td>'.$val['receipt_number'].'</td>';
					$html .= '<td>'.dateformat($val['on_date']).'</td>';
					$html .= '<td>'.$this->get_center_name($val['billing_at']).'</td>';
					if($val['billing_from'] == 'IndiaIVF'){ $html .= '<td>'.$val['billing_from'].'</td>'; }
					else{$html .= '<td>'.$this->get_center_name($val['billing_from']).'</td>';}		
					$html .= '<td>'.$currency.$val['totalpackage'].'</td>';
					$html .= '<td>'.$currency.$val['fees'].'</td>';
					$html .= '<td>'.$currency.$val['payment_done'].'</td>';
					$html .= '<td>'.$currency.$val['remaining_amount'].'</td>';
					$html .= '<td>Consultation</td>';
					$html .= '<td>'.ucwords($val['status']).'</td>';
					$html .= '</tr>';
				}
			}		

			if(count($investigate_result) > 0){
				$type = $investigate_result['type'];
				foreach($investigate_result['data'] as $key => $val){
					$html .= '<tr>';
					$html .= '<td><a class="btn btn-large" href="'.base_url().'accounts/details/'.$val['receipt_number'].'?t=investigation">'.$val['receipt_number'].'</a></td>';
					$html .= '<td>'.dateformat($val['on_date']).'</td>';
					$html .= '<td>'.$this->get_center_name($val['billing_at']).'</td>';
					if($val['billing_from'] == 'IndiaIVF'){ $html .= '<td>'.$val['billing_from'].'</td>'; }
					else{$html .= '<td>'.$this->get_center_name($val['billing_from']).'</td>';}							
					$html .= '<td>'.$currency.$val['totalpackage'].'</td>';
					$html .= '<td>'.$currency.$val['fees'].'</td>';
					$html .= '<td>'.$currency.$val['payment_done'].'</td>';
					$html .= '<td>'.$currency.$val['remaining_amount'].'</td>';
					$html .= '<td>Investigation</td>';
					$html .= '<td>'.ucwords($val['status']).'</td>';
					$html .= '</tr>';
				}
			}

			if(count($procedure_result) > 0){
				$type = $procedure_result['type'];
				foreach($procedure_result['data'] as $key => $val){
					$html .= '<tr>';
					$html .= '<td><a class="btn btn-large" href="'.base_url().'accounts/details/'.$val['receipt_number'].'?t=procedure">'.$val['receipt_number'].'</a></td>';
					$html .= '<td>'.dateformat($val['on_date']).'</td>';
					$html .= '<td>'.$this->get_center_name($val['billing_at']).'</td>';
					if($val['billing_from'] == 'IndiaIVF'){ $html .= '<td>'.$val['billing_from'].'</td>'; }
					else{$html .= '<td>'.$this->get_center_name($val['billing_from']).'</td>';}							
					$html .= '<td>'.$currency.$val['totalpackage'].'</td>';
					$html .= '<td>'.$currency.$val['fees'].'</td>';
					$html .= '<td>'.$currency.$val['payment_done'].'</td>';
					$html .= '<td>'.$currency.$val['remaining_amount'].'</td>';
					$html .= '<td>Procedure</td>';
					$html .= '<td>'.ucwords($val['status']).'</td>';
					$html .= '</tr>';
				}
			}

			if(count($payments) > 0){
				$type = $payments['type'];
				foreach($payments['data'] as $key => $val){ //var_dump($val);die;
					$payment_html .= '<tr>';
					$payment_html .= '<td><a target="_blank" class="btn btn-large" href="'.base_url().'accounts/details/'.$val['billing_id'].'?t='.$val['type'].'">'.$val['billing_id'].'</a></td>';
					$payment_html .= '<td><a target="_blank" href="'.base_url().'partial-payment-receipt/'.$val['refrence_number'].'">'.$val['refrence_number'].'</a></td>';
					$payment_html .= '<td><a target="_blank" href="'.base_url().'accounts/patient_details/'.$patient_id.'">'.$patient_id.'</a></td>';
					$payment_html .= '<td>'.$patient_data['wife_name'].'</td>';
					$payment_html .= '<td>'.$this->get_center_name($val['billing_at']).'</td>';
					if($val['billing_from'] == 'IndiaIVF'){ $payment_html .= '<td>'.$val['billing_from'].'</td>'; }
					else{$payment_html .= '<td>'.$this->get_center_name($val['billing_from']).'</td>';}							
					$payment_html .= '<td>'.$currency.$val['payment_done'].'</td>';
					$payment_html .= '<td>'.$val['payment_method'].'</td>';
					$payment_html .= '<td>'.$val['transaction_id'];
					if(!empty($val['transaction_img'])){
					  $payment_html .= '(<a href="'.$val['transaction_img'].'" class="hide_print"  target="_blank">Transaction Image</a>) </td>';
					}else{
					    $payment_html .= '</td>';
					}
					
					$payment_html .= '<td>'.$val['on_date'].'</td>';
					if($val['status'] == 1){ $payment_html .= '<td>Approved</td>'; }
					else if($val['status'] == 2){ $payment_html .= '<td>Disapproved</td>'; }
					else{$payment_html .= '<td>Pending</td>';}							
					$payment_html .= '</tr>';
				}
			}
			
			$response = array('data' => $html,'current_balance' => patient_balance($patient_id), 'patient_name'=> $patient_result['wife_name'], 'husband_name'=> $patient_result['husband_name'], 'patient_phone'=> sting_masking($patient_result['wife_phone']), 'payment_html' => $payment_html);
			echo json_encode($response);
			die;
        }else{
			$response = array('data' => 'No record found!', 'patient_name'=> '', 'patient_email'=> '', 'patient_phone'=> '', 'payment_html' => '');
			echo json_encode($response);
			die;
		}
	}else{
		$response = array('data' => 'No record found!', 'patient_name'=> '', 'patient_email'=> '', 'patient_phone'=> '', 'payment_html' => '');
		echo json_encode($response);
		die;
	}

	}

	public function requests(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$template = get_header_template($logg['role']);		
			$data = $this->accounts_model->billings_request_list();
			$data_arr['consultation_result'] = $data['consultation_result'];
			$data_arr['investigate_result'] = $data['investigate_result'];
			$data_arr['procedure_result'] = $data['procedure_result'];			

			$this->load->view($template['header']);
			$this->load->view('accounts/requests', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}	

	public function approve($request = NULL){

		$logg = checklogin();

		if($logg['status'] == true){

			$data = array();

			$type = $_GET['t'];

			$status = $_GET['u'];

			$reason = '';

			if($status == 'disapproved'){

				$reason = $_GET['r'];

			}
			$subject = 'Billing approval status';
			
			if($type == 'consultation'){			
			    $billing_records  = india_ivf_billing($request, "consultation"); 
			    if(!empty($billing_records)){
    			    $patient_id = $billing_records['patient_id'];
    			    $receipt_number = $billing_records['receipt_number'];
			    }
				$data = $this->accounts_model->approve_billing($request, $type, $status, $reason);

			}else if($type == 'investigation'){
                $billing_records  = india_ivf_billing($request, "patient_investigations"); 
			    if(!empty($billing_records)){
    			    $patient_id = $billing_records['patient_id'];
    			    $receipt_number = $billing_records['receipt_number'];
			    }
				$data = $this->accounts_model->approve_billing($request, $type, $status, $reason);

			}else if($type == 'procedure'){
                $billing_records  = india_ivf_billing($request, "patient_procedure"); 
			    if(!empty($billing_records)){
    			    $patient_id = $billing_records['patient_id'];
    			    $receipt_number = $billing_records['receipt_number'];
			    }
				$data = $this->accounts_model->approve_billing($request, $type, $status, $reason);

			}else{
				header("location:" .base_url(). "accounts/requests");
				die();
			}
			if($patient_id !== 0 && $receipt_number !== 0){
			    $patient_details = get_patient_detail($patient_id);
			    if(isset($_SESSION['logged_accountant']) && !empty($_SESSION['logged_accountant'])){
					$mail_msg = 'Hi IndiaIVF, <br/><br/> '.ucwords($type).' billing receipt ('.$receipt_number.') for patient '.$patient_details['wife_name'].' ('.$patient_id.') has been '.$status.'.';
					$account_email = $_SESSION['logged_accountant']['email']; //echo $mail_msg;die;
					$admin_email = $this->accounts_model->get_admin_email();
					$to_email =  $admin_email."|".$account_email;//echo $to_email;die;
					$result = send_mail($to_email, $subject, $mail_msg);
				}
			}
			header("location:" .$_SERVER['HTTP_REFERER']. "?m=".base64_encode('Billing '.$status.' successfully').'&t='.base64_encode('success'));
			die();

		}else{
			header("location:" .base_url(). "");
			die();
		}

	}
	
	public function front_approve($request = NULL){
			$data = array();
			$type = $_GET['t'];
			$status = $_GET['u'];
			$reason = '';
			if($status == 'disapproved'){
				$reason = $_GET['r'];
			}
			if($type == 'consultation'){			
			    $billing_records  = india_ivf_billing($request, "consultation"); 
			    if(!empty($billing_records)){
    			    $patient_id = $billing_records['patient_id'];
    			    $receipt_number = $billing_records['receipt_number'];
			    }
				$data = $this->accounts_model->approve_billing($request, $type, $status, $reason);
			}else if($type == 'investigation'){
                $billing_records  = india_ivf_billing($request, "patient_investigations"); 
			    if(!empty($billing_records)){
    			    $patient_id = $billing_records['patient_id'];
    			    $receipt_number = $billing_records['receipt_number'];
			    }
				$data = $this->accounts_model->approve_billing($request, $type, $status, $reason);
			}else if($type == 'procedure'){
                $billing_records  = india_ivf_billing($request, "patient_procedure"); 
			    if(!empty($billing_records)){
    			    $patient_id = $billing_records['patient_id'];
    			    $receipt_number = $billing_records['receipt_number'];
			    }
				$data = $this->accounts_model->approve_billing($request, $type, $status, $reason);
			}else{
				header("location:" .base_url(). "discount-approval?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));
				die();
			}
			header("location:" .base_url(). "discount-approval?m=".base64_encode('Billing '.$status.' successfully').'&t='.base64_encode('success'));
			die();
	}

	function ajax_center_patient_ledger(){
		$center = $_SESSION['logged_accountant']['center'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$data = $this->accounts_model->ajax_center_patient_ledger_data($start, $end, $center);
		echo json_encode($data);
		die;
	}	

	function download_ledger(){
		$center = $_SESSION['logged_accountant']['center'];
		$start = isset($_GET['start'])?$_GET['start']:"";
		$end = isset($_GET['end'])?$_GET['end']:"";

		$data = $this->accounts_model->download_center_patient_ledger_data($start, $end, $center);

		//ob_clean();		
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=patient-ledger-'.$start.'-'.$end.'.csv');
		$fp = fopen('php://output','w');
		$headers = 'IIC ID, Name of Patient, Discounted Package, Received Amount, IIC Share, Centre Share, Amount Recevied at IIC, Amount Received at Centre';
		//Add the headers
		fwrite($fp, $headers. "\r\n");
		foreach ($data as $key => $val) {
			fputcsv($fp, $val);
		}    
		//close file
		fclose($fp);
		exit();
	}

	public function accepted(){

		$logg = checklogin();

		if($logg['status'] == true){		

			$data = array();

			$template = get_header_template($logg['role']);

			$data = $this->accounts_model->accept_billing();

			$this->load->view($template['header']);

			$this->load->view('accounts/accepted', $data);

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	

	public function center_accepted(){

		$logg = checklogin();

		if($logg['status'] == true){		

			$data = array();

			$template = get_header_template($logg['role']);

			$data = $this->accounts_model->center_accept_billing();

			$this->load->view($template['header']);

			$this->load->view('accounts/center_accepted', $data);

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	

	public function accept($receipt = NULL){

		$logg = checklogin();

		if($logg['status'] == true){

			$data = array();

			$type = $_GET['t'];

			if($type == 'consultation'){			

				$data = $this->accounts_model->update_accept_billing($receipt, $type);

			}else if($type == 'investigation'){

				$data = $this->accounts_model->update_accept_billing($receipt, $type);

			}else if($type == 'procedure'){

				$data = $this->accounts_model->update_accept_billing($receipt, $type);

			}else{

				header("location:" .base_url(). "accounts/accepted");

				die();

			}

			header("location:" .base_url(). "accounts/accepted?m=".base64_encode('Billing accepted successfully').'&t='.base64_encode('success'));

			die();

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	

	//Admin Reconcilation

	public function reconciliation(){

		$logg = checklogin();

		if($logg['status'] == true){		

			$data = array();

			$template = get_header_template($logg['role']);

			$data['data'] = $this->accounts_model->reconciliation();

			$this->load->view($template['header']);

			$this->load->view('accounts/reconciliation', $data);

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	//Center Reconcilation

	public function center_reconciliation(){

		$logg = checklogin();

		if($logg['status'] == true){		

			$data = array();

			$template = get_header_template($logg['role']);

			$data['data'] = $this->accounts_model->center_reconciliation();

			$this->load->view($template['header']);

			$this->load->view('accounts/center_reconciliation', $data);

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	//Patient Reconcilation

	public function patient_reconcile($receipt){

		$logg = checklogin();

		if($logg['status'] == true){		

			$data = array();

			if(!isset($_GET['t']) && empty($_GET['t'])){

				header("location:" .base_url(). "accounts/requests?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));

				die();

			}

			

			if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'update_patient_reconcile'){

				unset($_POST['action']);

				$receipt_number =  $_POST['receipt_number'];

				$type =  $_POST['type'];

				$payment_done =  $_POST['payment_done'];				

				$patient_reconcile = $this->accounts_model->update_patient_reconcile($receipt, $type, $payment_done);	

				if($patient_reconcile > 0){

					header("location:" .base_url(). "accounts/requests?m=".base64_encode('Reconciled successfully').'&t='.base64_encode('success'));

					die();

				}else{

					header("location:" .base_url(). "accounts/requests?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));

					die();

				}				

			}

			

			$type = $_GET['t'];

			$template = get_header_template($logg['role']);

			$data['billing_data'] = $this->billings_model->get_billings_details($receipt, $type);

			$patient = $data['billing_data']['patient_id'];

			$data['patient_data'] = $this->accounts_model->patient_details($patient);

			$this->load->view($template['header']);

			$this->load->view('accounts/patient_reconcile', $data);

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	

	public function patient_ledger(){

		$logg = checklogin();

		if($logg['status'] == true){		

			$data = array();

			$template = get_header_template($logg['role']);

			$data['data'] = $this->accounts_model->patient_ledger();

			$this->load->view($template['header']);

			$this->load->view('accounts/patient_ledger', $data);

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	

	public function ajax_patient_ledger(){ 

		if($_POST['type'] == 'month_wise'){

			$month = $_POST['month'];

			$data = $this->accounts_model->ajax_patient_month_ledger($month);

		}

		if($_POST['type'] == 'custom_wise'){

			$start = $_POST['start'];

			$end = $_POST['end'];

			$data = $this->accounts_model->ajax_patient_custom_ledger($start, $end);

		}

		echo json_encode($data);

		die;

	}

	

	public function patient_details($patient_id){
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$template = get_header_template($logg['role']);
			$data['data'] = $this->accounts_model->patient_details($patient_id);
			$data['form_data'] = $this->accounts_model->get_discharge_form_data();
			$data['investigation_reports'] = $this->accounts_model->investigation_reports($patient_id);
			$data['procedure_reports'] = $this->accounts_model->procedure_reports($patient_id);
			$data['patient_discharge'] = $this->accounts_model->patient_discharge($patient_id);
			$this->load->view($template['header']);
			$this->load->view('accounts/patient_details', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function center_patient_ledger(){
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$template = get_header_template($logg['role']);
			$data['data'] = $this->accounts_model->center_patient_ledger();
			$this->load->view($template['header']);
			$this->load->view('accounts/center_patient_ledger', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function patient_payments($patient_id){
		$logg = checklogin();
		if($logg['status'] == true){		
			$data = array();
			$template = get_header_template($logg['role']);
			$data['data'] = $this->accounts_model->patient_payments($patient_id);
			$this->load->view($template['header']);
			$this->load->view('accounts/patient_payments', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url(). "");
			die();
		}
	}

	public function partial_payments(){

		$logg = checklogin();

		if($logg['status'] == true){		

			$data = array();

			$template = get_header_template($logg['role']);

			$data['data'] = $this->accounts_model->partial_payments();

			$this->load->view($template['header']);

			$this->load->view('accounts/partial_payments', $data);

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	

	function approve_payment($id){

		$payment = $this->accounts_model->approve_payment($id);

		if($payment > 0){

			header("location:" .base_url(). "accounts/partial_payments?m=".base64_encode('Payment approved').'&t='.base64_encode('success'));

			die();

		}else{

			header("location:" .base_url(). "accounts/partial_payments?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));

			die();

		}

	}

	

	function disapprove_payment($id){
		$disapprove_reason = isset($_GET['t'])?$_GET['t']:"";
		$payment = $this->accounts_model->disapprove_payment($id, $disapprove_reason);
		if($payment > 0){
			header("location:" .base_url(). "accounts/partial_payments?m=".base64_encode('Payment disapproved').'&t='.base64_encode('success'));
			die();
		}else{
			header("location:" .base_url(). "accounts/partial_payments?m=".base64_encode('Something went wrong !').'&t='.base64_encode('error'));
			die();
		}
	}	
	

	function get_current_balance($patient_id){
		$current_balance = $this->accounts_model->get_current_balance($patient_id);
		return $current_balance;
	}

	

	function get_payment_at($patient_id){

		$payment_at = $this->accounts_model->get_payment_at($patient_id);

		return $payment_at;

	}

		

	function update_billing(){

		$billing = $_POST['billing'];

		$type = $_POST['type'];

		$data = $this->accounts_model->update_billing($billing, $type);

		echo json_encode($data);

		die;

	}

	

	function settle($patient_id){

		$logg = checklogin();

		if($logg['status'] == true){	

			$patient = $this->accounts_model->check_patient($patient_id);

			if(count($patient) > 0){

				$data = array();

				$template = get_header_template($logg['role']);

				$data['patient_id'] = $patient_id;

				$this->load->view($template['header']);

				$this->load->view('accounts/settle', $data);

				$this->load->view($template['footer']);

			}else{

				header("location:" .base_url(). "accounts/center_reconciliation?m=".base64_encode('Patient not found!').'&t='.base64_encode('error'));

				die();

			}

		}else{

				header("location:" .base_url(). "");

				die();

		}	

	}

	

	function add_settle(){

		if(isset($_POST['action']) && isset($_POST['action']) && $_POST['action'] == 'add_settle'){

			unset($_POST['action']);

			$_POST['on_date'] = date("Y-m-d H:i:s");

			$_POST['status'] = '1';

			$transaction_img = '';

			if(!empty($_FILES['transaction_img']['tmp_name'])){

				$dest_path = $this->config->item('upload_path');

				$destination = $dest_path.'patient_files/';

				$NewImageName = rand(4,10000)."-".$_POST['patient_id']."-". $_FILES['transaction_img']['name'];

				$transaction_img = base_url().'assets/patient_files/'.$NewImageName;

				move_uploaded_file($_FILES['transaction_img']['tmp_name'], $destination.$NewImageName);

				$_POST['transaction_img'] = $transaction_img;

			}

			//var_dump($_POST);die;

			$settle = $this->accounts_model->insert_settle($_POST);

			if($settle > 0){

				header("location:" .base_url(). "accounts/center_reconciliation?m=".base64_encode('Settled successfully!').'&t='.base64_encode('success'));

				die();

			}else{

				header("location:" .base_url(). "accounts/center_reconciliation?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));

				die();

			}

		}else{

			header("location:" .base_url(). "accounts/center_reconciliation?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));

			die();

		}

	}

	

	function details($receipt){

		$logg = checklogin();

		if($logg['status'] == true){

			$data = array();

			$type = $_GET['t'];

			

			$template = get_header_template($logg['role']);

			$this->load->view($template['header']);

			if($type == 'consultation'){			

				$data['data'] = $this->accounts_model->get_details($receipt, $type);

				$this->load->view('accounts/consultation_details', $data);

			}else if($type == 'investigation'){

				$data['data'] = $this->accounts_model->get_details($receipt, $type);

				$this->load->view('accounts/investigation_details', $data);

			}else if($type == 'procedure'){

				$data['data'] = $this->accounts_model->get_details($receipt, $type);

//				var_dump($data['data']);die;

				$this->load->view('accounts/procedure_details', $data);

			}else{

				header("location:" .base_url(). "dashboard?m=".base64_encode('Something went wrong!').'&t='.base64_encode('error'));

				die();

			}

			if(empty($data['data'])){

				header("location:" .base_url(). "dashboard?m=".base64_encode('Details not found!').'&t='.base64_encode('error'));

				die();

			}

			$this->load->view($template['footer']);

		}else{

			header("location:" .base_url(). "");

			die();

		}

	}

	

	function check_settle($patient_id){

		$settle = $this->accounts_model->check_settle($patient_id);

		return $settle;

	}

	

	function procedure_name($id){

		$name = $this->accounts_model->get_procedure_name($id);

		return $name;

	}

	

	function get_doctor_name($doctor){

		$name = $this->accounts_model->get_doctor_name($doctor);

		return $name;

	}

	

	function get_investigation_name($investig){
		$name = $this->accounts_model->get_investigation_name($investig);
		return $name;
	}
	
	function get_procedure_name($procedure){

		$name = $this->accounts_model->get_procedure_name($procedure);

		return $name;

	}

	

	function get_item_name($item){

		$name = $this->accounts_model->get_item_name($item);

		return $name;

	}

		

	function get_center_name($center){

		$name = $this->accounts_model->get_center_name($center);

		return $name;

	}

	

	function get_center_list($patient_id){

		$name = $this->accounts_model->get_center_list($patient_id);

		return $name;

	}	

	

	function get_patient_name($patient_id){

		$name = $this->billings_model->get_patient_name($patient_id);

		return $name;

	}

	

	function get_patient_items($receipt, $patient_id){

		$lists = $this->stock_model->get_patient_name($receipt, $patient_id);

		return $lists;

	}

	

	public function get_discount_approval(){
		//var_dump($_POST);die;
		$employee = $_POST['accountant'];
		$employee_data = get_employee_detail($employee);
		$discount = $_POST['discount'];
		$receipt_number = $_POST['receipt_number'];
		$patient_id = $_POST['patient_id'];
		$patient_data = get_patient_detail($patient_id);
		$billing_type = $_POST['billing_type'];
		//var_dump($patient_data);die;
		$admin_email = $this->accounts_model->get_admin_email();
		$currency = '';
		$currency = 'Rs.'.$discount;
		$coupon_code = self::coupon_code();
		$date = date('Y-m-d H:i:s');

		$patitnet_detls = "";
		if(!empty($patient_data)){
			$patitnet_detls = $patient_data['wife_name']." (".$patient_data['patient_id'].")";
		}else{
			$patitnet_detls = $patient_id;
		}
		$dscnt_arr = array();
		$dscnt_arr['patient_id'] = $patient_id;
		$dscnt_arr['code'] = $coupon_code;
		$dscnt_arr['amount'] = $discount;
		$dscnt_arr['receipt_number'] = $receipt_number;
		$dscnt_arr['type'] = $billing_type;
		$dscnt_arr['date'] = $date;
		$dscnt_arr['biller'] = $employee;
		$billing_discount = $this->accounts_model->billing_discount($dscnt_arr, $patient_id, $receipt_number, $billing_type);
		$response = array();
		if($billing_discount == 1){		
			$subject = 'Billing discount approval request';
			$mail_msg = 'Hi IndiaIVF, <br/><br/> '.$employee_data['name'].'('.$employee_data['employee_number'].') asked for discount approval of '.$currency.' for patient '.$patitnet_detls.' against '.$billing_type.' billing.<br/><br/><strong>One-time coupon code</strong>: '.$coupon_code.' <br/><br/> Click here for <a href="'.base_url().'discount-request?p='.base64_encode($patient_id).'&r='.base64_encode($receipt_number).'&s='.base64_encode('1').'&t='.base64_encode($billing_type).'&f='.base64_encode('mail').'">Approve</a> or <a href="'.base_url().'discount-request?p='.base64_encode($patient_id).'&r='.base64_encode($receipt_number).'&s='.base64_encode('2').'&t='.base64_encode($billing_type).'&f='.base64_encode('mail').'">Decline</a>';
			$result = send_mail($admin_email, $subject, $mail_msg);
			$response = array('status' => 1);
		}else if($billing_discount == 2){
			$response = array('status' => 2);
		}else{
			$response = array('status' => 0);
		}
		echo json_encode($response);
		die;
	}

	function coupon_code($j = 8){

		$string = "";

		for($i=0;$i < $j;$i++){

			srand((double)microtime()*1234567);

			$x = mt_rand(0,2);

			switch($x){

				case 0:$string.= chr(mt_rand(97,122));break;

				case 1:$string.= chr(mt_rand(65,90));break;

				case 2:$string.= chr(mt_rand(48,57));break;

			}

		}

		return strtoupper($string); //to uppercase

	}

	

	function discount_request(){
		$patient = base64_decode($_GET['p']);
		$receipt = base64_decode($_GET['r']);
		$status = base64_decode($_GET['s']);
		$billing_type = base64_decode($_GET['t']);
		$from = base64_decode($_GET['f']);
		$disapprove_reason = isset($_GET['rs'])?$_GET['rs']:"";
		$disapprove_amount = isset($_GET['da'])?$_GET['da']:"";
		
		$redirect = '';
		if($from == 'dashboard'){
			$redirect = 'billings/billing_discount';
		}else{
			$redirect = 'discount-approval';
		}

		$check_discount_billing = check_discount_billing($patient, $receipt, $billing_type);
		if(empty($check_discount_billing)){
			header("location:" .base_url(). "$redirect?m=".base64_encode('Oops, billing not created yet!').'&t='.base64_encode('error'));
			die();
		}
		
		$billing_discount = $this->accounts_model->discount_request($billing_type, $patient, $status, $receipt, $disapprove_reason, $disapprove_amount);
		if($billing_discount == 2){
			header("location:" .base_url(). "$redirect?m=".base64_encode('Oops, billing not created yet!').'&t='.base64_encode('error'));
			die();
		}
		if($billing_discount == 3){
			header("location:" .base_url(). "$redirect?m=".base64_encode('Oops, something went wrong!').'&t='.base64_encode('error'));
			die();
		}
		if($billing_discount == 1){
			$patient_data = get_patient_detail($patient);
			$currency = "";
			// if($patient_data['nationality'] == "indian"){$currency = "Rs.";}else{$currency = "USD";}
			$discount_data = $this->accounts_model->get_discount_biller($patient, $receipt);
			$text_status = ""; $coupon = ""; if($status == 1){$text_status = 'approved'; $coupon = "Your one-time discount code of amount ".$currency.$discount_data['amount']." :- <strong>".$discount_data['code']."</strong><br/><br/>";}else if($status == 2){$text_status = 'declined';}
			$approve_billing_by_receipt = $this->accounts_model->approve_billing_by_receipt($receipt, $billing_type, 'disapproved', 'discount '.$text_status.'');
			if(!empty($discount_data)){
				$biller_data = get_employee_detail($discount_data['biller']);
				$mail_msg = "";
				$mail_msg = "Hi ".$biller_data['name']." (".$biller_data['username'].")<br/><br/>";
				$mail_msg .= "Your request for discount against billing receipt number (".$receipt."), has been ".$text_status.".<br/><br/> ".$coupon." Thanks, <br/>IndiaIVF";
				$result = send_mail($biller_data['email'], 'Billing discount status', $mail_msg);
			}
			header("location:" .base_url(). "$redirect?m=".base64_encode('Discount '.$text_status.'!').'&t='.base64_encode('success'));
			die();
		}else{
			header("location:" .base_url(). "$redirect?m=".base64_encode('Oops, discount status already updated/discount request not found!').'&t='.base64_encode('error'));
			die();
		}
	}	

	function check_billing_discount($patient, $receipt_number){
		$discount = $this->accounts_model->check_billing_discount($patient, $receipt_number);
		return $discount;
	}	

	public function billing_discount(){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$template = get_header_template($logg['role']);
			$data['data'] = $this->accounts_model->get_billing_discount();
			$this->load->view($template['header']);
			$this->load->view('accounts/billing-discount', $data);
			$this->load->view($template['footer']);
		}else{
			header("location:" .base_url()."");
			die();
		}
	}

	public function partial_payment_receipt($payment_id){
		$logg = checklogin();
		if($logg['status'] == true){
			$data = array();
			$template = get_header_template($logg['role']);
			$data = $this->accounts_model->get_partial_payment_receipt($payment_id);
			if(!empty($data)){
				$data['data'] = $data;
				$this->load->view($template['header']);
				$this->load->view('accounts/partial_payment_receipt', $data);
				$this->load->view($template['footer']);
			}else{
				header("location:" .base_url(). "accounts/accounts?m=".base64_encode('Oops, record not found!').'&t='.base64_encode('error'));
				die();
			}
		}else{
			header("location:" .base_url()."");
			die();
		}
	}
	

	function get_center(){

		if(isset($_SESSION['logged_accountant'])){ 

			$username = $_SESSION['logged_accountant']['username'];

			$center = $this->billings_model->get_center($username);

			return $center;

		}

	}

	

	function discount_applied($receipt){

		$check_discound_applied = $this->accounts_model->check_discound_applied($receipt);

		return $check_discound_applied;

	}
	
	function discount_applied_status($receipt){

		$check_discound_applied = $this->accounts_model->discount_applied_status($receipt);

		return $check_discound_applied;

	}
	

	function get_medicine_name($medicine){
		$name = $this->billings_model->get_medicine_name($medicine);
		return $name;
	}

	function get_brand_name($brand){
		$name = $this->billings_model->get_brand_name($brand);
		return $name;
	}
	
	function get_all_centers(){
		$all_centers = $this->center_model->get_centers();
		return $all_centers;
	}

} 