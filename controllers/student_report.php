<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_report extends Base_Controller{

	function student_report()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Reports_model','',TRUE);
		
		$clist = Base_model::get_all_courses();
		foreach($clist as $c){
			$course_id = $c->course_id;
			$course[$course_id] = $c->course_name;
		}
		$this->data['courses'] = $course;
	}
	
	function index(){
		//$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		//$from  = date('Y-m').'-01';
		$from = $to	= date('Y-m-d');
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['form_detail']=$this->Reports_model->get_student_report($from, $to);
		$this->data['model'] = 'student_report';
		$this->load_template('reports/default');
	}
	
	function search(){		
		$this->data['from'] = $from = $_POST['from_date'];
		$this->data['to'] = $to   = $_POST['to_date'];		
		$this->data['form_detail']=$this->Reports_model->get_student_report($from, $to, $_POST);
		$this->load->view('reports/student_report',$this->data);
	}
	
	function prints(){
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
		
		$this->data['form_detail']=$this->Reports_model->get_student_report($from, $to, $_GET);
		$this->data['model'] = 'student_report';
		$this->load_printhtml_tmpl('reports/student_report');
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
		
		$search_date = Base_Controller::ToggleLang('Admission Date').': '. Util::displayFormat($from) .' to '. Util::displayFormat($to) .' ';
		
		$form_detail = $this->Reports_model->get_student_report($from, $to, $_GET);
		$this->data['model'] = 'student_history';
		$cours = $this->data['courses'];
		$search_string = '';
		if(!is_null($_GET)){
			if(isset($_GET['course_id']) && $_GET['course_id'] != '' && $_GET['course_id_to'] != ''){
				if($_GET['course_id'] != $_GET['course_id_to']){
					$search_string .=''. Base_Controller::ToggleLang('course').': '. $cours[$_GET['course_id']]. ' to ' . $cours[$_GET['course_id_to']] .' ';
				}
				else{
					$search_string .= ''. Base_Controller::ToggleLang('course').': '. $cours[$_GET['course_id']].' ';
				}
			}
			if(isset($_GET['section']) && $_GET['section'] != '')  $search_string .= ''. Base_Controller::ToggleLang('Section').': '. $_GET['section'] .' ';
			if(isset($_GET['payment_mode']) && $_GET['payment_mode'] != '') $search_string .= ''. Base_Controller::ToggleLang('Payment Mode').': '. $_GET['payment_mode'].' ' ;
			if(isset($_GET['fee_desc']) && $_GET['fee_desc'] != '') $search_string .= ''. Base_Controller::ToggleLang('Fee Type').': '. $_GET['fee_desc'] ;
		}
		
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('student report');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Student Report');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:J1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		$this->excel->getActiveSheet()->mergeCells('A2:G2');
		$this->excel->getActiveSheet()->mergeCells('H2:J2');
		$this->excel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()
		->setCellValue('A2', $search_date)
		->setCellValue('H2', 'DATE:'.date('d-m-Y H:i:s'));
		//->setCellValue('A2', 'From: '.Util::dateDisplayFormate($from).'  To:'.Util::dateDisplayFormate($to))
		
		$this->excel->getActiveSheet()->mergeCells('A3:G3');
		$this->excel->getActiveSheet()->mergeCells('H3:J3');
		$this->excel->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()
		->setCellValue('A3', $search_string)
		->setCellValue('H3', 'Total Students: '.sizeof($form_detail));
		
		/*----------------------------- Report Table Header -----------------------------*/
		$this->excel->getActiveSheet()
		->setCellValue('A4', '#')
		->setCellValue('B4', 'Admission #')
		->setCellValue('C4', 'Student Name')
		->setCellValue('D4', 'Grade/Sec')
		->setCellValue('E4', 'Nationalty')
		->setCellValue('F4', 'DOB')
		->setCellValue('G4', 'Passport #')
		->setCellValue('H4', 'ID No')
		->setCellValue('I4', 'Admission Date')
		->setCellValue('J4', 'Previus School')
		->setCellValue('K4', 'Father Contact')
		->setCellValue('L4', 'Mother Contact');
		/*---------------------------------------------------------------------------------*/
	
		$i=4; $msg_flag = TRUE;
		if(isset($form_detail) && sizeof($form_detail) > 0){
			foreach($form_detail as $values){
				$i++; $msg_flag = FALSE;
				
				$this->excel->getActiveSheet()
				->setCellValue('A'.$i, $i-4)
				->setCellValue('B'.$i, $values->admission_number)
				->setCellValue('C'.$i, $values->student_name)
				->setCellValue('D'.$i, $values->course_name. ' - ' . $values->section)
				->setCellValue('E'.$i, $values->country_name)
				->setCellValue('F'.$i, $values->date_of_birth)
				->setCellValue('G'.$i, $values->passport_id)
				->setCellValue('H'.$i, $values->iqama_id)
				->setCellValue('I'.$i, $values->admission_date)
				->setCellValue('J'.$i, '')
				->setCellValue('K'.$i, $values->cell_phone_father)
				->setCellValue('L'.$i, $values->cell_phone_mother);
	
			}
		}
		/*---------------------------------------------------------------------------------*/
		$filename='student_report_'.date('Ymd').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
	
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}
}