<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Base_Controller{

	function Login()
	{
		parent::__construct();
		$this->data['errorMessage'] = "";
		$this->load->model('Login_model','',TRUE);
	}
	
	function index(){
		//print_r($_REQUEST);
		if (isset($_POST['username'])) {
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->Login_model->authenticateUser($username,$password);
			
			if($user){	
				$company = $this->Login_model->get_logincompany($user->company_id);
				$division_name = $this->Login_model->get_division($user->division_id);
				$role = Base_model::get_userrole($user->user_id);
				
				$this->session->set_userdata(SESSION_CONST_PRE.'userId', $user->user_id);
				$this->session->set_userdata(SESSION_CONST_PRE.'user_name', $user->name);
				$this->session->set_userdata(SESSION_CONST_PRE.'user_name_arabic', $user->arabic_name);
				$this->session->set_userdata(SESSION_CONST_PRE.'company_id', $user->company_id);
				$this->session->set_userdata(SESSION_CONST_PRE.'division_id', $user->division_id);
				$this->session->set_userdata(SESSION_CONST_PRE.'branch_id', $user->branch_code);
				$this->session->set_userdata(SESSION_CONST_PRE.'dept_id', $user->department_id);
				$this->session->set_userdata(SESSION_CONST_PRE.'session_start', $user->session_start);
				$this->session->set_userdata(SESSION_CONST_PRE.'employee_id', $user->employee_id);
				$this->session->set_userdata(SESSION_CONST_PRE.'batch_id', 1);
				$this->session->set_userdata(SESSION_CONST_PRE.'financial_year', '2017-2018');
				$this->session->set_userdata(SESSION_CONST_PRE.'subject_id', 0);
				$this->session->set_userdata(SESSION_CONST_PRE.'course_id', 0);
				$this->session->set_userdata(SESSION_CONST_PRE.'section', '');
				$this->session->set_userdata(SESSION_CONST_PRE.'both_division', $user->both_division);
				
				if($user->employee_id != 0){
					$emp = $this->Login_model->get_employee_basic_info($user->employee_id);
					if(isset($emp[0])){
						$this->session->set_userdata(SESSION_CONST_PRE.'course_id', $emp[0]->course_id);
						$this->session->set_userdata(SESSION_CONST_PRE.'section', $emp[0]->section);
						$this->session->set_userdata(SESSION_CONST_PRE.'subject_id', $emp[0]->subject_id);
					}
				}
				$this->session->set_userdata(SESSION_CONST_PRE.'app_title', $division_name);
				$this->session->set_userdata(SESSION_CONST_PRE.'company_name', $company->name);
				$this->session->set_userdata(SESSION_CONST_PRE.'company_name_arabic', $company->arabic_name);
				$this->session->set_userdata(SESSION_CONST_PRE.'user_dashboard', $company->dashboard);
				// show to admin area 
				$this->session->set_userdata(SESSION_CONST_PRE.'admin_role', $user->admin_role);
				// for rai to show the update term in student which affect to tution fee due amoutn
				$this->session->set_userdata(SESSION_CONST_PRE.'super_admin', $user->super_admin);
				$this->session->set_userdata(SESSION_CONST_PRE.'fee_payment', $user->fee_payment);
				$this->session->set_userdata(SESSION_CONST_PRE.'manual_fee_receive', $user->manual_fee_receive);
				
				if(is_object($role)){
					$this->session->set_userdata(SESSION_CONST_PRE.'role_id',$role->role_id);
				}
				else{
					$this->session->set_userdata(SESSION_CONST_PRE.'role_id', '2');
				}
				$this->session->set_userdata(SESSION_CONST_PRE.'home_screen', $user->default_screen);
				$this->session->set_userdata(SESSION_CONST_PRE.'lang', $user->default_language);
				$this->session->set_userdata(SESSION_CONST_PRE.'toggle', "36");
				//die($user->default_screen);
				redirect($user->default_screen, 'refresh');
			}
			else
			{
				$this->data['errorMessage'] = "<p>Incorrect Username and / or Password</p>";
			}
			
		}
		//else
		{
			$this->load->view('login',$this->data);
		}
	}
}