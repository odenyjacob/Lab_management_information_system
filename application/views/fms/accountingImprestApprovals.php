<?php
	if($access['timecardApproval']!='yes'){
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
    <link href=<?php echo base_url('dashboard/font-awesome-4.4.0/css/font-awesome.min.css') ?> rel="stylesheet">

    <!-- Metis Menu Plugin JavaScript -->
   <script src="<?php echo base_url('dashboard/js/plugins/metisMenu/metisMenu.min.js') ?>"></script> 
   <link href="<?php echo base_url('dashboard/css/home.css') ?>" rel="stylesheet">

    <!-- Custom Theme JavaScript -->
   <script src="<?php echo base_url('dashboard/js/sb-admin-2.js') ?>"></script>
   
<script>
	$(document).ready(function(){		
		$(".confirm").click(function(event){
			event.preventDefault();
			
			var impNumber = $(this).val();
			$(this).hide();
		
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/fms/confirmAccountsImprests",
				dataType: 'json',
				data: {
					impNumber: impNumber,	
				},
				success: function (response){
					if(response){
					alert("#" + response.impNumber + ": Imprest Request Confirmed Successfully!");
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
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
			    		<h3 class="panel-title" align="center"> :::: ACCOUNTS - IMPREST APPROVALS :::</h3>  
			  		</div>
			  		<div class="panel-body" style="overflow-y: scroll; min-height: 10;"> 
			  			
			  			
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('', $attributes); 
					
						//echo "<div id='result' style='display: none'>";					
						echo "<div class='col-xl-6'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
						<?php
						
						echo "<h3> Imprest Collections </h3><hr>";
						echo "<thead>
				        		<tr> 
						        	<th><center>Request Number </center></th>
						        	<th><center>Raised By </center></th>
						        	<th><center>Amount </center></th>
						        	<th><center>Raised For </center></th>
						        	<th><center>Date Raised</center></th>
						        	<th><center>Purpose</center></th>
						        	<th><center>Purpose</center></th>
						        	<th><center>Financial Approval</center></th>
						        	<th><center>Actions</center></th>
						        	
				        		</tr></thead>";
							foreach($approvals as $row){  
								if($row){
                        		echo" 				        	
				        	
				        	<tr> <td>{$row->impNumber}</td> <td> {$row->FName} {$row->LName}</td>  <td> {$row->amount} </td>   <td> {$row->payee_account} </td>  <td>{$row->date_raised} </td> <td> {$row->purpose} </td>  <td> {$row->remarks} </td>  <td> {$row->financial_approval} </td>  <td><center>"; if($row->accounts_collection !="Collected"){echo " <button class='confirm btn btn-sm  $buttonclass'   value='{$row->impNumber}'>Confirm</button>";}else{ echo $row->accounts_collection ;} echo " </center>  </td>	 </tr>
				        	";}else{
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