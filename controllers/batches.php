<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batches extends Base_Controller{

	function Batches()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Batches_model','',TRUE);
		
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
		
		$config['base_url'] = base_url().'index.php/batches/display/';
		$config['total_rows']=$this->Batches_model->get_num_batches();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['batch_list']=$this->Batches_model->get_all_batches($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/batches/default');
	}
	
	function batch_list(){
		
		$this->data['batch_list'] = $this->Batches_model->get_all_batches();
		$this->load_template('settings/batches/default');
	}
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('course_id', 'Course Name', 'callback_course_check');
		$this->form_validation->set_rules('batch_name', 'Batch Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Batches_model->insert();
			redirect('batches','location');
		}
		else
		{
			$id = $this->session->userdata('company_id');
			
			$this->data['courses_list'] = Base_model::get_all_courses();
			$this->load_template('settings/batches/add');
		} 
	}
	
	public function course_check($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('course_check', 'The %s field can not be empty!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$record = $this->data['form']  =  $this->Batches_model->get_batches($id);
		 
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load_template('settings/batches/edit');
	}
	
	function update(){
		$this->Batches_model->update();
		$config['base_url'] = base_url().'index.php/batches/';
		redirect('batches','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Batches_model->delete($_GET['selected_id']);
			redirect('batches','location');
		}
	}
}