<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timetable extends Base_Controller{

	function Timetable()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Timetable_model','',TRUE);
		
	}
	
	function index(){
		$this->data['action_menu'] = FALSE;
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->timetable_list();
	}
	
	function weekday(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->weekday_list();
	}
	
	function classtiming(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'0','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$func1 = $this->uri->segment(3);
		if($func1 == 'delete'){
			if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
				$this->Timetable_model->delete_classtiming($_GET['selected_id']);
				redirect('timetable/classtiming','location');
			}
		}
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->classtiming_list();
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/timetable/display/';
		$config['total_rows']=$this->Timetable_model->get_num_timetables();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['timetable_list']=$this->Timetable_model->get_all_timetables($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('academic/timetable/default');
	}
	
	function batch_timing(){
		$id = $this->uri->segment(3);
		$this->data['subject_employee_list']  =  $this->Timetable_model->get_subject_employee_by_batch($id);
		$this->data['weekday_list'] =Base_model::get_weekdays($id);
		$this->data['ct_list']  =  $this->Timetable_model->get_ctlist($id);
		$this->load->view('academic/timetable/batch_timing', $this->data);
		
	}
	
	function timetable_list(){
		
		$this->data['courses_list'] = Base_model::get_all_courses();
		
		$batch_id = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
		
		$this->data['subject_employee_list']  =  $this->Timetable_model->get_subject_employee_by_batch($batch_id, $c);
		$this->data['weekday_list'] =Base_model::get_weekdays($batch_id, $c);
		$this->data['ct_list']  =  $this->Timetable_model->get_ctlist($batch_id, $c, $sec);
		//$this->load_template('academic/timetable/default');
		
		/* View For Teachers */
		$this->load_template('academic/timetable/default_role1');
	}
	
	function weekday_list(){
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		//$this->data['form']  =  $this->Timetable_model->get_timetable($id);
		$this->load_template('academic/timetable/weekday');
	}
	
	function classtiming_list(){
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['courses_list'] = Base_model::get_all_courses();
		//$this->data['form']  =  $this->Timetable_model->get_timetable($id);
		$this->load_template('academic/timetable/classtiming');
	}
	
	function ct_list(){
			
		$id = $this->uri->segment(3);
		$this->data['ct_list']  =  $this->Timetable_model->get_ctlist($id, $_POST['course_id'], $_POST['section']);
		$this->load->view('academic/timetable/ct_list', $this->data);
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Timetable_model->insert();
			redirect('timetable','location');
		}
		else
		{
			$this->data['company_list'] = Base_model::get_all_companies();
			$this->load_template('academic/timetable/add');
		} 
	}

	function subject_employee(){
		$id = $this->uri->segment(3);
		$this->data['employee_list'] = $this->Timetable_model->get_employee_by_subject($id);
	
		$this->load->view('academic/timetable/subject_teacher', $this->data);
	}
	
	function add_subject_teacher(){
		if(isset($_GET['f']) && $_GET['f'] == 'insert'){
			$id = $_POST['batch_id'];
			$this->data['weekday_list'] = $arr =Base_model::get_weekdays($id);
			
			$this->Timetable_model->insert_subject_employee($arr[0]);
			$course_id = $_POST['course_id'];
			$this->data['subject_employee_list']  =  $this->Timetable_model->get_subject_employee_by_batch($id, $course_id);
			$this->data['ct_list']  =  $this->Timetable_model->get_ctlist($id, $course_id);
			$this->load->view('academic/timetable/batch_timing', $this->data);
		}
		else{
			$id = $this->uri->segment(3);
			$this->data['subject_list'] = Base_model::get_subjects_by_course($id);
			$this->load->view('academic/timetable/add_subject_teacher', $this->data);
		}
	}
	
	function remove_subject_teacher(){
		if(isset($_POST['param']) ){
			$arr = explode('-', $_POST['param']);
			$this->Timetable_model->delete_subject_employee($arr);
			$id = $arr[2];
			$course_id = $arr[1];
			$this->data['subject_employee_list']  =  $this->Timetable_model->get_subject_employee_by_batch($id, $course_id);
			$this->data['weekday_list'] =Base_model::get_weekdays($id);
			$this->data['ct_list']  =  $this->Timetable_model->get_ctlist($id, $course_id);
			$this->load->view('academic/timetable/batch_timing', $this->data);
		}
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['company_list'] = Base_model::get_all_companies();
		$this->data['form']  =  $this->Timetable_model->get_timetable($id);
		$this->load_template('academic/timetable/edit');
	}
	
	function update(){
		$this->Timetable_model->update();
		$config['base_url'] = base_url().'index.php/timetable/';
		redirect('timetable','location');
	}
	
	function weekday_update(){
		$id = $this->uri->segment(3);
		if($_POST['db_check'] == 0){
			$this->Timetable_model->weekday_update($id);
		}
		else{
			$this->Timetable_model->weekday_insert($id);
		}
		echo 'Save Successfully!!';
	}
	
	function ct_update(){
		$id = $this->uri->segment(3);
		if($_POST['db_check'] == 0){
			$this->Timetable_model->ct_update($id);
		}
		else{
			$this->Timetable_model->ct_insert($id);
		}
		echo 'Save Successfully!!';
		$this->ct_list();
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Timetable_model->delete($_GET['selected_id']);
			redirect('timetable','location');
		}
	}
}