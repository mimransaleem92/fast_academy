<?php

class Reports_model extends Base_Model{
	
	function Reports_model(){
		parent::__construct();
		
	}
	
	function get_daily_report($from, $to, $obj = NULL){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$b = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$where = array();
		if(!is_null($obj)){
			if(isset($obj['batch_id']) && $obj['batch_id'] != '') $b = $obj['batch_id'];
			
			if(isset($obj['course_id']) && $obj['course_id'] != '' && $obj['course_id_to'] != ''){
				if($obj['course_id_to'] != $obj['course_id']){
					$where['s.course_id >='] = $obj['course_id'];
					$where['s.course_id <='] = $obj['course_id_to'];
				}
				else
				{
					$where['s.course_id'] = $obj['course_id'];
				}
			}
			elseif(isset($obj['course_id']) && $obj['course_id'] != ''){
				$where['s.course_id'] = $obj['course_id'];
			}
			if(isset($obj['section']) && $obj['section'] != ''){
				$where['s.section'] = $obj['section'];
			}
				
			if(isset($obj['fee_desc']) && $obj['fee_desc'] != ''){
				$where['sp.fee_desc'] = $obj['fee_desc'];
			}
			if(isset($obj['subject_id']) && $obj['subject_id'] != ''){
				$where['sp.subject_id'] = $obj['subject_id'];
			}
		}
		else{
			$where['sp.fee_desc'] = 'Tuition Fee';
		}
		
		$this->db->select("sp.*, b.batch_name, s.student_name, s.admission_number, s.section, c.course_name, s.cell_phone_father, s.cell_phone_mother");
		//$this->db->select("SUM(sp.due_amount) as total_due, SUM(sp.payment_amount) as total_payment, SUM(sp.discount_amount) as total_discount, (SUM(sp.due_amount)-SUM(sp.payment_amount) - SUM(sp.discount_amount)) as pending_amount, DATE_FORMAT(sp.due_date, '%d-%m-%Y') as duedate",FALSE);
		$this->db->from('student_payments sp');
		//$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->join('batches b','sp.batch_id = b.batch_id');
		$this->db->where("s.division_id", $div_id);
		$this->db->where("s.cdel", '0');
		$this->db->where('sp.batch_id <=', $b);
		$this->db->where('sp.mark_delete', '0');
		$this->db->where("sp.payment_date between '".$from."' and DATE_ADD('".$to."',INTERVAL 1 DAY)" );
		if(sizeof($where)>0)  $this->db->where($where);
		//$this->db->group_by('sp.student_id, sp.batch_id');
		//$this->db->having('total_due<>', 0);
		$this->db->order_by('course_name, section, s.student_name, sp.batch_id asc');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}

