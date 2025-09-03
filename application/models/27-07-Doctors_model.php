<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Calcutta');



class Doctors_model extends CI_Model

{

	function login($data)

    {

		$result = array();

		$sql_condition = '';

		$sql = "Select * from " . $this->config->item('db_prefix') . "doctors WHERE username='".$data['email']."' AND status='1'";

        $q = $this->db->query($sql);

        $user_result = $q->result_array();

        if (count($user_result) > 0)

        {

			if($user_result[0]['center_id'] != 0){ $sql_condition = ' and emp.center_id = center.center_number and center.status="1"'; }

		   $new_sql = "Select *, emp.ID as doctor_id from ".$this->config->item('db_prefix')."doctors as emp, ".$this->config->item('db_prefix')."centers as center WHERE emp.username='".$data['email']."' AND emp.password ='".md5($data['password'])."' AND emp.status='1' ".$sql_condition."";

	 	   $new_q = $this->db->query($new_sql);

		   $affected_rows = $new_q->result_array();		   

		   if (count($affected_rows) > 0)

	       {

				unset($_SESSION['logged_doctor']);

				$_SESSION['logged_doctor'] = array('name'=>$affected_rows[0]['name'], 'username'=>$affected_rows[0]['username'], 'doctor_id'=>$affected_rows[0]['doctor_id'], 'is_primary'=>$affected_rows[0]['is_primary'], 'role' => 'doctor', 'junior_doctor'=>$affected_rows[0]['junior_doctor']);

				$result = array('status' => 1);

            	return $result;

			}else{

				$result = array('status' => 0);

            	return $result;		

			}

        }

        else

        {

			$result = array('status' => 0);

            return $result;		

        }

	}

	

