<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Term_plan extends Base_Controller{

	function Term_plan()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Term_plan_model','',TRUE);
		
	}
	
	function index(){
		
		$this->data['action_menu'] = FALSE;
		$this->data['division_id'] = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
		$this->data['batch'] = $batch = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['term'] = $term = (isset($_POST['term']) && !empty($_POST['term'])) ? $_POST['term'] : 1;
		$this->data['term_list'] = $this->Term_plan_model->get_term_list();
		$this->data['subject_id'] = $subject_id;
		
		$this->data['subject_list'] = $this->Term_plan_model->get_subjects_by_course($course_id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['curr_date'] = $curr_date = $date = date('Y-m-d');
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['term_plan_list'] = $this->Term_plan_model->get_term_plan($batch, $term, $course_id, $subject_id);
		
		$this->load_template('academic/term_plan/default');
	}
	
	function subject_plan(){
		$this->data['division_id'] = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
		$this->data['batch'] = $batch = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$subject_id = (isset($_POST['subject_id'])) ? $_POST['subject_id'] : 1;
		$this->data['term'] = $term = (isset($_POST['term']) && !empty($_POST['term'])) ? $_POST['term'] : 1;
		$this->data['curr_date'] = $curr_date = $date = date('Y-m-d');
		
		$this->data['term_plan_list'] = $this->Term_plan_model->get_term_plan($batch, $term, $course_id, $subject_id);
		$this->load->view('academic/term_plan/subject_plan', $this->data);
	}
	
	function add_term_plan(){
		
		if(isset($_POST['subject_id'])){
			$sub = explode('-', $_POST['subject_id']);
			$_POST['subject_id'] = $sub[0];
			$this->Term_plan_model->add_term_plan();
		}
		$this->subject_plan();
	}
	
	function add_week_plan(){
		$this->data['division_id'] = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		if(isset($_POST['action']) && $_POST['action'] == 'save'){
			$this->Term_plan_model->update_week_plan();
			
			$this->subject_plan();
		}else{
			$this->load->helper('form');
			$this->load->view('academic/term_plan/add_plan',$this->data);
		}
	}
	
	function delete_term_plan(){
	
		if(isset($_POST['id'])){
			
			$this->Term_plan_model->delete_term_plan();
		}
		$this->subject_plan();
	}
}