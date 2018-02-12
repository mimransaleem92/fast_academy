<?php

class Screen_model extends Base_Model{
	
	function Screen_model(){
		parent::__construct();
		
	}
	
	public function get_all_screens(){
		$this->db->where('is_active = 1');
		$query = $this->db->get('screens');
		return $query->result();
	}
	
	public function get_menu_list($id){
		
		/*	
		$query = $this->db->query("  select s1.screen_id, s1.name as parent_name, s2.name as name, s2.icon_class, s2.parent_id, s2.menu_order, s2.type, s2.url
							from screens s1 join screens s2 on s1.screen_id=s2.parent_id
							join userscreen on userscreen.screen_id = s2.screen_id 
							where userscreen.user_id = ? and s1.is_active = 1
							order by s1.screen_id, s2.type,s2.menu_order asc ", array($id));
		*/
		$query = $this->db->query("  select s1.screen_id, s1.name as parent_name, s2.name as name, s2.icon_class, s2.parent_id, s2.menu_order, s2.type, s2.url
							from screens s1 join screens s2 on s1.screen_id=s2.parent_id
							join rolescreen on rolescreen.screen_id = s2.screen_id
							where rolescreen.role_id = ? and s1.is_active = 1
							order by s1.screen_id, s2.type,s2.menu_order asc ", array($id));
		//	echo $str = $this->db->last_query();
		return $query->result();
	}
	
	public function get_selected_screens($id){
		
		$q = "select * from screens join userscreen on userscreen.screen_id = screens.screen_id 
		      where userscreen.user_id= ? and screens.is_active = 1 order by screens.type,screens.menu_order asc";
		$query = $this->db->query($q,array($id));
		
		return $query->result();	
	}
		
	public function get_available_screens($id){
			
		$q = "select * from screens where screen_id not in 
			 (select userscreen.screen_id from screens 
		      join userscreen on userscreen.screen_id = screens.screen_id 
		      where userscreen.user_id= ? ) and screens.is_active = 1";
		$query = $this->db->query($q,array($id));
		
		return $query->result();	
	}
	
	public function get_all_role(){
		$query = $this->db->get_where('role',array("is_active" => '1'));
		return $query->result();
	}
	
	public function get_role_screen($id){
		$query = $this->db->get_where('rolescreen',array("role_id" => $id));
		return $query->result();
	}
	
	public function get_all_actions(){
		$query = $this->db->get_where('actions',array("is_active" => '1'));
		return $query->result();
	}
	
	public function get_screen_actions($user_id, $screen_id){
		$query = $this->db->get_where('screen_actions',array("user_id" => $user_id, "screen_id" => $screen_id));
		return $query->result();
	}
	
	public function get_rolescreens_by_user($id){
			
		$q 	= "	select screens.*, userrole.role_id  from screens 
				join rolescreen on screens.screen_id = rolescreen.screen_id 
				join userrole on userrole.role_id = rolescreen.role_id
				and userrole.user_id =  ?
				where screens.is_active = 1";
		
		$query = $this->db->query($q,array($id));
		//echo $str = $this->db->last_query();
		return $query->result();	
	}
	public function get_role_by($id){
		$query = $this->db->get_where('role',array("is_active" => '1', "role_id" => $id));
		return $query->result();
	}
	
	public function get_user_by_role($id){			
		$q 	= "	select user_id from userrole where role_id =  ?";
		$query = $this->db->query($q,array($id));
		//echo $str = $this->db->last_query();
		return $query->result();	
	}
	
	public function get_rolescreens_by_role($id){
			
		$q 	= "	select screens.*  from screens 
				join rolescreen on screens.screen_id = rolescreen.screen_id 
				and rolescreen.role_id =  ?
				where screens.is_active = 1";
		$query = $this->db->query($q,array($id));
		//echo $str = $this->db->last_query();
		return $query->result();	
	}
	
	public function get_screens_available_for_role($id){
		$q 	= "	select screens.* from screens 
				where 
				screen_id not in(select screen_id from rolescreen where role_id = ? )
				and screens.is_active = 1";
		$query = $this->db->query($q,array($id));
		
		return $query->result();	
	}
	
	public function update()
    {
    	$role_id  = $_POST['role_id'];
        $screen_list = $_POST['availableScreens'];
        
        
    	$this->db->where('role_id', $role_id);
        $this->db->delete('rolescreen');
    	for($i=0;$i<sizeof($screen_list);$i++)
        {    	
	      	$screen_id = $screen_list[$i];
	      	$q = "insert into rolescreen(role_id,screen_id) values($role_id, $screen_id)";
			$query = $this->db->query($q);
      	}
        // get user ids who have the same role 
    	$users = Screen_model::get_user_by_role($role_id);
    	
    	foreach($users as $user){
    		$user_id = $user->user_id;
	    	$this->db->where('user_id', $user_id);
	        $this->db->delete('userscreen');
	        for($i=0;$i<sizeof($screen_list);$i++)
	        {    	
		      	$screen_id = $screen_list[$i];
		      	$q = "insert into userscreen(user_id,screen_id) values($user_id, $screen_id)";
				$query = $this->db->query($q);
	      	}
    	}
    }
		
}