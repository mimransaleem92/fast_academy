<?php
class Base_Model extends CI_Model {
	
	var $ref = NULL;
	var $formType = NULL;
	var $subType = NULL;
	var $formUrl;
	var $status;
	var $batch_number = '';
	
	var $subject = NULL;
	var $priority = NULL;
	var $urgency = NULL;
	var $owner_id = 0; 
	var $formReadOnlyUrl = NULL;
	var $cur_position;
	var $level = -1;
	var $h;
	var $record_per_page = 10;
	
	function __construct()
    {
        parent::__construct();
        $this->set_timezone();
    }
	
    function setOwnerId($val){
    	$this->owner_id = $val;
    }
    
    function setFormType($value){
    	$this->formType = $value;
    }
    
    function getFormType(){
    	return $this->formType;
    }
    function insert(){}
	
    function update(){}
	
    function delete(){}
	
    public function recordUserActionLog($user_id, $controller_name, $is_default){
    	$query = "INSERT INTO useractionlogs (user_id, action_desc, client_ip, path, action_loc) VALUES ('$user_id', '$controller_name', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REQUEST_URI']."','$is_default')";
    	$this->db->query($query);
    }
    
	public function set_timezone(){
       $this->db->query("SET time_zone='+3:00'");
           //$this->db->query("INSERT into userrole(user_id,role_id) values (SELECT EMP_NUM, 3 from emp_basic_info )");
    }
    
	function insert_message_log($course_id, $mobile, $message, $student_count, $status = ''){
	    $main_arr = array('course_id'=>$course_id, 'mobile_list'=> $mobile, 'message_text'=>$message, 'student_count'=>$student_count, 'status'=>$status);
		$this->db->insert('sent_messages_log', $main_arr);
    	$id = $this->db->insert_id();
	}
	
	function getCurrentConference(){
		
	}
	
	function get_today_conference(){
		
	}
	
	function get_all_branches(){
		$query = $this->db->get('branchs');
		$result = $query->result();
		return $result;	
	}

	function get_all_conference(){
	
	}
	
	function getUsersByRole($role_id, $department)
	{
		$query = "SELECT users.user_id, users.name from users join userrole on users.user_id = userrole.user_id and role_id = $role_id where users.department_id = '".$department."' and users.branch_id = ".$this->session->userdata(SESSION_CONST_PRE.'branch_id');
		
		$query = $this->db->query($query);
		$result = $query->result();
		return $result;	
	}
		
	function getPlacesList(){
		$query = "select * from places order by name";		
		$query = $this->db->query($query);
		return $query->result();
	}

	function get_department_attribute($id){
		$query = "select search_fields from departments where department_id=$id";
		$query = $this->db->query($query);
		$rs = $query->result();
		$sf = '';
		if(isset($rs[0])){
			$sf = $rs[0]->search_fields;
		}
		return $sf;
	}
	
	function get_document_list($doc_type){
		$this->db->select('d.*, departments.name as department_name, users.name as uploaded_by');
		$this->db->from('documents d');
		$this->db->join('departments','departments.department_id = d.department_id', 'LEFT');
		$this->db->join('users','users.user_id = d.user_id', 'LEFT');
		$this->db->where('document_type', $doc_type);
		$this->db->order_by('created_date', 'desc')->limit(10);
		//$query = "select * from documents where document_type='$doc_type' order by created_date desc limit 10";
		$query = $this->db->get();
		$rs = $query->result();
		
		return $rs;
	}
	
