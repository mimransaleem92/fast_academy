<?php

class Grading_levels_model extends Base_Model{
	
	function Grading_levels_model(){
		parent::__construct();
		
	}
	
	function get_grades_by_batch($id){
		$this->db->where(array("batch_id" => $id));
		$this->db->order_by('grade_name');
		$query = $this->db->get('batch_grading_level');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function insert_default_grading(){
		$this->db->where('batch_id', $_POST['batch_id']);
		$this->db->delete('batch_grading_level');
		$i = 0; $grades = array();
		$grade_arr = array('A'=>90, 'B'=>80, 'C'=>70, 'D'=>60, 'E'=>50, 'F'=>40);
		foreach ($grade_arr as $ind=>$val){ 
			$grades[$i] = array('batch_id'=>$_POST['batch_id'], 'course_id'=>$_POST['course_id'], 'grade_name'=>$ind, 'min_scores'=>$val);
			$i++;
		}
		$this->db->insert_batch('batch_grading_level', $grades);
	}
	
	function insert_grading(){
		
		$grades = array('batch_id'=>$_POST['batch_id'], 'course_id'=>$_POST['course_id'], 'grade_name'=>$_POST['grade_name'], 'min_scores'=>$_POST['min_scores']);
			
		$this->db->insert('batch_grading_level', $grades);
	}
	
	function update_grading(){
	
		$grades = array('grade_name'=>$_POST['grade_name'], 'min_scores'=>$_POST['min_scores']);
		$this->db->where('batch_id', $_POST['batch_id']);
		$this->db->where('grade_name', $_POST['grade_name_old']);
		$this->db->update('batch_grading_level', $grades);
	}
    
    function delete_grading($batch_id, $grade){
    	$this->db->where('batch_id', $batch_id);
    	$this->db->where('grade_name', $grade);
    	$this->db->delete('batch_grading_level');
    }
		
}