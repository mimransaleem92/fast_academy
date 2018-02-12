<?php

class Batches_model extends Base_Model{
	
	function Batches_model(){
		parent::__construct();
		
	}
	
	public function get_batch_by($id){
		
		$q = "select * from batches where batch_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_batches($row = 0, $paging = FALSE){
		$this->db->select('b.*, c.course_name');
		$this->db->from('batches b');
		$this->db->join('courses c','c.course_id = b.course_id');
		$this->db->order_by('b.batch_name,  c.course_name'); 
		if($paging){
			$query = $this->db->get('',10,$row);
		}
		else 
		{	
			$query = $this->db->get('');
		}//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	function get_num_batches(){
		return $this->db->count_all('batches');
	}
	
    function get_batches($id){
		$query = $this->db->get_where('batches',array("batch_id" => $id));
		return $query->result();
	}
	
	function insert()
    {
    	$batch_arr = $_POST;
        $this->db->insert('batches', $batch_arr);
        $batch_id = $this->db->insert_id();
        $this->db->insert('batch_weekdays', array('course_id'=>$_POST["course_id"], 'batch_id'=>$batch_id));
    }
	
	function update()
    {
    	$batch_arr = $_POST;
    	$batch_id  = $_POST['batch_id'];
        unset($batch_arr['batch_id']);
        
        $this->db->where('batch_id', $batch_id);
    	$this->db->update('batches', $batch_arr);
    }
	
    function delete($batch_list)
    {	
    	$batch_arr = explode(",", $batch_list);
    	foreach ($batch_arr as $batch_id)
    	{
	    	$this->db->where('batch_id', $batch_id);
	        $this->db->delete('batches');
    	}
    }
		
}