<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'users_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $concepts_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function users(){
		$data['title'] = 'Users Table';
		$this->dashboard();
		$this->load->view('users/usersTable');
	}

	
	function getUsersTable(){
		$this->users_model->getUsersTable();
	}
	
	    // for handling user actions
    public function popupadd($id = '') {
        $this->id = $id;


        // fetch record from db when edit records
        $result = $this->users_model->getUserId($this->id);
        $this->id = isset($result[0]['id']) ? $result[0]['id'] : "";
       	$this->FName = isset($result[0]['FName']) ? $result[0]['FName'] : "";
        $this->LName = isset($result[0]['LName']) ? $result[0]['LName'] : ""; 
        $this->userName = isset($result[0]['userName']) ? $result[0]['userName'] : ""; 

       $data['title'] = "Add New User"; 
       $this->load->view('users/users_form', $data); 
	}
 	
	function submitUser(){
       // $data = $_REQUEST;
	 	
		
		if($this->input->post('type')==='addUser'){

				$password = "P@55w0rd";
				$data = array( 
					'FName' => $this->input->post('FName'), 
					'LName' => $this->input->post('LName'),
					'userName' => $this->input->post('userName'),
					'password' => $this->bcrypt->hash_password($password),
					'empNumber' => $this->input->post('userName')
				
				);
				
				if($this->users_model->addUser($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateUser'){
				$data = array(
					'id' => $this->input->post('id'),
					'FName' => $this->input->post('FName'), 
					'LName' => $this->input->post('LName'),
					'userName' => $this->input->post('userName'),
					'empNumber' => $this->input->post('userName')
				
				);
				
				if($this->users_model->updateUser($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
 	
	function deleteUser(){
		$data = $_REQUEST;
        if($this->users_model->deleteUser($data)){
        	 $output['success'] = 1;
        	 $output['msg'] = "Records deleted successfully";
        
        	echo json_encode($output);
        }else{
        	$output['success'] = 0;
        	 $output['msg'] = "Error: user not deleted! Try again";
        }        
      
	} 
	
}

?>