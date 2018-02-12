<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends Base_Controller{

	function Employee()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Employee_model','',TRUE);
		
	}
	
	function index(){
		$this->employee_list();/*
		$limit = $this->uri->segment(2);  
		if(is_nan($limit)) $limit = 0;
		$this->display($limit);*/
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'employee/display/';
		$config['total_rows']=$this->Employee_model->get_num_employees();
		$this->pagination->initialize($config);
		$this->data['employee_list'] = $this->Employee_model->get_all_employees($row,FALSE);	
		
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/employees/default');
	}
	
	function employee_list(){
		
		$this->data['employee_list'] = $this->Employee_model->get_all_employees();
		$this->load_template('settings/employees/default');
	}
	
	function search(){
		$this->data['employee_list'] = $this->Employee_model->get_search_employees();
		$this->load->view('settings/employees/search_default', $this->data);
	}
	
	function load_image(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$id = $this->uri->segment(3);
		$this->data['form']  =  $this->Employee_model->get_employee($id);
		
		$this->load_template('settings/employees/employee_image');
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
		$employee_id  = $_POST['employee_id'];
		$file_name = $data['upload_data']['file_name'];
		$file = $data['upload_data']['full_path'];
		$this->Employee_model->update_image_path($file_name);
		
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
	        $this->data['form']  =  $this->Employee_model->get_employee($employee_id);
			$this->load_template('settings/employees/employee_image');
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
		$this->form_validation->set_rules('employee_name', 'Employee Name','required');
		
		if($this->form_validation->run() == TRUE){
			
			$emp_id = $this->Employee_model->insert();
			/* New code uploading attached files */
			$d = isset($_POST['division_id']) ? $_POST['division_id'] : '1';
			$division_name = ($d == 1) ? 'DNS' : 'DIS';
			$config['upload_path'] = './assets/global/img/uploads/'.$division_name.'/employee_files/'.$emp_id;
			$config['allowed_types'] = '*';
			if (!is_dir('assets/global/img/uploads/'.$division_name.'/employee_files/'.$emp_id)) {
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
				    	$this->insert_upload_file_log($data['upload_data'], $emp_id, 'Employee');
				    }
				    else
				    {
				    	$data['upload_errors'][$s] = $this->upload->display_errors();
				    }
				}
			}
			/* End code*/
			redirect('employee','location');
		}
		else
		{
			//$this->data['branch_list'] = Base_model::get_all_branchs();
			//$this->data['design_list'] = Base_model::get_all_designations(); // For Select in the Form
			$this->data['division_list']   = Base_model::get_all_division();
			$this->data['grade_list'] = Base_model::get_all_grades();
			$this->data['dept_list'] = Base_model::get_all_departments();
			//$this->data['country_list'] = Base_model::get_country_list();
			
			$this->load_template('settings/employees/add');
		}
	}
	
	function add_subject_course(){
		$check = $this->Employee_model->insert_subject_course();
		if($check){
			echo "Successfully Saved!!";
		}
		else{
			echo "Already in the subject list!!";
		}
		$id = $_POST['employee_id'];
		$this->data['assigned_subject_list'] = $this->Employee_model->get_subjects_course_by_employee($id);
	
		$this->load->view('settings/employees/subject_list', $this->data);
	
	}
	
	function remove_subject_course(){
		$check = $this->Employee_model->delete_subject_course();
		$id = $_POST['employee_id'];
		$this->data['assigned_subject_list'] = $this->Employee_model->get_subjects_course_by_employee($id);
	
		$this->load->view('settings/employees/subject_list', $this->data);
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = (isset($_GET['id'])) ? $_GET['id'] : $this->uri->segment(3);
		$form =  $this->Employee_model->get_employee($id);
		$this->data['form']  = $form[0];
		$this->session->set_userdata('employee_id', $id);
		//$this->data['files'] = $this->Employee_model->get_employee_files($id);
		//$this->data['academic_list'] = $this->Employee_model->get_employee_academic($id);
		//$this->data['experience_list'] = $this->Employee_model->get_employee_experience($id);
		
		$this->data['branch_list'] = Base_model::get_all_branchs();
		$this->data['subject_list'] = $this->Employee_model->get_all_subjects();
		$this->data['assigned_subject_list'] = $this->Employee_model->get_subjects_course_by_employee($id);
		
		$this->data['design_list'] = Base_model::get_all_designations(); // For Select in the Form
		$this->data['division_list']   = Base_model::get_all_division();
		$this->data['courses_list'] = Base_model::get_all_courses();
		//$this->data['grade_list'] = Base_model::get_all_grades();
		//$this->data['dept_list'] = Base_model::get_all_departments();
		//$this->data['country_list'] = Base_model::get_country_list();
		$this->load_template('settings/employees/edit');
	}
	
	function update(){
		$emp_id=$this->Employee_model->update();
		/* New code uploading attached files */
		$d = isset($_POST['division_id']) ? $_POST['division_id'] : '1';
		$division_name = ($d == 1) ? 'DNS' : 'DIS';
		$config['upload_path'] = './assets/global/img/uploads/'.$division_name.'/employee_files/'.$emp_id;
		$config['allowed_types'] = '*';
		if (!is_dir('assets/global/img/uploads/'.$division_name.'/employee_files/'.$emp_id)) {
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
					$this->insert_upload_file_log($data['upload_data'], $emp_id, 'Employee');
				}
				else
				{
			    	$data['upload_errors'][$s] = $this->upload->display_errors();
				}
			}
		}
		//print_r($data);
		/* End code*/
		redirect('employee','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Employee_model->delete($_GET['selected_id']);
			redirect('employee','location');
		}
	}
	
	function view_file(){
		$student_id = $this->uri->segment(3);
		$this->data['file']  = $this->Employee_model->get_attached_file($_GET['f']);
	
		$this->load->view('settings/employees/view_file', $this->data);
	}
	
	function download_file(){
		$student_id = $this->uri->segment(3);
		$this->data['file']  = $this->Employee_model->get_attached_file($_GET['f']);
	
		$this->load->view('settings/employees/download_file', $this->data);
	}
	
	function download_zip(){
		$id = $this->uri->segment(3); // lecture_id
		$this->data['form']  =  $this->Employee_model->get_employee_files($id);
		$this->data['employee_id']  = $id;
		$this->load->view('settings/employees/download_zip', $this->data);
	}
	
	public function htmlprint(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'0','view'=>'0','confirm'=>'0','print'=>'1');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$this->data['form']  =  $this->Employee_model->get_employee($id);
		$this->data['dept_list'] = Department_model::get_all_departments(); // For Select in the Form
		$this->load->view('employees/print', $this->data);
	}
	
	function excel(){
			
		$form_detail = $this->Employee_model->get_all_employees();
		$this->data['model'] = 'employee';
			
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('employee report');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Employee Info');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:M1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		/*---------------------------------------------------------------------------------*/
		$this->excel->getActiveSheet()->mergeCells('A2:G2');
		$this->excel->getActiveSheet()->mergeCells('H2:M2');
		$this->excel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
		$this->excel->getActiveSheet()
		->setCellValue('A2', '')
		->setCellValue('H2', 'DATE:'.date('d-m-Y H:i:s'));
		//->setCellValue('A2', 'From: '.Util::dateDisplayFormate($from).'  To:'.Util::dateDisplayFormate($to))
	
		$this->excel->getActiveSheet()->mergeCells('A3:G3');
		$this->excel->getActiveSheet()->mergeCells('H3:M3');
		$this->excel->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()
		->setCellValue('A3', '')
		->setCellValue('H3', 'Total Records: '.sizeof($form_detail));
	
		/*----------------------------- Report Table Header -----------------------------*/
		$this->excel->getActiveSheet()
		->setCellValue('A4', '#')
		->setCellValue('B4', 'Emp #')
		->setCellValue('C4', 'Emp Name')
		->setCellValue('D4', 'Attnd. LogID')
		->setCellValue('E4', 'Joining')
		->setCellValue('F4', 'DOB')
		->setCellValue('G4', 'Passport #')
		->setCellValue('H4', 'Passport Expiry')
		->setCellValue('I4', 'ID/IQAMA #')
		->setCellValue('J4', 'ID/IQAMA Expiry')
		->setCellValue('K4', 'Local Address')
		->setCellValue('L4', 'Land Line #')
		->setCellValue('M4', 'Mobile #')
		->setCellValue('N4', 'Email Id')
		->setCellValue('O4', 'Contact Person Name')
		->setCellValue('P4', 'Contact Person Mobile #')
		->setCellValue('Q4', 'Documents Check List');
		/*---------------------------------------------------------------------------------*/
	
		$i=4; $msg_flag = TRUE;
		if(isset($form_detail) && sizeof($form_detail) > 0){
			foreach($form_detail as $values){
				$i++; $msg_flag = FALSE;
	
				$this->excel->getActiveSheet()
				->setCellValue('A'.$i, $i-4)
				->setCellValue('B'.$i, $values->employee_id)
				->setCellValue('C'.$i, $values->first_name. ' ' . $values->middle_name. ' ' . $values->surname)
				->setCellValue('D'.$i, $values->attendance_log_id)
				->setCellValue('E'.$i, util::displayFormat($values->joining_date))
				->setCellValue('F'.$i, util::displayFormat($values->date_of_birth))
				->setCellValue('G'.$i, $values->passport_id)
				->setCellValue('H'.$i, util::displayFormat($values->passport_expiry))
				->setCellValue('I'.$i, $values->iqama_id)
				->setCellValue('J'.$i, util::displayFormat($values->iqama_expiry))
				->setCellValue('K'.$i, $values->local_address)
				->setCellValue('L'.$i, $values->land_line)
				->setCellValue('M'.$i, $values->mobile_no)
				->setCellValue('N'.$i, $values->email_id)
				->setCellValue('O'.$i, $values->contact_person_name)
				->setCellValue('P'.$i, $values->contact_person_mobile)
				->setCellValue('Q'.$i, $values->check_list);
			}
		}
		/*---------------------------------------------------------------------------------
		 * Creating 2nd Worksheet for academic info 
		 */
		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex(1);
		//name the worksheet 2
		$this->excel->getActiveSheet()->setTitle('Academic Info');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Academic Detail');
		
		$this->excel->getActiveSheet()
		->setCellValue('A1', 'Emp #')
		->setCellValue('B1', 'Emp Name')
		->setCellValue('C1', 'Degree')
		->setCellValue('D1', 'Year Of Passing')
		->setCellValue('E1', 'Grade')
		->setCellValue('F1', 'Institute Name')
		->setCellValue('G1', 'Country');
		/*---------------------------------------------------------------------------------*/
		$this->excel->setActiveSheetIndex(0);
		
		$filename='employee_'.date('Ymd').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
	
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}
	
	function update_data(){
		//$this->Employee_model->update_employee_data();
	}
}