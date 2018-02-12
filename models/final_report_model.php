<?php
class Final_report_model extends Base_Model{
	
	function Final_report_model(){
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
	
	
	function get_header_info($course, $section='', $student_id=null){
		$this->db->select('students.*, country.country_name, country.country_ar, `country`.`nationality` as nationality_en, country.nationality_ar, course_name, course_name_ar, b.batch_name, b.batch_name_hijri');
		$this->db->from('students');
		$this->db->join('courses c', 'c.course_id = students.course_id');
		$this->db->join('batches b', 'students.batch_id=b.batch_id');
		$this->db->join('country', 'country.id = students.country_id', 'LEFT');
		
		if($student_id != null){
			$id = (is_numeric($student_id)) ? 'students.student_id' : 'students.admission_number';
			$this->db->where($id, $student_id);
		}else{
			$div_id   = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			$this->db->where('students.course_id', $course);
			$this->db->where('students.section', $section);
			$this->db->where('students.division_id', $div_id);
			$this->db->limit(1);
		}
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_subjects_info($course_id){
		$this->db->select('subjects.subject_name, subjects.subject_name_arabic, course_subject.*');
		$this->db->from('subjects');
		$this->db->join('course_subject', 'subjects.subject_id = course_subject.subject_id');
		
		$this->db->where(array("course_subject.course_id" => $course_id, 'course_subject.subject_id <>'=>0));
		$this->db->order_by('subjects.report_order');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_student_marks($student_id, $course_id, $section, $batch){
		$this->db->select('m.*, (m.field1+m.field2+m.field3+m.field4+m.field5+m.field6+m.field7+m.field8) as subject_obtained_marks', 'FALSE');
		$this->db->from('marksheet m');
		$this->db->where(array("course_id" => $course_id, 'student_id'=>$student_id, 'section'=>$section, 'batch_id'=>$batch));
		$this->db->order_by('term');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}	
	
	function getFinalSheet($course_id, $section, $division){
		
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $course_id; 
		$section   = isset($_POST['section']) ? $_POST['section'] : $section;
		
		$this->db->select('s.student_id, s.admission_number, s.student_name, s.course_id, s.section, c.course_name, b.batch_name, SUM(field1+field2+field3+field4+field5+field6+field7+field8) as obtain_marks', FALSE);
		$this->db->from('students s');
		$this->db->join('marksheet m', 's.student_id=m.student_id and s.course_id=m.course_id and s.section=m.section', 'LEFT');
		$this->db->join('courses c', 's.course_id=c.course_id');
		$this->db->join('batches b', 's.batch_id=b.batch_id');
		$this->db->group_by('s.student_id');
		$this->db->order_by('s.student_id');
		
		$this->db->where(array("s.course_id" => $course_id, 's.section'=>$section, 's.division_id'=>$division));
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_student_semester_marks($student_id, $course_id, $section, $batch, $semester=1){
		$this->db->select('m.*, SUM(m.field1+m.field2+m.field3+m.field4+m.field5+m.field6+m.field7+m.field8)/4 as subject_obtained_marks', 'FALSE');
		$this->db->from('marksheet m');
		$this->db->where(array("course_id" => $course_id, 'student_id'=>$student_id, 'section'=>$section, 'batch_id'=>$batch));
		if($semester == 1) {
			$this->db->where('m.term <', 3);
		}else{
			$this->db->where('m.term >=', 3);
		}
		$this->db->group_by('m.student_id, m.subject_id');
		$this->db->order_by('term');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function getFirstSemester($course_id, $section, $division){
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $course_id;
		$section   = isset($_POST['section']) ? $_POST['section'] : $section;
		
		$this->db->select('s.student_id, m.subject_id, s.admission_number, s.student_name, s.course_id, s.section, c.course_name, b.batch_name, SUM(field1+field2+field3+field4+field5+field6+field7+field8) / 4 as obtain_mark', FALSE);
		$this->db->from('students s');
		$this->db->join('marksheet m', 's.student_id=m.student_id and s.course_id=m.course_id and s.section=m.section', 'LEFT');
		$this->db->join('courses c', 's.course_id=c.course_id');
		$this->db->join('batches b', 's.batch_id=b.batch_id');
		$this->db->group_by('s.student_id, m.subject_id');
		$this->db->order_by('s.student_id');
		$this->db->where(array("s.course_id" => $course_id, 's.section'=>$section, 's.division_id'=>$division, "m.term <" => '3', "m.subject_id <" => 25));
		
		$subquery = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('*, SUM(obtain_mark) as obtain_marks', FALSE);
		$this->db->from("($subquery) ss");
		$this->db->group_by('ss.student_id');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}

	function getSecondSemester($course_id, $section, $division){
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $course_id;
		$section   = isset($_POST['section']) ? $_POST['section'] : $section;
		
		$this->db->select('s.student_id, m.subject_id, s.admission_number, s.student_name, s.course_id, s.section, c.course_name, b.batch_name, SUM(field1+field2+field3+field4+field5+field6+field7+field8) / 4 as obtain_mark', FALSE);
		$this->db->from('students s');
		$this->db->join('marksheet m', 's.student_id=m.student_id and s.course_id=m.course_id and s.section=m.section', 'LEFT');
		$this->db->join('courses c', 's.course_id=c.course_id');
		$this->db->join('batches b', 's.batch_id=b.batch_id');
		$this->db->group_by('s.student_id, m.subject_id');
		$this->db->order_by('s.student_id');
		$this->db->where(array("s.course_id" => $course_id, 's.section'=>$section, 's.division_id'=>$division, "m.term >=" => '3', "m.subject_id <" => 25));
		
		$subquery = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('*, SUM(obtain_mark) as obtain_marks', FALSE);
		$this->db->from("($subquery) ss");
		$this->db->group_by('ss.student_id');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function getSubjectCount($course_id){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
		$query  = $this->db->query("select count(subject_id) as id from course_subject where credit_hours > 0 and course_id='".$course_id."'");
		$result = $query->result();
		$subject_count = $result[0]->id;
		
		return $subject_count;
	}
}