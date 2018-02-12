<?php

class Courses_model extends Base_Model{
	
	function Courses_model(){
		parent::__construct();
	}
	
	public function get_course_by($id){
		
		$q = "select * from courses where course_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_courses($row = 0, $paging = FALSE){
		
		if($paging){
			$query = $this->db->get('courses',10,$row);
		}
		else 
		{	
			$query = $this->db->get('courses');
		}//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_num_courses(){
		return $this->db->count_all('courses');
	}
	
    function get_course($id){
		$query = $this->db->get_where('courses',array("course_id" => $id));
		return $query->result();
	}
	
	function insert()
    {
    	$course_arr = $_POST;
        $this->db->insert('courses', $course_arr);
        $course_id = $this->db->insert_id(); 
    }
	
	function insert_subject(){
		$course_arr = $_POST;
		$f = $this->db->insert('course_subject', $course_arr);
		return $f;
	}
	
	function delete_subject(){
		if(isset($_POST['course_id']) && isset($_POST['subject_id'])){
			$this->db->where('course_id', $_POST['course_id']);
			$this->db->where('subject_id',$_POST['subject_id']);
			$this->db->delete('course_subject');
		}
	}
	function update()
    {
    	$course_arr = $_POST;
    	$course_id  = $_POST['course_id'];
        unset($course_arr['course_id']);
        
        $this->db->where('course_id', $course_id);
    	$this->db->update('courses', $course_arr);
    }
	
    function delete($course_list)
    {	
    	$course_arr = explode(",", $course_list);
    	foreach ($course_arr as $course_id)
    	{
	    	$this->db->where('course_id', $course_id);
	        $this->db->delete('courses');
    	}
    }
		
}