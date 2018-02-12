<?php

class Subjects_model extends Base_Model{
	
	function Subjects_model(){
		parent::__construct();
		
	}
	
	public function get_subject_by($id){
		
		$q = "select * from subjects where subject_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_subjects($row = 0, $paging = FALSE){
		$this->db->order_by('report_order');
		if($paging){
			$query = $this->db->get('subjects',10,$row);
		}
		else 
		{	
			$query = $this->db->get('subjects');
		}//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_num_subjects(){
		return $this->db->count_all('subjects');
	}
	
    function get_subject($id){
		$query = $this->db->get_where('subjects',array("subject_id" => $id));
		return $query->result();
	}
	
	function get_subject_headers($subject_id){
		$this->db->select('cs.*, c.course_name, c.course_name_ar, cs.period_per_week, cs.credit_hours');
		$this->db->from('course_subject cs');
		$this->db->join('courses c','cs.course_id = c.course_id');
		$this->db->where('cs.subject_id', $subject_id);
		$this->db->order_by('c.course_id');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	function update_course_subject(){
		$title = $score = '';
		for($i=1; $i <= 8; $i++)
		{
			if(isset($_POST['field'.$i]) && $_POST['field'.$i] != '')
			{
				$title .= ', '. trim($_POST['field'.$i]);
				$score .= ', '. trim($_POST['score'.$i]);
			}
		}
		
		if($title != ''){
			$subject_arr['marksheet_title'] = substr($title, 2);
			$subject_arr['marksheet_score'] = substr($score, 2);
			
			$this->db->where(array('subject_id'=> $_POST['subject_id'], 'course_id'=>$_POST['course_id']));
			$this->db->update('course_subject', $subject_arr);
		}
	}
	
	function insert()
    {
    	$subject_arr = $_POST;
        $this->db->insert('subjects', $subject_arr);
        $subject_id = $this->db->insert_id(); 
    }
    
    function insert_employee(){
    	$emp_arr = $_POST;
    	$f = $this->db->insert('subject_employee', $emp_arr);
    	return $f;
    }
    
    function delete_employee(){
    	if(isset($_POST['employee_id']) && isset($_POST['subject_id'])){
    		$this->db->where('employee_id', $_POST['employee_id']);
    		$this->db->where('subject_id',$_POST['subject_id']);
    		$this->db->delete('subject_employee');
    	}
    }
    
	function update()
    {
    	$subject_arr = $_POST;
    	$subject_id  = $_POST['subject_id'];
        unset($subject_arr['subject_id']);
        
        $this->db->where('subject_id', $subject_id);
    	$this->db->update('subjects', $subject_arr);
    }
	
    function delete($subject_list)
    {	
    	$subject_arr = explode(",", $subject_list);
    	foreach ($subject_arr as $subject_id)
    	{
	    	$this->db->where('subject_id', $subject_id);
	        $this->db->delete('subjects');
    	}
    }
		
}