<?php
class Base_Controller extends CI_Controller {
	
	protected $paging = FALSE;
	function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Riyadh');
        $user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
        if ( !isset($user_id) ){
        	redirect('login', 'refresh');
        }
        $this->data['userrole'] = $role_id = $this->session->userdata(SESSION_CONST_PRE.'role_id');
        $this->data['model'] = $controller_name = $this->uri->segment(1);
        $is_default = $this->uri->segment(2);
        $unauthenticateScreen = array('login', 'logout', 'viewer', 'screen', 'popup', 'global_search', 'coming_soon', 'dashboard', 'user_profile');
        if(!empty($controller_name) && !in_array($controller_name, $unauthenticateScreen) && Base_model::authenticateScreen($controller_name,$role_id)){
        	//redirect('login', 'refresh');
        }
        $actions = '';
        $this->data['action_menu'] = TRUE;
        if(empty($is_default) || $is_default == 'display'){
	        $authorized_action = Base_model::getAuthorizedActions($user_id, $controller_name);
			foreach($authorized_action as $record){
				$actions[strtolower($record->name)] = 1;
			}
        }
        else{
        	/*action menu only show on default screen if want to show just set it TRUE in the Controller function as below*/
        	$this->data['action_menu'] = FALSE;
        }
    	$this->data['session_start'] = $this->session->userdata(SESSION_CONST_PRE.'session_start');
       	$this->data['admin_role'] = $this->session->userdata(SESSION_CONST_PRE.'admin_role');
      	 Base_Model::recordUserActionLog($user_id, $controller_name, $is_default);
      	
        $this->data['action_btn'] = $actions;
        $this->data['class_left']="left";
		$this->data['class_right'] = "right";
		$this->data['it_manager'] = Base_Model::get_itmanger();
		
		if(isset($_COOKIE[SESSION_CONST_PRE.'lang'])){
        	$this->data['lang'] = $_COOKIE[SESSION_CONST_PRE.'lang'];
	        if( $_COOKIE[SESSION_CONST_PRE.'lang'] == 'ar'){
	        	$this->session->set_userdata(SESSION_CONST_PRE.'lang','ar');
				$this->data['class_left']="right";
				$this->data['class_right'] = "left";
	        }
        }
        else{
        	$this->data['lang'] = $this->session->userdata(SESSION_CONST_PRE.'lang');
	        if( $this->session->userdata(SESSION_CONST_PRE.'lang') == 'ar'){
				$this->data['class_left']="right";
				$this->data['class_right'] = "left";
	        }
        }
        //$this->data['lang'] = 'en';
        //echo $this->data['lang'];
        
        //$this->data['branch_list'] = Base_Model::get_all_branches();
        //$this->data['batch_list'] = Base_Model::get_all_batches();
        
        $this->data['action'] = $this->uri->segment(1);
        $this->data['tab_bar'] = "";
        $this->data['error_message'] = "";
		$this->data['success_message'] = "";
		$this->data['menu_show'] = "1";
		$res = Base_Model::getLables();
		if(isset($res)){
			foreach ($res as $row){
				$this->data['lang_en'][$row->localize_id] = $row->lang_en;
				$this->data['lang_ar'][$row->localize_id] = $row->lang_ar;
			}
		}
		
