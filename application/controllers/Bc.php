<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bc extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model', 'bc_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $bc_id = ''; 
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function bcTable(){
		$data['title'] = 'BLOOD CELL, PARASITE & CTNG || Table';
		$this->dashboard();
		$this->load->view('bc/bcTable', $data);
	}
	
	function getBcTable(){
		$this->bc_model->getBcTable();
	}
	
	    // this for popup 
    public function popupadd($bc_id = '') {
        $this->bc_id = $bc_id;


        // fetch record from db when edit records
        $result = $this->bc_model->getBcId($this->bc_id);
        $this->bc_id = isset($result[0]['bc_id']) ? $result[0]['bc_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->cycle = isset($result[0]['cycle']) ? $result[0]['cycle'] : "";
        $this->parameter = isset($result[0]['parameter']) ? $result[0]['parameter'] : "";
        $this->results = isset($result[0]['results']) ? $result[0]['results'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "EQA ELISA VIRAL MARKERS";
      // $this->dashboard();
       $this->load->view('bc/bc_form', $data);
    }
	
	
	function submitBc(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addBc'){
				$data = array(
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->bc_model->addBc($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateBc'){
				$data = array(
					'bc_id' => $this->input->post('bc_id'),
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->bc_model->updateBc($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteBc(){
		$data = $_REQUEST;
        if($this->bc_model->deleteBc($data)){
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
	

	function bc_graph(){
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		
		
		//Blood Cell ID
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Blood Cell ID'
		);
		$data['BloodCellIDav'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Blood Cell ID'
		);
		$data['BloodCellIDbv'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Blood Cell ID'
		);
		$data['BloodCellIDcv'] = $this->bc_model->getParamValue($search);
		
		
		//Blood Parasite ID
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Blood Parasite ID'
		);
		$data['BloodParasiteIDav'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Blood Parasite ID'
		);
		$data['BloodParasiteIDbv'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Blood Parasite ID'
		);
		$data['BloodParasiteIDcv'] = $this->bc_model->getParamValue($search);
		
		
		//Chlamydia trachomatis, NAA
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Chlamydia trachomatis, NAA'
		);
		$data['ChlamydiatrachomatisNAAav'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Chlamydia trachomatis, NAA'
		);
		$data['ChlamydiatrachomatisNAAbv'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Chlamydia trachomatis, NAA'
		);
		$data['ChlamydiatrachomatisNAAcv'] = $this->bc_model->getParamValue($search);
		
		//Neisseria gonorrhoeae, NAA
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Neisseria gonorrhoeae, NAA'
		);
		$data['NeisseriagonorrhoeaeNAAav'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Neisseria gonorrhoeae, NAA'
		);
		$data['NeisseriagonorrhoeaeNAAbv'] = $this->bc_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Neisseria gonorrhoeae, NAA'
		);
		$data['NeisseriagonorrhoeaeNAAcv'] = $this->bc_model->getParamValue($search);
		
				
		$data['title'] = 'CHART || BLOOD CELL,PARASITE&CTNG';
		
		$search = array(
				'year' => $year,
				'table_name' => 'BLOOD CELL,PARASITE&CTNG'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'BLOOD CELL,PARASITE&CTNG'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('bc/bc_graph', $data );//$this->view_data
	}



}

?>