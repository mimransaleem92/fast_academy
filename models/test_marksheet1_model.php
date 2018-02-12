<?php
class test_marksheet1_model extends Base_Model{
	
	function __construct(){
		parent::__construct();
		
	}
	
	function get_calendar($id){
    	
		$this->db->select("*, DATE_FORMAT(start_date, '%d-%b-%Y') as start_dt, DATE_FORMAT(end_date, '%d-%b-%Y') as end_dt ", FALSE);
		$this->db->from('academic_calendar');
		$this->db->where(array("batch_id" => $id));
		$this->db->order_by('term, week_number');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	
	function get_header_info($course_id, $subject_id){
		$this->db->where(array("course_id" => $course_id, 'subject_id'=>$subject_id));
		$query = $this->db->get('course_subject');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_marks($subject_id, $course_id, $section, $batch, $term){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$this->db->select('s.student_name, s.admission_number, s.cell_phone_father, course_name, m.*');
		$this->db->from('students s');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->join('test_student_subject_monthly m','s.student_id = m.student_id');
		$this->db->where(array("s.course_id" => $course_id, 'm.subject_id'=>$subject_id, 's.section'=>$section, 'm.batch_id'=>$batch, 'm.month'=>$term));
		$this->db->where('s.division_id', $div_id);
		$this->db->where('s.cdel', '9');
		$this->db->order_by('s.student_name');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_subject_marks($student_id, $subject_id, $course_id, $section, $batch, $term){
		
		$this->db->where(array("student_id"=>$student_id, "course_id" => $course_id, 'subject_id'=>$subject_id, 'section'=>$section, 'batch_id'=>$batch, 'term'=>$term));
		$query = $this->db->get('marksheet');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function insert_marks(){
		$where = array ('student_id'=>$_POST['student_id'], 'subject_id'=>$_POST['subject_id'], 'batch_id'=>$_POST['batch_id'], 'month'=>$_POST['term']);
		//$main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');

		$this->db->where($where);
		$this->db->update('test_student_subject_monthly', array('obtained_marks'=>$_POST['obtained_marks']));
	}

	function delete_marks(){
		
		$this->db->where(array("student_id"=>$_POST['student_id'], 'subject_id'=>$_POST['subject_id'], "course_id" => $_POST['course_id'], 'section'=>$_POST['section'], 'batch_id'=>$_POST['batch_id'], 'term'=>$_POST['term']));
		$this->db->delete('marksheet');
	}
	
	function get_current_week($id){
		 
		$this->db->select("*, DATE_FORMAT(start_date, '%d-%b-%Y') as start_dt, DATE_FORMAT(end_date, '%d-%b-%Y') as end_dt ", FALSE);
		$this->db->from('academic_calendar');
		$this->db->where(array("batch_id" => $id));
		$this->db->where("DATE_FORMAT(CURDATE(), '%Y-%m-%d')>=start_date");
		$this->db->where("DATE_FORMAT(CURDATE(), '%Y-%m-%d')<=end_date");
		$this->db->order_by('term, week_number');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_week($batch, $week, $term){
			
		$this->db->select("*, DATE_FORMAT(start_date, '%d-%b-%Y') as start_dt, DATE_FORMAT(end_date, '%d-%b-%Y') as end_dt ", FALSE);
		$this->db->from('academic_calendar');
		$this->db->where(array("batch_id" => $batch, 'week_number'=>$week, 'term'=>$term));
		$this->db->order_by('term, week_number');
		$query = $this->db->get();
		
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
	
	function get_subject_assigned(){
		$batch_id = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$emp_id   = $this->session->userdata(SESSION_CONST_PRE.'employee_id');
		
		$this->db->select("DISTINCT cs.subject_id, s.subject_name", FALSE);
		$this->db->from('teacher_subject_course cs');
		$this->db->join('subjects s','cs.subject_id = s.subject_id');
		$this->db->where(array("cs.batch_id" => $batch_id, 'cs.employee_id'=>$emp_id));
		$this->db->order_by('cs.course_id');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_courses_by_subject($subject_id){
		$batch_id = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$emp_id   = $this->session->userdata(SESSION_CONST_PRE.'employee_id');
		
		$this->db->select("DISTINCT cs.course_id, c.course_name", FALSE);
		$this->db->from('teacher_subject_course cs');
		$this->db->join('courses c',"cs.course_id = c.course_id AND is_active='Y'");
		$this->db->where(array("cs.batch_id" => $batch_id, 'cs.employee_id'=>$emp_id, 'cs.subject_id'=>$subject_id));
		$this->db->order_by('cs.course_id');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	function get_subject_total_marks($course_id, $batch_id, $term, $subject_id = ''){
		
		
		$this->db->select("sm.*, s.subject_name, s.subject_code", FALSE);
		$this->db->from('test_subject_monthly_marks sm');
		$this->db->join('subjects s',"s.subject_id = sm.subject_id AND is_active='Y'");
		$this->db->where(array("batch_id" => $batch_id, 'course_id'=>$course_id, 'month'=>$term));
		if($subject_id != ''){
			$this->db->where('sm.subject_id', $subject_id);
		}
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function insert_subject_total_marks($course_id, $batch_id, $term){
		$sql =  "INSERT INTO test_subject_monthly_marks (course_id, batch_id, month, subject_id, total_marks)
			         (Select $course_id, $batch_id, $term, subject_id, 50 from subjects where is_active = 'Y');";
    		
    	$this->db->query($sql);
	}
	
	
	function insert_total_marks(){
		$batch_id   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		
		$subjects = $this->get_all_subjects();
		$values = array();
		foreach($subjects as $s){
			$values[] = array ('course_id'=>$_POST['course_id'], 'subject_id'=>$s->subject_id, 'batch_id'=>$batch_id, 'month'=>$_POST['term'], 'total_marks'=>$_POST['total_marks'.$s->subject_id]);
		}

		$this->db->insert_batch('test_subject_monthly_marks', $values);
	}
	
	function delete_total_marks(){
		$batch_id   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
			
		$this->db->where(array("course_id" => $_POST['course_id'], 'batch_id'=>$batch_id, 'month'=>$_POST['term']));
		$this->db->delete('test_subject_monthly_marks');
	}
	
	function get_subject_total($subject_id, $course_id, $term){
		$batch_id   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$this->db->where(array("course_id" => $course_id, 'subject_id'=>$subject_id, 'month'=>$term, 'batch_id'=>$batch_id));
		$query = $this->db->get('test_subject_monthly_marks');
		
		$result = $query->row();
		return $result;
	}
	
	function record_sms_sent_timestamp($course_id, $subject_id, $term, $batch_id){
	    
	    $this->db->query("UPDATE `test_subject_monthly_marks` SET `message_sent_on`=CURRENT_TIMESTAMP WHERE `course_id` = '".$course_id."' AND `subject_id` = '".$subject_id."' AND `month` = '".$term."' AND `batch_id` = '$batch_id'");
	   
	}
	
	function update_status($student_id){
		$batch_id   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$where = array ('student_id'=>$student_id, 'subject_id'=>$_POST['subject_id'], 'batch_id'=>$batch_id, 'month'=>$_POST['term']);
		
		$this->db->where($where);
		$this->db->update('test_student_subject_monthly', array('message_sent'=>'Y'));
	}
}