		$this->data['div_list']  = array('1'=>'DNS', '2'=>'DIS',);
		$this->data['toggle'] = (isset($_POST['toggle'])) ? $_POST['toggle'] : $this->session->userdata(SESSION_CONST_PRE.'toggle');
		$this->data['menuList'] = Screen_model::get_menu_list($role_id); // For Left Menu
	}
	
	function add(){}
	function edit(){}
	function delete(){
		$controller_name = $this->uri->segment(1);
		redirect($controller_name,'location');
	}
	
	function getEducationPlusFee($params){
		if($params > 3 && $params <=9) { // DNS and for class grade-1 to 6
			return '6800.00'; // 3400 for each term
		}
		return  '0.00';
	}
	
	protected function load_template($content_view, $t=null){
		
		$tmpl = ($t==null) ? TEMPLATE_CONST : $t;
		
		$lang = $this->session->userdata(SESSION_CONST_PRE.'lang');
		if($lang == 'ar'){
			$this->template->set_master_template('template'.$tmpl.'-rtl');
		}
		else{
			$this->template->set_master_template('template'.$tmpl);
		}
	
		$this->template->write('title', $this->session->userdata(SESSION_CONST_PRE.'app_title'));
		// Write to Header
		$this->template->write_view('header', 'common/layout'.$tmpl.'/header', $this->data);
		
		// Write to Left Menu
		$this->template->write_view('sidebar', 'common/layout'.$tmpl.'/sidebar', $this->data);
		
		$this->template->write_view('content', $content_view, $this->data);
		  
		$this->template->write_view('footer', 'common/layout'.$tmpl.'/footer');
		$this->template->write_view('page_script', 'common/layout'.$tmpl.'/page_script_end');
		// Render the template
		$this->template->render();
		
	}
	
	protected function load_printhtml_tmpl($content_view, $temp=null){
		
		$tmpl = ($temp==null) ? TEMPLATE_CONST : $temp;
		
		$this->template->set_master_template('template'.$tmpl.'-print');
		
		$this->template->write('title', $this->session->userdata(SESSION_CONST_PRE.'app_title'));
		// Write to Header
		$this->template->write_view('header', 'common/print_header', $this->data);
		
		$this->template->write_view('content', $content_view, $this->data);
		  
		$this->template->write_view('footer', 'common/print_footer');  
		// Render the template
		$this->template->render();
		
	}
	
	public function branches(){
		$params = $this->uri->segment(3);
		$this->data['branch_list'] =Base_model::get_all_branches($params);
		
		$this->load->view('common/dropdown/branch',$this->data);
	}
	public function divisions(){
		$params = $this->uri->segment(3);
		$this->data['division_list'] =Base_model::get_all_divisions($params);
		
		$this->load->view('common/dropdown/division',$this->data);
	}
	public function departments(){
		$params = $this->uri->segment(3);
		$this->data['department_list'] =Base_model::get_department_by_division($params);
		
		$this->load->view('common/dropdown/department',$this->data);
	}
	
	public function getDepartmentAttributes(){
		$params = $this->uri->segment(3);
		$this->data['search_fields'] =Base_model::get_department_attribute($params);
		
		$this->load->view('settings/departments/department_attributes',$this->data);
	}
	 
	public function getSearchAttributes(){
		$params = $this->uri->segment(3);
		$this->data['search_fields'] =Base_model::get_department_attribute($params);
		
		$this->load->view('settings/departments/search_attributes',$this->data);
	}
	public function locations(){
		
		$this->data['location_list'] =Base_model::get_all_location();
		
		//$this->load->view('common/dropdown/location',$this->data);
	}
	
	public function addnote(){		
		$this->load->view('popup/addnote',$this->data);
	}
	public function savenote(){
		$this->data['emp_num'] = $_POST['emp_num'];
		Base_Model::setOwnerId($_POST['emp_num']);
		unset($_POST['emp_num']);
		$flag = Base_model::insertNote();
		$this->data['formId'] = $_POST['form_id'];
		$this->data['formType'] = $_POST['form_type'];
		
		if($flag){
			$this->data['request_notes'] = Base_model::getRequestNotes($this->data['formId'],$this->data['formType']);
			if($_POST['form_type'] == 'Announce')
			{
				$this->load->view('common/anouncement_block',$this->data);
			}
			else {
				$this->load->view('common/note_block',$this->data);
			}
		}
	}
	
	function getTechnicians($list){
	    $records = Base_model::getAllTechnician(FALSE, $list);
	    $user_str = '';
	    foreach ($records as $value) {
	    	$user_str .= ',<br/>'.$value->name;
	    }
	    $user_str = substr($user_str, 6);
	    return $user_str;
	}
	
	function getSupervisors($list){
	    $records = Base_model::getAllUsers($list, '6');
	    $user_str = '';
	    foreach ($records as $value) {
	    	$user_str .= ',<br/>'.$value->name;
	    }
	    $user_str = substr($user_str, 6);
	    return $user_str;
	}
	
	
	
	public function getSubcategory(){
		$params = $this->uri->segment(3);
		$this->data['count'] = $_POST['count'];
		$this->data['subcategory_list'] = Base_model::getSubcategoryList($params);
		
		$this->load->view('common/dropdown/subcategory',$this->data);
	}
	
	public function insert_upload_file_log($file_data, $formLogId, $comments = null){
		Base_model::upload_file_log($file_data, $formLogId, $comments);
	}
	
	public function change_batch(){
		if(isset($_REQUEST['batch_no'])){
			$b = $_REQUEST['batch_no'];
			$this->session->set_userdata(SESSION_CONST_PRE.'batch', $b);
			//redirect('vouchers', 'refresh');
		}
	}
	
	public function batches(){
		$params = $this->uri->segment(3);
		$this->data['batch_list'] =Base_model::get_all_batches($params);
	
		$this->load->view('common/dropdown/batch',$this->data);
	}
	
	public function timetable(){ // need to edit this area
		$params = $this->uri->segment(3); // against the selected course
		$this->data['batch_list'] =Base_model::get_all_batches($params);
	
		$this->load->view('common/dropdown/batch',$this->data);
	}
	
	public function weekdays(){
		$params = $this->uri->segment(3); // against this batch
		$this->data['weekday_list'] =Base_model::get_weekdays($params);
	
		$this->load->view('common/weekdays_list',$this->data);
	}
	
	public function job_departments(){
		$params = $this->uri->segment(3);
		$this->data['department_list'] =Base_model::get_jobs_departments($params);
	
		$this->load->view('common/dropdown/job_department',$this->data);
	}
	
	public function job_subcategories(){
		$params = $this->uri->segment(3);
		$this->data['subcategories_list'] =Base_model::get_jobs_subcategories($params);
	
		$this->load->view('common/dropdown/job_subcategories',$this->data);
	}
	
	public function htmlprint(){
		
	}
	
	function set_division($division_id){
		$this->session->set_userdata(SESSION_CONST_PRE.'division_id', $division_id);
		$division_name = Base_Model::get_division($division_id);
		$this->session->set_userdata(SESSION_CONST_PRE.'app_title', $division_name);
	}
	
	function ToggleLang($label, $lang=null){
			$label = trim($label);
			$label_new = str_replace(' ', '_', strtolower($label));
			//print_r ($this->data['lang_ar']);
			$a = $this->data['lang_en'];
			if(isset($_COOKIE[SESSION_CONST_PRE.'lang'])){
				if($_COOKIE[SESSION_CONST_PRE.'lang'] == 'ar'){
					$a = $this->data['lang_ar'];
				}
			}
			if($lang != null){
				$a = $this->data['lang_'.$lang];
			}
			if(isset($a[$label_new])){
				$label = $a[$label_new];
			}
			else{
				Base_Model::insert_lables($label_new, $label);
			}
			
			return $label;
	}
	
	function send_message($mobile, $message, $sender = 'FastAcademy'){
		
		$url = "http://bulksms.com.pk/api/sms.php?username=".SMS_API_USERNAME."&password=".SMS_API_PASSWORD."&sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message);

		//Curl start 
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
		$res = explode(' ', $response);
		return $res;
	}
}
