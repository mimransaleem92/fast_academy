<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Base_Controller{

	function Reports()
	{
		parent::__construct();
		$this->load->model('Reports_model','',TRUE);
		$this->locations();
	}
	
	function index(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'1','print'=>'0');
		$from  = date('Y-m').'-01';
		$to	   = date('Y-m-d');
		$this->data['form_detail']=$this->Reports_model->get_request_priority($from, $to);
		$dept = $this->session->userdata('stc_dept_id');
		if ($dept == 107 || $dept == 111){
			$this->data['model'] = 'priority';
    	}
    	else {
    		$this->data['model'] = 'priority_it';
    	}
		$this->load_template('reports/default');
	}
	
	function priority(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'1','print'=>'0');
		$from  = date('Y-m').'-01';
		$to	   = date('Y-m-d');
		$print = $this->uri->segment(3);
		$search_text = NULL; $location = null;
		$this->data['loc'] = '';
		$dept = $this->session->userdata('stc_dept_id');
		if(!empty($_POST['search_text'])){
		 	$this->data['status'] = $search_text = $_POST['search_text'];
		}
		else{
			$this->data['status'] = '';
		}
		if(!empty($_POST['location'])){ $this->data['loc'] = $location = $_POST['location'];}
		$search = 0;
		if(isset($_GET['search'])){
			$search = $_GET['search'];
		}
		if($print == 'prints'){
			$this->prints();
		}
		elseif($search == '1')
		{
			$this->data['form_detail']=$this->Reports_model->get_request_priority($_POST['from_date'], $_POST['to_date'], $search_text, $location);
			
	    	if ($dept == 107 || $dept == 111){
				$this->load->view('reports/priority',$this->data);
	    	}
	    	else {
	    		$this->load->view('reports/priority_it',$this->data);
	    	}
		}
		else {
			$this->data['form_detail']=$this->Reports_model->get_request_priority($from, $to);
			if ($dept == 107 || $dept == 111){
				$this->data['model'] = 'priority';
	    	}
	    	else {
	    		$this->data['model'] = 'priority_it';
	    	}
			$this->load_template('reports/default');			
		}
	}
	
	function status(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'1','print'=>'0');
		$from  = date('Y-m').'-01';
		$to	   = date('Y-m-d');
		$search = 0;
		if(isset($_GET['search'])){
			$search = $_GET['search'];
		}
		
		if($search == '1')
		{
			$this->data['form_detail']=$this->Reports_model->get_request_priority($_POST['from_date'], $_POST['to_date']);
			$this->load->view('reports/priority',$this->data);
		}
		else {
			$this->data['form_detail']=$this->Reports_model->get_request_priority($from, $to);
			$this->data['model'] = 'status';
			$this->load_template('reports/default');
		}
	}
	
	function search(){
		$from = $_POST['from_date'];
		$to   = $_POST['to_date'];
		$this->data['form_detail']=$this->Reports_model->get_request_priority($from, $to);
		$this->load->view('reports/priority',$this->data);
	}

	function prints(){
		$search_text = NULL;
		$this->data['status'] = '';
		$this->data['loc'] = '';
		if(isset($_REQUEST['from_date'])){
			$from = $_REQUEST['from_date'];
			$to   = $_REQUEST['to_date'];
			$this->data['status'] = $search_text = $this->uri->segment(4);
			$this->data['loc'] = $_REQUEST['location'];
		}
		$this->data['form_detail']=$this->Reports_model->get_request_priority($from, $to, $search_text, $this->data['loc']);
		$dept = $this->session->userdata('stc_dept_id');
		if ($dept == 107 || $dept == 111){
			$this->load_printhtml_tmpl('reports/priority');
    	}
    	else {
    		$this->load_printhtml_tmpl('reports/priority_it');
    	}
		
	}
	function excel(){
		if(isset($_REQUEST['from_date'])){
			$from = $_REQUEST['from_date'];
			$to   = $_REQUEST['to_date'];
			$search_text = $this->uri->segment(3);
		}else{
			$from  = date('Y-m').'-01';
			$to	   = date('Y-m-d');
			$search_text = 'YU2A4CMA84A573957';
		}
		$this->data['form_detail']=$this->Reports_model->get_request_priority($from, $to);
		$this->load_printhtml_tmpl('reports/priority');
	}
	
	function PDF()
	{
	 $this->load->helper('form');
	
	 $font_directory = base_url().'assets/pdf_font/';
	 set_realpath($font_directory);
	
	 $this->load->library('fpdf');
	 define('FPDF_FONTPATH',$font_directory);
	 $this->fpdf->Open();
	 $this->fpdf->AddPage();
	 $this->fpdf->SetFont('Arial','',8);
	 $this->fpdf->Cell(80);
	 $this->fpdf->Cell(0,0,'Hello FPDF',0,1,'R');
	 $this->fpdf->Output();
	}
}