<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Concepts extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'concepts_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $concepts_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function conceptsTable(){
		$data['title'] = 'SUMMARIES || Table';
		$this->dashboard();
		$this->load->view('concepts/conceptsTable', $data);
	}
	
	function getConceptsTable(){
		$this->concepts_model->getConceptsTable();
	}
	
	    // this for popup
    public function popupadd($concepts_id = '') {
        $this->concepts_id = $concepts_id;


        // fetch record from db when edit records
        $result = $this->concepts_model->getConceptsId($this->concepts_id);
        $this->concepts_id = isset($result[0]['concepts_id']) ? $result[0]['concepts_id'] : "";
       // $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->table_name = isset($result[0]['table_name']) ? $result[0]['table_name'] : "";
        $this->objective = isset($result[0]['objective']) ? $result[0]['objective'] : "";
        $this->measure = isset($result[0]['measure']) ? $result[0]['measure'] : "";
        $this->reporting_schedule = isset($result[0]['reporting_schedule']) ? $result[0]['reporting_schedule'] : "";
        $this->methodology_numerator = isset($result[0]['methodology_numerator']) ? $result[0]['methodology_numerator'] : "";
        $this->methodology_denominator = isset($result[0]['methodology_denominator']) ? $result[0]['methodology_denominator'] : "";
        $this->methodology_multiplier = isset($result[0]['methodology_multiplier']) ? $result[0]['methodology_multiplier'] : "";

       $data['title'] = "Add New Concept";
      // $this->dashboard();
       $this->load->view('concepts/concepts_form', $data);
    }
	
	
	function submitConcepts(){
       // $data = $_REQUEST;
	 	
		
		if($this->input->post('type')==='addConcepts'){
				$data = array(
					'table_name' => $this->input->post('table_name'),
					'objective' => $this->input->post('objective'),
					'measure' => $this->input->post('measure'),
					'reporting_schedule' => $this->input->post('reporting_schedule'),
					'methodology_numerator' => $this->input->post('methodology_numerator'),
					'methodology_denominator' => $this->input->post('methodology_denominator'),
					'methodology_multiplier' => $this->input->post('methodology_multiplier'),
					'userName' => $this->session->userdata('userName'),
					'status' => 'initial',
				
				);
				
				if($this->concepts_model->addConcepts($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateConcepts'){
				$data = array(
					'concepts_id' => $this->input->post('concepts_id'),
					'table_name' => $this->input->post('table_name'),
					'objective' => $this->input->post('objective'),
					'measure' => $this->input->post('measure'),
					'reporting_schedule' => $this->input->post('reporting_schedule'),
					'methodology_numerator' => $this->input->post('methodology_numerator'),
					'methodology_denominator' => $this->input->post('methodology_denominator'),
					'methodology_multiplier' => $this->input->post('methodology_multiplier'),
					'userName' => $this->session->userdata('userName'),
					'status' => 'update',
				
				);
				
				if($this->concepts_model->updateConcepts($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteConcepts(){
		$data = $_REQUEST;
        if($this->concepts_model->deleteSummaries($data)){
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


	function concepts_graph(){
			
		
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		$data['tJAN'] = $this->concepts_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['tFEB'] = $this->concepts_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['tMAR'] = $this->concepts_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['tAPR'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['tMAY'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['tJUN'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['tJUL'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['tAUG'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['tSEP'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['tOCT'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['tNOV'] = $this->concepts_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['tDEC'] = $this->concepts_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		
		$data['rJAN'] = $this->concepts_model->getRejection($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['rFEB'] = $this->concepts_model->getRejection($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['rMAR'] = $this->concepts_model->getRejection($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['rAPR'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['rMAY'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['rJUN'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['rJUL'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['rAUG'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['rSEP'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['rOCT'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['rNOV'] = $this->concepts_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['rDEC'] = $this->concepts_model->getRejection($search);
		$data['title'] = 'Sample Rejection Chart';
		
		$this->load->view('sr/graphs', $data );//$this->view_data
	}
	



}

?>