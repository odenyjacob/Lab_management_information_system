<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hcm_Model extends CI_Model {
	function __construct(){ 
		parent::__construct();
		$this->load->database(); 
		
		$data = array('logged_in' => TRUE);
		$this->session->set_userdata($data); 
	}	

	

	function addEmp($data){
		if($this->db->insert('users', $data)){
			return true;
		}else{
			return false; 
		}
	}
	function initializeAccess($empNumber){
		if($this->db->insert('access_levels', $empNumber)){
			return true;
		}else{
			return false; 
		} 
	}
	
	function insertTimecard($initialize){
		extract($initialize);  
		$this->db->from('timecard');
		$this->db->where('empNumber', $empNumber);
		$query = $this->db->get();
		if($query->num_rows()===1){
			return true;   
		}else{
			$this->db->insert('timecard', $initialize);
			return true; 
		}	
	}
	
	function getTimecard($empNumber){
		$this->db->select('*');
		$this->db->from('timecard');
		$this->db->where('empNumber',$empNumber );
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->row_array();   
		}else{
			return false;
		}	
	}
	
	function timecardStatus($data){
		extract($data);
		$this->db->where('empNumber', $empNumber);
		if($this->db->update('timecard', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function leaveStatus($data){
		extract($data);
		$this->db->where('empNumber', $empNumber);
		if($this->db->update('leave', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function timecard_approvals($data){
		extract($data);		
		$this->db->from('timecard as t');
		$this->db->join('users as u', 'u.empNumber = t.empNumber');
		$this->db->where('u.supervisor', $empNumber);
		$query = $this->db->get();
		return $query->result();
		 
	
	}
	 
	function leave_approvals($data){
		extract($data);		
		$this->db->from('leave as l');
		$this->db->join('users as u', 'u.empNumber = l.empNumber');  
		$this->db->where('u.supervisor', $empNumber);
		$this->db->where('l.status', "Pending Approval");  
		$query = $this->db->get();
		return $query->result();
		 
	
	}
	 
	function updateTimecard($data){
		
			extract($data);
			$this->db->where('empNumber',$empNumber);
			$this->db->update('timecard', $data);
			return true;
	}
	
	function viewTc($empNumber){
		extract($empNumber);
		$this->db->from('timecard as t');
		$this->db->where('t.empNumber', $empNumber);
		$this->db->join('users as u', 'u.empNumber = t.empNumber'); 
		$query = $this->db->get();
		if($query->num_rows()===1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function leave_days($user){
		$this->db->from('leave as l');
		$this->db->where('l.empNumber', $user);
		$this->db->join('users as u', 'u.empNumber = l.empNumber'); 
		$query = $this->db->get();
		if($query->num_rows()===1){
			return $query->row_array();
		}else{
			return false;
		}				
	}

	function updateleave($data){
		extract($data);
		$this->db->where('empNumber', $empNumber);
		if($this->db->update('leave', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	


} 
?>