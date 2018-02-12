<?php

class Timetable_model extends Base_Model{
	
	function Timetable_model(){
		parent::__construct();
		
	}
	
	public function get_timetable_by($id){
		
		$q = "select * from timetables where timetable_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_timetables($row = 0, $paging = FALSE){
		if($paging){
			$this->db->select('b.*, c.name as company_name');
			$this->db->from('timetables b');
			$this->db->join('company c','c.company_id = b.company_id');
			$query = $this->db->get('',10,$row);
		}
		else 
		{
			$this->db->select('b.*, c.name as company_name');
			$this->db->from('timetables b');
			$this->db->join('company c','c.company_id = b.company_id');
			$query = $this->db->get();
		}
		return $query->result();
	}
	
	function get_num_timetables(){
		return $this->db->count_all('timetables');
	}
	
    function get_timetable($id){
		$query = $this->db->get_where('timetables',array("timetable_id" => $id));
		return $query->result();
	}
	
	function get_ctlist($id, $course_id, $section='A'){
		$this->db->order_by('start_time');
		$query = $this->db->get_where('batch_classtiming',array("batch_id" => $id, 'course_id'=>$course_id, 'section'=>$section));
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
    	$weekday_arr['course_id'] = empty($_POST['course_id']) ? '0': $_POST['course_id'];
    	$weekday_arr['batch_id'] = $_POST['batch_id'];
    	$this->db->insert('batch_weekdays', $weekday_arr);
    	//echo $this->db->last_query();
    }
    
    function ct_insert(){
    	$days = array('start_time', 'end_time');
    	$ct_arr = array(); 
    	$start_time = $_POST['start_time'];
    	$period_arr = array();
    	for($i=0 ; $i< $_POST['number_of_period']; $i++){
    		$end_time = Util::add_time($start_time, $_POST['time_slot']);
    		//echo 's:'.$start_time.' e:'.$end_time.'<br/>';
    		$is_break = (isset($_POST['is_break'])) ? 'Yes' : 'No';
    		$break_text = $_POST['break_text'];
    		$period_arr[] = array('start_time'=>$start_time, 'end_time'=>$end_time, 'break_text'=>$break_text, 'is_break'=>$is_break, 'course_id'=>$_POST['course_id'], 'batch_id'=>$_POST['batch_id'], 'section'=>$_POST['section']);
    		$start_time = $end_time;
    	}
    	
    	if(isset($_POST['delete_existing']) && $_POST['delete_existing'] == 'Y'){
    		$this->db->delete('batch_classtiming', array("batch_id" => $_POST['batch_id'], 'course_id'=>$_POST['course_id'], 'section'=>$_POST['section']));
    	}
    	$this->db->insert_batch('batch_classtiming', $period_arr);
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
    
    function get_subject_employee_by_batch($id,$course_id){
    	$this->db->select('bst.*, e.employee_name, s.subject_name');
    	$this->db->from('batch_subject_teacher bst');
    	$this->db->join('employees e','e.employee_id = bst.employee_id', 'LEFT');
    	$this->db->join('subjects s', 's.subject_id = bst.subject_id');
    	$this->db->where(array('bst.batch_id'=>$id, 'bst.course_id'=>$course_id));
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