
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
			event.preventDefault();
			
			var empNumber = $("input#empNumber").val();
			var basic_salary = $("input#basic_salary").val();
			var house_allowance = $("input#house_allowance").val();
			var medical_allowance = $("input#medical_allowance").val();
			var over_time = $("input#over_time").val();
			var travel_reimbursement = $("input#travel_reimbursement").val();
			var arrears = $("input#arrears").val();
			var supplement1 = $("input#supplement1").val();
			var supplement2 = $("input#supplement2").val();
			var supplement3 = $("input#supplement3").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/fms/peb",
				dataType: 'json',
				data: {
					empNumber: empNumber,
					basic_salary: basic_salary,
					house_allowance: house_allowance,
					medical_allowance: medical_allowance,
					over_time: over_time,
					travel_reimbursement: travel_reimbursement,
					arrears: arrears,
					supplement1: supplement1,
					supplement2: supplement2,
					supplement3: supplement3,
				},
			success: function(response){
				if(response){
					alert('Employee Benefit Added successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
			
			
		});
		
	  $("#empNumber").keyup(function(){
	  	if($('#empNumber').val()==""){
	  	$('#finalResult').html("");
	  }
		if($("#empNumber").val().length>0){
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>" + "index.php/fms/eB", 
			cache: false,				
			data:'empNumber='+$("#empNumber").val(), 
			success: function(response){
				$('#finalResult').html("");
				$('#FName').val("");
				$('#LName').val("");
				$('#MName').val("");
				var obj = JSON.parse(response);
				if(obj.length>0){
					try{
						var items=[]; 	
						$.each(obj, function(i,val){									
						   // items.push($('LName').text(val.empNumber + "- " + val.FName + "-" + val.LName));
						    items.push($('#LName').val(val.LName ));
						    items.push($('#FName').val(val.FName ));
						    items.push($('#MName').val(val.MName ));
						});	
						
						
					}catch(e) {		
						alert('Exception while request..');
					}		
				}else{
					$('#finalResult').html($('<li/>').text("No employee linked to the ID"));		
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
			    		<h3 class="panel-title" align="center"> :::: NEW EMPLOYEE BENEFITS :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			<div id="form_input">
							<?php
							
							// Form Open
							echo form_open('fms/plpo');
							echo "<div class='col-md-3'>";							
														
							// Employee Number Field
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
							echo "<ul id='finalResult'></ul>";
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
							echo "</div>";
							
							
							//Column 2
							
							echo "<div class='col-md-3'>";
							
							// Basic Salary Field
							echo form_label('Basic Salary');
							$data_name = array(
							'type' => 'number',
							'name' => 'basic_salary',
							'class' => 'form-control',
							'placeholder' => ' Basic Salary',
							'id' => 'basic_salary',
							'value'=> '',
							'step' => '0.01'
							);
							echo form_input($data_name); 
							echo br();
							
							// House Allowance Field
							echo form_label('House Allowance');
							$data_name = array(
							'type' => 'number',
							'name' => 'house_allowance',
							'class' => 'form-control',
							'placeholder' => ' House Allowance',
							'id' => 'house_allowance',
							'value'=> '',
							'step' => '0.01'
							);
							echo form_input($data_name); 
							echo br();
							
							// House Allowance Field
							echo form_label('Medical Allowance');
							$data_name = array(
							'type' => 'number',
							'name' => 'medical_allowance',
							'class' => 'form-control',
							'placeholder' => 'Medical Allowance',
							'id' => 'medical_allowance',
							'value'=> '',
							'step' => '0.01'
							);
							echo form_input($data_name); 
							echo br();
							
							
							echo "</div>";
							
							echo "<div class='col-md-3'>";
								// Name Field
								echo form_label('Over Time');
								$data_name = array(
								'name' => 'over_time',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Over Time',
								'id' => 'over_time', 
								'step' => '0.01'
								);
								echo form_input($data_name);
								echo br();
							
								
								// Travel Reimbursement Field
								echo form_label('Travel Reimbursement');
								$data_name = array(
								'type' => 'number',
								'name' => 'travel_reimbursement',
								'class' => 'form-control',
								'placeholder' => 'Travel Reimbursement',
								'id' => 'travel_reimbursement',
								'step' => '0.01'      
								);
								echo form_input($data_name); 
								echo br();
								
								// Arrears Field
								echo form_label('Arrears');
								$data_name = array(
								'type' => 'number',
								'name' => 'arrears',
								'class' => 'form-control',
								'placeholder' => 'Arrears',
								'id' => 'arrears',
								'step' => '0.01'       
								);
								echo form_input($data_name); 
								echo br();
							echo "</div>";
							
							echo "<div class='col-md-3'>";
								// Supplement 1 Field
								echo form_label('Supplement I');
								$data_name = array(
								'name' => 'supplement1',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Supplement I',
								'id' => 'supplement1',
								'step' => '0.01'
								);
								echo form_input($data_name);
								echo br();	
															
								// Supplement 2 Field
								echo form_label('Supplement II');
								$data_name = array(
								'name' => 'supplement2',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Supplement II',
								'id' => 'supplement2',
								'step' => '0.01'
								);
								echo form_input($data_name);
								echo br();	
															
								// Supplement 3 Field
								echo form_label('Supplement III');
								$data_name = array(
								'name' => 'supplement3',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Supplement III',
								'id' => 'supplement3',
								'step' => '0.01'
								);
								echo form_input($data_name);
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