	function getAllUsers($assign_list, $role)
	{
		if(empty($assign_list)){
			$assign_list = '0';
		}	
		$where_clause = " and users.user_id in ($assign_list)";
		
		
		$query = "SELECT users.user_id, users.name from users join userrole on users.user_id = userrole.user_id and role_id = $role $where_clause";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function getTechnicianIT()
	{
		$query = "SELECT users.user_id, users.name from users join userrole on users.user_id = userrole.user_id and role_id = 5 and users.department_id = '110'";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $screen
	 * @param unknown_type $role
	 */
	
	function authenticateScreen($screen, $role){
		$q 	= "	select screens.screen_id from screens 
				join rolescreen on screens.screen_id = rolescreen.screen_id 
				where screens.url = ? 
				and rolescreen.role_id =  ?";
		$query = $this->db->query($q,array($screen, $role));
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	function getAuthorizedActions($user_id, $screen){
		$q = " select sa.action_id, a.name from screen_actions sa join screens s on  sa.screen_id = s.screen_id
				join actions a on  a.action_id = sa.action_id
				where sa.user_id = ? and s.url=?";
		$query = $this->db->query($q,array($user_id, $screen));
		return $query->result();
	}

	function getLables(){
		$query = $this->db->get('localize');
		return $query->result();
	}
		
	function get_country_list(){
		$this->db->order_by('country_name');
		$query = $this->db->get('country');
		
		return $query->result();
	}
	
	function get_all_users($list = NULL, $not_in=FALSE){
		if(!is_null($list)){
			$list = explode(',', $list);
			if ($not_in){
				$this->db->where_not_in('user_id', $list);
			}
			else
			{
				$this->db->where_in('user_id', $list);	
			}
		}
		$query = $this->db->get('users');
		return $query->result();
	}
	
	function get_all_salemen(){
		$this->db->where('default_role =','10');
		$query = $this->db->get('users');
		return $query->result();
	}
	
	function get_all_units(){
		$query = $this->db->get('units');
		return $query->result();
	}
	
	public function get_customers($name=''){
	
		$this->db->where("type =", 'c');
		if($name != '')
		$this->db->like('name', $name);
		$query = $this->db->get('suppliers');
	
		return $query->result();
	}
	
	function get_all_location(){
		$query = $this->db->get('locations');
		return $query->result();
	}

	function get_notified_users($notified = TRUE){
		if($notified)
		$this->db->where('contract_expiry_notification', '1');
		else
		$this->db->where('contract_expiry_notification', '0');
		$query = $this->db->get('users');
		return $query->result();
	}
	
	function get_supervisor_users(){
		$query = $this->db->query("SELECT users.user_id, users.name from users join userrole on users.user_id = userrole.user_id and role_id = 6");
		//$query = $this->db->get('users');
		return $query->result();
	}
	
	function get_userrole($id){
		$query = $this->db->get_where('userrole',array("user_id" => $id));
		return $query->row();
	}
	
	public function get_employees(){
		$query = $this->db->query("select * from employees order by iqama_expiry asc limit 0,10");
		return $query->result();
	}
	
	function get_all_departments($row = 0, $paging = FALSE){
		if($paging){
			$query = $this->db->get('departments',10,$row);
		}
		else
		{
			$query = $this->db->get('departments');
		}
		return $query->result();
	}
	
	function get_all_division(){
		$query = $this->db->get('divisions');
		
		return $query->result();
	}
	
	/***
	 * HR / School System function Definations From here
	*/
	
	function get_all_employees($terms = null ){
		if(!is_null($terms)){
			$sql = "SELECT *
			FROM employees
			WHERE employee_name LIKE '$terms%' ";
			if(is_numeric($terms)){
			$sql = "SELECT *
			FROM employees
				WHERE employee_id = '$terms' ";
			}
			$query = $this->db->query($sql);
			}
			else
			{
			$query = $this->db->get('employees');
		}
		return $query->result();
		
	}
	
	function get_employee_basic_info($id){
		$this->db->select('e.*, d.company_id, d.branch_id, d.division_id, d.name,d.arabic_name, designations.desig_desc');
		$this->db->from('employees e');
		$this->db->join('departments d', 'd.department_id = e.department_id', 'LEFT');
		$this->db->join('designations', 'designations.designation_id = e.designation', 'LEFT');
		if(strlen($id)<15)
			$this->db->where(array("e.employee_id" => $id));
		else
			$this->db->where(array("e.employee_code" => $id));
		$query = $this->db->get();//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_basic_salary($id){
		$this->db->where(array("employee_id" => $id));
		$this->db->where("date_format(create_date,'%Y-%m') = date_format(DATE_SUB(CURDATE(), INTERVAL 1 MONTH),'%Y-%m')");
		$query = $this->db->get('payroll_logs');
		return $query->result();
	}
	
	function get_vacation_by_employee($id){
		$this->db->where(array("employee_id" => $id));
		$this -> db -> order_by('vacation_id', 'desc');
		$query = $this->db->get('vacation');
	
		return $query->row();
	}
	
	function get_vacation_log($employee){
		 
		$this->db->where("employee_id", $employee);
		$this->db->order_by("vacation_id");
		$query = $this->db->get('vacation');
		$result = $query->result();
	
		return $result;
	}
	
	/***
	 * School System function Definations From here
	 */
	function get_students_count(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$pattren = ($div_id == '1') ? 'DNS' : 'DIS';
		//$query  = $this->db->query("select count(admission_number) as id from students where admission_number like '".$pattren."%'");
		$query  = $this->db->query("select count(admission_number) as id from students");
		$result = $query->result();
		$max_num = $result[0]->id;
	
		return $max_num;
	}
	
	function get_students_by_batch($id){
		$this->db->where('batch_id', $id);
		$this->db->order_by('student_name');
		$query = $this->db->get('students');
	
		return $query->result();
	}
	
	function get_student_info($id){
		$this->db->where('student_id', $id);
		$query = $this->db->get('students');
	
		return $query->result();
	}
	
	function get_student_by_class_section($class, $section, $type=0){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$this->db->select('s.*, c.course_name, c.course_name_ar, b.batch_name, b.batch_name_hijri');
		$this->db->from('students s');
		$this->db->join('courses c','s.course_id = c.course_id', 'LEFT');
		$this->db->join('batches b','s.batch_id = b.batch_id', 'LEFT');
		$this->db->where(array('s.course_id'=>$class, 's.section'=>$section, 's.division_id'=>$div_id, 'study_continue'=>'Y'));
		$this->db->where('s.cdel', $type);
		$this->db->order_by('s.student_name');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_student_batch_course($id){
		$this->db->select('s.*, b.batch_name, c.course_name');
		$this->db->from('students s');
		$this->db->join('courses c','s.course_id = c.course_id', 'LEFT');
		$this->db->join('batches b','s.batch_id = b.batch_id', 'LEFT');
		$this->db->where('s.student_id', $id);
		$this->db->where('s.cdel', '0');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	function get_student_assesments($id){
		$this->db->select('ess.*, e.exam_name, ed.max_marks, ed.min_marks, s.subject_name');
		$this->db->from('exam_score_subject ess');
		$this->db->join('exams e','ess.exam_id = e.id');
		$this->db->join('exam_details ed','ed.id = ess.exam_detail_id');
		$this->db->join('subjects s','ed.subject_id = s.subject_id');
		$this->db->where('ess.student_id', $id);
		$this->db->order_by('e.exam_name');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_grading_levels_by_batch($id){
		$this->db->where('batch_id', $id);
		$this->db->order_by('min_scores', 'asc');
		$query = $this->db->get('batch_grading_level');
		return $query->result();
	}
	
	function get_collection_info($id){
		$this->db->where('id', $id);
		$query = $this->db->get('fee_collection');
	
		return $query->result();
	}
	
	function get_batch_name($b){
		$sql = "SELECT batch_name FROM batches WHERE batch_id=$b";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->batch_name;
	}
	
	function get_all_batches($course_id=NULL){
		if(isset($course_id) && !is_null($course_id)){
			$sql = "SELECT * FROM batches
			WHERE course_id = $course_id ";
			//$this->db->order_by('batch_name');
			$query = $this->db->query($sql);
		}
		else
		{
			$this->db->order_by('batch_name');
			$query = $this->db->get_where('batches', array('course_id'=>'1'));
		} //echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_weekdays($id){
		$sql = "SELECT * FROM batch_weekdays
		WHERE batch_id = $id ";
	
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_courses(){
		$this->db->order_by('course_id');
		$query = $this->db->get_where('courses', array('is_active'=>'Y'));
	
		return $query->result();
	}
	
	function get_fee_categories(){
		$this->db->select('fc.id, b.batch_name, fc.category_name');
		$this->db->from('fee_category fc');
		$this->db->join('batches b','fc.batch_id = b.batch_id');
		$this->db->order_by('b.batch_name,  fc.category_name');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	function get_header_info($course_id, $subject_id){
		$this->db->where(array("course_id" => $course_id, 'subject_id'=>$subject_id));
		$query = $this->db->get('course_subject');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_subjects_by_course($id){
		$this->db->select('cs.*, s.subject_name, s.subject_code, s.subject_name_arabic, cs.period_per_week, cs.credit_hours');
		$this->db->from('course_subject cs');
		$this->db->join('subjects s','cs.subject_id = s.subject_id');
		$this->db->where('cs.course_id', $id);
		$this->db->order_by('s.subject_id');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	function get_employee_by_subject($id){
		$this->db->select('se.*, e.employee_name');
		$this->db->from('subject_employee se');
		$this->db->join('employees e','se.employee_id = e.employee_id');
		$this->db->where('se.subject_id', $id);
		$this->db->order_by('e.employee_name');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_all_subjects($row = 0, $paging = FALSE){
		$this->db->where('is_active', 'Y');
		$this->db->order_by('subject_id', 'asc');
		if($paging){
			$query = $this->db->get('subjects',10,$row);
		}
		else
		{
			$query = $this->db->get('subjects');
		}//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_subject_name($id){
		$this->db->where('is_active', 'Y');
		$this->db->where('subject_id', $id);
		$query = $this->db->get('subjects');
		$row = $query->row();
		return $row;
	}
	
	function get_course_name($id){
		
		$this->db->where('course_id', $id);
		$query = $this->db->get('courses');
		$row = $query->row();
		$lang = $this->session->userdata(SESSION_CONST_PRE.'lang');
		$course_name = ($lang != 'en') ? $row->course_name_ar : $row->course_name;
		return $course_name;
	}
	
	public function get_adminition_no(){
		//$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		//$pattren = ($div_id == '1') ? 'DNS' : 'DIS';
		
		/* $pattren = ($pre == 'F') ? 'VIG' : 'VIB';
		$pattren = $pattren . '-' . date('y');
		$query  = $this->db->query("select count(admission_number) as id from students"); // where admission_number like '".$pattren."%'
		$result = $query->result();
		$max_num = $result[0]->id;
		
		return $pattren."-". Util::leading_zeros ($max_num+1, 4); */
		
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$pattren = ($div_id == '1') ? 'FB' : 'FG';
		$pattren = $pattren . '-' . date('y');
		$query  = $this->db->query("select count(admission_number) as id from students where admission_number like '".$pattren."%'");
		$result = $query->result();
		$max_num = $result[0]->id;
		
		return $pattren."-". Util::leading_zeros ($max_num+1, 4);
	}
	
	public function get_guardians($student_id){
		$query = $this->db->get_where('student_guardian',array("student_id" => $student_id, 'default'=>'1'));
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	public function get_previous_data($id, $is_student = true){
		if($is_student){
			$query = $this->db->get_where('student_previous_data',array("student_id" => $id));
		}
		else{
			$query = $this->db->get_where('student_previous_data',array("id" => $id));
		}
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_date_pre($dt){
		$sql = "select DATE_SUB('$dt', INTERVAL 1 MONTH) as dt";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->dt;
	}
	
	function get_date_next($dt){
		$sql = "select DATE_ADD('$dt', INTERVAL 1 MONTH) as dt";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->dt;
	}
	 
	function get_month_name($dt){
		$sql = "select MONTHNAME('$dt') as month_name";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->month_name;
	}
	
	function get_term_list(){
		$query = $this->db->get('exam_divisions');
		return $query->result();
	}
	
	/***
	 * School System function Definations End @ 29-04-2014
	*/
	
	/***
	 * Function define for Meeting Management Block
	 */
	
	function get_meeting_rooms(){
		//$this->db->where(array("is_active" => 'Y'));
		$query = $this->db->get('meeting_rooms');
		$result = $query->result();
		return $result;
	}
	
	/***
	 * End Meeting Management Block
	 */
	
	/***
	 * Function define for Easy Business Management Block
	*/
	function set_status_level($id, $level, $status){
		$sql = "Update rfq SET level = concat('$level',level), status='$status' where rfq_id = $id ";
		$query = $this->db->query($sql);
	}
	
	/***
	 * End Easy Business Management Block
	*/
	
	/***
	 * HR and Payroll Block
	*/ 
	
	function get_select($table, $field = 'name'){				
		$this->db->order_by($field);
		$query = $this->db->get($table);
        return $query->result();
	}

	function get_all_branchs($b = null){
		if(!is_null($b)){
			$sql = "SELECT * FROM branchs
                    WHERE name LIKE ? ";
			$this->db->order_by('name');
        	$query = $this->db->query($sql, array("$b%"));
		}
		else 
		{
			$this->db->order_by('name');
			$query = $this->db->get('branchs');
		}
        return $query->result();
	}
	
	function get_all_designations($desig = null){
		if(!is_null($desig)){
			$sql = "SELECT * FROM designations
                    WHERE desig_desc LIKE ? ";
			$this->db->order_by('desig_desc');
        	$query = $this->db->query($sql, array("$desig%"));
		}
		else 
		{
			$this->db->where('designation_id <', 100);
			$this->db->order_by('desig_desc');
			$query = $this->db->get('designations');
		}
        return $query->result();
	}

	function get_all_divisions($company_id){
		if(isset($company_id)){
			$sql = "SELECT * FROM divisions
                    WHERE company_id = $company_id ";
			$this->db->order_by('name');
        	$query = $this->db->query($sql);
		}
		else 
		{
			$this->db->order_by('name');
			$query = $this->db->get('divisions');
		}
		return $query->result();
	}
	
	function get_departments($name = null,$id=null){
		if(!is_null($name)){
			$this->db->where("name like  '$name%' ");
		}
		elseif(!is_null($name)){
			$this->db->where("department_id", $id);
		}
		$query = $this->db->get('departments');
		return $query->result();
	}
	
	function get_department_by_division($division_id){
		$this->db->where("division_id =", $division_id);
		$query = $this->db->get('departments');
		return $query->result();
	}
	
	function get_all_grades(){
		$this->db->order_by('grade_name');
		$query = $this->db->get('grades');
		$result = $query->result();
		return $result;
	}
	
	function get_grade_info($name = 5){
		$this->db->where('grade_name', $name);
		$query = $this->db->get('grades');
		$result = $query->result();
		return $result[0];
	}
	
	public function get_employee_designation(){
		$query = $this->db->query("select distinct designation from employees order by designation asc");
		return $query->result();
	}
	
	/***
	 * End HR and Payroll Block
	*/
	
	/***
	 * CV DATABASE Jobs portal
	 * 
	 * BY Imran Saleem
	 * 26-10-2014 4:23 pm
	 */
	
	function get_jobs_ages(){
		$this->db->where(array("status" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_ages');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_careerlevels(){
		$this->db->where(array("status" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_careerlevels');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_shifts(){
		$this->db->where(array("isactive" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_shifts');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_categories(){
		$this->db->where(array("isactive" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_categories');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_subcategories($categoryid){
		$this->db->where(array("status" => '1', "categoryid"=>$categoryid));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_subcategories');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_jobtypes(){
		$this->db->where(array("isactive" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_jobtypes');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_jobstatus(){
		$this->db->where(array("isactive" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_jobstatus');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_jobcities(){
		$this->db->where(array("enabled" => '1'));
		$this->db->order_by('name');
		$query = $this->db->get('job_cities');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_companies(){
		$this->db->where(array("status" => '1'));
		$this->db->order_by('name');
		$query = $this->db->get('job_companies');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_departments($companyid){
		$this->db->where(array("status" => '1', "companyid"=>$companyid));
		$this->db->order_by('name');
		$query = $this->db->get('job_departments');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_cities(){
		$this->db->where(array("enabled" => '1'));
		$this->db->order_by('name');
		$query = $this->db->get('job_cities');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_currencies(){
		$this->db->where(array("status" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_currencies');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_salaryrange(){
		$this->db->where(array("status" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_salaryrange');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_jobs_salaryrangetypes(){
		$this->db->where(array("status" => '1'));
		$this->db->order_by('ordering');
		$query = $this->db->get('job_salaryrangetypes');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_recent_jobs(){
		$this->db->select('jobs.job_title, jobs.start_publishing, job_companies.name as company_name, job_departments.name as department_name, job_categories.cat_title as category_name, job_subcategories.title as subcategory_name, job_jobtypes.title as job_type');
		$this->db->from('jobs');
		$this->db->join('job_companies', 'job_companies.id = jobs.companyid');
		$this->db->join('job_departments', 'job_departments.id = jobs.departmentid', 'LEFT');
		$this->db->join('job_categories', 'job_categories.id = jobs.categoryid', 'LEFT');
		$this->db->join('job_subcategories', 'job_subcategories.id = jobs.subcategoryid', 'LEFT');
		$this->db->join('job_jobtypes', 'job_jobtypes.id = jobs.job_type', 'LEFT');
		$this->db->where("jobs.start_publishing between DATE_SUB(NOW(), INTERVAL 7 DAY) and NOW()" );
		
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_applied_jobs($resume_id){
		$this->db->select('jobs.job_title, jobs.start_publishing, job_companies.name as company_name, job_jobtypes.title as job_type, jobs_resumes.applied_date');
		$this->db->from('jobs');
		$this->db->join('job_companies', 'job_companies.id = jobs.companyid');
		$this->db->join('job_jobtypes', 'job_jobtypes.id = jobs.job_type', 'LEFT');
		$this->db->join('jobs_resumes', 'jobs_resumes.job_id = jobs.jobs_id');
		$this->db->where(array("jobs_resumes.resume_id" => $resume_id));
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	/***
	 * End CV DATABASE Jobs portal
	 */
	
	/**
	 * Help Service Desk Block
	 * @param unknown $file_data
	 * @param string $formId
	 */
	function get_itmanger(){
		//$query = "SELECT EMP_NAME from emp_basic_info where emp_num='11252'";
		$where_clause  = " where users.department_id=110 ";
	
		$query = "SELECT users.user_id, users.name from users join userrole on users.user_id = userrole.user_id  $where_clause and role_id IN (10, 11) order by role_id desc";
		$query = $this->db->query($query);
		$result = $query->row();
		if(isset($result->name)){
			return $result->name;
		}
		else 
			return null;
	}
	
	function addWorkflowLog($formId, $formType,$subType,$emp_num,$status,$ownerId,$url, $comments=null)
	{
		if(!isset($formType)){
			$formType = $this->formType;
		}
	
		if(!isset($url)){
			$url = $this->formUrl."&formId=".$formId."&formType=".$formType."&subType=".$subType."&emp_num=".$ownerId;
		}
		$updated = NULL;
		if(!is_null($comments)){ $updated = 'NOW()';}
	
		$query = " insert into workflow_log (form_id, form_type, sub_type, emp_num, status, form_owner_id,form_url,comments,updated_date) values(".$formId.",'".$formType."','".$subType."',".$emp_num.",'".$status."',".$ownerId.",'".$url."', '".$comments."', '$updated')";
	
		$this->db->query($query);
	}
	
	function addFormLog($formId, $formType,$subType,$emp_num,$status,$formUrl,$to)
	{
		$readOnlyUrl = addslashes($this->formReadOnlyUrl."&formId=".$formId."&emp_num=".$emp_num);
		$company_id = $this->session->userdata (SESSION_CONST_PRE.'company_id');
		$branch_id  = $this->session->userdata (SESSION_CONST_PRE.'branch_id') ;
	
		$query = "insert into form_logs (form_id, form_type, sub_type, emp_num, status,form_url,assign_to_id,readonly_url, branch_id, company_id, subject, priority, urgency) values(".$formId.",'".$formType."','".$subType."',".$emp_num.",'".$status."','".$formUrl."','".$to."','".$readOnlyUrl."', '".$branch_id."', '".$company_id."', '".$this->subject."', '".$this->priority."', '".$this->urgency."')";
	
		$this->db->query($query);
		$id = $this->db->insert_id();
		$this->updateFormRefNumber($id);
		return $id;
	}
	
	function updateFormRefNumber($log_id)
	{
		$company_id = $this->session->userdata(SESSION_CONST_PRE.'company_id');
		$branch_id = $this->session->userdata(SESSION_CONST_PRE.'branch_id');
		$this->ref = Util::generateFormRefNumber($log_id,$this->formType, $company_id);
		
		$query = "update form_logs set ref_number = '".$this->ref."' where form_logs_id='".$log_id."'";
		$this->db->query($query);
	}
	
	function getVoucherReference($voucher_type, $div_id){
		
		$query  = $this->db->query("select count(voucher_id) as id from vouchers where division_id='".$div_id."' and voucher_type='$voucher_type' ");
		
		$result = $query->result();
		$max_num = $result[0]->id + 1;
		return $max_num;
		
	}
	
	function getNextAccountID($parent_id, $sub_id){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$query  = $this->db->query("select max(account_id) as id from accounts where parent_account_id='$parent_id' AND sub_account_id='$sub_id' ");
	
		$result = $query->result();
		$max_num = $result[0]->id;
		if($max_num == 0){
			return 10111;
		}
		else{
			return $max_num+1;
		}
	
	}
	
	function updateFormStatus($formId, $level, $status, $to, $close_after='', $reopen_within='')
	{
		$fields = "";
		if(!empty($close_after)){
			$fields = ", close_after='".$close_after."', last_action_at=NOW()";
		}
	
		if(!empty($reopen_within)){
			$fields = ", reopen_within='".$reopen_within."', last_action_at=NOW()";
		}
		$query = "update form_logs set status = '".$status."', level= ".$level." , assign_to_id= ".$to." $fields where form_id='".$formId."' and form_type='".$this->formType."'";
		$this->db->query($query);
	}
	
	function updateWorkFlowStatus($id, $comments, $status)
	{
		$query = "update workflow_log set status = '".$status."', comments = '".$comments."', updated_date=CURRENT_TIMESTAMP where workflow_log_id='".$id."'";
		$this->db->query($query);
	}
	
	function setPriorityUrgency($formId, $formType){
	
		$query = "Update form_logs SET priority = '".$this->priority."', urgency = '".$this->urgency."' where form_id='".$formId."' and form_type='".$formType."'";
		$query = $this->db->query($query);
	}
	function getFormLogDetail($formId,$formType)
	{
		$query = "select * from form_logs where form_id='".$formId."' and form_type='".$formType."'";
		$query = $this->db->query($query);
		$result = $query->result();
		return $result[0];
	}
	
	function getWorkflowLogId($formId,$formType)
	{
		$emp_num = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$query = "select workflow_log_id as id from workflow_log where form_id='".$formId."' and form_type='".$formType."' and emp_num='".$emp_num."' order by workflow_log_id desc";
		$query = $this->db->query($query);
		$result = $query->result();
		if (sizeof($result) > 0)
			return $result[0]->id;
	}
	
	function getFormLevel($formId)
	{
		$query = "select level from form_logs where form_id='".$formId."' and form_type='".$this->formType."'";
		$query = $this->db->query($query);
		$result = $query->result();
		return $result[0]->level;
	}
	
	function getFormRefNumber($formId)
	{
		$query = "select ref_number from form_logs where form_id='".$formId."' and form_type='".$this->formType."'";
		$query = $this->db->query($query);
		$result = $query->result();
		return $result[0]->ref_number;
	}
	
	function get_division($id){
		$this->db->where("division_id" , $id);
		$query = $this->db->get('divisions');
		$row = $query->row();
		return $row->name;
	}
	
	function getBasicInfo($emp_num)
	{
		$query = "SELECT COMP_CODE, COMP_NAME, substring(EMP_NUM,2) as EMP_NUM, EMP_NAME, DEP_CODE, DEP_NAME, GRADE_CODE, GRADE_LEVEL, BRANCH_CODE, BRANCH_NAME, DESIG_CODE, DESIG_DESC, EMAIL_ID, username, password, manager_id, admin_exe_id, admin_manager_id, account_id, branch_manager_id, director_id, cfo_id, md_id, cashier_id, leave_balance, ticket_entitlement, leave_year_from, leave_year_to, leave_year_ent_days, terms_annual_leave, date_last_annual_leave_from, date_last_annual_leave_to, date_last_annual_leave_days, bal_air_ticket, ere, gm_id, ticket_balance, ticket_route, term_of_annual_leave, term_of_annual_ticket, cost_center, emp_role, emp_salary, asoff_date, account_number from emp_basic_info where emp_num='".$emp_num."'";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function getUploadedFiles($formLogId){
		$where_clause = '';
		if(!is_null($this->formType)){
			$where_clause = " and form_type='".$this->formType."'";
		}
		$query = "select *, DATE_FORMAT(n.created_date,'%b %d, %Y %h:%i %p') as date from upload_file_log n join users u on n.uploaded_by = u.user_id where n.form_log_id='".$formLogId."'". $where_clause;
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function getRequestNotes($formId, $formType){
		$where = "";
		$curr  = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$owner = $this->owner_id;
		if($owner == $curr) $where = "and n.access = 'Public'";
		$query = "select *, DATE_FORMAT(n.created_date,'%b %d, %Y %h:%i %p') as date from form_notes n
		          join users u on n.user_id = u.user_id
		          where n.form_id='".$formId."'
		          and n.form_type='".$formType."' $where order by n.created_date desc";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function getWorkflowLogs($formId, $formType){
		$query = "select *,DATE_FORMAT(wf.created_date,'%b %d, %Y %h:%i %p') as cdate, DATE_FORMAT(wf.updated_date,'%b %d, %Y %h:%i %p') as date from workflow_log wf join users u on wf.emp_num = u.user_id where wf.form_id='".$formId."' and wf.form_type='".$formType."' order by workflow_log_id";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function getCategoryList($type = 'IT'){
		$query = "select * from category where service_template = '$type' order by category_id ";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function getSubcategoryList($type = 'IT'){
		if($type == 'IT'){
			$query = "select * from subcategory where category_id <= 1000";
		}
			elseif($type == 'TSD'){
					$query = "select * from subcategory where category_id > 1000 AND category_id <=2000"; // For TSD
					}
					elseif($type == 'Admin'){
						$query = "select * from subcategory where category_id > 2000 AND category_id <=3000"; // For Admin
		}
		elseif($type == 'Facilities'){
			$query = "select * from subcategory where category_id > 3000 AND category_id <=4000"; // For Facilities
		}
		elseif(is_numeric($type)){
			$query = "select * from subcategory where category_id =$type"; // For TSD
		}

		$query = $this->db->query($query);
			return $query->result();
	}
	
			
	function getAllTechnician($flag, $assign_list)
	{
		$branch_id = $this->session->userdata(SESSION_CONST_PRE.'branch_id');
		$where_clause = '';
		if(empty($assign_list)){
			$assign_list = '0';
		}
	
		if($flag){
		$where_clause = " and users.user_id not in ($assign_list)";
		}
		else
		{
			$where_clause = " and users.user_id in ($assign_list)";
		}
	
		$where_clause .= " and users.department_id in (111, 112)";
		$where_clause .= " and users.branch_id = ".$branch_id;
	
		$query = "SELECT users.user_id, users.name from users join userrole on users.user_id = userrole.user_id and role_id = 5  $where_clause";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	function getITDirectorID()
	{
		$query = "SELECT user_id, name from users where user_id = '365'";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function get_itmanager_empnum(){
		$branch_id = $this->session->userdata(SESSION_CONST_PRE.'branch_id');
		$where_clause  = " where emp_basic_info.DEP_CODE='IT'";
		$where_clause .= " and emp_basic_info.BRANCH_CODE=10 and DESIG_CODE=409"; //.$branch_id;
	
		$query = "SELECT EMP_NUM as user_id, EMP_NAME as name from emp_basic_info $where_clause limit 1";
		$query = $this->db->query($query);
		$result = $query->row();
		return $result->user_id;
	}
	
	function timeDiff($t1, $t2){
		
		$query = "SELECT TIMEDIFF('$t1','$t2') as diff_time";
		$query = $this->db->query($query);
		$result = $query->row();
		return $result->diff_time;
	}
	
	function getVendorList(){
		$query = $this->db->get('vendors');
		return $query->result();
	}
	
	function getBrandsList(){
		$query = $this->db->get('brands');
		return $query->result();
	}
	
	function getHardwareList(){
		$query = $this->db->get('hardware');
		return $query->result();
	}
	function getServicesList(){
		$query = $this->db->get('services');
		return $query->result();
	}
	
	function insertNote(){
		//$form = array('form_id'=>$formId, 'form_type'=>$formType);
		$this->db->insert('form_notes', $_POST);
		return $this->db->insert_id();
	}
				
	/**
	 * End Help Service Desk Block
	 */	
	
	
	function upload_file_log($file_data, $formId = null, $c = null){
		$branch = '';
		if(isset($_COOKIE[SESSION_CONST_PRE.'branch']))
		{
			$branch = $_COOKIE[SESSION_CONST_PRE.'branch'];
		}
		
		$form = array('form_log_id'=>$formId,'form_type'=>$c, 'branch' => $branch, 'uploaded_by' => $this->session->userdata(SESSION_CONST_PRE.'userId') );
		$arr_upload = array_merge($file_data, $form);
		$this->db->insert('upload_file_log', $arr_upload);
	}
	
	function insert_lables($lbl, $text){
		$query = "select localize_id from localize where localize_id='$lbl'";
		$query = $this->db->query($query);
		$rs = $query->result();
	
		if(!isset($rs[0])){
				
			$this->db->insert('localize', array('localize_id'=>$lbl, 'lang_en'=>$text));
		}
	}
	
	public function leading_zeros($value, $places){
	 	$leading="";
	    if(is_numeric($value)){
	        for($x = 1; $x <= $places; $x++){
	            $ceiling = pow(10, $x);
	            if($value < $ceiling){
	                $zeros = $places - $x;
	                for($y = 1; $y <= $zeros; $y++){
	                    $leading .= "0";
	                }
	            $x = $places + 1;
	            }
	        }
	        $output = $leading . $value;
	    }
	    else{
	        $output = $value;
	    }
	    return $output;
	}
}
