<?php

class Teststudents_model extends Base_Model{
	
	function __construct(){
		parent::__construct();
		$this->setFormType('Student');
	}
	
	function get_all_students($row = 0, $paging = FALSE){
		
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		//$pattren = ($div_id == '1') ? 'FB' : 'FG';
		//$this->db->like('admission_number', $pattren);
		$this->db->where('s.division_id', $div_id);
		$this->db->where('s.cdel', '9');
		if (isset($_POST['admission_number']) && strlen($_POST['admission_number']) >= 11){
			$this->db->where('s.admission_number', $_POST['admission_number']);
		}
		if (isset($_POST['student_name']) && !empty($_POST['student_name'])){
			$this->db->like('s.student_name', $_POST['student_name']);
		}
		
		if (isset($_POST['father_name']) && !empty($_POST['father_name'])){
			$this->db->like('s.father_name', $_POST['father_name']);
		}
		
		if (isset($_POST['course_id']) && $_POST['course_id'] > 0 ){
			$this->db->where('s.course_id', $_POST['course_id']);
			
			if ( isset($_POST['section']) && $_POST['section'] != '' ){
				$this->db->where('s.section', $_POST['section']);
			}
			if(isset($_POST)) $paging = FALSE;
		}
		
		if($paging){
			$this->db->select('s.*, c.course_name');
			$this->db->from('students s');
			$this->db->join('courses c', 'c.course_id = s.course_id', 'LEFT');
			$this->db->order_by('student_id', 'desc');
			$query = $this->db->get('', 10, $row);
		}
		else 
		{
			$this->db->select('s.*, c.course_name');
			$this->db->from('students s');
			$this->db->join('courses c', 'c.course_id = s.course_id', 'LEFT');
			$this->db->order_by('course_id, section, student_name', 'asc');
			$query = $this->db->get();
		}
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_students_count(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$where = '';
		if (isset($_POST['admission_number']) && strlen($_POST['admission_number']) >= 11){
			$where = " AND admission_number='".$_POST['admission_number']."'";
		}
		if (isset($_POST['student_name'])){
			$where = " AND student_name LIKE('%".$_POST['student_name']."%')";
		}
		$query  = $this->db->query("select count(admission_number) as id from students where division_id='".$div_id."' and cdel=0 $where");
		
		$result = $query->result();
		$max_num = $result[0]->id;
		return $max_num;
	}
	
	function get_num_students(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
		$query  = $this->db->query("select count(admission_number) as id from students where division_id='".$div_id."' and cdel=0");
		$result = $query->result();
		$max_num = $result[0]->id;
		return $max_num;
	}
	
	function valid_sibling($refer){
		if(isset($_POST['student_id'])){
			$student_id = $_POST['student_id'];
		}
		
		if(isset($_POST['mother_name']) && isset($_POST['father_name'])){
			$where = '';
			if(!empty($_POST['mother_name'])){
				$where  = "AND mother_name = '".$_POST['mother_name']."'";
			}
			
			if(!empty($_POST['father_name'])){
				$where  = "AND father_name = '".$_POST['father_name']."'";
			}
			
			if(!empty($_POST['mother_name']) && !empty($_POST['father_name'])){
				$where  = "AND ( mother_name = '".$_POST['mother_name']."' OR father_name='".$_POST['father_name']."' )";
			}
		}
		
		$max_num = 0;
		if($where != ''){
			$query  = $this->db->query("select count(admission_number) as id from students where admission_number='".$refer."' and student_id<>$student_id and used_as_sibling=0 $where");
			$result = $query->result();
			$max_num = $result[0]->id;
		}
		return ($max_num == 1) ? true : false;
	}
	
    function get_students($id){
    	$this->db->select('students.*, c.course_name, b.batch_name');
		$this->db->from('students');
		$this->db->join('courses c', 'c.course_id = students.course_id', 'LEFT');
		$this->db->join('batches b', 'b.batch_id = students.batch_id', 'LEFT');
		$query = $this->db->get_where('',array("student_id" => $id));
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_students_by_grade($id, $div_id, $pages=0){
		$this->db->select('s.*, c.course_name, b.batch_name');
		$this->db->from('students s');
		$this->db->join('courses c', 'c.course_id = s.course_id', 'LEFT');
		$this->db->join('batches b', 'b.batch_id = s.batch_id', 'LEFT'); 
		$this->db->order_by('s.course_id, s.section, s.student_name', 'asc');
		//$this->db->limit(50, $pages*50);
		//$this->db->order_by('course_id, section, student_id', 'asc');
		$query = $this->db->get_where('',array("s.course_id" => $id, 's.cdel'=>0,'s.division_id'=>$div_id));
		
		return $query->result();
	}
	
	function get_subjects_info($course_id){
		$this->db->select('subjects.subject_name, subjects.subject_name_arabic, course_subject.*');
		$this->db->from('subjects');
		$this->db->join('course_subject', 'subjects.subject_id = course_subject.subject_id');
		
		$this->db->where(array("course_subject.course_id" => $course_id, 'course_subject.subject_id <>'=>0));
		$this->db->order_by('subjects.report_order');
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_student_marks($student_id, $course_id, $section, $batch, $term){
		
		$this->db->where(array("course_id" => $course_id, 'student_id'=>$student_id, 'section'=>$section, 'batch_id'=>$batch, 'term'=>$term));
		$query = $this->db->get('marksheet');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_student_payments($id){
		
		$query = $this->db->get_where('student_payments',array("payment_id" => $id));
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_payments_by_student($id){
		// Inactive students mark_delete = 1
		$query = $this->db->get_where('student_payments',array("student_id" => $id, "payment_amount >"=>0, 'mark_delete'=>0)); 
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_student_dependent($id){
		$this->db->order_by('relation');
		$query = $this->db->get_where('student_dependents',array("student_id" => $id));
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function update_admission_number(){
		$curr_month = date('Y-m-01');
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$pattren = ($div_id == '1') ? 'FB' : 'FG';
		if($div_id == '1'){ // 1
			$sql ="SELECT student_id, remarks  FROM students WHERE gender='M' order by student_id";
		}
		else{
			$sql ="SELECT student_id, remarks  FROM students WHERE  gender='F' order by student_id";
		}
		$query = $this->db->query($sql);
	
		$result = $query->result();
		$new = $i = 1; $arr_fee = array();
		foreach ($result as $row) {
			$student_id = $row->student_id;
				
			if($row->remarks == '')
			{
				$reg_number = $pattren . '-' . (date('y')-1)."-". Util::leading_zeros ($i, 4);
				$i++;
			}
			else{
	
				$reg_number = $pattren . '-' . date('y')."-". Util::leading_zeros ($new, 4);
				$new++;
			}
				
			$this->db->where('student_id', $student_id);
			$this->db->update('students', array('admission_number'=>$reg_number));
		}
	}
	
	function update_admission_number_test(){
		$curr_month = date('Y-m-01');
		
		$sql ="SELECT student_id, gender  FROM students order by student_id";
		$query = $this->db->query($sql);
		
		$result = $query->result();
		$i = 1; $arr_fee = array();
		foreach ($result as $row) {
			$student_id = $row->student_id;
			$pattren = ($row->gender == 'M') ? 'FB' : 'FG';
			$reg_number = $pattren . '-' . (date('y'))."-". Util::leading_zeros ($i, 4);
			$this->db->where('student_id', $student_id);
			$this->db->update('students', array('admission_number'=>$reg_number));
			$i++;  
		}	
	}
	
	function update_fileds(){
		$value = $_POST['value'];
		if (strpos($_POST['field'],'date') !== false) {
			$value = Util::dateSavingFormat($value);
		}	
		$this->db->where('payment_id', $_POST['id']);
		$this->db->update('student_payments', array($_POST['field']=>$value));
	}
	
	function get_admission_number($id){
		
		$query  = $this->db->query("select admission_number from students where student_id='".$id."'");
		$result = $query->result();
		if(isset($result[0])){
			return $result[0]->admission_number;
		}
		return NULL;
	}
	
	function transfer_to_students($id){
		$cdel_by = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$admission_number = $this->get_adminition_no();
		$sql =  "INSERT INTO students (student_name,  student_name_ar,  father_name,  date_of_birth,  gender,  marital_status,  iqama_id,  iqama_expiry,  passport_id,  passport_expiry,  birth_place,  blood_group,  nationality,  country_id,  city,  state,  pin_code,  address_line1,  address_line2,  cell_phone_father,  cell_phone_mother,  `language`,
		emergency_contact, emergency_contact_relation, emergency_contact_name, admission_date, 
		category,  religion,  cdel,  cdel_by,  email,  student_image,  enrollment_date,  first_name,  last_name,  profession,  course_id,  batch_id,  sibling,  sibling_student_id,  monthly_fee,  admission_number,  section,  mother_name,  work_place_mother,  id_number_mother,  work_phone_mother,  email_mother,  work_place_father,
		id_number_father,  work_phone_father,  email_father,  employee_kid,  discount_on_employee_kid,  transportation,  transport_type,  enable_cash_payment,  division_id,  education_plus,  education_plus_fee,  issue_date,  admission_term,  previous_school,  transport_term,  used_as_sibling,  iqama_expiry_father,
		iqama_expiry_mother,  passport_father,  passport_mother,  passport_expiry_father,  passport_expiry_mother,  enrollment_grade_level,  occupation_father,  occupation_mother,  check_list,  remarks,  skip_validate,  skip_validate_note)
		(Select student_name,  student_name_ar,  father_name,  date_of_birth,  gender,  marital_status,  iqama_id,  iqama_expiry,  passport_id,  passport_expiry,  birth_place,  blood_group,  nationality,  country_id,  city,  state,  pin_code,  address_line1,  address_line2,  cell_phone_father,  cell_phone_mother,  `language`,
		emergency_contact, emergency_contact_relation, emergency_contact_name, NOW(),
		category,  religion,  cdel,  $cdel_by,  email,  student_image,  admission_date,  first_name,  last_name,  profession,  course_id,  batch_id,  sibling,  sibling_student_id,  monthly_fee,  '$admission_number',  section,  mother_name,  work_place_mother,  id_number_mother,  work_phone_mother,  email_mother,  work_place_father,
		id_number_father,  work_phone_father,  email_father,  employee_kid,  discount_on_employee_kid,  transportation,  transport_type,  enable_cash_payment,  division_id,  education_plus,  education_plus_fee,  issue_date,  admission_term,  previous_school,  transport_term,  used_as_sibling,  iqama_expiry_father,
		iqama_expiry_mother,  passport_father,  passport_mother,  passport_expiry_father,  passport_expiry_mother,  enrollment_grade_level,  occupation_father,  occupation_mother,  check_list,  remarks,  skip_validate,  skip_validate_note from enrollments where enrollment_id =$id );";
			
		$this->db->query($sql);
		$student_id = $this->db->insert_id();
		$row  = $this->get_students($student_id);
		$main_arr = array($student_id, $admission_number);
		if(isset($row[0])){
			$form = $row[0];
			if($form->education_plus == 'Yes'){
				if($form->education_plus_fee != '' && $form->education_plus_fee > 0){
					$this->update_fee_transaction('Education Plus Fee', $student_id, $form->batch_id, $form->education_plus_fee);
				}
			}
			
			if($form->transportation == 'Yes'){
				if($form->transport_type != ''){
					$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
					$div = ($div_id == '1') ? 'FB' : 'FG';
					$transport_fee_type = $form->transport_type.'_'.$div;
			
					$fee_amount = $this->get_transportation_amount($form->course_id, $transport_fee_type);
					$this->update_fee_transaction('Transportation Fee', $student_id, $form->batch_id, $fee_amount);
				}
			}
			 
			$term = substr($form->admission_term, -1);
			$this->add_tution_fee($student_id, $term);
			$this->add_student_class_log($student_id);
		}
		
		
		$this->db->where(array('form_log_id'=>$id, 'form_type'=>'Enrollment'));
		$this->db->update('upload_file_log', array('form_log_id'=>$student_id, 'form_type'=>'Student')); //, 'file_path'=>'', 'full_path'=>''
		
		$this->db->where('enrollment_id', $id);
		$this->db->update('enrollments', array('cdel'=>'1'));
		
		return $main_arr;
	}
		
	function insert()
    {
        $emp_arr = array ('student_name', 'student_name_ar', 'father_name', 'gender', 'date_of_birth', 'birth_place', 'blood_group', 'nationality',
        				  'emergency_contact', 'emergency_contact_relation', 'emergency_contact_name',
  						  'country_id', 'city',  'state',  'address_line1',  'address_line2', 'language',  'category',  
        				  'religion',  'email', 'admission_date','iqama_id', 'passport_expiry', 'issue_date','iqama_expiry', 'passport_id', 
        				  'course_id', 'batch_id', 'section', 'sibling_student_id', 'discount_on_employee_kid', 'mother_name', 
        				  'work_place_mother', 'id_number_mother', 'work_phone_mother', 'cell_phone_mother', 'email_mother',
        				  'work_place_father', 'id_number_father', 'work_phone_father', 'cell_phone_father', 'email_father',
        				  'transport_type', 'education_plus_fee', 'admission_term', 'previous_school', 'previous_school_ar', 'remarks',
        				  'occupation_mother', 'occupation_father', 'enrollment_grade_level' ,'passport_expiry_mother',
						  'passport_expiry_father' , 'passport_mother','passport_father','iqama_expiry_mother' ,'iqama_expiry_father');
    	$main_arr = array();
    	foreach ($emp_arr as $index)
    	{
    		if(isset( $_POST[$index]))
    		$main_arr[$index] = $_POST[$index];
    	}
    	
    	$main_arr['check_list'] = '';
    	$check_list = '';
    	for($a=1;$a<=12;$a++){
    		if(isset($_POST['option'.$a]) && $_POST['option'.$a] == 'on'){
    			$check_list .= ','.$a;
    		}
    	}
    	if($check_list != ''){
    		$main_arr['check_list'] =	substr($check_list, 1);
    	}
    	$main_arr['admission_number'] = $this->get_adminition_no();
    	$main_arr['division_id'] = $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
    	$main_arr['sibling'] = (isset($_POST['sibling']) && $_POST['sibling'] == 'on') ? 'Yes':'No';
    	$main_arr['employee_kid'] = (isset($_POST['employee_kid']) && $_POST['employee_kid'] == 'on') ? 'Yes':'No';
    	$main_arr['transportation'] = (isset($_POST['transportation']) && $_POST['transportation'] == 'on') ? 'Yes':'No';
    	$main_arr['month'] = $_POST['admission_term'];
		$main_arr['cdel'] = '9';
    	$this->db->insert('students', $main_arr);
    	$student_id = $this->db->insert_id();
		$course_id = $_POST['course_id'];
    	if(ENABLE_FEE_MODULE == 1){	
	    	$main_arr = array();
	    	$batch_id = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
	    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
			$month = date('m');
			$due_date = date('Y').'-'.$month.'-01';
			$subject_list = $_POST['availableSubjects'];
			$record = array('student_id'=>$student_id, 'batch_id'=>$batch_id, 'month'=>$month);
			$record1 = array('student_id'=>$student_id, 'due_date'=>$due_date, 'batch_id'=>$batch_id, 'division_id'=>$div_id, 'fee_desc'=>'Tuition Fee', 'user_id'=>$user_id);
			
			$subject_fee = $this->get_fee_per_subject($course_id);
			
			for($i=0;$i<sizeof($subject_list);$i++)
			{    	
				$subject_id = $subject_list[$i];
				if($subject_id == 19 || $subject_id == 1){
					$due_fee=$subject_fee * (0.75);
				}else{
					$due_fee=$subject_fee;
				}
				$sub = array('subject_id'=> $subject_id);
				$receipt[] = array_merge( $record , $sub);
				$student_payments[] = array_merge( $record1 , array('subject_id'=> $subject_id, 'month'=>$month, 'due_amount'=>$due_fee));
			}
			$student_payments[] = array_merge( $record1 , array('subject_id'=> 28, 'month'=>$month, 'due_amount'=>500));
			if($this->db->insert_batch('student_subject_monthly', $receipt)){
				$this->db->insert_batch('student_payments', $student_payments);
			}
	    	//$term = substr($_POST['admission_term'], -1);
	    	$this->add_student_class_log($student_id);
	    }
    	return $student_id;
    }
    
    function add_tution_fee($student_id, $term='1'){
    	if(ENABLE_FEE_MODULE == 1){
	    	$division_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	if($term == '1'){
		    	$fee_column = 'FEE_PER_YEAR_DNS';
		    	if($division_id == 1) $fee_column = 'FEE_PER_YEAR_DNS'; 
	    	}
	    	else
	    	{
	    		$fee_column = 'FEE_PER_YEAR_DNS*(0.25)*('.(5-$term).')';
	    		if($division_id == 1) $fee_column = 'FIRST_TERM_DNS';
	    	}
	    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
	    	$date = date('Y-m-d');
	    	$sql =  "INSERT INTO student_payments (fee_desc, due_date, student_id ,due_amount , user_id, division_id, batch_id)
				         (Select  'Tuition Fee','$date', student_id , $fee_column, $user_id, students.division_id, students.batch_id
				         from students  join courses on students.course_id = courses.course_id where student_id = $student_id and division_id = $division_id);";
	    	$this->db->query($sql);
    	}
    }
    
    function update_tution_fee($student_id, $term='1', $batch_id=null, $month=null){
    	if(ENABLE_FEE_MODULE == 1){
	    	$division_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
	    	$date = date('Y-m-d H:m');
	    	
	    	$due_amount = $this->get_student_tution_fee($student_id, $term);
	    	if($due_amount > 0){
				if($month == null) $month = date('m');
				if($batch_id == null) $batch_id = $this->session->userdata(SESSION_CONST_PRE.'batch_id');;
				$sub_count = $this->get_subjects_count($student_id, $batch_id, $month);
				$due_amount = $due_amount * $sub_count;
		    	$sql = "UPDATE `student_payments` SET updated_by=$user_id , updated_at='$date',due_amount=$due_amount WHERE `fee_desc` = 'Tuition Fee' AND `division_id` = '$division_id' AND `student_id` = '$student_id' AND `payment_amount` = '0.00' AND batch_id='$batch_id'";
		    	$this->db->query($sql);
	    	}
    	}	
    }
    
    function get_student_tution_fee($student_id, $term){
    	if(ENABLE_FEE_MODULE == 1){
	    	$division_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	if($term == '1'){
	    		$fee_column = 'FEE_PER_YEAR_DIS';
	    		if($division_id == 1) $fee_column = 'FEE_PER_YEAR_DNS';
	    	}
	    	else
	    	{
	    		$fee_column = 'FEE_PER_YEAR_DIS*(0.25)*('.(5-$term).')';
	    		if($division_id == 1) $fee_column = 'FIRST_TERM_DNS';
	    	}
	    	
	    	$query = $this->db->query("Select $fee_column as due_fee from students join courses on students.course_id = courses.course_id where student_id = $student_id and division_id = $division_id");
	    	
	    	$result = $query->result();
	    	if( isset($result[0]) ){
	    		return $result[0]->due_fee;
	    	}
    	}	
    	return '0.00';
    }
    
    function add_student_class_log($student_id){
    	$division_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
    	$date = date('Y-m-d');
    	$section = (isset($_POST['section'])) ? $_POST['section'] : '';
    	$sql =  "INSERT INTO student_class_log (student_id , class_id, section, user_id, division_id, batch_id) VALUES
    	('$student_id', '".$_POST['course_id']."', '".$section."', $user_id, $division_id, '".$_POST['batch_id']."')";
    	$this->db->query($sql);
    }
    
	function insert_monthly_payment(){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$ref_number = $this->getReceiptNumber($div_id);
		$payment_date = Util::dateSavingFormat($_POST['payment_date']);
		$payment_arr = array ('student_id'=>$_POST['student_id'], 'division_id'=>$div_id, 'batch_id'=>$_POST['batch_id'], 'month'=>$_POST['month'], 'payment_date'=>'NOW()', 'fee_desc'=>$_POST['fee_desc'], 'payment_date'=>date('Y-m-d'),'card_number'=>$_POST['receipt_number'], 'receipt_number'=>$ref_number, 'comments'=>$_POST['remarks'], 'user_id'=>$user_id );
		$subject_list = explode(",", $_POST['subjects_id']);
		$subject_fee = $_POST['payment_amount'] / count($subject_list);
		foreach($subject_list as $subject_id){
			$student_payments[] = array_merge( $payment_arr , array('subject_id'=> $subject_id, 'payment_amount'=>$subject_fee, 'payment_date'=>$payment_date));
		}
		
		$this->db->insert_batch('student_payments', $student_payments);
	}

    function insert_payment(){
    	if(ENABLE_FEE_MODULE == 1){
	    	$emp_arr = array ('student_id', 'batch_id', 'payment_amount', 'payment_date', 'fee_desc', 'payment_mode', 'card_number', 'comments',
	    					  'garantee_cheque1', 'cheque_amount1', 'garantee_cheque2', 'cheque_amount2', 'garantee_cheque3', 'cheque_amount3',
	    					  'cheque_date1', 'present_date1', 'cheque_date2', 'present_date2', 'cheque_date3', 'present_date3', 'fee_term',
	    				      'cheque_amount', 'card_transaction_no', 'auth_code', 'discount_amount','cheque_date', 'cheque_present_date',
			    			  'payment_mode_second', 'card_number_second', 'card_transaction_no_second', 'auth_code_second', 'cheque_amount_second',
			    			  'cheque_date_second', 'cheque_present_date_second', 'second_source'
	    	);
	    	$main_arr = array();
	    	foreach ($emp_arr as $index)
	    	{
	    		if(isset( $_POST[$index]))
	    		{
	    			if(in_array($index, array('card_number','card_transaction_no', 'auth_code', 'cheque_date', 'cheque_present_date')))
	    			{
	    				if($_POST['card_number'] != '') $main_arr[$index] = $_POST[$index];
	    			}
	    			elseif(in_array($index, array( 'card_number_second', 'card_transaction_no_second', 'auth_code_second', 'cheque_date_second', 'cheque_present_date_second'))) {
	    				if($_POST['card_number_second'] != '')$main_arr[$index] = $_POST[$index];
	    			}
	    			elseif(in_array($index, array('cheque_amount1', 'cheque_date1', 'present_date1')))
	    			{
	    				if($_POST['garantee_cheque1'] !='') $main_arr[$index] = $_POST[$index];
	    			}
	    			elseif(in_array($index, array('cheque_amount2', 'cheque_date2', 'present_date2')))
	    			{
	    				if($_POST['garantee_cheque2'] !='') $main_arr[$index] = $_POST[$index];
	    			}
	    			elseif(in_array($index, array('cheque_amount3', 'cheque_date3', 'present_date3')))
	    			{
	    				if($_POST['garantee_cheque3'] !='') $main_arr[$index] = $_POST[$index];
	    			}
	    			else {
	    				$main_arr[$index] = $_POST[$index];
	    			}
	    		}
	    	}
	    	
	    	if(is_numeric($_POST['fee_desc'])){
	    		$payment_arr = array('1'=>'Tuition Fee', '2'=>'Education Plus Fee', '3'=>'Transportation Fee');
	    		$fee_account_arr = array( '1'=>501010111, '2'=>501010112, '3'=>501010113);
	    		$main_arr['fee_desc'] = $payment_arr[$_POST['fee_desc']];
	    		$fee_account = $fee_account_arr[$_POST['fee_desc']];
	    		
	    		if($_POST['fee_desc'] == 1){
	    			$this->db->query("update students set payment_count_for_current_session=payment_count_for_current_session+1 where student_id=".$_POST['student_id']);
	    		}
	    	}
	    	elseif($_POST['fee_desc'] == 'Advance Fee') {
	    		$fee_account =  302210111 ; // 302210111 Advance Income -> New Registration
	    	}
	    	else{
	    		$main_arr['due_amount'] = $_POST['payment_amount'];
	    		$main_arr['due_date'] = $_POST['payment_date'];
	    		if($_POST['fee_desc'] == 'Nursery Fee') $fee_account = 501010114;
	    		elseif($_POST['fee_desc'] == 'Copy Book Fee') $fee_account = 501010115;
	    		elseif($_POST['fee_desc'] == 'Picnic Party Fee') $fee_account = 501010116;
	    		elseif($_POST['fee_desc'] == 'Photograph Fee') $fee_account = 501010117;    		
	    	}
	    	
	    	if($_POST['discount_amount'] != '' && $_POST['discount_amount'] > 0){
	    		$main_arr['payment_amount'] =  $_POST['payment_amount'] - $_POST['discount_amount'];
	    	}
	    	
	    	if($_POST['fee_term'] == '10' || $_POST['fee_term'] == '20'){ // arrears transaction 
	    		$main_arr['batch_id'] = $_POST['batch_id'] - 1;
	    	}
	    	elseif($_POST['fee_term'] == '99'){ // next batch
	    		$main_arr['batch_id'] = $_POST['batch_id'] + 1;
	    	}
	    	
	    	$main_arr['payment_date'] = Util::dateSavingFormat($_POST['payment_date']);
	    	$main_arr['division_id'] = $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	$main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
	    	$main_arr['receipt_number'] = $ref_number = $this->getReceiptNumber($div_id);
	    	
	    	$this->db->insert('student_payments', $main_arr);
	    	if($_POST['payment_mode'] == 'Cash'){
	    		$this->db->where('student_id', $_POST['student_id']);
	    		$this->db->update('students', array('enable_cash_payment'=>'N'));
	    	}
	    	if(ENABLE_FINANCE_MODULE == 1){	
		    	if($_POST['payment_mode'] == 'Cash')
		    	{
		    		$account_id = ($div_id == 1) ? 121010112 : 121010111; // cash in hand account
		    	}
		    	else
		    	{
		    		$account_id = ($div_id == 1) ? 101010114 : 101010111;
		    	}
		    	$narration = $main_arr['fee_desc'] . ' for ' .$_POST['admission_number'];//. ' '. $_POST['student_name'];
		    	$voucher_detail[0] = array ( 'voucher_id'=>'0' ,'ref_number'=>$ref_number, 'vdate'=>$main_arr['payment_date'], 'account_id'=>$account_id, 'narration'=>$narration, 'debit_amount'=>$main_arr['payment_amount'], 'credit_amount'=>'0.00','division_id'=>$div_id, 'payee_id'=>$_POST['student_id'], 'payee_type'=>'Student' );
		    	$voucher_detail[1] = array ( 'voucher_id'=>'0' ,'ref_number'=>$ref_number, 'vdate'=>$main_arr['payment_date'], 'account_id'=>$fee_account, 'narration'=>$narration, 'debit_amount'=>'0.00', 'credit_amount'=>$main_arr['payment_amount'],'division_id'=>$div_id, 'payee_id'=>$_POST['student_id'], 'payee_type'=>'Student' );
		
		    	$this->db->insert_batch('voucher_details',$voucher_detail);
    		}
	    	$this->accounts_posting();
    	}	
    }
    
    function accounts_posting(){
    	if(ENABLE_FINANCE_MODULE == 1){
	    	$query = $this->db->get_where('voucher_details', array('voucher_id'=>0, 'posting'=>'N'));
	    	$res = $query->result();
	    	
	    	if (sizeof($res) > 0){
	    		foreach ($res as $row){
	    			$acc_type = substr($row->account_id, 0, 1);
	    			$bal = $this->get_account_balance($row->account_id, $acc_type);
	    	
	    			$sub_id = substr($row->account_id, 0, 4);
	    			$id     = substr($row->account_id, 4, 5); $str = '';
	    	
	    			if($acc_type == '1'){ // For assets accounts
	    	
	    				if(isset($row->credit_amount) && $row->credit_amount>0) {
	    					$running_balance = $bal - $row->credit_amount;
	    					$str = "debit_balance=debit_balance-".$row->credit_amount;
	    				}
	    				elseif(isset($row->debit_amount) && $row->debit_amount>0) {
	    					$str = "debit_balance=debit_balance+".$row->debit_amount;
	    					$running_balance = $bal+$row->debit_amount;
	    				}
	    			}else{
	    	
	    				if(isset($row->credit_amount) && $row->credit_amount>0) {
	    					$str = "credit_balance=credit_balance+".$row->credit_amount;
	    					$running_balance = $bal+$row->credit_amount;
	    				}
	    				elseif(isset($row->debit_amount) && $row->debit_amount>0) {
	    					$str = "credit_balance=credit_balance-".$row->debit_amount;
	    					$running_balance = $bal-$row->debit_amount;
	    				}
	    			}
	    	
	    			if($str != ''){
	    				$query  = "update accounts set ".$str. " WHERE account_id=".$id." AND sub_account_id=".$sub_id;
	    				//echo $query.'<br/>';
	    				$this->db->query($query);
	    				//echo "update accounts set ".$str. " WHERE posting=0 AND account_id=NULL AND sub_account_id=NULL AND parent_account_id=".substr($sub_id, 0, 2)."<br/>";
	    				//echo "update accounts set ".$str. " WHERE posting=0 AND account_id=NULL AND sub_account_id=".$sub_id."<br/>";
	    	
	    				$this->db->query("update accounts set ".$str. " WHERE posting=0 AND account_id IS NULL AND sub_account_id IS NULL AND parent_account_id=".substr($sub_id, 0, 2));
	    				$this->db->query("update accounts set ".$str. " WHERE posting=0 AND account_id IS NULL AND sub_account_id=".$sub_id);
	    			}
	    	
	    			$this->db->query( "update voucher_details set running_balance=".$running_balance.", posting='Y' WHERE voucher_detail_id=".$row->voucher_detail_id );
	    		}
	    	}
    	}
    }
    
    function accounts_updating(){
		if(ENABLE_FINANCE_MODULE == 1){
	    	//$query = $this->db->get_where('voucher_details', array('voucher_id <>'=>0, 'posting'=>'Y'));
	    	$this->db->order_by('vdate, voucher_detail_id');
	    	$query = $this->db->get_where('voucher_details', array('posting'=>'Y'));
	    	//echo $str = $this->db->last_query();
	    	$res = $query->result(); //die('Count'.sizeof($res));
	    	if (sizeof($res) > 0){
	    		foreach ($res as $row){
	    			$acc_type = substr($row->account_id, 0, 1);
	    			$bal = $this->get_account_balance($row->account_id, $acc_type);
	    			 
	    			$sub_id = substr($row->account_id, 0, 4);
	    			$id     = substr($row->account_id, 4, 5); $str = '';
	    			$running_balance = $bal; 
	    			if($acc_type == '1'){ // For assets accounts
	    				 
	    				if(isset($row->credit_amount) && $row->credit_amount>0) {
	    					$running_balance = $bal - $row->credit_amount;
	    					$str = "debit_balance=debit_balance-".$row->credit_amount;
	    				}
	    				elseif(isset($row->debit_amount) && $row->debit_amount>0) {
	    					$str = "debit_balance=debit_balance+".$row->debit_amount;
	    					$running_balance = $bal+$row->debit_amount;
	    				}
	    			}else{
	    				 
	    				if(isset($row->credit_amount) && $row->credit_amount>0) {
	    					$str = "credit_balance=credit_balance+".$row->credit_amount;
	    					$running_balance = $bal+$row->credit_amount;
	    				}
	    				elseif(isset($row->debit_amount) && $row->debit_amount>0) {
	    					$str = "credit_balance=credit_balance-".$row->debit_amount;
	    					$running_balance = $bal-$row->debit_amount;
	    				}
	    			}
	    			 
	    			if($str != ''){
	    				$query  = "update accounts set ".$str. " WHERE account_id=".$id." AND sub_account_id=".$sub_id;
	    				$this->db->query($query);
	    				
	    				$this->db->query("update accounts set ".$str. " WHERE posting=0 AND account_id IS NULL AND sub_account_id IS NULL AND parent_account_id=".substr($sub_id, 0, 2));
	    				$this->db->query("update accounts set ".$str. " WHERE posting=0 AND account_id IS NULL AND sub_account_id=".$sub_id);
	    			}
	    			 
	    			//$this->db->query( "update voucher_details set running_balance=".$running_balance.", posting='Y' WHERE voucher_detail_id=".$row->voucher_detail_id );
	    			$this->db->query( "update voucher_details set running_balance=".$running_balance." WHERE voucher_detail_id=".$row->voucher_detail_id );
	    		}
	    	}
		}
    }
    
    function get_account_balance($ac, $type = 1){
    	if(ENABLE_FINANCE_MODULE == 1){
	    	$field = ($type == 1) ? 'debit_balance' : 'credit_balance';
	    	$where_clause = "WHERE sub_account_id = SUBSTRING(".$ac.", 1, 4) and account_id = SUBSTRING(".$ac.", 5, 9) ";
	    	$query = "SELECT $field as bal from accounts ".$where_clause. "";
	    
	    	$query = $this->db->query($query);
	    	$result = $query->result();
	    	if(isset($result[0])){
	    		return $result[0]->bal;
	    	}
    	}
    	return '0.00';
    }
    
    function getReceiptNumber($division_id){
    	$query  = $this->db->query("select max(receipt_number) as id from student_payments where payment_amount>0 and division_id='$division_id'");
    	$result = $query->result();
    	$max_num = $result[0]->id + 1;
    	return Util::leading_zeros($max_num, 5);
    }
	
    function set_attendance(){
    	$att_arr = array ('student_id', 'attendance_comment', 'attendance_date');
    	$main_arr = array();
    	foreach ($att_arr as $index)
    	{
    		$main_arr[$index] = $_POST[$index];
    	}
    	 
    	$this->db->insert('student_attendance', $main_arr);
    }
    
   	function get_attendance($id, $month){
    	
   		$this->db->where('student_id', $id);
   		$this->db->like("attendance_date", $month);
   		$query = $this->db->get('student_attendance');
   		//echo $str = $this->db->last_query();
   		return $query->result();
    }
    
    function get_attached_file($id){
    	$query = $this->db->get_where('upload_file_log',array("upload_file_log_id" => $id));
    	$res = $query->result();
    	return (isset($res[0])) ? $res[0] : null; 
    	//return $query->result();
    }
    
    function get_student_files($id){
    	$query = $this->db->get_where('upload_file_log',array("form_log_id" => $id, 'form_type'=>'Student'));
    	return $query->result();
    }
    
	function update()
    {
    	$student_id  = $_POST['student_id'];
    	
    	if(isset($_POST['admission_term']) && $_POST['admission_term_old'] != $_POST['admission_term']){
    		$term = substr($_POST['admission_term'], -1);
    		$batch_id = $_POST['batch_id'];
    		$super_admin = $this->session->userdata(SESSION_CONST_PRE.'super_admin');
    		if($super_admin == 'Y')
    		{
    			//$this->update_tution_fee($student_id, $term, $batch_id);
    		}
    		else{
    			$_POST['admission_term'] = $_POST['admission_term_old'];
    		}
    	}
    	
    	$emp_arr = array ('student_name', 'student_name_ar','father_name', 'gender', 'date_of_birth', 'birth_place', 'blood_group', 'nationality',
    					  'emergency_contact', 'emergency_contact_relation', 'emergency_contact_name',
  						  'city',  'state',  'address_line1',  'address_line2', 'language',  'category',
        				  'religion',  'email', 'admission_number', 'admission_date','iqama_id', 'passport_expiry', 'issue_date','iqama_expiry', 'passport_id', 
        				  'course_id', 'batch_id', 'section', 'sibling_student_id', 'discount_on_employee_kid', 'cell_phone_father', 'email_father', 
						  'transport_type', 'admission_term', 'transport_term', 'previous_school', 'previous_school_ar', 'enrollment_grade_level', 'remarks');
    	$main_arr = array();
    	foreach ($emp_arr as $index)
    	{
    		if(isset( $_POST[$index]))
    		$main_arr[$index] = $_POST[$index];
    	}
		
		if(isset( $_POST['nationality'])){
			$main_arr['country_id'] = $_POST['nationality'];
		}
    	$main_arr['check_list'] = '';
    	$check_list = '';
    	for($a=1;$a<=12;$a++){
    		if(isset($_POST['option'.$a]) && $_POST['option'.$a] == 'on'){
    			$check_list .= ','.$a;
    		}
    	}
    	if($check_list != ''){
    		$main_arr['check_list'] =	substr($check_list, 1);
    	}
    	
    	if(isset($_POST['skip_validate']) && $_POST['skip_validate'] == 'on'){
    		$main_arr['skip_validate'] = 'Y';
    		$main_arr['skip_validate_note'] = $_POST['skip_validate_note'];
    	}
    	
    	if(ENABLE_FEE_MODULE == 1){
	    	
    		if(isset($_POST['sibling_check']) && $_POST['sibling_check'] == 'Y'){
		    	if(isset($_POST['sibling']) && $_POST['sibling'] == 'on'){
		    		$main_arr['sibling'] = 'Yes';
		    		$this->insert_sibling_discount();
		    		
		    		$this->db->where('admission_number', $_POST['sibling_student_id']);
		    		$this->db->update('students', array('used_as_sibling'=>'1'));
		    	}
		    	else {
		    		$main_arr['sibling'] = 'No';
		    		$this->delete_sibling_discount();
		    		 
		    		$this->db->where('admission_number', $_POST['sibling_student_id']);
		    		$this->db->update('students', array('used_as_sibling'=>'0'));
		    	}
	    		
	    	}
	    	
    		$main_arr['employee_kid'] = (isset($_POST['employee_kid']) && $_POST['employee_kid'] == 'on') ? 'Yes':'No';
    		if(isset($_POST['employee_kid_check']) && $_POST['employee_kid_check'] != $main_arr['employee_kid']){
	    		//die($_POST['employee_kid_check'].' & '.$main_arr['employee_kid']);
	    		if($main_arr['employee_kid'] == 'Yes'){
	    			$this->insert_employee_son_discount();
	    		}
	    		else {
	    			$this->delete_employee_son_discount();
	    		}
	    	}
	    	
	    	//$main_arr['transportation'] = (isset($_POST['transportation']) && $_POST['transportation'] == 'on') ? 'Yes':'No';
	    	$main_arr['enable_cash_payment'] = (isset($_POST['enable_cash_payment']) && $_POST['enable_cash_payment'] == 'on') ? 'Y':'N';
	    	$main_arr['transportation'] = 'No';
	    	
	    	if(isset($_POST['transportation']) && $_POST['transportation'] == 'on'){
	    		$main_arr['transportation'] = 'Yes';
	    		if(isset($_POST['transport_type']) && $_POST['transport_type'] != ''){
	    			$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    			$div = ($div_id == '1') ? 'FB' : 'FG';
	    			$transport_fee_type = $_POST['transport_type'].'_'.$div;
	    			$fee_amount = $this->get_transportation_amount($_POST['course_id'], $transport_fee_type);
	    			
	    			if(isset($_POST['transport_term']) && $_POST['transport_term'] != '0') {
	    				$fee_amount = $fee_amount/2;
	    			}
	    			$this->update_fee_transaction('Transportation Fee', $student_id, $_POST['batch_id'], $fee_amount);
	    		}
	    	}
	    	else{
	    		$this->update_fee_transaction('Transportation Fee', $student_id, $_POST['batch_id'], '0');
	    	}
			$month = $_POST['admission_term'];
			$this->update_monthly_subjects($student_id, $_POST['batch_id'], $_POST['course_id'], $month);
    	}
    	//if(isset($_POST['study_continue'])) $main_arr['study_continue'] = ($_POST['study_continue'] == 'on') ? 'Y' : 'N';
		//$main_arr['month'] = $_POST['admission_term'];
    	$this->db->where('student_id', $student_id);
    	$this->db->update('students', $main_arr);
    	return $student_id;
    	//echo $this->db->last_query();
    }
    
    function update_fee_transaction($fee_desc, $student_id, $session, $amount){
    	
    	$query  = $this->db->query("SELECT payment_id as id FROM student_payments where mark_delete='0' and fee_desc='$fee_desc' and payment_amount = '0.00' and batch_id=$session and student_id=$student_id");
    	$result = $query->result();
    	
    	if(isset($result[0])){
    		$id = $result[0]->id;
    		$this->db->where('payment_id', $id);
    		$this->db->update('student_payments', array('due_amount'=>$amount));
    	}
    	else{
    		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
    		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
    		$payment_arr = array('student_id'=>$student_id, 'batch_id'=>$session, 'division_id'=>$div_id, 'due_amount'=>$amount, 'due_date'=>date('Y-m-d'), 'fee_desc'=>$fee_desc, 'user_id'=>$user_id);
    		$this->db->insert('student_payments', $payment_arr);
    	}
    }
    
    function get_first_term_fee_amount($course_id){
    	$amount = $this->get_transportation_amount($course_id, 'FIRST_TERM_DNS');
    	return $amount;
    }
    
    function get_transportation_amount($course_id, $fee_column){
    	$query  = $this->db->query("SELECT * FROM courses where course_id=$course_id");
    	$result = $query->result();
    	if(isset($result[0])){
    		return $result[0]->$fee_column;
    	}
    	else {
    		return 0;
    	} 
    		
    }
    
	function insert_guarantee_cheque(){
		if(ENABLE_FEE_MODULE == 1){
			$main_arr['student_id'] = $_POST['student_id'];
			$main_arr['fee_desc'] = 'Tuition Fee';
			$main_arr['mark_delete'] = '3'; // for guarantee cheque
			$main_arr['batch_id'] = $_POST['batch_id'];
			$main_arr['payment_amount'] = $main_arr['cheque_amount'] = $_POST['cheque_amount'];
			$main_arr['card_number'] = $_POST['card_number'];
			$main_arr['payment_mode'] = 'Cheque';
			$main_arr['payment_date'] = $main_arr['cheque_date'] = Util::dateSavingFormat($_POST['cheque_date']);
			$main_arr['cheque_present_date'] = Util::dateSavingFormat($_POST['cheque_present_date']);
			$main_arr['division_id'] = $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			$main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
			$main_arr['comments'] = $_POST['remarks']. ' Chq #: '.$_POST['card_number'];
			$this->db->insert('student_payments', $main_arr);
		}
	}
	
	function insert_discount(){
		if(ENABLE_FEE_MODULE == 1){
			$where['student_id'] = $_POST['student_id'];
			$where['payment_amount'] = '0.00';
			$where['fee_desc'] = 'Tuition Fee';
			$where['batch_id'] = $_POST['batch_id'];
			$where['fee_term'] = '0';
			$where['division_id'] = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			
			$main_arr['discount_amount'] = $_POST['discount_amount'];
			$main_arr['updated_at'] = date('Y-m-d h:i'); //CURRENT_TIMESTAMP
			$main_arr['updated_by'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
			$main_arr['comments'] = $_POST['remarks'];
			
			$this->db->where($where);
			$this->db->update('student_payments', $main_arr);
			//echo $str = $this->db->last_query();
		}	
	}
	
	function insert_sibling_discount(){
		if(ENABLE_FEE_MODULE == 1){	
			$where['student_id'] = $_POST['student_id'];
			$where['payment_amount'] = '0.00';
			$where['fee_desc'] = 'Tuition Fee';
			$where['batch_id'] = $_POST['batch_id'];
			$where['fee_term'] = '0';
			$where['division_id'] = $d = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			
			$this->db->where($where);
			$query = $this->db->get('student_payments', $where);
			$result = $query->result();
			$tuition_fee = 0;
			if(isset($result[0])){
				$tuition_fee = $result[0]->due_amount;
			}
			
			$main_arr['student_id'] = $_POST['student_id'];
			$main_arr['payment_amount'] = '0.00';
			$main_arr['fee_desc'] = 'Tuition Fee';
			$main_arr['batch_id'] = $_POST['batch_id'];
			$main_arr['division_id'] = $d;
			$main_arr['fee_term'] = $d.'0';
			$main_arr['discount_amount'] = $tuition_fee * (0.10);
			$main_arr['updated_at'] = date('Y-m-d h:i'); //CURRENT_TIMESTAMP
			$main_arr['updated_by'] = $main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
			$main_arr['comments'] = 'Sibling discount 10%';
		
			$this->db->insert('student_payments', $main_arr);
			//echo $str = $this->db->last_query();
		}	
	}
	
	function delete_sibling_discount(){
		if(ENABLE_FEE_MODULE == 1){
			$where['student_id'] = $_POST['student_id'];
			$where['payment_amount'] = '0.00';
			$where['fee_desc'] = 'Tuition Fee';
			$where['batch_id'] = $_POST['batch_id'];
			$where['division_id'] = $d = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			$where['fee_term'] = $d.'0';
			
			
			$this->db->where($where);
			$this->db->delete('student_payments');
		}
	}
	
	function insert_employee_son_discount(){
		if(ENABLE_FEE_MODULE == 1){
			$where['student_id'] = $_POST['student_id'];
			$where['payment_amount'] = '0.00';
			$where['fee_desc'] = 'Tuition Fee';
			$where['batch_id'] = $_POST['batch_id'];
			$where['fee_term'] = '0';
			$where['division_id'] = $d = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		
			$this->db->where($where);
			$query = $this->db->get('student_payments', $where);
			$result = $query->result();
			$tuition_fee = 0;
			if(isset($result[0])){
				$tuition_fee = $result[0]->due_amount;
			}
		
			$main_arr['student_id'] = $_POST['student_id'];
			$main_arr['payment_amount'] = '0.00';
			$main_arr['fee_desc'] = 'Tuition Fee';
			$main_arr['batch_id'] = $_POST['batch_id'];
			$main_arr['division_id'] = $d;
			$main_arr['fee_term'] = $d;
			$main_arr['discount_amount'] = $tuition_fee * ($_POST['discount_on_employee_kid']/100);
			$main_arr['updated_at'] = date('Y-m-d h:i'); //CURRENT_TIMESTAMP
			$main_arr['updated_by'] = $main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
			$main_arr['comments'] = 'Employee Son Discount';
		
			$this->db->insert('student_payments', $main_arr);
			//echo $str = $this->db->last_query();
		}
	}
	
	function delete_employee_son_discount(){
		if(ENABLE_FEE_MODULE == 1){
			$where['student_id'] = $_POST['student_id'];
			$where['payment_amount'] = '0.00';
			$where['fee_desc'] = 'Tuition Fee';
			$where['batch_id'] = $_POST['batch_id'];
			$where['division_id'] = $d = $this->session->userdata(SESSION_CONST_PRE.'division_id');
			$where['fee_term'] = $d;
		
			$this->db->where($where);
			$this->db->delete('student_payments');
		}
	}
	
    function insert_parent_data(){
    	$this->db->insert('student_guardian', $_POST);
    	//echo $str = $this->db->last_query();
    }
    
    function update_parent_data(){
    	$id  = $_POST['id'];
    	unset($_POST['id']);
    	$this->db->where('student_guardian_id', $id);
    	$this->db->update('student_guardian', $_POST);
    	//echo $str = $this->db->last_query();
    }
    
    function insert_previous_data(){
    	$emp_arr = array ('student_id', 'institute', 'year','course', 'total_marks');
    	$main_arr = array();
    	foreach ($emp_arr as $index)
    	{
    		if(isset( $_POST[$index]))
    			$main_arr[$index] = $_POST[$index];
    	}
    	 
    	$this->db->insert('student_previous_data', $main_arr);
    	if(isset($_POST['institute']) && !empty($_POST['institute'])){
    		$this->db->where('student_id', $_POST['student_id']);
    		$this->db->update('students', array('previous_school'=> $_POST['institute']));
    	}
    }
    
    function update_previous_data(){
    	$emp_arr = array ('institute', 'year','course', 'total_marks');
    	$main_arr = array();
    	foreach ($emp_arr as $index)
    	{
    		$main_arr[$index] = $_POST[$index];
    	}
    	$id  = $_POST['id'];
    	$this->db->where('id', $id);
    	$this->db->update('student_previous_data', $main_arr);
    	if(isset($_POST['institute']) && !empty($_POST['institute'])){
    		$this->db->where('student_id', $_POST['student_id']);
    		$this->db->update('students', array('previous_school'=> $_POST['institute']));
    	}
    }
    
	function update_image_path($file)
    {
    	$student_id  = $_POST['student_id'];
    	$main_arr = array('student_image'=>$file);
    	$this->db->where('student_id', $student_id);
    	$this->db->update('students', $main_arr);
    }
    
    function update_transaction(){
    	if(ENABLE_FEE_MODULE == 1){
	    	$payment_id  = $_POST['id'];
	    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
	    	$comments = addslashes($_POST['holding_comments']); 
	    	$this->db->where('receipt_number', $payment_id);
	    	$this->db->update('student_payments', array('mark_delete'=>'2', 'holding_by'=>$user_id ,'holding_comments'=>$comments));
	    	if($_POST['fee_desc'] == 'Tuition Fee'){
	    		$this->db->query("update students set payment_count_for_current_session=payment_count_for_current_session-1 where student_id=".$_POST['student_id']);
	    	}
    	}
    }
    
    /*
     * Function:  delete_transaction
     * Purpose:   to update the hold transactions 
     * 			  and update mark_delete value 9
     * 		      and delete all financial effects like voucher_detail and accouts entry of this trans
     * Dated:     03-MAY-2016 03:37 PM
     * Created by: IMRAN SALEEM
     */
    
    function delete_transaction($payment_id){
    	if(ENABLE_FINANCE_MODULE == 1){
	    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
	    	$date = date('Y-m-d H:m');
	    	$this->db->where('payment_id', $payment_id);
	    	$this->db->update('student_payments', array('mark_delete'=>"9", 'updated_by'=>$user_id ,'updated_at'=>$date));
    	}
    	
	    if(ENABLE_FINANCE_MODULE == 1){	
	    	$result = $this->get_voucher_detail($payment_id);
	    	foreach ($result as $row){
	    		$acc_type = substr($row->account_id, 0, 1);
	    		$bal = $this->get_account_balance($row->account_id, $acc_type);
	    		 
	    		$sub_id = substr($row->account_id, 0, 4);
	    		$id     = substr($row->account_id, 4, 5);
	    		
	    		$str = ""; $amount = 0;
	    		if(isset($row->credit_amount) && $row->credit_amount>0) {
	    			$amount = $row->credit_amount;
	    			$str = "credit_balance=credit_balance-".$row->credit_amount;
	    			$running_balance = 'credit_amount=credit_amount-'.$row->credit_amount.', running_balance=running_balance-'.$row->credit_amount.', ';
	    		}
	    		elseif(isset($row->debit_amount) && $row->debit_amount>0) {
	    			$amount = $row->debit_amount;
	    			$str = "debit_balance=debit_balance-".$row->debit_amount;
	    			$running_balance = 'debit_amount=debit_amount-'.$row->debit_amount.', running_balance=running_balance-'.$row->debit_amount.', ';
	    		}
	    	
	    	 	if($str != ''){
		    		$query  = "update accounts set ".$str. " WHERE account_id=".$id." AND sub_account_id=".$sub_id;
		    		//echo $query.'<br/>';
		    		$this->db->query($query);
		    		 
		    		$this->db->query("update accounts set ".$str. " WHERE posting=0 AND account_id IS NULL AND sub_account_id IS NULL AND parent_account_id=".substr($sub_id, 0, 2));
		    		$this->db->query("update accounts set ".$str. " WHERE posting=0 AND account_id IS NULL AND sub_account_id=".$sub_id);
		    	}
		    	 
		    	$this->db->query( "update voucher_details set  ".$running_balance." posting='Y', narration=CONCAT(narration, '<br/>Hold Entry Deleted & amount was ', $amount)  WHERE voucher_detail_id=".$row->voucher_detail_id );
	    	}
    	}
    }
    
    function get_voucher_detail($payment_id){
    	if(ENABLE_FEE_MODULE == 1 && ENABLE_FINANCE_MODULE == 1){
	    	$this->db->select('sp.payment_id, vd.*');
	    	$this->db->from('student_payments sp');
	    	$this->db->join('voucher_details vd', 'sp.receipt_number = vd.ref_number');
	    	$query = $this->db->get_where('',array("sp.payment_id" => $payment_id));
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
    	}
    	return NULL;
    }
    /* FUNCTION: 	get_all_hold_entries
     * Description:
     * All hold entries from student_payments 
     * after posting in the finance module
     * Now it is automatied from the front view 
     * super admin can delete it from student sceen. 
     * it also affect the finance module.
     * DATED: 		04-05-2016
     */
    function get_all_hold_entries(){
    	if(ENABLE_FEE_MODULE == 1){
	    	$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	//SELECT * FROM `student_payments` WHERE `mark_delete` = '2' AND `holding_by` <> '0' AND `division_id` = '2' AND `created_date` > '2016-02-10 22:54:36'
	    	$this->db->select('sp.payment_id, sp.fee_desc, sp.payment_amount, sp.payment_mode, s.student_name, s.admission_number, s.course_id, s.batch_id');
	    	$this->db->from('student_payments sp');
	    	$this->db->join('students s', 'sp.student_id = s.student_id');
	    	$query = $this->db->get_where('',array('mark_delete'=>'2',"holding_by <>" => '0', 'sp.division_id'=>$div_id, 'created_date >'=>'2016-02-10 22:54:36'));
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
    	}	
    }
    
    function get_students_fee_paid_detail($student_id, $batch_id, $payment_id=''){
    	if(ENABLE_FEE_MODULE == 1){
	    	$this->db->select('*, sum(payment_amount) as total_payment, sum(discount_amount) as total_discount, TIMEDIFF(NOW(),created_date) as diff', FALSE);
	    	$this->db->order_by('created_date', 'desc');
	    	$session_start = $this->session->userdata(SESSION_CONST_PRE.'session_start');
	    	$this->db->where('payment_date >=', $session_start); // 'batch_id >='=>$batch_id-1, remove this condition
	    	if($payment_id != '') { $this->db->where('payment_id', $payment_id); }
	    	//$this->db->where('mark_delete', '0');
	    	$this->db->where(array('student_id'=>$student_id, 'batch_id'=>$batch_id, 'payment_amount >'=>'0'));
			$this->db->group_by('receipt_number');
	    	//$this->db->or_where(array('discount_amount >'=>'0', 'fee_desc'=>'Tuition Fee'));
	    	$query = $this->db->get('student_payments');
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
    	}
    	return NULL;
    }
    
    function get_students_last_payment_with_one_cheque($student_id, $batch_id){
		if(ENABLE_FEE_MODULE == 1){
	    	$this->db->limit('1');
	    	$this->db->order_by('created_date', 'desc');
	    	$this->db->where('mark_delete', '0');
	    	$query = $this->db->get_where('student_payments', array('student_id'=>$student_id, 'batch_id'=>$batch_id, 'payment_amount >'=>'0', 'garantee_cheque1 !='=>''));
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
		}
		return NULL;
    }
    
	function get_students_monthly_pending_fee($student_id, $batch_id, $month,$active=0){
    	if(ENABLE_FEE_MODULE == 1){
			$sql ="SELECT 
	    	sum(student_payments.due_amount) as due_total,
	    	sum(student_payments.payment_amount) AS total_payment,
	    	sum(student_payments.discount_amount) AS total_discount,
	    	count(fee_desc) as fee_count
	    	FROM student_payments
	    	WHERE  
	    	 	mark_delete='".$active."' and month=$month and batch_id IN( $batch_id ) AND student_id='".$student_id."' 
	    	group by fee_desc order by payment_id";
	    	$query = $this->db->query($sql);
	    	
	    	return $query->row();
    	}
    	return NULL;
    }
	
    function get_students_fee_pending_detail($student_id, $batch_id, $active=0){
    	if(ENABLE_FEE_MODULE == 1){
	    	$sql ="SELECT students.student_id, students.student_name,
	    	student_payments.batch_id, student_payments.payment_id as id, 
	    	sum(student_payments.due_amount) as due_total,
	    	student_payments.due_date, student_payments.fee_desc,
	    	sum(student_payments.payment_amount) AS total_payment,
	    	sum(student_payments.discount_amount) AS total_discount,
	    	garantee_cheque1, cheque_amount1, cheque_date1, 
	    	garantee_cheque2, cheque_amount2, cheque_date2, 
	    	garantee_cheque3, cheque_amount3, cheque_date3, count(fee_desc) as fee_count
	    	FROM
	    	students
	    	Left Join student_payments ON students.student_id =  student_payments.student_id 
	    	WHERE  
	    	 	student_payments.mark_delete='".$active."' and student_payments.batch_id IN( $batch_id ) AND students.student_id='".$student_id."' 
	    	group by fee_desc order by payment_id";
	    	$query = $this->db->query($sql);
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
    	}
    	return NULL;
    }
    
    function get_students_outstanding_details($student_id, $batch_id){
    	if(ENABLE_FEE_MODULE == 1){
	    	$back = $batch_id - 1;
	    	$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	 
	    	$where = " AND student_payments.batch_id=$back";
	    	if($div_id == 2) $where = " AND student_payments.batch_id < $batch_id";
	    	
	    	$sql = "SELECT students.student_id, students.student_name, students.admission_number,
		    	student_payments.batch_id, 
		    	student_payments.payment_id as id,
		    	student_payments.due_amount,
		    	student_payments.due_date, student_payments.fee_desc,
		    	student_payments.payment_amount, student_payments.discount_amount
		    	FROM students 
		    	Left Join student_payments ON students.student_id =  student_payments.student_id
		    	WHERE
	    			student_payments.mark_delete='0' and
	        		students.student_id='".$student_id."' $where
		    	order by id ";
	    	$query = $this->db->query($sql);
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
    	}	
    }
    
    function get_students_vouchers($id, $batch_id){
    	if(ENABLE_FINANCE_MODULE == 1){
	    	$sql = "SELECT * FROM vouchers 
	    			WHERE payee='".$id."' AND payee_type='Student' AND posting='Y' 
	    			AND batch_id=$batch_id 
	    			order by voucher_id";
	    	$query = $this->db->query($sql);
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
    	}
    	return NULL;
    }
    
    function get_student_transactions($student_id, $batch_id, $fee='Tuition Fee', $active=0){
    	if(ENABLE_FEE_MODULE == 1){
    		$sql = "SELECT payment_id as id, (student_payments.due_amount) as due_total,
    				(student_payments.payment_amount) AS total_payment,
    				(student_payments.discount_amount) AS total_discount, fee_term, fee_desc
    	    	FROM student_payments
		    	WHERE student_payments.mark_delete='".$active."' and student_payments.batch_id IN( $batch_id ) 
		    	AND student_id='".$student_id."' AND fee_desc='$fee'
		    	order by payment_id";
    		$query = $this->db->query($sql);
    		//echo $str = $this->db->last_query();
    		return $query->result();
    	}
    	return NULL;
    }
    
    function get_students_outstandings($student_id, $batch_id, $active = 0){
    	if(ENABLE_FEE_MODULE == 1){
	    	$back = $batch_id - 1;
	    	$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	
			$where = " AND student_payments.batch_id=$back";
	    	if($div_id == 2) $where = " AND student_payments.batch_id < $batch_id";
	    	
	    	$sql ="SELECT students.student_id, students.student_name, students.admission_number,
	    	student_payments.batch_id, student_payments.payment_id as id,
	    	sum(student_payments.due_amount) as due_total,
	    	student_payments.due_date, student_payments.fee_desc,
	    	sum(student_payments.payment_amount) AS total_payment,
	    	sum(student_payments.discount_amount) AS total_discount,
	    	count(student_payments.payment_id) as row_count
	    	FROM students
	    	Join student_payments ON students.student_id =  student_payments.student_id
	    	WHERE student_payments.mark_delete='".$active."' and
	    	students.student_id='".$student_id."' $where
	    	group by student_payments.student_id order by batch_id";
	    	$query = $this->db->query($sql);
	    	//echo $str = $this->db->last_query();
	    	return $query->result();
    	}
    	return NULL;
    }
    
    function update_outstanding_data(){
    	if(ENABLE_FEE_MODULE == 1){
	    	$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
	    	$dt = date('Y-m-d');
	    	if($div_id == 2){ // DIS Options
		    	if(isset($_POST['due_amount1']) && $_POST['due_amount1'] > 0){
			    	$this->db->where('payment_id', $_POST['id']);
			    	$this->db->update('student_payments', array('due_amount'=>$_POST['due_amount1']));
		    	}
		    	
	    		if(isset($_POST['due_amount2']) && $_POST['due_amount2'] > 0){
	    			$this->db->where(array('student_id'=>$_POST['student_id'], 'batch_id'=>$_POST['batch_id']-2, 'fee_desc'=>'Tuition Fee'));
	    			$this->db->delete('student_payments');
	    			
		    		$main_arr = array('student_id'=>$_POST['student_id'], 'fee_desc'=>'Tuition Fee', 'due_amount'=>$_POST['due_amount2'], 'due_date'=>$dt, 'batch_id'=>$_POST['batch_id']-2);
		    		$main_arr ['division_id'] = $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		    		$main_arr ['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
		    		$this->db->insert('student_payments', $main_arr);
	    		}
	    		if(isset($_POST['due_amount3']) && $_POST['due_amount3'] > 0){
	    			$this->db->where(array('student_id'=>$_POST['student_id'], 'batch_id'=>$_POST['batch_id']-3, 'fee_desc'=>'Tuition Fee'));
	    			$this->db->delete('student_payments');
	    			
		    		$main_arr1 = array('student_id'=>$_POST['student_id'], 'fee_desc'=>'Tuition Fee', 'due_amount'=>$_POST['due_amount3'], 'due_date'=>$dt, 'batch_id'=>$_POST['batch_id']-3);
		    		$main_arr1 ['division_id'] = $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		    		$main_arr1 ['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
		    		$this->db->insert('student_payments', $main_arr1);
	    		}
		    	
	    	}else {
	    		
	    		if(isset($_POST['due_amount1']) && $_POST['due_amount1'] > 0){
			    	$this->db->where('payment_id', $_POST['id']);
			    	$this->db->update('student_payments', array('due_amount'=>$_POST['due_amount1']));
		    	}	    	
	    		if(isset($_POST['due_amount2']) && $_POST['due_amount2'] > 0){
	    			
	    			$this->db->where(array('student_id'=>$_POST['student_id'], 'batch_id'=>$_POST['batch_id']-1, 'fee_desc'=>'Transportation Fee'));
	    			$this->db->delete('student_payments');
	    			
		    		$main_arr = array('student_id'=>$_POST['student_id'], 'fee_desc'=>'Transportation Fee', 'due_amount'=>$_POST['due_amount2'], 'due_date'=>$dt, 'batch_id'=>$_POST['batch_id']-1);
		    		$main_arr['division_id'] = $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		    		$main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
		    		$this->db->insert('student_payments', $main_arr);
	    		}
	    		if(isset($_POST['due_amount3']) && $_POST['due_amount3'] > 0){
	    			$this->db->where(array('student_id'=>$_POST['student_id'], 'batch_id'=>$_POST['batch_id']-1, 'fee_desc'=>'Education Plus Fee'));
	    			$this->db->delete('student_payments');
	    			
	    			$main_arr = array('student_id'=>$_POST['student_id'], 'fee_desc'=>'Education Plus Fee', 'due_amount'=>$_POST['due_amount3'], 'due_date'=>$dt, 'batch_id'=>$_POST['batch_id']-1);
		    		$main_arr['division_id'] = $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		    		$main_arr['user_id'] = $this->session->userdata(SESSION_CONST_PRE.'userId');
		    		$this->db->insert('student_payments', $main_arr);
	    		}	    	
	    	}	
	    	//echo $str = $this->db->last_query();
	    	//print_r($_POST['fee_desc']);
    	}	
    }
    
    private function permote_all_students(){
    	//put the outstanding fee as 0 for all student in previous session 6 is previous session
    	$sql =  "INSERT INTO student_payments (fee_desc, due_date, student_id ,due_amount , user_id, division_id, batch_id)
		 		(Select 'Tuition Fee','2016-07-18', student_id , '0.00', 11781, 1, 6  from students )";
    	// permote all students to next grade and next session also need to create new session in the batches table
    	$sql =  "UPDATE students SET course_id=course_id+1, batch_id=batch_id+1 where batch=7";
    	//put the tution fee for all student of current session after permote 7 is showin the current session
    	$sql =  "INSERT INTO student_payments (fee_desc, due_date, student_id ,due_amount , user_id, division_id, batch_id)
			         (Select  'Tuition Fee','2016-07-18', student_id ,FEE_PER_YEAR_DIS, 11781, division_id, 8
			         from students join courses on students.course_id = courses.course_id where division_id = 2 and cdel=0);";
    	//$this->db->query($sql);
    }
    
    function add_trem_fee(){
    	$curr_date = date('m-d');
    	if(in_array($curr_date, array('08-22', '11-22', '02-22', '05-22'))){ // DIS Cron Process
 	   	$sql =  "INSERT INTO student_payments (fee_desc, due_date, student_id ,due_amount , user_id, division_id, batch_id)
			         (Select  'Tuition Fee', NOW(), student_id ,FEE_PER_YEAR_DIS/4, 11781, 2, 7
			         from students join courses on students.course_id = courses.course_id where division_id = 2 and cdel=0);";
 	   		$this->db->query($sql);
    	}
    	if(in_array($curr_date, array('08-22', '02-22'))){ // DNS Cron Process
    		if($curr_date == '08-22'){
 	   		$sql =  "INSERT INTO student_payments (fee_desc, due_date, student_id ,due_amount , user_id, division_id, batch_id)
			         (Select  'Tuition Fee', NOW(), student_id ,FIRST_TERM_DNS, 11781, 1, 7
			         from students join courses on students.course_id = courses.course_id where division_id = 1 and cdel=0);";
    		}
    		else{
    			$sql =  "INSERT INTO student_payments (fee_desc, due_date, student_id ,due_amount , user_id, division_id, batch_id)
			         (Select  'Tuition Fee', NOW(), student_id ,FEE_PER_YEAR_DNS-FIRST_TERM_DNS, 11781, 1, 7
			         from students join courses on students.course_id = courses.course_id where division_id = 1 and cdel=0);";
    		}
    		$this->db->query($sql);
    	}
    	return true;
    }
    
    function delete($student_list)
    {
    	$student_arr = explode(",", $student_list);
    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
    	foreach ($student_arr as $student_id)
    	{
    		
	    	$this->db->where('student_id', $student_id);
	        $this->db->update('students', array('cdel'=>'1', 'cdel_by'=>$user_id));
	        if(ENABLE_FEE_MODULE == 1){
		        $this->db->where('student_id', $student_id);
		        $this->db->update('student_payments', array('mark_delete'=>'1'));
	        }
    	}
    }
    
    function activate_student($student_id)
    {
    	$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
    	if($student_id >0){
    		$this->db->where('student_id', $student_id);
    		$this->db->update('students', array('cdel'=>'0', 'cdel_by'=>$user_id));
    		
    		$this->db->where(array('student_id'=>$student_id, 'mark_delete'=>'1'));
    		$this->db->update('student_payments', array('mark_delete'=>'0'));
    	}
    }
    
    function outstanding_update(){
    	$sql =  "INSERT INTO student_payments (fee_desc, due_date, student_id ,due_amount , user_id, division_id, batch_id, mark_delete)
			     (Select 'Tuition Fee', NOW(), students.student_id, outstandings_fee.fee_amount, 11803, 2, outstandings_fee.batch_id, students.cdel from students JOIN outstandings_fee on students.admission_number=outstandings_fee.admission_number );";
    	
    	$this->db->query($sql);
    }
	
	function get_fee_per_subject($course_id){
		$division_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		//$fee_column = ($division_id == 1) ? 'FEE_PER_YEAR_DIS' : 'FEE_PER_YEAR_DNS'; 
	    $fee_amount = 0;
		$query = $this->db->query("Select FEE_PER_YEAR_DNS as due_fee from courses where course_id=$course_id AND is_active='Y'");
	    $result = $query->result();
		if( isset($result[0]) ){
			$fee_amount = $result[0]->due_fee;
		}
		return $fee_amount;
	}
	
	function insert_student_subjects_monthly(){
		$batch_id = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		
		$this->db->select("*")->from("students");
		$this->db->where(array('batch_id'=> $batch_id));
		$this->db->order_by('student_id');
		$query = $this->db->get();
		$result = $query->result();
		$month = 10;//date('m');
		$subject_fee = $c = 0; $student_payments = $receipt = array();
		foreach ($result as $row) {
			
			if($c != $row->course_id){
				$subject_fee = $this->get_fee_per_subject($row->course_id);
				$c = $row->course_id;
			}
			$record1 = array('student_id'=>$row->student_id, 'due_date'=>$row->admission_date, 'batch_id'=>$row->batch_id, 'division_id'=>$row->division_id, 'fee_desc'=>'Tuition Fee', 'user_id'=>'99100');
			$record = array('student_id'=>$row->student_id, 'batch_id'=>$row->batch_id, 'month'=>$month);
			//$this->db->insert('student_subject_monthly', $order);
			//$order_id = $this->db->insert_id();
			$sub_arr = array('Eng'=>4, 'Bio'=>16,'Bio.'=>16, 'Phy'=>17, 'Chem'=>15, 'Che'=>15,	'Math'=>11, 'Comp'=>22 ,'Urdu'=>23, 'Ist'=>1, 'Ss'=>19);
			$sub_count = 0;
			for($s = 1; $s <= 8; $s++){
				$field = 'sub'.$s;
				if($row->$field != '') { $sub_count++;
					$index=ucfirst(strtolower(trim($row->$field)));
					$sub = array('subject_id'=> $sub_arr[$index]);
					$receipt[] = array_merge( $record , $sub);
					$student_payments[] = array_merge( $record1 , array('subject_id'=> $sub_arr[$index], 'month'=>$month, 'due_amount'=>$subject_fee));
				}
			}
			//$due_amount = $sub_count*$subject_fee;
			//$this->db->where(array('student_id' => $row->student_id, 'due_amount'=>'2000.00'));
			//$this->db->update('student_payments', array('due_amount'=>$due_amount, 'comments' => $sub_count.' Subject'));
			
		}
		$this->db->insert_batch('student_payments', $student_payments);
		echo 'student_payments inserted...';
		//print_r($receipt);
		$this->db->insert_batch('student_subject_monthly', $receipt);
		echo 'Successfully Done!';
	}
	
	function insert_student_payments_monthly(){
		$batch_id = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		
		$this->db->select("*")->from("students");
		$this->db->where(array('batch_id'=> $batch_id, 'study_continue'=>'Y'));
		$this->db->order_by('student_id');
		$query = $this->db->get();
		$result = $query->result();
		$month = 10;//date('m');
		$subject_fee = $c = 0; $student_payments = $receipt = array();
		foreach ($result as $row) {
			
			if($c != $row->course_id){
				$subject_fee = $this->get_fee_per_subject($row->course_id);
				$c = $row->course_id;
			}
			
			$record1 = array('student_id'=>$row->student_id, 'due_date'=>$row->admission_date, 'batch_id'=>$row->batch_id, 'division_id'=>$row->division_id, 'fee_desc'=>'Tuition Fee', 'user_id'=>'99100');
			$record = array('student_id'=>$row->student_id, 'batch_id'=>$row->batch_id, 'month'=>$month);
			
			$this->db->select('subject_id');
			$this->db->from('student_subject_monthly');
			$this->db->where(array('student_id'=>$row->student_id,'batch_id'=> $batch_id, 'month'=>$month-1));
			
			$query1 = $this->db->get();
			$subjects = $query1->result();
			if(sizeof($subjects) > 0 ){
				$sub_count = 0;
				foreach($subjects as $s){
					if($s->subject_id != '') { $sub_count++;
						$sub = array('subject_id'=> $s->subject_id);
						$receipt[] = array_merge( $record , $sub);
						$student_payments[] = array_merge( $record1 , array('subject_id'=> $s->subject_id, 'month'=>$month, 'due_amount'=>$subject_fee));
					}
				}
			}
		}
		if(sizeof($student_payments) > 0 ){
			// if student_subject_monthly
			if($this->db->insert_batch('student_subject_monthly', $receipt)){
				//student_payments
				$this->db->insert_batch('student_payments', $student_payments);
				//student_payments_tracking
				$this->db->insert('student_payments_tracking', array('batch_id'=> $batch_id, 'month'=>$month, 'total_students'=>count($result), 'user_id'=>$user_id));
			}
		}
		echo 'student_payments inserted...'; 
		echo 'Successfully Done!';
	}
	
	function insert_monthly_subjects($id, $batch_id, $course_id, $month){
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$due_date = date('Y').'-'.$month.'-01';
		$subject_list = $_POST['availableSubjects'];
        $record = array('student_id'=>$id, 'batch_id'=>$batch_id, 'month'=>$month);
		$record1 = array('student_id'=>$id, 'due_date'=>$due_date, 'batch_id'=>$batch_id, 'division_id'=>$div_id, 'fee_desc'=>'Tuition Fee', 'user_id'=>$user_id);
		
		$subject_fee = $this->get_fee_per_subject($course_id);
        for($i=0;$i<sizeof($subject_list);$i++)
        {    	
	      	$subject_id = $subject_list[$i];
			$sub = array('subject_id'=> $subject_id);
			$receipt[] = array_merge( $record , $sub);
			$student_payments[] = array_merge( $record1 , array('subject_id'=> $subject_id, 'month'=>$month, 'due_amount'=>$subject_fee));
      	}
		
		if($this->db->insert_batch('student_subject_monthly', $receipt)){
			$this->db->insert_batch('student_payments', $student_payments);
		}
	}
	
	function update_monthly_subjects($id, $batch_id, $course_id, $month){
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$due_date = date('Y').'-'.$month.'-01';
		$subject_list = $_POST['availableSubjects'];
        $record = array('student_id'=>$id, 'batch_id'=>$batch_id, 'month'=>$month);
		$record1 = array('student_id'=>$id, 'due_date'=>$due_date, 'batch_id'=>$batch_id, 'division_id'=>$div_id, 'fee_desc'=>'Tuition Fee', 'user_id'=>$user_id);
		
		$subject_fee = $this->get_fee_per_subject($course_id);
        $this->db->where($record);
        $this->db->delete('student_subject_monthly');
		
		$this->db->where($record);
        $this->db->update('student_payments', array('mark_delete'=>'1', 'updated_by'=>$user_id, 'updated_at'=>'NOW()')); 
		
    	/*for($i=0;$i<sizeof($subject_list);$i++)
        {    	
	      	$subject_id = $subject_list[$i];
			$sub = array('subject_id'=> $subject_id);
			$receipt[] = array_merge( $record , $sub);
			$student_payments[] = array_merge( $record1 , array('subject_id'=> $subject_id, 'month'=>$month, 'due_amount'=>$subject_fee));
      	}*/
		$subject_fee = $this->get_fee_per_subject($course_id);
		for($i=0;$i<sizeof($subject_list);$i++)
		{    	
			$subject_id = $subject_list[$i];
			if($subject_id == 19 || $subject_id == 1){
				$due_fee=$subject_fee * (0.75);
			}else{
				$due_fee=$subject_fee;
			}
			$sub = array('subject_id'=> $subject_id);
			$receipt[] = array_merge( $record , $sub);
			$student_payments[] = array_merge( $record1 , array('subject_id'=> $subject_id, 'month'=>$month, 'due_amount'=>$due_fee));
		}
		$student_payments[] = array_merge( $record1 , array('subject_id'=> 28, 'month'=>$month, 'due_amount'=>500));
		
		if($this->db->insert_batch('student_subject_monthly', $receipt)){
			$this->db->insert_batch('student_payments', $student_payments);
		}
		$student = array('month'=>$month);
		if(isset($_POST['study_continue'])) $student['study_continue'] = ($_POST['study_continue'] == 'on') ? 'Y' : 'N';
		$this->db->where('student_id', $id);
        $this->db->update('students', $student); 
	}
	
	function get_monthly_subjects_detail($student_id, $batch_id, $month){
		$this->db->select('ss.*, s.subject_name');
		$this->db->from('student_subject_monthly ss');
		$this->db->join('subjects s', "ss.subject_id = s.subject_id AND ss.student_id = $student_id");
		$this->db->where(array('ss.batch_id'=> $batch_id, 'ss.month'=>$month));
		$this->db->order_by('subject_id', 'asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	
	function get_available_subjects($student_id, $batch_id, $month){
		/* Subquery start */
		$this->db->select("subject_id");
		$this->db->from('student_subject_monthly');
		$this->db->where(array('student_id'=>$student_id, 'batch_id'=> $batch_id, 'month'=>$month) );
		/* Subquery end */
		$subquery = $this->db->_compile_select();
		$this->db->_reset_select();
		
		$this->db->select('subject_id, subject_name');
		$this->db->from('subjects');
		$this->db->where("is_active", 'Y');
		$this->db->where("subject_id NOT IN( ".$subquery." )");
		//$this->db->where_not_in("subject_id", $subquery);
		$query = $this->db->get();
		$result = $query->result();
		//echo $str = $this->db->last_query();
		return $result;
	}
	
	function get_subjects_count($student_id, $batch_id, $month){
		$this->db->select('COUNT(subject_id) as sub_count');
		$this->db->from('student_subject_monthly');
		$this->db->where(array('student_id'=>$student_id,'batch_id'=> $batch_id, 'month'=>$month));
		
		$query = $this->db->get();
		$result = $query->row();
		return $result->sub_count;
	}
}