<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_Model extends CI_Model {
	function __construct(){  
		parent::__construct();
		$this->load->database(); 
		
		$data = array('logged_in' => TRUE);
		$this->session->set_userdata($data);
	}	

	  
	
	function getLogin($credentials ='default'){
			extract($credentials);
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('userName', $userName);	 
			$query = $this->db->get();			
			if($query->num_rows()==1){
				return $query->result();
			}else{
				return false;
			}			
			
	}
	
	function pullProfileInfo($username){ 
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('userName', $username);
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->row_array();    
		}else{
			return false;
		}		
		
	}
	
	function check_email($check){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('email',$check);
		$query = $this->db->get();
		
		if($query->num_rows()==1){
			return true;
		}else{
			return false;
		} 
	}
	
	
	function register_user($data){
		if($this->db->insert('users', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function creditline(){
		$this->db->select('*');
		$this->db->from('company_details');
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	
	
	function insertrCode($data){
		extract($data);
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('email', $email);
		if($this->db->update('users', $data)){ 
			return true;
		} else{
			return false;
		} 
		
	}
	
	function employeeAccess($data){		
		$this->db->select('*');
		$this->db->from('users as u');
		$this->db->join('access_levels as b', 'u.empNumber = b.empNumber'); 
		$this->db->where('u.empNumber', $data);
		$query = $this->db->get();
		
		if($query->num_rows()===1){
			return $query->result(); 
		}else{
			return false;
		}
		
	}
	
	function updateAccess($data){
		extract($data);
		$this->db->where('empNumber', $empNumber);
		if($this->db->update('access_levels', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function getAccess($empNumber){
		$this->db->from('access_levels');
		$this->db->where('empNumber', $empNumber);
		$query = $this->db->get();
		if($query->num_rows()===1){
			return $query->row_array();
		}else{
			return false;
		}
		
	}
	
	function unauthorizedWarning($warning){
		if($this->db->insert('notifications', $warning)){
			return true;
		}else{
			return false;
		}
	}

	
	/************************************** RR*******************************************************/
	
	
	function changepassword($username){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('userName', $username);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
		
	}
	
	function getPass($username){
		$this->db->from('users');
		$this->db->where('userName', $username);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array();
			return $row['password'];
		}else{
			return false;
		}
	}
	
	function updateusers($data){
		extract($data);
		$this->db->where('userName', $userName);
		if($this->db->update('users', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function getSummaries($search){ 
		$this->db->select('*');
		$this->db->from('summaries');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->row_array();    
		}else{
			return false;
		}		
		
	}
	
	function getConcepts($search){ 
		$this->db->select('*');
		$this->db->from('concepts');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->row_array();    
		}else{
			return false;
		}		
		
	}
	
	


}
?>