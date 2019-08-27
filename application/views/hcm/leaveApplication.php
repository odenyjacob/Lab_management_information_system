
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
   

<script type="text/javascript">

$(document).ready(function(){
	        
     $("#applyAnnual").click(function(e){
     	event.preventDefault();
     	$("#applyAnnual").hide();
     		var days_applied =  $("#annual").val();
     		var db_annual =  $("#db_annual").val();     		
     		var balance_annual = db_annual-days_applied;     	
     		var leave_start = $("#annual_start").val();
     		var leave_end = $("#annual_end").val();
     		if(days_applied==""){
     			alert("Days applied can not be empty");
     			$("#applyAnnual").show();
     			exit;
     		}
     		if(days_applied<0){
     			alert("Days applied can not be less than zero");
     			$("#annual").val("");
     			$("#applyAnnual").show();
     			exit;
     		}
     		
     		if(leave_start==""){
     			alert("Leave start date can not be empty");
     			$("#applyAnnual").show();
     			exit;
     		}
     		if(leave_end==""){
     			alert("Leave end date can not be empty");
     			$("#applyAnnual").show();
     			exit;
     		}
     	
     	$.ajax({
     		type: "POST",
     		url: "<?php echo base_url(); ?>" + "index.php/hcm/apply_annual",
     		dataType: 'json',
     		data: {
     			days_applied : days_applied, leave_start: leave_start, leave_end: leave_end, balance_annual: balance_annual,
     		},
     		success: function(res){
     			if(res){
     				alert("Congratulations! Annual leave applied successfully!");
     				location.reload(true);
     			}else{
     				alert("Error while processing");
     			}
     		}
     		
     		 
     	});
     	
     });
  //On Apply Maternity Click   	     	
     $("#applyMaternity").click(function(e){
     	event.preventDefault();
     	$("#applyMaternity").hide();
     		var days_applied =  $("#maternity").val();
     		var db_maternity =  $("#db_maternity").val();     		
     		var balance_maternity = db_maternity-days_applied;     	
     		var leave_start = $("#maternity_start").val();
     		var leave_end = $("#maternity_end").val();
     		if(days_applied==""){
     			alert("Days applied can not be empty");
     			$("#applyMaternity").show();
     			exit;
     		}
     		if(days_applied<0){
     			alert("Days applied can not be less than zero");
     			$("#maternity").val("");
     			$("#applyMaternity").show();
     			exit;
     		}
     		
     		if(leave_start==""){
     			alert("Leave start date can not be empty");
     			$("#applyMaternity").show();
     			exit;
     		}
     		if(leave_end==""){
     			alert("Leave end date can not be empty");
     			$("#applyMaternity").show();
     			exit;
     		}
     	
     	$.ajax({
     		type: "POST",
     		url: "<?php echo base_url(); ?>" + "index.php/hcm/apply_maternity",
     		dataType: 'json',
     		data: {
     			days_applied : days_applied, leave_start: leave_start, leave_end: leave_end, balance_maternity: balance_maternity,
     		},
     		success: function(res){
     			if(res){
     				alert("Congratulations! Maternity/Paternity leave applied successfully!");
     				location.reload(true);
     			}else{
     				alert("Error while processing");
     				$("#applyMaternity").show();
     			}
     		}
     		
     		
     	});
     	
     });
     	     	
  //On Sick-leave Click   	     	
     $("#applySick").click(function(e){
     	event.preventDefault();
     	$("#applySick").hide();
     		var days_applied =  $("#sick").val();
     		var db_sick =  $("#db_sick").val();     		
     		var balance_sick = db_sick-days_applied;     	
     		var leave_start = $("#sick_start").val();
     		var leave_end = $("#sick_end").val();
     		if(days_applied==""){
     			alert("Days applied can not be empty");
     			$("#applySick").show();
     			exit;
     		}
     		if(days_applied<0){
     			alert("Days applied can not be less than zero");
     			$("#sick").val("");
     			$("#applySick").show();
     			exit;
     		}
     		
     		if(leave_start==""){
     			alert("Leave start date can not be empty");
     			$("#applySick").show();
     			exit;
     		}
     		if(leave_end==""){
     			alert("Leave end date can not be empty");
     			$("#applySick").show();
     			exit;
     		}
     	
     	$.ajax({
     		type: "POST",
     		url: "<?php echo base_url(); ?>" + "index.php/hcm/apply_sick",
     		dataType: 'json',
     		data: {
     			days_applied : days_applied, leave_start: leave_start, leave_end: leave_end, balance_sick: balance_sick,
     		},
     		success: function(res){
     			if(res){
     				alert("Congratulations! Sick leave applied successfully. Get well soon!");
     				location.reload(true);
     			}else{
     				alert("Error while processing");
     				$("#applySick").show();
     			}
     		}
     		
     		
     	});
     	
     });
     	     	
   //Validating Annual Section	
	$("#annual").keyup(function(){
     		var annual =  $("#annual").val();
     		var db_annual =  $("#db_annual").val();     		
     		var newannual = db_annual-annual;
     		
     		//alert(newannual);
     		if(newannual <0){
     			$("#annual_end").hide();
     			$("#annual_start").hide();
     			$("#applyAnnual").hide();
     			alert('Amount can not exceed your leave balance');
     		}else{
     			$("#annual_end").show();
     			$("#annual_start").show();
     			$("#applyAnnual").show();
     		}
     });  
     
	$("#annual_start").blur(function(){
		var anndate = Date.parse($('#annual_start').val());
		if(anndate < $.now()){
			$("#annual_end").hide();
			$("#applyAnnual").hide();
			alert("Start date must be in the future!");
		}else{
			$("#annual_end").show();
			$("#applyAnnual").show();
		}
	});	
	
	$("#annual_end").blur(function(){
		var anndate = Date.parse($('#annual_start').val());
		var annenddate = Date.parse($('#annual_end').val());
		if(annenddate < anndate){
			$("#applyAnnual").hide();
			alert("End date must be later than start date!");			
			$("#annual_end").val("");
		}else{
			$("#applyAnnual").show(); 
		} 
		
		if(isNaN(anndate)){
			$("#applyAnnual").hide();			
			$('#annual_end').val("");
		}else{
			$("#applyAnnual").show();
		}
		
	});	
	
   //Validating Maternity Section	
	$("#maternity").keyup(function(){
     		var maternity =  $("#maternity").val();
     		var db_maternity =  $("#db_maternity").val();     	 	
     		var newmaternity = db_maternity-maternity; 
     		
     		//alert(newannual);
     		if(newmaternity <0){
     			$("#maternity_start").hide();
     			$("#maternity_end").hide();
     			$("#applyMaternity").hide();
     			alert('Amount can not exceed your leave balance');
     		}else{
     			$("#maternity_start").show();
     			$("#maternity_end").show(); 
     			$("#applyMaternity").show();
     		}
     });  
     
	$("#maternity_start").blur(function(){
		var matstart = Date.parse($('#maternity_start').val());
		if(matstart < $.now()){
			$("#maternity_end").hide();
			$("#applyMaternity").hide();
			alert("Start date must be in the future!");
		}else{
			$("#maternity_end").show();
			$("#applyMaternity").show();
		}
	});	
	
	$("#maternity_end").blur(function(){
		var matdate = Date.parse($('#maternity_start').val());
		var matenddate = Date.parse($('#maternity_end').val());
		if(matenddate < matdate){
			$("#applyMaternity").hide();
			alert("End date must be later than start date!");
		}else{
			$("#applyMaternity").show();
		} 
		
		if(isNaN(matdate)){
			$("#applyMaternity").hide();			
			$('#maternity_end').val("");
		}else{
			$("#applyMaternity").show();
		}
		
	});	
	
   //Validating Sick Section	
	$("#sick").keyup(function(){
     		var sick =  $("#sick").val();
     		var db_sick =  $("#db_sick").val();     		
     		var newsick = db_sick-sick;
     		
     		//alert(newannual);
     		if(newsick <0){
     			$("#sick_start").hide();
     			$("#sick_end").hide();
     			$("#applySick").hide();
     			alert('Amount can not exceed your leave balance');
     		}else{
     			$("#sick_start").show();
     			$("#sick_end").show(); 
     			$("#applySick").show();
     		}
     });  
     
	$("#sick_start").blur(function(){
		var sstart = Date.parse($('#sick_start').val());
		if(sstart < $.now()){
			$("#sick_end").hide();
			$("#applySick").hide();
			alert("Start date must be in the future!");
		}else{
			$("#sick_end").show();
			$("#applySick").show();
		}
	});	
	
	$("#sick_end").blur(function(){
		var sstart = Date.parse($('#sick_start').val());
		var senddate = Date.parse($('#sick_end').val());
		if(senddate < sstart){
			$("#applySick").hide();
			alert("End date must be later than start date!");
		}else{
			$("#applySick").show();
		}	
		
		if(isNaN(sstart)){
			$("#applySick").hide();			
			$('#sick_end').val("");
		}else{
			$("#applySick").show();
		}
		
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
			    		<h3 class="panel-title" align="center"> ::::LEAVE APPLICATION :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  			<div id="spinner" class="spinner" style="display:none;">
    					<i class=" spinner fa fa-spinner"></i>
						</div>
			  			
						<?php
						echo form_open();
						echo "<h3> Annual Leave (".  $ldays['balance_annual'].  " days left) </h3><hr>";  
						echo "<div class='col-md-4'>";	
														
							// Days Applied for Field
							echo form_label('Days Applied For');
							$data_name = array(
							'type' => 'number',
							'name' => 'annual',
							'class' => 'form-control',
							'min' => 0,
							'placeholder' => 'Days Applied',
							'id' => 'annual', 
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo "</div>";
							
						echo "<div class='col-md-4'>";	
														
							// Start Date Field
							echo form_label('Start Date');
							$data_name = array(
							'type' => 'date',
							'name' => 'annual_start',
							'class' => 'form-control',
							'id' => 'annual_start',
							'required' => 'required',
							); 
							echo form_input($data_name); 
							echo "</div>";
							
						echo "<div class='col-md-4'>";	
														
							// End Date Field
							echo form_label('End Date');
							$data_name = array(
							'type' => 'date',
							'name' => 'annual_end',
							'class' => 'form-control',
							'id' => 'annual_end',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo "</div>";
							echo "<div class='col-md-12'>";	
							echo br();
							echo form_submit('submit', 'Apply Annual Leave', "class=' btn btn-lg btn-block $buttonclass' id='applyAnnual'");
							echo br(); 
							echo form_close();
							echo form_open();
						 	echo "<h3> Maternity/Paternity (".  $ldays['balance_maternity'].  " days left) </h3><hr>";  
						 	//
						 	echo "<div class='col-md-4'>";	
														
							// Days Applied for Field
							echo form_label('Days Applied For'); 
							$data_name = array(
							'type' => 'number',
							'name' => 'maternity',
							'class' => 'form-control',
							'min' => 0,
							'placeholder' => 'Days Applied',
							'id' => 'maternity',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo "</div>";
							
						echo "<div class='col-md-4'>";	
														
							// Start Date Field
							echo form_label('Start Date');
							$data_name = array(
							'type' => 'date',
							'name' => 'maternity_start',
							'class' => 'form-control',
							'id' => 'maternity_start',
							'required' => 'required', 
							); 
							echo form_input($data_name); 
							echo "</div>";
							
						echo "<div class='col-md-4'>";	
														
							// End Date Field
							echo form_label('End Date');
							$data_name = array(
							'type' => 'date',
							'name' => 'maternity_end',
							'class' => 'form-control',
							'id' => 'maternity_end',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo "</div>"; 
							echo "</div>";
						echo "<div class='col-md-12'>";	
						echo br(); 
						echo form_submit('submit', 'Apply Maternity/Paternity Leave', "class=' btn btn-lg btn-block $buttonclass' id='applyMaternity'"); 
						echo form_close();
						echo form_open(); 
						echo br(); 
						echo "<h3> Sick Leave (".  $ldays['balance_sick'].  " days left) </h3><hr>";   
						
							echo "<div class='col-md-4'>";	
														
							// Days Applied for Field
							echo form_label('Days Applied For');
							$data_name = array(
							'type' => 'number',
							'name' => 'sick',
							'class' => 'form-control',
							'min' => 0,
							'placeholder' => 'Days Applied',
							'id' => 'sick',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo "</div>";
							
						echo "<div class='col-md-4'>";	
														
							// Start Date Field
							echo form_label('Start Date');
							$data_name = array(
							'type' => 'date',
							'name' => 'sick_start',
							'class' => 'form-control',
							'id' => 'sick_start',
							'required' => 'required', 
							); 
							echo form_input($data_name); 
							echo "</div>";
							
						echo "<div class='col-md-4'>";	
														
							// End Date Field
							echo form_label('End Date');
							$data_name = array(
							'type' => 'date',
							'name' => 'sick_end',
							'class' => 'form-control',
							'id' => 'sick_end',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo "</div>"; 
						
						echo "</div>";  
					 
						echo "<div class='col-md-12'>";
						echo br();	
						echo form_submit('submit', 'Apply Sick Leave', "class=' btn btn-lg btn-block $buttonclass' id='applySick'"); 
						echo br(3); 
						echo "</div>";
						echo br(2);
						?>
						<input type='hidden' value='<?php echo $ldays['balance_annual'] ?>' id='db_annual' />
						<input type='hidden' value='<?php echo $ldays['balance_maternity'] ?>' id='db_maternity' />
						<input type='hidden' value='<?php echo $ldays['balance_sick'] ?>' id='db_sick' />
						<?php 
						echo form_close();
						
						?> 
			
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