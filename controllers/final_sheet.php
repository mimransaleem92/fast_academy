<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Final_sheet extends Base_Controller{

	function Final_sheet()
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
		$division = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$batch    = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		
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
		//$this->data['student_list'] = $row = $this->Final_report_model->getFinalSheet($course_id, $section, $division);
		$row = $this->Final_report_model->getFirstSemester($course_id, $section, $division);
		if(!isset($row[0])){
			$section_arr = array('A', 'B', 'C', ''); $i = 0;
			while(!isset($row[0])){
				$_POST['section'] = $section = $section_arr[$i];
				$row = $this->Final_report_model->getFirstSemester($course_id, $section, $division);
				if($i==3) break;
				$i++;
			}
		}
		$this->data['student_list'] = $row;
		$student_list2 = $this->Final_report_model->getSecondSemester($course_id, $section, $division);
		$semester2 = array();
		foreach($student_list2 as $row2){
			$semester2[$row2->student_id]['obtain_marks'] = $row2->obtain_marks;
		}
		$this->data['semester2'] = $semester2;
		if(isset($row[0])){
			$this->data['subject_count'] = $this->Final_report_model->getSubjectCount($course_id);
			
			$this->load_template('academic/exams/final_sheet');
		}
		else{
			$this->load_template('academic/exams/final_report_error');
		}
	}
	
	function print_all(){
	
		$this->data['action_menu'] = FALSE;
		$division = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$batch = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = (isset($_GET['course_id'])) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_GET['section'])) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		
		$courses = Base_model::get_all_courses();
		$course = array();
		foreach ($courses as $row){
			$course[$row->course_id]['course_name'] = $row->course_name;
			$course[$row->course_id]['course_name_ar'] = $row->course_name_ar;
		}
		$this->data['course'] = $course;
		
		$students = $this->Final_report_model->get_student_by_class_section($course_id, $section);
		foreach ($students as $student){
			$this->data['student_list'] = $student;
			$student_id = $student->student_id;
			$course_id = $student->course_id;
			$section = $student->section;
			
			// subject_list with marks titles, scores and credit hours info for the seclected class
			$this->data['subject_list'] = $row = $this->Final_report_model->get_subjects_info($course_id);
			$title = explode(', ', $row[0]->marksheet_title);
			$score = explode(', ', $row[0]->marksheet_score);
			$this->data['header_title'] = $title;
			$this->data['header_score'] = $score;
			$this->data['col_average'] = $row[0]->average;
			$this->data['col_total'] = $row[0]->total;
		
			//$mark_detail = $this->Final_report_model->get_student_marks($student_id, $course_id, $section, $batch, $term);
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
			
			$this->load->view('academic/exams/final_report_print_all', $this->data);
		}
	}
	
	function excel(){
		if(isset($_GET['from_date'])){
			$from = $_GET['from_date'];
			$to   = $_GET['to_date'];
		}
		else
		{
			$from = $to	= date('Y-m-d');
		}
		$this->data['from'] = $from;
		$this->data['to'] = $to;
		
		$form_detail = $this->Reports_model->get_daily_report($from, $to, $_GET);	
		$this->data['model'] = 'daily_report';
		
		$this->load->library('excel');
		//PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		//PHPExcel_Settings::setCacheStorageMethod();
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('fee collection report');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Fee Collection Report');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:J1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		
		$this->excel->getActiveSheet()
		->setCellValue('A2', '#')
		->setCellValue('J2', 'Amount');
		
		/*----------------------------- Report Table Header -----------------------------*/
		$this->excel->getActiveSheet()
		->setCellValue('A2', '#')
		->setCellValue('B2', 'Admission #')
		->setCellValue('C2', 'Student Name')
		->setCellValue('D2', 'Grade/Sec')
		->setCellValue('E2', 'Fee Detail')
		->setCellValue('F2', 'Payment Date')
		->setCellValue('G2', 'Payment Mode')
		->setCellValue('H2', 'Mode 1')
		->setCellValue('I2', 'Mode 2')
		->setCellValue('J2', 'Amount')
		->setCellValue('K2', 'Father Contact')
		->setCellValue('L2', 'Mother Contact');
		/*---------------------------------------------------------------------------------*/
		
		$i=2; $msg_flag = TRUE; $total_payment = 0;
		 
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
				->setCellValue('H'.$i, $values->cheque_amount)
				->setCellValue('I'.$i, $values->cheque_amount_second)
				->setCellValue('J'.$i, $values->payment_amount)
				->setCellValue('K'.$i, $values->cell_phone_father)
				->setCellValue('L'.$i, $values->cell_phone_mother);
				
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
		$filename='fee_collection_report_'.date('Ymd').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		
		$objWriter->save('php://output');
		
		//$this->load->view('reports/daily_report_excel', $this->data);
	}
}