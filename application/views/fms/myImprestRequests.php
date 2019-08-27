<?php/*
	if($access['timecardApproval']!='yes'){
		redirect('main/unauthorized');
	} 
 * 
 */
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
    <link href=<?php echo base_url('dashboard/font-awesome-4.4.0/css/font-awesome.min.css') ?> rel="stylesheet">

    <!-- Metis Menu Plugin JavaScript -->
   <script src="<?php echo base_url('dashboard/js/plugins/metisMenu/metisMenu.min.js') ?>"></script> 
   <link href="<?php echo base_url('dashboard/css/home.css') ?>" rel="stylesheet">

    <!-- Custom Theme JavaScript -->
   <script src="<?php echo base_url('dashboard/js/sb-admin-2.js') ?>"></script>
   
<script>
	$(document).ready(function(){		
		$(".approve").click(function(event){
			event.preventDefault();
			
			var empNumber = $(this).val();
			$(this).hide();
		
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/hcm/leave_approved",
				dataType: 'json',
				data: {
					empNumber: empNumber,	
				},
				success: function (response){
					if(response){
					alert("#" + response.empNumber + ": Leave Approved Successfully!");
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
		});
		
		$(".reject").click(function(event){
			event.preventDefault();
			//$(this).hide();
			
			var i = $(this).val();
			var sections = i.split('.');
			var empNumber = sections[0];
			var days_applied = sections[1];
			var leave_type = sections[2];
			var annual = sections[3];
			var maternity = sections[4];
			var sick = sections[5];	
			
			var balance_annual = parseFloat(annual) + parseFloat(days_applied);		
			var balance_maternity = parseFloat(maternity) + parseFloat(days_applied);		
			var balance_sick = parseFloat(sick) + parseFloat(days_applied);		

			
			if(leave_type=='Sick'){ 
				$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/hcm/sickleave_rejected",
				dataType: 'json',
				data: {
					empNumber: empNumber, balance_sick: balance_sick,	
				},
				success: function (response){
					if(response){
					alert("#" + response.empNumber + ": Sick leave rejected Successfully!");
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
			}
			if(leave_type=='Annual'){ 
				$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/hcm/annualleave_rejected",
				dataType: 'json',
				data: {
					empNumber: empNumber, balance_annual: balance_annual,	
				},
				success: function (response){
					if(response){
					alert("#" + response.empNumber + ": Annual leave rejected Successfully!");
					location.reload(true);
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
			}
			if(leave_type=='Maternity'){ 
				$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/hcm/maternityleave_rejected",
				dataType: 'json',
				data: {
					empNumber: empNumber, balance_maternity: balance_maternity,	
				},
				success: function (response){
					if(response){
					alert("#" + response.empNumber + ": Maternity leave rejected Successfully!");
					location.reload(true);
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
			}
			
					
		});
		
		$("#viewall").click(function(e){
				event.preventDefault();
				alert("Not yet activated");
		});
		$("#viewapproved").click(function(e){
				event.preventDefault();
				alert("Not yet activated");
		});
		$("#viewpendingapproval").click(function(e){
				event.preventDefault();
				alert("Not yet activated");
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
			    		<h3 class="panel-title" align="center"> :::: MY IMPREST REQUESTS :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  			
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('', $attributes); 
						echo form_submit('submit', 'All', "class=' btn btn-lg  $buttonclass' id='viewall'"); echo nbs(2);
						echo form_submit('submit', 'Approved', "class=' btn btn-lg  $buttonclass' id='viewapproved'"); echo nbs(2);
						echo form_submit('submit', 'Pending Approval', "class=' btn btn-lg  $buttonclass' id='viewpendingapproval'");
						//echo "<button $buttonclass id='viewall'> View All </button> <button $buttonclass id='viewapproved'> View Approved </button>";				
						echo "<div class='col-md-12'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
						<?php
						
						echo "<h3> My Imprest Requests </h3><hr>"; 
						echo "<thead>
				        		<tr> 
						        	<th><center>#</center></th>
						        	<th><center>Imrest Number</center></th>
						        	<th><center>Account </center></th>
						        	<th><center>Payee Account</center></th>
						        	<th><center>Amount</center></th>
						        	<th><center>Approver</center></th>
						        	<th><center>Purpose</center></th>
						        	<th><center>Supervisor Approval</center></th>
						        	<th><center>Financial Approval</center></th>
						        	<th><center>Accountants Approval</center></th>
						        	
				        		</tr></thead>";
								$count = 1;  				        		
							foreach($IR as $row){
								if($row){
                        		echo" 
				        	
				        	
				        	<tr> <td> $count </td> <td>{$row->impNumber}</td> <td> {$row->Account} </td> <td> {$row->payee_account}</td>  <td> {$row->amount} </td>  <td> {$row->approver} </td>  <td> {$row->purpose} </td>  <td> {$row->supervisor_approval} </td>  <td> {$row->financial_approval} </td> <td> $row->accounts_collection </td>	 </tr>
				        	"; $count++; }else{
				        		echo "No approvals yet. Check back later!<br> ";
								break;
				        	}} echo "
						</table></div>"; 
						
						
					
						
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