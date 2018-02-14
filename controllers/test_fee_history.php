<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test_fee_history extends Base_Controller{

	function __construct()
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
	}
	
	function index(){
		//$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		//$from  = date('Y-m').'-01';
		$this->data['action_menu'] = FALSE;
		$from = $to	= date('Y-m-d');
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['form_detail']=$this->Reports_model->get_test_fee_history($from, $to);
		$this->data['model'] = 'test_fee_history';
		$this->load_template('reports/default');
	}
	
	function search(){		
		$this->data['from'] = $from = $_POST['from_date'];
		$this->data['to'] = $to   = $_POST['to_date'];
		$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$this->data['batch_name'] = Base_model::get_batch_name($b);
		$this->data['form_detail']=$this->Reports_model->get_test_fee_history($from, $to, $_POST);
		$this->load->view('reports/test_fee_history',$this->data);
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
		$b = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$this->data['batch_name'] = Base_model::get_batch_name($b);
		$this->data['form_detail']=$this->Reports_model->get_test_fee_history($from, $to, $_GET);
		$this->data['model'] = 'test_fee_history';
		$this->load_printhtml_tmpl('reports/test_fee_history');
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
		
		$this->data['form_detail']=$this->Reports_model->get_test_fee_history($from, $to, $_GET);	
		$this->data['model'] = 'test_fee_history';
		$this->load->view('reports/test_fee_history', $this->data);
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
	
		$form_detail = $this->Reports_model->get_test_fee_history($from, $to, $_GET);
		$this->data['model'] = 'test_fee_history';
		$cours = $this->data['courses'];
		$search_string = ' ';
		$b = isset($_GET['batch_id']) ? $_GET['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$batch_name = Base_model::get_batch_name($b);
		
		if(!is_null($_GET)){
			if(isset($_GET['course_id']) && $_GET['course_id'] != '' && $_GET['course_id_to'] != ''){
				if($_GET['course_id'] != $_GET['course_id_to']){
					$search_string .=', '. Base_Controller::ToggleLang('course').': '. $cours[$_GET['course_id']]. ' to ' . $cours[$_GET['course_id_to']];
				}
				else{
					$search_string .= ', '. Base_Controller::ToggleLang('course').': '. $cours[$_GET['course_id']];
				}
			}
			if(isset($_GET['section']) && $_GET['section'] != '')  $search_string .= ', '. Base_Controller::ToggleLang('Section').': '. $_GET['section'];
			if(isset($_GET['payment_mode']) && $_GET['payment_mode'] != '') $search_string .= ', '. Base_Controller::ToggleLang('Payment Mode').': '. $_GET['payment_mode'];
			if(isset($_GET['fee_desc']) && $_GET['fee_desc'] != '') $search_string .= ', '. Base_Controller::ToggleLang('Fee Type').': '. $_GET['fee_desc'];
		}
		$search_string .= ', '. Base_Controller::ToggleLang('Session').': '. $batch_name;
		$search_string = trim(substr($search_string, 2));
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('pending fee report');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Pending fee Report');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:K1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		$this->excel->getActiveSheet()->mergeCells('A2:G2');
		$this->excel->getActiveSheet()->mergeCells('H2:K2');
		$this->excel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()
		->setCellValue('A2', '')
		->setCellValue('H2', 'DATE:'.date('d-m-Y H:i:s'));
		//->setCellValue('A2', 'From: '.Util::dateDisplayFormate($from).'  To:'.Util::dateDisplayFormate($to))
		
		$this->excel->getActiveSheet()->mergeCells('A3:G3');
		$this->excel->getActiveSheet()->mergeCells('H3:K3');
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
		->setCellValue('E4', 'Fee Outstanding')
		->setCellValue('F4', 'Fee For the Year')
		->setCellValue('G4', 'Total Due')
		->setCellValue('H4', 'Received Outstanding')
		->setCellValue('I4', 'Received For Fee of Year')
		->setCellValue('J4', 'Discount')
		->setCellValue('K4', 'Balance')
		->setCellValue('L4', 'Father Contact')
		->setCellValue('M4', 'Mother Contact');
		/*---------------------------------------------------------------------------------*/
	
		$i=4; $msg_flag = TRUE; $flag=0;
		if(isset($form_detail) && sizeof($form_detail) > 0){
			foreach($form_detail as $values){
				if($flag != $values->student_id){
					$flag = $values->student_id;
					$outstanding_due = 0;
					$outstanding_received = 0;
					$outstanding_discount = 0;
					$outstanding_pending = 0;
				}
				
				if($values->batch_id < $b ) {
					$outstanding_due += $values->total_due;
					$outstanding_received += $values->total_payment;
					$outstanding_discount += $values->total_discount;
					$outstanding_pending  += $values->pending_amount;
					continue;
				}
				$i++; $msg_flag = FALSE;
				
				$this->excel->getActiveSheet()
				->setCellValue('A'.$i, $i-4)
				->setCellValue('B'.$i, $values->admission_number)
				->setCellValue('C'.$i, $values->student_name)
				->setCellValue('D'.$i, $values->course_name. ' - ' . $values->section)
				->setCellValue('E'.$i, $outstanding_due)
				->setCellValue('F'.$i, $values->total_due)
				->setCellValue('G'.$i, ($outstanding_due+$values->total_due))
				->setCellValue('H'.$i, $outstanding_received)
				->setCellValue('I'.$i, $values->total_payment)
				->setCellValue('J'.$i, $values->total_discount+$outstanding_discount)
				->setCellValue('K'.$i, $values->pending_amount+$outstanding_pending)
				->setCellValue('L'.$i, $values->cell_phone_father)
				->setCellValue('M'.$i, $values->cell_phone_mother);
	
			}
		}
		$this->excel->getActiveSheet()->setCellValue('H3', 'Total Records: '.($i-4));
		$i++;
		$this->excel->getActiveSheet()
		->setCellValue('A'.$i, "Total")
		->setCellValue('E'.$i, "=SUM(E5:E".($i-1).")")
		->setCellValue('F'.$i, "=SUM(F5:F".($i-1).")")
		->setCellValue('G'.$i, "=SUM(G5:G".($i-1).")")
		->setCellValue('H'.$i, "=SUM(H5:H".($i-1).")")
		->setCellValue('I'.$i, "=SUM(I5:I".($i-1).")")
		->setCellValue('J'.$i, "=SUM(J5:J".($i-1).")")
		->setCellValue('K'.$i, "=SUM(K5:K".($i-1).")");
		$this->excel->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
		$this->excel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true);
		
		$this->excel->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('G'.$i)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H'.$i)->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('I'.$i)->getFont()->setBold(true);
		/*---------------------------------------------------------------------------------*/
		$filename='pending_fee_'.date('Ymd').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
	
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');	
	}
	
	function sms_fee_reminder(){
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		
		{
			
			$id = $this->uri->segment(3);
			$student_list = $this->Reports_model->get_student_info($id);
			//print_r($student_list);
			foreach ($student_list as $student)
			{	
			    if( isset($student->cell_phone_father) && strlen($student->cell_phone_father) == 12  ){
			        
					$student_name = substr($student->student_name, 0, 13);
					$mobile = $student->cell_phone_father;
					
					$message = "AOA". '\n';
					$message .= "Please clear padding fee of ".$student_name.".\n";
					
					$message .= "Principal". '\n';
					$message .= "FAST Haroonabad". '\n';
					$message .= "03336318287";
					//echo $message. strlen($message) . '<br>';
					
					$sms_flag = $this->send_message($mobile, $message, $sender = 'FastAcademy');
					//echo $sms_flag[0]. $student_name . '<br/>';
					Base_model::insert_message_log($id, $mobile, $message, 1, $sms_flag[0]);
					if($sms_flag[0] == 'OK'){
						$this->Reports_model->update_message_count($id);
					}
				}
			}
		}
		echo 'SMS Sent';
	}
}