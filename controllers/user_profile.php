<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_profile extends Base_Controller{

	function User_profile()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('User_profile_model','',TRUE);
		
	}
	
	function index(){
		
		$this->profile_view();
	}
	
	function chng_pwd(){
		$this->load->helper('form');
		$this->load_template('settings/user_profile/change_password');
	}	
	
	function profile_view(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3); // user_id
		$this->data['form']  =  $this->User_profile_model->get_user_profile($id);
		$this->data['dept_list']   = Base_model::get_all_departments();
		
		$this->load_template('settings/user_profile/view');
	}
	
	function update_password(){
		//print_r($_POST);
		$this->User_profile_model->update_pwd();
		redirect('dashboard','location');
	}	
}