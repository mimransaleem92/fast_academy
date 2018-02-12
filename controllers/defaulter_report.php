<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class defaulter_report extends Base_Controller{

	function defaulter_report()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Reports_model','',TRUE);
		
		$clist = Base_model::get_all_courses();
		$course = array();
		foreach($clist as $c){
			$course_id = $c->course_id;
			$course[$course_id] = $c->course_name;
		}
		$this->data['courses'] = $course;
		$this->data['print'] = false;
	}
	
	function index(){
		//$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$financial_year = $this->session->userdata(SESSION_CONST_PRE.'financial_year');
		$year = explode('-', $financial_year);
		$from = $year[0].'-07-01';
		$to = $year[1].'-06-30';
		$today = date('Y-m-d');
		if($to > $today){
			$to = $today;
		}
		$this->data['from'] = $year[0].'-07-01';
		$this->data['to'] = $to;
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['form_detail']=$this->Reports_model->get_defaulter_report($from, $to);
		$this->data['model'] = 'defaulter_report';
		$this->load_template('reports/default');
	}
	
	function search(){
		$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$this->data['batch_name'] = $financial_year = Base_model::get_batch_name($b);
		 
		$year = explode('-', $financial_year);
		$from = $year[0].'-04-01';
		$to = $year[1].'-03-31';
		$today = date('Y-m-d');
		if($to > $today){
			$to = $today;
		}
		$this->data['from'] = $year[0].'-04-01';
		$this->data['to'] = $to;
		
		$this->data['form_detail'] = $this->Reports_model->get_defaulter_report($from, $to, $_POST);
		$this->load->view('reports/defaulter_report',$this->data);
	}
	
	function prints(){
		$b = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$this->data['batch_name'] = $financial_year = Base_model::get_batch_name($b);
		 
		$year = explode('-', $financial_year);
		$from = $year[0].'-07-01';
		$to = $year[1].'-06-30';
		$today = date('Y-m-d');
		if($to > $today){
			$to = $today;
		}
		$this->data['from'] = $year[0].'-07-01';
		$this->data['to'] = $to;
		$this->data['print'] = true;
		$this->data['form_detail']=$this->Reports_model->get_defaulter_report($from, $to, $_GET);
		$this->data['model'] = 'defaulter_report';
		$this->load_printhtml_tmpl('reports/defaulter_report');
	}

	function excel_old(){
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
		
		$this->data['form_detail']=$this->Reports_model->get_defaulter_report($from, $to, $_GET);	
		$this->data['model'] = 'defaulter_report';
		$this->load->view('reports/defaulter_report', $this->data);
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
		$b = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$batch_name = Base_model::get_batch_name($b);
			
		$year = explode('-', $batch_name);
		$from = $year[0].'-07-01';
		$to = $year[1].'-06-30';
		$today = date('Y-m-d');
		if($to > $today){
			$to = $today;
		}
		
		$this->data['from'] = $from;
		$this->data['to'] = $to;
		
		
		$form_detail = $this->Reports_model->get_defaulter_report($from, $to, $_GET);
		$this->data['model'] = 'defaulter_report';
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
			if(isset($_GET['batch_id']) && $_GET['batch_id'] != '') $search_string .= ''. Base_Controller::ToggleLang('Session').': '. $batch_name ;
		}
		
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('defaulter report');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Defaulter Report');
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
		->setCellValue('A2', '')
		->setCellValue('H2', 'DATE:'.date('d-m-Y H:i:s'));
		//->setCellValue('A2', 'From: '.Util::dateDisplayFormate($from).'  To:'.Util::dateDisplayFormate($to))
		
		$this->excel->getActiveSheet()->mergeCells('A3:G3');
		$this->excel->getActiveSheet()->mergeCells('H3:J3');
		$this->excel->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->setCellValue('A3', $search_string);
		
		/*----------------------------- Report Table Header -----------------------------*/
		$this->excel->getActiveSheet()
		->setCellValue('A4', '#')
		->setCellValue('B4', 'Admission #')
		->setCellValue('C4', 'Student Name')
		->setCellValue('D4', 'Grade/Sec')
		->setCellValue('E4', 'Total Due')
		->setCellValue('F4', 'Received')
		->setCellValue('G4', 'Discount')
		->setCellValue('H4', 'Balance')
		->setCellValue('I4', 'Father Contact')
		->setCellValue('J4', 'Mother Contact');
		/*---------------------------------------------------------------------------------*/
	
		$i=4; $msg_flag = TRUE;
		if(isset($form_detail) && sizeof($form_detail) > 0){
			$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			$fee_term = (isset($_POST['fee_term']) && !empty($_POST['fee_term'])) ? $_POST['fee_term'] : (($div_id == 2 ) ? '2' : '2.4');
			if(isset($_GET['fee_term']) && !empty($_GET['fee_term'])){
				$fee_term = $_GET['fee_term'];
			}
			foreach($form_detail as $values){
				$row_total_due = $values->total_due;
				if($values->batch_id != 7) {
					//continue;
				}
				else{
					$row_total_due = ($values->total_due)*(0.25)*($fee_term);
				}
				$row_pending = $row_total_due - $values->total_payment - $values->total_discount;
				//if($row_pending > $row_total_due*(0.15)){ // old check 
				if($row_pending > 0){
					$i++; $msg_flag = FALSE;
					
					$this->excel->getActiveSheet()
					->setCellValue('A'.$i, $i-4)
					->setCellValue('B'.$i, $values->admission_number)
					->setCellValue('C'.$i, $values->student_name)
					->setCellValue('D'.$i, $values->course_name. ' - ' . $values->section)
					->setCellValue('E'.$i, $row_total_due)
					->setCellValue('F'.$i, $values->total_payment)
					->setCellValue('G'.$i, $values->total_discount)
					->setCellValue('H'.$i, $row_pending)
					->setCellValue('I'.$i, $values->cell_phone_father)
					->setCellValue('J'.$i, $values->cell_phone_mother);
				}
			}
		}
		$this->excel->getActiveSheet()->setCellValue('H3', 'Total Students: '.($i-4));
		$i++;
		$this->excel->getActiveSheet()
		->setCellValue('A'.$i, "Total")
		->setCellValue('E'.$i, "=SUM(E5:E".($i-1).")")
		->setCellValue('F'.$i, "=SUM(F5:F".($i-1).")")
		->setCellValue('G'.$i, "=SUM(G5:G".($i-1).")")
		->setCellValue('H'.$i, "=SUM(H5:H".($i-1).")");
		$this->excel->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
		$this->excel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		/*---------------------------------------------------------------------------------*/
		$filename='defaulter_report_'.date('Ymd').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
	
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');	
	}
}