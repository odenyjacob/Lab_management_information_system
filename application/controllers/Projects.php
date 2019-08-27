<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Projects extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'projects_model', 'centers_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $concepts_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function projectsTable(){
		$data['title'] = 'PROJECTS || Table';
		$this->dashboard();
		$this->load->view('projects/projectsTable', $data);
	}
	
 
	
	function getprojectsTable(){
		$this->projects_model->getprojectsTable();
	}
	
 
	
	    // this for popup
    public function popupadd($id = '') {
        $this->id = $id;


        // fetch record from db when edit records
        $result = $this->projects_model->getProjectsId($this->id);
        $this->id = isset($result[0]['id']) ? $result[0]['id'] : "";
       	$this->branch = isset($result[0]['branch']) ? $result[0]['branch'] : "";
		$this->project = isset($result[0]['project']) ? $result[0]['project'] : ""; 
		$data['title'] = "Branches";
		$data['branches'] = $this->centers_model->getBranches();
       $this->load->view('projects/projects_form', $data); 
    }
 
	
	function submitProjects(){
       // $data = $_REQUEST;
	 	
		
		if($this->input->post('type')==='addProject'){
				$data = array(  
					'branch' => $this->input->post('branch'), 
					'project' => $this->input->post('project'), 
					'userName' => $this->session->userdata('userName'),
					'status' => 'initial',
				
				);
				
				if($this->projects_model->addProject($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					$output['success'] = 0;
           	 	 	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateProjects'){
				$data = array(
					'id' => $this->input->post('id'),
					'branch' => $this->input->post('branch'), 
					'project' => $this->input->post('project'), 
					'userName' => $this->session->userdata('userName'),
					'status' => 'updated',
				
				);
				
				if($this->projects_model->updateProjects($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
 
	
	function deleteProject(){
		$data = $_REQUEST;
        if($this->projects_model->deleteProject($data)){
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