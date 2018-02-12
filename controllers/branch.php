<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends Base_Controller{

	function __construct()
	{
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Branchs_model','',TRUE);
	}
	
	function index(){
		//$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		
		$this->branchs_list();
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/branchs/display/';
		$config['total_rows']=$this->Branchs_model->get_num_branchs();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['company_list'] = null;//Base_model::getCompanyList();
		$this->data['branchs_list']=$this->Branchs_model->get_all_branchs($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/branchs/default');
	}
	
	function branchs_list(){
		$this->data['company_list'] = null; //Base_model::getCompanyList();
		$this->data['branchs_list'] = $this->Branchs_model->get_all_branchs();
		$this->load_template('settings/branchs/default');
	}
	
	function save_item(){
		
		$this->Branchs_model->insert();
		$this->data['branchs_list'] = $this->Branchs_model->get_all_branchs();
		$this->load->view('settings/branchs/list', $this->data);	
	}
	
	function add(){
		$this->branchs_list();
	}
	function edit(){
		$this->branchs_list();
	}
	
	function get_company_list(){
		$comp_id = $_REQUEST['company_id'];
		$this->data['branchs_list'] = $this->Branchs_model->get_all_branchs();
		$this->load->view('settings/branchs/list', $this->data);
	}
	
	function update_item(){
		$this->Branchs_model->update();
		$this->data['branchs_list'] = $this->Branchs_model->get_all_branchs();
		$this->load->view('settings/branchs/list', $this->data);
	}
	
	function delete_item(){
		$this->Branchs_model->delete($_POST['branch_id']);
		$this->data['branchs_list'] = $this->Branchs_model->get_all_branchs();
		$this->load->view('settings/branchs/list', $this->data);
	}
}