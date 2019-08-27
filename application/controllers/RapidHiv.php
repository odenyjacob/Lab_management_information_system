<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RapidHiv extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model', 'rapidhiv_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $rapidHiv_id = ''; 
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function rapidHivTable(){
		$data['title'] = 'RAPID HIV & OTHERS || Table';
		$this->dashboard();
		$this->load->view('eqa/rapidHivTable', $data);
	}
	
	function getRapidHivTable(){
		$this->rapidhiv_model->getRapidHivTable();
	}
	
	    // this for popup 
    public function popupadd($rapidHiv_id = '') {
        $this->rapidHiv_id = $rapidHiv_id;


        // fetch record from db when edit records
        $result = $this->rapidhiv_model->getRapidHivId($this->rapidHiv_id);
        $this->rapidHiv_id = isset($result[0]['rapidHiv_id']) ? $result[0]['rapidHiv_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->cycle = isset($result[0]['cycle']) ? $result[0]['cycle'] : "";
        $this->parameter = isset($result[0]['parameter']) ? $result[0]['parameter'] : "";
        $this->results = isset($result[0]['results']) ? $result[0]['results'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "EQA RAPID HIV & OTHERS";
      // $this->dashboard();
       $this->load->view('eqa/rapidHiv_form', $data);
    }
	
	
	function submitRapidHiv(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addRapidHiv'){
				$data = array(
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'), 
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->rapidhiv_model->addRapidHiv($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateRapidHiv'){
				$data = array(
					'rapidHiv_id' => $this->input->post('rapidHiv_id'),
					'year' => $this->input->post('year'),
					'parameter' => $this->input->post('parameter'),
					'cycle' => $this->input->post('cycle'),
					'results' => $this->input->post('results'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->rapidhiv_model->updateRapidHiv($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteRapidHiv(){
		$data = $_REQUEST;
        if($this->rapidhiv_model->deleteRapidHiv($data)){
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
	

	function rapidHiv_graph(){
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		
		//HSV II, IgG
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'HSV II, IgG'
		);
		$data['HSVIIIgGav'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'HSV II, IgG'
		);
		$data['HSVIIIgGbv'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'HSV II, IgG'
		);
		$data['HSVIIIgGcv'] = $this->rapidhiv_model->getParamValue($search);
		
		
		//Anti-HIV-1/2 (Mtd 1)
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HIV-1/2 (Mtd 1)'
		);
		$data['AntiHIVhalfMtd1av'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HIV-1/2 (Mtd 1)'
		);
		$data['AntiHIVhalfMtd1bv'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HIV-1/2 (Mtd 1)'
		);
		$data['AntiHIVhalfMtd1cv'] = $this->rapidhiv_model->getParamValue($search);
		
		
		//Anti-HIV-1/2 (Mtd 2)
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'Anti-HIV-1/2 (Mtd 2)'
		);
		$data['AntiHIVhalfMtd2av'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'Anti-HIV-1/2 (Mtd 2)'
		);
		$data['AntiHIVhalfMtd2bv'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'Anti-HIV-1/2 (Mtd 2)'
		);
		$data['AntiHIVhalfMtd2cv'] = $this->rapidhiv_model->getParamValue($search);
		
		
		//hCG, urine
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'hCG, urine'
		);
		$data['hCGurineav'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'hCG, urine'
		);
		$data['hCGurinebv'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'hCG, urine'
		);
		$data['hCGurinecv'] = $this->rapidhiv_model->getParamValue($search);
		
		
		//MHA-TP/TP-PA/PK-TP
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'MHA-TP/TP-PA/PK-TP'
		);
		$data['MHATPTPPAPKTPav'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'MHA-TP/TP-PA/PK-TP'
		);
		$data['MHATPTPPAPKTPbv'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'MHA-TP/TP-PA/PK-TP'
		);
		$data['MHATPTPPAPKTPcv'] = $this->rapidhiv_model->getParamValue($search);
		
		
		//RPR, qual
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'RPR, qual'
		);
		$data['RPRqualav'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'RPR, qual'
		);
		$data['RPRqualbv'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'RPR, qual'
		);
		$data['RPRqualcv'] = $this->rapidhiv_model->getParamValue($search);
		
		
		//RPR, titer
		$search = array(
				'year' => $year,
				'cycle' => 'A',
				'parameter' => 'RPR, titer'
		);
		$data['RPRtiterav'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'B',
				'parameter' => 'RPR, titer'
		);
		$data['RPRtiterbv'] = $this->rapidhiv_model->getParamValue($search);
		
		$search = array(
				'year' => $year,
				'cycle' => 'C',
				'parameter' => 'RPR, titer'
		);
		$data['RPRtitercv'] = $this->rapidhiv_model->getParamValue($search);
		 
				
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
		
		$this->load->view('eqa/rapidHIV_graph', $data );//$this->view_data
	}
	



}

?>