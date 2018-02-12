<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewer extends Base_Controller{

	function Viewer()
	{
		parent::__construct();
			
	}
	
	function index(){
		$data['file_name'] = $this->uri->segment(2);
		$this->load_template('common/image_viewer');
	}
	
	function display(){
		$this->data['file_name'] = $file = $this->uri->segment(3);
		$file = explode(".", $file);
		$this->data['file'] = $file[0];
		$this->data['ext'] = $file[1];
		$this->load->view('common/image_viewer',$this->data);
	}
}