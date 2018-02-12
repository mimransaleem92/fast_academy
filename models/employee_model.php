<?php

class Employee_model extends Base_Model{
	
	function Employee_model(){
		parent::__construct();
		
	}
	
	function get_all_employees($row = 0, $paging = FALSE){
		$this->db->select('employees.*, subjects.subject_name');
		$this->db->from('employees');
		$this->db->join('subjects', 'subjects.subject_id = employees.subject_id', 'LEFT');
		//$this->db->join('departments', 'departments.department_id = employees.department_id', 'LEFT');
		
		if($paging){
			$query = $this->db->get('',10,$row);
		}
		else 
		{
			$query = $this->db->get();
		}
		return $query->result();
	}
	
	function get_search_employees(){
		$search  = $_POST['search'];
		
		$this->db->select('employees.*, subjects.subject_name');
		$this->db->from('employees');
		$this->db->join('subjects', 'subjects.subject_id = employees.subject_id', 'LEFT');
		
		if(is_numeric($search)){
			/* $this->db->where("employees.employee_code", $search);
			$this->db->or_where("employees.employee_id", $search); */
			$this->db->where("employees.employee_id", $search);
				
		}else{
			$this->db->where("employees.employee_name LIKE '$search%'");
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_num_employees(){
		return $this->db->count_all('employees');
	}
	
    function get_employee($id){
		$query = $this->db->get_where('employees',array("employee_id" => $id));
		return $query->result();
	}
	
	function get_employee_academic($id){
		$this->db->order_by('employee_academic_id');
		$query = $this->db->get_where('employee_academic',array("employee_id" => $id));
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_employee_experience($id){
		$this->db->order_by('employee_experience_id');
		$query = $this->db->get_where('employee_experience',array("employee_id" => $id));
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_employee_dependent($id){
		$this->db->order_by('relation');
		$query = $this->db->get_where('employee_dependents',array("employee_id" => $id));
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	function insert()
    {
        $emp_arr = array ('first_name', 'middle_name', 'surname', 'first_name_ar', 'middle_name_ar', 'surname_ar', 'familyname_ar', 'passport_place_issue', 'contact_person_name', 'contact_person_mobile', 'email_id',
        				  'employee_name', 'father_name', 'gender', 'marital_status', 'date_of_birth', 'land_line', 'mobile_no', 'grade_id', 'joining_date', 
        				  'saudi_address', 'saudi_city', 'saudi_state', 'saudi_zip', 'postal_address', 'city', 'state', 'zip', 'profession',
        				  'country_id', 'iqama_id', 'iqama_expiry', 'passport_id', 'passport_expiry', 'subject_id');
    	$main_arr = array();
    	foreach ($emp_arr as $index)
    	{
    		if(isset($_POST[$index]))
    		$main_arr[$index] = $_POST[$index];
    	}
    	
    	$this->db->insert('employees', $main_arr);
    	$employee_id = $this->db->insert_id();
    	/* $academic_detail = array();
    	$count = $_POST['academic_row_added'];
    	for($i=0; $i < $count; $i++)
    	{
	    	if($_POST['degree'][$i] != '')
	    	{
	    		$academic_detail[$i] = array ( 'employee_id'=>$employee_id, 'degree'=>$_POST['degree'][$i], 'passing_year'=>$_POST['passing_year'][$i], 'grade_division'=>$_POST['grade_division'][$i], 'institute_name'=>$_POST['institute_name'][$i],'country'=>$_POST['country'][$i]);
	    	}
    	}
    	if(sizeof($academic_detail)>0)
    	$this->db->insert_batch('employee_academic',$academic_detail);
    	
    	$exp_detail = array();
    	$count = $_POST['exp_row_added'];
    	for($i=0; $i < $count; $i++)
    	{
    	if($_POST['position'][$i] != '')
    		{
    			$exp_detail[$i] = array ( 'employee_id'=>$employee_id, 'position'=>$_POST['position'][$i], 'orgnization'=>$_POST['orgnization'][$i], 'years_experience'=>$_POST['years_experience'][$i], 'from'=>$_POST['from'][$i],'to'=>$_POST['to'][$i]);
    		}
    	}
    	if(sizeof($exp_detail)>0)
    	$this->db->insert_batch('employee_experience',$exp_detail); */
    	
    	return $employee_id;
    }
    
    function get_subjects_course_by_employee($id){
    	$this->db->select('cs.*, s.subject_name, s.subject_name_arabic, c.course_name, c.course_name_ar, cs.section');
    	$this->db->from('teacher_subject_course cs');
    	$this->db->join('subjects s','cs.subject_id = s.subject_id');
    	$this->db->join('courses c','cs.course_id = c.course_id');
    	$this->db->where('cs.employee_id', $id);
    	$this->db->order_by('s.subject_id');
    	$query = $this->db->get();
    	
    	return $query->result();
    }
	
    function insert_subject_course(){
    	$course_arr = $_POST;
    	$course_arr['batch_id'] = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
    	$f = $this->db->insert('teacher_subject_course', $course_arr);
    	return $f;
    }
    
    function delete_subject_course(){
    	if(isset($_POST['id']) && isset($_POST['id'])){
    		$this->db->where('id', $_POST['id']);
    		$this->db->delete('teacher_subject_course');
    	}
    }
    
	function update()
    {
    	$emp_arr = array ('first_name', 'middle_name', 'surname', 'first_name_ar', 'middle_name_ar', 'surname_ar', 'familyname_ar', 'passport_place_issue', 'contact_person_name', 'contact_person_mobile', 'email_id',
    					  'employee_name', 'father_name', 'gender', 'marital_status', 'date_of_birth', 'land_line', 'mobile_no', 'grade_id', 'joining_date', 'attendance_log_id', 
    					  'saudi_address', 'saudi_city', 'saudi_state', 'saudi_zip', 'local_address', 'city', 'state', 'zip', 'profession', 
    					  'country_id', 'iqama_id', 'iqama_expiry', 'passport_id', 'passport_expiry', 'subject_id');
    	
    	$main_arr = array();
    	foreach ($emp_arr as $index)
    	{
    		if(isset($_POST[$index]))
    		$main_arr[$index] = $_POST[$index];
    	}
    	
    	if(ENABLE_HR_MODULE == 1){
	    	$check_list = '';
	    	for($a=1;$a<=8;$a++){
	    		if(isset($_POST['option0'.$a]) && $_POST['option0'.$a] == 'on'){
	    			$check_list .= ','.$a;
	    		}
	    	}
	    	if($check_list != ''){
	    		$main_arr['check_list'] =	substr($check_list, 1);
	    	}
	    	
	    	$check = array('registered_gosi', 'gosi_still_registered', 'registered_hrdf', 'hrdf_still_registered');
	    	foreach ($check as $c){
	    		$main_arr[$c] = (isset($_POST[$c]) && $_POST[$c] == 'on') ? 'Y' : 'N';
	    	}
    	}
    	
    	$employee_id  = $_POST['employee_id'];
    	$this->db->where('employee_id', $employee_id);
    	$this->db->update('employees', $main_arr);
    	
    	if(ENABLE_HR_MODULE == 1){
	    	$academic_detail = array();
	    	$count = $_POST['academic_row_added'];
	    	for($i=0; $i < $count; $i++)
	    	{
	    	if($_POST['degree'][$i] != '')
	    		{
	    			$academic_detail[$i] = array ( 'employee_id'=>$employee_id, 'degree'=>$_POST['degree'][$i], 'passing_year'=>$_POST['passing_year'][$i], 'grade_division'=>$_POST['grade_division'][$i], 'institute_name'=>$_POST['institute_name'][$i],'country'=>$_POST['country'][$i]);
	    		}
	    	}
	    	if(sizeof($academic_detail)>0){
	    		//$this->db->delete('employee_academic', array('employee_id'=>$employee_id));
	    	    $this->db->insert_batch('employee_academic',$academic_detail);
	    	}
	    	$exp_detail = array();
	    	$count = $_POST['exp_row_added'];
	    	for($i=0; $i < $count; $i++)
	    	{
		    	if($_POST['position'][$i] != '')
		    	{
		    		$exp_detail[$i] = array ( 'employee_id'=>$employee_id, 'position'=>$_POST['position'][$i], 'orgnization'=>$_POST['orgnization'][$i], 'years_experience'=>$_POST['years_experience'][$i], 'from'=>$_POST['from'][$i],'to'=>$_POST['to'][$i]);
		    	}
	    	}
	    	if(sizeof($exp_detail)>0) {
		    	//$this->db->delete('employee_experience', array('employee_id'=>$employee_id));
		    	$this->db->insert_batch('employee_experience',$exp_detail);
	    	} 
    	}
    	return $employee_id;
    }
    
    function get_employee_files($id){
    	$query = $this->db->get_where('upload_file_log',array("form_log_id" => $id, 'form_type'=>'Employee'));
    	return $query->result();
    }
    
    function get_attached_file($id){
    	$query = $this->db->get_where('upload_file_log',array("upload_file_log_id" => $id));
    	$res = $query->result();
    	return (isset($res[0])) ? $res[0] : null;
    }
	
	function update_image_path($file)
    {
    	$employee_id  = $_POST['employee_id'];
    	$main_arr = array('employee_image'=>$file);
    	$this->db->where('employee_id', $employee_id);
    	$this->db->update('employees', $main_arr);
    }
    
    function delete($employee_list)
    {
    	$employee_arr = explode(",", $employee_list);
    	foreach ($employee_arr as $employee_id)
    	{
    		$this->db->where('employee_id', $employee_id);
	        $this->db->delete('employee_dependents');
	    	$this->db->where('employee_id', $employee_id);
	        $this->db->delete('employees');
    	}
    }
    
    function update_employee_data(){
    	$sql = "SELECT * FROM `employees` WHERE 1";
    	$query = $this->db->query($sql);
    	$result = $query->result();
    	foreach ($result as $row){
    		//$dt = explode('/',$row->iqama_expiry);
    		//$iqama_expiry = $dt[2].'-'.$dt[1].'-'.$dt[0];
    		//echo $iqama_expiry.'<br>';
    		//$sql = "Update `employees` SET iqama_expiry='$iqama_expiry' WHERE `iqama_id`=".$row->iqama_id;
    		//$school = ($row->division_id == 'DIS') ? '2' : '1';
    		//$sql = "Update `employees` SET division_id='$school' WHERE `employee_id`=".$row->employee_id.' AND division_id is NULL';
    		/*
    		$n = explode(' ',$row->employee_name);
    		$n_ar = explode(' ', trim( $row->first_name_ar));
    		
    		
    		//$first = $n[0].' '.$n[1];
    		$first_ar = $n_ar[0];
    		
    		//$middle = (strlen($n[2])>2) ? $n[2] : $n[sizeof($n)-1];
    		$middle_ar = $n_ar[1];
    		
    		
    		//$last = (strlen($n[3])>2) ? $n[3] : $n[sizeof($n)] ;
    		$last_ar = $n_ar[2];
    		//$last = addslashes($last);
    		
    		$family_ar = $n_ar[sizeof($n_ar)-1];
    		
    		$sql = "Update `employees` SET 
    					first_name_ar='$first_ar',
    					middle_name_ar='$middle_ar',
    					surname_ar='$last_ar',
    					familyname_ar = '$family_ar'
    				WHERE `employee_id`=".$row->employee_id;
    		*/
    		$contact_no = str_replace('e+0', '', trim( $row->mobile_no));
    		$contact_no = str_replace('.', '', $contact_no);
    		$sql = "Update `employees` SET
    		
    			mobile_no = '$contact_no'
    		
    		WHERE `employee_id`=".$row->employee_id;
    		$this->db->query($sql);
    		//if($row->iqama_id == '1040319954') break;
    	}
    }
}