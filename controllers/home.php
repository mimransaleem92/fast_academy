<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends BASE_Controller{

	function Home()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			//redirect('login', 'refresh');
		}
		$this->load->model('Dashboard_model','',TRUE);
		
	}
	
	function index(){
		$this->data['action_menu'] = FALSE;
		$this->load_template('dashboards/portal_default');
		
	}
}