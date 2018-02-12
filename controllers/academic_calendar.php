<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academic_calendar extends Base_Controller{

	function Academic_calendar()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Attendance_model','',TRUE);
		
	}
	
	function index(){
		
		$this->data['action_menu'] = FALSE;
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		
		$this->data['term_list'] = $this->Attendance_model->get_term_list();
		$this->data['curr_date'] = $curr_date = $date = date('Y-m-d');
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['calendar_list'] = $this->Attendance_model->get_calendar($batch);
		
		$this->load_template('academic/calendar/default');
	}
	
	function add_calendar(){
		$batch   = $_POST['batch_id'];
		if(isset($_POST['start_date'])){
			$this->Attendance_model->add_academic_calendar($batch);
		}
		redirect('academic_calendar');
	}
	
	function add_week_plan(){
		$this->data['division_id'] = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		if(isset($_POST['action']) && $_POST['action'] == 'save'){
			$this->Attendance_model->update_week_plan();
			echo ''.$_POST['week_plan'];
		}else{
			$this->load->helper('form');
			$this->load->view('academic/calendar/add_plan',$this->data);
		}
	}
}