	function consultation_medicine(){

		$result = array();

		$sql_condition = '';

	  	$sql ="Select * from ".$this->config->item('db_prefix')."stocks where status='1' and quantity > 0 and expiry >= DATE(now()) ORDER by expiry ASC";

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

	

	function get_doctor_consultations(){

		$result = array();

		$sql_condition = '';

	  	$sql ="Select * from ".$this->config->item('db_prefix')."doctor_consultation where final_mode='1' ORDER by consultation_date DESC";

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

	function doctor_data_by_username($doctor_username){
		$this->db->select('*');
		$this->db->where('username', $doctor_username);
		$this->db->from($this->config->item('db_prefix').'doctors');
		$query = $this->db->get();
		return $query->row();
	}

	function wl_doctor_appointment_lists($doctor_id, $appointment_date){
		$center = get_doctor_centre($doctor_id);
		$sql_condition = "appoitmented_doctor='$doctor_id'";
		
		$today = date('Y-m-d');
		$date_condition = " >= '".$today."'";
	
		if(!empty($appointment_date)){
		    $date_condition = " = '".$appointment_date."'";
		}
        
		$result = array();
		$sql = "Select * from ".$this->config->item('db_prefix')."appointments where $sql_condition and status!='consultation_done' and status!='no_show' and status!='cancelled' and appoitmented_date ".$date_condition." order by appoitmented_date ASC";
		
		$q = $this->db->query($sql);
	    $result = $q->result_array();
	    if (!empty($result))
	    {
			return $result;
        }else{
			return $result;
		}
	}
	

	function disapprove_consultation_done($id, $reason){

		$sql = "UPDATE `" . $this->config->item('db_prefix') . "doctor_consultation` SET `final_mode`='0', `disapproval_reason` = '$reason' where ID='$id'";

		$this->db->query($sql);

        return $this->db->affected_rows();

	}



	function get_doctor_appointment($appointment_id){

		$result = array();

		$sql_condition = '';

		$sql = "Select appoitmented_date, appoitmented_slot from ".$this->config->item('db_prefix')."appointments where ID='".$appointment_id."'";

	

        $q = $this->db->query($sql);

        $result = $q->result_array();

		$appointment_date = "";

        if (!empty($result))

        {

			$appointment_date  = $result[0]['appoitmented_date']." ".$result[0]['appoitmented_slot'];

            return $appointment_date;

        }

        else

        {

            return $appointment_date;

        }

	}

	

	function consultation_done($data){

		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "doctor_consultation` SET ";

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

	



	function patient_medical_info($data){

		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "patient_medical_info` SET ";

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



	function get_doctors(){

		$result = array();

		$sql_condition = '';

		$sql = "Select * from ".$this->config->item('db_prefix')."doctors ORDER by ID DESC";

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



	function get_junior_doctors(){

		$result = array();

		$sql_condition = '';

		$sql = "Select * from ".$this->config->item('db_prefix')."doctors where junior_doctor='1'  ORDER by ID DESC";

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

	

	function get_doctors_list(){

		$result = array();

		$sql_condition = '';

		$sql = "Select * from ".$this->config->item('db_prefix')."doctors where status='1' ORDER by ID DESC";

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

	

	function add_doctor($data){

		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "doctors` SET ";

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



	function add_junior_doctors($data){

		$sql = "INSERT INTO `" . $this->config->item('db_prefix') . "doctors` SET ";

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

	

	function get_doctor_data($item){

		$result = array();

		$sql_condition = '';

		$sql = "Select * from ".$this->config->item('db_prefix')."doctors where ID='".$item."'";

	

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

	

	public function update_doctor_data($data, $item)

    {	

        $sql = "UPDATE " . config_item('db_prefix') . "doctors SET ";

		foreach( $data as $key=> $value )

		{

			$sqlArr[] = " $key = '".$value."'"	;

		}

		$sql .= implode(',' , $sqlArr);

		$sql .= " WHERE ID = '".$item."'";

        $this->db->query($sql);

        return 1;

    }



	function update_doctor_relationship($junior_id, $doctor_lists)

	{

		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "doctor_relationship WHERE junior_doctor_id = '".$junior_id."'";

		$res =  $this->db->query($sql);

		

		foreach($doctor_lists as $key => $vals){

			//var_dump($junior_id);die;

			$sql = "INSERT INTO `".$this->config->item('db_prefix')."doctor_relationship` (`junior_doctor_id`, `doctor_id`) VALUES ('$junior_id', '$vals')";

			$res =  $this->db->query($sql);						

		}

		return 1;

	}

	

	public function delete_doctor_data($item){

		$sql = "DELETE FROM " . $this->config->item('db_prefix') . "doctors WHERE ID = '".$item."'";

       	$res =  $this->db->query($sql);

		if ($res)

		{

			return 1;

		}

		else

			return 0;	

	}



	function delete_junior_doctor_data($junior_id){

		$sql = "DELETE ".$this->config->item('db_prefix')."doctors, ".$this->config->item('db_prefix')."doctor_relationship FROM ".$this->config->item('db_prefix')."doctors INNER JOIN ".$this->config->item('db_prefix')."doctor_relationship ON ".$this->config->item('db_prefix')."doctors.ID = ".$this->config->item('db_prefix')."doctor_relationship.junior_doctor_id WHERE ".$this->config->item('db_prefix')."doctor_relationship.junior_doctor_id='$junior_id'";

       	$res =  $this->db->query($sql);

		if ($res)

		{

			return 1;

		}

		else

			return 0;

	}

	

	function doctor_fees($id, $nationality){

		$condition = '';

		if($nationality == 'indian'){

			$condition = 'fees';

		}else{

			$condition = 'usd_fees';

		}

		$sql = "Select ".$condition." from ".$this->config->item('db_prefix')."doctors where ID='".$id."'";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

            return $result[0][$condition];

        }

        else

        {

            return $result;

        }

	}

	

	function center_doctors($center){

		$result = array();

		$sql = "Select ID, name from ".$this->config->item('db_prefix')."doctors where center_id='$center' and status='1' ORDER by ID DESC";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

            return $result;

        }

        return $result;

	}

	

	function doctor_appointments($doctor, $date){

		$result = $slots = array();

		$sql = "Select appoitmented_slot from ".$this->config->item('db_prefix')."appointments where appoitmented_doctor='$doctor' and appoitmented_date='$date'";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

            return $result;

        }

        return $result;

	}

	

	function doctor_slots($doctor, $day){

		$result = $slots = array();

		$sql = "Select ".$day."_slots as slots from ".$this->config->item('db_prefix')."doctors where ID='$doctor' and ".$day."_off='0' and status='1'";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

			$slots =  unserialize($result[0]['slots']);

            return $slots;

        }

        return $result;

	}

	

	function doctor_on_holiday($doctor){

		$result = 0;

		$sql = "Select on_holiday_daterange as holiday_dates from ".$this->config->item('db_prefix')."doctors where ID='$doctor' and on_holiday='1' and status='1'";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

            return $result[0]['holiday_dates'];

        }

        return 0;

	}

	

	function get_center_doctors($center){

		$result = array();

		$sql = "Select ID, name from ".$this->config->item('db_prefix')."doctors where status='1'";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

			return $result;

        }else{

			return $result;

		}

	}

	

	// Dashboard Start



	function procedure_form_insert($data, $form_area){

		$dsql = "DELETE FROM " .$form_area. " WHERE patient_id = '".$data['patient_id']."' and receipt_number='".$data['receipt_number']."'";

       	$dres =  $this->db->query($dsql);



		$sql = "INSERT INTO `".$form_area."` SET ";

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



	function doctor_relationship($junior_id, $doctor_lists){



		foreach($doctor_lists as $key => $vals){

			//var_dump($junior_id);die;

			$sql = "INSERT INTO `".$this->config->item('db_prefix')."doctor_relationship` (`junior_doctor_id`, `doctor_id`) VALUES ('$junior_id', '$vals')";

			$res =  $this->db->query($sql);						

		}

		return 1;



	}



	function check_procedure_form($form_id, $patient_procedure_id, $procedure_id){

		$result = array();

		$sql = "Select * from ".$this->config->item('db_prefix')."procedure_forms where ID='$form_id'";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

			$form_area = $result[0]['form_area'];

			$prod_result = array();

			$prod_sql = "Select * from ".$this->config->item('db_prefix')."patient_procedure where ID='$patient_procedure_id'";

			

			$prod_q = $this->db->query($prod_sql);

			$prod_result = $prod_q->result_array();

			if (!empty($prod_result))

			{

				$patient_id = $prod_result[0]['patient_id'];

				$receipt_number = $prod_result[0]['receipt_number'];



				$form_result = array();

				$form_sql = "Select * from ".strtolower($form_area)." where patient_id='$patient_id' and receipt_number='$receipt_number' and procedure_id='$procedure_id'";

				

				$form_q = $this->db->query($form_sql);

				$form_result = $form_q->result_array();

				if (!empty($form_result))

				{

					return $form_result;

				}else{

					return $form_result;

				}

			}else{

				return $prod_result;

			}

        }else{

			return $result;

		}

	}



	function doctor_appointment_lists($doctor_id){

		$center = get_doctor_centre($doctor_id);

		

		$sql_condition = "appoitmented_doctor='$doctor_id'";

		if($center > 0){

			$sql_condition = "appoitment_for='$center'";

		}

		$result = array();

		$sql = "Select * from ".$this->config->item('db_prefix')."appointments where $sql_condition and status!='no_show' and status!='cancelled' order by appoitmented_date desc";

	    

		$q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

			return $result;

        }else{

			return $result;

		}

	}



	function junior_doctor_appointment_lists($junior_id){

		$result = $response = array();

		$doctor_related = get_doctors_relationship($junior_id);		

		foreach($doctor_related as $key => $val){

			$sql = "Select * from ".$this->config->item('db_prefix')."appointments where appoitmented_doctor='$val' and status!='no_show' and status!='cancelled' order by appoitmented_date desc";

			$q = $this->db->query($sql);

			$result = $q->result_array();

			if(!empty($result)){

				$response[] = $result;

			}

		}

		

		return $response;

	}



	function doctor_ipd_lists($doctor_id){

		$result = array();

		$sql = "Select * from ".$this->config->item('db_prefix')."appointments where status!='no_show' and status!='cancelled' and billed='1' group BY wife_phone order by appoitmented_date desc";

        $q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

			return $result;

        }else{

			return $result;

		}

	}



	function update_procedure_report_status($status, $reason, $patient_id, $receipt_number, $form_area, $data_id){

		$sql = "UPDATE `$form_area` SET `status`='$status',`disapproval_reason`='$reason' WHERE patient_id='$patient_id' AND receipt_number='$receipt_number' and id='$data_id'";

		$this->db->query($sql);

        return $this->db->affected_rows();

	}

	

	//Ajax filter

	function ajax_appointment_status_data($status){

		$condition = "";

		if(isset($_SESSION['logged_doctor'])){ 

			$doctor_id = $_SESSION['logged_doctor']['doctor_id'];

			$condition = " appoitmented_doctor='$doctor_id' and ";

		}

		

		$result = array();

		$sql = "Select * from ".$this->config->item('db_prefix')."appointments where $condition status='$status' ORDER by appoitmented_date DESC";

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

	

	function ajax_appointment_date_wise_data($start, $end){

		$condition = "";

		if(isset($_SESSION['logged_doctor'])){ 

			$doctor_id = $_SESSION['logged_doctor']['doctor_id'];

			$condition = " appoitmented_doctor='$doctor_id' and ";

		}

	

		$result = array();

		$sql = "Select * from ".$this->config->item('db_prefix')."appointments where $condition appoitmented_date between '".$start."' AND '".$end."'";

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

	

	function ajax_appointment_particular_date_data($appointment_date){

		$condition = "";

		if(isset($_SESSION['logged_doctor'])){ 

			$doctor_id = $_SESSION['logged_doctor']['doctor_id'];

			$condition = " appoitmented_doctor='$doctor_id' and ";

		}

		

		$result = array();

		$sql = "Select * from ".$this->config->item('db_prefix')."appointments where $condition appoitmented_date='$appointment_date' ORDER by appoitmented_date DESC";

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



	function check_doctor($username){

		$result = array();

		$sql = "Select count(*) as count from ".$this->config->item('db_prefix')."doctors where username='$username' order by ID desc limit 1";

		$q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

            return $result[0]['count'];

        }

        else

        {

            return $result;

        }

	}



	function check_junior_doctor($username){

		$result = array();

		$sql = "Select count(*) as count from ".$this->config->item('db_prefix')."junior_doctors where username='$username' order by ID desc limit 1";

		$q = $this->db->query($sql);

        $result = $q->result_array();

        if (!empty($result))

        {

            return $result[0]['count'];

        }

        else

        {

            return $result;

        }

	}

	

	// Dashboard Start 

}



// END Stock_model class

/* End of file Stock_model.php */

/* Location: ./application/models/Stock_model.php */