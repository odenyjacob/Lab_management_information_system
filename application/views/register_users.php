<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PPB-KPA Registration</title>
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

    <!-- Custom Theme JavaScript -->
   <script src="<?php echo base_url('dashboard/js/sb-admin-2.js') ?>"></script>
	

	
</head>
<body>

	<div id="page-wrapper">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<div class="panel panel-primary">
			  		<div class="panel-heading">
			    		<h3 class="panel-title">SHILOAH [User Registration] </h3>
			  		</div>
			  		<div class="panel-body"> 
			  			<fieldset>
			  			<?php echo validation_errors(); ?> 
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'screeningform');?>	 
						<?php echo form_open('main/register_user_proc', $attributes) ; ?>	 
					<div class="panel-body">
                        <form role="form">
                            <fieldset> 
                            	<?php 
                            		$FName = array(
											'name' => 'FName',
											'id' => 'FName',
											'required' => 'required',
											'type' => 'text',
											'class' => 'form-control',
											'placeholder' =>'First Name',
											'autofocus' => 'TRUE',
									);
									
									$LName = array(
											'name' => 'LName',
											'id' => 'LName',
											'required' => 'required',
											'type' => 'text',
											'class' => 'form-control',
											'placeholder' =>'Last Name',
									);
									
									$location = array(
											'Kisumu',
											'Nairobi',
											'Kitale',
											'Kakamega',
									);
									
									$role = array(
											'Administrator',
											'Clerk',
											'IT',
											'Auxillary',
											'Financial',
									);
									
									
									
									$userName = array(
											'name' =>'userName',
											'type' => 'text',
											'id' => 'userName',
											'class' => 'form-control',
											'required' => 'required',
											'placeholder' =>'Username',
									);
									
									$enrollmentDate = array(
											'name' =>'enrollmentDate',
											'type' => 'date',
											'id' => 'enrollmentDate',
											'class' => 'form-control',
											'required' => 'required',
											'placeholder' =>'Enrollment Date',
									);
									$phone = array(
											'name' =>'phone',
											'type' => 'integer',
											'id' => 'phone',
											'class' => 'form-control',
											'required' => 'required',
											'placeholder' =>'Phone Number',
									);
									
									$email = array(
											'name' =>'email',
											'type' => 'email',
											'id' => 'email',
											'class' => 'form-control',
											'required' => 'required',
											'placeholder' =>'Email Address',
									);
									
									
									
									$password = array(
											'name' => 'password',
											'class' => 'form-control',
									);
									
									
								echo "'<div class='form-group'>";	
								echo form_label("First Name", "FName");
								echo form_input($FName);
								echo form_label("Last Name", "LName"); 
								echo form_input($LName);
								echo form_label("Location", "location");
								echo form_dropdown("location", $location, "", "class='form-control' id='location'");
								echo form_label("Username", "userName");
								echo form_input($userName);
								echo form_label("Password", "password");
								echo form_password($password);								
								echo form_label("Role", "role");
								echo form_dropdown("role", $role, "", "class='form-control' id='role'");
								//echo form_label("KPA Certificate Number", "certNo");
								//echo form_input($certNo);								
								//echo form_label("Enrollment Date", "enrollmentDate");
								//echo form_input($enrollmentDate);								
								echo form_label("Phone Number", "phone");
								echo form_input($phone);
								echo form_label("Email", "email");
								echo form_input($email);
								//echo form_label("Physical Location/Address", "location");
								//echo form_input($location);
								//echo form_label("Next of Kin", "nextofKin");
								//echo form_input($nextofKin);
								
								echo "</div>";                            	
                            	
                            	?>
                            
                                
                                <!-- Change this to a button or input when using this as a form -->
                               <?php echo form_submit('submit', 'Create User', 'class="btn btn-lg btn-success btn-block" id="register" ' ); ?>                                
                                <?php echo form_close(); ?>
                            </fieldset>
                        </form>
                    </div>
		
		
				        
						
				       </div></div>
				</div>
		       </div>
		      </div>
		</div>
	</div>
	
			

</body>
<script type='text/javascript'>
	/*
	$('#register').click(function()(
		
		$ajax({
			type: "POST",
			url: "main/register"
		})
		.done(function(msg){
			alert("Registration: " );
		});
	));
	*/
</script>



</html>