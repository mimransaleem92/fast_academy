<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quarterly_sheet extends Base_Controller{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Term_report_model','',TRUE);
		
	}
	
	function index(){
	
		$this->data['action_menu'] = FALSE;
		$curr_date = $date = date('Y-m-d');
		$division = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$batch    = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$this->data['term'] = $term = (isset($_POST['term'])) ? $_POST['term'] : 1;
		$this->data['term_list'] = $this->Term_report_model->get_term_list();
		
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['subject_id'] = $subject_id;
		/*
		 * In Girls branch no sections after 3 and
		 * In Boys branch no sections after 4
		 */
		if(($division == '1' && $course_id >= 8) || ($division == '2' && $course_id >= 7)){
			$section = '';
			$_POST['section'] = '';
		}
		
		//For top dropdown use in future
		$this->data['courses_list'] = Base_model::get_all_courses();
		$row = $this->Term_report_model->getTermSheet($course_id, $section, $term, $division);
		if(!isset($row[0])){
			$section_arr = array('A', 'B', 'C', ''); $i = 0;
			while(!isset($row[0])){
				$_POST['section'] = $section = $section_arr[$i];
				$row = $this->Term_report_model->getTermSheet($course_id, $section, $term, $division);
				if($i==3) break;
				$i++;
			}
		}
		$this->data['student_list'] = $row;
		if(isset($row[0])){
			$subject_count = $this->Term_report_model->getSubjectCount($course_id);
			$this->data['subject_count'] = $subject_count->id;
			$this->data['subjects_total'] = $subject_count->total;
			$this->load_template('academic/exams/quarterly_sheet');
		}
	}
	
	function print_all(){
	
		$this->data['action_menu'] = FALSE;
		$division = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$batch = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = (isset($_GET['course_id'])) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_GET['section'])) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$this->data['term'] = $term = (isset($_GET['term'])) ? $_GET['term'] : 1;
		$this->data['position'] = $this->Term_report_model->getTermSheet($course_id, $section, $term, $division);
		$courses = Base_model::get_all_courses();
		$course = array();
		foreach ($courses as $row){
			$course[$row->course_id]['course_name'] = $row->course_name;
			$course[$row->course_id]['course_name_ar'] = $row->course_name_ar;
		}
		$this->data['course'] = $course;
		
		$students = $this->Term_report_model->get_student_by_class_section($course_id, $section);
		foreach ($students as $student){
			$this->data['student_list'] = $student;
			$student_id = $student->student_id;
			$course_id = $student->course_id;
			$section = $student->section;
			
			// subject_list with marks titles, scores and credit hours info for the seclected class
			$this->data['subject_list'] = $row = $this->Term_report_model->get_subjects_info($course_id);
			$title = explode(', ', $row[0]->marksheet_title);
			$score = explode(', ', $row[0]->marksheet_score);
			$this->data['header_title'] = $title;
			$this->data['header_score'] = $score;
			$this->data['col_average'] = $row[0]->average;
			$this->data['col_total'] = $row[0]->total;
		
			$mark_detail = $this->Term_report_model->get_student_marks($student_id, $course_id, $section, $batch, $term);
			$marks = array();
			foreach ($mark_detail as $m){
				$marks[$m->student_id][$m->subject_id][0] = $m->field1;
				$marks[$m->student_id][$m->subject_id][1] = $m->field2;
				$marks[$m->student_id][$m->subject_id][2] = $m->field3;
				$marks[$m->student_id][$m->subject_id][3] = $m->field4;
				$marks[$m->student_id][$m->subject_id][4] = $m->field5;
				$marks[$m->student_id][$m->subject_id][5] = $m->field6;
				$marks[$m->student_id][$m->subject_id][6] = $m->field7;
				$marks[$m->student_id][$m->subject_id][7] = $m->field8;
			}
			$this->data['marks'] = $marks;
		
			$this->load->view('academic/exams/quarterly_report_print_all', $this->data);
		}
	}
}