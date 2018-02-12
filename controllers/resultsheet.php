<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resultsheet extends Base_Controller{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Resultsheet_model','',TRUE);
		
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
			$this->data['student_list'] = $this->Resultsheet_model->get_student_by_class_section($course_id, $section);
			//$this->data['subject_list'] = $this->Resultsheet_model->get_all_subjects();
			$this->data['subject_list'] = $this->Resultsheet_model->get_subject_total_marks($course_id, $batch, $term);
			$this->data['courses_list'] = Base_model::get_all_courses();
		}
		else{
				
			$this->data['subject_list'] = $ss = $this->Resultsheet_model->get_subject_assigned();
			$this->data['courses_list'] = $cc = $this->Resultsheet_model->get_courses_by_subject($subject_id);
				
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
			$this->data['student_list'] = $this->Resultsheet_model->get_student_by_class_section($course_id, $section);
		}
		$subject_total_marks = $this->Resultsheet_model->get_subject_total_marks($course_id, $batch, $term);
		$totals = array();
		
		if(sizeof($subject_total_marks) == 0){
			$this->Resultsheet_model->insert_subject_total_marks($course_id, $batch, $term);
		}
		
		foreach ($subject_total_marks as $r){
			$totals[$r->subject_id] = $r->total_marks;
		}
		$this->data['totals'] = $totals;
		
		$mark_detail = $this->Resultsheet_model->get_marks($course_id, $section, $batch, $term);
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][$m->subject_id] = $m->obtained_marks;
		}
		$this->data['marks'] = $marks;
		
		if($flag){
			$this->load_template('academic/exams/error_page');
		}
		else{
			$this->load_template('academic/exams/resultsheet');
		}
	}
	
	function update_marks(){
		$this->load->helper('form');
		if(isset($_GET['course_id']))
		{
			$row = $this->Resultsheet_model->get_header_info($_GET['course_id'], $_GET['sid']);
		}	
		
		$batch   = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course  = isset($_GET['course_id']) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_GET['section']) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		//$student_id, $subject_id, $course_id, $section, $batch, $term
		$this->data['marks'] = $mark = $this->Resultsheet_model->get_subject_total_marks($course, $batch, $_GET['t']);
		//print_r($mark);
		$this->load->view('academic/exams/update_subject_total_marks',$this->data);
	}
	
	function update_marksave(){
		if(isset($_POST['course_id']) && $_POST['course_id'] > 8){
			$this->Resultsheet_model->delete_marks();
			$obj = $this->Resultsheet_model->insert_marks();
			$batch = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
			$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
			$section = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
			$this->data['term'] = $term = (isset($_POST['term']) && !empty($_POST['term'])) ? $_POST['term'] : date('m');
		
			$this->data['student_list'] = $this->Resultsheet_model->get_student_by_class_section($course_id, $section);
			$this->data['subject_list'] = $this->Resultsheet_model->get_subject_total_marks($course_id, $batch, $term);
			$this->data['courses_list'] = Base_model::get_all_courses();
			
			$subject_total_marks = $this->Resultsheet_model->get_subject_total_marks($course_id, $batch, $term);
			$totals = array();
			
			if(sizeof($subject_total_marks) == 0){
				$this->Resultsheet_model->insert_subject_total_marks($course_id, $batch, $term);
			}
			
			foreach ($subject_total_marks as $r){
				$totals[$r->subject_id] = $r->total_marks;
			}
			$this->data['totals'] = $totals;
			
			$mark_detail = $this->Resultsheet_model->get_marks($course_id, $section, $batch, $term);
			$marks = array();
			foreach ($mark_detail as $m){
				$marks[$m->student_id][$m->subject_id] = $m->obtained_marks;
			}
			$this->data['marks'] = $marks;
			
			$this->load->view('academic/exams/resultsheet_list', $this->data);	
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
		
		$this->data['student_list'] = $mark_detail = $this->Resultsheet_model->get_marks($subject_id, $course_id, $section, $batch, $term);
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
			$this->Resultsheet_model->insert();
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
		$this->data['form']  =  $this->Resultsheet_model->get_timetable($id);
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
		$this->data['student_list'] = $this->Resultsheet_model->get_student_by_class_section($course_id, $section);
		$this->data['subject_list'] = $this->Resultsheet_model->get_subject_total_marks($course_id, $batch, $term);
		
		$subject_total_marks = $this->Resultsheet_model->get_subject_total_marks($course_id, $batch, $term);
		$totals = array();
		
		foreach ($subject_total_marks as $r){
			$totals[$r->subject_id] = $r->total_marks;
		}
		$this->data['totals'] = $totals;
		
		$mark_detail = $this->Resultsheet_model->get_marks($course_id, $section, $batch, $term);
		
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][$m->subject_id] = $m->obtained_marks;
		}
		$this->data['marks'] = $marks;
		
		$this->data['subject'] = $this->Resultsheet_model->get_subject_name($subject_id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load->view('academic/exams/resultsheet_print_view', $this->data);
	}
	
	function send_sms(){
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$sender = "FAST Notification" ;
		$arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$term = (isset($_GET['term'])) ? $_GET['term'] : date('m');

			$student_arr = explode(",", $_GET['selected_id']);
			foreach ($student_arr as $student_id)
			{	
				$res = $this->Resultsheet_model->get_student_result($student_id, $batch, $term);
				//var_dump($res);
		
				if( isset($res->cell_phone_father) ){
					$student_name = substr($res->student_name, 0, 13);
					$mobile = $res->cell_phone_father;
					$precentage = ( $res->marks * 100 )/ $res->totals . '\n';
					echo '13';
					$message = "AOA". '\n';
					$message .= "Result of ".$student_name." for ".$arr_m[$term]." Tests is as under\n";
					$message .= "Subject: ALL ". '\n';
					$message .= "Total Marks: " .$res->totals . '\n';
					$message .= "Obt'nd Marks: " . number_format($res->marks) . '\n';
					$message .= "%: " . number_format($precentage) . '\n';
					$message .= "Principal". '\n';
					$message .= "FAST Haroonabad". '\n';
					$message .= "03336318287";
					//echo $message. strlen($message);
					//die('ff');
					$url = "http://bulksms.com.pk/api/sms.php?username=".SMS_API_USERNAME."&password=".SMS_API_PASSWORD."&sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message);

					///Curl start 
					$ch = curl_init();
					$timeout = 30;
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt ($ch, CURLOPT_URL, $url);
					curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					
					$response = curl_exec($ch);
					if(curl_errno($ch))
						print curl_error($ch);
					else
						curl_close($ch);
					
					///Write out the response
					$sms_flag = explode(':', $response);
					echo $sms_flag[0]. '<br/>';
				}
			}
		}
		redirect('resultsheet','location');
	}
}