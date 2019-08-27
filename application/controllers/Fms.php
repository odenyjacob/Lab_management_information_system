<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fms extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'hcm_model', 'fms_model'));
		$this->load->helper(array('date', 'array', 'html','string', 'url', 'form'));
		
		$this->view_data = array();
		

	}  
	
	
	
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);			
	}
	
		// Login View
	function login(){
		$data['title'] = 'ERP | LOGIN';
		$this->load->view('login', $data);
		//$this->load->view('login'); 
	}
	
	
	
	
	 
	//Showing success page
	function success(){
		$this->load->view('success');
	}
	
		
	function dberror(){

		$this->dashboard();
		$this->load->view('dberror');
	}
	
	function newImprest(){
		$data['title'] = 'ERP | New Imprest Request';
		$this->dashboard();
		$this->load->view('fms/newImprest', $data); 
	} 
	
	function pni(){
		$search=  $this->input->post('account_number');
		$query = $this->fms_model->getAccountNumber($search);  
		echo json_encode ($query);
		//$this->load->view('fms/employeeBenefits', $query);
	}
	
	
	function pniPayee(){
		$search=  $this->input->post('payee');
		$query = $this->fms_model->getPayee($search);  
		echo json_encode ($query);
	}
	
	function pniApprover(){
		$search=  $this->input->post('approver');
		$query = $this->fms_model->getPayee($search);  
		echo json_encode ($query);
	}
	
	function pniRequest(){
		$data = array(
			'empNumber' => $this->session->userdata('empNumber'),
			'impNumber' => $this->input->post('impNumber'),
			'account_number' => $this->input->post('account_number'),
			'Account' => $this->input->post('Account'),
			'payee' => $this->input->post('payee'),
			'payee_account' => $this->input->post('payee_account'),
			'amount' => $this->input->post('amount'),
			'purpose' => $this->input->post('purpose'),
			'remarks' => $this->input->post('remarks'),
			'approver' => $this->input->post('approver'),
			'approvers_name' => $this->input->post('approvers_name'), 
			'date_raised' => date('ymdhis'),
			
		);
		
		$data = $this->security->xss_clean($data);
		if($this->fms_model->newImprestRequest($data)){
			echo json_encode($data);
		}else{
		   //$this->dberror();
		}
		
	}

	function employeeBenefits(){
			
			$data['title'] = 'Employee Benefits';
			$this->dashboard();
			$this->load->view('fms/employeeBenefits', $data);
		}

	function eB(){
		$search=  $this->input->post('empNumber');
		$query = $this->fms_model->getEmployeeDetails($search);   
		echo json_encode ($query);
	}
	
	function eD(){
		$search=  $this->input->post('empNumber');
		$query = $this->fms_model->getEmployeeBenefits($search);  
		echo json_encode ($query);
	} 
	
	function editEb(){
		$search=  $this->input->post('empNumber');
		$query = $this->fms_model->getEmployeeBenefits($search);  
		echo json_encode ($query);
	}
	
	function peb(){
		$data = array(
			'empNumber' => $this->input->post('empNumber'),
			'basic_salary' => $this->input->post('basic_salary'),
			'house_allowance' => $this->input->post('house_allowance'),
			'medical_allowance' => $this->input->post('medical_allowance'),
			'over_time' => $this->input->post('over_time'),
			'travel_reimbursement' => $this->input->post('travel_reimbursement'),
			'arrears' => $this->input->post('arrears'),
			'supplement1' => $this->input->post('supplement1'), 
			'supplement2' => $this->input->post('supplement2'),
			'supplement3' => $this->input->post('supplement3'),
		);
		$data = $this->security->xss_clean($data);
		if($this->fms_model->instanceofemployeeBenefits($data)){
			echo json_encode($data);
		}		
	}
	
	function ped(){
		$data = array(
			'empNumber' => $this->input->post('empNumber'),
			'paye' => $this->input->post('paye'),
			'bank_loan' => $this->input->post('bank_loan'),
			'medical_contribution' => $this->input->post('medical_contribution'),
			'sacco_loan' => $this->input->post('sacco_loan'),
			'cash_advance' => $this->input->post('cash_advance'),
			'student_loan' => $this->input->post('student_loan'),
			'ssf' => $this->input->post('ssf'),
			'otherdeductions1' => $this->input->post('otherdeductions1'),
			'otherdeductions2' => $this->input->post('otherdeductions2'),
		);
		$data = $this->security->xss_clean($data);
		if($this->fms_model->updateEmpBenefits($data)){
			echo json_encode($data);
		}		
	}
	
		function pEditedEd(){
		$data = array(
			//'id' => $this->input->post('id'),
			'empNumber' => $this->input->post('empNumber'),
			'paye' => $this->input->post('paye'),
			'bank_loan' => $this->input->post('bank_loan'),
			'medical_contribution' => $this->input->post('medical_contribution'),
			'sacco_loan' => $this->input->post('sacco_loan'),
			'cash_advance' => $this->input->post('cash_advance'),
			'student_loan' => $this->input->post('student_loan'),
			'ssf' => $this->input->post('ssf'),
			'otherdeductions1' => $this->input->post('otherdeductions1'),
			'otherdeductions2' => $this->input->post('otherdeductions2'),
		);
		$data = $this->security->xss_clean($data);
		if($this->fms_model->updateEmpBenefits($data)){
			echo json_encode($data);
		}	
		
	}
	
	
	function pEditedEb(){
		$data = array(
			//'id' => $this->input->post('id'),
			'empNumber' => $this->input->post('empNumber'),
			'basic_salary' => $this->input->post('basic_salary'),
			'house_allowance' => $this->input->post('house_allowance'),
			'medical_allowance' => $this->input->post('medical_allowance'),
			'over_time' => $this->input->post('over_time'),
			'travel_reimbursement' => $this->input->post('travel_reimbursement'),
			'arrears' => $this->input->post('arrears'),
			'supplement1' => $this->input->post('supplement1'),
			'supplement2' => $this->input->post('supplement2'),
			'supplement3' => $this->input->post('supplement3'),
		);
		$data = $this->security->xss_clean($data);
		if($this->fms_model->updateEmpBenefits($data)){
			echo json_encode($data);
		}	
		
	}

	function payroll(){
		
		$data['title'] = 'Payrol period';
		$this->dashboard();
		$this->load->view('fms/payroll', $data);
	}
	
	function editEmployeeBenefits(){
		$data['title'] = 'ERP | Edit Employee Benefits';
		$this->dashboard();
		$this->load->view('fms/editEmployeeBenefits', $data); 
	}

	function employeeDeducations(){
		$data['title'] = 'ERP | Employee Deductions';
		$this->dashboard();
		$this->load->view('fms/employeeDeductions', $data);
	}
	
	function myImprestRequests(){
		$username = $this->session->userdata('empNumber');
		$data['IR'] = $this->fms_model->myImprests($username);
		$data['title'] = 'ERP| My Imprest Requests';
		$this->dashboard();
		$this->load->view('fms/myImprestRequests', $data);
	}

	function myImprestApprovals(){
		$empNumber = $this->session->userdata('empNumber');
		$data['approvals'] = $this->fms_model->getMyImprestApprovals($empNumber);
		$data['title'] = 'ERP | My Imprest Approvals';
		$this->dashboard();
		$this->load->view('fms/myImprestApprovals', $data);
	}

	function accountingImprestApprovals(){
		$empNumber = $this->session->userdata('empNumber');
		$data['approvals'] = $this->fms_model->accountsImprests($empNumber);
		$data['title'] = 'ERP | Accounts - Imprest Approvals';
		$this->dashboard();
		$this->load->view('fms/accountingImprestApprovals', $data);
	}
	
	function financialImprestApprovals(){
		$data['title'] = 'ERP | Financial Imprest Request';
		//$username = $this->session->userdata('empNumber');
		$data['approvals']= $this->fms_model->getFinancialImprest();
		$this->dashboard();
		$this->load->view('fms/financialImprestApprovals', $data); 
	} 
	
	
	function approveMyImprestApprovals(){
			$data = array(
				'impNumber' =>$this->input->post('impNumber'),  
				'supervisor_approval' =>'Approved',
				'supervisor_approval_date' =>date('ymdhis'),
				'supervisor_approval_by' => $this->session->userdata('empNumber')."-". $this->session->userdata('FName')." " .$this->session->userdata('LName'),
			);
			
			if($this->fms_model->supervisor_approval($data)){
				echo json_encode($data);
			}else{
				
			}
	}

	function confirmAccountsImprests(){
			$data = array(
				'impNumber' =>$this->input->post('impNumber'),  
				'accounts_collection' =>'Collected',
				'collection_date' =>date('ymdhis'),
				'collection_authorizedBy' => $this->session->userdata('empNumber')."-". $this->session->userdata('FName')." " .$this->session->userdata('LName'),
			);
			
			if($this->fms_model->updateImprestRequest($data)){
				echo json_encode($data);
			}else{
				
			}
	}
	
	function rejectMyImprestApprovals(){
			$data = array(
				'impNumber' => $this->input->post('impNumber'),  
				'supervisor_approval' =>'Rejected',
			);
			
			if($this->fms_model->supervisor_approval($data)){
				echo json_encode($data);
			}else{
				
			}
	}

	function payroll_report(){
		$data['report'] = $this->fms_model->getPayroll();
		$data['title'] = 'ERP | Payroll Report';
		$this->dashboard();
		$this->load->view('fms/payroll', $data);
	}

	function financialImprestRejected(){
			$data = array(
				'financialImprest_approved_by' => $this->session->userdata('empNumber')."-". $this->session->userdata('FName')." " .$this->session->userdata('LName'),
				'impNumber' => $this->input->post('impNumber'),  
				'financial_approval' =>'Rejected',
				'financial_approval_date' =>date('ymdhis'),
			);
			
			if($this->fms_model->updateImprestRequest($data)){
				echo json_encode($data);
			}else{
				
			}
	}
	
	function financialImprestApproved(){
		$account = $this->input->post('account_number');
		$impNumber = $this->input->post('impNumber');
		$amount = $this->input->post('amount');
		$balance = $this->fms_model->getAccountBalance($account);
		
		$newBalance = $balance-$amount;
		$data = array (
			'account_number' => $this->input->post('account_number'),
			'account_balance' => $newBalance,
		);
		
		if($this->fms_model->updateAccount($data)){
			$data = array (
			'impNumber' => $this->input->post('impNumber'),
			'financial_approval' => 'Approved',
			'financial_approval_date' => date('ymdhis'),
		);	
		
		if($this->fms_model->updateImprestRequest($data)){
				echo json_encode($data);
			}else{
				
			}
		}else{
			
		}
		
	}
	


	
	

	

	
	


}

?>