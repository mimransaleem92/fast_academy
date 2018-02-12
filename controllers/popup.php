<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popup extends Base_Controller{

	function Popup()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Popup_model','',TRUE);
		
	}
	
	function index(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->supplier_list();
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/supplier/display/';
		$config['total_rows']=$this->Popup_model->get_supplier_by_type('s');
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['supplier_list']=$this->Popup_model->get_all_suppliers($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/suppliers/list');
	}
	
	function employee(){
		$this->data['title'] = $this->uri->segment(2);
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_all_employees($_REQUEST['search_text']); 
		}else{
			$this->data['list'] = Base_model::get_all_employees(); 
		}
		$this->load->view('popup/employee', $this->data);
	}
	
	function supplier(){
		$this->data['title'] = $this->uri->segment(2);
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_all_suppliers($_REQUEST['search_text']); 
		}else{
			$this->data['list'] = Base_model::get_all_suppliers(); 
		}
		$this->load->view('popup/supplier', $this->data);
	}
	
	function customer(){
		$this->data['title'] = $this->uri->segment(2);
		$this->data['list'] = Base_model::get_all_customers(); 
		$this->load->view('popup/customer', $this->data);
	}

	function branch(){
		$this->data['title'] = $this->uri->segment(2);
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_branchs($_REQUEST['search_text']); 
		}
		else{
			$this->data['list'] = Base_model::get_branchs();
		}
		$this->load->view('popup/branch', $this->data);
	}
	
	function division(){
		$this->data['title'] = $this->uri->segment(2);
		$this->data['list'] = Base_model::get_all_divisions(); 
		$this->load->view('popup/division', $this->data);
	}

	function department(){
		$this->data['title'] = $this->uri->segment(2);
		//$div = $this->uri->segment(3);
		//$this->data['list'] = Base_model::get_department_by_division($div);
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_departments($_REQUEST['search_text']); 
		}
		else{
		$this->data['list'] = Base_model::get_departments();
		} 
		$this->load->view('popup/department', $this->data);
	}
	
	function driver(){
		$this->data['title'] = $this->uri->segment(2);
		$flag = $this->uri->segment(3);
		$this->data['assign'] = $flag;
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_all_drivers($_REQUEST['search_text'],$flag); 
		}
		else{
			$this->data['list'] = Base_model::get_all_drivers(null, $flag);
		}
		$this->load->view('popup/driver', $this->data);
	}
	
	function vehicle(){
		
		$this->data['title'] = $this->uri->segment(2);
		$flag = $this->uri->segment(3);
		$this->data['assign'] = $flag;
		if(isset($flag) && $flag ==1)
		$flag = false;
		else
		$flag = true;
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_all_vehicles($_REQUEST['search_text'],$flag); 
		}
		else{
			$this->data['list'] = Base_model::get_all_vehicles(null,$flag); 
		}
		$this->load->view('popup/vehicle', $this->data);
	}
	
	function parts(){
		$this->data['title'] = $this->uri->segment(2);
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_parts($_REQUEST['search_text']); 
		}
		else{
			$this->data['list'] = Base_model::get_all_parts();
		}
		$this->load->view('popup/parts', $this->data);
	}
	
	function labour(){
		$this->data['title'] = $this->uri->segment(2);
		$flag = $this->uri->segment(3);
		if(isset($_REQUEST['search_text'])){
			$this->data['list'] = Base_model::get_all_labour($_REQUEST['search_text']); 
		}
		else{
			$this->data['list'] = Base_model::get_all_labour($flag);
		}
		$this->load->view('popup/get_labour', $this->data);
	}
}