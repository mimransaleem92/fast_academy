<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends Base_Controller{

	function Logout()
	{
		parent::__construct();
		//$this->data['base_url'] = "http://localhost/ci/";
		$this->data['errorMessage'] = "";
		//$this->load->model('Logout_model','',TRUE);
	}
	
	function index(){
		//$this->load->model('Logout_model', '', TRUE);
			
		$this->session->sess_destroy();
		if($this->session){
    		redirect('login', 'refresh');
		}
	}
}