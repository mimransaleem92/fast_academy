<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends Base_Controller{

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Branchs_model', '', TRUE);
	}
	
	function index(){
		
		$this->branchs_list();
	}
	
	function send_message(){
		if(isset($_POST['course_id'])){
			$course_id = $_POST['course_id'];
			$section = $_POST['section'];
			$sender = "FAST Notification" ;
			
			if($_POST['course_id'] == -1 && isset($_POST['cell_number']) && strlen($_POST['cell_number']) == 12 ){
				
				$mobile = $_POST['cell_number'];
				$message = $_POST['message_text'];
				
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
				
				///Write out the response
				$sms_flag = explode(':', $response);
				echo $sms_flag[0]. '<br/>';
			}else if( $_POST['course_id'] == 0 ){
				
				$student_arr = Base_model::get_student_by_class_section($course_id, $section);
				$student_list = ''; $count = 0;
				foreach ($student_arr as $res)
				{
					
					if( isset($res->cell_phone_father)  && strlen($res->cell_phone_father) == 12 ){
						$count++;
						$cell = $res->cell_phone_father;
						$message = $_POST['message_text'];
						$student_list .= ','.$cell;
						$url = "http://bulksms.com.pk/api/sms.php?username=".$username."&password=".$password."&sender=".urlencode($sender)."&mobile=".urlencode($cell)."&message=".urlencode($message);

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
						
						///Write out the response
						$sms_flag = explode(':', $response);
						echo $sms_flag[0]. '<br/>';
					}
				}
				//echo $student_list;
				$mobile = substr($student_list, 1, strlen($student_list));
				$message = $_POST['message_text'];
				Base_model::insert_message_log($course_id, $mobile, $message, $count);
			}
			else if( $_POST['course_id'] > 0 ){
				$student_arr = Base_model::get_student_by_class_section($course_id, $section);
				$student_list = ''; $count = 0;
				foreach ($student_arr as $res)
				{
					
					if( isset($res->cell_phone_father)  && strlen($res->cell_phone_father) == 12 ){
						$count++;
						$cell = $res->cell_phone_father;
						$message = $_POST['message_text'];
						$student_list .= ','.$cell;
					}
				}
				$mobile = substr($student_list, 1, strlen($student_list));
				$message = $_POST['message_text'];
				
				$url = "http://bulksms.com.pk/api/sms.php?username=".$username."&password=".$password."&sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message);

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
				
				///Write out the response
				$sms_flag = explode(':', $response);
				echo $sms_flag[0]. '<br/>';
				Base_model::insert_message_log($course_id, $mobile, $message, $count);
			}
		}
		else{
			redirect('logout','location');			
		}
	}
	
	function branchs_list(){
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->data['company_list'] = null; //Base_model::getCompanyList();
		$this->data['branchs_list'] = $this->Branchs_model->get_all_branchs();
		$this->load_template('settings/messages/default');
	}
	
	function save_item(){
		if($this->Branchs_model->process_already_run()){
			$this->Branchs_model->insert();	
		}
		$this->data['branchs_list'] = $this->Branchs_model->get_all_branchs();
		$this->load->view('settings/branchs/list', $this->data);	
	}
	
	function add(){
		$this->branchs_list();
	}
	function edit(){
		$this->branchs_list();
	}
}