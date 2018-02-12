<?php

class Global_search_model extends Base_Model{
	
	function Global_search_model(){
		parent::__construct();
		
	}
	
	function get_vehicle_log($from, $to, $search = NULL){
	
		$this->db->select('wo.work_order_id, wo.odometer, wo.reason, wo.wo_date, wo.delivery_date, v.chassis_number, v.plate_number, d.name as driver_name, c.name as customer_name');
		$this->db->from('work_order wo');
		$this->db->join('vehicle v','v.vehicle_id = wo.vehicle_id');
		$this->db->join('drivers d','d.driver_id = wo.driver_id', 'LEFT');
		$this->db->join('customers c','c.customer_id = wo.customer_id', 'LEFT');
		//$this->db->where('wo.reason','Fleet');
		if(is_null($search) || empty($search)){
			$this->db->where("(wo.wo_date between '".$from."' and '".$to."' OR wo.delivery_date between '".$from."' and '".$to."')");
		}
		else 
		{
			$this->db->where("(wo.wo_date between '".$from."' and '".$to."' OR wo.delivery_date between '".$from."' and '".$to."')");
			//$this->db->or_where("wo.delivery_date between '".$from."' and '".$to."'");
			$this->db->like("v.chassis_number", $search);
		}
		$this->db->order_by('wo.wo_date', 'desc');
		$query = $this->db->get();//echo $str = $this->db->last_query();
		return $query->result();
	}
	

	function get_students($search_text = ''){
		//$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		//$division_id = ($div_id == '1') ? 'DNS' : 'DIS';
		
		$this->db->select('students.*, c.course_name, b.batch_name');
		//$this->db->select( "SUBSTR(students.admission_number,1,3) as division", FALSE);
		$this->db->from('students');
		$this->db->join('courses c', 'c.course_id = students.course_id', 'LEFT');
		$this->db->join('batches b', 'b.batch_id = students.batch_id', 'LEFT');
		
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$this->db->where("division_id", $div_id);
		if($search_text != ''){
			if(is_numeric($search_text))
				$this->db->where('student_id', $search_text);
			else if(strlen($search_text) == 10 && strpos($search_text, '-'))
				$this->db->where('admission_number', $search_text);
			else
				$this->db->like('student_name', $search_text);
		}
		//$this->db->where("SUBSTR(students.admission_number,1,3)", $division_id);
		
		$this->db->order_by('student_name', 'asc');
		$query = $this->db->get();
		//echo $str = $this->db->last_query().'1111';
		return $query->result();
	}
	
	function get_student_search($search_text=''){
		
		$this->db->select('students.*, c.course_name, b.batch_name');
		$this->db->from('students');
		$this->db->join('courses c', 'c.course_id = students.course_id', 'LEFT');
		$this->db->join('batches b', 'b.batch_id = students.batch_id', 'LEFT');
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$this->db->where("division_id", $div_id);
		if($search_text != ''){
			if(is_numeric($search_text))
			$this->db->where('student_id', $search_text);
			else if(strlen($search_text) == 10 && strpos($search_text, '-'))
			$this->db->where('admission_number', $search_text);
			else 
			$this->db->like('student_name', $search_text);
		}
		
		$this->db->order_by('course_name, section, student_name', 'asc');
		$query = $this->db->get();
		//echo $str = $this->db->last_query().'222';
		return $query->result();
	}
	
	function get_advance_search(){
	
		$this->db->select('students.*, c.course_name, b.batch_name');
		$this->db->from('students');
		$this->db->join('courses c', 'c.course_id = students.course_id', 'LEFT');
		$this->db->join('batches b', 'b.batch_id = students.batch_id', 'LEFT');
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$this->db->where("division_id", $div_id);
		if(isset($_POST['student_name']) && $_POST['student_name'] != ''){
			$this->db->like('students.student_name', $_POST['student_name']);
		}
		if(isset($_POST['course_id']) && $_POST['course_id'] != ''){
			$this->db->where('c.course_id', $_POST['course_id']);
		}
		if(isset($_POST['section']) && $_POST['section'] != ''){
			$this->db->where('students.section', $_POST['section']);
		}
		if(isset($_POST['admission_number']) && $_POST['admission_number'] != ''){
			$this->db->like('students.admission_number', $_POST['admission_number']);
		}
		
		if(isset($_POST['cell_phone_mother']) && $_POST['cell_phone_mother'] != ''){
			$this->db->like('students.cell_phone_mother', $_POST['cell_phone_mother']);
		}
		elseif(isset($_POST['cell_phone_father']) && $_POST['cell_phone_father'] != ''){
			$this->db->like('students.cell_phone_father', $_POST['cell_phone_father']);
		}
	
		$this->db->order_by('section, student_name', 'asc');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
}