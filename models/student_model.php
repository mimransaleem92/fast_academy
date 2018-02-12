<?php

class Student_model extends Base_Model{
	
	function Student_model(){
		parent::__construct();
		
	}
	
	
	function get_student_data(){
		$this->db->order_by('sheet_name, student_name', 'asc');
		$query = $this->db->get('student_data');
		
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function insert_data($students){
		if(sizeof($students)>0){
			$this->db->delete('students', array('student_id >'=>'0'));
		}
		$this->db->insert_batch('students',$students);
	}
	
	function get_all_students($row = 0, $paging = FALSE, $flag=0){
		
		$div_id = 0;//$this->session->userdata(SESSION_CONST_PRE.'division_id');
		if($flag > 0)
		{
			$this->db->where('s.marks <>', '0');
		}
		
		//$this->db->where('s.marks >', 70);
		$this->db->where('s.division_id', $div_id);
		$this->db->where('s.cdel', '0');
		if (isset($_POST['admission_number']) && strlen($_POST['admission_number']) >= 11){
			$this->db->where('s.admission_number', $_POST['admission_number']);
		}
		if (isset($_POST['student_name'])){
			$this->db->like('s.student_name', $_POST['student_name']);
		}
		
		if (isset($_POST['father_name'])){
			$this->db->like('s.father_name', $_POST['father_name']);
		}
		
		if (isset($_POST['course_id']) && $_POST['course_id'] > 0 ){
			$this->db->where('s.course_id', $_POST['course_id']);
			
			if (isset($_POST['section']) && $_POST['section'] != '' ){
				$this->db->where('s.section', $_POST['section']);
			}
			if(isset($_POST)) $paging = FALSE;
		}
		
		if($paging){
			$this->db->select('s.*, c.course_name');
			$this->db->from('student_enrollments s');
			$this->db->join('courses c', 'c.course_id = s.course_id', 'LEFT');
			$this->db->order_by('enrollment_id', 'desc');
			$query = $this->db->get('', 10, $row);
		}
		else 
		{
			$this->db->select('s.*, c.course_name');
			$this->db->from('student_enrollments s');
			$this->db->join('courses c', 'c.course_id = s.course_id', 'LEFT');
			$this->db->order_by('course_id, section, enrollment_id', 'asc');
			$query = $this->db->get();
		}
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_students_count(){
		$div_id = 0;//$this->session->userdata(SESSION_CONST_PRE.'division_id');
		$where = '';
		if (isset($_POST['admission_number']) && strlen($_POST['admission_number']) >= 11){
			$where = " AND admission_number='".$_POST['admission_number']."'";
		}
		if (isset($_POST['student_name'])){
			$where = " AND student_name LIKE('%".$_POST['student_name']."%')";
		}
		$query  = $this->db->query("select count(admission_number) as id from student_enrollments where division_id='".$div_id."' and cdel=0 $where");
		
		$result = $query->result();
		$max_num = $result[0]->id;
		return $max_num;
	}
	
	function get_num_students(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
		$query  = $this->db->query("select count(admission_number) as id from student_enrollments where division_id='".$div_id."' and cdel=0");
		$result = $query->result();
		$max_num = $result[0]->id;
		return $max_num;
	}
	
	function update_admission_number(){
		$curr_month = date('Y-m-01');
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$pattren = ($div_id == '1') ? 'DNS' : 'DIS';
		if($div_id == '1'){ // 1 
			$sql ="SELECT student_enrollment_id  FROM students WHERE student_enrollment_id <=643 order by student_enrollment_id";
		}
		else{
			$sql ="SELECT student_enrollment_id  FROM students WHERE student_enrollment_id >643 order by student_enrollment_id";
		}
		$query = $this->db->query($sql);
		
		$result = $query->result();
		$i = 1; $arr_fee = array();
		foreach ($result as $row) {
			$student_enrollment_id = $row->student_enrollment_id;
			$reg_number = $pattren . '-' . (date('y')-1)."-". Util::leading_zeros ($i, 4);
			$this->db->where('student_enrollment_id', $student_enrollment_id);
			$this->db->update('student_enrollments', array('admission_number'=>$reg_number));
			$i++;  
		}	
	}
	
	function insert()
    {
        $emp_arr = array ('student_name', 'gender', 'date_of_birth', 'nationality',
  						  'country_id', 'city',  'state',  'address_line1',  'address_line2', 'language',  'category',  
        				  'email', 'admission_date','iqama_id', 'passport_expiry', 'issue_date','iqama_expiry', 'passport_id', 
        				  'course_id', 'batch_id', 'section', 'mother_name', 'father_name',
        				  'work_place_mother', 'id_number_mother', 'work_phone_mother', 'cell_phone_mother', 'email_mother',
        				  'work_place_father', 'id_number_father', 'work_phone_father', 'cell_phone_father', 'email_father');
    	$main_arr = array();
    	foreach ($emp_arr as $index)
    	{
    		if(isset( $_POST[$index]))
    		$main_arr[$index] = $_POST[$index];
    	}
    	
    	$main_arr['admission_number'] = $this->get_adminition_no();
    	$main_arr['division_id'] = $this->session->userdata(SESSION_CONST_PRE.'division_id');
    	
    	$this->db->insert('student_enrollments', $main_arr);
    	$student_enrollment_id = $this->db->insert_id();
    }
    
    function get_adminition_no(){
    	$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
    	$pattren = ($div_id == '1') ? 'DNS' : 'DIS';
    	$pattren = $pattren . '-' . date('y');
    	$query  = $this->db->query("select count(admission_number) as id from student_enrollments where admission_number like '".$pattren."%'");
    	$result = $query->result();
    	$max_num = $result[0]->id;
    
    	return $pattren."-". Util::leading_zeros ($max_num+1, 4);
    }
}