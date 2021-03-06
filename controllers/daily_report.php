<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daily_report extends Base_Controller{

	function daily_report()
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
		
		$subject_list = Base_model::get_all_subjects();
		foreach($subject_list as $s){
			$subject_id = $s->subject_id;
			$subject[$subject_id] = $s->subject_name;
		}
		$this->data['subjects'] = $subject;
	}
	
	function index(){
		//$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		//$from  = date('Y-m').'-01';
		$from = $to	= date('Y-m-d');
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['subject_list'] = Base_model::get_all_subjects();
		$this->data['form_detail']=$this->Reports_model->get_daily_report($from, $to);
		$this->data['model'] = 'daily_report';
		$this->load_template('reports/default');
	}
	
	function search(){
		$this->data['from'] = $from = $_POST['from_date'];
		$this->data['to'] = $to   = $_POST['to_date'];		
		$this->data['form_detail']=$this->Reports_model->get_daily_report($from, $to, $_POST);
		
		$this->load->view('reports/daily_report',$this->data);
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
		
		$this->data['form_detail']=$this->Reports_model->get_daily_report($from, $to, $_GET);
		$this->data['model'] = 'daily_report';
		$this->load_printhtml_tmpl('reports/daily_report');
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