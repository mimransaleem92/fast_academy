<?php

class Collect_fees_model extends Base_Model{
	
	function Collect_fees_model(){
		parent::__construct();
		
	}
	
	public function get_batch_by($id){
		
		$q = "select * from collect_fees where batch_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_collect_fees($row = 0, $paging = FALSE){
		$this->db->select('fc.*, b.batch_name, c.course_name');
		$this->db->from('students s');
		$this->db->join('fee_collection fc','fc.course_id = c.course_id');
		$this->db->join('batches b','fc.batch_id = b.batch_id');
		$this->db->order_by('b.batch_name,  fc.collection_name'); 
		if($paging){
			$query = $this->db->get('',10,$row);
		}
		else 
		{	
			$query = $this->db->get('');
		} //echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_num_collect_fees(){
		return $this->db->count_all('collect_fees');
	}
	
    function get_collect_fees($id){
		$query = $this->db->get_where('collect_fees',array("id" => $id));
		return $query->result();
	}
	
	function get_fee_collection_by_batch($id){
		
		$this->db->select('fc.*, fcate.category_name');
    	$this->db->from('fee_collection fc');
    	$this->db->join('fee_category fcate','fc.fee_category_id = fcate.id');
    	$this->db->order_by('fcate.category_name, fc.collection_name');
		$this->db->where(array("fcate.batch_id" => $id));
		$query = $this->db->get();
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_students_by_batch($collection_id, $batch_id){
		$sql ="SELECT
				students.student_id,
				students.batch_id,
				students.student_name,
				student_payments.fee_collection_id,
				student_payments.due_amount,
				sum(student_payments.payment_amount) AS total_payment
				FROM
				students
				Left Join student_payments ON students.student_id =  student_payments.student_id AND student_payments.fee_collection_id='".$collection_id."'
				WHERE
				students.batch_id = '".$batch_id."' Group by student_id";
		$query = $this->db->query($sql);
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_students_paid_list($collection_id, $batch_id){
		$sql ="SELECT
				students.student_id,
				students.batch_id,
				students.student_name,
				student_payments.fee_collection_id,
				student_payments.due_amount,
				sum(student_payments.payment_amount) AS total_payment
				FROM
				students
				Join student_payments ON students.student_id =  student_payments.student_id AND student_payments.fee_collection_id='".$collection_id."'
				WHERE
				students.batch_id = '".$batch_id."' Group by student_id";
		$query = $this->db->query($sql);
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_students_unpaid_list($collection_id, $batch_id){ // Needs to wook on this function
		$sql ="SELECT
				students.student_id,
				students.batch_id,
				students.student_name,
				student_payments.fee_collection_id,
				student_payments.due_amount,
				sum(student_payments.payment_amount) AS total_payment
				FROM
				students
				LEFT Join student_payments ON students.student_id =  student_payments.student_id AND student_payments.fee_collection_id='".$collection_id."'
				WHERE
				students.batch_id = '".$batch_id."' Group by student_id";
		$query = $this->db->query($sql);
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_fee_particulars_by_collection($id){
		$sql ="SELECT fee_collection.collection_name, fee_category_particulars.*
				FROM
				fee_collection Join fee_category_particulars ON fee_collection.fee_category_id = fee_category_particulars.fee_category_id
				WHERE fee_collection.id='".$id."'";
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	function get_fee_particulars($id){
	
		
		$this->db->where(array("fee_category_id" => $id));
		$this->db->order_by('name');
		$query = $this->db->get('fee_category_particulars');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function clear_payment_by_collection(){
		unset($_POST['batch_id']);
		$this->db->insert('student_payments', $_POST);
	}
	
	function insert_sibling_row($id, $student_id, $due, $amount){
		
		$sibling_arr = array ('student_id'=>$student_id, 'fee_collection_id'=>$id, 'due_amount'=>$due, 'payment_amount'=>$amount, 'payment_date'=>'CURRENT_TIMESTAMP', 'comments'=>'Sibling Amount');
		$this->db->insert('student_payments', $sibling_arr);
	}
	
	function get_sibling_row($id, $student_id){
		$this->db->where(array("fee_collection_id" => $id, "student_id"=>$student_id, 'comments'=>'Sibling Amount'));
		$query = $this->db->get('student_payments');
		
		return $query->result();
	}
	
	function insert()
    {
    	$batch_arr = $_POST;
        $this->db->insert('collect_fees', $batch_arr);
        $batch_id = $this->db->insert_id(); 
    }
	
	function update()
    {
    	$batch_arr = $_POST;
    	$batch_id  = $_POST['batch_id'];
        unset($batch_arr['batch_id']);
        
        $this->db->where('batch_id', $batch_id);
    	$this->db->update('collect_fees', $batch_arr);
    }
	
    function delete($batch_list)
    {	
    	$batch_arr = explode(",", $batch_list);
    	foreach ($batch_arr as $batch_id)
    	{
	    	$this->db->where('batch_id', $batch_id);
	        $this->db->delete('collect_fees');
    	}
    }
		
}