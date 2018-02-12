<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends Base_Controller{

	function Department()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Department_model','',TRUE);
		
	}
	
	function index(){
		
		$this->department_list();
	}
	
	function department_list(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->data['department_list'] = $this->Department_model->get_all_departments();
		$this->load_template('settings/departments/default');
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Department_model->insert();
			redirect('department','location');
		}
		else
		{
			$this->load_template('settings/departments/add');
		} 
	}
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3); // department_id
		$this->data['form']  =  $this->Department_model->get_department($id);
		
		$this->load_template('settings/departments/edit');
	}
	
	function update(){
		//print_r($_POST);
		$this->Department_model->update();
		redirect('department','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Department_model->delete($_GET['selected_id']);
			redirect('department','location');
		}
	}
}