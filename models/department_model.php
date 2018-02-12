<?php

class Department_model extends Base_Model{
	
	function Department_model(){
		parent::__construct();
		
	}
	
	public function get_all_departments($row = 0, $paging = FALSE){
		if($paging){
			$query = $this->db->get('departments',10,$row);
		}
		else 
		{
			$query = $this->db->get('departments');
		}
		return $query->result();
	}
	
	public function get_num_departments(){
		return $this->db->count_all('departments');
	}
	
	function get_department_search($search_by, $search){
		
		if($search != '') $this->db->like($search_by, $search);
		
		$this->db->order_by($search_by, 'asc');
		$query = $this->db->get('departments');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
    public function get_department($id){
		$query = $this->db->get_where('departments',array("department_id" => $id));
		return $query->result();
	}	
	
	function insert()
    {
        $department_fields = array('name', 'arabic_name');
    	$department_arr = array();
    	foreach ($department_fields as $index)
    	{
    		$department_arr[$index] = $_POST[$index];
    	}
    	$search_fields = '';
    	for ($i=1; $i<=5; $i++){
    		if(isset($_POST[ 'search_field'.$i ]) && !empty($_POST[ 'search_field'.$i ])){
    			$search_fields .= ','. $_POST[ 'search_field'.$i ];
    		}
    	}
    	if($search_fields != ''){
    		$department_arr['search_fields'] = substr($search_fields, 1);
    	}
    	
    	$this->db->insert('departments', $department_arr);
        $department_id = $this->db->insert_id();
    }
	
	function update()
    {
    	$department_id  = $_POST['department_id'];
        $department_fields = array('name', 'arabic_name');
    	$department_arr = array();
    	foreach ($department_fields as $index)
    	{
    		$department_arr[$index] = $_POST[$index];
    	}
    	$search_fields = '';
    	for ($i=1; $i<=5; $i++){
    		if(isset($_POST[ 'search_field'.$i ]) && !empty($_POST[ 'search_field'.$i ])){
    			$search_fields .= ','. $_POST[ 'search_field'.$i ];
    		}
    	}
    	if($search_fields != ''){
    		$department_arr['search_fields'] = substr($search_fields, 1);
    	}
    	$this->db->where('department_id', $department_id);
    	$this->db->update('departments', $department_arr);
    }
	
    function delete($department_list)
    {//echo $department_list;
    	
    	$department_arr = explode(",", $department_list);
    	foreach ($department_arr as $department_id)
    	{
	    	$this->db->where('department_id', $department_id);
	        $this->db->delete('departments');
    	}
    }
}