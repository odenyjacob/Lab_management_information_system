
<style>
.zoom{
	transition: all .2s ease-in-out;
}
.zoom:hover{
	text-decoration:overline;
	text-transform: uppercase;
	color: red;
}

.bodyzoom{
	transition: all .2s ease-in-out; 
}

.bodyzoom:hover{
	text-decoration:overline;
	text-transform: uppercase;
	//text-shadow: 4px 5px #ccc;
	color: red;
}


</style>

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
   

</head>
<body>
	<div id="page-wrapper">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">				
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"> :::: EMPLOYEE PROFILE:::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  			
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('main/', $attributes) ; ?>	
						
						<div class="col-md-3 "> 
							<h4 class="<?php echo $this->session->userdata('bg'); ?>">GENERAL INFO </h4>					
							<?php
							 echo "<div class='bodyzoom'>";
							 echo '<b> First Name </b>'; echo br(); echo $info['FName'];
							 echo "</div>";						
							 echo br(); 	
							 echo "<div class='bodyzoom'>";						 
							 echo '<b> Middle Name </b> '; echo br(); echo $info['MName'];  
							 echo "</div>";
							 echo br();
							 echo "<div class='bodyzoom'>";							 
							 echo '<b>Last Name </b>'; echo br(); echo $info['LName']; 
							 echo "</div>";						 
							
							 ?>
							 
							<?php echo br(2); ?>
							</div>						
							

							
						<div class="col-md-3 "> 
							<h4 class="<?php echo $this->session->userdata('bg'); ?>">CONTACT INFO </h4>					
							<?php
							 echo "<div class='bodyzoom'>";
							 echo '<b> Email 1 </b>'; echo br(); echo $info['email'];
							 echo "</div>";						
							 echo br(); 	
							 echo "<div class='bodyzoom'>";						 
							 echo '<b> Email 2 </b> '; echo br(); echo $info['email'];  
							 echo "</div>";
							 echo br();
							 echo "<div class='bodyzoom'>";							 
							 echo '<b>Work Email </b>'; echo br(); echo $info['work_email']; 
							 echo "</div>";						 
							
							 ?>
							 
							<?php echo br(2); ?>
							</div>	
							
							
							<div class="col-md-3"> 
							<h4 class="<?php echo $this->session->userdata('bg'); ?>">REGULATORY INFO </i> </h4>					
							<?php
							 echo "<div class='bodyzoom'>";
							 echo '<b> ID Number </b>'; echo br(); echo $info['identification_number'];
							 echo "</div>";						
							 echo br(); 	
							 echo "<div class='bodyzoom'>";						 
							 echo '<b> SSF No </b> '; echo br(); echo $info['ssn'];  
							 echo "</div>";
							 echo br();
							 echo "<div class='bodyzoom'>";							 
							 echo '<b>MED. No </b>'; echo br(); echo $info['NHIFno']; 
							 echo "</div>";						 
							
							 ?>
							 
							<?php echo br(2); ?>
							</div>	
							
							<div class="col-md-3"> 
							<h4 class="<?php echo $this->session->userdata('bg'); ?>">OTHER INFO  </h4>					
							<?php
							 echo "<div class='bodyzoom'>";
							 echo '<b> XXXX </b>'; echo br(); echo $info['identification_number'];
							 echo "</div>";						
							 echo br(); 	
							 echo "<div class='bodyzoom'>";						 
							 echo '<b> XXXX </b> '; echo br(); echo $info['ssn'];  
							 echo "</div>";
							 echo br();
							 echo "<div class='bodyzoom'>";							 
							 echo '<b>XXXX No </b>'; echo br(); echo $info['NHIFno']; 
							 echo "</div>";						 
							
							 ?>
							 
							<?php echo br(2); ?>
							</div>	
							
			  	
			    
						</fieldset>
						<?php echo br(2); ?> 
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


</html>