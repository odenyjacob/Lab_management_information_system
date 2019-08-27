<?php
	if($access['newImprest']!='yes'){
		redirect('main/unauthorized');
		exit;
	}
?>
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
			$(this).hide();
			
			if($("#Account").val()===""){
				alert('Account Name can not be empty');
				$("#submit").show();
				exit;
			}
			if($("#payee_account").val()===""){
				alert('Payee Account can not be empty');
				$("#submit").show();
				exit;
			}
			
			var impNumber = $("#impNumber").val();
			var account_number = $("#account_number").val();
			var Account = $("#Account").val();
			var payee = $("#payee").val();
			var payee_account = $("#payee_account").val();
			var amount = $("#amount").val();
			var purpose = $("#purpose").val();
			var remarks = $("#remarks").val();
			var approver = $("#approver").val();
			var approvers_name = $("#approvers_name").val();
			
			$.ajax({
				type: 'post',
				url : '<?php echo base_url(); ?>' + "index.php/fms/pniRequest", 
				dataType: 'json',
				data: {
					impNumber: impNumber,
					account_number: account_number,
					Account: Account,
					payee: payee,
					payee_account: payee_account,
					amount: amount,
					purpose: purpose,
					remarks: remarks,
					approver: approver,
					approvers_name: approvers_name,
				},
				success: function (response) {
					if(response){
						alert('Imprest Request Submitted Successfully!');
					}else{
						alert('Error while processing, Try again');
						$("#submit").show();
					}  
				}
				
			});
		});
		
	 $("#account_number").keyup(function(){
	  	if($('#account_number').val()==""){
	  	$('#finalResult').html("");
	  	$('#Account').val("");
	  }
		if($("#account_number").val().length>0){
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>" + "index.php/fms/pni", 
			cache: false,				
			data:'account_number='+$("#account_number").val(), 
			success: function(response){
				$('#finalResult').html("");
				$('#Account').val("");
				var obj = JSON.parse(response);
				if(obj.length>0){
					try{
						var items=[]; 	
						$.each(obj, function(i,val){
						    items.push($('#Account').val(val.account_number +"-" + val.account_name +" Account " ));
						});	
						
						
					}catch(e) {		
						alert('Exception while request..');
					}		
				}else{
					$('#finalResult').html($('<li/>').text("No Account linked to the Number"));		
				}		
				
			},
			error: function(){						
				alert('Error while request..');  
			}
		});
		}
		return false;
	  });
	  
	 $("#payee").keyup(function(){
	  	if($('#payee').val()==""){
	  	$('#payeeResult').html("");
	  	$('#payee_account').val("");
	  }
		if($("#payee").val().length>0){
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>" + "index.php/fms/pniPayee", 
			cache: false,				
			data:'payee='+$("#payee").val(), 
			success: function(response){
				$('#payeeResult').html("");
				$('#payee_account').val("");
				var obj = JSON.parse(response);
				if(obj.length>0){
					try{
						var items=[]; 	
						$.each(obj, function(i,val){
						    items.push($('#payee_account').val(val.userName +" - " + val.FName +" " + val.LName  ));
						});	
						
						
					}catch(e) {		
						alert('Exception while request..');
					}		
				}else{
					$('#payeeResult').html($('<li/>').text("No linked account"));		
				}		
				
			},
			error: function(){						
				alert('Error while request..');  
			}
		});
		}
		return false;
	  });
	  
	   $("#approver").keyup(function(){
	  	if($('#approver').val()==""){
	  	$('#approversResult').html("");
	  	$('#approvers_name').val("");
	  }
		if($("#approver").val().length>0){
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>" + "index.php/fms/pniApprover", 
			cache: false,				
			data:'approver='+$("#approver").val(), 
			success: function(response){
				$('#approversResult').html("");
				$('#approvers_name').val("");
				var obj = JSON.parse(response); 
				if(obj.length>0){
					try{
						var items=[]; 	
						$.each(obj, function(i,val){
						    items.push($('#approvers_name').val(val.userName +" - " + val.FName +" " + val.LName  ));
						});	
						
						
					}catch(e) {		
						alert('Exception while request..');
					}		
				}else{
					$('#approversResult').html($('<li/>').text("No linked Approver"));		
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
			    		<h3 class="panel-title" align="center"> :::: NEW IMPREST REQUEST :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			<div id="form_input">
							<?php
							
							// Form Open
							echo form_open('fms/plpo');
							echo "<div class='col-md-3'>";
							// First Name Field
							echo form_label('Imprest Number');
							$data_name = array(
							'name' => 'impNumber',
							'class' => 'form-control',
							'id' => 'impNumber',
							'disabled' => 'disabled',
							'required' => 'required',
							'value' => date('ymdhis').random_string('alnum', 2),
							);
							echo form_input($data_name);
							echo br();
														
							// Employee Number Field
							echo form_label('Account Number');
							$data_name = array(
							'type' => 'text',
							'name' => 'account_number',
							'class' => 'form-control',
							'placeholder' => 'Enter Account Number',
							'id' => 'account_number',
							'required' => 'required',
							'autofocus' => true,
							);
							echo form_input($data_name); 
							echo "<ul id='finalResult'></ul>";
													
														
							// Employee Number Field
							echo form_label('Account Name');
							$data_name = array(
							'type' => 'text',
							'name' => 'Account',
							'class' => 'form-control',
							'placeholder' => 'Account Name',
							'id' => 'Account',
							'required' => 'required',
							'disabled' => 'disabled',
							);
							echo form_input($data_name); 
							echo br();
							echo "</div>";
							
							
							//Column 2
							
							echo "<div class='col-md-3'>";
							// Pay To Field
							echo form_label('Pay To (Username/Account)');
							$data_name = array(
							'name' => 'payee',
							'class' => 'form-control',
							'placeholder' => 'Pay To',
							'id' => 'payee'
							);
							echo form_input($data_name);
							echo "<ul id='payeeResult'></ul>";
							
							// Pay To Field
							echo form_label('Pay to Account (Name)');
							$data_name = array(
							'name' => 'payee_account',
							'class' => 'form-control',
							'placeholder' => 'Paid to Account Name',
							'id' => 'payee_account',
							'disabled' => 'disabled'
							);
							echo form_input($data_name);
							echo br();
							
							
							
							// Personal Email Field
							echo form_label('Amount');
							$data_name = array(
							'type' => 'number',
							'name' => 'amount',
							'class' => 'form-control',
							'placeholder' => ' Amount',
							'id' => 'amount',
							'step' => '0.01'
							);
							echo form_input($data_name); 
							echo br();
							
							
							echo "</div>";
							
							echo "<div class='col-md-3'>";
								// Name Field
								echo form_label('Purpose/Use');
								$data_name = array(
								'name' => 'purpose',
								'type' => 'text',
								'class' => 'form-control',
								'placeholder' => 'Purpose/Use',
								'id' => 'purpose'
								);
								echo form_input($data_name);
								echo br();
								
							
								
								// Bank Account Field
								echo form_label('Remarks');
								$data_name = array(
								'type' => 'text',
								'name' => 'remarks',
								'class' => 'form-control',
								'placeholder' => 'Remarks',
								'id' => 'remarks'       
								);
								echo form_input($data_name); 
								echo br();
							echo "</div>";
							
							echo "<div class='col-md-3'>";
								// Approvers'  Field
								echo form_label('Approvers\' Account Name');
								$data_name = array(
								'name' => 'approver',
								'type' => 'text',
								'class' => 'form-control',
								'placeholder' => 'Approvers\' Account Name',
								'id' => 'approver'
								);
								echo form_input($data_name);
								echo "<ul id='approversResult'></ul>";								
							
								
								// Approvers'  Field
								echo form_label('Approvers\' Details');
								$data_name = array(
								'name' => 'approvers_name',
								'type' => 'text',
								'class' => 'form-control',
								'placeholder' => 'Approvers\' Name',
								'id' => 'approvers_name',
								'disabled' => 'disabled',
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