<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends Base_Controller{

	function Courses()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Courses_model','',TRUE);
		
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
		
		$config['base_url'] = base_url().'index.php/course/display/';
		$config['total_rows']=$this->Courses_model->get_num_courses();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['course_list']=$this->Courses_model->get_all_courses($row, FALSE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/courses/default');
	}
	
	function course_list(){
		
		$this->data['course_list'] = $this->Courses_model->get_all_courses();
		$this->load_template('settings/courses/default');
	}
	
	function course_subject(){
	
		$this->data['course_list'] = $this->Courses_model->get_subjects_by_course($id);
		$this->load_template('settings/courses/default');
	}
	
	function add_subject(){
		$check = $this->Courses_model->insert_subject();
		if($check){
			echo "Successfully Saved!!";
		}
		else{
			echo "Already in the subject list!!";
		}
		$id = $_POST['course_id'];
		$this->data['assigned_subject_list'] = $this->Courses_model->get_subjects_by_course($id);
		
		$this->load->view('settings/courses/subject_list', $this->data);
		
	}
	
	function remove_subject(){
		$check = $this->Courses_model->delete_subject();
		$id = $_POST['course_id'];
		$this->data['assigned_subject_list'] = $this->Courses_model->get_subjects_by_course($id);
		
		$this->load->view('settings/courses/subject_list', $this->data);
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('course_name', 'Course Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Courses_model->insert();
			redirect('courses','location');
		}
		else
		{
			$this->load_template('settings/courses/add');
		} 
	}
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$record = $this->data['form']  =  $this->Courses_model->get_course($id);
		$this->data['subject_list'] = $this->Courses_model->get_all_subjects();
		$this->data['assigned_subject_list'] = $this->Courses_model->get_subjects_by_course($id);
		$this->load_template('settings/courses/edit');
	}
	
	function update(){
		$this->Courses_model->update();
		$config['base_url'] = base_url().'index.php/course/';
		redirect('courses','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Courses_model->delete($_GET['selected_id']);
			redirect('courses','location');
		}
	}
}