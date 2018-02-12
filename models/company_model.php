<?php

class Company_model extends Base_Model{
	
	function Company_model(){
		parent::__construct();
		
	}
	
	public function get_company_by($id){
		
		$q = "select * from company where company_id=?";
		$query = $this->db->query($q,array($id));
	}

	function get_all_companys($row = 0, $paging = FALSE){
		if($paging){
			$query = $this->db->get('company',10,$row);
		}
		else 
		{
			$query = $this->db->get('company');
		}
		return $query->result();
	}
	
	function get_num_companys(){
		return $this->db->count_all('company');
	}
	
    function get_company($id){
		$query = $this->db->get_where('company',array("company_id" => $id));
		return $query->result();
	}
	
	function insert()
    {
    	$company_arr = $_POST;
        $this->db->insert('company', $company_arr);
        $company_id = $this->db->insert_id(); 
    }
	
	function update()
    {
    	$company_arr = $_POST;
    	$company_id  = $_POST['company_id'];
        unset($company_arr['company_id']);
        
        $this->db->where('company_id', $company_id);
    	$this->db->update('company', $company_arr);
    }
    
    function update_item()
    {
    	$company_arr = array($_POST['name']=>$_POST['value']);
    
    	$this->db->where('company_id', $_POST['pk']);
    	$this->db->update('company', $company_arr);
    }
    
    function update_address()
    {
    	$company_arr = $_POST['value'];
    
    	$this->db->where('company_id', '1');
    	$this->db->update('company', $company_arr);
    }
	
    function delete($company_list)
    {	
    	$company_arr = explode(",", $company_list);
    	foreach ($company_arr as $company_id)
    	{
	    	$this->db->where('company_id', $company_id);
	        $this->db->delete('company');
    	}
    }
		
}