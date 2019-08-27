<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hcm extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'hcm_model',));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
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
	
	function newEmployee(){
		$data['title'] = 'Add New Employee';
		$this->dashboard();
		$this->load->view('hcm/newEmployee', $data);
	}
	
	
	function pne(){ 
		// This function call from AJAX	
		$password = 'P@55w0rd';	
		$data = array(
		'FName' => $this->input->post('FName'),
		'MName'=>$this->input->post('MName'),
		'LName'=>$this->input->post('LName'),
		'empNumber'=>$this->input->post('empNumber'),
		'userName'=>$this->input->post('empNumber'),
		'phone'=>$this->input->post('phone'),
		'home_phone'=>$this->input->post('home_phone'),
		'email'=>$this->input->post('email'),
		'work_email'=>$this->input->post('work_email'),
		'pin_number'=>$this->input->post('pin_number'),
		'ssn'=>$this->input->post('ssn'),
		'identification_number'=>$this->input->post('identification_number'),
		'bank_account'=>$this->input->post('bank_account'),
		'dateofbirth'=>$this->input->post('dateofbirth'),
		'password' => $this->bcrypt->hash_password($password),
		);
		
		$data = $this->security->xss_clean($data);	 
		$empNumber = array(
			'empNumber'=>$this->input->post('empNumber'),
		);
		
		if($this->hcm_model->initializeAccess($empNumber)){
		 
		if($this->hcm_model->addEmp($data)){
			echo json_encode($data);
		
		}
		}
	}

	function viewTc(){
		
		$empNumber =array(
			'empNumber' => $this->input->post('empNumber'),
		); 
		if($data = $this->hcm_model->viewTc($empNumber)){
			foreach ($data as $row){
			echo json_encode($row);
			}
		}else{
			return false;
		}
	}
	

	
	function timecard(){
		$initialize = array(
				'empNumber' => $this->session->userdata('empNumber'),
				'status' => 'New Instance',
		);		
		$this->hcm_model->insertTimecard($initialize);
		$empNumber = $this->session->userdata('empNumber');
		$data['timecard'] = $this->hcm_model->getTimecard($empNumber);
		$data['title'] = 'ERP | Timecard';
		$this->dashboard();
		$this->load->view('hcm/timecard', $data);
	}

	function timecard_approved(){
		//Call from AJAX
		$data = array(
			'empNumber' =>$this->input->post('empNumber'),  
			'status' =>'Approved',
		);
		
		if($this->hcm_model->timecardStatus($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
	function leave_approved(){
		//Call from AJAX
		$data = array(
			'empNumber' =>$this->input->post('empNumber'),  
			'status' =>'Approved',
		);
		
		if($this->hcm_model->leaveStatus($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
	function timecard_rejected(){
		//Call from AJAX
		$data = array(
			'empNumber' =>$this->input->post('empNumber'),  
			'status' =>'Rejected',
		);
		
		if($this->hcm_model->timecardStatus($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
	function leave_rejected(){
		//Call from AJAX
		$data = array(
			'empNumber' =>$this->input->post('empNumber'),  
			'status' =>'Rejected',
		);
		
		if($this->hcm_model->leaveStatus($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
//To have multiple leaves pending approval means this code has to be slightly modified!	
	function sickleave_rejected(){
		//Call from AJAX
		$data = array(
			'empNumber' =>$this->input->post('empNumber'),  
			'balance_sick' =>$this->input->post('balance_sick'),  
			'status' =>'Rejected',
			'days_applied' =>'',
			'leave_type' =>'', 
			'leave_start' =>'', 
			'leave_end' =>'', 
		);
		
		if($this->hcm_model->leaveStatus($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
	function maternityleave_rejected(){
		//Call from AJAX
		$data = array(
			'empNumber' =>$this->input->post('empNumber'),  
			'balance_maternity' =>$this->input->post('balance_maternity'),  
			'status' =>'Rejected',
			'days_applied' =>'',
			'leave_type' =>'', 
			'leave_start' =>'', 
			'leave_end' =>'', 
		);
		
		if($this->hcm_model->leaveStatus($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
	function annualleave_rejected(){
		//Call from AJAX
		$data = array(
			'empNumber' =>$this->input->post('empNumber'),  
			'balance_annual' =>$this->input->post('balance_annual'),  
			'status' =>'Rejected',
			'days_applied' =>'',
			'leave_type' =>'', 
			'leave_start' =>'', 
			'leave_end' =>'', 
		);
		
		if($this->hcm_model->leaveStatus($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
	function pEditedTc(){ 
		// This function call from AJAX	
		$data = array(
		'available1' => $this->input->post('available1'),
		'available2' => $this->input->post('available2'),
		'available3' => $this->input->post('available3'),
		'available4' => $this->input->post('available4'),
		'available5' => $this->input->post('available5'),
		'available6' => $this->input->post('available6'),
		'available7' => $this->input->post('available7'),
		'available8' => $this->input->post('available8'),
		'available9' => $this->input->post('available9'),
		'available10' => $this->input->post('available10'),
		'available11' => $this->input->post('available11'),
		'available12' => $this->input->post('available12'),
		'available13' => $this->input->post('available13'),
		'available14' => $this->input->post('available14'),
		'available15' => $this->input->post('available15'),
		'available16' => $this->input->post('available16'),
		'available17' => $this->input->post('available17'),
		'available18' => $this->input->post('available18'),
		'available19' => $this->input->post('available19'),
		'available20' => $this->input->post('available20'),
		'available21' => $this->input->post('available21'),
		'available22' => $this->input->post('available22'),
		'available23' => $this->input->post('available23'),
		'available24' => $this->input->post('available24'),
		'available25' => $this->input->post('available25'),
		'available26' => $this->input->post('available26'),
		'available27' => $this->input->post('available27'),
		'available28' => $this->input->post('available28'),
		'available29' => $this->input->post('available29'),
		'available30' => $this->input->post('available30'),
		'available31' => $this->input->post('available31'),		
		'timeIn1' => $this->input->post('timeIn1'), 
		'timeIn2' => $this->input->post('timeIn2'),
		'timeIn3' => $this->input->post('timeIn3'),
		'timeIn4' => $this->input->post('timeIn4'),
		'timeIn5' => $this->input->post('timeIn5'),
		'timeIn6' => $this->input->post('timeIn6'),
		'timeIn7' => $this->input->post('timeIn7'),
		'timeIn8' => $this->input->post('timeIn8'),
		'timeIn9' => $this->input->post('timeIn9'),
		'timeIn10' => $this->input->post('timeIn10'),
		'timeIn11' => $this->input->post('timeIn11'),
		'timeIn12' => $this->input->post('timeIn12'),
		'timeIn13' => $this->input->post('timeIn13'),
		'timeIn14' => $this->input->post('timeIn14'),
		'timeIn15' => $this->input->post('timeIn15'),
		'timeIn16' => $this->input->post('timeIn16'),
		'timeIn17' => $this->input->post('timeIn17'),
		'timeIn18' => $this->input->post('timeIn18'),
		'timeIn19' => $this->input->post('timeIn19'),
		'timeIn20' => $this->input->post('timeIn20'),
		'timeIn21' => $this->input->post('timeIn21'),
		'timeIn22' => $this->input->post('timeIn22'),
		'timeIn23' => $this->input->post('timeIn23'),
		'timeIn24' => $this->input->post('timeIn24'),
		'timeIn25' => $this->input->post('timeIn25'),
		'timeIn26' => $this->input->post('timeIn26'),
		'timeIn27' => $this->input->post('timeIn27'),
		'timeIn28' => $this->input->post('timeIn28'),
		'timeIn29' => $this->input->post('timeIn29'),
		'timeIn30' => $this->input->post('timeIn30'),
		'timeIn31' => $this->input->post('timeIn31'),		
		'timeOut1' => $this->input->post('timeOut1'),
		'timeOut2' => $this->input->post('timeOut2'),
		'timeOut3' => $this->input->post('timeOut3'),
		'timeOut4' => $this->input->post('timeOut4'),
		'timeOut5' => $this->input->post('timeOut5'),
		'timeOut6' => $this->input->post('timeOut6'),
		'timeOut7' => $this->input->post('timeOut7'),
		'timeOut8' => $this->input->post('timeOut8'),
		'timeOut9' => $this->input->post('timeOut9'),
		'timeOut10' => $this->input->post('timeOut10'),
		'timeOut11' => $this->input->post('timeOut11'),
		'timeOut12' => $this->input->post('timeOut12'),
		'timeOut13' => $this->input->post('timeOut13'),
		'timeOut14' => $this->input->post('timeOut14'),
		'timeOut15' => $this->input->post('timeOut15'),
		'timeOut16' => $this->input->post('timeOut16'),
		'timeOut17' => $this->input->post('timeOut17'),
		'timeOut18' => $this->input->post('timeOut18'),
		'timeOut19' => $this->input->post('timeOut19'),
		'timeOut20' => $this->input->post('timeOut20'),
		'timeOut21' => $this->input->post('timeOut21'),
		'timeOut22' => $this->input->post('timeOut22'),
		'timeOut23' => $this->input->post('timeOut23'),
		'timeOut24' => $this->input->post('timeOut24'),
		'timeOut25' => $this->input->post('timeOut25'),
		'timeOut26' => $this->input->post('timeOut26'),
		'timeOut27' => $this->input->post('timeOut27'),
		'timeOut28' => $this->input->post('timeOut28'),
		'timeOut29' => $this->input->post('timeOut29'),
		'timeOut30' => $this->input->post('timeOut30'),
		'timeOut31' => $this->input->post('timeOut31'),		
		'remarks1' => $this->input->post('remarks1'),
		'remarks2' => $this->input->post('remarks2'),
		'remarks3' => $this->input->post('remarks3'),
		'remarks4' => $this->input->post('remarks4'),
		'remarks5' => $this->input->post('remarks5'),
		'remarks6' => $this->input->post('remarks6'),
		'remarks7' => $this->input->post('remarks7'),
		'remarks8' => $this->input->post('remarks8'),
		'remarks9' => $this->input->post('remarks9'),
		'remarks10' => $this->input->post('remarks10'),
		'remarks11' => $this->input->post('remarks11'),
		'remarks12' => $this->input->post('remarks12'),
		'remarks13' => $this->input->post('remarks13'),
		'remarks14' => $this->input->post('remarks14'),
		'remarks15' => $this->input->post('remarks15'),
		'remarks16' => $this->input->post('remarks16'),
		'remarks17' => $this->input->post('remarks17'),
		'remarks18' => $this->input->post('remarks18'),
		'remarks19' => $this->input->post('remarks19'),
		'remarks20' => $this->input->post('remarks20'),
		'remarks21' => $this->input->post('remarks21'),
		'remarks22' => $this->input->post('remarks22'),
		'remarks23' => $this->input->post('remarks23'),
		'remarks24' => $this->input->post('remarks24'),
		'remarks25' => $this->input->post('remarks25'),
		'remarks26' => $this->input->post('remarks26'),
		'remarks27' => $this->input->post('remarks27'),
		'remarks28' => $this->input->post('remarks28'),
		'remarks29' => $this->input->post('remarks29'),
		'remarks30' => $this->input->post('remarks30'),
		'remarks31' => $this->input->post('remarks31'),
		
		'status' => 'Pending Approval',
		'empNumber' => $this->session->userdata('empNumber'),
		);
		
		$data = $this->security->xss_clean($data);	 
		
		
		if($this->hcm_model->updateTimecard($data)){
			echo json_encode($data);
		
		}
		
	}

	function saveTc(){ 
		// This function call from AJAX	
		$data = array(
		'available1' => $this->input->post('available1'),
		'available2' => $this->input->post('available2'),
		'available3' => $this->input->post('available3'),
		'available4' => $this->input->post('available4'),
		'available5' => $this->input->post('available5'),
		'available6' => $this->input->post('available6'),
		'available7' => $this->input->post('available7'),
		'available8' => $this->input->post('available8'),
		'available9' => $this->input->post('available9'),
		'available10' => $this->input->post('available10'),
		'available11' => $this->input->post('available11'),
		'available12' => $this->input->post('available12'),
		'available13' => $this->input->post('available13'),
		'available14' => $this->input->post('available14'),
		'available15' => $this->input->post('available15'),
		'available16' => $this->input->post('available16'),
		'available17' => $this->input->post('available17'),
		'available18' => $this->input->post('available18'),
		'available19' => $this->input->post('available19'),
		'available20' => $this->input->post('available20'),
		'available21' => $this->input->post('available21'),
		'available22' => $this->input->post('available22'),
		'available23' => $this->input->post('available23'),
		'available24' => $this->input->post('available24'),
		'available25' => $this->input->post('available25'),
		'available26' => $this->input->post('available26'),
		'available27' => $this->input->post('available27'),
		'available28' => $this->input->post('available28'),
		'available29' => $this->input->post('available29'),
		'available30' => $this->input->post('available30'),
		'available31' => $this->input->post('available31'),		
		'timeIn1' => $this->input->post('timeIn1'),
		'timeIn2' => $this->input->post('timeIn2'),
		'timeIn3' => $this->input->post('timeIn3'),
		'timeIn4' => $this->input->post('timeIn4'),
		'timeIn5' => $this->input->post('timeIn5'),
		'timeIn6' => $this->input->post('timeIn6'),
		'timeIn7' => $this->input->post('timeIn7'),
		'timeIn8' => $this->input->post('timeIn8'),
		'timeIn9' => $this->input->post('timeIn9'),
		'timeIn10' => $this->input->post('timeIn10'),
		'timeIn11' => $this->input->post('timeIn11'),
		'timeIn12' => $this->input->post('timeIn12'),
		'timeIn13' => $this->input->post('timeIn13'),
		'timeIn14' => $this->input->post('timeIn14'),
		'timeIn15' => $this->input->post('timeIn15'),
		'timeIn16' => $this->input->post('timeIn16'),
		'timeIn17' => $this->input->post('timeIn17'),
		'timeIn18' => $this->input->post('timeIn18'),
		'timeIn19' => $this->input->post('timeIn19'),
		'timeIn20' => $this->input->post('timeIn20'),
		'timeIn21' => $this->input->post('timeIn21'),
		'timeIn22' => $this->input->post('timeIn22'),
		'timeIn23' => $this->input->post('timeIn23'),
		'timeIn24' => $this->input->post('timeIn24'),
		'timeIn25' => $this->input->post('timeIn25'),
		'timeIn26' => $this->input->post('timeIn26'),
		'timeIn27' => $this->input->post('timeIn27'),
		'timeIn28' => $this->input->post('timeIn28'),
		'timeIn29' => $this->input->post('timeIn29'),
		'timeIn30' => $this->input->post('timeIn30'),
		'timeIn31' => $this->input->post('timeIn31'),		
		'timeOut1' => $this->input->post('timeOut1'),
		'timeOut2' => $this->input->post('timeOut2'),
		'timeOut3' => $this->input->post('timeOut3'),
		'timeOut4' => $this->input->post('timeOut4'),
		'timeOut5' => $this->input->post('timeOut5'),
		'timeOut6' => $this->input->post('timeOut6'),
		'timeOut7' => $this->input->post('timeOut7'),
		'timeOut8' => $this->input->post('timeOut8'),
		'timeOut9' => $this->input->post('timeOut9'),
		'timeOut10' => $this->input->post('timeOut10'),
		'timeOut11' => $this->input->post('timeOut11'),
		'timeOut12' => $this->input->post('timeOut12'),
		'timeOut13' => $this->input->post('timeOut13'),
		'timeOut14' => $this->input->post('timeOut14'),
		'timeOut15' => $this->input->post('timeOut15'),
		'timeOut16' => $this->input->post('timeOut16'),
		'timeOut17' => $this->input->post('timeOut17'),
		'timeOut18' => $this->input->post('timeOut18'),
		'timeOut19' => $this->input->post('timeOut19'),
		'timeOut20' => $this->input->post('timeOut20'),
		'timeOut21' => $this->input->post('timeOut21'),
		'timeOut22' => $this->input->post('timeOut22'),
		'timeOut23' => $this->input->post('timeOut23'),
		'timeOut24' => $this->input->post('timeOut24'),
		'timeOut25' => $this->input->post('timeOut25'),
		'timeOut26' => $this->input->post('timeOut26'),
		'timeOut27' => $this->input->post('timeOut27'),
		'timeOut28' => $this->input->post('timeOut28'),
		'timeOut29' => $this->input->post('timeOut29'),
		'timeOut30' => $this->input->post('timeOut30'),
		'timeOut31' => $this->input->post('timeOut31'),		
		'remarks1' => $this->input->post('remarks1'),
		'remarks2' => $this->input->post('remarks2'),
		'remarks3' => $this->input->post('remarks3'),
		'remarks4' => $this->input->post('remarks4'),
		'remarks5' => $this->input->post('remarks5'),
		'remarks6' => $this->input->post('remarks6'),
		'remarks7' => $this->input->post('remarks7'),
		'remarks8' => $this->input->post('remarks8'),
		'remarks9' => $this->input->post('remarks9'),
		'remarks10' => $this->input->post('remarks10'),
		'remarks11' => $this->input->post('remarks11'),
		'remarks12' => $this->input->post('remarks12'),
		'remarks13' => $this->input->post('remarks13'),
		'remarks14' => $this->input->post('remarks14'),
		'remarks15' => $this->input->post('remarks15'),
		'remarks16' => $this->input->post('remarks16'),
		'remarks17' => $this->input->post('remarks17'),
		'remarks18' => $this->input->post('remarks18'),
		'remarks19' => $this->input->post('remarks19'),
		'remarks20' => $this->input->post('remarks20'),
		'remarks21' => $this->input->post('remarks21'),
		'remarks22' => $this->input->post('remarks22'),
		'remarks23' => $this->input->post('remarks23'),
		'remarks24' => $this->input->post('remarks24'),
		'remarks25' => $this->input->post('remarks25'),
		'remarks26' => $this->input->post('remarks26'),
		'remarks27' => $this->input->post('remarks27'),
		'remarks28' => $this->input->post('remarks28'),
		'remarks29' => $this->input->post('remarks29'),
		'remarks30' => $this->input->post('remarks30'),
		'remarks31' => $this->input->post('remarks31'),
		
		'status' => 'Under Editing',
		'empNumber' => $this->session->userdata('empNumber'),
		);
		
		$data = $this->security->xss_clean($data);	 
		
		
		if($this->hcm_model->updateTimecard($data)){ 
			echo json_encode($data);
		
		}		
	}

	function timecard_approvals(){
		$data = array(
			'empNumber' => $this->session->userdata('empNumber'),
		);
		$data['approvals'] =  $this->hcm_model->timecard_approvals($data);
		$data['title'] = 'ERP | Time-card Approvals';
		$this->dashboard();
		$this->load->view('hcm/timecard_approvals', $data);		
	}
	
	function leave_approvals(){
		$data = array(
			'empNumber' => $this->session->userdata('empNumber'),
		);
		$data['approvals'] =  $this->hcm_model->leave_approvals($data); 
		$data['title'] = 'ERP | Time-card Approvals';
		$this->dashboard();
		$this->load->view('hcm/leave_approvals', $data);		
	}
	
	function leave_application(){
		$user = $this->session->userdata('empNumber'); 
		$data['title'] = 'ERP | Leave Application';
		$data['ldays'] = $this->hcm_model->leave_days($user);	 	
		$this->dashboard();
		$this->load->view('hcm/leaveApplication', $data);
	}
	
	function apply_annual(){
		
		$data = array(
			'empNumber' => $this->session->userdata('empNumber'),
			'leave_type' => 'Annual',
			'days_applied' => $this->input->post('days_applied'),
			'leave_start' => $this->input->post('annual_start'),
			'leave_end' => $this->input->post('annual_end'),
			'balance_annual' => $this->input->post('balance_annual'),
			'status' => 'Pending Approval',
		);
		if($this->hcm_model->updateleave($data)){
			echo json_encode($data);
		}
	}
	
	function apply_maternity(){
		
		$data = array(
			'empNumber' => $this->session->userdata('empNumber'),
			'leave_type' => 'Maternity',
			'days_applied' => $this->input->post('days_applied'),
			'leave_start' => $this->input->post('leave_start'),
			'leave_end' => $this->input->post('leave_end'),
			'balance_maternity' => $this->input->post('balance_maternity'), 
			'status' => 'Pending Approval', 
		);
		if($this->hcm_model->updateleave($data)){
			echo json_encode($data);
		}
	}
	
	function apply_sick(){ 
		
		$data = array(
			'empNumber' => $this->session->userdata('empNumber'),
			'leave_type' => 'Sick',
			'days_applied' => $this->input->post('days_applied'),
			'leave_start' => $this->input->post('leave_start'),
			'leave_end' => $this->input->post('leave_end'),
			'balance_sick' => $this->input->post('balance_sick'),
			'status' => 'Pending Approval',
		);
		if($this->hcm_model->updateleave($data)){
			echo json_encode($data);
		}
	}
	


	


}

?>