<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends Base_Controller{

	function Student()
	{
		parent::__construct();
		$this->load->model('Student_model','',TRUE);
		$this->data['courses_list'] = Base_model::get_all_courses();
	}
	
	function index(){
	
		
		$limit = $this->uri->segment(2);
		if(is_nan($limit)) $limit = 0;
		$this->display($limit);
	}
	
	function display($row = 0)// used for pagination
	{
		$this->data['action_menu'] = FALSE;
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
	
		$config['base_url'] = base_url().'student/display/';
		$config['total_rows']=$this->Student_model->get_students_count();
		$this->pagination->initialize($config);
		$this->data['student_list'] = $this->Student_model->get_all_students($row,TRUE);
		$this->data['page_count'] = $row;
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('public/student/default');
	}
	
	function enrollment(){
		$this->data['action_menu'] = FALSE;
		$this->load->helper('form');
		
		$this->data['country_list'] = Base_model::get_country_list();
		$this->load_template('public/student/enrollment');
	}
	
	function script_transfer(){
		
		$res = $this->Student_model->get_student_data();
		$i=0; $students = array();
		foreach ($res as $row){
			$id_number_father = '';
			$passport_id = '';
			$tag = trim($row->iqama_id);
			//echo '<b>'.$i.'</b>- ';
			$matches = '';
			preg_match_all('/-?\d+(?:\.\d+)?+/', $tag, $matches);
			//print_r( $matches[0]);
			//echo '<br>';
			//$students[$i]['father_name'] = $tag;
			
			$iqama_expiry = null;
			$iqama_id = '';
			if(sizeof($matches[0]) > 0){
				$iqama_arr = $matches[0];
				
				
				$iqama_id = isset($iqama_arr[0]) ? $iqama_arr[0] : '';
				$id_number_father = isset($iqama_arr[1]) ? $iqama_arr[1] : '';
				$passport_id = isset($iqama_arr[4]) ? $iqama_arr[4] : '';
				
				for($c=0; $c < sizeof($iqama_arr)-1 ; $c++){
					if(isset($iqama_arr[$c]) && strpos($iqama_arr[$c], '.') !== false){
						$exp = explode('.', trim($iqama_arr[$c]));
						
						$iqama_expiry = '14'.$iqama_arr[$c+1].'-'.$exp[1].'-'.$exp[0];
						break;
					}
				}
			}
			$students[$i]['iqama_expiry'] = $iqama_expiry;
			
			if(strpos($row->class, 'Grade ') !== false) {
				$course = str_replace('Grade ', '', $row->class);
				$course = $course + 3;
			}
			else{
				$course = str_replace('KG-', '', $row->class);
			}
			if($course == '') $course = 0;
			
			if($row->passport_id != ''){
				$passport_id = $row->passport_id;
			}
			
			$students[$i]['student_name'] = trim($row->student_name);
			$students[$i]['student_name_ar'] = $row->student_name_ar;
			$students[$i]['date_of_birth'] = $row->date_of_birth;
			$students[$i]['course_id'] = $course;
			$students[$i]['passport_id'] = $passport_id;
			$students[$i]['iqama_id'] = $iqama_id;
			$students[$i]['id_number_father'] = $id_number_father;
			$students[$i]['cell_phone_father'] = $row->father_contact;
			$students[$i]['cell_phone_mother'] = $row->mother_contact;
			$students[$i]['emergency_contact'] = $row->another_number;
			$students[$i]['email_father'] = $row->another_email;
			$students[$i]['email'] = $row->email;
			$students[$i]['nationality'] = $row->nationality;
			$students[$i]['birth_place'] = $row->birth_place;
			$students[$i]['previous_school'] = $row->previous_school;
			$students[$i]['previous_student_id'] = $row->student_id;
			$students[$i]['remarks'] = $row->note;
			
			
			$i++;
		}
		
		if(sizeof($students)>0){
			$this->Student_model->insert_data($students);
		}
		
	}
	
	function add(){
		$this->data['action_menu'] = FALSE;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('student_name', 'Student Name','required');
		$this->form_validation->set_rules('course_id', 'Class / Section','required');
		/* $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		 if($div_id == 2)
		 {
		 $this->form_validation->set_rules('father_name', 'Father Name','required');
		 $this->form_validation->set_rules('cell_phone_father', 'Cell Phone','required');
		 $this->form_validation->set_rules('iqama_id', 'ID Number','required');
		 $this->form_validation->set_rules('iqama_expiry', 'Expiry Date','required');
		} */
		
		if($this->form_validation->run() == TRUE){
				
			$this->Student_model->insert();
			redirect('home','location');
		}
		else{
			$this->enrollment();
		}
	}
	
	function short_list()// used for pagination
	{
		$this->data['action_menu'] = FALSE;
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
	
		$config['base_url'] = base_url().'student/display/';
		$config['total_rows']=$this->Student_model->get_students_count();
		$this->pagination->initialize($config);
		$this->data['student_list'] = $this->Student_model->get_all_students();
		$this->data['page_count'] = 0;
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('public/student/short_list');
	}
	
	function interview()// used for pagination
	{
		$this->data['action_menu'] = FALSE;
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
	
		$config['base_url'] = base_url().'student/display/';
		$config['total_rows']=$this->Student_model->get_students_count(0, FALSE, 1);
		$this->pagination->initialize($config);
		$this->data['student_list'] = $this->Student_model->get_all_students(0, FALSE, 1);
		$this->data['page_count'] = 0;
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('public/student/interview');
	}
	
	function selected_list()// used for pagination
	{
		$this->data['action_menu'] = FALSE;
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
	
		$config['base_url'] = base_url().'student/display/';
		$config['total_rows']=$this->Student_model->get_students_count();
		$this->pagination->initialize($config);
		$this->data['student_list'] = $this->Student_model->get_all_students();
		$this->data['page_count'] = 0;
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('public/student/selected');
	}
}
