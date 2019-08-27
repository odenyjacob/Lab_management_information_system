
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
			
			if($("#FName").val()==""){
				alert("First Name can not be empty");
				exit;
			}
			
			var empNumber = $("#empNumber").val();
			var paye = $("#paye").val();
			var bank_loan = $("#bank_loan").val();
			var medical_contribution = $("#medical_contribution").val();
			var sacco_loan = $("#sacco_loan").val();
			var cash_advance = $("#cash_advance").val();
			var student_loan = $("#student_loan").val();
			var ssf = $("#ssf").val();
			var otherdeductions1 = $("#otherdeductions1").val();
			var otherdeductions2 = $("#otherdeductions2").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/fms/ped",
				dataType: 'json',
				data: {
					empNumber: empNumber,
					paye: paye,
					bank_loan: bank_loan,
					medical_contribution: medical_contribution,
					sacco_loan: sacco_loan,
					cash_advance: cash_advance,
					student_loan: student_loan,
					ssf: ssf,
					otherdeductions1: otherdeductions1,
					otherdeductions2: otherdeductions2,
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
			url: "<?php echo base_url(); ?>" + "index.php/fms/eD", 
			cache: false,				
			data:'empNumber='+$("#empNumber").val(), 
			success: function(response){
				$('#finalResult').html("");
				$('#FName').val("");
				$('#LName').val("");
				$('#MName').val("");
				$('#paye').val("");
				$('#bank_loan').val("");
				$('#medical_contribution').val("");
				$('#sacco_loan').val("");
				$('#cash_advance').val("");
				$('#student_loan').val("");
				$('#ssf').val("");
				$('#otherdeductions1').val("");
				$('#otherdeductions2').val("");
				var obj = JSON.parse(response);
				if(obj.length>0){
					try{
						var items=[]; 	
						$.each(obj, function(i,val){									
						   // items.push($('LName').text(val.empNumber + "- " + val.FName + "-" + val.LName));
						    items.push($('#LName').val(val.LName ));
						    items.push($('#FName').val(val.FName ));
						    items.push($('#MName').val(val.MName ));
						    items.push($('#paye').val(val.paye ));
						    items.push($('#bank_loan').val(val.bank_loan ));
						    items.push($('#medical_contribution').val(val.medical_contribution ));
						    items.push($('#sacco_loan').val(val.sacco_loan ));
						    items.push($('#cash_advance').val(val.cash_advance ));
						    items.push($('#student_loan').val(val.student_loan ));
						    items.push($('#ssf').val(val.ssf ));
						    items.push($('#otherdeductions1').val(val.otherdeductions1 ));
						    items.push($('#otherdeductions2').val(val.otherdeductions2 ));
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
			    		<h3 class="panel-title" align="center"> :::: EMPLOYEE DEDUCTIONS :::</h3>  
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
							echo form_label('PAYE');
							$data_name = array(
							'type' => 'number',
							'name' => 'paye',
							'class' => 'form-control',
							'placeholder' => 'PAYE',
							'disabled' => 'disabled',
							'id' => 'paye',
							'value'=> '',
							'step' => '0.01'
							);
							echo form_input($data_name); 
							echo br();
							
							// House Allowance Field
							echo form_label('Bank Loan');
							$data_name = array(
							'type' => 'number',
							'name' => 'bank_loan',
							'class' => 'form-control',
							'placeholder' => 'Bank Loan',
							'id' => 'bank_loan',
							'value'=> '',
							'step' => '0.01'
							);
							echo form_input($data_name); 
							echo br();
							
							// House Allowance Field
							echo form_label('Medical Contribution');
							$data_name = array(
							'type' => 'number',
							'name' => 'medical_contribution',
							'class' => 'form-control',
							'placeholder' => 'Medical Contribution',
							'id' => 'medical_contribution',
							'value'=> '',
							'step' => '0.01'
							);
							echo form_input($data_name); 
							echo br();
							
							
							echo "</div>";
							
							//Column 3
							
							echo "<div class='col-md-3'>";
								// Name Field
								echo form_label('Sacco Loan');
								$data_name = array(
								'name' => 'sacco_loan',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Sacco Loan',
								'id' => 'sacco_loan', 
								'step' => '0.01'
								);
								echo form_input($data_name);
								echo br();
							
								
								// Travel Reimbursement Field
								echo form_label('Cash Advance');
								$data_name = array(
								'type' => 'number',
								'name' => 'cash_advance',
								'class' => 'form-control',
								'placeholder' => 'Cash Advance',
								'id' => 'cash_advance',
								'step' => '0.01'      
								);
								echo form_input($data_name); 
								echo br();
								
								// Arrears Field
								echo form_label('Student Loan');
								$data_name = array(
								'type' => 'number',
								'name' => 'student_loan',
								'class' => 'form-control',
								'placeholder' => 'Student Loan',
								'id' => 'student_loan',
								'step' => '0.01'       
								);
								echo form_input($data_name); 
								echo br();
							echo "</div>";
							
							
							//Column 4
							echo "<div class='col-md-3'>";
								// Social Security Field
								echo form_label('Social Security Fund');
								$data_name = array(
								'name' => 'ssf',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Social Security Fund',
								'id' => 'ssf',
								'step' => '0.01'
								);
								echo form_input($data_name);
								echo br();	
															
								// Supplement 2 Field
								echo form_label('Other Deductions I');
								$data_name = array(
								'name' => 'otherdeductions1',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Other Deductions I',
								'id' => 'otherdeductions1',
								'step' => '0.01'
								);
								echo form_input($data_name);
								echo br();	
															
								// Supplement 3 Field
								echo form_label('Other Deductions II');
								$data_name = array(
								'name' => 'otherdeductions2',
								'type' => 'number',
								'class' => 'form-control',
								'placeholder' => 'Other Deductions II',
								'id' => 'otherdeductions2',
								'step' => '0.01'
								);
								echo form_input($data_name);
								echo br();								
							
								
							echo "</div>";   
							
							
							
							
							?>
						
							<?php echo form_submit('submit', 'Submit', "class=' btn btn-lg btn-block $buttonclass' id='submit'"); ?>
					
							<?php
							// Form Close
							echo form_close(); ?>
						
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