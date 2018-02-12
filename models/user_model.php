<?php

class User_model extends Base_Model{
	
	function User_model(){
		parent::__construct();
		
	}
	
	public function get_all_users($row = 0, $paging = FALSE){
		$div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
		$this->db->where('division_id', $div_id);
		if($paging){
			/* $this->db->select('u.*, r.name as role_name');
			$this->db->from('users u');
			$this->db->join('userrole ur','ur.user_id = u.user_id');
			$this->db->join('role r','r.role_id = ur.role_id'); */
			$this->db->where('company_id', $this->session->userdata(SESSION_CONST_PRE.'company_id'));
			$query = $this->db->get('users',10,$row);
		}
		else 
		{
			/* $this->db->select('u.*, r.name as role_name');
			$this->db->from('users u');
			$this->db->join('userrole ur','ur.user_id = u.user_id');
			$this->db->join('role r','r.role_id = ur.role_id'); */
			$this->db->where('company_id', $this->session->userdata(SESSION_CONST_PRE.'company_id'));
			$query = $this->db->get('users');
		}
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
	public function get_num_users(){
		$this->db->where('company_id', $this->session->userdata(SESSION_CONST_PRE.'company_id'));
		return $this->db->count_all('users');
	}
	
	function get_user_search($search_by, $search){
		
		/* $this->db->select('u.*, r.name as role_name');
		$this->db->from('users u');
		$this->db->join('userrole ur','ur.user_id = u.user_id');
		$this->db->join('role r','r.role_id = ur.role_id'); */
		if($search != '') $this->db->like($search_by, $search);
		
		$this->db->order_by($search_by, 'asc');
		$query = $this->db->get('users');
		//echo $str = $this->db->last_query();
		return $query->result();
	}
	
    public function get_user($id){
    	$this->db->select('u.*, e.course_id, e.section');
    	$this->db->from('users u');
    	$this->db->join('employees e','e.employee_id = u.employee_id', 'LEFT');
    	
		$query = $this->db->get_where('',array("u.user_id" => $id));
		return $query->result();
	}
	
	function get_employees($not_system_user = true){
		if($not_system_user){
			$query = $this->db->get_where('employees',array("system_user" => 'N'));
		}
		else
		{
			$query = $this->db->get('employees');
		}
		return $query->result();
	
	}
	
	function insert()
    {
        $user_fields = array('name', 'arabic_name', 'username', 'password', 'default_role', 'default_language', 'both_division','is_active', 'admin_role', 'employee_id');
        $user_arr = array();
    	foreach ($user_fields as $index)
    	{
    		if(isset($_POST[$index]))
    		$user_arr[$index] = $_POST[$index];
    	}
        
    	$this->db->insert('users', $user_arr);
        $user_id = $this->db->insert_id();
        
        $role_id = $_POST['role_id'];
        $this->db->query("insert into userrole(user_id,role_id) values($user_id, $role_id)");
        
        if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
        	$emp_id = $_POST['employee_id'];
        	 
        	$employee_arr['course_id'] = isset($_POST['course_id']) ? $_POST['course_id'] : '';
        	$employee_arr['section'] = isset($_POST['section']) ? $_POST['section'] : '';
        	$employee_arr['system_user'] = 'Y';
        	 
        	$this->db->where('employee_id', $emp_id);
        	$this->db->update('employees', $employee_arr);
        }
        
        /*$screen_list = $_POST['availableScreens'];
        
        for($i=0;$i<sizeof($screen_list);$i++)
        {    	
	      	$screen_id = $screen_list[$i];
	      	$q = "insert into userscreen(user_id,screen_id) values($user_id, $screen_id)";
			$query = $this->db->query($q);
      	}*/
    }
	
	function update()
    {
    	$user_id  = $_POST['user_id'];
        $user_fields = array('name', 'arabic_name', 'username', 'password', 'default_role', 'default_language', 'both_division', 'is_active', 'admin_role', 'employee_id');
    	$user_arr = array();
    	foreach ($user_fields as $index)
    	{
			if(isset($_POST[$index]))
    		$user_arr[$index] = $_POST[$index];
    	}
           	
    	$this->db->where('user_id', $user_id);
    	$this->db->update('users', $user_arr);
    	if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
    		$emp_id = $_POST['employee_id'];
    	
	    	$employee_arr['course_id'] = isset($_POST['course_id']) ? $_POST['course_id'] : '';
	    	$employee_arr['section'] = isset($_POST['section']) ? $_POST['section'] : '';
	    	$employee_arr['system_user'] = 'Y';
    	
	    	$this->db->where('employee_id', $emp_id);
	    	$this->db->update('employees', $employee_arr);
    	}
    	//echo $str = $this->db->last_query();
    	$role_id  = $_POST['default_role'];
        $screen_list = $_POST['availableScreens'];  
    	
    	$this->db->where('user_id', $user_id);
        $this->db->delete('userrole');
        $this->db->query("insert into userrole(user_id,role_id) values($user_id, $role_id)");
        /*
        $this->db->where('user_id', $user_id);
        $this->db->delete('screen_actions');
        $this->db->where('user_id', $user_id);
        $this->db->delete('userscreen');
        for($i=0;$i<sizeof($screen_list);$i++)
        {    	
	      	$screen_id = $screen_list[$i];
	      	$q = "insert into userscreen(user_id,screen_id) values($user_id, $screen_id)";
			$query = $this->db->query($q);
			/* $actions = Screen_model::get_all_actions();
			foreach($actions as $row){
				$action_id = $row->action_id;
				if(isset($_POST['screen_action-'.$screen_id.'-'.$action_id])){
					 $screen_actions = array('user_id'=>$user_id, 'screen_id'=>$screen_id, 'action_id'=>$action_id);
					 $this->db->insert('screen_actions',$screen_actions);
				}
			} //
      	} */
      	
    }
	
    function delete($user_list)
    {//echo $user_list;
    	
    	$user_arr = explode(",", $user_list);
    	foreach ($user_arr as $user_id)
    	{
	    	$this->db->where('user_id', $user_id);
	        $this->db->delete('users');
	        
	        $this->db->where('user_id', $user_id);
	        $this->db->delete('userscreen');
    	}
    }
}