<?php

class User_profile_model extends Base_Model{
	
	function User_profile_model(){
		parent::__construct();
		
	}
	
	public function get_user_profile($id){
		$query = $this->db->get_where('users',array("user_id" => $id));
		return $query->result();
	}	
	
	function update_pwd()
    {
    	$user_id  = $this->session->userdata(SESSION_CONST_PRE.'userId');
        if(isset($_POST['new_password']) && !empty($_POST['new_password'])){
			$this->db->query("update users set password = '".$_POST['new_password']."' where user_id = $user_id ");
		}
              	
    }   
}