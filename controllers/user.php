<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Base_Controller{

	function User()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('User_model','',TRUE);
		
	}
	
	function index(){
		
		$this->user_list();
		/* $limit = $this->uri->segment(2);  
		if(is_nan($limit)) $limit = 0;
		$this->display($limit); */
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'/user/display/';
		$config['total_rows']=$this->User_model->get_num_users();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['user_list']=$this->User_model->get_all_users($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/users/default');
	}
	
	function user_list(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->data['user_list'] = $this->User_model->get_all_users();
		$this->load_template('settings/users/default');
	}
	
	function search()
	{
		if (isset($_POST['search_by'])){
			if($_POST['search_by'] == 'depart'){
				$search_by = 'depart';
				$search = $_POST['search_dept'];
			}
			elseif($_POST['search_by'] == 'created_date'){
				$search_by = 't.created_date';
				$search = Util::dateDbFormat($_POST['search']);
			}
			else 
			{
				$search_by = $_POST['search_by'];
				$search = $_POST['search'];
			}
		}
		
		$this->data['user_list']=$this->User_model->get_user_search($search_by, $search);
		$this->load->view('settings/users/search_list', $this->data);
	}
	
	function role_screens(){
		$role_id = $this->uri->segment(3);
		$this->data['rolescreen_list'] = Screen_model::get_rolescreens_by_role($role_id);
		
		$this->load->view('settings/screens/ajax_screens', $this->data);
	}
	
	function screen_actions(){
		$role_id = $this->uri->segment(3);
		$this->data['actions'] = Screen_model::get_all_actions();
		$this->data['selected_scr'] = Screen_model::get_rolescreens_by_role($role_id);
		$this->load->view('settings/screens/ajax_actions', $this->data);
	}
	
	function chng_pwd(){
		$this->load->helper('form');
		$this->load_template('settings/users/change_password');
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username','alfa_numeric|min_length[3]|required');
		$this->form_validation->set_rules('name', 'Name','alfa_numeric|min_length[3]|required');
		$this->form_validation->set_rules('password', 'Password','min_length[6]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->User_model->insert();
			redirect('user','location');
		}
		else
		{
			$this->data['roles'] = Screen_model::get_all_role();
			$this->data['actions'] = Screen_model::get_all_actions();
			$id = $this->session->userdata(SESSION_CONST_PRE.'userId');
			
			$this->data['employee_list'] = $this->User_model->get_employees();
			$this->data['courses_list']  =  $this->User_model->get_all_courses();
			$this->load_template('settings/users/add');
		} 
	}
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3); // user_id 
		if($id == 99099) { redirect('user','location'); }
		$this->data['form']  =  $this->User_model->get_user($id);
		$this->data['screen_list'] = Screen_model::get_all_screens(); // For Multi Select in the Form
		$this->data['selected_scr']  = Screen_model::get_selected_screens($id);  // For Multi Select in the Form
		$this->data['division_list']   = Base_model::get_all_division(); // For Multi Select in the Form
		$this->data['employee_list'] = $this->User_model->get_employees(FALSE);
		
		$this->data['courses_list']  =  $this->User_model->get_all_courses();
		
		$this->load_template('settings/users/edit');
	}
	
	function update(){
		//print_r($_POST);
		$this->User_model->update();
		redirect('user','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->User_model->delete($_GET['selected_id']);
			redirect('user','location');
		}
	}
}