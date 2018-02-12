<?php

class Dashboard_model extends Base_Model{
	
	function Dashboard_model(){
		parent::__construct();
		
	}
	
	function getSubmittedFormList($emp_num)
	{
		return NULL;
	}
	
	function getPendingFormList($emp_num)
	{
		return NULL;	
	}
	
	function get_today_collection(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$pattren = ($div_id == '1') ? 'DNS' : 'DIS';
		$from  = date('Y-m-d');
	
		$this->db->select("sum(payment_amount) as amount");
		$this->db->from('student_payments');
		$this->db->where('mark_delete', '0');
		$this->db->where("DATE_FORMAT(payment_date, '%Y-%m-%d')='$from'");
		$this->db->where('division_id', $div_id );
		$this->db->group_by('division_id');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		$result = $query->result();
		return (isset($result[0])) ? $result[0]->amount : '0';
	}
	
	function get_today_collection_list(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$pattren = ($div_id == '1') ? 'DNS' : 'DIS';
		$from  = date('Y-m-d');
		
		$this->db->select("sp.*, s.student_name, s.admission_number, s.section, c.course_name");
		$this->db->select("DATE_FORMAT(sp.payment_date, '%d-%m-%Y') as pdate",FALSE);
		$this->db->from('student_payments sp');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->where("DATE_FORMAT(sp.payment_date, '%Y-%m-%d')='$from'");
		$this->db->where('sp.mark_delete', '0');
		//$this->db->where("sp.payment_date between '".$from."' and '".$to."'" );
		$this->db->where("s.admission_number like '".$pattren."%'");
		$this->db->order_by('s.student_name');
		$query = $this->db->get('', 10);
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_enrollment_list(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
		$this->db->where(array("division_id"=>$div_id, 'cdel'=>'0'));
		$this->db->order_by('enrollment_id', 'desc');
		$query = $this->db->get('enrollments', 10);
		return $query->result();
	}
	
	function get_absent_students_list(){
		$batch = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		
		$this->db->select("s.admission_number, s.student_name, s.section, c.course_name, sp.attendance_comment");
		$this->db->from('student_attendance sp');
		$this->db->join('students s','s.student_id = sp.student_id');
		$this->db->join('courses c','s.course_id = c.course_id');
		$this->db->where("DATE_FORMAT(sp.attendance_date, '%Y-%m-%d') = CURDATE()"); // 
		$this->db->where("sp.batch_id", $batch);
		$this->db->order_by('student_name');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function getRequestByStatus($status)
	{
		$company_id = $this->session->userdata(SESSION_CONST_PRE.'company_id');
		$branch_id = $this->session->userdata(SESSION_CONST_PRE.'branch_id');
		$department = $this->session->userdata(SESSION_CONST_PRE.'dept_id');
		
		$where  = " where form_type  = 'IT Request' ";
		//$where .= " where form_logs.emp_num='".$emp_num."' ";
		$where .= " and form_logs.status='".$status."' ";
		
		
		$query = "select count(form_logs_id) as num_requests FROM 
					form_logs  $where ";
		
		$query = $this->db->query($query);
		return $query->row()->num_requests;	
	}
	
	function getPendingFormListOLD($emp_num)
	{
		$query = "select workflow_log.workflow_log_id as id,workflow_log.form_id as form_id, workflow_log.form_type as form_type, workflow_log.sub_type as sub_type, workflow_log.created_date as created_date, 
					workflow_log.status as status, concat(substring(emp_basic_info.EMP_NAME,1,15), ' (', emp_basic_info.username, ')' ) as emp_name, workflow_log.form_url, workflow_log.form_owner_id , prepared_tbl.prepared_emp_id, prepared_tbl.prepared_emp_name
				from emp_basic_info join workflow_log on emp_basic_info.EMP_NUM = workflow_log.form_owner_id 
				left join (
					select distinct salary_prepared.salary_prepared_id as f_id, salary_prepared.prepared_for as prepared_emp_id, emp_basic_info.EMP_NAME  as prepared_emp_name
					from emp_basic_info join salary_prepared on emp_basic_info.EMP_NUM = salary_prepared.prepared_for
				) as prepared_tbl on prepared_tbl.f_id = workflow_log.form_id  and workflow_log.form_type='Salary Loan'
				where workflow_log.emp_num='".$emp_num."' and workflow_log.status = 'Pending' 
				order by workflow_log.created_date desc";
		
		$query = $this->db->query($query);
		return $query->result();	
	}
	
	function getUnPendingFormList($emp_num)
	{
		 $query  =  "select form_logs.form_logs_id, form_logs.subject, form_logs.ref_number, form_logs.readonly_url, wf_log.* ,
					concat(substring(emp_basic_info.EMP_NAME,1,15), ' (', emp_basic_info.username, ')' ) as emp_name, a.emp_name as assign_to_name
					from emp_basic_info  
					join form_logs on emp_basic_info.EMP_NUM = form_logs.emp_num
					join 
					( select workflow_log_id as id, created_date, form_id, form_type, sub_type, form_url, status from workflow_log 
					where emp_num='".$emp_num."'
					and status NOT IN ('New', 'Pending') order by form_id desc, workflow_log_id desc) as wf_log
					on form_logs.form_id=wf_log.form_id and form_logs.form_type=wf_log.form_type 
					left join emp_basic_info a on a.EMP_NUM = form_logs.assign_to_id 
					group by form_logs.form_logs_id  
					order by wf_log.created_date desc Limit 0,20";
		
		$query = $this->db->query($query);
		return $query->result();	
	}
	
	function getSalaryPreparedFormList()
	{
		$query = "select form_logs.*, concat(substring(emp_basic_info.EMP_NAME,1,15), ' (', emp_basic_info.username, ')' ) as emp_name, leave_form.req_leave_from , leave_form.req_leave_to from form_logs  join leave_form on form_logs.form_id = leave_form.leave_form_id  join emp_basic_info on emp_basic_info.EMP_NUM = form_logs.emp_num where form_logs.form_type='Leave Form' and form_logs.sub_type='Annual' and leave_form.salary_required = 'Yes' and form_logs.approved = 'Y' and leave_form.salary_prepared = 'N' and date_SUB(CURdate(),INTERVAL 15 DAY) <= leave_form.req_leave_from order by leave_form.req_leave_from";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	function getNotificationList($emp_num)
	{
		if($emp_num != 1707){
			$emp_num = 1264;
		}
		$query = "select notification_logs.created_date, notification_logs.emp_num, notification_logs.description, notification_logs.ref_number, form_logs.readonly_url, form_logs.form_type, form_logs.sub_type , (select concat( substring(EMP_NAME,1,15), ' (', username, ')' ) as empname from emp_basic_info where emp_num = form_logs.emp_num) as emp_name
				  from form_logs
				  join notification_logs on notification_logs.ref_number = form_logs.ref_number 
				  where notification_logs.emp_num='$emp_num' order by notification_logs.created_date desc";
		$query = $this->db->query($query);
		return $query->result();	
	}
	
	function getLeaveEncashmentFormList()
	{
		$query = "select form_logs.*, concat(substring(emp_basic_info.EMP_NAME,1,15), ' (', emp_basic_info.username, ')' ) as emp_name, leave_form.req_leave_from , leave_form.req_leave_to from form_logs  join leave_form on form_logs.form_id = leave_form.leave_form_id  join emp_basic_info on emp_basic_info.EMP_NUM = form_logs.emp_num where form_logs.form_type='Leave Form' and form_logs.sub_type='Leave Encashment' and form_logs.approved = 'Y' and leave_form.salary_prepared = 'N' order by leave_form.req_leave_from";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function get_expired_istmara(){
 		$query = $this->db->query("select count(vehicle_id) as items from vehicle where vehicle.istmara_alert<= CURDATE()");
		return $query->result();
 		//return $this->db->count_all($q);		 			
 	}
	
 	public function get_expired_istmara_list(){
 		$query = $this->db->query("select vehicle.*,  drivers.name as driver_name
 		from vehicle 
 		left join drivers on drivers.driver_id = vehicle.driver_id 
 		where vehicle.istmara_alert<= CURDATE()  
 		order by vehicle.istmara_alert desc limit 0,10");
		//$query = $this->db->get();
		return $query->result();	 			
 	}
}