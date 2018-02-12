<?php

class idcards_model extends Base_Model{
	
	function idcards_model(){
		parent::__construct();
		
	}
	
	function get_students_by_batch($id){
		$this->db->select('s.student_id, s.batch_id, s.course_id, s.student_name, pd.printed_date');
		$this->db->from('students s');
		$this->db->join('printed_documents pd',"s.student_id = pd.student_id and s.batch_id = pd.batch_id and pd.document_name='Student ID Card'", 'LEFT');
		$this->db->where('s.batch_id', $id);
		$this->db->order_by('s.student_name');
		$query = $this->db->get();//echo $str = $this->db->last_query();
	
		return $query->result();
	}
	
	function insert_printed_documents($student_id, $course_id, $batch_id, $type='Student ID Card'){
		
		$form = array('student_id'=>$student_id, 'course_id' => $course_id, 'batch_id'=>$batch_id,'document_name' => $type );
		$this->db->insert('printed_documents', $form);
	}
}