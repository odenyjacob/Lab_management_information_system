<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Urinalysis extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model', 'urinalysis_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $urinalysis_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function urinalysisTable(){
		$data['title'] = 'EQA URINALYSIS & CLINICAL MICRO || Table';
		$this->dashboard();
		$this->load->view('eqa/urinalysisTable', $data);
	}
	
	function getUrinalysisTable(){
		$this->urinalysis_model->getUrinalysisTable();
	}
	
	    // this for popup 
    public function popupadd($urinalysis_id = '') {
        $this->urinalysis_id = $urinalysis_id;


        // fetch record from db when edit records
        $result = $this->urinalysis_model->geturinalysisId($this->urinalysis_id);
        $this->urinalysis_id = isset($result[0]['urinalysis_id']) ? $result[0]['urinalysis_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->cycle = isset($result[0]['cycle']) ? $result[0]['cycle'] : "";
        $this->parameter = isset($result[0]['parameter']) ? $result[0]['parameter'] : "";
        $this->results = isset($result[0]['results']) ? $result[0]['results'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "EQA URINALYSIS & CLINICAL MICRO";
      // $this->dashboard();
       $this->load->view('eqa/urinalysis_form', $data);
    }
	
	
	function submitUrinalysis(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addUrinalysis'){
				$data = array(
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->urinalysis_model->addUrinalysis($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateUrinalysis'){
				$data = array(
					'urinalysis_id' => $this->input->post('urinalysis_id'),
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->urinalysis_model->updateUrinalysis($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteUrinalysis(){
		$data = $_REQUEST;
        if($this->urinalysis_model->deleteUrinalysis($data)){
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
	

	function urinalysis_graph(){
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		
		//Blood/Hgb, Urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Blood/Hgb, Urine'
		);
		$data['BloodUrineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Blood/Hgb, Urine'
		);
		$data['BloodUrinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Blood/Hgb, Urine'
		);
		$data['BloodUrinecv'] = $this->urinalysis_model->getParamValue($search);
		
		//Bilirubin, Urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Bilirubin, Urine'
		);
		$data['BilirubinUrineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Bilirubin, Urine'
		);
		$data['BilirubinUrinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Bilirubin, Urine'
		);
		$data['BilirubinUrinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Glucose, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Glucose, urine'
		);
		$data['Glucoseurineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Glucose, urine'
		);
		$data['Glucoseurinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Glucose, urine'
		);
		$data['Glucoseurinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//hCG, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'hCG, urine'
		);
		$data['hCGurineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'hCG, urine'
		);
		$data['hCGurinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'hCG, urine'
		);
		$data['hCGurinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Ketones, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Ketones, urine'
		);
		$data['Ketonesurineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Ketones, urine'
		);
		$data['Ketonesurinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Ketones, urine'
		);
		$data['Ketonesurinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//KOH prep
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'KOH prep'
		);
		$data['KOHprepav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'KOH prep'
		);
		$data['KOHprepbv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'KOH prep'
		);
		$data['KOHprepcv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Leuko Esterase, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Leuko Esterase, urine'
		);
		$data['LeukoEsteraseUrineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Leuko Esterase, urine'
		);
		$data['LeukoEsteraseUrinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Leuko Esterase, urine'
		);
		$data['LeukoEsteraseUrinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//pH, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'pH, urine'
		);
		$data['pHurineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'pH, urine'
		);
		$data['pHurinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'pH, urine'
		);
		$data['pHurinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Nitrite, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Nitrite, urine'
		);
		$data['Nitriteurineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Nitrite, urine'
		);
		$data['Nitriteurinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Nitrite, urine'
		);
		$data['Nitriteurinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Protein, urine, qual
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Protein, urine, qual'
		);
		$data['ProteinUrineQualav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Protein, urine, qual'
		);
		$data['ProteinUrineQualbv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Protein, urine, qual'
		);
		$data['ProteinUrineQualcv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Spec Gravity, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Spec Gravity, urine'
		);
		$data['SpecGravityUrineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Spec Gravity, urine'
		);
		$data['SpecGravityUrinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Spec Gravity, urine'
		);
		$data['SpecGravityUrinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Urine Sediment ID
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Urine Sediment ID'
		);
		$data['UrineSedimentIDav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Urine Sediment ID'
		);
		$data['UrineSedimentIDbv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Urine Sediment ID'
		);
		$data['UrineSedimentIDcv'] = $this->urinalysis_model->getParamValue($search);
		 
		//Urobilinogen, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Urobilinogen, urine'
		);
		$data['UrobilinogenUrineav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Urobilinogen, urine'
		);
		$data['UrobilinogenUrinebv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Urobilinogen, urine'
		);
		$data['UrobilinogenUrinecv'] = $this->urinalysis_model->getParamValue($search);
		
		
		//Vaginal Wet prep
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Vaginal Wet prep'
		);
		$data['VaginalWetPrepav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Vaginal Wet prep'
		);
		$data['VaginalWetPrepbv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Vaginal Wet prep'
		);
		$data['VaginalWetPrepcv'] = $this->urinalysis_model->getParamValue($search);
		
		//Yeast/Clue Cells, Vaginal
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Yeast/Clue Cells, Vaginal'
		);
		$data['YeastClueCellsVaginalav'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Yeast/Clue Cells, Vaginal'
		);
		$data['YeastClueCellsVaginalbv'] = $this->urinalysis_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Yeast/Clue Cells, Vaginal'
		);
		$data['YeastClueCellsVaginalcv'] = $this->urinalysis_model->getParamValue($search);
		
		
		
		$data['title'] = 'CHART || EQA URINALYSIS';
		
		$search = array(
				'year' => $year,
				'table_name' => 'EQA-URINALYSIS&CLINICAL MICRO'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'EQA-URINALYSIS&CLINICAL MICRO'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('eqa/urinalysis_graph', $data );//$this->view_data
	}
	



}

?>