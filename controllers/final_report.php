<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Final_report extends Base_Controller{

	function Final_report()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Final_report_model','',TRUE);
		
	}
	
	function index(){
	
		$this->data['action_menu'] = FALSE;
		$curr_date = $date = date('Y-m-d');
		
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['subject_id'] = $subject_id;
		//For top dropdown use in future
		$this->data['courses_list'] = Base_model::get_all_courses();
		
		$student_id = (isset($_POST['admission_number']) && !empty($_POST['admission_number'])) ? $_POST['admission_number'] : NULL; // Grade-4 and F /2934;
		$this->data['student_list'] = $row = $this->Final_report_model->get_header_info($course_id, $section, $student_id);
		if(isset($row[0])){
			$student_id = $row[0]->student_id;
			$course_id = $row[0]->course_id;
			$section = $row[0]->section;
			//$this->data['student_list'] = $this->Final_report_model->get_student_by_class_section($course_id, $section, $student_id);
			
			// subject_list with marks titles, scores and credit hours info for the seclected class
			$this->data['subject_list'] = $row = $this->Final_report_model->get_subjects_info($course_id); 
			
			$mark_detail = $this->Final_report_model->get_student_marks($student_id, $course_id, $section, $batch);
			$marks = array();
			foreach ($mark_detail as $m){
				$marks[$m->student_id][$m->subject_id][$m->term] = $m->subject_obtained_marks;
			}
			$this->data['marks'] = $marks;
			
			$this->load_template('academic/exams/final_report');
		}
		else{
			$this->load_template('academic/exams/final_report_error');
		}
	}
	
	function add_marks(){
		$this->load->helper('form');
		if(isset($_GET['course_id']))
		{
			$row = $this->Final_report_model->get_header_info($_GET['course_id'], $_GET['sid']);
			
			$title = explode(', ', $row[0]->marksheet_title);
			$score = explode(', ', $row[0]->marksheet_score);
			$this->data['header_title'] = $title;
			$this->data['header_score'] = $score;
			$this->data['col_average'] = $row[0]->average;
			$this->data['col_total'] = $row[0]->total;
		}	
			
		$student = $this->Final_report_model->get_student_info($_GET['student_id']);
		$this->data['student'] = $student[0];
		$this->load->view('academic/exams/attend_mark',$this->data);
	}
	
	function add_marksave(){
		if(isset($_GET['f']) && $_GET['f'] == 'up'){
			$this->Final_report_model->delete_marks();
			
			
		}else{
			$obj = $this->Final_report_model->insert_marks();
			
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
		$row = $this->Final_report_model->get_header_info($course_id, $subject_id);
		
		$title = explode(', ', $row[0]->marksheet_title);
		$score = explode(', ', $row[0]->marksheet_score);
		$this->data['header_title'] = $title;
		$this->data['header_score'] = $score;
		$this->data['col_average'] = $row[0]->average;
		$this->data['col_total'] = $row[0]->total;
		
		$mark_detail = $this->Final_report_model->get_marks($subject_id, $course_id, $section, $batch, $term);
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
		
		$this->data['week_list'] = $row = $this->Final_report_model->get_current_week($batch);
		$this->data['curr_date']  = $curr_date;
		
		//$detail_list = $this->Final_report_model->get_attendance($date);
		$app_arr = array();
		if(isset($detail_list) && sizeof($detail_list) > 0){
			foreach($detail_list as $values){
				$ind = str_replace('-', '', $values->attendance_date);
				$app_arr[$ind][$values->student_id] = $values->attendance_comment;
			}
		}
		
		$this->data['attendance'] = $app_arr;
		$this->data['student_list'] = $this->Final_report_model->get_student_by_class_section($course_id, $section);
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
			$this->Final_report_model->insert();
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
		$this->data['form']  =  $this->Final_report_model->get_timetable($id);
		$this->load_template('academic/exams/edit');
	}
	
	function print_view(){
	
		$this->data['action_menu'] = FALSE;
		$curr_date = $date = date('Y-m-d');
	
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['subject_id'] = $subject_id;
		//For top dropdown use in future
		$courses = Base_model::get_all_courses();
		$course = array();
		foreach ($courses as $row){
			$course[$row->course_id]['course_name'] = $row->course_name;
			$course[$row->course_id]['course_name_ar'] = $row->course_name_ar;
		}
		$this->data['course'] = $course;
		$student_id = $this->uri->segment(3);
		if(!isset($student_id)){
			$student_id = (isset($_GET['admission_number']) && !empty($_GET['admission_number'])) ? $_GET['admission_number'] : NULL; // Grade-4 and F /2934;
		}
		$this->data['student_list'] = $row = $this->Final_report_model->get_header_info($course_id, $section, $student_id);
		if(!isset($row[0])){
			die('Invalid Student Info!!');
		}
		$student_id = $row[0]->student_id;
		$course_id = $row[0]->course_id;
		$section = $row[0]->section;
		//$this->data['student_list'] = $this->Final_report_model->get_student_by_class_section($course_id, $section, $student_id);
	
		// subject_list with marks titles, scores and credit hours info for the seclected class
		$this->data['subject_list'] = $row = $this->Final_report_model->get_subjects_info($course_id);
	
		//$mark_detail = $this->Final_report_model->get_student_marks($student_id, $course_id, $section, $batch);
		$mark_first = $this->Final_report_model->get_student_semester_marks($student_id, $course_id, $section, $batch);
		$mark_2nd   = $this->Final_report_model->get_student_semester_marks($student_id, $course_id, $section, $batch, 2);
		
		$marks = array();
		foreach ($mark_first as $m){
			$marks[$m->student_id][$m->subject_id][1] = $m->subject_obtained_marks;
		}
		
		foreach ($mark_2nd as $m){
			$marks[$m->student_id][$m->subject_id][2] = $m->subject_obtained_marks;
		}
		$this->data['marks'] = $marks;
	
		$this->load->view('academic/exams/final_report_print_view', $this->data);
	}
	
	function excel(){
		$course_id = $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = $this->session->userdata(SESSION_CONST_PRE.'section');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['subject_id'] = $subject_id;
		//For top dropdown use in future
		$courses = Base_model::get_all_courses();
		$course = array();
		foreach ($courses as $row){
			$course[$row->course_id]['course_name'] = $row->course_name;
			$course[$row->course_id]['course_name_ar'] = $row->course_name_ar;
		}
		$this->data['course'] = $course;
		$student_id = $this->uri->segment(3);
		if(!isset($student_id)){
			$student_id = (isset($_GET['admission_number']) && !empty($_GET['admission_number'])) ? $_GET['admission_number'] : NULL; // Grade-4 and F /2934;
		}
		$row = $this->Final_report_model->get_header_info($course_id, $section, $student_id);
		if(!isset($row[0])){
			die('Invalid Student Info!!');
		}
		$form = $student = $row[0];
		$student_id = $row[0]->student_id;
		$course_id = $row[0]->course_id;
		$section = $row[0]->section;
		$form_detail = null;//$this->Reports_model->get_daily_report($from, $to, $_GET);	
		$this->data['model'] = 'daily_report';
		
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('final report');
		$this->excel->getActiveSheet()->setCellValue('A1', 'Final Report');
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->mergeCells('A1:H1');
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		
		$i=2;
		/*----------------------------- Report Table Header 6 Rows -----------------------------*/
		$background_image = base_url()."assets/images/report_header_vis_final.jpg";
		$address_line2 = ($form->gender == 'M') ? "license_no_117s" : "license_no_4350140114";
		$header1 = array(APP_TITLE, "american_curriculum", $address_line2);
		foreach($header1 as $val){
			$this->excel->getActiveSheet()
			->setCellValue('A'.$i, ''.Base_Controller::ToggleLang($val))
			->setCellValue('C'.$i, '')
			->setCellValue('G'.$i, ''.Base_Controller::ToggleLang($val, 'ar'));
			$this->excel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
			$this->excel->getActiveSheet()->mergeCells('C'.$i.':F'.$i);
			$this->excel->getActiveSheet()->mergeCells('G'.$i.':H'.$i);
			$i++;
		}
		$report_title = $course[$form->course_id]['course_name'] . ' FINAL REPORT<br>'.Base_Controller::ToggleLang('reveal', 'ar').' '.
						$course[$form->course_id]['course_name_ar'];
		$this->excel->getActiveSheet()
		->setCellValue('A'.$i, ''.Base_Controller::ToggleLang('report_header'))
		->setCellValue('C'.$i, $report_title)
		->setCellValue('G'.$i, ''.Base_Controller::ToggleLang('report_header', 'ar'));
		$this->excel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
		$this->excel->getActiveSheet()->mergeCells('C'.$i.':F'.$i);
		$this->excel->getActiveSheet()->mergeCells('G'.$i.':H'.$i);
		$i++;
		/*---------------------------------------------------------------------------------*/
		$header_fields = array('student_name'=>'Student Name', 'nationality_en'=>'Nationality', 'date_of_birth'=>'Date of Birth', 'passport_id'=>'Passport No', 'iqama_id'=>'I D No', 'admission_date'=>'Admission Date', 'previous_school'=>'Previous School');
		foreach ($header_fields as $field=>$caption){
			$value_en = ($field == 'nationality_en') ? ''.$student->nationality_en : $student->$field;
			if(in_array($field, array('student_name', 'previous_school')) ) {
				$field_ar = $field.'_ar';
				$value_ar = $student->$field_ar;
			}
			elseif($field == 'nationality_en') $value_ar = $student->nationality_ar;
			else{
				$value_ar = Util::num($student->$field, 'ar');
			}
			$this->excel->getActiveSheet()
			->setCellValue('A'.$i, ''.Base_Controller::ToggleLang($caption).':'.$value_en )
			->setCellValue('C'.$i, '')
			->setCellValue('G'.$i, ''.Base_Controller::ToggleLang($caption, 'ar').':'.$value_ar);
			$this->excel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
			$this->excel->getActiveSheet()->mergeCells('C'.$i.':F'.$i);
			$this->excel->getActiveSheet()->mergeCells('G'.$i.':H'.$i);
			$i++;
		}
		/*---------------------------------------------------------------------------------*
		$msg_flag = TRUE; $total_payment = 0;
		if(isset($form_detail) && sizeof($form_detail) > 0){
			foreach($form_detail as $values){
				$i++; $msg_flag = FALSE;
				$total_payment += $values->payment_amount;
				$payment_detail = "";
				$payment_mode = $values->payment_mode;
				if($values->cheque_amount_second > 0) {
					$payment_mode .= ", ". $values->payment_mode_second;
					$payment_detail  = $values->payment_mode.":".$values->cheque_amount;
					$payment_detail .= ", ".$values->payment_mode_second.":".$values->cheque_amount_second;
				}
		
				 
				
				$this->excel->getActiveSheet()
				->setCellValue('A'.$i, $i-2)
				->setCellValue('B'.$i, $values->admission_number)
				->setCellValue('C'.$i, $values->student_name)
				->setCellValue('D'.$i, $values->course_name. ' - ' . $values->section)
				->setCellValue('E'.$i, $values->fee_desc)
				->setCellValue('F'.$i, $values->pdate)
				->setCellValue('G'.$i, $payment_mode)
				->setCellValue('H'.$i, $values->cheque_amount);
				
			}
		}
		$i++;
		$this->excel->getActiveSheet()
		->setCellValue('A'.$i, "Total")
		->setCellValue('H'.$i, "=SUM(H3:H".($i-1).")")
		->setCellValue('I'.$i, "=SUM(I3:I".($i-1).")")
		->setCellValue('J'.$i, number_format($total_payment, 2, '.', ''));
		$this->excel->getActiveSheet()->mergeCells('A'.$i.':G'.$i);
		$this->excel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		/*---------------------------------------------------------------------------------*/
		$filename='final_report_'.date('Ymd').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
		/*---------------------------------------------------------------------------------*/
		
		//$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		
		//$this->load->view('reports/daily_report_excel', $this->data);
	}
	
}