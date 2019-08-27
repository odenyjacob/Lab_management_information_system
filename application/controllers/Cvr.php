<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cvr extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model','cvr_model', 'cvr_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $iqc_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function cvrTable(){
		$data['title'] = 'CVR || Table';
		$this->dashboard();
		$this->load->view('cvr/cvrTable', $data);
	}
	
	function getcvrTable(){
		$this->cvr_model->cvrTable();
	}
	
	    // this for popup
    public function popupadd($cvr_id = '') {
        $this->cvr_id = $cvr_id;


        // fetch record from db when edit records
        $result = $this->cvr_model->getCvrId($this->cvr_id);
        $this->cvr_id = isset($result[0]['cvr_id']) ? $result[0]['cvr_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->month = isset($result[0]['month']) ? $result[0]['month'] : "";
        $this->reported = isset($result[0]['reported']) ? $result[0]['reported'] : "";
        $this->all_events = isset($result[0]['all_events']) ? $result[0]['all_events'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "CRITICAL VALUE REPORTING";
      // $this->dashboard();
       $this->load->view('cvr/cvr_form', $data);
    }
	
	
	function submitCvr(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addCvr'){
				$data = array(
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'reported' => $this->input->post('reported'),
					'all_events' => $this->input->post('all_events'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'report_percentage' => 100*($this->input->post('reported')/$this->input->post('all_events')),
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->cvr_model->addCvr($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateCvr'){
				$data = array(
					'cvr_id' => $this->input->post('cvr_id'),
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'reported' => $this->input->post('reported'),
					'all_events' => $this->input->post('all_events'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'report_percentage' => 100*($this->input->post('reported')/$this->input->post('all_events')),
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->cvr_model->updateCvr($data)){
					$output['success'] = 1;
           	 	 	$output['msg'] = "data process completed successfully";
            	 	echo json_encode($output);
				}
				
		}		

	}
	
	function deleteCvr(){
		$data = $_REQUEST;
        if($this->cvr_model->deleteCvr($data)){
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
	

	function cvr_graph(){

		
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		$data['tJAN'] = $this->cvr_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['tFEB'] = $this->cvr_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['tMAR'] = $this->cvr_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['tAPR'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['tMAY'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['tJUN'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['tJUL'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['tAUG'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['tSEP'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['tOCT'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['tNOV'] = $this->cvr_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['tDEC'] = $this->cvr_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		
		$data['rJAN'] = $this->cvr_model->getPcReport($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['rFEB'] = $this->cvr_model->getPcReport($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['rMAR'] = $this->cvr_model->getPcReport($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['rAPR'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['rMAY'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['rJUN'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['rJUL'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['rAUG'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['rSEP'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['rOCT'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['rNOV'] = $this->cvr_model->getPcReport($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['rDEC'] = $this->cvr_model->getPcReport($search);
		
		$data['title'] = 'CRITICAL VALUE REPORTING || Chart';
		
		$search = array(
				'year' => $year,
				'table_name' => 'CRITICAL VALUE REPORTING'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'CRITICAL VALUE REPORTING'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('cvr/graphs', $data );//$this->view_data
	}
	



}

?>