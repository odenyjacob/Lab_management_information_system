<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fms_Model extends CI_Model {
	function __construct(){ 
		parent::__construct();
		$this->load->database();  
		
		$data = array('logged_in' => TRUE);
		$this->session->set_userdata($data); 
	}	 

	 
	 function getAccountNumber($search){
	 	$this->db->select("id, account_name,account_number,account_branch"); 
		$whereCondition = array('account_number' =>$search);
		$this->db->where($whereCondition); 
		$this->db->from('bank_accounts');  
		$query = $this->db->get();
		if($query->num_rows()===1){
			return $query->result();
		}else{
			return false;
		}
	 } 
	 
	 function getPayee($search){
	 	$this->db->select("FName, LName,userName,empNumber");
		$whereCondition = array('userName' =>$search);
		$this->db->where($whereCondition); 
		$this->db->from('users');  
		$query = $this->db->get();
		if($query->num_rows()===1){
			return $query->result();
		}else{
			return false;
		}
	 } 
	 
	 function getEmployeeDetails($search){
	 	$this->db->select("*");
		$whereCondition = array('empNumber' =>$search);
		$this->db->where($whereCondition); 
		$this->db->from('users');  
		$query = $this->db->get();
		if($query->num_rows()===1){
			return $query->result();
		}else{
			return false;
		}
	 }
	 function getEmployeeBenefits($search){		
		$this->db->select('*');
		$this->db->from('users as u');
		$this->db->join('employee_benefits as b', 'u.empNumber = b.empNumber');  
		$this->db->where('u.empNumber', $search);
		$query = $this->db->get();
		
		if($query->num_rows()===1){
			return $query->result();
		}else{
			return false;
		}
	 }
	 
	 function instanceofemployeeBenefits($data){
	 	if($this->db->insert('employee_benefits', $data)){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }
	 
	 function updateEmpBenefits($data){
	 	 	extract($data);
		$term = array(
					//'id' => $id,
					'empNumber' => $empNumber,
				);
		$this->db->where($term); 
	 	if($this->db->update('employee_benefits', $data)){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }
	 
	 function newImprestRequest($data){
	 	if($this->db->insert('imprest_requests', $data)){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 } 
	 
	 function myImprests($username){
	 	$this->db->from('imprest_requests');
		$this->db->where('empNumber', $username);
		$query = $this->db->get();
		return $query->result();
	 }

	function getMyImprestApprovals($empNumber){
		$this->db->from('imprest_requests as i');
		$this->db->join('users as u', 'u.empNumber = i.empNumber');
		$this->db->where('i.empNumber', $empNumber);
		$query = $this->db->get();
		return $query->result();
	}
	
	function accountsImprests($empNumber){
		$this->db->from('imprest_requests as i');
		$this->db->join('users as u', 'u.empNumber = i.empNumber');
		$this->db->where('i.empNumber', $empNumber);
		$this->db->where('i.financial_approval', 'Approved');
		$query = $this->db->get();
		return $query->result();
	}
	
	function supervisor_approval($data){
		extract($data);
		$this->db->where('impNumber', $impNumber);
		if($this->db->update('imprest_requests', $data)){
			return true;
		}else{
			return false;
		}
	}
 
	function updateImprestRequest($data){
		extract($data);
		$this->db->where('impNumber', $impNumber);
		if($this->db->update('imprest_requests', $data)){
			return true;
		}else{
			return false;
		}
	}

	function getFinancialImprest(){
		$this->db->from('imprest_requests as i');	
		$this->db->join('users as u', 'u.empNumber = i.empNumber');
		$this->db->join('bank_accounts as a', 'a.account_number = i.account_number');
		$this->db->where('i.supervisor_approval', 'Approved');
		$query = $this->db->get(); 
		return $query->result();
		
	}
	
	function getAccountBalance($account){
		$this->db->from('bank_accounts');
		$this->db->where('account_number', $account);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array(); 
			return $row['account_balance'];
		}else{
			return false;
		}
	}	
	
	function updateAccount($data){
		extract($data);
		$this->db->where('account_number', $account_number);
		if($this->db->update('bank_accounts', $data)){
			return true;
		}else{
			return false;
		}
		
	}
	
	function getPayroll(){
		$this->db->from('employee_benefits as e');
		$this->db->join('users as u', 'u.empNumber=e.empNumber');
		$query = $this->db->get();
		return $query->result(); 
	}
	

	


} 
?>