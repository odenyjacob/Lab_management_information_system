<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hematology extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model', 'hematology_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $hematology_id = ''; 
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function hematologyTable(){
		$data['title'] = 'EQA HEMATOLOGY || Table';
		$this->dashboard();
		$this->load->view('eqa/hematologyTable', $data);
	}
	
	function getHematologyTable(){
		$this->hematology_model->getHematologyTable();
	}
	
	    // this for popup 
    public function popupadd($hematology_id = '') {
        $this->hematology_id = $hematology_id;


        // fetch record from db when edit records
        $result = $this->hematology_model->getHematologyId($this->hematology_id);
        $this->hematology_id = isset($result[0]['hematology_id']) ? $result[0]['hematology_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->cycle = isset($result[0]['cycle']) ? $result[0]['cycle'] : "";
        $this->parameter = isset($result[0]['parameter']) ? $result[0]['parameter'] : "";
        $this->results = isset($result[0]['results']) ? $result[0]['results'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "EQA HEMATOLOGY";
      // $this->dashboard();
       $this->load->view('eqa/hematology_form', $data);
    }
	
	
	function submitHematology(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addHematology'){
				$data = array(
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->hematology_model->addHematology($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateHematology'){
				$data = array(
					'hematology_id' => $this->input->post('hematology_id'),
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->hematology_model->updateHematology($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteHematology(){
		$data = $_REQUEST;
        if($this->hematology_model->deleteHematology($data)){
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
	
	function hematology_graph(){
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		
		//Basophils %
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Basophils %'
		);
		$data['Basophilspcav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Basophils %'
		);
		$data['Basophilspcbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Basophils %'
		);
		$data['Basophilspccv'] = $this->hematology_model->getParamValue($search);

		
		//Basophils Absolute
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Basophils Absolute'
		);
		$data['BasophilsAbsoluteav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Basophils Absolute'
		);
		$data['BasophilsAbsolutebv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Basophils Absolute'
		);
		$data['BasophilsAbsolutecv'] = $this->hematology_model->getParamValue($search);

		
		//Eosinophils %
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Eosinophils %'
		);
		$data['Eosinophilspcav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Eosinophils %'
		);
		$data['Eosinophilspcbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Eosinophils %'
		);
		$data['Eosinophilspccv'] = $this->hematology_model->getParamValue($search);

		
		//Eosinophils Absolute
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Eosinophils Absolute'
		);
		$data['EosinophilsAbsoluteav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Eosinophils Absolute'
		);
		$data['EosinophilsAbsolutebv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Eosinophils Absolute'
		);
		$data['EosinophilsAbsolutecv'] = $this->hematology_model->getParamValue($search);

		
		//Hematocrit
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Hematocrit'
		);
		$data['Hematocritav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Hematocrit'
		);
		$data['Hematocritbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Hematocrit'
		);
		$data['Hematocritcv'] = $this->hematology_model->getParamValue($search);

		
		//Hemoglobin
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Hemoglobin'
		);
		$data['Hemoglobinav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Hemoglobin'
		);
		$data['Hemoglobinbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Hemoglobin'
		);
		$data['Hemoglobincv'] = $this->hematology_model->getParamValue($search);

		
		//Lymphocytes %
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Lymphocytes %'
		);
		$data['Lymphocytespcav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Lymphocytes %'
		);
		$data['Lymphocytespcbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Lymphocytes %'
		);
		$data['Lymphocytespccv'] = $this->hematology_model->getParamValue($search);

		
		//Lymphs Absolute
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Lymphs Absolute'
		);
		$data['LymphsAbsoluteav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Lymphs Absolute'
		);
		$data['LymphsAbsolutebv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Lymphs Absolute'
		);
		$data['LymphsAbsolutecv'] = $this->hematology_model->getParamValue($search);

		
		//MCV
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'MCV'
		);
		$data['MCVav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'MCV'
		);
		$data['MCVbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'MCV'
		);
		$data['MCVcv'] = $this->hematology_model->getParamValue($search);

		
		//Monocytes %
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Monocytes %'
		);
		$data['Monocytespcav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Monocytes %'
		);
		$data['Monocytespcbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Monocytes %'
		);
		$data['Monocytespccv'] = $this->hematology_model->getParamValue($search);

		
		//Monocytes Absolute
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Monocytes Absolute'
		);
		$data['MonocytesAbsoluteav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Monocytes Absolute'
		);
		$data['MonocytesAbsolutebv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Monocytes Absolute'
		);
		$data['MonocytesAbsolutecv'] = $this->hematology_model->getParamValue($search);

		
		//Neut/Gran %
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Neut/Gran %'
		);
		$data['NeutGranpcav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Neut/Gran %'
		);
		$data['NeutGranpcbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Neut/Gran %'
		);
		$data['NeutGranpccv'] = $this->hematology_model->getParamValue($search);

		
		//Neut/Gran Absolute
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Neut/Gran Absolute'
		);
		$data['NeutGranAbsoluteav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Neut/Gran Absolute'
		);
		$data['NeutGranAbsolutebv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Neut/Gran Absolute'
		);
		$data['NeutGranAbsolutecv'] = $this->hematology_model->getParamValue($search);

		
		//Platelet Count
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Platelet Count'
		);
		$data['PlateletCountav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Platelet Count'
		);
		$data['PlateletCountbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Platelet Count'
		);
		$data['PlateletCountcv'] = $this->hematology_model->getParamValue($search);

		
		//RBC
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'RBC'
		);
		$data['RBCav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'RBC'
		);
		$data['RBCbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'RBC'
		);
		$data['RBCcv'] = $this->hematology_model->getParamValue($search);

		
		//WBC
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'WBC'
		);
		$data['WBCav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'WBC'
		);
		$data['WBCbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'WBC'
		);
		$data['WBCcv'] = $this->hematology_model->getParamValue($search);

		
		//MCH
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'MCH'
		);
		$data['MCHav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'MCH'
		);
		$data['MCHbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'MCH'
		);
		$data['MCHcv'] = $this->hematology_model->getParamValue($search);

		
		//MCHC
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'MCHC'
		);
		$data['MCHCav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'MCHC'
		);
		$data['MCHCbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'MCHC'
		);
		$data['MCHCcv'] = $this->hematology_model->getParamValue($search);
		
		//RDW
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'RDW'
		);
		$data['RDWav'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'RDW'
		);
		$data['RDWbv'] = $this->hematology_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'RDW'
		);
		$data['RDWcv'] = $this->hematology_model->getParamValue($search);

		
		$data['title'] = 'CHART || EQA HEMATOLOGY';
		
		$search = array(
				'year' => $year,
				'table_name' => 'EQA-HEMATOLOGY'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'EQA-HEMATOLOGY'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('eqa/hematology_graph', $data );//$this->view_data
	}
	


//No more codes below this line.
}
?>