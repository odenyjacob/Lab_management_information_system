<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Iqc extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'iqc_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $iqc_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function iqcTable(){
		$data['title'] = 'IQC || Table';
		$this->dashboard();
		$this->load->view('iqc/iqcTable', $data);
	}
	
	function getIqcTable(){
		$this->iqc_model->getIqcTable();
	}
	
	    // this for popup
    public function popupadd($iqc_id = '') {
        $this->iqc_id = $iqc_id;


        // fetch record from db when edit records
        $result = $this->iqc_model->getSampledId($this->iqc_id);
        $this->iqc_id = isset($result[0]['iqc_id']) ? $result[0]['iqc_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->month = isset($result[0]['month']) ? $result[0]['month'] : "";
        $this->iqcs_passed_firstRun = isset($result[0]['iqcs_passed_firstRun']) ? $result[0]['iqcs_passed_firstRun'] : "";
        $this->iqcs_done = isset($result[0]['iqcs_done']) ? $result[0]['iqcs_done'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "INTERNAL QUALITY CONTROL";
      // $this->dashboard();
       $this->load->view('iqc/iqc_form', $data);
    }
	
	
	function submitIqc(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addIqc'){
				$data = array(
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'iqcs_passed_firstRun' => $this->input->post('iqcs_passed_firstRun'),
					'iqcs_done' => $this->input->post('iqcs_done'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'pc_iqcs_passed_firstRun' => 100*($this->input->post('iqcs_passed_firstRun')/$this->input->post('iqcs_done')),
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->iqc_model->addIqc($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateIqc'){
				$data = array(
					'iqc_id' => $this->input->post('iqc_id'),
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'iqcs_passed_firstRun' => $this->input->post('iqcs_passed_firstRun'),
					'iqcs_done' => $this->input->post('iqcs_done'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'pc_iqcs_passed_firstRun' => 100*($this->input->post('iqcs_passed_firstRun')/$this->input->post('iqcs_done')),
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->iqc_model->updateIqc($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteIqc(){
		$data = $_REQUEST;
        if($this->iqc_model->deleteIqc($data)){
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
	

	function iqc_graph(){

		
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		$data['tJAN'] = $this->iqc_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['tFEB'] = $this->iqc_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['tMAR'] = $this->iqc_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['tAPR'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['tMAY'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['tJUN'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['tJUL'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['tAUG'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['tSEP'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['tOCT'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['tNOV'] = $this->iqc_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['tDEC'] = $this->iqc_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		
		$data['rJAN'] = $this->iqc_model->getPcIqc($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['rFEB'] = $this->iqc_model->getPcIqc($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['rMAR'] = $this->iqc_model->getPcIqc($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['rAPR'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['rMAY'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['rJUN'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['rJUL'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['rAUG'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['rSEP'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['rOCT'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['rNOV'] = $this->iqc_model->getPcIqc($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['rDEC'] = $this->iqc_model->getPcIqc($search);
		$data['title'] = 'INTERNAL QUALITY CONTROL || Chart';
		
		$search = array(
				'year' => $year,
				'table_name' => 'INTERNAL QUALITY CONTROL'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'INTERNAL QUALITY CONTROL'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('iqc/graphs', $data );//$this->view_data
	}
	



}

?>