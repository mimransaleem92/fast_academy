<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_search extends Base_Controller{

	function Global_search()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Global_search_model','',TRUE);
		
	}
	
	function index(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'1','print'=>'0');
		$from  = date('Y-m').'-01';
		$to	   = date('Y-m-d');
		$search_text = (isset($_REQUEST['search_text'])) ? $_REQUEST['search_text'] : '';
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['student_list']=$this->Global_search_model->get_students($search_text);
		$this->data['model'] = 'global_search';
		$this->load_template('search/default');
	}
	
	function search()
	{
		$search = $_POST['search'];
		$this->data['student_list']=$this->Global_search_model->get_student_search($search);
		$this->load->view('search/search_list', $this->data);
	}
	
	function advance_search(){
	
		$this->data['student_list']=$this->Global_search_model->get_advance_search();
		$this->load->view('search/search_list', $this->data);
	}
	
	function search_old(){
		if(isset($_POST['from_date'])){	
		$from = $_POST['from_date'];
		$to   = $_POST['to_date'];
		}
		else{
		$from  = date('Y-m').'-01';
		$to	   = date('Y-m-d');
		}
		$search_text = $this->uri->segment(3);
		$this->data['form_detail']= Base_Model::get_all_employees($search_text);
		//$this->load->view('search/global_search',$this->data);
		$this->load_printhtml_tmpl('search/global_search');
	}
	
	function employee(){
		
		$search_text = $this->uri->segment(3);
		$this->data['form_detail']= Base_Model::get_all_employees($search_text);
		//$this->load->view('search/global_search',$this->data);
		$this->load_printhtml_tmpl('search/global_search');
	}
	
	function driver(){
		if(isset($_POST['from_date'])){	
		$from = $_POST['from_date'];
		$to   = $_POST['to_date'];
		}
		else{
		$from  = date('Y-m').'-01';
		$to	   = date('Y-m-d');
		}
		$search_text = $this->uri->segment(3);
		$this->data['form_detail']=$this->Global_search_model->get_driver_log($from, $to,$search_text);
		//$this->load->view('search/global_search',$this->data);
		$this->load_printhtml_tmpl('search/global_search');
	}

	function prints(){
		if(isset($_REQUEST['from_date'])){
			$from = $_REQUEST['from_date'];
			$to   = $_REQUEST['to_date'];
			$search_text = $this->uri->segment(3);
		}else{
			$from  = date('Y-m').'-01';
			$to	   = date('Y-m-d');
			$search_text = 'YU2A4CMA84A573957';
		}
		$this->data['form_detail']=$this->Global_search_model->get_vehicle_log($from, $to,$search_text);
		$this->load_printhtml_tmpl('search/global_search');
	}
}