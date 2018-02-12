<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coming_soon extends Base_Controller{

	function Coming_soon()
	{
		parent::__construct();
		
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		
	}
	
	function index(){
		
		$this->load_template('common/under_construction');
	}
}