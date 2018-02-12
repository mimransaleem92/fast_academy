<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orgnization extends Base_Controller{

	function Orgnization()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Company_model','',TRUE);
		
	}
	
	function index(){
		//$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->session->userdata(SESSION_CONST_PRE.'company_id');//$this->uri->segment(3);
		$this->data['form']  =  $this->Company_model->get_company($id);
		$this->load_template('settings/companys/view');
	}
	
	function company_list(){
		
		$this->data['company_list'] = $this->Company_model->get_all_companys();
		$this->load_template('settings/companys/list');
	}
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Company_model->insert();
			redirect('orgnization','location');
		}
		else
		{
			$this->load_template('settings/companys/add');
		} 
	}
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['form']  =  $this->Company_model->get_company($id);
		$this->load_template('settings/companys/edit');
	}
	
	function update(){
		$this->Company_model->update_item();
	}
	
	function update_address(){
		//print_r($_POST['name']);
		$this->Company_model->update_address();
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Company_model->delete($_GET['selected_id']);
			redirect('orgnization','location');
		}
	}
}