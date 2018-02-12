<?php

class Exams_model extends Base_Model{
	
	function Exams_model(){
		parent::__construct();
		
	}
	
	public function get_batch_by($id){
		
		$q = "select * from exams where batch_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_exams($row = 0, $paging = FALSE){
		$this->db->select('e.*, b.batch_name, c.course_name');
		$this->db->from('exams e');
		$this->db->join('course c','e.course_id = c.course_id');
		$this->db->join('batches b','e.batch_id = b.batch_id');
		$this->db->order_by('b.batch_name,  e.exam_name'); 
		if($paging){
			$query = $this->db->get('',10,$row);
		}
		else 
		{	
			$query = $this->db->get('');
		} //echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_num_exams(){
		return $this->db->count_all('exams');
	}
	
    function get_exams($id){
		$query = $this->db->get_where('exams',array("id" => $id));
		return $query->result();
	}
	
	function get_exams_by_batch($id){
		$this->db->where(array("batch_id" => $id));
		$this->db->order_by('exam_name');
		$query = $this->db->get('exams');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_exams_by_id($id){
		$this->db->where(array("id" => $id));
		$query = $this->db->get('exams');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_exam_details_by($id){
		$this->db->where(array("id" => $id));
		$query = $this->db->get('exam_details');
	
		return $query->result();
	}
	
	function get_exam_subjects($exam_id){
		$this->db->select('ed.*, s.subject_name, s.subject_code');
		$this->db->from('exam_details ed');
		$this->db->join('subjects s','ed.subject_id = s.subject_id');
		$this->db->where('ed.exam_id', $exam_id);
		$this->db->order_by('s.subject_name');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	function get_exam_subject_scores($id, $student_id = 0){
		$this->db->select('ess.*, s.student_name');
		$this->db->from('exam_score_subject ess');
		$this->db->join('students s','ess.student_id = s.student_id');
		$this->db->where('ess.exam_detail_id', $id);
		if($student_id > 0){
			$this->db->where('s.student_id', $student_id);
		}
		$this->db->order_by('s.student_name');
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
	function insert()
    {
    	$batch_arr = $_POST;
        $this->db->insert('exams', $batch_arr);
        $batch_id = $this->db->insert_id(); 
    }
    
    function insert_exams(){
    	$_POST['exam_date'] = Util::dateSavingFormat($_POST['exam_date']);
    	$this->db->insert('exams', $_POST);
    	$batch_id = $this->db->insert_id();
    }
    
    function insert_scores(){
    	$score_arr = array();
    	$count = $_POST['subject_count'];
    	for($i=0; $i < $count; $i++)
    	{
    		if(isset($_POST['score_obtained'][$i]))
    		$score_arr[$i] = array ('exam_id'=>$_POST['exam_id'] , 'exam_detail_id'=>$_POST['exam_detail_id'] , 'score_obtained'=>$_POST['score_obtained'][$i] , 'remarks'=>$_POST['remarks'][$i], 'student_id'=>$_POST['student_id'][$i]);
    	}
    	$this->db->insert_batch('exam_score_subject', $score_arr);
    }
    
    function update_scores(){
    	$exam_arr = $_POST;
    	$id  = $_POST['exam_detail_id'];
    	$student_id  = $_POST['student_id'];
    	
    	unset($exam_arr['exam_detail_id']);
    	unset($exam_arr['exam_id']);
    	unset($exam_arr['student_id']);
    	unset($exam_arr['batch_id']);
    	unset($exam_arr['course_id']);
    	 
    	$this->db->where('exam_detail_id', $id);
    	$this->db->where('student_id', $student_id);
    	$this->db->update('exam_score_subject', $exam_arr);
    }
    
    function insert_schedule(){
    	$exam_arr = $_POST;
    	unset($exam_arr['batch_id']);
    	unset($exam_arr['course_id']);
    	$this->db->insert('exam_details', $exam_arr);
    }
    function update_exams(){
    	$_POST['exam_date'] = Util::dateSavingFormat($_POST['exam_date']);
    	$exam_arr = $_POST;
    	$id  = $_POST['id'];
    	unset($exam_arr['id']);
    	
    	$this->db->where('id', $id);
    	$this->db->update('exams', $exam_arr);
    }
	
    function update_schedule(){
    	//$_POST['start_date'] = Util::dateSavingFormat($_POST['start_date']);
    	//$_POST['end_date'] = Util::dateSavingFormat($_POST['end_date']);
    	$exam_arr = $_POST;
    	$id  = $_POST['id'];
    	unset($exam_arr['id']);
    	unset($exam_arr['batch_id']);
    	unset($exam_arr['course_id']);
    	
    	$this->db->where('id', $id);
    	$this->db->update('exam_details', $exam_arr);
    }
    
    function delete_schedule($id){
    	$this->db->where('id', $id);
    	$this->db->delete('exam_details');
    }
    
    function delete_exams($id){
    	$this->db->where('id', $id);
    	$this->db->delete('exams');
    	
    	$this->db->where('exam_id', $id);
    	$this->db->delete('exam_details');
    }
    
    function delete_scores($id){
    	$this->db->where('exam_detail_id', $id);
    	$this->db->delete('exam_score_subject');
    }
	
	function update()
    {
    	$batch_arr = $_POST;
    	$batch_id  = $_POST['batch_id'];
        unset($batch_arr['batch_id']);
        
        $this->db->where('batch_id', $batch_id);
    	$this->db->update('exams', $batch_arr);
    }
	
    function delete($exam_list)
    {	
    	$batch_arr = explode(",", $exam_list);
    	foreach ($batch_arr as $id)
    	{
	    	$this->db->where('id', $id);
	        $this->db->delete('exams');
    	}
    }
		
}