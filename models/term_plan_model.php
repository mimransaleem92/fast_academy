<?php

class Term_plan_model extends Base_Model{
	
	function Term_plan_model(){
		parent::__construct();
		
	}
	
	function add_term_plan(){
		$div_id =  $this->session->userdata(SESSION_CONST_PRE.'division_id'); 
		$date = Util::dateSavingFormat($_POST['plan_date']);
		
		$att_arr = array ('chapter', 'homework', 'classwork', 'weekend_hw', 'division_id', 'batch_id', 'course_id', 'subject_id', 'term');
		$main_arr = array('division_id'=>$div_id);
		foreach ($att_arr as $index)
		{
			$main_arr[$index] = $_POST[$index];
		}
		$obj = $this->get_current_week($_POST['batch_id'], $date);
		if(isset($obj[0])){
			$main_arr['week']=$obj[0]->week_number;
		}
		$main_arr['date'] = $date;
		$main_arr['created_by'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
		 
		$this->db->insert('term_plan', $main_arr);
				
	}
	
	function update_week_plan(){
		$att_arr = array ('chapter', 'homework', 'classwork', 'weekend_hw');
		$date = Util::dateSavingFormat($_POST['plan_date']);
		$obj = $this->get_current_week($_POST['batch_id'], $date);
		/*$main_arr['date'] = 'date="'.$date.'"';
		if(isset($obj[0])){
			$main_arr[]= 'week="'.$obj[0]->week_number.'"';
		}
		foreach ($att_arr as $index)
		{
			$main_arr[] = $index.'="'.$_POST[$index].'"';
		}
		$field_str = implode(", ", $main_arr);*/
		foreach ($att_arr as $index)
		{
			$main_arr[$index] = $_POST[$index];
		}
		if(isset($obj[0])){
			$main_arr['week']=$obj[0]->week_number;
		}
		$main_arr['date'] = $date;
		$this->db->where(array('term_plan_id'=>$_POST['id']));
		$this->db->update('term_plan', $main_arr);
		
	}
	
	function delete_term_plan(){
		$this->db->where(array('term_plan_id'=>$_POST['id']));
		$this->db->delete('term_plan');
	}
	
    function get_term_plan($batch, $term, $course_id, $subject_id){
    	
		$this->db->select("*, DATE_FORMAT(date, '%d-%b-%Y') as plan_date", FALSE);
		$this->db->from('term_plan');
		$this->db->where(array("batch_id" => $batch, "term" =>$term, "course_id" =>$course_id, "subject_id" =>$subject_id));
		$this->db->order_by('term, week, date');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_current_week($id, $date){
		 
		$this->db->select("*, DATE_FORMAT(start_date, '%d-%b-%Y') as start_dt, DATE_FORMAT(end_date, '%d-%b-%Y') as end_dt ", FALSE);
		$this->db->from('academic_calendar');
		$this->db->where(array("batch_id" => $id));
		$this->db->where("DATE_FORMAT('$date', '%Y-%m-%d')>=start_date");
		$this->db->where("DATE_FORMAT('$date', '%Y-%m-%d')<=end_date");
		$this->db->order_by('term, week_number');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_last_working_day($d){
			
		$sql = "select DATE_SUB(CURDATE(), INTERVAL $d DAY) as dt";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->dt;
	}
	
	
	function get_week($batch, $week, $term){
			
		$this->db->select("*, DATE_FORMAT(start_date, '%d-%b-%Y') as start_dt, DATE_FORMAT(end_date, '%d-%b-%Y') as end_dt ", FALSE);
		$this->db->from('academic_calendar');
		$this->db->where(array("batch_id" => $batch, 'week_number'=>$week, 'term'=>$term));
		$this->db->order_by('term, week_number');
		$query = $this->db->get();
		
		return $query->result();
	}
	
   	function set_attendance(){
    	$att_arr = array ('student_id', 'attendance_comment', 'attendance_date', 'division_id', 'batch_id', 'course_id', 'section');
    	$main_arr = array();
    	foreach ($att_arr as $index)
    	{
    		$main_arr[$index] = $_POST[$index];
    	}
    	$main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
    	
    	$this->db->insert('student_attendance', $main_arr);
    }
    
    function get_attendance($date){
    	 
    	$this->db->where("attendance_date <= DATE_ADD('$date', INTERVAL 21 DAY)");
    	$this->db->where("attendance_date >= $date");
    	
    	$query = $this->db->get('student_attendance');
    	//echo $str = $this->db->last_query();
    	return $query->result();
    }
    
    function delete_attendance(){
    	$this->db->where('student_id', $_GET['student_id']);
    	$this->db->where('attendance_date', $_GET['attendance_date']);
    	$this->db->delete('student_attendance');
    }
	
	function get_pre_week($dt){
		$sql = "select DATE_SUB('$dt', INTERVAL 7 DAY) as dt";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->dt;
	}
	
	function get_ctlist($id){
		$this->db->order_by('start_time');
		$query = $this->db->get_where('batch_classtiming',array("batch_id" => $id));
		return $query->result();
	}
	
	function insert()
    {
    	$timetable_arr = $_POST;
    	
        $this->db->insert('timetables', $timetable_arr);
        $timetable_id = $this->db->insert_id(); 
    }
	
	function update()
    {
    	$timetable_arr = $_POST;
    	$timetable_id  = $_POST['timetable_id'];
        unset($timetable_arr['timetable_id']);
        
        $this->db->where('timetable_id', $timetable_id);
    	$this->db->update('timetables', $timetable_arr);
    }
	
    function weekday_update($batch_id){
    	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
    	$weekday_arr = array();
    	foreach ($days as $d){
    		if(isset($_POST[$d]) ){
    			$weekday_arr[$d] = 'on';
    		}else {
    			$weekday_arr[$d] = '';
    		}
    	}	
    	$this->db->where('batch_id', $batch_id);
    	$this->db->update('batch_weekdays', $weekday_arr);
    	//echo $this->db->last_query();
    }
    
    function weekday_insert(){
    	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
    	$weekday_arr = array();
    	foreach ($days as $d){
    		if(isset($_POST[$d]) ){
    			$weekday_arr[$d] = 'on';
    		}else {
    			$weekday_arr[$d] = '';
    		}
    	}
    	$weekday_arr['course_id'] = $_POST['course_id'];
    	$weekday_arr['batch_id'] = $_POST['batch_id'];
    	$this->db->insert('batch_weekdays', $weekday_arr);
    	//echo $this->db->last_query();
    }
    
    function ct_insert(){
    	$days = array('name', 'start_time', 'end_time', );
    	$ct_arr = array();
    	foreach ($days as $d){
    		$ct_arr[$d] = $_POST[$d];
    	}
    	if(isset($_POST['is_break']) ){
    		$ct_arr['is_break'] = 'Yes';
    	}else {
    		$ct_arr['is_break'] = 'No';
    	}
    	$ct_arr['course_id'] = $_POST['course_id'];
    	$ct_arr['batch_id'] = $_POST['batch_id'];
    	$this->db->insert('batch_classtiming', $ct_arr);
    	//echo $this->db->last_query();
    }
    
    function insert_subject_employee($weekdays){
    	if($_POST['weekdays_type'] == 'ALL'){
    		$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
    		unset($_POST['weekdays_type']);
    		unset($_POST['weekday']);
    		$this->db->where('id', $_POST['id']);
    		$this->db->delete('batch_subject_teacher');
    		$weekday_arr = $_POST;
    		foreach($days as $d){
				if($weekdays->$d == 'on'){
    			$weekday_arr['weekday'] = $d;
    			$this->db->insert('batch_subject_teacher', $weekday_arr);
    			}
    		}
    	}
    	else{
    		unset($_POST['weekdays_type']);
    		$this->db->insert('batch_subject_teacher', $_POST);
    	}
    	
    }
    
    function delete_subject_employee($a){
    	if(isset($_POST)){
	    	$this->db->where('course_id', $a[1]);
	    	$this->db->where('batch_id', $a[2]);
	    	$this->db->where('id', $a[3]);
	    	$this->db->where('weekday', $a[0]);
	    	$this->db->delete('batch_subject_teacher');
    	}
    }
    
    function get_subject_employee_by_batch($id){
    	$this->db->select('bst.*, e.employee_name, s.subject_name');
    	$this->db->from('batch_subject_teacher bst');
    	$this->db->join('employees e','e.employee_id = bst.employee_id');
    	$this->db->join('subjects s', 's.subject_id = bst.subject_id');
    	$this->db->where('bst.batch_id', $id);
    	$this->db->order_by('bst.weekday, bst.id');
    	$query = $this->db->get();
    	//echo $str = $this->db->last_query();
    	return $query->result();
    }
    
    
    function delete_classtiming($timetable_list)
    {
    	$timetable_arr = explode(",", $timetable_list);
    	foreach ($timetable_arr as $timetable_id)
    	{
    		$this->db->where('id', $timetable_id);
    		$this->db->delete('batch_classtiming');
    	}
    }
    
    function delete($timetable_list)
    {	
    	$timetable_arr = explode(",", $timetable_list);
    	foreach ($timetable_arr as $timetable_id)
    	{
	    	$this->db->where('timetable_id', $timetable_id);
	        $this->db->delete('timetables');
    	}
    }
		
}