<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Elisa extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model', 'elisa_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $elisa_id = ''; 
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function elisaTable(){
		$data['title'] = 'EQA ELISA VIRAL MARKERS || Table';
		$this->dashboard();
		$this->load->view('eqa/elisaTable', $data);
	}
	
	function getElisaTable(){
		$this->elisa_model->getElisaTable();
	}
	
	    // this for popup 
    public function popupadd($elisa_id = '') {
        $this->elisa_id = $elisa_id;


        // fetch record from db when edit records
        $result = $this->elisa_model->getElisaId($this->elisa_id);
        $this->elisa_id = isset($result[0]['elisa_id']) ? $result[0]['elisa_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->cycle = isset($result[0]['cycle']) ? $result[0]['cycle'] : "";
        $this->parameter = isset($result[0]['parameter']) ? $result[0]['parameter'] : "";
        $this->results = isset($result[0]['results']) ? $result[0]['results'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "EQA ELISA VIRAL MARKERS";
      // $this->dashboard();
       $this->load->view('eqa/elisa_form', $data);
    }
	
	
	function submitElisa(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addElisa'){
				$data = array(
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->elisa_model->addElisa($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateElisa'){
				$data = array(
					'elisa_id' => $this->input->post('elisa_id'),
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->elisa_model->updateElisa($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteElisa(){
		$data = $_REQUEST;
        if($this->elisa_model->deleteElisa($data)){
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
	

	function elisa_graph(){
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		
		//Anti-HIV-1/2
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HIV-1/2'
		);
		$data['AntiHIVhalfav'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HIV-1/2'
		);
		$data['AntiHIVhalfbv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HIV-1/2'
		);
		$data['AntiHIVhalfcv'] = $this->elisa_model->getParamValue($search);
		
		
		//Anti-HBc (Total)
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HBc (Total)'
		);
		$data['AntiHBcTotalav'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HBc (Total)'
		);
		$data['AntiHBcTotalbv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HBc (Total)'
		);
		$data['AntiHBcTotalcv'] = $this->elisa_model->getParamValue($search);
		
		
		//Anti-HCV
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HCV'
		);
		$data['AntiHCVav'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HCV'
		);
		$data['AntiHCVbv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HCV'
		);
		$data['AntiHCVcv'] = $this->elisa_model->getParamValue($search);
		
		
		//Anti-HIV-1 (Mtd 1)
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HIV-1 (Mtd 1)'
		);
		$data['AntiHIV1Mtd1av'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HIV-1 (Mtd 1)'
		);
		$data['AntiHIV1Mtd1bv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HIV-1 (Mtd 1)'
		);
		$data['AntiHIV1Mtd1cv'] = $this->elisa_model->getParamValue($search);
		
		
		//Anti-HIV-1 (Mtd 2)
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HIV-1 (Mtd 2)'
		);
		$data['AntiHIV1Mtd2av'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HIV-1 (Mtd 2)'
		);
		$data['AntiHIV1Mtd2bv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HIV-1 (Mtd 2)'
		);
		$data['AntiHIV1Mtd2cv'] = $this->elisa_model->getParamValue($search);
		
		
		//Anti-HIV-1 WB Proteins
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HIV-1 WB Proteins'
		);
		$data['AntiHIV1WBProteinsav'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HIV-1 WB Proteins'
		);
		$data['AntiHIV1WBProteinsbv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HIV-1 WB Proteins'
		);
		$data['AntiHIV1WBProteinscv'] = $this->elisa_model->getParamValue($search);
		
		
		//Anti-HIV-1 WB, Result
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HIV-1 WB, Result'
		);
		$data['AntiHIV1WBResultav'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HIV-1 WB, Result'
		);
		$data['AntiHIV1WBResultbv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HIV-1 WB, Result'
		);
		$data['AntiHIV1WBResultcv'] = $this->elisa_model->getParamValue($search);
		
		
		//HBeAg
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'HBeAg'
		);
		$data['HBeAgav'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'HBeAg'
		);
		$data['HBeAgbv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'HBeAg'
		);
		$data['HBeAgcv'] = $this->elisa_model->getParamValue($search);
		
		
		//HBsAg
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'HBsAg'
		);
		$data['HBsAgav'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'HBsAg'
		);
		$data['HBsAgbv'] = $this->elisa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'HBsAg'
		);
		$data['HBsAgcv'] = $this->elisa_model->getParamValue($search);
		
		
		
		$data['title'] = 'CHART || EQA ELISA MARKERS';
		
		$search = array(
				'year' => $year,
				'table_name' => 'EQA-ELISA VIRAL MARKERS'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'EQA-ELISA VIRAL MARKERS'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('eqa/elisa_graph', $data );//$this->view_data
	}
	



}
	//No code here!
?>