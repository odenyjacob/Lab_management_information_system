<?php
	if($access['addEmployee']!='yes'){
		redirect('main/unauthorized');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $title; ?> </title>
	<?php $buttonclass = $this->session->userdata('buttonClass'); ?>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	
    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    
    <!-- Jquery UI Javascript-->
    <script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js') ?>"></script>
    
    <link href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css') ?>" rel="stylesheet">
	<!--<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">-->
	
	<!-- Dashboard Specific Links-->
	<!-- Custom CSS -->
    <link href="<?php echo base_url('dashboard/css/sb-admin-2.css') ?>" rel="stylesheet">
    
    <link href="<?php echo base_url('dashboard/css/plugins/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href=<?php echo base_url('dashboard/font-awesome-4.1.0/css/font-awesome.min.css') ?> rel="stylesheet">

    <!-- Metis Menu Plugin JavaScript -->
   <script src="<?php echo base_url('dashboard/js/plugins/metisMenu/metisMenu.min.js') ?>"></script>
   <link href="<?php echo base_url('dashboard/css/home.css') ?>" rel="stylesheet">

    <!-- Custom Theme JavaScript -->
   <script src="<?php echo base_url('dashboard/js/sb-admin-2.js') ?>"></script>
   

<script type="text/javascript">

	// Ajax post
	$(document).ready(function() {
	$("#submit").click(function(event) {
			event.preventDefault();
			
			var FName = $("input#FName").val();
			var MName = $("input#MName").val();
			var LName = $("input#LName").val();
			var empNumber = $("input#empNumber").val();
			var phone = $("input#phone").val();
			var home_phone = $("input#home_phone").val();
			var email = $("input#email").val();
			var work_email = $("input#work_email").val();
			var identification_number = $("input#identification_number").val();
			var ssn = $("input#ssn").val();
			var pin_number = $("input#pin_number").val();
			var bank_account = $("input#bank_account").val();
			var dateofbirth = $("input#dateofbirth").val();
			
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/hcm/pne",
			dataType: 'json',
			data: {FName: FName, MName: MName, LName: LName, empNumber: empNumber, phone: phone, home_phone: home_phone, email: email, 
					work_email: work_email, identification_number: identification_number, ssn: ssn, pin_number: pin_number, bank_account: bank_account,
					dateofbirth: dateofbirth },
			success: function(res) { 
			if (res){
			
				$("#submit").hide();
				// Show Entered Value
				jQuery("div#result").show();
				jQuery("div#value_FName").html(res.FName);
				jQuery("div#value_MName").html(res.MName);
				jQuery("div#value_LName").html(res.LName);
				jQuery("div#value_empNumber").html(res.empNumber);
				jQuery("div#value_phone").html(res.phone);
				jQuery("div#value_home_phone").html(res.home_phone);
				jQuery("div#value_email").html(res.email);
				jQuery("div#value_work_email").html(res.work_email);
				jQuery("div#value_identification_number").html(res.identification_number);
				jQuery("div#value_ssn").html(res.ssn);
				jQuery("div#value_pin_number").html(res.pin_number);
				jQuery("div#value_bank_account").html(res.bank_account);
				jQuery("div#value_dateofbirth").html(res.dateofbirth); 
			}		
			}
			});
			
			
		});
		
		$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		 });
		 
		 //Show spinner
		 
		 $("#spinner").bind("ajaxSend", function() {
	        $(this).show();
	   		 }).bind("ajaxStop", function() {
	        $(this).show();
	   		 }).bind("ajaxError", function() {  
	        $(this).show();
    	});
		 
	});
</script>

