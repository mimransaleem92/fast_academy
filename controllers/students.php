<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends Base_Controller{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Students_model','',TRUE);
		
	}
	
	function accounts_posting(){
		ini_set('max_execution_time', 600);
		$this->Students_model->accounts_updating();
		echo 'Done';
	}
	
	function index(){
		//$this->Students_model->update_admission_number();
		//$this->Students_model->insert_student_subjects_monthly();
		//$this->Students_model->insert_student_payments_monthly();
		
		$this->data['courses_list'] = Base_model::get_all_courses();
		$limit = $this->uri->segment(2);  
		if(is_nan($limit)) $limit = 0;
		$this->display($limit);
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'students/display/';
		$config['total_rows']=$this->Students_model->get_students_count();
		$this->pagination->initialize($config);
		$this->data['student_list'] = $this->Students_model->get_all_students($row,TRUE);	
		$this->data['page_count'] = $row;
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/students/default');
	}
	
	function student_list(){
		
		$this->data['student_list'] = $this->Students_model->get_all_students();
		$this->load_template('settings/students/default');
	}
	
	function process_fee(){
		$enrollment_id=$this->uri->segment(3);
		$student = $this->Students_model->transfer_to_students($enrollment_id);
		
		/*$files = $this->Students_model->get_student_files($enrollment_id);
	 	$dir = explode('/', $files[0]->file_path);
	 	$i = sizeof($dir);
	 	$enrollment_admission_number = $dir[$i-2];
	 	$admission_number = $student[1];*/
	 	
		redirect('students/student_profile/'.$student[0]."#tabs_3",'location');
	}
	
	function valid_sibling(){
		$refer = $this->uri->segment(3);
		$flag = $this->Students_model->valid_sibling($refer);
		if($flag){
			echo '<input class="form-control" style="border-color: green;" name="sibling_student_id" id="sibling_student_id" value="'.$refer.'" onblur="validate_sibling_refer(this.value);"/>';
			echo '<input type="hidden" id="sibling_check" name="sibling_check" value="Y" />';
		}
		else {
			echo '<input class="form-control input-sm" style="border-color: red;" name="sibling_student_id" id="sibling_student_id" value="'.$refer.'" onblur="validate_sibling_refer(this.value);"/>';
			echo '<input type="hidden" id="sibling_check" name="sibling_check" value="N" />';
		}
	}
	
	function load_image(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$id = $this->uri->segment(3);
		$this->data['form']  =  $this->Students_model->get_students($id);
		
		$this->load_template('settings/students/student_image');
	}
	
	function profilephoto(){
		$this->data['id']  = $id =$this->uri->segment(3);
		if(isset($_GET['v'])){
				
			if(isset($_POST['w'])){
				if($_POST['w'] == 0 || $_POST['w'] == null )
				{
					$this->imgupload($id);
					redirect('students/student_profile/'.$id,'location');
				}
				else if($_POST['w'] > 0)
				{
					$this->imgcrop();
				}
			}
		}
			
		$this->load_template('settings/students/profilephoto');
	}
	
	function save_crop(){
		
		$config['upload_path'] = './assets/images/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '1048576';
		$config['max_width']  = '10240';
		$config['max_height']  = '7680';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('attached_file'))
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//$this->insert_upload_file_log($data['upload_data'], $formLogId);
		}
		$student_id  = $_POST['student_id'];
		$file_name = $data['upload_data']['file_name'];
		$file = $data['upload_data']['full_path'];
		$this->Students_model->update_image_path($file_name);
		
		$this->load->library('image_lib');

        $config['image_library'] = 'gd2';
        //$config['library_path'] = '/usr/X11R6/bin/';
        $conf['source_image'] = $file;
        //$config['new_image'] = './media/images/uploads/company_uploads/cropped' . $this->input->post('image_name').'_'.time();
        
        $conf['new_image'] = './assets/images/uploads/96x96/'. $file_name;
        $conf['x_axis'] = '0';
        $conf['y_axis'] = '0';
        $conf['width'] = '96';
        $conf['height'] = '128';
        $conf['maintain_ration'] = TRUE;
        $conf['create_thumb'] = TRUE;
        $conf['thumb_marker'] = '';
        $conf['dynamic_output'] = FALSE;
        $this->image_lib->initialize($conf);
        $result = $this->image_lib->resize();          
        if(!$result) {
            echo $this->image_lib->display_errors();
        } else {
            //echo "Success";
            $this->image_lib->clear();
            $this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
			$this->load->helper('form');
	        $this->data['form']  =  $this->Students_model->get_students($student_id);
			$this->load_template('settings/students/student_image');
        }
        
	}
	
	public function get_product_by_code(){
		$this->data['products'] = Base_model::get_product_by_code($_POST['product_code']);
		$this->load->view('ajax/products', $this->data);
	}
	
	function add(){		
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('student_name', 'Student Name','required');
		$this->form_validation->set_rules('date_of_birth', 'Date of Birth','required');
		$this->form_validation->set_rules('course_id', 'Enrolment Grade','required');
		
		
		if($this->form_validation->run() == TRUE){
			$id = $this->Students_model->insert();
			$d = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			$division_name = ($d == 1) ? 'FB' : 'FG';
			$admission_number = $this->Students_model->get_admission_number($id);
			if( isset($_POST['cell_phone_father']) ){
					$student_name = substr($_POST['student_name'], 0, 13);
					$mobile = $_POST['cell_phone_father'];
					
					$message = "AOA". '\n';
					$message .= "Dear ".$student_name.", You has been registered in FAST Academy.\n";
					
					$message .= "Principal". '\n';
					$message .= "FAST Haroonabad". '\n';
					$message .= "03336318287";
					echo $message. strlen($message);
					die('ff');
					$url = "http://bulksms.com.pk/api/sms.php?username=".SMS_API_USERNAME."&password=".SMS_API_PASSWORD."&sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message);

					///Curl start 
					$ch = curl_init();
					$timeout = 30;
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt ($ch, CURLOPT_URL, $url);
					curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					
					$response = curl_exec($ch);
					if(curl_errno($ch))
						print curl_error($ch);
					else
						curl_close($ch);
				}
			$config['upload_path'] = './assets/global/img/uploads/'.$division_name.'/student_files/'.$admission_number;
			$config['allowed_types'] = '*';
			if (!is_dir('assets/global/img/uploads/'.$division_name.'/student_files/'.$admission_number)) {
				mkdir($config['upload_path'], 0777, TRUE);
			}
			$count = count($_FILES['files']['size']);
			foreach($_FILES as $key=>$value)
			{
				for($s=0; $s<=$count-1; $s++)
				{
					$_FILES['files']['name'] = $value['name'][$s];
					$_FILES['files']['type']    = $value['type'][$s];
					$_FILES['files']['tmp_name'] = $value['tmp_name'][$s];
					$_FILES['files']['error']       = $value['error'][$s];
					$_FILES['files']['size']    = $value['size'][$s];
					$config['file_name'] = str_replace(' ', '_', trim($_FILES['files']['name']));
				
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('files'))
					{
						//$data['files'][$s] = $this->upload->data();
						$data = array('upload_data' => $this->upload->data());
						$this->Students_model->upload_file_log($data['upload_data'], $id, 'Student');
	    			}
					else
					{
						$data['upload_errors'][$s] = $this->upload->display_errors();
					}
				}
			}
			redirect('students','location');
		}
		else
		{
			$this->data['not_popup'] = false;
			$this->data['new_adminition_no'] = Base_model::get_adminition_no();
			$this->data['batch_list'] = Base_model::get_all_batches(1);
			$this->data['courses_list'] = Base_model::get_all_courses();
			$this->data['subject_list'] = Base_model::get_all_subjects();
			$this->data['subject_selected'] = null;
			$this->data['country_list'] = Base_model::get_country_list();
			$this->load_template('settings/students/add');
		}
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$record = $this->data['form']  =  $this->Students_model->get_students($id);
		$params = $record[0]->course_id;
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$month = date('m');
		$this->data['subject_list'] = $this->Students_model->get_available_subjects($id, $record[0]->batch_id, $month);
		$this->data['subject_selected'] = $this->Students_model->get_monthly_subjects_detail($id, $record[0]->batch_id, $month);
		$this->data['files'] = $this->Students_model->get_student_files($id);
		$this->session->set_userdata('student_id', $id);
		//$this->data['guardian']  =  Base_model::get_guardians($id);
		$this->data['previous_data']  =  Base_model::get_previous_data($id);
		
		$this->data['education_plus_fee']  = $this->getEducationPlusFee($params); // get education plus based on grade
		
		$this->data['not_popup']  = TRUE;
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['country_list'] = Base_model::get_country_list();
		$this->load_template('settings/students/edit');
	}
	
	function school_leaving(){
		$this->load->helper('form');
		$id = $this->uri->segment(3);
		$this->data['form']  =  $this->Students_model->get_students($id);
		$this->data['courses_list'] = Base_model::get_all_courses();
		
		$this->load_template('settings/students/school_leaving_form');
	}
	
	function student_profile(){
		//$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$start = microtime(true);
		$this->load->helper('form');
		
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
		$this->data['pre_date']  = $this->Students_model->get_date_pre($curr_date);
		$this->data['next_date'] = $this->Students_model->get_date_next($curr_date);
		
		$id = $this->uri->segment(3);
		if(is_null($id) || $id == 0) $id = 1;
		$this->data['student_id'] = $id;
		$this->data['form'] = $student  =  $this->Students_model->get_students($id);
		$this->data['guardian']  =  null;//Base_model::get_guardians($id);
		$this->data['previous_data']  =  Base_model::get_previous_data($id); 
		$this->session->set_userdata('student_id', $id);
		
		$detail_list = $this->Students_model->get_attendance($id, $curr_year_month);
		$app_arr = array();
		if(isset($detail_list) && sizeof($detail_list) > 0){
			foreach($detail_list as $values){
				$ind = str_replace($curr_year_month.'-', '', $values->attendance_date);				
				$app_arr[$ind] = $values->attendance_comment;
			}
		}
		$this->data['attendance'] = $app_arr;
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$batch_id = $student[0]->batch_id;
		$active_flag = $student[0]->cdel;
		$this->data['outstanding']  =  null;//$this->Students_model->get_students_outstandings($id, $batch_id, $active_flag);
		$this->data['pending_fee_list']  =  null;//$this->Students_model->get_students_fee_pending_detail($id, $batch_id, $active_flag);
		$this->data['fee_paid_list']  =  null;//$this->Students_model->get_students_fee_paid_detail($id, $batch_id);
		//$this->data['assesment_list'] = Base_model::get_student_assesments($id);
		$this->data['term_list'] = $this->Students_model->get_term_list();
		$this->data['subject_list'] = $row = $this->Students_model->get_subjects_info($student[0]->course_id);
		$title = explode(', ', $row[0]->marksheet_title);
		$score = explode(', ', $row[0]->marksheet_score);
		$this->data['header_title'] = $title;
		$this->data['header_score'] = $score;
		$this->data['col_average'] = $row[0]->average;
		$this->data['col_total'] = $row[0]->total;
		
		$mark_detail = $this->Students_model->get_student_marks($student[0]->student_id, $student[0]->course_id, $student[0]->section, $batch_id, '1');
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][$m->subject_id][0] = $m->field1;
			$marks[$m->student_id][$m->subject_id][1] = $m->field2;
			$marks[$m->student_id][$m->subject_id][2] = $m->field3;
			$marks[$m->student_id][$m->subject_id][3] = $m->field4;
			$marks[$m->student_id][$m->subject_id][4] = $m->field5;
			$marks[$m->student_id][$m->subject_id][5] = $m->field6;
			$marks[$m->student_id][$m->subject_id][6] = $m->field7;
			$marks[$m->student_id][$m->subject_id][7] = $m->field8;
		}
		$this->data['marks'] = $marks;
		
		$this->data['voucher_list']  =  null;//$this->Students_model->get_students_vouchers($id, $batch_id); // For refund details
		$this->data['country_list'] = Base_model::get_country_list();
		$this->data['subjects'] = $row = $this->Students_model->get_monthly_subjects_detail($student[0]->student_id, $batch_id, $dt[4]);
		
		$this->data['subject_list'] = $this->Students_model->get_available_subjects($student[0]->student_id, $batch_id, $dt[4]);
		$this->data['subject_selected'] = $this->Students_model->get_monthly_subjects_detail($student[0]->student_id, $batch_id, $dt[4]);
		
		$time_elapsed_secs = microtime(true) - $start;
		$this->data['time_elapsed'] = $time_elapsed_secs;
		$this->load_template('settings/students/profile');
	}
	
	function update_monthly_subjects(){
		
		$id = $_POST['student_id'];
		$batch_id = $_POST['batch_id'];
		$course_id = $_POST['course_id'];
		$month = $_POST['month'];
		$this->Students_model->update_monthly_subjects($id, $batch_id, $course_id, $month);
		
		redirect('students/student_profile/'.$id,'location');
	}
	
	function get_student_term_marks(){
		$id = $_POST['student_id'];
		$term = $_POST['term_id'];
		$student  =  $this->Students_model->get_students($id);
		$term_list = $this->Students_model->get_term_list();
		$this->data['student'] = $student[0];
		$term_name = 'First';
		foreach ($term_list as $tr){ 
			if(isset($_POST['term_id']) && ($_POST['term_id'] == $tr->id)) {  $term_name = $tr->name; break;}
		}
		$this->data['term_name'] = $term_name;
		$this->data['subject_list'] = $row = $this->Students_model->get_subjects_info($student[0]->course_id);
		$title = explode(', ', $row[0]->marksheet_title);
		$score = explode(', ', $row[0]->marksheet_score);
		$this->data['header_title'] = $title;
		$this->data['header_score'] = $score;
		$this->data['col_average'] = $row[0]->average;
		$this->data['col_total'] = $row[0]->total;
		$batch_id = $student[0]->batch_id;
		$mark_detail = $this->Students_model->get_student_marks($id, $student[0]->course_id, $student[0]->section, $batch_id, $term);
		$marks = array();
		foreach ($mark_detail as $m){
			$marks[$m->student_id][$m->subject_id][0] = $m->field1;
			$marks[$m->student_id][$m->subject_id][1] = $m->field2;
			$marks[$m->student_id][$m->subject_id][2] = $m->field3;
			$marks[$m->student_id][$m->subject_id][3] = $m->field4;
			$marks[$m->student_id][$m->subject_id][4] = $m->field5;
			$marks[$m->student_id][$m->subject_id][5] = $m->field6;
			$marks[$m->student_id][$m->subject_id][6] = $m->field7;
			$marks[$m->student_id][$m->subject_id][7] = $m->field8;
		}
		$this->data['marks'] = $marks;
		
		$this->load->view('settings/students/assesment_sheet',$this->data);
	}
	
	function get_fee_paid(){
	
		$id = $_POST['student_id'];
		$batch_id = $_POST['batch_id'];
		$this->data['fee_paid_list']  =  $this->Students_model->get_students_fee_paid_detail($id, $batch_id);
		$this->data['voucher_list']  =  $this->Students_model->get_students_vouchers($id, $batch_id); // For refund details echo "Hi...";
	
		$this->load->view('settings/students/fee_paid_list',$this->data);
	}
	
	function get_fee_pending(){
		
		$id = $_POST['student_id'];
		$batch_id = $_POST['batch_id'];
		$this->data['outstanding']  =  $this->Students_model->get_students_outstandings($id, $batch_id);
		$this->data['pending_fee_list']  =  $this->Students_model->get_students_fee_pending_detail($id, $batch_id);
	
		$this->load->view('settings/students/fee_pending_list',$this->data);
	}
	
	function payment(){
		$fee_payment_allowed = $this->session->userdata(SESSION_CONST_PRE.'fee_payment');
		$id = $_GET['student_id'];
		$this->data['form']  = $student =  $this->Students_model->get_students($id);
		$check_list = $student[0]->check_list;
		$verified = true;
		if (strpos($check_list, '10') !== false){
			$verified = false;
		}
		
		if($fee_payment_allowed == 'N' || $verified ){
			$err = ($verified) ? '2': '1';
			if(isset($_GET['student_id']) && !empty($_GET['student_id'])){
				redirect('students/student_profile/'.$_GET['student_id']."?e=".$err,'location');
			}else{
				//redirect('logout','location');
			}
		}
		
		$start = microtime(true);
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
	
		$id = $_GET['student_id'];
		$this->data['form']  = $student =  $this->Students_model->get_students($id);
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		
		$batch_id = $student[0]->batch_id;
		$this->data['outstanding']  =  $this->Students_model->get_students_outstanding_details($id, $batch_id);
		$this->data['pending_fee_list']  =  $this->Students_model->get_students_fee_pending_detail($id, $batch_id);
		
		//-get cheque values if 1st term pay 50% with no cheques 3rd term remaining 50% ( 50% + 50% 1 cheque) : for DIS
		$this->data['last_payment']  =  $this->Students_model->get_students_last_payment_with_one_cheque($id, $batch_id);
		$this->data['first_term_fee']  =  $this->Students_model->get_first_term_fee_amount($student[0]->course_id);
		
		$this->data['not_popup']  = TRUE;
		$this->data['courses_list'] = Base_model::get_all_courses();
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
		$time_elapsed_secs = microtime(true) - $start;
		$this->data['time_elapsed'] = $time_elapsed_secs;
		$this->load_template('settings/students/payment');
	}
	
	function payment_receive(){
		
		$this->Students_model->insert_payment();
		redirect('students/student_profile/'.$_POST['student_id']."#tabs_3",'location');
	}
	
	function payment_receipt(){
		$payment_id = $this->uri->segment(3);
		$id = $_GET['student_id'];
		$this->data['student']  = $student = $this->Students_model->get_students($id);
		$batch_id = $student[0]->batch_id;
		$this->data['pending_fee_list']  =  $this->Students_model->get_students_fee_pending_detail($id, $batch_id, $student[0]->cdel);
		$this->data['payment']  = $payment = $this->Students_model->get_student_payments($payment_id);
		$this->data['paid_trans']  = NULL;
		if( in_array($payment[0]->fee_desc, array('Tuition Fee', 'Education Plus Fee', 'Transportation Fee', 'Payment'))){
			$this->data['paid_trans']  =  $this->Students_model->get_student_transactions($id, $batch_id, $payment[0]->fee_desc, $student[0]->cdel);
		}
		$this->load->view('settings/students/payment_receipt',$this->data);
	}
	
	/**
	 * Function		: payment_receipts
	 * Purpose		: to print all receipts of the student provided
	 */
	function payment_receipts(){
		$i=0; $p = (isset($_GET['p'])) ? $_GET['p'] : 0;
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$course_id = $this->uri->segment(3);
		$students = $this->Students_model->get_students_by_grade($course_id, $div_id, $p);
		foreach ($students as $student){ $i++;
			$this->data['student']  = $student;
			$id = $student->student_id;
			$batch_id = $student->batch_id;
			$this->data['pending_fee_list'] =  $this->Students_model->get_students_fee_pending_detail($id, $batch_id, $student->cdel);
			$this->data['payments']  = $payments = $this->Students_model->get_payments_by_student($id);
			foreach ($payments as $payment){
				$this->data['paid_trans'][$payment->payment_id]  = NULL;
				if( in_array($payment->fee_desc, array('Tuition Fee', 'Education Plus Fee', 'Transportation Fee', 'Payment'))){
					$this->data['paid_trans'][$payment->payment_id]  =  $this->Students_model->get_student_transactions($id, $batch_id, $payment->fee_desc, $student->cdel);
				}
			}
			$this->load->view('settings/students/payment_receipts',$this->data);
		}
	}
	
	function add_guarantee_cheque(){
		$this->load->helper('form');
		$this->data['student_id']  = $id = (isset($_GET['student_id'])) ? $_GET['student_id'] : $_POST['student_id'];
		$batch_id = (isset($_GET['batch_id'])) ? $_GET['batch_id'] : $_POST['batch_id'];
		
		$this->data['form']  =  $this->Students_model->get_students($id);
	
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/add_guarantee_cheque',$this->data);
	}
	
	function add_guarantee_cheque_update(){
		$this->Students_model->insert_guarantee_cheque();
		$id = $_POST['student_id'];
		$batch_id = $_POST['batch_id'];
		$this->data['fee_paid_list']  =  $this->Students_model->get_students_fee_paid_detail($id, $batch_id);
		$this->data['voucher_list']  =  $this->Students_model->get_students_vouchers($id, $batch_id); // For refund details echo "Hi...";
		
		$this->load->view('settings/students/fee_paid_list',$this->data);
	}
	
	/**
	 * Function		: cheque_receipt
	 * Purpose		: to print guarantee cheque receipt of the student provided
	 * DATED		: 20160623
	 */
	
	function cheque_receipt(){
		$payment_id = $this->uri->segment(3);
		$id = $_GET['student_id'];
		$this->data['student']  = $student = $this->Students_model->get_students($id);
		$batch_id = $student[0]->batch_id;
		$this->data['pending_fee_list']  =  $this->Students_model->get_students_fee_pending_detail($id, $batch_id, $student[0]->cdel);
		$this->data['payment']  = $payment = $this->Students_model->get_student_payments($payment_id);
		$this->data['paid_trans']  = NULL;
		if( in_array($payment[0]->fee_desc, array('Tuition Fee', 'Education Plus Fee', 'Transportation Fee', 'Payment'))){
			$this->data['paid_trans']  =  $this->Students_model->get_student_transactions($id, $batch_id, $payment[0]->fee_desc, $student[0]->cdel);
		}
		$this->load->view('settings/students/cheque_receipt',$this->data);
	}
	
	function add_payment(){
		$this->load->helper('form');
		$this->data['student_id']  = $id = (isset($_GET['student_id'])) ? $_GET['student_id'] : $_POST['student_id'];
		//$batch_id = (isset($_GET['batch_id'])) ? $_GET['batch_id'] : $_POST['batch_id'];
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['form'] = $student = $this->Students_model->get_students($id);
		$this->data['subjects'] = $this->Students_model->get_monthly_subjects_detail($student[0]->student_id, $student[0]->batch_id, $student[0]->month);
		$this->data['pending_amount']  =  $this->Students_model->get_students_monthly_pending_fee($student[0]->student_id, $student[0]->batch_id, $student[0]->month,$student[0]->cdel);
		
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/add_payment',$this->data);
	}
	
	function add_payment_update(){
		$this->Students_model->insert_monthly_payment();
		$id = $_POST['student_id'];
		$batch_id = $_POST['batch_id'];
		//$this->data['form'] = $student  =  $this->Students_model->get_students($id);
		$this->data['outstanding']  =  $this->Students_model->get_students_outstandings($id, $batch_id);
		$this->data['pending_fee_list']  =  $this->Students_model->get_students_fee_pending_detail($id, $batch_id);
		
		$this->load->view('settings/students/fee_pending_list',$this->data);
	}
	
	function get_subjects_fee(){
		$month = $this->uri->segment(3);
		$subjects = $this->Students_model->get_monthly_subjects_detail($_POST['student_id'], $_POST['batch_id'], $month);
		$pending_amount  =  $this->Students_model->get_students_monthly_pending_fee($_POST['student_id'], $_POST['batch_id'], $month, 0);
		$sub_str = ''; $subjects_id = '';
		if(isset($subjects)){
			foreach($subjects as $ss){ $subject_count++;
				$sub_str .= ', '.$ss->subject_name;
				$subjects_id .= ','.$ss->subject_id;
			}
		}
		$total_due = $pending_amount->due_total;
		$total_pending = $total_due - $pending_amount->total_payment - $pending_amount->total_discount;
		$this->data = array('subjects_id'=>substr($subjects_id, 1, strlen($subjects_id)), 'subject_name'=>substr($sub_str, 1, strlen($sub_str)),'pending_amount'=>$total_pending);
		$this->load->view('settings/students/add_payment_onchange_month',$this->data);
		//return json_encode($arr);
		//print_r($arr);
		
	}
	
	function add_discount(){
		$this->load->helper('form');
		$this->data['student_id']  = $id = (isset($_GET['student_id'])) ? $_GET['student_id'] : $_POST['student_id'];
		//$batch_id = (isset($_GET['batch_id'])) ? $_GET['batch_id'] : $_POST['batch_id'];
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['form']  =  $this->Students_model->get_students($id);
	
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/add_discount',$this->data);
	}
	
	function add_discount_update(){
		$this->Students_model->insert_discount();
		$id = $_POST['student_id'];
		$batch_id = $_POST['batch_id'];
		//$this->data['form'] = $student  =  $this->Students_model->get_students($id);
		$this->data['outstanding']  =  $this->Students_model->get_students_outstandings($id, $batch_id);
		$this->data['pending_fee_list']  =  $this->Students_model->get_students_fee_pending_detail($id, $batch_id);
		
		$this->load->view('settings/students/fee_pending_list',$this->data);
	}
	
	function holding_trans(){
		$this->load->helper('form');
		$id = (isset($_GET['student_id'])) ? $_GET['student_id'] : $_POST['student_id'];
		$batch_id = (isset($_GET['batch_id'])) ? $_GET['batch_id'] : $_POST['batch_id'];
		$payment_id = (isset($_GET['id'])) ? $_GET['id'] : $_POST['id'];
		$this->data['form']  =  $this->Students_model->get_students($id);
		$this->data['values']  = $this->Students_model->get_students_fee_paid_detail($id, $batch_id, $payment_id);
		$this->data['payment_id'] = $payment_id;
		
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/holding_transaction',$this->data);
	}
	
	function holding_trans_update(){
		$this->Students_model->update_transaction();
		?>
			<a href="#" class="btn default btn-xs red-stripe disabled"  >Hold</a>
	    <?php
	}
	
	/*
	 * Function:  close_payment
	 * Purpose:   to close the hold transactions 
	 * Dated:     03-MAY-2016 02:42 PM
	 * Created by: IMRAN SALEEM
	 */
	
	function close_payment(){
		$payment_id = $this->uri->segment(3);
		$this->Students_model->delete_transaction($payment_id);
		
		$id = $_POST['student_id'];
		$batch_id = $_POST['batch_id'];
		$this->data['fee_paid_list']  =  $this->Students_model->get_students_fee_paid_detail($id, $batch_id);
		$this->data['voucher_list']  =  $this->Students_model->get_students_vouchers($id, $batch_id); // For refund details echo "Hi...";
		
		$this->load->view('settings/students/fee_paid_list',$this->data);
	}
	
	/*
	 * Function:  holdentries
	 * Purpose:   to view hold transactions
	 * Dated:     04-MAY-2016 12:50 PM
	 * Created by: IMRAN SALEEM
	 */
	
	function holdentries(){
		
		$this->data['payment_list']  = $form = $this->Students_model->get_all_hold_entries();
		$this->load->view('settings/students/holdentries',$this->data);
	}
	
	/*
	 * Function:  close_holdentries
	 * Purpose:   to update the hold transactions
	 * 			  and update mark_delete value 9
	 * 		      and delete all financial effects like voucher_detail and accouts entry of this trans
	 * Dated:     03-MAY-2016 03:37 PM
	 * Created by: IMRAN SALEEM
	 */
	
	function close_holdentries(){
	
		if(isset($_POST['id_list']) && !empty($_POST['id_list'])){
			$voucher_arr = explode(",", $_POST['id_list']);
			foreach ($voucher_arr as $payment_id)
			{
				$this->Students_model->delete_transaction($payment_id);
			}
		}
		
		$this->holdentries();
	}
	
	function outstanding_detail(){
		$this->load->helper('form');
		$id = (isset($_GET['student_id'])) ? $_GET['student_id'] : $_POST['student_id'];
		$batch_id = (isset($_GET['batch_id'])) ? $_GET['batch_id'] : $_POST['batch_id'];
		$this->data['outstanding']  = $this->Students_model->get_students_outstanding_details($id, $batch_id);
		$this->data['batch_id'] = $batch_id;
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/outstanding_detail',$this->data);
	}
	
	function edit_outstanding_data(){
		$this->load->helper('form');
		$id = (isset($_GET['student_id'])) ? $_GET['student_id'] : $_POST['student_id'];
		$batch_id = (isset($_GET['batch_id'])) ? $_GET['batch_id'] : $_POST['batch_id'];
		//$this->data['outstanding']  = $this->Students_model->get_students_outstandings($id, $batch_id);
		$this->data['outstanding']  = $this->Students_model->get_students_outstanding_details($id, $batch_id);
		$this->data['batch_id'] = $batch_id;
		$this->data['batch_list'] = Base_model::get_all_batches(1);
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/edit_outstanding_detail',$this->data);
	}
	
	function edit_outstanding_data_update(){
		
		$this->Students_model->update_outstanding_data();
		$batch_id = $_POST['batch_id'];
		$outstanding = $this->Students_model->get_students_outstandings($_POST['student_id'], $batch_id);
		if(isset($outstanding[0])){ $outstanding = $outstanding[0];
			$url   = base_url()."students/edit_outstanding_data";
			$param = 'student_id='.$outstanding->student_id.'&batch_id='.($outstanding->batch_id);
			$title = "Update Arrears / Outstanding";
			//echo number_format($outstanding[0]->due_total, 2, '.', ''); // new amount
			?>
			<td><?php echo 'Fee Outstanding'; ?></td>
            <td style="text-align: right; padding-right: 60px;" id="tdDueAmount"><?php echo $outstanding->due_total?></td>
            <td style="text-align: right; padding-right: 110px;"><?php echo $outstanding->total_payment?></td>
            <td style="text-align: right; padding-right: 80px;"><?php echo $outstanding->total_discount?></td>
            <td style="text-align: right; padding-right: 90px;" nowrap="nowrap">
            	<span style="float: left;"><?php echo number_format( $outstanding->due_total - $outstanding->total_payment, 2)?></span>
            </td>
            <td>
            	<a href="#" class="btn default btn-xs red-stripe disabled" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'outstandingDetailForm\', \'tdDueAmount\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'})"'; ?>  >Edit</a>
            </td>
			<?php 
		}
		//$this->load->view('settings/students/updated_previous_detail',$this->data);
	}
	
	function edit_payments(){
		$this->load->helper('form');
		$payment_id = $this->uri->segment(3);
		
		$this->data['payment']  = $payment = $this->Students_model->get_student_payments($payment_id);
		$id = $payment[0]->student_id;
		$this->data['student']  = $student = $this->Students_model->get_students($id);
		$this->load->view('reports/edit_payments',$this->data);
	}
	
	function update_fields(){
		//print_r($_POST);
		$this->Students_model->update_fileds();
		echo $_POST['value'];
	}
	
	/**
	 * Assesment Slip Print
	 */
	
	function assesment_slip(){
		$amount = $this->uri->segment(3);
		$student_id = 0;
		if( isset( $_GET['student_id'] ) ){
			$student_id = $_GET['student_id'];
		}
		
		$this->data['student'] = $this->Students_model->get_student_info($student_id);
		$this->data['assesment_list'] = Base_model::get_student_assesments($student_id);
		$this->load->view('settings/students/assesment_print',$this->data);
	}
	
	
	function get_student_attendance(){
		$this->load->helper('form');
		
		$curr_date = $date = date('Y-m-d');
		if(isset($_GET['attendance_date']) && !empty($_GET['attendance_date'])){
			$curr_date = $_GET['attendance_date'];
		}
		else if(isset($_POST['attendance_date']) && !empty($_POST['attendance_date'])){
			$curr_date = $_POST['attendance_date'];
		}
		$this->data['curr_date']  = $curr_date;
		//$date=date_create($curr_date);
		$dt = date("Y-F-d-t-m", strtotime($curr_date));
		$dt = explode('-', $dt);
		$this->data['curr_year']  = $dt[0];
		$this->data['curr_month']  = $dt[1];
		$this->data['total_days']  = $dt[3];
		$d = $dt[0].'-'.$dt[4].'-01';
		$this->data['year_month'] = $curr_year_month = $dt[0].'-'.$dt[4];
		$this->data['week_day_start'] = date('w', strtotime($d));
		$this->data['pre_date']  = $this->Students_model->get_date_pre($curr_date);
		$this->data['next_date'] = $this->Students_model->get_date_next($curr_date);
		
		if(isset($_GET['student_id'])) $st_id = $_GET['student_id'];
		else if(isset($_POST['student_id'])) $st_id = $_POST['student_id'];
		$this->data['student_id'] = $st_id;
		$detail_list = $this->Students_model->get_attendance($st_id, $curr_year_month);
		$app_arr = array();
		if(isset($detail_list) && sizeof($detail_list) > 0){
			foreach($detail_list as $values){
				$ind = str_replace($curr_year_month.'-', '', $values->attendance_date);				
				$app_arr[$ind] = $values->attendance_comment;
			}
		}
		$this->data['attendance'] = $app_arr;
		
		$this->load->view('settings/students/attendance_detail',$this->data);
	}
	
	function add_attend(){
		$this->load->helper('form');
		if(isset($_REQUEST['attendance_date']))
		$this->data['attendance_date'] = $att_id = $_REQUEST['attendance_date'];
		
		$this->load->view('settings/students/attend_mark',$this->data);
	}
	
	function add_attendance(){
		$obj = $this->Students_model->set_attendance();
		
		$this->get_student_attendance();
	}
	/**
	 * Add Contact Detail agains student
	 */
	function add_parent_data(){
		$this->load->helper('form');
		$this->data['student_id'] =  '';
		if(isset($_REQUEST['student_id'])){
			$this->data['student_id'] = $_REQUEST['student_id'];
		}
		elseif(isset($_GET['student_id'])){
			$this->data['student_id'] = $_GET['student_id'];
		}
		$this->data['not_popup']  = FALSE;
		$this->data['country_list'] = Base_model::get_country_list();
		$this->load->view('settings/students/add_parent_detail',$this->data);
	}
	
	function add_parent_data_insert(){
		$id = $_POST['student_id'];
		$this->Students_model->insert_parent_data();
		$this->data['guardian']  =  Base_model::get_guardians($id);
		$this->load->view('settings/students/updated_parent_detail',$this->data);
	}
	
	function edit_parent_data(){
		$this->load->helper('form');
		
		$this->data['not_popup']  = FALSE;
		$id = $_GET['student_id'];
		$this->data['guardian']  = Base_model::get_guardians($id);
		$this->data['country_list'] = Base_model::get_country_list();
		$this->load->view('settings/students/edit_parent_detail',$this->data);
	}
	
	function edit_parent_data_update(){
		
		$id = $_POST['student_id'];
		$this->Students_model->update_parent_data();
		$this->data['guardian']  =  Base_model::get_guardians($id);
		$this->load->view('settings/students/updated_parent_detail',$this->data);
	}
	
	/**
	 * Add Previous academic Detail agains student
	 */
	function add_previous_data(){
		$this->load->helper('form');
		$this->data['student_id'] =  '';
		if(isset($_REQUEST['student_id'])){
			$this->data['student_id'] = $_REQUEST['student_id'];
		}
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/add_previous_detail',$this->data);
	}
	
	function add_previous_data_insert(){
		$id = $_REQUEST['student_id'];
		$this->Students_model->insert_previous_data();
		$this->data['previous_data']  =  Base_model::get_previous_data($id);
		$this->load->view('settings/students/updated_previous_detail',$this->data);
	}
	
	function edit_previous_data(){
		$this->load->helper('form');
		if(isset($_GET['id'])) $id = $_GET['id'];
		else if(isset($_POST['id'])) $id = $_POST['id'];
		$this->data['previous_data']  = $predata = Base_model::get_previous_data($id, false);
		$this->data['not_popup']  = FALSE;
		$this->load->view('settings/students/edit_previous_detail',$this->data);
	}
	
	function edit_previous_data_update(){
		$id = $_REQUEST['student_id'];
		$this->Students_model->update_previous_data();
		$this->data['previous_data']  =  Base_model::get_previous_data($id);
		
		$this->load->view('settings/students/updated_previous_detail',$this->data);
	}
	
	function update(){
		$id = $this->Students_model->update();
		$d = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$division_name = ($d == 1) ? 'FB' : 'FG';
		$config['upload_path'] = './assets/global/img/uploads/'.$division_name.'/student_files/'.$_POST['admission_number'];
		$config['allowed_types'] = '*';
		if (!is_dir('assets/global/img/uploads/'.$division_name.'/student_files/'.$_POST['admission_number'])) {
			mkdir($config['upload_path'], 0777, TRUE);
				
		}	
		$count = count($_FILES['files']);
		//print_r($_FILES);
		foreach($_FILES as $key=>$value)
		{
			for($s=0; $s<$count; $s++)
			{
				$_FILES['files']['name'] = $value['name'][$s];
				$_FILES['files']['type']    = $value['type'][$s];
				$_FILES['files']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['files']['error']       = $value['error'][$s];
				$_FILES['files']['size']    = $value['size'][$s];
				$config['file_name'] = str_replace(' ', '_', trim($_FILES['files']['name']));
				//echo $_FILES['files']['name'].'<br>';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('files'))
				{
				    $data['files'][$s] = $this->upload->data();
					$data = array('upload_data' => $this->upload->data());
					$this->Students_model->upload_file_log($data['upload_data'], $id, 'Student');
    			}
				else
				{
					$data['upload_errors'][$s] = $this->upload->display_errors();
				}
			}
		}
		redirect('students/student_profile/'.$_POST['student_id'],'location');
	}
	
	function delete(){
		
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$admin_role = $this->session->userdata(SESSION_CONST_PRE.'admin_role');
			if($admin_role  >= 3){
				$this->Students_model->delete($_GET['selected_id']);
			}
			redirect('students','location');
		}
	}
	
	function enable_student(){
		
		$admin_role = $this->session->userdata(SESSION_CONST_PRE.'admin_role');
		if($admin_role >= 3){
			$id = $this->uri->segment(3);
			$this->Students_model->activate_student($id);
			redirect('students/student_profile/'.$id,'location');
		}
		redirect('students','location');
	}
	
	public function htmlprint(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'0','view'=>'0','confirm'=>'0','print'=>'1');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['form']  =  $this->Students_model->get_students($id);
		$this->data['dept_list'] = Department_model::get_all_departments(); // For Select in the Form
		$this->load->view('students/print', $this->data);
	}
	
	function imgcrop(){
		//echo 'Testing image crop';
		$id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$dir_path = './assets/uploads/students/';
	
		$file_path = $dir_path . "/Profile.small.jpg";
		$src = $dir_path .'Profile.jpg';
		if(file_exists($file_path)){
			$src = $dir_path .'Profile.small.jpg';
		}
	
		$imgW = $_POST['w'];
		$imgH = $_POST['h'];
		$imgY1 = $_POST['y'];
		$imgX1 = $_POST['x'];
		$cropW = $_POST['w'];
		$cropH = $_POST['h'];
	
		$jpeg_quality = 100;
	
		//$img_r = imagecreatefromjpeg($src);
		$what = getimagesize($src);
		//list($imgInitW, $imgInitH, $type, $what) = getimagesize($src);
		$imgW = $imgInitW = $what[0];
		$imgH = $imgInitH = $what[1];
		switch(strtolower($what['mime']))
		{
			case 'image/png':
				$img_r = imagecreatefrompng($src);
				$source_image = imagecreatefrompng($src);
				$type = '.png';
				break;
			case 'image/jpeg':
				$img_r = imagecreatefromjpeg($src);
				$source_image = imagecreatefromjpeg($src);
				$type = '.jpeg';
				break;
			case 'image/jpg':
				$img_r = imagecreatefromjpeg($src);
				$source_image = imagecreatefromjpeg($src);
				$type = '.jpg';
				break;
			case 'image/gif':
				$img_r = imagecreatefromgif($src);
				$source_image = imagecreatefromgif($src);
				$type = '.gif';
				break;
			default: die('image type not supported');
		}
	
		$resizedImage = imagecreatetruecolor($imgW, $imgH);
		imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW,
		$imgH, $imgInitW, $imgInitH);
	
	
		$dest_image = imagecreatetruecolor($cropW, $cropH);
		imagecopyresampled($dest_image, $source_image, 0, 0, $imgX1, $imgY1, $cropW,
		$cropH, $cropW, $cropH);
	
	
		imagejpeg($dest_image, $dir_path.'Profile.small.jpg', $jpeg_quality);
	
	}
	
	function imgupload($fileName=''){
	
		$id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$dir_path = './assets/uploads/students';
	
		if(!file_exists($dir_path) && !is_dir($dir)){
			mkdir($dir_path);
		}
		$config['upload_path'] = $dir_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $fileName;
		$config['overwrite'] = TRUE;
		$config['image_width'] = 800;
		$config['image_height'] = 600;
		$this->load->library('upload', $config);
		//print_r($_FILES['crop_file']);
		$this->data['file_name'] = $fileName;
		if ( ! $this->upload->do_upload('crop_file'))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
		else
		{
			$this->data['file_name'] = 'Profile.jpg';str_replace(' ', '_', $_FILES['crop_file']['name']);
			$data = array('upload_data' => $this->upload->data()); //print_r($data);
				
			$file_path = $dir_path . "/Profile.small.jpg";
			if(file_exists($file_path)){
				unlink($file_path);
			}
			//$this->insert_upload_file_log($data['upload_data'], $formLogId);
		}
	}
	
	function view_file(){
		$student_id = $this->uri->segment(3);
		$this->data['file']  = $this->Students_model->get_attached_file($_GET['f']);
		
		$this->load->view('settings/students/view_file', $this->data);
	}
	
	function download_file(){
		$student_id = $this->uri->segment(3);
		$this->data['file']  = $this->Students_model->get_attached_file($_GET['f']);
		
		$this->load->view('settings/students/download_file', $this->data);
	}
	
	function download_zip(){
		$id = $this->uri->segment(3); // lecture_id
		$this->data['form']  =  $this->Students_model->get_student_files($id);
		$this->data['student_id']  = $id;
		$this->load->view('settings/students/download_zip', $this->data);
	}
	
	function cron_process(){
		$check = $this->Students_model->add_trem_fee();
		if($check){
			echo 'Done Successfully';	
		}
	}
	
	function print_view(){
		$this->load->helper('form');
	
		$id = $this->uri->segment(3);
		$this->data['form'] = $form =  $this->Students_model->get_students($id);
		
		$countries = Base_model::get_country_list();
		foreach ($countries as $row){
			$c[$row->id] = $row->nationality;	
		}
		$this->data['country_list'] = $c;
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');		
		$this->load->view('settings/students/print_view'.$div_id, $this->data);
	}
}