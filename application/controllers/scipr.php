<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scipr extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'scipr_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	 
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function scienceProjectsTable(){
		$data['title'] = 'SCIENCE PROJECTS || Table';
		$this->dashboard();
		$this->load->view('scipr/sciprTable', $data);
	}
	
	function getSciPrTable(){
		$this->scipr_model->getSciPrTable();
	}
	
	    // this for popup
    public function popupadd($scipr_id = '') {
        $this->scipr_id = $scipr_id;


        // fetch record from db when edit records
        $result = $this->scipr_model->getSciPrId($this->scipr_id);
        $this->scipr_id = isset($result[0]['scipr_id']) ? $result[0]['scipr_id'] : ""; 
        $this->scipr_name = isset($result[0]['scipr_name']) ? $result[0]['scipr_name'] : ""; 
        $this->shortcode = isset($result[0]['shortcode']) ? $result[0]['shortcode'] : ""; 
       	$data['title'] = "Add New Science Project";
      // $this->dashboard();
       $this->load->view('scipr/scipr_form', $data); 
    }
	
	
	function submitScipr(){
       // $data = $_REQUEST;
	 	
		
		if($this->input->post('type')==='addSciPr'){
				$data = array( 
					'scipr_name' => $this->input->post('scipr_name'), 
					'shortcode' => $this->input->post('shortcode'), 
					'username' => $this->session->userdata('userName'),
					'status' => 'initial',
				
				);
				
				if($this->scipr_model->addSciPr($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateSciPr'){
				$data = array(
					'scipr_id' => $this->input->post('scipr_id'),
					'scipr_name' => $this->input->post('scipr_name'), 
					'shortcode' => $this->input->post('shortcode'), 
					'username' => $this->session->userdata('userName'),
					'status' => 'updated',
				
				);
				
				if($this->scipr_model->updateSciPr($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteSciPr(){
		$data = $_REQUEST;
        if($this->scipr_model->deleteSciPr($data)){
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