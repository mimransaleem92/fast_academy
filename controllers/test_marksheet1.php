<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test_marksheet1 extends Base_Controller{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('test_marksheet1_model','',TRUE);
		
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
		$this->data['term'] = $term = (isset($_POST['term']) && !empty($_POST['term'])) ? $_POST['term'] : 1;
		
		$this->data['subject_id'] = $subject_id;
		
		if($admin_role == 1){
			$this->data['student_list'] = $this->test_marksheet1_model->get_student_by_class_section($course_id, $section);
			$this->data['subject_list'] = $this->test_marksheet1_model->get_all_subjects();
			$this->data['courses_list'] = Base_model::get_all_courses();
		}
		else{
				
			$this->data['subject_list'] = $ss = $this->test_marksheet1_model->get_subject_assigned();
			$this->data['courses_list'] = $cc = $this->test_marksheet1_model->get_courses_by_subject($subject_id);
				
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
			$this->data['student_list'] = $this->test_marksheet1_model->get_student_by_class_section($course_id, $section);
		}
		
		$this->data['student_list'] = $mark_detail = $this->test_marksheet1_model->get_marks($subject_id, $course_id, $section, $batch, $term);
		$total = $this->test_marksheet1_model->get_subject_total($subject_id, $course_id, $term);
		$subject_total = $total -> total_marks;
		$this->data['subject_total'] = $subject_total;
		$this->data['sent_on'] = $total -> message_sent_on;
		if($flag){
			$this->load_template('academic/test_exams/error_page');
		}
		else{
			$this->load_template('academic/test_exams/default');
		}
	}
	
	function add_marks(){
		$this->load->helper('form');
		if(isset($_GET['course_id']))
		{
			$row = $this->test_marksheet1_model->get_header_info($_GET['course_id'], $_GET['sid']);
			
			$title = explode(', ', $row[0]->marksheet_title);
			$score = explode(', ', $row[0]->marksheet_score);
			$this->data['header_title'] = $title;
			$this->data['header_score'] = $score;
			$this->data['col_average'] = $row[0]->average;
			$this->data['col_total'] = $row[0]->total;
		}	
			
		$student = $this->test_marksheet1_model->get_student_info($_GET['student_id']);
		$this->data['student'] = $student[0];
		
		$batch   = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course  = isset($_GET['course_id']) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_GET['section']) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		//$student_id, $subject_id, $course_id, $section, $batch, $term
		$this->data['marks'] = $mark = $this->test_marksheet1_model->get_subject_marks($_GET['student_id'], $_GET['sid'], $course, $section, $batch, $_GET['t']);
		//print_r($mark);
		$this->load->view('academic/test_exams/attend_mark',$this->data);
	}
	
	function add_marksave(){
		if(isset($_POST['f']) && $_POST['f'] == 'up'){
			$this->test_marksheet1_model->delete_marks();
			$obj = $this->test_marksheet1_model->insert_marks();
			$this->marksheet_list();
		}elseif(isset($_POST['f']) && $_POST['f'] == 'in'){
			$obj = $this->test_marksheet1_model->insert_marks();
			
			$this->marksheet_list();
		}
	}
	
	function marksave_inline(){
		if(isset($_POST['f']) && $_POST['f'] == 'up'){
			$this->test_marksheet1_model->delete_marks();
			$obj = $this->test_marksheet1_model->insert_marks();
			echo $_POST['obtained_marks'];
		}elseif(isset($_POST['f']) && $_POST['f'] == 'in'){
			$obj = $this->test_marksheet1_model->insert_marks();
			echo $_POST['obtained_marks'];
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
		
		$this->data['student_list'] = $mark_detail = $this->test_marksheet1_model->get_marks($subject_id, $course_id, $section, $batch, $term);
		$this->load->view('academic/test_exams/marksheet_list', $this->data);
	}
	
	function weekday(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->weekday_list();
	}
	
	function update_marks(){
		$this->load->helper('form');
		if(isset($_GET['course_id']))
		{
			$row = $this->test_marksheet1_model->get_header_info($_GET['course_id'], $_GET['sid']);
		}	
		
		$batch   = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course  = isset($_GET['course_id']) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_GET['section']) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		
		$subject_total_marks = $this->test_marksheet1_model->get_subject_total_marks($course, $batch, $_GET['t']);
		if(sizeof($subject_total_marks) == 0){
			$this->test_marksheet1_model->insert_subject_total_marks($course, $batch, $_GET['t']);
			$subject_total_marks = $this->test_marksheet1_model->get_subject_total_marks($course, $batch, $_GET['t']);
		}
		
		$this->data['marks'] = $subject_total_marks;
		
		$this->load->view('academic/test_exams/update_subject_total_marks',$this->data);
	}
	
	function update_marksave(){
		if(isset($_POST['course_id']) && $_POST['course_id'] > 8){
			$this->test_marksheet1_model->delete_total_marks();
			$this->test_marksheet1_model->insert_total_marks();	
		}
	}
		
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->test_marksheet1_model->insert();
			redirect('timetable','location');
		}
		else
		{
			$this->data['company_list'] = Base_model::get_all_companies();
			$this->load_template('academic/test_exams/add');
		} 
	}

	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['company_list'] = Base_model::get_all_companies();
		$this->data['form']  =  $this->test_marksheet1_model->get_timetable($id);
		$this->load_template('academic/test_exams/edit');
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
		$total =  $this->test_marksheet1_model->get_subject_total($subject_id, $course_id, $term);
		$subject_total = $total -> total_marks;
		$this->data['subject_total'] = $subject_total;
		$this->data['student_list'] = $mark_detail = $this->test_marksheet1_model->get_marks($subject_id, $course_id, $section, $batch, $term);
		$this->data['subject'] = $this->test_marksheet1_model->get_subject_name($subject_id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load->view('academic/test_exams/marksheet_print_view', $this->data);
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
		
		$this->data['student_list']   = $student_list   = $this->test_marksheet1_model->get_marks($subject_id, $course, $section, $batch, $term);
		$this->data['student_list10'] = $student_list10 = $this->test_marksheet1_model->get_marks($subject_id, $course+1, $section, $batch, $term);
		if(sizeof($student_list) > 30 || sizeof($student_list10) > 30){
			$this->data['student_list']   =  $this->test_marksheet1_model->get_marks($subject_id, $course_id, $section, $batch, $term);	
			$this->data['course10'] = $this->data['course'] = $course_id;
			
		}
		$this->data['subject'] = $this->test_marksheet1_model->get_subject_name($subject_id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load->view('academic/test_exams/marksheet_attendance_list', $this->data);
	}
	
	function send_sms(){
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id  = (isset($_GET['course_id'])) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_GET['section'])) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_GET['subject_id'])) ? $_GET['subject_id'] : $this->session->userdata(SESSION_CONST_PRE.'subject_id');
		$term = (isset($_GET['term'])) ? $_GET['term'] : date('m');
		
		$sender = "FAST Results" ;
		$arr_m = array('--','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		if(isset($_GET['course_id']) && !empty($_GET['course_id'])){

			$student_list = $this->test_marksheet1_model->get_marks($subject_id, $course_id, $section, $batch, $term);
			$subject = $this->test_marksheet1_model->get_subject_name($subject_id);
			$courses_list = Base_model::get_all_courses();
			
			foreach($courses_list as $course){
				if($course_id == $course->course_id) { $course_name = $course->course_name; break;}
			}
			$subject_name = $subject->subject_name;
			$subject_total = '25';
			
			$total = $this->test_marksheet1_model->get_subject_total($subject_id, $course_id, $term);
			$subject_total = $total -> total_marks; 
			foreach ($student_list as $student)
			{	
			    if( $student->message_sent == 'N' && isset($student->cell_phone_father) && strlen($student->cell_phone_father) == 12 && !empty($student->obtained_marks) ){
			        $student_name = substr($student->student_name, 0, 13);
					$mobile = $student->cell_phone_father;
					
					$message = "AOA". '\n';
					$message .= "Result of ".$student_name." for Test is as under\n";
					$message .= "Subject: ". $subject_name.  '\n';
					if($student->obtained_marks =='a'){
						$message .= " Absent " . '\n';
						continue;
					}else{	
						$message .= "Total Marks: ". $subject_total . '\n';
						$message .= "Obt'nd Marks: " . number_format($student->obtained_marks) . '\n';
					}
					$message .= "Principal". '\n';
					$message .= "FAST Haroonabad". '\n';
					$message .= "03336318287";
					//echo $message. strlen($message) . '<br>';
					
					$url = "http://bulksms.com.pk/api/sms.php?username=".SMS_API_USERNAME."&password=".SMS_API_PASSWORD."&sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message);

					//Curl start 
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
				    
					//Write out the response
					$sms_flag = explode(' ', $response);
					//echo $sms_flag[0]. $student_name . '<br/>';
					if($sms_flag[0] == 'OK'){
						$this->test_marksheet1_model->update_status($student->student_id, 'R'); 
					}
					Base_model::insert_message_log($course_id, $mobile, $message, 1, $sms_flag[0]);
				}
			}
		}
		$this->test_marksheet1_model->record_sms_sent_timestamp($course_id, $subject_id, $term, $batch);
		echo 'Successfully Sent <a href="'.base_url().$model.'/test_marksheet1" class="btn-sm" >Back</a>';
		//redirect('test_marksheet1?msg=1','location');
	}
	
	function sms_absent(){
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id  = (isset($_POST['course_id'])) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_POST['section'])) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : $this->session->userdata(SESSION_CONST_PRE.'subject_id');
		$term = (isset($_POST['term'])) ? $_POST['term'] : date('m');
		
		$sender = "FAST" ;
		if(isset($_POST['course_id']) && !empty($_POST['course_id'])){

			$subject = $this->test_marksheet1_model->get_subject_name($subject_id);
			$courses_list = Base_model::get_all_courses();
			
			foreach($courses_list as $course){
				if($course_id == $course->course_id) { $course_name = $course->course_name; break;}
			}
			$subject_name = $subject->subject_name;
			$id = $this->uri->segment(3);
			$student_list = $this->test_marksheet1_model->get_student_info($id);
			//print_r($student_list);
			foreach ($student_list as $student)
			{	
			    if( isset($student->cell_phone_father) && strlen($student->cell_phone_father) == 12  ){
			        
					$student_name = substr($student->student_name, 0, 13);
					$mobile = $student->cell_phone_father;
					
					$message = "AOA". '\n';
					//$message .= "Today ".$student_name." is not appear for the test".$term." of \n";
					$message .= "Today ".$student_name." is not appear for the test of \n";
					$message .= "Subject: ". $subject_name.  '\n';
					
					$message .= "Principal". '\n';
					$message .= "FAST Haroonabad". '\n';
					$message .= "03336318287";
					//echo $message. strlen($message) . '<br>';
					
					$url = "http://bulksms.com.pk/api/sms.php?username=".SMS_API_USERNAME."&password=".SMS_API_PASSWORD."&sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message);

					//Curl start 
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
				    
					//Write out the response
					$sms_flag = explode(' ', $response);
					//echo $sms_flag[0]. $student_name . '<br/>';
					Base_model::insert_message_log($course_id, $mobile, $message, 1, $sms_flag[0]);
					if($sms_flag[0] == 'OK'){
						$this->test_marksheet1_model->update_status($id);
					}
				}
			}
		}
		$this->test_marksheet1_model->record_sms_sent_timestamp($course_id, $subject_id, $term, $batch);
		echo 'SMS Sent';
	}
}