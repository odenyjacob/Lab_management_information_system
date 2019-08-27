<?php
	if($access['user_access']!='yes'){
		redirect('main/unauthorized');
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
   
<script>
	$(document).ready(function(){		

		$("#submit").click(function(event) {
			event.preventDefault();
			
			if($('#FName').val()==""){
				alert('First Name can not be empty!');
			}else{
			
			var empNumber = $("#empNumber").val();
			var addEmployee = $("#addEmployee").val();
			var editEmployee = $("#editEmployee").val();
			var timecard = $("#timecard").val();
			var timecardApproval = $("#timecardApproval").val();
			var leaveApplication = $("#leaveApplication").val();
			var leaveApproval = $("#leaveApproval").val();
			var employeeBenefits = $("#employeeBenefits").val();
			var employeeDeductions = $("#employeeDeductions").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/fms/pur",
				dataType: 'json',
				data: {
					empNumber: empNumber,
					addEmployee: addEmployee,
					editEmployee: editEmployee,
					timecard: timecard,
					timecardApproval: timecardApproval,
					leaveApplication: leaveApplication,
					leaveApproval: leaveApproval,
					employeeBenefits: employeeBenefits,
					newImprest: myImprests,
				},
			success: function(response){
				if(response){
					alert('Employee Benefit Added successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
			
			}
		});
		
		$("#revokeaddEmployee").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/revokeaddEmployee",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revokeaddEmployee').hide();
					$('#grantaddEmployee').show();
					alert('Access level revoked successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#revokeeditEmployee").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/revokeeditEmployee",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revokeeditEmployee').hide();
					$('#granteditEmployee').show();
					alert('Access level revoked successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#revoketimecardApproval").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/revoketimecardApproval",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revoketimecardApproval').hide();
					$('#granttimecardApproval').show();
					alert('Access level revoked successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#revokeleaveApproval").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/revokeleaveApproval",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revokeleaveApproval').hide();
					$('#grantleaveApproval').show();
					alert('Access level revoked successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#revokeleaveApplication").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/revokeleaveApplication",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revokeleaveApplication').hide();
					$('#grantleaveApplication').show();
					alert('Access level revoked successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		
		$("#revoketimecard").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/revoketimecard",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revoketimecard').hide();
					$('#granttimecard').show();
					alert('Access level revoked successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#granttimecard").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/granttimecard",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#granttimecard').hide();
					$('#revoketimecard').show();
					alert('Access level granted successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#grantleaveApplication").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/grantleaveApplication",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#grantleaveApplication').hide();
					$('#revokeleaveApplication').show();
					alert('Access level granted successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#grantleaveApproval").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/grantleaveApproval",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#grantleaveApproval').hide();
					$('#revokeleaveApproval').show();
					alert('Access level granted successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		
		$("#grantaddEmployee").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/grantaddEmployee",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revokeaddEmployee').show();
					$('#grantaddEmployee').hide();
					alert('Access level granted successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#granteditEmployee").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/granteditEmployee",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revokeeditEmployee').show();
					$('#granteditEmployee').hide();
					alert('Access level granted successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		$("#granttimecardApproval").click(function(event){
			event.preventDefault();
			var empNumber = $("#empNumber").val();
			
			jQuery.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/main/granttimecardApproval",
				dataType: 'json',
				data: {
					empNumber: empNumber,
				},
				success: function(response){
				if(response){
					$('#revoketimecardApproval').show();
					$('#granttimecardApproval').hide();
					alert('Access level granted successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
		});
		
		
	  $("#empNumber").keyup(function(){
	  	if($('#empNumber').val()==""){
	  		$('#finalResult').html("");
	  		$('#LName').html("");
	  		$('#FName').html("");
	  		$('#MName').html("");
	  }
		if($("#empNumber").val().length>0){
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>" + "index.php/main/pur", 
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
							$("#result").show();
						    //$('#addEmployee').checked(true);						
						   // items.push($('LName').text(val.empNumber + "- " + val.FName + "-" + val.LName));
						    items.push($('#LName').val(val.LName ));
						    items.push($('#FName').val(val.FName ));
						    items.push($('#MName').val(val.MName ));
						    
						    //window.addEmployee = val.addEmployee;
						    
						   if(val.addEmployee=='yes'){
						   		$('#revokeaddEmployee').show();
						   		$('#grantaddEmployee').hide();						   		
						   }else{
						   		$('#revokeaddEmployee').hide();
						   		$('#grantaddEmployee').show();
						   }
						   if(val.editEmployee=='yes'){
						   		$('#revokeeditEmployee').show();
						   		$('#granteditEmployee').hide();						   		
						   }else{
						   		$('#revokeeditEmployee').hide();
						   		$('#granteditEmployee').show();
						   }
						   if(val.timecard=='yes'){
						   		$('#revoketimecard').show();
						   		$('#granttimecard').hide();						   		
						   }else{
						   		$('#revoketimecard').hide();
						   		$('#granttimecard').show();
						   }
						   if(val.timecardApproval=='yes'){
						   		$('#revoketimecardApproval').show();
						   		$('#granttimecardApproval').hide();						   		
						   }else{
						   		$('#revoketimecardApproval').hide();
						   		$('#granttimecardApproval').show();
						   }
						   if(val.leaveApplication=='yes'){
						   		$('#revokeleaveApplication').show();
						   		$('#grantleaveApplication').hide();						   		
						   }else{
						   		$('#revokeleaveApplication').hide();
						   		$('#grantleaveApplication').show();
						   }						    
						   if(val.leaveApproval=='yes'){
						   		$('#revokeleaveApproval').show();
						   		$('#grantleaveApproval').hide();						   		
						   }else{
						   		$('#revokeleaveApproval').hide();
						   		$('#grantleaveApproval').show();
						   }					   
						   
						   
						    
						});	
						
						
					}catch(e) {	
						$("#result").hide();	
						alert('Exception while request..');
					}		
				}else{
					$("#result").hide();
					$('#finalResult').html($('<li/>').text("No employee linked to the ID"));		
				}		
				
			},
			error: function(){	
				$("#result").hide();					
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
			    		<h3 class="panel-title" align="center"> :::: MODIFY USER ACCESS LEVELS :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  			
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('', $attributes) ;
						echo form_label('Employee Number/ Username');
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
						echo "<div id='result' style='display: none'>";					
						echo "<div class='col-xl-6'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
						<?php
                        		echo "
                        		<h3> Grant/Revoke Access </h3><hr>
				        	<thead>
				        		<tr> 
						        	<th><center>Module</center></th>
						        	<th><center>Section</center></th>
						        	<th><center>Grant</center></th>
						        	
				        		</tr>
				        	</thead>
				        	<tr> <td>Module	</td><td>Management </td>  <td><center> <button class=' btn btn-sm  btn-warning' id='grantaddEmployee'>Grant</button><button class=' btn btn-sm  $buttonclass' id='revokeaddEmployee'>Revoke</button>  </center></td>	 </tr> 
				        	<tr> <td>	</td><td>Supplies  </td>  <td><center>  <button class=' btn btn-sm  btn-warning' id='granttimecard'>Grant</button><button class=' btn btn-sm  $buttonclass' id='revoketimecard'>Revoke</button> </center></td>	 </tr> 
				        	<tr> <td>	</td><td>Customers - </td>  <td><center>  <button class=' btn btn-sm  btn-warning' id='granttimecardApproval'>Grant</button><button class=' btn btn-sm  $buttonclass' id='revoketimecardApproval'>Revoke</button> </center></td>	 </tr> 
				        	<tr> <td>	</td><td>Reports</td>  <td><center><button class=' btn btn-sm  btn-warning' id='grantleaveApplication'>Grant</button><button class=' btn btn-sm  $buttonclass' id='revokeleaveApplication'>Revoke</button>  </center></td>	 </tr> 
				        	<!-- <tr> <td>	</td><td>Leave Approvals - <i> (For Supervisors)</i> </td>  <td><center><button class=' btn btn-sm  btn-warning' id='grantleaveApproval'>Grant</button><button class=' btn btn-sm  $buttonclass' id='revokeleaveApproval'>Revoke</button>  </center></td>	 </tr>  
							<tr> <td>	</td><td>Edit Existing Employee </td>  <td><center> <button class=' btn btn-sm  btn-warning' id='granteditEmployee'>Grant</button><button class=' btn btn-sm  $buttonclass' id='revokeeditEmployee'>Revoke</button></center></td>	 </tr> -->
				        	
						</table></div></div>";
						
						?>	
			  	
			    
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


</script>


</html>