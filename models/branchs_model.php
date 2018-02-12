<?php

class Branchs_model extends Base_Model{
	
	function Branchs_model(){
		parent::__construct();
		
	}
	
	public function get_branch_by($id){
		
		$q = "select * from branchs where branch_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_branchs($row = 0, $paging = FALSE){
		
		if($paging){
			$query = $this->db->get('student_payments_tracking',10,$row);
		}
		else 
		{
			$query = $this->db->get('student_payments_tracking');
		}
		return $query->result();
	}
	
	function get_num_branchs(){
		return $this->db->count_all('branchs');
	}
	
    function get_branch($id){
		$this->db->select('c.*,d.name as department_name');
		$this->db->from('branchs c');
		$this->db->join('departments d','c.department_id = d.department_id', 'LEFT');
    	$query = $this->db->get_where('branchs',array("c.branch_id" => $id));
		return $query->result();
	}
	
	function process_already_run(){
		$month = isset($_POST['month']) ? $_POST['month'] : date('m');
		
		$query = $this->db->query("Select COUNT(id) as num from student_payments_tracking where `month`=$month AND course_id='".$_POST['class']."'");
	    $row = $query->row();
		if( $row->num == 0 ){
			return TRUE;
		}
		return FALSE;
	}
	
	function get_fee_per_subject($course_id){
		$division_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$fee_column = ($division_id == 1) ? 'FEE_PER_YEAR_DIS' : 'FEE_PER_YEAR_DNS'; 
	    $fee_amount = 0;
		$query = $this->db->query("Select $fee_column as due_fee from courses where course_id=$course_id AND is_active='Y'");
	    $result = $query->result();
		if( isset($result[0]) ){
			$fee_amount = $result[0]->due_fee;
		}
		return $fee_amount;
	}
	
	function insert()
    {
		$batch_id = $this->session->userdata(SESSION_CONST_PRE.'batch_id');
		$user_id = $this->session->userdata(SESSION_CONST_PRE.'userId');
		
		$this->db->select("*")->from("students");
		$this->db->where(array('batch_id'=> $batch_id, 'study_continue'=>'Y', 'cdel'=>'0'));
		if(isset($_POST['class']) && $_POST['class'] > 0){
			$this->db->where('course_id', $_POST['class']);
		}
		$this->db->order_by('student_id');
		$query = $this->db->get(); echo $this->db->last_query();
		$result = $query->result();
		$month = isset($_POST['month']) ? $_POST['month'] : date('m');
		$subject_fee = $c = 0; $student_payments = $receipt = array();
		foreach ($result as $row) {
			
			if($c != $row->course_id){
				$subject_fee = $this->get_fee_per_subject($row->course_id);
				$c = $row->course_id;
			}
			$due_date = date('Y').'-'.$month.'-01';
			$record1 = array('student_id'=>$row->student_id, 'due_date'=>$due_date, 'batch_id'=>$row->batch_id, 'division_id'=>$row->division_id, 'fee_desc'=>'Tuition Fee', 'user_id'=>'99100');
			$record = array('student_id'=>$row->student_id, 'batch_id'=>$row->batch_id, 'month'=>$month);
			
			$this->db->select('subject_id');
			$this->db->from('student_subject_monthly');
			if($month == 1){
				$this->db->where(array('student_id'=>$row->student_id,'batch_id'=> $batch_id, 'month'=>12));
			}
			else{
				$this->db->where(array('student_id'=>$row->student_id,'batch_id'=> $batch_id, 'month'=>$month-1));
			}
			$query1 = $this->db->get();
			$subjects = $query1->result();
			if(sizeof($subjects) > 0 ){
				$sub_count = 0;
				foreach($subjects as $s){
					if($s->subject_id != '') { $sub_count++;
						$due_amount = ($_POST['fee'])*$subject_fee;
						$sub = array('subject_id'=> $s->subject_id);
						$receipt[] = array_merge( $record , $sub);
						$student_payments[] = array_merge( $record1 , array('subject_id'=> $s->subject_id, 'month'=>$month, 'due_amount'=>$due_amount));
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
				$this->db->insert('student_payments_tracking', array('batch_id'=> $batch_id, 'month'=>$month, 'course_id'=>$_POST['class'], 'total_students'=>count($result), 'user_id'=>$user_id));
			}
		}
	
		echo 'Successfully Done!';
    }
	
	function update()
    {
    	$branch_id  = $_POST['branch_id'];
    	$temp_arr = array ('name');
    	$branch_arr = array();
    	foreach ($temp_arr as $index)
    	{
    		$branch_arr[$index] = $_POST[$index];
    	}        
        $this->db->where('branch_id', $branch_id);
    	$this->db->update('branchs', $branch_arr);
    }
	
    function delete($branch_list)
    {	
    	$branch_arr = explode(",", $branch_list);
    	foreach ($branch_arr as $branch_id)
    	{
	    	$this->db->where('branch_id', $branch_id);
	        $this->db->delete('branchs');
    	}
    }
		
}