</head>
<body>
	<div id="page-wrapper">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">				
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"> :::: ADD USER :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  			<div id="spinner" class="spinner" style="display:none;">
    					<img id="img-spinner" src="<?php echo base_url(); ?> /assets/img/ajax-loader.gif" alt="Loading"/>
						</div>
			  			
			  			<div id="form_input">
							<?php
							
							// Form Open
							echo form_open('hcm/pne');
							echo "<div class='col-md-3'>";
							// First Name Field
							echo form_label('Emloyees\' First Name');
							$data_name = array(
							'name' => 'FName',
							'class' => 'form-control',
							'placeholder' => 'Enter First Name',
							'id' => 'FName',
							'required' => 'required',
							'autofocus' => true,
							);
							echo form_input($data_name);
							echo br();
							
							// Middle Name Field
							echo form_label('Emloyees\' Middle Name');
							$data_name = array(
							'type' => 'text',
							'name' => 'MName',
							'class' => 'form-control',
							'placeholder' => 'Enter Middle Name',
							'id' => 'MName'
							);
							echo form_input($data_name); 
							echo br();
							
							// Last Name Field
							echo form_label('Emloyees\' Last Name');
							$data_name = array(
							'type' => 'text',
							'name' => 'LName',
							'class' => 'form-control',
							'placeholder' => 'Enter Last Name',
							'id' => 'LName',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo br();
							
							// Employee Number Field
							echo form_label('Emloyee Number / Username');
							$data_name = array(
							'type' => 'text',
							'name' => 'empNumber',
							'class' => 'form-control',
							'placeholder' => 'Enter Employee Number',
							'id' => 'empNumber',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo br();
							echo "</div>";
							
							
							//Column 2
							
							echo "<div class='col-md-3'>";
							// Phone Field
							echo form_label('Mobile Number');
							$data_name = array(
							'name' => 'phone',
							'class' => 'form-control',
							'placeholder' => 'Mobile Number',
							'id' => 'phone'
							);
							echo form_input($data_name);
							echo br();
							
							// Category Field
							echo form_label('Home Phone');
							$data_name = array(
							'type' => 'text',
							'name' => 'home_phone',
							'class' => 'form-control',
							'placeholder' => 'Home Phone Number',
							'id' => 'home_phone'
							);
							echo form_input($data_name); 
							echo br();
							
							// Personal Email Field
							echo form_label('Personal Email');
							$data_name = array(
							'type' => 'email',
							'name' => 'email',
							'class' => 'form-control',
							'placeholder' => 'Personal Email',
							'id' => 'email'
							);
							echo form_input($data_name); 
							echo br();
							
							
							// Personal Email Field
							echo form_label('Work Email');
							$data_name = array(
							'type' => 'email',
							'name' => 'work_email',
							'class' => 'form-control',
							'placeholder' => 'Work Email',
							'id' => 'work_email'
							);
							echo form_input($data_name); 
							echo br();
							
							
							echo "</div>";
							
							echo "<div class='col-md-3'>";
								// Name Field
								echo form_label('ID/Passport Number');
								$data_name = array(
								'name' => 'identification_number',
								'type' => 'text',
								'class' => 'form-control',
								'placeholder' => 'Please Enter Name',
								'id' => 'identification_number'
								);
								echo form_input($data_name);
								echo br();
								
								// SSN Field
								echo form_label('Social Security Number');
								$data_name = array(
								'type' => 'text',
								'name' => 'ssn',
								'class' => 'form-control',
								'placeholder' => 'Social Security Number',
								'id' => 'ssn'
								);
								echo form_input($data_name); 
								echo br();
								
								// Pin Number Field
								echo form_label('Pin Number');
								$data_name = array(
								'type' => 'text',
								'name' => 'pin_number',
								'class' => 'form-control',
								'placeholder' => 'Enter Pin Number',
								'id' => 'pin_number'
								);
								echo form_input($data_name); 
								echo br();
								
								// Bank Account Field
								echo form_label('Bank Account');
								$data_name = array(
								'type' => 'text',
								'name' => 'pin_number',
								'class' => 'form-control',
								'placeholder' => 'Enter Bank Account',
								'id' => 'bank_account'       
								);
								echo form_input($data_name); 
								echo br();
							echo "</div>";
							
							echo "<div class='col-md-3'>";
								// Name Field
								echo form_label('Date of Birth');
								$data_name = array(
								'name' => 'dateofbirth',
								'type' => 'date',
								'class' => 'form-control',
								'placeholder' => '',
								'id' => 'dateofbirth'
								);
								echo form_input($data_name);
								echo br();
								
								// SSN Field
								echo form_label('Date of Joining');
								$data_name = array(
								'type' => 'date',
								'name' => 'ssn',
								'class' => 'form-control',
								'placeholder' => 'Social Security Number',
								'id' => 'ssn'
								);
								echo form_input($data_name); 
								echo br();
								
								// Pin Number Field
								echo form_label('Marital Status');
								$data_name = array(
								'type' => 'text',
								'name' => 'pin_number',
								'class' => 'form-control',
								'placeholder' => 'Enter Marital Status',
								'id' => 'pin_number'
								);
								echo form_input($data_name); 
								echo br();
								
								// Bank Account Field
								echo form_label('Gender');
								$data_name = array(
												'M' => 'Male',
												'F' => 'Female',
								);
								echo form_dropdown('gender', $data_name, '', "class='form-control'"); 
								echo br();
							echo "</div>";
							
							
							echo "</div>";
							
							
							?>
						
							<?php echo form_submit('submit', 'Submit', "class=' btn btn-lg btn-block $buttonclass' id='submit'"); ?>
					
							<?php
							// Form Close
							echo form_close(); ?>
							<?php
							
							// Display Result Using Ajax
							echo "<div id='result' style='display: none'>";
							echo "<div id='content_result' class='col-md-12'>";
							echo "<h3 id='result_id'>You have aded this employee!</h3> <hr>";
							echo "<div id='result_show'>";
							echo "<div class='col-md-3'>";
							echo "<label class='label_output'>Emloyees' First name : </label> <div id='value_FName'> </div>";
							echo br();
							echo "<label class='label_output'>Emloyees' Middle Name : </label> <div id='value_MName'> </div>";
							echo br();
							echo "<label class='label_output'>Emloyees' Last Name : </label> <div id='value_LName'> </div>";
							echo br();
							echo "<label class='label_output'>Emloyee Number : </label> <div id='value_empNumber'> </div>";
							echo "</div>";
							echo "<div class='col-md-3'>";
							echo "<label class='label_output'>Phone Number : </label> <div id='value_phone'> </div>";
							echo br();
							echo "<label class='label_output'>Home Phone : </label> <div id='value_home_phone'> </div>";
							echo br();
							echo "<label class='label_output'>Personal Email : </label> <div id='value_email'> </div>";
							echo br();
							echo "<label class='label_output'>Work Email : </label> <div id='value_work_email'> </div>";
							echo "</div>";
							echo "<div class='col-md-3'>";
							echo "<label class='label_output'>ID/Passport Number : </label> <div id='value_identification_number'> </div>";
							echo br();
							echo "<label class='label_output'>Social Secutiy Number : </label> <div id='value_ssn'> </div>";
							echo br();
							echo "<label class='label_output'>Pin Number Number : </label> <div id='value_pin_number'> </div>";
							echo br();
							echo "<label class='label_output'>Bank Account : </label> <div id='value_bank_account'> </div>";
							echo "</div>";
							echo "<div class='col-md-3'>";
							echo "<label class='label_output'>Date of Birth : </label> <div id='value_dateofbirth'> </div>";
							echo "</div>";
							echo "<div>";
							echo form_open('hcm/newEmployee');
							echo form_submit('', 'Next Employee', "class=' btn btn-lg btn-block $buttonclass' id='nextEmp'"); 
							echo form_close(); 
							echo "<div>";
							echo "</div>"; 
							?>
							</div>
						</div>
					</div> 			
							      
				</div> <!-- PPB-->
						</fieldset>
						<?php echo br(3); ?>
				</div>
			</div>
			
			   <?php echo br(3); ?>
							<div class="<?php echo $this->session->userdata('panel'); ?>">
							<div>												
								<h6 align="center"> &copy <?php echo date("Y") . " All Rights Reserved" ;?>
								<?php echo br(2); echo $this->session->userdata('creditline'); ?>	</h6> 
								</div>  
							</div>
			   
		      </div>
		</div>
	</div> 

</body>	



</script>

</html>