<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects extends Base_Controller{

	function Subjects()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Subjects_model','',TRUE);
		
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
		
		$config['base_url'] = base_url().'index.php/subject/display/';
		$config['total_rows']=$this->Subjects_model->get_num_subjects();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['subject_list']=$this->Subjects_model->get_all_subjects();
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/subjects/default');
	}
	
	function subject_list(){
		
		$this->data['subject_list'] = $this->Subjects_model->get_all_subjects();
		$this->load_template('settings/subjects/default');
	}
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject_name', 'Subject Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Subjects_model->insert();
			redirect('subjects','location');
		}
		else
		{
			$this->load_template('settings/subjects/add');
		} 
	}
	
	function add_employee(){
		$check = $this->Subjects_model->insert_employee();
		if($check){
			echo "Successfully Saved!!";
		}
		else{
			echo "Already in the teacher list!!";
		}
		$id = $_POST['subject_id'];
		$this->data['associated_employee_list'] = $this->Subjects_model->get_employee_by_subject($id);
	
		$this->load->view('settings/subjects/employee_list', $this->data);
	
	}
	
	function remove_employee(){
		$check = $this->Subjects_model->delete_employee();
		$id = $_POST['subject_id'];
		$this->data['associated_employee_list'] = $this->Subjects_model->get_employee_by_subject($id);
	
		$this->load->view('settings/subjects/employee_list', $this->data);
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$record = $this->data['form']  =  $this->Subjects_model->get_subject($id);
		
		$this->data['employee_list'] = $this->Subjects_model->get_all_employees();
		$this->data['associated_employee_list'] = $this->Subjects_model->get_employee_by_subject($id);
		
		$this->data['headers_list'] = $this->Subjects_model->get_subject_headers($id);
		
		$this->load_template('settings/subjects/edit');
	}
	
	function update(){
		$this->Subjects_model->update();
		$config['base_url'] = base_url().'index.php/subject/';
		redirect('subjects','location');
	}
	
	function edit_header(){
		$this->load->helper('form');
		$this->data['header_title'] = null;
		$this->data['header_score'] = null;
		
		if(isset($_GET['course_id']))
		{
			$row = $this->Subjects_model->get_header_info($_GET['course_id'], $_GET['sid']);
				
			$title = explode(', ', $row[0]->marksheet_title);
			$score = explode(', ', $row[0]->marksheet_score);
			$this->data['header_title'] = $title;
			$this->data['header_score'] = $score;
		}
		$this->load->view('settings/subjects/edit_header',$this->data);
	}
	
	function edit_header_update(){
		$this->load->helper('form');

		$this->Subjects_model->update_course_subject();
		$this->data['subject_name'] =  $_POST['subject_name'];
		$this->data['headers_list'] = $this->Subjects_model->get_subject_headers($_POST['subject_id']);
		$this->load->view('settings/subjects/subject_detail_block',$this->data);
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Subjects_model->delete($_GET['selected_id']);
			redirect('subjects','location');
		}
	}
}