<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
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
   <?php $buttonclass = $this->session->userdata('buttonClass'); ?>
   
   <link rel="stylesheet" href="<?= base_url('/public/css/dataTable/demo_page.css'); ?>" type="text/css" />
<link rel="stylesheet" href="<?= base_url('/public/css/dataTable/demo_table_jui.css'); ?>" type="text/css" />
<link rel="stylesheet" href="<?= base_url('/public/css/dataTable/smoothness/jquery-ui-1.8.4.custom.css'); ?>" type="text/css" />        
<script type="text/javascript" language="javascript" src="<?= base_url('/public/js/dataTable/jquery.dataTables.min.js'); ?>"></script>

<!-- Validation Engine -->
   <link href="<?= base_url('/public/css/validation/validationEngine.jquery.css'); ?>" type="text/css" rel="stylesheet" />   
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine-en.js'); ?>"></script>
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine.js'); ?>"></script>
	
</head>
<body> 

	<div id="page-wrapper">	
		<div class="row">
			<?php $role = $this->session->userdata('role');?>
			<div class="col-md-12 col-md-offset-0">
			<?php $username = $this->session->userdata('userName');?>
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    	<center>	<h3  class="panel-title">CHANGE PASSWORD [<?php echo " $username - $role "  ?>  ] </h3></center>
			  		</div>
			  		<div class="panel-body"> 
			  		
						<?php
							$attributes = array('class' => 'form-horizontal row-border', 'id' => 'pass_form');
						 echo form_open('main/passchange', $attributes) ; ?>	
						                          
                            	
                    				<label>Username</label>
                                    <input class="form-control" placeholder="userName" id="userName" readonly="readonly" name="uname" type="text" value="<?php echo $username; ?>" >
                            
									<label>Old Password</label>
                                    <input class="form-control validate[required]" placeholder="Old Password" id="old_password" name="old_password" type="password" autocomplete="off" >
                        <center> <div id="spinner" class="spinner" style="display:none;">
    						<img id="img-spinner" src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Wait..."/>
						</div></center>
									<label>New Password</label>
                                    <input class="form-control validate[required]" placeholder="New Password" id="newPassword" name="newPassword" type="password">
                                
									<label>Confirm New Password</label>
                                    <input class="form-control validate[required, equals[newPassword]]" placeholder="Confirm Password" name="cofirmPassword" id="cofirmPassword" type="password">
                            
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <?php echo br(2); echo form_submit('submit', 'Change Password', "class=' btn btn-lg btn-block $buttonclass' id='submit'"); ?>                              
                                <?php echo form_close(); echo br(2); ?>
                            
                    
						
				       </div></div>
				       
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
		</div>
	</div>
	
			

</body>
<script type='text/javascript'>
	$(document).ready(function(){
			$("#submit").click(function(event){
				event.preventDefault();
				save();
			});
		$("#pass_form").validationEngine();
	});
	
	function save(){
		var validate = $("#pass_form").validationEngine("validate");
		
		if(!validate){
			return false;
		}
		
		var old_password = $("#old_password").val();
		var newPassword = $("#newPassword").val();
		
		$("#submit").hide();
		
		$.ajax({
			type: 'post',
			url: "<?php echo base_url(); ?>" + "index.php/main/passchange",
			dataType: 'json',
			data:{old_password: old_password, newPassword: newPassword
			},
			beforeSend: function() {
				$("#spinner").show();
             },
			success: function(res) { 
				$("#spinner").hide();
				alert('Password Changed Successfully!');
				$("#submit").show();			
			},
			error: function(e){
				$("#spinner").hide();
				alert('Error! Password not Changed. Information provided may not be correct.');
				$("#submit").show();
			}
		});
		
	}
	
</script>



</html>