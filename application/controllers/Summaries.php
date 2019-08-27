<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Summaries extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'summaries_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $summaries_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function summariesTable(){
		$data['title'] = 'SUMMARIES || Table';
		$this->dashboard();
		$this->load->view('summaries/summariesTable', $data);
	}
	
	function getSummariesTable(){
		$this->summaries_model->getSummariesTable();
	}
	
	    // this for popup
    public function popupadd($summaries_id = '') {
        $this->summaries_id = $summaries_id;


        // fetch record from db when edit records
        $result = $this->summaries_model->getSummariesId($this->summaries_id);
        $this->summaries_id = isset($result[0]['summaries_id']) ? $result[0]['summaries_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->table_name = isset($result[0]['table_name']) ? $result[0]['table_name'] : "";
        $this->analysis = isset($result[0]['analysis']) ? $result[0]['analysis'] : "";
        $this->interpretation = isset($result[0]['interpretation']) ? $result[0]['interpretation'] : "";
       $this->limitation = isset($result[0]['limitation']) ? $result[0]['limitation'] : "";
        $this->action_plan = isset($result[0]['action_plan']) ? $result[0]['action_plan'] : "";

       $data['title'] = "Add New Summary";
      // $this->dashboard();
       $this->load->view('summaries/summaries_form', $data);
    }
	
	
	function submitSummaries(){
       // $data = $_REQUEST;
	 	
		
		if($this->input->post('type')==='addSummaries'){
				$data = array(
					'year' => $this->input->post('year'),
					'table_name' => $this->input->post('table_name'),
					'analysis' => $this->input->post('analysis'),
					'interpretation' => $this->input->post('interpretation'),
					'limitation' => $this->input->post('limitation'),
					'action_plan' => $this->input->post('action_plan'),
					'userName' => $this->session->userdata('userName'),
					'status' => 'initial',
				
				);
				
				if($this->summaries_model->addSummaries($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateSummaries'){
				$data = array(
					'summaries_id' => $this->input->post('summaries_id'),
					'year' => $this->input->post('year'),
					'table_name' => $this->input->post('table_name'),
					'analysis' => $this->input->post('analysis'),
					'interpretation' => $this->input->post('interpretation'),
					'limitation' => $this->input->post('limitation'),
					'action_plan' => $this->input->post('action_plan'),
					'userName' => $this->session->userdata('userName'),
					'status' => 'update',
				
				);
				
				if($this->summaries_model->updateSummaries($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteSummaries(){
		$data = $_REQUEST;
        if($this->summaries_model->deleteSummaries($data)){
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


	function summaries_graph(){
			
		
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		$data['tJAN'] = $this->summaries_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['tFEB'] = $this->summaries_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['tMAR'] = $this->summaries_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['tAPR'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['tMAY'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['tJUN'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['tJUL'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['tAUG'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['tSEP'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['tOCT'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['tNOV'] = $this->summaries_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['tDEC'] = $this->summaries_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		
		$data['rJAN'] = $this->summaries_model->getRejection($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['rFEB'] = $this->summaries_model->getRejection($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['rMAR'] = $this->summaries_model->getRejection($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['rAPR'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['rMAY'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['rJUN'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['rJUL'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['rAUG'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['rSEP'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['rOCT'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['rNOV'] = $this->summaries_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['rDEC'] = $this->summaries_model->getRejection($search);
		$data['title'] = 'Sample Rejection Chart';
		
		$this->load->view('sr/graphs', $data );//$this->view_data
	}
	



}

?>