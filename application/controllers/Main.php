<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->library(array('form_validation', 'session', 'table',  'bcrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'samples_model'));
		//$this->load->database();
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));



	}

	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$this->load->view('dash', $data);
	}

	function rejectionTable(){
		$data['title'] = 'Rejection Table';
		$this->dashboard();
		$this->load->view('rejectionTable');
	}

	function user_profile(){
		$data['title'] = 'LIMS | My Profile';

		$username = $this->session->userdata('userName');
		$data['info'] = $this->main_model->pullProfileInfo($username);
		$this->dashboard();
		$this->load->view('profile', $data);

	}




	// Login View
	function login(){
		$data['title'] = 'LIMS | LOGIN';
		$this->load->view('login', $data);
		//$this->load->view('login');
	}

	function login_proc(){
		 $password =  $this->input->post('password');

		 $credentials = array(
		'userName' =>  $this->input->post('userName'),
		); 

	$this->load->model('main_model');
		if( $result = $this->main_model->getLogin($credentials)){
			foreach ($result as $row){
				$stored_hash = $row->password;
				if($this->bcrypt->check_password($password, $stored_hash)){
					$this->session->set_userdata(array(
		                'userName' => $this->input->post('userName'),
		                'panel' => 'panel panel-primary',
		                'label' => 'label label-primary',
		        		'buttonClass' => 'btn-primary',
		        		'tClass' => 'primary',
					    'FName' => $row->FName,
					    'LName' => $row->LName,
					    'empNumber' => $row->empNumber,
					    'location' => $row->location,
					    'role' => $row->role,
					    'bg' => 'bg bg-primary',
					    'navbar' => 'navbar-primary',

		   ));

		   if($result = $this->main_model->creditline()){
		   	foreach ($result as $row){
		   		$this->session->set_userdata(array(
					'creditline' => $row->company_name,
					'company_phone' => $row->company_phone,
					'company_email' => $row->company_email,
				));
		   	}
		   }

			redirect("main/home");
			//$this->homepage();
				}else {
					$this->session->set_flashdata('error', 'Invalid login credentials');
					redirect("main/login_error");
					redirect(site_url("main/login_error"));
		}
			}

		}
		else {
			// $this->session->set_flashdata('error', 'Invalid login credentials');
			// redirect("main/login_error");
			$res['message']='error';
			echo json_encode($res);
		}




	}

	function login_error(){
		$data['error'] = $this->session->flashdata('error');
		$data['title'] = 'LIMS | Login Error';
		$this->load->view('login', $data);
	}


	function changePassword(){

		$username = $this->session->userdata('userName');
		$data['result']=$this->main_model->changepassword($username);
		$this->dashboard();
		$data['title'] = 'USER || Change Password';
		$this->load->view('changePassword', $data);


	}

	function passchange(){
		$username = $this->session->userdata('userName');
		$hashedPass = $this->bcrypt->hash_password($this->input->post('newPassword'));
		$stored_hash = $this->main_model->getPass($username);
		$old_hash = $this->bcrypt->hash_password($this->input->post('old_password'));

		if(!$stored_hash){
					// $output['success'] = 0;
           	 	 	// $output['msg'] = "Kindly login";
            	 	// echo json_encode($output);
		}else{
			if($this->bcrypt->check_password($this->input->post('old_password'), $stored_hash)){
				$data = array(
					'userName' => $username,
					'password' => $hashedPass
				);
				$data = $this->security->xss_clean($data);

				if($this->main_model->updateusers($data)){
					 $output['success'] = 1;
           	 	 	 $output['msg'] = "data process completed successfully";
            	 	 echo json_encode($output);
				}else{
					// $output['success'] = 0;
           	 	 	// $output['msg'] = "Error! Password not changed!";
            	 	// echo json_encode($output);
				}
			}else{
				    // $output['success'] = 0;
           	 	 	// $output['msg'] = "Old password doesn't match system password";
            	 	// echo json_encode($output);
			}
		}


	}

	function passchangex(){
		$this->form_validation->set_message('matches', 'Password miss-match: Either old passwords or new passwords don\'t match');
		$this->form_validation->set_rules('old_password', 'Old Password', 'matches[sysPassword]|required');
		$this->form_validation->set_rules('newPassword', 'New Password', 'matches[cofirmPassword]|required');
		$this->form_validation->set_rules('username', 'Login username : You are not logged in. Log In', 'required');
		if ($this->form_validation->run() === FALSE){
		   // $this->changePassword();
		   return false;
 	 } else{
		$hashedPass = $this->bcrypt->hash_password($this->input->post('newPassword'));
 	 		$data = array(
				'userName' => $this->session->userdata('userName'),
				'password' => $hashedPass,
			);
			$stored_hash = $this->input->post('sysPassword');
			$password = $this->input->post('old_password');
				if($this->bcrypt->check_password($password, $stored_hash)){

				if($this->main_model->updateusers($data)){
					//return true;
				}else{
					//$this->home();
					//return false;
				}

	}else{
		$this->form_validation->set_rules('old_password', 'Old Password', 'matches[cofirmPassword]|required');
		$data = $this->form_validation->set_message('matches', 'Old passwords don\'t match');
		$this->changePassword($data);
	}

	 }
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function register_user(){
		$this->dashboard();
		$this->load->view('register_users');
	}

	function register_user_proc(){
		$password = $this->input->post('password');
		$data = array(
			'FName' => $this->input->post('FName'),
			'LName' => $this->input->post('LName'),
			'password' => $this->bcrypt->hash_password($password),
			'userName' => $this->input->post('userName'),
			'enrollmentDate' => $this->input->post('enrollmentDate'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'location' => $this->input->post('location'),
			'role' => $this->input->post('role'),
		);
		$data = $this->security->xss_clean($data);
		$this->main_model->register_user($data);

		$this->success();
	}

	// welcome
	function welcome(){
		$this->load->view('welcome_message');
	}
	//Showing success page
	function success(){
		$this->load->view('success');
	}

	function resetForm(){
		$data['title'] = 'Reset Password';
		$this->load->view('resetForm', $data);
	}

	function resetPassword(){
		$check = $this->input->post('email');
		$this->load->model('main_model');
		if($this->main_model->check_email($check)){
		$recipient = $this->input->post('email');
		$rCode = random_string('alnum', 6);
		$config['protocol'] = 'sendmail';
		$config['priority'] = 1;
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'smt.gmail.com';
		$config['smtp_port'] = 587;
		$config['smtp_user'] = 'brianbodhiambo@gmail.com';
		$config['smtp_pass'] = 'Pass@intellisense//Bout<<bo.getpass()';

		$this->email->initialize($config);

		$this->email->from('brianbodhiambo@gmail.com');
		$this->email->to($recipient);
		$this->email->subject('PASSWORD RESET CODE');
		$this->email->message("You requested to reset your LIMS password. Use the following code and link to reset your password \n \n Code:  $rCode \n
		Link: {unwrap} http://LIMS.responsiveafrica.com/index.php/main/resetDetails {/unwrap} \n \n Regards \n Responsive Africa LIMS Services");
		if($this->email->send()){
			$data = array(
					'rCode'=> $rCode,
					'email' => $recipient,
			);
			$this->main_model->insertrCode($data);
			$this->success();
		}

	}else{
			$data['title'] = "Email Error";
			$data["error"] = "$check is not registered!";
			$this->load->view('resetForm', $data);
	}

	}

	function dberror(){

		$this->dashboard();
		$this->load->view('dberror');
	}
	function test(){

		$this->dashboard();
		$this->load->view('test');
	}

	function testproc(){
		echo json_encode($data);
	}

	function unauthorized(){
		$empNumber = $this->session->userdata('empNumber');
		$userName = $this->session->userdata('userName');
		$warning = array(
				'sender' => 'LIMS AUTO',
				'recipient' => 'System Administrator',
				'subject' => 'UNAUTHORIZED ACCESS',
				'status' => 'active',
				'body' => "<wrap> Employee Number : .{$empNumber} and username : {$userName} tried accessing unauthorized script in the system. </wrap>",
		);
		$this->main_model->unauthorizedWarning($warning);
		$data['title'] = 'LIMS | Unauthorized Access';
		$this->dashboard();
		$this->load->view('unauthorized', $data);
	}


	function home(){
	/*	$this->view_data = array();
		$series_data[] = array('name' => 'Brands', 'colorByPoint' => true,  'data'=> array(['name' => 'Nairobi, KE', 'y' => 56.33],['name'=> 'Kisumu, KE', 'y'=>64.03 ],
							['name'=> 'New York, USA', 'y'=>44.03 ],['name'=> 'Kampala, UG', 'y'=>14.03 ],['name'=> 'Pretoria, SA', 'y'=>24.03 ],['name'=> 'Others', 'y'=>2.03 ]));



	    $this->view_data['series_data'] = json_encode($series_data); */
		$this->view_data['title'] = 'LIMS || Home';


	/*	[{
                name: "Brands",
                colorByPoint: true,
                data: [{
                    name: "Microsoft Internet Explorer",
                    y: 56.33
                }, {
                    name: "Chrome",
                    y: 24.03,
                    sliced: true,
                    selected: true
                }, {
                    name: "Firefox",
                    y: 10.38
                }, {
                    name: "Safari",
                    y: 4.77
                }, {
                    name: "Opera",
                    y: 0.91
                },{
                    name: "Proprietary or Undetectable",
                    y: 0.2
                }]
            }] */

		$data['title'] = "LIMS || HOME";
		$this->dashboard();
		$this->load->view('homepage', $this->view_data);
	}

	function changeprimary(){
		$this->session->set_userdata(array(
				'panel' => 'panel panel-primary',
		        'label' => 'label label-primary',
		        'buttonClass' => 'btn-primary',
		        'tClass' => 'primary',
		        'bg' => 'bg bg-primary',
		        'navbar' => 'navbar-primary',
		));
		redirect("main/home");
		}

	function changedefault(){
		$this->session->set_userdata(array(
				'panel' => 'panel panel-default',
		        'label' => 'label label-default',
		        'buttonClass' => 'btn-default',
		        'tClass' => 'default',
		        'bg' => 'bg bg-default',
		        'navbar' => 'navbar-default',
		));
		redirect("main/home");
		}

	function changesuccess(){
		$this->session->set_userdata(array(
				'panel' => 'panel panel-success',
		        'label' => 'label label-success',
		        'buttonClass' => 'btn-success',
		        'tClass' => 'success',
		        'bg' => 'bg bg-success',
		        'navbar' => 'navbar-success',
		));
		redirect("main/home");
		}


	function changedanger(){
		$this->session->set_userdata(array(
				'panel' => 'panel panel-danger',
		        'label' => 'label label-danger',
		        'buttonClass' => 'btn-danger',
		        'tClass' => 'danger',
		        'bg' => 'bg bg-danger',
		        'navbar' => 'navbar-danger',
		));
		redirect("main/home");
	}

	function changeinfo(){
		$this->session->set_userdata(array(
				'panel' => 'panel panel-info',
		        'label' => 'label label-info',
		        'buttonClass' => 'btn-info',
		        'tClass' => 'info',
		        'bg' => 'bg bg-info',
		        'navbar' => 'navbar-info',
		));
		redirect("main/home");
	}
	function changewarning(){
		$this->session->set_userdata(array(
				'panel' => 'panel panel-warning',
		        'label' => 'label label-warning',
		        'buttonClass' => 'btn-warning',
		        'tClass' => 'warning',
		        'bg' => 'bg bg-warning',
		        'navbar' => 'navbar-warning',
		));
		redirect("main/home");
	}


	function notification(){
		$username = array(
				'userName' => $this->session->userdata('userName'),
		);
		$data['notifications'] = $this->main_model->notifications($username);
		$this->dashboard();
		$this->load->view('notifications', $data);
	}

	function user_access(){
		$data['title'] = 'LIMS| Access Levels';
		$this->dashboard();
		$this->load->view('access.php', $data);
	}

	function pur(){
		$data = $this->input->post('empNumber');
		$data = $this->security->xss_clean($data);
		$data = $this->main_model->employeeAccess($data);
		echo json_encode($data);
	}

	/*
	 * Revoking/Granting System Access!
	 */


	function revokeaddEmployee(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'addEmployee' => 'no',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function grantaddEmployee(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'addEmployee' => 'yes',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function revokeeditEmployee(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'editEmployee' => 'no',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function granteditEmployee(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'editEmployee' => 'yes',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}
	function revoketimecardApproval(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'timecardApproval' => 'no',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function granttimecardApproval(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'timecardApproval' => 'yes',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function revokeleaveApproval(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'leaveApproval' => 'no',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function grantleaveApproval(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'leaveApproval' => 'yes',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}
	function revoketimecard(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'timecard' => 'no',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function granttimecard(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'timecard' => 'yes',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function revokeleaveApplication(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'leaveApplication' => 'no',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function grantleaveApplication(){

		$data = array(
			'empNumber' =>$this->input->post('empNumber'),
			'leaveApplication' => 'yes',
		);
		if($this->main_model->updateAccess($data)){
			echo json_encode($data);
		}
	}

	function isEmptyPage(){
		$data['title'] = 'LIMS | About Blank';
		$this->dashboard();
		$this->load->view('templates/blank', $data);
	}




}

?>
