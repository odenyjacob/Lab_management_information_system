<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Satisfaction extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model', 'satisfaction_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $satisfaction_id = ''; 
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function satisfactionTable(){
		$data['title'] = 'CUSTOMER SATISFACTION || Table';
		$this->dashboard();
		$this->load->view('satisfaction/satisfactionTable', $data);
	}
	
	function getSatisfactionTable(){
		$this->satisfaction_model->getSatisfactionTable();
	}
	
	    // this for popup 
    public function popupadd($satisfaction_id = '') {
        $this->satisfaction_id = $satisfaction_id;


        // fetch record from db when edit records
        $result = $this->satisfaction_model->getSatisfactionId($this->satisfaction_id);
        $this->satisfaction_id = isset($result[0]['satisfaction_id']) ? $result[0]['satisfaction_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->expectation_met = isset($result[0]['expectation_met']) ? $result[0]['expectation_met'] : "";
        $this->expectation_not_met = isset($result[0]['expectation_not_met']) ? $result[0]['expectation_not_met'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "CUSTOMER SATISFACTION";
      // $this->dashboard();
       $this->load->view('satisfaction/satisfaction_form', $data);
    }
	
	
	function submitSatisfaction(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addSatisfaction'){
				$data = array(
					'year' => $this->input->post('year'),
					'expectation_met' => $this->input->post('expectation_met'),
					'expectation_not_met' => $this->input->post('expectation_not_met'),
					'number_interviewed' => $this->input->post('expectation_met')+$this->input->post('expectation_not_met'),
					'pc_expectation_met' => 100*($this->input->post('expectation_met') /($this->input->post('expectation_met')+$this->input->post('expectation_not_met'))),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->satisfaction_model->addSatisfaction($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateSatisfaction'){
				$data = array(
					'satisfaction_id' => $this->input->post('satisfaction_id'),
					'year' => $this->input->post('year'),
					'expectation_met' => $this->input->post('expectation_met'),
					'expectation_not_met' => $this->input->post('expectation_not_met'),
					'number_interviewed' => $this->input->post('expectation_met')+$this->input->post('expectation_not_met'),
					'pc_expectation_met' => 100*($this->input->post('expectation_met') /($this->input->post('expectation_met')+$this->input->post('expectation_not_met'))),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->satisfaction_model->updateSatisfaction($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteSatisfaction(){
		$data = $_REQUEST;
        if($this->satisfaction_model->deleteSatisfaction($data)){
        	 $output['success'] = 1;
        	 $output['msg'] = "Records deleted successfully";
        
        	echo json_encode($output);
        }else{
        	 $output['success'] = 0;
        	 $output['msg'] = "Error: Records not deleted! Try again";
        }        
      
	}

	// welcome
	function welcome(){
		$this->load->view('welcome_message');
	}
	//Showing success page
	function success(){
		$this->load->view('success');
	}
	function dberror(){

		$this->dashboard(); 
		$this->load->view('dberror');
	}
	

	function satisfaction_graph(){
		$year = array(
			'year' => $this->uri->segment(3),
		);
				
		$this->view_data = array();
		
		$series_data[] = array('name' => 'EXPECTATIONS', 'colorByPoint' => true,  'data'=> array(['name' => '% EXPECTATIONS MET', 'y' => floatval($this->satisfaction_model->getExpectationMet($year)), 'selected' => true],['name'=> '% TARGET', 'y'=> floatval($this->satisfaction_model->getTarget($year)) ]));
		
		$search = array(
				'year' => $this->uri->segment(3),
				'table_name' => 'CUSTOMER SATISFACTION'
		);
		$this->view_data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'CUSTOMER SATISFACTION'
		);
		$this->view_data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->view_data['series_data'] = json_encode($series_data); 
		$this->view_data['year'] = $this->uri->segment(3); 

		$this->load->view('satisfaction/graphs', $this->view_data);
	}
	



}

?>