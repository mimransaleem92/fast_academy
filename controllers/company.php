<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends Base_Controller{

	function Company()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Company_model','',TRUE);
		
	}
	
	function index(){
		$limit = $this->uri->segment(2);  
		if(is_nan($limit)) $limit = 0;
		$this->display($limit);
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		//$config['base_url'] = base_url().'index.php/company/display/';
		$config['total_rows']=$this->Company_model->get_num_companys();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['company_list']=$this->Company_model->get_all_companys($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/companys/list');
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
			redirect('company','location');
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
		$this->Company_model->update();
		$config['base_url'] = base_url().'index.php/company/';
		redirect('company','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Company_model->delete($_GET['selected_id']);
			redirect('company','location');
		}
	}
}