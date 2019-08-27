<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tat extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'tat_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $tat_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function tatTable(){
		$data['title'] = 'TAT || Table';
		$this->dashboard();
		$this->load->view('tat/tatTable', $data);
	}
	
	function getTatTable(){
		$this->tat_model->getTatTable();
	}
	
	    // this for popup
    public function popupadd($tat_id = '') {
        $this->tat_id = $tat_id;


        // fetch record from db when edit records
        $result = $this->tat_model->getTatId($this->tat_id);
        $this->tat_id = isset($result[0]['tat_id']) ? $result[0]['tat_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->month = isset($result[0]['month']) ? $result[0]['month'] : "";
        $this->samples_not_meeting_tat = isset($result[0]['samples_not_meeting_tat']) ? $result[0]['samples_not_meeting_tat'] : "";
        $this->total_samples_released = isset($result[0]['total_samples_released']) ? $result[0]['total_samples_released'] : "";
       $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "Add New TAT";
      // $this->dashboard();
       $this->load->view('tat/tat_form', $data);
    }
	
	
	function submitTat(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addTat'){
				$data = array(
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'samples_not_meeting_tat' => $this->input->post('samples_not_meeting_tat'),
					'total_samples_released' => $this->input->post('total_samples_released'),
					'samples_meeting_tat' => $this->input->post('total_samples_released')-$this->input->post('samples_not_meeting_tat'),
					'target' => $this->input->post('target'),
					'pc_meeting_tat' => 100*(($this->input->post('total_samples_released')-$this->input->post('samples_not_meeting_tat'))/$this->input->post('total_samples_released')),
					'userName' => $this->session->userdata('userName'),
					'status' => 'initial',
				
				);
				
				if($this->tat_model->addTat($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateTat'){
				$data = array(
					'tat_id' => $this->input->post('tat_id'),
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'samples_not_meeting_tat' => $this->input->post('samples_not_meeting_tat'),
					'total_samples_released' => $this->input->post('total_samples_released'),
					'samples_meeting_tat' => $this->input->post('total_samples_released')-$this->input->post('samples_not_meeting_tat'),
					'target' => $this->input->post('target'),
					'pc_meeting_tat' => 100*(($this->input->post('total_samples_released')-$this->input->post('samples_not_meeting_tat'))/$this->input->post('total_samples_released')),
					'userName' => $this->session->userdata('userName'),
					'status' => 'update',
				
				);
				
				if($this->tat_model->updateTat($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteTat(){
		$data = $_REQUEST;
        if($this->tat_model->deleteTat($data)){
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


	function tat_graph(){
		
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		$data['tJAN'] = $this->tat_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['tFEB'] = $this->tat_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['tMAR'] = $this->tat_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['tAPR'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['tMAY'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['tJUN'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['tJUL'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['tAUG'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['tSEP'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['tOCT'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['tNOV'] = $this->tat_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['tDEC'] = $this->tat_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		
		$data['rJAN'] = $this->tat_model->getMeetingTat($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['rFEB'] = $this->tat_model->getMeetingTat($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['rMAR'] = $this->tat_model->getMeetingTat($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['rAPR'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['rMAY'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['rJUN'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['rJUL'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['rAUG'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['rSEP'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['rOCT'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['rNOV'] = $this->tat_model->getMeetingTat($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['rDEC'] = $this->tat_model->getMeetingTat($search);
		
		$data['title'] = 'CHART || VALUES MEETING TAT';
		
		$search = array(
				'year' => $year,
				'table_name' => 'CRITICAL VALUE REPORTING'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'TAT'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('tat/graphs', $data );//$this->view_data
	}
	



}

?>