
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
			    		<h3 class="panel-title" align="center"> :::: MODIFY EMPLOYEE ACCESS LEVELS:::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  			
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('main/', $attributes) ;
						
							
						
						echo form_label('Employee Number');
							$data_name = array(
							'type' => 'text',
							'name' => 'empNumber',
							'class' => 'form-control',
							'placeholder' => 'Enter Employee Number',
							'id' => 'empNumber',
							'required' => 'required',
							'autofocus' => true,
							);
							echo form_input($data_name); 
							echo "<ul id='finalResult' style='color: red'></ul>";
							// First Name Field
							echo form_label('First Name');
							$data_name = array(
							'name' => 'FName',
							'class' => 'form-control',
							'id' => 'FName',
							'disabled' => 'disabled',
							'placeholder' => 'First Name',
							'value' => '',
							);
							echo form_input($data_name);
							
							// Middle Name Field
							echo form_label('Middle Name');
							$data_name = array(
							'name' => 'MName',
							'class' => 'form-control',
							'id' => 'MName',
							'disabled' => 'disabled',
							'placeholder' => 'Middle Name',
							'value' => '',
							);
							echo form_input($data_name);
							
							// Last Name Field
							echo form_label('Last Name');
							$data_name = array(
							'name' => 'LName',
							'class' => 'form-control',
							'placeholder' => 'Last Name',
							'disabled' => 'disabled',
							'id' => 'LName'
							);
							echo form_input($data_name);
							echo br();
							 ?>
						<?php 	
						echo "<div id='result'>";					
						echo "<div class='col-xl-6'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
						<?php
                        		echo "
				        	<thead>
				        		<tr> 
						        	<th><center>Module</center></th>
						        	<th><center>Section</center></th>
						        	<th><center>Grant</center></th>
						        	
				        		</tr>
				        	</thead>
				        	<tr> <td>Human Capital Management (HCM) </td><td>Add New Employee </td>  <td><center> <input type='checkbox' name='addEmployee' id='addEmployee' value='' /> </center></td>	 </tr> 
				        	<tr> <td>	</td><td>Edit Existing Employee </td>  <td><center> <input type='checkbox' name='editEmployee' id='editEmployee' value=''/> </center></td>	 </tr> 
				        	<tr> <td>	</td><td>Time-card Approvals - (For supervisors) </td>  <td><center> <input type='checkbox' name='timecardApproval' id='timecardApproval'/> </center></td>	 </tr> 
				        	<tr> <td>	</td><td>Leave Approvals - (For supervisors) </td>  <td><center> <input type='checkbox' name='leaveApproval' id='leaveApproval'/> </center></td>	 </tr> 
						
						</table></div></div>";
						
						 echo br(); echo form_submit('submit', 'Update User Access', "class=' btn btn-lg btn-block $buttonclass' id='submit'"); ?>
					
								
							
							
			  	
			    
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
<script type="text/javascript">

	//$("#addEmployee").selected(true);
   $("#addEmployee").change(function(){
	if($(this).is(":checked")){
		$this.val("yes");
		alert($(this).val());
		
	}
});


</script>


</html>