<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gazettesheet extends Base_Controller{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Gazettesheet_model','',TRUE);
		
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
			$this->data['student_list'] = $this->Gazettesheet_model->get_student_by_class_section($course_id, $section, 9);
			//$this->data['subject_list'] = $this->Gazettesheet_model->get_all_subjects();
			$this->data['subject_list'] = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
			$this->data['courses_list'] = Base_model::get_all_courses();
		}
		else{
				
			$this->data['subject_list'] = $ss = $this->Gazettesheet_model->get_subject_assigned();
			$this->data['courses_list'] = $cc = $this->Gazettesheet_model->get_courses_by_subject($subject_id);
				
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
			$this->data['student_list'] = $this->Gazettesheet_model->get_student_by_class_section($course_id, $section, 9);
		}
		$subject_total_marks = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
		$totals = array();
		
		if(sizeof($subject_total_marks) == 0){
			$this->Gazettesheet_model->insert_subject_total_marks($course_id, $batch, $term);
		}
		
		foreach ($subject_total_marks as $r){
			$totals[$r->subject_id] = $r->total_marks;
		}
		$this->data['totals'] = $totals;
		
		$mark_detail = $this->Gazettesheet_model->get_marks($course_id, $section, $batch, $term);
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][$m->subject_id]['marks'] = $m->marks;
			$marks[$m->student_id][$m->subject_id]['subject_total'] = $m->subject_total;
		}
		$this->data['marks'] = $marks;
		
		if($flag){
			$this->load_template('academic/test_exams/error_page');
		}
		else{
			$this->load_template('academic/test_exams/gazettesheet');
		}
	}
	
	function update_marks(){
		$this->load->helper('form');
		if(isset($_GET['course_id']))
		{
			$row = $this->Gazettesheet_model->get_header_info($_GET['course_id'], $_GET['sid']);
		}	
		
		$batch   = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course  = isset($_GET['course_id']) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = isset($_GET['section']) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		//$student_id, $subject_id, $course_id, $section, $batch, $term
		$this->data['marks'] = $mark = $this->Gazettesheet_model->get_subject_total_marks($course, $batch, $_GET['t']);
		//print_r($mark);
		$this->load->view('academic/exams/update_subject_total_marks',$this->data);
	}
	
	function update_marksave(){
		if(isset($_POST['course_id']) && $_POST['course_id'] > 8){
			$this->Gazettesheet_model->delete_marks();
			$obj = $this->Gazettesheet_model->insert_marks();
			$batch = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
			$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
			$section = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
			$this->data['term'] = $term = (isset($_POST['term']) && !empty($_POST['term'])) ? $_POST['term'] : date('m');
		
			$this->data['student_list'] = $this->Gazettesheet_model->get_student_by_class_section($course_id, $section);
			$this->data['subject_list'] = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
			$this->data['courses_list'] = Base_model::get_all_courses();
			
			$subject_total_marks = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
			$totals = array();
			
			if(sizeof($subject_total_marks) == 0){
				$this->Gazettesheet_model->insert_subject_total_marks($course_id, $batch, $term);
			}
			
			foreach ($subject_total_marks as $r){
				$totals[$r->subject_id] = $r->total_marks;
			}
			$this->data['totals'] = $totals;
			
			$mark_detail = $this->Gazettesheet_model->get_marks($course_id, $section, $batch, $term);
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
		
		$this->data['student_list'] = $mark_detail = $this->Gazettesheet_model->get_marks($subject_id, $course_id, $section, $batch, $term);
		$this->load->view('academic/exams/marksheet_list', $this->data);
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
		$this->data['student_list'] = $this->Gazettesheet_model->get_student_by_class_section($course_id, $section, 9);
		$this->data['subject_list'] = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
		//echo $course_name = Base_model::get_course_name($course_id);
		$subject_total_marks = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
		$totals = array();
		
		foreach ($subject_total_marks as $r){
			$totals[$r->subject_id] = $r->total_marks;
		}
		$this->data['totals'] = $totals;
		
		$mark_detail = $this->Gazettesheet_model->get_marks($course_id, $section, $batch, $term);
		
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][$m->subject_id]['marks'] = $m->marks;
			$marks[$m->student_id][$m->subject_id]['subject_total'] = $m->subject_total;
		}
		$this->data['marks'] = $marks;
		
		$this->data['subject'] = $this->Gazettesheet_model->get_subject_name($subject_id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load->view('academic/test_exams/gazettesheet_print_view', $this->data);
	}
	
	function excel1(){
	
		
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id  = (isset($_GET['course_id'])) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_GET['section'])) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$term = (isset($_GET['term'])) ? $_GET['term'] : date('m');
		
		$subject_list = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
		$col = chr( 65 + sizeof($subject_list)*2+4 );
		
		$this->load->library('excel');
		PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		//PHPExcel_Settings::setCacheStorageMethod();
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Gazette Sheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Gazette Sheet');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:'.$col.'1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		
		$this->excel->getActiveSheet()
		->setCellValue('A2', '')
		->setCellValue(chr( 65 + sizeof($subject_list)*2 ).'2', 'Dated: '. date('m F Y H:i'));
		
		/*----------------------------- Report Table Header -----------------------------*/
		$this->excel->getActiveSheet()
		->setCellValue('A3', '#')
		->setCellValue('B3', 'Admission #')
		->setCellValue('C3', 'Student Name')
		->setCellValue('D3', 'Obtain Marks');
		$this->excel->getActiveSheet()->mergeCells('D3:'.$col.'3');
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		$c = 68;
		foreach($subject_list as $sub){
			$sid = $sub->subject_id;
			$sel = ($subject_id == $sid) ? 'selected' : '';
			
			$this->excel->getActiveSheet()
			->setCellValue(chr($c++).'4', 'Total')
			->setCellValue(chr($c++).'4', ''.$sub->subject_code);
		}
		$this->excel->getActiveSheet()
		->setCellValue(chr($c++).'4', 'Total')
		->setCellValue(chr($c++).'4', '%age');
		
		/*---------------------------------------------------------------------------------*/
		$filename = 'gazettesheet_'.date('YmdHis').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		
		$objWriter->save('php://output');
		
		//$this->load->view('reports/test_fee_report_excel', $this->data);
	}
	
	function excel(){
	
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id'); 
		$div_name = ($div_id == 1) ? 'Boys' : 'Girls';
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id  = (isset($_GET['course_id'])) ? $_GET['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = (isset($_GET['section'])) ? $_GET['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		$term = (isset($_GET['term'])) ? $_GET['term'] : date('m');
		
		$student_list = $this->Gazettesheet_model->get_student_by_class_section($course_id, $section, 9);
		$subject_list = $this->Gazettesheet_model->get_subject_total_marks($course_id, $batch, $term);
		$course_name = array(9=>'9th', 10=>'10th', 11=>'Ist Year', 12=>'2nd Year');
		$mark_detail = $this->Gazettesheet_model->get_marks($course_id, $section, $batch, $term);
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][$m->subject_id]['marks'] = $m->marks;
			$marks[$m->student_id][$m->subject_id]['subject_total'] = $m->subject_total;
		}
		$marks_arr = array();
		$col = chr( 65 + sizeof($subject_list)*2+4 );
		
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Gazette Sheet');
		$this->excel->getActiveSheet()->setCellValue('A1', 'Gazette Sheet');
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->mergeCells('A1:'.$col.'1');
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		/*---------------------------------------------------------------------------------*/
		
		$this->excel->getActiveSheet()
		->setCellValue('B2', 'Class: '.$course_name[$course_id]. ' ' . $div_name)
		->setCellValue(chr( 65 + sizeof($subject_list)*2 ).'2', 'Dated: '. date('m F Y H:i'));
		$this->excel->getActiveSheet()->mergeCells('B2:C2');
		/*----------------------------- Report Table Header -----------------------------*/
		
		$this->excel->getActiveSheet()
		->setCellValue('A3', '#')
		->setCellValue('B3', 'Admission #')
		->setCellValue('C3', 'Student Name')
		->setCellValue('D3', 'Obtain Marks');
		$this->excel->getActiveSheet()->mergeCells('D3:'.$col.'3');
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		$c = 68;
		foreach($subject_list as $sub){
			$sid = $sub->subject_id;
			$sel = ($subject_id == $sid) ? 'selected' : '';
			
			$this->excel->getActiveSheet()
			->setCellValue(chr($c++).'4', 'Total')
			->setCellValue(chr($c++).'4', ''.$sub->subject_code);
		}
		$this->excel->getActiveSheet()
		->setCellValue(chr($c++).'4', 'Total')
		->setCellValue(chr($c++).'4', '%age');
		$this->excel->getActiveSheet()->getStyle('A2:'.chr($c).'4')->getFont()->setBold(true);
		
		$i=4; $msg_flag = TRUE; $total_payment = 0;
		$marks_arr = array(); 
		if(isset($student_list) && sizeof($student_list) > 0){
			$s=0; 
			foreach ($student_list as $student){
				$student_id = $student->student_id;
				$s++; $i++; $msg_flag = FALSE;
				$c = 68; $row_total = $row_obtain = 0;
				$this->excel->getActiveSheet()
				->setCellValue('A'.$i, $i-4)
				->setCellValue('B'.$i, ''.$student->admission_number)
				->setCellValue('C'.$i, ''.$student->student_name);
				
				foreach($subject_list as $sub){ 
					$sid = $sub->subject_id;
					if(isset($marks[$student->student_id][$sid]) && $marks[$student->student_id][$sid] !== 'a' ){
						$row_obtain += $marks[$student->student_id][$sid]['marks'];
						$row_total += $marks[$student->student_id][$sid]['subject_total'];
					}
					$sub_total = isset($marks[$student->student_id][$sid]) ? $marks[$student->student_id][$sid]['subject_total'] : '--';
					$sub_marks = isset($marks[$student->student_id][$sid]) ? $marks[$student->student_id][$sid]['marks'] : '--';
					$this->excel->getActiveSheet()
					->setCellValue(chr($c++).$i, $sub_total)
					->setCellValue(chr($c++).$i, $sub_marks);
				}
				$tt = number_format(($row_obtain / $row_total) * 100, 2);
				$this->excel->getActiveSheet()
				->setCellValue(chr($c++).$i, $row_obtain. ' / ' .$row_total)
				->setCellValue(chr($c).$i, $tt);
				$marks_arr[chr($c).$i] = $tt;
			}
			
			arsort($marks_arr); $cc = 0; $test = '';
			foreach($marks_arr as $in => $mark){
				$this->excel->getActiveSheet()->getStyle($in)->getFont()->setBold(true);
				$cc++;
				if($cc == 3) break;
			}
		}
		//$this->excel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		/*---------------------------------------------------------------------------------*/
		$filename='gazettesheet_'.date('YmdHis').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		
		$objWriter->save('php://output');
		
		//$this->load->view('reports/test_fee_report_excel', $this->data);
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
				$res = $this->Gazettesheet_model->get_student_result($student_id, $batch, $term);
				//var_dump($res); die;
				if( isset($res->cell_phone_father) ){
					$student_name = substr($res->student_name, 0, 13);
					$mobile = $res->cell_phone_father;
					$precentage = ( $res->marks * 100 )/ $res->totals . '\n';
					 
					$message = "AOA". '\n';
					$message .= "Result of ".$student_name." for Test Session is as under\n";
					$message .= "Subject: ALL ". '\n';
					$message .= "Total Marks: " .$res->totals . '\n';
					$message .= "Obt'nd Marks: " . number_format($res->marks) . '\n';
					$message .= "%: " . number_format($precentage, 2) . '\n';
					$message .= "Principal". '\n';
					$message .= "FAST Haroonabad". '\n';
					$message .= "03336318287";
					#echo $message;
					#$sms_flag = array('OK','77989');
					$sms_flag = $this->send_message($mobile, $message);
					Base_model::insert_message_log($res->course_id, $mobile, $message, 1, $sms_flag[0]);
					if($sms_flag[0] == 'OK'){
						$this->Gazettesheet_model->update_message_count($student_id);
					}
				}
			}
		}
		redirect('gazettesheet','location');
	}
}