<?php

class Login_model extends Base_Model{
	
	function Login_model(){
		parent::__construct();
	}

	public function authenticateUser($username, $password)
	{
		$this->db->select('user_id, department_id, name, arabic_name, is_active, default_screen, default_language, company_id, division_id, branch_code, created_date, admin_role, both_division, fee_payment, manual_fee_receive, session_start, employee_id, super_admin, CURDATE() as curr_dt');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('is_active', 'Y');
		//$this->db->where('created_date >= CURDATE()');
		$this->db->from('users');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row;
		} else {
			return FALSE;
		}
	}
	
	function get_logincompany($id){
		$query = $this->db->get_where('company',array("company_id" => $id));
		return $query->row();
	}
	
	
	
	function get_logins(){
		$query = $this->db->get('users');
		return $query->result();
	}
}