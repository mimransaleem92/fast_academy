<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Screen extends Base_Controller{

	function Screen()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('User_model','',TRUE);
		
	}
	
	function index(){
		
		$this->role_list();
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'/screen/display/';
		$config['total_rows']=$this->User_model->get_num_screens();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['screen_list']=$this->User_model->get_all_screens($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/screens/list');
	
	}
	
	function role_list(){
		
		$this->data['role_list'] = Screen_model::get_all_role();
		$this->load_template('settings/screens/list');
	}
	
	function add(){}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['role_id'] = $id;
		$this->data['role_name'] = Screen_model::get_role_by($id);
		$this->data['actions'] = Screen_model::get_all_actions();
		$this->data['available_scr'] = Screen_model::get_screens_available_for_role($id); // For Multi Select in the Form
		$this->data['selected_scr']  = Screen_model::get_rolescreens_by_role($id);  // For Multi Select in the Form
		$this->load_template('settings/screens/edit');
	}
	
	function update(){
		Screen_model::update();
		redirect('screen','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->User_model->delete($_GET['selected_id']);
			redirect('screen','location');
		}
	}
}