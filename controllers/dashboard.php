<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Base_Controller{

	function Dashboard()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Dashboard_model','',TRUE);
		
	}
	
	function index(){
		$this->data['expired_items'] = array('15');//$this->Dashboard_model->get_expired_items();
		$this->data['expired_items_list'] = array('20');//$this->Dashboard_model->get_expired_items_list();
		$this->data['min_level_list'] = array('35');//$this->Dashboard_model->get_min_level_list();
		$this->data['out_stock_list'] = array('50');//$this->Dashboard_model->get_out_stock_list();
		$this->data['employee_list'] = Base_model::get_employees();
		$this->data['total_students'] = Base_model::get_students_count();
		
		$this->data['collection'] = null;//Dashboard_model::get_today_collection();
		$this->data['collection_list'] = null;//Dashboard_model::get_today_collection_list();
		
		$this->data['enrollment_list'] = null;//Dashboard_model::get_enrollment_list();
		$this->data['absent_list'] = Dashboard_model::get_absent_students_list();
		
		$this->data['dept_list'] = Base_model::get_all_departments();
		
		$lang = $this->session->userdata(SESSION_CONST_PRE.'lang');
		if($lang == 'ar'){
			$this->template->set_master_template('template-rtl'.TEMPLATE_CONST);
		}
		else{
			$this->template->set_master_template('template'.TEMPLATE_CONST);
		}
		
		$this->template->write('title', $this->session->userdata('company_name')." :: Dashboard");
		// Write to Header
		$this->template->write_view('header', 'common/layout'.TEMPLATE_CONST.'/header', $this->data);
		
		// Write to Left Menu
		$this->template->write_view('sidebar', 'common/layout'.TEMPLATE_CONST.'/sidebar', $this->data);
		
		// Write to $content
		$user_dashboard = $this->session->userdata(SESSION_CONST_PRE.'user_dashboard');
		$this->template->write_view('content', 'dashboards/'.$user_dashboard.'_default', $this->data);
		
		$this->template->write_view('footer', 'common/layout'.TEMPLATE_CONST.'/footer');
		// Render the template
		$this->template->render();
	}
	
	function expired(){
		
		$this->data['form_detail']=$this->Dashboard_model->get_expired_istmara_list();
		//$this->load->view('search/global_search',$this->data);
		$this->load_printhtml_tmpl('dashboards/expired_istmara_list');
	}
	
	function min_level_reached(){
		
		$this->data['form_detail']=$this->Dashboard_model->get_min_level_list();
		//$this->load->view('search/global_search',$this->data);
		$this->load_printhtml_tmpl('dashboards/min_level_reached_list');
	}
	
	function out_stock(){
		
		$this->data['form_detail']=$this->Dashboard_model->get_out_stock_list();
		//$this->load->view('search/global_search',$this->data);
		$this->load_printhtml_tmpl('dashboards/out_stock_list');
	}
	
}