	function get_test_fee_report($from, $to, $obj = NULL){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$b = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$where = array();
		if(!is_null($obj)){
			if(isset($obj['batch_id']) && $obj['batch_id'] != '') $b = $obj['batch_id'];
			
			if(isset($obj['course_id']) && $obj['course_id'] != '' && $obj['course_id_to'] != ''){
				if($obj['course_id_to'] != $obj['course_id']){
					$where['s.course_id >='] = $obj['course_id'];
					$where['s.course_id <='] = $obj['course_id_to'];
				}
				else
				{
					$where['s.course_id'] = $obj['course_id'];
				}
			}
			elseif(isset($obj['course_id']) && $obj['course_id'] != ''){
				$where['s.course_id'] = $obj['course_id'];
			}
			if(isset($obj['section']) && $obj['section'] != ''){
				$where['s.section'] = $obj['section'];
			}
				
			if(isset($obj['fee_desc']) && $obj['fee_desc'] != ''){
				$where['sp.fee_desc'] = $obj['fee_desc'];
			}
			if(isset($obj['subject_id']) && $obj['subject_id'] != ''){
				$where['sp.subject_id'] = $obj['subject_id'];
			}
		}
		else{
			$where['sp.fee_desc'] = 'Tuition Fee';
		}
		
		$this->db->select("sp.student_id, SUM(sp.payment_amount) as payment_amount, b.batch_name, s.student_name, s.admission_number, s.section, c.course_id, c.course_name, s.cell_phone_father, s.cell_phone_mother, sb.subject_name");
		$this->db->from('student_payments sp');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('subjects sb','sb.subject_id = sp.subject_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->join('batches b','sp.batch_id = b.batch_id');
		$this->db->where("s.division_id", $div_id);
		$this->db->where("s.cdel", '9');
		$this->db->where('sp.batch_id <=', $b);
		$this->db->where('sp.mark_delete', '0');
		$this->db->where("sp.payment_date between '".$from."' and DATE_ADD('".$to."',INTERVAL 1 DAY)" );
		if(sizeof($where)>0)  $this->db->where($where);
		$this->db->group_by("sp.student_id, sp.subject_id");
		$this->db->order_by('course_name, section, s.student_name, sp.batch_id asc');
		$query = $this->db->get();
		return $query->result();
	}
	
    function get_student_report($from, $to, $obj = NULL){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		//$pattren = ($div_id == '1') ? 'DNS' : 'DIS';
		
		$where = array();
		if(!is_null($obj)){
			if(isset($obj['course_id']) && $obj['course_id'] != '' && $obj['course_id_to'] != ''){
				if($obj['course_id_to'] != $obj['course_id']){
					$where['s.course_id >='] = $obj['course_id'];
					$where['s.course_id <='] = $obj['course_id_to'];
				}
				else
				{
					$where['s.course_id'] = $obj['course_id'];
				}
			}
			elseif(isset($obj['course_id']) && $obj['course_id'] != ''){
				$where['s.course_id'] = $obj['course_id'];
			}
			
			if(isset($obj['section']) && $obj['section'] != ''){
				$where['s.section'] = $obj['section'];
			}
		}
		
		$this->db->select("s.student_id, s.admission_number, SUBSTRING_INDEX(s.student_name, ' ', 3) as student_name, SUBSTRING_INDEX(s.father_name, ' ', 2) as father_name, c.course_name, s.section, s.cell_phone_father, s.cell_phone_mother, s.date_of_birth, s.admission_date, s.iqama_id, s.passport_id, cn.country_name", FALSE);
		$this->db->from('students s');
		$this->db->join('courses c','s.course_id = c.course_id', 'LEFT');
		$this->db->join('country cn','s.nationality = cn.id', 'LEFT');
		$this->db->where("s.admission_date between '".$from."' and DATE_ADD('".$to."',INTERVAL 1 DAY)" );
		//$this->db->where("s.admission_number like '".$pattren."%'");
		$this->db->where("s.division_id", $div_id);
		$this->db->where('s.cdel', '0');
		if(sizeof($where)>0)  $this->db->where($where);
		$this->db->order_by('s.course_id, s.section, s.student_name');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_attendance_report($from, $to, $obj = NULL){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$where = array();
		if(!is_null($obj)){
			if(isset($obj['course_id']) && $obj['course_id'] != '' && $obj['course_id_to'] != ''){
				if($obj['course_id_to'] != $obj['course_id']){
					$where['s.course_id >='] = $obj['course_id'];
					$where['s.course_id <='] = $obj['course_id_to'];
				}
				else
				{
					$where['s.course_id'] = $obj['course_id'];
				}
			}
			elseif(isset($obj['course_id']) && $obj['course_id'] != ''){
				$where['s.course_id'] = $obj['course_id'];
			}
				
			if(isset($obj['section']) && $obj['section'] != ''){
				$where['s.section'] = $obj['section'];
			}
		}
	
		$this->db->select("s.student_id, s.section, s.admission_number, SUBSTRING_INDEX(s.student_name, ' ', 3) as student_name, SUBSTRING_INDEX(s.father_name, ' ', 2) as father_name, s.cell_phone_father, s.cell_phone_mother, c.course_name, sp.attendance_date, sp.attendance_comment", FALSE);
		$batch = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$this->db->from('student_attendance sp');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		
		$this->db->where("sp.attendance_date between '".$from."' and DATE_ADD('".$to."',INTERVAL 1 DAY)" );
		$this->db->where("sp.batch_id", $batch);
		$this->db->order_by('student_name');
		$this->db->where('s.cdel', '0');
		if(sizeof($where)>0)  $this->db->where($where);
		$this->db->order_by('s.course_id, s.section, s.student_name');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_fee_history($from, $to, $obj = NULL){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$b = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$where = array();
		if(!is_null($obj)){
			if(isset($obj['batch_id']) && $obj['batch_id'] != '') $b = $obj['batch_id'];
			
			if(isset($obj['course_id']) && $obj['course_id'] != '' && $obj['course_id_to'] != ''){
				if($obj['course_id_to'] != $obj['course_id']){
					$where['s.course_id >='] = $obj['course_id'];
					$where['s.course_id <='] = $obj['course_id_to'];
				}
				else
				{
					$where['s.course_id'] = $obj['course_id'];
				}
			}
			elseif(isset($obj['course_id']) && $obj['course_id'] != ''){
				$where['s.course_id'] = $obj['course_id'];
			}
			if(isset($obj['section']) && $obj['section'] != ''){
				$where['s.section'] = $obj['section'];
			}
				
			if(isset($obj['fee_desc']) && $obj['fee_desc'] != ''){
				$where['sp.fee_desc'] = $obj['fee_desc'];
			}
		}
		else{
			$where['sp.fee_desc'] = 'Tuition Fee';
		}
		
		$this->db->select("sp.*, b.batch_name, s.student_name, s.admission_number, s.section, c.course_name, s.cell_phone_father, s.cell_phone_mother");
		$this->db->select("SUM(sp.due_amount) as total_due, SUM(sp.payment_amount) as total_payment, SUM(sp.discount_amount) as total_discount, (SUM(sp.due_amount)-SUM(sp.payment_amount) - SUM(sp.discount_amount)) as pending_amount, DATE_FORMAT(sp.due_date, '%d-%m-%Y') as duedate",FALSE);
		$this->db->from('student_payments sp');
		//$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->join('batches b','sp.batch_id = b.batch_id');
		$this->db->where("s.division_id", $div_id);
		$this->db->where("s.cdel", '0');
		$this->db->where('sp.batch_id <=', $b);
		$this->db->where('sp.mark_delete', '0');
		
		if(sizeof($where)>0)  $this->db->where($where);
		$this->db->group_by('sp.student_id, sp.batch_id');
		//$this->db->having('total_due<>', 0);
		$this->db->having('pending_amount>', 0);
		$this->db->order_by('course_name, section, s.student_name, sp.batch_id asc');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}

	function get_test_fee_history($from, $to, $obj = NULL){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$b = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$where = array();
		if(!is_null($obj)){
			if(isset($obj['batch_id']) && $obj['batch_id'] != '') $b = $obj['batch_id'];
			
			if(isset($obj['course_id']) && $obj['course_id'] != '' && $obj['course_id_to'] != ''){
				if($obj['course_id_to'] != $obj['course_id']){
					$where['s.course_id >='] = $obj['course_id'];
					$where['s.course_id <='] = $obj['course_id_to'];
				}
				else
				{
					$where['s.course_id'] = $obj['course_id'];
				}
			}
			elseif(isset($obj['course_id']) && $obj['course_id'] != ''){
				$where['s.course_id'] = $obj['course_id'];
			}
			if(isset($obj['section']) && $obj['section'] != ''){
				$where['s.section'] = $obj['section'];
			}
				
			if(isset($obj['fee_desc']) && $obj['fee_desc'] != ''){
				$where['sp.fee_desc'] = $obj['fee_desc'];
			}
		}
		else{
			$where['sp.fee_desc'] = 'Tuition Fee';
		}
		
		$this->db->select("sp.*, b.batch_name, s.student_name, s.admission_number, s.section, c.course_name, s.cell_phone_father, s.cell_phone_mother, s.fee_pending_sms_count");
		$this->db->select("SUM(sp.due_amount) as total_due, SUM(sp.payment_amount) as total_payment, SUM(sp.discount_amount) as total_discount, (SUM(sp.due_amount)-SUM(sp.payment_amount) - SUM(sp.discount_amount)) as pending_amount, DATE_FORMAT(sp.due_date, '%d-%m-%Y') as duedate",FALSE);
		$this->db->from('student_payments sp');
		//$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->join('batches b','sp.batch_id = b.batch_id');
		$this->db->where("s.division_id", $div_id);
		$this->db->where("s.cdel", '9');
		$this->db->where('sp.batch_id <=', $b);
		$this->db->where('sp.mark_delete', '0');
		
		if(sizeof($where)>0)  $this->db->where($where);
		$this->db->group_by('sp.student_id, sp.batch_id');
		//$this->db->having('total_due<>', 0);
		$this->db->having('pending_amount>', 0);
		$this->db->order_by('course_name, section, s.student_name, sp.batch_id asc');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}	
	
	function get_defaulter_report($from, $to, $obj = NULL){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$b = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		//$from  = date('Y-m-d');
		$where = array();
		$where['sp.fee_desc'] = 'Tuition Fee';
		if(!is_null($obj)){
			if(isset($obj['batch_id']) && $obj['batch_id'] != '') $b = $obj['batch_id'];
	
			if(isset($obj['course_id']) && $obj['course_id'] != '' && $obj['course_id_to'] != ''){
				if($obj['course_id_to'] != $obj['course_id']){
					$where['s.course_id >='] = $obj['course_id'];
					$where['s.course_id <='] = $obj['course_id_to'];
				}
				else
				{
					$where['s.course_id'] = $obj['course_id'];
				}
			}
			elseif(isset($obj['course_id']) && $obj['course_id'] != ''){
				$where['s.course_id'] = $obj['course_id'];
			}
			if(isset($obj['section']) && $obj['section'] != ''){
				$where['s.section'] = $obj['section'];
			}
			if(isset($obj['fee_desc']) && $obj['fee_desc'] != ''){
				$where['sp.fee_desc'] = $obj['fee_desc'];
			}
		}
	
		$this->db->select("sp.*, s.student_name, s.admission_number, s.section, c.course_name, s.cell_phone_father, s.cell_phone_mother");
		$this->db->select("SUM(due_amount) as total_due, SUM(payment_amount) as total_payment, SUM(sp.discount_amount) as total_discount, (SUM(due_amount) - SUM(payment_amount) - SUM(discount_amount)) as pending_amount",FALSE);
		$this->db->from('student_payments sp');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->where("( ( sp.due_date > '".$from."' AND sp.due_date <= '".$to."') OR sp.payment_date <= '".$to."' )" );
		$this->db->where('sp.mark_delete', '0');
		$this->db->where("s.division_id", $div_id);
		if(sizeof($where)>0)  $this->db->where($where);
		$this->db->group_by('sp.student_id');
		$this->db->having('pending_amount >', 0);
	
		$this->db->order_by('course_name, section, s.student_name asc');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function update_message_count($student_id){ 
		
		$this->db->query("UPDATE `students` SET fee_pending_sms_count = fee_pending_sms_count + 1 WHERE `student_id` = '".$student_id."'");
	}
}