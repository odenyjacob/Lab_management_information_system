
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
   

<script>
	$(document).ready(function(){
		
		$("#submit").click(function(event) {
			event.preventDefault();});
		
	  $("#search").keyup(function(){
	  	if($('#search').val()==""){
	  	$('#finalResult').html("");
	  }
		if($("#search").val().length>0){
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>" + "index.php/fms/pni", 
			cache: false,				
			data:'search='+$("#search").val(), 
			success: function(response){
				$('#finalResult').html("");
				var obj = JSON.parse(response);
				if(obj.length>0){
					try{
						var items=[]; 	
						$.each(obj, function(i,val){											
						    items.push($('<li/>').text(val.account_name + "- " + val.account_branch));
						});	
						$('#finalResult').append.apply($('#finalResult'), items);
					}catch(e) {		
						alert('Exception while request..');
					}		
				}else{
					$('#finalResult').html($('<li/>').text("No Data Found"));		
				}		
				
			},
			error: function(){						
				alert('Error while request..');  
			}
		});
		}
		return false;
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
			    		<h3 class="panel-title" align="center"> :::: NEW LPO :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			<div id="form_input">
							<?php
							
							// Form Open
							echo form_open('fms/plpo');
							echo "<div class='col-md-3'>";
							// First Name Field
							echo form_label('LPO Number');
							$data_name = array(
							'name' => 'FName',
							'class' => 'form-control',
							'id' => 'FName',
							'disabled' => 'disabled',
							'required' => 'required',
							'value' => date('ymdhis').random_string('alnum', 4),
							);
							echo form_input($data_name);
							echo br();
														
							// Employee Number Field
							echo form_label('Account Number');
							$data_name = array(
							'type' => 'text',
							'name' => 'search',
							'class' => 'form-control',
							'placeholder' => 'Enter Employee Number',
							'id' => 'search',
							'required' => 'required',
							'autofocus' => true,
							);
							echo form_input($data_name); 
							echo "<ul id='finalResult'></ul>";
							echo br();
							echo "</div>";
							
							
							//Column 2
							
							echo "<div class='col-md-3'>";
							// Phone Field
							echo form_label('Phone Number');
							$data_name = array(
							'name' => 'phone',
							'class' => 'form-control',
							'placeholder' => 'Enter Phone Number (Mobile)',
							'id' => 'phone'
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
							
								
								// Bank Account Field
								echo form_label('Gender');
								$data_name = array(
												'M' => 'Male',
												'F' => 'Female',
								);
								echo form_dropdown('gender', $data_name); 
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
							echo "</div>";
							echo "<div class='col-md-3'>";
							echo "<label class='label_output'>Phone Number : </label> <div id='value_phone'> </div>";
							echo br();
							echo "<label class='label_output'>Home Phone : </label> <div id='value_home_phone'> </div>";
							echo "</div>";
							echo "<div class='col-md-3'>";
							echo "<label class='label_output'>ID/Passport Number : </label> <div id='value_identification_number'> </div>";
							echo br();
							echo "<label class='label_output'>Social Secutiy Number : </label> <div id='value_ssn'> </div>";
							echo br(); 
							echo "</div>";
							echo "<div class='col-md-3'>";
							echo "<label class='label_output'>Date of Birth : </label> <div id='value_dateofbirth'> </div>";
							echo "</div>";
							echo "<div>";
							echo form_submit('', 'Next Employee', "class=' btn btn-lg btn-block $buttonclass' id='nextEmp'"); 
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