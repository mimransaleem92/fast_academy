<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quarterly_report extends Base_Controller{

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
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['subject_id'] = $subject_id;

		//For top dropdown use in future
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['term'] = $term = (isset($_POST['term'])) ? $_POST['term'] : 1;
		$this->data['position'] = $this->Term_report_model->getTermSheet($course_id, $section, $term, $division);
		$this->data['term_list'] = $this->Term_report_model->get_term_list();

		$student_id = (isset($_POST['admission_number']) && !empty($_POST['admission_number'])) ? $_POST['admission_number'] : NULL; // Grade-4 and F /2934;
		$this->data['student_list'] = $row = $this->Term_report_model->get_header_info($course_id, $section, $student_id);
		if(isset($row[0])){
			$student_id = $row[0]->student_id;
			//$this->data['student_list'] = $this->Term_report_model->get_student_by_class_section($course_id, $section, $student_id);

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

			$this->load_template('academic/exams/quarterly_report_card');
		}
		else{
			$this->load_template('academic/exams/term_report_error');
		}
	}

	function add_marks(){
		$this->load->helper('form');
		if(isset($_GET['course_id']))
		{
			$row = $this->Term_report_model->get_header_info($_GET['course_id'], $_GET['sid']);

			$title = explode(', ', $row[0]->marksheet_title);
			$score = explode(', ', $row[0]->marksheet_score);
			$this->data['header_title'] = $title;
			$this->data['header_score'] = $score;
			$this->data['col_average'] = $row[0]->average;
			$this->data['col_total'] = $row[0]->total;
		}

		$student = $this->Term_report_model->get_student_info($_GET['student_id']);
		$this->data['student'] = $student[0];
		$this->load->view('academic/exams/attend_mark',$this->data);
	}

	function add_marksave(){
		if(isset($_GET['f']) && $_GET['f'] == 'up'){
			$this->Term_report_model->delete_marks();


		}else{
			$obj = $this->Term_report_model->insert_marks();

			$this->marksheet_list();
		}
	}

	function marksheet_list(){

		$curr_date = $date = date('Y-m-d');

		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['term'] = $term = (isset($_POST['term'])) ? $_POST['term'] : 1;
		$this->data['course'] = $course_id;
		$this->data['subject_id'] = $subject_id;
		$row = $this->Term_report_model->get_header_info($course_id, $subject_id);

		$title = explode(', ', $row[0]->marksheet_title);
		$score = explode(', ', $row[0]->marksheet_score);
		$this->data['header_title'] = $title;
		$this->data['header_score'] = $score;
		$this->data['col_average'] = $row[0]->average;
		$this->data['col_total'] = $row[0]->total;

		$mark_detail = $this->Term_report_model->get_marks($subject_id, $course_id, $section, $batch, $term);
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][0] = $m->field1;
			$marks[$m->student_id][1] = $m->field2;
			$marks[$m->student_id][2] = $m->field3;
			$marks[$m->student_id][3] = $m->field4;
			$marks[$m->student_id][4] = $m->field5;
			$marks[$m->student_id][5] = $m->field6;
			$marks[$m->student_id][6] = $m->field7;
			$marks[$m->student_id][7] = $m->field8;
		}
		$this->data['marks'] = $marks;

		$this->data['week_list'] = $row = $this->Term_report_model->get_current_week($batch);
		$this->data['curr_date']  = $curr_date;

		//$detail_list = $this->Term_report_model->get_attendance($date);
		$app_arr = array();
		if(isset($detail_list) && sizeof($detail_list) > 0){
			foreach($detail_list as $values){
				$ind = str_replace('-', '', $values->attendance_date);
				$app_arr[$ind][$values->student_id] = $values->attendance_comment;
			}
		}

		$this->data['attendance'] = $app_arr;
		$this->data['student_list'] = $this->Term_report_model->get_student_by_class_section($course_id, $section);
		$this->load->view('academic/exams/marksheet_list', $this->data);
	}

	function weekday(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->weekday_list();
	}

	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name','alfa_numeric|min_length[3]|required');

		if($this->form_validation->run() == TRUE){
			$this->Term_report_model->insert();
			redirect('timetable','location');
		}
		else
		{
			$this->data['company_list'] = Base_model::get_all_companies();
			$this->load_template('academic/exams/add');
		}
	}

	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');

		$id = $this->uri->segment(3);
		$this->data['company_list'] = Base_model::get_all_companies();
		$this->data['form']  =  $this->Term_report_model->get_timetable($id);
		$this->load_template('academic/exams/edit');
	}

	function print_view(){

		$this->data['action_menu'] = FALSE;
		$curr_date = $date = date('Y-m-d');
		$division = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['subject_id'] = $subject_id;

		$courses = Base_model::get_all_courses();
		$course = array();
		foreach ($courses as $row){
			$course[$row->course_id]['course_name'] = $row->course_name;
			$course[$row->course_id]['course_name_ar'] = $row->course_name_ar;
		}
		$this->data['course'] = $course;
		$this->data['term'] = $term = (isset($_GET['term'])) ? $_GET['term'] : 1;

		$student_id = $this->uri->segment(3);
		if(empty($student_id)){
			$student_id = (isset($_GET['admission_number']) && !empty($_GET['admission_number'])) ? $_GET['admission_number'] : NULL;
		}
		$this->data['student_list'] = $row = $this->Term_report_model->get_header_info($course_id, $section, $student_id);

		if(!isset($row[0])){
			die('Invalid Student Info!!');
		}
		$student_id = $row[0]->student_id;
		$course_id = $row[0]->course_id;
		$section = $row[0]->section;
		$this->data['position'] = $this->Term_report_model->getTermSheet($course_id, $section, $term, $division);
		//$this->data['student_list'] = $this->Term_report_model->get_student_by_class_section($course_id, $section, $student_id);

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

		$this->load->view('academic/exams/quarterly_report_print_view', $this->data);
	}

}
