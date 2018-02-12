<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marksheet extends Base_Controller{

	function Marksheet()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Marksheet_model','',TRUE);
		
	}
	
	function index(){
	
		$this->data['action_menu'] = FALSE;
		$curr_date = $date = date('Y-m-d');
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$admin_role = $this->session->userdata(SESSION_CONST_PRE.'role_id');
		
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : $this->session->userdata(SESSION_CONST_PRE.'subject_id');
		$this->data['term'] = $term = (isset($_POST['term']) && !empty($_POST['term'])) ? $_POST['term'] : date('m', strtotime("-1 month"));
		
		$this->data['subject_id'] = $subject_id;
		
		if($admin_role == 1){
			$this->data['student_list'] = $this->Marksheet_model->get_student_by_class_section($course_id, $section);
			$this->data['subject_list'] = $this->Marksheet_model->get_all_subjects();
			$this->data['courses_list'] = Base_model::get_all_courses();
		}
		else{
				
			$this->data['subject_list'] = $ss = $this->Marksheet_model->get_subject_assigned();
			$this->data['courses_list'] = $cc = $this->Marksheet_model->get_courses_by_subject($subject_id);
				
			$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $cc[0]->course_id;
			$f = true;
			foreach ($cc as $g){
				if($g->course_id == $_POST['course_id']) $f = false;
			}
			if($f){
				$course_id = $cc[0]->course_id;
			}else{
				$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $cc[0]->course_id;
			}
			$_POST['course_id'] = $course_id;
			/*
			 * In Girls branch no sections after 3 and 
			 * In Boys branch no sections after 4
			 */
			if(($div_id == '1' && $course_id >= 8) || ($div_id == '2' && $course_id >= 7)){
				$section = '';
				$_POST['section'] = '';
			}
			$this->data['student_list'] = $this->Marksheet_model->get_student_by_class_section($course_id, $section);
		}
		
		$this->data['student_list'] = $mark_detail = $this->Marksheet_model->get_marks($subject_id, $course_id, $section, $batch, $term);
		
		if($flag){
			$this->load_template('academic/exams/error_page');
		}
		else{
			$this->load_template('academic/exams/default');
		}
	}
	
	function add_marks(){
		$this->load->helper('form');
		if(isset($_GET['course_id']))
		{
			$row = $this->Marksheet_model->get_header_info($_GET['course_id'], $_GET['sid']);
			
			$title = explode(', ', $row[0]->marksheet_title);
			$score = explode(', ', $row[0]->marksheet_score);
			$this->data['header_title'] = $title;
			$this->data['header_score'] = $score;
			$this->data['col_average'] = $row[0]->average;
			$this->data['col_total'] = $row[0]->total;
		}	
			
		$student = $this->Marksheet_model->get_student_info($_GET['student_id']);
		$this->data['student'] = $student[0];
		
		$batch   = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course  = isset($_GET['course_id']) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_GET['section']) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		//$student_id, $subject_id, $course_id, $section, $batch, $term
		$this->data['marks'] = $mark = $this->Marksheet_model->get_subject_marks($_GET['student_id'], $_GET['sid'], $course, $section, $batch, $_GET['t']);
		//print_r($mark);
		$this->load->view('academic/exams/attend_mark',$this->data);
	}
	
	function add_marksave(){
		if(isset($_POST['f']) && $_POST['f'] == 'up'){
			$this->Marksheet_model->delete_marks();
			$obj = $this->Marksheet_model->insert_marks();
			$this->marksheet_list();
		}elseif(isset($_POST['f']) && $_POST['f'] == 'in'){
			$obj = $this->Marksheet_model->insert_marks();
			
			$this->marksheet_list();
		}
	}
	
	function marksheet_list(){
		
		$curr_date = $date = date('Y-m-d');
		
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id  = (isset($_POST['course_id'])) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_POST['section'])) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['term'] = $term = (isset($_POST['term'])) ? $_POST['term'] : 1;
		
		$this->data['course'] = $course_id; 
		$this->data['subject_id'] = $subject_id;
		
		$this->data['student_list'] = $mark_detail = $this->Marksheet_model->get_marks($subject_id, $course_id, $section, $batch, $term);
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
			$this->Marksheet_model->insert();
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
		$this->data['form']  =  $this->Marksheet_model->get_timetable($id);
		$this->load_template('academic/exams/edit');
	}
	
	function print_view(){
	
		$curr_date = $date = date('Y-m-d');

		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$admin_role = $this->session->userdata(SESSION_CONST_PRE.'role_id');
		
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id  = (isset($_GET['course_id'])) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_GET['section'])) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_GET['subject_id'])) ? $_GET['subject_id'] : $this->session->userdata(SESSION_CONST_PRE.'subject_id');
		$this->data['term'] = $term = (isset($_GET['term'])) ? $_GET['term'] : date('m');

		$this->data['course'] = $course_id;
		$this->data['subject_id'] = $subject_id;
		
		$this->data['student_list'] = $mark_detail = $this->Marksheet_model->get_marks($subject_id, $course_id, $section, $batch, $term);
		$this->data['subject'] = $this->Marksheet_model->get_subject_name($subject_id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load->view('academic/exams/marksheet_print_view', $this->data);
	}

	function attendance_list(){
	
		$curr_date = $date = date('Y-m-d');

		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$admin_role = $this->session->userdata(SESSION_CONST_PRE.'role_id');
		
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id  = (isset($_GET['course_id'])) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_GET['section'])) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_GET['subject_id'])) ? $_GET['subject_id'] : $this->session->userdata(SESSION_CONST_PRE.'subject_id');
		$this->data['term'] = $term = (isset($_GET['term'])) ? $_GET['term'] : date('m');

		$this->data['subject_id'] = $subject_id;
		$this->data['course'] = $course = ($course_id < 11) ? 9 : 11; 
		$this->data['course10'] = $course+1;
		
		$this->data['student_list']   = $student_list   = $this->Marksheet_model->get_marks($subject_id, $course, $section, $batch, $term);
		$this->data['student_list10'] = $student_list10 = $this->Marksheet_model->get_marks($subject_id, $course+1, $section, $batch, $term);
		if($student_list > 30 || $student_list10 > 30){
			$this->data['student_list']   =  $this->Marksheet_model->get_marks($subject_id, $course_id, $section, $batch, $term);	
			$this->data['course10'] = $this->data['course'] = $course_id;
			
		}
		$this->data['subject'] = $this->Marksheet_model->get_subject_name($subject_id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load->view('academic/exams/marksheet_attendance_list', $this->data);
	}
}