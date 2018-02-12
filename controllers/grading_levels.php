<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grading_levels extends Base_Controller{

	function Grading_levels()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Grading_levels_model','',TRUE);
		
	}
	function index(){
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load_template('settings/grading_levels/default');
	}
	
	
	function add(){
		
		if(isset($_POST['course_id']))
		{
			$id = $this->uri->segment(3);
			$record = $this->data['grade_list'] = $this->Grading_levels_model->get_grades_by_batch($id);
			$this->load->view('settings/grading_levels/add',$this->data);
		} 
	}

	function add_default_grading(){
		$this->Grading_levels_model->insert_default_grading();
		
		$this->data['grade_list'] = $this->Grading_levels_model->get_grades_by_batch($_POST['batch_id']);
		$this->load->view('settings/grading_levels/add',$this->data);
	}
	
	function new_grade(){
		if(isset( $_GET['f']) && $_GET['f'] == 'insert')
		{
			$this->Grading_levels_model->insert_grading();
			$this->data['grade_list'] = $this->Grading_levels_model->get_grades_by_batch($_POST['batch_id']);
			$this->load->view('settings/grading_levels/add',$this->data);
		}
		else {
			$this->load->view('settings/grading_levels/new_grade',$this->data);
		}
	}
	
	function edit_grade(){
		if(isset( $_GET['f']) && $_GET['f'] == 'insert')
		{
			$this->Grading_levels_model->update_grading();
			$this->data['grade_list'] = $this->Grading_levels_model->get_grades_by_batch($_POST['batch_id']);
			$this->load->view('settings/grading_levels/add',$this->data);
		}
		else {
			//$this->data['form'] = $this->Grading_levels_model->get_grading_level($_POST['batch_id'], $_POST['grade_name']);
			$this->load->view('settings/grading_levels/edit_grade',$this->data);
		}
	}
	
	function del_grade(){
	    $id = $grade_name = $this->uri->segment(3);
		$this->Grading_levels_model->delete_grading($_POST['batch_id'], $id);
		
		$this->data['grade_list'] = $this->Grading_levels_model->get_grades_by_batch($_POST['batch_id']);
		$this->load->view('settings/grading_levels/add',$this->data);
	}
}