<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_certificate extends Base_Controller{

	function Student_certificate()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Student_certificate_model','',TRUE);
		
	}
	function index(){
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load_template('settings/student_certificates/default');
	}
	
	function batch_list(){
		
		$this->data['batch_list'] = $this->Student_certificate_model->get_all_student_certificate();
		$this->load_template('settings/student_certificates/default');
	}
	
	
	function student_list(){
		$id = $this->uri->segment(3);
		$student_id = 0;
		if(isset($_POST['student_id'])){
			$student_id = $_POST['student_id'];
		}
		$this->data['student_list'] = $this->Student_certificate_model->get_students_by_batch($id, $student_id);
		
		$this->load->view('settings/student_certificates/student_list',$this->data);
	}
	
	function print_card(){
		$student_id = $this->uri->segment(3);
		$course_id = $_GET['course_id'];
		$batch_id  = $_GET['batch_id'];
		
		
		$this->data['student'] = $this->Student_certificate_model->get_student_batch_course($student_id);
		$this->Student_certificate_model->insert_printed_documents($student_id, $course_id, $batch_id, 'Student Certificate');
		$this->load->view('settings/student_certificates/certificate_layout',$this->data);
	}
	
	function reprint_card(){
		$student_id = $this->uri->segment(3);
		$course_id = $_GET['course_id'];
		$batch_id  = $_GET['batch_id'];
	
	
		$this->data['student'] = $this->Student_certificate_model->get_student_batch_course($student_id);
		//$this->Student_certificate_model->insert_printed_documents($student_id, $course_id, $batch_id, 'Student Certificate');
		$this->load->view('settings/student_certificates/certificate_layout',$this->data);
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('course_id', 'Course Name','required');
		$this->form_validation->set_rules('batch_id', 'Batch Name','required');
		$this->form_validation->set_rules('collection_name', 'Collection Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Student_certificate_model->insert();
			redirect('student_certificate','location');
		}
		else
		{
			$id = $this->session->userdata('company_id');
			$this->data['fee_category_list'] = Base_model::get_fee_categories();
			$this->load_template('settings/student_certificates/add');
		} 
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$record = $this->data['form'] = $this->Student_certificate_model->get_student_certificate($id);
		$params = $record[0]->course_id;
		$this->data['fee_category_list'] = Base_model::get_fee_categories();
		$this->load_template('settings/student_certificates/edit');
	}
	
	function update(){
		$this->Student_certificate_model->update();
		$config['base_url'] = base_url().'index.php/student_certificates/';
		redirect('student_certificate','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Student_certificate_model->delete($_GET['selected_id']);
			redirect('student_certificate','location');
		}
	}
}