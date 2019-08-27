<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Eqa extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model', 'eqa_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $eqa_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function eqaTable(){
		$data['title'] = 'EQA CHEMISTRY || Table';
		$this->dashboard();
		$this->load->view('eqa/eqaTable', $data);
	}
	
	function getEqaTable(){
		$this->eqa_model->getEqaTable();
	}
	
	    // this for popup
    public function popupadd($eqa_id = '') {
        $this->eqa_id = $eqa_id;


        // fetch record from db when edit records
        $result = $this->eqa_model->getEqaId($this->eqa_id);
        $this->iqc_id = isset($result[0]['iqc_id']) ? $result[0]['iqc_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->cycle = isset($result[0]['cycle']) ? $result[0]['cycle'] : "";
        $this->parameter = isset($result[0]['parameter']) ? $result[0]['parameter'] : "";
        $this->results = isset($result[0]['results']) ? $result[0]['results'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "EQA CHEMISTRY";
      // $this->dashboard();
       $this->load->view('eqa/eqa_form', $data);
    }
	
	
	function submitEqa(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addEqa'){
				$data = array(
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->eqa_model->addEqa($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateEqa'){
				$data = array(
					'eqa_id' => $this->input->post('eqa_id'),
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->eqa_model->updateEqa($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteEqa(){
		$data = $_REQUEST;
        if($this->eqa_model->deleteEqa($data)){
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
	

	function eqa_graph(){
		
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		//ALT
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'ALT'
		);
		$data['ALTav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'ALT'
		);
		$data['ALTbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'ALT'
		);
		$data['ALTcv'] = $this->eqa_model->getParamValue($search);
		
		/*
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'ALT'
		);
		$data['ALTat'] = $this->eqa_model->getParamTarget($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'ALT'
		);
		$data['ALTbt'] = $this->eqa_model->getParamTarget($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'ALT'
		);
		$data['ALTct'] = $this->eqa_model->getParamTarget($search);
			
		 * 
		 */	
		 
		 
		 //AST
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'AST'
		);
		$data['ASTav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Albumin'
		);
		$data['ASTbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Albumin'
		);
		$data['ASTcv'] = $this->eqa_model->getParamValue($search);
		
		 //Albumin
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Albumin'
		);
		$data['Albuminav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Albumin'
		);
		$data['Albuminbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Albumin'
		);
		$data['Albumincv'] = $this->eqa_model->getParamValue($search);
		
		 //Alkaline Phosphatase
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Alkaline Phosphatase'
		);
		$data['AlkalinePhosphataseav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Alkaline Phosphatase'
		);
		$data['AlkalinePhosphatasebv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Alkaline Phosphatase'
		);
		$data['AlkalinePhosphatasecv'] = $this->eqa_model->getParamValue($search);
		
		 //Bilirubin, Total
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Bilirubin, Total'
		);
		$data['BilirubinTotalav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Bilirubin, Total'
		);
		$data['BilirubinTotalbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Bilirubin, Total'
		);
		$data['BilirubinTotalcv'] = $this->eqa_model->getParamValue($search);
		
		
		
		 //C02
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'C02'
		);
		$data['C02av'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'C02'
		);
		$data['C02bv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'C02'
		);
		$data['C02cv'] = $this->eqa_model->getParamValue($search);
		
		 //Calcium
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Calcium'
		);
		$data['Calciumav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Calcium'
		);
		$data['Calciumbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Calcium'
		);
		$data['Calciumcv'] = $this->eqa_model->getParamValue($search);
		
		
		
		 //Chloride
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Chloride'
		);
		$data['Chlorideav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Chloride'
		);
		$data['Chloridebv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Chloride'
		);
		$data['Chloridecv'] = $this->eqa_model->getParamValue($search);
				
		 //Cholesteral HDL
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Cholesteral HDL'
		);
		$data['CholesteralHDLav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Cholesteral HDL'
		);
		$data['CholesteralHDLbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Cholesteral HDL'
		);
		$data['CholesteralHDLcv'] = $this->eqa_model->getParamValue($search);
		
		
		 //Cholesteral LDL Measured
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Cholesteral LDL Measured'
		);
		$data['CholesteralLDLMeasuredav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Cholesteral LDL Measured'
		);
		$data['CholesteralLDLMeasuredbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Cholesteral LDL Measured'
		);
		$data['CholesteralLDLMeasuredcv'] = $this->eqa_model->getParamValue($search);
		
		 //Cholesteral Total
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Cholesteral - Total'
		);
		$data['CholesteralTotalav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Cholesteral - Total'
		);
		$data['CholesteralTotalbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Cholesteral - Total'
		);
		$data['CholesteralTotalcv'] = $this->eqa_model->getParamValue($search);
		
		
		
		 //Creatinine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Creatinine'
		);
		$data['Creatinineav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Creatinine'
		);
		$data['Creatininebv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Creatinine'
		);
		$data['Creatininecv'] = $this->eqa_model->getParamValue($search);
		 
		 //Creatinine Kinase
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Creatinine Kinase'
		);
		$data['CreatinineKinaseav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Creatinine Kinase'
		);
		$data['CreatinineKinasebv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Creatinine Kinase'
		);
		$data['CreatinineKinasecv'] = $this->eqa_model->getParamValue($search);
		 
		 //FSH
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'FSH'
		);
		$data['FSHav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'FSH'
		);
		$data['FSHbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'FSH'
		);
		$data['FSHcv'] = $this->eqa_model->getParamValue($search);
				
		 //Glucose
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Glucose'
		);
		$data['Glucoseav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Glucose'
		);
		$data['Glucosebv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Glucose'
		);
		$data['Glucosecv'] = $this->eqa_model->getParamValue($search);
				
		 //Lactate
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Lactate'
		);
		$data['Lactateav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Lactate'
		);
		$data['Lactatebv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Lactate'
		);
		$data['Lactatecv'] = $this->eqa_model->getParamValue($search);
		
		 //Lipase
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Lipase'
		);
		$data['Lipaseav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Lipase'
		);
		$data['Lipasebv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Lipase'
		);
		$data['Lipasecv'] = $this->eqa_model->getParamValue($search);
		
		
		
		 //Phosphorus
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Phosphorus'
		);
		$data['Phosphorusav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Phosphorus'
		);
		$data['Phosphorusbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Phosphorus'
		);
		$data['Phosphoruscv'] = $this->eqa_model->getParamValue($search);
		
		
		
		 //Potassium
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Potassium'
		);
		$data['Potassiumav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Potassium'
		);
		$data['Potassiumbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Potassium'
		);
		$data['Potassiumcv'] = $this->eqa_model->getParamValue($search);
				
		 //Protein, Total
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Protein, Total'
		);
		$data['ProteinTotalav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Protein, Total'
		);
		$data['ProteinTotalbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Protein, Total'
		);
		$data['ProteinTotalcv'] = $this->eqa_model->getParamValue($search);
		
				
		 //Sodium
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Sodium'
		);
		$data['Sodiumav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Sodium'
		);
		$data['Sodiumbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Sodium'
		);
		$data['Sodiumcv'] = $this->eqa_model->getParamValue($search);
		
		 //Triglycerides
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Triglycerides'
		);
		$data['Triglyceridesav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Triglycerides'
		);
		$data['Triglyceridesbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Triglycerides'
		);
		$data['Triglyceridescv'] = $this->eqa_model->getParamValue($search);
		
		
		
		 //Urea Nitrogen (BUN)
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Urea Nitrogen (BUN)'
		);
		$data['UreaNitBunav'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Urea Nitrogen (BUN)'
		);
		$data['UreaNitBunbv'] = $this->eqa_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Urea Nitrogen (BUN)'
		);
		$data['UreaNitBuncv'] = $this->eqa_model->getParamValue($search);
		
				
		$data['title'] = 'CHART || EQA CHEMISTRY';
		
		$search = array(
				'year' => $year,
				'table_name' => 'EQA-CHEMISTRY'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'EQA-CHEMISTRY'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('eqa/graphs', $data );//$this->view_data
	}
	



}

?>