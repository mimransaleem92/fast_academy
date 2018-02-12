<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Idcards extends Base_Controller{

	function Idcards()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('idcards_model','',TRUE);
		
	}
	function index(){
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load_template('settings/idcards/default');
	}
	
	function batch_list(){
		
		$this->data['batch_list'] = $this->idcards_model->get_all_collect_fees();
		$this->load_template('settings/collect_fees/default');
	}
	
	
	function student_list(){
		$id = $this->uri->segment(3);
		
		$this->data['student_list'] = $this->idcards_model->get_students_by_batch($id);
		
		$this->load->view('settings/idcards/student_list',$this->data);
	}
	
	function print_card(){
		$student_id = $this->uri->segment(3);
		$course_id = $_GET['course_id'];
		$batch_id  = $_GET['batch_id'];
		
		
		$this->data['student'] = $this->idcards_model->get_student_batch_course($student_id);
		$this->idcards_model->insert_printed_documents($student_id, $course_id, $batch_id, 'Student ID Card');
		$this->load->view('settings/idcards/card_layout',$this->data);
	}
	
	function reprint_card(){
		$student_id = $this->uri->segment(3);
		$course_id = $_GET['course_id'];
		$batch_id  = $_GET['batch_id'];
	
	
		$this->data['student'] = $this->idcards_model->get_student_batch_course($student_id);
		//$this->idcards_model->insert_printed_documents($student_id, $course_id, $batch_id, 'Student ID Card');
		$this->load->view('settings/idcards/card_layout',$this->data);
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('course_id', 'Course Name','required');
		$this->form_validation->set_rules('batch_id', 'Batch Name','required');
		$this->form_validation->set_rules('collection_name', 'Collection Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->idcards_model->insert();
			redirect('collect_fees','location');
		}
		else
		{
			$id = $this->session->userdata('company_id');
			$this->data['fee_category_list'] = Base_model::get_fee_categories();
			$this->load_template('settings/collect_fees/add');
		} 
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$record = $this->data['form'] = $this->idcards_model->get_collect_fees($id);
		$params = $record[0]->course_id;
		$this->data['fee_category_list'] = Base_model::get_fee_categories();
		$this->load_template('settings/collect_fees/edit');
	}
	
	function update(){
		$this->idcards_model->update();
		$config['base_url'] = base_url().'index.php/collect_fees/';
		redirect('collect_fees','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->idcards_model->delete($_GET['selected_id']);
			redirect('collect_fees','location');
		}
	}
}