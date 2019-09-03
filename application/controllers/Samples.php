<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Samples extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
			

	}
	 
	
	var $samples_id = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);				
	}
	
	function rejectionTable(){
		$data['title'] = 'Sample Rejection Table';
		$this->dashboard();
		$this->load->view('sr/rejectionTable', $data);
	}
	

	function receive(){
		$data['title'] = 'Receive Samples';
		$this->dashboard();
		$this->load->view('samples/receive', $data);
	}

	function rejectionAuditTable(){
		$data['title'] = 'Sample Rejection Table';
		$this->dashboard();
		$this->load->view('sr/rejectionAuditTable', $data);
	}
	
	function getSRTable(){
		$this->samples_model->getSRTable();
	}
	
	function getSampleTypeTable(){
		$this->samples_model->getSampleTypeTable();
	}
	
	function getSRAuditTable(){
		$this->samples_model->getSRAuditTable();
	}
	
	function getSamplesTable(){
		$this->samples_model->getSamplesTable();
	}

	function receiveSamplesTable(){
		$this->samples_model->receiveSamplesTable();
	}
	
	    // this for popup
    public function popupadd($samples_id = '') {
        $this->samples_id = $samples_id;


        // fetch record from db when editing records
        $result = $this->samples_model->getSampledId($this->samples_id);
        $this->sample_id = isset($result[0]['sample_id']) ? $result[0]['sample_id'] : "";
        $this->year = isset($result[0]['year']) ? $result[0]['year'] : "";
        $this->month = isset($result[0]['month']) ? $result[0]['month'] : "";
        $this->rejected_samples = isset($result[0]['rejected_samples']) ? $result[0]['rejected_samples'] : "";
        $this->total_received_samples = isset($result[0]['total_received_samples']) ? $result[0]['total_received_samples'] : "";
        $this->rejection_percentage = isset($result[0]['rejection_percentage']) ? $result[0]['rejection_percentage'] : "";
        $this->target = isset($result[0]['target']) ? $result[0]['target'] : "";

       $data['title'] = "Add New Rejection";
      // $this->dashboard();
       $this->load->view('sr/sampleRejection', $data);
	}
	
	public function barcode_popup($id = ''){
		$this->id = $id;


        // fetch record from db when editing records
        $result = $this->samples_model->getSampleBySampleId($this->id);
        $this->sample_id = isset($result[0]['sample_id']) ? $result[0]['sample_id'] : "";
		$this->project = isset($result[0]['project']) ? $result[0]['project'] : "";
		
		$data['title'] = "View Barcode";	
		$this->load->view('samples/barcode', $data);
	}

	public function print_barcode(){
		$this->id = $id;


        // fetch record from db when editing records
        $result = $this->samples_model->getSampleBySampleId($this->id);
        $this->sample_id = isset($result[0]['sample_id']) ? $result[0]['sample_id'] : "";
		$this->project = isset($result[0]['project']) ? $result[0]['project'] : "";

		$data['title'] = "Print Barcode";		
		$this->load->view('samples/print_barcode', $data);
	}
	
	
	    // this for popup
    public function samples_popup($id = '') {
        $this->id = $id;


        // fetch record from db when editing records
        $result = $this->samples_model->getSampleById($this->id);
        $this->sample_id = isset($result[0]['sample_id']) ? $result[0]['sample_id'] : "";
        $this->sample_type = isset($result[0]['sample_type']) ? $result[0]['sample_type'] : "";
        $this->project = isset($result[0]['project']) ? $result[0]['project'] : "";
        $this->sample_date = isset($result[0]['sample_date']) ? $result[0]['sample_date'] : ""; 
        $this->sample_time = isset($result[0]['sample_time']) ? $result[0]['sample_time'] : ""; 

	   $data['title'] = "Add New Sample";
	   $data['sample_types'] = $this->samples_model->getSampleTypes();
	   $data['projects'] = $this->samples_model->getProjects();
      // $this->dashboard();
       $this->load->view('samples/addsample', $data);
    } 
	   
	// sample type popup
    public function sampletype_popup($id = '') {
        $this->id = $id;

        // fetch record from db when editing records
        $result = $this->samples_model->getSampleTypeById($this->id);
        $this->id = isset($result[0]['id']) ? $result[0]['id'] : ""; 
        $this->sample_type = isset($result[0]['sample_type']) ? $result[0]['sample_type'] : ""; 

	   $data['title'] = isset($result[0]['id']) ? "Update Sample Type": "Add New Sample Type";   
       $this->load->view('samples/addsampletype', $data);
    } 
	
	function submitRejection(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addRejection'){
				$data = array(
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'rejected_samples' => $this->input->post('rejected_samples'),
					'total_received_samples' => $this->input->post('total_received_samples'),
					'target' => $this->input->post('target'),
					'status' => 'initial',
					'rejection_percentage' => 100*($this->input->post('rejected_samples')/$this->input->post('total_received_samples')),
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->samples_model->addRejection($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateRejection'){
				$data = array(
					'sample_id' => $this->input->post('sample_id'),
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'rejected_samples' => $this->input->post('rejected_samples'),
					'total_received_samples' => $this->input->post('total_received_samples'),
					'target' => $this->input->post('target'),
					'status' => 'update',
					'rejection_percentage' => 100*($this->input->post('rejected_samples')/$this->input->post('total_received_samples')),
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->samples_model->updateRejection($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function submitSamples(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addSamples'){
				$data = array( 
					'sample_id' => $this->input->post('sample_id'),
					'sample_type' => $this->input->post('sample_type'),
					'project' => $this->input->post('project'),
					'sample_date' => $this->input->post('sample_date'),
					'sample_time' => $this->input->post('sample_time'),
					'investigation_requested' => $this->input->post('investigation_requested'),					
					'status' => 'new', 
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->samples_model->addSamples($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateSamples'){
				$data = array(
					'id' => $this->input->post('id'),
					'sample_id' => $this->input->post('sample_id'),
					'sample_type' => $this->input->post('sample_type'),
					'project' => $this->input->post('project'),
					'sample_date' => $this->input->post('sample_date'),
					'sample_time' => $this->input->post('sample_time'),
					'status' => 'new with update', 
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->samples_model->updateSamples($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}

	function submitSampleType(){
       // $data = $_REQUEST;
		
		
		if($this->input->post('type')==='addSampleType'){
				$data = array(  
					'sample_type' => $this->input->post('sample_type'), 
					'status' => 'Initial', 
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->samples_model->addSampleType($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					//$output['success'] = 'Error';
           	 	 //	$output['msg'] = "An error was encountered while trying to reach the database! Try again later!";
            	 //	echo json_encode($output);
            	 	
				}
		}
		
		if($this->input->post('type')==='updateSampleType'){
				$data = array(
					'id' => $this->input->post('id'), 
					'sample_type' => $this->input->post('sample_type'), 
					'status' => 'updated', 
					'userName' => $this->session->userdata('userName'),
				
				);
				
				if($this->samples_model->updateSampleType($data)){
					$output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}
				
		}		

	}
	
	function deleteSampleRejection(){
		$data = $_REQUEST;
        if($this->samples_model->deleteSampleRejection($data)){
        	 $output['success'] = 1;
        	 $output['msg'] = "Records deleted successfully";
        
        	echo json_encode($output);
        }else{
        	$output['success'] = 0;
        	 $output['msg'] = "Error: Records not deleted! Try again";
        }        
      
	}
	
	function deleteSampleType(){
		$data = $_REQUEST;
        if($this->samples_model->deleteSampleType($data)){
        	 $output['success'] = 1;
        	 $output['msg'] = "Records deleted successfully";
        
        	echo json_encode($output);
        }else{
        	$output['success'] = 0;
        	 $output['msg'] = "Error: Records not deleted! Try again";
        }        
      
	}

	function deleteSamples(){
		$data = $_REQUEST;
        if($this->samples_model->deleteSamples($data)){
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

	function samples(){
		$data['title'] = "Samples Table";
		$this->dashboard();
		$this->load->view('samples/samples', $data);
	}

	function sampleTypesTable(){
		$data['title'] = "Samples Types Table";
		$this->dashboard();
		$this->load->view('samples/sampletypes', $data);
	}


	function rejection_graph(){

		
		$year = $this->uri->segment(3);
		$data['year'] = $year;
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		$data['tJAN'] = $this->samples_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['tFEB'] = $this->samples_model->getTarget($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['tMAR'] = $this->samples_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['tAPR'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['tMAY'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['tJUN'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['tJUL'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['tAUG'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['tSEP'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['tOCT'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['tNOV'] = $this->samples_model->getTarget($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['tDEC'] = $this->samples_model->getTarget($search);
		
		$search = array(
				'year' => $year,
				'month' => 'JAN'
		);
		
		$data['rJAN'] = $this->samples_model->getRejection($search);
				
		$search = array(
				'year' => $year,
				'month' => 'FEB'
		);
		$data['rFEB'] = $this->samples_model->getRejection($search);
				
		$search = array(
				'year' => $year,
				'month' => 'MAR'
		);
		$data['rMAR'] = $this->samples_model->getRejection($search);
		
		$search = array(
				'year' => $year,
				'month' => 'APR'
		);
		$data['rAPR'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'MAY'
		);
		$data['rMAY'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'JUN'
		);
		$data['rJUN'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'JUL'
		);
		$data['rJUL'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'AUG'
		);
		$data['rAUG'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'SEP'
		);
		$data['rSEP'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'OCT'
		);
		$data['rOCT'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'NOV'
		);
		$data['rNOV'] = $this->samples_model->getRejection($search);

		$search = array(
				'year' => $year,
				'month' => 'DEC'
		);
		$data['rDEC'] = $this->samples_model->getRejection($search);
		$data['title'] = 'Sample Rejection Chart';
		
		$search = array(
				'year' => $year,
				'table_name' => 'SAMPLE REJECTION'
		);
		$data['summaries'] = $this->main_model->getSummaries($search);
		$search = array(
				//'year' => $year,
				'table_name' => 'SAMPLE REJECTION'
		);
		$data['concepts'] = $this->main_model->getConcepts($search);
		
		$this->load->view('sr/graphs', $data );//$this->view_data
	}
	



}

?>