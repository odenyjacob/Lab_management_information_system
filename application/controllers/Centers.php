<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Centers extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'centers_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $concepts_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function centersTable(){
		$data['title'] = 'CENTERS || Table';
		$this->dashboard();
		$this->load->view('centers/centersTable', $data);
	}
	function branchesTable(){
		$data['title'] = 'BRANCHES || Table';
		$this->dashboard();
		$this->load->view('centers/branchesTable', $data);
	}
 
	function getCentersTable(){
		$this->centers_model->getCentersTable();
	}
	
	function getBranchesTable(){
		$this->centers_model->getBranchesTable();
	}
	
	    // this for popup
    public function popupadd($id = '') {
        $this->id = $id;


        // fetch record from db when edit records
        $result = $this->centers_model->getCentersId($this->id);
        $this->id = isset($result[0]['id']) ? $result[0]['id'] : "";
       	$this->location = isset($result[0]['location']) ? $result[0]['location'] : "";
        $this->name = isset($result[0]['name']) ? $result[0]['name'] : ""; 

       $data['title'] = "Add New Center"; 
       $this->load->view('centers/centers_form', $data); 
	}
	
    public function branch_popupadd($id = '') {
        $this->id = $id;


        // fetch record from db when edit records
        $result = $this->centers_model->getBranchesId($this->id);
        $this->id = isset($result[0]['id']) ? $result[0]['id'] : "";
       	$this->branch = isset($result[0]['branch']) ? $result[0]['branch'] : "";
        $this->center = isset($result[0]['center']) ? $result[0]['center'] : ""; 

	   $data['title'] = "Add New Center"; 
	   $data['centers'] = $this->centers_model->getCenters();
       $this->load->view('centers/branches_form', $data); 
    }
 
	
	function submitCenter(){
       // $data = $_REQUEST;
	 	
		
		if($this->input->post('type')==='addCenter'){
				$data = array( 
					'name' => $this->input->post('name'), 
					'location' => $this->input->post('location'), 
					'username' => $this->session->userdata('userName'),
					'status' => 'initial',
				
				);
				
				if($this->centers_model->addCenter($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateCenter'){
				$data = array(
					'id' => $this->input->post('id'),
					'name' => $this->input->post('name'), 
					'location' => $this->input->post('location'), 
					'username' => $this->session->userdata('userName'),
					'status' => 'updated',
				
				);
				
				if($this->centers_model->updateCenter($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}

	function submitBranch(){
       // $data = $_REQUEST;
	 	
		
		if($this->input->post('type')==='addBranch'){
				$data = array( 
					'center' => $this->input->post('center'),  
					'branch' => $this->input->post('branch'),  
					'userName' => $this->session->userdata('userName'),
					'status' => 'initial',
				
				);
				
				if($this->centers_model->addBranch($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateBranch'){
				$data = array(
					'id' => $this->input->post('id'),
					'center' => $this->input->post('center'),  
					'branch' => $this->input->post('branch'),  
					'userName' => $this->session->userdata('userName'),
					'status' => 'updated',
				
				);
				
				if($this->centers_model->updateBranch($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteCenter(){
		$data = $_REQUEST;
        if($this->centers_model->deleteCenters($data)){
        	 $output['success'] = 1;
        	 $output['msg'] = "Records deleted successfully";
        
        	echo json_encode($output);
        }else{
        	$output['success'] = 0;
        	 $output['msg'] = "Error: Records not deleted! Try again";
        }        
      
	}

	function deleteBranch(){
		$data = $_REQUEST;
        if($this->centers_model->deleteBranch($data)){
        	 $output['success'] = 1;
        	 $output['msg'] = "Records deleted successfully";
        
        	echo json_encode($output);
        }else{
        	$output['success'] = 0;
        	 $output['msg'] = "Error: Records not deleted! Try again";
        }        
      
	}
 
	
}

?>