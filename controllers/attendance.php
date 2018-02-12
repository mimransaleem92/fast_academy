<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends Base_Controller{

	function Attendance()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Attendance_model','',TRUE);
		
	}
	
	function index(){
	
		$this->data['action_menu'] = FALSE;
		$start_date = $curr_date = $date = date('Y-m-d');
		if(isset($_REQUEST['attendance_date']) && !empty($_REQUEST['attendance_date'])){
			$curr_date = $_REQUEST['attendance_date'];
		}
		$this->data['term_list'] = $this->Attendance_model->get_term_list();
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		if(isset($_POST['week'])){
			$this->data['week_list'] = $row = $this->Attendance_model->get_week($batch, $_POST['week'], $_POST['term']);
		}else{
			$this->data['week_list'] = $row = $this->Attendance_model->get_current_week($batch, $date);
		}
		 
		if(!isset($row[0])){
			/* On weekends system will show the last working day attendance sheet */
			for ($i=1; $i<=2; $i++){
				$start_date = $this->Attendance_model->get_last_working_day($i);
				$this->data['week_list'] = $row = $this->Attendance_model->get_current_week($batch, $start_date);
				if (isset($row[0])){
					$row = $row[0];
					break;
				}
			}
		}else{
			$row = $row[0];
		}
		$this->data['curr_date']  = $curr_date;
		if(is_object($row)){
			$date = $this->Attendance_model->get_pre_week($row->start_date);
			
			$dt = explode('-', $date);
			$this->data['curr_year']  = $dt[0];
			$this->data['curr_month']  = $dt[1];
			$this->data['week_day_start'] = $dt[2];
			$this->data['year_month'] = $dt[0].'-'.$dt[1];
			$this->data['last_day']  = cal_days_in_month(CAL_GREGORIAN, $dt[1], $dt[0]);
			$this->data['pre_date']  = $this->Attendance_model->get_date_pre($curr_date);
			$this->data['next_date'] = $this->Attendance_model->get_date_next($curr_date);
			$class   = $this->session->userdata(SESSION_CONST_PRE.'course_id');
			$section = $this->session->userdata(SESSION_CONST_PRE.'section');
			
			$detail_list = $this->Attendance_model->get_attendance($date);
			$app_arr = array();
			if(isset($detail_list) && sizeof($detail_list) > 0){
				foreach($detail_list as $values){
					$ind = str_replace('-', '', $values->attendance_date);
					$app_arr[$ind][$values->student_id] = $values->attendance_comment;
				}
			}
			
			$this->data['attendance'] = $app_arr;
			$this->data['student_list'] = $this->Attendance_model->get_student_by_class_section($class, $section);
		}else {
			$this->data['week_list']  = null;
			$this->data['curr_year']  = null;
			$this->data['curr_month']  = null;
			$this->data['week_day_start'] = null;
			$this->data['year_month'] = null;
			$this->data['last_day']  = null;
			$this->data['pre_date']  = null;
			$this->data['next_date'] = null;
			$this->data['attendance'] = null;
			$this->data['student_list'] = array();
		}
		
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load_template('academic/attendance/default');
	}
	
	function add_attend(){
		$this->load->helper('form');
		if(isset($_REQUEST['attendance_date']))
			$this->data['attendance_date'] = $att_id = $_REQUEST['attendance_date'];
		$student = $this->Attendance_model->get_student_info($_GET['student_id']);
		$this->data['student'] = $student[0];
		$this->load->view('academic/attendance/attend_mark',$this->data);
	}
	
	function add_attendance(){
		if(isset($_GET['absent']) && $_GET['absent'] == 'Y'){
			$this->Attendance_model->delete_attendance();
			
			$title = "Mark Attendance";
			$url   = base_url()."attendance/add_attend";
			$cell_id = $_GET['attendance_date'];
			$student_id = $_GET['student_id'];
			$param = 'student_id='.$student_id."&attendance_date=".$cell_id.'&absent=Y';
			echo '<span onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.$student_id.'\')"><i class="fa fa-check"></i></span>';
		}else{
			$obj = $this->Attendance_model->set_attendance();
			
			$cell_id = $_POST['attendance_date'];
			$student_id = $_POST['student_id'];
			$param = 'student_id='.$student_id."&attendance_date=".$cell_id.'&absent=Y';
			echo '<span onclick="remove_attendance(\''.$param.'\', \''.$cell_id.$student_id.'\');"><i class="fa fa-times"></i></span';
		}
	}
	
	function index11(){
		
		$this->data['action_menu'] = FALSE;
		$curr_date = $date = date('Y-m-d');
		if(isset($_REQUEST['attendance_date']) && !empty($_REQUEST['attendance_date'])){
			$curr_date = $_REQUEST['attendance_date'];
		}
		$this->data['curr_date']  = $curr_date;
		$date=date_create($curr_date);
		$dt = date("Y-F-d-t-m");
		$dt = explode('-', $dt);
		$this->data['curr_year']  = $dt[0];
		$this->data['curr_month']  = $dt[1];
		$this->data['total_days']  = $dt[3];
		$d = $dt[0].'-'.$dt[4].'-01';
		$this->data['year_month'] = $curr_year_month = $dt[0].'-'.$dt[4];
		$this->data['week_day_start'] = date('w', strtotime($d));
		$this->data['pre_date']  = $this->Attendance_model->get_date_pre($curr_date);
		$this->data['next_date'] = $this->Attendance_model->get_date_next($curr_date);
		$class   = $this->session->userdata(SESSION_CONST_PRE.'course_id');
		$section = $this->session->userdata(SESSION_CONST_PRE.'section');
		$batch   = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$this->data['week_list'] = $this->Attendance_model->get_weeks($batch);
		$this->data['student_list'] = $this->Attendance_model->get_student_by_class_section($class, $section);
		
		$this->data['courses_list'] = Base_model::get_all_courses();		
		$this->load_template('academic/attendance/default');
	}
	
	function weekday(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->weekday_list();
	}
	
	function classtiming(){
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'0','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$func1 = $this->uri->segment(3);
		if($func1 == 'delete'){
			if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
				$this->Attendance_model->delete_classtiming($_GET['selected_id']);
				redirect('timetable/classtiming','location');
			}
		}
		$this->classtiming_list();
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/timetable/display/';
		$config['total_rows']=$this->Attendance_model->get_num_timetables();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['timetable_list']=$this->Attendance_model->get_all_timetables($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('academic/attendance/default');
	}
	
	function batch_timing(){
		$id = $this->uri->segment(3);
		$this->data['subject_employee_list']  =  $this->Attendance_model->get_subject_employee_by_batch($id);
		$this->data['weekday_list'] =Base_model::get_weekdays($id);
		$this->data['ct_list']  =  $this->Attendance_model->get_ctlist($id);
		$this->load->view('academic/attendance/batch_timing', $this->data);
		
	}
	
	function timetable_list(){
		
		$this->data['courses_list'] = Base_model::get_all_courses();
		/*$this->data['batch_list'] =Base_model::get_all_batches(2);
		$this->data['subject_employee_list']  =  $this->Attendance_model->get_subject_employee_by_batch(7);
		$this->data['weekday_list'] =Base_model::get_weekdays(7);
		$this->data['ct_list']  =  $this->Attendance_model->get_ctlist(7);*/
		$this->load_template('academic/attendance/default');
	}
	
	function weekday_list(){
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['courses_list'] = Base_model::get_all_courses();
		//$this->data['form']  =  $this->Attendance_model->get_timetable($id);
		$this->load_template('academic/attendance/weekday');
	}
	
	function classtiming_list(){
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['courses_list'] = Base_model::get_all_courses();
		//$this->data['form']  =  $this->Attendance_model->get_timetable($id);
		$this->load_template('academic/attendance/classtiming');
	}
	
	function ct_list(){
			
		$id = $this->uri->segment(3);
		$this->data['ct_list']  =  $this->Attendance_model->get_ctlist($id);
		$this->load->view('academic/attendance/ct_list', $this->data);
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Attendance_model->insert();
			redirect('timetable','location');
		}
		else
		{
			$this->data['company_list'] = Base_model::get_all_companies();
			$this->load_template('academic/attendance/add');
		} 
	}

	function subject_employee(){
		$id = $this->uri->segment(3);
		$this->data['employee_list'] = $this->Attendance_model->get_employee_by_subject($id);
	
		$this->load->view('academic/attendance/subject_teacher', $this->data);
	}
	
	function add_subject_teacher(){
		if(isset($_GET['f']) && $_GET['f'] == 'insert'){
			$id = $_POST['batch_id'];
			$this->data['weekday_list'] = $arr =Base_model::get_weekdays($id);
			
			$this->Attendance_model->insert_subject_employee($arr[0]);
			
			$this->data['subject_employee_list']  =  $this->Attendance_model->get_subject_employee_by_batch($id);
			$this->data['ct_list']  =  $this->Attendance_model->get_ctlist($id);
			$this->load->view('academic/attendance/batch_timing', $this->data);
		}
		else{
			$id = $this->uri->segment(3);
			$this->data['subject_list'] = Base_model::get_subjects_by_course($id);
			$this->load->view('academic/attendance/add_subject_teacher', $this->data);
		}
	}
	
	function remove_subject_teacher(){
		if(isset($_POST['param']) ){
			$arr = explode('-', $_POST['param']);
			$this->Attendance_model->delete_subject_employee($arr);
			$id = $arr[2];
			$this->data['subject_employee_list']  =  $this->Attendance_model->get_subject_employee_by_batch($id);
			$this->data['weekday_list'] =Base_model::get_weekdays($id);
			$this->data['ct_list']  =  $this->Attendance_model->get_ctlist($id);
			$this->load->view('academic/attendance/batch_timing', $this->data);
		}
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['company_list'] = Base_model::get_all_companies();
		$this->data['form']  =  $this->Attendance_model->get_timetable($id);
		$this->load_template('academic/attendance/edit');
	}
	
	function update(){
		$this->Attendance_model->update();
		$config['base_url'] = base_url().'index.php/timetable/';
		redirect('timetable','location');
	}
	
	function weekday_update(){
		$id = $this->uri->segment(3);
		if($_POST['db_check'] == 0){
			$this->Attendance_model->weekday_update($id);
		}
		else{
			$this->Attendance_model->weekday_insert($id);
		}
		echo 'Save Successfully!!';
	}
	
	function ct_update(){
		$id = $this->uri->segment(3);
		if($_POST['db_check'] == 0){
			$this->Attendance_model->ct_update($id);
		}
		else{
			$this->Attendance_model->ct_insert($id);
		}
		echo 'Save Successfully!!';
		$this->ct_list();
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Attendance_model->delete($_GET['selected_id']);
			redirect('timetable','location');
		}
	}
}