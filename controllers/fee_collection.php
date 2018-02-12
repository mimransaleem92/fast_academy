<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_collection extends Base_Controller{

	function Fee_collection()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Fee_collection_model','',TRUE);
	}
	
	function index(){
		$limit = $this->uri->segment(2);  
		if(is_nan($limit)) $limit = 0;
		$this->display($limit);
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/fee_collection/display/';
		$config['total_rows']=$this->Fee_collection_model->get_num_fee_collection();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['batch_list']=$this->Fee_collection_model->get_all_fee_collection($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/fee_collection/default');
	}
	
	function batch_list(){
		
		$this->data['batch_list'] = $this->Fee_collection_model->get_all_fee_collection();
		$this->load_template('settings/fee_collection/default');
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fee_category_id', 'Fee Category','required');
		$this->form_validation->set_rules('collection_name', 'Collection Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Fee_collection_model->insert();
			redirect('fee_collection','location');
		}
		else
		{
			$id = $this->session->userdata('company_id');
			$this->data['fee_category_list'] = Base_model::get_fee_categories();
			$this->load_template('settings/fee_collection/add');
		} 
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['form'] = $this->Fee_collection_model->get_fee_collection($id);
		$this->data['fee_category_list'] = Base_model::get_fee_categories();
		$this->load_template('settings/fee_collection/edit');
	}
	
	function update(){
		$this->Fee_collection_model->update();
		$config['base_url'] = base_url().'index.php/fee_collection/';
		redirect('fee_collection','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Fee_collection_model->delete($_GET['selected_id']);
			redirect('fee_collection','location');
		}
	}
}